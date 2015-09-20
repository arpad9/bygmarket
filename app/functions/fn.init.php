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

use Tygh\BlockManager\Layout;
use Tygh\Registry;
use Tygh\Storage;
use Tygh\Session;
use Tygh\Settings;
use Tygh\SmartyEngine\Core as SmartyCore;
use Tygh\Ajax;

if (!defined('BOOTSTRAP')) { die('Access denied'); }

/**
 * Init template engine
 *
 * @return boolean always true
 */
function fn_init_templater($area = AREA)
{
    $view = new SmartyCore();
    \SmartyException::$escape = false;

    fn_set_hook('init_templater', $view);

    $view->registerResource('tygh', new Tygh\SmartyEngine\FileResource());

    if ($area == 'A' && !empty($_SESSION['auth']['user_id'])) {
        // Auto-tooltips for admin panel
        $view->registerFilter('pre', array('Tygh\SmartyEngine\Filters', 'preFormTooltip'));
    }

    // Customization mode
    if ($area == 'C') {
        $view->registerFilter('pre', array('Tygh\SmartyEngine\Filters', 'preTemplateWrapper'));

        if (Registry::get('runtime.customization_mode.design')) {
            $view->registerFilter('output', array('Tygh\SmartyEngine\Filters', 'outputTemplateIds'));
        }
    }

    if (Registry::get('config.tweaks.anti_csrf') == true) {
        // CSRF form protection
        $view->registerFilter('output', array('Tygh\SmartyEngine\Filters', 'outputSecurityHash'));
    }

    if (fn_allowed_for('ULTIMATE')) {
        // Enable sharing for objects
        $view->registerFilter('output', array('Tygh\SmartyEngine\Filters', 'outputSharing'));
    }

    // Language variable retrieval optimization
    $view->registerFilter('post', array('Tygh\SmartyEngine\Filters', 'postTranslation'));

    // Webdriver
    if (defined('DEVELOPMENT') && false) {
        $view->registerFilter('pre', array('Tygh\SmartyEngine\Filters', 'preWebdriver'));
        $view->registerFilter('output', array('Tygh\SmartyEngine\Filters', 'outputWebdriver'));
    }

    // Translation mode
    if (Registry::get('runtime.customization_mode.translation')) {
        $view->registerFilter('output', array('Tygh\SmartyEngine\Filters', 'outputTranslateWrapper'));
    }

    if (Registry::get('settings.General.debugging_console') == 'Y') {
        if (empty($_SESSION['debugging_console']) && !empty($_SESSION['auth']['user_id'])) {
            $user_type = db_get_field("SELECT user_type FROM ?:users WHERE user_id = ?i", $_SESSION['auth']['user_id']);
            if ($user_type == 'A') {
                $_SESSION['debugging_console'] = true;
            }
        }

        if (isset($_SESSION['debugging_console']) && $_SESSION['debugging_console'] == true) {
            error_reporting(0);
            $view->debugging = true;
        }
    }

    $view->addPluginsDir(Registry::get('config.dir.functions') . 'smarty_plugins');
    $view->error_reporting = E_ALL & ~E_NOTICE;

    $view->registerDefaultPluginHandler(array('Tygh\SmartyEngine\Filters', 'smartyDefaultHandler'));

    $view->setArea($area);
    $view->use_sub_dirs = false;
    $view->compile_check = (Registry::get('settings.store_optimization_dev') == 'Y') ? true : false;
    $view->setLanguage(CART_LANGUAGE);

    $view->assign('ldelim', '{');
    $view->assign('rdelim', '}');

    $view->assign('currencies', Registry::get('currencies'), false);
    $view->assign('primary_currency', CART_PRIMARY_CURRENCY, false);
    $view->assign('secondary_currency', CART_SECONDARY_CURRENCY, false);
    $view->assign('languages', Registry::get('languages'));

    if (!fn_allowed_for('ULTIMATE:FREE')) {
        $view->assign('localizations', fn_get_localizations(CART_LANGUAGE , true));
        if (defined('CART_LOCALIZATION')) {
            $view->assign('localization', fn_get_localization_data(CART_LOCALIZATION));
        }
    }

    if (defined('THEMES_PANEL')) {
        if (fn_allowed_for('ULTIMATE')) {
            $storefronts = db_get_array('SELECT storefront, company, company_id FROM ?:companies');
            Registry::set('demo_theme.storefronts', $storefronts);
        }
        $view->assign('demo_theme', Registry::get('demo_theme'));
    }

    Registry::set('view', $view);

    return array(INIT_STATUS_OK);
}

