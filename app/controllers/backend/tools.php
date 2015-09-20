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

use Tygh\Database;
use Tygh\Registry;
use Tygh\Settings;

if (!defined('BOOTSTRAP')) { die('Access denied'); }

fn_define('DB_MAX_ROW_SIZE', 10000);
fn_define('DB_ROWS_PER_PASS', 140);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if ($mode == 'update_quick_menu_item') {
        $_data = $_REQUEST['item'];

        if (empty($_data['position'])) {
            $_data['position'] = db_get_field("SELECT max(position) FROM ?:quick_menu WHERE parent_id = ?i", $_data['parent_id']);
            $_data['position'] = $_data['position'] + 10;
        }

        $_data['user_id'] = $auth['user_id'];
        $_data['url'] = fn_qm_parse_url($_data['url']);

        if (empty($_data['id'])) {
            $id = db_query("INSERT INTO ?:quick_menu ?e", $_data);

            $_data = array (
                'object_id' => $id,
                'description' => $_data['name'],
                'object_holder' => 'quick_menu'
            );

            foreach (fn_get_translation_languages() as $_data['lang_code'] => $v) {
                db_query("INSERT INTO ?:common_descriptions ?e", $_data);
            }
        } else {
            db_query("UPDATE ?:quick_menu SET ?u WHERE menu_id = ?i", $_data, $_data['id']);

            $__data = array(
                'description' => $_data['name']
            );
            db_query("UPDATE ?:common_descriptions SET ?u WHERE object_id = ?i AND object_holder = 'quick_menu' AND lang_code = ?s", $__data, $_data['id'], DESCR_SL);
        }

        return array(CONTROLLER_STATUS_OK, "tools.show_quick_menu.edit?no_popup=1");
    }

    if ($mode == 'view_changes') {

        if (!empty($_REQUEST['compare_data']['db_name'])) {
            fn_db_snapshot_create();
            fn_db_snapshot_create($_REQUEST['compare_data']['db_name']);
        }

        return array(CONTROLLER_STATUS_OK, "tools.view_changes?db_ready=Y");
    }

    return;
}

