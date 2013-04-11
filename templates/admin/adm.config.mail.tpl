{* Ошибки *}
{if $errors}{include file="adm.errors.message.tpl"}{/if}

<form action="{$smarty.const.CONF_ADMIN_FILE}?m=config&amp;s=mail" method="post">
<table style="width: 100%;" class="data_table" cellspacing="5" cellpadding="5">
	<tr>
		<td>{$smarty.const.FORM_MAIL_METHOD}</td>
		<td>
			<select name="mail_method" class="select">
				<option value="php" {if $smarty.const.CONF_MAIL_METHOD eq 'php'}selected{/if}>PHP mail</option>
				<option value="smtp" {if $smarty.const.CONF_MAIL_METHOD eq 'smtp'}selected{/if}>SMTP</option>
			</select>
		</td>
		<td style="text-align: center;">
			<span class="colorbox_help" id="HELP_ADMIN_MAIL_METHOD">
				<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/help_icon.png" alt="{$smarty.const.FORM_IMG_HELP}">
			</span>
		</td>
	</tr>
	<tr>
		<td>{$smarty.const.FORM_MAIL_FORMAT}</td>
		<td>
			<select name="mail_format" class="select">
				<option value="1" {if $smarty.const.CONF_MAIL_FORMAT_HTML}selected{/if}>text/html</option>
				<option value="0" {if !$smarty.const.CONF_MAIL_FORMAT_HTML}selected{/if}>text/plain</option>
			</select>
		</td>
		<td style="text-align: center;">
			<span class="colorbox_help" id="HELP_ADMIN_MAIL_FORMAT">
				<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/help_icon.png" alt="{$smarty.const.FORM_IMG_HELP}">
			</span>
		</td>
	</tr>
	<tr>
		<td>{$smarty.const.FORM_MAIL_ADMIN_EMAIL}</td>
		<td><input type="text" name="admin_email" size="50" value="{$smarty.const.CONF_MAIL_ADMIN_EMAIL}" class="text"></td>
		<td style="text-align: center;">
			<span class="colorbox_help" id="HELP_ADMIN_MAIL_ADMIN_EMAIL">
				<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/help_icon.png" alt="{$smarty.const.FORM_IMG_HELP}">
			</span>
		</td>
	</tr>
	<tr>
		<td>{$smarty.const.FORM_MAIL_SMTP_HOST}</td>
		<td><input type="text" name="smtp_host" size="50" value="{$smarty.const.CONF_MAIL_SMTP_HOST}" class="text"></td>
		<td style="text-align: center;">
			<span class="colorbox_help" id="HELP_ADMIN_MAIL_SMTP_HOST">
				<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/help_icon.png" alt="{$smarty.const.FORM_IMG_HELP}">
			</span>
		</td>
	</tr>
	<tr>
		<td>{$smarty.const.FORM_MAIL_SMTP_PORT}</td>
		<td><input type="text" name="smtp_port" size="50" value="{$smarty.const.CONF_MAIL_SMTP_PORT}" class="text"></td>
		<td style="text-align: center;">
			<span class="colorbox_help" id="HELP_ADMIN_MAIL_SMTP_PORT">
				<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/help_icon.png" alt="{$smarty.const.FORM_IMG_HELP}">
			</span>
		</td>
	</tr>
	<tr>
		<td>{$smarty.const.FORM_MAIL_SMTP_USER}</td>
		<td><input type="text" name="smtp_user" size="50" value="{$smarty.const.CONF_MAIL_SMTP_USER}" class="text"></td>
		<td style="text-align: center;">
			<span class="colorbox_help" id="HELP_ADMIN_MAIL_SMTP_USER">
				<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/help_icon.png" alt="{$smarty.const.FORM_IMG_HELP}">
			</span>
		</td>
	</tr>
	<tr>
		<td>{$smarty.const.FORM_MAIL_SMTP_PASS}</td>
		<td><input type="text" name="smtp_pass" size="50" value="{$smarty.const.CONF_MAIL_SMTP_PASS}" class="text"></td>
		<td style="text-align: center;">
			<span class="colorbox_help" id="HELP_ADMIN_MAIL_SMTP_PASS">
				<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/help_icon.png" alt="{$smarty.const.FORM_IMG_HELP}">
			</span>
		</td>
	</tr>
</table>

<p style="text-align: center;"><input type="submit" name="save" value="{$smarty.const.FORM_BUTTON_SAVE}" class="button"></p>
</form>