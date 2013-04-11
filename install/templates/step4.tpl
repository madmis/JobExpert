<form action="install.php?step=4" method="post" enctype="multipart/form-data">
<h2 class="center">{$smarty.const.SITE_CONF_HEAD}</h2>
<table class="centerTable configTable">
	<tr>
		<td>{$smarty.const.SITE_CONF_TITLE}</td>
		<td><input type="text" name="title" size="80" value="{$smarty.const.CONF_DEFAULT_TITLE}"></td>
	</tr>
	<tr>
		<td>{$smarty.const.SITE_CONF_DESCRIPTION}</td>
		<td><textarea name="description" cols="60" rows="6">{$smarty.const.CONF_DEFAULT_DESCRIPTION}</textarea></td>
	</tr>
	<tr>
		<td>{$smarty.const.SITE_CONF_KEYWORDS}</td>
		<td><textarea name="keywords" cols="60" rows="6">{$smarty.const.CONF_DEFAULT_KEYWORDS}</textarea></td>
	</tr>
	<tr>
		<td>{$smarty.const.SITE_CONF_SITE_NAME}</td>
		<td><input type="text" name="site_name" size="50" value="{$smarty.const.CONF_SITE_NAME}"></td>
	</tr>
	<tr>
		<td>{$smarty.const.SITE_CONF_SITE_NAME_TO_TITLE}</td>
		<td><input type="checkbox" name="site_name_to_title" {if $smarty.const.CONF_SITE_NAME_TO_TITLE}checked="checked"{/if}></td>
	</tr>
	<tr>
		<td>{$smarty.const.SITE_CONF_TITLE_PAGE_SEPERATOR}</td>
		<td><input type="text" name="title_page_separator" size="5" maxlength="5" value="{$smarty.const.CONF_TITLE_PAGE_SEPERATOR}"></td>
	</tr>

	<tr>
		<td>{$smarty.const.SITE_CONF_LANGUAGE}</td>
		<td>
			<select name="language">
			{foreach from=$langDirs item="lang"}
				<option value="{$lang}" {if $lang eq $smarty.const.CONF_LANGUAGE}selected="selected"{/if}>{$lang}</option>
			{/foreach}
			</select>
		</td>
	</tr>

	<tr>
		<td>{$smarty.const.SITE_CONF_SITE_URL}</td>
		<td><input type="text" name="site_url" size="50" value="{$host}"></td>
	</tr>
	<tr>
		<td>{$smarty.const.SITE_CONF_USE_REDIRECT_EXTERNAL_LINK}</td>
		<td><input type="checkbox" name="redirect_extLink"{if $smarty.const.CONF_USE_REDIRECT_EXTERNAL_LINK} checked="checked"{/if}></td>
	</tr>

	<tr>
		<td>{$smarty.const.SITE_CONF_USE_VISUAL_EDITOR}</td>
		<td><input type="checkbox" name="visual_editor" {if $smarty.const.CONF_USE_VISUAL_EDITOR}checked="checked"{/if}></td>
	</tr>
	<tr>
		<td>{$smarty.const.SITE_CONF_ENABLE_CACHING}</td>
		<td><input type="checkbox" name="caching" {if $smarty.const.CONF_ENABLE_CACHING}checked="checked"{/if}></td>
	</tr>
	<tr>
		<td>{$smarty.const.SITE_CONF_DISABLE_AUTO_COUNTERS}</td>
		<td><input type="checkbox" name="counters" {if $smarty.const.CONF_DISABLE_AUTO_COUNTERS}checked="checked"{/if}></td>
	</tr>
	<tr>
		<td>{$smarty.const.SITE_CONF_ENABLE_CHPU}</td>
		<td><input type="checkbox" name="chpu" {if $smarty.const.CONF_ENABLE_CHPU}checked="checked"{/if}></td>
	</tr>
	<tr>
		<td>{$smarty.const.SITE_CONF_ENABLE_TRANSLITERATION_CHPU}</td>
		<td><input type="checkbox" name="tChpu" {if $smarty.const.CONF_ENABLE_TRANSLITERATION_CHPU}checked="checked"{/if} {if !$smarty.const.CONF_ENABLE_CHPU}disabled="disabled"{/if}></td>
	</tr>
	<tr>
		<td>{$smarty.const.SITE_CONF_TRANSLITERATION_CHPU_ID_PUT_TO_END}</td>
		<td>
			<input type="radio" name="tChpuPutToEnd" value="0"{if !$smarty.const.CONF_TRANSLITERATION_CHPU_ID_PUT_TO_END} checked="checked"{/if}{if !$smarty.const.CONF_ENABLE_CHPU || !$smarty.const.CONF_ENABLE_TRANSLITERATION_CHPU} disabled="disabled"{/if}>&nbsp;{$smarty.const.FORM_PLACE_AT_FIRST}
			&nbsp;&nbsp;&nbsp;
			<input type="radio" name="tChpuPutToEnd" value="1"{if $smarty.const.CONF_TRANSLITERATION_CHPU_ID_PUT_TO_END} checked="checked"{/if}{if !$smarty.const.CONF_ENABLE_CHPU || !$smarty.const.CONF_ENABLE_TRANSLITERATION_CHPU} disabled="disabled"{/if}>&nbsp;{$smarty.const.FORM_PLACE_AT_CLOSE}
			{if !$smarty.const.CONF_ENABLE_CHPU || !$smarty.const.CONF_ENABLE_TRANSLITERATION_CHPU}
				<input type="hidden" name="tChpuPutToEnd" value="{$smarty.const.CONF_TRANSLITERATION_CHPU_ID_PUT_TO_END}">
			{/if}
		</td>
	</tr>
	<tr>
		<td>{$smarty.const.SITE_CONF_TRANSLITERATION_CHPU_MAX_LENGHT}</td>
		<td><input type="text" name="tChpuMaxLenght" size="5" maxlength="5" value="{$smarty.const.CONF_TRANSLITERATION_CHPU_MAX_LENGHT}"></td>
	</tr>
	<tr>
		<td>{$smarty.const.SITE_CONF_CHPU_HTML_DATA_EXT}</td>
		<td><input type="text" name="tChpuHtmlDataExt" size="5" maxlength="10" value="{$smarty.const.CONF_CHPU_HTML_DATA_EXT}"></td>
	</tr>
	<tr>
		<td>{$smarty.const.SITE_CONF_CHPU_XML_DATA_EXT}</td>
		<td><input type="text" name="tChpuXmlDataExt" size="5" maxlength="10" value="{$smarty.const.CONF_CHPU_XML_DATA_EXT}"></td>
	</tr>
	

</table>
<div class="form">
	<span class="floatLeft"><a href="install.php?step=3" class="prevButton"><< {$smarty.const.BUTTON_PREV}</a></span>
	<span class="floatRight"><input type="submit" name="step4" class="nextButton" value="{$smarty.const.BUTTON_NEXT} >>"></span>
</div>
</form>