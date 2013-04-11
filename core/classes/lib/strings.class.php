<?php
/********************************************************
	JobExpert v1.0
	powered by Script Developers Group (SD-Group)
	email: info@sd-group.org.ua
	url: http://sd-group.org.ua/
	Copyright 2010-2015 (c) SD-Group
	All rights reserved
=========================================================
	Класс работы со строками
********************************************************/
/**
* @package
* @todo
*/

(!defined('SDG')) ? die ('Triple protection!') : null;

class strings
{
	/////////////////////////////////////////////////
	// VARS - свойства класса strings
	/////////////////////////////////////////////////

	/////////////////////////////////////////////////
	// METHODS - методы класса strings
	/////////////////////////////////////////////////

	/**
	* Функция генерирует строку
	* 
	* @param (int) $length - длина строки
	* 
	* @return (string)
	*/
	static function randomString($length)
	{ 
		$strRand = '';
		$validChars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';

		for($i = 0; $i < $length; $i++)
		{
			$strRand .= substr($validChars, rand(0, strlen($validChars)), 1);
		}

		return $strRand; 
	}

	/**
	* Функция преобразует HTML-код в строки с HTML-сущностями (мнемоники)
	* 
	* @param ($data) $data - ссылка на данные для преобразования
	* 
	* @return void
	*/
	static function htmlEncode(&$data)
	{
		if (is_array($data))
		{
			foreach($data as $key => &$value)
			{
				$data[$key] = self::htmlEncode($value);
			}

			return;
		}
		elseif (is_string($data))
		{
			return htmlentities($data, ENT_COMPAT, CONF_DEFAULT_CHARSET);
		}
		else
		{
			return;
		}
	}

	/**
	* Функция преобразует строки с HTML-сущностями (мнемониками) в HTML-код
	* 
	* @param (array) $data - ссылка на данные для преобразования
	* 
	* @return void
	*/
	static function htmlDecode(&$data)
	{
		if (is_array($data))
		{
			foreach($data as $key => &$value)
			{
				$data[$key] = self::htmlDecode($value);
			}

			return;
		}
		elseif (is_string($data))
		{
			return html_entity_decode($data, ENT_COMPAT, CONF_DEFAULT_CHARSET);
		}
		else
		{
			return;
		}
	}

	/**
	* UTF-8 -> Windows-1251
	* Функция преобразования кодировки текста из UTF-8 в Windows-1251
	* 
	* @param (string) $str - текст для преобразования
	* 
	* @return (stirng)
	*/
	static function Utf8ToWin($str)
	{
		$out = '';
		$c1 = '';
		$byte2 = false;

		for ($c = 0; $c < strlen($str); $c++)
		{
			$i = ord($str[$c]);

			if (127 > $i)
			{
				$out .= $str[$c];
			}

			if ($byte2)
			{
				$new_c2 = ($c1 & 3) * 64 + ($i & 63);
				$new_c1 = ($c1 >> 2) & 5;
				$new_i = (int) $new_c1 * 256 + $new_c2;

				if (1025 === $new_i)
				{
					$out_i = 168;
				}
				elseif (1105 === $new_i)
				{
					$out_i = 184;
				}
				else
				{
					$out_i = $new_i - 848;
				}

				$out .= chr($out_i);
				$byte2 = false;
			}

			if (6 === ($i >> 5))
			{
				$c1 = $i;
				$byte2 = true;
			}
		}

		return $out;
	}

	// Преобразование Windows 1251 -> UTF-8
	/**
	* Windows 1251 -> UTF-8
	* Функция преобразования кодировки текста из Windows-1251 в UTF-8
	* 
	* @param (string) $str - текст для преобразования
	* 
	* @return (stirng)
	*/
	static function WinToUtf8($str)
	{ 
		$out = '';
		$other[1025] = 'Ё';
   		$other[1105] = 'ё';
   		$other[1028] = 'Є';
   		$other[1108] = 'є';
   		$other[1030] = 'I';
   		$other[1110] = 'i';
   		$other[1031] = 'Ї';
   		$other[1111] = 'ї';

		for ($i = 0; $i < strlen($str); $i++)
		{
      		if (192 < ord($str{$i}))
      		{
         		$out .= '&#' . (ord($str{$i}) + 848) . ';';
      		}
      		else
      		{
         		if (!array_search($str{$i}, $other))
         		{
            		$out .= $str{$i};
         		}
         		else
         		{
            		$out .= '&#' . array_search($str{$i}, $other) . ';';
         		}
      		}
   		}

   		return $out;
	}

