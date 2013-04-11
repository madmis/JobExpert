<?php
/********************************************************
	JobExpert v1.0
	powered by Script Developers Group (SD-Group)
	email: info@sd-group.org.ua
	url: http://sd-group.org.ua/
	Copyright 2010-2015 (c) SD-Group
	All rights reserved
=========================================================
	Главная страница модуля a1pay
********************************************************/
/**
* @package
* @todo
*/

(!defined('SDG')) ? die ('Triple protection!') : null;

$pathToMod = 'core/mods/payments/a1pay/';
require_once $pathToMod . 'conf/a1pay.numbers.php';
require_once $pathToMod . 'classes/a1pay.class.php';

// скрытый ответ от a1pay
if (isset($_GET['process']) && !empty($_GET['sign'])) {
	// уведомление о проведенном платеже
	$params = a1pay::getParams($_GET);
	if (a1pay::checkResultParams($params)) {
        // логируем ответ в файл
        $logData = logs::logPaymentData($params, 'SUCCESS', 'a1pay');

        // выполняем необходимые действия
		$ourData = a1pay::getOurData($params['msg']);
		$payments -> doAction($ourData[0], $ourData[1], a1pay::generateLogData($params, 'SUCCESS'), $params['order_id']);
        $payments -> sendAdminEmail($logData, 'SUCCESS');
		// Фомируем ответ для абонента
		header("HTTP/1.0 200 Ok");
		print 'smsid:' . $params['smsid'] . "\n"
			. 'status:reply' . "\n\n"
			. 'Usluga oplachena i vipolnena. Order id: ' . $params['order_id'] . "\n";
		exit;
	} else {
        // логируем ответ в файл
        $logData = logs::logPaymentData($params, 'FAIL', 'a1pay');

		/* @var $payments payments */
		$payments->logPayment(a1pay::generateLogData($params, 'FAIL'), $params['order_id']);
        $payments -> sendAdminEmail($logData, 'FAIL');
		// Фомируем ответ для абонента
		header("HTTP/1.0 404 Not Found");
		print 'smsid:' . $params['smsid'] . "\n"
			. 'status:reply' . "\n\n"
			. 'Usluga ne vipolnena. Nevernie parametry SMS. Order id: ' . $params['order_id'] . "\n";
		exit;
	}
} else {
	// проверяем наличие в сессии необходимых параметров и установлена ли цена в тарифной сетке для выбранной услуги
	if (isset($_SESSION['payment']) &&  isset($_SESSION['payment']['service'])) {
		
		$data = array(
			'number' => $arrNumbers[$_SESSION['payment']['service']],
			'description' => $payments -> generatePaymentDescription($_SESSION['payment']['service']),
			'sms' => A1PAY_CONF_PREFIX . ' ' . $_SESSION['payment']['id']. a1pay::$idDelimiter . a1pay::$serviceCodes[$_SESSION['payment']['service']],
		);

		$smarty -> assignByRef('data', $data);
		$smarty -> assign('include_template', SD_ROOT_DIR . 'core/mods/payments/a1pay/templates/a1pay.pay.form.tpl');
	} else {
		$arrErrors[] = ERROR_PAY_SYSTEM_NOT_DEFINE_PRICE;
	}
}
