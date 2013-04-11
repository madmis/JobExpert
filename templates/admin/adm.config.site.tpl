{* Ошибки *}
{if $errors}{include file="adm.errors.message.tpl"}{/if}

<form action="{$smarty.const.CONF_ADMIN_FILE}?m=config&s=site" method="post">
<table style="width: 100%;" class="data_table" cellspacing="1" cellpadding="1">
	<tr>
		<td>{$smarty.const.FORM_TITLE_SITE}</td>
		<td><input type="text" name="title" size="80" value="{$smarty.const.CONF_DEFAULT_TITLE}" class="text"></td>
		<td style="text-align: center;">
			<span class="colorbox_help" id="HELP_ADMIN_SITE_TITLE">
				<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/help_icon.png" alt="{$smarty.const.FORM_IMG_HELP}">
			</span>
		</td>
	</tr>
	<tr>
		<td>{$smarty.const.FORM_DESCRIPTION}</td>
		<td><textarea name="description" cols="60" rows="2" class="text">{$smarty.const.CONF_DEFAULT_DESCRIPTION}</textarea></td>
		<td style="text-align: center;">
			<span class="colorbox_help" id="HELP_ADMIN_SITE_DESCRIPTION">
				<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/help_icon.png" alt="{$smarty.const.FORM_IMG_HELP}">
			</span>
		</td>
	</tr>
	<tr>
		<td>{$smarty.const.FORM_KEYWORDS}</td>
		<td><textarea name="keywords" cols="60" rows="2" class="text">{$smarty.const.CONF_DEFAULT_KEYWORDS}</textarea></td>
		<td style="text-align: center;">
			<span class="colorbox_help" id="HELP_ADMIN_SITE_KEYWORDS">
				<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/help_icon.png" alt="{$smarty.const.FORM_IMG_HELP}">
			</span>
		</td>
	</tr>
	<tr>
		<td>{$smarty.const.FORM_SITE_NAME}</td>
		<td><input type="text" name="site_name" size="50" value="{$smarty.const.CONF_SITE_NAME}" class="text"></td>
		<td style="text-align: center;">
			<span class="colorbox_help" id="HELP_ADMIN_SITE_NAME">
				<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/help_icon.png" alt="{$smarty.const.FORM_IMG_HELP}">
			</span>
		</td>
	</tr>
	<tr>
		<td>{$smarty.const.FORM_SITE_NAME_TO_TITLE}</td>
		<td><input type="checkbox" name="site_name_to_title"{if $smarty.const.CONF_SITE_NAME_TO_TITLE} checked="checked"{/if}></td>
		<td style="text-align: center;">
			<span class="colorbox_help" id="HELP_ADMIN_SITE_NAME_TO_TITLE">
				<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/help_icon.png" alt="{$smarty.const.FORM_IMG_HELP}">
			</span>
		</td>
	</tr>
	<tr>
		<td>{$smarty.const.FORM_TITLE_PAGE_SEPERATOR}</td>
		<td><input type="text" name="title_page_separator" size="5" maxlength="5" value="{$smarty.const.CONF_TITLE_PAGE_SEPERATOR}" class="text"></td>
		<td style="text-align: center;">
			<span class="colorbox_help" id="HELP_ADMIN_TITLE_PAGE_SEPERATOR">
				<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/help_icon.png" alt="{$smarty.const.FORM_IMG_HELP}">
			</span>
		</td>
	</tr>
	<tr>
		<td>{$smarty.const.FORM_LANGUAGE}</td>
		<td>
			<select name="language" class="select">
			{foreach from=$language_dirs item="lang"}
				<option value="{$lang}" {if $lang eq $smarty.const.CONF_LANGUAGE}selected{/if}>{$lang}</option>
			{/foreach}
			</select>
		</td>
		<td style="text-align: center;">
			<span class="colorbox_help" id="HELP_ADMIN_SITE_LANGUAGE">
				<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/help_icon.png" alt="{$smarty.const.FORM_IMG_HELP}">
			</span>
		</td>
	</tr>
	<tr>
		<td>{$smarty.const.FORM_SITE_URL}</td>
		<td><input type="text" name="site_url" size="50" value="{$smarty.const.CONF_SITE_URL}" class="text"></td>
		<td style="text-align: center;">
			<span class="colorbox_help" id="HELP_ADMIN_SITE_URL">
				<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/help_icon.png" alt="{$smarty.const.FORM_IMG_HELP}">
			</span>
		</td>
	</tr>
	<tr>
		<td>{$smarty.const.FORM_SCRIPT_URL}</td>
		<td><input type="text" name="script_url" size="50" value="{$smarty.const.CONF_SCRIPT_URL}" class="text"></td>
		<td style="text-align: center;">
			<span class="colorbox_help" id="HELP_ADMIN_SITE_SCRIPT_URL">
				<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/help_icon.png" alt="{$smarty.const.FORM_IMG_HELP}">
			</span>
		</td>
	</tr>

	<tr>
		<td>{$smarty.const.FORM_USE_REDIRECT_EXTERNAL_LINK}</td>
		<td><input type="checkbox" name="redirect_extLink"{if $smarty.const.CONF_USE_REDIRECT_EXTERNAL_LINK} checked="checked"{/if}></td>
		<td style="text-align: center;">
			 <span class="colorbox_help" id="HELP_ADMIN_USE_REDIRECT_EXTERNAL_LINK">
				<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/help_icon.png" alt="{$smarty.const.FORM_IMG_HELP}">
			</span>
		</td>
	</tr>

	<tr>
		<td>{$smarty.const.FORM_USE_VISUAL_EDITOR}</td>
		<td><input type="checkbox" name="visual_editor"{if $smarty.const.CONF_USE_VISUAL_EDITOR} checked="checked"{/if}></td>
		<td style="text-align: center;">
			<span class="colorbox_help" id="HELP_ADMIN_SITE_USE_VISUAL_EDITOR">
				<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/help_icon.png" alt="{$smarty.const.FORM_IMG_HELP}">
			</span>
		</td>
	</tr>
	<tr>
		<td>{$smarty.const.FORM_ENABLE_CACHING}</td>
		<td><input type="checkbox" name="caching"{if $smarty.const.CONF_ENABLE_CACHING} checked="checked"{/if}></td>
		<td style="text-align: center;">
			<span class="colorbox_help" id="HELP_ADMIN_SITE_ENABLE_CACHING">
				<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/help_icon.png" alt="{$smarty.const.FORM_IMG_HELP}">
			</span>
		</td>
	</tr>
	<tr>
		<td>{$smarty.const.FORM_DISABLE_AUTO_COUNTERS}</td>
		<td><input type="checkbox" name="disable_auto_counters"{if $smarty.const.CONF_DISABLE_AUTO_COUNTERS} checked="checked"{/if}></td>
		<td style="text-align: center;">
			<span class="colorbox_help" id="HELP_ADMIN_SITE_DISABLE_AUTO_COUNTERS">
				<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/help_icon.png" alt="{$smarty.const.FORM_IMG_HELP}">
			</span>
		</td>
	</tr>
	<tr>
		<td>{$smarty.const.FORM_ENABLE_CHPU}</td>
		<td><input type="checkbox" name="chpu"{if $smarty.const.CONF_ENABLE_CHPU} checked="checked"{/if}></td>
		<td style="text-align: center;">
			<span class="colorbox_help" id="HELP_ADMIN_SITE_ENABLE_CHPU">
				<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/help_icon.png" alt="{$smarty.const.FORM_IMG_HELP}">
			</span>
		</td>
	</tr>
	<tr>
		<td>{$smarty.const.FORM_ENABLE_TRANSLITERATION_CHPU}</td>
		<td>
			<input type="checkbox" name="tChpu"{if $smarty.const.CONF_ENABLE_TRANSLITERATION_CHPU} checked="checked"{/if}{if !$smarty.const.CONF_ENABLE_CHPU} disabled="disabled"{/if}>
			{if !$smarty.const.CONF_ENABLE_CHPU}
				<input type="hidden" name="tChpu" value="{$smarty.const.CONF_ENABLE_TRANSLITERATION_CHPU}">
			{/if}
		</td>
		<td style="text-align: center;">
			<span class="colorbox_help" id="HELP_ADMIN_SITE_ENABLE_TRANSLITERATION_CHPU">
				<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/help_icon.png" alt="{$smarty.const.FORM_IMG_HELP}">
			</span>
		</td>
	</tr>
	<tr>
		<td>{$smarty.const.FORM_TRANSLITERATION_CHPU_ID_PUT_TO_END}</td>
		<td>
			<input type="radio" name="tChpuPutToEnd" value="0"{if !$smarty.const.CONF_TRANSLITERATION_CHPU_ID_PUT_TO_END} checked="checked"{/if}{if !$smarty.const.CONF_ENABLE_CHPU || !$smarty.const.CONF_ENABLE_TRANSLITERATION_CHPU} disabled="disabled"{/if}>&nbsp;{$smarty.const.FORM_PLACE_AT_FIRST}
			&nbsp;&nbsp;&nbsp;
			<input type="radio" name="tChpuPutToEnd" value="1"{if $smarty.const.CONF_TRANSLITERATION_CHPU_ID_PUT_TO_END} checked="checked"{/if}{if !$smarty.const.CONF_ENABLE_CHPU || !$smarty.const.CONF_ENABLE_TRANSLITERATION_CHPU} disabled="disabled"{/if}>&nbsp;{$smarty.const.FORM_PLACE_AT_CLOSE}
			{if !$smarty.const.CONF_ENABLE_CHPU || !$smarty.const.CONF_ENABLE_TRANSLITERATION_CHPU}
				<input type="hidden" name="tChpuPutToEnd" value="{$smarty.const.CONF_TRANSLITERATION_CHPU_ID_PUT_TO_END}">
			{/if}
		</td>
		<td style="text-align: center;">
			<span class="colorbox_help" id="HELP_ADMIN_SITE_TRANSLITERATION_CHPU_ID_PUT_TO_END">
				<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/help_icon.png" alt="{$smarty.const.FORM_IMG_HELP}">
			</span>
		</td>
	</tr>
	<tr>
		<td>{$smarty.const.FORM_TRANSLITERATION_CHPU_MAX_LENGHT}</td>
		<td>
			<input type="text" name="tChpuMaxLenght" size="5" maxlength="5" value="{$smarty.const.CONF_TRANSLITERATION_CHPU_MAX_LENGHT}" class="text"{if !$smarty.const.CONF_ENABLE_CHPU || !$smarty.const.CONF_ENABLE_TRANSLITERATION_CHPU} disabled="disabled"{/if}>
			{if !$smarty.const.CONF_ENABLE_CHPU || !$smarty.const.CONF_ENABLE_TRANSLITERATION_CHPU}
				<input type="hidden" name="tChpuMaxLenght" value="{$smarty.const.CONF_TRANSLITERATION_CHPU_MAX_LENGHT}">
			{/if}
		</td>
		<td style="text-align: center;">
			<span class="colorbox_help" id="HELP_ADMIN_SITE_TRANSLITERATION_CHPU_MAX_LENGHT">
				<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/help_icon.png" alt="{$smarty.const.FORM_IMG_HELP}">
			</span>
		</td>
	</tr>
	<tr>
		<td>{$smarty.const.FORM_CHPU_HTML_DATA_EXT}</td>
		<td>
			<input type="text" name="tChpuHtmlDataExt" size="5" maxlength="10" value="{$smarty.const.CONF_CHPU_HTML_DATA_EXT}" class="text"{if !$smarty.const.CONF_ENABLE_CHPU} disabled="disabled"{/if}>
			{if !$smarty.const.CONF_ENABLE_CHPU}
				<input type="hidden" name="tChpuHtmlDataExt" value="{$smarty.const.CONF_CHPU_HTML_DATA_EXT}">
			{/if}
		</td>
		<td style="text-align: center;">
			<span class="colorbox_help" id="HELP_ADMIN_SITE_CHPU_HTML_DATA_EXT">
				<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/help_icon.png" alt="{$smarty.const.FORM_IMG_HELP}">
			</span>
		</td>
	</tr>
	<tr>
		<td>{$smarty.const.FORM_CHPU_XML_DATA_EXT}</td>
		<td>
			<input type="text" name="tChpuXmlDataExt" size="5" maxlength="10" value="{$smarty.const.CONF_CHPU_XML_DATA_EXT}" class="text"{if !$smarty.const.CONF_ENABLE_CHPU} disabled="disabled"{/if}>
			{if !$smarty.const.CONF_ENABLE_CHPU}
				<input type="hidden" name="tChpuXmlDataExt" value="{$smarty.const.CONF_CHPU_XML_DATA_EXT}">
			{/if}
		</td>
		<td style="text-align: center;">
			<span class="colorbox_help" id="HELP_ADMIN_SITE_CHPU_XML_DATA_EXT">
				<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/help_icon.png" alt="{$smarty.const.FORM_IMG_HELP}">
			</span>
		</td>
	</tr>
</table>
<p style="text-align: center;"><input type="submit" name="save" value="{$smarty.const.FORM_BUTTON_SAVE}" class="button"></p>
</form>
