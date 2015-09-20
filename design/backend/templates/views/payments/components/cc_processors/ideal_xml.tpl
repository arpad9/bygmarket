<div class="control-group">
    <label class="control-label" for="merchant_id">{__("merchant_id")}:</label>
    <div class="controls">
        <input type="text" name="payment_data[processor_params][merchant_id]" id="merchant_id" value="{$processor_params.merchant_id}"  size="60">
    </div>
</div>

<div class="control-group">
    <label class="control-label" for="merchant_key">{__("secret_key")}:</label>
    <div class="controls">
        <input type="text" name="payment_data[processor_params][merchant_key]" id="merchant_key" value="{$processor_params.merchant_key}"   size="60">
    </div>
</div>

<div class="control-group">
    <label class="control-label" for="description">{__("description")}:</label>
    <div class="controls">
        <input type="text" name="payment_data[processor_params][description]" id="description" value="{$processor_params.description}"   size="60">
    </div>
</div>

<div class="control-group">
    <label class="control-label" for="language">{__("language")}:</label>
    <div class="controls">
        <select name="payment_data[processor_params][language]" id="language">
            <option value="NL"{if $processor_params.language == "NL"} selected="selected"{/if}>{__("dutch")}
            <option value="en"{if $processor_params.language == "en"} selected="selected"{/if}>{__("english")}
            <option value="DE"{if $processor_params.language == "DE"} selected="selected"{/if}>{__("german")}
            <option value="FR"{if $processor_params.language == "FR"} selected="selected"{/if}>{__("french")}
        </select>
    </div>
</div>

<div class="control-group">
    <label class="control-label" for="test">{__("test_live_mode")}:</label>
    <div class="controls">
        <select name="payment_data[processor_params][test]" id="test">
            <option value="0" {if $processor_params.test == "0"}selected="selected"{/if}>{__("live")}</option>
            <option value="1" {if $processor_params.test == "1"}selected="selected"{/if}>{__("test")}</option>
        </select>
    </div>
</div>

<div class="control-group">
    <label class="control-label" for="payment_type">{__("payment_type")}:</label>
    <div class="controls">
        <select name="payment_data[processor_params][payment_type]" id="payment_type">
            <option value="bn"{if $processor_params.payment_type == "bn"} selected="selected"{/if}>{__("bank")}
            <option value="cc"{if $processor_params.payment_type == "cc"} selected="selected"{/if}>{__("credit_card")}
        </select>
    </div>
</div>

<div class="control-group">
    <label class="control-label" for="currency">{__("currency")}:</label>
    <div class="controls">
        <select name="payment_data[processor_params][currency]" id="currency">
            <option value="EUR" {if $processor_params.currency == "EUR"}selected="selected"{/if}>{__("currency_code_eur")}</option>
        </select>
    </div>
</div>