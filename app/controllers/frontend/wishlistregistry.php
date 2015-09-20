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

if (!defined('BOOTSTRAP')) { die('Access denied'); }

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
}

//
// Search products
//
if ($mode == 'search') {
	
	$param = $_REQUEST;
    if(!isset($param['stype'])){
		 $param['stype'] = 'wl';
	}
   
	/*if(!isset($param['lname']) || !isset($param['lname'])){
		 return array(CONTROLLER_STATUS_NO_PAGE);
	}*/
    
    /*echo '<pre>';
	print_r($param);
    echo '</pre>';*/
    
    if(isset($param['lname'])){
		 list($products, $search) = fn_get_reg_users($param, Registry::get('settings.Appearance.products_per_page'));
	}
			
	if (!empty($products)) {
		$_SESSION['continue_url'] = Registry::get('config.current_url');
	}
	
	$searchedFor = $param['fname'].' '.$param['lname'];
		
	//$selected_layout = fn_get_products_layout($params);

	Registry::get('view')->assign('products', $products);
	Registry::get('view')->assign('search', $search);
	
	Registry::get('view')->assign('searchedFor', $searchedFor);
	Registry::get('view')->assign('searchtype', $param['stype']);
	Registry::get('view')->assign('fname', $param['fname']);
	Registry::get('view')->assign('lname', $param['lname']);
	
	Registry::get('view')->assign('in', $search['in']);
	//Registry::get('view')->assign('selected_layout', $selected_layout);
	
	Registry::get('view')->assign('wishliststr', $search['wishliststr']);
	Registry::get('view')->assign('regfname', $search['regfname']);
	Registry::get('view')->assign('reglname', $search['reglname']);
	
	
}


function fn_get_reg_users($params, $items_per_page = 0, $lang_code = CART_LANGUAGE)
{
		
	$default_params = array (
        'page' => 1,
        'items_per_page' => $items_per_page
    );
	
	$params = array_merge($default_params, $params);
	
	if($params['stype'] == 'wl'){
		
		$params['in'] = 'Wish List';
		$tableName = 'users';
		
		/**************************** BUILD SEARCH QUERY START *********************************/
		$condition .= db_quote(" status = ?s AND user_type = ?s", "A", "C");
		
		if(!empty($params['lname'])){
			$yourlname = $params['lname'];
			$condition .= db_quote(" AND (lastname like ?l OR email like ?l)", "%$yourlname%", "%$yourlname%");
			
			$params['wishliststr'] = $params['lname'];
		}
		
		$limit = '';
		if (!empty($params['items_per_page'])) {
			$params['total_items'] = db_get_field("SELECT DISTINCT(COUNT(*)) FROM ?:$tableName WHERE $condition");
			$limit = db_paginate($params['page'], $params['items_per_page']);
		}
		
		//echo "SELECT * from ?:$tableName WHERE $condition $limit";
		$reg_users = db_get_array("SELECT user_id, user_type, firstname, lastname, email from ?:$tableName WHERE $condition $limit");
		//die('check');
		/**************************** BUILD SEARCH QUERY END *********************************/
		
	}else{
		
		if($params['stype'] == 'wr'){
			$params['in'] = 'Wedding Registry';
			$tableName = 'wedding_registry';
		}
		if($params['stype'] == 'bbr'){
			$params['in'] = 'Baby Registry';
			$tableName = 'baby_registry';
		}
		if($params['stype'] == 'br'){
			$params['in'] = 'Birthday Registry';
			$tableName = 'birthday_registry';
		}
		if($params['stype'] == 'hgr'){
			$params['in'] = 'Holiday or Gift Registry';
			$tableName = 'holidayorgift_registry';
		}
		
		
		/**************************** BUILD SEARCH QUERY START *********************************/
		
		$condition .= db_quote(" type = ?s ", "P");
		//die;
		if($params['stype'] == 'br'){
			if(!empty($params['lname'])){
				$yourlname = $params['lname'];
				$condition .= db_quote(" AND lname like ?l ", "%$yourlname%");
				
				$params['reglname'] = $params['lname'];
			}
			
			if(!empty($params['fname'])){
				$yourfname = $params['fname'];
				$condition .= db_quote(" AND fname like ?l ", "%$yourfname%");
				
				$params['regfname'] = $params['fname'];
			}
		}else{
			if(!empty($params['lname'])){
				$yourlname = $params['lname'];
				$condition .= db_quote(" AND yourlname like ?l ", "%$yourlname%");
				
				$params['reglname'] = $params['lname'];
			}
			
			if(!empty($params['fname'])){
				$yourfname = $params['fname'];
				$condition .= db_quote(" AND yourfname like ?l ", "%$yourfname%");
				
				$params['regfname'] = $params['fname'];
			}
		}
		
		
		$limit = '';
		if (!empty($params['items_per_page'])) {
			$params['total_items'] = db_get_field("SELECT DISTINCT(COUNT(*)) FROM ?:$tableName WHERE $condition");
			$limit = db_paginate($params['page'], $params['items_per_page']);
		}
		
		//echo "SELECT * from ?:$tableName WHERE $condition $limit";
		
		$reg_users = db_get_array("SELECT * from ?:$tableName WHERE $condition $limit");
		
		/**************************** BUILD SEARCH QUERY END *********************************/
	
	}
	
	/*
	echo '<pre>';
	print_r($reg_users);
	print_r($params);
	echo '</pre>HPC7K3MJGCNM8';
	*/
	//die('here');
	
	return array($reg_users, $params);
}
