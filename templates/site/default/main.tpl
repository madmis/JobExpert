<div class="DesignMainPageBody">
	<br>
	{if $user_type eq 'agent' OR $user_type eq 'competitor'}
		{include file='block.main.scrollable.vacancys.hot.tpl'}
	{else}
		{include file='block.main.scrollable.resumes.hot.tpl'}
	{/if}
	<p class="shadow12">
		Проект создан группой разработчиков SD-Group - мы занимаемся разработкой и продвижением готовых решений для создания web-сайтов с тематикой "Board of bulletins" - доски объявлений.
	</p>

	<p class="shadow12">
		<img src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/design/arrInCirclce.png" alt="">
		<strong class="titleJob">Job</strong> <strong class="titleExpert">Expert</strong> - является скриптом, специализирующимся на поиске работы для частных лиц, а также подборе персонала для организаций и рекрутинговых агентств.
	</p>

	<p class="shadow12">
		<img src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/design/arrInCirclce.png" alt="">
		<strong class="titleJob">Job</strong> <strong class="titleExpert">Expert</strong> - предназначен для Вас, владельцев ресурсов размещенных в глобальной сети Интернет.
	</p>

	{* Выводим VIP-объявления *}
	{if $smarty.const.CONF_VACANCY_VIP_SHOW || $smarty.const.CONF_RESUME_VIP_SHOW}{include file='block.main.announces.vip.tpl'}<br>{/if}

	{if !$user_email}
		<img src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/design/arrInCirclce.png" alt="">
		<strong class="shadow12">Тестовые аккаунты зарегистрированные в системе</strong>

		<table class="mainBodyTable" cellspacing="0">
			<tr>
				<th>&nbsp;</th>
				<th>Администратор</th>
				<th>Соискатель</th>
				<th>Работодатель</th>
				<th>Агентство</th>
				<th>Компания</th>
			</tr>
			<tr>
				<td><img src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/design/mainBodyTableUser.gif" alt=""></td>
				<td><strong>admin</strong></td>
				<td><strong>competitor@c.com</strong></td>
				<td><strong>employer@c.com</strong></td>
				<td><strong>agent@c.com</strong></td>
				<td class="last"><strong>company@c.com</strong></td>
			</tr>
			<tr>
				<td><img src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/design/mainBodyTableZamok.gif" alt=""></td>
				<td><strong>admin</strong></td>
				<td><strong>competitor</strong></td>
				<td><strong>employer</strong></td>
				<td><strong>agent</strong></td>
				<td class="last"><strong>company</strong></td>
			</tr>
			<tr>
				<td><img src="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.TEMPLATE_PATH}images/design/mainBodyTableEarth.png" alt=""></td>
				<td>
					<div class="ContentWrapper" align="center">
						<form action="{$smarty.const.CONF_SCRIPT_URL}{$smarty.const.CONF_ADMIN_FILE}" method="post" enctype="multipart/form-data">
							<input type="hidden" name="login" value="admin">
							<input type="hidden" name="password" value="admin">
							<div class="enterButtonLight">
								<input type="submit" class="shadow01red" name="authorize" value="{$smarty.const.FORM_BUTTON_LOGIN}">
							</div>
						</form>
					</div>
				</td>
				<td>
					<div class="ContentWrapper" align="center">
						<form action="{$chpu->createChpuUrl("`$smarty.const.CONF_SCRIPT_URL`index.php?do=authorize")}" method="post" enctype="multipart/form-data">
							<input type="hidden" name="email" value="competitor@c.com">
							<input type="hidden" name="password" value="competitor">
							<div class="enterButtonLight">
								<input type="submit" class="shadow01red" value="{$smarty.const.FORM_BUTTON_LOGIN}">
							</div>
						</form>
					</div>
				</td>
				<td>
					<div class="ContentWrapper" align="center">
						<form action="{$chpu->createChpuUrl("`$smarty.const.CONF_SCRIPT_URL`index.php?do=authorize")}" method="post" enctype="multipart/form-data">
							<input type="hidden" name="email" value="employer@c.com">
							<input type="hidden" name="password" value="employer">
							<div class="enterButtonLight">
								<input type="submit" class="shadow01red" value="{$smarty.const.FORM_BUTTON_LOGIN}">
							</div>
						</form>
					</div>
				</td>
				<td>
					<div class="ContentWrapper" align="center">
						<form action="{$chpu->createChpuUrl("`$smarty.const.CONF_SCRIPT_URL`index.php?do=authorize")}" method="post" enctype="multipart/form-data">
							<input type="hidden" name="email" value="agent@c.com">
							<input type="hidden" name="password" value="agent">
							<div class="enterButtonLight">
								<input type="submit" class="shadow01red" value="{$smarty.const.FORM_BUTTON_LOGIN}">
							</div>
						</form>
					</div>
				</td>
				<td class="last">
					<div class="ContentWrapper" align="center">
						<form action="{$chpu->createChpuUrl("`$smarty.const.CONF_SCRIPT_URL`index.php?do=authorize")}" method="post" enctype="multipart/form-data">
							<input type="hidden" name="email" value="company@c.com">
							<input type="hidden" name="password" value="company">
							<div class="enterButtonLight">
								<input type="submit" class="shadow01red" value="{$smarty.const.FORM_BUTTON_LOGIN}">
							</div>
						</form>
					</div>
				</td>
			</tr>
		</table>
	{/if}
	<div class="AttentionWrapper"><div class="Attention shadow12">
		Просьба не менять настройки, которые могут повлиять на работу скрипта. Не удалять имеющиеся дополнительные страницы и новости. Можно добавлять и удалять свои записи.
	</div></div>

	<p class="shadow12 paddingText5">
		Просим активно высказывать свои пожелания, предложения, замечания!!!<br>
		Все вопросы, касательно анкет добавления объявлений, размещать в соответствующих темах:
	</p>

	<div class="resumeLeft shadow12">
		<strong>Резюме:</strong>
		<a href="http://sd-group.org.ua/index.php?topic=5.0">http://sd-group.org.ua/index.php?topic=5.0</a>
	</div>

	<div class="vacancyRight shadow12">
		<strong>Вакансии:</strong>
		<a href="http://sd-group.org.ua/index.php?topic=4.0">http://sd-group.org.ua/index.php?topic=4.0</a>
	</div>

	<div class="clearLeft">&nbsp;</div>

	{* Выводим логотипы организаций *}
	{if $mainLogo}{include file='block.main.logo.tpl'}{/if}
	{* Выводим логотипы агентств *}
	{if $mainAgnLogo}{include file='block.main.agencies.logo.tpl'}{/if}

	{* Выводим последние объявления *}
	{if $smarty.const.CONF_VACANCY_LAST_SHOW || $smarty.const.CONF_RESUME_LAST_SHOW}{include file='block.main.announces.last.tpl'}<br>{/if}

	{* Выводим Последние новости *}
	{if $smarty.const.CONF_NEWSES_LAST_SHOW}{include file='block.main.newses.last.tpl'}<br>{/if}
</div>