<table cellspacing="0" cellpadding="0" style="width: 100%; border: 0px;">
	<tr>
		<td align="center">
			<table cellspacing="0" cellpadding="0" class="table_errors">
				<tr>
					<td class="td_errors">
						<img src="{$smarty.const.TEMPLATE_PATH_ADMIN}images/error_logo.png" alt="">
					</td>
					<td class="td_errors">
						{foreach from=$warnings item="warning"}
							<p class="p_5">&bull;&nbsp;{$warning}</p>
						{/foreach}
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>