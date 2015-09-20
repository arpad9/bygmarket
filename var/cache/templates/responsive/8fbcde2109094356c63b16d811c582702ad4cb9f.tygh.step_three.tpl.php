<?php /* Smarty version Smarty-3.1.21, created on 2015-09-18 23:18:12
         compiled from "/var/www/bygmarket.com/design/themes/responsive/templates/views/checkout/components/steps/step_three.tpl" */ ?>
<?php /*%%SmartyHeaderCode:118183442155fc7184b6ecd4-91734376%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8fbcde2109094356c63b16d811c582702ad4cb9f' => 
    array (
      0 => '/var/www/bygmarket.com/design/themes/responsive/templates/views/checkout/components/steps/step_three.tpl',
      1 => 1442595889,
      2 => 'tygh',
    ),
  ),
  'nocache_hash' => '118183442155fc7184b6ecd4-91734376',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'runtime' => 0,
    'complete' => 0,
    'edit' => 0,
    'final_step' => 0,
    'show_number_of_steps' => 0,
    'number_of_step' => 0,
    'cart' => 0,
    'ajax_form' => 0,
    'next_step' => 0,
    'but_text' => 0,
    'auth' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21',
  'unifunc' => 'content_55fc7184c79d49_05914613',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55fc7184c79d49_05914613')) {function content_55fc7184c79d49_05914613($_smarty_tpl) {?><?php if (!is_callable('smarty_block_hook')) include '/var/www/bygmarket.com/app/functions/smarty_plugins/block.hook.php';
if (!is_callable('smarty_function_set_id')) include '/var/www/bygmarket.com/app/functions/smarty_plugins/function.set_id.php';
?><?php
fn_preload_lang_vars(array('change','shipping_options','shipping_options','text_no_shipping_methods','delivery_times_text','shipping_tips','change','shipping_options','shipping_options','text_no_shipping_methods','delivery_times_text','shipping_tips'));
?>
<?php if ($_smarty_tpl->tpl_vars['runtime']->value['customization_mode']['design']=="Y"&&@constant('AREA')=="C") {
$_smarty_tpl->_capture_stack[0][] = array("template_content", null, null); ob_start();
$_smarty_tpl->tpl_vars['show_number_of_steps'] = new Smarty_variable(!$_smarty_tpl->tpl_vars['complete']->value||$_smarty_tpl->tpl_vars['edit']->value||$_smarty_tpl->tpl_vars['final_step']->value=="step_three", null, 0);?>
<div class="ty-step__container<?php if ($_smarty_tpl->tpl_vars['edit']->value) {?>-active<?php }?> ty-step-three" data-ct-checkout="shipping_options" id="step_three">
    <h3 class="ty-step__title<?php if ($_smarty_tpl->tpl_vars['edit']->value) {?>-active<?php }
if (!$_smarty_tpl->tpl_vars['show_number_of_steps']->value) {?>-complete<?php }?> clearfix">
        <span class="ty-step__title-left"><?php if ($_smarty_tpl->tpl_vars['show_number_of_steps']->value) {
echo htmlspecialchars($_smarty_tpl->tpl_vars['number_of_step']->value, ENT_QUOTES, 'UTF-8');
} else { ?><i class="ty-step__title-icon ty-icon-ok"></i><?php }?></span>
        <i class="ty-step__title-arrow ty-icon-down-micro"></i>

        <?php if (!$_smarty_tpl->tpl_vars['show_number_of_steps']->value) {?>
            <?php $_smarty_tpl->smarty->_tag_stack[] = array('hook', array('name'=>"checkout:step_three_edit_link")); $_block_repeat=true; echo smarty_block_hook(array('name'=>"checkout:step_three_edit_link"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

            <span class="ty-step__title-right">
                <?php echo $_smarty_tpl->getSubTemplate ("buttons/button.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('but_meta'=>"ty-btn__secondary cm-ajax",'but_href'=>"checkout.checkout?edit_step=step_three&from_step=".((string)$_smarty_tpl->tpl_vars['cart']->value['edit_step']),'but_target_id'=>"checkout_*",'but_text'=>__("change"),'but_role'=>"tool"), 0);?>

            </span>
            <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_hook(array('name'=>"checkout:step_three_edit_link"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

        <?php }?>
        
        <?php $_smarty_tpl->smarty->_tag_stack[] = array('hook', array('name'=>"checkout:step_three_edit_link_title")); $_block_repeat=true; echo smarty_block_hook(array('name'=>"checkout:step_three_edit_link_title"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

        <?php if (!$_smarty_tpl->tpl_vars['show_number_of_steps']->value) {?>
            <a class="ty-step__title-txt cm-ajax" href="<?php echo htmlspecialchars(fn_url("checkout.checkout?edit_step=step_three&from_step=".((string)$_smarty_tpl->tpl_vars['cart']->value['edit_step'])), ENT_QUOTES, 'UTF-8');?>
" data-ca-target-id="checkout_*"><?php echo $_smarty_tpl->__("shipping_options");?>
</a>
        <?php } else { ?>
            <span class="ty-step__title-txt"><?php echo $_smarty_tpl->__("shipping_options");?>
</span>
        <?php }?>
        <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_hook(array('name'=>"checkout:step_three_edit_link_title"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

    </h3>

    <div id="step_three_body" class="ty-step__body<?php if ($_smarty_tpl->tpl_vars['edit']->value) {?>-active<?php }?> <?php if (!$_smarty_tpl->tpl_vars['edit']->value) {?>hidden<?php }?> clearfix">
        <?php if ($_smarty_tpl->tpl_vars['edit']->value) {?>
            <form name="step_three_payment_and_shipping" class="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['ajax_form']->value, ENT_QUOTES, 'UTF-8');?>
 cm-ajax-full-render" action="<?php echo htmlspecialchars(fn_url(''), ENT_QUOTES, 'UTF-8');?>
" method="<?php if (!$_smarty_tpl->tpl_vars['edit']->value) {?>get<?php } else { ?>post<?php }?>">
                <input type="hidden" name="update_step" value="step_three" />
                <input type="hidden" name="next_step" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['next_step']->value, ENT_QUOTES, 'UTF-8');?>
" />
                <input type="hidden" name="result_ids" value="checkout*" />
                
                <div class="clearfix">
                    <div class="checkout__block">
                    <?php $_smarty_tpl->smarty->_tag_stack[] = array('hook', array('name'=>"checkout:select_shipping")); $_block_repeat=true; echo smarty_block_hook(array('name'=>"checkout:select_shipping"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

                        <?php if (!$_smarty_tpl->tpl_vars['cart']->value['shipping_failed']) {?>
                            <?php echo $_smarty_tpl->getSubTemplate ("views/checkout/components/shipping_rates.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('no_form'=>true,'display'=>"radio"), 0);?>

                        <?php } else { ?>
                            <p class="ty-error-text"><?php echo $_smarty_tpl->__("text_no_shipping_methods");?>
</p>
                        <?php }?>
                    <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_hook(array('name'=>"checkout:select_shipping"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

                
                    <?php if ($_smarty_tpl->tpl_vars['edit']->value) {?>
                        <div class="ty-checkout__shipping-tips">
                        <p><?php echo $_smarty_tpl->__("delivery_times_text");?>
</p>
                            <?php echo $_smarty_tpl->__("shipping_tips");?>

                        </div>
                    <?php }?>
                    </div>
                </div>
                
                <?php if ($_smarty_tpl->tpl_vars['final_step']->value=="step_three") {?>
                    <?php echo $_smarty_tpl->getSubTemplate ("views/checkout/components/final_section.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

                <?php } else { ?>
                    <div class="ty-checkout-buttons">
                        <?php echo $_smarty_tpl->getSubTemplate ("buttons/button.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('but_meta'=>"ty-btn__secondary",'but_name'=>"dispatch[checkout.update_steps]",'but_text'=>$_smarty_tpl->tpl_vars['but_text']->value,'but_id'=>"step_three_but"), 0);?>

                    </div>
                <?php }?>
            
            </form>

        <?php }?>
    </div>
<!--step_three--></div>
<?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();
if (trim(Smarty::$_smarty_vars['capture']['template_content'])) {
if ($_smarty_tpl->tpl_vars['auth']->value['area']=="A") {?><span class="cm-template-box template-box" data-ca-te-template="views/checkout/components/steps/step_three.tpl" id="<?php echo smarty_function_set_id(array('name'=>"views/checkout/components/steps/step_three.tpl"),$_smarty_tpl);?>
"><div class="cm-template-icon icon-edit ty-icon-edit hidden"></div><?php echo Smarty::$_smarty_vars['capture']['template_content'];?>
<!--[/tpl_id]--></span><?php } else {
echo Smarty::$_smarty_vars['capture']['template_content'];
}
}
} else {
$_smarty_tpl->tpl_vars['show_number_of_steps'] = new Smarty_variable(!$_smarty_tpl->tpl_vars['complete']->value||$_smarty_tpl->tpl_vars['edit']->value||$_smarty_tpl->tpl_vars['final_step']->value=="step_three", null, 0);?>
<div class="ty-step__container<?php if ($_smarty_tpl->tpl_vars['edit']->value) {?>-active<?php }?> ty-step-three" data-ct-checkout="shipping_options" id="step_three">
    <h3 class="ty-step__title<?php if ($_smarty_tpl->tpl_vars['edit']->value) {?>-active<?php }
if (!$_smarty_tpl->tpl_vars['show_number_of_steps']->value) {?>-complete<?php }?> clearfix">
        <span class="ty-step__title-left"><?php if ($_smarty_tpl->tpl_vars['show_number_of_steps']->value) {
echo htmlspecialchars($_smarty_tpl->tpl_vars['number_of_step']->value, ENT_QUOTES, 'UTF-8');
} else { ?><i class="ty-step__title-icon ty-icon-ok"></i><?php }?></span>
        <i class="ty-step__title-arrow ty-icon-down-micro"></i>

        <?php if (!$_smarty_tpl->tpl_vars['show_number_of_steps']->value) {?>
            <?php $_smarty_tpl->smarty->_tag_stack[] = array('hook', array('name'=>"checkout:step_three_edit_link")); $_block_repeat=true; echo smarty_block_hook(array('name'=>"checkout:step_three_edit_link"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

            <span class="ty-step__title-right">
                <?php echo $_smarty_tpl->getSubTemplate ("buttons/button.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('but_meta'=>"ty-btn__secondary cm-ajax",'but_href'=>"checkout.checkout?edit_step=step_three&from_step=".((string)$_smarty_tpl->tpl_vars['cart']->value['edit_step']),'but_target_id'=>"checkout_*",'but_text'=>__("change"),'but_role'=>"tool"), 0);?>

            </span>
            <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_hook(array('name'=>"checkout:step_three_edit_link"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

        <?php }?>
        
        <?php $_smarty_tpl->smarty->_tag_stack[] = array('hook', array('name'=>"checkout:step_three_edit_link_title")); $_block_repeat=true; echo smarty_block_hook(array('name'=>"checkout:step_three_edit_link_title"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

        <?php if (!$_smarty_tpl->tpl_vars['show_number_of_steps']->value) {?>
            <a class="ty-step__title-txt cm-ajax" href="<?php echo htmlspecialchars(fn_url("checkout.checkout?edit_step=step_three&from_step=".((string)$_smarty_tpl->tpl_vars['cart']->value['edit_step'])), ENT_QUOTES, 'UTF-8');?>
" data-ca-target-id="checkout_*"><?php echo $_smarty_tpl->__("shipping_options");?>
</a>
        <?php } else { ?>
            <span class="ty-step__title-txt"><?php echo $_smarty_tpl->__("shipping_options");?>
</span>
        <?php }?>
        <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_hook(array('name'=>"checkout:step_three_edit_link_title"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

    </h3>

    <div id="step_three_body" class="ty-step__body<?php if ($_smarty_tpl->tpl_vars['edit']->value) {?>-active<?php }?> <?php if (!$_smarty_tpl->tpl_vars['edit']->value) {?>hidden<?php }?> clearfix">
        <?php if ($_smarty_tpl->tpl_vars['edit']->value) {?>
            <form name="step_three_payment_and_shipping" class="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['ajax_form']->value, ENT_QUOTES, 'UTF-8');?>
 cm-ajax-full-render" action="<?php echo htmlspecialchars(fn_url(''), ENT_QUOTES, 'UTF-8');?>
" method="<?php if (!$_smarty_tpl->tpl_vars['edit']->value) {?>get<?php } else { ?>post<?php }?>">
                <input type="hidden" name="update_step" value="step_three" />
                <input type="hidden" name="next_step" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['next_step']->value, ENT_QUOTES, 'UTF-8');?>
" />
                <input type="hidden" name="result_ids" value="checkout*" />
                
                <div class="clearfix">
                    <div class="checkout__block">
                    <?php $_smarty_tpl->smarty->_tag_stack[] = array('hook', array('name'=>"checkout:select_shipping")); $_block_repeat=true; echo smarty_block_hook(array('name'=>"checkout:select_shipping"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

                        <?php if (!$_smarty_tpl->tpl_vars['cart']->value['shipping_failed']) {?>
                            <?php echo $_smarty_tpl->getSubTemplate ("views/checkout/components/shipping_rates.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('no_form'=>true,'display'=>"radio"), 0);?>

                        <?php } else { ?>
                            <p class="ty-error-text"><?php echo $_smarty_tpl->__("text_no_shipping_methods");?>
</p>
                        <?php }?>
                    <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_hook(array('name'=>"checkout:select_shipping"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

                
                    <?php if ($_smarty_tpl->tpl_vars['edit']->value) {?>
                        <div class="ty-checkout__shipping-tips">
                        <p><?php echo $_smarty_tpl->__("delivery_times_text");?>
</p>
                            <?php echo $_smarty_tpl->__("shipping_tips");?>

                        </div>
                    <?php }?>
                    </div>
                </div>
                
                <?php if ($_smarty_tpl->tpl_vars['final_step']->value=="step_three") {?>
                    <?php echo $_smarty_tpl->getSubTemplate ("views/checkout/components/final_section.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

                <?php } else { ?>
                    <div class="ty-checkout-buttons">
                        <?php echo $_smarty_tpl->getSubTemplate ("buttons/button.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('but_meta'=>"ty-btn__secondary",'but_name'=>"dispatch[checkout.update_steps]",'but_text'=>$_smarty_tpl->tpl_vars['but_text']->value,'but_id'=>"step_three_but"), 0);?>

                    </div>
                <?php }?>
            
            </form>

        <?php }?>
    </div>
<!--step_three--></div>
<?php }?><?php }} ?>
