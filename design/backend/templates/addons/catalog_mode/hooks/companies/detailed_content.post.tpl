{if $auth.is_root == 'Y' && "MULTIVENDOR"|fn_allowed_for}
    {include file="common/subheader.tpl" title=__("catalog_mode") target="#catalog_mode_companies"}
    <div id="catalog_mode_companies" class="in collapse">
    	<fieldset>
    	<div class="control-group">
    	    <label class="control-label" for="enable_catalog_mode">{__("enable_catalog_mode")}:</label>
    	    <div class="controls">
    	    	<input type="hidden" name="company_data[catalog_mode]" value="N">
    	    	<input id="enable_catalog_mode" type="checkbox" {if $company_data.catalog_mode == 'Y'}checked="checked" {/if} name="company_data[catalog_mode]" value="Y">
    	    </div>
    	</div>
    	</fieldset>
    </div>
{/if}