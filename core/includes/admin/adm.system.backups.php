<?php
/********************************************************
	JobExpert v1.0
	powered by Script Developers Group (SD-Group)
	email: info@sd-group.org.ua
	url: http://sd-group.org.ua/
	Copyright 2010-2015 (c) SD-Group
	All rights reserved
=========================================================
	Резервные копии продукта
********************************************************/
/**
* @package
* @todo
*/

(!defined('SDG')) ? die('Triple protection!') : null;

// инициируем "Наименование страницы" отображаемое в форме
$arrNamePage = array(
						array('name' => MENU_ADMIN_MAIN, 'link' => CONF_ADMIN_FILE),
						array('name' => MENU_SYSTEM, 'link' => false),
						array('name' => MENU_BACKUPS, 'link' => CONF_ADMIN_FILE . '?m=system&s=backups')
					);

/**
* иницализация массива подключаемых шаблонов: по умолчанию все значения - false
* для подключения шаблона, необходимо установить значение - true
* шаблоны подключаются в порядке установленном в файле головного шаблона
*/
$arrActions = array(
				'config'	=> false
			);
// определяем шаблон для отображения
(isset($_GET['action']) && isset($arrActions[$_GET['action']])) ? $arrActions[$_GET['action']] = true : null;

$updates = new updates();

// настройки обновлений
if ($arrActions['config'])
{
/*
	// инициируем "Наименование страницы" отображаемое в форме
	$arrNamePage[] = array('name' => MENU_CONFIG, 'link' => false);

	if (isset($_POST['save'])) // сохраняем данные, переданные из формы
	{
		$data = "<?php\n\n"
			  . "(!defined('SDG')) ? die ('Triple protection!') : null;\n\n"
			  . 'define("CONF_BACKUPS_PATH_TO_FILES", "' . filesys::setPath($_POST['path']) . '");' . "\n";

   		if (!tools::saveConfig('core/conf/const.config.backups.php', $data, CONF_ADMIN_FILE . '?m=system&s=backups&action=config'))
		{
			$arrErrors[] = ERROR_FILES_MISSING_FILE;
		}
	}
*/
}
else
{
	/**
	* удаление файлов
	*/
	if (isset($_POST['action']))
	{
		if (('del' === $_POST['action']) && !empty($_POST['files']))
		{
			foreach ($_POST['files'] as $key => $value)
			{
				unlink($key);
			}
			messages::messageChangeSaved(MESSAGE_CHANGE_SAVED, false, CONF_ADMIN_FILE . '?m=system&s=backups');
		}
	}

	$arrFiles = backup::getBackupFiles();
	$smarty -> assignByRef('arrFiles', $arrFiles);
}

$smarty -> assignByRef('errors', $arrErrors);
$smarty -> assignByRef('action', $arrActions);
