{include file="common/letter_header.tpl"}

{__("uc_restore_email_body", ["[backup_file]" => $backup_file, "[settings_section]" => $settings_section_url])}
<p>
{$restore_link}
</p>

{include file="common/letter_footer.tpl"}