<?php /* Smarty version Smarty-3.1.21, created on 2015-09-18 23:14:35
         compiled from "/var/www/bygmarket.com/design/themes/responsive/templates/addons/gift_certificates/hooks/checkout/extra_list.post.tpl" */ ?>
<?php /*%%SmartyHeaderCode:171691784955fc70ab426662-78423400%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c01dc2b4db65ede49590dd3edc5d32b7ca229b27' => 
    array (
      0 => '/var/www/bygmarket.com/design/themes/responsive/templates/addons/gift_certificates/hooks/checkout/extra_list.post.tpl',
      1 => 1442595902,
      2 => 'tygh',
    ),
  ),
  'nocache_hash' => '171691784955fc70ab426662-78423400',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'runtime' => 0,
    'cart' => 0,
    'config' => 0,
    'gift' => 0,
    'gift_key' => 0,
    'show_images' => 0,
    'obj_id' => 0,
    'settings' => 0,
    'ajax_class' => 0,
    'c_url' => 0,
    'use_ajax' => 0,
    'addons' => 0,
    'cart_products' => 0,
    'key' => 0,
    'product' => 0,
    'auth' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21',
  'unifunc' => 'content_55fc70ab6f0a08_28438884',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55fc70ab6f0a08_28438884')) {function content_55fc70ab6f0a08_28438884($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_truncate')) include '/var/www/bygmarket.com/app/functions/smarty_plugins/modifier.truncate.php';
if (!is_callable('smarty_block_hook')) include '/var/www/bygmarket.com/app/functions/smarty_plugins/block.hook.php';
if (!is_callable('smarty_function_set_id')) include '/var/www/bygmarket.com/app/functions/smarty_plugins/function.set_id.php';
?><?php
fn_preload_lang_vars(array('edit','gift_certificate','remove','gift_certificate','gift_cert_to','gift_cert_from','amount','send_via','email','postal_mail','free_products','remove','price','qty','discount','tax','subtotal','price_summary','free','free','free','edit','gift_certificate','remove','gift_certificate','gift_cert_to','gift_cert_from','amount','send_via','email','postal_mail','free_products','remove','price','qty','discount','tax','subtotal','price_summary','free','free','free'));
?>
<?php if ($_smarty_tpl->tpl_vars['runtime']->value['customization_mode']['design']=="Y"&&@constant('AREA')=="C") {
$_smarty_tpl->_capture_stack[0][] = array("template_content", null, null); ob_start();
if ($_smarty_tpl->tpl_vars['cart']->value['gift_certificates']) {?>

<?php $_smarty_tpl->tpl_vars["c_url"] = new Smarty_variable(rawurlencode($_smarty_tpl->tpl_vars['config']->value['current_url']), null, 0);?>

<?php  $_smarty_tpl->tpl_vars["gift"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["gift"]->_loop = false;
 $_smarty_tpl->tpl_vars["gift_key"] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['cart']->value['gift_certificates']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["gift"]->key => $_smarty_tpl->tpl_vars["gift"]->value) {
$_smarty_tpl->tpl_vars["gift"]->_loop = true;
 $_smarty_tpl->tpl_vars["gift_key"]->value = $_smarty_tpl->tpl_vars["gift"]->key;
?>
<?php $_smarty_tpl->tpl_vars["obj_id"] = new Smarty_variable((($tmp = @$_smarty_tpl->tpl_vars['gift']->value['object_id'])===null||$tmp==='' ? $_smarty_tpl->tpl_vars['gift_key']->value : $tmp), null, 0);?>
<?php if (!Smarty::$_smarty_vars['capture']['prods']) {?>
    <?php $_smarty_tpl->_capture_stack[0][] = array("prods", null, null); ob_start(); ?>Y<?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>
<?php }?>
<tr>
    <td class="ty-cart-content__product-elem ty-cart-content__image-block">
        <?php if ($_smarty_tpl->tpl_vars['runtime']->value['mode']=="cart"||$_smarty_tpl->tpl_vars['show_images']->value) {?>
            <div class="ty-cart-content__image cm-reload-<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_id']->value, ENT_QUOTES, 'UTF-8');?>
" id="product_image_update_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_id']->value, ENT_QUOTES, 'UTF-8');?>
">
                <?php if (!$_smarty_tpl->tpl_vars['gift']->value['extra']['exclude_from_calculate']) {?>
                    <a href="<?php echo htmlspecialchars(fn_url("gift_certificates.update?gift_cert_id=".((string)$_smarty_tpl->tpl_vars['gift_key']->value)), ENT_QUOTES, 'UTF-8');?>
">
                    <?php echo $_smarty_tpl->getSubTemplate ("addons/gift_certificates/views/gift_certificates/components/gift_certificates_cart_icon.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('width'=>$_smarty_tpl->tpl_vars['settings']->value['Thumbnails']['product_cart_thumbnail_width'],'height'=>$_smarty_tpl->tpl_vars['settings']->value['Thumbnails']['product_cart_thumbnail_height']), 0);?>

                    </a>
                    <div class="ty-mtb-xs ty-center"><?php echo $_smarty_tpl->getSubTemplate ("buttons/button.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('but_text'=>__("edit"),'but_href'=>"gift_certificates.update?gift_cert_id=".((string)$_smarty_tpl->tpl_vars['gift_key']->value),'but_role'=>"text"), 0);?>
</div>
                <?php } else { ?>
                    <?php echo $_smarty_tpl->getSubTemplate ("addons/gift_certificates/views/gift_certificates/components/gift_certificates_cart_icon.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('width'=>$_smarty_tpl->tpl_vars['settings']->value['Thumbnails']['product_cart_thumbnail_width'],'height'=>$_smarty_tpl->tpl_vars['settings']->value['Thumbnails']['product_cart_thumbnail_height']), 0);?>

                <?php }?>
            <!--product_image_update_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_id']->value, ENT_QUOTES, 'UTF-8');?>
--></div>
        <?php }?>
    </td>

    <td class="ty-cart-content__product-elem ty-cart-content__description" style="width: 50%;">
        <?php if (!$_smarty_tpl->tpl_vars['gift']->value['extra']['exclude_from_calculate']) {?>
            <a href="<?php echo htmlspecialchars(fn_url("gift_certificates.update?gift_cert_id=".((string)$_smarty_tpl->tpl_vars['gift_key']->value)), ENT_QUOTES, 'UTF-8');?>
" class="ty-cart-content__product-title">
                <?php echo $_smarty_tpl->__("gift_certificate");?>

            </a>
            <?php if (!$_smarty_tpl->tpl_vars['gift']->value['extra']['exclude_from_calculate']) {?>
                <a class="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['ajax_class']->value, ENT_QUOTES, 'UTF-8');?>
 cm-post ty-delete-big" href="<?php echo htmlspecialchars(fn_url("gift_certificates.delete?gift_cert_id=".((string)$_smarty_tpl->tpl_vars['gift_key']->value)."&redirect_url=".((string)$_smarty_tpl->tpl_vars['c_url']->value)), ENT_QUOTES, 'UTF-8');?>
"  data-ca-target-id="cart_items,checkout_totals,cart_status*,checkout_steps,checkout_cart" title="<?php echo $_smarty_tpl->__("remove");?>
">
                    <i class="ty-delete-big__icon ty-icon-cancel-circle"></i>
                </a>
            <?php }?>
            <?php if ($_smarty_tpl->tpl_vars['use_ajax']->value==true&&$_smarty_tpl->tpl_vars['cart']->value['amount']!=1) {?>
                <?php $_smarty_tpl->tpl_vars["ajax_class"] = new Smarty_variable("cm-ajax", null, 0);?>
            <?php }?>
        <?php } else { ?>
            <strong><?php echo $_smarty_tpl->__("gift_certificate");?>
</strong>
        <?php }?>
        <div class="ty-control-group">
            <label class="ty-control-group__label"><?php echo $_smarty_tpl->__("gift_cert_to");?>
:</label><span class="ty-control-group__item"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['gift']->value['recipient'], ENT_QUOTES, 'UTF-8');?>
</span>
        </div>
        <div class="ty-control-group">
            <label class="ty-control-group__label"><?php echo $_smarty_tpl->__("gift_cert_from");?>
:</label><span class="ty-control-group__item"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['gift']->value['sender'], ENT_QUOTES, 'UTF-8');?>
</span>
        </div>
        <div class="ty-control-group">
            <label class="ty-control-group__label"><?php echo $_smarty_tpl->__("amount");?>
:</label><span class="ty-control-group__item"><?php echo $_smarty_tpl->getSubTemplate ("common/price.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('value'=>$_smarty_tpl->tpl_vars['gift']->value['amount']), 0);?>
</span>
        </div>
        <div class="ty-control-group">
            <label class="ty-control-group__label"><?php echo $_smarty_tpl->__("send_via");?>
:</label><span class="ty-control-group__item"><?php if ($_smarty_tpl->tpl_vars['gift']->value['send_via']=="E") {
echo $_smarty_tpl->__("email");
} else {
echo $_smarty_tpl->__("postal_mail");
}?></span>
        </div>
        <?php if ($_smarty_tpl->tpl_vars['gift']->value['products']&&$_smarty_tpl->tpl_vars['addons']->value['gift_certificates']['free_products_allow']=="Y"&&!$_smarty_tpl->tpl_vars['gift']->value['extra']['exclude_from_calculate']) {?>
        
        <a id="sw_gift_products_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['gift_key']->value, ENT_QUOTES, 'UTF-8');?>
" class="cm-combination ty-cart-content__detailed-link"><?php echo $_smarty_tpl->__("free_products");?>
</a>

        <div id="gift_products_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['gift_key']->value, ENT_QUOTES, 'UTF-8');?>
" class="hidden">
            <div class="ty-cart-content-products">
            <div class="ty-caret-info"><span class="ty-caret-outer"></span> <span class="ty-caret-inner"></span></div>
            <?php  $_smarty_tpl->tpl_vars["product"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["product"]->_loop = false;
 $_smarty_tpl->tpl_vars["key"] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['cart_products']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["product"]->key => $_smarty_tpl->tpl_vars["product"]->value) {
$_smarty_tpl->tpl_vars["product"]->_loop = true;
 $_smarty_tpl->tpl_vars["key"]->value = $_smarty_tpl->tpl_vars["product"]->key;
?>
            <?php if ($_smarty_tpl->tpl_vars['cart']->value['products'][$_smarty_tpl->tpl_vars['key']->value]['extra']['parent']['certificate']==$_smarty_tpl->tpl_vars['gift_key']->value) {?>
                <div class="ty-cart-content-products__item">
                    <div>
                        <a href="<?php echo htmlspecialchars(fn_url("products.view?product_id=".((string)$_smarty_tpl->tpl_vars['product']->value['product_id'])), ENT_QUOTES, 'UTF-8');?>
" title="<?php echo $_smarty_tpl->tpl_vars['product']->value['product'];?>
"><?php echo smarty_modifier_truncate(preg_replace('!<[^>]*?>!', ' ', $_smarty_tpl->tpl_vars['product']->value['product']),70,"...",true);?>
</a>
                        <?php if ($_smarty_tpl->tpl_vars['use_ajax']->value==true) {?>
                            <?php $_smarty_tpl->tpl_vars["ajax_class"] = new Smarty_variable("cm-ajax", null, 0);?>
                        <?php }?>
                        <a class="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['ajax_class']->value, ENT_QUOTES, 'UTF-8');?>
 ty-delete-big" href="<?php echo htmlspecialchars(fn_url("checkout.delete?cart_id=".((string)$_smarty_tpl->tpl_vars['key']->value)."&redirect_url=".((string)$_smarty_tpl->tpl_vars['c_url']->value)), ENT_QUOTES, 'UTF-8');?>
" data-ca-target-id="cart_items,checkout_totals,cart_status*,checkout_steps" title="<?php echo $_smarty_tpl->__("remove");?>
"><i class="ty-delete-big__icon ty-icon-cancel-circle"></i></a>
                        <?php echo $_smarty_tpl->getSubTemplate ("common/options_info.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('product_options'=>fn_get_selected_product_options_info($_smarty_tpl->tpl_vars['cart']->value['products'][$_smarty_tpl->tpl_vars['key']->value]['product_options']),'fields_prefix'=>"cart_products[".((string)$_smarty_tpl->tpl_vars['key']->value)."][product_options]"), 0);?>

                        <?php $_smarty_tpl->smarty->_tag_stack[] = array('hook', array('name'=>"checkout:product_info")); $_block_repeat=true; echo smarty_block_hook(array('name'=>"checkout:product_info"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();
$_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_hook(array('name'=>"checkout:product_info"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

                        <input type="hidden" name="cart_products[<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['key']->value, ENT_QUOTES, 'UTF-8');?>
][extra][parent][certificate]" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['gift_key']->value, ENT_QUOTES, 'UTF-8');?>
" />
                    </div>
                    <div class="ty-control-group">
                        <strong class="ty-control-group__label"><?php echo $_smarty_tpl->__("price");?>
</strong>
                        <span class="ty-control-group__item">
                            <?php echo $_smarty_tpl->getSubTemplate ("common/price.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('value'=>$_smarty_tpl->tpl_vars['product']->value['original_price']), 0);?>

                        </span>
                    </div>
                    <div class="ty-control-group">
                        <strong class="ty-control-group__label"><?php echo $_smarty_tpl->__("qty");?>
</strong>
                        <input type="text" size="3" name="cart_products[<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['key']->value, ENT_QUOTES, 'UTF-8');?>
][amount]" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['amount'], ENT_QUOTES, 'UTF-8');?>
" class="ty-input-text-short" <?php if ($_smarty_tpl->tpl_vars['product']->value['is_edp']=="Y") {?>readonly="readonly"<?php }?> />
                        <input type="hidden" name="cart_products[<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['key']->value, ENT_QUOTES, 'UTF-8');?>
][product_id]" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['product_id'], ENT_QUOTES, 'UTF-8');?>
" />
                    </div>
                    <?php if ($_smarty_tpl->tpl_vars['cart']->value['use_discount']) {?>
                    <div class="ty-control-group">
                        <strong class="ty-control-group__label"><?php echo $_smarty_tpl->__("discount");?>
</strong>
                        <span class="ty-control-group__item">
                            <?php if (floatval($_smarty_tpl->tpl_vars['product']->value['discount'])) {
echo $_smarty_tpl->getSubTemplate ("common/price.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('value'=>$_smarty_tpl->tpl_vars['product']->value['discount']), 0);
} else { ?>-<?php }?>
                        </span>
                    </div>
                    <?php }?>
                    <?php if ($_smarty_tpl->tpl_vars['cart']->value['taxes']&&$_smarty_tpl->tpl_vars['settings']->value['General']['tax_calculation']!="subtotal") {?>
                    <div class="ty-control-group">
                        <strong class="ty-control-group__label"><?php echo $_smarty_tpl->__("tax");?>
</strong>
                        <span class="ty-control-group__item">
                            <?php echo $_smarty_tpl->getSubTemplate ("common/price.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('value'=>$_smarty_tpl->tpl_vars['product']->value['tax_summary']['total']), 0);?>

                        </span>
                    </div>
                    <?php }?>
                    <div class="ty-control-group">
                        <strong class="ty-control-group__label"><?php echo $_smarty_tpl->__("subtotal");?>
</strong>
                        <span class="ty-control-group__item">
                            <?php echo $_smarty_tpl->getSubTemplate ("common/price.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('value'=>$_smarty_tpl->tpl_vars['product']->value['display_subtotal']), 0);?>

                        </span>
                    </div>
                </div>
            <?php }?>
            <?php } ?>
            </div>
            <div class="ty-control-group ty-float-right">
                <strong><?php echo $_smarty_tpl->__("price_summary");?>
:&nbsp;</strong>
                <?php if (!$_smarty_tpl->tpl_vars['gift']->value['extra']['exclude_from_calculate']) {
echo $_smarty_tpl->getSubTemplate ("common/price.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('value'=>$_smarty_tpl->tpl_vars['gift']->value['display_subtotal'],'class'=>"ty-price"), 0);
} else { ?><span class="ty-price"><?php echo $_smarty_tpl->__("free");?>
</span><?php }?>
            </div>
            <div class="clearfix"></div>
        </div>
        <?php }?>
    </td>
    <td class="ty-cart-content__product-elem ty-cart-content__price cm-reload-<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_id']->value, ENT_QUOTES, 'UTF-8');?>
" id="price_display_update_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_id']->value, ENT_QUOTES, 'UTF-8');?>
">
        <?php if (!$_smarty_tpl->tpl_vars['gift']->value['extra']['exclude_from_calculate']) {
echo $_smarty_tpl->getSubTemplate ("common/price.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('value'=>$_smarty_tpl->tpl_vars['gift']->value['display_subtotal'],'class'=>"ty-sub-price"), 0);
} else { ?><span class="ty-price"><?php echo $_smarty_tpl->__("free");?>
</span><?php }?>
    <!--price_display_update_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_id']->value, ENT_QUOTES, 'UTF-8');?>
--></td>
    <td class="ty-cart-content__product-elem ty-cart-content__qty">
    </td>
    <td class="ty-cart-content__product-elem ty-cart-content__price cm-reload-<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_id']->value, ENT_QUOTES, 'UTF-8');?>
" id="price_subtotal_update_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_id']->value, ENT_QUOTES, 'UTF-8');?>
">
        <?php if (!$_smarty_tpl->tpl_vars['gift']->value['extra']['exclude_from_calculate']) {
echo $_smarty_tpl->getSubTemplate ("common/price.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('value'=>$_smarty_tpl->tpl_vars['gift']->value['display_subtotal'],'class'=>"price"), 0);
} else { ?><span class="ty-price"><?php echo $_smarty_tpl->__("free");?>
</span><?php }?>
    <!--price_subtotal_update_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_id']->value, ENT_QUOTES, 'UTF-8');?>
--></td>
</tr>
<?php } ?>

<?php }?>
<?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();
if (trim(Smarty::$_smarty_vars['capture']['template_content'])) {
if ($_smarty_tpl->tpl_vars['auth']->value['area']=="A") {?><span class="cm-template-box template-box" data-ca-te-template="addons/gift_certificates/hooks/checkout/extra_list.post.tpl" id="<?php echo smarty_function_set_id(array('name'=>"addons/gift_certificates/hooks/checkout/extra_list.post.tpl"),$_smarty_tpl);?>
"><div class="cm-template-icon icon-edit ty-icon-edit hidden"></div><?php echo Smarty::$_smarty_vars['capture']['template_content'];?>
<!--[/tpl_id]--></span><?php } else {
echo Smarty::$_smarty_vars['capture']['template_content'];
}
}
} else {
if ($_smarty_tpl->tpl_vars['cart']->value['gift_certificates']) {?>

<?php $_smarty_tpl->tpl_vars["c_url"] = new Smarty_variable(rawurlencode($_smarty_tpl->tpl_vars['config']->value['current_url']), null, 0);?>

<?php  $_smarty_tpl->tpl_vars["gift"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["gift"]->_loop = false;
 $_smarty_tpl->tpl_vars["gift_key"] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['cart']->value['gift_certificates']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["gift"]->key => $_smarty_tpl->tpl_vars["gift"]->value) {
$_smarty_tpl->tpl_vars["gift"]->_loop = true;
 $_smarty_tpl->tpl_vars["gift_key"]->value = $_smarty_tpl->tpl_vars["gift"]->key;
?>
<?php $_smarty_tpl->tpl_vars["obj_id"] = new Smarty_variable((($tmp = @$_smarty_tpl->tpl_vars['gift']->value['object_id'])===null||$tmp==='' ? $_smarty_tpl->tpl_vars['gift_key']->value : $tmp), null, 0);?>
<?php if (!Smarty::$_smarty_vars['capture']['prods']) {?>
    <?php $_smarty_tpl->_capture_stack[0][] = array("prods", null, null); ob_start(); ?>Y<?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>
<?php }?>
<tr>
    <td class="ty-cart-content__product-elem ty-cart-content__image-block">
        <?php if ($_smarty_tpl->tpl_vars['runtime']->value['mode']=="cart"||$_smarty_tpl->tpl_vars['show_images']->value) {?>
            <div class="ty-cart-content__image cm-reload-<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_id']->value, ENT_QUOTES, 'UTF-8');?>
" id="product_image_update_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_id']->value, ENT_QUOTES, 'UTF-8');?>
">
                <?php if (!$_smarty_tpl->tpl_vars['gift']->value['extra']['exclude_from_calculate']) {?>
                    <a href="<?php echo htmlspecialchars(fn_url("gift_certificates.update?gift_cert_id=".((string)$_smarty_tpl->tpl_vars['gift_key']->value)), ENT_QUOTES, 'UTF-8');?>
">
                    <?php echo $_smarty_tpl->getSubTemplate ("addons/gift_certificates/views/gift_certificates/components/gift_certificates_cart_icon.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('width'=>$_smarty_tpl->tpl_vars['settings']->value['Thumbnails']['product_cart_thumbnail_width'],'height'=>$_smarty_tpl->tpl_vars['settings']->value['Thumbnails']['product_cart_thumbnail_height']), 0);?>

                    </a>
                    <div class="ty-mtb-xs ty-center"><?php echo $_smarty_tpl->getSubTemplate ("buttons/button.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('but_text'=>__("edit"),'but_href'=>"gift_certificates.update?gift_cert_id=".((string)$_smarty_tpl->tpl_vars['gift_key']->value),'but_role'=>"text"), 0);?>
</div>
                <?php } else { ?>
                    <?php echo $_smarty_tpl->getSubTemplate ("addons/gift_certificates/views/gift_certificates/components/gift_certificates_cart_icon.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('width'=>$_smarty_tpl->tpl_vars['settings']->value['Thumbnails']['product_cart_thumbnail_width'],'height'=>$_smarty_tpl->tpl_vars['settings']->value['Thumbnails']['product_cart_thumbnail_height']), 0);?>

                <?php }?>
            <!--product_image_update_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_id']->value, ENT_QUOTES, 'UTF-8');?>
--></div>
        <?php }?>
    </td>

    <td class="ty-cart-content__product-elem ty-cart-content__description" style="width: 50%;">
        <?php if (!$_smarty_tpl->tpl_vars['gift']->value['extra']['exclude_from_calculate']) {?>
            <a href="<?php echo htmlspecialchars(fn_url("gift_certificates.update?gift_cert_id=".((string)$_smarty_tpl->tpl_vars['gift_key']->value)), ENT_QUOTES, 'UTF-8');?>
" class="ty-cart-content__product-title">
                <?php echo $_smarty_tpl->__("gift_certificate");?>

            </a>
            <?php if (!$_smarty_tpl->tpl_vars['gift']->value['extra']['exclude_from_calculate']) {?>
                <a class="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['ajax_class']->value, ENT_QUOTES, 'UTF-8');?>
 cm-post ty-delete-big" href="<?php echo htmlspecialchars(fn_url("gift_certificates.delete?gift_cert_id=".((string)$_smarty_tpl->tpl_vars['gift_key']->value)."&redirect_url=".((string)$_smarty_tpl->tpl_vars['c_url']->value)), ENT_QUOTES, 'UTF-8');?>
"  data-ca-target-id="cart_items,checkout_totals,cart_status*,checkout_steps,checkout_cart" title="<?php echo $_smarty_tpl->__("remove");?>
">
                    <i class="ty-delete-big__icon ty-icon-cancel-circle"></i>
                </a>
            <?php }?>
            <?php if ($_smarty_tpl->tpl_vars['use_ajax']->value==true&&$_smarty_tpl->tpl_vars['cart']->value['amount']!=1) {?>
                <?php $_smarty_tpl->tpl_vars["ajax_class"] = new Smarty_variable("cm-ajax", null, 0);?>
            <?php }?>
        <?php } else { ?>
            <strong><?php echo $_smarty_tpl->__("gift_certificate");?>
</strong>
        <?php }?>
        <div class="ty-control-group">
            <label class="ty-control-group__label"><?php echo $_smarty_tpl->__("gift_cert_to");?>
:</label><span class="ty-control-group__item"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['gift']->value['recipient'], ENT_QUOTES, 'UTF-8');?>
</span>
        </div>
        <div class="ty-control-group">
            <label class="ty-control-group__label"><?php echo $_smarty_tpl->__("gift_cert_from");?>
:</label><span class="ty-control-group__item"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['gift']->value['sender'], ENT_QUOTES, 'UTF-8');?>
</span>
        </div>
        <div class="ty-control-group">
            <label class="ty-control-group__label"><?php echo $_smarty_tpl->__("amount");?>
:</label><span class="ty-control-group__item"><?php echo $_smarty_tpl->getSubTemplate ("common/price.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('value'=>$_smarty_tpl->tpl_vars['gift']->value['amount']), 0);?>
</span>
        </div>
        <div class="ty-control-group">
            <label class="ty-control-group__label"><?php echo $_smarty_tpl->__("send_via");?>
:</label><span class="ty-control-group__item"><?php if ($_smarty_tpl->tpl_vars['gift']->value['send_via']=="E") {
echo $_smarty_tpl->__("email");
} else {
echo $_smarty_tpl->__("postal_mail");
}?></span>
        </div>
        <?php if ($_smarty_tpl->tpl_vars['gift']->value['products']&&$_smarty_tpl->tpl_vars['addons']->value['gift_certificates']['free_products_allow']=="Y"&&!$_smarty_tpl->tpl_vars['gift']->value['extra']['exclude_from_calculate']) {?>
        
        <a id="sw_gift_products_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['gift_key']->value, ENT_QUOTES, 'UTF-8');?>
" class="cm-combination ty-cart-content__detailed-link"><?php echo $_smarty_tpl->__("free_products");?>
</a>

        <div id="gift_products_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['gift_key']->value, ENT_QUOTES, 'UTF-8');?>
" class="hidden">
            <div class="ty-cart-content-products">
            <div class="ty-caret-info"><span class="ty-caret-outer"></span> <span class="ty-caret-inner"></span></div>
            <?php  $_smarty_tpl->tpl_vars["product"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["product"]->_loop = false;
 $_smarty_tpl->tpl_vars["key"] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['cart_products']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["product"]->key => $_smarty_tpl->tpl_vars["product"]->value) {
$_smarty_tpl->tpl_vars["product"]->_loop = true;
 $_smarty_tpl->tpl_vars["key"]->value = $_smarty_tpl->tpl_vars["product"]->key;
?>
            <?php if ($_smarty_tpl->tpl_vars['cart']->value['products'][$_smarty_tpl->tpl_vars['key']->value]['extra']['parent']['certificate']==$_smarty_tpl->tpl_vars['gift_key']->value) {?>
                <div class="ty-cart-content-products__item">
                    <div>
                        <a href="<?php echo htmlspecialchars(fn_url("products.view?product_id=".((string)$_smarty_tpl->tpl_vars['product']->value['product_id'])), ENT_QUOTES, 'UTF-8');?>
" title="<?php echo $_smarty_tpl->tpl_vars['product']->value['product'];?>
"><?php echo smarty_modifier_truncate(preg_replace('!<[^>]*?>!', ' ', $_smarty_tpl->tpl_vars['product']->value['product']),70,"...",true);?>
</a>
                        <?php if ($_smarty_tpl->tpl_vars['use_ajax']->value==true) {?>
                            <?php $_smarty_tpl->tpl_vars["ajax_class"] = new Smarty_variable("cm-ajax", null, 0);?>
                        <?php }?>
                        <a class="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['ajax_class']->value, ENT_QUOTES, 'UTF-8');?>
 ty-delete-big" href="<?php echo htmlspecialchars(fn_url("checkout.delete?cart_id=".((string)$_smarty_tpl->tpl_vars['key']->value)."&redirect_url=".((string)$_smarty_tpl->tpl_vars['c_url']->value)), ENT_QUOTES, 'UTF-8');?>
" data-ca-target-id="cart_items,checkout_totals,cart_status*,checkout_steps" title="<?php echo $_smarty_tpl->__("remove");?>
"><i class="ty-delete-big__icon ty-icon-cancel-circle"></i></a>
                        <?php echo $_smarty_tpl->getSubTemplate ("common/options_info.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('product_options'=>fn_get_selected_product_options_info($_smarty_tpl->tpl_vars['cart']->value['products'][$_smarty_tpl->tpl_vars['key']->value]['product_options']),'fields_prefix'=>"cart_products[".((string)$_smarty_tpl->tpl_vars['key']->value)."][product_options]"), 0);?>

                        <?php $_smarty_tpl->smarty->_tag_stack[] = array('hook', array('name'=>"checkout:product_info")); $_block_repeat=true; echo smarty_block_hook(array('name'=>"checkout:product_info"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();
$_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_hook(array('name'=>"checkout:product_info"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

                        <input type="hidden" name="cart_products[<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['key']->value, ENT_QUOTES, 'UTF-8');?>
][extra][parent][certificate]" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['gift_key']->value, ENT_QUOTES, 'UTF-8');?>
" />
                    </div>
                    <div class="ty-control-group">
                        <strong class="ty-control-group__label"><?php echo $_smarty_tpl->__("price");?>
</strong>
                        <span class="ty-control-group__item">
                            <?php echo $_smarty_tpl->getSubTemplate ("common/price.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('value'=>$_smarty_tpl->tpl_vars['product']->value['original_price']), 0);?>

                        </span>
                    </div>
                    <div class="ty-control-group">
                        <strong class="ty-control-group__label"><?php echo $_smarty_tpl->__("qty");?>
</strong>
                        <input type="text" size="3" name="cart_products[<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['key']->value, ENT_QUOTES, 'UTF-8');?>
][amount]" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['amount'], ENT_QUOTES, 'UTF-8');?>
" class="ty-input-text-short" <?php if ($_smarty_tpl->tpl_vars['product']->value['is_edp']=="Y") {?>readonly="readonly"<?php }?> />
                        <input type="hidden" name="cart_products[<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['key']->value, ENT_QUOTES, 'UTF-8');?>
][product_id]" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['product_id'], ENT_QUOTES, 'UTF-8');?>
" />
                    </div>
                    <?php if ($_smarty_tpl->tpl_vars['cart']->value['use_discount']) {?>
                    <div class="ty-control-group">
                        <strong class="ty-control-group__label"><?php echo $_smarty_tpl->__("discount");?>
</strong>
                        <span class="ty-control-group__item">
                            <?php if (floatval($_smarty_tpl->tpl_vars['product']->value['discount'])) {
echo $_smarty_tpl->getSubTemplate ("common/price.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('value'=>$_smarty_tpl->tpl_vars['product']->value['discount']), 0);
} else { ?>-<?php }?>
                        </span>
                    </div>
                    <?php }?>
                    <?php if ($_smarty_tpl->tpl_vars['cart']->value['taxes']&&$_smarty_tpl->tpl_vars['settings']->value['General']['tax_calculation']!="subtotal") {?>
                    <div class="ty-control-group">
                        <strong class="ty-control-group__label"><?php echo $_smarty_tpl->__("tax");?>
</strong>
                        <span class="ty-control-group__item">
                            <?php echo $_smarty_tpl->getSubTemplate ("common/price.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('value'=>$_smarty_tpl->tpl_vars['product']->value['tax_summary']['total']), 0);?>

                        </span>
                    </div>
                    <?php }?>
                    <div class="ty-control-group">
                        <strong class="ty-control-group__label"><?php echo $_smarty_tpl->__("subtotal");?>
</strong>
                        <span class="ty-control-group__item">
                            <?php echo $_smarty_tpl->getSubTemplate ("common/price.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('value'=>$_smarty_tpl->tpl_vars['product']->value['display_subtotal']), 0);?>

                        </span>
                    </div>
                </div>
            <?php }?>
            <?php } ?>
            </div>
            <div class="ty-control-group ty-float-right">
                <strong><?php echo $_smarty_tpl->__("price_summary");?>
:&nbsp;</strong>
                <?php if (!$_smarty_tpl->tpl_vars['gift']->value['extra']['exclude_from_calculate']) {
echo $_smarty_tpl->getSubTemplate ("common/price.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('value'=>$_smarty_tpl->tpl_vars['gift']->value['display_subtotal'],'class'=>"ty-price"), 0);
} else { ?><span class="ty-price"><?php echo $_smarty_tpl->__("free");?>
</span><?php }?>
            </div>
            <div class="clearfix"></div>
        </div>
        <?php }?>
    </td>
    <td class="ty-cart-content__product-elem ty-cart-content__price cm-reload-<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_id']->value, ENT_QUOTES, 'UTF-8');?>
" id="price_display_update_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_id']->value, ENT_QUOTES, 'UTF-8');?>
">
        <?php if (!$_smarty_tpl->tpl_vars['gift']->value['extra']['exclude_from_calculate']) {
echo $_smarty_tpl->getSubTemplate ("common/price.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('value'=>$_smarty_tpl->tpl_vars['gift']->value['display_subtotal'],'class'=>"ty-sub-price"), 0);
} else { ?><span class="ty-price"><?php echo $_smarty_tpl->__("free");?>
</span><?php }?>
    <!--price_display_update_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_id']->value, ENT_QUOTES, 'UTF-8');?>
--></td>
    <td class="ty-cart-content__product-elem ty-cart-content__qty">
    </td>
    <td class="ty-cart-content__product-elem ty-cart-content__price cm-reload-<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_id']->value, ENT_QUOTES, 'UTF-8');?>
" id="price_subtotal_update_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_id']->value, ENT_QUOTES, 'UTF-8');?>
">
        <?php if (!$_smarty_tpl->tpl_vars['gift']->value['extra']['exclude_from_calculate']) {
echo $_smarty_tpl->getSubTemplate ("common/price.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('value'=>$_smarty_tpl->tpl_vars['gift']->value['display_subtotal'],'class'=>"price"), 0);
} else { ?><span class="ty-price"><?php echo $_smarty_tpl->__("free");?>
</span><?php }?>
    <!--price_subtotal_update_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['obj_id']->value, ENT_QUOTES, 'UTF-8');?>
--></td>
</tr>
<?php } ?>

<?php }?>
<?php }?><?php }} ?>
