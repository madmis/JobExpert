<?php
/********************************************************
	JobExpert v1.0
	powered by Script Developers Group (SD-Group)
	email: info@sd-group.org.ua
	url: http://sd-group.org.ua/
	Copyright 2010-2015 (c) SD-Group
	All rights reserved
=========================================================
	Класс работы со строками
********************************************************/
/**
* @package
* @todo
* 
* @tutorial
* Частичное обновление файлов (т.е. обновление текста в файлах) производится 
* посредством инструкций указанных в XML-файле обновления.
* 
* XML-файл должен лежать в архиве (в корне) и называться update.xml
* 
* Инструкции в XML-файле позволяют: 
* 	- Добавлять строки в файлы
* 	- Удалять строки из файлов
*   - Добавлять поля в таблицы БД
*   - Удалять файлы
*   - Удалять каталоги
* Другие действия на данный момент не доступны
* 
* Частичному обновлению подлежат тоько файлы:
* 	- Содержащие константы (конфиги и возможно языковые файлы)
* 	- Содержащие массивы (конфиги, например - config.robot.control.php и словари - lang.dictionarys.selects.php)
* 
* 
* Ниже приведены примеры инструкций XML-файла.
* 
* @example
* Корневым элементом XML-файла являеется <root></root>.
* Все инструкции пишутся внутри этого элемента.
* Изменения фалов описываются внутри узла <php></php>
* Изменения в табицах БД описываются внутри узла <sql></sql>
* К изменяемым файлам необходимо указывать полный путь
* 
* Добавление константы:
* 	<expconst>
*		<action>ADD</action>
*		<file>core/conf/const.config.info.php</file>
*		<string>CONF_INFO_SCRIPT_VERSION_TEST1</string>
*		<value><![CDATA[0.2.3]]></value>
*	</expconst>
* 
* Удаление константы:
* 	<expconst>
*		<action>DELETE</action>
*		<file>core/conf/const.config.service.php</file>
*		<string>CONF_SERVICE_ADMINISTRATION_MAINTENANCE_DEL</string>
*	</expconst>
* 
* Добавление значения в массив:
* 	<exparray>
*		<action>ADD</action>
*		<file>core/conf/config.payments.php</file>
*		<subj>arrPayments</subj>
*		<index>
*			<name>testKey</name>
*			<value>testValue</value>
*		</index>
*	</exparray>
* 
* Добавление массива в массив
* 	<exparray>
*		<action>ADD</action>
*		<file>core/conf/config.robot.control.php</file>
*		<subj>arrRobotConf</subj>
*		<index>
*			<key>
*				<name>configs</name>
*				<key>
*					<name>testArray</name>
*					<key>
*						<name>testArrayName</name>
*						<value>testArrayValue</value>
*					</key>
*				</key>
*			</key>
*		</index>
*	</exparray>
* 
* Удаление значения из массива:
* 	<exparray>
*		<action>DELETE</action>
*		<file>core/conf/config.payments.php</file>
*		<subj>arrPayments</subj>
*		<index>
*			<name>add_resume</name>
*		</index>
*	</exparray>
*
* Удаление значения из массива вложенного в массив:
* 
* 	<exparray>
*		<action>DELETE</action>
*		<file>core/conf/config.robot.control.php</file>
*		<subj>arrRobotConf</subj>
*		<index>
*			<key>
*				<name>configs</name>
*				<key>
*					<name>robot_running</name>
*				</key>
*			</key>
*		</index>
*	</exparray>
*
* *******************
*        SQL        *
* *******************
* В таблицах используется замена строк
* '%DB_PREFIX%', '%USR_PREFIX%', '%DB_CHARSET%'
* 
* Удаление таблицы
* В удалении таблицы нет узла <query></query>
* При удалении таблицы обязательно проверяем ее существование
* И удаляем только если таблица существует
*     <sql>
*        <node>
*           <action>DELETE_TABLE</action>
*           <table>%DB_PREFIX%news</table>
*       </node>
*        <node>
*           <action>DELETE_TABLE</action>
*           <table>%USR_PREFIX%users</table>
*       </node>
*    </sql>
* 
* Добавление таблицы
* При добавлении таблицы сначала проверяется существование таблицы
* Если таблица существует, пытаемся ее удалить
* И лишь после этого выполняем запрос добавления таблицы (если таблица была удалена успешно или ее нет)
*     <sql>
*        <node>
*           <action>ADD_TABLE</action>
*           <table>%DB_PREFIX%news</table>
*           <query>
*               <![CDATA[
*               CREATE TABLE `%DB_PREFIX%payments_mods` (
*                   `id` varchar(150) NOT NULL default '',
*                   `title` varchar(200) NOT NULL COMMENT 'Заголовок платежного мода',
*                   `description` text NOT NULL COMMENT 'Описание платежного мода',
*                   `token` enum('active','disabled','reserved','deleted') NOT NULL default 'disabled',
*                   PRIMARY KEY  (`id`)
*               ) ENGINE=MyISAM DEFAULT CHARSET=%DB_CHARSET%;
*               ]]>
*           </query>
*       </node>
*    </sql>
* 
* Удаление поля из таблицы
* В удалении поля нет узла <query></query>
* При удалении поля обязательно проверяем существование таблицы и поля
* И удаляем только если существует и таблица и поле
*     <sql>
*        <node>
*           <action>DELETE_FIELD</action>
*           <table>%DB_PREFIX%news</table>
*           <field>id</field>
*       </node>
*    </sql>
* 
* Добавление поля в таблицу
* При добавлении поля сначала проверяем существование таблицы
* Затем существование поля и только потом добавляем поле
*     <sql>
*        <node>
*           <action>ADD_FIELD</action>
*           <table>%DB_PREFIX%news</table>
*           <field>count</field>
*           <query>
*               <![CDATA[ALTER TABLE `%DB_PREFIX%news` ADD `count` INT UNSIGNED NOT NULL DEFAULT '0' COMMENT 'Счетчик';]]>
*           </query>
*       </node>
*    </sql>
* 
* *******************
*      DELETE       *
* *******************
* Удаление файлов
*	<delfiles>
*		<node><expfname>index.php</expfname></node>
*		<node><expfname>core/si/securimage.php</expfname></node>
*		<node><expfname>lang/russian/lang.messages.php</expfname></node>
*	</delfiles>
*
* Удаление каталогов
*	<deldirs>
*		<node><expfname>core/si/</expfname></node>
*		<node><expfname>lang/russian/</expfname></node>
*	</deldirs>
*
* Добавление текста в конец файла (текст обязательно в одинарных кавычках):
* 	<expfile>
*		<action>ADD || DELETE</action>
*		<file>lang/russian/lang.site.php</file>
*		<string>define('SITE_TOKEN_ARCHIVED', 'Архив');</string>
*	</expfile>
* 
*
*/

