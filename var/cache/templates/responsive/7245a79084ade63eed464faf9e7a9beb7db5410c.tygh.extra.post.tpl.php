<?php /* Smarty version Smarty-3.1.21, created on 2015-09-18 21:27:43
         compiled from "/var/www/bygmarket.com/design/themes/responsive/templates/addons/hybrid_auth/hooks/auth_info/extra.post.tpl" */ ?>
<?php /*%%SmartyHeaderCode:79385603855fc579ff006d9-72185317%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7245a79084ade63eed464faf9e7a9beb7db5410c' => 
    array (
      0 => '/var/www/bygmarket.com/design/themes/responsive/templates/addons/hybrid_auth/hooks/auth_info/extra.post.tpl',
      1 => 1442595917,
      2 => 'tygh',
    ),
  ),
  'nocache_hash' => '79385603855fc579ff006d9-72185317',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'runtime' => 0,
    'auth' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21',
  'unifunc' => 'content_55fc57a000ede0_71620808',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55fc57a000ede0_71620808')) {function content_55fc57a000ede0_71620808($_smarty_tpl) {?><?php if (!is_callable('smarty_function_set_id')) include '/var/www/bygmarket.com/app/functions/smarty_plugins/function.set_id.php';
?><?php
fn_preload_lang_vars(array('text_hybrid_auth.connect_social_title','text_hybrid_auth.connect_social','text_hybrid_auth.specify_email_title','text_hybrid_auth.specify_email','text_hybrid_auth.connect_social_title','text_hybrid_auth.connect_social','text_hybrid_auth.specify_email_title','text_hybrid_auth.specify_email'));
?>
<?php if ($_smarty_tpl->tpl_vars['runtime']->value['customization_mode']['design']=="Y"&&@constant('AREA')=="C") {
$_smarty_tpl->_capture_stack[0][] = array("template_content", null, null); ob_start();
if ($_smarty_tpl->tpl_vars['runtime']->value['controller']=="auth") {?>
    <?php if ($_smarty_tpl->tpl_vars['runtime']->value['mode']=="connect_social") {?>
    <h4 class="ty-login-info__title"><?php echo $_smarty_tpl->__("text_hybrid_auth.connect_social_title");?>
</h4>
    <div class="ty-login-info__txt"><?php echo $_smarty_tpl->__("text_hybrid_auth.connect_social");?>
</div>
    <?php }?>
    <?php if ($_smarty_tpl->tpl_vars['runtime']->value['mode']=="specify_email") {?>
        <h4 class="ty-login-info__title"><?php echo $_smarty_tpl->__("text_hybrid_auth.specify_email_title");?>
</h4>
        <div class="ty-login-info__txt"><?php echo $_smarty_tpl->__("text_hybrid_auth.specify_email");?>
</div>
    <?php }?>
<?php }?>

<?php list($_capture_buffer, $_capture_assign, $_capture_append) = array_pop($_smarty_tpl->_capture_stack[0]);
if (!empty($_capture_buffer)) {
 if (isset($_capture_assign)) $_smarty_tpl->assign($_capture_assign, ob_get_contents());
 if (isset( $_capture_append)) $_smarty_tpl->append( $_capture_append, ob_get_contents());
 Smarty::$_smarty_vars['capture'][$_capture_buffer]=ob_get_clean();
} else $_smarty_tpl->capture_error();
if (trim(Smarty::$_smarty_vars['capture']['template_content'])) {
if ($_smarty_tpl->tpl_vars['auth']->value['area']=="A") {?><span class="cm-template-box template-box" data-ca-te-template="addons/hybrid_auth/hooks/auth_info/extra.post.tpl" id="<?php echo smarty_function_set_id(array('name'=>"addons/hybrid_auth/hooks/auth_info/extra.post.tpl"),$_smarty_tpl);?>
"><div class="cm-template-icon icon-edit ty-icon-edit hidden"></div><?php echo Smarty::$_smarty_vars['capture']['template_content'];?>
<!--[/tpl_id]--></span><?php } else {
echo Smarty::$_smarty_vars['capture']['template_content'];
}
}
} else {
if ($_smarty_tpl->tpl_vars['runtime']->value['controller']=="auth") {?>
    <?php if ($_smarty_tpl->tpl_vars['runtime']->value['mode']=="connect_social") {?>
    <h4 class="ty-login-info__title"><?php echo $_smarty_tpl->__("text_hybrid_auth.connect_social_title");?>
</h4>
    <div class="ty-login-info__txt"><?php echo $_smarty_tpl->__("text_hybrid_auth.connect_social");?>
</div>
    <?php }?>
    <?php if ($_smarty_tpl->tpl_vars['runtime']->value['mode']=="specify_email") {?>
        <h4 class="ty-login-info__title"><?php echo $_smarty_tpl->__("text_hybrid_auth.specify_email_title");?>
</h4>
        <div class="ty-login-info__txt"><?php echo $_smarty_tpl->__("text_hybrid_auth.specify_email");?>
</div>
    <?php }?>
<?php }?>

<?php }?><?php }} ?>
