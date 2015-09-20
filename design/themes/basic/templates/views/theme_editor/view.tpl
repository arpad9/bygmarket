<div id="theme_editor">
{style src="theme_editor.css"}

<script type="text/javascript">
//<![CDATA[
Tygh.tr({
    'theme_editor.preset_name': '{__("theme_editor.preset_name")|escape:"javascript"}',
    'theme_editor.text_close_editor': '{__("theme_editor.text_close_editor")|escape:"javascript"}',
    'theme_editor.text_close_editor_unsaved': '{__("theme_editor.text_close_editor_unsaved")|escape:"javascript"}',
    'theme_editor.text_reset_changes': '{__("theme_editor.text_reset_changes")|escape:"javascript"}'
});
//]]>
</script>

<form action="{""|fn_url}" method="post" class="cm-ajax" name="theme_editor_form" enctype="multipart/form-data">
<input type="hidden" name="preset_id" value="{$current_preset.preset_id}" data-ca-is-default="{$current_preset.is_default}">
<input type="hidden" name="preset[name]" value="{$current_preset.name}">
<input type="hidden" name="selected_section" value="{$selected_section}">
<input type="hidden" name="result_ids" value="theme_editor">

<span class="te-nav"><a id="sw_theme_editor_container" class="te-minimize cm-combination cm-combo-on" title="{__("theme_editor.hide_show")}">
        <i class="icon-left-open"></i><i class="icon-right-open"></i>
    </a>
<a href="{"theme_editor.close"|fn_url}" class="te-close cm-te-close-editor" title="{__("theme_editor.close")}"><i class="icon-cancel"></i></a>
        </span>
</span>

<div class="theme-editor" id="theme_editor_container">
    <div class="te-header{if !$props_schema} te-header-no-schema{/if}" id="te_presets_list">
        {if $layouts|count == 1}
            <a class="te-layout-name"><span class="te-layout-label">{__("layout")}: </span><span class="te-layout-title te-layout-nolink">{$layout_data.name}</span></a>
        {else}
            <a id="sw_te-layouts" class="te-layout-name cm-combination"><span class="te-layout-label">{__("layout")}: </span><span class="te-layout-title">{$layout_data.name}</span></a>
            <ul id="te-layouts" class="te-layout-dropdown">
                {foreach $layouts as $layout}
                    <li><a class="cm-te-change-layout" data-ca-layout-id="{$layout.layout_id}" href="{$theme_url|fn_link_attach:"s_layout=`$layout.layout_id`"}">{$layout.name}</a></li>
                {/foreach}
            </ul>
        {/if}
        <span class="te-title">
            {__("theme_editor")}
        </span>

        {if $props_schema}
        <span class="te-subtitle">{__("theme_editor.presets")}</span>
        <div class="te-header-menu-wrap">
            <div class="te-header-menu-wrap-left">
                <div class="te-select-box cm-te-selectbox te-theme" tabindex="0"><span class="cm-preset-title">{$current_preset.name|default:"--"}</span><i class="icon-d-arrow"></i>
                <ul class="te-select-dropdown">
                    {foreach from=$presets_list item="s_item"}
                        <li class="{if $runtime.layout.preset_id == $s_item.preset_id}active{/if}">
                            <a class="cm-te-load-preset {if $runtime.layout.preset_id == $s_item.preset_id}active{/if}" data-ca-target-id="theme_editor" href="{"theme_editor.view?preset_id=`$s_item.preset_id`"|fn_url}" data-ca-preset-id="{$s_item.preset_id}">{$s_item.name}</a>
                            
                            <a class="icon-wrap-duplicate cm-te-duplicate-preset" data-ca-preset-id="{$s_item.preset_id}"><i class="icon-docs" title="{__("clone")}"></i></a>

                            {if !$s_item.is_default && $runtime.layout.preset_id != $s_item.preset_id}
                                <a class="icon-wrap-remove cm-ajax cm-confirm" data-ca-target-id="te_presets_list" href="{"theme_editor.delete_preset?preset_id=`$s_item.preset_id`"|fn_url}"><i class="icon-trashcan" title="{__("delete")}"></i></a>
                            {/if}
                        </li>
                    {foreachelse}
                        <li class="active">
                            <a class="cm-te-load-preset active">--</a>
                        </li>
                    {/foreach}
                </ul>
                </div>
            </div>
            <div class="te-header-menu-wrap-right">
                <button class="te-btn-action float-right" type="submit" name="dispatch[theme_editor.save]">{__("save")}</button>
            </div>
        </div>
        {/if}

        {if $te_sections}
            <span class="te-subtitle">{__("theme_editor.customize")}</span>
            <div class="te-select-box cm-te-selectbox te-customize" tabindex="0">
                <span>{__($te_sections.$selected_section)}</span><i class="icon-d-arrow"></i>
                <ul class="te-select-dropdown cm-te-sections">
                    {foreach from=$te_sections key="section" item="s"}
                    <li {if $selected_section == $section}class="active"{/if} data-ca-target-id="{$section}">{__($s)}</li>
                    {/foreach}
                </ul>
            </div>
        {/if}
        {if !$props_schema}
            <div class="te-no-schema">
                <button class="te-btn-action float-right" type="submit" name="dispatch[theme_editor.save]">{__("save")}</button>
            </div>
        {/if}
    <!--te_presets_list--></div>