(!defined('SDG')) ? die ('Triple protection!') : null;

class updates {
	/////////////////////////////////////////////////
	// VARS - свойства класса updates
	/////////////////////////////////////////////////

	/**
	* $errorMessage: сообщение об ошибке
	* @var string
	*/
	static $errorMessage = false;

	/**
	* $message: сообщение
	* @var string
	*/
	static $message = false;

	/**
	* $logData: массив данных для записи в лог. Массив содержит следующие ключи
	* <strong>error</strong> - ошибка. Может принимать значения
	* 									0 - нет ошибки
	* 									1 - ошибка
	* 									2 - действие, которое будет выполняться
	* <strong>message</strong> - сообщение
	* <strong>object</strong> - объект, на которым выолняется действие
	* <strong>data</strong> - расширенные данные (может не присутствовать в массиве)
	* @var array
	*/
	static $logData = array();

	/////////////////////////////////////////////////
	// METHODS - методы класса updates
	/////////////////////////////////////////////////

	/**
	* Функция заполняет массив логов (массив очищается перед заполнением)
	* @param array $arrData
	*/
	static function setLogData($arrData) {
		if (empty($arrData) || !is_array($arrData))
			return;

			self::$logData[] = $arrData; 
	}

    static function clearLogData() {
        self::$logData = array();
    }

	static function saveLogData() {
		if (!empty(self::$logData)) {
			$logData = filesys::getSerializedData(CONF_UPDATES_PATH_TO_LOG_FILES . terms::currentDate() . '_update.log');

			if (is_array($logData)) {
				self::$logData = array_merge($logData, self::$logData);
			}

			filesys::putSerializedData(CONF_UPDATES_PATH_TO_LOG_FILES . terms::currentDate() . '_update.log', self::$logData);
			self::clearLogData();
		}
	}

	/********************* РАБОТА С КОНСТАНТАМИ *********************/
	/**
	* Функция производит обновление файла констант в соответствии с указанными параметрами
	* @param (array) $params - массив параметров и данных обновления
	* @return bool
	*/
	static function updateConstFile(&$params) { 
		if (!file_exists($params['file'])) {
			self::$errorMessage = 'Not found file ' . $params['file'];

			self::clearLogData();
			self::setLogData(array(
				'error' => 1,
				'message' => 'Update constant in file (method updateConstFile). Error: ' . self::$errorMessage,
				'object' => $params['file'],
			));
			self::saveLogData();

			return false;
		}

		switch ($params['action']) {
			case 'ADD':
				// получаем массив констант из файла
				$arrConst = self::getConst($params['file']);
				// если константа уже есть, ничего не делаем
				// иначе добавляем ее в файл
				if (!empty($arrConst) && !isset($arrConst[$params['string']])) {
					$arrConst[$params['string']] = $params['value'];
					define($params['string'], $params['value']);
					
					if (file_put_contents($params['file'], self::generateConstText($arrConst))) {

						self::clearLogData();
						self::setLogData(array(
							'error' => 0,
							'message' => 'Update constant in file (method updateConstFile). File success rewrited',
							'object' => $params['file'],
						));
						self::saveLogData();

						return true;
					} else {

						self::clearLogData();
						self::setLogData(array(
							'error' => 1,
							'message' => 'Update constant in file (method updateConstFile). Could not rewrite file',
							'object' => $params['file'],
						));
						self::saveLogData();

						return false;
					}
				} else {

					self::clearLogData();
					self::setLogData(array(
						'error' => 0,
						'message' => 'Update constant in file (method updateConstFile). Constant ' . $params['string'] . ' already defined',
						'object' => $params['file'],
					));
					self::saveLogData();

					return true;
				}
				break;

			case 'DELETE':
				// получаем массив констант из файла
				$arrConst = self::getConst($params['file']);
				// если найдена искомая константа, удаляем ее и пересохраняем файл
				if (!empty($arrConst) && isset($arrConst[$params['string']])) {
					unset($arrConst[$params['string']]);

					if (file_put_contents($params['file'], self::generateConstText($arrConst))) {

						self::clearLogData();
						self::setLogData(array(
							'error' => 0,
							'message' => 'Update constant in file (method updateConstFile). File success rewrited',
							'object' => $params['file'],
						));
						self::saveLogData();

						return true;
					} else {

						self::clearLogData();
						self::setLogData(array(
							'error' => 1,
							'message' => 'Update constant in file (method updateConstFile). Could not rewrite file',
							'object' => $params['file'],
						));
						self::saveLogData();

						return false;
					}
				} else {

					self::clearLogData();
					self::setLogData(array(
						'error' => 0,
						'message' => 'Update constant in file (method updateConstFile). Constant ' . $params['string'] . ' not delete. Constant not defined',
						'object' => $params['file'],
					));
					self::saveLogData();

					return true;
				}
				break;

			default:
				self::$errorMessage = 'Undefined action';
				return false;
				break;
		}
	}

	/**
	* Функция считывает константы из файла в массив, где (key => value = КОНСТАНТА => значение)
	* @param (string) $file - пусть к файлу, константы из которого необходимо считать
	* @return array (CONST => value)
	*/
	static function getConst($file) {
		$arrConst = array();
		// считываем файл в массив
		$fileContent = file($file);

		// пробегаем по массиву и забираем константы
		foreach ($fileContent as $key => &$string) {
			if (false !== strpos($string, 'define (')) {
				$arrExplode = explode(',', trim($string));
				$constName = substr($arrExplode[0], 9, -1);
				$constVal = constant($constName);

				$arrConst[$constName] = $constVal;
			}
			elseif (false !== strpos($string, 'define(')) {
				$arrExplode = explode(',', trim($string));
				$constName = substr($arrExplode[0], 8, -1);
				$constVal = constant($constName);

				$arrConst[$constName] = $constVal;
			}
		}

		return $arrConst;
	}

	/**
	* Функция генерирует из массива строку для записи в файл констант
	* @param array $srcArr - исходный массив
	* @return string - строка для записи в файл
	*/
	static function generateConstText(&$srcArr) {
		$updText = "<?php\n\n"
				 . "(!defined('SDG')) ? die ('Triple protection!') : null;\n";

		foreach ($srcArr as $key => $value) {
			$val = ((is_int($value)) ? $value : (is_bool($value) ? (($value) ? 'true' : 'false') : '"' . $value . '"'));
			$updText .=  "\n" . 'define("' . $key . '", ' . $val . ');' . "\n";
		}

		return $updText;
	}

	/**************************************************************/

	/********************* РАБОТА С МАССИВАМИ *********************/

