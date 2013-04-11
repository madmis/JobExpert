<?php
/********************************************************
	JobExpert v1.0
	powered by Script Developers Group (SD-Group)
	email: info@sd-group.org.ua
	url: http://sd-group.org.ua/
	Copyright 2010-2015 (c) SD-Group
	All rights reserved
=========================================================
	RUS Jur - Admin
********************************************************/
/**
 * @package
 * @todo
 */

(!defined('SDG')) ? die ('Triple protection!') : null;

/***** ФОРМА ОПЛАТЫ *****/
define('JUR_FILTER_FORM_HEAD', 'Отбор');

/***** ТАБЛИЦА ПЛАТЕЖЕЙ *****/
define('JUR_TABLE_COLUMN_ORDER_ID', 'Номер');

define('JUR_TABLE_COLUMN_ACTION', 'Действие');

define('JUR_TABLE_COLUMN_USER_ID', 'ID польз.');

define('JUR_TABLE_COLUMN_RECORD_ID', 'ID записи');

define('JUR_TABLE_COLUMN_AMOUNT', 'Сумма');

define('JUR_TABLE_COLUMN_DATE', 'Дата');

define('JUR_TABLE_COLUMN_TOKEN', 'Состояние');

define('JUR_TABLE_COLUMN_OPTIONS', 'Опции');

define('JUR_TABLE_RECORDS', 'Записей');

define('JUR_TABLE_NOT_DATA', 'Нет данных');

/***** ПРОЧЕЕ *****/
define('JUR_NEW', 'Новый');

define('JUR_PROCESSING', 'В обработке');

define('JUR_FORM_BUTTON_EXECUTE', 'Выполнить');

/***** ФОРМА УВЕДМЛЕНИЯ ПОЛЬЗОВАТЕЛЯ *****/
define('JUR_FORM_NOTIFICATION_ADDITIONAL_DATA', 'Дополнительные данные платежа');

define('JUR_FORM_NOTIFICATION_PAYMENT_MESSAGE', 'Сообщение, которое было отправлено пользователю');

define('JUR_FORM_NOTIFICATION_TEXT', 'Укажите текст сообщения пользователю');

define('JUR_FORM_ACTION_DELETE', 'Удалить');

define('JUR_FORM_ACTION_CLOSE', 'Закрыть оплату');

define('JUR_FORM_ACTION_SELECT', 'Выберите действие...');

define('JUR_FORM_ACTION_DELETE_SELECTED', 'Удалить выбранные');

/***** MAIL SUBJECT *****/
define('JUR_MAIL_SUBJECT_DELETE_PAYMENT', 'Ваш платеж (оплата для Юр. лиц) был удален администратором!');
define('JUR_MAIL_COMMENT_DELETE_PAYMENT', 'Платеж (оплата для Юр. лиц) был удален администратором. Данные платежа и замечания администратора смотрите ниже, в тексте письма.');

define('JUR_MAIL_SUBJECT_CLOSE_PAYMENT', 'Ваш платеж (оплата для Юр. лиц) успешно выполнен и закрыт!');
define('JUR_MAIL_COMMENT_CLOSE_PAYMENT', 'Платеж (оплата для Юр. лиц) успешно выполнен и закрыт. Действие по платежу выполнено.');

/* HELP */
define('JUR_HELP_TEMPLATE_DESCRIPTION_JUR_PAY_FORM_TPL', 'Шаблон формы отправки платежа. Внимательно читайте комментарии в шаблоне. При необходимости обратитесь к справке по текущему шаблону.');

define('JUR_HELP_TEMPLATE_DESCRIPTION_JUR_RECEIPT_TPL', 'Шаблон квитанции платежа');

define('JUR_HELP_ACTION_DELETE', 'Платеж будет удален! Если в момент оплаты пользователь был авторизован на сайте, он получит сообщение об удалении платежа с текстом, указанным в поле платежа. Убедитесь, что вы заполнили текст сообщения.');

define('JUR_HELP_ACTION_CLOSE', 'Платеж будет закрыт (удален). Будет выполнено действие платежа и пользователь, если он был авторизован на сайте в момент оплаты, получит сообщение об успешной оплате. Закрытие платежа предполагает, что платеж был проведен успешно. Запись о платеже добавляется в логи платежных данных.');

define('JUR_MAIN_HELP', '<p>При настройке шаблонов данного мода обязательно придерживайтесь указанных здесь правил.</p>
<p><b>Шаблон формы платежа - jur.pay.form.tpl</b></p>
<p>Следующие названия полей формы платежа являются зарезервированными, их запрещено использовать: 
<b>id</b>, <b>order_id</b>, <b>action</b>, <b>user_id</b>, <b>record_id</b>, <b>amount</b>, <b>message</b>, <b>datetime</b>.</p>
<p>Все поля, отправленные из данной формы доступны в шаблоне квитанции по префиксу $postData (все поля из массива $_POST) (см. пример в шаблоне квитанции).</p>
<p>Все поля, обязательные для заполнения, должны быть помещены в массив <b>arrBindFields</b>.</p>
<p>Все поля, не обязательные для заполнения, должны быть помещены в массив <b>arrNoBindFields</b>.</p>
<p>В шаблоне можно использовать JavaScript (jQuery).</p>
<p><b>Шаблон квитанции платежа - jur.receipt.tpl</b></p>
<p>Вывод полей, обязательных для заполнения - {$arrNoBindFields}.</p>
<p>Вывод полей, не обязательных для заполнения - {$arrBindFields}.</p>
<p>{$arrData} - содержит сервисные поля.</p>
<p>Массив {$postData} - содержит все данные, отправленные в POST запросе из формы платежа.</p>');

/***** ERRORS *****/
define('JUR_ERROR_NOT_ALL_PAYMENT_DETAILS', 'Ошибка! Указаны не все данные платежа.');

define('JUR_MESSAGE_DELETE_PAYMENT', JUR_HELP_ACTION_DELETE . ' Удалить платеж?');

define('JUR_MESSAGE_CLOSE_PAYMENT', JUR_HELP_ACTION_CLOSE . ' Закрыть платеж?');

