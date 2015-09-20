{if $data}
    {foreach from=$data key="key_name" item="item_id" name="for_add_data"}
    <p>
        {if $key_name=="O"}{assign var="order_status_data" value=$data.order_status|fn_get_status_data:$smarty.const.STATUSES_ORDER}
            {__("order")}: #{$item_id} {__("status")}: {$order_status_data.description}
        {elseif $key_name=="P" && $data.product_name}
            {__("product")}: <a onclick="window.open('{"products.view?product_id=`$item_id`"|fn_url}','product_popup_window','width=450,height=350,toolbar=yes,status=no,scrollbars=yes,resizable=no,menubar=yes,location=no,direction=no');">{$data.product_name}</a>
        {elseif $key_name=="D" && $data.coupon.coupon_code}
            {__("coupon_code")}: {$data.coupon.coupon_code}{*</a>*}
        {elseif $key_name=="R" && $item_id}
             {__("url")}: <a href="{$item_id|fn_url}" target="_blank">{$item_id}</a>
        {/if}
    </p>
    {/foreach}
{/if}