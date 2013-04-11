<?php
/********************************************************
	JobExpert v1.0
	powered by Script Developers Group (SD-Group)
	email: info@sd-group.org.ua
	url: http://sd-group.org.ua/
	Copyright 2010-2015 (c) SD-Group
	All rights reserved
=========================================================
 Базовый Класс Поиска
********************************************************/
/**
 * @package
 * @todo
 */

(!defined('SDG')) ? die ('Triple protection!') : null;

/**
* Базовый Класс Поиска
*/
abstract class bsearch extends tbentrys
{
	/////////////////////////////////////////////////
	// VARS - свойства класса bsearch
	/////////////////////////////////////////////////

	/////////////////////////////////////////////////
	// CONSTRUCTOR - конструктор класса bsearch
	/////////////////////////////////////////////////

	/**
	* конструктор
	* 
	* @return void
	*/
	protected function __construct($table)
	{
		$this -> setTable($table);
	}


	/////////////////////////////////////////////////
	// METHODS - методы класса bsearch
	/////////////////////////////////////////////////

	/**
	* функция декодирования поисковой фразы
	* если кодировка строки не UTF-8, перекодирует строку
	* 
	* @param (string) $string
	* 
	* @return string
	*/
	protected function decodeSearchString($string)
	{
		// декодируем поисковую фразу
		$string = urldecode($string);

		// если кодировка не UTF-8, перекодируем строку
		('UTF-8' === CONF_DEFAULT_CHARSET && !strings::detectUtf8($string)) ? $string = strings::WinToUtf8($string) : null;

		return $string;
	}

	/**
	* метод обработки стороки запроса поиска
	* 
	* @param (string) $str - исходная строка запроса
	* @param (bool) $like - параметр определяет, в каком типе запроса будет использоваться строка (LIKE => true или MATCH => false)
	* 
	* @return array - массив слов
	*/
	private function processingQueryString($str, $like = false)
	{
		$str = explode(' ', trim($str));
		//$str = preg_replace('/[^A-zА-Яа-я0-9-]/i', '', $str); // убираем из строки все символы, кроме букв, цифр и тире
		$str = preg_replace("/[^\w\x7F-\xFF\s-]/", '', $str);// убираем из строки все символы, кроме букв, цифр и тире

		if ($like)
		{
			$new = '';
			foreach ($str as $value) // собираем строку для LIKE-запроса
			{
				$new .= '%' . $value . '% ';
			}
			$str = $new;
		}
		else
		{
			$str = implode(' ', $str);
		}

		return trim($str);
	}

	/**
	* функция составляет часть запроса для Разделов
	* 
	* @param (string) $id - ID раздела (может буть пустой строкой)
	* 
	* @return string
	*/
	private function processingSection($id)
	{
		// при переходе на работу с объектами объявлений пришлось сделать >0
		return (!empty($id)) ? "id_section IN (" . secure::escQuoteData($id) . ")" : 'id_section>0';
	}

	/**
	* функция составляет часть запроса для Профессий
	* 
	* @param (string) $id - ID профессии (может буть пустой строкой)
	* @param (string) $id - база поиска (таблица) vacancy или resume
	* 
	* @return string
	*/
	private function processingProfession($id, $base)
	{
		switch($base)
		{
			case 'vacancy':
				return (!empty($id)) ? " AND id_profession IN (" . secure::escQuoteData($id) . ")" : false;
				break;

			case 'resume':
				return (!empty($id)) ? " AND (id_profession IN (" . secure::escQuoteData($id) . ") OR id_profession_1 IN (" . secure::escQuoteData($id) . ") OR id_profession_2 IN (" . secure::escQuoteData($id) . "))" : false;
				break;
		}
	}

	/**
	* функция составляет часть запроса для Областей
	* 
	* @param (string) $id - ID области (может буть пустой строкой)
	* 
	* @return string
	*/
	private function processingRegion($id)
	{
		return (!empty($id)) ? " AND id_region IN (" . secure::escQuoteData($id) . ")" : false;
	}

	/**
	* функция составляет часть запроса для Городов
	* 
	* @param (string) $id - ID города (может буть пустой строкой)
	* 
	* @return string
	*/
	private function processingCity($id)
	{
		return (!empty($id)) ? " AND id_city IN (" . secure::escQuoteData($id) . ")" : false;
	}

