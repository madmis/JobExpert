<?php

/**
 * JobExpert v1.0
 * Powered by Script Developers Group (SD-Group)
 * Email: info@sd-group.org.ua
 * URL: http://sd-group.org.ua/
 * Copyright 2010-2015 (c) SD-Group
 * All rights reserved
 * ===================================================
 * Базовый Класс работы с дополнительными страницами
 * ===================================================
 *
 * @package
 *
 * @todo
 *
 */
(!defined('SDG')) ? die('Triple protection!') : null;

/**
 * Базовый Класс работы с дополнительными страницами
 */
abstract class bpages extends tbentrys {
	/////////////////////////////////////////////////
	// VARS - свойства класса bpages
	/////////////////////////////////////////////////
	/////////////////////////////////////////////////
	// CONSTRUCTOR - конструктор класса bpages
	/////////////////////////////////////////////////

	/**
	 * конструктор
	 *
	 * @return void
	 */
	protected function __construct() {
		// устанавливаем имя рабочей таблицы
		$this->setTable('pages');
		// массив (список) файлов кешируемых данных
		$arrCacheFiles = array('caching/pages.cache');
		// формируем массив параметров для вызова конструктора родительского класса
		$arrParams = array(
			'arrCacheFiles' => &$arrCacheFiles
		);

		// вызываем конструктор родительского класса
		parent::__construct($arrParams);
	}

	/////////////////////////////////////////////////
	// METHODS - методы класса bpages
	/////////////////////////////////////////////////

	/**
	 * private функция передает значения полей полученных из формы в свойсво базового класса, для последующей записи в таблицу БД
	 *
	 * @param mixed $arrBindFields
	 * @param mixed $arrNoBindFields
	 *
	 * @return bool
	 */
	private function setPageSubj($arrBindFields, $arrNoBindFields) {
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
	 * Функция проверяет наличие страницы в БД
	 *
	 * @param (string) $strWhere - выражение для оператора WHERE
	 *
	 * @return bool
	 */
	protected function issetPage($strWhere) {
		return $this->issetRow($strWhere);
	}

	/**
	 * функция получает параметры выбранной страницы
	 * и устанавливает их в приватное св-во
	 *
	 * @param (string) $strWhere - условие WHERE для запроса
	 * @param (array) $fields - массив полей для выборки (key: index => val: name field) по умолчанию false
	 *
	 * @return array or bool
	 */
	protected function getPage($strWhere, $fields = false) {
		return ($this->getEntry($strWhere, $fields)) ? $this->retDataSubj() : false;
	}

	/**
	 * функция получает все активные страницы
	 *
	 * @param (array) $fields - массив полей для выборки (key: index => val: name field)
	 *
	 * @return bool
	 */
	protected function getActivePages($felds) {
		$orderBy = array('sort' => 'ASC');

		if (CONF_ENABLE_CACHING) {
			if ($this->getCachingEntrys()) {
				return true;
			} else {
				return (!$this->getEntrys("token IN ('active')", $orderBy, false, $felds, false)) ? false : $this->setCachingEntrys();
			}
		} else {
			return $this->getEntrys("token IN ('active')", $orderBy, false, $felds, false);
		}
	}

	/**
	 * protected функция получает все страницы из таблицы БД
	 *
	 * @return bool
	 */
	protected function getAllPages() {
		return $this->getEntrys("token IN ('active','archived')", array('sort' => 'ASC'), false, false);
	}

	/**
	 * protected функция производит запись данных в таблицу БД
	 *
	 * @param array $arrBindFields - массив полей обязательных для заполнения
	 * @param array $arrNoBindFields - массив полей не обязательных для заполнения
	 *
	 * @return bool
	 */
	protected function recPage($arrBindFields, $arrNoBindFields) {
		if ($this->setPageSubj($arrBindFields, $arrNoBindFields) && $this->addEntry()) {
			return true;
		} else {
			return false;
		}
	}

	/**
	 * функция обновления страниц
	 *
	 * @param array $arrData - массив даных для обновления
	 * @param (array) $arrPages - массив, содержащий id страниц для обновления (id_1, id_2, ..., id_n)
	 *
	 * @return bool
	 */
	protected function updatePages($arrData, $arrPages) {
		if ($this->editEntrys(secure::escQuoteData($arrData), 'id IN (' . implode(',', secure::escQuoteData($arrPages)) . ')')) {
			caching::clearCache($this->retTableName());
			return true;
		} else {
			return false;
		}
	}

	/**
	 * функция помечает страницы как удаленные
	 *
	 * @param (array) $arrPages - массив, содержащий id страниц для удаления
	 *
	 * @return bool
	 */
	protected function deletePages($arrPages) {
		$strWhere = 'id IN (' . implode(',', secure::escQuoteData($arrPages)) . ')';

		return $this->delEntrys($strWhere);
	}

	/////////////////////////////////////////////////
	// END OF CLASS bpages
	/////////////////////////////////////////////////
}
