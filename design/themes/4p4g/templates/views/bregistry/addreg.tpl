{*
<style>
.registryRegistrationFormContainer{ width: 70%; margin: 0 auto;}
.registrationPageTitle{ text-align: center; font-size: 40px; }
.sectionHeading{ background-color: #F3F3F3; border-bottom: 1px solid #DEDEDE; padding: 4px 0px; font-weight: bold;}

.subSection{ width: 49%;}
.ml10{ margin-left:10px;}
.mr10{ margin-right:10px;}
</style>
*}
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
	<div class="registryTitle">Birthday <span class="darkColor">Registry</span></div>
	{*<div class="registrationPageWelcome"><b>Hello, {$user_info.firstname} {$user_info.lastname}</b> Welcome to your Birthday Registry.</div>*}
	
	<div style="margin-top:15px;">
		<div class="registrationPageWelcome float-left" style="margin-top:10px;"><b>Hello, {$user_info.firstname} {$user_info.lastname}</b> Welcome to your Birthday Registry.</div>
		{*
		{if $registry_data['br_id']}
		<div class="float-right">
			<div class="float-left mr10">{include file="buttons/button.tpl" but_text="Manage Registry Products" but_href="bregistry.update&registry_type_id=$registry_type_id" but_role="button" but_meta="modified"}</div>
			<div class="float-left">{include file="buttons/button.tpl" but_text="Delete Your Registry" but_href="bregistry.delete_registry&br_id=$registry_type_id" but_role="button" but_meta="modified delete_registry"}</div>
		</div>
		{/if}
		*}
		<div class="clearfix"></div>
	</div>
	{*
	<div style="margin-top:5px;">
		<div class="float-right">{include file="buttons/button.tpl" but_text="Add New Birthday Registry" but_href="bregistry.delete_registry&br_id=$registry_type_id" but_role="button" but_meta="modified delete_registry"}</div>
		<div class="float-right mr10">{include file="buttons/button.tpl" but_text="Manage Other Registry" but_href="bregistry.update&registry_type_id=$registry_type_id" but_role="button" but_meta="modified"}</div>
		<div class="clearfix"></div>
	</div>
	*}
	<div style="margin-top:5px;">
		{if $registry_data['br_id']}
		<div class="float-left">
			<div class="float-left mr10">{include file="buttons/button.tpl" but_text="Manage Registry Products" but_href="bregistry.update&registry_type_id=$registry_type_id" but_role="button" but_meta="modified"}</div>
			<div class="float-left">{include file="buttons/button.tpl" but_text="Delete Your Registry" but_href="bregistry.delete_registry&br_id=$registry_type_id" but_role="button" but_meta="modified delete_registry"}</div>
			<div class="clearfix"></div>
		</div>
		{/if}
		
		<div class="float-right">
			{if $registry_data['br_id']}
			<div class="float-right">{include file="buttons/button.tpl" but_text="Add New Birthday Registry" but_href="bregistry.addreg" but_role="button" but_meta="modified"}</div>
			{/if}
			<div class="float-right mr10">{include file="buttons/button.tpl" but_text="Manage Other Registry" but_href="bregistry.manage" but_role="button" but_meta="modified"}</div>
			<div class="clearfix"></div>
		</div>
		<div class="clearfix"></div>
	</div>
	
	{*
	{if $registry_data['wr_id']}
	<div class="buttons-container">
		<div class="float-left mr10">{include file="buttons/button.tpl" but_text="Manage Registry Products" but_href="wregistry.update&registry_type_id=$registry_type_id" but_role="button" but_meta="modified"}</div>
		<div class="float-left">{include file="buttons/button.tpl" but_text="Delete Your Registry" but_href="wregistry.delete_registry&wr_id=$registry_type_id" but_role="button" but_meta="modified delete_registry"}</div>
	</div>
	{/if}
	*}
	
	<div class="regFormContainer">
		<form action="{""|fn_url}" method="post" name="bregistry_form">
			<input type="hidden" name="registry_data[br_id]" value="{$registry_data.br_id}">
			
			<br>
			<div class="sectionContainer">
				<div class="sectionHeading">1. Add a Birthday</div>
				<div class="sectionData">
					
					<div class="control-group">
						<label for="elm_yourfname" class="cm-required float-left" style="width:15%;">First Name</label>
						<div class="cm-field-container float-left">
							<input type="text" id="elm_yourfname" class="input-text" size="70" name="registry_data[fname]" value="{$registry_data.fname}" />
						</div>
					</div>	
					<div class="control-group">
						<label for="elm_yourlname" class="cm-required float-left" style="width:15%;">Last Name</label>
						<div class="cm-field-container float-left">
							<input type="text" id="elm_yourlname" class="input-text" size="70" name="registry_data[lname]" value="{$registry_data.lname}" />
						</div>
					</div>	
					<div class="control-group">
						<label for="elm_event_date" class="cm-required float-left" style="width:15%;">Birth Date:</label>
						<div class="cm-field-container float-left mr10">
							{include file="common/calendar.tpl" date_id="elm_event_date" date_name="registry_data[event_date]" date_val=$registry_data.event_date  start_year=2001 end_year=5}
						</div>
					</div>
					<div class="control-group">
						<label for="elm_gender" class="cm-required float-left" style="width:15%;">Gender</label>
						<select id="elm_gender" name="registry_data[gender]">
							<option value="B" {if $registry_data.gender == "B"}selected="selected"{/if}>Boy</option>
							<option value="G" {if $registry_data.gender == "G"}selected="selected"{/if}>Girl</option>
						</select>
					</div>
					<div class="control-group">
						<label for="elm_yourinterest" class="float-left" style="width:15%;">Interest</label>
						<div class="cm-field-container float-left" style="width:75%;">
							{foreach from=$interests item="interest" key="key" name="interests"}
								{*if in_array($key, $registry_data.interests)}yes{/if*}
								<div class="float-left" style="width:30%; margin:10px 0;"><input type="checkbox" value="{$key}" {if in_array($key, $registry_data.interests)}checked="checked"{/if} class="input-text" size="70" name="registry_data[interests][]" /> {$interest}</div>
							{/foreach}
						</div>
					</div>	
					<div class="control-group">
						<label for="elm_about" class="float-left" style="width:15%;">About:</label>
						<div class="cm-field-container float-left mr10">
							<textarea name="registry_data[about]">{$registry_data.about}</textarea>
						</div>
					</div>
					
				</div>
			</div>
			<!-- Permissions & Preferences Start -->
			<div class="sectionContainer">
				<div class="sectionHeading">2. Permissions & Preferences</div>
				<div class="sectionData">
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
				{include file="buttons/save.tpl" but_name="dispatch[bregistry.updateregistry]"}
			</div>
		</form>
	</div>
	
{*include file="pickers/products/picker.tpl" data_id="wr_products" but_text=__("add_product") extra_var="wregistry.add_products"*}

<br>
</div>
