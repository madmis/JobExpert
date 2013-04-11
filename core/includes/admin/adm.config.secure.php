<?php
/********************************************************
	JobExpert v1.0
	powered by Script Developers Group (SD-Group)
	email: info@sd-group.org.ua
	url: http://sd-group.org.ua/
	Copyright 2010-2015 (c) SD-Group
	All rights reserved
=========================================================
	Настройки - Безопасность
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
						array('name' => MENU_CONFIG_SECURE, 'link' => false)
					);

if (isset($_POST['save'])) // сохраняем данные, переданные из формы
{
	$data = "<?php\n\n"
		  . "(!defined('SDG')) ? die ('Triple protection!') : null;\n\n"
		  . 'define("SECURE_CAPTCHA", "' . ((!isset($_POST['captcha'])) ? false : true) . '");' . "\n\n"
		  . 'define("SECURE_SQLERR_LOG", "' . ((!isset($_POST['sqlerr_log'])) ? false : true) . '");' . "\n\n"
		  . 'define("SECURE_SQLERR_PRINT", "' . ((!isset($_POST['sqlerr_print'])) ? false : true) . '");' . "\n\n"
		  . 'define("SECURE_SQLERR_SEND_MESS", "' . ((!isset($_POST['sqlerr_send_mess'])) ? false : true) . '");' . "\n\n"
		  . 'define("SECURE_SQLERR_EMAIL", "' . $_POST['sqlerr_email'] . '");' . "\n\n"
		  . 'define("SECURE_SQLERR_HEADERS", "Content-Type: text/html; charset=utf-8\r\nFrom: ' . htmlspecialchars($_POST['sqlerr_email'], ENT_QUOTES, CONF_DEFAULT_CHARSET) . '\r\n");' . "\n\n"
		  . 'define("SECURE_ADMIN_ACCESS_IP_LIST", "' . SECURE_ADMIN_ACCESS_IP_LIST . '");' . "\n";

	if (!tools::saveConfig('core/conf/const.config.secure.php', $data, CONF_ADMIN_FILE . '?m=config&s=secure'))
	{
		$arrErrors[] = ERROR_FILES_MISSING_FILE;
	}
}

$smarty -> assignByRef('errors', $arrErrors);