	/**
	* Функция производит обновление файла с массивом в соответствии с указанными параметрами
	* @param (mixed) $params - объект, с параметрами (соответсвующая ветка XML-файла).
	* @param (array) $srcArr - массив, данные в котором необходимо изменить
	* @return bool
	*/
	static function updateArrFile(&$params, &$srcArr, &$index = null) { 
		if (!is_object($params)) {
			self::$errorMessage = 'updateArrFile params not is object';
			
			self::clearLogData();
			self::setLogData(array(
				'error' => 1,
				'message' => 'Update array in file (method updateArrFile). Error: ' . self::$errorMessage,
				'object' => 'updateArrFile',
			));
			self::saveLogData();

			return false;
		}

		// многомерный массив
		if (property_exists($params -> index, 'key')) {
			switch($params -> action) {
				case 'ADD':
					// добавляем в массив новое значение
					if (!self::checkKeysIsset($params -> index, $srcArr)) {
						self::addValToArr($params, $srcArr);
					} else {
						return true;
					}
					break;

				case 'DELETE':
					if (!self::checkKeysIsset($params -> index, $srcArr, true)) {
						return true;
					}
					break;

				default:
					self::$errorMessage = 'Undefined action';
					return false;
					break;
			}

			// формируем строку для записи в файл
			$data = "<?php\n\n"
				  . "(!defined('SDG')) ? die ('Triple protection!') : null;\n\n"
				  .	'$' . $params -> subj . ' = array(' . "\n";

			$data .= self::generateArrayText($srcArr) . ");\n";

			if (!file_exists($params -> file)) {
				self::$errorMessage = 'Not found file ' . $params -> file;

				self::clearLogData();
				self::setLogData(array(
					'error' => 1,
					'message' => 'Update array in file (method updateArrFile). Error: ' . self::$errorMessage,
					'object' => $params -> file,
				));
				self::saveLogData();

				return false;
			}

			if (file_put_contents($params -> file, $data)) {

				self::clearLogData();
				self::setLogData(array(
					'error' => 0,
					'message' => 'Update array in file (method updateArrFile). File success rewrited',
					'object' => $params -> file,
				));
				self::saveLogData();

				return true;
			} else {

				self::clearLogData();
				self::setLogData(array(
					'error' => 1,
					'message' => 'Update array in file (method updateArrFile). Could not rewrite file',
					'object' => $params -> file,
				));
				self::saveLogData();

				return false;
			}
		} else {// одномерный массив
			$currParams = get_object_vars($params -> index);

			if (property_exists($params -> index, 'name')) {
				switch($params -> action) {
					case 'ADD':
						// добавляем в массив новое значение
						if (!isset($srcArr[$currParams['name']])) {
							$srcArr[$currParams['name']] = $currParams['value'];
						} else {
							return true;
						}
						break;

					case 'DELETE':
						if (!self::checkKeysIsset($params -> index, $srcArr, true)) {
							return true;
						}
						break;

					default:
						self::$errorMessage = 'Undefined action';
						return false;
						break;
				}

				// формируем строку для записи в файл
				$data = "<?php\n\n"
					  . "(!defined('SDG')) ? die ('Triple protection!') : null;\n\n"
					  .	'$' . $params -> subj . ' = array(' . "\n";
				$data .= self::generateArrayText($srcArr) . ");\n";

				if (!file_exists($params -> file)) {
					self::$errorMessage = 'Not found file ' . $params -> file;

					self::clearLogData();
					self::setLogData(array(
						'error' => 1,
						'message' => 'Update array in file (method updateArrFile). Error: ' . self::$errorMessage,
						'object' => $params -> file,
					));
					self::saveLogData();

					return false;
				}

				if (file_put_contents($params -> file, $data)) {

					self::clearLogData();
					self::setLogData(array(
						'error' => 0,
						'message' => 'Update array in file (method updateArrFile). File success rewrited',
						'object' => $params -> file,
					));
					self::saveLogData();

					return true;
				} else {

					self::clearLogData();
					self::setLogData(array(
						'error' => 1,
						'message' => 'Update array in file (method updateArrFile). Could not rewrite file',
						'object' => $params -> file,
					));
					self::saveLogData();

					return false;
				}
			} else {
				self::$errorMessage = 'Can not find property - "name" in object';

				self::clearLogData();
				self::setLogData(array(
					'error' => 1,
					'message' => 'Update array in file (method updateArrFile). Error: ' . self::$errorMessage,
					'object' => $params -> file,
				));
				self::saveLogData();

				return false;
			}
		}
	}

	/**
	* Функция производит поиск ключа в существующем массиве (рекурсивно)
	* @param (object) $params - объект параметров (соответсвующая ветка XML-файла)
	* @param (array) $srcArr - массив, данные в котором необходимо изменить
	* @return bool or trigger_error
	*/
	static function checkKeysIsset(&$params, &$srcArr, $delete = false) {
		if (is_object($params) && property_exists($params, 'key') && property_exists($params -> key, 'name')) {
			$currKey = get_object_vars($params -> key);

			if (isset($srcArr[$currKey['name']])) {
				return self::checkKeysIsset($currKey['key'], $srcArr[$currKey['name']], $delete);
			} else {
				return false;
			}
		}
		elseif (is_object($params) && property_exists($params, 'name')) {
			$currKey = get_object_vars($params);

			// проверяем, найден ли ключ в массиве
			if (isset($srcArr[$currKey['name']])) {
				// проверяем, нужно ли удалять ключ
				if ($delete) unset($srcArr[$currKey['name']]);
				return true;
			} else {
				return false;
			}
		} else {
			trigger_error('Error in XML-file: The first parameter to an Object, or not exist Key property, or not exist Name property!');
		}
	}

	/**
	* Функция производит добавление необходимого ключа => значения в массив (рекурсивно)
	* @param (object) $params - объект параметров (соответсвующая ветка XML-файла)
	* @param (array) $srcArr - массив, данные в котором необходимо изменить
	* @param (bool) $update - определяет, обновление или доабвление значения
	* @return bool or trigger_error
	*/
	static function addValToArr(&$params, &$srcArr, $recurs = false) { 
		if (!empty($recurs) || !self::checkKeysIsset($params -> index, $srcArr)) {
			(!empty($recurs)) ? $newParams =& $params : $newParams =& $params -> index;

			if (is_object($newParams) && property_exists($newParams, 'key') && property_exists($newParams -> key, 'name')) {
				$currKey = get_object_vars($newParams -> key);
				return self::addValToArr($newParams -> key, $srcArr[$currKey['name']], true);
			}
			elseif (is_object($newParams) && property_exists($newParams, 'name') && property_exists($newParams, 'value')) {
				$currKey = get_object_vars($newParams);
				$srcArr = $currKey['value'];
				return true;
			} else {
				return false;
			}
		} else {
			return true;
		}
	}

