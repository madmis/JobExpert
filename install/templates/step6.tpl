<h2 class="center">{$smarty.const.END_CONGRATULATIONS}</h2>
<table class="centerTable">
	{if !$delInst}
	<tr>
		<td class="red">{$smarty.const.END_WARNING}</td>
	</tr>
	{/if}
	<tr>
		<td class="center"><p><a href="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.CONF_ADMIN_FILE}">{$smarty.const.END_GO_TO_ADMIN_PANEL}</a></p></td>
	</tr>
	<tr>
		<td class="center"><p><a href="{$smarty.const.CONF_SCRIPT_URL}">{$smarty.const.END_GO_TO_SITE}</a></p></td>
	</tr>
	<tr>
		<td class="center">
		{if $showHta}
			<p><a href="javascript:void(0);" id="hta">{$smarty.const.END_CONFIGURE_HTACCESS}</a></p>
			<div id="htaf">
				<form action="install.php?step=7" method="post">
					<table style="width: 100%;">
						<tr>
							<td colspan="2" style="font-size: 11px; padding-bottom: 10px; color: #FF0000;"><p>{$smarty.const.END_NOT_CHANGE_CONFIG}</p></td>
						</tr>
						<tr>
							<td>{$smarty.const.END_ENABLE_REWRITEBASE}</td>
							<td><input type="checkbox" name="rb"></td>
						</tr>
						<tr>
							<td>{$smarty.const.END_ENABLE_PHPERRORS_PRINT}</td>
							<td><input type="checkbox" name="phperr"></td>
						</tr>
						<tr>
							<td>{$smarty.const.END_ENABLE_PHPERRORS_LOG}</td>
							<td><input type="checkbox" name="logerr"></td>
						</tr>
						<tr>
							<td>{$smarty.const.END_FILE_PHPERRORS_LOG}</td>
							<td><input type="text" value="{$errLogFile}" name="logfile"></td>
						</tr>
						<tr>
							<td>{$smarty.const.END_RESTRICT_FILE_PHPERRORS_LOG}</td>
							<td><input type="checkbox" name="logrestrict"></td>
						</tr>
						<tr>
							<td>{$smarty.const.END_RESTRICT_FILE_HTACCESS}</td>
							<td><input type="checkbox" name="htarestrict"></td>
						</tr>
						<tr>
							<td colspan="2" class="center"><input type="submit" value="{$smarty.const.BUTTON_SAVE}" name="htasave" class="button"></td>
						</tr>
					</table>
				</form>
			</div>
		{else}
			<div style="display: block; text-align: center; font-weight: bold;" id="htaf">
				{$smarty.const.END_HTACCESS_SUCCESSFULLY_CREATED}
			</div>
		{/if}
		</td>
	</tr>
	<tr>
		<td class="center"><p><a href="install.php?step=6&delInst" id="delInst">{$smarty.const.END_DELTE_INSTALL_FILES}</a> ({$smarty.const.END_REDIRECT_TO_ADMIN_PANEL})</p></td>
	</tr>
</table>
<script type="text/javascript">
<!--
$(function() {
	$('#delInst').click( function() {
		return confirm('{$smarty.const.MESSAGE_DELTE_INSTALL_FILES}');
	});

	$('#hta').click( function() {
		$('#htaf').toggle();
	});
});
-->
</script>