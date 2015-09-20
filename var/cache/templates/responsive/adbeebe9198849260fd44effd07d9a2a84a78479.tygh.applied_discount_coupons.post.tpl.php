<?php /* Smarty version Smarty-3.1.21, created on 2015-09-18 23:14:35
         compiled from "/var/www/bygmarket.com/design/themes/responsive/templates/addons/reward_points/hooks/checkout/applied_discount_coupons.post.tpl" */ ?>
<?php /*%%SmartyHeaderCode:213669448955fc70abebb057-00339674%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'adbeebe9198849260fd44effd07d9a2a84a78479' => 
    array (
      0 => '/var/www/bygmarket.com/design/themes/responsive/templates/addons/reward_points/hooks/checkout/applied_discount_coupons.post.tpl',
      1 => 1442595905,
      2 => 'tygh',
    ),
  ),
  'nocache_hash' => '213669448955fc70abebb057-00339674',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'runtime' => 0,
    'cart' => 0,
    'cart_products' => 0,
    'user_info' => 0,
    'location' => 0,
    'config' => 0,
    'use_ajax' => 0,
    '_redirect_url' => 0,
    'auth' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21',
  'unifunc' => 'content_55fc70ac039676_69394238',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55fc70ac039676_69394238')) {function content_55fc70ac039676_69394238($_smarty_tpl) {?><?php if (!is_callable('smarty_function_set_id')) include '/var/www/bygmarket.com/app/functions/smarty_plugins/function.set_id.php';
?><?php
fn_preload_lang_vars(array('points','points_to_use','apply','text_point_in_account','points_lowercase','points_in_use_lowercase','points','points_to_use','apply','text_point_in_account','points_lowercase','points_in_use_lowercase'));
?>
<?php if ($_smarty_tpl->tpl_vars['runtime']->value['customization_mode']['design']=="Y"&&@constant('AREA')=="C") {
$_smarty_tpl->_capture_stack[0][] = array("template_content", null, null); ob_start();
if ($_smarty_tpl->tpl_vars['cart']->value['points_info']['reward']) {?>
    <div class="ty-reward-points__info clearfix">
        <span><?php echo $_smarty_tpl->__("points");?>
</span>
        <span class="ty-float-right"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['cart']->value['points_info']['reward'], ENT_QUOTES, 'UTF-8');?>
</span>
    </div>
<?php }?>

<?php if ($_smarty_tpl->tpl_vars['runtime']->value['mode']=="checkout"&&$_smarty_tpl->tpl_vars['cart_products']->value&&$_smarty_tpl->tpl_vars['cart']->value['points_info']['total_price']&&$_smarty_tpl->tpl_vars['user_info']->value['points']>0) {?>
    <form class="cm-ajax cm-ajax-full-render" name="point_payment_form" action="<?php echo htmlspecialchars(fn_url(''), ENT_QUOTES, 'UTF-8');?>
" method="post">
        <input type="hidden" name="redirect_mode" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['location']->value, ENT_QUOTES, 'UTF-8');?>
" />
        <input type="hidden" name="result_ids" value="checkout*,cart_status*" />

        <div class="ty-discount-coupon__control-group ty-reward-points__coupon ty-input-append ty-inline-block">
            <input type="text" class="ty-input-text ty-valign cm-hint" name="points_to_use" size="40" value="<?php echo $_smarty_tpl->__("points_to_use");?>
" />
            <?php echo $_smarty_tpl->getSubTemplate ("buttons/go.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('but_name'=>"checkout.point_payment",'alt'=>__("apply")), 0);?>

            <input type="submit" class="hidden" name="dispatch[checkout.point_payment]" value="" />
        </div>
    </form>

    <?php if ($_smarty_tpl->tpl_vars['user_info']->value['points']) {?>
        <div class="ty-discount-info">
            <span class="ty-caret-info"><span class="ty-caret-outer"></span><span class="ty-caret-inner"></span></span>
            <span class="ty-reward-points__txt-point"><?php echo $_smarty_tpl->__("text_point_in_account");?>
&nbsp;<?php echo $_smarty_tpl->__("points_lowercase",array($_smarty_tpl->tpl_vars['user_info']->value['points']));?>
.</span>
            
            <?php if ($_smarty_tpl->tpl_vars['cart']->value['points_info']['in_use']['points']) {?>
                <?php $_smarty_tpl->tpl_vars["_redirect_url"] = new Smarty_variable(rawurlencode($_smarty_tpl->tpl_vars['config']->value['current_url']), null, 0);?>
                <?php if ($_smarty_tpl->tpl_vars['use_ajax']->value) {
$_smarty_tpl->tpl_vars["_class"] = new Smarty_variable("cm-ajax", null, 0);
}?>
                <span class="ty-reward-points__points-in-use">
                        <?php echo $_smarty_tpl->__("points_in_use_lowercase",array($_smarty_tpl->tpl_vars['cart']->value['points_info']['in_use']['points']));?>
.
                        (<?php echo $_smarty_tpl->getSubTemplate ("common/price.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('value'=>$_smarty_tpl->tpl_vars['cart']->value['points_info']['in_use']['cost']), 0);?>
)
                        <?php echo $_smarty_tpl->getSubTemplate ("buttons/button.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('but_href'=>"checkout.delete_points_in_use?redirect_url=".((string)$_smarty_tpl->tpl_vars['_redirect_url']->value),'but_meta'=>"cm-post ty-reward-points__delete-icon",'but_role'=>"delete",'but_target_id'=>"checkout*,cart_status*,subtotal_price_in_points"), 0);?>

                </span>
            <?php }?>
        </div>
    <?php }?>
<?php }
list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();
if (trim(Smarty::$_smarty_vars['capture']['template_content'])) {
if ($_smarty_tpl->tpl_vars['auth']->value['area']=="A") {?><span class="cm-template-box template-box" data-ca-te-template="addons/reward_points/hooks/checkout/applied_discount_coupons.post.tpl" id="<?php echo smarty_function_set_id(array('name'=>"addons/reward_points/hooks/checkout/applied_discount_coupons.post.tpl"),$_smarty_tpl);?>
"><div class="cm-template-icon icon-edit ty-icon-edit hidden"></div><?php echo Smarty::$_smarty_vars['capture']['template_content'];?>
<!--[/tpl_id]--></span><?php } else {
echo Smarty::$_smarty_vars['capture']['template_content'];
}
}
} else {
if ($_smarty_tpl->tpl_vars['cart']->value['points_info']['reward']) {?>
    <div class="ty-reward-points__info clearfix">
        <span><?php echo $_smarty_tpl->__("points");?>
</span>
        <span class="ty-float-right"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['cart']->value['points_info']['reward'], ENT_QUOTES, 'UTF-8');?>
</span>
    </div>
<?php }?>

<?php if ($_smarty_tpl->tpl_vars['runtime']->value['mode']=="checkout"&&$_smarty_tpl->tpl_vars['cart_products']->value&&$_smarty_tpl->tpl_vars['cart']->value['points_info']['total_price']&&$_smarty_tpl->tpl_vars['user_info']->value['points']>0) {?>
    <form class="cm-ajax cm-ajax-full-render" name="point_payment_form" action="<?php echo htmlspecialchars(fn_url(''), ENT_QUOTES, 'UTF-8');?>
" method="post">
        <input type="hidden" name="redirect_mode" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['location']->value, ENT_QUOTES, 'UTF-8');?>
" />
        <input type="hidden" name="result_ids" value="checkout*,cart_status*" />

        <div class="ty-discount-coupon__control-group ty-reward-points__coupon ty-input-append ty-inline-block">
            <input type="text" class="ty-input-text ty-valign cm-hint" name="points_to_use" size="40" value="<?php echo $_smarty_tpl->__("points_to_use");?>
" />
            <?php echo $_smarty_tpl->getSubTemplate ("buttons/go.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('but_name'=>"checkout.point_payment",'alt'=>__("apply")), 0);?>

            <input type="submit" class="hidden" name="dispatch[checkout.point_payment]" value="" />
        </div>
    </form>

    <?php if ($_smarty_tpl->tpl_vars['user_info']->value['points']) {?>
        <div class="ty-discount-info">
            <span class="ty-caret-info"><span class="ty-caret-outer"></span><span class="ty-caret-inner"></span></span>
            <span class="ty-reward-points__txt-point"><?php echo $_smarty_tpl->__("text_point_in_account");?>
&nbsp;<?php echo $_smarty_tpl->__("points_lowercase",array($_smarty_tpl->tpl_vars['user_info']->value['points']));?>
.</span>
            
            <?php if ($_smarty_tpl->tpl_vars['cart']->value['points_info']['in_use']['points']) {?>
                <?php $_smarty_tpl->tpl_vars["_redirect_url"] = new Smarty_variable(rawurlencode($_smarty_tpl->tpl_vars['config']->value['current_url']), null, 0);?>
                <?php if ($_smarty_tpl->tpl_vars['use_ajax']->value) {
$_smarty_tpl->tpl_vars["_class"] = new Smarty_variable("cm-ajax", null, 0);
}?>
                <span class="ty-reward-points__points-in-use">
                        <?php echo $_smarty_tpl->__("points_in_use_lowercase",array($_smarty_tpl->tpl_vars['cart']->value['points_info']['in_use']['points']));?>
.
                        (<?php echo $_smarty_tpl->getSubTemplate ("common/price.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('value'=>$_smarty_tpl->tpl_vars['cart']->value['points_info']['in_use']['cost']), 0);?>
)
                        <?php echo $_smarty_tpl->getSubTemplate ("buttons/button.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('but_href'=>"checkout.delete_points_in_use?redirect_url=".((string)$_smarty_tpl->tpl_vars['_redirect_url']->value),'but_meta'=>"cm-post ty-reward-points__delete-icon",'but_role'=>"delete",'but_target_id'=>"checkout*,cart_status*,subtotal_price_in_points"), 0);?>

                </span>
            <?php }?>
        </div>
    <?php }?>
<?php }
}?><?php }} ?>
