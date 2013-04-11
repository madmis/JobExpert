<?php
/********************************************************
	JobExpert v1.0
	powered by Script Developers Group (SD-Group)
	email: info@sd-group.org.ua
	url: http://sd-group.org.ua/
	Copyright 2010-2015 (c) SD-Group
	All rights reserved
=========================================================
	Смена пароля пользователя
********************************************************/
/**
* @package
* @todo
*/

(!defined('SDG')) ? die ('Triple protection!') : null;

$smarty -> assign('success', false); // сообщение об успешности

// проверяем, включена ли регистрация
if (CONF_USER_REGISTER)
{
	// проверяем, вошел ли пользователь
	if ($user -> getAuthorized())
	{
		if (isset($_POST['password']))
		{
			// проверяем, есть ли незаполненные поля
			if (validate::postDataNotEmpty())
			{
				$password = md5($_POST['password']);
				$new_password = md5($_POST['new_password']);

				if (md5($_POST['password']) !== $_SESSION['sd_user']['data']['password'])
				{
					$arrErrors[] = ERROR_PASSWORD;
				}

				if (strlen($_POST['new_password']) < CONF_REGISTER_USER_PASSWORD)
				{
					$arrErrors[] = ERROR_PASSWORD_SHORT;
				}

				if (md5($_POST['password']) === md5($_POST['new_password']))
				{
					$arrErrors[] = ERROR_PASSWORD_NOT_NEW_PASSWORD;
				}

				if ($_POST['new_password'] !== $_POST['confirm_password'])
				{
					$arrErrors[] = ERROR_PASSWORD_NOT_CONFIRM_PASSWORD;
				}
			}
			else
			{
				$arrErrors[] = ERROR_EMPTY_FIELDS;
			}

			if (!$arrErrors)
			{
				$user -> updateUser(array('password' => md5($_POST['new_password'])), "id IN (" . secure::escQuoteData($_SESSION['sd_user']['data']['id']) . ")");

				// обновляем пароль в сессии
				tools::updateSessionData($_SESSION['sd_user']['data'], array('password' => md5($_POST['new_password'])));

               	messages::messageChangeSaved(MESSAGE_PASSWORD_HAS_BEEEN_CHANGED, false, chpu::createChpuUrl(CONF_SCRIPT_URL . 'index.php?ut=' . $_SESSION['sd_user'][DB_PREFIX . 'conf']['user_type'] . '&amp;do=user.data'));
			}
			else
			{
				$smarty -> assignByRef('errors', $arrErrors);
			}
		}
	}
	else
	{
		messages::error404();
	}
}
else
{
	messages::error404();
}
