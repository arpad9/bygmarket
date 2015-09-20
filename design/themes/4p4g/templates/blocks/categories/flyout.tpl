{** block-description:flyout **}

{assign var="items" value=0|fn_get_categories_tree:false}

<div class="clearfix">
    <ul id="vmenu_{$block.block_id}" class="dropdown dropdown-vertical{if $block.properties.right_to_left_orientation =="Y"} rtl{/if}">
        {include file="blocks/flyout_insert.tpl" items=$items separated=true submenu=false name="category" item_id="param_id" childs="subcategories"}
    </ul>
</div>
