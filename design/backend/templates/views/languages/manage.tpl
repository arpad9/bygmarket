{capture name="mainbox"}

{capture name="tabsbox"}

<div id="content_translations">

<form action="{""|fn_url}" method="post" name="language_variables_form">
<input type="hidden" name="q" value="{$smarty.request.q}">
<input type="hidden" name="selected_section" value="{$smarty.request.selected_section}">

{include file="common/pagination.tpl" save_current_page=true save_current_url=true}

{if $lang_data}
<table class="table" width="100%">
<thead>
    <tr>
        <th width="1%">{include file="common/check_items.tpl"}</th>
        <th width="60%">{__("value")}</th>
        <th width="33%">{__("language_variable")}</th>
        <th>&nbsp;</th>
    </tr>
</thead>
<tbody>
{foreach from=$lang_data item="var" key="key"}
<tr>
    <td>
        <input type="checkbox" name="names[]" value="{$var.name}" class="checkbox cm-item">
    </td>
    <td>
        <textarea name="lang_data[{$key}][value]" rows="3" class="span7">{$var.value}</textarea>
    </td>
    <td>
        <input type="hidden" name="lang_data[{$key}][name]" value="{$var.name}">
        <p class="lang-name"><span>{$var.name}</span></p>
    </td>
    <td>
        {if "ULTIMATE"|fn_allowed_for && !$runtime.company_id}
            {include file="buttons/update_for_all.tpl" display=true object_id=$key name="lang_data[`$key`][overwrite]"}
        {/if}
        {assign var="c_url" value=$config.current_url|escape:url}
        {capture name="tools_items"}
        <a class="cm-confirm" href="{"languages.delete_variable?name=`$var.name`&redirect_url=`$c_url`"|fn_url}" title="{__("delete")}">
            {if "ULTIMATE"|fn_allowed_for}
                {if $runtime.company_id}
                    {__("restore_default")}
                {/if}
            {else}
                <i class="icon-trash"></i>
            {/if}
        </a>
        {/capture}
        <div class="hidden-tools">
            {include file="common/table_tools_list.tpl" prefix=$var.name tools_list=$smarty.capture.tools_items}
        </div>
    </td>
</tr>
{/foreach}
</tbody>
</table>
{else}
    <p class="no-items">{__("no_data")}</p>
{/if}
{include file="common/pagination.tpl"}
</form>

{if $lang_data}
    {capture name="delete_button"}
        {$smarty.capture.delete_button}
        <li class="cm-tab-tools" id="tools_translations_delete_buttons">
            {btn type="delete_selected" dispatch="dispatch[languages.m_delete_variables]" form="language_variables_form"}
        </li>
    {/capture}

    {capture name="add_button"}
        {$smarty.capture.add_button}
        <span class="cm-tab-tools btn-group" id="tools_translations_save_button">
            {include file="buttons/save.tpl" but_name="dispatch[languages.m_update_variables]" but_role="submit-link" but_target_form="language_variables_form"}
        </span>
    {/capture}
{/if}


{capture name="add_langvar"}

<form action="{""|fn_url}" method="post" name="lang_add_var">
<input type="hidden" name="page" value="{$smarty.request.page}" />
<input type="hidden" name="q" value="{$smarty.request.q}" />
<input type="hidden" name="selected_section" value="{$smarty.request.selected_section}" />

<table class="table">
<thead>
    <tr class="cm-first-sibling">
        <th width="40%">{__("language_variable")}</th>
        <th width="50%">{__("value")}</th>
        <th width="10%">&nbsp;</th>
    </tr>
</thead>
<tbody>
    <tr id="box_new_lang_tag" valign="top">
        <td>
            <input type="text" size="30" name="new_lang_data[0][name]"></td>
        <td>
            <textarea name="new_lang_data[0][value]" cols="48" rows="2"></textarea></td>
        <td>
            {include file="buttons/multiple_buttons.tpl" item_id="new_lang_tag"}</td>
    </tr>
</tbody>
</table>

<div class="buttons-container">
    {include file="buttons/save_cancel.tpl" but_name="dispatch[languages.update_variables]" cancel_action="close"}
</div>

</form>

{/capture}

</div>

<div class="hidden" id="content_languages">

{capture name="add_language"}
    {include file="views/languages/update.tpl" lang_data=[]}
{/capture}

{* FIXME: HARDCODE checking permissions. We need to divide these two forms by different modes *}
<form action="{""|fn_url}" method="post" name="languages_form" class="{if $runtime.company_id}cm-hide-inputs{/if}">
<input type="hidden" name="page" value="{$smarty.request.page}" />
<input type="hidden" name="selected_section" value="{$smarty.request.selected_section}" />

<table class="table table-middle">
<thead>
    <tr class="cm-first-sibling">
        <th width="3" class="left">
            {include file="common/check_items.tpl"}</th>
        <th>{__("language_code")}</th>
        <th>{__("name")}</th>
        <th>{__("country")}</th>
        <th>&nbsp;</th>
        <th class="right">{__("status")}</th>
    </tr>
