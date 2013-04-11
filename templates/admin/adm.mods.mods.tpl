<p class="sub_menu">
	<span class="colorbox_help" id="HELP_ADMIN_MODS_MODS"><img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/actions/help.png"></span>
</p>

{if $errors}{include file="adm.errors.message.tpl"}{/if}

{if $dbEnable}
	<p>
		<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/icons/database_add.png" 
			 title="{$smarty.const.SITE_SWITCH_TO_WORK_WITH_DB}">&nbsp;
		<a href="{$smarty.const.CONF_ADMIN_FILE}?m=mods&amp;s=mods&dbEnable">
			{$smarty.const.SITE_SWITCH_TO_WORK_WITH_DB}
		</a>
	</p>
{/if}


<form action="{$smarty.const.CONF_ADMIN_FILE}?m=mods&amp;s=mods" method="post" enctype="multipart/form-data">
<table class="dataTable100">
	<thead>
		<tr>
			<td>{$smarty.const.TABLE_COLUMN_NAME}</td>
			<td>{$smarty.const.TABLE_COLUMN_DESCRIPTION}</td>
			<td>{$smarty.const.TABLE_COLUMN_TOKEN}</td>
			<td><input type="checkbox" class="checked_all"></td>
		</tr>
	</thead>
	<tbody>
	{if $mods}
		{foreach from=$mods item="mod"}
			<tr>
				<td>{$mod.name|upper}</td>
				<td>{$mod.description}</td>
				<td class="alignCenter">
					{if $mod.token eq 'active'}
						<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/actions/on.png" title="{$smarty.const.FORM_MOD_ON}">
					{else}
						<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/actions/off.png" title="{$smarty.const.FORM_MOD_OFF}">
					{/if}
				</td>
				<td class="alignCenter"><input type="checkbox" name="mods[{$mod.name}]" class="checkbox_entry"></td>
			</tr>
		{/foreach}
	</tbody>
	<tfoot>
		<tr>
			<td colspan="10" class="alignRight">
				<select name="action" class="select">
					<option value="">{$smarty.const.FORM_ACTION_SELECT}</option>
					<option value="active">{$smarty.const.FORM_ACTION_ENABLE_SELECTED}</option>
					<option value="disable">{$smarty.const.FORM_ACTION_DISABLE_SELECTED}</option>
					{*<option value="del">{$smarty.const.FORM_ACTION_DELETE_SELECTED}</option>*}
				</select>
				<input type="submit" value="{$smarty.const.FORM_BUTTON_EXECUTE}" class="button">
			</td>
		</tr>
	</tfoot>
	{else}
		<tr>
			<td class="alignCenter" colspan="10">{$smarty.const.TABLE_NOT_DATA}</td>
		</tr>
		</tbody>
	{/if}
</table>
</form>

<script type="text/javascript">
$( function() {
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

			return ( $("select[name='action'] option:selected").val() === 'del' ) ? confirm('{$smarty.const.MESSAGE_DELETE_RECORDS}') : true;
		}
	});
});
</script>