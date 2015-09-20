<div id="conflicts_content_{$package_id}">
    {$result_ids = "conflicts_content_`$package_id`"}
    <table class="table table-condensed">
        <thead>
            <tr>
                <th>{__("files")}</th>
                <th class="left">{__("status")}</th>
            </tr>
        </thead>
        <tbody>
            {foreach $package.conflicts as $file_id => $file_data}
                <tr>
                    <td>
                        {$file_data.file_path}
                    </td>
                    <td width="10%" class="left">
                        {if $file_data.status == "C"}
                            <div class="btn-group dropleft">
                                <button class="btn btn-danger btn-small dropdown-toggle" data-toggle="dropdown">{__("conflicts")} <span class="caret"></span></button>
                                <ul class="dropdown-menu">
                                    <li><a href="{"upgrade_center.resolve_conflict?package_id=$package_id&file_id=$file_id&status=R"|fn_url}" class="cm-ajax" data-ca-target-id="{$result_ids}">{__("resolved")}</a></li>
                                </ul>
                            </div>
                        {elseif $file_data.status == "R"}
                            <div class="btn-group dropleft">
                                <button class="btn btn-success btn-small dropdown-toggle" data-toggle="dropdown">{__("resolved")} <span class="caret"></span></button>
                                <ul class="dropdown-menu">
                                    <li><a href="{"upgrade_center.resolve_conflict?package_id=$package_id&file_id=$file_id&status=C"|fn_url}" class="cm-ajax" data-ca-target-id="{$result_ids}">{__("conflicts")}</a></li>
                                </ul>
                            </div>
                        {/if}
                        
                    </td>
                </tr>
            {/foreach}
        </tbody>
    </table>

    <div class="buttons-container">
        <a class="cm-dialog-closer cm-cancel tool-link btn">{__("close")}</a>
    </div>

<!--conflicts_content_{$package_id}--></div>