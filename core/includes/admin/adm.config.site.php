<?php

/**
 * JobExpert v1.0
 * Powered by Script Developers Group (SD-Group)
 * Email: info@sd-group.org.ua
 * URL: http://sd-group.org.ua/
 * Copyright 2010-2015 (c) SD-Group
 * All rights reserved
 * ===================================================
 * Настройки - Сайт
 * ===================================================
 *
 * @package
 *
 * @todo
 *
 */
(!defined('SDG')) ? die('Triple protection!') : null;

// инициируем "Наименование страницы" отображаемое в форме
$arrNamePage = array(
	array('name' => MENU_ADMIN_MAIN, 'link' => CONF_ADMIN_FILE),
	array('name' => MENU_CONFIG, 'link' => false),
	array('name' => MENU_CONFIG_SITE, 'link' => false)
);

// сохраняем данные, переданные из формы
if (isset($_POST['save'])) {
	$chpu = (!isset($_POST['chpu'])) ? 0 : 1;
	$tChpu = (empty($chpu)) ? CONF_ENABLE_TRANSLITERATION_CHPU : ((!isset($_POST['tChpu'])) ? 0 : 1);
	$tChpuPutToEnd = (empty($chpu) || empty($tChpu)) ? CONF_TRANSLITERATION_CHPU_ID_PUT_TO_END : ((empty($_POST['tChpuPutToEnd'])) ? 0 : 1);
	$tChpuMaxLen = (empty($chpu) || empty($tChpu)) ? CONF_TRANSLITERATION_CHPU_MAX_LENGHT : (($tChpuMaxLen = (int) $_POST['tChpuMaxLenght']) ? $tChpuMaxLen : 0);

	$data = "<?php\n\n"
			. "(!defined('SDG')) ? die ('Triple protection!') : null;\n\n"
			. 'define("CONF_DEFAULT_TITLE", "' . htmlspecialchars($_POST['title'], ENT_QUOTES, CONF_DEFAULT_CHARSET) . '");' . "\n\n"
			. 'define("CONF_DEFAULT_DESCRIPTION", "' . $_POST['description'] . '");' . "\n\n"
			. 'define("CONF_DEFAULT_KEYWORDS", "' . $_POST['keywords'] . '");' . "\n\n"
			. 'define("CONF_SITE_NAME", "' . htmlspecialchars($_POST['site_name'], ENT_QUOTES, CONF_DEFAULT_CHARSET) . '");' . "\n\n"
			. 'define("CONF_SITE_NAME_TO_TITLE", "' . ((!empty($_POST['site_name_to_title'])) ? 1 : 0) . '");' . "\n\n"
			. 'define("CONF_TITLE_PAGE_SEPERATOR", "' . htmlspecialchars($_POST['title_page_separator'], ENT_QUOTES, CONF_DEFAULT_CHARSET) . '");' . "\n\n"
			. 'define("CONF_LANGUAGE", "' . htmlspecialchars($_POST['language'], ENT_QUOTES, CONF_DEFAULT_CHARSET) . '");' . "\n\n"
			. 'define("CONF_SITE_URL", "' . htmlspecialchars(filesys::setPath($_POST['site_url'], ENT_QUOTES, CONF_DEFAULT_CHARSET)) . '");' . "\n\n"
			. 'define("CONF_SCRIPT_URL", "' . htmlspecialchars(filesys::setPath($_POST['script_url'], ENT_QUOTES, CONF_DEFAULT_CHARSET)) . '");' . "\n\n"
			. 'define("CONF_USE_VISUAL_EDITOR", "' . ((!isset($_POST['visual_editor'])) ? 0	: 1) . '");' . "\n\n"
			. 'define("CONF_USE_REDIRECT_EXTERNAL_LINK", "' . ((!isset($_POST['redirect_extLink'])) ? 0 : 1) . '");' . "\n\n"
			. 'define("CONF_ENABLE_CACHING", "' . ($_POST['caching'] = ((!isset($_POST['caching'])) ? 0 : 1)) . '");' . "\n\n"
			. 'define("CONF_DISABLE_AUTO_COUNTERS", "' . ($_POST['disable_auto_counters'] = ((!isset($_POST['disable_auto_counters'])) ? 0 : 1)) . '");' . "\n\n"
			. 'define("CONF_ENABLE_CHPU", "' . $chpu . '");' . "\n\n"
			. 'define("CONF_ENABLE_TRANSLITERATION_CHPU", "' . $tChpu . '");' . "\n\n"
			. 'define("CONF_TRANSLITERATION_CHPU_ID_PUT_TO_END", "' . $tChpuPutToEnd . '");' . "\n\n"
			. 'define("CONF_TRANSLITERATION_CHPU_MAX_LENGHT", "' . htmlspecialchars($tChpuMaxLen, ENT_QUOTES, CONF_DEFAULT_CHARSET) . '");' . "\n\n"
			. 'define("CONF_CHPU_HTML_DATA_EXT", "' . htmlspecialchars($_POST['tChpuHtmlDataExt'], ENT_QUOTES, CONF_DEFAULT_CHARSET) . '");' . "\n\n"
			. 'define("CONF_CHPU_XML_DATA_EXT", "' . htmlspecialchars($_POST['tChpuXmlDataExt'], ENT_QUOTES, CONF_DEFAULT_CHARSET) . '");' . "\n";

	// сброс кеша сайта
	(CONF_ENABLE_CACHING != $_POST['caching'] || CONF_ENABLE_CHPU != $chpu || CONF_ENABLE_TRANSLITERATION_CHPU != $tChpu || CONF_TRANSLITERATION_CHPU_ID_PUT_TO_END != $tChpuPutToEnd) ? caching::dropCache() : null;

	// сохраняем изменения
	if (!tools::saveConfig('core/conf/const.config.site.php', $data, CONF_ADMIN_FILE . '?m=config&s=site')) {
		$arrErrors[] = ERROR_FILES_MISSING_FILE;
	}
}

$smarty->assign('language_dirs', filesys::getChildDirs('lang/')); // получаем список доступных дирректорий языков
$smarty->assignByRef('errors', $arrErrors);
