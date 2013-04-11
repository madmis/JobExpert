<?php
/********************************************************
	JobExpert v1.0
	powered by Script Developers Group (SD-Group)
	email: info@sd-group.org.ua
	url: http://sd-group.org.ua/
	Copyright 2010-2015 (c) SD-Group
	All rights reserved
=========================================================
	RSS
********************************************************/
/**
* @package
* @todo
*/

(!defined('SDG')) ? die ('Triple protection!') : null;

/**
* иницализация массива подключаемых шаблонов: по умолчанию все значения - false
* для подключения шаблона, необходимо установить значение - true
* шаблоны подключаются в порядке установленном в файле головного шаблона
*/
$arrAction = array(
						'news'		=> false,
						'articles'	=> false,
						'vacancy'	=> false,
						'resume'	=> false
                    );

// определяем контент для отображения
(isset($_GET['action']) && isset($arrAction[$_GET['action']])) ? $arrAction[$_GET['action']] = true : null;

/**
* Показываем НОВОСТИ
*/
if ($arrAction['news'])
{
	$rss = new rss();
	header("Content-type: application/rss+xml");
	echo $rss -> rssNews();
	exit;
}

/**
* Показываем СТАТЬИ
*/
elseif ($arrAction['articles'])
{
	$rss = new rss();
	header("Content-type: application/rss+xml");

	if (isset($_GET['subaction']) && 'section' === $_GET['subaction'] && !empty($_GET['id']) && $id = chpu::getId_out_tId($_GET['id']))
	{
		echo $rss -> rssArticles($id);
	}
	else
	{
		echo $rss -> rssArticles();
	}
	exit;
}

/**
* Показываем ВАКАНСИИ
*/
elseif ($arrAction['vacancy'])
{
	// инициируем объект
	$rss = new rss();
	header("Content-type: application/rss+xml");

	if (isset($_GET['subaction']) && ('section' === $_GET['subaction'] || 'region' === $_GET['subaction']) && isset($_GET['id']) && (int) abs($_GET['id']))
	{
		echo $rss -> rssVacancy($_GET['subaction'], $_GET['id']);
	}
	else
	{
		echo $rss -> rssVacancy();
	}
	exit;
}

/**
* Показываем РЕЗЮМЕ
*/
elseif ($arrAction['resume'])
{
	// инициируем объект
	$rss = new rss();
	header("Content-type: application/rss+xml");

	if (isset($_GET['subaction']) && ('section' === $_GET['subaction'] || 'region' === $_GET['subaction']) && isset($_GET['id']) && (int) abs($_GET['id']))
	{
		echo $rss -> rssResume($_GET['subaction'], $_GET['id']);
	}
	else
	{
		echo $rss -> rssResume();
	}
	exit;
}
else
{

}

$smarty -> assignByRef('action', $arrAction);