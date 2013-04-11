<?php
/********************************************************
	JobExpert v1.0
	powered by Script Developers Group (SD-Group)
	email: info@sd-group.org.ua
	url: http://sd-group.org.ua/
	Copyright 2010-2015 (c) SD-Group
	All rights reserved
=========================================================
	Менеджер рассылка
********************************************************/
/**
* @package
* @todo
*/

(!defined('SDG')) ? die('Triple protection!') : null;

// инициируем "Наименование страницы" отображаемое в форме
$arrNamePage = array(
						array('name' => MENU_ADMIN_MAIN, 'link' => CONF_ADMIN_FILE),
						array('name' => MENU_MANAGER_MAILER, 'link' => false)
					);

/**
* иницализация массива подключаемых шаблонов: по умолчанию все значения - false
* для подключения шаблона, необходимо установить значение - true
* шаблоны подключаются в порядке установленном в файле головного шаблона
*/
$arrActions = array(
						'config'	=> false,
						'templates'	=> false,
                    );
// определяем шаблон для отображения
(isset($_GET['action']) && isset($arrActions[$_GET['action']])) ? $arrActions[$_GET['action']] = true : null;

/** Строка запроса из адресной строки браузера **/
$qString = !empty($_SERVER['QUERY_STRING']) ? $_SERVER['QUERY_STRING'] : 'm=manager&s=mailer';



$arrTemplates = array();
// путь к файлам шаблонов писем
$path = filesys::setPath(CONF_ROOT_DIR) . 'core/data/templates/mailer/';
$arrFiles = filesys::getFilesInDir($path);

foreach ($arrFiles as &$value)
{
	if (file_exists($path . $value))
	{
		$arrTemplates[$value]['name'] = substr($value, 0, strlen($value) - 4);
	}
}


/**
* Настройки рассылки
*/
if ($arrActions['config'])
{
	// инициируем "Наименование страницы" отображаемое в форме
	$arrNamePage[] = array('name' => MENU_CONFIG, 'link' => false);
}
elseif ($arrActions['templates'])
{
	// инициируем "Наименование страницы" отображаемое в форме
	$arrNamePage[] = array('name' => MENU_ACTION_TEMPLATE, 'link' => false);
}
else
{
	$group = new group();
	$smarty -> assign('uGroups', $group -> getAllGroups("token IN ('active')", array('id' => 'ASC'), array('id')));
	$smarty -> assign('uTypes', $group -> arrTypes);
}


$smarty -> assignByRef('arrTemplates', $arrTemplates);
// адресная строка
$smarty -> assignByRef('qString', $qString);
$smarty -> assignByRef('errors', $arrErrors);
$smarty -> assignByRef('actions', $arrActions);
