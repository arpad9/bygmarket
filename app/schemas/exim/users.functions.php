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

if (fn_allowed_for('ULTIMATE')) {
    function fn_exim_get_company_name($store_name)
    {
        return fn_get_company_name($store_name);
    }

    function fn_import_set_user_company_id(&$import_data, &$pattern)
    {
        $pattern['key'][] = 'company_id';
        $skip_record_notification = false;

        foreach ($import_data as $key => $data) {
            $import_data[$key]['user_type'] = !empty($import_data[$key]['user_type']) ? $import_data[$key]['user_type'] : 'C';
            if (!empty($import_data[$key]['user_type']) && $import_data[$key]['user_type'] != 'A' || empty($import_data[$key]['user_type'])) {
                $import_data[$key]['company_id'] = Registry::ifGet('runtime.company_id', fn_get_company_id_by_name($import_data[$key]['company_id']));
            } else {
                $import_data[$key]['company_id'] = 0;
            }
            if ('company_id' == array_search(false, $import_data[$key], true)) {
                unset($import_data[$key]);
                $skip_record_notification = true;
            }
        }
        if ($skip_record_notification) {
            fn_set_notification('W', __('warning'), __('text_skip_customer_record_notification'));
        }
    }

    function fn_set_allowed_company_ids(&$pattern, &$export_fields, &$options, &$conditions, &$joins, &$table_fields, &$processes)
    {
        if (Registry::get('runtime.company_id')) {
            $company_customers_ids = implode(',', db_get_fields("SELECT user_id FROM ?:orders WHERE company_id = ?i", Registry::get('runtime.company_id')));
            if (Registry::get('settings.Stores.share_users') == 'Y' && !empty($company_customers_ids)) {
                $conditions[] = "(users.company_id = " . Registry::get('runtime.company_id') . " OR users.user_id IN ($company_customers_ids))";
            } else {
                $conditions[] = "users.company_id = " . Registry::get('runtime.company_id');
            }
            $conditions[] = 'users.user_type = "C"';
        }
    }

    function fn_import_check_user_company_id(&$primary_object_id, &$object, &$pattern, &$options, &$processed_data, &$processing_groups, &$skip_record)
    {
        if (!empty($primary_object_id) && ((Registry::get('runtime.company_id') && $primary_object_id['company_id'] != Registry::get('runtime.company_id')) || (!Registry::get('runtime.company_id') && $primary_object_id['company_id'] != $object['company_id']))) {
            if (Registry::get('settings.Stores.share_users') == 'Y') {
                $processed_data['S']++;
                $skip_record = true;
            } elseif (Registry::get('settings.Stores.share_users') == 'N') {
                unset($primary_object_id);
            }
        }
        if (Registry::get('runtime.company_id') && !$skip_record) {
            if (fn_check_user_type_admin_area($object)) {
                fn_set_notification('W', __('warning'), __('ult_cant_import_admins'));
                $skip_record = true;
                $processed_data['S']++;
            }
        }
    }
}

function fn_exim_process_password($user_data, $skip_record)
{
    $password = '';

    if (strlen($user_data['password']) == 32) {
        $password = $user_data['password'];
    } else {
        if (!isset($user_data['salt']) || empty($user_data['salt'])) {
            $password = md5($user_data['password']);
        } else {
            $password = fn_generate_salted_password($user_data['password'], $user_data['salt']);
        }
    }

    return $password;
}

function fn_exim_get_extra_fields($user_id, $lang_code = CART_LANGUAGE)
{
    $fields = array();

    $_user = db_get_hash_single_array("SELECT d.description, f.value FROM ?:profile_fields_data as f LEFT JOIN ?:profile_field_descriptions as d ON d.object_id = f.field_id AND d.object_type = 'F' AND d.lang_code = ?s WHERE f.object_id = ?i AND f.object_type = 'U'", array('description', 'value'), $lang_code, $user_id);

    $_profile = db_get_hash_single_array("SELECT d.description, f.value FROM ?:profile_fields_data as f LEFT JOIN ?:profile_field_descriptions as d ON d.object_id = f.field_id AND d.object_type = 'F' AND d.lang_code = ?s LEFT JOIN ?:user_profiles as p ON f.object_id = p.profile_id AND f.object_type = 'P' WHERE p.user_id = ?i", array('description', 'value'), $lang_code, $user_id);

    if (!empty($_user)) {
        $fields['user'] = $_user;
    }
    if (!empty($_profile)) {
        $fields['profile'] = $_profile;
    }

    if (!empty($fields)) {
        return fn_exim_json_encode($fields);
    }

    return '';
}

function fn_exim_set_extra_fields($data, $user_id)
{
    $data = json_decode($data, true);

    if (is_array($data) && !empty($data)) {
        foreach ($data as $type => $_data) {
            foreach ($_data as $field => $value) {
                // Check if field is exist
                $field_id = db_get_field("SELECT object_id FROM ?:profile_field_descriptions WHERE description = ?s AND object_type = 'F' LIMIT 1", $field);
                if (!empty($field_id)) {
                    $update = array(
                        'object_id' => (($type == 'user') ? $user_id : (db_get_field("SELECT profile_id FROM ?:user_profiles WHERE user_id = ?i LIMIT 1", $user_id))),
                        'object_type' => (($type == 'user') ? 'U' : 'P'),
                        'field_id' => $field_id,
                        'value' => $value
                    );

                    db_query('REPLACE INTO ?:profile_fields_data ?e', $update);
                }
            }
        }

        return true;
    }

    return false;
}

if (!fn_allowed_for('ULTIMATE:FREE')) {
function fn_exim_get_usergroups($user_id)
{
    $pair_delimiter = ':';
    $set_delimiter = '; ';

    $result = array();
    $usergroups = db_get_array("SELECT usergroup_id, status FROM ?:usergroup_links WHERE user_id = ?i", $user_id);
    if (!empty($usergroups)) {
        foreach ($usergroups as $ug) {
            $result[] = $ug['usergroup_id'] . $pair_delimiter . $ug['status'];
        }
    }

    return !empty($result) ? implode($set_delimiter, $result) : '';
}

function fn_exim_set_usergroups($user_id, $data)
{
    $pair_delimiter = ':';
    $set_delimiter = '; ';

    db_query("DELETE FROM ?:usergroup_links WHERE user_id = ?i", $user_id);
    if (!empty($data)) {
        $usergroups = explode($set_delimiter, $data);
        if (!empty($usergroups)) {
            foreach ($usergroups as $ug) {
                $ug_data = explode($pair_delimiter, $ug);
                if (is_array($ug_data)) {
                    // Check if user group exists
                    $ug_id = db_get_field("SELECT usergroup_id FROM ?:usergroups WHERE usergroup_id = ?i", $ug_data[0]);
                    if (!empty($ug_id)) {
                        $_data = array(
                            'user_id' => $user_id,
                            'usergroup_id' => $ug_id,
                            'status' => $ug_data[1]
                        );
                        db_query('REPLACE INTO ?:usergroup_links ?e', $_data);
                    }
                }
            }
        }
    }

    return true;
}
}
