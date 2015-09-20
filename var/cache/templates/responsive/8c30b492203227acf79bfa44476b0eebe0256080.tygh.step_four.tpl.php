<?php /* Smarty version Smarty-3.1.21, created on 2015-09-18 23:18:12
         compiled from "/var/www/bygmarket.com/design/themes/responsive/templates/views/checkout/components/steps/step_four.tpl" */ ?>
<?php /*%%SmartyHeaderCode:103346485955fc7184ccb350-12436080%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8c30b492203227acf79bfa44476b0eebe0256080' => 
    array (
      0 => '/var/www/bygmarket.com/design/themes/responsive/templates/views/checkout/components/steps/step_four.tpl',
      1 => 1442595889,
      2 => 'tygh',
    ),
  ),
  'nocache_hash' => '103346485955fc7184ccb350-12436080',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'runtime' => 0,
    'edit' => 0,
    'number_of_step' => 0,
    'complete' => 0,
    'cart' => 0,
    'auth' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21',
  'unifunc' => 'content_55fc7184d91c38_36751798',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55fc7184d91c38_36751798')) {function content_55fc7184d91c38_36751798($_smarty_tpl) {?><?php if (!is_callable('smarty_function_script')) include '/var/www/bygmarket.com/app/functions/smarty_plugins/function.script.php';
if (!is_callable('smarty_block_hook')) include '/var/www/bygmarket.com/app/functions/smarty_plugins/block.hook.php';
if (!is_callable('smarty_function_set_id')) include '/var/www/bygmarket.com/app/functions/smarty_plugins/function.set_id.php';
?><?php
fn_preload_lang_vars(array('billing_options','billing_options','text_no_payments_needed','submit_my_order','billing_options','billing_options','text_no_payments_needed','submit_my_order'));
?>
<?php if ($_smarty_tpl->tpl_vars['runtime']->value['customization_mode']['design']=="Y"&&@constant('AREA')=="C") {
$_smarty_tpl->_capture_stack[0][] = array("template_content", null, null); ob_start();
echo smarty_function_script(array('src'=>"js/tygh/tabs.js"),$_smarty_tpl);?>


<div class="ty-step__container<?php if ($_smarty_tpl->tpl_vars['edit']->value) {?>-active<?php }?> ty-step-four" data-ct-checkout="billing_options" id="step_four">
    <h3 class="ty-step__title<?php if ($_smarty_tpl->tpl_vars['edit']->value) {?>-active<?php }?> clearfix">
        <span class="ty-step__title-left"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['number_of_step']->value, ENT_QUOTES, 'UTF-8');?>
</span>
        <i class="ty-step__title-arrow ty-icon-down-micro"></i>
        
        <?php $_smarty_tpl->smarty->_tag_stack[] = array('hook', array('name'=>"checkout:step_four_edit_link_title")); $_block_repeat=true; echo smarty_block_hook(array('name'=>"checkout:step_four_edit_link_title"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

        <?php if ($_smarty_tpl->tpl_vars['complete']->value&&!$_smarty_tpl->tpl_vars['edit']->value) {?>
            <a class="ty-step__title-txt cm-ajax" href="<?php echo htmlspecialchars(fn_url("checkout.checkout?edit_step=step_four&from_step=".((string)$_smarty_tpl->tpl_vars['cart']->value['edit_step'])), ENT_QUOTES, 'UTF-8');?>
" data-ca-target-id="checkout_*"><?php echo $_smarty_tpl->__("billing_options");?>
</a>
        <?php } else { ?>
            <span class="ty-step__title-txt"><?php echo $_smarty_tpl->__("billing_options");?>
</span>
        <?php }?>
        <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_hook(array('name'=>"checkout:step_four_edit_link_title"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

    </h3>

    <div id="step_four_body" class="ty-step__body<?php if ($_smarty_tpl->tpl_vars['edit']->value) {?>-active<?php }?> <?php if (!$_smarty_tpl->tpl_vars['edit']->value) {?>hidden<?php }?>">
        <div class="clearfix ty-checkout__billing-tabs">
            
            <?php if ($_smarty_tpl->tpl_vars['edit']->value) {?>
                <?php $_smarty_tpl->_capture_stack[0][] = array("final_section", null, null); ob_start(); ?>
                    <?php echo $_smarty_tpl->getSubTemplate ("views/checkout/components/final_section.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('is_payment_step'=>true), 0);?>

                <?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>

                <?php if (fn_allow_place_order($_smarty_tpl->tpl_vars['cart']->value,$_smarty_tpl->tpl_vars['auth']->value)) {?>
                    <?php if ($_smarty_tpl->tpl_vars['cart']->value['payment_id']) {?>
                        <div class="clearfix">
                            <?php echo $_smarty_tpl->getSubTemplate ("views/checkout/components/payments/payment_methods.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('payment_id'=>$_smarty_tpl->tpl_vars['cart']->value['payment_id'],'final_section'=>Smarty::$_smarty_vars['capture']['final_section']), 0);?>

                        </div>
                    <?php } else { ?>
                        <div class="checkout__block"><h3 class="ty-subheader"><?php echo $_smarty_tpl->__("text_no_payments_needed");?>
</h3></div>
                        
                        <form name="paymens_form" action="<?php echo htmlspecialchars(fn_url(''), ENT_QUOTES, 'UTF-8');?>
" method="post">
                            <?php echo Smarty::$_smarty_vars['capture']['final_section'];?>

                            <div class="ty-checkout-buttons">
                                <?php echo $_smarty_tpl->getSubTemplate ("buttons/place_order.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('but_text'=>__("submit_my_order"),'but_name'=>"dispatch[checkout.place_order]",'but_id'=>"place_order"), 0);?>

                            </div>
                        </form>
                    <?php }?>
                <?php } else { ?>
                    <?php echo Smarty::$_smarty_vars['capture']['final_section'];?>

                <?php }?>
            <?php }?>

        </div>
    </div>
<!--step_four--></div>

<div id="place_order_data" class="hidden">
</div><?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();
if (trim(Smarty::$_smarty_vars['capture']['template_content'])) {
if ($_smarty_tpl->tpl_vars['auth']->value['area']=="A") {?><span class="cm-template-box template-box" data-ca-te-template="views/checkout/components/steps/step_four.tpl" id="<?php echo smarty_function_set_id(array('name'=>"views/checkout/components/steps/step_four.tpl"),$_smarty_tpl);?>
"><div class="cm-template-icon icon-edit ty-icon-edit hidden"></div><?php echo Smarty::$_smarty_vars['capture']['template_content'];?>
<!--[/tpl_id]--></span><?php } else {
echo Smarty::$_smarty_vars['capture']['template_content'];
}
}
} else {
echo smarty_function_script(array('src'=>"js/tygh/tabs.js"),$_smarty_tpl);?>


<div class="ty-step__container<?php if ($_smarty_tpl->tpl_vars['edit']->value) {?>-active<?php }?> ty-step-four" data-ct-checkout="billing_options" id="step_four">
    <h3 class="ty-step__title<?php if ($_smarty_tpl->tpl_vars['edit']->value) {?>-active<?php }?> clearfix">
        <span class="ty-step__title-left"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['number_of_step']->value, ENT_QUOTES, 'UTF-8');?>
</span>
        <i class="ty-step__title-arrow ty-icon-down-micro"></i>
        
        <?php $_smarty_tpl->smarty->_tag_stack[] = array('hook', array('name'=>"checkout:step_four_edit_link_title")); $_block_repeat=true; echo smarty_block_hook(array('name'=>"checkout:step_four_edit_link_title"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

        <?php if ($_smarty_tpl->tpl_vars['complete']->value&&!$_smarty_tpl->tpl_vars['edit']->value) {?>
            <a class="ty-step__title-txt cm-ajax" href="<?php echo htmlspecialchars(fn_url("checkout.checkout?edit_step=step_four&from_step=".((string)$_smarty_tpl->tpl_vars['cart']->value['edit_step'])), ENT_QUOTES, 'UTF-8');?>
" data-ca-target-id="checkout_*"><?php echo $_smarty_tpl->__("billing_options");?>
</a>
        <?php } else { ?>
            <span class="ty-step__title-txt"><?php echo $_smarty_tpl->__("billing_options");?>
</span>
        <?php }?>
        <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_hook(array('name'=>"checkout:step_four_edit_link_title"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

    </h3>

    <div id="step_four_body" class="ty-step__body<?php if ($_smarty_tpl->tpl_vars['edit']->value) {?>-active<?php }?> <?php if (!$_smarty_tpl->tpl_vars['edit']->value) {?>hidden<?php }?>">
        <div class="clearfix ty-checkout__billing-tabs">
            
            <?php if ($_smarty_tpl->tpl_vars['edit']->value) {?>
                <?php $_smarty_tpl->_capture_stack[0][] = array("final_section", null, null); ob_start(); ?>
                    <?php echo $_smarty_tpl->getSubTemplate ("views/checkout/components/final_section.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('is_payment_step'=>true), 0);?>

                <?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>

                <?php if (fn_allow_place_order($_smarty_tpl->tpl_vars['cart']->value,$_smarty_tpl->tpl_vars['auth']->value)) {?>
                    <?php if ($_smarty_tpl->tpl_vars['cart']->value['payment_id']) {?>
                        <div class="clearfix">
                            <?php echo $_smarty_tpl->getSubTemplate ("views/checkout/components/payments/payment_methods.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('payment_id'=>$_smarty_tpl->tpl_vars['cart']->value['payment_id'],'final_section'=>Smarty::$_smarty_vars['capture']['final_section']), 0);?>

                        </div>
                    <?php } else { ?>
                        <div class="checkout__block"><h3 class="ty-subheader"><?php echo $_smarty_tpl->__("text_no_payments_needed");?>
</h3></div>
                        
                        <form name="paymens_form" action="<?php echo htmlspecialchars(fn_url(''), ENT_QUOTES, 'UTF-8');?>
" method="post">
                            <?php echo Smarty::$_smarty_vars['capture']['final_section'];?>

                            <div class="ty-checkout-buttons">
                                <?php echo $_smarty_tpl->getSubTemplate ("buttons/place_order.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('but_text'=>__("submit_my_order"),'but_name'=>"dispatch[checkout.place_order]",'but_id'=>"place_order"), 0);?>

                            </div>
                        </form>
                    <?php }?>
                <?php } else { ?>
                    <?php echo Smarty::$_smarty_vars['capture']['final_section'];?>

                <?php }?>
            <?php }?>

        </div>
    </div>
<!--step_four--></div>

<div id="place_order_data" class="hidden">
</div><?php }?><?php }} ?>
