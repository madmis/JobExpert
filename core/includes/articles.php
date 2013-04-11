<?php

/**
 * JobExpert v1.0
 * Powered by Script Developers Group (SD-Group)
 * Email: info@sd-group.org.ua
 * URL: http://sd-group.org.ua/
 * Copyright 2010-2015 (c) SD-Group
 * All rights reserved
 * ===================================================
 * Статьи
 * ===================================================
 *
 * @package
 *
 * @todo
 *
 */
(!defined('SDG')) ? die('Triple protection!') : null;

/**
 * Иницализация массива подключаемых шаблонов: по умолчанию все значения - false
 * Для подключения шаблона, необходимо установить значение - true
 * Шаблоны подключаются в порядке установленном в файле головного шаблона
 */
$arrAction = array(
	'section' => false,
	'view' => false,
	'offset' => false
);

// определяем шаблон для отображения
if (isset($_GET['action'])) {
	if (isset($arrAction[$_GET['action']])) {
		$arrAction[$_GET['action']] = true;
	} else {
		messages::error404();
	}
}

$sections = array();
// создаем объект
$articles = new articles();
$artsections = new artsections();

$artsections->getCategorys();

// формируем данные для запроса в соответствии с типом пользователя
/*
switch ($_SESSION['sd_user'][DB_PREFIX . 'conf']['user_type']) {
	case 'competitor':
		$arrWhere = array('affiliation' => array('none', 'competitor'));
		break;

	case 'employer':
	case 'company':
		$arrWhere = array('affiliation' => array('none', 'employer'));
		break;

	default:
		$arrWhere = false;
		break;
}
*/
$arrWhere = false;
// создаем массив секций, с которым мы будем работать
$sections = (!$sections['full'] = $artsections->getSections($arrWhere)) ? false : $sections + $artsections->splitSections($sections['full']);

/**
 * просмотр полной статьи или статей по разделу
 */
