{* Вывод ошибок *}
{if $errors}
	{include file="adm.errors.message.tpl"}
{/if}
{* Модерация Резюме *}
{if $action.moderate}
	{include file="adm.announces.resumes.moderate.tpl"}
{* Резюме ожидающие активации *}
{elseif $action.new}
	{include file="adm.announces.resumes.new.tpl"}
{* Резюме ожидающие оплату *}
{elseif $action.payment}
	{include file="adm.announces.resumes.payment.tpl"}
{* Резюме ожидающие исправления *}
{elseif $action.correction}
	{include file="adm.announces.resumes.correction.tpl"}
{* Резюме в архиве*}
{elseif $action.archived}
	{include file="adm.announces.resumes.archived.tpl"}
{* Список Резюме *}
{else}
	<form action="{$smarty.const.CONF_ADMIN_FILE}?m=announces&amp;s=resumes" method="post" enctype="multipart/form-data">
		<table style="width: 100%; border: 0px;" cellspacing="5" cellpadding="3">
			<thead class="data_head">
				<tr>
					{if $return_data}
						<td>
							{$smarty.const.MENU_ANNOUNCES_RESUMES}:&nbsp;{$smarty.const.ANNOUNCE_TOKEN_ACTIVE}
							{if $arrSort}
								<span style="float: right; padding: 0px 5px;">
									<a href="{$smarty.const.CONF_ADMIN_FILE}?m=announces&amp;s=resumes{$strFilter}"><img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/icons/unsort.png" alt="{$smarty.const.ANNOUNCE_SORT_OFF}" title="{$smarty.const.ANNOUNCE_SORT_OFF}"></a>
								</span>
							{/if}
						</td>
						<td style="width: 5%;"><input type="checkbox" class="checked_all"></td>
					{else}
						<td>{$smarty.const.MENU_ANNOUNCES_RESUMES}:&nbsp;{if $action.template}{$smarty.const.ANNOUNCE_TOKEN_TEMPLATE}{else}{$smarty.const.ANNOUNCE_TOKEN_ACTIVE}{/if}</td>
						<td style="width: 5%;"><input type="checkbox" disabled="disabled"></td>
					{/if}
				</tr>
			</thead>
	{if $return_data}
		<tbody style="background-color: #FFFFCC;">
			{foreach from=$return_data item="resume" name="resume"}
				<tr>
					<td>
						<table style="width: 100%; border: 1px dashed #DA6969; padding: 10px;" cellpadding="2" cellspacing="2">
							<thead>
								<tr>
                                    {if $resume.image}
                                        <td style="vertical-align: middle; padding: 5px;">
                                            <img src="{$smarty.const.CONF_SCRIPT_URL}uploads/images/photos/{$resume.image}" alt="" title="">
                                        </td>
                                    {/if}
									<td style="width: 50%;">
										<p>
											{$smarty.const.FORM_RESUMES_HEAD}:&nbsp;
											<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/actions/edit.png" data-id="{$resume.id}" class="announce_edit" alt="{$smarty.const.EDIT_RESUME_HEAD}: {$resume.title|escape}" title="{$smarty.const.EDIT_RESUME_HEAD}: {$resume.title|escape}" style="cursor: pointer;">&nbsp;
											<span id="res_{$resume.id}" class="announce_detail" style="color: #CC3333; cursor: pointer; font-weight: bold;" title="{$smarty.const.FORM_VIEW_ANNOUNCE_HEAD}: {$resume.title|escape}">{$resume.title|truncate:200:'...'}</span>
										</p>
										<p>
											{$smarty.const.ANNOUNCE_CONTACTS_EMAIL}:&nbsp;
											{if $arrFilter.filter[0] eq 'email'}
												{capture name='filter'}{/capture}
												{capture name='const'}{$smarty.const.ANNOUNCE_FILTER_OFF}{/capture}
												{capture name='image'}unfilter.png{/capture}
											{else}
												{capture name='filter'}&amp;filter=email&amp;in={$resume.email}{/capture}
												{capture name='const'}{$smarty.const.ANNOUNCE_FILTER_ON}{/capture}
												{capture name='image'}filter.png{/capture}
											{/if}
											<a href="{$smarty.const.CONF_ADMIN_FILE}?m=announces&amp;s=resumes{$smarty.capture.filter}{$strSort}"><img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/icons/{$smarty.capture.image}" alt="{$smarty.capture.const}" title="{$smarty.capture.const}: {$resume.email}"></a>
											<b>{$resume.email}</b>
										</p>
										<p class="p_name">
											<span style="font-weight: normal;">{$smarty.const.ANNOUNCE_VISIBILITY_HEAD}:</span>
											<img class="editVisibility" src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/icons/edit.png" alt="{$smarty.const.FORM_ACTION_EDIT_VISIBILITY}" title="{$smarty.const.FORM_ACTION_EDIT_VISIBILITY}">
											<span class="visibility">{$arrVisibility[$resume.visibility]}</span>
											<span style="display: none;">
												<br><br>
												<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/actions/closeButtonWin.png" class="cancelEditVisibility" alt="{$smarty.const.SITE_CANCEL}" title="{$smarty.const.SITE_CANCEL}" style="vertical-align: bottom;">
												<select class="selectVisibility">
													{foreach from=$arrVisibility item="visibility" key="index"}
														<option value="{$index}"{if $index eq $resume.visibility} selected="selected"{/if}>{$visibility}</option>
													{/foreach}
												</select>
												<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/icons/yes.png" class="doEditVisibility" data-id="{$resume.id}" alt="{$smarty.const.FORM_ACTION_EDIT_VISIBILITY}" title="{$smarty.const.FORM_ACTION_EDIT_VISIBILITY}" style="display: none;">
											</span>
										</p>
									</td>
									<td class="short_info" style="width: 50%;">
										<p>
											{$smarty.const.ANNOUNCE_SUBCRIPTION}:&nbsp;
											{if $resume.subscription}
												<span style="font-weight: bold;">{$smarty.const.SITE_ISSET}</span>
											{else}
												<span style="font-weight: bold;">{$smarty.const.SITE_NO}</span>
											{/if}
										</p>
										<p class="pVIP{$resume.id}">
											{$smarty.const.ANNOUNCE_STATUS_VIP}:&nbsp;
											{if $resume.vip && '0000-00-00 00:00:00' neq $resume.vip_unset_datetime}
												{$smarty.const.SITE_UNTO}&nbsp;<span style="font-weight: bold;">{$resume.vip_unset_datetime|date_format:$smarty.const.CONF_DATE_FORMAT}&nbsp;{$resume.vip_unset_datetime|date_format:$smarty.const.CONF_TIME_FORMAT}</span>
												<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/services/resetVIP.png" name="{$resume.id}" class="resetVIP" style="margin-left: 10px; cursor: pointer;" title="{$smarty.const.ANNOUNCE_RESET_STATUS}: {$smarty.const.ANNOUNCE_SET_STATUS_VIP_RESUME}" alt="{$smarty.const.ANNOUNCE_RESET_STATUS}: {$smarty.const.ANNOUNCE_SET_STATUS_VIP_RESUME}">
											{elseif $resume.vip}
												<span style="font-weight: bold;">{$smarty.const.RECORD_PERMANENT}</span>
												<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/services/resetVIP.png" name="{$resume.id}" class="resetVIP" style="margin-left: 10px; cursor: pointer;" title="{$smarty.const.ANNOUNCE_RESET_STATUS}: {$smarty.const.ANNOUNCE_SET_STATUS_VIP_RESUME}" alt="{$smarty.const.ANNOUNCE_RESET_STATUS}: {$smarty.const.ANNOUNCE_SET_STATUS_VIP_RESUME}">
											{else}
												<span style="font-weight: bold;">{$smarty.const.SITE_NO}</span>
												<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/services/setVIP.png" name="{$resume.id}" class="setVIP" style="margin-left: 10px; cursor: pointer;" title="{$smarty.const.ANNOUNCE_SET_STATUS}: {$smarty.const.ANNOUNCE_SET_STATUS_VIP_RESUME}" alt="{$smarty.const.ANNOUNCE_SET_STATUS}: {$smarty.const.ANNOUNCE_SET_STATUS_VIP_RESUME}">
											{/if}
										</p>
										<p class="pHOT{$resume.id}">
											{$smarty.const.ANNOUNCE_STATUS_HOT}:&nbsp;
											{if $resume.hot && '0000-00-00 00:00:00' neq $resume.hot_unset_datetime}
												{$smarty.const.SITE_UNTO}&nbsp;<span style="font-weight: bold;">{$resume.hot_unset_datetime|date_format:$smarty.const.CONF_DATE_FORMAT}&nbsp;{$resume.hot_unset_datetime|date_format:$smarty.const.CONF_TIME_FORMAT}</span>
												<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/services/resetHOT.png" name="{$resume.id}" class="resetHOT" style="margin-left: 10px; cursor: pointer;" title="{$smarty.const.ANNOUNCE_RESET_STATUS}: {$smarty.const.ANNOUNCE_SET_STATUS_HOT_RESUME}" alt="{$smarty.const.ANNOUNCE_RESET_STATUS}: {$smarty.const.ANNOUNCE_SET_STATUS_HOT_RESUME}">
											{elseif $resume.hot}
												<span style="font-weight: bold;">{$smarty.const.RECORD_PERMANENT}</span>
												<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/services/resetHOT.png" name="{$resume.id}" class="resetHOT" style="margin-left: 10px; cursor: pointer;" title="{$smarty.const.ANNOUNCE_RESET_STATUS}: {$smarty.const.ANNOUNCE_SET_STATUS_HOT_RESUME}" alt="{$smarty.const.ANNOUNCE_RESET_STATUS}: {$smarty.const.ANNOUNCE_SET_STATUS_HOT_RESUME}">
											{else}
												<span style="font-weight: bold;">{$smarty.const.SITE_NO}</span>
												<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/services/setHOT.png" name="{$resume.id}" class="setHOT" style="margin-left: 10px; cursor: pointer;" title="{$smarty.const.ANNOUNCE_SET_STATUS}: {$smarty.const.ANNOUNCE_SET_STATUS_HOT_RESUME}" alt="{$smarty.const.ANNOUNCE_SET_STATUS}: {$smarty.const.ANNOUNCE_SET_STATUS_HOT_RESUME}">
											{/if}
										</p>
										<p class="pRate{$resume.id}" style="white-space: nowrap;">
											{$smarty.const.ANNOUNCE_STATUS_RATE}:&nbsp;
											{if $resume.rate neq '0000-00-00 00:00:00'}
												{$smarty.const.ANNOUNCE_RATE_DATETIME}&nbsp;
												<span style="font-weight: bold;">{$resume.rate|date_format:$smarty.const.CONF_DATE_FORMAT}&nbsp;{$resume.rate|date_format:$smarty.const.CONF_TIME_FORMAT}</span>
												<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/services/resetRate.png" name="{$resume.id}" class="resetRate" style="margin-left: 10px; cursor: pointer;" title="{$smarty.const.ANNOUNCE_RESET_STATUS_RATE_RESUME}" alt="{$smarty.const.ANNOUNCE_RESET_STATUS_RATE_RESUME}">
											{else}
												<span style="font-weight: bold;">{$smarty.const.SITE_NO}</span>
											{/if}
											<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/services/setRate.png" name="{$resume.id}" class="setRate" style="margin-left: 10px; cursor: pointer;" title="{$smarty.const.ANNOUNCE_SET_STATUS_RATE_RESUME}" alt="{$smarty.const.ANNOUNCE_SET_STATUS_RATE_RESUME}">
										</p>
										<p>{$smarty.const.ANNOUNCE_COUNT_VIEWS}:&nbsp;<span style="font-weight: bold;">{$resume.cnt_views_total}</span></p>
									</td>
								</tr>
							</thead>
							<tbody>
								<tr>
                                    <td style="width: 50%;"{if $resume.image} colspan="2"{/if}>
										<p class="p_name">{$smarty.const.ANNOUNCE_SELECT_REGION}:</p>
										<p class="p_bold">
											{if $arrFilter.filter[0] eq 'id_region'}
												{capture name='filter'}{/capture}
												{capture name='const'}{$smarty.const.ANNOUNCE_FILTER_OFF}{/capture}
												{capture name='image'}unfilter.png{/capture}
											{else}
												{capture name='filter'}&amp;filter=id_region&amp;in={$resume.id_region}{/capture}
												{capture name='const'}{$smarty.const.ANNOUNCE_FILTER_ON}{/capture}
												{capture name='image'}filter.png{/capture}
											{/if}
											<a href="{$smarty.const.CONF_ADMIN_FILE}?m=announces&amp;s=resumes{$smarty.capture.filter}{$strSort}"><img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/icons/{$smarty.capture.image}" alt="{$smarty.capture.const}" title="{$smarty.capture.const}: {$regions[$resume.id_region].name|escape}"></a>
											{$regions[$resume.id_region].name|escape}
										</p>
									</td>
									<td style="width: 50%;">
										<p class="p_name">{$smarty.const.ANNOUNCE_SELECT_CITY}:</p>
										<p class="p_bold">
											{if $arrFilter.filter[0] eq 'id_city'}
												{capture name='filter'}{/capture}
												{capture name='const'}{$smarty.const.ANNOUNCE_FILTER_OFF}{/capture}
												{capture name='image'}unfilter.png{/capture}
											{else}
												{capture name='filter'}&amp;filter=id_city&amp;in={$resume.id_city}{/capture}
												{capture name='const'}{$smarty.const.ANNOUNCE_FILTER_ON}{/capture}
												{capture name='image'}filter.png{/capture}
											{/if}
											<a href="{$smarty.const.CONF_ADMIN_FILE}?m=announces&amp;s=resumes{$smarty.capture.filter}{$strSort}"><img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/icons/{$smarty.capture.image}" alt="{$smarty.capture.const}" title="{$smarty.capture.const}: {$citys[$resume.id_city].name|escape}"></a>
											{$citys[$resume.id_city].name|escape}
										</p>
									</td>
								</tr>
								<tr>
                                    <td style="width: 50%;"{if $resume.image} colspan="2"{/if}>
										<p class="p_name">{$smarty.const.ANNOUNCE_SELECT_SECTION}:</p>
										<p class="p_bold">
											{if $arrFilter.filter[0] eq 'id_section'}
												{capture name='filter'}{/capture}
												{capture name='const'}{$smarty.const.ANNOUNCE_FILTER_OFF}{/capture}
												{capture name='image'}unfilter.png{/capture}
											{else}
												{capture name='filter'}&amp;filter=id_section&amp;in={$resume.id_section}{/capture}
												{capture name='const'}{$smarty.const.ANNOUNCE_FILTER_ON}{/capture}
												{capture name='image'}filter.png{/capture}
											{/if}
											<a href="{$smarty.const.CONF_ADMIN_FILE}?m=announces&amp;s=resumes{$smarty.capture.filter}{$strSort}"><img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/icons/{$smarty.capture.image}" alt="{$smarty.capture.const}" title="{$smarty.capture.const}: {$sections[$resume.id_section].name}"></a>
											{$sections[$resume.id_section].name}
										</p>
									</td>
									<td style="width: 50%;">
										<p class="p_name">{$smarty.const.ANNOUNCE_SELECT_PROFESSION}:</p>
										<p class="p_bold">
											{if $arrFilter.in eq $resume.id_profession}
												{capture name='filter'}{/capture}
												{capture name='const'}{$smarty.const.ANNOUNCE_FILTER_OFF}{/capture}
												{capture name='image'}unfilter.png{/capture}
											{else}
												{capture name='filter'}&amp;filter=id_profession,id_profession_1,id_profession_2&amp;in={$resume.id_profession}{/capture}
												{capture name='const'}{$smarty.const.ANNOUNCE_FILTER_ON}{/capture}
												{capture name='image'}filter.png{/capture}
											{/if}
											<a href="{$smarty.const.CONF_ADMIN_FILE}?m=announces&amp;s=resumes{$smarty.capture.filter}{$strSort}"><img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/icons/{$smarty.capture.image}" alt="{$smarty.capture.const}" title="{$smarty.capture.const}: {$professions[$resume.id_profession].name}"></a>
											{$professions[$resume.id_profession].name}
										</p>
										{if $resume.id_profession_1}
											<p class="p_bold">
												{if $arrFilter.in eq $resume.id_profession_1}
													{capture name='filter'}{/capture}
													{capture name='const'}{$smarty.const.ANNOUNCE_FILTER_OFF}{/capture}
													{capture name='image'}unfilter.png{/capture}
												{else}
													{capture name='filter'}&amp;filter=id_profession,id_profession_1,id_profession_2&amp;in={$resume.id_profession_1}{/capture}
													{capture name='const'}{$smarty.const.ANNOUNCE_FILTER_ON}{/capture}
													{capture name='image'}filter.png{/capture}
												{/if}
												<a href="{$smarty.const.CONF_ADMIN_FILE}?m=announces&amp;s=resumes{$smarty.capture.filter}{$strSort}"><img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/icons/{$smarty.capture.image}" alt="{$smarty.capture.const}" title="{$smarty.capture.const}: {$professions[$resume.id_profession_1].name}"></a>
												{$professions[$resume.id_profession_1].name}
											</p>
										{/if}
										{if $resume.id_profession_2}
											<p class="p_bold">
												{if $arrFilter.in eq $resume.id_profession_2}
													{capture name='filter'}{/capture}
													{capture name='const'}{$smarty.const.ANNOUNCE_FILTER_OFF}{/capture}
													{capture name='image'}unfilter.png{/capture}
												{else}
													{capture name='filter'}&amp;filter=id_profession,id_profession_1,id_profession_2&amp;in={$resume.id_profession_2}{/capture}
													{capture name='const'}{$smarty.const.ANNOUNCE_FILTER_ON}{/capture}
													{capture name='image'}filter.png{/capture}
												{/if}
												<a href="{$smarty.const.CONF_ADMIN_FILE}?m=announces&amp;s=resumes{$smarty.capture.filter}{$strSort}"><img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/icons/{$smarty.capture.image}" alt="{$smarty.capture.const}" title="{$smarty.capture.const}: {$professions[$resume.id_profession_2].name}"></a>
												{$professions[$resume.id_profession_2].name}
											</p>
										{/if}
									</td>
								</tr>
								<tr>
									<td style="width: 50%;"{if $resume.image} colspan="2"{/if}>
										{$smarty.const.ANNOUNCE_ACTIVATE_DATETIME}:&nbsp;
										{if $arrSort.order neq 'act_datetime' || ($arrSort.order eq 'act_datetime' && $arrSort.by neq 'DESC')}<a href="{$smarty.const.CONF_ADMIN_FILE}?m=announces&amp;s=resumes{$strFilter}&amp;order=act_datetime&amp;by=DESC"><img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/icons/sort_down.gif" alt="{$smarty.const.ANNOUNCE_SORT_DOWN}" title="{$smarty.const.ANNOUNCE_SORT_DOWN}"></a>{/if}
										<b>{$resume.act_datetime|date_format:$smarty.const.CONF_DATE_FORMAT}</b>
										{if $arrSort.order neq 'act_datetime' || ($arrSort.order eq 'act_datetime' && $arrSort.by neq 'ASC')}<a href="{$smarty.const.CONF_ADMIN_FILE}?m=announces&amp;s=resumes{$strFilter}&amp;order=act_datetime&amp;by=ASC"><img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/icons/sort_up.gif" alt="{$smarty.const.ANNOUNCE_SORT_UP}" title="{$smarty.const.ANNOUNCE_SORT_UP}"></a>{/if}
									</td>
									<td style="width: 50%;">
										{$smarty.const.ANNOUNCE_DEACTIVATE_DATETIME}:&nbsp;
										{if $arrSort.order neq 'token_datetime' || ($arrSort.order eq 'token_datetime' && $arrSort.by neq 'DESC')}<a href="{$smarty.const.CONF_ADMIN_FILE}?m=announces&amp;s=resumes{$strFilter}&amp;order=token_datetime&amp;by=DESC"><img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/icons/sort_down.gif" alt="{$smarty.const.ANNOUNCE_SORT_DOWN}" title="{$smarty.const.ANNOUNCE_SORT_DOWN}"></a>{/if}
										<b>{$resume.token_datetime|date_format:$smarty.const.CONF_DATE_FORMAT}</b>
										{if $arrSort.order neq 'token_datetime' || ($arrSort.order eq 'token_datetime' && $arrSort.by neq 'ASC')}<a href="{$smarty.const.CONF_ADMIN_FILE}?m=announces&amp;s=resumes{$strFilter}&amp;order=token_datetime&amp;by=ASC"><img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/icons/sort_up.gif" alt="{$smarty.const.ANNOUNCE_SORT_UP}" title="{$smarty.const.ANNOUNCE_SORT_UP}"></a>{/if}
									</td>
								</tr>
							</tbody>
						</table>
					</td>
					<td style="text-align: center; width: 5%;">
						<input type="checkbox" name="arrResData[id][{$resume.id}]" class="checkbox_entry">
						<div style="display: none;">
							<div id="openres_{$resume.id}">{include file="adm.announces.resume.detail.tpl"}</div>
						</div>
					</td>
				</tr>
			{/foreach}
		</tbody>
			<tfoot class="data_foot">
				<tr>
					<td colspan="2" style="text-align: center;">
						{$smarty.const.TABLE_RECORDS}&nbsp;{$smarty.foreach.resume.total}/{$allRecords}
						<span style="float: right;">
							<select name="arrResData[action]" class="select">
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
				data: 'annType=resume&id=' + id,
				success: function(msg){
					$('#overlay, #dialog').hide();
					switch (msg) {
						case 'success':
						{
							switch (currAction.attr('class')) {
								case 'setVIP':
									var strTerm = (!{$smarty.const.CONF_RESUME_VIP_THERM}) ? '<span style="font-weight: bold;">{$smarty.const.RECORD_PERMANENT}</span>' :  '{$smarty.const.SITE_UNTO}&nbsp;<span style="font-weight: bold;">{terms::calcDateTimeOfTerm({$smarty.const.CONF_RESUME_VIP_THERM}, "{terms::dateFormatFromSmarty({$smarty.const.CONF_DATE_FORMAT}, {$smarty.const.CONF_TIME_FORMAT})}")}</span>';
									$('.short_info').find('.pVIP' + id).empty().append('{$smarty.const.ANNOUNCE_STATUS_VIP}:&nbsp;&nbsp;' + strTerm + '&nbsp;<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/services/resetVIP.png" name="' + id + '" class="resetVIP" style="margin-left: 10px; cursor: pointer;" title="{$smarty.const.ANNOUNCE_RESET_STATUS}: {$smarty.const.ANNOUNCE_SET_STATUS_VIP_RESUME}" alt="{$smarty.const.ANNOUNCE_RESET_STATUS}: {$smarty.const.ANNOUNCE_SET_STATUS_VIP_RESUME}">');
									break;
								case 'resetVIP':
									$('.short_info').find('.pVIP' + id).empty().append('{$smarty.const.ANNOUNCE_STATUS_VIP}:&nbsp;&nbsp;<span style="font-weight: bold;">{$smarty.const.SITE_NO}</span>&nbsp;<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/services/setVIP.png" name="' + id + '" class="setVIP" style="margin-left: 10px; cursor: pointer;" title="{$smarty.const.ANNOUNCE_SET_STATUS}: {$smarty.const.ANNOUNCE_SET_STATUS_VIP_RESUME}" alt="{$smarty.const.ANNOUNCE_SET_STATUS}: {$smarty.const.ANNOUNCE_SET_STATUS_VIP_RESUME}">');
									break;
								case 'setHOT':
									var strTerm = (!{$smarty.const.CONF_RESUME_HOT_THERM}) ? '<span style="font-weight: bold;">{$smarty.const.RECORD_PERMANENT}</span>' :  '{$smarty.const.SITE_UNTO}&nbsp;<span style="font-weight: bold;">{terms::calcDateTimeOfTerm({$smarty.const.CONF_RESUME_HOT_THERM}, "{terms::dateFormatFromSmarty({$smarty.const.CONF_DATE_FORMAT}, {$smarty.const.CONF_TIME_FORMAT})}")}</span>';
									$('.short_info').find('.pHOT' + id).empty().append('{$smarty.const.ANNOUNCE_STATUS_HOT}:&nbsp;&nbsp;' + strTerm + '<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/services/resetHOT.png" name="' + id + '" class="resetHOT" style="margin-left: 10px; cursor: pointer;" title="{$smarty.const.ANNOUNCE_RESET_STATUS}: {$smarty.const.ANNOUNCE_SET_STATUS_HOT_RESUME}" alt="{$smarty.const.ANNOUNCE_RESET_STATUS}: {$smarty.const.ANNOUNCE_SET_STATUS_HOT_RESUME}">');
									break;
								case 'resetHOT':
									$('.short_info').find('.pHOT' + id).empty().append('{$smarty.const.ANNOUNCE_STATUS_HOT}:&nbsp;&nbsp;<span style="font-weight: bold;">{$smarty.const.SITE_NO}</span>&nbsp;<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/services/setHOT.png" name="' + id + '" class="setHOT" style="margin-left: 10px; cursor: pointer;" title="{$smarty.const.ANNOUNCE_SET_STATUS}: {$smarty.const.ANNOUNCE_SET_STATUS_HOT_RESUME}" alt="{$smarty.const.ANNOUNCE_SET_STATUS}: {$smarty.const.ANNOUNCE_SET_STATUS_HOT_RESUME}">');
									break;
								case 'setRate':
									var objDateTime = new Date();
									var hours = objDateTime.getHours() < 10 ? '0' + objDateTime.getHours() : objDateTime.getHours();
									var minutes = objDateTime.getMinutes() < 10 ? '0' + objDateTime.getMinutes() : objDateTime.getMinutes();
									$('.short_info').find('.pRate' + id).empty().append('{$smarty.const.ANNOUNCE_STATUS_RATE}:&nbsp;&nbsp;{$smarty.const.ANNOUNCE_RATE_DATETIME}&nbsp;<span style="font-weight: bold;">{terms::currentDateTime(terms::dateFormatFromSmarty({$smarty.const.CONF_DATE_FORMAT}))} ' + hours + ':' + minutes + '</span>&nbsp;<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/services/resetRate.png" name="' + id + '" class="resetRate" style="margin-left: 10px; cursor: pointer;" title="{$smarty.const.ANNOUNCE_RESET_STATUS_RATE_RESUME}" alt="{$smarty.const.ANNOUNCE_RESET_STATUS_RATE_RESUME}">&nbsp;<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/services/setRate.png" name="' + id + '" class="setRate" style="margin-left: 10px; cursor: pointer;" title="{$smarty.const.ANNOUNCE_SET_STATUS_RATE_RESUME}" alt="{$smarty.const.ANNOUNCE_SET_STATUS_RATE_RESUME}">');
									break;
								case 'resetRate':
									$('.short_info').find('.pRate' + id).empty().append('{$smarty.const.ANNOUNCE_STATUS_RATE}:&nbsp;&nbsp;<span style="font-weight: bold;">{$smarty.const.SITE_NO}</span>&nbsp;<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/services/setRate.png" name="' + id + '" class="setRate" style="margin-left: 10px; cursor: pointer;" title="{$smarty.const.ANNOUNCE_SET_STATUS_RATE_RESUME}" alt="{$smarty.const.ANNOUNCE_SET_STATUS_RATE_RESUME}">');
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

	// кнопка - редактирование свойства "Тип размещения"
	$('.editVisibility').css({ cursor: 'pointer' }).click(function() {
		$(this).hide().next().hide().next().show();
	});
	// кнопка - отмена редактирования свойства "Тип размещения"
	$('.cancelEditVisibility').css({ cursor: 'pointer' }).click(function() {
		$(this).parent().hide().prev().show().prev().show();
	});
	// обработка селекта редактирования свойства "Тип размещения"
	$('.selectVisibility').each(function () {
		$(this).data('currVal', $(this).val());
	}).change(function() {
		($(this).data('currVal') != $(this).val()) ? $(this).next().show() : $(this).next().hide();
	});
	// сохранение свойства "Тип размещения"
	$('.doEditVisibility').css({ cursor: 'pointer' }).click(function() {
		$('#overlay, #dialog').show();
		var pSelector = $(this).parent();
        var newVal = $(this).prev().val();
		$.ajax({
			type: "POST",
			url: '/admajax.php?action=editVisibility',
			data: 'visibility=' + newVal + '&id=' + $(this).data('id'),
			success: function(msg){
				if ('success' == msg) {
					pSelector.hide().prev().text(pSelector.find('select option:selected').text()).show().prev().show();
					pSelector.find('select').data('currVal', newVal).next().hide();
				} else {
					$.alert('{$smarty.const.ERROR_NOT_SAVE_CHANGE}');
				}
				$('#overlay, #dialog').hide();
			}
		});
	});

	//включаем все переключатели в таблице
	$('.checked_all').click(function() {
		(!$(this).is(':checked')) ? $('.checkbox_entry').removeAttr('checked') : $('.checkbox_entry').attr('checked', 'checked');
	});

	// проверяем выбранное действие
	$('form:last').submit(function() {
		var action = $('select[name="arrResData[action]"] option:selected').val();
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

{* Диалоговое окно - Редактирование Резюме *}
<div id="editResume" title="Редактирование Резюме" style="display: none;">
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
	$('#editResume').dialog({
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
					data: 'typeAnnounce=resume&id=' + $('#editForm').data('id') + '&' + form.serialize(),
					success: function(msg) {
						if ('success' == msg) {
							$('#editResume').dialog('close');
							$('#messSuccess').dialog('open');
						} else {
							$.alert('{$smarty.const.MESSAGE_CHANGE_NOT_SAVED}');
						}
					}
				});
			},
			'{$smarty.const.SITE_CLOSE}': function() {
				window.location.reload();
			}
		}
	});

	$('.announce_edit').click(function() {
		$('#overlay, #dialog').show();
		currAnnId = $(this).data('id');
		$.ajax({
			type: "POST",
			url: '/admajax.php?action=editAnnounce',
			data: 'typeAnnounce=resume&id=' + $(this).data('id'),
			success: function(msg){
				if ('errAnnounceNotExists' == msg) {
					$('#editResume').dialog('close');
					$.alert('{$smarty.const.ERROR_FATAL_UNCORRECT_PARAMS}');
					window.location.reload();
				} else {
					$('#editForm').html(msg).data({ id: currAnnId });
					$('#editResume').dialog('open').parent().hide().delay(100).fadeIn('fast').find('.ui-dialog-titlebar-close').hide();
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

	$(window).unload(function() {
		var delUploadedFile = $(window).data('delUploadedFile');
		if (delUploadedFile) {
			$.post('/admajax.php?uploadFile&action=delUploaded', { 'delUploadedFile': delUploadedFile });
		}
	});
});
-->
</script>