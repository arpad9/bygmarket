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
use Tygh\Settings;

if (!defined('BOOTSTRAP')) { die('Access denied'); }

$_SESSION['current_path'] = empty($_SESSION['current_path']) ? '' : preg_replace('/^\//', '', $_SESSION['current_path']);
$current_path = $_SESSION['current_path'];

$_SESSION['msg'] = empty($_SESSION['msg']) ? array() : $_SESSION['msg'];
$msg = & $_SESSION['msg'];

$_SESSION['action_type'] = empty($_SESSION['action_type']) ? array() : $_SESSION['action_type'];
$action_type = & $_SESSION['action_type'];

$dir_themes = fn_get_theme_path('[themes]/', 'C');

// Disable debug console
Registry::get('view')->debugging = false;
$message = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if ($mode == 'edit') {
        fn_trusted_vars('file_content');

        if (defined('DEVELOPMENT')) {
            exit;
        }

        $base_dir = Registry::get('config.dir.root');
        $file = $_REQUEST['file'];
        $file_path = $_REQUEST['file_path'];
        $fname = fn_normalize_path($base_dir . $file_path . '/' . $file);

        if (strpos($fname, $dir_themes) !== false && @is_writable($fname) && !in_array(fn_strtolower(fn_get_file_ext($fname)), Registry::get('config.forbidden_file_extensions'))) {
            fn_put_contents($fname, $_REQUEST['file_content']);
            fn_set_notification('N', __('notice'), __('text_file_saved', array(
                '[file]' => $file
            )));
        } else {
            fn_set_notification('E', __('error'), __('cannot_write_file', array(
                '[file]' => $file
            )));
        }

        exit;
    }

    if ($mode == 'upload_file') {
        $uploaded_data = fn_filter_uploaded_data('uploaded_data');
        $base_dir = Registry::get('config.dir.root');
        $pname = fn_normalize_path($base_dir . $_REQUEST['path'].'/');

        foreach ((array) $uploaded_data as $udata) {
            if (!(strpos($pname, $dir_themes) !== false && fn_copy($udata['path'], $pname.$udata['name']))) {
                fn_set_notification('E', __('error'), __('cannot_write_file', array(
                    '[file]' => $pname . $udata['name']
                )));
            }
        }

        return array(CONTROLLER_STATUS_OK, "template_editor.manage");
    }

}

