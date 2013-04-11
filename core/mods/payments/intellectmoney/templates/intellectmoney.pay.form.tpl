<div class="DesignMainPageBody">
	<table class="mainBodyTable" cellspacing="0" style="table-layout: fixed; margin: 0 auto;">
		<tr>
			<th>{$smarty.const.INTELLECTMONEY_PAY_FORM_HEAD}</th>
		</tr>
	    <tr>
			<td class="last">
        		<p>{$smarty.const.INTELLECTMONEY_PAY_NUMBER}: <strong>{$imData.order_id}</strong></p>
        		<p>{$smarty.const.INTELLECTMONEY_PAY_AMOUNT}: <strong>{$imData.amount} {$smarty.const.INTELLECTMONEY_CONF_CURRENCY}</strong></p>
        		<p>{$smarty.const.INTELLECTMONEY_PAY_DESCRIPTION}: <strong>{$imData.description}</strong></p>
			</td>
		</tr>
	</table>
	<form action="https://Merchant.IntellectMoney.ru/" method="post">
		<input type="hidden" name="lmi_payee_purse" value="{$smarty.const.INTELLECTMONEY_CONF_PAYEE_PURSE}">
		<input type="hidden" name="LMI_PAYMENT_AMOUNT" value="{$imData.amount}">
		<input type="hidden" name="LMI_PAYMENT_NO" value="{$imData.order_id}">
		<input type="hidden" name="LMI_PAYMENT_DESC" value="{$imData.description}">
		<input type="hidden" name="lmi_sim_mode" value="{$smarty.const.INTELLECTMONEY_CONF_SIM_MODE}">
		<input type="hidden" name="SERVICE" value="{$imData.service}">

		<br>
		<div class="submitButtonLight" style="margin: 0 auto;"><input type="submit" value="{$smarty.const.FORM_BUTTON_SEND}" class="shadow01red"></div>
	</form>
</div>