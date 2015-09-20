
<div class="registryContainer">
	<div class="registryTitle">Birthday <span class="darkColor">Registry</span></div>
	<br>
	<div class="registryBlockContainer">
		<div class="float-left registryCreate">
			<div class="registryCreateTitle"><span class="darkColor">{if $br_id}Manage{else}Create{/if}</span><span> a Registry</span></div>
			<div class="registryCreateDesc">
				Make it easy for Family and Friends to get the perfect present
				{include file="buttons/button.tpl" but_text="Get Started" but_href="bregistry.manage" but_role="button" but_meta="add"}
			</div>
		</div>
		<div class="float-left vSepretor">&nbsp;</div>
		<div class="float-right registryFind">
			<div class="registryFindTitle"><span class="darkColor">Find<span> a Registry</div>
			<div class="registryFindForm">
				<form action="{""|fn_url}" method="get" name="birthday_registry_search_form" >
					<div class="float-left">
						<div class="control-group">
							<label for="elm_yftitle" class="cm-required1">First Name</label>
							<input type="text" id="elm_yftitle" class="input-text" size="70" name="fname" value="" />
						</div>
					</div>	
					<div class="float-left">
						<div class="control-group">
							<label for="elm_title" class="cm-required">Last Name</label>
							<input type="text" id="elm_title" class="input-text" size="70" name="lname" value="" />
						</div>
					</div>
					<div class="float-left">
						<div class="control-group">
							<label for="elm_title">&nbsp;</label>
							<div>
								<!-- <button title="Search" class="registryGoButton" name="dispatch[bregistry.update]" type="submit">Go</button> -->
								<span class="button-submit button-wrap-left">
									<span class="button-submit button-wrap-right"><input type="submit" value="Go"></span>
								</span>
								<input type="hidden" name="stype" value="br">
								<input type="hidden" name="dispatch" value="wishlistregistry.search">
							</div>
						</div>
					</div>
					
					<div class="clearfix"></div>
				</form>
			</div>
		</div>
		<div class="clearfix"></div>
	</div>
</div>
