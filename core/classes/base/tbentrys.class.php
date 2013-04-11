<?php

/**
 * Powered by Script Developers Group (SD-Group)
 * Email: info@sd-group.org.ua
 * URL: http://sd-group.org.ua/
 * Copyright 2009 (c) SD-Group
 * All rights reserved
 * ===================================================
 * Класс работы с записями в таблицах Базы Данных
 * ===================================================
 *
 * @package
 *
 * @todo
 *
 */
(!defined('SDG')) ? die('Triple protection!') : null;

/**
 * Базовый класс работы с записями в таблицах БД
 */
abstract class tbentrys {
	/////////////////////////////////////////////////
	// VARS - свойства класса tbentrys
	/////////////////////////////////////////////////

	/**
	 * private $tbPrefix: префикс имени таблицы БД
	 *
	 * @var string
	 */
	private $tbPrefix;

	/**
	 * private $tbPostfix: постфикс имени таблицы БД
	 *
	 * @var string
	 */
	private $tbPostfix;

	/**
	 * private $tbTableStructure: свойство хранит данные структуры таблицы в БД
	 *
	 * @var array
	 */
	private $tbTableStructure;

	/**
	 * private $tbData: свойство хранит служебные данные
	 *
	 * @var array
	 */
	private $tbData;

	/**
	 * private $arrTableFields: свойство для хранения полей таблицы
	 * инициируется в методе protected initTableFields()
	 *
	 * @var array
	 */
	private $arrTableFields;

	/**
	 * private $arrTableUniFields: свойство для хранения уникальных полей таблицы
	 * инициируется в методе protected initTableFields()
	 *
	 * @var array
	 */
	private $arrTableUniFields;

	/**
	 * private $arrCacheFiles: свойство хранит список файлов кешируемых данных
	 * Инициируется в дочерних классах, путем передачи в массиве параметров объекта конструктору
	 *
	 * @var array
	 */
	private $arrCacheFiles;

	/**
	 * private $tIdForce: флаг формирования виртуального поля tId для данных (строк) выборки из таблиц БД
	 * По умолчанию выключен.
	 * Включается в дочерних классах.
	 *
	 * @var bool
	 */
	private $tIdForce;

	/////////////////////////////////////////////////
	// CONSTRUCTOR - конструктор класса tbentrys
	/////////////////////////////////////////////////

	/**
	 * конструктор
	 *
	 * @param (array) $arrParams - индексный массив параметров объекта
	 *
	 */
	protected function __construct(&$arrParams = false) {
		$this->setPropertys($arrParams);
	}

	/////////////////////////////////////////////////
	// METHODS - методы класса tbentrys
	/////////////////////////////////////////////////

	/**
	 * protected функция переопределяет рабочую таблицу
	 *
	 * @param (string) $postfix - имя таблицы (без префикса)
	 * @param (string) $prefix  - префикс таблицы (по умолчанию DB_PREFIX) - необязательный
	 *
	 * @return void
	 */
	protected function setTable($postfix, $prefix = false) {
		$this->tbPostfix = $postfix;
		$this->tbPrefix = (!$prefix) ? DB_PREFIX : $prefix;

		return true;
	}

	/**
	 * protected функция меняет рабочую таблицу
	 *
	 * return void
	 */
	protected function changeTable($postfix, $prefix = false) {
		$this->setTable($postfix, $prefix);
		$this->arrTableFields = $this->arrTableUniFields = $this->tbTableStructure = null;

		return true;
	}

	/**
	 * protected функция возвращает имя текущей таблицы
	 *
	 * @return (string) $this -> tbPostfix - имя таблицы (без префикса) or false
	 */
	protected function retTableName() {
		return (!$this->tbPostfix) ? false : $this->tbPostfix;
	}

	/**
	 * protected функция возвращает префикс текущей таблицы
	 *
	 * @return (string) $this -> tbPrefix - префикс таблицы (без имени) or false
	 */
	protected function retTablePrefix() {
		return (!$this->tbPrefix) ? false : $this->tbPrefix;
	}

