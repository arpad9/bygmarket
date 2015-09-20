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

/** Inclusions **/
/** /Inclusions **/

/** Body **/

$section_id = isset($_REQUEST['section_id']) ? intval($_REQUEST['section_id']) : '0';
$link_id = isset($_REQUEST['link_id']) ? intval($_REQUEST['link_id']) : '0';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $suffix = '';

    if ($mode == 'update_sitemap') {
        $section_data = $_REQUEST;

        $section_id = fn_update_sitemap($section_data, $section_id);

        $link_data = array();

        // Add new links
        if (isset($section_data['add_link_data'])) {
            $link_data = array_merge($link_data, $section_data['add_link_data']);
        }

        // Update section links
        if (isset($section_data['link_data'])) {
            $link_data = array_merge($link_data, $section_data['link_data']);
        }

        fn_update_sitemap_links($link_data, $section_id);

        $suffix = ".manage";
    }

    return array(CONTROLLER_STATUS_OK, "sitemap$suffix");
}

// -------------------------------------- GET requests -------------------------------

// Collect section methods data
if ($mode == 'update') {

    if (empty($section_id)) {
        return array(CONTROLLER_STATUS_NO_PAGE);
    }

    $sections = fn_get_sitemap_sections($section_id);

    if (empty($sections)) {
        return array(CONTROLLER_STATUS_DENIED);
    }

    Registry::get('view')->assign('section', reset($sections));

    $links = fn_get_sitemap_links($section_id);
    Registry::get('view')->assign('links', $links);

// Show all section methods
} elseif ($mode == 'manage') {
    $sections = fn_get_sitemap_sections();
    Registry::get('view')->assign('sitemap_sections', $sections);

} elseif ($mode == 'delete_section') {
    if (!empty($section_id)) {
        fn_delete_sitemap_sections((array) $section_id);
    }

    return array(CONTROLLER_STATUS_REDIRECT, "sitemap.manage");

}

/** /Body **/

/**
 * Delete links
 *
 * @param array $link_ids Array links identifier
 */
function fn_delete_sitemap_links($link_ids)
{
    fn_set_hook('sitemap_delete_links', $link_ids);

    if (!empty($link_ids)) {
        db_query("DELETE FROM ?:sitemap_links WHERE link_id IN (?n)", $link_ids);
        db_query("DELETE FROM ?:common_descriptions WHERE object_holder = 'sitemap_links' AND object_id IN (?n)", $link_ids);
    }
}

/**
 * Delete sections
 *
 * @param array $section_ids Array sections identifier
 */
function fn_delete_sitemap_sections($section_ids)
{
    fn_set_hook('sitemap_delete_sections', $section_ids);

    if (!empty($section_ids)) {
            db_query("DELETE FROM ?:sitemap_sections WHERE section_id IN (?n)", $section_ids);
            db_query("DELETE FROM ?:common_descriptions WHERE object_holder = 'sitemap_sections' AND object_id IN (?n)", $section_ids);

            $links = db_get_fields("SELECT link_id FROM ?:sitemap_links WHERE section_id IN (?n)", $section_ids);
            if (!empty($links)) {
                    db_query("DELETE FROM ?:sitemap_links WHERE section_id IN (?n)", $section_ids);
                    db_query("DELETE FROM ?:common_descriptions WHERE object_holder = 'sitemap_links' AND object_id IN (?n)", $links);
            }
    }
}

/**
 * Get sitemap sections
 *
 * @param int $section_id Section identifier
 * @return array $sections
 */
function fn_get_sitemap_sections($section_id = 0)
{
    $section_fields = array(
        's.*',
        'c.object as section'
    );

    $section_tables = array(
        '?:sitemap_sections as s',
    );

    $section_left_join = array(
        db_quote('?:common_descriptions as c ON c.object_id = s.section_id AND c.object_holder = ?s AND c.lang_code = ?s', 'sitemap_sections', DESCR_SL),
    );

    $section_condition = array();
    if (!empty($section_id)) {
        $section_condition = array(
            db_quote('s.section_id = ?i', $section_id),
        );
    }

    fn_set_hook('sitemap_get_sections', $section_fields, $section_tables, $section_left_join, $section_condition);

    $condition = empty($section_condition) ? '' : ' WHERE ' . implode(' AND ', $section_condition);

    $sections = db_get_hash_array('SELECT ' . implode(', ', $section_fields) . ' FROM ' . implode(', ', $section_tables) . ' LEFT JOIN ' . implode(', ', $section_left_join) . $condition . ' ORDER BY position, section', 'section_id');

    return $sections;
}

