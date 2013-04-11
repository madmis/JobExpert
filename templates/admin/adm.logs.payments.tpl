<p class="sub_menu"><span class="colorbox_help" id="HELP_ADMIN_LOGS_PAYMENTS"><img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/actions/help.png" alt="{$smarty.const.FORM_IMG_HELP}"></span></p>

{if $errors}{include file="adm.errors.message.tpl"}{/if}

{* Файлы логов *}
{if $actions.files}
	{include file="adm.logs.payments.files.tpl"}
{* Список логов *}
{else}

	<form action="{$smarty.const.CONF_ADMIN_FILE}?{$qString}" method="get">
	<input type="hidden" name="m" value="logs">
	<input type="hidden" name="s" value="payments">
	<input type="hidden" name="do" value="filter">
	<table style="width: 100%; border-spacing: 0px;" class="otbor_table">
		<thead class="otbor_head" id="logs_payments">
			<tr><td>{$smarty.const.TABLE_FORM_SELECTION}</td></tr>
		</thead>
		<tbody>
			<tr>
				<td class="alignLeft" style="width: 100%;">
					<table style="width: 100%;" class="hidden_table" id="logs_payments_otbor">
						<tbody class="otbor_body">
							<tr>
								<td>
									{$smarty.const.FORM_ORDER_ID}&nbsp;<input type="text" name="order_id" value="{$retFields.order_id}">
									<span class="colorbox_help" id="HELP_ADMIN_PATTERN_FILTER_STRING"><img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/help_icon.png" alt="{$smarty.const.FORM_IMG_HELP}"></span>
								</td>
								<td>{$smarty.const.FORM_RECORDS}&nbsp;<input type="text" name="records" size="5" value="{$retFields.records}"></td>
							</tr>
						</tbody>
						<tfoot class="otbor_foot">
							<tr>
								<td colspan="3"><input type="submit" value="{$smarty.const.FORM_BUTTON_EXECUTE}" class="button"></td>
							</tr>
						</tfoot>
					</table>
				</td>
			</tr>
		</tbody>
	</table>
	</form>
	<br>

	<form action="{$smarty.const.CONF_ADMIN_FILE}?{$qString}" method="post">
	<table class="dataTable100">
		<thead>
			<tr>
				<td>{$smarty.const.TABLE_COLUMN_ID}</td>
				<td>{$smarty.const.TABLE_COLUMN_ORDER_ID}</td>
				<td>{$smarty.const.TABLE_COLUMN_PAYMENT_TYPE}</td>
				<td>{$smarty.const.TABLE_COLUMN_PAYMENT_STATUS}</td>
				<td>{$smarty.const.TABLE_COLUMN_FILE}</td>
				<td>{$smarty.const.TABLE_COLUMN_DATE}</td>
				<td><input type="checkbox" class="checked_all"></td>
			</tr>
		</thead>
		<tbody>
	{if $arrLogsPayments}
		{foreach from=$arrLogsPayments item="arrPayment" name="i"}
			<tr>
				<td class="alignCenter">{$arrPayment.id}</td>
				<td class="alignCenter">
					<span class="detail">{$arrPayment.order_id}</span>
					<input type="hidden" value="{$arrPayment.id}">
				</td>
				<td>{$arrPayment.payment_type}</td>
				<td>{$arrPayment.status}</td>
				<td class="alignCenter">
					{if $arrPayment.file}
						<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/icons/yes.png" alt="{$smarty.const.SITE_ISSET}" class="file" style="cursor: pointer;">
						<input type="hidden" value="{$arrPayment.file}">
					{else}
						<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/icons/no.png" alt="{$smarty.const.SITE_NO}">
					{/if}
				</td>
				<td class="alignCenter">
					{$arrPayment.date|date_format:$smarty.const.CONF_DATE_FORMAT}&nbsp;{$arrPayment.date|date_format:$smarty.const.CONF_TIME_FORMAT}
				</td>
				<td class="alignCenter"><input type="checkbox" name="payments[{$arrPayment.id}]" class="checkbox_entry"></td>
			</tr>
		{/foreach}
		</tbody>
		<tfoot>
			<tr>
				<td colspan="3">
					{$smarty.const.TABLE_RECORDS} {$smarty.foreach.i.total}/{$allRecords}
				</td>
				<td class="alignRight" colspan="4">
					<select name="action">
						<option value="">{$smarty.const.FORM_ACTION_SELECT}</option>
						<option value="deleted">{$smarty.const.FORM_ACTION_DELETE_SELECTED}</option>
					</select>
					<input type="submit" value="{$smarty.const.FORM_BUTTON_EXECUTE}" class="button">
				</td>
			</tr>
		</tfoot>
	{else}
			<tr>
				<td colspan="8" class="alignCenter">{$smarty.const.TABLE_NOT_DATA}</td>
			</tr>
		</tbody>
	{/if}
	</table>
	</form>

	<p class="alignCenter">{$strPages}</p>

	<script type="text/javascript">
	<!--
	$( function() {
		//просмотр файла
		$('.file').click(function() {
			$('#overlay, #dialog').show();
			var file = $(this).next('input').val();

			$.ajax({ type: 'post', url: '/admajax.php',
				data: ({ getLogPaymentsFileDetail: file }),
				success: function(data) {
					$('#overlay, #dialog').hide();
					$.colorbox({ html: data, width: '80%', height: '90%', opacity: 0, scrolling: true });
				}
			});
		});

		// Просмотр деталей логов оплат
		$('.detail').click(function() {
			$('#overlay, #dialog').show();
			var id = $(this).next('input').val();

			$.ajax({ type: 'post', url: '/admajax.php',
				data: ({ getLogPaymentsDetail: id }),
				success: function(data) {
					$('#overlay, #dialog').hide();
					$.colorbox({ html: data, opacity: 0, scrolling: true });
				}
			});
		});

		//включаем все переключатели в таблице	
		$('.checked_all').click(function() {
			(!$(this).is(':checked')) ? $('.checkbox_entry').removeAttr('checked') : $('.checkbox_entry').attr('checked', 'checked');
		});

		// проверяем выбранное действие
		$("form:last").submit( function() {
			if (!$('select[name="action"] option:selected').val()) {
				$.alert('{$smarty.const.ERROR_NOT_SELECT_ACTION}');
				return false;
			} else {
				if (!$('form:last input:checked').size()) {
					$.alert('{$smarty.const.MESSAGE_WARNING_NOT_SELECT_RECORDS}');
					return false;
				}

				return ( $("select[name='action'] option:selected").val() === 'deleted' ) ? confirm('{$smarty.const.MESSAGE_DELETE_RECORDS}') : true;
			}
		});
	});
	-->
	</script>

{/if}