	/**
	 * protected функция возвращает текущее значение id строки в таблице БД
	 * свойство: $arrTableFields['id']
	 *
	 * @return int or string текущее значение id строки в таблице БД
	 */
	protected function getLine_id() {
		return (!isset($this->arrTableFields['id'])) ? false : $this->arrTableFields['id'];
	}

	/**
	 * protected функция инициирует массивы свойств $arrTableFields и $arrTableUniFields
	 *
	 * return bool
	 */
	protected function initTableFields() {
		if (!$this->arrTableFields || !is_array($this->arrTableFields)) {
			return $this->tbGetFieldList();
		} else {
			$this->arrTableFields = array_fill_keys($this->retTableFieldsName(), '');
			(is_array($this->arrTableUniFields)) ? $this->arrTableUniFields = array_fill_keys($this->retTableUniFieldsName(), '') : null;
		}

		return true;
	}

	/**
	 * protected функция возвращает наименования полей таблицы БД (ключи массива), хранящиеся в свойстве $arrTableFields
	 *
	 * return (array) индексный массив ключей свойства $arrTableFields
	 */
	protected function retTableFieldsName() {
		return (!$this->arrTableFields || !is_array($this->arrTableFields)) ? false : array_keys($this->arrTableFields);
	}

	/**
	 * protected функция возвращает наименования полей таблицы БД (ключи массива), хранящиеся в свойстве $arrTableUniFields
	 *
	 * return (array) индексный массив ключей свойства $arrTableUniFields
	 */
	protected function retTableUniFieldsName() {
		return (!$this->arrTableUniFields || !is_array($this->arrTableUniFields)) ? false : array_keys($this->arrTableUniFields);
	}

	/**
	 * protected сохраняет данные в свойстве $tdData
	 *
	 * return void
	 */
	protected function setData(&$arrData) {
		$this->tbData = &$arrData;
	}

	/**
	 * protected функция возвращает массив хранящийся в свойстве $tdData
	 *
	 * return (array) $tbData
	 */
	protected function retData() {
		return (!$this->tbData || !is_array($this->tbData)) ? false : $this->tbData;
	}

	/**
	 * protected функция возвращает массив хранящийся в свойстве $arrTableFields
	 *
	 * return (array) $arrTableFields
	 */
	protected function retDataSubj() {
		return (!$this->arrTableFields || !is_array($this->arrTableFields)) ? false : $this->arrTableFields;
	}

	/**
	 * protected функция проверяет свойство $arrTableFields на пустоту
	 *
	 * return bool
	 */
	protected function dataSubjNoEmpty() {
		return (is_array($this->arrTableFields) && !empty($this->arrTableFields)) ? true : false;
	}

	/**
	 * protected функция возвращает данные из указанных полей хранящиеся в свойстве $arrTableFields
	 *
	 * return (array) массив выбранных данных or false
	 */
	protected function retDataFields($arrFields) {
		if (is_array($this->arrTableFields) && !empty($this->arrTableFields) && !empty($arrFields)) {
			(!is_array($arrFields)) ? $arrFields = array($arrFields) : null;

			return array_intersect_key($this->arrTableFields, array_flip($arrFields));
		} else {
			return false;
		}
	}

	/**
	 * protected функция устанавливает значения переданного массива в свойства $arrTableFields и $arrTableUniFields
	 *
	 * @param (array) $arrData(key = field name => value = field value)
	 *
	 * return bool
	 */
	protected function fillTableFieldsValue($arrData) {
		if (!empty($arrData) && is_array($arrData) && $this->checkKeyFieldsName($arrData)) {
			foreach ($arrData as $key => $value) {
				$this->arrTableFields[$key] = $value;
			}

			(!$this->arrTableUniFields) ? null : $this->arrTableUniFields = array_intersect_key($this->arrTableFields, $this->arrTableUniFields);

			return true;
		} else {
			return false;
		}
	}

