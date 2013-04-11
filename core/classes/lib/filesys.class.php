<?php
/********************************************************
	powered by Script Developers Group (SD-Group)
	email: info@sd-group.org.ua
	url: http://sd-group.org.ua/
	Copyright 2009 (c) SD-Group
	All rights reserved
=========================================================
 	Класс работы с файловой системой
********************************************************/

(!defined('SDG')) ? die ('Triple protection!') : null;

class filesys
{
	/////////////////////////////////////////////////
	// VARS - свойства класса filesys
	/////////////////////////////////////////////////

	/////////////////////////////////////////////////
	// METHODS - методы класса filesys
	/////////////////////////////////////////////////

	/**
	 * Функция получает путь и приводит его к правильному формату
	 *
	 * @param (string) $path - путь
	 *
	 * @return (string) путь
	 */
	static function setPath($path) {
		return rtrim($path, '/\\') . '/';
	}

	/**
	 * Функция получает расширение файла
	 *
	 * @param (string) $filename - имя_файла
	 *
	 * @return (string) расширение (zip, gif и т.д.) или пустую строку
	 */
	static function getExtension($filename)
	{
		/*
		$path_info = @pathinfo($filename);
		return isset($path_info['extension']) ? $path_info['extension'] : false;
		*/
		return strtolower(end(explode('.', $filename)));
	}

	/**
	* Функция получает путь к дирректории
	* и возвращает массив дочерних дирректорий
	*
	* @param (string) $dir - путь к дирректории
	*
	* @return array - массив дочерних дирректорий
	*/
	static function getChildDirs($dir)
	{
		$arrDir = array();
		if (is_dir($dir))
		{
			$dir = dir($dir);

		    while (false !== ($entry = $dir -> read()))
		    {
		        if (is_dir($dir -> path . $entry) && $entry !== '.' && $entry !== '..' && $entry !== '.svn')
		        {
		                $arrDir[] = $entry;
		        }
		    }

		    $dir -> close();
		    sort($arrDir);
		}

	    return $arrDir;
	}

	/**
	* функция возвращает массив файлов из указанной дирректории игнорируя файл .htaccess
	*
	* @param (string) $dir - путь к дирректории
	*
	* @return (array) - массив файлов в дирректории
	*/
	static function getFilesInDir($dir)
	{
		$arrFiles = array();
		if (is_dir($dir))
		{
			$dir = dir($dir);

			while (false !== ($entry = $dir -> read()))
			{
				if (is_file($dir -> path . $entry) && $entry !== '.' && $entry !== '..' && $entry !== '.htaccess')
				{
						$arrFiles[] = $entry;
				}
			}

			$dir -> close();
			sort($arrFiles);
		}

		return $arrFiles;
	}

	/**
	* Функция рекурсивно копирует содержимое дирректории
	*
	* @param (string) $dirSourse - дирректория, которую нужно скопировать
	* @param (string) $dirDest - путь к дирректории, в которую нужно скопировать
	*
	* @return (bool)
	*/
	static function copyDirContent($dirSourse, $dirDest, $dirChmod = 0755, $filesChmod = 644)
	{
        // проверяем, есть ли исходные файлы
        if (!file_exists($dirSourse))
            return false;

        // проверяем, есть ли каталог, куда копировать
        if (!file_exists($dirDest))
        {
            if (!mkdir($dirDest, $dirChmod))
                return false;
        }

        if ($objs = @glob(self::setPath($dirSourse) . '*'))
        {
            foreach ($objs as &$obj)
            {
                if (is_dir($obj))
                {
                    // если каталог уже сущ., не создаем его
                    (!file_exists(self::setPath($dirDest) . end(explode('/', $obj)))) ? mkdir(self::setPath($dirDest) . end(explode('/', $obj)), $dirChmod) : null;
                    self::copyDirContent($obj, self::setPath($dirDest) . end(explode('/', $obj)), $dirChmod, $filesChmod);
                }
                else
                {
                    copy($obj, self::setPath($dirDest) . end(explode('/', $obj)));
                }
            }
        }

        return true;
    }

