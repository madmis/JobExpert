<?php
/********************************************************
	JobExpert v1.0
	powered by Script Developers Group (SD-Group)
	email: info@sd-group.org.ua
	url: http://sd-group.org.ua/
	Copyright 2010-2015 (c) SD-Group
	All rights reserved
=========================================================
	Главная страница модуля Hand
********************************************************/
/**
* @package
* @todo
*/

(!defined('SDG')) ? die ('Triple protection!') : null;

// создаем объект
$hand = new hand();

// ответ пользователю
if (isset($_GET['result']) && !empty($_POST)) {

} else {
	// проверяем наличие в сессии необходимых параметров и установлена ли цена в тарифной сетке для выбранной услуги
	if (isset($_SESSION['payment'])
			&& isset($_SESSION['payment']['service']) && $payments -> checkPriceInTariff($_SESSION['payment']['service'], $arrTariffs)
			&& !empty($_SESSION['payment']['id'])) {

		// Сохраняем запрос оплаты
		if (isset($_POST['pay'])) {
			if (validate::postDataNotEmpty()) {
				// заполняем обязательные поля
				$hand -> arrBindFields = array(
					'order_id'		=> $_POST['order_id'],
					'action'		=> $_SESSION['payment']['service'],
					'user_id'		=> $_SESSION['sd_user']['data']['id'],
					'record_id'		=> $_SESSION['payment']['id'],
					'amount'		=> $_POST['amount'],
					'currency'		=> HAND_CONF_CURRENCY,
					'payment_type'	=> $_POST['payment']
				);

				// заполняем дополнительные поля
				$hand -> additionalFields = array(
					'description'		=> $payments -> generatePaymentDescription($_SESSION['payment']['service']),
					'payment_type_desc'	=> $handPaymentTypes[$_POST['payment']]
				);

				if (!$hand -> recRecord()) {
					$arrErrors[] = ERROR_UNABLE_PERFORM_OPERATION;
				} else {
					unset($_SESSION['payment']);
					messages::messageChangeSaved(MESSAGE_PYMENT_SUCCESSFULLY_ADDED, false, chpu::createChpuUrl(CONF_SCRIPT_URL . 'index.php?ut=' . $_SESSION['sd_user'][DB_PREFIX . 'conf']['user_type'] . '&amp;do=user.data'));
				}
			} else {
				$arrErrors[] = HAND_ERROR_NOT_ALL_PAYMENT_DETAILS;
			}
		}

		$arrData = array(
			'order_id'		=> time(),
			'amount'		=> $arrTariffs[$_SESSION['payment']['service']],
			'description'	=> $payments -> generatePaymentDescription($_SESSION['payment']['service'])
		);	

		$smarty -> assignByRef('arrData', $arrData);
		$smarty -> assignByRef('handPaymentTypes', $handPaymentTypes);
		$smarty -> assign('include_template', SD_ROOT_DIR . 'core/mods/payments/hand/templates/hand.pay.form.tpl');
	} else {
		$arrErrors[] = ERROR_PAY_SYSTEM_NOT_DEFINE_PRICE;
	}
}

