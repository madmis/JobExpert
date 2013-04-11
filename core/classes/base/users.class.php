<?php

/**
 * Powered by Script Developers Group (SD-Group)
 * Email: info@sd-group.org.ua
 * URL: http://sd-group.org.ua/
 * Copyright 2010-2015 (c) SD-Group
 * All rights reserved
 * ======================================================
 * Базовый Класс работы с Пользователями
 * ======================================================
 *
 * @package
 *
 * @todo
 *
 */
(!defined('SDG')) ? die('Triple protection!') : null;

/**
 * Базовый Класс работы с пользователями
 */
abstract class users extends tbentrys {

	/////////////////////////////////////////////////
	// VARS - свойства класса users
	/////////////////////////////////////////////////
	/**
	 * $arrServiceFields - свойство для хранения массива сервисных полей в БД таблицах объявлений
	 * Массив иницирован наименованиями служебных полей таблицы
	 *
	 * @var array
	 */
	private $arrServiceFields = array(
		'reg_datetime' => '',
		'reg_ip' => '',
		'pre_ip' => '',
		'curr_ip' => '',
		'token' => '',
		'token_datetime' => ''
	);

	/**
	 * Признак авторизации пользователя
	 *
	 * @var bool
	 */
	private $authorized;

	/**
	 * Свойство для хранения ошибок (на данный момент используется только для загрузки логотипа)
	 *
	 * @var array
	 */
	private $arrErrors = array();
	private $arrPayments;

	/////////////////////////////////////////////////
	// CONSTRUCTOR - конструктор класса users
	/////////////////////////////////////////////////

	/**
	 * конструктор
	 *
	 * @return void
	 */
	protected function __construct() {
		// устанавливаем имя рабочей таблицы
		$this->setTable('users', USR_PREFIX);
		// инициируем список платных услуг
		(!empty($GLOBALS['arrPayments'])) ? $this->arrPayments = & $GLOBALS['arrPayments'] : null;
		// массив (список) файлов кешируемых данных
		$arrCacheFiles = array(
			'caching/company.logo.cache',
			'caching/statistic.cache'
		);

		// формируем массив параметров для вызова конструктора родительского класса
		$arrParams = array(
			'arrCacheFiles' => &$arrCacheFiles,
			'tIdForce' => true
		);

		// вызываем конструктор родительского класса
		parent::__construct($arrParams);
	}

	/////////////////////////////////////////////////
	// METHODS - методы класса users
	/////////////////////////////////////////////////

	/**
	 * protected функция возвращает свойство $tbData
	 *
	 * @return array or false
	 */
	protected function retData() {
		return parent::retData();
	}

	/**
	 * protected функция смены рабочей таблицы
	 *
	 * @param $postfix - название таблицы
	 * @param $prefix - префикс таблицы (false по умолчанию)
	 *
	 * @return void
	 */
	protected function changeTable($postfix, $prefix = false) {
		return parent::changeTable($postfix, $prefix);
	}

	/**
	 * private функция проверки авторизации пользователя
	 * Берет логин и пароль юзера из сесси и сверяет их с данными в БД
	 *
	 * @return bool
	 */
	private function checkUserSessionLogin() {
		if (isset($_SESSION['sd_user']['data']['email']) && isset($_SESSION['sd_user']['data']['password'])) {
			$strWhere = "email IN (" . secure::escQuoteData($_SESSION['sd_user']['data']['email']) . ") AND password IN (" . secure::escQuoteData($_SESSION['sd_user']['data']['password']) . ")";

			return $this->issetRow($strWhere);
		} else {
			return false;
		}
	}

	/**
	 * protected функция инициализации признака авторизации
	 *
	 * @return bool
	 */
	protected function initAuthorized() {
		return $this->authorized = $this->checkUserSessionLogin();
	}

	/**
	 * protected функция получения признака авторизации
	 *
	 * @return bool
	 */
	protected function getAuthorized() {
		return $this->authorized;
	}

	/**
	 * private функция передает значения полей полученных из формы в свойсво базового класса, для последующей записи в таблицу БД
	 *
	 * @param mixed $arrBindFields
	 *
	 * @return bool
	 */
	private function setUserSubj($arrBindFields) {
		return $this->fillTableFieldsValue($this->arrServiceFields + $arrBindFields);
	}

	/**
	 * protected Функция проверяет наличие пользователя в БД
	 *
	 * @param (string) $strWhere - строка, условие для запроса
	 *
	 * @return bool
	 */
	protected function issetUser($strWhere) {
		return $this->issetRow($strWhere);
	}

