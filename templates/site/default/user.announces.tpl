{if $errors}
	{include file="errors.message.tpl"}
{/if}
<form action="{$chpu->createChpuUrl("`$smarty.const.CONF_SCRIPT_URL`index.php?ut=$user_type&amp;do=user.announces&amp;action=$action&amp;token=$token")}" method="post" enctype="multipart/form-data">
	<div class="DesignMainPageBody">
		<table class="mainBodyTable" cellspacing="0" style="table-layout:fixed;">
            <tr>
			{if $return_data}
				<th colspan="4">{$smarty.const.FORM_ANNOUNCE_LIST}&nbsp;{$strTableHead}</th>
				{if 'active' eq $token || 'archived' eq $token || ($token neq 'moderate' && $codex.rights["del_$action"])}
					<th style="width: 5%; text-align: center; padding: 5px 0px;"><input type="checkbox" class="checked_all"></th>
				{/if}
			</tr>
			{foreach from=$return_data item="announce" name="announce"}
				<tr class="tr_hover" id="ann_{$announce.id}" title="{$smarty.const.FORM_VIEW_ANNOUNCE_HEAD}: {$announce.title|escape}, {$sections[$announce.id_section].name}, {$regions[$announce.id_region].name|escape}{if $announce.id_city} - {$citys[$announce.id_city].name|escape}{/if}, {$announce.act_datetime|date_format:$smarty.const.CONF_DATE_FORMAT} - {$announce.token_datetime|date_format:$smarty.const.CONF_DATE_FORMAT}, {$announce.pay_from}{if $action eq 'vacancy' && $announce.pay_post}-{$announce.pay_post}{/if} {$announce.currency}">
					<td class="announce_detail">
						<strong>{$announce.title|truncate:100:'...'}</strong>
					</td>
					<td class="VRRegion announce_detail">
						{$sections[$announce.id_section].name}&nbsp;/&nbsp;{$professions[$announce.id_profession].name}
						<hr class="Design_panesDelimiter">
						{$regions[$announce.id_region].name|escape}{if $announce.id_city}&nbsp;/&nbsp;{$citys[$announce.id_city].name|escape}{/if}
					</td>
					<td class="VRDate announce_detail" style="text-align: right;">
						{if 'active' eq $announce.token}
							<div>{$smarty.const.SITE_WITH}&nbsp;{$announce.act_datetime|date_format:$smarty.const.CONF_DATE_FORMAT}&nbsp;{$announce.act_datetime|date_format:$smarty.const.CONF_TIME_FORMAT}</div>
						{elseif 'moderate' eq $announce.token}
							<div>{$smarty.const.SITE_WITH}&nbsp;{$announce.token_datetime|date_format:$smarty.const.CONF_DATE_FORMAT}&nbsp;{$announce.token_datetime|date_format:$smarty.const.CONF_TIME_FORMAT}</div>
						{/if}
						{if 'moderate' neq $announce.token}
							<div>{$smarty.const.SITE_UNTO}&nbsp;{$announce.token_datetime|date_format:$smarty.const.CONF_DATE_FORMAT}&nbsp;{$announce.token_datetime|date_format:$smarty.const.CONF_TIME_FORMAT}</div>
						{/if}
						<hr class="Design_panesDelimiter" style="margin-left: 50px;">
						<span{if $announce.storing} id="StoringAnn_{$announce.id}" title="{$smarty.const.ANNOUNCE_STORING_VIEWS_DETAIL}..." class="storingDetail"{/if}>
							{$smarty.const.ANNOUNCE_COUNT_VIEWS}: <strong>{$announce.cnt_views_total}</strong>
						</span>
					</td>
					<td class="VRSallary announce_detail{if $announce.token eq 'moderate'} last{/if}">
						{if $action eq 'vacancy' && $announce.pay_post}
							{$smarty.const.SITE_FROM}&nbsp;{$announce.pay_from}&nbsp;{$smarty.const.SITE_UNTO}&nbsp;{$announce.pay_post}
						{else}
							{$announce.pay_from}
						{/if}
						&nbsp;{$announce.currency}
					</td>
					{if 'active' eq $announce.token || 'archived' eq $announce.token || ($announce.token neq 'moderate' && $codex.rights["del_$action"])}
						<td class="last" style="cursor: default;">
							<input type="checkbox" name="arrAnnData[id][{$announce.id}]" class="checkbox_entry">
						</td>
					{/if}
				</tr>
			{/foreach}
			<tr>
				<td {if 'active' eq $token || 'archived' eq $token || ($token neq 'moderate' && $codex.rights["del_$action"])}colspan="2"{else}colspan="4" class="last"{/if} style="text-align: center; padding: 5px 0px;">
					{$smarty.const.TABLE_RECORDS}&nbsp;{$smarty.foreach.announce.total}{if $allRecords|default:false}/{$allRecords}{/if}
				</td>
				{if 'active' eq $token || 'archived' eq $token || ($token neq 'moderate' && $codex.rights["del_$action"])}
					<td colspan="3" class="last" align="right">
						<table cellspacing="0" style="table-layout:fixed;" align="right">
							<tr>
								<td>
									<select name="arrAnnData[action]" class="select">
										<option value="">{$smarty.const.FORM_ACTION_SELECT}</option>
										{if 'active' eq $token}
											<option value="archived">{$smarty.const.FORM_ACTION_ARCHIVE}</option>
										{elseif 'archived' eq $token}
											<option value="active">{$smarty.const.FORM_ACTION_ADVERTISE}</option>
										{/if}
										{if $codex.rights["del_$action"]}
											<option value="deleted">{$smarty.const.FORM_ACTION_DELETE_SELECTED}</option>
										{/if}
									</select>
								</td>
								<td>
									<div class="submitButtonLight" >
										<input type="submit" class="shadow01red" value="{$smarty.const.FORM_BUTTON_EXECUTE}">
									</div>
								</td>
							</tr>
						</table>
					</td>
				{/if}
			</tr>
			{else}
					<th>{$smarty.const.ANNOUNCES_NOISSET}</th>
				</tr>
			{/if}
		</table>
	</div>
