<h2 class="modConfCaption" style="text-align: center;">{$smarty.const.WEBMONEY_CONFIG_FORM_HEAD}</h2>
<div class="bigPageHelp">
	{$smarty.const.WEBMONEY_HELP_SHOP_ENABLE}
</div>
<form action="{$smarty.const.CONF_ADMIN_FILE}?m=mods&amp;s=payments&amp;action=config&amp;id=webmoney" method="post" enctype="multipart/form-data">
<table style="width: 100%;" class="data_table" cellspacing="5" cellpadding="5">
	<tr>
		<td>{$smarty.const.WEBMONEY_CONFIG_FORM_PAYEE_PURSE}</td>
		<td><input type="text" name="payee_purse" value="{$smarty.const.WEBMONEY_CONF_PAYEE_PURSE}"></td>
		<td class="mod_help">{$smarty.const.WEBMONEY_CONFIG_FORM_PAYEE_PURSE_HELP}</td>
	</tr>
	<tr>
		<td>{$smarty.const.WEBMONEY_CONFIG_FORM_SECRET_KEY}</td>
		<td><input type="text" name="secret_key" value="{$smarty.const.WEBMONEY_CONF_SECRET_KEY}" size="50"></td>
		<td class="mod_help">{$smarty.const.WEBMONEY_CONFIG_FORM_SECRET_KEY_HELP}</td>
	</tr>
	<tr>
		<td>{$smarty.const.WEBMONEY_CONFIG_FORM_PAYEE_CURRENCY}</td>
		<td>
			<select name="currency">
				<option value="WMZ" {if $smarty.const.WEBMONEY_CONF_CURRENCY eq 'WMZ'}selected{/if}>WMZ</option>
				<option value="WME" {if $smarty.const.WEBMONEY_CONF_CURRENCY eq 'WME'}selected{/if}>WME</option>
				<option value="WMU" {if $smarty.const.WEBMONEY_CONF_CURRENCY eq 'WMU'}selected{/if}>WMU</option>
				<option value="WMR" {if $smarty.const.WEBMONEY_CONF_CURRENCY eq 'WMR'}selected{/if}>WMR</option>
			</select>
		</td>
		<td class="mod_help">{$smarty.const.WEBMONEY_CONFIG_FORM_PAYEE_CURRENCY_HELP}</td>
	</tr>
	<tr>
		<td>{$smarty.const.WEBMONEY_CONFIG_FORM_SIM_MODE}</td>
		<td>
			<label><input type="radio" name="sim" value="0" {if !$smarty.const.WEBMONEY_CONF_SIM}checked{/if}>&nbsp;{$smarty.const.WEBMONEY_CONFIG_FORM_DISABLE}</label>
			<label><input type="radio" name="sim" value="1" {if $smarty.const.WEBMONEY_CONF_SIM}checked{/if}>&nbsp;{$smarty.const.WEBMONEY_CONFIG_FORM_ENABLE}</label>&nbsp;&nbsp;&nbsp;&nbsp;
			<select name="sim_mode">
				<option value="0" {if $smarty.const.WEBMONEY_CONF_SIM_MODE eq '0'}selected{/if}>0</option>
				<option value="1" {if $smarty.const.WEBMONEY_CONF_SIM_MODE eq '1'}selected{/if}>1</option>
				<option value="2" {if $smarty.const.WEBMONEY_CONF_SIM_MODE eq '2'}selected{/if}>2</option>
			</select>
		</td>
		<td class="mod_help">{$smarty.const.WEBMONEY_CONFIG_FORM_SIM_MODE_HELP}</td>
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