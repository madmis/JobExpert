<?php
/********************************************************
	JobExpert v1.0
	powered by Script Developers Group (SD-Group)
	email: info@sd-group.org.ua
	url: http://sd-group.org.ua/
	Copyright 2010-2015 (c) SD-Group
	All rights reserved
=========================================================
 	Класс работы с файлами (файл-менеджер)
********************************************************/
/**
* @package
* @todo
*/

(!defined('SDG')) ? die ('Triple protection!') : null;

class fm
{
	/////////////////////////////////////////////////
	// VARS - свойства класса img
	/////////////////////////////////////////////////
	/**
	* массив расширений, которые распознает файл-менеджер
	* 
	* @var array
	*/
	public $arrFileTypes = array('bmp', 'cab', 'chm', 'doc', 'docx', 'emf', 'gif', 'html', 'jpeg', 'jpg', 'pdf', 'png', 'ppt', 'pptx', 'rar', 'rtf', 'tif', 'tiff', 'txt', 'xls', 'xlsx', 'xml', 'xsl', 'zip');

	/////////////////////////////////////////////////
	// METHODS - методы класса img
	/////////////////////////////////////////////////

	/**
	* Функция загрузки файлов
	* 
	* @param (string) $field_name - им поля из формы загрузки файла
	* @param (string) $upload_dir - дарректория, в которую загружать файл
	* @param (array) $fileTypes - массив типов файлов, разрешенных для загрузки (по умолчанию FALSE)
	* 
	* @return bool
	*/
	public function loadFile($field_name, $upload_dir, $fileTypes = false)
	{
		return uploads::uploadFile($field_name, $upload_dir, $fileTypes);
	}

	/**
	* функция получает все необходимые данные о файле
	* возвращает массив свойств
	* 
	* @param (string) $path - путь к файлу
	* @param (string) $file - имя файла
	* 
	* @return (array) - массив свойств файла
	*/
	public function getFileData($path, $file)
	{
    	$arrData = @stat(filesys::setPath($path) . $file);
		$ext = filesys::getExtension($file);

		if (@in_array($ext, $this -> arrFileTypes))
		{
    		$icon = $ext;
		}
    	else
    	{
    		$icon = 'undefined';
		}

		$sizekb = sprintf("%01.1f", $arrData['size'] / 1024);
		$sizemb = sprintf("%01.1f", $arrData['size'] / 1048576);

    	$arrFileData = array (
    							'name'			=> $file,
    							'icon'			=> $icon,
    							'size'			=> $arrData['size'],
    							'date'			=> $arrData['mtime'],
    							'title_sizekb'	=> $sizekb,
    							'title_sizemb'	=> $sizemb
							);

		return $arrFileData;
	}

	/**
	* функция получает все необходимые данные о картинке
	* возвращает массив свойств
	* 
	* @param (string) $path - путь к файлу
	* @param (string) $file - имя файла
	* 
	* @return (array) - массив свойств файла
	*/
	public function getImageData($path, $file)
	{
		$arrData = @getimagesize(filesys::setPath($path) . $file);

    	$arrImageData = array (
    							'thumb'			=> CONF_FILEMANAGER_THUMBNAIL_PREFIX . $file,
    							'name'			=> $file,
    							'width'			=> $arrData['0'],
    							'height'		=> $arrData['1'],
    							'mime'			=> $arrData['mime']
							);

		return $arrImageData;
	}

	/**
	* функция получает все необходимые данные о файлах
	* возвращает массив свойств
	* 
	* @param (string) $dbFile - путь к файлу uploads.mda
	* 
	* @return array or false - массив свойств всех файлов из файла БД
	*/
	public function getFilesProperties($dbFile)
	{
		return @file_exists($dbFile) ? unserialize(file_get_contents($dbFile)) : false;
	}

	/**
	* функция получает все необходимые данные о файлах
	* возвращает массив свойств
	* 
	* @param (string) $dbFile - путь к файлу uploads.mda
	* @param (array) $dbData - массив файлов и их свойств
	* 
	* @return bool
	*/
	public function putFilesProperties($dbFile, $dbData)
	{
		return @file_put_contents($dbFile, serialize($dbData));
	}

	/**
	* функция удаления файлов
	* 
	* @param (array) $files - массив, содержащий имена файлов
	* @param (string) $path - путь к удаляемым файлам
	* 
	* @return bool
	*/
	public function deleteFiles($path, $files)
	{
		if (empty($path) || empty($files))
		{
			return false;
		}

		$dbData = $this -> getFilesProperties($path . 'mda/uploads.mda');

		foreach ($files as $key => $value)
		{
			// удаляем файл
			@unlink($path . $key);
			// если картинка, удаляем иконку
			($dbData[$key]['type'] === 'image') ? @unlink($path . 'thumbs/' . CONF_FILEMANAGER_THUMBNAIL_PREFIX . $key) : null;
			// удаляем данные файла из базы
			unset($dbData[$key]);
		}

		return $this -> putFilesProperties($path . 'mda/uploads.mda', $dbData);
	}

	/////////////////////////////////////////////////
	// END OF CLASS fm
	/////////////////////////////////////////////////
}

