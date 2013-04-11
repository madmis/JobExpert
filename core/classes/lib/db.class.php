<?php

/**
 * JobExpert v1.0
 * Powered by Script Developers Group (SD-Group)
 * Email: info@sd-group.org.ua
 * URL: http://sd-group.org.ua/
 * Copyright 2010-2015 (c) SD-Group
 * All rights reserved
 * ===================================================
 * Класс для работы с Базой Данных
 * ===================================================
 *
 * @package
 *
 * @todo
 *
 */
(!defined('SDG')) ? die('Triple protection!') : null;

/**
 * Класс работы с Базой Данных
 */
class db {
	/////////////////////////////////////////////////
	// VARS - свойства класса db
	/////////////////////////////////////////////////

	/**
	 * $db_id: свойство для хранения id-соединения с БД
	 *
	 * @var resourse
	 */
	static $db_id;
	/**
	 * $query_id: свойство для хранения id-запроса к таблицам БД
	 *
	 * @var resourse
	 */
	static $query_id;
	/**
	 * $show_error: настройка включающая/отключающая отображение сообщений об ошибках запросов к БД
	 *
	 * @var bool
	 */
	static $show_error;
	/**
	 * $send_error: настройка включающая/отключающая отправку на e-mail сообщений об ошибках запросов к БД
	 *
	 * @var bool
	 */
	static $send_error;
	/**
	 * $log_error: настройка включающая/отключающая логгирование в файл сообщений об ошибках запросов к БД
	 *
	 * @var bool
	 */
	static $log_error;
	/**
	 * $message_error: свойство для хранения сообщений об ощибках в запросах к БД
	 *
	 * @var int
	 */
	static $message_error;
	/**
	 * $cntQuerys: счетчик количества запросов к БД
	 *
	 * @var int
	 */
	static $cntAllQuerys;
	/**
	 * $arrAllQuerys: массив для хранения строк запросов выполняемых к таблицам БД
	 *
	 * @var array
	 */
	static $arrAllQuerys;
	/**
	 * $dbTypeSelect: тип запроса выборки из БД (однострочный - single | многострочный - multi)
	 *
	 * @var string
	 */
	static $dbTypeSelect;
	/**
	 * private $tIdForce: флаг формирования виртуального поля tId для данных (строк) выбоки из таблиц БД
	 * По умолчанию выключен.
	 *
	 * @var bool
	 */
	static $tIdForce;
	/////////////////////////////////////////////////
	// METHODS - методы класса db
	/////////////////////////////////////////////////

	/**
	 * функция иницирует параметры подключения к БД
	 * соединяется с сервером MySQL
	 * подключает БД
	 * устанавливает кодировку по умолчанию
	 * при неудаче сообщает об ошибке и останавливает выполнение скрипта
	 *
	 * @return bool
	 */
	static function _init($db_host = DB_HOST, $db_name = DB_NAME, $db_user = DB_USER, $db_pass = DB_PASS, $db_charset = DB_CHARSET) {
		self::$show_error = SECURE_SQLERR_PRINT;
		self::$send_error = SECURE_SQLERR_SEND_MESS;
		self::$log_error = SECURE_SQLERR_LOG;

		self::$tIdForce = false;

		self::$cntAllQuerys = 0;
		if (!self::$db_id = @mysql_connect($db_host, $db_user, $db_pass)) {
			self::dbLogError(mysql_error(), mysql_errno(), "mysql_connect('" . $db_host . "', '" . $db_user . "', '" . $db_pass . "')", true);
			return false;
		} elseif (!@mysql_select_db($db_name, self::$db_id)) {
			self::dbLogError(mysql_error(), mysql_errno(), "mysql_select_db('" . $db_name . "', '" . self::$db_id . "')", true);
			return false;
		} elseif (function_exists('mysql_set_charset') && !@mysql_set_charset($db_charset, self::$db_id)) {
			self::dbLogError(mysql_error(), mysql_errno(), "mysql_set_charset('" . $db_charset . "', '" . self::$db_id . "')", true);
			return false;
		} elseif (!function_exists('mysql_set_charset') && ($strQuery = "/*!40101 SET NAMES '" . $db_charset . "'*/") && !self::dbQuery($strQuery)) {
			self::dbLogError(mysql_error(), mysql_errno(), $strQuery, true);
			return false;
		} else {
			secure::$link_id = &self::$db_id;
			return true;
		}
	}

