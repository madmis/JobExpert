{* Ошибки *}
{if $errors}{include file="adm.errors.message.tpl"}{/if}

<form action="{$smarty.const.CONF_ADMIN_FILE}?m=config&amp;s=register" method="post">
<table style="width: 100%;" class="data_table" cellspacing="5" cellpadding="5">
	<tr>
		<td>{$smarty.const.FORM_USER_REGISTER}</td>
		<td><input type="checkbox" name="user_register" {if $smarty.const.CONF_USER_REGISTER}checked{/if}></td>
		<td style="text-align: center;">
			<span class="colorbox_help" id="HELP_ADMIN_REGISTER_USER_REGISTER">
				<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/help_icon.png" alt="{$smarty.const.FORM_IMG_HELP}">
			</span>
		</td>
	</tr>
	<tr>
		<td>{$smarty.const.FORM_USER_ACTIVATE}</td>
		<td><input type="checkbox" name="user_activate" {if $smarty.const.CONF_USER_ACTIVATE}checked{/if}></td>
		<td style="text-align: center;">
			<span class="colorbox_help" id="HELP_ADMIN_REGISTER_USER_ACTIVATE">
				<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/help_icon.png" alt="{$smarty.const.FORM_IMG_HELP}">
			</span>
		</td>
	</tr>
	<tr>
		<td>{$smarty.const.FORM_USER_ACTIVATE_DELETE}</td>
		<td><input type="text" name="user_activate_delete" size="5" value="{$smarty.const.CONF_USER_ACTIVATE_DELETE}" class="text"></td>
		<td style="text-align: center;">
			<span class="colorbox_help" id="HELP_ADMIN_REGISTER_USER_ACTIVATE_DELETE">
				<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/help_icon.png" alt="{$smarty.const.FORM_IMG_HELP}">
			</span>
		</td>
	</tr>
	<tr>
		<td>{$smarty.const.FORM_MAIL_ADMIN_USER_REGISTER}</td>
		<td><input type="checkbox" name="admin_user_register" {if $smarty.const.CONF_MAIL_ADMIN_USER_REGISTER}checked{/if}></td>
		<td style="text-align: center;">
			<span class="colorbox_help" id="HELP_ADMIN_REGISTER_MAIL_ADMIN_USER_REGISTER">
				<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/help_icon.png" alt="{$smarty.const.FORM_IMG_HELP}">
			</span>
		</td>
	</tr>
	<tr>
		<td>{$smarty.const.FORM_REGISTER_USER_PASSWORD}</td>
		<td><input type="text" name="user_password" size="5" value="{$smarty.const.CONF_REGISTER_USER_PASSWORD}" class="text"></td>
		<td style="text-align: center;">
			<span class="colorbox_help" id="HELP_ADMIN_REGISTER_USER_PASSWORD">
				<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/help_icon.png" alt="{$smarty.const.FORM_IMG_HELP}">
			</span>
		</td>
	</tr>
</table>

<p style="text-align: center;"><input type="submit" name="save" value="{$smarty.const.FORM_BUTTON_SAVE}" class="button"></p>
</form>