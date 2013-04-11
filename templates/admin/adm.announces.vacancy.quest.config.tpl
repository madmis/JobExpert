<form action="{$smarty.const.CONF_ADMIN_FILE}?m=announces&amp;s=common&amp;action=confQuestVacancy" method="post" enctype="multipart/form-data">
	{* Основные поля анкеты Вакансии *}
	<table style="width: 100%; border: 0px;" cellspacing="2" cellpadding="2">
		<thead class="data_head">
			<tr>
				<td>{$smarty.const.TABLE_VACANCYS_BASIC_FIELDS}</td>
				<td style="width: 20%;">{$smarty.const.TABLE_COLUMN_ALIAS_LIST}</td>
				<td style="width: 15%;">{$smarty.const.TABLE_COLUMN_REQUIRED}</td>
			</tr>
		</thead>
		<tbody class="data_body">
			{foreach from=$arrBasicFields.arrBindFields item="bindFields" key="indexField" name="bindFields"}
				<tr class="tr_hover">
					<td>{$arrDescriptFields.basic.$indexField}</td>
					<td>{$indexField}</td>
					<td style="text-align: center;">
						<input type="checkbox" name="arrBasicFields[arrBindFields][{$indexField}]" value="" checked="checked">
					</td>
				</tr>
			{/foreach}
			{foreach from=$arrBasicFields.arrNoBindFields item="noBindFields" key="indexField" name="noBindFields"}
				<tr class="tr_hover">
					<td>{$arrDescriptFields.basic.$indexField}</td>
					<td>{$indexField}</td>
					<td style="text-align: center;">
						<input type="checkbox" name="arrBasicFields[arrBindFields][{$indexField}]" value="">
					</td>
				</tr>
			{/foreach}
		</tbody>
	</table>
	<p style="text-align: center;"><input type="submit" name="save" value="{$smarty.const.FORM_BUTTON_SAVE}" class="button"></p>
</form>