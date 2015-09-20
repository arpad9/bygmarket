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
use Tygh\Debugger;
use Tygh\Database;

if ( !defined('BOOTSTRAP') || empty($_SESSION['DEBUGGER_ACTIVE']) ) { die('Access denied'); }

if ($mode == 'sql_parse') {

    fn_trusted_vars('query');

    if (!empty($_REQUEST['debugger_hash']) && !empty($_SESSION['DEBUGGER'][$_REQUEST['debugger_hash']]['sql']) && isset($_REQUEST['sql_id'])) {
        $query = stripslashes($_SESSION['DEBUGGER'][$_REQUEST['debugger_hash']]['sql']['queries'][$_REQUEST['sql_id']]['query']);
        $backtrace = $_SESSION['DEBUGGER'][$_REQUEST['debugger_hash']]['backtraces'][$_REQUEST['sql_id']];
        $_REQUEST['sandbox'] = true;
    } else {
        $query = $_REQUEST['query'];
    }

    $result = $explain = array();
    $query_time = $start_time = 0;

    if (!empty($_REQUEST['sandbox'])) {
        db_query('SET AUTOCOMMIT=0');
        db_query('START TRANSACTION');
    }

    $stop_queries = array('DROP','CREATE', 'TRANSACTION', 'ROLLBACK');
    $stop_exec = false;
    foreach ($stop_queries as $stop_query) {
        if (stripos(trim($query), $stop_query) !== false) {
            $result = false;
            $stop_exec = true;
            break;
        }
    }

    if (!$stop_exec) {
        Database::$raw = true;

        $time_start = microtime(true);

        if (stripos(trim($query), 'SELECT') !== false) {
            $result = db_get_array($query);
            $result_columns = !empty($result[0]) ? array_keys($result[0]) : array();
        } else {
            $result = db_query($query);
        }

        $query_time = microtime(true) - $time_start;
    }

    if (strpos($query, 'SELECT') === 0) {
        $explain = db_get_array('EXPLAIN ' . $query);
    }

    if (!empty($_REQUEST['sandbox'])) {
        db_query('ROLLBACK');
    }

    if (!$stop_exec) {
        try {
            $parser = new PHPSQLParser($query);
            $creator = new PHPSQLCreator($parser->parsed);
            $query = $creator->created;
        } catch (Exception $e) {

        }
    }

    if ($stop_exec) {
        Registry::get('view')->assign('stop_exec', $stop_exec);
    }
    if (!empty($query_time)) {
        Registry::get('view')->assign('query_time', sprintf('%.5f', $query_time));
    }
    if (!empty($query)) {
        Registry::get('view')->assign('query', $query);
    }
    if (!empty($explain)) {
        Registry::get('view')->assign('explain', $explain);
    }
    if (isset($result)) {
        Registry::get('view')->assign('result', $result);
    }
    if (!empty($result_columns)) {
        Registry::get('view')->assign('result_columns', $result_columns);
    }
    if (!empty($backtrace)) {
        Registry::get('view')->assign('backtrace', $backtrace, false);
    }
    Registry::get('view')->display('views/debugger/components/sql_parse.tpl');
    exit();

} elseif ($mode == 'server') {

    Registry::get('view')->display('views/debugger/components/server_tab.tpl');
    exit();

} elseif ($mode == 'request') {

    if (!empty($_REQUEST['debugger_hash']) && !empty($_SESSION['DEBUGGER'][$_REQUEST['debugger_hash']]['request'])) {
        $data = $_SESSION['DEBUGGER'][$_REQUEST['debugger_hash']]['request'];
        Registry::get('view')->assign('data', $data);
        Registry::get('view')->assign('debugger_hash', $_REQUEST['debugger_hash']);
        Registry::get('view')->display('views/debugger/components/request_tab.tpl');
    }
    exit();

} elseif ($mode == 'config') {

    if (!empty($_REQUEST['debugger_hash']) && !empty($_SESSION['DEBUGGER'][$_REQUEST['debugger_hash']]['config'])) {
        $data = $_SESSION['DEBUGGER'][$_REQUEST['debugger_hash']]['config'];
        Registry::get('view')->assign('data', $data);
        Registry::get('view')->display('views/debugger/components/config_tab.tpl');
    }
    exit();

} elseif ($mode == 'sql') {

    if (!empty($_REQUEST['debugger_hash']) && !empty($_SESSION['DEBUGGER'][$_REQUEST['debugger_hash']]['sql'])) {
        $data = array(
            'totals' => $_SESSION['DEBUGGER'][$_REQUEST['debugger_hash']]['sql']['totals'],
            'list' => $_SESSION['DEBUGGER'][$_REQUEST['debugger_hash']]['sql']['queries'],
            'count' => array(),
        );
        foreach ($data['list'] as $sql_data) {
            if (empty($data['count'][md5($sql_data['query'])])) {
                $data['count'][md5($sql_data['query'])] = array(
                    'query' => $sql_data['query'],
                    'total_time' => 0,
                    'count_time' => 0,
                    'count' => 0,
                );
            }
            $data['count'][md5($sql_data['query'])]['total_time'] += $sql_data['time'];
            $data['count'][md5($sql_data['query'])]['count_time']++;
            $data['count'][md5($sql_data['query'])]['count']++;
            if ($data['count'][md5($sql_data['query'])]['count'] > $data['totals']['rcount']) {
                $data['totals']['rcount'] = $data['count'][md5($sql_data['query'])]['count'];
            }
            if (!isset($data['count'][md5($sql_data['query'])]['min_time']) || $data['count'][md5($sql_data['query'])]['max_time'] < $sql_data['time']) {
                $data['count'][md5($sql_data['query'])]['max_time'] = $sql_data['time'];
            }
            if (!isset($data['count'][md5($sql_data['query'])]['min_time']) || $data['count'][md5($sql_data['query'])]['min_time'] > $sql_data['time']) {
                $data['count'][md5($sql_data['query'])]['min_time'] = $sql_data['time'];
            }
        }
        Registry::get('view')->assign('medium_query_time', Debugger::MEDIUM_QUERY_TIME);
        Registry::get('view')->assign('long_query_time', Debugger::LONG_QUERY_TIME);

        Registry::get('view')->assign('data', $data);
        Registry::get('view')->assign('debugger_hash', $_REQUEST['debugger_hash']);
        Registry::get('view')->display('views/debugger/components/sql_tab.tpl');
    }
    exit();

} elseif ($mode == 'logging') {

    if (!empty($_REQUEST['debugger_hash']) && !empty($_SESSION['DEBUGGER'][$_REQUEST['debugger_hash']]['logging'])) {
        $data = $_SESSION['DEBUGGER'][$_REQUEST['debugger_hash']]['logging'];
        Registry::get('view')->assign('data', $data);
        Registry::get('view')->assign('debugger_hash', $_REQUEST['debugger_hash']);
        Registry::get('view')->display('views/debugger/components/logging_tab.tpl');
    }
    exit();

} elseif ($mode == 'templates') {

    if (!empty($_REQUEST['debugger_hash']) && !empty($_SESSION['DEBUGGER'][$_REQUEST['debugger_hash']]['templates'])) {
        $data = $_SESSION['DEBUGGER'][$_REQUEST['debugger_hash']]['templates'];
        $data['tpls'] = Debugger::parseTplsList($data['tpls'], 0);

        Registry::get('view')->assign('data', $data);
        Registry::get('view')->assign('debugger_hash', $_REQUEST['debugger_hash']);
        Registry::get('view')->display('views/debugger/components/templates_tab.tpl');
    }
    exit();

} elseif ($mode == 'clear_session') {

    if (!empty($_SESSION['DEBUGGER'])) {
        if (!empty($_REQUEST['debugger_hash'])) {
           unset($_SESSION['DEBUGGER'][$_REQUEST['debugger_hash']]);
        } else {
           unset($_SESSION['DEBUGGER']);
        }
    }
    Registry::get('view')->assign('size', strlen(serialize($_SESSION)) / 1024);
    Registry::get('view')->display('views/debugger/components/session_size.tpl');
    exit();
} elseif ($mode == 'clear_cache') {
    fn_clear_cache();
    fn_set_notification('N', __('notice'), __('cache_cleared'));

    exit();
}
