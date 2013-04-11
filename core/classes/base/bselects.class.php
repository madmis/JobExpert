<?php

/**
 * Powered by Script Developers Group (SD-Group)
 * Email: info@sd-group.org.ua
 * URL: http://sd-group.org.ua/
 * Copyright 2009 (c) SD-Group
 * All rights reserved
 * ===================================================
 * Базовый класс работы со Словарем - Списки
 * ===================================================
 */
(!defined('SDG')) ? die('Triple protection!') : null;

/**
 * Базовый класс работы со Словарем - Списки
 */
abstract class bselects {

	/////////////////////////////////////////////////
	// VARS - свойства класса bselects
	/////////////////////////////////////////////////

	private $arrLangs;
	private $currLang;
	private $arrSysDict;
	private $arrAddDict;

	/////////////////////////////////////////////////
	// CONSTRUCTOR - конструктор класса bselects
	/////////////////////////////////////////////////

	/**
	 * конструктор
	 */
	public function __construct(&$currLang) {
		$this->currLang = CONF_LANGUAGE;

		foreach (filesys::getChildDirs('lang/') as $value) {
			(file_exists('lang/' . $value . '/lang.dictionarys.selects.php')) ? $this->arrLangs[] = $value : null;
		}

		(empty($currLang) && !empty($_COOKIE['langDictSelects'])) ? $currLang = & $_COOKIE['langDictSelects'] : null;

		$this->setLangDict($currLang);
	}

	/////////////////////////////////////////////////
	// METHODS - методы класса bselects
	/////////////////////////////////////////////////

	protected function setLangDict(&$lang) {
		if ($this->currLang !== $lang) {
			(!empty($lang) && in_array($lang, $this->arrLangs)) ? $this->currLang = & $lang : $this->currLang = CONF_LANGUAGE;
		}

		cookies::setCookieSite('langDictSelects', $this->currLang, 30);

		(file_exists('lang/' . $this->currLang . '/lang.dictionarys.selects.php')) ? include 'lang/' . $this->currLang . '/lang.dictionarys.selects.php' : messages::printDie(ERROR_FILE_NOT_OPEN);

		$this->arrSysDict = &$arrSysDict;
		$this->arrAddDict = &$arrAddDict;

		return true;
	}

	protected function retLangs() {
		return $this->arrLangs;
	}

	protected function retCurrLang() {
		return $this->currLang;
	}

	protected function retSysDict() {
		return $this->arrSysDict;
	}

	protected function retAddDict() {
		return $this->arrAddDict;
	}

	protected function retDictByAlias(&$type, &$alias) {
		switch ($type) {
			case 'SysDict':
				return (isset($this->arrSysDict[$alias])) ? array('typeDict' => 'SysDict', 'alias' => $alias) + $this->arrSysDict[$alias] : false;

			case 'AddDict':
				return (isset($this->arrAddDict[$alias])) ? array('typeDict' => 'AddDict', 'alias' => $alias) + $this->arrAddDict[$alias] : false;

			default:
				messages::messageChangeSaved(MESSAGE_WARNING_UNKNOWN_ACTION, false, CONF_ADMIN_FILE . '?m=dictionary&s=selects');
		}
	}

	protected function addDict(&$arrNewDict, &$noExit) {
		$values = ('assoc' !== $arrNewDict['type']) ? $arrNewDict['value'] : array_combine($arrNewDict['index'], $arrNewDict['value']);

		if (!$values) {
			if ($noExit) {
				return false;
			} else {
				messages::messageChangeSaved(ERROR_NOT_SAVE_CHANGE, false, CONF_ADMIN_FILE . '?m=dictionary&amp;s=selects');
			}
		} elseif (isset($this->arrAddDict[$arrNewDict['alias']])) {
			if ($noExit) {
				return false;
			} else {
				messages::messageChangeSaved(ERROR_DICT_SELECT_ALIAS_EXISTS, false, CONF_ADMIN_FILE . '?m=dictionary&amp;s=selects');
			}
		} else {
			$this->arrAddDict[$arrNewDict['alias']] = array('type' => $arrNewDict['type'], 'discription' => $arrNewDict['discription'], 'values' => $values);
			$this->saveFile($noExit);
		}
	}

