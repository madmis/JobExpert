<form action="{$smarty.const.CONF_ADMIN_FILE}?m=users&amp;s=manager&amp;action=config" method="post">
<table style="width: 100%;" class="data_table" cellspacing="5" cellpadding="5">
	<tr>
		<td>{$smarty.const.FORM_CONF_USERS_STRINGS_PERPAGE_ADMIN_PANEL}</td>
		<td>
			<input type="text" name="perpage" size="5" value="{$smarty.const.CONF_USERS_STRINGS_PERPAGE_ADMIN_PANEL}" class="text">
		</td>
		<td style="text-align: center;">
			<span class="colorbox_help" id="HELP_ADMIN_CONF_STRINGS_PERPAGE_ADMIN_PANEL">
				<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/help_icon.png" alt="{$smarty.const.FORM_IMG_HELP}">
			</span>
		</td>
	</tr>
	<tr>
		<td>{$smarty.const.FORM_CONF_USERS_NOT_TYPE_DELETE}</td>
		<td>
			<input type="text" name="not_type" size="5" value="{$smarty.const.CONF_USER_NOT_TYPE_DELETE}" class="text">
		</td>
		<td style="text-align: center;">
			<span class="colorbox_help" id="HELP_ADMIN_USERS_NOT_TYPE_DELETE">
				<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/help_icon.png" alt="{$smarty.const.FORM_IMG_HELP}">
			</span>
		</td>
	</tr>
	<tr>
		<td>{$smarty.const.FORM_CONF_USERS_PAYMENT_DELETE}</td>
		<td>
			<input type="text" name="payment" size="5" value="{$smarty.const.CONF_USER_PAYMENT_DELETE}" class="text">
		</td>
		<td style="text-align: center;">
			<span class="colorbox_help" id="HELP_ADMIN_USERS_PAYMENT_DELETE">
				<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/help_icon.png" alt="{$smarty.const.FORM_IMG_HELP}">
			</span>
		</td>
	</tr>
	<tr>
		<td>{$smarty.const.FORM_CONF_USERS_CHANGE_NAME}</td>
		<td><input type="checkbox" name="name" {if $smarty.const.CONF_USER_CHANGE_NAME}checked{/if}></td>
		<td style="text-align: center;">
			<span class="colorbox_help" id="HELP_ADMIN_USERS_CHANGE_NAME">
				<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/help_icon.png" alt="{$smarty.const.FORM_IMG_HELP}">
			</span>
		</td>
	</tr>
</table>

<p style="text-align: center;"><input type="submit" name="save" value="{$smarty.const.FORM_BUTTON_SAVE}" class="button"></p>
</form>