if ($mode == 'phpinfo') {
    phpinfo();
    exit;

} elseif ($mode == 'show_quick_menu') {
    if (Registry::get('runtime.action') == 'edit') {
        Registry::get('view')->assign('edit_quick_menu', true);
    } else {
        Registry::get('view')->assign('expand_quick_menu', true);
    }

    if (empty($_REQUEST['no_popup'])) {
        Registry::get('view')->assign('show_quick_popup', true);
    }
    Registry::get('view')->display('common/quick_menu.tpl');
    exit;

} elseif ($mode == 'get_quick_menu_variant') {
    Registry::get('ajax')->assign('description', db_get_field("SELECT description FROM ?:common_descriptions WHERE object_id = ?i AND object_holder = 'quick_menu' AND lang_code = ?s", $_REQUEST['id'], DESCR_SL));
    exit;

} elseif ($mode == 'remove_quick_menu_item') {
    $where = '';
    if (intval($_REQUEST['parent_id']) == 0) {
        $where = db_quote(" OR parent_id = ?i", $_REQUEST['id']);
        $delete_ids = db_get_fields("SELECT menu_id FROM ?:quick_menu WHERE parent_id = ?i", $_REQUEST['id']);
        db_query("DELETE FROM ?:common_descriptions WHERE object_id IN (?n) AND object_holder = 'quick_menu'", $delete_ids);
    }

    db_query("DELETE FROM ?:quick_menu WHERE menu_id = ?i ?p", $_REQUEST['id'], $where);
    db_query("DELETE FROM ?:common_descriptions WHERE object_id = ?i AND object_holder = 'quick_menu'", $_REQUEST['id']);

    Registry::get('view')->assign('edit_quick_menu', true);
    Registry::get('view')->assign('quick_menu', fn_get_quick_menu_data());
    Registry::get('view')->display('common/quick_menu.tpl');
    exit;

} elseif ($mode == 'update_quick_menu_handler') {
    if (!empty($_REQUEST['enable'])) {
        Settings::instance()->updateValue('show_menu_mouseover', $_REQUEST['enable']);

        return array(CONTROLLER_STATUS_REDIRECT, "tools.show_quick_menu.edit");
    }
    exit;

} elseif ($mode == 'cleanup_history') {
    $_SESSION['last_edited_items'] = array();
    fn_save_user_additional_data('L', '');
    Registry::get('view')->assign('last_edited_items', '');
    Registry::get('view')->display('common/last_viewed_items.tpl');
    exit;

} elseif ($mode == 'update_status') {

    fn_tools_update_status($_REQUEST);

    exit;

// Open/close the store
} elseif ($mode == 'store_mode') {

    fn_set_store_mode($_REQUEST['state']);
    exit;

} elseif ($mode == 'update_position') {

    if (preg_match("/^[a-z_]+$/", $_REQUEST['table'])) {
        $table_name = $_REQUEST['table'];
    } else {
        die;
    }

    $id_name = $_REQUEST['id_name'];
    $ids = explode(',', $_REQUEST['ids']);
    $positions = explode(',', $_REQUEST['positions']);

    foreach ($ids as $k => $id) {
        db_query("UPDATE ?:$table_name SET position = ?i WHERE ?w", $positions[$k], array($id_name => $id));
    }

    fn_set_notification('N', __('notice'), __('positions_updated'));

    exit;

} elseif ($mode == 'view_changes') {

    $results = array();

    $dist_filename = fn_get_snapshot_name('dist');
    $snapshot_filename = fn_get_snapshot_name('current');

    if (is_file($dist_filename)) {

        if (is_file($snapshot_filename)) {

            include($snapshot_filename);
            include($dist_filename);

            list($added, $changed, $deleted) = fn_snapshot_diff($snapshot, $snapshot_dist);

            foreach ($snapshot['themes'] as $theme_name => $data) {
                $data_dist = fn_snapshot_build_theme($theme_name, $snapshot_dist);
                list($theme_added, $theme_changed, $theme_deleted) = fn_snapshot_diff($data, $data_dist);
                fn_snapshot_array_merge($added, $theme_added);
                fn_snapshot_array_merge($changed, $theme_changed);
                fn_snapshot_array_merge($deleted, $theme_deleted);
            }

            $tree = fn_snapshot_build_tree(array('added' => $added, 'changed' => $changed, 'deleted' => $deleted));

            $tables = db_get_fields('SHOW TABLES');

            Registry::get('view')->assign('creation_time', $snapshot['time']);
            Registry::get('view')->assign('changes_tree', $tree);

            if (!empty($snapshot_dist['db_scheme'])) {
                $db_scheme = '';
                foreach ($tables as $k => $table) {
                $db_scheme .= "\nDROP TABLE IF EXISTS " . $table . ";\n";
                $__scheme = db_get_row("SHOW CREATE TABLE $table");

                $__scheme = array_pop($__scheme);
                $replaced_scheme = preg_replace('/ AUTO_INCREMENT=[0-9]*/i', '', $__scheme);
                if (!empty($replaced_scheme) && is_string($replaced_scheme)) {
                    $__scheme = $replaced_scheme;
                }
                $db_scheme .= $__scheme . ";\n\n";
                }

                $db_scheme = str_replace('default', 'DEFAULT', $db_scheme);
                $snapshot_dist['db_scheme'] = str_replace('default', 'DEFAULT', $snapshot_dist['db_scheme']);

                Registry::get('view')->assign('db_diff', fn_text_diff_($snapshot_dist['db_scheme'], $db_scheme));
            }
            if (isset($_REQUEST['db_ready']) && $_REQUEST['db_ready'] == 'Y') {
                $snapshot_dir = Registry::get('config.dir.root') . '/var/snapshots/';
                $s_r = fn_get_contents($snapshot_dir . 'cmp_release.sql');
                $s_c = fn_get_contents($snapshot_dir . 'cmp_current.sql');

                @ini_set('memory_limit', '255M');
                Registry::get('view')->assign('db_d_diff', fn_text_diff_($s_r, $s_c));
            }

        } else {
            Registry::get('view')->assign('creation_time', 0);
            Registry::get('view')->assign('changes_tree', array());
        }
    } else {
        Registry::get('view')->assign('dist_filename', $dist_filename);
        Registry::get('view')->assign('changes_tree', array());
    }

} elseif ($mode == 'create_snapshot') {

    fn_snapshot_create();

    return array(CONTROLLER_STATUS_OK, 'tools.view_changes');

} elseif ($mode == 'init_addons') {

    $init_addons = !empty($_REQUEST['init_addons']) ? $_REQUEST['init_addons'] : '';
    if (!($init_addons == 'none' || $init_addons == 'core')) {
        $init_addons = '';
    }

    Settings::instance()->updateValue('init_addons', $init_addons);
    fn_clear_cache();

    $return_url = !empty($_REQUEST['return_url']) ? $_REQUEST['return_url'] : 'tools.view_changes';

    return array(CONTROLLER_STATUS_OK, $return_url);
}

