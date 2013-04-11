{* ФОРМА ОТБОРА ПОЛЬЗОВАТЕЛЕЙ *}
<form action="{$smarty.const.CONF_ADMIN_FILE}?m=users&amp;s=manager&amp;action=filter" method="get" enctype="multipart/form-data">
<input type="hidden" name="m" value="users">
<input type="hidden" name="s" value="manager">
<input type="hidden" name="action" value="filter">
<table style="width: 100%;" cellspacing="0" class="add_table">
	<thead>
		<tr>
			<td>{$smarty.const.TABLE_FORM_SELECTION}</td>
		</tr>
			</td>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td align="left" style="width: 100%;">
				<table style="width: 100%;">
					<tbody>
						<tr>
							<td>
								{$smarty.const.FORM_USERS_DATA_ID} <input type="text" name="id" value="{$return_data.id}">
								<span class="colorbox_help" id="HELP_ADMIN_USERS_FILTER_ID">
									<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/information.png" alt="{$smarty.const.FORM_IMG_HELP}">
								</span>
							</td>
							<td>
								{$smarty.const.FORM_USERS_DATA_EMAIL} <input type="text" name="email" value="{$return_data.email}">
								<span class="colorbox_help" id="HELP_ADMIN_USERS_FILTER_EMAIL">
									<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/information.png" alt="{$smarty.const.FORM_IMG_HELP}">
								</span>
							</td>
							<td>
								{$smarty.const.FORM_USERS_DATA_ALIAS} <input type="text" name="alias" value="{$return_data.alias}">
								<span class="colorbox_help" id="HELP_ADMIN_USERS_FILTER_ALIAS">
									<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/information.png" alt="{$smarty.const.FORM_IMG_HELP}">
								</span>
							</td>
						</tr>
					</tbody>
				</table>
				<table style="width: 100%;">
					<tbody>
						<tr>
						 	<td>
								{$smarty.const.FORM_USERS_DATA_REG_IP} <input type="text" name="reg_ip" value="{$return_data.reg_ip}">
								<span class="colorbox_help" id="HELP_ADMIN_USERS_FILTER_REG_IP">
									<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/information.png" alt="{$smarty.const.FORM_IMG_HELP}">
								</span>
						 	</td>
							<td>
								{$smarty.const.FORM_USERS_DATA_TYPE} <select class="select" name="user_type">
										<option value="">{$smarty.const.FORM_IMP}</option>
									{foreach from=$user_types item="type"}
										<option value="{$type}" {if $return_data.user_type eq $type}selected{/if}>
											{if $type eq "agent"}
												{$smarty.const.FORM_TYPE_AGENT}
											{elseif $type eq "company"}
												{$smarty.const.FORM_TYPE_COMPANY}
											{elseif $type eq "employer"}
												{$smarty.const.FORM_TYPE_EMPLOYER}
											{elseif $type eq "competitor"}
												{$smarty.const.FORM_TYPE_COMPETITOR}
											{/if}
										</option>
									{/foreach}
								</select>
							</td>
							<td>
								{$smarty.const.FORM_USERS_DATA_GROUP} <select class="select" name="user_group">
										<option value="">{$smarty.const.FORM_IMP}</option>
									{foreach from=$user_groups item="group"}
										<option value="{$group.id}" {if $return_data.user_group eq $group.id}selected{/if}>{$group.id|upper}</option>
									{/foreach}
								</select>
							</td>
							<td>
								{$smarty.const.FORM_USERS_DATA_TOKEN} <select class="select" name="token">
										<option value="active" {if $return_data.token eq 'active'}selected{/if}>{$smarty.const.RECORD_ACTIVE}</option>
										<option value="new" {if $return_data.token eq 'new'}selected{/if}>{$smarty.const.RECORD_WAIT_ACTIVATE}</option>
										<option value="moderate" {if $return_data.token eq 'moderate'}selected{/if}>{$smarty.const.RECORD_MODERATE}</option>
										<option value="payment" {if $return_data.token eq 'payment'}selected{/if}>{$smarty.const.RECORD_WAIT_PAYMENT}</option>
								</select>
							</td>
						</tr>
					</tbody>
				</table>
			</td>
		</tr>
	</tbody>
	<tfoot>
		<tr>
			<td><input type="submit" class="button" value="{$smarty.const.FORM_BUTTON_EXECUTE}"></td>
		</tr>
	</tfoot>
</table>
</form>

