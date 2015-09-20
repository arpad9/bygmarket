<?php /* Smarty version Smarty-3.1.21, created on 2015-09-18 23:18:12
         compiled from "/var/www/bygmarket.com/design/themes/responsive/templates/views/checkout/components/steps/step_one.tpl" */ ?>
<?php /*%%SmartyHeaderCode:30195059455fc71844aa369-56690561%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'dedf41430c5e20d88a3952f3714e607171c7e6e1' => 
    array (
      0 => '/var/www/bygmarket.com/design/themes/responsive/templates/views/checkout/components/steps/step_one.tpl',
      1 => 1442595889,
      2 => 'tygh',
    ),
  ),
  'nocache_hash' => '30195059455fc71844aa369-56690561',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'runtime' => 0,
    'edit' => 0,
    'complete' => 0,
    'number_of_step' => 0,
    'cart' => 0,
    'settings' => 0,
    'auth' => 0,
    'contact_info_population' => 0,
    'user_data' => 0,
    'login_info' => 0,
    'title' => 0,
    'ajax_form' => 0,
    'next_step' => 0,
    'but_text' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21',
  'unifunc' => 'content_55fc7184696287_37156739',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55fc7184696287_37156739')) {function content_55fc7184696287_37156739($_smarty_tpl) {?><?php if (!is_callable('smarty_block_hook')) include '/var/www/bygmarket.com/app/functions/smarty_plugins/block.hook.php';
if (!is_callable('smarty_function_set_id')) include '/var/www/bygmarket.com/app/functions/smarty_plugins/function.set_id.php';
?><?php
fn_preload_lang_vars(array('change','please_sign_in','guest','signed_in_as','register_new_account','register','cancel','sign_in_as_different','change','please_sign_in','guest','signed_in_as','register_new_account','register','cancel','sign_in_as_different'));
?>
<?php if ($_smarty_tpl->tpl_vars['runtime']->value['customization_mode']['design']=="Y"&&@constant('AREA')=="C") {
$_smarty_tpl->_capture_stack[0][] = array("template_content", null, null); ob_start(); ?><div class="ty-step__container<?php if ($_smarty_tpl->tpl_vars['edit']->value) {?>-active<?php }?> ty-step-one" data-ct-checkout="user_info" id="step_one">
    <h3 class="ty-step__title<?php if ($_smarty_tpl->tpl_vars['edit']->value) {?>-active<?php }
if ($_smarty_tpl->tpl_vars['complete']->value&&!$_smarty_tpl->tpl_vars['edit']->value) {?>-complete<?php }?> clearfix">
        <span class="ty-step__title-left"><?php if (!$_smarty_tpl->tpl_vars['complete']->value||$_smarty_tpl->tpl_vars['edit']->value) {
echo htmlspecialchars($_smarty_tpl->tpl_vars['number_of_step']->value, ENT_QUOTES, 'UTF-8');
} else { ?><i class="ty-step__title-icon ty-icon-ok"></i><?php }?></span>
        <i class="ty-step__title-arrow ty-icon-down-micro"></i>

        <?php if ($_smarty_tpl->tpl_vars['complete']->value&&!$_smarty_tpl->tpl_vars['edit']->value) {?>
            <?php $_smarty_tpl->smarty->_tag_stack[] = array('hook', array('name'=>"checkout:step_one_edit_link")); $_block_repeat=true; echo smarty_block_hook(array('name'=>"checkout:step_one_edit_link"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

            <span class="ty-step__title-right">
                <?php echo $_smarty_tpl->getSubTemplate ("buttons/button.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('but_meta'=>"ty-btn__secondary cm-ajax",'but_href'=>"checkout.checkout?edit_step=step_one&from_step=".((string)$_smarty_tpl->tpl_vars['cart']->value['edit_step']),'but_target_id'=>"checkout_*",'but_text'=>__("change"),'but_role'=>"tool"), 0);?>

            </span>
            <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_hook(array('name'=>"checkout:step_one_edit_link"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

        <?php }?>

        <?php if (($_smarty_tpl->tpl_vars['settings']->value['Checkout']['disable_anonymous_checkout']=="Y"&&!$_smarty_tpl->tpl_vars['auth']->value['user_id'])||($_smarty_tpl->tpl_vars['settings']->value['Checkout']['disable_anonymous_checkout']!="Y"&&!$_smarty_tpl->tpl_vars['auth']->value['user_id']&&!$_smarty_tpl->tpl_vars['contact_info_population']->value)||$_SESSION['failed_registration']==true) {?>
            <?php $_smarty_tpl->tpl_vars["title"] = new Smarty_variable($_smarty_tpl->__("please_sign_in"), null, 0);?>
        <?php } else { ?>
            <?php if ($_smarty_tpl->tpl_vars['auth']->value['user_id']!=0) {?>
                <?php if ($_smarty_tpl->tpl_vars['user_data']->value['firstname']||$_smarty_tpl->tpl_vars['user_data']->value['lastname']) {?>
                    <?php $_smarty_tpl->tpl_vars["login_info"] = new Smarty_variable(((string)$_smarty_tpl->tpl_vars['user_data']->value['firstname'])."&nbsp;".((string)$_smarty_tpl->tpl_vars['user_data']->value['lastname']), null, 0);?>
                <?php } else { ?>
                    <?php $_smarty_tpl->tpl_vars["login_info"] = new Smarty_variable(((string)$_smarty_tpl->tpl_vars['user_data']->value['email']), null, 0);?>
                <?php }?>
            <?php } else { ?>
                <?php $_smarty_tpl->tpl_vars["login_info"] = new Smarty_variable($_smarty_tpl->__("guest"), null, 0);?>
            <?php }?>
            
            <?php ob_start();
echo $_smarty_tpl->__("signed_in_as");
$_tmp1=ob_get_clean();?><?php $_smarty_tpl->tpl_vars["title"] = new Smarty_variable($_tmp1." ".((string)$_smarty_tpl->tpl_vars['login_info']->value), null, 0);?>
        <?php }?>
        
        <?php $_smarty_tpl->smarty->_tag_stack[] = array('hook', array('name'=>"checkout:step_one_edit_link_title")); $_block_repeat=true; echo smarty_block_hook(array('name'=>"checkout:step_one_edit_link_title"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

        <?php if ($_smarty_tpl->tpl_vars['contact_info_population']->value&&!$_smarty_tpl->tpl_vars['edit']->value) {?>
            <a class="ty-step__title-txt cm-ajax" href="<?php echo htmlspecialchars(fn_url("checkout.checkout?edit_step=step_one&from_step=".((string)$_smarty_tpl->tpl_vars['cart']->value['edit_step'])), ENT_QUOTES, 'UTF-8');?>
" data-ca-target-id="checkout_*"><?php echo preg_replace('!<[^>]*?>!', ' ', $_smarty_tpl->tpl_vars['title']->value);?>
</a>
        <?php } else { ?>
            <span class="ty-step__title-txt"><?php echo preg_replace('!<[^>]*?>!', ' ', $_smarty_tpl->tpl_vars['title']->value);?>
</span>
        <?php }?>
        <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_hook(array('name'=>"checkout:step_one_edit_link_title"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

    </h3>

    <div id="step_one_body" class="ty-step__body<?php if ($_smarty_tpl->tpl_vars['edit']->value) {?>-active<?php }
if (!$_smarty_tpl->tpl_vars['edit']->value) {?> hidden<?php }?>">
        <?php if (($_smarty_tpl->tpl_vars['settings']->value['Checkout']['disable_anonymous_checkout']=="Y"&&!$_smarty_tpl->tpl_vars['auth']->value['user_id'])||($_smarty_tpl->tpl_vars['settings']->value['Checkout']['disable_anonymous_checkout']!="Y"&&!$_smarty_tpl->tpl_vars['auth']->value['user_id']&&!$_smarty_tpl->tpl_vars['contact_info_population']->value)||$_SESSION['failed_registration']==true) {?>
            <div id="step_one_login" <?php if ($_REQUEST['login_type']=="register") {?>class="hidden"<?php }?>>
                <div class="clearfix">
                    <?php echo $_smarty_tpl->getSubTemplate ("views/checkout/components/checkout_login.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('checkout_type'=>"one_page"), 0);?>

                </div>
            </div>
            <div id="step_one_register" class="clearfix<?php if ($_REQUEST['login_type']!="register") {?> hidden<?php }?>">
                <form name="step_one_register_form" class="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['ajax_form']->value, ENT_QUOTES, 'UTF-8');?>
 cm-ajax-full-render" action="<?php echo htmlspecialchars(fn_url(''), ENT_QUOTES, 'UTF-8');?>
" method="post">
                    <input type="hidden" name="result_ids" value="checkout*,account*" />
                    <input type="hidden" name="return_to" value="checkout" />
                    <input type="hidden" name="user_data[register_at_checkout]" value="Y" />
                    <div class="checkout__block">
                        <?php echo $_smarty_tpl->getSubTemplate ("common/subheader.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('title'=>__("register_new_account")), 0);?>

                        <?php echo $_smarty_tpl->getSubTemplate ("views/profiles/components/profiles_account.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('nothing_extra'=>"Y",'location'=>"checkout"), 0);?>

                        <?php echo $_smarty_tpl->getSubTemplate ("views/profiles/components/profile_fields.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('section'=>"C",'nothing_extra'=>"Y"), 0);?>

            
                        <?php $_smarty_tpl->smarty->_tag_stack[] = array('hook', array('name'=>"checkout:checkout_steps")); $_block_repeat=true; echo smarty_block_hook(array('name'=>"checkout:checkout_steps"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();
$_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_hook(array('name'=>"checkout:checkout_steps"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

                        
                        <?php echo $_smarty_tpl->getSubTemplate ("common/image_verification.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('option'=>"register"), 0);?>

                        
                        <div class="clearfix"></div>
                    </div>
                    <div class="ty-checkout-buttons clearfix">
                        <?php echo $_smarty_tpl->getSubTemplate ("buttons/button.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('but_meta'=>"ty-btn__secondary",'but_name'=>"dispatch[checkout.add_profile]",'but_text'=>__("register")), 0);?>

                        <?php echo $_smarty_tpl->getSubTemplate ("buttons/button.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('but_onclick'=>"Tygh."."$"."('#step_one_register').hide(); Tygh."."$"."('#step_one_login').show();",'but_text'=>__("cancel"),'but_role'=>"text",'but_meta'=>"ty-checkout__register-cancel"), 0);?>
 
                    </div>
                </form>
            </div>
        <?php } else { ?>
            <form name="step_one_contact_information_form" class="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['ajax_form']->value, ENT_QUOTES, 'UTF-8');?>
" action="<?php echo htmlspecialchars(fn_url(''), ENT_QUOTES, 'UTF-8');?>
" method="<?php if (!$_smarty_tpl->tpl_vars['edit']->value) {?>get<?php } else { ?>post<?php }?>">
                <input type="hidden" name="update_step" value="step_one" />
                <input type="hidden" name="next_step" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['next_step']->value, ENT_QUOTES, 'UTF-8');?>
" />
                <input type="hidden" name="result_ids" value="checkout*" />
                <?php if ($_smarty_tpl->tpl_vars['edit']->value) {?>
                    <div class="clearfix">
                        <div class="checkout__block">
                            <?php echo $_smarty_tpl->getSubTemplate ("views/profiles/components/profile_fields.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('section'=>"C",'nothing_extra'=>"Y",'email_extra'=>Smarty::$_smarty_vars['capture']['email_extra']), 0);?>

                            <a href="<?php echo htmlspecialchars(fn_url("auth.change_login"), ENT_QUOTES, 'UTF-8');?>
" class="ty-checkout__relogin"><?php echo $_smarty_tpl->__("sign_in_as_different");?>
</a>
                        </div>
                    </div>
                    <?php $_smarty_tpl->smarty->_tag_stack[] = array('hook', array('name'=>"checkout:checkout_steps")); $_block_repeat=true; echo smarty_block_hook(array('name'=>"checkout:checkout_steps"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

                        <div class="ty-checkout-buttons">
                            <?php echo $_smarty_tpl->getSubTemplate ("buttons/button.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('but_meta'=>"ty-btn__secondary",'but_name'=>"dispatch[checkout.update_steps]",'but_text'=>$_smarty_tpl->tpl_vars['but_text']->value), 0);?>

                        </div>
                    <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_hook(array('name'=>"checkout:checkout_steps"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

                <?php }?>
            </form>
        <?php }?>

    </div>
<!--step_one--></div><?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();
if (trim(Smarty::$_smarty_vars['capture']['template_content'])) {
if ($_smarty_tpl->tpl_vars['auth']->value['area']=="A") {?><span class="cm-template-box template-box" data-ca-te-template="views/checkout/components/steps/step_one.tpl" id="<?php echo smarty_function_set_id(array('name'=>"views/checkout/components/steps/step_one.tpl"),$_smarty_tpl);?>
"><div class="cm-template-icon icon-edit ty-icon-edit hidden"></div><?php echo Smarty::$_smarty_vars['capture']['template_content'];?>
<!--[/tpl_id]--></span><?php } else {
echo Smarty::$_smarty_vars['capture']['template_content'];
}
}
} else { ?><div class="ty-step__container<?php if ($_smarty_tpl->tpl_vars['edit']->value) {?>-active<?php }?> ty-step-one" data-ct-checkout="user_info" id="step_one">
    <h3 class="ty-step__title<?php if ($_smarty_tpl->tpl_vars['edit']->value) {?>-active<?php }
if ($_smarty_tpl->tpl_vars['complete']->value&&!$_smarty_tpl->tpl_vars['edit']->value) {?>-complete<?php }?> clearfix">
        <span class="ty-step__title-left"><?php if (!$_smarty_tpl->tpl_vars['complete']->value||$_smarty_tpl->tpl_vars['edit']->value) {
echo htmlspecialchars($_smarty_tpl->tpl_vars['number_of_step']->value, ENT_QUOTES, 'UTF-8');
} else { ?><i class="ty-step__title-icon ty-icon-ok"></i><?php }?></span>
        <i class="ty-step__title-arrow ty-icon-down-micro"></i>

        <?php if ($_smarty_tpl->tpl_vars['complete']->value&&!$_smarty_tpl->tpl_vars['edit']->value) {?>
            <?php $_smarty_tpl->smarty->_tag_stack[] = array('hook', array('name'=>"checkout:step_one_edit_link")); $_block_repeat=true; echo smarty_block_hook(array('name'=>"checkout:step_one_edit_link"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

            <span class="ty-step__title-right">
                <?php echo $_smarty_tpl->getSubTemplate ("buttons/button.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('but_meta'=>"ty-btn__secondary cm-ajax",'but_href'=>"checkout.checkout?edit_step=step_one&from_step=".((string)$_smarty_tpl->tpl_vars['cart']->value['edit_step']),'but_target_id'=>"checkout_*",'but_text'=>__("change"),'but_role'=>"tool"), 0);?>

            </span>
            <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_hook(array('name'=>"checkout:step_one_edit_link"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

        <?php }?>

        <?php if (($_smarty_tpl->tpl_vars['settings']->value['Checkout']['disable_anonymous_checkout']=="Y"&&!$_smarty_tpl->tpl_vars['auth']->value['user_id'])||($_smarty_tpl->tpl_vars['settings']->value['Checkout']['disable_anonymous_checkout']!="Y"&&!$_smarty_tpl->tpl_vars['auth']->value['user_id']&&!$_smarty_tpl->tpl_vars['contact_info_population']->value)||$_SESSION['failed_registration']==true) {?>
            <?php $_smarty_tpl->tpl_vars["title"] = new Smarty_variable($_smarty_tpl->__("please_sign_in"), null, 0);?>
        <?php } else { ?>
            <?php if ($_smarty_tpl->tpl_vars['auth']->value['user_id']!=0) {?>
                <?php if ($_smarty_tpl->tpl_vars['user_data']->value['firstname']||$_smarty_tpl->tpl_vars['user_data']->value['lastname']) {?>
                    <?php $_smarty_tpl->tpl_vars["login_info"] = new Smarty_variable(((string)$_smarty_tpl->tpl_vars['user_data']->value['firstname'])."&nbsp;".((string)$_smarty_tpl->tpl_vars['user_data']->value['lastname']), null, 0);?>
                <?php } else { ?>
                    <?php $_smarty_tpl->tpl_vars["login_info"] = new Smarty_variable(((string)$_smarty_tpl->tpl_vars['user_data']->value['email']), null, 0);?>
                <?php }?>
            <?php } else { ?>
                <?php $_smarty_tpl->tpl_vars["login_info"] = new Smarty_variable($_smarty_tpl->__("guest"), null, 0);?>
            <?php }?>
            
            <?php ob_start();
echo $_smarty_tpl->__("signed_in_as");
$_tmp2=ob_get_clean();?><?php $_smarty_tpl->tpl_vars["title"] = new Smarty_variable($_tmp2." ".((string)$_smarty_tpl->tpl_vars['login_info']->value), null, 0);?>
        <?php }?>
        
        <?php $_smarty_tpl->smarty->_tag_stack[] = array('hook', array('name'=>"checkout:step_one_edit_link_title")); $_block_repeat=true; echo smarty_block_hook(array('name'=>"checkout:step_one_edit_link_title"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

        <?php if ($_smarty_tpl->tpl_vars['contact_info_population']->value&&!$_smarty_tpl->tpl_vars['edit']->value) {?>
            <a class="ty-step__title-txt cm-ajax" href="<?php echo htmlspecialchars(fn_url("checkout.checkout?edit_step=step_one&from_step=".((string)$_smarty_tpl->tpl_vars['cart']->value['edit_step'])), ENT_QUOTES, 'UTF-8');?>
" data-ca-target-id="checkout_*"><?php echo preg_replace('!<[^>]*?>!', ' ', $_smarty_tpl->tpl_vars['title']->value);?>
</a>
        <?php } else { ?>
            <span class="ty-step__title-txt"><?php echo preg_replace('!<[^>]*?>!', ' ', $_smarty_tpl->tpl_vars['title']->value);?>
</span>
        <?php }?>
        <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_hook(array('name'=>"checkout:step_one_edit_link_title"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

    </h3>

    <div id="step_one_body" class="ty-step__body<?php if ($_smarty_tpl->tpl_vars['edit']->value) {?>-active<?php }
if (!$_smarty_tpl->tpl_vars['edit']->value) {?> hidden<?php }?>">
        <?php if (($_smarty_tpl->tpl_vars['settings']->value['Checkout']['disable_anonymous_checkout']=="Y"&&!$_smarty_tpl->tpl_vars['auth']->value['user_id'])||($_smarty_tpl->tpl_vars['settings']->value['Checkout']['disable_anonymous_checkout']!="Y"&&!$_smarty_tpl->tpl_vars['auth']->value['user_id']&&!$_smarty_tpl->tpl_vars['contact_info_population']->value)||$_SESSION['failed_registration']==true) {?>
            <div id="step_one_login" <?php if ($_REQUEST['login_type']=="register") {?>class="hidden"<?php }?>>
                <div class="clearfix">
                    <?php echo $_smarty_tpl->getSubTemplate ("views/checkout/components/checkout_login.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('checkout_type'=>"one_page"), 0);?>

                </div>
            </div>
            <div id="step_one_register" class="clearfix<?php if ($_REQUEST['login_type']!="register") {?> hidden<?php }?>">
                <form name="step_one_register_form" class="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['ajax_form']->value, ENT_QUOTES, 'UTF-8');?>
 cm-ajax-full-render" action="<?php echo htmlspecialchars(fn_url(''), ENT_QUOTES, 'UTF-8');?>
" method="post">
                    <input type="hidden" name="result_ids" value="checkout*,account*" />
                    <input type="hidden" name="return_to" value="checkout" />
                    <input type="hidden" name="user_data[register_at_checkout]" value="Y" />
                    <div class="checkout__block">
                        <?php echo $_smarty_tpl->getSubTemplate ("common/subheader.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('title'=>__("register_new_account")), 0);?>

                        <?php echo $_smarty_tpl->getSubTemplate ("views/profiles/components/profiles_account.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('nothing_extra'=>"Y",'location'=>"checkout"), 0);?>

                        <?php echo $_smarty_tpl->getSubTemplate ("views/profiles/components/profile_fields.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('section'=>"C",'nothing_extra'=>"Y"), 0);?>

            
                        <?php $_smarty_tpl->smarty->_tag_stack[] = array('hook', array('name'=>"checkout:checkout_steps")); $_block_repeat=true; echo smarty_block_hook(array('name'=>"checkout:checkout_steps"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();
$_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_hook(array('name'=>"checkout:checkout_steps"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

                        
                        <?php echo $_smarty_tpl->getSubTemplate ("common/image_verification.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('option'=>"register"), 0);?>

                        
                        <div class="clearfix"></div>
                    </div>
                    <div class="ty-checkout-buttons clearfix">
                        <?php echo $_smarty_tpl->getSubTemplate ("buttons/button.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('but_meta'=>"ty-btn__secondary",'but_name'=>"dispatch[checkout.add_profile]",'but_text'=>__("register")), 0);?>

                        <?php echo $_smarty_tpl->getSubTemplate ("buttons/button.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('but_onclick'=>"Tygh."."$"."('#step_one_register').hide(); Tygh."."$"."('#step_one_login').show();",'but_text'=>__("cancel"),'but_role'=>"text",'but_meta'=>"ty-checkout__register-cancel"), 0);?>
 
                    </div>
                </form>
            </div>
        <?php } else { ?>
            <form name="step_one_contact_information_form" class="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['ajax_form']->value, ENT_QUOTES, 'UTF-8');?>
" action="<?php echo htmlspecialchars(fn_url(''), ENT_QUOTES, 'UTF-8');?>
" method="<?php if (!$_smarty_tpl->tpl_vars['edit']->value) {?>get<?php } else { ?>post<?php }?>">
                <input type="hidden" name="update_step" value="step_one" />
                <input type="hidden" name="next_step" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['next_step']->value, ENT_QUOTES, 'UTF-8');?>
" />
                <input type="hidden" name="result_ids" value="checkout*" />
                <?php if ($_smarty_tpl->tpl_vars['edit']->value) {?>
                    <div class="clearfix">
                        <div class="checkout__block">
                            <?php echo $_smarty_tpl->getSubTemplate ("views/profiles/components/profile_fields.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('section'=>"C",'nothing_extra'=>"Y",'email_extra'=>Smarty::$_smarty_vars['capture']['email_extra']), 0);?>

                            <a href="<?php echo htmlspecialchars(fn_url("auth.change_login"), ENT_QUOTES, 'UTF-8');?>
" class="ty-checkout__relogin"><?php echo $_smarty_tpl->__("sign_in_as_different");?>
</a>
                        </div>
                    </div>
                    <?php $_smarty_tpl->smarty->_tag_stack[] = array('hook', array('name'=>"checkout:checkout_steps")); $_block_repeat=true; echo smarty_block_hook(array('name'=>"checkout:checkout_steps"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

                        <div class="ty-checkout-buttons">
                            <?php echo $_smarty_tpl->getSubTemplate ("buttons/button.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('but_meta'=>"ty-btn__secondary",'but_name'=>"dispatch[checkout.update_steps]",'but_text'=>$_smarty_tpl->tpl_vars['but_text']->value), 0);?>

                        </div>
                    <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_hook(array('name'=>"checkout:checkout_steps"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

                <?php }?>
            </form>
        <?php }?>

    </div>
<!--step_one--></div><?php }?><?php }} ?>
