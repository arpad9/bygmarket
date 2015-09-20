<?php /* Smarty version Smarty-3.1.21, created on 2015-09-18 23:18:12
         compiled from "/var/www/bygmarket.com/design/themes/responsive/templates/views/checkout/components/checkout_login.tpl" */ ?>
<?php /*%%SmartyHeaderCode:118787184355fc71846ebb64-24799259%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0040babd1164f3e8c5cd7cc06f9021dc52a6dda6' => 
    array (
      0 => '/var/www/bygmarket.com/design/themes/responsive/templates/views/checkout/components/checkout_login.tpl',
      1 => 1442595889,
      2 => 'tygh',
    ),
  ),
  'nocache_hash' => '118787184355fc71846ebb64-24799259',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'runtime' => 0,
    'settings' => 0,
    'ajax_form' => 0,
    'contact_fields_filled' => 0,
    'auth' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21',
  'unifunc' => 'content_55fc718485bf16_88415355',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55fc718485bf16_88415355')) {function content_55fc718485bf16_88415355($_smarty_tpl) {?><?php if (!is_callable('smarty_block_hook')) include '/var/www/bygmarket.com/app/functions/smarty_plugins/block.hook.php';
if (!is_callable('smarty_function_set_id')) include '/var/www/bygmarket.com/app/functions/smarty_plugins/function.set_id.php';
?><?php
fn_preload_lang_vars(array('register','email','checkout_as_guest','new_customer','register','create_new_account','checkout_as_guest','create_guest_account','register','email','checkout_as_guest','new_customer','register','create_new_account','checkout_as_guest','create_guest_account'));
?>
<?php if ($_smarty_tpl->tpl_vars['runtime']->value['customization_mode']['design']=="Y"&&@constant('AREA')=="C") {
$_smarty_tpl->_capture_stack[0][] = array("template_content", null, null); ob_start();
$_smarty_tpl->_capture_stack[0][] = array("checkout_sign_in_login", null, null); ob_start(); ?>
<?php $_smarty_tpl->smarty->_tag_stack[] = array('hook', array('name'=>"checkout:login_form")); $_block_repeat=true; echo smarty_block_hook(array('name'=>"checkout:login_form"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

    <div class="ty-checkout__login">
        <?php echo $_smarty_tpl->getSubTemplate ("views/auth/login_form.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('id'=>"checkout_login",'style'=>"checkout",'result_ids'=>"checkout*,account*"), 0);?>

    </div>
<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_hook(array('name'=>"checkout:login_form"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

<?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>

<?php $_smarty_tpl->_capture_stack[0][] = array("checkout_sign_in_register", null, null); ob_start(); ?>
<?php $_smarty_tpl->smarty->_tag_stack[] = array('hook', array('name'=>"checkout:register_customer")); $_block_repeat=true; echo smarty_block_hook(array('name'=>"checkout:register_customer"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

    <div class="ty-checkout__register checkout-register">
        <?php $_smarty_tpl->_capture_stack[0][] = array("register", null, null); ob_start(); ?>
            <?php if ($_smarty_tpl->tpl_vars['settings']->value['General']['approve_user_profiles']!="Y") {?>
                <div id="register_checkout" class="ty-checkout-buttons<?php if ($_smarty_tpl->tpl_vars['settings']->value['Checkout']['sign_in_default_action']!="register") {?> cm-noscript<?php }?>">
                    <?php echo $_smarty_tpl->getSubTemplate ("buttons/button.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('but_onclick'=>"fn_switch_checkout_type();Tygh."."$"."('.cm-focus').focus();",'but_meta'=>"ty-btn__primary",'but_text'=>__("register")), 0);?>

                </div>
            <?php }?>
        <?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>
        
        <?php $_smarty_tpl->_capture_stack[0][] = array("anonymous", null, null); ob_start(); ?>
            <?php if ($_smarty_tpl->tpl_vars['settings']->value['Checkout']['disable_anonymous_checkout']!="Y") {?>
                <div id="anonymous_checkout" class="<?php if ($_smarty_tpl->tpl_vars['settings']->value['Checkout']['sign_in_default_action']=="register") {?> cm-noscript<?php }?>">
                    <form name="step_one_anonymous_checkout_form" class="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['ajax_form']->value, ENT_QUOTES, 'UTF-8');?>
" action="<?php echo htmlspecialchars(fn_url(''), ENT_QUOTES, 'UTF-8');?>
" method="post">
                        <input type="hidden" name="result_ids" value="checkout*,account*" />
                        <input type="hidden" name="guest_checkout" value="1" />

                        <?php if (!$_smarty_tpl->tpl_vars['contact_fields_filled']->value) {?>
                            <div class="ty-control-group ty-anonymous_checkout__field">
                                <label for="guest_email" class="cm-required"><?php echo $_smarty_tpl->__("email");?>
</label>
                                <input type="text" id="guest_email" name="user_data[email]" size="32" value="" class="ty-input-text" />
                            </div>
                        <?php }?>

                        <div class="ty-checkout-buttons">
                            <?php echo $_smarty_tpl->getSubTemplate ("buttons/button.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('but_meta'=>"ty-btn__primary",'but_name'=>"dispatch[checkout.customer_info]",'but_text'=>__("checkout_as_guest")), 0);?>

                        </div>
                    </form>
                </div>
            <?php }?>
        <?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>

        <div class="ty-checkout__register-content">
            <?php if ($_smarty_tpl->tpl_vars['settings']->value['General']['approve_user_profiles']!="Y"||$_smarty_tpl->tpl_vars['settings']->value['Checkout']['disable_anonymous_checkout']!="Y") {?>
                <?php echo $_smarty_tpl->getSubTemplate ("common/subheader.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('title'=>__("new_customer")), 0);?>

            <?php }?>

            <ul class="ty-checkout__register-methods">
                <?php $_smarty_tpl->_capture_stack[0][] = array("checkout_new_customer_register", null, null); ob_start(); ?>
                <li class="ty-checkout__register-methods-item">
                    <input class="ty-checkout__register-methods-radio" type="radio" id="checkout_type_register" name="checkout_type" value=""<?php if ($_smarty_tpl->tpl_vars['settings']->value['Checkout']['sign_in_default_action']=="register") {?> checked="checked"<?php }?> onclick="fn_show_checkout_buttons('register')" />
                    <label for="checkout_type_register">
                        <span class="ty-checkout__register-methods-title"><?php echo $_smarty_tpl->__("register");?>
</span>
                        <span class="ty-checkout__register-methods-hint"><?php echo $_smarty_tpl->__("create_new_account");?>
</span>
                    </label>
                </li>
                <?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>

                <?php $_smarty_tpl->_capture_stack[0][] = array("checkout_new_customer_guest", null, null); ob_start(); ?>
                <?php if ($_smarty_tpl->tpl_vars['settings']->value['Checkout']['disable_anonymous_checkout']!="Y") {?>
                    <li class="ty-checkout__register-methods-item">
                        <input class="ty-checkout__register-methods-radio" type="radio" id="checkout_type_guest" name="checkout_type" value=""<?php if ($_smarty_tpl->tpl_vars['settings']->value['Checkout']['sign_in_default_action']!="register") {?> checked="checked"<?php }?> onclick="fn_show_checkout_buttons('guest')" />
                        <label for="checkout_type_guest">
                            <span class="ty-checkout__register-methods-title"><?php echo $_smarty_tpl->__("checkout_as_guest");?>
</span>
                            <span class="ty-checkout__register-methods-hint"><?php echo $_smarty_tpl->__("create_guest_account");?>
</span>
                        </label>
                    </li>
                <?php }?>
                <?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>

                <?php if ($_smarty_tpl->tpl_vars['settings']->value['Checkout']['sign_in_default_action']=="register") {?>
                    <?php echo Smarty::$_smarty_vars['capture']['checkout_new_customer_register'];?>

                    <?php echo Smarty::$_smarty_vars['capture']['checkout_new_customer_guest'];?>

                <?php } else { ?>
                    <?php echo Smarty::$_smarty_vars['capture']['checkout_new_customer_guest'];?>

                    <?php echo Smarty::$_smarty_vars['capture']['checkout_new_customer_register'];?>

                <?php }?>
            </ul>
        </div>

        <?php echo Smarty::$_smarty_vars['capture']['register'];?>

        <?php echo Smarty::$_smarty_vars['capture']['anonymous'];?>

    </div>
<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_hook(array('name'=>"checkout:register_customer"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

<?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>

<?php if ($_smarty_tpl->tpl_vars['settings']->value['Checkout']['configure_sign_in_step']=="returning_customer_first") {?>
    <?php echo Smarty::$_smarty_vars['capture']['checkout_sign_in_login'];?>

    <?php echo Smarty::$_smarty_vars['capture']['checkout_sign_in_register'];?>

<?php } else { ?>
    <?php echo Smarty::$_smarty_vars['capture']['checkout_sign_in_register'];?>

    <?php echo Smarty::$_smarty_vars['capture']['checkout_sign_in_login'];?>

<?php }?>
<?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();
if (trim(Smarty::$_smarty_vars['capture']['template_content'])) {
if ($_smarty_tpl->tpl_vars['auth']->value['area']=="A") {?><span class="cm-template-box template-box" data-ca-te-template="views/checkout/components/checkout_login.tpl" id="<?php echo smarty_function_set_id(array('name'=>"views/checkout/components/checkout_login.tpl"),$_smarty_tpl);?>
"><div class="cm-template-icon icon-edit ty-icon-edit hidden"></div><?php echo Smarty::$_smarty_vars['capture']['template_content'];?>
<!--[/tpl_id]--></span><?php } else {
echo Smarty::$_smarty_vars['capture']['template_content'];
}
}
} else {
$_smarty_tpl->_capture_stack[0][] = array("checkout_sign_in_login", null, null); ob_start(); ?>
<?php $_smarty_tpl->smarty->_tag_stack[] = array('hook', array('name'=>"checkout:login_form")); $_block_repeat=true; echo smarty_block_hook(array('name'=>"checkout:login_form"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

    <div class="ty-checkout__login">
        <?php echo $_smarty_tpl->getSubTemplate ("views/auth/login_form.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('id'=>"checkout_login",'style'=>"checkout",'result_ids'=>"checkout*,account*"), 0);?>

    </div>
<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_hook(array('name'=>"checkout:login_form"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

<?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>

<?php $_smarty_tpl->_capture_stack[0][] = array("checkout_sign_in_register", null, null); ob_start(); ?>
<?php $_smarty_tpl->smarty->_tag_stack[] = array('hook', array('name'=>"checkout:register_customer")); $_block_repeat=true; echo smarty_block_hook(array('name'=>"checkout:register_customer"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

    <div class="ty-checkout__register checkout-register">
        <?php $_smarty_tpl->_capture_stack[0][] = array("register", null, null); ob_start(); ?>
            <?php if ($_smarty_tpl->tpl_vars['settings']->value['General']['approve_user_profiles']!="Y") {?>
                <div id="register_checkout" class="ty-checkout-buttons<?php if ($_smarty_tpl->tpl_vars['settings']->value['Checkout']['sign_in_default_action']!="register") {?> cm-noscript<?php }?>">
                    <?php echo $_smarty_tpl->getSubTemplate ("buttons/button.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('but_onclick'=>"fn_switch_checkout_type();Tygh."."$"."('.cm-focus').focus();",'but_meta'=>"ty-btn__primary",'but_text'=>__("register")), 0);?>

                </div>
            <?php }?>
        <?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>
        
        <?php $_smarty_tpl->_capture_stack[0][] = array("anonymous", null, null); ob_start(); ?>
            <?php if ($_smarty_tpl->tpl_vars['settings']->value['Checkout']['disable_anonymous_checkout']!="Y") {?>
                <div id="anonymous_checkout" class="<?php if ($_smarty_tpl->tpl_vars['settings']->value['Checkout']['sign_in_default_action']=="register") {?> cm-noscript<?php }?>">
                    <form name="step_one_anonymous_checkout_form" class="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['ajax_form']->value, ENT_QUOTES, 'UTF-8');?>
" action="<?php echo htmlspecialchars(fn_url(''), ENT_QUOTES, 'UTF-8');?>
" method="post">
                        <input type="hidden" name="result_ids" value="checkout*,account*" />
                        <input type="hidden" name="guest_checkout" value="1" />

                        <?php if (!$_smarty_tpl->tpl_vars['contact_fields_filled']->value) {?>
                            <div class="ty-control-group ty-anonymous_checkout__field">
                                <label for="guest_email" class="cm-required"><?php echo $_smarty_tpl->__("email");?>
</label>
                                <input type="text" id="guest_email" name="user_data[email]" size="32" value="" class="ty-input-text" />
                            </div>
                        <?php }?>

                        <div class="ty-checkout-buttons">
                            <?php echo $_smarty_tpl->getSubTemplate ("buttons/button.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('but_meta'=>"ty-btn__primary",'but_name'=>"dispatch[checkout.customer_info]",'but_text'=>__("checkout_as_guest")), 0);?>

                        </div>
                    </form>
                </div>
            <?php }?>
        <?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>

        <div class="ty-checkout__register-content">
            <?php if ($_smarty_tpl->tpl_vars['settings']->value['General']['approve_user_profiles']!="Y"||$_smarty_tpl->tpl_vars['settings']->value['Checkout']['disable_anonymous_checkout']!="Y") {?>
                <?php echo $_smarty_tpl->getSubTemplate ("common/subheader.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('title'=>__("new_customer")), 0);?>

            <?php }?>

            <ul class="ty-checkout__register-methods">
                <?php $_smarty_tpl->_capture_stack[0][] = array("checkout_new_customer_register", null, null); ob_start(); ?>
                <li class="ty-checkout__register-methods-item">
                    <input class="ty-checkout__register-methods-radio" type="radio" id="checkout_type_register" name="checkout_type" value=""<?php if ($_smarty_tpl->tpl_vars['settings']->value['Checkout']['sign_in_default_action']=="register") {?> checked="checked"<?php }?> onclick="fn_show_checkout_buttons('register')" />
                    <label for="checkout_type_register">
                        <span class="ty-checkout__register-methods-title"><?php echo $_smarty_tpl->__("register");?>
</span>
                        <span class="ty-checkout__register-methods-hint"><?php echo $_smarty_tpl->__("create_new_account");?>
</span>
                    </label>
                </li>
                <?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>

                <?php $_smarty_tpl->_capture_stack[0][] = array("checkout_new_customer_guest", null, null); ob_start(); ?>
                <?php if ($_smarty_tpl->tpl_vars['settings']->value['Checkout']['disable_anonymous_checkout']!="Y") {?>
                    <li class="ty-checkout__register-methods-item">
                        <input class="ty-checkout__register-methods-radio" type="radio" id="checkout_type_guest" name="checkout_type" value=""<?php if ($_smarty_tpl->tpl_vars['settings']->value['Checkout']['sign_in_default_action']!="register") {?> checked="checked"<?php }?> onclick="fn_show_checkout_buttons('guest')" />
                        <label for="checkout_type_guest">
                            <span class="ty-checkout__register-methods-title"><?php echo $_smarty_tpl->__("checkout_as_guest");?>
</span>
                            <span class="ty-checkout__register-methods-hint"><?php echo $_smarty_tpl->__("create_guest_account");?>
</span>
                        </label>
                    </li>
                <?php }?>
                <?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>

                <?php if ($_smarty_tpl->tpl_vars['settings']->value['Checkout']['sign_in_default_action']=="register") {?>
                    <?php echo Smarty::$_smarty_vars['capture']['checkout_new_customer_register'];?>

                    <?php echo Smarty::$_smarty_vars['capture']['checkout_new_customer_guest'];?>

                <?php } else { ?>
                    <?php echo Smarty::$_smarty_vars['capture']['checkout_new_customer_guest'];?>

                    <?php echo Smarty::$_smarty_vars['capture']['checkout_new_customer_register'];?>

                <?php }?>
            </ul>
        </div>

        <?php echo Smarty::$_smarty_vars['capture']['register'];?>

        <?php echo Smarty::$_smarty_vars['capture']['anonymous'];?>

    </div>
<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_hook(array('name'=>"checkout:register_customer"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

<?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>

<?php if ($_smarty_tpl->tpl_vars['settings']->value['Checkout']['configure_sign_in_step']=="returning_customer_first") {?>
    <?php echo Smarty::$_smarty_vars['capture']['checkout_sign_in_login'];?>

    <?php echo Smarty::$_smarty_vars['capture']['checkout_sign_in_register'];?>

<?php } else { ?>
    <?php echo Smarty::$_smarty_vars['capture']['checkout_sign_in_register'];?>

    <?php echo Smarty::$_smarty_vars['capture']['checkout_sign_in_login'];?>

<?php }?>
<?php }?><?php }} ?>
