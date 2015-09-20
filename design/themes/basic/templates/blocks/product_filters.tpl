{** block-description:original **}

<div id="product_filters_{$block.block_id}">
{if $items && !$smarty.request.advanced_filter}

{if $runtime.controller != "index"}
    {assign var="filter_qstring" value="products.search"}
    {assign var="curl" value=$config.current_url}
    {assign var="filter_qstring" value=$curl|fn_query_remove:"result_ids":"full_render":"filter_id":"view_all":"req_range_id":"advanced_filter":"features_hash":"subcats":"page"}
{else}
    {assign var="filter_qstring" value="products.search"}
{/if}

{assign var="reset_qstring" value="products.search"}

{if $smarty.request.category_id && $settings.General.show_products_from_subcategories == "Y"}
    {assign var="filter_qstring" value=$filter_qstring|fn_link_attach:"subcats=Y"}
    {assign var="reset_qstring" value=$reset_qstring|fn_link_attach:"subcats=Y"}
{/if}

{assign var="ajax_div_ids" value="product_filters_*,products_search_*,category_products_*,product_features_*,breadcrumbs_*,currencies_*,languages_*"}

{assign var="has_selected" value=false}
{foreach from=$items item="filter" name="filters"}

{if $filter.slider || $filter.selected_ranges || $filter.ranges}
<div class="filter-wrap">
    {assign var="cookie_name_show_filter" value="show_filter_`$block.block_id`_`$filter.filter_id`"}
    {if $smarty.cookies.$cookie_name_show_filter == 'false' || !$smarty.cookies.$cookie_name_show_filter|fn_string_not_empty && $filter.display == "N"}
        {assign var="hide_filter" value=true}
    {else}
        {assign var="hide_filter" value=false}
    {/if}

    <i class="toggle-arrow {if $hide_filter}open{/if}">&nbsp;</i>
    <span class="filter-title {if $hide_filter}filter-open{/if}"
        onclick="
            if (Tygh.$('#content_product_more_filters_{$block.block_id}_{$filter.filter_id}').is(':hidden')) {ldelim}
                Tygh.$.cookie.set('show_filter_{$block.block_id}_{$filter.filter_id}', 'true');
            {rdelim} else {ldelim}
                Tygh.$.cookie.set('show_filter_{$block.block_id}_{$filter.filter_id}', 'false');
            {rdelim}
            Tygh.$('#content_product_more_filters_{$block.block_id}_{$filter.filter_id}').slideToggle('fast');
            Tygh.$(this).toggleClass('filter-open');
            Tygh.$(this).parent().find('.toggle-arrow').toggleClass('open');
        ">{$filter.filter}</span>
    {if $filter.slider}
        {include file="blocks/product_filter_slider.tpl" id="slider_`$block.block_id`_`$filter.filter_id`" filter=$filter ajax_div_ids=$ajax_div_ids dynamic=true}
    {else}
        <ul class="product-filters {if $hide_filter}hidden{/if}" id="content_product_more_filters_{$block.block_id}_{$filter.filter_id}">

        {foreach from=$filter.selected_ranges name="selected_ranges" item="selected_range"}
            {assign var="has_selected" value=true}
            <li>
                {strip}
                    {assign var="fh" value=$smarty.request.features_hash|fn_delete_range_from_url:$selected_range:$filter.field_type}
                    {if $fh}
                        {assign var="attach_query" value="features_hash=`$fh`"}
                    {/if}
                    {if $filter.feature_type == "E" && $selected_range.range_id == $smarty.request.variant_id}
                        {assign var="reset_lnk" value=$reset_qstring}
                    {else}
                        {assign var="reset_lnk" value=$filter_qstring}
                    {/if}
                    {if $fh}
                        {assign var="href" value=$reset_lnk|fn_link_attach:$attach_query|fn_url}
                    {else}
                        {assign var="href" value=$reset_lnk|fn_url}
                    {/if}
                    {assign var="use_ajax" value=$href|fn_compare_dispatch:$config.current_url}
                    {*assign var="use_ajax" value=false*}
                    <a href="{$href}" class="filter-item checked{if $use_ajax} cm-ajax cm-ajax-full-render" data-ca-target-id="{$ajax_div_ids}{/if}" rel="nofollow"><span class="filter-icon"><i class="icon-ok"></i><i class="icon-cancel"></i></span>{$filter.prefix}{$selected_range.range_name|fn_text_placeholders}{$filter.suffix}</a>
                {/strip}
            </li>
        {/foreach}

        {if $filter.selected_ranges && $filter.ranges|fn_is_not_empty}
            <ul id="other_variants_{$block.block_id}_{$filter.filter_id}">
        {/if}

        {assign var="cookie_name" value="more_filters_`$block.block_id`_`$filter.filter_id`"}
        {foreach from=$filter.ranges name="ranges" item="range"}
                <li{if $smarty.foreach.ranges.iteration > $filter.display_count} class="cm-toggle-visibility{if $smarty.cookies.$cookie_name != 'true'} hidden{/if}"{/if}>
                    {if !$range.checked}
                        {assign var="filter_query_elm" value=$smarty.request.features_hash|fn_add_range_to_url_hash:$range:$filter.field_type}
                    {else}
                        {assign var="filter_query_elm" value=$smarty.request.features_hash|fn_delete_range_from_url:$range:$filter.field_type}
                    {/if}
                    {if $smarty.request.features_hash}
                        {assign var="cur_features_hash" value="&features_hash=`$smarty.request.features_hash`"}
                    {/if}
                    {if $filter.feature_type == "E" && (!$filter.simple_link || $filter.selected_ranges && $runtime.controller == "product_features")}
                        {assign var="href" value="product_features.view?variant_id=`$range.range_id``$cur_features_hash`"|fn_url}
                    {else}
                        {assign var="href" value=$filter_qstring|fn_link_attach:"features_hash=`$filter_query_elm`"|fn_url}
                    {/if}
                    {assign var="use_ajax" value=$href|fn_compare_dispatch:$config.current_url}
                    {*assign var="use_ajax" value=false*}
                    <a {if !$range.disabled || $range.checked}href="{$href}"{/if} {if $filter.feature_type != "E"}rel="nofollow"{/if} class="filter-item{if $range.checked} checked{/if}{if $range.disabled} disabled{elseif $use_ajax} cm-ajax cm-ajax-full-render{/if}" data-ca-target-id="{$ajax_div_ids}">{$filter.prefix}{$range.range_name|fn_text_placeholders}{$filter.suffix}&nbsp;{if !$range.disabled}<span class="details">&nbsp;({$range.products})</span>{/if}</a>
                </li>
        {/foreach}

        {if $smarty.foreach.ranges.iteration > $filter.display_count}
            <li class="extra-link-wrap">
                <a id="more_filters_{$block.block_id}_{$filter.filter_id}"
                    onclick="
                        if (Tygh.$('#content_product_more_filters_{$block.block_id}_{$filter.filter_id} li.cm-toggle-visibility').is(':hidden')) {ldelim}
                            Tygh.$.cookie.set('more_filters_{$block.block_id}_{$filter.filter_id}', 'true');
                            Tygh.$(this).html('{__("less")}');
                        {rdelim} else {ldelim}
                            Tygh.$.cookie.set('more_filters_{$block.block_id}_{$filter.filter_id}', 'false');
                            Tygh.$(this).html('{__("more")}');
                        {rdelim}
                        Tygh.$('#content_product_more_filters_{$block.block_id}_{$filter.filter_id} li.cm-toggle-visibility').toggle('fast');
                        Tygh.$('#view_all_{$block.block_id}_{$filter.filter_id}').toggle('fast');
                        return false;
                    " class="extra-link">{if $smarty.cookies.$cookie_name != 'true'}{__("more")}{else}{__("less")}{/if}</a>
            </li>
        {/if}

        {if $filter.more_cut}
            {capture name="q"}{$filter_qstring nofilter}&filter_id={$filter.filter_id}&{if $smarty.request.features_hash}&features_hash={$smarty.request.features_hash}{/if}{/capture}
            <li id="view_all_{$block.block_id}_{$filter.filter_id}" class="right{if $smarty.foreach.ranges.iteration != $filter.display_count && $smarty.cookies.$cookie_name != 'true'} hidden{/if}">
                {assign var="capture_q" value=$smarty.capture.q|escape:url}
                <a href="{"product_features.view_all?q=`$capture_q`"|fn_url}" rel="nofollow" class="extra-link">{__("view_all")}</a>
            </li>
        {/if}

        {if $filter.selected_ranges && $filter.ranges|fn_is_not_empty}
            </ul>
            {*<p><a onclick="Tygh.$('#other_variants_{$block.block_id}_{$filter.filter_id}').slideToggle('fast');" class="extra-link">{__("choose_other")}</a></p>*}
        {/if}

        </ul>
    {/if}
</div>
{/if}
{/foreach}

<div class="filters-tools clearfix">
    <div class="float-right"><a {if "FILTER_CUSTOM_ADVANCED"|defined}href="{"products.search?advanced_filter=Y"|fn_url}"{else}href="{$filter_qstring|fn_link_attach:"advanced_filter=Y"|fn_url}"{/if} rel="nofollow" class="secondary-link">{__("advanced")}</a></div>
    {if $has_selected || $smarty.capture.has_selected}
    <a href="{if $smarty.request.category_id}{assign var="use_ajax" value=true}{*assign var="use_ajax" value=false*}{"categories.view?category_id=`$smarty.request.category_id`"|fn_url}{else}{assign var="use_ajax" value=false}{""|fn_url}{/if}" rel="nofollow" class="reset-filters{if $use_ajax} cm-ajax cm-ajax-full-render" data-ca-target-id="{$ajax_div_ids}{/if}"><i class="icon-cw"></i> {__("reset")}</a>
    {/if}
</div>

{/if}
<!--product_filters_{$block.block_id}--></div>