function fn_text_diff_($source, $dest, $side_by_side = false)
{
    $diff = new Text_Diff('auto', array(explode("\n", $source), explode("\n", $dest)));
    $renderer = new Text_Diff_Renderer_inline();
    $renderer->_leading_context_lines = 3;
    $renderer->_trailing_context_lines = 3;

    if ($side_by_side == false) {
        $renderer->_split_level = 'words';
    }

    $res = $renderer->render($diff);

    if ($side_by_side == true) {
        $res = $renderer->sideBySide($res);
    }

    return $res;
}

function fn_db_snapshot_create($db_name = '')
{

    $snapshot_dir = Registry::get('config.dir.root') . '/var/snapshots/';

    $dbdump_filename = empty($db_name) ? 'cmp_current.sql' : 'cmp_release.sql';

        if (!fn_mkdir($snapshot_dir)) {
            fn_set_notification('E', __('error'), __('text_cannot_create_directory', array(
                '[directory]' => $snapshot_dir
            )));

            return false;
        }
        $dump_file = $snapshot_dir . $dbdump_filename;
        if (is_file($dump_file)) {
            if (!is_writable($dump_file)) {
                fn_set_notification('E', __('error'), __('dump_file_not_writable'));

                return false;
            }
        }

        $fd = @fopen($snapshot_dir . $dbdump_filename, 'w');
        if (!$fd) {
            fn_set_notification('E', __('error'), __('dump_cant_create_file'));

            return false;
        }

        if (!empty($db_name)) {
            Database::changeDb($db_name);
        }
        // set export format
        db_query("SET @SQL_MODE = 'MYSQL323'");

        fn_start_scroller();
        $create_statements = array();
        $insert_statements = array();

        $status_data = db_get_array("SHOW TABLE STATUS");

         $dbdump_tables = array();
        foreach ($status_data as $k => $v) {
            $dbdump_tables[] = $v['Name'];
        }

        // get status data
        $t_status = db_get_hash_array("SHOW TABLE STATUS", 'Name');

        foreach ($dbdump_tables as $k => $table) {

            fn_echo('<br />' . __('backupping_data') . ': <b>' . $table . '</b>&nbsp;&nbsp;');
            $total_rows = db_get_field("SELECT COUNT(*) FROM $table");

            $index = db_get_array("SHOW INDEX FROM $table");
            $order_by = array();
            foreach ($index as $kk => $vv) {
                if ($vv['Key_name'] == 'PRIMARY') {
                $order_by[] = '`' . $vv['Column_name'] . '`';
                }
            }

            if (!empty($order_by)) {
                $order_by = 'ORDER BY ' . implode(',', $order_by);
            } else {
                $order_by = '';
            }
            // Define iterator
            if (!empty($t_status[$table]) && $t_status[$table]['Avg_row_length'] < DB_MAX_ROW_SIZE) {
                $it = DB_ROWS_PER_PASS;
            } else {
                $it = 1;
            }
            for ($i = 0; $i < $total_rows; $i = $i + $it) {
                $table_data = db_get_array("SELECT * FROM $table $order_by LIMIT $i, $it");
                foreach ($table_data as $_tdata) {
                    $_tdata = fn_add_slashes($_tdata, true);
                    $values = array();
                    foreach ($_tdata as $v) {
                        $values[] = ($v !== null) ? "'$v'" : 'NULL';
                    }
                    fwrite($fd, "INSERT INTO $table (`" . implode('`, `', array_keys($_tdata)) . "`) VALUES (" . implode(', ', $values) . ");\n");
                }

                fn_echo(' .');
            }

        }
        fn_stop_scroller();
        if (!empty($db_name)) {
            Settings::instance()->reloadSections();
        }

        if (fn_allowed_for('ULTIMATE')) {
            $companies = fn_get_short_companies();
            asort($companies);
            $settings['company_root'] = Settings::instance()->getList();
            foreach ($companies as $k=>$v) {
            $settings['company_'.$k] = Settings::instance()->getList(0, 0, false, $k);
            }
        } else {
            $settings['company_root'] = Settings::instance()->getList();
        }

        if (!empty($db_name)) {
            Database::changeDb(Registry::get('config.db_name'));
        }

        $settings = fn_snapshot_process_settings($settings, '');
        $settings = fn_snapshot_format_settings($settings['data']);
        ksort($settings);

        $data = print_r($settings, true);
        fwrite($fd,$data);

        fclose($fd);
        @chmod($snapshot_dir . $dbdump_filename, DEFAULT_FILE_PERMISSIONS);

        return true;
}

