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
use Tygh\Storage;

if (!defined('BOOTSTRAP')) { die('Access denied'); }

$_SESSION['wishlist'] = isset($_SESSION['wishlist']) ? $_SESSION['wishlist'] : array();
$wishlist = & $_SESSION['wishlist'];
$_SESSION['continue_url'] = isset($_SESSION['continue_url']) ? $_SESSION['continue_url'] : '';
$auth = & $_SESSION['auth'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Add product to the wishlist
    if ($mode == 'add') {
        // wishlist is empty, create it
        if (empty($wishlist)) {
            $wishlist = array(
                'products' => array()
            );
        }

        $prev_wishlist = $wishlist['products'];

        $product_ids = fn_add_product_to_wishlist($_REQUEST['product_data'], $wishlist, $auth);

        fn_save_cart_content($wishlist, $auth['user_id'], 'W');

        $added_products = array_diff_assoc($wishlist['products'], $prev_wishlist);

        if (defined('AJAX_REQUEST')) {
            if (!empty($added_products)) {
                foreach ($added_products as $key => $data) {
                    $product = fn_get_product_data($data['product_id'], $auth);
                    $product['extra'] = !empty($data['extra']) ? $data['extra'] : array();
                    fn_gather_additional_product_data($product, true, true);
                    $added_products[$key]['product_option_data'] = fn_get_selected_product_options_info($data['product_options']);
                    $added_products[$key]['display_price'] = $product['price'];
                    $added_products[$key]['amount'] = empty($data['amount']) ? 1 : $data['amount'];
                    $added_products[$key]['main_pair'] = fn_get_cart_product_icon($data['product_id'], $data);
                }
                Registry::get('view')->assign('added_products', $added_products);

                if (Registry::get('settings.General.allow_anonymous_shopping') == 'P') {
                    Registry::get('view')->assign('hide_amount', true);
                }

                $title = __('product_added_to_wl');
                $msg = Registry::get('view')->fetch('addons/wishlist/views/wishlist/components/product_notification.tpl');
                fn_set_notification('I', $title, $msg, 'I');
            } else {
                if ($product_ids) {
                    fn_set_notification('W', __('notice'), __('product_in_wishlist'));  
                } else {
                    exit;
                }
            }
            exit;
        }
        unset($_REQUEST['redirect_url']);
    }
    
    if($mode == 'add_products'){
		
		/*echo '<pre>';
		print_r($_REQUEST['product_data']);
		print_r($auth);
		echo'</pre>';
		*/
		//die('yes---yuppppp');
		if (empty($auth['user_id'])) {
			return array(CONTROLLER_STATUS_REDIRECT, "auth.login_form?return_url=" . urlencode(Registry::get('config.current_url')));
		}
		
		if (!empty($_REQUEST['product_data'])) {
            fn_update_wishlists_products($_REQUEST['product_data'], true);
            fn_set_notification('N', __('notice'), 'Products Added to your wish list');
        }
        //$suffix = ".update?selected_section=products&event_id=$_REQUEST[event_id]";
		
		
	}
	
	// Update the wishlist product
    if ($mode == 'update') {
        
        if (empty($auth['user_id'])) {
			return array(CONTROLLER_STATUS_REDIRECT, "auth.login_form?return_url=" . urlencode(Registry::get('config.current_url')));
		}
		/*echo '<pre>';
		print_r($_REQUEST['event_products']);
		print_r($auth);
		echo'</pre>';
		die('yes---yuppppp');*/
		
        // Update event products
        if (!empty($_REQUEST['event_products'])) {
            $event_id = $auth['user_id'];
            unset($_REQUEST['event_products']['custom_files']);
            fn_update_wishlists_products($_REQUEST['event_products']);
        }
        
    }

    return array(CONTROLLER_STATUS_OK, "wishlists.update");
}

