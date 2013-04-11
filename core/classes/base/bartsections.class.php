<?php

/**
 * JobExpert v1.0
 * Powered by Script Developers Group (SD-Group)
 * Email: info@sd-group.org.ua
 * URL: http://sd-group.org.ua/
 * Copyright 2010-2015 (c) SD-Group
 * All rights reserved
 * ===================================================
 * Базовый Класс работы с разделами статей
 * ===================================================
 *
 * @package
 *
 * @todo
 *
 */
(!defined('SDG')) ? die('Triple protection!') : null;

/**
 * Базовый Класс работы с разделами статей
 */
abstract class bartsections extends tbentrys {

	/////////////////////////////////////////////////
	// VARS - свойства класса bartsections
	/////////////////////////////////////////////////
	/**
	 * $arrServiceFields - свойство для хранения массива сервисных полей в таблицах БД
	 * Массив иницирован наименованиями служебных полей таблицы
	 *
	 * @var array
	 */
	private $arrServiceFields = array(
		'token' => ''
	);

	/////////////////////////////////////////////////
	// CONSTRUCTOR - конструктор класса bartsections
	/////////////////////////////////////////////////

	/**
	 * конструктор
	 *
	 * @return void
	 */
	protected function __construct() {
		$this->setTable('articles_sections');
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
	// METHODS - методы класса bartsections
	/////////////////////////////////////////////////

	/**
	 * private функция передает значения полей полученных из формы в свойсво базового класса, для последующей записи в таблицу БД
	 *
	 * @param array $arrBindFields
	 * @param array $arrNoBindFields
	 *
	 * @return bool
	 */
	private function setSectionSubj($arrBindFields, $arrNoBindFields) {
		$this->arrServiceFields['token'] = 'active';

		return $this->fillTableFieldsValue($this->arrServiceFields + $arrBindFields + $arrNoBindFields);
	}

	/**
	 * protected функция считывает данные из кеша
	 *
	 * @param array or false $arrWhereFieldsVals - массив полей и их значений, в соответствии с которыми необходимо произвести выбоку. Пример: array('affiliation' => array('none', 'competitor')) - ищет все строки, где affiliation='none' OR affiliation='competitor'
	 *
	 * @return array or false
	 */
	protected function pGetCachingSections($arrWhereFieldsVals = false) {
		// проверяем, есть ли кеш
		if ($this->getCachingEntrys()) {
			$arrCategorys = array();

			if (!$arrWhereFieldsVals) {
				if ($arrData = $this->retData()) {
					foreach ($arrData as $value) {
						$arrCategorys[$value['id']] = $value;
					}
				}

				return (!empty($arrCategorys)) ? $arrCategorys : false;
			} else {
				if ($arrData = $this->retData()) {
					foreach ($arrData as $value) {
						if (!is_array($arrWhereFieldsVals)) {
							$arrCategorys[$value['id']] = $value;
						} else {
							foreach ($arrWhereFieldsVals as $field => $arrVals) {
								if (isset($value[$field]) && in_array($value[$field], $arrVals)) {
									$flag = true;
								} else {
									$flag = false;
									break;
								}
							}

							(!isset($flag) || !$flag) ? null : $arrCategorys[$value['id']] = $value;
						}
					}

					return (!empty($arrCategorys)) ? $arrCategorys : false;
				} else {
					return false;
				}
			}
		} else {
			return false;
		}
	}

	/**
	 * protected функция считывает данные из таблицы БД
	 *
	 * @param array or false $arrWhereFieldsVals - массив полей и их значений, в соответствии с которыми необходимо произвести выбоку. Пример: array('affiliation' => array('none', 'competitor')) - ищет все строки, где affiliation='none' OR affiliation='competitor'
	 *
	 * @return array or false
	 */
	protected function pGetSections($arrWhereFieldsVals = false) {
		$order = array('name' => 'ASC');
		$arrCategorys = array();

		// если включено кэширование
		// пытаемся получить данные из кэша
		// если кэша нет, пытаемся получить данные из БД и закэшировать их
		if (CONF_ENABLE_CACHING) {
			if ($this->getCachingEntrys()) {
				return $this->pGetCachingSections($arrWhereFieldsVals);
			} else {
				// если кэш получить не удалось, кешируем все данные таблицы
				// и снова вызываем этот метод
				/*
				  if (!$this -> getEntrys("token='active'", $order, false, false))
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
				  return $this -> pGetSections($arrWhereFieldsVals);
				  }
				  }
				 */
				return (!$this->pGetCategorys()) ? false : $this->pGetSections();
			}
		} else {
			if ($this->pGetCategorys() && $arrData = $this->retData()) {
				foreach ($arrData as $value) {
					$arrCategorys[$value['id']] = $value;
				}
			}

			return (!empty($arrCategorys)) ? $arrCategorys : false;


			// собираем условие из массива полей
			/*
			  if (!$arrWhereFieldsVals)
			  {
			  $strWhere = '';
			  }
			  else
			  {
			  $arrWhere = array();
			  foreach ($arrWhereFieldsVals as $field => $arrVals)
			  {
			  $arrWhere[] = $field . " IN (" . implode(',', secure::escQuoteData($arrVals)) . ")";
			  }
			  $strWhere = ' AND ' . implode(' AND ', $arrWhere);
			  }

			  if ($this -> getEntrys("token='active'" . $strWhere, $order, false, false) && $arrData = $this -> retData())
			  {
			  foreach ($arrData as $value)
			  {
			  $arrCategorys[$value['id']] = $value;
			  }
			  }

			  return (!empty($arrCategorys)) ? $arrCategorys : false;
			 */
		}
	}

	/**
	 * protected функция возвращает параметры раздела по id
	 *
	 * @param integer $id
	 *
	 * @return array or false
	 */
	protected function pGetSectionById(&$id) {
		// если включено кэширование и удалось получить данные из кэша
		// то ищем необходимый раздел
		if (CONF_ENABLE_CACHING && $this->getCachingEntrys() && $arrData = $this->retData()) {
			foreach ($arrData as $value) {
				if ($value['id'] == $id) {
					return $value;
				}
			}

			return false;
		} else {
			return (!$this->getEntry("id IN (" . secure::escQuoteData($id) . ")")) ? false : $this->retDataSubj();
		}
	}

	/**
	 * protected функция производит запись данных в таблицу БД
	 *
	 * @param array $arrBindFields
	 * @param array $arrNoBindFields
	 *
	 * @return bool
	 */
	protected function pRecSection(&$arrBindFields, &$arrNoBindFields) {
		caching::clearCache($this->retTableName());
		return (!$this->setSectionSubj($arrBindFields, $arrNoBindFields) || !$this->addEntry()) ? false : true;
	}

	/**
	 * protected функция обновления данных разделов
	 *
	 * @param (array) $arrData - массив данных для обновления (key: name field => val: value field)
	 * @param (array) $arrID - массив, содержащий id разделов для обновления (id_1, id_2, ..., id_n)
	 *
	 * @return bool
	 */
	protected function pUpdateSections(&$arrData, &$arrID) {
		if ($this->editEntrys(secure::escQuoteData($arrData), 'id IN (' . implode(',', secure::escQuoteData($arrID)) . ')')) {
			caching::clearCache($this->retTableName());
			return true;
		} else {
			return false;
		}
	}

	/**
	 * protected функция помечает разделы и сатьи этих разделов как удаленные
	 *
	 * @param (array) $arrSections - массив, содержащий id разделов для удаления
	 *
	 * @return bool
	 */
	protected function pDeleteSections(&$arrSections) {
		// помечаем статьи разделов как удаленные
		foreach ($arrSections as &$value) {
			$articles = new articles();
			$articles->deleteArticlesBySection($value);
		}

		$strWhere = 'id IN (' . implode(',', secure::escQuoteData($arrSections)) . ')';
		caching::clearCache($this->retTableName());

		return $this->delEntrys($strWhere);
	}

	/**
	 * protected функция разбивает массив разделов на 2 массива:
	 * id - массив, содержит id всех разделов
	 * split - массив, содержит массивы разделов в соответствии с принадлежностью
	 *
	 * @param (array) $arrData - массив всех разделов
	 *
	 * @return array
	 */
	protected function pSplitSections(&$arrData) {
		$arrReturn = array();
		$fieldData = array();
		$fieldType = array();

		// Получаем данные необходимого столбца таблицы
		$strQuery = "SHOW COLUMNS FROM " . DB_PREFIX . $this->retTableName() . " LIKE 'affiliation'";
		db::dbQuery($strQuery);
		if ($fieldData = db::dbGetRow()) {
			if (!empty($fieldData['Type'])) {
				$arrRes = array();
				$strType = preg_replace("/\\)$/is", ",)", $fieldData['Type']);
				preg_match_all("/\\'(.*?)\\',/is", $strType, $arrRes);

				$fieldType = array_fill_keys($arrRes[1], false);
			}
		}

		$arrReturn['split'] = $fieldType;

		foreach ($arrData as &$value) {
			$arrReturn['id'][] = $value['id'];
			$arrReturn['split'][$value['affiliation']][] = $value;
		}

		return $arrReturn;
	}

	/**
	 * protected функция считывает данные из таблицы БД
	 *
	 * @return bool
	 */
	protected function pGetCategorys() {
		if (CONF_ENABLE_CACHING) {
			if ($this->getCachingEntrys()) {
				return true;
			} else {
				// записываем в робота дату обновления кеша
				$articles = new articles();
				$strWhere = "token IN ('active') AND datetime>NOW()";
				$arrFields = array('datetime');
				$arrArticle = $articles->getArticle($strWhere, $arrFields);

				$arrRobotData[$this->retTableName()] = !empty($arrArticle['datetime']) ? strtotime($arrArticle['datetime']) : false;
				robot::putClearCacheData($arrRobotData);

				return (!$this->getSubSelectEntrys(false, true, $this->pRetCategoryConf())) ? false : $this->setCachingEntrys();
			}
		} else {
			return (!$this->getSubSelectEntrys(false, true, $this->pRetCategoryConf())) ? false : true;
		}
	}

	/**
	 * private функция возвращает массив значений
	 *
	 * @return bool
	 */
	private function pRetCategoryConf() {
		$arrConf['extTableFields'] = array(
			array('COUNT(DISTINCT articles.id)', 'count')
		);

		$currTable = $this->retTableName();
		$strOnArticles = "articles.id_section=" . $currTable . ".id AND articles.token IN ('active') AND articles.datetime<=NOW()";

		$arrConf['leftJoins'] = array(
			array(
				'table' => array(DB_PREFIX . 'articles', 'articles'),
				'on' => $strOnArticles
			)
		);

		$arrConf['strWhere'] = $currTable . ".token IN ('active')";

		return $arrConf;
	}

	/////////////////////////////////////////////////
	// END OF CLASS bartsections
	/////////////////////////////////////////////////
}

