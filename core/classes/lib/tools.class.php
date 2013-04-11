<?php
/********************************************************
	powered by Script Developers Group (SD-Group)
	email: info@sd-group.org.ua
	url: http://sd-group.org.ua/
	Copyright 2009 (c) SD-Group
	All rights reserved
=========================================================
 	Класс вспомогательных функций
********************************************************/

(!defined('SDG')) ? die ('Triple protection!') : null;

/**
* Класс вспомогательных функций
* 
*/

class tools
{
	/////////////////////////////////////////////////
	// VARS - свойства класса tools
	/////////////////////////////////////////////////

	/////////////////////////////////////////////////
	// METHODS - методы класса tools
	/////////////////////////////////////////////////

	/**
	* static функция парсит массив данных (дополнительных) записываемых в xml-формате
	* сохраняет полученные результаты в массив переданный по ссылке
	* 
	* @param array $arrData - данные для парсера
	* @param array $reference - ссылка на массив, для записи результата работы парсера
	* @param array $etalon - эталоный массив полей ведомой таблицы хранящийся в классе объявления
	* 
	* @return void
	*/
	static function annDataParser(&$arrData, &$reference, $etalon)
	{
		if (is_array($arrData) && ($arrData = array_intersect_key($arrData, $etalon)))
		{
			foreach ($arrData as $keyData => &$arrContent)
			{
				$count = 1;
				$bindFields = $noBindFields = array();
				$cntFields = (int) count($etalon[$keyData][1]['arrBindFields']) + count($etalon[$keyData][1]['arrNoBindFields']);
				if (is_array($arrContent) && !empty($arrContent))
				{
					foreach ($arrContent as &$arrFields)
					{
						if (is_array($arrFields) && !empty($arrFields))
						{
							foreach ($arrFields as $key => &$value)
							{
								('arrBindFields' !== $key) ? $noBindFields += $value : $bindFields += $value;
							}

							if ($cntFields === $count)
							{
								$reference[$keyData][] = array('arrBindFields' => $bindFields) + array('arrNoBindFields' => $noBindFields);
								$bindFields = $noBindFields = array();
								$count = 1;
							}
							else
							{
								$count++;
							}
						}
					}
				}
			}
		}
	}

	/**
	* static функция arrMultyParser- рекурсивно парсит многомерный массив
	* Формирует одномерный массив с ключами всех вложенных массивов в виде строки и значением
	* сохраняет полученные результат в переменной переданной параметром $reference
	* 
	* @param array $returnData - исходный массив данных
	* @param array $reference - переменная для сохранения результата
	* 
	* @return void
	*/
	static function arrayMultyParser(&$returnData, &$reference)
	{
		$keyParent = @func_get_arg(2);

		if (!is_array($returnData))
		{
			return;
		}
		else
		{
			foreach ($returnData as $key => &$data)
			{
				$currKey = (!$keyParent) ? $key : $keyParent . "[$key]";

				(!is_array($data)) ? $reference[$currKey] = $data : self::arrayMultyParser($data, $reference, $currKey);
			}

			return;
		}
	}

	/**
	* static функция обновления данных в массиве
	* сохраняет полученные результаты в массив переданный по ссылке
	* 
	* @param array $arr - ссылка на массив, в котором необходимо обновить данные
	* @param array $arrData - массив данных для обновления
	* 
	* @return void
	*/
	static function updateSessionData(&$arr, $arrData)
	{
		foreach ($arrData as $key => $value)
		{
			$arr[$key] = $value;
		}
	}

