<?php
/********************************************************
	JobExpert v1.0
	powered by Script Developers Group (SD-Group)
	email: info@sd-group.org.ua
	url: http://sd-group.org.ua/
	Copyright 2010-2015 (c) SD-Group
	All rights reserved
=========================================================
	Главная страница модуля SMSCoin (SMS:Bank)
********************************************************/
/**
* @package
* @todo
*/

(!defined('SDG')) ? die ('Triple protection!') : null;

// скрытый ответ от SMSCoin
if (isset($_GET['server']) && !empty($_POST)) {
	// проверяем существование параметров
	if (smscoin::checkResultParams($_POST)) {
        // логируем ответ в файл
        $logData = logs::logPaymentData($_POST, 'SUCCESS', 'SMSCoin');
        $payments -> sendAdminEmail($logData, 'SUCCESS');

        // выполняем необходимые действия
		$ourData = $payments -> explodeServiceString($_POST['sd_service']);
		$payments -> doAction($ourData[0], $ourData[1], smscoin::generateLogData($_POST, 'SUCCESS'), $_POST['s_order_id']);
	} else {
		// логируем ответ в файл
		$logData = logs::logPaymentData($_POST, 'WRONG PARAMS', 'SMSCoin');
		$payments -> sendAdminEmail($logData, 'WRONG PARAMS');
	}
}
// оплата прошла успешно
elseif (isset($_GET['success']) && !empty($_POST)) {
	if (smscoin::checkStatusParams($_POST)) {
		$ourData = $payments -> explodeServiceString($_POST['sd_service']);
		$payments -> succesAnswer($ourData[0]);
	}	
}
// оплата не прошла
elseif (isset($_GET['fail']) && !empty($_POST)) {
	if (smscoin::checkStatusParams($_POST)) {
        // логируем ответ в файл
        $logData = logs::logPaymentData($_POST, 'FAIL', 'SMSCoin');
        $payments -> sendAdminEmail($logData, 'FAIL');

		$smarty -> assignByRef('order_id', $_POST['s_order_id']);
		$smarty -> assignByRef('amount', $_POST['s_amount']);
		$smarty -> assign('include_template', SD_ROOT_DIR . 'core/mods/payments/smscoin/templates/smscoin.fail.tpl');
	}	
} else {
	// проверяем наличие в сессии необходимых параметров и установлена ли цена в тарифной сетке для выбранной услуги
	if (isset($_SESSION['payment']) &&  isset($_SESSION['payment']['service'])
			&& $payments -> checkPriceInTariff($_SESSION['payment']['service'], $arrTariffs)) {

		$smsData = array(
			'order_id'		=> time(),
			'amount'		=> $arrTariffs[$_SESSION['payment']['service']],
			'clear_amount'	=> 0,
			'description'	=> $payments -> generatePaymentDescription($_SESSION['payment']['service']),
			// сервисное поле. Наше. В поле хранится: наименование услуги и id строки в БД, с которой необходимо произвести действие,
			// разделеннные двойным двоеточием (::) $_SESSION['payment']['service']::$_SESSION['payment']['id']
			'service'		=> $_SESSION['payment']['service'] . '::' . $_SESSION['payment']['id']
		);

	    $smsData['sign'] = smscoin::refSign(array(SMSCOIN_CONF_BANK_ID, $smsData['order_id'], $smsData['amount'], $smsData['clear_amount'], $smsData['description'], SMSCOIN_CONF_BANK_SECRET_CODE));
		$smarty -> assignByRef('smsData', $smsData);
		$smarty -> assign('include_template', SD_ROOT_DIR . 'core/mods/payments/smscoin/templates/smscoin.pay.form.tpl');
	} else {
		$arrErrors[] = ERROR_PAY_SYSTEM_NOT_DEFINE_PRICE;
	}
}
