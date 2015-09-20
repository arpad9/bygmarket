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

namespace Tygh\Api;

abstract class AEntity
{
    /**
     * User auth data
     *
     * @var string $_resource
     */
    protected $_auth = array();

    /**
     * Parent entity data
     *
     * @var string $_resource
     */
    protected $_parent = array();

    /**
     * Parent entity name
     *
     * @var string $_resource
     */
    protected $_parent_name = array();

    /**
     * Handles REST GET request. Must return Api_Response with list of entities
     * or one entity data if id specified
     *
     * @param  int      $id
     * @return Response
     */
    abstract public function index($id = '', $params = array());

    /**
     * Handles REST POST request. Must create resource and return Api_Response
     * with STATUS_CREATED on success.
     *
     * @param  array    $data POST data
     * @return Response
     */
    abstract public function create($params);

    /**
     * Handles REST PUT request. Must update resource and return Api_Response
     * with STATUS_OK on success.
     *
     * @param  int      $id
     * @param  array    $data POST data
     * @return Response
     */
    abstract public function update($id, $params);

    /**
     * Handles REST DELETE request. Must create resource and return Api_Response
     * with STATUS_NO_CONTENT on success.
     *
     * @param  int      $id
     * @return Response
     */
    abstract public function delete($id);

    /**
     * Returns true if authenticated user have permissions to use this method
     * @return bool
     */
    public function isAccessable($user, $method_name)
    {
        $is_accessable = false;
        $priveleges = $this->priveleges();
        if (isset($priveleges[$method_name])) {
            if (is_bool($priveleges[$method_name])) {
                $is_accessable = $priveleges[$method_name];
            } else {
                $user_id = db_get_field("SELECT user_id FROM ?:users WHERE email = ?s ", $user);
                $is_accessable = fn_check_user_access($user_id, $priveleges[$method_name]);
            }
        }

        return $is_accessable;
    }

    /**
     * Generic construct
     *
     * @param  array  $auth User auth data @see fn_fill_auth
     * @return Entity object
     */
    public function __construct($auth = array())
    {
        $this->_auth = $auth;
    }

    /**
     * Returns list of priveleges wat can be enabled for user
     *
     * @return array List of entyties
     */
    public function priveleges()
    {
        return array();
    }

    /**
     * Returns true if identifier valid
     *
     * @param  int  $id Identifier entity
     * @return bool True on success, false otherwise
     */
    public function isValidIdentifier($id)
    {
        return is_numeric($id);
    }

    /**
     * Returns true if entity is parent of $entity_name
     *
     * @param  string $entity_name Entity name
     * @return bool   True on ssuccess, false otherwise
     */
    public function isParentOf($entity_name)
    {
        $entities = $this->childEntities();

        return array_search($entity_name, $entities);
    }

    /**
     * Returns list of child entyties
     *
     * @return array List of entyties
     */
    public function childEntities()
    {
        return array();
    }

    /**
     * Gets value by key from array
     *
     * @param  array  $array   Array to search value
     * @param  string $key     Array ey name
     * @param  mixed  $default Default value will be returned if $array[$key] not issets
     * @return mixed  $array[$key] if it isset, false $default
     */
    protected function _safeGet($array, $key, $default)
    {
        return isset($array[$key]) ? $array[$key] : $default;
    }

    /**
     * Sets parent data
     *
     * @param array $data
     */
    public function setParentData($data)
    {
        $this->_parent = $data;
    }

    /**
     * Sets parent name
     *
     * @param array $name
     */
    public function setParentName($name)
    {
        $this->_parent_name = $name;
    }

    /**
     * Returns parent data
     *
     * @return array
     */
    public function getParentData()
    {
        return $this->_parent;
    }

    /**
     * Returns parent name
     *
     * @return array
     */
    public function getParentName()
    {
        return $this->_parent_name;
    }
}
