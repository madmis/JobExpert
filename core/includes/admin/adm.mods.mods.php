<?php

/* * ******************************************************
  JobExpert v1.0
  powered by Script Developers Group (SD-Group)
  email: info@sd-group.org.ua
  url: http://sd-group.org.ua/
  Copyright 2010-2015 (c) SD-Group
  All rights reserved
  =========================================================
  Менеджер - Моды
 * ****************************************************** */
/**
 * @package
 * @todo
 */
(!defined('SDG')) ? die('Triple protection!') : null;

// инициируем "Наименование страницы" отображаемое в форме
$arrNamePage = array(
	array('name' => MENU_ADMIN_MAIN, 'link' => CONF_ADMIN_FILE),
	array('name' => MENU_MODS, 'link' => false)
);

/**
 * Создаем объект
 */
$mods = new mods();
$mods->addAllModsToDb();

/**
 * включение, отключение и удаление модулей
 */
$url = CONF_ADMIN_FILE . '?m=mods&s=mods';
if (isset($_POST['action'])) {
	if ('active' === $_POST['action'] && !empty($_POST['mods'])) {
		if ($mods->enableMods(array_keys($_POST['mods']))) {
			messages::messageChangeSaved(MESSAGE_CHANGE_SAVED, false, $url);
		} else {
			messages::messageChangeSaved(MESSAGE_CHANGE_NOT_SAVED, false, $url);
		}
	} elseif ('disable' === $_POST['action'] && !empty($_POST['mods'])) {
		if ($mods->enableMods(array_keys($_POST['mods']), false)) {
			messages::messageChangeSaved(MESSAGE_CHANGE_SAVED, false, $url);
		} else {
			messages::messageChangeSaved(MESSAGE_CHANGE_NOT_SAVED, false, $url);
		}
	} /*elseif ('del' === $_POST['action'] && !empty($_POST['mods'])) {
		if ($mods->deleteMods(array_keys($_POST['mods']))) {
			messages::messageChangeSaved(MESSAGE_DATA_HAS_BEEN_DELETED, false, $url);
		} else {
			messages::messageChangeSaved(MESSAGE_CHANGE_NOT_SAVED, false, $url);
		}
	}*/

	$mods->__construct();
}

// Переключение на работу с БД
if (isset($_GET['dbEnable'])) {
	$mods->modsDbEnable();
	messages::messageChangeSaved(MESSAGE_CHANGE_SAVED, false, $url);
}

// Проверяем, если моды работают с файлом
// выводим в шаблоне ссылку на возможность
// переключения на работу с базой
if (@file_exists($mods->dbFile)) {
	$smarty->assign('dbEnable', true);
} else {
	$smarty->assign('dbEnable', false);
}

$smarty->assign('mods', $mods->getMods());