(function($) {
	// очищаем select
	$.fn.clearSelect =
		function() {
			return this.each(
				function() {
					if('SELECT' === this.tagName) this.options.length = 1;
				}
			);
		}

	// заполняем select
	$.fn.fillSelect =
		function(dataArray) {
			return this.clearSelect().each(
				function() {
					if('SELECT' === this.tagName) {
						var currentSelect = this;
						$.each(dataArray, function(index, data) {
							if ('0' !== data.id) {
								var currVal,
									selected,
									selVal = $('#selector').val();

								if (selVal) {
									currVal = $('#h' + selVal).val();
								}
								if ('0' !== currVal && data.id === currVal) {
									selected = true;
								} else {
									selected = false;
								}
								var option = new Option(data.name, data.id, false, selected);
								if($.support.cssFloat) {
									currentSelect.add(option, null);
								} else {
									currentSelect.add(option);
				  				}
							}
						});
						$('#selector').val('');
					}
				}
			);
		}
})(jQuery);

$(document).ready(function() {
	// Обработка селекторов Раздела и Профессий
	// обрабатываем селект если он был изменен
	$('#profession').change(function() {
		var sp = $('#profession').val();
		$('#hprofession').val(sp);
	});

	var selProfessions = $('#profession');
	// обрабатываем селект после перезагрузки страницы
	if ($('#section').val()) {
		$.get('/ajax.php', { id_s: $('#section').val() }, function(data) {
			$('#selector').val('profession');
			var data = $.parseJSON(data);
			selProfessions.fillSelect(data).removeAttr('disabled');
		});
	} else {
		selProfessions.clearSelect();
	}

	// обрабатываем селект если он был изменен
	$('#section').change(function() {
		if (!$(this).val()) {
			selProfessions.clearSelect();
		} else {
			$.get('/ajax.php', { id_s: $(this).val() }, function(data) {
				var data = $.parseJSON(data);
				selProfessions.fillSelect(data).removeAttr('disabled');
			});
		}
	});

	// Обработка селекторов Региона и Городов
	var selCitys = $('#city');
	// обрабатываем селект после перезагрузки страницы
	if ($('#region').val()) {
		$.getJSON('/ajax.php', { id_r: $('#region').val() }, function(resp) {
			$('#selector').val('city');
			var resp = $.parseJSON(resp);
			if (resp.success && resp.data) {
				selCitys.fillSelect(resp.data).show('fast').removeAttr('disabled');
			} else if (resp.success && !resp.data) {
				selCitys.hide().val('0');
			}
		});
	} else {
		selCitys.clearSelect();
	}

	// обрабатываем селект если он был изменен
	$('#region').change(function() {
		$('#hcity').val('');
		if (!$(this).val()) {
			selCitys.clearSelect();
		} else {
			$.get('/ajax.php', { id_r: $(this).val() }, function(resp) {
				var resp = $.parseJSON(resp);
				if (resp.success && resp.data) {
					selCitys.fillSelect(resp.data).show('fast').removeAttr('disabled');
				} else if (resp.success && !resp.data) {
					selCitys.clearSelect();
				}
			});
		}
	});
});