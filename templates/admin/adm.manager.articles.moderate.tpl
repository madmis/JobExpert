<form action="{$smarty.const.CONF_ADMIN_FILE}?{$qString}" method="post">
<table class="dataTable100">
	<thead>
		<tr>
			<td>{$smarty.const.TABLE_COLUMN_ID}</td>
			<td>{$smarty.const.TABLE_COLUMN_TITLE}</td>
			<td>{$smarty.const.FORM_COMMENTS}</td>
			<td>{$smarty.const.TABLE_COLUMN_SECTION}</td>
			<td>{$smarty.const.TABLE_COLUMN_AFFILIATION}</td>				
			<td>{$smarty.const.TABLE_COLUMN_USER_ID}</td>				
			<td>{$smarty.const.TABLE_COLUMN_AUTHOR}</td>				
			<td>{$smarty.const.TABLE_COLUMN_DATE}</td>
			<td><input type="checkbox" class="checked_all"></td>
		</tr>
	</thead>
	<tbody>
{if $arrArticles}
	{foreach from=$arrArticles item="arrArticle" name="i"}
		<tr>
			<td class="alignCenter">{$arrArticle.id}</td>
			<td title="{$arrArticle.title|escape}">
				<span class="detail">{$arrArticle.title|truncate}</span>
				<input type="hidden" value="{$arrArticle.id}">
			</td>
			<td class="alignCenter">
				{if $arrArticle.comments}
					<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/icons/yes.png" alt="{$smarty.const.SITE_ISSET}">
				{else}
					<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/icons/no.png" alt="{$smarty.const.SITE_NO}">
				{/if}
			</td>
			<td title="{$sections.full[$arrArticle.id_section].name}">{$sections.full[$arrArticle.id_section].name|truncate:20}</td>
			<td class="alignCenter">
				{foreach from=$sections.full item="section"}
					{if $section.id eq $arrArticle.id_section}
						{if $section.affiliation eq 'employer'}
							{$smarty.const.FORM_TYPE_EMPLOYER}
						{elseif $section.affiliation eq 'competitor'}
							{$smarty.const.FORM_TYPE_COMPETITOR}
						{else}
							{$smarty.const.FORM_DICTIONARY_ART_SECTIONS_AFFILIATION_ALL}
						{/if}
					{/if}
				{/foreach}
			</td>
			<td class="alignCenter">
				{if $arrArticle.id_user}
					<a href="{$smarty.const.CONF_ADMIN_FILE}?m=users&amp;s=manager&amp;action=detail&amp;id={$arrArticle.id_user}" target="_blank">{$arrArticle.id_user}</a>
				{else}
					{$arrArticle.id_user}
				{/if}
			</td>
			<td class="alignCenter">{$arrArticle.author}</td>
			<td class="alignCenter" style="white-space: nowrap;">
				{$arrArticle.datetime|date_format:$smarty.const.CONF_DATE_FORMAT}&nbsp;{$arrArticle.datetime|date_format:$smarty.const.CONF_TIME_FORMAT}
			</td>
			<td class="alignCenter">
				<input type="checkbox" name="articles[{$arrArticle.id}]" class="checkbox_entry">
			</td>
		</tr>
	{/foreach}
	</tbody>
	<tfoot>
		<tr>
			<td colspan="4" class="alignCenter">{$smarty.const.TABLE_RECORDS} {$smarty.foreach.i.total}/{$allRecords}</td>
			<td colspan="5" class="alignRight">
				<select name="action">
					<option value="">{$smarty.const.FORM_ACTION_SELECT}</option>
					<option value="active">{$smarty.const.FORM_ACTION_ACTIVATE_SELECTED}</option>
					<option value="correction">{$smarty.const.FORM_ACTION_CORRECTION}</option>
					<option value="delete">{$smarty.const.FORM_ACTION_DELETE_SELECTED}</option>
				</select>
				<input type="submit" value="{$smarty.const.FORM_BUTTON_EXECUTE}" class="button">
			</td>
		</tr>
	</tfoot>
{else}
		<tr>
			<td class="alignCenter" colspan="9">{$smarty.const.TABLE_NOT_DATA}</td>
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
			data: ({ getArticleDetail: id, strQuery: '{$qString}' }),
			success: function(data) {
				$('#overlay, #dialog').hide();
				$.colorbox({ html: data, width: '80%', height: '90%', opacity: 0, scrolling: true });

				// проверяем выбранное действие
				$('input[name="arrData[action]"]').click(function() {
					var action = $(this).val();
					( 'active' !== action ) ? $(this).parent().next().show() : $(this).parent().next().hide();
				});

				// проверяем данные перед отправкой формы
				$('form[id]').submit( function() {
					var action = $('input[name="arrData[action]"]:checked').val();
					if (!action) {
						$.alert( '{$smarty.const.ERROR_NOT_SELECT_ACTION}' );
						return false;
					} else if ( 'active' !== action && !$('.comments').val() ) {
						$.alert( '{$smarty.const.WARNING_ACTION_USER_MESSAGE_EMPTY}' );
						$('.comments').focus();
						return false;
					} else {
						return ( 'deleted' === action ) ? confirm( '{$smarty.const.MESSAGE_DELETE_RECORD}' ) : true;
					}
				});
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

			if ( $("select[name='action'] option:selected").val() === 'delete' ) {
				return confirm('{$smarty.const.MESSAGE_DELETE_RECORDS_NOT_SEND_MAILS}');
			} else if ( $("select[name='action'] option:selected").val() === 'active' ) {
				return confirm('{$smarty.const.MESSAGE_ACTIVE_RECORDS_NOT_SEND_MAILS}');
			} else if ( $("select[name='action'] option:selected").val() === 'correction' ) {
				return confirm('{$smarty.const.MESSAGE_CORRECTION_RECORDS_NOT_SEND_MAILS}');
			}
		}
	});
});
-->
</script>
