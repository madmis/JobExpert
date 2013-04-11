{if $errors}{include file="errors.message.tpl"}{/if}

{if $arrComments}
	<div>
		{$smarty.const.SITE_COMMENTS_DISPLAY}:&nbsp;&nbsp;
		{if $order eq 'DESC'}{$smarty.const.SITE_COMMENTS_DISPLAY_LAST}{else}<a href="javascript:void(0);" id="ordDesc" rel="nofollow" title="{$smarty.const.SITE_COMMENTS_DISPLAY_LAST}">{$smarty.const.SITE_COMMENTS_DISPLAY_LAST}</a>{/if}&nbsp;&nbsp;
		{if $order eq 'ASC'}{$smarty.const.SITE_COMMENTS_DISPLAY_FIRST}{else}<a href="javascript:void(0);" id="ordAsc" rel="nofollow" title="{$smarty.const.SITE_COMMENTS_DISPLAY_FIRST}">{$smarty.const.SITE_COMMENTS_DISPLAY_FIRST}</a>{/if}
	</div>
	{foreach from=$arrComments item="comment"}
		<hr class="Design_panesDelimiter">
		<table class="commentsTable" id="comment_{$comment.id}">
			<tr>
				<td class="commentsName">
					<img src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/icons/comments.png" alt="{$smarty.const.FORM_COMMENT}">&nbsp;
					<strong>{$comment.name}</strong>&nbsp;-&nbsp;{$comment.datetime|date_format:$smarty.const.CONF_DATE_FORMAT}&nbsp;{$comment.datetime|date_format:$smarty.const.CONF_TIME_FORMAT}
				</td>
				<td class="commentsActions">
					<img id="{$comment.id}" class="complaint imLink" src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/icons/flag-black.png" alt="{$smarty.const.FORM_COMMENTS_COMPLAINT}" title="{$smarty.const.FORM_COMMENTS_COMPLAINT}">&nbsp;
					<input type="hidden" value="{$comment.name}">
					{if $newsAuthor}
						<img class="deleteComment imLink" src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/icons/no.png" alt="{$smarty.const.FORM_ACTION_DELETE}" title="{$smarty.const.FORM_ACTION_DELETE}">
						<input type="hidden" value="{$comment.id}">
					{/if}
				</td>
			</tr>
			<tr>
				<td class="commentsText" colspan="2">{$comment.text|nl2br}</td>
			</tr>
		</table>
	{/foreach}
{/if}

<script type="text/javascript">
<!--
$(function() {
	$('.complaint').mouseover( function() {
		$(this).attr('src', '{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/icons/flag-red.png');
	});
	$('.complaint').mouseout( function() {
		$(this).attr('src', '{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/icons/flag-black.png');
	});
	
	// Жалоба
	$('.complaint').click( function() {
		var obj = $(this);
		var id = $(this).attr('id');

		if (id && confirm('{$smarty.const.MESSAGE_COMMENTS_COMPLAINT} ' + $(this).next('input').val() + '?')) {
			$('#overlay, #dialog').show();
			// отправляем жалобу
			$.ajax({ type: 'post', url: '/ajax.php', data: 'complaintComment=' + id,
				success: function( response ) {
					response = $.parseJSON(response);

					if (response.success) {
						obj.remove();
						alert(response.success);
					} else {
						alert(response.error);
					}
				},
				complete: function() {
					$('#overlay, #dialog').hide();
				}
			});
		}
	});
	
	// Удаление комментария
	$('.deleteComment').click( function() {
		var id = $(this).next('input').val();
		var newsId = $('#newsId').val();
		
		if (id && confirm('{$smarty.const.MESSAGE_COMMENTS_DELETE}')) {
			$('#overlay, #dialog').show();
			// удаляем комментарий
			$.ajax({ type: 'post', url: '/ajax.php', data: 'deleteComment=' + id + '&newsId=' + newsId,
				success: function( response ) {
					response = $.parseJSON(response);

					if (response.success) {
						$('#comment_' + id).prev('hr').remove();
						$('#comment_' + id).remove();
					} else {
						alert(response.error);
					}
				},
				complete: function() {
					$('#overlay, #dialog').hide();
				}
			});
		}
	});

});
-->
</script>