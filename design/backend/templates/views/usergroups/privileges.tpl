{capture name="mainbox"}

<form action="{""|fn_url}" method="post" name="privileges_form">

<table class="table">

<thead>
    <tr>
        <th width="4%">
            {include file="common/check_items.tpl"}</th>
        <th width="48%">{__("privilege")}</th>
        <th width="48%">{__("description")}</th>
    </tr>
</thead>

<tbody>
{foreach from=$privileges key=section_id item=privilege}
<tr>
    <td colspan="3"><input size="25" type="text" class="input-text-long" name="section_name[{$section_id}]" value="{$privilege.0.section}" /></td>
</tr>

{foreach from=$privilege item=p}
<tr>
    <td width="1%">
        {if $p.is_default == "Y"}&nbsp;{else}<input type="checkbox" name="delete[{$p.privilege}]" id="delete_checkbox" class="checkbox cm-item" value="Y" />{/if}</td>
    <td>{$p.privilege}</td>
    <td><input type="text" class="input-text" size="35" name="privilege_descr[{$p.privilege}]" value="{$p.description}" /></td>
</tr>
{/foreach}
{/foreach}
</tbody>
</table>

{capture name="buttons"}
    {include file="buttons/save.tpl" but_name="dispatch[usergroups.update_privilege_descriptions]" but_role="submit-link" but_target_form="privileges_form"}
{/capture}

</form>

{/capture}
{include file="common/mainbox.tpl" title=__("translate_privileges") content=$smarty.capture.mainbox buttons=$smarty.capture.buttons select_languages=true}