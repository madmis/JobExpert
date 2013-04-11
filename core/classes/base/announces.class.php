<?php

/**
 * Powered by Script Developers Group (SD-Group)
 * Email: info@sd-group.org.ua
 * URL: http://sd-group.org.ua/
 * Copyright 2010-2015 (c) SD-Group
 * All rights reserved
 * ======================================================
 * Базовый класс работы с объявлениями - Вакансии/Резюме
 * ======================================================
 *
 * @package
 *
 * @todo
 *
 */
(!defined('SDG')) ? die('Triple protection!') : null;

/**
 * Базовый класс работы с объявлениями - Вакансии/Резюме
 */
abstract class announces extends tbentrys {
	/////////////////////////////////////////////////
	// VARS - свойства класса announces
	/////////////////////////////////////////////////

	/**
	 * $arrServiceFields - свойство для хранения массива сервисных полей в БД таблицах объявлений
	 * Массив иницирован наименованиями служебных полей таблицы
	 *
	 * @var array
	 */
	private $arrServiceFields = array(
		'unikey' => '',
		'id_user' => '',
		'xml_data' => '',
		'act_datetime' => '',
		'vip' => '',
		'vip_unset_datetime' => '',
		'hot' => '',
		'hot_unset_datetime' => '',
		'rate' => '',
		'video' => '',
		'cnt_views_total' => '',
		'cnt_views_temp' => '',
		'cnt_views_temp_datetime' => '',
		'cnt_views_last_ip' => '',
		'token' => '',
		'token_datetime' => '',
		'comments' => '',
		'meta_keywords' => '',
		'meta_description' => ''
	);

	/**
	 * $arrSortFields - свойство для хранения массива сервисных полей, которые могут быть использованы для сортировки результата запросов к БД
	 * Массив иницирован наименованиями служебных полей таблицы используемых при сортировке
	 *
	 * @var array
	 */
	private $arrSortFields = array(
		'vip' => '',
		'hot' => '',
		'rate' => '',
		'act_datetime' => '',
		'cnt_views_temp' => '',
		'cnt_views_total' => ''
	);

	/**
	 * private $annData: свойство хранит служебные данные
	 *
	 * @var array
	 */
	private $annData;

	/**
	 * private $arrPayments: свойство хранит массив платных услуг
	 *
	 * @var array
	 */
	private $arrPayments;

	/**
	 * private $subscription: свойство хранит объект класса подписок
	 *
	 * @var array
	 */
	private $subscription;

	/**
	 * private $arrSortAnnList: свойство хранит массив сортировки объявлений используемый в запросах к БД
	 *
	 * @var array
	 */
	private $arrAnnSortList;

	/////////////////////////////////////////////////
	// CONSTRUCTOR - конструктор класса announces
	/////////////////////////////////////////////////

	/**
	 * конструктор
	 *
	 * Инициирует private свойства $arrPayments и $subscription
	 *
	 */
	protected function __construct($arrCacheFilesAdd = false) {
		// инициируем список платных услуг
		(!empty($GLOBALS['arrPayments'])) ? $this->arrPayments = &$GLOBALS['arrPayments'] : null;
		// инициируем объект подписки
		$this->subscription = new subscription();
		// инициируем массив сортировки
		(!$this->arrAnnSortList = filesys::getSerializedData('core/data/' . $this->retTableName() . '.list.sort.mda')) ? $this->arrAnnSortList = array('act_datetime' => 'ASC') : null;

		// массив (список) файлов кешируемых данных
		$arrCacheFiles = array();
		if (!CONF_DISABLE_AUTO_COUNTERS) {
			$arrCacheFiles = array(
				'caching/region.cache',
				'caching/city.cache',
				'caching/section.cache',
				'caching/profession.cache',
				'caching/statistic.cache'
			);
		}
		// добавляем в список данные
		(!empty($arrCacheFilesAdd) && is_array($arrCacheFilesAdd)) ? $arrCacheFiles = array_merge($arrCacheFiles, $arrCacheFilesAdd) : null;

		// формируем массив параметров для вызова конструктора родительского класса
		$arrParams = array(
			'arrCacheFiles' => &$arrCacheFiles,
			'tIdForce' => true
		);

		// вызываем конструктор родительского класса
		parent::__construct($arrParams);
	}

	/////////////////////////////////////////////////
	// METHODS - методы класса announces
	/////////////////////////////////////////////////

	/**
	 * protected функция проверки существования объвления по уникальному ключу
	 * Запрос по параметрам unikey и token!='deleted'
	 *
	 * @param string $unikey
	 *
	 * @return bool
	 */
	protected function issetAnnounce(&$unikey, &$strWhere) {
		(!empty($strWhere)) ? $strWhere .= " AND unikey IN (" . secure::escQuoteData($unikey) . ") AND token NOT IN ('deleted')" : $strWhere = "unikey IN (" . secure::escQuoteData($unikey) . ") AND token NOT IN ('deleted')";

		return $this->issetRow($strWhere);
	}

	/**
	 * protected функция подсчитывает количество объявлений в соответствии с условием $strWhere
	 * возвращает количество строк результата запроса
	 *
	 * @param (string) $strWhere - условие WHERE для запроса or false
	 *
	 * @return int количество строк результата запроса
	 */
	protected function cntAnnounces(&$strWhere) {
		return (!$strWhere) ? $this->calcFoundRows() : $this->cntEntrys($strWhere);
	}

	/**
	 * protected функция возвращает массив хранящийся в свойстве $annData
	 *
	 * return (array) $annData
	 */
	protected function retAnnSubj() {
		return (!$this->annData || !is_array($this->annData)) ? false : $this->annData;
	}

	/**
	 * protected функция возвращает массив хранящийся в свойстве $arrSortFields
	 *
	 * return (array) $arrSortFields
	 */
	protected function retSortFields() {
		foreach ($this->arrAnnSortList + $this->arrSortFields as $key => $val) {
			$arrData[] = array(
				'discription' => @constant('ANNOUNCE_SORT_BY_' . strtoupper($key)),
				'sortField' => $key,
				'sortOrder' => $val
			);
		}

		return $arrData;
	}

	/**
	 * protected функция записывает в файл массив полей для сортировки объявлений в сериализованном виде
	 *
	 * @param (string) $arrData - данные для сериализации
	 *
	 * return bool
	 */
	protected function putSortFields(&$arrData) {
		if (is_array($arrData) && !array_diff_key($arrData, $this->arrSortFields)) {
			return filesys::putSerializedData('core/data/' . $this->retTableName() . '.list.sort.mda', $arrData);
		} else {
			return false;
		}
	}

	/**
	 * protected функция получает данные объявлений, по заданным параметрам из таблицы БД
	 *
	 * @return array or bool
	 */
	protected function getAnnounces(&$strWhere, &$arrOrderBy, &$arrLimit, &$arrFieldsXmlData = false) {
		(!is_array($arrOrderBy)) ? $arrOrderBy = &$this->arrAnnSortList : null;

		if (!$this->getEntrys($strWhere, $arrOrderBy, $arrLimit, false)) {
			return false;
		} else {
			$this->annData = $this->retData();
			$this->getXmlData($arrFieldsXmlData, true);

			return $this->annData;
		}
	}

	/**
	 * protected функция получает данные объявления из таблицы БД по id
	 *
	 * @param integer $id
	 * @param array $arrFieldsXmlData - массив полей данные которых храняться в XML-формате(необязательный параметр)
	 *
	 * @return bool
	 */
	protected function getAnnounceById(&$id, &$strWhere, &$arrFieldsXmlData = false) {
		(!empty($strWhere)) ? $strWhere .= " AND id IN (" . secure::escQuoteData($id) . ")" : $strWhere = "id IN (" . secure::escQuoteData($id) . ")";

		if (!$this->getEntry($strWhere)) {
			return false;
		} else {
			$this->annData = $this->retDataSubj();

			return (!is_array($arrFieldsXmlData)) ? true : $this->getXmlData($arrFieldsXmlData);
		}
	}

