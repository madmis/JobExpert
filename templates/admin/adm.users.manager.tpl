<p class="sub_menu">
	<span class="colorbox_help" id="HELP_ADMIN_MANAGER_USERS">
		<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/actions/help.png" alt="{$smarty.const.FORM_IMG_HELP}" title="{$smarty.const.FORM_IMG_HELP}">
	</span>
</p>

{if $errors}
	{include file="adm.errors.message.tpl"}
{/if}

{* Добавление пользователя *}
{if $action.add}
	{include file="adm.users.manager.add.tpl"}
{* Поиск пользователей *}
{elseif $action.filter}
	{include file="adm.users.manager.filter.tpl"}
{* Пользователи ожидающие активации *}
{elseif $action.activate}
	{include file="adm.users.manager.activate.tpl"}
{* Модерация пользователей *}
{elseif $action.moderate}
	{include file="adm.users.manager.moderate.tpl"}
{* Пользователи ожидающие оплату *}
{elseif $action.payment}
	{include file="adm.users.manager.payment.tpl"}
{* Настройки пользователей *}
{elseif $action.config}
	{include file="adm.users.manager.config.tpl"}
{* Детальная информация пользователя *}
{elseif $action.detail}
	{include file="adm.users.manager.detail.tpl"}
{* Список пользователей *}
{else}
	{if !$smarty.const.CONF_USER_REGISTER}
	<div class="warning">{$smarty.const.WARNING_CONF_USER_REGISTER_DISABLED}</div>
	{/if}

	<form action="{$smarty.const.CONF_ADMIN_FILE}?m=users&amp;s=manager" method="post" enctype="multipart/form-data">
	<table style="width: 100%; border: 0px;" cellspacing="5" cellpadding="3">
		<thead class="data_head">
			<tr>
				<td>
					<a href="{$smarty.const.CONF_ADMIN_FILE}?m=users&amp;s=manager&amp;order=users.email&amp;by={if $order['users.email'] eq 'ASC'}DESC{else}ASC{/if}" class="white">
					{$smarty.const.TABLE_COLUMN_EMAIL}{if $order['users.email'] eq 'DESC'}&nbsp;<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/icons/sort_up.gif" class="middle">{elseif $order['users.email'] eq 'ASC'}&nbsp;<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/icons/sort_down.gif" class="middle">{/if}
					</a>
				</td>
				<td>
					<a href="{$smarty.const.CONF_ADMIN_FILE}?m=users&amp;s=manager&amp;order=conf_users.user_type&amp;by={if $order['conf_users.user_type'] eq 'ASC'}DESC{else}ASC{/if}" class="white">
					{$smarty.const.TABLE_COLUMN_TYPE}{if $order['conf_users.user_type'] eq 'DESC'}&nbsp;<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/icons/sort_up.gif" class="middle">{elseif $order['conf_users.user_type'] eq 'ASC'}&nbsp;<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/icons/sort_down.gif" class="middle">{/if}
					</a>
				</td>
				<td>
					<a href="{$smarty.const.CONF_ADMIN_FILE}?m=users&amp;s=manager&amp;order=conf_users.user_group&amp;by={if $order['conf_users.user_group'] eq 'ASC'}DESC{else}ASC{/if}" class="white">
					{$smarty.const.TABLE_COLUMN_GROUP}{if $order['conf_users.user_group'] eq 'DESC'}&nbsp;<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/icons/sort_up.gif" class="middle">{elseif $order['conf_users.user_group'] eq 'ASC'}&nbsp;<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/icons/sort_down.gif" class="middle">{/if}
					</a>
				</td>
				<td>
					<a href="{$smarty.const.CONF_ADMIN_FILE}?m=users&amp;s=manager&amp;order=users.reg_datetime&amp;by={if $order['users.reg_datetime'] eq 'ASC'}DESC{else}ASC{/if}" class="white">
					{$smarty.const.TABLE_COLUMN_REG_DATETIME}{if $order['users.reg_datetime'] eq 'DESC'}&nbsp;<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/icons/sort_up.gif" class="middle">{elseif $order['users.reg_datetime'] eq 'ASC'}&nbsp;<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/icons/sort_down.gif" class="middle">{/if}
					</a>
				</td>
				<td><input type="checkbox" class="checked_all"></td>
			</tr>
		</thead>
		<tbody class="data_body">
	{if $users}
		{foreach from=$users item="user" name="i"}
			<tr>
				<td><a href="{$smarty.const.CONF_ADMIN_FILE}?m=users&amp;s=manager&amp;action=detail&amp;id={$user.id}">{$user.email}</a></td>
				<td align="center">
					{if $user.user_type eq "agent"}
						{$smarty.const.FORM_TYPE_AGENT}
					{elseif $user.user_type eq "company"}
						{$smarty.const.FORM_TYPE_COMPANY}
					{elseif $user.user_type eq "employer"}
						{$smarty.const.FORM_TYPE_EMPLOYER}
					{elseif $user.user_type eq "competitor"}
						{$smarty.const.FORM_TYPE_COMPETITOR}
					{/if}
				</td>
				<td align="center"><a href="{$smarty.const.CONF_ADMIN_FILE}?m=manager&s=groups&action=edit&id={$user.user_group}" target="_blank">{$user.user_group|upper}</a></td>
				<td align="center">{$user.reg_datetime|date_format:$smarty.const.CONF_DATE_FORMAT}</td>
				<td align="center"><input type="checkbox" name="users[{$user.id}]" class="checkbox_entry"></td>
			</tr>
		{/foreach}
		</tbody>
		<tfoot class="data_foot">
			<tr>
				<td colspan="3" align="center">
					{$smarty.const.TABLE_RECORDS} {$smarty.foreach.i.total}/{$allRecords}
				</td>
				<td colspan="3" align="right">
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
				<td align="center" colspan="5">
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
$(document).ready( function() {
	//включаем все переключатели в таблице
	$('.checked_all').click(function() {
		(!$(this).is(':checked')) ? $('.checkbox_entry').removeAttr('checked') : $('.checkbox_entry').attr('checked', 'checked');
	});

	// проверяем выбранное действие
	$("form:last").submit( function() {
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
{/if}