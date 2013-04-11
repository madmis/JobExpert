{if $arrNews}
	{* Замечания модератора *}
	{if $arrNews.comments AND ($arrNews.token eq 'moderate' OR $arrNews.token eq 'correction')}
	<table style="margin-top: 10px; color: #CC3333;">
		<tr>
			<td>
				<strong><img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/item_ltr.png">&nbsp;{$smarty.const.FORM_ADMIN_COMMENTS}</strong>
				<br>
				<div style="margin-left: 20px; margin-top: 10px; font-size: 11px;">{$arrNews.comments|nl2br}</div>
			</td>
		</tr>
	</table>
	{/if}
	
	<table style="margin: 20px;">
		<tr>
			<td><h2>{$arrNews.title}</h2></td>
		</tr>
		<tr>
			<td>
				<hr>
				<strong><img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/item_ltr.png">&nbsp;{$smarty.const.FORM_SMALL_TEXT}</strong>
				<div style="margin-left: 20px; font-size: 11px;">{$arrNews.small_text}</div>
			</td>
		</tr>
		<tr>
			<td>
				<hr>
				<strong><img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/item_ltr.png">&nbsp;{$smarty.const.FORM_TEXT}</strong>
				<div style="margin-left: 20px; font-size: 11px;">{$arrNews.text}</div>
			</td>
		</tr>
		<tr>
			<td>
				<hr>
				<div style="margin-left: 20px; font-size: 11px;">
					<strong>{$smarty.const.FORM_DATE}:</strong>&nbsp;{$arrNews.datetime|date_format:$smarty.const.CONF_DATE_FORMAT}&nbsp;{$arrNews.datetime|date_format:$smarty.const.CONF_TIME_FORMAT}&nbsp;|&nbsp;<strong>{$smarty.const.FORM_AUTHOR}:</strong>&nbsp;{$arrNews.author}
				</div>
			</td>
		</tr>
	</table>
	
	{if $arrNews.token eq 'moderate'}
		<hr>
		<form id="a{$arrNews.id}" action="{$smarty.const.CONF_ADMIN_FILE}?{$qString}" method="post">
			<p style="font-size: 11px;">
				<input type="hidden" name="arrData[id]" value="{$arrNews.id}">
				<input type="hidden" name="arrData[title]" value="{$arrNews.title}">
				<input type="hidden" name="arrData[id_user]" value="{$arrNews.id_user}">
				<input type="hidden" name="arrData[datetime]" value="{$arrNews.datetime}">
				<label><input type="radio" name="arrData[action]" value="active" checked="checked">&nbsp;{$smarty.const.FORM_ACTION_ACTIVATE}</label>
				<label><input type="radio" name="arrData[action]" value="correction">&nbsp;{$smarty.const.FORM_ACTION_CORRECTION}</label>
				<label><input type="radio" name="arrData[action]" value="deleted">&nbsp;{$smarty.const.FORM_ACTION_DELETE}</label>
			</p>
			<div style="display: none; font-size: 11px;">
				{$smarty.const.FORM_MODERATE_NEWS_COMMENTS}
				<br><br>
				<strong>{$smarty.const.FORM_ADMIN_COMMENTS}:</strong>
				<br>
				<textarea name="arrData[comments]" class="comments" cols="70" rows="5">{$arrNews.comments}</textarea>
			</div>
			<p><input type="submit" value="{$smarty.const.FORM_BUTTON_EXECUTE}" class="button"></p>
		</form>
	{/if}

	{* COMMENTS *}
	{if $arrNews.token eq 'active' AND $arrComments}
		{include file="adm.manager.news.comments.tpl"}

		<script type="text/javascript">
		<!--
		$(function() {
			// Удаление комментария
			$('.deleteComment').live('click', function() {
				var obj = $(this);
				var id = $(this).next('input').val();

				if (id && confirm('{$smarty.const.MESSAGE_COMMENTS_DELETE}')) {
					// удаляем комментарий
					$.ajax({ type: 'post', url: '/admajax.php', data: 'deleteComment=' + id,
						success: function( response ) {
							response = $.parseJSON(response);

							if (response.success) {
								obj.parents('table').css('color', '#CCCCCC');
								obj.remove();
							} else {
								$.alert(response.error);
							}
						}
					});
				}
			});
		});
		-->
		</script>
	{/if}
{/if}