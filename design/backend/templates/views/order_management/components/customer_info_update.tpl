{include file="views/profiles/components/profiles_scripts.tpl"}

<div id="customer_info" title="{__("customer_info")}">
<form action="{""|fn_url}" method="post" class="form-horizontal form-edit cm-ajax cm-form-dialog-closer" name="om_customer_info_form">

<input type="hidden" name="result_ids" value="customer_info,{$result_ids}" />

{if $customer_auth.user_id && $settings.General.user_multiple_profiles == "Y"} {* Select user profile *}
    <div class="control-group">
        <label class="control-label" for="profile_id">{__("select_profile")}</label>
        <div class="controls">
            <select name="profile_id" id="profile_id" onchange="Tygh.$.redirect('{"order_management.customer_info?profile_id="|fn_url}'+this.value);" class="select-expanded">
                {foreach from=$user_profiles item="user_profile"}
                    <option value="{$user_profile.profile_id}" {if $cart.profile_id == $user_profile.profile_id}selected="selected"{/if}>{$user_profile.profile_name}</option>
                {/foreach}
            </select>
        </div>
    </div>
{/if}

<div id="profile_fields_c">
{include file="views/profiles/components/profile_fields.tpl" user_data=$cart.user_data section="C" title=__("contact_information")}
</div>
<div id="profile_fields_b">
{include file="views/profiles/components/profile_fields.tpl" user_data=$cart.user_data section="B" title=__("billing_address")}
</div>
<div id="profile_fields_s">
{include file="views/profiles/components/profile_fields.tpl" user_data=$cart.user_data section="S" title=__("shipping_address") body_id="sa" shipping_flag=$profile_fields|fn_compare_shipping_billing ship_to_another=$cart.ship_to_another}
</div>

{if !$customer_auth.user_id && $settings.General.disable_anonymous_checkout == "Y"}
    {include file="views/profiles/components/profiles_account.tpl" redirect_denied=true}
{/if}


{hook name="order_management:customer_info_buttons"}
<div class="buttons-container">
    <a class="cm-dialog-closer cm-cancel tool-link btn">{__("cancel")}</a>
    {include file="pickers/users/picker.tpl" extra_var="order_management.select_customer?page=`$smarty.request.page`" display="radio" but_text=__("choose_user") no_container=true but_meta="btn btn-primary" shared_force=$users_shared_force}
    {include file="buttons/button.tpl" but_text=__("update") but_meta="" but_name="dispatch[order_management.customer_info]" but_role="button_main"}
</div>
{/hook}

</form>
<!--customer_info--></div>