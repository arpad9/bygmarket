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
use Tygh\Session;
use Tygh\BlockManager\Location;

if (!defined('BOOTSTRAP')) { die('Access denied'); }

if (!empty($_REQUEST['skey'])) {
    $session_data = fn_get_storage_data('session_' . $_REQUEST['skey'] . '_data');
    fn_set_storage_data('session_' . $_REQUEST['skey'] . '_data', '');

    if (!empty($session_data)) {
        $_SESSION = unserialize($session_data);
        Session::save(Session::getId(), $_SESSION);
    }

    return array(CONTROLLER_STATUS_REDIRECT, fn_query_remove(REAL_URL, 'skey'));
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    return;
}

//
// Check if store is closed
//
if (Registry::get('settings.General.store_mode') == 'Y') {
    if (!empty($_REQUEST['store_access_key'])) {
        $_SESSION['store_access_key'] = $_GET['store_access_key'];
    }

    if (empty($_SESSION['store_access_key']) || $_SESSION['store_access_key'] != Registry::get('settings.General.store_access_key')) {
        return array(CONTROLLER_STATUS_REDIRECT, Registry::get('config.current_location') . '/store_closed.html');
    }
}

if (empty($_REQUEST['product_id']) && empty($_REQUEST['category_id'])) {
    unset($_SESSION['current_category_id']);
}

$dynamic_object = array();
if (!empty($_REQUEST['dynamic_object'])) {
    $dynamic_object = $_REQUEST['dynamic_object'];
}
Registry::get('view')->assign('location_data', Location::instance()->get($_REQUEST['dispatch'], $dynamic_object, CART_LANGUAGE));
Registry::get('view')->assign('current_mode', fn_get_current_mode($_REQUEST));

// Init cart if not set
if (empty($_SESSION['cart'])) {
    fn_clear_cart($_SESSION['cart']);
}

if (!empty($_SESSION['continue_url'])) {
    $_SESSION['continue_url'] = fn_query_remove($_SESSION['continue_url'], 'is_ajax', 'result_ids', 'full_render');
}

if (Registry::get('config.demo_mode') && (!empty($_REQUEST['demo_customize_theme']) && $_REQUEST['demo_customize_theme'] == 'Y' || !empty($_SESSION['demo_customize_theme']))) {
    $_SESSION['demo_customize_theme'] = true;
    Registry::set('runtime.customization_mode.theme_editor', true);

    if (!empty($_REQUEST['demo_customize_theme'])) {
        $current_url = Registry::get('config.current_url');
        $current_url = fn_query_remove($current_url, 'demo_customize_theme');
        
        return array(CONTROLLER_STATUS_REDIRECT, $current_url);
    }
}
