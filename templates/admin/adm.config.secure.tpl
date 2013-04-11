{* Ошибки *}
{if $errors}{include file="adm.errors.message.tpl"}{/if}

<form action="{$smarty.const.CONF_ADMIN_FILE}?m=config&s=secure" method="post">
<table style="width: 100%;" class="data_table" cellspacing="5" cellpadding="5">
	<tr>
		<td>{$smarty.const.FORM_CAPTCHA}</td>
		<td><input type="checkbox" name="captcha" {if $smarty.const.SECURE_CAPTCHA}checked{/if}></td>
		<td style="text-align: center;">
			<span class="colorbox_help" id="HELP_ADMIN_SECURE_CKAPTCHA">
				<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/help_icon.png" alt="{$smarty.const.FORM_IMG_HELP}">
			</span>
		</td>
	</tr>
	<tr>
		<td>{$smarty.const.FORM_SQLERR_LOG}</td>
		<td><input type="checkbox" name="sqlerr_log" {if $smarty.const.SECURE_SQLERR_LOG}checked{/if}></td>
		<td style="text-align: center;">
			<span class="colorbox_help" id="HELP_ADMIN_SECURE_SQLERR_LOG">
				<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/help_icon.png" alt="{$smarty.const.FORM_IMG_HELP}">
			</span>
		</td>
	</tr>
	<tr>
		<td>{$smarty.const.FORM_SQLERR_PRINT}</td>
		<td><input type="checkbox" name="sqlerr_print" {if $smarty.const.SECURE_SQLERR_PRINT}checked{/if}></td>
		<td style="text-align: center;">
			<span class="colorbox_help" id="HELP_ADMIN_SECURE_SQLERR_PRINT">
				<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/help_icon.png" alt="{$smarty.const.FORM_IMG_HELP}">
			</span>
		</td>
	</tr>
	<tr>
		<td>{$smarty.const.FORM_SQLERR_SEND_MESS}</td>
		<td><input type="checkbox" name="sqlerr_send_mess" {if $smarty.const.SECURE_SQLERR_SEND_MESS}checked{/if}></td>
		<td style="text-align: center;">
			<span class="colorbox_help" id="HELP_ADMIN_SECURE_SQLERR_SEND_MESS">
				<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/help_icon.png" alt="{$smarty.const.FORM_IMG_HELP}">
			</span>
		</td>
	</tr>
	<tr>
		<td>{$smarty.const.FORM_SQLERR_EMAIL}</td>
		<td><input type="text" name="sqlerr_email" size="30" value="{$smarty.const.SECURE_SQLERR_EMAIL}" {if !$smarty.const.SECURE_SQLERR_SEND_MESS}class="readOnly" readonly{/if}></td>
		<td style="text-align: center;">
			<span class="colorbox_help" id="HELP_ADMIN_SECURE_SQLERR_EMAIL">
				<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/help_icon.png" alt="{$smarty.const.FORM_IMG_HELP}">
			</span>
		</td>
	</tr>
</table>
<p style="text-align: center;"><input type="submit" name="save" value="{$smarty.const.FORM_BUTTON_SAVE}" class="button"></p>
</form>
{* Настройка доступа по IP-адресам *}
<table style="width: 100%;" class="data_table" cellspacing="5" cellpadding="5">
	<tr>
		<td>{$smarty.const.FORM_ADMIN_ACCESS_IP_LIST}</td>
		<td>
			<div class="ipAccessList" style="width: 100%; border: 1px solid #A0A0A0; display: none;"></div>
			<div style="margin: 15px 0px 5px 0px; font-weight: bold;">{$smarty.const.FORM_ADMIN_ACCESS_IP_LIST_ADD}:</div>
			<input type="radio" name="ipv" value="ipv4" checked="checked">&nbsp;IPv4
			&nbsp;&nbsp;&nbsp;
			<input type="radio" name="ipv" value="ipv6">&nbsp;IPv6
			<br><br>
			<input type="text" name="ip0" size="3" maxlength="3" class="valueIP" style="text-align: center;">
			<span class="ipDelimeter" style="margin: 1px;">.</span>
			<input type="text" name="ip1" size="3" maxlength="3" class="valueIP" style="text-align: center;">
			<span class="ipDelimeter" style="margin: 1px;">.</span>
			<input type="text" name="ip2" size="3" maxlength="3" class="valueIP" style="text-align: center;">
			<span class="ipDelimeter" style="margin: 1px;">.</span>
			<input type="text" name="ip3" size="3" maxlength="3" class="valueIP" style="text-align: center;">
			<span class="ipv6" style="display: none;">
				<span class="ipDelimeter" style="margin: 1px;">.</span>
				<input type="text" name="ip4" size="3" maxlength="3" class="valueIP" style="text-align: center;">
				<span class="ipDelimeter" style="margin: 1px;">.</span>
				<input type="text" name="ip5" size="3" maxlength="3" class="valueIP" style="text-align: center;">
				<span class="ipDelimeter" style="margin: 1px;">.</span>
				<input type="text" name="ip6" size="3" maxlength="3" class="valueIP" style="text-align: center;">
				<span class="ipDelimeter" style="margin: 1px;">.</span>
				<input type="text" name="ip7" size="3" maxlength="3" class="valueIP" style="text-align: center;">
			</span>
			<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/icons/yes.png" class="addIp2AccessList" style="display: none; cursor: pointer;" alt="{$smarty.const.FORM_BUTTON_ADD}" title="{$smarty.const.FORM_ADMIN_ACCESS_IP_LIST_ADD}">
			<br><br>
		</td>
		<td style="text-align: center;">
			<span class="colorbox_help" id="HELP_ADMIN_SECURE_ACCESS_IP_LIST">
				<img  src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/help_icon.png" alt="{$smarty.const.FORM_IMG_HELP}">
			</span>
		</td>
	</tr>
