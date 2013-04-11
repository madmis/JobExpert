<?php
/********************************************************
	JobExpert v1.0
	powered by Script Developers Group (SD-Group)
	email: info@sd-group.org.ua
	url: http://sd-group.org.ua/
	Copyright 2010-2015 (c) SD-Group
	All rights reserved
=========================================================
	Настройки - Регтстрации и пользователи
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
						array('name' => MENU_CONFIG_REGISTER, 'link' => false)
					);

// сохраняем данные, переданные из формы
if (isset($_POST['save']))
{
	$data = "<?php\n\n"
		  . "(!defined('SDG')) ? die ('Triple protection!') : null;\n\n"
		  . 'define("CONF_USER_REGISTER", "' . ((!isset($_POST['user_register'])) ? false : true) . '");' . "\n\n"
		  . 'define("CONF_USER_ACTIVATE", "' . ((!isset($_POST['user_activate'])) ? false : true) . '");' . "\n\n"
		  . 'define("CONF_USER_ACTIVATE_DELETE", "' . (((int) $_POST['user_activate_delete']) ? (int) $_POST['user_activate_delete'] : 24) . '");' . "\n\n"
		  . 'define("CONF_MAIL_ADMIN_USER_REGISTER", "' . ((!isset($_POST['admin_user_register'])) ? false : true) . '");' . "\n\n"
		  . 'define("CONF_REGISTER_USER_PASSWORD", "' . (((int) $_POST['user_password']) ? (int) $_POST['user_password'] : 6) . '");' . "\n";

	if (!tools::saveConfig('core/conf/const.config.register.php', $data, CONF_ADMIN_FILE . '?m=config&s=register'))
	{
		$arrErrors[] = ERROR_FILES_MISSING_FILE;
	}
}

$group = new group();

$smarty -> assign('arrGroups', $group -> getAllGroups("token IN ('active')", array('id' => 'ASC'), array('id')));
$smarty -> assignByRef('errors', $arrErrors);
