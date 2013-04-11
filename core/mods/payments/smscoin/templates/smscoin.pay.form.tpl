<div class="DesignMainPageBody">
	<table class="mainBodyTable" cellspacing="0" style="table-layout: fixed; margin: 0 auto;">
		<tr>
			<th>{$smarty.const.SMSCOIN_PAY_FORM_HEAD}</th>
		</tr>
	    <tr>
			<td class="last">
        		<p>{$smarty.const.SMSCOIN_PAY_NUMBER}: <strong>{$smsData.order_id}</strong></p>
        		<p>{$smarty.const.SMSCOIN_PAY_AMOUNT}: <strong>{$smsData.amount} {$smarty.const.SMSCOIN_CONF_BANK_CURRENCY}</strong></p>
        		<p>{$smarty.const.SMSCOIN_PAY_DESCRIPTION}: <strong>{$smsData.description}</strong></p>
			</td>
		</tr>
	</table>
	<form action="http://bank.smscoin.com/bank/" method="post" enctype="multipart/form-data">
		<input name="s_purse" type="hidden" value="{$smarty.const.SMSCOIN_CONF_BANK_ID}">
		<input name="s_order_id" type="hidden" value="{$smsData.order_id}">
		<input name="s_amount" type="hidden" value="{$smsData.amount}">
		<input name="s_clear_amount" type="hidden" value="{$smsData.clear_amount}">
		<input name="s_description" type="hidden" value="{$smsData.description}">
		<input name="s_sign" type="hidden" value="{$smsData.sign}">
		<input name="sd_service" type="hidden" value="{$smsData.service}">
		<br>
		<div class="submitButtonLight" style="margin: 0 auto;"><input type="submit" value="{$smarty.const.FORM_BUTTON_SEND}" class="shadow01red"></div>
	</form>
</div>
