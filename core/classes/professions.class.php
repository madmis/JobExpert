<?php
/********************************************************
	powered by Script Developers Group (SD-Group)
	email: info@sd-group.org.ua
	url: http://sd-group.org.ua/
	Copyright 2009 (c) SD-Group
	All rights reserved
=========================================================
 	Класс работы с Профессиями
********************************************************/

(!defined('SDG')) ? die ('Triple protection!') : null;

/**
* Класс работы с Профессиями
*
*/
class professions extends categorys
{
	/////////////////////////////////////////////////
	// VARS - свойства класса professions
	/////////////////////////////////////////////////

	/**
	* Массив для хранения наименований и значений полей для записи в таблицу БД
	* В этом массиве хранятся поля обязательные для заполнения
	*
	* @var array
	*/
	public $arrBindFields = array(
										'parent_id'	=> '',
										'name'		=> ''
								 );

	/**
	* Массив для хранения наименований и значений полей для записи в таблицу БД
	* В этом массиве хранятся поля не обязательные для заполнения
	*
	* @var array
	*/
	public $arrNoBindFields = array(
										'sort'	=> '',
										'title' => '',
										'meta_keywords' => '',
										'meta_description' => ''
								   );

	/////////////////////////////////////////////////
	// CONSTRUCTOR - конструктор класса professions
	/////////////////////////////////////////////////

	/**
	* конструктор
	*
	*/
	public function __construct()
	{
		$this -> setTable('profession');

		$arrOrderBy = array(
								'parent_id'		=> 'ASC',
								'sort'			=> 'ASC',
								'name'			=> 'ASC',
								'id'			=> 'ASC',
						   );

		parent::__construct($arrOrderBy, 'section');

		$this -> getCategorys();
	}

	/////////////////////////////////////////////////
	// METHODS - методы класса professions
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
	* public функция возвращает массив данных
	*
	* return array
	*/
	public function retCategorysByIds($arrIds)
	{
		(!is_array($arrIds)) ? $arrIds = array($arrIds) : null;

		return $this -> retCategorys(array('id' => $arrIds));
	}

	/**
	* public функция возвращает массив данных
	*
	* return array
	*/
	public function retCategorysByParentIds($arrParentIds, $arrFields = false)
	{
		(!is_array($arrParentIds)) ? $arrParentIds = array($arrParentIds) : null;

		return $this -> retCategorys(array('parent_id' => $arrParentIds), $arrFields);
	}

	/**
	* public функция выполняет действия над группой регионов
	*
	* @param string $action
	* @param array $arrFields
	*
	* @return bool
	*/
	public function actionProfessions($action, $arrFields, $parent_id)
	{
		if ('edit' === $action || 'sort' === $action || 'del' === $action)
		{
			(!$this -> actionCategorys($action, $arrFields)) ? messages::messageChangeSaved(ERROR_NOT_SAVE_CHANGE, false, CONF_ADMIN_FILE . '?m=dictionary&amp;s=sections&amp;action=professions&amp;pid=' . $parent_id) : messages::messageChangeSaved(MESSAGE_CHANGE_SAVED, false, CONF_ADMIN_FILE . '?m=dictionary&amp;s=sections&amp;action=professions&amp;pid=' . $parent_id);
		}
		else
		{
			messages::messageChangeSaved(MESSAGE_WARNING_UNKNOWN_ACTION, false, CONF_ADMIN_FILE . '?m=dictionary&amp;s=sections&amp;action=professions&amp;pid=' . $parent_id);
		}
	}

	/********** Перегрузка методов родительских классов **********/
	public function getCategorys()
	{
		return parent::getCategorys();
	}

	public function retCategorys($arrWhereFieldsVals = false, $arrFields = false)
	{
		return parent::retCategorys($arrWhereFieldsVals, $arrFields);
	}

	public function recCategory($token = 'active')
	{
		return parent::recCategory($this -> arrBindFields, $this -> arrNoBindFields, $token);
	}

	public function delCategorys($strWhere)
	{
		return parent::delCategorys($strWhere);
	}
	/********** END Перегрузка методов родительских классов **********/

	/////////////////////////////////////////////////
	// END OF CLASS professions
	/////////////////////////////////////////////////
}
