<?php /* Smarty version Smarty-3.1.21, created on 2015-09-18 20:06:17
         compiled from "/var/www/bygmarket.com/design/themes/responsive/templates/addons/twigmo/hooks/index/content.pre.tpl" */ ?>
<?php /*%%SmartyHeaderCode:85495654155fc44893aabb4-01597618%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3a697909db8cbc23d3a40bfc90c8cf82be635fc5' => 
    array (
      0 => '/var/www/bygmarket.com/design/themes/responsive/templates/addons/twigmo/hooks/index/content.pre.tpl',
      1 => 1442595918,
      2 => 'tygh',
    ),
  ),
  'nocache_hash' => '85495654155fc44893aabb4-01597618',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'runtime' => 0,
    'state' => 0,
    'config' => 0,
    'auth' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21',
  'unifunc' => 'content_55fc4489447e76_27791066',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55fc4489447e76_27791066')) {function content_55fc4489447e76_27791066($_smarty_tpl) {?><?php if (!is_callable('smarty_function_set_id')) include '/var/www/bygmarket.com/app/functions/smarty_plugins/function.set_id.php';
?><?php if ($_smarty_tpl->tpl_vars['runtime']->value['customization_mode']['design']=="Y"&&@constant('AREA')=="C") {
$_smarty_tpl->_capture_stack[0][] = array("template_content", null, null); ob_start();
$_smarty_tpl->tpl_vars["state"] = new Smarty_variable($_SESSION['twg_state'], null, 0);?>
<?php $_smarty_tpl->tpl_vars['addon_images_path'] = new Smarty_variable(fn_twg_get_images_path(), null, 0);?>

<?php if ($_smarty_tpl->tpl_vars['state']->value['twg_can_be_used']&&!$_smarty_tpl->tpl_vars['state']->value['mobile_link_closed']) {?>
<div class="mobile-avail-notice">
    <div class="buttons-container">
        <a href="<?php echo htmlspecialchars(fn_link_attach(fn_query_remove($_smarty_tpl->tpl_vars['config']->value['current_url'],"mobile","auto","desktop"),"mobile"), ENT_QUOTES, 'UTF-8');?>
">
            <?php echo $_smarty_tpl->__('twg_visit_our_mobile_store');?>

        </a>

        <?php if ($_smarty_tpl->tpl_vars['state']->value['device']=="android"&&$_smarty_tpl->tpl_vars['state']->value['url_on_googleplay']) {?>
            <a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['state']->value['url_on_googleplay'], ENT_QUOTES, 'UTF-8');?>
"><?php echo $_smarty_tpl->__('twg_app_for_android');?>
</a>
        <?php } elseif (($_smarty_tpl->tpl_vars['state']->value['device']=="iphone"||$_smarty_tpl->tpl_vars['state']->value['device']=="ipad")&&$_smarty_tpl->tpl_vars['state']->value['url_on_appstore']) {?>
            <a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['state']->value['url_on_appstore'], ENT_QUOTES, 'UTF-8');?>
">
                <?php if ($_smarty_tpl->tpl_vars['state']->value['device']=="iphone") {?>
                    <?php echo $_smarty_tpl->__('twg_app_for_iphone');?>

                <?php } else { ?>
                    <?php echo $_smarty_tpl->__('twg_app_for_ipad');?>

                <?php }?>
            </a>
        <?php }?>
        <span id="close_notification_mobile_avail_notice" class="cm-notification-close hand close" title="Close" />&times;</span>
    </div>
</div>
<?php }
list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();
if (trim(Smarty::$_smarty_vars['capture']['template_content'])) {
if ($_smarty_tpl->tpl_vars['auth']->value['area']=="A") {?><span class="cm-template-box template-box" data-ca-te-template="addons/twigmo/hooks/index/content.pre.tpl" id="<?php echo smarty_function_set_id(array('name'=>"addons/twigmo/hooks/index/content.pre.tpl"),$_smarty_tpl);?>
"><div class="cm-template-icon icon-edit ty-icon-edit hidden"></div><?php echo Smarty::$_smarty_vars['capture']['template_content'];?>
<!--[/tpl_id]--></span><?php } else {
echo Smarty::$_smarty_vars['capture']['template_content'];
}
}
} else {
$_smarty_tpl->tpl_vars["state"] = new Smarty_variable($_SESSION['twg_state'], null, 0);?>
<?php $_smarty_tpl->tpl_vars['addon_images_path'] = new Smarty_variable(fn_twg_get_images_path(), null, 0);?>

<?php if ($_smarty_tpl->tpl_vars['state']->value['twg_can_be_used']&&!$_smarty_tpl->tpl_vars['state']->value['mobile_link_closed']) {?>
<div class="mobile-avail-notice">
    <div class="buttons-container">
        <a href="<?php echo htmlspecialchars(fn_link_attach(fn_query_remove($_smarty_tpl->tpl_vars['config']->value['current_url'],"mobile","auto","desktop"),"mobile"), ENT_QUOTES, 'UTF-8');?>
">
            <?php echo $_smarty_tpl->__('twg_visit_our_mobile_store');?>

        </a>

        <?php if ($_smarty_tpl->tpl_vars['state']->value['device']=="android"&&$_smarty_tpl->tpl_vars['state']->value['url_on_googleplay']) {?>
            <a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['state']->value['url_on_googleplay'], ENT_QUOTES, 'UTF-8');?>
"><?php echo $_smarty_tpl->__('twg_app_for_android');?>
</a>
        <?php } elseif (($_smarty_tpl->tpl_vars['state']->value['device']=="iphone"||$_smarty_tpl->tpl_vars['state']->value['device']=="ipad")&&$_smarty_tpl->tpl_vars['state']->value['url_on_appstore']) {?>
            <a href="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['state']->value['url_on_appstore'], ENT_QUOTES, 'UTF-8');?>
">
                <?php if ($_smarty_tpl->tpl_vars['state']->value['device']=="iphone") {?>
                    <?php echo $_smarty_tpl->__('twg_app_for_iphone');?>

                <?php } else { ?>
                    <?php echo $_smarty_tpl->__('twg_app_for_ipad');?>

                <?php }?>
            </a>
        <?php }?>
        <span id="close_notification_mobile_avail_notice" class="cm-notification-close hand close" title="Close" />&times;</span>
    </div>
</div>
<?php }
}?><?php }} ?>
