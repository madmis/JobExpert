<?php

/**
 * Powered by Script Developers Group (SD-Group)
 * Email: info@sd-group.org.ua
 * URL: http://sd-group.org.ua/
 * Copyright 2009 (c) SD-Group
 * All rights reserved
 * ===================================================
 * Новости
 * ===================================================
 * @package
 *
 * @todo
 *
 */
(!defined('SDG')) ? die('Triple protection!') : null;

/**
 * Проверяем наличие ошибки 404
 */
if (!empty($_GET['error404'])) {
	messages::error404();
}

/**
 * Иницализация массива подключаемых шаблонов: по умолчанию все значения - false
 * Для подключения шаблона, необходимо установить значение - true
 * Шаблоны подключаются в порядке установленном в файле головного шаблона
 */
$arrAction = array(
	'view' => false,
	'archive' => false
);

// определяем шаблон для отображения
if (isset($_GET['action']) && 'offset' != $_GET['action']) {
	if (isset($arrAction[$_GET['action']])) {
		$arrAction[$_GET['action']] = true;
	} else {
		messages::error404();
	}
}
/**
 * отображение шаблона по умолчанию
 */ elseif (isset($_GET['do']) && 'news' == $_GET['do']) {
	//смещение, всегда 0 (затем берется из $_GET)
	$offset = (!empty($_GET['offset']) && validate::checkNaturalNumber($_GET['offset'])) ? validate::checkNaturalNumber($_GET['offset']) : 0;
	//получаем массив, содержащий текущий обработанный URL
	$path = CONF_SCRIPT_URL . 'index.php?do=news&amp;action=offset&amp;';

	$arrNews = $news->getPuplishedNewses(false, array('strLimit' => $offset . ',' . CONF_NEWS_PERPAGE, 'calcRows' => true), array('id', 'title', 'small_text', 'datetime', 'author'));
	// массив всех новостей
	$smarty->assign('news', $arrNews);

	// формируем страницы
	// получаем общее количество новостей
	$allRecords = $news->cntNews();
	// формируем странциы
	$strPages = strings::generatePage($allRecords, $offset, CONF_NEWS_PERPAGE, $path);
	//передаем в шаблон строку сформированных страниц
	$smarty->assignByRef('string_page', $strPages);
}

/**
 * просмотр полной новости
 */
