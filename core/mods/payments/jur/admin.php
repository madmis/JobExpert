<?php
/********************************************************
	JobExpert v1.0
	powered by Script Developers Group (SD-Group)
	email: info@sd-group.org.ua
	url: http://sd-group.org.ua/
	Copyright 2010-2015 (c) SD-Group
	All rights reserved
=========================================================
	Модуль оплаты - JUR - Админка
********************************************************/
/**
* @package
* @todo
*/

(!defined('SDG')) ? die ('Triple protection!') : null;

require_once 'core/mods/payments/jur/lang/' . CONF_LANGUAGE . '/adm.jur.lang.php';
require_once 'core/mods/payments/jur/lang/' . CONF_LANGUAGE . '/jur.lang.php';
require_once 'core/mods/payments/jur/lang/' . CONF_LANGUAGE . '/lang._custom.php';
require_once 'core/mods/payments/jur/classes/jur.class.php';

$modMenu[] = array('id' => 'jur', 'action' => 'config', 'icon' => 'config.png', 'text' => MENU_CONFIG);
$modMenu[] = array('id' => 'jur', 'action' => 'lt', 'icon' => 'langManager.png', 'text' => MENU_LANGUAGE_MANAGER);
$modMenu[] = array('id' => 'jur', 'action' => 'mt', 'icon' => 'managerTemplates.png', 'text' => MENU_MANAGER_TEMPLATES);
$modMenu[] = array('id' => 'jur', 'action' => 'payments', 'icon' => 'wait_payment.png', 'text' => MENU_ACTION_PAYMENTS);

if ($arrActions['payments']) {
	// создаем объект
	$jur = new jur();

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
	*/
	if (!empty($_POST['action'])) {
		// множественное удаление
		if ('del' === $_POST['action'] && !empty($_POST['payment'])) {
			$arrIds = array_keys($_POST['payment']);
			if ($jur -> deleteRecordsById($arrIds)) {
				messages::messageChangeSaved(MESSAGE_CHANGE_SAVED, false, CONF_ADMIN_FILE . '?m=mods&s=payments&action=payments&id=jur' . $filterString);
			} else {
				$arrErrors[] = db::$message_error;
			}
		}
        // Единичное удаление
		elseif ('delete' === $_POST['action'] && !empty($_POST['paymentData']['id'])) {
			// Если есть пользователь, отсылаем ему сообщение
		 	if (!empty($_POST['paymentData']['user_id']) && !empty($_POST['message'])) {
				$user = new user();
				$strWhere = "id IN (" . secure::escQuoteData($_POST['paymentData']['user_id']) . ")";

				if ($userData = $user -> getUser($strWhere)) {
					$_POST['message'] = nl2br($_POST['message']);
					if ($jur -> deletePayment($_POST['paymentData']['id'], $userData['email'], $_POST['message'])) {
						messages::messageChangeSaved(MESSAGE_CHANGE_SAVED, false, CONF_ADMIN_FILE . '?m=mods&s=payments&action=payments&id=jur' . $filterString);
					} else {
						$arrErrors[] = db::$message_error;
					}
				}
			} else {
				// Выполняем множественное удаление
				$arrIds = array($_POST['paymentData']['id']);
				if ($jur -> deleteRecordsById($arrIds)) {
					messages::messageChangeSaved(MESSAGE_CHANGE_SAVED, false, CONF_ADMIN_FILE . '?m=mods&s=payments&action=payments&id=jur' . $filterString);
				} else {
					$arrErrors[] = db::$message_error;
				}
			}
		}
        // Закрытие платежа
		elseif ('close' === $_POST['action'] && !empty($_POST['paymentData']['id']) && !empty($_POST['paymentData']['action'])) {

			if (!empty($_POST['paymentData']['user_id']) && !empty($_POST['message']) ) {
				$user = new user();
				$strWhere = "id IN (" . secure::escQuoteData($_POST['paymentData']['user_id']) . ")";

				if ($userData = $user -> getUser($strWhere)) {
					// Собираем массив всех необходимых данных
					$_POST['message'] = nl2br($_POST['message']);
					if ($jur -> closePayment($_POST['paymentData'], $userData['email'], $_POST['message'])) {
						messages::messageChangeSaved(MESSAGE_CHANGE_SAVED, false, CONF_ADMIN_FILE . '?m=mods&s=payments&action=payments&id=jur' . $filterString);
					} else {
						$arrErrors[] = db::$message_error;
					}
				}
			} else {
				// Выполняем множественное удаление
				if ($jur -> closePayment($_POST['paymentData'], false, false)) {
					messages::messageChangeSaved(MESSAGE_CHANGE_SAVED, false, CONF_ADMIN_FILE . '?m=mods&s=payments&action=payments&id=jur' . $filterString);
				} else {
					$arrErrors[] = db::$message_error;
				}
			}
		}
	}

	$arrOrderBy = array('datetime' => 'DESC');
	$strWhere = "token IN ('active', 'processing')" . $strWhereOrderId;

	if ($arrJurPayments = $jur -> getRecords($strWhere, $arrOrderBy, false, false)) {
		foreach ($arrJurPayments as $key => $value) {
			$arrJurPayments[$key]['description'] = $payments -> generatePaymentDescription($value['action']);
			// Обрабатываем поле data
			$arrJurPayments[$key]['data'] = unserialize($value['data']);
		}
	}

	$smarty -> assignByRef('arrJurPayments', $arrJurPayments);
	$smarty -> assign('paymentsTemplate', SD_ROOT_DIR . 'core/mods/payments/jur/templates/adm.jur.payments.tpl');
	$smarty -> assignByRef('retFields', $retFields);
	$smarty -> assignByRef('filterString', $filterString);
}
/**
* Настройка шаблонов мода
*/
elseif ($arrActions['mt']) {
	$listTemplates = array(
		array('id' => 'JUR_PAY_FORM_TPL', 'name' => 'jur.pay.form.tpl', 'desc' => JUR_HELP_TEMPLATE_DESCRIPTION_JUR_PAY_FORM_TPL),
		array('id' => 'JUR_RECEIPT_TPL', 'name' => 'jur.receipt.tpl',  'desc' => JUR_HELP_TEMPLATE_DESCRIPTION_JUR_RECEIPT_TPL),
	);

	$smarty -> assignByRef('listTemplates', $listTemplates);
	$smarty -> assign('mtTemplate', SD_ROOT_DIR . 'core/mods/payments/jur/templates/adm.jur.mt.tpl');
}