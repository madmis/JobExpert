<?php

/* * ******************************************************
  powered by Script Developers Group (SD-Group)
  email: info@sd-group.org.ua
  url: http://sd-group.org.ua/
  Copyright 2009 (c) SD-Group
  All rights reserved
  =========================================================
  Класс обработки загрузки файлов
 * ****************************************************** */

(!defined('SDG')) ? die('Triple protection!') : null;

class uploads {
	/////////////////////////////////////////////////
	// VARS - свойства класса uploads
	/////////////////////////////////////////////////

	/**
	 * Свойства файла
	 * 
	 * @var array
	 */
	static $arrUploadsSubj = array(
		'file_name' => '',
		'file_type' => '',
		'file_size' => '',
		'file_tmp_name' => '',
		'file_ext' => '',
		'upload_dir' => ''
	);

	/**
	 * Свойства файла для записи в файл БД
	 * Данное свойство предназначено исключительно для файл-менеджера
	 * (хотя некоторые параметры можно использовать не только в файл-менеджере)
	 * 
	 * @var array
	 */
	static $fileProperties = array(
		'filename' => '', // полное имя файла
		'path' => '', // путь, по которому сохранен файл
		'link' => '', // ссылка к файлу
		'type' => '', // тип файла: image or file
		'ext' => '', // расширение файла
		'name' => '', // имя файла без расширения
		'mime' => '', // mime-type файла
		'size' => '', // размер файла в байтах
		'sizekb' => '', // размер файла в килобайтах
		'width' => '', // ширина (если картинка)
		'height' => '', // высота (если картинка)
		'date' => '', // дата загрузки файла
		'icon' => '', // иконка для типа файла
		'md5' => '' // md5 файла
	);

	/**
	 * Свойство для хранения ошибок (можно использовать для логирования ошибок загрузки файлов)
	 * 
	 * @var array
	 */
	static $arrErrors = array();

	/////////////////////////////////////////////////
	// METHODS - методы класса uploads
	/////////////////////////////////////////////////

	/**
	 * Функция установки ошибок
	 * 
	 * @param (string) $error
	 * 
	 * @return void
	 */
	static function setError($error) {
		self::$arrErrors[] = $error;
	}

	/**
	 * Функция устанавливает расширение файла
	 *
	 * @param (string) $filename - путь к файлу (Формат: путь/имя_файла)
	 * 
	 * @return void
	 */
	static function setExtension($filename) {
		/*
		  $path_info = @pathinfo($filename);
		  return isset($path_info['extension']) ? $path_info['extension'] : false;
		 */
		self::$arrUploadsSubj['file_ext'] = filesys::getExtension($filename);
	}

	/**
	 * Устанавливает дирректорию для загрузки файла
	 *
	 * @param (string) $upload_dir - дирректория, в которую необходимо загрузить файл
	 * 
	 * @return void
	 */
	static function setUploadDir($upload_dir) {
		self::$arrUploadsSubj['upload_dir'] = strtolower(filesys::setPath($upload_dir));
	}

