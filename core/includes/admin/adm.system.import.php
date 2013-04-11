<?php
/********************************************************
	JobExpert v1.0
	powered by Script Developers Group (SD-Group)
	email: info@sd-group.org.ua
	url: http://sd-group.org.ua/
	Copyright 2010-2015 (c) SD-Group
	All rights reserved
=========================================================
	Импорт
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
						'mds'	=> false
                   );

// определяем шаблон для отображения
(isset($_GET['action']) && isset($arrActions[$_GET['action']])) ? $arrActions[$_GET['action']] = true : null;

// инициируем "Наименование страницы" отображаемое в форме
$arrNamePage = array(
						array('name' => MENU_ADMIN_MAIN, 'link' => CONF_ADMIN_FILE),
						array('name' => MENU_SYSTEM, 'link' => false),
						array('name' => MENU_SYSTEM_IMPORT, 'link' => false)
					);

if (!empty($arrActions['mds']))
{
	// инициируем "Наименование страницы" отображаемое в форме
	$arrNamePage[] = array('name' => MENU_SYSTEM_IMPORT_MDS, 'link' => false);

	if (file_exists('core/data/mdsImport.mda'))
	{
		$arrData = filesys::getSerializedData('core/data/mdsImport.mda');

		foreach($arrData as $table => &$arrDataTable)
		{
			if (empty($arrData[USR_PREFIX . 'users']) && DB_PREFIX . 'conf_users' === $table)
			{
				$table = USR_PREFIX . 'users';
			}
			elseif (DB_PREFIX . 'conf_users' === $table)
			{
				continue;
			}

			$arrResult[] = array(
				'table' => $table,
				'size' => (USR_PREFIX . 'users' === $table) ? count($arrDataTable) * 2 : count($arrDataTable)
			);
		}
		// передаем данные для отображения прогресса импорта
		$smarty -> assign('importData', ajax::sdgJSONencode($arrResult));
		// включаем страницу отображения прогресса импорта
		$smarty -> assign('importContinueProgress', true);
		// включаем предупреждение
		$arrWarnings[] = FORM_SYSTEM_IMPORT_WARNING;
		$smarty -> assign('warnings', $arrWarnings);
	}
	elseif (isset($_POST['execute']))
	{
		(!validate::postDataNotEmpty()) ? $arrErrors[] = ERROR_EMPTY_FORM_FIELDS : null;

		//(!import::dbConnect($_POST['dbhost'], $_POST['dbname'], $_POST['dbuser'], '')) ? $arrErrors[] = ERROR_CONNECT_DB : null;
		(!import::dbConnect($_POST['dbhost'], $_POST['dbname'], $_POST['dbuser'], $_POST['dbpassword'])) ? $arrErrors[] = ERROR_CONNECT_DB : null;

		if (empty($arrErrors))
		{
            $arrTables = array(
            	'subscription'	=> &$_POST['table_subscription'],
            	'vacancy'		=> &$_POST['table_vacancy'],
            	'resume'		=> &$_POST['table_resume'],
            	'city'			=> &$_POST['table_city'],
            	'region'		=> &$_POST['table_region'],
            	'profession'	=> &$_POST['table_profession'],
            	'section'		=> &$_POST['table_section'],
            	'users'			=> &$_POST['table_users'],
            	'news'			=> &$_POST['table_news']
            );
			// передаем данные для отображения прогресса импорта
			$smarty -> assign('importData', import::mdsImportDB($arrTables));
			// включаем страницу отображения прогресса импорта
			$smarty -> assign('importShowProgress', true);
			// включаем предупреждение
			$arrWarnings[] = FORM_SYSTEM_IMPORT_WARNING;
			$smarty -> assign('warnings', $arrWarnings);
		}
	}
}
else
{
	messages::error404();
}

$smarty -> assignByRef('errors', $arrErrors);
