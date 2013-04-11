<?php
/********************************************************
	JobExpert v1.0
	powered by Script Developers Group (SD-Group)
	email: info@sd-group.org.ua
	url: http://sd-group.org.ua/
	Copyright 2010-2015 (c) SD-Group
	All rights reserved
=========================================================
	Логи - SQL
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
					array('name' => MENU_LOGS_SQL, 'link' => false)
				);

// действия
// очистка логов
if (isset($_POST['clear']))
{
	@unlink('core/data/log/sql_error.log');
	messages::messageChangeSaved(MESSAGE_CHANGE_SAVED, false, CONF_ADMIN_FILE . '?m=logs&s=sql');
}
				
// Получаем данные из файла
$logData = (@file_get_contents('core/data/log/sql_error.log')) ? explode("\n\n\n", @file_get_contents('core/data/log/sql_error.log')) : false;
$smarty -> assign('logData', $logData);