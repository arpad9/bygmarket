<?php /* Smarty version Smarty-3.1.21, created on 2015-09-19 02:14:07
         compiled from "/var/www/bygmarket.com/design/backend/templates/addons/banners/views/banners/update.tpl" */ ?>
<?php /*%%SmartyHeaderCode:176743358355fc9abfb2ddd2-24262131%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '10bbe3f84975a016065b6e7d6b8c4b1861245b2c' => 
    array (
      0 => '/var/www/bygmarket.com/design/backend/templates/addons/banners/views/banners/update.tpl',
      1 => 1441800576,
      2 => 'tygh',
    ),
  ),
  'nocache_hash' => '176743358355fc9abfb2ddd2-24262131',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'banner' => 0,
    'allow_save' => 0,
    'id' => 0,
    'b_type' => 0,
    'settings' => 0,
    'hide_first_button' => 0,
    'hide_second_button' => 0,
    'title' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21',
  'unifunc' => 'content_55fc9abfcfd062_86871796',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55fc9abfcfd062_86871796')) {function content_55fc9abfcfd062_86871796($_smarty_tpl) {?><?php if (!is_callable('smarty_block_notes')) include '/var/www/bygmarket.com/app/functions/smarty_plugins/block.notes.php';
if (!is_callable('smarty_block_hook')) include '/var/www/bygmarket.com/app/functions/smarty_plugins/block.hook.php';
?><?php
fn_preload_lang_vars(array('name','position_short','type','graphic_banner','text_banner','image','description','open_in_new_window','url','creation_date','banner_details_notes','banners.new_banner','banners.editing_banner'));
?>
<?php if ($_smarty_tpl->tpl_vars['banner']->value) {?>
    <?php $_smarty_tpl->tpl_vars["id"] = new Smarty_variable($_smarty_tpl->tpl_vars['banner']->value['banner_id'], null, 0);?>
<?php } else { ?>
    <?php $_smarty_tpl->tpl_vars["id"] = new Smarty_variable(0, null, 0);?>
<?php }?>

<?php $_smarty_tpl->tpl_vars["allow_save"] = new Smarty_variable(fn_allow_save_object($_smarty_tpl->tpl_vars['banner']->value,"banners"), null, 0);?>



<?php $_smarty_tpl->tpl_vars["b_type"] = new Smarty_variable((($tmp = @$_smarty_tpl->tpl_vars['banner']->value['type'])===null||$tmp==='' ? "G" : $tmp), null, 0);?>

<?php $_smarty_tpl->_capture_stack[0][] = array("mainbox", null, null); ob_start(); ?>

<form action="<?php echo htmlspecialchars(fn_url(''), ENT_QUOTES, 'UTF-8');?>
" method="post" class="form-horizontal form-edit  <?php if (!$_smarty_tpl->tpl_vars['allow_save']->value) {?> cm-hide-inputs<?php }?>" name="banners_form" enctype="multipart/form-data">
<input type="hidden" class="cm-no-hide-input" name="fake" value="1" />
<input type="hidden" class="cm-no-hide-input" name="banner_id" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['id']->value, ENT_QUOTES, 'UTF-8');?>
" />

<?php $_smarty_tpl->_capture_stack[0][] = array("tabsbox", null, null); ob_start(); ?>
<div id="content_general">
    <div class="control-group">
        <label for="elm_banner_name" class="control-label cm-required"><?php echo $_smarty_tpl->__("name");?>
</label>
        <div class="controls">
        <input type="text" name="banner_data[banner]" id="elm_banner_name" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['banner']->value['banner'], ENT_QUOTES, 'UTF-8');?>
" size="25" class="input-large" /></div>
    </div>

    <?php if (fn_allowed_for("ULTIMATE")) {?>
        <?php echo $_smarty_tpl->getSubTemplate ("views/companies/components/company_field.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('name'=>"banner_data[company_id]",'id'=>"banner_data_company_id",'selected'=>$_smarty_tpl->tpl_vars['banner']->value['company_id']), 0);?>

    <?php }?>

    <div class="control-group">
        <label for="elm_banner_position" class="control-label"><?php echo $_smarty_tpl->__("position_short");?>
</label>
        <div class="controls">
            <input type="text" name="banner_data[position]" id="elm_banner_position" value="<?php echo htmlspecialchars((($tmp = @$_smarty_tpl->tpl_vars['banner']->value['position'])===null||$tmp==='' ? "0" : $tmp), ENT_QUOTES, 'UTF-8');?>
" size="3"/>
        </div>
    </div>

    <div class="control-group">
        <label for="elm_banner_type" class="control-label cm-required"><?php echo $_smarty_tpl->__("type");?>
</label>
        <div class="controls">
        <select name="banner_data[type]" id="elm_banner_type" onchange="Tygh.$('#banner_graphic').toggle();  Tygh.$('#banner_text').toggle(); Tygh.$('#banner_url').toggle();  Tygh.$('#banner_target').toggle();">
            <option <?php if ($_smarty_tpl->tpl_vars['banner']->value['type']=="G") {?>selected="selected"<?php }?> value="G"><?php echo $_smarty_tpl->__("graphic_banner");?>
</option>
            <option <?php if ($_smarty_tpl->tpl_vars['banner']->value['type']=="T") {?>selected="selected"<?php }?> value="T"><?php echo $_smarty_tpl->__("text_banner");?>
</option>
        </select>
        </div>
    </div>

    <div class="control-group <?php if ($_smarty_tpl->tpl_vars['b_type']->value!="G") {?>hidden<?php }?>" id="banner_graphic">
        <label class="control-label"><?php echo $_smarty_tpl->__("image");?>
</label>
        <div class="controls">
            <?php echo $_smarty_tpl->getSubTemplate ("common/attach_images.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('image_name'=>"banners_main",'image_object_type'=>"promo",'image_pair'=>$_smarty_tpl->tpl_vars['banner']->value['main_pair'],'image_object_id'=>$_smarty_tpl->tpl_vars['id']->value,'no_detailed'=>true,'hide_titles'=>true), 0);?>

        </div>
    </div>

    <div class="control-group <?php if ($_smarty_tpl->tpl_vars['b_type']->value=="G") {?>hidden<?php }?>" id="banner_text">
        <label class="control-label" for="elm_banner_description"><?php echo $_smarty_tpl->__("description");?>
:</label>
        <div class="controls">
            <textarea id="elm_banner_description" name="banner_data[description]" cols="35" rows="8" class="cm-wysiwyg input-large"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['banner']->value['description'], ENT_QUOTES, 'UTF-8');?>
</textarea>
        </div>
    </div>

    <div class="control-group <?php if ($_smarty_tpl->tpl_vars['b_type']->value=="T") {?>hidden<?php }?>" id="banner_target">
        <label class="control-label" for="elm_banner_target"><?php echo $_smarty_tpl->__("open_in_new_window");?>
</label>
        <div class="controls">
        <input type="hidden" name="banner_data[target]" value="T" />
        <input type="checkbox" name="banner_data[target]" id="elm_banner_target" value="B" <?php if ($_smarty_tpl->tpl_vars['banner']->value['target']=="B") {?>checked="checked"<?php }?> />
        </div>
    </div>

    <div class="control-group <?php if ($_smarty_tpl->tpl_vars['b_type']->value=="T") {?>hidden<?php }?>" id="banner_url">
        <label class="control-label" for="elm_banner_url"><?php echo $_smarty_tpl->__("url");?>
:</label>
        <div class="controls">
            <input type="text" name="banner_data[url]" id="elm_banner_url" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['banner']->value['url'], ENT_QUOTES, 'UTF-8');?>
" size="25" class="input-large" />
        </div>
    </div>

    <div class="control-group">
        <label class="control-label" for="elm_banner_timestamp_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['id']->value, ENT_QUOTES, 'UTF-8');?>
"><?php echo $_smarty_tpl->__("creation_date");?>
</label>
        <div class="controls">
        <?php echo $_smarty_tpl->getSubTemplate ("common/calendar.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('date_id'=>"elm_banner_timestamp_".((string)$_smarty_tpl->tpl_vars['id']->value),'date_name'=>"banner_data[timestamp]",'date_val'=>(($tmp = @$_smarty_tpl->tpl_vars['banner']->value['timestamp'])===null||$tmp==='' ? @constant('TIME') : $tmp),'start_year'=>$_smarty_tpl->tpl_vars['settings']->value['Company']['company_start_year']), 0);?>

        </div>
    </div>

    <?php echo $_smarty_tpl->getSubTemplate ("views/localizations/components/select.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('data_name'=>"banner_data[localization]",'data_from'=>$_smarty_tpl->tpl_vars['banner']->value['localization']), 0);?>


    <?php echo $_smarty_tpl->getSubTemplate ("common/select_status.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('input_name'=>"banner_data[status]",'id'=>"elm_banner_status",'obj_id'=>$_smarty_tpl->tpl_vars['id']->value,'obj'=>$_smarty_tpl->tpl_vars['banner']->value,'hidden'=>true), 0);?>

</div>
<?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>
<?php echo $_smarty_tpl->getSubTemplate ("common/tabsbox.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('content'=>Smarty::$_smarty_vars['capture']['tabsbox'],'active_tab'=>$_REQUEST['selected_section'],'track'=>true), 0);?>


<?php $_smarty_tpl->_capture_stack[0][] = array("buttons", null, null); ob_start(); ?>
    <?php if (!$_smarty_tpl->tpl_vars['id']->value) {?>
        <?php echo $_smarty_tpl->getSubTemplate ("buttons/save_cancel.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('but_role'=>"submit-link",'but_target_form'=>"banners_form",'but_name'=>"dispatch[banners.update]"), 0);?>

    <?php } else { ?>
        <?php if (fn_allowed_for("ULTIMATE")&&!$_smarty_tpl->tpl_vars['allow_save']->value) {?>
            <?php $_smarty_tpl->tpl_vars["hide_first_button"] = new Smarty_variable(true, null, 0);?>
            <?php $_smarty_tpl->tpl_vars["hide_second_button"] = new Smarty_variable(true, null, 0);?>
        <?php }?>
        <?php echo $_smarty_tpl->getSubTemplate ("buttons/save_cancel.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('but_name'=>"dispatch[banners.update]",'but_role'=>"submit-link",'but_target_form'=>"banners_form",'hide_first_button'=>$_smarty_tpl->tpl_vars['hide_first_button']->value,'hide_second_button'=>$_smarty_tpl->tpl_vars['hide_second_button']->value,'save'=>$_smarty_tpl->tpl_vars['id']->value), 0);?>

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

<?php $_smarty_tpl->smarty->_tag_stack[] = array('notes', array()); $_block_repeat=true; echo smarty_block_notes(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

    <?php $_smarty_tpl->smarty->_tag_stack[] = array('hook', array('name'=>"banners:update_notes")); $_block_repeat=true; echo smarty_block_hook(array('name'=>"banners:update_notes"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

    <?php echo $_smarty_tpl->__("banner_details_notes",array("[layouts_href]"=>fn_url('block_manager.manage')));?>

    <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_hook(array('name'=>"banners:update_notes"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

<?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_notes(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>


<?php if (!$_smarty_tpl->tpl_vars['id']->value) {?>
    <?php $_smarty_tpl->tpl_vars["title"] = new Smarty_variable($_smarty_tpl->__("banners.new_banner"), null, 0);?>
<?php } else { ?>
    <?php ob_start();
echo $_smarty_tpl->__("banners.editing_banner");
$_tmp1=ob_get_clean();?><?php $_smarty_tpl->tpl_vars["title"] = new Smarty_variable($_tmp1.": ".((string)$_smarty_tpl->tpl_vars['banner']->value['banner']), null, 0);?>
<?php }?>
<?php echo $_smarty_tpl->getSubTemplate ("common/mainbox.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('title'=>$_smarty_tpl->tpl_vars['title']->value,'content'=>Smarty::$_smarty_vars['capture']['mainbox'],'buttons'=>Smarty::$_smarty_vars['capture']['buttons'],'select_languages'=>true), 0);?>



<?php }} ?>
