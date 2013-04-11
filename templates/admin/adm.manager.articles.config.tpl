<form action="{$smarty.const.CONF_ADMIN_FILE}?m=manager&amp;s=articles&amp;action=config" method="post">
<table style="width: 100%;" class="data_table" style="border-spacing: 5px;">
	<tr>
		<td>{$smarty.const.FORM_CONF_PERPAGE}</td>
		<td>
			<input type="text" name="perpage" size="5" value="{$smarty.const.CONF_ARTICLES_PERPAGE}" class="text">
		</td>
		<td style="text-align: center;">
			<span class="colorbox_help" id="HELP_ADMIN_CONF_STRINGS_PERPAGE_USER">
				<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/help_icon.png" alt="{$smarty.const.FORM_IMG_HELP}">
			</span>
		</td>
	</tr>
	<tr>
		<td>{$smarty.const.FORM_CONF_ARTICLES_ADD_SUCCESS_ADMIN_INFORM}</td>
		<td>
			<input type="checkbox" name="addInform" {if $smarty.const.CONF_ARTICLES_ADD_SUCCESS_ADMIN_INFORM}checked="checked"{/if}>
		</td>
		<td style="text-align: center;">
			<span class="colorbox_help" id="HELP_ADMIN_CONF_ARTICLES_ADD_SUCCESS_ADMIN_INFORM">
				<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/help_icon.png" alt="{$smarty.const.FORM_IMG_HELP}">
			</span>
		</td>
	</tr>
	<tr>
		<td>{$smarty.const.FORM_CONF_ARTICLES_ADD_MODERATION_ADMIN_INFORM}</td>
		<td>
			<input type="checkbox" name="moderateInform" {if $smarty.const.CONF_ARTICLES_ADD_MODERATION_ADMIN_INFORM}checked="checked"{/if}>
		</td>
		<td style="text-align: center;">
			<span class="colorbox_help" id="HELP_ADMIN_CONF_ARTICLES_ADD_MODERATION_ADMIN_INFORM">
				<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/help_icon.png" alt="{$smarty.const.FORM_IMG_HELP}">
			</span>
		</td>
	</tr>
	<tr>
		<td>{$smarty.const.FORM_CONF_ARTICLES_CORRECTION_THERM}</td>
		<td>
			<input type="text" name="correctionTerm" size="5" value="{$smarty.const.CONF_ARTICLES_CORRECTION_THERM}" class="text">
		</td>
		<td style="text-align: center;">
			<span class="colorbox_help" id="HELP_ADMIN_CONF_ARTICLES_CORRECTION_THERM">
				<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/help_icon.png" alt="{$smarty.const.FORM_IMG_HELP}">
			</span>
		</td>
	</tr>
	<tr>
		<td>{$smarty.const.FORM_CONF_ARTICLES_TITLE}</td>
		<td>
			<label><input type="checkbox" name="titleSectionSite"{if $smarty.const.CONF_ARTICLES_TITLE_SECTION_SITE} checked="checked"{/if}>{$smarty.const.FORM_CONF_ARTICLES_TITLE_SECTION_SITE}</label>
			<br>
			<label><input type="checkbox" name="titleSectionArticle"{if $smarty.const.CONF_ARTICLES_TITLE_SECTION_ARTICLE} checked="checked"{/if}>{$smarty.const.FORM_CONF_ARTICLES_TITLE_SECTION_ARTICLE}</label>
			<br>
			<label><input type="checkbox" name="titleArticleName"{if $smarty.const.CONF_ARTICLES_TITLE_ARTICLE_NAME} checked="checked"{/if}>{$smarty.const.FORM_CONF_ARTICLES_TITLE_ARTICLE_NAME}</label>
		</td>
		<td style="text-align: center;">-</td>
	</tr>
	<tr>
		<td>{$smarty.const.FORM_CONF_ARTICLES_COMMENTS}</td>
		<td><input type="checkbox" name="comments"{if $smarty.const.CONF_ARTICLES_COMMENTS} checked="checked"{/if}></td>
		<td style="text-align: center;">-</td>
	</tr>
	<tr>
		<td>{$smarty.const.FORM_CONF_ARTICLES_COMMENTS_REGISTER}</td>
		<td><input type="checkbox" name="comments_register" {if !$smarty.const.CONF_ARTICLES_COMMENTS}disabled="disabled"{elseif $smarty.const.CONF_ARTICLES_COMMENTS_REGISTER}checked="checked"{/if} class="text"></td>
		<td style="text-align: center;">-</td>
	</tr>
	<tr>
		<td>{$smarty.const.FORM_CONF_ARTICLES_COMMENTS_NAME_UNREGISTER}</td>
		<td>
			<input type="text" name="name_unregister" size="20" maxlength="15" value="{$smarty.const.CONF_ARTICLES_COMMENTS_NAME_UNREGISTER}">
		</td>
		<td style="text-align: center;">-</td>
	</tr>

</table>

<p style="text-align: center;"><input type="submit" name="save" value="{$smarty.const.FORM_BUTTON_SAVE}" class="button"></p>
</form>