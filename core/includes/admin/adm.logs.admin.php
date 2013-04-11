<?php
/********************************************************
	JobExpert v1.0
	powered by Script Developers Group (SD-Group)
	email: info@sd-group.org.ua
	url: http://sd-group.org.ua/
	Copyright 2010-2015 (c) SD-Group
	All rights reserved
=========================================================
	Логи - Вход администратора
********************************************************/
/**
* @package
* @todo
*/

(!defined('SDG')) ? die ('Triple protection!') : null;

// инициируем "Наименование страницы" отображаемое в форме
$arrNamePage = array(
					array('name' => MENU_ADMIN_MAIN, 'link' => CONF_ADMIN_FILE),
					array('name' => MENU_LOGS, 'link' => false),
					array('name' => MENU_LOGS_ADMIN_ACCESS, 'link' => false)
				);

// Получаем данные из файла
$logData = filesys::getSerializedData('core/data/log/adm.access.mda');

// действия
if (isset($_POST['action']))
{
	// очистка логов
	if ('clear' === $_POST['action'])
	{
		if (@unlink('core/data/log/adm.access.mda'))
		{
			filesys::putSerializedData('core/data/log/adm.access.mda', array_slice($logData, -10));
			messages::messageChangeSaved(MESSAGE_CHANGE_SAVED, false, CONF_ADMIN_FILE . '?m=logs&s=admin');
		}
		else
		{
			$arrErrors[] = ERROR_FILES_NOT_DELETE;
		}
	}
}

$smarty -> assignByRef('logData', $logData);
$smarty -> assignByRef('errors', $arrErrors);