
<script>
$(document).ready(function(){
	$('.delete_registry').on('click',function(){
		var r = confirm('Are you sure want to delete this Registry');
		if (r==true)
		{
		  return true;
		}
		else
		{
		  return false;
		}
	});
});
</script>
<div class="registryRegistrationFormContainer">
	<div class="registryTitle">Holiday or Gift <span class="darkColor">Registry</span></div>
	{*<div class="registrationPageWelcome"><b>Hello, {$user_info.firstname} {$user_info.lastname}</b> Welcome to your Holiday or Gift Registry.</div>*}
	
	<div style="margin-top:15px;">
		<div class="registrationPageWelcome float-left" style="margin-top:10px;"><b>Hello, {$user_info.firstname} {$user_info.lastname}</b> Welcome to your Holiday or Gift Registry.</div>
		{if $registry_data['hgr_id']}
		<div class="float-right">
			<div class="float-left mr10">{include file="buttons/button.tpl" but_text="Manage Registry Products" but_href="hgregistry.update&registry_type_id=$registry_type_id" but_role="button" but_meta="modified"}</div>
			<div class="float-left">{include file="buttons/button.tpl" but_text="Delete Your Registry" but_href="hgregistry.delete_registry&hgr_id=$registry_type_id" but_role="button" but_meta="modified delete_registry"}</div>
		</div>
		{/if}
		<div class="clearfix"></div>
	</div>
	
	{*
	{if $registry_data['hgr_id']}
	<div class="buttons-container">
		<div class="float-left mr10">{include file="buttons/button.tpl" but_text="Manage Registry Products" but_href="hgregistry.update&registry_type_id=$registry_type_id" but_role="button" but_meta="modified"}</div>
		<div class="float-left">{include file="buttons/button.tpl" but_text="Delete Your Registry" but_href="hgregistry.delete_registry&hgr_id=$registry_type_id" but_role="button" but_meta="modified delete_registry"}</div>
	</div>
	{/if}
	*}
	
	<div class="regFormContainer">
		<form action="{""|fn_url}" method="post" name="hgregistry_form">
			<input type="hidden" name="registry_data[hgr_id]" value="{$registry_data.hgr_id}">
			<!-- About You and Your Partner Start -->
			<br>
			<div class="sectionContainer">
				<div class="sectionHeading">1. About You</div>
				<div class="sectionData">
					
					<div class="subSection float-left" style="border-right: 1px solid #ddd; margin-right: 25px;">
						<div class="subSectionHeading">About You</div>
						<div class="control-group">
							<label for="elm_yourfname" class="cm-required">First Name</label>
							<input type="text" id="elm_yourfname" class="input-text" size="70" name="registry_data[yourfname]" value="{$registry_data.yourfname}" />
						</div>
						<div class="control-group">
							<label for="elm_yourlname" class="cm-required">Last Name</label>
							<input type="text" id="elm_yourlname" class="input-text" size="70" name="registry_data[yourlname]" value="{$registry_data.yourlname}" />
						</div>
						<div class="control-group">
							<label for="elm_youremail" class="cm-required">Email</label>
							<input type="text" id="elm_youremail" class="input-text" size="70" name="registry_data[youremail]" value="{$registry_data.youremail}" />
						</div>
					</div>	
					
					<div class="subSection float-left">
						<div class="subSectionHeading">About Your Co-Registrant (optional)</div>
						<div class="control-group">
							<label for="elm_theirfname" class="">First Name</label>
							<input type="text" id="elm_theirfname" class="input-text" size="70" name="registry_data[theirfname]" value="{$registry_data.theirfname}" />
						</div>
						<div class="control-group">
							<label for="elm_theirlname" class="">Last Name</label>
							<input type="text" id="elm_theirlname" class="input-text" size="70" name="registry_data[theirlname]" value="{$registry_data.theirlname}" />
						</div>
						<div class="control-group">
							<label for="elm_theiremail" class="">Email</label>
							<input type="text" id="elm_theiremail" class="input-text" size="70" name="registry_data[theiremail]" value="{$registry_data.theiremail}" />
						</div>
					</div>
					
					<div class="clearfix"></div>			
				</div>
			</div>
			<!-- About You and Your Partner End -->
			
			<br>
			
			<!-- Permissions & Preferences Start -->
			<div class="sectionContainer">
				<div class="sectionHeading">2. Permissions & Preferences</div>
				<div class="sectionData">
					<!--
					<div class="control-group">
						<label for="elm_type" class="cm-required">{__("event_type")}</label>
						<select id="elm_type" name="event_data[type]">
							<option value="P" {if $registry_data.type == "P"}selected="selected"{/if}>{__("public")}</option>
							<option value="U" {if $registry_data.type == "U"}selected="selected"{/if}>{__("private")}</option>
						</select>
					</div>
					-->
					<div class="subSectionHeading">Privacy setting</div>
					<div class="control-group">
						<input type="radio" {if $registry_data.type == "P"}checked="checked"{/if} id="elm_public" value="P" name="registry_data[type]" class="radio float-left"><label for="elm_public" class="float-left" style="padding:0px;">Public - Anyone can search for and view this registry. </label>
					</div>
					<div class="control-group">
						<input type="radio" {if $registry_data.type == "U"}checked="checked"{/if} id="elm_private" value="U" name="registry_data[type]" class="radio float-left"><label for="elm_private" class="float-left" style="padding:0px;">Private - Only myself can view this registry. </label>
					</div>
					
				</div>
			</div>
			<!-- Permissions & Preferences End -->
			<br>
			<div class="buttons-container">
				{include file="buttons/save.tpl" but_name="dispatch[hgregistry.updateregistry]"}
			</div>
		</form>
	</div>
	
{*include file="pickers/products/picker.tpl" data_id="hgr_products" but_text=__("add_product") extra_var="hgregistry.add_products"*}

<br>
</div>
