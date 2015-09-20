{if $capture}
{capture name="carrier_field"}
{/if}
<select {if $id}id="{$id}"{/if} name="{$name}" {if $meta}class="{$meta}"{/if}>
    <option value="">--</option>
    <option value="USP" {if $carrier == "USP"}{assign var="carrier_name" value=__("usps")}selected="selected"{/if}>{__("usps")}</option>
    <option value="UPS" {if $carrier == "UPS"}{assign var="carrier_name" value=__("ups")}selected="selected"{/if}>{__("ups")}</option>
    <option value="FDX" {if $carrier == "FDX"}{assign var="carrier_name" value=__("fedex")}selected="selected"{/if}>{__("fedex")}</option>
    <option value="AUP" {if $carrier == "AUP"}{assign var="carrier_name" value=__("australia_post")}selected="selected"{/if}>{__("australia_post")}</option>
    <option value="DHL" {if $carrier == "DHL" || $user_data.carrier == "ARB"}{assign var="carrier_name" value=__("dhl")}selected="selected"{/if}>{__("dhl")}</option>
    <option value="CHP" {if $carrier == "CHP"}{assign var="carrier_name" value=__("chp")}selected="selected"{/if}>{__("chp")}</option>
</select>
{if $capture}
{/capture}

{capture name="carrier_name"}
{$carrier_name}
{/capture}
{/if}