<?php

/**
 * Powered by Script Developers Group (SD-Group)
 * Email: info@sd-group.org.ua
 * URL: http://sd-group.org.ua/
 * Copyright 2010-2015 (c) SD-Group
 * All rights reserved
 * ======================================================
 * Поиск Резюме
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
	'id_section' => false,
	'id_profession' => false,
	'id_region' => false,
	'id_city' => false,
	'chart_work' => false,
	'expire_work' => false,
	'education' => false,
	'age_from' => false,
	'age_post' => false,
	'pay_from' => false,
	'pay_post' => false,
	'currency' => false,
	'gender' => false,
	'user_type' => false,
	'period' => false,
	'records' => false
);

// поиск
if (isset($_GET['id_section'])) {
	// проверяем наличие всех необходимых полей в поисковом запросе
	foreach ($arrFields as $key => $value) {
		(!isset($_GET[$key])) ? $arrErrors = ERROR_SEARCH_NONE_REQUIRED_FIELDS : null;
	}

	if (!$arrErrors) {
		// создаем объект
		$search = new search('resume');

		$arrFields = array(
			'id_section' => validate::checkNaturalNumber($_GET['id_section']),
			'id_profession' => validate::checkNaturalNumber($_GET['id_profession']),
			'id_region' => validate::checkNaturalNumber($_GET['id_region']),
			'id_city' => validate::checkNaturalNumber($_GET['id_city']),
			'chart_work' => (in_array($search->decodeSearchString($_GET['chart_work']), $arrAddDict['ChartWork']['values']) ? $search->decodeSearchString($_GET['chart_work']) : false),
			'expire_work' => (in_array($search->decodeSearchString($_GET['expire_work']), $arrAddDict['ExpireWorkSearch']['values']) ? $search->decodeSearchString($_GET['expire_work']) : false),
			'education' => (in_array($search->decodeSearchString($_GET['education']), $arrAddDict['Education']['values']) ? $search->decodeSearchString($_GET['education']) : false),
			'age_from' => validate::checkNaturalNumber($_GET['age_from']),
			'age_post' => validate::checkNaturalNumber($_GET['age_post']),
			'pay_from' => validate::checkNaturalNumber($_GET['pay_from']),
			'pay_post' => validate::checkNaturalNumber($_GET['pay_post']),
			'currency' => (in_array($_GET['currency'], $arrSysDict['Currency']['values']) ? $_GET['currency'] : false),
			'gender' => (array_key_exists($_GET['gender'], $arrSysDict['Gender']['values']) ? $_GET['gender'] : false),
			'user_type' => $_GET['user_type'],
			'period' => (array_key_exists($_GET['period'], $arrSysDict['SearchPeriod']['values']) ? $_GET['period'] : 0),
			'records' => (in_array($_GET['records'], $arrSysDict['AnnounceRecords']['values']) ? $_GET['records'] : 5),
		);

		// смещение, всегда 0 (затем берется из $_GET)
		$offset = isset($_GET['offset']) ? (int) abs($_GET['offset']) : 0;

		// производим поиск
		$arrData = $search->searchResume($arrFields + array('offset' => $offset));

		if ($arrData['result']) {
			// формируем ссылку
			$path = 'index.php?ut=' . $_SESSION['sd_user'][DB_PREFIX . 'conf']['user_type']
					. '&amp;do=search.resume&amp;id_section=' . $arrFields['id_section']
					. '&amp;id_profession='	. $arrFields['id_profession']
					. '&amp;id_region=' . $arrFields['id_region'] . '&amp;id_city=' . $arrFields['id_city']
					. '&amp;chart_work=' . $arrFields['chart_work'] . '&amp;expire_work=' . $arrFields['expire_work']
					. '&amp;education=' . $arrFields['education'] . '&amp;age_from=' . $arrFields['age_from'] . '&amp;age_post=' . $arrFields['age_post']
					. '&amp;pay_from=' . $arrFields['pay_from'] . '&amp;pay_post=' . $arrFields['pay_post'] . '&amp;currency=' . $arrFields['currency']
					. '&amp;gender=' . $arrFields['gender'] . '&amp;user_type=' . $arrFields['user_type']
					. '&amp;period=' . $arrFields['period'] . '&amp;records=' . $arrFields['records'] . '&amp;';

			// формируем странциы
			$strPages = strings::generatePage($arrData['records'], $offset, $arrFields['records'], $path, true);

			// передаем в шаблон необходимые данные
			$smarty->assign('link', CONF_SCRIPT_URL . 'index.php?ut=' . $_SESSION['sd_user'][DB_PREFIX . 'conf']['user_type'] . '&amp;do=resume&amp;action=view&amp;id=');
			$smarty->assignByRef('return_data', $arrData['result']);
			$smarty->assignByRef('string_page', $strPages);
		} else {
			$arrErrors[] = MESSAGE_NOT_FOUND_RECORDS;
		}
	}
}

// имя страницы
$arrNamePage = array(
	array('name' => MENU_SEARCH_RESUME, 'link' => chpu::createChpuUrl(CONF_SCRIPT_URL . 'index.php?ut=' . $_SESSION['sd_user'][DB_PREFIX . 'conf']['user_type'] . '&amp;do=search')),
	array('name' => MENU_ADVANCED_SEARCH_RESUME, 'link' => chpu::createChpuUrl(CONF_SCRIPT_URL . 'index.php?ut=' . $_SESSION['sd_user'][DB_PREFIX . 'conf']['user_type'] . '&amp;do=search.resume'))
);

$smarty->assignByRef('retFields', $arrFields);
$smarty->assignByRef('errors', $arrErrors);
