<div style="height: 2px; background-color:#CC0000;"></div>
<div id="footerMenu">
	<div class="parts">
		<h6>Сайт</h6>
		<ul>
			<li><a href="{$smarty.const.CONF_SCRIPT_URL}">Главная страница</a></li>
			<li><a href="{$chpu->createChpuUrl("`$smarty.const.CONF_SCRIPT_URL`index.php?do=pages&amp;action=view&amp;id=about")}">О нас</a></li>
			<li><a href="{$chpu->createChpuUrl("`$smarty.const.CONF_SCRIPT_URL`index.php?do=news")}">Новости сайта</a></li>
			<li><a href="{$chpu->createChpuUrl("`$smarty.const.CONF_SCRIPT_URL`index.php?do=feedback")}">Обратная связь</a></li>
			<li><a href="{$chpu->createChpuUrl("`$smarty.const.CONF_SCRIPT_URL`index.php?do=pages&amp;action=view&amp;id=jobexpert")}">О скрипте JobExpert</a></li>
			<li><a href="{$chpu->createChpuUrl("`$smarty.const.CONF_SCRIPT_URL`index.php?do=pages&amp;action=view&amp;id=byscript")}">Купить скрипт</a></li>
			<li><a href="{$chpu->createChpuUrl("`$smarty.const.CONF_SCRIPT_URL`index.php?do=sitemap")}">Карта сайта</a></li>
			<li><a href="{$chpu->createChpuUrl("`$smarty.const.CONF_SCRIPT_URL`index.php?do=sitemap&amp;action=xml")}">XML-карта сайта</a></li>
		</ul>
    </div>
	<div class="parts">
		<h6>Пользователям</h6>
		<ul>
			<li><a href="{$chpu->createChpuUrl("`$smarty.const.CONF_SCRIPT_URL`index.php?ut=$user_type&amp;do=register")}">Регистрация</a></li>
			<li><a href="{$chpu->createChpuUrl("`$smarty.const.CONF_SCRIPT_URL`index.php?ut=$user_type&amp;do=authorize")}">Аторизация</a></li>
		</ul>
    </div>
	<div class="parts">
		<h6>Соискателю</h6>
		<ul>
			<li><a href="{$chpu->createChpuUrl("`$smarty.const.CONF_SCRIPT_URL`index.php?ut=competitor&amp;do=search.vacancy")}">Поиск вакансий</a></li>
			<li><a href="{$chpu->createChpuUrl("`$smarty.const.CONF_SCRIPT_URL`index.php?ut=competitor&amp;do=resume&amp;action=add")}">Опубликовать резюме</a></li>
			<li><a href="{$chpu->createChpuUrl("`$smarty.const.CONF_SCRIPT_URL`index.php?ut=competitor&amp;do=articles")}">Статьи</a></li>
			<li><a href="{$chpu->createChpuUrl("`$smarty.const.CONF_SCRIPT_URL`index.php?ut=competitor&amp;do=companies")}">Компании</a></li>
		</ul>
    </div>
	<div class="parts">
		<h6>Работодателю</h6>
		<ul>
			<li><a href="{$chpu->createChpuUrl("`$smarty.const.CONF_SCRIPT_URL`index.php?ut=employer&amp;do=search.resume")}">Поиск резюме</a></li>
			<li><a href="{$chpu->createChpuUrl("`$smarty.const.CONF_SCRIPT_URL`index.php?ut=employer&amp;do=vacancy&amp;action=add")}">Опубликовать вакансию</a></li>
			<li><a href="{$chpu->createChpuUrl("`$smarty.const.CONF_SCRIPT_URL`index.php?ut=employer&amp;do=articles")}">Статьи</a></li>
		</ul>
    </div>
	<div class="parts">
		<h6>Дополнительные сервисы</h6>
		<ul>
			<li><a href="{$chpu->createChpuUrl("`$smarty.const.CONF_SCRIPT_URL`index.php?do=companies")}">Каталог компаний</a></li>
			<li><a href="{$chpu->createChpuUrl("`$smarty.const.CONF_SCRIPT_URL`index.php?do=agencies")}">Каталог рекрутинговых агентств</a></li>
			<li><a href="{$chpu->createChpuUrl("`$smarty.const.CONF_SCRIPT_URL`index.php?do=payments")}">Виды оплат</a></li>
			<li><a href="{$chpu->createChpuUrl("`$smarty.const.CONF_SCRIPT_URL`index.php?do=news&amp;action=archive")}">Архив новостей</a></li>
			<li><a href="{$chpu->createChpuUrl("`$smarty.const.CONF_SCRIPT_URL`index.php?do=rss")}">RSS</a></li>
			<li><a href="{$chpu->createChpuUrl("`$smarty.const.CONF_SCRIPT_URL`index.php?do=rss&amp;action=news")}">RSS новости</a></li>
			<li><a href="{$chpu->createChpuUrl("`$smarty.const.CONF_SCRIPT_URL`index.php?do=rss&amp;action=articles")}">RSS статьи</a></li>
			<li><a href="{$chpu->createChpuUrl("`$smarty.const.CONF_SCRIPT_URL`index.php?do=rss&amp;action=vacancy")}">RSS вакансии</a></li>
			<li><a href="{$chpu->createChpuUrl("`$smarty.const.CONF_SCRIPT_URL`index.php?do=rss&amp;action=resume")}">RSS резюме</a></li>
		</ul>
    </div>
</div>