</thead>
{if $langs|count == 1}
    {assign var="disable_change" value=true}
{/if}
<tbody>
{foreach from=$langs item="language"}
<tr class="cm-row-status-{$language.status|lower}">
    <td class="left">
        <input type="checkbox" name="lang_ids[]" value="{$language.lang_id}" {if $language.lang_code == $smarty.const.DEFAULT_LANGUAGE}disabled="disabled"{/if} class="checkbox cm-item"></td>
    <td>
        <input type="hidden" name="update_language[{$language.lang_id}][lang_code]" value="{$language.lang_code}">
        {btn type="dialog" text=$language.lang_code href="languages.update?lang_id=`$language.lang_id`" target_id="content_group`$language.lang_id`" prefix=$language.lang_id}
    </td>
    <td>
        {if "ULTIMATE:FREE"|fn_allowed_for}
            {$language.name}
        {else}
            <input type="text" class="input-hidden" name="update_language[{$language.lang_id}][name]" value="{$language.name}" maxlength="64">
        {/if}
    </td>
    <td>
        <select name="update_language[{$language.lang_id}][country_code]">
            {foreach from=$countries item="country" key="code"}
                <option {if $code == $language.country_code}selected="selected"{/if} value="{$code}">{$country}</option>
            {/foreach}
        </select>
    </td>
    <td class="nowrap right">
        <div class="hidden-tools">
            {capture name="tools_list"}
                {if "ULTIMATE:FREE"|fn_allowed_for}
                    <li>{btn type="text" text=__("edit") class="cm-promo-popup"}</li>
                {else}
                    <li>{btn type="dialog" text=__("edit") href="languages.update?lang_id=`$language.lang_id`" id="opener_group_`$language.lang_id`" target_id="content_group`$language.lang_id`" prefix=$language.lang_id}</li>
                {/if}
                {if $language.lang_code != $smarty.const.DEFAULT_LANGUAGE}
                    <li>{btn type="list" class="cm-confirm" text=__("delete") href="languages.delete_language?lang_id=`$language.lang_id`"}</li>
                {/if}
            {/capture}
            {dropdown content=$smarty.capture.tools_list}
        </div>

    </td>
    {capture name="popups"}
        {$smarty.capture.popups nofilter}
        <div id="content_group{$language.lang_id}" class="hidden" title="{"{__("editing_language")}: `$language.name`"}"></div>
    {/capture}

    <td class="right">
        {if $disable_change || $runtime.company_id || "ULTIMATE:FREE"|fn_allowed_for}
            {assign var="lang_id" value=""}
            {include file="common/select_popup.tpl" id=$lang_id prefix="lng" status=$language.status hidden="Y" object_id_name="lang_id" table="languages" update_controller="languages" non_editable=true}
        {else}
            {assign var="lang_id" value=$language.lang_id}
            {include file="common/select_popup.tpl" id=$lang_id prefix="lng" status=$language.status hidden="Y" object_id_name="lang_id" table="languages" update_controller="languages"}
        {/if}
    </td>

</tr>
{/foreach}
</tbody>
</table>

</form>

{capture name="delete_button"}
    {$smarty.capture.delete_button nofilter}
    <li class="cm-tab-tools" id="tools_languages_delete_buttons">
        {btn type="delete_selected" dispatch="dispatch[languages.m_delete]" form="languages_form"}
    </li>
{/capture}

{capture name="add_button"}
    {$smarty.capture.add_button nofilter}
    <span class="cm-tab-tools btn-group" id="tools_languages_save_button">
        {include file="buttons/save.tpl" but_name="dispatch[languages.m_update]"  but_role="submit-link" but_target_form="languages_form"}
    </span>
{/capture}

</div>

{$smarty.capture.popups nofilter}

{/capture}
    {include file="common/tabsbox.tpl" content=$smarty.capture.tabsbox active_tab=$smarty.request.selected_section track=true}
{/capture}

{capture name="sidebar"}
    {include file="views/languages/components/langvars_search_form.tpl"}
{/capture}

{capture name="adv_buttons"}
    {capture name="tools_list"}
        {if !"ULTIMATE:FREE"|fn_allowed_for && !$runtime.company_id}
            <li>{include file="common/popupbox.tpl" id="add_language" text=__("new_language") link_text=__("add_language") content=$smarty.capture.add_language act="link"}</li>
        {elseif "ULTIMATE:FREE"|fn_allowed_for}
            <li>{include file="buttons/button.tpl" but_role="icon" but_meta="cm-promo-popup" allow_href=false but_text=__("add_language")}</li>
        {/if}
            <li>{include file="common/popupbox.tpl" id="add_langvar" text=__("new_language_variable") link_text=__("add_language_variable") content=$smarty.capture.add_langvar act="link"}</li>
    {/capture}
    {dropdown content=$smarty.capture.tools_list icon="icon-plus" no_caret=true}
{/capture}

{capture name="buttons"}
    {capture name="tools_list"}
        {if "ULTIMATE:FREE"|fn_allowed_for}
            <li>{btn type="list" text=__("translate_privileges") class="cm-promo-popup"}</li>
        {else}
            <li>{btn type="list" href="usergroups.privileges" text=__("translate_privileges")}</li>
        {/if}
        {$smarty.capture.delete_button nofilter}
    {/capture}
    {dropdown content=$smarty.capture.tools_list}

    {$smarty.capture.add_button nofilter}
{/capture}

{include file="common/mainbox.tpl" title=__("languages") content=$smarty.capture.mainbox buttons=$smarty.capture.buttons adv_buttons=$smarty.capture.adv_buttons sidebar=$smarty.capture.sidebar select_languages=true}
