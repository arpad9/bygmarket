<table class="table-width">
{foreach from=$banner_categories key="category_id" item="category" name="b_categories"}
<tr>
    <td class="center product-image valign-top">{include file="common/image.tpl" images=$category.main_pair hide_if_no_image=true}</td>
    <td class="valign-top" style="width: 100%">
        <span class="subcategories"><a href="{"categories.view?category_id=`$category.category_id`"|fn_url}">{$category.category}</a></span>
        <p><span class="category-description">{$category.description}</span></p>
    </td>
</tr>
{if !$smarty.foreach.b_categories.last}
<tr>
    <td colspan="3"><hr /></td>
</tr>
{/if}
{/foreach}
</table>

{capture name="mainbox_title"}{__("categories")}{/capture}