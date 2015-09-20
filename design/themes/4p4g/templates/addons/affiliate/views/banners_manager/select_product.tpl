<table class="table table-width">
<tr>
    <th style="width: 30%">{__("banner")}</th>
    <th style="width: 70%">{__("banner_code")}</th>
</tr>
<tr>
    <td class="valign-top">{$banner.example nofilter}</td>
    <td class="valign-top">
        <span class="product-details-title">{$banner.title}</span>
        <p>{__("banner_code_for_some_products")}:
        <textarea cols="70" rows="5" class="input-textarea">{$banner.code nofilter}</textarea></p>
    </td>
</tr>
<tr class="table-footer">
    <td colspan="2">&nbsp;</td>
</tr>
</table>

{include file="addons/affiliate/views/banners_manager/components/linked_products.tpl"}

{capture name="mainbox_title"}{__("select_products")}{/capture}