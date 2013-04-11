<form action="{$smarty.const.CONF_ADMIN_FILE}?m=manager&amp;s=file&amp;action=files" method="post" enctype="multipart/form-data">
<table style="width: 100%; border: 0px;" cellspacing="2" cellpadding="0">
	<thead class="data_head">
		<tr>
			<td style="text-align: center;">{$smarty.const.TABLE_COLUMN_TYPE}</td>
			<td style="text-align: center;">{$smarty.const.TABLE_COLUMN_FILE}</td>
			<td style="text-align: center;">{$smarty.const.TABLE_COLUMN_LINK}</td>
			<td style="text-align: center;">{$smarty.const.TABLE_COLUMN_SIZE}</td>
			<td style="text-align: center;">{$smarty.const.TABLE_COLUMN_DATE}</td>
			<td style="text-align: center;"><input type="checkbox" id="s_all"></td>
		</tr>
	</thead>
	<tbody class="fm data_body">
{if $arrFiles}
	{foreach from=$arrFiles item="file"}
		<tr class="file">
			<td style="text-align: center;" title="{$smarty.const.L_TYPE} {$file.ext|upper}">
				<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/file_types/{$file.icon}_16.png">
			</td>
			<td style="text-align: left;">
				{$file.filename}
			</td>
			<td style="text-align: center;" title="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.CONF_FILEMANAGER_PATH_TO_FILES}{$file.filename}">
				<a href="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.CONF_FILEMANAGER_PATH_TO_FILES}{$file.filename}" target="_blank">
				<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/icons/link.png" alt="">
				</a>
			</td>
			<td style="text-align: center;" title="{$smarty.const.L_SIZE} {$file.sizekb} {$smarty.const.L_KB}">
				{$file.size}
			</td>
			<td style="text-align: center;" title="{$smarty.const.L_CHANGED} {$file.date|date_format:$smarty.const.CONF_DATE_FORMAT} {$file.date|date_format:"%H:%M"}">
				{$file.date|date_format:$smarty.const.CONF_DATE_FORMAT}
			</td>
			<td style="text-align: center;" >
				<input type="checkbox" name="files[{$file.filename}]">
			</td>
		</tr>
	{/foreach}
	</tbody>
	<tfoot class="fm_foot data_foot">
		<tr>
			<td colspan="2" style="text-align: center;" >
				{$smarty.const.TABLE_TOTAL_FILES}: {$count}
			</td>
			<td colspan="4" style="text-align: right;" >
				<select name="action" class="select">
					<option value="">{$smarty.const.FORM_ACTION_SELECT}</option>
					<option value="del">{$smarty.const.FORM_ACTION_DELETE_SELECTED}</option>
				</select>
				<input type="submit" value="{$smarty.const.FORM_BUTTON_EXECUTE}" class="button">
			</td>
		</tr>
	</tfoot>
{else}
		<tr>
			<td style="text-align: center;" colspan="10">
				{$smarty.const.TABLE_NOT_DATA}
			</td>
		</tr>
	</tbody>
{/if}

</table>
</form>

<script type="text/javascript">
<!--
$(document).ready( function()
{
	$('.file').live('mouseover', function()	{
		$(this).addClass('fileBlockHover');
	});
	$('.file').live('mouseout', function()	{
		$(this).removeClass('fileBlockHover');
	});

	//включаем все переключатели в таблице
	$('#s_all').click(function() {
		var current = $(this);
		$(':checkbox[name^="files"]').each(function() {
			(current.is(':checked')) ? $(this).attr('checked', true) : $(this).attr('checked', false);
      	});
	});

	// проверяем выбранное действие
	$('form:last').submit(function() {
		if (!$('select[name="action"] option:selected').val()) {
			$.alert('{$smarty.const.ERROR_NOT_SELECT_ACTION}');
			return false;
		} else if (!$('form:last input:checked').size()) {
				$.alert('{$smarty.const.MESSAGE_WARNING_NOT_SELECT_RECORDS}');
				return false;
		} else {
			return ($('select[name="action"] option:selected').val() === 'del') ? confirm('{$smarty.const.MESSAGE_DELETE_RECORDS}') : true;
		}
	});
});
-->
</script>
