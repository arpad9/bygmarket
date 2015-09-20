<?php /* Smarty version Smarty-3.1.21, created on 2015-09-18 21:28:49
         compiled from "/var/www/bygmarket.com/design/themes/responsive/templates/views/product_features/view_all.tpl" */ ?>
<?php /*%%SmartyHeaderCode:27075521055fc57e1038d41-46043624%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4e851c2e009302f4e33c306fee743f6341e441bd' => 
    array (
      0 => '/var/www/bygmarket.com/design/themes/responsive/templates/views/product_features/view_all.tpl',
      1 => 1442595889,
      2 => 'tygh',
    ),
  ),
  'nocache_hash' => '27075521055fc57e1038d41-46043624',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'runtime' => 0,
    'variants' => 0,
    'size' => 0,
    'splitted_filter' => 0,
    'group' => 0,
    'ranges' => 0,
    'index' => 0,
    'range' => 0,
    'auth' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21',
  'unifunc' => 'content_55fc57e1113e90_99035406',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55fc57e1113e90_99035406')) {function content_55fc57e1113e90_99035406($_smarty_tpl) {?><?php if (!is_callable('smarty_function_split')) include '/var/www/bygmarket.com/app/functions/smarty_plugins/function.split.php';
if (!is_callable('smarty_function_set_id')) include '/var/www/bygmarket.com/app/functions/smarty_plugins/function.set_id.php';
?><?php if ($_smarty_tpl->tpl_vars['runtime']->value['customization_mode']['design']=="Y"&&@constant('AREA')=="C") {
$_smarty_tpl->_capture_stack[0][] = array("template_content", null, null); ob_start();
if ($_smarty_tpl->tpl_vars['variants']->value) {?>
<?php $_smarty_tpl->tpl_vars['size'] = new Smarty_variable(4, null, 0);?>
<?php echo smarty_function_split(array('data'=>$_smarty_tpl->tpl_vars['variants']->value,'size'=>$_smarty_tpl->tpl_vars['size']->value,'assign'=>"splitted_filter",'preverse_keys'=>true),$_smarty_tpl);?>


<div class="ty-features-all">
<?php  $_smarty_tpl->tpl_vars["group"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["group"]->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['splitted_filter']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["group"]->key => $_smarty_tpl->tpl_vars["group"]->value) {
$_smarty_tpl->tpl_vars["group"]->_loop = true;
?>
    <?php  $_smarty_tpl->tpl_vars["ranges"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["ranges"]->_loop = false;
 $_smarty_tpl->tpl_vars["index"] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['group']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["ranges"]->key => $_smarty_tpl->tpl_vars["ranges"]->value) {
$_smarty_tpl->tpl_vars["ranges"]->_loop = true;
 $_smarty_tpl->tpl_vars["index"]->value = $_smarty_tpl->tpl_vars["ranges"]->key;
?>
    <div class="ty-features-all__group ty-column6"><?php if ($_smarty_tpl->tpl_vars['ranges']->value) {
echo $_smarty_tpl->getSubTemplate ("common/subheader.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('title'=>$_smarty_tpl->tpl_vars['index']->value), 0);?>
<ul class="ty-features-all__list"><?php  $_smarty_tpl->tpl_vars["range"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["range"]->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['ranges']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["range"]->key => $_smarty_tpl->tpl_vars["range"]->value) {
$_smarty_tpl->tpl_vars["range"]->_loop = true;
?><li class="ty-features-all__list-item"><a href="<?php echo htmlspecialchars(fn_url("product_features.view?variant_id=".((string)$_smarty_tpl->tpl_vars['range']->value['variant_id'])), ENT_QUOTES, 'UTF-8');?>
" class="ty-features-all__list-a"><?php echo htmlspecialchars(fn_text_placeholders($_smarty_tpl->tpl_vars['range']->value['variant']), ENT_QUOTES, 'UTF-8');?>
</a></li><?php } ?></ul><?php } else { ?>&nbsp;<?php }?></div><?php }
} ?></div><?php }
list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();
if (trim(Smarty::$_smarty_vars['capture']['template_content'])) {
if ($_smarty_tpl->tpl_vars['auth']->value['area']=="A") {?><span class="cm-template-box template-box" data-ca-te-template="views/product_features/view_all.tpl" id="<?php echo smarty_function_set_id(array('name'=>"views/product_features/view_all.tpl"),$_smarty_tpl);?>
"><div class="cm-template-icon icon-edit ty-icon-edit hidden"></div><?php echo Smarty::$_smarty_vars['capture']['template_content'];?>
<!--[/tpl_id]--></span><?php } else {
echo Smarty::$_smarty_vars['capture']['template_content'];
}
}
} else {
if ($_smarty_tpl->tpl_vars['variants']->value) {
$_smarty_tpl->tpl_vars['size'] = new Smarty_variable(4, null, 0);
echo smarty_function_split(array('data'=>$_smarty_tpl->tpl_vars['variants']->value,'size'=>$_smarty_tpl->tpl_vars['size']->value,'assign'=>"splitted_filter",'preverse_keys'=>true),$_smarty_tpl);?>
<div class="ty-features-all"><?php  $_smarty_tpl->tpl_vars["group"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["group"]->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['splitted_filter']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["group"]->key => $_smarty_tpl->tpl_vars["group"]->value) {
$_smarty_tpl->tpl_vars["group"]->_loop = true;
$_smarty_tpl->tpl_vars["ranges"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["ranges"]->_loop = false;
 $_smarty_tpl->tpl_vars["index"] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['group']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["ranges"]->key => $_smarty_tpl->tpl_vars["ranges"]->value) {
$_smarty_tpl->tpl_vars["ranges"]->_loop = true;
 $_smarty_tpl->tpl_vars["index"]->value = $_smarty_tpl->tpl_vars["ranges"]->key;
?><div class="ty-features-all__group ty-column6"><?php if ($_smarty_tpl->tpl_vars['ranges']->value) {
echo $_smarty_tpl->getSubTemplate ("common/subheader.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('title'=>$_smarty_tpl->tpl_vars['index']->value), 0);?>
<ul class="ty-features-all__list"><?php  $_smarty_tpl->tpl_vars["range"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["range"]->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['ranges']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["range"]->key => $_smarty_tpl->tpl_vars["range"]->value) {
$_smarty_tpl->tpl_vars["range"]->_loop = true;
?><li class="ty-features-all__list-item"><a href="<?php echo htmlspecialchars(fn_url("product_features.view?variant_id=".((string)$_smarty_tpl->tpl_vars['range']->value['variant_id'])), ENT_QUOTES, 'UTF-8');?>
" class="ty-features-all__list-a"><?php echo htmlspecialchars(fn_text_placeholders($_smarty_tpl->tpl_vars['range']->value['variant']), ENT_QUOTES, 'UTF-8');?>
</a></li><?php } ?></ul><?php } else { ?>&nbsp;<?php }?></div><?php }
} ?></div><?php }
}?><?php }} ?>
