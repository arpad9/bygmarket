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

namespace Tygh;

class Registry
{
    private static $_storage = array();
    private static $_cached_keys = array();
    private static $_changed_tables = array();
    private static $_storage_cache = array();
    private static $_cache_levels = array();
    private static $_cache_handlers = array();
    private static $_cache_handlers_are_updated = false;

    private static $_cache = null;
    const LOCK_WAIT = 100000; // mircoseconds
    const LOCK_EXPIRY = 20; // seconds

    /**
     * Puts variable to registry
     *
     * @param string  $key      key name
     * @param mixed   $value    key value
     * @param boolean $no_cache if set to true, data won't be cache even if it's registered in the cache
     *
     * @return boolean always true
     */
    public static function set($key, $value, $no_cache = false)
    {
        if (strpos($key, '.') !== false) {
            list($_key) = explode('.', $key);
        } else {
            $_key = $key;
        }

        if (isset(self::$_cached_keys[$_key]) && $no_cache == false) {
            // if key should be cached - check if it was changed
            while (!self::$_cache->acquireLock($_key, self::$_cached_keys[$_key]['cache_level'])) {
                usleep(self::LOCK_WAIT);
            }

            // get data from cache
            $val = self::_getCache($_key, self::$_cached_keys[$_key]['cache_level']);

            // set to registry
            self::set($_key, $val, true);
        }

        $var = & self::_getVarByKey($key, true);
        $var = $value;

        if ($no_cache == false && isset(self::$_cached_keys[$_key]) && self::$_cached_keys[$_key]['track'] == false) { // save cache immediatelly
            $_var = (strpos($key, '.') !== false) ? self::get($_key) : $value;

            self::$_cache->set($_key, $_var, self::$_cached_keys[$_key]['condition'], self::$_cached_keys[$_key]['cache_level']);
            self::_updateHandlers($_key, self::$_cached_keys[$_key]['condition'], self::$_cached_keys[$_key]['cache_level']);
            self::$_cache->releaseLock($_key, self::$_cached_keys[$_key]['cache_level']);
            unset(self::$_cached_keys[$_key]);
        }

        return true;
    }

    /**
     * Gets variable from registry (value can be returned by reference)
     *
     * @param string $key key name
     *
     * @return mixed key value
     */
    static function & get($key)
    {
        return self::_getVarByKey($key);
    }

    /**
     * Pushes data to array
     *
     * @param string $key key name
     * @paramN mixed values to push to the key value
     *
     * @return boolean always true
     */
    public static function push()
    {
        $args = func_get_args();

        $data = & self::get(array_shift($args));
        if (!is_array($data)) {
            $data = array();
        }

        $data =	array_merge($data, $args);

        return true;
    }

    /**
     * Deletes key from registry
     *
     * @param string $key key name
     *
     * @return boolean true if key found, false - otherwise
     */
    public static function del($key)
    {
        if ($var = & self::_getVarByKey($key)) {
            $var = NULL;

            return true;
        }

        return false;
    }

    /**
     * Private: gets value of complex key (key.name.part)
     *
     * @param string  $key    key name
     * @param boolean $create if true, key will be created in registry
     *
     * @return mixed key value
     */
    private static function & _getVarByKey($key, $create = false)
    {
        $_storage_cache = self::$_storage_cache;
        if (!isset($_storage_cache[$key])) {
            $null = null;
            if (strpos($key, '.') !== false) {
                $parts = explode('.', $key);
                $part = array_shift($parts);
                if (empty(self::$_storage[$part])) {
                    if ($create == true) {
                        self::$_storage[$part] = array();
                    } else {
                        $_storage_cache[$key] = $null;

                        return $null;
                    }
                }

                $piece = & self::$_storage[$part];
                foreach ($parts as $part) {
                    if (!is_array($piece)) {
                        if ($create == true) {
                            $piece = array();
                        } else {
                            $_storage_cache[$key] = $null;

                            return $null;
                        }
                    }

                    $piece = & $piece[$part];
                }

                $_storage_cache[$key] = $piece;

                return $piece;
            }
        } else {
            return $_storage_cache[$key];
        }

        if (!isset(self::$_storage[$key]) && $create == true) {
            self::$_storage[$key] = array();
        }

        return self::$_storage[$key];
    }

