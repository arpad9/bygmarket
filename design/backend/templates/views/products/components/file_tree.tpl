{math equation="x*30+5" x=$level|default:"0" assign="shift"}
<tr class="multiple-table-row cm-row-status-{$product_file.status|lower} ">
    <td>
        <div style="padding-left: {$shift}px;">
            <a class="row-status cm-external-click{if $non_editable} no-underline{/if}" data-ca-external-click-id="opener_group_files_{$id}">{$product_file.file_name}</a>
        </div></td>

    <td width="10%" class="right nowrap">
        <div class="pull-right hidden-tools">
            {if $tool_items}{$tool_items nofilter}{/if}

            {include file="common/popupbox.tpl" id="group_files_`$id`" text="{__("editing_file")}: `$product_file.file_name`" act="edit" opener_ajax_class="cm-ajax"}

            {if !$non_editable}
                {if !$skip_delete}
                    <a class="cm-confirm cm-tooltip cm-ajax cm-ajax-full-render cm-delete-row" 
                    href={"products.delete_file?file_id=`$product_file.file_id`&product_id=`$product_data.product_id`"|fn_url} data-ca-target-id="product_files_list" title="{__("delete")}"><i class="icon-trash"></i></a>
                {/if}
            {/if}
        </div></td>

    <td width="15%">
        <div class="pull-right nowrap">
            {if $non_editable == true}
                {assign var="display" value="text"}
            {/if}
            
            {include file="common/select_popup.tpl" popup_additional_class="dropleft" id=$id status=$product_file.status hidden=$hidden object_id_name="file_id" table="product_files" hide_for_vendor=$hide_for_vendor display=$display non_editable=$non_editable}
        </div></td>
</tr>