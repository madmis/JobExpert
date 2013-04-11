<?php
/********************************************************
	powered by Script Developers Group (SD-Group)
	email: info@sd-group.org.ua
	url: http://sd-group.org.ua/
	Copyright 2009 (c) SD-Group
	All rights reserved
=========================================================
	Функции работы с Кукисами
********************************************************/

(!defined('SDG')) ? die ('Triple protection!') : null;

class cookies
{
	/////////////////////////////////////////////////
	// VARS - свойства класса cookies
	/////////////////////////////////////////////////

	/////////////////////////////////////////////////
	// METHODS - методы класса cookies
	/////////////////////////////////////////////////

	/**
	* функция устанавливает куки
	* 
	* @param (string) $name - имя куки
	* @param (string) $value - значение куки
	* @param (int) $expires - время жизни куки (дней)
	* 
	* @return bool
	*/
	static function setCookieSite($name, $value, $expires = false)
	{
		(!empty($expires) && is_int($expires)) ? $expires = time() + ($expires * 86400) : null;

		return (!@setcookie($name, $value, $expires, '/')) ? false : true;
	}

	/**
	* функция удаляет куки, установленные для скрипта
	* 
	* @return void
	*/
	static function deleteAccessCookie()
	{
		// 2592000 - 30 дней
		setcookie('remid', '', time()-2592000, '/');
		setcookie('remh', '', time()-2592000, '/');
	}
	
	/////////////////////////////////////////////////
	// END OF CLASS cookies
	/////////////////////////////////////////////////
}

