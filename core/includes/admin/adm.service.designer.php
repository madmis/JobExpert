<?php
/********************************************************
	JobExpert v1.0
	powered by Script Developers Group (SD-Group)
	email: info@sd-group.org.ua
	url: http://sd-group.org.ua/
	Copyright 2010-2015 (c) SD-Group
	All rights reserved
=========================================================
	Обслуживание сайта - Дизайн сайта
********************************************************/
/**
* @package
* @todo
*/

(!defined('SDG')) ? die('Triple protection!') : null;

// инициируем "Наименование страницы" отображаемое в форме
$arrNamePage = array(
						array('name' => MENU_ADMIN_MAIN, 'link' => CONF_ADMIN_FILE),
						array('name' => MENU_SERVICE, 'link' => false),
						array('name' => MENU_DESIGNER, 'link' => false)
					);

/**
* Действия
*/
if (isset($_GET['action']) && !empty($_GET['action']) && 'save' === $_GET['action'])
{
	// производим запись шаблона
	tools::recXmlTemplate($_POST);
}

$arrTemplates = array(
						'head_site'		=> array(
													'block.site.head.tpl' => array('header' => ADMIN_DESIGNER_BLOCK_HEADER, 'description' => ADMIN_DESIGNER_BLOCK_HEADER_DESCRIPTION)
						),

						'sides'			=> array(
													 'block.menu.tpl'=> array('header' => ADMIN_DESIGNER_BLOCK_MENU, 'description' => ADMIN_DESIGNER_BLOCK_MENU_DESCRIPTION),
													 'block.newses.last.tpl'=> array('header' => ADMIN_DESIGNER_BLOCK_LAST_NEWSES, 'description' => ADMIN_DESIGNER_BLOCK_LAST_NEWSES_DESCRIPTION),
													 'block.news.archive.tpl'=> array('header' => ADMIN_DESIGNER_BLOCK_NEWS_ARCHIVE, 'description' => ADMIN_DESIGNER_BLOCK_NEWS_ARCHIVE_DESCRIPTION),
													 'block.user.announces.tpl' => array('header' => ADMIN_DESIGNER_BLOCK_USER_ANNOUNCES, 'description' => ADMIN_DESIGNER_BLOCK_USER_ANNOUNCES_DESCRIPTION),
													 'block.user.vacancys.tpl' => array('header' => ADMIN_DESIGNER_BLOCK_USER_VACANCYS, 'description' => ADMIN_DESIGNER_BLOCK_USER_VACANCYS_DESCRIPTION),
													 'block.user.resumes.tpl' => array('header' => ADMIN_DESIGNER_BLOCK_USER_RESUMES, 'description' => ADMIN_DESIGNER_BLOCK_USER_RESUMES_DESCRIPTION),
													 'block.announces.navigator.tpl' => array('header' => ADMIN_DESIGNER_BLOCK_ANNOUNCES_NAVIGATOR, 'description' => ADMIN_DESIGNER_BLOCK_ANNOUNCES_NAVIGATOR_DESCRIPTION),
													 'block.announces.hot.tpl' => array('header' => ADMIN_DESIGNER_BLOCK_HOT_ANNOUNCES, 'description' => ADMIN_DESIGNER_BLOCK_HOT_ANNOUNCES_DESCRIPTION),
													 'block.vacancy.hot.tpl' => array('header' => ADMIN_DESIGNER_BLOCK_HOT_VACANCYS, 'description' => ADMIN_DESIGNER_BLOCK_HOT_VACANCYS_DESCRIPTION),
													 'block.resume.hot.tpl' => array('header' => ADMIN_DESIGNER_BLOCK_HOT_RESUMES, 'description' => ADMIN_DESIGNER_BLOCK_HOT_RESUMES_DESCRIPTION),
													 'block.authorize.tpl' => array('header' => ADMIN_DESIGNER_BLOCK_AUTHORIZE, 'description' => ADMIN_DESIGNER_BLOCK_AUTHORIZE_DESCRIPTION),
													 'block.statistics.tpl' => array('header' => ADMIN_DESIGNER_BLOCK_STATISTICS, 'description' => ADMIN_DESIGNER_BLOCK_STATISTICS_DESCRIPTION),
													 'block.who.online.tpl' => array('header' => ADMIN_DESIGNER_BLOCK_WHO_ONLINE, 'description' => ADMIN_DESIGNER_BLOCK_WHO_ONLINE_DESCRIPTION),
													 'block.user.articles.tpl' => array('header' => ADMIN_DESIGNER_BLOCK_USER_ARTICLES, 'description' => ADMIN_DESIGNER_BLOCK_USER_ARTICLES_DESCRIPTION),
													 'block.user.news.tpl' => array('header' => ADMIN_DESIGNER_BLOCK_USER_NEWS, 'description' => ADMIN_DESIGNER_BLOCK_USER_NEWS_DESCRIPTION),
													 'block.undefined1.tpl' => array('header' => ADMIN_DESIGNER_BLOCK_UNDEFINED1, 'description' => ADMIN_DESIGNER_BLOCK_UNDEFINED1_DESCRIPTION),
													 'block.undefined2.tpl' => array('header' => ADMIN_DESIGNER_BLOCK_UNDEFINED2, 'description' => ADMIN_DESIGNER_BLOCK_UNDEFINED2_DESCRIPTION),
													 'block.undefined3.tpl' => array('header' => ADMIN_DESIGNER_BLOCK_UNDEFINED3, 'description' => ADMIN_DESIGNER_BLOCK_UNDEFINED3_DESCRIPTION),
													 'advertisment' => array('header' => ADMIN_DESIGNER_BLOCK_ADVERTISMENT, 'description' => ADMIN_DESIGNER_BLOCK_ADVERTISMENT_DESCRIPTION)
						),

						'foot_site'		=> array(
													 'block.site.foot.tpl' => array('header' => ADMIN_DESIGNER_BLOCK_FOOTER, 'description' => ADMIN_DESIGNER_BLOCK_FOOTER_DESCRIPTION)
						)
					);

$smarty -> assignByRef('arrTemplates', $arrTemplates);

/********** Поключаем xml-файл с данными шаблона сайта **********/
$smarty -> assign('xmlTemplate', tools::getXmlTemplate());

$smarty -> assignByRef('errors', $arrErrors);
