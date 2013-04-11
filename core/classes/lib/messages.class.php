<?php
/********************************************************
	powered by Script Developers Group (SD-Group)
	email: info@sd-group.org.ua
	url: http://sd-group.org.ua/
	Copyright 2009 (c) SD-Group
	All rights reserved
=========================================================
	Класс работы с сообщениями
********************************************************/

(!defined('SDG')) ? die ('Triple protection!') : null;

class messages
{
	/////////////////////////////////////////////////
	// VARS - свойства класса messages
	/////////////////////////////////////////////////

	/////////////////////////////////////////////////
	// METHODS - методы класса messages
	/////////////////////////////////////////////////

	/**
	* Функция выводит пользователю сообщение и перегружает страницу
	* 
	* @param (string) $title - заголовок сообщения и страницы
	* @param (string) $message or false - сообщение, которое необходимо выдать пользователю
	* @param (string) $page or false - страница, на которую перенаправить пользователя после перезагрузки страницы
	* @param (int) $timeout or false - таймаут (ожидание) в течение которого будет отображаться сообщение перед перезагрузкой страницы
	*/
	static function messageChangeSaved($title, $message, $page, $timeout = 2000)
	{
		$message = (!empty($message)) ? '<p class="p_message">' . $message . '</p>' : '';

		(empty($page) || !is_string($page)) ? $page = '#' : null;

		$reload = (is_int($timeout) && '#' !== $page) ? '<script type="text/javascript">function reload() { window.location = "' . html_entity_decode($page, ENT_QUOTES, 'UTF-8') . '" }; setTimeout("reload()", ' . $timeout . ');</script>' : '';

		$message_redirect = (!empty($reload)) ? MESSAGE_CHANGE_SAVED_REDIRECT : '';

		// получаем текст шаблона
		if ($html = @file_get_contents('core/messages/reload.message.html'))
		{
			$html = strtr($html, array(
											'%CHARSET%' => CONF_DEFAULT_CHARSET,
											'%TITLE%' => $title,
											'%MESSAGE%' => $message,
											'%REDIRECT_LINK%' => $page,
											'%REDIRECT_TEXT%' => $message_redirect,
											'%RELOAD%' => $reload
									  ));
		}

		die ($html);
	}
	
	/**
	* Функция выводит пользователю сообщение и прекращает выполнение скрипта
	* 
	* @param (string) $message - сообщение, которое необходимо выдать пользователю
	*/
	static function printDie($message)
	{
		// получаем текст шаблона
		if ($html = @file_get_contents('core/messages/die.message.html'))
		{
			$html = strtr($html, array(
											'%CHARSET%' => CONF_DEFAULT_CHARSET,
											'%TITLE%' => $message,
											'%MESSAGE%' => $message,
									  ));
		}

		die ($html);
	}

	/**
	* Функция выводит пользователю страницу ошибки 404
	* 
	* @params void
	* 
	* @return void
	*/
	static function error404()
	{
		// получаем объект Smarty
		global $smarty;
		// оправляем заголовок страницы
		header('HTTP/1.0 404 Not Found');
		// отображаем шаблон страницы ошибки
		$smarty -> display('404.tpl');
		// останавливаем выполнение скрипта
		exit;
	}

	/////////////////////////////////////////////////
	// END OF CLASS messages
	/////////////////////////////////////////////////
}