	/**
	 * protected Функция авторизации пользователя
	 *
	 * @param (string) $email - email для авторизации
	 * @param (string) $password - пароль для авторизации
	 * @param (bool) $remember - признак записи данных пользователя в куки
	 * @param (bool) $cookie - признак авторизации из кукисов (если true, значит пароль передается уже в MD5)
	 *
	 * @return bool
	 */
	protected function authorizeUser($email, $password, $remember, $cookie) {
		(!$cookie) ? $password = md5($password) : null;

		// считываем данные пользователя
		if ($this->getEntry("email IN (" . secure::escQuoteData($email) . ") AND password IN (" . secure::escQuoteData($password) . ") AND token IN ('active')")) {
			$group = new group();

			// получаем данные пользователя
			$arrData = $this->retDataSubj();

			/*			 * *** Сохраняем IP-адрес пользователя **** */
			$updData = array('pre_ip' => $arrData['curr_ip'], 'curr_ip' => $_SERVER['REMOTE_ADDR']);
			// Если ip, запоминаемый при регистрации пустой, записываем текущий
			// это временная мера, для уже существующих пользователей
			// так сделано потому, что поля ip-адресов были добавлены позже, чем появились превые пользователи
			// в дальнейшем эту проверку можно убрать
			(empty($arrData['reg_ip'])) ? $updData['reg_ip'] = $_SERVER['REMOTE_ADDR'] : null;

			$strWhere = "id=" . secure::escQuoteData($arrData['id']);
			$this->updateUser($updData, $strWhere);

			// если установлен признак "Запомнить", записываем данные пользователя в куки
			if ($remember) {
				cookies::setCookieSite('remid', $arrData['id'], 7);
				cookies::setCookieSite('remh', $this->cookieUserHash($arrData), 7);
			}

			// сохраняем данные пользователя в сессию
			$arrData = array_merge($arrData, $updData);
			$_SESSION['sd_user']['data'] = $arrData;

			// переопределяем рабочую таблицу
			$this->changeTable('conf_users');

			// Проверяем, есть ли настройки пользователя в таблице conf_users.
			// Может быть такой вариант, когда пользователь зарегистрирован в другой доске.
			// В этом случае в общей таблице он будет, а в таблице настроек нет.
			// Тогда мы добавляем его в таблицу настроек.
			if (!$this->getEntry("id IN (" . secure::escQuoteData($arrData['id']) . ")")) {
				$this->fillTableFieldsValue(array('id' => $arrData['id'], 'token' => 'new'));
				$this->addEntry();
				$arrData = array('id' => $arrData['id'], 'user_type' => '', user_group => '', 'token' => 'new');
			} else {
				// если пользователь есть в таблице conf_users,
				// получаем данные конфигурации пользователя
				$arrData = $this->retDataSubj();
			}

			// сохраняем данные пользователя в сессию
			$_SESSION['sd_user'][DB_PREFIX . 'conf'] = $arrData;

			$_SESSION['sd_' . DB_PREFIX . 'codex'] = $group->setUserRights($arrData['user_type'], $arrData['user_group']);

			$this->changeTable('users', USR_PREFIX);

			return true;
		} else {
			return false;
		}
	}

	/**
	 * protected Функция подсчитывает кол-во пользователей БД
	 *
	 * @param (string) $strWhere - выражение для оператора WHERE, если false, то подсчет строк берется из SELECT FOUND_ROWS
	 *
	 * @return int or false
	 */
	protected function cntUsers($strWhere) {
		return (!$strWhere) ? $this->calcFoundRows() : $this->cntEntrys($strWhere);
	}

	/**
	 * функция подсчета активных пользователей
	 *
	 * @return (int)
	 */
	public function cntActiveUsers() {
		// переопределяем рабочую таблицу
		$this->changeTable('conf_users');

		// подсчитываем количество активных пользователей
		$result = $this->cntUsers("token IN ('active')");

		// переопределяем рабочую таблицу
		$this->changeTable('users', USR_PREFIX);

		return $result;
	}

	/**
	 * protected функция получения данных пользователя
	 *
	 * @param (string) $strWhere - строка, условие для запроса
	 *
	 * @return (array or false)
	 */
	protected function getUser($strWhere) {
		return ($this->getEntry($strWhere)) ? $this->retDataSubj() : false;
	}

	/**
	 * protected функция получения данных всех пользователей
	 *
	 * @param (string) $strWhere - строка, условие для запроса
	 *
	 * @return (array or false)
	 */
	protected function getUsers($strWhere) {
		return ($this->getEntrys($strWhere, false, false, false)) ? $this->retData() : false;
	}

	/**
	 * protected функция получает данные пользователя из двух таблиц (main_users и job_conf_users)
	 *
	 * @param (int) $id - ID-пользователя
	 * @param (array) $arrFields - массив полей, которые нужно получить. Массив должен быть следующего вида: array(array('алиас_таблицы', 'поле1'), array('алиас_таблицы', 'поле2')). ПРИМЕР: array(array('users', 'id'), array('users', 'email')) or false
	 *
	 * @return array or false
	 */
	protected function getCombinedUserData(&$id, $arrFields = false) {
		// массивы - псевдонимы таблиц и поля, которые необходимо выбрать
		$arrConf['tableFields'] = !empty($arrFields) ? $arrFields : array(array('users', '*'), array('conf_users', '*'));

		// джоины с условием
		$arrConf['leftJoins'] = array(
			array(
				'table' => array(DB_PREFIX . 'conf_users', 'conf_users'),
				'on' => "users.id=conf_users.id"
			)
		);
		// условие запроса
		$arrConf['strWhere'] = "users.id IN (" . secure::escQuoteData($id) . ")";

		return ($this->getSubSelectEntry($arrConf)) ? $this->retData() : false;
	}

	/**
	 * protected функция получает данные всех пользователей из двух таблиц (main_users и job_conf_users)
	 *
	 * @param (array) $arrFields - массив полей, которые нужно получить. Массив должен быть следующего вида: array(array('алиас_таблицы', 'поле1'), array('алиас_таблицы', 'поле2')). ПРИМЕР: array(array('users', 'id'), array('users', 'email')) or false
	 * @param (string) $strWhere - строка, условие для запроса or false. Поля условия должны обязательно содержать алиас таблицы, к которой они относятся (users или conf_users). ПРИМЕР: 'conf_users.token='active'.
	 * @param (array) $arrOrderBy - массив параметров сортировки результата выборки (key: name field => val: ASC | DESC) or false
	 * @param (string) $strLimit - example: '0, 10' or false
	 *
	 * @return array or false
	 */
	protected function getCombinedUsersData(&$arrFields, &$strWhere, &$arrOrderBy, &$strLimit) {
		// массивы - псевдонимы таблиц и поля, которые необходимо выбрать
		$arrConf['tableFields'] = !empty($arrFields) ? $arrFields : array(array('users', '*'), array('conf_users', '*'));

		// джоины с условием
		$arrConf['leftJoins'] = array(
			array(
				'table' => array(DB_PREFIX . 'conf_users', 'conf_users'),
				'on' => "users.id=conf_users.id"
			)
		);

		// условие запроса
		$arrConf['strWhere'] = (!$strWhere) ? "conf_users.token IN ('active')" : $strWhere;
		// подсчет строк
		$arrConf['calcRows'] = true;
		// LIMIT
		$arrConf['strLimit'] = & $strLimit;

		return ($this->getSubSelectEntrys($arrOrderBy, true, $arrConf)) ? $this->retData() : false;
	}

