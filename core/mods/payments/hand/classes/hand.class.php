<?php
/********************************************************
	JobExpert v1.0
	powered by Script Developers Group (SD-Group)
	email: info@sd-group.org.ua
	url: http://sd-group.org.ua/
	Copyright 2010-2015 (c) SD-Group
	All rights reserved
=========================================================
 	Класс работы с модом оплаты HAND
********************************************************/
/**
* @package
* @todo
*/

(!defined('SDG')) ? die ('Triple protection!') : null;

/**
* Класс работы с модом оплаты HAND
* 
*/

class hand extends tbentrys
{
	/////////////////////////////////////////////////
	// VARS - свойства класса hand
	/////////////////////////////////////////////////

	/**
	* $arrServiceFields - свойство для хранения массива сервисных полей в таблицах БД
	* Массив иницирован наименованиями служебных полей таблицы
	* 
	* @var array
	*/
	private $arrServiceFields = array(
						'datetime'	=> '',
						'token'		=> ''
					);

	/**
	* Массив для хранения наименований и значений полей для записи в таблицу БД
	* В этом массиве хранятся поля обязательные для заполнения
	* 
	* @var array
	*/
	public $arrBindFields = array(
						'order_id'		=> '',
						'action'		=> '',
						'user_id'		=> '',
						'record_id'		=> '',
						'amount'		=> '',
						'currency'		=> '',
						'payment_type'	=> ''
					);

	/**
	* Дополнительные поля, не входящие в таблицу, но необходимые для использования в методах
	* @var array
	*/
	public $additionalFields = array(
						'description'		=> '', // описание выбранной услуги
						'payment_type_desc'	=> '' // название выбранного типа оплаты
					);

	/////////////////////////////////////////////////
	// CONSTRUCTOR - конструктор класса hand
	/////////////////////////////////////////////////

	/**
	* конструктор
	* 
	* @return void
	*/
	public function __construct()
	{
		$this -> setTable('payments_mod_hand');
	}

	/////////////////////////////////////////////////
	// METHODS - методы класса hand
	/////////////////////////////////////////////////
	/**
	* private функция передает значения полей полученных из формы в свойсво класса, для последующей записи в таблицу БД
	* 
	* @return bool
	*/
	private function setRecordSubj()
	{
		return $this -> fillTableFieldsValue($this -> arrServiceFields + $this -> arrBindFields);
	}

	/**
	* функция получения данных записи
	* 
	* @param (string) $strWhere - строка, условие для запроса
	* 
	* @return (array or false)
	*/
	public function getRecord($strWhere)
	{
		return ($this -> getEntry($strWhere)) ? $this -> retDataSubj() : false;
	}

	/**
	* функция получения данных записей
	* 
	* @param (string) $strWhere - условие WHERE для запроса or false
	* @param (array) $arrOrderBy - массив параметров сортировки результата выборки (key: name field => val: ASC | DESC) or false
	* @param (mixed) $arrLimit - false or массив параметров для оператора LIMIT (key: 'strLimit' => val: string of LIMIT for example: '0, 10', key: 'calcRows' => val: true | false) or false
	* @param (array) $arrFields - массив полей для выборки (key: index => val: name field) or false
	* 
	* @return (array or false)
	*/
	public function getRecords($strWhere, $arrOrderBy, $arrLimit, $arrFields)
	{
		return ($this -> getEntrys($strWhere, $arrOrderBy, $arrLimit, $arrFields)) ? $this -> retData() : false;
	}

	/**
	* public функция производит запись данных в таблицу БД
	* 
	* @return bool
	*/
	public function recRecord()
	{
		$this -> arrServiceFields['datetime'] = terms::currentDateTime();
		$this -> arrServiceFields['token'] = 'active';

		return (($this -> setRecordSubj() && $this -> addEntry())) ? $this -> adminPaymentNotification() : false;
	}

	/**
	* public функция обновления записи
	* 
	* @param (array) $arrData - массив данных для обновления (key: name field => val: value field)
	* @param (array) $strWhere - строка, условие для запроса (по умолчанию false)
	* 
	* @return bool
	*/
	public function updateRecord(&$arrData, $strWhere = false)
	{
		return $this -> editEntrys(secure::escQuoteData($arrData), $strWhere);
	}

	/**
	* public Функция удаления записей по Id
	* 
	* @param (array) $arrId - массив, содержащий ID записей, которые нужно удалить
	* 
	* @return bool
	*/
	public function deleteRecordsById(&$arrId)
	{
		return $this -> delEntrys("id IN (" . implode(",", secure::escQuoteData($arrId)) . ")");
	}

	/**
	* public Функция удаления платежа, с отправкой уведомления пользователю
	* 
	* @param (array) $Id - ID записи, которую нужно удалить
	* @param (array) $userEmail - email пользователя, которому отправить уведомление
	* @param (array) $message - сообщение, которое будет вставлено в письмо
	* 
	* @return bool
	*/
	public function deletePayment(&$Id, &$userEmail, &$message)
	{
		$arrId = array($Id);
		if (!$this -> deleteRecordsById($arrId))
		{
			return false;
		}
		else
		{
			$this -> userPaymentNotification('delete', $userEmail, $message);
		}

		return true;
	}

