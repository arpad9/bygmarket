{if $items|sizeof > 1}
<div class="tools-container inline {$class}" {if $select_container_id}id="{$select_container_id}"{/if}>
{assign var="language_text" value=$text|default:__("select_descr_lang")}

{if $style == "graphic"}
    {if $display_icons == true}
        <i class="flag flag-{$items.$selected_id.country_code|lower} single cm-external-click" data-ca-external-click-id="sw_select_{$selected_id}_wrap_{$suffix}"></i>
    {/if}

    <a class="select-link cm-combo-on cm-combination" id="sw_select_{$selected_id}_wrap_{$suffix}">{$items.$selected_id.$key_name}{if $items.$selected_id.symbol}&nbsp;({$items.$selected_id.symbol}){/if}<i class="icon-down-micro"></i></a>
    
    <div id="select_{$selected_id}_wrap_{$suffix}" class="popup-tools cm-popup-box cm-smart-position hidden">
        {if $key_name == 'company'}<input id="filter" class="input-text cm-filter" type="text" style="width: 85%"/>{/if}
        <ul class="cm-select-list{if $display_icons == true} popup-icons{/if}">
            {foreach from=$items item=item key=id}
                <li><a name="{$id}" href="{"`$link_tpl``$id`"|fn_url}">{if $display_icons == true}<i class="flag flag-{$item.country_code|lower}"></i>{/if}{$item.$key_name}{if $item.symbol}&nbsp;({$item.symbol nofilter}){/if}</a></li>
            {/foreach}
        </ul>
    </div>
{elseif $style == "select"}
    {if $text}<label for="id_{$var_name}">{$text}:</label>{/if}
    <select id="id_{$var_name}" name="{$var_name}" onchange="$.redirect(this.value);" class="valign">
        {foreach from=$items item=item key=id}
            <option value="{$link_tpl}{$id}" {if $id == $selected_id}selected="selected"{/if}>{$item.$key_name}</option>
        {/foreach}
    </select>
{/if}
</div>
{/if}