	/**
	 * функция выполняет запрос к БД
	 *
	 * @param (string) $strQuery - строка запроса к БД
	 *
	 * @return resource or false
	 */
	static function dbQuery(&$strQuery) {
		if (!self::$db_id) {
			$tmpTypeSelect = self::$dbTypeSelect;
			self::$dbTypeSelect = false;
			$tmp_tIdForce = self::$tIdForce;
			self::$tIdForce = false;
			(!self::_init()) ? die(self::$message_error) : null;
			self::$dbTypeSelect = $tmpTypeSelect;
			self::$tIdForce = $tmp_tIdForce;
			unset($tmpTypeSelect, $tmp_tIdForce);
		}

		self::$arrAllQuerys[++self::$cntAllQuerys] = (!self::$dbTypeSelect) ? array('Query' => $strQuery, 'TypeSelect' => false, 'QuerySelect' => false) : array('Query' => false, 'TypeSelect' => self::$dbTypeSelect, 'QuerySelect' => $strQuery);

		self::$dbTypeSelect = false;

		self::$query_id = @mysql_query($strQuery, self::$db_id);

		(empty(self::$query_id)) ? self::dbLogError(mysql_error(), mysql_errno(), $strQuery) : null;

		return self::$query_id;
	}

	/**
	 * Функция выполняет обработку результата запроса
	 * возвращает результат запроса в виде объекта
	 *
	 * @param (resource) $query_id - ссылка на ресурс с результатом запроса к БД
	 *
	 * @return object результат запроса в виде объекта
	 */
	static function dbFetchObject($query_id = false) {
		(empty($query_id)) ? $query_id = &self::$query_id : null;

		return @mysql_fetch_object($query_id);
	}

	/**
	 * функция выполняет обработку результата запроса
	 * возвращает ассоциативный массив (массив данных) из результата запроса
	 *
	 * @param (resource) $query_id - ссылка на ресурс с результатом запроса к БД
	 *
	 * @return array массив данных: ассоциативный массив
	 */
	static function dbGetRow($query_id = false) {
		(empty($query_id)) ? $query_id = &self::$query_id : null;

		return @mysql_fetch_assoc($query_id);
	}

	/**
	 * функция выполняет обработку результата запроса
	 * возвращает индексный массив (массив данных) из результата запроса
	 *
	 * @param (resource) $query_id - ссылка на ресурс с результатом запроса к БД
	 *
	 * @return array массив данных: индексный массив
	 */
	static function dbFetchRow($query_id = false) {
		(empty($query_id)) ? $query_id = &self::$query_id : null;

		return @mysql_fetch_row($query_id);
	}

	/**
	 * функция производит подсчет строк в результате запроса к БД
	 * возвращает количество строк полученных в результате выполнения запроса
	 *
	 * @param (resource) $query_id - ссылка на ресурс с результатом запроса к БД
	 *
	 * @return int количество строк результата запроса
	 */
	static function dbNumRows($query_id = false) {
		(empty($query_id)) ? $query_id = &self::$query_id : null;

		return (int) @mysql_num_rows($query_id);
	}

	/**
	 * Возвращает количество строк,
	 * которые возвратила бы последняя команда SELECT SQL_CALC_FOUND_ROWS ...
	 * при отсутствии ограничения оператором LIMIT.
	 *
	 * @return int количество строк результата запроса
	 */
	static function dbCalcFoundRows() {
		$strQuery = "SELECT FOUND_ROWS()";

		$rows = self::dbFetchRow(self::dbQuery($strQuery));

		return (int) $rows[0];
	}

	/**
	 * Функция отсылает строку запроса к БД
	 * получает и отправляет на обработку результат запроса
	 * возвращает все строки результата в виде массива объектов
	 *
	 * @param (string) $strQuery - строка запроса к БД
	 *
	 * @return array массив результа в виде объектов
	 */
	static function multiQuery($strQuery) {
		self::dbQuery($strQuery);

		$rows = null;
		while ($row = self::dbFetchObject()) {
			// транслитерация ЧПУ
			if (!empty(self::$tIdForce)) {
				if (defined('CONF_ENABLE_CHPU') && defined('CONF_ENABLE_TRANSLITERATION_CHPU') && CONF_ENABLE_CHPU && CONF_ENABLE_TRANSLITERATION_CHPU) {
					chpu::chpuTranslit($row);
				} else {
					$row->tId = &$row->id;
				}
			}
			(!empty($row->id)) ? $rows[$row->id] = $row : $rows[] = $row;
		}

		// сбрасываем флаг свойства self::$tIdForce
		self::$tIdForce = false;

		return $rows;
	}

