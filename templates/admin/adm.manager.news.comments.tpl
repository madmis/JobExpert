<h3 style="margin: 0px 0px 0px 20px;">{$smarty.const.SITE_COMMENTS}</h3>
{foreach from=$arrComments item="comment"}
<table style="margin: 10px 20px; width: 95%;" id="test_{$comment.id}">
	<tr>
		<td>
			<hr>
			<div style="font-size: 11px;">
				<img class="deleteComment" style="cursor: pointer;" src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/icons/forbidden.png" alt="{$smarty.const.FORM_ACTION_DELETE}" title="{$smarty.const.FORM_ACTION_DELETE}">
				<input type="hidden" value="{$comment.id}">
				<strong>{$comment.name}</strong>&nbsp;-&nbsp;{$comment.datetime|date_format:$smarty.const.CONF_DATE_FORMAT}&nbsp;{$comment.datetime|date_format:$smarty.const.CONF_TIME_FORMAT}
			</div>
		</td>
	</tr>
	<tr>
		<td>
			<div style="margin-left: 20px; font-size: 11px;">{$comment.text|nl2br}</div>
		</td>
	</tr>
</table>
{/foreach}
