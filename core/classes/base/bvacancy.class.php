<?php

/**
 * Powered by Script Developers Group (SD-Group)
 * Email: info@sd-group.org.ua
 * URL: http://sd-group.org.ua/
 * Copyright 2009 (c) SD-Group
 * All rights reserved
 * ===================================================
 * Базовый класс работы с вакансиями
 * ===================================================
 */
(!defined('SDG')) ? die('Triple protection!') : null;

/**
 * Класс работы с вакансиями
 */
class bvacancy extends announces {
	/////////////////////////////////////////////////
	// VARS - свойства класса bvacancy
	/////////////////////////////////////////////////

	/**
	 * Массив для хранения наименований и значений полей для записи в таблицу БД
	 * В этом массиве хранятся поля обязательные для заполнения
	 *
	 * @var array
	 */
	public $arrBindFields = array(
		'email' => '',
		'id_section' => '',
		'id_profession' => '',
		'id_region' => '',
		'id_city' => '',
		'user_type' => '',
		'act_period' => ''
	);

	/**
	 * Массив для хранения наименований и значений полей для записи в таблицу БД
	 * В этом массиве хранятся поля не обязательные для заполнения
	 *
	 * @var array
	 */
	public $arrNoBindFields = array(
		'public_email' => '',
		'subscription' => ''
	);

	/////////////////////////////////////////////////
	// CONSTRUCTOR - конструктор класса bvacancy
	/////////////////////////////////////////////////

	/**
	 * Конструктор
	 *
	 * Вызывает конструктор родительского класса
	 * Инициирует имя таблицы БД
	 */
	public function __construct() {
		$arrBindFields = filesys::getSerializedData('core/data/vacancy.bindfields.mda') or $arrBindFields = array();
		$arrNoBindFields = filesys::getSerializedData('core/data/vacancy.nobindfields.mda') or $arrNoBindFields = array();

		$this->arrBindFields = array_merge($this->arrBindFields, $arrBindFields);
		$this->arrNoBindFields = array_merge($this->arrNoBindFields, $arrNoBindFields);

		$this->setTable('vacancy');

		parent::__construct(array(
			'caching/vacancy.last.cache',
			'caching/vacancy.api.last.cache'
		));
	}

	/////////////////////////////////////////////////
	// METHODS - методы класса bvacancy
	/////////////////////////////////////////////////

	/**
	 * public функция возвращает массив полей обязательных для заполнения
	 *
	 * return array $arrBindFields
	 */
	public function getBindFields() {
		return $this->arrBindFields;
	}

	/**
	 * public функция возвращает массив полей не обязательных для заполнения
	 *
	 * return array $arrNoBindFields
	 */
	public function getNoBindFields() {
		return $this->arrNoBindFields;
	}

	/**
	 * public функция заполняет свойства $arroBindFields и $arrNoBindFields значениями из полученного массива
	 *
	 * return array $arrData
	 */
	public function setVacancyData($arrData) {
		if (is_array($arrData)) {
			foreach (array_intersect_key($arrData['data'], $this->arrBindFields) + array_intersect_key($arrData['job_conf'], $this->arrBindFields) as $key => $value) {
				$this->arrBindFields[$key] = $value;
			}

			foreach (array_intersect_key($arrData['data'], $this->arrNoBindFields) + array_intersect_key($arrData['job_conf'], $this->arrNoBindFields) as $key => $value) {
				$this->arrNoBindFields[$key] = $value;
			}

			$contacts_fio = (!isset($arrData['data'])) ? '' : $arrData['data']['last_name'] . ' ' . $arrData['data']['first_name'] . ' ' . $arrData['data']['middle_name'];

			if (isset($this->arrBindFields['contacts_fio'])) {
				$this->arrBindFields['contacts_fio'] = & $contacts_fio;
			} else {
				$this->arrNoBindFields['contacts_fio'] = & $contacts_fio;
			}

			$company_name = '';
			if ('agent' === $arrData['job_conf']['user_type']) {
				if (isset($this->arrBindFields['company_name'])) {
					$company_name = $this->arrBindFields['company_name'];
					$this->arrBindFields['company_name'] = '';
				} elseif (!empty($this->arrNoBindFields['company_name'])) {
					$company_name = $this->arrNoBindFields['company_name'];
					$this->arrNoBindFields['company_name'] = '';
				} else {
					$this->arrNoBindFields['company_name'] = $company_name;
				}

				if (isset($this->arrBindFields['agent_name'])) {
					$this->arrBindFields['agent_name'] = $company_name;
				} else {
					$this->arrNoBindFields['agent_name'] = $company_name;
				}
			}

			return true;
		} else {
			return false;
		}
	}

