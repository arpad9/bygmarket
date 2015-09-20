<?php /* Smarty version Smarty-3.1.21, created on 2015-09-19 01:54:54
         compiled from "/var/www/bygmarket.com/design/backend/templates/views/block_manager/render/block.tpl" */ ?>
<?php /*%%SmartyHeaderCode:148180113355fc963e1d59f6-34262768%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1d23d8e46fc76aa9877f227e425fd8ffbee9fc3f' => 
    array (
      0 => '/var/www/bygmarket.com/design/backend/templates/views/block_manager/render/block.tpl',
      1 => 1441800576,
      2 => 'tygh',
    ),
  ),
  'nocache_hash' => '148180113355fc963e1d59f6-34262768',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'block_data' => 0,
    'dynamic_object' => 0,
    'status' => 0,
    'action' => 0,
    'location' => 0,
    'default_class' => 0,
    'parent_grid' => 0,
    'external_render' => 0,
    'external_id' => 0,
    'show_for_location' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21',
  'unifunc' => 'content_55fc963e2dd7a7_07865790',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55fc963e2dd7a7_07865790')) {function content_55fc963e2dd7a7_07865790($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_replace')) include '/var/www/bygmarket.com/app/lib/vendor/smarty/smarty/libs/plugins/modifier.replace.php';
?><?php
fn_preload_lang_vars(array('disable','enable','bm_confirm','block_options','enable_or_disable_block','block_settings','delete_block','add_grid_block','block_options','delete_block','on_off'));
?>
<?php if ($_smarty_tpl->tpl_vars['block_data']->value) {?>
    <?php if ($_smarty_tpl->tpl_vars['block_data']->value['status']) {
$_smarty_tpl->tpl_vars["status"] = new Smarty_variable($_smarty_tpl->tpl_vars['block_data']->value['status'], null, 0);
} else {
$_smarty_tpl->tpl_vars["status"] = new Smarty_variable("A", null, 0);
}
if (!$_smarty_tpl->tpl_vars['dynamic_object']->value&&$_smarty_tpl->tpl_vars['block_data']->value['items_count']>0) {
$_smarty_tpl->_capture_stack[0][] = array("confirm_message", null, null); ob_start();
if ($_smarty_tpl->tpl_vars['status']->value=='A') {
$_smarty_tpl->tpl_vars["action"] = new Smarty_variable(mb_strtolower($_smarty_tpl->__("disable"), 'UTF-8'), null, 0);
} else {
$_smarty_tpl->tpl_vars["action"] = new Smarty_variable(mb_strtolower($_smarty_tpl->__("enable"), 'UTF-8'), null, 0);
}?><span class="confirm-message hidden"><?php echo $_smarty_tpl->__("bm_confirm",array("[action]"=>$_smarty_tpl->tpl_vars['action']->value,"[location_name]"=>$_smarty_tpl->tpl_vars['location']->value['name']));?>
</span><?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();
}?><div class="<?php echo htmlspecialchars((($tmp = @$_smarty_tpl->tpl_vars['default_class']->value)===null||$tmp==='' ? "block" : $tmp), ENT_QUOTES, 'UTF-8');?>
 <?php if ($_smarty_tpl->tpl_vars['status']->value!="A") {?>block-off<?php }?> <?php if ($_smarty_tpl->tpl_vars['parent_grid']->value['content_align']=='RIGHT') {?>pull-right<?php } elseif ($_smarty_tpl->tpl_vars['parent_grid']->value['content_align']=='LEFT') {?>pull-left<?php }
if ($_smarty_tpl->tpl_vars['external_render']->value) {?> bm-external-render<?php }?>" id="snapping_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['block_data']->value['snapping_id'], ENT_QUOTES, 'UTF-8');
if ($_smarty_tpl->tpl_vars['external_render']->value) {
echo htmlspecialchars($_smarty_tpl->tpl_vars['block_data']->value['block_id'], ENT_QUOTES, 'UTF-8');?>
_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['external_id']->value, ENT_QUOTES, 'UTF-8');
}?>" <?php if ($_smarty_tpl->tpl_vars['status']->value!="A") {?>data-ca-status="disabled"<?php } else { ?>data-ca-status="active"<?php }?> data-block-id="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['block_data']->value['block_id'], ENT_QUOTES, 'UTF-8');?>
"><div class="block-header" title="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['block_data']->value['name'], ENT_QUOTES, 'UTF-8');?>
"><div class="block-header-icon <?php if ($_smarty_tpl->tpl_vars['block_data']->value['type']) {?>bmicon-<?php echo htmlspecialchars(smarty_modifier_replace($_smarty_tpl->tpl_vars['block_data']->value['type'],"_","-"), ENT_QUOTES, 'UTF-8');
}?>" <?php if ($_smarty_tpl->tpl_vars['parent_grid']->value['width']==1) {?>hidden<?php }?>></div><h4 class="block-header-title <?php if ($_smarty_tpl->tpl_vars['show_for_location']->value&&$_smarty_tpl->tpl_vars['block_data']->value['location']!=$_smarty_tpl->tpl_vars['show_for_location']->value) {?>fixed-block<?php }?> <?php if ($_smarty_tpl->tpl_vars['parent_grid']->value['width']==1) {?>hidden<?php }?>"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['block_data']->value['name'], ENT_QUOTES, 'UTF-8');?>
</h4></div><div class="bm-full-menu block-control-menu bm-control-menu <?php if ($_smarty_tpl->tpl_vars['parent_grid']->value['width']<=2&&!$_smarty_tpl->tpl_vars['external_render']->value) {?>hidden<?php }?>"><?php if (!$_smarty_tpl->tpl_vars['external_render']->value) {?><div class="cm-tooltip cm-action exicon-cog bm-action-properties action" title="<?php echo $_smarty_tpl->__("block_options");?>
"></div><div class="cm-tooltip cm-action exicon-off bm-action-switch<?php if ($_smarty_tpl->tpl_vars['status']->value!="A") {?> switch-off<?php }
if ($_smarty_tpl->tpl_vars['dynamic_object']->value) {?> bm-dynamic-object<?php }
if (!$_smarty_tpl->tpl_vars['dynamic_object']->value&&$_smarty_tpl->tpl_vars['block_data']->value['items_count']>0) {?> bm-confirm<?php }?> action" title="<?php echo $_smarty_tpl->__("enable_or_disable_block");?>
"<?php if ($_smarty_tpl->tpl_vars['dynamic_object']->value) {?>data-ca-bm-object-id="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['dynamic_object']->value['object_id'], ENT_QUOTES, 'UTF-8');?>
"<?php }?>><?php echo Smarty::$_smarty_vars['capture']['confirm_message'];?>
</div><?php } else { ?><input type="hidden" name="block_data[block_id]" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['block_data']->value['block_id'], ENT_QUOTES, 'UTF-8');?>
" id="ajax_update_block_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['external_id']->value, ENT_QUOTES, 'UTF-8');?>
"/><?php echo $_smarty_tpl->getSubTemplate ("common/popupbox.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('id'=>"edit_block_properties_".((string)$_smarty_tpl->tpl_vars['block_data']->value['block_id'])."_".((string)$_smarty_tpl->tpl_vars['external_id']->value),'text'=>__("block_settings"),'link_text'=>"<i class=\"icon-cog\"></i>",'act'=>"link",'href'=>"block_manager.update_block?block_data[block_id]=".((string)$_smarty_tpl->tpl_vars['block_data']->value['block_id'])."&ajax_update=1&html_id=".((string)$_smarty_tpl->tpl_vars['external_id']->value)."&force_close=1",'opener_ajax_class'=>"cm-ajax cm-ajax-force cm",'link_class'=>"action-properties bm-action-properties",'content'=>''), 0);
}
if (!$_smarty_tpl->tpl_vars['dynamic_object']->value&&!$_smarty_tpl->tpl_vars['external_render']->value) {?><div class="cm-tooltip cm-action exicon-trash pull-right bm-action-delete extra action <?php if ($_smarty_tpl->tpl_vars['block_data']->value['single_for_location']) {?>bm-block-single-for-location<?php }?>" title="<?php echo $_smarty_tpl->__("delete_block");?>
"></div><?php }?></div><?php if (!$_smarty_tpl->tpl_vars['external_render']->value) {?><div class="bm-compact-menu block-control-menu bm-control-menu <?php if ($_smarty_tpl->tpl_vars['parent_grid']->value['width']>2) {?>hidden<?php }?>"><div class="action-showmenu action-control-menu"><div class="btn-group action"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class='icon-align-justify cm-tooltip' title="<?php echo $_smarty_tpl->__("add_grid_block");?>
"></span></a><ul class="dropdown-menu droptop"><li><a class="cm-action bm-action-properties"><?php echo $_smarty_tpl->__("block_options");?>
</a></li><li><a class="cm-action bm-action-delete extra"><?php echo $_smarty_tpl->__("delete_block");?>
</a></li><li><a class="cm-action bm-action-switch <?php if ($_smarty_tpl->tpl_vars['status']->value!="A") {?>switch-off<?php }?>"><?php echo $_smarty_tpl->__("on_off");?>
<span class="action-switch"></span></a></li></ul></div></div></div><?php }?></div>
<?php }?><?php }} ?>
