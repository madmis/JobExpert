<?php
/********************************************************
	JobExpert v1.0
	powered by Script Developers Group (SD-Group)
	email: info@sd-group.org.ua
	url: http://sd-group.org.ua/
	Copyright 2010-2015 (c) SD-Group
	All rights reserved
=========================================================
	Логи - Платежи
********************************************************/
/**
* @package
* @todo
*/

(!defined('SDG')) ? die ('Triple protection!') : null;

// инициируем "Наименование страницы" отображаемое в форме
$arrNamePage = array(
					array('name' => MENU_ADMIN_MAIN, 'link' => CONF_ADMIN_FILE),
					array('name' => MENU_LOGS, 'link' => false),
					array('name' => MENU_LOGS_PAYMENTS, 'link' => CONF_ADMIN_FILE . '?m=logs&amp;s=payments')
				);

/**
* иницализация массива подключаемых шаблонов: по умолчанию все значения - false
* для подключения шаблона, необходимо установить значение - true
* шаблоны подключаются в порядке установленном в файле головного шаблона
*/
$arrActions = array(
				'files'		=> false,
				'redata'	=> false
			);

$payments = new payments();

// определяем шаблон для отображения
(isset($_GET['action']) && isset($arrActions[$_GET['action']])) ? $arrActions[$_GET['action']] = true : null;

/**
* массив, который возращается в форму
* содержит значения по умолчанию для формы отбора
*/
$retFields = array(
		'order_id'	=> false, // id статьи (статей)
		'records'	=> 30 // количество записей на странице по умолчанию
	);

/** Строка запроса из адресной строки браузера **/
$qString = !empty($_SERVER['QUERY_STRING']) ? $_SERVER['QUERY_STRING'] : 'm=logs&amp;s=payments';

/** Список файлов логов **/
if ($arrActions['files'])
{
	/** инициируем "Наименование страницы" отображаемое в форме **/
	$arrNamePage[] = array('name' => MENU_LOGS_FILES, 'link' => false);

	/** удаление файлов **/
	if (isset($_POST['action']))
	{
		if (('deleted' === $_POST['action']) && !empty($_POST['files']))
		{
			foreach (array_keys($_POST['files']) as $value)
			{
				unlink('core/data/log/' . $value);
			}
			messages::messageChangeSaved(MESSAGE_CHANGE_SAVED, false, CONF_ADMIN_FILE . '?' . $qString);
		}
	}
	// END удаление файлов

	$arrFiles = array();
	if ($globFiles = glob('core/data/log/*_payment.log'))
	{
		foreach (glob('core/data/log/*_payment.log') as $file)
		{
			$arrFiles[] = basename($file);
		}
	}

	$smarty -> assignByRef('arrFiles', $arrFiles);
}
else
{
	/** инициируем "Наименование страницы" отображаемое в форме **/
	$arrNamePage[] = array('name' => MENU_ACTION_VIEW, 'link' => false);

	/** удаление логов **/
	if (isset($_POST['action']))
	{
		if (('deleted' === $_POST['action']) && !empty($_POST['payments']))
		{
			(!$payments -> dbDeleteLogPayments('id IN (' . implode(',', secure::escQuoteData((array_keys($_POST['payments'])))) . ')')) ? $arrErrors[] = db::$message_error : messages::messageChangeSaved(MESSAGE_CHANGE_SAVED, false, CONF_ADMIN_FILE . '?' . $qString);
		}
	}
	// END удаление логов

	/** строка запроса по умолчанию **/
	$strWhere = "token IN ('active')";
	/** текущий обработанный URL **/
	$path = CONF_ADMIN_FILE . '?m=logs&amp;s=payments&amp;';

	/** отбор записей **/
	if (!empty($_GET['do']) && 'filter' === $_GET['do'])
	{
		$retFields = array(
				'order_id'	=> !empty($_GET['order_id']) ? $_GET['order_id'] : false,
				'records'	=> ((!empty($_GET['records']) && validate::checkNaturalNumber($_GET['records'])) ? validate::checkNaturalNumber($_GET['records']) : 30)
			);

		///////////////////////////////////////////////////////////////
		// Проверка данных, полученных из формы и формирование запроса
		///////////////////////////////////////////////////////////////

		/** ORDER ID **/
		!empty($retFields['order_id']) ? $strWhere .= " AND order_id LIKE " . secure::escQuoteData($retFields['order_id']) : null;
		
    	/** текущий обработанный URL **/
		$path .= 'do=filter&amp;order_id=' . $retFields['order_id'] . '&amp;records=' . $retFields['records'] . '&amp;';
	}

	/** смещение, всегда 0 (затем берется из $_GET) **/
	$offset = (!empty($_GET['offset']) && validate::checkNaturalNumber($_GET['offset'])) ? validate::checkNaturalNumber($_GET['offset']) : 0;

	$strLimit = array('strLimit' => $offset . ',' . $retFields['records'], 'calcRows' => true);

	if ($arrLogsPayments = $payments -> dbGetLogPayments($strWhere, false, $strLimit, false))
	{
		foreach ($arrLogsPayments as $key => &$value)
		{
			// вычисляем имя файла
			$fName = strtolower($value['payment_type']) . '_' . date('Y-m-d', strtotime($value['date'])) . '_payment.log';
			$arrLogsPayments[$key]['file'] = (file_exists('core/data/log/' . $fName)) ? $fName : false;
		}
	}

	/** формируем страницы **/
	$allRecords = $payments -> dbCntLogPayments(); // получаем общее количество строк
	$strPages = strings::generatePage($allRecords, $offset, $retFields['records'], $path, true); // формируем странциы

	$smarty->assignByRef('arrLogsPayments', $arrLogsPayments);
	$smarty->assignByRef('allRecords', $allRecords); //передаем в шаблон общее количество записей
	$smarty->assignByRef('strPages', $strPages); //передаем в шаблон строку сформированных страниц
}

$smarty -> assignByRef('retFields', $retFields);
// адресная строка
$smarty -> assignByRef('qString', $qString);
$smarty -> assignByRef('errors', $arrErrors);
$smarty -> assignByRef('actions', $arrActions);