	/**
	* Функция определяет, строка в кодировке UTF-8 или нет
	* 
	* @param (string) $str - текст для проверки
	* 
	* @return (bool)
	*/
	static function detectUtf8($string)
	{
		return (preg_match('%(?:[\xC2-\xDF][\x80-\xBF] | \xE0[\xA0-\xBF][\x80-\xBF] | [\xE1-\xEC\xEE\xEF][\x80-\xBF]{2} | \xED[\x80-\x9F][\x80-\xBF] | \xF0[\x90-\xBF][\x80-\xBF]{2} | [\xF1-\xF3][\x80-\xBF]{3} | \xF4[\x80-\x8F][\x80-\xBF]{2})+%xs', $string)) ? true : false;
	}
	
	/**
	* Функция преобразовывает цвет из шестнадцатиричного формата в десятичный
	* 
	* @param (string) $color - цвет в формате - #FFFFFF
	* 
	* @return (array) $rgb - массив цвета, в формате $rgb[0] - red, $rgb[1] - green, $rgb[0] - blue, 
	*/
	static function colorHexToDec($color)
	{
		for ($i = 1; $i < 6; $i = $i + 2)
		{
			$rgb[] = hexdec(substr($color, $i, 2));
		}

		return $rgb;
	}

	/**
	* функция выводит страницы [предыдущая] 1 2 3 4 … [следующая]
	* 
	* @param (int) $a - количество элементов в массиве
	* @param (int) $offset - смещение в массиве([$offset ... $offset+$q])
	* @param (int) $q - количество элементов на странице
	* @param (string) $path - текущая ссылка ("index.php?do=news&")
	* @param (bool) $noCHPU - параметр, указывающий что не нужно приводить сслыки к ЧПУ (по умолчанию FALSE). Параметр был введен для метода strings::generatePage - т.к. он используется и в админке и в польз. части, а в админке ЧПУ не нужно никогда. Параметр можно использовать и в др. необходимых местах.
	* 
	* @return (string) $out
	*/
	static function generatePage($a, $offset, $q, $path, $noCHPU = false)
	{ 
		$out = '<span style="block_pages">';
		if ($a > $q) // если общее кол-во страниц больше отображаемых в данный момент, тогда формируем страницы
		{
			($offset % $q) ? $offset = $q : null;

			/***** Левая часть строки *****/
			// [prev]
			if ($offset > 0)
			{
				$out .= '<a href="' . chpu::createChpuUrl($path . 'offset=' . ($offset - $q), $noCHPU) . '" class="pages" rel="nofollow">&lt;&nbsp;</a>&nbsp;';
			}
			else
			{
				$out .= '';
			}

			// digital links
			$k = $offset / $q;

			// не более 3 страниц слева
			$min = $k - 3;

			if ($min < 0)
			{
				$min = 0;
			}
			else
			{
				if ($min >= 1) // ссылка 1-ой страницы
				{
					$out .= '<a href="' . chpu::createChpuUrl($path . 'offset=0', $noCHPU) . '" class="pages" rel="nofollow">1</a>&nbsp;';

					($min != 1) ? $out .= '...&nbsp;' : null;
				}
			}

			for ($i = $min; $i < $k; $i++)
			{
				$m = $i * $q + $q;
				($m > $a) ? $m = $a : null;

				$out .= '<a href="' . chpu::createChpuUrl($path . 'offset=' . ($i * $q), $noCHPU) . '" class="pages" rel="nofollow">' . ($i + 1) . '</a>&nbsp;';
			}
			/*****************************************/

			/***** Текущая страница (центр строки) *****/
			if (strcmp($offset, 'show_all'))
			{
				$min = $offset + $q;
				($min > $a) ? $min = $a : null;

				$out .= '<span class="curr_page">' . ($k + 1) . '</span>&nbsp;';
			}
			else
			{
				$min = $q;
				($min > $a) ? $min = $a : null;

				$out .= '<a href="' . chpu::createChpuUrl($path . 'offset=0', $noCHPU) . '" class="pages" rel="nofollow">1</a>&nbsp;';
			}
			/*****************************************/

			/***** Правая часть строки *****/
			// не более 3 страниц справа
			$min = $k + 4;
			($min > $a / $q) ? $min = $a/$q : null;

			for ($i = $k + 1; $i < $min; $i++)
			{
				$m = $i * $q + $q;
				($m > $a) ? $m = $a : null;

				$out .= '<a href="' . chpu::createChpuUrl($path . 'offset=' . ($i * $q), $noCHPU) . '" class="pages" rel="nofollow">' . ($i + 1) . '</a>&nbsp;';
			}

			if (($min * $q) < $a) // последняя ссылка
			{
				(($min * $q) < ($a - $q)) ? $out .= '...&nbsp;' : null;
				$pg_offset = (!($a % $q)) ? $a - $q : $a - $a % $q;

				$out .= '<a href="' . chpu::createChpuUrl($path . 'offset=' . $pg_offset, $noCHPU) . '" class="pages" rel="nofollow">' . ceil($a / $q) . '</a>&nbsp;';
			}
			/*****************************************/

			//[next]
			if (strcmp($offset, 'show_all'))
			{
				if ($offset < $a - $q)
				{
					$out .= '<a href="' . chpu::createChpuUrl($path . 'offset=' . ($offset + $q), $noCHPU) . '" class="pages" rel="nofollow">&nbsp;&gt;</a> ';
				}
				else
				{
					$out .= '';
				}
			}

			//[show all]
			/*
			if ($all)
			{
				if (strcmp($offset, 'show_all'))
				{
					$out .= ' |&nbsp; <a href="' . chpu::createChpuUrl($path . 'offset=show_all', $noCHPU) . '" class="pages" rel="nofollow">все</a>';
				}
				else
				{
					$out .= ' |&nbsp; <B>все</B>';
				}
			}
			*/
		}
		else
		{
			return '&nbsp;';
		} 

		return $out . '</span>';
	}

