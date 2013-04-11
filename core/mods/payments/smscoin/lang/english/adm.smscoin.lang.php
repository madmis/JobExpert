<?php
/********************************************************
	JobExpert v1.0
	powered by Script Developers Group (SD-Group)
	email: info@sd-group.org.ua
	url: http://sd-group.org.ua/
	Copyright 2010-2015 (c) SD-Group
	All rights reserved
=========================================================
	ENG SMSCOIN - Admin
********************************************************/
/**
 * @package
 * @todo
 */

(!defined('SDG')) ? die ('Triple protection!') : null;

/***** ФОРМА НАСТРОЕК *****/
define('SMSCOIN_CONFIG_FORM_HEAD', 'Настройки услуги СМС:Банк сервиса SmsCoin (http://smscoin.com/)');

define('SMSCOIN_CONFIG_FORM_BANK_ID', 'СМС:Банк ID');

define('SMSCOIN_CONFIG_FORM_BANK_ID_HELP', 'Идентификатора вашего СМС:Банка в системе SmsCoin.');

define('SMSCOIN_CONFIG_FORM_BANK_SECRET_CODE', 'СМС:Банк Secret Code');

define('SMSCOIN_CONFIG_FORM_BANK_SECRET_CODE_HELP', 'Секрктный код (ключ) вашего СМС:Банка.');

define('SMSCOIN_CONFIG_FORM_BANK_CURRENCY', 'Валюта платежей');

define('SMSCOIN_CONFIG_FORM_BANK_CURRENCY_HELP', 'Валюта, в котрой совершаются платежи. Валюта не может быть изменена, она предназначена для отображения информации о платеже пользователю.');

/***** HELP *****/
define('SMSCOIN_HELP_SHOP_ENABLE', '<p>Подключить магазин к системе можно, зайдя на http://smscoin.com/. Подключить можно только услугу СМС:Банк.</p>
<p>На сайте системы необходимо зарегистрироваться, подключить и настроить магазин (подробнее об этом уточняйте в службе поддержки SmsCoin).</p>
<p><b>Настройки банка (пример. Значения нужно заменить на свои)</b></p>
<p>
<b>Название:</b> Тестовый банк для JobExpert!<br>
<b>Секретный код:</b> 1111<br>
<b>Страны:</b> Украина, Россия<br>
<b>Success URL:</b> http://domen.com/index.php?ut=competitor&do=payments&mod=smscoin&success<br>
<b>Success URL метод:</b> POST<br>
<b>Fail URL:</b> http://domen.com/index.php?ut=competitor&do=payments&mod=smscoin&fail<br>
<b>Fail URL метод:</b> POST<br>
<b>Result URL:</b> http://domen.com/index.php?ut=competitor&do=payments&mod=smscoin&server<br>
<b>Result URL метод:</b> POST<br>
<b>Задержка:</b> 0<br>
<b>Активен:</b> Вкл.<br>
</p>
');
