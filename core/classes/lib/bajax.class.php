<?php

/**
 * Powered by Script Developers Group (SD-Group)
 * Email: info@sd-group.org.ua
 * URL: http://sd-group.org.ua/
 * Copyright 2009 (c) SD-Group
 * All rights reserved
 * ===================================================
 * Класс bAjax
 * ===================================================
 */
(!defined('SDG')) ? die('Triple protection!') : null;

/**
 * Класс bAjax
 */
abstract class bAjax {

	/////////////////////////////////////////////////
	// METHODS - методы класса bAjax
	/////////////////////////////////////////////////
	static function sdgJSONencode($variable) {
		if (function_exists('json_encode')) {
		  return json_encode($variable);
		}

		switch (strtolower(gettype($variable))) {
			case 'null':
				return 'null';
			case 'integer':
			case 'double':
				return strval($variable);
			case 'string':
				return '"' . addslashes($variable) . '"';
			case 'boolean':
				return $variable ? 'true' : 'false';
			case 'object':
				$variable = (array) $variable;
			case 'array':
				$foundKeys = false;

				foreach ($variable as $k => &$v) {
					if (!is_numeric($k)) {
						$foundKeys = true;
						break;
					}
				}

				$result = array();

				if ($foundKeys) {
					foreach ($variable as $k => &$v) {
						$result [] = self::sdgJSONencode($k) . ':' . self::sdgJSONencode($v);
					}

					return '{' . implode(',', $result) . '}';
				} else {
					foreach ($variable as $k => &$v) {
						$result [] = self::sdgJSONencode($v);
					}

					return '[' . implode(',', $result) . ']';
				}
		}
	}

	/////////////////////////////////////////////////
	// END OF CLASS bAjax
	/////////////////////////////////////////////////
}