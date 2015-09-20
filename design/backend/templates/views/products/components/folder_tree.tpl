<tr class="multiple-table-row">
    <td>
        <div style="padding-left: 5px;">
        <input type="hidden" name="folder_{$folder.folder_id}" value="{$folder.folder_name}" />
        <span id="on_group_folder_{$folder.folder_id}" class="cm-combination {if $expand_all} hidden{/if}"><img class="icon-folder-close"></span>
        <span id="off_group_folder_{$folder.folder_id}" class="cm-combination {if !$expand_all} hidden{/if}"><img class="icon-folder-open"></span>
        <a class="row-status cm-external-click{if $non_editable} no-underline{/if}" data-ca-external-click-id="opener_group_folder_{$id}">{$folder.folder_name}</a></td>

    <td width="10%" class="right nowrap">
        <div class="pull-right hidden-tools">
            {if $tool_items}{$tool_items nofilter}{/if}

            {include file="common/popupbox.tpl" id="group_folder_`$id`" text="{__("editing_folder")}: `$folder.folder_name`" act=$act|default:"edit" opener_ajax_class="cm-ajax"}

            {if !$non_editable}
                {if !$skip_delete}
                    <a class="cm-confirm cm-tooltip cm-ajax cm-ajax-full-render cm-delete-row" 
                    href={"products.delete_folder?folder_id=`$folder.folder_id`&product_id=`$product_data.product_id`"|fn_url} data-ca-target-id="product_files_list" title="{__("delete")}"><i class="icon-trash"></i></a>
                {/if}
            {/if}
        </div></td>

    <td width="15%">
        <div class="pull-right nowrap">
            {if $non_editable == true}
                {assign var="display" value="text"}
            {/if}
            {include file="common/select_popup.tpl" popup_additional_class="dropleft" id=$id status=$folder.status hidden=$hidden object_id_name='folder_id' table="product_file_folders" hide_for_vendor=$hide_for_vendor display=$display non_editable=$non_editable}
        </div></td>
</tr>