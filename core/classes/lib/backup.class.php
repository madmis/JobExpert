<?php
/********************************************************
	JobExpert v1.0
	powered by Script Developers Group (SD-Group)
	email: info@sd-group.org.ua
	url: http://sd-group.org.ua/
	Copyright 2010-2015 (c) SD-Group
	All rights reserved
=========================================================
	Класс работы со бекапами
********************************************************/
/**
* @package
* @todo
*/

(!defined('SDG')) ? die ('Triple protection!') : null;

class backup
{
	/////////////////////////////////////////////////
	// VARS - свойства класса backup
	/////////////////////////////////////////////////
    /** 
    * массив файлов, которые будут исключены из упаковки архива
    * каталоги передеются просто как - updates или updates/backup
    * имена файлов полностью - updates/.htaccess
    * @var array
    */
    static $arrExcept = array('updates', 'updates/backups');


	/////////////////////////////////////////////////
	// METHODS - методы класса backup
	/////////////////////////////////////////////////

	/**
	* CallBack-функция для исключения файлов и каталогов из архивации
	* 
	* @param (array) $p_header - массив инфо. о файле (из PclZip)
	* 
	* @return int 1 – означает возобновление добавления файла, 0 – пропустить файл, переходим к следующему файлу
	*/
	static function skipAddingFilesToArchive($p_event, &$p_header)
	{
		// если нет массива исключений, добавляем все файлы
		if (!is_array(self::$arrExcept) || empty(self::$arrExcept) || !is_array($p_header) || empty($p_header))
		{
			return 1;
		}

		if (!empty($p_header['stored_filename']))
		{
 			//$p_header['stored_filename'] - полный путь файла в архиве
 			// исключение дирректории или файла
 			if (in_array($p_header['stored_filename'], self::$arrExcept))
 			{
 				return 0;
			}
			else // исключаем все файлы в дирректории
			{
				$info = pathinfo($p_header['stored_filename']);

				if (!empty($info['dirname']) && in_array($info['dirname'], self::$arrExcept))
				{
					return 0;
				}
			}
		}

		return 1;
	}

	/**
	* Функция делает бекап всех файлов скрипта
	* Для исключения файлов из архива необходимо прописать их в свойство backup::$arrExcept (по умолчанию в нем array('updates', 'updates/backups'))
	* 
	* @return bool
	*/
	static function backupSite()
	{
		function except($p_event, &$p_header)
		{
			return backup::skipAddingFilesToArchive($p_event, $p_header);
		}

		$file = CONF_BACKUPS_PATH_TO_FILES . terms::currentDate() . '_site_revision_' . CONF_INFO_SCRIPT_REVISION . '.zip';
		(file_exists($file)) ? unlink($file) : null;
		$zip = new PclZip($file);

		return (!$zip -> create(CONF_ROOT_DIR, PCLZIP_OPT_REMOVE_PATH, CONF_ROOT_DIR, PCLZIP_CB_PRE_ADD, 'except')) ? $zip -> errorInfo(true) : true;
	}
	
	/**
	* Функция делает бекап БД
	* 
	* @return bool
	*/
	static function backupDB()
	{
		// файл дампа
		$file = CONF_BACKUPS_PATH_TO_FILES . terms::currentDate() . '_database_revision_' . CONF_INFO_SCRIPT_REVISION . '.sql';
		// создаем указатель на файл
		$fp = fopen($file, 'w');

		// выбираем все таблицы
		$showTablesQuery = 'SHOW TABLES';
		$showTablesId = db::dbQuery($showTablesQuery);
	    // пробегаем по массиву всeх таблиц
	    while ($showTablesRes = db::dbFetchRow($showTablesId))
		{
			// запрос создания таблицы
			$showCreateTableQuery = 'SHOW CREATE TABLE `' . $showTablesRes[0] . '`';
			$showCreateTableId = db::dbQuery($showCreateTableQuery);
	    	// пробегаем по массиву запроса создания таблиц
			while ($showCreateTableRes = db::dbFetchRow($showCreateTableId))
			{
				// добавляем в дамп запрос удаления таблицы, если она уже существует
				$tableExistsQuery = 'DROP TABLE IF EXISTS `' . $showCreateTableRes[0] . '`;' . "\n\n";
				$sqlCode = $showCreateTableRes[1];
				// записываем запрос удаления таблицы
				fwrite($fp, $tableExistsQuery);
				// записываем запрос создания таблицы
				fwrite($fp, $sqlCode . ";\n\n");

				$NumericColumn = array();
				$field = 0;
				$showColumnsQuery = 'SHOW COLUMNS FROM `' . $showCreateTableRes[0] . '`';
				$showColumnsRes = db::dbQuery($showColumnsQuery);

				while($col = db::dbFetchRow($showColumnsRes)) {
					$NumericColumn[$field++] = preg_match("/^(\w*int|year)/", $col[1]) ? 1 : 0;
				}

		    	$fields = $field;
		    	$i = 0;

				// запрос выбора всех данных из таблицы
				$dumpQuery = 'SELECT * FROM `' . $showCreateTableRes[0] . '`';
				$dmpId = db::dbQuery($dumpQuery);

				// если есть данные для INSERT
				if (db::dbNumRows($dmpId) > 0) {
					$showInsertQuery = 'INSERT INTO `' . $showCreateTableRes[0] . '` VALUES';
					// записваем запрос Insert
					fwrite($fp, $showInsertQuery);

					// проходим по результату и формируем строки для записи в файл
					while ($row = db::dbFetchRow($dmpId)) {
		        		$i++;
			            for($k = 0; $k < $fields; $k++) {
							$row[$k] = ($NumericColumn[$k]) ? (isset($row[$k]) ? $row[$k] : 'NULL') : (isset($row[$k]) ? "'" . mysql_escape_string($row[$k]) . "'" : 'NULL');
			            }

			            fwrite($fp, ($i == 1 ? '' : ',') . "\n(" . implode(', ', $row) . ')');
			        }

			        fwrite($fp, ";\n\n");
				}
		    }
		}
		return fclose($fp);
	}

	/**
	* Функция массив всех фалов резервных копий
	* 
	* @return array or false
	*/
	static function getBackupFiles()
	{
		if ($arrFiles = filesys::getFilesInDir(CONF_BACKUPS_PATH_TO_FILES))
		{
			$resArray = array();

			foreach ($arrFiles as $value)
			{
				if ($arrData = filesys::getFileData(CONF_BACKUPS_PATH_TO_FILES, $value))
				{
					$resArray[$value] = $arrData;
				}
			}

			return ($resArray) ? $resArray : false;
		}
		else
		{
			return false;
		}
	}
	/////////////////////////////////////////////////
	// END OF CLASS backup
	/////////////////////////////////////////////////
}
