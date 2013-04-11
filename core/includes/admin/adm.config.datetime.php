<?php
/********************************************************
	JobExpert v1.0
	powered by Script Developers Group (SD-Group)
	email: info@sd-group.org.ua
	url: http://sd-group.org.ua/
	Copyright 2010-2015 (c) SD-Group
	All rights reserved
=========================================================
	Настройки - Дата, время
********************************************************/
/**
* @package
* @todo
*/

(!defined('SDG')) ? die ('Triple protection!') : null;

// инициируем "Наименование страницы" отображаемое в форме
$arrNamePage = array(
						array('name' => MENU_ADMIN_MAIN, 'link' => CONF_ADMIN_FILE),
						array('name' => MENU_CONFIG, 'link' => false),
						array('name' => MENU_CONFIG_DATETIME, 'link' => false)
					);

if (isset($_POST['save'])) // сохраняем данные, переданные из формы
{
	$data = "<?php\n\n"
		  . "(!defined('SDG')) ? die ('Triple protection!') : null;\n\n"
		  . 'define("CONF_DATE_FORMAT", "' . $_POST['date_format'] . '");' . "\n\n"
		  . 'define("CONF_TIME_FORMAT", "' . $_POST['time_format'] . '");' . "\n";

	if (!tools::saveConfig('core/conf/const.config.datetime.php', $data, CONF_ADMIN_FILE . '?m=config&s=datetime'))
	{
		$arrErrors[] = ERROR_FILES_MISSING_FILE;
	}
}

$smarty -> assignByRef('errors', $arrErrors);
