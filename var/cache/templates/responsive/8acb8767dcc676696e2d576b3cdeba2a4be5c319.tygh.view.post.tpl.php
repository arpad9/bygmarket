<?php /* Smarty version Smarty-3.1.21, created on 2015-09-18 21:27:38
         compiled from "/var/www/bygmarket.com/design/themes/responsive/templates/addons/gift_certificates/hooks/wishlist/view.post.tpl" */ ?>
<?php /*%%SmartyHeaderCode:163589935755fc579adbe152-90015492%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8acb8767dcc676696e2d576b3cdeba2a4be5c319' => 
    array (
      0 => '/var/www/bygmarket.com/design/themes/responsive/templates/addons/gift_certificates/hooks/wishlist/view.post.tpl',
      1 => 1442595902,
      2 => 'tygh',
    ),
  ),
  'nocache_hash' => '163589935755fc579adbe152-90015492',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'runtime' => 0,
    'wishlist' => 0,
    'iteration' => 0,
    'columns' => 0,
    'gift_key' => 0,
    'settings' => 0,
    'gift' => 0,
    'config' => 0,
    'form_prefix' => 0,
    'addons' => 0,
    'extra_products' => 0,
    'key_cert_prod' => 0,
    '_product' => 0,
    'gift_price' => 0,
    'subtotal' => 0,
    'auth' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21',
  'unifunc' => 'content_55fc579b17c5e5_69888298',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55fc579b17c5e5_69888298')) {function content_55fc579b17c5e5_69888298($_smarty_tpl) {?><?php if (!is_callable('smarty_function_math')) include '/var/www/bygmarket.com/app/lib/vendor/smarty/smarty/libs/plugins/function.math.php';
if (!is_callable('smarty_function_set_id')) include '/var/www/bygmarket.com/app/functions/smarty_plugins/function.set_id.php';
?><?php
fn_preload_lang_vars(array('remove','remove','gift_certificate','free_products','quick_view','gift_certificate','edit','gift_certificate','gift_cert_to','gift_cert_from','amount','send_via','email','postal_mail','free_products','product','price','quantity','subtotal','price_summary','remove','remove','gift_certificate','free_products','quick_view','gift_certificate','edit','gift_certificate','gift_cert_to','gift_cert_from','amount','send_via','email','postal_mail','free_products','product','price','quantity','subtotal','price_summary'));
?>
<?php if ($_smarty_tpl->tpl_vars['runtime']->value['customization_mode']['design']=="Y"&&@constant('AREA')=="C") {
$_smarty_tpl->_capture_stack[0][] = array("template_content", null, null); ob_start();
if ($_smarty_tpl->tpl_vars['wishlist']->value['gift_certificates']) {?>

<?php  $_smarty_tpl->tpl_vars["gift"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["gift"]->_loop = false;
 $_smarty_tpl->tpl_vars["gift_key"] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['wishlist']->value['gift_certificates']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["gift"]->key => $_smarty_tpl->tpl_vars["gift"]->value) {
$_smarty_tpl->tpl_vars["gift"]->_loop = true;
 $_smarty_tpl->tpl_vars["gift_key"]->value = $_smarty_tpl->tpl_vars["gift"]->key;
?>
<?php echo smarty_function_math(array('equation'=>"it + 1",'assign'=>"iteration",'it'=>$_smarty_tpl->tpl_vars['iteration']->value),$_smarty_tpl);?>


    <div class="ty-gift-certificate-wishlist ty-column<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['columns']->value, ENT_QUOTES, 'UTF-8');?>
">

            <div class="ty-grid-list__item ty-quick-view-button__wrapper">
                <div class="ty-twishlist-item">
                    <a href="<?php echo htmlspecialchars(fn_url("gift_certificates.wishlist_delete?gift_cert_wishlist_id=".((string)$_smarty_tpl->tpl_vars['gift_key']->value)), ENT_QUOTES, 'UTF-8');?>
" class="cm-post ty-twishlist-item__remove ty-remove" title="<?php echo $_smarty_tpl->__("remove");?>
"><i class="ty-remove__icon ty-icon-cancel-circle"></i><span class="ty-remove__txt ty-twishlist-item__txt"><?php echo $_smarty_tpl->__("remove");?>
</span></a>
                </div>
                <div class="ty-grid-list__image">
                    <a href="<?php echo htmlspecialchars(fn_url("gift_certificates.update?gift_cert_wishlist_id=".((string)$_smarty_tpl->tpl_vars['gift_key']->value)), ENT_QUOTES, 'UTF-8');?>
"><?php echo $_smarty_tpl->getSubTemplate ("addons/gift_certificates/views/gift_certificates/components/gift_certificates_cart_icon.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('width'=>$_smarty_tpl->tpl_vars['settings']->value['Thumbnails']['product_lists_thumbnail_width'],'height'=>$_smarty_tpl->tpl_vars['settings']->value['Thumbnails']['product_lists_thumbnail_height']), 0);?>
</a>
                </div>
                <div class="ty-grid-list__item-name">
                    <a href="<?php echo htmlspecialchars(fn_url("gift_certificates.update?gift_cert_wishlist_id=".((string)$_smarty_tpl->tpl_vars['gift_key']->value)), ENT_QUOTES, 'UTF-8');?>
"><?php echo $_smarty_tpl->__("gift_certificate");
if ($_smarty_tpl->tpl_vars['gift']->value['products']) {?> + <?php echo $_smarty_tpl->__("free_products");
}?></a>
                </div>
                <div class="ty-grid-list__price">
                    <?php echo $_smarty_tpl->getSubTemplate ("common/price.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('value'=>$_smarty_tpl->tpl_vars['gift']->value['amount']), 0);?>

                </div>

                <div class="ty-grid-list__control">
                    <div class="ty-quick-view-button">
                        <a id="opener_gift_cert_picker_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['gift_key']->value, ENT_QUOTES, 'UTF-8');?>
" class="ty-btn ty-btn__secondary ty-btn__big cm-dialog-opener cm-dialog-auto-size" data-ca-target-id="gift_cert_quick_view_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['gift_key']->value, ENT_QUOTES, 'UTF-8');?>
" href="<?php echo htmlspecialchars(fn_url("gift_certificates.update?gift_cert_wishlist_id=".((string)$_smarty_tpl->tpl_vars['gift_key']->value)), ENT_QUOTES, 'UTF-8');?>
" rel="nofollow"><?php echo $_smarty_tpl->__("quick_view");?>
</a>
                    </div>
                </div>
            </div>

            <div class="hidden" id="gift_cert_quick_view_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['gift_key']->value, ENT_QUOTES, 'UTF-8');?>
" title="<?php echo $_smarty_tpl->__("gift_certificate");?>
">
                <form action="<?php echo htmlspecialchars(fn_url(''), ENT_QUOTES, 'UTF-8');?>
" <?php if (!$_smarty_tpl->tpl_vars['config']->value['tweaks']['disable_dhtml']) {?>class="cm-ajax cm-form-dialog-closer"<?php }?> method="post" name="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['form_prefix']->value, ENT_QUOTES, 'UTF-8');?>
gift_cert_form_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['gift_key']->value, ENT_QUOTES, 'UTF-8');?>
">

                <input type="hidden" value="cart_status*,wish_list*" name="result_ids" />
                <input type="hidden" name="gift_cert_data[send_via]" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['gift']->value['send_via'], ENT_QUOTES, 'UTF-8');?>
" />
                <input type="hidden" name="gift_cert_data[amount]" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['gift']->value['amount'], ENT_QUOTES, 'UTF-8');?>
" />
                <input type="hidden" name="gift_cert_data[correct_amount]" value="N" />
                <input type="hidden" name="gift_cert_data[recipient]" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['gift']->value['recipient'], ENT_QUOTES, 'UTF-8');?>
" />
                <input type="hidden" name="gift_cert_data[sender]" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['gift']->value['sender'], ENT_QUOTES, 'UTF-8');?>
" />
                <input type="hidden" name="gift_cert_data[message]" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['gift']->value['message'], ENT_QUOTES, 'UTF-8');?>
" />
                <?php if ($_smarty_tpl->tpl_vars['gift']->value['email']) {?><input type="hidden" name="gift_cert_data[email]" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['gift']->value['email'], ENT_QUOTES, 'UTF-8');?>
" /><?php }?>
                <?php if ($_smarty_tpl->tpl_vars['gift']->value['title']) {?><input type="hidden" name="gift_cert_data[title]" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['gift']->value['title'], ENT_QUOTES, 'UTF-8');?>
" /><?php }?>
                <?php if ($_smarty_tpl->tpl_vars['gift']->value['firstname']) {?><input type="hidden" name="gift_cert_data[firstname]" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['gift']->value['firstname'], ENT_QUOTES, 'UTF-8');?>
" /><?php }?>
                <?php if ($_smarty_tpl->tpl_vars['gift']->value['lastname']) {?><input type="hidden" name="gift_cert_data[lastname]" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['gift']->value['lastname'], ENT_QUOTES, 'UTF-8');?>
" /><?php }?>
                <?php if ($_smarty_tpl->tpl_vars['gift']->value['address']) {?><input type="hidden" name="gift_cert_data[address]" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['gift']->value['address'], ENT_QUOTES, 'UTF-8');?>
" /><?php }?>
                <?php if ($_smarty_tpl->tpl_vars['gift']->value['city']) {?><input type="hidden" name="gift_cert_data[city]" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['gift']->value['city'], ENT_QUOTES, 'UTF-8');?>
" /><?php }?>
                <?php if ($_smarty_tpl->tpl_vars['gift']->value['country']) {?><input type="hidden" name="gift_cert_data[country]" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['gift']->value['country'], ENT_QUOTES, 'UTF-8');?>
" /><?php }?>
                <?php if ($_smarty_tpl->tpl_vars['gift']->value['state']) {?><input type="hidden" name="gift_cert_data[state]" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['gift']->value['state'], ENT_QUOTES, 'UTF-8');?>
" /><?php }?>
                <?php if ($_smarty_tpl->tpl_vars['gift']->value['zipcode']) {?><input type="hidden" name="gift_cert_data[zipcode]" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['gift']->value['zipcode'], ENT_QUOTES, 'UTF-8');?>
" /><?php }?>

                <div class="ty-quick-view__wrapper ty-product-block">
                    <div class="ty-product-block__img">
                        <a href="<?php echo htmlspecialchars(fn_url("gift_certificates.update?gift_cert_wishlist_id=".((string)$_smarty_tpl->tpl_vars['gift_key']->value)), ENT_QUOTES, 'UTF-8');?>
"><?php echo $_smarty_tpl->getSubTemplate ("addons/gift_certificates/views/gift_certificates/components/gift_certificates_cart_icon.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('width'=>"150",'height'=>"150"), 0);?>
</a>

                        <div class="ty-mtb-xs ty-center"><?php echo $_smarty_tpl->getSubTemplate ("buttons/button.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('but_text'=>__("edit"),'but_href'=>"gift_certificates.update?gift_cert_wishlist_id=".((string)$_smarty_tpl->tpl_vars['gift_key']->value),'but_role'=>"text"), 0);?>
</div>
                    </div>
                    <div class="ty-product-block__left">
                        <a href="<?php echo htmlspecialchars(fn_url("gift_certificates.update?gift_cert_wishlist_id=".((string)$_smarty_tpl->tpl_vars['gift_key']->value)), ENT_QUOTES, 'UTF-8');?>
" class="product-title"><?php echo $_smarty_tpl->__("gift_certificate");?>
</a>
                        <div class="ty-control-group product-list-field">
                            <label class="ty-control-group__label"><?php echo $_smarty_tpl->__("gift_cert_to");?>
:</label>
                            <span class="ty-control-group__item"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['gift']->value['recipient'], ENT_QUOTES, 'UTF-8');?>
</span>
                        </div>
                        <div class="ty-control-group product-list-field">
                            <label class="ty-control-group__label"><?php echo $_smarty_tpl->__("gift_cert_from");?>
:</label>
                            <span class="ty-control-group__item"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['gift']->value['sender'], ENT_QUOTES, 'UTF-8');?>
</span>
                        </div>
                        <div class="ty-control-group product-list-field">
                            <label class="ty-control-group__label"><?php echo $_smarty_tpl->__("amount");?>
:</label>
                            <span class="ty-control-group__item"><?php echo $_smarty_tpl->getSubTemplate ("common/price.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('value'=>$_smarty_tpl->tpl_vars['gift']->value['amount']), 0);?>
</span>
                        </div>
                        <div class="ty-control-group product-list-field">
                            <label class="ty-control-group__label"><?php echo $_smarty_tpl->__("send_via");?>
:</label>
                            <span class="ty-control-group__item"><?php if ($_smarty_tpl->tpl_vars['gift']->value['send_via']=="E") {
echo $_smarty_tpl->__("email");
} else {
echo $_smarty_tpl->__("postal_mail");
}?></span>
                        </div>

                        <div class="clearfix"></div>
                        <?php if ($_smarty_tpl->tpl_vars['gift']->value['products']&&$_smarty_tpl->tpl_vars['addons']->value['gift_certificates']['free_products_allow']=="Y") {?>
                        <div class="clearfix">

                            <p><strong><?php echo $_smarty_tpl->__("free_products");?>
:</strong></p>

                            <?php $_smarty_tpl->tpl_vars["gift_price"] = new Smarty_variable('', null, 0);?>
                            <table class="ty-table">
                            <tr>
                                <th style="width: 50%"><?php echo $_smarty_tpl->__("product");?>
</th>
                                <th style="width: 10%"><?php echo $_smarty_tpl->__("price");?>
</th>
                                <th style="width: 10%"><?php echo $_smarty_tpl->__("quantity");?>
</th>
                                <th class="ty-right" style="width: 10%"><?php echo $_smarty_tpl->__("subtotal");?>
</th>
                            </tr>
                            <?php  $_smarty_tpl->tpl_vars["_product"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["_product"]->_loop = false;
 $_smarty_tpl->tpl_vars["key_cert_prod"] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['extra_products']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["_product"]->key => $_smarty_tpl->tpl_vars["_product"]->value) {
$_smarty_tpl->tpl_vars["_product"]->_loop = true;
 $_smarty_tpl->tpl_vars["key_cert_prod"]->value = $_smarty_tpl->tpl_vars["_product"]->key;
?>

                                <?php if ($_smarty_tpl->tpl_vars['wishlist']->value['products'][$_smarty_tpl->tpl_vars['key_cert_prod']->value]['extra']['parent']['certificate']==$_smarty_tpl->tpl_vars['gift_key']->value) {?>

                                <input type="hidden" name="gift_cert_data[products][<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['key_cert_prod']->value, ENT_QUOTES, 'UTF-8');?>
][product_id]" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['wishlist']->value['products'][$_smarty_tpl->tpl_vars['key_cert_prod']->value]['product_id'], ENT_QUOTES, 'UTF-8');?>
" />
                                <input type="hidden" name="gift_cert_data[products][<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['key_cert_prod']->value, ENT_QUOTES, 'UTF-8');?>
][amount]" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['wishlist']->value['products'][$_smarty_tpl->tpl_vars['key_cert_prod']->value]['amount'], ENT_QUOTES, 'UTF-8');?>
" />

                                <?php echo smarty_function_math(array('equation'=>"item_price + gift_",'item_price'=>(($tmp = @$_smarty_tpl->tpl_vars['_product']->value['subtotal'])===null||$tmp==='' ? "0" : $tmp),'gift_'=>(($tmp = @$_smarty_tpl->tpl_vars['gift_price']->value)===null||$tmp==='' ? "0" : $tmp),'assign'=>"gift_price"),$_smarty_tpl);?>

                                <tr>
                                    <td>
                                        <a href="<?php echo htmlspecialchars(fn_url("products.view?product_id=".((string)$_smarty_tpl->tpl_vars['_product']->value['product_id'])), ENT_QUOTES, 'UTF-8');?>
"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['_product']->value['product'], ENT_QUOTES, 'UTF-8');?>
</a>
                                        <?php if ($_smarty_tpl->tpl_vars['_product']->value['product_options']) {?>
                                            <?php echo $_smarty_tpl->getSubTemplate ("common/options_info.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('product_options'=>$_smarty_tpl->tpl_vars['_product']->value['product_options'],'fields_prefix'=>"gift_cert_data[products][".((string)$_smarty_tpl->tpl_vars['key_cert_prod']->value)."][product_options]"), 0);?>

                                        <?php }?>
                                    </td>
                                    <td class="ty-center">
                                        <?php echo $_smarty_tpl->getSubTemplate ("common/price.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('value'=>$_smarty_tpl->tpl_vars['_product']->value['price']), 0);?>
</td>
                                    <td class="ty-center ty-nowrap">
                                        <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['gift']->value['products'][$_smarty_tpl->tpl_vars['key_cert_prod']->value]['amount'], ENT_QUOTES, 'UTF-8');?>
</td>
                                    <td class="ty-right ty-nowrap">
                                        <?php echo smarty_function_math(array('equation'=>"item_price*amount",'item_price'=>(($tmp = @$_smarty_tpl->tpl_vars['_product']->value['price'])===null||$tmp==='' ? "0" : $tmp),'assign'=>"subtotal",'amount'=>$_smarty_tpl->tpl_vars['gift']->value['products'][$_smarty_tpl->tpl_vars['key_cert_prod']->value]['amount']),$_smarty_tpl);?>

                                        <?php echo smarty_function_math(array('equation'=>"subtotal + gift_",'subtotal'=>(($tmp = @$_smarty_tpl->tpl_vars['subtotal']->value)===null||$tmp==='' ? "0" : $tmp),'gift_'=>(($tmp = @$_smarty_tpl->tpl_vars['gift_price']->value)===null||$tmp==='' ? "0" : $tmp),'assign'=>"gift_price"),$_smarty_tpl);?>

                                        <?php echo $_smarty_tpl->getSubTemplate ("common/price.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('value'=>$_smarty_tpl->tpl_vars['subtotal']->value), 0);?>
</td>
                                </tr>
                                <?php }?>

                            <?php } ?>
                            </table>

                            <div class="ty-control-group product-list-field ty-float-right">
                                <label class="ty-control-group__label"><?php echo $_smarty_tpl->__("price_summary");?>
:</label>
                                <span class="ty-control-group__item">
                                    <?php echo smarty_function_math(array('equation'=>"item_price + gift_",'item_price'=>(($tmp = @$_smarty_tpl->tpl_vars['gift_price']->value)===null||$tmp==='' ? "0" : $tmp),'gift_'=>(($tmp = @$_smarty_tpl->tpl_vars['gift']->value['amount'])===null||$tmp==='' ? "0" : $tmp),'assign'=>"gift_price"),$_smarty_tpl);?>

                                    <strong><?php echo $_smarty_tpl->getSubTemplate ("common/price.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('value'=>$_smarty_tpl->tpl_vars['gift_price']->value), 0);?>
</strong>
                                </span>
                            </div>
                        </div>
                        <?php }?>

                        <div class="ty-product-block__button">
                            <?php echo $_smarty_tpl->getSubTemplate ("buttons/add_to_cart.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('but_role'=>"big",'but_name'=>"dispatch[gift_certificates.add]"), 0);?>

                        </div>
                    </div>
                </div>
            </form>
       </div>
    </div>

<?php } ?>
<?php $_smarty_tpl->_capture_stack[0][] = array("iteration", null, null); ob_start();
echo htmlspecialchars($_smarty_tpl->tpl_vars['iteration']->value, ENT_QUOTES, 'UTF-8');
list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>
<?php }
list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();
if (trim(Smarty::$_smarty_vars['capture']['template_content'])) {
if ($_smarty_tpl->tpl_vars['auth']->value['area']=="A") {?><span class="cm-template-box template-box" data-ca-te-template="addons/gift_certificates/hooks/wishlist/view.post.tpl" id="<?php echo smarty_function_set_id(array('name'=>"addons/gift_certificates/hooks/wishlist/view.post.tpl"),$_smarty_tpl);?>
"><div class="cm-template-icon icon-edit ty-icon-edit hidden"></div><?php echo Smarty::$_smarty_vars['capture']['template_content'];?>
<!--[/tpl_id]--></span><?php } else {
echo Smarty::$_smarty_vars['capture']['template_content'];
}
}
} else {
if ($_smarty_tpl->tpl_vars['wishlist']->value['gift_certificates']) {?>

<?php  $_smarty_tpl->tpl_vars["gift"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["gift"]->_loop = false;
 $_smarty_tpl->tpl_vars["gift_key"] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['wishlist']->value['gift_certificates']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["gift"]->key => $_smarty_tpl->tpl_vars["gift"]->value) {
$_smarty_tpl->tpl_vars["gift"]->_loop = true;
 $_smarty_tpl->tpl_vars["gift_key"]->value = $_smarty_tpl->tpl_vars["gift"]->key;
?>
<?php echo smarty_function_math(array('equation'=>"it + 1",'assign'=>"iteration",'it'=>$_smarty_tpl->tpl_vars['iteration']->value),$_smarty_tpl);?>


    <div class="ty-gift-certificate-wishlist ty-column<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['columns']->value, ENT_QUOTES, 'UTF-8');?>
">

            <div class="ty-grid-list__item ty-quick-view-button__wrapper">
                <div class="ty-twishlist-item">
                    <a href="<?php echo htmlspecialchars(fn_url("gift_certificates.wishlist_delete?gift_cert_wishlist_id=".((string)$_smarty_tpl->tpl_vars['gift_key']->value)), ENT_QUOTES, 'UTF-8');?>
" class="cm-post ty-twishlist-item__remove ty-remove" title="<?php echo $_smarty_tpl->__("remove");?>
"><i class="ty-remove__icon ty-icon-cancel-circle"></i><span class="ty-remove__txt ty-twishlist-item__txt"><?php echo $_smarty_tpl->__("remove");?>
</span></a>
                </div>
                <div class="ty-grid-list__image">
                    <a href="<?php echo htmlspecialchars(fn_url("gift_certificates.update?gift_cert_wishlist_id=".((string)$_smarty_tpl->tpl_vars['gift_key']->value)), ENT_QUOTES, 'UTF-8');?>
"><?php echo $_smarty_tpl->getSubTemplate ("addons/gift_certificates/views/gift_certificates/components/gift_certificates_cart_icon.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('width'=>$_smarty_tpl->tpl_vars['settings']->value['Thumbnails']['product_lists_thumbnail_width'],'height'=>$_smarty_tpl->tpl_vars['settings']->value['Thumbnails']['product_lists_thumbnail_height']), 0);?>
</a>
                </div>
                <div class="ty-grid-list__item-name">
                    <a href="<?php echo htmlspecialchars(fn_url("gift_certificates.update?gift_cert_wishlist_id=".((string)$_smarty_tpl->tpl_vars['gift_key']->value)), ENT_QUOTES, 'UTF-8');?>
"><?php echo $_smarty_tpl->__("gift_certificate");
if ($_smarty_tpl->tpl_vars['gift']->value['products']) {?> + <?php echo $_smarty_tpl->__("free_products");
}?></a>
                </div>
                <div class="ty-grid-list__price">
                    <?php echo $_smarty_tpl->getSubTemplate ("common/price.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('value'=>$_smarty_tpl->tpl_vars['gift']->value['amount']), 0);?>

                </div>

                <div class="ty-grid-list__control">
                    <div class="ty-quick-view-button">
                        <a id="opener_gift_cert_picker_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['gift_key']->value, ENT_QUOTES, 'UTF-8');?>
" class="ty-btn ty-btn__secondary ty-btn__big cm-dialog-opener cm-dialog-auto-size" data-ca-target-id="gift_cert_quick_view_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['gift_key']->value, ENT_QUOTES, 'UTF-8');?>
" href="<?php echo htmlspecialchars(fn_url("gift_certificates.update?gift_cert_wishlist_id=".((string)$_smarty_tpl->tpl_vars['gift_key']->value)), ENT_QUOTES, 'UTF-8');?>
" rel="nofollow"><?php echo $_smarty_tpl->__("quick_view");?>
</a>
                    </div>
                </div>
            </div>

            <div class="hidden" id="gift_cert_quick_view_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['gift_key']->value, ENT_QUOTES, 'UTF-8');?>
" title="<?php echo $_smarty_tpl->__("gift_certificate");?>
">
                <form action="<?php echo htmlspecialchars(fn_url(''), ENT_QUOTES, 'UTF-8');?>
" <?php if (!$_smarty_tpl->tpl_vars['config']->value['tweaks']['disable_dhtml']) {?>class="cm-ajax cm-form-dialog-closer"<?php }?> method="post" name="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['form_prefix']->value, ENT_QUOTES, 'UTF-8');?>
gift_cert_form_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['gift_key']->value, ENT_QUOTES, 'UTF-8');?>
">

                <input type="hidden" value="cart_status*,wish_list*" name="result_ids" />
                <input type="hidden" name="gift_cert_data[send_via]" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['gift']->value['send_via'], ENT_QUOTES, 'UTF-8');?>
" />
                <input type="hidden" name="gift_cert_data[amount]" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['gift']->value['amount'], ENT_QUOTES, 'UTF-8');?>
" />
                <input type="hidden" name="gift_cert_data[correct_amount]" value="N" />
                <input type="hidden" name="gift_cert_data[recipient]" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['gift']->value['recipient'], ENT_QUOTES, 'UTF-8');?>
" />
                <input type="hidden" name="gift_cert_data[sender]" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['gift']->value['sender'], ENT_QUOTES, 'UTF-8');?>
" />
                <input type="hidden" name="gift_cert_data[message]" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['gift']->value['message'], ENT_QUOTES, 'UTF-8');?>
" />
                <?php if ($_smarty_tpl->tpl_vars['gift']->value['email']) {?><input type="hidden" name="gift_cert_data[email]" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['gift']->value['email'], ENT_QUOTES, 'UTF-8');?>
" /><?php }?>
                <?php if ($_smarty_tpl->tpl_vars['gift']->value['title']) {?><input type="hidden" name="gift_cert_data[title]" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['gift']->value['title'], ENT_QUOTES, 'UTF-8');?>
" /><?php }?>
                <?php if ($_smarty_tpl->tpl_vars['gift']->value['firstname']) {?><input type="hidden" name="gift_cert_data[firstname]" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['gift']->value['firstname'], ENT_QUOTES, 'UTF-8');?>
" /><?php }?>
                <?php if ($_smarty_tpl->tpl_vars['gift']->value['lastname']) {?><input type="hidden" name="gift_cert_data[lastname]" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['gift']->value['lastname'], ENT_QUOTES, 'UTF-8');?>
" /><?php }?>
                <?php if ($_smarty_tpl->tpl_vars['gift']->value['address']) {?><input type="hidden" name="gift_cert_data[address]" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['gift']->value['address'], ENT_QUOTES, 'UTF-8');?>
" /><?php }?>
                <?php if ($_smarty_tpl->tpl_vars['gift']->value['city']) {?><input type="hidden" name="gift_cert_data[city]" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['gift']->value['city'], ENT_QUOTES, 'UTF-8');?>
" /><?php }?>
                <?php if ($_smarty_tpl->tpl_vars['gift']->value['country']) {?><input type="hidden" name="gift_cert_data[country]" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['gift']->value['country'], ENT_QUOTES, 'UTF-8');?>
" /><?php }?>
                <?php if ($_smarty_tpl->tpl_vars['gift']->value['state']) {?><input type="hidden" name="gift_cert_data[state]" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['gift']->value['state'], ENT_QUOTES, 'UTF-8');?>
" /><?php }?>
                <?php if ($_smarty_tpl->tpl_vars['gift']->value['zipcode']) {?><input type="hidden" name="gift_cert_data[zipcode]" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['gift']->value['zipcode'], ENT_QUOTES, 'UTF-8');?>
" /><?php }?>

                <div class="ty-quick-view__wrapper ty-product-block">
                    <div class="ty-product-block__img">
                        <a href="<?php echo htmlspecialchars(fn_url("gift_certificates.update?gift_cert_wishlist_id=".((string)$_smarty_tpl->tpl_vars['gift_key']->value)), ENT_QUOTES, 'UTF-8');?>
"><?php echo $_smarty_tpl->getSubTemplate ("addons/gift_certificates/views/gift_certificates/components/gift_certificates_cart_icon.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('width'=>"150",'height'=>"150"), 0);?>
</a>

                        <div class="ty-mtb-xs ty-center"><?php echo $_smarty_tpl->getSubTemplate ("buttons/button.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('but_text'=>__("edit"),'but_href'=>"gift_certificates.update?gift_cert_wishlist_id=".((string)$_smarty_tpl->tpl_vars['gift_key']->value),'but_role'=>"text"), 0);?>
</div>
                    </div>
                    <div class="ty-product-block__left">
                        <a href="<?php echo htmlspecialchars(fn_url("gift_certificates.update?gift_cert_wishlist_id=".((string)$_smarty_tpl->tpl_vars['gift_key']->value)), ENT_QUOTES, 'UTF-8');?>
" class="product-title"><?php echo $_smarty_tpl->__("gift_certificate");?>
</a>
                        <div class="ty-control-group product-list-field">
                            <label class="ty-control-group__label"><?php echo $_smarty_tpl->__("gift_cert_to");?>
:</label>
                            <span class="ty-control-group__item"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['gift']->value['recipient'], ENT_QUOTES, 'UTF-8');?>
</span>
                        </div>
                        <div class="ty-control-group product-list-field">
                            <label class="ty-control-group__label"><?php echo $_smarty_tpl->__("gift_cert_from");?>
:</label>
                            <span class="ty-control-group__item"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['gift']->value['sender'], ENT_QUOTES, 'UTF-8');?>
</span>
                        </div>
                        <div class="ty-control-group product-list-field">
                            <label class="ty-control-group__label"><?php echo $_smarty_tpl->__("amount");?>
:</label>
                            <span class="ty-control-group__item"><?php echo $_smarty_tpl->getSubTemplate ("common/price.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('value'=>$_smarty_tpl->tpl_vars['gift']->value['amount']), 0);?>
</span>
                        </div>
                        <div class="ty-control-group product-list-field">
                            <label class="ty-control-group__label"><?php echo $_smarty_tpl->__("send_via");?>
:</label>
                            <span class="ty-control-group__item"><?php if ($_smarty_tpl->tpl_vars['gift']->value['send_via']=="E") {
echo $_smarty_tpl->__("email");
} else {
echo $_smarty_tpl->__("postal_mail");
}?></span>
                        </div>

                        <div class="clearfix"></div>
                        <?php if ($_smarty_tpl->tpl_vars['gift']->value['products']&&$_smarty_tpl->tpl_vars['addons']->value['gift_certificates']['free_products_allow']=="Y") {?>
                        <div class="clearfix">

                            <p><strong><?php echo $_smarty_tpl->__("free_products");?>
:</strong></p>

                            <?php $_smarty_tpl->tpl_vars["gift_price"] = new Smarty_variable('', null, 0);?>
                            <table class="ty-table">
                            <tr>
                                <th style="width: 50%"><?php echo $_smarty_tpl->__("product");?>
</th>
                                <th style="width: 10%"><?php echo $_smarty_tpl->__("price");?>
</th>
                                <th style="width: 10%"><?php echo $_smarty_tpl->__("quantity");?>
</th>
                                <th class="ty-right" style="width: 10%"><?php echo $_smarty_tpl->__("subtotal");?>
</th>
                            </tr>
                            <?php  $_smarty_tpl->tpl_vars["_product"] = new Smarty_Variable; $_smarty_tpl->tpl_vars["_product"]->_loop = false;
 $_smarty_tpl->tpl_vars["key_cert_prod"] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['extra_products']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars["_product"]->key => $_smarty_tpl->tpl_vars["_product"]->value) {
$_smarty_tpl->tpl_vars["_product"]->_loop = true;
 $_smarty_tpl->tpl_vars["key_cert_prod"]->value = $_smarty_tpl->tpl_vars["_product"]->key;
?>

                                <?php if ($_smarty_tpl->tpl_vars['wishlist']->value['products'][$_smarty_tpl->tpl_vars['key_cert_prod']->value]['extra']['parent']['certificate']==$_smarty_tpl->tpl_vars['gift_key']->value) {?>

                                <input type="hidden" name="gift_cert_data[products][<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['key_cert_prod']->value, ENT_QUOTES, 'UTF-8');?>
][product_id]" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['wishlist']->value['products'][$_smarty_tpl->tpl_vars['key_cert_prod']->value]['product_id'], ENT_QUOTES, 'UTF-8');?>
" />
                                <input type="hidden" name="gift_cert_data[products][<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['key_cert_prod']->value, ENT_QUOTES, 'UTF-8');?>
][amount]" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['wishlist']->value['products'][$_smarty_tpl->tpl_vars['key_cert_prod']->value]['amount'], ENT_QUOTES, 'UTF-8');?>
" />

                                <?php echo smarty_function_math(array('equation'=>"item_price + gift_",'item_price'=>(($tmp = @$_smarty_tpl->tpl_vars['_product']->value['subtotal'])===null||$tmp==='' ? "0" : $tmp),'gift_'=>(($tmp = @$_smarty_tpl->tpl_vars['gift_price']->value)===null||$tmp==='' ? "0" : $tmp),'assign'=>"gift_price"),$_smarty_tpl);?>

                                <tr>
                                    <td>
                                        <a href="<?php echo htmlspecialchars(fn_url("products.view?product_id=".((string)$_smarty_tpl->tpl_vars['_product']->value['product_id'])), ENT_QUOTES, 'UTF-8');?>
"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['_product']->value['product'], ENT_QUOTES, 'UTF-8');?>
</a>
                                        <?php if ($_smarty_tpl->tpl_vars['_product']->value['product_options']) {?>
                                            <?php echo $_smarty_tpl->getSubTemplate ("common/options_info.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('product_options'=>$_smarty_tpl->tpl_vars['_product']->value['product_options'],'fields_prefix'=>"gift_cert_data[products][".((string)$_smarty_tpl->tpl_vars['key_cert_prod']->value)."][product_options]"), 0);?>

                                        <?php }?>
                                    </td>
                                    <td class="ty-center">
                                        <?php echo $_smarty_tpl->getSubTemplate ("common/price.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('value'=>$_smarty_tpl->tpl_vars['_product']->value['price']), 0);?>
</td>
                                    <td class="ty-center ty-nowrap">
                                        <?php echo htmlspecialchars($_smarty_tpl->tpl_vars['gift']->value['products'][$_smarty_tpl->tpl_vars['key_cert_prod']->value]['amount'], ENT_QUOTES, 'UTF-8');?>
</td>
                                    <td class="ty-right ty-nowrap">
                                        <?php echo smarty_function_math(array('equation'=>"item_price*amount",'item_price'=>(($tmp = @$_smarty_tpl->tpl_vars['_product']->value['price'])===null||$tmp==='' ? "0" : $tmp),'assign'=>"subtotal",'amount'=>$_smarty_tpl->tpl_vars['gift']->value['products'][$_smarty_tpl->tpl_vars['key_cert_prod']->value]['amount']),$_smarty_tpl);?>

                                        <?php echo smarty_function_math(array('equation'=>"subtotal + gift_",'subtotal'=>(($tmp = @$_smarty_tpl->tpl_vars['subtotal']->value)===null||$tmp==='' ? "0" : $tmp),'gift_'=>(($tmp = @$_smarty_tpl->tpl_vars['gift_price']->value)===null||$tmp==='' ? "0" : $tmp),'assign'=>"gift_price"),$_smarty_tpl);?>

                                        <?php echo $_smarty_tpl->getSubTemplate ("common/price.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('value'=>$_smarty_tpl->tpl_vars['subtotal']->value), 0);?>
</td>
                                </tr>
                                <?php }?>

                            <?php } ?>
                            </table>

                            <div class="ty-control-group product-list-field ty-float-right">
                                <label class="ty-control-group__label"><?php echo $_smarty_tpl->__("price_summary");?>
:</label>
                                <span class="ty-control-group__item">
                                    <?php echo smarty_function_math(array('equation'=>"item_price + gift_",'item_price'=>(($tmp = @$_smarty_tpl->tpl_vars['gift_price']->value)===null||$tmp==='' ? "0" : $tmp),'gift_'=>(($tmp = @$_smarty_tpl->tpl_vars['gift']->value['amount'])===null||$tmp==='' ? "0" : $tmp),'assign'=>"gift_price"),$_smarty_tpl);?>

                                    <strong><?php echo $_smarty_tpl->getSubTemplate ("common/price.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('value'=>$_smarty_tpl->tpl_vars['gift_price']->value), 0);?>
</strong>
                                </span>
                            </div>
                        </div>
                        <?php }?>

                        <div class="ty-product-block__button">
                            <?php echo $_smarty_tpl->getSubTemplate ("buttons/add_to_cart.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('but_role'=>"big",'but_name'=>"dispatch[gift_certificates.add]"), 0);?>

                        </div>
                    </div>
                </div>
            </form>
       </div>
    </div>

<?php } ?>
<?php $_smarty_tpl->_capture_stack[0][] = array("iteration", null, null); ob_start();
echo htmlspecialchars($_smarty_tpl->tpl_vars['iteration']->value, ENT_QUOTES, 'UTF-8');
list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();?>
<?php }
}?><?php }} ?>