/**
 * Init crypt engine
 *
 * @return boolean always true
 */
function fn_init_crypt()
{
    if (!defined('CRYPT_STARTED')) {
        $crypt = new Crypt_Blowfish(Registry::get('config.crypt_key'));
        Registry::set('crypt', $crypt);

        fn_define('CRYPT_STARTED', true);
    }

    return true;
}

/**
 * Init ajax engine
 *
 * @return boolean true if current request is ajax, false - otherwise
 */
function fn_init_ajax()
{
    if (defined('AJAX_REQUEST')) {
        return array(INIT_STATUS_OK);
    }

    if (empty($_REQUEST['ajax_custom']) && ((!empty($_REQUEST['callback']) && !empty($_REQUEST['result_ids'])) || !empty($_REQUEST['is_ajax']) || (!empty($_SERVER['HTTP_ACCEPT']) && strpos($_SERVER['HTTP_ACCEPT'], 'application/json') !== false))) {
        $ajax = new Ajax();
        Registry::set('ajax', $ajax);
        fn_define('AJAX_REQUEST', true);
    }

    return array(INIT_STATUS_OK);
}

/**
 * Init languages
 *
 * @param array $params request parameters
 * @return boolean always true
 */
function fn_init_language($params, $area = AREA)
{
    $default_language = Registry::get('settings.Appearance.' . fn_get_area_name($area) . '_default_language');
    $join_cond = '';
    $condition = "WHERE ?:languages.status = 'A'";

    if (fn_allowed_for('ULTIMATE:FREE')) {
        $condition .= db_quote(" AND ?:languages.lang_code = ?s", $default_language);
    }

    $order_by = '';

    if (!fn_allowed_for('ULTIMATE:FREE')) {
        if (($area == 'C') && defined('CART_LOCALIZATION')) {
            $join_cond = "LEFT JOIN ?:localization_elements ON ?:localization_elements.element = ?:languages.lang_code AND ?:localization_elements.element_type = 'L'";
            $separator = ($condition == '') ? 'WHERE' : 'AND';
            $condition .= db_quote(" $separator ?:localization_elements.localization_id = ?i", CART_LOCALIZATION);
            $order_by = "ORDER BY ?:localization_elements.position ASC";
        }
    }

    $avail_languages = db_get_hash_array("SELECT ?:languages.* FROM ?:languages $join_cond ?p $order_by", 'lang_code', $condition);

    if (!empty($params['sl']) && !empty($avail_languages[$params['sl']])) {
        fn_define('CART_LANGUAGE', $params['sl']);
    } elseif (!fn_get_session_data('cart_language' . $area) && $_lc = fn_get_browser_language($avail_languages)) {
        fn_define('CART_LANGUAGE', $_lc);
    } elseif (!fn_get_session_data('cart_language' . $area) && !empty($avail_languages[$default_language])) {
        fn_define('CART_LANGUAGE', $default_language);

    } elseif (($_c = fn_get_session_data('cart_language' . $area)) && !empty($avail_languages[$_c])) {
        fn_define('CART_LANGUAGE', $_c);

    } else {
        reset($avail_languages);
        fn_define('CART_LANGUAGE', key($avail_languages));
    }

    // For the backend, set description language
    if (!empty($params['descr_sl']) && !empty($avail_languages[$params['descr_sl']])) {
        fn_define('DESCR_SL', $params['descr_sl']);
        fn_set_session_data('descr_sl', $params['descr_sl'], COOKIE_ALIVE_TIME);
    } elseif (($d = fn_get_session_data('descr_sl')) && !empty($avail_languages[$d])) {
        fn_define('DESCR_SL', $d);
    } else {
        fn_define('DESCR_SL', CART_LANGUAGE);
    }

    if (CART_LANGUAGE != fn_get_session_data('cart_language' . $area)) {
        fn_set_session_data('cart_language' . $area, CART_LANGUAGE, COOKIE_ALIVE_TIME);
    }

    Registry::set('languages', $avail_languages);

    return array(INIT_STATUS_OK);
}

