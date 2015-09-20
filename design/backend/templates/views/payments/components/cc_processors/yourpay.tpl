{assign var="processor" value="YourPay"}
<p>{__("text_linkpoint_notice", ["[processor]" => $processor])}</p>
<hr>

<div class="control-group">
    <label class="control-label" for="store">{__("store_number")}:</label>
    <div class="controls">
        <input type="text" name="payment_data[processor_params][store]" id="store" value="{$processor_params.store}"  size="60">
    </div>
</div>

<div class="control-group">
    <label class="control-label" for="secure_host">{__("secure_host")}:</label>
    <div class="controls">
        <input type="text" name="payment_data[processor_params][secure_host]" id="secure_host" value="{$processor_params.secure_host}"  size="60">&nbsp;:&nbsp;<input type="text" name="payment_data[processor_params][secure_port]" value="{$processor_params.secure_port}"  size="5" class="input-mini">
    </div>
</div>

<div class="control-group">
    <label class="control-label" for="cert_path">{__("certificate_filename")}:</label>
    <div class="controls">
        <div class="text-type-value pull-left">{$smarty.const.DIR_ROOT}/app/payments/certificates/&nbsp;</div>
        <input type="text" name="payment_data[processor_params][cert_path]" id="cert_path" value="{$processor_params.cert_path}"  size="32" class="pull-left">
    </div>
</div>

<div class="control-group">
    <label class="control-label" for="order_prefix">{__("order_prefix")}:</label>
    <div class="controls">
        <input type="text" name="payment_data[processor_params][order_prefix]" id="order_prefix" value="{$processor_params.order_prefix}"  size="60">
    </div>
</div>

<div class="control-group">
    <label class="control-label" for="transaction_type">{__("transaction_type")}:</label>
    <div class="controls">
        <select name="payment_data[processor_params][transaction_type]" id="transaction_type">
            <option value="SALE" {if $processor_params.transaction_type == "SALE"}selected="selected"{/if}>{__("sale")}</option>
            <option value="PREAUTH" {if $processor_params.transaction_type == "PREAUTH"}selected="selected"{/if}>{__("preauth")}</option>
            <option value="POSTAUTH" {if $processor_params.transaction_type == "POSTAUTH"}selected="selected"{/if}>{__("postauth")}</option>
        </select>
    </div>
</div>

<div class="control-group">
    <label class="control-label" for="test">{__("test_live_mode")}:</label>
    <div class="controls">
        <select name="payment_data[processor_params][test]" id="test">
            <option value="DECLINE" {if $processor_params.test == "DECLINE"}selected="selected"{/if}>{__("test")}:{__("declined")}</option>
            <option value="GOOD" {if $processor_params.test == "GOOD"}selected="selected"{/if}>{__("test")}:{__("approved")}</option>
            <option value="LIVE" {if $processor_params.test == "LIVE"}selected="selected"{/if}>{__("live")}</option>
        </select>
    </div>
</div>

<div class="control-group">
    <label class="control-label" for="cvm_check">{__("cvm_check")}:</label>
    <div class="controls">
        <select name="payment_data[processor_params][cvm_check]" id="cvm_check">
            <option value="not_provided" {if $processor_params.cvm_check == "not_provided"}selected="selected"{/if}>{__("cvm_check_no")}</option>
            <option value="provided" {if $processor_params.cvm_check == "provided"}selected="selected"{/if}>{__("cvm_check_yes")}</option>
            <option value="illegible" {if $processor_params.cvm_check == "illegible"}selected="selected"{/if}>{__("cvm_check_unread")}</option>
            <option value="not_present" {if $processor_params.cvm_check == "not_present"}selected="selected"{/if}>{__("cvm_check_no_cvm")}</option>
        </select>
    </div>
</div>