	/**
	 * Функция загрузки файлов
	 * 
	 * @param (string) $field_name - им поля из формы загрузки файла
	 * @param (string) $upload_dir - дарректория, в которую загружать файл
	 * @param (array) $fileTypes - массив типов файлов, разрешенных для загрузки (по умолчанию FALSE)
	 * 
	 * @return bool
	 */
	static function uploadFile($field_name, $upload_dir, $fileTypes = false) {
		// передан ли файл
		if (!isset($_FILES[$field_name])) {
			self::setError(ERROR_FILE_NOT_SELECTED);
			return false;
		}

		// загружен ли файл через HTTP POST
		if (!is_uploaded_file($_FILES[$field_name]['tmp_name'])) {
			self::setError(ERROR_FILE_NOT_LOAD);
			return false;
		}

		// ошибки загрузки файла
		if ($_FILES[$field_name]['error']) {
			$arrError = array();

			switch ($_FILES[$field_name]['error']) {
				case 1:
				case 2:
					self::setError(ERROR_FILE_UPLOAD_MAX_FILESIZE);
					break;
				case 3:
					self::setError(ERROR_FILE_LOAD_ONLY_PARTIAL);
					break;
				case 6:
					self::setError(ERROR_FILE_UPLOAD_NO_TMP_DIR);
					break;
				case 7:
					self::setError(ERROR_FILE_UPLOAD_CANT_WRITE);
					break;
				case 8:
					self::setError(ERROR_FILE_UPLOAD_EXTENSION);
					break;
				case 4:
				default:
					self::setError(ERROR_FILE_NOT_LOAD);
					break;
			}

			return false;
		}

		// проверяем, соответствует ли размер файла установленным в настройках
		if ($_FILES[$field_name]['size'] > CONF_FILES_MAX_SIZE * 1024) {
			self::setError(ERROR_FILE_UPLOAD_MAX_FILESIZE);
			return false;
		}

		// проверяем имя файла
		if (!preg_match("/^[A-z0-9\._-]+$/", $_FILES[$field_name]['name'])) {
			self::setError(ERROR_FILE_NAME);
			return false;
		}

		// проверяем тип файла
		if (!empty($fileTypes) && is_array($fileTypes) && !in_array(strtolower(filesys::getExtension($_FILES[$field_name]['name'])), $fileTypes)) {
			self::setError(ERROR_FILE_FORMAT_ERROR);
			return false;
		}

		// устанавливаем дирректорию
		self::setUploadDir($upload_dir);

		// перемещаем файл в необходимую дирректорию
		if (!@copy($_FILES[$field_name]['tmp_name'], self::$arrUploadsSubj['upload_dir'] . strtolower($_FILES[$field_name]['name']))) {
			if (!@move_uploaded_file($_FILES[$field_name]['tmp_name'], self::$arrUploadsSubj['upload_dir'] . strtolower($_FILES[$field_name]['name']))) {
				self::setError(ERROR_FILE_NOT_LOAD);
				return false;
			}
		}

		// если все нормально, устанавливаем свойства
		self::$arrUploadsSubj['file_name'] = strtolower($_FILES[$field_name]['name']);
		self::$arrUploadsSubj['file_type'] = $_FILES[$field_name]['type'];
		self::$arrUploadsSubj['file_size'] = $_FILES[$field_name]['size'];
		// устанавливаем расширение файла
		self::setExtension(self::$arrUploadsSubj['upload_dir'] . strtolower($_FILES[$field_name]['name']));

		// устанавливаем свойства файла, необходимые для записи в файл БД
		// Пока этот метод используется только для файл-менеджера
		(!empty($fileTypes)) ? self::setDBProperties($field_name, $fileTypes) : null;

		return true;
	}

