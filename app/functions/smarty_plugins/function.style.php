<?php

use Tygh\Registry;

/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */

function smarty_function_style($params, &$smarty)
{
    $location = Registry::get('config.current_location') . (strpos($params['src'], '/') === 0 ? '' : ('/' . fn_get_theme_path('[relative]/[theme]') . '/css'));

    return '<link type="text/css" rel="stylesheet"' . (!empty($params['media']) ? (' media="' . $params['media'] . '"') : '') .
           ' href="' . $location . '/' . $params['src'] . '" />';

}