	/**
	 * protected функция считывает из таблицы БД строку
	 * результат запроса сохраняется в свойство arrTableFields
	 *
	 * @param (string) $strWhere - условие WHERE для запроса or false
	 * @param (array) $fields - массив полей для выборки (key: index => val: name field)
	 *
	 * @return bool
	 */
	protected function getEntry($strWhere, $fields = false) {
		$table = $this->tbPrefix . $this->tbPostfix;

		$fields = (empty($fields) || !is_array($fields)) ? array("*") : $fields;

		$arrLimit = array('strLimit' => '0, 1', 'calcRows' => false);

		db::$tIdForce = $this->tIdForce;
		db::$dbTypeSelect = 'single';

		return (!$this->arrTableFields = db::dbSelectTable($fields, $table, $strWhere, false, $arrLimit, true)) ? false : true;
	}

	/**
	 * protected функция считывает из таблицы БД строки, в соответствии с полученными параметрами
	 * возвращает массив с данными: результат запроса
	 *
	 * @param (string) $strWhere - условие WHERE для запроса or false
	 * @param (array) $arrOrderBy - массив параметров сортировки результата выборки (key: name field => val: ASC | DESC) or false
	 * @param (mixed) $arrLimit - false or массив параметров для оператора LIMIT (key: 'strLimit' => val: string of LIMIT for example: '0, 10', key: 'calcRows' => val: true | false)
	 * @param (array) $arrFields - массив полей для выборки (key: index => val: name field)
	 *
	 * @return bool
	 */
	protected function getEntrys($strWhere, $arrOrderBy, $arrLimit, $arrFields, $cache = true) {
		$table = $this->tbPrefix . $this->tbPostfix;

		$arrFields = (!empty($arrFields) && is_array($arrFields)) ? $arrFields : array("*");

		db::$tIdForce = $this->tIdForce;
		db::$dbTypeSelect = 'multi';

		return (!$this->tbData = db::dbSelectTable($arrFields, $table, $strWhere, $arrOrderBy, $arrLimit, $cache)) ? false : true;
	}

	/**
	 * protected функция считывает из таблицы БД строку, используя подзапрос, в соответствии с полученными параметрами
	 *
	 * @param array $subSelect - параметры подзапроса
	 * @param array $select - параметры запроса
	 *
	 * @return bool
	 */
	protected function getSubSelectEntry($subSelect, $select = false) {
		db::$tIdForce = $this->tIdForce;
		db::$dbTypeSelect = 'single';

		return (!$this->tbData = db::dbSubSelectTable(false, false, $this->retSubSelectConf($subSelect), $select)) ? false : true;
	}

	/**
	 * protected функция считывает из таблицы БД строки, используя подзапрос, в соответствии с полученными параметрами
	 *
	 * @param array $subSelect - параметры подзапроса
	 * @param array $select - параметры запроса
	 *
	 * @return bool
	 */
	protected function getSubSelectEntrys($arrOrderBy, $cache, $subSelect, $select = false) {
		db::$tIdForce = $this->tIdForce;
		db::$dbTypeSelect = 'multi';

		return (!$this->tbData = db::dbSubSelectTable($arrOrderBy, $cache, $this->retSubSelectConf($subSelect), $select)) ? false : true;
	}

	/**
	 * protected функция считывает данные из кэша
	 *
	 * @return bool
	 */
	protected function getCachingEntrys() {
		return (!$this->tbData = caching::getCahing('caching/' . $this->retTableName() . '.cache')) ? false : true;
	}

	/**
	 * protected функция считывает данные из кэша
	 *
	 * @return bool
	 */
	protected function setCachingEntrys() {
		return (!caching::setCaching('caching/' . $this->retTableName() . '.cache', $this->tbData)) ? false : true;
	}

	/**
	 * protected функция подсчитывает в таблице БД количество строк в соответствии с условием $strWhere
	 * возвращает количество строк результата запроса
	 *
	 * @param (string) $strWhere - условие WHERE для запроса or false
	 *
	 * @return int количество строк результата запроса
	 */
	protected function cntEntrys($strWhere) {
		$table = $this->tbPrefix . $this->tbPostfix;

		db::$dbTypeSelect = 'single';

		return (!$arrData = db::dbSelectTable(array("COUNT(*) as num_rows"), $table, $strWhere, false, false, true)) ? 0 : (int) $arrData['num_rows'];
	}