	/**
	* static функция считывания шаблона сайта из xml-файла
	* 
	* @return bool
	*/
	static function getXmlTemplate()
	{
		if (file_exists('core/xml/main.temlate.xml') && is_object($xml = simplexml_load_file('core/xml/main.temlate.xml')) && property_exists($xml, 'template'))
		{
			$xmlTemplate = array();
			foreach (get_object_vars($xml -> template) as $sideName => $sideContent)
			{
				(is_object($sideContent)) ? $sideContent = get_object_vars($sideContent) : null;

				if (!isset($sideContent['block']))
				{
					$xmlTemplate[$sideName] = array();
				}
				else
				{
					(is_object($sideContent['block'])) ? $sideContent['block'] = get_object_vars($sideContent['block']) : null;

					$xmlTemplate[$sideName] = (!empty($sideContent['block'])) ? (!is_array($sideContent['block'])) ? array($sideContent['block']) : $sideContent['block'] : array();
				}
			}

			return $xmlTemplate;
		}
		else
		{
		    die ('Failed to open or parse file: core/xml/adm.menu.xml');
		}
	}

	/**
	* static функция записи шаблона сайта в xml-файл
	* 
	* @return bool
	*/
	static function recXmlTemplate(&$arrXmlTemplate)
	{
		if (is_array($arrXmlTemplate))
        {
			$xmlData = simplexml_load_string('<?xml version="1.0" encoding="UTF-8"?><root></root>');

			(!isset($arrXmlTemplate['arrBlocks']['head_site']) || !is_array($arrXmlTemplate['arrBlocks']['head_site'])) ? $arrData['head_site'] = false : $arrData['head_site'] =& array_reverse($arrXmlTemplate['arrBlocks']['head_site']);
			(!isset($arrXmlTemplate['arrBlocks']['left_side']) || !is_array($arrXmlTemplate['arrBlocks']['left_side'])) ? $arrData['left_side'] = false : $arrData['left_side'] =& array_reverse($arrXmlTemplate['arrBlocks']['left_side']);
			(!isset($arrXmlTemplate['arrBlocks']['center_side']) || !is_array($arrXmlTemplate['arrBlocks']['center_side'])) ? $arrData['center_side'] = false : $arrData['center_side'] =& array_reverse($arrXmlTemplate['arrBlocks']['center_side']);
			(!isset($arrXmlTemplate['arrBlocks']['right_side']) || !is_array($arrXmlTemplate['arrBlocks']['right_side'])) ? $arrData['right_side'] = false : $arrData['right_side'] =& array_reverse($arrXmlTemplate['arrBlocks']['right_side']);
			(!isset($arrXmlTemplate['arrBlocks']['foot_site']) || !is_array($arrXmlTemplate['arrBlocks']['foot_site'])) ? $arrData['foot_site'] = false : $arrData['foot_site'] =& array_reverse($arrXmlTemplate['arrBlocks']['foot_site']);

			$xmlTemplate = $xmlData -> addChild('template');

			foreach ($arrData as $nameSide => $arrBlocks)
			{
				$xmlSide = $xmlTemplate -> addChild($nameSide);

				if (!empty($arrBlocks) && is_array($arrBlocks))
				{
					foreach ($arrBlocks as $block)
					{
						$xmlSide -> addChild('block', $block);
					}
				}
				else
				{
					$xmlSide -> addChild('block');
				}
			}

			(!file_put_contents('core/xml/main.temlate.xml', $xmlData -> asXML())) ? messages::printDie(ERROR_FILE_NOT_WRITE) : messages::messageChangeSaved(MESSAGE_CHANGE_SAVED, false, CONF_ADMIN_FILE . '?m=service&s=designer');
		}
        else
		{
			return false;
		}
	}

	/**
	* static функция получения статистики из БД
	* 
	* @return array
	*/
	static function getStatistics(&$arrXmlTemplate, &$objVacancy, &$objResume, &$objUser)
	{
		$sides = array_merge($arrXmlTemplate['left_side'], $arrXmlTemplate['right_side']);

		if (false !== array_search('block.statistics.tpl', $sides))
		{
			if (!CONF_ENABLE_CACHING || false === ($arrStat = caching::getCahing('caching/statistic.cache')))
			{
				$arrStat = array(
									'users'		=> $objUser -> cntActiveUsers(),
									'vacancys'	=> $objVacancy -> cntAnnounces("token IN ('active')"),
									'resumes_v'	=> $objResume -> cntAnnounces("token IN ('active') AND visibility IN ('visible','visiblehc')"),
									'resumes_m'	=> $objResume -> cntAnnounces("token IN ('active') AND visibility IN ('visible','visiblehc','members','membershc')")
							   );

				(CONF_ENABLE_CACHING) ? caching::setCaching('caching/statistic.cache', $arrStat) : null;
			}
		}
		else
		{
			$arrStat = false;
		}

		return $arrStat;
	}

