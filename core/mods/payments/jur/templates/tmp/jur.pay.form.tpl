<div class="DesignMainPageBody">
{* Форма отправки платежа !!!Не меняйте action формы *}
{* Все поля, отправленные из данной формы, доступны в шаблоне квитанции по префиксу $postData (см. пример в шаблоне квитанции) *}
<form action="{$chpu->createChpuUrl("`$smarty.const.CONF_SCRIPT_URL`index.php?ut=$user_type&amp;do=payments&amp;mod=jur")}" method="post">
	<table class="mainBodyTable" cellspacing="0" style="table-layout: fixed; margin: 0 auto;">
		<tr>
			<th>{$smarty.const.JUR_PAY_FORM_HEAD}</th>
		</tr>
		<tr>
			<td class="last">
				{* Номер платежа. *}
				{* Скрытое поле с номером платежа обязательно должно присутствовать в форме *}
				<p>{$smarty.const.JUR_PAY_NUMBER}:&nbsp;<strong>{$arrData.order_id}</strong></p>
				<input type="hidden" name="order_id" value="{$arrData.order_id}">
				{* Сумма платежа. *}
				{* Скрытое поле с суммой платежа обязательно должно присутствовать в форме *}
				<p>{$smarty.const.JUR_PAY_AMOUNT}:&nbsp;<strong>{$arrData.amount}&nbsp;грн.</strong></p>
				<input type="hidden" name="arrBindFields[currency]" value="грн.">
				<input type="hidden" name="amount" value="{$arrData.amount}">
				<p>{$smarty.const.JUR_PAY_DESCRIPTION}:&nbsp;<strong>{$arrData.description}</strong></p>
				
				{* Скрытые поля пользовательских данны *}
				{* Даные поля никак не обрабатываются. Они просто передаются в шаблон квитанции *}
				{* Данные поля для удобства можно обернуть, например в массив myData *}
				<input type="hidden" name="myData[cInn]" value="0123456">
				<input type="hidden" name="myData[cName]" value="SD-Group">
				<input type="hidden" name="myData[cCity]" value="г. Киев">
				<input type="hidden" name="myData[cAcc]" value="789456123789425">
			</td>
		</tr>
		<tr>
			<td class="last">
				<table style="width: 60%; margin: 0 auto;">
				{* Пользовательские поля платежной формы *}
				{* Обрабатываются и проверяются только поля в массивах arrBindFields и arrNoBindFields *}
				{* Обязательные поля должны быть помещены в массив arrBindFields *}
				{* Не обязательные поля должны быть помещены в массив arrNoBindFields *}
				{* В шаблоне можно использовать JavaScript *}
					<tr>
						<td>{$smarty.const.JUR_CONST_CUSTOM_PAY_INPUT_FIO}:<span style="color: #CC3333;">*</span></td>
						<td><input type="text" name="arrBindFields[fio]" value=""></td>
					</tr>
					<tr>
						<td>{$smarty.const.JUR_CONST_CUSTOM_PAY_INPUT_ADDRESS}:<span style="color: #CC3333;">*</span></td>
						<td><input type="text" name="arrBindFields[address]" value=""></td>
					</tr>
					<tr>
						<td>{$smarty.const.JUR_CONST_CUSTOM_PAY_INPUT_COMPANY_NAME}:<span style="color: #CC3333;">*</span></td>
						<td><input type="text" name="arrBindFields[company_name]" value=""></td>
					</tr>
					<tr>
						<td>{$smarty.const.JUR_CONST_CUSTOM_PAY_INPUT_INN}:<span style="color: #CC3333;">*</span></td>
						<td><input type="text" name="arrBindFields[inn]" value=""></td>
					</tr>
					<tr>
						<td>{$smarty.const.JUR_CONST_CUSTOM_PAY_INPUT_PHONE}:</td>
						<td><input type="text" name="arrNoBindFields[phone]" value=""></td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
	<br>
	<div class="submitButtonLight" style="margin: 0 auto;"><input type="submit" name="pay" value="{$smarty.const.FORM_BUTTON_SEND}" class="shadow01red"></div>
</form>
</div>