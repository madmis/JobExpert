<?php
/********************************************************
	JobExpert v1.0
	powered by Script Developers Group (SD-Group)
	email: info@sd-group.org.ua
	url: http://sd-group.org.ua/
	Copyright 2010-2015 (c) SD-Group
	All rights reserved
=========================================================
 	Класс WebMoney
********************************************************/
/**
* @package
* @todo
*/

(!defined('SDG')) ? die ('Triple protection!') : null;

class webmoney
{
	/////////////////////////////////////////////////
	// VARS - свойства класса webmoney
	/////////////////////////////////////////////////

	/////////////////////////////////////////////////
	// METHODS - методы класса webmoney
	/////////////////////////////////////////////////
 
	/**
	* функция генерации подписи
	* 
	* @param (array) $arrData - массив, должен содержать все данные для генерации, в соответсвующем порядке
	* 
	* @return string
	*/
	static function refSign($arrData)
	{
		return strtoupper(md5($arrData['LMI_PAYEE_PURSE'] . $arrData['LMI_PAYMENT_AMOUNT'] . $arrData['LMI_PAYMENT_NO'] . $arrData['LMI_MODE'] . $arrData['LMI_SYS_INVS_NO'] . $arrData['LMI_SYS_TRANS_NO'] . $arrData['LMI_SYS_TRANS_DATE'] . WEBMONEY_CONF_SECRET_KEY . $arrData['LMI_PAYER_PURSE'] . $arrData['LMI_PAYER_WM']));
	} 

	/**
	* функция проверяет параметры полученные от сервера webmoney в предварительном запросе ($_POST)
	* Проверяется наличие всех необходимых полей, услуга и ее стоимость
	*
	* @param (array) $arrData - массив параметров ($_POST от сервера Webmoney)
	* @param (array) $arrTariffs - тарифная сетка Webmoney
	* 
	* @return bool
	*/	
	static function checkPreResultParams(&$arrData, &$arrTariffs)
	{
		// проверяем порциями, чтобы было читабельнее
		if (!isset($arrData['LMI_PREREQUEST']) || !$arrData['LMI_PREREQUEST'])
		{
            return false;
		}

		// проверяем кошелек
		if (!isset($arrData['LMI_PAYEE_PURSE']) || !$arrData['LMI_PAYEE_PURSE'] || $arrData['LMI_PAYEE_PURSE'] !== WEBMONEY_CONF_PAYEE_PURSE)
		{
			return false;
		}

		if (!isset($arrData['LMI_PAYMENT_AMOUNT']) || !$arrData['LMI_PAYMENT_AMOUNT'] || !isset($arrData['LMI_PAYMENT_NO']) || !$arrData['LMI_PAYMENT_NO'])
		{
			return false;
		}
		if (!isset($arrData['LMI_MODE']) || !isset($arrData['LMI_PAYER_WM']) || !$arrData['LMI_PAYER_WM'] || !isset($arrData['LMI_PAYER_PURSE']) || !$arrData['LMI_PAYER_PURSE'])
		{
			return false;
		}
		if (!isset($arrData['LMI_PAYMENT_DESC']) || !$arrData['LMI_PAYMENT_DESC'] || !isset($arrData['SERVICE']) || !$arrData['SERVICE'])
		{
			return false;
		}

		// проверяем услугу и ее цену в тарифной сетке
        $payments = new payments();
		$service = $payments -> explodeServiceString($arrData['SERVICE']);
        if (!in_array($service[0], $arrTariffs) || $arrData['LMI_PAYMENT_AMOUNT'] != $arrTariffs[$service[0]])
		{
			return false;
		}

		return true;
	}

	/**
	* функция проверяет параметры полученные от сервера webmoney в оповещении о платеже ($_POST)
	* Проверяется наличие всех необходимых полей, услуга и ее стоимость
	*
	* @param (array) $arrData - массив параметров ($_POST от сервера Webmoney)
	* @param (array) $arrTariffs - тарифная сетка Webmoney
	* 
	* @return bool
	*/	
	static function checkResultParams(&$arrData, &$arrTariffs)
	{
		// проверяем порциями, чтобы было читабельнее
		if (!isset($arrData['LMI_PAYEE_PURSE']) || !$arrData['LMI_PAYEE_PURSE'] || $arrData['LMI_PAYEE_PURSE'] !== WEBMONEY_CONF_PAYEE_PURSE)
		{
			return false;
		}

		if (!isset($arrData['LMI_PAYMENT_AMOUNT']) || !$arrData['LMI_PAYMENT_AMOUNT'] || !isset($arrData['LMI_PAYMENT_NO']) || !$arrData['LMI_PAYMENT_NO'])
		{
			return false;
		}
		if (!isset($arrData['LMI_SYS_INVS_NO']) || !$arrData['LMI_SYS_INVS_NO'] || !isset($arrData['LMI_SYS_TRANS_NO']) || !$arrData['LMI_SYS_TRANS_NO'])
		{
			return false;
		}
		if (!isset($arrData['LMI_MODE']) || !isset($arrData['LMI_PAYER_WM']) || !$arrData['LMI_PAYER_WM'] || !isset($arrData['LMI_PAYER_PURSE']) || !$arrData['LMI_PAYER_PURSE'])
		{
			return false;
		}
		if (!isset($arrData['LMI_HASH']) || !$arrData['LMI_HASH'] || !isset($arrData['LMI_SYS_TRANS_DATE']) || !$arrData['LMI_SYS_TRANS_DATE'])
		{
			return false;
		}
		if (!isset($arrData['LMI_PAYMENT_DESC']) || !$arrData['LMI_PAYMENT_DESC'] || !isset($arrData['SERVICE']) || !$arrData['SERVICE'])
		{
			return false;
		}

		// проверяем подпись
		if (webmoney::refSign($arrData) != $arrData['LMI_HASH'])
		{
			return false;
		}

		// проверяем услугу и ее цену в тарифной сетке
        $payments = new payments();
        $service = $payments -> explodeServiceString($arrData['SERVICE']);
		if (!in_array($service[0], $arrTariffs) || $arrData['LMI_PAYMENT_AMOUNT'] != $arrTariffs[$service[0]])
		{
			return false;
		}

		return true;
	}

	/**
	* функция формирует строку для записи в лог платежей
	* Строка логов должна обязательно начинаться с наименования платежной системы.
	*
	* @param (array) $arrData - массив параметров (от сервера Webmoney)
	* @param (string) $status - статус платежа. (SUCCESS - успешно, FAIL - ошибка, WRONG PARAMS - оплата прошла, но от сервера liqpay получены неверные параметры)
	* 
	* @return string (serialsed array)
	*/	
	static function generateLogData(&$arrData, $status)
	{
		return serialize(array('payment_type' => 'WEBMONEY') + $arrData + array('status' => $status));

	/*
		$retStr = 'WEBMONEY::';
		foreach ($arrData as $key => $value)
		{
			$retStr .= $key . '=>' . $value . '::';
		}

		$retStr .= strtoupper($status);

		return $retStr;
	*/
	}

	/////////////////////////////////////////////////
	// END OF CLASS webmoney
	/////////////////////////////////////////////////
}
