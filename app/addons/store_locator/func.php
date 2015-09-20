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

if (!defined('BOOTSTRAP')) { die('Access denied'); }

function fn_get_store_locations($params, $items_per_page = 0, $lang_code = CART_LANGUAGE)
{
    $default_params = array (
        'page' => 1,
        'q' => '',
        'match' => 'any',
        'items_per_page' => $items_per_page
    );

    $params = array_merge($default_params, $params);

    $fields = array (
        '?:store_locations.*',
        '?:store_location_descriptions.*',
        '?:country_descriptions.country as country_title'
    );

    $join = db_quote(" LEFT JOIN ?:store_location_descriptions ON ?:store_locations.store_location_id = ?:store_location_descriptions.store_location_id AND ?:store_location_descriptions.lang_code = ?s", $lang_code);

    $join .= db_quote(" LEFT JOIN ?:country_descriptions ON ?:store_locations.country = ?:country_descriptions.code AND ?:country_descriptions.lang_code = ?s", $lang_code);

    $condition = 1;

    if (AREA == 'C') {
        $condition .= " AND status = 'A'";
    }

    // Search string condition for SQL query
    if (!empty($params['q'])) {

        if ($params['match'] == 'any') {
            $pieces = explode(' ', $params['q']);
            $search_type = ' OR ';
        } elseif ($params['match'] == 'all') {
            $pieces = explode(' ', $params['q']);
            $search_type = ' AND ';
        } else {
            $pieces = array($params['q']);
            $search_type = '';
        }

        $_condition = array();
        foreach ($pieces as $piece) {
            $tmp = db_quote("?:store_location_descriptions.name LIKE ?l", "%$piece%"); // check search words

            $tmp .= db_quote(" OR ?:store_location_descriptions.description LIKE ?l", "%$piece%");

            $tmp .= db_quote(" OR ?:store_location_descriptions.city LIKE ?l", "%$piece%");

            $tmp .= db_quote(" OR ?:country_descriptions.country LIKE ?l", "%$piece%");

            $_condition[] = '(' . $tmp . ')';
        }

        $_cond = implode($search_type, $_condition);

        if (!empty($_condition)) {
            $condition .= ' AND (' . $_cond . ') ';
        }

        unset($_condition);
    }

    $condition .= (AREA == 'C' && defined('CART_LOCALIZATION')) ? fn_get_localizations_condition('?:store_locations.localization') : '';

    $sorting = "?:store_locations.position, ?:store_location_descriptions.name";

    $limit = '';
    if (!empty($params['items_per_page'])) {
        $params['total_items'] = db_get_field("SELECT COUNT(?:store_locations.store_location_id) FROM ?:store_locations ?p WHERE ?p", $join, $condition);
        $limit = db_paginate($params['page'], $params['items_per_page']);
    }

    $data = db_get_array('SELECT ?p FROM ?:store_locations ?p WHERE ?p GROUP BY ?:store_locations.store_location_id ORDER BY ?p ?p', implode(', ', $fields), $join, $condition, $sorting, $limit);

    return array($data, $params);

}

function fn_store_locator_google_langs($lang_code)
{
    $supported_langs = array ('en', 'eu', 'ca', 'da', 'nl', 'fi', 'fr', 'gl', 'de', 'el', 'it', 'ja', 'no', 'nn', 'ru' , 'es', 'sv', 'th');

    if (in_array($lang_code, $supported_langs)) {
        return $lang_code;
    }

    return '';
}

function fn_store_locator_get_info()
{
    $text = '<a href="http://code.google.com/apis/maps/signup.html">' . __('singup_google_url') . '</a>';

    return $text;
}
