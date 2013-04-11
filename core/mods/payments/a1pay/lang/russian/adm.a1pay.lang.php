<?php
/********************************************************
	JobExpert v1.0
	powered by Script Developers Group (SD-Group)
	email: info@sd-group.org.ua
	url: http://sd-group.org.ua/
	Copyright 2010-2015 (c) SD-Group
	All rights reserved
=========================================================
	RUS intellectmoney - Admin
********************************************************/
/**
 * @package
 * @todo
 */

(!defined('SDG')) ? die ('Triple protection!') : null;

/***** ФОРМА НАСТРОЕК *****/
define('A1PAY_CONFIG_FORM_HEAD', 'Настройки мода оплаты a1pay (http://a1pay.ru/)');

define('A1PAY_CONFIG_NUMDERS_FORM_HEAD', 'Номера для отправки сообщений');

define('A1PAY_CONFIG_FORM_PREFIX', 'Префикс');

define('A1PAY_CONFIG_FORM_PREFIX_HELP', 'Префикс - это кодовое сообщение, которое пользователь должен послать на короткий номер. Устанавливается в настройках сервиса.');

define('A1PAY_CONFIG_FORM_SECRET_KEY', 'Секретный ключ');
                             
define('A1PAY_CONFIG_FORM_SECRET_KEY_HELP', 'Строка символов, используемая для подписи данных передаваемых системой 
	интернет-магазину. Применяется в целях дополнительной безопасности.');

/***** HELP *****/
define('A1PAY_HELP_SHOP_ENABLE', '<p>Подключить магазин к системе можно, зайдя на https://partner.a1pay.ru/.</p>
<p>Перед подключением магазина обязательно прочитайте все условия сервиса. </p>
<p><b>Настройки SMS API (пример. Значения нужно заменить на свои)</b></p>
<p>
<b>Название:</b> SD-Group<br>
<b>URL страницы, на которой предлагается оплатить услугу:</b> http://domen.com/competitor/payments.html<br>
<b>Адрес службы поддержки:</b> sd-group.org.ua<br>
<b>URL скрипта обработчика на вашем сайте:</b> http://domen.com/index.php?ut=competitor&do=payments&mod=a1pay&process<br>
<b>URL дополнительного скрипта обработчика:</b> пусто<br>
<b>Тип сервиса:</b> Доски объявлений<br>
<b>Префиксы:</b> #sdgroup<br>
<b>Секретный ключ:</b> 111111<br>
<b>Кодировка ответа сервиса:</b> UTF-8<br>
</p>
');