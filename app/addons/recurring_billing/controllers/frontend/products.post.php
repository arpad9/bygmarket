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

if ($mode == 'view' || $mode == 'options') {

    if (!empty($_REQUEST['cart_id'])) {
        $cart = & $_SESSION['cart'];
        if (isset($cart['products'][$_REQUEST['cart_id']])) {
            $product = Registry::get('view')->getTemplateVars('product');
            $product['selected_amount'] = $cart['products'][$_REQUEST['cart_id']]['amount'];

            Registry::get('view')->assign('product', $product);
            Registry::get('view')->assign('subscription_object_id', $_REQUEST['cart_id']);
            Registry::get('view')->assign('return_mode', !empty($_REQUEST['return_to']) && $_REQUEST['return_to'] == 'cart' ? 'cart' : 'checkout');
        }
        if (isset($cart['products'][$_REQUEST['cart_id']]['extra']['recurring_duration'])) {
            $extra = $cart['products'][$_REQUEST['cart_id']]['extra'];
            Registry::get('view')->assign('alt_recurring_duration', $extra['recurring_duration']);
            Registry::get('view')->assign('selected_plan_id', $extra['recurring_plan_id']);
        }
    }
} elseif ($mode == 'search') {

    $products = Registry::get('view')->getTemplateVars('products');
    $hide_qty_products = Registry::get('view')->getTemplateVars('hide_qty_products');
    $hide_qty_products = (empty($hide_qty_products)) ? array() : $hide_qty_products;

    foreach ($products as $product) {
        if (!empty($product['recurring_plans']) && empty($product['recurring_plans'][0])) {
            $hide_qty_products[$product['product_id']] = true;
        }
    }

    Registry::get('view')->assign('hide_qty_products', $hide_qty_products);
}
