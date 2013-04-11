<?php
/********************************************************
	JobExpert v1.0
	powered by Script Developers Group (SD-Group)
	email: info@sd-group.org.ua
	url: http://sd-group.org.ua/
	Copyright 2010-2015 (c) SD-Group
	All rights reserved
=========================================================
 	Класс работы с группами и типами пользователей
********************************************************/
/**
* @package
* @todo
*/

(!defined('SDG')) ? die ('Triple protection!') : null;

class group extends groups
{
	/////////////////////////////////////////////////
	// VARS - свойства класса group
	/////////////////////////////////////////////////
	/**
	* Массив для хранения наименований и значений полей для записи в таблицу БД
	* В этом массиве хранятся поля обязательные для заполнения
	* 
	* @var array
	*/
	public $arrBindFields = array(
									'id' => ''
    						   );
	
	public $arrRights = array();
	
	/**
	* массив возможных типов пользователей
	* @var array
	*/
	public $arrTypes = array('agent', 'company', 'employer', 'competitor');

	/**
	* типы пользователей с правами установленными по умолчанию
	* изначально есть только два типа GUEST И USER
	* можно добавлять сколько угодно типов пользователей
	* все дополнительные (кроме user и guest) типы пользователей должны быть сначала определены в масиве $arrTypes
	* 
	* @var array
	*/
	private $agent = array('add_vacancy' => true, 'add_resume' => true);
	private $company = array('add_vacancy' => true, 'add_resume' => false);
	private $employer = array('add_vacancy' => true, 'add_resume' => false);
	private $competitor = array('add_vacancy' => false, 'add_resume' => true);

	/////////////////////////////////////////////////
	// CONSTRUCTOR - конструктор класса group
	/////////////////////////////////////////////////

	/**
	* конструктор
	* устанавливает права для типов USER и GUEST
	* 
	* @return void
	*/
	public function __construct()
	{
		parent::__construct();

		$this -> initUserTypeRights(array('add_vacancy' => true, 'add_resume' => true));
		$this -> initGuestTypeRights(array('add_vacancy' => CONF_TYPE_GUEST_RIGHT_ADD_VACANCY, 'add_resume' => CONF_TYPE_GUEST_RIGHT_ADD_RESUME));
	}

	/////////////////////////////////////////////////
	// METHODS - методы класса group
	/////////////////////////////////////////////////

    /**
    * Функция получает права типа пользователя
	* 
	* @param (string) $type - тип учетной записи
	* 
    * @return (array) - массив прав указанного типа
    */
	protected function getTypeRights($type)
	{
		switch ($type)
		{
			case 'guest':
				return $this -> retGuestTypeRights();
				break;

			case 'agent':
				return $this -> agent;
				break;

			case 'company':
				return $this -> company;
				break;

			case 'employer':
				return $this -> employer;
				break;

			case 'competitor':
				return $this -> competitor;
				break;

			default:
				return $this -> retUserTypeRights();
				break;
		}
	}


	/********** перегрузка методов родительских классов **********/

	/**
	* Функция получает права для типа USER
	* 
	* @return array
	*/
	protected function retUserTypeRights()
	{
		return parent::retUserTypeRights();
	}

	/**
	* Функция получает права для типа GUEST
	* 
	* @return array
	*/
	protected function retGuestTypeRights()
	{
		return parent::retGuestTypeRights();
	}

	/**
	* Функция проверяет наличие группы в БД
	* 
	* @param (string) $id - id группы
	* 
	* @return bool
	*/
	public function issetGroup($id)
	{
		return parent::issetGroup($id);
	}

	/**
	* Функция проверяет наличие группы у пользователей
	* 
	* @param (string) $id - id группы
	* 
	* @return bool
	*/
	public function issetUserGroup($id)
	{
		return parent::issetUserGroup($id);
	}

	/**
	* Функция возвращает все группы из БД
	* 
	* @param (string) $strWhere - условие WHERE для запроса or false
	* @param (array) $arrOrderBy - массив параметров сортировки результата выборки (key: name field => val: ASC | DESC) or false
	* @param (array) $fields - массив полей для выборки (key: index => val: name field)
	* 
	* @return array or false
	*/
	public function getAllGroups($strWhere, $arrOrderBy, $fields = false)
	{
		return parent::getAllGroups($strWhere, $arrOrderBy, $fields);
	}

	/**
	* Функция возвращает права и обязанности выбранной группы
	* 
	* @param (string) $id - id группы
	* 
	* @return array or false (массив содержит два массива: array['rights'] - права, array['resp'] - обязанности)
	*/
	public function getGroup($id)
	{
		return parent::getGroup($id);
	}

	/**
	* функция производит запись данных в таблицу БД
	* 
	* @param array $arrBindFields - массив полей обязательных для заполнения
	* 
	* @return bool
	*/
	public function recGroup()
	{
		return parent::recGroup($this -> arrBindFields);
	}

	/**
	* функция производит обноыление данных
	* 
	* @param (array) $arrData - массив данных для обновления (на данный момент это полностью массив $_POST)
	* 
	* @return bool
	*/
	public function updateGroup($arrData)
	{
		return parent::updateGroup($arrData);
	}

	/**
	* функция производит удаление группы
	* 
	* @param (string) $id - id группы для удаления
	* 
	* @return bool
	*/
	public function deleteGroup($id)
	{
		return parent::deleteGroup($id);
	}

	/**
	* Функция устанавливает общие права пользователя
	* в соответствии с типом и группой
	* 
	* @param (array) $type - тип учетной записи
	* @param (array) $group - группа, в которой состоит пользователь
	* 
	* @return array or false
	*/
    public function setUserRights($type, $group)
    {
		return parent::setUserRights($this -> getTypeRights($type), $group);
	}

	/**
	* protected функция считывает данные из таблицы БД
	* 
	* @return bool or array
	*/
	public function getGroupsAndResp()
	{
		return parent::getGroupsAndResp();
	}

	/********** END перегрузка методов родительских классов **********/

	/////////////////////////////////////////////////
	// END OF CLASS group
	/////////////////////////////////////////////////
}
