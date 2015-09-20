<style>
.subheader{ padding:0px !important;}
</style>
{if $event_data}
<div class="weddingInfoContainer">
	<div class="registryTitle">Wedding <span class="darkColor">Registry</span></div>
	<div class="registryInfoTitle">{$event_data.yourfname} {$event_data.yourlname} and {$event_data.theirfname} {$event_data.theirlname}'s Wedding Registry</div>
	{*$settings.Appearance.date_format*}
	<div class="registryInfoWelcome"><span><b>Event Date:</b> {$event_data.event_date|date_format:'%B %d, %Y'}</span></div>
	<div class="registryInfoWelcome"><b>Event City:</b> {$event_data.event_city}</div>
	{if $event_data.about}<div class="registryInfoWelcome"><b>About Me and My Wedding:</b> {$event_data.about}</div>{/if}
</div>
{/if}

{include file="common/subheader.tpl" title=__("defined_desired_products")}
{if $event_data.products}
{script src="js/tygh/exceptions.js"}
<form {if !$config.tweaks.disable_dhtml && !$no_ajax}class="cm-ajax cm-ajax-full-render"{/if} action="{""|fn_url}" method="post" name="event_products_form">
<input type="hidden" name="result_ids" value="cart_status*" />
<input type="hidden" name="redirect_url" value="{$config.current_url}" />
{include file="common/pagination.tpl"}
{foreach from=$event_data.products item="product" key="key" name="products"}
<input type="hidden" name="product_data[{$key}][product_id]" value="{$product.product_id}" />
<div class="events-products">
<div class="product-container">
    <table class="table-width">
        <tbody>
            <tr>
                <td rowspan="5" style="width: 10%">
                    <div class="product-image cm-reload-{$key}" id="image_update_{$key}">
                        <a href="{"products.view?product_id=`$product.product_id`"|fn_url}">
                        {include file="common/image.tpl" image_width=$settings.Thumbnails.product_lists_thumbnail_width image_height=$settings.Thumbnails.product_lists_thumbnail_height obj_id=$key images=$product.main_pair}</a>
                    <!--image_update_{$key}--></div>
                </td>
            </tr>
            <tr>
                <td>
                    <a href="{"products.view?product_id=`$product.product_id`"|fn_url}" class="product-title">{$product.product nofilter}</a>
                    <p class="sku{if !$product.product_code} hidden{/if}">
                    <span class="cm-reload-{$key}" id="product_code_update_{$key}">
                        <span id="sku_{$product.product_id}">
                            {__("sku")}: <span id="product_code_{$product.product_id}">{$product.product_code}</span>
                        </span>
                    <!--product_code_update_{$key}--></span>
                    </p>                    
                </td>
            </tr>
            <tr>
                <td>
                    {if $product.product_options}
                        <div class="cm-reload-{$key}" id="options_update_{$key}">
                            <input type="hidden" name="appearance[events]" value="1" />
                            <input type="hidden" name="appearance[event_id]" value="{$registry_type_id}" />
                            {include file="views/products/components/product_options.tpl" product_options=$product.product_options product=$product name="product_data" id=$key location="cart" disabled=$product.disabled_options}
                        <!--options_update_{$key}--></div>
                    {/if}
                </td>
            </tr>
            <tr>
                <td>
                <div class="cm-reload-{$key}" id="additional_info_update_{$key}">
                    <table class="table margin-top" style="width:auto;">
                        <thead>
                            <tr>
                                <th class="right">{__("price")}</th>
                                <th>{__("desired_amount")}</th>
                                <th>{__("quantity")}</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="nowrap center">
                                    {include file="common/price.tpl" value=$product.price span_id="original_price_`$key`" class="sub-price"}</td>
                                <td class="nowrap center">{$product.amount}</td>
                                <td class="nowrap center">
                                        <input id="giftreg_item_amount_{$product.item_id}" type="hidden" name="product_data[{$key}][extra][events][{$product.item_id}]" value="0"  />
                                        <input id="giftreg_id" type="hidden" name="product_data[{$key}][extra][events][registry_type_id]" value="{$event_data.wr_id}"  />
                                        {if $product.avail_amount}
                                            {assign var="range" value=1|range:$product.avail_amount}

                                            <select name="product_data[{$key}][amount]" onchange="$('#giftreg_item_amount_{$product.item_id}').val(this.value);"  style="width:auto;">
                                                <option value="">0</option>
                                                {foreach from=$range item=r}
                                                    <option value="{$r}">{$r}</option>
                                                {/foreach}
                                            </select>
                                            {assign var="show_add_to_cart" value="Y"}
                                        {else}
                                            &nbsp;-&nbsp;
                                        {/if}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                <!--additional_info_update_{$key}--></div>
                </td>
            </tr>
            <tr>
                <td>
                    {if $product.short_description || $product.full_description}
                        <div class="product-desc">
                            <h4>{__("description")}</h4>                        
                        {if $product.short_description}
                            {$product.short_description nofilter}
                        {else}
                            {$product.full_description|strip_tags|truncate:280:"..." nofilter}{if $product.full_description|strlen > 280}<a href="{"products.view?product_id=`$product.product_id`"|fn_url}">{__("more_link")}</a>{/if}
                        {/if}
                        </div>
                    {/if}
                </td>
            </tr>
        </tbody>
    </table>
</div>
</div>
{if !$smarty.foreach.products.last}
<hr />
{/if}
{/foreach}
{include file="common/pagination.tpl"}
{* if $show_add_to_cart == "Y" *}
<div class="buttons-container">
    {include file="buttons/add_to_cart.tpl" but_name="dispatch[checkout.add]" but_role="action"}
</div>
{* /if *}
</form>
{else}
    <p class="no-items">{__("text_no_products_defined")}</p>
{/if}

</div>
