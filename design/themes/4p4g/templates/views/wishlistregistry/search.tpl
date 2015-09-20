<div id="products_search">
{if $search}
    {assign var="_title" value=__("search_results")}
    {assign var="_collapse" value=true}
{else}
    {assign var="_title" value=__("advanced_search")}
    {assign var="_collapse" value=false}
{/if}
<script>
$(document).ready(function(){
	//alert('{$searchtype}');
	
	if('{$searchtype}' == 'wl'){
	//alert('wl');
		/*$('.wl').show();
		$('.nowl').hide();*/
		//alert($('.wl').html());
		
		$('.search-input-container').html($('.wl').html());
		
	}else{
	//alert('else- ');
		/*$('.wl').hide();
		$('.nowl').show();
		*/
		$('.search-input-container').html($('.nowl').html());
	}
	
	$('#stype').on('change',function(){
		//alert(this.value);
		if(this.value == 'wl'){
		//alert('yes');
			/*$('.wl').show();
			$('.nowl').hide();*/
			$('.search-input-container').html($('.wl').html());
		}else{
			/*$('.wl').hide();
			$('.nowl').show();*/
			
			$('.search-input-container').html($('.nowl').html());
		}
		
	});
});
</script>

{script src="js/tygh/exceptions.js"}

	<div class="search-container">
		
		<div class="search-form-title" style="font-size:28px;">Find a Wishlist or Registry</div>
		
		<div class="registry_search_form_container">
				
			<form action="{""|fn_url}" method="get" name="registry_search_form" >
				<div class="float-left">
					<select name="stype" id="stype" style="width:auto;">
						<option value="wl" {if $searchtype == 'wl'}selected="selected"{/if}>Wish List</option>
						<option value="wr" {if $searchtype == 'wr'}selected="selected"{/if}>Wedding Registry</option>
						<option value="bbr" {if $searchtype == 'bbr'}selected="selected"{/if}>Baby Registry</option>
						<option value="br" {if $searchtype == 'br'}selected="selected"{/if}>Birthday Registry</option>
						<option value="hgr" {if $searchtype == 'hgr'}selected="selected"{/if}>Hoiday of Gift Registry</option>
					</select>
				</div>
				
				<div class="search-input-container float-left"></div>
								
				<div class="search-go-button float-left">
					<span class="button-submit button-wrap-left">
						<span class="button-submit button-wrap-right"><input type="submit" value="Search"></span>
					</span>
				</div>
				<input type="hidden" name="dispatch" value="wishlistregistry.search">
			</form>
			<div class="clearfix"></div>
		</div>
		<br>
		
		{if $search}
			<div style="font-size:18px; color:#666;">{$_title} for " {$searchedFor} " in {$in}  <small>- {$search.total_items} Matches</small></div>
		{/if}
		
	</div>
	
	<div class="search-result-container">
		
	</div>


