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

namespace Tygh\Api\Entities;

use Tygh\Api\AEntity;
use Tygh\Api\Response;

class Features extends AEntity
{

    public function index($id = 0, $params = array())
    {
        $lang_code = $this->_safeGet($params, 'lang_code', DEFAULT_LANGUAGE);

        if ($this->getParentName() == 'products') {
            $parent_product = $this->getParentData();
            $params['product_id'] = $parent_product['product_id'];
            $params['existent_only'] = $this->_safeGet($params, 'existent_only', true);
            $params['exclude_group'] = $this->_safeGet($params, 'exclude_group', true);
            $params['variants'] = $this->_safeGet($params, 'variants', true);
        }

        if (!empty($id)) {
            $params['variants'] = $this->_safeGet($params, 'variants', true);
            $data = fn_get_product_feature_data($id, $params['variants'], false, $lang_code);

            if (empty($data)) {
                $status = Response::STATUS_NOT_FOUND;
            } else {
                $status = Response::STATUS_OK;
            }

        } else {
            $params['exclude_group'] =  $this->_safeGet($params, 'exclude_group', false);
            $params['get_descriptions'] = $this->_safeGet($params, 'get_descriptions', true);
            $params['plain'] = $this->_safeGet($params, 'plain', true);
            $params['variants'] = $this->_safeGet($params, 'variants', false);

            list($data) = fn_get_product_features($params, 0, $lang_code);
            $status = Response::STATUS_OK;
        }

        return array(
            'status' => $status,
            'data' => $data
        );
    }

    public function create($params)
    {
        $status = Response::STATUS_BAD_REQUEST;
        $data = array();

        unset($params['category_id']);

        $feature_id = fn_update_product_feature($params, 0);

        if ($feature_id) {
            $status = Response::STATUS_CREATED;
            $data = array(
                'feature_id' => $feature_id,
            );
        }

        return array(
            'status' => $status,
            'data' => $data
        );
    }

    public function update($id, $params)
    {
        fn_define('NEW_FEATURE_GROUP_ID', 'OG');
        $status = Response::STATUS_BAD_REQUEST;
        $data = array();
        unset($params['feature_id']);

        if (!empty($params['variants'])) {
            list($variants) = fn_get_product_feature_variants(array('feature_id' => $id));
            $params['original_var_ids'] = implode(',', array_keys($variants));
        }

        $lang_code = $this->_safeGet($params, 'lang_code', DEFAULT_LANGUAGE);
        $feature_id = fn_update_product_feature($params, $id, $lang_code);

        if ($feature_id) {
            $status = Response::STATUS_OK;
            $data = array(
                'feature_id' => $feature_id
            );
        }

        return array(
            'status' => $status,
            'data' => $data
        );
    }

    public function delete($id)
    {
        $data = array();
        $status = Response::STATUS_BAD_REQUEST;

        if (fn_delete_feature($id)) {
            $status = Response::STATUS_OK;
            $data['message'] = 'Ok';
        }

        return array(
            'status' => $status,
            'data' => $data
        );
    }

    public function priveleges()
    {
        return array(
            'create' => 'manage_catalog',
            'update' => 'manage_catalog',
            'delete' => 'manage_catalog',
            'index'  => 'view_catalog'
        );
    }

}
