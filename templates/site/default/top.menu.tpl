
{* Верхнее сабменю *}

<ul class="DesignTopSubMenu">

     <li class="delimiter">&nbsp;</li>

     {counter start=0 print=false}
     {* ------------------------ *}

     <li class="{if ({counter}%2)}even{else}odd{/if}">
     <div class="delimiter">
     {if $menu eq 'main'}
          <a class="active">{$smarty.const.MENU_MAIN}</a>
     {else}
          <a href="{$chpu->createChpuUrl("`$smarty.const.CONF_SCRIPT_URL`index.php?ut=$user_type")}">{$smarty.const.MENU_MAIN}</a>
     {/if}
     </div>
     </li>

     {* ------------------------ *}

 	 {if $user_type neq 'competitor'}
        <li class="{if ({counter}%2)}even{else}odd{/if}">
         <div class="delimiter">
	    {if $menu eq 'add_vacancy'}
            <a class="active">{$smarty.const.MENU_VACANCY_ADD}</a>
        {else}
            <a href="{$chpu->createChpuUrl("`$smarty.const.CONF_SCRIPT_URL`index.php?ut=$user_type&amp;do=vacancy&amp;action=add")}">{$smarty.const.MENU_VACANCY_ADD}</a>
        {/if}
        </div>
        </li>
	 {/if}

     {* ------------------------ *}

     {if $user_type eq 'competitor' OR $user_type eq 'agent'}
         <li class="{if ({counter}%2)}even{else}odd{/if}">
         <div class="delimiter">
         {if $menu eq 'add_resume'}
             <a class="active">{$smarty.const.MENU_RESUME_ADD}</a>
         {else}
             <a href="{$chpu->createChpuUrl("`$smarty.const.CONF_SCRIPT_URL`index.php?ut=$user_type&amp;do=resume&amp;action=add")}">{$smarty.const.MENU_RESUME_ADD}</a>
         {/if}
         </div>
         </li>
     {/if}

     {* ------------------------ *}

	 {* ПОИСК *}
     <li class="{if ({counter}%2)}even{else}odd{/if}">
     <div class="delimiter">
	 {if $user_type eq 'agent'}
		{if $menu eq 'search'}
            <a class="active">{$smarty.const.MENU_SEARCH}</a>
        {else}
            <a href="{$chpu->createChpuUrl("`$smarty.const.CONF_SCRIPT_URL`index.php?ut=$user_type&amp;do=search")}">{$smarty.const.MENU_SEARCH}</a>
        {/if}
	 {elseif $user_type eq 'employer' OR $user_type eq 'company'}
		{if $menu eq 'search'}
            <a class="active">{$smarty.const.MENU_SEARCH_RESUME}</a>
        {else}
            <a href="{$chpu->createChpuUrl("`$smarty.const.CONF_SCRIPT_URL`index.php?ut=$user_type&amp;do=search")}">{$smarty.const.MENU_SEARCH_RESUME}</a>
        {/if}
	 {elseif $user_type eq 'competitor'}
		{if $menu eq 'search'}
            <a class="active">{$smarty.const.MENU_SEARCH_VACANCY}</a>
        {else}
            <a href="{$chpu->createChpuUrl("`$smarty.const.CONF_SCRIPT_URL`index.php?ut=$user_type&amp;do=search")}">{$smarty.const.MENU_SEARCH_VACANCY}</a>
        {/if}
	 {/if}
     </div>
     </li>

     {* ------------------------ *}

     <li class="{if ({counter}%2)}even{else}odd{/if}">
     <div class="delimiter">
     {if $menu eq 'articles'}
        <a class="active">{$smarty.const.MENU_ARTICLES}</a>
     {else}
        <a href="{$chpu->createChpuUrl("`$smarty.const.CONF_SCRIPT_URL`index.php?ut=$user_type&amp;do=articles")}">{$smarty.const.MENU_ARTICLES}</a>
     {/if}
     </div>
     </li>

     {* ------------------------ *}

     <li class="{if ({counter}%2)}even{else}odd{/if}">
     <div class="delimiter">
     {if $menu eq 'companies'}
        <a class="active">{$smarty.const.MENU_COMPANIES}</a>
     {else}
        <a href="{$chpu->createChpuUrl("`$smarty.const.CONF_SCRIPT_URL`index.php?do=companies")}">{$smarty.const.MENU_COMPANIES}</a>
     {/if}
     </div>
     </li>

     {* ------------------------ *}

     <li class="{if ({counter}%2)}even{else}odd{/if}">
     <div class="delimiter">
     {if $menu eq 'agencies'}
        <a class="active">{$smarty.const.MENU_AGENCIES}</a>
     {else}
        <a href="{$chpu->createChpuUrl("`$smarty.const.CONF_SCRIPT_URL`index.php?do=agencies")}">{$smarty.const.MENU_AGENCIES}</a>
     {/if}
     </div>
     </li>

     {* ------------------------ *}

	{if !$user_email}
     	<li class="right">
			{if $user_type eq 'competitor'}
				<a href="{$chpu->createChpuUrl("`$smarty.const.CONF_SCRIPT_URL`index.php?ut=employer")}">{$smarty.const.MENU_EMPLOYER} <span class="arr">&rarr;</span></a>
			{elseif $user_type eq 'employer'}
				<a href="{$chpu->createChpuUrl("`$smarty.const.CONF_SCRIPT_URL`index.php?ut=competitor")}">{$smarty.const.MENU_COMPETITOR} <span class="arr">&rarr;</span></a>
			{/if}
     	</li>
	 {/if}
