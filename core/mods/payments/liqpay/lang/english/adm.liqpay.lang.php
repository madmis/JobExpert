<?php
/********************************************************
	JobExpert v1.0
	powered by Script Developers Group (SD-Group)
	email: info@sd-group.org.ua
	url: http://sd-group.org.ua/
	Copyright 2010-2015 (c) SD-Group
	All rights reserved
=========================================================
	ENG LiqPay - Admin
********************************************************/
/**
 * @package
 * @todo
 */

(!defined('SDG')) ? die ('Triple protection!') : null;

/***** ФОРМА НАСТРОЕК *****/
define('LIQPAY_CONFIG_FORM_HEAD', 'Настройки мода оплаты LiqPay (http://liqpay.com/)');

define('LIQPAY_CONFIG_FORM_MERCHANT_ID', 'Merchant ID');

define('LIQPAY_CONFIG_FORM_MERCHANT_ID_HELP', 'LiqPay Merchan ID (узнавать на сайте liqpay)');

define('LIQPAY_CONFIG_FORM_API_VERSION', 'Версия API');

define('LIQPAY_CONFIG_FORM_API_VERSION_HELP', 'Версия API сервиса liqpay (не стоит изменять это значение)');

define('LIQPAY_CONFIG_FORM_SIGNATURE', 'Секретный ключ');

define('LIQPAY_CONFIG_FORM_SIGNATURE_HELP', 'Секретный ключ LiqPay (узнавать на сайте liqpay)');

define('LIQPAY_CONFIG_FORM_CURRENCY', 'Валюта платежей');

define('LIQPAY_CONFIG_FORM_CURRENCY_HELP', 'Валюта, в котрой совершаются платежи. Допустимые валюты: USD, EUR, RUR, UAH.');

/***** HELP *****/
define('LIQPAY_HELP_SHOP_ENABLE', '<p>Подключить магазин к системе можно, зайдя на https://liqpay.com/.</p>
<p>На сайте системы необходимо зарегистрироваться, подключить и настроить магазин (подробнее об этом уточняйте в службе поддержки LiqPay).</p>
<p><b>Ниже указан краткий набор действий по подключению магазина (все эти действия выполняются на сайте LiqPay)</b></p>
<p><b>Насторйки Merchant:</b> Подключить магазин / Разработчикам API / Регистрация в API.</p>
<p>Необходимо пройти регистрацию. Затем получить реквизиты мерчанта(ID и пароль). Включить API.</p>
<p>server_url - http://domen.com/index.php?ut=competitor&do=payments&mod=liqpay&server<br>result_url - http://domen.com/index.php?ut=competitor&do=payments&mod=liqpay&result</p>
');

