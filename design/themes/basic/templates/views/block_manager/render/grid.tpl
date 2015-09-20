{if $grid.alpha}<div class="row">{/if}
    <div class="span{$grid.width}{if $grid.offset} offset{$grid.offset}{/if} {$grid.user_class}" >
        {if $grid.status == "A" && $content}
            {$content nofilter}
        {/if}
    </div>
{if $grid.omega}</div>{/if}