	/**
	 * public функция записывает данные объявления из БД в переменную переданную по ссылке
	 *
	 * @var reference - ссылка на переменную для записи данных объявления
	 *
	 * return bool
	 */
	public function setEditData(&$reference, $checkUserId = true) {
		$arrAnnData = $this->retAnnSubj();

		if (!empty($checkUserId) && !empty($arrAnnData['id_user']) && !isset($_SESSION['sd_user']['job_conf']['id'])) {
			die('<script type="text/javascript">window.location="' . chpu::createChpuUrl(CONF_SCRIPT_URL . 'index.php?do=authorize') . '";</script>');
		} elseif (!empty($checkUserId) && !empty($arrAnnData['id_user']) && $_SESSION['sd_user']['job_conf']['id'] !== $arrAnnData['id_user']) {
			return false;
		} else {
			$reference['arrServiceFields'] = array_diff_key($arrAnnData, $this->arrBindFields, $this->arrNoBindFields);
		}

		$reference['arrBindFields'] = array_intersect_key($arrAnnData, $this->arrBindFields);
		$reference['arrNoBindFields'] = array_intersect_key($arrAnnData, $this->arrNoBindFields);

		return true;
	}

	public function viewAnnounce($id) {
		if (!strings::ifInt($id) || !$this->getAnnounceById($id, "token IN ('active')")) {
			return false;
		} else {
			parent::viewAnnounce();
			return true;
		}
	}

	public function getActiveAnnounces($arrLimit, $strWhere = false) {
		return $this->getAnnouncesByToken('active', $strWhere, $arrLimit);
	}

	public function getVipAnnounces() {
		//return $this -> getAnnouncesByToken('active', 'vip', array('strLimit' => '0, ' . CONF_VACANCY_VIP_SHOW_PERPAGE, 'calcRows' => true), array('rate' => 'DESC', 'vip_unset_datetime' => 'DESC', 'RAND()' => false));
		return $this->getAnnouncesByToken('active', 'vip', array('strLimit' => '0, ' . CONF_VACANCY_VIP_SHOW_PERPAGE, 'calcRows' => true), array('RAND()' => false));
	}

	public function getHotAnnounces() {
		//return $this -> getAnnouncesByToken('active', 'hot', array('strLimit' => '0, ' . CONF_VACANCY_HOT_SHOW_PERPAGE, 'calcRows' => true), array('rate' => 'DESC', 'hot_unset_datetime' => 'DESC', 'RAND()' => false));
		return $this->getAnnouncesByToken('active', 'hot', array('strLimit' => '0, ' . CONF_VACANCY_HOT_SHOW_PERPAGE, 'calcRows' => true), array('RAND()' => false));
	}

	public function getLastAnnounces() {
		$result = false;

		if (CONF_ENABLE_CACHING) {
			if (false === ($result = caching::getCahing('caching/vacancy.last.cache'))) {
				$result = $this->getAnnouncesByToken('active', '!vip AND !hot', array('strLimit' => '0, ' . CONF_VACANCY_LAST_SHOW_PERPAGE, 'calcRows' => false), array('act_datetime' => 'DESC'));

				(empty($result)) ? $result = array() : null;

				caching::setCaching('caching/vacancy.last.cache', $result);
			}
		} else {
			$result = $this->getAnnouncesByToken('active', '!vip AND !hot', array('strLimit' => '0, ' . CONF_VACANCY_LAST_SHOW_PERPAGE, 'calcRows' => false), array('act_datetime' => 'DESC'));
		}

		return $result;
	}