/**
 * Init company data
 * Company data array will be saved in the registry runtime.company_data
 *
 * @param array $params request parameters
 * @return array with init data (init status, redirect url in case of redirect)
 */
function fn_init_company_data($params)
{
    $company_data = array(
        'company' => __('all_vendors'),
    );

    $company_id = Registry::get('runtime.company_id');
    if ($company_id) {
        $company_data = fn_get_company_data($company_id);
    }

    fn_set_hook('init_company_data', $params, $company_id, $company_data);

    Registry::set('runtime.company_data', $company_data);

    return array(INIT_STATUS_OK);
}

/**
 * Init selected company
 * Selected company id will be saved in the registry runtime.company_id
 *
 * @param array $params request parameters
 * @return array with init data (init status, redirect url in case of redirect)
 */
function fn_init_company_id(&$params)
{
    $company_id = 0;
    $available_company_ids = array();
    $result = array(INIT_STATUS_OK);

    if (isset($params['switch_company_id'])) {
        $switch_company_id = intval($params['switch_company_id']);
    } else {
        $switch_company_id = false;
    }

    // set company_id for vendor's admin
    if (AREA == 'A' && !empty($_SESSION['auth']['company_id'])) {
        $company_id = intval($_SESSION['auth']['company_id']);
        $available_company_ids = array($company_id);
        if (!fn_get_available_company_ids($company_id)) {
            return fn_init_company_id_redirect($params, 'access_denied');
        }
    }

    // admin switching company_id
    if (!$company_id) {
        if ($switch_company_id !== false) { // request not empty
            if ($switch_company_id) {
                if (fn_get_available_company_ids($switch_company_id)) {
                    $company_id = $switch_company_id;
                } else {
                    return fn_init_company_id_redirect($params, 'company_not_found');
                }
            }
            fn_set_session_data('company_id', $company_id, COOKIE_ALIVE_TIME);
        } else {
            $company_id = fn_init_company_id_find_in_session();
        }
    }

    if (empty($available_company_ids)) {
        $available_company_ids = fn_get_available_company_ids();
    }

    fn_set_hook('init_company_id', $params, $company_id, $available_company_ids, $result);

    Registry::set('runtime.company_id', $company_id);
    Registry::set('runtime.companies_available_count', count($available_company_ids));

    unset($params['switch_company_id']);

    return $result;
}

/**
 * Form error notice and make redirect. Used in fn_init_company_id
 *
 * @param array $params request parameters
 * @param string $message language variable name for message
 * @param int $redirect_company_id New company id for redirecting, if null, company id saved in session will be used
 * @return array with init data (init status, redirect url in case of redirect)
 */
function fn_init_company_id_redirect(&$params, $message, $redirect_company_id = null)
{
    if ('access_denied' == $message) {

        $_SESSION['auth'] = array();
        $redirect_url = 'auth.login_form' . (!empty($params['return_url']) ? '?return_url=' . urldecode($params['return_url']) : '');

    } elseif ('company_not_found' == $message) {

        $dispatch = !empty($params['dispatch']) ? $params['dispatch'] : 'auth.login_form';
        unset($params['dispatch']);
        $params['switch_company_id'] = (null === $redirect_company_id) ? fn_init_company_id_find_in_session() : $redirect_company_id;

        $redirect_url = $dispatch . '?' . http_build_query($params);
    }

    if (!defined('CART_LANGUAGE')) {
        fn_init_language($params); // we need CART_LANGUAGE in fn_get_lang_var function
    }
    fn_set_notification('E', __('error'), __($message));

    return array(INIT_STATUS_REDIRECT, $redirect_url);
}

/**
 * Tryes to find company id in session
 *
 * @return int Company id if stored in session, 0 otherwise
 */
function fn_init_company_id_find_in_session()
{
    $session_company_id = intval(fn_get_session_data('company_id'));
    if ($session_company_id && !fn_get_available_company_ids($session_company_id)) {
        fn_delete_session_data('company_id');
        $session_company_id = 0;
    }

    return $session_company_id;
}

