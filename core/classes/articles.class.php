<?php
/********************************************************
JobExpert v1.0
powered by Script Developers Group (SD-Group)
email: info@sd-group.org.ua
url: http://sd-group.org.ua/
Copyright 2010-2015 (c) SD-Group
All rights reserved
=========================================================
Класс работы со статьями
********************************************************/
/**
* @package
* @todo
*/


(!defined('SDG')) ? die ('Triple protection!') : null;

class articles extends barticles
{
	/////////////////////////////////////////////////
	// VARS - свойства класса articles
	/////////////////////////////////////////////////
	/**
	* Массив для хранения наименований и значений полей для записи в таблицу БД
	* В этом массиве хранятся поля обязательные для заполнения
	*
	* @var array
	*/
	public $arrBindFields = array(
		'title'			=> '',
		'small_text'	=> '',
		'text'			=> '',
		'id_section'	=> '',
		'author'		=> '',
		'datetime'		=> '',
		'token'			=> ''
 	);

	/**
	* Массив для хранения наименований и значений полей для записи в таблицу БД
	* В этом массиве хранятся поля не обязательные для заполнения
	*
	* @var array
	*/
	public $arrNoBindFields = array(
		'meta_keywords'		=> '',
		'meta_description'	=> '',
		'id_user'			=> '',
		'comments'			=> '',
		'rating'			=> '',
		'votes'				=> '',
		'ip_last'			=> '',
		'noComments'		=> '',
		'token_datetime'	=> ''
    );

	/////////////////////////////////////////////////
	// CONSTRUCTOR - конструктор класса articles
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
	// METHODS - методы класса articles
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
	* public Функция подсчитывает кол-во статей в БД
	*
	* @param (string) $strWhere - выражение для оператора WHERE, если false, то подсчет строк берется из SELECT FOUND_ROWS
	*
	* @return int or false
	*/
	public function cntArticles($strWhere = false)
	{
		return $this -> pCntArticles($strWhere);
	}

	/**
	* функция получает параметры выбранной статьи
	*
	* @param (string) $strWhere - выражение для оператора WHERE
	*
	* @return array or bool
	*/
	public function getArticle($strWhere, $fields = false)
	{
		return $this -> pGetArticle($strWhere, $fields);
	}

	/**
	* функция получает параметры выбранной опубликованной статьи
	*
	* @param (string) $strWhere - выражение для оператора WHERE or false
	* @param (array) $fields - массив полей для выборки (key: index => val: name field). По у молчанию false
	*
	* @return array or bool
	*/
	public function getPublishedArticle($strWhere, $fields = false)
	{
		return $this -> pGetPublishedArticle($strWhere, $fields);
	}

	/**
	* public функция получает все статьи
	*
	* @param (string) $strWhere - условие WHERE для запроса or false
	* @param (array) $arrOrderBy - массив параметров сортировки результата выборки (key: name field => val: ASC | DESC) or false (в этом случае сортировка 'datetime' => 'DESC')
	* @param (string) $strLimit - выражение для оператора LIMIT or false
	* @param (array) $fields - массив полей для выборки (key: index => val: name field)
	*
	* @return bool
	*/
	public function getArticles($strWhere, $arrOrderBy, $strLimit, $fields = false)
	{
		return $this -> pGetArticles($strWhere, $arrOrderBy, $strLimit, $fields) ? $this -> retData() : false;
	}

	/**
	* функция получает все статьи доступные для публикации
	* (статьи, дата которых не больше текущей)
	*
	* @param (string) $strWhere - выражение для оператора WHERE or false
	* @param (array) $arrOrderBy - массив параметров сортировки результата выборки (key: name field => val: ASC | DESC) or false (в этом случае сортировка 'datetime' => 'DESC')
	* @param (mixed) $arrLimit - false or массив параметров для оператора LIMIT (key: 'strLimit' => val: string of LIMIT for example: '0, 10', key: 'calcRows' => val: true | false)
	* @param (array) $arrFields - массив полей для выборки (key: index => val: name field)
	*
	* @return array or false
	*/
	public function getPuplishedArticles($strWhere, $arrOrderBy, $arrLimit, $fields)
	{
		return $this -> pGetPuplishedArticles($strWhere, $arrOrderBy, $arrLimit, $fields);
	}

	/**
	* public функция производит запись данных в таблицу БД
	*
	* @param array $arrBindFields - массив полей обязательных для заполнения
	* @param array $arrNoBindFields - массив полей не обязательных для заполнения
	*
	* @return bool
	*/
	public function recArticle()
	{
		return $this -> pRecArticle($this -> arrBindFields, $this -> arrNoBindFields);
	}

 	/**
	* public функция обновления статей
	*
	* @param (array) $arrData - массив данных для обновления (key: name field => val: value field)
	* @param (array) $arrArticles - массив, содержащий id статей для обновления (id_1, id_2, ..., id_n)
	* @param (string) $strWhere - выражение для оператора WHERE or false (по умолчанию false)
	*
	* @return bool
	*/
	public function updateArticles($arrData, $arrArticles, $strWhere = false)
	{
		return $this -> pUpdateArticles($arrData, $arrArticles, $strWhere);
	}

