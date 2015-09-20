<?php /* Smarty version Smarty-3.1.21, created on 2015-09-18 21:27:33
         compiled from "/var/www/bygmarket.com/design/themes/responsive/templates/views/product_features/compare.tpl" */ ?>
<?php /*%%SmartyHeaderCode:206397940055fc5795d1f203-40499172%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ddc27cc2ac6f27ef8bc22f4e28c357d55773710b' => 
    array (
      0 => '/var/www/bygmarket.com/design/themes/responsive/templates/views/product_features/compare.tpl',
      1 => 1442595889,
      2 => 'tygh',
    ),
  ),
  'nocache_hash' => '206397940055fc5795d1f203-40499172',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'runtime' => 0,
    'comparison_data' => 0,
    'continue_url' => 0,
    'config' => 0,
    'action' => 0,
    'product' => 0,
    'return_current_url' => 0,
    'settings' => 0,
    'obj_id' => 0,
    'old_price' => 0,
    'price' => 0,
    'clean_price' => 0,
    'group_features' => 0,
    '_feature' => 0,
    'id' => 0,
    'group_id' => 0,
    'feature' => 0,
    'var' => 0,
    'r_url' => 0,
    'auth' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21',
  'unifunc' => 'content_55fc57961b02e1_32788380',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55fc57961b02e1_32788380')) {function content_55fc57961b02e1_32788380($_smarty_tpl) {?><?php if (!is_callable('smarty_function_script')) include '/var/www/bygmarket.com/app/functions/smarty_plugins/function.script.php';
if (!is_callable('smarty_modifier_enum')) include '/var/www/bygmarket.com/app/functions/smarty_plugins/modifier.enum.php';
if (!is_callable('smarty_modifier_date_format')) include '/var/www/bygmarket.com/app/functions/smarty_plugins/modifier.date_format.php';
if (!is_callable('smarty_function_html_checkboxes')) include '/var/www/bygmarket.com/app/lib/vendor/smarty/smarty/libs/plugins/function.html_checkboxes.php';
if (!is_callable('smarty_function_set_id')) include '/var/www/bygmarket.com/app/functions/smarty_plugins/function.set_id.php';
?><?php
fn_preload_lang_vars(array('no_products_selected','all_features','all_features','similar_only','similar_only','different_only','different_only','remove','remove','remove','clear_list','add_feature','add','compare','no_products_selected','all_features','all_features','similar_only','similar_only','different_only','different_only','remove','remove','remove','clear_list','add_feature','add','compare'));
?>
<?php if ($_smarty_tpl->tpl_vars['runtime']->value['customization_mode']['design']=="Y"&&@constant('AREA')=="C") {
$_smarty_tpl->_capture_stack[0][] = array("template_content", null, null); ob_start();
if (!$_smarty_tpl->tpl_vars['comparison_data']->value) {?>
    <p class="ty-no-items ty-compare__no-items"><?php echo $_smarty_tpl->__("no_products_selected");?>
</p>
    <div class="buttons-container ty-compare__button-empty">
        <?php echo $_smarty_tpl->getSubTemplate ("buttons/continue_shopping.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('but_href'=>fn_url($_smarty_tpl->tpl_vars['continue_url']->value),'but_role'=>"text"), 0);?>

    </div>
<?php } else { ?>
    <?php echo smarty_function_script(array('src'=>"js/tygh/exceptions.js"),$_smarty_tpl);?>

    <?php $_smarty_tpl->tpl_vars["return_current_url"] = new Smarty_variable(rawurlencode($_smarty_tpl->tpl_vars['config']->value['current_url']), null, 0);?>
    <div class="ty-compare">
        <div class="ty-compare__wrapper">
            <table class="ty-compare-products">
                <tr>
                    <td class="ty-compare-products__menu">
                        <ul class="ty-compare-menu">
                            <li class="ty-compare-menu__item"><?php if ($_smarty_tpl->tpl_vars['action']->value!="show_all") {?><a class="ty-compare-menu__a" href="<?php echo htmlspecialchars(fn_url("product_features.compare.show_all"), ENT_QUOTES, 'UTF-8');?>
"><?php echo $_smarty_tpl->__("all_features");?>
</a><?php } else { ?><span class="ty-compare-menu__elem"><?php echo $_smarty_tpl->__("all_features");?>
</span><?php }?></li>
                            <li class="ty-compare-menu__item"><?php if ($_smarty_tpl->tpl_vars['action']->value!="similar_only") {?><a class="ty-compare-menu__a" href="<?php echo htmlspecialchars(fn_url("product_features.compare.similar_only"), ENT_QUOTES, 'UTF-8');?>
"><?php echo $_smarty_tpl->__("similar_only");?>
</a><?php } else { ?><span class="ty-compare-menu__elem"><?php echo $_smarty_tpl->__("similar_only");?>
</span><?php }?></li>
                            <li class="ty-compare-menu__item"><?php if ($_smarty_tpl->tpl_vars['action']->value!="different_only") {?><a class="ty-compare-menu__a" href="<?php echo htmlspecialchars(fn_url("product_features.compare.different_only"), ENT_QUOTES, 'UTF-8');?>
"><?php echo $_smarty_tpl->__("different_only");?>
</a><?php } else { ?><span class="ty-compare-menu__elem"><?php echo $_smarty_tpl->__("different_only");?>
</span><?php }?></li>
                        </ul>
                    </td>
                    <?php  $_smarty_tpl->tpl_vars['product'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['product']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['comparison_data']->value['products']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['product']->key => $_smarty_tpl->tpl_vars['product']->value) {
$_smarty_tpl->tpl_vars['product']->_loop = true;
?>
                    <td class="ty-compare-products__product">
                        <div class="ty-compare-products__item">
                            <div class="ty-compare-products__delete"><a href="<?php echo htmlspecialchars(fn_url("product_features.delete_product?product_id=".((string)$_smarty_tpl->tpl_vars['product']->value['product_id'])."&redirect_url=".((string)$_smarty_tpl->tpl_vars['return_current_url']->value)), ENT_QUOTES, 'UTF-8');?>
" class="ty-remove"  title="<?php echo $_smarty_tpl->__("remove");?>
"><i class="ty-remove__icon ty-icon-cancel-circle"></i><span class="ty-remove__txt"><?php echo $_smarty_tpl->__("remove");?>
</span></a></div>
                            <div class="ty-compare-products__img"><a href="<?php echo htmlspecialchars(fn_url("products.view?product_id=".((string)$_smarty_tpl->tpl_vars['product']->value['product_id'])), ENT_QUOTES, 'UTF-8');?>
"><?php echo $_smarty_tpl->getSubTemplate ("common/image.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('image_width'=>$_smarty_tpl->tpl_vars['settings']->value['Thumbnails']['product_lists_thumbnail_width'],'image_height'=>$_smarty_tpl->tpl_vars['settings']->value['Thumbnails']['product_lists_thumbnail_height'],'obj_id'=>$_smarty_tpl->tpl_vars['product']->value['product_id'],'images'=>$_smarty_tpl->tpl_vars['product']->value['main_pair'],'no_ids'=>true), 0);?>
</a></div>
                        </div>

                        <div class="ty-compare-products__item">
                            <a href="<?php echo htmlspecialchars(fn_url("products.view?product_id=".((string)$_smarty_tpl->tpl_vars['product']->value['product_id'])), ENT_QUOTES, 'UTF-8');?>
"><?php echo $_smarty_tpl->tpl_vars['product']->value['product'];?>
</a>
                        </div>

                        <?php $_smarty_tpl->tpl_vars["obj_id"] = new Smarty_variable($_smarty_tpl->tpl_vars['product']->value['product_id'], null, 0);?>
                        <?php echo $_smarty_tpl->getSubTemplate ("common/product_data.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('product'=>$_smarty_tpl->tpl_vars['product']->value,'show_old_price'=>true,'show_price_values'=>true,'show_price'=>true,'show_clean_price'=>true), 0);?>

                        <div class="ty-compare-products__item">
                            <?php $_smarty_tpl->tpl_vars["old_price"] = new Smarty_variable("old_price_".((string)$_smarty_tpl->tpl_vars['obj_id']->value), null, 0);?>
                            <?php if (trim(Smarty::$_smarty_vars['capture'][$_smarty_tpl->tpl_vars['old_price']->value])) {
echo Smarty::$_smarty_vars['capture'][$_smarty_tpl->tpl_vars['old_price']->value];
}?>

                            <?php $_smarty_tpl->tpl_vars["price"] = new Smarty_variable("price_".((string)$_smarty_tpl->tpl_vars['obj_id']->value), null, 0);?>
                            <?php echo Smarty::$_smarty_vars['capture'][$_smarty_tpl->tpl_vars['price']->value];?>


                            <?php $_smarty_tpl->tpl_vars["clean_price"] = new Smarty_variable("clean_price_".((string)$_smarty_tpl->tpl_vars['obj_id']->value), null, 0);?>
                            <?php echo Smarty::$_smarty_vars['capture'][$_smarty_tpl->tpl_vars['clean_price']->value];?>

                        </div>

                        <div class="ty-compare-products__item"><?php echo $_smarty_tpl->getSubTemplate ("blocks/list_templates/simple_list.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('min_qty'=>true,'product'=>$_smarty_tpl->tpl_vars['product']->value,'show_add_to_cart'=>true,'but_role'=>"action",'hide_price'=>true), 0);?>
</div>
                    </td>
                    <?php } ?>
                </tr>
            </table>
    
            <div class="ty-compare-feature">
                <table class="ty-compare-feature__table">
                <?php  $_smarty_tpl->tpl_vars["group_features"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["group_features"]->_loop = false;
 $_smarty_tpl->tpl_vars["group_id"] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['comparison_data']->value['product_features']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["group_features"]->key => $_smarty_tpl->tpl_vars["group_features"]->value) {
$_smarty_tpl->tpl_vars["group_features"]->_loop = true;
 $_smarty_tpl->tpl_vars["group_id"]->value = $_smarty_tpl->tpl_vars["group_features"]->key;
?>
                    <?php  $_smarty_tpl->tpl_vars["_feature"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["_feature"]->_loop = false;
 $_smarty_tpl->tpl_vars['id'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['group_features']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["_feature"]->key => $_smarty_tpl->tpl_vars["_feature"]->value) {
$_smarty_tpl->tpl_vars["_feature"]->_loop = true;
 $_smarty_tpl->tpl_vars['id']->value = $_smarty_tpl->tpl_vars["_feature"]->key;
?>
                        <tr class="ty-compare-feature__row">
                            <td class="ty-compare-feature__item ty-compare-sort">
                                <strong class="ty-compare-sort__title"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['_feature']->value, ENT_QUOTES, 'UTF-8');?>
:</strong>
                                    <a href="<?php echo htmlspecialchars(fn_url("product_features.delete_feature?feature_id=".((string)$_smarty_tpl->tpl_vars['id']->value)."&redirect_url=".((string)$_smarty_tpl->tpl_vars['return_current_url']->value)), ENT_QUOTES, 'UTF-8');?>
" class="ty-compare-sort__a ty-icon-cancel-circle" title="<?php echo $_smarty_tpl->__("remove");?>
"></a>
                            </td>
                            <?php  $_smarty_tpl->tpl_vars['product'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['product']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['comparison_data']->value['products']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['product']->key => $_smarty_tpl->tpl_vars['product']->value) {
$_smarty_tpl->tpl_vars['product']->_loop = true;
?>
                                <td class="ty-compare-feature__item ty-compare-feature_item_size">

                                <?php if ($_smarty_tpl->tpl_vars['product']->value['product_features'][$_smarty_tpl->tpl_vars['id']->value]) {?>
                                    <?php $_smarty_tpl->tpl_vars["feature"] = new Smarty_variable($_smarty_tpl->tpl_vars['product']->value['product_features'][$_smarty_tpl->tpl_vars['id']->value], null, 0);?>
                                <?php } else { ?>
                                    <?php $_smarty_tpl->tpl_vars["feature"] = new Smarty_variable($_smarty_tpl->tpl_vars['product']->value['product_features'][$_smarty_tpl->tpl_vars['group_id']->value]['subfeatures'][$_smarty_tpl->tpl_vars['id']->value], null, 0);?>
                                <?php }?>

                                <?php if ($_smarty_tpl->tpl_vars['feature']->value['prefix']) {
echo htmlspecialchars($_smarty_tpl->tpl_vars['feature']->value['prefix'], ENT_QUOTES, 'UTF-8');
}
if ($_smarty_tpl->tpl_vars['feature']->value['feature_type']==smarty_modifier_enum("ProductFeatures::SINGLE_CHECKBOX")) {?><span class="ty-compare-checkbox" title="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['feature']->value['value'], ENT_QUOTES, 'UTF-8');?>
"><?php if ($_smarty_tpl->tpl_vars['feature']->value['value']=="Y") {?><i class="ty-compare-checkbox__icon ty-icon-ok"></i><?php }?></span><?php } elseif ($_smarty_tpl->tpl_vars['feature']->value['feature_type']==smarty_modifier_enum("ProductFeatures::DATE")) {
echo htmlspecialchars(smarty_modifier_date_format($_smarty_tpl->tpl_vars['feature']->value['value_int'],((string)$_smarty_tpl->tpl_vars['settings']->value['Appearance']['date_format'])), ENT_QUOTES, 'UTF-8');
} elseif ($_smarty_tpl->tpl_vars['feature']->value['feature_type']==smarty_modifier_enum("ProductFeatures::MULTIPLE_CHECKBOX")&&$_smarty_tpl->tpl_vars['feature']->value['variants']) {?><ul class="ty-compare-list"><?php  $_smarty_tpl->tpl_vars["var"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["var"]->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['feature']->value['variants']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["var"]->key => $_smarty_tpl->tpl_vars["var"]->value) {
$_smarty_tpl->tpl_vars["var"]->_loop = true;
if ($_smarty_tpl->tpl_vars['var']->value['selected']) {?><li class="ty-compare-list__item"><span class="ty-compare-checkbox" title="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['var']->value['variant'], ENT_QUOTES, 'UTF-8');?>
"><i class="ty-compare-checkbox__icon ty-icon-ok"></i></span><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['var']->value['variant'], ENT_QUOTES, 'UTF-8');?>
</li><?php }
} ?></ul><?php } elseif ($_smarty_tpl->tpl_vars['feature']->value['feature_type']==smarty_modifier_enum("ProductFeatures::TEXT_SELECTBOX")||$_smarty_tpl->tpl_vars['feature']->value['feature_type']==smarty_modifier_enum("ProductFeatures::EXTENDED")) {
$_smarty_tpl->tpl_vars["var"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["var"]->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['feature']->value['variants']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["var"]->key => $_smarty_tpl->tpl_vars["var"]->value) {
$_smarty_tpl->tpl_vars["var"]->_loop = true;
if ($_smarty_tpl->tpl_vars['var']->value['selected']) {
echo htmlspecialchars($_smarty_tpl->tpl_vars['var']->value['variant'], ENT_QUOTES, 'UTF-8');
}
}
} elseif ($_smarty_tpl->tpl_vars['feature']->value['feature_type']==smarty_modifier_enum("ProductFeatures::NUMBER_SELECTBOX")||$_smarty_tpl->tpl_vars['feature']->value['feature_type']==smarty_modifier_enum("ProductFeatures::NUMBER_FIELD")) {
echo htmlspecialchars((($tmp = @floatval($_smarty_tpl->tpl_vars['feature']->value['value_int']))===null||$tmp==='' ? "-" : $tmp), ENT_QUOTES, 'UTF-8');
} else {
echo htmlspecialchars((($tmp = @$_smarty_tpl->tpl_vars['feature']->value['value'])===null||$tmp==='' ? "-" : $tmp), ENT_QUOTES, 'UTF-8');
}
if ($_smarty_tpl->tpl_vars['feature']->value['suffix']) {
echo htmlspecialchars($_smarty_tpl->tpl_vars['feature']->value['suffix'], ENT_QUOTES, 'UTF-8');
}?>
                            <?php } ?>
                        </tr>
                    <?php } ?>
                <?php } ?>
                </table>
            </div>
        </div>
    </div>

    <div class="buttons-container ty-compare__buttons">
        <?php $_smarty_tpl->tpl_vars["r_url"] = new Smarty_variable(fn_url(''), null, 0);?>
        <?php echo $_smarty_tpl->getSubTemplate ("buttons/continue_shopping.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('but_href'=>fn_url($_smarty_tpl->tpl_vars['continue_url']->value),'but_role'=>"text"), 0);?>

        <?php echo $_smarty_tpl->getSubTemplate ("buttons/button.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('but_text'=>__("clear_list"),'but_href'=>"product_features.clear_list?redirect_url=".((string)$_smarty_tpl->tpl_vars['r_url']->value),'but_meta'=>"ty-btn__tertiary"), 0);?>

    </div>

    <?php if ($_smarty_tpl->tpl_vars['comparison_data']->value['hidden_features']) {?>
    <?php echo $_smarty_tpl->getSubTemplate ("common/subheader.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('title'=>__("add_feature")), 0);?>

    <form action="<?php echo htmlspecialchars(fn_url(''), ENT_QUOTES, 'UTF-8');?>
" method="post" name="add_feature_form">
        <input type="hidden" name="redirect_url" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['config']->value['current_url'], ENT_QUOTES, 'UTF-8');?>
" />
        <?php echo smarty_function_html_checkboxes(array('name'=>"add_features",'options'=>$_smarty_tpl->tpl_vars['comparison_data']->value['hidden_features'],'columns'=>"4"),$_smarty_tpl);?>

        <div class="buttons-container ty-mt-s">
            <?php echo $_smarty_tpl->getSubTemplate ("buttons/button.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('but_text'=>__("add"),'but_name'=>"dispatch[product_features.add_feature]"), 0);?>

        </div>
    </form>
    <?php }?>
<?php }?>

<?php $_smarty_tpl->_capture_stack[0][] = array("mainbox_title", null, null); ob_start();
echo $_smarty_tpl->__("compare");
list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();
list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();
if (trim(Smarty::$_smarty_vars['capture']['template_content'])) {
if ($_smarty_tpl->tpl_vars['auth']->value['area']=="A") {?><span class="cm-template-box template-box" data-ca-te-template="views/product_features/compare.tpl" id="<?php echo smarty_function_set_id(array('name'=>"views/product_features/compare.tpl"),$_smarty_tpl);?>
"><div class="cm-template-icon icon-edit ty-icon-edit hidden"></div><?php echo Smarty::$_smarty_vars['capture']['template_content'];?>
<!--[/tpl_id]--></span><?php } else {
echo Smarty::$_smarty_vars['capture']['template_content'];
}
}
} else {
if (!$_smarty_tpl->tpl_vars['comparison_data']->value) {?>
    <p class="ty-no-items ty-compare__no-items"><?php echo $_smarty_tpl->__("no_products_selected");?>
</p>
    <div class="buttons-container ty-compare__button-empty">
        <?php echo $_smarty_tpl->getSubTemplate ("buttons/continue_shopping.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('but_href'=>fn_url($_smarty_tpl->tpl_vars['continue_url']->value),'but_role'=>"text"), 0);?>

    </div>
<?php } else { ?>
    <?php echo smarty_function_script(array('src'=>"js/tygh/exceptions.js"),$_smarty_tpl);?>

    <?php $_smarty_tpl->tpl_vars["return_current_url"] = new Smarty_variable(rawurlencode($_smarty_tpl->tpl_vars['config']->value['current_url']), null, 0);?>
    <div class="ty-compare">
        <div class="ty-compare__wrapper">
            <table class="ty-compare-products">
                <tr>
                    <td class="ty-compare-products__menu">
                        <ul class="ty-compare-menu">
                            <li class="ty-compare-menu__item"><?php if ($_smarty_tpl->tpl_vars['action']->value!="show_all") {?><a class="ty-compare-menu__a" href="<?php echo htmlspecialchars(fn_url("product_features.compare.show_all"), ENT_QUOTES, 'UTF-8');?>
"><?php echo $_smarty_tpl->__("all_features");?>
</a><?php } else { ?><span class="ty-compare-menu__elem"><?php echo $_smarty_tpl->__("all_features");?>
</span><?php }?></li>
                            <li class="ty-compare-menu__item"><?php if ($_smarty_tpl->tpl_vars['action']->value!="similar_only") {?><a class="ty-compare-menu__a" href="<?php echo htmlspecialchars(fn_url("product_features.compare.similar_only"), ENT_QUOTES, 'UTF-8');?>
"><?php echo $_smarty_tpl->__("similar_only");?>
</a><?php } else { ?><span class="ty-compare-menu__elem"><?php echo $_smarty_tpl->__("similar_only");?>
</span><?php }?></li>
                            <li class="ty-compare-menu__item"><?php if ($_smarty_tpl->tpl_vars['action']->value!="different_only") {?><a class="ty-compare-menu__a" href="<?php echo htmlspecialchars(fn_url("product_features.compare.different_only"), ENT_QUOTES, 'UTF-8');?>
"><?php echo $_smarty_tpl->__("different_only");?>
</a><?php } else { ?><span class="ty-compare-menu__elem"><?php echo $_smarty_tpl->__("different_only");?>
</span><?php }?></li>
                        </ul>
                    </td>
                    <?php  $_smarty_tpl->tpl_vars['product'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['product']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['comparison_data']->value['products']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['product']->key => $_smarty_tpl->tpl_vars['product']->value) {
$_smarty_tpl->tpl_vars['product']->_loop = true;
?>
                    <td class="ty-compare-products__product">
                        <div class="ty-compare-products__item">
                            <div class="ty-compare-products__delete"><a href="<?php echo htmlspecialchars(fn_url("product_features.delete_product?product_id=".((string)$_smarty_tpl->tpl_vars['product']->value['product_id'])."&redirect_url=".((string)$_smarty_tpl->tpl_vars['return_current_url']->value)), ENT_QUOTES, 'UTF-8');?>
" class="ty-remove"  title="<?php echo $_smarty_tpl->__("remove");?>
"><i class="ty-remove__icon ty-icon-cancel-circle"></i><span class="ty-remove__txt"><?php echo $_smarty_tpl->__("remove");?>
</span></a></div>
                            <div class="ty-compare-products__img"><a href="<?php echo htmlspecialchars(fn_url("products.view?product_id=".((string)$_smarty_tpl->tpl_vars['product']->value['product_id'])), ENT_QUOTES, 'UTF-8');?>
"><?php echo $_smarty_tpl->getSubTemplate ("common/image.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('image_width'=>$_smarty_tpl->tpl_vars['settings']->value['Thumbnails']['product_lists_thumbnail_width'],'image_height'=>$_smarty_tpl->tpl_vars['settings']->value['Thumbnails']['product_lists_thumbnail_height'],'obj_id'=>$_smarty_tpl->tpl_vars['product']->value['product_id'],'images'=>$_smarty_tpl->tpl_vars['product']->value['main_pair'],'no_ids'=>true), 0);?>
</a></div>
                        </div>

                        <div class="ty-compare-products__item">
                            <a href="<?php echo htmlspecialchars(fn_url("products.view?product_id=".((string)$_smarty_tpl->tpl_vars['product']->value['product_id'])), ENT_QUOTES, 'UTF-8');?>
"><?php echo $_smarty_tpl->tpl_vars['product']->value['product'];?>
</a>
                        </div>

                        <?php $_smarty_tpl->tpl_vars["obj_id"] = new Smarty_variable($_smarty_tpl->tpl_vars['product']->value['product_id'], null, 0);?>
                        <?php echo $_smarty_tpl->getSubTemplate ("common/product_data.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('product'=>$_smarty_tpl->tpl_vars['product']->value,'show_old_price'=>true,'show_price_values'=>true,'show_price'=>true,'show_clean_price'=>true), 0);?>

                        <div class="ty-compare-products__item">
                            <?php $_smarty_tpl->tpl_vars["old_price"] = new Smarty_variable("old_price_".((string)$_smarty_tpl->tpl_vars['obj_id']->value), null, 0);?>
                            <?php if (trim(Smarty::$_smarty_vars['capture'][$_smarty_tpl->tpl_vars['old_price']->value])) {
echo Smarty::$_smarty_vars['capture'][$_smarty_tpl->tpl_vars['old_price']->value];
}?>

                            <?php $_smarty_tpl->tpl_vars["price"] = new Smarty_variable("price_".((string)$_smarty_tpl->tpl_vars['obj_id']->value), null, 0);?>
                            <?php echo Smarty::$_smarty_vars['capture'][$_smarty_tpl->tpl_vars['price']->value];?>


                            <?php $_smarty_tpl->tpl_vars["clean_price"] = new Smarty_variable("clean_price_".((string)$_smarty_tpl->tpl_vars['obj_id']->value), null, 0);?>
                            <?php echo Smarty::$_smarty_vars['capture'][$_smarty_tpl->tpl_vars['clean_price']->value];?>

                        </div>

                        <div class="ty-compare-products__item"><?php echo $_smarty_tpl->getSubTemplate ("blocks/list_templates/simple_list.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('min_qty'=>true,'product'=>$_smarty_tpl->tpl_vars['product']->value,'show_add_to_cart'=>true,'but_role'=>"action",'hide_price'=>true), 0);?>
</div>
                    </td>
                    <?php } ?>
                </tr>
            </table>
    
            <div class="ty-compare-feature">
                <table class="ty-compare-feature__table">
                <?php  $_smarty_tpl->tpl_vars["group_features"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["group_features"]->_loop = false;
 $_smarty_tpl->tpl_vars["group_id"] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['comparison_data']->value['product_features']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["group_features"]->key => $_smarty_tpl->tpl_vars["group_features"]->value) {
$_smarty_tpl->tpl_vars["group_features"]->_loop = true;
 $_smarty_tpl->tpl_vars["group_id"]->value = $_smarty_tpl->tpl_vars["group_features"]->key;
?>
                    <?php  $_smarty_tpl->tpl_vars["_feature"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["_feature"]->_loop = false;
 $_smarty_tpl->tpl_vars['id'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['group_features']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["_feature"]->key => $_smarty_tpl->tpl_vars["_feature"]->value) {
$_smarty_tpl->tpl_vars["_feature"]->_loop = true;
 $_smarty_tpl->tpl_vars['id']->value = $_smarty_tpl->tpl_vars["_feature"]->key;
?>
                        <tr class="ty-compare-feature__row">
                            <td class="ty-compare-feature__item ty-compare-sort">
                                <strong class="ty-compare-sort__title"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['_feature']->value, ENT_QUOTES, 'UTF-8');?>
:</strong>
                                    <a href="<?php echo htmlspecialchars(fn_url("product_features.delete_feature?feature_id=".((string)$_smarty_tpl->tpl_vars['id']->value)."&redirect_url=".((string)$_smarty_tpl->tpl_vars['return_current_url']->value)), ENT_QUOTES, 'UTF-8');?>
" class="ty-compare-sort__a ty-icon-cancel-circle" title="<?php echo $_smarty_tpl->__("remove");?>
"></a>
                            </td>
                            <?php  $_smarty_tpl->tpl_vars['product'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['product']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['comparison_data']->value['products']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['product']->key => $_smarty_tpl->tpl_vars['product']->value) {
$_smarty_tpl->tpl_vars['product']->_loop = true;
?>
                                <td class="ty-compare-feature__item ty-compare-feature_item_size">

                                <?php if ($_smarty_tpl->tpl_vars['product']->value['product_features'][$_smarty_tpl->tpl_vars['id']->value]) {?>
                                    <?php $_smarty_tpl->tpl_vars["feature"] = new Smarty_variable($_smarty_tpl->tpl_vars['product']->value['product_features'][$_smarty_tpl->tpl_vars['id']->value], null, 0);?>
                                <?php } else { ?>
                                    <?php $_smarty_tpl->tpl_vars["feature"] = new Smarty_variable($_smarty_tpl->tpl_vars['product']->value['product_features'][$_smarty_tpl->tpl_vars['group_id']->value]['subfeatures'][$_smarty_tpl->tpl_vars['id']->value], null, 0);?>
                                <?php }?>

                                <?php if ($_smarty_tpl->tpl_vars['feature']->value['prefix']) {
echo htmlspecialchars($_smarty_tpl->tpl_vars['feature']->value['prefix'], ENT_QUOTES, 'UTF-8');
}
if ($_smarty_tpl->tpl_vars['feature']->value['feature_type']==smarty_modifier_enum("ProductFeatures::SINGLE_CHECKBOX")) {?><span class="ty-compare-checkbox" title="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['feature']->value['value'], ENT_QUOTES, 'UTF-8');?>
"><?php if ($_smarty_tpl->tpl_vars['feature']->value['value']=="Y") {?><i class="ty-compare-checkbox__icon ty-icon-ok"></i><?php }?></span><?php } elseif ($_smarty_tpl->tpl_vars['feature']->value['feature_type']==smarty_modifier_enum("ProductFeatures::DATE")) {
echo htmlspecialchars(smarty_modifier_date_format($_smarty_tpl->tpl_vars['feature']->value['value_int'],((string)$_smarty_tpl->tpl_vars['settings']->value['Appearance']['date_format'])), ENT_QUOTES, 'UTF-8');
} elseif ($_smarty_tpl->tpl_vars['feature']->value['feature_type']==smarty_modifier_enum("ProductFeatures::MULTIPLE_CHECKBOX")&&$_smarty_tpl->tpl_vars['feature']->value['variants']) {?><ul class="ty-compare-list"><?php  $_smarty_tpl->tpl_vars["var"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["var"]->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['feature']->value['variants']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["var"]->key => $_smarty_tpl->tpl_vars["var"]->value) {
$_smarty_tpl->tpl_vars["var"]->_loop = true;
if ($_smarty_tpl->tpl_vars['var']->value['selected']) {?><li class="ty-compare-list__item"><span class="ty-compare-checkbox" title="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['var']->value['variant'], ENT_QUOTES, 'UTF-8');?>
"><i class="ty-compare-checkbox__icon ty-icon-ok"></i></span><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['var']->value['variant'], ENT_QUOTES, 'UTF-8');?>
</li><?php }
} ?></ul><?php } elseif ($_smarty_tpl->tpl_vars['feature']->value['feature_type']==smarty_modifier_enum("ProductFeatures::TEXT_SELECTBOX")||$_smarty_tpl->tpl_vars['feature']->value['feature_type']==smarty_modifier_enum("ProductFeatures::EXTENDED")) {
$_smarty_tpl->tpl_vars["var"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["var"]->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['feature']->value['variants']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["var"]->key => $_smarty_tpl->tpl_vars["var"]->value) {
$_smarty_tpl->tpl_vars["var"]->_loop = true;
if ($_smarty_tpl->tpl_vars['var']->value['selected']) {
echo htmlspecialchars($_smarty_tpl->tpl_vars['var']->value['variant'], ENT_QUOTES, 'UTF-8');
}
}
} elseif ($_smarty_tpl->tpl_vars['feature']->value['feature_type']==smarty_modifier_enum("ProductFeatures::NUMBER_SELECTBOX")||$_smarty_tpl->tpl_vars['feature']->value['feature_type']==smarty_modifier_enum("ProductFeatures::NUMBER_FIELD")) {
echo htmlspecialchars((($tmp = @floatval($_smarty_tpl->tpl_vars['feature']->value['value_int']))===null||$tmp==='' ? "-" : $tmp), ENT_QUOTES, 'UTF-8');
} else {
echo htmlspecialchars((($tmp = @$_smarty_tpl->tpl_vars['feature']->value['value'])===null||$tmp==='' ? "-" : $tmp), ENT_QUOTES, 'UTF-8');
}
if ($_smarty_tpl->tpl_vars['feature']->value['suffix']) {
echo htmlspecialchars($_smarty_tpl->tpl_vars['feature']->value['suffix'], ENT_QUOTES, 'UTF-8');
}?>
                            <?php } ?>
                        </tr>
                    <?php } ?>
                <?php } ?>
                </table>
            </div>
        </div>
    </div>

    <div class="buttons-container ty-compare__buttons">
        <?php $_smarty_tpl->tpl_vars["r_url"] = new Smarty_variable(fn_url(''), null, 0);?>
        <?php echo $_smarty_tpl->getSubTemplate ("buttons/continue_shopping.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('but_href'=>fn_url($_smarty_tpl->tpl_vars['continue_url']->value),'but_role'=>"text"), 0);?>

        <?php echo $_smarty_tpl->getSubTemplate ("buttons/button.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('but_text'=>__("clear_list"),'but_href'=>"product_features.clear_list?redirect_url=".((string)$_smarty_tpl->tpl_vars['r_url']->value),'but_meta'=>"ty-btn__tertiary"), 0);?>

    </div>

    <?php if ($_smarty_tpl->tpl_vars['comparison_data']->value['hidden_features']) {?>
    <?php echo $_smarty_tpl->getSubTemplate ("common/subheader.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('title'=>__("add_feature")), 0);?>

    <form action="<?php echo htmlspecialchars(fn_url(''), ENT_QUOTES, 'UTF-8');?>
" method="post" name="add_feature_form">
        <input type="hidden" name="redirect_url" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['config']->value['current_url'], ENT_QUOTES, 'UTF-8');?>
" />
        <?php echo smarty_function_html_checkboxes(array('name'=>"add_features",'options'=>$_smarty_tpl->tpl_vars['comparison_data']->value['hidden_features'],'columns'=>"4"),$_smarty_tpl);?>

        <div class="buttons-container ty-mt-s">
            <?php echo $_smarty_tpl->getSubTemplate ("buttons/button.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('but_text'=>__("add"),'but_name'=>"dispatch[product_features.add_feature]"), 0);?>

        </div>
    </form>
    <?php }?>
<?php }?>

<?php $_smarty_tpl->_capture_stack[0][] = array("mainbox_title", null, null); ob_start();
echo $_smarty_tpl->__("compare");
list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();
}?><?php }} ?>
