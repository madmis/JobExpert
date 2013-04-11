<?php
/********************************************************
	JobExpert v1.0
	powered by Script Developers Group (SD-Group)
	email: info@sd-group.org.ua
	url: http://sd-group.org.ua/
	Copyright 2010-2015 (c) SD-Group
	All rights reserved
=========================================================
 	Класс работы с RSS
********************************************************/
/**
* @package
* @todo
*/

(!defined('SDG')) ? die ('Triple protection!') : null;

class rss extends brss
{
	/////////////////////////////////////////////////
	// VARS - свойства класса rss
	/////////////////////////////////////////////////

	/////////////////////////////////////////////////
	// CONSTRUCTOR - конструктор класса rss
	/////////////////////////////////////////////////
	/**
	* конструктор
	*/
	public function __construct()
	{
		parent::__construct();
	}

	/////////////////////////////////////////////////
	// METHODS - методы класса rss
	/////////////////////////////////////////////////

	/********** перегрузка методов родительских классов **********/

	/**
	* функция формирует RSS для новостей
	* 
	* @return string
	*/
	public function rssNews()
	{
		return parent::rssNews();
	}

	/**
	* функция формирует RSS для статей
	* 
	* @param (int) $id - id раздела, статьи которого необходимо показать (по умолчанию false)
	* 
	* @return string
	*/
	public function rssArticles($id = false)
	{
		return parent::rssArticles($id);
	}

	/**
	* функция формирует RSS для вакансий
	* 
	* @param (string) $type - тип, может быть section или region (по умолчанию false)
	* @param (int) $id - id раздела или региона, вакансии которого необходимо показать (по умолчанию false)
	* 
	* @return string
	*/
	public function rssVacancy($type = false, $id = false)
	{
		return parent::rssVacancy($type, $id);
	}

	/**
	* функция формирует RSS для резюме
	* 
	* @param (string) $type - тип, может быть section или region (по умолчанию false)
	* @param (int) $id - id раздела или региона, резюме которого необходимо показать (по умолчанию false)
	* 
	* @return string
	*/
	public function rssResume($type = false, $id = false)
	{
		return parent::rssResume($type, $id);
	}
	/********** END перегрузка методов родительских классов **********/

	/////////////////////////////////////////////////
	// END OF CLASS rss
	/////////////////////////////////////////////////
}