if (isset($_GET['action']) && 'offset' !== $_GET['action']) {
	/**
	 * Просмотр статей по разделу
	 */
	if ('section' === $_GET['action'] && !empty($_GET['id']) && validate::checkNaturalNumber($_GET['id']) && !empty($sections['full'][$_GET['id']]) && is_array($sections['full'][$_GET['id']])) {
		if (!empty($_GET['tId']) && !in_array($_GET['tId'], $sections['full'][$_GET['id']])) {
			messages::error404();
		}
		if ($section = $artsections->getSectionById($_GET['id'])) {

			$arrNamePage = array(
				array('name' => MENU_ARTICLES, 'link' => chpu::createChpuUrl(CONF_SCRIPT_URL . 'index.php?ut=' . $_SESSION['sd_user'][DB_PREFIX . 'conf']['user_type'] . '&amp;do=articles')),
				array('name' => $section['name'], 'link' => false)
			);

			// Формируем TITLE страницы
			$arrTitle = array();
			CONF_ARTICLES_TITLE_SECTION_SITE ? $arrTitle[] = array('name' => MENU_ARTICLES) : null;
			$arrTitle[] = array('name' => $section['name']);

			//смещение, всегда 0 (затем берется из $_GET)
			$offset = (!empty($_GET['offset']) && validate::checkNaturalNumber($_GET['offset'])) ? validate::checkNaturalNumber($_GET['offset']) : 0;
			//получаем массив, содержащий текущий обработанный URL
			$path = CONF_SCRIPT_URL . 'index.php?ut=' . $_SESSION['sd_user'][DB_PREFIX . 'conf']['user_type'] . '&amp;do=articles&amp;action=section&amp;id=' . $_GET['id'] . '&amp;page=offset&amp;';

			$strWhere = "id_section=" . secure::escQuoteData($section['id']);
			$arrLimit = array('strLimit' => $offset . ',' . CONF_ARTICLES_PERPAGE, 'calcRows' => true);
			$arrFields = array('id', 'title', 'small_text', 'datetime', 'id_section', 'author', 'rating', 'votes');
			// массив всех статей
			$arrArticles = $articles->getPuplishedArticles($strWhere, false, $arrLimit, $arrFields);
			$smarty->assign('articles', $arrArticles);

			// формируем страницы
			// получаем общее количество статей
			$allRecords = $articles->cntArticles();
			// формируем странцы
			$strPages = strings::generatePage($allRecords, $offset, CONF_ARTICLES_PERPAGE, $path);
			//передаем в шаблон строку сформированных страниц
			$smarty->assignByRef('strPages', $strPages);

			// СЕО данные
			$smarty->assign('meta_keywords', MENU_ARTICLES . ', ' . $section['name']);
			$smarty->assign('meta_description', MENU_ARTICLES . ' - ' . $section['name']);

			$arrAction['section'] = true;
		} else {
			messages::error404();
		}
	}

	/**
	 * Просмотр выбранной статьи
	 */ elseif ('view' === $_GET['action'] && !empty($_GET['id']) && validate::checkNaturalNumber($_GET['id'])) {

		if ($article = $articles->getPublishedArticle("id IN (" . secure::escQuoteData($_GET['id']) . ")")) {
			if (!empty($sections['full'][$article['id_section']])) {
				$smarty->assignByRef('article', $article);
				//var_dump ($section = $artsections -> getSectionById($article['id_section']));
				$section = $sections['full'][$article['id_section']];

				$arrNamePage = array(
					array('name' => MENU_ARTICLES, 'link' => chpu::createChpuUrl(CONF_SCRIPT_URL . 'index.php?ut=' . $_SESSION['sd_user'][DB_PREFIX . 'conf']['user_type'] . '&amp;do=articles')),
					array('name' => $section['name'], 'link' => chpu::createChpuUrl(CONF_SCRIPT_URL . 'index.php?ut=' . $_SESSION['sd_user'][DB_PREFIX . 'conf']['user_type'] . '&amp;do=articles&amp;action=section&amp;id=' . $section['tId'])),
					array('name' => $article['title'], 'link' => false)
				);

				// Формируем TITLE страницы
				$arrTitle = array();
				CONF_ARTICLES_TITLE_SECTION_SITE ? $arrTitle[] = array('name' => MENU_ARTICLES) : null;
				CONF_ARTICLES_TITLE_SECTION_ARTICLE ? $arrTitle[] = array('name' => $section['name']) : null;
				CONF_ARTICLES_TITLE_ARTICLE_NAME ? $arrTitle[] = array('name' => $article['title']) : null;

				// проверка голосований за статью
				// проверяем наличие id статьи в куках пользователя
				// если $vote = true, значит пользователь уже голосовал за статью
				$vote = (isset($_COOKIE['artvote']) && $_COOKIE['artvote']) ? ((!in_array($article['id'], explode(':', $_COOKIE['artvote']))) ? false : true) : false;
				// проверяем ip последнего голосовавшего
				(!$vote) ? (($_SERVER['REMOTE_ADDR'] === $article['ip_last']) ? $vote = true : null) : null;
				$smarty->assignByRef('vote', $vote);

				// СЕО данные
				$smarty->assignByRef('meta_keywords', $article['meta_keywords']);
				$smarty->assignByRef('meta_description', $article['meta_description']);

				$arrAction['view'] = true;
			} else {
				messages::error404();
			}
		} else {
			messages::error404();
		}
	} else {
		messages::error404();
	}

	$smarty->assignByRef('errors', $arrErrors);
} else {
	//смещение, всегда 0 (затем берется из $_GET)
	$offset = (!empty($_GET['offset']) && validate::checkNaturalNumber($_GET['offset'])) ? validate::checkNaturalNumber($_GET['offset']) : 0;
	//получаем массив, содержащий текущий обработанный URL
	$path = CONF_SCRIPT_URL . 'index.php?ut=' . $_SESSION['sd_user'][DB_PREFIX . 'conf']['user_type'] . '&amp;do=articles&amp;action=offset&amp;';

	$strWhere = (empty($sections['id']) || !is_array($sections['id'])) ? false : "id_section IN (" . implode(",", secure::escQuoteData($sections['id'])) . ")";
	$arrLimit = array('strLimit' => $offset . ',' . CONF_ARTICLES_PERPAGE, 'calcRows' => true);
	$arrFields = array('id', 'title', 'small_text', 'datetime', 'id_section', 'author', 'rating', 'votes');

	$arrArticles = $articles->getPuplishedArticles($strWhere, false, $arrLimit, $arrFields);
	// массив всех статей
	$smarty->assign('articles', $arrArticles);

	// формируем страницы
	// получаем общее количество статей
	$allRecords = $articles->cntArticles();
	// формируем странциы
	$strPages = strings::generatePage($allRecords, $offset, CONF_ARTICLES_PERPAGE, $path);
	//передаем в шаблон строку сформированных страниц
	$smarty->assignByRef('strPages', $strPages);

	// СЕО данные
	$smarty->assign('meta_keywords', CONF_SITE_NAME . ', ' . MENU_ARTICLES);
	$smarty->assign('meta_description', CONF_SITE_NAME . ': ' . MENU_ARTICLES);
}

// передаем в смарти все разделы
$smarty->assignByRef('artSections', $sections);
$smarty->assignByRef('action', $arrAction);
