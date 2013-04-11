<?php
/********************************************************
	JobExpert v1.0
	powered by Script Developers Group (SD-Group)
	email: info@sd-group.org.ua
	url: http://sd-group.org.ua/
	Copyright 2010-2015 (c) SD-Group
	All rights reserved
=========================================================
	ENG Jur - Admin
********************************************************/
/**
 * @package
 * @todo
 */

(!defined('SDG')) ? die ('Triple protection!') : null;

/***** ФОРМА ОПЛАТЫ *****/
define('JUR_FILTER_FORM_HEAD', 'Filter');

/***** ТАБЛИЦА ПЛАТЕЖЕЙ *****/
define('JUR_TABLE_COLUMN_ORDER_ID', 'Number');

define('JUR_TABLE_COLUMN_ACTION', 'Action');

define('JUR_TABLE_COLUMN_USER_ID', 'ID user');

define('JUR_TABLE_COLUMN_RECORD_ID', 'ID record');

define('JUR_TABLE_COLUMN_AMOUNT', 'Amount');

define('JUR_TABLE_COLUMN_DATE', 'Date');

define('JUR_TABLE_COLUMN_TOKEN', 'State');

define('JUR_TABLE_COLUMN_OPTIONS', 'Options');

define('JUR_TABLE_RECORDS', 'Records');

define('JUR_TABLE_NOT_DATA', 'Not data');

/***** ПРОЧЕЕ *****/
define('JUR_NEW', 'New');

define('JUR_FORM_BUTTON_EXECUTE', 'Execute');

/***** ФОРМА УВЕДМЛЕНИЯ ПОЛЬЗОВАТЕЛЯ *****/
define('JUR_FORM_NOTIFICATION_ADDITIONAL_DATA', 'Additional details of payment');

define('JUR_FORM_NOTIFICATION_PAYMENT_MESSAGE', 'Message that was sent to the user');

define('JUR_FORM_NOTIFICATION_TEXT', 'Enter your message to the user');

define('JUR_FORM_ACTION_DELETE', 'Delete');

define('JUR_FORM_ACTION_CLOSE', 'Close payment');

define('JUR_FORM_ACTION_SELECT', 'Select action...');

define('JUR_FORM_ACTION_DELETE_SELECTED', 'Delete selected');

/***** MAIL SUBJECT *****/
define('JUR_MAIL_SUBJECT_DELETE_PAYMENT', 'Your payment (payable to Legal. Persons) was deleted by the administrator!');
define('JUR_MAIL_COMMENT_DELETE_PAYMENT', 'Payment (payable to Legal. Persons) was deleted by the administrator. Payment data and the comments of the Administrator, see below in the message body.');

define('JUR_MAIL_SUBJECT_CLOSE_PAYMENT', 'Your payment (payable to Legal. Individuals) successfully completed and closed!');
define('JUR_MAIL_COMMENT_CLOSE_PAYMENT', 'Payment (payable to Legal. Individuals) successfully completed and closed. Effect on payment made.');

/* HELP */
define('JUR_HELP_TEMPLATE_DESCRIPTION_JUR_PAY_FORM_TPL', 'The form template to send payment. Carefully read the comments in the template. If necessary, refer to the help for the current pattern.');

define('JUR_HELP_TEMPLATE_DESCRIPTION_JUR_RECEIPT_TPL', 'Template receipt of payment');

define('JUR_HELP_ACTION_DELETE', 'Payment will be deleted! If at the time of payment the user was logged into the site, they will receive payment from the removal of the text in the field of payment. Make sure you fill in your message.');

define('JUR_HELP_ACTION_CLOSE', 'Payment will be closed (removed). Action will be performed and payment user, if it was logged into the site at the time of payment, will receive a message confirming your successful payment. Closure of the payment suggests that the payment was successful. Record of the payment is added to the billing logs.');

define('JUR_MAIN_HELP', '<p>When you configure a template of the mod must follow these rules here.</p>
<p><b>Template forms of payment - jur.pay.form.tpl</b></p>
<p>The following field names are reserved form of payment, they are prohibited from using: 
<b>id</b>, <b>order_id</b>, <b>action</b>, <b>user_id</b>, <b>record_id</b>, <b>amount</b>, <b>message</b>, <b>datetime</b>.</p>
<p>All fields are sent from this form are available in the template receipt by the prefix $postData (all fields from the array $_POST) (see the example in the template receipt).</p>
<p>All fields are required, must be placed in an array <b>arrBindFields</b>.</p>
<p>All fields are not required to fill should be placed in an array <b>arrNoBindFields</b>.</p>
<p>In a template you can use JavaScript (jQuery).</p>
<p><b>Template receipt of payment - jur.receipt.tpl</b></p>
<p>The output fields are mandatory - {$arrNoBindFields}.</p>
<p>The output fields are not mandatory to fill - {$arrBindFields}.</p>
<p>{$arrData} - contains the service field.</p>
<p>Массив {$postData} - contains all the data sent in the POST request from a form of payment.</p>');

/***** ERRORS *****/
define('JUR_ERROR_NOT_ALL_PAYMENT_DETAILS', 'Error! And not all payment data.');

define('JUR_MESSAGE_DELETE_PAYMENT', JUR_HELP_ACTION_DELETE . ' Remove payment?');

define('JUR_MESSAGE_CLOSE_PAYMENT', JUR_HELP_ACTION_CLOSE . ' Close payment?');

