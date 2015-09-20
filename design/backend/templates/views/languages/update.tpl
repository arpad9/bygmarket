{if $lang_data}
    {assign var="id" value=$lang_data.lang_id}
{else}
    {assign var="id" value="0"}
{/if}

<div id="content_group{$id}">

<form action="{""|fn_url}" method="post" name="add_language_form" class="form-horizontal{if !""|fn_allow_save_object:"languages"} cm-hide-inputs{/if}">
<input type="hidden" name="selected_section" value="languages" />
<input type="hidden" name="lang_id" value="{$id}" />

<div class="tabs cm-j-tabs">
    <ul class="nav nav-tabs">
        <li id="tab_general_{$id}" class="cm-js cm-active"><a>{__("general")}</a></li>
    </ul>
</div>

<div class="cm-tabs-content">
    <div id="content_tab_general_{$id}">
        <fieldset>
            <div class="control-group">
                <label for="elm_to_lang_code_{$id}" class="control-label cm-required">{__("language_code")}:</label>
                <div class="controls">
                    <input id="elm_to_lang_code_{$id}" type="text" name="language_data[lang_code]" value="{$lang_data.lang_code}" size="6" maxlength="2">
                </div>
            </div>

            <div class="control-group">
                <label for="elm_lang_name_{$id}" class="control-label cm-required">{__("name")}:</label>
                <div class="controls">
                    <input id="elm_lang_name_{$id}" type="text" name="language_data[name]" value="{$lang_data.name}" maxlength="64">
                </div>
            </div>

            <div class="control-group">
                <label for="elm_lang_country_code_{$id}" class="control-label cm-required">{__("country")}:</label>
                <div class="controls">
                    <select id="elm_lang_country_code_{$id}" name="language_data[country_code]">
                        {foreach from=$countries item="country" key="code"}
                            <option {if $code == $lang_data.country_code}selected="selected"{/if} value="{$code}">{$country}</option>
                        {/foreach}
                    </select>
                </div>
            </div>


            {include file="common/select_status.tpl" obj=$lang_data display="radio" input_name="language_data[status]" hidden=true}

            {if !$id}
            <div class="control-group">
                <label for="elm_from_lang_code_{$id}" class="control-label cm-required">{__("clone_from")}:</label>
                <div class="controls">
                    <select name="language_data[from_lang_code]" id="elm_from_lang_code_{$id}">
                        {assign var="langiuages" value="true"|fn_get_simple_languages}
                        {foreach from=""|fn_get_translation_languages item="language"}
                            <option value="{$language.lang_code}">{$language.name}</option>
                        {/foreach}
                    </select>
                </div>
            </div>
            {/if}

        </fieldset>
    </div>
</div>

{if ""|fn_allow_save_object:"languages"}
    <div class="buttons-container">
        {include file="buttons/save_cancel.tpl" but_name="dispatch[languages.update]" cancel_action="close" save=$id}
    </div>
{/if}

</form>

<!--content_group{$id}--></div>