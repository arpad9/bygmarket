<link href="{$config.theme_path}/css/ui/jqueryui.css" rel="stylesheet" type="text/css"/>
<link href="{$config.theme_path}/design_mode.css" rel="stylesheet" type="text/css" />
<link href="{$config.theme_path}/styles.css" rel="stylesheet" type="text/css" />
<link href="{$config.theme_path}/base.css" rel="stylesheet" type="text/css" />

{script src="js/lib/jquery/jquery.min.js"}
{script src="js/lib/jqueryui/jquery-ui.custom.min.js"}

{script src="js/lib/appear/jquery.appear-1.1.1.js"}

{script src="js/tygh/core.js"}
{script src="js/tygh/ajax.js"}

<script type="text/javascript">
//<![CDATA[
    var index_script = '{""|fn_url:"C":"rel"|escape:javascript nofilter}';
    var changes_warning = '{$settings.Appearance.changes_warning|escape:javascript nofilter}';

    var lang = {$ldelim}
        save: '{__("save")|escape:"javascript"}',
        close: '{__("close")|escape:"javascript"}',
        loading: '{__("loading")|escape:"javascript"}',
        notice: '{__("notice")|escape:"javascript"}',
        warning: '{__("warning")|escape:"javascript"}',
        error: '{__("error")|escape:"javascript"}',
    {$rdelim}

    var images_dir = '{$images_dir}';
    var translate_mode = {if $runtime.customization_mode.translation}true{else}false{/if};
    var cart_language = '{$smarty.const.CART_LANGUAGE}';
    var default_language = '{$smarty.const.DEFAULT_LANGUAGE}';

    {if $config.tweaks.anti_csrf}
        // CSRF form protection key
        var security_hash = '{""|fn_generate_security_hash}';
    {/if}

    $(document).ready(function(){$ldelim}
        jQuery.runCart('C');
    {$rdelim});

//]]>
</script>

{include file="common/loading_box.tpl"}
{include file="common/notification.tpl"}
{include file="common/translate_box.tpl"}
