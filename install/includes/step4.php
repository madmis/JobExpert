<?php
/********************************************************
	JobExpert v1.0
	powered by Script Developers Group (SD-Group)
	email: info@sd-group.org.ua
	url: http://sd-group.org.ua/
	Copyright 2010-2015 (c) SD-Group
	All rights reserved
=========================================================
	Инсталлятор - Шаг 4 - Настройки сайта
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
} else {
	include_once 'core/conf/const.config.site.php';
	include_once 'core/conf/const.config.db.php';

	if (CONF_SITE_URL == "http://jobexpert/") {
		$host = 'http://' . filesys::setPath($_SERVER['HTTP_HOST']);
	} else {
		$host = filesys::setPath(CONF_SITE_URL);
	}

	if (isset($_POST['step4'])) {
		$tChpu = (!isset($_POST['chpu'])) ? false : ((!isset($_POST['tChpu'])) ? false : true);
		$tChpuMaxLen = (!empty($tChpu) && ($tChpuMaxLen = (int) $_POST['tChpuMaxLenght'])) ? $tChpuMaxLen : 0;
		$tChpuPutToEnd = (!empty($tChpu) && !empty($_POST['tChpuPutToEnd'])) ? 1 : 0;

		$data = "<?php\n\n"
			  . "(!defined('SDG')) ? die ('Triple protection!') : null;\n\n"
			  . 'define("CONF_DEFAULT_TITLE", "' . htmlspecialchars($_POST['title'], ENT_QUOTES, CONF_DEFAULT_CHARSET) . '");' . "\n\n"
			  . 'define("CONF_DEFAULT_DESCRIPTION", "' . $_POST['description'] . '");' . "\n\n"
			  . 'define("CONF_DEFAULT_KEYWORDS", "' . $_POST['keywords'] . '");' . "\n\n"
			  . 'define("CONF_SITE_NAME", "' . htmlspecialchars($_POST['site_name'], ENT_QUOTES, CONF_DEFAULT_CHARSET) . '");' . "\n\n"
			  . 'define("CONF_SITE_NAME_TO_TITLE", "' . ((!empty($_POST['site_name_to_title'])) ? true : false) . '");' . "\n\n"
			  . 'define("CONF_TITLE_PAGE_SEPERATOR", "' . htmlspecialchars($_POST['title_page_separator'], ENT_QUOTES, CONF_DEFAULT_CHARSET) . '");' . "\n\n"
			  . 'define("CONF_LANGUAGE", "' . htmlspecialchars($_POST['language'], ENT_QUOTES, CONF_DEFAULT_CHARSET) . '");' . "\n\n"
			  . 'define("CONF_SITE_URL", "' . htmlspecialchars(filesys::setPath($_POST['site_url']), ENT_QUOTES, CONF_DEFAULT_CHARSET) . '");' . "\n\n"
			  . 'define("CONF_SCRIPT_URL", "' . htmlspecialchars(filesys::setPath($_POST['site_url']), ENT_QUOTES, CONF_DEFAULT_CHARSET) . '");' . "\n\n"
			  . 'define("CONF_USE_VISUAL_EDITOR", "' . ((!isset($_POST['visual_editor'])) ? false : true) . '");' . "\n\n"
			  . 'define("CONF_USE_REDIRECT_EXTERNAL_LINK", "' . ((!isset($_POST['redirect_extLink'])) ? 0 : 1) . '");' . "\n\n"
			  . 'define("CONF_ENABLE_CACHING", "' . ((!isset($_POST['caching'])) ? false : true) . '");' . "\n\n"
			  . 'define("CONF_DISABLE_AUTO_COUNTERS", "' . ((!isset($_POST['counters'])) ? false : true) . '");' . "\n\n"
			  . 'define("CONF_ENABLE_CHPU", "' . ((!isset($_POST['chpu'])) ? false : true) . '");' . "\n\n"
			  . 'define("CONF_ENABLE_TRANSLITERATION_CHPU", "' . $tChpu . '");' . "\n\n"
			  . 'define("CONF_TRANSLITERATION_CHPU_ID_PUT_TO_END", "' . $tChpuPutToEnd . '");' . "\n\n"
			  . 'define("CONF_TRANSLITERATION_CHPU_MAX_LENGHT", "' . htmlspecialchars($tChpuMaxLen, ENT_QUOTES, CONF_DEFAULT_CHARSET) . '");' . "\n\n"
			  . 'define("CONF_CHPU_HTML_DATA_EXT", "' . htmlspecialchars($_POST['tChpuHtmlDataExt'], ENT_QUOTES, CONF_DEFAULT_CHARSET) . '");' . "\n\n"
			  . 'define("CONF_CHPU_XML_DATA_EXT", "' . htmlspecialchars($_POST['tChpuXmlDataExt'], ENT_QUOTES, CONF_DEFAULT_CHARSET) . '");' . "\n";

		if (@file_put_contents('core/conf/const.config.site.php', $data)) {
			// записываем в сессию пятый шаг
			$_SESSION['sdinstall']['step4'] = true;
			die ('<script type="text/javascript">window.location="install.php?step=5";</script>');
		} else {
			$arrErrors[] = ERROR_UNABLE_TO_SAVE_CONFIG;
		}
	}
	$smarty -> assign('langDirs', filesys::getChildDirs('lang/'));
	$smarty -> assign('host', $host);
}