	/**
	 * protected функция Возвращает количество строк,
	 * которые возвратила бы последняя команда SELECT SQL_CALC_FOUND_ROWS ...
	 * при отсутствии ограничения оператором LIMIT
	 *
	 * @return int количество строк результата запроса
	 */
	protected function calcFoundRows() {
		return db::dbCalcFoundRows();
	}

	/**
	 * protected функция проверяет наличие в таблице строки с указанным ID
	 *
	 * @param (string) $strWhere - выражение для оператора WHERE (необязательный параметр)
	 *
	 * @return bool
	 */
	protected function issetRow($strWhere = false) {
		$table = $this->tbPrefix . $this->tbPostfix;

		db::$dbTypeSelect = 'single';

		$arrLimit = array('strLimit' => '0, 1', 'calcRows' => false);

		return (!db::dbSelectTable(array("id"), $table, $strWhere, false, $arrLimit, true)) ? false : true;
	}

	/**
	 * protected функция добавляет/обновляет строку в таблице БД, используя данные из свойства $arrTableFields
	 * проводит поиск строки помеченной на удаление и обновляет её,
	 * если такой строки нет, то в таблицу добавляется новая запись
	 *
	 * @return bool
	 */
	protected function addEntry() {
		$table = $this->tbPrefix . $this->tbPostfix;

		$this->setDefaultForEmpty();

		if (false !== ($id = db::dbGetTableFreeId($table, $this->arrTableUniFields))) {
			if (db::dbUpdateTable($table, secure::escQuoteData($this->arrTableFields), "id IN ('$id')")) {
				if (empty($this->arrTableFields['id'])) {
					$this->arrTableFields['id'] = $id;
				}

				$this->clearCache();

				return true;
			} else {
				db::dbUpdateTable($table, array('token' => "'deleted'"), "id IN ('$id')");

				$this->clearCache();

				return false;
			}
		} else {
			if (is_int($result = db::dbInsertTable($table, secure::escQuoteData($this->arrTableFields)))) {
				$this->arrTableFields['id'] = $result;
			}

			$this->clearCache();

			return (!$result) ? false : true;
		}
	}

	/**
	 * protected функция добавляет/обновляет строку в таблице БД, используя данные из свойства $arrTableFields
	 * проводит поиск строки помеченной на удаление и обновляет её,
	 * если такой строки нет, то в таблицу добавляется новая запись
	 *
	 * @return bool
	 */
	protected function addEntrys($arrData) {
		$table = $this->tbPrefix . $this->tbPostfix;

		$this->clearCache();

		foreach ($arrData as &$data) {
			if (!db::dbInsertTable($table, secure::escQuoteData($data))) {
				return false;
			}
		}

		return true;
	}

	/**
	 * protected функция обновляет строку в таблице БД, используя данные из свойства $arrTableFields
	 *
	 * @return bool
	 */
	protected function editEntry() {
		$table = $this->tbPrefix . $this->tbPostfix;

		$this->setDefaultForEmpty();

		$id = &$this->arrTableFields['id'];

		unset($this->arrTableFields['id'], $this->arrTableFields['tId']);

		$result = db::dbUpdateTable($table, secure::escQuoteData($this->arrTableFields), "id IN ('" . $id . "')");

		$this->arrTableFields['id'] = &$id;

		return $result;
	}

	/**
	 * protected функция обновляет строки в таблице БД
	 *
	 * @param (array) $arrData - массив данных для обновления (key: name field => val: value field)
	 * @param (string) $strWhere - выражение для оператора WHERE (необязательный параметр)
	 *
	 * @return bool
	 */
	protected function editEntrys($arrData, $strWhere = false) {
		if (!$this->checkKeyFieldsName($arrData)) {
			return false;
		}

		$this->clearCache();

		$table = $this->tbPrefix . $this->tbPostfix;

		return db::dbUpdateTable($table, $arrData, $strWhere);
	}

