<?php /* Smarty version Smarty-3.1.21, created on 2015-09-18 23:18:12
         compiled from "/var/www/bygmarket.com/design/themes/responsive/templates/views/checkout/components/steps/step_two.tpl" */ ?>
<?php /*%%SmartyHeaderCode:117763230755fc718495cdf1-96887801%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a4da3716f528489776804d7f2001b60283854c1d' => 
    array (
      0 => '/var/www/bygmarket.com/design/themes/responsive/templates/views/checkout/components/steps/step_two.tpl',
      1 => 1442595889,
      2 => 'tygh',
    ),
  ),
  'nocache_hash' => '117763230755fc718495cdf1-96887801',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'runtime' => 0,
    'edit' => 0,
    'complete' => 0,
    'show_number_of_step' => 0,
    'number_of_step' => 0,
    'cart' => 0,
    'ajax_form' => 0,
    'final_step' => 0,
    'next_step' => 0,
    'hide_profile_name' => 0,
    'settings' => 0,
    'first_section' => 0,
    'profile_fields' => 0,
    'first_section_text' => 0,
    'sec_section' => 0,
    'body_id' => 0,
    'sec_section_text' => 0,
    'auth' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21',
  'unifunc' => 'content_55fc7184b1a044_64600210',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55fc7184b1a044_64600210')) {function content_55fc7184b1a044_64600210($_smarty_tpl) {?><?php if (!is_callable('smarty_block_hook')) include '/var/www/bygmarket.com/app/functions/smarty_plugins/block.hook.php';
if (!is_callable('smarty_function_set_id')) include '/var/www/bygmarket.com/app/functions/smarty_plugins/function.set_id.php';
?><?php
fn_preload_lang_vars(array('change','billing_shipping_address','billing_shipping_address','billing_address','shipping_address','text_ship_to_billing','shipping_address','billing_address','text_billing_same_with_shipping','continue','change','billing_shipping_address','billing_shipping_address','billing_address','shipping_address','text_ship_to_billing','shipping_address','billing_address','text_billing_same_with_shipping','continue'));
?>
<?php if ($_smarty_tpl->tpl_vars['runtime']->value['customization_mode']['design']=="Y"&&@constant('AREA')=="C") {
$_smarty_tpl->_capture_stack[0][] = array("template_content", null, null); ob_start(); ?><div class="ty-step__container<?php if ($_smarty_tpl->tpl_vars['edit']->value) {?>-active<?php }?> ty-step-two" data-ct-checkout="billing_shipping_address" id="step_two">
    <h3 class="ty-step__title<?php if ($_smarty_tpl->tpl_vars['edit']->value) {?>-active<?php }
if ($_smarty_tpl->tpl_vars['complete']->value&&!$_smarty_tpl->tpl_vars['edit']->value) {?>-complete<?php }?> clearfix">
        <?php if (!$_smarty_tpl->tpl_vars['complete']->value||$_smarty_tpl->tpl_vars['edit']->value) {?>
            <?php $_smarty_tpl->tpl_vars['show_number_of_step'] = new Smarty_variable(true, null, 0);?>
        <?php }?>
        <?php if (($_smarty_tpl->tpl_vars['show_number_of_step']->value&&$_smarty_tpl->tpl_vars['number_of_step']->value)||!$_smarty_tpl->tpl_vars['show_number_of_step']->value) {?>
            <span class="ty-step__title-left"><?php if ($_smarty_tpl->tpl_vars['show_number_of_step']->value) {
echo htmlspecialchars($_smarty_tpl->tpl_vars['number_of_step']->value, ENT_QUOTES, 'UTF-8');
} else { ?><i class="ty-step__title-icon ty-icon-ok"></i><?php }?></span>
        <?php }?>
        <i class="ty-step__title-arrow ty-icon-down-micro"></i>

        
        <?php if ($_smarty_tpl->tpl_vars['complete']->value&&!$_smarty_tpl->tpl_vars['edit']->value) {?>
            <?php $_smarty_tpl->smarty->_tag_stack[] = array('hook', array('name'=>"checkout:step_two_edit_link")); $_block_repeat=true; echo smarty_block_hook(array('name'=>"checkout:step_two_edit_link"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

            <span class="ty-step__title-right">
                <?php echo $_smarty_tpl->getSubTemplate ("buttons/button.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('but_meta'=>"ty-btn__secondary cm-ajax",'but_href'=>"checkout.checkout?edit_step=step_two&from_step=".((string)$_smarty_tpl->tpl_vars['cart']->value['edit_step']),'but_target_id'=>"checkout_*",'but_text'=>__("change"),'but_role'=>"tool"), 0);?>

            </span>
            <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_hook(array('name'=>"checkout:step_two_edit_link"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

        <?php }?>
        
        <?php $_smarty_tpl->smarty->_tag_stack[] = array('hook', array('name'=>"checkout:step_two_edit_link_title")); $_block_repeat=true; echo smarty_block_hook(array('name'=>"checkout:step_two_edit_link_title"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

        <?php if ($_smarty_tpl->tpl_vars['complete']->value&&!$_smarty_tpl->tpl_vars['edit']->value) {?>
            <a class="ty-step__title-txt cm-ajax" href="<?php echo htmlspecialchars(fn_url("checkout.checkout?edit_step=step_two&from_step=".((string)$_smarty_tpl->tpl_vars['cart']->value['edit_step'])), ENT_QUOTES, 'UTF-8');?>
" data-ca-target-id="checkout_*"><?php echo $_smarty_tpl->__("billing_shipping_address");?>
</a>
        <?php } else { ?>
            <span class="ty-step__title-txt"><?php echo $_smarty_tpl->__("billing_shipping_address");?>
</span>
        <?php }?>
        <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_hook(array('name'=>"checkout:step_two_edit_link_title"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

    </h3>

    <div id="step_two_body" class="ty-step__body<?php if ($_smarty_tpl->tpl_vars['edit']->value) {?>-active<?php }
if (!$_smarty_tpl->tpl_vars['edit']->value) {?> hidden<?php }?> cm-skip-save-fields">
        <form name="step_two_billing_address" class="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['ajax_form']->value, ENT_QUOTES, 'UTF-8');?>
 cm-ajax-full-render <?php if ($_smarty_tpl->tpl_vars['final_step']->value=="step_two") {?>cm-checkout-recalculate-form<?php }?>" action="<?php echo htmlspecialchars(fn_url(''), ENT_QUOTES, 'UTF-8');?>
" method="<?php if (!$_smarty_tpl->tpl_vars['edit']->value) {?>get<?php } else { ?>post<?php }?>">
            <input type="hidden" name="update_step" value="step_two" />
            <input type="hidden" name="next_step" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['next_step']->value, ENT_QUOTES, 'UTF-8');?>
" />
            <input type="hidden" name="result_ids" value="checkout*,account*" />
            <input type="hidden" name="dispatch" value="checkout.checkout" />

            <?php if ($_REQUEST['profile']=="new") {?>
                <?php $_smarty_tpl->tpl_vars["hide_profile_name"] = new Smarty_variable(false, null, 0);?>
            <?php } else { ?>
                <?php $_smarty_tpl->tpl_vars["hide_profile_name"] = new Smarty_variable(true, null, 0);?>
            <?php }?>
            
            <?php if ($_smarty_tpl->tpl_vars['edit']->value) {?>
                <div class="clearfix">
                    <div class="checkout__block">
                        <?php echo $_smarty_tpl->getSubTemplate ("views/profiles/components/multiple_profiles.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('show_text'=>true,'hide_profile_name'=>$_smarty_tpl->tpl_vars['hide_profile_name']->value,'hide_profile_delete'=>true,'profile_id'=>$_smarty_tpl->tpl_vars['cart']->value['profile_id'],'create_href'=>"checkout.checkout?edit_step=step_two&from_step=".((string)$_smarty_tpl->tpl_vars['cart']->value).".edit_step&profile=new"), 0);?>

                    </div>
                </div>
            <?php }?>
            
            <?php if ($_smarty_tpl->tpl_vars['settings']->value['Checkout']['address_position']=="billing_first") {?>
                <?php $_smarty_tpl->tpl_vars["first_section"] = new Smarty_variable("B", null, 0);?>
                <?php $_smarty_tpl->tpl_vars["first_section_text"] = new Smarty_variable($_smarty_tpl->__("billing_address"), null, 0);?>
                <?php $_smarty_tpl->tpl_vars["sec_section"] = new Smarty_variable("S", null, 0);?>
                <?php $_smarty_tpl->tpl_vars["sec_section_text"] = new Smarty_variable($_smarty_tpl->__("shipping_address"), null, 0);?>
                <?php $_smarty_tpl->tpl_vars["ship_to_another_text"] = new Smarty_variable($_smarty_tpl->__("text_ship_to_billing"), null, 0);?>
                <?php $_smarty_tpl->tpl_vars["body_id"] = new Smarty_variable("sa", null, 0);?>
            <?php } else { ?>
                <?php $_smarty_tpl->tpl_vars["first_section"] = new Smarty_variable("S", null, 0);?>
                <?php $_smarty_tpl->tpl_vars["first_section_text"] = new Smarty_variable($_smarty_tpl->__("shipping_address"), null, 0);?>
                <?php $_smarty_tpl->tpl_vars["sec_section"] = new Smarty_variable("B", null, 0);?>
                <?php $_smarty_tpl->tpl_vars["sec_section_text"] = new Smarty_variable($_smarty_tpl->__("billing_address"), null, 0);?>
                <?php $_smarty_tpl->tpl_vars["ship_to_another_text"] = new Smarty_variable($_smarty_tpl->__("text_billing_same_with_shipping"), null, 0);?>
                <?php $_smarty_tpl->tpl_vars["body_id"] = new Smarty_variable("ba", null, 0);?>
            <?php }?>
            
            <?php if ($_smarty_tpl->tpl_vars['edit']->value) {?>
                <?php if ($_smarty_tpl->tpl_vars['profile_fields']->value[$_smarty_tpl->tpl_vars['first_section']->value]) {?>
                    <div class="clearfix" data-ct-address="billing-address">
                        <div class="checkout__block">
                            <?php echo $_smarty_tpl->getSubTemplate ("views/profiles/components/profile_fields.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('section'=>$_smarty_tpl->tpl_vars['first_section']->value,'body_id'=>'','ship_to_another'=>true,'title'=>$_smarty_tpl->tpl_vars['first_section_text']->value), 0);?>

                        </div>
                    </div>
                <?php }?>

                <?php if ($_smarty_tpl->tpl_vars['profile_fields']->value[$_smarty_tpl->tpl_vars['sec_section']->value]) {?>
                    <div class="clearfix shipping-address__switch" data-ct-address="shipping-address">
                        <?php echo $_smarty_tpl->getSubTemplate ("views/profiles/components/profile_fields.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('section'=>$_smarty_tpl->tpl_vars['sec_section']->value,'body_id'=>$_smarty_tpl->tpl_vars['body_id']->value,'address_flag'=>fn_compare_shipping_billing($_smarty_tpl->tpl_vars['profile_fields']->value),'ship_to_another'=>$_smarty_tpl->tpl_vars['cart']->value['ship_to_another'],'title'=>$_smarty_tpl->tpl_vars['sec_section_text']->value,'grid_wrap'=>"checkout__block"), 0);?>

                    </div>
                <?php }?>

                <?php if ($_smarty_tpl->tpl_vars['final_step']->value=="step_two") {?>
                    <?php echo $_smarty_tpl->getSubTemplate ("views/checkout/components/final_section.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('recalculate'=>true), 0);?>

                <?php } else { ?>
                    <div class="ty-checkout-buttons">
                        <?php echo $_smarty_tpl->getSubTemplate ("buttons/button.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('but_meta'=>"ty-btn__secondary",'but_name'=>"dispatch[checkout.update_steps]",'but_text'=>__("continue")), 0);?>

                    </div>
                <?php }?>
            <?php }?>

        </form>

    </div>

<!--step_two--></div><?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();
if (trim(Smarty::$_smarty_vars['capture']['template_content'])) {
if ($_smarty_tpl->tpl_vars['auth']->value['area']=="A") {?><span class="cm-template-box template-box" data-ca-te-template="views/checkout/components/steps/step_two.tpl" id="<?php echo smarty_function_set_id(array('name'=>"views/checkout/components/steps/step_two.tpl"),$_smarty_tpl);?>
"><div class="cm-template-icon icon-edit ty-icon-edit hidden"></div><?php echo Smarty::$_smarty_vars['capture']['template_content'];?>
<!--[/tpl_id]--></span><?php } else {
echo Smarty::$_smarty_vars['capture']['template_content'];
}
}
} else { ?><div class="ty-step__container<?php if ($_smarty_tpl->tpl_vars['edit']->value) {?>-active<?php }?> ty-step-two" data-ct-checkout="billing_shipping_address" id="step_two">
    <h3 class="ty-step__title<?php if ($_smarty_tpl->tpl_vars['edit']->value) {?>-active<?php }
if ($_smarty_tpl->tpl_vars['complete']->value&&!$_smarty_tpl->tpl_vars['edit']->value) {?>-complete<?php }?> clearfix">
        <?php if (!$_smarty_tpl->tpl_vars['complete']->value||$_smarty_tpl->tpl_vars['edit']->value) {?>
            <?php $_smarty_tpl->tpl_vars['show_number_of_step'] = new Smarty_variable(true, null, 0);?>
        <?php }?>
        <?php if (($_smarty_tpl->tpl_vars['show_number_of_step']->value&&$_smarty_tpl->tpl_vars['number_of_step']->value)||!$_smarty_tpl->tpl_vars['show_number_of_step']->value) {?>
            <span class="ty-step__title-left"><?php if ($_smarty_tpl->tpl_vars['show_number_of_step']->value) {
echo htmlspecialchars($_smarty_tpl->tpl_vars['number_of_step']->value, ENT_QUOTES, 'UTF-8');
} else { ?><i class="ty-step__title-icon ty-icon-ok"></i><?php }?></span>
        <?php }?>
        <i class="ty-step__title-arrow ty-icon-down-micro"></i>

        
        <?php if ($_smarty_tpl->tpl_vars['complete']->value&&!$_smarty_tpl->tpl_vars['edit']->value) {?>
            <?php $_smarty_tpl->smarty->_tag_stack[] = array('hook', array('name'=>"checkout:step_two_edit_link")); $_block_repeat=true; echo smarty_block_hook(array('name'=>"checkout:step_two_edit_link"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

            <span class="ty-step__title-right">
                <?php echo $_smarty_tpl->getSubTemplate ("buttons/button.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('but_meta'=>"ty-btn__secondary cm-ajax",'but_href'=>"checkout.checkout?edit_step=step_two&from_step=".((string)$_smarty_tpl->tpl_vars['cart']->value['edit_step']),'but_target_id'=>"checkout_*",'but_text'=>__("change"),'but_role'=>"tool"), 0);?>

            </span>
            <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_hook(array('name'=>"checkout:step_two_edit_link"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

        <?php }?>
        
        <?php $_smarty_tpl->smarty->_tag_stack[] = array('hook', array('name'=>"checkout:step_two_edit_link_title")); $_block_repeat=true; echo smarty_block_hook(array('name'=>"checkout:step_two_edit_link_title"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

        <?php if ($_smarty_tpl->tpl_vars['complete']->value&&!$_smarty_tpl->tpl_vars['edit']->value) {?>
            <a class="ty-step__title-txt cm-ajax" href="<?php echo htmlspecialchars(fn_url("checkout.checkout?edit_step=step_two&from_step=".((string)$_smarty_tpl->tpl_vars['cart']->value['edit_step'])), ENT_QUOTES, 'UTF-8');?>
" data-ca-target-id="checkout_*"><?php echo $_smarty_tpl->__("billing_shipping_address");?>
</a>
        <?php } else { ?>
            <span class="ty-step__title-txt"><?php echo $_smarty_tpl->__("billing_shipping_address");?>
</span>
        <?php }?>
        <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_hook(array('name'=>"checkout:step_two_edit_link_title"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

    </h3>

    <div id="step_two_body" class="ty-step__body<?php if ($_smarty_tpl->tpl_vars['edit']->value) {?>-active<?php }
if (!$_smarty_tpl->tpl_vars['edit']->value) {?> hidden<?php }?> cm-skip-save-fields">
        <form name="step_two_billing_address" class="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['ajax_form']->value, ENT_QUOTES, 'UTF-8');?>
 cm-ajax-full-render <?php if ($_smarty_tpl->tpl_vars['final_step']->value=="step_two") {?>cm-checkout-recalculate-form<?php }?>" action="<?php echo htmlspecialchars(fn_url(''), ENT_QUOTES, 'UTF-8');?>
" method="<?php if (!$_smarty_tpl->tpl_vars['edit']->value) {?>get<?php } else { ?>post<?php }?>">
            <input type="hidden" name="update_step" value="step_two" />
            <input type="hidden" name="next_step" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['next_step']->value, ENT_QUOTES, 'UTF-8');?>
" />
            <input type="hidden" name="result_ids" value="checkout*,account*" />
            <input type="hidden" name="dispatch" value="checkout.checkout" />

            <?php if ($_REQUEST['profile']=="new") {?>
                <?php $_smarty_tpl->tpl_vars["hide_profile_name"] = new Smarty_variable(false, null, 0);?>
            <?php } else { ?>
                <?php $_smarty_tpl->tpl_vars["hide_profile_name"] = new Smarty_variable(true, null, 0);?>
            <?php }?>
            
            <?php if ($_smarty_tpl->tpl_vars['edit']->value) {?>
                <div class="clearfix">
                    <div class="checkout__block">
                        <?php echo $_smarty_tpl->getSubTemplate ("views/profiles/components/multiple_profiles.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('show_text'=>true,'hide_profile_name'=>$_smarty_tpl->tpl_vars['hide_profile_name']->value,'hide_profile_delete'=>true,'profile_id'=>$_smarty_tpl->tpl_vars['cart']->value['profile_id'],'create_href'=>"checkout.checkout?edit_step=step_two&from_step=".((string)$_smarty_tpl->tpl_vars['cart']->value).".edit_step&profile=new"), 0);?>

                    </div>
                </div>
            <?php }?>
            
            <?php if ($_smarty_tpl->tpl_vars['settings']->value['Checkout']['address_position']=="billing_first") {?>
                <?php $_smarty_tpl->tpl_vars["first_section"] = new Smarty_variable("B", null, 0);?>
                <?php $_smarty_tpl->tpl_vars["first_section_text"] = new Smarty_variable($_smarty_tpl->__("billing_address"), null, 0);?>
                <?php $_smarty_tpl->tpl_vars["sec_section"] = new Smarty_variable("S", null, 0);?>
                <?php $_smarty_tpl->tpl_vars["sec_section_text"] = new Smarty_variable($_smarty_tpl->__("shipping_address"), null, 0);?>
                <?php $_smarty_tpl->tpl_vars["ship_to_another_text"] = new Smarty_variable($_smarty_tpl->__("text_ship_to_billing"), null, 0);?>
                <?php $_smarty_tpl->tpl_vars["body_id"] = new Smarty_variable("sa", null, 0);?>
            <?php } else { ?>
                <?php $_smarty_tpl->tpl_vars["first_section"] = new Smarty_variable("S", null, 0);?>
                <?php $_smarty_tpl->tpl_vars["first_section_text"] = new Smarty_variable($_smarty_tpl->__("shipping_address"), null, 0);?>
                <?php $_smarty_tpl->tpl_vars["sec_section"] = new Smarty_variable("B", null, 0);?>
                <?php $_smarty_tpl->tpl_vars["sec_section_text"] = new Smarty_variable($_smarty_tpl->__("billing_address"), null, 0);?>
                <?php $_smarty_tpl->tpl_vars["ship_to_another_text"] = new Smarty_variable($_smarty_tpl->__("text_billing_same_with_shipping"), null, 0);?>
                <?php $_smarty_tpl->tpl_vars["body_id"] = new Smarty_variable("ba", null, 0);?>
            <?php }?>
            
            <?php if ($_smarty_tpl->tpl_vars['edit']->value) {?>
                <?php if ($_smarty_tpl->tpl_vars['profile_fields']->value[$_smarty_tpl->tpl_vars['first_section']->value]) {?>
                    <div class="clearfix" data-ct-address="billing-address">
                        <div class="checkout__block">
                            <?php echo $_smarty_tpl->getSubTemplate ("views/profiles/components/profile_fields.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('section'=>$_smarty_tpl->tpl_vars['first_section']->value,'body_id'=>'','ship_to_another'=>true,'title'=>$_smarty_tpl->tpl_vars['first_section_text']->value), 0);?>

                        </div>
                    </div>
                <?php }?>

                <?php if ($_smarty_tpl->tpl_vars['profile_fields']->value[$_smarty_tpl->tpl_vars['sec_section']->value]) {?>
                    <div class="clearfix shipping-address__switch" data-ct-address="shipping-address">
                        <?php echo $_smarty_tpl->getSubTemplate ("views/profiles/components/profile_fields.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('section'=>$_smarty_tpl->tpl_vars['sec_section']->value,'body_id'=>$_smarty_tpl->tpl_vars['body_id']->value,'address_flag'=>fn_compare_shipping_billing($_smarty_tpl->tpl_vars['profile_fields']->value),'ship_to_another'=>$_smarty_tpl->tpl_vars['cart']->value['ship_to_another'],'title'=>$_smarty_tpl->tpl_vars['sec_section_text']->value,'grid_wrap'=>"checkout__block"), 0);?>

                    </div>
                <?php }?>

                <?php if ($_smarty_tpl->tpl_vars['final_step']->value=="step_two") {?>
                    <?php echo $_smarty_tpl->getSubTemplate ("views/checkout/components/final_section.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('recalculate'=>true), 0);?>

                <?php } else { ?>
                    <div class="ty-checkout-buttons">
                        <?php echo $_smarty_tpl->getSubTemplate ("buttons/button.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('but_meta'=>"ty-btn__secondary",'but_name'=>"dispatch[checkout.update_steps]",'but_text'=>__("continue")), 0);?>

                    </div>
                <?php }?>
            <?php }?>

        </form>

    </div>

<!--step_two--></div><?php }?><?php }} ?>
