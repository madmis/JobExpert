<?php
/********************************************************
	JobExpert v1.0
	powered by Script Developers Group (SD-Group)
	email: info@sd-group.org.ua
	url: http://sd-group.org.ua/
	Copyright 2010-2015 (c) SD-Group
	All rights reserved
=========================================================
	ENG Hand - Admin
********************************************************/
/**
 * @package
 * @todo
 */

(!defined('SDG')) ? die ('Triple protection!') : null;

/***** ДЕЙСТВИЯ *****/
define('HAND_ACTION_DELETE', 'Удалить');

/***** ФОРМА НАСТРОЕК *****/
define('HAND_CONFIG_FORM_HEAD', 'Настроки мода оплаты в ручном режиме');

define('HAND_CONFIG_FORM_PAYMENT_TYPES', 'Виды возможных оплат');

define('HAND_CONFIG_FORM_PAYMENT_TYPES_HELP', 'Укажите виды возможных оплат, принимаемых в ручном режиме. Виды нужно указывать в формате КЛЮЧ => ЗНАЧЕНИЕ. КЛЮЧ может содрежать только символы латинского алфавита, знак подчеркивания и цифры (A-z, _, 0-9). КЛЮЧ (для каждого значения) должен быть уникальным.');

define('HAND_CONFIG_FORM_KEY', 'Ключ');

define('HAND_CONFIG_FORM_VALUE', 'Значение');

define('HAND_CONFIG_FORM_CURRENCY', 'Валюта платежей');

define('HAND_CONFIG_FORM_CURRENCY_HELP', 'Валюта, в котрой совершаются платежи. Допустимые валюты: USD, EUR, RUR, UAH.');

/***** ФОРМА ОПЛАТЫ *****/
define('HAND_FILTER_FORM_HEAD', 'Отбор');

/***** ТАБЛИЦА ПЛАТЕЖЕЙ *****/
define('HAND_TABLE_COLUMN_ORDER_ID', 'Номер');

define('HAND_TABLE_COLUMN_ACTION', 'Действие');

define('HAND_TABLE_COLUMN_USER_ID', 'ID польз.');

define('HAND_TABLE_COLUMN_RECORD_ID', 'ID записи');

define('HAND_TABLE_COLUMN_AMOUNT', 'Сумма');

define('HAND_TABLE_COLUMN_CURRENCY', 'Валюта');

define('HAND_TABLE_COLUMN_PAYMENT_TYPE', 'Тип платежа');

define('HAND_TABLE_COLUMN_DATE', 'Дата');

define('HAND_TABLE_COLUMN_TOKEN', 'Состояние');

define('HAND_TABLE_COLUMN_OPTIONS', 'Опции');

define('HAND_TABLE_RECORDS', 'Записей');

define('HAND_TABLE_NOT_DATA', 'Нет данных');


/***** ФОРМА УВЕДМЛЕНИЯ ПОЛЬЗОВАТЕЛЯ *****/
define('HAND_FORM_NOTIFICATION_PAYMENT_MESSAGE', 'Сообщение, которое было отправлено пользователю');

define('HAND_FORM_NOTIFICATION_TEXT', 'Укажите текст сообщения пользователю');

define('HAND_FORM_ACTION_DELETE', 'Удалить');

define('HAND_FORM_ACTION_PROCESSING', 'В обработку');

define('HAND_FORM_ACTION_CLOSE', 'Закрыть оплату');

define('HAND_FORM_ACTION_SELECT', 'Выберите действие...');

define('HAND_FORM_ACTION_DELETE_SELECTED', 'Удалить выбранные');

define('HAND_FORM_BUTTON_EXECUTE', 'Выполнить');

/***** ПРОЧЕЕ *****/
define('HAND_NEW', 'Новый');

define('HAND_PROCESSING', 'В обработке');

/***** HELP *****/
define('HAND_HELP_ACTION_DELETE', 'Платеж будет удален! Пользователь получит сообщение об удалении платежа с текстом, указанным в поле платежа. Убедитесь, что вы заполнили текст сообщения.');

define('HAND_HELP_ACTION_PROCESSING', 'Платеж будет переведен в состояние обработки. В поле сообщения укажите пользователю его дальнейшие действия (реквизиты оплаты и пр.), которые он должен выполнить прежде, чем платеж будет закрыт. Убедитесь, что вы заполнили текст сообщения и указали в нем реквизиты и данные для оплаты. После выполнения пользователем оплаты не забудьте закрыть платеж. Платеж может быть отправлен в обработку лишь один раз. Платежи находящиеся в обработке можно удалить или закрыть.');

define('HAND_HELP_ACTION_CLOSE', 'Платеж будет закрыт (удален). Будет выполнено действие платежа и пользователь получит сообщение об успешной оплате. Закрытие платежа предполагает, что платеж был проведен успешно. Запись о платеже добавляется в логи платежных данных.');

/***** ERRORS *****/
define('HAND_ERROR_NOT_ALL_PAYMENT_DETAILS', 'Ошибка! Указаны не все данные платежа.');

define('HAND_MESSAGE_DELETE_PAYMENT', HAND_HELP_ACTION_DELETE . ' Удалить платеж?');

define('HAND_MESSAGE_PROCESSING_PAYMENT', HAND_HELP_ACTION_PROCESSING . ' Перевести платеж в состояние обработки?');

define('HAND_MESSAGE_CLOSE_PAYMENT', HAND_HELP_ACTION_CLOSE . ' Закрыть платеж?');

/***** MAIL SUBJECT *****/
define('HAND_MAIL_SUBJECT_DELETE_PAYMENT', 'Ваш платеж (оплата в ручном режиме) был удален администратором!');
define('HAND_MAIL_COMMENT_DELETE_PAYMENT', 'Платеж (оплата в ручном режиме) был удален администратором. Данные платежа и замечания администратора смотрите ниже, в тексте письма.');

define('HAND_MAIL_SUBJECT_PROCESSING_PAYMENT', 'Ваш платеж (оплата в ручном режиме) поставлен на очередь в обработку!');
define('HAND_MAIL_COMMENT_PROCESSING_PAYMENT', 'Платеж (оплата в ручном режиме) поставлен на очередь в обработку. Выполните указания, описанные ниже, в тексте письма, а затем свяжитесь с администратором (при обрпщении к администратору не забывайте указывать номер платежа).');

define('HAND_MAIL_SUBJECT_CLOSE_PAYMENT', 'Ваш платеж (оплата в ручном режиме) успешно выполнен и закрыт!');
define('HAND_MAIL_COMMENT_CLOSE_PAYMENT', 'Платеж (оплата в ручном режиме) успешно выполнен и закрыт. Действие по платежу выполнено.');
