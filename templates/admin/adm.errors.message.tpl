<table cellspacing="0" cellpadding="0" style="width: 100%; border: 0px;">
	<tr>
		<td align="center">
			<table cellspacing="0" cellpadding="0" class="table_errors">
				<tr>
					<td class="td_errors">
						<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/error_logo.png" alt="">
					</td>
					<td class="td_errors" style="text-align: left;">
						{foreach from=$errors item="error"}
							<p class="p_5">&bull;&nbsp;{$error}</p>
						{/foreach}
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>