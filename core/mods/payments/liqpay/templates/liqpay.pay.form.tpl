<div class="DesignMainPageBody">
	<table class="mainBodyTable" cellspacing="0" style="table-layout: fixed; margin: 0 auto;">
		<tr>
			<th>{$smarty.const.LIQPAY_PAY_FORM_HEAD}</th>
		</tr>
	    <tr>
			<td class="last">
        		<p>{$smarty.const.LIQPAY_PAY_NUMBER}: <strong>{$lpData.order_id}</strong></p>
        		<p>{$smarty.const.LIQPAY_PAY_AMOUNT}: <strong>{$lpData.amount} {$smarty.const.LIQPAY_CONF_CURRENCY}</strong></p>
        		<p>{$smarty.const.LIQPAY_PAY_DESCRIPTION}: <strong>{$lpData.description}</strong></p>
			</td>
		</tr>
	</table>
	<form action="https://liqpay.com/?do=clickNbuy" method="post" enctype="multipart/form-data">
		<input type="hidden" name="operation_xml" value="{$operation_xml}">
		<input type="hidden" name="signature" value="{$signature}">
			<br>
			<div class="submitButtonLight" style="margin: 0 auto;"><input type="submit" value="{$smarty.const.FORM_BUTTON_SEND}" class="shadow01red"></div>
	</form>
</div>