	protected function editDict(&$arrEditDict, &$noExit) {
		switch ($arrEditDict['typeDict']) {
			case 'SysDict':
				$currDict = &$this->arrSysDict;
				break;

			case 'AddDict':
				$currDict = &$this->arrAddDict;
				break;

			default:
				if ($noExit) {
					return false;
				} else {
					messages::messageChangeSaved(MESSAGE_WARNING_UNKNOWN_ACTION, false, CONF_ADMIN_FILE . '?m=dictionary&s=selects');
				}
		}

		$values = ('assoc' !== $arrEditDict['type']) ? $arrEditDict['value'] : array_combine($arrEditDict['index'], $arrEditDict['value']);

		if (!$values) {
			if ($noExit) {
				return false;
			} else {
				messages::messageChangeSaved(ERROR_NOT_SAVE_CHANGE, false, CONF_ADMIN_FILE . '?m=dictionary&amp;s=selects');
			}
		} elseif (!isset($currDict[$arrEditDict['edit_alias']])) {
			if ($noExit) {
				return false;
			} else {
				messages::messageChangeSaved(ERROR_DICT_SELECT_ALIAS_NOTEXISTS, false, CONF_ADMIN_FILE . '?m=dictionary&amp;s=selects');
			}
		} else {
			if ($arrEditDict['edit_alias'] !== $arrEditDict['alias']) {
				unset($currDict[$arrEditDict['edit_alias']]);
			}

			$currDict[$arrEditDict['alias']] = array('type' => $arrEditDict['type'], 'discription' => $arrEditDict['discription'], 'values' => $values);
			$this->saveFile($noExit);
		}
	}

	protected function delDict(&$alias, &$noExit) {
		if (empty($alias) || !is_string($alias) || !isset($this->arrAddDict[$alias])) {
			if ($noExit) {
				return false;
			} else {
				messages::messageChangeSaved(ERROR_NOT_SAVE_CHANGE, false, CONF_ADMIN_FILE . '?m=dictionary&amp;s=selects');
			}
		} else {
			unset($this->arrAddDict[$alias]);
			$this->saveFile($noExit);
		}
	}

	private function saveFile(&$noExit = false) {
		// данные для записи в файл
		$data = "<?php\n\n"
				. "(!defined('SDG')) ? die ('Triple protection!') : null;\n\n"
				. "#SYSTEM DICTIONARYS#\n"
				. '$arrSysDict = ' . $this->parseArrData($this->arrSysDict) . "\n"
				. "#END SYSTEM DICTIONARYS#\n\n"
				. "#ADDITIONAL DICTIONARYS#\n"
				. '$arrAddDict = ' . $this->parseArrData($this->arrAddDict) . "\n"
				. "#END ADDITIONAL DICTIONARYS#\n";
		// запись файла
		if (file_put_contents('lang/' . $this->currLang . '/lang.dictionarys.selects.php', $data)) {
			if ($noExit) {
				return true;
			} else {
				messages::messageChangeSaved(MESSAGE_CHANGE_SAVED, false, CONF_ADMIN_FILE . '?m=dictionary&s=selects');
			}
		} else if ($noExit) {
			return false;
		} else {
			messages::printDie(ERROR_FILE_NOT_WRITE);
		}
	}

	private function parseArrData(&$arrData) {
		$arrNewDict = array();
		foreach ($arrData as $alias => $arrDict) {
			$arrContentDict = array();
			foreach ($arrDict as $keyContent => $valContent) {
				if (is_array($valContent)) {
					if ('index' === $arrDict['type']) {
						$arrContentDict[] = "'values' => array(" . implode(', ', secure::escQuoteData($arrDict['values'])) . ")";
					} else {
						$arrValues = array();
						foreach ($valContent as $key => $val) {
							$arrValues[] = secure::escQuoteData($key) . ' => ' . secure::escQuoteData($val);
						}

						$arrContentDict[] = "'values' => array(" . implode(', ', $arrValues) . ")";
					}
				} else {
					$arrContentDict[] = secure::escQuoteData($keyContent) . ' => ' . secure::escQuoteData($valContent);
				}
			}

			$arrNewDict[] = secure::escQuoteData($alias) . ' => ' . 'array(' . implode(', ', $arrContentDict) . ')';
		}

		return 'array(' . implode(', ', $arrNewDict) . ');';
	}

	/////////////////////////////////////////////////
	// END OF CLASS bselects
	/////////////////////////////////////////////////
}