	/**
	* Функция генерирует из массива строку для записи в файл
	* @param array $srcArr - исходный массив
	* @return string - строка для записи в файл
	*/
	static function generateArrayText(&$srcArr) {
		$dataStr = '';
		$arrData = array();

		// пробегаем по массиву
		foreach ($srcArr as $key => $value) {
			// если значение текущего элемента массив, рекурсивно вызываем опять этот метод
			// сохраняя перед этим строку
			if (is_array($value)) {
				$dataStr .= "	'" . $key . "' => array(\n";
				$dataStr .= self::generateArrayText($value) . "),\n";
			} else {// если не массив, добавляем элементы строкой в массив
				// делаем проверку типа значения
				$val = ((is_int($value)) ? $value : (is_bool($value) ? (($value) ? 'true' : 'false') : "'" . $value . "'"));
				$arrData[] = "		'" . $key . "' => " . $val;
			}
		}
		$dataStr .=  implode(",\n", $arrData) . "\n";

		return $dataStr;
	}

	/**************************************************************/
	
	/********************* ОБНОВЛЕНИЕ ФАЙЛОВ *********************/
	/**
	* Функция производит обновление файла констант в соответствии с указанными параметрами
	* @param (mixed) $params - объект, с параметрами (соответсвующая ветка XML-файла).
	* @return bool
	*/
	static function updateTextInFile(&$params) {
		if (!is_object($params)) {
			self::$errorMessage = 'params in addTextToFile method not is object';

			self::clearLogData();
			self::setLogData(array(
				'error' => 1,
				'message' => 'Update text in file (method updateTextInFile). Error: ' . self::$errorMessage,
				'object' => 'updateTextInFile',
			));
			self::saveLogData();

			return false;
		}

		if (!file_exists($params -> file)) {
			self::$errorMessage = 'Not found file ' . $params -> file;
			
			self::clearLogData();
			self::setLogData(array(
				'error' => 1,
				'message' => 'Update text in file (method updateTextInFile). Error: ' . self::$errorMessage,
				'object' => $params -> file,
			));
			self::saveLogData();

			return false;
		}

		if (!is_writable($params -> file)) {
			self::$errorMessage = 'The file is not writable: ' . $params -> file;

			self::clearLogData();
			self::setLogData(array(
				'error' => 1,
				'message' => 'Update text in file (method updateTextInFile). Error: ' . self::$errorMessage,
				'object' => $params -> file,
			));
			self::saveLogData();

			return false;
		}

		if (!$data = file_get_contents($params -> file)) {
			self::$errorMessage = 'Could not open file: ' . $params -> file;

			self::clearLogData();
			self::setLogData(array(
				'error' => 1,
				'message' => 'Update text in file (method updateTextInFile). Error: ' . self::$errorMessage,
				'object' => $params -> file,
			));
			self::saveLogData();

			return false;
		}

		/** Выполняем действие **/
		switch ($params -> action) {
			case 'DELETE':
				$data = str_replace($params -> string, '', $data);
				break;

			default:
				$data .= "\n" . $params -> string;
				break;
		}

		self::clearLogData();
		self::setLogData(array(
			'error' => 2,
			'message' => 'Try update file (method updateTextInFile)',
			'object' => 'file: ' . $params -> file . '; action: ' . $params -> action,
		));
		self::saveLogData();

		/** Записываем в файл **/
		if (!file_put_contents($params -> file, trim($data))) {
			self::$errorMessage = 'Could not write file: ' . $params -> file;

			self::clearLogData();
			self::setLogData(array(
				'error' => 1,
				'message' => 'Try update file (method updateTextInFile). Error: ' . self::$errorMessage . 'Mode: ' . filesys::getFileMode($params -> file),
				'object' => 'file: ' . $params -> file . '; action: ' . $params -> action,
			));
			self::saveLogData();

			return false;
		}

		self::clearLogData();
		self::setLogData(array(
			'error' => 0,
			'message' => 'Try update file (method updateTextInFile). File success updated.',
			'object' => 'file: ' . $params -> file . '; action: ' . $params -> action,
		));
		self::saveLogData();

		return true;
	}
	/**************************************************************/

    /**************************** SQL *****************************/
    /**
    * Функция производит обновление обектов БД
    * @param Object $params - объект параметров и данных обновления
    * @return bool
    */
    static function updateDB(&$params) {
        $params -> table = str_ireplace(array('%DB_PREFIX%', '%USR_PREFIX%'), array(DB_PREFIX, USR_PREFIX), $params -> table);

        switch ($params -> action) {
            case 'DELETE_TABLE':
                return self::deleteTable($params);
                break;

            case 'ADD_TABLE':
                $params -> query = str_ireplace(array('%DB_PREFIX%', '%USR_PREFIX%', '%DB_CHARSET%'), array(DB_PREFIX, USR_PREFIX, DB_CHARSET), $params -> query);
                return self::addTable($params);
                break;

            case 'DELETE_FIELD':
                return self::deleteField($params);
                break;

            case 'ADD_FIELD':
                $params -> query = str_ireplace(array('%DB_PREFIX%', '%USR_PREFIX%', '%DB_CHARSET%'), array(DB_PREFIX, USR_PREFIX, DB_CHARSET), $params -> query);
                return self::addField($params);
                break;

            default:
                self::$errorMessage = 'Undefined action';
                return false;
                break;
        }
    }

    /**
    * Функция проверяет существование таблицы в БД
    * @param Object $params
    * @return bool
    */
    static function issetTable(&$params) {
        $query = "SELECT `TABLE_NAME` FROM information_schema.tables WHERE table_schema = " . secure::escQuoteData(DB_NAME) . " AND table_name=" . secure::escQuoteData($params -> table) . " LIMIT 1";
        db::dbQuery($query);
        $nR = db::dbNumRows();

		$pr = get_object_vars($params);
		self::clearLogData();
		self::setLogData(array(
			'error' => 2,
			'message' => 'Try isset table (method issetTable). Table is: ' . (($nR) ? 'isset' : 'not isset'),
			'object' => $pr['table'],
		));
		self::saveLogData();

        return $nR;
    }

    /**
    * Функция проверяет существование поля в таблице
    * @param Object $params
    * @return bool
    */
    static function issetField(&$params) {
       $pr = get_object_vars($params);

        $query = "SHOW COLUMNS FROM `" . $params -> table . "` WHERE `Field` = '" . $params -> field . "'";
        db::dbQuery($query);
        $nR = db::dbNumRows();

		self::clearLogData();
		self::setLogData(array(
			'error' => 2,
			'message' => 'Try isset field (method issetField). Field is: ' . (($nR) ? 'isset' : 'not isset'),
			'object' => 'table: ' . $pr['table'] . '; field: ' . $pr['field'],
		));
		self::saveLogData();

        return $nR;
    }

