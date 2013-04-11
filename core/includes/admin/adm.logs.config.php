<?php
/********************************************************
	JobExpert v1.0
	powered by Script Developers Group (SD-Group)
	email: info@sd-group.org.ua
	url: http://sd-group.org.ua/
	Copyright 2010-2015 (c) SD-Group
	All rights reserved
=========================================================
	Логи - Настройки
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
					array('name' => MENU_CONFIG, 'link' => false)
				);

if (isset($_POST['save'])) // сохраняем данные, переданные из формы
{
	$data = "<?php\n\n"
		  . "(!defined('SDG')) ? die ('Triple protection!') : null;\n\n"
		  . 'define("CONF_LOGS_ADMIN", "' . ((!isset($_POST['logs_admin'])) ? false : true) . '");' . "\n";

	if (!tools::saveConfig('core/conf/const.config.logs.php', $data, CONF_ADMIN_FILE . '?m=logs&s=config'))
	{
		$arrErrors[] = ERROR_FILES_MISSING_FILE;
	}
}

$smarty -> assignByRef('errors', $arrErrors);