function fn_snapshot_process_settings($data, $key)
{
    $res = array();

    foreach ($data as $k=>$v) {
    if (is_array($v)) {
        $tmp = fn_snapshot_process_settings($v, $k);
        $res[$tmp['key']] = $tmp['data'];
    } else {
        if ($k == 'name') {
        $key = $v;
        }
        //remove dynamic data
        if ($k != 'object_id' &&
        $k != 'section_id' &&
        $k != 'section_tab_id')
        {
        $res[$k] = $v;
        }
    }

    }

    return array('key'=>$key, 'data'=>$res);
}

function fn_snapshot_format_settings($data, $path = array(), $lev = 0)
{
    $res = array();

    foreach ($data as $k=>$v) {
    if (is_array($v) && $lev < 3) {
        $path[$lev] = $k;
        $tmp = fn_snapshot_format_settings($v, $path, $lev + 1);
        $res = array_merge($res, $tmp);
    } elseif ($lev == 3) {
        $path[$lev] = $k;
        $res[implode('.', $path)] = $v;
    }
    }

    return $res;
}

function fn_snapshot_create($dir_root = '', $dist = false)
{
    if (empty($dir_root)) {
        $dir_root = Registry::get('config.dir.root');
    }
    $folders = array('app', 'js', 'design/backend');
    if ($dist) {
        $themes_dir = $dir_root . '/var/themes_repository';
        $themes_dir_to = $dir_root . '/design/themes';
    } else {
        $themes_dir = $dir_root . '/design/themes';
    }

    $themes = fn_get_dir_contents($themes_dir);

    $snapshot = array('time' => time(), 'files' => array(), 'dirs' => array(), 'themes' => array());

    if ($dist) {
        $snapshot['db_scheme'] = fn_get_contents($dir_root . '/install/database/scheme.sql');
    }

    $new_snapshot = fn_snapshot_make($dir_root, $folders, array('config.local.php'));
    fn_snapshot_array_merge($snapshot, $new_snapshot);

    foreach ($folders as $folder_name) {
        $path = $dir_root . '/' . $folder_name;
        $new_snapshot = fn_snapshot_make($path);
        fn_snapshot_array_merge($snapshot, $new_snapshot);
    }

    foreach ($themes as $theme_name) {
        if (is_numeric($theme_name) && $theme_name === strval($theme_name + 0)) {
            continue; // this is company subfolder
        }
        $path = "$themes_dir/$theme_name";
        if ($dist) {
            $new_snapshot = fn_snapshot_make($path, array(), array(), array($themes_dir => $themes_dir_to), true);
        } else {
            $new_snapshot = fn_snapshot_make($path, array(), array(), array(), true);
        }
        $snapshot['themes'][$theme_name]['files'] = $snapshot['themes'][$theme_name]['dirs'] = array();
        fn_snapshot_array_merge($snapshot['themes'][$theme_name], $new_snapshot);
    }

    $snapshot['addons'] = fn_get_dir_contents(Registry::get('config.dir.addons'));

    fn_mkdir($dir_root . '/var/snapshots');

    $snapshot_filename = fn_strtolower(PRODUCT_VERSION . '_' . (PRODUCT_STATUS ? (PRODUCT_STATUS . '_') : '') . PRODUCT_EDITION . ($dist ? '_dist' : ''));
    $snapshot_filecontent = '<?php $snapshot' . ($dist ? '_dist' : ''). ' = ' . var_export($snapshot, true) . '; ?>';

    fn_put_contents("$dir_root/var/snapshots/{$snapshot_filename}.php", $snapshot_filecontent);
}

