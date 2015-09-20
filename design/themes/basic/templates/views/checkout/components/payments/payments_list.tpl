<div class="other-pay{if $payment_data.category == "cc"} cc-form{/if} clearfix">
    <ul class="paym-methods">
        {foreach from=$payments item="payment"}

            {if $order_info}
                {assign var="payment_data" value=$payment_method}
                {assign var="payment_id" value=$order_payment_id}
                {assign var="url" value="orders.details?order_id=`$order_info.order_id`&payment_id=`$payment.payment_id`&active_tab=`$tab_id`"|fn_url}
                {assign var="onclick" value="Tygh.$.ceAjax('request', '`$url`', `$ldelim`method: 'GET', caching: false, force_exec: true, full_render: true, result_ids: 'checkout*,content_payments*'`$rdelim`);"}
            {else}
                {assign var="payment_data" value=$payment.payment_id|fn_get_payment_method_data}
                {assign var="payment_id" value=$cart.payment_id}
                {assign var="url" value="checkout.update_payment?payment_id=`$payment.payment_id`&active_tab=`$tab_id`"|fn_url}
                {assign var="onclick" value="Tygh.$.ceAjax('request', '`$url`', `$ldelim`method: 'POST', caching: false, force_exec: true, full_render: true, result_ids: 'checkout*,content_payments*'`$rdelim`);"}
            {/if}
            {if $payment_id == $payment.payment_id}
                {assign var="instructions" value=$payment.instructions}
                {assign var="description" value=$payment.description}
            {/if}
            <li>
                <input id="payment_{$payment.payment_id}" class="radio valign" type="radio" name="payment_id" value="{$payment.payment_id}" {if $payment_id == $payment.payment_id}checked="checked"{/if} onclick="{$onclick}" />
                <div class="radio1">
                    <h5><label for="payment_{$payment.payment_id}">{$payment.payment}</label></h5>
                    {$payment.description}
                </div>
            </li>

            {if $payment_id == $payment.payment_id}
                {capture name="group_payment"}N{/capture}
                {if $payment_data.template && $payment_data.template != "cc_outside.tpl"}
                    <div>
                        {include file=$payment_data.template}
                    </div>
                {/if}
            {/if}

        {/foreach}
    </ul>
        <div class="other-text">
            {$instructions nofilter}
        </div>
</div>
