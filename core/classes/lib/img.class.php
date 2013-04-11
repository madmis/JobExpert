<?php
/********************************************************
	powered by Script Developers Group (SD-Group)
	email: info@sd-group.org.ua
	url: http://sd-group.org.ua/
	Copyright 2009 (c) SD-Group
	All rights reserved
=========================================================
 	Класс обработки изображений
********************************************************/

(!defined('SDG')) ? die ('Triple protection!') : null;

class img
{
	/////////////////////////////////////////////////
	// VARS - свойства класса img
	/////////////////////////////////////////////////

	/**
	* массив типов избражения (типы возвращаемые функцией getimagesize)
	* 1 = GIF, 2 = JPG, 3 = PNG.
	* Массив указывает изображения какого типа разрешены для загрузки
	* 
	* @var array
	*/
	static $imgTypes = array(1, 2, 3);

	/**
	* Свойства изображения
	* 
	* name - имя текущего изображения
	* dir - путь к изображению
	* full_path - путь к изображению с именем изображения
	* width - ширина изображения
	* height - высота изображения
	* type - тип изображения (1 = GIF, 2 = JPG, 3 = PNG, 4 = SWF, 5 = PSD, 6 = BMP, 7 = TIFF(байтовый порядок intel), 8 = TIFF(байтовый порядок motorola), 9 = JPC, 10 = JP2, 11 = JPX) - у нас используется только 3 первых типа. Отсальные пока запрещены.
	* mime - mime-тип изображения
	* ext - расширение файла
	* identifier - идентификатор (resource) изображения, полученного из данного файла name
	* 
	* @var array
	*/
	static $arrImgSubj = array(
								'name'			=> '',
								'dir'			=> '',
								'full_path'		=> '',
								'width'			=> '',
								'height'		=> '',
								'type'			=> '',
								'mime'			=> '',
								'ext'			=> '',
								'resource'		=> ''
							);

	/**
	* Свойство для хранения ошибок
	* 
	* @var array
	*/
	static $arrErrors = array();

	/////////////////////////////////////////////////
	// METHODS - методы класса img
	/////////////////////////////////////////////////

	/**
	* Функция установки ошибок
	* 
	* @param (string) $error
	* 
	* @return void
	*/
	static function setError($error)
	{
		self::$arrErrors[] = $error;
	}

	/**
	* Функция сохраняет изображение из дескриптора в файл, в соответствии с типом изображения
	* Тип изображения берется из свойств класса
	* 
	* @param (resource) $resImage - дескриптор (идентификатор) изображения
	* @param (string) $newImg - имя файла, в который сохранить изображение (формат: путь/имя_файла)
	* 
	* @return bool
	*/
	static function saveImgToFile($resImage, $newImg)
	{
		// определяем тип изображени и сохраняем его в файл
		switch (self::$arrImgSubj['type'])
		{
			case '1':
				if (@ImageGIF($resImage, $newImg))
				{
					return true;
				}
				else
				{
					self::setError(ERROR_FILE_NOT_SAVED);
					return false;
				}
				break;

			case '2':
				if (@ImageJPEG($resImage, $newImg, 80))
				{
					return true;
				}
				else
				{
					self::setError(ERROR_FILE_NOT_SAVED);
					return false;
				}
				break;

			case '3':
				if(@ImagePNG($resImage, $newImg))
				{
					return true;
				}
				else
				{
					self::setError(ERROR_FILE_NOT_SAVED);
					return false;
				}
				break;
		}

		self::setError(ERROR_FILE_NOT_SAVED);		
		return false;
	}

	/**
	* Функция создает resource изображения из файла, в соответствии с типом изображения
	* Тип и файл изображения берутся из свойств класса
	* 
	* @return (resource or false) $resImage
	*/
	static function createImgFromFile()
	{
		switch (self::$arrImgSubj['type'])
		{
			case '1':
				if ($resImage = @ImageCreateFromGIF(self::$arrImgSubj['full_path']))
				{
					return $resImage;
				}
				else
				{
					self::setError(ERROR_FILE_NOT_LOAD);
					return false;
				}
				break;

			case '2':
				if ($resImage = @ImageCreateFromJPEG(self::$arrImgSubj['full_path']))
				{
					return $resImage;
				}
				else
				{
					self::setError(ERROR_FILE_NOT_LOAD);
					return false;
				}
				break;

			case '3':
				if ($resImage = @ImageCreateFromPNG(self::$arrImgSubj['full_path']))
				{
					return $resImage;
				}
				else
				{
					self::setError(ERROR_FILE_NOT_LOAD);
					return false;
				}
				break;
		}

		self::setError(ERROR_FILE_NOT_LOAD);
		return false;
	}