function fn_snapshot_array_merge(&$array, $additional)
{
    foreach ($array as $key => $v) {
        if (is_array($array[$key])) {
            $array[$key] = array_merge($array[$key], !empty($additional[$key]) ? $additional[$key] : array());
        }
    }
}

function fn_snapshot_build_tree($changes)
{
    $tree = array();

    foreach ($changes as $action => $dataset) {
        foreach ($dataset as $types => $data) {

            $type = substr($types, 0, -1);

            foreach ($data as $path) {
                $parent = '';
                $dirs = explode('/', $path);
                $dirs_size = count($dirs);
                $elm = & $tree;
                $level = 0;
                foreach ($dirs as $key => $name) {
                    if ($name == '') {
                        $name = '/';
                    }
                    if ($key + 1 < $dirs_size) {
                        $new_key = md5("dir-$name-$parent");
                        if (!isset($elm[$new_key]['content'])) {
                            $elm[$new_key] = array(
                                'name' => $name,
                                'type' => 'dir',
                                'level' => $level,
                                'content' => array(),
                            );
                        }
                        $elm = & $elm[$new_key]['content'];
                    }
                    if ($key + 1 == $dirs_size) {
                        $new_key = md5("$type-$name-$parent");
                        $elm[$new_key]['name'] = $name;
                        $elm[$new_key]['type'] = $type;
                        $elm[$new_key]['level'] = $level;
                        $elm[$new_key]['action'] = $action;
                    }
                    $parent = $new_key;
                    $level++;
                }
            }
        }
    }

    fn_snapshot_sort_tree($tree);

    return $tree;
}

function fn_snapshot_sort_tree(&$tree)
{
    foreach ($tree as $key => &$elm) {
        if (!empty($elm['content'])) {
            if (count($elm['content'] > 1)) {
                uasort($tree[$key]['content'], 'fn_snapshot_cmp');
            }
            fn_snapshot_sort_tree($tree[$key]['content']);
        }
    }
}

