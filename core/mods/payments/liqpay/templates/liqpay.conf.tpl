<h2 class="modConfCaption" style="text-align: center;">{$smarty.const.LIQPAY_CONFIG_FORM_HEAD}</h2>
<div class="bigPageHelp">
	{$smarty.const.LIQPAY_HELP_SHOP_ENABLE}
</div>
<form action="{$smarty.const.CONF_ADMIN_FILE}?m=mods&amp;s=payments&amp;action=config&amp;id=liqpay" method="post" enctype="multipart/form-data">
<table style="width: 100%;" class="data_table" cellspacing="5" cellpadding="5">
	<tr>
		<td>
			{$smarty.const.LIQPAY_CONFIG_FORM_MERCHANT_ID}
		</td>
		<td>
			<input type="text" name="merchant_id" value="{$smarty.const.LIQPAY_CONF_MERCHANT_ID}">
		</td>
		<td class="mod_help">
			{$smarty.const.LIQPAY_CONFIG_FORM_MERCHANT_ID_HELP}
		</td>
	</tr>
	<tr>
		<td>
			{$smarty.const.LIQPAY_CONFIG_FORM_API_VERSION}
		</td>
		<td>
			<input type="text" name="api_version" value="{$smarty.const.LIQPAY_CONF_API_VERSION}" readonly>
		</td>
		<td class="mod_help">
			{$smarty.const.LIQPAY_CONFIG_FORM_API_VERSION_HELP}
		</td>
	</tr>
	<tr>
		<td>
			{$smarty.const.LIQPAY_CONFIG_FORM_SIGNATURE}
		</td>
		<td>
			<input type="text" name="signature" value="{$smarty.const.LIQPAY_CONF_SIGNATURE}" size="50">
		</td>
		<td class="mod_help">
			{$smarty.const.LIQPAY_CONFIG_FORM_SIGNATURE_HELP}
		</td>
	</tr>
	<tr>
		<td>
			{$smarty.const.LIQPAY_CONFIG_FORM_CURRENCY}
		</td>
		<td>
			<select name="currency">
				<option value="UAH" {if $smarty.const.LIQPAY_CONF_CURRENCY eq 'UAH'}selected{/if}>UAH</option>
				<option value="RUR" {if $smarty.const.LIQPAY_CONF_CURRENCY eq 'RUR'}selected{/if}>RUR</option>
				<option value="USD" {if $smarty.const.LIQPAY_CONF_CURRENCY eq 'USD'}selected{/if}>USD</option>
				<option value="EUR" {if $smarty.const.LIQPAY_CONF_CURRENCY eq 'EUR'}selected{/if}>EUR</option>
			</select>
		</td>
		<td class="mod_help">
			{$smarty.const.LIQPAY_CONFIG_FORM_CURRENCY_HELP}
		</td>
	</tr>
</table>

<p align="center"><input type="submit" name="conf" value="{$smarty.const.FORM_BUTTON_SAVE}" class="button"></p>
</form>

<script type="text/javascript">
$( function() {
	$('.modConfCaption').click( function() {
		$('.bigPageHelp').toggle();
	});
});
</script>

{if $tariffs_template}
	{include file=$tariffs_template}
{/if}