	/**
	 * функция отсылает строку запроса к БД
	 * получает и отправляет на обработку результат запроса
	 * возвращает все строки результата в виде массива данных
	 *
	 * @param (string) $strQuery - строка запроса к БД
	 *
	 * @return array массив данных
	 */
	static function dbMultiQuery($strQuery) {
		self::dbQuery($strQuery);

		$rows = null;
		while ($row = self::dbGetRow()) {
			// транслитерация ЧПУ
			if (!empty(self::$tIdForce)) {
				if (defined('CONF_ENABLE_CHPU') && defined('CONF_ENABLE_TRANSLITERATION_CHPU') && CONF_ENABLE_CHPU && CONF_ENABLE_TRANSLITERATION_CHPU) {
					chpu::chpuTranslit($row);
				} else {
					$row['tId'] = &$row['id'];
				}
			}

			(!empty($row['id'])) ? $rows[$row['id']] = $row : $rows[] = $row;
		}

		// сбрасываем флаг свойства self::$tIdForce
		self::$tIdForce = false;

		return $rows;
	}

	/**
	 * функция отсылает строку запроса к БД
	 * получает и отправляет на обработку результат запроса
	 * возвращает одну строку результата в виде объекта
	 *
	 * @param (string) $strQuery - строка запроса к БД
	 *
	 * @return object результата в виде объекта
	 */
	static function singleQuery($strQuery) {
		self::dbQuery($strQuery);

		$row = self::dbFetchObject();

		if (!empty(self::$tIdForce)) {
			if (defined('CONF_ENABLE_CHPU') && defined('CONF_ENABLE_TRANSLITERATION_CHPU') && CONF_ENABLE_CHPU && CONF_ENABLE_TRANSLITERATION_CHPU) {
				chpu::chpuTranslit($row);
			} elseif (count($row)) {
				$row->tId = &$row->id;
			}

			// сбрасываем флаг свойства self::$tIdForce
			self::$tIdForce = false;
		}

		/**
		 * Проверяем значение идентификатора записи tId (ЧПУ с транслитерацией)
		 * Должно совпадать со значением хранимым в глобале $_GET['tId']
		 * Иначе в URL запрошен некорректный адрес страницы - выдаем страницу ошибки HTTP/1.0 404 Not Found
		 */
		if (!empty($_GET['tId']) && !empty($row->tId) && $row->tId != $_GET['tId']) {
			messages::error404();
		}

		return $row;
	}

	/**
	 * функция отсылает строку запроса к БД
	 * получает и отправляет на обработку результат запроса
	 * возвращает одну строку результата в виде массива данных
	 *
	 * @param (string) $strQuery - строка запроса к БД
	 *
	 * @return array массив данных
	 */
	static function dbSingleQuery($strQuery) {
		self::dbQuery($strQuery);

		$row = self::dbGetRow();

		if (!empty(self::$tIdForce)) {
			if (defined('CONF_ENABLE_CHPU') && defined('CONF_ENABLE_TRANSLITERATION_CHPU') && CONF_ENABLE_CHPU && CONF_ENABLE_TRANSLITERATION_CHPU) {
				chpu::chpuTranslit($row);
			} elseif (!empty($row)) {
				$row['tId'] = &$row['id'];
			}

			// сбрасываем флаг свойства self::$tIdForce
			self::$tIdForce = false;
		}
		/**
		 * Проверяем значение идентификатора записи tId (ЧПУ с транслитерацией)
		 * Должно совпадать со значением хранимым в глобале $_GET['tId']
		 * Иначе в URL запрошен некорректный адрес страницы - выдаем страницу ошибки HTTP/1.0 404 Not Found
		 */
		if (!empty($_GET['tId']) && !empty($row['tId']) && $row['tId'] != $_GET['tId']) {
			messages::error404();
		}

		return $row;
	}