</ul>

{* Панели верхнего сабменю *}

{* Показываем на всех пунктах меню или {if $menu eq 'main'}*}
{if $smarty.const.CONF_USER_REGISTER}
	<div class="DesignSubMenuPanelAuth"> {* Панель авторизации *}
		{if $user_email}
			<table>
				<tr>
					<th>{$smarty.const.SITE_USER_PANEL}</th>
					<td>&nbsp;&nbsp;</td>
					<td>{$user_email}</td>
					<td><img src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/design/topMenuLinksDelimiter.png" alt=""></td>
					<td>{if $menu eq 'user.data'}{$smarty.const.MENU_USER_DATA}{else}<a href="{$chpu->createChpuUrl("`$smarty.const.CONF_SCRIPT_URL`index.php?ut=$user_type&amp;do=user.data")}">{$smarty.const.MENU_USER_DATA}</a>{/if}</td>
					<td><img src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/design/topMenuLinksDelimiter.png" alt=""></td>
				{if $user_type eq 'employer' || $user_type eq 'company' || $user_type eq 'agent'}
					<td>{if $menu eq 'user.announces' && $action eq 'vacancy'}{$smarty.const.MENU_MY_VACANCYS}{else}<a href="{$chpu->createChpuUrl("`$smarty.const.CONF_SCRIPT_URL`index.php?ut=$user_type&amp;do=user.announces&amp;action=vacancy&amp;token=active")}">{$smarty.const.MENU_MY_VACANCYS}</a>{/if}</td>
					<td><img src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/design/topMenuLinksDelimiter.png" alt=""></td>
				{/if}
				{if $user_type eq 'competitor' || $user_type eq 'agent'}
					<td>{if $menu eq 'user.announces' && $action eq 'resume'}{$smarty.const.MENU_MY_RESUMES}{else}<a href="{$chpu->createChpuUrl("`$smarty.const.CONF_SCRIPT_URL`index.php?ut=$user_type&amp;do=user.announces&amp;action=resume&amp;token=active")}">{$smarty.const.MENU_MY_RESUMES}</a>{/if}</td>
					<td><img src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/design/topMenuLinksDelimiter.png" alt=""></td>
				{/if}
					<td>{if $menu eq 'subscription'}{$smarty.const.MENU_SUBSCRIPTION}{else}<a href="{$chpu->createChpuUrl("`$smarty.const.CONF_SCRIPT_URL`index.php?ut=$user_type&amp;do=subscription")}">{$smarty.const.MENU_SUBSCRIPTION}</a>{/if}</td>
					<td><img src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/design/topMenuLinksDelimiter.png" alt=""></td>
				{if $codex.rights.add_news}
					<td>{if $menu eq 'user.news'}{$smarty.const.MENU_MY_NEWS}{else}<a href="{$chpu->createChpuUrl("`$smarty.const.CONF_SCRIPT_URL`index.php?ut=$user_type&amp;do=user.news&amp;action=active")}">{$smarty.const.MENU_MY_NEWS}</a>{/if}</td>
					<td><img src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/design/topMenuLinksDelimiter.png" alt=""></td>
				{/if}
				{if $codex.rights.add_articles}
					<td>{if $menu eq 'user.articles'}{$smarty.const.MENU_MY_ARTICLES}{else}<a href="{$chpu->createChpuUrl("`$smarty.const.CONF_SCRIPT_URL`index.php?ut=$user_type&amp;do=user.articles&amp;action=active")}">{$smarty.const.MENU_MY_ARTICLES}</a>{/if}</td>
					<td><img src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/design/topMenuLinksDelimiter.png" alt=""></td>
				{/if}
					<td>{if $menu eq 'change.password'}{$smarty.const.MENU_CHANGE_PASSWORD}{else}<a href="{$chpu->createChpuUrl("`$smarty.const.CONF_SCRIPT_URL`index.php?ut=$user_type&amp;do=change.password")}">{$smarty.const.MENU_CHANGE_PASSWORD}</a>{/if}</td>
					<td><img src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/design/topMenuLinksDelimiter.png" alt=""></td>
					<td><a href="{$chpu->createChpuUrl("`$smarty.const.CONF_SCRIPT_URL`index.php?ut=$user_type&amp;do=logout")}">{$smarty.const.MENU_LOGOUT}</a></td>
				</tr>
			</table>
		{else}
			<form action="{$chpu->createChpuUrl("`$smarty.const.CONF_SCRIPT_URL`index.php?ut=$user_type&amp;do=authorize")}" method="post" enctype="multipart/form-data">
				<table>
					<tr>
						{if $menu neq 'authorize'}
						<th>{$smarty.const.MENU_AUTHORIZE}</th>
						<td>&nbsp;&nbsp;</td>
						<td><input class="text" type="text" name="email" size="20" value="{$smarty.const.FORM_EMAIL}"></td>
						<td><input class="text" type="password" name="password" size="20" value="{$smarty.const.FORM_PASSWORD}"></td>
						<td><input type="checkbox" name="remember"></td>
						<td>{$smarty.const.FORM_REMEMBER}</td>
						<td>
							<div class="submitButtonDark">
								<input type="submit" class="shadow01red" value="{$smarty.const.FORM_BUTTON_LOGIN}">
							</div>
						</td>
						<td>&nbsp;&nbsp;</td>
						{/if}
						<td>{if $menu eq 'register'}{$smarty.const.MENU_REGISTER}{else}<a class="ddlink" href="{$chpu->createChpuUrl("`$smarty.const.CONF_SCRIPT_URL`index.php?ut=$user_type&amp;do=register")}">{$smarty.const.MENU_REGISTER}</a>{/if}</td>
						<td><img src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/design/topMenuLinksDelimiter.png" alt=""></td>
						<td>{if $menu eq 'new.pass'}{$smarty.const.MENU_FORGOT_PASSWORD}{else}<a class="ddlink" href="{$chpu->createChpuUrl("`$smarty.const.CONF_SCRIPT_URL`index.php?ut=$user_type&amp;do=new.pass")}">{$smarty.const.MENU_FORGOT_PASSWORD}</a>{/if}</td>
					</tr>
				</table>
			</form>

			<script type="text/javascript">
			<!--
				$(function() {
					$('input[name="email"]').focus( function() {
						if ($(this).val() == '{$smarty.const.FORM_EMAIL}') {
							$('input[name="email"]').val('');
							$('input[name="password"]').val('');
						}
					});

					$('input[name="email"]').blur( function() {
						if (!$(this).val()) {
							$('input[name="email"]').val('{$smarty.const.FORM_EMAIL}');
							$('input[name="password"]').val('{$smarty.const.FORM_PASSWORD}');
						}
					});
				});
			-->
			</script>
		{/if}
	</div>
{/if}
