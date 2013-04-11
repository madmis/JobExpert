<?php
/********************************************************
	JobExpert v1.0
	powered by Script Developers Group (SD-Group)
	email: info@sd-group.org.ua
	url: http://sd-group.org.ua/
	Copyright 2010-2015 (c) SD-Group
	All rights reserved
=========================================================
	Авторизация пользователей
********************************************************/
/**
* @package
* @todo
*/

(!defined('SDG')) ? die ('Triple protection!') : null;

// признак вывода капчи
$secure = false;

// проверяем, включена ли регистрация
if (CONF_USER_REGISTER)
{
    // если пользователь уже вошел на сайт, не пускаем его в форму авторизации
	if ($user -> getAuthorized())
	{
		messages::error404();
	}
	else // иначе, проверяем авторизацию
	{
        $return_data = array('email' => false);

		// сохраняем в сесиию рефер-ссылку
		(!isset($_SESSION['referer']) && secure::checkServerCalls() && isset($_GET['do']) && !strpos($_SERVER['HTTP_REFERER'], $_GET['do'])) ? $_SESSION['referer'] = $_SERVER['HTTP_REFERER'] : null;

		if (!empty($_POST['email']) && !empty($_POST['password']))
		{
			if (validate::postDataNotEmpty()) // проверяем, все ли поля заполнены
			{
	            // проверяем капчу
				if (isset($_POST['keystring']))
				{
					$securimage = new securimage();
					(!$securimage -> check($_POST['keystring'])) ? $arrErrors[] = ERROR_CAPTCHA : null;
				}

				$_POST['remember'] = isset($_POST['remember']) ? true : false;

				if ($user -> issetUser("email IN (" . secure::escQuoteData($_POST['email']) . ") AND password IN ('" . md5($_POST['password']) . "') AND token IN ('active', 'new')"))
				{
					if ($user -> authorizeUser($_POST['email'], $_POST['password'], $_POST['remember']))
					{
						unset ($_SESSION['user_fail_auth']);

						if (isset($_SESSION['referer']) && !strstr($_SESSION['referer'], 'do=payments'))
						{
							$referer = $_SESSION['referer'];
							unset ($_SESSION['referer']);
							die ('<script type="text/javascript">window.location="' . $referer . '";</script>');
						}
						else
						{
							die ('<script type="text/javascript">window.location="' . chpu::createChpuUrl(CONF_SCRIPT_URL . 'index.php?do=user.data') . '";</script>');
						}
					}
					else
					{
						$arrErrors[] = ERROR_AUTHORIZE_ACCOUNT_NOT_ACTIVATE;
					}
				}
				else
				{
					$arrErrors[] = ERROR_DATA;
				}
			}
			else // если есть незаполненные поля, возвращаем ошибку
			{
				$arrErrors[] = ERROR_EMPTY_FIELDS;
			}

			// Если есть ошибки, сохраняем в сессии количество входов, для вывода капчи.
			($arrErrors) ? ((isset($_SESSION['user_fail_auth'])) ? $_SESSION['user_fail_auth']++ : $_SESSION['user_fail_auth'] = 1) : null;

       		$return_data['email'] = $_POST['email'];
		}

		// проверяем, нужно ли выводить капчу
		(SECURE_CAPTCHA && isset($_SESSION['user_fail_auth']) && $_SESSION['user_fail_auth'] >= 3) ? $secure = true : null;

        $smarty -> assignByRef('return_data', $return_data);
		$smarty -> assignByRef('secure', $secure);
		$smarty -> assignByRef('errors', $arrErrors); // передаем ошибки в шаблон
	}
}
else
{
	messages::error404();
}
