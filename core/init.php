<?php

/**
 * Powered by Script Developers Group (SD-Group)
 * Email: info@sd-group.org.ua
 * URL: http://sd-group.org.ua/
 * Copyright 2009 (c) SD-Group
 * All rights reserved
 * ===================================================
 * Инициализация необходимых модулей
 * ===================================================
 */
(!defined('SDG')) ? die('Triple protection!') : null;

define('SD_DS', '/');
define('SD_ROOT_DIR', str_replace('core/', '', str_replace('\\', SD_DS, rtrim(dirname(__FILE__), '/\\') . SD_DS)));
define('CONF_ROOT_DIR', SD_ROOT_DIR);

/**
 * Автозагрузчик классов
 */
spl_autoload_register('expert__autoload');

function expert__autoload($className) {
	$className = strtolower($className);
	$pathExpertCore = 'i:/home/expert.core/classes/';
	/**
	 * Библиотека базовых классов
	 */
	if (file_exists('core/classes/base/' . $className . '.class.php')) {
		require_once 'core/classes/base/' . $className . '.class.php';
	}
	/**
	 * Библиотека общих классов
	 */ elseif (file_exists('core/classes/' . $className . '.class.php')) {
		require_once 'core/classes/' . $className . '.class.php';
	}
	/**
	 * Библиотека статических классов
	 */ elseif (file_exists('core/classes/lib/' . $className . '.class.php')) {
		require_once 'core/classes/lib/' . $className . '.class.php';
	}
	/**
	 * Библиотеки классов дополнительных модулей
	 */ elseif (file_exists('core/mods/' . $className . '/classes/' . $className . '.class.php')) {
		require_once 'core/mods/' . $className . '/classes/' . $className . '.class.php';
	}
	/**
	 * Библиотеки классов сторонних разработчиков
	 */ elseif (file_exists('core/classes/' . $className . '/' . $className . '.class.php')) {
		require_once 'core/classes/' . $className . '/' . $className . '.class.php';
	}
	/**
	 * Класс капчи
	 */ elseif (file_exists('core/si/' . $className . '/' . $className . '.php')) {
		require_once 'core/si/' . $className . '/' . $className . '.php';
	}
	/**
	 * Библиотека базовых классов ВНЕШНИЙ КАТАЛОГ
	 */ elseif (file_exists($pathExpertCore . 'base/' . $className . '.class.php')) {
		require_once $pathExpertCore . 'base/' . $className . '.class.php';
	}
	/**
	 * Библиотека общих классов ВНЕШНИЙ КАТАЛОГ
	 */ elseif (file_exists($pathExpertCore . $className . '.class.php')) {
		require_once $pathExpertCore . $className . '.class.php';
	}
	/**
	 * Библиотека статических классов ВНЕШНИЙ КАТАЛОГ
	 */ elseif (file_exists($pathExpertCore . 'lib/' . $className . '.class.php')) {
		require_once $pathExpertCore . 'lib/' . $className . '.class.php';
	}
	/**
	 * Библиотеки классов сторонних разработчиков ВНЕШНИЙ КАТАЛОГ
	 */ elseif (file_exists($pathExpertCore . $className . '/' . $className . '.class.php')) {
		require_once $pathExpertCore . $className . '/' . $className . '.class.php';
	}
	// Файл класса ненайден печатаем сообщение об ошибке
	else {
		spl_autoload_register('smartyAutoload');
	}
}

/**
 * Конфигурационные файлы
 */
foreach (filesys::getFilesInDir('core/conf/') as $fileConf) {
	require_once 'core/conf/' . $fileConf;
}

/**
 * Определение доступных локализаций
 */
foreach (filesys::getChildDirs('lang/') as $langs) {
	$existLangs[] = $langs;
}

/**
 * Очистка данных полученных извне PHP
 */
secure::clearRequestData();

/**
 * Определение текущей локализации
 */
if (!empty($_COOKIE['currLang']) && false !== ($currLang = array_search($_COOKIE['currLang'], $existLangs))) {
	unset($existLangs[$currLang]);
	array_unshift($existLangs, $currLang = & $_COOKIE['currLang']);
	cookies::setCookieSite('currLang', $currLang, 30);
} else {
	unset($existLangs[array_search(CONF_LANGUAGE, $existLangs)]);
	array_unshift($existLangs, $currLang = CONF_LANGUAGE);
	cookies::setCookieSite('currLang', $currLang, 30);
}

/**
 * Подключения языковых файлов текущей локализации
 */
foreach (filesys::getFilesInDir('lang/' . $currLang . '/') as $fileLang) {
	(0 !== strpos($fileLang, 'adm.')) ? require_once 'lang/' . $currLang . '/' . $fileLang : null;
}

/**
 * Капча
 */
require_once 'core/si/securimage.php';

/**
 * Моды
 */
// empty

/**
 * Инициализация шаблонизатора Smarty
 */
define('SMARTY_SPL_AUTOLOAD', 1);
require_once TEMPLATE_SMARTY_DIR . 'Smarty.class.php';
$smarty = new Smarty(); //core smarty object
$smarty->error_reporting = E_ALL & ~E_NOTICE;
$smarty->template_dir = TEMPLATE_PATH;
$smarty->compile_dir = TEMPLATE_COMPILE_DIR;
$smarty->debugging = TEMPLATE_DEBUGGING;
$smarty->compile_check = TEMPLATE_COMPILE_CHECK;
$smarty->force_compile = TEMPLATE_FORCE_COMPILE;
