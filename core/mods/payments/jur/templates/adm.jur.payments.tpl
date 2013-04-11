{* ФОРМА ОТБОРА *}
<form action="{$smarty.const.CONF_ADMIN_FILE}?m=mods&amp;s=payments&amp;action=payments&amp;id=jur" method="get">
<input type="hidden" name="m" value="mods">
<input type="hidden" name="s" value="payments">
<input type="hidden" name="action" value="payments">
<input type="hidden" name="id" value="jur">
<input type="hidden" name="do" value="filter">
<table class="otbor_table">
	<thead class="otbor_head" id="payments">
		<tr><td>{$smarty.const.JUR_FILTER_FORM_HEAD}</td></tr>
	</thead>
	<tbody>
		<tr>
			<td>
				<table style="width: 100%;" class="hidden_table" id="payments_otbor">
					<tbody class="otbor_body">
						<tr>
							<td>
								{$smarty.const.JUR_TABLE_COLUMN_ORDER_ID}&nbsp;<input type="text" name="order_id" value="{$retFields.order_id}" class="text">
								<span class="colorbox_help" id="HELP_ADMIN_PATTERN_FILTER">
									<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/information.png" alt="{$smarty.const.FORM_IMG_HELP}">
								</span>
							</td>
						</tr>
					</tbody>
					<tfoot class="otbor_foot">
						<tr>
							<td colspan="2"><input type="submit" value="{$smarty.const.FORM_BUTTON_EXECUTE}" class="button"></td>
						</tr>
					</tfoot>
				</table>
			</td>
		</tr>
	</tbody>
</table>
</form> 

{* СПИСОК ОПЛАТ *}
<form class="payments" action="{$smarty.const.CONF_ADMIN_FILE}?m=mods&amp;s=payments&amp;action=payments&amp;id=jur{$filterString}" method="post">
<table style="width: 100%; border-spacing: 2px;">
	<thead class="data_head">
		<tr>
			<td>{$smarty.const.JUR_TABLE_COLUMN_ORDER_ID}</td>
			<td>{$smarty.const.JUR_TABLE_COLUMN_ACTION}</td>
			<td>{$smarty.const.JUR_TABLE_COLUMN_USER_ID}</td>
			<td>{$smarty.const.JUR_TABLE_COLUMN_RECORD_ID}</td>
			<td>{$smarty.const.JUR_TABLE_COLUMN_AMOUNT}</td>
			<td>{$smarty.const.JUR_TABLE_COLUMN_DATE}</td>
			<td>{$smarty.const.JUR_TABLE_COLUMN_OPTIONS}</td>
			<td><input type="checkbox" class="checked_all"></td>
		</tr>
	</thead>
	<tbody class="data_body">
{if $arrJurPayments}
	{foreach from=$arrJurPayments item="payment" name="i"}
		<tr>
			<td style="text-align: center;">{$payment.order_id}</td>
			<td style="text-align: center;" title="{$payment.description}">{$payment.action}</td>
			<td style="text-align: center;">
				{if $payment.user_id}
					{$payment.user_id}&nbsp;<a href="{$smarty.const.CONF_ADMIN_FILE}?m=users&s=manager&action=detail&id={$payment.user_id}" target="_blank"><img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/icons/details.png" alt="{$smarty.const.SITE_DETAILS}" title="{$smarty.const.SITE_DETAILS}"></a>
				{else}
					none
				{/if}
			</td>
			<td style="text-align: center;">{$payment.record_id}</td>
			<td style="text-align: center;">{$payment.amount}</td>
			<td style="text-align: center;">{$payment.datetime|date_format:$smarty.const.CONF_DATE_FORMAT}&nbsp;{$payment.datetime|date_format:$smarty.const.CONF_TIME_FORMAT}</td>
			<td style="text-align: center;">
				<a href="javascript:void(0);" class="inline" id="{$payment.order_id}">
					<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/actions/moderate.png" alt="{$smarty.const.JUR_TABLE_COLUMN_OPTIONS}" title="{$smarty.const.JUR_TABLE_COLUMN_OPTIONS}">
				</a>
				<input type="hidden" value="{$payment.user_id}">
			</td>
			<td style="text-align: center;"><input type="checkbox" name="payment[{$payment.id}]" class="checkbox_entry"></td>
		</tr>
	{/foreach}
	</tbody>
	<tfoot class="data_foot">
		<tr>
			<td colspan="10" style="text-align: center;">{$smarty.const.JUR_TABLE_RECORDS} {$smarty.foreach.i.total}
				<span style="float: right;">
					<select name="action" class="select">
						<option value="">{$smarty.const.FORM_ACTION_SELECT}</option>
						<option value="del">{$smarty.const.JUR_FORM_ACTION_DELETE_SELECTED}</option>
					</select>
					<input type="submit" value="{$smarty.const.JUR_FORM_BUTTON_EXECUTE}" class="button">
				</span>
			</td>
		</tr>
	</tfoot>
{else}
		<tr>
			<td style="text-align: center;" colspan="10">{$smarty.const.JUR_TABLE_NOT_DATA}</td>
		</tr>
	</tbody>
{/if}
</table>
</form>

