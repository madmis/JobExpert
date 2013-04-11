<?php

/**
 * Powered by Script Developers Group (SD-Group)
 * Email: info@sd-group.org.ua
 * URL: http://sd-group.org.ua/
 * Copyright 2009 (c) SD-Group
 * All rights reserved
 * ===================================================
 * Класс работы с данными о просмотрах контента
 * ===================================================
 */
(!defined('SDG')) ? die('Triple protection!') : null;

/**
 * Класс работы с данными о просмотрах контента
 */
class storing extends tbentrys {
	/////////////////////////////////////////////////
	// VARS - свойства класса storing
	/////////////////////////////////////////////////

	/**
	 * Свойство хранящее массив значений сервисных полей таблицы БД
	 * @var array
	 */
	private $arrServiceFields;
	/**
	 * Свойство хранящее массив значений обязательных полей таблицы БД
	 * @var array
	 */
	private $arrBindFields;
	/**
	 * Свойство хранящее массив допустимых значений типов записей в таблице БД
	 * Используется для валидации значений в свойстве $arrBindFields['type']
	 * @var array
	 */
	private $arrTypes = array(
		'resume',
		'vacancy'
	);

	/////////////////////////////////////////////////
	// CONSTRUCTOR - конструктор класса storing
	/////////////////////////////////////////////////

	/**
	 * Конструктор
	 * Инициирует имя таблицы БД
	 * Инициирует массив сервисных полей (значения по умолчанию)
	 * Инициирует массив сервисных полей (значения по умолчанию)
	 */
	public function __construct() {
		// текущие дата и время в SQL-формате
		$datetime = date('Y-m-d H:i:s', time());
		// устанавливаем имя таблицы БД
		$this->setTable('storing');
		// инициируем массив сервисных полей (значения по умолчанию)
		$this->arrServiceFields = array(
			'token' => 'deleted'
		);
		// инициируем массив обязательных полей (значения по умолчанию)
		$this->arrBindFields = array(
			'type' => 'error',
			'id_content' => 0,
			'datetime' => $datetime
		);
		// инициируем свойство ID-пользователя (из текущей сессии)
		if (!empty($_SESSION['sd_user']['job_conf']['id'])) {
			$this->arrBindFields['id_user'] = (int) $_SESSION['sd_user']['job_conf']['id'];
		} else {
			$this->arrBindFields['id_user'] = 0;
		}
		// инициируем свойство IP-пользователя
		if (!empty($_SERVER['REMOTE_ADDR'])) {
			$this->arrBindFields['ip'] = $_SERVER['REMOTE_ADDR'];
		} else {
			$this->arrBindFields['ip'] = '';
		}
	}

	/////////////////////////////////////////////////
	// METHODS - методы класса storing
	/////////////////////////////////////////////////

