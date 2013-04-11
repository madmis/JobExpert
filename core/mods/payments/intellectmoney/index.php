<?php

/* * ******************************************************
  JobExpert v1.0
  powered by Script Developers Group (SD-Group)
  email: info@sd-group.org.ua
  url: http://sd-group.org.ua/
  Copyright 2010-2015 (c) SD-Group
  All rights reserved
  =========================================================
  Главная страница модуля intellectmoney
 * ****************************************************** */
/**
 * @package
 * @todo
 */
(!defined('SDG')) ? die('Triple protection!') : null;

// скрытый ответ от intellectmoney
if (isset($_GET['result']) && !empty($_POST)) {
	if (isset($_POST['LMI_PREREQUEST']) && $_POST['LMI_PREREQUEST']) {

		if (intellectmoney::checkPreResultParams($_POST, $arrTariffs)) {
			echo 'YES';
            exit;
		} else {
			echo 'WRONG PARAMS';
            exit;
		}
	}
	// уведомление о проведенном платеже
	elseif (!empty($_POST['LMI_SYS_INVS_NO']) && !empty($_POST['LMI_SYS_TRANS_NO'])) {

		if (intellectmoney::checkResultParams($_POST, $arrTariffs)) {
			// логируем ответ в файл
			$logData = logs::logPaymentData($_POST, 'SUCCESS', 'intellectmoney');

			// выполняем необходимые действия
			$ourData = $payments->explodeServiceString($_POST['SERVICE']);
			$payments->doAction($ourData[0], $ourData[1], intellectmoney::generateLogData($_POST, 'SUCCESS'), $_POST['LMI_PAYMENT_NO']);
			$payments->sendAdminEmail($logData, 'SUCCESS');
			header("HTTP/1.0 200");
			exit;
		} else {
			// логируем ответ в файл
			$logData = logs::logPaymentData($_POST, 'FAIL', 'intellectmoney');

			// выполняем необходимые действия
			$ourData = $payments->explodeServiceString($_POST['SERVICE']);
			/* @var $payments payments */
			$payments->logPayment(intellectmoney::generateLogData($_POST, 'FAIL'), $_POST['LMI_PAYMENT_NO']);
			$payments->sendAdminEmail($logData, 'FAIL');
			header("HTTP/1.0 404 Not Found");
			exit;
		}
	} else {
		// если неверные параметры платежа
		// логируем ответ в файл
		logs::logPaymentData($_POST, 'WRONG PARAMS', 'intellectmoney');
		header("HTTP/1.0 404 Not Found");
		die();
	}
}
// оплата прошла успешно
elseif (isset($_GET['success'])) {
	if (!empty($_SESSION['payment']['service'])) {
		$payments->succesAnswer($_SESSION['payment']['service']);
	} else {
		messages::messageChangeSaved(MESSAGE_PYMENT_WAS_SUCCESS, false, 'index.php', 5000);
	}
}
// оплата не прошла
elseif (isset($_GET['fail'])) {
	$smarty->assign('include_template', SD_ROOT_DIR . 'core/mods/payments/intellectmoney/templates/intellectmoney.fail.tpl');
// оплата не прошла
}
elseif (isset($_GET['back'])) {
	$smarty->assign('include_template', SD_ROOT_DIR . 'core/mods/payments/intellectmoney/templates/intellectmoney.back.tpl');
} else {
	// проверяем наличие в сессии необходимых параметров и установлена ли цена в тарифной сетке для выбранной услуги
	if (isset($_SESSION['payment']) && isset($_SESSION['payment']['service'])
			&& $payments->checkPriceInTariff($_SESSION['payment']['service'], $arrTariffs)) {

		$imData = array(
			'amount' => $arrTariffs[$_SESSION['payment']['service']],
			'order_id' => time(),
			'description' => $payments->generatePaymentDescription($_SESSION['payment']['service']),
			// сервисное поле. Наше. В поле хранится: наименование услуги и id строки в БД, с которой необходимо произвести действие,
			// разделеннные двойным двоеточием (::) $_SESSION['payment']['service']::$_SESSION['payment']['id']
			'service' => $_SESSION['payment']['service'] . '::' . $_SESSION['payment']['id']
		);

		$smarty->assignByRef('imData', $imData);
		$smarty->assign('include_template', SD_ROOT_DIR . 'core/mods/payments/intellectmoney/templates/intellectmoney.pay.form.tpl');
	} else {
		$arrErrors[] = ERROR_PAY_SYSTEM_NOT_DEFINE_PRICE;
	}
}