	/**
	 * Загрузка изображений. Имя файла формируется автоматически (tempnam()).
	 * @param (string) $field_name - им поля из формы загрузки файла
	 * @param (string) $upload_dir - дарректория, в которую загружать файл
	 * @return bool
	 */
	static function uploadImage($field_name, $upload_dir) {
		// передан ли файл
		if (!isset($_FILES[$field_name])) {
			self::setError(ERROR_FILE_NOT_SELECTED);
			return false;
		}

		// загружен ли файл через HTTP POST
		if (!is_uploaded_file($_FILES[$field_name]['tmp_name'])) {
			self::setError(ERROR_FILE_NOT_LOAD);
			return false;
		}

		// ошибки загрузки файла
		if ($_FILES[$field_name]['error']) {
			$arrError = array();

			switch ($_FILES[$field_name]['error']) {
				case 1:
				case 2:
					self::setError(ERROR_FILE_UPLOAD_MAX_FILESIZE);
					break;
				case 3:
					self::setError(ERROR_FILE_LOAD_ONLY_PARTIAL);
					break;
				case 6:
					self::setError(ERROR_FILE_UPLOAD_NO_TMP_DIR);
					break;
				case 7:
					self::setError(ERROR_FILE_UPLOAD_CANT_WRITE);
					break;
				case 8:
					self::setError(ERROR_FILE_UPLOAD_EXTENSION);
					break;
				case 4:
				default:
					self::setError(ERROR_FILE_NOT_LOAD);
					break;
			}

			return false;
		}

		// проверяем, соответствует ли размер файла установленным в настройках
		if ($_FILES[$field_name]['size'] > CONF_FILES_MAX_SIZE * 1024) {
			self::setError(ERROR_FILE_UPLOAD_MAX_FILESIZE);
			return false;
		}

		// устанавливаем дирректорию
		self::setUploadDir($upload_dir);
		
		if (!$fileName = uniqid().time()) {
			self::setError(ERROR_FILE_NAME);
			return false;
		}

		// устанавливаем расширение файла
		self::setExtension(self::$arrUploadsSubj['upload_dir'] . $_FILES[$field_name]['name']);
		$fileName = strtolower($fileName) . '.' .self::$arrUploadsSubj['file_ext'];

		// перемещаем файл в необходимую дирректорию
		if (!@copy($_FILES[$field_name]['tmp_name'], self::$arrUploadsSubj['upload_dir'] . $fileName)) {
			if (!@move_uploaded_file($_FILES[$field_name]['tmp_name'], self::$arrUploadsSubj['upload_dir'] . $fileName)) {
				self::setError(ERROR_FILE_NOT_LOAD);
				return false;
			}
		}

		// если все нормально, устанавливаем свойства
		self::$arrUploadsSubj['file_name'] = $fileName;
		self::$arrUploadsSubj['file_type'] = $_FILES[$field_name]['type'];
		self::$arrUploadsSubj['file_size'] = $_FILES[$field_name]['size'];

		return true;
	}

	/**
	 * Функция устанавливает свойства файла, необходимые для записи в файл БД
	 * Пока этот метод необходим только для файл-менеджера
	 * 
	 * @param (string) $field_name - им поля из формы загрузки файла
	 * @param (array) $fileTypes - массив типов файлов, разрешенных для загрузки (по умолчанию FALSE)
	 * 
	 * @return bool
	 */
	static function setDBProperties($field_name, $fileTypes) {
		// проверка на изображение
		$imgData = getimagesize($_FILES[$field_name]['tmp_name']);
		// устанавливаем свойства для записи в файл БД
		self::$fileProperties['filename'] = strtolower($_FILES[$field_name]['name']);
		self::$fileProperties['ext'] = filesys::getExtension(self::$fileProperties['filename']);
		self::$fileProperties['name'] = rtrim(self::$fileProperties['filename'], '.' . self::$fileProperties['ext']);
		self::$fileProperties['path'] = !empty($imgData) ? CONF_FILEMANAGER_PATH_TO_IMAGES : CONF_FILEMANAGER_PATH_TO_FILES;
		self::$fileProperties['link'] = self::$fileProperties['path'];
		self::$fileProperties['type'] = !empty($imgData) ? 'image' : 'file';
		self::$fileProperties['mime'] = $_FILES[$field_name]['type'];
		self::$fileProperties['size'] = $_FILES[$field_name]['size'];
		self::$fileProperties['sizekb'] = sprintf("%01.1f", $_FILES[$field_name]['size'] / 1024);
		self::$fileProperties['width'] = !empty($imgData) ? $imgData[0] : false;
		self::$fileProperties['height'] = !empty($imgData) ? $imgData[1] : false;
		self::$fileProperties['date'] = time();
		self::$fileProperties['icon'] = (!empty($fileTypes) && is_array($fileTypes) && in_array(self::$fileProperties['ext'], $fileTypes)) ? self::$fileProperties['ext'] : 'undefined';
		self::$fileProperties['md5'] = md5(self::$fileProperties['filename']);

		return true;
	}

	/////////////////////////////////////////////////
	// END OF CLASS uploads
	/////////////////////////////////////////////////
}