	/**
	 * функция производит выборку из таблицы БД по параметрам
	 *
	 * @param (array) $fields - массив полей для выборки (key: index => val: name field)
	 * @param (string) $table - имя таблицы БД
	 * @param (string) $strWhere - выражение для оператора WHERE or false
	 * @param (array) $arrOrderBy - массив параметров сортировки результата выборки (key: field name => val: sort order = ASC | DESC) or false
	 * @param (mixed) $arrLimit - false or массив параметров для оператора LIMIT (key: 'strLimit' => val: string | false of LIMIT for example: '0, 10', key: 'calcRows' => val: true | false)
	 * @param (bool) $cache - признак кеширования результата запроса: true (по умолчанию) | false
	 *
	 * @return array or false
	 */
	static function dbSelectTable($fields, $table, $strWhere, $arrOrderBy, $arrLimit, $cache) {
		$strFields = implode(',', $fields);

		$strWhere = $strWhere ? " WHERE " . $strWhere : '';

		if (!is_array($arrOrderBy)) {
			$strOrderBy = '';
		} else {
			foreach ($arrOrderBy as $fieldName => &$sortOrder) {
				$strOrderBy[] = ('ASC' === $sortOrder || 'DESC' === $sortOrder) ? $fieldName . ' ' . $sortOrder : $fieldName;
				(!empty($cache) && 'RAND()' === $fieldName) ? $cache = false : null;
			}

			$strOrderBy = " ORDER BY " . implode(',', $strOrderBy);
		}

		$strCache = (!$cache) ? '' : 'SQL_CACHE ';

		if (!$arrLimit || !$arrLimit['strLimit']) {
			$strLimit = $strCalcRows = '';
		} elseif (is_array($arrLimit) && !empty($arrLimit) && isset($arrLimit['strLimit']) && is_string($arrLimit['strLimit']) && !empty($arrLimit['strLimit']) && isset($arrLimit['calcRows']) && is_bool($arrLimit['calcRows'])) {
			$strLimit = ' LIMIT ' . $arrLimit['strLimit'];
			$strCalcRows = (!$arrLimit['calcRows']) ? '' : 'SQL_CALC_FOUND_ROWS ';
		} else {
			self::dbLogError(ERROR_DB_LIMIT_QUERY_SELECT, 0, "SELECT " . $strCache . $strFields . " FROM " . $table . $strWhere . $strOrderBy . $arrLimit);
			return false;
		}

		$strQuery = "SELECT " . $strCache . $strCalcRows . $strFields . " FROM " . $table . $strWhere . $strOrderBy . $strLimit;

		switch (self::$dbTypeSelect) {
			case 'multi':
				$resultQuery = self::dbMultiQuery($strQuery);
				break;

			case 'single':
				$resultQuery = self::dbSingleQuery($strQuery);
				break;
			default:
				self::dbLogError(ERROR_DB_TYPE_QUERY_SELECT, 0, $strQuery);
				return false;
		}

		return $resultQuery;
	}