	/**
    * Функция рекурсивно удаляет дирректорию
	* @deprecated use removeDir
	* @param (string) $dir - путь к дирректории, которую нужно удалить
	* @return (array) - массив файлов в дирректории

	*/
	static function removeDirRec($dir)
	{
		if ($objs = @glob(self::setPath($dir) . '*'))
		{
			foreach ($objs as $obj)
			{
				@is_dir($obj) ? self::removeDirRec($obj) : @unlink($obj);
			}
		}

		return rmdir($dir);
	}

	/**
	* функция получает данные из файла (в файле данные хранятся в сериализованном виде)
	* возвращает массив
	* @param (string) $SerializedDataFile - путь и имя файла
	* @return (mixed) - десереализованные данные из файла or false
	*/
	static function getSerializedData($SerializedDataFile)
	{
		return (!@file_exists($SerializedDataFile)) ? false : @unserialize(@file_get_contents($SerializedDataFile));
	}

	/**
	* функция записывает данные в файл в сериализованном виде
	*
	* @param (string) $SerializedDataFile - путь и имя файла
	* @param (mixed) $SerializedData - данные для записи
	*
	* @return bool
	*/
	static function putSerializedData($SerializedDataFile, $SerializedData)
	{
		return @file_put_contents($SerializedDataFile, @serialize($SerializedData));
	}