    /**
    * Функция производит удаление таблицы
    * @param Object $params - объект параметров и данных обновления
    * @return bool
    */
    static function deleteTable(&$params) {

		$pr = get_object_vars($params);

		self::clearLogData();
		self::setLogData(array(
			'error' => 2,
			'message' => 'Try delete table (method deleteTable)',
			'object' => $pr['table'],
		));
		self::saveLogData();

        if (self::issetTable($params)) {
            $query = "DROP TABLE `" . $params -> table . "`";
            if (db::dbQuery($query)) {

				self::clearLogData();
				self::setLogData(array(
					'error' => 0,
					'message' => 'Table deleted (method deleteTable)',
					'object' => $pr['table'],
				));
				self::saveLogData();

                return true;
            } else {
				self::clearLogData();
				self::setLogData(array(
					'error' => 1,
					'message' => 'Table not deleted (method deleteTable). Error: ' . db::$message_error,
					'object' => $pr['table'],
				));
				self::saveLogData();

                self::$errorMessage = db::$message_error;
                return false;
            }
        } else {
            //self::$errorMessage = 'Table ' . $params -> table . ' not exists';
            // Если таблицы не существует, возвращаем true
            return true;            
        }
    }
    
    /**
    * Функция производит добавление таблицы
    * @param Object $params - объект параметров и данных обновления
    * @return bool
    */
    static function addTable(&$params) {

    	$pr = get_object_vars($params);

		self::clearLogData();
		self::setLogData(array(
			'error' => 2,
			'message' => 'Try add table (method addTable)',
			'object' => $pr['table'],
		));
		self::saveLogData();

        if (self::deleteTable($params)) {
            if (db::dbQuery($params -> query)) {

				self::clearLogData();
				self::setLogData(array(
					'error' => 0,
					'message' => 'Table added (method addTable)',
					'object' => $pr['table'],
				));
				self::saveLogData();

                return true;
            } else {
				self::clearLogData();
				self::setLogData(array(
					'error' => 1,
					'message' => 'Table not added (method addTable). Error: ' . db::$message_error,
					'object' => $pr['table'],
				));
				self::saveLogData();

                self::$errorMessage = db::$message_error;
                return false;
            }
        } else {
            // сообщение об ошибке уже есть, создано при попытке удалить таблицу
            return false;
        }
    }

    /**
    * Функция производит удаление поля таблицы
    * @param Object $params - объект параметров и данных обновления
    * @return bool
    */
    static function deleteField(&$params) {

    	$pr = get_object_vars($params);

		self::clearLogData();
		self::setLogData(array(
			'error' => 2,
			'message' => 'Try delete field (method deleteField)',
			'object' => 'table: ' . $pr['table'] . '; field: ' . $pr['field'],
		));
		self::saveLogData();

        if (self::issetTable($params)) {
            if (self::issetField($params)) {
                $query = "ALTER TABLE `" . $params -> table . "` DROP `" . $params -> field . "`";
                if (db::dbQuery($query)) {

					self::clearLogData();
					self::setLogData(array(
						'error' => 0,
						'message' => 'Field success deleted (method deleteField)',
						'object' => 'table: ' . $pr['table'] . '; field: ' . $pr['field'],
					));
					self::saveLogData();

                    return true;
                } else {

					self::clearLogData();
					self::setLogData(array(
						'error' => 1,
						'message' => 'Field not deleted (method deleteField). Error: ' . db::$message_error,
						'object' => 'table: ' . $pr['table'] . '; field: ' . $pr['field'],
					));
					self::saveLogData();

                    self::$errorMessage = db::$message_error;
                    return false;
                }
            } else {
                self::$errorMessage = 'In table {' . $pr['table'] . '} Field {' . $pr['field'] . '} no exists.';
            
				self::clearLogData();
				self::setLogData(array(
					'error' => 1,
					'message' => 'Field not deleted (method deleteField). Error: ' . self::$errorMessage,
					'object' => 'table: ' . $pr['table'] . '; field: ' . $pr['field'],
				));
				self::saveLogData();

                return false;            
            }
        } else {
            self::$errorMessage = 'Table {' . $pr['table'] . '} not exists. Field {' . $pr['field'] . '} not delete.';

			self::clearLogData();
			self::setLogData(array(
				'error' => 1,
				'message' => 'Field not deleted (method deleteField). Error: ' . self::$errorMessage,
				'object' => 'table: ' . $pr['table'] . '; field: ' . $pr['field'],
			));
			self::saveLogData();

            return false;            
        }
    }
    
    /**
    * Функция производит добавление поля в таблицу
    * @param Object $params - объект параметров и данных обновления
    * @return bool
    */
    static function addField(&$params) {

    	$pr = get_object_vars($params);

		self::clearLogData();
		self::setLogData(array(
			'error' => 2,
			'message' => 'Try add field (method addField)',
			'object' => 'table: ' . $pr['table'] . '; field: ' . $pr['field'],
		));
		self::saveLogData();

        if (self::issetTable($params)) {
            if (!self::issetField($params)) {
                if (db::dbQuery($params -> query)) {

					self::clearLogData();
					self::setLogData(array(
						'error' => 0,
						'message' => 'Field success added (method addField)',
						'object' => 'table: ' . $pr['table'] . '; field: ' . $pr['field'],
					));
					self::saveLogData();

                    return true;
                } else {

					self::clearLogData();
					self::setLogData(array(
						'error' => 1,
						'message' => 'Field not added (method addField). Error: ' . db::$message_error,
						'object' => 'table: ' . $pr['table'] . '; field: ' . $pr['field'],
					));
					self::saveLogData();

                    self::$errorMessage = db::$message_error;
                    return false;
                }
            } else {
                self::$errorMessage = 'In table {' . $pr['table'] . '} Field {' . $pr['field'] . '} exists. Field {' . $pr['field'] . '} not added.';

				self::clearLogData();
				self::setLogData(array(
					'error' => 1,
					'message' => 'Field not added (method addField). Error: ' . self::$errorMessage,
					'object' => 'table: ' . $pr['table'] . '; field: ' . $pr['field'],
				));
				self::saveLogData();

                return false;            
            }
        } else {
            self::$errorMessage = 'Table {' . $pr['table'] . '} not exists. Field {' . $pr['field'] . '} not added.';

			self::clearLogData();
			self::setLogData(array(
				'error' => 1,
				'message' => 'Field not added (method addField). Error: ' . self::$errorMessage,
				'object' => 'table: ' . $pr['table'] . '; field: ' . $pr['field'],
			));
			self::saveLogData();

            return false;            
        }
    }
    /**************************************************************/

