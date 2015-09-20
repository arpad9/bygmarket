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

namespace Tygh\UpgradeCenter\Validators;

use Tygh\Registry;
use Tygh\Themes\Themes;

/**
 * Upgrade validators: Check file permissions
 *
 * @todo Remove using of global functions
 */
class Permissions implements IValidator
{
    const CORRECT_PERMISSIONS_TO = 0777;

    /**
     * Global App config
     *
     * @var array $config
     */
    protected $config = array();

    /**
     * Validator identifier
     *
     * @var array $name ID
     */
    protected $name = 'permissions';

    /**
     * FTP connection flag
     *
     * @var bool $ftp_connection_status true/false if Validator tried to connect
     */
    protected $ftp_connection_status = null;

    /**
     * Validate specified data by schema
     *
     * @param  array $schema  Incoming validator schema
     * @param  array $request Request data
     *
     * @return array Validation result and Data to be displayed
     */
    public function check($schema, $request)
    {
        $data = array();
        $show_notifications = !empty($request['change_ftp_settings']);

        if (!empty($schema['files'])) {
            $repo_files = array();
            $repo_path = str_replace($this->config['dir']['root'] . '/', '', $this->config['dir']['themes_repository']);

            // Process themes_repository
            foreach ($schema['files'] as $file_path => $file_data) {
                if (strpos($file_path, $repo_path) !== false) {
                    $path = str_replace($repo_path, '', $file_path);
                    $path = explode('/', $path);

                    $theme_name = array_shift($path);

                    $repo_files[$theme_name][implode('/', $path)] = $file_data;
                }
            }

            $themes = fn_get_dir_contents($this->config['dir']['root'] . '/design/themes/');
            foreach ($themes as $theme_name) {
                $manifest = Themes::factory($theme_name)->getManifest();
                $parent_theme = empty($manifest['parent_theme']) ? 'basic' : $manifest['parent_theme'];

                if (!empty($repo_files[$parent_theme])) {
                    foreach ($repo_files[$parent_theme] as $file_path => $file_data) {
                        $schema['files']['design/themes/' . $theme_name . '/' . $file_path] = $file_data;
                    }
                }
            }

            foreach ($schema['files'] as $file_path => $file_data) {
                $result = true;
                $original_path = $this->config['dir']['root'] . '/' . $file_path;

                switch ($file_data['status']) {
                    case 'changed':
                        if (file_exists($original_path)) {
                            if (!$this->isWritable($original_path)) {
                                $result = $this->correctPermissions($original_path, $show_notifications);
                            }
                        } else {
                            $file_path = $this->getParentDir($file_path);

                            if (!$this->isWritable($this->config['dir']['root'] . '/' . $file_path)) {
                                $result = $this->correctPermissions($original_path, $show_notifications);
                            }
                        }

                        break;

                    case 'deleted':
                        if (file_exists($original_path)) {
                            if (!$this->isWritable($original_path)) {
                                $result = $this->correctPermissions($original_path, $show_notifications);
                            }
                        }

                        if ($result) {
                            $file_path = $this->getParentDir($file_path);

                            if (!$this->isWritable($this->config['dir']['root'] . '/' . $file_path)) {
                                $result = $this->correctPermissions($this->config['dir']['root'] . '/' . $file_path,
                                    $show_notifications);
                            }
                        }

                        break;

                    case 'new':
                        if (file_exists($original_path) && !$this->isWritable($original_path)) {
                            $result = $this->correctPermissions($original_path, $show_notifications);
                            $file_path = dirname($file_path);
                        } else {
                            $file_path = $this->getParentDir($file_path);

                            if (!$this->isWritable($this->config['dir']['root'] . '/' . $file_path)) {
                                $result = $this->correctPermissions($this->config['dir']['root'] . '/' . $file_path,
                                    $show_notifications);
                            }
                        }
                        break;
                }

                if (!$result) {
                    $data[] = $file_path;
                }
            }
        }

        $backups_writable = $this->checkDirectoryIsWritable($this->config['dir']['backups'], $show_notifications);
        if (!$backups_writable) {
            $data[] = $this->config['dir']['backups'];
        }

        $upgrades_dir = $this->config['dir']['root'] . '/upgrades';
        $upgrades_writable = $this->checkDirectoryIsWritable($upgrades_dir, $show_notifications);
        if (!$upgrades_writable) {
            $data[] = $upgrades_dir;
        }

        // Exclude duplicates
        $data = array_unique($data);

        if ($show_notifications && empty($data)) {
            return array(false, 'ok');
        } else {
            return array(empty($data), $data);
        }
    }

