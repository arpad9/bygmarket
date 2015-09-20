{if $runtime.company_id && "ULTIMATE"|fn_allowed_for || "MULTIVENDOR"|fn_allowed_for}
    {include file="common/subheader.tpl" title=__("comments_and_reviews") target="#discussion_product_setting"}
    <div id="discussion_product_setting" class="in collapse">
    	<fieldset>
    		{include file="addons/discussion/views/discussion_manager/components/allow_discussion.tpl" prefix="product_data" object_id=$product_data.product_id object_type="P" title=__("discussion_title_product") non_editable=false}
    	</fieldset>
    </div>
{/if}