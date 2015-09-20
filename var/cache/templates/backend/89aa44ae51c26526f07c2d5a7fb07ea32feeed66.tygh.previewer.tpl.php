<?php /* Smarty version Smarty-3.1.21, created on 2015-09-19 02:17:58
         compiled from "/var/www/bygmarket.com/design/backend/templates/common/previewer.tpl" */ ?>
<?php /*%%SmartyHeaderCode:4767799655fc9ba65f6931-99487167%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '89aa44ae51c26526f07c2d5a7fb07ea32feeed66' => 
    array (
      0 => '/var/www/bygmarket.com/design/backend/templates/common/previewer.tpl',
      1 => 1441800576,
      2 => 'tygh',
    ),
  ),
  'nocache_hash' => '4767799655fc9ba65f6931-99487167',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'settings' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21',
  'unifunc' => 'content_55fc9ba65fe4b2_11666565',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55fc9ba65fe4b2_11666565')) {function content_55fc9ba65fe4b2_11666565($_smarty_tpl) {?><?php if (!is_callable('smarty_function_script')) include '/var/www/bygmarket.com/app/functions/smarty_plugins/function.script.php';
?><?php echo smarty_function_script(array('src'=>"js/tygh/previewers/".((string)$_smarty_tpl->tpl_vars['settings']->value['Appearance']['default_image_previewer']).".previewer.js"),$_smarty_tpl);?>
<?php }} ?>
