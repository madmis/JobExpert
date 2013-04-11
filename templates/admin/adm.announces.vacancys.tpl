{* Вывод ошибок *}
{if $errors}
	{include file="adm.errors.message.tpl"}
{/if}
{* Модерация Вакансий *}
{if $action.moderate}
	{include file="adm.announces.vacancys.moderate.tpl"}
{* Вакансии ожидающие активации *}
{elseif $action.new}
	{include file="adm.announces.vacancys.new.tpl"}
{* Вакансии ожидающие оплату *}
{elseif $action.payment}
	{include file="adm.announces.vacancys.payment.tpl"}
{* Вакансии ожидающие исправления *}
{elseif $action.correction}
	{include file="adm.announces.vacancys.correction.tpl"}
{* Вакансии в архиве*}
{elseif $action.archived}
	{include file="adm.announces.vacancys.archived.tpl"}
{* Список Вакансий *}
{else}
	<form action="{$smarty.const.CONF_ADMIN_FILE}?m=announces&amp;s=vacancys" method="post" enctype="multipart/form-data">
		<table style="width: 100%; border: 0px;" cellspacing="5" cellpadding="3">
			<thead class="data_head">
				<tr>
					{if $return_data}
						<td>
							{$smarty.const.MENU_ANNOUNCES_VACANCYS}:&nbsp;{if $action.template}{$smarty.const.ANNOUNCE_TOKEN_TEMPLATE}{else}{$smarty.const.ANNOUNCE_TOKEN_ACTIVE}{/if}
							{if $arrSort}
								<span style="float: right; padding: 0px 5px;">
									<a href="{$smarty.const.CONF_ADMIN_FILE}?m=announces&amp;s=vacancys{$strFilter}"><img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/icons/unsort.png" alt="{$smarty.const.ANNOUNCE_SORT_OFF}" title="{$smarty.const.ANNOUNCE_SORT_OFF}"></a>
								</span>
							{/if}
						</td>
						<td style="width: 5%;"><input type="checkbox" class="checked_all"></td>
					{else}
						<td>{$smarty.const.MENU_ANNOUNCES_VACANCYS}:&nbsp;{if $action.template}{$smarty.const.ANNOUNCE_TOKEN_TEMPLATE}{else}{$smarty.const.ANNOUNCE_TOKEN_ACTIVE}{/if}</td>
						<td style="width: 5%;"><input type="checkbox" disabled="disabled"></td>
					{/if}
				</tr>
			</thead>
	{if $return_data}
		<tbody style="background-color: #FFFFCC;">
			{foreach from=$return_data item="vacancy" name="vacancy"}
				<tr>
					<td>
						<table style="width: 100%; border: 1px dashed #DA6969; padding: 10px;" cellpadding="2" cellspacing="2">
							<thead>
								<tr>
									<td>
										<p>
										</p>
										<p>
											{$smarty.const.FORM_VACANCY_NAME}:&nbsp;
											<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/actions/edit.png" data-id="{$vacancy.id}" class="announce_edit" alt="{$smarty.const.EDIT_VACANCY_HEAD}: {$vacancy.title|escape}" title="{$smarty.const.EDIT_VACANCY_HEAD}: {$vacancy.title|escape}" style="cursor: pointer;">&nbsp;
											<span id="vac_{$vacancy.id}" class="announce_detail" style="color: #CC3333; cursor: pointer; font-weight: bold;" title="{$smarty.const.FORM_VIEW_ANNOUNCE_HEAD}: {$vacancy.title|escape}">{$vacancy.title|truncate:200:'...'}</span>
										</p>
										<p>
											{$smarty.const.ANNOUNCE_CONTACTS_COMPANY_NAME}:&nbsp;
											{if $arrFilter.filter eq 'company_name'}
												{capture name='filter'}{/capture}
												{capture name='const'}{$smarty.const.ANNOUNCE_FILTER_OFF}{/capture}
												{capture name='image'}unfilter.png{/capture}
											{else}
												{capture name='filter'}&amp;filter=company_name&amp;in={$vacancy.company_name}{/capture}
												{capture name='const'}{$smarty.const.ANNOUNCE_FILTER_ON}{/capture}
												{capture name='image'}filter.png{/capture}
											{/if}
											<a href="{$smarty.const.CONF_ADMIN_FILE}?m=announces&amp;s=vacancys{$smarty.capture.filter}{$strSort}"><img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/icons/{$smarty.capture.image}" alt="{$smarty.capture.const}" title="{$smarty.capture.const}: {$vacancy.company_name}"></a>
											<b>{$vacancy.company_name}</b>
										</p>
										<p>
											{$smarty.const.ANNOUNCE_CONTACTS_EMAIL}:&nbsp;
											{if $arrFilter.filter eq 'email'}
												{capture name='filter'}{/capture}
												{capture name='const'}{$smarty.const.ANNOUNCE_FILTER_OFF}{/capture}
												{capture name='image'}unfilter.png{/capture}
											{else}
												{capture name='filter'}&amp;filter=email&amp;in={$vacancy.email}{/capture}
												{capture name='const'}{$smarty.const.ANNOUNCE_FILTER_ON}{/capture}
												{capture name='image'}filter.png{/capture}
											{/if}
											<a href="{$smarty.const.CONF_ADMIN_FILE}?m=announces&amp;s=vacancys{$smarty.capture.filter}{$strSort}"><img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/icons/{$smarty.capture.image}" alt="{$smarty.capture.const}" title="{$smarty.capture.const}: {$vacancy.email}"></a>
											<b>{$vacancy.email}</b>
										</p>
										<p>
											{$smarty.const.ANNOUNCE_USER_TYPE}:&nbsp;
											{if $arrFilter.filter eq 'user_type'}
												{capture name='filter'}{/capture}
												{capture name='const'}{$smarty.const.ANNOUNCE_FILTER_OFF}{/capture}
												{capture name='image'}unfilter.png{/capture}
											{else}
												{capture name='filter'}&amp;filter=user_type&amp;in={$vacancy.user_type}{/capture}
												{capture name='const'}{$smarty.const.ANNOUNCE_FILTER_ON}{/capture}
												{capture name='image'}filter.png{/capture}
											{/if}
											<a href="{$smarty.const.CONF_ADMIN_FILE}?m=announces&amp;s=vacancys{$smarty.capture.filter}{$strSort}"><img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/icons/{$smarty.capture.image}" alt="{$smarty.capture.const}" title="{$smarty.capture.const}: {$vacancy.user_type}"></a>
											<b>{$vacancy.user_type}</b>
										</p>
									</td>
									<td class="short_info">
										<p>
											{$smarty.const.ANNOUNCE_SUBCRIPTION}:&nbsp;
											{if $vacancy.subscription}
												<span style="font-weight: bold;">{$smarty.const.SITE_ISSET}</span>
											{else}
												<span style="font-weight: bold;">{$smarty.const.SITE_NO}</span>
											{/if}
										</p>
										<p class="pVIP{$vacancy.id}">
											{$smarty.const.ANNOUNCE_STATUS_VIP}:&nbsp;
											{if $vacancy.vip && '0000-00-00 00:00:00' neq $vacancy.vip_unset_datetime}
												{$smarty.const.SITE_UNTO}&nbsp;<span style="font-weight: bold;">{$vacancy.vip_unset_datetime|date_format:$smarty.const.CONF_DATE_FORMAT}&nbsp;{$vacancy.vip_unset_datetime|date_format:$smarty.const.CONF_TIME_FORMAT}</span>
												<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/services/resetVIP.png" name="{$vacancy.id}" class="resetVIP" style="margin-left: 10px; cursor: pointer;" title="{$smarty.const.ANNOUNCE_RESET_STATUS}: {$smarty.const.ANNOUNCE_SET_STATUS_VIP_VACANCY}" alt="{$smarty.const.ANNOUNCE_RESET_STATUS}: {$smarty.const.ANNOUNCE_SET_STATUS_VIP_VACANCY}">
											{elseif $vacancy.vip}
												<span style="font-weight: bold;">{$smarty.const.RECORD_PERMANENT}</span>
												<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/services/resetVIP.png" name="{$vacancy.id}" class="resetVIP" style="margin-left: 10px; cursor: pointer;" title="{$smarty.const.ANNOUNCE_RESET_STATUS}: {$smarty.const.ANNOUNCE_SET_STATUS_VIP_VACANCY}" alt="{$smarty.const.ANNOUNCE_RESET_STATUS}: {$smarty.const.ANNOUNCE_SET_STATUS_VIP_VACANCY}">
											{else}
												<span style="font-weight: bold;">{$smarty.const.SITE_NO}</span>
												<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/services/setVIP.png" name="{$vacancy.id}" class="setVIP" style="margin-left: 10px; cursor: pointer;" title="{$smarty.const.ANNOUNCE_SET_STATUS}: {$smarty.const.ANNOUNCE_SET_STATUS_VIP_VACANCY}" alt="{$smarty.const.ANNOUNCE_SET_STATUS}: {$smarty.const.ANNOUNCE_SET_STATUS_VIP_VACANCY}">
											{/if}
										</p>
										<p class="pHOT{$vacancy.id}">
											{$smarty.const.ANNOUNCE_STATUS_HOT}:&nbsp;
											{if $vacancy.hot && '0000-00-00 00:00:00' neq $vacancy.hot_unset_datetime}
												{$smarty.const.SITE_UNTO}&nbsp;<span style="font-weight: bold;">{$vacancy.hot_unset_datetime|date_format:$smarty.const.CONF_DATE_FORMAT}&nbsp;{$vacancy.hot_unset_datetime|date_format:$smarty.const.CONF_TIME_FORMAT}</span>
												<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/services/resetHOT.png" name="{$vacancy.id}" class="resetHOT" style="margin-left: 10px; cursor: pointer;" title="{$smarty.const.ANNOUNCE_RESET_STATUS}: {$smarty.const.ANNOUNCE_SET_STATUS_HOT_VACANCY}" alt="{$smarty.const.ANNOUNCE_RESET_STATUS}: {$smarty.const.ANNOUNCE_SET_STATUS_HOT_VACANCY}">
											{elseif $vacancy.hot}
												<span style="font-weight: bold;">{$smarty.const.RECORD_PERMANENT}</span>
												<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/services/resetHOT.png" name="{$vacancy.id}" class="resetHOT" style="margin-left: 10px; cursor: pointer;" title="{$smarty.const.ANNOUNCE_RESET_STATUS}: {$smarty.const.ANNOUNCE_SET_STATUS_HOT_VACANCY}" alt="{$smarty.const.ANNOUNCE_RESET_STATUS}: {$smarty.const.ANNOUNCE_SET_STATUS_HOT_VACANCY}">
											{else}
												<span style="font-weight: bold;">{$smarty.const.SITE_NO}</span>
												<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/services/setHOT.png" name="{$vacancy.id}" class="setHOT" style="margin-left: 10px; cursor: pointer;" title="{$smarty.const.ANNOUNCE_SET_STATUS}: {$smarty.const.ANNOUNCE_SET_STATUS_HOT_VACANCY}" alt="{$smarty.const.ANNOUNCE_SET_STATUS}: {$smarty.const.ANNOUNCE_SET_STATUS_HOT_VACANCY}">
											{/if}
										</p>
										<p class="pRate{$vacancy.id}">
											{$smarty.const.ANNOUNCE_STATUS_RATE}:&nbsp;
											{if $vacancy.rate neq '0000-00-00 00:00:00'}
												{$smarty.const.ANNOUNCE_RATE_DATETIME}&nbsp;
												<span style="font-weight: bold;">{$vacancy.rate|date_format:$smarty.const.CONF_DATE_FORMAT}&nbsp;{$vacancy.rate|date_format:$smarty.const.CONF_TIME_FORMAT}</span>
												<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/services/resetRate.png" name="{$vacancy.id}" class="resetRate" style="margin-left: 10px; cursor: pointer;" title="{$smarty.const.ANNOUNCE_RESET_STATUS_RATE_VACANCY}" alt="{$smarty.const.ANNOUNCE_RESET_STATUS_RATE_VACANCY}">
											{else}
												<span style="font-weight: bold;">{$smarty.const.SITE_NO}</span>
											{/if}
											<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/services/setRate.png" name="{$vacancy.id}" class="setRate" style="margin-left: 10px; cursor: pointer;" title="{$smarty.const.ANNOUNCE_SET_STATUS_RATE_VACANCY}" alt="{$smarty.const.ANNOUNCE_SET_STATUS_RATE_VACANCY}">
										</p>
										<p>{$smarty.const.ANNOUNCE_COUNT_VIEWS}:&nbsp;<span style="font-weight: bold;">{$vacancy.cnt_views_total}</span></p>
									</td>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td style="width: 50%;">
										<p class="p_name">{$smarty.const.ANNOUNCE_SELECT_REGION}:</p>
										<p class="p_bold">
											{if $arrFilter.filter eq 'id_region'}
												{capture name='filter'}{/capture}
												{capture name='const'}{$smarty.const.ANNOUNCE_FILTER_OFF}{/capture}
												{capture name='image'}unfilter.png{/capture}
											{else}
												{capture name='filter'}&amp;filter=id_region&amp;in={$vacancy.id_region}{/capture}
												{capture name='const'}{$smarty.const.ANNOUNCE_FILTER_ON}{/capture}
												{capture name='image'}filter.png{/capture}
											{/if}
											<a href="{$smarty.const.CONF_ADMIN_FILE}?m=announces&amp;s=vacancys{$smarty.capture.filter}{$strSort}"><img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/icons/{$smarty.capture.image}" alt="{$smarty.capture.const}" title="{$smarty.capture.const}: {$regions[$vacancy.id_region].name|escape}"></a>
											{$regions[$vacancy.id_region].name|escape}
										</p>
									</td>
									<td style="width: 50%;">
										<p class="p_name">{$smarty.const.ANNOUNCE_SELECT_CITY}:</p>
										<p class="p_bold">
											{if $arrFilter.filter eq 'id_city'}
												{capture name='filter'}{/capture}
												{capture name='const'}{$smarty.const.ANNOUNCE_FILTER_OFF}{/capture}
												{capture name='image'}unfilter.png{/capture}
											{else}
												{capture name='filter'}&amp;filter=id_city&amp;in={$vacancy.id_city}{/capture}
												{capture name='const'}{$smarty.const.ANNOUNCE_FILTER_ON}{/capture}
												{capture name='image'}filter.png{/capture}
											{/if}
											<a href="{$smarty.const.CONF_ADMIN_FILE}?m=announces&amp;s=vacancys{$smarty.capture.filter}{$strSort}"><img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/icons/{$smarty.capture.image}" alt="{$smarty.capture.const}" title="{$smarty.capture.const}: {$citys[$vacancy.id_city].name|escape}"></a>
											{$citys[$vacancy.id_city].name|escape}
										</p>
									</td>
								</tr>
								<tr>
									<td style="width: 50%;">
										<p class="p_name">{$smarty.const.ANNOUNCE_SELECT_SECTION}:</p>
										<p class="p_bold">
											{if $arrFilter.filter eq 'id_section'}
												{capture name='filter'}{/capture}
												{capture name='const'}{$smarty.const.ANNOUNCE_FILTER_OFF}{/capture}
												{capture name='image'}unfilter.png{/capture}
											{else}
												{capture name='filter'}&amp;filter=id_section&amp;in={$vacancy.id_section}{/capture}
												{capture name='const'}{$smarty.const.ANNOUNCE_FILTER_ON}{/capture}
												{capture name='image'}filter.png{/capture}
											{/if}
											<a href="{$smarty.const.CONF_ADMIN_FILE}?m=announces&amp;s=vacancys{$smarty.capture.filter}{$strSort}"><img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/icons/{$smarty.capture.image}" alt="{$smarty.capture.const}" title="{$smarty.capture.const}: {$sections[$vacancy.id_section].name}"></a>
											{$sections[$vacancy.id_section].name}
										</p>
									</td>
									<td style="width: 50%;">
										<p class="p_name">{$smarty.const.ANNOUNCE_SELECT_PROFESSION}:</p>
										<p class="p_bold">
											{if $arrFilter.filter eq 'id_profession'}
												{capture name='filter'}{/capture}
												{capture name='const'}{$smarty.const.ANNOUNCE_FILTER_OFF}{/capture}
												{capture name='image'}unfilter.png{/capture}
											{else}
												{capture name='filter'}&amp;filter=id_profession&amp;in={$vacancy.id_profession}{/capture}
												{capture name='const'}{$smarty.const.ANNOUNCE_FILTER_ON}{/capture}
												{capture name='image'}filter.png{/capture}
											{/if}
											<a href="{$smarty.const.CONF_ADMIN_FILE}?m=announces&amp;s=vacancys{$smarty.capture.filter}{$strSort}"><img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/icons/{$smarty.capture.image}" alt="{$smarty.capture.const}" title="{$smarty.capture.const}: {$professions[$vacancy.id_profession].name}"></a>
											{$professions[$vacancy.id_profession].name}
										</p>
									</td>
								</tr>
								<tr>
									<td style="width: 50%;">
										{$smarty.const.ANNOUNCE_ACTIVATE_DATETIME}:&nbsp;
										{if $arrSort.order neq 'act_datetime' || ($arrSort.order eq 'act_datetime' && $arrSort.by neq 'DESC')}<a href="{$smarty.const.CONF_ADMIN_FILE}?m=announces&amp;s=vacancys{$strFilter}&amp;order=act_datetime&amp;by=DESC"><img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/icons/sort_down.gif" alt="{$smarty.const.ANNOUNCE_SORT_DOWN}" title="{$smarty.const.ANNOUNCE_SORT_DOWN}"></a>{/if}
										<b>{$vacancy.act_datetime|date_format:$smarty.const.CONF_DATE_FORMAT}</b>
										{if $arrSort.order neq 'act_datetime' || ($arrSort.order eq 'act_datetime' && $arrSort.by neq 'ASC')}<a href="{$smarty.const.CONF_ADMIN_FILE}?m=announces&amp;s=vacancys{$strFilter}&amp;order=act_datetime&amp;by=ASC"><img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/icons/sort_up.gif" alt="{$smarty.const.ANNOUNCE_SORT_UP}" title="{$smarty.const.ANNOUNCE_SORT_UP}"></a>{/if}
									</td>
									<td style="width: 50%;">
										{$smarty.const.ANNOUNCE_DEACTIVATE_DATETIME}:&nbsp;
										{if $arrSort.order neq 'token_datetime' || ($arrSort.order eq 'token_datetime' && $arrSort.by neq 'DESC')}<a href="{$smarty.const.CONF_ADMIN_FILE}?m=announces&amp;s=vacancys{$strFilter}&amp;order=token_datetime&amp;by=DESC"><img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/icons/sort_down.gif" alt="{$smarty.const.ANNOUNCE_SORT_DOWN}" title="{$smarty.const.ANNOUNCE_SORT_DOWN}"></a>{/if}
										<b>{$vacancy.token_datetime|date_format:$smarty.const.CONF_DATE_FORMAT}</b>
										{if $arrSort.order neq 'token_datetime' || ($arrSort.order eq 'token_datetime' && $arrSort.by neq 'ASC')}<a href="{$smarty.const.CONF_ADMIN_FILE}?m=announces&amp;s=vacancys{$strFilter}&amp;order=token_datetime&amp;by=ASC"><img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/icons/sort_up.gif" alt="{$smarty.const.ANNOUNCE_SORT_UP}" title="{$smarty.const.ANNOUNCE_SORT_UP}"></a>{/if}
									</td>
								</tr>
							</tbody>
						</table>
					</td>
					<td style="text-align: center; width: 5%;">
						<input type="checkbox" name="arrVacData[id][{$vacancy.id}]" class="checkbox_entry">
						<div style="display: none;">
							<div id="openvac_{$vacancy.id}">{include file="adm.announces.vacancy.detail.tpl"}</div>
						</div>
					</td>
				</tr>
			{/foreach}
		</tbody>
			<tfoot class="data_foot">
				<tr>
					<td colspan="2" style="text-align: center;">
						{$smarty.const.TABLE_RECORDS}&nbsp;{$smarty.foreach.vacancy.total}/{$allRecords}
						<span style="float: right;">
							<select name="arrVacData[action]" class="select">
								<option value="">{$smarty.const.FORM_ACTION_SELECT}</option>
								<option value="archived">{$smarty.const.FORM_ACTION_ARCHIVE}</option>
								<option value="deleted">{$smarty.const.FORM_ACTION_DELETE_SELECTED}</option>
							</select>
							<input type="submit" value="{$smarty.const.FORM_BUTTON_EXECUTE}" class="button" style="margin: 5px;">
						</span>
					</td>
				</tr>
			</tfoot>
	{else}
			<tbody class="data_body">
				<tr>
					<td align="center" colspan="2">
						{$smarty.const.TABLE_NOT_DATA}
					</td>
				</tr>
			</tbody>
	{/if}
		</table>
	</form>

	<p align="center">{$strPages}</p>

