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
    
    // Update the registry
    if ($mode == 'updateregistry') {
        /*echo '<pre>'; 
        print_r($_REQUEST['registry_data']);
        echo '</pre>';
        echo ">>".$_REQUEST['registry_data']['hgr_id'];*/
        //die('here... yupppp');
        
        if (!empty($_REQUEST['registry_data'])) {
            list($registry_id) = fn_update_registry($_REQUEST['registry_data'], $_REQUEST['registry_data']['hgr_id']);
        }
		//echo ">>".$registry_id;
		//die('here... yupppp');
        
        // Update event products
        if (!empty($_REQUEST['registry_products'])) {
            /*$event_id = empty($event_id) ? $_REQUEST['event_id'] : $event_id;
            unset($_REQUEST['event_products']['custom_files']);
            fn_update_event_products($event_id, $_REQUEST['event_products']);*/
        }
		Registry::get('view')->assign('hgr_id', $_REQUEST['registry_data']['hgr_id']);
		fn_set_notification('N', __('notice'), "Your Holiday or Gift Registry updated successfully");
        $suffix = ".addreg?hgr_id=$registry_id";
        
    }
    
    // Add products to the registry
    if ($mode == 'add_products') {
		/*echo '<pre>';
		//print_r($_REQUEST);
		print_r($_REQUEST['product_data']);
		echo'</pre>';
		*/
		//die('yes---yuppppp');
        if (!empty($_REQUEST['product_data'])) {
            fn_update_holidayorgift_registry_products($_REQUEST['registry_type_id'], $_REQUEST['product_data'], true);
        }
        
        //fn_set_notification('N', __('notice'), __('text_email_sent'));
        Registry::get('view')->assign('registry_type_id', $_REQUEST['registry_type_id']);
        
        $suffix = ".update&registry_type_id=".$_REQUEST['registry_type_id'];
    }
    
    if ($mode == 'update') {
        
        if (empty($auth['user_id'])) {
			return array(CONTROLLER_STATUS_REDIRECT, "auth.login_form?return_url=" . urlencode(Registry::get('config.current_url')));
		}
		/*echo '<pre>';
		print_r($_REQUEST['event_products']);
		echo'</pre>';
		echo ">>".$_REQUEST['registry_type_id'];*/
		//die('yes---yuppppp');
		
        // Update event products
        if (!empty($_REQUEST['event_products'])) {
            $registry_type_id = $_REQUEST['registry_type_id'];
            unset($_REQUEST['event_products']['custom_files']);
            fn_update_holidayorgift_registry_products($_REQUEST['registry_type_id'], $_REQUEST['event_products']);
        }
        $suffix = ".update?registry_type_id=$registry_type_id";
        
    }

    return array(CONTROLLER_STATUS_OK, "hgregistry$suffix");
}

if ($mode == 'update') {
	
	/*echo '<pre>'; 
	print_r($_REQUEST);
	echo '</pre>';*/
	
	if (empty($auth['user_id'])) {
		return array(CONTROLLER_STATUS_REDIRECT, "auth.login_form?return_url=" . urlencode(Registry::get('config.current_url')));
	}
	
    if (empty($_REQUEST['registry_type_id'])) {
        return array(CONTROLLER_STATUS_NO_PAGE);
    }
    
	// Displays no page - if user tries to view other users profile
	if(!empty($auth['user_id'])){
		$registry_data = db_get_row("SELECT * FROM ?:holidayorgift_registry WHERE hgr_id = ?i AND user_id = ?i", $_REQUEST['registry_type_id'], $auth['user_id']);
		
		if(empty($registry_data))
		{	
			return array(CONTROLLER_STATUS_NO_PAGE);
		}
	}

    //die;
    $param = $_REQUEST;
    $param['user_id'] = $auth['user_id'];
    //$param['registry_type_id'] = $_REQUEST['registry_type_id'];
    
    $event_data = db_get_row("SELECT * FROM ?:holidayorgift_registry WHERE hgr_id = ?i", $_REQUEST['registry_type_id']);
    
    list($event_data['products'], $search) = fn_get_holidayorgift_registry_products($param, Registry::get('settings.Appearance.products_per_page'));
	//die('B4 function');
    foreach ($event_data['products'] as $k => $v) {
        $event_data['products'][$k]['extra'] = $event_data['products'][$k]['selected_options'] = unserialize($v['extra']);
        $product_options = $event_data['products'][$k]['extra'];
        $event_data['products'][$k]['product_options'] = fn_get_selected_product_options($v['product_id'], $product_options, CART_LANGUAGE);
        $event_data['products'][$k]['original_price'] = $event_data['products'][$k]['price'] = fn_get_product_price($v['product_id'], 1, $auth);
        $event_data['products'][$k]['avail_amount'] = $v['amount'] - $v['ordered_amount'];

        if (!empty($event_data['products'][$k]['selected_options'])) {
            $options = fn_get_selected_product_options($v['product_id'], $product_options, CART_LANGUAGE);
            foreach ($event_data['products'][$k]['selected_options'] as $option_id => $variant_id) {
                foreach ($options as $option) {
                    if ($option['option_id'] == $option_id && !in_array($option['option_type'], array('I', 'T', 'F')) && empty($variant_id)) {
                        $event_data['products'][$k]['changed_option'] = $option_id;
                        break 2;
                    }
                }
            }
        }
    }

    fn_gather_additional_products_data($event_data['products'], array('get_icon' => true, 'get_detailed' => true, 'get_options' => true, 'get_discounts' => true));

    Registry::get('view')->assign('registry_type_id', $_REQUEST['registry_type_id']);
    Registry::get('view')->assign('event_data', $event_data);
    Registry::get('view')->assign('search', $search);
    
    if (AREA != 'A') {
        fn_add_breadcrumb("Holiday or Gift Registry", "hgregistry.home");
        fn_add_breadcrumb("Manage Holiday or Gift Registry List", "hgregistry.update&registry_type_id=".$_REQUEST['registry_type_id']);
    }
    
}

