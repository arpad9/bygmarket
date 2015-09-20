{literal}
<style type="text/css">

.top-cart-content{
	text-align:left;
}
.top-cart-content img{
	left:2px !important;
	top:-6px !important;
}
.top-cart-content a:link, .top-cart-content a:hover{
	width:80px !important;
	text-align:left;
}
/*.top-cart-content a.cartEmpty, .top-cart-content a.cartEmpty:hover{
	width:120px !important;
	text-align:right !important;
}*/
/*
.cartAmount{
	background: url("design/themes/4p4g/media/images/shopping_cart_icon.png") no-repeat scroll 0 0 transparent;
	width:48px;
	height:30px;
	display:block;
	padding-top:10px;
	text-align:left;
}
*/
</style>
{/literal}
<div class="dropdown-box {if $smarty.session.cart.amount}filled{/if}" id="cart_status_{$dropdown_id}">
    <img class='cart-image' src="design/themes/4p4g/media/images/shopping_cart_icon.png">
    {if $smarty.session.cart.amount}
    	{*<img class='cart-image' src="design/themes/4p4g/media/images/shopping_cart_icon.png">*}
	    <a href="{"checkout.cart"|fn_url}" id="sw_dropdown_{$dropdown_id}" class="cm-popup-title cm-combination">
	        {hook name="checkout:dropdown_title"}
	        	{*<div class="minicart-title hand cartAmount">{$smarty.session.cart.amount}</div>*}
	        	<span class="minicart-title hand">
	        		<span style="color:#E47911; margin-right:5px;"><b>{$smarty.session.cart.amount}</b></span>&nbsp;&nbsp;&nbsp;<span>Cart</span><i class="icon-down-micro"></i></span>
	        {/hook}
	    </a>
	{else}
		{*<img class='cart-image' src="design/themes/4p4g/media/images/shopping_cart_icon_empty.png">*}
	    <a href="{"checkout.cart"|fn_url}" id="sw_dropdown_{$dropdown_id}" class="cm-popup-title cm-combination cm-combo-on cartEmpty">
	        {hook name="checkout:dropdown_title"}
	            {*<span class="minicart-title empty-cart hand">{__("cart_is_empty")}<i class="icon-down-micro"></i></span>*}
	            <span class="minicart-title hand"><span style="color:#E47911; margin-right:5px;"><b>0</b></span>&nbsp;&nbsp;&nbsp;<span>Cart</span><i class="icon-down-micro"></i></span>
	        {/hook}
	    </a>
    {/if}
    
    <div id="dropdown_{$dropdown_id}" class="cm-popup-box popup-content hidden">
        {hook name="checkout:minicart"}
            <div class="cm-cart-content {if $block.properties.products_links_type == "thumb"}cm-cart-content-thumb{/if} {if $block.properties.display_delete_icons == "Y"}cm-cart-content-delete{/if}">
                    <div class="cart-items">
                        {if $smarty.session.cart.amount}
                            <table class="minicart-table">
                                {hook name="index:cart_status"}
                                {assign var="_cart_products" value=$smarty.session.cart.products|array_reverse:true}
                                {foreach from=$_cart_products key="key" item="p" name="cart_products"}
                                {if !$p.extra.parent}
                                <tr class="minicart-separator">
                                    {if $block.properties.products_links_type == "thumb"}
                                    <td style="width: 5%" class="cm-cart-item-thumb">{include file="common/image.tpl" image_width="40" image_height="40" images=$p.main_pair no_ids=true}</td>
                                    {/if}
                                    <td style="width: 94%"><a href="{"products.view?product_id=`$p.product_id`"|fn_url}">{$p.product_id|fn_get_product_name nofilter}</a>
                                    <p>
                                        <span>{$p.amount}</span><span>&nbsp;x&nbsp;</span>{include file="common/price.tpl" value=$p.display_price span_id="price_`$key`_`$dropdown_id`" class="none"}
                                    </p></td>
                                    {if $block.properties.display_delete_icons == "Y"}
                                    <td style="width: 1%" class="minicart-tools cm-cart-item-delete">{if (!$runtime.checkout || $force_items_deletion) && !$p.extra.exclude_from_calculate}{include file="buttons/button.tpl" but_href="checkout.delete.from_status?cart_id=`$key`&redirect_url=`$r_url`" but_meta="cm-ajax cm-ajax-full-render" but_target_id="cart_status*" but_role="delete" but_name="delete_cart_item"}{/if}</td>
                                    {/if}
                                </tr>
                                {/if}
                                {/foreach}
                                {/hook}
                            </table>
                        {else}
                            <p class="center">{__("cart_is_empty")}</p>
                        {/if}
                    </div>

                    {if $block.properties.display_bottom_buttons == "Y"}
                    <div class="cm-cart-buttons buttons-container{if $smarty.session.cart.amount} full-cart{else} hidden{/if}">
                        <div class="view-cart-button">
                            <span class="button button-wrap-left"><span class="button button-wrap-right"><a href="{"checkout.cart"|fn_url}" rel="nofollow" class="view-cart">{__("view_cart")}</a></span></span>
                        </div>
                        {if $settings.General.checkout_redirect != "Y"}
                        <div class="float-right">
                            <span class="button-action button-wrap-left"><span class="button-action button-wrap-right"><a href="{"checkout.checkout"|fn_url}" rel="nofollow">{__("checkout")}</a></span></span>
                        </div>
                        {/if}
                    </div>
                    {/if}

            </div>
        {/hook}
    </div>
  <!-- cart_status_{$dropdown_id} -->
</div>