	/**
	* функция составляет часть запроса для Зарплаты
	* 
	* @param (string) $pay_from - зарплата от (может буть пустой строкой)
	* @param (string) $currency - валюта
	* 
	* @return string
	*/
	private function processingPay($pay_from, $currency)
	{
		if (!empty($pay_from) && !empty($currency))
		{
			$pay = " AND pay_from>=" . secure::escQuoteData($pay_from) . " AND currency IN (" . secure::escQuoteData($currency) . ")";
		}
		elseif (!empty($pay_from) && empty($currency))
		{
			$pay = " AND pay_from>=" . secure::escQuoteData($pay_from);
		}
		elseif (empty($pay_from) && !empty($currency))
		{
			$pay = " AND currency IN (" . secure::escQuoteData($currency) . ")";
		}
		else
		{
			$pay = false;
		}

		return $pay;
	}

	/**
	* функция составляет часть запроса для Зарплаты (для Резюме)
	* 
	* @param (string) $pay_from - зарплата от (может буть пустой строкой)
	* @param (string) $pay_post - зарплата до (может буть пустой строкой)
	* @param (string) $currency - валюта
	* 
	* @return string
	*/
	private function processingPayResume($pay_from, $pay_post, $currency)
	{
		$strCurr = (!empty($currency)) ? " AND currency IN (" . secure::escQuoteData($currency) . ")" : false;

		if (!empty($pay_from) && !empty($pay_post))
		{
			$pay = " AND pay_from>=" . secure::escQuoteData($pay_from) . "  AND pay_from<=" . secure::escQuoteData($pay_post);
		}
		elseif (!empty($pay_from) && empty($pay_post))
		{
			$pay = " AND pay_from>=" . secure::escQuoteData($pay_from);
		}
		elseif (empty($pay_from) && !empty($pay_post))
		{
			$pay = " AND pay_from<=" . secure::escQuoteData($pay_post);
		}
		else
		{
			$pay = false;
		}

		return (!empty($pay)) ? $pay . $strCurr : $strCurr;
	}

	/**
	* функция составляет часть запроса для Периода
	* 
	* @param (int) $days - дни
	* 
	* @return string
	*/
	private function processingPeriod($days)
	{
		$date = date('Y-m-d', strtotime(terms::currentDateTime()) - ($days * 24 * 3600));
		return " AND act_datetime>=" . secure::escQuoteData($date);
	}

	/**
	* функция составляет часть запроса для Возраста
	* 
	* @param (string) $age_from - возраст от (может буть пустой строкой)
	* @param (string) $age_post - возраст до (может буть пустой строкой)
	* 
	* @return string
	*/
	private function processingAge($age_from, $age_post)
	{
		if (!empty($age_from) && !empty($age_post))
		{
			$age = " AND age_from>=" . secure::escQuoteData($age_from) . " AND age_post<=" . secure::escQuoteData($age_post);
		}
		elseif (!empty($age_from) && empty($age_post))
		{
			$age = " AND age_from>=" . secure::escQuoteData($age_from);
		}
		elseif (empty($age_from) && !empty($age_post))
		{
			$age = " AND age_post<=" . secure::escQuoteData($age_post);
		}
		else
		{
			$age = false;
		}

		return $age;
	}

	/**
	* функция составляет часть запроса для Возраста
	* 
	* @param (string) $age_from - возраст от (может буть пустой строкой)
	* @param (string) $age_post - возраст до (может буть пустой строкой)
	* 
	* @return string
	*/
	private function processingAgeResume($age_from, $age_post)
	{
		if (!empty($age_from) && !empty($age_post))
		{
			$age = " AND age>=" . secure::escQuoteData($age_from) . " AND age<=" . secure::escQuoteData($age_post);
		}
		elseif (!empty($age_from) && empty($age_post))
		{
			$age = " AND age>=" . secure::escQuoteData($age_from);
		}
		elseif (empty($age_from) && !empty($age_post))
		{
			$age = " AND age<=" . secure::escQuoteData($age_post);
		}
		else
		{
			$age = false;
		}

		return $age;
	}

