{if $smarty.const.CONF_USER_REGISTER && $user_email}
	<div class="DesignLeftSideBarBlockWrapper">
		<h3 class="sideBlockHeader" id="authorize">{$smarty.const.SITE_USER_PANEL}</h3>
		<ul>

			{counter start=0 print=false}

			{* ------------------------ *}
			<li class="{if ({counter}%2)}even{else}odd{/if}">
				<div>{$user_email}</div>
			</li>

			{* ------------------------ *}
			<li class="{if ({counter}%2)}even{else}odd{/if}">
				{if $menu eq 'user.data'}
					<div>{$smarty.const.MENU_USER_DATA}</div>
				{else}
					<a href="{$chpu->createChpuUrl("`$smarty.const.CONF_SCRIPT_URL`index.php?ut=$user_type&amp;do=user.data")}">{$smarty.const.MENU_USER_DATA}</a>
				{/if}
			</li>

			{* ------------------------ *}
			<li class="{if ({counter}%2)}even{else}odd{/if}">
				{if $menu eq 'change.password'}
					<div>{$smarty.const.MENU_CHANGE_PASSWORD}</div>
				{else}
					<a href="{$chpu->createChpuUrl("`$smarty.const.CONF_SCRIPT_URL`index.php?ut=$user_type&amp;do=change.password")}">{$smarty.const.MENU_CHANGE_PASSWORD}</a>
				{/if}
			</li>

			{* ------------------------ *}
			<li class="{if ({counter}%2)}even{else}odd{/if}">
				{if $menu eq 'subscription'}
					<div>{$smarty.const.MENU_SUBSCRIPTION}</div>
				{else}
					<a href="{$chpu->createChpuUrl("`$smarty.const.CONF_SCRIPT_URL`index.php?ut=$user_type&amp;do=subscription")}">{$smarty.const.MENU_SUBSCRIPTION}</a>
				{/if}
			</li>

			{* ------------------------ *}
			<li class="{if ({counter}%2)}even{else}odd{/if}">
				<a href="{$chpu->createChpuUrl("`$smarty.const.CONF_SCRIPT_URL`index.php?ut=$user_type&amp;do=logout")}">{$smarty.const.MENU_LOGOUT}</a>
			</li>

		</ul>
	</div>
{elseif $smarty.const.CONF_USER_REGISTER}
	<div class="DesignLeftSideBarBlockWrapper">
		<h3 class="sideBlockHeader" id="authorize">{$smarty.const.MENU_AUTHORIZE}</h3>
		<div class="ContentWrapper">
			<form action="{$chpu->createChpuUrl("`$smarty.const.CONF_SCRIPT_URL`index.php?ut=$user_type&amp;do=authorize")}" method="post" enctype="multipart/form-data">
				{$smarty.const.FORM_EMAIL}<br>
				<input type="text" name="email" size="20" value=""><br>
				{$smarty.const.FORM_PASSWORD}<br>
				<input type="password" name="password" size="20" value=""><br>
				<input type="checkbox" name="remember">{$smarty.const.FORM_REMEMBER}<br><br>
				<div class="submitButtonLight">
					<input type="submit" class="shadow01red" value="{$smarty.const.FORM_BUTTON_LOGIN}">
				</div>
			</form>
			<br>
			{if $menu eq 'register'}
				{$smarty.const.MENU_REGISTER}
			{else}
				<a href="{$chpu->createChpuUrl("`$smarty.const.CONF_SCRIPT_URL`index.php?ut=$user_type&amp;do=register")}">{$smarty.const.MENU_REGISTER}</a>
			{/if}
			<span style="color:#666666;">|</span>
			{if $menu eq 'new.pass'}
				{$smarty.const.MENU_FORGOT_PASSWORD}
			{else}
				<a href="{$chpu->createChpuUrl("`$smarty.const.CONF_SCRIPT_URL`index.php?ut=$user_type&amp;do=new.pass")}">{$smarty.const.MENU_FORGOT_PASSWORD}</a>
			{/if}
		</div>
	</div>
{/if}