	/**
	 * protected функция получает данные объявления из таблицы БД по unikey
	 *
	 * @param string $unikey
	 * @param array $arrFieldsXmlData - массив полей данные которых храняться в XML-формате(необязательный параметр)
	 *
	 * @return bool
	 */
	protected function getAnnounceByUnikey(&$unikey, &$strWhere, &$arrFieldsXmlData = false) {
		$unikey = (string) substr(trim($unikey), 0, 32);

		(!empty($strWhere)) ? $strWhere .= " AND unikey IN (" . secure::escQuoteData($unikey) . ")" : $strWhere = "unikey IN (" . secure::escQuoteData($unikey) . ")";

		if (32 !== strlen($unikey) || !ctype_alnum($unikey) || !$this->getEntry($strWhere)) {
			return false;
		} else {
			$this->annData = $this->retDataSubj();

			return (!is_array($arrFieldsXmlData)) ? true : $this->getXmlData($arrFieldsXmlData);
		}
	}

	/**
	 * protected функция получает данные объявлений с указанным токеном, по заданным параметрам из таблицы БД
	 *
	 * @return array or bool
	 */
	protected function getAnnouncesByToken(&$token, &$strWhere, &$arrOrderBy, &$arrLimit, &$arrFieldsXmlData = false) {
		if (!empty($token) && is_string($token)) {
			(!empty($strWhere)) ? $strWhere .= " AND token IN (" . secure::escQuoteData($token) . ")" : $strWhere = "token IN (" . secure::escQuoteData($token) . ")";

			(empty($arrOrderBy) || !is_array($arrOrderBy)) ? $arrOrderBy = &$this->arrAnnSortList : null;

			if (!$this->getEntrys($strWhere, $arrOrderBy, $arrLimit, false)) {
				return false;
			} else {
				$this->annData = $this->retData();
				$this->getXmlData($arrFieldsXmlData, true);

				return $this->annData;
			}
		} else {
			return false;
		}
	}

	/**
	 * protected функция получает данные объявлений для авторизированного пользователя
	 *
	 * @return array or bool
	 */
	protected function getAnnDataByCurrUser() {
		if (!empty($_SESSION['sd_user']['data']['id'])) {
			$strWhere = "id_user IN (" . secure::escQuoteData($_SESSION['sd_user']['data']['id']) . ") AND token IN ('active')";
			$arrFields = array('unikey', 'title');

			return ($this->getEntrys($strWhere, false, false, $arrFields)) ? $this->retData() : false;
		} else {
			return false;
		}
	}

