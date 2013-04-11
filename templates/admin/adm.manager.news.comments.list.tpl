{if $strPages neq '&nbsp;'}<p class="alignCenter">{$strPages}</p>{/if}
<form action="{$smarty.const.CONF_ADMIN_FILE}?{$qString}" method="post">
<table class="dataTable100">
	<thead>
		<tr>
			<td>
				<span style="float: left; padding-left: 40px;">{$smarty.const.TABLE_COLUMN_COMMENTS}</span>
				<span style="float: right;">{$smarty.const.TABLE_RECORDS}:&nbsp;
				{foreach from=$arrRecords item="record"}
					{if $records eq $record OR (!$records AND $record eq 'all')}
						<span style="color: #000000;">{$record}&nbsp;</span>
					{else}
						<a href="{$smarty.const.CONF_ADMIN_FILE}?m=manager&amp;s=news&amp;action=comments{$strFilter}{$strSort}&amp;records={$record}" class="white">
							{$record}
						</a>&nbsp;
					{/if}
				{/foreach}
				</span>
			</td>
			<td style="width: 10px;"><input type="checkbox" class="checked_all"></td>
		</tr>
	</thead>
	<tbody>
{if $arrComments}
	{foreach from=$arrComments item="comment" name="i"}
		<tr>
			<td>
				<table style="width: 100%; border-spacing: 10px;">
					<tr>
						<td style="width: 50%; border: 0px; vertical-align: top;">
							{if $arrFilter.filter eq 'name'}
								{capture name='filter'}{/capture}
								{capture name='const'}{$smarty.const.ANNOUNCE_FILTER_OFF}{/capture}
								{capture name='image'}unfilter.png{/capture}
							{else}
								{capture name='filter'}&amp;filter=name&amp;in={$comment.name}{/capture}
								{capture name='const'}{$smarty.const.ANNOUNCE_FILTER_ON}{/capture}
								{capture name='image'}filter.png{/capture}
							{/if}
							<a href="{$smarty.const.CONF_ADMIN_FILE}?m=manager&amp;s=news&amp;action=comments{$smarty.capture.filter}{$strSort}"><img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/icons/{$smarty.capture.image}" alt="{$smarty.capture.const}" title="{$smarty.capture.const}"></a>
							<strong>{$comment.name}</strong>
						</td>
						<td style="width: 50%; border: 0px; vertical-align: top;">
							{if $arrFilter.filter eq 'ip'}
								{capture name='filter'}{/capture}
								{capture name='const'}{$smarty.const.ANNOUNCE_FILTER_OFF}{/capture}
								{capture name='image'}unfilter.png{/capture}
							{else}
								{capture name='filter'}&amp;filter=ip&amp;in={$comment.ip}{/capture}
								{capture name='const'}{$smarty.const.ANNOUNCE_FILTER_ON}{/capture}
								{capture name='image'}filter.png{/capture}
							{/if}
							<a href="{$smarty.const.CONF_ADMIN_FILE}?m=manager&amp;s=news&amp;action=comments{$smarty.capture.filter}{$strSort}"><img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/icons/{$smarty.capture.image}" alt="{$smarty.capture.const}" title="{$smarty.capture.const}"></a>
 							{$comment.ip}
 						</td>
					</tr>
					<tr style="height: 10px;">
						<td style="width: 50%; border: 0px; vertical-align: top;" rowspan="2">
							{$comment.text|nl2br}
						</td>
						<td style="width: 50%; border: 0px; vertical-align: top;">
							{if !$arrSort || ($arrSort.order eq 'datetime' && $arrSort.by eq 'DESC')}
								<a href="{$smarty.const.CONF_ADMIN_FILE}?m=manager&amp;s=news&amp;action=comments{$strFilter}&amp;order=datetime&amp;by=ASC"><img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/icons/sort_down.gif" alt="{$smarty.const.ANNOUNCE_SORT_UP}" title="{$smarty.const.ANNOUNCE_SORT_UP}"></a>
							{else}
								<a href="{$smarty.const.CONF_ADMIN_FILE}?m=manager&amp;s=news&amp;action=comments{$strFilter}&amp;order=datetime&amp;by=DESC"><img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/icons/sort_up.gif" alt="{$smarty.const.ANNOUNCE_SORT_DOWN}" title="{$smarty.const.ANNOUNCE_SORT_DOWN}"></a>
							{/if}
                            {$comment.datetime|date_format:$smarty.const.CONF_DATE_FORMAT}&nbsp;{$comment.datetime|date_format:$smarty.const.CONF_TIME_FORMAT}
						</td>
					</tr>
					<tr>
						<td style="width: 50%; border: 0px; vertical-align: top;">
							{if $arrFilter.filter eq 'id_news'}
								{capture name='filter'}{/capture}
								{capture name='const'}{$smarty.const.ANNOUNCE_FILTER_OFF}{/capture}
								{capture name='image'}unfilter.png{/capture}
							{else}
								{capture name='filter'}&amp;filter=id_news&amp;in={$comment.id_news}{/capture}
								{capture name='const'}{$smarty.const.ANNOUNCE_FILTER_ON}{/capture}
								{capture name='image'}filter.png{/capture}
							{/if}
							<a href="{$smarty.const.CONF_ADMIN_FILE}?m=manager&amp;s=news&amp;action=comments{$smarty.capture.filter}{$strSort}"><img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/icons/{$smarty.capture.image}" alt="{$smarty.capture.const}" title="{$smarty.capture.const}"></a>
							<span class="detail">{$comment.title}</span>
							<input type="hidden" value="{$comment.id_news}">
						</td>
					</tr>
				</table>
			</td>
			<td class="alignCenter"><input type="checkbox" name="comments[{$comment.id}]" class="checkbox_entry"></td>
		</tr>
	{/foreach}
	</tbody>
	<tfoot>
		<tr>
			<td colspan="2">
				{$smarty.const.TABLE_RECORDS} {$smarty.foreach.i.total}/{$allRecords}
				<span style="float: right;">
					<select name="action">
						<option value="">{$smarty.const.FORM_ACTION_SELECT}</option>
						<option value="deleted">{$smarty.const.FORM_ACTION_DELETE_SELECTED}</option>
					</select>
					<input type="submit" value="{$smarty.const.FORM_BUTTON_EXECUTE}" class="button">
				</span>
			</td>
		</tr>
	</tfoot>
{else}
		<tr>
			<td colspan="4" class="alignCenter">{$smarty.const.TABLE_NOT_DATA}</td>
		</tr>
	</tbody>
{/if}
</table>
</form>
<p class="alignCenter">{$strPages}</p>

<script type="text/javascript">
<!--
$( function() {
	//Подробный просмотр
	$('.detail').click(function() {
		$('#overlay, #dialog').show();
		var id = $(this).next('input').val();

		$.ajax({ type: 'post', url: '/admajax.php',
			data: ({ getNewsDetail: id, strQuery: '{$qString}' }),
			success: function(data) {
				$('#overlay, #dialog').hide();
				$.colorbox({ html: data, width: '80%', height: '90%', opacity: 0, scrolling: true });
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