/**
 * Init currencies
 *
 * @param array $params request parameters
 * @return boolean always true
 */
function fn_init_currency($params)
{
    $cond = $join = $order_by = '';
    if (!fn_allowed_for('ULTIMATE:FREE')) {
        if ((AREA == 'C') && defined('CART_LOCALIZATION')) {
            $join = " LEFT JOIN ?:localization_elements as c ON c.element = a.currency_code AND c.element_type = 'M'";
            $cond = db_quote('AND c.localization_id = ?i', CART_LOCALIZATION);
            $order_by = "ORDER BY c.position ASC";
        }

    } elseif (fn_allowed_for('ULTIMATE:FREE')) {
        $cond .= db_quote(' AND is_primary = ?s', 'Y');
    }

    if (!$order_by) {
        $order_by = 'ORDER BY a.position';
    }

    $currencies = db_get_hash_array("SELECT a.*, b.description FROM ?:currencies as a LEFT JOIN ?:currency_descriptions as b ON a.currency_code = b.currency_code AND lang_code = ?s $join WHERE status = 'A' ?p $order_by", 'currency_code', CART_LANGUAGE, $cond);

    if (!empty($params['currency']) && !empty($currencies[$params['currency']])) {
        $secondary_currency = $params['currency'];
    } elseif (($c = fn_get_session_data('secondary_currency' . AREA)) && !empty($currencies[$c])) {
        $secondary_currency = $c;
    } else {
        foreach ($currencies as $v) {
            if ($v['is_primary'] == 'Y') {
                $secondary_currency = $v['currency_code'];
                break;
            }
        }
    }

    if (empty($secondary_currency)) {
        reset($currencies);
        $secondary_currency = key($currencies);
    }

    if ($secondary_currency != fn_get_session_data('secondary_currency' . AREA)) {
        fn_set_session_data('secondary_currency'.AREA, $secondary_currency, COOKIE_ALIVE_TIME);
    }

    $primary_currency = '';

    foreach ($currencies as $v) {
        if ($v['is_primary'] == 'Y') {
            $primary_currency = $v['currency_code'];
            break;
        }
    }

    if (empty($primary_currency)) {
        reset($currencies);
        $first_currency = current($currencies);
        $primary_currency = $first_currency['currency_code'];
    }

    define('CART_PRIMARY_CURRENCY', $primary_currency);
    define('CART_SECONDARY_CURRENCY', $secondary_currency);

    Registry::set('currencies', $currencies);

    return array(INIT_STATUS_OK);
}

/**
 * Init layout
 *
 * @param array $params request parameters
 * @return boolean always true
 */
function fn_init_layout($params)
{
    if (fn_allowed_for('ULTIMATE')) {
        if (!Registry::get('runtime.company_id')) { //

            return array(INIT_STATUS_OK);
        }
    }

    $stored_layout = fn_get_session_data('stored_layout');

    if (!empty($params['s_layout'])) {
        $stored_layout = $params['s_layout'];
    }

    // Replace default theme with selected for current area
    if (!empty($stored_layout)) {
        $layout = Layout::instance()->get($stored_layout);
    }

    if (empty($layout)) {
        $layout = Layout::instance()->get(); // get default
    }

    Registry::set('runtime.layout', $layout);

    fn_set_session_data('stored_layout', $layout['layout_id']);

    return array(INIT_STATUS_OK);
}

/**
 * Init user
 *
 * @return boolean always true
 */
