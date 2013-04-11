<p class="sub_menu"><span class="colorbox_help" id="HELP_ADMIN_MANAGER_DOP_PAGES"><img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/actions/help.png" alt="{$smarty.const.FORM_IMG_HELP}"></span></p>

{* Ошибки *}
{if $errors}{include file="adm.errors.message.tpl"}{/if}

{* Добавление дополнительной страницы *}
{if $action.add}
	{include file="adm.manager.dop.pages.add.tpl"}
{* Редактирование дополнительной страницы *}
{elseif $action.edit}
	{include file="adm.manager.dop.pages.edit.tpl"}
{* Вывод всех дополнительных страниц *}
{else}
	<form action="{$smarty.const.CONF_ADMIN_FILE}?m=manager&amp;s=dop.pages" method="post" enctype="multipart/form-data">
	<table class="dataTable100">
		<thead>
			<tr>
				<td>{$smarty.const.TABLE_COLUMN_ID}</td>
				<td>{$smarty.const.TABLE_COLUMN_NAME}</td>
				<td>{$smarty.const.TABLE_COLUMN_SHOW}</td>
				<td>{$smarty.const.TABLE_COLUMN_SORT}</td>
				<td>-</td>
			</tr>
		</thead>
		<tbody>
	{if $arrPages}
		{foreach from=$arrPages item="page" name="allpages"}
			<tr>
				<td>{$page.id}</td>
				<td>
					<a href="{$smarty.const.CONF_ADMIN_FILE}?m=manager&amp;s=dop.pages&amp;action=edit&amp;id={$page.id}">{$page.title}</a>
				</td>
				<td class="alignCenter">
					{if $page.token eq 'active'}
						<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/icons/yes.png" title="{$smarty.const.FORM_ACTIVE}">
					{else}
						<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/icons/no.png" title="{$smarty.const.FORM_IN_ARCHIVE}">
					{/if}
				</td>
				<td class="alignCenter">
					<input type="text" name="sort[{$page.id}]" value="{$page.sort}" size="5" class="text" {if $page.token eq 'archived'}disabled="disabled"{/if}>
				</td>
				<td class="alignCenter">
					<input type="checkbox" name="pages[{$page.id}]">
				</td>
			</tr>
		{/foreach}
		</tbody>
		<tfoot>
			<tr>
				<td colspan="10" class="alignCenter">
					{$smarty.const.TABLE_RECORDS} {$smarty.foreach.allpages.total}
					<span style="float: right;">
					<select name="action" class="select">
						<option value="show">{$smarty.const.FORM_ACTION_SHOW_SELECTED}</option>
						<option value="hide">{$smarty.const.FORM_ACTION_HIDE_SELECTED}</option>
						<option value="sorting">{$smarty.const.FORM_ACTION_SAVE_SORT}</option>
						<option value="del">{$smarty.const.FORM_ACTION_DELETE_SELECTED}</option>
					</select>
					<input type="submit" value="{$smarty.const.FORM_BUTTON_EXECUTE}" class="button">
					</span>
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
{/if}