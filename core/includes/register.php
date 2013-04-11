<?php
/********************************************************
	JobExpert v1.0
	powered by Script Developers Group (SD-Group)
	email: info@sd-group.org.ua
	url: http://sd-group.org.ua/
	Copyright 2010-2015 (c) SD-Group
	All rights reserved
=========================================================
	Регистрация
********************************************************/
/**
 * @package
 * @todo
 */

(!defined('SDG')) ? die ('Triple protection!') : null;

if (CONF_USER_REGISTER) // проверяем, включена ли регистрация
{
	if ($user -> getAuthorized()) // если пользователь уже вошел на сайт, не пускаем его в форму регистрации
	{
		messages::error404();
	}
	else // иначе, проверяем регистрацию
	{
		$smarty -> assign('path', file_get_contents(filesys::setPath(CONF_ROOT_DIR) . 'lang/' . CONF_LANGUAGE . '/texts/agreement.html'));

		if (isset($_POST['arrBindFields']['email']))
		{
			///////////////////////////////////////////////////////////////
			// Проверка данных, полученных из формы 
			///////////////////////////////////////////////////////////////
			// проверяем, есть ли незаполненные поля
			if (validate::postDataNotEmpty())
			{
				// если активация отключена, проверяем email пользователя
				if (!CONF_USER_ACTIVATE)
				{
					(!validate::validateEmail($_POST['arrBindFields']['email'])) ? $arrErrors[] = ERROR_EMAIL : null;
				}

				// пользовательское соглашение	
				(!isset($_POST['agreement'])) ? $arrErrors[] = ERROR_USER_AGREEMENT : null;

				// проверяем существование Email в БД
				if (!$arrErrors)
				{
					// если такой пользователь уже есть, выдаем ошибку
					if ($user -> issetUser("email IN (" . secure::escQuoteData($_POST['arrBindFields']['email']) . ") AND token IN ('active','moderate','new')"))
					{
						$arrErrors[] = ERROR_EMAIL_EXISTS;
					}
					else // иначе, продолжаем проверку
					{
						// проверяем длину пароля пользователя
						(strlen($_POST['arrBindFields']['password']) < CONF_REGISTER_USER_PASSWORD) ? $arrErrors[] = ERROR_PASSWORD_SHORT : null;

						// проверяем подтверждение пароля
						($_POST['arrBindFields']['password'] !== $_POST['confirm_password']) ? $arrErrors[] = ERROR_PASSWORD_NOT_CONFIRM_PASSWORD : null;

						// если включена защита от спам-ботов, проверяем код
						if (SECURE_CAPTCHA)
						{
							$securimage = new securimage();

							(!$securimage -> check($_POST['keystring'])) ? $arrErrors[] = ERROR_CAPTCHA : null;
						}
					}
				}
			}
			else
			{
				$arrErrors[] = ERROR_EMPTY_FIELDS;
			}
			///////////////////////////////////////////////////////////////
			///////////////////////////////////////////////////////////////

			if (!$arrErrors) // если нет ошибок
			{
				$user -> arrBindFields = $_POST['arrBindFields'];

				(!$user -> recUser()) ? $arrErrors[] = db::$message_error : null;
			}

            $smarty -> assign('return_data', array('email' => $_POST['arrBindFields']['email']));
			$smarty -> assignByRef('errors', $arrErrors);
		}
	}
}
else
{
	messages::error404();
}