    /**
     * Conditional get, returns default value if key does not exist in registry
     *
     * @param string $key     key name
     * @param mixed  $default default value
     *
     * @return mixed key value if exist, default value otherwise
     */
    public static function ifGet($key, $default)
    {
        $var = self::_getVarByKey($key);

        return !empty($var) ? $var : $default;
    }

    /**
     * Checks if key exists in the registry
     *
     * @param string $key key name
     *
     * @return boolean true if key exists, false otherwise
     */
    public static function isExist($key)
    {
        $var = self::_getVarByKey($key);

        return $var !== NULL;
    }

    /**
     * Marks table as changed
     *
     * @param string $table table name
     *
     * @return boolean always true
     */
    public static function setChangedTables($table)
    {
        self::$_changed_tables[$table] = true;

        return true;
    }

    /**
     * Registers variable in the cache
     *
     * @param string $key         key name
     * @param mixed  $condition   cache reset condition - array with table names of expiration time (int)
     * @param string $cache_level indicates the cache dependencies on controller, language, user group, etc
     * @param bool   $track       if set to true, cache data will be collection during script execution and saved when it finished
     *
     * @return boolean true if data is cached and valid, false - otherwise
     */
    public static function registerCache($key, $condition, $cache_level = NULL, $track = false)
    {
        if (empty(self::$_cache)) {
            self::cacheInit();
        }

        if (empty(self::$_cached_keys[$key])) {
            self::$_cached_keys[$key] = array(
                'condition' => $condition,
                'cache_level' => $cache_level,
                'track' => $track,
                'hash' => ''
            );

            if (!self::isExist($key) && ($val = self::_getCache($key, $cache_level)) !== NULL) {
                self::set($key, $val, true);

                // Get hash of original value for tracked data
                if ($track == true) {
                    self::$_cached_keys[$key]['hash'] = md5(serialize($val));
                }

                return true;
            }
        }

        return false;
    }

    /**
     * Inits cache backend
     *
     * @return boolean always true
     */
    public static function cacheInit()
    {
        if (empty(self::$_cache)) {
            $_cache_class = self::ifGet('config.cache_backend', 'file');
            $_cache_class = '\\Tygh\\Backend\\Cache\\' . ucfirst($_cache_class);

            self::$_cache = new $_cache_class(self::get('config'));
            self::$_cache_handlers = self::$_cache->getHandlers();
        }

        return true;
    }

    /**
     * Gets cached data
     *
     * @param string $key         key name
     * @param string $cache_level indicates the cache dependencies on controller, language, user group, etc
     *
     * @return mixed cached data if exist, NULL otherwise
     */
    private static function _getCache($key, $cache_level = NULL)
    {
        $data = self::$_cache->get($key, $cache_level);

        return (($data !== false) && (!empty($data[0]))) ? $data[0] : NULL;
    }

    private static function _updateHandlers($key, $condition, $cache_level)
    {
        if ($cache_level != self::cacheLevel('time')) {
            foreach ($condition as $table) {
                if (empty(self::$_cache_handlers[$table])) {
                    self::$_cache_handlers[$table] = array();
                }

                self::$_cache_handlers[$table][$key] = true;
                self::$_cache_handlers_are_updated = true;
            }
        }
    }

    /**
     * Saves tracked cached data and clears expired cache
     *
     * @return boolean true if data saved, false if no caches defined
     */
    public static function save()
    {
        if (empty(self::$_cache)) {
            return false;
        }

        foreach (self::$_cached_keys as $key => $arg) {
            if (isset(self::$_storage[$key]) && $arg['track'] == true && $arg['hash'] != md5(serialize(self::$_storage[$key]))) {
                self::$_cache->set($key, self::$_storage[$key], $arg['condition'], $arg['cache_level']);
                self::_updateHandlers($key, $arg['condition'], $arg['cache_level']);
            }
        }
        self::$_cached_keys = array();

        if (self::$_cache_handlers_are_updated == true) {
            self::$_cache->saveHandlers(self::$_cache_handlers);
            self::$_cache_handlers_are_updated = false;
        }

        // Get tags to clear expired cache
        if (!empty(self::$_changed_tables)) {
            $tags = array();
            foreach (self::$_changed_tables as $table => $flag) {
                if (!empty(self::$_cache_handlers[$table])) {
                    $tags = array_merge($tags, array_keys(self::$_cache_handlers[$table]));
                }
            }

            foreach ($tags as $tag) {
                self::del($tag);
            }

            self::$_cache->clear($tags);
            self::$_changed_tables = array();
        }

        return true;
    }

