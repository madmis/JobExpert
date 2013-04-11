<?php

/**
 * Powered by Script Developers Group (SD-Group)
 * Email: info@sd-group.org.ua
 * URL: http://sd-group.org.ua/
 * Copyright 2009 (c) SD-Group
 * All rights reserved
 * ===================================================
 * Класс работы со Словарем - Списки
 * ===================================================
 */
(!defined('SDG')) ? die('Triple protection!') : null;

/**
 * Класс работы со Словарем - Списки
 */
class selects extends bselects {

	/////////////////////////////////////////////////
	// CONSTRUCTOR - конструктор класса selects
	/////////////////////////////////////////////////

	public function __construct($currLang = false) {
		parent::__construct($currLang);
	}

	/////////////////////////////////////////////////
	// METHODS - методы класса selects
	/////////////////////////////////////////////////

	public function setLangDict($lang = false) {
		return parent::setLangDict($lang);
	}

	public function retLangs() {
		return parent::retLangs();
	}

	public function retCurrLang() {
		return parent::retCurrLang();
	}

	public function retSysDict() {
		return parent::retSysDict();
	}

	public function retAddDict() {
		return parent::retAddDict();
	}

	public function retDictByAlias($type, $alias) {
		return parent::retDictByAlias($type, $alias);
	}

	public function addDict(&$arrNewDict, $noExit = false) {
		$noExit = (bool) $noExit;
		return parent::addDict($arrNewDict, $noExit);
	}

	public function editDict(&$arrEditDict, $noExit = false) {
		$noExit = (bool) $noExit;
		return parent::editDict($arrEditDict, $noExit);
	}

	public function delDict(&$alias, $noExit = false) {
		$noExit = (bool) $noExit;
		return parent::delDict($alias, $noExit);
	}

	/////////////////////////////////////////////////
	// END OF CLASS selects
	/////////////////////////////////////////////////
}
