<form action="{$smarty.const.CONF_ADMIN_FILE}?m=manager&amp;s=file&amp;action=config" method="post">
<table style="width: 100%;" class="data_table" cellspacing="5" cellpadding="5">
	<tr>
		<td>{$smarty.const.FORM_FILEMANAGER_THUMBNAIL_WIDTH}</td>
		<td><input type="text" name="max_width" size="5" value="{$smarty.const.CONF_FILEMANAGER_THUMBNAIL_WIDTH}" class="text"></td>
		<td style="text-align: center;">
			<span class="colorbox_help" id="HELP_ADMIN_FILEMANAGER_THUMBNAIL_WIDTH">
				<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/help_icon.png" alt="{$smarty.const.FORM_IMG_HELP}">
			</span>
		</td>
	</tr>
	<tr>
		<td>{$smarty.const.FORM_FILEMANAGER_THUMBNAIL_HEIGHT}</td>
		<td><input type="text" name="max_height" size="5" value="{$smarty.const.CONF_FILEMANAGER_THUMBNAIL_HEIGHT}" class="text"></td>
		<td style="text-align: center;">
			<span class="colorbox_help" id="HELP_ADMIN_FILEMANAGER_THUMBNAIL_HEIGHT">
				<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/help_icon.png" alt="{$smarty.const.FORM_IMG_HELP}">
			</span>
		</td>
	</tr>
</table>

<p style="text-align: center;"><input type="submit" name="save" value="{$smarty.const.FORM_BUTTON_SAVE}" class="button"></p>
</form>