<?php

/**
 * JobExpert v1.0
 * Powered by Script Developers Group (SD-Group)
 * Email: info@sd-group.org.ua
 * URL: http://sd-group.org.ua/
 * Copyright 2010-2015 (c) SD-Group
 * All rights reserved
 * ===================================================
 * Базовый Класс работы со статьями
 * ===================================================
 *
 * @package
 *
 * @todo
 *
 */
(!defined('SDG')) ? die('Triple protection!') : null;

/**
 * Базовый Класс работы со статьями
 */
abstract class barticles extends tbentrys {
	/////////////////////////////////////////////////
	// VARS - свойства класса barticles
	/////////////////////////////////////////////////
	/////////////////////////////////////////////////
	// CONSTRUCTOR - конструктор класса barticles
	/////////////////////////////////////////////////

	/**
	 * конструктор
	 *
	 * @return void
	 */
	protected function __construct() {
		$this->setTable('articles');
		// массив (список) файлов кешируемых данных
		$arrCacheFiles = array(
			'caching/articles_sections.cache'
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
	// METHODS - методы класса barticles
	/////////////////////////////////////////////////

	/**
	 * private функция передает значения полей полученных из формы в свойсво базового класса, для последующей записи в таблицу БД
	 *
	 * @param mixed $arrBindFields
	 * @param mixed $arrNoBindFields
	 *
	 * @return bool
	 */
	private function setArticleSubj(&$arrBindFields, &$arrNoBindFields) {
		return $this->fillTableFieldsValue($arrBindFields + $arrNoBindFields);
	}

	/**
	 * Функция подсчитывает кол-во статей в БД
	 *
	 * @param (string) $strWhere - выражение для оператора WHERE, если false, то подсчет строк берется из SELECT FOUND_ROWS
	 *
	 * @return int or false
	 */
	protected function pCntArticles($strWhere) {
		return (!$strWhere) ? $this->calcFoundRows() : $this->cntEntrys($strWhere);
	}

	/**
	 * функция получает параметры выбранной статьи
	 *
	 * @param (string) $strWhere - выражение для оператора WHERE
	 * @param (array) $fields - массив полей для выборки (key: index => val: name field). По у молчанию false
	 *
	 * @return array or bool
	 */
	protected function pGetArticle($strWhere, $fields = false) {
		return $this->getEntry($strWhere, $fields) ? $this->retDataSubj() : false;
	}

	/**
	 * protected функция получает параметры выбранной опубликованной статьи
	 *
	 * @param (string) $strWhere - выражение для оператора WHERE or false
	 * @param (array) $fields - массив полей для выборки (key: index => val: name field). По у молчанию false
	 *
	 * @return array or bool
	 */
	protected function pGetPublishedArticle(&$strWhere, $fields = false) {
		$strWhere = (!empty($strWhere)) ? $strWhere . " AND token IN ('active') AND datetime <= NOW()" : "token IN ('active') AND datetime <= NOW()";

		return $this->pGetArticle($strWhere, $fields);
	}

	/**
	 * функция получает все статьи
	 *
	 * @param (string) $strWhere - условие WHERE для запроса or false
	 * @param (array) $arrOrderBy - массив параметров сортировки результата выборки (key: name field => val: ASC | DESC) or false (в этом случае сортировка 'datetime' => 'DESC')
	 * @param (string) $strLimit - выражение для оператора LIMIT or false
	 * @param (array) $fields - массив полей для выборки (key: index => val: name field)
	 *
	 * @return bool
	 */
	protected function pGetArticles(&$strWhere, &$arrOrderBy, &$strLimit, &$fields) {
		if (empty($arrOrderBy) || !is_array($arrOrderBy)) {
			$arrOrderBy = array('datetime' => 'DESC');
		}

		return $this->getEntrys($strWhere, $arrOrderBy, $strLimit, $fields, false);
	}

	/**
	 * protected функция получает все статьи доступные для публикации
	 * (статьи, дата которых не больше текущей)
	 *
	 * @param (string) $strWhere - выражение для оператора WHERE or false
	 * @param (array) $arrOrderBy - массив параметров сортировки результата выборки (key: name field => val: ASC | DESC) or false (в этом случае сортировка 'datetime' => 'DESC')
	 * @param (mixed) $arrLimit - false or массив параметров для оператора LIMIT (key: 'strLimit' => val: string of LIMIT for example: '0, 10', key: 'calcRows' => val: true | false)
	 * @param (array) $arrFields - массив полей для выборки (key: index => val: name field)
	 *
	 * @return array or false
	 */
	protected function pGetPuplishedArticles(&$strWhere, &$arrOrderBy, &$arrLimit, &$fields) {
		$strWhere = (!empty($strWhere)) ? $strWhere . " AND token IN ('active') AND datetime <= NOW()" : "token IN ('active') AND datetime <= NOW()";

		return ($this->pGetArticles($strWhere, $arrOrderBy, $arrLimit, $fields)) ? $this->retData() : false;
	}

	/**
	 * protected функция производит запись данных в таблицу БД
	 *
	 * @param array $arrBindFields - массив полей обязательных для заполнения
	 * @param array $arrNoBindFields - массив полей не обязательных для заполнения
	 *
	 * @return bool
	 */
	protected function pRecArticle(&$arrBindFields, &$arrNoBindFields) {
		return ($this->setArticleSubj($arrBindFields, $arrNoBindFields) && $this->addEntry()) ? true : false;
	}

	/**
	 * protected функция обновления статей
	 *
	 * @param (array) $arrData - массив данных для обновления (key: name field => val: value field)
	 * @param (array) $arrArticles - массив, содержащий id статей для обновления (id_1, id_2, ..., id_n)
	 * @param (string) $strWhere - выражение для оператора WHERE or false (по умолчанию false)
	 *
	 * @return bool
	 */
	protected function pUpdateArticles($arrData, $arrArticles, $strWhere = false) {
		$strWhere = (!$strWhere) ? 'id IN (' . implode(',', secure::escQuoteData($arrArticles)) . ')' : $strWhere . ' AND id IN (' . implode(',', secure::escQuoteData($arrArticles)) . ')';

		return $this->editEntrys(secure::escQuoteData($arrData), $strWhere);
	}

	/**
	 * protected функция обновления (редактирования) одной статьи
	 *
	 * @param (array) $arrData - массив данных для обновления (key: name field => val: value field)
	 * @param (int) $id - id статьи для обновления
	 *
	 * @return bool
	 */
	protected function pUpdateArticle(&$arrData, &$id) {
		// обновляем данные статьи и возвращаем результат
		return $this->editEntrys(secure::escQuoteData($arrData), "id IN (" . secure::escQuoteData($id) . ")");
	}

	/**
	 * protected функция помечает статьи как удаленные
	 *
	 * @param (array || false) $arrArticles - массив, содержащий id статей для удаления
	 * @param (string || false) $strWhere -  дополнительное условие запроса (к нему присоединяются $arrArticles).
	 *
	 * @return bool
	 */
	protected function pDeleteArticles($arrArticles, $strWhere) {
		if (empty($arrArticles) && empty($strWhere)) {
			return false;
		}

		$strWhere = (empty($strWhere)) ? 'id IN (' . implode(',', secure::escQuoteData($arrArticles)) . ')' : (!empty($arrArticles) ? $strWhere . ' AND id IN (' . implode(',', secure::escQuoteData($arrArticles)) . ')' : $strWhere);

		return $this->delEntrys($strWhere);
	}

	/**
	 * protected функция помечает статьи как удаленные, на основании id раздела
	 *
	 * @param (array) $id_section - id раздела
	 *
	 * @return bool
	 */
	protected function pDeleteArticlesBySection(&$id_section) {
		$strWhere = "id_section IN (" . secure::escQuoteData($id_section) . ")";
		return $this->delEntrys($strWhere);
	}

	/**
	 * protected функция оцнеки статьи
	 *
	 * @param int $score - оценка статьи
	 * @param int $id - id статьи
	 *
	 * @return echo (печатает результат)
	 */
	protected function pRateArticle(&$score, &$id) {
		// проверяем наличие id статьи в куках пользователя
		// если $flag = true, значит пользователь уже голосовал за статью
		(isset($_COOKIE['artvote']) && $_COOKIE['artvote']) ? ((!in_array($id, explode(':', $_COOKIE['artvote']))) ? $flag = false : $flag = true) : $flag = false;

		if (!$flag) {
			if ($arrData = $this->pGetArticle("id IN (" . secure::escQuoteData($id) . ") AND token IN ('active')")) {
				// проверяем, голосовал ли пользователь за эту статью
				if ($_SERVER['REMOTE_ADDR'] !== $arrData['ip_last']) {
					// вычисляем рейтинг с учетом всех голосов
					// считаем балл, и доавляем его к рейтингу
					$fullRating = ($arrData['rating'] * $arrData['votes']) + ($score * 20);
					// увеличиваем количество голосов
					$votes = (!$arrData['votes']) ? 1 : $arrData['votes'] + 1;
					// высчитываем новый средний рейтинг
					$rating = $fullRating / $votes;

					$this->pUpdateArticles(array('rating' => $rating, 'votes' => $votes, 'ip_last' => $_SERVER['REMOTE_ADDR']), array($id));

					// устанавливаем куку
					(isset($_COOKIE['artvote']) && $_COOKIE['artvote']) ? cookies::setCookieSite('artvote', $_COOKIE['artvote'] . ':' . $id) : cookies::setCookieSite('artvote', $id);

					// выводим результат
					$result = '<div class="rate">'
							. '<div class="rating">' . FORM_ARTICLES_RATING . ': ' . $rating . '</div>'
							. '<div class="base" style="height:16px;"><div class="average" style="width: ' . $rating . '%;">&nbsp;</div></div>'
							. '<div class="votes">' . $votes . ' ' . FORM_ARTICLES_VOTES . '</div>'
							. '</div>'
							. '<div class="status">'
							. '</div>';

					print $result;
				} else {
					print ERROR_ONLY_ONE_VOTING_ARTICLE;
				}
			} else {
				print ERROR_SELECTED_ARTICLE;
			}
		} else {
			print ERROR_ONLY_ONE_VOTING_ARTICLE;
		}
	}

	/////////////////////////////////////////////////
	// END OF CLASS barticles
	/////////////////////////////////////////////////
}