<script type="text/javascript">
<!--
$(document).ready(function() {
	//Подробный просмотр
	$('.announce_detail').click(function() {
		var targ = '#open' + $(this).attr('id');
		$.fn.colorbox({ inline: true, href: targ, width: '100%', height: '100%', opacity: 0, scrolling: true });
		// отключаем горизонтальный скролл в окне colorbox (IE)
		$(targ).parent().css('overflow-x','hidden');
	});

	// установка статусов объявлениям
	$('.setVIP, .resetVIP, .setHOT, .resetHOT, .setRate, .resetRate').live('click', function() {
		if (confirm('{$smarty.const.MESSAGE_PERFORM_OPERATION}'))
		{
			var currAction = $(this);
			var id = currAction.attr('name');
				if (!id) {
					$.alert('{$smarty.const.ERROR_ID}');
					window.location.reload();
					return;
				}
				$('#overlay, #dialog').show();
				$.ajax({
					type: "POST",
					url: '/admajax.php?action=' + currAction.attr('class'),
					data: 'annType=vacancy&id=' + id,
					success: function(msg){
						$('#overlay, #dialog').hide();
						switch (msg) {
							case 'success':
							{
								switch (currAction.attr('class')) {
									case 'setVIP':
										var strTerm = (!{$smarty.const.CONF_VACANCY_VIP_THERM}) ? '<span style="font-weight: bold;">{$smarty.const.RECORD_PERMANENT}</span>' :  '{$smarty.const.SITE_UNTO}&nbsp;<span style="font-weight: bold;">{terms::calcDateTimeOfTerm({$smarty.const.CONF_VACANCY_VIP_THERM}, "{terms::dateFormatFromSmarty({$smarty.const.CONF_DATE_FORMAT}, {$smarty.const.CONF_TIME_FORMAT})}")}</span>';
										$('.short_info').find('.pVIP' + id).empty().append('{$smarty.const.ANNOUNCE_STATUS_VIP}:&nbsp;&nbsp;' + strTerm + '&nbsp;<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/services/resetVIP.png" name="' + id + '" class="resetVIP" style="margin-left: 10px; cursor: pointer;" title="{$smarty.const.ANNOUNCE_RESET_STATUS}: {$smarty.const.ANNOUNCE_SET_STATUS_VIP_VACANCY}" alt="{$smarty.const.ANNOUNCE_RESET_STATUS}: {$smarty.const.ANNOUNCE_SET_STATUS_VIP_VACANCY}">');
										break;
									case 'resetVIP':
										$('.short_info').find('.pVIP' + id).empty().append('{$smarty.const.ANNOUNCE_STATUS_VIP}:&nbsp;&nbsp;<span style="font-weight: bold;">{$smarty.const.SITE_NO}</span>&nbsp;<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/services/setVIP.png" name="' + id + '" class="setVIP" style="margin-left: 10px; cursor: pointer;" title="{$smarty.const.ANNOUNCE_SET_STATUS}: {$smarty.const.ANNOUNCE_SET_STATUS_VIP_VACANCY}" alt="{$smarty.const.ANNOUNCE_SET_STATUS}: {$smarty.const.ANNOUNCE_SET_STATUS_VIP_VACANCY}">');
										break;
									case 'setHOT':
										var strTerm = (!{$smarty.const.CONF_VACANCY_HOT_THERM}) ? '<span style="font-weight: bold;">{$smarty.const.RECORD_PERMANENT}</span>' :  '{$smarty.const.SITE_UNTO}&nbsp;<span style="font-weight: bold;">{terms::calcDateTimeOfTerm({$smarty.const.CONF_VACANCY_HOT_THERM}, "{terms::dateFormatFromSmarty({$smarty.const.CONF_DATE_FORMAT}, {$smarty.const.CONF_TIME_FORMAT})}")}</span>';
										$('.short_info').find('.pHOT' + id).empty().append('{$smarty.const.ANNOUNCE_STATUS_HOT}:&nbsp;&nbsp;' + strTerm + '<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/services/resetHOT.png" name="' + id + '" class="resetHOT" style="margin-left: 10px; cursor: pointer;" title="{$smarty.const.ANNOUNCE_RESET_STATUS}: {$smarty.const.ANNOUNCE_SET_STATUS_HOT_VACANCY}" alt="{$smarty.const.ANNOUNCE_RESET_STATUS}: {$smarty.const.ANNOUNCE_SET_STATUS_HOT_VACANCY}">');
										break;
									case 'resetHOT':
										$('.short_info').find('.pHOT' + id).empty().append('{$smarty.const.ANNOUNCE_STATUS_HOT}:&nbsp;&nbsp;<span style="font-weight: bold;">{$smarty.const.SITE_NO}</span>&nbsp;<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/services/setHOT.png" name="' + id + '" class="setHOT" style="margin-left: 10px; cursor: pointer;" title="{$smarty.const.ANNOUNCE_SET_STATUS}: {$smarty.const.ANNOUNCE_SET_STATUS_HOT_VACANCY}" alt="{$smarty.const.ANNOUNCE_SET_STATUS}: {$smarty.const.ANNOUNCE_SET_STATUS_HOT_VACANCY}">');
										break;
									case 'setRate':
										var objDateTime = new Date();
										var hours = objDateTime.getHours() < 10 ? '0' + objDateTime.getHours() : objDateTime.getHours();
										var minutes = objDateTime.getMinutes() < 10 ? '0' + objDateTime.getMinutes() : objDateTime.getMinutes();
										$('.short_info').find('.pRate' + id).empty().append('{$smarty.const.ANNOUNCE_STATUS_RATE}:&nbsp;&nbsp;{$smarty.const.ANNOUNCE_RATE_DATETIME}&nbsp;<span style="font-weight: bold;">{terms::currentDateTime(terms::dateFormatFromSmarty({$smarty.const.CONF_DATE_FORMAT}))} ' + hours + ':' + minutes + '</span>&nbsp;<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/services/resetRate.png" name="' + id + '" class="resetRate" style="margin-left: 10px; cursor: pointer;" title="{$smarty.const.ANNOUNCE_RESET_STATUS_RATE_VACANCY}" alt="{$smarty.const.ANNOUNCE_RESET_STATUS_RATE_VACANCY}">&nbsp;<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/services/setRate.png" name="' + id + '" class="setRate" style="margin-left: 10px; cursor: pointer;" title="{$smarty.const.ANNOUNCE_SET_STATUS_RATE_VACANCY}" alt="{$smarty.const.ANNOUNCE_SET_STATUS_RATE_VACANCY}">');
										break;
									case 'resetRate':
										$('.short_info').find('.pRate' + id).empty().append('{$smarty.const.ANNOUNCE_STATUS_RATE}:&nbsp;&nbsp;<span style="font-weight: bold;">{$smarty.const.SITE_NO}</span>&nbsp;<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/services/setRate.png" name="' + id + '" class="setRate" style="margin-left: 10px; cursor: pointer;" title="{$smarty.const.ANNOUNCE_SET_STATUS_RATE_VACANCY}" alt="{$smarty.const.ANNOUNCE_SET_STATUS_RATE_VACANCY}">');
										break;
								}

								break;
							}

							case 'errSet':
								if (3 > ++tryCnt) {
									$.alert('{$smarty.const.ERROR_NOT_SAVE_CHANGE}');
								} else {
									$.alert('{$smarty.const.ERROR_FATAL_NOT_SAVE_CHANGE}');
									window.location.reload();
								}

								break;

							case 'errParams':
								$.alert('{$smarty.const.ERROR_FATAL_UNCORRECT_PARAMS}');
								window.location.reload();

								break;

							default:
								$.alert('{$smarty.const.ERROR_UNDEFINED}');
								window.location.reload();

								break;
						}
					}
			});
		}
	});

	//включаем все переключатели в таблице
	$('.checked_all').click(function() {
		(!$(this).is(':checked')) ? $('.checkbox_entry').removeAttr('checked') : $('.checkbox_entry').attr('checked', 'checked');
	});

	// проверяем выбранное действие
	$('form:last').submit(function() {
		var action = $('select[name="arrVacData[action]"] option:selected').val();
		if (!action) {
			$.alert('{$smarty.const.ERROR_NOT_SELECT_ACTION}');
			return false;
		} else if (!$('.checkbox_entry:checked').size()) {
			$.alert('{$smarty.const.MESSAGE_WARNING_NOT_SELECT_RECORDS}');
			return false;
		} else {
			return ('deleted' === action) ? confirm('{$smarty.const.MESSAGE_DELETE_RECORDS}') : true;
		}
	});
});
-->
</script>
{/if}

