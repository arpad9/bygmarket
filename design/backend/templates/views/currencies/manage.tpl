{script src="js/tygh/tabs.js"}

{capture name="mainbox"}

{assign var="r_url" value=$config.current_url|escape:url}

<div class="items-container cm-sortable {if !""|fn_allow_save_object:"":true} cm-hide-inputs{/if}" data-ca-sortable-table="currencies" data-ca-sortable-id-name="currency_code" id="manage_currencies_list">
    {if $currencies_data}
    <table class="table table-middle table-objects table-striped">
        <tbody>
            {foreach from=$currencies_data item="currency"}
                {$is_promo = false}
                {if $currency.is_primary == "Y"}
                    {assign var="_href_delete" value=""}
                {else}
                    {assign var="_href_delete" value="currencies.delete?currency_id=`$currency.currency_id`"}
                    {if "ULTIMATE:FREE"|fn_allowed_for}
                        {$is_promo = true}
                    {/if}
                {/if}
                {assign var="currency_details" value="<span>`$currency.currency_code`</span>, {__("currency_rate")}: <span>`$currency.coefficient`</span>, {__("currency_sign")}: <span>`$currency.symbol`</span>"}
                {include file="common/object_group.tpl"
                id=$currency.currency_id
                text=$currency.description
                details=$currency_details
                href="currencies.update?currency_id=`$currency.currency_id`&return_url=$r_url"
                href_delete=$_href_delete
                delete_target_id="manage_currencies_list"
                header_text="{__("editing_currency")}: `$currency.description`"
                table="currencies"
                object_id_name="currency_id"
                status=$currency.status
                additional_class="cm-sortable-row cm-sortable-id-`$currency.currency_id`"
                no_table=true
                non_editable=$runtime.company_id
                is_view_link=true
                is_promo=$is_promo
                draggable=true}
            {/foreach}
        </tbody>
    </table>
    {else}
        <p class="no-items">{__("no_data")}</p>
    {/if}
<!--manage_currencies_list--></div>

<div class="buttons-container">
    {capture name="extra_tools"}
        {hook name="currencies:import_rates"}{/hook}
    {/capture}
</div>
{if ""|fn_allow_save_object:"":true}
    {capture name="adv_buttons"}
        {if !"ULTIMATE:FREE"|fn_allowed_for}
            {capture name="add_new_picker"}
                {include file="views/currencies/update.tpl" currency=[]}
            {/capture}
            
            {include file="common/popupbox.tpl" id="add_new_currency" text=__("new_currency") content=$smarty.capture.add_new_picker title=__("add_currency") act="general" icon="icon-plus"}
        {else}
            {include file="buttons/button.tpl" but_role="action" but_meta="cm-promo-popup" allow_href=false but_title=__("add_currency") but_icon="icon-plus"}
        {/if}
    {/capture}
{/if}
{/capture}

{include file="common/mainbox.tpl" title=__("currencies") content=$smarty.capture.mainbox title_extra=$smarty.capture.title_extra select_languages=true adv_buttons=$smarty.capture.adv_buttons}
