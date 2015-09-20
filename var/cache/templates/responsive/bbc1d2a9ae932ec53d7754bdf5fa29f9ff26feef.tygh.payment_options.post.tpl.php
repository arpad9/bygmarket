<?php /* Smarty version Smarty-3.1.21, created on 2015-09-18 23:14:36
         compiled from "/var/www/bygmarket.com/design/themes/responsive/templates/addons/reward_points/hooks/checkout/payment_options.post.tpl" */ ?>
<?php /*%%SmartyHeaderCode:109129872155fc70ac114ce6-77400445%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'bbc1d2a9ae932ec53d7754bdf5fa29f9ff26feef' => 
    array (
      0 => '/var/www/bygmarket.com/design/themes/responsive/templates/addons/reward_points/hooks/checkout/payment_options.post.tpl',
      1 => 1442595905,
      2 => 'tygh',
    ),
  ),
  'nocache_hash' => '109129872155fc70ac114ce6-77400445',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'runtime' => 0,
    'cart_products' => 0,
    'cart' => 0,
    'user_info' => 0,
    'location' => 0,
    'config' => 0,
    'use_ajax' => 0,
    '_redirect_url' => 0,
    'auth' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21',
  'unifunc' => 'content_55fc70ac1b9d74_85951474',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55fc70ac1b9d74_85951474')) {function content_55fc70ac1b9d74_85951474($_smarty_tpl) {?><?php if (!is_callable('smarty_function_set_id')) include '/var/www/bygmarket.com/app/functions/smarty_plugins/function.set_id.php';
?><?php
fn_preload_lang_vars(array('points_to_use','apply','text_point_in_account','points_lowercase','points_in_use_lowercase','points_to_use','apply','text_point_in_account','points_lowercase','points_in_use_lowercase'));
?>
<?php if ($_smarty_tpl->tpl_vars['runtime']->value['customization_mode']['design']=="Y"&&@constant('AREA')=="C") {
$_smarty_tpl->_capture_stack[0][] = array("template_content", null, null); ob_start();
if ($_smarty_tpl->tpl_vars['cart_products']->value&&$_smarty_tpl->tpl_vars['cart']->value['points_info']['total_price']&&$_smarty_tpl->tpl_vars['user_info']->value['points']>0) {?>
<div class="ty-coupons__container">
    <div id="point_payment" class="code-input discount-coupon">
        <form class="cm-ajax" name="point_payment_form" action="<?php echo htmlspecialchars(fn_url(''), ENT_QUOTES, 'UTF-8');?>
" method="post">
        <input type="hidden" name="redirect_mode" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['location']->value, ENT_QUOTES, 'UTF-8');?>
" />
        <input type="hidden" name="result_ids" value="checkout_totals,checkout_steps" />
        
        <div class="ty-discount-coupon__control-group ty-input-append ty-inline-block">
            <input type="text" class="ty-input-text ty-valign cm-hint" name="points_to_use" size="40" value="<?php echo $_smarty_tpl->__("points_to_use");?>
" />
            <?php echo $_smarty_tpl->getSubTemplate ("buttons/go.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('but_name'=>"checkout.point_payment",'alt'=>__("apply")), 0);?>

            <input type="submit" class="hidden" name="dispatch[checkout.point_payment]" value="" />
        </div>
        </form>
        <div class="ty-discount-info">
            <span class="ty-caret-info"><span class="ty-caret-outer"></span><span class="ty-caret-inner"></span></span>
            <span class="ty-reward-points__txt-point"><?php echo $_smarty_tpl->__("text_point_in_account");?>
 <?php echo $_smarty_tpl->__("points_lowercase",array($_smarty_tpl->tpl_vars['user_info']->value['points']));?>
.</span>
            
            <?php if ($_smarty_tpl->tpl_vars['cart']->value['points_info']['in_use']['points']) {?>
                <?php $_smarty_tpl->tpl_vars["_redirect_url"] = new Smarty_variable(rawurlencode($_smarty_tpl->tpl_vars['config']->value['current_url']), null, 0);?>
                <?php if ($_smarty_tpl->tpl_vars['use_ajax']->value) {
$_smarty_tpl->tpl_vars["_class"] = new Smarty_variable("cm-ajax", null, 0);
}?>
                <span class="ty-reward-points__points-in-use"><?php echo $_smarty_tpl->__("points_in_use_lowercase",array($_smarty_tpl->tpl_vars['cart']->value['points_info']['in_use']['points']));?>
.&nbsp;(<?php echo $_smarty_tpl->getSubTemplate ("common/price.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('value'=>$_smarty_tpl->tpl_vars['cart']->value['points_info']['in_use']['cost']), 0);?>
)&nbsp;<?php echo $_smarty_tpl->getSubTemplate ("buttons/button.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('but_href'=>"checkout.delete_points_in_use?redirect_url=".((string)$_smarty_tpl->tpl_vars['_redirect_url']->value),'but_meta'=>"cm-post ty-reward-points__delete-icon",'but_role'=>"delete",'but_target_id'=>"checkout*,cart_status*,subtotal_price_in_points"), 0);?>
</span>
            <?php }?>
        </div>
</div>
    <!--point_payment--></div>
<?php }
list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();
if (trim(Smarty::$_smarty_vars['capture']['template_content'])) {
if ($_smarty_tpl->tpl_vars['auth']->value['area']=="A") {?><span class="cm-template-box template-box" data-ca-te-template="addons/reward_points/hooks/checkout/payment_options.post.tpl" id="<?php echo smarty_function_set_id(array('name'=>"addons/reward_points/hooks/checkout/payment_options.post.tpl"),$_smarty_tpl);?>
"><div class="cm-template-icon icon-edit ty-icon-edit hidden"></div><?php echo Smarty::$_smarty_vars['capture']['template_content'];?>
<!--[/tpl_id]--></span><?php } else {
echo Smarty::$_smarty_vars['capture']['template_content'];
}
}
} else {
if ($_smarty_tpl->tpl_vars['cart_products']->value&&$_smarty_tpl->tpl_vars['cart']->value['points_info']['total_price']&&$_smarty_tpl->tpl_vars['user_info']->value['points']>0) {?>
<div class="ty-coupons__container">
    <div id="point_payment" class="code-input discount-coupon">
        <form class="cm-ajax" name="point_payment_form" action="<?php echo htmlspecialchars(fn_url(''), ENT_QUOTES, 'UTF-8');?>
" method="post">
        <input type="hidden" name="redirect_mode" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['location']->value, ENT_QUOTES, 'UTF-8');?>
" />
        <input type="hidden" name="result_ids" value="checkout_totals,checkout_steps" />
        
        <div class="ty-discount-coupon__control-group ty-input-append ty-inline-block">
            <input type="text" class="ty-input-text ty-valign cm-hint" name="points_to_use" size="40" value="<?php echo $_smarty_tpl->__("points_to_use");?>
" />
            <?php echo $_smarty_tpl->getSubTemplate ("buttons/go.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('but_name'=>"checkout.point_payment",'alt'=>__("apply")), 0);?>

            <input type="submit" class="hidden" name="dispatch[checkout.point_payment]" value="" />
        </div>
        </form>
        <div class="ty-discount-info">
            <span class="ty-caret-info"><span class="ty-caret-outer"></span><span class="ty-caret-inner"></span></span>
            <span class="ty-reward-points__txt-point"><?php echo $_smarty_tpl->__("text_point_in_account");?>
 <?php echo $_smarty_tpl->__("points_lowercase",array($_smarty_tpl->tpl_vars['user_info']->value['points']));?>
.</span>
            
            <?php if ($_smarty_tpl->tpl_vars['cart']->value['points_info']['in_use']['points']) {?>
                <?php $_smarty_tpl->tpl_vars["_redirect_url"] = new Smarty_variable(rawurlencode($_smarty_tpl->tpl_vars['config']->value['current_url']), null, 0);?>
                <?php if ($_smarty_tpl->tpl_vars['use_ajax']->value) {
$_smarty_tpl->tpl_vars["_class"] = new Smarty_variable("cm-ajax", null, 0);
}?>
                <span class="ty-reward-points__points-in-use"><?php echo $_smarty_tpl->__("points_in_use_lowercase",array($_smarty_tpl->tpl_vars['cart']->value['points_info']['in_use']['points']));?>
.&nbsp;(<?php echo $_smarty_tpl->getSubTemplate ("common/price.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('value'=>$_smarty_tpl->tpl_vars['cart']->value['points_info']['in_use']['cost']), 0);?>
)&nbsp;<?php echo $_smarty_tpl->getSubTemplate ("buttons/button.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('but_href'=>"checkout.delete_points_in_use?redirect_url=".((string)$_smarty_tpl->tpl_vars['_redirect_url']->value),'but_meta'=>"cm-post ty-reward-points__delete-icon",'but_role'=>"delete",'but_target_id'=>"checkout*,cart_status*,subtotal_price_in_points"), 0);?>
</span>
            <?php }?>
        </div>
</div>
    <!--point_payment--></div>
<?php }
}?><?php }} ?>
