<?php
/********************************************************
	JobExpert v1.0
	powered by Script Developers Group (SD-Group)
	email: info@sd-group.org.ua
	url: http://sd-group.org.ua/
	Copyright 2010-2015 (c) SD-Group
	All rights reserved
=========================================================
 Базовый Класс работы с модами оплат
********************************************************/
/**
* @package
* @todo в методе generateModsList сделать проверку на наличие необходимых файлов
*/

(!defined('SDG')) ? die ('Triple protection!') : null;

/**
* Базовый Класс работы с модами оплат
* 
*/
abstract class bpayments extends tbentrys
{
	/////////////////////////////////////////////////
	// VARS - свойства класса bpayments
	/////////////////////////////////////////////////
	/**
	* $arrServiceFields - свойство для хранения массива сервисных полей в БД таблицах объявлений
	* Массив иницирован наименованиями служебных полей таблицы
	* 
	* @var array
	*/
	private $arrServiceFields = array(
										'token'	=> ''
    								 );

	/**
	* private $arrDirs: свойство хранит все каталоги платежных модулей
	* 
	* @var array
	*/
	private $arrDirs = array();

	/**
	* private $arrMods: свойство хранит все платежные модули, которые есть в таблице
	* 
	* @var array
	*/
	private $arrMods = array();

	/**
	* private $arrTables: свойства хранят таблицы платежей
	* 
	* @var array
	*/
	private $modTable = 'payments_mods';
	private $logTable = 'payments_logs';

	/////////////////////////////////////////////////
	// CONSTRUCTOR - конструктор класса bpayments
	/////////////////////////////////////////////////

	/**
	* конструктор
	* 
	* @return void
	*/
	protected function __construct()
	{
		$this -> setTable($this -> modTable);
	}

	/////////////////////////////////////////////////
	// METHODS - методы класса bpayments
	/////////////////////////////////////////////////

	/**
	* protected Функция генерации данных для вывода существующих модов оплат
	* 
	* @return array or false
	*/
	protected function generateModsList()
	{
		$arrData = array();
		// получаем все каталоги в папке модов оплат
		$this -> arrDirs = filesys::getChildDirs('core/mods/payments/');
		$this -> arrMods = ($this -> getEntrys("token IN ('active', 'disabled')", false, false, false)) ? $this -> retData() : false;

		// если модулей нет
		if (!$this -> arrDirs && !$this -> arrMods)
		{
			return false;
		}

		// формируем массив с имеющимися модами и их состоянием
		foreach ($this -> arrDirs as $dir)
		{
			// проверяем наличие обязательных файлов мода
			if ($this -> checkBindFiles($dir))
			{
				// добавляем мод с токеном new
				$arrMod = array('id' => $dir, 'token' => 'new');

				// проверяем есть ли моды в таблице (уже установленные моды), и если есть, получаем их даные
				if ($this -> arrMods)
				{
					foreach ($this -> arrMods as $mod)
					{
						(in_array($dir, $mod)) ? $arrMod = $mod : null;
					}
				}

				// добавляем мод в массив
				$arrData[] = $arrMod;
			}
		}

		return $arrData;
	}

	/**
	* protected функция получает данные записи
	* 
	* @param (string) $strWhere - выражение для оператора WHERE
	* @param (array) $fields - массив полей для выборки (key: index => val: name field). По у молчанию false
	* 
	* @return array or false
	*/
	protected function pGetRecord(&$strWhere, $fields = false)
	{
		return $this -> getEntry($strWhere, $fields) ? $this -> retDataSubj() : false;
	}

 	/**
	* protected функция обновления записей
	* 
	* @param (array) $arrData - массив данных для обновления (key: name field => val: value field)
	* @param (string) $strWhere - выражение для оператора WHERE or false (по умолчанию false)
	* 
	* @return bool
	*/
	protected function pUpdateRecords(&$arrData, $strWhere = false)
	{
		return $this -> editEntrys(secure::escQuoteData($arrData), $strWhere);
	}

	/**
	* protected Функция получения активных модулей оплат
	* 
	* @return array or false
	*/
	protected function getActiveMods()
	{
		$this -> arrMods = ($this -> getEntrys("token IN ('active')", false, false, false)) ? $this -> retData() : false;

		return $this -> arrMods;
	}
	
