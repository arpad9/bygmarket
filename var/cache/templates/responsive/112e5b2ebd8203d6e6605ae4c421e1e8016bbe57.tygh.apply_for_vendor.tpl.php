<?php /* Smarty version Smarty-3.1.21, created on 2015-09-18 21:29:20
         compiled from "/var/www/bygmarket.com/design/themes/responsive/templates/views/companies/apply_for_vendor.tpl" */ ?>
<?php /*%%SmartyHeaderCode:133275399555fc58009e1856-08471581%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '112e5b2ebd8203d6e6605ae4c421e1e8016bbe57' => 
    array (
      0 => '/var/www/bygmarket.com/design/themes/responsive/templates/views/companies/apply_for_vendor.tpl',
      1 => 1442595889,
      2 => 'tygh',
    ),
  ),
  'nocache_hash' => '133275399555fc58009e1856-08471581',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'runtime' => 0,
    'company_data' => 0,
    'languages' => 0,
    'lang_code' => 0,
    'language' => 0,
    'auth' => 0,
    'settings' => 0,
    'disabled_by_default' => 0,
    'countries' => 0,
    '_country' => 0,
    'code' => 0,
    'country' => 0,
    'states' => 0,
    '_state' => 0,
    'state' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21',
  'unifunc' => 'content_55fc5800cf1540_26765535',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55fc5800cf1540_26765535')) {function content_55fc5800cf1540_26765535($_smarty_tpl) {?><?php if (!is_callable('smarty_block_hook')) include '/var/www/bygmarket.com/app/functions/smarty_plugins/block.hook.php';
if (!is_callable('smarty_function_set_id')) include '/var/www/bygmarket.com/app/functions/smarty_plugins/function.set_id.php';
?><?php
fn_preload_lang_vars(array('apply_for_vendor_account','company','description','language','first_name','last_name','contact_information','contact_information','email','phone','url','fax','shipping_address','shipping_address','address','city','country','select_country','state','select_state','zip_postal_code','submit','apply_for_vendor_account','company','description','language','first_name','last_name','contact_information','contact_information','email','phone','url','fax','shipping_address','shipping_address','address','city','country','select_country','state','select_state','zip_postal_code','submit'));
?>
<?php if ($_smarty_tpl->tpl_vars['runtime']->value['customization_mode']['design']=="Y"&&@constant('AREA')=="C") {
$_smarty_tpl->_capture_stack[0][] = array("template_content", null, null); ob_start();
$_smarty_tpl->smarty->_tag_stack[] = array('hook', array('name'=>"vendors:apply_page")); $_block_repeat=true; echo smarty_block_hook(array('name'=>"vendors:apply_page"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

<div class="ty-company-fields">
    <?php echo $_smarty_tpl->getSubTemplate ("views/profiles/components/profiles_scripts.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>


    <h1 class="ty-mainbox-title"><?php echo $_smarty_tpl->__("apply_for_vendor_account");?>
</h1>

    <div id="apply_for_vendor_account" > 

        <form action="<?php echo htmlspecialchars(fn_url("companies.apply_for_vendor"), ENT_QUOTES, 'UTF-8');?>
" method="post" name="apply_for_vendor_form">
            <?php $_smarty_tpl->smarty->_tag_stack[] = array('hook', array('name'=>"vendors:apply_fields")); $_block_repeat=true; echo smarty_block_hook(array('name'=>"vendors:apply_fields"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

            
            <div class="ty-control-group">
                <label for="company_description_company" class="ty-control-group__title cm-required"><?php echo $_smarty_tpl->__("company");?>
</label>
                <input type="text" name="company_data[company]" id="company_description_company" size="32" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['company_data']->value['company'], ENT_QUOTES, 'UTF-8');?>
" class="ty-input-text cm-focus" />
            </div>

            <div class="ty-control-group">
                <label class="ty-control-group__title" for="company_description"><?php echo $_smarty_tpl->__("description");?>
</label>
                <textarea id="company_description" name="company_data[company_description]" cols="55" rows="5" class="ty-input-textarea-long"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['company_data']->value['company_description'], ENT_QUOTES, 'UTF-8');?>
</textarea>
            </div>

            <?php if (count($_smarty_tpl->tpl_vars['languages']->value)>1) {?>
            <div class="ty-control-group">
                <label class="ty-control-group__title" for="company_language"><?php echo $_smarty_tpl->__("language");?>
</label>
                <select name="company_data[lang_code]" id="company_language">
                    <?php  $_smarty_tpl->tpl_vars["language"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["language"]->_loop = false;
 $_smarty_tpl->tpl_vars["lang_code"] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['languages']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["language"]->key => $_smarty_tpl->tpl_vars["language"]->value) {
$_smarty_tpl->tpl_vars["language"]->_loop = true;
 $_smarty_tpl->tpl_vars["lang_code"]->value = $_smarty_tpl->tpl_vars["language"]->key;
?>
                        <option value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['lang_code']->value, ENT_QUOTES, 'UTF-8');?>
" <?php if ($_smarty_tpl->tpl_vars['lang_code']->value==$_smarty_tpl->tpl_vars['company_data']->value['lang_code']) {?>selected="selected"<?php }?>><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['language']->value['name'], ENT_QUOTES, 'UTF-8');?>
</option>
                    <?php } ?>
                </select>
            </div>
            <?php } else { ?>
            <input type="hidden" name="company_data[lang_code]" value="<?php echo htmlspecialchars(key($_smarty_tpl->tpl_vars['languages']->value), ENT_QUOTES, 'UTF-8');?>
" />
            <?php }?>

            <?php if (!$_smarty_tpl->tpl_vars['auth']->value['user_id']&&$_smarty_tpl->tpl_vars['settings']->value['Vendors']['create_vendor_administrator_account']=="Y") {?>

                
                <?php echo '<script'; ?>
 type="text/javascript">

                function fn_toggle_required_fields() {
                    var $ = Tygh.$;
                    var f = $('#company_admin_firstname');
                    var l = $('#company_admin_lastname');
                    var flag = ($('#company_request_account_name').val() == '');

                    f.prop('disabled', flag).toggleClass('disabled', flag);
                    l.prop('disabled', flag).toggleClass('disabled', flag);

                    $('.cm-profile-field').each(function(index) {
                        var elm = $('#' + $(this).prop('for'));
                        if (elm.children() != null) {
                            // Traverse subitems
                            $('.' + $(this).prop('for')).prop('disabled', flag).toggleClass('disabled', flag);
                        }
                        elm.prop('disabled', flag).toggleClass('disabled', flag);
                    });
                }
                <?php echo '</script'; ?>
>
                

                <?php $_smarty_tpl->tpl_vars["disabled_by_default"] = new Smarty_variable(false, null, 0);?>
                <div class="ty-control-group" id="company_description_admin_firstname">
                    <label for="company_admin_firstname" class="ty-control-group__title cm-required"><?php echo $_smarty_tpl->__("first_name");?>
</label>
                    <input type="text" name="company_data[admin_firstname]" id="company_admin_firstname" size="32" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['company_data']->value['admin_firstname'], ENT_QUOTES, 'UTF-8');?>
" class="ty-input-text" />
                </div>
                <div class="ty-control-group" id="company_description_admin_lastname">
                    <label for="company_admin_lastname" class="ty-control-group__title cm-required"><?php echo $_smarty_tpl->__("last_name");?>
</label>
                    <input type="text" name="company_data[admin_lastname]" id="company_admin_lastname" size="32" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['company_data']->value['admin_lastname'], ENT_QUOTES, 'UTF-8');?>
" class="ty-input-text" />
                </div>

            <?php }?>

            <?php if (!$_smarty_tpl->tpl_vars['auth']->value['user_id']) {?>
                <?php echo $_smarty_tpl->getSubTemplate ("views/profiles/components/profile_fields.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('section'=>"C",'title'=>__("contact_information"),'disabled_by_default'=>$_smarty_tpl->tpl_vars['disabled_by_default']->value), 0);?>

            <?php } else { ?>
                <?php echo $_smarty_tpl->getSubTemplate ("common/subheader.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('title'=>__("contact_information")), 0);?>

            <?php }?>

            <div class="ty-control-group">
                <label for="company_description_email" class="ty-control-group__title cm-required cm-email cm-trim"><?php echo $_smarty_tpl->__("email");?>
</label>
                <input type="text" name="company_data[email]" id="company_description_email" size="32" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['company_data']->value['email'], ENT_QUOTES, 'UTF-8');?>
" class="ty-input-text" />
            </div>

            <div class="ty-control-group">
                <label for="company_description_phone" class="ty-control-group__title cm-required"><?php echo $_smarty_tpl->__("phone");?>
</label>
                <input type="text" name="company_data[phone]" id="company_description_phone" size="32" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['company_data']->value['phone'], ENT_QUOTES, 'UTF-8');?>
" class="ty-input-text" />
            </div>

            <div class="ty-control-group">
                <label class="ty-control-group__title" for="company_description_url"><?php echo $_smarty_tpl->__("url");?>
</label>
                <input type="text" name="company_data[url]" id="company_description_url" size="32" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['company_data']->value['url'], ENT_QUOTES, 'UTF-8');?>
" class="ty-input-text" />
            </div>

            <div class="ty-control-group">
                <label class="ty-control-group__title" for="company_description_fax"><?php echo $_smarty_tpl->__("fax");?>
</label>
                <input type="text" name="company_data[fax]" id="company_description_fax" size="32" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['company_data']->value['fax'], ENT_QUOTES, 'UTF-8');?>
" class="ty-input-text" />
            </div>


            <?php if (!$_smarty_tpl->tpl_vars['auth']->value['user_id']) {?>
                <?php echo $_smarty_tpl->getSubTemplate ("views/profiles/components/profile_fields.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('section'=>"B",'title'=>__("shipping_address"),'shipping_flag'=>false,'disabled_by_default'=>$_smarty_tpl->tpl_vars['disabled_by_default']->value), 0);?>

            <?php } else { ?>
                <?php echo $_smarty_tpl->getSubTemplate ("common/subheader.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('title'=>__("shipping_address")), 0);?>

            <?php }?>

            <div class="ty-control-group">
                <label class="ty-control-group__title cm-required" for="company_address_address"><?php echo $_smarty_tpl->__("address");?>
</label>
                <input type="text" name="company_data[address]" id="company_address_address" size="32" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['company_data']->value['address'], ENT_QUOTES, 'UTF-8');?>
" class="ty-input-text" />
            </div>

            <div class="ty-control-group">
                <label class="ty-control-group__title cm-required" for="company_address_city"><?php echo $_smarty_tpl->__("city");?>
</label>
                <input type="text" name="company_data[city]" id="company_address_city" size="32" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['company_data']->value['city'], ENT_QUOTES, 'UTF-8');?>
" class="ty-input-text" />
            </div>

            <div class="ty-control-group  shipping-country">
                <label for="company_address_country" class="ty-control-group__title cm-required"><?php echo $_smarty_tpl->__("country");?>
</label>
                <?php $_smarty_tpl->tpl_vars["_country"] = new Smarty_variable((($tmp = @$_smarty_tpl->tpl_vars['company_data']->value['country'])===null||$tmp==='' ? $_smarty_tpl->tpl_vars['settings']->value['General']['default_country'] : $tmp), null, 0);?>
                <select class="cm-country cm-location-shipping" id="company_address_country" name="company_data[country]">
                    <option value="">- <?php echo $_smarty_tpl->__("select_country");?>
 -</option>
                    <?php  $_smarty_tpl->tpl_vars["country"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["country"]->_loop = false;
 $_smarty_tpl->tpl_vars["code"] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['countries']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["country"]->key => $_smarty_tpl->tpl_vars["country"]->value) {
$_smarty_tpl->tpl_vars["country"]->_loop = true;
 $_smarty_tpl->tpl_vars["code"]->value = $_smarty_tpl->tpl_vars["country"]->key;
?>
                    <option <?php if ($_smarty_tpl->tpl_vars['_country']->value==$_smarty_tpl->tpl_vars['code']->value) {?>selected="selected"<?php }?> value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['code']->value, ENT_QUOTES, 'UTF-8');?>
"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['country']->value, ENT_QUOTES, 'UTF-8');?>
</option>
                    <?php } ?>
                </select>
            </div>

            <?php $_smarty_tpl->tpl_vars['_country'] = new Smarty_variable((($tmp = @$_smarty_tpl->tpl_vars['company_data']->value['country'])===null||$tmp==='' ? $_smarty_tpl->tpl_vars['settings']->value['General']['default_country'] : $tmp), null, 0);?>
            <?php $_smarty_tpl->tpl_vars['_state'] = new Smarty_variable((($tmp = @$_smarty_tpl->tpl_vars['company_data']->value['state'])===null||$tmp==='' ? $_smarty_tpl->tpl_vars['settings']->value['General']['default_state'] : $tmp), null, 0);?>

            <div class="ty-control-group shipping-state">
                <label for="company_address_state" class="ty-control-group__title cm-required"><?php echo $_smarty_tpl->__("state");?>
</label>
                <select id="company_address_state" name="company_data[state]" class="cm-state cm-location-shipping <?php if (!$_smarty_tpl->tpl_vars['states']->value[$_smarty_tpl->tpl_vars['_country']->value]) {?>hidden<?php }?>">
                    <option value="">- <?php echo $_smarty_tpl->__("select_state");?>
 -</option>
                    <?php if ($_smarty_tpl->tpl_vars['states']->value&&$_smarty_tpl->tpl_vars['states']->value[$_smarty_tpl->tpl_vars['_country']->value]) {?>
                        <?php  $_smarty_tpl->tpl_vars['state'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['state']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['states']->value[$_smarty_tpl->tpl_vars['_country']->value]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['state']->key => $_smarty_tpl->tpl_vars['state']->value) {
$_smarty_tpl->tpl_vars['state']->_loop = true;
?>
                            <option <?php if ($_smarty_tpl->tpl_vars['_state']->value==$_smarty_tpl->tpl_vars['state']->value['code']) {?>selected="selected"<?php }?> value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['state']->value['code'], ENT_QUOTES, 'UTF-8');?>
"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['state']->value['state'], ENT_QUOTES, 'UTF-8');?>
</option>
                        <?php } ?>
                    <?php }?>
                </select>
                <input type="text" id="company_address_state_d" name="company_data[state]" size="32" maxlength="64" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['_state']->value, ENT_QUOTES, 'UTF-8');?>
" <?php if ($_smarty_tpl->tpl_vars['states']->value[$_smarty_tpl->tpl_vars['_country']->value]) {?>disabled="disabled"<?php }?> class="cm-state cm-location-shipping ty-input-text <?php if ($_smarty_tpl->tpl_vars['states']->value[$_smarty_tpl->tpl_vars['_country']->value]) {?>hidden<?php }?> cm-skip-avail-switch" />
            </div>

            <div class="ty-control-group shipping-zip-code">
                <label for="company_address_zipcode" class="ty-control-group__title cm-required cm-zipcode cm-location-shipping"><?php echo $_smarty_tpl->__("zip_postal_code");?>
</label>
                <input type="text" name="company_data[zipcode]" id="company_address_zipcode" size="32" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['company_data']->value['zipcode'], ENT_QUOTES, 'UTF-8');?>
" class="ty-input-text" />
            </div>
            <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_hook(array('name'=>"vendors:apply_fields"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>


            <?php echo $_smarty_tpl->getSubTemplate ("common/image_verification.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('option'=>"apply_for_vendor_account",'align'=>"left"), 0);?>


            <div class="buttons-container">
                <?php echo $_smarty_tpl->getSubTemplate ("buttons/button.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('but_text'=>__("submit"),'but_name'=>"dispatch[companies.apply_for_vendor]",'but_id'=>"but_apply_for_vendor",'but_meta'=>"ty-btn__primary"), 0);?>

            </div>
        </form>
    </div>
</div>
<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_hook(array('name'=>"vendors:apply_page"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);
list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();
if (trim(Smarty::$_smarty_vars['capture']['template_content'])) {
if ($_smarty_tpl->tpl_vars['auth']->value['area']=="A") {?><span class="cm-template-box template-box" data-ca-te-template="views/companies/apply_for_vendor.tpl" id="<?php echo smarty_function_set_id(array('name'=>"views/companies/apply_for_vendor.tpl"),$_smarty_tpl);?>
"><div class="cm-template-icon icon-edit ty-icon-edit hidden"></div><?php echo Smarty::$_smarty_vars['capture']['template_content'];?>
<!--[/tpl_id]--></span><?php } else {
echo Smarty::$_smarty_vars['capture']['template_content'];
}
}
} else {
$_smarty_tpl->smarty->_tag_stack[] = array('hook', array('name'=>"vendors:apply_page")); $_block_repeat=true; echo smarty_block_hook(array('name'=>"vendors:apply_page"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

<div class="ty-company-fields">
    <?php echo $_smarty_tpl->getSubTemplate ("views/profiles/components/profiles_scripts.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>


    <h1 class="ty-mainbox-title"><?php echo $_smarty_tpl->__("apply_for_vendor_account");?>
</h1>

    <div id="apply_for_vendor_account" > 

        <form action="<?php echo htmlspecialchars(fn_url("companies.apply_for_vendor"), ENT_QUOTES, 'UTF-8');?>
" method="post" name="apply_for_vendor_form">
            <?php $_smarty_tpl->smarty->_tag_stack[] = array('hook', array('name'=>"vendors:apply_fields")); $_block_repeat=true; echo smarty_block_hook(array('name'=>"vendors:apply_fields"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

            
            <div class="ty-control-group">
                <label for="company_description_company" class="ty-control-group__title cm-required"><?php echo $_smarty_tpl->__("company");?>
</label>
                <input type="text" name="company_data[company]" id="company_description_company" size="32" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['company_data']->value['company'], ENT_QUOTES, 'UTF-8');?>
" class="ty-input-text cm-focus" />
            </div>

            <div class="ty-control-group">
                <label class="ty-control-group__title" for="company_description"><?php echo $_smarty_tpl->__("description");?>
</label>
                <textarea id="company_description" name="company_data[company_description]" cols="55" rows="5" class="ty-input-textarea-long"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['company_data']->value['company_description'], ENT_QUOTES, 'UTF-8');?>
</textarea>
            </div>

            <?php if (count($_smarty_tpl->tpl_vars['languages']->value)>1) {?>
            <div class="ty-control-group">
                <label class="ty-control-group__title" for="company_language"><?php echo $_smarty_tpl->__("language");?>
</label>
                <select name="company_data[lang_code]" id="company_language">
                    <?php  $_smarty_tpl->tpl_vars["language"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["language"]->_loop = false;
 $_smarty_tpl->tpl_vars["lang_code"] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['languages']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["language"]->key => $_smarty_tpl->tpl_vars["language"]->value) {
$_smarty_tpl->tpl_vars["language"]->_loop = true;
 $_smarty_tpl->tpl_vars["lang_code"]->value = $_smarty_tpl->tpl_vars["language"]->key;
?>
                        <option value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['lang_code']->value, ENT_QUOTES, 'UTF-8');?>
" <?php if ($_smarty_tpl->tpl_vars['lang_code']->value==$_smarty_tpl->tpl_vars['company_data']->value['lang_code']) {?>selected="selected"<?php }?>><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['language']->value['name'], ENT_QUOTES, 'UTF-8');?>
</option>
                    <?php } ?>
                </select>
            </div>
            <?php } else { ?>
            <input type="hidden" name="company_data[lang_code]" value="<?php echo htmlspecialchars(key($_smarty_tpl->tpl_vars['languages']->value), ENT_QUOTES, 'UTF-8');?>
" />
            <?php }?>

            <?php if (!$_smarty_tpl->tpl_vars['auth']->value['user_id']&&$_smarty_tpl->tpl_vars['settings']->value['Vendors']['create_vendor_administrator_account']=="Y") {?>

                
                <?php echo '<script'; ?>
 type="text/javascript">

                function fn_toggle_required_fields() {
                    var $ = Tygh.$;
                    var f = $('#company_admin_firstname');
                    var l = $('#company_admin_lastname');
                    var flag = ($('#company_request_account_name').val() == '');

                    f.prop('disabled', flag).toggleClass('disabled', flag);
                    l.prop('disabled', flag).toggleClass('disabled', flag);

                    $('.cm-profile-field').each(function(index) {
                        var elm = $('#' + $(this).prop('for'));
                        if (elm.children() != null) {
                            // Traverse subitems
                            $('.' + $(this).prop('for')).prop('disabled', flag).toggleClass('disabled', flag);
                        }
                        elm.prop('disabled', flag).toggleClass('disabled', flag);
                    });
                }
                <?php echo '</script'; ?>
>
                

                <?php $_smarty_tpl->tpl_vars["disabled_by_default"] = new Smarty_variable(false, null, 0);?>
                <div class="ty-control-group" id="company_description_admin_firstname">
                    <label for="company_admin_firstname" class="ty-control-group__title cm-required"><?php echo $_smarty_tpl->__("first_name");?>
</label>
                    <input type="text" name="company_data[admin_firstname]" id="company_admin_firstname" size="32" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['company_data']->value['admin_firstname'], ENT_QUOTES, 'UTF-8');?>
" class="ty-input-text" />
                </div>
                <div class="ty-control-group" id="company_description_admin_lastname">
                    <label for="company_admin_lastname" class="ty-control-group__title cm-required"><?php echo $_smarty_tpl->__("last_name");?>
</label>
                    <input type="text" name="company_data[admin_lastname]" id="company_admin_lastname" size="32" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['company_data']->value['admin_lastname'], ENT_QUOTES, 'UTF-8');?>
" class="ty-input-text" />
                </div>

            <?php }?>

            <?php if (!$_smarty_tpl->tpl_vars['auth']->value['user_id']) {?>
                <?php echo $_smarty_tpl->getSubTemplate ("views/profiles/components/profile_fields.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('section'=>"C",'title'=>__("contact_information"),'disabled_by_default'=>$_smarty_tpl->tpl_vars['disabled_by_default']->value), 0);?>

            <?php } else { ?>
                <?php echo $_smarty_tpl->getSubTemplate ("common/subheader.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('title'=>__("contact_information")), 0);?>

            <?php }?>

            <div class="ty-control-group">
                <label for="company_description_email" class="ty-control-group__title cm-required cm-email cm-trim"><?php echo $_smarty_tpl->__("email");?>
</label>
                <input type="text" name="company_data[email]" id="company_description_email" size="32" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['company_data']->value['email'], ENT_QUOTES, 'UTF-8');?>
" class="ty-input-text" />
            </div>

            <div class="ty-control-group">
                <label for="company_description_phone" class="ty-control-group__title cm-required"><?php echo $_smarty_tpl->__("phone");?>
</label>
                <input type="text" name="company_data[phone]" id="company_description_phone" size="32" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['company_data']->value['phone'], ENT_QUOTES, 'UTF-8');?>
" class="ty-input-text" />
            </div>

            <div class="ty-control-group">
                <label class="ty-control-group__title" for="company_description_url"><?php echo $_smarty_tpl->__("url");?>
</label>
                <input type="text" name="company_data[url]" id="company_description_url" size="32" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['company_data']->value['url'], ENT_QUOTES, 'UTF-8');?>
" class="ty-input-text" />
            </div>

            <div class="ty-control-group">
                <label class="ty-control-group__title" for="company_description_fax"><?php echo $_smarty_tpl->__("fax");?>
</label>
                <input type="text" name="company_data[fax]" id="company_description_fax" size="32" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['company_data']->value['fax'], ENT_QUOTES, 'UTF-8');?>
" class="ty-input-text" />
            </div>


            <?php if (!$_smarty_tpl->tpl_vars['auth']->value['user_id']) {?>
                <?php echo $_smarty_tpl->getSubTemplate ("views/profiles/components/profile_fields.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('section'=>"B",'title'=>__("shipping_address"),'shipping_flag'=>false,'disabled_by_default'=>$_smarty_tpl->tpl_vars['disabled_by_default']->value), 0);?>

            <?php } else { ?>
                <?php echo $_smarty_tpl->getSubTemplate ("common/subheader.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('title'=>__("shipping_address")), 0);?>

            <?php }?>

            <div class="ty-control-group">
                <label class="ty-control-group__title cm-required" for="company_address_address"><?php echo $_smarty_tpl->__("address");?>
</label>
                <input type="text" name="company_data[address]" id="company_address_address" size="32" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['company_data']->value['address'], ENT_QUOTES, 'UTF-8');?>
" class="ty-input-text" />
            </div>

            <div class="ty-control-group">
                <label class="ty-control-group__title cm-required" for="company_address_city"><?php echo $_smarty_tpl->__("city");?>
</label>
                <input type="text" name="company_data[city]" id="company_address_city" size="32" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['company_data']->value['city'], ENT_QUOTES, 'UTF-8');?>
" class="ty-input-text" />
            </div>

            <div class="ty-control-group  shipping-country">
                <label for="company_address_country" class="ty-control-group__title cm-required"><?php echo $_smarty_tpl->__("country");?>
</label>
                <?php $_smarty_tpl->tpl_vars["_country"] = new Smarty_variable((($tmp = @$_smarty_tpl->tpl_vars['company_data']->value['country'])===null||$tmp==='' ? $_smarty_tpl->tpl_vars['settings']->value['General']['default_country'] : $tmp), null, 0);?>
                <select class="cm-country cm-location-shipping" id="company_address_country" name="company_data[country]">
                    <option value="">- <?php echo $_smarty_tpl->__("select_country");?>
 -</option>
                    <?php  $_smarty_tpl->tpl_vars["country"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["country"]->_loop = false;
 $_smarty_tpl->tpl_vars["code"] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['countries']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["country"]->key => $_smarty_tpl->tpl_vars["country"]->value) {
$_smarty_tpl->tpl_vars["country"]->_loop = true;
 $_smarty_tpl->tpl_vars["code"]->value = $_smarty_tpl->tpl_vars["country"]->key;
?>
                    <option <?php if ($_smarty_tpl->tpl_vars['_country']->value==$_smarty_tpl->tpl_vars['code']->value) {?>selected="selected"<?php }?> value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['code']->value, ENT_QUOTES, 'UTF-8');?>
"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['country']->value, ENT_QUOTES, 'UTF-8');?>
</option>
                    <?php } ?>
                </select>
            </div>

            <?php $_smarty_tpl->tpl_vars['_country'] = new Smarty_variable((($tmp = @$_smarty_tpl->tpl_vars['company_data']->value['country'])===null||$tmp==='' ? $_smarty_tpl->tpl_vars['settings']->value['General']['default_country'] : $tmp), null, 0);?>
            <?php $_smarty_tpl->tpl_vars['_state'] = new Smarty_variable((($tmp = @$_smarty_tpl->tpl_vars['company_data']->value['state'])===null||$tmp==='' ? $_smarty_tpl->tpl_vars['settings']->value['General']['default_state'] : $tmp), null, 0);?>

            <div class="ty-control-group shipping-state">
                <label for="company_address_state" class="ty-control-group__title cm-required"><?php echo $_smarty_tpl->__("state");?>
</label>
                <select id="company_address_state" name="company_data[state]" class="cm-state cm-location-shipping <?php if (!$_smarty_tpl->tpl_vars['states']->value[$_smarty_tpl->tpl_vars['_country']->value]) {?>hidden<?php }?>">
                    <option value="">- <?php echo $_smarty_tpl->__("select_state");?>
 -</option>
                    <?php if ($_smarty_tpl->tpl_vars['states']->value&&$_smarty_tpl->tpl_vars['states']->value[$_smarty_tpl->tpl_vars['_country']->value]) {?>
                        <?php  $_smarty_tpl->tpl_vars['state'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['state']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['states']->value[$_smarty_tpl->tpl_vars['_country']->value]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['state']->key => $_smarty_tpl->tpl_vars['state']->value) {
$_smarty_tpl->tpl_vars['state']->_loop = true;
?>
                            <option <?php if ($_smarty_tpl->tpl_vars['_state']->value==$_smarty_tpl->tpl_vars['state']->value['code']) {?>selected="selected"<?php }?> value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['state']->value['code'], ENT_QUOTES, 'UTF-8');?>
"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['state']->value['state'], ENT_QUOTES, 'UTF-8');?>
</option>
                        <?php } ?>
                    <?php }?>
                </select>
                <input type="text" id="company_address_state_d" name="company_data[state]" size="32" maxlength="64" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['_state']->value, ENT_QUOTES, 'UTF-8');?>
" <?php if ($_smarty_tpl->tpl_vars['states']->value[$_smarty_tpl->tpl_vars['_country']->value]) {?>disabled="disabled"<?php }?> class="cm-state cm-location-shipping ty-input-text <?php if ($_smarty_tpl->tpl_vars['states']->value[$_smarty_tpl->tpl_vars['_country']->value]) {?>hidden<?php }?> cm-skip-avail-switch" />
            </div>

            <div class="ty-control-group shipping-zip-code">
                <label for="company_address_zipcode" class="ty-control-group__title cm-required cm-zipcode cm-location-shipping"><?php echo $_smarty_tpl->__("zip_postal_code");?>
</label>
                <input type="text" name="company_data[zipcode]" id="company_address_zipcode" size="32" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['company_data']->value['zipcode'], ENT_QUOTES, 'UTF-8');?>
" class="ty-input-text" />
            </div>
            <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_hook(array('name'=>"vendors:apply_fields"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>


            <?php echo $_smarty_tpl->getSubTemplate ("common/image_verification.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('option'=>"apply_for_vendor_account",'align'=>"left"), 0);?>


            <div class="buttons-container">
                <?php echo $_smarty_tpl->getSubTemplate ("buttons/button.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('but_text'=>__("submit"),'but_name'=>"dispatch[companies.apply_for_vendor]",'but_id'=>"but_apply_for_vendor",'but_meta'=>"ty-btn__primary"), 0);?>

            </div>
        </form>
    </div>
</div>
<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_hook(array('name'=>"vendors:apply_page"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);
}?><?php }} ?>
