{if $article}
	<div class="DesignMainPageBody">
		<table class="mainBodyTable" cellspacing="0" style="table-layout:fixed;">
			<tr><th colspan="2">{$article.title}</th></tr>
			<tr>
				<td colspan="2" class="last AlignLeft"><div class="paddingTextBoth5">{$article.text}</div></td>
			</tr>
			<tr>
				<td class="AlignLeft noBorderRight">
					<div class="paddingTextBoth55">
						<strong>{$smarty.const.FORM_DATE}:</strong> {$article.datetime|date_format:$smarty.const.CONF_DATE_FORMAT}
						{if $article.author}|&nbsp;<strong>{$smarty.const.FORM_ARTICLES_AUTHOR}:</strong> {$article.author}{/if}
					</div>
				</td>
				<td class="last AlignRight noBorderLeft">
					<div class="sp_rating">
						<div class="rate">
							<div class="rating">{$smarty.const.FORM_ARTICLES_RATING}: {$article.rating}</div>
							<div class="base" style="height:16px; margin-top:2px;"><div class="average" style="width: {$article.rating}%;">&nbsp;</div></div>
							<div class="votes">{$article.votes} {$smarty.const.FORM_ARTICLES_VOTES}</div>
							{if !$vote}
								<div class="status">
									<div class="score">
										<a class="score1" href="?score=1&amp;id={$article.id}">1</a>
										<a class="score2" href="?score=2&amp;id={$article.id}">2</a>
										<a class="score3" href="?score=3&amp;id={$article.id}">3</a>
										<a class="score4" href="?score=4&amp;id={$article.id}">4</a>
										<a class="score5" href="?score=5&amp;id={$article.id}">5</a>
									</div>
								</div>
							{/if}
						</div>
					</div>
				</td>
			</tr>
		</table>
	</div>
	{if $smarty.const.CONF_ARTICLES_COMMENTS AND !$article.noComments}
		{include file="articles.comments.add.tpl"}
	{/if}
{else}
	<div class="ErrorBlockWrapper">
		<div class="ErrorHeader">{$smarty.const.ERROR_NON_DATA}</div>
		<div class="ErrorBlock"><ul><li>{$smarty.const.ERROR_NON_DATA}</li></ul></div>
	</div>
{/if}

<script type="text/javascript">
<!--
$(document).ready(function ()
{
	$('.status').prepend("<div class='score_this'>(<a href='javascript:void(0);'>{$smarty.const.FORM_ARTICLES_VOTING}</a>)</div>");
	$('.score_this').click(function () {
		$(this).slideUp();
		return false;
	});

	$('.score a').click(function () {
		$.get("/ajax.php" + $(this).attr("href"), {}, function (data) {
			$('.rate').fadeOut("normal", function () {
				$(this).html(data);
				$(this).fadeIn();
			});
		});
		return false; 
	});
	

});
-->
</script>
