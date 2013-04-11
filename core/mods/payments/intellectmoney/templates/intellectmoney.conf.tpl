<h2 class="modConfCaption" style="text-align: center;">{$smarty.const.INTELLECTMONEY_CONFIG_FORM_HEAD}</h2>
<div class="bigPageHelp">
	{$smarty.const.INTELLECTMONEY_HELP_SHOP_ENABLE}
</div>
<form action="{$smarty.const.CONF_ADMIN_FILE}?m=mods&amp;s=payments&amp;action=config&amp;id=intellectmoney" method="post" enctype="multipart/form-data">
<table style="width: 100%;" class="data_table" cellspacing="5" cellpadding="5">
	<tr>
		<td>{$smarty.const.INTELLECTMONEY_CONFIG_FORM_PAYEE_PURSE}</td>
		<td><input type="text" name="payee_purse" value="{$smarty.const.INTELLECTMONEY_CONF_PAYEE_PURSE}"></td>
		<td class="mod_help">{$smarty.const.INTELLECTMONEY_CONFIG_FORM_PAYEE_PURSE_HELP}</td>
	</tr>
	<tr>
		<td>{$smarty.const.INTELLECTMONEY_CONFIG_FORM_SECRET_KEY}</td>
		<td><input type="text" name="secret_key" value="{$smarty.const.INTELLECTMONEY_CONF_SECRET_KEY}" size="50"></td>
		<td class="mod_help">{$smarty.const.INTELLECTMONEY_CONFIG_FORM_SECRET_KEY_HELP}</td>
	</tr>
	<tr>
		<td>{$smarty.const.INTELLECTMONEY_CONFIG_FORM_PAYEE_CURRENCY}</td>
		<td>
			<select name="currency">
				<option value="RUB" {if $smarty.const.INTELLECTMONEY_CONF_CURRENCY eq 'RUR'}selected{/if}>RUR</option>
				<option value="TST" {if $smarty.const.INTELLECTMONEY_CONF_CURRENCY eq 'TST'}selected{/if}>TST</option>
			</select>
		</td>
		<td class="mod_help">{$smarty.const.INTELLECTMONEY_CONFIG_FORM_PAYEE_CURRENCY_HELP}</td>
	</tr>
	<tr>
		<td>{$smarty.const.INTELLECTMONEY_CONFIG_FORM_SIM_MODE}</td>
		<td>
			<label><input type="radio" name="sim_mode" value="0" {if !$smarty.const.INTELLECTMONEY_CONF_SIM_MODE}checked{/if}>&nbsp;{$smarty.const.INTELLECTMONEY_CONFIG_FORM_DISABLE}</label>
			<label><input type="radio" name="sim_mode" value="1" {if $smarty.const.INTELLECTMONEY_CONF_SIM_MODE}checked{/if}>&nbsp;{$smarty.const.INTELLECTMONEY_CONFIG_FORM_ENABLE}</label>
		</td>
		<td class="mod_help">{$smarty.const.INTELLECTMONEY_CONFIG_FORM_SIM_MODE_HELP}</td>
	</tr>
</table>

<p style="text-align: center"><input type="submit" name="conf" value="{$smarty.const.FORM_BUTTON_SAVE}" class="button"></p>
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