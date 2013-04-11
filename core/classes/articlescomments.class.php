<?php
/********************************************************
    JobExpert v1.0
    powered by Script Developers Group (SD-Group)
    email: info@sd-group.org.ua
    url: http://sd-group.org.ua/
    Copyright 2010-2015 (c) SD-Group
    All rights reserved
=========================================================
     Класс работы со комментариями статей
********************************************************/
/**
* @package
* @todo
*/

(!defined('SDG')) ? die ('Triple protection!') : null;

class articlesComments extends bcomments {
     /////////////////////////////////////////////////
    // VARS - свойства класса articlesComments
    /////////////////////////////////////////////////
    /**
    * Массив для хранения наименований и значений полей для записи в таблицу БД
    * В этом массиве хранятся поля обязательные для заполнения
    * @var array
    */
    public $arrBindFields = array(
			'text'	=> '',
		);

    /**
    * Массив для хранения наименований и значений полей для записи в таблицу БД
    * В этом массиве хранятся поля не обязательные для заполнения
    * @var array
    */
    public $arrNoBindFields = array(
			'name'		=> '',
			'ip'		=> '',
		);

    /**
    * Массив для хранения наименований и значений полей для записи в таблицу БД
    * В этом массиве хранятся сервисные поля
    * @var array
    */
    private $arrServiceFields = array(
            'id_parent'			=> '',
            'id_article'		=> '',
            'id_user'			=> '',
            'datetime'			=> '',
            'token'				=> '',
            'token_datetime'	=> '',
        );

	/////////////////////////////////////////////////
	// CONSTRUCTOR - конструктор класса articlesComments
	/////////////////////////////////////////////////
	/**
	* конструктор
	* @return void
	*/
	public function __construct() {
		parent::__construct('articles_comments');
	}

	/////////////////////////////////////////////////
	// METHODS - методы класса articlesComments
	/////////////////////////////////////////////////
	/**
	* public функция возвращает массив полей обязательных для заполнения
	* @return array $arrBindFields
	*/
	public function getBindFields() {
		return $this -> arrBindFields;
	}

	/**
	* public функция возвращает массив полей не обязательных для заполнения
	*
	* @return array $arrNoBindFields
	*/
	public function getNoBindFields() {
		return $this -> arrNoBindFields;
	}

	/**
	* public функция заполняет сервисные поля ($this -> arrServiceFields)
	* @param array $arrFields - массив полей со значениями (id_parent, id_article, id_user)
	* @return bool
	*/
	public function setServiceFields($arrFields) {
		if (empty($arrFields) || !is_array($arrFields)) {
			return false;
		}

		if (empty($arrFields['id_article'])) {
			return false;
		}

		(!empty($arrFields['id_parent'])) ? $this -> arrServiceFields['id_parent'] = $arrFields['id_parent'] : null;
		$this -> arrServiceFields['id_article'] = $arrFields['id_article'];
		(!empty($arrFields['id_user'])) ? $this -> arrServiceFields['id_user'] = $arrFields['id_user'] : null;
		$this -> arrServiceFields['datetime'] = terms::currentDateTime();
		$this -> arrServiceFields['token'] = 'active';

		return true;
	}

	/********** перегрузка методов родительских классов **********/

    /**
    * функция подсчитывает кол-во записей в БД
    * @param (string) $strWhere - выражение для оператора WHERE, если false, то подсчет строк берется из SELECT FOUND_ROWS
    * @return int or false
    */
	public function cntRecords($strWhere = false) {
		return $this -> pCntRecords($strWhere);
	}

    /**
    * функция получает параметры выбранной записи
    * @param (string) $strWhere - выражение для оператора WHERE
    * @param (array) $fields - массив полей для выборки (key: index => val: name field). По у молчанию false
    * @return array or bool
    */
    public function getRecord($strWhere, $fields = false) {
    	return $this -> pGetRecord($strWhere, $fields);
	}

    /**
    * функция получает все записи из таблицы
    *
    * @param (string) $strWhere - условие WHERE для запроса or false
    * @param (array) $arrOrderBy - массив параметров сортировки результата выборки (key: name field => val: ASC | DESC) or false
    * @param (string) $strLimit - выражение для оператора LIMIT or false
    * @param (array) $fields - массив полей для выборки (key: index => val: name field) or false
    *
    * @return bool
    */
    public function getRecords($strWhere, $arrOrderBy, $strLimit, $fields) {
        return $this -> pGetRecords($strWhere, $arrOrderBy, $strLimit, $fields);
    }

    /**
    * функция производит запись данных в таблицу БД
    * @return bool
    */
    public function recRecord() {
        return $this -> pRecRecord($this -> arrBindFields, $this -> arrNoBindFields, $this -> arrServiceFields);
    }

