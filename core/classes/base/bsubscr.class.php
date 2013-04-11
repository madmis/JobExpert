<?php

/**
 * JobExpert v1.0
 * Powered by Script Developers Group (SD-Group)
 * Email: info@sd-group.org.ua
 * URL: http://sd-group.org.ua/
 * Copyright 2010-2015 (c) SD-Group
 * All rights reserved
 * ===================================================
 * Базовый класс работы с Подписками и Рассылками
 * ===================================================
 *
 * @package
 *
 * @todo
 *
 */
(!defined('SDG')) ? die('Triple protection!') : null;

/**
 * Базовый класс работы с Подписками и Рассылками
 *
 */
abstract class bsubscr extends tbentrys {
	/////////////////////////////////////////////////
	// VARS - свойства класса bsubscr
	/////////////////////////////////////////////////

	/**
	 * $arrServiceFields - свойство для хранения массива сервисных полей в таблицах БД
	 * Массив иницирован наименованиями служебных полей таблицы
	 *
	 * @var array
	 */
	private $arrServiceFields = array(
		'date_lastsend' => '',
		'payment' => '',
		'token' => '',
		'token_datetime' => ''
	);
	private $arrPayments;

	/////////////////////////////////////////////////
	// CONSTRUCTOR - конструктор класса resume
	/////////////////////////////////////////////////

	/**
	 * конструктор
	 *
	 * Инициирует private свойство $arrPayments
	 *
	 */
	protected function __construct() {
		(!empty($GLOBALS['arrPayments'])) ? $this->arrPayments = & $GLOBALS['arrPayments'] : null;
	}

	/////////////////////////////////////////////////
	// METHODS - методы класса bsubscr
	/////////////////////////////////////////////////

	/**
	 * Функция подсчитывает кол-во записей в БД
	 *
	 * @param (string) $strWhere - выражение для оператора WHERE, если false, то подсчет строк берется из SELECT FOUND_ROWS
	 *
	 * @return int or false
	 */
	protected function cntSubscriptions($strWhere) {
		return (!$strWhere) ? $this->calcFoundRows() : $this->cntEntrys($strWhere);
	}

	/**
	 * функция получает подписки из БД
	 *
	 * @param (string) $strWhere - условие WHERE для запроса or false
	 * @param (array) $arrOrderBy - массив параметров сортировки результата выборки (key: name field => val: ASC | DESC) or false
	 * @param (mixed) $arrLimit - false or массив параметров для оператора LIMIT (key: 'strLimit' => val: string of LIMIT for example: '0, 10', key: 'calcRows' => val: true | false)
	 * @param (array) $arrFields - массив полей для выборки (key: index => val: name field)
	 *
	 * @return array or false
	 */
	protected function getSubscriptions($strWhere, $arrOrderBy, $arrLimit, $arrFields) {
		return ($this->getEntrys($strWhere, $arrOrderBy, $arrLimit, $arrFields)) ? $this->retData() : false;
	}

