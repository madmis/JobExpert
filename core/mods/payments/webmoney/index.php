<?php
/********************************************************
	JobExpert v1.0
	powered by Script Developers Group (SD-Group)
	email: info@sd-group.org.ua
	url: http://sd-group.org.ua/
	Copyright 2010-2015 (c) SD-Group
	All rights reserved
=========================================================
	Главная страница модуля WebMoney
********************************************************/
/**
* @package
* @todo
*/

(!defined('SDG')) ? die ('Triple protection!') : null;

// данная часть кода необходима для правильной кодировки
if (isset($_POST['LMI_PAYMENT_DESC']) && $_POST['LMI_PAYMENT_DESC']) {
	$_POST['LMI_PAYMENT_DESC'] = html_entity_decode(strings::encodingString($_POST['LMI_PAYMENT_DESC'], CONF_DEFAULT_CHARSET), false, CONF_DEFAULT_CHARSET);
}

// скрытый ответ от SMSCoin
if (isset($_GET['result']) && !empty($_POST)) {
	// предварительное уведомление о платеже
	if (isset($_POST['LMI_PREREQUEST']) && $_POST['LMI_PREREQUEST']) {

		if (webmoney::checkPreResultParams($_POST, $arrTariffs)) {
			logs::logPaymentData($_POST, 'LMI_PREREQUEST SUCCESS', 'webmoney');
			echo 'YES';
            exit;
		} else {
			logs::logPaymentData($_POST, 'LMI_PREREQUEST WRONG PARAMS', 'webmoney');
			echo 'WRONG PARAMS';
            exit;
		}
	}
	// уведомление о проведенном платеже
	elseif (isset($_POST['LMI_SYS_INVS_NO']) && $_POST['LMI_SYS_INVS_NO'] && isset($_POST['LMI_SYS_TRANS_NO']) && $_POST['LMI_SYS_TRANS_NO']) {

		if (webmoney::checkResultParams($_POST, $arrTariffs)) {
	        // логируем ответ в файл
	        $logData = logs::logPaymentData($_POST, 'SUCCESS', 'webmoney');

	        // выполняем необходимые действия
			$ourData = $payments -> explodeServiceString($_POST['SERVICE']);
			$payments -> doAction($ourData[0], $ourData[1], webmoney::generateLogData($_POST, 'SUCCESS'), $_POST['LMI_PAYMENT_NO']);
	        $payments -> sendAdminEmail($logData, 'SUCCESS');
		} else {
	        // логируем ответ в файл
	        $logData = logs::logPaymentData($_POST, 'FAIL', 'webmoney');

	        // выполняем необходимые действия
			$ourData = $payments -> explodeServiceString($_POST['SERVICE']);
			$payments -> doAction($ourData[0], $ourData[1], webmoney::generateLogData($_POST, 'FAIL'), $_POST['LMI_PAYMENT_NO']);
	        $payments -> sendAdminEmail($logData, 'FAIL');
		}
	} else {
		// если неверные параметры платежа
		// логируем ответ в файл
		logs::logPaymentData($_POST, 'WRONG PARAMS', 'webmoney');
    }
}
// оплата прошла успешно
elseif (isset($_GET['success']) && !empty($_POST)) {
	if (isset($_POST['SERVICE']) && $_POST['SERVICE']) {
		$ourData = $payments -> explodeServiceString($_POST['SERVICE']);
		$payments -> succesAnswer($ourData[0]);
	}	
}
// оплата не прошла
elseif (isset($_GET['fail']) && !empty($_POST)) {
    if (isset($_POST['LMI_PAYMENT_NO']) && $_POST['LMI_PAYMENT_NO']) {
		$smarty -> assignByRef('order_id', $_POST['LMI_PAYMENT_NO']);
		$smarty -> assign('include_template', SD_ROOT_DIR . 'core/mods/payments/webmoney/templates/webmoney.fail.tpl');
	}	
} else {
	// проверяем наличие в сессии необходимых параметров и установлена ли цена в тарифной сетке для выбранной услуги
	if (isset($_SESSION['payment']) &&  isset($_SESSION['payment']['service'])
			&& $payments -> checkPriceInTariff($_SESSION['payment']['service'], $arrTariffs)) {

		$wmData = array(
			'amount'		=> $arrTariffs[$_SESSION['payment']['service']],
			'order_id'		=> time(),
			'description'	=> $payments -> generatePaymentDescription($_SESSION['payment']['service']),
			// этот параметр необходим для передачи описания товара вебманям в кодировке UTF-8
			'description64'	=> base64_encode($payments -> generatePaymentDescription($_SESSION['payment']['service'])),
			// сервисное поле. Наше. В поле хранится: наименование услуги и id строки в БД, с которой необходимо произвести действие,
			// разделеннные двойным двоеточием (::) $_SESSION['payment']['service']::$_SESSION['payment']['id']
			'service'		=> $_SESSION['payment']['service'] . '::' . $_SESSION['payment']['id']
		);	

		$smarty -> assignByRef('wmData', $wmData);
		$smarty -> assign('include_template', SD_ROOT_DIR . 'core/mods/payments/webmoney/templates/webmoney.pay.form.tpl');
	} else {
		$arrErrors[] = ERROR_PAY_SYSTEM_NOT_DEFINE_PRICE;
	}
}
