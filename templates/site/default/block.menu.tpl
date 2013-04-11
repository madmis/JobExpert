    <div class="DesignLeftSideBarBlockWrapper">
        <h3 class="sideBlockHeader" id="menu">{$smarty.const.MENU}</h3>
        <ul>
            {counter start=0 print=false}
            {* ------------------------ *}
            <li class="{if ({counter}%2)}even{else}odd{/if}">
   				{if $menu eq 'news' && (!$action.archive || $action.view)}
                    <div class="withIcon"><strong>{$smarty.const.MENU_NEWS}</strong></div>
                {else}
                    <a class="withIcon" href="{$chpu->createChpuUrl("`$smarty.const.CONF_SCRIPT_URL`index.php?do=news")}">{$smarty.const.MENU_NEWS}</a>
                {/if}
                <a class="icon" href="{$chpu->createChpuUrl("`$smarty.const.CONF_SCRIPT_URL`index.php?ut=$user_type&amp;do=rss&amp;action=news")}"><img src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/design/sideBarMenuRss.png" alt="RSS"></a>
            </li>
            {* ------------------------ *}
            <li class="{if ({counter}%2)}even{else}odd{/if}">
                {if $menu eq 'feedback'}
                    <div class="withIcon"><strong>{$smarty.const.MENU_FEEDBACK}</strong></div>
                {else}
                    <a href="{$chpu->createChpuUrl("`$smarty.const.CONF_SCRIPT_URL`index.php?do=feedback")}">{$smarty.const.MENU_FEEDBACK}</a>
                {/if}
            </li>
            {* ------------------------ *}
			{if $dop_pages}
			{foreach from=$dop_pages item="page"}
				<li class="{if ({counter}%2)}even{else}odd{/if}">
					{if $menu eq $page.id}
						<div class="withIcon"><strong>{$page.title}</strong></div>
					{else}
						<a href="{$chpu->createChpuUrl("`$smarty.const.CONF_SCRIPT_URL`index.php?do=pages&amp;action=view&amp;id=`$page.id`")}">{$page.title}</a>
					{/if}
				</li>
			{/foreach}
			{/if}
        </ul>
    </div>