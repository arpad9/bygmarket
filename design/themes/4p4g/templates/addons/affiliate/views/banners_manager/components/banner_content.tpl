{strip}
{capture name="banner_content"}
    {if $banner_type == "iframe_content" || $banner_type == "js_content"}
        {if $banner_data.type == "T"}
            {* Text banner's template *}
            <table class="table-width" id="id_cart_{$banner_data.banner_id}_table">
                {if $banner_data.show_title == "Y"}
                    <tr>
                        <td style="padding: 10px 10px 0 10px; height: 15px;" id="id_cart_{$banner_data.banner_id}_title"><strong style="text-decoration: underline;">{$banner_data.title}</strong></td>
                    </tr>
                {/if}
            <tr>
                <td style="padding: 5px 10px 10px 10px;" class="valign-top" id="id_cart_{$banner_data.banner_id}_body">
                    {$banner_data.content nofilter}
                    <div id="id_cart_{$banner_data.banner_id}_link"></div>
                </td>
            </tr>
            </table>
        {elseif $banner_data.type == "G"}
            {* Graphic banner's template *}
            {if $banner_data.icon.image_type != "application/x-shockwave-flash"}
            <a href="{$banner_data.banner_url}" {if $banner_data.new_window == "Y"}target="_blank"{/if}>
            {/if}
                {include file="common/image.tpl" image_id=$banner_data.image_id images=$banner_data}
            {if $banner_data.icon.image_type != "application/x-shockwave-flash"}
            </a>
            {else}
            <div class="center">
            <a href="{$banner_data.banner_url}" {if $banner_data.new_window == "Y"}target="_blank"{/if}>{$banner_data.content}</a>
            </div>
            {/if}
        {elseif $banner_data.type == "P"}
            {* Product banner's template *}
            {if $banner_type == "iframe_content" && $banner_data.align}
            <div class="{$banner_data.align}">
            {/if}
            <table {if $banner_type == "iframe_content" && $banner_data.align}align="{$banner_data.align}"{/if}>
            {capture name="image_content"}
            <tr>
                <td class="{$banner_data.align}">
                    {if $banner_data.banner_url}<a href="{$banner_data.banner_url}" target="{if $banner_data.new_window == "Y" || $banner_type == "iframe_content"}_blank{else}_self{/if}">{/if}{include file="common/image.tpl" obj_id=$banner_data.product_id images=$banner_data.main_pair image_width=$image_width|default:$settings.Thumbnails.product_lists_thumbnail_width image_height=$image_height|default:$settings.Thumbnails.product_lists_thumbnail_height no_ids=true external=true}{if $banner_data.banner_url}</a>{/if}
                </td>
            </tr>
            {/capture}
            {capture name="product_name_content"}
            <tr>
                <td class="strong {$banner_data.align}">
                    <a href="{$banner_data.banner_url}" target={if $banner_data.new_window == "Y" || $banner_type == "iframe_content"}_blank{else}_self{/if}>{$banner_data.product}</a>
                </td>
            </tr>
            {/capture}
            {capture name="short_description_content"}
            <tr>
                <td>
                    <p>{if $banner_data.product_short_description}
                        {$banner_data.product_short_description nofilter}
                    {else}
                        {$banner_data.product_full_description|strip_tags|truncate:280:"..." nofilter}
                    {/if}</p>
                </td>
            </tr>
            {/capture}

            {if $banner_data.image == "T"}
                {$smarty.capture.image_content nofilter}
            {/if}
            {if $banner_data.product_name == "T"}
                {$smarty.capture.product_name_content nofilter}
            {/if}
            {if $banner_data.short_description == "T"}
                {$smarty.capture.short_description_content nofilter}
            {/if}
            {if $banner_data.image == "B"}
                {$smarty.capture.image_content nofilter}
            {/if}
            {if $banner_data.product_name == "B"}
                {$smarty.capture.product_name_content nofilter}
            {/if}
            {if $banner_data.short_description == "B"}
                {$smarty.capture.short_description_content nofilter}
            {/if}
            </table>
            {if $banner_type == "iframe_content" && $banner_data.align}
            </div>
            {/if}
        {/if}
    {elseif $banner_type == "iframe"}
        {capture name="_href"}aff_banner{if $runtime.mode=="demo"}.{$runtime.mode}{/if}?bid={$banner_data.banner_id}&image={$banner_data.image}&product_name={$banner_data.product_name}&short_description={$banner_data.short_description}&align={$banner_data.align}&new_window={$banner_data.new_window}&border={if $banner_data.border}Y{/if}&to_cart={$banner_data.to_cart}&type=iframe_content{/capture}
        <iframe src="{$smarty.capture._href|fn_url:'C':'http' nofilter}" scrolling="No" {if $banner_data.width}width="{$banner_data.width}"{/if} {if $banner_data.height}height="{$banner_data.height}"{/if} frameborder="0" {$banner_data.border}> </iframe>
    {elseif $banner_type == "js"}
        {if $mode == "demo"}
            {"aff_banner.`$runtime.mode`?bid=`$banner_data.banner_id`&image=`$banner_data.image`&product_name=`$banner_data.product_name`&short_description=`$banner_data.short_description`&align=`$banner_data.align`&new_window=`$banner_data.new_window`&border=`$banner_data.border`&to_cart=`$banner_data.to_cart`&type=js_content&width=`$banner_data.width`&height=`$banner_data.height`&sl=`$smarty.const.CART_LANGUAGE`&product_ids=`$banner_data.product_ids`"|fn_url:'C':'http' nofilter}
        {else}
            {"aff_banner.view?bid=`$banner_data.banner_id`&type=js_content&sl=`$smarty.const.CART_LANGUAGE`&product_ids=`$banner_data.product_ids`&aff_id=$partner_id"|fn_url:'C':'http' nofilter}
        {/if}
    {/if}
{/capture}
{/strip}

{if $banner_type != "iframe" && $banner_type != "js"}
    {if $banner_type == "iframe_content"}
        <html><body>
        {$smarty.capture.banner_content nofilter}
        </body></html>
    {elseif $banner_type == "js_content"}
        <table {$banner_data.wh_style nofilter}>
        <tr>
            <td class="valign-top" {$banner_data.border nofilter} {if $banner_data.align}align="{$banner_data.align}"{/if}>
                {$smarty.capture.banner_content nofilter}
            </td>
        </tr>
        </table>
    {/if}
{else}
    {$smarty.capture.banner_content nofilter}
{/if}
