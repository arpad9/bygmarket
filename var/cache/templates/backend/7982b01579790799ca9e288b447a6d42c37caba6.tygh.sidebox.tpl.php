<?php /* Smarty version Smarty-3.1.21, created on 2015-09-19 02:14:07
         compiled from "/var/www/bygmarket.com/design/backend/templates/common/sidebox.tpl" */ ?>
<?php /*%%SmartyHeaderCode:142270368055fc9abfdbfd31-88216344%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7982b01579790799ca9e288b447a6d42c37caba6' => 
    array (
      0 => '/var/www/bygmarket.com/design/backend/templates/common/sidebox.tpl',
      1 => 1441800576,
      2 => 'tygh',
    ),
  ),
  'nocache_hash' => '142270368055fc9abfdbfd31-88216344',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'content' => 0,
    'title' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21',
  'unifunc' => 'content_55fc9abfe09c59_87163535',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55fc9abfe09c59_87163535')) {function content_55fc9abfe09c59_87163535($_smarty_tpl) {?><?php if (trim($_smarty_tpl->tpl_vars['content']->value)) {?>
    <div class="sidebar-row">
        <h6><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['title']->value, ENT_QUOTES, 'UTF-8');?>
</h6>
        <?php echo (($tmp = @$_smarty_tpl->tpl_vars['content']->value)===null||$tmp==='' ? "&nbsp;" : $tmp);?>

    </div>
    <hr />
<?php }?><?php }} ?>
