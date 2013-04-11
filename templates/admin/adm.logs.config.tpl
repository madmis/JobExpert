{* Ошибки *}
{if $errors}{include file="adm.errors.message.tpl"}{/if}

<form action="{$smarty.const.CONF_ADMIN_FILE}?m=logs&s=config" method="post">
<table style="width: 100%;" class="data_table" cellspacing="5" cellpadding="5">
	<tr>
		<td>{$smarty.const.FORM_CONF_LOGS_ADMIN}</td>
		<td><input type="checkbox" name="logs_admin" {if $smarty.const.CONF_LOGS_ADMIN}checked{/if}></td>
		<td style="text-align: center;">
			<span class="colorbox_help" id="HELP_ADMIN_CONF_LOGS_ADMIN">
				<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/help_icon.png" alt="{$smarty.const.FORM_IMG_HELP}">
			</span>
		</td>
	</tr>
</table>

<p style="text-align: center;"><input type="submit" name="save" value="{$smarty.const.FORM_BUTTON_SAVE}" class="button"></p>
</form>