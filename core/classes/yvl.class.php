<?php

/**
 * JobExpert v1.0
 * powered by Script Developers Group (SD-Group)
 * email: info@sd-group.org.ua
 * url: http://sd-group.org.ua/
 * Copyright 2010-2015 (c) SD-Group
 * All rights reserved
 * =========================================================
 * YVL
 * (Yandex Vacancy Language) - стандарт, разработанный Яндексом
 * для приема и публикации информации о вакансиях в базе данных
 * Яндекс.Работа (http://rabota.yandex.ru/).
 * YVL основан на стандарте XML (Extensible Markup Language).
 * =========================================================
 */
(!defined('SDG')) ? die('Triple protection!') : null;

class yvl {

	private $_host;
	private $_charset = 'UTF-8';
	private $_timeZone = 'GMT+3';
	private $_limit = '10000';

	public function __construct() {
		if (!defined(CONF_SCRIPT_URL)) {
			$this->_host = 'http://' . filesys::setPath($_SERVER['HTTP_HOST']);
		} else {
			$this->_host = CONF_SCRIPT_URL;
		}
	}

	public function rssVacancy($period = false) {
		// получаем объект вакансий
		global $vacancy;
		// получаем массив селекта "Раздел"
		global $arrDataSections;
		global $arrDataProfessions;
		// получаем массив селекта "Регион"
		global $arrDataRegions;
		global $arrDataCitys;
		$strWhere = $period ? "act_datetime>=DATE_ADD(CURRENT_TIMESTAMP, INTERVAL -" . $period . " DAY)" : false;
		$link = chpu::createChpuUrl($this->_host . 'index.php?do=yvl');
		$arrLimit = array('strLimit' => '0,' . $this->_limit, 'calcRows' => false);
		$arrVacancy = $vacancy->getActiveAnnounces($arrLimit, $strWhere);

		/*		 * *** Формируем XML-документ **** */
		$currDT = terms::currentDateTime();
		$data = '<?xml version="1.0" encoding="' . $this->_charset . '"?>' . "\n"
				. '<source creation-time="' . terms::currentDateTime() . ' ' . $this->_timeZone . '" host="' . $this->_host . '">' . "\n"
				. '  <vacancies>' . "\n";
		
		$defCurrency = 'USD';

		if (!empty($arrVacancy)) {
			foreach ($arrVacancy as $value) {
				$date = strtotime($value['act_datetime']) ? strtotime($value['act_datetime']) : time();
				// проверяем, если компания агентство, значит берем название агентства
				// если не агентство, смотрим, если не путое назв. комп, берем его
				// инчае ФИО
				if ($value['user_type'] === 'agent') {
					$agent = 'true';
					$name = $value['agent_name'];
				} else {
					$agent = 'false';
					if (!empty($value['company_name'])) {
						$name = $value['company_name'];
					} else {
						$name = $value['contacts_fio'];
					}
				}
				
				if (isset($arrDataCitys[$value['id_city']])) {
					$location = $arrDataRegions[$value['id_region']]['name'] .  ', ' . $arrDataCitys[$value['id_city']]['name'];
				} else {
					$location = $arrDataRegions[$value['id_region']]['name'];
				}
				
				// Проверяем зарплату. Проверяем только ЗП до
				// если пустое, значит оговаривается при собеседовании
				//$value['pay_from'] . $value['pay_post']
				$salary = !empty($value['pay_post']) ? $value['pay_post'] : 'оговаривается при собеседовании';

				$data .= '    <vacancy>' . "\n"
						. '      <url>' . chpu::createChpuUrl($this->_host . 'index.php?do=vacancy&amp;action=view&amp;id=' . $value['tId']) . '</url>' . "\n"
						. '      <creation-date>' . date('Y-m-d H:i:s', $date) . ' ' . $this->_timeZone . '</creation-date>' . "\n"
						. '      <salary>' . $salary . '</salary>' . "\n"
						. '      <currency>' .  (!empty($value['currency']) ? $value['currency'] : $defCurrency) . '</currency>' . "\n"
						. '      <category>' . "\n"
						. '        <industry>' . $arrDataSections[$value['id_section']]['name'] . '</industry>' . "\n"
						. '        <specialization>' . $arrDataProfessions[$value['id_profession']]['name'] . '</specialization>' . "\n"
						. '      </category>' . "\n"
						. '      <job-name>' . $value['title'] . '</job-name>' . "\n"
						. '      <addresses>' . "\n"
						. '        <address>' . "\n"
						. '          <location>' . $location  . '</location>' . "\n"
						. '        </address>' . "\n"
						. '      </addresses>' . "\n"
						. '      <company>' . "\n"
						. '        <name>' . $name . '</name>' . "\n"
						. '        <hr-agency>' . $agent . '</hr-agency>' . "\n"
						. '      </company>' . "\n"
						. '    </vacancy>' . "\n";
			}
		}

		$data .= '  </vacancies>' . "\n" . '</source>';
		return $data;
	}

}