</form>

<p>{$string_page}</p>

{if $return_data}
	{assign var="announces" value=$return_data}
	{foreach from=$announces item="return_data" name="return_data"}
		<div style="display: none;">
			<div id="openann_{$return_data.id}">
				{if 'active' eq $return_data.token}
					<p style="float: left;">
						{if $codex.rights["edit_$action"]}<a href="{$chpu->createChpuUrl("`$smarty.const.CONF_SCRIPT_URL`index.php?ut=$user_type&amp;do=$action&amp;action=edit&amp;unikey=`$return_data.unikey`")}"><img src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/actions/correction.png" style="margin: 10px;" alt="{$smarty.const.ANNOUNCE_CORRECTION}" title="{$smarty.const.ANNOUNCE_CORRECTION}"></a><br>{/if}
						{assign var="payment" value="vip_`$action`"}
						{if $arrPayments.$payment && !$return_data.vip}<a href="{$chpu->createChpuUrl("`$smarty.const.CONF_SCRIPT_URL`index.php?ut=$user_type&amp;do=$action&action=setVIP&id=`$return_data.id`")}"><img src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/services/setVIP.png" style="padding: 10px;" alt="{$smarty.const.ANNOUNCE_SET_STATUS}: {$smarty.const.ANNOUNCE_SET_STATUS_VIP}" title="{$smarty.const.ANNOUNCE_SET_STATUS}: {$smarty.const.ANNOUNCE_SET_STATUS_VIP}"></a><br>{/if}
						{assign var="payment" value="hot_`$action`"}
						{if $arrPayments.$payment && !$return_data.hot}<a href="{$chpu->createChpuUrl("`$smarty.const.CONF_SCRIPT_URL`index.php?ut=$user_type&amp;do=$action&action=setHOT&id=`$return_data.id`")}"><img src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/services/setHOT.png" style="padding: 10px;" alt="{$smarty.const.ANNOUNCE_SET_STATUS}: {$smarty.const.ANNOUNCE_SET_STATUS_HOT}" title="{$smarty.const.ANNOUNCE_SET_STATUS}: {$smarty.const.ANNOUNCE_SET_STATUS_HOT}"></a><br>{/if}
						{assign var="payment" value="rate_`$action`"}
						{if $arrPayments.$payment}<a href="{$chpu->createChpuUrl("`$smarty.const.CONF_SCRIPT_URL`index.php?ut=$user_type&amp;do=$action&action=setRate&id=`$return_data.id`")}"><img src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/services/setRate.png" style="padding: 10px;" alt="{$smarty.const.ANNOUNCE_SET_STATUS_RATE}" title="{$smarty.const.ANNOUNCE_SET_STATUS_RATE}"></a><br>{/if}
						<img class="toPrintAnnounce" data-id="{$return_data.id}" src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/services/print_32.png" style="margin: 10px; cursor: pointer;" alt="{$smarty.const.ANNOUNCE_SEND_TO_PRINT}" title="{$smarty.const.ANNOUNCE_SEND_TO_PRINT}">
					</p>
				{elseif 'payment' eq $return_data.token}
					<p style="float: left;">
						{if $codex.rights["edit_$action"]}<a href="{$chpu->createChpuUrl("`$smarty.const.CONF_SCRIPT_URL`index.php?ut=$user_type&amp;do=$action&amp;action=edit&amp;unikey=`$return_data.unikey`")}"><img src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/actions/correction.png" style="margin: 10px;" alt="{$smarty.const.ANNOUNCE_CORRECTION}" title="{$smarty.const.ANNOUNCE_CORRECTION}"></a><br>{/if}
						<a href="{$chpu->createChpuUrl("`$smarty.const.CONF_SCRIPT_URL`index.php?ut=$user_type&amp;do=$action&amp;action=payment&amp;id=`$return_data.id`")}"><img src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/services/payment.png" style="margin: 10px;" alt="{$smarty.const.ANNOUNCE_PAYMENT}" title="{$smarty.const.ANNOUNCE_PAYMENT}"></a>
					</p>
				{elseif 'correction' eq $return_data.token || ($codex.rights["edit_$action"] && 'archived' eq $return_data.token)}
					<p style="float: left;"><a href="{$chpu->createChpuUrl("`$smarty.const.CONF_SCRIPT_URL`index.php?ut=$user_type&amp;do=$action&amp;action=edit&amp;unikey=`$return_data.unikey`")}"><img src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/actions/correction.png" style="margin: 10px;" alt="{$smarty.const.ANNOUNCE_CORRECTION}" title="{$smarty.const.ANNOUNCE_CORRECTION}"></a></p>
				{/if}
				{include file="$action.view.tpl"}
				<iframe id="printAnnounce_{$return_data.id}" name="printAnnounce_{$return_data.id}" style="display: none;">
					{assign var="printTemplate" value="`$action`.print.tpl"}
					{assign var="page_title" value=''}
					{include file="announce.print.tpl"}
				</iframe>
				{if 'active' eq $token || 'archived' eq $token || ($token neq 'moderate' && $codex.rights["del_$action"])}
					<form action="{$chpu->createChpuUrl("`$smarty.const.CONF_SCRIPT_URL`index.php?ut=$user_type&amp;do=user.announces&amp;action=$action&amp;token=`$return_data.token`")}" method="post" enctype="multipart/form-data">
						<p>
							<input type="hidden" name="arrAnnData[id][{$return_data.id}]">
							{if 'active' eq $return_data.token}
								<input type="radio" name="arrAnnData[action]" value="archived" class="action" style="margin: 5px;"> {$smarty.const.FORM_ACTION_ARCHIVE}
							{elseif 'archived' eq $return_data.token}
								<input type="radio" name="arrAnnData[action]" value="active" class="action" style="margin: 5px;"> {$smarty.const.FORM_ACTION_ADVERTISE}
							{/if}
							{if $codex.rights["del_$action"]}
								<input type="radio" name="arrAnnData[action]" value="deleted" class="action" style="margin: 5px;"> {$smarty.const.FORM_ACTION_DELETE}
							{/if}
						</p>
						<p><input type="submit" value="{$smarty.const.FORM_BUTTON_EXECUTE}" class="button"></p>
					</form>
				{/if}
			</div>
			{if $return_data.storing}
				{include file="user.announces.storing.tpl"}
			{/if}
		</div>
	{/foreach}
{/if}

