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
	<div class="registryTitle">Wedding <span class="darkColor">Registry</span></div>
	{*<div class="registrationPageWelcome"><b>Hello, {$user_info.firstname} {$user_info.lastname}</b> Welcome to your Wedding Registry.</div>*}
	
	<div style="margin-top:15px;">
		<div class="registrationPageWelcome float-left" style="margin-top:10px;"><b>Hello, {$user_info.firstname} {$user_info.lastname}</b> Welcome to your Wedding Registry.</div>
		{if $registry_data['wr_id']}
		<div class="float-right">
			<div class="float-left mr10">{include file="buttons/button.tpl" but_text="Manage Registry Products" but_href="wregistry.update&registry_type_id=$registry_type_id" but_role="button" but_meta="modified"}</div>
			<div class="float-left">{include file="buttons/button.tpl" but_text="Delete Your Registry" but_href="wregistry.delete_registry&wr_id=$registry_type_id" but_role="button" but_meta="modified delete_registry"}</div>
		</div>
		{/if}
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
		<form action="{""|fn_url}" method="post" name="wregistry_form">
			<input type="hidden" name="registry_data[wr_id]" value="{$registry_data.wr_id}">
			<!-- About You and Your Partner Start -->
			<br>
			<div class="sectionContainer">
				<div class="sectionHeading">1. About You and Your Parner</div>
				<div class="sectionData">
					
					<div class="subSection float-left" style="border-right: 1px solid #ddd; margin-right: 25px;">
						<div class="subSectionHeading">About You</div>
						<div class="control-group">
							<label for="elm_yourrole" class="cm-required">Your Role</label>
							<select id="elm_yourrole" name="registry_data[yourrole]">
								<option value="G" {if $registry_data.yourrole == "G"}selected="selected"{/if}>Groom</option>
								<option value="B" {if $registry_data.yourrole == "B"}selected="selected"{/if}>Bride</option>
								<option value="P" {if $registry_data.yourrole == "P"}selected="selected"{/if}>Partner</option>
							</select>
						</div>
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
						<div class="subSectionHeading">About Your Partner</div>
						<div class="control-group">
							<label for="elm_theirrole" class="cm-required">Their Role</label>
							<select id="elm_theirrole" name="registry_data[theirrole]">
								<option value="B" {if $registry_data.theirrole == "B"}selected="selected"{/if}>Bride</option>
								<option value="G" {if $registry_data.theirrole == "G"}selected="selected"{/if}>Groom</option>
								<option value="P" {if $registry_data.theirrole == "P"}selected="selected"{/if}>Partner</option>
							</select>
						</div>
						<div class="control-group">
							<label for="elm_theirfname" class="cm-required">First Name</label>
							<input type="text" id="elm_theirfname" class="input-text" size="70" name="registry_data[theirfname]" value="{$registry_data.theirfname}" />
						</div>
						<div class="control-group">
							<label for="elm_theirlname" class="cm-required">Last Name</label>
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
			<!-- About Your wedding Start -->
			<div class="sectionContainer">
				<div class="sectionHeading">2. About Your Wedding</div>
				<div class="sectionData">
					<div class="control-group">
						<label for="elm_event_date" class="cm-required float-left" style="width:17%;">Event Date:</label>
						<div class="cm-field-container float-left ml10 mr10">
							{include file="common/calendar.tpl" date_id="elm_event_date" date_name="registry_data[event_date]" date_val=$registry_data.event_date  start_year=2001 end_year=5}
						</div>
					</div>
					<div class="control-group">
						<label for="elm_city" class="cm-required float-left" style="width:17%;">Event City:</label>
						<div class="cm-field-container float-left ml10 mr10">
							<input type="text" id="elm_city" class="input-text" size="70" name="registry_data[event_city]" value="{$registry_data.event_city}" />
						</div>
					</div>
					<div class="control-group">
						<label for="elm_state" class="cm-required float-left" style="width:17%;">Event State:</label>
						<div class="cm-field-container float-left ml10 mr10">
							{$_country = $settings.General.default_country}
							{$_state = $registry_data.event_state}
							<select id="elm_state" class="cm-state" name="registry_data[event_state]">
								<option value="">- {__("select_state")} -</option>
								<option {if $_state == NO}selected="selected"{/if} value="NO">Outside of USA</option>
								{if $states && $states.$_country}
									{foreach from=$states.$_country item=state}
										<option {if $_state == $state.code}selected="selected"{/if} value="{$state.code}">{$state.state}</option>
									{/foreach}
								{/if}
							</select>
						</div>
					</div>
					<div class="control-group">
						<label for="elm_country" class="cm-required float-left" style="width:17%;">Event Country:</label>
						<div class="cm-field-container float-left ml10 mr10">
							{$_countryS = $registry_data.event_country}
							<select id="elm_country" class="cm-country" name="registry_data[event_country]">
								{hook name="profiles:country_selectbox_items"}
								<option value="">- {__("select_country")} -</option>
								{foreach from=$countries item="country" key="code"}
								<option {if $_countryS == $code}selected="selected"{/if} value="{$code}">{$country}</option>
								{/foreach}
								{/hook}
							</select>
						</div>
					</div>
					<div class="control-group">
						<label for="elm_about" class="float-left" style="width:17%;">Personal Message:<br><span style="font-size:10px;">(Tell people are little bit about yourselves and your wedding)</span></label>
						<div class="cm-field-container float-left ml10 mr10">
							<textarea name="registry_data[about]" rows="4" style="width:300px;">{$registry_data.about}</textarea>
						</div>
					</div>
					
				</div>
			</div>
			<!-- About Your wedding End -->
			<br>
			<!-- Permissions & Preferences Start -->
			<div class="sectionContainer">
				<div class="sectionHeading">3. Permissions & Preferences</div>
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
				{include file="buttons/save.tpl" but_name="dispatch[wregistry.updateregistry]"}
			</div>
		</form>
	</div>
	
{*include file="pickers/products/picker.tpl" data_id="wr_products" but_text=__("add_product") extra_var="wregistry.add_products"*}

<br>
</div>
