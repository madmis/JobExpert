{* Ошибки *}
{if $errors}{include file="adm.errors.message.tpl"}{/if}

<form action="{$smarty.const.CONF_ADMIN_FILE}?m=config&amp;s=rss" method="post">
<table style="width: 100%;" class="data_table" cellspacing="5" cellpadding="5">
	<tr>
		<td>{$smarty.const.FORM_RSS_NEWS_COUNT}</td>
		<td>
			<input type="text" name="news_count" size="5" value="{$smarty.const.CONF_RSS_NEWS_COUNT}" class="text">
		</td>
		<td style="text-align: center;">
			<span class="colorbox_help" id="HELP_ADMIN_RSS_COUNT">
				<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/help_icon.png" alt="{$smarty.const.FORM_IMG_HELP}">
			</span>
		</td>
	</tr>
	<tr>
		<td>{$smarty.const.FORM_RSS_ARTICLES_COUNT}</td>
		<td>
			<input type="text" name="articles_count" size="5" value="{$smarty.const.CONF_RSS_ARTICLES_COUNT}" class="text">
		</td>
		<td style="text-align: center;">
			<span class="colorbox_help" id="HELP_ADMIN_RSS_COUNT">
				<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/help_icon.png" alt="{$smarty.const.FORM_IMG_HELP}">
			</span>
		</td>
	</tr>
	<tr>
		<td>{$smarty.const.FORM_RSS_VACANCY_COUNT}</td>
		<td>
			<input type="text" name="vacancy_count" size="5" value="{$smarty.const.CONF_RSS_VACANCY_COUNT}" class="text">
		</td>
		<td style="text-align: center;">
			<span class="colorbox_help" id="HELP_ADMIN_RSS_COUNT">
				<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/help_icon.png" alt="{$smarty.const.FORM_IMG_HELP}">
			</span>
		</td>
	</tr>
	<tr>
		<td>{$smarty.const.FORM_RSS_RESUME_COUNT}</td>
		<td>
			<input type="text" name="resume_count" size="5" value="{$smarty.const.CONF_RSS_RESUME_COUNT}" class="text">
		</td>
		<td style="text-align: center;">
			<span class="colorbox_help" id="HELP_ADMIN_RSS_COUNT">
				<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/help_icon.png" alt="{$smarty.const.FORM_IMG_HELP}">
			</span>
		</td>
	</tr>
</table>

<p style="text-align: center;"><input type="submit" name="save" value="{$smarty.const.FORM_BUTTON_SAVE}" class="button"></p>
</form>