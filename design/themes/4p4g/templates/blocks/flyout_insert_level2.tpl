{hook name="blocks:flyout_insert_level2"}

{strip}

{assign var="foreach_name" value="item_`$iid`"}

{foreach from=$items item="item" name=$foreach_name}

{hook name="blocks:flyout_element"}

    {assign var="menu_name" value=strtolower(trim(preg_replace('/[^a-zA-Z0-9]+/', '-', $item.$name), '-'))}
    <div class="L2 {if $separated && !$smarty.foreach.$foreach_name.last}b-border {/if}{if $item.$childs}dir{/if}{if $item.active || $item|fn_check_is_active_menu_item:$block.type} cm-active{/if} {$menu_name}">
    
        {assign var="item_url" value=$item|fn_form_dropdown_object_link:$block.type}
        <a{if $item_url} href="{$item_url}"{/if} {if $item.new_window}target="_blank"{/if}>{$item.$name}</a>
        {if $item.$childs}
            {hook name="blocks:flyout_insert_childs"}
    
            <!-- <div class="hide-border">&nbsp;</div> -->
            <div class="L3">
                {include file="blocks/flyout_insert_level2.tpl" items=$item.$childs separated=true submenu=true iid=$item.$item_id}
            </div>

            {/hook}

        {/if}
    </div>

{/hook}

{/foreach}

{/strip}

{/hook}