if ($mode == 'init_view') {
    $base_dir = Registry::get('config.dir.root');
    $dir = empty($_REQUEST['dir']) ? '' : $_REQUEST['dir'];
    $tpath = fn_normalize_path($base_dir . $dir);

    if (strpos($tpath, $dir_themes) === false) {
        $tpath = $dir_themes;
        $current_path = '';
        $dir = '';
    }

    @clearstatcache();

    if (is_file($tpath) || !is_dir($tpath)) {
        $tpath = dirname($tpath);
    }

    if ($dh = @opendir($tpath)) {
        $files_list = '';
        $last_object = false;

        $base_path = fn_get_theme_path('[themes]', 'C');
        $show_path = str_replace($base_path, '', $tpath);

        if ($show_path == '/') {
            $show_path = array('');
        } else {
            $show_path = explode('/', $show_path);
        }

        foreach ($show_path as $id => $path) {
            $base_path .= '/' . $path;
            $dh = @opendir($base_path);

            $dirs = array();
            $files = array();

            while (($file = @readdir($dh)) !== false) {
                if ($file == '.' || $file == '..') {
                    continue;
                }

                if (@is_dir($base_path . '/' .$file)) {

                    $theme_type = '';
                    if ($base_path == $dir_themes) {
                        $customer_theme = fn_get_theme_path('[theme]', 'C');
                        if ($file != $customer_theme) {
                            continue;
                        }
                    }

                    $dirs[$file] = array('name' => $file, 'type' => 'D', 'perms' => fn_display_perms(fileperms($base_path . '/' . $file)));
                }

                if (@is_file($base_path . '/' .$file)) {
                    $files[$file] = array('name' => $file, 'type' => 'F', 'ext' => fn_get_file_ext($file), 'perms' => fn_display_perms(fileperms($base_path . '/' . $file)));
                }
            }

            ksort($dirs, SORT_STRING);
            ksort($files, SORT_STRING);

            $items = fn_array_merge($dirs, $files, false);

            Registry::get('view')->assign('current_path', fn_normalize_path(str_replace(Registry::get('config.dir.root'), '', $base_path)));
            Registry::get('view')->assign('items', $items);

            $current_path = empty($dir) ? '' : ($dir.'/');
            $current_path = fn_normalize_path($current_path);

            Registry::get('view')->assign('show_legend', !empty($current_path));
            @closedir($dh);

            if (isset($show_path[$id + 1])) {
                Registry::get('view')->assign('active_object', $show_path[$id + 1]);
            }

            if (!isset($show_path[$id + 2])) {
                Registry::get('view')->assign('last_object', true);
            }

            $_list = Registry::get('view')->fetch('views/template_editor/components/file_list.tpl');
            if (!empty($files_list)) {
                $files_list = str_replace('<!--render_place-->', $_list, $files_list);
            } else {
                $files_list = $_list;
            }

            Registry::get('ajax')->assign('show_legend', !empty($current_path));
            Registry::get('ajax')->assign('files_list', $files_list);
            Registry::get('ajax')->assign('directory_data', fn_array_merge($dirs, $files));

            if (!isset($show_path[$id + 2])) {
                $last_object = true;
            }
        }
    }
    exit;

} elseif ($mode == 'browse') {
    $base_dir = Registry::get('config.dir.root');
    $dir = empty($_REQUEST['dir']) ? '' : '/' . $_REQUEST['dir'];
    $tpath = fn_normalize_path($base_dir . $dir);

    if (strpos($tpath, $dir_themes) === false) {
        $tpath = $dir_themes;
        $current_path = '';
        $dir = '';
    }

    @clearstatcache();

    if ($dh = @opendir($tpath)) {
        $dirs = array();
        $files = array();

        while (($file = @readdir($dh)) !== false) {
            if ($file == '.' || $file == '..') {
                continue;
            }
            if (@is_dir($tpath . '/' .$file)) {

                $theme_type = '';
                if ($tpath == $dir_themes) {
                    $customer_theme = fn_get_theme_path('[theme]', 'C');
                    if ($file != $customer_theme) {
                        continue;
                    }
                }

                $dirs[$file] = array('name' => $file, 'type' => 'D', 'perms' => fn_display_perms(fileperms($tpath . '/' .$file)), 'theme_type' => $theme_type);
            }

            if (@is_file($tpath . '/' .$file)) {
                $files[$file] = array('name' => $file, 'type' => 'F', 'ext' => fn_get_file_ext($file), 'perms' => fn_display_perms(fileperms($tpath . '/' . $file)));
            }
        }

        ksort($dirs, SORT_STRING);
        ksort($files, SORT_STRING);

        $items = fn_array_merge($dirs, $files, false);
        Registry::get('view')->assign('current_path', str_replace(Registry::get('config.dir.root'), '', $tpath));
        Registry::get('view')->assign('items', $items);

        $current_path = empty($dir) ? '' : ($dir.'/');
        $current_path = fn_normalize_path($current_path);

        Registry::get('ajax')->assign('current_path', str_replace(Registry::get('config.dir.root'), '', $tpath));
        Registry::get('ajax')->assign('show_legend', !empty($current_path));
        @closedir($dh);

        Registry::get('ajax')->assign('files_list', Registry::get('view')->fetch('views/template_editor/components/file_list.tpl'));
        Registry::get('ajax')->assign('directory_data', fn_array_merge($dirs, $files));
    }
    exit;

} elseif ($mode == 'delete_file') {

    $file = $_REQUEST['file'];
    $base_dir = Registry::get('config.dir.root');
    $file_path = $_REQUEST['file_path'];
    $fname = fn_normalize_path($base_dir . $file_path . '/' . $file);
    $fn_name = @is_dir($fname) ? 'fn_rm': 'unlink';
    $object = @is_dir($fname) ? 'directory' : 'file';

    if (!in_array(fn_strtolower(fn_get_file_ext($file)), Registry::get('config.forbidden_file_extensions'))) {
        if (strpos($fname, $dir_themes) !== false && @$fn_name($fname)) {
            $action_type = '';

            fn_set_notification('N', __('notice'), __("text_{$object}_deleted", array(
                "[{$object}]" => $file
            )));
        } else {
            $action_type = 'error';

            fn_set_notification('E', __('error'), __("text_cannot_delete_{$object}", array(
                "[{$object}]" => $file
            )));
        }

    } else {
        fn_set_notification('E', __('error'), __('you_have_no_permissions'));
    }

    Registry::get('ajax')->assign('action_type',  $action_type);
    exit;
} elseif ($mode == 'rename_file') {

    $base_dir = Registry::get('config.dir.root');
    $file = $_REQUEST['file'];
    $file_path = $_REQUEST['file_path'];
    $rename_to = $_REQUEST['rename_to'];
    $pname = fn_normalize_path($base_dir . $file_path . '/');
    $object = @is_dir($pname.$file) ? 'directory' : 'file';
    $ext_from = fn_get_file_ext($file);
    $ext_to = fn_get_file_ext($rename_to);

    //fn_print_die($_REQUEST['file_path'],$base_dir);

    if (in_array(fn_strtolower($ext_from), Registry::get('config.forbidden_file_extensions')) || in_array(fn_strtolower($ext_to), Registry::get('config.forbidden_file_extensions'))) {
        $action_type = 'error';

        fn_set_notification('E', __('error'), __('text_forbidden_file_extension', array(
            '[ext]' => $ext_to
        )));
    } elseif (strpos($pname, $dir_themes) !== false && fn_rename($pname.$file, $pname.$rename_to)) {
        $action_type = '';

        fn_set_notification('N', __('notice'), __("text_{$object}_renamed", array(
            "[{$object}]" => $file,
            "[to_{$object}]" => $rename_to
        )));
    } else {
        $action_type = 'error';

        fn_set_notification('E', __('error'), __("text_cannot_rename_{$object}", array(
            "[{$object}]" => $file,
            "[to_{$object}]" => $rename_to
        )));
    }

    Registry::get('ajax')->assign('action_type',  $action_type);
    exit;
} elseif ($mode == 'create_file') {

    $file_path = fn_normalize_path(Registry::get('config.dir.root') . $_REQUEST['file_path']) . '/' . basename($_REQUEST['file']);
    $file_info = fn_pathinfo($file_path);

    if (in_array(fn_strtolower($file_info['extension']), Registry::get('config.forbidden_file_extensions')) || empty($file_info['filename'])) {
        $action_type = 'error';

        fn_set_notification('E', __('error'), __('text_forbidden_file_extension', array(
            '[ext]' => $file_info['extension']
        )));

    } elseif (strpos($file_path, Registry::get('config.dir.design')) !== false && @touch($file_path)) {
        @chmod($file_path, DEFAULT_FILE_PERMISSIONS);
        $action_type = '';

        fn_set_notification('N', __('notice'), __('text_file_created', array(
            '[file]' => $_REQUEST['file'],
        )));

    } else {
        $action_type = 'error';

        fn_set_notification('E', __('error'), __('text_cannot_create_file', array(
            '[file]' => $_REQUEST['file'],
        )));
    }

    Registry::get('ajax')->assign('action_type',  $action_type);
    exit;
} elseif ($mode == 'create_folder') {

    $folder_path = fn_normalize_path(Registry::get('config.dir.root') . $_REQUEST['folder_path']) . '/' . basename($_REQUEST['folder']);

    if (fn_mkdir($folder_path)) {
        $action_type = '';

        fn_set_notification('N', __('notice'), __('text_directory_created', array(
            '[directory]' => basename($_REQUEST['folder'])
        )));

    } else {
        $action_type = 'error';

        fn_set_notification('E', __('error'), __('text_cannot_create_directory', array(
            '[directory]' => basename($_REQUEST['folder'])
        )));
    }

    Registry::get('ajax')->assign('action_type',  $action_type);
    exit;
} elseif ($mode == 'chmod') {

    $base_dir = Registry::get('config.dir.root');
    $file = $_REQUEST['file'];
    $file_path = $_REQUEST['file_path'];
    $fname = fn_normalize_path($base_dir . $file_path . '/' . $file);

    if (!empty($_REQUEST['r']) && $_REQUEST['r'] == 'Y') {
        $res = fn_rchmod($fname, octdec($_REQUEST['perms']));
    } else {
        $res = @chmod($fname, octdec($_REQUEST['perms']));
    }

    if ($res) {
        fn_set_notification('N', __('notice'), __('text_permissions_changed'));
    } else {
        fn_set_notification('E', __('error'), __('error_permissions_not_changed'));
    }

    Registry::get('ajax')->assign('action_type',  $res ? '': 'error');
    exit;
} elseif ($mode == 'get_file') {

    $base_dir = Registry::get('config.dir.root');
    $file = $_REQUEST['file'];
    $file_path = $_REQUEST['file_path'];

    if (!in_array(fn_strtolower(fn_get_file_ext($base_dir . $file_path . '/' . $file)), Registry::get('config.forbidden_file_extensions'))) {
        $pname = fn_normalize_path($base_dir . $file_path . '/');
        fn_get_file($pname . $file);
    }

    exit;
} elseif ($mode == 'edit') {
    $base_dir = Registry::get('config.dir.root');
    $file = $_REQUEST['file'];
    $file_path = $_REQUEST['file_path'];
    $fname = fn_normalize_path($base_dir . $file_path . '/' . $file);

    if (!in_array(fn_strtolower(fn_get_file_ext($fname)), Registry::get('config.forbidden_file_extensions'))) {
        Registry::get('ajax')->assign('content', fn_get_contents($fname));
    } else {
        fn_set_notification('E', __('error'), __('you_have_no_permissions'));
    }

    exit;

} elseif ($mode == 'restore') {
    $copied = false;
    $file_path = fn_normalize_path(Registry::get('config.dir.root') . $_REQUEST['file_path']) . '/' . basename($_REQUEST['file']);

    $repo_path = str_replace('/design/themes/', '/var/themes_repository/', $file_path);

    $object_base = is_file($repo_path) ? 'file' : (is_dir($repo_path) ? 'directory' : '');

    if (!empty($object_base)) {
        $copied = fn_copy($repo_path, $file_path);
    }

    if (empty($object_base) || !$copied) {
        $object_base = empty($object_base) ? 'file' : $object_base;
        $action_type = 'error';

        fn_set_notification('E', __('error'), __("text_cannot_restore_{$object_base}", array(
            "[{$object_base}]" => $_REQUEST['file'],
        )));
    } else {
        $action_type = '';

        fn_set_notification('N', __('notice'), __("text_{$object_base}_restored", array(
            "[{$object_base}]" => $_REQUEST['file'],
        )));

        Registry::get('ajax')->assign('content', fn_get_contents($file_path));
    }

    Registry::get('ajax')->assign('action_type', $action_type);
    exit;

} elseif ($mode == 'enable_rebuild_cache') {
    if (isset($_REQUEST['state'])) {
        $is_store_optimization_dev = $_REQUEST['state'] == "true" ? 'Y' : 'N';
        Settings::instance()->updateValue('store_optimization_dev', $is_store_optimization_dev, '');
        Registry::set('settings.store_optimization_dev', Settings::instance()->getValue('store_optimization_dev', ''));
        if (Registry::get('settings.store_optimization_dev') == 'Y') {
            fn_set_notification('W', __('warning'), __('warning_store_optimization_dev', array('[link]' => fn_url("template_editor.manage"))), 'S');
        } else {
            fn_set_notification('W', __('warning'), __('warning_store_optimization_dev_disabled'), 'S');
        }
    }

    Registry::get('ajax')->assign('state', Registry::get('settings.store_optimization_dev') == 'Y');

    exit;
}

