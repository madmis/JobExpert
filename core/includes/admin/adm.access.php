<?php
/********************************************************
	powered by Script Developers Group (SD-Group)
	email: info@sd-group.org.ua
	url: http://sd-group.org.ua/
	Copyright 2009 (c) SD-Group
	All rights reserved
=========================================================
	Форма авторизации и проверка авторизации админа
********************************************************/

(!defined('SDG')) ? die ('Triple protection!') : null;

// признак вывода капчи
$secure = false;
$arrErrors = array();

if (isset($_POST['authorize'])) {
	// функция безопасности
	secure::clearRequestData();

	// список IP-адресов с которых разрешен вход в Панель Администратора
	$arrIpAccess = (SECURE_ADMIN_ACCESS_IP_LIST) ? explode(';', SECURE_ADMIN_ACCESS_IP_LIST) : false;

	// проверяем входит ли текущий IP в список разрешенных
	(is_array($arrIpAccess) && !in_array($_SERVER['REMOTE_ADDR'], $arrIpAccess)) ? $arrErrors[] = ERROR_ACCESS_DENIED : null;

	// проверяем капчу
	if (empty($arrErrors) && isset($_POST['keystring']))
	{
		require_once 'core/si/securimage.php';
		$securimage = new securimage();
		(!$securimage -> check($_POST['keystring'])) ? $arrErrors[] = ERROR_CAPTCHA : null;
	}

	if (empty($arrErrors)) {
		$post_login = md5($_POST['login']);
		$post_pass = md5($_POST['password']);

		db::$dbTypeSelect = 'single';
		$row = db::dbSelectTable(array('login','password'), USR_PREFIX . 'admin', false, false, false, false);
	}

	 //если данные верны
	if (empty($arrErrors) && !strcmp($post_login, $row['login']) && !strcmp($post_pass, $row['password'])) {
		$_SESSION['administrator_login'] = $row['login'];
		$_SESSION['administrator_password'] = $row['password'];
		unset ($_SESSION['adm_fail_auth']);

		// Логирование удачной авторизации
		CONF_LOGS_ADMIN ? logs::logAdminAccess(array('login' => $_POST['login'], 'password' => 'yes'), true) : null;

		if (isset($_SESSION['referer'])) {
			$referer = $_SESSION['referer'];
			unset ($_SESSION['referer']);
			die ('<script type="text/javascript">window.location="' . CONF_ADMIN_FILE . $referer . '";</script>');
		} else {
			header('Location: ' . CONF_ADMIN_FILE);
			//die ('<script type="text/javascript">window.location="' . CONF_ADMIN_FILE . '";</script>'); 
		}
	}

	// Логирование неудачной авторизации
	CONF_LOGS_ADMIN ? logs::logAdminAccess(array('login' => $_POST['login'], 'password' => $_POST['password']), false) : null;

	// Если есть ошибки, сохраняем в сессии количество входов, для вывода капчи.
	(isset($_SESSION['adm_fail_auth'])) ? $_SESSION['adm_fail_auth']++ : $_SESSION['adm_fail_auth'] = 1;
}

// проверяем, нужно ли выводить капчу
(SECURE_CAPTCHA && isset($_SESSION['adm_fail_auth']) && $_SESSION['adm_fail_auth'] >= 3) ? $secure = true : null;

$smarty -> assignByRef('secure', $secure);
$smarty -> assignByRef('errors', $arrErrors); // передаем ошибки в шаблон