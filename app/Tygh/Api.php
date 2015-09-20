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

namespace Tygh;

use Tygh\Registry;
use Tygh\Api\Request;
use Tygh\Api\Response;
use Tygh\Api\FormatManager;

class Api
{
    /**
     * Key of resource name in _REQUEST
     *
     * @const REST_PATH_PARAM_NAME
     */
    const DEFAULT_REQUEST_FORMAT = 'text/plain';

    /**
     * Key of resource name in _REQUEST
     *
     * @const REST_PATH_PARAM_NAME
     */
    const DEFAULT_RESPONSE_FORMAT = 'application/json';

    /**
     * Key of resource name in _REQUEST
     *
     * @const REST_PATH_PARAM_NAME
     */
    const REST_RESOURCE_PARAM_NAME = '_d';

    /**
     * Length of API keys
     *
     * @const API_KEY_LENGTH
     */
    const API_KEY_LENGTH = 32;

    /**
     * Auth data
     * (user => 'user name', api_key => 'API KEY')
     *
     * @var array $_auth
     */
    private $_auth = array();

    /**
     * Current request data
     *
     * @var Request $_request
     */
    private $_request = array();

    /**
     * Creates API instance
     *
     * @return Api
     */
    public function __construct($formats = array('json', 'text'))
    {
        FormatManager::initiate($formats);
    }

    /**
     * Handles request.
     * Method gets request from entities and send it
     *
     * @param Request $resource Request object if empty will be created and filled from current HTTP request automaticly
     */
    public function handleRequest($request = null)
    {
        if ($request == null) {
            $this->_request = new Request();
        } else {
            $this->_request = $request;
        }

        if (!$this->_authenticate()) {
            $response = new Response(Response::STATUS_UNAUTHORIZED);
        } else {

            $content_type = $this->_request->getContentType();
            $accept_type = $this->_request->getAcceptType();
            $method = $this->_request->getMethod();

            if (($method == "PUT" || $method == "POST") && !FormatManager::instance()->isMimeTypeSupported($content_type)) {
                $response = new Response(Response::STATUS_UNSUPPORTED_MEDIA_TYPE);
            } elseif (($method == "GET" || $method == "HEAD") && !FormatManager::instance()->isMimeTypeSupported($accept_type)) {
                $response = new Response(Response::STATUS_METHOD_NOT_ACCEPTABLE);
            } elseif ($this->_request->getError()) {
                $response = new Response(Response::STATUS_BAD_REQUEST, $this->_request->getError(), $accept_type);
            } else {
                $controller_result = $this->_getResponse($this->_request->getResource());

                if (is_a($controller_result, '\\Tygh\\Api\\Response')) {
                    $response = $controller_result;
                } else {
                    $response = new Response(Response::STATUS_INTERNAL_SERVER_ERROR);
                }
            }
        }

        $response->send();
    }

    /**
     * Trys to authenticate user
     *
     * @return bool True on success, false otherwise
     */
    private function _authenticate()
    {
        $authenticated = false;
        $auth_data = $this->_request->getAuthData();

        if (!empty($auth_data['user']) && !empty($auth_data['api_key'])) {
            $user_data = db_get_row(
                "SELECT * FROM ?:users WHERE email = ?s AND api_key = ?s", $auth_data['user'], $auth_data['api_key']
            );

            // Return value must be bool
            if (!empty($user_data)) {
                Registry::set('runtime.company_id', $user_data['company_id']);
                $this->_auth = fn_fill_auth($user_data);
                $authenticated = true;
            }
        }

        return $authenticated;
    }

    /**
     * Return response
     *
     * @param  string   $resource REST resource name (products/1, users, etc.)
     * @return Response Response
     */
    private function _getResponse($resource)
    {
        $response = null;

        if (!empty($resource)) {
            $entity_properties = $this->getEntityFromPath($resource);
            $response = $this->_getResponseFromEntity($entity_properties);
        }

        return ($response != null) ? $response : new Response(Response::STATUS_NOT_FOUND);
    }

