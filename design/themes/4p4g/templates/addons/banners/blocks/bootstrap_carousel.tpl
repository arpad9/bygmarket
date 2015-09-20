{** block-description:BootstrapCarousel **}

{if $items}
<div class="carousel slide" id="banner_slider_{$block.snapping_id}">
    <ol class="carousel-indicators">
      {foreach from=$items item="banner" key="key" name="banners"}
          <li data-target="#banner_slider_{$block.snapping_id}" data-slide-to="{$smarty.foreach.banners.iteration}"></li>
      {/foreach}
    </ol>
    <div class='carousel-inner'>
        {foreach from=$items item="banner" key="key"}
            {if $banner.type == "G" && $banner.main_pair.image_id}
                <div class="item">
                  {include file="common/image.tpl" images=$banner.main_pair}
                </div>
            {/if}
        {/foreach}
    </div>
    <a class="carousel-control left" href="#banner_slider_{$block.snapping_id}" data-slide="prev"><i class="icon-left-open-thin"></i></a>
    <a class="carousel-control right" href="#banner_slider_{$block.snapping_id}" data-slide="next"><i class="icon-right-open-thin"></i></a>
</div>
{/if}

<script type="text/javascript">
//<![CDATA[
(function($) {
  $('#banner_slider_{$block.snapping_id}').carousel({
      interval: {math equation="s*1000" s=$block.properties.delay|default:0},
  });
})(jQuery);
//]]>
</script>