	/**
	* Функция устанавливает параметры изображения (использует ф-ю getimagesize)
	* 
	* @param (string) $imgName - имя файла изображения
	* @param (string) $imgDir -  дарректория, в которой находится файл
	* 
	* @return bool
	*/
	static function setParam($imgName, $imgDir)
	{
		$imgDir = filesys::setPath($imgDir);

		// проверяем существование файла
		if (@file_exists($imgDir . $imgName))
		{
			// проверяем, является ли файл картинкой
			if ($params = @getimagesize($imgDir . $imgName))
			{
				// проверяем тип изображения
				if (in_array($params[2], self::$imgTypes))
				{
					self::$arrImgSubj['name'] = strtolower($imgName);
					self::$arrImgSubj['dir'] = strtolower($imgDir);
					self::$arrImgSubj['full_path'] = self::$arrImgSubj['dir'] . self::$arrImgSubj['name'];
					self::$arrImgSubj['width'] = $params[0];
					self::$arrImgSubj['height'] = $params[1];
					self::$arrImgSubj['type'] = $params[2];
					self::$arrImgSubj['mime'] = strtolower($params['mime']);

					// если в скприпте установлена настройка "Создавать водяной знак для всех изображений"
					// т.е. для исходного и для всех его копий
					// тогда создаем водяной знак.
					// В этом случае исходное изображение уже будет содержать водяной знак
					// и все копии этого изображения тоже будут с водяным знаком
					if (CONF_FILES_IMG_CREATE_WATERMARK && CONF_FILES_IMG_CREATE_WATERMARK_ON === 'all')
					{
						if (!img::createWatermark())
						{
							@unlink($imgDir . $imgName);
							return false;
						}
					}

					switch ($params[2])
					{
						case 1:
							self::$arrImgSubj['ext'] = 'gif';
							self::$arrImgSubj['resource'] = @ImageCreateFromGIF(self::$arrImgSubj['full_path']);
							break;

						case 2:
							self::$arrImgSubj['ext'] = 'jpg';
							self::$arrImgSubj['resource'] = @ImageCreateFromJPEG(self::$arrImgSubj['full_path']);
							break;

						case 3:
							self::$arrImgSubj['ext'] = 'png';
							self::$arrImgSubj['resource'] = @ImageCreateFromPNG(self::$arrImgSubj['full_path']);
							break;
					}

					// если в скприпте установлена настройка "Создавать водяной знак только для исходного изображения"
					// тогда создаем водяной знак.
					// В этом случае водяной знак будет только на одной картинке, а его копии будут без водяного знака
					if (CONF_FILES_IMG_CREATE_WATERMARK && CONF_FILES_IMG_CREATE_WATERMARK_ON === 'source')
					{
						if (!img::createWatermark())
						{
							@unlink($imgDir . $imgName);
							return false;
						}
					}

					return true;
				}
				else
				{
					self::setError(ERROR_FILE_FORMAT_ERROR);
					@unlink($imgDir . $imgName);

					return false;
				}
			}
			else
			{
				self::setError(ERROR_FILE_NOT_IMAGE);
				@unlink($imgDir . $imgName);

				return false;
			}
		}
		else
		{
			self::setError(ERROR_FILE_NOT_EXISTS);
			return false;
		}
		
		return false;
	}

	/**
	* Функция создания иконки
	* Размеры иконки рассчитываются в соответствии с пропорциями
	* 
	* @param (int) $max_width - максимальная ширина иконки (в пикселах)
	* @param (int) $max_height - максимальная высота иконки (в пикселах)
	* @param (string) $prefix - префикс иконки (по умолчанию - thumb_)
	* 
	* @return bool
	*/
	static function createThumbnail($max_width, $max_height, $prefix = 'thumb_')
	{
		return self::resizeImg($max_width, $max_height, self::$arrImgSubj['dir'] . 'thumbs/' . strtolower($prefix) . self::$arrImgSubj['name']);
	}
	