 	/**
	* public функция обновления (редактирования) одной статьи
	*
	* @param (array) $arrData - массив данных для обновления (key: name field => val: value field)
	* @param (int) $id - id статьи для обновления
	*
	* @return bool
	*/
	public function updateArticle($arrData, $id)
	{
		return $this -> pUpdateArticle($arrData, $id);
	}

	/**
	* public функция помечает статьи как удаленные
	*
	* @param (array || false) $arrArticles - массив, содержащий id статей для удаления
	* @param (string || false) $strWhere -  дополнительное условие запроса (к нему присоединяются $arrArticles).
	*
	* @return bool
	*/
	public function deleteArticles($arrArticles, $strWhere = false)
	{
		return $this -> pDeleteArticles($arrArticles, $strWhere);
	}

	/**
	* public функция помечает статьи как удаленные, на основании id раздела
	*
	* @param (array) $id_section - id раздела
	*
	* @return bool
	*/
	public function deleteArticlesBySection($id_section)
	{
		return $this -> pDeleteArticlesBySection($id_section);
	}

	/**
	* функция оцнеки статьи
	*
	* @param int $score - оценка статьи
	* @param int $id - id статьи
	*
	* @return echo (печатает результат)
	*/
	public function rateArticle($score, $id)
	{
		return $this -> pRateArticle($score, $id);
	}

	/********** END перегрузка методов родительских классов **********/

	/********** Методы отправки сообщений **********/
	/**
	* Функция отправляет админу сообщение о добавленной статье
	*
	* @return void
	*/
	public function sendAdminAddArticle()
	{
		$mailer = new mailer();

		// ID статьи
		$id = $this -> getLine_id();
		// массив для замены в шаблоне
		$mailer -> setAddReplace(array(
					'%ARTICLE_TITLE%'		=> $this -> arrBindFields['title'],
					'%ARTICLE_ID%'			=> $id,
					'%PUBLICATION_DATE%'	=> date(terms::dateFormatFromSmarty(CONF_DATE_FORMAT, CONF_TIME_FORMAT), strtotime($this -> arrBindFields['datetime'])),
					'%ARTICLE_LINK%'		=> chpu::createChpuUrl(CONF_SCRIPT_URL . 'index.php?do=articles&amp;action=view&amp;id=' . $id),
					'%ADMIN_PANEL_LINK%'	=> CONF_SCRIPT_URL . CONF_ADMIN_FILE . '?m=manager&amp;s=articles'
				));

		// отправляем письмо администратору
		$mailer -> sendEmail(CONF_MAIL_ADMIN_EMAIL, CONF_SITE_NAME, false, CONF_MAIL_ADMIN_EMAIL, false, MAIL_SUBJ_NEW_ARTICLE . ': ' . $this -> arrBindFields['title'], 'adm.add.article.txt');
		unset ($mailer); // уничтожаем объект
	}

	/**
	* Функция отправляет админу сообщение о статье, отправленной на модерацию
	*
	* @return void
	*/
	public function sendAdminModerateArticle()
	{
		$mailer = new mailer();

		// ID статьи
		$id = $this -> getLine_id();
		// массив для замены в шаблоне
		$mailer -> setAddReplace(array(
					'%ARTICLE_TITLE%'		=> $this -> arrBindFields['title'],
					'%ARTICLE_ID%'			=> $id,
					'%PUBLICATION_DATE%'	=> date(terms::dateFormatFromSmarty(CONF_DATE_FORMAT, CONF_TIME_FORMAT), strtotime($this -> arrBindFields['datetime'])),
					'%ADMIN_PANEL_LINK%'	=> CONF_SCRIPT_URL . CONF_ADMIN_FILE . '?m=manager&amp;s=articles&amp;action=moderate'
				));

		// отправляем письмо администратору
		$mailer -> sendEmail(CONF_MAIL_ADMIN_EMAIL, CONF_SITE_NAME, false, CONF_MAIL_ADMIN_EMAIL, false, MAIL_SUBJ_MODERATE_ARTICLE . ': ' . $this -> arrBindFields['title'], 'adm.moderate.article.txt');
		unset ($mailer); // уничтожаем объект
	}

	/**
	* Функция отправляет админу сообщение о статье, отправленной на модерацию с исправления
	*
	* @return void
	*/
	public function sendAdminCorrectionArticle(&$arrData)
	{
		$mailer = new mailer();

		// массив для замены в шаблоне
		$mailer -> setAddReplace(array(
					'%ARTICLE_TITLE%'		=> $arrData['title'],
					'%ARTICLE_ID%'			=> $arrData['id'],
					'%PUBLICATION_DATE%'	=> date(terms::dateFormatFromSmarty(CONF_DATE_FORMAT, CONF_TIME_FORMAT), strtotime($arrData['datetime'])),
					'%ADMIN_PANEL_LINK%'	=> CONF_SCRIPT_URL . CONF_ADMIN_FILE . '?m=manager&amp;s=articles&amp;action=moderate'
				));

		// отправляем письмо администратору
		$mailer -> sendEmail(CONF_MAIL_ADMIN_EMAIL, CONF_SITE_NAME, false, CONF_MAIL_ADMIN_EMAIL, false, MAIL_SUBJ_MODERATE_ARTICLE . ': ' . $this -> arrBindFields['title'], 'adm.edited.article.txt');
		unset ($mailer); // уничтожаем объект
	}

