<?php
/********************************************************
	JobExpert v1.0
	powered by Script Developers Group (SD-Group)
	email: info@sd-group.org.ua
	url: http://sd-group.org.ua/
	Copyright 2010-2015 (c) SD-Group
	All rights reserved
=========================================================
	ENG LiqPay - User
********************************************************/
/**
 * @package
 * @todo
 */

(!defined('SDG')) ? die ('Triple protection!') : null;

/***** ФОРМА ОПЛАТЫ *****/
define('LIQPAY_PAY_FORM_HEAD', 'Form of payment LiqPay');

define('LIQPAY_PAY_NUMBER', 'Payment number');

define('LIQPAY_PAY_AMOUNT', 'Payment amount');

define('LIQPAY_PAY_DESCRIPTION', 'Payment description');

define('LIQPAY_FAIL_FORM_HEAD', 'In the process of payment error!');

define('LIQPAY_FAIL_MESSAGE', 'In the process of payment of an error! Return to the choice of payment systems and try to pay again. If you have any questions, please contact adminstratsii resource. The appeal must specify the details of payment.');

define('LIQPAY_WAIT_SECURE_FORM_HEAD', 'Your payment is being processed!');

define('LIQPAY_WAIT_SECURE_MESSAGE', 'Your payment is being processed! After your payment is processed, if the payment is successful, the chosen services will be automatically processed. Payment processing may take an indefinite amount of time (depending on payment processing service http://liqpay.com/). Try to check the result of processing the selected service in 1-2 hours. If you have any questions, please contact adminstratsii resource. The appeal must specify the details of payment.');

/***** ERRORS *****/
define('LIQPAY_PAY_ANSWER_ERROR_UNMATCHED', 'Error! The discrepancy between the data sent and received! This error arose from the fact that the data sent from the site does not correspond to data taken from the operator (payment systems). In most cases, this error indicates that you want to cheat us!'); 
