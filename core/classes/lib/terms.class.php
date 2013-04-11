<?php
/********************************************************
	powered by Script Developers Group (SD-Group)
	email: info@sd-group.org.ua
	url: http://sd-group.org.ua/
	Copyright 2009 (c) SD-Group
	All rights reserved
=========================================================
	Функции работы с датой и временем
********************************************************/

(!defined('SDG')) ? die ('Triple protection!') : null;

/**
* Класс работы с датой и временем
* 	
*/
class terms
{
	/////////////////////////////////////////////////
	// VARS - свойства класса terms
	/////////////////////////////////////////////////

	/////////////////////////////////////////////////
	// METHODS - методы класса terms
	/////////////////////////////////////////////////

	/**
	* Функция получает текущую дату и время
	* 
	* @return datetime
	*/
	static function currentDateTime($format = false)
	{
		return date((!$format) ? 'Y-m-d H:i:s' : $format);
	}

	/**
	* Функция получает текущую дату 'Y-m-d'
	* 
	* @return date
	*/
	static function currentDate() 
	{
		return date('Y-m-d');
	}

	/**
	* Функция получает текущую дату в формате 'd.m.Y'
	* 
	* @return date
	*/
	static function currentDateDMY() 
	{
		return date('d.m.Y');
	}

	/**
	* Функция получает текущее время формате 'H:i:s'
	* 
	* @return time
	*/
	static function currentTime() 
	{
		return date('H:i:s');
	}

	/**
	* Функция получает дату в формате » RFC 2822 (Thu, 21 Dec 2010 16:01:07 +0200)
	* если дата не передана, возвращает текущую дату
	* 
	* @param (mixed) $date - дата - НЕОБЯЗАТЕЛЬНЫЙ ПАРАМЕТР (если дата не передана, возвращает текущую дату)
	* 
	* @return time
	*/
	static function RFCDate($date = false) 
	{
		return $date ? date('r', self::dateToTimeStamp($date)) : date('r');
	}

	/**
	* Функция преобразовывает дату в timestamp
	* 
	* @param (string) $date - дата
	* 
	* @return (int) timestamp
	*/
	static function dateToTimeStamp($date)
	{
		$date = str_replace('-', '', $date);
		$date = str_replace(':', '', $date);
		$date = str_replace(' ', '', $date);

		// YYYYMMDDHHMMSS
		return  mktime(
						substr($date, 8, 2),
						substr($date, 10, 2),
						substr($date, 12, 2),
						substr($date, 4, 2),
						substr($date, 6, 2),
						substr($date, 0, 4)
					);
	}

	/**
	* Функция получает timestamp текущей даты (mktime)
	* 
	* @return (int) timestamp
	*/
	static function currentTimeStampD()
	{
		return mktime(0, 0, 0, date('m'), date('d'), date('Y'));
	}

	/**
	* Функция получает timestamp переданной даты и времени (mktime)
	* 
	* @param (int) $H - Часы в 24-часовом формате с ведущими нулями От 00 до 23 
	* @param (int) $i - Минуты с ведущими нулями 00 to 59 
	* @param (int) $s - Секунды с ведущими нулями От 00 до 59 
	* @param (int) $m - Порядковый номер месяца с ведущими нулями От 01 до 12 
	* @param (int) $d - День месяца, 2 цифры с ведущими нулями от 01 до 31 
	* @param (int) $Y - Порядковый номер года, 4 цифры Примеры: 1999, 2003 
	* 
	* @return (int) timestamp
	*/
	static function fromDBTimeStamp($H, $i, $s, $m, $d, $Y)
	{
		return mktime($H, $i, $s, $m, $d, $Y);
	}

	/**
	* Функция преобразовывает формат даты из Smarty в PHP
	* 
	* @param (string) $date_format - Формат даты
	* @param (string) $time_format - Формат времени
	* 
	* @return 
	*/
	static function dateFormatFromSmarty($date_format, $time_format = '')
	{
		$result = str_replace('%', '', $date_format);

		if (!empty($time_format))
		{
			$time_format = str_replace('%H', 'H', $time_format);
			$time_format = str_replace('%M', 'i', $time_format);
			$time_format = str_replace('%S', 's', $time_format);
			$result .= ' ' . $time_format;
		}
		
		return $result;
	}

	/**
	* Функция вычисляет дату и время на указанный период
	* 
	* @param (mixed) $term - период в часах
	* 
	* @return string ('Y-m-d H:i:s') дата и время в формате MySQL
	*/
	static function calcDateTimeOfTerm($term, $format = false)
	{
		return date((!$format) ? 'Y-m-d H:i:s' : $format, strtotime(self::currentDateTime()) + ($term * 3600));
	}

	/**
	* Функция добавляет к переданной дате переданное количество годов
	* 
	* @param (date) $date - дата в формате MySql ('Y-m-d H:i:s')
	* @param (int) $years - количество лет, которые необходимо добавить к дате
	* 
	* @return string ('Y-m-d H:i:s') дата и время в формате MySQL
	*/
	static function addYearsToDate($date, $years)
	{
		$date = explode(' ', $date);
		$arrDate['date'] = explode('-', $date['0']);
		$arrDate['time'] = explode(':', $date['1']);
                           		
		return date('Y-m-d H:i:s', mktime($arrDate['time'][0], $arrDate['time'][1], $arrDate['time'][2], $arrDate['date'][1], $arrDate['date'][2], $arrDate['date'][0] + $years));
	}

	/////////////////////////////////////////////////
	// END OF CLASS terms
	/////////////////////////////////////////////////
}

