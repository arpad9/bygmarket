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

    fn_trusted_vars("lang_data", "new_lang_data");

    //
    // Update language variables
    //
    if ($mode == 'm_update_variables') {
        if (is_array($_REQUEST['lang_data'])) {
            fn_update_lang_var($_REQUEST['lang_data']);
        }
    }

    //
    // Delete language variables
    //
    if ($mode == 'm_delete_variables') {
        if (!empty($_REQUEST['names'])) {
            fn_delete_language_variables($_REQUEST['names']);
        }
    }

    //
    // Add new language variable
    //
    if ($mode == 'update_variables') {
        if (!empty($_REQUEST['new_lang_data'])) {
            $params = array('clear' => false);
            foreach (fn_get_translation_languages() as $lc => $_v) {
                fn_update_lang_var($_REQUEST['new_lang_data'], $lc, $params);
            }
        }
    }

     //
    // Delete languages
    //
    if ($mode == 'm_delete') {

        if (!empty($_REQUEST['lang_ids'])) {
            fn_delete_languages($_REQUEST['lang_ids']);
        }
    }

    if (!fn_allowed_for('ULTIMATE:FREE')) {
        //
        // Update languages
        //
        if ($mode == 'm_update') {

            if (!Registry::get('runtime.company_id')) {
                if (!empty($_REQUEST['update_language'])) {
                    foreach ($_REQUEST['update_language'] as $lang_id => $data) {
                        fn_update_language($data, $lang_id);
                    }
                }

                fn_save_languages_integrity();
            }
        }

        //
        // Create/update language
        //
        if ($mode == 'update') {

            $lc = false;
            if (!Registry::get('runtime.company_id')) {
                $lc = fn_update_language($_REQUEST['language_data'], $_REQUEST['lang_id']);

                if ($lc !== false) {
                    fn_save_languages_integrity();
                }
            }

            if ($lc == false) {
                fn_delete_notification('changes_saved');
            }
        }
    }
    $q = (empty($_REQUEST['q'])) ? '' : $_REQUEST['q'];

    return array(CONTROLLER_STATUS_OK, "languages.manage?q=$q");
}

//
// Get language variables values
//
if ($mode == 'manage') {

    list($lang_data, $search) = fn_get_language_variables($_REQUEST, Registry::get('settings.Appearance.admin_elements_per_page'));

    Registry::set('navigation.tabs', array (
        'translations' => array (
            'title' => __('translations'),
            'js' => true
        ),
        'languages' => array (
            'title' => __('languages'),
            'js' => true
        ),
    ));

    Registry::get('view')->assign('lang_data', $lang_data);
    Registry::get('view')->assign('search', $search);

    $languages = fn_get_translation_languages(true);
    Registry::get('view')->assign('langs', $languages);
    Registry::get('view')->assign('countries', fn_get_simple_countries(false, DESCR_SL));

} elseif ($mode == 'delete_variable') {

    fn_delete_language_variables($_REQUEST['name']);

    return array(CONTROLLER_STATUS_REDIRECT);

} elseif ($mode == 'update') {
    $lang_data = db_get_row("SELECT ?:languages.* FROM ?:languages WHERE lang_id = ?i",  $_REQUEST['lang_id']);

    Registry::get('view')->assign('lang_data', $lang_data);
    Registry::get('view')->assign('countries', fn_get_simple_countries(false, DESCR_SL));

} elseif ($mode == 'update_status') {
    fn_tools_update_status($_REQUEST);
    fn_save_languages_integrity();
    exit;
}

//
// Delete languages
//
if ($mode == 'delete_language') {

    if (!empty($_REQUEST['lang_id'])) {
        fn_delete_languages($_REQUEST['lang_id']);
    }

    return array(CONTROLLER_STATUS_REDIRECT, "languages.manage?selected_section=languages");
}

/**
 * Updates language
 *
 * @param array $language_data Language data
 * @param string $lang_id language id
 * return string language id
 */
function fn_update_language($language_data, $lang_id)
{
    /**
     * Changes language data before update
     *
     * @param array  $language_data Language data
     * @param string $lang_id       language id
     */
    fn_set_hook('update_language_pre', $language_data, $lang_id);

    $action = false;

    $is_exists = db_get_field("SELECT COUNT(*) FROM ?:languages WHERE lang_code = ?s AND lang_id <> ?i", $language_data['lang_code'], $lang_id);

    if (!empty($is_exists)) {
        fn_set_notification('E', __('error'), __('error_lang_code_exists', array(
            '[code]' => $language_data['lang_code']
        )));

    } elseif (empty($lang_id)) {
        if (!empty($language_data['lang_code']) && !empty($language_data['name'])) {
            $lang_id = db_query("INSERT INTO ?:languages ?e", $language_data);
            $clone_from =  !empty($language_data['from_lang_code']) ? $language_data['from_lang_code'] : CART_LANGUAGE;

            fn_clone_language($language_data['lang_code'], $clone_from);

            $action = 'add';
        }

    } else {
        db_query("UPDATE ?:languages SET ?u WHERE lang_id = ?i", $language_data, $lang_id);

        $action = 'update';
    }

    /**
     * Adds additional actions after language update
     *
     * @param array  $language_data Language data
     * @param string $lang_id       language id
     * @param string $action        Current action ('add', 'update' or bool false if failed to update language)
     */
    fn_set_hook('update_language_post', $language_data, $lang_id, $action);

    return $lang_id;

}

/**
 * Deletes language variablle
 *
 * @param array $names List of language variables go be deleted
 * @return boolean Always true
 */
function fn_delete_language_variables($names)
{
    if (!is_array($names)) {
        $names = array($names);
    }
    fn_set_hook('delete_language_variables', $names);

    if (!empty($names)) {
        db_query("DELETE FROM ?:language_values WHERE name IN (?a)", $names);
    }

    return true;
}

function fn_get_language_variables($params, $items_per_page = 0, $lang_code = DESCR_SL)
{
    // Set default values to input params
    $default_params = array (
        'page' => 1,
        'items_per_page' => $items_per_page
    );

    $params = array_merge($default_params, $params);

    $fields = array(
        'lang.value' => true,
        'lang.name' => true,
    );

    $tables = array(
        '?:language_values as lang',
    );

    $left_join = array();
    $condition = array();

    $condition['param1'] = db_quote('lang.lang_code = ?s', $lang_code);
    if (isset($params['q']) && fn_string_not_empty($params['q'])) {
        $condition['param2'] = db_quote('(lang.name LIKE ?l OR lang.value LIKE ?l)', '%' . trim($params['q']) . '%', '%' . trim($params['q']) . '%');
    }

    fn_set_hook('get_language_variable', $fields, $tables, $left_join, $condition, $params);

    $joins = !empty($left_join) ? ' LEFT JOIN ' . implode(', ', $left_join) : '';

    $limit = '';
    if (!empty($params['items_per_page'])) {
        $params['total_items'] = db_get_field('SELECT COUNT(*) FROM ' . implode(', ', $tables) . $joins . ' WHERE ' . implode(' AND ', $condition));
        $limit = db_paginate($params['page'], $params['items_per_page']);
    }

    $lang_data = db_get_array('SELECT ' . implode(', ', array_keys($fields)) . ' FROM ' . implode(', ', $tables) . $joins . ' WHERE ' . implode(' AND ', $condition) . ' ORDER BY lang.name ' . $limit);

    return array($lang_data, $params);
}
