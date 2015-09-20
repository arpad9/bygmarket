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
<div class="registryContainer">
	<div class="registryTitle">Birthday <span class="darkColor">Registry</span></div>
	<br>
	<div class="registryBlockContainer">
		
		<div class="registryBlockInformation">
			{*
			<div><span><b>Add Birthday: </b>Take a moment to tell us about your interests</span></div>
			<div><span><b>Share with Family and Friends: </b>Make it easy for them to get the perfect present</span></div>
			<ul>
				<li><b>Add Birthday: </b>Take a moment to tell us about your interests</li>
				<li><b>Share with Family and Friends: </b>Make it easy for them to get the perfect present</li>
			</ul>
			*}
			<ol style="margin: 0 0 10px 20px; padding: 0;">
				<li><b>Add Birthday: </b>Take a moment to tell us about your interests.</li>
				<li><b>Share with Family and Friends: </b>Make it easy for them to find the perfect gifts for birthdays.</li>
			</ol>
		</div>
		<div>{include file="buttons/button.tpl" but_text="{if empty($registry_data) }Add Birthday{else}Add Another Birthday{/if}" but_href="bregistry.addreg" but_role="button" but_meta="add"}</div>
		<hr />
		{if empty($registry_data) }
		<div>
			<p class="no-items">No Birthday Registry Created</p>
		</div>
		{else}
		<div class="birthdayContainer">
		
			{foreach from=$registry_data item="birthday_data" key="key" name="registry_data"}
				<div class="birthdays">
					<div class="birthday-icons float-left"><img src="images/{if $birthday_data.gender == 'B'}boy-icon.jpg{else}girl-icon.jpg{/if}"></div>
					<div class="birthday-info float-left">
						<div class="birthday-name"><span>{$birthday_data.fname} {$birthday_data.lname}</span>&nbsp;<small>({if $birthday_data.type == 'P'}Public{else}Private{/if})</small>&nbsp;&nbsp;{*include file="buttons/button.tpl" but_text="Edit" but_href="bregistry.addreg&br_id={$birthday_data.br_id}" but_role="text" but_meta="modified"*}</div>
						<div calss="birthdate"><b>Birthday :</b> {$birthday_data.event_date|date_format:'%B %d, %Y'}</div>
						<div class="interest"><b>Interests :</b>  
							{assign var=inte value=","|explode:$birthday_data.interests}												
							{foreach from=$inte item="inter" key="i" name="interestdata"}
								{foreach from=$interests item="interest" key="is"}
									{if $inter == $is}{$interest}{/if}
								{/foreach}
								{if !$smarty.foreach.interestdata.last}, {/if}									
							{/foreach}
							{if !$birthday_data.interests} {include file="buttons/button.tpl" but_text="Add" but_href="bregistry.addreg&br_id={$birthday_data.br_id}" but_role="text" but_meta="modified"} {/if}
						</div>
						<div><b>About :</b>{if $birthday_data.about} {$birthday_data.about} {else} {include file="buttons/button.tpl" but_text="Add" but_href="bregistry.addreg&br_id={$birthday_data.br_id}" but_role="text" but_meta="modified"}{/if}</div>
					</div>
					<div class="birthday-buttons float-left">
						<div style="margin:0 0 5px 0;">
							<div class="float-left" style="margin-right:7px;">{include file="buttons/button.tpl" but_text="Edit" but_href="bregistry.addreg&br_id={$birthday_data.br_id}" but_role="button" but_meta="modified"}</div>
							<div class="float-left">{include file="buttons/button.tpl" but_text="Remove" but_href="bregistry.delete_registry&br_id={$birthday_data.br_id}" but_role="button" but_meta="delete_registry"}</div>
							<div class="clearfix"></div>
						</div>
						<div>{include file="buttons/button.tpl" but_text="Create a Gift List" but_href="bregistry.update&registry_type_id={$birthday_data.br_id}" but_role="button" but_meta="add"}</div>
					</div>
					<div class="clearfix"></div>
				</div>
			{if !$smarty.foreach.registry_data.last}
			<hr />
			{/if}
			{/foreach}
			
		</div>
		{/if}
	</div>
</div>
