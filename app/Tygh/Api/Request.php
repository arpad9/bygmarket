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

use Tygh\Api;

class Request
{
    /**
     * Current resource name
     * @var string $_resource
     */
    private $_resource = '';

    /**
     * Current request method
     *
     * @var string $_request_method
     */
    private $_method = '';

    /**
     * Current request data
     *
     * @var array $_request_data
     */
    private $_data = array();

    /**
     * Current request headers
     *
     * @var string $_headers
     */
    private $_headers = array();

    private $_content_type = '';

    private $_accept_type = '';

    /**
     * uth data (user => 'user name', api_key => 'API KEY')
     *
     * @var string $_auth
     */
    private $_auth = array();

    private $_error = array();

    public function getResource()
    {
        return $this->_resource;
    }

    public function getAuthData()
    {
        return $this->_auth;
    }

    public function getHeaders()
    {
        if ($this->_headers['Accept'] == '*/*') {
            $this->_headers['Accept'] = Api::DEFAULT_RESPONSE_FORMAT;
        }

        return $this->_headers;
    }

    public function getContentType()
    {
        return $this->_content_type;
    }

    public function getAcceptType()
    {
        return $this->_accept_type;
    }

    public function getData()
    {
        // Unset REST resource name param
        if (isset($this->_data[Api::REST_RESOURCE_PARAM_NAME])) {
            unset($this->_data[Api::REST_RESOURCE_PARAM_NAME]);
        }

        return $this->_data;
    }

    public function getMethod()
    {
        return $this->_method;
    }

    public function getError()
    {
        return $this->_error;
    }

    /**
     * Creates API instance
     *
     * @param string $resource Resource name, if empty will be filled from current HTTP request
     * @param string $method   Request method, if empty will be filled from current HTTP request
     * @param array  $headers  Array of headers, if empty will be filled from current HTTP request
     * @param array  $data     Request data, if empty will be filled from current HTTP request
     * @param array  $auth     Auth data (user => 'user name', api_key => 'API KEY')
     */
    public function __construct($resource = "", $method = "",  $headers = array(), $data = array(), $auth = array())
    {
        if (empty($resource)) {
            $this->_resource = $this->_getResourceNameFromRequest();
        } else {
            $this->_resource = $resource;
        }

        if (empty($method)) {
            $this->_method = $this->_getMethodFromRequestHeaders();
        } else {
            $this->_method = $method;
        }

        if (empty($headers)) {
            $this->_headers = $this->_getHeadersFromRequestHeaders();
        } else {
            $this->_headers = $headers;
        }

        if (empty($this->_headers)) {
            $this->_content_type = '';
            $this->_accept_type = '';
        } else {
            $this->_content_type = $this->_getContentTypeFromHeader($this->_headers['Content-Type']);
            $this->_accept_type = $this->_getAcceptTypeFromHeader($this->_headers['Accept']);
        }

        if (empty($data)) {
            $this->_data = $this->_getDataFromRequestBody();
        } else {
            $this->_data = $data;
        }

        if (empty($auth)) {
            $this->_auth = $this->_getAuthFromRequest();
        } else {
            $this->_auth = $auth;
        }
    }

    /**
     * Gets resource name from current http request
     *
     * @return string Resource name
     */
    private function _getResourceNameFromRequest()
    {
        return !empty($_REQUEST[Api::REST_RESOURCE_PARAM_NAME]) ? $_REQUEST[Api::REST_RESOURCE_PARAM_NAME] : '';
    }

    /**
     * Gets equest method name (GET|POST|PUT|DELETE) from current http request
     *
     * @return string Request method name
     */
    private function _getMethodFromRequestHeaders()
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    /**
     * Gets content type from current http request
     *
     * @return string Content type
     */
    private function _getHeadersFromRequestHeaders()
    {
        return array(
            'Content-Type' => !empty($_SERVER['CONTENT_TYPE']) ? $_SERVER['CONTENT_TYPE'] : Api::DEFAULT_REQUEST_FORMAT,
            'Accept'  => !empty($_SERVER['HTTP_ACCEPT']) ? $_SERVER['HTTP_ACCEPT'] : Api::DEFAULT_RESPONSE_FORMAT,
        );

    }

    private function _getContentTypeFromHeader($header_content_type)
    {
        $content_type = '';

        if (!empty($header_content_type)) {
            if ($pos_semicolon = strpos($header_content_type, ';')) {
                $content_type = substr($header_content_type, 0, $pos_semicolon);
            } else {
                $content_type = $header_content_type;
            }
        }

        return $content_type;
    }

    private function _getAcceptTypeFromHeader($header_accept)
    {
        $accept_type = '';

        if (!empty($header_accept)) {
            $accept_type = $this->_getAvailableContentType(array_keys($this->_parseHeaderAccept($header_accept)));
        }

        return $accept_type;
    }

    /**
     * Get the first matching one from the list of the client-requested data types
     *
     * @param array Data types, sorted by priority
     * @return string Available data type
     */
    private function _getAvailableContentType($mime_types)
    {
        foreach ($mime_types as $type) {
            if (FormatManager::instance()->isMimeTypeSupported($type)) {
                return $type;
            }
            if ($type == '*/*') {
                return Api::DEFAULT_RESPONSE_FORMAT;
            }
        }

        return '';
    }

    /**
     * Splits header Accept line into a data type array
     *
     * @param  string $header Header to parse
     * @return array  Data type array, sorted by priority
     */
    private function _parseHeaderAccept($header)
    {
        if (!$header) {
            return array();
        }

        $types = array();
        $groups = array();
        foreach (explode(',', $header) as $type) {
            // get data type priority
            if (preg_match('/;\s*(q=.*$)/', $type, $match)) {
                $q    = substr(trim($match[1]), 2);
                $type = trim(substr($type, 0, -strlen($match[0])));
            } else {
                $q = 1;
            }

            $groups[$q][] = $type;
        }

        krsort($groups);

        foreach ($groups as $q => $items) {
            $q = (float) $q;

            if (0 < $q) {
                foreach ($items as $type) {
                    $types[trim($type)] = $q;
                }
            }
        }

        return $types;
    }

    /**
     * Gets request data from current http request
     *
     * @return string Content type
     */
    private function _getDataFromRequestBody()
    {
        $params = array();

        $method = $this->_getMethodFromRequestHeaders();
        $content_type = $this->getContentType();

        if ($method == "PUT" || $method == "DELETE" || $method == "POST") {
            $params = file_get_contents('php://input');

            if (!empty($content_type)) {
                list($params, $this->_error) = FormatManager::instance()->decode($params, $content_type);
            }
        } elseif ($method == "GET") {
            $params = $_GET;
        }

        return $params;
    }

    /**
     * Gets content type from current http request
     *
     * @return string Content type
     */
    private function _getAuthFromRequest()
    {
        $auth = array();

        if (!empty($_SERVER['PHP_AUTH_USER']) && !empty($_SERVER['PHP_AUTH_PW'])) {
            $auth['user'] = $_SERVER['PHP_AUTH_USER'];
            $auth['api_key'] = $_SERVER['PHP_AUTH_PW'];
        }

        return $auth;
    }

}