</table>
<script type="text/javascript">
<!--
$(document).ready(function() {
	var ipDelimeter = '.';
	var currIpv = 'ipv4';
	var selector = 'input[name=ip0], input[name=ip1], input[name=ip2], input[name=ip3]';
	var ipAccessList = ('' !== '{$smarty.const.SECURE_ADMIN_ACCESS_IP_LIST}') ? '{$smarty.const.SECURE_ADMIN_ACCESS_IP_LIST}' : false;

	$.get('/admajax.php?getIP', function(resp) {
		if (ipAccessList) {
			for (i in ipAccessList = ipAccessList.split(';')) {
				(resp == ipAccessList[i]) ? resp = false : $.noop;
				$(document.createElement('img')).attr({
					src: '{$smarty.const.TEMPLATE_PATH_ADMIN}images/icons/forbidden.png',
					alt: '{$smarty.const.FORM_BUTTON_DELETE}',
					title: '{$smarty.const.FORM_ADMIN_ACCESS_IP_LIST_DELETE}'
				}).data('ip', ipAccessList[i]).css({ cursor: 'pointer' }).prependTo(
					$(document.createElement('div')).css({ margin: '5px' }).append(
						$(document.createElement('span')).css({ margin: '5px' }).text(ipAccessList[i])
					).appendTo('.ipAccessList')
				).click(function() {
					if (confirm('{$smarty.const.MESSAGE_DELETE_IP_FROM_LIST}')) {
						var ipDescript = $(this).parent();
						$.get('/admajax.php?delAdmAccessIP=' + $(this).data('ip'), function(message) {
							if ('success' == message) {
								ipDescript.remove();
								(0 == $('.ipAccessList').children().size()) ? $('.ipAccessList').hide() : $.noop;
							} else if ('errIpNotExists' == message) {
								$.alert('{$smarty.const.ERROR_IP_NOTEXISTS_IN_ACCESS_LIST}');
							} else if ('errSaveConfIpList' == message) {
								$.alert('{$smarty.const.ERROR_NOT_SAVE_CHANGE}');
							} else {
								$.alert('{$smarty.const.ERROR_UNDEFINED}');
							}
						});
					}
				});
				$('.ipAccessList').show('fast');
			}
		}

		if (resp) {
			var arrIp = resp.split('.');
			if (1 == arrIp.length) {
				arrIp = resp.split(':');
				if (1 == arrIp.length) {
					$.alert(resp);
					return;
				}
				$(':radio[name=ipv]').each(function() {
					('ipv6' == $(this).val()) ? $(this).attr('checked', 'checked') : $.noop;
				});
				currIpv = 'ipv6';
				$('.ipv6').show('fast');
			}

			for (i in arrIp) {
				$('input[name=ip' + i + ']').val(arrIp[i]);
			}

			$('.addIp2AccessList').show();
		}
	});
    // обрабатываем изменение версии протокола
	$(':radio[name=ipv]').change(function() {
		$('.addIp2AccessList').hide();
		currIpv = $(this).val();
		if ('ipv6' == currIpv) {
			$('.valueIP').val('').attr({
				size: 4,
				maxlength: 4
			});
			$('.ipDelimeter').text(ipDelimeter = ':');
			$('.ipv6').show();
			selector += ', input[name=ip4], input[name=ip5], input[name=ip6], input[name=ip7]';

		} else {
			$('.valueIP').val('').attr({
				size: 3,
				maxlength: 3
			});
			$('.ipDelimeter').text(ipDelimeter = '.');
			$('.ipv6').hide('fast');
			selector = 'input[name=ip0], input[name=ip1], input[name=ip2], input[name=ip3]';
		}
	});
	// обрабатываем нажатие клавиш
	var keyShiftPressed = false;
	$('.valueIP').keydown(function(event) {
		switch (event.keyCode) {
			case 8: case 9: case 37: case 39: case 46:
				break;
			case 96: case 97: case 98: case 99: case 100: case 101: case 102: case 103: case 104: case 105:
				break;
			case 16:
				keyShiftPressed = true;
				break;
			case 48: case 49: case 50: case 51: case 52: case 53: case 54: case 55: case 56: case 57:
				(keyShiftPressed) ? event.preventDefault() : $.noop;
				break;
			case 65: case 66: case 67: case 68: case 69: case 70:
				('ipv6' != currIpv) ? event.preventDefault() : $.noop;
				break;
			default:
				event.preventDefault();
		}
	});
	// обрабатываем отжатие клавиш
	$('.valueIP').keyup(function(event) {
		(16 == event.keyCode) ? keyShiftPressed = false : $.noop;
		var value = $(this).val();
		var index = $(this).attr('name');
		index = 1 * index.replace('ip', '');
		if ((39 != event.keyCode && 37 != event.keyCode && value.length == $(this).attr('maxlength')) || (39 == event.keyCode && 0 == value.length)) {
			index++;
			$('input[name=ip' + index + ']').focus();
		}
		if ((8 == event.keyCode && 0 == value.length) || (37 == event.keyCode && 0 == value.length)) {
			index--;
			$('input[name=ip' + index + ']').focus();
		}

		var showButt = true;
		$(selector).each(function() {
			if ('' == $(this).val() || ('ipv4' == currIpv && 255 < $(this).val())) {
				return showButt = false;
			}
		});

		(showButt) ? $('.addIp2AccessList').show() : $('.addIp2AccessList').hide();
	});

	$('.addIp2AccessList').click(function() {
		var newIp = new Array();
		// собираем данные
		$(selector).each(function() {
			newIp.push($(this).val());
		});
		// производим запись данных
		$.get('/admajax.php?addAdmAccessIP=' + newIp.join(ipDelimeter), function(message) {
			if ('success' == message) {
				$(document.createElement('img')).attr({
					src: '{$smarty.const.TEMPLATE_PATH_ADMIN}images/icons/forbidden.png',
					alt: '{$smarty.const.FORM_BUTTON_DELETE}',
					title: '{$smarty.const.FORM_ADMIN_ACCESS_IP_LIST_DELETE}'
				}).data('ip', newIp.join(ipDelimeter)).css({ cursor: 'pointer' }).prependTo(
					$(document.createElement('div')).css({ margin: '5px' }).append(
						$(document.createElement('span')).css({ margin: '5px' }).text(newIp.join(ipDelimeter))
					).appendTo('.ipAccessList')
				).click(function() {
					if (confirm('{$smarty.const.MESSAGE_DELETE_IP_FROM_LIST}')) {
						var ipDescript = $(this).parent();
						$.get('/admajax.php?delAdmAccessIP=' + $(this).data('ip'), function(message) {
							if ('success' == message) {
								ipDescript.remove();
								(0 == $('.ipAccessList').children().size()) ? $('.ipAccessList').hide() : $.noop;
							} else if ('errIpNotExists' == message) {
								$.alert('{$smarty.const.ERROR_IP_NOTEXISTS_IN_ACCESS_LIST}');
							} else if ('errSaveConfIpList' == message) {
								$.alert('{$smarty.const.ERROR_NOT_SAVE_CHANGE}');
							} else {
								$.alert('{$smarty.const.ERROR_UNDEFINED}');
							}
						});
					}
				});
				$('.ipAccessList').show();
			} else if ('errIpExists' == message) {
				$.alert('{$smarty.const.ERROR_IP_EXISTS_IN_ACCESS_LIST}');
			} else if ('errSaveConfIpList' == message) {
				$.alert('{$smarty.const.ERROR_NOT_SAVE_CHANGE}');
			} else {
				$.alert('{$smarty.const.ERROR_UNDEFINED}');
			}

			$(selector).val('');
			$('.addIp2AccessList').hide();
		});
	});
});
-->
</script>