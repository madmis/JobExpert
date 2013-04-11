<?php
/********************************************************
	JobExpert v1.0
	powered by Script Developers Group (SD-Group)
	email: info@sd-group.org.ua
	url: http://sd-group.org.ua/
	Copyright 2010-2015 (c) SD-Group
	All rights reserved
=========================================================
	Обслуживание сайта - Языковой менеджер
********************************************************/
/**
* @package
* @todo
*/

(!defined('SDG')) ? die('Triple protection!') : null;

/**
* иницализация массива подключаемых шаблонов: по умолчанию все значения - false
* для подключения шаблона, необходимо установить значение - true
* шаблоны подключаются в порядке установленном в файле головного шаблона
*/
$arrActions = array(
						'localizConst'		=> false,
						'localizText'		=> false,
						'localizAgreement'	=> false
                   );

// определяем шаблон для отображения
(isset($_GET['action']) && isset($arrActions[$_GET['action']])) ? $arrActions[$_GET['action']] = true : null;

// инициируем "Наименование страницы" отображаемое в форме
$arrNamePage = array(
						array('name' => MENU_ADMIN_MAIN, 'link' => CONF_ADMIN_FILE),
						array('name' => MENU_SERVICE, 'link' => false),
						array('name' => MENU_LANGUAGE_MANAGER, 'link' => false)
					);

$selects = (isset($_POST['currLocaliz'])) ? new selects($_POST['currLocaliz']) : new selects();
$currLang = $selects -> retCurrLang();
$smarty -> assignByRef('currLang', $currLang); // текущая локализация

/**
* Действия
*/
if (!empty($arrActions['localizConst']))
{
	// инициируем "Наименование страницы" отображаемое в форме
	$arrNamePage[] = array('name' => MENU_LANGUAGE_LOCALIZ_CONST, 'link' => false);

	if (!empty($_POST['fileNameLocaliz']) && in_array($_POST['fileNameLocaliz'], filesys::getFilesInDir('lang/russian/')))
	{
		$fileNameLocaliz = array_pop($_POST);

		$arrData = array();
		foreach ($_POST as $constName => &$constValue)
		{
			$arrData[] = "define('" . strtoupper($constName) . "', '" . ((!empty($constValue)) ? $constValue : strtoupper($constName)) . "');";
		}

		$data = "<?php\n\n"
			  . "(!defined('SDG')) ? die ('Triple protection!') : null;\n\n"
			  . implode("\n\n", $arrData) . "\n";

		(file_put_contents("lang/$currLang/" . $fileNameLocaliz, $data)) ? messages::messageChangeSaved(MESSAGE_CHANGE_SAVED, false, CONF_ADMIN_FILE . '?m=service&s=language.manager&action=localizConst') : messages::messageChangeSaved(MESSAGE_CHANGE_NOT_SAVED, false, CONF_ADMIN_FILE . '?m=service&s=language.manager&action=localizConst');
	}

	$ownAdmin = (!empty($_GET['own']) && 'admin' === $_GET['own']) ? true : false;

	$smarty -> assignByRef('ownAdmin', $ownAdmin);
	$smarty -> assign('defLocalizConst', localiz::getLocalizConst('russian', $ownAdmin));
	$smarty -> assign('currLocalizConst', localiz::getLocalizConst($currLang, $ownAdmin));
}
elseif (!empty($arrActions['localizText']))
{
	// инициируем "Наименование страницы" отображаемое в форме
	$arrNamePage[] = array('name' => MENU_LANGUAGE_LOCALIZ_TEXT, 'link' => false);
	// создаем директорию, если она не существует
	(!is_dir("lang/$currLang/texts")) ? mkdir("lang/$currLang/texts", 0757) : null;
	// формируем данные
	foreach(filesys::getFilesInDir('lang/russian/texts/') as $fileName)
	{
		if (false !== strstr($fileName, '.txt'))
		{
			// создаем файл, если он не существует
			(!file_exists("lang/$currLang/texts/$fileName")) ? file_put_contents("lang/$currLang/texts/$fileName", '') : null;
			// записываем данные в массив
			$arrFilesList[] = array(
				'name'			=> $fileName,
				'id'			=> $id = str_replace('.', '_', $fileName),
				'text'			=> file_get_contents("lang/$currLang/texts/$fileName"),
				'description'	=> @constant('HELP_ADMIN_MAIL_' . strtoupper($id))
			);
		}
	}
	// передаем данные в Smarty
	$smarty -> assignByRef('files', $arrFilesList);
}
elseif (!empty($arrActions['localizAgreement']))
{
	// инициируем "Наименование страницы" отображаемое в форме
	$arrNamePage[] = array('name' => MENU_LANGUAGE_LOCALIZ_AGREEMENT, 'link' => false);
	// создаем директорию, если она не существует
	(!is_dir("lang/$currLang/texts")) ? mkdir("lang/$currLang/texts", 0757) : null;
	// создаем файл, если он не существует
	(!file_exists("lang/$currLang/texts/agreement.html")) ? file_put_contents("lang/$currLang/texts/agreement.html", '') : null;
	// сохраняем данные переданные из формы
	if (isset($_POST['agreement']))
	{
		// записываем данные в файл (текст Пользовательского Соглашения)
		(file_put_contents("lang/$currLang/texts/agreement.html", $_POST['agreement'])) ? messages::messageChangeSaved(MESSAGE_CHANGE_SAVED, false, CONF_ADMIN_FILE . '?m=service&s=language.manager&action=localizAgreement') : messages::messageChangeSaved(MESSAGE_CHANGE_NOT_SAVED, false, CONF_ADMIN_FILE . '?m=service&s=language.manager&action=localizAgreement');
	}
	// передаем данные в Smarty
	$smarty -> assign('agreement', file_get_contents("lang/$currLang/texts/agreement.html"));
}
else
{
	messages::error404();
}

// получаем список доступных дирректорий шаблонов
$langs = $selects -> retLangs();
$smarty -> assignByRef('langs', $langs); // список доступных локализаций

$smarty -> assignByRef('errors', $arrErrors);
$smarty -> assignByRef('action', $arrActions);
