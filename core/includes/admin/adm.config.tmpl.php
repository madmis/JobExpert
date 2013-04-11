<?php
/********************************************************
	JobExpert v1.0
	powered by Script Developers Group (SD-Group)
	email: info@sd-group.org.ua
	url: http://sd-group.org.ua/
	Copyright 2010-2015 (c) SD-Group
	All rights reserved
=========================================================
	Настройки - Smarty
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
						array('name' => MENU_CONFIG_SMARTY, 'link' => false)
					);

// сохраняем данные, переданные из формы
if (isset($_POST['save']))
{
	// если изменился шаблон, очищаем папку откомпилированных шаблонов
	//($_POST['template'] !== CONF_TEMPLATE) ? $smarty -> clearCompiledTemplate() : null;
	($_POST['template'] !== CONF_TEMPLATE) ? filesys::removeContentInDir(TEMPLATE_COMPILE_DIR) : null;

	$data = "<?php\n\n"
		  . "(!defined('SDG')) ? die ('Triple protection!') : null;\n\n"
		  . 'define("TEMPLATE_SMARTY_DIR", \'' . htmlspecialchars(filesys::setPath($_POST['smarty_dir'], ENT_QUOTES, CONF_DEFAULT_CHARSET)) . '\');' . "\n\n"
		  . 'define("TEMPLATE_ROOT_DIR", "' . htmlspecialchars(filesys::setPath($_POST['root_dir'], ENT_QUOTES, CONF_DEFAULT_CHARSET)) . '");' . "\n\n"
		  . 'define("CONF_TEMPLATE", "' . htmlspecialchars($_POST['template'], ENT_QUOTES, CONF_DEFAULT_CHARSET) . '");' . "\n\n"
		  . 'define("TEMPLATE_COMPILE_DIR", "' . htmlspecialchars(filesys::setPath($_POST['compile_dir'], ENT_QUOTES, CONF_DEFAULT_CHARSET)) . '");' . "\n\n"
		  . 'define("TEMPLATE_PATH", "' . htmlspecialchars(filesys::setPath($_POST['root_dir'], ENT_QUOTES, CONF_DEFAULT_CHARSET)) . 'site/' . htmlspecialchars($_POST['template'], ENT_QUOTES, CONF_DEFAULT_CHARSET) . '/");' . "\n\n"
		  . 'define("TEMPLATE_PATH_ADMIN", "' . htmlspecialchars(filesys::setPath($_POST['root_dir'], ENT_QUOTES, CONF_DEFAULT_CHARSET)) . 'admin/");' . "\n\n"
		  . 'define("TEMPLATE_DEBUGGING", "' . ((!isset($_POST['debugging'])) ? false : true) . '");' . "\n\n"
		  . 'define("TEMPLATE_COMPILE_CHECK", "' . ((!isset($_POST['compile_check'])) ? false : true) . '");' . "\n\n"
		  . 'define("TEMPLATE_FORCE_COMPILE", "' . ((!isset($_POST['force_compile'])) ? false : true) . '");' . "\n";

	if (!tools::saveConfig('core/conf/const.config.tmpl.php', $data, CONF_ADMIN_FILE . '?m=config&s=tmpl'))
	{
		$arrErrors[] = ERROR_FILES_MISSING_FILE;
	}
}

$smarty -> assign('templateDirs', filesys::getChildDirs(TEMPLATE_ROOT_DIR . 'site/')); // получаем список доступных дирректорий шаблонов
$smarty -> assignByRef('errors', $arrErrors);