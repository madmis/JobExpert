<form action="{$smarty.const.CONF_ADMIN_FILE}?{$qString}" method="post">
	<table class="dataTable100">
		<thead>
			<tr>
				<td>{$smarty.const.TABLE_COLUMN_ID}</td>
				<td>{$smarty.const.TABLE_COLUMN_FILE}</td>
				<td><input type="checkbox" class="checked_all"></td>
			</tr>
		</thead>
		<tbody>
	{if $arrFiles}
		{foreach from=$arrFiles item="file" name="i"}
			<tr>
				<td class="alignCenter">{$smarty.foreach.i.iteration}</td>
				<td>
					<span class="detail">{$file}</span>
					<input type="hidden" value="{$file}">
				</td>
				<td class="alignCenter"><input type="checkbox" name="files[{$file}]" class="checkbox_entry"></td>
			</tr>
		{/foreach}
		</tbody>
		<tfoot>
			<tr>
				{*
				<td colspan="2">
					{$smarty.const.TABLE_RECORDS} {$smarty.foreach.i.total}
				</td>
				*}
				<td class="alignRight" colspan="3">
					<span style="float: left;">{$smarty.const.TABLE_RECORDS} {$smarty.foreach.i.total}</span>
					<select name="action">
						<option value="">{$smarty.const.FORM_ACTION_SELECT}</option>
						<option value="deleted">{$smarty.const.FORM_ACTION_DELETE_SELECTED}</option>
					</select>
					<input type="submit" value="{$smarty.const.FORM_BUTTON_EXECUTE}" class="button">
				</td>
			</tr>
		</tfoot>
	{else}
			<tr>
				<td colspan="3" class="alignCenter">{$smarty.const.TABLE_NOT_DATA}</td>
			</tr>
		</tbody>
	{/if}
	</table>
</form>

<script type="text/javascript">
	<!--
	$( function() {
		//просмотр файла
		$('.detail').click(function() {
			$('#overlay, #dialog').show();
			var file = $(this).next('input').val();

			$.ajax({ type: 'post', url: '/admajax.php',
				data: ({ getLogPaymentsFileDetail: file }),
				success: function(data) {
					$('#overlay, #dialog').hide();
					$.colorbox({ html: data, width: '80%', height: '90%', opacity: 0, scrolling: true });
				}
			});
		});

		//включаем все переключатели в таблице
		$('.checked_all').click(function() {
			(!$(this).is(':checked')) ? $('.checkbox_entry').removeAttr('checked') : $('.checkbox_entry').attr('checked', 'checked');
		});

		// проверяем выбранное действие
		$("form:last").submit( function() {
			if (!$('select[name="action"] option:selected').val()) {
				$.alert('{$smarty.const.ERROR_NOT_SELECT_ACTION}');
				return false;
			} else {
				if (!$('form:last input:checked').size()) {
					$.alert('{$smarty.const.MESSAGE_WARNING_NOT_SELECT_RECORDS}');
					return false;
				}

				return ( $("select[name='action'] option:selected").val() === 'deleted' ) ? confirm('{$smarty.const.MESSAGE_DELETE_RECORDS}') : true;
			}
		});
	});
	-->
</script>
