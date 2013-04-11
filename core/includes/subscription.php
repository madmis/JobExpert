<?php

/**
 * JobExpert v1.0
 * Powered by Script Developers Group (SD-Group)
 * Email: info@sd-group.org.ua
 * URL: http://sd-group.org.ua/
 * Copyright 2010-2015 (c) SD-Group
 * All rights reserved
 * ===================================================
 * Подписки пользователя
 * ===================================================
 *
 * @package
 *
 * @todo
 *
 */
(!defined('SDG')) ? die('Triple protection!') : null;

/**
 * иницализация массива подключаемых шаблонов: по умолчанию все значения - false
 * для подключения шаблона, необходимо установить значение - true
 * шаблоны подключаются в порядке установленном в файле головного шаблона
 */
$arrAction = array(
	'edit' => false
);

/**
 * Массив статистических данных по подпискам
 */
$statData = array(
	'allSubscr' => false, // все подписки
	'paySubscrR' => false, // платные подписки на вакансии
	'paySubscrV' => false, // платные подписки на резюме
	'anSubscr' => false, // подписки по объявлениям
	'availFreeSubscrV' => false, // количество доступных бесплатных подписок
	'availFreeSubscrR' => false // количество доступных бесплатных подписок
);

// проверяем, включена ли регистрация
if (CONF_USER_REGISTER) {
	// проверяем, вошел ли пользователь
	if ($user->getAuthorized()) {
		$subscription = new subscription();

		/**
		 * Добавляем подписку
		 */
		if (isset($_POST['save'])) {
			// получаем из формы поля обязательные для заполнения
			$arrBindFields = $_POST['arrBindFields'];
			// получаем из формы поля необязательные для заполнения
			$arrNoBindFields = $_POST['arrNoBindFields'];

			if ('agent' !== $_SESSION['sd_user'][DB_PREFIX . 'conf']['user_type']) {
				$arrBindFields['type_subscription'] = ('competitor' === $_SESSION['sd_user'][DB_PREFIX . 'conf']['user_type']) ? 'vacancy' : 'resume';
			}

			///////////////////////////////////////////////////////////////
			// Проверка данных, полученных из формы
			///////////////////////////////////////////////////////////////
			if (empty($arrBindFields['id_section'])) {
				$arrErrors[] = ERROR_SECTION_NOT_SELECT;
			}

			if (empty($arrBindFields['id_region'])) {
				$arrErrors[] = ERROR_REGION_NOT_SELECT;
			}

			if (empty($arrBindFields['period'])) {
				$arrErrors[] = ERROR_PERIOD_NOT_SELECT;
			}

			if ('agent' === $_SESSION['sd_user'][DB_PREFIX . 'conf']['user_type']) {
				if (!isset($arrBindFields['type_subscription']) || ('vacancy' !== $arrBindFields['type_subscription'] && 'resume' !== $arrBindFields['type_subscription'])) {
					$arrErrors[] = ERROR_TYPE_SUBSCRIPTION_NOT_SELECT;
				}
			}
			///////////////////////////////////////////////////////////////
			///////////////////////////////////////////////////////////////
			// Если ошибок нет и тип подписки бесплатный, проверяем, сколько их можно добавить
			if (!$arrErrors && !$arrPayments['subscr_' . $arrBindFields['type_subscription']]) {
				($subscription->cntSubscriptions("id_announce IN ('0') AND id_user IN (" . secure::escQuoteData($_SESSION['sd_user']['data']['id']) . ") AND type_subscription IN (" . secure::escQuoteData($arrBindFields['type_subscription']) . ") AND token IN ('active')") >= @constant('CONF_SUBSCRIPTIONS_FREE_' . strtoupper($arrBindFields['type_subscription']))) ? $arrErrors[] = ERROR_HAVE_MAXIMUM_SUBSCRIPTIONS : null;
			}


			if (!$arrErrors) {
				$arrBindFields['email'] = $_SESSION['sd_user']['data']['email'];
				$arrNoBindFields['id_user'] = $_SESSION['sd_user']['data']['id'];

				// присваеваем полученные данные объекту
				$subscription->arrBindFields = $arrBindFields;
				$subscription->arrNoBindFields = $arrNoBindFields;

				// производим запись в таблицу БД
				if ($subscription->recSubscr()) {
					// проверяем, включена ли тестовая рассылка и если включена, выполняем ее
					if (isset($_POST['test_send']) && $subscription->runSubscription($subscription->arrBindFields + $subscription->arrNoBindFields)) {
						// выдаем сообщение об успешности
						messages::messageChangeSaved(MESSAGE_SUBSCRIPTION_ADDED, MESSAGE_TEST_SUBSCRIPTION_WAS_SEND, chpu::createChpuUrl(CONF_SCRIPT_URL . 'index.php?ut=' . $_SESSION['sd_user'][DB_PREFIX . 'conf']['user_type'] . '&amp;do=subscription'));
					} else {
						// выдаем сообщение о том, что нет данных для рассылки
						messages::messageChangeSaved(MESSAGE_SUBSCRIPTION_ADDED, false, chpu::createChpuUrl(CONF_SCRIPT_URL . 'index.php?ut=' . $_SESSION['sd_user'][DB_PREFIX . 'conf']['user_type'] . '&amp;do=subscription'));
					}
				} else { // если не удалось записать
					// если записать не удалось, возвращаем ошибку
					$arrErrors[] = db::$message_error ? db::$message_error : ERROR_MISMATCH_FIELDS;
				}
			}
		}
		/**
		 * удаление подписок
		 */ elseif (isset($_POST['action'])) {
			// удаление
			if ('del' === $_POST['action'] && isset($_POST['subscr'])) {
				$strWhere = "id IN (" . implode(',', secure::escQuoteData(array_keys($_POST['subscr']))) . ")";
				$subscription->delSubscriptions($strWhere);
				messages::messageChangeSaved(MESSAGE_CHANGE_SAVED, false, chpu::createChpuUrl(CONF_SCRIPT_URL . 'index.php?ut=' . $_SESSION['sd_user'][DB_PREFIX . 'conf']['user_type'] . '&amp;do=subscription'));
			}
			// оплата
			elseif ('pay' === $_POST['action'] && isset($_POST['subscr'])) {
				// проверяем, чтобы в масиве была только одна подписка и получаем ее
				if (count($_POST['subscr']) === 1 && $ps = each($_POST['subscr'])) {
					$_SESSION['payment'] = array('service' => 'subscr_' . $ps['value'], 'id' => $ps['key']);
					die('<script type="text/javascript">window.location="' . chpu::createChpuUrl(CONF_SCRIPT_URL . 'index.php?ut=' . $_SESSION['sd_user'][DB_PREFIX . 'conf']['user_type'] . '&amp;do=payments') . '";</script>');
				} else {
					messages::messageChangeSaved(MESSAGE_WARNING_PAYMENT_NO_MORE_THAN_ONE_RECORD, false, chpu::createChpuUrl(CONF_SCRIPT_URL . 'index.php?ut=' . $_SESSION['sd_user'][DB_PREFIX . 'conf']['user_type'] . '&amp;do=subscription'), 5000);
				}
			}

			messages::messageChangeSaved(MESSAGE_WARNING_NOT_SELECT_RECORDS, false, chpu::createChpuUrl(CONF_SCRIPT_URL . 'index.php?ut=' . $_SESSION['sd_user'][DB_PREFIX . 'conf']['user_type'] . '&amp;do=subscription'));
		}

		/**
		 * ФОРМИРУЕМ СПИСКИ ПОДПИСОК
		 */
		// передаем массив активных подписок
		$arrSubscr = $subscription->getSubscriptions("id_user IN (" . secure::escQuoteData($_SESSION['sd_user']['data']['id']) . ") AND token IN ('active')", false, false, false) or $arrSubscr = array();
		$statData['allSubscr'] = $subscription->cntSubscriptions();
		$smarty->assignByRef('subscriptions', $arrSubscr);
		$smarty->assignByRef('allRecords', $statData['allSubscr']);

		// проверяем, включены ли платные подписки
		// и получаем массив подписок ожидающих оплаты
		$arrPaySubscr = ($arrPayments['subscr_vacancy'] || $arrPayments['subscr_resume']) ? $subscription->getSubscriptions("id_user IN (" . secure::escQuoteData($_SESSION['sd_user']['data']['id']) . ") AND token IN ('payment')", false, false, false) : false;
		// передаем массив подписок ожидающих оплаты
		$smarty->assign('paySubscr', $arrPaySubscr);

		/*		 * * ПОЛУЧАЕМ СТАТИСТИЧЕСКИЕ ДАННЫЕ О ПОДПИСКАХ ** */
		$freeAddedR = $freeAddedV = 0;
		// собираем количество бесплатных, активных, подписок на вакансии и резюме
		if (!empty($arrSubscr)) {
			foreach ($arrSubscr as $value) {
				if (empty($value['id_announce']) && 'no' == $value['payment']) {
					('vacancy' == $value['type_subscription']) ? $freeAddedV++ : $freeAddedR++;
				}
			}
		}
		// Вычисляем количество доступных бесплатных подписок на вакансии
		$statData['availFreeSubscrV'] = (($avail = (int) CONF_SUBSCRIPTIONS_FREE_VACANCY - $freeAddedV) > 0) ? $avail : 0;
		$statData['availFreeSubscrR'] = (($avail = (int) CONF_SUBSCRIPTIONS_FREE_RESUME - $freeAddedR) > 0) ? $avail : 0;

		/*
		  $payQueryV = ($arrPayments['subscr_vacancy']) ? "AND payment='yes'" : "";
		  $payQueryR = ($arrPayments['subscr_resume']) ? "AND payment='yes'" : "";

		  // количество добавленных платных подписок
		  $statData['paySubscrV'] = $subscription -> cntSubscriptions("id_announce='0' AND id_user='" . $_SESSION['sd_user']['data']['id'] . "' " . $payQueryV . " AND type_subscription='vacancy' AND token='active'");
		  $statData['paySubscrR'] = $subscription -> cntSubscriptions("id_announce='0' AND id_user='" . $_SESSION['sd_user']['data']['id'] . "' " . $payQueryR . " AND type_subscription='resume' AND token='active'");

		  // количество доступных бесплатных подписок
		  $statData['availFreeSubscrV'] = ($res = CONF_SUBSCRIPTIONS_FREE_VACANCY - $statData['paySubscrV']) > 0 ? $res : 0;
		  $statData['availFreeSubscrR'] = ($res = CONF_SUBSCRIPTIONS_FREE_RESUME - $statData['paySubscrR']) > 0 ? $res : 0;
		 */

		/**
		 * РАБОТА СО СЛОВАРЯМИ
		 */
		// передаем массив селекта "Периодичность рассылки"
		//$smarty->assignByRef('arrSubscriptionPeriod', $arrSysDict['SubscriptionPeriod']['values']);
		// если массив подписок не пустой
		// формируем списки для вывода городов и профессий
		if ($arrSubscr) {
			$arrProfId = array();
			$arrCitysId = array();

			foreach ($arrSubscr as $value) {
				($value['id_profession']) ? $arrProfId[] = $value['id_profession'] : null;
				($value['id_profession_1']) ? $arrProfId[] = $value['id_profession_1'] : null;
				($value['id_profession_2']) ? $arrProfId[] = $value['id_profession_2'] : null;
				($value['id_city']) ? $arrCitysId[] = $value['id_city'] : null;
			}

			// формируем списки для вывода городов и профессий и для платных подписок
			if ($arrPaySubscr) {
				foreach ($arrPaySubscr as $value) {
					($value['id_profession']) ? $arrProfId[] = $value['id_profession'] : null;
					($value['id_profession_1']) ? $arrProfId[] = $value['id_profession_1'] : null;
					($value['id_profession_2']) ? $arrProfId[] = $value['id_profession_2'] : null;
					($value['id_city']) ? $arrCitysId[] = $value['id_city'] : null;
				}
			}
		}
		// передаем все статистические данные
		$smarty->assignByRef('statData', $statData);
		// передаем массив ошибок
		$smarty->assignByRef('errors', $arrErrors);
	} else {
		messages::error404();
	}
} else {
	messages::error404();
}
