<div class="qsearch-result border cm-popup-box" id="{$id}_result">

{if $patterns}
    <table class="quick-search sortable table-width">
    {foreach from=$patterns item="pattern"}
        <tr class="cm-search-row nowrap"><td data-ca-qs-text="{$pattern.full_text}">{if $pattern.url}<a href="{$pattern.url|urldecode nofilter}">{/if}{if $addons.quick_search.show_product_images == "Y" && !$settings.General.search_objects}{include file="common/image.tpl" image_width="40" image_height="40" images=$pattern.image obj_id=$pattern.id}&nbsp;{/if}{$pattern.text.highlighted|default:$pattern.text.value nofilter}{if $pattern.url}</a>{/if}</td></tr>
    {/foreach}
    </tbody>
    </table>
{else}
    <div class="center">{__("no_data")}</div>
{/if}

<p class="right">
    <a class="extra-link" onclick="Tygh.$('#{$id}_result').hide();">{__("close")}</a>
</p>
<!--{$id}_result--></div>

<script type="text/javascript">
    var qs_min_length = {$addons.quick_search.min_length}
</script>