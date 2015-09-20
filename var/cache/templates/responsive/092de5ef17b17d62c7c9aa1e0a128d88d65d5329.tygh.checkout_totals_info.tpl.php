<?php /* Smarty version Smarty-3.1.21, created on 2015-09-18 23:14:36
         compiled from "/var/www/bygmarket.com/design/themes/responsive/templates/views/checkout/components/checkout_totals_info.tpl" */ ?>
<?php /*%%SmartyHeaderCode:185869457355fc70ac1bdfa4-83857013%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '092de5ef17b17d62c7c9aa1e0a128d88d65d5329' => 
    array (
      0 => '/var/www/bygmarket.com/design/themes/responsive/templates/views/checkout/components/checkout_totals_info.tpl',
      1 => 1442595889,
      2 => 'tygh',
    ),
  ),
  'nocache_hash' => '185869457355fc70ac1bdfa4-83857013',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'runtime' => 0,
    'cart' => 0,
    'location' => 0,
    'settings' => 0,
    'shipping' => 0,
    'tax' => 0,
    'take_surcharge_from_vendor' => 0,
    'payment_data' => 0,
    '_total' => 0,
    'auth' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21',
  'unifunc' => 'content_55fc70ac325674_71365975',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55fc70ac325674_71365975')) {function content_55fc70ac325674_71365975($_smarty_tpl) {?><?php if (!is_callable('smarty_block_hook')) include '/var/www/bygmarket.com/app/functions/smarty_plugins/block.hook.php';
if (!is_callable('smarty_function_math')) include '/var/www/bygmarket.com/app/lib/vendor/smarty/smarty/libs/plugins/function.math.php';
if (!is_callable('smarty_function_set_id')) include '/var/www/bygmarket.com/app/functions/smarty_plugins/function.set_id.php';
?><?php
fn_preload_lang_vars(array('subtotal','shipping_cost','including_discount','order_discount','taxes','included','payment_surcharge','subtotal','shipping_cost','including_discount','order_discount','taxes','included','payment_surcharge'));
?>
<?php if ($_smarty_tpl->tpl_vars['runtime']->value['customization_mode']['design']=="Y"&&@constant('AREA')=="C") {
$_smarty_tpl->_capture_stack[0][] = array("template_content", null, null); ob_start(); ?><ul class="ty-cart-statistic ty-statistic-list">
    <li class="ty-cart-statistic__item ty-statistic-list-subtotal">
        <span class="ty-cart-statistic__title"><?php echo $_smarty_tpl->__("subtotal");?>
</span>
        <span class="ty-cart-statistic__value"><?php echo $_smarty_tpl->getSubTemplate ("common/price.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('value'=>$_smarty_tpl->tpl_vars['cart']->value['display_subtotal']), 0);?>
</span>
    </li>
    
    <?php $_smarty_tpl->smarty->_tag_stack[] = array('hook', array('name'=>"checkout:checkout_totals")); $_block_repeat=true; echo smarty_block_hook(array('name'=>"checkout:checkout_totals"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

        <?php if ($_smarty_tpl->tpl_vars['cart']->value['shipping_required']==true&&($_smarty_tpl->tpl_vars['location']->value!="cart"||$_smarty_tpl->tpl_vars['settings']->value['General']['estimate_shipping_cost']=="Y")) {?>
        <li class="ty-cart-statistic__item ty-statistic-list-shipping-method">
        <?php if ($_smarty_tpl->tpl_vars['cart']->value['shipping']) {?>
            <span class="ty-cart-statistic__title">
                <?php  $_smarty_tpl->tpl_vars["shipping"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["shipping"]->_loop = false;
 $_smarty_tpl->tpl_vars["shipping_id"] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['cart']->value['shipping']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars["shipping"]->total= $_smarty_tpl->_count($_from);
 $_smarty_tpl->tpl_vars["shipping"]->iteration=0;
foreach ($_from as $_smarty_tpl->tpl_vars["shipping"]->key => $_smarty_tpl->tpl_vars["shipping"]->value) {
$_smarty_tpl->tpl_vars["shipping"]->_loop = true;
 $_smarty_tpl->tpl_vars["shipping_id"]->value = $_smarty_tpl->tpl_vars["shipping"]->key;
 $_smarty_tpl->tpl_vars["shipping"]->iteration++;
 $_smarty_tpl->tpl_vars["shipping"]->last = $_smarty_tpl->tpl_vars["shipping"]->iteration === $_smarty_tpl->tpl_vars["shipping"]->total;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']["f_shipp"]['last'] = $_smarty_tpl->tpl_vars["shipping"]->last;
?>
                    <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['shipping']->value['shipping'], ENT_QUOTES, 'UTF-8');
if (!$_smarty_tpl->getVariable('smarty')->value['foreach']['f_shipp']['last']) {?>, <?php }?>
                <?php } ?>
                <span class="ty-nowrap">(<?php echo trim(Smarty::$_smarty_vars['capture']['shipping_estimation']);?>
)</span>
            </span>
            <span class="ty-cart-statistic__value"><?php echo $_smarty_tpl->getSubTemplate ("common/price.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('value'=>$_smarty_tpl->tpl_vars['cart']->value['display_shipping_cost']), 0);?>
</span>
        <?php } else { ?>
            <span class="ty-cart-statistic__title"><?php echo $_smarty_tpl->__("shipping_cost");?>
</span>
            <span class="ty-cart-statistic__value"><?php echo Smarty::$_smarty_vars['capture']['shipping_estimation'];?>
</span>
        <?php }?>
        </li>
        <?php }?>
    <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_hook(array('name'=>"checkout:checkout_totals"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

    
    <?php if ((floatval($_smarty_tpl->tpl_vars['cart']->value['discount']))) {?>
    <li class="ty-cart-statistic__item ty-statistic-list-discount">
        <span class="ty-cart-statistic__title"><?php echo $_smarty_tpl->__("including_discount");?>
</span>
        <span class="ty-cart-statistic__value discount-price">-<?php echo $_smarty_tpl->getSubTemplate ("common/price.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('value'=>$_smarty_tpl->tpl_vars['cart']->value['discount']), 0);?>
</span>
    </li>
    
    <?php }?>

    <?php if ((floatval($_smarty_tpl->tpl_vars['cart']->value['subtotal_discount']))) {?>
    <li class="ty-cart-statistic__item ty-statistic-list-subtotal-discount">
        <span class="ty-cart-statistic__title"><?php echo $_smarty_tpl->__("order_discount");?>
</span>
        <span class="ty-cart-statistic__value discount-price">-<?php echo $_smarty_tpl->getSubTemplate ("common/price.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('value'=>$_smarty_tpl->tpl_vars['cart']->value['subtotal_discount']), 0);?>
</span>
    </li>
    <?php $_smarty_tpl->smarty->_tag_stack[] = array('hook', array('name'=>"checkout:checkout_discount")); $_block_repeat=true; echo smarty_block_hook(array('name'=>"checkout:checkout_discount"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();
$_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_hook(array('name'=>"checkout:checkout_discount"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

    <?php }?>

    <?php if ($_smarty_tpl->tpl_vars['cart']->value['taxes']) {?>
    <li class="ty-cart-statistic__item ty-statistic-list-taxes ty-cart-statistic__group">
        <span class="ty-cart-statistic__title ty-cart-statistic_title_main"><?php echo $_smarty_tpl->__("taxes");?>
</span>
    </li>
    <?php  $_smarty_tpl->tpl_vars["tax"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["tax"]->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['cart']->value['taxes']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["tax"]->key => $_smarty_tpl->tpl_vars["tax"]->value) {
$_smarty_tpl->tpl_vars["tax"]->_loop = true;
?>
    <li class="ty-cart-statistic__item ty-statistic-list-tax">
        <span class="ty-cart-statistic__title"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['tax']->value['description'], ENT_QUOTES, 'UTF-8');?>
&nbsp;(<?php echo $_smarty_tpl->getSubTemplate ("common/modifier.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('mod_value'=>$_smarty_tpl->tpl_vars['tax']->value['rate_value'],'mod_type'=>$_smarty_tpl->tpl_vars['tax']->value['rate_type']), 0);
if ($_smarty_tpl->tpl_vars['tax']->value['price_includes_tax']=="Y"&&($_smarty_tpl->tpl_vars['settings']->value['Appearance']['cart_prices_w_taxes']!="Y"||$_smarty_tpl->tpl_vars['settings']->value['General']['tax_calculation']=="subtotal")) {?>&nbsp;<?php echo $_smarty_tpl->__("included");
}?>)</span>
        <span class="ty-cart-statistic__value"><?php echo $_smarty_tpl->getSubTemplate ("common/price.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('value'=>$_smarty_tpl->tpl_vars['tax']->value['tax_subtotal']), 0);?>
</span>
    </li>
    <?php } ?>
    <?php }?>

    <?php if ($_smarty_tpl->tpl_vars['cart']->value['payment_surcharge']&&!$_smarty_tpl->tpl_vars['take_surcharge_from_vendor']->value) {?>
    <li class="ty-cart-statistic__item ty-statistic-list-payment-surcharge" id="payment_surcharge_line">
        <?php $_smarty_tpl->tpl_vars["payment_data"] = new Smarty_variable(fn_get_payment_method_data($_smarty_tpl->tpl_vars['cart']->value['payment_id']), null, 0);?>
        <span class="ty-cart-statistic__title"><?php echo htmlspecialchars((($tmp = @$_smarty_tpl->tpl_vars['cart']->value['payment_surcharge_title'])===null||$tmp==='' ? $_smarty_tpl->__("payment_surcharge") : $tmp), ENT_QUOTES, 'UTF-8');
if ($_smarty_tpl->tpl_vars['payment_data']->value['payment']) {?>&nbsp;(<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['payment_data']->value['payment'], ENT_QUOTES, 'UTF-8');?>
)<?php }?>:</span>
        <span class="ty-cart-statistic__value"><?php echo $_smarty_tpl->getSubTemplate ("common/price.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('value'=>$_smarty_tpl->tpl_vars['cart']->value['payment_surcharge'],'span_id'=>"payment_surcharge_value"), 0);?>
</span>
    </li>
    <?php echo smarty_function_math(array('equation'=>"x+y",'x'=>$_smarty_tpl->tpl_vars['cart']->value['total'],'y'=>$_smarty_tpl->tpl_vars['cart']->value['payment_surcharge'],'assign'=>"_total"),$_smarty_tpl);?>

    <?php $_smarty_tpl->_capture_stack[0][] = array("_total", null, null); ob_start();
echo htmlspecialchars($_smarty_tpl->tpl_vars['_total']->value, ENT_QUOTES, 'UTF-8');
list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>
    <?php }?>
</ul><?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();
if (trim(Smarty::$_smarty_vars['capture']['template_content'])) {
if ($_smarty_tpl->tpl_vars['auth']->value['area']=="A") {?><span class="cm-template-box template-box" data-ca-te-template="views/checkout/components/checkout_totals_info.tpl" id="<?php echo smarty_function_set_id(array('name'=>"views/checkout/components/checkout_totals_info.tpl"),$_smarty_tpl);?>
"><div class="cm-template-icon icon-edit ty-icon-edit hidden"></div><?php echo Smarty::$_smarty_vars['capture']['template_content'];?>
<!--[/tpl_id]--></span><?php } else {
echo Smarty::$_smarty_vars['capture']['template_content'];
}
}
} else { ?><ul class="ty-cart-statistic ty-statistic-list">
    <li class="ty-cart-statistic__item ty-statistic-list-subtotal">
        <span class="ty-cart-statistic__title"><?php echo $_smarty_tpl->__("subtotal");?>
</span>
        <span class="ty-cart-statistic__value"><?php echo $_smarty_tpl->getSubTemplate ("common/price.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('value'=>$_smarty_tpl->tpl_vars['cart']->value['display_subtotal']), 0);?>
</span>
    </li>
    
    <?php $_smarty_tpl->smarty->_tag_stack[] = array('hook', array('name'=>"checkout:checkout_totals")); $_block_repeat=true; echo smarty_block_hook(array('name'=>"checkout:checkout_totals"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

        <?php if ($_smarty_tpl->tpl_vars['cart']->value['shipping_required']==true&&($_smarty_tpl->tpl_vars['location']->value!="cart"||$_smarty_tpl->tpl_vars['settings']->value['General']['estimate_shipping_cost']=="Y")) {?>
        <li class="ty-cart-statistic__item ty-statistic-list-shipping-method">
        <?php if ($_smarty_tpl->tpl_vars['cart']->value['shipping']) {?>
            <span class="ty-cart-statistic__title">
                <?php  $_smarty_tpl->tpl_vars["shipping"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["shipping"]->_loop = false;
 $_smarty_tpl->tpl_vars["shipping_id"] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['cart']->value['shipping']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars["shipping"]->total= $_smarty_tpl->_count($_from);
 $_smarty_tpl->tpl_vars["shipping"]->iteration=0;
foreach ($_from as $_smarty_tpl->tpl_vars["shipping"]->key => $_smarty_tpl->tpl_vars["shipping"]->value) {
$_smarty_tpl->tpl_vars["shipping"]->_loop = true;
 $_smarty_tpl->tpl_vars["shipping_id"]->value = $_smarty_tpl->tpl_vars["shipping"]->key;
 $_smarty_tpl->tpl_vars["shipping"]->iteration++;
 $_smarty_tpl->tpl_vars["shipping"]->last = $_smarty_tpl->tpl_vars["shipping"]->iteration === $_smarty_tpl->tpl_vars["shipping"]->total;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']["f_shipp"]['last'] = $_smarty_tpl->tpl_vars["shipping"]->last;
?>
                    <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['shipping']->value['shipping'], ENT_QUOTES, 'UTF-8');
if (!$_smarty_tpl->getVariable('smarty')->value['foreach']['f_shipp']['last']) {?>, <?php }?>
                <?php } ?>
                <span class="ty-nowrap">(<?php echo trim(Smarty::$_smarty_vars['capture']['shipping_estimation']);?>
)</span>
            </span>
            <span class="ty-cart-statistic__value"><?php echo $_smarty_tpl->getSubTemplate ("common/price.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('value'=>$_smarty_tpl->tpl_vars['cart']->value['display_shipping_cost']), 0);?>
</span>
        <?php } else { ?>
            <span class="ty-cart-statistic__title"><?php echo $_smarty_tpl->__("shipping_cost");?>
</span>
            <span class="ty-cart-statistic__value"><?php echo Smarty::$_smarty_vars['capture']['shipping_estimation'];?>
</span>
        <?php }?>
        </li>
        <?php }?>
    <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_hook(array('name'=>"checkout:checkout_totals"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

    
    <?php if ((floatval($_smarty_tpl->tpl_vars['cart']->value['discount']))) {?>
    <li class="ty-cart-statistic__item ty-statistic-list-discount">
        <span class="ty-cart-statistic__title"><?php echo $_smarty_tpl->__("including_discount");?>
</span>
        <span class="ty-cart-statistic__value discount-price">-<?php echo $_smarty_tpl->getSubTemplate ("common/price.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('value'=>$_smarty_tpl->tpl_vars['cart']->value['discount']), 0);?>
</span>
    </li>
    
    <?php }?>

    <?php if ((floatval($_smarty_tpl->tpl_vars['cart']->value['subtotal_discount']))) {?>
    <li class="ty-cart-statistic__item ty-statistic-list-subtotal-discount">
        <span class="ty-cart-statistic__title"><?php echo $_smarty_tpl->__("order_discount");?>
</span>
        <span class="ty-cart-statistic__value discount-price">-<?php echo $_smarty_tpl->getSubTemplate ("common/price.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('value'=>$_smarty_tpl->tpl_vars['cart']->value['subtotal_discount']), 0);?>
</span>
    </li>
    <?php $_smarty_tpl->smarty->_tag_stack[] = array('hook', array('name'=>"checkout:checkout_discount")); $_block_repeat=true; echo smarty_block_hook(array('name'=>"checkout:checkout_discount"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();
$_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_hook(array('name'=>"checkout:checkout_discount"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

    <?php }?>

    <?php if ($_smarty_tpl->tpl_vars['cart']->value['taxes']) {?>
    <li class="ty-cart-statistic__item ty-statistic-list-taxes ty-cart-statistic__group">
        <span class="ty-cart-statistic__title ty-cart-statistic_title_main"><?php echo $_smarty_tpl->__("taxes");?>
</span>
    </li>
    <?php  $_smarty_tpl->tpl_vars["tax"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["tax"]->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['cart']->value['taxes']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["tax"]->key => $_smarty_tpl->tpl_vars["tax"]->value) {
$_smarty_tpl->tpl_vars["tax"]->_loop = true;
?>
    <li class="ty-cart-statistic__item ty-statistic-list-tax">
        <span class="ty-cart-statistic__title"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['tax']->value['description'], ENT_QUOTES, 'UTF-8');?>
&nbsp;(<?php echo $_smarty_tpl->getSubTemplate ("common/modifier.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('mod_value'=>$_smarty_tpl->tpl_vars['tax']->value['rate_value'],'mod_type'=>$_smarty_tpl->tpl_vars['tax']->value['rate_type']), 0);
if ($_smarty_tpl->tpl_vars['tax']->value['price_includes_tax']=="Y"&&($_smarty_tpl->tpl_vars['settings']->value['Appearance']['cart_prices_w_taxes']!="Y"||$_smarty_tpl->tpl_vars['settings']->value['General']['tax_calculation']=="subtotal")) {?>&nbsp;<?php echo $_smarty_tpl->__("included");
}?>)</span>
        <span class="ty-cart-statistic__value"><?php echo $_smarty_tpl->getSubTemplate ("common/price.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('value'=>$_smarty_tpl->tpl_vars['tax']->value['tax_subtotal']), 0);?>
</span>
    </li>
    <?php } ?>
    <?php }?>

    <?php if ($_smarty_tpl->tpl_vars['cart']->value['payment_surcharge']&&!$_smarty_tpl->tpl_vars['take_surcharge_from_vendor']->value) {?>
    <li class="ty-cart-statistic__item ty-statistic-list-payment-surcharge" id="payment_surcharge_line">
        <?php $_smarty_tpl->tpl_vars["payment_data"] = new Smarty_variable(fn_get_payment_method_data($_smarty_tpl->tpl_vars['cart']->value['payment_id']), null, 0);?>
        <span class="ty-cart-statistic__title"><?php echo htmlspecialchars((($tmp = @$_smarty_tpl->tpl_vars['cart']->value['payment_surcharge_title'])===null||$tmp==='' ? $_smarty_tpl->__("payment_surcharge") : $tmp), ENT_QUOTES, 'UTF-8');
if ($_smarty_tpl->tpl_vars['payment_data']->value['payment']) {?>&nbsp;(<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['payment_data']->value['payment'], ENT_QUOTES, 'UTF-8');?>
)<?php }?>:</span>
        <span class="ty-cart-statistic__value"><?php echo $_smarty_tpl->getSubTemplate ("common/price.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('value'=>$_smarty_tpl->tpl_vars['cart']->value['payment_surcharge'],'span_id'=>"payment_surcharge_value"), 0);?>
</span>
    </li>
    <?php echo smarty_function_math(array('equation'=>"x+y",'x'=>$_smarty_tpl->tpl_vars['cart']->value['total'],'y'=>$_smarty_tpl->tpl_vars['cart']->value['payment_surcharge'],'assign'=>"_total"),$_smarty_tpl);?>

    <?php $_smarty_tpl->_capture_stack[0][] = array("_total", null, null); ob_start();
echo htmlspecialchars($_smarty_tpl->tpl_vars['_total']->value, ENT_QUOTES, 'UTF-8');
list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>
    <?php }?>
</ul><?php }?><?php }} ?>
