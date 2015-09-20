{if $runtime.simple_ultimate}
	{capture name="mainbox"}
        <h4>{__("error_occured")}</h4>
        <p>{__("simple_ultimate_companies_selector") nofilter}</p>
	{/capture}
{else}
	{capture name="mainbox"}
	    {__("text_select_vendor")} - {include file="common/ajax_select_object.tpl" data_url="companies.get_companies_list?action=href" text=__("select") id=$select_id|default:"top_company_id"}
	{/capture}
{/if}

{include file="common/mainbox.tpl" title=__($title) content=$smarty.capture.mainbox}