	/**
	* protected Функция проверяет наличие обязательных файлов мода
	* 
	* @param (string) $mod - id мода
	* 
	* @return bool
	*/
	protected function checkBindFiles(&$mod)
	{
		if (!file_exists('core/mods/payments/' . $mod . '/conf/' . $mod . '.conf.php'))
		{
			return false;
		}

		if (!file_exists('core/mods/payments/' . $mod . '/conf/' . $mod . '.tariffs.php'))
		{
			return false;
		}

		if (!file_exists('core/mods/payments/' . $mod . '/index.php'))
		{
			return false;
		}

		if (!file_exists('core/mods/payments/' . $mod . '/templates/images/logo.png'))
		{
			return false;
		}

		return true;
	}

	/**
	* protected Функция проверяет, установлена ли цена в тарифной сетке для выбранной услуги
	* 
	* @param (string) $service - строка, определяющая услугу (соответствует одному из ключей массива $arrTariffs)
	* @param (array) $arrTariffs - тарифная сетка мода
	* 
	* @return bool
	*/
	protected function checkPriceInTariff(&$service, &$arrTariffs)
	{
		return (!$service || !$arrTariffs || !isset($arrTariffs[$service]) || $arrTariffs[$service] <= 0) ? false : true;
	}
	
	/**
	* protected Функция возвращает описание выбранной услуги
	* 
	* @param (string) $service - строка, определяющая услугу (соответствует одному из ключей массива $arrTariffs)
	* 
	* @return string or false
	*/
	protected function generatePaymentDescription(&$service)
	{
		return (!defined('SITE_PAYMENT_DESCRIPTION_' . strtoupper($service))) ? @SITE_PAYMENT_DESCRIPTION_NOT_DEFINE : constant('SITE_PAYMENT_DESCRIPTION_' . strtoupper($service));
	}

	/**
	* protected Функция проверяет наличие мода в БД
	* 
	* @param (string) $strWhere - выражение для оператора WHERE
	* 
	* @return bool
	*/
	protected function issetMod(&$strWhere)
	{
		return $this -> issetRow($strWhere);
	}

	/**
	* protected Функция установки модов (добавления их в БД)
	* 
	* @param $arrMods - массив модов, которые необходимо установить (array('liqpay', 'smscoin', ...))
	* 
	* @return bool
	*/
	protected function installMods(&$arrMods)
	{
		if (empty($arrMods) || !is_array($arrMods))
		{
			return false;
		}

		$this -> arrServiceFields['token'] = 'disabled';

		foreach ($arrMods as $value)
		{
			if (!$this -> issetMod("id IN (" . secure::escQuoteData($value) . ") AND token IN ('active', 'disabled')"))
			{
				// заполняем значения полей таблицы
				$this -> fillTableFieldsValue(array('id' => $value) + $this -> arrServiceFields);
				// выполняем вставку в таблицу
				$this -> addEntry();
			}
		}

		return true;
	}

	/**
	* protected функция удаляет выбранные моды
	* 
	* @param (array) $arrMods - массив, содержащий id модов для удаления
	* 
	* @return bool
	*/
	protected function deleteMods(&$arrMods)
	{
		if (!$arrMods)
		{
			return false;
		}

		$strWhere = 'id IN (' . implode(',', secure::escQuoteData($arrMods)) . ')';

		$this -> delEntrys($strWhere);
		
		foreach ($arrMods as $value)
		{
			filesys::removeDirRec('core/mods/payments/' . $value . '/');
		}

		return true;
	}

	/**
	* protected функция включает/выключает выбранные моды
	* 
	* @param (array) $arrMods - массив, содержащий id модов для включения/выключения
	* @param (bool) $falg - флаг (true|false) определяющий, включить (true) или выключить (false) мод. По умолчанию true.
	* 
	* @return bool
	*/
	protected function enableMods(&$arrMods, $flag = true)
	{
		if (!$arrMods)
		{
			return false;
		}

		$this -> arrServiceFields['token'] = (!$flag) ? 'disabled' : 'active';
		$strWhere = 'id IN (' . implode(',', secure::escQuoteData($arrMods)) . ')';

		return $this -> editEntrys(array('token' => secure::escQuoteData($this -> arrServiceFields['token'])), $strWhere);
	}

