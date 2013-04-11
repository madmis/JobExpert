{if !$smarty.const.CONF_USER_ACTIVATE}
<div class="warning">{$smarty.const.WARNING_CONF_USER_ACTIVATE_DISABLED}</div>
{/if}

<form action="{$smarty.const.CONF_ADMIN_FILE}?m=users&amp;s=manager&amp;action=activate" method="post" enctype="multipart/form-data">
<table width="100%" cellspacing="5" cellpadding="3">
	<thead class="data_head">
		<tr>
			<td>
				<a href="{$smarty.const.CONF_ADMIN_FILE}?m=users&amp;s=manager&amp;action=activate&amp;order=users.email&amp;by={if $order['users.email'] eq 'asc'}desc{else}asc{/if}" class="white">
				{$smarty.const.TABLE_COLUMN_EMAIL}{if $order['users.email'] eq 'desc'}&nbsp;<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/icons/sort_up.gif" class="middle">{elseif $order['users.email'] eq 'asc'}&nbsp;<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/icons/sort_down.gif" class="middle">{/if}
				</a>
			</td>
			<td>
				<a href="{$smarty.const.CONF_ADMIN_FILE}?m=users&amp;s=manager&amp;action=activate&amp;order=conf_users.user_group&amp;by={if $order['conf_users.user_group'] eq 'asc'}desc{else}asc{/if}" class="white">
				{$smarty.const.TABLE_COLUMN_GROUP}{if $order['conf_users.user_group'] eq 'desc'}&nbsp;<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/icons/sort_up.gif" class="middle">{elseif $order['conf_users.user_group'] eq 'asc'}&nbsp;<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/icons/sort_down.gif" class="middle">{/if}
				</a>
			</td>
			<td>
				<a href="{$smarty.const.CONF_ADMIN_FILE}?m=users&amp;s=manager&amp;action=activate&amp;order=users.reg_datetime&amp;by={if $order['users.reg_datetime'] eq 'asc'}desc{else}asc{/if}" class="white">
				{$smarty.const.TABLE_COLUMN_REG_DATETIME}{if $order['users.reg_datetime'] eq 'desc'}&nbsp;<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/icons/sort_up.gif" class="middle">{elseif $order['users.reg_datetime'] eq 'asc'}&nbsp;<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/icons/sort_down.gif" class="middle">{/if}
				</a>
			</td>
			<td><input type="checkbox" id="s_all"></td>
		</tr>
	</thead>
	<tbody class="data_body">
{if $users}
	{foreach from=$users item="user" name="i"}
		<tr>
			<td>{$user.email}</td>
			<td align="center"><a href="{$smarty.const.CONF_ADMIN_FILE}?m=manager&s=groups&action=edit&id={$user.user_group}" target="_blank">{$user.user_group|upper}</a></td>
			<td align="center">{$user.reg_datetime|date_format:$smarty.const.CONF_DATE_FORMAT}</td>
			<td align="center"><input type="checkbox" name="users[{$user.id}]" value="{$user.email}"></td>
		</tr>
	{/foreach}
	</tbody>
	<tfoot class="data_foot">
		<tr>
			<td colspan="2" align="center">
				{$smarty.const.TABLE_RECORDS} {$smarty.foreach.i.total}/{$allRecords}
			</td>
			<td colspan="2" align="right">
				<select name="action" class="select">
					<option value="">{$smarty.const.FORM_ACTION_SELECT}</option>
					<option value="active">{$smarty.const.FORM_ACTION_ACTIVATE_SELECTED}</option>
					<option value="del">{$smarty.const.FORM_ACTION_DELETE_SELECTED}</option>
				</select>
				<span id="mail"></span>
				<input type="submit" value="{$smarty.const.FORM_BUTTON_EXECUTE}" class="button">
			</td>
		</tr>
	</tfoot>
{else}
		<tr>
			<td align="center" colspan="4">
				{$smarty.const.TABLE_NOT_DATA}
			</td>
		</tr>
	</tbody>
{/if}
</table>
</form>

<p align="center">{$strPages}</p>

<script type="text/javascript">
<!--
$(document).ready( function()
{
	//включаем все переключатели в таблице
	$('#s_all').click( function()
	{
		var current = $(this);

		$(':checkbox[name^="users"]').each( function()
		{
			( current.is(':checked') ) ? $(this).attr('checked', true) : $(this).attr('checked', false);
      	});
	});

	$("select[name='action']").change( function()
	{
		if ($(this).val() === 'active')
		{
			 $('#mail').html('<input type="checkbox" name="mail" title="{$smarty.const.FORM_USERS_DATA_SEND_EMAIL_ABOUT_ACTIVATE}">');
		}
		else
		{
			$('#mail').html('');
		}
	});

	// проверяем выбранное действие
	$("form:last").submit( function()
	{
		if (!$('select[name="action"] option:selected').val())
		{
			$.alert('{$smarty.const.ERROR_NOT_SELECT_ACTION}');
			return false;
		}
		else
		{
			if (!$('form:last input:checked').size())
			{
				$.alert('{$smarty.const.MESSAGE_WARNING_NOT_SELECT_RECORDS}');
				return false;
			}

			return ( $("select[name='action'] option:selected").val() === 'del' ) ? confirm('{$smarty.const.MESSAGE_DELETE_RECORDS}') : true;
		}
	});
});
-->
</script>
