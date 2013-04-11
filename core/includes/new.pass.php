<?php
/********************************************************
	JobExpert v1.0
	powered by Script Developers Group (SD-Group)
	email: info@sd-group.org.ua
	url: http://sd-group.org.ua/
	Copyright 2010-2015 (c) SD-Group
	All rights reserved
=========================================================
	Генерация нового пароля
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
	// если пользователь уже вошел на сайт, не пускаем его в форму смены пароля
	if ($user -> getAuthorized())
	{
		messages::error404();
	}
	else // даем менять пароль только если пользователь не залогинен 
	{
		if (isset($_POST['email']))
		{
            // проверяем, есть ли незаполненные поля
			if (validate::postDataNotEmpty())
			{
				if (!validate::validateEmail($_POST['email']))
				{
					$arrErrors[] = ERROR_EMAIL;
				}

				// проверяем, есть ли пользователь с таким email в БД
				if (!$arrErrors)
				{
					// если пользователь найден, отправляем ему подтвеждения смены пароля
					if ($userData = $user -> getUser("email IN (" . secure::escQuoteData($_POST['email']) . ")"))
					{
						$mailer = new mailer();
						// массив для замены в шаблоне
						$mailer -> setAddReplace(array('%CONFIRM_LINK%' => $user -> genLinkToChangePassword($userData)));

						if ($mailer -> sendEmail(CONF_MAIL_ADMIN_EMAIL, false, false, $userData['email'], $userData['email'], CONF_SITE_NAME . MAIL_SUBJ_NEW_PASS_CONFIRM, 'new.pass.confirm.txt'))
						{
							messages::messageChangeSaved(MENU_NEW_PASS, MESSAGE_NEW_PASS_CONFIRM, chpu::createChpuUrl(CONF_SCRIPT_URL . 'index.php?ut=' . $_SESSION['sd_user'][DB_PREFIX . 'conf']['user_type']), 10000);
						}
						else
						{
							$arrErrors[] = ERROR_SEND_EMAIL;
						}
					}
					else // иначе выдаем сообщение
					{
						$arrErrors[] = ERROR_EMAIL_NOT_FOUND;
					}
				}
			}
			else
			{
				$arrErrors[] = ERROR_EMPTY_FIELDS;
			}

			$smarty -> assign('return_data', array('email' => $_POST['email']));
		}
		elseif (isset($_GET['i']) && $_GET['i'])
		{
			if ($userData = $user -> checkLinkToChangePassword())
			{
				// генерируем новый пароль
				$password = strings::randomString(CONF_REGISTER_USER_PASSWORD);

				$mailer = new mailer();
				// массив для замены в шаблоне
				$mailer -> setAddReplace(array('%NEW_PASSWORD%' => $password));

				if ($mailer -> sendEmail(CONF_MAIL_ADMIN_EMAIL, false, false, $userData['email'], $userData['email'], CONF_SITE_NAME . MAIL_SUBJ_NEW_PASS, 'new.pass.txt'))
				{
					// если письмо успешно отправлено, обновляем пароль
					if ($user -> updateUser(array('password' => md5($password)), "id IN (" . secure::escQuoteData($userData['id']) . ") AND password IN (" . secure::escQuoteData($userData['password']) . ")"))
					{
						messages::messageChangeSaved(MENU_NEW_PASS, MESSAGE_NEW_PASS_SUCCESS, chpu::createChpuUrl(CONF_SCRIPT_URL . 'index.php?ut=' . $_SESSION['sd_user'][DB_PREFIX . 'conf']['user_type'] . '&amp;do=authorize'), 10000);
					}
					else
					{
						$arrErrors[] = db::$message_error;
					}
				}
				else
				{
					$arrErrors[] = ERROR_SEND_EMAIL;
				}
			}
			else
			{
				messages::error404();
			}
		}
		
		$smarty -> assignByRef('errors', $arrErrors);
	}
}
else
{
	messages::error404();
}