	/**
	 * Метод выполняет запись данных о просмотрах контента в таблицу БД
	 *
	 * @return bool
	 */
	public function recStoring() {
		if ($this->validateStoringData()) {
			$this->arrServiceFields['token'] = 'active';
			if ($this->fillTableFieldsValue($this->arrBindFields + $this->arrServiceFields) && $this->addEntry()) {
				return true;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}

	/**
	 * Метод проверяет и устанавливает значения свойств для хранения в БД
	 *
	 * @param array $arrData - массив значений для установки
	 *
	 * @param string $arrData['type'] - тип записи
	 * @param int $arrData['id_content'] - ID-контента для хранения данных о просмотре
	 *
	 * @return bool
	 */
	public function setStoringData($arrData) {
		if (is_array($arrData) && !empty($arrData)) {
			// валидация ID-пользователя
			if (empty($this->arrBindFields['id_user']) || !strings::ifInt($this->arrBindFields['id_user'])) {
				return false;
			}
			// валидация типа записи
			if (empty($arrData['type']) || !in_array($arrData['type'], $this->arrTypes)) {
				return false;
			}
			// валидация ID-контента для хранения данных о просмотре
			if (empty($arrData['id_content']) || !strings::ifInt($arrData['id_content'])) {
				return false;
			}

			/**
			 * Проверяем наличие в таблице записи с такими данными
			 * Если нет, устанавливаем значения свойств для записи в БД и возвращаем TRUE
			 * Иначе возвращаем FALSE
			 */
			$strWhere = "type IN (" . secure::escQuoteData($arrData['type']) . ") "
					. "AND id_content IN(" . secure::escQuoteData($arrData['id_content']) . ") "
					. "AND id_user IN (" . secure::escQuoteData($this->arrBindFields['id_user']) . ")";
			if (!$this->getEntry($strWhere, array('id'))) {
				$this->arrBindFields['type'] = $arrData['type'];
				$this->arrBindFields['id_content'] = (int) $arrData['id_content'];

				return true;
			} else {
				return false;
			}
		} else {
			return false;
		}
	}

	/**
	 * Метод получает данные из БД
	 *
	 * @param array $arrData - массив
	 *
	 * @return array or bool
	 */
	public function getStoringData($arrData) {
		if (is_array($arrData) && !empty($arrData)) {
			// валидация типа записи
			if (empty($arrData['type']) || !in_array($arrData['type'], $this->arrTypes)) {
				return false;
			}
			// валидация массива
			if (!isset($arrData['arrIds']) || !is_array($arrData['arrIds'])) {
				return false;
			} else {
				foreach ($arrData['arrIds'] as $index => $id) {
					if (!strings::ifInt($id)) {
						unset($arrData['arrIds'][$index]);
					}
				}
				// проверка на пустой массив
				if (empty($arrData['arrIds'])) {
					return false;
				}
			}

			// массивы - псевдонимы таблиц и поля, которые необходимо выбрать
			$arrConf['tableFields'] = array(
				array('storing', 'id'),
				array('storing', 'id_content'),
				array('storing', 'id_user'),
				array('storing', 'ip'),
				array('storing', 'datetime'),
				array('users', 'email'),
				array('users', 'first_name'),
				array('users', 'last_name'),
				array('users', 'middle_name'),
				array('users', 'phone'),
				array('conf_users', 'addition_phone_1'),
				array('conf_users', 'addition_phone_2'),
				array('conf_users', 'user_type'),
				array('conf_users', 'company_name'),
				array('conf_users', 'company_city'),
				array('conf_users', 'company_description'),
				array('conf_users', 'logo')
			);

			// джоины с условием
			$arrConf['leftJoins'] = array(
				array(
					'table' => array(USR_PREFIX . 'users', 'users'),
					'on' => "storing.id_user=users.id"
				),
				array(
					'table' => array(DB_PREFIX . 'conf_users', 'conf_users'),
					'on' => "storing.id_user=conf_users.id"
				)
			);

			// условие запроса
			$arrConf['strWhere'] =
					"storing.type IN (" . secure::escQuoteData($arrData['type']) . ") " .
					"AND storing.id_content IN (" . implode(',', secure::escQuoteData($arrData['arrIds'])) . ") " .
					"AND conf_users.user_type IN ('company')";

			// подсчет строк
			$arrConf['calcRows'] = false;

			// LIMIT
			$arrConf['strLimit'] = false;

			if ($this->getSubSelectEntrys(false, true, $arrConf)) {
				return $this->retData();
			} else {
				return false;
			}
		} else {
			return false;
		}
	}

	/**
	 * Метод проверяет значения свойств для записи в таблицу БД
	 *
	 * @return bool
	 */
	private function validateStoringData() {
		// валидация типа записи
		if (empty($this->arrBindFields['type']) || !in_array($this->arrBindFields['type'], $this->arrTypes)) {
			return false;
		}
		// валидация ID-контента для хранения данных о просмотре
		if (empty($this->arrBindFields['id_content']) || !strings::ifInt($this->arrBindFields['id_content'])) {
			return false;
		}
		// валидация ID-пользователя
		if (empty($this->arrBindFields['id_user']) || !strings::ifInt($this->arrBindFields['id_user'])) {
			return false;
		}
		// валидация IP-адреса пользователя
		if (empty($this->arrBindFields['ip']) || !validate::validateIp($this->arrBindFields['ip'])) {
			return false;
		}

		return true;
	}

	/////////////////////////////////////////////////
	// END OF CLASS storing
	/////////////////////////////////////////////////
}