	/**
	* Функция формирует уникальный ключ
	* из переданного массива данных при помощи hash-функции md5()
	* 
	* @param (array) $arrData - данные для формирования ключа
	* 
	* @return (string) строка: hash - уникальный ключ
	*/
	static function getUnikey($arrData)
	{
		$unikey = '';
		foreach ($arrData as $value)
		{
			$unikey .= (string) $value;
		}
		return (string) md5($unikey);
	}

	/**
	* функция изменения кодировки строки
	* Допустимые кодировки - UTF-8 и Windows-1251
	* 
	* @param (string) $string
	* @param (string) $encoding - кодировка, в которую необходимо перекодировать строку (UTF-8 или Windows-1251)
	* 
	* @return string
	*/
	static function encodingString($string, $encoding)
	{
		// декодируем поисковую фразу
		$string = urldecode($string);

		return ('UTF-8' === $encoding) ? strings::WinToUtf8($string) : strings::Utf8ToWin($string);
	}

	
	/**
	* функция возвращает TRUE если значение больше 0
	* используется в некоторых местах с функцией array_filter
	* 
	* @param (int) $n - число
	* 
	* @return 0 if FALSE || 1 if TRUE
	*/
	static function ifInt($n)
	{
    	return ((int) $n > 0);
	}

	/**
	* функция убирает из домена протокол и www
	* 
	* @param (string) $domain
	* 
	* @return string
	*/
	static function clearDomain($domain)
	{
		$domain = rtrim($domain, '/');
		return preg_replace("/(https:\/\/|http:\/\/|www.)/i", '', $domain);
	}