if ($mode == 'view'){
	
	if (empty($auth['user_id'])) {
		return array(CONTROLLER_STATUS_REDIRECT, "auth.login_form?return_url=" . urlencode(Registry::get('config.current_url')));
	}
	
	if (empty($_REQUEST['registry_type_id'])) {
        return array(CONTROLLER_STATUS_NO_PAGE);
    }
    
    // Displays no page - if user tries to view other users private profile
	if(!empty($auth['user_id'])){
		$registry_data = db_get_row("SELECT * FROM ?:holidayorgift_registry WHERE hgr_id = ?i AND type = ?s", $_REQUEST['registry_type_id'], 'P');
		
		if(empty($registry_data))
		{	
			return array(CONTROLLER_STATUS_NO_PAGE);
		}
	}
    
    $param = $_REQUEST;
    $param['user_id'] = $auth['user_id'];
    
    $event_data = db_get_row("SELECT * FROM ?:holidayorgift_registry WHERE hgr_id = ?i", $_REQUEST['registry_type_id']);
    
    list($event_data['products'], $search) = fn_get_holidayorgift_registry_products($param, Registry::get('settings.Appearance.products_per_page'));
	//die('B4 function');
    foreach ($event_data['products'] as $k => $v) {
        $event_data['products'][$k]['extra'] = $event_data['products'][$k]['selected_options'] = unserialize($v['extra']);
        $product_options = $event_data['products'][$k]['extra'];
        $event_data['products'][$k]['product_options'] = fn_get_selected_product_options($v['product_id'], $product_options, CART_LANGUAGE);
        $event_data['products'][$k]['original_price'] = $event_data['products'][$k]['price'] = fn_get_product_price($v['product_id'], 1, $auth);
        $event_data['products'][$k]['avail_amount'] = $v['amount'] - $v['ordered_amount'];

        if (!empty($event_data['products'][$k]['selected_options'])) {
            $options = fn_get_selected_product_options($v['product_id'], $product_options, CART_LANGUAGE);
            foreach ($event_data['products'][$k]['selected_options'] as $option_id => $variant_id) {
                foreach ($options as $option) {
                    if ($option['option_id'] == $option_id && !in_array($option['option_type'], array('I', 'T', 'F')) && empty($variant_id)) {
                        $event_data['products'][$k]['changed_option'] = $option_id;
                        break 2;
                    }
                }
            }
        }
    }

    fn_gather_additional_products_data($event_data['products'], array('get_icon' => true, 'get_detailed' => true, 'get_options' => true, 'get_discounts' => true));

    Registry::get('view')->assign('registry_type_id', $_REQUEST['registry_type_id']);
    Registry::get('view')->assign('event_data', $event_data);
    Registry::get('view')->assign('search', $search);

}

//
// Home page details
//
if ($mode == 'home') {
    //return array(CONTROLLER_STATUS_REDIRECT, "auth.login_form?return_url=" . urlencode(Registry::get('config.current_url')));
    
    $data = db_get_row("SELECT hgr_id, user_id FROM ?:holidayorgift_registry WHERE user_id = ?s", $auth['user_id']);
	
	if (!empty($data)) {
		$registry_data = $data;
	}
	
	Registry::get('view')->assign('hgr_id', $data['hgr_id']);
	
	if (AREA != 'A') {
        fn_add_breadcrumb("Holiday or Gift Registry", "hgregistry.home");
    }
}

