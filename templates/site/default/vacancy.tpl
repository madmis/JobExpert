{if $warnings}
	{include file="warnings.message.tpl"}
{/if}
{if $errors}
	{include file="errors.message.tpl"}
{elseif $actPage.view}
	{include file="vacancy.view.tpl"}
	<script type="text/javascript" src="{$smarty.const.CONF_SCRIPT_URL}core/js/jquery/plugins/jquery.ajaxUploadFile.js"></script>
	<script type="text/javascript">
	<!--
	$(document).ready(function() {
		// обработка отправки почтового сообщения через сайт
		$('.sendto').click(function() {
			var targ = $(this).next().children();
			$.fn.colorbox({ inline: true, href: targ, width: '65%', opacity: 0, scrolling: true });
			// отключаем горизонтальный скролл в окне colorbox (IE)
			$(targ).parent().css('overflow-x','hidden');
			// производим проверки при отправке формы
			$('#onSubmit').click(function() {
				var tryCnt = 0;
				var sendData = $(targ).find('input, textarea');
				var noEmptySendData = true;
				$.each(sendData, function() {
					if (!$(this).val()) {
						return noEmptySendData = false;
					}
				});
				var butt = $(this).parent();
				if (!noEmptySendData) {
					alert('{$smarty.const.ERROR_EMPTY_FIELDS}');
					return;
				}
				butt.hide().next().show();
				$.ajax({
					type: "POST",
					url: '/ajax.php?sendto',
					data: sendData.serialize(),
					success: function(msg){
						switch(msg) {
							case 'errEmail':
								alert('{$smarty.const.ERROR_EMAIL}');
								butt.show().next().hide();
								return;
							case 'errKeystring':
								alert('{$smarty.const.ERROR_CAPTCHA}');
								$('#refresh_si').click();
								$(targ).find('input[name="keystring"]').val('');
								butt.show().next().hide();
								return;
							case 'errSend':
								if (3 > ++tryCnt) {
									alert('{$smarty.const.ERROR_SEND_EMAIL_TRY_AGAIN}');
									$('#refresh_si').click();
									$(targ).find('input[name="keystring"]').val('');
									butt.show().next().hide();
								} else {
									$.fn.colorbox.close();
									alert('{$smarty.const.ERROR_SEND_EMAIL}');
									window.location.reload();
								}
								return;
							case 'success':
								$(targ[0]).remove();
								$(targ[1]).show();
								$.fn.colorbox.resize();
								return;
							case 'errSendto':
							case 'Error':
							default:
								$.fn.colorbox.close();
								alert('{$smarty.const.ERROR_DATA}');
								window.location.reload();
								return;
						}
					}
				});
			}).removeAttr('id');
		});
		// Обработка откликов на объявление
		$('#respondVacancy').change(function() {
			if (!$(this).val()) {
				$('#viewRespondVacancy').hide();
			} else {
				$('#viewRespondVacancy').show();
			}
		});
		$('#viewRespondVacancy').click(function() {
			$.post('/ajax.php?getAnnounceData=resume', { unikey: $('#respondVacancy').val() }, function(result) {
				var response;
				try {
					response = $.parseJSON(result);
				} catch (e) {
					$.noop;
				}
				// если нет ошибок, выводим форму предпросмотра и отравки
				if (!response || !response.error) {
					response = $(document.createElement('div')).append(result).append(
						$(document.createElement('div')).addClass('DesignMainPageBody').append(
							$('#sendRespondVacancy').clone().click(function() {
								var tryCnt = 0;
								$.ajax({
									type: "POST",
									url: '/ajax.php?sendto&respAnn',
									data: {
										sendto: '{$return_data.sendto}',
										email: $('#sendFrom').val(),
										subject: '{$smarty.const.ANNOUNCE_VACANCY_RESPONSE_FORM_HEAD}: {$return_data.title}',
										text: result
									},
									success: function(msg){
										switch(msg) {
											case 'errSend':
												if (3 > ++tryCnt) {
													alert('{$smarty.const.ERROR_SEND_EMAIL_TRY_AGAIN}');
												} else {
													$.fn.colorbox.close();
													alert('{$smarty.const.ERROR_SEND_EMAIL}');
													window.location.reload();
												}
												return;
											case 'success':
												response.children().remove();
												response.append($('#sendSuccessRespondVacancy').clone().show());
												$.fn.colorbox.resize();
												$('#viewRespondVacancy').hide();
												$('option[value="' + $('#respondVacancy').val() + '"]').remove();
												if ($('#respondVacancy > option').size() <= 1) {
													$('#trRespondVacancy').remove();
												}
												return;
											case 'errSendto':
											case 'errEmail':
											default:
												$.fn.colorbox.close();
												alert('{$smarty.const.ERROR_DATA}');
												window.location.reload();
												return;
										}
									}
								});
							}).show()
						)
					);//.children();
					$.fn.colorbox({ inline: true, href: response, width: '70%', height: '100%', opacity: 0, open: true, scrolling: true });
					// отключаем горизонтальный скролл в окне colorbox (IE)
					$(response).parent().css('overflow-x','hidden');
				} else { // иначе выводим сообщение об ошибке
					alert(json.error);
				}
			});
		});
		// Обработка аттачей
		{if $smarty.const.CONF_EMAIL_ATTACHMENT_FILES_ALLOW}
			$('.uploadFile').ajaxUploadFile({
				urlUpload: '/ajax.php?uploadFile',
				attrInputFile: {
					name: 'attachment',
					size: 50,
					maxlength: 250
				},
				maxFileSize: {$smarty.const.CONF_EMAIL_ATTACHMENT_FILE_MAX_SIZE},
				maxUploadedFiles: {$smarty.const.CONF_EMAIL_ATTACHMENT_MAX_FILES},
				acceptFiles: [
					'application/zip',
					'application/rtf',
					'text/plain'
				],
				buttonUpload: '<input type="image" src="{$smarty.const.CONF_SCRIPT_URL}templates/site/{$smarty.const.CONF_TEMPLATE}/images/actions/add.png" style="vertical-align: bottom;" title="{$smarty.const.SITE_UPLOAD_FILE}" alt="{$smarty.const.SITE_UPLOAD_FILE}">',
				buttonCancel: '<img src="{$smarty.const.CONF_SCRIPT_URL}templates/site/{$smarty.const.CONF_TEMPLATE}/images/actions/cancel.png" style="margin: 0px 5px 0px 0px; vertical-align: bottom;" title="{$smarty.const.SITE_CANCEL}" alt="{$smarty.const.SITE_CANCEL}">',
				imgLoading: '<img src="{$smarty.const.CONF_SCRIPT_URL}templates/site/{$smarty.const.CONF_TEMPLATE}/images/loading.gif" style="margin-left: 5px; vertical-align: top;" alt="">',
				onInit: function(data) {
					$.fn.colorbox.resize();
				},
				onComplete: function(data) {
					if (!data.responce.error) {
						var fUploaded = data.key + '.' + data.realFileName;
						$.fn.ajaxUploadFile('delUploaded', { 
							urlDelUploaded: '/ajax.php?uploadFile&action=delUploaded', 
							nameDeleteFile: fUploaded
						});
						$(document.createElement('img')).clone().attr({
							src: '{$smarty.const.CONF_SCRIPT_URL}templates/site/{$smarty.const.CONF_TEMPLATE}/images/actions/delete.png',
							title: '{$smarty.const.SITE_DELETE_FILE}',
							alt: '{$smarty.const.SITE_DELETE_FILE}'
						}).css({ cursor: 'pointer' }).insertBefore(
							$(document.createElement('span')).clone().css({
								margin: '5px'
							}).text(data.responce.name + ': ' + $.fn.ajaxUploadFile('fsize', data.responce.size)).insertAfter(
								$(data.inputHidden).clone().attr({
									name: data.attrInputFile.name + '[]',
									value: fUploaded
								}).appendTo(
									$(document.createElement('div')).clone().css({
										margin: '0px 10px 10px 10px'
									}).insertBefore(data.selector)
								)
							)
						).click(function() {
							if (confirm('{$smarty.const.MESSAGE_DELETE_FILE}')) {
								$(this).parent().remove();
								(data.form.hasClass('detachUploadForm') && --data.cntUploadedFiles < data.maxUploadedFiles) ? data.selector.show() : $.noop;
								$.fn.colorbox.resize();
							}
						});
						$.fn.colorbox.resize();
					} else {
						switch (data.responce.error) {
							case 'errFileMaxSize':
								alert('{$smarty.const.ERROR_FILE_UPLOAD_MAX_FILESIZE}');
								break;
							case 'errFileUploading':
								alert('{$smarty.const.ERROR_FILE_NOT_LOAD}');
								break;
							case 'errFileName':
								alert('{$smarty.const.ERROR_FILE_NAME}');
								break;
							case 'errFileType':
								alert('{$smarty.const.ERROR_FILE_FORMAT_ERROR}');
								break;
							case 'errFileUploaded':
								alert('{$smarty.const.ERROR_FILE_UPLOAD_DESTINATION}');
								break;
							case 'ErrInputFile':
								alert('{$smarty.const.ERROR_FILE_NOT_SELECTED}');
								break;
							default:
								alert('{$smarty.const.ERROR_UNKNOWN}');
						}
					}
				}
			});
		{/if}
	});
	-->
	</script>
{elseif $actPage.add || $actPage.edit}
	{include file="vacancy.form.tpl"}
{elseif $actPage.preview}
	{include file="vacancy.preview.tpl"}
{elseif $actPage.activate}
	{include file="announce.activate.tpl"}
{elseif $actPage.description}
	{include file="$path/vacancy.description.txt"}
{else}
	{include file="vacancy.view.short.tpl"}
{/if}