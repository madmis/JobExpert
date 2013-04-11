<?php
/********************************************************
	JobExpert v1.0
	powered by Script Developers Group (SD-Group)
	email: info@sd-group.org.ua
	url: http://sd-group.org.ua/
	Copyright 2010-2015 (c) SD-Group
	All rights reserved
=========================================================
	Настройки - Почта
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
						array('name' => MENU_CONFIG_MAIL, 'link' => false)
					);

// сохраняем данные, переданные из формы
if (isset($_POST['save']))
{
	$data = "<?php\n\n"
		  . "(!defined('SDG')) ? die ('Triple protection!') : null;\n\n"
		  . 'define("CONF_MAIL_METHOD", "' . htmlspecialchars($_POST['mail_method'], ENT_QUOTES, CONF_DEFAULT_CHARSET) . '");' . "\n\n"
		  . 'define("CONF_MAIL_FORMAT_HTML", "' . (int) $_POST['mail_format'] . '");' . "\n\n"
		  . 'define("CONF_MAIL_ADMIN_EMAIL", "' . htmlspecialchars($_POST['admin_email'], ENT_QUOTES, CONF_DEFAULT_CHARSET) . '");' . "\n\n"
		  . 'define("CONF_MAIL_SMTP_HOST", "' . htmlspecialchars($_POST['smtp_host'], ENT_QUOTES, CONF_DEFAULT_CHARSET) . '");' . "\n\n"
		  . 'define("CONF_MAIL_SMTP_PORT", "' . (int) $_POST['smtp_port'] . '");' . "\n\n"
		  . 'define("CONF_MAIL_SMTP_USER", "' . $_POST['smtp_user'] . '");' . "\n\n"
		  . 'define("CONF_MAIL_SMTP_PASS", "' . $_POST['smtp_pass'] . '");' . "\n";

	if (!tools::saveConfig('core/conf/const.config.mail.php', $data, CONF_ADMIN_FILE . '?m=config&s=mail'))
	{
		$arrErrors[] = ERROR_FILES_MISSING_FILE;
	}
}

$smarty -> assignByRef('errors', $arrErrors);