    /**
     * Gets validator name (ID)
     *
     * @return string Name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Sets writable permissions to the specified file/dir
     *
     * @param  string $path               Path to file/dir
     * @param  bool   $show_notifications Show FTP connection error notifications
     *
     * @return bool   true if permissions were succesfully changed, false otherwise
     */
    public function correctPermissions($path, $show_notifications)
    {
        $ftp_link = Registry::get('ftp_connection');

        if (empty($ftp_link) && is_null($this->ftp_connection_status)) {
            if (fn_ftp_connect(Registry::get('settings.Upgrade_center'), $show_notifications)) {
                $this->ftp_connection_status = true;
            } else {
                $this->ftp_connection_status = false;
            }
        }

        $correction_result = true;

        if (is_file($path) || is_dir($path)) {
            if (!$this->isWritable($path)) {
                @chmod($path, self::CORRECT_PERMISSIONS_TO);
            }
            if (!$this->isWritable($path) && !is_null($this->ftp_connection_status)) {
                fn_ftp_chmod_file($path, self::CORRECT_PERMISSIONS_TO);
            }
            if (!$this->isWritable($path)) {
                $correction_result = false;
            }
        }

        return $correction_result;
    }

    /**
     * Gets parent directory of the specified file/dir
     *
     * @param  string $path Path to file/dir
     *
     * @return string Path to parent directory
     */
    protected function getParentDir($path)
    {
        $original_path = $this->config['dir']['root'] . '/' . $path;

        do {
            $old_path = $path;
            $path = dirname($path);

            $original_path = $this->config['dir']['root'] . '/' . $path;

            if (is_dir($original_path)) {
                break;
            }

        } while ($path != $old_path);

        return $path;
    }

    public function __construct()
    {
        $this->config = Registry::get('config');
    }

    /**
     * @param $show_notifications
     *
     * @return bool
     */
    protected function checkDirectoryIsWritable($dir_path, $show_notifications)
    {
        $is_writable = true;
        if (file_exists($dir_path)) {
            if (!$this->isWritable($dir_path)) {
                $is_writable = $this->correctPermissions($dir_path, $show_notifications);
            }
        } elseif (!$this->isWritable($this->config['dir']['root'] . '/' . $this->getParentDir($dir_path))) {
            $is_writable = false;
        }

        return $is_writable;
    }

    public function isWritable($file_path)
    {
        clearstatcache(true, $file_path);
        $is_writable = is_writable($file_path);

        // is_writable() is not always a reliable way to determine whether
        // file or directory are really writable for current PHP process,
        // so we should perform an additional check
        if ($is_writable) {
            // For directories we try to create an empty file into it
            if (is_dir($file_path)) {
                $test_filepath = $file_path . DIRECTORY_SEPARATOR . uniqid(mt_rand(0, 10000));

                if (@touch($test_filepath)) {
                    @unlink($test_filepath);
                } else {
                    $is_writable = false;
                }
            } // For files we try to modify the file by appending "nothing" to it
            elseif (is_file($file_path)) {
                if (false === @file_put_contents($file_path, null, FILE_APPEND)) {
                    $is_writable = false;
                }
            }
        }

        return $is_writable;
    }
}
