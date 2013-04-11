{if $errors}{include file="adm.errors.message.tpl"}{/if}

{* Настройки компаний *}
{if $action.config}
	{include file="adm.users.companies.config.tpl"}
{else if $action.seo}
	{include file="adm.manager.seo.tpl"}
{* Список компаний *}
{else}
	<p class="sub_menu"><span class="colorbox_help" id="HELP_ADMIN_USERS_COMPANIES"><img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/actions/help.png" alt="{$smarty.const.FORM_IMG_HELP}"></span></p>

	<form action="{$smarty.const.CONF_ADMIN_FILE}?m=users&amp;s=companies" method="post" enctype="multipart/form-data">
	<table style="width: 100%; padding: 3px; border-spacing: 5;">
		<thead class="data_head">
			<tr>
				<td>{$smarty.const.FORM_USERS_DATA_COMPANY_LOGO}</td>
				<td>{$smarty.const.FORM_USERS_DATA_COMPANY_NAME}</td>
				<td>{$smarty.const.TABLE_COLUMN_SHOW_MAIN}</td>
				<td>{$smarty.const.TABLE_COLUMN_SORT}</td>
				<td><input type="checkbox" class="checked_all"></td>
			</tr>
		</thead>
		<tbody class="data_body">
	{if $arrCompanies}
		{foreach from=$arrCompanies item="company" name="i"}
			<tr>
				<td style="text-align: center;">
					<a href="{$smarty.const.CONF_ADMIN_FILE}?m=users&amp;s=manager&amp;action=detail&amp;id={$company.id}" target="_blank">
					{if $company.logo}
						<img src="{$smarty.const.CONF_SCRIPT_URL}uploads/images/logo/thumbs/thumb_{$company.logo}" style="border: 1px solid #DDD;">
					{else}
						<img src="{$smarty.const.CONF_SCRIPT_URL}uploads/images/logo/not_logo.png" style="border: 1px solid #DDD;">
					{/if}
					</a>
				</td>
				<td style="text-align: center;"><a href="{$smarty.const.CONF_ADMIN_FILE}?m=users&amp;s=manager&amp;action=detail&amp;id={$company.id}" target="_blank">{if $company.company_name}{$company.company_name}{else}-{/if}</a></td>
				<td style="text-align: center;">
					{if $company.main_logo}
						<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/icons/yes.png" title="{$smarty.const.SITE_YES}">
					{elseif !$company.main_logo && !$company.logo}
						<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/icons/forbidden.png" title="{$smarty.const.FORM_USERS_DATA_COMPANY_NOLOGO}">
					{else}
						<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/icons/no.png" title="{$smarty.const.SITE_NO}">
					{/if}
				</td>
				<td style="text-align: center;">
					<input type="text" name="sort[{$company.id}]" value="{$company.sort_logo}" size="5" class="text" {if !$company.logo}disabled{/if}>
				</td>
				<td style="text-align: center;">{if !$company.logo}-{else}<input type="checkbox" name="companies[{$company.id}]" class="checkbox_entry">{/if}</td>
			</tr>
		{/foreach}
		</tbody>
		<tfoot class="data_foot">
			<tr>
				<td style="text-align: center;">
					{$smarty.const.TABLE_RECORDS} {$smarty.foreach.i.total}/{$allRecords}
				</td>
				<td colspan="4" style="text-align: right;">
					<select name="action" class="select">
						<option value="">{$smarty.const.FORM_ACTION_SELECT}</option>
						<option value="show">{$smarty.const.FORM_ACTION_DISPLAY_ON_MAIN}</option>
						<option value="remove">{$smarty.const.FORM_ACTION_REMOVE_FROM_MAIN}</option>
						<option value="sorting">{$smarty.const.FORM_ACTION_SAVE_SORT}</option>
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

	<p style="text-align: center;">{$strPages}</p>

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
		}
	});
});
-->
</script>
{/if}


