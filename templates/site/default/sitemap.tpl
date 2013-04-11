{if $errors}{include file="errors.message.tpl"}{/if}
<div class="DesignMainPageBody">
	<ul type="disc">
		<li><a href="{$chpu->createChpuUrl("`$smarty.const.CONF_SCRIPT_URL`index.php?ut=$user_type")}" title="{$smarty.const.MENU_MAIN}">{$smarty.const.MENU_MAIN}</a></li>
		<li><a href="{$chpu->createChpuUrl("`$smarty.const.CONF_SCRIPT_URL`index.php?do=news")}" title="{$smarty.const.MENU_NEWS}">{$smarty.const.MENU_NEWS}</a></li>
		<li><a href="{$chpu->createChpuUrl("`$smarty.const.CONF_SCRIPT_URL`index.php?ut=$user_type&amp;do=articles")}" title="{$smarty.const.MENU_ARTICLES}">{$smarty.const.MENU_ARTICLES}</a></li>
		<li>{$smarty.const.MENU_ANNOUNCES}</li>
		<ul type="disc">
			<li><a href="{$chpu->createChpuUrl("`$smarty.const.CONF_SCRIPT_URL`index.php?ut=competitor&amp;do=vacancy")}" title="{$smarty.const.MENU_VACANCYS}">{$smarty.const.MENU_VACANCYS}</a></li>
			<ul type="disc">
				<li><a href="{$chpu->createChpuUrl("`$smarty.const.CONF_SCRIPT_URL`index.php?ut=competitor&amp;do=vacancy&amp;action=sections")}" title="{$smarty.const.MENU_ANNOUNCES_NAVIGATOR_ON_SECTIONS}">{$smarty.const.MENU_ANNOUNCES_NAVIGATOR_ON_SECTIONS}</a></li>
				<li><a href="{$chpu->createChpuUrl("`$smarty.const.CONF_SCRIPT_URL`index.php?ut=competitor&amp;do=vacancy&amp;action=regions")}" title="{$smarty.const.MENU_ANNOUNCES_NAVIGATOR_ON_REGIONS}">{$smarty.const.MENU_ANNOUNCES_NAVIGATOR_ON_REGIONS}</a></li>
				<li><a href="{$chpu->createChpuUrl("`$smarty.const.CONF_SCRIPT_URL`index.php?ut=competitor&amp;do=vacancy&amp;action=add")}" title="{$smarty.const.MENU_VACANCY_ADD}">{$smarty.const.MENU_VACANCY_ADD}</a></li>
				<li><a href="{$chpu->createChpuUrl("`$smarty.const.CONF_SCRIPT_URL`index.php?ut=competitor&amp;do=search.vacancy")}" title="{$smarty.const.MENU_ADVANCED_SEARCH_VACANCY}">{$smarty.const.MENU_ADVANCED_SEARCH_VACANCY}</a></li>
			</ul>

			<li><a href="{$chpu->createChpuUrl("`$smarty.const.CONF_SCRIPT_URL`index.php?ut=employer&amp;do=resume")}" title="{$smarty.const.MENU_RESUMES}">{$smarty.const.MENU_RESUMES}</a></li>
			<ul type="disc">
				<li><a href="{$chpu->createChpuUrl("`$smarty.const.CONF_SCRIPT_URL`index.php?ut=employer&amp;do=resume&amp;action=sections")}" title="{$smarty.const.MENU_ANNOUNCES_NAVIGATOR_ON_SECTIONS}">{$smarty.const.MENU_ANNOUNCES_NAVIGATOR_ON_SECTIONS}</a></li>
				<li><a href="{$chpu->createChpuUrl("`$smarty.const.CONF_SCRIPT_URL`index.php?ut=employer&amp;do=resume&amp;action=regions")}" title="{$smarty.const.MENU_ANNOUNCES_NAVIGATOR_ON_REGIONS}">{$smarty.const.MENU_ANNOUNCES_NAVIGATOR_ON_REGIONS}</a></li>
				<li><a href="{$chpu->createChpuUrl("`$smarty.const.CONF_SCRIPT_URL`index.php?ut=employer&amp;do=resume&amp;action=add")}" title="{$smarty.const.MENU_RESUME_ADD}">{$smarty.const.MENU_RESUME_ADD}</a></li>
				<li><a href="{$chpu->createChpuUrl("`$smarty.const.CONF_SCRIPT_URL`index.php?ut=employer&amp;do=search.resume")}" title="{$smarty.const.MENU_ADVANCED_SEARCH_RESUME}">{$smarty.const.MENU_ADVANCED_SEARCH_RESUME}</a></li>
			</ul>

		</ul>
		<li><a href="{$chpu->createChpuUrl("`$smarty.const.CONF_SCRIPT_URL`index.php?ut=$user_type&amp;do=search")}" title="{$smarty.const.MENU_SEARCH}">{$smarty.const.MENU_SEARCH}</a></li>
		<li><a href="{$chpu->createChpuUrl("`$smarty.const.CONF_SCRIPT_URL`index.php?ut=$user_type&amp;do=feedback")}" title="{$smarty.const.MENU_FEEDBACK}">{$smarty.const.MENU_FEEDBACK}</a></li>
		<li><a href="{$chpu->createChpuUrl("`$smarty.const.CONF_SCRIPT_URL`index.php?ut=$user_type&amp;do=rss")}" title="{$smarty.const.MENU_RSS}">{$smarty.const.MENU_RSS}</a></li>
		<ul type="disc">
			<li><a href="{$chpu->createChpuUrl("`$smarty.const.CONF_SCRIPT_URL`index.php?ut=competitor&amp;do=rss&amp;action=vacancy")}" title="{$smarty.const.MENU_VACANCYS}">{$smarty.const.MENU_VACANCYS}</a></li>
			<li><a href="{$chpu->createChpuUrl("`$smarty.const.CONF_SCRIPT_URL`index.php?ut=employer&amp;do=rss&amp;action=resume")}" title="{$smarty.const.MENU_RESUMES}">{$smarty.const.MENU_RESUMES}</a></li>
			<li><a href="{$chpu->createChpuUrl("`$smarty.const.CONF_SCRIPT_URL`index.php?do=rss&amp;action=news")}" title="{$smarty.const.MENU_NEWS}">{$smarty.const.MENU_NEWS}</a></li>
			<li><a href="{$chpu->createChpuUrl("`$smarty.const.CONF_SCRIPT_URL`index.php?ut=$user_type&amp;do=rss&amp;action=articles")}" title="{$smarty.const.MENU_ARTICLES}">{$smarty.const.MENU_ARTICLES}</a></li>
		</ul>
		{* ------------------------ *}
		{if $dop_pages}
		{foreach from=$dop_pages item="page"}
		<li><a href="{$chpu->createChpuUrl("`$smarty.const.CONF_SCRIPT_URL`index.php?do=pages&amp;action=view&amp;id=`$page.id`")}" title="{$page.title|escape}">{$page.title}</a></li>
		{/foreach}
		{/if}
	</ul>
</div>
