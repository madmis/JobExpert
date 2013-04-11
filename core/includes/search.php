<?php

/**
 * Powered by Script Developers Group (SD-Group)
 * Email: info@sd-group.org.ua
 * URL: http://sd-group.org.ua/
 * Copyright 2010-2015 (c) SD-Group
 * All rights reserved
 * ======================================================
 * Поиск по базе объявлений
 * ======================================================
 *
 * @package
 *
 * @todo
 *
 */
(!defined('SDG')) ? die('Triple protection!') : null;

/**
 * Массив полей, содержащихся в форме поиска
 */
$arrFields = array(
	'q' => false,
	'base' => false,
	'type' => false,
	'id_section' => false,
	'id_profession' => false,
	'id_region' => false,
	'id_city' => false,
	'pay_from' => false,
	'currency' => false,
	'period' => false,
	'records' => false
);

if (isset($_GET['q'])) {
	// проверяем поисковую строку
	(empty($_GET['q']) || strlen($_GET['q']) < 4) ? $arrErrors[] = ERROR_SEARCH_SHORT_QUERY : null;

	// проверяем наличие всех необходимых полей в поисковом запросе
	$errToken = false;
	foreach ($arrFields as $key => $value) {
		(!isset($_GET[$key])) ? $errToken = true : null;
	}

	if ($errToken) {
		$arrErrors[] = ERROR_SEARCH_NONE_REQUIRED_FIELDS;
	} elseif (('vacancy' !== $_GET['base'] && 'resume' !== $_GET['base']) || ('exact' !== $_GET['type'] && 'any' !== $_GET['type'])) {
		$arrErrors[] = ERROR_SEARCH_INCORRECT_DATA;
	}


	if (!$arrErrors) {
		// создаем объект
		$search = new search(strtolower($_GET['base']));

		$arrFields = array(
			'q' => $search->decodeSearchString($_GET['q']),
			'base' => strtolower($_GET['base']),
			'type' => strtolower($_GET['type']),
			'id_section' => validate::checkNaturalNumber($_GET['id_section']),
			'id_profession' => validate::checkNaturalNumber($_GET['id_profession']),
			'id_region' => validate::checkNaturalNumber($_GET['id_region']),
			'id_city' => validate::checkNaturalNumber($_GET['id_city']),
			'pay_from' => validate::checkNaturalNumber($_GET['pay_from']),
			'currency' => (in_array($_GET['currency'], $arrSysDict['Currency']['values']) ? $_GET['currency'] : false),
			'period' => (array_key_exists($_GET['period'], $arrSysDict['SearchPeriod']['values']) ? $_GET['period'] : 0),
			'records' => (in_array($_GET['records'], $arrSysDict['AnnounceRecords']['values']) ? $_GET['records'] : 5),
		);

		// смещение, всегда 0 (затем берется из $_GET)
		$offset = (!empty($_GET['offset']) && validate::checkNaturalNumber($_GET['offset'])) ? validate::checkNaturalNumber($_GET['offset']) : 0; //смещение, всегда
		// производим поиск
		$arrData = $search->searchQuery($arrFields + array('offset' => $offset));

		// формируем ссылку
		$path = 'index.php?ut=' . $_SESSION['sd_user'][DB_PREFIX . 'conf']['user_type'] . '&amp;do=search&amp;q=' . $arrFields['q']
				. '&amp;base=' . $arrFields['base']
				. '&amp;type=' . $arrFields['type']
				. '&amp;id_section=' . $arrFields['id_section'] . '&amp;id_profession=' . $arrFields['id_profession']
				. '&amp;id_region=' . $arrFields['id_region'] . '&amp;id_city=' . $arrFields['id_city']
				. '&amp;pay_from=' . $arrFields['pay_from'] . '&amp;currency=' . $arrFields['currency']
				. '&amp;period=' . $arrFields['period'] . '&amp;records=' . $arrFields['records'] . '&amp;';

		// формируем странциы
		$strPages = strings::generatePage($arrData['records'], $offset, $arrFields['records'], $path, true);

		// передаем в шаблон необходимые данные
		$smarty->assign('link', CONF_SCRIPT_URL . 'index.php?ut=' . $_SESSION['sd_user'][DB_PREFIX . 'conf']['user_type'] . '&amp;do=' . $arrFields['base'] . '&amp;action=view&amp;id=');
		$smarty->assignByRef('return_data', $arrData['result']);
		$smarty->assignByRef('find', $arrData['records']);
		$smarty->assignByRef('time', $arrData['time']);
		$smarty->assign('template', $arrFields['base'] . '.view.short.tpl');
		$smarty->assignByRef('string_page', $strPages);
	}
}

// передаем массив селекта "Валюты"
//$smarty->assignByRef('currency', $arrSysDict['Currency']['values']);

// передаем массив селекта "Период"
//$smarty->assignByRef('period', $arrSysDict['SearchPeriod']['values']);

// передаем массив селекта "Количество записей"
//$smarty->assignByRef('records', $arrSysDict['AnnounceRecords']['values']);

$smarty->assignByRef('retFields', $arrFields);
$smarty->assignByRef('errors', $arrErrors);
