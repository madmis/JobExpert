<?php

/**
 * JobExpert v1.0
 * Powered by Script Developers Group (SD-Group)
 * Email: info@sd-group.org.ua
 * URL: http://sd-group.org.ua/
 * Copyright 2010-2015 (c) SD-Group
 * All rights reserved
 * ===================================================
 * Базовый Класс работы с новостями
 * ===================================================
 *
 * @package
 *
 * @todo
 *
 */
(!defined('SDG')) ? die('Triple protection!') : null;

/**
 * Базовый Класс работы с новостями
 */
abstract class bnews extends tbentrys {
	/////////////////////////////////////////////////
	// VARS - свойства класса bnews
	/////////////////////////////////////////////////
	/////////////////////////////////////////////////
	// CONSTRUCTOR - конструктор класса bnews
	/////////////////////////////////////////////////

	/**
	 * конструктор
	 *
	 * @return void
	 */
	protected function __construct() {
		// устанавливаем имя рабочей таблицы
		$this->setTable('news');
		// массив (список) файлов кешируемых данных
		$arrCacheFiles = array(
			'caching/newses.last.cache'
		);
		// формируем массив параметров для вызова конструктора родительского класса
		$arrParams = array(
			'arrCacheFiles' => &$arrCacheFiles,
			'tIdForce' => true
		);

		// вызываем конструктор родительского класса
		parent::__construct($arrParams);
	}

	/////////////////////////////////////////////////
	// METHODS - методы класса bnews
	/////////////////////////////////////////////////

	/**
	 * private функция передает значения полей полученных из формы в свойсво базового класса, для последующей записи в таблицу БД
	 *
	 * @param mixed $arrBindFields
	 * @param mixed $arrNoBindFields
	 *
	 * @return bool
	 */
	private function setNewsSubj($arrBindFields, $arrNoBindFields) {
		return $this->fillTableFieldsValue($arrBindFields + $arrNoBindFields);
	}

	/**
	 * функция возвращает свойство $tbData
	 *
	 * @return array or false
	 */
	protected function retData() {
		return parent::retData();
	}

	/**
	 * Функция проверяет наличие новости в БД
	 *
	 * @param (string) $strWhere - выражение для оператора WHERE
	 *
	 * @return bool
	 */
	protected function issetNews($strWhere) {
		return $this->issetRow($strWhere);
	}

	/**
	 * protected Функция подсчитывает кол-во активных новостей в БД
	 *
	 * @param (string) $strWhere - выражение для оператора WHERE, если false, то подсчет строк берется из SELECT FOUND_ROWS
	 *
	 * @return int or false
	 */
	protected function cntNews($strWhere) {
		return (!$strWhere) ? $this->calcFoundRows() : $this->cntEntrys($strWhere);
	}

	/**
	 * protected функция получает параметры выбранной новости
	 *
	 * @param (string) $strWhere - выражение для оператора WHERE
	 *
	 * @return array or bool
	 */
	protected function getNews($strWhere) {
		return $this->getEntry($strWhere) ? $this->retDataSubj() : false;
	}

	/**
	 * protected функция получает параметры выбранной опубликованной новости
	 *
	 * @param (string) $strWhere - выражение для оператора WHERE
	 *
	 * @return array or bool
	 */
	protected function bGetPublishedNews(&$strWhere) {
		$strWhere = (!empty($strWhere)) ? $strWhere . " AND token IN ('active') AND datetime <= NOW()" : "token IN ('active') AND datetime <= NOW()";

		return $this->getNews($strWhere);
	}

