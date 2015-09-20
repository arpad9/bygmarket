<?php /* Smarty version Smarty-3.1.21, created on 2015-09-18 21:27:19
         compiled from "/var/www/bygmarket.com/design/themes/responsive/templates/blocks/products/products_small_items.tpl" */ ?>
<?php /*%%SmartyHeaderCode:124677924055fc57872f21d7-49922452%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4244378962c746715bc36cb57e56b98f8757dc4e' => 
    array (
      0 => '/var/www/bygmarket.com/design/themes/responsive/templates/blocks/products/products_small_items.tpl',
      1 => 1442595889,
      2 => 'tygh',
    ),
  ),
  'nocache_hash' => '124677924055fc57872f21d7-49922452',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'runtime' => 0,
    'block' => 0,
    'items' => 0,
    '_show_name' => 0,
    '_show_trunc_name' => 0,
    '_show_add_to_cart' => 0,
    'auth' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21',
  'unifunc' => 'content_55fc57873613a7_99676435',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55fc57873613a7_99676435')) {function content_55fc57873613a7_99676435($_smarty_tpl) {?><?php if (!is_callable('smarty_function_set_id')) include '/var/www/bygmarket.com/app/functions/smarty_plugins/function.set_id.php';
?><?php if ($_smarty_tpl->tpl_vars['runtime']->value['customization_mode']['design']=="Y"&&@constant('AREA')=="C") {
$_smarty_tpl->_capture_stack[0][] = array("template_content", null, null); ob_start(); ?>

<?php if ($_smarty_tpl->tpl_vars['block']->value['properties']['hide_add_to_cart_button']=="Y") {?>
    <?php $_smarty_tpl->tpl_vars["_show_add_to_cart"] = new Smarty_variable(false, null, 0);?>
<?php } else { ?>
    <?php $_smarty_tpl->tpl_vars["_show_add_to_cart"] = new Smarty_variable(true, null, 0);?>
<?php }?>

<?php $_smarty_tpl->tpl_vars["_show_name"] = new Smarty_variable("true", null, 0);?>

<?php echo $_smarty_tpl->getSubTemplate ("blocks/list_templates/small_items.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('products'=>$_smarty_tpl->tpl_vars['items']->value,'obj_prefix'=>((string)$_smarty_tpl->tpl_vars['block']->value['block_id'])."000",'item_number'=>$_smarty_tpl->tpl_vars['block']->value['properties']['item_number'],'show_name'=>$_smarty_tpl->tpl_vars['_show_name']->value,'show_trunc_name'=>$_smarty_tpl->tpl_vars['_show_trunc_name']->value,'show_price'=>false,'show_rating'=>true,'show_add_to_cart'=>$_smarty_tpl->tpl_vars['_show_add_to_cart']->value,'show_list_buttons'=>false,'add_to_cart_meta'=>"text-button-add",'but_role'=>"text"), 0);?>

<?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();
if (trim(Smarty::$_smarty_vars['capture']['template_content'])) {
if ($_smarty_tpl->tpl_vars['auth']->value['area']=="A") {?><span class="cm-template-box template-box" data-ca-te-template="blocks/products/products_small_items.tpl" id="<?php echo smarty_function_set_id(array('name'=>"blocks/products/products_small_items.tpl"),$_smarty_tpl);?>
"><div class="cm-template-icon icon-edit ty-icon-edit hidden"></div><?php echo Smarty::$_smarty_vars['capture']['template_content'];?>
<!--[/tpl_id]--></span><?php } else {
echo Smarty::$_smarty_vars['capture']['template_content'];
}
}
} else { ?>

<?php if ($_smarty_tpl->tpl_vars['block']->value['properties']['hide_add_to_cart_button']=="Y") {?>
    <?php $_smarty_tpl->tpl_vars["_show_add_to_cart"] = new Smarty_variable(false, null, 0);?>
<?php } else { ?>
    <?php $_smarty_tpl->tpl_vars["_show_add_to_cart"] = new Smarty_variable(true, null, 0);?>
<?php }?>

<?php $_smarty_tpl->tpl_vars["_show_name"] = new Smarty_variable("true", null, 0);?>

<?php echo $_smarty_tpl->getSubTemplate ("blocks/list_templates/small_items.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('products'=>$_smarty_tpl->tpl_vars['items']->value,'obj_prefix'=>((string)$_smarty_tpl->tpl_vars['block']->value['block_id'])."000",'item_number'=>$_smarty_tpl->tpl_vars['block']->value['properties']['item_number'],'show_name'=>$_smarty_tpl->tpl_vars['_show_name']->value,'show_trunc_name'=>$_smarty_tpl->tpl_vars['_show_trunc_name']->value,'show_price'=>false,'show_rating'=>true,'show_add_to_cart'=>$_smarty_tpl->tpl_vars['_show_add_to_cart']->value,'show_list_buttons'=>false,'add_to_cart_meta'=>"text-button-add",'but_role'=>"text"), 0);?>

<?php }?><?php }} ?>
