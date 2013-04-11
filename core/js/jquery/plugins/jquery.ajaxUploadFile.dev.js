/**
* Плагин AJAX-загрузки файлов на сервер.
* Для вызова используется JQuery-формат: $(selector).ajaxUploadFile({params})
* 
* Параметры (объект):
* {
*	urlUpload: false,					// (string) URL на который будет отправляться форма запроса загрузки файла
*	urlProgress: false,					// (string) URL на который будет отправляться запрос о процессе загрузки файла
*	buttonUpload: false,					// (string) HTML-код для кнопки отправки формы загрузки файла на сервер
*	buttonCancel: false,					// (string) HTML-код для кнопки отмены загрузки
* 	imgLoading: false,					// (string) HTML-код для картинки отображения процесса загрузки
*	autoUpload: false,					// (bool) Автозагрузка файла, сразу после выбора пользователем
*	maxFileSize: false,					// (int) Максимальный размера загружаемого файла: в Килобайтах
*	maxUploadedFiles: false,			// (int) Максимальное количество файлов которые можно загрузить
*	acceptFiles: false,					// (array) Список MIME-типов файлов разрешенных для загрузки
*	showProgress: true,					// (bool) Параметр определяющий отображение процесса загрузки файла
*	intervalProgress: 1000,				// (int) Интервал запросов о процессе загрузки файла на сервер в миллисекундах
*	uploadingMsg: false,					// (string) Сообщение выводимое в процессе загрузки файла
*	attrInputFile: {					// (object) Параметр определяющий аттрибуты поля <INPUT name="uploadFile" size="30" maxlength="255">
*		name: 'uploadFile',						// атрибут <INPUT name="uploadFile">
*		size: 30,								// атрибут <INPUT size="30">
*		maxlength: 255							// атрибут <INPUT maxlength="255">
*	},											ВНИМАНИЕ! Aтрибут TYPE всегда определен значением "file": <INPUT type="file">
*	onInit: function() {},				// Функция выполняемая после инициализации плагина
*	onSelect: function() {},			// Функция выполняемая после выбора пользователем файла для загрузки
*	onStartUpload: function() {},		// Функция выполняемая после старта процесса загрузки файла
*	onProgress: function() {},          // Функция выполняемая в процессе загрузки файла с интервалом intervalProgress
*	onComplete: function() {}           // Функция выполняемая после завершения процесса загрузки файла
* }
* ----------------------------------------------------------------------------------------------------------------------------------------------------------
* Плагин поддерживает вызов методов.
* Формат вызова методов плагина: $.fn.ajaxUploadFile('delUploaded'||'fsize', {params})
* ----------------------------------------------------------------------------------------------------------------------------------------------------------
* fsize - формирование строки размера файла, вида 'XX bytes|Kb|Mb'.
* 
* В качестве параметра принимает размер файла в байтах.
* ----------------------------------------------------------------------------------------------------------------------------------------------------------
* delUploaded - удаление загруженных файлов.
* Данный метод устанавливает событие UNLOAD на окно браузера, файлы будут удалены только после срабатывания события.
* 
* В качестве параметров принимает объект:
* {
*  	urlDelUploaded: false,				// (string) URL на который будет отправляться запрос удаления файла
*	nameDeleteFile: false,				// (string) Полное имя файла на сервере
* }
* ----------------------------------------------------------------------------------------------------------------------------------------------------------
* 
*/
(function($) {
	$.fn.ajaxUploadFile = function(method, params) {
		var methods = {
		    delUploaded: function() {
				return delUploaded(params);
		    },

		    fsize: function() {
				return fsize(params);
		    }
		};

		if (methods[method]) {
			return methods[method](params);
		} else {
			var params = method;
		}

		var auf = {};

		this.css('cursor', 'pointer');
		$.each(this, function() {
			if (!$(this).hasClass('initiatedUploadFile')) {
				init($(this), params);
				$(this).addClass('initiatedUploadFile');
			}
		});

		function init(selector, params) {
			selector.click(function() {
				var p = {
					urlUpload: false,
					urlProgress: false,
					buttonUpload: false,
					buttonCancel: false,
					imgLoading: false,
					autoUpload: false,
					maxFileSize: false,
    				maxUploadedFiles: false,
					acceptFiles: false,
					showProgress: true,
					intervalProgress: 1000,
					uploadingMsg: false,
					attrInputFile: {
						name: 'uploadFile',
						size: 30,
						maxlength: 255
					},
					onInit: function() {},
					onSelect: function() {},
					onStartUpload: function() {},
					onProgress: function() {},
					onComplete: function() {}
				};
				p = $.extend(p, params);
				if (!p.urlUpload) {
					alert('Error: urlUpload param is NULL!');
					return;
				} else {
                    p.selector = selector;
				}
				if (!p.selector.attr('key')) {
					p.key = new Date();
					p.key = p.key.getTime().toString();
					p.selector.attr('key', p.key).hide();
                    p.cntUploadedFiles = 0;
				} else {
					p.key = p.selector.attr('key');
					p.selector.hide();
				}
				if(auf[p.key]) {
					auf[p.key].form.insertAfter(p.selector);
					(auf[p.key].buttonCancel) ? auf[p.key].buttonCancel.show() : $.noop;
					return;
				}
                if (!$.browser.msie) {
                    p.form = $(document.createElement('form')).clone().attr({
                        action: p.urlUpload,
                        target: 'iframe_' + p.key,
                        enctype: 'multipart/form-data',
                        method: 'post'
                    }).insertAfter(p.selector).submit(function() {
                        uploadSelectedFile(p.key);
                    });
                    p.inputFile = $(document.createElement('input')).clone().attr($.extend(p.attrInputFile, {type: 'file'})).appendTo(p.form);
                    p.iframe = $(document.createElement('iframe')).clone().attr({name: 'iframe_' + p.key}).css({display: 'none'}).appendTo(p.form);
                } else {
                    p.form = $('<form action="' + p.urlUpload + '" target="iframe_' + p.key + '" enctype="multipart/form-data" method="post"></form>').insertAfter(p.selector).submit(function() {
                        uploadSelectedFile(p.key);
                    });
					var strParams = new Array();
					for (i in p.attrInputFile) {
						if ('type' != i) {
							strParams.push(i + '="' + p.attrInputFile[i] + '"');
						}
					}
                    p.inputFile = $('<input type="file" ' + strParams.join(' ') + '>').appendTo(p.form);
                    p.iframe = $('<iframe name="iframe_' + p.key  + '" style="display: none;"></iframe>').appendTo(p.form);
                }
				p.inputHidden = document.createElement('input');
				p.inputHidden.type = 'hidden';
				if (p.maxFileSize) {
					$(p.inputHidden).clone().attr({
						name: 'MAX_FILE_SIZE',
						value: p.maxFileSize * 1024
					}).insertBefore(p.inputFile);
				}
				$(p.inputHidden).clone().attr({
					name: 'UPLOAD_IDENTIFIER',
					value: p.key
				}).insertBefore(p.inputFile);
				if (p.acceptFiles && $.isArray(p.acceptFiles)) { 
					for (i in p.acceptFiles) {
						$(p.inputHidden).clone().attr({
							name: 'acceptMimeTypes[]',
							value: p.acceptFiles[i]
						}).appendTo(p.form);
					}
				}
				$(p.inputHidden).clone().attr({
					name: 'inputName',
					value: p.attrInputFile.name
				}).appendTo(p.form);
				p.uploadDescr = $(document.createElement('div')).clone().addClass('uploadDescr').attr({uploaded: 0}).css({display: 'none', margin: '10px'}).appendTo(p.form);
				(p.buttonCancel) ? p.buttonCancel = $(p.buttonCancel).css({cursor: 'pointer'}).insertBefore(p.inputFile).click(function() {
					(auf[p.key].buttonSubmit) ? auf[p.key].buttonSubmit.attr('disabled','disabled').hide() : $.noop;
					auf[p.key].inputFile.val('');
					auf[p.key].form.addClass('detachUploadForm').detach();
					auf[p.key].selector.show();
				}) : $.noop;
				p.inputFile.change(function() {
					if (!$(this).hasClass('selectedInputFile')) {
						$(this).addClass('selectedInputFile');
						auf[p.key].iframe.load(function () {
							uploadComplete(auf[p.key].key)
	                    });
					}
					auf[p.key].onSelect(auf[p.key]);
					if (true === auf[p.key].autoUpload) {
						auf[p.key].form.submit();
					} else if (!auf[p.key].buttonUpload) {
						auf[p.key].buttonSubmit = $('<input type="submit">').insertAfter($(this));
					} else if (!auf[p.key].buttonSubmit) {
						auf[p.key].buttonSubmit = $(auf[p.key].buttonUpload).insertAfter($(this));
                        if (!auf[p.key].buttonSubmit.is('input[type="submit"]') && !auf[p.key].buttonSubmit.is('input[type="image"]') && !auf[p.key].buttonSubmit.hasClass('clickedSubmintButton')) {
                            auf[p.key].buttonSubmit.css({cursor: 'pointer'}).addClass('clickedSubmintButton').click(function() {
                                auf[p.key].form.submit();
                            });
                        }
						if (auf[p.key].imgLoading) {
							auf[p.key].imgLoading = $(auf[p.key].imgLoading).insertAfter(auf[p.key].buttonSubmit).hide();
						}
					} else {
						auf[p.key].buttonSubmit.removeAttr('disabled').show();
					}
				});
				auf[p.key] = $.extend(auf[p.key], p);
				auf[p.key].onInit(auf[p.key]);
            });
		}

		function uploadSelectedFile(key) {
			auf[key].onStartUpload(auf[key]);
			(true !== auf[key].autoUpload) ? auf[key].buttonSubmit.attr('disabled','disabled').hide() : $.noop;
			(auf[key].buttonCancel) ? auf[key].buttonCancel.hide() : $.noop;
			(auf[key].imgLoading) ? auf[key].imgLoading.show() : $.noop;
			auf[key].fileDetailInfo = $(document.createElement('span')).clone().addClass('uploadedFileDetailInfo').css('text-align', 'right').appendTo(auf[key].uploadDescr);
			(auf[key].uploadingMsg) ? auf[key].fileDetailInfo.html(auf[key].uploadingMsg) : $.noop;
			var fname = auf[key].inputFile.val();
			fname = fname.split('\\');
			auf[key].realFileName = fname[fname.length-1];
			if (auf[key].showProgress) {
				auf[key].bar = $(document.createElement('div')).clone().addClass('progressbar').css({
					width: '100px',
					height: '10px'
				}).prependTo(auf[key].uploadDescr).progressbar({value: 0});
				auf[key].onProgressInterval = setInterval(function() {
					auf[key].onProgress(auf[key]);
				}, auf[key].intervalProgress);
				if (auf[key].urlProgress) {
					auf[key].progressInterval = setInterval(function() {
						$.ajax({
							type: 'post',
							url: auf[key].urlProgress,
							data: { 
								key: key,
								file: key + '.' + auf[key].realFileName
							},
							dataType: 'json',
							success: function(data) {
								if (data.result && 1 == data.result) {
									var min = Math.round(data.est_sec / 60);
									var sec = data.est_sec - min * 60;
									var time = sec + ' seconds';
									(min > 0) ? time = min + ' minutes ' + sec + ' seconds' : $.noop;
									var percents = Math.round(data.bytes_uploaded * 100 / data.bytes_total);
									auf[key].size = data.bytes_total;
									auf[key].bar.progressbar('value', percents);
									auf[key].uploadDescr.slideDown();
									auf[key].fileDetailInfo.html('<b>' + speeds(data.speed_average) + '</b> | <b>' + fsize(data.bytes_uploaded) + '</b> / <b>' + fsize(data.bytes_total) + '</b> | <b>' + percents + '%</b>');
								} else {
									clearInterval(auf[key].progressInterval);
									auf[key].size = data.size;
								}
							}
						});
					}, auf[key].intervalProgress);
				}
			}
		}

		function uploadComplete(key) {
			if (auf[key].realFileName == null) {
				return;
			}
			var respText = auf[key].iframe.contents().text();
			if ('' == respText) {
				return;
			}
			setTimeout(function() {
				clearInterval(auf[key].progressInterval);
				clearInterval(auf[key].onProgressInterval);
				try {
					auf[key].responce = $.parseJSON(respText);
				} catch (e) {
				 	auf[key].responce = {error: respText};
				}
				auf[key].responce.text = respText;
				if (!auf[key].responce.error) {
					auf[key].form.addClass('detachUploadForm').detach();
					if (!auf[key].maxUploadedFiles) {
						auf[key].selector.show();
					} else if (++auf[key].cntUploadedFiles < auf[key].maxUploadedFiles) {
						auf[key].selector.show();
					}
				}
				auf[key].inputFile.val('');
				(auf[key].imgLoading) ? auf[key].imgLoading.hide() : $.noop;
				if (true !== auf[key].autoUpload) {
					auf[key].buttonSubmit.hide();
				}
				auf[key].onComplete(auf[key]);
			}, 1000);
		}

		function delUploaded(params) {
			if (!params.urlDelUploaded) {
				alert('Error: urlDelUploaded param is NULL!');
				return;
			} else if (!params.nameDeleteFile) {
				alert('Error: nameDeletedFile params is NULL!');
				return;
			} else if (!$(window).data('delUploadedFile')) {
				$(window).unload(function() {
					var delUploadedFile = $(window).data('delUploadedFile');
					if (delUploadedFile) {
						$.post(params.urlDelUploaded, { 'delUploadedFile': delUploadedFile });
					}
				});
			}

			var delUploadedFile = new Array();
			var wData = $(window).data('delUploadedFile');
			(wData) ? delUploadedFile = wData.split(',') : $.noop;
			delUploadedFile.push(params.nameDeleteFile);
			$(window).data('delUploadedFile', delUploadedFile.join());
		}

		function fsize(bytes) {
			if (bytes < 1024) {
				bytes += ' ' + 'bytes';
			} else if ((bytes /= 1024) && bytes < 1024) {
				bytes = bytes.toFixed(2) + ' ' + 'Kb';
			} else {
				bytes /= 1024;
				bytes = bytes.toFixed(2) + ' ' + 'Mb';
			}

			return bytes;
		}

		function speeds(bytes) {
			return fsize(bytes) + '/sec';
		}
}
})(jQuery);