function fn_snapshot_cmp($a, $b)
{
    $a1 = (!empty($a['type']) ? $a['type'] : 'file') . (!empty($a['name']) ? $a['name'] : '');
    $b1 = (!empty($b['type']) ? $b['type'] : 'file') . (!empty($b['name']) ? $b['name'] : '');
    if ($a1 == $b1) {
        return 0;
    }

    return ($a1 < $b1) ? -1 : 1;
}

function fn_snapshot_make($path, $dirs_list = array(), $skip_files = array(), $path_replace = array(), $themes = false)
{
    $results = array('files' => array(), 'dirs' => array());
    $dir_root_strlen = strlen(Registry::get('config.dir.root'));

    if (is_dir($path)) {
        if ($dh = opendir($path)) {

            while (($file = readdir($dh)) !== false) {
                if ($file == '.' || $file == '..' || $file{0} == '.') {
                    continue;
                }

                $full_file_path = $_full_file_path = $path . '/' . $file;
                if ($path_replace) {
                    $_find = key($path_replace);
                    $_replace = $path_replace[$_find];
                    if (substr($full_file_path, 0, strlen($_find)) == $_find) {
                        $_full_file_path = substr_replace($full_file_path, $_replace, 0, strlen($_find));
                    }
                }
                $short_file_path = $_short_file_path = substr($_full_file_path, $dir_root_strlen);
                if ($themes) {
                    $_ar = explode('/', $short_file_path);
                    $_short_file_path = implode('/', array_slice($_ar, 3));
                }
                if (is_file($full_file_path) && !in_array($file, $skip_files)) {
                    $results['files'][md5($_short_file_path . md5_file($full_file_path))] = $short_file_path;
                } elseif (is_dir($full_file_path)) {
                    $hash = md5($_short_file_path);
                    if (!empty($dirs_list)) {
                        if (in_array($file, $dirs_list)) {
                            $results['dirs'][$hash] = $short_file_path;
                        }
                    } else {
                        $results['dirs'][$hash] = $short_file_path;
                        $new_results = fn_snapshot_make($full_file_path, array(), array(), $path_replace, $themes);
                        fn_snapshot_array_merge($results, $new_results);
                    }
                }
            }
            closedir($dh);
        }
    }

    return $results;
}

function fn_snapshot_diff($current, $dist)
{
    $deleted = $added = array('files' => array(), 'dirs' => array());
    $changed['files'] = array();

    $deleted['files'] = array_diff($dist['files'], $current['files']);
    $deleted['dirs'] = array_diff($dist['dirs'], $current['dirs']);

    $added['files'] = array_diff($current['files'], $dist['files']);
    $added['dirs'] = array_diff($current['dirs'], $dist['dirs']);

    $tmp['files'] = array_diff_assoc($current['files'], $dist['files']);

    $changed['files'] = array_diff($tmp['files'], $added['files']);

    return array($added, $changed, $deleted);
}

function fn_snapshot_build_theme($theme_name, &$snapshot_dist)
{
    $theme = !empty($snapshot_dist['themes'][$theme_name]) ? $snapshot_dist['themes'][$theme_name] : array('files' => array(), 'dirs' => array());

    $base = $snapshot_dist['themes']['basic'];
    $len = strlen('/design/themes/basic');

    foreach ($base as $type => $dataset) {
        foreach ($dataset as $key => $filename) {
            $base[$type][$key] = substr_replace($filename, '/design/themes/' . $theme_name, 0, $len);
            if (in_array($base[$type][$key], $theme[$type])) {
                unset($base[$type][$key]);
            }
        }
    }

    fn_snapshot_array_merge($base, $theme);

    return $base;
}

function fn_qm_parse_url($url)
{
    if (strpos($url, '?') !== false) {
        list(, $query_string) = explode('?', $url);
        parse_str($query_string, $params);
        if (!empty($params['dispatch'])) {
            $dispatch = $params['dispatch'];
            unset($params['dispatch']);
            $url = $dispatch . '?' . http_build_query($params);
        }
    }

    return $url;
}
