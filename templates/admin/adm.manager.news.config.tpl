<form id="ConfigForm" action="{$smarty.const.CONF_ADMIN_FILE}?m=manager&amp;s=news&amp;action=config" method="post">
<table style="width: 100%;" class="data_table" cellspacing="5" cellpadding="5">
	<tr>
		<td>{$smarty.const.FORM_NEWS_PERPAGE}</td>
		<td><input type="text" name="news_perpage" size="5" value="{$smarty.const.CONF_NEWS_PERPAGE}"></td>
		<td style="text-align: center;">
			<span class="colorbox_help" id="HELP_ADMIN_NEWS_PERPAGE">
				<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/help_icon.png" alt="{$smarty.const.FORM_IMG_HELP}">
			</span>
		</td>
	</tr>
	<tr>
		<td>{$smarty.const.FORM_NEWSES_LAST_SHOW}</td>
		<td><input type="checkbox" name="newses_last_show"{if $smarty.const.CONF_NEWSES_LAST_SHOW} checked="checked"{/if}></td>
		<td style="text-align: center;">
			<span class="colorbox_help" id="HELP_ADMIN_NEWSES_LAST_SHOW">
				<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/help_icon.png" alt="{$smarty.const.FORM_IMG_HELP}">
			</span>
		</td>
	</tr>
	<tr>
		<td>{$smarty.const.FORM_NEWSES_LAST_SHOW_PERPAGE}</td>
		<td>
			<input type="text" name="newses_last_show_perpage" size="5" maxlength="3" value="{$smarty.const.CONF_NEWSES_LAST_SHOW_PERPAGE}">
		</td>
		<td style="text-align: center;">
			<span class="colorbox_help" id="HELP_ADMIN_NEWSES_LAST_SHOW_PERPAGE">
				<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/help_icon.png" alt="{$smarty.const.FORM_IMG_HELP}">
			</span>
		</td>
	</tr>
	<tr>
		<td>{$smarty.const.FORM_CONF_NEWSES_CORRECTION_THERM}</td>
		<td>
			<input type="text" name="correctionTerm" size="5" value="{$smarty.const.CONF_NEWSES_CORRECTION_THERM}">
		</td>
		<td style="text-align: center;">
			<span class="colorbox_help" id="HELP_ADMIN_CONF_NEWSES_CORRECTION_THERM">
				<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/help_icon.png" alt="{$smarty.const.FORM_IMG_HELP}">
			</span>
		</td>
	</tr>
	<tr>
		<td>{$smarty.const.FORM_NEWSES_TITLE}</td>
		<td><input type="checkbox" name="titleNewsName"{if $smarty.const.CONF_NEWSES_DISPLAY_ON_TITLE_ONLY_NEWS_NAME} checked="checked"{/if}></td>
		<td style="text-align: center;">
			<span class="colorbox_help" id="HELP_ADMIN_CONF_NEWSES_TITLE">
				<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/help_icon.png" alt="{$smarty.const.FORM_IMG_HELP}">
			</span>
		</td>
	</tr>
	<tr>
		<td>{$smarty.const.FORM_NEWSES_COMMENTS}</td>
		<td><input type="checkbox" name="newses_comments"{if $smarty.const.CONF_NEWSES_COMMENTS} checked="checked"{/if}></td>
		<td style="text-align: center;">-</td>
	</tr>
	<tr>
		<td>{$smarty.const.FORM_NEWSES_COMMENTS_REGISTER}</td>
		<td><input type="checkbox" name="newses_comments_register" {if !$smarty.const.CONF_NEWSES_COMMENTS}disabled="disabled"{elseif $smarty.const.CONF_NEWSES_COMMENTS_REGISTER}checked="checked"{/if} class="text"></td>
		<td style="text-align: center;">-</td>
	</tr>
	<tr>
		<td>{$smarty.const.FORM_NEWSES_COMMENTS_NAME_UNREGISTER}</td>
		<td>
			<input type="text" name="name_unregister" size="20" maxlength="15" value="{$smarty.const.CONF_NEWSES_COMMENTS_NAME_UNREGISTER}">
		</td>
		<td style="text-align: center;">-</td>
	</tr>
</table>

<p style="text-align: center;"><input type="submit" name="save" value="{$smarty.const.FORM_BUTTON_SAVE}" class="button"></p>
</form>