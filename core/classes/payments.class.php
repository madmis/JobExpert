<?php
/********************************************************
	JobExpert v1.0
	powered by Script Developers Group (SD-Group)
	email: info@sd-group.org.ua
	url: http://sd-group.org.ua/
	Copyright 2010-2015 (c) SD-Group
	All rights reserved
=========================================================
 	Класс работы с модами оплат
********************************************************/
/**
* @package
* @todo
*/

(!defined('SDG')) ? die ('Triple protection!') : null;

class payments extends bpayments
{
	/////////////////////////////////////////////////
	// VARS - свойства класса payments
	/////////////////////////////////////////////////

	/////////////////////////////////////////////////
	// CONSTRUCTOR - конструктор класса payments
	/////////////////////////////////////////////////
	/**
	* конструктор
	* 
	* Инициирует имя таблицы БД
	* 
	*/
	public function __construct()
	{
		parent::__construct();
	}

	/////////////////////////////////////////////////
	// METHODS - методы класса payments
	/////////////////////////////////////////////////

	/********** перегрузка методов родительских классов **********/
	/**
	* Функция генерации данных для вывода существующих модов оплат
	* 
	* @return array or false
	*/
	public function generateModsList()
	{
		return parent::generateModsList();
	}

	/**
	* функция получает данные записи
	* 
	* @param (string) $strWhere - выражение для оператора WHERE
	* @param (array) $fields - массив полей для выборки (key: index => val: name field). По у молчанию false
	* 
	* @return array or false
	*/
	public function getRecord($strWhere, $fields = false)
	{
		return $this -> pGetRecord($strWhere, $fields);
	}

 	/**
	* функция обновления записей
	* 
	* @param (array) $arrData - массив данных для обновления (key: name field => val: value field)
	* @param (string) $strWhere - выражение для оператора WHERE or false (по умолчанию false)
	* 
	* @return bool
	*/
	public function updateRecords($arrData, $strWhere = false)
	{
		return $this -> pUpdateRecords($arrData, $strWhere);
	}

	/**
	* Функция получения активных модулей оплат
	* 
	* @return array or false
	*/
	public function getActiveMods()
	{
		return parent::getActiveMods();
	}

	/**
	* Функция проверяет наличие обязательных файлов мода
	* 
	* @param (string) $mod - id мода
	* 
	* @return bool
	*/
	public function checkBindFiles(&$mod)
	{
		return parent::checkBindFiles($mod);
	}

	/**
	* Функция проверяет, установлена ли цена в тарифной сетке для выбранной услуги
	* 
	* @param (string) $service - строка, определяющая услугу (соответствует одному из ключей массива $arrTariffs)
	* @param (array) $arrTariffs - тарифная сетка мода
	* 
	* @return bool
	*/
	public function checkPriceInTariff(&$service, &$arrTariffs)
	{
		return parent::checkPriceInTariff($service, $arrTariffs);
	}

	/**
	* Функция возвращает описание выбранной услуги
	* 
	* @param (string) $service - строка, определяющая услугу (соответствует одному из ключей массива $arrTariffs)
	* 
	* @return string or false
	*/
	public function generatePaymentDescription(&$service)
	{
		return parent::generatePaymentDescription($service);
	}

	/**
	* Функция проверяет наличие мода в БД
	* 
	* @param (string) $strWhere - выражение для оператора WHERE
	* 
	* @return bool
	*/
	public function issetMod($strWhere)
	{
		return parent::issetMod($strWhere);
	}

	/**
	* Функция установки модов (добавления их в БД)
	* 
	* @param $arrMods - массив модов, которые необходимо установить (array('liqpay', 'smscoin', ...))
	* 
	* @return bool
	*/
	public function installMods(&$arrMods)
	{
		return parent::installMods($arrMods);
	}
	
	/**
	* функция удаляет выбранные моды
	* 
	* @param (array) $arrMods - массив, содержащий id модов для удаления
	* 
	* @return bool
	*/
	public function deleteMods(&$arrMods)
	{
		return parent::deleteMods($arrMods);
	}

	/**
	* функция включает/выключает выбранные моды
	* 
	* @param (array) $arrMods - массив, содержащий id модов для включения/выключения
	* @param (bool) $falg - флаг (true|false) определяющий, включить (true) или выключить (false) мод. По умолчанию true.
	* 
	* @return bool
	*/
	public function enableMods(&$arrMods, $flag = true)
	{
		return parent::enableMods($arrMods, $flag);
	}

	/**
	* функция сохраняет настройки выбранного мода
	* 
	* @param (string) $mod - id мода, настройки которого необходимо сохранить
	* @param (array) $arrData - массив, содержащий парметры, которые необходимо записать (по идее это весь масив $_POST)
	* 
	* @return bool
	*/
	public function saveModConf(&$mod, &$arrData)
	{
		return parent::saveModConf($mod, $arrData);
	}

