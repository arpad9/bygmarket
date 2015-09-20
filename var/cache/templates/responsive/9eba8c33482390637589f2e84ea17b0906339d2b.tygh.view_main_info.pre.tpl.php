<?php /* Smarty version Smarty-3.1.21, created on 2015-09-18 21:27:06
         compiled from "/var/www/bygmarket.com/design/themes/responsive/templates/addons/seo/hooks/products/view_main_info.pre.tpl" */ ?>
<?php /*%%SmartyHeaderCode:50312225555fc577a8cd812-10982890%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9eba8c33482390637589f2e84ea17b0906339d2b' => 
    array (
      0 => '/var/www/bygmarket.com/design/themes/responsive/templates/addons/seo/hooks/products/view_main_info.pre.tpl',
      1 => 1442595904,
      2 => 'tygh',
    ),
  ),
  'nocache_hash' => '50312225555fc577a8cd812-10982890',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'runtime' => 0,
    'product' => 0,
    'product_amount' => 0,
    'settings' => 0,
    'auth' => 0,
    'currencies' => 0,
    'primary_currency' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21',
  'unifunc' => 'content_55fc577a959494_72499356',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55fc577a959494_72499356')) {function content_55fc577a959494_72499356($_smarty_tpl) {?><?php if (!is_callable('smarty_block_hook')) include '/var/www/bygmarket.com/app/functions/smarty_plugins/block.hook.php';
if (!is_callable('smarty_function_set_id')) include '/var/www/bygmarket.com/app/functions/smarty_plugins/function.set_id.php';
?><?php if ($_smarty_tpl->tpl_vars['runtime']->value['customization_mode']['design']=="Y"&&@constant('AREA')=="C") {
$_smarty_tpl->_capture_stack[0][] = array("template_content", null, null); ob_start(); ?><div itemscope itemtype="http://schema.org/Product">
    <meta itemprop="sku" content="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['product_code'], ENT_QUOTES, 'UTF-8');?>
" />
    <meta itemprop="name" content="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['product'], ENT_QUOTES, 'UTF-8');?>
" />
    <meta itemprop="description" content="<?php echo htmlspecialchars((($tmp = @$_smarty_tpl->tpl_vars['product']->value['full_description'])===null||$tmp==='' ? $_smarty_tpl->tpl_vars['product']->value['short_description'] : $tmp), ENT_QUOTES, 'UTF-8');?>
" />

    <div itemprop="offers" itemscope="" itemtype="http://schema.org/Offer">
        <?php $_smarty_tpl->tpl_vars['product_amount'] = new Smarty_variable((($tmp = @$_smarty_tpl->tpl_vars['product']->value['inventory_amount'])===null||$tmp==='' ? $_smarty_tpl->tpl_vars['product']->value['amount'] : $tmp), null, 0);?>
        <?php if (($_smarty_tpl->tpl_vars['product_amount']->value<=0||$_smarty_tpl->tpl_vars['product_amount']->value<$_smarty_tpl->tpl_vars['product']->value['min_qty'])&&$_smarty_tpl->tpl_vars['settings']->value['General']['inventory_tracking']=="Y") {?>
        <link itemprop="availability" href="http://schema.org/OutOfStock" />
        <?php } else { ?>
        <link itemprop="availability" href="http://schema.org/InStock" />
        <?php }?>
        <?php if (!(!$_smarty_tpl->tpl_vars['auth']->value['user_id']&&$_smarty_tpl->tpl_vars['settings']->value['General']['allow_anonymous_shopping']=="hide_price_and_add_to_cart")) {?>
            <meta itemprop="priceCurrency" content="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['currencies']->value[@constant('CART_PRIMARY_CURRENCY')]['currency_code'], ENT_QUOTES, 'UTF-8');?>
"/>
            <meta itemprop="price" content="<?php echo htmlspecialchars(fn_format_price($_smarty_tpl->tpl_vars['product']->value['price'],$_smarty_tpl->tpl_vars['primary_currency']->value), ENT_QUOTES, 'UTF-8');?>
"/>
        <?php }?>
    </div>

    <?php $_smarty_tpl->smarty->_tag_stack[] = array('hook', array('name'=>"products:seo_snippet_attributes")); $_block_repeat=true; echo smarty_block_hook(array('name'=>"products:seo_snippet_attributes"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

    <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_hook(array('name'=>"products:seo_snippet_attributes"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>


</div><?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();
if (trim(Smarty::$_smarty_vars['capture']['template_content'])) {
if ($_smarty_tpl->tpl_vars['auth']->value['area']=="A") {?><span class="cm-template-box template-box" data-ca-te-template="addons/seo/hooks/products/view_main_info.pre.tpl" id="<?php echo smarty_function_set_id(array('name'=>"addons/seo/hooks/products/view_main_info.pre.tpl"),$_smarty_tpl);?>
"><div class="cm-template-icon icon-edit ty-icon-edit hidden"></div><?php echo Smarty::$_smarty_vars['capture']['template_content'];?>
<!--[/tpl_id]--></span><?php } else {
echo Smarty::$_smarty_vars['capture']['template_content'];
}
}
} else { ?><div itemscope itemtype="http://schema.org/Product">
    <meta itemprop="sku" content="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['product_code'], ENT_QUOTES, 'UTF-8');?>
" />
    <meta itemprop="name" content="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['product'], ENT_QUOTES, 'UTF-8');?>
" />
    <meta itemprop="description" content="<?php echo htmlspecialchars((($tmp = @$_smarty_tpl->tpl_vars['product']->value['full_description'])===null||$tmp==='' ? $_smarty_tpl->tpl_vars['product']->value['short_description'] : $tmp), ENT_QUOTES, 'UTF-8');?>
" />

    <div itemprop="offers" itemscope="" itemtype="http://schema.org/Offer">
        <?php $_smarty_tpl->tpl_vars['product_amount'] = new Smarty_variable((($tmp = @$_smarty_tpl->tpl_vars['product']->value['inventory_amount'])===null||$tmp==='' ? $_smarty_tpl->tpl_vars['product']->value['amount'] : $tmp), null, 0);?>
        <?php if (($_smarty_tpl->tpl_vars['product_amount']->value<=0||$_smarty_tpl->tpl_vars['product_amount']->value<$_smarty_tpl->tpl_vars['product']->value['min_qty'])&&$_smarty_tpl->tpl_vars['settings']->value['General']['inventory_tracking']=="Y") {?>
        <link itemprop="availability" href="http://schema.org/OutOfStock" />
        <?php } else { ?>
        <link itemprop="availability" href="http://schema.org/InStock" />
        <?php }?>
        <?php if (!(!$_smarty_tpl->tpl_vars['auth']->value['user_id']&&$_smarty_tpl->tpl_vars['settings']->value['General']['allow_anonymous_shopping']=="hide_price_and_add_to_cart")) {?>
            <meta itemprop="priceCurrency" content="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['currencies']->value[@constant('CART_PRIMARY_CURRENCY')]['currency_code'], ENT_QUOTES, 'UTF-8');?>
"/>
            <meta itemprop="price" content="<?php echo htmlspecialchars(fn_format_price($_smarty_tpl->tpl_vars['product']->value['price'],$_smarty_tpl->tpl_vars['primary_currency']->value), ENT_QUOTES, 'UTF-8');?>
"/>
        <?php }?>
    </div>

    <?php $_smarty_tpl->smarty->_tag_stack[] = array('hook', array('name'=>"products:seo_snippet_attributes")); $_block_repeat=true; echo smarty_block_hook(array('name'=>"products:seo_snippet_attributes"), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>

    <?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_hook(array('name'=>"products:seo_snippet_attributes"), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>


</div><?php }?><?php }} ?>
