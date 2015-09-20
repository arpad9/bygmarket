{if $checkout_buttons[$payment.payment_id]}
    {assign var="has_button" value=true}
{/if}

{if $order_info}
    {assign var="payment_data" value=$payment_method}
    {assign var="payment_id" value=$order_payment_id}
    {assign var="url" value="orders.details?order_id=`$order_info.order_id`&payment_id=`$payment.payment_id`"|fn_url}
    {assign var="onclick" value="Tygh.$.ceAjax('request', '`$url`', `$ldelim`method: 'GET', caching: false, force_exec: true, full_render: true, result_ids: 'checkout*,content_payments*'`$rdelim`);"}
{else}
    {assign var="payment_data" value=$payment.payment_id|fn_get_payment_method_data}
    {assign var="payment_id" value=$cart.payment_id}
    {assign var="url" value="checkout.update_payment?payment_id=`$payment.payment_id`&active_tab=`$tab_id`"|fn_url}
    {assign var="onclick" value="Tygh.$.ceAjax('request', '`$url`', `$ldelim`method: 'POST', caching: false, force_exec: true, full_render: true, result_ids: 'checkout*,content_payments*'`$rdelim`);"}
{/if}


<div class="form-payment payment-delim clearfix">
    {if $payment.instructions}
        <div class="other-text other-text-right">
            {$payment.instructions nofilter}
        </div>
    {/if}

    {if $payment.image}
        <span class="payment-image">
            <label for="payment_{$payment.payment_id}"><img src="{$payment.image.icon.image_path}" alt="" class="valign" /></label>
        </span>
    {/if}

    <input type="radio" id="payment_{$payment.payment_id}" name="payment_id" value="{$payment.payment_id}" {if $payment_id == $payment.payment_id}checked="checked"{/if} onclick="{$onclick}" />
    <label for="payment_{$payment.payment_id}"><strong>{$payment.payment}</strong></label>

    <div class="form-payment-field">

        {if $payment.description}
            <p class="description">{$payment.description}</p>
        {/if}

        {if $payment_id == $payment.payment_id}
            {capture name="group_payment"}N{/capture}
            {if $payment_data.template && $payment_data.template != "cc_outside.tpl"}
                <div>
                    {include file=$payment_data.template}
                </div>
            {/if}
        {/if}

    </div>
</div>
