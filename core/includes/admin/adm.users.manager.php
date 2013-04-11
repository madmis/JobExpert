<?php
/********************************************************
	JobExpert v1.0
	powered by Script Developers Group (SD-Group)
	email: info@sd-group.org.ua
	url: http://sd-group.org.ua/
	Copyright 2010-2015 (c) SD-Group
	All rights reserved
=========================================================
	Менеджер пользователей
********************************************************/
/**
* @package
* @todo
*/

(!defined('SDG')) ? die('Triple protection!') : null;

// инициируем "Наименование страницы" отображаемое в форме
$arrNamePage = array(
		array('name' => MENU_ADMIN_MAIN, 'link' => CONF_ADMIN_FILE),
		array('name' => MENU_MANAGER_USERS, 'link' => false)
	);

/**
* иницализация массива подключаемых шаблонов: по умолчанию все значения - false
* для подключения шаблона, необходимо установить значение - true
* шаблоны подключаются в порядке установленном в файле головного шаблона
*/
$arrActions = array(
		'filter'	=> false,
		'add'		=> false,
		'moderate'	=> false,
		'activate'	=> false,
		'payment'	=> false,
		'config'	=> false,
		'detail'	=> false
	);

// создаем объект
$user = new user();

/**
* СОРТИРОВКА В ТАБЛИЦАХ
*/
// масив сортировки
$arrOrd = array(
		'users.email'			=> 'asc',
		'conf_users.user_type'		=> false,
		'conf_users.user_group'	=> false,
		'users.reg_datetime'	=> false
	);

$order = 'users.email';
$by = 'ASC';
			
/**
* Проверяем сортировку
*/
if (!empty($_GET['order']) && !empty($_GET['by']) && ('ASC' == $_GET['by'] || 'DESC' == $_GET['by'])) {
	foreach ($arrOrd as $key => $value)	{
		if ($_GET['order'] === $key) {
		 	$arrOrd[$key] = $_GET['by'];
		 	$order = $key;
		 	$by = $_GET['by'];
		}
	}
}
					
