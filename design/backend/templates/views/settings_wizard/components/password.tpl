<div class="control-group setting-wide">
    <label for="password_field" class="control-label">{__("new_administrator_password")}:</label>
    <div class="controls">
        <input type="password" value="" id="password_field" name="new_password"><br>
        <a class="cm-show-password a-pseudo" data-ca-result-id="password_field">{__("show")}</a> <a class="cm-generate-password a-pseudo" data-ca-result-id="password_field">{__("generate")}</a>
    </div>
</div>

{literal}
<script type="text/javascript">
//<![CDATA[
    (function($, _){
        $('.cm-show-password').on('click', function(e){
            $('#' + $(this).data('caResultId')).prop('type', 'text');
        });

        $('.cm-generate-password').on('click', function(e){
            $('#' + $(this).data('caResultId')).val(Math.random().toString(36).slice(-10)).prop('type', 'text');
        });
    })(Tygh.$, Tygh);
//]]>
</script>
{/literal}