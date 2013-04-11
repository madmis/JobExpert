<?php
/********************************************************
	JobExpert v1.0
	powered by Script Developers Group (SD-Group)
	email: info@sd-group.org.ua
	url: http://sd-group.org.ua/
	Copyright 2010-2015 (c) SD-Group
	All rights reserved
=========================================================
 	Класс работы с разделами статей
********************************************************/
/**
* @package
* @todo
*/

(!defined('SDG')) ? die ('Triple protection!') : null;

class artsections extends bartsections
{
	/////////////////////////////////////////////////
	// VARS - свойства класса artsections
	/////////////////////////////////////////////////
	/**
	* Массив для хранения наименований и значений полей для записи в таблицу БД
	* В этом массиве хранятся поля обязательные для заполнения
	* 
	* @var array
	*/
	public $arrBindFields = array(
										'name'			=> '',
										'affiliation'	=> ''
    						   );

	/**
	* Массив для хранения наименований и значений полей для записи в таблицу БД
	* В этом массиве хранятся поля не обязательные для заполнения
	* 
	* @var array
	*/
	public $arrNoBindFields = array(
										'sort'	=> ''
    						   );

	/////////////////////////////////////////////////
	// CONSTRUCTOR - конструктор класса artsections
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
	// METHODS - методы класса artsections
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
	* public функция считывает данные из таблицы БД
	* 
	* @param array or false $arrWhereFieldsVals - массив полей и их значений, в соответствии с которыми необходимо произвести выбоку. Пример: array('affiliation' => array('none', 'competitor')) - ищет все строки, где affiliation='none' OR affiliation='competitor'
	* 
	* @return array or false
	*/
	public function getSections($arrWhereFieldsVals = false)
	{
    	return $this -> pGetSections($arrWhereFieldsVals);
	}

	/**
	* public функция возвращает наименование раздела по id
	* 
	* @param integer $id
	* 
	* @return array or false
	*/
	public function getSectionById($id)
	{
		return $this -> pGetSectionById($id);
	}

	/**
	* public функция записи категории в таблицу БД
	* 
	* return bool
	*/
	public function recSection()
	{
		return $this -> pRecSection($this -> arrBindFields, $this -> arrNoBindFields);
	}

 	/**
	* public функция обновления данных разделов
	* 
	* @param (array) $arrData - массив данных для обновления (key: name field => val: value field)
	* @param (array) $arrID - массив, содержащий id разделов для обновления (id_1, id_2, ..., id_n)
	* 
	* @return bool
	*/
	public function updateSections($arrData, $arrID)
	{
		return $this -> pUpdateSections($arrData, $arrID);
	}

	/**
	* public функция помечает разделы и сатьи этих разделов как удаленные
	* 
	* @param (array) $arrSections - массив, содержащий id разделов для удаления
	* 
	* @return bool
	*/
	public function deleteSections($arrSections)
	{
		return $this -> pDeleteSections($arrSections);
	}

 	/**
	* protected функция разбивает массив разделов на 2 массива:
	* id - массив, содержит id всех разделов
	* split - массив, содержит массивы разделов в соответствии с принадлежностью
	* 
	* @param (array) $arrData - массив всех разделов
	* 
	* @return array
	*/
	public function splitSections($arrData)
	{
		return $this -> pSplitSections($arrData);
	}
	/********** END перегрузка методов родительских классов **********/

	/**
	* функция считывает данные из таблицы БД
	* 
	* @return bool
	*/
	public function getCategorys()
	{
		return $this -> pGetCategorys();
	}

	
	/////////////////////////////////////////////////
	// END OF CLASS artsections
	/////////////////////////////////////////////////
}
