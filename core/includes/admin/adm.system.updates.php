<?php
/********************************************************
	JobExpert v1.0
	powered by Script Developers Group (SD-Group)
	email: info@sd-group.org.ua
	url: http://sd-group.org.ua/
	Copyright 2010-2015 (c) SD-Group
	All rights reserved
=========================================================
	Обновления продукта
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
						array('name' => MENU_UPDATES, 'link' => CONF_ADMIN_FILE . '?m=system&s=updates')
					);

/**
* иницализация массива подключаемых шаблонов: по умолчанию все значения - false
* для подключения шаблона, необходимо установить значение - true
* шаблоны подключаются в порядке установленном в файле головного шаблона
*/
$arrActions = array(
				'config'	=> false,
				'backup'	=> false,
				'setup'		=> false,
                'saveLog'   => false,
				'logs'	    => false
			);
// определяем шаблон для отображения
(isset($_GET['action']) && isset($arrActions[$_GET['action']])) ? $arrActions[$_GET['action']] = true : null;

$updates = new updates();

/** Строка запроса из адресной строки браузера **/
$qString = !empty($_SERVER['QUERY_STRING']) ? $_SERVER['QUERY_STRING'] : 'm=system&s=updates';

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
			  . 'define("CONF_UPDATES_PATH_TO_FILES", "' . filesys::setPath($_POST['path']) . '");' . "\n";

		if (!tools::saveConfig('core/conf/const.config.updates.php', $data, CONF_ADMIN_FILE . '?m=system&s=updates&action=config'))
		{
			$arrErrors[] = ERROR_FILES_MISSING_FILE;
		}
	}
*/
}
// просмотр логов обновлений
elseif ($arrActions['logs']) {
	// удаление логов
	if (!empty($_POST['action'])) {
		if (('deleted' === $_POST['action']) && !empty($_POST['files']) && is_array($_POST['files'])) {
			foreach ($_POST['files'] as $key => $value) {
				unlink(CONF_UPDATES_PATH_TO_LOG_FILES . $key);
			}

			messages::messageChangeSaved(MESSAGE_CHANGE_SAVED, false, CONF_ADMIN_FILE . '?m=system&s=updates&action=logs');
		}
	}

    $arrNamePage[] = array('name' => MENU_UPDATES_LOGS, 'link' => false);
    $logFiles = filesys::getFilesInDir(CONF_UPDATES_PATH_TO_LOG_FILES);
    $arrData = array();

    if (!empty($logFiles) && is_array($logFiles))
    {
        foreach ($logFiles as &$value)
        {
			$fData = filesys::getFileSystemData(CONF_UPDATES_PATH_TO_LOG_FILES . $value);
			if (!empty($fData) && is_array($fData))
			{
				$arrData[$value] = $fData;
			}
        }
    }

    $smarty -> assignByRef('arrData', $arrData);
}
// страница создания резервных копий перед обновлением
elseif ($arrActions['backup'] && !empty($_GET['file']) && file_exists(CONF_UPDATES_PATH_TO_FILES . $_GET['file']))
{
	// массив проверки обновлений. Указывает, где будут производиться изменения
	// на основании этих данных определятся какие бэкапы нужно делать
	$arrBackup = array('php' => true, 'sql' => false);

	$zip = new PclZip(CONF_UPDATES_PATH_TO_FILES . $_GET['file']);

	// получаем текст из файла обновления
	if ($update = $zip -> extract(PCLZIP_OPT_BY_NAME, 'update.xml', PCLZIP_OPT_EXTRACT_AS_STRING))
	{
		$xml = new SimpleXMLElement($update[0]['content'], LIBXML_NOCDATA);

		//(property_exists($xml, 'php') || property_exists($xml, 'delfiles')) ? $arrBackup['php'] = true : null;
		(property_exists($xml, 'sql')) ? $arrBackup['sql'] = true : null;
	}
	$smarty -> assignByRef('arrBackup', $arrBackup);
	$smarty -> assignByRef('arcFile', $_GET['file']);
}
// страница установки обновления
elseif ($arrActions['setup'] && !empty($_GET['file']) && file_exists(CONF_UPDATES_PATH_TO_FILES . $_GET['file']))
{
	$smarty -> assignByRef('arcFile', $_GET['file']);
}
// отдаем на сохранеие файл логов
elseif ($arrActions['saveLog'] && !empty($_GET['file']))
{
	if (file_exists($_GET['file']))
	{
		header('Content-type: application/octet-stream');
		header('Content-Disposition: attachment; filename=' . basename($_GET['file']));
		readfile($_GET['file']);
		exit;
	}
	else
	{
		$arrErrors[] = ERROR_FILE_NOT_EXISTS;
	}
}
// выводим подробный список доступных обновлений
else
{
	// необходимо устанавливать действиям фолс, т.к. у них есть доп. условия
	$arrActions['backup'] = false;
	$arrActions['setup'] = false;

	// получаем форму обновления
	if (!empty($_POST['login']) && !empty($_POST['password']) && !empty($_POST['file']) && !empty($_POST['revision']))
	{
		$resUpdate = $updates -> getUpdate($_POST);
		if (!$resUpdate['status'])
		{
			$arrErrors[] = $resUpdate['error'];
		}
		else
		{
			// ставим сайт на тех обслуживание
			$data = "<?php\n\n"
				  . "(!defined('SDG')) ? die ('Triple protection!') : null;\n\n"
				  . 'define("CONF_SERVICE_ADMINISTRATION_MAINTENANCE", true);' . "\n";

			tools::saveConfig('core/conf/const.config.service.php', $data, false);

			messages::messageChangeSaved(MESSAGE_UPDATE_SUCCESSFULLY_DOWNLOADED, false, CONF_ADMIN_FILE . '?m=system&s=updates&action=backup&file=' . $_POST['file']);
		}
	}

	$smarty -> assignByRef('arrUpdates', $updates -> getUpdatesInfo());
}

// адресная строка
$smarty -> assignByRef('qString', $qString);
$smarty -> assignByRef('errors', $arrErrors);
$smarty -> assignByRef('action', $arrActions);