	/**
	 * protected Функция получает данные по коду активации
	 *
	 * @param (string) $code - код активации
	 *
	 * @return bool
	 */
	protected function getUserByCode($code) {
		return ($this->getEntry("MD5(email)=" . secure::escQuoteData($code) . " AND token IN ('new')")) ? true : false;
	}

	/**
	 * protected функция производит запись данных в таблицу БД
	 * Рассылает почтовые сообщения
	 *
	 * @param array $arrBindFields - массив полей обязательных для заполнения
	 *
	 * @return bool
	 */
	protected function recUser($arrBindFields) {
		$arrBindFields['password'] = md5($arrBindFields['password']);
		// если включена активация пользователей, выставляем дату удаления аккаунта, иначе, выставляем дату регистрации
		CONF_USER_ACTIVATE ? $this->arrServiceFields['token_datetime'] = terms::calcDateTimeOfTerm(CONF_USER_ACTIVATE_DELETE) : $this->arrServiceFields['reg_datetime'] = terms::currentDateTime();
		$this->arrServiceFields['token'] = CONF_USER_ACTIVATE ? 'new' : 'active';
		$this->arrServiceFields['reg_ip'] = $_SERVER['REMOTE_ADDR'];

		// записываем пользователя
		if ($this->setUserSubj($arrBindFields) && $this->addEntry()) {
			// получаем данные пользователя
			$arrData = $this->retDataSubj();
			// изменяем рабочую таблицу
			//$this -> changeTable('conf_users');
			$confQuery = "REPLACE " . DB_PREFIX . "conf_users (id, token) VALUES ('" . $arrData['id'] . "','new')";
			// записываем данные в таблицу настроек пользователей
			if (db::dbQuery($confQuery)) {
				//if ($this -> fillTableFieldsValue(array('id' => $arrData['id'], 'token' => 'new')) && $this -> addEntry())
				// изменяем рабочую таблицу
				//$this -> changeTable('users', USR_PREFIX);
				// рассылаем почтовые сообщения
				$this->sendEmails($arrBindFields);
			} else {
				// если не удалось записать настройки пользователей
				// изменяем рабочую таблицу
				//$this -> changeTable('users', USR_PREFIX);
				// удаляем запись из таблицы пользователей
				$this->delEntrys("id IN (" . secure::escQuoteData($arrData['id']) . ")");
				return false;
			}
		} else {
			return false;
		}
	}

	/**
	 * protected функция добавления пользователя администратором
	 *
	 * @param (array) $arrData - массив данных пользователя для записи в основную таблицу пользователей
	 * @param (array) $arrConfData - массив данных пользователя для записи в таблицу настроек пользователей
	 * @param bool $mail - признак уведомления пользователя (TRUE | FALSE)
	 *
	 * @return bool
	 */
	protected function addAdminUser($arrData, $arrConf, $mail) {
		// сохраняем пароль для отправки его пользователю в письме
		$password = $arrData['password'];
		$arrData['password'] = md5($arrData['password']);
		$this->arrServiceFields['reg_datetime'] = terms::currentDateTime();
		$this->arrServiceFields['token'] = 'active';

		// записываем пользователя
		if ($this->setUserSubj($arrData) && $this->addEntry()) {
			// получаем данные пользователя
			$arrData = $this->retDataSubj();
			// изменяем рабочую таблицу
			$this->changeTable('conf_users');
			// записываем данные в таблицу настроек пользователей
			if ($this->fillTableFieldsValue(array('id' => $arrData['id'], 'token' => 'active') + $arrConf) && $this->addEntry()) {
				// высылаем уведомление
				($mail) ? $this->addUserSendEmail(array('email' => $arrData['email'], 'password' => $password)) : null;

				// изменяем рабочую таблицу
				$this->changeTable('users', USR_PREFIX);
				return true;
			} else {
				// если не удалось записать настройки пользователей
				// изменяем рабочую таблицу
				$this->changeTable('users', USR_PREFIX);
				// удаляем запись из таблицы пользователей
				$this->delEntrys("id IN (" . secure::escQuoteData($arrData['id']) . ")");
				return false;
			}
		} else {
			return false;
		}
	}

	/**
	 * protected функция производит активацию аккаунта пользователя
	 * Отсылает админу сообщение о регистрации нового пользователя
	 *
	 * @return bool
	 */
	protected function activateUser() {
		// получаем данные пользователя
		$arrData = $this->retDataSubj();

		// обновляем данные пользователя
		if ($this->updateUser(array('reg_datetime' => terms::currentDateTime(), 'token' => 'active', 'token_datetime' => terms::calcDateTimeOfTerm(CONF_USER_NOT_TYPE_DELETE)), "id IN (" . secure::escQuoteData($arrData['id']) . ")")) {
			$this->sendAdminEmail($arrData['email']);
			return true;
		} else {
			return false;
		}
	}