if ($mode == 'addreg') {
	
	if (empty($auth['user_id'])) {
		return array(CONTROLLER_STATUS_REDIRECT, "auth.login_form?return_url=" . urlencode(Registry::get('config.current_url')));
	}
	//die('here');
	
	// Get default Registry data and setting for registry permission 
	$user_data = fn_get_user_info($auth['user_id']);
	$registry_data['yourfname'] = $user_data['firstname'];
	$registry_data['yourlname'] = $user_data['lastname'];
	$registry_data['youremail'] = $user_data['email'];
	$registry_data['type'] = "P";
	
	$data = db_get_row("SELECT * FROM ?:holidayorgift_registry WHERE user_id = ?s", $auth['user_id']);
	if (!empty($data)) {
		$registry_data = $data;
		//$suffix = "?wr_id=$registry_data['wr_id']";
		//die("wregistry.update?registry_type_id=" . $registry_data['wr_id']);
		//return array(CONTROLLER_STATUS_REDIRECT, "wregistry.update?registry_type_id=" . $registry_data['wr_id']);
	}
	
	if (!empty($_REQUEST['hgr_id'])) {
		$registry_data = db_get_row("SELECT * FROM ?:holidayorgift_registry WHERE hgr_id = ?i AND user_id = ?i", $_REQUEST['hgr_id'], $auth['user_id']);
		
		// Displays no page - if user tries to view other users profile
		if($_REQUEST['hgr_id'] != $registry_data['hgr_id']){
			return array(CONTROLLER_STATUS_NO_PAGE);
		}
		
	}
			
	//echo "SELECT * FROM ?:wedding_registry WHERE wr_id = ?i AND user_id = ?i"."--".$_REQUEST['wr_id']."--".$auth['user_id'];
	/*echo '<pre>'; 
	print_r($registry_data);
	echo '</pre>'; 
	die('here');*/
	
		
    //Registry::get('view')->assign('countries', fn_get_simple_countries(true, CART_LANGUAGE));
    //Registry::get('view')->assign('states', fn_get_all_states());
    Registry::get('view')->assign('registry_data', $registry_data);
    Registry::get('view')->assign('registry_type_id', $registry_data['hgr_id']);
	
	//return array(CONTROLLER_STATUS_OK, "wregistry.addreg".$suffix);
	if (AREA != 'A' && !empty($data)) {
        fn_add_breadcrumb("Holiday or Gift Registry", "hgregistry.home");
        fn_add_breadcrumb("Holiday or Gift Registry List", "hgregistry.update&registry_type_id=".$registry_data['hgr_id']);
        fn_add_breadcrumb("Manage Holiday or Gift Registry", "hgregistry.addreg&hgr_id=".$registry_data['hgr_id']);
    }else{
		fn_add_breadcrumb("Holiday or Gift Registry", "hgregistry.home");
        fn_add_breadcrumb("Add Holiday or Gift Registry", "hgregistry.addreg");
	}
} 

if ($mode == 'delete_product' && !empty($_REQUEST['item_id']) && !empty($_REQUEST['registry_type_id'])) {

    $suffix = '?registry_type_id=' . $_REQUEST['registry_type_id'];

    if (!empty($auth['user_id'])) {
        
        if (!empty($_REQUEST['registry_type_id'])) {
			
            db_query("DELETE FROM ?:registry_products WHERE item_id = ?i AND registry_type_id = ?i AND registry_type = ?s", $_REQUEST['item_id'], $_REQUEST['registry_type_id'], 'hgr');
            fn_set_notification('N', __('notice'), 'Product Has Been Deleted');
        }
        
    }

    return array(CONTROLLER_STATUS_REDIRECT, "hgregistry.update".$suffix);
}

if ($mode == 'delete_registry' && !empty($_REQUEST['hgr_id'])) {

    
    if (!empty($auth['user_id'])) {
        
        if (!empty($_REQUEST['hgr_id'])) {
			
			// Get current users holidayorgift registry ID
			$current_hgr_id = db_get_field("SELECT hgr_id FROM ?:holidayorgift_registry WHERE user_id = ?i", $auth['user_id']);
			
			// Displays no page - if user tries to view other users profile
			if($_REQUEST['hgr_id'] != $current_hgr_id){
				return array(CONTROLLER_STATUS_NO_PAGE);
			}
			
            db_query("DELETE FROM ?:holidayorgift_registry WHERE hgr_id = ?i AND user_id = ?i", $_REQUEST['hgr_id'], $auth['user_id']);
            db_query("DELETE FROM ?:registry_products WHERE registry_type_id = ?i AND user_id = ?i AND registry_type = ?s", $_REQUEST['hgr_id'], $auth['user_id'], 'hgr');
            fn_set_notification('N', __('notice'), 'Your Registry Has Been Deleted');
        }
        
    }
	
    return array(CONTROLLER_STATUS_REDIRECT, "hgregistry.home");
}


//////////////////////////////////////////

