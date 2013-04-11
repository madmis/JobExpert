<form action="{$smarty.const.CONF_ADMIN_FILE}?m=dictionary&amp;s=sections" method="post" enctype="multipart/form-data">
	<table style="width: 100%; border: 0px;" cellspacing="0" class="add_table">
		<thead>
			<tr>
				<td>{$smarty.const.FORM_SECTION_INPUT_ADD}</td>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td align="left" style="width: 100%; border: 0px;">
					<table style="width: 100%; border: 0px;">
						<tbody>
							<tr>
								<td style="width: 80%;"><strong>{$smarty.const.TABLE_COLUMN_NAME}:</strong>&nbsp;<input type="text" name="arrBindFields[name]" size="100" maxlength="255"></td>
								<td style="text-align: center;"><strong>{$smarty.const.TABLE_COLUMN_SORT}:</strong>&nbsp;<input type="text" name="arrNoBindFields[sort]" size="5" maxlength="3"></td>
							</tr>
							<tr>
								<td colspan="2">
									<strong>{$smarty.const.SITE_PAGE_TITLE}:</strong><br><br>
									<input type="text" name="arrNoBindFields[title]" size="150" maxlength="255">
								</td>
							</tr>
							<tr>
								<td colspan="2">
									<strong>{$smarty.const.SITE_PAGE_META_KEYWORDS}:</strong><br><br>
									<input type="text" name="arrNoBindFields[meta_keywords]" size="150" maxlength="255">
								</td>
							</tr>
							<tr>
								<td colspan="2">
									<strong>{$smarty.const.SITE_PAGE_META_DESCRIPTION}:</strong><br><br>
									<textarea name="arrNoBindFields[meta_description]" rows="3" cols="100"></textarea>
								</td>
							</tr>
						</tbody>
					</table>
				</td>
			</tr>
		</tbody>
		<tfoot>
			<tr>
				<td colspan="2"><input type="submit" name="add_section" value="{$smarty.const.FORM_BUTTON_EXECUTE}" class="button"></td>
			</tr>
		</tfoot>
	</table>
</form>
<form name="ActionSections" action="{$smarty.const.CONF_ADMIN_FILE}?m=dictionary&amp;s=sections" method="post" enctype="multipart/form-data">
	<table style="width: 100%; border: 0px;" cellspacing="5" cellpadding="3">
		<thead class="data_head">
			<tr>
				<td style="width: 80%;">{$smarty.const.TABLE_COLUMN_NAME}</td>
				<td>{$smarty.const.TABLE_COLUMN_SORT}</td>
				<td><input type="checkbox" class="chk_all"></td>
			</tr>
		</thead>
		<tbody class="data_body">
			{if $arrSections}
				{foreach from=$arrSections item="sections" name="sections"}
					<tr>
						<td style="width: 80%;">
							<a href="{$smarty.const.CONF_ADMIN_FILE}?m=dictionary&amp;s=sections&amp;action=professions&amp;pid={$sections.id}" class="sections">{$sections.name}</a>
						</td>
						<td style="text-align: center; vertical-align: top;">
							<input type="text" name="sort_section[{$sections.id}]" value="{$sections.sort}" size="5" maxlength="3" class="text">
						</td>
						<td style="text-align: center; vertical-align: top;">
							<input type="checkbox" name="section[{$sections.id}]" class="chk_sections">
						</td>
					</tr>
				{/foreach}
				</tbody>
				<tfoot class="data_foot">
					<tr>
						<td style="text-align: center; width: 80%;">
							{$smarty.const.TABLE_RECORDS}&nbsp;{$smarty.foreach.sections.total}
						</td>
						<td style="text-align: right;" colspan="2">
							<select name="action" class="select">
								<option value="">{$smarty.const.FORM_ACTION_SELECT}</option>
								<option value="edit">{$smarty.const.FORM_ACTION_EDIT}</option>
								<option value="sort">{$smarty.const.FORM_ACTION_SAVE_SORT}</option>
								<option value="del">{$smarty.const.FORM_ACTION_DELETE_SELECTED}</option>
							</select>
							<input type="submit" value="{$smarty.const.FORM_BUTTON_EXECUTE}" class="button" style="margin: 5px;">
						</td>
					</tr>
				</tfoot>
			{else}
					<tr>
						<td align="center" colspan="3">
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
		$('.chk_all').click( function()
		{
			var current = $(this);
			$('.chk_sections').each( function()
			{
				(current.is(':checked')) ? $(this).attr('checked', true) : $(this).attr('checked', false);
			});
		});

		// проверяем выбранное действие
		$('form[name="ActionSections"]').submit( function()
		{
			if (!$('select[name="action"] option:selected').val())
			{
				$.alert('{$smarty.const.ERROR_NOT_SELECT_ACTION}');
				return false;
			}
			else
			{
				if ('sort' !== $("select[name='action'] option:selected").val() && !$('input:checked').size())
				{
					$.alert('{$smarty.const.MESSAGE_WARNING_NOT_SELECT_RECORDS}');
					return false;
				}

				return ('del' === $("select[name='action'] option:selected").val()) ? confirm('{$smarty.const.MESSAGE_DELETE_RECORDS_SECTIONS}') : true;
			}
		});
	});
-->
</script>