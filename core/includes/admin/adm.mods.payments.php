<?php
/********************************************************
	JobExpert v1.0
	powered by Script Developers Group (SD-Group)
	email: info@sd-group.org.ua
	url: http://sd-group.org.ua/
	Copyright 2010-2015 (c) SD-Group
	All rights reserved
=========================================================
	Менеджер - Платежные Моды
********************************************************/
/**
* @package
* @todo
*/

(!defined('SDG')) ? die ('Triple protection!') : null;

// инициируем "Наименование страницы" отображаемое в форме
$arrNamePage = array(
	array('name' => MENU_ADMIN_MAIN, 'link' => CONF_ADMIN_FILE),
	array('name' => MENU_MODS, 'link' => false)
);

/**
* иницализация массива подключаемых шаблонов: по умолчанию все значения - false
* для подключения шаблона, необходимо установить значение - true
* шаблоны подключаются в порядке установленном в файле головного шаблона
*/
$arrActions = array(
	'payments'	=> false,
	'config'	=> false,
	'mt'		=> false, // managerTemplates
	'lt'		=> false, // languageTemplates
);

// определяем шаблон для отображения
(isset($_GET['action']) && isset($arrActions[$_GET['action']])) ? $arrActions[$_GET['action']] = true : null;

$payments = new payments();

$modMenu = array();

