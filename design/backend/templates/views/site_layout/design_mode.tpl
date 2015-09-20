{capture name="mainbox"}

{assign var="extra_url" value=""}
{if "ULTIMATE"|fn_allowed_for}
    {if $runtime.company_id}
        {assign var="extra_url" value="&switch_company_id=`$runtime.company_id`"}
    {else}
        {assign var="hide_front_url" value=true}
    {/if}
{/if}

<div class="section-border design-mode">
    {assign var="customization_enabled" value=0}
    {foreach from=$customization_modes key="mode" item="mode_data"}
    <form action="{""|fn_url}" method="post" name="customization_mode_form" class="form-horizontal">
    <div class="control-group">
        <label class="control-label" for="product_list_price">{__($mode_data.title)}:</label>
        <div class="controls">
            {if $mode_data.enabled}
                {assign var="customization_enabled" value=1}
                <input type="hidden" name="customization_modes[{$mode}]" value="disable">
                {include file="buttons/button.tpl" but_name="dispatch[site_layout.update_customization_mode]" but_role="button_main" but_text=__("disable")}
            {else}
                <input type="hidden" name="customization_modes[{$mode}]" value="enable">
                {include file="buttons/button.tpl" but_name="dispatch[site_layout.update_customization_mode]" but_role="button_main" but_text=__("enable")}
            {/if}
        </div>
    </div>
    </form>
    {/foreach}

    {if $customization_enabled && !$hide_front_url}
    <p>
        <a href="{"profiles.act_as_user?user_id=`$auth.user_id`&area=C`$extra_url`"|fn_url}" target="_blank">{__("view_storefront_customization_mode")}</a>
    </p>
    {/if}
</div>
{/capture}
{include file="common/mainbox.tpl" title=__("design_mode") content=$smarty.capture.mainbox}
