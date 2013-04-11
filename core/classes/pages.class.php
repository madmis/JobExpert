<?php
/********************************************************
	JobExpert v1.0
	powered by Script Developers Group (SD-Group)
	email: info@sd-group.org.ua
	url: http://sd-group.org.ua/
	Copyright 2010-2015 (c) SD-Group
	All rights reserved
=========================================================
 	Класс работы с дополнительными страницами
********************************************************/
/**
* @package
* @todo
*/

(!defined('SDG')) ? die ('Triple protection!') : null;

class pages extends bpages
{
	/////////////////////////////////////////////////
	// VARS - свойства класса pages
	/////////////////////////////////////////////////
	/**
	* Массив для хранения наименований и значений полей для записи в таблицу БД
	* В этом массиве хранятся поля обязательные для заполнения
	* 
	* @var array
	*/
	public $arrBindFields = array(
										'id'	=> '',
										'title'	=> ''
    						   );

	/**
	* Массив для хранения наименований и значений полей для записи в таблицу БД
	* В этом массиве хранятся поля не обязательные для заполнения
	* 
	* @var array
	*/
	public $arrNoBindFields = array(
										'text'				=> '',
										'meta_keywords'		=> '',
										'meta_description'	=> '',
										'token'				=> '',
										'sort'				=> ''
    						   );

	/////////////////////////////////////////////////
	// CONSTRUCTOR - конструктор класса pages
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
	// METHODS - методы класса pages
	/////////////////////////////////////////////////

	/**
	* public функция возвращает массив полей обязательных для заполнения
	* 
	* return array $arrBindFields
	*/
	public function getBindFields()
	{
		return $this -> arrBindFields;
	}

	/**
	* public функция возвращает массив полей не обязательных для заполнения
	* 
	* return array $arrNoBindFields
	*/
	public function getNoBindFields()
	{
		return $this -> arrNoBindFields;
	}


	/********** перегрузка методов родительских классов **********/

	/**
	* Функция проверяет наличие страницы в БД
	* 
	* @param (string) $strWhere - выражение для оператора WHERE
	* 
	* @return bool
	*/
	public function issetPage($strWhere)
	{
		return parent::issetPage($strWhere);
	}

	/**
	* функция получает параметры выбранной страницы
	* 
	* @param (string) $strWhere - условие WHERE для запроса or false
	* @param (array) $fields - массив полей для выборки (key: index => val: name field) по умолчанию false
	* 
	* @return array or false
	*/
	public function getPage($strWhere, $fields = false)
	{
		return parent::getPage($strWhere, $fields);
	}

	/**
	* функция получает все активные страницы
	* 
	* @param (array) $fields - массив полей для выборки (key: index => val: name field)
	* 
	* @return array or false
	*/
	public function getActivePages($fields)
	{
		return parent::getActivePages($fields) ? parent::retData() : false;
	}

	/**
	* функция получает все страницы
	* 
	* @return array
	*/
	public function getAllPages()
	{
		return parent::getAllPages() ? parent::retData() : false;
	}

	/**
	* protected функция производит запись данных в таблицу БД
	* 
	* @param array $arrBindFields - массив полей обязательных для заполнения
	* @param array $arrNoBindFields - массив полей не обязательных для заполнения
	* 
	* @return bool
	*/
	public function recPage()
	{
		return parent::recPage($this -> arrBindFields, $this -> arrNoBindFields);
	}

	/**
	* функция обновления страниц
	* 
	* @param array $arrData - массив даных для обновления
	* @param (array) $arrPages - массив, содержащий id страниц для обновления (id_1, id_2, ..., id_n)
	* 
	* @return bool
	*/
	public function updatePages($arrData, $arrPages)
	{
		return parent::updatePages($arrData, $arrPages);
	}

	/**
	* функция помечает страницы как удаленные
	* 
	* @param (array) $arrPages - массив, содержащий id страниц для удаления
	* 
	* @return bool
	*/
	public function deletePages($arrPages)
	{
		return parent::deletePages($arrPages);
	}

	/********** END перегрузка методов родительских классов **********/

	/////////////////////////////////////////////////
	// END OF CLASS pages
	/////////////////////////////////////////////////
}

