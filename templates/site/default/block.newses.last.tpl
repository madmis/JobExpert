{if $last.newses && 'news' neq $menu}
	<div class="DesignLeftSideBarBlockWrapper" style="padding:0px 9px 35px 2px;">
		<h3 class="NewsH3 sideBlockHeader" id="news" style="margin-left: 4px;">{$smarty.const.SITE_LAST_NEWS}</h3>
	    <div class="DesignMainPageBody">
		    {foreach from=$last.newses item="news" name="news"}
		        <div class="newsBlock{if $smarty.foreach.News.last}Last{/if}">
		            <a href="{$chpu->createChpuUrl("`$smarty.const.CONF_SCRIPT_URL`index.php?do=news&amp;action=view&amp;id=`$news.tId`")}" title="{$news.title}">{$news.title}</a>
		            <div class="newsDate">{$news.datetime|date_format:$smarty.const.CONF_DATE_FORMAT} {$news.datetime|date_format:$smarty.const.CONF_TIME_FORMAT}</div>
		        </div>
  			{/foreach}
			<div class="AlignRight">
				<a href="{$chpu->createChpuUrl("`$smarty.const.CONF_SCRIPT_URL`index.php?do=news")}">{$smarty.const.SITE_ALL} {$smarty.const.SITE_NEWS}...</a>
			</div>
	    </div>
	</div>
{/if}