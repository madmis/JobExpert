<?php

/**
 * Powered by Script Developers Group (SD-Group)
 * Email: info@sd-group.org.ua
 * URL: http://sd-group.org.ua/
 * Copyright 2009 (c) SD-Group
 * All rights reserved
 * ===================================================
 * Функции SEO
 * ===================================================
 */
(!defined('SDG')) ? die('Triple protection!') : null;

class seo {

	/**
	 * Получаем title для страницы из файла SEO
	 * ('lang/' . $language . '/seo/' . $file)
	 * @param string $part раздел. Пример: agencies, companies
	 * @param string $language текущий язык сайта (глобальная переменная $currLang)
	 * @return string текст из файла или пустая строка 
	 */
	public static function getTitle($part, $language='russian') {
		return self::getSeo($part . '.title.seo', $language);
	}

	/**
	 * Получаем keywords для страницы из файла SEO
	 * ('lang/' . $language . '/seo/' . $file)
	 * @param string $part раздел. Пример: agencies, companies
	 * @param string $language текущий язык сайта (глобальная переменная $currLang)
	 * @return string текст из файла или пустая строка 
	 */
	public static function getKeywords($part, $language='russian') {
		return self::getSeo($part . '.keywords.seo', $language);
	}

	/**
	 * Получаем description для страницы из файла SEO
	 * ('lang/' . $language . '/seo/' . $file)
	 * @param string $part раздел. Пример: agencies, companies
	 * @param string $language текущий язык сайта (глобальная переменная $currLang)
	 * @return string текст из файла или пустая строка 
	 */
	public static function getDescription($part, $language='russian') {
		return self::getSeo($part . '.description.seo', $language);
	}

	/**
	 * Получаем SEO для страницы из файла SEO
	 * ('lang/' . $language . '/seo/' . $file)
	 * @param string $file имя файла SEO.
	 * @param string $language текущий язык сайта (глобальная переменная $currLang)
	 * @return string текст из файла или пустая строка 
	 */
	private static function getSeo($file, $language='russian') {
		$path = 'lang/' . $language . '/seo/' . $file;

		if (is_file($path) && $content = file_get_contents($path)) {
			return $content;
		}

		return '';
	}

	/**
	 * Получить все файлы SEO относящиеся к выбранному разделу
	 * @param string $part раздел. Пример: agencies, companies
	 * @param string $language текущий язык сайта (глобальная переменная $currLang)
	 */
	public static function getSeoFiles($part, $language='russian') {
		$files = filesys::getFilesInDir('lang/' . $language . '/seo/');
		$resArray = array();
		if (!empty($files)) {
			foreach($files as $value) {
				if (strpos($value, $part) !== false) {
					$resArray[$value] = self::getSeo($value, $language);
				}
			}
		}
		return $resArray;
	}

	public function saveSeoFile($file, $text='', $language='russian') {
		if (empty($file)) {
			return false;
		}
		$path = 'lang/' . $language . '/seo/' . $file;
		return file_put_contents($path, htmlspecialchars($text, ENT_QUOTES, CONF_DEFAULT_CHARSET));
	}
}