    /**
    * функция обновления записей в таблице
    *
    * @param (array) $arrData - массив данных для обновления (key: name field => val: value field)
    * @param (array) $arrArticles - массив, содержащий id статей для обновления (id_1, id_2, ..., id_n)
    * @param (string) $strWhere - выражение для оператора WHERE or false (по умолчанию false)
    * @return bool
    */
    public function updateRecords($arrData, $strWhere = false) {
		return $this -> pUpdateRecords($arrData, $strWhere);
    }

    /**
    * функция помечает записи как удаленные
    * @param (string) $strWhere -  условие запроса
    * @return bool
    */
    public function deleteRecords($strWhere) {
        return $this -> pDeleteRecords($strWhere);
    }

	/********** END перегрузка методов родительских классов **********/

	/**
	* функция получает комбинированные данные комментариев
	*
	* @param (array) $arrFields - массив полей, которые нужно получить. Массив должен быть следующего вида: array(array('алиас_таблицы', 'поле1'), array('алиас_таблицы', 'поле2')). ПРИМЕР: array(array('users', 'id'), array('users', 'email')) or false
	* @param (string) $strWhere - строка, условие для запроса or false. Поля условия должны обязательно содержать алиас таблицы, к которой они относятся (users или conf_users). ПРИМЕР: 'conf_users.token='active'.
	* @param (array) $arrOrderBy - массив параметров сортировки результата выборки (key: name field => val: ASC | DESC) or false
	* @param (string) $strLimit - example: '0, 10' or false
	*
	* @return array or false
	*/
	public function getFullCommentsData($arrFields, $strWhere, $arrOrderBy, $strLimit) {
		// массивы - псевдонимы таблиц и поля, которые необходимо выбрать
		$arrConf['tableFields'] = !empty($arrFields) ? $arrFields : array(array('articles_comments', '*'), array('articles', 'title'));

		// джоины с условием
		$arrConf['leftJoins'] = array(
			array(
				'table' => array(DB_PREFIX . 'articles', 'articles'),
				'on'	=> "articles_comments.id_article=articles.id"
		));

		// условие запроса
		$arrConf['strWhere'] = (!empty($strWhere)) ? $strWhere . " AND articles_comments.token IN ('active') AND articles.token IN ('active')" : "articles_comments.token IN ('active') AND articles.token IN ('active')";
		// подсчет строк
		$arrConf['calcRows'] = true;
		// LIMIT
		$arrConf['strLimit'] = (!empty($strLimit)) ? $strLimit : false;
		$arrOrderBy = (!empty($arrOrderBy)) ? $arrOrderBy : array('articles_comments.datetime' => 'DESC');

		return ($this -> getSubSelectEntrys($arrOrderBy, true, $arrConf)) ? $this -> retData() : false;
	}

	/********** Методы отправки сообщений **********/
	/**
	* Функция отправляет жалобу на комментарий
	* @param array $arrComment - массив данных комментария
	* @param array $arrDara - массив данных статьи
	* @param string $recipient - адрес получателя
	* @return bool
	*/
	public function sendComplaintComment($arrComment, $arrDara, $recipient) {
		$mailer = new mailer();

		// проверяем, кому уходит письмо
		if (CONF_MAIL_ADMIN_EMAIL == $recipient) {
			$link = CONF_SCRIPT_URL . CONF_ADMIN_FILE . '?m=manager&s=articles&do=filter&id=' . $arrDara['id'] . '&id_user=&author=&title=&id_section=&sDate=&eDate=&records=';
		} else {
			$link = chpu::createChpuUrl(CONF_SCRIPT_URL . 'index.php?do=articles&amp;action=view&amp;id=' . $arrDara['tId']);
		}

		// массив для замены в шаблоне
		$mailer -> setAddReplace(array(
					'%ARTICLE_TITLE%'			=> $arrDara['title'],
					'%ARTICLE_LINK%'			=> $link ,
					'%COMPLAINT_DATE%'		=> date(terms::dateFormatFromSmarty(CONF_DATE_FORMAT, CONF_TIME_FORMAT), strtotime(terms::currentDateTime())),
					'%COMMENT_DATE%'		=> date(terms::dateFormatFromSmarty(CONF_DATE_FORMAT, CONF_TIME_FORMAT), strtotime($arrComment['datetime'])),
					'%AUTHOR%'				=> $arrComment['name'],
					'%COMMENT_TEXT%'		=> (CONF_MAIL_FORMAT_HTML) ? nl2br($arrComment['text']) : $arrComment['text'],
				));

		// отправляем письмо администратору
		return $mailer -> sendEmail(CONF_MAIL_ADMIN_EMAIL, CONF_SITE_NAME, false, $recipient, false, MAIL_SUBJ_ARTICLES_COMMENTS_COMPLAINT, 'articles.comments.complaint.txt');
	}

	/////////////////////////////////////////////////
	// END OF CLASS articlesComments
	/////////////////////////////////////////////////
}
