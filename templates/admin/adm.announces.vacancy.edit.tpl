<div id="tabForm">
	<ul>
		<li><a href="#params">{$smarty.const.ANNOUNCE_PARAMS_TAB}</a></li>
		<li><a href="#requirements">{$smarty.const.ANNOUNCE_REQUIREMENTS_TAB}</a></li>
		<li><a href="#info">{$smarty.const.ANNOUNCE_INFO_TAB}</a></li>
		<li><a href="#addition">{$smarty.const.ANNOUNCE_ADDITION_PARAMS_TAB}</a></li>
		<li><a href="#metadata">{$smarty.const.FORM_META_DATA}</a></li>
	</ul>

	<form action="#" id="fEditAnnounce" method="post" enctype="multipart/form-data">
		{* -------------------- Панель 1: Параметры ---------------------------- *}
		<div id="params">
			<h3>{$smarty.const.ANNOUNCE_VACANCY_PARAMS_HEAD}</h3>
				<table class="Design_panesFormTable">
					<tr>
						<td class="name">{$smarty.const.VACANCY_TITLE}</td>
						<td class="form">
							<input type="text" name="arrBindFields[title]" value="{$arrBindFields.title|escape}" style="width:300px;" maxlength="255">
						</td>
					</tr>
				</table>

				<hr class="Design_panesDelimiter">

				<table class="Design_panesFormTable">
					<tr>
						<td class="name">{$smarty.const.ANNOUNCE_SELECT_SECTION}</td>
						<td class="form">
							<select name="arrBindFields[id_section]" id="section" style="width:300px;">
								<option value="">{$smarty.const.ANNOUNCE_OPTION_SECTION}</option>
								{foreach from=$sections item="section"}
									<option value="{$section.id}" {if $arrBindFields.id_section eq $section.id}selected="selected"{/if}>{$section.name}</option>
								{/foreach}
							</select>
						</td>
					</tr>
					<tr>
						<td class="name">{$smarty.const.ANNOUNCE_SELECT_PROFESSION}</td>
						<td class="form">
							<select name="arrBindFields[id_profession]" id="profession" style="width:300px;">
								<option value="">{$smarty.const.ANNOUNCE_OPTION_PROFESSION}</option>
							</select>
						</td>
					</tr>
					<tr>
						<td class="name">{$smarty.const.ANNOUNCE_SELECT_REGION}</td>
						<td class="form">
							<select name="arrBindFields[id_region]" id="region" style="width:300px;">
								<option value="">{$smarty.const.ANNOUNCE_OPTION_REGION}</option>
								{foreach from=$regions item="region"}
									<option value="{$region.id}" {if $arrBindFields.id_region eq $region.id}selected="selected"{/if}>{$region.name}</option>
								{/foreach}
							</select>
						</td>
					</tr>
					<tr>
						<td class="name">{$smarty.const.ANNOUNCE_SELECT_CITY}</td>
						<td class="form">
							<select name="arrBindFields[id_city]" id="city" style="width:300px;">
								<option value="">{$smarty.const.ANNOUNCE_OPTION_CITY}</option>
							</select>
						</td>
					</tr>
				</table>

				<hr class="Design_panesDelimiter">

				<table class="Design_panesFormTable">
					<tr>
						<td class="name">{$smarty.const.ANNOUNCE_PAY_HEAD}</td>
						<td class="form">
							{$smarty.const.SITE_FROM}&nbsp;<input style="text-align: right;" type="text" name="arrBindFields[pay_from]"  size="5" maxlength="10" value="{$arrBindFields.pay_from}">
							{$smarty.const.SITE_UNTO}&nbsp;<input style="text-align: right;" type="text" name="arrNoBindFields[pay_post]"  size="5" maxlength="10" value="{if $arrNoBindFields.pay_post}{$arrNoBindFields.pay_post}{/if}">
							<select name="arrBindFields[currency]">
								{foreach from=$arrSysDict.Currency.values item="item"}
									<option value="{$item}" {if $arrBindFields.currency eq $item}selected="selected"{/if}>{$item}</option>
								{/foreach}
							</select>
						</td>
					</tr>
					<tr>
						<td class="name">{$smarty.const.ANNOUNCE_SELECT_CHARTWORK}</td>
						<td class="form">
							<select name="arrNoBindFields[chart_work]" style="width:300px;">
								{foreach from=$arrAddDict.ChartWork.values item="item"}
									<option value="{$item}" {if $arrNoBindFields.chart_work eq $item}selected="selected"{/if}>{$item}</option>
								{/foreach}
							</select>
						</td>
					</tr>
				</table>
		</div>
		{* -------------------- ^Панель 1: Параметры^ ---------------------------- *}

		{* -------------------- Панель 2: Требования ---------------------------- *}
		<div id="requirements">
			<h3>{$smarty.const.ANNOUNCE_VACANCY_REQUIREMENTS_HEAD}</h3>
			<table class="Design_panesFormTable">
				<tr>
					<td class="name">{$smarty.const.ANNOUNCE_SELECT_EXPIREWORK}</td>
					<td class="form">
						<select name="arrNoBindFields[expire_work]" style="width:300px;">
							{foreach from=$arrAddDict.ExpireWorkVacancy.values item="item"}
								<option value="{$item}" {if $arrNoBindFields.expire_work eq $item}selected="selected"{/if}>{$item}</option>
							{/foreach}
						</select>
					</td>
				</tr>
				<tr>
					<td class="name">{$smarty.const.ANNOUNCE_SELECT_EDUCATION}</td>
					<td class="form">
						<select name="arrNoBindFields[edu_work]" style="width:300px;">
							{foreach from=$arrAddDict.Education.values item="item"}
								<option value="{$item}" {if $arrNoBindFields.edu_work eq $item}selected="selected"{/if}>{$item}</option>
							{/foreach}
						</select>
					</td>
				</tr>
				<tr>
					<td class="name">{$smarty.const.ANNOUNCE_AGE}</td>
					<td class="form">
						{$smarty.const.SITE_FROM}&nbsp;<input style="text-align: right;" type="text" name="arrNoBindFields[age_from]" size="2" maxlength="2" value="{if $arrNoBindFields.age_from}{$arrNoBindFields.age_from}{/if}">
						{$smarty.const.SITE_UNTO}&nbsp;<input style="text-align: right;" type="text" name="arrNoBindFields[age_post]" size="2" maxlength="2" value="{if $arrNoBindFields.age_post}{$arrNoBindFields.age_post}{/if}">
					</td>
				</tr>
				<tr>
					<td class="name">{$smarty.const.ANNOUNCE_SELECT_GENDER}</td>
					<td class="form">
						<select name="arrNoBindFields[gender]">
							{foreach from=$arrSysDict.Gender.values item="item" key="key"}
								<option value="{$key}" {if $arrNoBindFields.gender eq $key}selected="selected"{/if}>{$item}</option>
							{/foreach}
						</select>
					</td>
				</tr>
			</table>
			<table class="Design_panesFormTable">
				<tr>
					<td class="name300">{$smarty.const.ANNOUNCE_TEXTAREA_REQUIREMENTS}</td>
					<td class="form">&nbsp;</td>
				</tr>
				<tr>
					<td colspan="3">
						<textarea name="arrBindFields[requirements]" rows="5" cols="70"{if $smarty.const.CONF_USE_VISUAL_EDITOR} class="tinymce"{/if}>{$arrBindFields.requirements}</textarea>
					</td>
				</tr>
				<tr>
					<td class="name300">{$smarty.const.ANNOUNCE_TEXTAREA_DUTESWORK}</td>
					<td class="form">&nbsp;</td>
				</tr>
				<tr>
					<td colspan="3">
						<textarea name="arrBindFields[duties_work]" rows="10" cols="70"{if $smarty.const.CONF_USE_VISUAL_EDITOR} class="tinymce"{/if}>{$arrBindFields.duties_work}</textarea>
					</td>
				</tr>
				<tr>
					<td class="name300">{$smarty.const.ANNOUNCE_TEXTAREA_CONDITIONS_WORK}</td>
					<td class="form">&nbsp;</td>
				</tr>
				<tr>
					<td colspan="3">
						<textarea name="arrNoBindFields[conditions_work]" rows="5" cols="70"{if $smarty.const.CONF_USE_VISUAL_EDITOR} class="tinymce"{/if}>{$arrNoBindFields.conditions_work}</textarea>
					</td>
				</tr>
			</table>
		</div>
		{* -------------------- ^Панель 2: Требования^ ---------------------------- *}

		{* -------------------- Панель 3: Информация ---------------------------- *}
		<div id="info">
			<table class="Design_panesFormTable">
				<tr>
					<td class="name" valign="top">
						{$smarty.const.ANNOUNCE_RADIOBOX_USER_TYPE_HEAD}
					</td>
					<td class="form" valign="top">
						<input type="radio" name="arrBindFields[user_type]" class="radio" value="{$arrBindFields.user_type}"{if 'employer' eq $arrBindFields.user_type || 'company' eq $arrBindFields.user_type} checked="checked"{/if}{if $user_email && 'agent' eq $user_type} disabled="disabled"{/if}>&nbsp;{$smarty.const.ANNOUNCE_RADIOBOX_USER_TYPE_EMPLOYER}
						<br>
						<input type="radio" name="arrBindFields[user_type]" class="radio" value="agent"{if 'agent' eq $arrBindFields.user_type} checked="checked"{/if}{if $user_email && 'agent' neq $user_type} disabled="disabled"{/if}>&nbsp;{$smarty.const.ANNOUNCE_RADIOBOX_USER_TYPE_AGENT}
					</td>
				</tr>
			</table>

			<div id="id_agent_name"{if 'agent' neq $arrBindFields.user_type} style="display: none"{/if}>
				<table class="Design_panesFormTable">
					<tr>
						<td class="name300">{$smarty.const.ANNOUNCE_CONTACTS_AGENT_NAME}</td>
						<td class="form">&nbsp;</td>
					</tr>
					<tr>
						<td colspan="3">
							<input type="text" name="arrBindFields[agent_name]" value="{$arrBindFields.agent_name|escape}" size="60" maxlength="255">
						</td>
					</tr>
				</table>
			</div>

			<hr class="Design_panesDelimiter">

			<h3>{$smarty.const.ANNOUNCE_VACANCY_INFO_HEAD}</h3>

			<table class="Design_panesFormTable">
				<tr>
					<td class="name">{$smarty.const.ANNOUNCE_CONTACTS_COMPANY_NAME}</td>
					<td class="form">
						<input type="text" name="arrBindFields[company_name]" value="{$arrBindFields.company_name|escape}" size="60" maxlength="255">
					</td>
				</tr>
			</table>

			<table class="Design_panesFormTable">
				<tr>
					<td class="name300">{$smarty.const.ANNOUNCE_COMPANY_DISCRIPTION}</td>
					<td class="form">&nbsp;</td>
				</tr>
				<tr>
					<td colspan="3">
						<textarea name="arrBindFields[company_discription]" rows="2" cols="70"{if $smarty.const.CONF_USE_VISUAL_EDITOR} class="tinymce"{/if}>{$arrBindFields.company_discription}</textarea>
					</td>
				</tr>
			</table>

			<hr class="Design_panesDelimiter">

			<h3>{$smarty.const.ANNOUNCE_CONTACTS_HEAD}</h3>

			<table class="Design_panesFormTable">
				<tr>
					<td class="name300" valign="top">{$smarty.const.ANNOUNCE_CONTACTS_FIO}</td>
					<td class="form" valign="top">&nbsp;</td>
				</tr>
				<tr>
					<td colspan="3"><input type="text" name="arrBindFields[contacts_fio]" value="{$arrBindFields.contacts_fio|escape}" size="50" maxlength="100"></td>
				</tr>
			</table>
			<table class="Design_panesFormTable">
				<tr>
					<td class="name" valign="top">{$smarty.const.ANNOUNCE_CONTACTS_EMAIL}</td>
					<td class="form" valign="top">
						<input type="text" name="arrBindFields[email]" value="{$arrBindFields.email}" size="30" maxlength="50">
						<input type="checkbox" name="arrNoBindFields[public_email]" disabled="disabled"{if $arrNoBindFields.public_email} checked="checked"{/if}>&nbsp;{$smarty.const.ANNOUNCE_CONTACTS_EMAIL_PUBLIC}
					</td>
				</tr>
				<tr>
					<td class="name300" valign="top">{$smarty.const.ANNOUNCE_CONTACTS_URL}</td>
					<td class="form" valign="top"><input type="text" name="arrNoBindFields[url]" value="{$arrNoBindFields.url|escape}" size="30" maxlength="50"></td>
				</tr>
				<tr>
					<td class="name">{$smarty.const.ANNOUNCE_CONTACTS_PHONE}</td>
					<td class="form">
						<input type="text" name="arrBindFields[phone]" value="{$arrBindFields.phone}" size="30" maxlength="50">
					</td>
				</tr>
				<tr>
					<td class="name">{$smarty.const.ANNOUNCE_CONTACTS_PHONE_NOTE}</td>
					<td class="form">
						<input type="text" name="arrNoBindFields[note_phone]" value="{$arrNoBindFields.note_phone|escape}" size="75" maxlength="250">
					</td>
				</tr>
				<tr class="addition_phones">
					<td class="name">{$smarty.const.ANNOUNCE_CONTACTS_PHONE}</td>
					<td class="form">
						<input type="text" name="arrNoBindFields[addition_phone_1]" value="{$arrNoBindFields.addition_phone_1}" size="30" maxlength="50">
					</td>
				</tr>
				<tr class="addition_phones">
					<td class="name">{$smarty.const.ANNOUNCE_CONTACTS_PHONE_NOTE}</td>
					<td class="form">
						<input type="text" name="arrNoBindFields[note_addition_phone_1]" value="{$arrNoBindFields.note_addition_phone_1|escape}" size="75" maxlength="250">
					</td>
				</tr>
				<tr class="addition_phones">
					<td class="name">{$smarty.const.ANNOUNCE_CONTACTS_PHONE}</td>
					<td class="form">
						<input type="text" name="arrNoBindFields[addition_phone_2]" value="{$arrNoBindFields.addition_phone_2}" size="30" maxlength="50">
					</td>
				</tr>
				<tr class="addition_phones">
					<td class="name">{$smarty.const.ANNOUNCE_CONTACTS_PHONE_NOTE}</td>
					<td class="form">
						<input type="text" name="arrNoBindFields[note_addition_phone_2]" value="{$arrNoBindFields.note_addition_phone_2|escape}" size="75" maxlength="250">
					</td>
				</tr>
			</table>
		</div>
		{* -------------------- ^Панель 3: Информация^ ---------------------------- *}

		{* -------------------- Панель 4: Дополнительно ---------------------------- *}
		<div id="addition">
			<h3>{$smarty.const.ANNOUNCE_ADDITION_PARAMS_HEAD}</h3>

			<table class="Design_panesFormTable">
				<tr>
					<td class="name300">{$smarty.const.ANNOUNCE_TEXTAREA_EXT_INFO}</td>
					<td class="form">&nbsp;</td>
				</tr>
				<tr>
					<td colspan="3">
						<textarea name="arrNoBindFields[ext_info]" rows="10" cols="70"{if $smarty.const.CONF_USE_VISUAL_EDITOR} class="tinymce"{/if}>{$arrNoBindFields.ext_info}</textarea>
					</td>
				</tr>
			</table>

			<hr class="Design_panesDelimiter">

			<table class="Design_panesFormTable">
				<tr>
					<td colspan="3">
						<input type="checkbox" name="arrNoBindFields[subscription]" class="checkbox" disabled="disabled"{if $arrNoBindFields.subscription} checked="checked"{/if}>&nbsp;{$smarty.const.ANNOUNCE_CHECKBOX_SUBCRIPTION_ON}
					</td>
				</tr>
			</table>
			<table class="Design_panesFormTable">
				<tr>
					<td class="name">
						{$smarty.const.ANNOUNCE_SELECT_ACTPERIOD}
					</td>
					<td class="form">
						<select name="arrBindFields[act_period]" id="act_period">
							{foreach from=$arrSysDict.ActPeriod.values item="item" key="key"}
								<option value="{$key}" {if $arrBindFields.act_period eq $key}selected="selected"{/if}>{$item}</option>
							{/foreach}
						</select>
					</td>
				</tr>
			</table>
		</div>
		{* -------------------- ^Панель 4: Дополнительно^ ---------------------------- *}

		{* -------------------- Панель 5: META-данные ---------------------------- *}
		<div id="metadata">
			<table class="Design_panesFormTable">
				<tr>
					<td class="name300">{$smarty.const.FORM_KEYWORDS}</td>
				</tr>
				<tr>
					<td colspan="3">
						<textarea name="arrServiceFields[meta_keywords]" rows="3" cols="70">{$arrServiceFields.meta_keywords}</textarea>
					</td>
				</tr>
			</table>

			<table class="Design_panesFormTable">
				<tr>
					<td class="name300">{$smarty.const.FORM_DESCRIPTION}</td>
				</tr>
				<tr>
					<td colspan="3">
						<textarea name="arrServiceFields[meta_description]" rows="10" cols="70">{$arrServiceFields.meta_description}</textarea>
					</td>
				</tr>
			</table>

			{* Служебные поля формы *}
			<input type="hidden" id="selector" value="">
			<input type="hidden" id="hcity" value="{$arrBindFields.id_city}">
			<input type="hidden" id="hprofession" value="{$arrBindFields.id_profession}">
		</div>
		{* -------------------- ^Панель 5: META-данные^ ---------------------------- *}
	</form>
