{if $arrArticle}
	{* Замечания модератора *}
	{if $arrArticle.comments AND ($arrArticle.token eq 'moderate' OR $arrArticle.token eq 'correction')}
	<table style="margin-top: 10px; color: #CC3333;">
		<tr>
			<td>
				<strong><img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/item_ltr.png">&nbsp;{$smarty.const.FORM_ADMIN_COMMENTS}</strong>
				<br>
				<div style="margin-left: 20px; margin-top: 10px; font-size: 11px;">{$arrArticle.comments|nl2br}</div>
			</td>
		</tr>
	</table>
	{/if}
	
	<table style="margin: 20px;">
		<tr>
			<td><h2>{$arrArticle.title}</h2></td>
		</tr>
		<tr>
			<td>
				<hr>
				<strong><img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/item_ltr.png">&nbsp;{$smarty.const.FORM_SMALL_TEXT}</strong>
				<div style="margin-left: 20px; font-size: 11px;">{$arrArticle.small_text}</div>
			</td>
		</tr>
		<tr>
			<td>
				<hr>
				<strong><img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/item_ltr.png">&nbsp;{$smarty.const.FORM_TEXT}</strong>
				<div style="margin-left: 20px; font-size: 11px;">{$arrArticle.text}</div>
			</td>
		</tr>
		<tr>
			<td>
				<hr>
				<div style="margin-left: 20px; font-size: 11px;">
					<strong>{$smarty.const.FORM_DATE}:</strong>&nbsp;{$arrArticle.datetime|date_format:$smarty.const.CONF_DATE_FORMAT}&nbsp;{$arrArticle.datetime|date_format:$smarty.const.CONF_TIME_FORMAT}&nbsp;|&nbsp;<strong>{$smarty.const.FORM_AUTHOR}:</strong>&nbsp;{$arrArticle.author}
				</div>
			</td>
		</tr>
	</table>
	
	{if $arrArticle.token eq 'moderate'}
		<hr>
		<form id="a{$arrArticle.id}" action="{$smarty.const.CONF_ADMIN_FILE}?{$qString}" method="post">
			<p style="font-size: 11px;">
				<input type="hidden" name="arrData[id]" value="{$arrArticle.id}">
				<input type="hidden" name="arrData[title]" value="{$arrArticle.title}">
				<input type="hidden" name="arrData[id_user]" value="{$arrArticle.id_user}">
				<input type="hidden" name="arrData[datetime]" value="{$arrArticle.datetime}">
				<input type="radio" name="arrData[action]" value="active" checked="checked">&nbsp;{$smarty.const.FORM_ACTION_ACTIVATE}
				<input type="radio" name="arrData[action]" value="correction">&nbsp;{$smarty.const.FORM_ACTION_CORRECTION}
				<input type="radio" name="arrData[action]" value="deleted">&nbsp;{$smarty.const.FORM_ACTION_DELETE}
			</p>
			<div style="display: none; font-size: 11px;">
				{$smarty.const.FORM_MODERATE_ARTICLES_COMMENTS}
				<br><br>
				<strong>{$smarty.const.FORM_ADMIN_COMMENTS}:</strong>
				<br>
				<textarea name="arrData[comments]" class="comments" cols="70" rows="5">{$arrArticle.comments}</textarea>
			</div>
			<p><input type="submit" value="{$smarty.const.FORM_BUTTON_EXECUTE}" class="button"></p>
		</form>
	{/if}

	{* COMMENTS *}
	{if $arrArticle.token eq 'active' AND $arrComments}
		{include file="adm.manager.articles.comments.tpl"}

		<script type="text/javascript">
		<!--
		$(function() {
			// Удаление комментария
			$('.deleteComment').live('click', function() {
				var obj = $(this);
				var id = $(this).next('input').val();

				if (id && confirm('{$smarty.const.MESSAGE_COMMENTS_DELETE}')) {
					// удаляем комментарий
					$.ajax({ type: 'post', url: '/admajax.php', data: 'deleteCommentA=' + id,
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