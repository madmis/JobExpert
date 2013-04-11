<form id="EditForm" action="{$smarty.const.CONF_ADMIN_FILE}?m=manager&amp;s=dop.pages&amp;action=edit&amp;id={$return_data.id}" method="post" enctype="multipart/form-data">
<table style="width: 100%; border: 0px; text-align: left;">
	<tr>
		<td colspan="2">
			<p>{$smarty.const.FORM_DOP_PAGE_ID}</p>
			<input type="text" name="arrBindFields[id]" value="{$return_data.id}" size="40" class="text" maxlength="30">
		</td>
	</tr>
	<tr>
		<td colspan="2">
			<p>{$smarty.const.FORM_DOP_PAGE_NAME}</p>
			<input type="text" name="arrBindFields[title]" value="{$return_data.title|escape}" size="100" class="text">
		</td>
	</tr>
	<tr>
		<td colspan="2">
			<p>{$smarty.const.FORM_DOP_PAGE_TEXT}</p>
			<textarea name="arrNoBindFields[text]" rows="20" cols="100" {if $smarty.const.CONF_USE_VISUAL_EDITOR}class="tinymce"{else}class="text"{/if}>{$return_data.text}</textarea>
		</td>
	</tr>
	<tr>
		<td colspan="2">
			<p>{$smarty.const.FORM_KEYWORDS}</p>
			<textarea name="arrNoBindFields[meta_keywords]" rows="5" cols="100" class="text">{$return_data.meta_keywords}</textarea>
		</td>
	</tr>
	<tr>
		<td colspan="2">
			<p>{$smarty.const.FORM_DESCRIPTION}</p>
			<textarea name="arrNoBindFields[meta_description]" rows="5" cols="100" class="text">{$return_data.meta_description}</textarea>
		</td>
	</tr>
	<tr>
		<td colspan="2">
			{$smarty.const.TABLE_COLUMN_SORT} <input type="text" name="arrNoBindFields[sort]" value="{$return_data.sort}" size="5" class="text">
			<input type="checkbox" name="arrNoBindFields[token]" {if $return_data.token eq 'active'}checked{/if}> {$smarty.const.FORM_DOP_PAGE_SHOW}
		</td>
	</tr>
	<tr>
		<td align="left" colspan="2">
			<input type="submit" name="save" value="{$smarty.const.FORM_BUTTON_SAVE}" class="button">
		</td>
	</tr>
</table>
</form>