	/**
	* protected функция сохраняет настройки выбранного мода
	* 
	* @param (string) $mod - id мода, настройки которого необходимо сохранить
	* @param (array) $arrData - массив, содержащий парметры, которые необходимо записать (по идее это весь масив $_POST)
	* 
	* @return bool
	*/
	protected function saveModConf(&$mod, &$arrData)
	{
		// если файла не существует
		if (!file_exists('core/mods/payments/' . $mod . '/conf/' . $mod . '.conf.php'))
		{
			return false;
		}
		
		// формируем данные для записи
		$data = "<?php\n\n"
			  . "(!defined('SDG')) ? die ('Triple protection!') : null;\n\n";

		foreach ($arrData as $key => $value)
		{
			if ('conf' !== $key)
			{
				$data .= 'define("' . strtoupper($mod) . '_CONF_' . strtoupper($key) . '", "' . $value . '");' . "\n\n";
			}
		}

		return file_put_contents('core/mods/payments/' . $mod . '/conf/' . $mod . '.conf.php', $data);
	}

	/**
	* protected функция сохраняет тарифную сетку выбранного мода
	* 
	* @param (string) $mod - id мода, тарифы которого необходимо сохранить
	* @param (array) $arrData - массив, содержащий парметры, которые необходимо записать (по идее это весь масив $_POST)
	* 
	* @return bool
	*/
	protected function saveModTariffs(&$mod, &$arrTariffs, &$arrPayments)
	{
		// если файла не существует
		if (!file_exists('core/mods/payments/' . $mod . '/conf/' . $mod . '.tariffs.php'))
		{
			return false;
		}
		else
		{
			// формируем данные для записи
			$data = "<?php\n\n"
				  . "(!defined('SDG')) ? die ('Triple protection!') : null;\n\n"
				  .	'$arrTariffs = array(' . "\n";

			foreach (array_keys($arrPayments) as $payment)
			{
				$arrData[] = "	'$payment' => " . (isset($arrTariffs[$payment]) && is_numeric($arrTariffs[$payment]) ? $arrTariffs[$payment] : 0);
			}

			$data .= implode(",\n", $arrData) . "\n);\n";

			return file_put_contents('core/mods/payments/' . $mod . '/conf/' . $mod . '.tariffs.php', $data);
		}
	}

	/**
	* protected функция выполняет необходимое действие, в соответствии с полученными параметрами
	* 
	* @param (string) $action - строка, определяющая услугу (соответствует одному из ключей массива $arrTariffs)
	* @param (string) $id - id строки в БД, с которой необходимо выполнить действие
	* @param (string) $logData - строка параметров платежа, для записи в таблицу логов оплат
	* @param (int) $order_id - номер платежа в системе
	* 
	* @return bool
	*/
	protected function doAction(&$action, &$id, &$logData, $order_id)
	{
		switch ($action)
		{
			case 'register_agent':
			case 'register_company':
			case 'register_employer':
			case 'register_competitor':
				$user = new user();
				$user -> updateConfUser(array('token' => 'active'), "id IN (" . secure::escQuoteData($id) . ")");
				$this -> logPayment($logData, $order_id);
				break;

			case 'add_resume':
				$resume = new resume();
				$resume -> paymentAnnounce($id);
				$this -> logPayment($logData, $order_id);
				break;

			case 'add_vacancy':
				$vacancy = new vacancy();
				$vacancy -> paymentAnnounce($id);
				$this -> logPayment($logData, $order_id);
				break;

			case 'vip_resume':
				$resume = new resume();
				$resume -> setVip($id);
				$this -> logPayment($logData, $order_id);
				break;

			case 'vip_vacancy':
				$vacancy = new vacancy();
				$vacancy -> setVip($id);
				$this -> logPayment($logData, $order_id);
				break;

			case 'hot_resume':
				$resume = new resume();
				$resume -> setHot($id);
				$this -> logPayment($logData, $order_id);
				break;

			case 'hot_vacancy':
				$vacancy = new vacancy();
				$vacancy -> setHot($id);
				$this -> logPayment($logData, $order_id);
				break;

			case 'rate_resume':
				$resume = new resume();
				$resume -> setRate($id);
				$this -> logPayment($logData, $order_id);
				break;

			case 'rate_vacancy':
				$vacancy = new vacancy();
				$vacancy -> setRate($id);
				$this -> logPayment($logData, $order_id);
				break;

			case 'subscr_vacancy':
			case 'subscr_resume':
				$subscription = new subscription();
				$subscription -> editSubscr(array('token' => 'active'), "id IN (" . secure::escQuoteData($id) . ")");
				$this -> logPayment($logData, $order_id);
				break;
		}

		return true;
	}

