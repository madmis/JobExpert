	{*<div class="warning">{$smarty.const.WARNING_NOT_FORGET_SITE_ON_MAINTENANCE}</div>*}

<table style="width: 100%;">
	<tr>
		<td style="text-align: center; font-size: 11px;" colspan="2">
			{$smarty.const.MESSAGE_WARNING_CREATE_BACKUP}
			<hr>
		</td>
	</tr>
	<tr>
		<td style="width: 50%; text-align: center;">
			{if $arrBackup.php}<span><input type="button" class="button" id="backupPHP" value="{$smarty.const.FORM_BUTTON_CREATE_BACKUP_SITE}"></span>{else}&nbsp;{/if}
		</td>
		<td style="width: 50%; text-align: center;">
			{if $arrBackup.sql}<span><input type="button" class="button" id="backupSQL" value="{$smarty.const.FORM_BUTTON_CREATE_BACKUP_DB}"></span>{else}&nbsp;{/if}
		</td>
	</tr>
	<tr>
		<td style="text-align: center; padding-top: 40px;" colspan="2">
			<form action="{$smarty.const.CONF_ADMIN_FILE}?m=system&amp;s=updates&amp;action=setup" method="get">
				<input type="hidden" name="m" value="system">
				<input type="hidden" name="s" value="updates">
				<input type="hidden" name="action" value="setup">
				<input type="hidden" name="file" value="{$arcFile}">
				<input type="submit" class="button" value="{$smarty.const.FORM_BUTTON_CONTINUE_THE_UPDATE}">
			</form>
		</td>
	</tr>
</table>

<script type="text/javascript">
<!--
$(function() {
	// Делаем бекап сайта
	$('#backupPHP').click(function() {
		var obj = $(this).parent('span');
		obj.html('<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/processing.gif">');
		$.ajax({ type: 'post', url: '/admajax.php', data: 'backup=php',
			success: function( msg ) {
				obj.html(msg);
			}
		});
	});

	// Делаем бекап БД
	$('#backupSQL').click(function() {
		var obj = $(this).parent('span');
		obj.html('<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/processing.gif">');
		$.ajax({ type: 'post', url: '/admajax.php', data: 'backup=sql',
			success: function( msg ) {
				obj.html(msg);
			}
		});
	});
});
-->
</script>