	/**
	* функция отдает файл в виде строки
	*
	* @param (string) $file - путь и имя файла
	* @param (mixed) $mimetype - mime-тип файла
	*
	* @return string or false
	*/
	static function fileDownload($file, $mimetype='application/octet-stream')
	{
		if (@file_exists($file))
		{
			// Отправляем требуемые заголовки
			header($_SERVER["SERVER_PROTOCOL"] . ' 200 OK');
			// Тип содержимого. Может быть взят из заголовков полученных от клиента
			// при закачке файла на сервер. Может быть получен при помощи расширения PHP Fileinfo.
			header('Content-Type: ' . $mimetype);
			// Дата последней модификации файла
			header('Last-Modified: ' . gmdate('r', filemtime($file)));
			// Отправляем уникальный идентификатор документа,
			// значение которого меняется при его изменении.
			// В нижеприведенном коде вычисление этого заголовка производится так же,
			// как и в программном обеспечении сервера Apache
			header('ETag: ' . sprintf('%x-%x-%x', fileinode($file), filesize($file), filemtime($file)));
			// Размер файла
    		header('Content-Length: ' . (filesize($file)));
    		header('Connection: close');
			// Имя файла, как он будет сохранен в браузере или в программе закачки.
			// Без этого заголовка будет использоваться базовое имя скрипта PHP.
			// Но этот заголовок не нужен, если вы используете mod_rewrite для
			// перенаправления запросов к серверу на PHP-скрипт
    		header('Content-Disposition: attachment; filename="' . basename($file) . '";');
			// Отдаем содержимое файла
    		return file_get_contents($file);
		}
		else
		{
			header($_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found');
			header('Status: 404 Not Found');
			return false;
		}
	}

	/**
	* функция получает все необходимые данные о файле
	* возвращает массив свойств
	* @deprecated use getFileSystemData
	* @param (string) $path - путь к файлу
	* @param (string) $file - имя файла
	* @return array or false - массив свойств файла
	*/
	static function getFileData($path, &$file)
	{
    	$path = filesys::setPath($path);
    	if (!file_exists($path . $file))
    	{
    		return false;
		}

    	$arrData = stat($path . $file);
		$ext = filesys::getExtension($file);

		$sizekb = sprintf("%01.1f", $arrData['size'] / 1024);
		$sizemb = sprintf("%01.1f", $arrData['size'] / 1048576);

    	$arrFileData = array (
				'name'			=> $file,
				'path'			=> $path,
				'ext'			=> $ext,
    			'size'			=> $arrData['size'],
				'date'			=> $arrData['mtime'],
				'title_sizekb'	=> $sizekb,
				'title_sizemb'	=> $sizemb
		);

		return $arrFileData;
	}

	/**
	* Функция устанавливает права доступа к файлу
	*
	* @param (string) $file - путь к файлу
	* @param (mixed) $mode - необходимые права (0666, 0644)
	*/
	static function setFileChmod(&$file, $mode)
	{
		if ($mode == substr(sprintf('%o', fileperms($file)), -4))
		{
			return true;
		}
		else
		{
			switch ($mode)
			{
				case 644:
				case '0644':
					$result = chmod($file, 0644);
					break;

				case 666:
				case '0666':
					$result = chmod($file, 0666);
					break;

				default:
					$result = false;
					break;
			}

			return $result;
		}
	}

	/************ Набор методов для удаления файлов и дирректорий ************/
	// Эти методы работают эффективнее методов, описанных выше
	// Со временем необходимо оставить только эти методы

	/**
	* функция возвращает массив дирректорий и файлов из указанной дирректории
	*
	* @param (string) $dir - путь к дирректории
	*
	* @return (array) - массив файлов и дирректорий array(files => array(), dirs => array())
	*/
	static function getAllInDir($dir)
	{
		$arrResult = array();
		$resDir = dir(self::setPath($dir));
		while (false !== ($entry = $resDir -> read()))
		{
			if ($entry !== '.' && $entry !== '..')
			{
				is_file($resDir -> path . $entry) ? $arrResult['files'][] = $entry : $arrResult['dirs'][] = $entry;
			}
		}
		$resDir -> close();
		return $arrResult;
	}

	/**
	* Фукнция удаления файла
	*
	* @param string $path - путь к файлу
    *
    * @return bool
	*/
	static function removeFile($path)
	{
		return (!file_exists($path)) ? false : unlink($path);
	}

	/**
	* Функция удаления списка файлов - пытается удалить файлы. Ничего не возвращает.
	*
	* @param array $arrPathFiles - массив (список) файлов для удаления, в виде строки с полным путем к файлу
    *
    * @return viod
	*/
	static function removeFiles(&$arrPathFiles)
	{
		if (!empty($arrPathFiles) && is_array($arrPathFiles))
		{
			foreach ($arrPathFiles as &$file)
			{
				(file_exists($file)) ? @unlink($file) : null;
			}
		}
	}

	/**
	* Фукнция удаления дирректории (Рекурсивная ф-я)
	*
	* @param string $path - путь
    *
    * @return bool
	*/
	static function removeDir($path)
	{
		if (self::removeContentInDir($path))
		{
			return rmdir($path);
		}
		else
		{
			return false;
		}
	}

	/**
	* Фукнция удаления содержимого дирректории
	*
	* @param string $path - путь
    *
    * @return bool
	*/
	static function removeContentInDir($path)
	{
		if (is_dir($path))
		{
			$dir = dir($path);

			while (false !== ($entry = $dir -> read()))
			{
				if (is_file(self::setPath($path) . $entry))
				{
					self::removeFile(self::setPath($path) . $entry);
				}
				elseif ($entry !== '.' && $entry !== '..')
				{
					self::removeDir(self::setPath($path) . $entry);
				}
			}

			$dir -> close();

			return true;
		}
		else
		{
			return false;
		}
	}

    /**
    * функция получает системные данные файле (дата создания, размер и пр.)
    * возвращает массив свойств (name, path, abspath, ext, size, date, title_sizekb, title_sizemb)
    * @param (string) $file - полный путь к файлу
    * @return array or false - массив свойств файла
    */
    static function getFileSystemData($file)
    {
        if (!file_exists($file))
        {
            return false;
        }

        if (!$arrData = stat($file))
        {
            return false;
        }

        $name = basename($file);
        $path = dirname($file);
        $abspath = realpath($file);
        $ext = filesys::getExtension($file);
        $sizekb = sprintf("%01.1f", $arrData['size'] / 1024);
        $sizemb = sprintf("%01.1f", $arrData['size'] / 1048576);

        return array ('name'			=> $name,
                      'path'			=> $file,
                      'abspath'			=> $abspath,
                      'ext'				=> $ext,
                      'size'			=> $arrData['size'],
                      'date'			=> $arrData['mtime'],
                      'title_sizekb'	=> $sizekb,
                      'title_sizemb'	=> $sizemb
                  );
    }

    /**
    * Функция возвращает права доступа к файлу (подразумевается, что файл существует)
    * @param (string) $file - полный путь к файлу
    * @return string
    */
    static function getFileMode($file) {
    	return substr(sprintf('%o', fileperms($file)), -4);
    }
    
	/////////////////////////////////////////////////
	// END OF CLASS filesys
	/////////////////////////////////////////////////
}
