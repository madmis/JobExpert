{* Ошибки *}
{if $errors}{include file="adm.errors.message.tpl"}{/if}

<form action="{$smarty.const.CONF_ADMIN_FILE}?m=config&amp;s=datetime" method="post">
<table style="width: 100%;" class="data_table" cellspacing="5" cellpadding="5">
	<tr>
		<td>{$smarty.const.FORM_DATE_FORMAT}</td>
		<td>
			<select name="date_format" class="select">
				<option value="%d.%m.%Y" {if $smarty.const.CONF_DATE_FORMAT eq '%d.%m.%Y'}selected{/if}>DD.MM.YYYY</option>
				<option value="%d.%m.%y" {if $smarty.const.CONF_DATE_FORMAT eq '%d.%m.%y'}selected{/if}>DD.MM.YY</option>
			</select>
		</td>
		<td style="text-align: center;">
			<span class="colorbox_help" id="HELP_ADMIN_DATETIME_DATE_FORMAT">
				<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/help_icon.png" alt="{$smarty.const.FORM_IMG_HELP}">
			</span>
		</td>
	</tr>
	<tr>
		<td>{$smarty.const.FORM_TIME_FORMAT}</td>
		<td>
			<select name="time_format" class="select">
				<option value="%H:%M:%S" {if $smarty.const.CONF_TIME_FORMAT eq '%H:%M:%S'}selected{/if}>HH:MM:SS</option>
				<option value="%H:%M" {if $smarty.const.CONF_TIME_FORMAT eq '%H:%M'}selected{/if}>HH:MM</option>
			</select>
		</td>
		<td style="text-align: center;">
			<span class="colorbox_help" id="HELP_ADMIN_DATETIME_TIME_FORMAT">
				<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/help_icon.png" alt="{$smarty.const.FORM_IMG_HELP}">
			</span>
		</td>
	</tr>
</table>

<p align="center"><input type="submit" name="save" value="{$smarty.const.FORM_BUTTON_SAVE}" class="button"></p>
</form>
