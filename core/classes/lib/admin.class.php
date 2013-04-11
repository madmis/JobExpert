<?php
/********************************************************
	powered by Script Developers Group (SD-Group)
	email: info@sd-group.org.ua
	url: http://sd-group.org.ua/
	Copyright 2009 (c) SD-Group
	All rights reserved
=========================================================
	Класс администратора
********************************************************/

(!defined('SDG')) ? die ('Triple protection!') : null;

class admin
{
	/**
	* функция проверки авторизации админа
	* Берет логин и пароль админа из сесси и сверяет их с данными в БД
	* 
	* @return bool
	*/
	static function checkAdminSessionLogin() {
		if (!empty($_SESSION['administrator_login']) && !empty($_SESSION['administrator_password'])) {
			$strQuery = "SELECT SQL_CACHE login FROM " . USR_PREFIX . "admin WHERE login IN (" . secure::escQuoteData($_SESSION['administrator_login']) . ") AND password IN (" . secure::escQuoteData($_SESSION['administrator_password']) . ") LIMIT 0, 1";
			db::dbQuery($strQuery);
			unset($strQuery);

			return db::dbNumRows();
		} else {
			return false;
		}
	}

	/**
	* функция проверки авторизации админа
	* Берет логин и пароль админа из сесси и сверяет их с данными в БД
	* 
	* @param (string) $login - новый логин (может быть false)
	* @param (string) $password - новый пароль (может быть false)
	* 
	* @return bool (сообщение перезагружающее страницу)
	*/
	static function changeAdminPassword($login, $password)
	{
		$link = (isset($_SERVER['QUERY_STRING']) && !empty($_SERVER['QUERY_STRING'])) ? '?' . $_SERVER['QUERY_STRING'] : '';

		if ($login && $password)
		{
			$change = "login='" . md5($login) . "', password='" . md5($password) . "'";
			$arrSession = array('administrator_login' => md5($login), 'administrator_password' => md5($password));
		}
		elseif (!$login && $password)
		{
			$change = "password='" . md5($password) . "'";
			$arrSession = array('administrator_password' => md5($password));
		}
		elseif ($login && !$password)
		{
			$change = "login='" . md5($login) . "'";
			$arrSession = array('administrator_login' => md5($login));
		}
		else
		{
			$change = false;
		}
		
		$strQuery = "UPDATE " . USR_PREFIX . "admin SET " . $change . " WHERE login IN (" . secure::escQuoteData($_SESSION['administrator_login']) . ") AND password IN (" . secure::escQuoteData($_SESSION['administrator_password']) . ")";
		if (!empty($change) && db::dbQuery($strQuery))
		{
			// обновляем пароль в сессии
			tools::updateSessionData($_SESSION, $arrSession);
			messages::messageChangeSaved(MESSAGE_DATA_HAS_BEEN_CHANGED, false, CONF_ADMIN_FILE . $link);
		}
		else
		{
			messages::messageChangeSaved(MESSAGE_DATA_HAS_NOT_BEEN_CHANGED, false, CONF_ADMIN_FILE . $link);
		}
	}

	static function getMenuAdminPanel()
	{
		if (file_exists('core/xml/adm.menu.xml') && is_object($xml = simplexml_load_file('core/xml/adm.menu.xml')) && property_exists($xml, 'article'))
		{
			$menuAmdin = self::parserXmlMenu($xml);

			return $menuAmdin;
		}
		else
		{
		    die ('Failed to open or parse file: core/xml/adm.menu.xml');
		}
	}

	private static function parserXmlMenu(&$xml)
	{
		$arrMenu = array();
		foreach ($xml -> article as $article)
		{
			(is_object($article)) ? $article = get_object_vars($article) : null;

			$arrAttr = array();
			if (isset($article['@attributes']) && is_array($article['@attributes']) && !empty($article['@attributes']))
			{
				foreach($article['@attributes'] as $attr => $attrVal)
				{
					$arrAttr[] = $attr . '=' . '"' . $attrVal . '"';
				}
			}

			if (isset($article['child']))
			{
				$arrMenuContent = array();
				if (is_array($article['child']))
				{
					foreach ($article['child'] as $child)
					{
						$arrMenuContent[] = self::getChildXmlMenu($child);
					}
				}
				else
				{
					$arrMenuContent[] = self::getChildXmlMenu($article['child']);
				}
			}

			$arrMenu[] = array(
									'attr'		=> implode(' ', $arrAttr),
									'ico'		=> $article['ico'],
									'name'		=> constant($article['title']),
									'content'	=> $arrMenuContent
							  );
		}

		return $arrMenu;
	}

	private static function getChildXmlMenu(&$child)
	{
		if (is_object($child) && property_exists($child, 'article'))
		{
			$arrSubChildContent = self::parserXmlMenu($child);
			$childContent = array('subMenu' => true) + $arrSubChildContent[0];
		}
		else
		{
			(is_object($child)) ? $child = get_object_vars($child) : null;

			$childContent = array(
									'subMenu'	=> false,
									'ico'		=> $child['ico'],
									'name'		=> constant($child['title']),
									'link'		=> htmlspecialchars(CONF_ADMIN_FILE . $child['link'])
								 );
		}

		return $childContent;
	}
}