	/**
	* Функция выполняет CURL
	* @param string $postFields - строка параметра CURL CURLOPT_POSTFIELDS (post-запрос)
	* @return array - массив ('status', 'reply'). STATUS может быть FALSE или TRUE. Если STATUS = FALSE, то в REPLY содержится текст ошибки, иначе, ответ.
	*/
	static function curlUpdates($postFields) {
		$ch = curl_init(CONF_INFO_UPDATES_URL);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
    	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

		// массив результата выполнения ф-ии
		$arrResult = array('status' => false, 'reply' => false);

		// проверяем результат
		if (false !== ($curlResult = curl_exec($ch))) {
			$curlInfo = curl_getinfo($ch);
			// проверяем заголовок (код ответа)
			if ($curlInfo['http_code'] == 200) {
				$arrResult['status'] = true;
				$arrResult['reply'] = $curlResult;
			} else {
				switch($curlInfo['http_code']) {
					case 407:
						$arrResult['reply'] = ERROR_PROXY_AUTHENTICATION_REQUIRED;
						break;
					case 404:
						$arrResult['reply'] = ERROR_404 . ' ' . ERROR_404_DESCRIPTION;
						break;
					default:
						$arrResult['reply'] = ERROR_UNDEFINED;
						break;
				}
			}
		} else {
			$arrResult['reply'] = ERROR_CURL_NOEXEC;
		}
		curl_close($ch);
		return $arrResult;
	}

	/**
	* Функция проверяет доступны ли обновления на сайте разработчика
	* @return int - количество доступных обновлений
	*/
	static function checkUpdates() {
		if (empty($_SERVER['HTTP_HOST']))
			return 0;

        // чтоб не тянуть обновления в локальном режиме
        if ('127.0.0.1' == $_SERVER['SERVER_ADDR'])
            return 0;

		$arrReply = self::curlUpdates('checkUpdates=' . CONF_INFO_SCRIPT_REVISION . '&product=' . CONF_INFO_PRODUCT_ID . '&domain=' . $_SERVER['HTTP_HOST']);
		return $arrReply['reply'];
	}

	/**
	* Функция получает информацию о доступных обновлениях
	* @return array
	*/
	static function getUpdatesInfo() {
		if (empty($_SERVER['HTTP_HOST']))
			return false;

		$arrReply = self::curlUpdates('getUpdates=' . CONF_INFO_SCRIPT_REVISION . '&product=' . CONF_INFO_PRODUCT_ID . '&domain=' . $_SERVER['HTTP_HOST']);

		if ($arrReply['status'] && $arrReply['reply'] !== '0') {
			$xml = new SimpleXMLElement($arrReply['reply'], LIBXML_NOCDATA);
			$result = array();

			foreach ($xml -> children() as $child) {
				$result[] = get_object_vars($child);
			}

			return $result;
		} else {
			return false;
		}
	}

	/**
	* Функция получения пакета обновления
	* КОДЫ ОШИБОК
	* 404 - страница не найдена
	* 1 - пользователь не найден
	* 2 - нет допуска в соответствующую группу форума
	* 3 - в списке продуктов нет позиции соответствующей указанным параметрам
	* 4 - Не активировано время действия лицензии
	* 5 - истек срок лицензии
	* 6 - Не соблюден порядок установки обновлений или запрашиваемой сборки не существует
	* 7 - Не найдена сборка или отсутсвует файл сборки
	* @param (array) $arrData - массив данных (login, password, file, revision)
	* @return array - массив ('status', 'error'). STATUS может быть FALSE или TRUE. Если STATUS = FALSE, то в ERROR содержится текст ошибки.
	*/
	static function getUpdate(&$arrData) {
		if (empty($_SERVER['HTTP_HOST'])) {
			return 'UNABLE_DETERMINE_CURRENT_DOMAIN';
		} else {
		 	$host = $_SERVER['HTTP_HOST'];
		}
		
		set_time_limit('600');
		// файлы результатов
		// фал архива
		$arcFile = fopen(CONF_UPDATES_PATH_TO_FILES . $arrData['file'], 'w');
		// лог загрузки
		//$logFile = fopen(CONF_UPDATES_PATH_TO_FILES . $arrData['file'] . '.log', 'w');
		// заголовки
		//$hFile = fopen(CONF_UPDATES_PATH_TO_FILES . $arrData['file'] . 'H.log', 'w');

		// Загружаем архив
		$ch = curl_init(CONF_INFO_UPDATES_URL);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, 'login=' . $arrData['login'] . '&password=' . $arrData['password'] . '&domain=' . $host . '&getUpdate=' . $arrData['revision'] . '&currRevision=' . CONF_INFO_SCRIPT_REVISION . '&product=' . CONF_INFO_PRODUCT_ID);
		curl_setopt($ch, CURLOPT_VERBOSE, 1);
		curl_setopt($ch, CURLOPT_NOPROGRESS, 0);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		//curl_setopt($ch, CURLOPT_STDERR, $logFile);
		//curl_setopt($ch, CURLOPT_WRITEHEADER, $hFile);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

		// массив результата выполнения ф-ии
		$arrResult = array('status' => false, 'error' => false);

		// проверяем результат
		if ($curlResult = curl_exec($ch)) {
			$curlInfo = curl_getinfo($ch);

			if ($curlInfo['http_code'] == 200) {
				// если результат число, значит была ошибка
				if (ctype_digit($curlResult)) {
					switch($curlResult) {
						case 1:
							$arrResult['error'] = ERROR_UPDATES_USER_NOT_FOUND;
							break;
						case 2:
							$arrResult['error'] = ERROR_UPDATES_NO_ACCESS_TO_THE_FORUM_GROUP;
							break;
						case 3:
							$arrResult['error'] = ERROR_UPDATES_NOT_FOUND_PRODUCT_IN_SALES_LIST;
							break;
						case 4:
							$arrResult['error'] = ERROR_UPDATES_LICENSE_NOT_ACTIVATE;
							break;
						case 5:
							$arrResult['error'] = ERROR_UPDATES_LICENSE_EXPIRED;
							break;
						case 6:
							$arrResult['error'] = ERROR_UPDATES_INTERMEDIATE_REVISION;
							break;
						case 7:
							$arrResult['error'] = ERROR_UPDATES_REVISION_NOT_FOUND;
							break;
						case 404:
						default:
							$arrResult['error'] = ERROR_404 . ' ' . ERROR_404_DESCRIPTION;
							break;
					}
				} else {
					$arrResult['status'] = true;
					fwrite($arcFile, $curlResult);
				}
			} else {
				switch($curlInfo['http_code']) {
					case 407:
						$arrResult['error'] = ERROR_PROXY_AUTHENTICATION_REQUIRED;
						break;
					case 404:
						$arrResult['error'] = ERROR_404 . ' ' . ERROR_404_DESCRIPTION;
						break;
					default:
						$arrResult['error'] = ERROR_UNDEFINED;
						break;
				}
			}
		} else {
			$arrResult['error'] = ERROR_CURL_NOEXEC;
		}

		curl_close($ch);
		fclose($arcFile);
		//fclose($logFile);
		//fclose($hFile);
		(!$arrResult['status']) ? unlink(CONF_UPDATES_PATH_TO_FILES . $arrData['file']) : null;

