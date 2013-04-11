{if $arrNews}
	<div class="DesignMainPageBody">
		<table class="mainBodyTable" style="border-spacing: 0px; width: 98%;">
			<tr><th>{$arrNews.title}</th></tr>
			{if $arrNews.token eq 'correction' AND $arrNews.comments}
			<tr>
				<td class="last AlignLeft">
					<p><img src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/attention.png" alt="attention">&nbsp;<strong>{$smarty.const.FORM_ADMIN_COMMENTS}</strong></p>
					<div class="paddingTextBoth5">{$arrNews.comments|nl2br}</div>
				</td>
			</tr>
			{/if}
			<tr>
				<td class="last AlignLeft">
					<p><strong>{$smarty.const.FORM_SMALL_TEXT}</strong></p>
					<div class="paddingTextBoth5">{$arrNews.small_text}</div>
				</td>
			</tr>
			<tr>
				<td class="last AlignLeft">
					<p><strong>{$smarty.const.FORM_TEXT}</strong></p>
					<div class="paddingTextBoth5">{$arrNews.text}</div>
				</td>
			</tr>
		{if $arrNews.meta_keywords}
			<tr>
				<td class="last AlignLeft">
					<p><strong>{$smarty.const.FORM_KEYWORDS}</strong></p>
					<div class="paddingTextBoth5">{$arrNews.meta_keywords}</div>
				</td>
			</tr>
		{/if}
		{if $arrNews.meta_description}
			<tr>
				<td class="last AlignLeft">
					<p><strong>{$smarty.const.FORM_DESCRIPTION}</strong></p>
					<div class="paddingTextBoth5">{$arrNews.meta_description}</div>
				</td>
			</tr>
		{/if}
			<tr>
				<td class="AlignLeft noBorderRight">
					<div class="paddingTextBoth55">
						<strong>{$smarty.const.FORM_PUBLICATION_DATE}:</strong>&nbsp;{$arrNews.datetime|date_format:$smarty.const.CONF_DATE_FORMAT}&nbsp;|&nbsp;<strong>{$smarty.const.FORM_PUBLICATION_TIME}:</strong> {$arrNews.datetime|date_format:$smarty.const.CONF_TIME_FORMAT}
						{if $arrNews.author}|&nbsp;<strong>{$smarty.const.FORM_AUTHOR}:</strong> {$arrNews.author}{/if}
					</div>
				</td>
			</tr>
		</table>
	</div>
{/if}