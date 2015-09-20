<?php /* Smarty version Smarty-3.1.21, created on 2015-09-18 20:26:38
         compiled from "/var/www/bygmarket.com/design/backend/templates/common/tooltip.tpl" */ ?>
<?php /*%%SmartyHeaderCode:199287967955fc494e8c2984-64693499%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '00bf73a178dff4c00797df4642e6085e9a125aa6' => 
    array (
      0 => '/var/www/bygmarket.com/design/backend/templates/common/tooltip.tpl',
      1 => 1441800576,
      2 => 'tygh',
    ),
  ),
  'nocache_hash' => '199287967955fc494e8c2984-64693499',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'tooltip' => 0,
    'params' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21',
  'unifunc' => 'content_55fc494e902dd7_11025131',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55fc494e902dd7_11025131')) {function content_55fc494e902dd7_11025131($_smarty_tpl) {?>&nbsp;<?php if ($_smarty_tpl->tpl_vars['tooltip']->value) {?><a class="cm-tooltip<?php if ($_smarty_tpl->tpl_vars['params']->value) {?> <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['params']->value, ENT_QUOTES, 'UTF-8');
}?>" title="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['tooltip']->value, ENT_QUOTES, 'UTF-8');?>
"><i class="icon-question-sign"></i></a><?php }?><?php }} ?>
