<form action="{$smarty.const.CONF_ADMIN_FILE}?{$qString}" method="post">
	<table class="dataTable100">
		<thead>
			<tr>
				<td>{$smarty.const.TABLE_COLUMN_FILE}</td>
				<td>{$smarty.const.TABLE_COLUMN_SIZE}</td>
				<td>{$smarty.const.TABLE_COLUMN_DATE}</td>
				<td><input type="checkbox" class="checked_all"></td>
			</tr>
		</thead>
		<tbody>
	{if $arrData}
	    {foreach from=$arrData item="file"}
			<tr>
				<td><span class="detail">{$file.name}</span><input type="hidden" value="{$file.name}"></td>
				<td class="alignCenter">{$file.title_sizekb}</td>
				<td class="alignCenter">{$file.date|date_format:$smarty.const.CONF_DATE_FORMAT}&nbsp;{$file.date|date_format:$smarty.const.CONF_TIME_FORMAT}</td>
				<td class="alignCenter"><input type="checkbox" name="files[{$file.name}]" class="checkbox_entry"></td>
			</tr>
	    {/foreach}
		</tbody>
		<tfoot>
			<tr>
				<td class="alignRight" colspan="6">
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
				<td colspan="6" class="alignCenter">{$smarty.const.TABLE_NOT_DATA}</td>
			</tr>
		</tbody>
	{/if}
	</table>
</form>

<div id="logsDialog" style="display: none;"></div>

<script type="text/javascript">
<!--
$( function() {
	/***** Functions *****/
	$.fn.showDialog = function(id) {
		$('#logsDialog').dialog({
			autoOpen: true,
			modal: true,
			//open: function () { $(this).html( data ); },
			height: 500,
			width: 900,
			title: id,
			buttons: { '{$smarty.const.SITE_CLOSE}': function() { $(this).dialog('close'); } },
			close: function() { $(this).dialog('option', { beforeClose: function() { } }); }
		});
		return false;
	}

	//Подробный просмотр
	$('.detail').click(function() {
		$('#overlay, #dialog').show();
		var id = $(this).next('input').val();

		$.ajax({ type: 'post', url: '/admajax.php',
			data: ({ getUpdatesLogsDetail: id }),
			success: function( data ) {
				if ('errorFileNotExists' == data) {
					$.alert('{$smarty.const.ERROR_FILE_NOT_EXISTS}');
				} else if ('errorUncorrectParams' == data) {
					$.alert('{$smarty.const.ERROR_FATAL_UNCORRECT_PARAMS}');
				} else {
					$('#logsDialog').html( data );
					$('#logsDialog').showDialog(id);
				}
				$('#overlay, #dialog').hide();
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
