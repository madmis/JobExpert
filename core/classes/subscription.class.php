<?php
/********************************************************
	JobExpert v1.0
	powered by Script Developers Group (SD-Group)
	email: info@sd-group.org.ua
	url: http://sd-group.org.ua/
	Copyright 2010-2015 (c) SD-Group
	All rights reserved
=========================================================
 	Класс работы с Подписками и Рассылками
********************************************************/
/**
* @package
* @todo
*/

(!defined('SDG')) ? die ('Triple protection!') : null;

/**
* Класс работы с Подписками и Рассылками
* 
*/

class subscription extends bsubscr
{
	/////////////////////////////////////////////////
	// VARS - свойства класса vacancy
	/////////////////////////////////////////////////

	/**
	* Массив для хранения наименований и значений полей для записи в таблицу БД
	* В этом массиве хранятся поля обязательные для заполнения
	* 
	* @var array
	*/
	public $arrBindFields = array(
										'email'				=> '',
										'type_subscription'	=> '',
										'id_section'		=> '',
										'id_region'			=> '',
										'period'			=> ''
								 );

	/**
	* Массив для хранения наименований и значений полей для записи в таблицу БД
	* В этом массиве хранятся поля не обязательные для заполнения
	* 
	* @var array
	*/
	public $arrNoBindFields = array(
										'id_announce'		=> '',
										'id_user'			=> '',
										'id_profession'		=> '',
										'id_profession_1'	=> '',
										'id_profession_2'	=> '',
										'id_city'			=> ''
								   );

	/////////////////////////////////////////////////
	// CONSTRUCTOR - конструктор класса vacancy
	/////////////////////////////////////////////////

	/**
	* конструктор
	* 
	* инициирует имя талицы БД
	* 
	*/
	public function __construct()
	{
		parent::__construct();
		$this -> setTable('subscription');
	}

	/////////////////////////////////////////////////
	// METHODS - методы класса vacancy
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

	/**
	* public функция возвращает массив полей и значений хранящийся в базовом классе
	* 
	* return array
	*/
	public function retSubscrSubj()
	{
		return $this -> retDataSubj();
	}

	/********** перегрузка методов родительских классов **********/

	/**
	* Функция подсчитывает кол-во записей в БД
	* 
	* @param (string) $strWhere - выражение для оператора WHERE, если false, то подсчет строк берется из SELECT FOUND_ROWS
	* 
	* @return int or false
	*/
	public function cntSubscriptions($strWhere = false)
	{
		return parent::cntSubscriptions($strWhere);
	}

	/**
	* функция получает подписки из БД
	* 
	* @param (string) $strWhere - условие WHERE для запроса or false
	* @param (array) $arrOrderBy - массив параметров сортировки результата выборки (key: name field => val: ASC | DESC) or false
	* @param (mixed) $arrLimit - false or массив параметров для оператора LIMIT (key: 'strLimit' => val: string of LIMIT for example: '0, 10', key: 'calcRows' => val: true | false)
	* @param (array) $arrFields - массив полей для выборки (key: index => val: name field)
	* 
	* @return array or false
	*/
	public function getSubscriptions($strWhere, $arrOrderBy, $arrLimit, $arrFields)
	{
		return parent::getSubscriptions($strWhere, $arrOrderBy, $arrLimit, $arrFields);
	}

	/**
	* функция производит запись данных в таблицу БД
	* 
	* @param array $arrBindFields - массив полей обязательных для заполнения
	* @param array $arrNoBindFields - массив полей не обязательных для заполнения
	* 
	* @return bool
	*/
	public function recSubscr($typeAnnounce = false)
	{
		return parent::recSubscr($this -> arrBindFields, $this -> arrNoBindFields, $typeAnnounce);
	}

	/**
	* функция активирует подписку
	* 
	* @param array $arrBindFields - массив полей обязательных для заполнения
	* @param array $arrNoBindFields - массив полей не обязательных для заполнения
	* 
	* @return bool
	*/
	public function actSubscr($type_announce = false)
	{
		return parent::actSubscr($this -> arrBindFields, $this -> arrNoBindFields, $type_announce);
	}

	/**
	* функция редактирует подписку
	* 
	* @param (array) $arrData - массив данных для обновления (key: name field => val: value field)
	* @param (string) $strWhere - выражение для оператора WHERE (необязательный параметр)
	* 
	* @return bool
	*/
	public function editSubscr($arrData, $strWhere = false)
	{
		return parent::editSubscr($arrData, $strWhere);
	}

	/**
	* функция обновления подписок
	* 
	* @param (array) $arrData - массив данных для обновления (key: name field => val: value field)
	* @param (mixed) $where - выражение для оператора WHERE. Может быть строкой или массивом, содержащим id записей для обновления (id_1, id_2, ..., id_n)
	* 
	* @return bool
	*/
	public function updateSubscriptions($arrData, $where)
	{
		return parent::updateSubscriptions($arrData, $where);
	}

	/**
	* функция удаления подписок
	* 
	* @param (string) $strWhere - выражение для оператора WHERE (необязательный параметр)
	* 
	* @return bool
	*/
	public function delSubscriptions($strWhere = false)
	{
		return parent::delSubscriptions($strWhere);
	}

	/**
	* функция помечает подписки как "удаленные"
	* 
	* @param (array) $arrIDs - массив, содержащий id записей для удаления
	* 
	* @return bool
	*/
	public function delSubscriptionsById($arrIDs)
	{
		return parent::delSubscriptionsById($arrIDs);
	}


	/**
	* функция выполняет рассылку, в ссответствии с полученными параметрами
	* Метод предназначен для выполнения рассылки из формы подписки полльзователя
	* 
	* @param (array) $arrData - массив данных, необходимых для рассылки
	*
	* @return bool
	*/
	public function runSubscription($arrData)
	{
		return parent::runSubscription($arrData);
	}


	/********** END перегрузка методов родительских классов **********/

	/////////////////////////////////////////////////
	// END OF CLASS vacancy
	/////////////////////////////////////////////////
}


