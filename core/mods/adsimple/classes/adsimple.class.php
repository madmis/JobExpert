<?php

/* * ******************************************************
  powered by Script Developers Group (SD-Group)
  email: info@sd-group.org.ua
  url: http://sd-group.org.ua/
  Copyright 2009 (c) SD-Group
  All rights reserved
  =========================================================
  Класс мода AdSimple
 * ****************************************************** */

(!defined('SDG')) ? die('Triple protection!') : null;

class adsimple {
	/////////////////////////////////////////////////
	// VARS - свойства класса adsimple
	/////////////////////////////////////////////////

	/**
	 * $adPosition: массив возможных мест для размещения рекламы
	 * @var array
	 */
	static $adPosition = array('toper', 'advertisement_top', 'advertisement_bottom', 'bottomer', 'advertisement_left', 'advertisement_right');

	/**
	 * $dbFile: путь к файлу БД мода AdSimple
	 * @var string
	 */
	static $dbFile = 'core/mods/adsimple/mda/adsimple.mda';


	/////////////////////////////////////////////////
	// METHODS - методы класса adsimple
	/////////////////////////////////////////////////

	/**
	 * метод проверят файл БД на наличие в нем всех значений массива $adPosition
	 * если каких-либо значений не хватает, метод дописывает их
	 * @return bool
	 */
	static function checkMDAFile() {
		$arrData = array('code' => false, 'htmlcode' => false, 'token' => 'disabled');
		// проверяем, существует ли файл БД
		if (@file_exists(self::$dbFile)) {
			// Считываем данные из файла БД
			$dbData = filesys::getSerializedData(self::$dbFile);

			// Проверяем, чтобы в массиве были все необходимые ключи
			// если ключей не хватает, дописываем их
			foreach (self::$adPosition as $value) {
				//!isset($dbData[$value]) ? $dbData[$value] = $arrData : null;
				!isset($dbData[$value]) ? $dbData[$value] = array() : null;
			}

			// сохраняем файл БД.
			return filesys::putSerializedData(self::$dbFile, $dbData);
		}
		// Если файл БД не существует
		// создаем его и записываем в него значения $adPosition 
		else {
			$dbData = array();
			foreach (self::$adPosition as $value) {
				//$dbData[$value] = $arrData;
				$dbData[$value] = array();
			}
			return filesys::putSerializedData(self::$dbFile, $dbData);
		}
	}

	/**
	 * Функция возвращает массив доступной для показа рекламы (active) по ключу
	 * @param string $key (один из ключей расположения рекламы)
	 * @return array
	 */
	public function get($key) {
		if (!in_array($key, self::$adPosition)) {
			return array();
		}

		$dbData = filesys::getSerializedData(self::$dbFile);
		$ret = array();
		foreach ($dbData[$key] as $value) {
			if ('active' == $value['token']) {
				$ret[] = $value;
			}
		}
		return $ret;
	}
	
	/**
	 * Функция возвращает код случайной рекламы доступной для показа, по ключу (месту размещения)
	 * @param string $key (один из ключей расположения рекламы)
	 * @return string
	 */
	public function getShuffleCode($key) {
		if (!in_array($key, self::$adPosition)) {
			return '';
		}
		$arr = $this->get($key);
		shuffle($arr);
		$ret = array_shift($arr);
		return $ret['code'];
	}
	/////////////////////////////////////////////////
	// END OF CLASS adsimple
	/////////////////////////////////////////////////
}

