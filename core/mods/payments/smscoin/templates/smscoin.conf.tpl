<h2 class="modConfCaption" style="text-align: center;">{$smarty.const.SMSCOIN_CONFIG_FORM_HEAD}</h2>
<div class="bigPageHelp">
	{$smarty.const.SMSCOIN_HELP_SHOP_ENABLE}
</div>
<form action="{$smarty.const.CONF_ADMIN_FILE}?m=mods&amp;s=payments&amp;action=config&amp;id=smscoin" method="post" enctype="multipart/form-data">
<table style="width: 100%;" class="data_table" cellspacing="5" cellpadding="5">
	<tr>
		<td>
			{$smarty.const.SMSCOIN_CONFIG_FORM_BANK_ID}
		</td>
		<td>
			<input type="text" name="bank_id" value="{$smarty.const.SMSCOIN_CONF_BANK_ID}">
		</td>
		<td class="mod_help">
			{$smarty.const.SMSCOIN_CONFIG_FORM_BANK_ID_HELP}
		</td>
	</tr>
	<tr>
		<td>
			{$smarty.const.SMSCOIN_CONFIG_FORM_BANK_SECRET_CODE}
		</td>
		<td>
			<input type="text" name="bank_secret_code" value="{$smarty.const.SMSCOIN_CONF_BANK_SECRET_CODE}">
		</td>
		<td class="mod_help">
			{$smarty.const.SMSCOIN_CONFIG_FORM_BANK_SECRET_CODE_HELP}
		</td>
	</tr>
	<tr>
		<td>
			{$smarty.const.SMSCOIN_CONFIG_FORM_BANK_CURRENCY}
		</td>
		<td>
			<input type="text" name="bank_currency" value="{$smarty.const.SMSCOIN_CONF_BANK_CURRENCY}" readonly>
		</td>
		<td class="mod_help">
			{$smarty.const.SMSCOIN_CONFIG_FORM_BANK_CURRENCY_HELP}
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