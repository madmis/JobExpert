<?php
/********************************************************
	JobExpert v1.0
	powered by Script Developers Group (SD-Group)
	email: info@sd-group.org.ua
	url: http://sd-group.org.ua/
	Copyright 2010-2015 (c) SD-Group
	All rights reserved
=========================================================
 Базовый Класс работы с группами и типами пользователей
********************************************************/
/**
* @package
* @todo
*/

(!defined('SDG')) ? die ('Triple protection!') : null;

/**
* Базовый Класс работы с группами и типами пользователей
* 
*/
abstract class groups extends tbentrys
{
	/////////////////////////////////////////////////
	// VARS - свойства класса groups
	/////////////////////////////////////////////////

	/**
	* типы пользователей с правами установленными по умолчанию
	* изначально есть только два типа GUEST И USER
	* можно добавлять сколько угодно типов пользователей
	* 
	* private $user = array('add_vacancy' => false, 'add_resume' => false);
	* private $guest = array('add_vacancy' => CONF_TYPE_GUEST_RIGHT_ADD_VACANCY, 'add_resume' => CONF_TYPE_GUEST_RIGHT_ADD_RESUME);
	* Права эитм типам должны устанавливаться в конструкторе дочернего класса
	* 
	* @var array
	*/
	private $user = array();
	private $guest = array();

	/////////////////////////////////////////////////
	// CONSTRUCTOR - конструктор класса groups
	/////////////////////////////////////////////////

	/**
	* конструктор
	* 
	* @return void
	*/
	protected function __construct()
	{
		$this -> setTable('groups');
	}

	/////////////////////////////////////////////////
	// METHODS - методы класса groups
	/////////////////////////////////////////////////
	
	/**
	* private функция передает значения полей полученных из формы в свойсво базового класса, для последующей записи в таблицу БД
	* 
	* @param mixed $arrBindFields
	* @param mixed $arrNoBindFields
	* 
	* @return bool
	*/
	private function setGroupSubj($arrBindFields)
	{
		return $this -> fillTableFieldsValue($arrBindFields);
	}

	/**
	* Функция устанавливает права для типа USER
	* 
	* @return void
	*/
	protected function initUserTypeRights($arrRights)
	{
		$this -> user = $arrRights;
	}

	/**
	* Функция устанавливает права для типа GUEST
	* 
	* @return void
	*/
	protected function initGuestTypeRights($arrRights)
	{
		$this -> guest = $arrRights;
	}

	/**
	* Функция получает права для типа USER
	* 
	* @return array
	*/
	protected function retUserTypeRights()
	{
		return $this -> user;
	}

	/**
	* Функция получает права для типа GUEST
	* 
	* @return array
	*/
	protected function retGuestTypeRights()
	{
		return $this -> guest;
	}

	/**
	* Функция проверяет наличие группы в БД
	* 
	* @param (string) $id - id группы
	* 
	* @return bool
	*/
	protected function issetGroup($id)
	{
		// проверяем наличие группы в таблице прав
		if ($this -> issetRow("id IN (" . secure::escQuoteData(strtolower($id)) . ") AND token IN ('active')"))
		{
			$this -> setTable('groups_resp');
			// проверяем наличие группы в таблице обязанностей
			$ret = (!$this -> issetRow("id IN (" . secure::escQuoteData(strtolower($id)) . ") AND token IN ('active')")) ? false : true;
			$this -> setTable('groups');

			return $ret;
		}
		else
		{
			return false;
		}
	}