		return $arrResult;
	}

	/**
	* Функция установки обновления
	* @param string $file - путь к архиву обновления
	* @return bool
	*/
	static function setupUpdate($file) {
		// проверяем файл
		if (!file_exists($file)) {
			self::$errorMessage = ERROR_UPDATES_UPDATE_FILE_NOT_FOUND;
			return false;
		}

		// создаем объект
		$zip = new PclZip($file);
		// получаем текст из файла обновления (для частичного обновления файлов)
		// если он есть
		// извлекаем файлы
        self::clearLogData();
		self::setLogData(array(
            'error' => 2,
            'message' => 'Try get data from update.xml',
            'object' => $file,
		));
		self::saveLogData();

		if ($update = $zip -> extract(PCLZIP_OPT_BY_NAME, 'update.xml', PCLZIP_OPT_EXTRACT_AS_STRING)) {
			// создаем объект SimpleXML, со свойствами файла
			$xml = new SimpleXMLElement($update[0]['content'], LIBXML_NOCDATA);

			// делаем обход по объекту, и выполянем необходимые действия
			foreach ($xml -> children() as $child) {
				// обновление PHP файлов
				if ($child -> getName() == 'php') {
			        self::clearLogData();
					self::setLogData(array(
			            'error' => 2,
			            'message' => 'Update PHP files (PHP-node in XML)',
			            'object' => 'PHP',
					));
					self::saveLogData();

					// делаем обход по текущему узлу XML-файла
					foreach ($child -> children() as $children) {
						// формируем из свойств объекта массив
						$params = get_object_vars($children);

						// проверяем, с чем необходимо работать
						if ($children -> getName() == 'expconst') {

					        self::clearLogData();
							self::setLogData(array(
					            'error' => 2,
					            'message' => 'Update constant file (action: ' . $params['action'] . '; string: ' . $params['string'] . '; value: ' . $params['value'] . ')',
					            'object' => $params['file'],
							));
							self::saveLogData();

							// если запрос не удался, логируем ошибку
							if (!self::updateConstFile($params)) {
                                self::setLogData(array(
                            		'error' => 1,
                        			'message' => self::$errorMessage,
            						'object' => $params['file'],
            						'data' => $params));
							} else {
                                self::setLogData(array(
                            		'error' => 0,
                        			'message' => 'Success updated',
            						'object' => $params['file'],
            						'data' => $params));
                            }
							self::saveLogData();
						}
						elseif ($children -> getName() == 'exparray') {
							global $$params['subj'];
                            // так сделано из-за того, что возникают проблемы с объектами SimpleXMLElement
                            // которые попадают в сериализованные данные. Это актуально только для обновления массивов
                            // т.к. там есть вложеность узлов.
                            // В дальнейшем можно сделать рекурсивную функцию для обработки таких объектов
                            // Сейчас не охота такого делать
                            $setParams = array('action' => $params['action'], 'file' => $params['file'], 'subj' => $params['subj']);

					        self::clearLogData();
							self::setLogData(array(
					            'error' => 2,
					            'message' => 'Update array file (action: ' . $params['action'] . '; file: ' . $params['file'] . '; subj: ' . $params['subj'] . ')',
					            'object' => $params['file'],
							));
							self::saveLogData();

							// если запрос не удался, логируем ошибку
							if (!self::updateArrFile($children, $$params['subj'])) {
                                self::setLogData(array(
                            		'error' => 1,
                        			'message' => self::$errorMessage,
            						'object' => $params['file'],
            						'data' => $setParams));
							} else {
                                self::setLogData(array(
                            		'error' => 0,
                        			'message' => 'Success updated',
            						'object' => $params['file'],
            						'data' => $setParams));
                            }
							self::saveLogData();
						}
						/** Обновляем файлы (добавляем текст в конец файла) **/
						elseif ($children -> getName() == 'expfile') {

					        self::clearLogData();
							self::setLogData(array(
					            'error' => 2,
					            'message' => 'Add text to file (action: ' . $params['action'] . '; string: ' . $params['string'] . ')',
					            'object' => $params['file'],
							));
							self::saveLogData();

							// если запрос не удался, логируем ошибку
							if (!self::updateTextInFile($children)) {
                                self::setLogData(array(
                            		'error' => 1,
                        			'message' => self::$errorMessage,
            						'object' => $params['file'],
            						'data' => $params));
							} else {
                                self::setLogData(array(
                            		'error' => 0,
                        			'message' => 'Success updated',
            						'object' => $params['file'],
            						'data' => $params));
                            }
                            self::saveLogData();
						}
					}
				}
				// обновление БД
				elseif ($child -> getName() == 'sql') {

			        self::clearLogData();
					self::setLogData(array(
			            'error' => 2,
			            'message' => 'Update DataBase (SQL-node in XML)',
			            'object' => 'SQL',
					));
					self::saveLogData();

					// делаем обход по текущему узлу XML-файла
					foreach ($child -> children() as $children) {
						$params = get_object_vars($children);

			        	self::clearLogData();
						self::setLogData(array(
				            'error' => 2,
				            'message' => (!empty($params['query']) ? $params['query'] : 'Not query'),
				            'object' => $params['table'] . '; action: ' . $params['action'] . (!empty($params['field']) ? '; field: ' . $params['field'] : ''),
						));
						self::saveLogData();

                        if (self::updateDB($children)) {
                            self::setLogData(array(
                            	'error' => 0,
                        		'message' => 'Success updated',
            					'object' => $params['table'],
            					'data' => $params));
                        } else {
                            self::setLogData(array(
                            	'error' => 1,
                        		'message' => self::$errorMessage,
            					'object' => $params['table'],
            					'data' => $params));
						}
						self::saveLogData();
					}
				}
				// Удаление файлов
				elseif ($child -> getName() == 'delfiles') {

			        self::clearLogData();
					self::setLogData(array(
			            'error' => 2,
			            'message' => 'Delete files',
			            'object' => 'delfiles',
					));
					self::saveLogData();

					// делаем обход по текущему узлу XML-файла
					foreach ($child -> children() as $children) {
						$params = get_object_vars($children);

			        	self::clearLogData();
						self::setLogData(array(
				            'error' => 2,
				            'message' => 'Try delete file',
				            'object' => $params['expfname'],
						));
						self::saveLogData();

						if (file_exists($params['expfname'])) {

							if (!unlink($params['expfname'])) {
								self::setLogData(array(
									'error' => 1,
							        'message' => 'Unable delete file',
							        'object' => $params['expfname']));
							} else {
							    self::setLogData(array(
							        'error' => 0,
							        'message' => 'File success deleted',
							        'object' => $params['expfname']));
							}
							self::saveLogData();
						} else {
			        		self::clearLogData();
							self::setLogData(array(
					            'error' => 0,
					            'message' => 'File not exists',
					            'object' => $params['expfname'],
							));
							self::saveLogData();
						}
					}
				}
				// Удаление дирректорий
				elseif ($child -> getName() == 'deldirs') {
					// делаем обход по текущему узлу XML-файла
			        self::clearLogData();
					self::setLogData(array(
			            'error' => 2,
			            'message' => 'Delte dirs',
			            'object' => 'deldirs',
					));
					self::saveLogData();

					foreach ($child -> children() as $children) {
						$params = get_object_vars($children);

			        	self::clearLogData();
						self::setLogData(array(
				            'error' => 2,
				            'message' => 'Try delete dir',
				            'object' => $params['expfname'],
						));
						self::saveLogData();

						if (file_exists($params['expfname'])) {

							if (!filesys::removeDir($params['expfname'])) {
								self::setLogData(array(
									'error' => 1,
            						'message' => 'Unable delete dir',
            						'object' => $params['expfname']));
							} else {
	                            self::setLogData(array(
                            		'error' => 2,
            						'message' => 'Dir success deleted',
            						'object' => $params['expfname']));
	                        }
							self::saveLogData();
						} else {
			        		self::clearLogData();
							self::setLogData(array(
					            'error' => 0,
					            'message' => 'Dir not exists',
					            'object' => $params['expfname'],
							));
							self::saveLogData();
						}
					}
				}
			}

			// записываем ошибки в лог
            self::saveLogData();

			// удаляем файл из архива
			$zip -> delete(PCLZIP_OPT_BY_NAME, 'update.xml');

			self::$message = MESSAGE_UPDATES_UPDATE_DB_SUCCESS;
			return true;
			// распаковываем архив
			//return self::extractUpdate($file);
		}
		else {// если этого файла нет, то просто копируем файлы из архива
	        self::clearLogData();
			self::setLogData(array(
	            'error' => 0,
	            'message' => 'File update.xml not exists (not required partial update)',
	            'object' => $file,
			));
			self::saveLogData();

			self::$message = MESSAGE_UPDATES_UPDATE_DB_NOT_REQUIRED;
			return true;
			//return self::extractUpdate($file);
		}
	}

	/**
	* Функция установки обновления
	* @param string $file - путь к архиву обновления
	* @return bool
	*/
	static function extractUpdate($file) {
		// проверяем файл
		if (!file_exists($file)) {
			self::$errorMessage = ERROR_UPDATES_UPDATE_FILE_NOT_FOUND;
			return false;
		}

		function pEC($p_event, &$p_header) {
            return updates::preExtractCallBack($p_event, $p_header);
        }
        
        // создаем объект
		$zip = new PclZip($file);
		// извлекаем файлы
        self::clearLogData();
		self::setLogData(array(
            'error' => 2,
            'message' => 'Try extract update files',
            'object' => $file,
		));
		self::saveLogData();

		if (!$resExtract = $zip -> extract(PCLZIP_OPT_PATH, '', PCLZIP_CB_PRE_EXTRACT, 'pEC')) {
            self::setLogData(array(
            				'error' => 1,
            				'message' => $zip -> errorInfo(true),
            				'object' => $file
            			));
            self::saveLogData();

			self::$errorMessage = ERROR_UPDATES_UNABLE_EXTRACT_FILES;
			return false;
		}

        self::saveLogData();
        
        // Выполняем патч (patch.php)
        if (file_exists('patch.php')) {

		    self::clearLogData();
			self::setLogData(array(
		        'error' => 2,
		        'message' => 'Try execute patch file',
		        'object' => 'patch.php',
			));
			self::saveLogData();

			include_once 'patch.php';

			if (unlink('patch.php')) {
		        self::clearLogData();
				self::setLogData(array(
		            'error' => 0,
		            'message' => 'Patch file execute and deleted success',
		            'object' => 'patch.php',
				));
				self::saveLogData();
			} else {
		        self::clearLogData();
				self::setLogData(array(
		            'error' => 1,
		            'message' => 'Patch file not deleted',
		            'object' => 'patch.php',
				));
				self::saveLogData();
			}
        }

		self::$message = MESSAGE_UPDATE_SUCCESSFULLY_SETUP;
		return true;
	}
    
    /**
    * Функция обработки файлов в процессе распаковки
    * @param mixed $p_event
    * @param mixed $p_header
    */
    static function preExtractCallBack($p_event, &$p_header) {

    	// Если файл admin.php, смотрим как он называется у пользователя
    	// и если название отличается, переименовываем его
		if ('admin.php' ===  $p_header['filename']) {
			if (defined('CONF_ADMIN_FILE') && 'admin.php' !== CONF_ADMIN_FILE) {
				$p_header['filename'] = CONF_ADMIN_FILE;
			}
		}

        // Проверяем, если файл существует и это не каталог
        $logData = array(
            'error' => 2,
            'message' => 'Search file',
            'object' => $p_header['filename']
        );
        self::setLogData($logData);
        self::saveLogData();

        if (@file_exists($p_header['filename']) && !$p_header['folder']) {
			// Пытаемся изменить парава доступа к файлу
            $logData = array(
             	'error' => 2,
            	'message' => 'Try chmod file (to: 0666; now: ' . filesys::getFileMode($p_header['filename']) . ')',
            	'object' => $p_header['filename']
            );
            self::setLogData($logData);
            self::saveLogData();

			if (chmod($p_header['filename'], 0666)) {
             	$logData = array(
             		'error' => 0,
            		'message' => 'File success change mode (now: ' . filesys::getFileMode($p_header['filename']) . ')',
            		'object' => $p_header['filename']
            	);
			} else {
             	$logData = array(
             		'error' => 1,
            		'message' => 'Can not change file mode (now: ' . filesys::getFileMode($p_header['filename']) . ')',
            		'object' => $p_header['filename']
            	);
			}
            self::setLogData($logData);
            self::saveLogData();

            // Пытаемся удалить файл
            $logData = array(
             	'error' => 2,
            	'message' => 'Try delete file',
            	'object' => $p_header['filename']
            );
            self::setLogData($logData);
            self::saveLogData();

            if (unlink($p_header['filename'])) {
             	$logData = array(
             		'error' => 0,
            		'message' => 'File success deleted',
            		'object' => $p_header['filename']
            	);
			} else {
				$logData = array(
					'error' => 1,
            		'message' => 'Unable delete file',
            		'object' => $p_header['filename']
            	);
			}
	        self::setLogData($logData);
	        self::saveLogData();
        } else {
			if (!file_exists($p_header['filename'])) {
	            $logData = array(
            		'error' => 0,
            		'message' => 'File not exists',
            		'object' => $p_header['filename']
	            );
			} else {
	            $logData = array(
            		'error' => 0,
            		'message' => 'This is folder',
            		'object' => $p_header['filename']
	            );
			}

	        self::setLogData($logData);
	        self::saveLogData();
        }

        return 1;
    }

	/////////////////////////////////////////////////
	// END OF CLASS updates
	/////////////////////////////////////////////////
}