	/**
	 * protected функция производит активацию пользователей
	 * Если передан соответствующий параметр, отсылает пользователям сообщения об активации
	 *
	 * @param array $arrUsers - Массив с данными пользователей, которых необходимо активировать (формат: array(id => email, ....))
	 * @param bool $mail - признак уведомления пользователей об активации (TRUE | FALSE)
	 *
	 * @return bool
	 */
	protected function activateUsersAdmin(&$arrUsers, $mail) {
		$strWhere = "id IN (" . implode(',', secure::escQuoteData(array_keys($arrUsers))) . ")";

		// обновляем данные пользователей
		if ($this->updateUser(array('reg_datetime' => terms::currentDateTime(), 'token' => 'active', 'token_datetime' => terms::calcDateTimeOfTerm(CONF_USER_NOT_TYPE_DELETE)), $strWhere)) {
			// если админ выбрал отправку уведомлений, рассылаем письма
			if ($mail) {
				$this->actionSendUsersEmails($arrUsers, 'activate');
			}

			return true;
		} else {
			return false;
		}
	}

	/**
	 * protected функция производит активацию пользователей
	 *
	 * @param array $arrUsers - Массив с данными пользователей, которых необходимо активировать (формат: array(id => email, ....))
	 *
	 * @return bool
	 */
	protected function activateConfUsersAdmin(&$arrUsers) {
		$strWhere = "id IN (" . implode(',', secure::escQuoteData(array_keys($arrUsers))) . ")";

		// обновляем данные пользователей
		if ($this->updateConfUser(array('token' => 'active'), $strWhere)) {
			return true;
		} else {
			return false;
		}
	}

	/**
	 * protected функция производит активацию пользователей, которые состояли на модерации
	 *
	 * @param array $arrUsers - Массив с данными пользователей, которых необходимо активировать (формат: array(id => email, ....))
	 *
	 * @return bool
	 */
	protected function moderateUsersAdmin($arrUsers) {
		$arrIDAgents = array();
		$arrIDCompanys = array();
		$arrIDEmployers = array();
		$arrIDCompetitors = array();
		$arIDs = array();

		$this->changeTable('conf_users');
		// формируем условия и токены в отдельности для каждого типа пользователя
		// соответственно будем выполнять запросы отдельно
		// токен будет зависеть от того, платная ли регистрация для текущего типа или нет
		if ($this->arrPayments['register_agent']) {
			$strWhereAgent = "id IN (" . implode(",", secure::escQuoteData(array_keys($arrUsers))) . ") AND user_type IN ('agent')";
			$arrDataAgent = array('token' => 'payment');
			// получаем id пользователей, для которых token_datetime необходимо установить в статус оплаты
			$arrIDAgents = $this->getEntrys($strWhereAgent, false, false, array('id')) ? $this->retData() : array();
		} else {
			$strWhereAgent = "id IN (" . implode(",", secure::escQuoteData(array_keys($arrUsers))) . ") AND user_type IN ('agent')";
			$arrDataAgent = array('token' => 'active');
		}

		if ($this->arrPayments['register_company']) {
			$strWhereCompany = "id IN (" . implode(",", secure::escQuoteData(array_keys($arrUsers))) . ") AND user_type IN ('company')";
			$arrDataCompany = array('token' => 'payment');
			// получаем id пользователей, для которых token_datetime необходимо установить в статус оплаты
			$arrIDCompanys = $this->getEntrys($strWhereCompany, false, false, array('id')) ? $this->retData() : array();
		} else {
			$strWhereCompany = "id IN (" . implode(",", secure::escQuoteData(array_keys($arrUsers))) . ") AND user_type IN ('company')";
			$arrDataCompany = array('token' => 'active');
		}

		if ($this->arrPayments['register_employer']) {
			$strWhereEmployer = "id IN (" . implode(",", secure::escQuoteData(array_keys($arrUsers))) . ") AND user_type IN ('employer')";
			$arrDataEmployer = array('token' => 'payment');
			// получаем id пользователей, для которых token_datetime необходимо установить в статус оплаты
			$arrIDEmployers = $this->getEntrys($strWhereEmployer, false, false, array('id')) ? $this->retData() : array();
		} else {
			$strWhereEmployer = "id IN (" . implode(",", secure::escQuoteData(array_keys($arrUsers))) . ") AND user_type IN ('employer')";
			$arrDataEmployer = array('token' => 'active');
		}

		if ($this->arrPayments['register_competitor']) {
			$strWhereCompetitor = "id IN (" . implode(",", secure::escQuoteData(array_keys($arrUsers))) . ") AND user_type IN ('competitor')";
			$arrDataCompetitor = array('token' => 'payment');
			// получаем id пользователей, для которых token_datetime необходимо установить в статус оплаты
			$arrIDCompetitors = $this->getEntrys($strWhereCompetitor, false, false, array('id')) ? $this->retData() : array();
		} else {
			$strWhereCompetitor = "id IN (" . implode(",", secure::escQuoteData(array_keys($arrUsers))) . ") AND user_type IN ('competitor')";
			$arrDataCompetitor = array('token' => 'active');
		}

		// объединяем массивы id пользователей, для которых token_datetime необходимо установить в статус оплаты
		$arrID = array_merge($arrIDAgents, $arrIDCompanys, $arrIDEmployers, $arrIDCompetitors);
		foreach ($arrID as $value) {
			$arIDs[] = $value['id'];
		}

		// обновляем данные пользователей
		if ($this->updateConfUser($arrDataAgent, $strWhereAgent) && $this->updateConfUser($arrDataCompany, $strWhereCompany) && $this->updateConfUser($arrDataEmployer, $strWhereEmployer) && $this->updateConfUser($arrDataCompetitor, $strWhereCompetitor)) {
			($arIDs) ? $this->editEntrys(array('token_datetime' => secure::escQuoteData(terms::calcDateTimeOfTerm(CONF_USER_PAYMENT_DELETE))), "id IN (" . implode(",", secure::escQuoteData($arIDs)) . ")") : null;
			$this->actionSendUsersEmails($arrUsers, 'moderate');
			return true;
		} else {
			return false;
		}
	}

