<?php
/********************************************************
	JobExpert v1.0
	powered by Script Developers Group (SD-Group)
	email: info@sd-group.org.ua
	url: http://sd-group.org.ua/
	Copyright 2010-2015 (c) SD-Group
	All rights reserved
=========================================================
	Настройки - RSS
********************************************************/
/**
* @package
* @todo
*/

(!defined('SDG')) ? die ('Triple protection!') : null;

// инициируем "Наименование страницы" отображаемое в форме
$arrNamePage = array(
						array('name' => MENU_ADMIN_MAIN, 'link' => CONF_ADMIN_FILE),
						array('name' => MENU_CONFIG, 'link' => false),
						array('name' => MENU_CONFIG_RSS, 'link' => false)
					);

// сохраняем данные, переданные из формы
if (isset($_POST['save']))
{
	$data = "<?php\n\n"
		  . "(!defined('SDG')) ? die ('Triple protection!') : null;\n\n"
		  . 'define("CONF_RSS_NEWS_COUNT", "' . (((int) $_POST['news_count']) ? (int) $_POST['news_count'] : 10) . '");' . "\n\n"
		  . 'define("CONF_RSS_ARTICLES_COUNT", "' . (((int) $_POST['articles_count']) ? (int) $_POST['articles_count'] : 10) . '");' . "\n\n"
		  . 'define("CONF_RSS_VACANCY_COUNT", "' . (((int) $_POST['vacancy_count']) ? (int) $_POST['vacancy_count'] : 10) . '");' . "\n\n"
		  . 'define("CONF_RSS_RESUME_COUNT", "' . (((int) $_POST['resume_count']) ? (int) $_POST['resume_count'] : 10) . '");' . "\n";

	if (!tools::saveConfig('core/conf/const.config.rss.php', $data, CONF_ADMIN_FILE . '?m=config&s=rss'))
	{
		$arrErrors[] = ERROR_FILES_MISSING_FILE;
	}
}

$smarty -> assignByRef('errors', $arrErrors);
