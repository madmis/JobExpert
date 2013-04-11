<?php
/********************************************************
	JobExpert v1.0
	powered by Script Developers Group (SD-Group)
	email: info@sd-group.org.ua
	url: http://sd-group.org.ua/
	Copyright 2010-2015 (c) SD-Group
	All rights reserved
=========================================================
	Инсталлятор - Шаг 1 - Параметры подключения к БД
********************************************************/
/**
* @package
* @todo
*/

(!defined('SDG')) ? die ('Triple protection!') : null;

$smarty -> assignByRef('arrDBCharset', $arrDBCharset);
$smarty -> assignByRef('arrSiteCharset', $arrSiteCharset);

if (isset($_POST['step1'])) {
    if (!$dbId = @mysql_connect($_POST['db_host'], $_POST['db_user'], $_POST['db_pass'])) {
        $arrErrors[] = mysql_error();
	} elseif (!@mysql_select_db($_POST['db_name'],  $dbId)) {
		$arrErrors[] = mysql_error();
	} else {
		//сохраняем настройки
		$data = "<?php\n\n"
			  . "(!defined('SDG')) ? die ('Triple protection!') : null;\n\n"
			  . 'define ("DB_HOST", "' . $_POST['db_host'] . '");' . "\n\n"
			  . 'define ("DB_NAME", "' . $_POST['db_name'] . '");' . "\n\n"
			  . 'define ("DB_USER", "' . $_POST['db_user'] . '");' . "\n\n"
			  . 'define ("DB_PASS", "' . $_POST['db_pass'] . '");' . "\n\n"
			  . 'define ("DB_PREFIX", "' . $_POST['db_prefix'] . '");' . "\n\n"
			  . 'define ("USR_PREFIX", "' . $_POST['usr_prefix'] . '");' . "\n\n"
			  . 'define ("DB_CHARSET", "' . $_POST['db_charset'] . '");' . "\n\n"
			  . 'define ("CONF_DEFAULT_CHARSET", "' . $_POST['site_charset'] . '");' . "\n";

		if (file_put_contents('core/conf/const.config.db.php', $data)) {
			// записываем в сессию первый шаг
			$_SESSION['sdinstall']['step1'] = true;
			die ('<script type="text/javascript">window.location="install.php?step=2";</script>');
		} else {
			$arrErrors[] = ERROR_UNABLE_TO_SAVE_DB_CONFIG;
		}
	}
	$smarty -> assignByRef('retFields', $_POST);
}