function fn_get_holidayorgift_registry_products($params, $items_per_page = 0, $lang_code = CART_LANGUAGE)
{
    $default_params = array (
		'registry_type' => 'hgr',
        'page' => 1,
        'user_id' => 0,
        'items_per_page' => $items_per_page
    );

    $params = array_merge($default_params, $params);
	/*echo '<pre>';
	print_r($params);
	*/
    $limit = '';
    if (!empty($params['items_per_page'])) {
        $params['total_items'] = db_get_field("SELECT DISTINCT(COUNT(*)) FROM ?:registry_products WHERE registry_type = ?s AND registry_type_id = ?i", $params['registry_type'], $params['registry_type_id']);
        $limit = db_paginate($params['page'], $params['items_per_page']);
    }
	//echo "SELECT * FROM ?:registry_products LEFT JOIN ?:product_descriptions ON ?:product_descriptions.product_id = ?:registry_products.product_id AND ?:product_descriptions.lang_code = ?s WHERE registry_type = ?s AND registry_type_id = ?i". $limit.", 'item_id',". $lang_code.", ".$params['registry_type'].", ".$params['registry_type_id'];
    $products = db_get_hash_array("SELECT * FROM ?:registry_products LEFT JOIN ?:product_descriptions ON ?:product_descriptions.product_id = ?:registry_products.product_id AND ?:product_descriptions.lang_code = ?s WHERE registry_type = ?s AND registry_type_id = ?i ORDER BY lastadded DESC $limit", 'item_id', $lang_code, $params['registry_type'], $params['registry_type_id']);
	/*echo '<pre>';
	print_r($products);
	print_r($params);
	echo '</pre>';*/
	//die('Products');
    return array($products, $params);
}

function fn_update_registry($event_data, $event_id = 0)
{
    //echo ">>>".$event_data['event_date'];
    //$event_data['event_date'] = fn_parse_date($event_data['event_date']);
    $event_data['modified_date'] = TIME;
    //$event_data['end_date'] = fn_parse_date($event_data['end_date'], true);
	//die('yes');
	
    $_data = $event_data;
    $_data['user_id'] = $_SESSION['auth']['user_id'];

    if (empty($event_id)) {
		//die($event_id."--if");
        $event_id = db_query("INSERT INTO ?:holidayorgift_registry ?e", $_data);
    } else {
		//die($event_id."--else");
        unset($_data['user_id']);
        db_query("UPDATE ?:holidayorgift_registry SET ?u WHERE hgr_id = ?i", $_data, $event_id);
    }

    return array($event_id);
}

function fn_update_holidayorgift_registry_products($registry_type_id, $event_products, $is_add = false)
{
    foreach ($event_products as $item_id => $data) {

        $product_id = ($is_add || empty($data['product_id'])) ? $item_id : $data['product_id'];

        $data['item_id'] = fn_generate_cart_id($product_id, array("product_options" => (!empty($data['product_options']) ? $data['product_options'] : array())), false);

        if (!empty($data['product_options'])) {
            $data['extra'] = serialize($data['product_options']);
        }
        
        $data['registry_type'] = 'hgr';
        $data['registry_type_id'] = $registry_type_id;
		$data['user_id'] = $user_id = $_SESSION['auth']['user_id'];
		$data['lastadded'] = TIME;
		
        if ($is_add || $data['item_id'] != $item_id) {
			$existent_amount = db_get_field("SELECT amount FROM ?:registry_products WHERE item_id = ?i AND registry_type_id = ?i AND registry_type = ?s", $data['item_id'], $registry_type_id, 'hgr');
            //die('if');
            $data['product_id'] = $product_id;
            if (!$is_add) {
                db_query("DELETE FROM ?:registry_products WHERE item_id = ?i AND registry_type_id = ?i AND registry_type = ?s", $data['item_id'], $registry_type_id, 'hgr');
            }
            if (!empty($data['amount'])) {
                $data['amount'] += $existent_amount;
                db_query("REPLACE INTO ?:registry_products ?e", $data);
            }
        } else {
			//die('else');
			$existent_amount = db_get_field("SELECT amount FROM ?:registry_products WHERE item_id = ?i AND registry_type_id = ?i AND registry_type = ?s", $data['item_id'], $registry_type_id, 'hgr');
            if (!empty($data['amount'])) {
				if($data['amount'] != $existent_amount){
					db_query("UPDATE ?:registry_products SET ?u WHERE item_id = ?i AND registry_type_id = ?i AND registry_type = ?s", $data, $item_id, $registry_type_id, 'hgr');
				}
                
            } else {
                db_query("DELETE FROM ?:registry_products WHERE item_id = ?i AND registry_type_id = ?i AND registry_type = ?s", $data['item_id'], $registry_type_id, 'hgr');
            }
        }
    }

    return true;
}
