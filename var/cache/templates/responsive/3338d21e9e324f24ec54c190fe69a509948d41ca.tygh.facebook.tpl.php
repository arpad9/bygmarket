<?php /* Smarty version Smarty-3.1.21, created on 2015-09-18 21:27:06
         compiled from "/var/www/bygmarket.com/design/themes/responsive/templates/addons/social_buttons/meta_templates/facebook.tpl" */ ?>
<?php /*%%SmartyHeaderCode:191890090055fc577a21cde8-92991723%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3338d21e9e324f24ec54c190fe69a509948d41ca' => 
    array (
      0 => '/var/www/bygmarket.com/design/themes/responsive/templates/addons/social_buttons/meta_templates/facebook.tpl',
      1 => 1442595896,
      2 => 'tygh',
    ),
  ),
  'nocache_hash' => '191890090055fc577a21cde8-92991723',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'runtime' => 0,
    'provider_meta_data' => 0,
    'auth' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21',
  'unifunc' => 'content_55fc577a299131_78442352',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55fc577a299131_78442352')) {function content_55fc577a299131_78442352($_smarty_tpl) {?><?php if (!is_callable('smarty_function_set_id')) include '/var/www/bygmarket.com/app/functions/smarty_plugins/function.set_id.php';
?><?php if ($_smarty_tpl->tpl_vars['runtime']->value['customization_mode']['design']=="Y"&&@constant('AREA')=="C") {
$_smarty_tpl->_capture_stack[0][] = array("template_content", null, null); ob_start();
if ($_smarty_tpl->tpl_vars['provider_meta_data']->value['facebook']) {?>
    <meta property="og:type" content="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['provider_meta_data']->value['facebook']['type'], ENT_QUOTES, 'UTF-8');?>
" />
<?php }?>
<?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();
if (trim(Smarty::$_smarty_vars['capture']['template_content'])) {
if ($_smarty_tpl->tpl_vars['auth']->value['area']=="A") {?><span class="cm-template-box template-box" data-ca-te-template="addons/social_buttons/meta_templates/facebook.tpl" id="<?php echo smarty_function_set_id(array('name'=>"addons/social_buttons/meta_templates/facebook.tpl"),$_smarty_tpl);?>
"><div class="cm-template-icon icon-edit ty-icon-edit hidden"></div><?php echo Smarty::$_smarty_vars['capture']['template_content'];?>
<!--[/tpl_id]--></span><?php } else {
echo Smarty::$_smarty_vars['capture']['template_content'];
}
}
} else {
if ($_smarty_tpl->tpl_vars['provider_meta_data']->value['facebook']) {?>
    <meta property="og:type" content="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['provider_meta_data']->value['facebook']['type'], ENT_QUOTES, 'UTF-8');?>
" />
<?php }?>
<?php }?><?php }} ?>
