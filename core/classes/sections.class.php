<?php

/**
 * Powered by Script Developers Group (SD-Group)
 * Email: info@sd-group.org.ua
 * URL: http://sd-group.org.ua/
 * Copyright 2009 (c) SD-Group
 * All rights reserved
 * ===================================================
 * Класс работы с Разделами
 * ===================================================
 */
(!defined('SDG')) ? die('Triple protection!') : null;

/**
 * Класс работы с Разделами
 *
 */
class sections extends categorys {
	/////////////////////////////////////////////////
	// VARS - свойства класса sections
	/////////////////////////////////////////////////

	/**
	 * Массив для хранения наименований и значений полей для записи в таблицу БД
	 * В этом массиве хранятся поля обязательные для заполнения
	 *
	 * @var array
	 */
	public $arrBindFields = array(
		'name' => ''
	);

	/**
	 * Массив для хранения наименований и значений полей для записи в таблицу БД
	 * В этом массиве хранятся поля не обязательные для заполнения
	 *
	 * @var array
	 */
	public $arrNoBindFields = array(
		'sort' => '',
		'title' => '',
		'meta_keywords' => '',
		'meta_description' => ''
	);

	/////////////////////////////////////////////////
	// CONSTRUCTOR - конструктор класса sections
	/////////////////////////////////////////////////

	/**
	 * конструктор
	 *
	 */
	public function __construct() {
		$this->setTable('section');

		$arrOrderBy = array(
			'sort' => 'ASC',
			'name' => 'ASC',
			'id' => 'ASC',
		);

		parent::__construct($arrOrderBy, 'profession');

		$this->getCategorys();
	}

	/////////////////////////////////////////////////
	// METHODS - методы класса sections
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
	 * public функция возвращает массив данных
	 *
	 * return array
	 */
	public function retCategorysByIds($arrIds) {
		(!is_array($arrIds)) ? $arrIds = array($arrIds) : null;

		return $this->retCategorys(array('id' => $arrIds));
	}

	/**
	 * public функция выполняет действия над группой регионов
	 *
	 * @param string $action
	 * @param array $arrFields
	 *
	 * @return bool
	 */
	public function actionSections($action, $arrFields) {
		if ('edit' === $action || 'sort' === $action || 'del' === $action) {
			if ('del' === $action) {
				global $professions;

				$professions->delCategorys('parent_id IN (' . implode(',', secure::escQuoteData($arrFields)) . ')');
			}

			(!$this->actionCategorys($action, $arrFields)) ? messages::messageChangeSaved(ERROR_NOT_SAVE_CHANGE, false, CONF_ADMIN_FILE . '?m=dictionary&amp;s=sections') : messages::messageChangeSaved(MESSAGE_CHANGE_SAVED, false, CONF_ADMIN_FILE . '?m=dictionary&amp;s=sections');
		} else {
			messages::messageChangeSaved(MESSAGE_WARNING_UNKNOWN_ACTION, false, CONF_ADMIN_FILE . '?m=dictionary&amp;s=sections');
		}
	}

	/**
	 * Перегрузка методов родительских классов
	 */
	public function getCategorys() {
		return parent::getCategorys();
	}

	public function retCategorys($arrWhereFieldsVals = false) {
		return parent::retCategorys($arrWhereFieldsVals);
	}

	public function recCategory($token = 'active') {
		return parent::recCategory($this->arrBindFields, $this->arrNoBindFields, $token);
	}

	public function delCategorys($strWhere) {
		return parent::delCategorys($strWhere);
	}

	/////////////////////////////////////////////////
	// END OF CLASS sections
	/////////////////////////////////////////////////
}