	/**
	 * protected функция получения новостей
	 * Может использоваться как замена функции getAllNews
	 *
	 * @param (string) $strWhere - условие WHERE для запроса or false (в этом случае сортировка 'datetime' => 'DESC')
	 * @param (array) $arrOrderBy - массив параметров сортировки результата выборки (key: name field => val: ASC | DESC) or false
	 * @param (mixed) $arrLimit - false or массив параметров для оператора LIMIT (key: 'strLimit' => val: string of LIMIT for example: '0, 10', key: 'calcRows' => val: true | false)
	 * @param (array) $arrFields - массив полей для выборки (key: index => val: name field)
	 *
	 * @return array or false
	 */
	protected function getNewses($strWhere, $arrOrderBy, $arrLimit, $fields) {
		(!$arrOrderBy) ? $arrOrderBy = array('datetime' => 'DESC') : null;

		return $this->getEntrys($strWhere, $arrOrderBy, $arrLimit, $fields, false) ? $this->retData() : false;
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
	protected function getAllNews($strWhere, $strLimit, $fields) {
		return $this->getEntrys($strWhere, array('datetime' => 'DESC'), $strLimit, $fields);
	}

	/**
	 * protected функция получает все новости доступные для публикации
	 * (новости, дата которых не больше текущей)
	 *
	 * @param (array) $arrOrderBy - массив параметров сортировки результата выборки (key: name field => val: ASC | DESC) or false (в этом случае сортировка 'datetime' => 'DESC')
	 * @param (mixed) $arrLimit - false or массив параметров для оператора LIMIT (key: 'strLimit' => val: string of LIMIT for example: '0, 10', key: 'calcRows' => val: true | false)
	 * @param (array) $arrFields - массив полей для выборки (key: index => val: name field)
	 *
	 * @return array or false
	 */
	protected function bGetPuplishedNewses(&$arrOrderBy, &$arrLimit, &$fields) {
		$strWhere = "token IN ('active') AND datetime <= NOW()";

		return $this->getNewses($strWhere, $arrOrderBy, $arrLimit, $fields);
	}

	/**
	 * protected функция производит запись данных в таблицу БД
	 *
	 * @param array $arrBindFields - массив полей обязательных для заполнения
	 * @param array $arrNoBindFields - массив полей не обязательных для заполнения
	 *
	 * @return bool
	 */
	protected function recNews($arrBindFields, $arrNoBindFields) {
		if ($this->setNewsSubj($arrBindFields, $arrNoBindFields) && $this->addEntry()) {
			return true;
		} else {
			return false;
		}
	}

	/**
	 * protected функция обновления новостей
	 *
	 * @param (array) $arrData - массив данных для обновления (key: name field => val: value field)
	 * @param (array) $arrNews - массив, содержащий id новостей для обновления (id_1, id_2, ..., id_n)
	 * @param (string) $strWhere - выражение для оператора WHERE or false (по умолчанию false)
	 *
	 * @return bool
	 */
	protected function updateNews($arrData, $arrNews, $strWhere = false) {
		$strWhere = (!$strWhere) ? 'id IN (' . implode(',', secure::escQuoteData($arrNews)) . ')' : $strWhere . ' AND id IN (' . implode(',', secure::escQuoteData($arrNews)) . ')';

		return $this->editEntrys(secure::escQuoteData($arrData), $strWhere);
	}

	/**
	 * protected функция помечает новости как удаленные
	 *
	 * @param (array || false) $arrNews - массив, содержащий id новостей для удаления
	 * @param (string || false) $strWhere - условие запроса. Если этот параметр не FALSE, то параметр $arrNews не обрабатывается.
	 *
	 * @return bool
	 */
	protected function deleteNews($arrNews, $strWhere) {
		if (empty($arrNews) && empty($strWhere)) {
			return false;
		}

		$strWhere = (empty($strWhere)) ? 'id IN (' . implode(',', secure::escQuoteData($arrNews)) . ')' : (!empty($arrNews) ? $strWhere . ' AND id IN (' . implode(',', secure::escQuoteData($arrNews)) . ')' : $strWhere);

		// удаляем комментарии к новостям
		if (!empty($arrNews)) {
			// при удалении пользователей, если выбрано удаление новостей пользователя
			// комментарии к новостям удалены не будут, т.к. удаление новостей идет по id_user
			// и id новостей, которые необходимо удалить неизвестны
			$newsComments = new newsComments();
			if (!$newsComments->deleteRecords('id_news IN (' . implode(',', secure::escQuoteData($arrNews)) . ')')) {
				return false;
			}
		}

		return $this->delEntrys($strWhere);
	}

	/**
	 * protected функция помечает новости, находящиеся на редактировании, у которых истекла дата редактирования, как удаленные
	 *
	 * @return bool
	 */
	protected function deleteCorrection() {
		$strWhere = "token IN ('correction') AND token_datetime<='" . terms::currentDateTime() . "'";

		return $this->delEntrys($strWhere);
	}

	/**
	 * функция действий над новостями
	 *
	 * @param (string) $action - действие, которое необходимо выполнить (сейчас доступны следующие действия: show - активировать, hide - архивировать, moderate - модерировать, del - удалить)
	 * @param (array) $arrNews - массив, содержащий id новостей для выполнения действия
	 * @param (string) $link - ссылка, для переадресации после выполнения действия
	 * @param (string or false) $comments - комментарий, (добавляется администратором, при отправке новости на редактирование) or false.
	 * @param (array or false) $notification - массив, содержащий данные для уведомления пользователя (id пользователя, title - заголовок новости) or false.
	 *
	 * @return false или переадресация
	 */
	protected function actionNews($action, $arrNews, $link, $comments, $notification) {
		switch ($action) {
			case 'show':
				if (!$this->updateNews(array('token' => 'active'), $arrNews)) {
					return false;
				} else {
					// отправляем пользователю уведомление
					($notification) ? $this->moderateSendMail($action, $notification, $comments) : null;

					messages::messageChangeSaved(MESSAGE_CHANGE_SAVED, false, $link);
				}
				break;

			case 'hide':
				if (!$this->updateNews(array('token' => 'archived'), $arrNews)) {
					return false;
				} else {
					messages::messageChangeSaved(MESSAGE_CHANGE_SAVED, false, $link);
				}
				break;

			case 'correction':
				// вычисляем дату удаления новости
				$date = terms::calcDateTimeOfTerm(CONF_NEWS_USER_CORRECTION_TIME);
				// массив данных для обновления новости
				$arrData = ($comments) ? array('token' => 'correction', 'token_datetime' => $date, 'comments' => $comments) : array('token' => 'correction', 'token_datetime' => $date);

				if (!$this->updateNews($arrData, $arrNews)) {
					return false;
				} else {
					// отправляем пользователю уведомление
					($notification) ? $this->moderateSendMail($action, $notification, $comments, $date) : null;

					messages::messageChangeSaved(MESSAGE_CHANGE_SAVED, false, $link);
				}
				break;

			case 'del':
				if (!$this->deleteNews($arrNews, false)) {
					return false;
				} else {
					// отправляем пользователю уведомление
					($notification) ? $this->moderateSendMail($action, $notification, $comments) : null;

					messages::messageChangeSaved(MESSAGE_CHANGE_SAVED, false, $link);
				}
				break;
		}
	}

	/**
	 * private функция рассылки почтовых сообщений при модерации новости
	 *
	 * @param (string) $action - действие, которое было выполнено с новостью
	 * @param (array) $arrData - должен содержать id пользователя и title новости
	 * @param (string or false) $comments - комментарий к модерируемой новости
	 * @param (string or false) $date - дата, когда новость будет автоматически удалена. По умолчанию false
	 *
	 * @return void
	 */
	private function moderateSendMail($action, $arrData, $comments, $date = false) {
		// проверяем, есть ли данные по новости
		if (!$arrData['id_user'] || !$arrData['title']) {
			return false;
		}

		$user = new user();
		// получаем емайл пользователя
		if (!$arrUser = $user->getUser("id IN (" . secure::escQuoteData($arrData['id_user']) . ")")) {
			return false;
		}

		// проверяем действие, выполненное над новостью
		switch ($action) {
			case'show':
				$status = MAIL_MODERATE_NEWS_ACTIVATED;
				break;

			case'correction':
				$status = MAIL_MODERATE_NEWS_CORRECTION;
				break;

			case'del':
				$status = MAIL_MODERATE_NEWS_DELETED;
				break;
		}

		$mailer = new mailer();
		// массив для замены в шаблоне
		$mailer->setAddReplace(array(
			'%TITLE%' => $arrData['title'],
			'%STATUS%' => $status,
			'%COMMENTS%' => ($comments) ? $comments : MAIL_MODERATE_NEWS_COMMENTS,
			'%DELDATE%' => ($date) ? MAIL_MODERATE_NEWS_DELETE_DATE . date(terms::dateFormatFromSmarty(CONF_DATE_FORMAT, CONF_TIME_FORMAT), strtotime($date)) : ''
		));

		$mailer->sendEmail(CONF_MAIL_ADMIN_EMAIL, false, false, $arrUser['email'], $arrUser['email'], MAIL_SUBJ_MODERATE_NEWS . ': ' . $arrData['title'], 'moderate.news.txt');
	}

	/*	 * ***** Работа с архивами новостей ****** */

	/**
	 * Функция получает год первой архивной новости
	 *
	 */
	protected function pArcGetDateFirstRecord() {
		$strWhere = "token = 'archived'";
		$arrOrderBy = array('datetime' => 'ASC');
		$arrLimit = array('strLimit' => '1', 'calcRows' => false);
		$arrFields = array('YEAR(`datetime`) AS datetime');

		$arrData = $this->getNewses($strWhere, $arrOrderBy, $arrLimit, $arrFields);
		if (!empty($arrData[0]['datetime'])) {
			return $arrData[0]['datetime'];
		} else {
			return false;
		}
	}

	protected function pArcGenerateYears() {
		$arrYears = array();
		$firstYear = $this->pArcGetDateFirstRecord();
		if (!empty($firstYear)) {
			$currYear = terms::currentDateTime('Y');
			$arrYears = array($firstYear);

			for ($i = ++$firstYear; $i <= $currYear; $i++) {
				$arrYears[] = $i;
			}
			rsort($arrYears);
		}

		return $arrYears;
	}

	/////////////////////////////////////////////////
	// END OF CLASS bnews
	/////////////////////////////////////////////////
}