if ($arrAction['view']) {
	if (isset($_GET['id']) && validate::checkNaturalNumber($_GET['id'])) {
		$strWhere = "id IN (" . secure::escQuoteData($_GET['id']) . ") AND token IN ('active','archived') AND datetime <= NOW()";
		if ($arrNews = $news->getNews($strWhere)) {
			// выбранная новость
			$smarty->assignByRef('news', $arrNews);
			$smarty->assignByRef('meta_keywords', $arrNews['meta_keywords']);
			$smarty->assignByRef('meta_description', $arrNews['meta_description']);

			$arrNamePage = array(array('name' => MENU_NEWS, 'link' => chpu::createChpuUrl(CONF_SCRIPT_URL . 'index.php?do=news')));
			('archived' == $arrNews['token']) ? $arrNamePage[] = array('name' => MENU_ACTION_ARCHIVED, 'link' => chpu::createChpuUrl(CONF_SCRIPT_URL . 'index.php?do=news&amp;action=archive')) : null;
			$arrNamePage[] = array('name' => $arrNews['title'], 'link' => false);

			// Формируем TITLE страницы
			$arrTitle = CONF_NEWSES_DISPLAY_ON_TITLE_ONLY_NEWS_NAME ? array(array('name' => $arrNews['title'])) : $arrNamePage;
		} else {
			$arrErrors[] = ERROR_SELECTED_NEWS;
		}
	} else {
		$arrErrors[] = ERROR_SELECTED_NEWS;
	}
} elseif ($arrAction['archive']) {
	$arrNamePage = array(
		array('name' => MENU_NEWS, 'link' => chpu::createChpuUrl(CONF_SCRIPT_URL . 'index.php?do=news')),
			//array('name' => MENU_ACTION_ARCHIVED, 'link' => chpu::createChpuUrl(CONF_SCRIPT_URL . 'index.php?do=news&amp;action=archive')),
	);

	// Если есть месяц, выводим новости за месяц
	if (isset($_GET['month']) && validate::checkNaturalNumber($_GET['month']) && 2 == strlen($_GET['month']) && 12 >= $_GET['month'] && 1 <= $_GET['month'] && !empty($_GET['year']) && ($year = chpu::getId_out_tId($_GET['year'])) && 4 == strlen($year)) {
		$arrNamePage[] = array('name' => MENU_ACTION_ARCHIVED, 'link' => chpu::createChpuUrl(CONF_SCRIPT_URL . 'index.php?do=news&amp;action=archive'));
		$arrNamePage[] = array('name' => $_GET['year'], 'link' => chpu::createChpuUrl(CONF_SCRIPT_URL . 'index.php?do=news&amp;action=archive&amp;year=' . $_GET['year']));
		$arrNamePage[] = array('name' => (!empty($arrAddDict['Month']['values'][$_GET['month']]) ? $arrAddDict['Month']['values'][$_GET['month']] : $_GET['month']), 'link' => false);

		//смещение, всегда 0 (затем берется из $_GET)
		$offset = (!empty($_GET['offset']) && validate::checkNaturalNumber($_GET['offset'])) ? validate::checkNaturalNumber($_GET['offset']) : 0;
		//получаем массив, содержащий текущий обработанный URL
		$path = CONF_SCRIPT_URL . 'index.php?do=news&amp;action=archive&amp;year=' . $year . '&amp;month=' . $_GET['month'] . '&amp;page=offset&amp;';

		$strWhere = "token IN ('archived') AND YEAR(`datetime`)=" . secure::escQuoteData($year) . " AND MONTH(`datetime`)=" . secure::escQuoteData((int) $_GET['month']);
		$arrOrderBy = array('datetime' => 'DESC');
		$arrLimit = array('strLimit' => $offset . ',' . CONF_NEWS_PERPAGE, 'calcRows' => true);
		$arrNews = $news->getNewses($strWhere, $arrOrderBy, $arrLimit, false);
		// формируем страницы
		// получаем общее количество новостей
		$allRecords = $news->cntNews();
		// формируем странциы
		$strPages = strings::generatePage($allRecords, $offset, CONF_NEWS_PERPAGE, $path);
		//передаем в шаблон строку сформированных страниц
		$smarty->assignByRef('string_page', $strPages);
		// массив всех новостей
		$smarty->assignByRef('news', $arrNews);

		// для блока боковой части
		$currMonth = terms::currentDateTime('n');
		$smarty->assignByRef('currMonth', $currMonth);
		//$smarty->assignByRef('arrMonth', $arrAddDict['Month']['values']);
	} elseif (isset($_GET['month'])) {
		messages::error404();
	}
	// Если есть год, выводим новости за год
	elseif (!empty($_GET['year']) && ($year = chpu::getId_out_tId($_GET['year'])) && 4 == strlen($year)) {
		$arrNamePage[] = array('name' => MENU_ACTION_ARCHIVED, 'link' => chpu::createChpuUrl(CONF_SCRIPT_URL . 'index.php?do=news&amp;action=archive'));
		$arrNamePage[] = array('name' => $year, 'link' => false);

		//смещение, всегда 0 (затем берется из $_GET)
		$offset = (!empty($_GET['offset']) && validate::checkNaturalNumber($_GET['offset'])) ? validate::checkNaturalNumber($_GET['offset']) : 0;
		//получаем массив, содержащий текущий обработанный URL
		$path = CONF_SCRIPT_URL . 'index.php?do=news&amp;action=archive&amp;year=' . $year . '&amp;page=offset&amp;';

		$strWhere = "token IN ('archived') AND YEAR(`datetime`)=" . secure::escQuoteData($year);
		$arrOrderBy = array('datetime' => 'DESC');
		$arrLimit = array('strLimit' => $offset . ',' . CONF_NEWS_PERPAGE, 'calcRows' => true);
		$arrNews = $news->getNewses($strWhere, $arrOrderBy, $arrLimit, false);
		// формируем страницы
		// получаем общее количество новостей
		$allRecords = $news->cntNews();
		// формируем странциы
		$strPages = strings::generatePage($allRecords, $offset, CONF_NEWS_PERPAGE, $path);
		//передаем в шаблон строку сформированных страниц
		$smarty->assignByRef('string_page', $strPages);
		// массив всех новостей
		$smarty->assignByRef('news', $arrNews);

		// для блока боковой части
		$currMonth = terms::currentDateTime('n');
		$smarty->assignByRef('currMonth', $currMonth);
		//$smarty->assignByRef('arrMonth', $arrAddDict['Month']['values']);
	}
	// Если нет ни года, ни месяца, выводим все архивные новости
	else {
		$arrNamePage[] = array('name' => MENU_ACTION_ARCHIVED, 'link' => false);

		//смещение, всегда 0 (затем берется из $_GET)
		$offset = (!empty($_GET['offset']) && validate::checkNaturalNumber($_GET['offset'])) ? validate::checkNaturalNumber($_GET['offset']) : 0;
		//получаем массив, содержащий текущий обработанный URL
		$path = CONF_SCRIPT_URL . 'index.php?do=news&amp;action=archive&amp;page=offset&amp;';

		$strWhere = "token IN ('archived') AND datetime <=NOW()";
		$arrOrderBy = array('datetime' => 'DESC');
		$arrLimit = array('strLimit' => $offset . ',' . CONF_NEWS_PERPAGE, 'calcRows' => true);
		$arrNews = $news->getNewses($strWhere, $arrOrderBy, $arrLimit, false);
		// формируем страницы
		// получаем общее количество новостей
		$allRecords = $news->cntNews();
		// формируем странциы
		$strPages = strings::generatePage($allRecords, $offset, CONF_NEWS_PERPAGE, $path);
		//передаем в шаблон строку сформированных страниц
		$smarty->assignByRef('string_page', $strPages);
		// массив всех новостей
		$smarty->assignByRef('news', $arrNews);
	}
}

$smarty->assignByRef('errors', $arrErrors);
$smarty->assignByRef('action', $arrAction);
