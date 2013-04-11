<div class="DesignMainPageBody">
<form action="{$chpu->createChpuUrl("`$smarty.const.CONF_SCRIPT_URL`index.php?ut=$user_type&amp;do=payments&amp;mod=hand")}" method="post">
	<table class="mainBodyTable" cellspacing="0" style="table-layout: fixed; margin: 0 auto;">
		<tr>
			<th>{$smarty.const.HAND_PAY_FORM_HEAD}</th>
		</tr>
	    <tr>
			<td class="last">
        		<p>{$smarty.const.HAND_PAY_NUMBER}:&nbsp;<strong>{$arrData.order_id}</strong></p>
        		<input type="hidden" name="order_id" value="{$arrData.order_id}">
        		<p>{$smarty.const.HAND_PAY_AMOUNT}:&nbsp;<strong>{$arrData.amount}&nbsp;{$smarty.const.HAND_CONF_CURRENCY}</strong></p>
        		<input type="hidden" name="amount" value="{$arrData.amount}">
        		<p>{$smarty.const.HAND_PAY_DESCRIPTION}:&nbsp;<strong>{$arrData.description}</strong></p>
			</td>
		</tr>
	    <tr>
			<td class="last">
       			{$smarty.const.HAND_PAY_SELECT_PAYMENT_TYPE}:&nbsp;<select name="payment">
       			{foreach from=$handPaymentTypes item="payment" key="key"}
       				<option value="{$key}">{$payment}</option>
       			{/foreach}
       			</select>
			</td>
		</tr>
	</table>
    <br>
	<div class="submitButtonLight" style="margin: 0 auto;"><input type="submit" name="pay" value="{$smarty.const.FORM_BUTTON_SEND}" class="shadow01red"></div>
</form>
</div>