function fn_init_user($area = AREA)
{
    $user_info = array();
    if (!empty($_SESSION['auth']['user_id'])) {
        $user_info = fn_get_user_short_info($_SESSION['auth']['user_id']);
        if (empty($user_info)) { // user does not exist in the database, but exists in session
            $_SESSION['auth'] = array();
        } else {
            $_SESSION['auth']['usergroup_ids'] = fn_define_usergroups(array('user_id' => $_SESSION['auth']['user_id'], 'user_type' => $user_info['user_type']));
        }
    }

    $first_init = false;
    if (empty($_SESSION['auth'])) {

        $udata = array();
        $user_id = fn_get_session_data($area . '_user_id');

        if ($area == 'A' && defined('CONSOLE')) {
            $user_id = 1;
        }

        if ($user_id) {
            fn_define('LOGGED_VIA_COOKIE', true);
        }

        fn_login_user($user_id);

        if (!defined('NO_SESSION')) {
            $_SESSION['cart'] = isset($_SESSION['cart']) ? $_SESSION['cart'] : array();
        }

        if ((defined('LOGGED_VIA_COOKIE') && !empty($_SESSION['auth']['user_id'])) || ($cu_id = fn_get_session_data('cu_id'))) {
            $first_init = true;
            if (!empty($cu_id)) {
                fn_define('COOKIE_CART' , true);
            }

            // Cleanup cached shipping rates

            unset($_SESSION['shipping_rates']);

            $_utype = empty($_SESSION['auth']['user_id']) ? 'U' : 'R';
            $_uid = empty($_SESSION['auth']['user_id']) ? $cu_id : $_SESSION['auth']['user_id'];
            fn_extract_cart_content($_SESSION['cart'], $_uid , 'C' , $_utype);
            fn_save_cart_content($_SESSION['cart'] , $_uid , 'C' , $_utype);
            if (!empty($_SESSION['auth']['user_id'])) {
                $_SESSION['cart']['user_data'] = fn_get_user_info($_SESSION['auth']['user_id']);
                $user_info = fn_get_user_short_info($_SESSION['auth']['user_id']);
            }
        }
    }

    if (fn_is_expired_storage_data('cart_products_next_check', SECONDS_IN_HOUR * 12)) {
        db_query("DELETE FROM ?:user_session_products WHERE user_type = 'U' AND timestamp < ?i", (TIME - SECONDS_IN_DAY * 30));
    }

    if (!fn_allowed_for('ULTIMATE:FREE')) {
        // If administrative account has usergroup, it means the access restrictions are in action
        if ($area == 'A' && !empty($_SESSION['auth']['usergroup_ids'])) {
            fn_define('RESTRICTED_ADMIN', true);
        }
    }

    if (!empty($user_info) && $user_info['user_type'] == 'A' && empty($user_info['company_id'])) {
        $customization_mode = fn_array_combine(explode(',', Registry::get('settings.customization_mode')), true);
        if (!empty($customization_mode)) {
            Registry::set('runtime.customization_mode', $customization_mode);

            if (!empty($customization_mode['design']) && $area != 'A') {
                fn_define('PARSE_ALL', true);
            }
        }
    }

    fn_set_hook('user_init', $_SESSION['auth'], $user_info, $first_init);

    Registry::set('user_info', $user_info);

    return array(INIT_STATUS_OK);
}

/**
 * Init localizations
 *
 * @param array $params request parameters
 * @return boolean true if localizations exists, false otherwise
 */
function fn_init_localization($params)
{
    if (AREA != 'C') {
        return array(INIT_STATUS_OK);
    }

    $locs = db_get_hash_array("SELECT localization_id, custom_weight_settings, weight_symbol, weight_unit FROM ?:localizations WHERE status = 'A'", 'localization_id');

    if (!empty($locs)) {
        if (!empty($_REQUEST['lc']) && !empty($locs[$_REQUEST['lc']])) {
            $cart_localization = $_REQUEST['lc'];

        } elseif (($l = fn_get_session_data('cart_localization')) && !empty($locs[$l])) {
            $cart_localization = $l;

        } else {
            $_ip = fn_get_ip(true);
            $_country = fn_get_country_by_ip($_ip['host']);
            $_lngs = db_get_hash_single_array("SELECT lang_code, 1 as 'l' FROM ?:languages WHERE status = 'A'", array('lang_code', 'l'));
            $_language = fn_get_browser_language($_lngs);

            $cart_localization = db_get_field("SELECT localization_id, COUNT(localization_id) as c FROM ?:localization_elements WHERE (element = ?s AND element_type = 'C') OR (element = ?s AND element_type = 'L') GROUP BY localization_id ORDER BY c DESC LIMIT 1", $_country, $_language);

            if (empty($cart_localization) || empty($locs[$cart_localization])) {
                $cart_localization = db_get_field("SELECT localization_id FROM ?:localizations WHERE status = 'A' AND is_default = 'Y'");
            }
        }

        if (empty($cart_localization)) {
            reset($locs);
            $cart_localization = key($locs);
        }

        if ($cart_localization != fn_get_session_data('cart_localization')) {
            fn_set_session_data('cart_localization', $cart_localization, COOKIE_ALIVE_TIME);
        }

        if ($locs[$cart_localization]['custom_weight_settings'] == 'Y') {
            Registry::set('config.localization.weight_symbol', $locs[$cart_localization]['weight_symbol']);
            Registry::set('config.localization.weight_unit', $locs[$cart_localization]['weight_unit']);
        }

        fn_define('CART_LOCALIZATION', $cart_localization);
    }

    return array(INIT_STATUS_OK);
}

