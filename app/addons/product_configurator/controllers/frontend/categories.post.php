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

if ($mode == 'view') {
    $products = Registry::get('view')->getTemplateVars('products');
    $hide_qty_products = Registry::get('view')->getTemplateVars('hide_qty_products');
    $hide_qty_products = (empty($hide_qty_products)) ? array() : $hide_qty_products;

    foreach ($products as $product) {
        if (($product['product_type'] == 'C') && empty($product['configuration_mode'])) {
            $hide_qty_products[$product['product_id']] = true;
        }
    }

    Registry::get('view')->assign('hide_qty_products', $hide_qty_products);
}