	/**
	* функция составляет часть запроса для График работы
	* 
	* @param (int) $chart_work - строка для поиска (может быть пустой строкой)
	* 
	* @return string
	*/
	private function processingChartWork($chart_work)
	{
		return (!empty($chart_work)) ? " AND chart_work IN (" . secure::escQuoteData($chart_work) . ")" : false;
	}

	/**
	* функция составляет часть запроса для Опыт работы
	* 
	* @param (int) $expire_work - строка для поиска (может быть пустой строкой)
	* 
	* @return string
	*/
	private function processingExpireWork($expire_work)
	{
		return (!empty($expire_work)) ? " AND expire_work IN (" . secure::escQuoteData($expire_work) . ")" : false;
	}

	/**
	* функция составляет часть запроса для Образование
	* 
	* @param (int) $expire_work - строка для поиска (может быть пустой строкой)
	* 
	* @return string
	*/
	private function processingEduWork($edu_work)
	{
		return (!empty($edu_work)) ? " AND edu_work IN (" . secure::escQuoteData($edu_work) . ")" : false;
	}
	private function processingEduWorkResume($education)
	{
		return (!empty($education)) ? " AND education IN (" . secure::escQuoteData($education) . ")" : false;
	}

	/**
	* функция составляет часть запроса для Пол
	* 
	* @param (int) $gender - строка для поиска (может быть пустой строкой)
	* 
	* @return string
	*/
	private function processingGender($gender)
	{
		return (!empty($gender)) ? " AND gender IN (" . secure::escQuoteData($gender) . ")" : false;
	}

	/**
	* функция составляет часть запроса для Тип пользователя
	* 
	* @param (int) $user_type - строка для поиска (может быть пустой строкой)
	* 
	* @return string
	*/
	private function processingUserType($user_type)
	{
		return (!empty($user_type)) ? " AND user_type IN (" . secure::escQuoteData($user_type) . ")" : false;
	}

	/**
	* метод поиска объявлений, по указаным данным
	* 
	* @param (array) $arrData - массив данных, в соответствии с которыми необходимо произвести поиск
	* 
	* @return array
	*/
	protected function searchQuery($arrData)
	{
		// начальное время поиска
		$time_start = microtime(1);

		// Определяем запромы для Разделов, Профессий, Областей и Городов
		$section = $this -> processingSection($arrData['id_section']);
		$profession = $this -> processingProfession($arrData['id_profession'], $arrData['base']);
		$region = $this -> processingRegion($arrData['id_region']);
		$city = $this -> processingCity($arrData['id_city']);
		$pay = $this -> processingPay($arrData['pay_from'], $arrData['currency']);
		$period = $this -> processingPeriod($arrData['period']);
		
		$advanced = $section . $profession . $region . $city . $pay . $period;
		
		// формируем поискувую фразу и запрос, в зависимости от типа поиска
		switch ($arrData['type'])
		{
			case 'exact':
			default:
				$search = $this -> processingQueryString($arrData['q']);
				$query = "MATCH title AGAINST (" . secure::escQuoteData($search) . " IN BOOLEAN MODE) AND " . $advanced;
				break;

			case 'any':
				$search = $this -> processingQueryString($arrData['q'], true);
				$query = "title LIKE " . secure::escQuoteData($search) . " AND " . $advanced;
				break;
		}

		$obj = ($arrData['base'] == 'vacancy') ? new vacancy() : new resume();
		
		$arrLimit = array('strLimit' => $arrData['offset'] . ',' . $arrData['records'], 'calcRows' => true, false);
		$arrData['result'] = $obj -> getActiveAnnounces($arrLimit, $query);
		//$arrData['result'] = ($this -> getEntrys($query, array('act_datetime' => 'DESC'), array('strLimit' => $arrData['offset'] . ',' . $arrData['records'], 'calcRows' => true), false)) ? $this -> retData() : false;
		$arrData['records'] = $this -> calcFoundRows();

		// вычисляем время поиска
		$arrData['time'] = sprintf('%01.3f', microtime(1) - $time_start);

		return $arrData;
	}

