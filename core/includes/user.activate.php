<?php
/********************************************************
	JobExpert v1.0
	powered by Script Developers Group (SD-Group)
	email: info@sd-group.org.ua
	url: http://sd-group.org.ua/
	Copyright 2010-2015 (c) SD-Group
	All rights reserved
=========================================================
	Активация пользователей
********************************************************/
/**
* @package
* @todo
*/

(!defined('SDG')) ? die ('Triple protection!') : null;

if (CONF_USER_REGISTER) // проверяем, включена ли регистрация
{
	if (!empty($_GET['code']) || !empty($_POST['code'])) // проверяем активационный код
	{
		(!empty($_GET['code'])) ? $code =& $_GET['code'] : $code =& $_POST['code'];

		if (ctype_alnum($code))
		{
			// если ключ есть в базе
			if ($user -> getUserByCode($code))
			{
				if ($user -> activateUser())
				{
					messages::messageChangeSaved(MESSAGE_REGISTER_SUCCESS,  MESSAGE_REGISTER_SUCCESS_TEXT, chpu::createChpuUrl(CONF_SCRIPT_URL . 'index.php?ut=' . $_SESSION['sd_user'][DB_PREFIX . 'conf']['user_type'] . '&amp;do=authorize'), 5000);
				}
				else
				{
					$arrErrors[] = db::$message_error;
				}
			}
			else
			{
				$arrErrors[] = ERROR_ACTIVATE_ACCOUNT;
			}
		}
		else
		{
			$arrErrors[] = ERROR_ACTIVATE_CODE;
		}

		$smarty -> assignByRef('errors', $arrErrors);
	}
}
else
{
	messages::error404();
}