	/**
	 * protected функция производит обновление данных пользователя,
	 * в соответствии с выбранным типом учетной записи
	 * данные обновляются и в БД и в Сессии
	 *
	 * @param (array) $arrData - массив содержащий данные пользователя для обновления array('first_name', 'last_name', 'phone', 'user_type')
	 * @param (array) $arrPayments - массив платных услуг (определенных администратором)
	 *
	 * @return string (состояние moderate, active или payment) or false
	 */
	protected function selectUserType($arrData, &$arrPayments) {
		// определяем группу для типа пользователя
		$user_group = (constant('CONF_' . strtoupper($arrData['user_type']) . '_REGISTER_DEFAULT_GROUP'));
		// определяем состояние учетной записи пользователя
		$group = new group();
		$arrRights = $group->setUserRights($arrData['user_type'], $user_group);
		// определяем токен учетной записи, в соответствии с обязанностями
		$token = ($arrRights['resp']['moder_account']) ? 'moderate' : (($arrPayments['register_' . strtolower($arrData['user_type'])]) ? 'payment' : 'active');
		// если пользователь выбрал платный тип, устанавливаем дату действия токена
		('payment' === $token) ? $this->arrServiceFields['token_datetime'] = terms::calcDateTimeOfTerm(CONF_USER_PAYMENT_DELETE) : null;

		// обновляем данные пользователя
		if ($this->updateUser(array('first_name' => $arrData['first_name'], 'last_name' => $arrData['last_name'], 'phone' => $arrData['phone'], 'token_datetime' => $this->arrServiceFields['token_datetime']), "id IN (" . secure::escQuoteData($_SESSION['sd_user']['data']['id']) . ")")) {
			// изменяем рабочую таблицу
			$this->changeTable('conf_users');

			// обновляем таблицу настроек пользователя
			if ($this->updateUser(array('user_type' => $arrData['user_type'], 'user_group' => $user_group, 'token' => $token), "id IN (" . secure::escQuoteData($_SESSION['sd_user']['data']['id']) . ")")) {
				// изменяем рабочую таблицу
				$this->changeTable('users', USR_PREFIX);

				// обновляем токен пользователя в сессии
				if ('active' === $token) {
					$_SESSION['sd_user']['data']['first_name'] = $arrData['first_name'];
					$_SESSION['sd_user']['data']['last_name'] = $arrData['last_name'];
					$_SESSION['sd_user']['data']['phone'] = $arrData['phone'];
					$_SESSION['sd_user'][DB_PREFIX . 'conf']['user_type'] = $arrData['user_type'];
					$_SESSION['sd_user'][DB_PREFIX . 'conf']['user_group'] = $user_group;
					$_SESSION['sd_user'][DB_PREFIX . 'conf']['token'] = $token;
					$_SESSION['sd_' . DB_PREFIX . 'codex'] = $arrRights;
				}

				return $token;
			} else {
				// изменяем рабочую таблицу
				$this->changeTable('users', USR_PREFIX);

				return false;
			}
		} else {
			return false;
		}
	}

	/**
	 * protected функция обновления данных пользователя
	 *
	 * @param (array) $arrData - массив данных для обновления (key: name field => val: value field)
	 * @param (array) $strWhere - строка, условие для запроса
	 *
	 * @return bool
	 */
	protected function updateUser($arrData, $strWhere = false) {
		return $this->editEntrys(secure::escQuoteData($arrData), $strWhere);
	}

	/**
	 * protected функция обновления данных пользователя в таблице conf_users
	 *
	 * @param (array) $arrData - массив данных для обновления (key: name field => val: value field)
	 * @param (array) $strWhere - строка, условие для запроса
	 *
	 * @return bool
	 */
	protected function updateConfUser($arrData, $strWhere = false) {
		$this->changeTable('conf_users');
		$result = $this->editEntrys(secure::escQuoteData($arrData), $strWhere);
		$this->changeTable('users', USR_PREFIX);

		return $result;
	}

	/**
	 * protected функция обновления данных пользователя
	 * функция может использоваться лишь в том случае, если пользователь вошел на сайт (его данные есть в сессии)
	 *
	 * @param (array) $arrData - массив данных пользователя для записи в основную таблицу пользователей or false
	 * @param (array) $arrConfData - массив данных пользователя для записи в таблицу настроек пользователей or false
	 *
	 * @return bool
	 */
	protected function updateUserData($arrData, $arrConfData) {
		// если переданы данные, для обновления в общей таблице пользователей
		if ($arrData) {
			// обновляем данные
			if (!$this->updateUser($arrData, "id IN (" . secure::escQuoteData($_SESSION['sd_user']['data']['id']) . ")")) {
				return false;
			} else {
				// если данные обновились, обновляем их и в сессии
				tools::updateSessionData($_SESSION['sd_user']['data'], $arrData);
			}
		}

		// если переданы данные для обновления в общей таблице настроек пользователей
		if ($arrConfData) {
			$this->changeTable('conf_users');
			if (!$this->updateUser($arrConfData, "id IN (" . secure::escQuoteData($_SESSION['sd_user']['data']['id']) . ")")) {
				// изменяем рабочую таблицу
				$this->changeTable('users', USR_PREFIX);

				return false;
			} else {
				// изменяем рабочую таблицу
				$this->changeTable('users', USR_PREFIX);

				// если данные обновились, обновляем их и в сессии
				tools::updateSessionData($_SESSION['sd_user'][DB_PREFIX . 'conf'], $arrConfData);
			}
		}

		return true;
	}

