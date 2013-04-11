<?php
/********************************************************
	JobExpert v1.0
	powered by Script Developers Group (SD-Group)
	email: info@sd-group.org.ua
	url: http://sd-group.org.ua/
	Copyright 2010-2015 (c) SD-Group
	All rights reserved
=========================================================
	ENG intellectmoney - User
********************************************************/
/**
 * @package
 * @todo
 */

(!defined('SDG')) ? die ('Triple protection!') : null;

/***** ФОРМА ОПЛАТЫ *****/
define('INTELLECTMONEY_PAY_FORM_HEAD', 'Payment form of IntellectMoney');

define('INTELLECTMONEY_PAY_NUMBER', 'Payment number');

define('INTELLECTMONEY_PAY_AMOUNT', 'Payment amount');

define('INTELLECTMONEY_PAY_DESCRIPTION', 'Payment description');

/***** ФОРМА ОШИБКИ ПЛАТЕЖА *****/
define('INTELLECTMONEY_FAIL_FORM_HEAD', 'Payment is not passed');

define('INTELLECTMONEY_FAIL_FORM_MESSAGE', 'Payment is not gone! Return to the choice of payment systems and try to pay again.
	If you have any questions, please contact adminstratsii resource. The appeal must specify the details of payment.');

define('INTELLECTMONEY_BACK_FORM_HEAD', 'Ожидание оплаты');

define('INTELLECTMONEY_BACK_FORM_MESSAGE', 'Оплата находится в режиме ожидания. Как только платеж будет проведен, заказанная вами услуга будет автоматически выполнена системой.');