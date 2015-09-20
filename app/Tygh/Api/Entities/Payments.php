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

use Tygh\Registry;
use Tygh\Api\AEntity;
use Tygh\Api\Response;

class Payments extends AEntity
{

    public function index($id = 0, $params = array())
    {
        $lang_code = $this->_safeGet($params, 'lang_code', DEFAULT_LANGUAGE);

        if (!empty($id)) {
            $data = fn_get_payment_method_data($id, $lang_code);

            if (empty($data)) {
                $status = Response::STATUS_NOT_FOUND;
            } else {
                $status = Response::STATUS_OK;
            }

        } else {
            $data = fn_get_payments($lang_code);
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

        $params['company_id'] = Registry::get('runtime.company_id');

        if (!empty($params['payment']) && $params['company_id'] != 0) {

            $payment_id = fn_update_payment($params, 0);

            if ($payment_id) {
                $status = Response::STATUS_CREATED;
                $data = array(
                    'payment_id' => $payment_id,
                );
            }
        }

        return array(
            'status' => $status,
            'data' => $data
        );
    }

    public function update($id, $params)
    {
        $status = Response::STATUS_BAD_REQUEST;
        $data = array();

        $lang_code = $this->_safeGet($params, 'lang_code', DEFAULT_LANGUAGE);
        $payment_id = fn_update_payment($params, $id, $lang_code);

        if ($payment_id) {
            $status = Response::STATUS_OK;
            $data = array(
                'payment_id' => $payment_id
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

        if (fn_delete_payment($id)) {
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
            'create' => 'manage_payments',
            'update' => 'manage_payments',
            'delete' => 'manage_payments',
            'index'  => 'view_payments'
        );
    }

}
