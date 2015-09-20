<!DOCTYPE html>
<html lang="{$smarty.const.CART_LANGUAGE}">
<head>
{strip}
<title>
{if $page_title}
    {$page_title}
{else}
    {foreach from=$breadcrumbs item=i name="bkt"}
        {if !$smarty.foreach.bkt.first}{$i.title|strip_tags}{if !$smarty.foreach.bkt.last} :: {/if}{/if}
    {/foreach}
    {if !$skip_page_title}{if $breadcrumbs|count > 1} - {/if}{$location_data.title}{/if}
{/if}
</title>
{/strip}
{include file="meta.tpl"}
<link href="{$logos.favicon.image.image_path}" rel="shortcut icon" />
{include file="common/styles.tpl" include_dropdown=true}
{include file="common/scripts.tpl"}
</head>

<body>
{if $runtime.customization_mode.design}
    {include file="common/toolbar.tpl"}
{/if}
{if "THEMES_PANEL"|defined}
    {include file="demo_theme_selector.tpl"}
{/if}

<div class="tygh" id="tygh_container">

{include file="common/loading_box.tpl"}
{include file="common/notification.tpl"}

<div class="helper-container" id="tygh_main_container">
    {hook name="index:content"}
        {render_location}
    {/hook}
<!--tygh_main_container--></div>


{if $runtime.customization_mode.translation}
    {include file="common/translate_box.tpl"}
{/if}
{if $runtime.customization_mode.design}
    {include file="common/template_editor.tpl"}
{/if}
{if $runtime.customization_mode.theme_editor}
    {include file="common/theme_editor.tpl"}
{/if}
{hook name="index:footer"}{/hook}
<!--tygh_container--></div>
</body>

</html>
