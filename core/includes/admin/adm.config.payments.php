<?php
/********************************************************
	JobExpert v1.0
	powered by Script Developers Group (SD-Group)
	email: info@sd-group.org.ua
	url: http://sd-group.org.ua/
	Copyright 2010-2015 (c) SD-Group
	All rights reserved
=========================================================
	Настройки - Оплаты
********************************************************/
/**
* @package
* @todo
*/

(!defined('SDG')) ? die ('Triple protection!') : null;

// инициируем "Наименование страницы" отображаемое в форме
$arrNamePage = array(
						array('name' => MENU_ADMIN_MAIN, 'link' => CONF_ADMIN_FILE),
						array('name' => MENU_CONFIG, 'link' => false),
						array('name' => MENU_CONFIG_PAYMENTS, 'link' => false)
					);

// сохраняем данные, переданные из формы
if (isset($_POST['save']))
{
		$data = "<?php\n\n"
			  . "(!defined('SDG')) ? die ('Triple protection!') : null;\n\n"
			  .	'$arrPayments = array(' . "\n";

		foreach (array_keys($arrPayments) as $payment)
		{
			  $arrData[] = "	'$payment' => " . ((!isset($_POST['paymentOn'][$payment])) ? 0 : 1);
		}

		$data .=  implode(",\n", $arrData) . "\n);\n";

	if (!tools::saveConfig('core/conf/config.payments.php', $data, CONF_ADMIN_FILE . '?m=config&s=payments'))
	{
		$arrErrors[] = ERROR_FILES_MISSING_FILE;
	}
}

$smarty -> assignByRef('arrPayments', $arrPayments);
$smarty -> assignByRef('errors', $arrErrors);