	/**
	 * protected функция возвращает хеш данных пользователя, хранящийся в кукисах
	 *
	 * @param (array) $arrData - масив данных пользователя
	 *
	 * @return string
	 */
	protected function cookieUserHash($arrData) {
		return md5($arrData['id'] . $arrData['email'] . $arrData['reg_datetime']);
	}

	/**
	 * protected функция очищает куки и сессию текущего пользователя
	 *
	 * @return void
	 */
	protected function clearUserSessionAndCookie() {
		cookies::deleteAccessCookie();
		unset($_SESSION['sd_job_codex'], $_SESSION['sd_user']);
	}

	/**
	 * protected функция загружает логотип
	 * @param (string) $field_name - им поля из формы загрузки файла
	 * @param (string) $upload_dir - директория, в которую загружать файл
	 * @return string (имя картинки) or false (если ф-я вернула false, можно получить ошибки из массива $arrErrors)
	 */
	protected function loadLogo($field_name, $upload_dir) {
		// пробуем загрузить файл
		if (uploads::uploadImage($field_name, $upload_dir)) {
			if (img::setParam(uploads::$arrUploadsSubj['file_name'], uploads::$arrUploadsSubj['upload_dir'])) {
				if (img::createThumbnail(100, 100)) {
					return true;
				} else {
					@unlink(uploads::$arrUploadsSubj['upload_dir'] . uploads::$arrUploadsSubj['file_name']);
					$this->arrErrors = ERROR_FILE_CREATE_THUMBNAIL;
					return false;
				}
			} else {
				$this->arrErrors = img::$arrErrors;
				return false;
			}
		} else { // если загрузить файл не удалось, устанавливаем ошибки
			$this->arrErrors = uploads::$arrErrors;
			return false;
		}
	}

	/**
	 * protected Функция установки ошибок
	 *
	 * @param (string) $error
	 *
	 * @return void
	 */
	private function setError($error) {
		$this->arrErrors[] = $error;
	}

	/**
	 * protected Функция установки ошибок
	 *
	 * @return array
	 */
	protected function getError() {
		return $this->arrErrors;
	}

	/**
	 * protected Функция генерации ссылки для подтверждения смены пароля пользователя
	 *
	 * $arrData - массив данных пользователя
	 *
	 * @return string
	 */
	protected function genLinkToChangePassword($arrData) {
		return CONF_SCRIPT_URL . 'index.php?ut=' . $_SESSION['sd_user'][DB_PREFIX . 'conf']['user_type'] . '&amp;do=new.pass&amp;i=' . md5($arrData['id']) . ';' . $arrData['password'] . ';' . session_id();
	}

	/**
	 * protected Функция проверяет правильность ссылки для подтверждения смены пароля пользователя
	 * В $_GET['i']: 1-й параметр это - md5(id)-пользователя; 2-ой - password-пользователя; 3-й - session_id (id текущей сессии)
	 *
	 * @return array (массив данных пользователя) or false
	 */
	protected function checkLinkToChangePassword() {
		$data = explode(';', $_GET['i']);

		if (session_id() === $data[2] && $userData = $this->getUser("md5(id)='" . $data[0] . "' AND password IN (" . secure::escQuoteData($data[1]) . ")")) {
			return $userData;
		} else {
			return false;
		}
	}

	/**
	 * protected Функция удаления пользователей по выражению WHERE
	 * Ф-я удаляет данные пользователей из таблиц: user, conf_users
	 *
	 * @param (array) $strWhere - строка для выражения WHERE
	 *
	 * @return bool
	 */
	protected function delUsers(&$strWhere = false) {
		// меняем рабочую таблицу
		$this->changeTable('conf_users');
		// удаляем данные из таблицы conf_users
		$this->delEntrys($strWhere);

		// меняем рабочую таблицу
		$this->changeTable('users', USR_PREFIX);
		// удаляем данные из основной таблицы пользователей
		return $this->delEntrys($strWhere);
	}

	/**
	 * protected Функция удаления пользователей
	 * Ф-я удаляет данные пользователей из таблиц: user, conf_users
	 * а также удаляет все объявления и подписки пользователей
	 *
	 * @param (array) $arrId - массив, содержащий ID пользователей, которых нужно удалить
	 * @param (bool) $vacancy, $resume, $subscription, $articles, $news - параметры, определяющие удаление соответствующих данных пользователя (TRUE || FALSE)
	 *
	 * @return bool
	 */
	protected function deleteUsers($arrId, $vacancy, $resume, $subscription, $articles, $news) {
		// формируем запрос, для выбора всех необходимых пользователей
		$strWhere = "id IN (" . implode(",", secure::escQuoteData($arrId)) . ")";

		// меняем рабочую таблицу
		$this->changeTable('conf_users');
		// получаем данные из таблицы conf_users
		// пробегаем по полученному массиву и удаляем пользователей и все данные, относящиеся к ним
		if ($arrUsers = $this->getUsers($strWhere . " AND logo!=''")) {
			foreach ($arrUsers as $value) {
				// если у пользователя есть логотип, удаляем его
				if ($value['logo'] && file_exists('uploads/images/logo/' . $value['logo'])) {
					@unlink('uploads/images/logo/' . $value['logo']);
					@unlink('uploads/images/logo/thumbs/thumb_' . $value['logo']);
				}
			}
		}

		// удаляем весь контент всех пользователей
		$this->deleteUsersContent($arrId, $vacancy, $resume, $subscription, $articles, $news);

		// удаляем данные из таблицы conf_users
		$this->delEntrys($strWhere);
		// меняем рабочую таблицу
		$this->changeTable('users', USR_PREFIX);
		// удаляем данные из основной таблицы пользователей
		return $this->delEntrys($strWhere);
	}

