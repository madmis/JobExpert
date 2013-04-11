<div class="DesignMainPageBody">
	<h2>Счет на оплату 
		{* Данная ссылка ведет на странице печати счета. Не изменяйте данную ссылку *}
		<a style="float: right;" href="{$smarty.const.CONF_SCRIPT_URL}index.php?ut={$user_type}&do=payments&mod=jur&print" rel="nofollow" target="_blank">
    		<img src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/icons/print_16.png" alt="Печать счета" title="Печать счета">
		</a>
	</h2>
	<table>
		<tr>
			<td style="text-align: right;">ИНН</td>
			<td style="padding-left: 10px; font-weight: bold;">{$postData.myData.cInn}</td>
		</tr>
		<tr>
			<td style="text-align: right;">Получатель</td>
			<td style="padding-left: 10px; font-weight: bold;">{$postData.myData.cName}</td>
		</tr>
		<tr>
			<td style="text-align: right;">Адрес</td>
			<td style="padding-left: 10px; font-weight: bold;">{$postData.myData.cCity}</td>
		</tr>
		<tr>
			<td style="text-align: right;">Р/счет</td>
			<td style="padding-left: 10px; font-weight: bold;">{$postData.myData.cAcc}</td>
		</tr>
	</table>
	<hr>
	<table>
		<tr>
			<td style="font-weight: bold;" colspan="2">Счет #{$arrData.order_id} от {$smarty.now|date_format:$smarty.const.CONF_DATE_FORMAT}</td>
		</tr>
		<tr>
			<td style="text-align: right;">ИНН</td>
			<td style="padding-left: 10px; font-weight: bold;">{$arrBindFields.inn}</td>
		</tr>
		<tr>
			<td style="text-align: right;">Плательщик</td>
			<td style="padding-left: 10px; font-weight: bold;">{$arrBindFields.company_name}</td>
		</tr>
		<tr>
			<td style="text-align: right;">Адрес</td>
			<td style="padding-left: 10px; font-weight: bold;">{$arrBindFields.address}</td>
		</tr>
		{if $arrNoBindFields.phone}
		<tr>
			<td style="text-align: right;">Телефон</td>
			<td style="padding-left: 10px; font-weight: bold;">{$arrNoBindFields.phone}</td>
		</tr>
		{/if}
	</table>
	
	<table style="width: 90%; margin: 20px 0 0 40px; border-spacing: 1px; background-color: #000000;">
		<tr style="background-color: #f5f6f6;">
			<td style="padding: 5px;">Наименование работ (услуг)</td>
			<td style="padding: 5px;">Валюта</td>
			<td style="padding: 5px; text-align: right; font-weight: bold;">Сумма</td>
		</tr>
		<tr style="background-color: #f5f6f6;">
			<td style="padding: 10px 5px;">{$arrData.description}</td>
			<td style="padding: 10px 5px;">{$arrBindFields.currency}</td>
			<td style="padding: 10px 5px; text-align: right; font-weight: bold;">{$arrData.amount}</td>
		</tr>	        
    </table>
    <p style="text-align: right; margin-right: 30px; margin-top: 30px;"><strong>Сумма к оплате: {$arrData.amount}&nbsp;{$arrBindFields.currency}</strong></p>
</div>