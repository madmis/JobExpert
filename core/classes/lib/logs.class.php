<?php
/********************************************************
	JobExpert v1.0
	powered by Script Developers Group (SD-Group)
	email: info@sd-group.org.ua
	url: http://sd-group.org.ua/
	Copyright 2010-2015 (c) SD-Group
	All rights reserved
=========================================================
	Класс работы с логами
********************************************************/
/**
* @package
* @todo
*/

(!defined('SDG')) ? die ('Triple protection!') : null;

class logs
{
	/////////////////////////////////////////////////
	// VARS - свойства класса strings
	/////////////////////////////////////////////////

	/////////////////////////////////////////////////
	// METHODS - методы класса strings
	/////////////////////////////////////////////////

	/**
	* Функция логирует входы в админку
	* Если вход выполнен успешно, вместо пароля будет записано true (в целях защиты инф-ции)
	* 
	* @param array $arrData - массив данных, для записи в лог (array('login' => $_POST['login'], 'password' => $_POST['password'] or false))
	* @param bool $status - признак авторизации. TRUE - успешно, FALSE - ошибка
	* 
	* @return void
	*/
	static function logAdminAccess($arrData, $status)
	{ 
		/*
		$mess = "\n" . '================== ' . ($status ? 'SUCCESS' : 'FAIL') . ' (' . terms::currentDateTime()  . ') ==================' . "\n"
		  	  . 'LOGIN: ' . $arrData['login'] . "\n"
		  	  . 'PASSWORD: ' . ('yes' === $arrData['password'] ? 'true' : $arrData['password']) . "\n"
			  //. '$_POST DATA: ' . serialize($_POST) . "\n\n" - отключил, т.к. массив содержит логин и пароль администратора, что недопустимо логировать.
			  . 'USER IP: ' . $_SERVER['REMOTE_ADDR'] . "\n"
			  . 'USER ID: ' . (!isset($_SESSION['sd_user']['data']) ? 'false' : $_SESSION['sd_user']['data']['id']) . "\n"
			  . 'USER LOGIN: ' . (!isset($_SESSION['sd_user']['data']) ? 'false' : $_SESSION['sd_user']['data']['email']) . "\n"
			  . '============================================================================' . "\n\n";

		@error_log($mess, 3, 'core/data/log/adm.access.log');
		*/
		// Формируем данные для записи в MDA-файл
		$mdaData = filesys::getSerializedData('core/data/log/adm.access.mda');
		$mdaData[] = array(
						'login'			=> $arrData['login'],
						'password'		=> ('yes' === $arrData['password']) ? 'true' : $arrData['password'],
						'ip'			=> $_SERVER['REMOTE_ADDR'],
						'user_id'		=> !isset($_SESSION['sd_user']['data']) ? 'false' : $_SESSION['sd_user']['data']['id'],
						'user_login'	=> !isset($_SESSION['sd_user']['data']) ? 'false' : $_SESSION['sd_user']['data']['email'],
						'datetime'		=> terms::currentDateTime()
					);
		filesys::putSerializedData('core/data/log/adm.access.mda', $mdaData);
	}

	/**
	* Функция логирует платежи
	* 
	* @param (array) $arrData - массив данных, для записи в лог (array('field name' => field value))
	* @param (string) $status - статус платежа. (SUCCESS - успешно, FAIL - ошибка, WRONG PARAMS - оплата прошла, но от сервера получены неверные параметры)
	* @param (string or false) $mod - название мода, которым производилась оплата. По умолчанию false
	* 
	* @return string (сгенерированную лог-строку)
	*/
	static function logPaymentData($arrData, $status, $mod = false)
	{ 
		$mess = "\n" . '================== ' . strtoupper($status) . ' (' . terms::currentDateTime()  . ') ==================' . "\n";
		($mod) ? $mess .= 'MOD: ' . $mod . "\n" : null;
		
		foreach ($arrData as $key => $value)
		{
			$mess .= strtoupper($key) . ': ' . $value . "\n";
		}

		$mess .= "\n" . 'USER IP: ' . $_SERVER['REMOTE_ADDR'] . "\n"
			  . '============================================================================' . "\n\n";

		$file = ($mod) ? $mod . '_' . terms::currentDate() . '_payment.log' : terms::currentDate() . '_payment.log';

		@error_log($mess, 3, 'core/data/log/' . $file);
		return $mess;
	}

	/////////////////////////////////////////////////
	// END OF CLASS strings
	/////////////////////////////////////////////////
}