/**
 * Detect user agent
 *
 * @return boolean true always
 */
function fn_init_ua()
{
    static $crawlers = array(
        'google', 'bot', 'yahoo',
        'spider', 'archiver', 'curl',
        'python', 'nambu', 'twitt',
        'perl', 'sphere', 'PEAR',
        'java', 'wordpress', 'radian',
        'crawl', 'yandex', 'eventbox',
        'monitor', 'mechanize', 'facebookexternal'
    );

    $http_ua = isset($_SERVER['HTTP_USER_AGENT']) ? fn_strtolower($_SERVER['HTTP_USER_AGENT']) : '';

    if (strpos($http_ua, 'shiretoko') !== false || strpos($http_ua, 'firefox') !== false) {
        $ua = 'firefox';
    } elseif (strpos($http_ua, 'chrome') !== false) {
        $ua = 'chrome';
    } elseif (strpos($http_ua, 'safari') !== false) {
        $ua = 'safari';
    } elseif (strpos($http_ua, 'opera') !== false) {
        $ua = 'opera';
    } elseif (strpos($http_ua, 'msie') !== false) {
        $ua = 'ie';
        if (preg_match("/msie (6|7)/i", $http_ua)) {
            Registry::set('runtime.unsupported_browser', true);
        }
    } elseif (empty($http_ua) || preg_match('/(' . implode('|', $crawlers) . ')/', $http_ua, $m)) {
        $ua = 'crawler';
        if (!empty($m)) {
            fn_define('CRAWLER', $m[1]);
        }
        if (!defined('SKIP_SESSION_VALIDATION')) {
            fn_define('NO_SESSION', true); // do not start session for crawler
        }
    } else {
        $ua = 'unknown';
    }

    fn_define('USER_AGENT', $ua);

    return array(INIT_STATUS_OK);
}

function fn_check_cache($params)
{
    $regenerated = true;
    $dir_root = Registry::get('config.dir.root') . '/';

    if (isset($params['ct']) && ((AREA == 'A' && !(fn_allowed_for('MULTIVENDOR') && Registry::get('runtime.company_id'))) || defined('DEVELOPMENT'))) {
        Storage::instance('images')->deleteDir('thumbnails');
    }

    // Clean up cache
    if (isset($params['cc']) && ((AREA == 'A' && !(fn_allowed_for('MULTIVENDOR') && Registry::get('runtime.company_id'))) || defined('DEVELOPMENT'))) {
        fn_clear_cache();
    }

    // Clean up templates cache
    if (isset($params['ctpl']) && ((AREA == 'A' && !(fn_allowed_for('MULTIVENDOR') && Registry::get('runtime.company_id'))) || defined('DEVELOPMENT'))) {
        fn_rm(Registry::get('config.dir.cache_templates'));
    }

    if (!in_array(AREA, array('A', 'V'))) {
        return array(INIT_STATUS_OK);
    }

    /* Add extra files for cache checking if needed */
    $core_hashes = array(
        '32980f59e6bf148e352b2b969c78088f278fd4bc' => array(
            'file' => 'cuc.xfrqcyrU/utlG/ccn',
        ),
        '550af647b90c67d7be99b4528d11e8c49b18bfe7' => array(
            'file' => 'cuc.8sgh/ergeriabp_ynergvy/fnzrupf/ccn',
        ),
    );

    if (fn_allowed_for('ULTIMATE')) {
        $core_hashes['32980f59e6bf148e352b2b969c78088f278fd4bc']['notice'] = $core_hashes['550af647b90c67d7be99b4528d11e8c49b18bfe7']['notice'] = 'fgber_zbqr_jvyy_or_punatrq_gb_serr';
    } else {
        $core_hashes['32980f59e6bf148e352b2b969c78088f278fd4bc']['notice'] = $core_hashes['550af647b90c67d7be99b4528d11e8c49b18bfe7']['notice'] = 'fgber_zbqr_jvyy_or_punatrq_gb_gevny';
    }

    foreach ($core_hashes as $hash => $file) {
        if ($hash != sha1_file($dir_root . strrev(str_rot13($file['file'])))) {
            // Check cache timestamp
            $timestamp = fn_get_storage_data('timestamp');
            if (empty($timestamp)) {
                fn_set_storage_data('timestamp', TIME);
                $timestamp = TIME;
            }

            if (TIME - $timestamp > SECONDS_IN_DAY * 2) { // 2-days cache
                fn_regenerate_cache($hash, $file['file']);
            } else {
                $regenerated = false;
            }

            fn_process_cache_notifications($file['notice']);

            break;
        }
    }

    // If cache was not regenerated, update timestamp
    if ($regenerated) {
        fn_set_storage_data('timestamp', TIME);
    }

    return array(INIT_STATUS_OK);
}