	/**
	 * protected функция обновляет строки в таблице БД без удаления кеша
	 * NCC - Not Clean Cache - Не очищать кеш
	 *
	 * @param (array) $arrData - массив данных для обновления (key: name field => val: value field)
	 * @param (string) $strWhere - выражение для оператора WHERE (необязательный параметр)
	 *
	 * @return bool
	 */
	protected function editEntrysNCC($arrData, $strWhere = false) {
		if (!$this->checkKeyFieldsName($arrData)) {
			return false;
		}

		$table = $this->tbPrefix . $this->tbPostfix;

		return db::dbUpdateTable($table, $arrData, $strWhere);
	}

	/**
	 * protected функция помечает строки в таблице БД на удаление по условию WHERE
	 *
	 * @param (string) $strWhere - выражение для оператора WHERE (необязательный параметр)
	 *
	 * @return bool
	 */
	protected function delEntrys($strWhere = false) {
		$table = $this->tbPrefix . $this->tbPostfix;

		$set = array('token' => "'deleted'");

		$this->clearCache();

		return db::dbUpdateTable($table, $set, $strWhere);
	}

	/**
	 * private функция получает список полей таблицы
	 * записывает данные в свойства $arrTableFields и $arrTableUniFields
	 * @return bool
	 */
	private function tbGetFieldList() {
		(!$this->tbTableStructure) ? $this->tbReadFieldList() : null;

		if ($arrData = $this->tbTableStructure) {
			$this->arrTableFields = $this->arrTableUniFields = null;

			foreach ($arrData as $value) {
				(!$value['Extra']) ? $this->arrTableFields[$value['Field']] = '' : null;

				('UNI' === $value['Key']) ? $this->arrTableUniFields[$value['Field']] = '' : null;
			}

			return true;
		} else {
			return false;
		}
	}

	/**
	 * private функция считывает данные структуры таблицы БД
	 *
	 * @return bool
	 */
	private function tbReadFieldList() {
		$strQuery = "SHOW COLUMNS FROM " . $this->tbPrefix . $this->tbPostfix;

		if (CONF_ENABLE_CACHING) {
			if ($this->tbTableStructure = caching::getCahing('caching/' . $this->tbPrefix . $this->tbPostfix . '.tsc')) {
				return true;
			} else {
				db::$dbTypeSelect = 'multi';
				return (!$this->tbTableStructure = db::dbMultiQuery($strQuery)) ? false : caching::setCaching('caching/' . $this->tbPrefix . $this->tbPostfix . '.tsc', $this->tbTableStructure);
			}
		} else {
			db::$dbTypeSelect = 'multi';
			return (!$this->tbTableStructure = db::dbMultiQuery($strQuery)) ? false : true;
		}
	}

	/**
	 * private функция проверяет соответствие ключей переданного массива с массивом $arrTableFields
	 * Если ключи идентичны, возвращает true | иначе false
	 *
	 * return true or trigger_error()
	 */
	private function checkKeyFieldsName(&$arrData, $recursion = false) {
		if (!empty($arrData['tId'])) {
			unset($arrData['tId']);
		}

		(!$this->arrTableFields || !is_array($this->arrTableFields)) ? $this->initTableFields() : null;

		if (!$arrDiffKyes = array_diff_key($arrData, $this->arrTableFields)) {
			return true;
		} elseif (!$recursion) {
			$this->clearCache();
			$this->arrTableFields = $this->tbTableStructure = null;
			return $this->checkKeyFieldsName($arrData, true);
		} else {
			trigger_error(ERROR_MISMATCH_FIELDS . ' <b>' . implode(', ', array_flip($arrDiffKyes)) . '</b>', E_USER_ERROR);
		}
	}

	/**
	 * private функция устанавливает значения поумочанию, для пустых полей записываемых в таблицу БД.
	 *
	 * return void
	 */
	private function setDefaultForEmpty() {
		(empty($this->tbTableStructure)) ? $this->tbReadFieldList() : null;

		foreach ($this->arrTableFields as $key => &$value) {
			if (empty($value)) {
				foreach ($this->tbTableStructure as &$tsValue) {
					if ($tsValue['Field'] === $key) {
						$this->arrTableFields[$key] = &$tsValue['Default'];
						break;
					}
				}
			}
		}

		(!$this->arrTableUniFields) ? null : $this->arrTableUniFields = array_intersect_key($this->arrTableFields, $this->arrTableUniFields);
	}