	/**
	 * protected функция получает данные объявлений для просмотра в кабинете пользователя
	 *
	 * @return array or bool
	 */
	public function getUserAnnounces(&$token, &$arrLimit) {
		if (!empty($_SESSION['sd_user']['job_conf']['id'])) {
			$strWhere = "id_user IN ('" . $_SESSION['sd_user']['job_conf']['id'] . "')";
			$this->getAnnouncesByToken($token, $strWhere, $arrLimit);

			if (!empty($this->annData) && is_array($this->annData)) {

				$arrAnnIds = array_keys($this->annData);

				$storing = new storing();

				$arrData = array(
					'type' => $this->retTableName(),
					'arrIds' => $arrAnnIds
				);

				$storingData = $storing->getStoringData($arrData);

				if (!empty($storingData) && is_array($storingData)) {
					foreach ($storingData as &$sData) {
						$idContent = &$sData['id_content'];

						unset($sData['id'], $sData['id_content']);

						if (defined('CONF_ENABLE_CHPU') && defined('CONF_ENABLE_TRANSLITERATION_CHPU') && CONF_ENABLE_CHPU && CONF_ENABLE_TRANSLITERATION_CHPU && !empty($sData['company_name'])) {
							$sData['tId'] = (CONF_TRANSLITERATION_CHPU_ID_PUT_TO_END) ? strings::str2url($sData['company_name']) . '-' . $sData['id_user'] : $sData['id_user'] . '-' . strings::str2url($sData['company_name']);
						} else {
							$sData['tId'] = &$sData['id_user'];
						}

						$this->annData[$idContent]['storing'][] = &$sData;
					}
				}

				foreach ($this->annData as &$aData) {
					if (!isset($aData['storing'])) {
						$aData['storing'] = false;
					}
				}

				return $this->annData;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}

	/**
	 * protected функция производит запись данных в таблицу БД
	 * Производит запись в таблицу подписки, если необходимо
	 * Рассылает почтовые сообщения
	 *
	 * @param array $arrBindFields - массив полей обязательных для заполнения
	 * @param array $arrNoBindFields - массив полей не обязательных для заполнения
	 * @param array $arrFieldsXmlData - массив полей данные которых храняться в XML-формате
	 *
	 * @return bool
	 */
	protected function recAnnounce(&$arrBindFields, &$arrNoBindFields, &$arrFieldsXmlData = false) {
		$typeAnnounce = $this->retTableName();

		if (!empty($arrBindFields['image']) && !$this->imageProcessing($typeAnnounce, $arrBindFields['image'])) {
			return false;
		} elseif (!empty($arrNoBindFields['image']) && !$this->imageProcessing($typeAnnounce, $arrNoBindFields['image'])) {
			return false;
		}

		$this->arrServiceFields['unikey'] = strings::getUnikey($arrBindFields);

		$this->arrServiceFields['id_user'] = (empty($_SESSION['sd_user']['data']['id']) || !$id_user = (int) $_SESSION['sd_user']['data']['id']) ? 0 : $id_user;

		if (!empty($_SESSION['sd_' . DB_PREFIX . 'codex']['resp']['act_' . $typeAnnounce])) {
			$this->arrServiceFields['token'] = 'new';
			$this->arrServiceFields['token_datetime'] = terms::calcDateTimeOfTerm(constant('CONF_' . strtoupper($typeAnnounce) . '_ACTIVATE_THERM'));
		} elseif (!empty($_SESSION['sd_' . DB_PREFIX . 'codex']['resp']['moder_' . $typeAnnounce])) {
			$this->arrServiceFields['token'] = 'moderate';
			$this->arrServiceFields['token_datetime'] = terms::currentDateTime();
		} elseif (!empty($this->arrPayments['add_' . $typeAnnounce])) {
			$this->arrServiceFields['token'] = 'payment';
			$this->arrServiceFields['token_datetime'] = terms::calcDateTimeOfTerm(constant('CONF_' . strtoupper($typeAnnounce) . '_PAYMENT_THERM'));
		} else {
			$this->arrServiceFields['token'] = 'active';
			$this->arrServiceFields['token_datetime'] = terms::calcDateTimeOfTerm($arrBindFields['act_period'] * 24);
			$this->arrServiceFields['act_datetime'] = terms::currentDateTime();
		}

		if (!is_array($arrFieldsXmlData)) {
			unset($this->arrServiceFields['xml_data']);
		} else {
			$this->formXmlData($arrFieldsXmlData);
		}

		/**
		 * инициализация списка разделов
		 */
		global $sections;
		$arrDataSections = $sections->retCategorys();

		global $professions;
		$arrDataProfession = $professions->retCategorysByIds($arrBindFields['id_profession']);

		/**
		 * инициализация списка регионов
		 */
		global $regions;
		$arrDataRegions = $regions->retCategorys();

		global $citys;
		if (!empty($arrBindFields['id_city'])) {
			$arrDataCity = $citys->retCategorysByIds($arrBindFields['id_city']);
		} else {
			$arrBindFields['id_city'] = 0;
		}

		if (!empty($arrBindFields['title'])) {
			$arrTitle = explode(' ', $arrBindFields['title']);
		} elseif (!empty($arrNoBindFields['title'])) {
			$arrTitle = explode(' ', $arrNoBindFields['title']);
		} else {
			$arrTitle = array();
		}

		$arrMeta_keywords = array($arrDataSections[$arrBindFields['id_section']]['name'], $arrDataProfession[$arrBindFields['id_profession']]['name'], $arrDataRegions[$arrBindFields['id_region']]['name']);
		$arrMeta_description = array(implode(' ', $arrTitle), $arrDataSections[$arrBindFields['id_section']]['name'], $arrDataProfession[$arrBindFields['id_profession']]['name'], $arrDataRegions[$arrBindFields['id_region']]['name']);

		if (!empty($arrBindFields['id_city']) && !empty($arrDataCity[$arrBindFields['id_city']]['name'])) {
			$arrMeta_keywords[] = $arrMeta_description[] = $arrDataCity[$arrBindFields['id_city']]['name'];
		}

		if (!empty($arrBindFields['pay_from'])) {
			$arrMeta_keywords[] = $arrMeta_description[] = $arrBindFields['pay_from'];
		} elseif (!empty($arrNoBindFields['pay_from'])) {
			$arrMeta_keywords[] = $arrMeta_description[] = $arrNoBindFields['pay_from'];
		}

		if (!empty($arrBindFields['currency'])) {
			$arrMeta_keywords[] = $arrMeta_description[] = $arrBindFields['currency'];
		} elseif (!empty($arrNoBindFields['currency'])) {
			$arrMeta_keywords[] = $arrMeta_description[] = $arrNoBindFields['currency'];
		}

		$this->arrServiceFields['meta_keywords'] = implode(', ', array_merge($arrTitle, $arrMeta_keywords));
		$this->arrServiceFields['meta_description'] = implode(' | ', $arrMeta_description);

		if (!$this->setAnnounceSubj($arrBindFields, $arrNoBindFields) || !$this->addEntry()) {
			return false;
		} else {
			$arrAnnounceData = $this->retDataSubj();

			// производим запись подписки
			('active' === $arrAnnounceData['token']) ? $this->recSubscription($typeAnnounce, $arrAnnounceData) : null;

			// рассылаем почтовые сообщения
			$this->sendEmails($typeAnnounce, $arrAnnounceData);
		}
	}

	/**
	 * protected функция производит редактирование данных в таблице БД
	 * Производит запись в таблицу подписки, если необходимо
	 * Рассылает почтовые сообщения
	 *
	 * @param array $arrBindFields - массив полей обязательных для заполнения
	 * @param array $arrNoBindFields - массив полей не обязательных для заполнения
	 * @param array $arrFieldsXmlData - массив полей данные которых храняться в XML-формате
	 *
	 * @return bool
	 */
	protected function editAnnounce(&$unikey, &$arrBindFields, &$arrNoBindFields, &$arrFieldsXmlData = false) {
		if (!$this->getAnnounceByUnikey($unikey)) {
			return false;
		}

		$typeAnnounce = $this->retTableName();
		$arrAnnounceData = $this->retAnnSubj();

		if (!empty($arrBindFields['image'])) {
			$image = &$arrBindFields['image'];
		} elseif (!empty($arrNoBindFields['image'])) {
			$image = &$arrNoBindFields['image'];
		} else {
			$image = '';
		}

		if ($image !== $arrAnnounceData['image']) {
			if (!empty($arrAnnounceData['image'])) {
				switch ($typeAnnounce) {
					case 'resume':
						foreach (explode(',', $arrAnnounceData['image']) as $image) {
							@unlink('uploads/images/photos/' . $image);
						}
						break;

					default:
						break;
				}
			}

			if (!empty($image) && !$this->imageProcessing($typeAnnounce, $image)) {
				return false;
			}
		}

		$this->arrServiceFields = array_intersect_key($arrAnnounceData, $this->arrServiceFields);

		$this->arrServiceFields['unikey'] = strings::getUnikey($arrBindFields);

		if (!empty($_SESSION['sd_' . DB_PREFIX . 'codex']['resp']['moder_' . $typeAnnounce])) {
			$this->arrServiceFields['token'] = 'moderate';
			$this->arrServiceFields['token_datetime'] = terms::currentDateTime();
		} elseif (!empty($this->arrPayments['add_' . $typeAnnounce])) {
			$this->arrServiceFields['token'] = 'payment';
			$this->arrServiceFields['token_datetime'] = terms::calcDateTimeOfTerm(constant('CONF_' . strtoupper($typeAnnounce) . '_PAYMENT_THERM'));
		} else {
			$this->arrServiceFields['token'] = 'active';
			$this->arrServiceFields['token_datetime'] = terms::calcDateTimeOfTerm($arrBindFields['act_period'] * 24);
			$this->arrServiceFields['act_datetime'] = terms::currentDateTime();
		}

		(is_array($arrFieldsXmlData)) ? $this->formXmlData($arrFieldsXmlData) : null;

		/**
		 * инициализация списка разделов
		 */
		global $sections;
		$arrDataSections = $sections->retCategorys();

		global $professions;
		$arrDataProfession = $professions->retCategorysByIds($arrBindFields['id_profession']);

		/**
		 * инициализация списка регионов
		 */
		global $regions;
		$arrDataRegions = $regions->retCategorys();

		global $citys;
		$arrDataCity = $citys->retCategorysByIds($arrBindFields['id_city']);

		if (!empty($arrBindFields['title'])) {
			$arrTitle = explode(' ', $arrBindFields['title']);
		} elseif (!empty($arrNoBindFields['title'])) {
			$arrTitle = explode(' ', $arrNoBindFields['title']);
		} else {
			$arrTitle = array();
		}

		$arrMeta_keywords = array($arrDataSections[$arrBindFields['id_section']]['name'], $arrDataProfession[$arrBindFields['id_profession']]['name'], $arrDataRegions[$arrBindFields['id_region']]['name'], $arrDataCity[$arrBindFields['id_city']]['name']);
		$arrMeta_description = array(implode(' ', $arrTitle), $arrDataSections[$arrBindFields['id_section']]['name'], $arrDataProfession[$arrBindFields['id_profession']]['name'], $arrDataRegions[$arrBindFields['id_region']]['name'], $arrDataCity[$arrBindFields['id_city']]['name']);

		if (!empty($arrBindFields['pay_from'])) {
			$arrMeta_keywords[] = $arrMeta_description[] = $arrBindFields['pay_from'];
		} elseif (!empty($arrNoBindFields['pay_from'])) {
			$arrMeta_keywords[] = $arrMeta_description[] = $arrNoBindFields['pay_from'];
		}

		if (!empty($arrBindFields['currency'])) {
			$arrMeta_keywords[] = $arrMeta_description[] = $arrBindFields['currency'];
		} elseif (!empty($arrNoBindFields['currency'])) {
			$arrMeta_keywords[] = $arrMeta_description[] = $arrNoBindFields['currency'];
		}

		$this->arrServiceFields['meta_keywords'] = implode(', ', array_merge($arrTitle, $arrMeta_keywords));
		$this->arrServiceFields['meta_description'] = implode(' | ', $arrMeta_description);

		if (!$this->setAnnounceSubj($arrBindFields, $arrNoBindFields) || !$this->editEntry()) {
			return false;
		} else {
			$arrAnnounceData = $this->retDataSubj();
			// удаляем старые записи подписки
			$this->subscription->delSubscriptions("id_announce IN (" . $arrAnnounceData['id'] . ")");
			// производим запись новой подписки
			if ('active' === $arrAnnounceData['token']) {
				$this->recSubscription($typeAnnounce, $arrAnnounceData);
			}

			// рассылаем почтовые сообщения
			$this->sendEmails($typeAnnounce, $arrAnnounceData);
		}
	}

	/**
	 * protected функция производит редактирование данных в таблице БД - включая данные сервисных полей
	 * Производит запись в таблицу подписки, если необходимо
	 *
	 * @param array $arrBindFields - массив полей обязательных для заполнения
	 * @param array $arrNoBindFields - массив полей не обязательных для заполнения
	 * @param array $arrServiceFields - массив сервисных полей
	 * @param array $arrFieldsXmlData - массив полей данные которых храняться в XML-формате
	 *
	 * @return bool
	 */
	protected function editAnnounceService(&$arrBindFields, &$arrNoBindFields, &$arrServiceFields, &$arrFieldsXmlData = false) {
		$typeAnnounce = $this->retTableName();

		$arrServiceFields['unikey'] = strings::getUnikey($arrBindFields);

		if (is_array($arrFieldsXmlData)) {
			$this->formXmlData($arrFieldsXmlData);
			$arrServiceFields['xml_data'] = &$this->arrServiceFields['xml_data'];
		}

		if (!empty($arrBindFields['image']) && !$this->imageProcessing($typeAnnounce, $arrBindFields['image'])) {
			return false;
		} elseif (!empty($arrNoBindFields['image']) && !$this->imageProcessing($typeAnnounce, $arrNoBindFields['image'])) {
			return false;
		}

		return (!$this->setAnnounceSubj($arrBindFields, $arrNoBindFields, $arrServiceFields) || !$this->editEntry()) ? false : true;
	}

	/**
	 * protected функция активации нового добавленного объявления по уникальному ключу
	 * Производит запись в таблицу подписки, если необходимо
	 * Рассылает почтовые сообщения
	 *
	 * @param string $unikey - уникальный ключ объявления
	 *
	 * @return bool
	 */
	protected function actAnnounce(&$unikey) {
		$typeAnnounce = $this->retTableName();

		if (!$this->getEntry("unikey IN (" . secure::escQuoteData($unikey) . ") AND token IN ('new')")) {
			return false;
		} else {
			global $user;

			$arrAnnounceData = $this->retDataFields(array('id_user', 'act_period'));

			if (!empty($arrAnnounceData['id_user']) && !$user->getAuthorized()) {
				$_SESSION['referer'] = CONF_SCRIPT_URL . 'index.php?ut=' . $_SESSION['sd_user'][DB_PREFIX . 'conf']['user_type'] . '&do=vacancy&action=activate&code=' . $unikey;

				messages::messageChangeSaved(MESSAGE_NEED_AUTHORIZE, ANNOUNCE_ADD_ACTIVATE_AUTHORIZE_MESSAGE, chpu::createChpuUrl(CONF_SCRIPT_URL . 'index.php?do=authorize'), 5000);
			}

			if (!empty($_SESSION['sd_' . DB_PREFIX . 'codex']['resp']['moder_' . $typeAnnounce])) {
				$arrData = array(
					'token' => 'moderate',
					'token_datetime' => terms::currentDateTime()
				);
			} elseif (!empty($this->arrPayments['add_' . $typeAnnounce])) {
				$arrData = array(
					'token' => 'payment',
					'token_datetime' => terms::calcDateTimeOfTerm(constant('CONF_' . strtoupper($typeAnnounce) . '_PAYMENT_THERM'))
				);
			} else {
				$arrData = array(
					'token' => 'active',
					'token_datetime' => terms::calcDateTimeOfTerm($arrAnnounceData['act_period'] * 24),
					'act_datetime' => terms::currentDateTime()
				);
			}

			// производим активацию объявления
			if (!$this->fillTableFieldsValue($arrData) || !$this->editEntrys(secure::escQuoteData($arrData), "unikey IN (" . secure::escQuoteData($unikey) . ")")) {
				return false;
			} else {
				$arrAnnounceData = $this->retDataSubj();

				// производим запись подписки
				('active' === $arrData['token']) ? $this->recSubscription($typeAnnounce, $arrAnnounceData) : null;

				// рассылаем почтовые сообщения
				$this->sendEmails($typeAnnounce, $arrAnnounceData);
			}
		}
	}

	/**
	 * protected функция оплаты нового добавленного объявления
	 * Производит запись в таблицу подписки
	 * Рассылает почтовые сообщения
	 *
	 * @param string $unikey
	 *
	 * @return bool
	 */
	protected function paymentAnnounce(&$id) {
		$typeAnnounce = $this->retTableName();

		if (!$this->getEntry("id IN (" . secure::escQuoteData($id) . ") AND token IN ('payment')")) {
			return false;
		} else {
			$arrAnnounceData = $this->retDataFields('act_period');

			$arrData = array(
				'token' => 'active',
				'token_datetime' => terms::calcDateTimeOfTerm($arrAnnounceData['act_period'] * 24),
				'act_datetime' => terms::currentDateTime()
			);

			// производим активацию объявления
			if (!$this->fillTableFieldsValue($arrData) || !$this->editEntrys(secure::escQuoteData($arrData), "id IN (" . secure::escQuoteData($id) . ")")) {
				return false;
			} else {
				$arrAnnounceData = $this->retDataSubj();

				// производим запись подписки
				$this->recSubscription($typeAnnounce, $arrAnnounceData);

				// рассылаем почтовые сообщения
				$this->sendEmails($typeAnnounce, $arrAnnounceData, false);
			}
		}
	}

	/**
	 * функция обработки действий с объявлениями
	 *
	 * @param array $arrData
	 *
	 * @return bool
	 */
	protected function actionAnnounces(&$arrData, &$sendEmails) {
		$typeAnnounce = $this->retTableName();

		$arrFields = array('id', 'title', 'id_user', 'id_section', 'id_profession', 'id_region', 'id_city', 'unikey', 'email', 'act_period', 'subscription');

		if ('resume' === $typeAnnounce) {
			$arrFields += array('id_profession_1', 'id_profession_2');
		}

		$arrLimit = array('strLimit' => '0, 300', 'calcRows' => true);

        if (
            !empty($arrData['id']) &&
            is_array($arrData['id']) &&
            !empty($arrData['action']) &&
            $this->getEntrys("id IN (" . implode(',', secure::escQuoteData(array_keys($arrData['id']))) . ")", false, $arrLimit, $arrFields)
        ) {
			if ('active' === $arrData['action']) {
				foreach ($this->retData() as $arrAnnounce) {
					$arrAnnouncesByPeriod[$arrAnnounce['act_period']][$arrAnnounce['id']] = $arrAnnounce;
				}

				foreach ($arrAnnouncesByPeriod as $term => &$arrAnnouncesByIds) {
					$arrFields = array(
						'token' => 'active',
						'token_datetime' => terms::calcDateTimeOfTerm($term * 24),
						'act_datetime' => terms::currentDateTime(),
						'comments' => ''
					);

					foreach ($arrAnnouncesByIds as &$arrAnnounceData) {
						// переопределяем значения
						$arrAnnounceData += $arrFields;

						// обработка подписки
						if (!empty($arrAnnounceData['subscription'])) {
							if (!$this->recSubscription($typeAnnounce, $arrAnnounceData)) {
								unset($arrAnnouncesByIds[$arrAnnounceData['id']]);
							}
						}

						// отсылаем почтовые сообщения
						if (!empty($sendEmails) && !$this->sendEmails($typeAnnounce, $arrAnnounceData, false)) {
							unset($arrAnnouncesByIds[$arrAnnounceData['id']]);
						}
					}

					$result = (!empty($arrAnnouncesByIds)) ? $this->editEntrys(secure::escQuoteData($arrFields), "id IN (" . implode(',', secure::escQuoteData(array_keys($arrAnnouncesByIds))) . ")") : false;

					if (!$result) {
						return false;
					}
				}

				return true;
			} else {
				switch ($arrData['action']) {
					case 'payment':
					case 'correction':
						$arrFields = array(
							'token' => $arrData['action'],
							'token_datetime' => terms::calcDateTimeOfTerm(constant('CONF_' . strtoupper($typeAnnounce) . '_' . strtoupper($arrData['action']) . '_THERM')),
							'comments' => &$arrData['comments']
						);
						break;

					case 'deleted':
					case 'archived':
						$arrFields = array(
							'token' => $arrData['action'],
							'token_datetime' => terms::currentDateTime(),
							'comments' => ''
						);
						break;

					case 'vip':
					case 'hot':
						$arrFields = array(
							$arrData['action'] => '0',
							$arrData['action'] . '_unset_datetime' => '0000-00-00 00:00:00'
						);
						break;

					default:
						return false;
				}

				$arrSubscr = array();
				foreach ($this->retData() as $arrAnnounceData) {
					// устанавливаем в токен текущее действие, токен не сохраняется в БД, а нужен только для отправки писем
					$arrAnnounceData['token'] = &$arrData['action'];
					// обрабатываем комментарии для сообщений
					(!empty($arrData['comments'])) ? $arrAnnounceData['comments'] = &$arrData['comments'] : (!empty($sendEmails) ? $arrAnnounceData['comments'] = MAIL_DEFAULT_COMMENTS : null);
					// если у объявления существует подписка, сохраняем id-объявления в массив обрабатываемых подписок
					(!empty($arrAnnounceData['subscription'])) ? $arrSubscr[$arrAnnounceData['id']] = null : null;
					// отправляем почту, если неудалось отправить письмо, то действие с данным объявлением не выполняется, записи исключаются из массива обработки
					if (!empty($sendEmails) && !$this->sendEmails($typeAnnounce, $arrAnnounceData, false)) {
						unset($arrData['id'][$arrAnnounceData['id']], $arrSubscr[$arrAnnounceData['id']]);
					}
				}

				if (('deleted' === $arrData['action'] || 'archived' === $arrData['action']) && !empty($arrSubscr)) {
					$arrFieldsSubscr = array(
						'token' => 'deleted',
						'token_datetime' => $arrFields['token_datetime']
					);

					$this->subscription->editSubscr($arrFieldsSubscr, "id_announce IN (" . implode(',', secure::escQuoteData(array_keys($arrSubscr))) . ")");
				}

				return (!empty($arrData['id'])) ? $this->editEntrys(secure::escQuoteData($arrFields), "id IN (" . implode(',', secure::escQuoteData(array_keys($arrData['id']))) . ")") : false;
			}
		} else {
			return false;
		}
	}

	/**
	 * функция управления объявлениями - ручное и роботизированное управление
	 *
	 * @param string $strWhere - строка для выражения WHERE
	 * @param string $action - выполняемое действие
	 *
	 * @return bool
	 */
	protected function controlAnnounces(&$strWhere, &$action) {
		if (!$this->getEntrys($strWhere, false, false, array('id'), false)) {
			return true;
		} else {
			foreach ($this->retData() as $data) {
				$arrData['id'][$data['id']] = null;
			}

			$arrData['action'] = &$action;
			('deleted' === $action || 'archived' === $action) ? $arrData['comments'] = MAIL_COMMENTS_STORAGE_LIFE_OVER : null;

			return $this->actionAnnounces($arrData);
		}
	}

	/**
	 * функция удаляет объявления по условию WHERE
	 *
	 * @param string $strWhere - строка для выражения WHERE
	 *
	 * @return bool
	 */
	protected function delAnnounces(&$strWhere) {
		if ($this->getEntrys($strWhere, false, false, array('id', 'subscription', 'image'), false)) {
			$arrSubscr = array();
			foreach ($this->retData() as $arrAnnounceData) {
				// если у объявления существует подписка, сохраняем id-объявления в массив обрабатываемых подписок
				(!empty($arrAnnounceData['subscription'])) ? $arrSubscr[] = $arrAnnounceData['id'] : null;
				// если у объявления существуют файлы изображений - удаляем их
				if (!empty($arrAnnounceData['image'])) {
					switch ($this->retTableName()) {
						case 'resume':
							foreach (explode(',', $arrAnnounceData['image']) as $image) {
								@unlink('uploads/images/photos/' . $image);
							}
							break;

						default:
							break;
					}
				}
			}

			(!empty($arrSubscr)) ? $this->subscription->delSubscriptions("id_announce IN (" . implode(',', secure::escQuoteData($arrSubscr)) . ")") : null;

			$arrFields = array(
				'token' => 'deleted',
				'token_datetime' => terms::currentDateTime()
			);

			return $this->editEntrys(secure::escQuoteData($arrFields), $strWhere);
		} else {
			return true;
		}
	}

	/**
	 * Функция установки объявлению свойства "Тип размещения"
	 *
	 */
	protected function setVisibility(&$visibility, &$listId = false) {
		(!is_array($listId)) ? $listId = array($listId) : null;

		$strWhere = (!empty($listId)) ? "id IN (" . implode(',', secure::escQuoteData($listId)) . ")" : false;

		return $this->editEntrys(secure::escQuoteData(array('visibility' => $visibility)), $strWhere);
	}

	/**
	 * Функция установки объявлению статуса VIP
	 *
	 */
	protected function setVip(&$id) {
		$typeAnnounce = $this->retTableName();

		$term = ((!constant('CONF_' . strtoupper($typeAnnounce) . '_VIP_THERM')) ? '0000-00-00 00:00:00' : terms::calcDateTimeOfTerm(constant('CONF_' . strtoupper($typeAnnounce) . '_VIP_THERM')));

		return $this->editEntrys(secure::escQuoteData(array('vip' => '1', 'vip_unset_datetime' => $term)), "id IN (" . secure::escQuoteData($id) . ")");
	}

	/**
	 * Функция сброса объявлению статуса VIP
	 *
	 */
	protected function resetVip(&$id) {
		$typeAnnounce = $this->retTableName();

		return $this->editEntrys(secure::escQuoteData(array('vip' => '0', 'vip_unset_datetime' => '0000-00-00 00:00:00')), "id IN (" . secure::escQuoteData($id) . ")");
	}

	/**
	 * Функция установки объявлению статуса HOT
	 *
	 */
	protected function setHot(&$id) {
		$typeAnnounce = $this->retTableName();

		$term = (!constant('CONF_' . strtoupper($typeAnnounce) . '_HOT_THERM')) ? '0000-00-00 00:00:00' : terms::calcDateTimeOfTerm(constant('CONF_' . strtoupper($typeAnnounce) . '_HOT_THERM'));

		return $this->editEntrys(secure::escQuoteData(array('hot' => '1', 'hot_unset_datetime' => $term)), "id IN (" . secure::escQuoteData($id) . ")");
	}

	/**
	 * Функция сброса объявлению статуса HOT
	 *
	 */
	protected function resetHot(&$id) {
		$typeAnnounce = $this->retTableName();

		return $this->editEntrys(secure::escQuoteData(array('hot' => '0', 'hot_unset_datetime' => '0000-00-00 00:00:00')), "id IN (" . secure::escQuoteData($id) . ")");
	}

	/**
	 * Функция установки объявлению статуса Рейтинг
	 *
	 */
	protected function setRate(&$id) {
		return $this->editEntrys(secure::escQuoteData(array('rate' => terms::currentDateTime())), "id IN (" . secure::escQuoteData($id) . ")");
	}

	/**
	 * Функция сброса объявлению статуса Рейтинг
	 *
	 */
	protected function resetRate(&$id) {
		return $this->editEntrys(secure::escQuoteData(array('rate' => '0000-00-00 00:00:00')), "id IN (" . secure::escQuoteData($id) . ")");
	}

	/**
	 * Функция инкремента счетчиков просмотра объявлений
	 *
	 * @return void
	 */
	protected function viewAnnounce() {
		$arrData = $this->retAnnSubj();
		// проверяем полученные данные
		if (empty($arrData['id']) || !isset($arrData['id_user']) || !isset($arrData['cnt_views_last_ip'])) {
			return;
		}
		// обрабатываем счетчики
		if (!empty($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] != $arrData['cnt_views_last_ip']) {

			$arrCntData = secure::escQuoteData(array(
						'cnt_views_temp_datetime' => '',
						'cnt_views_last_ip' => $_SERVER['REMOTE_ADDR']
					));

			$arrCntData['cnt_views_total'] = 'cnt_views_total+1';
			$arrCntData['cnt_views_temp'] = 'cnt_views_temp+1';

			$this->editEntrysNCC($arrCntData, "id IN (" . secure::escQuoteData($arrData['id']) . ")");
		}
		// обрабатываем данные о просмотрах контента зарегистрированными пользователями
		if (!empty($_SESSION['sd_user']['job_conf']['id']) && !empty($arrData['id_user']) && $arrData['id_user'] != $_SESSION['sd_user']['job_conf']['id']) {

			$storing = new storing();

			$storing->setStoringData(array(
				'type' => $this->retTableName(),
				'id_content' => $arrData['id']
			));

			$storing->recStoring();
		}
	}

	/**
	 * private функция передает значения полей полученных из формы в свойсво базового класса, для последующей записи в таблицу БД
	 *
	 * @param mixed $arrBindFields
	 * @param mixed $arrNoBindFields
	 *
	 * @return bool
	 */
	private function setAnnounceSubj(&$arrBindFields, &$arrNoBindFields, &$arrServiceFields = false) {
		strings::htmlDecode($arrBindFields);
		strings::htmlDecode($arrNoBindFields);

		(empty($arrServiceFields)) ? $arrServiceFields = &$this->arrServiceFields : null;

		return $this->fillTableFieldsValue($arrServiceFields + $arrBindFields + $arrNoBindFields);
	}

	/**
	 * private функция записи данных в xml
	 *
	 * @param array $arrFieldsXmlData - эталонный массив для данных хранимых в формате xml
	 *
	 * @return bool
	 */
	private function formXmlData(&$arrFieldsXmlData) {
		if (is_array($arrFieldsXmlData) && !empty($arrFieldsXmlData)) {
			$xmlData = simplexml_load_string('<?xml version="1.0" encoding="UTF-8"?><root></root>');

			foreach ($arrFieldsXmlData as $nameField => &$fieldValues) {
				if (is_array($fieldValues) && !empty($fieldValues)) {
					$xmlField = $xmlData->addChild($nameField);

					foreach ($fieldValues as &$arrFieldsVals) {
						if ((isset($arrFieldsVals['arrBindFields']) && is_array($arrFieldsVals['arrBindFields']) && !empty($arrFieldsVals['arrBindFields'])) || (isset($arrFieldsVals['arrNoBindFields']) && is_array($arrFieldsVals['arrNoBindFields']) && !empty($arrFieldsVals['arrNoBindFields']))) {
							$child = $xmlField->addChild('child');

							if (isset($arrFieldsVals['arrBindFields'])) {
								foreach ($arrFieldsVals['arrBindFields'] as $field => &$value) {
									(!empty($value)) ? $child->addChild($field, '<![CDATA[' . $value . ']]>') : $child->addChild($field);
								}
							}

							if (isset($arrFieldsVals['arrNoBindFields'])) {
								foreach ($arrFieldsVals['arrNoBindFields'] as $field => &$value) {
									(!empty($value)) ? $child->addChild($field, '<![CDATA[' . $value . ']]>') : $child->addChild($field);
								}
							}
						} else {
							unset($xmlData->$nameField);
							continue;
						}
					}
				} else {
					continue;
				}
			}

			$this->arrServiceFields['xml_data'] = strings::htmlDecode($xmlData->asXML());

			return true;
		} else {
			return false;
		}
	}

	/**
	 * private функция получения данных из xml
	 *
	 * @param array $arrFieldsXmlData - эталонный массив для данных хранимых в формате xml
	 * @param bool $multy [default = false] - признак обработки массива данных, утановить true если необходимо обработать данные по нескольким объявлениям
	 *
	 * @return bool
	 */
	private function getXmlData(&$arrFieldsXmlData, $multy = false) {
		if (!is_array($arrFieldsXmlData) || empty($arrFieldsXmlData)) {
			return false;
		} elseif (!$multy) {
			$this->parseXmlData($this->annData, $arrFieldsXmlData);
			return true;
		} else {
			// обрабатываем массив полученных объявлений, в цикле переменная $announce должна передаваться по ссылке!!!
			foreach ($this->annData as &$announce) {
				$this->parseXmlData($announce, $arrFieldsXmlData);
			}

			return true;
		}
	}

	/**
	 * private функция парсера данных из xml
	 * Данные записываются в массив переданный по ссылке
	 *
	 * @param array $reference - ссылка на массив данных для сохранения результата
	 * @param array $arrFieldsXmlData - эталонный массив для данных хранимых в формате xml
	 *
	 * @return void
	 */
	private function parseXmlData(&$reference, &$arrFieldsXmlData) {
		$xmlData = @simplexml_load_string($reference['xml_data'], 'SimpleXMLElement', LIBXML_NOCDATA);

		foreach (array_keys($arrFieldsXmlData) as $nameField) {
			if (empty($xmlData) || !property_exists($xmlData, $nameField) || !property_exists($xmlData->$nameField, 'child')) {
				$arrData = (!empty($reference['xml_data'])) ? false : null;
			} else {
				$arrData = array();
				foreach ($xmlData->$nameField->child as $value) {
					$data = get_object_vars($value);
					foreach ($data as &$val) {
						(!count($val)) ? $val = '' : null;
					}

					$arrData[] = $data;
				}
			}

			$reference[$nameField] = $arrData;
		}

		unset($reference['xml_data']);
	}

	/**
	 * private функция обработки загружаемых файлов изображений
	 *
	 * @param string $typeAnnounce - тип объявления (должно соответствовать имени таблицы БД)
	 * @param string imageName - имя файла загруженного изображения
	 *
	 * @return bool
	 */
	private function imageProcessing(&$typeAnnounce, &$imageName) {
		switch ($typeAnnounce) {
			case 'resume':
				foreach (explode(',', $imageName) as $image) {
					if (file_exists('uploads/temporary/' . $image)) {
						if (!@rename('uploads/temporary/' . $image, 'uploads/images/photos/' . $image)) {
							return false;
						}
					} else if (!file_exists('uploads/images/photos/' . $image)) {
						return false;
					}
				}
				break;

			default:
				break;
		}

		return true;
	}

	/**
	 * private функция записи данных в таблицу подписки
	 *
	 * @param string $typeAnnounce - тип объявления (должно соответствовать имени таблицы БД)
	 * @param array $arrAnnounceData - массив данных объявления
	 *
	 * @return bool
	 */
	private function recSubscription(&$typeAnnounce, &$arrAnnounceData) {
		if (!empty($arrAnnounceData['subscription'])) {
			$this->subscription->arrBindFields = array_intersect_key($arrAnnounceData, $this->subscription->arrBindFields);
			$this->subscription->arrNoBindFields = array_intersect_key($arrAnnounceData, $this->subscription->arrNoBindFields);

			switch ($typeAnnounce) {
				case 'resume':
					$this->subscription->arrBindFields['type_subscription'] = 'vacancy';
					break;

				case 'vacancy':
					$this->subscription->arrBindFields['type_subscription'] = 'resume';
					break;

				default:
					$this->subscription->arrBindFields['type_subscription'] = 'error';
					break;
			}

			$this->subscription->arrNoBindFields['id_announce'] = $arrAnnounceData['id'];

			if (!$this->dataSubjNoEmpty()) {
				$arrDataSubj = $arrAnnounceData;

				unset($arrDataSubj['id']);

				if (!$this->fillTableFieldsValue($arrDataSubj)) {
					return false;
				} else {
					return $this->subscription->recSubscr($typeAnnounce);
				}
			} else {
				return false;
			}
		} else {
			return true;
		}
	}

	/**
	 * private функция рассылки почтовых сообщений
	 *
	 * @param string $typeAnnounce - тип объявления (должно соответствовать имени таблицы БД)
	 * @param array $arrAnnounceData - массив данных объявления
	 * @param bool $screenMessageOn [default = true] - завершение работы скрипта, выводом информационного сообщения
	 *
	 * @return bool
	 */
	private function sendEmails(&$typeAnnounce, &$arrAnnounceData, $screenMessageOn = true) {
		if (isset($_SESSION['referer'])) {
			unset($_SESSION['referer']);
		}

		$user_type = (!empty($_SESSION['sd_user'][DB_PREFIX . 'conf']['user_type'])) ? 'ut=' . $_SESSION['sd_user'][DB_PREFIX . 'conf']['user_type'] . '&amp;' : '';

		switch ($arrAnnounceData['token']) {
			case 'new': {
					/**
					 * отправляем письмо пользователю
					 */
					$mailer = new mailer();

					// дата удаления неактивированного объявления
					$deldate = date(terms::dateFormatFromSmarty(CONF_DATE_FORMAT, CONF_TIME_FORMAT), strtotime(terms::calcDateTimeOfTerm(constant('CONF_' . strtoupper($typeAnnounce) . '_ACTIVATE_THERM'))));

					$mailer->setAddReplace(
							array(
								'%ANNOUNCE_TYPE%' => constant('MAIL_ANNOUNCE_TYPE_' . strtoupper($typeAnnounce)),
								'%ANNOUNCE_TITLE%' => $arrAnnounceData['title'],
								'%CODE%' => $arrAnnounceData['unikey'],
								'%DELDATE%' => $deldate,
								'%ACTIVATE_PAGE%' => CONF_SCRIPT_URL . 'index.php?' . $user_type . 'do=' . $typeAnnounce . '&amp;action=activate',
								'%ACTIVATE_LINK%' => CONF_SCRIPT_URL . 'index.php?' . $user_type . 'do=' . $typeAnnounce . '&amp;action=activate&amp;code=' . $arrAnnounceData['unikey']
							)
					);

					$result = $mailer->sendEmail(CONF_MAIL_ADMIN_EMAIL, CONF_SITE_NAME, false, $arrAnnounceData['email'], $arrAnnounceData['email'], MAIL_SUBJ_ACTIVATE_ANNOUNCE . constant('MAIL_ANNOUNCE_TYPE_' . strtoupper($typeAnnounce)) . ' - ' . $arrAnnounceData['title'], 'announce.user.activate.txt');

					unset($mailer); // уничтожаем объект

					if (!$result && !empty($screenMessageOn)) {
						messages::printDie(ERROR_SEND_EMAIL);
					} elseif (!empty($screenMessageOn)) {
						messages::messageChangeSaved(ANNOUNCE_ADD_ACTIVATE_TITLE, ANNOUNCE_ADD_ACTIVATE_MESSAGE, CONF_SCRIPT_URL . 'index.php?ut=' . $_SESSION['sd_user'][DB_PREFIX . 'conf']['user_type'] . '&do=' . $typeAnnounce . '&action=activate', 5000);
					} else {
						return $result;
					}
				}

			case 'moderate': {
					// массив для замены в шаблоне
					$arrAddReplace = array(
						'%ANNOUNCE_TYPE%' => constant('MAIL_ANNOUNCE_TYPE_' . strtoupper($typeAnnounce)),
						'%ANNOUNCE_TITLE%' => $arrAnnounceData['title'],
					);

					/**
					 * отправляем письмо администратору
					 */
					$mailer = new mailer();

					// передаем массив для замены в шаблоне
					$mailer->setAddReplace($arrAddReplace + array('%ADMIN_PANEL_LINK%' => CONF_SCRIPT_URL . CONF_ADMIN_FILE . '?m=announces&amp;s=' . $typeAnnounce . 's&amp;action=moderate'));

					$mailer->sendEmail(CONF_MAIL_ADMIN_EMAIL, CONF_SITE_NAME, false, CONF_MAIL_ADMIN_EMAIL, false, MAIL_SUBJ_NEW_ANNOUNCE . $arrAnnounceData['title'], (empty($arrAnnounceData['comments'])) ? 'adm.moderate.announce.txt' : 'adm.edited.announce.txt');

					unset($mailer); // уничтожаем объект

					/**
					 * отправляем письмо пользователю
					 */
					$mailer = new mailer();

					// передаем массив для замены в шаблоне
					$mailer->setAddReplace($arrAddReplace);

					$result = $mailer->sendEmail(CONF_MAIL_ADMIN_EMAIL, CONF_SITE_NAME, false, $arrAnnounceData['email'], $arrAnnounceData['email'], MAIL_SUBJ_MODERATE_ANNOUNCE . constant('MAIL_ANNOUNCE_TYPE_' . strtoupper($typeAnnounce)) . ' - ' . $arrAnnounceData['title'], 'announce.user.moderate.txt');

					unset($mailer); // уничтожаем объект

					if (!$result && !empty($screenMessageOn)) {
						messages::printDie(ERROR_SEND_EMAIL);
					} elseif (!empty($screenMessageOn)) {
						$link = (!empty($arrAnnounceData['id_user'])) ? CONF_SCRIPT_URL . 'index.php?ut=' . $_SESSION['sd_user'][DB_PREFIX . 'conf']['user_type'] . '&do=user.announces&action=' . $typeAnnounce . '&token=' . $arrAnnounceData['token'] : CONF_SCRIPT_URL . 'index.php?ut=' . $_SESSION['sd_user'][DB_PREFIX . 'conf']['user_type'];
						messages::messageChangeSaved(ANNOUNCE_ADD_MODERATION_TITLE, ANNOUNCE_ADD_MODERATION_MESSAGE, chpu::createChpuUrl($link), 5000);
					} else {
						return $result;
					}
				}

			case 'correction': {
					/**
					 * отправляем письмо пользователю
					 */
					$mailer = new mailer();

					// дата удаления не исправленного объявления
					$deldate = date(terms::dateFormatFromSmarty(CONF_DATE_FORMAT, CONF_TIME_FORMAT), strtotime(terms::calcDateTimeOfTerm(constant('CONF_' . strtoupper($typeAnnounce) . '_CORRECTION_THERM'))));

					$mailer->setAddReplace(
							array(
								'%ANNOUNCE_TYPE%' => constant('MAIL_ANNOUNCE_TYPE_' . strtoupper($typeAnnounce)),
								'%ANNOUNCE_TITLE%' => $arrAnnounceData['title'],
								'%DELDATE%' => $deldate,
								'%USER_PANEL_LINK%' => chpu::createChpuUrl(CONF_SCRIPT_URL . 'index.php?do=user.announces&amp;action=' . $typeAnnounce . '&amp;token=' . $arrAnnounceData['token']),
								'%COMMENTS%' => (CONF_MAIL_FORMAT_HTML) ? nl2br($arrAnnounceData['comments']) : $arrAnnounceData['comments']
							)
					);

					$result = $mailer->sendEmail(CONF_MAIL_ADMIN_EMAIL, CONF_SITE_NAME, false, $arrAnnounceData['email'], $arrAnnounceData['email'], MAIL_SUBJ_NEW_ANNOUNCE_CORRECTION . constant('MAIL_ANNOUNCE_TYPE_' . strtoupper($typeAnnounce)) . ' - ' . $arrAnnounceData['title'], 'announce.user.correction.txt');

					unset($mailer); // уничтожаем объект

					if (!$result && !empty($screenMessageOn)) {
						messages::printDie(ERROR_SEND_EMAIL);
					} else {
						return $result;
					}
				}

			case 'payment': {
					/**
					 * отправляем письмо пользователю
					 */
					$mailer = new mailer();

					// дата удаления неоплаченого объявления
					$deldate = date(terms::dateFormatFromSmarty(CONF_DATE_FORMAT, CONF_TIME_FORMAT), strtotime(terms::calcDateTimeOfTerm(constant('CONF_' . strtoupper($typeAnnounce) . '_PAYMENT_THERM'))));

					$mailer->setAddReplace(
							array(
								'%ANNOUNCE_TYPE%' => constant('MAIL_ANNOUNCE_TYPE_' . strtoupper($typeAnnounce)),
								'%ANNOUNCE_TITLE%' => $arrAnnounceData['title'],
								'%CODE%' => $arrAnnounceData['unikey'],
								'%DELDATE%' => $deldate,
								'%PAYMENT_LINK%' => CONF_SCRIPT_URL . 'index.php?' . $user_type . 'do=' . $typeAnnounce . '&amp;action=payment&amp;id=' . $arrAnnounceData['id']
							)
					);

					$result = $mailer->sendEmail(CONF_MAIL_ADMIN_EMAIL, CONF_SITE_NAME, false, $arrAnnounceData['email'], $arrAnnounceData['email'], MAIL_SUBJ_NEW_ANNOUNCE_PAYMENT . constant('MAIL_ANNOUNCE_TYPE_' . strtoupper($typeAnnounce)) . ' - ' . $arrAnnounceData['title'], 'announce.user.payment.txt');

					unset($mailer); // уничтожаем объект

					if (!$result && !empty($screenMessageOn)) {
						messages::printDie(ERROR_SEND_EMAIL);
					} elseif (!empty($screenMessageOn)) {
						$_SESSION['payment'] = array('service' => 'add_' . $typeAnnounce, 'announce_type' => $typeAnnounce, 'id' => $arrAnnounceData['id'], 'tId' => $arrAnnounceData['tId'], 'announce_title' => $arrAnnounceData['title']);

						messages::messageChangeSaved(ANNOUNCE_ADD_PAYMENT_TITLE, ANNOUNCE_ADD_PAYMENT_MESSAGE, chpu::createChpuUrl(CONF_SCRIPT_URL . 'index.php?ut=' . $_SESSION['sd_user'][DB_PREFIX . 'conf']['user_type'] . '&do=payments'), 5000);
					} else {
						return $result;
					}
				}

			case 'active': {
					// транслитерация ЧПУ
					chpu::chpuTranslit($arrAnnounceData);

					if (CONF_ANNOUNCE_ADD_SUCCESS_ADMIN_INFORM) {
						$mailer = new mailer();

						// массив для замены в шаблоне
						$mailer->setAddReplace(array(
							'%ANNOUNCE_TYPE%' => constant('MAIL_ANNOUNCE_TYPE_' . strtoupper($typeAnnounce)),
							'%ANNOUNCE_TITLE%' => $arrAnnounceData['title'],
							'%ANNOUNCE_LINK%' => chpu::createChpuUrl(CONF_SCRIPT_URL . 'index.php?do=' . $typeAnnounce . '&amp;action=view&amp;id=' . $arrAnnounceData['tId']),
							'%ADMIN_PANEL_LINK%' => CONF_SCRIPT_URL . CONF_ADMIN_FILE . '?m=announces&amp;s=' . $typeAnnounce . 's'
						));

						// отправляем письмо администратору
						$mailer->sendEmail(CONF_MAIL_ADMIN_EMAIL, CONF_SITE_NAME, false, CONF_MAIL_ADMIN_EMAIL, false, MAIL_SUBJ_NEW_ANNOUNCE . constant('MAIL_ANNOUNCE_TYPE_' . strtoupper($typeAnnounce)) . ' - ' . $arrAnnounceData['title'], 'adm.add.announce.txt');

						unset($mailer); // уничтожаем объект
					}

					if (CONF_ANNOUNCE_ADD_SUCCESS_USER_INFORM) {
						$mailer = new mailer();

						$mailer->setAddReplace(array(
							'%ANNOUNCE_TYPE%' => constant('MAIL_ANNOUNCE_TYPE_' . strtoupper($typeAnnounce)),
							'%ANNOUNCE_TITLE%' => $arrAnnounceData['title'],
							'%ANNOUNCE_LINK%' => chpu::createChpuUrl(CONF_SCRIPT_URL . 'index.php?do=' . $typeAnnounce . '&amp;action=view&amp;id=' . $arrAnnounceData['tId']),
							'%USER_PANEL_LINK%' => chpu::createChpuUrl(CONF_SCRIPT_URL . 'index.php?do=user.announces&amp;action=' . $typeAnnounce . '&amp;token=' . $arrAnnounceData['token'])
						));

						// отправляем письмо пользователю
						$result = $mailer->sendEmail(CONF_MAIL_ADMIN_EMAIL, CONF_SITE_NAME, false, $arrAnnounceData['email'], $arrAnnounceData['email'], MAIL_SUBJ_NEW_ANNOUNCE . constant('MAIL_ANNOUNCE_TYPE_' . strtoupper($typeAnnounce)) . ' - ' . $arrAnnounceData['title'], 'announce.user.added.txt');

                        unset($mailer); // уничтожаем объект

						if (!$result && !empty($screenMessageOn)) {
							messages::printDie(ERROR_SEND_EMAIL);
						}
					}

                    if (!empty($screenMessageOn)) {
                        messages::messageChangeSaved(ANNOUNCE_ADD_SUCCESS_TITLE, ANNOUNCE_ADD_SUCCESS_MESSAGE, chpu::createChpuUrl(CONF_SCRIPT_URL . 'index.php?ut=' . $_SESSION['sd_user'][DB_PREFIX . 'conf']['user_type'] . '&amp;do=' . $typeAnnounce . '&action=view&id=' . $arrAnnounceData['tId']), 5000);
                    } else {
                        return true;
                    }
            }

            case 'deleted':
			case 'archived': {
					/**
					 * отправляем письмо пользователю
					 */
					$mailer = new mailer();

					$mailer->setAddReplace(
							array(
								'%ANNOUNCE_TYPE%' => constant('MAIL_ANNOUNCE_TYPE_' . strtoupper($typeAnnounce)),
								'%ANNOUNCE_TITLE%' => $arrAnnounceData['title'],
								'%COMMENTS%' => $arrAnnounceData['comments'],
							)
					);

					$result = $mailer->sendEmail(CONF_MAIL_ADMIN_EMAIL, CONF_SITE_NAME, false, $arrAnnounceData['email'], $arrAnnounceData['email'], MAIL_SUBJ_NEW_ANNOUNCE_DELETED . constant('MAIL_ANNOUNCE_TYPE_' . strtoupper($typeAnnounce)) . ' - ' . $arrAnnounceData['title'], 'announce.user.deleted.txt');

					unset($mailer); // уничтожаем объект

					if (!$result && !empty($screenMessageOn)) {
						messages::printDie(ERROR_SEND_EMAIL);
					} else {
						return $result;
					}
				}

			case 'vip':
			case 'hot': {
					/**
					 * отправляем письмо пользователю
					 */
					$mailer = new mailer();

					$mailer->setAddReplace(
							array(
								'%ANNOUNCE_TYPE%' => constant('MAIL_ANNOUNCE_TYPE_' . strtoupper($typeAnnounce)),
								'%ANNOUNCE_TITLE%' => $arrAnnounceData['title'],
								'%STATUS%' => strtoupper($arrAnnounceData['token']),
							)
					);

					$result = $mailer->sendEmail(CONF_MAIL_ADMIN_EMAIL, CONF_SITE_NAME, false, $arrAnnounceData['email'], $arrAnnounceData['email'], MAIL_SUBJ_NEW_ANNOUNCE_DELETED . constant('MAIL_ANNOUNCE_TYPE_' . strtoupper($typeAnnounce)) . ' - ' . $arrAnnounceData['title'], 'announce.user.' . $arrAnnounceData['token'] . '.reset.txt');

					unset($mailer); // уничтожаем объект

					if (!$result && !empty($screenMessageOn)) {
						messages::printDie(ERROR_SEND_EMAIL);
					} else {
						return $result;
					}
				}

			default:
				return false;
		}
	}

	/////////////////////////////////////////////////
	// END OF CLASS announces
	/////////////////////////////////////////////////
}