<div class="te-content{if !$props_schema} te-content-no-schema{/if}">
<div class="te-section">



     <div class="te-wrap te-general cm-te-section {if $selected_section != "te_general"}hidden{/if}" id="te_general">

        <div class="te-inner-wrap">

            <div class="te-general-group">

                {if $cse_logos && $cse_logos.favicon}
                    {assign var="id" value=$cse_logos.favicon.logo_id}
                    {assign var="image" value=$cse_logos.favicon.image}
                {else}
                    {assign var="id" value=0}
                    {assign var="image" value=[]}
                {/if}


                <input type="text" class="hidden" name="logotypes_image_data[{$id}][type]" value="M">
                <input type="text" class="hidden" name="logotypes_image_data[{$id}][object_id]" value="{$id}">

                <div class="te-image te-favicon-wrap clearfix">
                    <span class="te-bg-title">{__("theme_editor.favicon")}&nbsp;<i class="icon-help-circle cm-tooltip" title="{__("theme_editor.favicon_size")}"></i></span>{include file="views/theme_editor/components/fileuploader.tpl" var_name="logotypes_image_icon[`$id`]"}
                    <div class="te-favicon cm-te-logo" data-ca-image-area="favicon" style="background-image: url('{$image.image_path}'); background-repeat: no-repeat; background-position: center center;"></div>
                </div>

            </div>

            {foreach from=$props_schema.general.fields key="name" item="field"}

            {if $field.type == "checkbox"}
            <div class="te-general-group">
                <div class="te-checkbox clearfix">
                    <label for="elm_toggle_general_{$name}">
                        <input type="hidden" name="preset[data][general][{$name}]" value="0" class="cm-te-value-changer" />
                        <input type="checkbox" name="preset[data][general][{$name}]" class="cm-te-value-changer" id="elm_toggle_general_{$name}" value="1" {if $current_preset.data.general.$name}checked="checked"{/if}><span class="te-toggle"><span class="te-toggle-on">{__("theme_editor.on")}</span><span class="te-toggle-off">{__("theme_editor.off")}</span><span class="te-toggle-trigger"></span></span><span class="te-bg-title">{__($field.description)}</span></label>
                </div>
            </div>            
            {/if}

            {/foreach}
        </div>

        <div class="te-reset-wrap"><button class="te-btn cm-te-reset">{__("theme_editor.reset_general")}</button></div>
    <!--te_general--></div>




    <div class="te-wrap te-logos cm-te-section {if $selected_section != "te_logos"}hidden{/if}" id="te_logos">

        <div class="te-tabs cm-te-tabs">
            <ul class="te-pills">
                {foreach from=$cse_logo_types key="type" item="logo"}
                {if $type == "favicon"}
                    {continue}
                {/if}                
                <li {if $type == "theme"}class="active"{/if}><a data-ca-target-id="elm_logo_section_{$type}" title="{__("theme_editor.`$type`")}"><span>{__("theme_editor.`$type`")}</span></a></li>
                {/foreach}
            </ul>

            {foreach from=$cse_logo_types key="type" item="logo"}
                {if $type == "favicon"}
                    {continue}
                {/if}

                {if $cse_logos && $cse_logos.$type}
                    {assign var="id" value=$cse_logos.$type.logo_id}
                    {assign var="image" value=$cse_logos.$type.image}
                {else}
                    {assign var="id" value=0}
                    {assign var="image" value=[]}
                {/if}

                <div class="{if $type != "theme"}hidden{/if} cm-te-tab-contents" id="elm_logo_section_{$type}">
                    <input type="text" class="hidden" name="logotypes_image_data[{$id}][type]" value="M">
                    <input type="text" class="hidden" name="logotypes_image_data[{$id}][object_id]" value="{$id}">
                    <div class="attach-images">
                        <div class="upload-box clearfix">
                            <div class="image-wrap pull-left">
                                <div class="te-image">
                                    <div class="te-bg-image cm-te-logo" data-ca-image-area="{$type}" style="background-image: url('{$image.image_path}'); background-repeat: no-repeat; background-position: center center;"></div>
                                </div>
                                <div class="logo-alt"><span class="left-add cm-tooltip" title="{__("alt_text")}"><i class="icon-bubble"></i></span><input type="text" class="cm-image-field" id="alt_text_{$a}" name="logotypes_image_data[{$id}][image_alt]" value="{$image.alt}" placeholder="{__("alt_text")}"></div>
                            </div>

                            {hook name="theme_editor:logo_uploader"}
                            <div class="te-logos-upload clearfix">
                                <span class="te-bg-title">{__("image")}&nbsp;</span>                                                        
                                {include file="views/theme_editor/components/fileuploader.tpl" var_name="logotypes_image_icon[`$id`]"}
                            </div>
                            {/hook}
                        </div>
                    </div>
                </div>
            {/foreach}
        </div>

        {*
        <div class="te-reset-wrap"><button class="te-btn cm-te-reset">{__("theme_editor.reset_logos")}</button></div>
        *}
    <!--te_logos--></div>

    <div class="te-wrap te-colors cm-te-section {if $selected_section != "te_colors"}hidden{/if}" id="te_colors">

        {foreach from=$props_schema.colors.fields key="name" item="field"}
        <div class="te-colors clearfix">
            <label for="elm_te_{$name}">{__($field.description)}</label>
            {$cp_value = "#ffffff"}
            {if $current_preset.data.colors.$name}
                {$cp_value = $current_preset.data.colors.$name}
            {elseif $name == "color_2"}
                {$cp_value = "#000000"}
            {/if}

            {include file="common/colorpicker.tpl" cp_name="preset[data][colors][`$name`]" cp_id="storage_elm_te_`$name`" cp_value=$cp_value cp_class="cm-te-value-changer" cp_storage="theme_editor"}
        </div>
        {/foreach}

        {*
        <a id="sw_te_color_generator" class="cm-combo-on cm-combination">{__("theme_editor.color_gen_title")}:</a>
        <div class="te-color-generator hidden" id="te_color_generator" data-ca-te-color-generator="{$props_schema.colors.color_generator_data|json_encode}">
            <div class="control-group">
                <label for="elm_te_color_generator_color">{__("theme_editor.color_gen_base_color")}:</label>
                {include file="common/colorpicker.tpl" cp_name="elm_te_color_generator_color" cp_id="storage_elm_te_color_generator_color" cp_value="#ffffff" cp_class="te-color-generate" cp_storage="theme_editor"}
            </div>
            <div class="control-group">
                <label for="elm_te_color_generator_algorithm">{__("theme_editor.color_gen_algorithm")}:</label>
                <select id="elm_te_color_generator_algorithm" class="select cm-te-value-changer">
                    {foreach from=$props_schema.colors.color_generator_data.algorithms key="name" item="data"}
                        {assign var="lanvar_name" value="color_gen_`$name`"}
                        <option value="{$name}">{__($lanvar_name)}</option>
                    {/foreach}
                </select>
            </div>
            <div class="control-group">
                <label for="elm_te_color_generator_variant">{__("theme_editor.color_gen_variant")}:</label>
                <select id="elm_te_color_generator_variant" class="select cm-te-value-changer">
                    {foreach from=$props_schema.colors.color_generator_data.variants key="name" item="data"}
                        {assign var="lanvar_name" value="color_gen_`$name`"}
                        <option value="{$name}">{__($lanvar_name)}</option>
                    {/foreach}
                </select>
            </div>
        </div>
        *}

        <div class="te-reset-wrap"><button class="te-btn cm-te-reset">{__("theme_editor.reset_colors")}</button></div>

    <!--te_colors--></div>

    <div class="te-wrap te-fonts cm-te-section {if $selected_section != "te_fonts"}hidden{/if}" id="te_fonts">
        <div class="te-inner-wrap">
            {foreach from=$props_schema.fonts.fields key="name" item="field"}
            <div class="control-group te-font-group">
                <label for="elm_te_{$name}">{__($field.description)}</label>
                
                <div class="te-select-box cm-te-selectbox cm-te-value-changer" tabindex="0"><span>{if $current_preset.data.fonts.$name.family}{$props_schema.fonts.families[$current_preset.data.fonts.$name.family]}{else}Arial{/if}</span><i class="icon-d-arrow"></i>
                    <input type="text" class="hidden cm-te-selectbox-storage" name="preset[data][fonts][{$name}][family]" value="{if $current_preset.data.fonts.$name.family}{$current_preset.data.fonts.$name.family}{else}Arial,Helvetica,sans-serif{/if}">
                    <ul class="te-select-dropdown">
                        {foreach from=$props_schema.fonts.families key="family" item="family_name"}
                        <li data-ca-select-box-value="{$family}" {if $current_preset.data.fonts.$name.family == $family}class="active"{/if} style="font-family: {$family}">{$family_name}</li>
                        {/foreach}
                    </ul>
                </div>
                
                {if $field.properties.size}
                <div class="te-select-box te-font-size cm-te-selectbox cm-te-value-changer" tabindex="0"><span>{$current_preset.data.fonts.$name.size}</span><i class="icon-d-arrow"></i>
                    <input type="text" class="hidden cm-te-selectbox-storage" name="preset[data][fonts][{$name}][size]" value="{$current_preset.data.fonts.$name.size}">
                    <ul class="te-select-dropdown">
                        {foreach from=$field.properties.size.values item="font_size"}
                        <li data-ca-select-box-value="{$font_size}" {if $current_preset.data.fonts.$name.size == $font_size}class="active"{/if}>{$font_size}</li>
                        {/foreach}
                    </ul>
                </div>
                {/if}
        
                {if $field.properties.style}
                {foreach from=$field.properties.style key="key" item="prop"}            
                <div class="te-font-style-wrap">
                    <input class="cm-te-value-changer te-font-style-checkbox" type="checkbox" id="font_style_{$name}_{$key}" name="preset[data][fonts][{$name}][style][{$key}]" value="1" {if $current_preset.data.fonts.$name.style.$key}checked="checked"{/if} /><label for="font_style_{$name}_{$key}" class="te-font-style {$prop.property}">{$key}</label>
                </div>
                {/foreach}
                {/if}
            </div>
            {/foreach}
        </div>

    <div class="te-reset-wrap"><button class="te-btn cm-te-reset">{__("theme_editor.reset_fonts")}</button></div>

    <!--te_fonts--></div>

    <div class="te-wrap te-bg cm-te-section {if $selected_section != "te_backgrounds"}hidden{/if}" id="te_backgrounds">

        <div class="te-inner-wrap">
            {foreach from=$props_schema.backgrounds.fields key="name" item="field"}
            <div class="control-group te-bg-group">
                <label for="elm_te_{$name}">{__($field.description)}</label>
            
                <div>
                    {if $field.properties.color}
                        <div class="te-color-picker-container te-colors clearfix">
                            <span class="te-bg-title">{__("theme_editor.background_color")}&nbsp;</span>

                            {if $field.gradient || $field.transparent || $field.full_width}
                            <a id="sw_backgrounds_adv_color_{$name}" class="cm-combination te-advanced-options"><i class="icon-cog"></i></a>
                            {/if}
                            
                            {include file="common/colorpicker.tpl" cp_name="preset[data][backgrounds][`$name`][color]" cp_id="storage_elm_te_`$name`" cp_value=$current_preset.data.backgrounds.$name.color|default:"#ffffff" cp_class="cm-te-value-changer" cp_storage="theme_editor"}
                        </div>
                    {/if}
                    
                    {if $field.gradient || $field.transparent || $field.full_width}
                    <div id="backgrounds_adv_color_{$name}" class="te-bg-advanced hidden clearfix">
                            <div class="te-advanced-connector"></div>

                        {if $field.gradient}
                        <div class="te-gradient-color clearfix">
                            <span class="te-bg-title">{__("theme_editor.gradient")}&nbsp;</span>            
                            {include file="common/colorpicker.tpl" cp_name="preset[data][backgrounds][`$name`][gradient]" cp_id="storage_elm_te_`$name`_gradient" cp_value=$current_preset.data.backgrounds.$name.gradient|default:"#ffffff" cp_class="cm-te-value-changer" cp_storage="theme_editor"}
                        </div>
                        {/if}

                        {if $field.full_width}
                        <div class="te-fullwidth te-checkbox clearfix">
                            <label for="elm_toggle_full_width_{$name}"><input type="checkbox" name="preset[data][backgrounds][{$name}][full_width]" class="cm-te-value-changer" id="elm_toggle_full_width_{$name}" value="1" {if $current_preset.data.backgrounds.$name.full_width}checked="checked"{/if}><span class="te-toggle"><span class="te-toggle-on">{__("theme_editor.on")}</span><span class="te-toggle-off">{__("theme_editor.off")}</span><span class="te-toggle-trigger"></span></span><span class="te-bg-title">{__("theme_editor.full_width")}</span></label>
                        </div>
                        {/if}

                        {if $field.transparent}
                        <div class="te-transparent te-checkbox clearfix">
                            <label for="elm_toggle_transparent_{$name}"><input type="checkbox" name="preset[data][backgrounds][{$name}][transparent]" class="cm-te-value-changer" id="elm_toggle_transparent_{$name}" value="1" {if $current_preset.data.backgrounds.$name.transparent}checked="checked"{/if}><span class="te-toggle"><span class="te-toggle-on">{__("theme_editor.on")}</span><span class="te-toggle-off">{__("theme_editor.off")}</span><span class="te-toggle-trigger"></span></span><span class="te-bg-title">{__("theme_editor.transparent")}</span></label>
                        </div>
                        {/if}
                    </div>
                    {/if}
                    
                    {if $field.properties.image}
                    <div class="te-bg-image-group te-colors clearfix" id="te_uploaded_images_{$name}">

                        <input type="text" class="hidden cm-te-skip-css" name="preset[data][backgrounds][{$name}][image_data]" value="{if $current_preset.data.backgrounds.$name.image_data}{$current_preset.data.backgrounds.$name.image_data}{/if}">
                        <input type="text" class="hidden cm-te-skip-css" name="preset[data][backgrounds][{$name}][image_name]" value="{if $current_preset.data.backgrounds.$name.image_name}{$current_preset.data.backgrounds.$name.image_name}{/if}">

                        <span class="te-bg-title">{__("image")}&nbsp;<i class="icon-help-circle cm-tooltip" title="{__("theme_editor.max_image_size")}"></i></span>
                        <a id="sw_backgrounds_adv_image_{$name}" class="cm-combination te-advanced-options"><i class="icon-cog"></i></a>

                        {if $current_preset.data.backgrounds.$name.image_data}
                            <div class="te-fileuploader clearfix">
                                <div class="upload-file-section">
                                    <p class="cm-fu-file">
                                    
                                    <a href="{"theme_editor.delete_image_data?image_name=`$name`&preset_id=`$current_preset.preset_id`"|fn_url}" data-ca-event="ce.formajaxpost_theme_editor_form" data-ca-target-id="te_uploaded_images_{$name}" class="cm-ajax cm-confirm delete-thumb"><i class="icon-trashcan" title="{__("delete")}">&nbsp;</i></a>
                                    
                                    <span class="filename-link">&nbsp;{$current_preset.data.backgrounds.$name.image_name}</span></p>

                                </div>
                            </div>

                        {else}
                            {include file="views/theme_editor/components/fileuploader.tpl" var_name="backgrounds[$name]"}
                        {/if}
            
                    <!--te_uploaded_images_{$name}--></div>
                    {/if}
            
                    <div id="backgrounds_adv_image_{$name}" class="te-bg-advanced hidden">{if $field.properties.position}
                            <div class="te-advanced-connector"></div>
                            <div class="te-bg-position clearfix">
                            <span class="te-bg-title">{__("theme_editor.position")}&nbsp;</span>
                                <div class="sse-bg-position-main-wrap clearfix">
                                    <div class="te-bg-position-wrap clearfix">
                                        {strip}
                                            <div class="te-bg-position-item">
                                                <input class="cm-te-value-changer" type="radio" id="top_left" name="preset[data][backgrounds][{$name}][position]" value="top left" {if $current_preset.data.backgrounds.$name.position == "top left"}checked="checked"{/if} />
                                                <label for="top_left"><i class="icon-arrow-up-left"></i></label>
                                            </div>
                                            <div class="te-bg-position-item"><input class="cm-te-value-changer" type="radio" id="top_center" name="preset[data][backgrounds][{$name}][position]" value="top center" {if $current_preset.data.backgrounds.$name.position == "top center"}checked="checked"{/if} />
                                            <label for="top_center"><i class="icon-arrow-up"></i></label></div>
                                            <div class="te-bg-position-item"><input class="cm-te-value-changer" type="radio" id="top_right" name="preset[data][backgrounds][{$name}][position]" value="top right" {if $current_preset.data.backgrounds.$name.position == "top right"}checked="checked"{/if} />
                                            <label for="top_right"><i class="icon-arrow-up-right"></i></label></div>
                                        {/strip}
                                    </div>
                                    <div class="te-bg-position-wrap clearfix">
                                        {strip}
                                            <div class="te-bg-position-item">
                                                <input class="cm-te-value-changer" type="radio" id="center_left" name="preset[data][backgrounds][{$name}][position]" if="center_left" value="center left" {if $current_preset.data.backgrounds.$name.position == "center left"}checked="checked"{/if} />
                                                <label for="center_left"><i class="icon-arrow-left"></i></label>
                                            </div>
                                            <div class="te-bg-position-item">
                                                <input class="cm-te-value-changer" type="radio" id="center_center" name="preset[data][backgrounds][{$name}][position]" value="center center" {if $current_preset.data.backgrounds.$name.position == "center center"}checked="checked"{/if} />
                                                <label for="center_center"><i class="icon-square"></i></label>
                                            </div>
                                            <div class="te-bg-position-item">
                                                <input class="cm-te-value-changer" type="radio" id="center_right" name="preset[data][backgrounds][{$name}][position]" value="center right" {if $current_preset.data.backgrounds.$name.position == "center right"}checked="checked"{/if} />
                                                <label for="center_right"><i class="icon-arrow-right"></i></label>
                                            </div>
                                        {/strip}
                                    </div>
                                    <div class="te-bg-position-wrap clearfix">
                                        {strip}
                                            <div class="te-bg-position-item">
                                                <input class="cm-te-value-changer" type="radio" id="bottom_left" name="preset[data][backgrounds][{$name}][position]" value="bottom left" {if $current_preset.data.backgrounds.$name.position == "bottom left"}checked="checked"{/if} />
                                                <label for="bottom_left"><i class="icon-arrow-down-left"></i></label>
                                            </div>
                                            <div class="te-bg-position-item">
                                                <input class="cm-te-value-changer" type="radio" id="bottom_center" name="preset[data][backgrounds][{$name}][position]" value="bottom center" {if $current_preset.data.backgrounds.$name.position == "bottom center"}checked="checked"{/if} />
                                                <label for="bottom_center"><i class="icon-arrow-down"></i></label>
                                            </div>
                                            <div class="te-bg-position-item">
                                                <input class="cm-te-value-changer" type="radio" id="bottom_right" name="preset[data][backgrounds][{$name}][position]" value="bottom right" {if $current_preset.data.backgrounds.$name.position == "bottom right"}checked="checked"{/if} />
                                                <label for="bottom_right"><i class="icon-arrow-down-right"></i></label>
                                            </div>
                                        {/strip}
                                    </div>
                                </div>
                            </div>
                        {/if}
                        
                        {if $field.properties.repeat}
                        <div>
                            <div class="te-select-box cm-te-selectbox cm-te-value-changer" tabindex="0"><span>{__("theme_editor.repeat")}</span><i class="icon-d-arrow"></i>
                                <input type="text" class="hidden" name="preset[data][backgrounds][{$name}][repeat]" value="{$current_preset.data.backgrounds.$name.repeat|default:"repeat"}">
                                <ul class="te-select-dropdown">
                                    <li data-ca-select-box-value="repeat" {if $current_preset.data.backgrounds.$name.repeat == "repeat"}class="active"{/if}>{__("theme_editor.repeat")}</li>
                                    <li data-ca-select-box-value="repeat-x" {if $current_preset.data.backgrounds.$name.repeat == "repeat-x"}class="active"{/if}>{__("theme_editor.repeat_x")}</li>
                                    <li data-ca-select-box-value="repeat-y" {if $current_preset.data.backgrounds.$name.repeat == "repeat-y"}class="active"{/if}>{__("theme_editor.repeat_y")}</li>
                                    <li data-ca-select-box-value="no-repeat" {if $current_preset.data.backgrounds.$name.repeat == "no-repeat"}class="active"{/if}>{__("theme_editor.no_repeat")}</li>
                                </ul>
                            </div>
                        </div>
                        {/if}
                        
                        {if $field.properties.attachment}
                        <div>
                            <div class="te-select-box cm-te-selectbox cm-te-value-changer" tabindex="0"><span>{__("theme_editor.scroll")}</span><i class="icon-d-arrow"></i>
                                <input type="text" class="hidden" name="preset[data][backgrounds][{$name}][attachment]" value="{$current_preset.data.backgrounds.$name.attachment|default:"scroll"}">
                                <ul class="te-select-dropdown">
                                    <li data-ca-select-box-value="scroll" {if $current_preset.data.backgrounds.$name.attachment == "scroll"}class="active"{/if}>{__("theme_editor.scroll")}</li>
                                    <li data-ca-select-box-value="fixed" {if $current_preset.data.backgrounds.$name.attachment == "fixed"}class="active"{/if}>{__("theme_editor.fixed")}</li>
                                </ul>
                            </div>
                        </div>
                        {/if}
                    </div>
            
                </div>
            </div>
            {/foreach}
        </div>

        <div class="te-reset-wrap"><button class="te-btn cm-te-reset">{__("theme_editor.reset_backgrounds")}</button></div>

    <!--te_backgrounds--></div>

</div>
</div>


</div>

</form>
<!--theme_editor--></div>