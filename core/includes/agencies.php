<?php

/**
 * JobExpert v1.0
 * Powered by Script Developers Group (SD-Group)
 * Email: info@sd-group.org.ua
 * URL: http://sd-group.org.ua/
 * Copyright 2010-2015 (c) SD-Group
 * All rights reserved
 * ===================================================
 * Агентства
 * ===================================================
 */
(!defined('SDG')) ? die('Triple protection!') : null;

/**
 * иницализация массива подключаемых шаблонов: по умолчанию все значения - false
 * для подключения шаблона, необходимо установить значение - true
 * шаблоны подключаются в порядке установленном в файле головного шаблона
 */
$arrActions = array(
	'detail' => false,
);

// определяем шаблон для отображения
(isset($_GET['action']) && isset($arrActions[$_GET['action']])) ? $arrActions[$_GET['action']] = true : null;

if ($arrActions['detail']) {
	$arrFields = array(
		array('users', 'first_name'),
		array('users', 'last_name'),
		array('users', 'middle_name'),
		array('users', 'phone'),
		array('conf_users', 'addition_phone_1'),
		array('conf_users', 'addition_phone_2'),
		array('conf_users', 'company_name'),
		array('conf_users', 'company_city'),
		array('conf_users', 'company_url'),
		array('conf_users', 'company_description'),
		array('conf_users', 'logo'),
		array('conf_users', 'hide_additional_company_data')
	);

	if (isset($_GET['id']) && !empty($_GET['id'])) {
		if ($uData = $user->getCombinedUserData($_GET['id'], $arrFields)) {
			$smarty->assignByRef('uData', $uData);

			// инициируем "Наименование страницы" отображаемое в заголовке формы
			$arrNamePage = array(
				array('name' => MENU_AGENCIES,
/*						'link' => chpu::createChpuUrl(CONF_SCRIPT_URL . 'index.php?ut='
								. $_SESSION['sd_user'][DB_PREFIX . 'conf']['user_type']
								. '&amp;do=agencies')),*/
						'link' => chpu::createChpuUrl(CONF_SCRIPT_URL . 'index.php?do=agencies')),
				array('name' => $uData['company_name'], 'link' => false)
			);

			// СЕО данные
			$smarty->assign('meta_keywords', MENU_AGENCIES .  ', ' . $uData['company_name']);
			$smarty->assign('meta_description', MENU_AGENCIES . ' - ' . $uData['company_name'] . '!');

			$strWhere = "id_user IN (" . secure::escQuoteData($_GET['id']) . ") AND token IN ('active')";
			$arrOrderBy = array('act_datetime' => 'DESC');
			$smarty->assign('vacancys', $vacancy->getAnnounces($strWhere, false, $arrOrderBy));
			$smarty->assign('link', chpu::createChpuUrl(CONF_SCRIPT_URL . 'index.php?ut='
									. $_SESSION['sd_user'][DB_PREFIX . 'conf']['user_type']
									. '&amp;do=vacancy&amp;action=view&amp;id='));

			$smarty->assign('resumes', $resume->getAnnounces($strWhere, false, $arrOrderBy));
			$smarty->assign('rlink', chpu::createChpuUrl(CONF_SCRIPT_URL . 'index.php?ut='
									. $_SESSION['sd_user'][DB_PREFIX . 'conf']['user_type']
									. '&amp;do=resume&amp;action=view&amp;id='));
		} else {
			//$arrErrors[] = ERROR_SELECTED_COMPANY;
			messages::error404();
		}

	}
} else {
	// Формируем TITLE страницы
	$arrTitle = array();
	$seo = seo::getTitle('agencies', $currLang);
	$arrTitle[] = array('name' => (!empty($seo) ? $seo : MENU_AGENCIES));

	// СЕО данные
	$smarty->assign('meta_keywords', seo::getKeywords('agencies', $currLang));
	$smarty->assign('meta_description', seo::getDescription('agencies', $currLang));

	//смещение, всегда 0 (затем берется из $_GET)
	$offset = (!empty($_GET['offset']) && is_numeric($_GET['offset']) && $_GET['offset'] > 0) ? $_GET['offset'] : 0; //смещение, всегда 0 (затем берется из $_GET)
	$path = CONF_SCRIPT_URL . 'index.php?ut=' . $_SESSION['sd_user'][DB_PREFIX . 'conf']['user_type'] . '&amp;do=agencies&amp;action=offset&amp;'; //получаем массив, содержащий текущий обработанный URL

	$arrFields = array(
		array('conf_users', 'id'),
		array('conf_users', 'company_name'),
		array('conf_users', 'company_city'),
		array('conf_users', 'company_description'),
		array('conf_users', 'logo')
	);

	$strWhere = "conf_users.token IN ('active') AND conf_users.user_type IN ('agent')";
	(CONF_AGENCIES_SHOW_ONLY_WITH_LOGO) ? $strWhere .= " AND conf_users.logo!=''" : null;
	$strLimit = $offset . ',' . CONF_AGENCIES_PERPAGE;

	$arrCompanies = $user->getCombinedUsersData($arrFields, $strWhere, false, $strLimit);
	$smarty->assignByRef('arrCompanies', $arrCompanies);
	// формируем страницы
	$allRecords = $user->cntUsers();
	$strPages = strings::generatePage($allRecords, $offset, CONF_AGENCIES_PERPAGE, $path); // формируем странциы
	$smarty->assignByRef('string_page', $strPages); //передаем в шаблон строку сформированных страниц
}

$smarty->assignByRef('errors', $arrErrors);
$smarty->assignByRef('arrActions', $arrActions);