	public function getApiLastAnnounces($arrParams = false) {
		$returnData = false;

		$cacheFileName = 'caching/vacancy.api.last.cache';
		$strWhere = "!vip AND !hot";

		if (!empty($arrParams['limit']) && strings::ifInt($arrParams['limit'])) {
			$limit = $arrParams['limit'];
		} else {
			$limit = CONF_VACANCY_LAST_SHOW_PERPAGE;
		}

		if (false === ($result = caching::getCahing($cacheFileName)) || $limit > count($result)) {
			$result = $this->getAnnouncesByToken('active', $strWhere, array('strLimit' => '0, ' . $limit, 'calcRows' => false), array('act_datetime' => 'DESC'));

			(empty($result)) ? $result = array() : null;

			foreach ($result as $id => &$announce) {
				if (empty($announce['public_email'])) {
					unset(
							$announce['email']
					);
				}

				/**
				 * инициализация списка разделов
				 */
				global $sections;
				$arrDataSections = $sections->retCategorys();

				/**
				 * инициализация списка профессий
				 */
				global $professions;
				$arrDataProfessions = $professions->retCategorysByIds($announce['id_profession']);

				/**
				 * инициализация списка регионов
				 */
				global $regions;
				$arrDataRegions = $regions->retCategorys();

				/**
				 * инициализация списка городов
				 */
				global $citys;
				$arrDataCitys = $citys->retCategorysByIds($announce['id_city']);

				$announce['section'] = @$arrDataSections[$announce['id_section']]['name'];
				$announce['profession'] = @$arrDataProfessions[$announce['id_profession']]['name'];
				$announce['region'] = @$arrDataRegions[$announce['id_region']]['name'];
				$announce['city'] = @$arrDataCitys[$announce['id_city']]['name'];

				unset(
						$announce['xml_data'], $announce['id_section'], $announce['id_profession'], $announce['id_region'], $announce['id_city'], $announce['unikey'], $announce['id_user'], $announce['public_email'], $announce['act_period'], $announce['subscription'], $announce['vip'], $announce['vip_unset_datetime'], $announce['hot'], $announce['hot_unset_datetime'], $announce['rate'], $announce['cnt_views_total'], $announce['cnt_views_temp'], $announce['cnt_views_temp_datetime'], $announce['cnt_views_last_ip'], $announce['token'], $announce['token_datetime'], $announce['comments']
				);
			}

			caching::setCaching($cacheFileName, $result);
		}

		$result = array_slice($result, 0, $limit);

		$returnData = array('vacancy' => &$result);

		return $returnData;
	}

	// перегрузка методов родительских классов
	public function cntAnnounces($strWhere = false) {
		return parent::cntAnnounces($strWhere);
	}

	public function getAnnounces($strWhere, $arrLimit, $arrOrder = false) {
		return parent::getAnnounces($strWhere, $arrOrder, $arrLimit);
	}

	public function getAnnouncesByToken($token, $strWhere, $arrLimit, $arrOrder = false) {
		return parent::getAnnouncesByToken($token, $strWhere, $arrOrder, $arrLimit);
	}

	public function getAnnDataByCurrUser() {
		return parent::getAnnDataByCurrUser();
	}

	public function getAnnounceById($id, $strWhere = false) {
		return parent::getAnnounceById($id, $strWhere);
	}

	public function getAnnounceByUnikey($unikey, $strWhere = false) {
		return parent::getAnnounceByUnikey($unikey, $strWhere);
	}

	public function retAnnSubj() {
		return parent::retAnnSubj();
	}

	public function retSortFields() {
		return parent::retSortFields();
	}

	public function putSortFields($arrData) {
		return parent::putSortFields($arrData);
	}

	public function recAnnounce() {
		return parent::recAnnounce($this->arrBindFields, $this->arrNoBindFields);
	}

	public function editAnnounce($unikey) {
		return parent::editAnnounce($unikey, $this->arrBindFields, $this->arrNoBindFields);
	}

	public function editAnnounceService($arrBindFields, $arrNoBindFields, $arrServiceFields) {
		return parent::editAnnounceService($arrBindFields, $arrNoBindFields, $arrServiceFields);
	}

	public function issetAnnounce($unikey, $strWhere = false) {
		return parent::issetAnnounce($unikey, $strWhere);
	}

	public function actAnnounce($unikey) {
		return parent::actAnnounce($unikey);
	}

	public function paymentAnnounce($id) {
		return parent::paymentAnnounce($id);
	}

	public function actionAnnounces($arrData, $sendEmails = true) {
		return parent::actionAnnounces($arrData, $sendEmails);
	}

	public function controlAnnounces($strWhere, $action) {
		return parent::controlAnnounces($strWhere, $action);
	}

	public function delAnnounces($strWhere = false) {
		return parent::delAnnounces($strWhere);
	}

	public function setVip($id) {
		return parent::setVip($id);
	}

	public function resetVip($id) {
		return parent::resetVip($id);
	}

	public function setHot($id) {
		return parent::setHot($id);
	}

	public function resetHot($id) {
		return parent::resetHot($id);
	}

	public function setRate($id) {
		return parent::setRate($id);
	}

	public function resetRate($id) {
		return parent::resetRate($id);
	}

	public function incViewCounts() {
		return parent::incViewCounts();
	}

	/////////////////////////////////////////////////
	// END OF CLASS bvacancy
	/////////////////////////////////////////////////
}
