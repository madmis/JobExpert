<table class="dataTable100">
	<thead>
		<tr>
			<td>{$smarty.const.TABLE_COLUMN_ERROR}</td>
			<td>{$smarty.const.TABLE_COLUMN_FILE}</td>
			<td>{$smarty.const.TABLE_COLUMN_MESSAGE}</td>
		</tr>
	</thead>
	<tbody>
{if $arrData}
	{foreach from=$arrData item="data"}
		<tr>
			<td class="alignCenter">
				{if $data.error eq 0}
					<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/icons/yes.png">
				{elseif $data.error eq 1}
					<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/icons/attention.png">
				{elseif $data.error eq 2}
					<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/icons/comments.png">
				{/if}
			</td>
			<td>{$data.object}</td>
			<td>{$data.message}</td>
		</tr>
	{/foreach}
	</tbody>
	<tfoot>
		<tr>
			<td class="alignRight" colspan="6">&nbsp;</td>
		</tr>
	</tfoot>
{else}
		<tr>
			<td colspan="6" class="alignCenter">{$smarty.const.TABLE_NOT_DATA}</td>
		</tr>
	</tbody>
{/if}
</table>

<script type="text/javascript">
<!--
$( function() {
});
-->
</script>
