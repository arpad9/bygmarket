<?php
/***************************************************************************
*                                                                          *
*   (c) 2004 Vladimir V. Kalynyak, Alexey V. Vinokurov, Ilya M. Shalnev    *
*                                                                          *
* This  is  commercial  software,  only  users  who have purchased a valid *
* license  and  accept  to the terms of the  License Agreement can install *
* and use this program.                                                    *
*                                                                          *
****************************************************************************
* PLEASE READ THE FULL TEXT  OF THE SOFTWARE  LICENSE   AGREEMENT  IN  THE *
* "copyright.txt" FILE PROVIDED WITH THIS DISTRIBUTION PACKAGE.            *
****************************************************************************/

namespace Tygh\Backend\Database;

class Mysqli implements IBackend
{
    private $_conn;
    private $_reconnects = 0;
    private $_max_reconnects = 3;
    private $_skip_error_codes = array (
        1091, // column exists/does not exist during alter table
        1176, // key does not exist during alter table
        1050, // table already exist
        1060  // column exists
    );

    /**
     * Connects to database server
     * @param  string  $user     user name
     * @param  string  $passwd   password
     * @param  string  $host     server host name
     * @param  string  $database database name
     * @return boolean true on success, false - otherwise
     */
    public function connect($user, $passwd, $host, $database)
    {
        if (empty($host) || empty($user)) {
            return false;
        }

        @list($host, $port) = explode(':', $host);

        $this->_reconnects = 0;
        $this->_conn = @ new \mysqli($host, $user, $passwd, $database, $port);

        return !empty($this->_conn) && empty($this->_conn->connect_errno);
    }

    /**
     * Disconnects from the database
     */
    public function disconnect()
    {
        $this->_conn->close();
        $this->_conn = null;
    }

    /**
     * Changes current database
     * @param  string  $database database name
     * @return boolean true on success, false - otherwise
     */
    public function changeDb($database)
    {
        if ($this->_conn->select_db($database)) {
            return true;
        }

        return false;
    }

    /**
     * Queries database
     * @param  string $query SQL query
     * @return query  result
     */
    public function query($query)
    {
        $result = $this->_conn->query($query);

        if (empty($result)) {
            // Lost connection, try to reconnect
            if (($this->errorCode() == 2013 || $this->errorCode() == 2006) && $this->_reconnects < $this->_max_reconnects) {
                $this->disconnect();
                $this->_connect(Registry::get('config.db_host'), Registry::get('config.db_user'), Registry::get('config.db_password'), Registry::get('config.db_name'));
                $this->_reconnects++;
                $result = $this->query($query);

            // Assume that the table is broken
            // Try to repair
            } elseif (preg_match("/'(\S+)\.(MYI|MYD)/", $this->errorCode(), $matches)) {
                $this->_conn->query("REPAIR TABLE $matches[1]");
                $result = $this->query($query);
            }
        }

        return $result;
    }

    /**
     * Fetches row from query result set
     * @param  mixed  $result result set
     * @param  string $type   fetch type - 'assoc' or 'indexed'
     * @return array  fetched data
     */
    public function fetchRow($result, $type = 'assoc')
    {
        if ($type == 'assoc') {
            return $result->fetch_assoc();
        } else {
            return $result->fetch_row();
        }
    }

    /**
     * Frees result set
     * @param mixed $result result set
     */
    public function freeResult($result)
    {
        return $result->free();
    }

    /**
     * Return number of rows affected by query
     * @param  mixed $result result set
     * @return int   number of rows
     */
    public function affectedRows($result)
    {
        return $this->_conn->affected_rows;
    }

    /**
     * Returns last value of auto increment column
     * @return int value
     */
    public function insertId()
    {
        return $this->_conn->insert_id;
    }

    /**
     * Gets last error code
     * @return int error code
     */
    public function errorCode()
    {
        $errno = $this->_conn->errno;

        return in_array($errno, $this->_skip_error_codes) ? 0 : $errno;
    }

    /**
     * Gets last error description
     * @return string error description
     */
    public function error()
    {
        return $this->_conn->error;
    }

    /**
     * Escapes value
     * @param  mixed  $value value to escape
     * @return string escaped value
     */
    public function escape($value)
    {
        return $this->_conn->real_escape_string($value);
    }
}
