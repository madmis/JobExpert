<form action="{$smarty.const.CONF_ADMIN_FILE}?m=dictionary&amp;s=articles.sections&amp;action={if $action.add}add{else}edit&amp;id={$return_data.id}{/if}" method="post" enctype="multipart/form-data">
<table style="width: 100%; border: 0px;" cellspacing="0" class="add_table">
	<thead>
		<tr>
			<td>
			   {if $action.add}{$smarty.const.MENU_DICTIONARY_ARTICLES_SECTIONS_ADD}{else}{$smarty.const.MENU_DICTIONARY_ARTICLES_SECTIONS_EDIT}{/if}
			</td>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td align="left" style="width: 100%; border: 0px;">
				<table style="width: 100%; border: 0px;">
					<tbody>
						<tr>
							<td>
								{$smarty.const.TABLE_COLUMN_NAME}&nbsp;<input type="text" name="arrBindFields[name]" class="text" size="50" value="{$return_data.name}">
							</td>
							<td>
								{$smarty.const.TABLE_COLUMN_AFFILIATION}&nbsp;
								<select name="arrBindFields[affiliation]" class="select">
									<option value="none">{$smarty.const.FORM_DICTIONARY_ART_SECTIONS_AFFILIATION_ALL}</option>
									<option value="employer" {if $return_data.affiliation eq 'employer'}selected{/if}>{$smarty.const.FORM_TYPE_EMPLOYER}</option>
									<option value="competitor" {if $return_data.affiliation eq 'competitor'}selected{/if}>{$smarty.const.FORM_TYPE_COMPETITOR}</option>
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
			<td colspan="2">
				<input type="submit" name="save" value="{$smarty.const.FORM_BUTTON_SAVE}" class="button">
			</td>
		</tr>
	</tfoot>
</table>
</form> 