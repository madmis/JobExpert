{*Вакансии ожидающие модерации*}
<form action="{$smarty.const.CONF_ADMIN_FILE}?m=announces&amp;s=vacancys&amp;action=moderate" method="post" enctype="multipart/form-data">
	<table style="width: 100%; border: 0px;" cellspacing="5" cellpadding="3">
		<thead class="data_head">
			<tr>
				{if $return_data}
					<td style="width: 65%;">
						<a href="{$smarty.const.CONF_ADMIN_FILE}?m=announces&amp;s=vacancys&amp;action=moderate&amp;order=title&amp;by={if $order.title eq 'ASC'}DESC{else}ASC{/if}" class="white" title="{if $order.title eq 'ASC'}{$smarty.const.ANNOUNCE_SORT_DOWN}{else}{$smarty.const.ANNOUNCE_SORT_UP}{/if}">
							{$smarty.const.FORM_VACANCYS_HEAD}:&nbsp;{$smarty.const.MENU_ACTION_MODERATE}
							{if $order.title eq 'ASC'}
								<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/icons/sort_down.gif" alt="{$smarty.const.ANNOUNCE_SORT_DOWN}">
							{elseif $order.title eq 'DESC'}
								<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/icons/sort_up.gif" alt="{$smarty.const.ANNOUNCE_SORT_UP}">
							{/if}
						</a>
					</td>
					<td style="width: 30%;">
						<a href="{$smarty.const.CONF_ADMIN_FILE}?m=announces&amp;s=vacancys&amp;action=moderate&amp;order=token_datetime&amp;by={if $order.token_datetime eq 'ASC'}DESC{else}ASC{/if}" class="white" title="{if $order.token_datetime eq 'ASC'}{$smarty.const.ANNOUNCE_SORT_DOWN}{else}{$smarty.const.ANNOUNCE_SORT_UP}{/if}">
							{$smarty.const.ANNOUNCE_ADDED_DATETIME}
							{if $order.token_datetime eq 'ASC'}
								<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/icons/sort_down.gif" alt="{$smarty.const.ANNOUNCE_SORT_DOWN}">
							{elseif $order.token_datetime eq 'DESC'}
								<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/icons/sort_up.gif" alt="{$smarty.const.ANNOUNCE_SORT_UP}">
							{/if}
						</a>
					</td>
					<td style="width: 5%;">{$smarty.const.TABLE_COLUMN_OPTIONS}</td>
					<td style="width: 5%;"><input type="checkbox" class="checked_all"></td>
				{else}
					<td style="width: 65%;">{$smarty.const.FORM_VACANCYS_HEAD}:&nbsp;{$smarty.const.MENU_ACTION_MODERATE}</td>
					<td style="width: 30%;">{$smarty.const.ANNOUNCE_ACTIVATE_DATETIME}</td>
					<td style="width: 5%;"><input type="checkbox" disabled="disabled"></td>
				{/if}
			</tr>
		</thead>
	{if $return_data}
		<tbody class="data_body">
			{foreach from=$return_data item="vacancy" name="vacancy"}
				<tr class="tr_hover">
					<td id="vac_{$vacancy.id}" class="announce_detail" style="width: 65%; cursor: pointer;" title="{$smarty.const.FORM_VIEW_ANNOUNCE_HEAD}: {$vacancy.title|escape}">
						<p class="p_bold p_5" style="color: #CC3333;">{$vacancy.title}</p>
					</td>
					<td style="width: 30%; text-align: center;">
						<p class="p_bold p_5">
							{$vacancy.token_datetime|date_format:$smarty.const.CONF_DATE_FORMAT}&nbsp;{$vacancy.token_datetime|date_format:$smarty.const.CONF_TIME_FORMAT}
						</p>
					</td>
					<td style="text-align: center; width: 5%;">
						<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/actions/edit.png" data-id="{$vacancy.id}" class="announce_edit" alt="{$smarty.const.EDIT_VACANCY_HEAD}: {$vacancy.title|escape}" title="{$smarty.const.EDIT_VACANCY_HEAD}: {$vacancy.title|escape}" style="cursor: pointer;">&nbsp;
					</td>
					<td style="text-align: center; width: 5%;">
						<input type="checkbox" name="arrVacData[id][{$vacancy.id}]" class="checkbox_entry">
					</td>
				</tr>
			{/foreach}
		</tbody>
		<tfoot class="data_foot">
			<tr>
				<td style="text-align: center;">{$smarty.const.TABLE_RECORDS}&nbsp;{$smarty.foreach.vacancy.total}/{$allRecords}</td>
				<td colspan="3" style="text-align: right;">
					<select name="arrVacData[action]" class="select">
						<option value="">{$smarty.const.FORM_ACTION_SELECT}</option>
						{if $payments.add_vacancy}
							<option value="payment">{$smarty.const.FORM_ACTION_PAYMENT}</option>
						{/if}
						<option value="active">{$smarty.const.FORM_ACTION_ACTIVATE_SELECTED}</option>
						<option value="deleted">{$smarty.const.FORM_ACTION_DELETE_SELECTED}</option>
					</select>
					<input type="submit" value="{$smarty.const.FORM_BUTTON_EXECUTE}" class="button" style="margin: 5px;">
				</td>
			</tr>
		</tfoot>
	{else}
		<tbody class="data_body">
			<tr>
				<td align="center" colspan="3">{$smarty.const.TABLE_NOT_DATA}</td>
			</tr>
		</tbody>
	{/if}
	</table>