{* Диалоговое окно - Редактирование Вакансии *}
<div id="editVacancy" title="Редактирование Вакансии" style="display: none;">
	<div id="editForm"></div>
</div>

{* Диалоговое окно - Сообщение об успешном завершении операции *}
<div id="messSuccess" title="{$smarty.const.MESSAGE_ACTION_SUCCESS}!" style="display: none;">
	<div class="ui-dialog-content">
		<div style="font-weight: bold;">
			<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/icons/yes.png" style="margin: 0px 10px; vertical-align: bottom; float: left;" alt="">
			<span id="messSuccessTitle">{$smarty.const.MESSAGE_CHANGE_SAVED}</span>
		</div>
	</div>
</div>

<script type="text/javascript">
<!--
$(document).ready(function() {
	$('#editVacancy').dialog({
		autoOpen: false,
		modal: true,
		width: 800,
		height: 600,
		buttons: {
			'{$smarty.const.FORM_BUTTON_SAVE}': function() {
				var form = $('#editForm').find('form');
				if ('1' === '{$smarty.const.CONF_USE_VISUAL_EDITOR}' && '1' === '{$smarty.const.CONF_ANNOUNCE_USE_VISUAL_EDITOR}') {
					for (edId in tinyMCE.editors) {
						tinyMCE.editors[edId].save();
					}
				}
				$.ajax({
					type: "POST",
					url: '/admajax.php?action=editAnnounce&save',
					data: 'typeAnnounce=vacancy&id=' + $('#editForm').data('id') + '&' + form.serialize(),
					success: function(msg){
						if ('success' == msg) {
							$('#editVacancy').dialog('close');
							$('#messSuccess').dialog('open');
						} else {
							$.alert('{$smarty.const.MESSAGE_CHANGE_NOT_SAVED}');
						}
					}
				});
			},
			'{$smarty.const.SITE_CLOSE}': function() {
				$('#editForm').empty();
				$(this).dialog('close');
			}
		},
		close: function() {
			$(this).dialog('option', { beforeClose: function() { } });
		}
	});

	$('.announce_edit').click(function() {
		$('#overlay, #dialog').show();
		currAnnId = $(this).data('id');
		$.ajax({
			type: "POST",
			url: '/admajax.php?action=editAnnounce',
			data: 'typeAnnounce=vacancy&id=' + $(this).data('id'),
			success: function(msg){
				if ('errAnnounceNotExists' == msg) {
					$('#editVacancy').dialog('close');
					$.alert('{$smarty.const.ERROR_FATAL_UNCORRECT_PARAMS}');
					window.location.reload();
				} else {
					$('#editForm').append(msg).data({ id: currAnnId });
					$('#editVacancy').dialog('open').parent().hide().delay(100).fadeIn('fast');
				}
				$('#overlay, #dialog').hide();
			}
		});
	});

	$('#messSuccess').dialog({
		autoOpen: false,
		modal: true,
		draggable: false,
		resizable: false,
		buttons: {
			'{$smarty.const.SITE_CLOSE}': function() {
				$(this).dialog('close');
			}
		},
		beforeClose: function() {
			window.location.reload();
		}
	});
});
-->
</script>