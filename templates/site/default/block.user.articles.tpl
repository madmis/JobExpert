{if $user_email AND $codex.rights.add_articles AND $menu eq 'user.articles'}
	{counter start=0 print=false}

		<div class="DesignLeftSideBarBlockWrapper">
			<h3 class="sideBlockHeader" id="myArticles">{$smarty.const.MENU_MY_ARTICLES}</h3>
			<ul class="sideBlockContent">
				<li class="{if ({counter}%2)}even{else}odd{/if}"><a href="{$chpu->createChpuUrl("`$smarty.const.CONF_SCRIPT_URL`index.php?ut=$user_type&amp;do=user.articles&amp;action=add")}">{$smarty.const.MENU_ACTION_ADD}</a></li>
				<li class="{if ({counter}%2)}even{else}odd{/if}"><a href="{$chpu->createChpuUrl("`$smarty.const.CONF_SCRIPT_URL`index.php?ut=$user_type&amp;do=user.articles&amp;action=active")}">{$smarty.const.MENU_ACTION_ACTIVE}</a></li>
			{if $codex.rights.arc_articles}
				<li class="{if ({counter}%2)}even{else}odd{/if}"><a href="{$chpu->createChpuUrl("`$smarty.const.CONF_SCRIPT_URL`index.php?ut=$user_type&amp;do=user.articles&amp;action=archived")}">{$smarty.const.MENU_ACTION_ARCHIVED}</a></li>
			{/if}
			{if $codex.resp.moder_articles}
				<li class="{if ({counter}%2)}even{else}odd{/if}"><a href="{$chpu->createChpuUrl("`$smarty.const.CONF_SCRIPT_URL`index.php?ut=$user_type&amp;do=user.articles&amp;action=moderate")}">{$smarty.const.MENU_ACTION_MODERATE}</a></li>
				<li class="{if ({counter}%2)}even{else}odd{/if}"><a href="{$chpu->createChpuUrl("`$smarty.const.CONF_SCRIPT_URL`index.php?ut=$user_type&amp;do=user.articles&amp;action=correction")}">{$smarty.const.MENU_ACTION_CORRECTION}</a></li>
			{/if}
			</ul>
		</div>
{/if}