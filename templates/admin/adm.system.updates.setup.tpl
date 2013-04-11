<table style="width: 100%;">
	<tr>
		<td style="text-align: center; font-size: 11px;">
			{$smarty.const.MESSAGE_WARNING_INSTALLING_UPDATE}
			<hr>
		</td>
	</tr>
	<tr>
		<td style="text-align: center; padding-top: 20px;">
			<p><strong>{$smarty.const.FORM_SYSTEM_UPDATES_UPDATE_DB}</strong></p>
			<div id="processDiv1"></div>
			<input type="hidden" id="arcFile" value="{$arcFile}">
		</td>
	</tr>
	<tr>
		<td style="text-align: center; padding-top: 20px;">
			<p><strong>{$smarty.const.FORM_SYSTEM_UPDATES_EXTRACT_FILES}</strong></p>
			<div id="processDiv2"></div>
		</td>
	</tr>
</table>

<script type="text/javascript">
<!--
$(function() {
	// Устанавливаем обновление
	var file = $('#arcFile').val();
	var obj = $('#processDiv');

	if (file) {
		$('#processDiv1').html('<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/processing.gif">');
		$.ajax({ type: 'post', url: '/admajax.php', data: 'setupUpdate=' + file + '&step=1',
			success: function( response ) {
				response = $.parseJSON(response);

				// если успешно, выполняем второй шаг
				if (response.success) {
					$('#processDiv1').css({ 'color' : 'blue', 'font-weight' : 'bold' });
					$('#processDiv1').html(response.success);
					
					// второй шаг
					$('#processDiv2').html('<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/processing.gif">');
					$.ajax({ type: 'post', url: '/admajax.php', data: 'setupUpdate=' + file + '&step=2',
						success: function( response ) {
							response = $.parseJSON(response);
							if (response.success) {
								$('#processDiv2').css({ 'color' : 'blue', 'font-weight' : 'bold' });
								$('#processDiv2').html(response.success);
							} else {
								$('#processDiv2').css('color', 'red');
								$('#processDiv2').html(response.error);
							}
						}
					});
				} else {
					$('#processDiv1').css('color', 'red');
					$('#processDiv1').html(response.error);
				}
			}
		});
	}

});
-->
</script>
