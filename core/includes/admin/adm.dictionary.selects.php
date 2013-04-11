<?php

/**
 * Powered by Script Developers Group (SD-Group)
 * Email: info@sd-group.org.ua
 * URL: http://sd-group.org.ua/
 * Copyright 2010-2015 (c) SD-Group
 * All rights reserved
 * ======================================================
 * Словари - Списки
 * ======================================================
 *
 * @package
 *
 * @todo
 *
 */
(!defined('SDG')) ? die('Triple protection!') : null;

/**
 * иницализация массива подключаемых шаблонов: по умолчанию все значения - false
 * для подключения шаблона, необходимо установить значение - true
 * шаблоны подключаются в порядке установленном в файле головного шаблона
 */
$arrActSelects = array(
	'add' => false,
	'edit' => false
);

$selects = (isset($_POST['langDict'])) ? new selects($_POST['langDict']) : new selects();

if (isset($_GET['action'])) {
	// инициируем "Наименование страницы" отображаемое в форме
	$arrNamePage = array(
		array('name' => MENU_ADMIN_MAIN, 'link' => CONF_ADMIN_FILE),
		array('name' => MENU_DICTIONARY_SELECTS, 'link' => CONF_ADMIN_FILE . '?m=dictionary&amp;s=selects')
	);

	switch ($_GET['action']) {
		case 'add':
			$arrActSelects[$_GET['action']] = true;
			$arrNamePage[] = array('name' => MENU_ACTION_ADD, 'link' => false);

			if (isset($_POST['add_dict'])) {
				(!isset($_POST['newDict']) || !is_array($arrNewDict = $_POST['newDict']) || empty($arrNewDict) || !validate::arrDataNotEmpty($arrNewDict) || !isset($arrNewDict['value']) || !validate::arrDataNotEmpty($arrNewDict['value']) || !isset($arrNewDict['type']) || ('assoc' !== $arrNewDict['type'] && 'index' !== $arrNewDict['type']) || ('assoc' === $arrNewDict['type'] && (!isset($arrNewDict['index']) || !validate::arrDataNotEmpty($arrNewDict['index'])))) ? $arrErrors[] = ERROR_EMPTY_FORM_FIELDS : $selects->addDict($arrNewDict);
			}

			break;

		case 'edit':
			$arrActSelects[$_GET['action']] = true;

			$arrNamePage[] = array('name' => MENU_ACTION_EDIT, 'link' => false);

			if (isset($_POST['save_dict'])) {
				(!isset($_POST['editDict']) || !is_array($arrEditDict = $_POST['editDict']) || empty($arrEditDict) || !validate::arrDataNotEmpty($arrEditDict) || !isset($arrEditDict['value']) || !validate::arrDataNotEmpty($arrEditDict['value']) || !isset($arrEditDict['type']) || ('assoc' !== $arrEditDict['type'] && 'index' !== $arrEditDict['type']) || ('assoc' === $arrEditDict['type'] && !isset($arrEditDict['index']))) ? null : $selects->editDict($arrEditDict);
			}

			(empty($_GET['type']) || empty($_GET['alias']) || (!$editDict = $selects->retDictByAlias($_GET['type'], $_GET['alias']))) ? messages::messageChangeSaved(MESSAGE_WARNING_UNKNOWN_ACTION, false, CONF_ADMIN_FILE . '?m=dictionary&s=selects') : null;

			$arrNamePage[] = array('name' => $editDict['discription'], 'link' => false);

			$smarty->assignByRef('return_data', $editDict);

			break;

		case 'del':
			(isset($_POST['alias'])) ? $selects->delDict($_POST['alias']) : messages::messageChangeSaved(MESSAGE_WARNING_UNKNOWN_ACTION, false, CONF_ADMIN_FILE . '?m=dictionary&s=selects');

			break;

		default:
			messages::messageChangeSaved(MESSAGE_WARNING_UNKNOWN_ACTION, false, CONF_ADMIN_FILE . '?m=dictionary&s=selects');
	}
} else {
	// инициируем "Наименование страницы" отображаемое в форме
	$arrNamePage = array(
		array('name' => MENU_ADMIN_MAIN, 'link' => CONF_ADMIN_FILE),
		array('name' => MENU_DICTIONARY_SELECTS, 'link' => false)
	);

	// получаем список доступных дирректорий шаблонов
	$langs = $selects->retLangs();

	$smarty->assignByRef('langs', $langs); // список доступных локализаций
	$smarty->assign('return_data', array('sysDict' => $selects->retSysDict(), 'addDict' => $selects->retAddDict())); // массив дополнительных словарей
}

$smarty->assign('currLang', $selects->retCurrLang()); // текущая локализация

$smarty->assignByRef('errors', $arrErrors);
$smarty->assignByRef('action', $arrActSelects);
