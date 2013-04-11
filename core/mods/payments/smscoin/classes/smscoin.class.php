<?php
/********************************************************
	JobExpert v1.0
	powered by Script Developers Group (SD-Group)
	email: info@sd-group.org.ua
	url: http://sd-group.org.ua/
	Copyright 2010-2015 (c) SD-Group
	All rights reserved
=========================================================
 	Класс SMSCOIN
********************************************************/
/**
* @package
* @todo
*/

(!defined('SDG')) ? die ('Triple protection!') : null;

class smscoin
{
	/////////////////////////////////////////////////
	// VARS - свойства класса smscoin
	/////////////////////////////////////////////////

	/////////////////////////////////////////////////
	// METHODS - методы класса smscoin
	/////////////////////////////////////////////////

	/**
	* функция возвращает MD5-строки параметров SMSCOIN. Параметры должны быть переданы в четко определенной последовательности (смотреть на сайте смскоин)
	*
	* @param (array) $arrData - массив параметров
	* 
	* @return (string) md5($arrData)
	*/	
	static function refSign($arrData)
	{
		$prehash = implode('::', $arrData);
		return md5($prehash);
	}

	/**
	* функция проверяет параметры полченные от сервера SmsCoin в $_POST (Result URL)
	*
	* @param (array) $arrData - массив параметров ($_POST от сервера SmsCoin)
	* 
	* @return bool
	*/	
	static function checkResultParams(&$arrData)
	{
		if (isset($arrData['s_purse']) && isset($arrData['s_order_id']) && isset($arrData['s_amount']) && isset($arrData['s_clear_amount']) && isset($arrData['s_inv']) && isset($arrData['s_phone']) && isset($arrData['s_sign_v2']) && isset($arrData['sd_service']) && $arrData['sd_service'])
		{
			return ($arrData['s_sign_v2'] === smscoin::refSign(array(SMSCOIN_CONF_BANK_SECRET_CODE, $arrData['s_purse'], $arrData['s_order_id'], $arrData['s_amount'], $arrData['s_clear_amount'], $arrData['s_inv'], $arrData['s_phone']))) ? true : false;
		}
		else
		{
			return false;
		}
	}

	/**
	* функция проверяет параметры полченные от сервера SmsCoin в $_POST (Success URL или Fail URL)
	*
	* @param (array) $arrData - массив параметров ($_POST от сервера SmsCoin)
	* 
	* @return bool
	*/	
	static function checkStatusParams(&$arrData)
	{
		if (isset($arrData['s_purse']) && isset($arrData['s_order_id']) && isset($arrData['s_amount']) && isset($arrData['s_clear_amount']) && isset($arrData['s_status']) && isset($arrData['s_sign']) && isset($arrData['sd_service']) && $arrData['sd_service'])
		{
			return ($arrData['s_sign'] === smscoin::refSign(array(SMSCOIN_CONF_BANK_SECRET_CODE, $arrData['s_purse'], $arrData['s_order_id'], $arrData['s_amount'], $arrData['s_clear_amount'], $arrData['s_status']))) ? true : false;
		}
		else
		{
			return false;
		}
	}

	/**
	* функция формирует строку для записи в лог платежей
	* Строка логов должна обязательно начинаться с наименования платежной системы.
	*
	* @param (array) $arrData - массив параметров ($_POST от сервера SmsCoin)
	* @param (string) $status - статус платежа. (SUCCESS - успешно, FAIL - ошибка, WRONG PARAMS - оплата прошла, но от сервера smscoin получены неверные параметры)
	* 
	* @return string (serialsed array)
	*/	
	static function generateLogData(&$arrData, $status)
	{
		return serialize(array('payment_type' => 'SMSCOIN') + $arrData + array('status' => $status));
	/*
		$retStr = 'SMSCOIN::';
		foreach ($arrData as $key => $value)
		{
			$retStr .= $key . '=>' . $value . '::';
		}

		$retStr .= strtoupper($status);

		return $retStr;
	*/
	}

	/////////////////////////////////////////////////
	// END OF CLASS smscoin
	/////////////////////////////////////////////////
}
