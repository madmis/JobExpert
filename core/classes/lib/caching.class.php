<?php

/**
 * Powered by Script Developers Group (SD-Group)
 * Email: info@sd-group.org.ua
 * URL: http://sd-group.org.ua/
 * Copyright 2009 (c) SD-Group
 * All rights reserved
 * ===================================================
 * Функции работы с кешем
 * ===================================================
 *
 * @package
 *
 * @todo
 *
 */
(!defined('SDG')) ? die('Triple protection!') : null;

class caching {
	/////////////////////////////////////////////////
	// VARS - свойства класса caching
	/////////////////////////////////////////////////
	/////////////////////////////////////////////////
	// METHODS - методы класса caching
	/////////////////////////////////////////////////

	/**
	 * Функция получает кешированные данные из файла
	 *
	 * @param (string) $file - путь к файлу
	 *
	 * @return (array or bool)
	 */
	static function getCahing($file) {
		return filesys::getSerializedData($file);
	}

	/**
	 * Функция создает файл кэша
	 *
	 * @param (string) $file - путь к файлу
	 * @param (array) $contents - данные, для записи
	 *
	 * @return (bool)
	 */
	static function setCaching($file, $contents) {
		(!is_dir('caching')) ? mkdir('caching', 0757) : null;

		return filesys::putSerializedData($file, $contents);
	}

	/**
	 * Функция удаляет файл кэша
	 *
	 * @param (string) $cacheName - имя файла кеша (таблица без префикса)
	 *
	 * @return (bool)
	 */
	static function clearCache($cacheName) {
		$result = true;
		$fullFileName = 'caching/' . $cacheName . '.cache';
		if (file_exists($fullFileName) && is_file($fullFileName)) {
			$result = unlink($fullFileName);
		}

		return $result;
	}

	/**
	 * Функция полностью очишает кеш сайта
	 *
	 * @return bool
	 */
	static function dropCache() {
		$result = true;
		foreach (filesys::getFilesInDir('caching/') as $cacheFile) {
			if (!unlink('caching/' . $cacheFile)) {
				$result = false;
			}
		}

		return true;
	}

	/**
	 * Функция полностью очишает кеш шаблонов сайта
	 *
	 * @return bool
	 */
	static function dropTmplCache() {
		$result = true;
		foreach (filesys::getFilesInDir(TEMPLATE_COMPILE_DIR) as $cacheFile) {
			if (!unlink(TEMPLATE_COMPILE_DIR . $cacheFile)) {
				$result = false;
			}
		}

		return $result;
	}

	/////////////////////////////////////////////////
	// END OF CLASS caching
	/////////////////////////////////////////////////
}
