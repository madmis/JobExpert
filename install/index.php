<?php
/********************************************************
	JobExpert v1.0
	powered by Script Developers Group (SD-Group)
	email: info@sd-group.org.ua
	url: http://sd-group.org.ua/
	Copyright 2010-2015 (c) SD-Group
	All rights reserved
=========================================================
	Инсталлятор - Главный файл
********************************************************/
/**
* @package
* @todo
*/

(!defined('SDG')) ? die ('Triple protection!') : null;

####################################################################
############################### INIT ###############################
####################################################################
/********** Автозагрузчик классов **********/
spl_autoload_register('expert__autoload');

function expert__autoload($className) {
	/********** Библиотека статических классов **********/
	if (file_exists(SD_ROOT_DIR . 'core/classes/lib/' . $className . '.class.php')) {
		require_once SD_ROOT_DIR . 'core/classes/lib/' . $className . '.class.php';
	} else {
		// Файл класса ненайден печатаем сообщение об ошибке
		spl_autoload_register('smartyAutoload');
	}
}

/********** Очистка полученных данных **********/
secure::clearRequestData();

/********** Языковые файлы **********/
if (!empty($_COOKIE['instLang']) && is_dir(SD_ROOT_DIR . 'install/lang/' . $_COOKIE['instLang'] . '/')) {
	$currLang = $_COOKIE['instLang'];
} else {
	$currLang = SDG_DEFAULT_LANGUAGE;
}

foreach (filesys::getFilesInDir(SD_ROOT_DIR . 'install/lang/' . $currLang . '/') as $fileLang) {
	require_once SD_ROOT_DIR . 'install/lang/' . $currLang . '/' . $fileLang;
}

/********** Инициализация Smarty **********/
define('SMARTY_SPL_AUTOLOAD', 1);
require_once SD_ROOT_DIR . 'install/Smarty/Smarty.class.php';
$smarty = new Smarty(); //core smarty object
$smarty -> error_reporting = E_ALL & ~E_NOTICE;
$smarty -> template_dir = SD_ROOT_DIR . 'install/templates/';
$smarty -> compile_dir = SD_ROOT_DIR . 'install/templates_c/';
$smarty -> debugging = false;
$smarty -> force_compile = true;

####################################################################
############################### INIT ###############################
####################################################################

if (isset($_GET['step']) && ((int) $_GET['step']) && ($_GET['step'] > 0)) {
	if (@file_exists(SD_ROOT_DIR . 'install/includes/step' . $_GET['step'] . '.php')
			&& @file_exists(SD_ROOT_DIR . 'install/templates/step' . $_GET['step'] . '.tpl')) {

		$arrErrors = array();
		include_once SD_ROOT_DIR . 'install/includes/step' . $_GET['step'] . '.php';
		$main_template = 'step' . $_GET['step'] . '.tpl';
		/********** Передаем в Smarty выводимый шаблон и отображаем его **********/
		$smarty -> assignByRef('mainTemplate', $main_template);
		$smarty -> assignByRef('arrErrors', $arrErrors);
		$smarty -> display('index.tpl');
	} else {
		exit(ERROR_INSTALL_FILES_NOT_EXISTS);
	}
} else {
	exit(ERROR_NOT_PAGE_FOUND);
}