{assign var="result_ids" value="order_update"}

<script type="text/javascript">
    //<![CDATA[
    var result_ids = "{$result_ids}";
    //]]>
</script>
{script src="js/tygh/order_management.js"}
{script src="js/tygh/exceptions.js"}

<div class="hidden">
    {$users_shared_force = false}
    {if "ULTIMATE"|fn_allowed_for}
        {if $settings.Stores.share_users == "Y"}
            {$users_shared_force = true}
        {/if}
    {/if}
    {include file="views/order_management/components/customer_info_update.tpl"}
<!--content_customer_info--></div>

<form action="{""|fn_url}" method="post" class="form-table" name="om_cart_form" enctype="multipart/form-data">
{$ORDER_MANAGEMENT}
<input type="hidden" name="result_ids" value="{$result_ids}" />

{capture name="sidebar"}
    {if $cart.order_id || $cart.user_data}
        {assign var="is_edit" value=true}
    {/if}
    {* Issuer info*}
    {include file="views/order_management/components/issuer_info.tpl" user_data=$cart.issuer_data}
    {* Customer info *}
    {include file="views/order_management/components/profiles_info.tpl" user_data=$cart.user_data location="O" is_edit=$is_edit}
    <div class="sidebar-row">
        <h6>{__("customer_notes")}</h6>
        <textarea class="input-textarea" name="customer_notes" id="customer_notes" cols="40" rows="5">{$cart.notes}</textarea>
    </div>
{/capture}

{capture name="mainbox"}

<div class="row-fluid orders-wrap">
    <div class="span8">
        <div  class="cm-om-totals" id="om_update_totals">
        {if $is_empty_cart}
        <label class="hidden cm-required" for="products_required">{__("products_required")}</label>
        <input type="hidden" id="products_required" name="products_required" value="" />
        {/if}

        {* Products *}
        {include file="views/order_management/components/products.tpl"}
        <hr>
        <div class="row-fluid">
            <div class="span6">
            {* Discounts *}
            {include file="views/order_management/components/discounts.tpl"}
            {hook name="order_management:totals_extra"}
            {/hook}
            </div>
        
            <div class="span6">
            {* Totals *}
            {include file="views/order_management/components/totals.tpl"}
            </div>
        </div>
        </div>

        <div class="note clearfix">
            <label for="order_details">{__("staff_only_notes")}</label>
            <textarea class="span12" name="update_order[details]" id="order_details" cols="40" rows="5">{$cart.details}</textarea>
        </div>
    </div>

    <div class="span4">
        <div class="well orders-right-pane form-horizontal">
            {* Status *}
            <div class="statuses">
                {include file="views/order_management/components/status.tpl"}
            </div>
            
            {* Payment method *}
            <div class="payments">
                {include file="views/order_management/components/payment_method.tpl"}
            </div>
            
            {* Shipping method*}
            <div class="shippings">
                {include file="views/order_management/components/shipping_method.tpl"}
            </div>
        </div>
    </div>
</div>

{/capture}

{capture name="buttons"}
{* Order buttons *}
    {if $cart.order_id == ""}
        {assign var="_but_text" value=__("create")}
        {assign var="but_text_" value=__("create_process_payment")}
        {assign var="_title" value=__("create_new_order")}
    {else}
        {assign var="_but_text" value=__("save")}
        {assign var="but_text_" value=__("save_process_payment")}
        {assign var="_title" value="{__("editing_order")}: #`$cart.order_id`"}
        {include file="buttons/button.tpl" but_text=__("cancel") but_role="action" but_href="orders.details?order_id=`$cart.order_id`"}
    {/if}

    {include file="buttons/button.tpl" but_text=$_but_text but_name="dispatch[order_management.place_order.save]" but_role="button_main"}
    {include file="buttons/button.tpl" but_text=$but_text_ but_name="dispatch[order_management.place_order]" but_role="button_main"}
{/capture}

{capture name="mainbox_title"}
    {if $cart.order_id == ""}
        {__("add_new_order")}
    {else}

        {__("editing_order")} #{$cart.order_id} <span class="f-middle">{__("total")}: <span>{include file="common/price.tpl" value=$cart.total}</span>{if $cart.company_id}, {$cart.company_id|fn_get_company_name}{/if}</span>

        <span class="f-small">
        /{if $cart.company_id}{$cart.company_id|fn_get_company_name}){/if}
        {if $status_settings.appearance_type == "I" && $cart.doc_ids[$status_settings.appearance_type]}
        ({__("invoice")} #{$cart.doc_ids[$status_settings.appearance_type]})
        {elseif $status_settings.appearance_type == "C" && $cart.doc_ids[$status_settings.appearance_type]}
        ({__("credit_memo")} #{$cart.doc_ids[$status_settings.appearance_type]})
        {/if}
        {__("by")}{if $cart.user_data.user_id}{/if}{$cart.user_data.firstname}{$cart.user_data.lastname}{if $cart.user_data.user_id}{/if}
        {assign var="timestamp" value=$cart.timestamp|date_format:"`$settings.Appearance.date_format`"|escape:url}
        / {$cart.user_data.timestamp|date_format:"`$settings.Appearance.date_format`"},{$cart.user_data.timestamp|date_format:"`$settings.Appearance.time_format`"}
        </span>

    {/if}
{/capture}

<div id="order_update">
{include file="common/mainbox.tpl" title=$smarty.capture.mainbox_title sidebar=$smarty.capture.sidebar content=$smarty.capture.mainbox buttons=$smarty.capture.buttons}
<!--order_update--></div>

</form>