	/**
	 * функция производит выборку (запрос) с подзапросами из таблицы БД по параметрам
	 *
	 * @param array $arrOrderBy - массив параметров сортировки результат запроса
	 * @param array $arrSubSelect - массив параметров подзапроса
	 * @param array $arrSelect - массив параметров запроса
	 *
	 * @return array or false
	 */
	static function dbSubSelectTable($arrOrderBy, $cache, $arrSubSelect, $arrSelect = false) {
		$strSubSelectFields = implode(',', $arrSubSelect['arrFields']);

		$strSubSelectTable = implode(' AS ', $arrSubSelect['arrTable']);

		$strSubSelectLeftJoins = (is_array($arrSubSelect['arrLeftJoins'])) ? implode(' ', $arrSubSelect['arrLeftJoins']) : '';

		$strSubSelectGroupBy = (is_array($arrSubSelect['arrGroupBy'])) ? " GROUP BY " . implode(',', $arrSubSelect['arrGroupBy']) : '';

		$strSubSelectWhere = (isset($arrSubSelect['strWhere'])) ? " WHERE " . $arrSubSelect['strWhere'] : '';

		$strSubSelectLimit = (!empty($arrSubSelect['strLimit'])) ? " LIMIT " . $arrSubSelect['strLimit'] : '';

		$strCache = (!$cache) ? '' : 'SQL_CACHE ';

		$strSelectCalcRows = (empty($arrSubSelect['calcRows'])) ? '' : 'SQL_CALC_FOUND_ROWS ';

		$strSelectQuery = "SELECT " . $strCache . $strSelectCalcRows . $strSubSelectFields . " FROM " . $strSubSelectTable . $strSubSelectLeftJoins . $strSubSelectWhere . $strSubSelectGroupBy;

		if (is_array($arrSelect)) {
			foreach ($arrSelect['arrFields'] as $key => $fieldName) {
				$arrSelect['arrFields'][$key] = $arrSelect['strAlias'] . '.' . $fieldName;
			}

			$strSelectFields = implode(',', $arrSelect['arrFields']);

			$strSelectWhere = (isset($arrSelect['strWhere'])) ? " WHERE " . $arrSelect['strWhere'] : '';

			$strSelectQuery = "SELECT " . $strCache . $strSelectFields . " FROM (" . $strSelectQuery . ") AS " . $arrSelect['strAlias'] . $strSelectWhere;
		}

		if (!is_array($arrOrderBy)) {
			$strOrderBy = '';
		} else {
			foreach ($arrOrderBy as $key => $value) {
				$strOrderBy[] = $key . ' ' . $value;
			}

			$strSelectQuery .= " ORDER BY " . implode(',', $strOrderBy);
		}

		$strSelectQuery .= $strSubSelectLimit;

		switch (self::$dbTypeSelect) {
			case 'multi':
				$resultQuery = self::dbMultiQuery($strSelectQuery);
				break;

			case 'single':
				$resultQuery = self::dbSingleQuery($strSelectQuery);
				break;

			default:
				self::dbLogError(ERROR_DB_TYPE_QUERY_SELECT, 0, $strSubSelectQuery);
				return false;
		}

		return $resultQuery;
	}

	/**
	 * функция вставляет строку в таблицу БД
	 *
	 * @param (string) $table - имя таблицы БД
	 * @param (array) $arrQueryData - массив данных для записи (key: name field => val: value field)
	 *
	 * @return int id-строки or false
	 */
	static function dbInsertTable($table, $arrQueryData, $delayed = false) {
		$delayed = (!empty($delayed)) ? ' DELAYED' : '';

		$strQuery = "INSERT" . $delayed . " INTO " . $table . " (" . implode(',', array_keys($arrQueryData)) . ") VALUES (" . implode(',', $arrQueryData) . ")";

		return (!self::dbQuery($strQuery)) ? false : (($new_id = mysql_insert_id(self::$db_id)) ? $new_id : true);
	}

	/**
	 * функция обновляет строку в таблице БД
	 *
	 * @param (string) $table - имя таблицы БД
	 * @param (array) $arrQueryData - массив данных для обновления (key: name field => val: value field)
	 * @param (string) $strWhere - выражение для оператора WHERE (необязательный параметр)
	 *
	 * @return bool
	 */
	static function dbUpdateTable($table, $arrQueryData, $strWhere = false) {
		foreach ($arrQueryData as $key => $value) {
			$strSet[] = $key . '=' . $value;
		}

		$strQuery = "UPDATE " . $table . " SET " . implode(',', $strSet) . ($strWhere ? " WHERE " . $strWhere : '');

		return (!self::dbQuery($strQuery)) ? false : true;
	}