	/**
	 * protected функция производит запись данных в таблицу БД
	 *
	 * @param array $arrBindFields - массив полей обязательных для заполнения
	 * @param array $arrNoBindFields - массив полей не обязательных для заполнения
	 * @param string $typeAnnounce - тип объявления или false
	 *
	 * @return bool
	 */
	protected function recSubscr(&$arrBindFields, &$arrNoBindFields, $typeAnnounce) {
		// Для подписок добавляемых с объявлением
		if (!empty($typeAnnounce) && !empty($arrNoBindFields['id_announce']) && isset($GLOBALS[$typeAnnounce])) {
			$objCaller = & $GLOBALS[$typeAnnounce];

			if (!$arrAnnounceData = $objCaller->retDataSubj()) {
				return false;
			}

			// заполняем период подписки из настройки панели администратора
			$arrBindFields['period'] = CONF_SUBSCRIPTIONS_ANNOUNCE_PERIOD;
			// запролняем сервисные поля
			$this->arrServiceFields = array_intersect_key($arrAnnounceData, $this->arrServiceFields);
		} else {
			// Проверяем тип подписки на платность
			// и количество бесплатных подписок пользователя
			if (!$this->arrPayments['subscr_' . $arrBindFields['type_subscription']] || $this->cntSubscriptions("id_announce IN ('0') AND id_user IN (" . secure::escQuoteData($_SESSION['sd_user']['data']['id']) . ") AND payment IN ('no') AND type_subscription IN (" . secure::escQuoteData($arrBindFields['type_subscription']) . ") AND token IN ('active')") < @constant('CONF_SUBSCRIPTIONS_FREE_' . strtoupper($arrBindFields['type_subscription']))) { // если доступны бесплатные подписки, формируем данные для добавления бесплатной подписки
				$this->arrServiceFields['token'] = 'active';
			} else { // если бесплатные подписки уже не доступны, формируем платную подписку
				$this->arrServiceFields['token'] = 'payment';
				$this->arrServiceFields['token_datetime'] = terms::calcDateTimeOfTerm(CONF_SUBSCRIPTIONS_PAYMENT_DELETE);
				$this->arrServiceFields['payment'] = 'yes';
			}

			$this->arrServiceFields['date_lastsend'] = terms::currentDate();
		}

		// записываем данные в таблицу
		$result = ($this->setSubscrSubj($arrBindFields, $arrNoBindFields) && $this->addEntry()) ? true : false;

		// если подписка не платная, возвращаем результат
		if ('payment' !== $this->arrServiceFields['token']) {
			return $result;
		} else { // иначе, формируем даные для оплаты и переадресовываем пользователя на страницу оплат
			// проверяем, есть ли у нас ID только что добавленной записи
			if (!$id = $this->getLine_id()) { // если нет, возвращаем false
				return false;
			} else { // иначе, формируем данные и переадресовываем пользователя на страницу оплат
				$_SESSION['payment'] = array('service' => 'subscr_' . strtolower($arrBindFields['type_subscription']), 'id' => $id);
				messages::messageChangeSaved(MESSAGE_SUBSCRIPTION_ADD_PAYMENT, MESSAGE_SUBSCRIPTION_ADD_PAYMENT_TEXT, chpu::createChpuUrl(CONF_SCRIPT_URL . 'index.php?ut=' . $_SESSION['sd_user'][DB_PREFIX . 'conf']['user_type'] . '&amp;do=payments'), 15000);
			}
		}
	}

	/**
	 * protected функция активирует подписку
	 *
	 * @param array $arrBindFields - массив полей обязательных для заполнения
	 * @param array $arrNoBindFields - массив полей не обязательных для заполнения
	 *
	 * @return bool
	 */
	protected function actSubscr(&$arrBindFields, &$arrNoBindFields, &$type_announce) {
		if (!empty($type_announce) && isset($arrNoBindFields['id_announce']) && $arrNoBindFields['id_announce'] && isset($GLOBALS[$type_announce])) {
			$objCaller = & $GLOBALS[$type_announce];

			if (!$arrAnnounceData = $objCaller->retDataSubj()) {
				return false;
			}

			$id_announce = $arrAnnounceData['id'];
			$this->arrServiceFields = array_intersect_key($arrAnnounceData, $this->arrServiceFields);
		}

		return ($this->setSubscrSubj($arrBindFields, $arrNoBindFields) && $this->editEntrys(secure::escQuoteData($this->arrServiceFields), "id_announce IN (" . secure::escQuoteData($id_announce) . " AND token IN ('new')")) ? true : false;
	}

	/**
	 * protected функция редактирует подписку
	 *
	 * @param (array) $arrData - массив данных для обновления (key: name field => val: value field)
	 * @param (string) $strWhere - выражение для оператора WHERE (необязательный параметр)
	 *
	 * @return bool
	 */
	public function editSubscr(&$arrData, &$strWhere) {
		return $this->editEntrys(secure::escQuoteData($arrData), $strWhere);
	}

	/**
	 * protected функция обновления подписок
	 *
	 * @param (array) $arrData - массив данных для обновления (key: name field => val: value field)
	 * @param (mixed) $where - выражение для оператора WHERE. Может быть строкой или массивом, содержащим id записей для обновления (id_1, id_2, ..., id_n)
	 *
	 * @return bool
	 */
	protected function updateSubscriptions(&$arrData, &$where) {
		(is_array($where)) ? $strWhere = "id IN (" . implode(',', secure::escQuoteData($where)) . ")" : $strWhere = & $where;

		return $this->editEntrys(secure::escQuoteData($arrData), $strWhere);
	}

	/**
	 * private функция помечает подписки как "удаленные"
	 *
	 * @param (string) $strWhere - выражение для оператора WHERE (необязательный параметр)
	 *
	 * @return bool
	 */
	protected function delSubscriptions(&$strWhere) {
		$arrFields = array(
			'token' => 'deleted',
			'token_datetime' => terms::currentDateTime()
		);

		return $this->editEntrys(secure::escQuoteData($arrFields), $strWhere);
	}

