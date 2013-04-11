{if $errors}{include file="errors.message.tpl"}{/if}

<form action="{$smarty.const.CONF_ADMIN_FILE}?m=logs&amp;s=admin" method="post" enctype="multipart/form-data">
<table cellspacing="3" cellpadding="3">
	<thead class="data_head">
		<tr>
			<td style="text-align: center;">-</td>
			<td style="text-align: center;">{$smarty.const.TABLE_COLUMN_LOGIN}</td>
			<td style="text-align: center;">{$smarty.const.TABLE_COLUMN_IP}</td>
			<td style="text-align: center;">{$smarty.const.TABLE_COLUMN_USER_ID}</td>
			<td style="text-align: center;">{$smarty.const.TABLE_COLUMN_USER_LOGIN}</td>
			<td style="text-align: center;">{$smarty.const.TABLE_COLUMN_DATE}</td>
		</tr>
	</thead>
	<tbody class="data_body">
	{if $logData}
		{foreach from=$logData item="data" name="i"}
			<tr>
				<td>{if $data.password eq 'true'}
						<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/icons/yes.png">
					{else}
						<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/icons/no.png">
					{/if}
				</td>
				<td>{$data.login}</td>
				<td>{$data.ip}</td>
				<td>{$data.user_id}</td>
				<td>{$data.user_login}</td>
				<td>{$data.datetime|date_format:$smarty.const.CONF_DATE_FORMAT} {$data.datetime|date_format:'%H:%M:%S'}</td>
			</tr>
		{/foreach}
		</tbody>
		<tfoot class="data_foot">
			<tr>
				<td style="text-align: center;" colspan="4">
					{$smarty.const.TABLE_RECORDS} {$smarty.foreach.i.total}
				</td>
				<td colspan="2" style="text-align: right;">
					<select name="action" class="select">
						<option value="">{$smarty.const.FORM_ACTION_SELECT}</option>
						<option value="clear">{$smarty.const.FORM_ACTION_CLEAR_LOGS}</option>
					</select>
					<input type="submit" value="{$smarty.const.FORM_BUTTON_EXECUTE}" class="button">
				</td>
			</tr>
		</tfoot>
	{else}
		<tr>
			<td style="text-align: center;" colspan="6">{$smarty.const.TABLE_NOT_DATA}</td>
		</tr>
	</tbody>
	{/if}
</table>
</form>

<script type="text/javascript">
<!--
$(function() {
	// проверяем выбранное действие
	$("form:last").submit( function() {
		if (!$('select[name="action"] option:selected').val()) {
			$.alert('{$smarty.const.ERROR_NOT_SELECT_ACTION}');
			return false;
		} else {
			return ( $("select[name='action'] option:selected").val() === 'clear' ) ? confirm('{$smarty.const.MESSAGE_CLEAR_LOGS}') : true;
		}
	});
});
-->
</script>