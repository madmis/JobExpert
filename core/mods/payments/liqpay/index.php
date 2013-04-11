<?php
/********************************************************
	JobExpert v1.0
	powered by Script Developers Group (SD-Group)
	email: info@sd-group.org.ua
	url: http://sd-group.org.ua/
	Copyright 2010-2015 (c) SD-Group
	All rights reserved
=========================================================
	Главная страница модуля LiqPay
********************************************************/
/**
* @package
* @todo
*/

(!defined('SDG')) ? die ('Triple protection!') : null;

// скрытый ответ от LiqPay
// ответ серверу
if (isset($_GET['server']) && !empty($_POST)) {
	if (isset($_POST['operation_xml']) && !empty($_POST['operation_xml'])
			&& isset($_POST['signature']) && !empty($_POST['signature'])) {

		// проверяем существование параметров
		$arrResponse = liqpay::checkResultParams($_POST['operation_xml'], $_POST['signature'], LIQPAY_CONF_SIGNATURE);
		if ($arrResponse['status']) {
			switch ($arrResponse['data']['status']) {
				case 'success':
			        // логируем ответ в файл
			        $logData = logs::logPaymentData($arrResponse['data'], 'SUCCESS', 'liqpay');
			        $payments -> sendAdminEmail($logData, 'SUCCESS');

			        // выполняем необходимые действия
					$ourData = $payments -> explodeServiceString($arrResponse['data']['service']);
					$payments -> doAction($ourData[0], $ourData[1], liqpay::generateLogData($arrResponse['data'], 'SUCCESS'), $arrResponse['data']['order_id']);
					break;

				case 'failure':
				case 'wait_secure':
				default:
			        // логируем ответ в файл
			        $logData = logs::logPaymentData($arrResponse['data'], 'FAIL', 'liqpay');
			        $payments -> sendAdminEmail($logData, 'FAIL');
					break;
			}
		} else {
			// логируем ответ в файл
			$logData = logs::logPaymentData($arrResponse['data'], 'WRONG PARAMS', 'liqpay');
			$payments -> sendAdminEmail($logData, 'WRONG PARAMS');
	    }
	}
}
// ответ пользователю
elseif (isset($_GET['result']) && !empty($_POST)) {
	if (isset($_POST['operation_xml']) && !empty($_POST['operation_xml']) && isset($_POST['signature']) && !empty($_POST['signature'])) {
		// проверяем существование параметров
		$arrResponse = liqpay::checkResultParams($_POST['operation_xml'], $_POST['signature'], LIQPAY_CONF_SIGNATURE);
		// если статус false, значит сигнатура не совпадает
		if ($arrResponse['status']) {
			if ('success' === $arrResponse['data']['status']) {
				$ourData = $payments -> explodeServiceString($arrResponse['data']['service']);
				$payments -> succesAnswer($ourData[0]);
			} else {
				$smarty -> assignByRef('status', $arrResponse['data']['status']);
				$smarty -> assignByRef('order_id', $arrResponse['data']['order_id']);
				$smarty -> assignByRef('amount', $arrResponse['data']['amount']);
				$smarty -> assign('include_template', SD_ROOT_DIR . 'core/mods/payments/liqpay/templates/liqpay.result.tpl');
			}
		} else {
			$arrErrors[] = LIQPAY_PAY_ANSWER_ERROR_UNMATCHED;
		}
	}
} else {
	// проверяем наличие в сессии необходимых параметров и установлена ли цена в тарифной сетке для выбранной услуги
	if (isset($_SESSION['payment']) && isset($_SESSION['payment']['service'])
			&& $payments -> checkPriceInTariff($_SESSION['payment']['service'], $arrTariffs)) {

		$lpData = array(
			'order_id'		=> time(),
			'amount'		=> $arrTariffs[$_SESSION['payment']['service']],
			'description'	=> $payments -> generatePaymentDescription($_SESSION['payment']['service'])
		);	

		$xml = '<request>'
			 . '<version>' . LIQPAY_CONF_API_VERSION . '</version>'
			 . '<result_url>' . filesys::setPath(CONF_SCRIPT_URL) . 'index.php?ut=competitor&amp;do=payments&amp;mod=liqpay&amp;result</result_url>'
			 . '<server_url>' . filesys::setPath(CONF_SCRIPT_URL) . 'index.php?ut=competitor&amp;do=payments&amp;mod=liqpay&amp;server</server_url>'
			 . '<merchant_id>' . LIQPAY_CONF_MERCHANT_ID . '</merchant_id>'
			 . '<order_id>' . $_SESSION['payment']['service'] . '::' . $_SESSION['payment']['id'] . '.' . $lpData['order_id'] . '</order_id>'
			 . '<amount>' . $lpData['amount'] . '</amount>'
			 . '<currency>' . LIQPAY_CONF_CURRENCY . '</currency>'
			 . '<description>' . $lpData['description'] . '</description>'
			 . '<default_phone></default_phone>'
			 . '<pay_way></pay_way>'
			 . '</request>';

		$smarty -> assign('operation_xml', base64_encode($xml));
		$smarty -> assign('signature', liqpay::refSign(array($xml, LIQPAY_CONF_SIGNATURE)));
		$smarty -> assignByRef('lpData', $lpData);
		$smarty -> assign('include_template', SD_ROOT_DIR . 'core/mods/payments/liqpay/templates/liqpay.pay.form.tpl');
	} else {
		$arrErrors[] = ERROR_PAY_SYSTEM_NOT_DEFINE_PRICE;
	}
}

