<?php /* Smarty version Smarty-3.1.21, created on 2015-09-18 20:09:30
         compiled from "/var/www/bygmarket.com/design/backend/templates/addons/twigmo/hooks/index/global_search.post.tpl" */ ?>
<?php /*%%SmartyHeaderCode:151075629355fc454a64cc99-01962933%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c96fe5996c32a0cb320e493a5205b6b5e88ef5ab' => 
    array (
      0 => '/var/www/bygmarket.com/design/backend/templates/addons/twigmo/hooks/index/global_search.post.tpl',
      1 => 1441800604,
      2 => 'tygh',
    ),
  ),
  'nocache_hash' => '151075629355fc454a64cc99-01962933',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'runtime' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21',
  'unifunc' => 'content_55fc454a65ed49_51002196',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55fc454a65ed49_51002196')) {function content_55fc454a65ed49_51002196($_smarty_tpl) {?><?php if (!is_callable('smarty_block_inline_script')) include '/var/www/bygmarket.com/app/functions/smarty_plugins/block.inline_script.php';
?><?php
fn_preload_lang_vars(array('twgadmin_mobile_app'));
?>
<?php if ($_smarty_tpl->tpl_vars['runtime']->value['twigmo']['admin_connection']['access_id']) {?>

    <div class="twg-mobile-app-link">
        <a href="<?php echo htmlspecialchars(fn_url("twigmo_admin_app.view"), ENT_QUOTES, 'UTF-8');?>
"><?php echo $_smarty_tpl->__("twgadmin_mobile_app");?>
</a>
    </div>

    <?php $_smarty_tpl->smarty->_tag_stack[] = array('inline_script', array()); $_block_repeat=true; echo smarty_block_inline_script(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
<?php echo '<script'; ?>
 type="text/javascript">
        (function(_, $) {
            $(document).ready(function() {
                $('div.twg-mobile-app-link').detach().insertBefore('ul.nav.hover-show.nav-pills').show();
            });
        }(Tygh, Tygh.$));
    <?php echo '</script'; ?>
><?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_inline_script(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>


<?php }?><?php }} ?>
