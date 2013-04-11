<?php

/* * ******************************************************
  JobExpert v1.0
  powered by Script Developers Group (SD-Group)
  email: info@sd-group.org.ua
  url: http://sd-group.org.ua/
  Copyright 2010-2015 (c) SD-Group
  All rights reserved
  =========================================================
  Класс intellectmoney
 * ****************************************************** */
/**
 * @package
 * @todo
 */
(!defined('SDG')) ? die('Triple protection!') : null;

class intellectmoney {
	/**
	 * функция генерации подписи
	 * @param (array) $arrData - массив, должен содержать все данные для генерации, в соответсвующем порядке
	 * @return string
	 */
	static function refSign($arrData) {
		return strtoupper(md5(INTELLECTMONEY_CONF_PAYEE_PURSE
								. $arrData['LMI_PAYMENT_AMOUNT']
								. $arrData['LMI_PAYMENT_NO']
								. $arrData['LMI_MODE']
								. $arrData['LMI_SYS_INVS_NO']
								. $arrData['LMI_SYS_TRANS_NO']
								. $arrData['LMI_SYS_TRANS_DATE']
								. INTELLECTMONEY_CONF_SECRET_KEY
								. $arrData['LMI_PAYER_PURSE']
								. $arrData['LMI_PAYER_WM']));
	}

	/**
	 * Функция пока не используется. В ответе нет сервисных параметров для обработки
	 * 
	 * функция проверяет параметры полученные от сервера intellectmoney в предварительном запросе ($_POST)
	 * Проверяется наличие всех необходимых полей, услуга и ее стоимость
	 * @param (array) $arrData - массив параметров ($_POST от сервера intellectmoney)
	 * @param (array) $arrTariffs - тарифная сетка intellectmoney
	 * @return bool
	 */
	static function checkPreResultParams(&$arrData, &$arrTariffs) {
		// проверяем порциями, чтобы было читабельнее
		if (empty($arrData['LMI_PAYEE_PURSE']) || $arrData['LMI_PAYEE_PURSE'] != INTELLECTMONEY_CONF_PAYEE_PURSE) {
			return false;
		}

		if (empty($arrData['LMI_PAYMENT_AMOUNT']) || empty($arrData['LMI_PAYMENT_NO'])) {
			return false;
		}

		return true;
	}

	/**
	 * функция проверяет параметры полученные от сервера intellectmoney в оповещении о платеже ($_POST)
	 * Проверяется наличие всех необходимых полей, услуга и ее стоимость
	 * @param (array) $arrData - массив параметров ($_POST от сервера intellectmoney)
	 * @param (array) $arrTariffs - тарифная сетка intellectmoney
	 * @return bool
	 */
	static function checkResultParams(&$arrData, &$arrTariffs) {
		// проверяем порциями, чтобы было читабельнее
		if (empty($arrData['LMI_PAYEE_PURSE']) || $arrData['LMI_PAYEE_PURSE'] != INTELLECTMONEY_CONF_PAYEE_PURSE) {
			return false;
		}

		if (empty($arrData['LMI_PAYMENT_AMOUNT']) || empty($arrData['LMI_PAYMENT_NO'])) {
			return false;
		}
		if (empty($arrData['LMI_SYS_INVS_NO']) || empty($arrData['LMI_SYS_TRANS_NO'])) {
			return false;
		}
		if (empty($arrData['LMI_HASH']) || empty($arrData['LMI_SYS_TRANS_DATE'])) {
			return false;
		}
		if (empty($arrData['SERVICE'])) {
			return false;
		}

		// проверяем подпись
		if (self::refSign($arrData) != strtoupper($arrData['LMI_HASH'])) {
			return false;
		}

		// проверяем услугу и ее цену в тарифной сетке
		$payments = new payments();
		$service = $payments->explodeServiceString($arrData['SERVICE']);
		if (!in_array($service[0], $arrTariffs) || $arrData['LMI_PAYMENT_AMOUNT'] != $arrTariffs[$service[0]]) {
			return false;
		}

		return true;
	}

	/**
	 * функция формирует строку для записи в лог платежей
	 * Строка логов должна обязательно начинаться с наименования платежной системы.
	 * @param (array) $arrData - массив параметров (от сервера INTELLECTMONEY)
	 * @param (string) $status - статус платежа. 
	 * (SUCCESS - успешно, FAIL - ошибка, WRONG PARAMS - оплата прошла, но от сервера получены неверные параметры)
	 * @return string (serialsed array)
	 */
	static function generateLogData(&$arrData, $status) {
		return serialize(array('payment_type' => 'INTELLECTMONEY') + $arrData + array('status' => $status));
	}

	/////////////////////////////////////////////////
	// END OF CLASS intellectmoney
	/////////////////////////////////////////////////
}
