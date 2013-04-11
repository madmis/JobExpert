<?php

/**
 * JobExpert v1.0
 * powered by Script Developers Group (SD-Group)
 * email: info@sd-group.org.ua
 * url: http://sd-group.org.ua/
 * Copyright 2010-2015 (c) SD-Group
 * All rights reserved
 * =========================================================
 * Базовый Класс работы с модами
 * =========================================================
 */
(!defined('SDG')) ? die('Triple protection!') : null;

/**
 * 11.05.2012
 * @author Dimon
 * Сделано хранение модов в БД.
 * Данная доработка сделана в связи с тем, что моды в файле выключались автоматически.
 * Причины такого поведения так и не были обнаружены и я решил перенести хранение модов 
 * в таблицу БД.
 * Ситуация следующая.
 * Проверяется наличие файла модов. Если файл существует, моды берутся из этого файла.
 * Если файла не существует, работаем с таблицей БД.
 */
abstract class bmods extends tbentrys {
	/////////////////////////////////////////////////
	// VARS - свойства класса bmods
	/////////////////////////////////////////////////

	/**
	 * $modsPath: путь к модам
	 * @var string
	 */
	private $modsPath = 'core/mods/';

	/**
	 * $dbFile: путь к файлу БД модов
	 * @var string
	 */
	public $dbFile = 'core/mods/mods.mda';

	/////////////////////////////////////////////////
	// CONSTRUCTOR - конструктор класса bmods
	/////////////////////////////////////////////////
	/**
	 * конструктор
	 * @return void
	 */
	protected function __construct() {
		$this->setTable('mods');
		//$this->checkMDAFile();
	}

	/////////////////////////////////////////////////
	// METHODS - методы класса bmods
	/////////////////////////////////////////////////

	/**
	 * Ф-я берет все каталоги модов и добавляет их
	 * в базу данных (те, что уже есть в БД, не обновляются)
	 */
	public function addAllModsToDb() {
		if (@file_exists($this->dbFile)) {
			return $this->checkMDAFile();
		} else {
			$dbMods = $this->getMods();
			$dirMods = $this->getModsList();
			if (empty($dirMods)) {
				return false;
			}

			foreach($dirMods as $value) {
				if (!isset($dbMods[$value])) {
					$this->pRecRecord($this->fillModProperties($value));
				}
			}
			return true;
		}
	}


	/**
	 * метод проверят файл БД на наличие в нем всех модов
	 * если каких-либо модов не хватает, метод дописывает их
	 * @return boolean
	 */
	protected function checkMDAFile() {
		// проверяем, существует ли файл БД
		if (@file_exists($this->dbFile)) {
			// Считываем данные из файла БД
			$dbData = filesys::getSerializedData($this->dbFile);
			// получаем список существующих модов
			if ($arrMods = $this->getModsList()) {
				// Проверяем, чтобы в массиве были все необходимые ключи
				// если ключей не хватает, дописываем их
				foreach ($arrMods as $value) {
					// формируем массив данных о модах
					(empty($dbData[$value])) ? $dbData[$value] = $this->fillModProperties($value) : null;
				}
			} else {
				// если моды не найдены, записваем пустой массив
				$dbData = array();
			}

			// сохраняем файл БД.
			return filesys::putSerializedData($this->dbFile, $dbData);
		} else {
			// Если файл БД не существует
			// создаем его и записываем в него необходимые значения

			$dbData = array();
			// получаем список существующих модов
			if ($arrMods = $this->getModsList()) {
				foreach ($arrMods as $value) {
					// формируем массив данных о модах
					$dbData[$value] = $this->fillModProperties($value);
				}
			}

			return filesys::putSerializedData($this->dbFile, $dbData);
		}
	}

	/**
	 * метод проверят наличие обязательных файлов мода
	 * @param (string) $modName - имя мода (соответствует названию папки мода)
	 * @return bool
	 */
	protected function checkModRequiredFiles($modName) {
		return ('payments' !== $modName && @file_exists($this->modsPath . $modName . '/adm.mods.' . $modName . '.php')) ? true : false;
	}

	/**
	 * метод получает список существующих модов
	 * (каталоги из каталога mods)
	 * мод "payments" в массив не попадает
	 * @return array
	 */
	protected function getModsList() {
		// получаем список существующих модов
		$arrMods = filesys::getChildDirs($this->modsPath);

		// удалем мод "payments" из массива
		if (($key = array_search('payments', $arrMods)) !== false) {
			unset($arrMods[$key]);
		}

		return $arrMods;
	}

	/**
	 * метод заполняет массив свойств мода
	 * token мода всегда disabled в этом методе
	 * @param (string) $modName - имя мода (соответствует названию папки мода)
	 * @return array
	 */
	protected function fillModProperties($modName) {
		$descrPath = $this->modsPath . $modName . '/lang/' . CONF_LANGUAGE . '/description.txt';
		$modProperties = array(
			'name' => $modName,
			'description' => (@file_exists($descrPath)) ? file_get_contents($descrPath) : '',
			'token' => 'disabled'
		);

		return $modProperties;
	}

	/**
	 * метод получает список существующих модов из файла БД,
	 * если файла не существует, данные модов берутся из таблицы БД
	 * @return array
	 */
	protected function getMods() {
		if (@file_exists($this->dbFile)) {
			return filesys::getSerializedData($this->dbFile);
		} else {
			// Работаем с БД
			$arrMods = array();
			$arrRecords = $this->pGetRecords("token IN ('active','disabled')", array('name' => 'ASC'), false, false);
			if (!empty($arrRecords) && is_array($arrRecords)) {
				// Это необходимо, чтобы массив соответствовал массиву,
				// который мы получаем из файла.
				// в данном случае, в качестве ключа используется имя мода
				foreach ($arrRecords as $value) {
					$arrMods[$value['name']] = $value;
				}
			}
			return $arrMods;
		}
	}