/**
 * Get sitemap links
 *
 * @param int $section_id Section identifier
 * @return array $links
 */
function fn_get_sitemap_links($section_id)
{
    $links_fields = array(
        'link_id',
        'link_href',
        'section_id',
        'status',
        'position',
        'link_type',
        'description',
        'object as link',
    );

    $links_tables = array(
        '?:sitemap_links',
    );

    $links_left_join = array(
        db_quote("?:common_descriptions ON ?:common_descriptions.object_id = ?:sitemap_links.link_id AND ?:common_descriptions.object_holder = 'sitemap_links' AND ?:common_descriptions.lang_code = ?s", DESCR_SL),
    );

    $links_condition = array(
        db_quote('section_id = ?i', $section_id),
    );

    fn_set_hook('sitemap_get_links', $links_fields, $links_tables, $links_left_join, $links_condition);

    $links = db_get_array('SELECT ' . implode(', ', $links_fields) . ' FROM ' . implode(', ', $links_tables) . ' LEFT JOIN ' . implode(', ', $links_left_join) . ' WHERE ' . implode(' AND ', $links_condition) . ' ORDER BY position, link');

    return $links;
}

/**
 * Create/Update sitemap section
 *
 * @param array $section_data Section update data
 * @param int $section_id Section identifier
 * @return int $section_id
 */
function fn_update_sitemap($section_data, $section_id = 0)
{
    // Add sitemap sections
    if (empty($section_id)) {
        if (Registry::get('runtime.company_id') && !isset($section_data['company_id'])) {
            $section_data['company_id'] = Registry::get('runtime.company_id');
        }

        $section_id = db_query("INSERT INTO ?:sitemap_sections ?e", $section_data);
        if (!empty($section_id)) {

            $_data = array();
            foreach (fn_get_translation_languages() as $lang_code => $_lang_data) {
                $_data[] = array(
                    'object'        => $section_data['section'],
                    'object_id'     => $section_id,
                    'object_holder' => 'sitemap_sections',
                    'lang_code'     => $lang_code
                );
            }
            db_query("INSERT INTO ?:common_descriptions ?m", $_data);

        } else {
            return array(CONTROLLER_STATUS_NO_PAGE);
        }
    } else {
        db_query("UPDATE ?:sitemap_sections SET ?u WHERE section_id = ?i", $section_data, $section_id);
        db_query("UPDATE ?:common_descriptions SET object=?s WHERE object_id = ?i AND lang_code = ?s AND object_holder = 'sitemap_sections'", $section_data['section'], $section_id, DESCR_SL);
    }

    return $section_id;
}

/**
 * Create/Update sitemap links
 *
 * @param array $links_data Links update data
 * @param int $section_id Section identifier
 */
function fn_update_sitemap_links($links_data, $section_id)
{
    $link_ids = array();
    foreach ($links_data as $link_data) {
        if (!empty($link_data['link'])) {

            fn_set_hook('sitemap_update_object', $link_data);

            if (empty($link_data['link_id'])) {

                $link_data['section_id'] = $section_id;

                $link_id = db_query("INSERT INTO ?:sitemap_links ?e", $link_data);
                $link_ids[] = $link_id;

                if (!empty($link_id)) {
                    $_data = array();
                    foreach (fn_get_translation_languages() as $lang_code => $_lang_data) {
                        $_data[] = array(
                            'object'        => $link_data['link'],
                            'object_id'     => $link_id,
                            'object_holder' => 'sitemap_links',
                            'lang_code'     => $lang_code
                        );
                    }
                    db_query("INSERT INTO ?:common_descriptions ?m", $_data);
                }
            } else {
                $link_data['section_id'] = $section_id;
                $link_ids[] = $link_data['link_id'];

                db_query("UPDATE ?:sitemap_links SET ?u WHERE link_id = ?i", $link_data, $link_data['link_id']);
                db_query("UPDATE ?:common_descriptions SET object=?s WHERE object_id = ?i AND lang_code = ?s AND object_holder = 'sitemap_links'", $link_data['link'], $link_data['link_id'], DESCR_SL);
            }
        }
    }

    $obsolete_ids = db_get_fields("SELECT link_id FROM ?:sitemap_links WHERE section_id = ?i AND link_id NOT IN (?n)", $section_id, $link_ids);

    if (!empty($obsolete_ids)) {
        fn_delete_sitemap_links($obsolete_ids);
    }

}
