{script src="js/tygh/tabs.js"}

{if $loc.store_location_id}
    {assign var="id" value=$loc.store_location_id}
{else}
    {assign var="id" value="0"}
{/if}

<div id="content_group{$id}">
<form action="{""|fn_url}" method="post" class=" form-horizontal" name="store_locations_form{$suffix}">
<input type="hidden" name="store_location_id" value="{$id}" />

<div class="tabs cm-j-tabs">
    <ul class="nav nav-tabs">
        <li id="tab_general_{$id}" class="cm-js cm-active"><a>{__("general")}</a></li>
    </ul>
</div>

<div class="cm-tabs-content">
<fieldset>
    <div class="control-group">
        <label for="name_{$id}" class="cm-required control-label">{__("name")}:</label>
        <div class="controls">
            <input type="text" id="name_{$id}" name="store_location_data[name]" value="{$loc.name}">
        </div>
    </div>


    <div class="control-group">
        <label class="control-label" for="position_{$id}">{__("position")}:</label>
        <div class="controls">
            <input type="text" name="store_location_data[position]" id="position_{$id}" value="{$loc.position}" size="3">
        </div>
    </div>

    <div class="control-group">
        <label class="control-label" for="description_{$id}">{__("description")}:</label>
        <div class="controls">
            <textarea id="description_{$id}" name="store_location_data[description]" cols="55" rows="2" class="cm-wysiwyg input-textarea-long">{$loc.description}</textarea>
        </div>
        
    </div>

    <div class="control-group">
        <label class="control-label" for="country_{$id}">{__("country")}:</label>
        <div class="controls">
            {assign var="countries" value=1|fn_get_simple_countries:$smarty.const.CART_LANGUAGE}
            <select id="country_{$id}" name="store_location_data[country]" class="select">
                <option value="">- {__("select_country")} -</option>
                {foreach from=$countries item="country" key="code"}
                <option {if $loc.country == $code}selected="selected"{/if} value="{$code}">{$country}</option>
                {/foreach}
            </select>
        </div>
    </div>

    <div class="control-group">
        <label class="control-label" for="city_{$id}">{__("city")}:</label>
        <div class="controls">
            <input type="text" name="store_location_data[city]" id="city_{$id}" value="{$loc.city}">
        </div>
    </div>

    <div class="control-group">
        <label class="control-label" for="latitude_{$id}">{__("coordinates")} ({__("latitude_short")} &times; {__("longitude_short")}):</label>
        <div class="controls">
            <input type="text" name="store_location_data[latitude]" id="latitude_{$id}" value="{$loc.latitude}" class="input-small">
            &times;
            <input type="text" name="store_location_data[longitude]" id="longitude_{$id}" value="{$loc.longitude}" class="input-small">
            
            {include file="buttons/button.tpl" but_text=__("select") but_onclick="fn_init_map('country_`$id`', 'city_`$id`', 'latitude_`$id`', 'longitude_`$id`');" but_type="button"}
        </div>
    </div>

    {include file="views/localizations/components/select.tpl" data_from=$loc.localization data_name="store_location_data[localization]"}
</fieldset>
</div>

<div class="buttons-container">
    {include file="buttons/save_cancel.tpl" but_name="dispatch[store_locator.update]" cancel_action="close" save=$id}
</div>
    
</form>

<!--content_group{$id}--></div>