</form>

{if $return_data}
	{foreach from=$return_data item="vacancy" name="vacancy"}
		<div style="display: none;">
			<div id="openvac_{$vacancy.id}">
				{include file="adm.announces.vacancys.list.tpl"}
				<hr>
				<form action="{$smarty.const.CONF_ADMIN_FILE}?m=announces&amp;s=vacancys&amp;action=moderate" method="post" enctype="multipart/form-data">
					<p>
						<input type="hidden" name="arrVacData[id][{$vacancy.id}]" value="on">
						{if $payments.add_vacancy}
							<input type="radio" name="arrVacData[action]" value="payment" checked="checked"> {$smarty.const.FORM_ACTION_PAYMENT}
						{/if}
						<input type="radio" name="arrVacData[action]" value="active"{if !$payments.add_vacancy} checked="checked"{/if}> {$smarty.const.FORM_ACTION_ACTIVATE}
						<input type="radio" name="arrVacData[action]" value="correction"> {$smarty.const.FORM_ACTION_CORRECTION}
						<input type="radio" name="arrVacData[action]" value="deleted"> {$smarty.const.FORM_ACTION_DELETE}
					</p>
					<div style="display: none;">
						<span style="display: none; color: #CC3333;" class="comments_help correction">{$smarty.const.FORM_ANNOUNCE_COMMENTS_CORRECTION}</span>
						<span style="display: none; color: #CC3333;" class="comments_help deleted">{$smarty.const.FORM_ANNOUNCE_COMMENTS_DELETE}</span>
						<p class="p_2 p_bold">{$smarty.const.FORM_ANNOUNCE_COMMENTS_MESSAGE}:</p>
						<p class="p_0"><textarea name="arrVacData[comments]" class="comments" cols="100" rows="5" style="border: 1px solid #CC3333;"></textarea></p>
					</div>
					<p><input type="submit" value="{$smarty.const.FORM_BUTTON_EXECUTE}" class="button"></p>
				</form>
			</div>
		</div>
	{/foreach}
{/if}

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

		// проверяем выбранное действие
		$(targ).find('input[name="arrVacData[action]"]').click(function() {
			var action = $(this).val();
			if ('active' !== action && 'payment' !== action) {
				$(this).parent().next().show();
				$(targ).find('.comments_help').hide().filter('.' + action).show();
				$(targ).parent().scrollTop($(targ).height()).find('.comments').focus();
			} else {
				$(this).parent().next().hide();
			}

		});

		// производим проверки при отправке формы
		$(targ).find('form').submit(function() {
			var action = $(this).find('input[name="arrVacData[action]"]:checked').val();
			if (!action) {
				$.alert('{$smarty.const.ERROR_NOT_SELECT_ACTION}');
				return false;
			} else if ('active' !== action && 'payment' !== action && !$(this).find('.comments').val()) {
				$.alert('{$smarty.const.WARNING_ACTION_USER_MESSAGE_EMPTY}');
				$(targ).find('.comments').focus();
				return false;
			} else {
				return ('deleted' === action) ? confirm('{$smarty.const.MESSAGE_DELETE_RECORD}') : true;
			}
		});
	});

	//включаем все переключатели в таблице	
	$('.checked_all').click(function() {
		(!$(this).is(':checked')) ? $('.checkbox_entry').removeAttr('checked') : $('.checkbox_entry').attr('checked', 'checked');
	});

	// проверяем выбранное действие
	$('form:first').submit(function() {
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