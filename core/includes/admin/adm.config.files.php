<?php
/********************************************************
	JobExpert v1.0
	powered by Script Developers Group (SD-Group)
	email: info@sd-group.org.ua
	url: http://sd-group.org.ua/
	Copyright 2010-2015 (c) SD-Group
	All rights reserved
=========================================================
	Настройки - Файлы
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
						array('name' => MENU_CONFIG_FILES, 'link' => false)
					);

// сохраняем данные, переданные из формы
if (isset($_POST['save']))
{
	$data = "<?php\n\n"
		  . "(!defined('SDG')) ? die ('Triple protection!') : null;\n\n"
		  . 'define("CONF_FILES_MAX_SIZE", "' . ((int) $_POST['max_size'] ? (int) $_POST['max_size'] : 10000) . '");' . "\n\n"
		  . 'define("CONF_FILES_IMG_CREATE_WATERMARK", "' . (isset($_POST['create_watermark']) ? true : false) . '");' . "\n\n"
		  . 'define("CONF_FILES_IMG_CREATE_WATERMARK_ON", "' . $_POST['watermark_on'] . '");' . "\n\n"
		  . 'define("CONF_FILES_IMG_WATERMARK_ALIGNMENT", "' . strtoupper($_POST['watermark_alignment']) . '");' . "\n\n"
		  . 'define("CONF_FILES_IMG_WATERMARK_TYPE", "' . $_POST['watermark_type'] . '");' . "\n\n"
		  . 'define("CONF_FILES_IMG_WATERMARK_IMAGE", "' . htmlspecialchars($_POST['watermark_image'], ENT_QUOTES, CONF_DEFAULT_CHARSET) . '");' . "\n\n"
		  . 'define("CONF_FILES_IMG_WATERMARK_TEXT", "' . htmlspecialchars($_POST['watermark_text'], ENT_QUOTES, CONF_DEFAULT_CHARSET) . '");' . "\n\n"
		  . 'define("CONF_FILES_IMG_WATERMARK_FONT", "' . $_POST['font'] . '");' . "\n\n"
		  . 'define("CONF_FILES_IMG_WATERMARK_FONT_SIZE", "' . ((int) $_POST['font_size'] ? (int) $_POST['font_size'] : 17) . '");' . "\n\n"
		  . 'define("CONF_FILES_IMG_WATERMARK_FONT_COLOR", "' . htmlspecialchars($_POST['font_color'], ENT_QUOTES, CONF_DEFAULT_CHARSET) . '");' . "\n\n"
		  . 'define("CONF_FILES_IMG_WATERMARK_TRANSPARENT", "' . ((int) $_POST['transparent'] ? (int) $_POST['transparent'] : 0) . '");' . "\n";

	if (!tools::saveConfig('core/conf/const.config.files.php', $data, CONF_ADMIN_FILE . '?m=config&s=files'))
	{
		$arrErrors[] = ERROR_FILES_MISSING_FILE;
	}
}

$smarty -> assign('fonts', filesys::getFilesInDir('core/fonts/')); // получаем список доступных дирректорий шаблонов
$smarty -> assignByRef('errors', $arrErrors);
