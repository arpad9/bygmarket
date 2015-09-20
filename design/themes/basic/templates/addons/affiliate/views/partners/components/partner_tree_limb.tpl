{counter name="tree" print=false assign="tree"}
    {if $user.partners && $last}
        {assign var="file_name" value="tree_minus_last.gif"}
        {assign var="file_name_2" value="tree_plus_last.gif"}
        {assign var="extra" value="class=\"hand cm-combination hidden\""}
        {assign var="extra_2" value="class=\"hand cm-combination\""}
    {elseif $user.partners}
        {assign var="file_name" value="tree_minus.gif"}
        {assign var="file_name_2" value="tree_plus.gif"}
        {assign var="extra" value="class=\"hand cm-combination hidden\""}
        {assign var="extra_2" value="class=\"hand cm-combination\""}
    {elseif $last}
        {assign var="file_name" value="tree_coner.gif"}
        {assign var="file_name_2" value=""}
        {assign var="extra" value=""}
    {else}
        {assign var="file_name" value="tree_item.gif"}
        {assign var="file_name_2" value=""}
        {assign var="extra" value=""}
    {/if}
    {assign var="prefix" value="<img src=\"$images_dir/icons/$file_name\" id=\"off_partners_$tree\" width=\"16\" height=\"17\" $extra alt=\"\" title=\"\" />"}
    {if $file_name_2}
    {assign var="prefix" value="$prefix<img src=\"$images_dir/icons/$file_name_2\" id=\"on_partners_$tree\" width=\"16\" height=\"17\" $extra_2 alt=\"\" title=\"\" />"}
    {/if}
    {if $last}
        {assign var="file_name" value="spacer.gif"}
    {else}
        {assign var="file_name" value="tree_line.gif"}
    {/if}
    {assign var="space_suffix" value="<img src=\"$images_dir/icons/$file_name\" width=\"16\" height=\"17\" alt=\"\" title=\"\" />"}

<div class="tree-limb">
        <table>
        <tr class="valign-top">
            <td><span class="nowrap">{$space|default:"" nofilter}{$prefix nofilter}</span></td>
            <td>&nbsp;</td>
            <td>
                <i class="icon-user"></td>
            <td>&nbsp;</td>
            <td class="nowrap">
                {if $settings.General.use_email_as_login != "Y"}<strong>{$user.user_login}</strong> ({/if}{$user.firstname}{if $user.lastname}&nbsp;{/if}{$user.lastname}{if $settings.General.use_email_as_login != "Y"}){/if}
                {if $level} - {$level} {__("level")}{/if}</td>
            </td>
            <td>&nbsp;</td>
        </tr>
        </table>
</div>

{if $user.partners}
<div id="partners_{$tree}" class="hidden">
    {assign var="for_name" value="partners_$level"}
    {foreach from=$user.partners item=sub_user name=$for_name}
        {include file="addons/affiliate/views/partners/components/partner_tree_limb.tpl" user=$sub_user level=$level+1 space="$space$space_suffix" last=$smarty.foreach.$for_name.last}
    {/foreach}
</div>
{/if}