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

Use Tygh\Session;

class Debugger
{
    const MEDIUM_QUERY_TIME = 0.2;
    const LONG_QUERY_TIME = 3;

    public static $checkpoints = array();
    public static $queries = array();
    public static $backtraces = array();
    public static $totals = array(
        'count_queries' => 0,
        'time_queries' => 0,
        'time_page' => 0,
        'memory_page' => 0,
    );

    public static function checkpoint($name)
    {
        if (empty($_SESSION['DEBUGGER_ACTIVE']) && !empty($_SESSION)) {
            return false;
        }

        self::$checkpoints[$name] = array(
            'time' => self::microtime(),
            'memory' => memory_get_usage(),
            'included_files' => count(get_included_files()),
            'queries' => count(self::$queries),
        );

        return true;
    }

    public static function microtime()
    {
        list($usec, $sec) = explode(' ', microtime());

        return ((float) $usec + (float) $sec);
    }

    public static function display()
    {
        if (empty($_SESSION['DEBUGGER_ACTIVE']) || defined('AJAX_REQUEST')) {
            return false;
        }

        $hash = time();

        $ch_p = array_values(self::$checkpoints);

        $included_templates = array();
        $depth = array();
        $d = 0;
        foreach (Registry::get('view')->template_objects as $k => $v) {
            if (count(explode('#', $k)) == 1) {
                continue;
            }

            list(, $tpl) = explode('#', $k);

            if (!empty($v->parent)) {
                if (property_exists($v->parent, 'template_resource')) {

                    if (empty($depth[$v->parent->template_resource])) {
                        $depth[$v->parent->template_resource] = ++$d;
                    }

                    $included_templates[] = array(
                        'filename' => $tpl,
                        'depth' => $depth[$v->parent->template_resource]
                    );
                }
            }
        }

        $assigned_vars = Registry::get('view')->tpl_vars;
        ksort($assigned_vars);
        $exclude_vars = array('_REQUEST', 'config', 'settings', 'runtime', 'demo_password', 'demo_username', 'empty', 'ldelim', 'rdelim');
        foreach ($assigned_vars as $name => $value_obj) {
            if (in_array($name, $exclude_vars)) {
                unset($assigned_vars[$name]);
            } else {
                $assigned_vars[$name] = $value_obj->value;
            }
        }

        self::$totals['time_page'] = $ch_p[count($ch_p)-1]['time'] - $ch_p[0]['time'];
        self::$totals['memory_page'] = ($ch_p[count($ch_p)-1]['memory'] - $ch_p[0]['memory']) / 1024;
        self::$totals['count_queries'] = count(self::$queries);
        self::$totals['count_tpls'] = count($included_templates);

        $runtime = fn_foreach_recursive(Registry::get('runtime'), '.');
        foreach ($runtime as $key => $value) {
            if (in_array(gettype($value), array('object', 'resource'))) {
                $runtime[$key] = gettype($value);
            }
        }

        $_SESSION['DEBUGGER'][$hash] = array(
            'request' => array(
                'request' => $_REQUEST,
                'server' => $_SERVER,
                'cookie' => $_COOKIE,
            ),
            'config' => array(
                'runtime' => $runtime,
            ),
            'sql' => array(
                'totals' => array(
                    'count' => self::$totals['count_queries'],
                    'rcount' => 0,
                    'time' => self::$totals['time_queries'],
                ),
                'queries' => self::$queries,
            ),
            'backtraces' => self::$backtraces,
            'logging' => self::$checkpoints,
            'templates' => array(
                'tpls' => $included_templates,
                'vars' => $assigned_vars,
            ),
            'totals' => self::$totals,
        );

        self::$totals['size_session'] = strlen(serialize($_SESSION)) / 1024;
        if (self::$totals['size_session'] > 5000) {
            foreach ($_SESSION['DEBUGGER'] as $h => $data) {
                if ($h < time() - 60*60) {
                    unset($_SESSION['DEBUGGER'][$h]);
                }
            }
            self::$totals['size_session'] = strlen(serialize($_SESSION)) / 1024;
        }
        $_SESSION['DEBUGGER'][$hash]['totals']['size_session'] = self::$totals['size_session'];

        if (!self::checkAllowDebugger()) {
            return false;
        }

        Registry::get('view')->assign('debugger_hash', $hash);
        Registry::get('view')->assign('totals', self::$totals);

        Registry::get('view')->display('views/debugger/debugger.tpl');

        return true;
    }

