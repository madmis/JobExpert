<p class="sub_menu"><span class="colorbox_help" id="HELP_ADMIN_MANAGER_SUBSCRIPTIONS"><img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/actions/help.png" alt="{$smarty.const.FORM_IMG_HELP}"></span></p>

{if $errors}{include file="adm.errors.message.tpl"}{/if}

{* Настройки подписок *}
{if $action.config}
	{include file="adm.manager.subscriptions.config.tpl"}
{* Подписки по объявлениям *}
{elseif $action.announce}
	{include file="adm.manager.subscriptions.announce.tpl"}
{* Подписки ожидающие оплату *}
{elseif $action.payment}
	{include file="adm.manager.subscriptions.payment.tpl"}
{* Подписки *}
{else}
	{* ФОРМА ОТБОРА *}
	<form action="{$smarty.const.CONF_ADMIN_FILE}?m=manager&amp;s=subscriptions" method="get" enctype="multipart/form-data">
	<input type="hidden" name="m" value="manager">
	<input type="hidden" name="s" value="subscriptions">
	<input type="hidden" name="do" value="filter">
	<table style="width: 100%;" cellspacing="0" class="otbor_table">
		<thead class="otbor_head" id="subscr_main">
			<tr><td>{$smarty.const.TABLE_FORM_SELECTION}</td></tr>
		</thead>
		<tbody>
			<tr>
				<td align="left" style="width: 100%;">
					<table style="width: 100%;" cellpadding="5" class="hidden_table" id="subscr_main_otbor">
						<tbody class="otbor_body">
							<tr>
								<td>
									{$smarty.const.TABLE_COLUMN_USER_ID} <input type="text" name="id_user" class="text" size="5" value="{$return_data.id_user}">
								</td>
								<td>
									{$smarty.const.TABLE_COLUMN_PERIOD}
									<select name="period">
										<option value="">{$smarty.const.FORM_IMP}</option>
										{foreach from=$arrSysDict.SubscriptionPeriod.values item="item" key="key"}
										<option value="{$key}" {if $return_data.period eq $key}selected{/if}>{$item}</option>
										{/foreach}
									</select>
								</td>
							</tr>
							<tr>
								<td>
									{$smarty.const.TABLE_COLUMN_TYPE}:  
									<input type="radio" name="type_subscription" value="vacancy" {if $return_data.type_subscription eq 'vacancy'}checked{/if}> {$smarty.const.FORM_VACANCYS_HEAD}
									<input type="radio" name="type_subscription" value="resume" {if $return_data.type_subscription eq 'resume'}checked{/if}> {$smarty.const.FORM_RESUMES_HEAD}
									<input type="radio" name="type_subscription" value="all" {if $return_data.type_subscription neq 'vacancy' AND $return_data.type_subscription neq 'resume'}checked{/if}> {$smarty.const.FORM_IMP}
								</td>
								<td>
									{$smarty.const.TABLE_COLUMN_PAID}:
									<input type="radio" name="payment" value="yes" {if $return_data.payment eq 'yes'}checked{/if}> {$smarty.const.FORM_YES}
									<input type="radio" name="payment" value="no" {if $return_data.payment eq 'no'}checked{/if}> {$smarty.const.FORM_NO}
									<input type="radio" name="payment" value="all" {if $return_data.payment neq 'yes' AND $return_data.payment neq 'no'}checked{/if}> {$smarty.const.FORM_IMP}
								</td>
							</tr>
							<tr>
								<td>
									{$smarty.const.TABLE_COLUMN_SECTION}
									<select name="id_section" id="section">
										<option value="">{$smarty.const.SITE_ALL}</option>
										{foreach from=$sections item="section"}
										<option value="{$section.id}" {if $return_data.id_section eq $section.id}selected{/if}>{$section.name}</option>
										{/foreach}
									</select>
								</td>
								<td>
									{$smarty.const.TABLE_COLUMN_PROFESSION}
									<select name="id_profession" id="profession">
										<option value="">{$smarty.const.SITE_ALL}</option>
									</select>
								</td>
							</tr>
							<tr>
								<td>
									{$smarty.const.TABLE_COLUMN_REGION}
									<select name="id_region" id="region">
										<option value="">{$smarty.const.SITE_ALL}</option>
										{foreach from=$regions item="region"}
										<option value="{$region.id}" {if $return_data.id_region eq $region.id}selected{/if}>{$region.name}</option>
										{/foreach}
									</select>
								</td>
								<td>
									{$smarty.const.TABLE_COLUMN_CITY}
									<select name="id_city" id="city">
										<option value="">{$smarty.const.SITE_ALL}</option>
									</select>
								</td>
							</tr>
						</tbody>
						<tfoot class="otbor_foot">
							<tr>
								<td colspan="2"><input type="submit" value="{$smarty.const.FORM_BUTTON_EXECUTE}" class="button"></td>
								<input type="hidden" id="selector" value="">
								<input type="hidden" id="hcity" value="{$return_data.id_city}">
								<input type="hidden" id="hprofession" value="{$return_data.id_profession}">
							</tr>
						</tfoot>
					</table>
				</td>
			</tr>
		</tbody>
	</table>
	</form>

	{* СПИСОК ПОДПИСОК *}
	<form id="subscr" action="{$smarty.const.CONF_ADMIN_FILE}?m=manager&amp;s=subscriptions" method="post">
	<table class="dataTable100">
		<thead>
			<tr>
				<td>{$smarty.const.TABLE_COLUMN_USER_ID}</td>
				<td>{$smarty.const.TABLE_COLUMN_EMAIL}</td>
				<td>{$smarty.const.TABLE_COLUMN_TYPE}</td>
				<td>{$smarty.const.TABLE_COLUMN_SECTION}</td>
				<td>{$smarty.const.TABLE_COLUMN_PROFESSION}</td>
				<td>{$smarty.const.TABLE_COLUMN_REGION}</td>
				<td>{$smarty.const.TABLE_COLUMN_CITY}</td>
				<td>{$smarty.const.TABLE_COLUMN_PERIOD}</td>
				<td>{$smarty.const.TABLE_COLUMN_DATE_LASTSEND}</td>
				<td>{$smarty.const.TABLE_COLUMN_PAID}</td>
				<td><input type="checkbox" class="checked_all"></td>
			</tr>
		</thead>
		<tbody>
	{if $arrSubscr}
		{foreach from=$arrSubscr item="subscr" name="i"}
			<tr>
				<td class="alignCenter">{$subscr.id_user}</td>
				<td class="alignCenter">{$subscr.email}</td>
				<td class="alignCenter">{if $subscr.type_subscription eq 'vacancy'}{$smarty.const.FORM_VACANCYS_HEAD}{else}{$smarty.const.FORM_RESUMES_HEAD}{/if}</td>
				<td class="alignCenter">{$sections[$subscr.id_section].name}</td>
				<td class="alignCenter">{if !$subscr.id_profession}{$smarty.const.SITE_ALL}{else}{$professions[$subscr.id_profession].name}{/if}</td>
				<td class="alignCenter">{$regions[$subscr.id_region].name|escape}</td>
				<td class="alignCenter">{if !$subscr.id_city}{$smarty.const.SITE_ALL}{else}{$citys[$subscr.id_city].name|escape}{/if}</td>
				<td class="alignCenter">{$subscr.period}</td>
				<td class="alignCenter">{if $subscr.date_lastsend neq '0000-00-00'}{$subscr.date_lastsend|date_format:$smarty.const.CONF_DATE_FORMAT}{else}-----{/if}</td>
				<td class="alignCenter">
					{if $subscr.payment eq 'yes'}
						<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/icons/payments.png" title="{$subscr.payment}">
					{else}
						<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/icons/no.png" title="{$subscr.payment}">
					{/if}
				</td>
				<td class="alignCenter"><input type="checkbox" name="subscr[{$subscr.id}]" class="checkbox_entry"></td>
			</tr>
		{/foreach}
		</tbody>
		<tfoot>
			<tr>
				<td colspan="15" class="alignCenter">
					{$smarty.const.TABLE_RECORDS} {$smarty.foreach.i.total}/{$allRecords}
					<span style="float: right;">
					<select name="action" class="select">
						<option value="">{$smarty.const.FORM_ACTION_SELECT}</option>
						<option value="del">{$smarty.const.FORM_ACTION_DELETE_SELECTED}</option>
					</select>
					<input type="submit" value="{$smarty.const.FORM_BUTTON_EXECUTE}" class="button">
					</span>
				</td>
			</tr>
		</tfoot>
	{else}
			<tr>
				<td class="alignCenter" colspan="15">{$smarty.const.TABLE_NOT_DATA}</td>
			</tr>
		</tbody>
	{/if}
	</table>
	</form>

	<p class="alignCenter">{$strPages}</p>
{/if}