	/**
	 * функция получает стоки помеченные на удаления в таблице БД
	 * производит проверку на совпадение значений уникальных полей и резервирует строку для обновления данных
	 * если такая строка не найдена - возвращает: false
	 *
	 * @param (string) $table - имя таблицы БД
	 * @param (array) $arrUniFields - массив уникальных полей таблицы БД
	 *
	 * @return int id-строки or false
	 */
	static function dbGetTableFreeId($table, $arrUniFields) {
		if (!is_array($arrUniFields)) {
			db::$dbTypeSelect = 'single';

			$arrLimit = array('strLimit' => '0, 1', 'calcRows' => false);

			$resultQuery = self::dbSelectTable(array('id'), $table, "token IN ('deleted')", false, $arrLimit, false, true);
			if (!empty($resultQuery)) {
				$id = $resultQuery['id'];
				$set = secure::escQuoteData(array('token' => 'reserved'));

				return (!self::dbUpdateTable($table, $set, "id IN ('$id')")) ? false : $id;
			} else {
				return false;
			}
		} else {
			$fields = array_keys($arrUniFields);

			(!in_array('id', $fields)) ? $fields[] = 'id' : null;

			db::$dbTypeSelect = 'multi';

			$resultQuery = self::dbSelectTable($fields, $table, "token IN ('deleted')", false, false, true);
			if (!empty($resultQuery)) {
				foreach ($resultQuery as $key => &$value) {
					foreach ($arrUniFields as &$needle) {
						if (in_array($needle, $value)) {
							$id = &$resultQuery[$key]['id'];
							break 2;
						}
					}
				}

				if (empty($id)) {
					$resultQuery = reset($resultQuery);
					$id = &$resultQuery['id'];
				}

				$set = secure::escQuoteData(array('token' => 'reserved'));

				return (!self::dbUpdateTable($table, $set, "id IN ('$id')")) ? false : $id;
			} else {
				return false;
			}
		}
	}

	/**
	 * функция закрывает соединение с БД
	 *
	 * @return bool
	 */
	static function dbClose() {
		return (!@mysql_close(self::$db_id)) ? false : true;
	}

	/**
	 * функция формирования сообщения, логгирования, отсылки на e-mail: ошибок SQL-запросов к БД
	 *
	 * @param (string) $error - текст сообщения об ошибке SQL-сервера
	 * @param (int) $error_no - номер ошибки SQL-сервера
	 * @param (string) $strQuery - строка запроса в которой возникла ошибка выполнения
	 * @param (bool) $html_page - необязательный параметр, передать true, если необходимо сформировать XHTML-страницу с сообщением об ошибке
	 */
	static function dbLogError($error, $error_no, $strQuery, $html_page = false) {
		$html_page_top = (!$html_page) ? '' : '<!DOCTYPE html>
<html>
<head>
<title>MySQL Fatal Error</title>
<meta charset="utf-8">
<style type="text/css">
<!--
body {
font-family: Verdana, Arial, Helvetica, sans-serif;
font-size: 10px;
font-style: normal;
color: #000000;
}
-->
</style>
</head>
<body>
';
		$html_page_bottom = (!$html_page) ? '' : '</body></html>';

		$sql_error = '<span style="font-size: 16px; font-weight: bold;">MySql Error!</span>
<br>------------------------<br>
<br>
<u>Page:</u>
<br>
<strong>http://' . $_SERVER['SERVER_NAME'] . str_replace('&', '&amp;', $_SERVER['REQUEST_URI']) . '</strong>
<br><br>
<u>IP user:</u>
<br>
<strong>' . $_SERVER['REMOTE_ADDR'] . '</strong>
<br><br>
<u>The Error returned was:</u>
<br>
<strong>' . $error . '</strong>
<br><br>
<u>Error Number:</u>
<br>
<strong>' . $error_no . '</strong>
<br>
<br>
<p style="font-size: 12px; font-weight: bold; color: red; border: 1px solid #000; padding: 10;"><br />&nbsp;&nbsp;&nbsp;' . $strQuery . '<br><br></p>
<br>';

		(!SECURE_SQLERR_PRINT) ? self::$message_error = 'SQL Error!' : ((!$html_page) ? self::$message_error = $sql_error : self::$message_error = $html_page_top . $sql_error . $html_page_bottom);

		if (SECURE_SQLERR_SEND_MESS) {
			$mess = $html_page_top . $sql_error . $html_page_bottom;

			@error_log($mess, 1, SECURE_SQLERR_EMAIL, SECURE_SQLERR_HEADERS);
		}

		if (SECURE_SQLERR_LOG) {
			$mess = "\n" . '=========================' . date('Y-m-d H:i:s') . '================================' . "\n"
					. 'Page: http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'] . "\n"
					. 'IP user: ' . $_SERVER['REMOTE_ADDR'] . "\n"
					. 'The Error returned was: ' . $error . "\n"
					. 'Error Number: ' . $error_no . "\n\n"
					. 'Query: ' . $strQuery . "\n"
					. '============================================================================' . "\n\n";

			@error_log($mess, 3, 'core/data/log/sql_error.log');
		}
	}

	/////////////////////////////////////////////////
	// END OF CLASS db
	/////////////////////////////////////////////////
}
