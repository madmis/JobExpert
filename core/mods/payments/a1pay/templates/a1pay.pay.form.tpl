<div class="DesignMainPageBody">
	<table class="mainBodyTable" cellspacing="0" style="table-layout: fixed; margin: 0 auto;">
		<tr>
			<th>{$smarty.const.A1PAY_PAY_FORM_HEAD}</th>
		</tr>
	    <tr>
			<td class="last">
        		<p>{$smarty.const.A1PAY_TEXT_FOR_PAY} <strong>"{$data.description}"</strong> {$smarty.const.A1PAY_TEXT_SEND_SMS}</p>
        		<p><strong>{$data.sms}</strong></p>
        		<p>{$smarty.const.A1PAY_TEXT_SHORT_NUMBER}: <strong>{$data.number}</strong></p>
        		<p>{$smarty.const.A1PAY_TEXT_AFTER_MESSAGE}: <strong>{$data.description}</strong></p>
			</td>
		</tr>
	</table>
</div>