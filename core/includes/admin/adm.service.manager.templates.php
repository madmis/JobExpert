<?php
/********************************************************
	JobExpert v1.0
	powered by Script Developers Group (SD-Group)
	email: info@sd-group.org.ua
	url: http://sd-group.org.ua/
	Copyright 2010-2015 (c) SD-Group
	All rights reserved
=========================================================
	Обслуживание сайта - Менеджер шаблонов сайта
********************************************************/
/**
* @package
* @todo
*/

(!defined('SDG')) ? die('Triple protection!') : null;

// инициируем "Наименование страницы" отображаемое в форме
$arrNamePage = array(
						array('name' => MENU_ADMIN_MAIN, 'link' => CONF_ADMIN_FILE),
						array('name' => MENU_SERVICE, 'link' => false),
						array('name' => MENU_MANAGER_TEMPLATES_SITE, 'link' => false)
					);

if (!empty($_POST['currTemplate']) && is_dir('templates/site/' . $_POST['currTemplate']))
{
	$currTemplate =& $_POST['currTemplate'];
}
elseif(!empty($_COOKIE['adm_currTmplManage']) && is_dir('templates/site/' . $_COOKIE['adm_currTmplManage']))
{
	$currTemplate =& $_COOKIE['adm_currTmplManage'];
}
else
{
	$currTemplate = CONF_TEMPLATE;
}

// устанавливаем кукисы
cookies::setCookieSite('adm_currTmplManage', $currTemplate);
// передаем текуший шаблон в Smarty
$smarty -> assignByRef('currTemplate', $currTemplate); // текущий шаблон

// формируем данные - Список файлов шаблона
foreach(filesys::getFilesInDir("templates/site/$currTemplate/") as $fileName)
{
	if (false !== strstr($fileName, '.tpl'))
	{
		// записываем данные в массив
		$listTemplates[] = array(
			'name'			=> $fileName,
			'id'			=> $id = str_replace('.', '_', $fileName),
		);
	}
}
// формируем данные - Список файлов стилей
foreach(filesys::getFilesInDir("templates/site/$currTemplate/style/") as $fileName)
{
	if (false !== strstr($fileName, '.css'))
	{
		// записываем данные в массив
		$listCSS[] = array(
			'name'			=> $fileName,
			'id'			=> $id = str_replace('.', '_', $fileName),
		);
	}
}
// передаем данные в Smarty
$smarty -> assignByRef('listTemplates', $listTemplates);
$smarty -> assignByRef('listCSS', $listCSS);

// получаем список доступных дирректорий шаблонов
$smarty -> assign('templates', filesys::getChildDirs('templates/site/'));

$smarty -> assignByRef('errors', $arrErrors);
$smarty -> assignByRef('action', $arrActions);
