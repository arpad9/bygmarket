{if ($company_name || $company_id) && "MULTIVENDOR"|fn_allowed_for}
    <div class="control-group{if !$capture_options_vs_qty} product-list-field{/if}">
        <label>{__("vendor")}:</label>
        <span><a href="{"companies.view?company_id=`$company_id`"|fn_url}">{if $company_name}{$company_name}{else}{$company_id|fn_get_company_name}{/if}</a></span>
    </div>
{/if}
