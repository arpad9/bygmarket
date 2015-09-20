<?php /* Smarty version Smarty-3.1.21, created on 2015-09-18 21:44:15
         compiled from "/var/www/bygmarket.com/design/themes/responsive/templates/addons/discussion/hooks/companies/data_block.pre.tpl" */ ?>
<?php /*%%SmartyHeaderCode:91654955155fc5b7fafddc3-61457532%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e2a2368093aa5418898a189afb6368d368b8ff23' => 
    array (
      0 => '/var/www/bygmarket.com/design/themes/responsive/templates/addons/discussion/hooks/companies/data_block.pre.tpl',
      1 => 1442595913,
      2 => 'tygh',
    ),
  ),
  'nocache_hash' => '91654955155fc5b7fafddc3-61457532',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'runtime' => 0,
    'show_rating' => 0,
    'company' => 0,
    'average_rating' => 0,
    'auth' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21',
  'unifunc' => 'content_55fc5b7fb518b3_36163794',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55fc5b7fb518b3_36163794')) {function content_55fc5b7fb518b3_36163794($_smarty_tpl) {?><?php if (!is_callable('smarty_function_set_id')) include '/var/www/bygmarket.com/app/functions/smarty_plugins/function.set_id.php';
?><?php if ($_smarty_tpl->tpl_vars['runtime']->value['customization_mode']['design']=="Y"&&@constant('AREA')=="C") {
$_smarty_tpl->_capture_stack[0][] = array("template_content", null, null); ob_start();
if ($_smarty_tpl->tpl_vars['show_rating']->value) {?>

<?php if ($_smarty_tpl->tpl_vars['company']->value['average_rating']) {?>
    <?php $_smarty_tpl->tpl_vars['average_rating'] = new Smarty_variable($_smarty_tpl->tpl_vars['company']->value['average_rating'], null, 0);?>
<?php } elseif ($_smarty_tpl->tpl_vars['company']->value['discussion']['average_rating']) {?>
    <?php $_smarty_tpl->tpl_vars['average_rating'] = new Smarty_variable($_smarty_tpl->tpl_vars['company']->value['discussion']['average_rating'], null, 0);?>
<?php }?>

<?php if ($_smarty_tpl->tpl_vars['average_rating']->value) {?>
<?php echo $_smarty_tpl->getSubTemplate ("addons/discussion/views/discussion/components/stars.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('stars'=>fn_get_discussion_rating($_smarty_tpl->tpl_vars['average_rating']->value),'is_link'=>true), 0);?>

<?php }?>

<?php }
list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();
if (trim(Smarty::$_smarty_vars['capture']['template_content'])) {
if ($_smarty_tpl->tpl_vars['auth']->value['area']=="A") {?><span class="cm-template-box template-box" data-ca-te-template="addons/discussion/hooks/companies/data_block.pre.tpl" id="<?php echo smarty_function_set_id(array('name'=>"addons/discussion/hooks/companies/data_block.pre.tpl"),$_smarty_tpl);?>
"><div class="cm-template-icon icon-edit ty-icon-edit hidden"></div><?php echo Smarty::$_smarty_vars['capture']['template_content'];?>
<!--[/tpl_id]--></span><?php } else {
echo Smarty::$_smarty_vars['capture']['template_content'];
}
}
} else {
if ($_smarty_tpl->tpl_vars['show_rating']->value) {?>

<?php if ($_smarty_tpl->tpl_vars['company']->value['average_rating']) {?>
    <?php $_smarty_tpl->tpl_vars['average_rating'] = new Smarty_variable($_smarty_tpl->tpl_vars['company']->value['average_rating'], null, 0);?>
<?php } elseif ($_smarty_tpl->tpl_vars['company']->value['discussion']['average_rating']) {?>
    <?php $_smarty_tpl->tpl_vars['average_rating'] = new Smarty_variable($_smarty_tpl->tpl_vars['company']->value['discussion']['average_rating'], null, 0);?>
<?php }?>

<?php if ($_smarty_tpl->tpl_vars['average_rating']->value) {?>
<?php echo $_smarty_tpl->getSubTemplate ("addons/discussion/views/discussion/components/stars.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('stars'=>fn_get_discussion_rating($_smarty_tpl->tpl_vars['average_rating']->value),'is_link'=>true), 0);?>

<?php }?>

<?php }
}?><?php }} ?>
