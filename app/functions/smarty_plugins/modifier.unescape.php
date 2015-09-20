<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */

/**
 * Unescapes string
 *
 * @param string $data Input string for escaping
 * @return string unescaped string
 */
function smarty_modifier_unescape($data)
{
    return fn_html_escape($data, true);
}

/* vim: set expandtab: */
