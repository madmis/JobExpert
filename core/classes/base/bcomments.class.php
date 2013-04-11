<?php
/********************************************************
    JobExpert v1.0
    powered by Script Developers Group (SD-Group)
    email: info@sd-group.org.ua
    url: http://sd-group.org.ua/
    Copyright 2010-2015 (c) SD-Group
    All rights reserved
=========================================================
 Базовый Класс работы с комментариями
********************************************************/
/**
* @package
* @todo
*/
(!defined('SDG')) ? die ('Triple protection!') : null;

/**
* Базовый Класс работы с комментариями
*/
abstract class bcomments extends tbentrys
{
    /////////////////////////////////////////////////
    // VARS - свойства класса bcomments
    /////////////////////////////////////////////////

    /////////////////////////////////////////////////
    // CONSTRUCTOR - конструктор класса bcomments
    /////////////////////////////////////////////////
    /**
    * конструктор
    * 
    * @param string $table - таблица комментариев. По умолчанию - news_comments
    * 
    * @return void
    */
    protected function __construct($table = false)
    {
        $table = (!empty($table)) ? $table : 'news_comments';
        $this -> setTable($table);
    }

    /////////////////////////////////////////////////
    // METHODS - методы класса bcomments
    /////////////////////////////////////////////////
    /**
    * private функция передает значения полей полученных из формы в свойсво базового класса, для последующей записи в таблицу БД
    * 
    * @param mixed $arrBindFields
    * @param mixed $arrNoBindFields
    * @param mixed $arrServiceFields
    * 
    * @return bool
    */
    private function setTableSubj(&$arrBindFields, &$arrNoBindFields, &$arrServiceFields)
    {
        return $this -> fillTableFieldsValue($arrBindFields + $arrNoBindFields + $arrServiceFields);
    }

    /**
    * protected функция подсчитывает кол-во записей в БД
    * 
    * @param (string) $strWhere - выражение для оператора WHERE, если false, то подсчет строк берется из SELECT FOUND_ROWS
    * 
    * @return int or false
    */
    protected function pCntRecords($strWhere = false)
    {
        return (empty($strWhere)) ? $this -> calcFoundRows() : $this -> cntEntrys($strWhere);
    }

    /**
    * protected функция получает параметры выбранной записи
    * 
    * @param (string) $strWhere - выражение для оператора WHERE
    * @param (array) $fields - массив полей для выборки (key: index => val: name field). По у молчанию false
    * 
    * @return array || false
    */
    protected function pGetRecord(&$strWhere, $fields = false)
    {
        if (empty($strWhere))
        {
            return false;
        }

        return $this -> getEntry($strWhere, $fields) ? $this -> retDataSubj() : false;
    }

    /**
    * protected функция получает все записи из таблицы
    * 
    * @param (string) $strWhere - условие WHERE для запроса or false
    * @param (array) $arrOrderBy - массив параметров сортировки результата выборки (key: name field => val: ASC | DESC) or false
    * @param (string) $strLimit - выражение для оператора LIMIT or false
    * @param (array) $fields - массив полей для выборки (key: index => val: name field) or false
    * 
    * @return array || false
    */
    protected function pGetRecords(&$strWhere, &$arrOrderBy, &$strLimit, &$fields)
    {
        return $this -> getEntrys($strWhere, $arrOrderBy, $strLimit, $fields, false) ? $this -> retData() : false;
    }

    /**
    * protected функция производит запись данных в таблицу БД
    * 
    * @param array $arrBindFields - массив полей обязательных для заполнения
    * @param array $arrNoBindFields - массив полей не обязательных для заполнения
    * @param mixed $arrServiceFields - массив сервисных полей
    * 
    * @return bool
    */
    protected function pRecRecord(&$arrBindFields, &$arrNoBindFields, &$arrServiceFields)
    {
        return ($this -> setTableSubj($arrBindFields, $arrNoBindFields, $arrServiceFields) && $this -> addEntry()) ? true : false;
    }

    /**
    * protected функция обновления записей в таблице
    * 
    * @param (array) $arrData - массив данных для обновления (key: name field => val: value field)
    * @param (array) $arrArticles - массив, содержащий id статей для обновления (id_1, id_2, ..., id_n)
    * @param (string) $strWhere - выражение для оператора WHERE or false (по умолчанию false)
    * 
    * @return bool
    */
    protected function pUpdateRecords($arrData, $strWhere = false)
    {
        if (empty($arrData))
        {
            return false;
        }

        return $this -> editEntrys(secure::escQuoteData($arrData), $strWhere);
    }

    /**
    * protected функция помечает записи как удаленные
    * 
    * @param (string) $strWhere -  условие запроса
    * 
    * @return bool
    */
    protected function pDeleteRecords($strWhere) {
        if (empty($strWhere)) {
            return false;
        }

        return $this -> delEntrys($strWhere);
    }

	/**
	* protected функция получает комбинированные данные комментариев
	* 
	* @param (array) $arrFields - массив полей, которые нужно получить. Массив должен быть следующего вида: array(array('алиас_таблицы', 'поле1'), array('алиас_таблицы', 'поле2')). ПРИМЕР: array(array('users', 'id'), array('users', 'email')) or false
	* @param (string) $strWhere - строка, условие для запроса or false. Поля условия должны обязательно содержать алиас таблицы, к которой они относятся (users или conf_users). ПРИМЕР: 'conf_users.token='active'.
	* @param (array) $arrOrderBy - массив параметров сортировки результата выборки (key: name field => val: ASC | DESC) or false
	* @param (string) $strLimit - example: '0, 10' or false
	* 
	* @return array or false
	*/
	protected function pGetFullCommentsData(&$arrFields, &$strWhere, &$arrOrderBy, &$strLimit) {
		// массивы - псевдонимы таблиц и поля, которые необходимо выбрать
		$arrConf['tableFields'] = !empty($arrFields) ? $arrFields : array(array('news_comments', '*'), array('news', 'title'));

		// джоины с условием
		$arrConf['leftJoins'] = array(
			array(
				'table' => array(DB_PREFIX . 'news', 'news'),
				'on'	=> "news_comments.id_news=news.id"
		));

		// условие запроса
		$arrConf['strWhere'] = (!empty($strWhere)) ? $strWhere . " AND news_comments.token IN ('active') AND news.token IN ('active')" : "news_comments.token IN ('active') AND news.token IN ('active')";
		// подсчет строк
		$arrConf['calcRows'] = true;
		// LIMIT
		$arrConf['strLimit'] = (!empty($strLimit)) ? $strLimit : false;
		$arrOrderBy = (!empty($arrOrderBy)) ? $arrOrderBy : array('news_comments.datetime' => 'DESC');

		return ($this -> getSubSelectEntrys($arrOrderBy, true, $arrConf)) ? $this -> retData() : false;
	}
    /////////////////////////////////////////////////
    // END OF CLASS bcomments
    /////////////////////////////////////////////////
}