    public static function set_query($query, $time)
    {
        if (empty($_SESSION['DEBUGGER_ACTIVE']) && !empty($_SESSION)) {
            return false;
        }

        self::$queries[] = array(
            'query' => $query,
            'time' => $time,
        );
        if (defined('DEBUG_BACKTRACE_IGNORE_ARGS')) {
            $debug_backtrace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS);
        } else {
            $debug_backtrace = debug_backtrace(false);
        }
        array_shift($debug_backtrace);
        foreach ($debug_backtrace as $key => $backtrace) {
            $backtrace['file'] = !empty($backtrace['file']) ? $backtrace['file'] : '';
            $backtrace['function'] = !empty($backtrace['function']) ? $backtrace['function'] : '';
            $backtrace['line'] = !empty($backtrace['line']) ? $backtrace['line'] : '';

            $debug_backtrace[$key] = $backtrace['file'] . '#' . $backtrace['function'] . '#' . $backtrace['line'];
        }
        self::$backtraces[] = $debug_backtrace;
        self::$totals['time_queries'] += $time;

        return true;
    }

    public static function parseTplsList($tpls_list, $i, $return_i = false)
    {
        $tpls_ar = array();
        foreach ($tpls_list as $key => $tpl) {
            if ($key < $i) {
                continue;
            }

            $ar = array();
            $ar['name'] = $tpl['filename'];
            if (!empty($tpls_list[$key+1]) && $tpls_list[$key+1]['depth'] > $tpl['depth']) {
                list($ar['childs'], $i) = self::parseTplsList($tpls_list, $key+1, true);
            }

            $tpls_ar[] = $ar;
            if (($i > $key && !empty($tpls_list[$i]) && $tpls_list[$i]['depth'] < $tpl['depth']) || !empty($tpls_list[$key+1]) && $tpls_list[$key+1]['depth'] < $tpl['depth']) {
                $key = $i > $key ? $i-1 : $key;
                break;
            }
        }

        if ($return_i) {
            $return = array($tpls_ar, $key+1);
        } else {
            $return = $tpls_ar;
        }

        return $return;
    }

    public static function checkAllowDebugger()
    {
        if (!empty($_SESSION['DEBUGGER_ACTIVE']) && AREA == 'A' && $_SESSION['auth']['user_type'] == 'A' && $_SESSION['auth']['is_root'] == 'Y') {
            return true;
        }

        $debugger_hash = array();
        if (!empty($_SESSION['DEBUGGER_ACTIVE'])) {
            $sess_name = explode('_', Session::getName());
            $admin_cooks = array();
            foreach ($_COOKIE as $cook_name => $cook_value) {
                $cook_name = explode('_', $cook_name);
                if (count($cook_name) == 3 && $cook_name[0] == 'sid' && $cook_name[1] == 'admin') {
                    $admin_cooks[] = $cook_value;
                }
            }
            foreach ($admin_cooks as $admin_cook) {
                $user_admin = db_get_row('SELECT email, password FROM ?:users WHERE user_type = ?s AND is_root = ?s', 'A', 'Y');
                $debugger_hash[] = md5($admin_cook . $user_admin['email'] . $user_admin['password']);
            }
        }

        $debugger_cookie = !empty($_COOKIE['debugger']) ? $_COOKIE['debugger'] : '';
        if (!empty($_SESSION['DEBUGGER_ACTIVE']) && !in_array($debugger_cookie, $debugger_hash)) {
            unset($_SESSION['DEBUGGER_ACTIVE']);
        }

        if (empty($_SESSION['DEBUGGER_ACTIVE'])) {
            return false;
        }

        return true;
    }

}
