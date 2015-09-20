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
use Tygh\Less;
use Tygh\Storage;
use Tygh\BlockManager\Layout;

if (!defined('BOOTSTRAP')) { die('Access denied'); }

fn_define('MAX_BACKGROUND_SIZE', 200000);

if ($_SERVER['REQUEST_METHOD'] == 'POST' && Registry::get('config.demo_mode')) {
    // Customer do not have rights to save presets in Demo mode

    fn_set_notification('W', __('warning'), __('error_demo_mode'));
    exit;
}

if (!Registry::get('runtime.customization_mode.theme_editor') && !Registry::get('runtime.customization_mode.design')) {
    fn_set_notification('E', __('error'), __('access_denied'));

    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if ($mode == 'save') {

        $uploaded_data = fn_filter_uploaded_data('backgrounds');
        fn_theme_editor_save_preset($_REQUEST['preset_id'], $_REQUEST['preset'], $uploaded_data);

        fn_attach_image_pairs('logotypes', 'logos');
    }

    return array(CONTROLLER_STATUS_OK, 'theme_editor.view');
}

if ($mode == 'view') {
    if (!empty($_REQUEST['preset_id'])) {
        fn_theme_editor_set_preset($_REQUEST['preset_id']);
    }

    fn_theme_editor($_REQUEST);

    Registry::get('view')->assign('layouts', Layout::instance()->getList());
    Registry::get('view')->assign('layout_data', Layout::instance()->get(Registry::get('runtime.layout.layout_id')));
    Registry::get('view')->assign('theme_url', fn_url(empty($_REQUEST['theme_url']) ? '' : $_REQUEST['theme_url']));

    Registry::get('view')->display('views/theme_editor/view.tpl');
    exit;

} elseif ($mode == 'delete_preset') {

    db_query("DELETE FROM ?:theme_presets WHERE preset_id = ?i", $_REQUEST['preset_id']);

    return array(CONTROLLER_STATUS_OK, 'theme_editor.view');

} elseif ($mode == 'get_css') {

    $css_filename = !empty($_REQUEST['css_filename']) ? fn_basename($_REQUEST['css_filename']) : '';

    $content = '';
    if (!empty($css_filename)) {

        list($css_content, $less_content) = explode('#LESS#', fn_get_contents(fn_get_cache_path(false) . 'theme_editor/' . $css_filename));

        $data = array();

        // If theme ID passed, set default theme
        if (!empty($_REQUEST['preset_id'])) {
            fn_theme_editor_set_preset($_REQUEST['preset_id']);

        // If theme elements passed, get them
        } elseif (!empty($_REQUEST['preset']['data'])) {

            $data = $_REQUEST['preset']['data'];
        }

        $less = new Less();
        $less->editorVars($data);

        $content = Less::parseUrls($css_content . $less->parse($less_content), Registry::get('config.dir.root'), fn_get_theme_path('[themes]/[theme]/media'));

        // remove external fonts to avoid flickering when styles are reloaded
        $content = preg_replace("/@font-face \{.*?\}/s", '', $content);
    }

    header('content-type: text/css');
    if (ini_get('zlib.output_compression') == '' && strpos($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip') !== false) {
        ob_start('ob_gzhandler');
    }

    fn_echo($content);
    exit;
} elseif ($mode == 'delete_image') {

    $image = fn_basename($_REQUEST['image']);
    if (!empty($image)) {
        Storage::instance('theme_media')->delete('images/custom/' . $image);
    }

    return array(CONTROLLER_STATUS_OK, 'theme_editor.view');

} elseif ($mode == 'delete_image_data') {
    if (!empty($_REQUEST['image_name']) && !empty($_REQUEST['preset_id'])) {
        $preset_data = db_get_field("SELECT data FROM ?:theme_presets WHERE preset_id = ?i", $_REQUEST['preset_id']);
        if (!empty($preset_data)) {
            $preset_data = unserialize($preset_data);
            unset($preset_data['backgrounds'][$_REQUEST['image_name']]['image_data']);
            unset($preset_data['backgrounds'][$_REQUEST['image_name']]['image_name']);

            db_query("UPDATE ?:theme_presets SET data = ?s WHERE preset_id = ?i", serialize($preset_data), $_REQUEST['preset_id']);

            Storage::instance('statics')->deleteDir('design/');
        }
    }

    return array(CONTROLLER_STATUS_OK, 'theme_editor.view');

} elseif ($mode == 'duplicate') {
    $preset_id = db_query("INSERT INTO ?:theme_presets (data, name, is_default, theme) SELECT data, ?s as name, ?i as is_default, theme FROM ?:theme_presets WHERE preset_id = ?i",
        $_REQUEST['name'], 0, $_REQUEST['preset_id']
    );

    if ($preset_id) {
        fn_theme_editor_set_preset($preset_id);
    }

    return array(CONTROLLER_STATUS_OK, 'theme_editor.view');

} elseif ($mode == 'close') {

    fn_update_customization_mode(array(
        'theme_editor' => 'disable'
    ));

    unset($_SESSION['demo_customize_theme']);

    return array(CONTROLLER_STATUS_OK, 'index.index');

} elseif ($mode == 'disable_design_mode') {
    fn_update_customization_mode(array(
        'design' => 'disable'
    ));

    return array(CONTROLLER_STATUS_OK, 'index.index');
}

function fn_theme_editor_set_preset($preset_id)
{
    db_query("UPDATE ?:bm_layouts SET preset_id = ?i WHERE layout_id = ?i", $preset_id, Registry::get('runtime.layout.layout_id'));
    Registry::set('runtime.layout.preset_id', $preset_id);
    Storage::instance('statics')->deleteDir('design/');

    return true;
}

function fn_theme_editor_save_preset($preset_id, $preset, $uploaded_data = array())
{

    if (!empty($uploaded_data)) {
        foreach ($uploaded_data as $section => $data) {
            if ($data['size'] > MAX_BACKGROUND_SIZE) {
                fn_set_notification('W', __('warning'), __('text_forbidden_uploaded_file_size', array(
                    '[size]' => number_format(MAX_BACKGROUND_SIZE / 1024) . 'Kb'
                )));
                continue;
            }
            $preset['data']['backgrounds'][$section]['image_data'] = 'data:' . fn_get_file_type($data['path']) . ';base64,' . base64_encode(fn_get_contents($data['path']));
            $preset['data']['backgrounds'][$section]['image_name'] = $data['name'];
        }
    }

    if (empty($preset) || empty($preset['data'])) {
        return false;
    }

    if (!empty($preset_id)) {

        db_query("UPDATE ?:theme_presets SET ?u WHERE preset_id = ?i", array(
            'data' => serialize($preset['data'])
        ), $preset_id);
    } else {
        $preset_id = db_query("INSERT INTO ?:theme_presets ?e", array(
            'data' => serialize($preset['data']),
            'name' => $preset['name']
        ));
    }

    fn_theme_editor_set_preset($preset_id);

    return $preset_id;
}

function fn_theme_editor($params, $lang_code = CART_LANGUAGE)
{
    $view = Registry::get('view');

    $view->assign('cse_logo_types', fn_get_logo_types());
    $view->assign('cse_logos', fn_get_logos(Registry::get('runtime.company_id')));

    $theme_name = Registry::get('runtime.layout.theme_name');

    if (!Registry::get('runtime.layout.preset_id')) {
        $default_preset_id = db_get_field('SELECT preset_id FROM ?:theme_presets WHERE is_default = 1 AND theme = ?s LIMIT 1', $theme_name);
        db_query('UPDATE ?:bm_layouts SET preset_id = ?i WHERE layout_id = ?i', $default_preset_id, Registry::get('runtime.layout.layout_id'));
        Registry::set('runtime.layout.preset_id', $default_preset_id);
    }

    // get current preset
    $current_preset = db_get_row('SELECT preset_id, name, data, is_default, theme FROM ?:theme_presets WHERE preset_id = ?i', Registry::get('runtime.layout.preset_id'));

    // get all presets
    $presets_list = db_get_array('SELECT preset_id, name, is_default FROM ?:theme_presets WHERE theme = ?s ORDER BY is_base DESC, is_default DESC, name ASC', $theme_name);

    // get uploaded images
    $images = Storage::instance('theme_media')->getList('images/custom');

    if (empty($current_preset['data'])) {
        $current_preset['data'] = array();
    } else {
        $current_preset['data'] = unserialize($current_preset['data']);
    }

    $path = fn_get_theme_path('[themes]/[theme]/presets/', 'C', Registry::get('runtime.company_id'));
    if (file_exists($path . 'schema.json')) {
        $schema = file_get_contents($path . 'schema.json');
        $schema = json_decode($schema);
        $schema = fn_object_to_array($schema);

    } else {
        $schema = array();
    }

    $sections = array(
        'te_general' => 'theme_editor.general',
        'te_logos' => 'theme_editor.logos',
        'te_colors' => 'theme_editor.colors',
        'te_fonts' => 'theme_editor.fonts',
        'te_backgrounds' => 'theme_editor.backgrounds'
    );

    foreach ($sections as $section_id => $section) {
        if ($section_id == 'te_logos') { // Logos is hardcoded section, no need to define it in schema
            continue;
        }
        $section_id = str_replace('te_', '', $section_id);
        if (!isset($schema[$section_id])) {
            unset($sections['te_' . $section_id]);
        }
    }

    if (empty($params['selected_section']) || !isset($sections[$params['selected_section']])) {
        reset($sections);
        $params['selected_section'] = key($sections);
    }

    $view->assign('selected_section', $params['selected_section']);
    $view->assign('te_sections', $sections);
    $view->assign('props_schema', $schema);
    $view->assign('current_preset', $current_preset);
    $view->assign('presets_list', $presets_list);
}
