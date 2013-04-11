<?php
/********************************************************
	JobExpert v1.0
	powered by Script Developers Group (SD-Group)
	email: info@sd-group.org.ua
	url: http://sd-group.org.ua/
	Copyright 2010-2015 (c) SD-Group
	All rights reserved
=========================================================
 	Класс LiqPay
********************************************************/
/**
* @package
* @todo
*/

(!defined('SDG')) ? die ('Triple protection!') : null;

class liqpay
{
	/////////////////////////////////////////////////
	// VARS - свойства класса liqpay
	/////////////////////////////////////////////////

	/////////////////////////////////////////////////
	// METHODS - методы класса liqpay
	/////////////////////////////////////////////////

	/**
	* функция генерации подписи
	* 
	* @param (array) $arrData - массив, должен содержать все данные для генерации array(xml, LIQPAY_CONF_SIGNATURE)
	* 
	* @return string
	*/
	static function refSign($arrData)
	{
		return base64_encode(sha1($arrData[1] . $arrData[0] . $arrData[1], 1));
	} 

	/**
	* функция парсинга параметра orderId
	* 
	* @param (string) $orderId - параметр ответа orderId
	* 
	* @return array (массив из двух значений. Первое: сервисные поля, Второе: id операции)
	*/
	static function parseOrderId($orderId)
	{
		return $result = explode('.', $orderId);
	}
	
	/**
	* функция возвращает массив созданный из xml
	* 
	* @param (string) $xml - xml
	* 
	* @return array
	*/
	static function xmlToArray($xml)
	{
		function isObj($arr)
		{
			return is_object($arr) ? '0' : $arr;
		}

	    $xmlObj = new SimpleXMLElement($xml);
		$arrData = get_object_vars($xmlObj);
		// убираем SimpleXML объекты из массива
		return array_map('isObj', $arrData);
	}
	
	/**
	* функция проверяет параметры полченные от сервера LiqPay (Server URL)
	* Возмвращает массив, где:
	* 	1-й ключ - это состояние ответа
	* 	2-й ключ - массив с данными ответа
	*
	* @param (string) $operation_xml
	* @param (string) $signature
	* @param (string) $conf_signature - значение константы LIQPAY_CONF_SIGNATURE из файла настроек модуля liqpay (liqpay.conf.php)
	* 
	* @return array (status, arrData)
	*/	
	static function checkResultParams(&$operation_xml, &$signature, $conf_signature)
	{
		$arrResult = array();
		// декодируем полученный ответ
		$xmlstr = base64_decode($operation_xml);
		// создаем массив из xml
		$arrData = self::xmlToArray($xmlstr);
		// парсим поле order_id
		$arrOrderId = self::parseOrderId($arrData['order_id']);
		$arrData['order_id'] = $arrOrderId[1];
		$arrData['service'] = $arrOrderId[0];

		$arrResult['status'] = ($signature !== self::refSign(array($xmlstr, $conf_signature))) ? false : true;
		$arrResult['data'] = $arrData;

		return $arrResult;
	}

	/**
	* функция формирует строку для записи в лог платежей
	* Строка логов должна обязательно начинаться с наименования платежной системы.
	*
	* @param (array) $arrData - массив параметров (от сервера LiqPay)
	* @param (string) $status - статус платежа. (SUCCESS - успешно, FAIL - ошибка, WRONG PARAMS - оплата прошла, но от сервера liqpay получены неверные параметры)
	* 
	* @return string (serialsed array)
	*/	
	static function generateLogData(&$arrData, $status)
	{
		// status должен быть в конце массива
		if (!empty($arrData['status']))
		{
			unset($arrData['status']);
		}
		return serialize(array('payment_type' => 'LIQPAY') + $arrData + array('status' => $status));
	/*
		$retStr = 'LIQPAY::';
		foreach ($arrData as $key => $value)
		{
			$retStr .= $key . '=>' . $value . '::';
		}

		$retStr .= strtoupper($status);

		return $retStr;
	*/
	}


	/////////////////////////////////////////////////
	// END OF CLASS liqpay
	/////////////////////////////////////////////////
}
