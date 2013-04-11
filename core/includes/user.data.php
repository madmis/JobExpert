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

/**
* иницализация массива подключаемых шаблонов: по умолчанию все значения - false
* для подключения шаблона, необходимо установить значение - true
* шаблоны подключаются в порядке установленном в файле головного шаблона
*/
$arrAction = array(
	'edit'	=> false
);

// проверяем, включена ли регистрация
if (CONF_USER_REGISTER)
{
	// проверяем, вошел ли пользователь
	if ($user -> getAuthorized()) {
		// получаем данные пользователя из таблицы текущего скрипта
		// получаем в самом начале, т.к. эти данные (не данные сессии), необходимо будет использовать при удалении старого логотипа
		$arrUser = array_merge($_SESSION['sd_user']['data'], $_SESSION['sd_user'][DB_PREFIX . 'conf']); // объединяем данные пользователя

		/**
		* Действия
		*/
		if (isset($_GET['action'])) {
			/**
			* Редактирование личных данных
			*/
			if ('edit' === $_GET['action']) {
				/**
				* Сохранение личных данных пользователя
				*/
				if (isset($_POST['save'])) {
					if (!empty($_POST['alias'])) {
						if ($user -> issetUser("id NOT IN (" . secure::escQuoteData($_SESSION['sd_user']['data']['id']) . ") AND alias IN (" . secure::escQuoteData($_POST['alias']) . ") AND token IN ('active','archived','moderate','new')")) {
							$arrErrors[] = ERROR_USER_ALIAS_EXISTS;
						}
					} else {
						$arrErrors[] = ERROR_EMPTY_BIND_FIELDS;
					}

					// массив основных данных пользователя
					$arrData = array(
						'alias' => $_POST['alias'],
						'middle_name' => (!empty($_POST['middle_name'])) ? $_POST['middle_name'] : ''
					);

					// Разрешаем пользователю изменять имя и фамилиию только если включена соотв. настройка
					if (CONF_USER_CHANGE_NAME) {
						if (!empty($_POST['first_name']) && !empty($_POST['last_name'])) {
							$arrData['first_name'] = $_POST['first_name'];
							$arrData['last_name'] = $_POST['last_name'];
						} else {
							$arrErrors[] = ERROR_EMPTY_NAME_OR_SURNAME;
						}
					}

					// массив дополнительных данных пользователя
					$arrConf = array(
						'addition_phone_1' => $_POST['addition_phone_1'],
						'addition_phone_2' => $_POST['addition_phone_2'],
						'mailer_subscribe' => (!empty($_POST['mailer_subscribe']) ? true : false),
					);

					// проверяем настройку скрытия доп. данных компании
					if ('company' === $_SESSION['sd_user'][DB_PREFIX . 'conf']['user_type'] && !empty($_POST['hide_additional_company_data'])) {
						$arrConf['hide_additional_company_data'] = true;
					} else {
						$arrConf['hide_additional_company_data'] = false;
					}

					if (!$arrErrors) {
						(!$user -> updateUserData($arrData, $arrConf)) ? ($arrErrors[] = db::$message_error ? db::$message_error : ERROR_MISMATCH_FIELDS) : messages::messageChangeSaved(MESSAGE_CHANGE_SAVED, false, chpu::createChpuUrl(CONF_SCRIPT_URL . 'index.php?ut=' . $_SESSION['sd_user'][DB_PREFIX . 'conf']['user_type'] . '&amp;do=user.data&action=edit'));
					}
				}

				/**
				* Сохранение данных соискателя
				*/
				if (isset($_POST['save_competitor']) && 'competitor' === $_SESSION['sd_user'][DB_PREFIX . 'conf']['user_type']) {
					$arrData = array();

					(isset($_POST['gender'])) ? $arrData['gender'] = $_POST['gender'] : null;
					$arrData['birthday'] = $_POST['date']['Date_Year'] . '-' .  $_POST['date']['Date_Month'] . '-' .  $_POST['date']['Date_Day'];

					if (!$user -> updateUserData($arrData, false)) {
						 $arrErrors[] = db::$message_error ? db::$message_error : ERROR_MISMATCH_FIELDS;
					} else {
						messages::messageChangeSaved(MESSAGE_CHANGE_SAVED, false, chpu::createChpuUrl(CONF_SCRIPT_URL . 'index.php?ut=' . $_SESSION['sd_user'][DB_PREFIX . 'conf']['user_type'] . '&amp;do=user.data&action=edit&amp;anc=1'));
					}
				}

				/**
				* Сохранение данных компании
				*/
				if (isset($_POST['save_company']) && ('company' === $_SESSION['sd_user'][DB_PREFIX . 'conf']['user_type'] || 'agent' === $_SESSION['sd_user'][DB_PREFIX . 'conf']['user_type'])) {
                    // если передан логотип для загрузки, пытаемся его загрузить
					if (isset($_FILES['logo']['name']) && $_FILES['logo']['name']) {
						// проверяем существование файла с таким же именем, и принадлежит ли он текущему пользователю
						if (!file_exists('uploads/images/logo/' . $_FILES['logo']['name']) || $_FILES['logo']['name'] === $arrUser['logo']) {
							if (!$user -> loadLogo('logo', 'uploads/images/logo/')) {
								$arrErrors = $user -> getError();
							} else {
								$logo = uploads::$arrUploadsSubj['file_name'];

								// удаляем старый логотип, если он был
								if ($_FILES['logo']['name'] !== $arrUser['logo']) {
									@unlink('uploads/images/logo/' . $arrUser['logo']);
									@unlink('uploads/images/logo/thumbs/thumb_' . $arrUser['logo']);
								}
							}
						} else {
							$arrErrors[] = ERROR_FILE_EXISTS;
						}
					} else {
						$logo = $arrUser['logo'];
					}

					if (!$arrErrors) {
						$arrConfData = array(
							'company_name'			=> $_POST['company_name'],
							'company_city'			=> $_POST['company_city'],
							'company_url'			=> $_POST['company_url'],
							'company_description'	=> (CONF_USE_VISUAL_EDITOR && CONF_COMPANIES_USE_VISUAL_EDITOR) ? $_POST['company_description'] : htmlentities($_POST['company_description'], ENT_QUOTES, CONF_DEFAULT_CHARSET),
							'logo'					=> $logo
						);

						if (!$user -> updateUserData(false, $arrConfData)) {
							 $arrErrors[] = db::$message_error ? db::$message_error : ERROR_MISMATCH_FIELDS;
						} else {
							// если удалось обновить данные,
							messages::messageChangeSaved(MESSAGE_CHANGE_SAVED, false, chpu::createChpuUrl(CONF_SCRIPT_URL . 'index.php?ut=' . $_SESSION['sd_user'][DB_PREFIX . 'conf']['user_type'] . '&amp;do=user.data&action=edit&amp;anc=1'));
						}
					}
				}

				$arrAction['edit'] = true;
				$arrNamePage = array(
					array('name' => MENU_USER_DATA, 'link' => chpu::createChpuUrl(CONF_SCRIPT_URL . 'index.php?ut=' . $_SESSION['sd_user'][DB_PREFIX . 'conf']['user_type'] . '&amp;do=user.data')),
					array('name' => MENU_EDIT_USER_DATA, 'link' => false)
				);
			}
		}

		$smarty -> assignByRef('arrUser', $arrUser);
		$smarty -> assignByRef('action', $arrAction);
		$smarty -> assignByRef('errors', $arrErrors);
		$smarty -> assign('anc', (isset($_GET['anc']) ? $_GET['anc'] : 0));

		// передаем массив селекта "Пол"
		unset ($arrSysDict['Gender']['values']['none']); // вырезаем ненужное значение
		//$smarty -> assignByRef('gender', $arrSysDict['Gender']['values']);
	} else {
		 // иначе направляем на страницу авторизации
		 die ('<script type="text/javascript">window.location="' . chpu::createChpuUrl(CONF_SCRIPT_URL . 'index.php?do=authorize') . '";</script>');
	}
} else {
	messages::error404();
}