	/**
	* функция формирует строку для TITLE-сайта из массива "Наименование страницы"
	* 
	* @param (array) $arrNamePage
	* 
	* @return string $title
	*/
	static function formTitle(&$arrNamePage)
	{
		$title = CONF_DEFAULT_TITLE;

		if (!empty($arrNamePage) && is_array($arrNamePage))
		{
			$title = array();
			foreach ($arrNamePage as &$arrNames)
			{
				$title[] = $arrNames['name'];
			}

			$title = implode((CONF_TITLE_PAGE_SEPERATOR) ? CONF_TITLE_PAGE_SEPERATOR : ' ', $title);

			(CONF_SITE_NAME_TO_TITLE) ? $title .= ' ' . CONF_SITE_NAME : null;
		}

		return $title;
	}

	/***** ФУНКЦИИ ТРАНСЛИТЕРАЦИИ *****/
	static function rus2translit($string)
	{
		$converter = array(
			'а' => 'a',		'б' => 'b',		'в' => 'v',
			'г' => 'g',		'д' => 'd',		'е' => 'e',
			'ё' => 'e',		'ж' => 'zh',	'з' => 'z',
			'и' => 'i',		'й' => 'y',		'к' => 'k',
			'л' => 'l',		'м' => 'm',		'н' => 'n',
			'о' => 'o',		'п' => 'p',		'р' => 'r',
			'с' => 's',		'т' => 't',		'у' => 'u',
			'ф' => 'f',		'х' => 'h',		'ц' => 'c',
			'ч' => 'ch',	'ш' => 'sh',	'щ' => 'sch',
			'ь' => '\'',	'ы' => 'y',		'ъ' => '\'',
			'э' => 'e',		'ю' => 'yu',	'я' => 'ya',

			'і' => 'i',		'ї' => 'i',		'є' => 'e',

			'А' => 'A',		'Б' => 'B',		'В' => 'V',
			'Г' => 'G',		'Д' => 'D',		'Е' => 'E',
			'Ё' => 'E',		'Ж' => 'Zh',	'З' => 'Z',
			'И' => 'I',		'Й' => 'Y',		'К' => 'K',
			'Л' => 'L',		'М' => 'M',		'Н' => 'N',
			'О' => 'O',		'П' => 'P',		'Р' => 'R',
			'С' => 'S',		'Т' => 'T',		'У' => 'U',
			'Ф' => 'F',		'Х' => 'H',		'Ц' => 'C',
			'Ч' => 'Ch',	'Ш' => 'Sh',	'Щ' => 'Sch',
			'Ь' => '\'',	'Ы' => 'Y',		'Ъ' => '\'',
			'Э' => 'E',		'Ю' => 'Yu',	'Я' => 'Ya',

			'І' => 'I',		'Ї' => 'I',		'Є' => 'E',

			'«' => '"',		'»' => '"',		'—' => '-'
		);

		return strtr($string, $converter);
	}

	static function str2url($str)
	{
		// удаляем все ненужное
		$str = trim(preg_replace(array('~[\']+~', '~[^-\w]+~', '~(:?-){2,}~'), array('', '-', '-'), strtolower(self::rus2translit($str))), '-');
		// возвращаем усеченную строку (настройка администратора)
		return (CONF_TRANSLITERATION_CHPU_MAX_LENGHT) ? substr($str, 0, CONF_TRANSLITERATION_CHPU_MAX_LENGHT) : $str;
	}

	/**
	* Функция парсит id ($_GET['id']) - используется при транслитерации ЧПУ
	* 
	* @param (string) $id
	* 
	* @return int
	*/
	static function parseID(&$id)
	{
		// получаем ID записи
		$id = explode('-', $_GET['id']);
		return (!empty($id[0]) && is_numeric($id[0]) && (int) $id[0] > 0) ? (int) $id[0] : 0;
	}

	/////////////////////////////////////////////////
	// END OF CLASS strings
	/////////////////////////////////////////////////
}