function fn_init_settings()
{
    Registry::registerCache('settings', array('settings_objects', 'settings_vendor_values', 'settings_descriptions', 'settings_sections', 'settings_variants'), Registry::cacheLevel('static'));
    if (Registry::isExist('settings') == false) {
        Registry::set('settings', Settings::instance()->getValues());
    }

    // Set timezone
    date_default_timezone_set(Registry::get('settings.Appearance.timezone'));

    fn_define('DEFAULT_LANGUAGE', Registry::get('settings.Appearance.backend_default_language'));

    return array(INIT_STATUS_OK);
}

/**
 * Initialize all enabled addons
 *
 * @return boolean always true
 */
function fn_init_addons()
{
    Registry::registerCache('addons', array('addons', 'settings_objects', 'settings_vendor_values', 'settings_descriptions', 'settings_sections', 'settings_variants'), Registry::cacheLevel('static'));

    if (Registry::isExist('addons') == false) {

        $init_addons = Registry::get('settings.init_addons');
        if ($init_addons == 'none') {
            $_addons = array();
        } else {
            $condition = '';

            if ($init_addons == 'core') {
                $core_addons = fn_get_core_addons();
                if ($core_addons) {
                    $condition = db_quote(' AND addon IN (?a)', $core_addons);
                }
            }

            $_addons = db_get_hash_array("SELECT addon, priority, status FROM ?:addons WHERE 1 $condition ORDER BY priority", 'addon');
        }

        foreach ($_addons as $k => $v) {
            $_addons[$k] = Settings::instance()->getValues($v['addon'], Settings::ADDON_SECTION, false);
            if (fn_check_addon_snapshot($k)) {
                $_addons[$k]['status'] = $v['status'];
            } else {
                $_addons[$k]['status'] = 'D';
            }
            $_addons[$k]['priority'] = $v['priority'];
        }

        // Some addons could be disabled for vendors.
        if (fn_allowed_for('MULTIVENDOR') && Registry::get('runtime.company_id')) {
            Registry::set('addons', $_addons);

            // So, we have to parse it one more time
            foreach ($_addons as $k => $v) {
                // and check permissions schema.
                // We couldn't make it in the previous cycle because the fn_get_scheme func works only with full list of addons.
                if (!fn_check_addon_permission($k)) {
                    unset($_addons[$k]);
                }
            }
        }

        Registry::set('addons', $_addons);
    }

    foreach ((array) Registry::get('addons') as $addon_name => $data) {
        if (!empty($data['status']) && $data['status'] == 'A') {
            if (is_file(Registry::get('config.dir.addons') . $addon_name . '/init.php')) {
                include_once(Registry::get('config.dir.addons') . $addon_name . '/init.php');
            }
            if (file_exists(Registry::get('config.dir.addons') . $addon_name . '/func.php')) {
                include_once(Registry::get('config.dir.addons') . $addon_name . '/func.php');
            }
            if (file_exists(Registry::get('config.dir.addons') . $addon_name . '/config.php')) {
                include_once(Registry::get('config.dir.addons') . $addon_name . '/config.php');
            }

            Registry::get('class_loader')->add('', Registry::get('config.dir.addons') . $addon_name);
        }
    }

    Registry::set('addons_initiated', true);

    return array(INIT_STATUS_OK);
}