	/**
	* protected функция разбивает сервисную строку на массив
	* На данный момент строка содержите: наименование услуги и id строки в БД, с которой необходимо произвести действие,
	* разделеннные двойным двоеточием (::) $_SESSION['payment']['service']::$_SESSION['payment']['id']
	*
	* @param (string) $str - сервисная строка
	* 
	* @return array
	*/	
	protected function explodeServiceString(&$str)
	{
		return explode('::', $str);
	}

	/**
	* protected функция логирования оплат
	* 
	* @param (string) $logData - (serialized array) строка параметров платежа, для записи в таблицу логов оплат
	* @param (int) $order_id - номер платежа в системе
	* 
	* @return bool
	*/
	public function logPayment(&$logData, $order_id)
	{
		$this -> changeTable($this -> logTable);
		$arrData = array(
					'order_id'		=> $order_id,
					'data'			=> $logData,
					'date'			=> terms::currentDateTime()
				);
		$logData = unserialize($logData);
		(!empty($logData['payment_type'])) ? $arrData['payment_type'] = strtoupper($logData['payment_type']) : null;
		(!empty($logData['status'])) ? $arrData['status'] = strtoupper($logData['status']) : null;

		$this -> fillTableFieldsValue($arrData);
		$result = $this -> addEntry();
		$this -> changeTable($this -> modTable);

		return $result;
	}

	/**
	* protected функция получает данные одной записи
	* 
	* @param (string) $strWhere - выражение для оператора WHERE
	* @param (array) $fields - массив полей для выборки (key: index => val: name field). По у молчанию false
	* 
	* @return array or bool
	*/
	protected function pDBGetLogPayment(&$strWhere, $fields = false)
	{
		$this -> changeTable($this -> logTable);
		$result = $this -> getEntry($strWhere, $fields) ? $this -> retDataSubj() : false;
		$this -> changeTable($this -> modTable);
		return $result;
	}

	/**
	* protected функция получения данных из таблицы логов оплат
	* 
	* @param (string) $strWhere - условие WHERE для запроса or false
	* @param (array) $arrOrderBy - массив параметров сортировки результата выборки (key: name field => val: ASC | DESC) or false (в этом случае сортировка 'datetime' => 'DESC')
	* @param (string) $strLimit - выражение для оператора LIMIT or false
	* @param (array) $fields - массив полей для выборки (key: index => val: name field)
	* 
	* @return bool
	*/
	protected function pDBGetLogPayments(&$strWhere, &$arrOrderBy, &$strLimit, &$fields)
	{
		$this -> changeTable($this -> logTable);

		(empty($arrOrderBy) || !is_array($arrOrderBy)) ? $arrOrderBy = array('date' => 'DESC') : null;

		$result = $this -> getEntrys($strWhere, $arrOrderBy, $strLimit, $fields, false);
		$this -> changeTable($this -> modTable);

		return $result;
	}

	/**
	* protected Функция подсчитывает кол-во строк в БД
	* 
	* @param (string) $strWhere - выражение для оператора WHERE, если false, то подсчет строк берется из SELECT FOUND_ROWS
	* 
	* @return int or false
	*/
	protected function pDBCntLogPayments(&$strWhere)
	{
		$this -> changeTable($this -> logTable);
		return (!$strWhere) ? $this -> calcFoundRows() : $this -> cntEntrys($strWhere);
		$this -> changeTable($this -> modTable);
	}

	/**
	* protected функция помечает строки как удаленные
	* 
	* @param (string) $strWhere - выражение для оператора WHERE (необязательный параметр)
	* 
	* @return bool
	*/
	protected function pDBDeleteLogPayments(&$strWhere)
	{
		$this -> changeTable($this -> logTable);
		$result = $this -> delEntrys($strWhere);
		$this -> changeTable($this -> modTable);
		return $result;
	}

 	/**
	* protected функция обновления записей
	* 
	* @param (array) $arrData - массив данных для обновления (key: name field => val: value field)
	* @param (array) $arrID - массив, содержащий id записей для обновления (id_1, id_2, ..., id_n)
	* @param (string) $strWhere - выражение для оператора WHERE or false (по умолчанию false)
	* 
	* @return bool
	*/
	protected function pDBUpdateLogPayments(&$arrData, &$arrID, $strWhere = false)
	{
		$strWhere = (!$strWhere) ? "id IN (" . implode(',', secure::escQuoteData($arrArticles)) . ")" : $strWhere . " AND id IN (" . implode(',', secure::escQuoteData($arrArticles)) . ")";

		return $this -> editEntrys(secure::escQuoteData($arrData), $strWhere);
	}


