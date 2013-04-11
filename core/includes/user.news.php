<?php
/********************************************************
	JobExpert v1.0
	powered by Script Developers Group (SD-Group)
	email: info@sd-group.org.ua
	url: http://sd-group.org.ua/
	Copyright 2010-2015 (c) SD-Group
	All rights reserved
=========================================================
	Пользовательские новости
********************************************************/
/**
* @package
* @todo
*/

(!defined('SDG')) ? die ('Triple protection!') : null;
// проверяем, включена ли регистрация
if (CONF_USER_REGISTER)
{
	if ($user -> getAuthorized()) // проверяем, вошел ли пользователь
	{
		// объединяем данные пользователя
		$arrUser = array_merge($_SESSION['sd_user']['data'], $_SESSION['sd_user'][DB_PREFIX . 'conf']);
 		// проверяем права
 		if (!empty($_SESSION['sd_' . DB_PREFIX . 'codex']['rights']['add_news']))
 		{
			/**
			* иницализация массива подключаемых шаблонов: по умолчанию все значения - false
			* для подключения шаблона, необходимо установить значение - true
			* шаблоны подключаются в порядке установленном в файле головного шаблона
			*/
			$arrActions = array(
						'add'			=> false,
						'edit'			=> false,
						'moderate'		=> false,
						'correction'	=> false,
						'archived'		=> false,
						'active'		=> false
					);

			// определяем шаблон для отображения
			(isset($_GET['action']) && isset($arrActions[$_GET['action']])) ? $arrActions[$_GET['action']] = true : null;

			// инициируем "Наименование страницы" отображаемое в заголовке формы
			$arrNamePage = array(array('name' => constant('MENU_MY_NEWS'), 'link' => false));

			$retFields = false;

			/******** ДЕЙСТВИЯ ********/
			/** Добавление **/
			if ($arrActions['add'])
			{
				// инициируем "Наименование страницы" отображаемое в заголовке формы
				$arrNamePage[] = array('name' => constant('FORM_NEWS_ADD'), 'link' => false);
				
				/** Проверяем псевдоним пользователя **/
				if (!empty($arrUser['alias']))
				{
					/** Добавляем новость **/
					if (isset($_POST['save']))
					{
						/** Проверяем на непустые поля **/
						if (!empty($_POST['arrBindFields']) && !empty($_POST['date']) && !empty($_POST['time']))
						{
							$arrData = $_POST['arrBindFields'] + $_POST['date'] + $_POST['time'];

							if (validate::arrDataNotEmpty($arrData))
							{
								$arrBindFields = $_POST['arrBindFields'];
								$arrBindFields['datetime'] = $_POST['date']['Date_Year'] . '-' . $_POST['date']['Date_Month'] . '-' . $_POST['date']['Date_Day'] . ' ' . $_POST['time']['Time_Hour'] . ':' . $_POST['time']['Time_Minute'];
							}
							else
							{
								$arrErrors[] = ERROR_EMPTY_BIND_FIELDS;
							}
						}
						else
						{
							$arrErrors[] = ERROR_EMPTY_BIND_FIELDS;
						}

						/** Если нет ошибок, формируем данные для новости **/
						if (!$arrErrors)
						{
							$news -> arrBindFields = $arrBindFields;
							$news -> arrBindFields['author'] = $arrUser['alias'];
							$news -> arrBindFields['token'] = !empty($_SESSION['sd_' . DB_PREFIX . 'codex']['resp']['moder_news']) ? 'moderate' : 'active';
							$news -> arrNoBindFields = $_POST['arrNoBindFields'];
							$news -> arrNoBindFields['id_user'] = $arrUser['id'];
							$news -> arrNoBindFields['noComments'] = (!empty($_POST['arrNoBindFields']['noComments'])) ? 1 : 0;

							/** Добавляем новость **/
							if (!$news -> recNews())
							{
								$arrErrors[] = db::$message_error;
							}
							else
							{
								// Если новость активная
								if ('active' == $news -> arrBindFields['token'])
								{
									$news -> sendAdminAddNews();
									messages::messageChangeSaved(MESSAGE_CHANGE_SAVED, false, chpu::createChpuUrl(CONF_SCRIPT_URL . 'index.php?ut=' . $_SESSION['sd_user'][DB_PREFIX . 'conf']['user_type'] . '&amp;do=user.news&amp;action=' . $news -> arrBindFields['token']));
								}
								// Если новость на модерацию
								else
								{
									$news -> sendAdminModerateNews();
									messages::messageChangeSaved(MESSAGE_MODERATE_ARTICLE, MESSAGE_MODERATE_ARTICLE_TEXT, chpu::createChpuUrl(CONF_SCRIPT_URL . 'index.php?ut=' . $_SESSION['sd_user'][DB_PREFIX . 'conf']['user_type'] . '&amp;do=user.news&amp;action=' . $news -> arrBindFields['token']), 5000);
								}
							}
						}
						
						/** Возвращаемые в форму данные **/
						$retFields = $_POST;
						// если не пустые дата и время, возвращаем в форму необходимые значения
						if (!empty($_POST['arrBindFields']) && !empty($_POST['date']) && !empty($_POST['time']))
						{
							$retFields['arrBindFields']['date'] = mktime(0, 0, 0, $_POST['date']['Date_Month'], $_POST['date']['Date_Day'], $_POST['date']['Date_Year']);
							$retFields['arrBindFields']['time'] = mktime($_POST['time']['Time_Hour'], $_POST['time']['Time_Minute'], 0, 0, 0, 0);
						}

					}
				}
				else
				{
					$arrErrors[] = ERROR_TO_PERFORM_ACTION_SPECIFY_ALIAS;
				}
			}
			/** Редактирование **/
			elseif ($arrActions['edit'])
			{
				// инициируем "Наименование страницы" отображаемое в заголовке формы
				$arrNamePage[] = array('name' => constant('FORM_NEWS_EDIT'), 'link' => false);

				/** Проверяем id новости **/
				if (!empty($_GET['id']) && ($id = validate::checkNaturalNumber($_GET['id'])))
				{
					/** Проверяем псевдоним пользователя **/
					if (!empty($arrUser['alias']))
					{
						// получаем данные статьи
						$strWhere = "id=" . secure::escQuoteData($id) . " AND id_user=" . secure::escQuoteData($arrUser['id']) . " AND token IN ('active','archived','correction')";
						if ($arrNews = $news -> getNews($strWhere))
						{
							/** Проверяем токен записи и права пользователя **/
							if ('correction' == $arrNews['token'] || !empty($_SESSION['sd_' . DB_PREFIX . 'codex']['rights']['edit_news']))
							{
								/** Сохраняем статью **/
								if (isset($_POST['save']))
								{
									/** Проверяем на непустые поля **/
									if (!empty($_POST['arrBindFields']) && !empty($_POST['date']) && !empty($_POST['time']))
									{
										$arrData = $_POST['arrBindFields'] + $_POST['date'] + $_POST['time'];

										if (validate::arrDataNotEmpty($arrData))
										{
											$arrBindFields = $_POST['arrBindFields'];
											$arrBindFields['datetime'] = $_POST['date']['Date_Year'] . '-' . $_POST['date']['Date_Month'] . '-' . $_POST['date']['Date_Day'] . ' ' . $_POST['time']['Time_Hour'] . ':' . $_POST['time']['Time_Minute'];
										}
										else
										{
											$arrErrors[] = ERROR_EMPTY_BIND_FIELDS;
										}
									}
									else
									{
										$arrErrors[] = ERROR_EMPTY_BIND_FIELDS;
									}

									/** Если нет ошибок, формируем данные для новости **/
									if (!$arrErrors)
									{
										$arrData = $arrBindFields + $_POST['arrNoBindFields'];
										$arrData['id'] = $arrNews['id'];
										$arrData['author'] = $arrUser['alias'];
										$arrData['token'] = ('correction' !== $arrNews['token']) ? $arrNews['token'] : 'moderate';
										$arrData['noComments'] = (!empty($_POST['arrNoBindFields']['noComments'])) ? 1 : 0;

										/** Обновляем данные статьи **/
										if (!$news -> updateNews($arrData, array($arrNews['id'])))
										{
											$arrErrors[] = db::$message_error;
										}
										else
										{
											// Если новость на модерацию
											if ($arrData['token'] == 'moderate')
											{
												$news -> sendAdminCorrectionNews($arrData);
												messages::messageChangeSaved(MESSAGE_MODERATE_ARTICLE, MESSAGE_MODERATE_ARTICLE_TEXT, chpu::createChpuUrl(CONF_SCRIPT_URL . 'index.php?ut=' . $_SESSION['sd_user'][DB_PREFIX . 'conf']['user_type'] . '&amp;do=user.news&amp;action=' . $arrData['token']), 5000);
											}
											// Иначе, просто сообщение
											else
											{
												messages::messageChangeSaved(MESSAGE_CHANGE_SAVED, false, chpu::createChpuUrl(CONF_SCRIPT_URL . 'index.php?ut=' . $_SESSION['sd_user'][DB_PREFIX . 'conf']['user_type'] . '&amp;do=user.news&amp;action=' . $arrData['token']));
											}
										}
									}

									/** Возвращаемые в форму данные **/
									$retFields = $_POST;
									// если не пустые дата и время, возвращаем в форму необходимые значения
									if (!empty($_POST['arrBindFields']) && !empty($_POST['date']) && !empty($_POST['time']))
									{
										$retFields['arrBindFields']['date'] = mktime(0, 0, 0, $_POST['date']['Date_Month'], $_POST['date']['Date_Day'], $_POST['date']['Date_Year']);
										$retFields['arrBindFields']['time'] = mktime($_POST['time']['Time_Hour'], $_POST['time']['Time_Minute'], 0, 0, 0, 0);
									}
								}

								// передаем в Smarty параметры новости
								$smarty -> assignByRef('arrNews', $arrNews);
							}
							else
							{
								$arrErrors[] = ERROR_NOT_ENOUGH_RIGHTS;
							}
						}
						else
						{
							$arrErrors[] = ERROR_SELECTED_NEWS;
						}
					}
					else
					{
						$arrErrors[] = ERROR_TO_PERFORM_ACTION_SPECIFY_ALIAS;
					}
				}
				else
				{
					$arrErrors[] = ERROR_SELECTED_NEWS;
				}
			}
			/** На модерации **/
			elseif ($arrActions['moderate'])
			{
				// инициируем "Наименование страницы" отображаемое в заголовке формы
				$arrNamePage[] = array('name' => constant('MENU_ACTION_MODERATE'), 'link' => false);

				$strWhere = "id_user=" . secure::escQuoteData($arrUser['id']) . " AND token IN ('moderate')";
				$arrNewses = $news -> getNewses($strWhere, false, false, array('id', 'title', 'datetime'));
				$smarty -> assignByRef('arrNewses', $arrNewses);
			}
			/** На исправлении **/
			elseif ($arrActions['correction'])
			{
				/** ДЕЙСТВИЯ **/
				if (!empty($_POST['action']))
				{
					 // удаление
					if ('delete' === $_POST['action'] && !empty($_SESSION['sd_' . DB_PREFIX . 'codex']['rights']['del_news']) && !empty($_POST['news']))
					{
   						$strWhere = "id_user=" . secure::escQuoteData($arrUser['id']);
   						(!$news -> deleteNews(array_keys($_POST['news']), $strWhere)) ? $arrErrors[] = db::$message_error : messages::messageChangeSaved(MESSAGE_CHANGE_SAVED, false, chpu::createChpuUrl(CONF_SCRIPT_URL . 'index.php?ut=' . $_SESSION['sd_user'][DB_PREFIX . 'conf']['user_type'] . '&amp;do=user.news&amp;action=correction'));
					}
				}

				// инициируем "Наименование страницы" отображаемое в заголовке формы
				$arrNamePage[] = array('name' => constant('MENU_ACTION_CORRECTION'), 'link' => false);

				$strWhere = "id_user=" . secure::escQuoteData($arrUser['id']) . " AND token IN ('correction')";
				$arrNewses = $news -> getNewses($strWhere, false, false, false);
				$smarty -> assignByRef('arrNewses', $arrNewses);
			}
			/** Архив **/
			elseif ($arrActions['archived'] && !empty($_SESSION['sd_' . DB_PREFIX . 'codex']['rights']['arc_news']))
			{
				/** ДЕЙСТВИЯ **/
				if (!empty($_POST['action']))
				{
					 // удаление
					if ('delete' === $_POST['action'] && !empty($_SESSION['sd_' . DB_PREFIX . 'codex']['rights']['del_news']) && !empty($_POST['news']))
					{
   						$strWhere = "id_user=" . secure::escQuoteData($arrUser['id']);
   						(!$news -> deleteNews(array_keys($_POST['news']), $strWhere)) ? $arrErrors[] = db::$message_error : messages::messageChangeSaved(MESSAGE_CHANGE_SAVED, false, chpu::createChpuUrl(CONF_SCRIPT_URL . 'index.php?ut=' . $_SESSION['sd_user'][DB_PREFIX . 'conf']['user_type'] . '&amp;do=user.news&amp;action=archived'));
					}
					 // Извлечение из архива
					if ('extract' === $_POST['action'] && !empty($_SESSION['sd_' . DB_PREFIX . 'codex']['rights']['arc_news']) && !empty($_POST['news']))
					{
   						$arrData = array('token' => 'active');
   						$strWhere = "id_user=" . secure::escQuoteData($arrUser['id']);

   						(!$news -> updateNews($arrData, array_keys($_POST['news']), $strWhere)) ? $arrErrors[] = db::$message_error : messages::messageChangeSaved(MESSAGE_CHANGE_SAVED, false, chpu::createChpuUrl(CONF_SCRIPT_URL . 'index.php?ut=' . $_SESSION['sd_user'][DB_PREFIX . 'conf']['user_type'] . '&amp;do=user.news&amp;action=archived'));
					}
				}

				// инициируем "Наименование страницы" отображаемое в заголовке формы
				$arrNamePage[] = array('name' => constant('MENU_ACTION_ARCHIVED'), 'link' => false);

				$strWhere = "id_user=" . secure::escQuoteData($arrUser['id']) . " AND token IN ('archived')";
				$arrNewses = $news -> getNewses($strWhere, false, false, false);
				$smarty -> assignByRef('arrNewses', $arrNewses);

			}
			/** Активные **/
			elseif ($arrActions['active'])
			{
				/** ДЕЙСТВИЯ **/
				if (!empty($_POST['action']))
				{
					 // удаление
					if ('delete' === $_POST['action'] && !empty($_SESSION['sd_' . DB_PREFIX . 'codex']['rights']['del_news']) && !empty($_POST['news']))
					{
   						$strWhere = "id_user=" . secure::escQuoteData($arrUser['id']);
   						(!$news -> deleteNews(array_keys($_POST['news']), $strWhere)) ? $arrErrors[] = db::$message_error : messages::messageChangeSaved(MESSAGE_CHANGE_SAVED, false, chpu::createChpuUrl(CONF_SCRIPT_URL . 'index.php?ut=' . $_SESSION['sd_user'][DB_PREFIX . 'conf']['user_type'] . '&amp;do=user.news&amp;action=active'));
					}
					 // архивация
					if ('archive' === $_POST['action'] && !empty($_SESSION['sd_' . DB_PREFIX . 'codex']['rights']['arc_news']) && !empty($_POST['news']))
					{
   						$arrData = array('token' => 'archived');
   						$strWhere = "id_user=" . secure::escQuoteData($arrUser['id']);

   						(!$news -> updateNews($arrData, array_keys($_POST['news']), $strWhere)) ? $arrErrors[] = db::$message_error : messages::messageChangeSaved(MESSAGE_CHANGE_SAVED, false, chpu::createChpuUrl(CONF_SCRIPT_URL . 'index.php?ut=' . $_SESSION['sd_user'][DB_PREFIX . 'conf']['user_type'] . '&amp;do=user.news&amp;action=active'));
					}
				}

				// инициируем "Наименование страницы" отображаемое в заголовке формы
				$arrNamePage[] = array('name' => constant('MENU_ACTION_ACTIVE'), 'link' => false);

				$strWhere = "id_user=" . secure::escQuoteData($arrUser['id']) . " AND token IN ('active')";
				if ($arrNewses = $news -> getNewses($strWhere, false, false, false))
				{
					// если есть новости, устанавливаем признак публикации
					foreach ($arrNewses as $key => &$value)
					{
						$value['link'] = (strtotime($value['datetime']) > time()) ? false : true;
						$arrNewses[$key] = $value;
					}

				}

				$smarty -> assignByRef('arrNewses', $arrNewses);
			}
			else
			{
				messages::error404();
			}

			$smarty -> assignByRef('retFields', $retFields);
			$smarty -> assignByRef('arrUser', $arrUser);
			$smarty -> assignByRef('errors', $arrErrors);
			$smarty -> assignByRef('warnings', $arrWarnings);
			$smarty -> assignByRef('arrActions', $arrActions);
		}
		else
		{
			messages::error404();
		}

	}
	else // иначе направляем на страницу авторизации
	{
		die ('<script type="text/javascript">window.location="' . chpu::createChpuUrl(CONF_SCRIPT_URL . 'index.php?do=authorize') . '";</script>');
	}

}
else
{
	messages::error404();
}
