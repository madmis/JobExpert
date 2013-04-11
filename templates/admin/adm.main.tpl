<table class="mainTable" cellspacing="10">
	<tr>
		<td>
			{* Информация о продукте *}
			<table class="infoTable" cellpadding="0" cellspacing="0">
				<thead class="infoHead">
					<tr><td>{$smarty.const.MENU_INFO_PRODUCT}</td></tr>
				</thead>
				<tbody>
					<tr><td>{$smarty.const.SITE_PRODUCT}: {$smarty.const.CONF_INFO_PRODUCT_NAME}</td></tr>
					<tr><td>{$smarty.const.SITE_VERSION}: {$smarty.const.CONF_INFO_PRODUCT_VERSION}</td></tr>
					<tr><td>{$smarty.const.SITE_REVISION}: {$smarty.const.CONF_INFO_SCRIPT_REVISION}</td></tr>
				</tbody>
			</table>
		</td>
		<td>
			{* Блок обновлений *}
			<table class="infoTable" cellpadding="0" cellspacing="0">
				<thead class="infoHead">
					<tr><td>{$smarty.const.MENU_UPDATES}</td></tr>
				</thead>
				<tbody>
					<tr>
						<td style="text-align: center; font-weight: bold; font-size: 13px; padding: 20px 0px;">
							{if !$avUpdates.error AND $avUpdates.result gt 0}
								<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/icons/updates.png">
								<a href="{$smarty.const.CONF_ADMIN_FILE}?m=system&amp;s=updates">{$smarty.const.SITE_AVAILABLE_UPDATES}: {$avUpdates.result}</a>
							{elseif !$avUpdates.error AND $avUpdates.result eq 0}
								{$smarty.const.SITE_NOT_AVAILABLE_UPDATES}
							{else}
								{$avUpdates.result}
							{/if}
						</td>
					</tr>
				</tbody>
			</table>
		</td>
	</tr>
	<tr>
		<td>
			{* Отключение сайта на обслуживание *}
			<table class="infoTable" cellpadding="0" cellspacing="0">
				<thead class="infoHead">
					<tr><td colspan="3">{$smarty.const.MENU_MAINTENANCE}</td></tr>
				</thead>
				<tbody>
					<tr>
						<td>{$smarty.const.FORM_CONF_ADMINISTRATION_MAINTENANCE}</td>
						<td style="text-align: center; width: 10%;">
							<input type="checkbox" id="maintenance"{if $smarty.const.CONF_SERVICE_ADMINISTRATION_MAINTENANCE} checked="checked"{/if}>
							<span id="load">&nbsp;</span>
						</td>
						<td style="text-align: center; width: 10%;">
							<span class="colorbox_help" id="HELP_ADMIN_CONF_ADMINISTRATION_MAINTENANCE">
								<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/help_icon.png" alt="{$smarty.const.FORM_IMG_HELP}" title="{$smarty.const.FORM_IMG_HELP}">
							</span>
						</td>
					</tr>
				</tbody>
			</table>
		</td>
	</tr>
</table>

<script type="text/javascript">
<!--
$(function() {
	$('#maintenance').click(function () {
		var obj = $(this);
		var state = (obj.is(':checked')) ? 'on' : 'off';
		obj.hide();
		$('#load').html('<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/loading.gif">');
		$.ajax({ type: 'post', url: '/admajax.php', data: 'maintenance=' + state,
			success: function( msg ) {
				$('#load').html('');
				if (msg == 'true') {
					(state == 'on') ? obj.attr('checked', true) : obj.attr('checked', false);
				} else {
					(state == 'on') ? obj.attr('checked', false) : obj.attr('checked', true);
				}
				obj.show();
			}
		});
	});
});
-->
</script>
