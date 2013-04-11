<?php
/********************************************************
	JobExpert v1.0
	powered by Script Developers Group (SD-Group)
	email: info@sd-group.org.ua
	url: http://sd-group.org.ua/
	Copyright 2010-2015 (c) SD-Group
	All rights reserved
=========================================================
	Данные пользователя
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
		$arrUser = array_merge($_SESSION['sd_user']['data'], $_SESSION['sd_user'][DB_PREFIX . 'conf']); // объединяем данные пользователя
 		// проверяем права
 		if (!empty($_SESSION['sd_' . DB_PREFIX . 'codex']['rights']['add_articles']))
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
			$arrNamePage = array(array('name' => constant('MENU_MY_ARTICLES'), 'link' => false));

			$retFields = false;

			// создаем объект
			$articles = new articles();
			$artsections = new artsections();

			// создаем массив секций, с которым мы будем работать
			$arrArtSections = (!$arrArtSections['full'] = $artsections -> getSections()) ? false : $arrArtSections + $artsections -> splitSections($arrArtSections['full']);
			$smarty -> assignByRef('arrArtSections', $arrArtSections);

			/******** ДЕЙСТВИЯ ********/
			/** Добавление **/
			if ($arrActions['add'])
			{
				// инициируем "Наименование страницы" отображаемое в заголовке формы
				$arrNamePage[] = array('name' => constant('FORM_ARTICLES_ADD'), 'link' => false);
				
				/** Проверяем псевдоним пользователя **/
				if (!empty($arrUser['alias']))
				{
					/** Добавляем статью **/
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

						/** Если нет ошибок, формируем данные для статьи **/
						if (!$arrErrors)
						{
							$articles -> arrBindFields = $arrBindFields;
							$articles -> arrBindFields['author'] = $arrUser['alias'];
							$articles -> arrBindFields['token'] = !empty($_SESSION['sd_' . DB_PREFIX . 'codex']['resp']['moder_articles']) ? 'moderate' : 'active';
							$articles -> arrNoBindFields = $_POST['arrNoBindFields'];
							$articles -> arrNoBindFields['id_user'] = $arrUser['id'];
							$articles -> arrNoBindFields['noComments'] = (!empty($_POST['arrNoBindFields']['noComments'])) ? 1 : 0;

							/** Добавляем статью **/
							if (!$articles -> recArticle())
							{
								$arrErrors[] = db::$message_error;
							}
							else
							{
								// Если статья активная
								if ($articles -> arrBindFields['token'] == 'active')
								{
									$articles -> sendAdminAddArticle();
									messages::messageChangeSaved(MESSAGE_CHANGE_SAVED, false, chpu::createChpuUrl(CONF_SCRIPT_URL . 'index.php?ut=' . $_SESSION['sd_user'][DB_PREFIX . 'conf']['user_type'] . '&amp;do=user.articles&amp;action=' . $articles -> arrBindFields['token']));
								}
								// Если статья на модерацию
								else
								{
									$articles -> sendAdminModerateArticle();
									messages::messageChangeSaved(MESSAGE_MODERATE_ARTICLE, MESSAGE_MODERATE_ARTICLE_TEXT, chpu::createChpuUrl(CONF_SCRIPT_URL . 'index.php?ut=' . $_SESSION['sd_user'][DB_PREFIX . 'conf']['user_type'] . '&amp;do=user.articles&amp;action=' . $articles -> arrBindFields['token']), 5000);
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
				$arrNamePage[] = array('name' => constant('FORM_ARTICLES_EDIT'), 'link' => false);

				/** Проверяем id статьи **/
				if (!empty($_GET['id']) && strings::ifInt($_GET['id']))
				{
                    $id = (int) $_GET['id'];

					/** Проверяем псевдоним пользователя **/
					if (!empty($arrUser['alias']))
					{
						// получаем данные статьи
						$strWhere = "id IN (" . secure::escQuoteData($id) . ") AND id_user IN (" . secure::escQuoteData($arrUser['id']) . ") AND token IN ('active','archived','new','correction')";
						if ($arrArticle = $articles -> getArticle($strWhere))
						{
							/** Проверяем токен статьи и права пользователя **/
							if ($arrArticle['token'] == 'correction' || !empty($_SESSION['sd_' . DB_PREFIX . 'codex']['rights']['edit_articles']))
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

									/** Если нет ошибок, формируем данные для статьи **/
									if (!$arrErrors)
									{
										$arrData = $arrBindFields + $_POST['arrNoBindFields'];
										$arrData['author'] = $arrUser['alias'];
										$arrData['token'] = ($arrArticle['token'] !== 'correction') ? $arrArticle['token'] : 'moderate';
										$arrData['noComments'] = (!empty($_POST['arrNoBindFields']['noComments'])) ? 1 : 0;
										$arrData['id'] = $id;

										/** Обновляем данные статьи **/
										if (!$articles -> updateArticle($arrData, $arrArticle['id']))
										{
											$arrErrors[] = db::$message_error;
										}
										else
										{
											// Если статья на модерацию
											if ($arrData['token'] == 'moderate')
											{
												$articles -> sendAdminCorrectionArticle($arrData);
												messages::messageChangeSaved(MESSAGE_MODERATE_ARTICLE, MESSAGE_MODERATE_ARTICLE_TEXT, chpu::createChpuUrl(CONF_SCRIPT_URL . 'index.php?ut=' . $_SESSION['sd_user'][DB_PREFIX . 'conf']['user_type'] . '&amp;do=user.articles&amp;action=' . $arrData['token']), 5000);
											}
											// Иначе, просто сообщение
											else
											{
												messages::messageChangeSaved(MESSAGE_CHANGE_SAVED, false, chpu::createChpuUrl(CONF_SCRIPT_URL . 'index.php?ut=' . $_SESSION['sd_user'][DB_PREFIX . 'conf']['user_type'] . '&amp;do=user.articles&amp;action=' . $arrData['token']));
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

								// передаем в Smarty параметры статьи
								$smarty -> assignByRef('arrArticle', $arrArticle);
							}
							else
							{
								$arrErrors[] = ERROR_NOT_ENOUGH_RIGHTS;
							}
						}
						else
						{
							$arrErrors[] = ERROR_SELECTED_ARTICLE;
						}
					}
					else
					{
						$arrErrors[] = ERROR_TO_PERFORM_ACTION_SPECIFY_ALIAS;
					}
				}
				else
				{
					$arrErrors[] = ERROR_SELECTED_ARTICLE;
				}
			}
			/** На модерации **/
			elseif ($arrActions['moderate'])
			{
				// инициируем "Наименование страницы" отображаемое в заголовке формы
				$arrNamePage[] = array('name' => constant('MENU_ACTION_MODERATE'), 'link' => false);

				$strWhere = "id_user IN (" . secure::escQuoteData($arrUser['id']) . ") AND token IN ('moderate')";
				$arrArticles = $articles -> getArticles($strWhere, false, false, array('id', 'title', 'datetime', 'id_section'));
				$smarty -> assignByRef('arrArticles', $arrArticles);
			}
			/** На исправлении **/
			elseif ($arrActions['correction'])
			{
				/** ДЕЙСТВИЯ **/
				if (!empty($_POST['action']))
				{
					 // удаление
					if ('delete' === $_POST['action'] && !empty($_SESSION['sd_' . DB_PREFIX . 'codex']['rights']['del_articles']) && !empty($_POST['articles']))
					{
   						$strWhere = "id_user IN (" . secure::escQuoteData($arrUser['id']) . ")";
   						(!$articles -> deleteArticles(array_keys($_POST['articles']), $strWhere)) ? $arrErrors[] = db::$message_error : messages::messageChangeSaved(MESSAGE_CHANGE_SAVED, false, chpu::createChpuUrl(CONF_SCRIPT_URL . 'index.php?ut=' . $_SESSION['sd_user'][DB_PREFIX . 'conf']['user_type'] . '&amp;do=user.articles&amp;action=archived'));
					}
				}

				// инициируем "Наименование страницы" отображаемое в заголовке формы
				$arrNamePage[] = array('name' => constant('MENU_ACTION_CORRECTION'), 'link' => false);

				$strWhere = "id_user IN (" . secure::escQuoteData($arrUser['id']) . ") AND token IN ('correction')";
				$arrArticles = $articles -> getArticles($strWhere, false, false, false);
				$smarty -> assignByRef('arrArticles', $arrArticles);
			}
			/** Архив **/
			elseif ($arrActions['archived'] && !empty($_SESSION['sd_' . DB_PREFIX . 'codex']['rights']['arc_articles']))
			{
				/** ДЕЙСТВИЯ **/
				if (!empty($_POST['action']))
				{
					 // удаление
					if ('delete' === $_POST['action'] && !empty($_SESSION['sd_' . DB_PREFIX . 'codex']['rights']['del_articles']) && !empty($_POST['articles']))
					{
   						$strWhere = "id_user IN (" . secure::escQuoteData($arrUser['id']) . ")";
   						(!$articles -> deleteArticles(array_keys($_POST['articles']), $strWhere)) ? $arrErrors[] = db::$message_error : messages::messageChangeSaved(MESSAGE_CHANGE_SAVED, false, chpu::createChpuUrl(CONF_SCRIPT_URL . 'index.php?ut=' . $_SESSION['sd_user'][DB_PREFIX . 'conf']['user_type'] . '&amp;do=user.articles&amp;action=archived'));
					}
					 // Извлечение из архива
					if ('extract' === $_POST['action'] && !empty($_SESSION['sd_' . DB_PREFIX . 'codex']['rights']['arc_articles']) && !empty($_POST['articles']))
					{
   						$arrData = array('token' => 'active');
   						$strWhere = "id_user IN (" . secure::escQuoteData($arrUser['id']) . ")";
   						(!$articles -> updateArticles($arrData, array_keys($_POST['articles']), $strWhere)) ? $arrErrors[] = db::$message_error : messages::messageChangeSaved(MESSAGE_CHANGE_SAVED, false, chpu::createChpuUrl(CONF_SCRIPT_URL . 'index.php?ut=' . $_SESSION['sd_user'][DB_PREFIX . 'conf']['user_type'] . '&amp;do=user.articles&amp;action=archived'));
					}
				}

				// инициируем "Наименование страницы" отображаемое в заголовке формы
				$arrNamePage[] = array('name' => constant('MENU_ACTION_ARCHIVED'), 'link' => false);

				$strWhere = "id_user IN (" . secure::escQuoteData($arrUser['id']) . ") AND token IN ('archived')";
				$arrArticles = $articles -> getArticles($strWhere, false, false, false);
				$smarty -> assignByRef('arrArticles', $arrArticles);
			}
			/** Активные **/
			elseif ($arrActions['active'])
			{
				/** ДЕЙСТВИЯ **/
				if (!empty($_POST['action']))
				{
					 // удаление
					if ('delete' === $_POST['action'] && !empty($_SESSION['sd_' . DB_PREFIX . 'codex']['rights']['del_articles']) && !empty($_POST['articles']))
					{
   						$strWhere = "id_user IN (" . secure::escQuoteData($arrUser['id']) . ")";
   						(!$articles -> deleteArticles(array_keys($_POST['articles']), $strWhere)) ? $arrErrors[] = db::$message_error : messages::messageChangeSaved(MESSAGE_CHANGE_SAVED, false, chpu::createChpuUrl(CONF_SCRIPT_URL . 'index.php?ut=' . $_SESSION['sd_user'][DB_PREFIX . 'conf']['user_type'] . '&amp;do=user.articles&amp;action=active'));
					}
					 // архивация
					if ('archive' === $_POST['action'] && !empty($_SESSION['sd_' . DB_PREFIX . 'codex']['rights']['arc_articles']) && !empty($_POST['articles']))
					{
   						$arrData = array('token' => 'archived');
   						$strWhere = "id_user IN (" . secure::escQuoteData($arrUser['id']) . ")";
   						(!$articles -> updateArticles($arrData, array_keys($_POST['articles']), $strWhere)) ? $arrErrors[] = db::$message_error : messages::messageChangeSaved(MESSAGE_CHANGE_SAVED, false, chpu::createChpuUrl(CONF_SCRIPT_URL . 'index.php?ut=' . $_SESSION['sd_user'][DB_PREFIX . 'conf']['user_type'] . '&amp;do=user.articles&amp;action=active'));
					}
				}

				// инициируем "Наименование страницы" отображаемое в заголовке формы
				$arrNamePage[] = array('name' => constant('MENU_ACTION_ACTIVE'), 'link' => false);

				$strWhere = "id_user IN (" . secure::escQuoteData($arrUser['id']) . ") AND token IN ('active')";

				if ($arrArticles = $articles -> getArticles($strWhere, false, false, false))
				{
					// если есть статьи, устанавливаем признак публикации
					foreach ($arrArticles as $key => &$value)
					{
						$value['link'] = (strtotime($value['datetime']) > time()) ? false : true;
						$arrArticles[$key] = $value;
					}
				}

				$smarty -> assignByRef('arrArticles', $arrArticles);
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
