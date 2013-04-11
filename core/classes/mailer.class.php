<?php
/********************************************************
	powered by Script Developers Group (SD-Group)
	email: info@sd-group.org.ua
	url: http://sd-group.org.ua/
	Copyright 2009 (c) SD-Group
	All rights reserved
=========================================================
 	Класс для отправки писем с сайта
********************************************************/

(!defined('SDG')) ? die ('Triple protection!') : null;

/**
* Класс для отправки писем с сайта
*/
class mailer extends bmailer
{
	/////////////////////////////////////////////////
	// VARS - свойства класса vacancy
	/////////////////////////////////////////////////

	/**
	* массив для хранения параметров отсылаемых сообщений
	* 
	* @var array
	*/
	private $arrSendMail;

	/**
	* массив для хранения шаблонов замен
	* 
	* @var array
	*/
	private $arrAddReplace;

	/////////////////////////////////////////////////
	// CONSTRUCTOR - конструктор класса vacancy
	/////////////////////////////////////////////////

	/**
	* конструктор
	* 
	* Инициирует свойства класса
	* Перегружает конструктор родительского класса
	* 
	*/
	public function __construct($arrAddReplace = false)
	{
		$this -> arrSendMail = false;

		$this -> setAddReplace($arrAddReplace);

		parent::__construct();
	}

	/////////////////////////////////////////////////
	// METHODS - методы класса mailer
	/////////////////////////////////////////////////

	/**
	* функция записывает полученный массив в свойство $arrAddReplace
	* 
	* @param mixed $arrAddReplace
	*/
	public function setAddReplace($arrAddReplace)
	{
		$this -> arrAddReplace = $arrAddReplace;

		return true;
	}

	/**
	* Функция предотправки писем
	* 
	* $from - адрес, с которого отправлено письмо
	* $from_name - имя отправителя
	* $sender - адрес, для ответа на письмо
	* $message - сообщение
	* $to_address - адрес получателя
	* $to_name - имя получателя
	* $file_pattern - имя файла шаблона
	* $text - признак, определяющий что находится в переменной $file_pattern ($text = false - имя файла, $text = true - текст для отправки)
	* 
	* @return bool
	*/
	public function sendEmail($from, $from_name = false, $sender = false, $to_address, $to_name = false, $subject, $file_pattern, $text = false)
	{
		$this -> arrSendMail = array(
										'From'			=> $from,
										'FromName'		=> $from_name,
										'Sender'		=> $sender,
										'ToAddress'		=> $to_address,
										'ToName'		=> $to_name,
										'Subject'		=> $subject,
										'FilePattern'	=> $file_pattern,
										'Text'			=> $text
									);

		return parent::sendEmail();
	}

	/**
	* функция возвращает массив храняшийся в свойстве $arrSendMail
	* 
	* @return array $arrSendMail or false
	*/
	protected function retSendMail()
	{
		return (!$this -> arrSendMail) ? false : $this -> arrSendMail;
	}

	/**
	* функция возвращает массив храняшийся в свойстве $arrAddReplace
	* 
	* @return array $arrAddReplace or false
	*/
	protected function retAddReplace()
	{
		return (!$this -> arrAddReplace) ? false : $this -> arrAddReplace;
	}

	/////////////////////////////////////////////////
	// END OF CLASS mailer
	/////////////////////////////////////////////////
}

