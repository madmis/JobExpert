<p class="sub_menu">
	<span class="colorbox_help" id="HELP_ADMIN_CHANGE_PASSWORD">
		<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/actions/help.png" alt="{$smarty.const.FORM_IMG_HELP}" title="{$smarty.const.FORM_IMG_HELP}">
	</span>
</p>

{* Ошибки *}
{if $errors}
	{include file="adm.errors.message.tpl"}
{/if}

<table cellspacing="0" cellpadding="0" style="width: 100%;">
	<tr>
		<td align="center">
			<form action="{$smarty.const.CONF_ADMIN_FILE}?do=change.password" method="post" enctype="multipart/form-data">
			<table cellspacing="0" cellpadding="0" class="table_normal">
				<tr>
					<td colspan="2" align="center">
						
					</td>
				</tr>
				<tr>
					<td align="center">
						<b>{$smarty.const.FORM_LOGIN}</b>
						<p class="p_5"><input type="text" name="login" class="text" size="50"></p>
					</td>
				</tr>
				<tr>
					<td align="center">
						<b>{$smarty.const.FORM_PASSWORD}</b>
						<p class="p_5"><input type="text" name="password" class="text" size="50"></p>
					</td>
				</tr>
				<tr>
					<td colspan="2" align="center">
						<p class="p_5"><input type="submit" name="save" value="{$smarty.const.FORM_BUTTON_SAVE}" class="button"></p>
					</td>
				</tr>
			</table>
			</form>
		</td>
	</tr>
</table>
