<div class="search-block">
<form action="{""|fn_url}" name="search_form" method="get">
<input type="hidden" name="subcats" value="Y" />
<input type="hidden" name="status" value="A" />
<input type="hidden" name="pshort" value="Y" />
<input type="hidden" name="pfull" value="Y" />
<input type="hidden" name="pname" value="Y" />
<input type="hidden" name="pkeywords" value="Y" />
<input type="hidden" name="search_performed" value="Y" />

{hook name="search:additional_fields"}{/hook}

{strip}
<style>
.searchContainer{
	border:1px solid #ddd;
	border-radius: 5px;
	position:relative;
	width:560px;
}
.categoryContainer{
	float:left; 
	width:20%;
	overflow:hidden;
	position:relative;
	border-right:1px solid #ddd;
}
.categoryContainer select{
	border:0px none;
	max-width: 125px !important;
	height:30px;
	background-color: #f4f4f4;
}
.categoryContainer select option{
	
	background-color: #fff !important;
}
.searchInputContainer{
	/*float:left; 
	width:79.5%;*/
	padding-right: 36px;
}
.searchInputContainer input{
	border:0px none;
}
.search-down-icon{
	color: #AAAAAA;
    position: absolute;
    right: 1px;
    top: 8px;
    width: 9px;
}
.catSelect{
	position: absolute;
	background: none;
	left:0;
	opacity:0;
	top:0;
}
.catValue{
	color:#767676;
}
.searchGoButton{
	background: none repeat scroll 0 0 #3D454E;
    border: 1px solid #3D454E;
    border-radius: 0 5px 5px 0;
    color: #FFFFFF;
    font-weight: bold;
    padding: 4px 7px;
    position: absolute;
    right: 0;
}
</style>


<div class="searchContainer">
	{*<div class=" categoryContainer ">
	<i class="icon-down-micro search-down-icon"></i>
	{assign var="all_categories" value=0|fn_get_plain_categories_tree:false}
		
        <select id="catId" name="cid" class="valign" style="padding: 5px 0px; color:#808080;" onChange="test()">
            <option value="0" {if $category_data.parent_id == "0"}selected{/if}>Search All</option>
			{foreach from=$all_categories item="cat"}
            <option value="{$cat.category_id}" {if $cat.disabled}disabled="disabled"{/if}{if $search.cid == $cat.category_id} selected="selected"{/if} title="{$cat.category}">{$cat.category|escape|truncate:50:"...":true|indent:$cat.level:"&#166;&nbsp;&nbsp;&nbsp;&nbsp;":"&#166;--&nbsp;" nofilter}</option>
            {/foreach}
        </select>
     </div>
     *}
     {assign var="all_categories" value=0|fn_get_plain_categories_tree:true}
     <span style="position:absolute; padding:7px 15px 0 5px;">
		
		{if isset($smarty.get.cid) && $smarty.get.cid != 0}
			{assign var="selectedCat" value=$smarty.get.cid|fn_get_category_name}
			<span style="width:auto;" class="catValue"> {$selectedCat} </span>
		{else}
			<span style="width:auto;" class="catValue"> Search All </span>
		{/if}
		<i class="icon-down-micro search-down-icon"></i>
		<select id="catId" name="cid" class="valign catSelect" style="padding: 5px 0px; color:#808080;">
            <option value="0" {if $category_data.parent_id == "0"}selected{/if}>Search All</option>
			{*<option value="0" {if $category_data.parent_id == "0"}selected{/if}>- All Departments -</option>*}
            {foreach from=$all_categories item="cat"}
            <option value="{$cat.category_id}" {if $cat.disabled}disabled="disabled"{/if}{if $search.cid == $cat.category_id} selected="selected"{/if} title="{$cat.category}">{$cat.category|escape|truncate:50:"...":true|indent:$cat.level:"&nbsp;&nbsp;&nbsp;&nbsp;":"&nbsp;" nofilter}</option>
            {/foreach}
        </select>
     </span>
     <div class="searchInputContainer">
    {if $settings.General.search_objects}
        {assign var="search_title" value=__("search")}
    {else}
        {assign var="search_title" value=__("search_products")}
    {/if}
      <input type="text" name="q" value="{$search.q}" id="search_input{if $smarty.capture.search_input_id}_{$smarty.capture.search_input_id}{/if} appendedInputButton" title="{$search_title}" class="span6 input-texxt input-texxt-menu cm-hint" style="width:100%;" />
      {if $settings.General.search_objects}
          {*include file="buttons/magnifier.tpl" but_name="search.results" alt=__("search")*}
          <button type="submit" class="searchGoButton" title="Search">Go</button>
          <input type="hidden" value="products.results" name="dispatch">
      {else}
          {*include file="buttons/magnifier.tpl" but_name="products.search" alt=__("search")*}
          <button type="submit" class="searchGoButton" title="Search">Go</button>
          <input type="hidden" value="products.search" name="dispatch">
      {/if}
      </div>
      <div style="clear:both;"></div>
</div>

<script>


$(document).ready(function(){
	$('.searchInputContainer').css('padding-left',$('.catValue').width()+20);
	$('#catId').change(function(){
		
		$('.catValue').html($.trim($('#catId').find('option:selected').text()));
		
		setTimeout(function(){
			
			$('.searchInputContainer').css('padding-left',$('.catValue').width()+20);
		},10);
		
	});
});
function test(value){
alert($('#catId').width());
alert(value);
$('.catValue').value();
$('.searchInputContainer').css('padding-left',$('.catValue').width())
}
</script>

{/strip}

{capture name="search_input_id"}{math equation="x + y" x=$smarty.capture.search_input_id|default:1 y=1 assign="search_input_id"}{$search_input_id}{/capture}
</form>
</div>
