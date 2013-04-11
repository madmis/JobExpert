<?php
/********************************************************
	JobExpert v1.0
	powered by Script Developers Group (SD-Group)
	email: info@sd-group.org.ua
	url: http://sd-group.org.ua/
	Copyright 2010-2015 (c) SD-Group
	All rights reserved
=========================================================
	Страница платежей (выбора платежной системы)
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
						'view'	=> false
                    );

/**
* Подключаем выбранный мод
*/
if (!empty($_GET['mod'])) {
	$arrNamePage = array(
		array('name' => MENU_PAYMENTS, 'link' => chpu::createChpuUrl(CONF_SCRIPT_URL . 'index.php?ut=' . $_SESSION['sd_user'][DB_PREFIX . 'conf']['user_type'] . '&amp;do=payments')),
		array('name' => strtoupper($_GET['mod']), 'link' => false)
	 );

	// проверяем: существует ли выбранный мод (и включен ли он) и наличие обязательных файлов мода
	// а также, для модов требующих авторизацию пользователя, авторизирован ли пользователь
	if (!$payments -> issetMod("id IN (" . secure::escQuoteData($_GET['mod']) . ") AND token IN ('active')")
			|| !$payments -> checkBindFiles($_GET['mod']) || ($_GET['mod'] == 'hand' && !$user -> getAuthorized())) {

		$arrErrors[] = ERROR_PAY_SYSTEM_NOT_EXISTS;
	} else {
		// если проверка прошла, подключаем тарифную сетку мода
		include_once 'core/mods/payments/' . $_GET['mod'] . '/conf/' . $_GET['mod'] . '.tariffs.php';
		include_once 'core/mods/payments/' . $_GET['mod'] . '/conf/' . $_GET['mod'] . '.conf.php';
		include_once 'core/mods/payments/' . $_GET['mod'] . '/lang/' . (!empty($_COOKIE['currLang']) ? $_COOKIE['currLang'] : CONF_LANGUAGE) . '/' . $_GET['mod'] . '.lang.php';
		include_once 'core/mods/payments/' . $_GET['mod'] . '/lang/' . (!empty($_COOKIE['currLang']) ? $_COOKIE['currLang'] : CONF_LANGUAGE) . '/lang._custom.php';
		include_once 'core/mods/payments/' . $_GET['mod'] . '/classes/' . $_GET['mod'] . '.class.php';
		include_once 'core/mods/payments/' . $_GET['mod'] . '/index.php';
	}
} else {
	(!$modsList = $payments -> getActiveMods()) ? $arrErrors[] = ERROR_NOT_PAY_SYSTEM : null;

	// если нет ошибок и пользователь не авторизирован, удаляем моды, которые только для зарегистрированных пользователей
	if (empty($arrErrors) && !$user -> getAuthorized()) {
		foreach ($modsList as $key => &$value) {
			if ('hand' === $value['id']) {
				unset($modsList[$key], $value);
			}
		}
	}

	$smarty -> assignByRef('modsList', $modsList);
	$smarty -> assign('include_template', false);
}

$smarty -> assignByRef('action', $arrAction);
$smarty -> assignByRef('errors', $arrErrors);
