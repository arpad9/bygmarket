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

/*
 * PHP options
 */

// Disable notices displaying
error_reporting(E_ALL ^ E_NOTICE);
if (version_compare(PHP_VERSION, '5.3.0', '>=')) {
    error_reporting(error_reporting() & ~E_DEPRECATED & ~E_STRICT);
}

// Set maximum memory limit
if (PHP_INT_SIZE == 4 && (substr(ini_get('memory_limit'), 0, -1) < "64")) {
  // 32bit PHP
  @ini_set('memory_limit', '64M');
} elseif (PHP_INT_SIZE == 8 && (substr(ini_get('memory_limit'), 0, -1) < "256")) {
  // 64bit PHP
  @ini_set('memory_limit', '256M');
}

// Set maximum time limit for script execution
@set_time_limit(3600);

/*
 * Database connection options
 */
$config['db_host'] = 'localhost';
$config['db_name'] = 'cscart_4p4g';
#$config['db_user'] = 'psuser';
$config['db_user'] = '4profit4good';
$config['db_password'] = '3Y_uez6uP';
#$config['db_password'] = 'internet2014';

$config['database_backend'] = 'mysqli';

// Database tables prefix
$config['table_prefix'] = 'cscart_';

/*
 * Script location options
 *	0363f0c9225b49cceaa70d39b0acd47d
 *	Example:
 *	Your url is http://www.yourcompany.com/store/cart
 *	$config['http_host'] = 'www.yourcompany.com';
 *	$config['http_path'] = '/store/cart';
 *
 *	Your secure url is https://secure.yourcompany.com/secure_dir/cart
 *	$config['https_host'] = 'secure.yourcompany.com';
 *	$config['https_path'] = '/secure_dir/cart';
 *
 */

// Host and directory where software is installed on no-secure server
$config['http_host'] = '4p4g.onehumanworld.com';
$config['http_path'] = '';

//$config['http_host'] = '115.112.143.170';
//$config['http_path'] = '/ECO/csc/4profit4good';

/*
 * Misc options
 */
// Names of index files for the frontend and backend
$config['customer_index'] = 'index.php';
$config['admin_index']    = 'admin_dyUUdxHdHn9J_vg.php';
$config['vendor_index']   = 'vendor.php';

// DEMO mode
$config['demo_mode'] = false;

// Tweaks
$config['tweaks'] = array (
    'anti_csrf' => false, // protect forms from CSRF attacks
    'disable_block_cache' => false, // used to disable block cache
    'disable_localizations' => true, // Disable Localizations functionality
    'disable_dhtml' => false, // Disable Ajax-based pagination and Ajax-based "Add to cart" button
    'dev_js' => false, // is used to disable js files compilation
    'gzip_css_js' => false // gzip compiled css/js files
);

// Key for sensitive data encryption
$config['crypt_key'] = 'd8ekvO1lfq';

// Cache backend
// Available backends: file, sqlite, database, redis
// To use sqlite cache the "sqlite3" PHP module should be installed
$config['cache_backend'] = 'file';
$config['cache_redis_server'] = 'localhost';

// Storage backend for sessions. Available backends: database, redis
$config['session_backend'] = 'database';
$config['session_redis_server'] = 'localhost';

// Storage options
$config['storage'] = array(
    'images' => array(
        'prefix' => 'images',
        'dir' => $config['dir']['root']
    ),
    'downloads' => array(
        'prefix' => 'downloads',
        'secured' => true,
        'dir' => $config['dir']['var']
    ),
    'statics' => array(
        'dir' => & $config['dir']['cache_misc'],
        'prefix' => 'statics'
    ),
    'custom_files' => array(
        'dir' => & $config['dir']['var'],
        'prefix' => 'custom_files'
    ),
    'theme_media' => array(
        'prefix' => array('fn_get_theme_path', '[relative]/[theme]/media'),
        'dir' => $config['dir']['root'],
    )
);

// Default permissions for newly created files and directories
define('DEFAULT_FILE_PERMISSIONS', 0666);
define('DEFAULT_DIR_PERMISSIONS', 0777);

// Maximum number of files, stored in directory. You may change this parameter straight after a store was installed. And you must not change it when the store has been populated with products already.
define('MAX_FILES_IN_DIR', 1000);

// Developer configuration file
if (file_exists(DIR_ROOT . '/local_conf.php')) {
    include_once(DIR_ROOT . '/local_conf.php');
}
