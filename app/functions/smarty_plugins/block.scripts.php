<?php

use Tygh\Storage;
use Tygh\Registry;

/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */
function smarty_block_scripts($params, $content, &$smarty, &$repeat)
{
    if ($repeat == true) {
        return;
    }

    if (Registry::get('config.tweaks.dev_js') == true) {
        return $content;
    }

    $scripts = array();
    $dir_root = Registry::get('config.dir.root');
    $return = '';

    if (preg_match_all('/\<script(.*?)\>(.*?)\<\/script\>/s', $content, $m)) {
        $contents = '';

        foreach ($m[1] as $src) {
            if (!empty($src) && preg_match('/src ?= ?"([^"]+)"/', $src, $_m)) {
                $scripts[] = str_replace(Registry::get('config.current_location'), '', preg_replace('/\?.*?$/', '', $_m[1]));
            }
        }

        // Check file changes in dev mode
        $names = $scripts;
        if (Registry::get('settings.store_optimization_dev') == 'Y') {
            foreach ($names as $index => $name) {
                if (is_file($dir_root . '/' . $name)) {
                    $names[$index] .= filemtime($dir_root . '/' . $name);
                }
            }
        }

        $filename = 'js/tygh/scripts-' . md5(implode(',', $names)) . '.js';
        if (!Storage::instance('statics')->isExist($filename)) {
            foreach ($scripts as $src) {
                $contents .= fn_get_contents(Registry::get('config.dir.root') . $src);
            }

            Storage::instance('statics')->put($filename, array(
                'contents' => $contents,
                'compress' => Registry::get('config.tweaks.gzip_css_js'),
                'caching' => true
            ));
        }

        $return = '<script type="text/javascript" src="' . Storage::instance('statics')->getUrl($filename) . '?ver=' . PRODUCT_VERSION . '"></script>';

        foreach ($m[2] as $sc) {
            if (!empty($sc)) {
                $return .= '<script type="text/javascript">' . $sc . '</script>' . "\n";
            }
        }
    }

    return $return;
}