	/**
	 * функция включает/выключает выбранные моды
	 * @param (array) $arrMods - массив, содержащий id модов для включения/выключения
	 * @param (bool) $flag - флаг (true|false) определяющий, включить (true) или выключить (false) мод. По умолчанию true.
	 * @return bool
	 */
	protected function enableMods($arrMods, $flag = true) {
		if (empty($arrMods)) {
			return false;
		}

		$token = ($flag) ? 'active' : 'disabled';
		// получаем список модов
		$dbData = $this->getMods();

		if (@file_exists($this->dbFile)) {
			// устанавливаем необходимые токены
			foreach ($arrMods as $value) {
				$dbData[$value]['token'] = $token;
			}

			return filesys::putSerializedData($this->dbFile, $dbData);
		} else {
			$strWhere = 'name IN (' . implode(',', secure::escQuoteData($arrMods)) . ')';
			return $this->pUpdateRecords(array('token'=>$token), $strWhere);
		}
	}

	/**
	 * функция удаления выбранных модов
	 * @param (array) $arrMods - массив, содержащий id модов для удаления
	 * @return bool
	 * @deprecated не использовать эту фукнкцию, она устарела. 
	 * Для удаления мода нужно писать новую ф-ю
	 */
	protected function deleteMods($arrMods) {
		if (empty($arrMods)) {
			return false;
		}
		// получаем список модов из файла БД
		$dbData = $this->getMods();

		// устанавливаем необходимые токены
		foreach ($arrMods as $value) {
			unset($dbData[$value]);
			filesys::removeDir($this->modsPath . $value);
		}

		return filesys::putSerializedData($this->dbFile, $dbData);
	}

	/**
	 * Метод переключает работу с модами через БД.
	 * Файл хранения модов удаляется. 
	 * Вся информация из него запысывается в БД.
	 * Если файла модов нет, ничего не выполняется.
	 */
	public function modsDbEnable() {
		if (@file_exists($this->dbFile)) {
			// Удаляем все из таблицы модов
			$this->pUpdateRecords(array('token'=>'deleted'));
			// в цикле перебираем все моды из файла и записываем их в БД
			$mods = $this->getMods();
			if (!empty($mods) && is_array($mods)) {
				foreach($mods as $value) {
					// при обновлении job.znaydemo почемуто мод добавился 
					// с пустым токеном. Предположительно, в файле хранился токен,
					// которого нет в БД
					// поэтому добавлена эта проверка
					$t = array('active','disabled');
					if (!isset($value['token']) || !in_array($value['token'], $t)) {
						$value['token'] = 'disabled';
					}

					$this->pRecRecord($value);
				}
			}

			filesys::removeFile($this->dbFile);
		}
	}

	/////////////////////////////////////////////////
	// NEW - DB
	/////////////////////////////////////////////////
	/**
	 * Функция проверяет наличие записи в БД
	 * @param (string) $strWhere - выражение для оператора WHERE
	 * @return boolean
	 */
	protected function pIssetRecord($strWhere) {
		return $this->issetRow($strWhere);
	}

	/**
	 * функция получает запись из БД
	 * @param (string) $strWhere - условие WHERE для запроса
	 * @param (array) $fields - массив полей для выборки (key: index => val: name field) по умолчанию false
	 * @return array or boolean
	 */
	protected function pGetRecord($strWhere, $fields = false) {
		return ($this->getEntry($strWhere, $fields)) ? $this->retDataSubj() : false;
	}

	/**
	 * функция получает записи из БД
	 * @param (string) $strWhere - условие WHERE для запроса or false (в этом случае сортировка 'datetime' => 'DESC')
	 * @param (array) $arrOrderBy - массив параметров сортировки результата выборки (key: name field => val: ASC | DESC) or false
	 * @param (mixed) $arrLimit - false or массив параметров для оператора LIMIT (key: 'strLimit' => val: string of LIMIT for example: '0, 10', key: 'calcRows' => val: true | false)
	 * @param (array) $arrFields - массив полей для выборки (key: index => val: name field)
	 * @return array or false
	 */
	protected function pGetRecords($strWhere, $arrOrderBy, $arrLimit, $fields) {
		return $this->getEntrys($strWhere, $arrOrderBy, $arrLimit, $fields, false) ? $this->retData() : false;
	}

	/**
	 * protected функция производит запись данных в таблицу БД
	 * @param array $arrData - массив полей
	 * @return boolean
	 */
	protected function pRecRecord($arrData) {
		if ($this->fillTableFieldsValue($arrData) && $this->addEntry()) {
			return true;
		} else {
			return false;
		}
	}

 	/**
	* функция обновления записей
	* @param (array) $arrData - массив данных для обновления (key: name field => val: value field)
	* @param (string) $strWhere - выражение для оператора WHERE or false (по умолчанию false)
	* @return boolean
	*/
	protected function pUpdateRecords($arrData, $strWhere = false) {
		return $this->editEntrys(secure::escQuoteData($arrData), $strWhere);
	}

	/////////////////////////////////////////////////
	// END OF CLASS bmods
	/////////////////////////////////////////////////
}