<script type="text/javascript">
<!--
$(document).ready(function() {
	//Подробный просмотр
	$('.announce_detail').live('click', function () {
		var targ = '#open' + $(this).parent().attr('id');
		$.fn.colorbox({ inline: true, href: targ, width: '100%', height: '100%', opacity: 0, scrolling: true });
		// отключаем горизонтальный скролл в окне colorbox (IE)
		$(targ).parent().css('overflow-x','hidden');
		// производим проверки при отправке формы
		$(targ).find('form:last').submit(function() {
			var action = $(this).find('input[name="arrAnnData[action]"]:checked').val();
			if (!action) {
				alert('{$smarty.const.ERROR_NOT_SELECT_ACTION}');
				return false;
			} else {
				return ('deleted' === action) ? confirm('{$smarty.const.MESSAGE_DELETE_RECORD}') : true;
			}
		});
	});
	// Подробные данные о просмотрах объявления
	$('.storingDetail').hover(
		function () {
			$(this).css({
				'color': '#CC0000',
				'text-decoration': 'underline'
			}).parent().toggleClass('announce_detail').unbind('click');
		},
		function () {
			$(this).css({
				'color': 'inherit',
				'text-decoration': 'none'
			}).parent().toggleClass('announce_detail');
		}
	).click(function () {
		var targ = '#open' + $(this).attr('id');
		$.fn.colorbox({
			inline: true,
			href: targ,
			width: '100%',
			height: '100%',
			opacity: 0,
			scrolling: true
		});
		// отключаем горизонтальный скролл в окне colorbox (IE)
		$(targ).parent().css('overflow-x','hidden');
	});
	//включаем все переключатели в таблице
	$('.checked_all').click(function() {
		(!$(this).is(':checked')) ? $('.checkbox_entry').removeAttr('checked') : $('.checkbox_entry').attr('checked', 'checked');
	});
	// проверяем выбранное действие
	$('form:first').submit(function() {
		var action = $('select[name="arrAnnData[action]"] option:selected').val();
		if (!action) {
			alert('{$smarty.const.ERROR_NOT_SELECT_ACTION}');
			return false;
		} else if (!$('.checkbox_entry:checked').size()) {
			alert('{$smarty.const.MESSAGE_WARNING_NOT_SELECT_RECORDS}');
			return false;
		} else {
			return ('deleted' === action) ? confirm('{$smarty.const.MESSAGE_DELETE_RECORDS}') : true;
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
		var pSelector = $(this).parent();
        var newVal = $(this).prev().val();
		$.ajax({
			type: "POST",
			url: '/ajax.php?editVisibility',
			data: 'visibility=' + newVal + '&id=' + $(this).data('id'),
			success: function(msg){
				if ('success' == msg) {
					pSelector.hide().prev().text(pSelector.find('select option:selected').text()).show().prev().show();
					pSelector.find('select').data('currVal', newVal).next().hide();
				} else {
					alert('{$smarty.const.ERROR_NOT_CHANGE_DATA}');
				}
			}
		});
	});
	// Переключатель форм просмотра/печати Объявления
	$('.toPrintAnnounce').click(function() {
	});
});
-->
</script>