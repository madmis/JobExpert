<?php
/********************************************************
	JobExpert v1.0
	powered by Script Developers Group (SD-Group)
	email: info@sd-group.org.ua
	url: http://sd-group.org.ua/
	Copyright 2010-2015 (c) SD-Group
	All rights reserved
=========================================================
	ENG intellectmoney - Admin
********************************************************/
/**
 * @package
 * @todo
 */

(!defined('SDG')) ? die ('Triple protection!') : null;

/***** ФОРМА НАСТРОЕК *****/
define('INTELLECTMONEY_CONFIG_FORM_HEAD', 'Настройки мода оплаты IntellectMoney (http://IntellectMoney.ru/)');

define('INTELLECTMONEY_CONFIG_FORM_PAYEE_PURSE', 'ID магазина');

define('INTELLECTMONEY_CONFIG_FORM_PAYEE_PURSE_HELP', 'Целое число — идентификатор магазина в сервисе Merchant.IntellectMoney.
	Назначается автоматически сервисом при создании нового магазина. Состоит из 6 цифр, начинается с "4".
	Узнать идентификатор магазина можно в настройках магазина во вкладке "Общие".');

define('INTELLECTMONEY_CONFIG_FORM_SECRET_KEY', 'Secret Key');
                             
define('INTELLECTMONEY_CONFIG_FORM_SECRET_KEY_HELP', 'Строка символов, используемая для подписи данных передаваемых системой 
	интернет-магазину.');

define('INTELLECTMONEY_CONFIG_FORM_PAYEE_CURRENCY', 'Валюта платежей');

define('INTELLECTMONEY_CONFIG_FORM_PAYEE_CURRENCY_HELP', 'TST - тестовая валюта. 
	Если тип валюты, передаваемый в форме, и тип валюты магазина не будут совпадать, платеж проведен не будет.');

define('INTELLECTMONEY_CONFIG_FORM_SIM_MODE', 'Тестовый режим');

define('INTELLECTMONEY_CONFIG_FORM_SIM_MODE_HELP', 'При включении тестового режима сервер имитирует отмену платежа.');

define('INTELLECTMONEY_CONFIG_FORM_ENABLE', 'Вкл.');

define('INTELLECTMONEY_CONFIG_FORM_DISABLE', 'Выкл.');


/***** HELP *****/
define('INTELLECTMONEY_HELP_SHOP_ENABLE', '<p>Подключить магазин к системе можно, зайдя на http://IntellectMoney.ru/.</p>
<p>Перед подключением магазина обязательно прочитайте все условия сервиса. </p>
<p><b>Настройки Merchant (пример. Значения нужно заменить на свои)</b></p>
<p>
<b>Протокол:</b> WebMoney<br>
<b>Result URL:</b> http://domen.com/index.php?ut=competitor&do=payments&mod=intellectmoney&result<br>
<b>Метод Result URL:</b> POST<br>
<b>Success URL:</b> http://domen.com/index.php?ut=competitor&do=payments&mod=intellectmoney&success<br>
<b>Метод Success URL:</b> POST<br>
<b>Fail URL:</b> http://domen.com/index.php?ut=competitor&do=payments&mod=intellectmoney&fail<br>
<b>Метод Fail URL:</b> POST<br>
<b>Back URL:</b> http://domen.com/index.php?ut=competitor&do=payments&mod=intellectmoney&back<br>
<b>Secret Key:</b> 111111<br>
<b>Высылать Secret Key на Result URL (при HTTPS):</b> Выкл.<br>
<b>Позволять использовать URL, передаваемые в форме:</b> Вкл.<br>
<b>Передавать параметры в предварительном запросе:</b> Вкл.<br>
<b>E-mail для уведомлений:</b> your@email.com<br>
<b>Принимать только уникальные ID покупки:</b> Выкл.<br>
<b>Режим отладки:</b> Выкл.<br>
</p>
');