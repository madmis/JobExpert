<form action="{$smarty.const.CONF_ADMIN_FILE}?m=manager&amp;s=articles&amp;action={if $actions.add}add{else}edit&amp;id={$return_data.id}{/if}" method="post" enctype="multipart/form-data">
<table style="width: 100%; border: 0px; text-align: left;">
	<tr>
		<td colspan="2">
			{$smarty.const.FORM_ARTICLES_SECTION}&nbsp;
			<select name="arrBindFields[id_section]">
				<option value="" style="font-weight: bold;">------- {$smarty.const.FORM_DICTIONARY_ART_SECTIONS_AFFILIATION_ALL} -------</option>
			{if $sections.split.none}
				{foreach from=$sections.split.none item="section"}
					<option value="{$section.id}" {if $return_data.id_section eq $section.id}selected{/if}>{$section.name}</option>
				{/foreach}
			{/if}
				<option value="" style="font-weight: bold;">------- {$smarty.const.FORM_TYPE_EMPLOYER} -------</option>
			{if $sections.split.employer}
				{foreach from=$sections.split.employer item="section"}
					<option value="{$section.id}" {if $return_data.id_section eq $section.id}selected{/if}>{$section.name}</option>
				{/foreach}
			{/if}
				<option value="" style="font-weight: bold;">------- {$smarty.const.FORM_TYPE_COMPETITOR} -------</option>
			{if $sections.split.competitor}
				{foreach from=$sections.split.competitor item="section"}
					<option value="{$section.id}" {if $return_data.id_section eq $section.id}selected{/if}>{$section.name}</option>
				{/foreach}
			{/if}
			</select>
		</td>
	</tr>
	<tr>
		<td colspan="2">
			{$smarty.const.FORM_PUBLICATION_DATE} <input type="text" name="date" class="datepicker" size="15" value="{$return_data.datetime|default:$smarty.now|date_format:"%Y-%m-%d"}" readonly="readonly">
			{$smarty.const.FORM_PUBLICATION_TIME} {html_select_time display_seconds=false time=$return_data.datetime field_array="time"}
			<input type="checkbox" name="arrBindFields[token]" {if $return_data.token eq 'active'}checked{/if}> {$smarty.const.RECORD_ACTIVE}
			<span class="colorbox_help" id="HELP_ADMIN_NEWS_PUBLICATION">
				<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/help_icon.png" alt="{$smarty.const.FORM_IMG_HELP}" title="{$smarty.const.FORM_IMG_HELP}">
			</span>
		</td>
	</tr>
	<tr>
		<td>
			<label><input type="checkbox" name="arrNoBindFields[noComments]" {if $return_data.noComments}checked="checked"{/if}>&nbsp;{$smarty.const.FORM_NO_COMMENTS}</label>
		</td>
	</tr>
	<tr>
		<td colspan="2">
			<p>{$smarty.const.FORM_TITLE}</p>
			<input type="text" name="arrBindFields[title]" value="{$return_data.title|escape}" size="100">
		</td>
	</tr>
	<tr>
		<td colspan="2">
			<p>{$smarty.const.FORM_SMALL_TEXT}</p>
			<textarea name="arrBindFields[small_text]" rows="10" cols="80" {if $smarty.const.CONF_USE_VISUAL_EDITOR}class="tinymce"{/if}>{$return_data.small_text}</textarea>
		</td>
	</tr>
	<tr>
		<td colspan="2">
			<p>{$smarty.const.FORM_TEXT}</p>
			<textarea name="arrBindFields[text]" rows="10" cols="80" {if $smarty.const.CONF_USE_VISUAL_EDITOR}class="tinymce"{/if}>{$return_data.text}</textarea>
		</td>
	</tr>
	<tr>
		<td colspan="2">
			<p>{$smarty.const.FORM_KEYWORDS}</p>
			<textarea name="arrNoBindFields[meta_keywords]" rows="2" cols="80">{$return_data.meta_keywords}</textarea>
		</td>
	</tr>
	<tr>
		<td colspan="2">
			<p>{$smarty.const.FORM_DESCRIPTION}</p>
			<textarea name="arrNoBindFields[meta_description]" rows="5" cols="80">{$return_data.meta_description}</textarea>
		</td>
	</tr>
	<tr>
		<td align="left" colspan="2">
			<input type="submit" name="save" value="{$smarty.const.FORM_BUTTON_SAVE}" class="button">
		</td>
	</tr>
</table>
</form>