<p class="sub_menu"><span class="colorbox_help" id="HELP_ADMIN_SYSTEM_BACKUPS"><img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/actions/help.png" alt="{$smarty.const.FORM_IMG_HELP}"></span></p>

{if $errors}{include file="adm.errors.message.tpl"}{/if}

{* Страница создания резервных копий *}
{if $action.config}
	{include file="adm.system.backups.config.tpl"}
{* Список резервных копий *}
{else}
	<form action="{$smarty.const.CONF_ADMIN_FILE}?m=system&amp;s=backups" method="post">
	<table style="width: 100%;" cellspacing="2" cellpadding="2">
		<thead class="data_head">
			<tr>
				<td>{$smarty.const.TABLE_COLUMN_TYPE}</td>
				<td>{$smarty.const.TABLE_COLUMN_FILE}</td>
				<td>{$smarty.const.TABLE_COLUMN_SIZE}</td>
				<td>{$smarty.const.TABLE_COLUMN_DATE}</td>
				<td><input type="checkbox" class="checked_all"></td>
			</tr>
		</thead>
		<tbody class="fm data_body">
	{if $arrFiles}
		{foreach from=$arrFiles item="file" name="i"}
			<tr class="file">
				<td style="text-align: center;" title="{$smarty.const.L_TYPE} {$file.ext|upper}">
					<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/file_types/{$file.ext}_16.png">
				</td>
				<td style="text-align: left;">
					{$file.name}
				</td>
				<td style="text-align: center;" title="{$smarty.const.L_SIZE} {$file.title_sizekb} {$smarty.const.L_KB}">
					{$file.size}
				</td>
				<td style="text-align: center;" title="{$smarty.const.L_CHANGED} {$file.date|date_format:$smarty.const.CONF_DATE_FORMAT} {$file.date|date_format:"%H:%M"}">
					{$file.date|date_format:$smarty.const.CONF_DATE_FORMAT}
				</td>
				<td style="text-align: center;">
					<input type="checkbox" name="files[{$file.path}{$file.name}]" class="checkbox_entry">
				</td>
			</tr>
		{/foreach}
		</tbody>
		<tfoot class="fm_foot data_foot">
			<tr>
				<td colspan="3" style="text-align: center;">
					{$smarty.const.TABLE_TOTAL_FILES}: {$smarty.foreach.i.total}
				</td>
				<td colspan="2" style="text-align: right;">
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
				<td style="text-align: center;" colspan="6">
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
	//включаем все переключатели в таблице	
	$('.checked_all').click(function() {
		(!$(this).is(':checked')) ? $('.checkbox_entry').removeAttr('checked') : $('.checkbox_entry').attr('checked', 'checked');
	});

	// проверяем выбранное действие
	$("form").submit( function() {
		if (!$('select[name="action"] option:selected').val()) {
			$.alert('{$smarty.const.ERROR_NOT_SELECT_ACTION}');
			return false;
		} else {
			if ($('select[name="action"] option:selected').val() !== 'sorting' && !$('form input:checked').size()) {
				$.alert('{$smarty.const.MESSAGE_WARNING_NOT_SELECT_RECORDS}');
				return false;
			}

			return ( $("select[name='action'] option:selected").val() === 'del' ) ? confirm('{$smarty.const.MESSAGE_DELETE_RECORDS}') : true;
		}
	});
});
-->
</script>

{/if}