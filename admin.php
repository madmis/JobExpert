<?php
/********************************************************
	powered by Script Developers Group (SD-Group)
	email: info@sd-group.org.ua
	url: http://sd-group.org.ua/
	Copyright 2009 (c) SD-Group
	All rights reserved
=========================================================
	Главный файл админки
********************************************************/
session_start();

//error_reporting(E_ALL | E_STRICT);
error_reporting(E_ALL);

/********** Защита от взлома **********/
define('SDG', true);

/********** Подключаем ядро **********/
require_once 'core/adm.init.php';

/*******************************************
*               Рабочая часть              *
*******************************************/
// Переменные по умолчанию
// Здесь указаны переменные, использующиеся в большинстве файлов
$arrErrors = array();

// Переменные Smarty по умолчанию
// Здесь указаны переменные, использующиеся в большинстве шаблонов
$main_template = 'adm.main.tpl'; // шаблон главной страницы по умолчанию
$smarty -> assign('errors', false); // массив обшибок
$smarty -> assign('return_data', false); // значения, возвращаемые в форму

/********** Проверяем, вошел ли админ **********/
if (!admin::checkAdminSessionLogin()) {
	// сохраняем в сесиию рефер-ссылку
	(!empty($_SERVER['QUERY_STRING'])) ? $_SESSION['referer'] = '?' . $_SERVER['QUERY_STRING'] : null;

	include_once 'core/includes/admin/adm.access.php';
	$smarty -> display('adm.access.tpl');
	exit;
} else {
	/********** Выход из админки **********/
	(isset($_GET['logout'])) ? include_once 'core/includes/admin/adm.logout.php' : null;

	/**
	 * Передаем в Smarty системные словари (для доступа из всех шаблонов)
	 */
	$smarty->assignByRef('arrSysDict', $arrSysDict);

	/**
	 * Передаем в Smarty дополнительные словари (для доступа из всех шаблонов)
	 */
	$smarty->assignByRef('arrAddDict', $arrAddDict);

	// подключаем файл формирования меню панели администратора
	$menuAmdin = admin::getMenuAdminPanel();
	$smarty -> assignByRef('admMenu', $menuAmdin);
	$smarty -> assign('currMenu', 'main');

	// инициируем "Наименование страницы" отображаемое в форме
	$arrNamePage[] = array('name' => MENU_ADMIN_MAIN, 'link' => false);

	if (isset($_GET['m'])) // проверяем текущий раздел меню
	{
		$smarty -> assignByRef('currMenu', $_GET['m']);

		if (!empty($_GET['s'])) // текущий пукнт меню
		{
			// если выбраны модули
			if ($_GET['m'] === 'mods' && 'mods' !== $_GET['s'] && 'payments' !== $_GET['s'])
			{
				$template_file = CONF_ROOT_DIR . 'core/mods/' . $_GET['s'] . '/templates/adm.' . $_GET['m'] . '.' . $_GET['s'] . '.tpl';
				$work_file = 'core/mods/' . $_GET['s'] . '/adm.' . $_GET['m'] . '.' . $_GET['s'] . '.php';

				if (@file_exists($work_file) && @file_exists($template_file))
				{
					$main_template = $template_file;
					include_once $work_file;
				}
				else
				{
					messages::error404();
				}
			}
			else // иначе обычные страницы
			{
				$template_file = 'adm.' . $_GET['m'] . '.' . $_GET['s'] . '.tpl';
				$work_file = 'core/includes/admin/adm.' . $_GET['m'] . '.' . $_GET['s'] . '.php';

				if (@file_exists($work_file) && @file_exists(TEMPLATE_PATH_ADMIN . $template_file))
				{
					$main_template = $template_file;
					include_once $work_file;
				}
				else
				{
					messages::error404();
				}
			}
		}
	}

	// смена пароля и логина администратора
	elseif (isset($_GET['do']) && !empty($_GET['do']))
	{
		$template_file = 'adm.' . $_GET['do'] . '.tpl';
		$work_file = 'core/includes/admin/adm.' . $_GET['do'] . '.php';

		if (@file_exists($work_file) && @file_exists(TEMPLATE_PATH_ADMIN . $template_file))
		{
			$main_template = $template_file;
			include_once $work_file;
		}
		else
		{
			messages::error404();
		}
	}
	// главная страница админки
	else
	{
		// Проверка наличия обновлений
		$avUpdates = array();
		$avUpdates['result'] = updates::checkUpdates();
		$avUpdates['error'] = (is_numeric($avUpdates['result'])) ? false : true;
		$smarty -> assignByRef('avUpdates', $avUpdates);
	}

	// передаем в смарти "Наименование страницы" отображаемое форме
	(isset($arrNamePage) && is_array($arrNamePage)) ? $smarty -> assignByRef('namePage', $arrNamePage) : $smarty -> assign('namePage', false);

	/********** Собираем статистику запросов к БД **********/
	$smarty -> assign('ScriptWorkReport', array('ID-DataBase' => db::$db_id,'CountAllQuerysToDB' => db::$cntAllQuerys, 'ListAllQuerysToDB' => db::$arrAllQuerys));

	/********** Передаем в Smarty выводимый шаблон и отображаем его **********/
	$smarty -> assignByRef('main_template', $main_template);
	$smarty -> display('adm.index.tpl');
}
