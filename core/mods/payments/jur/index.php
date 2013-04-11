<?php
/********************************************************
	JobExpert v1.0
	powered by Script Developers Group (SD-Group)
	email: info@sd-group.org.ua
	url: http://sd-group.org.ua/
	Copyright 2010-2015 (c) SD-Group
	All rights reserved
=========================================================
	Главная страница модуля Jur (Юр. лица)
********************************************************/
/**
* @package
* @todo
*/

(!defined('SDG')) ? die ('Triple protection!') : null;

// создаем объект
$jur = new jur();

// ответ пользователю
if (isset($_GET['result']) && !empty($_POST)) {
	
}
elseif (isset($_GET['print']) && !empty($_SESSION['jur']['print'])) {
	// передаем TITLE страницы в Smarty
	$smarty->assign('page_title', (!empty($arrTitle)) ? strings::formTitle($arrTitle) : strings::formTitle($arrNamePage));
	$smarty->assign('printVar', $_SESSION['jur']['print']);
	$smarty->display('main.print.tpl');
	exit;
} else {
	// проверяем наличие в сессии необходимых параметров и установлена ли цена в тарифной сетке для выбранной услуги
	if (!empty($_SESSION['payment']) && is_array($_SESSION['payment']) && !empty($_SESSION['payment']['service'])
			&& $payments -> checkPriceInTariff($_SESSION['payment']['service'], $arrTariffs) && !empty($_SESSION['payment']['id'])) {

		// Сохраняем запрос оплаты
		if (isset($_POST['pay']) && (!empty($_POST['arrBindFields']) || !empty($_POST['arrNoBindFields']))) {
			if (!empty($_POST['arrBindFields']) && !validate::arrDataNotEmpty($_POST['arrBindFields'])) {
				$arrErrors[] = ERROR_EMPTY_BIND_FIELDS;

				$smarty -> assignByRef('arrData', $_SESSION['jur']['data']);
				$smarty -> assign('include_template', SD_ROOT_DIR . 'core/mods/payments/jur/templates/jur.pay.form.tpl');
			} else {
				// В обработку полей добавить кодирование в html-мнемоники и кавычки тоже (htmlspecialchars)
				if (!empty($_POST['arrBindFields'])) {
					$_POST['arrBindFields'] = $jur -> htmlSpecChars($_POST['arrBindFields']);
				} else {
					$_POST['arrBindFields'] = array();
				}
				if (!empty($_POST['arrNoBindFields'])) {
					$_POST['arrNoBindFields'] = $jur -> htmlSpecChars($_POST['arrNoBindFields']);
				} else {
					$_POST['arrNoBindFields'] = array();
				}

				// заполняем обязательные поля
				$jur -> arrBindFields = array(
					'order_id'		=> $_SESSION['jur']['data']['order_id'],
					'user_id'		=> (!empty($_SESSION['sd_user']['data']['id']) ? $_SESSION['sd_user']['data']['id'] : 0),
					'action'		=> $_SESSION['payment']['service'],
					'record_id'		=> $_SESSION['payment']['id'],
					'amount'		=> $_SESSION['jur']['data']['amount'],
				);
				// заполняем не обязательные поля
				$jur -> arrNoBindFields = array(
					'data'	=> serialize($_POST['arrBindFields'] + $_POST['arrNoBindFields']),
				);
				// заполняем дополнительные поля
				$jur -> additionalFields = array(
					'description' => $_SESSION['jur']['data']['description'],
				);

				if (!$jur -> recRecord()) {
					$arrErrors[] = ERROR_UNABLE_PERFORM_OPERATION;
				} else {
					unset($_SESSION['payment']);

					$smarty -> assignByRef('arrData', $_SESSION['jur']['data']);
					$smarty -> assignByRef('arrBindFields', $_POST['arrBindFields']);
					$smarty -> assignByRef('arrNoBindFields', $_POST['arrNoBindFields']);
					$smarty -> assignByRef('postData', $_POST);
					$smarty -> assign('include_template', SD_ROOT_DIR . 'core/mods/payments/jur/templates/jur.receipt.tpl');

					$_SESSION['jur']['print'] = $smarty -> fetch(SD_ROOT_DIR . 'core/mods/payments/jur/templates/jur.receipt.tpl');
				}
			}
		} else {
			$arrData = array(
				'order_id'		=> time(),
				'amount'		=> $arrTariffs[$_SESSION['payment']['service']],
				'description'	=> $payments -> generatePaymentDescription($_SESSION['payment']['service'])
			);
			
			$_SESSION['jur']['data'] = $arrData;

			$smarty -> assignByRef('arrData', $arrData);
			$smarty -> assign('include_template', SD_ROOT_DIR . 'core/mods/payments/jur/templates/jur.pay.form.tpl');
		}
	} else {
		$arrErrors[] = ERROR_PAY_SYSTEM_NOT_DEFINE_PRICE;
	}
}