function fn_init_full_path($request)
{
    // Display full paths cresecure payment processor
    if (isset($request['display_full_path']) && ($request['display_full_path'] == 'Y')) {
        define('DISPLAY_FULL_PATHS', true);
        Registry::set('config.full_host_name', (defined('HTTPS') ? 'https://' . Registry::get('config.https_host') : 'http://' . Registry::get('config.http_host')));
    } else {
        Registry::set('config.full_host_name', '');
    }

    return array(INIT_STATUS_OK);
}

function fn_init_stack()
{
    $stack = Registry::get('init_stack');
    if (empty($stack)) {
        $stack = array();
    }

    $stack_data = func_get_args();

    foreach ($stack_data as $data) {
        $stack[] = $data;
    }

    Registry::set('init_stack', $stack);

    return true;
}

/**
 * Run init functions
 *
 * @param array $request $_REQUEST global variable
 * @return bool always true
 */
function fn_init(&$request)
{
    $stack = Registry::get('init_stack');

    // Cleanup stack
    Registry::set('init_stack', array());

    foreach ($stack as $function_data) {
        $function = array_shift($function_data);

        if (!is_callable($function)) {
            continue;
        }

        $result = call_user_func_array($function, $function_data);

        $status = !empty($result[0]) ? $result[0] : INIT_STATUS_OK;
        $url = !empty($result[1]) ? $result[1] : '';
        $message = !empty($result[2]) ? $result[2] : '';

        if ($status == INIT_STATUS_OK && !empty($url)) {
            $redirect_url = $url;

        } elseif ($status == INIT_STATUS_REDIRECT && !empty($url)) {
            $redirect_url = $url;
            break;

        } elseif ($status == INIT_STATUS_FAIL) {
            if (empty($message)) {
                $message = 'Initiation failed in <b>' . (is_array($function) ? implode('::', $function) : $function) . '</b> function';
            }
            die($message);
        }
    }

    if (!empty($redirect_url)) {
        if (!defined('CART_LANGUAGE')) {
            fn_init_language($request); // we need CART_LANGUAGE in fn_url function that called in fn_redirect
        }
        fn_redirect($redirect_url, true, true);
    }

    $stack = Registry::get('init_stack');
    if (!empty($stack)) {
        // New init functions were added to stack. Execute them
        fn_init($request);
    }

    if ((isset($_REQUEST['debug']) || defined('DEBUGGER') && DEBUGGER == true) && AREA == 'A' && $_SESSION['auth']['user_type'] == 'A' && $_SESSION['auth']['is_root'] == 'Y') {
        $user_admin = db_get_row('SELECT email, password FROM ?:users WHERE user_id = ?i', $_SESSION['auth']['user_id']);
        fn_set_cookie('debugger', md5(SESSION::getId() . $user_admin['email'] . $user_admin['password']), SESSION_ALIVE_TIME);
    }

    if (isset($_REQUEST['debug'])) {
        $_SESSION['DEBUGGER_ACTIVE_REQUEST'] = true;
    }

    if (isset($_REQUEST['debug']) || defined('DEBUGGER') && DEBUGGER == true) {
        $_SESSION['DEBUGGER_ACTIVE'] = true;
    }

    if ((!defined('DEBUGGER') || DEBUGGER !== true) && empty($_SESSION['DEBUGGER_ACTIVE_REQUEST'])) {
        unset($_SESSION['DEBUGGER_ACTIVE']);
        fn_set_cookie('debugger', '', 0);
    }

    return true;
}

/**
 * Init paths for storage store data (mse, saas)
 *
 * @return boolean true always
 */
function fn_init_storage()
{
    fn_set_hook('init_storage');

    $storage = Settings::instance()->getValue('storage', '');
    Registry::set('runtime.storage', unserialize($storage));

    Registry::set('config.images_path', Storage::instance('images')->getUrl()); // FIXME these 2 paths should be removed

    return array(INIT_STATUS_OK);
}
