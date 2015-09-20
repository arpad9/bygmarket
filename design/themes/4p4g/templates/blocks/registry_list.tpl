{** block-description:registry_list **}
<style>
.regdelim{
	font-size: 7px;
    height: 1px;
    line-height: 7px;
    margin: 0;
    padding: 0;
    border-bottom: 1px solid #CCCCCC;
}
.registryListContainer{ width: 200px;}
.registryListContainer a, .registryListContainer a { color:#808080 !important;}
.registryListContainer ul{ padding: 0px; margin: 5px 20px;}
.registryListContainer ul li{
	list-style-type: none;
}
</style>
{capture name="title"}
    <a style="color:#808080;">Wish List</a>
{/capture}

<div id="registry_list_{$block.snapping_id}" class="registryListContainer">
    {assign var="return_current_url" value=$config.current_url|escape:url}
    <ul class="">
		<li><a href="{"wishlists.update"|fn_url}" rel="nofollow" class="underlined">Create a Wish List</a></li>
		<li><a href="{"wishlistregistry.search"|fn_url}" rel="nofollow" class="underlined">Find a Wish List or Registry</a></li>
    </ul>
    <div class="regdelim"></div>
    <ul class="">
		<li><a href="{"wregistry.home"|fn_url}" rel="nofollow" class="underlined">Wedding Registry</a></li>
		<li><a href="{"bbregistry.home"|fn_url}" rel="nofollow" class="underlined">Baby Registry</a></li>
		<li><a href="{"bregistry.home"|fn_url}" rel="nofollow" class="underlined">Birthday Registry</a></li>
		<li><a href="{"hgregistry.home"|fn_url}" rel="nofollow" class="underlined">Holiday or Gift Registry</a></li>
    </ul>
<!--registry_list_{$block.snapping_id}--></div>
