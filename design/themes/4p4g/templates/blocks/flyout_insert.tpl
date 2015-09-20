<style>
div.flyout-box{
	/*width: auto !important;
	bottom: auto !important; */
}
.myCategoryInfo a:link, .myCategoryInfo a:visited{
	color:#0088CC !important;
	width:auto !important;
}
.myCategoryInfo a:hover{
	text-decoration:underline;
}
.myCategoryInfo p, .myCategoryInfo hr, .myCategoryInfo i, .myCategoryInfo b, .myCategoryInfo br, .myCategoryInfo a, .myCategoryInfo h1, .myCategoryInfo h2, .myCategoryInfo h3, .myCategoryInfo h4, .myCategoryInfo h5, .myCategoryInfo h6{
	padding:0px !important;
	margin:5px 0px !important;
}
.myCategoryInfo br{
	height: 0px !important;
	width : 0px !important;
}
li.flyout-parent.full-store-directory div.flyout-box > div.L2.dir{
	min-height:160px;
}
</style>

{hook name="blocks:flyout_insert"}{strip}
{assign var="foreach_name" value="item_`$iid`"}

{foreach from=$items item="item" name=$foreach_name}
{hook name="blocks:flyout_element"}

    {assign var="menu_name" value=strtolower(trim(preg_replace('/[^a-zA-Z0-9]+/', '-', $item.$name), '-'))}
    <li class="{if $separated && !$smarty.foreach.$foreach_name.last}b-border {/if}{if $item.$childs}dir{/if}{if $item.active || $item|fn_check_is_active_menu_item:$block.type} cm-active{/if} flyout-parent {$menu_name}">
    
        {assign var="item_url" value=$item|fn_form_dropdown_object_link:$block.type}
        <a{if $item_url} href="{$item_url}"{/if} {if $item.new_window}target="_blank"{/if}>{$item.$name}</a>
        
        {if $item.$childs}
            <i class="icon-right-open"></i><i class="icon-left-open"></i>
            
            {hook name="blocks:flyout_insert_childs"}
            <div class="L2 flyout-box">
            
                {include file="blocks/flyout_insert_level2.tpl" items=$item.$childs separated=true submenu=true iid=$item.$item_id}
                
                {***** Check for the parent category *****}
                {if $item.parent_id == 0}
					{assign var="category_desc_data" value=$item.category_id|fn_get_category_data}
					{if $category_desc_data.description && $category_desc_data.description != ""}
						<div class="clearfix L2 compact wysiwyg-content margin-bottom myCategoryInfo" style="padding:5px 10px;">{$category_desc_data.description nofilter}</div>
					{/if}
				{/if}
				{***** Check for the parent category *****}
				
            </div>
            {/hook}

        {/if}
        
    </li>
    
{/hook}
{/foreach}

{********** Full Store Category Start **********}

{append var='fullstore' value='Full Store Directory' index='category'}
{append var='fullstore' value=$items index='subcategories'}
{append var='fullstorefull' value=$fullstore index='0'}

{foreach from=$fullstorefull item="item" name=$foreach_name}
{hook name="blocks:flyout_element"}

    {assign var="menu_name" value=strtolower(trim(preg_replace('/[^a-zA-Z0-9]+/', '-', $item.$name), '-'))}
    <li class="{if $separated && !$smarty.foreach.$foreach_name.last}b-border {/if}{if $item.subcategories}dir{/if}{if $item.active || $item|fn_check_is_active_menu_item:$block.type} cm-active{/if} flyout-parent {$menu_name}">
        {assign var="item_url" value=$item|fn_form_dropdown_object_link:$block.type}
        <a{if $item_url} href="#"{/if} {if $item.new_window}target="_blank"{/if}>{$item.$name}</a>
        {if $item.subcategories}
            <i class="icon-right-open"></i><i class="icon-left-open"></i>
            {hook name="blocks:flyout_insert_childs"}
			<div class="L2 flyout-box">
                {include file="blocks/flyout_insert_level2.tpl" items=$item.subcategories separated=true submenu=true iid=$item.$item_id}			
            </div>
			{/hook}
        {/if}
    </li>
    
{/hook}
{/foreach}

{********** Full Store Category End **********}

{/strip}{/hook}
