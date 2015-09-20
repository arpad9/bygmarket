{include file="addons/store_locator/pickers/map.tpl"}

{capture name="mainbox"}

{include file="common/pagination.tpl" save_current_page=true}

<div class="items-container" id="store_locations">
    {if $store_locations}
    <table class="table table-middle table-objects">
    <tbody>
        {foreach from=$store_locations item=loc}
            {capture name="edit_picker"}
                {include file="addons/store_locator/views/store_locator/update.tpl" loc=$loc}
            {/capture}
            {include file="common/object_group.tpl" id=$loc.store_location_id text=$loc.name status=$loc.status href="" object_id_name="store_location_id" table="store_locations" href_delete="store_locator.delete?store_location_id=`$loc.store_location_id`" delete_target_id="store_locations" header_text="{__("editing_store_location")}: `$loc.name`" content=$smarty.capture.edit_picker no_table=true}
        {/foreach}
    </tbody>
    </table>
    {else}
        <p class="no-items">{__("no_data")}</p>
    {/if}
<!--store_locations--></div>

    {include file="common/pagination.tpl" save_current_page=true}

    {capture name="add_new_picker"}
        {include file="addons/store_locator/views/store_locator/update.tpl" loc=[]}
    {/capture}
    {capture name="adv_buttons"}
        {include file="common/popupbox.tpl" id="add_store_location" text=__("new_store_location") content=$smarty.capture.add_new_picker title=__("add_store_location") act="general" icon="icon-plus"}
    {/capture}

{/capture}
{include file="common/mainbox.tpl" title=__("store_locator") content=$smarty.capture.mainbox adv_buttons=$smarty.capture.adv_buttons select_languages=true buttons=$smarty.capture.buttons}
