<form action="{$smarty.const.CONF_ADMIN_FILE}?{$qString}" method="get">
<input type="hidden" name="m" value="manager">
<input type="hidden" name="s" value="news">
<input type="hidden" name="action" value="archived">
<input type="hidden" name="do" value="filter">
<table style="width: 100%; border-spacing: 0px;" class="otbor_table">
	<thead class="otbor_head" id="news_archived">
		<tr><td>{$smarty.const.TABLE_FORM_SELECTION}</td></tr>
	</thead>
	<tbody>
		<tr>
			<td class="alignLeft" style="width: 100%;">
				<table style="width: 100%;" class="hidden_table" id="news_archived_otbor">
					<tbody class="otbor_body">
						<tr>
							<td>
								{$smarty.const.FORM_ID}&nbsp;<input type="text" name="id" value="{$retFields.id}">
								<span class="colorbox_help" id="HELP_ADMIN_PATTERN_FILTER_ID"><img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/information.png" alt="{$smarty.const.FORM_IMG_HELP}"></span>
							</td>
							<td>
								{$smarty.const.FORM_ID_USER}&nbsp;<input type="text" name="id_user" value="{$retFields.id_user}">
								<span class="colorbox_help" id="HELP_ADMIN_PATTERN_FILTER_ID"><img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/information.png" alt="{$smarty.const.FORM_IMG_HELP}"></span>
							</td>
							<td colspan="2">
								{$smarty.const.FORM_AUTHOR}&nbsp;<input type="text" name="author" size="30" value="{$retFields.author}">
								<span class="colorbox_help" id="HELP_ADMIN_PATTERN_FILTER_STRING"><img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/information.png" alt="{$smarty.const.FORM_IMG_HELP}"></span>
							</td>
						</tr>
						<tr>
							<td colspan="2">
								{$smarty.const.FORM_TITLE}&nbsp;<input type="text" name="title" size="50" value="{$retFields.title}">
								<span class="colorbox_help" id="HELP_ADMIN_PATTERN_FILTER_STRING"><img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/information.png" alt="{$smarty.const.FORM_IMG_HELP}"></span>
							</td>
							<td>
								{$smarty.const.FORM_DATE}:&nbsp;
								{$smarty.const.SITE_FROM}&nbsp;<input type="text" name="sDate" class="datepicker" size="10" value="{$retFields.sDate}">
								{$smarty.const.SITE_UNTO}&nbsp;<input type="text" name="eDate" class="datepicker" size="10" value="{$retFields.eDate}">
							</td>
							<td>{$smarty.const.FORM_RECORDS}&nbsp;<input type="text" name="records" size="5" value="{$retFields.records}"></td>
						</tr>
					</tbody>
					<tfoot class="otbor_foot">
						<tr>
							<td colspan="4"><input type="submit" value="{$smarty.const.FORM_BUTTON_EXECUTE}" class="button"></td>
						</tr>
					</tfoot>
				</table>
			</td>
		</tr>
	</tbody>
</table>
</form>
<br>

<form action="{$smarty.const.CONF_ADMIN_FILE}?{$qString}" method="post">
<table class="dataTable100">
	<thead>
		<tr>
			<td>{$smarty.const.TABLE_COLUMN_ID}</td>
			<td>{$smarty.const.TABLE_COLUMN_TITLE}</td>
			<td>{$smarty.const.TABLE_COLUMN_USER_ID}</td>				
			<td>{$smarty.const.TABLE_COLUMN_AUTHOR}</td>				
			<td>{$smarty.const.TABLE_COLUMN_DATE}</td>
			<td>{$smarty.const.TABLE_COLUMN_OPTIONS}</td>
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
			<td class="alignCenter">
				<a href="{$smarty.const.CONF_ADMIN_FILE}?m=manager&amp;s=news&amp;action=edit&amp;id={$arrNews.id}">
					<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/actions/edit.png" alt="{$smarty.const.FORM_ACTION_EDIT}" title="{$smarty.const.FORM_ACTION_EDIT}">
				</a>
			</td>
			<td class="alignCenter"><input type="checkbox" name="news[{$arrNews.id}]" class="checkbox_entry"></td>
		</tr>
	{/foreach}
	</tbody>
	<tfoot>
		<tr>
			<td colspan="3">
				{$smarty.const.TABLE_RECORDS} {$smarty.foreach.i.total}/{$allRecords}
			</td>
			<td class="alignRight" colspan="6">
				<select name="action">
					<option value="">{$smarty.const.FORM_ACTION_SELECT}</option>
					<option value="active">{$smarty.const.FORM_ACTION_EXTRACT}</option>
					<option value="deleted">{$smarty.const.FORM_ACTION_DELETE_SELECTED}</option>
				</select>
				<input type="submit" value="{$smarty.const.FORM_BUTTON_EXECUTE}" class="button">
			</td>
		</tr>
	</tfoot>
{else}
		<tr><td colspan="9" class="alignCenter">{$smarty.const.TABLE_NOT_DATA}</td></tr>
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
