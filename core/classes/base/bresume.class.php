<?php

/**
 * Powered by Script Developers Group (SD-Group)
 * Email: info@sd-group.org.ua
 * URL: http://sd-group.org.ua/
 * Copyright 2009 (c) SD-Group
 * All rights reserved
 * ===================================================
 * Базовый класс работы с резюме
 * ===================================================
 */
(!defined('SDG')) ? die('Triple protection!') : null;

/**
 * Класс работы с резюме
 */
class bresume extends announces {
	/////////////////////////////////////////////////
	// VARS - свойства класса bresume
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
		'act_period' => '',
		'visibility' => ''
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
	/*	 * array
	 * Массив для хранения наименований и значений полей для таблицы БД хранимых в XML-формате
	 * В этом свойсте хранятся массивы наименований полей (ключи массива) с обязательными и не обязательными для заполнения полями
	 *
	 * @var array
	 */
	public $arrFieldsXmlData = array(
		'educations' => null,
		'expires' => null,
		'languages' => null
	);

	/////////////////////////////////////////////////
	// CONSTRUCTOR - конструктор класса bresume
	/////////////////////////////////////////////////

	/**
	 * Конструктор
	 *
	 * Вызывает конструктор родительского класса
	 * Инициирует имя таблицы БД
	 * Инициирует массив данных хранимых в XML-формате
	 *
	 */
	public function __construct() {
		$arrBindFields = filesys::getSerializedData('core/data/resume.bindfields.mda') or $arrBindFields = array();
		$arrNoBindFields = filesys::getSerializedData('core/data/resume.nobindfields.mda') or $arrNoBindFields = array();

		$this->arrBindFields = array_merge($this->arrBindFields, $arrBindFields);
		$this->arrNoBindFields = array_merge($this->arrNoBindFields, $arrNoBindFields);
		$this->arrFieldsXmlData['educations'][1] = filesys::getSerializedData('core/data/resume.education.mda') or $this->arrFieldsXmlData['educations'][1] = array();
		$this->arrFieldsXmlData['expires'][1] = filesys::getSerializedData('core/data/resume.expire.mda') or $this->arrFieldsXmlData['expires'][1] = array();
		$this->arrFieldsXmlData['languages'][2] = $this->arrFieldsXmlData['languages'][1] = filesys::getSerializedData('core/data/resume.language.mda') or $this->arrFieldsXmlData['languages'][2] = $this->arrFieldsXmlData['languages'][1] = array();

		$this->setTable('resume');

		parent::__construct(array(
			'caching/resume_m.last.cache',
			'caching/resume_v.last.cache',
			'caching/resume.api.last.cache'
		));
	}

	/////////////////////////////////////////////////
	// METHODS - методы класса vacancy
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
	 * public функция возвращает массив подчиненных таблиц
	 *
	 * return array $arrFieldsXmlData
	 */
	public function getFieldsXmlData() {
		return $this->arrFieldsXmlData;
	}