    /**
     * Cleans up cache data
     *
     * @return boolean always true
     */
    public static function cleanup()
    {
        if (empty(self::$_cache)) {
            self::cacheInit();
        }

        return self::$_cache->cleanup();
    }

    /**
     * Generates cache level value for key
     *
     * @param $id cache level name
     * @return string cache level value
     */
    public static function cacheLevel($id)
    {
        if (empty(self::$_cache_levels[$id])) {
            if ($id == 'time') {
                $key = 'time';
            } elseif ($id == 'static') {
                $key = 'cache_' . ACCOUNT_TYPE;
            } elseif ($id == 'day') {
                $key = date('z', TIME);
            } elseif ($id == 'locale') {
                $key = (defined('CART_LOCALIZATION') ? (CART_LOCALIZATION . '_') : '') . CART_LANGUAGE . '_' . CART_SECONDARY_CURRENCY;
            } elseif ($id == 'dispatch') {
                $key = AREA . '_' . $_SERVER['REQUEST_METHOD'] . '_' . str_replace('.', '_', $_REQUEST['dispatch']) . '_' . (defined('CART_LOCALIZATION') ? (CART_LOCALIZATION . '_') : '') . CART_LANGUAGE . '_' . CART_SECONDARY_CURRENCY;
            } elseif ($id == 'user') {
                $key =  AREA . '_' . $_SERVER['REQUEST_METHOD'] . '_' . str_replace('.', '_', $_REQUEST['dispatch']) . '.' . (!empty($_SESSION['auth']['usergroup_ids']) ? implode('_', $_SESSION['auth']['usergroup_ids']) : '') . '.' . (defined('CART_LOCALIZATION') ? (CART_LOCALIZATION . '_') : '') . CART_LANGUAGE . '.' . CART_SECONDARY_CURRENCY;
            } elseif ($id == 'locale_auth') {
                $key = AREA . '_' . $_SERVER['REQUEST_METHOD'] . '_' . (!empty($_SESSION['auth']['user_id']) ? 1 : 0) . '.' . (!empty($_SESSION['auth']['usergroup_ids']) ? implode('_', $_SESSION['auth']['usergroup_ids']) : '') . (defined('CART_LOCALIZATION') ? (CART_LOCALIZATION . '_') : '') . CART_LANGUAGE . '.' . CART_SECONDARY_CURRENCY;
            } elseif ($id == 'html_blocks') {
                $promotion_condition =  (!empty($_SESSION['auth']['user_id']) && db_get_field("SELECT count(*) FROM ?:promotions WHERE status = 'A' AND zone = 'catalog' AND users_conditions_hash LIKE ?l", "%," . $_SESSION['auth']['user_id'] . ",%") > 0)? $_SESSION['auth']['user_id'] : '';
                $key = (defined('CART_LOCALIZATION') ? (CART_LOCALIZATION . '__') : '') . CART_LANGUAGE . '__' . self::cacheLevel('day') . '__' . (!empty($_SESSION['auth']['usergroup_ids'])? implode('_', $_SESSION['auth']['usergroup_ids']) : '') . '__' . $promotion_condition;
            }

            if (!empty($key)) {
                self::$_cache_levels[$id] = $key;
            }
        }

        if (empty(self::$_cache_levels[$id])) {
            die('Registry: undefined cache level');
        }

        return self::$_cache_levels[$id];
    }

    /**
     * Clears defined cache levels to redefine them again later
     */
    public static function clearCacheLevels()
    {
        self::$_cache_levels = array();
    }
}
