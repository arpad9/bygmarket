{** block-description:feature_comparison **}

{assign var="compared_products" value=""|fn_get_comparison_products}
{assign var="hide_wrapper" value=false scope="parent"}

<div id="comparison_list">

{if $compared_products}
<ul class="bullets-list">
    {foreach from=$compared_products item="product"}
        <li><a {if $product.product_id == $new_product}id="blinking_elm{$block.block_id}"{/if} href="{"products.view?product_id=`$product.product_id`"|fn_url}" class="underlined">{$product.product nofilter}</a></li>
    {/foreach}
</ul>

<div class="clearfix">
    <div class="float-left">
        {include file="buttons/button.tpl" but_text=__("compare") but_href="product_features.compare" but_role="text"}
    </div>

    <div class="float-right">
        {if !$config.tweaks.disable_dhtml}
            {assign var="ajax_class" value="cm-ajax"}
        {/if}

        {if $runtime.mode == "compare"}
            {assign var="c_url" value=""|fn_url:"C":"rel"}
            {include file="buttons/button.tpl" but_text=__("clear_list") but_href="product_features.clear_list?redirect_url=`$c_url`" but_role="text"}
        {else}
            {assign var="c_url" value=$config.current_url|escape:url}
            {include file="buttons/button.tpl" but_text=__("clear_list") but_href="product_features.clear_list?redirect_url=`$c_url`" but_target_id="comparison_list" but_meta=$ajax_class but_role="text"}
        {/if}
    </div>
</div>
{else}
{assign var="hide_wrapper" value=true scope="parent"}
{/if}

<!--comparison_list--></div>