	/**
	* Функция проверяет наличие группы у пользователей
	* 
	* @param (string) $id - id группы
	* 
	* @return bool
	*/
	protected function issetUserGroup($id)
	{
		// переопределяем рабочую таблицу
		$this -> changeTable('conf_users');

		// проверяем наличие группы в таблице пользователей
		if ($this -> issetRow("user_group IN (" . secure::escQuoteData(strtolower($id)) . ") AND token NOT IN ('reserved', 'deleted')"))
		{
			// переопределяем рабочую таблицу
			$this -> changeTable('groups');
			return true;
		}
		else
		{
			// переопределяем рабочую таблицу
			$this -> changeTable('groups');
		    return false;
		}
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
	protected function getAllGroups($strWhere, $arrOrderBy, $fields)
	{
		$arrData = array();
		$this -> getEntrys($strWhere, $arrOrderBy, false, $fields);

		// проверяем, есть ли данные
		if (parent::retData())
		{
			// если данные есть, вырезаем token
			foreach (parent::retData() as $value)
			{
				unset ($value['index'], $value['token']);
				$arrData[] = $value;
			}

			return $arrData;
		}
		else
		{
			return false;
		}
	}

	/**
	* Функция возвращает права и обязанности выбранной группы
	* 
	* @param (string) $id - id группы
	* 
	* @return array or false (масси содержит два массива: array['rights'] - права, array['resp'] - обязанности.
	*/
	protected function getGroup($id)
	{
		$arrData = array();

		// получаем права группы
		$arrData['rights'] = ($this -> getEntry("id IN (" . secure::escQuoteData(strtolower($id)) . ") AND token IN ('active')")) ? $this -> retDataSubj() : false;

		// переопределяем рабочую таблицу
		$this -> setTable('groups_resp');
		// получаем обязанности группы
		$arrData['resp'] = ($this -> getEntry("id IN (" . secure::escQuoteData(strtolower($id)) . ") AND token IN ('active')")) ? $this -> retDataSubj() : false;
		// переопределяем рабочую таблицу (чтобы избежать проблем)
		$this -> setTable('groups');

		return (!$arrData['rights'] || !$arrData['resp']) ? false : $arrData;
	}

	/**
	* protected функция производит запись данных в таблицу БД
	* 
	* @param array $arrBindFields - массив полей обязательных для заполнения
	* @param array $arrNoBindFields - массив полей не обязательных для заполнения
	* 
	* @return bool
	*/
	protected function recGroup($arrBindFields)
	{
		// token всегда активный, при добавлении новой группы
		$arrBindFields['token'] = 'active';

		// записываем данные в таблицу прав
		if ($this -> setGroupSubj($arrBindFields) && $this -> addEntry())
		{
			// переопределяем рабочую таблицу
			$this -> changeTable('groups_resp');

			// записываем данные в таблицу обязанностей
			if ($this -> setGroupSubj($arrBindFields) && $this -> addEntry())
			{
				// переопределяем рабочую таблицу (чтобы избежать проблем)
				$this -> changeTable('groups');

				return true;
			}
			else
			{
				// переопределяем рабочую таблицу (чтобы избежать проблем)
				$this -> changeTable('groups');
				// удаляем добавленную запись из таблицы прав
				$this -> delEntrys("id IN (" . secure::escQuoteData(strtolower($arrBindFields['id'])) . ")");

				return false;
			}
		}
		else
		{
			return false;
		}
	}

	/**
	* protected функция производит обновление данных
	* 
	* @param (array) $arrData - массив данных для обновления (на данный момент это полностью массив $_POST)
	* 
	* @return bool
	*/
	protected function updateGroup($arrData)
	{
		if ($this -> editEntrys(secure::escQuoteData($arrData['arrRights']), "id IN (" . secure::escQuoteData(strtolower($arrData['id'])) . ")"))
		{
			// переопределяем рабочую таблицу
			$this -> changeTable('groups_resp');

 			if ($this -> editEntrys(secure::escQuoteData($arrData['arrResp']),  "id IN (" . secure::escQuoteData(strtolower($arrData['id'])) . ")"))
 			{
				// переопределяем рабочую таблицу (чтобы избежать проблем)
				$this -> changeTable('groups');

 				return true;
			}
			else
			{
				// переопределяем рабочую таблицу (чтобы избежать проблем)
				$this -> changeTable('groups');

				return false;
			}
		}
		else
		{
			return false;
		}
	}

	/**
	* protected функция производит удаление группы
	* 
	* @param (string) $id - id группы для удаления
	* 
	* @return bool
	*/
	protected function deleteGroup($id)
	{
		if ($this -> delEntrys("id IN (" . secure::escQuoteData(strtolower($id)) . ")"))
		{
			// переопределяем рабочую таблицу
			$this -> changeTable('groups_resp');

 			if ($this -> delEntrys("id IN (" . secure::escQuoteData(strtolower($id)) . ")"))
 			{
				// переопределяем рабочую таблицу (чтобы избежать проблем)
				$this -> changeTable('groups');

 				return true;
			}
			else
			{
				// переопределяем рабочую таблицу (чтобы избежать проблем)
				$this -> changeTable('groups');

				return false;
			}
		}
		else
		{
			return false;
		}
	}


	/**
	* Функция возвращает массив общих прав пользователя
	* в соответствии с типом и группой,
	* а также массив обязанностей
	* array(array(rights), array(resp))
	* 
	* @param (array) $typeRights - права типа
	* @param (array) $group - id группы, в которой состоит пользователь
	* 
	* @return array or false
	*/
    protected function setUserRights($typeRights, $group)
    {
		// проверяем, переданы ли все параметры
		if ($typeRights && $group)
		{
			// получаем права и обязанности
			if ($arrData = $this -> getGroup($group))
			{
				unset ($arrData['rights']['index'], $arrData['rights']['id'], $arrData['rights']['token']);
				unset ($arrData['resp']['index'], $arrData['resp']['id'], $arrData['resp']['token']);
				
				return array('rights' => $typeRights + $arrData['rights'], 'resp' => $arrData['resp']);
			}
			else
			{
				return false;
			}
		}
		else
		{
			return false;
		}
	}

	/**
	* private функция возвращает массив значений для метода getSubSelectEntrys
	* 
	* @return array
	*/
	private function retGroupsConf()
	{
		$arrConf['extTableFields'] = array(
												array('groups_resp.moder_account', 'moder_account'),
												array('groups_resp.act_vacancy', 'act_vacancy'),
												array('groups_resp.act_resume', 'act_resume'),
												array('groups_resp.moder_vacancy', 'moder_vacancy'),
												array('groups_resp.moder_resume', 'moder_resume'),
												array('groups_resp.moder_articles', 'moder_articles'),
												array('groups_resp.moder_news', 'moder_news'),
										  );
										  
		$arrConf['leftJoins'][] = array(
											'table' => array($this -> retTablePrefix() . 'groups_resp', 'groups_resp'),
											'on'	=> 'groups.id=groups_resp.id'
									   );

		$arrConf['strWhere'] = "groups.token IN ('active')";
		
		return $arrConf;
	}
	
	/**
	* protected функция считывает данные из таблицы БД
	* 
	* @return bool or array
	*/
	protected function getGroupsAndResp()
	{
		if (!$this -> getSubSelectEntrys(false, false, $this -> retGroupsConf()))
		{
			return false;
		}
		else
		{
			if (!$this -> setCachingEntrys())
			{
				return false;
			}
			else
			{
		 		return $this -> retData();
			}
		}
	}

	/////////////////////////////////////////////////
	// END OF CLASS groups
	/////////////////////////////////////////////////
}