	/**
	* функция сохраняет тарифную сетку выбранного мода
	* 
	* @param (string) $mod - id мода, тарифы которого необходимо сохранить
	* @param (array) $arrData - массив, содержащий парметры, которые необходимо записать (по идее это весь масив $_POST)
	* 
	* @return bool
	*/
	public function saveModTariffs(&$mod, &$arrData, &$arrPayments)
	{
		return parent::saveModTariffs($mod, $arrData, $arrPayments);
	}

	/**
	* функция выполняет необходимое действие, в соответствии с полученными параметрами
	* 
	* @param (string) $action - строка, определяющая услугу (соответствует одному из ключей массива $arrTariffs)
	* @param (string) $id - id строки в БД, с которой необходимо выполнить действие
	* @param (string) $logData - строка параметров платежа, для записи в таблицу логов оплат
	* @param (int) $order_id - номер платежа в системе
	* 
	* @return bool
	*/
	public function doAction(&$action, &$id, &$logData, $order_id)
	{
		return parent::doAction($action, $id, $logData, $order_id);
	}

	/**
	* функция разбивает сервисную строку на массив
	* На данный момент строка содержите: наименование услуги и id строки в БД, с которой необходимо произвести действие,
	* разделеннные двойным знаком процента (%%) $_SESSION['payment']['service']%%$_SESSION['payment']['id']
	*
	* @param (string) $str - сервисная строка
	* 
	* @return array
	*/	
	public function explodeServiceString(&$str)
	{
		return parent::explodeServiceString($str);
	}

	/**
	* функция обработки успешной оплаты
	* 
	* @param (string) $action - строка, определяющая услугу (соответствует одному из ключей массива $arrTariffs)
	* 
	* @return выводит сообщение и выполняет переадресацию страницы
	*/
	public function succesAnswer(&$action)
	{
		parent::succesAnswer($action);
	}

	/**
	* функция рассылки почтовых сообщений администратору при оплате на сайте
	* 
	* @param (string) $data - данные платежа
	* @param (string) $status - статус платежа. (SUCCESS - успешно, FAIL - ошибка, WRONG PARAMS - оплата прошла, но от сервера smscoin получены неверные параметры)
	* 
	* @return void
	*/
	public function sendAdminEmail(&$data, $status)
	{
		return parent::sendAdminEmail($data, $status);
	}

	/********** END перегрузка методов родительских классов **********/

	/**
	* функция получает данные одной записи
	* 
	* @param (string) $strWhere - выражение для оператора WHERE
	* @param (array) $fields - массив полей для выборки (key: index => val: name field). По у молчанию false
	* 
	* @return array or bool
	*/
	public function dbGetLogPayment($strWhere, $fields = false)
	{
		return $this -> pDBGetLogPayment($strWhere, $fields);
	}

	/**
	* функция получения данных из таблицы логов оплат
	* 
	* @param (string) $strWhere - условие WHERE для запроса or false
	* @param (array) $arrOrderBy - массив параметров сортировки результата выборки (key: name field => val: ASC | DESC) or false (в этом случае сортировка 'datetime' => 'DESC')
	* @param (string) $strLimit - выражение для оператора LIMIT or false
	* @param (array) $fields - массив полей для выборки (key: index => val: name field)
	* 
	* @return bool
	*/
	public function dbGetLogPayments($strWhere, $arrOrderBy, $strLimit, $fields)
	{
		return ($this -> pDBGetLogPayments($strWhere, $arrOrderBy, $strLimit, $fields)) ? $this -> retData() : false;
	}

	/**
	* Функция подсчитывает кол-во строк в БД
	* 
	* @param (string) $strWhere - выражение для оператора WHERE, если false, то подсчет строк берется из SELECT FOUND_ROWS
	* 
	* @return int or false
	*/
	public function dbCntLogPayments($strWhere= false)
	{
		return $this -> pDBCntLogPayments($strWhere);
	}

	/**
	* функция помечает строки как удаленные
	* 
	* @param (string) $strWhere - выражение для оператора WHERE (необязательный параметр)
	* 
	* @return bool
	*/
	public function dbDeleteLogPayments($strWhere)
	{
		return $this -> pDBDeleteLogPayments($strWhere);
	}

 	/**
	* функция обновления записей
	* 
	* @param (array) $arrData - массив данных для обновления (key: name field => val: value field)
	* @param (array) $arrID - массив, содержащий id записей для обновления (id_1, id_2, ..., id_n)
	* @param (string) $strWhere - выражение для оператора WHERE or false (по умолчанию false)
	* 
	* @return bool
	*/
	public function dbUpdateLogPayments($arrData, $arrID, $strWhere = false)
	{
		return $this -> pDBUpdateLogPayments($arrData, $arrID, $strWhere);
	}

	/////////////////////////////////////////////////
	// END OF CLASS payments
	/////////////////////////////////////////////////
}

