{if $arrArticle}
	<div class="DesignMainPageBody">
		<table class="mainBodyTable" style="border-spacing: 0px; width: 98%;">
			<tr><th>{$arrArticle.title}</th></tr>
			{if $arrArticle.token eq 'correction' AND $arrArticle.comments}
			<tr>
				<td class="last AlignLeft">
					<p><img src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/attention.png" alt="attention">&nbsp;<strong>{$smarty.const.FORM_ADMIN_COMMENTS}</strong></p>
					<div class="paddingTextBoth5">{$arrArticle.comments|nl2br}</div>
				</td>
			</tr>
			{/if}
			<tr>
				<td class="last AlignLeft">
					<p><strong>{$smarty.const.FORM_SMALL_TEXT}</strong></p>
					<div class="paddingTextBoth5">{$arrArticle.small_text}</div>
				</td>
			</tr>
			<tr>
				<td class="last AlignLeft">
					<p><strong>{$smarty.const.FORM_TEXT}</strong></p>
					<div class="paddingTextBoth5">{$arrArticle.text}</div>
				</td>
			</tr>
		{if $article.meta_keywords}
			<tr>
				<td class="last AlignLeft">
					<p><strong>{$smarty.const.FORM_KEYWORDS}</strong></p>
					<div class="paddingTextBoth5">{$arrArticle.meta_keywords}</div>
				</td>
			</tr>
		{/if}
		{if $article.meta_description}
			<tr>
				<td class="last AlignLeft">
					<p><strong>{$smarty.const.FORM_DESCRIPTION}</strong></p>
					<div class="paddingTextBoth5">{$arrArticle.meta_description}</div>
				</td>
			</tr>
		{/if}
			<tr>
				<td class="AlignLeft noBorderRight">
					<div class="paddingTextBoth55">
						<strong>{$smarty.const.FORM_PUBLICATION_DATE}:</strong>&nbsp;{$arrArticle.datetime|date_format:$smarty.const.CONF_DATE_FORMAT}&nbsp;|&nbsp;<strong>{$smarty.const.FORM_PUBLICATION_TIME}:</strong> {$arrArticle.datetime|date_format:$smarty.const.CONF_TIME_FORMAT}
						{if $arrArticle.author}|&nbsp;<strong>{$smarty.const.FORM_AUTHOR}:</strong> {$arrArticle.author}{/if}
					</div>
				</td>
			</tr>
		</table>
	</div>
{/if}