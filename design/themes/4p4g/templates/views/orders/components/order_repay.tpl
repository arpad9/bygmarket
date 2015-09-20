{if $order_info.total|floatval}

{if $smarty.request.payment_id}
{literal}
<script type="text/javascript">
//<![CDATA[
    Tygh.$(document).ready(function() {
        Tygh.$.scrollToElm(Tygh.$('#repay_order'));
    });
//]]>
</script>
{/literal}
{/if}

<h2 class="step-title-active clearfix" id="repay_order"><span class="title">{__("repay_order")}</span></h2>
<p>
    {include file="views/checkout/components/payments/payment_methods.tpl" order_payment_id=$order_payment_id|default:$order_info.payment_id}
</p>
{/if}