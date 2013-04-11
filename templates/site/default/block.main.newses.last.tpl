{if $smarty.const.CONF_NEWSES_LAST_SHOW && $last.newses}
	<div class="DesignMainPageBody">
		<table class="mainBodyTable" cellspacing="0">
			<tr>
				<th>{$smarty.const.SITE_LAST_NEWS}</th>
			</tr>
			{foreach from=$last.newses item="news" name="news"}
				<tr>
					<td class="last">
						<div class="DesignCenterSideBarBlockWrapper">
					        <div class="newsBlockLast">
								<div class="newsDate">{$news.datetime|date_format:$smarty.const.CONF_DATE_FORMAT} {$news.datetime|date_format:$smarty.const.CONF_TIME_FORMAT}</div>
								<a href="{$chpu->createChpuUrl("`$smarty.const.CONF_SCRIPT_URL`index.php?do=news&amp;action=view&amp;id=`$news.tId`")}" title="{$news.title}">{$news.title}</a>
					            <div class="paddingText5">{$news.small_text}</div>
					        </div>
						</div>
					</td>
				</tr>
			{/foreach}
			<tr>
				<td class="last AlignRight">
					<a href="{$chpu->createChpuUrl("`$smarty.const.CONF_SCRIPT_URL`index.php?do=news")}">{$smarty.const.SITE_ALL} {$smarty.const.SITE_NEWS}...</a>
				</td>
			</tr>
		</table>
	</div>
{/if}