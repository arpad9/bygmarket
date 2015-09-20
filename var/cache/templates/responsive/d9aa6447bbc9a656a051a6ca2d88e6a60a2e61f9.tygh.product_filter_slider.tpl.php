<?php /* Smarty version Smarty-3.1.21, created on 2015-09-18 20:26:03
         compiled from "/var/www/bygmarket.com/design/themes/responsive/templates/blocks/product_filters/components/product_filter_slider.tpl" */ ?>
<?php /*%%SmartyHeaderCode:155444104455fc492bc7ef35-44074616%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd9aa6447bbc9a656a051a6ca2d88e6a60a2e61f9' => 
    array (
      0 => '/var/www/bygmarket.com/design/themes/responsive/templates/blocks/product_filters/components/product_filter_slider.tpl',
      1 => 1442595889,
      2 => 'tygh',
    ),
  ),
  'nocache_hash' => '155444104455fc492bc7ef35-44074616',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'runtime' => 0,
    'filter' => 0,
    'min' => 0,
    'max' => 0,
    'filter_uid' => 0,
    'collapse' => 0,
    'extra_class' => 0,
    'left' => 0,
    'disable_slider' => 0,
    'right' => 0,
    'auth' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21',
  'unifunc' => 'content_55fc492be090a2_11067653',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55fc492be090a2_11067653')) {function content_55fc492be090a2_11067653($_smarty_tpl) {?><?php if (!is_callable('smarty_function_script')) include '/var/www/bygmarket.com/app/functions/smarty_plugins/function.script.php';
if (!is_callable('smarty_function_set_id')) include '/var/www/bygmarket.com/app/functions/smarty_plugins/function.set_id.php';
?><?php if ($_smarty_tpl->tpl_vars['runtime']->value['customization_mode']['design']=="Y"&&@constant('AREA')=="C") {
$_smarty_tpl->_capture_stack[0][] = array("template_content", null, null); ob_start();
echo smarty_function_script(array('src'=>"js/lib/jqueryuitouch/jquery.ui.touch-punch.min.js"),$_smarty_tpl);?>

<?php $_smarty_tpl->tpl_vars['min'] = new Smarty_variable($_smarty_tpl->tpl_vars['filter']->value['min'], null, 0);?>
<?php $_smarty_tpl->tpl_vars['max'] = new Smarty_variable($_smarty_tpl->tpl_vars['filter']->value['max'], null, 0);?>
<?php $_smarty_tpl->tpl_vars['left'] = new Smarty_variable((($tmp = @$_smarty_tpl->tpl_vars['filter']->value['left'])===null||$tmp==='' ? $_smarty_tpl->tpl_vars['min']->value : $tmp), null, 0);?>
<?php $_smarty_tpl->tpl_vars['right'] = new Smarty_variable((($tmp = @$_smarty_tpl->tpl_vars['filter']->value['right'])===null||$tmp==='' ? $_smarty_tpl->tpl_vars['max']->value : $tmp), null, 0);?>

<?php if ($_smarty_tpl->tpl_vars['max']->value-$_smarty_tpl->tpl_vars['min']->value<=$_smarty_tpl->tpl_vars['filter']->value['round_to']) {?>
    <?php $_smarty_tpl->tpl_vars['disable_slider'] = new Smarty_variable(true, null, 0);?>
<?php }?>

<div id="content_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['filter_uid']->value, ENT_QUOTES, 'UTF-8');?>
" class="cm-product-filters-checkbox-container ty-price-slider <?php if ($_smarty_tpl->tpl_vars['collapse']->value) {?>hidden<?php }?> <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['extra_class']->value, ENT_QUOTES, 'UTF-8');?>
">
    <?php echo $_smarty_tpl->tpl_vars['filter']->value['prefix'];?>

    <input type="text" class="ty-price-slider__input-text" id="slider_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['filter_uid']->value, ENT_QUOTES, 'UTF-8');?>
_left" name="left_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['filter_uid']->value, ENT_QUOTES, 'UTF-8');?>
" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['left']->value, ENT_QUOTES, 'UTF-8');?>
"<?php if ($_smarty_tpl->tpl_vars['disable_slider']->value) {?> disabled="disabled"<?php }?> />
    <?php echo $_smarty_tpl->tpl_vars['filter']->value['suffix'];?>

    &nbsp;–&nbsp;
    <?php echo $_smarty_tpl->tpl_vars['filter']->value['prefix'];?>

    <input type="text" class="ty-price-slider__input-text" id="slider_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['filter_uid']->value, ENT_QUOTES, 'UTF-8');?>
_right" name="right_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['filter_uid']->value, ENT_QUOTES, 'UTF-8');?>
" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['right']->value, ENT_QUOTES, 'UTF-8');?>
"<?php if ($_smarty_tpl->tpl_vars['disable_slider']->value) {?> disabled="disabled"<?php }?> />
    <?php echo $_smarty_tpl->tpl_vars['filter']->value['suffix'];?>


    <div id="slider_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['filter_uid']->value, ENT_QUOTES, 'UTF-8');?>
" class="ty-range-slider cm-range-slider">
        <ul class="ty-range-slider__wrapper">
            <li class="ty-range-slider__item" style="left: 0%;"><span class="ty-range-slider__num"><?php echo $_smarty_tpl->tpl_vars['filter']->value['prefix'];
echo htmlspecialchars($_smarty_tpl->tpl_vars['min']->value, ENT_QUOTES, 'UTF-8');
echo $_smarty_tpl->tpl_vars['filter']->value['suffix'];?>
</span></li>
            <li class="ty-range-slider__item" style="left: 100%;"><span class="ty-range-slider__num"><?php echo $_smarty_tpl->tpl_vars['filter']->value['prefix'];
echo htmlspecialchars($_smarty_tpl->tpl_vars['max']->value, ENT_QUOTES, 'UTF-8');
echo $_smarty_tpl->tpl_vars['filter']->value['suffix'];?>
</span></li>
        </ul>
    </div>

    <input id="elm_checkbox_slider_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['filter_uid']->value, ENT_QUOTES, 'UTF-8');?>
" data-ca-filter-id="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['filter']->value['filter_id'], ENT_QUOTES, 'UTF-8');?>
" class="cm-product-filters-checkbox hidden" type="checkbox" name="product_filters[<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['filter']->value['filter_id'], ENT_QUOTES, 'UTF-8');?>
]" value="" />

    <?php if ($_smarty_tpl->tpl_vars['right']->value==$_smarty_tpl->tpl_vars['left']->value) {?>
        <?php $_smarty_tpl->tpl_vars['right'] = new Smarty_variable($_smarty_tpl->tpl_vars['left']->value+$_smarty_tpl->tpl_vars['filter']->value['round_to'], null, 0);?>
    <?php }?>

    
    <input type="hidden" id="slider_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['filter_uid']->value, ENT_QUOTES, 'UTF-8');?>
_json" value='{
        "disabled": <?php echo htmlspecialchars((($tmp = @$_smarty_tpl->tpl_vars['disable_slider']->value)===null||$tmp==='' ? "false" : $tmp), ENT_QUOTES, 'UTF-8');?>
,
        "min": <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['min']->value, ENT_QUOTES, 'UTF-8');?>
,
        "max": <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['max']->value, ENT_QUOTES, 'UTF-8');?>
,
        "left": <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['left']->value, ENT_QUOTES, 'UTF-8');?>
,
        "right": <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['right']->value, ENT_QUOTES, 'UTF-8');?>
,
        "step": <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['filter']->value['round_to'], ENT_QUOTES, 'UTF-8');?>
,
        "extra": "<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['filter']->value['extra'], ENT_QUOTES, 'UTF-8');?>
"
    }' />
    
</div>
<?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();
if (trim(Smarty::$_smarty_vars['capture']['template_content'])) {
if ($_smarty_tpl->tpl_vars['auth']->value['area']=="A") {?><span class="cm-template-box template-box" data-ca-te-template="blocks/product_filters/components/product_filter_slider.tpl" id="<?php echo smarty_function_set_id(array('name'=>"blocks/product_filters/components/product_filter_slider.tpl"),$_smarty_tpl);?>
"><div class="cm-template-icon icon-edit ty-icon-edit hidden"></div><?php echo Smarty::$_smarty_vars['capture']['template_content'];?>
<!--[/tpl_id]--></span><?php } else {
echo Smarty::$_smarty_vars['capture']['template_content'];
}
}
} else {
echo smarty_function_script(array('src'=>"js/lib/jqueryuitouch/jquery.ui.touch-punch.min.js"),$_smarty_tpl);?>

<?php $_smarty_tpl->tpl_vars['min'] = new Smarty_variable($_smarty_tpl->tpl_vars['filter']->value['min'], null, 0);?>
<?php $_smarty_tpl->tpl_vars['max'] = new Smarty_variable($_smarty_tpl->tpl_vars['filter']->value['max'], null, 0);?>
<?php $_smarty_tpl->tpl_vars['left'] = new Smarty_variable((($tmp = @$_smarty_tpl->tpl_vars['filter']->value['left'])===null||$tmp==='' ? $_smarty_tpl->tpl_vars['min']->value : $tmp), null, 0);?>
<?php $_smarty_tpl->tpl_vars['right'] = new Smarty_variable((($tmp = @$_smarty_tpl->tpl_vars['filter']->value['right'])===null||$tmp==='' ? $_smarty_tpl->tpl_vars['max']->value : $tmp), null, 0);?>

<?php if ($_smarty_tpl->tpl_vars['max']->value-$_smarty_tpl->tpl_vars['min']->value<=$_smarty_tpl->tpl_vars['filter']->value['round_to']) {?>
    <?php $_smarty_tpl->tpl_vars['disable_slider'] = new Smarty_variable(true, null, 0);?>
<?php }?>

<div id="content_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['filter_uid']->value, ENT_QUOTES, 'UTF-8');?>
" class="cm-product-filters-checkbox-container ty-price-slider <?php if ($_smarty_tpl->tpl_vars['collapse']->value) {?>hidden<?php }?> <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['extra_class']->value, ENT_QUOTES, 'UTF-8');?>
">
    <?php echo $_smarty_tpl->tpl_vars['filter']->value['prefix'];?>

    <input type="text" class="ty-price-slider__input-text" id="slider_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['filter_uid']->value, ENT_QUOTES, 'UTF-8');?>
_left" name="left_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['filter_uid']->value, ENT_QUOTES, 'UTF-8');?>
" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['left']->value, ENT_QUOTES, 'UTF-8');?>
"<?php if ($_smarty_tpl->tpl_vars['disable_slider']->value) {?> disabled="disabled"<?php }?> />
    <?php echo $_smarty_tpl->tpl_vars['filter']->value['suffix'];?>

    &nbsp;–&nbsp;
    <?php echo $_smarty_tpl->tpl_vars['filter']->value['prefix'];?>

    <input type="text" class="ty-price-slider__input-text" id="slider_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['filter_uid']->value, ENT_QUOTES, 'UTF-8');?>
_right" name="right_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['filter_uid']->value, ENT_QUOTES, 'UTF-8');?>
" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['right']->value, ENT_QUOTES, 'UTF-8');?>
"<?php if ($_smarty_tpl->tpl_vars['disable_slider']->value) {?> disabled="disabled"<?php }?> />
    <?php echo $_smarty_tpl->tpl_vars['filter']->value['suffix'];?>


    <div id="slider_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['filter_uid']->value, ENT_QUOTES, 'UTF-8');?>
" class="ty-range-slider cm-range-slider">
        <ul class="ty-range-slider__wrapper">
            <li class="ty-range-slider__item" style="left: 0%;"><span class="ty-range-slider__num"><?php echo $_smarty_tpl->tpl_vars['filter']->value['prefix'];
echo htmlspecialchars($_smarty_tpl->tpl_vars['min']->value, ENT_QUOTES, 'UTF-8');
echo $_smarty_tpl->tpl_vars['filter']->value['suffix'];?>
</span></li>
            <li class="ty-range-slider__item" style="left: 100%;"><span class="ty-range-slider__num"><?php echo $_smarty_tpl->tpl_vars['filter']->value['prefix'];
echo htmlspecialchars($_smarty_tpl->tpl_vars['max']->value, ENT_QUOTES, 'UTF-8');
echo $_smarty_tpl->tpl_vars['filter']->value['suffix'];?>
</span></li>
        </ul>
    </div>

    <input id="elm_checkbox_slider_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['filter_uid']->value, ENT_QUOTES, 'UTF-8');?>
" data-ca-filter-id="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['filter']->value['filter_id'], ENT_QUOTES, 'UTF-8');?>
" class="cm-product-filters-checkbox hidden" type="checkbox" name="product_filters[<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['filter']->value['filter_id'], ENT_QUOTES, 'UTF-8');?>
]" value="" />

    <?php if ($_smarty_tpl->tpl_vars['right']->value==$_smarty_tpl->tpl_vars['left']->value) {?>
        <?php $_smarty_tpl->tpl_vars['right'] = new Smarty_variable($_smarty_tpl->tpl_vars['left']->value+$_smarty_tpl->tpl_vars['filter']->value['round_to'], null, 0);?>
    <?php }?>

    
    <input type="hidden" id="slider_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['filter_uid']->value, ENT_QUOTES, 'UTF-8');?>
_json" value='{
        "disabled": <?php echo htmlspecialchars((($tmp = @$_smarty_tpl->tpl_vars['disable_slider']->value)===null||$tmp==='' ? "false" : $tmp), ENT_QUOTES, 'UTF-8');?>
,
        "min": <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['min']->value, ENT_QUOTES, 'UTF-8');?>
,
        "max": <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['max']->value, ENT_QUOTES, 'UTF-8');?>
,
        "left": <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['left']->value, ENT_QUOTES, 'UTF-8');?>
,
        "right": <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['right']->value, ENT_QUOTES, 'UTF-8');?>
,
        "step": <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['filter']->value['round_to'], ENT_QUOTES, 'UTF-8');?>
,
        "extra": "<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['filter']->value['extra'], ENT_QUOTES, 'UTF-8');?>
"
    }' />
    
</div>
<?php }?><?php }} ?>