	/**
	 * public функция заполняет свойства $arroBindFields и $arrNoBindFields значениями из полученного массива
	 *
	 * return bool
	 */
	public function setResumeData($arrData) {
		if (is_array($arrData)) {
			if (isset($arrData['job_conf']['user_type']) && 'agent' === $arrData['job_conf']['user_type']) {
				unset($arrData['data']['first_name'], $arrData['data']['last_name'], $arrData['data']['middle_name'], $arrData['data']['birthday']);
			}

			foreach (array_intersect_key($arrData['data'], $this->arrBindFields) + array_intersect_key($arrData['job_conf'], $this->arrBindFields) as $key => $value) {
				$this->arrBindFields[$key] = $value;
			}

			foreach (array_intersect_key($arrData['data'], $this->arrNoBindFields) + array_intersect_key($arrData['job_conf'], $this->arrNoBindFields) as $key => $value) {
				$this->arrNoBindFields[$key] = $value;
			}

			if (isset($arrData['data']['birthday'])) {
				$arrBirthday = explode('-', $arrData['data']['birthday']);
				$age = (int) (time() - mktime(0, 0, 0, $arrBirthday[1], $arrBirthday[2], $arrBirthday[0])) / 31556926;

				if (isset($this->arrBindFields['birthday'])) {
					$this->arrBindFields['birthday'] = $arrData['data']['birthday'];
				} elseif (isset($this->arrNoBindFields['birthday'])) {
					$this->arrNoBindFields['birthday'] = $arrData['data']['birthday'];
				}

				if (isset($this->arrBindFields['age'])) {
					$this->arrBindFields['age'] = (string) $age;
				} elseif (isset($this->arrNoBindFields['age'])) {
					$this->arrNoBindFields['age'] = (string) $age;
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

		if (!empty($checkUserId)) {
			if (!empty($arrAnnData['id_user']) && empty($_SESSION['sd_user']['job_conf']['id'])) {
				die('<script type="text/javascript">window.location="' . chpu::createChpuUrl(CONF_SCRIPT_URL . 'index.php?do=authorize') . '";</script>');
			}

			if (!empty($arrAnnData['id_user']) && $_SESSION['sd_user']['job_conf']['id'] != $arrAnnData['id_user']) {
				return false;
			}

			if (!empty($arrAnnData['image'])) {
				foreach (explode(',', $arrAnnData['image']) as $image) {
					@copy('uploads/images/photos/' . $image, 'uploads/temporary/' . $image);
				}
			}
		} else {
			$reference['arrServiceFields'] = array_diff_key($arrAnnData, $this->arrBindFields, $this->arrNoBindFields);
		}

		$reference['arrBindFields'] = array_intersect_key($arrAnnData, $this->arrBindFields);
		$reference['arrNoBindFields'] = array_intersect_key($arrAnnData, $this->arrNoBindFields);

		if (is_array($this->arrFieldsXmlData) && !empty($this->arrFieldsXmlData)) {
			foreach ($this->arrFieldsXmlData as $nameField => &$contentField) {
				if (!empty($arrAnnData[$nameField])) {
					foreach ($arrAnnData[$nameField] as $key => &$valFields) {
						$reference['arrFieldsXmlData'][$nameField][$key]['arrBindFields'] = (isset($contentField[1]['arrBindFields'])) ? array_intersect_key($valFields, $contentField[1]['arrBindFields']) : false;
						$reference['arrFieldsXmlData'][$nameField][$key]['arrNoBindFields'] = (isset($contentField[1]['arrNoBindFields'])) ? array_intersect_key($valFields, $contentField[1]['arrNoBindFields']) : false;
					}
				} else {
					$reference['arrFieldsXmlData'][$nameField] = false;
				}
			}
		}

		return true;
	}

	public function viewAnnounce($id) {
		$strWhere = (!empty($_SESSION['sd_user']['job_conf']['id'])) ? "token IN ('active') AND visibility IN ('visible','visiblehc','members','membershc')" : "token IN ('active') AND visibility IN ('visible','visiblehc')";

		if (!strings::ifInt($id) || !$this->getAnnounceById($id, $strWhere)) {
			return false;
		} else {
			parent::viewAnnounce();
			return true;
		}
	}

	public function getActiveAnnounces($arrLimit, $strWhere = false) {
		$visibility = (!empty($_SESSION['sd_user']['job_conf']['id'])) ? "visibility IN ('visible','visiblehc','members','membershc')" : "visibility IN ('visible','visiblehc')";

		(!empty($strWhere)) ? $strWhere = $visibility . ' AND ' . $strWhere : $strWhere = & $visibility;

		return $this->getAnnouncesByToken('active', $strWhere, $arrLimit);
	}

	public function getVipAnnounces() {
		$strWhere = (!empty($_SESSION['sd_user']['job_conf']['id'])) ? "vip AND visibility IN ('visible','visiblehc','members','membershc')" : "vip AND visibility IN ('visible','visiblehc')";

		//return $this -> getAnnouncesByToken('active', $strWhere, array('strLimit' => '0, ' . CONF_RESUME_VIP_SHOW_PERPAGE, 'calcRows' => true), array('rate' => 'DESC', 'vip_unset_datetime' => 'DESC', 'RAND()' => false));
		return $this->getAnnouncesByToken('active', $strWhere, array('strLimit' => '0, ' . CONF_RESUME_VIP_SHOW_PERPAGE, 'calcRows' => true), array('RAND()' => false));
	}

	public function getHotAnnounces() {
		$strWhere = (!empty($_SESSION['sd_user']['job_conf']['id'])) ? "hot AND visibility IN ('visible','visiblehc','members','membershc')" : "hot AND visibility IN ('visible','visiblehc')";

		//return $this -> getAnnouncesByToken('active', $strWhere, array('strLimit' => '0, ' . CONF_RESUME_HOT_SHOW_PERPAGE, 'calcRows' => true), array('rate' => 'DESC', 'hot_unset_datetime' => 'DESC', 'RAND()' => false));
		return $this->getAnnouncesByToken('active', $strWhere, array('strLimit' => '0, ' . CONF_RESUME_HOT_SHOW_PERPAGE, 'calcRows' => true), array('RAND()' => false));
	}

	public function getLastAnnounces() {
		$result = false;

		$strWhere = (!empty($_SESSION['sd_user']['job_conf']['id'])) ? "!vip AND !hot AND visibility IN ('visible','visiblehc','members','membershc')" : "!vip AND !hot AND visibility IN ('visible','visiblehc')";

		if (CONF_ENABLE_CACHING) {
			$cacheFileName = (!empty($_SESSION['sd_user']['job_conf']['id'])) ? 'caching/resume_m.last.cache' : 'caching/resume_v.last.cache';

			if (false === ($result = caching::getCahing($cacheFileName))) {
				$result = $this->getAnnouncesByToken('active', $strWhere, array('strLimit' => '0, ' . CONF_RESUME_LAST_SHOW_PERPAGE, 'calcRows' => false), array('act_datetime' => 'DESC'));

				(empty($result)) ? $result = array() : null;

				caching::setCaching($cacheFileName, $result);
			}
		} else {
			$result = $this->getAnnouncesByToken('active', $strWhere, array('strLimit' => '0, ' . CONF_RESUME_LAST_SHOW_PERPAGE, 'calcRows' => false), array('act_datetime' => 'DESC'));
		}

		return $result;
	}

	public function getApiLastAnnounces($arrParams = false) {
		$returnData = false;

		$cacheFileName = 'caching/resume.api.last.cache';
		$strWhere = "!vip AND !hot AND visibility IN ('visible','visiblehc')";

		if (!empty($arrParams['limit']) && strings::ifInt($arrParams['limit'])) {
			$limit = $arrParams['limit'];
		} else {
			$limit = CONF_VACANCY_LAST_SHOW_PERPAGE;
		}

		if (false === ($result = caching::getCahing($cacheFileName)) || $limit > count($result)) {
			$result = $this->getAnnouncesByToken('active', $strWhere, array('strLimit' => '0, ' . $limit, 'calcRows' => false), array('act_datetime' => 'DESC'));

			(empty($result)) ? $result = array() : null;

			foreach ($result as $id => &$announce) {
				if ('visiblehc' === $announce['visibility']) {
					unset(
							$announce['first_name'], $announce['last_name'], $announce['middle_name'], $announce['phone'], $announce['note_phone'], $announce['addition_phone_1'], $announce['note_addition_phone_1'], $announce['addition_phone_2'], $announce['note_addition_phone_2'], $announce['image'], $announce['video']
					);
				}

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
				$arrDataProfessions = $professions->retCategorysByIds(
						array(
							$announce['id_profession'],
							$announce['id_profession_1'],
							$announce['id_profession_2']
						)
				);

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
				$announce['profession_1'] = @$arrDataProfessions[$announce['id_profession_1']]['name'];
				$announce['profession_2'] = @$arrDataProfessions[$announce['id_profession_2']]['name'];
				$announce['region'] = @$arrDataRegions[$announce['id_region']]['name'];
				$announce['city'] = @$arrDataCitys[$announce['id_city']]['name'];

				unset(
						$announce['xml_data'], $announce['id_section'], $announce['id_profession'], $announce['id_profession_1'], $announce['id_profession_2'], $announce['id_region'], $announce['id_city'], $announce['unikey'], $announce['id_user'], $announce['public_email'], $announce['birthday'], $announce['act_period'], $announce['subscription'], $announce['vip'], $announce['vip_unset_datetime'], $announce['hot'], $announce['hot_unset_datetime'], $announce['rate'], $announce['cnt_views_total'], $announce['cnt_views_temp'], $announce['cnt_views_temp_datetime'], $announce['cnt_views_last_ip'], $announce['token'], $announce['token_datetime'], $announce['visibility'], $announce['comments']
				);
			}

			caching::setCaching($cacheFileName, $result);
		}

		$result = array_slice($result, 0, $limit);

		$returnData = array('resume' => &$result);

		return $returnData;
	}

	/**
	 * Перегрузка методов родительских классов
	 */
	public function cntAnnounces($strWhere = false) {
		return parent::cntAnnounces($strWhere);
	}

	public function getAnnounces($strWhere, $arrLimit, $arrOrder = false) {
		return parent::getAnnounces($strWhere, $arrOrder, $arrLimit);
	}

	public function getAnnouncesByToken($token, $strWhere, $arrLimit, $arrOrder = false) {
		return parent::getAnnouncesByToken($token, $strWhere, $arrOrder, $arrLimit, $this->arrFieldsXmlData);
	}

	public function getAnnounceById($id, $strWhere = false) {
		return parent::getAnnounceById($id, $strWhere, $this->arrFieldsXmlData);
	}

	public function getAnnounceByUnikey($unikey, $strWhere = false) {
		return parent::getAnnounceByUnikey($unikey, $strWhere, $this->arrFieldsXmlData);
	}

	public function getAnnDataByCurrUser() {
		return parent::getAnnDataByCurrUser();
	}

	public function getUserAnnounces($token, $arrLimit = false) {
		return parent::getUserAnnounces($token, $arrLimit, $this->arrFieldsXmlData);
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
		return parent::recAnnounce($this->arrBindFields, $this->arrNoBindFields, $this->arrFieldsXmlData);
	}

	public function editAnnounce($unikey) {
		return parent::editAnnounce($unikey, $this->arrBindFields, $this->arrNoBindFields, $this->arrFieldsXmlData);
	}

	public function editAnnounceService($arrBindFields, $arrNoBindFields, $arrServiceFields, $arrFieldsXmlData) {
		return parent::editAnnounceService($arrBindFields, $arrNoBindFields, $arrServiceFields, $arrFieldsXmlData);
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

	public function setVisibility($visibility, $listId = false) {
		return parent::setVisibility($visibility, $listId);
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

	/////////////////////////////////////////////////
	// END OF CLASS bresume
	/////////////////////////////////////////////////
}
