{* Список Разделов *}
{if $action.sections}
	<form action="{$smarty.const.CONF_ADMIN_FILE}?m=dictionary&amp;s=sections" method="post" enctype="multipart/form-data">
		<table style="width: 100%; border: 0px;" cellspacing="5" cellpadding="3">
			<tbody class="data_body">
				{if $arrSections}
					{foreach from=$arrSections item="sections" name="sections"}
						<tr class="data_head">
							<td style="width: 80%;">{$smarty.const.TABLE_COLUMN_NAME}</td>
							<td>{$smarty.const.TABLE_COLUMN_SORT}</td>
						</tr>
						<tr>
							<td style="width: 80%;">
								<input type="text" name="section[{$sections.id}][arrBindFields][name]" size="100" value="{$sections.name}">
							</td>
							<td align="center">
								<input type="text" name="section[{$sections.id}][arrNoBindFields][sort]" value="{$sections.sort}" size="5" maxlength="3" class="text">
							</td>
						</tr>
						<tr>
							<td colspan="2">
								<strong>{$smarty.const.SITE_PAGE_TITLE}:</strong><br><br>
								<input type="text" name="section[{$sections.id}][arrNoBindFields][title]" value="{$sections.title}" size="150" maxlength="255">
							</td>
						</tr>
						<tr>
							<td colspan="2">
								<strong>{$smarty.const.SITE_PAGE_META_KEYWORDS}:</strong><br><br>
								<input type="text" name="section[{$sections.id}][arrNoBindFields][meta_keywords]" value="{$sections.meta_keywords}" size="150" maxlength="255">
							</td>
						</tr>
						<tr>
							<td colspan="2">
								<strong>{$smarty.const.SITE_PAGE_META_DESCRIPTION}:</strong><br><br>
								<textarea name="section[{$sections.id}][arrNoBindFields][meta_description]" rows="3" cols="100">{$sections.meta_description}</textarea>
							</td>
						</tr>
					{/foreach}
					</tbody>
					<tfoot class="data_foot">
						<tr>
							<td colspan="2" style="text-align: center;">
								<input type="hidden" name="action" value="edit">
								<input type="submit" name="save_sections" value="{$smarty.const.FORM_BUTTON_SAVE}" class="button" style="margin: 5px; float: left;">
								<span style="vertical-align: bottom;">{$smarty.const.TABLE_RECORDS}&nbsp;{$smarty.foreach.sections.total}</span>
							</td>
						</tr>
					</tfoot>
				{else}
						<tr>
							<td align="center" colspan="2">
								{$smarty.const.TABLE_NOT_DATA}
							</td>
						</tr>
					</tbody>
				{/if}
		</table>
	</form>
{* Список Профессий *}
{elseif $action.professions}
	<form action="{$smarty.const.CONF_ADMIN_FILE}?m=dictionary&amp;s=sections&amp;action=professions&amp;pid={$pid}" method="post" enctype="multipart/form-data">
		<table style="width: 100%; border: 0px;" cellspacing="5" cellpadding="3">
			<tbody class="data_body">
				{if $arrProfessions}
					{foreach from=$arrProfessions item="professions" name="professions"}
						<tr class="data_head">
							<td style="width: 80%;">{$smarty.const.TABLE_COLUMN_NAME}</td>
							<td>{$smarty.const.TABLE_COLUMN_SORT}</td>
						</tr>
						<tr>
							<td style="width: 80%;">
								<input type="text" name="profession[{$professions.id}][arrBindFields][name]" size="100" value="{$professions.name}">
							</td>
							<td align="center">
								<input type="text" name="profession[{$professions.id}][arrNoBindFields][sort]" value="{$professions.sort}" size="5" maxlength="3" class="text">
							</td>
						</tr>
						<tr>
							<td colspan="2">
								<strong>{$smarty.const.SITE_PAGE_TITLE}:</strong><br><br>
								<input type="text" name="profession[{$professions.id}][arrNoBindFields][title]" value="{$professions.title}" size="150" maxlength="255">
							</td>
						</tr>
						<tr>
							<td colspan="2">
								<strong>{$smarty.const.SITE_PAGE_META_KEYWORDS}:</strong><br><br>
								<input type="text" name="profession[{$professions.id}][arrNoBindFields][meta_keywords]" value="{$professions.meta_keywords}" size="150" maxlength="255">
							</td>
						</tr>
						<tr>
							<td colspan="2">
								<strong>{$smarty.const.SITE_PAGE_META_DESCRIPTION}:</strong><br><br>
								<textarea name="profession[{$professions.id}][arrNoBindFields][meta_description]" rows="3" cols="100">{$professions.meta_description}</textarea>
							</td>
						</tr>
					{/foreach}
					</tbody>
					<tfoot class="data_foot">
						<tr>
							<td colspan="2" style="text-align: center;">
								<input type="hidden" name="action" value="edit">
								<input type="submit" name="save_professions" value="{$smarty.const.FORM_BUTTON_SAVE}" class="button" style="margin: 5px; float: left;">
								<span style="vertical-align: bottom;">{$smarty.const.TABLE_RECORDS}&nbsp;{$smarty.foreach.professions.total}</span>
							</td>
						</tr>
					</tfoot>
				{else}
						<tr>
							<td align="center" colspan="2">
								{$smarty.const.TABLE_NOT_DATA}
							</td>
						</tr>
					</tbody>
				{/if}
		</table>
	</form>
{/if}