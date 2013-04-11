<?php
/********************************************************
	JobExpert v1.0
	powered by Script Developers Group (SD-Group)
	email: info@sd-group.org.ua
	url: http://sd-group.org.ua/
	Copyright 2010-2015 (c) SD-Group
	All rights reserved
=========================================================
 	Класс работы с новостями
********************************************************/
/**
* @package
* @todo
*/

(!defined('SDG')) ? die ('Triple protection!') : null;

class news extends bnews
{
	/////////////////////////////////////////////////
	// VARS - свойства класса news
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
										'token'			=> '',
										'datetime'		=> '',
										'author'		=> '',
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
										'token_datetime'	=> '',
										'id_user'			=> '',
										'noComments'		=> '',
										'comments'			=> '',
    						   );

	/////////////////////////////////////////////////
	// CONSTRUCTOR - конструктор класса News
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
	// METHODS - методы класса News
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
	* Функция проверяет наличие новости в БД
	* 
	* @param (string) $strWhere - выражение для оператора WHERE
	* 
	* @return bool
	*/
	public function issetNews($strWhere)
	{
		return parent::issetNews($strWhere);
	}

	/**
	* Функция подсчитывает кол-во новостей в БД
	* 
	* @param (string) $strWhere - выражение для оператора WHERE, если false, то подсчет строк берется из SELECT FOUND_ROWS
	* 
	* @return int or false
	*/
	public function cntNews($strWhere = false)
	{
		return parent::cntNews($strWhere);
	}

	/**
	* функция получает параметры выбранной новости
	* 
	* @param (string) $strWhere - выражение для оператора WHERE
	* 
	* @return array or false
	*/
	public function getNews($strWhere)
	{
		return parent::getNews($strWhere);
	}

	/**
	* функция получает параметры выбранной опубликованной новости
	* 
	* @param (string) $strWhere - выражение для оператора WHERE
	* 
	* @return array or bool
	*/
	public function getPublishedNews($strWhere)
	{
		return parent::bGetPublishedNews($strWhere);
	}

	/**
	* protected функция получения новостей
	* Может использоваться как замена функции getAllNews
	* 
	* @param (string) $strWhere - условие WHERE для запроса or false
	* @param (array) $arrOrderBy - массив параметров сортировки результата выборки (key: name field => val: ASC | DESC) or false (в этом случае сортировка 'datetime' => 'DESC')
	* @param (mixed) $arrLimit - false or массив параметров для оператора LIMIT (key: 'strLimit' => val: string of LIMIT for example: '0, 10', key: 'calcRows' => val: true | false)
	* @param (array) $arrFields - массив полей для выборки (key: index => val: name field)
	* 
	* @return array or false
	*/
	public function getNewses($strWhere, $arrOrderBy, $arrLimit, $fields)
	{
		return parent::getNewses($strWhere, $arrOrderBy, $arrLimit, $fields);
	}

	/**
	* protected функция получает последние новости в соответствии с настройкой в панели администратора
	* 
	* @return array or false
	*/
	public function getLastNewses()
	{
		if (CONF_ENABLE_CACHING)
		{
			if (false === ($result = caching::getCahing('caching/newses.last.cache')))
			{
				$result = $this -> getNewses("token IN ('active') AND datetime<=NOW()", array('datetime' => 'DESC'), array('strLimit' => '0, ' . CONF_NEWSES_LAST_SHOW_PERPAGE, 'calcRows' => false), array('id', 'title', 'small_text', 'datetime'));

				(empty($result)) ? $result = array() : null;

				caching::setCaching('caching/newses.last.cache', $result);
			}
		}
		else
		{
			$result = $this -> getNewses("token IN ('active') AND datetime<=NOW()", array('datetime' => 'DESC'), array('strLimit' => '0, ' . CONF_NEWSES_LAST_SHOW_PERPAGE, 'calcRows' => false), array('id', 'title', 'small_text', 'datetime'));
		}

		return $result;
	}

	/**
	* protected функция получает все новости
	* Рекомендуется не использовать данную функцию. Для замены ф-я - getNewses
	* 
	* @param (string) $strWhere - условие WHERE для запроса or false
	* @param (string) $strLimit - выражение для оператора LIMIT or false
	* @param (array) $fields - массив полей для выборки (key: index => val: name field)
	* 
	* @return bool
	*/
	public function getAllNews($strWhere, $strLimit, $fields = false)
	{
		return parent::getAllNews($strWhere, $strLimit, $fields) ? parent::retData() : false;
	}

	/**
	* public функция получает все новости доступные для публикации
	* (новости, дата которых не больше текущей)
	* 
	* @param (array) $arrOrderBy - массив параметров сортировки результата выборки (key: name field => val: ASC | DESC) or false (в этом случае сортировка 'datetime' => 'DESC')
	* @param (mixed) $arrLimit - false or массив параметров для оператора LIMIT (key: 'strLimit' => val: string of LIMIT for example: '0, 10', key: 'calcRows' => val: true | false)
	* @param (array) $arrFields - массив полей для выборки (key: index => val: name field)
	* 
	* @return array or false
	*/
	public function getPuplishedNewses($arrOrderBy, $arrLimit, $fields)
	{
		return parent::bGetPuplishedNewses($arrOrderBy, $arrLimit, $fields);
	}

	/**
	* public функция производит запись данных в таблицу БД
	* 
	* @param array $arrBindFields - массив полей обязательных для заполнения
	* @param array $arrNoBindFields - массив полей не обязательных для заполнения
	* 
	* @return bool
	*/
	public function recNews()
	{
		return parent::recNews($this -> arrBindFields, $this -> arrNoBindFields);
	}

	/**
	* функция обновления новостей
	* 
	* @param (array) $arrData - массив данных для обновления (key: name field => val: value field)
	* @param (array) $arrNews - массив, содержащий id новостей для обновления (id_1, id_2, ..., id_n)
	* @param (string) $strWhere - выражение для оператора WHERE or false (по умолчанию false)
	* 
	* @return bool
	*/
	public function updateNews($arrData, $arrNews, $strWhere = false)
	{
		return parent::updateNews($arrData, $arrNews, $strWhere);
	}

	/**
	* функция помечает новости как удаленные
	* 
	* @param (array || false) $arrNews - массив, содержащий id новостей для удаления
	* @param (string || false) $strWhere - условие запроса. Если этот параметр не FALSE, то параметр $arrNews не обрабатывается (по умолчанию FALSE).
	* 
	* @return bool
	*/
	public function deleteNews($arrNews, $strWhere = false)
	{
		return parent::deleteNews($arrNews, $strWhere);
	}

	/**
	* функция помечает новости, находящиеся на редактировании, у которых истекла дата редактирования, как удаленные
	* 
	* @return bool
	*/
	public function deleteCorrection()
	{
		return parent::deleteCorrection();
	}

	/**
	* функция действий над новостями
	* 
	* @param (array) $action - действие, которое необходимо выполнить (сейчас доступны следующие действия: show - активировать, hide - архивировать, moderate - модерировать, del - удалить)
	* @param (array) $arrNews - массив, содержащий id новостей для выполнения действия
	* @param (string) $link - ссылка, для переадресации после выполнения действия
	* @param (string) $comments - комментарий, (добавляется администратором, при отправке новости на редактирование) or false.
	* @param (array or false) $notification - массив, содержащий данные для уведомления пользователя (id пользователя, title - заголовок новости) or false.
	* 
	* @return false или переадресация
	*/
	public function actionNews($action, $arrNews, $link, $comments, $notification)
	{
		return parent::actionNews($action, $arrNews, $link, $comments, $notification);
	}

	/********** END перегрузка методов родительских классов **********/

	/********** Методы отправки сообщений **********/
	/**
	* Функция отправляет админу сообщение о добавленной новости
	* 
	* @return void
	*/
	public function sendAdminAddNews()
	{
		$mailer = new mailer();

		// ID новости
		$id = $this -> getLine_id();
		// массив для замены в шаблоне
		$mailer -> setAddReplace(array(
					'%NEWS_TITLE%'			=> $this -> arrBindFields['title'],
					'%NEWS_ID%'				=> $id,
					'%PUBLICATION_DATE%'	=> date(terms::dateFormatFromSmarty(CONF_DATE_FORMAT, CONF_TIME_FORMAT), strtotime($this -> arrBindFields['datetime'])),
					'%NEWS_LINK%'			=> chpu::createChpuUrl(CONF_SCRIPT_URL . 'index.php?do=news&amp;action=view&amp;id=' . $id),
					'%ADMIN_PANEL_LINK%'	=> CONF_SCRIPT_URL . CONF_ADMIN_FILE . '?m=manager&amp;s=news'
				));

		// отправляем письмо администратору
		$mailer -> sendEmail(CONF_MAIL_ADMIN_EMAIL, CONF_SITE_NAME, false, CONF_MAIL_ADMIN_EMAIL, false, MAIL_SUBJ_NEW_NEWS . ': ' . $this -> arrBindFields['title'], 'adm.add.news.txt');
		unset ($mailer); // уничтожаем объект
	}

	/**
	* Функция отправляет админу сообщение о новости, отправленной на модерацию
	* 
	* @return void
	*/
	public function sendAdminModerateNews()
	{
		$mailer = new mailer();

		// ID новости
		$id = $this -> getLine_id();
		// массив для замены в шаблоне
		$mailer -> setAddReplace(array(
					'%NEWS_TITLE%'			=> $this -> arrBindFields['title'],
					'%NEWS_ID%'				=> $id,
					'%PUBLICATION_DATE%'	=> date(terms::dateFormatFromSmarty(CONF_DATE_FORMAT, CONF_TIME_FORMAT), strtotime($this -> arrBindFields['datetime'])),
					'%ADMIN_PANEL_LINK%'	=> CONF_SCRIPT_URL . CONF_ADMIN_FILE . '?m=manager&amp;s=news&amp;action=moderate'
				));

		// отправляем письмо администратору
		$mailer -> sendEmail(CONF_MAIL_ADMIN_EMAIL, CONF_SITE_NAME, false, CONF_MAIL_ADMIN_EMAIL, false, MAIL_SUBJ_MODERATE_NEWS . ': ' . $this -> arrBindFields['title'], 'adm.moderate.news.txt');
		unset ($mailer); // уничтожаем объект
	}

	/**
	* Функция отправляет админу сообщение о новости, отправленной на модерацию с исправления
	* 
	* @return void
	*/
	public function sendAdminCorrectionNews(&$arrData)
	{
		$mailer = new mailer();

		// массив для замены в шаблоне
		$mailer -> setAddReplace(array(
					'%NEWS_TITLE%'			=> $arrData['title'],
					'%NEWS_ID%'				=> $arrData['id'],
					'%PUBLICATION_DATE%'	=> date(terms::dateFormatFromSmarty(CONF_DATE_FORMAT, CONF_TIME_FORMAT), strtotime($arrData['datetime'])),
					'%ADMIN_PANEL_LINK%'	=> CONF_SCRIPT_URL . CONF_ADMIN_FILE . '?m=manager&amp;s=news&amp;action=moderate'
				));

		// отправляем письмо администратору
		$mailer -> sendEmail(CONF_MAIL_ADMIN_EMAIL, CONF_SITE_NAME, false, CONF_MAIL_ADMIN_EMAIL, false, MAIL_SUBJ_MODERATE_NEWS . ': ' . $arrData['title'], 'adm.edited.news.txt');
		unset ($mailer); // уничтожаем объект
	}

	/**
	* Функция отправляет пользователю сообщение о том, что его новость активирована
	* 
	* @param (array) $arrData - массив данных новости
	* 
	* @return void
	*/
	public function sendUserActiveNews(&$arrData)
	{
		/** Получаем данные пользователя **/
		$user = new user();
		if ($uData = $user -> getUser("id=" . secure::escQuoteData($arrData['id_user'])))
		{
			$mailer = new mailer();

			// массив для замены в шаблоне
			$mailer -> setAddReplace(array(
						'%NEWS_TITLE%'			=> $arrData['title'],
						'%PUBLICATION_DATE%'	=> date(terms::dateFormatFromSmarty(CONF_DATE_FORMAT, CONF_TIME_FORMAT), strtotime($arrData['datetime'])),
						'%NEWS_LINK%'			=> chpu::createChpuUrl(CONF_SCRIPT_URL . 'index.php?do=news&amp;action=view&amp;id=' . $arrData['id']),
						'%USER_PANEL_LINK%'		=> chpu::createChpuUrl(CONF_SCRIPT_URL . 'index.php?do=user.news&amp;action=active')
					));

			// отправляем письмо администратору
			$mailer -> sendEmail(CONF_MAIL_ADMIN_EMAIL, CONF_SITE_NAME, false, $uData['email'], $uData['first_name'], MAIL_MODERATE_NEWS_ACTIVATED . ': ' . $arrData['title'], 'user.news.active.txt');
			unset ($mailer); // уничтожаем объект
		}

		unset ($user); // уничтожаем объект
	}

	/**
	* Функция отправляет пользователю сообщение о том, что его новость возвращена на редактирование
	* 
	* @param (array) $arrData - массив данных новости
	* 
	* @return void
	*/
	public function sendUserCorrectionNews(&$arrData)
	{
		/** Получаем данные пользователя **/
		$user = new user();
		if ($uData = $user -> getUser("id=" . secure::escQuoteData($arrData['id_user'])))
		{
			$mailer = new mailer();

			// массив для замены в шаблоне
			$mailer -> setAddReplace(array(
						'%NEWS_TITLE%'			=> $arrData['title'],
						'%PUBLICATION_DATE%'	=> date(terms::dateFormatFromSmarty(CONF_DATE_FORMAT, CONF_TIME_FORMAT), strtotime($arrData['datetime'])),
						'%COMMENTS%'			=> (CONF_MAIL_FORMAT_HTML) ? nl2br($arrData['comments']) : $arrData['comments'],
						'%DELDATE%'				=> date(terms::dateFormatFromSmarty(CONF_DATE_FORMAT, CONF_TIME_FORMAT), strtotime(terms::calcDateTimeOfTerm(CONF_NEWSES_CORRECTION_THERM))),
						'%USER_PANEL_LINK%'		=> chpu::createChpuUrl(CONF_SCRIPT_URL . 'index.php?do=user.news&amp;action=correction')
					));

			// отправляем письмо администратору
			$mailer -> sendEmail(CONF_MAIL_ADMIN_EMAIL, CONF_SITE_NAME, false, $uData['email'], $uData['first_name'], MAIL_MODERATE_NEWS_CORRECTION . ': ' . $arrData['title'], 'user.news.correction.txt');
			unset ($mailer); // уничтожаем объект
		}

		unset ($user); // уничтожаем объект
	}

	/**
	* Функция отправляет пользователю сообщение о том, что его новость удалена
	* 
	* @param (array) $arrData - массив данных новости
	* 
	* @return void
	*/
	public function sendUserDeletedNews(&$arrData)
	{
		/** Получаем данные пользователя **/
		$user = new user();
		if ($uData = $user -> getUser("id=" . secure::escQuoteData($arrData['id_user'])))
		{
			$mailer = new mailer();

			// массив для замены в шаблоне
			$mailer -> setAddReplace(array(
						'%NEWS_TITLE%'	=> $arrData['title'],
						'%COMMENTS%'	=> (CONF_MAIL_FORMAT_HTML) ? nl2br($arrData['comments']) : $arrData['comments']
					));

			// отправляем письмо администратору
			$mailer -> sendEmail(CONF_MAIL_ADMIN_EMAIL, CONF_SITE_NAME, false, $uData['email'], $uData['first_name'], MAIL_MODERATE_NEWS_DELETED . ': ' . $arrData['title'], 'user.news.deleted.txt');
			unset ($mailer); // уничтожаем объект
		}

		unset ($user); // уничтожаем объект
	}
	/********** END Методы отправки сообщений **********/

	/********** Работа с архивами новостей **********/
	public function arcGetDateFirstRecord() {
		return $this -> pArcGetDateFirstRecord();
	}
	
	public function arcGenerateYears()
	{
		return $this -> pArcGenerateYears();
	}

	/********** END Работа с архивами новостей **********/
	/////////////////////////////////////////////////
	// END OF CLASS News
	/////////////////////////////////////////////////
}