	/**
	 * private функция помечает подписки как "удаленные"
	 *
	 * @param (array) $arrIDs - массив, содержащий id записей для удаления
	 *
	 * @return bool
	 */
	protected function delSubscriptionsById($arrIDs) {
		return $this->delEntrys('id IN (' . implode(',', secure::escQuoteData($arrIDs)) . ')');
	}

	/**
	 * private функция передает значения полей полученных из формы в свойсво базового класса, для последующей записи в таблицу БД
	 *
	 * @return bool
	 */
	private function setSubscrSubj(&$arrBindFields, &$arrNoBindFields) {
		$this->initTableFields();

		return $this->fillTableFieldsValue($this->arrServiceFields + $arrBindFields + $arrNoBindFields);
	}

	/**
	 * protected функция выполняет рассылку, в ссответствии с полученными параметрами
	 *
	 * @param (array) $arrData - массив данных, необходимых для рассылки
	 *
	 * @return bool
	 */
	protected function runSubscription($arrData) {
		// проверяем наличие необходимых данных
		if (!$this->validateSubscriptionData($arrData)) {
			return false;
		}

		// формируем данные для рассылки
		if ($data = $this->createSubscriptionData($arrData)) {
			$mailer = new mailer();
			// массив для замены в шаблоне
			$mailer->setAddReplace(array('%ANNOUNCE_TYPE%' => (('vacancy' === $arrData['type_subscription']) ? SITE_VACANCY : SITE_RESUME), '%DATA%' => $data));

			if ($mailer->sendEmail(CONF_MAIL_ADMIN_EMAIL, false, false, $arrData['email'], $arrData['email'], CONF_SITE_NAME . MAIL_SUBJ_SUBSCRIPTION_SEND, 'announce.subscription.txt')) {
				$this->editEntrys(secure::escQuoteData(array('date_lastsend' => terms::currentDate())), "email IN (" 
						. secure::escQuoteData($arrData['email']) . ") AND type_subscription IN (" 
						. secure::escQuoteData($arrData['type_subscription']) . ") AND id_profession IN (" 
						. secure::escQuoteData($arrData['id_profession']) . ") AND id_region IN (" 
						. secure::escQuoteData($arrData['id_region']) . ") AND id_city IN (" 
						. secure::escQuoteData($arrData['id_city']) . ") AND period IN (" 
						. secure::escQuoteData($arrData['period']) . ") AND token IN ('active')");
				return true;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}

	/**
	 * private функция проверки данных, необходимых для рассылки
	 * Проверяет наличие всех необходимых данных
	 *
	 * @param array $arrData - массив данных, необходимых для рассылки
	 *
	 * @return bool
	 */
	private function validateSubscriptionData($arrData) {
		if (!isset($arrData['email']) || !isset($arrData['id_section']) || !isset($arrData['id_profession']) || !isset($arrData['id_region']) || !isset($arrData['id_city']) || !isset($arrData['period']) || !isset($arrData['type_subscription'])) {
			return false;
		}

		if (!$arrData['email'] || !$arrData['id_section'] || !$arrData['id_region'] || !$arrData['period'] || !$arrData['type_subscription']) {
			return false;
		}

		return true;
	}

	/**
	 * private функция формирования данных для рассылки
	 *
	 * @param array $arrData - массив данных, необходимых для рассылки
	 *
	 * @return
	 */
	private function createSubscriptionData($arrData) {
		/**
		 * ФОРМИРУЕМ ЗАПРОС
		 */
		// формируем основной запрос для выборки объявлений
		$strWhere = "id_section IN (" . secure::escQuoteData($arrData['id_section']) . ") AND id_region IN (" . secure::escQuoteData($arrData['id_region']) . ") AND (TO_DAYS(NOW())-TO_DAYS(act_datetime))<=" . $arrData['period'];

		// добавляем в запрос город
		($arrData['id_city']) ? $strWhere .= " AND id_city IN (" . secure::escQuoteData($arrData['id_city']) . ")" : null;

		// добавляем в запрос профессию
		if ($arrData['id_profession']) {
			switch ($arrData['type_subscription']) {
				case 'vacancy':
					$strWhere .= " AND id_profession IN (" . secure::escQuoteData($arrData['id_profession']) . ")";
					break;

				case 'resume':
					$strWhere .= " AND (id_profession IN (" . secure::escQuoteData($arrData['id_profession']) . ") OR id_profession_1 IN (" . secure::escQuoteData($arrData['id_profession']) . ") OR id_profession_2 IN (" . secure::escQuoteData($arrData['id_profession']) . "))";
					break;
			}
		}

		/**
		 * ВЫПОЛНЯЕМ ЗАПРОС
		 */
		// меняем рабочую таблицу, на таблицу объявлений
		$this->changeTable($arrData['type_subscription']);

		// формируем список полей, которые необходимо получить
		//$arrFields = array('id', 'title', 'id_section', 'id_region', 'id_city', 'pay_from', 'currency');
		//('vacancy' === $arrData['type_subscription']) ? array_push($arrFields, 'pay_post') : null;
		// получаем список объявлений, соответствующих параметрам подписки
		if ('vacancy' === $arrData['type_subscription']) {
			$vacancy = new vacancy();
			$arrAnnounces = $vacancy->getActiveAnnounces(false, $strWhere);
		} else {
			$resume = new resume();
			$arrAnnounces = $resume->getActiveAnnounces(false, $strWhere);
		}

		// меняем рабочую таблицу, на таблицу подписок
		$this->changeTable('subscription');

		return $this->prepareSubscriptionData($arrData, $arrAnnounces);
	}

	/**
	 * private функция формирования данных для рассылки
	 *
	 * @param array $arrData - массив данных подписки
	 * @param array $arrAnnounces - массив данных, которые попадают в рассылку (на данный момент это: наименование объявления, город, зарплата и валюта)
	 *
	 * @return
	 */
	private function prepareSubscriptionData($arrData, $arrAnnounces) {
		// формируем массив необходимых городов
		global $citys;
		$arrCitys = $citys->retCategorysByParentIds($arrData['id_region']);

		/**
		 * ФОРМИРУЕМ ДАННЫЕ ДЛЯ ПИСЬМА
		 */
		if ($arrAnnounces) {
			// если формат отправки писем HTML, формируем рассылку в HTML-формате
			if (CONF_MAIL_FORMAT_HTML) {
				// формируем таблицу с объявлениями
				$data = '<table class="subscr_table">';

				foreach ($arrAnnounces as $value) {
					$city = $citys->retCategorysByIds($value['id_city']);

					$data .= '<tr>';

					if ('vacancy' === $arrData['type_subscription']) {

						$data .= '<td><a href="' . CONF_SCRIPT_URL . 'index.php?ut=competitor&do=vacancy&action=view&id=' . $value['id'] . '">' . $value['title'] . '</a></td>';
						$data .= '<td>' . $city[$value['id_city']]['name'] . '</td>';
						$data .= '<td>' . $value['pay_from'] . '-' . $value['pay_post'] . ' ' . $value['currency'] . '</td>';
					} else {
						$data .= '<td><a href="' . CONF_SCRIPT_URL . 'index.php?ut=employer&do=resume&action=view&id=' . $value['id'] . '">' . $value['title'] . '</a></td>';
						$data .= '<td>' . $city[$value['id_city']]['name'] . '</td>';
						$data .= '<td>' . $value['pay_from'] . ' ' . $value['currency'] . '</td>';
					}

					$data .= '</tr>';
				}

				$data .= '</table>';
			} else { // иначе, формируем рассылку в text-фоормате
				$data = '';

				foreach ($arrAnnounces as $value) {
					$city = $citys->retCategorysByIds($value['id_city']);

					$data .= $value['title'] . "\n\n";

					if ('vacancy' === $arrData['type_subscription']) {
						if ($value['pay_post']) {
							$data .= $city[$value['id_city']]['name'] . ': ' . $value['pay_from'] . '-' . $value['pay_post'] . ' ' . $value['currency'] . "\n\n";
						} else {
							$data .= $city[$value['id_city']]['name'] . ': ' . $value['pay_from'] . ' ' . $value['currency'] . "\n\n";
						}

						$data .= CONF_SCRIPT_URL . 'index.php?ut=competitor&do=vacancy&action=view&id=' . $value['id'] . "\n\n";
						$data .= '**************************************************' . "\n\n";
					} else {
						$data .= $city[$value['id_city']]['name'] . ': ' . $value['pay_from'] . ' ' . $value['currency'] . "\n";
						$data .= CONF_SCRIPT_URL . 'index.php?ut=employer&do=resume&action=view&id=' . $value['id'] . "\n";
						$data .= '**************************************************' . "\n\n";
					}
				}
			}
		} else {
			return false;
		}

		return $data;
	}

	/////////////////////////////////////////////////
	// END OF CLASS bsubscr
	/////////////////////////////////////////////////
}
