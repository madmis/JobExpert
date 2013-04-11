<?php
/********************************************************
	JobExpert v1.0
	powered by Script Developers Group (SD-Group)
	email: info@sd-group.org.ua
	url: http://sd-group.org.ua/
	Copyright 2010-2015 (c) SD-Group
	All rights reserved
=========================================================
	Инсталлятор - Шаг 5 - Пароль админа
********************************************************/
/**
* @package
* @todo
*/

(!defined('SDG')) ? die ('Triple protection!') : null;

if (empty($_SESSION['sdinstall']['step1'])) {
	// пересылаем пользователя на первый шаг
	die ('<script type="text/javascript">window.location="install.php?step=1";</script>');
} elseif (empty($_SESSION['sdinstall']['step2'])) {
	// пересылаем пользователя на второй шаг
	die ('<script type="text/javascript">window.location="install.php?step=2";</script>');
} elseif (empty($_SESSION['sdinstall']['step3'])) {
	// пересылаем пользователя на третий шаг
	die ('<script type="text/javascript">window.location="install.php?step=3";</script>');
} elseif (empty($_SESSION['sdinstall']['step4'])) {
	// пересылаем пользователя на четвертый шаг
	die ('<script type="text/javascript">window.location="install.php?step=4";</script>');
} else {
	include_once 'core/conf/const.config.adminfile.php';
	include_once 'core/conf/const.config.db.php';

	if (!$dbId = @mysql_connect(DB_HOST, DB_USER, DB_PASS)) {
    	exit(mysql_error());
	} elseif (!@mysql_select_db(DB_NAME,  $dbId)) {
    	exit(mysql_error());
	}

	if (isset($_POST['step5'])) {
		// переименовывеам файл
		if (!empty($_POST['adminfile']) && rename(CONF_ADMIN_FILE, $_POST['adminfile'])) {
			$data = "<?php\n\n"
				  . "(!defined('SDG')) ? die ('Triple protection!') : null;\n\n"
				  . 'define("CONF_ADMIN_FILE", "' . $_POST['adminfile'] . '");' . "\n";

			if (!@file_put_contents('core/conf/const.config.adminfile.php', $data)) {
				$arrErrors[] = ERROR_UNABLE_TO_SAVE_CONFIG;
			}

			if (!$arrErrors && !empty($_POST['login']) && !empty($_POST['password']) && !empty($_POST['email'])) {
				mysql_query('TRUNCATE TABLE ' . USR_PREFIX . 'admin');
				if (mysql_query("INSERT INTO " . USR_PREFIX . "admin (login, password, email) VALUES ('" . md5($_POST['login']) . "', '" . md5($_POST['password']) . "', '" . $_POST['email'] . "')")) {
					// записываем в сессию шестой шаг
					$_SESSION['sdinstall']['step5'] = true;
					die ('<script type="text/javascript">window.location="install.php?step=6";</script>');
				} else {
				 	$arrErrors = mysql_error();
					//if (mysql_errno() == 1062)
				}
			}
		} else {
			$arrErrors[] = ERROR_UNABLE_RENAME_ADMINFILE;
		}
	}
}