	/**
	 * protected Функция удаления контента пользователей
	 * Ф-я удаляет все объявления, подписки, статьи и новости пользователей
	 *
	 * @param (array) $arrId - массив, содержащий ID пользователей, контент которых нужно удалить
	 * @param (bool) $vacancy, $resume, $subscription, $articles, $news - параметры, определяющие удаление соответствующих данных пользователя (TRUE || FALSE)
	 *
	 * @return void
	 */
	protected function deleteUsersContent($arrId, $vacancy, $resume, $subscription, $articles, $news) {
		// формируем запрос, для выбора всех необходимых пользователей
		$strWhere = "id_user IN (" . implode(',', secure::escQuoteData($arrId)) . ")";

		// удаление вакансий
		if ($vacancy) {
			$vacancy = new vacancy();
			$vacancy->delAnnounces($strWhere);
		}

		// удаление резюме
		if ($resume) {
			$resume = new resume();
			$resume->delAnnounces($strWhere);
		}

		// удаление подписок
		if ($subscription) {
			$subscription = new subscription();
			$subscription->delSubscriptions($strWhere);
		}

		// удаление статей
		if ($articles) {
			$articles = new articles();
			$articles->deleteArticles(false, $strWhere);
		}

		// удаление новостей
		if ($news) {
			$news = new news();
			$news->deleteNews(false, $strWhere);
		}
	}

	/**
	 * protected AJAX Функция удаления логотипа пользователей
	 *
	 * @param (int) $Id - Id пользователя
	 *
	 * @return string (noisset - не найден польз., noupdate - не удалось обновить данные, 'ok' - успешно)
	 */
	protected function ajaxDeleteUserLogo(&$Id) {
		// проверяем существование пользователя
		$this->changeTable('conf_users', DB_PREFIX);
		if (!$uData = $this->getUser("id IN (" . secure::escQuoteData($Id) . ")")) {
			return 'noisset';
		} else {
			if ($this->updateConfUser(array('logo' => ''), "id IN (" . secure::escQuoteData($Id) . ")")) {
				@unlink('uploads/images/logo/' . $uData['logo']);
				@unlink('uploads/images/logo/thumbs/thumb_' . $uData['logo']);
				$_SESSION['sd_user'][DB_PREFIX . 'conf']['logo'] = '';
				return 'ok';
			} else {
				return 'noupdate';
			}
		}
	}

	/**
	 * protected Функция выборки логотипов для вывода на главной
	 *
	 * @return mixed (array | false)
	 */
	protected function getLogoToMain() {
		$arrFields = array(
			array('conf_users', 'id'),
			array('conf_users', 'company_name'),
			array('conf_users', 'company_city'),
			array('conf_users', 'logo')
		);

		$strWhere = "conf_users.main_logo AND conf_users.logo!='' AND conf_users.token IN ('active') AND conf_users.user_type IN ('company')";
		$arrOrderBy = array('conf_users.sort_logo' => 'ASC');

		if (CONF_ENABLE_CACHING) {
			if (false === ($result = caching::getCahing('caching/company.logo.cache'))) {
				$result = $this->getCombinedUsersData($arrFields, $strWhere, $arrOrderBy, false);

				(empty($result)) ? $result = array() : null;

				caching::setCaching('caching/company.logo.cache', $result);
			}
		} else {
			$result = $this->getCombinedUsersData($arrFields, $strWhere, $arrOrderBy, false);
		}

		return $result;
	}

	/**
	 * Функция выборки логотипов агентств для вывода на главной
	 * @return mixed (array | false)
	 */
	protected function getAgnLogoToMain() {
		$arrFields = array(
			array('conf_users', 'id'),
			array('conf_users', 'company_name'),
			array('conf_users', 'company_city'),
			array('conf_users', 'logo')
		);

		$strWhere = "conf_users.main_logo AND conf_users.logo!='' AND conf_users.token IN ('active') AND conf_users.user_type IN ('agent')";
		$arrOrderBy = array('conf_users.sort_logo' => 'ASC');

		/*if (CONF_ENABLE_CACHING) {
			if (false === ($result = caching::getCahing('caching/agency.logo.cache'))) {
				$result = $this->getCombinedUsersData($arrFields, $strWhere, $arrOrderBy, false);

				(empty($result)) ? $result = array() : null;

				caching::setCaching('caching/agency.logo.cache', $result);
			}
		} else {*/
			$result = $this->getCombinedUsersData($arrFields, $strWhere, $arrOrderBy, false);
		//}

		return $result;
	}

	/** МЕТОДЫ ОТПРАВКИ ПОЧТОВЫХ СООБЩЕНИЙ * */