// ----------------------------------- function definitions ----------------------
function fn_display_perms($mode)
{
    if (defined('IS_WINDOWS')) {
        return '';
    }

    $owner = array();
    $group = array();
    $world = array();

    // Determine permissions
    $owner["read"] = ($mode & 00400) ? 'r' : '-';
    $owner["write"] = ($mode & 00200) ? 'w' : '-';
    $owner["execute"] = ($mode & 00100) ? 'x' : '-';
    $group["read"] = ($mode & 00040) ? 'r' : '-';
    $group["write"] = ($mode & 00020) ? 'w' : '-';
    $group["execute"] = ($mode & 00010) ? 'x' : '-';
    $world["read"] = ($mode & 00004) ? 'r' : '-';
    $world["write"] = ($mode & 00002) ? 'w' : '-';
    $world["execute"] = ($mode & 00001) ? 'x' : '-';

    // Adjust for SUID, SGID and sticky bit
    if ($mode & 0x800) {
        $owner["execute"] = ($owner['execute']=='x') ? 's' : 'S';
    }
    if ($mode & 0x400) {
        $group["execute"] = ($group['execute']=='x') ? 's' : 'S';
    }
    if ($mode & 0x200) {
        $world["execute"] = ($world['execute']=='x') ? 't' : 'T';
    }

    $s=sprintf("%1s%1s%1s", $owner['read'], $owner['write'], $owner['execute']);
    $s.=sprintf("%1s%1s%1s", $group['read'], $group['write'], $group['execute']);
    $s.=sprintf("%1s%1s%1s", $world['read'], $world['write'], $world['execute']);

    return trim($s);
}

//
// Recursively remove directory (or just a file)
//
function fn_rchmod($source, $perms = DEFAULT_DIR_PERMISSIONS)
{
    // Simple copy for a file
    if (is_file($source)) {
        $res = @chmod($source, $perms);

        return $res;
    }

    // Loop through the folder
    if (is_dir($source)) {
        $dir = dir($source);
        while (false !== $entry = $dir->read()) {
            // Skip pointers
            if ($entry == '.' || $entry == '..') {
                continue;
            }
             if (fn_rchmod($source . '/' . $entry, $perms) == false) {
                return false;
            }
        }
        // Clean up
        $dir->close();

        return @chmod($source, $perms);
    } else {
        return false;
    }
}
