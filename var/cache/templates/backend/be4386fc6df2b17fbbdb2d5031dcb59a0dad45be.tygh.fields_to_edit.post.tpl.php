<?php /* Smarty version Smarty-3.1.21, created on 2015-09-19 01:54:29
         compiled from "/var/www/bygmarket.com/design/backend/templates/addons/discussion/hooks/categories/fields_to_edit.post.tpl" */ ?>
<?php /*%%SmartyHeaderCode:174290259655fc9625ab7c04-60158712%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'be4386fc6df2b17fbbdb2d5031dcb59a0dad45be' => 
    array (
      0 => '/var/www/bygmarket.com/design/backend/templates/addons/discussion/hooks/categories/fields_to_edit.post.tpl',
      1 => 1441800576,
      2 => 'tygh',
    ),
  ),
  'nocache_hash' => '174290259655fc9625ab7c04-60158712',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21',
  'unifunc' => 'content_55fc9625aed619_85248238',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55fc9625aed619_85248238')) {function content_55fc9625aed619_85248238($_smarty_tpl) {?><?php
fn_preload_lang_vars(array('discussion_title_category'));
?>
<label for="discussion_type" class="checkbox">
<input type="checkbox" value="discussion_type" id="discussion_type" name="selected_fields[extra][]" checked="checked" class="cm-item-s" />
<?php echo $_smarty_tpl->__("discussion_title_category");?>
</label>
<?php }} ?>
