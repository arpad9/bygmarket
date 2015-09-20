<?php /* Smarty version Smarty-3.1.21, created on 2015-09-18 21:29:03
         compiled from "/var/www/bygmarket.com/design/themes/responsive/templates/views/profiles/update.tpl" */ ?>
<?php /*%%SmartyHeaderCode:53855815455fc57efbd0a85-73731884%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '124b4b5af5ea68a39706cd8cfd4609bed0ccb910' => 
    array (
      0 => '/var/www/bygmarket.com/design/themes/responsive/templates/views/profiles/update.tpl',
      1 => 1442595889,
      2 => 'tygh',
    ),
  ),
  'nocache_hash' => '53855815455fc57efbd0a85-73731884',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'runtime' => 0,
    'settings' => 0,
    'image_verification' => 0,
    'user_data' => 0,
    'profile_fields' => 0,
    'first_section' => 0,
    'first_section_text' => 0,
    'sec_section' => 0,
    'body_id' => 0,
    'sec_section_text' => 0,
    'ship_to_another' => 0,
    'usergroups' => 0,
    'usergroup' => 0,
    'ug_status' => 0,
    '_req_type' => 0,
    '_link_text' => 0,
    'auth' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21',
  'unifunc' => 'content_55fc57f0057080_82038641',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55fc57f0057080_82038641')) {function content_55fc57f0057080_82038641($_smarty_tpl) {?><?php if (!is_callable('smarty_block_hook')) include '/var/www/bygmarket.com/app/functions/smarty_plugins/block.hook.php';
if (!is_callable('smarty_function_set_id')) include '/var/www/bygmarket.com/app/functions/smarty_plugins/function.set_id.php';
?><?php
fn_preload_lang_vars(array('register_new_account','contact_information','text_multiprofile_notice','billing_address','shipping_address','shipping_address','billing_address','revert','usergroup','status','action','active','remove','available','join','declined','join','pending','cancel','profile_details','register_new_account','contact_information','text_multiprofile_notice','billing_address','shipping_address','shipping_address','billing_address','revert','usergroup','status','action','active','remove','available','join','declined','join','pending','cancel','profile_details'));
?>
<?php if ($_smarty_tpl->tpl_vars['runtime']->value['customization_mode']['design']=="Y"&&@constant('AREA')=="C") {
$_smarty_tpl->_capture_stack[0][] = array("template_content", null, null); ob_start();
echo $_smarty_tpl->getSubTemplate ("views/profiles/components/profiles_scripts.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>


<?php if ($_smarty_tpl->tpl_vars['runtime']->value['mode']=="add"&&$_smarty_tpl->tpl_vars['settings']->value['General']['quick_registration']=="Y") {?>
    <div class="ty-account">
    
        <form name="profiles_register_form" action="<?php echo htmlspecialchars(fn_url(''), ENT_QUOTES, 'UTF-8');?>
" method="post">
            <?php echo $_smarty_tpl->getSubTemplate ("views/profiles/components/profile_fields.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('section'=>"C",'nothing_extra'=>"Y"), 0);?>

            <?php echo $_smarty_tpl->getSubTemplate ("views/profiles/components/profiles_account.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('nothing_extra'=>"Y",'location'=>"checkout"), 0);?>


            <?php $_smarty_tpl->smarty->_tag_stack[] = array('hook', array('name'=>"profiles:account_update")); $_block_repeat=true; echo smarty_block_hook(array('name'=>"profiles:account_update"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

            <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_hook(array('name'=>"profiles:account_update"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>


            <?php $_smarty_tpl->tpl_vars["image_verification"] = new Smarty_variable($_smarty_tpl->getSubTemplate ("common/image_verification.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('option'=>"register",'align'=>"left"), 0));?>

            <?php if ($_smarty_tpl->tpl_vars['image_verification']->value) {?>
            <div class="ty-control-group">
                <?php echo $_smarty_tpl->tpl_vars['image_verification']->value;?>

            </div>
            <?php }?>

            <div class="ty-profile-field__buttons buttons-container">
                <?php echo $_smarty_tpl->getSubTemplate ("buttons/register_profile.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('but_name'=>"dispatch[profiles.update]"), 0);?>

            </div>
        </form>
    </div>
    <?php $_smarty_tpl->_capture_stack[0][] = array("mainbox_title", null, null); ob_start();
echo $_smarty_tpl->__("register_new_account");
list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>
<?php } else { ?>

    <?php $_smarty_tpl->_capture_stack[0][] = array("tabsbox", null, null); ob_start(); ?>
        <div class="ty-profile-field ty-account form-wrap" id="content_general">
            <form name="profile_form" action="<?php echo htmlspecialchars(fn_url(''), ENT_QUOTES, 'UTF-8');?>
" method="post">
                <input id="selected_section" type="hidden" value="general" name="selected_section"/>
                <input id="default_card_id" type="hidden" value="" name="default_cc"/>
                <input type="hidden" name="profile_id" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['user_data']->value['profile_id'], ENT_QUOTES, 'UTF-8');?>
" />
                <?php $_smarty_tpl->_capture_stack[0][] = array("group", null, null); ob_start(); ?>
                    <?php echo $_smarty_tpl->getSubTemplate ("views/profiles/components/profiles_account.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

                    <?php echo $_smarty_tpl->getSubTemplate ("views/profiles/components/profile_fields.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('section'=>"C",'title'=>__("contact_information")), 0);?>


                    <?php if ($_smarty_tpl->tpl_vars['profile_fields']->value['B']||$_smarty_tpl->tpl_vars['profile_fields']->value['S']) {?>
                        <?php if ($_smarty_tpl->tpl_vars['settings']->value['General']['user_multiple_profiles']=="Y"&&$_smarty_tpl->tpl_vars['runtime']->value['mode']=="update") {?>
                            <p><?php echo $_smarty_tpl->__("text_multiprofile_notice");?>
</p>
                            <?php echo $_smarty_tpl->getSubTemplate ("views/profiles/components/multiple_profiles.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('profile_id'=>$_smarty_tpl->tpl_vars['user_data']->value['profile_id']), 0);?>
    
                        <?php }?>

                        <?php if ($_smarty_tpl->tpl_vars['settings']->value['Checkout']['address_position']=="billing_first") {?>
                            <?php $_smarty_tpl->tpl_vars["first_section"] = new Smarty_variable("B", null, 0);?>
                            <?php $_smarty_tpl->tpl_vars["first_section_text"] = new Smarty_variable($_smarty_tpl->__("billing_address"), null, 0);?>
                            <?php $_smarty_tpl->tpl_vars["sec_section"] = new Smarty_variable("S", null, 0);?>
                            <?php $_smarty_tpl->tpl_vars["sec_section_text"] = new Smarty_variable($_smarty_tpl->__("shipping_address"), null, 0);?>
                            <?php $_smarty_tpl->tpl_vars["body_id"] = new Smarty_variable("sa", null, 0);?>
                        <?php } else { ?>
                            <?php $_smarty_tpl->tpl_vars["first_section"] = new Smarty_variable("S", null, 0);?>
                            <?php $_smarty_tpl->tpl_vars["first_section_text"] = new Smarty_variable($_smarty_tpl->__("shipping_address"), null, 0);?>
                            <?php $_smarty_tpl->tpl_vars["sec_section"] = new Smarty_variable("B", null, 0);?>
                            <?php $_smarty_tpl->tpl_vars["sec_section_text"] = new Smarty_variable($_smarty_tpl->__("billing_address"), null, 0);?>
                            <?php $_smarty_tpl->tpl_vars["body_id"] = new Smarty_variable("ba", null, 0);?>
                        <?php }?>
                        
                        <?php echo $_smarty_tpl->getSubTemplate ("views/profiles/components/profile_fields.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('section'=>$_smarty_tpl->tpl_vars['first_section']->value,'body_id'=>'','ship_to_another'=>true,'title'=>$_smarty_tpl->tpl_vars['first_section_text']->value), 0);?>

                        <?php echo $_smarty_tpl->getSubTemplate ("views/profiles/components/profile_fields.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('section'=>$_smarty_tpl->tpl_vars['sec_section']->value,'body_id'=>$_smarty_tpl->tpl_vars['body_id']->value,'ship_to_another'=>$_smarty_tpl->tpl_vars['ship_to_another']->value,'title'=>$_smarty_tpl->tpl_vars['sec_section_text']->value,'address_flag'=>fn_compare_shipping_billing($_smarty_tpl->tpl_vars['profile_fields']->value)), 0);?>

                    <?php }?>

                    <?php $_smarty_tpl->smarty->_tag_stack[] = array('hook', array('name'=>"profiles:account_update")); $_block_repeat=true; echo smarty_block_hook(array('name'=>"profiles:account_update"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

                    <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_hook(array('name'=>"profiles:account_update"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>


                    <?php echo $_smarty_tpl->getSubTemplate ("common/image_verification.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('option'=>"register",'align'=>"center"), 0);?>


                <?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>
                <?php echo Smarty::$_smarty_vars['capture']['group'];?>


                <div class="ty-profile-field__buttons buttons-container">
                    <?php if ($_smarty_tpl->tpl_vars['runtime']->value['mode']=="add") {?>
                        <?php echo $_smarty_tpl->getSubTemplate ("buttons/register_profile.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('but_name'=>"dispatch[profiles.update]",'but_id'=>"save_profile_but"), 0);?>

                    <?php } else { ?>
                        <?php echo $_smarty_tpl->getSubTemplate ("buttons/save.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('but_name'=>"dispatch[profiles.update]",'but_meta'=>"ty-btn__secondary",'but_id'=>"save_profile_but"), 0);?>

                        <input class="ty-profile-field__reset ty-btn ty-btn__tertiary" type="reset" name="reset" value="<?php echo $_smarty_tpl->__("revert");?>
" id="shipping_address_reset"/>

                        <?php echo '<script'; ?>
 type="text/javascript">
                        (function(_, $) {
                            var address_switch = $('input:radio:checked', '.ty-address-switch');
                            $("#shipping_address_reset").on("click", function(e) {
                                setTimeout(function() {
                                    address_switch.click();
                                }, 50);
                            });
                        }(Tygh, Tygh.$));
                        <?php echo '</script'; ?>
>
                    <?php }?>
                </div>
            </form>
        </div>
        
        <?php $_smarty_tpl->_capture_stack[0][] = array("additional_tabs", null, null); ob_start(); ?>
            <?php if ($_smarty_tpl->tpl_vars['runtime']->value['mode']=="update") {?>
                <?php if (!fn_allowed_for("ULTIMATE:FREE")) {?>
                    <?php if ($_smarty_tpl->tpl_vars['usergroups']->value&&!fn_check_user_type_admin_area($_smarty_tpl->tpl_vars['user_data']->value)) {?>
                    <div id="content_usergroups">
                        <table class="ty-table">
                        <tr>
                            <th style="width: 30%"><?php echo $_smarty_tpl->__("usergroup");?>
</th>
                            <th style="width: 30%"><?php echo $_smarty_tpl->__("status");?>
</th>
                            <?php if ($_smarty_tpl->tpl_vars['settings']->value['General']['allow_usergroup_signup']=="Y") {?>
                                <th style="width: 40%"><?php echo $_smarty_tpl->__("action");?>
</th>
                            <?php }?>
                        </tr>
                        <?php  $_smarty_tpl->tpl_vars['usergroup'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['usergroup']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['usergroups']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['usergroup']->key => $_smarty_tpl->tpl_vars['usergroup']->value) {
$_smarty_tpl->tpl_vars['usergroup']->_loop = true;
?>
                            <?php if ($_smarty_tpl->tpl_vars['user_data']->value['usergroups'][$_smarty_tpl->tpl_vars['usergroup']->value['usergroup_id']]) {?>
                                <?php $_smarty_tpl->tpl_vars["ug_status"] = new Smarty_variable($_smarty_tpl->tpl_vars['user_data']->value['usergroups'][$_smarty_tpl->tpl_vars['usergroup']->value['usergroup_id']]['status'], null, 0);?>
                            <?php } else { ?>
                                <?php $_smarty_tpl->tpl_vars["ug_status"] = new Smarty_variable("F", null, 0);?>
                            <?php }?>
                            <?php if ($_smarty_tpl->tpl_vars['settings']->value['General']['allow_usergroup_signup']=="Y"||$_smarty_tpl->tpl_vars['settings']->value['General']['allow_usergroup_signup']!="Y"&&$_smarty_tpl->tpl_vars['ug_status']->value=="A") {?>
                                <tr>
                                    <td><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['usergroup']->value['usergroup'], ENT_QUOTES, 'UTF-8');?>
</td>
                                    <td class="ty-center">
                                        <?php if ($_smarty_tpl->tpl_vars['ug_status']->value=="A") {?>
                                            <?php echo $_smarty_tpl->__("active");?>

                                            <?php $_smarty_tpl->tpl_vars["_link_text"] = new Smarty_variable($_smarty_tpl->__("remove"), null, 0);?>
                                            <?php $_smarty_tpl->tpl_vars["_req_type"] = new Smarty_variable("cancel", null, 0);?>
                                        <?php } elseif ($_smarty_tpl->tpl_vars['ug_status']->value=="F") {?>
                                            <?php echo $_smarty_tpl->__("available");?>

                                            <?php $_smarty_tpl->tpl_vars["_link_text"] = new Smarty_variable($_smarty_tpl->__("join"), null, 0);?>
                                            <?php $_smarty_tpl->tpl_vars["_req_type"] = new Smarty_variable("join", null, 0);?>
                                        <?php } elseif ($_smarty_tpl->tpl_vars['ug_status']->value=="D") {?>
                                            <?php echo $_smarty_tpl->__("declined");?>

                                            <?php $_smarty_tpl->tpl_vars["_link_text"] = new Smarty_variable($_smarty_tpl->__("join"), null, 0);?>
                                            <?php $_smarty_tpl->tpl_vars["_req_type"] = new Smarty_variable("join", null, 0);?>
                                        <?php } elseif ($_smarty_tpl->tpl_vars['ug_status']->value=="P") {?>
                                            <?php echo $_smarty_tpl->__("pending");?>

                                            <?php $_smarty_tpl->tpl_vars["_link_text"] = new Smarty_variable($_smarty_tpl->__("cancel"), null, 0);?>
                                            <?php $_smarty_tpl->tpl_vars["_req_type"] = new Smarty_variable("cancel", null, 0);?>
                                        <?php }?>
                                    </td>
                                    <?php if ($_smarty_tpl->tpl_vars['settings']->value['General']['allow_usergroup_signup']=="Y") {?>
                                        <td>
                                            <a class="cm-ajax" data-ca-target-id="content_usergroups" href="<?php echo htmlspecialchars(fn_url("profiles.usergroups?usergroup_id=".((string)$_smarty_tpl->tpl_vars['usergroup']->value['usergroup_id'])."&type=".((string)$_smarty_tpl->tpl_vars['_req_type']->value)), ENT_QUOTES, 'UTF-8');?>
"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['_link_text']->value, ENT_QUOTES, 'UTF-8');?>
</a>
                                        </td>
                                    <?php }?>
                                </tr>
                            <?php }?>
                        <?php } ?>
                        </table>
                    <!--content_usergroups--></div>
                    <?php }?>
                <?php }?>

                <?php $_smarty_tpl->smarty->_tag_stack[] = array('hook', array('name'=>"profiles:tabs")); $_block_repeat=true; echo smarty_block_hook(array('name'=>"profiles:tabs"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

                <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_hook(array('name'=>"profiles:tabs"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

            <?php }?>
        <?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>

        <?php echo Smarty::$_smarty_vars['capture']['additional_tabs'];?>


    <?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>

    <?php if (trim(Smarty::$_smarty_vars['capture']['additional_tabs'])!='') {?>
        <?php echo $_smarty_tpl->getSubTemplate ("common/tabsbox.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('content'=>Smarty::$_smarty_vars['capture']['tabsbox'],'active_tab'=>$_REQUEST['selected_section'],'track'=>true), 0);?>

    <?php } else { ?>
        <?php echo Smarty::$_smarty_vars['capture']['tabsbox'];?>

    <?php }?>

    <?php $_smarty_tpl->_capture_stack[0][] = array("mainbox_title", null, null); ob_start();
echo $_smarty_tpl->__("profile_details");
list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>
<?php }?>
<?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();
if (trim(Smarty::$_smarty_vars['capture']['template_content'])) {
if ($_smarty_tpl->tpl_vars['auth']->value['area']=="A") {?><span class="cm-template-box template-box" data-ca-te-template="views/profiles/update.tpl" id="<?php echo smarty_function_set_id(array('name'=>"views/profiles/update.tpl"),$_smarty_tpl);?>
"><div class="cm-template-icon icon-edit ty-icon-edit hidden"></div><?php echo Smarty::$_smarty_vars['capture']['template_content'];?>
<!--[/tpl_id]--></span><?php } else {
echo Smarty::$_smarty_vars['capture']['template_content'];
}
}
} else {
echo $_smarty_tpl->getSubTemplate ("views/profiles/components/profiles_scripts.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>


<?php if ($_smarty_tpl->tpl_vars['runtime']->value['mode']=="add"&&$_smarty_tpl->tpl_vars['settings']->value['General']['quick_registration']=="Y") {?>
    <div class="ty-account">
    
        <form name="profiles_register_form" action="<?php echo htmlspecialchars(fn_url(''), ENT_QUOTES, 'UTF-8');?>
" method="post">
            <?php echo $_smarty_tpl->getSubTemplate ("views/profiles/components/profile_fields.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('section'=>"C",'nothing_extra'=>"Y"), 0);?>

            <?php echo $_smarty_tpl->getSubTemplate ("views/profiles/components/profiles_account.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('nothing_extra'=>"Y",'location'=>"checkout"), 0);?>


            <?php $_smarty_tpl->smarty->_tag_stack[] = array('hook', array('name'=>"profiles:account_update")); $_block_repeat=true; echo smarty_block_hook(array('name'=>"profiles:account_update"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

            <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_hook(array('name'=>"profiles:account_update"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>


            <?php $_smarty_tpl->tpl_vars["image_verification"] = new Smarty_variable($_smarty_tpl->getSubTemplate ("common/image_verification.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('option'=>"register",'align'=>"left"), 0));?>

            <?php if ($_smarty_tpl->tpl_vars['image_verification']->value) {?>
            <div class="ty-control-group">
                <?php echo $_smarty_tpl->tpl_vars['image_verification']->value;?>

            </div>
            <?php }?>

            <div class="ty-profile-field__buttons buttons-container">
                <?php echo $_smarty_tpl->getSubTemplate ("buttons/register_profile.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('but_name'=>"dispatch[profiles.update]"), 0);?>

            </div>
        </form>
    </div>
    <?php $_smarty_tpl->_capture_stack[0][] = array("mainbox_title", null, null); ob_start();
echo $_smarty_tpl->__("register_new_account");
list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>
<?php } else { ?>

    <?php $_smarty_tpl->_capture_stack[0][] = array("tabsbox", null, null); ob_start(); ?>
        <div class="ty-profile-field ty-account form-wrap" id="content_general">
            <form name="profile_form" action="<?php echo htmlspecialchars(fn_url(''), ENT_QUOTES, 'UTF-8');?>
" method="post">
                <input id="selected_section" type="hidden" value="general" name="selected_section"/>
                <input id="default_card_id" type="hidden" value="" name="default_cc"/>
                <input type="hidden" name="profile_id" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['user_data']->value['profile_id'], ENT_QUOTES, 'UTF-8');?>
" />
                <?php $_smarty_tpl->_capture_stack[0][] = array("group", null, null); ob_start(); ?>
                    <?php echo $_smarty_tpl->getSubTemplate ("views/profiles/components/profiles_account.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

                    <?php echo $_smarty_tpl->getSubTemplate ("views/profiles/components/profile_fields.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('section'=>"C",'title'=>__("contact_information")), 0);?>


                    <?php if ($_smarty_tpl->tpl_vars['profile_fields']->value['B']||$_smarty_tpl->tpl_vars['profile_fields']->value['S']) {?>
                        <?php if ($_smarty_tpl->tpl_vars['settings']->value['General']['user_multiple_profiles']=="Y"&&$_smarty_tpl->tpl_vars['runtime']->value['mode']=="update") {?>
                            <p><?php echo $_smarty_tpl->__("text_multiprofile_notice");?>
</p>
                            <?php echo $_smarty_tpl->getSubTemplate ("views/profiles/components/multiple_profiles.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('profile_id'=>$_smarty_tpl->tpl_vars['user_data']->value['profile_id']), 0);?>
    
                        <?php }?>

                        <?php if ($_smarty_tpl->tpl_vars['settings']->value['Checkout']['address_position']=="billing_first") {?>
                            <?php $_smarty_tpl->tpl_vars["first_section"] = new Smarty_variable("B", null, 0);?>
                            <?php $_smarty_tpl->tpl_vars["first_section_text"] = new Smarty_variable($_smarty_tpl->__("billing_address"), null, 0);?>
                            <?php $_smarty_tpl->tpl_vars["sec_section"] = new Smarty_variable("S", null, 0);?>
                            <?php $_smarty_tpl->tpl_vars["sec_section_text"] = new Smarty_variable($_smarty_tpl->__("shipping_address"), null, 0);?>
                            <?php $_smarty_tpl->tpl_vars["body_id"] = new Smarty_variable("sa", null, 0);?>
                        <?php } else { ?>
                            <?php $_smarty_tpl->tpl_vars["first_section"] = new Smarty_variable("S", null, 0);?>
                            <?php $_smarty_tpl->tpl_vars["first_section_text"] = new Smarty_variable($_smarty_tpl->__("shipping_address"), null, 0);?>
                            <?php $_smarty_tpl->tpl_vars["sec_section"] = new Smarty_variable("B", null, 0);?>
                            <?php $_smarty_tpl->tpl_vars["sec_section_text"] = new Smarty_variable($_smarty_tpl->__("billing_address"), null, 0);?>
                            <?php $_smarty_tpl->tpl_vars["body_id"] = new Smarty_variable("ba", null, 0);?>
                        <?php }?>
                        
                        <?php echo $_smarty_tpl->getSubTemplate ("views/profiles/components/profile_fields.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('section'=>$_smarty_tpl->tpl_vars['first_section']->value,'body_id'=>'','ship_to_another'=>true,'title'=>$_smarty_tpl->tpl_vars['first_section_text']->value), 0);?>

                        <?php echo $_smarty_tpl->getSubTemplate ("views/profiles/components/profile_fields.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('section'=>$_smarty_tpl->tpl_vars['sec_section']->value,'body_id'=>$_smarty_tpl->tpl_vars['body_id']->value,'ship_to_another'=>$_smarty_tpl->tpl_vars['ship_to_another']->value,'title'=>$_smarty_tpl->tpl_vars['sec_section_text']->value,'address_flag'=>fn_compare_shipping_billing($_smarty_tpl->tpl_vars['profile_fields']->value)), 0);?>

                    <?php }?>

                    <?php $_smarty_tpl->smarty->_tag_stack[] = array('hook', array('name'=>"profiles:account_update")); $_block_repeat=true; echo smarty_block_hook(array('name'=>"profiles:account_update"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

                    <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_hook(array('name'=>"profiles:account_update"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>


                    <?php echo $_smarty_tpl->getSubTemplate ("common/image_verification.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('option'=>"register",'align'=>"center"), 0);?>


                <?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>
                <?php echo Smarty::$_smarty_vars['capture']['group'];?>


                <div class="ty-profile-field__buttons buttons-container">
                    <?php if ($_smarty_tpl->tpl_vars['runtime']->value['mode']=="add") {?>
                        <?php echo $_smarty_tpl->getSubTemplate ("buttons/register_profile.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('but_name'=>"dispatch[profiles.update]",'but_id'=>"save_profile_but"), 0);?>

                    <?php } else { ?>
                        <?php echo $_smarty_tpl->getSubTemplate ("buttons/save.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('but_name'=>"dispatch[profiles.update]",'but_meta'=>"ty-btn__secondary",'but_id'=>"save_profile_but"), 0);?>

                        <input class="ty-profile-field__reset ty-btn ty-btn__tertiary" type="reset" name="reset" value="<?php echo $_smarty_tpl->__("revert");?>
" id="shipping_address_reset"/>

                        <?php echo '<script'; ?>
 type="text/javascript">
                        (function(_, $) {
                            var address_switch = $('input:radio:checked', '.ty-address-switch');
                            $("#shipping_address_reset").on("click", function(e) {
                                setTimeout(function() {
                                    address_switch.click();
                                }, 50);
                            });
                        }(Tygh, Tygh.$));
                        <?php echo '</script'; ?>
>
                    <?php }?>
                </div>
            </form>
        </div>
        
        <?php $_smarty_tpl->_capture_stack[0][] = array("additional_tabs", null, null); ob_start(); ?>
            <?php if ($_smarty_tpl->tpl_vars['runtime']->value['mode']=="update") {?>
                <?php if (!fn_allowed_for("ULTIMATE:FREE")) {?>
                    <?php if ($_smarty_tpl->tpl_vars['usergroups']->value&&!fn_check_user_type_admin_area($_smarty_tpl->tpl_vars['user_data']->value)) {?>
                    <div id="content_usergroups">
                        <table class="ty-table">
                        <tr>
                            <th style="width: 30%"><?php echo $_smarty_tpl->__("usergroup");?>
</th>
                            <th style="width: 30%"><?php echo $_smarty_tpl->__("status");?>
</th>
                            <?php if ($_smarty_tpl->tpl_vars['settings']->value['General']['allow_usergroup_signup']=="Y") {?>
                                <th style="width: 40%"><?php echo $_smarty_tpl->__("action");?>
</th>
                            <?php }?>
                        </tr>
                        <?php  $_smarty_tpl->tpl_vars['usergroup'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['usergroup']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['usergroups']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['usergroup']->key => $_smarty_tpl->tpl_vars['usergroup']->value) {
$_smarty_tpl->tpl_vars['usergroup']->_loop = true;
?>
                            <?php if ($_smarty_tpl->tpl_vars['user_data']->value['usergroups'][$_smarty_tpl->tpl_vars['usergroup']->value['usergroup_id']]) {?>
                                <?php $_smarty_tpl->tpl_vars["ug_status"] = new Smarty_variable($_smarty_tpl->tpl_vars['user_data']->value['usergroups'][$_smarty_tpl->tpl_vars['usergroup']->value['usergroup_id']]['status'], null, 0);?>
                            <?php } else { ?>
                                <?php $_smarty_tpl->tpl_vars["ug_status"] = new Smarty_variable("F", null, 0);?>
                            <?php }?>
                            <?php if ($_smarty_tpl->tpl_vars['settings']->value['General']['allow_usergroup_signup']=="Y"||$_smarty_tpl->tpl_vars['settings']->value['General']['allow_usergroup_signup']!="Y"&&$_smarty_tpl->tpl_vars['ug_status']->value=="A") {?>
                                <tr>
                                    <td><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['usergroup']->value['usergroup'], ENT_QUOTES, 'UTF-8');?>
</td>
                                    <td class="ty-center">
                                        <?php if ($_smarty_tpl->tpl_vars['ug_status']->value=="A") {?>
                                            <?php echo $_smarty_tpl->__("active");?>

                                            <?php $_smarty_tpl->tpl_vars["_link_text"] = new Smarty_variable($_smarty_tpl->__("remove"), null, 0);?>
                                            <?php $_smarty_tpl->tpl_vars["_req_type"] = new Smarty_variable("cancel", null, 0);?>
                                        <?php } elseif ($_smarty_tpl->tpl_vars['ug_status']->value=="F") {?>
                                            <?php echo $_smarty_tpl->__("available");?>

                                            <?php $_smarty_tpl->tpl_vars["_link_text"] = new Smarty_variable($_smarty_tpl->__("join"), null, 0);?>
                                            <?php $_smarty_tpl->tpl_vars["_req_type"] = new Smarty_variable("join", null, 0);?>
                                        <?php } elseif ($_smarty_tpl->tpl_vars['ug_status']->value=="D") {?>
                                            <?php echo $_smarty_tpl->__("declined");?>

                                            <?php $_smarty_tpl->tpl_vars["_link_text"] = new Smarty_variable($_smarty_tpl->__("join"), null, 0);?>
                                            <?php $_smarty_tpl->tpl_vars["_req_type"] = new Smarty_variable("join", null, 0);?>
                                        <?php } elseif ($_smarty_tpl->tpl_vars['ug_status']->value=="P") {?>
                                            <?php echo $_smarty_tpl->__("pending");?>

                                            <?php $_smarty_tpl->tpl_vars["_link_text"] = new Smarty_variable($_smarty_tpl->__("cancel"), null, 0);?>
                                            <?php $_smarty_tpl->tpl_vars["_req_type"] = new Smarty_variable("cancel", null, 0);?>
                                        <?php }?>
                                    </td>
                                    <?php if ($_smarty_tpl->tpl_vars['settings']->value['General']['allow_usergroup_signup']=="Y") {?>
                                        <td>
                                            <a class="cm-ajax" data-ca-target-id="content_usergroups" href="<?php echo htmlspecialchars(fn_url("profiles.usergroups?usergroup_id=".((string)$_smarty_tpl->tpl_vars['usergroup']->value['usergroup_id'])."&type=".((string)$_smarty_tpl->tpl_vars['_req_type']->value)), ENT_QUOTES, 'UTF-8');?>
"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['_link_text']->value, ENT_QUOTES, 'UTF-8');?>
</a>
                                        </td>
                                    <?php }?>
                                </tr>
                            <?php }?>
                        <?php } ?>
                        </table>
                    <!--content_usergroups--></div>
                    <?php }?>
                <?php }?>

                <?php $_smarty_tpl->smarty->_tag_stack[] = array('hook', array('name'=>"profiles:tabs")); $_block_repeat=true; echo smarty_block_hook(array('name'=>"profiles:tabs"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

                <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_hook(array('name'=>"profiles:tabs"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

            <?php }?>
        <?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>

        <?php echo Smarty::$_smarty_vars['capture']['additional_tabs'];?>


    <?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>

    <?php if (trim(Smarty::$_smarty_vars['capture']['additional_tabs'])!='') {?>
        <?php echo $_smarty_tpl->getSubTemplate ("common/tabsbox.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('content'=>Smarty::$_smarty_vars['capture']['tabsbox'],'active_tab'=>$_REQUEST['selected_section'],'track'=>true), 0);?>

    <?php } else { ?>
        <?php echo Smarty::$_smarty_vars['capture']['tabsbox'];?>

    <?php }?>

    <?php $_smarty_tpl->_capture_stack[0][] = array("mainbox_title", null, null); ob_start();
echo $_smarty_tpl->__("profile_details");
list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>
<?php }?>
<?php }?><?php }} ?>
