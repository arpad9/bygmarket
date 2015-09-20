{assign var="c_url" value=$config.current_url|fn_url}
{assign var="area" value=$smarty.const.AREA}

<ul class="demo-site-panel clearfix">
    <li class="dp-title">{__("demo_site_panel")}</li>
    
    {* Uncomment it when additional themes will be available
    <li class="dp-label">{__("text_frontend_theme")}:</li>
    <li>
        <select name="demo_theme" onchange="Tygh.$.redirect('{$c_url|fn_link_attach:"demo_theme="}' + this.value);">
        {foreach from=$demo_theme.available_themes item=s key=k}
            <option value="{$k}" {if $settings.theme_name == $k}selected="selected"{/if}>{$s.description}</option>
        {/foreach}
        </select>
    </li>
    *}

    {if !$runtime.customization_mode.theme_editor}
        <li class="dp-label">{__("customization_mode")}:</li>
        <li>
            {include file="buttons/button.tpl" but_text=__("enable") but_href=$c_url|fn_link_attach:"demo_customize_theme=Y"}
        </li>
    {/if}

    {if "ULTIMATE"|fn_allowed_for}    
        <li class="dp-area">
            <select name="area" onchange="Tygh.$.redirect(this.value);">
                <option value="{$config.admin_index}" {if $area == "A"}selected="selected"{/if}>{__("admin_panel")}</option>

                {foreach from=$demo_theme.storefronts item=company}
                    <option value="http://{$company.storefront}" {if $runtime.company_id == $company.company_id}selected="selected"{/if}>{$company.company}</option>
                {/foreach}
            </select>
        </li>
        <li class="dp-area dp-label">{__("storefront")}:</li>
    {else}
        <li class="dp-area">
            <select name="area" onchange="Tygh.$.redirect(this.value);">
                <option value="{$config.admin_index}" {if $area == "A"}selected="selected"{/if}>{__("admin_panel")}</option>
                <option value="{$config.vendor_index}" {if $area == "C"}selected="selected"{/if}>{__("vendor_panel")}</option>
                <option value="{$config.customer_index}" {if $area == "C"}selected="selected"{/if}>{__("storefront")}</option>
            </select>
        </li>
        <li class="dp-area dp-label">{__("area")}:</li>
    {/if}

</ul>