<script type="text/javascript">
<!--
/****** ФНУКЦИИ ДЛЯ СЕЛЕКТОВ *****/
(function($) {
	// очищаем select
	$.fn.clearSelect = function() {
		return this.each(function() {
			if('SELECT' === this.tagName) {
				this.options.length = 1;
				//$(this).attr('disabled', 'disabled');
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

					this_select = ('0' !== currVal && data.id === currVal) ? true : false;
					var option = new Option(data.name, data.id, false, this_select);
					($.support.cssFloat) ? currentSelect.add(option, null) : currentSelect.add(option);
				});
				$('#selector').val('');
			}
		});
	}
})(jQuery);




$(document).ready( function()
{
	//включаем все переключатели в таблице	
	$('.checked_all').click(function() {
		(!$(this).is(':checked')) ? $('.checkbox_entry').removeAttr('checked') : $('.checkbox_entry').attr('checked', 'checked');
	});

	// проверяем выбранное действие
	$("form[id]").submit( function() {
		if (!$('select[name="action"] option:selected').val()) {
			$.alert('{$smarty.const.ERROR_NOT_SELECT_ACTION}');
			return false;
		} else {
			if (!$('form[id] input:checked').size()) {
				$.alert('{$smarty.const.MESSAGE_WARNING_NOT_SELECT_RECORDS}');
				return false;
			}

			return ( $("select[name='action'] option:selected").val() === 'del' ) ? confirm('{$smarty.const.MESSAGE_DELETE_RECORDS}') : true;
		}
	});

/****** ЗАПОЛНЕНИЕ СЕЛЕКТОВ *****/
	// Обработка селектов Раздела и Профессий
	// обрабатываем селект если он был изменен
	$('#profession').change(function () {
		var sp = $('#profession').val();
		$('#hprofession').val(sp);
	});

	var selProfessions = $('#profession');
	// обрабатываем селект после перезагрузки страницы
	if ($('#section').val()) {
		selProfessions.clearSelect();
		$.getJSON('/admajax.php', { id_s: $('#section').val() }, function(data) {
			$('#selector').val('profession');
			selProfessions.fillSelect(data).removeAttr('disabled');
		});
	} else {
		selProfessions.clearSelect();
		//selProfessions.attr('disabled', 'disabled');
	}
	// обрабатываем селект если он был изменен
	$('#section').change(function () {
		if (!this.value) {
			selProfessions.clearSelect();
			//selProfessions.attr('disabled', 'disabled');
		} else {
			selProfessions.clearSelect();
			$.getJSON('/admajax.php', { id_s: this.value }, function(data) {
				selProfessions.fillSelect(data).removeAttr('disabled');
			});
		}
	});
	// Обработка селектов Региона и Городов
	var selCitys = $('#city');

	// обрабатываем селект после перезагрузки страницы
	if ($('#region').val()) {
		selCitys.clearSelect();
		$.getJSON('/admajax.php', { id_r: $('#region').val() }, function(data) {
			$('#selector').val('city');
			selCitys.fillSelect(data).removeAttr('disabled');
		});
	} else {
		selCitys.clearSelect();
		//selCitys.attr('disabled', 'disabled');
	}
	// обрабатываем селект если он был изменен
	$('#region').change(function () {
		$('#hcity').val('');
			if (!this.value) {
				selCitys.clearSelect();
				//selCitys.attr('disabled', 'disabled');
			} else {
				selCitys.clearSelect();
				$.getJSON('/admajax.php', { id_r: this.value }, function(data) {
					selCitys.fillSelect(data).removeAttr('disabled');
				});
			}
	});

});
-->
</script>