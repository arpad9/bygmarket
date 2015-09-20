<?php /* Smarty version Smarty-3.1.21, created on 2015-09-19 02:07:11
         compiled from "/var/www/bygmarket.com/design/backend/templates/pickers/filters/picker_contents.tpl" */ ?>
<?php /*%%SmartyHeaderCode:20272529755fc991f724b12-53812821%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '065ae09434432b381aa855c1ae68178257744989' => 
    array (
      0 => '/var/www/bygmarket.com/design/backend/templates/pickers/filters/picker_contents.tpl',
      1 => 1441800576,
      2 => 'tygh',
    ),
  ),
  'nocache_hash' => '20272529755fc991f724b12-53812821',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'filters' => 0,
    'filter' => 0,
    'button_names' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.21',
  'unifunc' => 'content_55fc991f8bfbf7_49527141',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_55fc991f8bfbf7_49527141')) {function content_55fc991f8bfbf7_49527141($_smarty_tpl) {?><?php if (!is_callable('smarty_block_inline_script')) include '/var/www/bygmarket.com/app/functions/smarty_plugins/block.inline_script.php';
?><?php
fn_preload_lang_vars(array('text_items_added','name','description','status','active','disabled','no_data','choose','add_filters_and_close','add_filters'));
?>
<?php if (!$_REQUEST['extra']) {?>
<?php $_smarty_tpl->smarty->_tag_stack[] = array('inline_script', array()); $_block_repeat=true; echo smarty_block_inline_script(array(), null, $_smarty_tpl, $_block_repeat);while ($_block_repeat) { ob_start();?>
<?php echo '<script'; ?>
 type="text/javascript">
(function(_, $) {
    _.tr('text_items_added', '<?php echo strtr($_smarty_tpl->__("text_items_added"), array("\\" => "\\\\", "'" => "\\'", "\"" => "\\\"", "\r" => "\\r", "\n" => "\\n", "</" => "<\/" ));?>
');
    var display_type = '<?php echo strtr($_REQUEST['display'], array("\\" => "\\\\", "'" => "\\'", "\"" => "\\\"", "\r" => "\\r", "\n" => "\\n", "</" => "<\/" ));?>
';

    $.ceEvent('on', 'ce.formpost_filters_form', function(frm, elm) {
        var filters = {};

        if ($('input.cm-item:checked', frm).length > 0) {
            $('input.cm-item:checked', frm).each( function() {
                var id = $(this).val();
                filters[id] = $('#filter_title_' + id).text();
            });

            
            $.cePicker('add_js_item', frm.data('caResultId'), filters, 'f', {
                '{filter_id}': '%id',
                '{filter}': '%item'
            });
            

            if (display_type != 'radio') {
                $.ceNotification('show', {
                    type: 'N', 
                    title: _.tr('notice'), 
                    message: _.tr('text_items_added'), 
                    message_state: 'I'
                });
            }
        }

        return false;        
    });
}(Tygh, Tygh.$));
<?php echo '</script'; ?>
><?php $_block_content = ob_get_clean(); $_block_repeat=false; echo smarty_block_inline_script(array(), $_block_content, $_smarty_tpl, $_block_repeat);  } array_pop($_smarty_tpl->smarty->_tag_stack);?>

<?php }?>

<?php echo $_smarty_tpl->getSubTemplate ("views/product_filters/components/product_filters_search_form.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('dispatch'=>"product_filters.picker",'extra'=>"<input type=\"hidden\" name=\"result_ids\" value=\"pagination_".((string)$_REQUEST['data_id'])."\">",'put_request_vars'=>true,'form_meta'=>"cm-ajax",'in_popup'=>true), 0);?>


<form action="<?php echo htmlspecialchars(fn_url($_REQUEST['extra']), ENT_QUOTES, 'UTF-8');?>
" data-ca-result-id="<?php echo htmlspecialchars($_REQUEST['data_id'], ENT_QUOTES, 'UTF-8');?>
" method="post" name="filters_form">

    <?php echo $_smarty_tpl->getSubTemplate ("common/pagination.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('div_id'=>"pagination_".((string)$_REQUEST['data_id'])), 0);?>


    <?php if ($_smarty_tpl->tpl_vars['filters']->value) {?>

        <table width="100%" class="table table-middle">
            <thead>
            <tr>
                <th width="1%" class="center">
                    <?php if ($_REQUEST['display']=="checkbox") {?>
                        <?php echo $_smarty_tpl->getSubTemplate ("common/check_items.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array(), 0);?>

                    <?php }?>
                </th>
                <th><?php echo $_smarty_tpl->__("name");?>
</th>
                <th><?php echo $_smarty_tpl->__("description");?>
</th>
                <th><?php echo $_smarty_tpl->__("status");?>
</th>
            </tr>
            </thead>
            <?php  $_smarty_tpl->tpl_vars['filter'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['filter']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['filters']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['filter']->key => $_smarty_tpl->tpl_vars['filter']->value) {
$_smarty_tpl->tpl_vars['filter']->_loop = true;
?>
                <tr>
                    <td class="left">
                        <?php if ($_REQUEST['display']=="checkbox") {?>
                            <input type="checkbox" name="add_filters[]" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['filter']->value['filter_id'], ENT_QUOTES, 'UTF-8');?>
" class="cm-item" />
                            <?php } elseif ($_REQUEST['display']=="radio") {?>
                            <input type="radio" name="selected_filter_id" value="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['filter']->value['filter_id'], ENT_QUOTES, 'UTF-8');?>
" />
                        <?php }?>
                    </td>
                    <td id="filter_title_<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['filter']->value['filter_id'], ENT_QUOTES, 'UTF-8');?>
"><?php echo htmlspecialchars($_smarty_tpl->tpl_vars['filter']->value['filter'], ENT_QUOTES, 'UTF-8');?>
</td>
                    <td><?php echo $_smarty_tpl->tpl_vars['filter']->value['filter_description'];?>
</td>
                    <td class="center">
                        <?php if ($_smarty_tpl->tpl_vars['filter']->value['status']=="A") {?>
                            <?php echo $_smarty_tpl->__("active");?>

                        <?php } else { ?>
                            <?php echo $_smarty_tpl->__("disabled");?>

                        <?php }?>
                    </td>
                </tr>
            <?php } ?>
        </table>
    <?php } else { ?>
        <div class="items-container"><p class="no-items"><?php echo $_smarty_tpl->__("no_data");?>
</p></div>
    <?php }?>

    <?php echo $_smarty_tpl->getSubTemplate ("common/pagination.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('div_id'=>"pagination_".((string)$_REQUEST['data_id'])), 0);?>


    <?php if ($_smarty_tpl->tpl_vars['filters']->value) {?>
    <div class="buttons-container">
        <?php if ($_REQUEST['display']=="radio") {?>
            <?php $_smarty_tpl->tpl_vars["but_close_text"] = new Smarty_variable($_smarty_tpl->__("choose"), null, 0);?>
        <?php } else { ?>
            <?php $_smarty_tpl->tpl_vars["but_close_text"] = new Smarty_variable((($tmp = @$_smarty_tpl->tpl_vars['button_names']->value['but_close_text'])===null||$tmp==='' ? $_smarty_tpl->__("add_filters_and_close") : $tmp), null, 0);?>
            <?php $_smarty_tpl->tpl_vars["but_text"] = new Smarty_variable((($tmp = @$_smarty_tpl->tpl_vars['button_names']->value['but_text'])===null||$tmp==='' ? $_smarty_tpl->__("add_filters") : $tmp), null, 0);?>
        <?php }?>
        <?php echo $_smarty_tpl->getSubTemplate ("buttons/add_close.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null, array('is_js'=>fn_is_empty($_REQUEST['extra'])), 0);?>

    </div>
    <?php }?>
</form>
<?php }} ?>
