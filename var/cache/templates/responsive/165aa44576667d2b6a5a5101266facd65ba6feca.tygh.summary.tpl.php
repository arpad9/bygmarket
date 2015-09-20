<?php /* Smarty version Smarty-3.1.21, created on 2015-09-18 23:18:12
         compiled from "/var/www/bygmarket.com/design/themes/responsive/templates/blocks/checkout/summary.tpl" */ ?>
<?php /*%%SmartyHeaderCode:126465184455fc7184df42d1-42304438%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '165aa44576667d2b6a5a5101266facd65ba6feca' => 
    array (
      0 => '/var/www/bygmarket.com/design/themes/responsive/templates/blocks/checkout/summary.tpl',
      1 => 1442595889,
      2 => 'tygh',
    ),
  ),
  'nocache_hash' => '126465184455fc7184df42d1-42304438',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'runtime' => 0,
    'block' => 0,
    'cart' => 0,
    'take_surcharge_from_vendor' => 0,
    'tax' => 0,
    'settings' => 0,
    '_total' => 0,
    'auth' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21',
  'unifunc' => 'content_55fc7184f1cd83_05270772',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55fc7184f1cd83_05270772')) {function content_55fc7184f1cd83_05270772($_smarty_tpl) {?><?php if (!is_callable('smarty_block_hook')) include '/var/www/bygmarket.com/app/functions/smarty_plugins/block.hook.php';
if (!is_callable('smarty_function_math')) include '/var/www/bygmarket.com/app/lib/vendor/smarty/smarty/libs/plugins/function.math.php';
if (!is_callable('smarty_function_set_id')) include '/var/www/bygmarket.com/app/functions/smarty_plugins/function.set_id.php';
?><?php
fn_preload_lang_vars(array('items','shipping','free_shipping','order_discount','payment_surcharge','taxes','included','order_total','items','shipping','free_shipping','order_discount','payment_surcharge','taxes','included','order_total'));
?>
<?php if ($_smarty_tpl->tpl_vars['runtime']->value['customization_mode']['design']=="Y"&&@constant('AREA')=="C") {
$_smarty_tpl->_capture_stack[0][] = array("template_content", null, null); ob_start(); ?><div class="ty-checkout-summary" id="checkout_info_summary_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['block']->value['snapping_id'], ENT_QUOTES, 'UTF-8');?>
">
    <table class="ty-checkout-summary__block">
        <tbody>
            <tr>
                <td class="ty-checkout-summary__item"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['cart']->value['amount'], ENT_QUOTES, 'UTF-8');?>
 <?php echo $_smarty_tpl->__("items");?>
</td>
                <td class="ty-checkout-summary__item ty-right" data-ct-checkout-summary="items">
                    <span><?php echo $_smarty_tpl->getSubTemplate ("common/price.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('value'=>$_smarty_tpl->tpl_vars['cart']->value['display_subtotal']), 0);?>
</span>
                </td>
            </tr>

            <?php if (!$_smarty_tpl->tpl_vars['cart']->value['shipping_failed']&&$_smarty_tpl->tpl_vars['cart']->value['chosen_shipping']&&$_smarty_tpl->tpl_vars['cart']->value['shipping_required']) {?>
            <tr>
                <td class="ty-checkout-summary__item"><?php echo $_smarty_tpl->__("shipping");?>
</td>
                <td class="ty-checkout-summary__item ty-right" data-ct-checkout-summary="shipping">
                    <?php if (!$_smarty_tpl->tpl_vars['cart']->value['display_shipping_cost']) {?>
                        <span><?php echo $_smarty_tpl->__("free_shipping");?>
</span>
                    <?php } else { ?>
                        <span><?php echo $_smarty_tpl->getSubTemplate ("common/price.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('value'=>$_smarty_tpl->tpl_vars['cart']->value['display_shipping_cost']), 0);?>
</span>
                    <?php }?>
                </td>
            </tr>
            <?php }?>

            <?php if ((floatval($_smarty_tpl->tpl_vars['cart']->value['subtotal_discount']))) {?>
                <tr class="ty-checkout-summary__order_discount">
                    <td class="ty-checkout-summary__item"><?php echo $_smarty_tpl->__("order_discount");?>
</td>
                    <td class="ty-checkout-summary__item ty-right discount-price" data-ct-checkout-summary="order-discount">
                        <span>-<?php echo $_smarty_tpl->getSubTemplate ("common/price.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('value'=>$_smarty_tpl->tpl_vars['cart']->value['subtotal_discount']), 0);?>
</span>
                    </td>
                </tr>
                <?php $_smarty_tpl->smarty->_tag_stack[] = array('hook', array('name'=>"checkout:discount_summary")); $_block_repeat=true; echo smarty_block_hook(array('name'=>"checkout:discount_summary"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

                <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_hook(array('name'=>"checkout:discount_summary"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

            <?php }?>
            

            <?php if ($_smarty_tpl->tpl_vars['cart']->value['payment_surcharge']&&!$_smarty_tpl->tpl_vars['take_surcharge_from_vendor']->value) {?>
                <tr>
                    <td class="ty-checkout-summary__item"><?php echo htmlspecialchars((($tmp = @$_smarty_tpl->tpl_vars['cart']->value['payment_surcharge_title'])===null||$tmp==='' ? $_smarty_tpl->__("payment_surcharge") : $tmp), ENT_QUOTES, 'UTF-8');?>
</td>
                    <td class="ty-checkout-summary__item ty-right" data-ct-checkout-summary="payment-surcharge">
                        <span><?php echo $_smarty_tpl->getSubTemplate ("common/price.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('value'=>$_smarty_tpl->tpl_vars['cart']->value['payment_surcharge']), 0);?>
</span>
                    </td>
                </tr>
                <?php echo smarty_function_math(array('equation'=>"x+y",'x'=>$_smarty_tpl->tpl_vars['cart']->value['total'],'y'=>$_smarty_tpl->tpl_vars['cart']->value['payment_surcharge'],'assign'=>"_total"),$_smarty_tpl);?>

            <?php }?>

            <?php if ($_smarty_tpl->tpl_vars['cart']->value['taxes']) {?>
                <tr>
                    <td class="ty-checkout-summary__item ty-checkout-summary__taxes"><?php echo $_smarty_tpl->__("taxes");?>
</td>
                    <td class="ty-checkout-summary__item"></td>
                </tr>
                <?php  $_smarty_tpl->tpl_vars["tax"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["tax"]->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['cart']->value['taxes']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["tax"]->key => $_smarty_tpl->tpl_vars["tax"]->value) {
$_smarty_tpl->tpl_vars["tax"]->_loop = true;
?>
                    <tr>
                        <td class="ty-checkout-summary__item" data-ct-checkout-summary="tax-name <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['tax']->value['description'], ENT_QUOTES, 'UTF-8');?>
">
                            <div class="ty-checkout-summary__taxes-name"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['tax']->value['description'], ENT_QUOTES, 'UTF-8');?>
 (<?php echo $_smarty_tpl->getSubTemplate ("common/modifier.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('mod_value'=>$_smarty_tpl->tpl_vars['tax']->value['rate_value'],'mod_type'=>$_smarty_tpl->tpl_vars['tax']->value['rate_type']), 0);
if ($_smarty_tpl->tpl_vars['tax']->value['price_includes_tax']=="Y"&&($_smarty_tpl->tpl_vars['settings']->value['Appearance']['cart_prices_w_taxes']!="Y"||$_smarty_tpl->tpl_vars['settings']->value['General']['tax_calculation']=="subtotal")) {?> <?php echo $_smarty_tpl->__("included");
}?>)</div>
                        </td>
                        <td class="ty-checkout-summary__item ty-right" data-ct-checkout-summary="taxes">
                            <span class="ty-checkout-summary__taxes-amount"><?php echo $_smarty_tpl->getSubTemplate ("common/price.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('value'=>$_smarty_tpl->tpl_vars['tax']->value['tax_subtotal']), 0);?>
</span>
                        </td>
                    </tr>
                <?php } ?>
            <?php }?>

            <?php $_smarty_tpl->smarty->_tag_stack[] = array('hook', array('name'=>"checkout:summary")); $_block_repeat=true; echo smarty_block_hook(array('name'=>"checkout:summary"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

            <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_hook(array('name'=>"checkout:summary"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

            <tr>
                <td colspan="2" class="ty-checkout-summary__item">
                    <?php echo $_smarty_tpl->getSubTemplate ("views/checkout/components/promotion_coupon.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

                </td>
            </tr>
        </tbody>
        <tbody>
            <tr>
                <th class="ty-checkout-summary__total" colspan="2" data-ct-checkout-summary="order-total">
                    <div>
                        <?php echo $_smarty_tpl->__("order_total");?>

                        <span class="ty-checkout-summary__total-sum"><?php echo $_smarty_tpl->getSubTemplate ("common/price.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('value'=>(($tmp = @$_smarty_tpl->tpl_vars['_total']->value)===null||$tmp==='' ? $_smarty_tpl->tpl_vars['cart']->value['total'] : $tmp)), 0);?>
</span>
                    </div>
                </th>
            </tr>
        </tbody>
    </table>
<!--checkout_info_summary_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['block']->value['snapping_id'], ENT_QUOTES, 'UTF-8');?>
--></div>
<?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();
if (trim(Smarty::$_smarty_vars['capture']['template_content'])) {
if ($_smarty_tpl->tpl_vars['auth']->value['area']=="A") {?><span class="cm-template-box template-box" data-ca-te-template="blocks/checkout/summary.tpl" id="<?php echo smarty_function_set_id(array('name'=>"blocks/checkout/summary.tpl"),$_smarty_tpl);?>
"><div class="cm-template-icon icon-edit ty-icon-edit hidden"></div><?php echo Smarty::$_smarty_vars['capture']['template_content'];?>
<!--[/tpl_id]--></span><?php } else {
echo Smarty::$_smarty_vars['capture']['template_content'];
}
}
} else { ?><div class="ty-checkout-summary" id="checkout_info_summary_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['block']->value['snapping_id'], ENT_QUOTES, 'UTF-8');?>
">
    <table class="ty-checkout-summary__block">
        <tbody>
            <tr>
                <td class="ty-checkout-summary__item"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['cart']->value['amount'], ENT_QUOTES, 'UTF-8');?>
 <?php echo $_smarty_tpl->__("items");?>
</td>
                <td class="ty-checkout-summary__item ty-right" data-ct-checkout-summary="items">
                    <span><?php echo $_smarty_tpl->getSubTemplate ("common/price.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('value'=>$_smarty_tpl->tpl_vars['cart']->value['display_subtotal']), 0);?>
</span>
                </td>
            </tr>

            <?php if (!$_smarty_tpl->tpl_vars['cart']->value['shipping_failed']&&$_smarty_tpl->tpl_vars['cart']->value['chosen_shipping']&&$_smarty_tpl->tpl_vars['cart']->value['shipping_required']) {?>
            <tr>
                <td class="ty-checkout-summary__item"><?php echo $_smarty_tpl->__("shipping");?>
</td>
                <td class="ty-checkout-summary__item ty-right" data-ct-checkout-summary="shipping">
                    <?php if (!$_smarty_tpl->tpl_vars['cart']->value['display_shipping_cost']) {?>
                        <span><?php echo $_smarty_tpl->__("free_shipping");?>
</span>
                    <?php } else { ?>
                        <span><?php echo $_smarty_tpl->getSubTemplate ("common/price.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('value'=>$_smarty_tpl->tpl_vars['cart']->value['display_shipping_cost']), 0);?>
</span>
                    <?php }?>
                </td>
            </tr>
            <?php }?>

            <?php if ((floatval($_smarty_tpl->tpl_vars['cart']->value['subtotal_discount']))) {?>
                <tr class="ty-checkout-summary__order_discount">
                    <td class="ty-checkout-summary__item"><?php echo $_smarty_tpl->__("order_discount");?>
</td>
                    <td class="ty-checkout-summary__item ty-right discount-price" data-ct-checkout-summary="order-discount">
                        <span>-<?php echo $_smarty_tpl->getSubTemplate ("common/price.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('value'=>$_smarty_tpl->tpl_vars['cart']->value['subtotal_discount']), 0);?>
</span>
                    </td>
                </tr>
                <?php $_smarty_tpl->smarty->_tag_stack[] = array('hook', array('name'=>"checkout:discount_summary")); $_block_repeat=true; echo smarty_block_hook(array('name'=>"checkout:discount_summary"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

                <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_hook(array('name'=>"checkout:discount_summary"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

            <?php }?>
            

            <?php if ($_smarty_tpl->tpl_vars['cart']->value['payment_surcharge']&&!$_smarty_tpl->tpl_vars['take_surcharge_from_vendor']->value) {?>
                <tr>
                    <td class="ty-checkout-summary__item"><?php echo htmlspecialchars((($tmp = @$_smarty_tpl->tpl_vars['cart']->value['payment_surcharge_title'])===null||$tmp==='' ? $_smarty_tpl->__("payment_surcharge") : $tmp), ENT_QUOTES, 'UTF-8');?>
</td>
                    <td class="ty-checkout-summary__item ty-right" data-ct-checkout-summary="payment-surcharge">
                        <span><?php echo $_smarty_tpl->getSubTemplate ("common/price.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('value'=>$_smarty_tpl->tpl_vars['cart']->value['payment_surcharge']), 0);?>
</span>
                    </td>
                </tr>
                <?php echo smarty_function_math(array('equation'=>"x+y",'x'=>$_smarty_tpl->tpl_vars['cart']->value['total'],'y'=>$_smarty_tpl->tpl_vars['cart']->value['payment_surcharge'],'assign'=>"_total"),$_smarty_tpl);?>

            <?php }?>

            <?php if ($_smarty_tpl->tpl_vars['cart']->value['taxes']) {?>
                <tr>
                    <td class="ty-checkout-summary__item ty-checkout-summary__taxes"><?php echo $_smarty_tpl->__("taxes");?>
</td>
                    <td class="ty-checkout-summary__item"></td>
                </tr>
                <?php  $_smarty_tpl->tpl_vars["tax"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["tax"]->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['cart']->value['taxes']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["tax"]->key => $_smarty_tpl->tpl_vars["tax"]->value) {
$_smarty_tpl->tpl_vars["tax"]->_loop = true;
?>
                    <tr>
                        <td class="ty-checkout-summary__item" data-ct-checkout-summary="tax-name <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['tax']->value['description'], ENT_QUOTES, 'UTF-8');?>
">
                            <div class="ty-checkout-summary__taxes-name"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['tax']->value['description'], ENT_QUOTES, 'UTF-8');?>
 (<?php echo $_smarty_tpl->getSubTemplate ("common/modifier.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('mod_value'=>$_smarty_tpl->tpl_vars['tax']->value['rate_value'],'mod_type'=>$_smarty_tpl->tpl_vars['tax']->value['rate_type']), 0);
if ($_smarty_tpl->tpl_vars['tax']->value['price_includes_tax']=="Y"&&($_smarty_tpl->tpl_vars['settings']->value['Appearance']['cart_prices_w_taxes']!="Y"||$_smarty_tpl->tpl_vars['settings']->value['General']['tax_calculation']=="subtotal")) {?> <?php echo $_smarty_tpl->__("included");
}?>)</div>
                        </td>
                        <td class="ty-checkout-summary__item ty-right" data-ct-checkout-summary="taxes">
                            <span class="ty-checkout-summary__taxes-amount"><?php echo $_smarty_tpl->getSubTemplate ("common/price.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('value'=>$_smarty_tpl->tpl_vars['tax']->value['tax_subtotal']), 0);?>
</span>
                        </td>
                    </tr>
                <?php } ?>
            <?php }?>

            <?php $_smarty_tpl->smarty->_tag_stack[] = array('hook', array('name'=>"checkout:summary")); $_block_repeat=true; echo smarty_block_hook(array('name'=>"checkout:summary"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

            <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_hook(array('name'=>"checkout:summary"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

            <tr>
                <td colspan="2" class="ty-checkout-summary__item">
                    <?php echo $_smarty_tpl->getSubTemplate ("views/checkout/components/promotion_coupon.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

                </td>
            </tr>
        </tbody>
        <tbody>
            <tr>
                <th class="ty-checkout-summary__total" colspan="2" data-ct-checkout-summary="order-total">
                    <div>
                        <?php echo $_smarty_tpl->__("order_total");?>

                        <span class="ty-checkout-summary__total-sum"><?php echo $_smarty_tpl->getSubTemplate ("common/price.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('value'=>(($tmp = @$_smarty_tpl->tpl_vars['_total']->value)===null||$tmp==='' ? $_smarty_tpl->tpl_vars['cart']->value['total'] : $tmp)), 0);?>
</span>
                    </div>
                </th>
            </tr>
        </tbody>
    </table>
<!--checkout_info_summary_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['block']->value['snapping_id'], ENT_QUOTES, 'UTF-8');?>
--></div>
<?php }?><?php }} ?>
