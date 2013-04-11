<form action="{$smarty.const.CONF_ADMIN_FILE}?m=manager&amp;s=news&amp;action=edit&amp;id={$retFields.id}" method="post" enctype="multipart/form-data">
<table style="width: 100%; border: 0px; text-align: left;">
	<tr>
		<td>
			{$smarty.const.FORM_PUBLICATION_DATE} <input type="text" name="date" class="datepicker" size="15" value="{$retFields.datetime|default:$smarty.now|date_format:"%Y-%m-%d"}" readonly="readonly">
			{$smarty.const.FORM_PUBLICATION_TIME} {html_select_time display_seconds=false time=$retFields.datetime field_array="time"}
			<input type="checkbox" name="arrBindFields[token]" {if $retFields.token eq 'active'}checked{/if}> {$smarty.const.RECORD_ACTIVE}
			<span class="colorbox_help" id="HELP_ADMIN_NEWS_PUBLICATION"><img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/help_icon.png" alt="{$smarty.const.FORM_IMG_HELP}"></span>
		</td>
	</tr>
	<tr>
		<td>
			<label><input type="checkbox" name="arrNoBindFields[noComments]" {if $retFields.noComments}checked="checked"{/if}>&nbsp;{$smarty.const.FORM_NO_COMMENTS}</label>
		</td>
	</tr>
	<tr>
		<td>
			<p>{$smarty.const.FORM_TITLE}</p>
			<input type="text" name="arrBindFields[title]" value="{$retFields.title|escape}" size="100">
		</td>
	</tr>
	<tr>
		<td>
			<p>{$smarty.const.FORM_SMALL_TEXT}</p>
			<textarea name="arrBindFields[small_text]" rows="10" cols="80" {if $smarty.const.CONF_USE_VISUAL_EDITOR}class="tinymce"{/if}>{$retFields.small_text}</textarea>
		</td>
	</tr>
	<tr>
		<td>
			<p>{$smarty.const.FORM_TEXT}</p>
			<textarea name="arrBindFields[text]" rows="10" cols="80" {if $smarty.const.CONF_USE_VISUAL_EDITOR}class="tinymce"{/if}>{$retFields.text}</textarea>
		</td>
	</tr>
	<tr>
		<td>
			<p>{$smarty.const.FORM_KEYWORDS}</p>
			<textarea name="arrNoBindFields[meta_keywords]" rows="2" cols="80">{$retFields.meta_keywords}</textarea>
		</td>
	</tr>
	<tr>
		<td>
			<p>{$smarty.const.FORM_DESCRIPTION}</p>
			<textarea name="arrNoBindFields[meta_description]" rows="5" cols="80">{$retFields.meta_description}</textarea>
		</td>
	</tr>
	<tr>
		<td style="text-align: left;" colspan="2">
			<input type="submit" name="save" value="{$smarty.const.FORM_BUTTON_SAVE}" class="button">
		</td>
	</tr>
</table>
</form>