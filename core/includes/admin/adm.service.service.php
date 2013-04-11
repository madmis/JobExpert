<?php

/* * ******************************************************
  JobExpert v1.0
  powered by Script Developers Group (SD-Group)
  email: info@sd-group.org.ua
  url: http://sd-group.org.ua/
  Copyright 2010-2015 (c) SD-Group
  All rights reserved
  =========================================================
  Обслуживание сайта
 * ****************************************************** */
/**
 * @package
 * @todo
 */
(!defined('SDG')) ? die('Triple protection!') : null;

/**
 * иницализация массива подключаемых шаблонов: по умолчанию все значения - false
 * для подключения шаблона, необходимо установить значение - true
 * шаблоны подключаются в порядке установленном в файле головного шаблона
 */
$arrActions = array(
	//'deleteDBCache' => false,
	//'deleteTmplCache' => false,
	'htaccess' => false,
);

// инициируем "Наименование страницы" отображаемое в форме
$arrNamePage = array(
	array('name' => MENU_ADMIN_MAIN, 'link' => CONF_ADMIN_FILE),
	array('name' => MENU_SERVICE, 'link' => false),
	array('name' => MENU_SERVICES, 'link' => CONF_ADMIN_FILE . '?m=service&amp;s=service'),
);

// определяем шаблон для отображения
(isset($_GET['action']) && isset($arrActions[$_GET['action']])) ? $arrActions[$_GET['action']] = true : null;

if ($arrActions['htaccess']) {
	$arrNamePage[] = array('name' => MENU_SERVICES_HTACCESS, 'link' => false);

	if (isset($_POST['save']) && !empty($_POST['htaccess'])) {
		// сохраняем изменения
		if (!tools::saveConfig('.htaccess', $_POST['htaccess'], CONF_ADMIN_FILE . '?m=service&amp;s=service&amp;action=htaccess')) {
			$arrErrors[] = ERROR_FILE_NOT_SAVED;
		}
	}

	$htaccess = file_get_contents('.htaccess');
	$smarty -> assignByRef('htaccess', $htaccess);
}
/*
if ($arrActions['deleteDBCache']) {
	$arrNamePage[] = array('name' => MENU_SERVICES_DELETE_DB_CACHE, 'link' => false);
	/* @var $smarty Smarty */
/*	$smarty->assign('deleteDBCache', caching::dropCache());
} elseif ($arrActions['deleteTmplCache']) {
	$arrNamePage[] = array('name' => MENU_SERVICES_DELETE_TMPL_CACHE, 'link' => false);;
	$smarty->assign('deleteTmplCache', caching::dropTmplCache());
}
*/


$smarty->assignByRef('errors', $arrErrors);
$smarty->assignByRef('action', $arrActions);