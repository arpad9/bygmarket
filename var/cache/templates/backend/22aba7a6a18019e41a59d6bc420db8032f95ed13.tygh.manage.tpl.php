<?php /* Smarty version Smarty-3.1.21, created on 2015-09-19 00:32:45
         compiled from "/var/www/bygmarket.com/design/backend/templates/views/pages/manage.tpl" */ ?>
<?php /*%%SmartyHeaderCode:135849391655fc82fd62bf20-73715855%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '22aba7a6a18019e41a59d6bc420db8032f95ed13' => 
    array (
      0 => '/var/www/bygmarket.com/design/backend/templates/views/pages/manage.tpl',
      1 => 1441800576,
      2 => 'tygh',
    ),
  ),
  'nocache_hash' => '135849391655fc82fd62bf20-73715855',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'config' => 0,
    'search' => 0,
    'page_types' => 0,
    'hide_position' => 0,
    '_k' => 0,
    'come_from' => 0,
    '_p' => 0,
    'pages_tree' => 0,
    'is_exclusive_page_type' => 0,
    'view_type' => 0,
    'view_suffix' => 0,
    'title' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21',
  'unifunc' => 'content_55fc82fd805df7_75587796',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55fc82fd805df7_75587796')) {function content_55fc82fd805df7_75587796($_smarty_tpl) {?><?php
fn_preload_lang_vars(array('clone_selected','content'));
?>
<?php $_smarty_tpl->_capture_stack[0][] = array("mainbox", null, null); ob_start(); ?>

<form action="<?php echo htmlspecialchars(fn_url(''), ENT_QUOTES, 'UTF-8');?>
" method="post" name="pages_tree_form" id="pages_tree_form">
<input type="hidden" name="redirect_url" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['config']->value['current_url'], ENT_QUOTES, 'UTF-8');?>
" />

<?php if ($_smarty_tpl->tpl_vars['search']->value['page_type']) {?>
<input type="hidden" name="page_type" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['search']->value['page_type'], ENT_QUOTES, 'UTF-8');?>
" />
<?php }?>

<?php if ($_smarty_tpl->tpl_vars['page_types']->value[$_smarty_tpl->tpl_vars['search']->value['page_type']]['hide_fields']&&$_smarty_tpl->tpl_vars['page_types']->value[$_smarty_tpl->tpl_vars['search']->value['page_type']]['hide_fields']['position']) {?>
    <?php $_smarty_tpl->tpl_vars['hide_position'] = new Smarty_variable(true, null, 0);?>
<?php }?>

<?php $_smarty_tpl->tpl_vars["come_from"] = new Smarty_variable($_smarty_tpl->tpl_vars['search']->value['page_type'], null, 0);?>
<?php echo $_smarty_tpl->getSubTemplate ("common/pagination.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('save_current_page'=>true,'save_current_url'=>true,'div_id'=>$_REQUEST['content_id'],'hide_position'=>$_smarty_tpl->tpl_vars['hide_position']->value), 0);?>


<div class="items-container multi-level">
    <?php echo $_smarty_tpl->getSubTemplate ("views/pages/components/pages_tree.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('header'=>true,'combination_suffix'=>"_list"), 0);?>

</div>

<?php echo $_smarty_tpl->getSubTemplate ("common/pagination.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('div_id'=>$_REQUEST['content_id']), 0);?>


<?php $_smarty_tpl->tpl_vars["rev"] = new Smarty_variable((($tmp = @$_REQUEST['content_id'])===null||$tmp==='' ? "pagination_contents" : $tmp), null, 0);?>

<?php $_smarty_tpl->_capture_stack[0][] = array("adv_buttons", null, null); ob_start(); ?>
    <?php if (sizeof($_smarty_tpl->tpl_vars['page_types']->value)==1) {?>
        <?php  $_smarty_tpl->tpl_vars["_p"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["_p"]->_loop = false;
 $_smarty_tpl->tpl_vars["_k"] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['page_types']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["_p"]->key => $_smarty_tpl->tpl_vars["_p"]->value) {
$_smarty_tpl->tpl_vars["_p"]->_loop = true;
 $_smarty_tpl->tpl_vars["_k"]->value = $_smarty_tpl->tpl_vars["_p"]->key;
?>
            <?php echo $_smarty_tpl->getSubTemplate ("common/tools.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('tool_href'=>"pages.add?page_type=".((string)$_smarty_tpl->tpl_vars['_k']->value)."&come_from=".((string)$_smarty_tpl->tpl_vars['come_from']->value),'prefix'=>"top",'title'=>__($_smarty_tpl->tpl_vars['_p']->value['add_name']),'hide_tools'=>true,'icon'=>"icon-plus"), 0);?>

        <?php } ?>
    <?php } else { ?>
        <?php $_smarty_tpl->_capture_stack[0][] = array("tools_list", null, null); ob_start(); ?>
            <?php  $_smarty_tpl->tpl_vars["_p"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["_p"]->_loop = false;
 $_smarty_tpl->tpl_vars["_k"] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['page_types']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["_p"]->key => $_smarty_tpl->tpl_vars["_p"]->value) {
$_smarty_tpl->tpl_vars["_p"]->_loop = true;
 $_smarty_tpl->tpl_vars["_k"]->value = $_smarty_tpl->tpl_vars["_p"]->key;
?>
                <li><?php smarty_template_function_btn($_smarty_tpl,array('type'=>"list",'text'=>__($_smarty_tpl->tpl_vars['_p']->value['add_name']),'href'=>"pages.add?page_type=".((string)$_smarty_tpl->tpl_vars['_k']->value)."&come_from=".((string)$_smarty_tpl->tpl_vars['come_from']->value)));?>
</li>
            <?php } ?>
        <?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>
        <?php smarty_template_function_dropdown($_smarty_tpl,array('content'=>Smarty::$_smarty_vars['capture']['tools_list'],'icon'=>"icon-plus",'no_caret'=>true,'placement'=>"right"));?>

    <?php }?>
<?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>

<?php $_smarty_tpl->_capture_stack[0][] = array("buttons", null, null); ob_start(); ?>
    <?php if ($_smarty_tpl->tpl_vars['pages_tree']->value) {?>
        <?php $_smarty_tpl->_capture_stack[0][] = array("tools_list", null, null); ob_start(); ?>
            <li><?php smarty_template_function_btn($_smarty_tpl,array('type'=>"list",'text'=>__("clone_selected"),'dispatch'=>"dispatch[pages.m_clone]",'form'=>"pages_tree_form"));?>
</li>
            <li><?php smarty_template_function_btn($_smarty_tpl,array('type'=>"delete_selected",'dispatch'=>"dispatch[pages.m_delete]",'form'=>"pages_tree_form"));?>
</li>
        <?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>
        <?php smarty_template_function_dropdown($_smarty_tpl,array('content'=>Smarty::$_smarty_vars['capture']['tools_list']));?>

        <?php echo $_smarty_tpl->getSubTemplate ("buttons/save.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('but_name'=>"dispatch[pages.m_update]",'but_role'=>"submit-button",'but_target_form'=>"pages_tree_form"), 0);?>

    <?php }?>
<?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>
</form>
<?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>

<?php if ($_smarty_tpl->tpl_vars['is_exclusive_page_type']->value) {?>
    <?php $_smarty_tpl->tpl_vars['title'] = new Smarty_variable($_smarty_tpl->__($_smarty_tpl->tpl_vars['page_types']->value[$_smarty_tpl->tpl_vars['search']->value['page_type']]['content']), null, 0);?>
    <?php $_smarty_tpl->tpl_vars['view_type'] = new Smarty_variable("pages_".((string)$_smarty_tpl->tpl_vars['search']->value['page_type']), null, 0);?>
    <?php $_smarty_tpl->tpl_vars['view_suffix'] = new Smarty_variable("page_type=".((string)$_smarty_tpl->tpl_vars['search']->value['page_type'])."&get_tree=multi_level", null, 0);?>
<?php } else { ?>
    <?php $_smarty_tpl->tpl_vars['title'] = new Smarty_variable($_smarty_tpl->__("content"), null, 0);?>
    <?php $_smarty_tpl->tpl_vars['view_type'] = new Smarty_variable("pages", null, 0);?>
    <?php $_smarty_tpl->tpl_vars['view_suffix'] = new Smarty_variable('', null, 0);?>
<?php }?>

<?php $_smarty_tpl->_capture_stack[0][] = array("sidebar", null, null); ob_start(); ?>
    <?php echo $_smarty_tpl->getSubTemplate ("common/saved_search.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('dispatch'=>"pages.manage",'view_type'=>$_smarty_tpl->tpl_vars['view_type']->value,'view_suffix'=>$_smarty_tpl->tpl_vars['view_suffix']->value), 0);?>

    <?php echo $_smarty_tpl->getSubTemplate ("views/pages/components/pages_search_form.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('dispatch'=>"pages.manage",'view_type'=>$_smarty_tpl->tpl_vars['view_type']->value), 0);?>

<?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>


<?php echo $_smarty_tpl->getSubTemplate ("common/mainbox.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('title'=>$_smarty_tpl->tpl_vars['title']->value,'content'=>Smarty::$_smarty_vars['capture']['mainbox'],'buttons'=>Smarty::$_smarty_vars['capture']['buttons'],'adv_buttons'=>Smarty::$_smarty_vars['capture']['adv_buttons'],'sidebar'=>Smarty::$_smarty_vars['capture']['sidebar'],'content_id'=>"manage_pages"), 0);?>
<?php }} ?>
