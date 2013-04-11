<p class="sub_menu">
	<span class="colorbox_help" id="HELP_ADMIN_DICTIONARY_ARTICLES_SECTIONS">
		<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/actions/help.png" alt="{$smarty.const.FORM_IMG_HELP}" title="{$smarty.const.FORM_IMG_HELP}">
	</span>
</p>

{* Ошибки *}
{if $errors}{include file="adm.errors.message.tpl"}{/if}

{if $action.add OR $action.edit}
	{include file="adm.dictionary.articles.sections.add.tpl"}
{* Вывод всех разделов *}
{else}
	<form action="{$smarty.const.CONF_ADMIN_FILE}?m=dictionary&amp;s=articles.sections" method="post" enctype="multipart/form-data">
	<table style="width: 100%; border: 0px; text-align: left;" cellspacing="5" cellpadding="3">
		<thead class="data_head">
			<tr>
				<td align="center">{$smarty.const.TABLE_COLUMN_NAME}</td>
				<td align="center">{$smarty.const.TABLE_COLUMN_AFFILIATION}</td>
				<td><input type="checkbox" id="s_all"></td>
			</tr>
		</thead>
		<tbody class="data_body">
		{if $sections}
			{foreach from=$sections item="section" name="i"}
				<tr>
					<td>
						<a href="{$smarty.const.CONF_ADMIN_FILE}?m=dictionary&amp;s=articles.sections&amp;action=edit&amp;id={$section.id}">{$section.name}</a>
					</td>
					<td align="center">
						{if $section.affiliation eq 'employer'}
							{$smarty.const.FORM_TYPE_EMPLOYER}
						{elseif $section.affiliation eq 'competitor'}
							{$smarty.const.FORM_TYPE_COMPETITOR}
						{else}
							{$smarty.const.FORM_DICTIONARY_ART_SECTIONS_AFFILIATION_ALL}
						{/if}
					</td>
					<td align="center">
						<input type="checkbox" name="sections[{$section.id}]">
					</td>
				</tr>
			{/foreach}
			</tbody>
			<tfoot class="data_foot">
				<tr>
					<td align="center">
						{$smarty.const.TABLE_RECORDS} {$smarty.foreach.i.total}
					</td>
					<td colspan="2" align="right">
						<select name="action" class="select">
							<option value="del">{$smarty.const.FORM_ACTION_DELETE_SELECTED}</option>
						</select>
						<input type="submit" value="{$smarty.const.FORM_BUTTON_EXECUTE}" class="button">
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
		$('#s_all').click( function()
		{
			var current = $(this);

			$(":checkbox[name^='sections']").each( function(i)
			{
				( current.is(':checked') ) ? $(this).attr('checked', true) : $(this).attr('checked', false);
      		});
		});

		// проверяем выбранное действие
		$("form:last").submit( function()
		{
			if ( $("select[name='action'] option:selected").val() === 'del' )
			{
			    return confirm('{$smarty.const.MESSAGE_DELETE_RECORDS_ARTICLES_SECTIONS}');
			}
			else
			{
				return true;
			}
		});
	});
	-->
	</script>

{/if}