	/** 
	* Функция наложения графического водяного знака на изображение
	* 
	* @return bool
	*/
	static function imgWatermark()
	{
		// проверяем существование файла водяного знака
		if (!@file_exists(CONF_FILES_IMG_WATERMARK_IMAGE))
		{
			self::setError(ERROR_FILE_NOT_FOUND_WATERMARK);
			return false;
		}

		// получаем два дескриптора изображений
		if (!$resWM = @ImageCreateFromPNG(CONF_FILES_IMG_WATERMARK_IMAGE))
		{
			self::setError(ERROR_FILE_CREATE_WATERMARK);
			return false;
		}

		if (!$resImg = self::createImgFromFile())
		{
			self::setError(ERROR_FILE_CREATE_WATERMARK);
			return false;
		}

		if (!@ImageAlphaBlending($resImg, true))
		{
			self::setError(ERROR_FILE_CREATE_WATERMARK);
			return false;
		}

		// получаем размеры загруженного изображения и размер водяного знака
		$srcWidth  = @ImageSX($resImg);
		$srcHeight = @ImageSY($resImg);
		$wmWidth  = @ImageSX($resWM);
		$wmHeight = @ImageSY($resWM);

		// если водяной знак больше изображения, оставляем без водяного знака
		if ($srcWidth < $wmWidth)
		{
			return true;
		}

		// определяем координаты размещения водяного знака
		$margin = 10;
		$alignment = explode(':', CONF_FILES_IMG_WATERMARK_ALIGNMENT);

		// если вдруг расположение получено не правильно, устанавливаем значение по дефолту
		if (count($alignment) <> 2)
		{
			$alignment = array(0 => 'L', 1 => 'B');
		}

		// определяем координату X
		switch ($alignment[0])
		{
			case 'L':
			default:
				$x = $margin;
				break;

			case 'C':
				$x = (int) abs($srcWidth/2 - $wmWidth/2 + $margin);
				break;

			case 'R':
				$x = (int) abs($srcWidth - $wmWidth - $margin);
				break;
		}

		// определяем координату Y
		switch ($alignment[1])
		{
			case 'T':
			default:
				$y = $margin + 30;
				break;

			case 'M':
				$y = (int) abs($srcHeight/2 - $wmHeight/2 + $margin);
				break;

			case 'B':
			default:
				$y = (int) abs($srcHeight - $wmHeight - $margin);
				break;
		}

		if (!@ImageCopy($resImg, $resWM, $x, $y, 0, 0, $wmWidth, $wmHeight))
		{
			self::setError(ERROR_FILE_CREATE_WATERMARK);
			return false;
		}

		if (!self::saveImgToFile($resImg, self::$arrImgSubj['full_path']))
		{
			self::setError(ERROR_FILE_CREATE_WATERMARK);
			return false;
		}

		@ImageDestroy($resWM);
		@ImageDestroy($resSrc);

		return true;
	}