// инициируем "Наименование страницы" отображаемое в форме
$arrNamePage[] = array('name' => MENU_MODS_PAYMENTS, 'link' => CONF_ADMIN_FILE . '?m=mods&s=payments');
/**
* Действия
*/
$issetMod = !empty($_GET['id']) ? $payments -> issetMod("id IN (" . secure::escQuoteData($_GET['id']) . ") AND token IN ('active', 'disabled')") : false;
/**
* Настройки модов
*/
if ($arrActions['config'] && !empty($_GET['id']) && $issetMod) {

	// инициируем "Наименование страницы" отображаемое в форме
	$arrNamePage[] = array('name' => strtoupper($_GET['id']), 'link' => false);
	$arrNamePage[] = array('name' => MENU_CONFIG, 'link' => false);

	include_once 'core/mods/payments/' . $_GET['id'] . '/admin.php';
	include_once 'core/mods/payments/' . $_GET['id'] . '/conf/' . $_GET['id'] . '.conf.php';
	include_once 'core/mods/payments/' . $_GET['id'] . '/conf/' . $_GET['id'] . '.tariffs.php';

	$smarty -> assign('config_template', SD_ROOT_DIR . 'core/mods/payments/' . $_GET['id'] . '/templates/' . $_GET['id'] . '.conf.tpl');
	$smarty -> assign('tariffs_template', SD_ROOT_DIR . 'core/mods/payments/' . $_GET['id'] . '/templates/' . $_GET['id'] . '.tariffs.tpl');

	/**
	* Сохраняем настройки самого мода
	*/
	if (isset($_POST['conf'])) {
		if ($payments -> saveModConf($_GET['id'], $_POST)) {
			messages::messageChangeSaved(MESSAGE_CHANGE_SAVED, false, CONF_ADMIN_FILE . '?m=mods&s=payments&action=config&id=' . $_GET['id']);
		} else {
			$arrErrors[] = ERROR_MODS_PAYMENTS_CONFIG_NOT_SAVE;
		}
	}

	/**
	* Сохраняем тарифную сетку для мода
	*/
	elseif (isset($_POST['tariff']) && isset($_POST['arrTariffs']) && !empty($_POST['arrTariffs'])) {
		if ($payments -> saveModTariffs($_GET['id'], $_POST['arrTariffs'], $arrPayments)) {
			messages::messageChangeSaved(MESSAGE_CHANGE_SAVED, false, CONF_ADMIN_FILE . '?m=mods&s=payments&action=config&id=' . $_GET['id']);
		} else {
			$arrErrors[] = ERROR_MODS_PAYMENTS_TARIFFS_NOT_SAVE;
		}
	}

	$smarty -> assignByRef('arrPayments', $arrPayments);
	$smarty -> assignByRef('arrTariffs', $arrTariffs);
}
/**
* Данные по моду
*/
elseif ($arrActions['payments'] && !empty($_GET['id']) && $issetMod) {

	// инициируем "Наименование страницы" отображаемое в форме
	$arrNamePage[] = array('name' => strtoupper($_GET['id']), 'link' => false);
	$arrNamePage[] = array('name' => MENU_ACTION_PAYMENTS, 'link' => false);

	include_once 'core/mods/payments/' . $_GET['id'] . '/admin.php';
	include_once 'core/mods/payments/' . $_GET['id'] . '/conf/' . $_GET['id'] . '.conf.php';
	include_once 'core/mods/payments/' . $_GET['id'] . '/conf/' . $_GET['id'] . '.tariffs.php';

	$smarty -> assignByRef('arrPayments', $arrPayments);
	$smarty -> assignByRef('arrTariffs', $arrTariffs);
}
/**
* Настройка шаблонов мода
*/
elseif ($arrActions['mt'] && !empty($_GET['id']) && $issetMod) {
	// инициируем "Наименование страницы" отображаемое в форме
	$arrNamePage[] = array('name' => strtoupper($_GET['id']), 'link' => false);
	$arrNamePage[] = array('name' => MENU_MANAGER_TEMPLATES, 'link' => false);

	include_once 'core/mods/payments/' . $_GET['id'] . '/admin.php';
}
/**
* Настройка языковых файлов
*/
elseif ($arrActions['lt'] && !empty($_GET['id']) && $issetMod) {

	$formUrl = CONF_ADMIN_FILE . '?m=mods&s=payments&action=lt&id=' . $_GET['id'];
	$langDir = 'core/mods/payments/' . $_GET['id'] . '/lang/';

	$selects = (isset($_POST['currLocaliz'])) ? new selects($_POST['currLocaliz']) : new selects();
	$currLang = $selects -> retCurrLang();

	if (!empty($_POST['fileNameLocaliz']) && in_array($_POST['fileNameLocaliz'], filesys::getFilesInDir($langDir . 'russian/'))) {
		$fileNameLocaliz = array_pop($_POST);

		$arrData = array();
		foreach ($_POST as $constName => &$constValue) {
			$arrData[] = "define('" . strtoupper($constName) . "', '" . ((!empty($constValue)) ? $constValue : strtoupper($constName)) . "');";
		}

		$data = "<?php\n\n"
			  . "(!defined('SDG')) ? die ('Triple protection!') : null;\n\n"
			  . implode("\n\n", $arrData) . "\n";

		if (file_put_contents($langDir . $currLang . '/' . $fileNameLocaliz, $data)) {
			messages::messageChangeSaved(MESSAGE_CHANGE_SAVED, false, $formUrl);
		} else {
			messages::messageChangeSaved(MESSAGE_CHANGE_NOT_SAVED, false, $formUrl);
		}
	}


	$smarty -> assignByRef('formUrl', $formUrl);
	$smarty -> assignByRef('modId', $_GET['id']);

	$smarty -> assignByRef('currLang', $currLang); // текущая локализация

	// получаем список доступных дирректорий языков
	$arrLangs = array();
	foreach(filesys::getChildDirs($langDir) as $value) {
		$arrLangs[] = $value;
	}
	$smarty -> assignByRef('langs', $arrLangs); // список доступных локализаций

	// инициируем "Наименование страницы" отображаемое в форме
	$arrNamePage[] = array('name' => strtoupper($_GET['id']), 'link' => false);
	$arrNamePage[] = array('name' => MENU_LANGUAGE_MANAGER, 'link' => false);

	include_once 'core/mods/payments/' . $_GET['id'] . '/admin.php';

	$smarty -> assign('ltTemplate', 'adm.mods.payments.language.manager.tpl');	
	$smarty -> assign('defLocalizConst', localiz::getLocalizConst('russian', false, $langDir));
	$smarty -> assign('currLocalizConst', localiz::getLocalizConst($currLang, false, $langDir));
}
else {
	// инициируем "Наименование страницы" отображаемое в форме
	$arrNamePage[] = array('name' => MENU_MODS_PAYMENTS, 'link' => false);

	/**
	* Установка, включение, отключение и удаление модулей
	*/
	if (!empty($_POST['action']) && !empty($_POST['payments'])) {
		if ('install' === $_POST['action']) {
			$payments -> installMods(array_keys($_POST['payments']));
			messages::messageChangeSaved(MESSAGE_CHANGE_SAVED, false, CONF_ADMIN_FILE . '?m=mods&s=payments');
		}
		elseif ('del' === $_POST['action'])
		{
			$payments -> deleteMods(array_keys($_POST['payments']));
			messages::messageChangeSaved(MESSAGE_CHANGE_SAVED, false, CONF_ADMIN_FILE . '?m=mods&s=payments');
		}
		elseif ('enable' === $_POST['action']) {
			$payments -> enableMods(array_keys($_POST['payments']));
			messages::messageChangeSaved(MESSAGE_CHANGE_SAVED, false, CONF_ADMIN_FILE . '?m=mods&s=payments');
		}
		elseif ('disable' === $_POST['action']) {
			$payments -> enableMods(array_keys($_POST['payments']), false);
			messages::messageChangeSaved(MESSAGE_CHANGE_SAVED, false, CONF_ADMIN_FILE . '?m=mods&s=payments');
		}
	}

	$smarty -> assign('mods', $payments -> generateModsList());
}

$smarty -> assignByRef('modMenu', $modMenu);
$smarty -> assignByRef('errors', $arrErrors);
$smarty -> assignByRef('action', $arrActions);
