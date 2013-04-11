{if $menu eq 'user.announces' && $action eq 'resume' && ($user_type eq 'competitor' || $user_type eq 'agent')}
	{counter start=0 print=false}
	<div class="DesignLeftSideBarBlockWrapper">
		<h3 class="sideBlockHeader" id="resume">{$smarty.const.MENU_MY_RESUMES}</h3>
		<ul class="sideBlockContent">
			<li class="{if ({counter}%2)}even{else}odd{/if}">
				{if $token eq 'active'}
					<a class="active">{$smarty.const.ANNOUNCE_TOKEN_ACTIVE} {$smarty.const.FORM_RESUMES_HEAD}</a>
				{else}
					<a href="{$chpu->createChpuUrl("`$smarty.const.CONF_SCRIPT_URL`index.php?ut=$user_type&amp;do=$menu&amp;action=$action&amp;token=active")}">{$smarty.const.ANNOUNCE_TOKEN_ACTIVE} {$smarty.const.FORM_RESUMES_HEAD}</a>
				{/if}
			</li>
			<li class="{if ({counter}%2)}even{else}odd{/if}">
				{if $token eq 'moderate'}
					<a class="active">{$smarty.const.ANNOUNCE_TOKEN_MODERATE}</a>
				{else}
					<a href="{$chpu->createChpuUrl("`$smarty.const.CONF_SCRIPT_URL`index.php?ut=$user_type&amp;do=$menu&amp;action=$action&amp;token=moderate")}">{$smarty.const.ANNOUNCE_TOKEN_MODERATE}</a>
				{/if}
			</li>
			<li class="{if ({counter}%2)}even{else}odd{/if}">
				{if $token eq 'correction'}
					<a class="active">{$smarty.const.ANNOUNCE_TOKEN_CORRECTION}</a>
				{else}
					<a href="{$chpu->createChpuUrl("`$smarty.const.CONF_SCRIPT_URL`index.php?ut=$user_type&amp;do=$menu&amp;action=$action&amp;token=correction")}">{$smarty.const.ANNOUNCE_TOKEN_CORRECTION}</a>
				{/if}
			</li>
			<li class="{if ({counter}%2)}even{else}odd{/if}">
				{if $token eq 'payment'}
					<a class="active">{$smarty.const.ANNOUNCE_TOKEN_PAYMENT}</a>
				{else}
					<a href="{$chpu->createChpuUrl("`$smarty.const.CONF_SCRIPT_URL`index.php?ut=$user_type&amp;do=$menu&amp;action=$action&amp;token=payment")}">{$smarty.const.ANNOUNCE_TOKEN_PAYMENT}</a>
				{/if}
			</li>
			<li class="{if ({counter}%2)}even{else}odd{/if}">
				{if $token eq 'archived'}
					<a class="active">{$smarty.const.ANNOUNCE_TOKEN_ARCHIVED}</a>
				{else}
					<a href="{$chpu->createChpuUrl("`$smarty.const.CONF_SCRIPT_URL`index.php?ut=$user_type&amp;do=$menu&amp;action=$action&amp;token=archived")}">{$smarty.const.ANNOUNCE_TOKEN_ARCHIVED}</a>
				{/if}
			</li>
		</ul>
	</div>
{/if}