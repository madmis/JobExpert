<?php
/********************************************************
	JobExpert v1.0
	powered by Script Developers Group (SD-Group)
	email: info@sd-group.org.ua
	url: http://sd-group.org.ua/
	Copyright 2010-2015 (c) SD-Group
	All rights reserved
=========================================================
	Смена логина и пароля администратора
********************************************************/
/**
* @package
* @todo
*/

(!defined('SDG')) ? die ('Triple protection!') : null;

// инициируем "Наименование страницы" отображаемое в форме
$arrNamePage = array(
						array('name' => MENU_ADMIN_MAIN, 'link' => CONF_ADMIN_FILE),
						array('name' => MENU_CHANGE_PASSWORD, 'link' => false),
					);

if (isset($_POST['save']))
{
	if (isset($_POST['login']) && isset($_POST['password']))
	{
		// если хоть одно поле не пустое, выполняем
		if (!empty($_POST['login']) || !empty($_POST['password']))
		{
			$login = !empty($_POST['login']) ? $_POST['login'] : false;
			$password = !empty($_POST['password']) ? $_POST['password'] : false;

			admin::changeAdminPassword($login, $password);
		}
		else
		{
			$arrErrors[] = ERROR_NOT_SPECIFIED_DATA_FOR_CHANGE;
		}
	}
}

$smarty -> assignByRef('errors', $arrErrors);