	/**
	 * private функция - парсер массива параметров запроса для методов getSubSelectEntry и getSubSelectEntrys
	 *
	 * @param array $subSelect - массив параметров подзапроса:
	 * @param array $subSelect['tableFields'] - индексный массив наименований полей для выборки (если параметр не передан, выбираются все поля таблицы)
	 * @param array $subSelect['extTableFields'] - массив дополнительных полей для выборки [пример: array(array('COUNT(DISTINCT vacancy.id)', 'cnt_vacancy'));]
	 *
	 * @return array сформированный массив для запроса к БД
	 */
	private function retSubSelectConf(&$subSelect) {
		if (isset($subSelect['tableFields']) && is_array($subSelect['tableFields'])) {
			foreach ($subSelect['tableFields'] as $tableFields) {
				$arrSubSelectFields[] = implode('.', $tableFields);
			}
		} else {
			$arrSubSelectFields = array($this->tbPostfix . ".*");
		}

		if (isset($subSelect['extTableFields']) && is_array($subSelect['extTableFields'])) {
			foreach ($subSelect['extTableFields'] as $extTableFields) {
				$arrSubSelectFields[] = implode(' AS ', $extTableFields);
			}
		}

		$arrSubSelectTable = array($this->tbPrefix . $this->tbPostfix, $this->tbPostfix);

		if (isset($subSelect['leftJoins']) && is_array($subSelect['leftJoins'])) {
			foreach ($subSelect['leftJoins'] as $leftJoins) {
				$arrSubSelectLeftJoins[] = " LEFT JOIN " . implode(' AS ', $leftJoins['table']) . " ON " . $leftJoins['on'];
			}
		} else {
			$arrSubSelectLeftJoins = false;
		}

		if (isset($subSelect['fieldsGroupBy']) && is_array($subSelect['fieldsGroupBy'])) {
			foreach ($subSelect['fieldsGroupBy'] as $fieldsGroupBy) {
				$arrSubSelectFields[] = implode('.', $fieldsGroupBy);
			}
		} else {
			$arrSubSelectGroupBy = array($this->tbPostfix . ".id");
		}

		return array(
			'arrFields' => $arrSubSelectFields,
			'arrTable' => $arrSubSelectTable,
			'arrLeftJoins' => $arrSubSelectLeftJoins,
			'arrGroupBy' => $arrSubSelectGroupBy,
			'calcRows' => (!empty($subSelect['calcRows']) ? $subSelect['calcRows'] : false),
			'strLimit' => (!empty($subSelect['strLimit']) ? $subSelect['strLimit'] : false),
			'strWhere' => $subSelect['strWhere']
		);
	}

	/**
	 * private функция - очищает данные хранящиеся кеш-файлах
	 *
	 * @return void
	 */
	private function clearCache() {
		if (is_array($this->arrCacheFiles)) {
			foreach ($this->arrCacheFiles as &$fileName) {
				@unlink($fileName);
			}
		}

		return;
	}

	/**
	 * private функция - обрабатывает параметры, инициирует свойства объекта
	 *
	 * @return void
	 */
	private function setPropertys(&$arrParams) {
		if (is_array($arrParams) && !empty($arrParams)) {
			foreach (array_keys($arrParams) as $property) {
				switch ($property) {
					case 'arrCacheFiles':
						if (!empty($arrParams[$property]) && is_array($arrParams[$property])) {
							$this->arrCacheFiles = &$arrParams[$property];
						} else {
							$this->arrCacheFiles = false;
						}

						break;

					case 'tIdForce':
						if (!empty($arrParams[$property]) && is_bool($arrParams[$property])) {
							$this->tIdForce = &$arrParams[$property];
						} else {
							$this->tIdForce = false;
						}

						break;

					default: break;
				}
			}
		}
	}

	/////////////////////////////////////////////////
	// END OF CLASS tbentrys
	/////////////////////////////////////////////////
}
