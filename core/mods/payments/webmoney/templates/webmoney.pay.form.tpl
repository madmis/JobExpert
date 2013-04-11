<div class="DesignMainPageBody">
	<table class="mainBodyTable" cellspacing="0" style="table-layout: fixed; margin: 0 auto;">
		<tr>
			<th>{$smarty.const.WEBMONEY_PAY_FORM_HEAD}</th>
		</tr>
	    <tr>
			<td class="last">
        		<p>{$smarty.const.WEBMONEY_PAY_NUMBER}: <strong>{$wmData.order_id}</strong></p>
        		<p>{$smarty.const.WEBMONEY_PAY_AMOUNT}: <strong>{$wmData.amount} {$smarty.const.WEBMONEY_CONF_CURRENCY}</strong></p>
        		<p>{$smarty.const.WEBMONEY_PAY_DESCRIPTION}: <strong>{$wmData.description}</strong></p>
			</td>
		</tr>
	</table>
	<form action="https://merchant.webmoney.ru/lmi/payment.asp" method="post">
		<input type="hidden" name="LMI_PAYEE_PURSE" value="{$smarty.const.WEBMONEY_CONF_PAYEE_PURSE}">
		<input type="hidden" name="LMI_PAYMENT_AMOUNT" value="{$wmData.amount}">
		<input type="hidden" name="LMI_PAYMENT_NO" value="{$wmData.order_id}">
		<input type="hidden" name="LMI_PAYMENT_DESC" value="{$wmData.description}">
		<input type="hidden" name="LMI_PAYMENT_DESC_BASE64" value="{$wmData.description64}">
		{if $smarty.const.WEBMONEY_CONF_SIM}<input type="hidden" name="LMI_SIM_MODE" value="{$smarty.const.WEBMONEY_CONF_SIM_MODE}">{/if}
		<input type="hidden" name="SERVICE" value="{$wmData.service}">

		<br>
		<div class="submitButtonLight" style="margin: 0 auto;"><input type="submit" value="{$smarty.const.FORM_BUTTON_SEND}" class="shadow01red"></div>
	</form>
</div>