{if $arrJurPayments}
	<div style="display: none;">
	{foreach from=$arrJurPayments item="payment" name="i"}
		<div id="p_{$payment.order_id}" style="padding: 0px 20px;">
			<form class="process" action="{$smarty.const.CONF_ADMIN_FILE}?m=mods&amp;s=payments&amp;action=payments&amp;id=jur{$filterString}" method="post" enctype="multipart/form-data">
				<p style="font-weight: bold;">{$smarty.const.JUR_FORM_NOTIFICATION_ADDITIONAL_DATA}</p>
				{foreach from=$payment.data key="key" item="data"}
					<strong>{$key}:</strong>&nbsp;{$data}<br>
					<input type="hidden" name="paymentData[{$key}]" value="{$data}">
				{/foreach}
				{if $payment.user_id}
					<p style="font-weight: bold;">{$smarty.const.JUR_FORM_NOTIFICATION_TEXT}</p>
					<p><textarea name="message" cols="70" rows="8">
{$smarty.const.JUR_PAY_NUMBER}:&nbsp;{$payment.order_id}
{$smarty.const.JUR_PAY_AMOUNT}:&nbsp;{$payment.amount}
{$smarty.const.JUR_TABLE_COLUMN_ACTION}:&nbsp;{$payment.description}</textarea></p>
				{/if}
				<p>
					<input type="hidden" name="paymentData[id]" value="{$payment.id}">
					<input type="hidden" name="paymentData[order_id]" value="{$payment.order_id}">
					<input type="hidden" name="paymentData[action]" value="{$payment.action}">
					<input type="hidden" name="paymentData[user_id]" value="{$payment.user_id}">
					<input type="hidden" name="paymentData[record_id]" value="{$payment.record_id}">
					<input type="hidden" name="paymentData[amount]" value="{$payment.amount}">
					<input type="hidden" name="paymentData[message]" value="{$payment.message}">
					<input type="hidden" name="paymentData[datetime]" value="{$payment.datetime}">
					<label title="{$smarty.const.JUR_HELP_ACTION_DELETE}"><input type="radio" name="action" value="delete">&nbsp;{$smarty.const.JUR_FORM_ACTION_DELETE}</label>
					&nbsp;
					<label title="{$smarty.const.JUR_HELP_ACTION_CLOSE}"><input type="radio" name="action" value="close">&nbsp;{$smarty.const.JUR_FORM_ACTION_CLOSE}</label>
				</p>
				<p><input type="submit" value="{$smarty.const.JUR_FORM_BUTTON_EXECUTE}" class="button"></p>
			</form>
		</div>
	{/foreach}
	</div>
{/if}

<script type="text/javascript">
<!--
$(function() {
	$('.inline').click(function() {
		var targ = '#p_' + $(this).attr('id');
		var width = '500px';

		if ($(this).next().val() > 0) {
			width = 'auto';
		}

		$.fn.colorbox({ inline: true, href: targ, preloading: true, width: width, opacity: 0.5, scrolling: true });
		// отключаем горизонтальный скролл в окне colorbox (IE)
		$(targ).parent().css('overflow-x','hidden');
	});
	
	// отправляем форму платежа
	$('form.process').submit(function() {
		var act = $(this).find('input[name="action"]:checked');

		// проверяем, выбрано ли действие
		if (!act.size()) {
			alert('{$smarty.const.ERROR_NOT_SELECT_ACTION}');
			return false;
		}

		// проверяем какое действие выбрано
		if (act.val() == 'delete') {
			return confirm('{$smarty.const.JUR_MESSAGE_DELETE_PAYMENT}');
		} else if (act.val() == 'close') {
			return confirm('{$smarty.const.JUR_MESSAGE_CLOSE_PAYMENT}');
		}

		return true;
	});

	//включаем все переключатели в таблице	
	$('.checked_all').click(function() {
		(!$(this).is(':checked')) ? $('.checkbox_entry').attr('checked', '') : $('.checkbox_entry').attr('checked', 'checked');
	});

	// проверяем выбранное действие
	$("form.payments").submit(function() {
		if (!$('select[name="action"] option:selected').val()) {
			alert('{$smarty.const.ERROR_NOT_SELECT_ACTION}');
			return false;
		} else {
			if (!$('form.payments input:checked').size()) {
				alert('{$smarty.const.MESSAGE_WARNING_NOT_SELECT_RECORDS}');
				return false;
			}

			return ( $("select[name='action'] option:selected").val() === 'del' ) ? confirm('{$smarty.const.MESSAGE_DELETE_RECORDS_NOT_SEND_MAILS}') : true;
		}
	});

});
-->
</script>