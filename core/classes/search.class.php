<?php
/********************************************************
	JobExpert v1.0
	powered by Script Developers Group (SD-Group)
	email: info@sd-group.org.ua
	url: http://sd-group.org.ua/
	Copyright 2010-2015 (c) SD-Group
	All rights reserved
=========================================================
 Класс Поиска
********************************************************/
/**
 * @package
 * @todo
 */

(!defined('SDG')) ? die ('Triple protection!') : null;

/**
* Класс Поиска
*/
class search extends bsearch
{
	/////////////////////////////////////////////////
	// VARS - свойства класса search
	/////////////////////////////////////////////////

	/////////////////////////////////////////////////
	// CONSTRUCTOR - конструктор класса search
	/////////////////////////////////////////////////

	/**
	* конструктор
	* Инициирует имя таблицы БД
	*/
	public function __construct($table)
	{
		parent::__construct($table);
	}


	/////////////////////////////////////////////////
	// METHODS - методы класса search
	/////////////////////////////////////////////////

	/**
	* функция декодирования поисковой фразы
	* если кодировка строки не UTF-8, перекодирует строку
	* 
	* @param (string) $string
	* 
	* @return string
	*/
	public function decodeSearchString($string)
	{
		return parent::decodeSearchString($string);
	}

	/**
	* метод поиска объявлений, по указаным данным
	* 
	* @param (array) $arrData - массив данных, в соответствии с которыми необходимо произвести поиск
	* 
	* @return array
	*/
	public function searchQuery($arrData)
	{
		return parent::searchQuery($arrData);
	}

	/**
	* метод поиска Вакансий, по указаным данным
	* 
	* @param (array) $arrData - массив данных, в соответствии с которыми необходимо произвести поиск
	* 
	* @return array
	*/
	public function searchVacancy($arrData)
	{
		return parent::searchVacancy($arrData);
	}

	/**
	* метод поиска Резюме, по указаным данным
	* 
	* @param (array) $arrData - массив данных, в соответствии с которыми необходимо произвести поиск
	* 
	* @return array
	*/
	public function searchResume($arrData)
	{
		return parent::searchResume($arrData);
	}

	/////////////////////////////////////////////////
	// END OF CLASS search
	/////////////////////////////////////////////////
}