	/**
	* метод поиска Вакансий, по указаным данным
	* 
	* @param (array) $arrData - массив данных, в соответствии с которыми необходимо произвести поиск
	* 
	* @return array
	*/
	protected function searchVacancy($arrData)
	{
		// начальное время поиска
		$time_start = microtime(1);

		// Определяем запромы для Разделов, Профессий, Областей и Городов
		$section = $this -> processingSection($arrData['id_section']);
		$profession = $this -> processingProfession($arrData['id_profession'], 'vacancy');
		$region = $this -> processingRegion($arrData['id_region']);
		$city = $this -> processingCity($arrData['id_city']);
		$pay = $this -> processingPay($arrData['pay_from'], $arrData['currency']);
		$chart_work = $this -> processingChartWork($arrData['chart_work']);
		$expire_work = $this -> processingExpireWork($arrData['expire_work']);
		$edu_work = $this -> processingEduWork($arrData['edu_work']);
		$age = $this -> processingAge($arrData['age_from'], $arrData['age_post']);
		$gender = $this -> processingGender($arrData['gender']);
		$user_type = $this -> processingUserType($arrData['user_type']);
		$period = $this -> processingPeriod($arrData['period']);

		//$query = "token='active'" . $section . $profession . $region . $city . $pay . $chart_work . $expire_work . $edu_work . $age . $gender . $user_type . $period;
		$query = $section . $profession . $region . $city . $pay . $chart_work . $expire_work . $edu_work . $age . $gender . $user_type . $period;

		$vacancy = new vacancy();
		$arrLimit = array('strLimit' => $arrData['offset'] . ',' . $arrData['records'], 'calcRows' => true, false);
		$arrData['result'] = $vacancy -> getActiveAnnounces($arrLimit, $query);
		//$arrData['result'] = ($this -> getEntrys($query, array('act_datetime' => 'DESC'), array('strLimit' => $arrData['offset'] . ',' . $arrData['records'], 'calcRows' => true, false), false)) ? $this -> retData() : false;
		$arrData['records'] = $this -> calcFoundRows();

		// вычисляем время поиска
		$arrData['time'] = sprintf('%01.3f', microtime(1) - $time_start);

		return $arrData;
	}

	/**
	* метод поиска Резюме, по указаным данным
	* 
	* @param (array) $arrData - массив данных, в соответствии с которыми необходимо произвести поиск
	* 
	* @return array
	*/
	protected function searchResume($arrData)
	{
		// начальное время поиска
		$time_start = microtime(1);

		// Определяем запромы для Разделов, Профессий, Областей и Городов
		$section = $this -> processingSection($arrData['id_section']);
		$profession = $this -> processingProfession($arrData['id_profession'], 'vacancy');
		$region = $this -> processingRegion($arrData['id_region']);
		$city = $this -> processingCity($arrData['id_city']);
		$chart_work = $this -> processingChartWork($arrData['chart_work']);
		$expire_work = $this -> processingExpireWork($arrData['expire_work']);
		$education = $this -> processingEduWorkResume($arrData['education']);
		$age = $this -> processingAgeResume($arrData['age_from'], $arrData['age_post']);
		$pay = $this -> processingPayResume($arrData['pay_from'], $arrData['pay_post'], $arrData['currency']);
		$gender = $this -> processingGender($arrData['gender']);
		$user_type = $this -> processingUserType($arrData['user_type']);
		$period = $this -> processingPeriod($arrData['period']);

		//$query = "token='active'" . $section . $profession . $region . $city . $chart_work . $expire_work . $edu_work . $age . $gender . $user_type . $period;
		$query = $section . $profession . $region . $city . $chart_work . $expire_work . $education . $age . $pay . $gender . $user_type . $period;

		$resume = new resume();
		$arrLimit = array('strLimit' => $arrData['offset'] . ',' . $arrData['records'], 'calcRows' => true);
		$arrData['result'] = $resume -> getActiveAnnounces($arrLimit, $query);
		//$arrData['result'] = ($this -> getEntrys($query, array('act_datetime' => 'DESC'), array('strLimit' => $arrData['offset'] . ',' . $arrData['records'], 'calcRows' => true), false)) ? $this -> retData() : false;
		$arrData['records'] = $this -> calcFoundRows();

		// вычисляем время поиска
		$arrData['time'] = sprintf('%01.3f', microtime(1) - $time_start);

		return $arrData;
	}

	/////////////////////////////////////////////////
	// END OF CLASS bsearch
	/////////////////////////////////////////////////
}