	/**
	* public функция отправки платежа в обработку
	* 
	* @param (int) $Id - ID записи, которую нужно удалить
	* @param (string) $userEmail - email пользователя, которому отправить уведомление
	* @param (string) $message - сообщение, которое будет вставлено в письмо
	* @param (array) $arrFiles - пути к файлам файлы (вложения в письмо)
	* 
	* @return bool
	*/
	public function processingPayment(&$Id, &$userEmail, &$message, &$arrFiles = false)
	{
		$arrData = array('message' => $message, 'token' => 'processing');
		if (!$this -> updateRecord($arrData, "id IN (" . secure::escQuoteData($Id) . ")"))
		{
			return false;
		}
		else
		{
			$this -> userPaymentNotification('processing', $userEmail, $message, $arrFiles);
		}

		return true;
	}

	/**
	* public функция закрытия платежа
	* 
	* @param (array) $arrData - содержит все параметры платежа
	* @param (array) $strWhere - строка, условие для запроса (по умолчанию false)
	* 
	* @return bool
	*/
	public function closePayment(&$arrData, &$userEmail, &$message)
	{
		$payments = new payments();
		$logData = $this -> generateLogData($arrData);

		if ($payments -> doAction($arrData['action'], $arrData['record_id'], $logData, $arrData['order_id']))
		{
			$arrId = array($arrData['id']);
			$this -> deleteRecordsById($arrId);
			$this -> userPaymentNotification('close', $userEmail, $message);
		}
		else
		{
			return false;
		}

		return true;
	}

	/**
	* функция формирует строку для записи в лог платежей
	* Строка логов должна обязательно начинаться с наименования платежной системы.
	*
	* @param (array) $arrData - массив параметров платежа
	* 
	* @return string (serialsed array)
	*/	
	protected function generateLogData(&$arrData)
	{
		(!empty($arrData['message'])) ? $arrData['message'] = base64_encode($arrData['message']) : null;
		return serialize(array('payment_type' => 'HAND') + $arrData + array('status' => 'SUCCESS'));
	/*
		$retStr = 'HAND::';
		foreach ($arrData as $key => $value)
		{
			$retStr .= $key . '=>' . $value . '::';
		}

		$retStr .= 'SUCCESS';
		return $retStr;
	*/
	}



	/*************** ОТПРАВКА ПОЧТОВЫХ СООБЩЕНИЙ ***************/
	/**
	* protected функция уведомления администратора о добавлении платежа
	* 
	* @return bool
	*/
	protected function adminPaymentNotification()
	{
		$mailer = new mailer();

		// массив для замены в шаблоне
		$mailer -> setAddReplace(array(
										'%ORDER_ID%' => $this -> arrBindFields['order_id'],
										'%DESCRIPTION%' => $this -> additionalFields['description'],
										'%AMOUNT%' => $this -> arrBindFields['amount'],
										'%CURRENCY%' => $this -> arrBindFields['currency'],
										'%PAYMENT_TYPE%' => $this -> additionalFields['payment_type_desc'],
										'%DATE%' => $this -> arrServiceFields['datetime'],
										'%ADMIN_PANEL%' => filesys::setPath(CONF_SCRIPT_URL) . CONF_ADMIN_FILE
									));

		return $mailer -> sendEmail(CONF_MAIL_ADMIN_EMAIL, false, false, CONF_MAIL_ADMIN_EMAIL, false, MAIL_SUBJ_ADM_PAYMENT, 'adm.payment.hand.add.txt');
	}

	/**
	* protected функция уведомления пользователя о платеже
	* 
	* @param (int) $action - действие
	* @param (string) $userEmail - email пользователя, которому отправить уведомление
	* @param (string) $message - сообщение, которое будет вставлено в письмо
	* @param (array) $arrFiles - пути к файлам файлы (вложения в письмо)
	* 
	* @return bool
	*/
	protected function userPaymentNotification($action, &$userEmail, &$message, &$arrFiles = false)
	{
		if (empty($action) || empty($userEmail) || empty($message))
		{
			return false;
		}

		$mailer = new mailer();

		// проверяем действие
		switch ($action)
		{
			case 'processing':
				$mailSubj = HAND_MAIL_SUBJECT_PROCESSING_PAYMENT;
				$comment = HAND_MAIL_COMMENT_PROCESSING_PAYMENT;
				// вложения
				if (is_array($arrFiles) && !empty($arrFiles))
				{
					foreach ($arrFiles as $value)
					{
						$value = ltrim($value, '/');
						(file_exists($value)) ? $mailer -> AddAttachment($value) : null;
					}
				}
				break;

			case 'close':
				$mailSubj = HAND_MAIL_SUBJECT_CLOSE_PAYMENT;
				$comment = HAND_MAIL_COMMENT_CLOSE_PAYMENT;
				break;

			case 'delete':
				$mailSubj = HAND_MAIL_SUBJECT_DELETE_PAYMENT;
				$comment = HAND_MAIL_COMMENT_DELETE_PAYMENT;
				break;
		}
		// массив для замены в шаблоне
		$mailer -> setAddReplace(array(
										'%COMMENT%'	=> $comment,
										'%MESSAGE%'	=> $message
									));

		return $mailer -> sendEmail(CONF_MAIL_ADMIN_EMAIL, false, false, $userEmail, $userEmail, $mailSubj, 'payment.hand.message.txt');
	}

	/***********************************************************/ 

	/////////////////////////////////////////////////
	// END OF CLASS hand
	/////////////////////////////////////////////////
}