	/**
	 * private функция рассылки почтовых сообщений пользователям при регистрации
	 * Завершает работу скрипта, выводом информационного сообщения пользователю
	 *
	 * @return void
	 */
	private function sendEmails($arrData) {
		$mailer = new mailer();

		// если включена активация пользователей
		if (CONF_USER_ACTIVATE) {
			// массив для замены в шаблоне
			$mailer->setAddReplace(array(
				'%DELDATE%' => date(terms::dateFormatFromSmarty(CONF_DATE_FORMAT, CONF_TIME_FORMAT), strtotime(terms::calcDateTimeOfTerm(CONF_USER_ACTIVATE_DELETE))),
				'%CODE%' => md5($arrData['email']),
				'%ACTIVATE_PAGE%' => chpu::createChpuUrl(CONF_SCRIPT_URL . 'index.php?ut=' . $_SESSION['sd_user'][DB_PREFIX . 'conf']['user_type'] . '&amp;do=user.activate'),
				'%ACTIVATE_LINK%' => CONF_SCRIPT_URL . 'index.php?ut=' . $_SESSION['sd_user'][DB_PREFIX . 'conf']['user_type'] . '&amp;do=user.activate&code=' . md5($arrData['email'])
			));

			// отправляем письмо пользователю
			if ($mailer->sendEmail(CONF_MAIL_ADMIN_EMAIL, false, false, $arrData['email'], $arrData['email'], MAIL_SUBJ_ACTIVATE_ACCOUNT . $arrData['email'], 'user.activate.txt')) {
				messages::messageChangeSaved(MESSAGE_REGISTER_SUCCESS, MESSAGE_REGISTER_SUCCESS_ACTIVATE_USER, chpu::createChpuUrl(CONF_SCRIPT_URL . 'index.php?ut=' . $_SESSION['sd_user'][DB_PREFIX . 'conf']['user_type'] . '&amp;do=user.activate'), 6000);
			} else {
				die(ERROR_SEND_EMAIL);
			}
		} else {
			if ($mailer->sendEmail(CONF_MAIL_ADMIN_EMAIL, false, false, $arrData['email'], $arrData['email'], MAIL_SUBJ_REGISTER . CONF_SITE_NAME, 'user.register.txt')) {
				// если включено уведомление админа о новых пользователях, отправляем админу ссобщение
				if (CONF_MAIL_ADMIN_USER_REGISTER) {
					$this->sendAdminEmail($arrData['email']);
				}

				messages::messageChangeSaved(MESSAGE_REGISTER_SUCCESS, false, chpu::createChpuUrl(CONF_SCRIPT_URL . 'index.php?ut=' . $_SESSION['sd_user'][DB_PREFIX . 'conf']['user_type'] . '&amp;do=authorize'));
			} else {
				die(ERROR_SEND_EMAIL);
			}
		}
	}

	/**
	 * private функция рассылки почтовых сообщений администратору при регистрации нового пользователя
	 * Завершает работу скрипта, выводом информационного сообщения пользователю
	 *
	 * @param (string) $email - email зарегистрированного пользователя
	 *
	 * @return void
	 */
	private function sendAdminEmail($email) {
		$mailer = new mailer();
		// массив для замены в шаблоне
		$mailer->setAddReplace(array(
			'%EMAIL%' => $email,
			'%ADMIN_PANEL%' => filesys::setPath(CONF_SCRIPT_URL) . CONF_ADMIN_FILE
		));

		$mailer->sendEmail(CONF_MAIL_ADMIN_EMAIL, false, false, CONF_MAIL_ADMIN_EMAIL, false, MAIL_SUBJ_NEW_USER, 'adm.reg.user.txt');
	}

	/**
	 * protected функция рассылки сообщений пользователям, в соответствии с действием
	 *
	 * @param array $arrUsers - массив пользователей, которым необходимо отправить сообщения. Формат: array(key => email, ...)
	 * @param string $action - действие, в соответствии с которым необходимо произвести рассылку сообщений. На данный момент есть три действия: activate - активация пользователя, состоящего на активации; delete - удаление пользователя, состоящего на модерации; moderate - активация пользователя, состоящего на модерации.
	 *
	 * @return void
	 */
	protected function actionSendUsersEmails($arrUsers, $action) {
		// проверяем действие
		if (!$action || ('activate' !== $action && 'moderate' !== $action && 'delete' !== $action)) {
			return false;
		}

		$mailer = new mailer();

		foreach ($arrUsers as $value) {
			// очищаем список адресов
			$mailer->ClearAddresses();

			// массив для замены в шаблоне
			$mailer->setAddReplace(array(
				'%AUTHORIZE_LINK%' => chpu::createChpuUrl(CONF_SCRIPT_URL . 'index.php?do=authorize')
			));

			// выполняем рассылку в соответствии с указанным действием
			switch ($action) {
				case 'activate':
					$mailer->sendEmail(CONF_MAIL_ADMIN_EMAIL, false, false, $value, false, MAIL_SUBJ_ADM_USER_ACTIVATE, 'user.activate.admin.txt');
					break;

				case 'moderate':
					$mailer->sendEmail(CONF_MAIL_ADMIN_EMAIL, false, false, $value, false, MAIL_SUBJ_ADM_USER_MODERATE, 'user.moderate.txt');
					break;

				case 'delete':
					$mailer->sendEmail(CONF_MAIL_ADMIN_EMAIL, false, false, $value, false, MAIL_SUBJ_ADM_USER_NO_MODERATE, 'user.not.moderate.txt');
					break;
			}
		}
	}

	/**
	 * protected функция отправки пользователю сообщения о том, что на сайт его добавил администратор
	 *
	 * @param (array) $arrData - Данные пользователя array('email' => email, 'password' => password)
	 *
	 * @return void
	 */
	protected function addUserSendEmail($arrData) {
		$mailer = new mailer();

		$mailer->setAddReplace(array(
			'%AUTHORIZE_LINK%' => chpu::createChpuUrl(CONF_SCRIPT_URL . 'index.php?do=authorize'),
			'%USER_LOGIN%' => $arrData['email'],
			'%USER_PASSWORD%' => $arrData['password']
		));

		$mailer->sendEmail(CONF_MAIL_ADMIN_EMAIL, false, false, $arrData['email'], false, MAIL_SUBJ_ADM_USER_ADD, 'user.add.admin.txt');
	}

	/**  END МЕТОДЫ ОТПРАВКИ ПОЧТОВЫХ СООБЩЕНИЙ	* */
	/////////////////////////////////////////////////
	// END OF CLASS users
	/////////////////////////////////////////////////
}