	/**
	* Функция отправляет пользователю сообщение о том, что его статья активирована
	*
	* @param (array) $arrData - массив данных статьи
	*
	* @return void
	*/
	public function sendUserActiveArticle(&$arrData)
	{
		/** Получаем данные пользователя **/
		$user = new user();
		if ($uData = $user -> getUser("id IN (" . secure::escQuoteData($arrData['id']) . ")"))
		{
			$mailer = new mailer();

			// массив для замены в шаблоне
			$mailer -> setAddReplace(array(
						'%ARTICLE_TITLE%'		=> $arrData['title'],
						'%PUBLICATION_DATE%'	=> date(terms::dateFormatFromSmarty(CONF_DATE_FORMAT, CONF_TIME_FORMAT), strtotime($arrData['datetime'])),
						'%ARTICLE_LINK%'		=> chpu::createChpuUrl(CONF_SCRIPT_URL . 'index.php?do=articles&amp;action=view&amp;id=' . $arrData['tId']),
						'%USER_PANEL_LINK%'		=> chpu::createChpuUrl(CONF_SCRIPT_URL . 'index.php?do=user.articles&amp;action=active')
					));

			// отправляем письмо администратору
			$mailer -> sendEmail(CONF_MAIL_ADMIN_EMAIL, CONF_SITE_NAME, false, $uData['email'], $uData['first_name'], MAIL_MODERATE_ARTICLES_ACTIVE . ': ' . $arrData['title'], 'user.article.active.txt');
			unset ($mailer); // уничтожаем объект
		}

		unset ($user); // уничтожаем объект
	}

	/**
	* Функция отправляет пользователю сообщение о том, что его статья возвращена на редактирование
	*
	* @param (array) $arrData - массив данных статьи
	*
	* @return void
	*/
	public function sendUserCorrectionArticle(&$arrData)
	{
		/** Получаем данные пользователя **/
		$user = new user();
		if ($uData = $user -> getUser("id IN (" . secure::escQuoteData($arrData['id']) . ")"))
		{
			$mailer = new mailer();

			// массив для замены в шаблоне
			$mailer -> setAddReplace(array(
						'%ARTICLE_TITLE%'		=> $arrData['title'],
						'%PUBLICATION_DATE%'	=> date(terms::dateFormatFromSmarty(CONF_DATE_FORMAT, CONF_TIME_FORMAT), strtotime($arrData['datetime'])),
						'%COMMENTS%'			=> (CONF_MAIL_FORMAT_HTML) ? nl2br($arrData['comments']) : $arrData['comments'],
						'%DELDATE%'				=> date(terms::dateFormatFromSmarty(CONF_DATE_FORMAT, CONF_TIME_FORMAT), strtotime(terms::calcDateTimeOfTerm(CONF_ARTICLES_CORRECTION_THERM))),
						'%USER_PANEL_LINK%'		=> chpu::createChpuUrl(CONF_SCRIPT_URL . 'index.php?do=user.articles&amp;action=correction')
					));

			// отправляем письмо администратору
			$mailer -> sendEmail(CONF_MAIL_ADMIN_EMAIL, CONF_SITE_NAME, false, $uData['email'], $uData['first_name'], MAIL_MODERATE_ARTICLES_CORRECTION . ': ' . $arrData['title'], 'user.article.correction.txt');
			unset ($mailer); // уничтожаем объект
		}

		unset ($user); // уничтожаем объект
	}

	/**
	* Функция отправляет пользователю сообщение о том, что его статья удалена
	*
	* @param (array) $arrData - массив данных статьи
	*
	* @return void
	*/
	public function sendUserDeletedArticle(&$arrData)
	{
		/** Получаем данные пользователя **/
		$user = new user();
		if ($uData = $user -> getUser("id IN (" . secure::escQuoteData($arrData['id']) . ")"))
		{
			$mailer = new mailer();

			// массив для замены в шаблоне
			$mailer -> setAddReplace(array(
						'%ARTICLE_TITLE%'		=> $arrData['title'],
						'%COMMENTS%'			=> (CONF_MAIL_FORMAT_HTML) ? nl2br($arrData['comments']) : $arrData['comments']
					));

			// отправляем письмо администратору
			$mailer -> sendEmail(CONF_MAIL_ADMIN_EMAIL, CONF_SITE_NAME, false, $uData['email'], $uData['first_name'], MAIL_MODERATE_ARTICLES_DELETED . ': ' . $arrData['title'], 'user.article.deleted.txt');
			unset ($mailer); // уничтожаем объект
		}

		unset ($user); // уничтожаем объект
	}
	/********** END Методы отправки сообщений **********/

	/////////////////////////////////////////////////
	// END OF CLASS articles
	/////////////////////////////////////////////////
}