{if $search}
    {if $products}
        
        {assign var="title_extra" value="Matches Found: `$search.total_items`"}
        
        {include file="common/pagination.tpl"}
        
        {foreach from=$products item="product" key="key" name="products"}
			{*<pre>{$product|@print_r}</pre>*}
			{if $searchtype == 'wl'}
				<div class="user-container">
					<div style="font-size:20px;">
						<a href="{"wishlists.view?user_id={$product.user_id}"|fn_url}" rel="nofollow" class="underlined" style="font-size:20px;">
						{if !empty($product.firstname) || !empty($product.lastname)}
							{if !empty($product.firstname) && !empty($product.lastname)}
								{$product.firstname} {$product.lastname} 
							{else if !empty($product.firstname)}
								{$product.firstname} 
							{else}
								{$product.lastname} 
							{/if}
						{else}
							{$product.email}
						{/if}
						</a>
					</div>
					<hr />
					<div><a href="{"wishlists.view?user_id={$product.user_id}"|fn_url}" rel="nofollow" class="underlined" style="color:#666;">Wish List</a></div>
				</div>
			{else}
										
				{if $searchtype == 'wr'}
				
					<div class="user-container">
						<div style="font-size:20px;">
							<a href="{"wregistry.view&registry_type_id={$product.wr_id}"|fn_url}" rel="nofollow" class="underlined" style="font-size:20px;">
								{$product.yourfname} {$product.yourlname} & {$product.theirfname} {$product.theirlname}
							</a>
						</div>
						<hr />
						<div style="margin-bottom:5px; font-size:12px; color:#666;">Event Date: {$product.event_date|date_format:'%B %d, %Y'}</div>
						<div style="font-size:12px; color:#666;">Location: {$product.event_city}</div>
					</div>
				
				{else if $searchtype == 'bbr'}
				
					<div class="user-container">
						<div style="font-size:20px;">
							<a href="{"bbregistry.view&registry_type_id={$product.bbr_id}"|fn_url}" rel="nofollow" class="underlined" style="font-size:20px;">
								{$product.yourfname} {$product.yourlname}
								
								{if !empty($product.theirfname) && !empty($product.theirlname)}
									& {$product.theirfname} {$product.theirlname} 
								{else if !empty($product.theirfname)}
									& {$product.theirfname} 
								{else if !empty($product.theirlname)}
									& {$product.theirlname} 
								{/if}
							</a>
						</div>
						<hr />
						<div style="margin-bottom:5px; font-size:12px; color:#666;">Estimated Arrival Date: {$product.event_date|date_format:'%B %d, %Y'}</div>
					</div>
				
				{else if $searchtype == 'br'}
				
					<div class="user-container">
						<div style="font-size:20px;">
							<a href="{"bregistry.view&registry_type_id={$product.br_id}"|fn_url}" rel="nofollow" class="underlined" style="font-size:20px;">
								{$product.fname} {$product.lname}
							</a>
						</div>
						<hr />
						<div style="margin-bottom:5px; font-size:12px; color:#666;">Birth Date: {$product.event_date|date_format:'%B %d, %Y'}</div>
					</div>
				
				{else if $searchtype == 'hgr'}
				
					<div class="user-container" style="height:70px;">
						<div style="font-size:20px;">
							<a href="{"hgregistry.view&registry_type_id={$product.hgr_id}"|fn_url}" rel="nofollow" class="underlined" style="font-size:20px;">
								{$product.yourfname} {$product.yourlname}
								
								{if !empty($product.theirfname) && !empty($product.theirlname)}
									& {$product.theirfname} {$product.theirlname} 
								{else if !empty($product.theirfname)}
									& {$product.theirfname} 
								{else if !empty($product.theirlname)}
									& {$product.theirlname} 
								{/if}
							</a>
						</div>
					</div>
				
				{/if}
				
			{/if}
        
			{*
			<div class="user-container">
				{$product.wr_id}
				{$product.yourfname}
				-{$key}-
				{$product.user_id}
				{$product.firstname}
				{$product.lastname}
			</div>
			*}
		
			{*if $smarty.foreach.products.last}
			<div class="clearfix"></div>
			{/if*}
			
		{/foreach}
		<div class="clearfix"></div>
		<br>
		{include file="common/pagination.tpl"}
                
    {else}
    <br>
        <p class="no-items">We couldn't find a registry.</p>
    {/if}

{/if}

<!--products_search_{$block.block_id}--></div>

{hook name="products:search_results_mainbox_title"}
{capture name="mainbox_title"}Find Wishlist or Registry{/capture}
{/hook}

<div class="hideInput" style="display:none;">
	<div class="wl"><div style="width:330px;"><label for="elm_str" class="cm-required float-left"></label><input type="text" id="elm_str" name="lname" value="{$wishliststr}" class="str float-left" placeholder="Name or Email" style="width:300px;"></div></div>
	<div class="nowl">
		<div style="width:440px;">
			<div class="float-left" style="width:210px;"><input type="text" name="fname" class="float-left" value="{$regfname}" placeholder="First name"></div>
			<div class="float-left" style="width:220px;">
				<label for="elm_str" class="cm-required float-left"></label>
				<input type="text" id="elm_str" name="lname" class="float-left" value="{$reglname}" placeholder="Last name">
			</div>
		</div>
	</div>
</div>	
