<?php
/********************************************************
	JobExpert v1.0
	powered by Script Developers Group (SD-Group)
	email: info@sd-group.org.ua
	url: http://sd-group.org.ua/
	Copyright 2010-2015 (c) SD-Group
	All rights reserved
=========================================================
 	Класс работы с модами
********************************************************/
/**
* @package
* @todo
*/

(!defined('SDG')) ? die ('Triple protection!') : null;

class mods extends bmods
{
	/////////////////////////////////////////////////
	// VARS - свойства класса mods
	/////////////////////////////////////////////////

	/////////////////////////////////////////////////
	// CONSTRUCTOR - конструктор класса mods
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
	// METHODS - методы класса mods
	/////////////////////////////////////////////////

	/********** перегрузка методов родительских классов **********/
	/**
	* метод проверят файл БД на наличие в нем всех модов
	* если каких-либо модов не хватает, метод дописывает их
	* 
	* @return bool
	*/
	public function checkMDAFile()
	{
		return parent::checkMDAFile();
	}

	/**
	* метод получает список существующих модов из файла БД
	* 
	* @return array
	*/
	public function getMods()
	{
		return parent::getMods();
	}

	/**
	* функция включает/выключает выбранные моды
	* 
	* @param (array) $arrMods - массив, содержащий id модов для включения/выключения
	* @param (bool) $flag - флаг (true|false) определяющий, включить (true) или выключить (false) мод. По умолчанию true.
	* 
	* @return bool
	*/
	public function enableMods($arrMods, $flag = true)
	{
		return parent::enableMods($arrMods, $flag);
	}

	/**
	* функция удаления выбранных модов
	* 
	* @param (array) $arrMods - массив, содержащий id модов для удаления
	* 
	* @return bool
	*/
	public function deleteMods($arrMods)
	{
		return parent::deleteMods($arrMods);
	}
	/////////////////////////////////////////////////
	// END OF CLASS mods
	/////////////////////////////////////////////////
}