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

use Tygh\Registry;

if (!defined('BOOTSTRAP')) { die('Access denied'); }

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    //
    // Update currency
    //
    if ($mode == 'update') {
        $currency_id = fn_update_currency($_REQUEST['currency_data'], $_REQUEST['currency_id'], DESCR_SL);
        if (empty($currency_id)) {
            fn_delete_notification('changes_saved');
        }
    }

    return array(CONTROLLER_STATUS_OK, "currencies.manage");
}

// ---------------------- GET routines ---------------------------------------

if ($mode == 'manage') {

    $currencies = db_get_array("SELECT a.*, b.description FROM ?:currencies as a LEFT JOIN ?:currency_descriptions as b ON a.currency_code = b.currency_code AND lang_code = ?s ORDER BY position", DESCR_SL);

    if (fn_allowed_for('ULTIMATE:FREE')) {
        foreach ($currencies as $code => $currency) {
            if ($currency['is_primary'] != 'Y') {
                $currencies[$code]['status'] = 'D';
            } else {
                $currencies[$code]['status'] = 'A';
            }
        }
    }

    Registry::get('view')->assign('currencies_data', $currencies);

} elseif ($mode == 'update') {

    if (!empty($_REQUEST['currency_id'])) {
        $currency = db_get_row("SELECT a.*, b.description FROM ?:currencies as a LEFT JOIN ?:currency_descriptions as b ON a.currency_code = b.currency_code AND lang_code = ?s WHERE a.currency_id = ?s", DESCR_SL, $_REQUEST['currency_id']);

        Registry::get('view')->assign('currency', $currency);
    }
}

if (!fn_allowed_for('ULTIMATE:FREE')) {
    if ($mode == 'delete') {

        if (!empty($_REQUEST['currency_id'])) {
            if ($_REQUEST['currency_id'] != CART_PRIMARY_CURRENCY) {
                $currency_code = db_get_field("SELECT currency_code FROM ?:currencies WHERE currency_id = ?i", $_REQUEST['currency_id']);
                db_query("DELETE FROM ?:currencies WHERE currency_code = ?s", $currency_code);
                db_query("DELETE FROM ?:currency_descriptions WHERE currency_code = ?s", $currency_code);
                fn_set_notification('N', __('notice'), __('currency_deleted'));
            } else {
                fn_set_notification('W', __('warning'), __('base_currency_not_deleted'));
            }
        }

        return array(CONTROLLER_STATUS_REDIRECT, "currencies.manage");
    }
}

function fn_update_currency($currency_data, $currency_id, $lang_code = DESCR_SL)
{
    $currency_data['currency_code'] = strtoupper($currency_data['currency_code']);
    $currency_data['coefficient'] = !empty($currency_data['is_primary']) || !isset($currency_data['coefficient']) ? 1 : $currency_data['coefficient'];

    if (empty($currency_data['coefficient']) || floatval($currency_data['coefficient']) <= 0) {
        fn_set_notification('W', __('warning'), __('currency_rate_greater_than_null'));

        return false;
    }

    $is_exists = db_get_field("SELECT COUNT(*) FROM ?:currencies WHERE currency_code = ?s AND currency_id <> ?i", $currency_data['currency_code'], $currency_id);

    if (!empty($is_exists)) {
        fn_set_notification('E', __('error'), __('error_currency_exists', array(
            '[code]' => $currency_data['currency_code']
        )));

        return false;
    }

    if (isset($currency_data['decimals']) && $currency_data['decimals'] > 2) {
        fn_set_notification('W', __('warning'), __('notice_too_many_decimals', array(
            '[DECIMALS]' => $currency_data['decimals'],
            '[CURRENCY]' => $currency_data['currency_code']
        )));
    }

    if (!empty($currency_data['is_primary'])) {
        db_query("UPDATE ?:currencies SET is_primary = 'N' WHERE is_primary = 'Y'");
    }

    if (empty($currency_id)) {
        $currency_id = db_query("INSERT INTO ?:currencies ?e", $currency_data);
        fn_create_description('currency_descriptions', 'currency_code', $currency_data['currency_code'], $currency_data);
    } else {
        $old_currency_code = db_get_field("SELECT currency_code FROM ?:currencies WHERE currency_id = ?i", $currency_id);
        db_query("UPDATE ?:currencies SET ?u WHERE currency_id = ?i", $currency_data, $currency_id);
        db_query('UPDATE ?:currency_descriptions SET ?u WHERE currency_code = ?s AND lang_code = ?s', $currency_data, $old_currency_code, $lang_code);
    }

    return $currency_id;
}
