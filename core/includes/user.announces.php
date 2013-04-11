<?php

/**
 * JobExpert v1.0
 * Powered by Script Developers Group (SD-Group)
 * Email: info@sd-group.org.ua
 * URL: http://sd-group.org.ua/
 * Copyright 2010-2015 (c) SD-Group
 * All rights reserved
 * ===================================================
 * Данные пользователя

 * @package
 *
 * @todo
 *
 */
(!defined('SDG')) ? die('Triple protection!') : null;
// проверяем, включена ли регистрация
if (CONF_USER_REGISTER) {
	if ($user->getAuthorized()) { // проверяем, вошел ли пользователь
		/**
		 * иницализация массива подключаемых шаблонов: по умолчанию все значения - false
		 * для подключения шаблона, необходимо установить значение - true
		 * шаблоны подключаются в порядке установленном в файле головного шаблона
		 */
		$arrAction = array(
			'vacancy' => false,
			'resume' => false
		);

		/**
		 * иницализация массива токенов объявлений доступных для просмотра пользователю
		 */
		$arrTokens = array(
			'new',
			'moderate',
			'correction',
			'payment',
			'active',
			'template',
			'archived'
		);

		// проверяем запрошенный шаблон и токен объявлений
		if (isset($_GET['action']) && isset($arrAction[$_GET['action']]) && isset($_GET['token']) && in_array($_GET['token'], $arrTokens)) {
			$arrAction[$_GET['action']] = true;

			/**
			 * действия с объявлениями
			 */
			(isset($_POST['arrAnnData']['action'])) ? ((!$$_GET['action']->actionAnnounces($_POST['arrAnnData'], false)) ? messages::messageChangeSaved(ERROR_NOT_CHANGE_DATA, false, chpu::createChpuUrl(CONF_SCRIPT_URL . 'index.php?ut=' . $_SESSION['sd_user'][DB_PREFIX . 'conf']['user_type'] . '&amp;do=user.announces&amp;action=' . $_GET['action'] . '&amp;token=' . $_GET['token'])) : messages::messageChangeSaved(MESSAGE_CHANGE_SAVED, false, chpu::createChpuUrl(CONF_SCRIPT_URL . 'index.php?ut=' . $_SESSION['sd_user'][DB_PREFIX . 'conf']['user_type'] . '&amp;do=user.announces&amp;action=' . $_GET['action'] . '&amp;token=' . $_GET['token']))) : null;

			/**
			 * инициализация списка Период размещения
			 */
			//$smarty->assignByRef('actperiod', $arrSysDict['ActPeriod']['values']);

			/**
			 * инициализация списка Пол
			 */
			//$smarty->assignByRef('gender', $arrSysDict['Gender']['values']);

			/**
			 * инициализация списка Тип размещения
			 */
			if (!empty($arrAction['resume']) && 'active' === $_GET['token']) {
				$arrVisibility = array(
					'visible' => ANNOUNCE_VISIBILITY_VISIBLE,
					'visiblehc' => ANNOUNCE_VISIBILITY_VISIBLEHC,
					'members' => ANNOUNCE_VISIBILITY_MEMBERS,
					'membershc' => ANNOUNCE_VISIBILITY_MEMBERSHC,
					'hide' => ANNOUNCE_VISIBILITY_HIDE
				);
				$smarty->assignByRef('arrVisibility', $arrVisibility);
			}

			// инициируем "Наименование страницы" отображаемое в заголовке формы
			$arrNamePage = array(
				array('name' => constant('MENU_MY_' . strtoupper($_GET['action']) . 'S'), 'link' => false),
				array('name' => constant('ANNOUNCE_TOKEN_' . strtoupper($_GET['token'])), 'link' => false)
			);

			$offset = isset($_GET['offset']) ? (int) abs($_GET['offset']) : 0; //смещение, всегда 0 (затем берется из $_GET)
			$arrLimit = array('strLimit' => $offset . ', ' . CONF_ANNOUNCE_PERPAGE_SITE, 'calcRows' => true);

			$smarty->assignByRef('return_data', $$_GET['action']->getUserAnnounces($_GET['token'], $arrLimit));

			$allRecords = $$_GET['action']->cntAnnounces(); // получаем общее количество объявлений
			$smarty->assignByRef('allRecords', $allRecords);

			$strPages = strings::generatePage($allRecords, $offset, CONF_ANNOUNCE_PERPAGE_SITE, CONF_SCRIPT_URL . 'index.php?ut=' . $_SESSION['sd_user'][DB_PREFIX . 'conf']['user_type'] . '&amp;do=user.announces&amp;action=' . $_GET['action'] . '&amp;token=' . $_GET['token'] . '&amp;'); // формируем страницы

			$smarty->assignByRef('string_page', $strPages); //передаем в шаблон строку сформированных страниц

			$smarty->assign('strTableHead', constant('SITE_' . strtoupper($_GET['action']) . 'S') . ': ' . constant('ANNOUNCE_TOKEN_' . strtoupper($_GET['token'])));

			$smarty->assign('menu', 'user.announces');
			$smarty->assignByRef('action', $_GET['action']);
			$smarty->assignByRef('token', $_GET['token']);
		} else {
			messages::error404();
		}
	} else { // иначе направляем на страницу авторизации
		die('<script type="text/javascript">window.location="' . chpu::createChpuUrl(CONF_SCRIPT_URL . 'index.php?do=authorize') . '";</script>');
	}
} else {
	messages::error404();
}