</div>

{if $smarty.const.CONF_USE_VISUAL_EDITOR && $smarty.const.CONF_ANNOUNCE_USE_VISUAL_EDITOR}
<!-- TinyMCE -->
	<script type="text/javascript" src="{$smarty.const.CONF_SCRIPT_URL}core/modules/tinymce/basic_config.js"></script>
<!-- TinyMCE -->
{/if}

<script type="text/javascript">
(function($) {
	// формируем вкладки
    $.getScript('/core/js/jquery/ui/jquery.ui.tabs.js', function() {
		$('#tabForm').tabs();
	});
	// очищаем select
	$.fn.clearSelect = function() {
		return this.each(function() {
			if('SELECT' === this.tagName) {
				this.options.length = 1;
				$(this).attr('disabled', 'disabled');
			}
		});
	}
	// заполняем select
	$.fn.fillSelect = function(dataArray) {
		return this.clearSelect().each(function() {
			if('SELECT' === this.tagName) {
				var currentSelect = this;
				$.each(dataArray, function(index, data) {
					var currVal;
					var selVal = $('#selector').val();
					if (selVal) {
						currVal = $('#h' + selVal).val();
					}
					var this_select = ('0' !== currVal && data.id === currVal) ? true : false;
					var option = new Option(data.name, data.id, false, this_select);
					($.support.cssFloat) ? currentSelect.add(option, null) : currentSelect.add(option);
				});
				$('#selector').val('');
			}
		});
	}
})(jQuery);

