<form action="{$smarty.const.CONF_ADMIN_FILE}?{$qString}" method="post">
<table class="dataTable100">
	<thead>
		<tr>
			<td>{$smarty.const.TABLE_COLUMN_ID}</td>
			<td>{$smarty.const.TABLE_COLUMN_TITLE}</td>
			<td>{$smarty.const.FORM_COMMENTS}</td>
			<td>{$smarty.const.TABLE_COLUMN_USER_ID}</td>				
			<td>{$smarty.const.TABLE_COLUMN_AUTHOR}</td>				
			<td>{$smarty.const.TABLE_COLUMN_DATE}</td>
			<td>{$smarty.const.TABLE_COLUMN_UNTIL}</td>
			<td><input type="checkbox" class="checked_all"></td>
		</tr>
	</thead>
	<tbody>
{if $arrNewses}
	{foreach from=$arrNewses item="arrNews" name="i"}
		<tr>
			<td class="alignCenter">{$arrNews.id}</td>
			<td title="{$arrNews.title|escape}">
				<span class="detail">{$arrNews.title|truncate}</span>
				<input type="hidden" value="{$arrNews.id}">
			</td>
			<td class="alignCenter">
				{if $arrNews.comments}
					<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/icons/yes.png" alt="{$smarty.const.SITE_ISSET}">
				{else}
					<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/icons/no.png" alt="{$smarty.const.SITE_NO}">
				{/if}
			</td>
			<td class="alignCenter">
				{if $arrNews.id_user}
					<a href="{$smarty.const.CONF_ADMIN_FILE}?m=users&amp;s=manager&amp;action=detail&amp;id={$arrNews.id_user}" target="_blank">{$arrNews.id_user}</a>
				{else}
					{$arrNews.id_user}
				{/if}
			</td>
			<td class="alignCenter">{$arrNews.author}</td>
			<td class="alignCenter" style="white-space: nowrap;">
				{$arrNews.datetime|date_format:$smarty.const.CONF_DATE_FORMAT}&nbsp;{$arrNews.datetime|date_format:$smarty.const.CONF_TIME_FORMAT}
			</td>
			<td class="alignCenter" style="white-space: nowrap;">
				{$arrNews.token_datetime|date_format:$smarty.const.CONF_DATE_FORMAT}&nbsp;{$arrNews.token_datetime|date_format:$smarty.const.CONF_TIME_FORMAT}
			</td>
			<td class="alignCenter">
				<input type="checkbox" name="news[{$arrNews.id}]" class="checkbox_entry">
			</td>
		</tr>
	{/foreach}
	</tbody>
	<tfoot>
		<tr>
			<td colspan="5" class="alignCenter">{$smarty.const.TABLE_RECORDS} {$smarty.foreach.i.total}/{$allRecords}</td>
			<td colspan="5" class="alignRight">
				<select name="action">
					<option value="">{$smarty.const.FORM_ACTION_SELECT}</option>
					<option value="active">{$smarty.const.FORM_ACTION_ACTIVATE_SELECTED}</option>
					<option value="deleted">{$smarty.const.FORM_ACTION_DELETE_SELECTED}</option>
				</select>
				<input type="submit" value="{$smarty.const.FORM_BUTTON_EXECUTE}" class="button">
			</td>
		</tr>
	</tfoot>
{else}
		<tr><td class="alignCenter" colspan="10">{$smarty.const.TABLE_NOT_DATA}</td></tr>
	</tbody>
{/if}
</table>
</form>

<p class="alignCenter">{$strPages}</p>

<script type="text/javascript">
<!--
$( function() {
	//Подробный просмотр
	$('.detail').click(function() {
		$('#overlay, #dialog').show();
		var id = $(this).next('input').val();

		$.ajax({ type: 'post', url: '/admajax.php',
			data: ({ getNewsDetail: id, strQuery: '{$qString}' }),
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
