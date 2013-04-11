<?php
/********************************************************
	JobExpert v1.0
	powered by Script Developers Group (SD-Group)
	email: info@sd-group.org.ua
	url: http://sd-group.org.ua/
	Copyright 2010-2015 (c) SD-Group
	All rights reserved
=========================================================
	Инсталлятор - Шаг 6 - Окончание установки
********************************************************/
/**
* @package
* @todo
*/

(!defined('SDG')) ? die ('Triple protection!') : null;

include_once 'core/conf/const.config.site.php';
include_once 'core/conf/const.config.db.php';
include_once 'core/conf/const.config.adminfile.php';

$showHta = true;
// проверяем удалены ли файлы установки
$smarty -> assign('delInst', ((@file_exists('install.php') ? false : true)));
$smarty -> assign('errLogFile',  SD_ROOT_DIR . 'error_log');

// сохраняем файл .htaccess
if (isset($_POST['htasave'])) {
	$mcGPC = (get_magic_quotes_gpc()) ? 'php_flag magic_quotes_gpc off' : '#php_flag magic_quotes_gpc off';
	$registerGlobals = (ini_get('register_globals')) ? 'php_flag register_globals off' : '#php_flag register_globals off';

	$data = "# Copyright © 2010 - 2015 SD-GROUP\n# Website: http://sd-group.org.ua/\n\n";
	$data .= "# Default Charset\nAddDefaultCharset " . CONF_DEFAULT_CHARSET . "\n\n";
	$data .= "# Set the default handler.\nDirectoryIndex index.php\n\n";
	$data .= "# Security\n" . $registerGlobals . "\n# Disable Magic Quotes\n" . $mcGPC . "\n\n\n";

	$RewriteBase = (isset($_POST['rb'])) ? 'RewriteBase /' : '#RewriteBase /';

	$data .= "# Mod_rewrite\nRewriteEngine On\n" . $RewriteBase . "\n\n";
	$data .= "# CHPU\nRewriteCond %{REQUEST_FILENAME} !-f\nRewriteCond %{REQUEST_FILENAME} !-d\nRewriteCond %{REQUEST_URI} !^/index.php\n#RewriteCond %{REQUEST_URI} (/|\.php|\.html|/[^.]*)$ [NC]\nRewriteRule (.*) index.php\n\n\n";

	$phperr = (isset($_POST['phperr'])) ? 'php_flag display_errors on' : 'php_flag display_errors off';

	(isset($_POST['phperr'])) ? $data .= "# supress php errors\nphp_flag display_errors on\n\n" : null;
	(isset($_POST['logerr']) && !empty($_POST['logfile'])) ? $data .= "# enable PHP error logging\nphp_flag  log_errors on\nphp_value error_log " . $_POST['logfile'] . "\n\n" : null;
	(isset($_POST['logrestrict']) && isset($_POST['logerr']) && !empty($_POST['logfile'])) ? $data .= "# prevent access to PHP error log\n<Files " . basename($_POST['logfile']) . ">\nOrder allow,deny\nDeny from all\nSatisfy All\n</Files>\n\n" : null;
	(isset($_POST['htarestrict'])) ? $data .= "# prevent access to .htaccess\n<Files .htaccess>\nOrder allow,deny\nDeny from all\nSatisfy All\n</Files>\n\n" : null;

	(!file_put_contents('.htaccess', $data)) ? $arrErrors[] = ERROR_UNABLE_TO_SAVE_FILE : $showHta = false;
}

$smarty -> assign('showHta',  $showHta);

// удаление файлов инсталляции
if (isset($_GET['delInst'])) {
	header('Location: install.php?delInst');
}


