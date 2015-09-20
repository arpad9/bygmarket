<?php /* Smarty version Smarty-3.1.21, created on 2015-09-19 01:54:51
         compiled from "/var/www/bygmarket.com/design/backend/templates/common/calendar.tpl" */ ?>
<?php /*%%SmartyHeaderCode:122359837355fc963be85432-30556784%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'cdc0fe05eedc4b659b423e591dcf340b5c5aca04' => 
    array (
      0 => '/var/www/bygmarket.com/design/backend/templates/common/calendar.tpl',
      1 => 1441800576,
      2 => 'tygh',
    ),
  ),
  'nocache_hash' => '122359837355fc963be85432-30556784',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'settings' => 0,
    'date_id' => 0,
    'date_name' => 0,
    'date_meta' => 0,
    'date_val' => 0,
    'date_format' => 0,
    'extra' => 0,
    'ldelim' => 0,
    'start_year' => 0,
    'rdelim' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21',
  'unifunc' => 'content_55fc963bef73c7_39556058',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55fc963bef73c7_39556058')) {function content_55fc963bef73c7_39556058($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_date_format')) include '/var/www/bygmarket.com/app/functions/smarty_plugins/modifier.date_format.php';
if (!is_callable('smarty_block_inline_script')) include '/var/www/bygmarket.com/app/functions/smarty_plugins/block.inline_script.php';
?><?php
fn_preload_lang_vars(array('weekday_abr_0','weekday_abr_1','weekday_abr_2','weekday_abr_3','weekday_abr_4','weekday_abr_5','weekday_abr_6','month_name_abr_1','month_name_abr_2','month_name_abr_3','month_name_abr_4','month_name_abr_5','month_name_abr_6','month_name_abr_7','month_name_abr_8','month_name_abr_9','month_name_abr_10','month_name_abr_11','month_name_abr_12'));
?>
<?php if ($_smarty_tpl->tpl_vars['settings']->value['Appearance']['calendar_date_format']=="month_first") {?>
    <?php $_smarty_tpl->tpl_vars["date_format"] = new Smarty_variable("%m/%d/%Y", null, 0);?>
<?php } else { ?>
    <?php $_smarty_tpl->tpl_vars["date_format"] = new Smarty_variable("%d/%m/%Y", null, 0);?>
<?php }?>

<div class="calendar">
    <input type="text" id="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['date_id']->value, ENT_QUOTES, 'UTF-8');?>
" name="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['date_name']->value, ENT_QUOTES, 'UTF-8');?>
" class="<?php if ($_smarty_tpl->tpl_vars['date_meta']->value) {
echo htmlspecialchars($_smarty_tpl->tpl_vars['date_meta']->value, ENT_QUOTES, 'UTF-8');
}?> cm-calendar" value="<?php if ($_smarty_tpl->tpl_vars['date_val']->value) {
echo htmlspecialchars(smarty_modifier_date_format(fn_parse_date($_smarty_tpl->tpl_vars['date_val']->value),((string)$_smarty_tpl->tpl_vars['date_format']->value)), ENT_QUOTES, 'UTF-8');
}?>" <?php echo $_smarty_tpl->tpl_vars['extra']->value;?>
 size="10" />
    <span data-ca-external-focus-id="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['date_id']->value, ENT_QUOTES, 'UTF-8');?>
" class="icon-calendar cm-external-focus"></span>
</div>

<?php $_smarty_tpl->smarty->_tag_stack[] = array('inline_script', array()); $_block_repeat=true; echo smarty_block_inline_script(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
<?php echo '<script'; ?>
 type="text/javascript">
(function(_, $) <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['ldelim']->value, ENT_QUOTES, 'UTF-8');?>

    $.ceEvent('on', 'ce.commoninit', function(context) {
        $('#<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['date_id']->value, ENT_QUOTES, 'UTF-8');?>
').datepicker({
            changeMonth: true,
            duration: 'fast',
            changeYear: true,
            numberOfMonths: 1,
            selectOtherMonths: true,
            showOtherMonths: true,
            firstDay: <?php if ($_smarty_tpl->tpl_vars['settings']->value['Appearance']['calendar_week_format']=="sunday_first") {?>0<?php } else { ?>1<?php }?>,
            dayNamesMin: ['<?php echo $_smarty_tpl->__("weekday_abr_0");?>
', '<?php echo $_smarty_tpl->__("weekday_abr_1");?>
', '<?php echo $_smarty_tpl->__("weekday_abr_2");?>
', '<?php echo $_smarty_tpl->__("weekday_abr_3");?>
', '<?php echo $_smarty_tpl->__("weekday_abr_4");?>
', '<?php echo $_smarty_tpl->__("weekday_abr_5");?>
', '<?php echo $_smarty_tpl->__("weekday_abr_6");?>
'],
            monthNamesShort: ['<?php echo $_smarty_tpl->__("month_name_abr_1");?>
', '<?php echo $_smarty_tpl->__("month_name_abr_2");?>
', '<?php echo $_smarty_tpl->__("month_name_abr_3");?>
', '<?php echo $_smarty_tpl->__("month_name_abr_4");?>
', '<?php echo $_smarty_tpl->__("month_name_abr_5");?>
', '<?php echo $_smarty_tpl->__("month_name_abr_6");?>
', '<?php echo $_smarty_tpl->__("month_name_abr_7");?>
', '<?php echo $_smarty_tpl->__("month_name_abr_8");?>
', '<?php echo $_smarty_tpl->__("month_name_abr_9");?>
', '<?php echo $_smarty_tpl->__("month_name_abr_10");?>
', '<?php echo $_smarty_tpl->__("month_name_abr_11");?>
', '<?php echo $_smarty_tpl->__("month_name_abr_12");?>
'],
            yearRange: '<?php if ($_smarty_tpl->tpl_vars['start_year']->value) {
echo htmlspecialchars($_smarty_tpl->tpl_vars['start_year']->value, ENT_QUOTES, 'UTF-8');
} else { ?>c-100<?php }?>:c+10',
            dateFormat: '<?php if ($_smarty_tpl->tpl_vars['settings']->value['Appearance']['calendar_date_format']=="month_first") {?>mm/dd/yy<?php } else { ?>dd/mm/yy<?php }?>'
        });
    });
<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['rdelim']->value, ENT_QUOTES, 'UTF-8');?>
(Tygh, Tygh.$));
<?php echo '</script'; ?>
><?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_inline_script(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>
<?php }} ?>