    /**
     * Creates entity object of resource, runs it method and return response
     *
     * @param  string   $entity_properties Properties of entity
     * @param  string   $parent_name       Parent entity name
     * @param  array    $parent_data       Parent entity data
     * @return Response Response or null
     */
    private function _getResponseFromEntity($entity_properties, $parent_name = null, $parent_data = null)
    {
        $response = null;

        $entity = $this->_getObjectByEntity($entity_properties);

        if ($entity !== null) {

            if (!empty($parent_data['data'])) {
                $entity->setParentName($parent_name);
                $entity->setParentData($parent_data['data']);
            }

            if (!empty($entity_properties['id']) && !$entity->isValidIdentifier($entity_properties['id'])) {
                $response = null;

            } elseif (!empty($entity_properties['child_entity'])) {

                $parent_result = $entity->index($entity_properties['id']);

                if (Response::isSuccessStatus($parent_result['status'])) {
                    $name = $entity_properties['name'];
                    $entity_properties = $this->getEntityFromPath($entity_properties['child_entity']);

                    $response = $this->_getResponseFromEntity($entity_properties, $name, $parent_result);
                } else {
                    $response = new Response($parent_result['status']);
                }
            } else {

                $response = $this->_exec($entity, $entity_properties);
            }
        } else {
            $response = new Response(Response::STATUS_NOT_FOUND, __('object_not_found', array('[object]' => __('entity') . ' ' . $entity_properties['name'])), $this->_request->getAcceptType());
        }

        return $response;
    }

/**
* Executes entity method
*
* @param  Entity   $entity            Entity object
* @param  array    $entity_properties Properties of entity
* @return Response Response
*/
    private function _exec($entity, $entity_properties)
    {
        $response = null;

        $accept_type = $this->_request->getAcceptType();
        $http_method = $this->_request->getMethod();
        $method_name = $this->getMethodName($http_method);

        $request_data = $this->_request->getData();

        if (empty($method_name)) {
            $response = new Response(Response::STATUS_METHOD_NOT_ALLOWED);

        } elseif (!$this->_checkAccess($entity, $method_name)) {
            $response = new Response(Response::STATUS_FORBIDDEN);

        } else {
            $reflection_method = new \ReflectionMethod($entity, $method_name);
            $accepted_params = $reflection_method->getParameters();
            $call_params = array();

            foreach ($accepted_params as $param) {
                $param_name = $param->getName();

                if ($param_name == 'id') {
                    $call_params[] = !empty($entity_properties['id']) ? $entity_properties['id'] : '';

                    if (empty($entity_properties['id']) && !$param->isOptional()) {
                        $response = new Response(Response::STATUS_METHOD_NOT_ALLOWED, __('api_need_id'), $accept_type);
                    }
                }

                if ($param_name == 'params') {
                    $call_params[] = $request_data;

                    if (empty($request_data) && !$param->isOptional()) {
                        $response = new Response(Response::STATUS_METHOD_NOT_ALLOWED, __('api_need_params'), $accept_type);
                    }
                }
            }

            if ($http_method != 'POST' || empty($entity_properties['id'])) {
                if ($response == null) {

                    if (fn_allowed_for('ULTIMATE')) {
                        if ($http_method == 'POST' || $http_method == 'PUT') {
                            call_user_func_array('fn_ult_parse_api_request', array($entity_properties['name'], $request_data));
                        }
                    }

                    $controller_result = $reflection_method->invokeArgs($entity, $call_params);

                    if (fn_notification_exists('extra', '404')) {
                        $response = new Response(Response::STATUS_NOT_FOUND, array(), $accept_type);

                    } elseif (!empty($controller_result['status'])) {
                        $data = !empty($controller_result['data']) ? $controller_result['data'] : '';
                        $response = new Response($controller_result['status'], $data, $accept_type);

                    } else {
                        $response = new Response(Response::STATUS_INTERNAL_SERVER_ERROR);
                    }
                }
            } else {
                $response = new Response(Response::STATUS_METHOD_NOT_ALLOWED, __('api_not_need_id'), $accept_type);
            }
        }

        return $response;
    }

    /**
     * Checks that current authetificated user can access to $entity and it $method_name
     *
     * @param  Entity $entity      Entity instance
     * @param  string $method_name Entity method name
     * @return bool   True on success, false otherwise
     */
    private function _checkAccess($entity, $method_name)
    {
        $can_access = false;
        $auth_data = $this->_request->getAuthData();

        if (!empty($auth_data['user']) && is_a($entity, '\\Tygh\\Api\\AEntity') && method_exists($entity, $method_name)) {
            $can_access = $entity->isAccessable($auth_data['user'], $method_name);
        }

        return $can_access;
    }

    /**
     * Returns entity method name by request method name
     *
     * @param  string $http_method_name (GET|POST|PUT|DELETE)
     * @return string method name
     */
    public function getMethodName($http_method_name)
    {
        $method = '';

        if ($http_method_name == 'GET') {
            $method = 'index';
        } elseif ($http_method_name == 'POST') {
            $method = 'create';
        } elseif ($http_method_name == 'PUT') {
            $method = 'update';
        } elseif ($http_method_name == 'DELETE') {
            $method = 'delete';
        }

        return $method;
    }

    /**
     * Converts list of ReflectionParameter objects to array with params name
     *
     * @param  array $reflection_params List of ReflectionParameter obejcts
     * @return array List of params names
     */
    private function _reflectionParamsToArray($reflection_params)
    {
        $params = array();

        foreach ($reflection_params as $param) {
            $params[] = $param->getName();
        }

        return $params;
    }

    /**
     * Explodes entity properties from resource name
     *
     * @param  string $resource_name REST resource name
     * @return array  Entity properties data
     */
    public function getEntityFromPath($resource_name)
    {
        $result = array(
            "name" => "",
            "id" => "",
        );

        if (!preg_match("/\/{2,}/", $resource_name)) {
            $resource_name = preg_replace("/\/$/", "", $resource_name);
            $resource_name = explode("/", $resource_name);

            if (!empty($resource_name[0])) {
                $result['name'] = array_shift($resource_name);

                if (!empty($resource_name[0])) {
                    $result['id'] = array_shift($resource_name);
                }

                if (!empty($resource_name[0])) {
                    //$result['child_entity'] = $this->getEntityFromPath(implode("/", $resource_name));
                    $result['child_entity'] = implode("/", $resource_name);

                }
            }
        }

        return $result;
    }

    /**
     * Returns instance of Entity class by entity properties
     *
     * @param  array  $entity_properties Entity properties data @see Api::getEntityFromPath
     * @return Entity
     */
    private function _getObjectByEntity($entity_properties)
    {
        $class_name = "\\Tygh\\Api\\Entities\\" . fn_camelize($entity_properties['name']);

        return class_exists($class_name) ? new $class_name($this->_auth) : null;
    }

    /**
     * Generates new API key
     *
     * @return string API key
     */
    public static function generateKey()
    {
        $length = Api::API_KEY_LENGTH;
        $key = "";

        for ($i = 1; $i <= $length; $i++) {
            $chr = rand(0, 1) ? (chr(rand(65, 90))) : (chr(rand(48, 57)));

            if (rand(0, 1)) {
                $chr = strtolower($chr);
            }

            $key .= $chr;
        }

        return $key;
    }

}