	/**
	* protected функция обработки успешной оплаты
	* 
	* @param (string) $action - строка, определяющая услугу (соответствует одному из ключей массива $arrTariffs)
	* 
	* @return выводит сообщение и выполняет переадресацию страницы
	*/
	protected function succesAnswer(&$action)
	{
		switch ($action)
		{
			case 'register_agent':
			case 'register_company':
			case 'register_employer':
			case 'register_competitor':
				unset ($_SESSION['payment']);
				messages::messageChangeSaved(MESSAGE_PYMENT_WAS_SUCCESS, MESSAGE_PYMENT_WAS_SUCCESS_REGISTER  . ' ' . MESSAGE_REGISTER_SUCCESS_TEXT, 'index.php?ut=competitor&do=authorize', 10000);
				break;

			case 'add_resume':
			case 'add_vacancy':
				$typeAnnounce = $_SESSION['payment']['announce_type'];
				$idAnnounce = $_SESSION['payment']['id'];
				unset ($_SESSION['payment']);
				messages::messageChangeSaved(MESSAGE_PYMENT_WAS_SUCCESS, ANNOUNCE_ADD_SUCCESS_TITLE  . '<br><br>' . ANNOUNCE_ADD_SUCCESS_MESSAGE, 'index.php?ut=' . $_SESSION['sd_user'][DB_PREFIX . 'conf']['user_type'] . '&amp;do=' . $typeAnnounce . '&action=view&id=' . $idAnnounce, 10000);
				break;

			case 'vip_resume':
			case 'hot_resume':
			case 'rate_resume':
				$idAnnounce = $_SESSION['payment']['id'];
				unset ($_SESSION['payment']);
				messages::messageChangeSaved(MESSAGE_PYMENT_WAS_SUCCESS, false, 'index.php?ut=' . $_SESSION['sd_user'][DB_PREFIX . 'conf']['user_type'] . '&amp;do=resume&action=view&id=' . $idAnnounce, 5000);
				break;

			case 'vip_vacancy':
			case 'hot_vacancy':
			case 'rate_vacancy':
				$idAnnounce = $_SESSION['payment']['id'];
				unset ($_SESSION['payment']);
				messages::messageChangeSaved(MESSAGE_PYMENT_WAS_SUCCESS, false, 'index.php?ut=' . $_SESSION['sd_user'][DB_PREFIX . 'conf']['user_type'] . '&amp;do=vacancy&action=view&id=' . $idAnnounce, 5000);
				break;

			case 'subscr_vacancy':
			case 'subscr_resume':
				unset ($_SESSION['payment']);
				messages::messageChangeSaved(MESSAGE_PYMENT_WAS_SUCCESS, MESSAGE_SUBSCRIPTION_WAS_SUCCESS_PAYMENT, 'index.php?ut=competitor&do=subscription', 10000);
				break;
		}

		return true;
	}


	/**
	* protected функция рассылки почтовых сообщений администратору при оплате на сайте
	* 
	* @param (string) $data - данные платежа
	* @param (string) $status - статус платежа. (SUCCESS - успешно, FAIL - ошибка, WRONG PARAMS - оплата прошла, но от сервера smscoin получены неверные параметры)
	* 
	* @return void
	*/
	protected function sendAdminEmail(&$data, $status)
	{
		$mailer = new mailer();
		// массив для замены в шаблоне
		$mailer -> setAddReplace(array(
										'%STATUS%' => strtoupper($status),
										'%DATA%' => nl2br($data),
										'%ADMIN_PANEL%' => filesys::setPath(CONF_SCRIPT_URL) . CONF_ADMIN_FILE
									));
									
		$mailer -> sendEmail(CONF_MAIL_ADMIN_EMAIL, false, false, CONF_MAIL_ADMIN_EMAIL, false, MAIL_SUBJ_ADM_PAYMENT, 'adm.payment.txt');
	}
 
 	/////////////////////////////////////////////////
	// END OF CLASS bpayments
	/////////////////////////////////////////////////
}