$(document).ready(function() {
	// Обработка селектов Раздела и Профессий
	// обрабатываем селект если он был изменен
	$('#profession').change(function () {
		var sp = $('#profession').val();
		$('#hprofession').val(sp);
	});
	// обрабатываем селект после перезагрузки страницы
	var selProfessions = $('#profession');
	if ($('#section').val()) {
		$.get('/ajax.php', { id_s: $('#section').val() }, function(data) {
			$('#selector').val('profession');
			var data = $.parseJSON(data);
			selProfessions.fillSelect(data).removeAttr('disabled');
		});
	} else {
		selProfessions.clearSelect();
		selProfessions.attr('disabled', 'disabled');
	}
	// обрабатываем селект если он был изменен
	$('#section').change(function () {
		if (!$(this).val()) {
			selProfessions.clearSelect();
			selProfessions.attr('disabled', 'disabled');
		} else {
			$.get('/ajax.php', { id_s: $(this).val() }, function(data) {
				var data = $.parseJSON(data);
				selProfessions.fillSelect(data).removeAttr('disabled');
			});
		}
	});
	// Обработка селектов Региона и Городов
	var selCitys = $('#city');
	if ($('#region').val()) {
		$.get('/ajax.php', { id_r: $('#region').val() }, function(resp) {
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
		selCitys.attr('disabled', 'disabled');
	}
	// обрабатываем селект если он был изменен
	$('#region').change(function () {
		$('#hcity').val('');
		if (!$(this).val()) {
			selCitys.clearSelect();
			selCitys.attr('disabled', 'disabled').show('fast');
		} else {
			$.get('/ajax.php', { id_r: $(this).val() }, function(resp) {
				var resp = $.parseJSON(resp);
				if (resp.success && resp.data) {
					selCitys.fillSelect(resp.data).show('fast').removeAttr('disabled');
				} else if (resp.success && !resp.data) {
					selCitys.hide('fast').val('0');
				}
			});
		}
	});

	$('.radio').click(function () {
		if ('agent' === $(this).val()) {
			$('#id_agent_name').show('normal');
		} else if ('employer' === $(this).val() || 'company' === $(this).val()) {
			$('#id_agent_name').hide('normal');
		}
	});

	// действия при отправке формы
	$('form[id="fEditAnnounce"]').submit(function () {
		return false;
	});
});
-->
</script>