{* ТАБЛИЦА НАЙДЕННЫХ ПОЛЬЗОВАТЕЛЕЙ *}
<form action="{$smarty.const.CONF_ADMIN_FILE}?{$query_string}" method="post" enctype="multipart/form-data">
<table style="width: 100%;" cellspacing="5" cellpadding="3">
	<thead class="data_head">
		<tr>
			<td>{$smarty.const.TABLE_COLUMN_EMAIL}</td>
			<td>{$smarty.const.TABLE_COLUMN_IP}</td>
			<td>{$smarty.const.TABLE_COLUMN_TYPE}</td>
			<td>{$smarty.const.TABLE_COLUMN_GROUP}</td>
			<td>{$smarty.const.TABLE_COLUMN_REG_DATETIME}</td>
			<td><input type="checkbox" id="s_all"></td>
		</tr>
	</thead>
	<tbody class="data_body">
{if $users}
	{foreach from=$users item="user" name="i"}
		<tr>
			<td><a href="{$smarty.const.CONF_ADMIN_FILE}?m=users&amp;s=manager&amp;action=detail&amp;id={$user.id}">{$user.email}</a></td>
			<td class="alignCenter">{if $user.reg_ip}{$user.reg_ip}{else}-{/if}</td>
			<td class="alignCenter">
				{if $user.user_type eq "agent"}
					{$smarty.const.FORM_TYPE_AGENT}
				{elseif $user.user_type eq "company"}
					{$smarty.const.FORM_TYPE_COMPANY}
				{elseif $user.user_type eq "employer"}
					{$smarty.const.FORM_TYPE_EMPLOYER}
				{elseif $user.user_type eq "competitor"}
					{$smarty.const.FORM_TYPE_COMPETITOR}
				{else}
					{$smarty.const.FORM_TYPE_NOT_DEFINE}
				{/if}
			</td>
			<td class="alignCenter"><a href="{$smarty.const.CONF_ADMIN_FILE}?m=manager&s=groups&action=edit&id={$user.user_group}" target="_blank">{$user.user_group|upper}</a></td>
			<td class="alignCenter">{$user.reg_datetime|date_format:$smarty.const.CONF_DATE_FORMAT}</td>
			<td class="alignCenter"><input type="checkbox" name="users[{$user.id}]" value="{$user.email}"></td>
		</tr>
	{/foreach}
	</tbody>
	<tfoot class="data_foot">
		<tr>
			<td colspan="4" class="alignCenter">
				{$smarty.const.TABLE_RECORDS} {$smarty.foreach.i.total}/{$allRecords}
			</td>
			<td colspan="2" class="alignRight">
				<select name="action" class="select">
					<option value="">{$smarty.const.FORM_ACTION_SELECT}</option>
				{if $return_data.token eq 'new' OR $return_data.token eq 'moderate' OR $return_data.token eq 'payment'}
					<option value="active">{$smarty.const.FORM_ACTION_ACTIVATE_SELECTED}</option>
				{/if}
					<option value="del">{$smarty.const.FORM_ACTION_DELETE_SELECTED}</option>
				</select>
				{if $return_data.token eq 'moderate'}
					<input type="submit" name="moderate" value="{$smarty.const.FORM_BUTTON_EXECUTE}" class="button">
				{elseif $return_data.token eq 'new'}
					<span id="mail"></span>
					<input type="submit" name="activate" value="{$smarty.const.FORM_BUTTON_EXECUTE}" class="button">
				{elseif $return_data.token eq 'payment'}
					<input type="submit" name="payment" value="{$smarty.const.FORM_BUTTON_EXECUTE}" class="button">
				{else}
					<input type="submit" name="save" value="{$smarty.const.FORM_BUTTON_EXECUTE}" class="button">
				{/if}
			</td>
		</tr>
	</tfoot>
{else}
		<tr>
			<td class="alignCenter" colspan="6">
				{$smarty.const.TABLE_NOT_DATA}
			</td>
		</tr>
	</tbody>
{/if}
</table>
</form>

<p class="alignCenter">{$strPages}</p>

<script type="text/javascript">
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

	// отображаем чекбокс отправки сообщений активации пользователей, если отобраны пользователи, ожидающие активации
	$("select[name='action']").change( function()
	{
		if ($("select[name='token']").val() === 'new')
		{
			($(this).val() !== 'active') ? $('#mail').html('') : $('#mail').html('<input type="checkbox" name="mail" title="{$smarty.const.FORM_USERS_DATA_SEND_EMAIL_ABOUT_ACTIVATE}">');
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
</script>