if ($mode == 'clear') {
    $wishlist = array();

    fn_save_cart_content($wishlist, $auth['user_id'], 'W');

    return array(CONTROLLER_STATUS_REDIRECT, "wishlist.view");

} elseif ($mode == 'delete' && !empty($_REQUEST['cart_id'])) {
    fn_delete_wishlist_product($wishlist, $_REQUEST['cart_id']);

    fn_save_cart_content($wishlist, $auth['user_id'], 'W');

    return array(CONTROLLER_STATUS_OK, "wishlist.view");
//
// Update wishlist
//
} elseif ($mode == 'update') {
	
    if (empty($auth['user_id'])) {
		return array(CONTROLLER_STATUS_REDIRECT, "auth.login_form?return_url=" . urlencode(Registry::get('config.current_url')));
	}

   // $event_data = db_get_row("SELECT * FROM ?:giftreg_events WHERE event_id = ?i", $_REQUEST['event_id']);

    //$event_data['fields'] = db_get_hash_single_array("SELECT * FROM ?:giftreg_event_fields WHERE ?:giftreg_event_fields.event_id = ?i", array('field_id', 'value'), $_REQUEST['event_id']);

    //$event_data['subscribers'] = db_get_array("SELECT name, email FROM ?:giftreg_event_subscribers WHERE event_id = ?i ORDER BY name, email", $_REQUEST['event_id']);

	$params['user_id'] = $auth['user_id'];
	if(!empty($_REQUEST['page'])){ $params['page'] = $_REQUEST['page'];}
    list($event_data['products'], $search) = fn_get_wishlists_products($params, Registry::get('settings.Appearance.products_per_page'));

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

    Registry::get('view')->assign('event_id', $auth['user_id']);
    Registry::get('view')->assign('event_data', $event_data);
    Registry::get('view')->assign('search', $search);

    Registry::set('navigation.tabs', array (
        'general' => array (
            'title' => __('general'),
            'js' => true
        ),
        'products' => array (
            'title' => __('products'),
            'js' => true
        ),
        'notifications' => array (
            'title' => __('notifications'),
            'js' => true
        ),
    ));

    if (AREA != 'A') {
        fn_add_breadcrumb("Wish Lists", "wishlists.update");
    }

} elseif ($mode == 'view') {

	if (empty($_REQUEST['user_id'])) {
		return array(CONTROLLER_STATUS_REDIRECT, "auth.login_form?return_url=" . urlencode(Registry::get('config.current_url')));
	}

    fn_add_breadcrumb(__('wishlist_content'));
        
    list($event_data['products'], $search) = fn_get_wishlists_products($_REQUEST, Registry::get('settings.Appearance.products_per_page'));

    foreach ($event_data['products'] as $k => $v) {
        $event_data['products'][$k]['extra'] = $event_data['products'][$k]['selected_options'] = unserialize($v['extra']);
        $product_options = $event_data['products'][$k]['extra'];
        $event_data['products'][$k]['product_options'] = fn_get_selected_product_options($v['product_id'], $product_options, CART_LANGUAGE);
        $event_data['products'][$k]['original_price'] = $event_data['products'][$k]['price'] = fn_get_product_price($v['product_id'], 1, $auth);
        $event_data['products'][$k]['avail_amount'] = $v['amount'] - $v['ordered_amount'];
        $event_data['products'][$k]['disabled_options'] = true;

        $event_data['products'][$k]['product_options_ids'] = $event_data['products'][$k]['extra'];
        $event_data['products'][$k]['product_options_combination'] = fn_get_options_combination($event_data['products'][$k]['product_options_ids']);
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
	
	/*echo '<pre>';
	print_r($event_data);
	die('data');*/
	
    Registry::get('view')->assign('event_id', $auth['user_id']);
    Registry::get('view')->assign('event_data', $event_data);
    Registry::get('view')->assign('search', $search);
        
} elseif ($mode == 'delete_file' && isset($_REQUEST['cart_id'])) {
    if (isset($wishlist['products'][$_REQUEST['cart_id']]['extra']['custom_files'][$_REQUEST['option_id']][$_REQUEST['file']])) {
        // Delete saved custom file
        $file = $wishlist['products'][$_REQUEST['cart_id']]['extra']['custom_files'][$_REQUEST['option_id']][$_REQUEST['file']];

        Storage::instance('custom_files')->delete($file['path']);
        Storage::instance('custom_files')->delete($file['path'] . '_thumb');

        unset($wishlist['products'][$_REQUEST['cart_id']]['extra']['custom_files'][$_REQUEST['option_id']][$_REQUEST['file']]);

        if (defined('AJAX_REQUEST')) {
            fn_set_notification('N', __('notice'), __('text_product_file_has_been_deleted'));
        }
    }

    return array(CONTROLLER_STATUS_REDIRECT, "wishlist.view");
//
// Delete products from wishlist
//
} elseif ($mode == 'delete_product' && !empty($_REQUEST['item_id']) && !empty($_REQUEST['event_id'])) {

    //$suffix = '.update?event_id=' . $_REQUEST['event_id'];

    if (!empty($auth['user_id']) && $auth['user_id'] == $_REQUEST['event_id']) {
        
        if (!empty($_REQUEST['event_id'])) {
			
            db_query("DELETE FROM ?:wishlists_registry_products WHERE item_id = ?i AND user_id = ?i", $_REQUEST['item_id'], $_REQUEST['event_id']);
            fn_set_notification('N', __('notice'), 'Product Has Been Deleted');
        }
        
    }

    return array(CONTROLLER_STATUS_REDIRECT, "wishlists.update");
}

/**
 * Add product to wishlist
 *
 * @param array $product_data array with data for the product to add)(product_id, price, amount, product_options, is_edp)
 * @param array $wishlist wishlist data storage
 * @param array $auth user session data
 * @return mixed array with wishlist IDs for the added products, false otherwise
 */
function fn_add_product_to_wishlist($product_data, &$wishlist, &$auth)
{
    // Check if products have cusom images
    list($product_data, $wishlist) = fn_add_product_options_files($product_data, $wishlist, $auth, false, 'wishlist');

    fn_set_hook('pre_add_to_wishlist', $product_data, $wishlist, $auth);

    if (!empty($product_data) && is_array($product_data)) {
        $wishlist_ids = array();
        foreach ($product_data as $product_id => $data) {
            if (empty($data['amount'])) {
                $data['amount'] = 1;
            }
            if (!empty($data['product_id'])) {
                $product_id = $data['product_id'];
            }

            if (empty($data['extra'])) {
                $data['extra'] = array();
            }

            // Add one product
            if (!isset($data['product_options'])) {
                $data['product_options'] = fn_get_default_product_options($product_id);
            }

            // Generate wishlist id
            $data['extra']['product_options'] = $data['product_options'];
            $_id = fn_generate_cart_id($product_id, $data['extra']);

            $_data = db_get_row('SELECT is_edp, options_type, tracking FROM ?:products WHERE product_id = ?i', $product_id);
            $data['is_edp'] = $_data['is_edp'];
            $data['options_type'] = $_data['options_type'];
            $data['tracking'] = $_data['tracking'];

            // Check the sequential options
            if (!empty($data['tracking']) && $data['tracking'] == 'O' && $data['options_type'] == 'S') {
                $inventory_options = db_get_fields("SELECT a.option_id FROM ?:product_options as a LEFT JOIN ?:product_global_option_links as c ON c.option_id = a.option_id WHERE (a.product_id = ?i OR c.product_id = ?i) AND a.status = 'A' AND a.inventory = 'Y'", $product_id, $product_id);

                $sequential_completed = true;
                if (!empty($inventory_options)) {
                    foreach ($inventory_options as $option_id) {
                        if (!isset($data['product_options'][$option_id]) || empty($data['product_options'][$option_id])) {
                            $sequential_completed = false;
                            break;
                        }
                    }
                }

                if (!$sequential_completed) {
                    fn_set_notification('E', __('error'), __('select_all_product_options'));
                    // Even if customer tried to add the product from the catalog page, we will redirect he/she to the detailed product page to give an ability to complete a purchase
                    $redirect_url = fn_url('products.view?product_id=' . $product_id . '&combination=' . fn_get_options_combination($data['product_options']));
                    $_REQUEST['redirect_url'] = $redirect_url; //FIXME: Very very very BAD style to use the global variables in the functions!!!

                    return false;
                }
            }

            $wishlist_ids[] = $_id;
            $wishlist['products'][$_id]['product_id'] = $product_id;
            $wishlist['products'][$_id]['product_options'] = $data['product_options'];
            $wishlist['products'][$_id]['extra'] = $data['extra'];
            $wishlist['products'][$_id]['amount'] = $data['amount'];
        }

        return $wishlist_ids;
    } else {
        return false;
    }
}

/**
 * Update event products
 *
 * @param int $event_id Event identifier
 * @param array $event_products Array of new data for products information update
 * @param boolean $is_add Flag that defines if products are added
 * @return boolean Always true wishlists_registry_products
 */
function fn_update_wishlists_products($event_products, $is_add = false)
{
    foreach ($event_products as $item_id => $data) {

        $product_id = ($is_add || empty($data['product_id'])) ? $item_id : $data['product_id'];

        $data['item_id'] = fn_generate_cart_id($product_id, array("product_options" => (!empty($data['product_options']) ? $data['product_options'] : array())), false);
		//echo $data['item_id']."==".$item_id;
        if (!empty($data['product_options'])) {
            $data['extra'] = serialize($data['product_options']);
        }
        //$data['event_id'] = $event_id;
		$data['user_id'] = $user_id = $_SESSION['auth']['user_id'];
		$data['lastadded'] = TIME;
		//die();
        if ($is_add || $data['item_id'] != $item_id) {
			$existent_amount = db_get_field("SELECT amount FROM ?:wishlists_registry_products WHERE item_id = ?i AND user_id = ?i", $data['item_id'], $user_id);
            $data['product_id'] = $product_id;
            
            if (!$is_add) {
				db_query("DELETE FROM ?:wishlists_registry_products WHERE item_id = ?i AND user_id = ?i", $item_id, $user_id);
            }
            
            if (!empty($data['amount'])) {
				$data['amount'] += $existent_amount;
				//die('here');
                db_query("REPLACE INTO ?:wishlists_registry_products ?e", $data);
                //die('ok');
            }
        } else {
            $existent_amount = db_get_field("SELECT amount FROM ?:wishlists_registry_products WHERE item_id = ?i AND user_id = ?i", $data['item_id'], $user_id);
            if (!empty($data['amount'])) {
                db_query("UPDATE ?:wishlists_registry_products SET ?u WHERE item_id = ?i AND user_id = ?i", $data, $item_id, $user_id);
            } else {
                db_query("DELETE FROM ?:wishlists_registry_products WHERE item_id = ?i AND user_id = ?i", $item_id, $user_id);
            }
        }
    }

    return true;
}

/**
 * Delete product from the wishlist
 *
 * @param array $wishlist wishlist data storage
 * @param int $wishlist_id ID of the product to delete from wishlist
 * @return mixed array with wishlist IDs for the added products, false otherwise
 */
function fn_delete_wishlist_product(&$wishlist, $wishlist_id)
{
    fn_set_hook('delete_wishlist_product', $wishlist, $wishlist_id);

    if (!empty($wishlist_id)) {
        unset($wishlist['products'][$wishlist_id]);
    }

    return true;
}

function fn_get_wishlists_products($params, $items_per_page = 0, $lang_code = CART_LANGUAGE)
{
    $default_params = array (
        'page' => 1,
        'user_id' => 0,
        'items_per_page' => $items_per_page
    );

    $params = array_merge($default_params, $params);
	/*echo '<pre>';
	print_r($params);
	die('func');*/
    $limit = '';
    if (!empty($params['items_per_page'])) {
        $params['total_items'] = db_get_field("SELECT DISTINCT(COUNT(*)) FROM ?:wishlists_registry_products WHERE user_id = ?i", $params['user_id']);
        $limit = db_paginate($params['page'], $params['items_per_page']);
    }
	//echo "SELECT * FROM ?:wishlists_registry_products LEFT JOIN ?:product_descriptions ON ?:product_descriptions.product_id = ?:wishlists_registry_products.product_id AND ?:product_descriptions.lang_code = ?s WHERE user_id = ?i". $limit.", 'item_id', ".$lang_code.", ".$params['user_id'];
    $products = db_get_hash_array("SELECT * FROM ?:wishlists_registry_products LEFT JOIN ?:product_descriptions ON ?:product_descriptions.product_id = ?:wishlists_registry_products.product_id AND ?:product_descriptions.lang_code = ?s WHERE user_id = ?i $limit", 'item_id', $lang_code, $params['user_id']);
	
    return array($products, $params);
}
