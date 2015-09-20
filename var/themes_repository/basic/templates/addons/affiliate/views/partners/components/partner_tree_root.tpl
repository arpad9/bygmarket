<table class="table table-width">
<tr>
    <th>
        <img src="{$images_dir}/icons/plus_minus.gif" id="on_partners" width="13" height="12" alt="" class="hand cm-combinations" />
        <img src="{$images_dir}/icons/minus_plus.gif" id="off_partners" width="13" height="12" alt="" class="hand cm-combinations hidden" />
    </th>
    <th style="width: 100%">{__("affiliate_tree")}</th>
</tr>
<tr>
    <td colspan="2">
    {if $partners}
        <div id="id_tree">
        {foreach from=$partners item=user name="tree_root"}
            {include file="addons/affiliate/views/partners/components/partner_tree_limb.tpl" user=$user level=0 space="" last=$smarty.foreach.tree_root.last}
        {/foreach}
        </div>
    {else}
        <p class="no-items">{__("no_users_found")}</p>
    {/if}
    </td>
</tr>
</table>