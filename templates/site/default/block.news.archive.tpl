{if $archive.news}
	{assign var="i" value="0"}

	<div class="DesignLeftSideBarBlockWrapper">
		<h3 class="sideBlockHeader" id="blockNewsArchive" style="margin-left: 4px;">{$smarty.const.MENU_NEWS_ARCHIVE}</h3>
	    <div class="DesignMainPageBody">
			<ul>
			{foreach from=$archive.news item="year" name="year"}
				{assign var="i" value=$i+1}
				<li class="{if ($i%2)}even{else}odd{/if}">
					{if $selectedYear eq $year}
						<div class="withIcon"><strong>{$year}</strong></div>
					{else}
						<a class="withIcon" href="{$chpu->createChpuUrl("`$smarty.const.CONF_SCRIPT_URL`index.php?do=news&amp;action=archive&amp;year=$year")}">{$year}</a>
					{/if}
				</li>
				{if $selectedYear}
					{if $menu eq "news" && $action.archive && $selectedYear eq $year}
						<li class="CategoriesLists">
							{foreach from=$arrAddDict.Month.values key="key" item="month" name="month"}
								{if $smarty.foreach.year.first}
									{if $currMonth >= $smarty.foreach.month.iteration}
										{if $selectedMonth eq $key}
                                            <div style="margin-left: 20px; font-weight: bold;">{$month}</div>
                                        {else}
                                            <div style="margin-left: 20px;">
											    <a href="{$chpu->createChpuUrl("`$smarty.const.CONF_SCRIPT_URL`index.php?do=news&amp;action=archive&amp;year=$year&month=$key")}">{$month}</a>
										    </div>
                                        {/if}
									{/if}
								{else}
                                    {if $selectedMonth eq $key}
                                        <div style="margin-left: 20px; font-weight: bold;">{$month}</div>
                                    {else}
									    <div style="margin-left: 20px;">
										    <a href="{$chpu->createChpuUrl("`$smarty.const.CONF_SCRIPT_URL`index.php?do=news&amp;action=archive&amp;year=$year&month=$key")}">{$month}</a>
									    </div>
                                    {/if}
								{/if}
							{/foreach}
						</li>
					{/if}
				{/if}
			{/foreach}
			</ul>
	    </div>
	</div>
{/if}
