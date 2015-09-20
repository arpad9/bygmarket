<?php /* Smarty version Smarty-3.1.21, created on 2015-09-18 23:14:35
         compiled from "/var/www/bygmarket.com/design/themes/responsive/templates/views/checkout/components/promotion_coupon.tpl" */ ?>
<?php /*%%SmartyHeaderCode:84642651655fc70abc58818-29602388%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd3cb25ba22690dd13dfce97d47d55eaa75334db2' => 
    array (
      0 => '/var/www/bygmarket.com/design/themes/responsive/templates/views/checkout/components/promotion_coupon.tpl',
      1 => 1442595889,
      2 => 'tygh',
    ),
  ),
  'nocache_hash' => '84642651655fc70abc58818-29602388',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'runtime' => 0,
    'cart' => 0,
    'position' => 0,
    'config' => 0,
    'coupon_code' => 0,
    '_redirect_url' => 0,
    'auth' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21',
  'unifunc' => 'content_55fc70abd2d331_30645299',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55fc70abd2d331_30645299')) {function content_55fc70abd2d331_30645299($_smarty_tpl) {?><?php if (!is_callable('smarty_block_hook')) include '/var/www/bygmarket.com/app/functions/smarty_plugins/block.hook.php';
if (!is_callable('smarty_function_set_id')) include '/var/www/bygmarket.com/app/functions/smarty_plugins/function.set_id.php';
?><?php
fn_preload_lang_vars(array('promo_code','promo_code','apply','coupon','promo_code','promo_code','apply','coupon'));
?>
<?php if ($_smarty_tpl->tpl_vars['runtime']->value['customization_mode']['design']=="Y"&&@constant('AREA')=="C") {
$_smarty_tpl->_capture_stack[0][] = array("template_content", null, null); ob_start();
if (fn_display_promotion_input_field($_smarty_tpl->tpl_vars['cart']->value)) {?>
<div>
    <form class="cm-ajax cm-ajax-force cm-ajax-full-render" name="coupon_code_form<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['position']->value, ENT_QUOTES, 'UTF-8');?>
" action="<?php echo htmlspecialchars(fn_url(''), ENT_QUOTES, 'UTF-8');?>
" method="post">
        <input type="hidden" name="result_ids" value="checkout*,cart_status*,cart_items,payment-methods" />
        <input type="hidden" name="redirect_url" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['config']->value['current_url'], ENT_QUOTES, 'UTF-8');?>
" />

        <?php $_smarty_tpl->smarty->_tag_stack[] = array('hook', array('name'=>"checkout:discount_coupons")); $_block_repeat=true; echo smarty_block_hook(array('name'=>"checkout:discount_coupons"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

            <div class="ty-discount-coupon__control-group ty-input-append">
                <label for="coupon_field<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['position']->value, ENT_QUOTES, 'UTF-8');?>
" class="hidden cm-required"><?php echo $_smarty_tpl->__("promo_code");?>
</label>
                <input type="text" class="ty-input-text cm-hint" id="coupon_field<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['position']->value, ENT_QUOTES, 'UTF-8');?>
" name="coupon_code" size="40" value="<?php echo $_smarty_tpl->__("promo_code");?>
" />
                <?php echo $_smarty_tpl->getSubTemplate ("buttons/go.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('but_name'=>"checkout.apply_coupon",'alt'=>__("apply")), 0);?>

            </div>
        <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_hook(array('name'=>"checkout:discount_coupons"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

    </form>
</div>
<?php }?>

<?php $_smarty_tpl->smarty->_tag_stack[] = array('hook', array('name'=>"checkout:applied_discount_coupons")); $_block_repeat=true; echo smarty_block_hook(array('name'=>"checkout:applied_discount_coupons"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

    <?php $_smarty_tpl->_capture_stack[0][] = array("promotion_info", null, null); ob_start(); ?>
        <?php $_smarty_tpl->smarty->_tag_stack[] = array('hook', array('name'=>"checkout:applied_coupons_items")); $_block_repeat=true; echo smarty_block_hook(array('name'=>"checkout:applied_coupons_items"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

            <?php  $_smarty_tpl->tpl_vars["coupon"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["coupon"]->_loop = false;
 $_smarty_tpl->tpl_vars["coupon_code"] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['cart']->value['coupons']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["coupon"]->key => $_smarty_tpl->tpl_vars["coupon"]->value) {
$_smarty_tpl->tpl_vars["coupon"]->_loop = true;
 $_smarty_tpl->tpl_vars["coupon_code"]->value = $_smarty_tpl->tpl_vars["coupon"]->key;
?>
            <li class="ty-coupons__item">
                <?php echo $_smarty_tpl->__("coupon");?>
 "<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['coupon_code']->value, ENT_QUOTES, 'UTF-8');?>
"
                <?php $_smarty_tpl->tpl_vars["_redirect_url"] = new Smarty_variable(rawurlencode($_smarty_tpl->tpl_vars['config']->value['current_url']), null, 0);?>
                <?php $_smarty_tpl->tpl_vars["coupon_code"] = new Smarty_variable(rawurlencode($_smarty_tpl->tpl_vars['coupon_code']->value), null, 0);?>
                <?php echo $_smarty_tpl->getSubTemplate ("buttons/button.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('but_href'=>"checkout.delete_coupon?coupon_code=".((string)$_smarty_tpl->tpl_vars['coupon_code']->value)."&redirect_url=".((string)$_smarty_tpl->tpl_vars['_redirect_url']->value),'but_role'=>"delete",'but_meta'=>"ty-coupons__item-delete cm-ajax cm-ajax-full-render",'but_target_id'=>"checkout*,cart_status*,cart_items"), 0);?>

            </li>
            <?php } ?>
            <?php if ($_smarty_tpl->tpl_vars['cart']->value['applied_promotions']) {?>
                <li class="ty-coupons__item">
                    <?php echo $_smarty_tpl->getSubTemplate ("views/checkout/components/applied_promotions.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

                </li>
            <?php }?>
        <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_hook(array('name'=>"checkout:applied_coupons_items"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

    <?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>

    <?php if (trim(Smarty::$_smarty_vars['capture']['promotion_info'])) {?>
        <ul class="ty-coupons__list ty-discount-info">
            <?php if ($_smarty_tpl->tpl_vars['cart']->value['has_coupons']) {?>
                <li class="ty-caret-info"><span class="ty-caret-outer"></span><span class="ty-caret-inner"></span></li>
            <?php }?>
            <?php echo Smarty::$_smarty_vars['capture']['promotion_info'];?>

        </ul>
    <?php }?>
<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_hook(array('name'=>"checkout:applied_discount_coupons"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

<?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();
if (trim(Smarty::$_smarty_vars['capture']['template_content'])) {
if ($_smarty_tpl->tpl_vars['auth']->value['area']=="A") {?><span class="cm-template-box template-box" data-ca-te-template="views/checkout/components/promotion_coupon.tpl" id="<?php echo smarty_function_set_id(array('name'=>"views/checkout/components/promotion_coupon.tpl"),$_smarty_tpl);?>
"><div class="cm-template-icon icon-edit ty-icon-edit hidden"></div><?php echo Smarty::$_smarty_vars['capture']['template_content'];?>
<!--[/tpl_id]--></span><?php } else {
echo Smarty::$_smarty_vars['capture']['template_content'];
}
}
} else {
if (fn_display_promotion_input_field($_smarty_tpl->tpl_vars['cart']->value)) {?>
<div>
    <form class="cm-ajax cm-ajax-force cm-ajax-full-render" name="coupon_code_form<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['position']->value, ENT_QUOTES, 'UTF-8');?>
" action="<?php echo htmlspecialchars(fn_url(''), ENT_QUOTES, 'UTF-8');?>
" method="post">
        <input type="hidden" name="result_ids" value="checkout*,cart_status*,cart_items,payment-methods" />
        <input type="hidden" name="redirect_url" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['config']->value['current_url'], ENT_QUOTES, 'UTF-8');?>
" />

        <?php $_smarty_tpl->smarty->_tag_stack[] = array('hook', array('name'=>"checkout:discount_coupons")); $_block_repeat=true; echo smarty_block_hook(array('name'=>"checkout:discount_coupons"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

            <div class="ty-discount-coupon__control-group ty-input-append">
                <label for="coupon_field<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['position']->value, ENT_QUOTES, 'UTF-8');?>
" class="hidden cm-required"><?php echo $_smarty_tpl->__("promo_code");?>
</label>
                <input type="text" class="ty-input-text cm-hint" id="coupon_field<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['position']->value, ENT_QUOTES, 'UTF-8');?>
" name="coupon_code" size="40" value="<?php echo $_smarty_tpl->__("promo_code");?>
" />
                <?php echo $_smarty_tpl->getSubTemplate ("buttons/go.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('but_name'=>"checkout.apply_coupon",'alt'=>__("apply")), 0);?>

            </div>
        <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_hook(array('name'=>"checkout:discount_coupons"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

    </form>
</div>
<?php }?>

<?php $_smarty_tpl->smarty->_tag_stack[] = array('hook', array('name'=>"checkout:applied_discount_coupons")); $_block_repeat=true; echo smarty_block_hook(array('name'=>"checkout:applied_discount_coupons"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

    <?php $_smarty_tpl->_capture_stack[0][] = array("promotion_info", null, null); ob_start(); ?>
        <?php $_smarty_tpl->smarty->_tag_stack[] = array('hook', array('name'=>"checkout:applied_coupons_items")); $_block_repeat=true; echo smarty_block_hook(array('name'=>"checkout:applied_coupons_items"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

            <?php  $_smarty_tpl->tpl_vars["coupon"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["coupon"]->_loop = false;
 $_smarty_tpl->tpl_vars["coupon_code"] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['cart']->value['coupons']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["coupon"]->key => $_smarty_tpl->tpl_vars["coupon"]->value) {
$_smarty_tpl->tpl_vars["coupon"]->_loop = true;
 $_smarty_tpl->tpl_vars["coupon_code"]->value = $_smarty_tpl->tpl_vars["coupon"]->key;
?>
            <li class="ty-coupons__item">
                <?php echo $_smarty_tpl->__("coupon");?>
 "<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['coupon_code']->value, ENT_QUOTES, 'UTF-8');?>
"
                <?php $_smarty_tpl->tpl_vars["_redirect_url"] = new Smarty_variable(rawurlencode($_smarty_tpl->tpl_vars['config']->value['current_url']), null, 0);?>
                <?php $_smarty_tpl->tpl_vars["coupon_code"] = new Smarty_variable(rawurlencode($_smarty_tpl->tpl_vars['coupon_code']->value), null, 0);?>
                <?php echo $_smarty_tpl->getSubTemplate ("buttons/button.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('but_href'=>"checkout.delete_coupon?coupon_code=".((string)$_smarty_tpl->tpl_vars['coupon_code']->value)."&redirect_url=".((string)$_smarty_tpl->tpl_vars['_redirect_url']->value),'but_role'=>"delete",'but_meta'=>"ty-coupons__item-delete cm-ajax cm-ajax-full-render",'but_target_id'=>"checkout*,cart_status*,cart_items"), 0);?>

            </li>
            <?php } ?>
            <?php if ($_smarty_tpl->tpl_vars['cart']->value['applied_promotions']) {?>
                <li class="ty-coupons__item">
                    <?php echo $_smarty_tpl->getSubTemplate ("views/checkout/components/applied_promotions.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

                </li>
            <?php }?>
        <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_hook(array('name'=>"checkout:applied_coupons_items"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

    <?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>

    <?php if (trim(Smarty::$_smarty_vars['capture']['promotion_info'])) {?>
        <ul class="ty-coupons__list ty-discount-info">
            <?php if ($_smarty_tpl->tpl_vars['cart']->value['has_coupons']) {?>
                <li class="ty-caret-info"><span class="ty-caret-outer"></span><span class="ty-caret-inner"></span></li>
            <?php }?>
            <?php echo Smarty::$_smarty_vars['capture']['promotion_info'];?>

        </ul>
    <?php }?>
<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_hook(array('name'=>"checkout:applied_discount_coupons"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

<?php }?><?php }} ?>