	/** 
	* Функция наложения водяного текстового знака на изображение
	* 
	* @return bool
	*/
	static function textWatermark()
	{
		// текст водяного знака
		$text = CONF_FILES_IMG_WATERMARK_TEXT;
		// файл шрифта
		$font = 'core/fonts/' . CONF_FILES_IMG_WATERMARK_FONT;

		if (!@file_exists($font))
		{
			self::setError(ERROR_FILE_NOT_FOUND_FONT);
			return false;
		}

		// Если кодировка не windows-1251 преобразовуем текст в юникод
		if (strtolower(CONF_DEFAULT_CHARSET) === 'windows-1251')
		{
			$text = strings::WinToUtf8($text);
			//$text = strings::Utf8ToWin($text);
		}

		// создем дескриптор изображения
		if (!$resImg = self::createImgFromFile())
		{
			self::setError(ERROR_FILE_CREATE_WATERMARK);
			return false;
		}

		// получаем обрамляющий бокс водяного знака
		$wmBox = @ImageTtfbBox(CONF_FILES_IMG_WATERMARK_FONT_SIZE, 0, $font, $text);
		// получаем размеры загруженного изображения и размер водяного знака
		$srcWidth  = @ImageSX($resImg);
		$srcHeight = @ImageSY($resImg);
		$wmWidth  = abs($wmBox[2]);
		$wmHeight = abs($wmBox[5]);

		// если водяной знак больше изображения, оставляем без водяного знака
		if ($srcWidth < $wmWidth)
		{
			return true;
		}

		// определяем координаты размещения водяного знака
		$margin = 10;
		$alignment = explode(':', CONF_FILES_IMG_WATERMARK_ALIGNMENT);

		// если вдруг расположение получено не правильно, устанавливаем значение по дефолту
		if (count($alignment) <> 2)
		{
			$alignment = array(0 => 'L', 1 => 'B');
		}

		// определяем координату X
		switch ($alignment[0])
		{
			case 'L':
			default:
				$x = $margin;
				break;

			case 'C':
				$x = (int) abs($srcWidth/2 - $wmWidth/2 + $margin);
				break;

			case 'R':
				$x = (int) abs($srcWidth - $wmWidth - $margin);
				break;
		}

		// определяем координату Y
		switch ($alignment[1])
		{
			case 'T':
			default:
				$y = $margin + 30;
				break;

			case 'M':
				$y = (int) abs($srcHeight/2 - $wmHeight/2 + $margin);
				break;

			case 'B':
			default:
				$y = (int) abs($srcHeight - $wmHeight - $margin);
				break;
		}

		// определяем цвет текста
		$rgb = strings::colorHexToDec(CONF_FILES_IMG_WATERMARK_FONT_COLOR);
		$txt_color = ImageColorAllocateAlpha($resImg, $rgb[0], $rgb[1], $rgb[2], CONF_FILES_IMG_WATERMARK_TRANSPARENT);

		// накладываем водяную марку на изображение
		@ImageTtfText($resImg, CONF_FILES_IMG_WATERMARK_FONT_SIZE, 0, $x, $y, $txt_color, $font, $text);

		// сохраняем результат в файл
		if (!self::saveImgToFile($resImg, self::$arrImgSubj['full_path']))
		{
			self::setError(ERROR_FILE_CREATE_WATERMARK);
			return false;
		}

		// уничтожаем дескриптор
		@ImageDestroy($resImg);

		return true;
	}

	/**
	* Функция наложения водяного знака в зависимости от настроек скрипта 
	* 
	* @return bool
	*/
	static function createWatermark()
	{
		if (strtolower(CONF_FILES_IMG_WATERMARK_TYPE) === 'image')
		{
			return self::imgWatermark();
		}
		else
		{
			return self::textWatermark();
		}
	}

	static function resizeImg($max_width, $max_height, $newImgName)
	{
		// получаем размер созданного ранее изображения
		$srcWidth  = ImageSX(self::$arrImgSubj['resource']);
		$srcHeight = ImageSY(self::$arrImgSubj['resource']);

		// смотрим, нужно ли менять размер
		if ($max_width < $srcWidth || $max_height < $srcHeight)
		{
			// определяем соотношение ширины и высоты
			$ratioWidth  = $srcWidth / $max_width;
			$ratioHeight = $srcHeight / $max_height;

			// определяем размер создаваемой иконки			
			if ($ratioWidth < $ratioHeight)
			{
				$destWidth  = $srcWidth / $ratioHeight;
				$destHeight = $max_height;
			}
			else
			{
				$destWidth  = $max_width;
				$destHeight = $srcHeight / $ratioWidth;
			}
		}
		else
		{
			$destWidth = $srcWidth;
			$destHeight = $srcHeight;
		}			

		// создаём новое изображение true color
		if (!$resImage = @ImageCreateTrueColor($destWidth, $destHeight))
		{
			@unlink(self::$arrImgSubj['full_path']);
			return false;
		}

		// копируем и изменяем размеры части изображения с пересэмплированием
		if (!@ImageCopyResampled($resImage, self::$arrImgSubj['resource'], 0, 0, 0, 0, $destWidth, $destHeight, $srcWidth, $srcHeight))
		{
			@unlink(self::$arrImgSubj['full_path']);
			return false;
		}

		// сохраняем изображение в файл
		if (!self::saveImgToFile($resImage, $newImgName))
		{
			@unlink(self::$arrImgSubj['full_path']);
			return false;
		}

		// уничтожаем созданные ранее дескрипторы изображений
		@ImageDestroy($resImage);
		@ImageDestroy(self::$arrImgSubj['resource']);

		return true;
	}		

	/////////////////////////////////////////////////
	// END OF CLASS img
	/////////////////////////////////////////////////
}
