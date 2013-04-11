<?php
/********************************************************
	JobExpert v1.0
	powered by Script Developers Group (SD-Group)
	email: info@sd-group.org.ua
	url: http://sd-group.org.ua/
	Copyright 2010-2015 (c) SD-Group
	All rights reserved
=========================================================
	Модуль оплаты - Hand - Админка
********************************************************/
/**
* @package
* @todo
*/

(!defined('SDG')) ? die ('Triple protection!') : null;

require_once 'core/mods/payments/hand/lang/' . CONF_LANGUAGE . '/adm.hand.lang.php';
require_once 'core/mods/payments/hand/lang/' . CONF_LANGUAGE . '/hand.lang.php';
require_once 'core/mods/payments/hand/lang/' . CONF_LANGUAGE . '/lang._custom.php';
require_once 'core/mods/payments/hand/classes/hand.class.php';

$modMenu[] = array('id' => 'hand', 'action' => 'config', 'icon' => 'config.png', 'text' => MENU_CONFIG);
$modMenu[] = array('id' => 'hand', 'action' => 'lt', 'icon' => 'langManager.png', 'text' => MENU_LANGUAGE_MANAGER);
$modMenu[] = array('id' => 'hand', 'action' => 'payments', 'icon' => 'wait_payment.png', 'text' => MENU_ACTION_PAYMENTS);


if ($arrActions['config']) {
	$smarty -> assignByRef('paymentTypes', $handPaymentTypes);

	/**
	* Сохраняем настройки самого мода
	*/
	if (isset($_POST['config'])) {
		$arrPayTypes = array_combine($_POST['arrPayTypes']['index'], $_POST['arrPayTypes']['value']);

		$data = "<?php\n\n"
			  . "(!defined('SDG')) ? die ('Triple protection!') : null;\n\n"
			  .	'$handPaymentTypes = array(' . "\n";

		foreach ($arrPayTypes as $key => $value) {
			  (!empty($key) && !empty($value)) ? $arrData[] = "	'" . $key . "'	=> '" . $value . "'" : null;
		}

		$data .=  implode(",\n", $arrData) . "\n);\n\n";

		$data .= (!empty($_POST['currency'])) ? 'define("HAND_CONF_CURRENCY", "' . $_POST['currency'] . '");' : 'define("HAND_CONF_CURRENCY", "USD");';

		if (!tools::saveConfig('core/mods/payments/hand/conf/hand.conf.php', $data, CONF_ADMIN_FILE . '?m=mods&s=payments&action=config&id=hand')) {
			$arrErrors[] = ERROR_FILES_MISSING_FILE;
		}
	}
}
elseif ($arrActions['payments']) {
	// создаем объект
	$hand = new hand();

	$retFields = array('order_id' => false);
	// Filter
	if (isset($_GET['do']) && $_GET['do'] === 'filter' && !empty($_GET['order_id'])) {
		$_GET['order_id'] = urldecode($_GET['order_id']);

		if (is_int($_GET['order_id'])) {
			$strWhereOrderId = " AND order_id IN (" . secure::escQuoteData($_GET['order_id']) . ")";
		} else {
			$orderId = str_replace(array('*', '?'), array('%', '_'), $_GET['order_id']);
			$strWhereOrderId = " AND order_id LIKE " . secure::escQuoteData($orderId);
		}

		$retFields['order_id'] = $_GET['order_id'];
		// строка для урла с отбором
		$filterString = '&amp;order_id=' . $_GET['order_id'];
	} else {
		$strWhereOrderId = '';
		// строка для урла с отбором
		$filterString = '';
	}

	/**
	* Действия
	* Множественное удаление записей
	*/
	if (!empty($_POST['action'])) {
		// множественное удаление
		if ('del' === $_POST['action'] && !empty($_POST['payment'])) {
			$arrIds = array_keys($_POST['payment']);
			($hand -> deleteRecordsById($arrIds)) ? messages::messageChangeSaved(MESSAGE_CHANGE_SAVED, false, CONF_ADMIN_FILE . '?m=mods&s=payments&action=payments&id=hand' . $filterString) : $arrErrors[] = db::$message_error;
		}
        // Единичное удаление
		elseif ('delete' === $_POST['action'] && !empty($_POST['paymentData']['id']) && !empty($_POST['paymentData']['user_id']) && !empty($_POST['message'])) {
			$user = new user();
			$strWhere = "id IN (" . secure::escQuoteData($_POST['paymentData']['user_id']) . ")";

			if ($userData = $user -> getUser($strWhere)) {
				$_POST['message'] = nl2br($_POST['message']);
				($hand -> deletePayment($_POST['paymentData']['id'], $userData['email'], $_POST['message'])) ? messages::messageChangeSaved(MESSAGE_CHANGE_SAVED, false, CONF_ADMIN_FILE . '?m=mods&s=payments&action=payments&id=hand' . $filterString) : $arrErrors[] = db::$message_error;
			}
		}
        // Отправка платежа в обработку
		elseif ('processing' === $_POST['action'] && !empty($_POST['paymentData']['id']) && !empty($_POST['paymentData']['user_id']) && !empty($_POST['message'])) {
			$user = new user();
			$strWhere = "id IN (" . secure::escQuoteData($_POST['paymentData']['user_id']) . ")";

			if ($userData = $user -> getUser($strWhere)) {
				$_POST['message'] = nl2br($_POST['message']);
				($hand -> processingPayment($_POST['paymentData']['id'], $userData['email'], $_POST['message'], $_POST['arrFiles'])) ? messages::messageChangeSaved(MESSAGE_CHANGE_SAVED, false, CONF_ADMIN_FILE . '?m=mods&s=payments&action=payments&id=hand' . $filterString) : $arrErrors[] = db::$message_error;
			}
		}
        // Закрытие платежа
		elseif ('close' === $_POST['action'] && !empty($_POST['paymentData']['id'])
				&& !empty($_POST['paymentData']['user_id']) && !empty($_POST['message']) && !empty($_POST['paymentData']['action'])) {

			$user = new user();
			$strWhere = "id IN (" . secure::escQuoteData($_POST['paymentData']['user_id']) . ")";

			if ($userData = $user -> getUser($strWhere)) {
				// Собираем массив всех необходимых данных

				$_POST['message'] = nl2br($_POST['message']);
				($hand -> closePayment($_POST['paymentData'], $userData['email'], $_POST['message'])) ? messages::messageChangeSaved(MESSAGE_CHANGE_SAVED, false, CONF_ADMIN_FILE . '?m=mods&s=payments&action=payments&id=hand' . $filterString) : $arrErrors[] = db::$message_error;
			}
		}
	}

	$arrOrderBy = array('datetime' => 'DESC');
	$strWhere = "token IN ('active', 'processing')" . $strWhereOrderId;
	if ($arrHandPayments = $hand -> getRecords($strWhere, $arrOrderBy, false, false)) {
		foreach ($arrHandPayments as $key => $value) {
			$arrHandPayments[$key]['description'] = $payments -> generatePaymentDescription($value['action']);
		}
	}

	$smarty -> assignByRef('arrHandPayments', $arrHandPayments);
	$smarty -> assign('paymentsTemplate', SD_ROOT_DIR . 'core/mods/payments/hand/templates/adm.hand.payments.tpl');
	$smarty -> assignByRef('paymentTypes', $handPaymentTypes);
	$smarty -> assignByRef('retFields', $retFields);
	$smarty -> assignByRef('filterString', $filterString);
}