	/**
	* static функция получения данных кто онлайн
	* 
	* @return array
	*/
	static function getWhoOnline(&$arrXmlTemplate, &$objUser)
	{
		$sides = array_merge($arrXmlTemplate['left_side'], $arrXmlTemplate['right_side']);

		if (false !== array_search('block.who.online.tpl', $sides))
		{
			$currTime = time();
			$currSessionId = session_id();

			if (!$arrWhoOnline = filesys::getSerializedData('core/data/who.online.mda'))
			{
				$arrWhoOnline = array('guests' => array(), 'users' => array());
			}
			else
			{
				foreach ($arrWhoOnline as $type => $whoOnline)
				{
					foreach ($whoOnline as $key => $timestamp)
					{
						if ($currTime > $timestamp || $currSessionId === $key)
						{
							unset ($arrWhoOnline[$type][$key]);
						}
					}
				}
			}

			$keyWhoOnline = (!$objUser -> getAuthorized()) ? 'guests' : 'users';
			$arrWhoOnline[$keyWhoOnline][$currSessionId] = $currTime + 180;

			filesys::putSerializedData('core/data/who.online.mda', $arrWhoOnline);

			$arrWhoOnline = array('guests' => count($arrWhoOnline['guests']), 'users' => count($arrWhoOnline['users']));
		}
		else
		{
			$arrWhoOnline = false;
		}

		return $arrWhoOnline;
	}

	/**
	* static сохранения файлов конфигурации
	* 
	* @param (string) $file - полный путь к файлу, который необходимо сохранить
	* @param (string) $data - данные для сохранения
	* @param (string or false) $link - ссылка для переадлресации (в случае успешного сохранения). Если сслыка FALSE, то метод вернет результат TRUE вместо переадресации
	* 
	* @return - false (значит либо не найден файл, либо у файла нет прав на запись) или перезагружает страницу
	*/
	static function saveConfig($file, &$data, $link = false)
	{
		// если файл не существует и не удалось записать данные в файл возвращем false
		if (!file_exists($file) && !file_put_contents($file, $data))
		{
			return false;
		}
		// иначе, если нет прав доступа и не удалось установить необходимые права: пытаемся удалить и записать новый файл
		// при неудаче возвращем false
		elseif (!filesys::setFileChmod($file, '0666') && !unlink($file) && !file_put_contents($file, $data))
		{
			return false;
		}
		// иначе, пытаемся перезаписать файл
		// при неудаче возвращем false
		elseif (!file_put_contents($file, $data))
		{
			return false;
		}
		elseif (!empty($link))
		{
			 messages::messageChangeSaved(MESSAGE_CHANGE_SAVED, false, $link);
		}
		else
		{
			return true;
		}
	}

	/**
	* static функция сохраняет шаблон письма
	* 
	* @param (string) $file - полный путь к файлу, который необходимо сохранить
	* @param (string) $data - данные для сохранения
	* 
	* @return TRUE or STRING ERROR
	*/
	static function saveMailTemplateFile(&$file, &$data)
	{
		if (empty($file) || empty($data)) return ERROR_EMPTY_FORM_FIELDS;

		if (!file_exists($file)) return ERROR_CRITICAL_FILE_NOT_EXISTS;

		return (!file_put_contents($file, str_replace('href="/', 'href="', stripslashes($data)))) ? ERROR_FILE_NOT_WRITE : 'true';
	}

	/////////////////////////////////////////////////
	// END OF CLASS tools
	/////////////////////////////////////////////////
}