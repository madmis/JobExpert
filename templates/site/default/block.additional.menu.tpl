{*

{if $smarty.const.CONF_USER_REGISTER AND ($codex.rights.add_news OR $codex.rights.edit_news OR $codex.rights.arc_news OR $codex.rights.del_news)}
	<h3 class="sideBlockHeader" id="additionalMenu">{$smarty.const.SITE_ADDITIONAL_MENU}</h3>
    <div class="DesignLeftSideBarBlockWrapper">
        <ul>
            {counter start=0 print=false}



    		{if $codex.rights.edit_news OR $codex.rights.arc_news OR $codex.rights.del_news}
                <li class="{if ({counter}%2)}even{else}odd{/if}">
				{if $menu eq 'manager.news' AND $action.main}
                    <div>{$smarty.const.MENU_MANAGER_NEWS}</div>
                {else}
                    <a href="index.php?ut={$user_type}&amp;do=manager.news">{$smarty.const.MENU_MANAGER_NEWS}</a>
                {/if}
                </li>
			{/if}



    		{if $codex.rights.add_news}
                <li class="{if ({counter}%2)}even{else}odd{/if}">
                    {if $menu eq 'manager.news' AND $action.add}
                        <div>{$smarty.const.MENU_MANAGER_NEWS_ADD}</div>
                    {else}
                        <a href="index.php?ut={$user_type}&amp;do=manager.news&amp;action=add">{$smarty.const.MENU_MANAGER_NEWS_ADD}</a>
                    {/if}
                </li>
 			{/if}



		    {if $codex.rights.add_news}
                <li class="{if ({counter}%2)}even{else}odd{/if}">
				{if $menu eq 'manager.news' AND $action.add}
                    <div>{$smarty.const.MENU_MANAGER_NEWS_ADD}</div>
                {else}
                    <a href="index.php?ut={$user_type}&amp;do=manager.news&amp;action=add">{$smarty.const.MENU_MANAGER_NEWS_ADD}</a>
                {/if}
                </li>
			{/if}



			{if $smarty.const.CONF_NEWS_ADD_USER_TOKEN eq 'moderate'}
                  <li class="{if ({counter}%2)}even{else}odd{/if}">
				{if $menu eq 'manager.news' AND $action['to.moderate']}
                      {$smarty.const.MENU_MANAGER_NEWS_TO_MODERATE}
                  {else}
                      <a href="index.php?ut={$user_type}&amp;do=manager.news&amp;action=to.moderate">{$smarty.const.MENU_MANAGER_NEWS_TO_MODERATE}</a>
                  {/if}
                  </li>
			{/if}



        </ul>
    </div>
{/if}

*}