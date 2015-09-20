{capture name="mainbox"}

{capture name="tabsbox"}
<div id="content_general">

    <div class="item-summary clear center">
        <div class="pull-left">
        {include file="common/carriers.tpl" capture=true carrier=$shipment.carrier}
        
        {__("shipment")}&nbsp;&nbsp;<span>#{$shipment.shipment_id}</span>&nbsp;
        {__("on")}&nbsp;{$shipment.shipment_timestamp|date_format:"`$settings.Appearance.date_format`"}&nbsp;
        {__("by")}&nbsp;<span>{$shipment.shipping}</span>{if $shipment.tracking_number}&nbsp;({$shipment.tracking_number}){/if}{if $shipment.carrier}&nbsp;({$smarty.capture.carrier_name|trim nofilter}){/if}
        </div>
        
        {hook name="shipments:customer_shot_info"}
        {/hook}
    </div>
    
    {* Customer info *}
    {include file="views/profiles/components/profiles_info.tpl" user_data=$order_info location="I"}
    {* /Customer info *}

    <table width="100%" class="table table-middle">
    <thead>
        <tr>
            <th>{__("product")}</th>
            <th width="5%">{__("quantity")}</th>
        </tr>
    </thead>
    {foreach from=$order_info.products item="oi" key="key"}
    {if $oi.amount > 0}
    <tr>
        <td>
            {if !$oi.deleted_product}<a href="{"products.update?product_id=`$oi.product_id`"|fn_url}">{/if}{$oi.product nofilter}{if !$oi.deleted_product}</a>{/if}
            {hook name="shipments:product_info"}
            {if $oi.product_code}</p>{__("sku")}:&nbsp;{$oi.product_code}</p>{/if}
            {/hook}
            {if $oi.product_options}<div class="options-info">{include file="common/options_info.tpl" product_options=$oi.product_options}</div>{/if}
        </td>
        <td class="center">
            &nbsp;{$oi.amount}<br />
        </td>
    </tr>
    {/if}
    {/foreach}
    </table>
    <div class="row-fluid">
        <div class="clear order-notes">
            <div class="float-left">
                <h3><label for="notes">{__("comments")}:</label></h3>
                <textarea class="span12" cols="40" rows="5" readonly="readonly">{$shipment.comments}</textarea>
            </div>
        </div>
    </div>
    
<!--content_general--></div>
{/capture}
{include file="common/tabsbox.tpl" content=$smarty.capture.tabsbox active_tab=$smarty.request.selected_section track=true}

{/capture}
{capture name="mainbox_title"}
    {__("shipment_details")}
{/capture}

{capture name="buttons"}
    {capture name="tools_list"}
        {hook name="shipments:details_tools"}
            <li>{btn type="list" text="{__("order")} #`$order_info.order_id`" href="orders.details?order_id=`$order_info.order_id`"}</li>
            <li>{btn type="list" text=__("print_packing_slip") href="shipments.packing_slip?shipment_ids[]=`$shipment.shipment_id`" class="cm-new-window"}</li>
            <li class="divider"></li>
            <li>{btn type="list" text=__("delete") class="cm-confirm" href="shipments.delete?shipment_ids[]=`$shipment.shipment_id`"}</li>
        {/hook}
    {/capture}
    {dropdown content=$smarty.capture.tools_list}
{/capture}

{include file="common/mainbox.tpl" title=$smarty.capture.mainbox_title content=$smarty.capture.mainbox buttons=$smarty.capture.buttons}