/**
* Добавление, редактирование, настройки пользователей
*/
if (isset($_GET['action'])) {
	/**
	* Настройки пользователей
	*/
	if ('config' === $_GET['action']) {
		// инициируем "Наименование страницы" отображаемое в форме
		$arrNamePage[] = array('name' => MENU_CONFIG, 'link' => false);

		// сохраняем данные, переданные из формы
		if (isset($_POST['save'])) {
			$data = "<?php\n\n"
				  . "(!defined('SDG')) ? die ('Triple protection!') : null;\n\n"
				  . 'define("CONF_USERS_STRINGS_PERPAGE_ADMIN_PANEL", "' . ((int) $_POST['perpage'] ? (int) abs($_POST['perpage']) : 30) . '");' . "\n\n"
				  . 'define("CONF_USER_NOT_TYPE_DELETE", "' . ((int) $_POST['not_type'] ? (int) abs($_POST['not_type']) : 24) . '");' . "\n\n"
				  . 'define("CONF_USER_PAYMENT_DELETE", "' . ((int) $_POST['payment'] ? (int) abs($_POST['payment']) : 24) . '");' . "\n\n"
				  . 'define("CONF_USER_CHANGE_NAME", "' . ((!isset($_POST['name'])) ? false : true) . '");' . "\n";

			if (!tools::saveConfig('core/conf/const.config.users.php', $data, CONF_ADMIN_FILE . '?m=users&s=manager&action=config')) {
				$arrErrors[] = ERROR_FILES_MISSING_FILE;
			}
		}

		$arrActions['config'] = true;
	}

	/**
	* Детальная информация пользователя
	*/
	elseif ('detail' === $_GET['action']) {

		if ($user -> issetUser("id IN (" . secure::escQuoteData($_GET['id']) . ") AND token IN ('active','archived','moderate','new')")) {
			// удаление пользователя
			if (isset($_POST['delete'])) {
				$delNews = isset($_POST['news']) ? true : false;
				$delArticles = isset($_POST['articles']) ? true : false;
				$user -> deleteUsers(array($_GET['id']), true, true, true, $delArticles, $delNews);
				messages::messageChangeSaved(MESSAGE_CHANGE_SAVED, false, CONF_ADMIN_FILE . '?m=users&s=manager');
			}
			// изменение данных пользователя
			elseif (isset($_POST['saveUserData'])) {

				if (!empty($_POST['conf']['user_type']) && !empty($_POST['conf']['user_group'])
						&& !empty($_POST['user']['first_name']) && !empty($_POST['user']['last_name']) && !empty($_POST['user']['phone'])) {

					$strWhere = "id IN (" . secure::escQuoteData($_GET['id']) . ")";
					// Основные данные пользователя
					$uData = $_POST['user'];
					// Доп. данные пользователя
					$ucData = $_POST['conf'];

					$user -> updateUser($uData, $strWhere);
					$user -> updateConfUser($ucData, $strWhere);
					messages::messageChangeSaved(MESSAGE_CHANGE_SAVED, false, CONF_ADMIN_FILE . '?m=users&s=manager&action=detail&id=' . $_GET['id']);
				} else {
					$arrErrors[] = ERROR_USER_REQUIRED_FIELDS_IS_EMPTY;
				}
			}
			// изменение данных пользователя
			elseif (isset($_POST['saveCompanyData'])) {
				//var_dump($_FILES);
				//exit;

				// получаем данные пользователя (нужны для проверки)
				$userData = $user -> getCombinedUserData($_GET['id']);

				// если передан логотип для загрузки, пытаемся его загрузить
				if (!empty($_FILES['cLogo']['name'])) {
					// проверяем существование файла с таким же именем, и принадлежит ли он текущему пользователю
					if (!file_exists('uploads/images/logo/' . $_FILES['cLogo']['name']) || $_FILES['cLogo']['name'] == $userData['logo']) {

						if (!$user -> loadLogo('cLogo', 'uploads/images/logo/')) {
							$arrErrors = $user -> getError();
						} else {
							$logo = uploads::$arrUploadsSubj['file_name'];

							// удаляем старый логотип, если он был
							if ($_FILES['cLogo']['name'] !== $userData['logo']) {
								@unlink('uploads/images/logo/' . $userData['logo']);
								@unlink('uploads/images/logo/thumbs/thumb_' . $userData['logo']);
							}
						}
					} else {
						$arrErrors[] = ERROR_FILE_EXISTS;
					}
				} else {
					$logo = $userData['logo'];
				}

				if (empty($arrErrors)) {
					$strWhere = "id IN (" . secure::escQuoteData($_GET['id']) . ")";
					// Доп. данные пользователя
					$ucData = $_POST['conf'];
					$ucData['logo'] = $logo;
					$user -> updateConfUser($ucData, $strWhere);
					messages::messageChangeSaved(MESSAGE_CHANGE_SAVED, false, CONF_ADMIN_FILE . '?m=users&s=manager&action=detail&id=' . $_GET['id']);
				}
			}

			$userData = $user -> getCombinedUserData($_GET['id']);
			$group = new group();

			$smarty -> assign('groups', $group -> getAllGroups("token IN ('active')", false, array('id')));
			$smarty -> assignByRef('user', $userData);

       		$arrActions['detail'] = true;
		} else {
			$arrErrors[] = ERROR_USER_NOT_EXISTS;
		}
	}

	/**
	* Список пользователей, находящихся на модерации
	*/
	elseif ('moderate' === $_GET['action']) {
		// инициируем "Наименование страницы" отображаемое в форме
		$arrNamePage[] = array('name' => MENU_ACTION_MODERATE, 'link' => false);

		/**
		* удаление и модерация пользователей
		*/
		if (isset($_POST['action'])) {
			if (('del' === $_POST['action']) && isset($_POST['users'])) {
				// удаляем пользователей
				$user -> deleteUsers(array_keys($_POST['users']), false, false, false, false, false);
				// отправляем пользователям уведомление
				$user -> actionSendUsersEmails($_POST['users'], 'delete');
				messages::messageChangeSaved(MESSAGE_CHANGE_SAVED, false, CONF_ADMIN_FILE . '?m=users&s=manager&action=moderate');
			}
			elseif (('active' === $_POST['action']) && isset($_POST['users'])) {
				// активируем пользователей
				if ($user -> moderateUsersAdmin($_POST['users'])) {
					messages::messageChangeSaved(MESSAGE_CHANGE_SAVED, false, CONF_ADMIN_FILE . '?m=users&s=manager&action=moderate');
				} else {
					$arrErrors[] = ERROR_NOT_SAVE_CHANGE;
				}
			}
		}

		/**
		* ФОРМИРУЕМ СТРАНИЦЫ И ПЕРЕДАЕМ В ШАБЛОН НЕОБХОДИМЫЕ ДАНЫЕ
		*/
		//смещение, всегда 0 (затем берется из $_GET)
		$offset = isset($_GET['offset']) ? (int) abs($_GET['offset']) : 0;
		//текущий обработанный URL
		$path = CONF_ADMIN_FILE . '?m=users&amp;s=manager&amp;action=moderate&amp;order=' . $order . '&amp;by=' . $by . '&amp;';
		$userData = $user -> getCombinedUsersData(false, "conf_users.token IN ('moderate')", array($order => $by), $offset . ',' . CONF_USERS_STRINGS_PERPAGE_ADMIN_PANEL);
		// получаем общее количество записей
		$allRecords = $user -> cntUsers();

		$smarty -> assignByRef('allRecords', $allRecords);
		//передаем в шаблон строку сформированных страниц
		$smarty->assign('strPages', strings::generatePage($allRecords, $offset, CONF_USERS_STRINGS_PERPAGE_ADMIN_PANEL, $path, true));
		$smarty -> assignByRef('order', $arrOrd);
		$smarty -> assignByRef('users', $userData);

		$arrActions['moderate'] = true;
	}

	/**
	* Список пользователей, ожидающих активации
	*/
	elseif ('activate' === $_GET['action']) {
		// инициируем "Наименование страницы" отображаемое в форме
		$arrNamePage[] = array('name' => MENU_ACTION_NEW, 'link' => false);

		/**
		* удаление и активация пользователей
		*/
		if (isset($_POST['action'])) {
			if (('del' === $_POST['action']) && isset($_POST['users'])) {
				$user -> deleteUsers(array_keys($_POST['users']), false, false, false, false, false);
				messages::messageChangeSaved(MESSAGE_CHANGE_SAVED, false, CONF_ADMIN_FILE . '?m=users&s=manager&action=activate');
			}
			elseif (('active' === $_POST['action']) && isset($_POST['users'])) {
				// определяем, нужно ли отправлять пользователям уведомление об активации
				$mail = isset($_POST['mail']) ? true : false;
				// активируем пользователей
				if ($user -> activateUsersAdmin($_POST['users'], $mail)) {
					messages::messageChangeSaved(MESSAGE_CHANGE_SAVED, false, CONF_ADMIN_FILE . '?m=users&s=manager&action=activate');
				} else {
					$arrErrors[] = ERROR_NOT_SAVE_CHANGE;
				}
			}
		}

		// инициируем "Наименование страницы" отображаемое в форме
		$arrNamePage = array(
				array('name' => MENU_ADMIN_MAIN, 'link' => CONF_ADMIN_FILE),
				array('name' => MENU_MANAGER, 'link' => false),
				array('name' => MENU_MANAGER_USERS, 'link' => CONF_ADMIN_FILE . '?m=users&amp;s=manager'),
				array('name' => MENU_ACTION_NEW, 'link' => false)
			);

		/**
		* ФОРМИРУЕМ СТРАНИЦЫ И ПЕРЕДАЕМ В ШАБЛОН НЕОБХОДИМЫЕ ДАНЫЕ
		*/
		//смещение, всегда 0 (затем берется из $_GET)
		$offset = isset($_GET['offset']) ? (int) abs($_GET['offset']) : 0;
		//текущий обработанный URL
		$path = CONF_ADMIN_FILE . '?m=users&amp;s=manager&amp;action=activate&amp;order=' . $order . '&amp;by=' . $by . '&amp;';
		$userData = $user -> getCombinedUsersData(false, "users.token IN ('new')", array($order => $by), $offset . ',' . CONF_USERS_STRINGS_PERPAGE_ADMIN_PANEL);
		// получаем общее количество записей
		$allRecords = $user -> cntUsers();

		$smarty -> assignByRef('allRecords', $allRecords);
		//передаем в шаблон строку сформированных страниц
		$smarty->assign('strPages', strings::generatePage($allRecords, $offset, CONF_USERS_STRINGS_PERPAGE_ADMIN_PANEL, $path, true));
		$smarty -> assignByRef('order', $arrOrd);
		$smarty -> assignByRef('users', $userData);

		$arrActions['activate'] = true;
	}

	/**
	* Список пользователей, ожидающих активации
	*/
	elseif ('payment' === $_GET['action']) {
		// инициируем "Наименование страницы" отображаемое в форме
		$arrNamePage[] = array('name' => MENU_ACTION_PAYMENT, 'link' => false);

		/**
		* удаление и модерация пользователей
		*/
		if (isset($_POST['action'])) {
			if (('del' === $_POST['action']) && isset($_POST['users'])) {
				// удаляем пользователей
				$user -> deleteUsers(array_keys($_POST['users']), false, false, false, false, false);
				messages::messageChangeSaved(MESSAGE_CHANGE_SAVED, false, CONF_ADMIN_FILE . '?m=users&s=manager&action=payment');
			}
			elseif (('active' === $_POST['action']) && isset($_POST['users'])) {
				// активируем пользователей
				if ($user -> activateConfUsersAdmin($_POST['users'])) {
					messages::messageChangeSaved(MESSAGE_CHANGE_SAVED, false, CONF_ADMIN_FILE . '?m=users&s=manager&action=payment');
				} else {
					$arrErrors[] = ERROR_NOT_SAVE_CHANGE;
				}
			}
		}

		/**
		* ФОРМИРУЕМ СТРАНИЦЫ И ПЕРЕДАЕМ В ШАБЛОН НЕОБХОДИМЫЕ ДАНЫЕ
		*/
		//смещение, всегда 0 (затем берется из $_GET)
		$offset = isset($_GET['offset']) ? (int) abs($_GET['offset']) : 0;
		//текущий обработанный URL
		$path = CONF_ADMIN_FILE . '?m=users&amp;s=manager&amp;action=payment&amp;order=' . $order . '&amp;by=' . $by . '&amp;';
		$userData = $user -> getCombinedUsersData(false, "conf_users.token IN ('payment')", array($order => $by), $offset . ',' . CONF_USERS_STRINGS_PERPAGE_ADMIN_PANEL);
		// получаем общее количество записей
		$allRecords = $user -> cntUsers();

		$smarty -> assignByRef('allRecords', $allRecords);
		//передаем в шаблон строку сформированных страниц
		$smarty->assign('strPages', strings::generatePage($allRecords, $offset, CONF_USERS_STRINGS_PERPAGE_ADMIN_PANEL, $path, true));
		$smarty -> assignByRef('order', $arrOrd);
		$smarty -> assignByRef('users', $userData);

		$arrActions['payment'] = true;
	}

	/**
	* Добавление пользователя
	*/
	elseif ('add' === $_GET['action']) {
		// инициируем "Наименование страницы" отображаемое в форме
		$arrNamePage[] = array('name' => MENU_ACTION_ADD, 'link' => false);

		// добавление
		if (isset($_POST['save'])) {
			/**
			* Проверка данных, полученных из формы
			*/
			(!isset($_POST['data']['email']) || !$_POST['data']['email']) ? $arrErrors[] = ERROR_EMAIL_IS_EMPTY : null;
			// проверяем существование пользователя с таким email
			($user -> issetUser("email IN (" . secure::escQuoteData($_POST['data']['email']) . ") AND token IN ('active','moderate','new','archived')")) ? $arrErrors[] = ERROR_EMAIL_EXISTS : null;
			(!isset($_POST['data']['password']) || !$_POST['data']['password']) ? $arrErrors[] = ERROR_PASSWORD_IS_EMPTY : null;
			// проверяем длину пароля пользователя
			(strlen($_POST['data']['password']) < CONF_REGISTER_USER_PASSWORD) ? $arrErrors[] = ERROR_PASSWORD_IS_SHORT : null;

			if (!isset($_POST['conf']['user_type']) || ('agent' !== $_POST['conf']['user_type']
					&& 'company' !== $_POST['conf']['user_type'] && 'employer' !== $_POST['conf']['user_type']
					&& 'competitor' !== $_POST['conf']['user_type'])) {

				$arrErrors[] = ERROR_USER_TYPE_IS_EMPTY;
				$_POST['conf']['user_type'] = '';
			}

			(!isset($_POST['conf']['user_group']) || !$_POST['conf']['user_group']) ? $arrErrors[] = ERROR_USER_GROUP_IS_EMPTY : null;
			(!isset($_POST['data']['first_name']) || !$_POST['data']['first_name']) ? $arrErrors[] = ERROR_FIRST_NAME_IS_EMPTY : null;
			(!isset($_POST['data']['last_name']) || !$_POST['data']['last_name']) ? $arrErrors[] = ERROR_LAST_NAME_IS_EMPTY : null;
			(!isset($_POST['data']['phone']) || !$_POST['data']['phone']) ? $arrErrors[] = ERROR_PHONE_IS_EMPTY : null;
			/**
			* END Проверка данных, полученных из формы
			*/

			(!isset($_POST['mail'])) ? $_POST['mail'] = false : $_POST['mail'] = true;

			if (!$arrErrors) {
				if ($user -> addAdminUser($_POST['data'], $_POST['conf'], $_POST['mail'])) {
					messages::messageChangeSaved(MESSAGE_USER_ADDED, false, CONF_ADMIN_FILE . '?m=users&s=manager&amp;action=add');
				} else {
					$arrErrors[] = ERROR_USER_NOT_ADDED;
				}
			}

    		$smarty -> assignByRef('return_data', $_POST);
			$smarty -> assignByRef('errors', $arrErrors);
		}

		$group = new group();
		$smarty -> assign('groups', $group -> getAllGroups("token IN ('active')", false, array('id')));

		$arrActions['add'] = true;
	}
	
	/**
	* Поиск пользователя
	*/
	elseif ('filter' === $_GET['action']) {
		// инициируем "Наименование страницы" отображаемое в форме
		$arrNamePage[] = array('name' => MENU_ACTION_FILTER, 'link' => false);

		// формируем запрос отбора пользователей
		if (isset($_GET['id'])) {
			/**
			* Действия с отобранными записями (Активация, удаление)
			*/
			// действия с активными пользователями
			if (isset($_POST['save']) && isset($_POST['action'])) {
				if (('del' === $_POST['action']) && isset($_POST['users'])) {
					$user -> deleteUsers(array_keys($_POST['users']), true, true, true, true, true);
					messages::messageChangeSaved(MESSAGE_CHANGE_SAVED, false, CONF_ADMIN_FILE . '?' . $_SERVER['QUERY_STRING']);
				}
			}
			// действия с пользователями, ожидающими модерации
			elseif (isset($_POST['moderate']) && isset($_POST['action'])) {
				if (('del' === $_POST['action']) && isset($_POST['users'])) {
					// удаляем пользователей
					$user -> deleteUsers(array_keys($_POST['users']), false, false, false, false, false);
					// отправляем пользователям уведомление
					$user -> actionSendUsersEmails($_POST['users'], 'delete');
					messages::messageChangeSaved(MESSAGE_CHANGE_SAVED, false, CONF_ADMIN_FILE . '?' . $_SERVER['QUERY_STRING']);
				}
				elseif (('active' === $_POST['action']) && isset($_POST['users'])) {
					// активируем пользователей
					if ($user -> moderateUsersAdmin($_POST['users'])) {
						messages::messageChangeSaved(MESSAGE_CHANGE_SAVED, false, CONF_ADMIN_FILE . '?' . $_SERVER['QUERY_STRING']);
					} else {
						$arrErrors[] = ERROR_NOT_SAVE_CHANGE;
					}
				}
			}
			// действия с пользователями, ожидающими активации
			elseif (isset($_POST['activate']) && isset($_POST['action'])) {
				if (('del' === $_POST['action']) && isset($_POST['users'])) {
					$user -> deleteUsers(array_keys($_POST['users']), false, false, false, false, false);
					messages::messageChangeSaved(MESSAGE_CHANGE_SAVED, false, CONF_ADMIN_FILE . '?' . $_SERVER['QUERY_STRING']);
				}
				elseif (('active' === $_POST['action']) && isset($_POST['users'])) {
					// определяем, нужно ли отправлять пользователям уведомление об активации
					$mail = isset($_POST['mail']) ? true : false;
					// активируем пользователей
					if ($user -> activateUsersAdmin($_POST['users'], $mail)) {
						messages::messageChangeSaved(MESSAGE_CHANGE_SAVED, false, CONF_ADMIN_FILE . '?' . $_SERVER['QUERY_STRING']);
					} else {
						$arrErrors[] = ERROR_NOT_SAVE_CHANGE;
					}
				}
			}
			// действия с пользователями, ожидающими оплату
			elseif (isset($_POST['payment']) && isset($_POST['action'])) {
				if (('del' === $_POST['action']) && isset($_POST['users'])) {
					$user -> deleteUsers(array_keys($_POST['users']), false, false, false, false, false);
					messages::messageChangeSaved(MESSAGE_CHANGE_SAVED, false, CONF_ADMIN_FILE . '?' . $_SERVER['QUERY_STRING']);
				}
				elseif (('active' === $_POST['action']) && isset($_POST['users'])) {
					// активируем пользователей
					if ($user -> activateConfUsersAdmin($_POST['users'])) {
						messages::messageChangeSaved(MESSAGE_CHANGE_SAVED, false, CONF_ADMIN_FILE . '?' . $_SERVER['QUERY_STRING']);
					} else {
						$arrErrors[] = ERROR_NOT_SAVE_CHANGE;
					}
				}
			}

			$returnData['id'] = isset($_GET['id']) ? (string) $_GET['id'] : '';
			$returnData['email'] = isset($_GET['email']) ? (string) $_GET['email'] : '';
			$returnData['alias'] = isset($_GET['alias']) ? (string) $_GET['alias'] : '';
			$returnData['reg_ip'] = !empty($_GET['reg_ip']) ? (string) $_GET['reg_ip'] : '';
			$returnData['user_type'] = isset($_GET['user_type']) ? (string) $_GET['user_type'] : '';
			$returnData['user_group'] = isset($_GET['user_group']) ? (string) $_GET['user_group'] : '';
			$returnData['token'] = isset($_GET['token']) ? (string) $_GET['token'] : 'active';

			/**
			* ФОРМИРУЕМ УСЛОВИЯ ДЛЯ ЗАПРОСА
			*/
			// формируем условие в соответствии с ID-пользователя
			$strWhereId = false;
			if (!empty($_GET['id'])) {
				// функция возвращает только значения, которые больше 0
				function toInt($n) {
			    	return ((int) $n > 0);
				}

				// проверяем, в каком виде передан массив Id-пользователя
				// поиск пользователей по нескольким ID (разделитель - запятая ',')
				if (stripos($_GET['id'], ',')) {
					// формируем массив, с ID пользователей
					$arrId = array_filter(explode(',', $_GET['id']), 'toInt');
					$strWhereId = "users.id IN (" . implode(',', secure::escQuoteData($arrId)) . ")";
				}
				// поиск пользователей по диапазону ID (разделитель - тире '-')
				elseif (stripos($_GET['id'], '-')) {
					// формируем массив, с диапазоном ID пользователей
					$arrId = array_filter(explode('-', $_GET['id']), 'toInt');
					$strWhereId = (isset($arrId[0]) && $arrId[0] && isset($arrId[1]) && $arrId[1]) ? "users.id>=" . $arrId[0] . " AND users.id<=" . $arrId[1] : '';
				}
				// поиск пользователей по ID
				elseif ((int) $_GET['id']) {
					$strWhereId = "users.id IN (" . secure::escQuoteData((int) $_GET['id']) . ")";
				}
			}
			
			// формируем условие в соответствии с Email пользователя
			$strWhereEmail = (!empty($_GET['email'])) ? "users.email LIKE " . secure::escQuoteData($_GET['email']) : false;

			// формируем условие в соответствии с Alias пользователя
			$strWhereAlias = false;
			if (!empty($_GET['alias'])) {
				$strWhereAlias = ('()' === $_GET['alias']) ? "users.alias=''" : "users.alias LIKE " . secure::escQuoteData($_GET['alias']);
			}

			// формируем условие в соответствии с IP пользователя
			$strWhereIP = (!empty($_GET['reg_ip'])) ? "users.reg_ip LIKE " . secure::escQuoteData($_GET['reg_ip']) : false;

			// формируем условие в соответствии с user_type пользователя
			$strWhereUserType = (isset($_GET['user_type']) && $_GET['user_type']) ? "conf_users.user_type IN (" . secure::escQuoteData($_GET['user_type']) . ")" : false;

			// формируем условие в соответствии с user_type пользователя
			$strWhereUserGroup = (isset($_GET['user_group']) && $_GET['user_group']) ? "conf_users.user_group IN (" . secure::escQuoteData($_GET['user_group']) . ")" : false;

			// формируем условие в соответствии с token пользователя
			$strWhereToken = "conf_users.token IN ('active')";
			if (isset($_GET['token']) && $_GET['token']) {
				if ('new' === $_GET['token']) {
					$strWhereToken = "users.token IN (" . secure::escQuoteData($_GET['token']) . ")";
				}
				elseif ('active' === $_GET['token'] || 'moderate' === $_GET['token'] || 'payment' === $_GET['token']) {
					$strWhereToken = "conf_users.token IN (" . secure::escQuoteData($_GET['token']) . ")";
				}
			}

			// формируем общее условие
			$strWhere = (($strWhereId) ? $strWhereId . ' AND ' : null) . (($strWhereEmail) ? $strWhereEmail . ' AND ' : null) . (($strWhereAlias) ? $strWhereAlias . ' AND ' : null) . (($strWhereIP) ? $strWhereIP . ' AND ' : null) . (($strWhereUserType) ? $strWhereUserType . ' AND ' : null) . (($strWhereUserGroup) ? $strWhereUserGroup . ' AND ' : null) . $strWhereToken;
			/**
			* END ФОРМИРУЕМ УСЛОВИЯ ДЛЯ ЗАПРОСА
			*/

			//смещение, всегда 0 (затем берется из $_GET)
			$offset = (isset($_GET['offset']) && (int) $_GET['offset'] > 0) ? (int) $_GET['offset'] : 0;
			//текущий обработанный URL
			$path = CONF_ADMIN_FILE . '?m=users&amp;s=manager&amp;action=filter&amp;id=' . $returnData['id'] . '&amp;'
				  . 'email=' . $returnData['email'] . '&amp;alias=' . $returnData['alias'] . '&amp;reg_ip=' . $returnData['reg_ip'] . '&amp;'
				  . 'user_type=' . $returnData['user_type'] . '&amp;user_group=' . $returnData['user_group'] . '&amp;token=' . $returnData['token'] . '&amp;';

			// получаем данные пользователя
			$usersData = $user -> getCombinedUsersData(false, $strWhere, array($order => $by), $offset . ',' . CONF_USERS_STRINGS_PERPAGE_ADMIN_PANEL);
			$allRecords = $user -> cntUsers(); // получаем общее количество записей

			$smarty -> assignByRef('users', $usersData);
			$smarty -> assignByRef('allRecords', $allRecords);
			//передаем в шаблон строку сформированных страниц
			$smarty -> assign('strPages', strings::generatePage($allRecords, $offset, CONF_USERS_STRINGS_PERPAGE_ADMIN_PANEL, $path, true));
			$smarty -> assignByRef('return_data', $returnData);
		}

		$group = new group();
		$smarty -> assign('user_types', $group -> arrTypes);
		$smarty -> assign('user_groups', $group -> getAllGroups("token IN ('active')", false, array('id')));

		$arrActions['filter'] = true;
	}
}
else
{
	// инициируем "Наименование страницы" отображаемое в форме
	$arrNamePage[] = array('name' => MENU_MANAGER_USERS, 'link' => false);

	/**
	* удаление пользователей
	*/
	if (isset($_POST['action'])) {
		if (('del' === $_POST['action']) && isset($_POST['users'])) {
			$user -> deleteUsers(array_keys($_POST['users']), true, true, true, true, true);
			messages::messageChangeSaved(MESSAGE_CHANGE_SAVED, false, CONF_ADMIN_FILE . '?m=users&s=manager');
		}
	}

	/**
	* ФОРМИРУЕМ СТРАНИЦЫ И ПЕРЕДАЕМ В ШАБЛОН НЕОБХОДИМЫЕ ДАНЫЕ
	*/
	//смещение, всегда 0 (затем берется из $_GET)
	$offset = isset($_GET['offset']) ? (int) abs($_GET['offset']) : 0;
	//текущий обработанный URL
	$path = CONF_ADMIN_FILE . '?m=users&amp;s=manager&amp;order=' . $order . '&amp;by=' . $by . '&amp;';
	
	//$fields = array(USR_PREFIX . 'users' => array('id', 'email', 'reg_datetime'), DB_PREFIX . 'conf_users' => array('user_type', 'user_group'));
	// получаем данные пользователя
	$usersData = $user -> getCombinedUsersData(false, false, array($order => $by), $offset . ',' . CONF_USERS_STRINGS_PERPAGE_ADMIN_PANEL);
	// получаем общее количество записей
	$allRecords = $user -> cntUsers();

	$smarty -> assignByRef('order', $arrOrd);
	$smarty -> assignByRef('users', $usersData);
	$smarty -> assignByRef('allRecords', $allRecords);
	//передаем в шаблон строку сформированных страниц
	$smarty -> assign('strPages', strings::generatePage($allRecords, $offset, CONF_USERS_STRINGS_PERPAGE_ADMIN_PANEL, $path, true));
}

$smarty -> assignByRef('query_string', $_SERVER['QUERY_STRING']);
$smarty -> assignByRef('errors', $arrErrors);
$smarty -> assignByRef('action', $arrActions);
