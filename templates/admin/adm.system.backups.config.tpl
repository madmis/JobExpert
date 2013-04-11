<form action="{$smarty.const.CONF_ADMIN_FILE}?m=system&s=backups&action=config" method="post">
<table style="width: 100%;" class="data_table" cellspacing="5" cellpadding="5">
	<tr>
		<td>{$smarty.const.FORM_CONF_BACKUPS_PATH_TO_FILES}</td>
		<td><input type="text" name="path" size="80" value="{$smarty.const.CONF_BACKUPS_PATH_TO_FILES}" class="text"></td>
		<td align="center">
			<span class="colorbox_help" id="HELP_ADMIN_CONF_BACKUPS_PATH_TO_FILES">
				<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/help_icon.png" alt="{$smarty.const.FORM_IMG_HELP}" title="{$smarty.const.FORM_IMG_HELP}">
			</span>
		</td>
	</tr>
</table>

<p align="center"><input type="submit" name="save" value="{$smarty.const.FORM_BUTTON_SAVE}" class="button"></p>
</form>