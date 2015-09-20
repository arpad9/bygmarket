<?php /* Smarty version Smarty-3.1.21, created on 2015-09-18 21:44:02
         compiled from "/var/www/bygmarket.com/design/themes/responsive/templates/blocks/vendors/vendor_information.tpl" */ ?>
<?php /*%%SmartyHeaderCode:182521225455fc5b726f3b65-01101820%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '63075d40faf6ed0a13f901e6fb25da4b435549d8' => 
    array (
      0 => '/var/www/bygmarket.com/design/themes/responsive/templates/blocks/vendors/vendor_information.tpl',
      1 => 1442595889,
      2 => 'tygh',
    ),
  ),
  'nocache_hash' => '182521225455fc5b726f3b65-01101820',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'runtime' => 0,
    'vendor_info' => 0,
    'auth' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21',
  'unifunc' => 'content_55fc5b72728100_04364723',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55fc5b72728100_04364723')) {function content_55fc5b72728100_04364723($_smarty_tpl) {?><?php if (!is_callable('smarty_function_set_id')) include '/var/www/bygmarket.com/app/functions/smarty_plugins/function.set_id.php';
?><?php if ($_smarty_tpl->tpl_vars['runtime']->value['customization_mode']['design']=="Y"&&@constant('AREA')=="C") {
$_smarty_tpl->_capture_stack[0][] = array("template_content", null, null); ob_start(); ?>

<div class="ty-vendor-information">
    <span><a href="<?php echo htmlspecialchars(fn_url("companies.view?company_id=".((string)$_smarty_tpl->tpl_vars['vendor_info']->value['company_id'])), ENT_QUOTES, 'UTF-8');?>
"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['vendor_info']->value['company'], ENT_QUOTES, 'UTF-8');?>
</a></span>
    <span><?php echo $_smarty_tpl->tpl_vars['vendor_info']->value['company_description'];?>
</span>
</div><?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();
if (trim(Smarty::$_smarty_vars['capture']['template_content'])) {
if ($_smarty_tpl->tpl_vars['auth']->value['area']=="A") {?><span class="cm-template-box template-box" data-ca-te-template="blocks/vendors/vendor_information.tpl" id="<?php echo smarty_function_set_id(array('name'=>"blocks/vendors/vendor_information.tpl"),$_smarty_tpl);?>
"><div class="cm-template-icon icon-edit ty-icon-edit hidden"></div><?php echo Smarty::$_smarty_vars['capture']['template_content'];?>
<!--[/tpl_id]--></span><?php } else {
echo Smarty::$_smarty_vars['capture']['template_content'];
}
}
} else { ?>

<div class="ty-vendor-information">
    <span><a href="<?php echo htmlspecialchars(fn_url("companies.view?company_id=".((string)$_smarty_tpl->tpl_vars['vendor_info']->value['company_id'])), ENT_QUOTES, 'UTF-8');?>
"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['vendor_info']->value['company'], ENT_QUOTES, 'UTF-8');?>
</a></span>
    <span><?php echo $_smarty_tpl->tpl_vars['vendor_info']->value['company_description'];?>
</span>
</div><?php }?><?php }} ?>
