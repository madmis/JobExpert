<?php
/********************************************************
	JobExpert v1.0
	powered by Script Developers Group (SD-Group)
	email: info@sd-group.org.ua
	url: http://sd-group.org.ua/
	Copyright 2010-2015 (c) SD-Group
	All rights reserved
=========================================================
	Выбор типа учетной записи
********************************************************/
/**
* @package
* @todo
*/

(!defined('SDG')) ? die ('Triple protection!') : null;

if (CONF_USER_REGISTER) // проверяем, включена ли регистрация
{
	if ($user -> getAuthorized())
	{
		if ('new' === $_SESSION['sd_user'][DB_PREFIX . 'conf']['token']) // даем изменять тип, только если токен пользователя new
		{
			$smarty -> assign('arrTypes', $group -> arrTypes); // передаем типы, которые может выбрать пользователь

			if (isset($_POST) && $_POST) // если данные переданы
			{
				if (isset($_POST['type'])) // если передан тип
				{
					if (validate::postDataNotEmpty()) // проверяем, есть ли незаполненные поля
					{
						// проверяем существование выбранной группы в массиве
						if (!ctype_alpha($_POST['type']) || !in_array($_POST['type'], $group -> arrTypes))
						{
							$arrErrors[] = ERROR_SELECTED_GROUP;
						}

						if (!$arrErrors)
						{
							// если данные успешно измененые
							if ($state = $user -> selectUserType(array('first_name' => $_POST['first_name'], 'last_name' => $_POST['last_name'], 'phone' => $_POST['phone'], 'user_type' => $_POST['type']), $arrPayments))
							{
								// проверяем состояние учетной записи, и выполняем соответствующее действие
								switch($state)
								{
									case 'moderate':
										$user_type = ('employer' === $_SESSION['sd_user'][DB_PREFIX . 'conf']['user_type']) ? 'employer' : 'competitor';
										// очищаем куки и сессию пользователя
										$user -> clearUserSessionAndCookie();
										messages::messageChangeSaved(MESSAGE_ACCOUNT_MODERATE, MESSAGE_ACCOUNT_MODERATE_TEXT, chpu::createChpuUrl(CONF_SCRIPT_URL . 'index.php?ut=' . $user_type), 10000);
										break;

									case 'active':
										messages::messageChangeSaved(MESSAGE_REGISTER_SUCCESS, false, chpu::createChpuUrl(CONF_SCRIPT_URL . 'index.php?ut=' . $_SESSION['sd_user'][DB_PREFIX . 'conf']['user_type'] . '&amp;do=user.data'));
										break;

									case 'payment':
										$user_type = ('employer' === $_SESSION['sd_user'][DB_PREFIX . 'conf']['user_type']) ? 'employer' : 'competitor';
										$_SESSION['payment'] = array('service' => 'register_' . strtolower($_POST['type']), 'id' => $_SESSION['sd_user']['data']['id'], 'user_type' => $_POST['type']);
										// очищаем куки и сессию пользователя
										$user -> clearUserSessionAndCookie();
										messages::messageChangeSaved(MESSAGE_REGISTER_SUCCESS_DO_PAYMENT, MESSAGE_REGISTER_SUCCESS_DO_PAYMENT_TEXT, chpu::createChpuUrl(CONF_SCRIPT_URL . 'index.php?ut=' . $user_type . '&amp;do=payments'), 10000);
										break;
								}
							}
							else
							{
								$arrErrors[] = ERROR_NOT_CHANGE_DATA;
							}
						}
					}
					else
					{
						$arrErrors[] = ERROR_EMPTY_FIELDS;
						$smarty -> assign('return_data', array(
																'type'			=> $_POST['type'],
																'first_name'	=> $_POST['first_name'],
																'last_name'		=> $_POST['last_name'],
																'phone'			=> $_POST['phone']
															));
					}
				}
				else
				{
					$arrErrors[] = ERROR_NOT_SELECT_GROUP;
       				$smarty -> assign('return_data', array(
															'type'			=> '',
															'first_name'	=> $_POST['first_name'],
															'last_name'		=> $_POST['last_name'],
															'phone'			=> $_POST['phone']
														));
				}

            	$smarty -> assignByRef('errors', $arrErrors);
			}
		}
		else // если группа пользователя не user, выдаем ошибку
		{
			messages::error404();
		}
	}
	else // если пользователь не вошел на сайт, не пускаем его в форму выбора типа
	{
		messages::error404();
	}
}
else
{
	messages::error404();
}


