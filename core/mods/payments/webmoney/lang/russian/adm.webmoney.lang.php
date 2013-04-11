<?php
/********************************************************
	JobExpert v1.0
	powered by Script Developers Group (SD-Group)
	email: info@sd-group.org.ua
	url: http://sd-group.org.ua/
	Copyright 2010-2015 (c) SD-Group
	All rights reserved
=========================================================
	RUS Webmoney - Admin
********************************************************/
/**
 * @package
 * @todo
 */

(!defined('SDG')) ? die ('Triple protection!') : null;

/***** ФОРМА НАСТРОЕК *****/
define('WEBMONEY_CONFIG_FORM_HEAD', 'Настройки мода оплаты WebMoney (http://webmoney.ru/)');

define('WEBMONEY_CONFIG_FORM_PAYEE_PURSE', 'Кошелек');

define('WEBMONEY_CONFIG_FORM_PAYEE_PURSE_HELP', 'Кошелек, на который будут поступать платежи (кошелек должен соответствовать выбранной валюте)');

define('WEBMONEY_CONFIG_FORM_SECRET_KEY', 'Секретный ключ');
                             
define('WEBMONEY_CONFIG_FORM_SECRET_KEY_HELP', 'Секретный ключ webmoney');

define('WEBMONEY_CONFIG_FORM_PAYEE_CURRENCY', 'Валюта платежей');

define('WEBMONEY_CONFIG_FORM_PAYEE_CURRENCY_HELP', 'Валюта, в котрой совершаются платежи. Допустимые валюты: WMZ, WME, WMU, WMR.');

define('WEBMONEY_CONFIG_FORM_SIM_MODE', 'Тестовый режим');

define('WEBMONEY_CONFIG_FORM_SIM_MODE_HELP', 'Дополнительное поле, определяющее режим тестирования. Действует только в режиме тестирования и может принимать одно из следующих значений:<ul><li>0: Для всех тестовых платежей сервис будет имитировать успешное выполнение;</li>
<li> 1: Для всех тестовых платежей сервис будет имитировать выполнение с ошибкой (платеж не выполнен);</li>
<li> 2: Около 80% запросов на платеж будут выполнены успешно, а 20% – не выполнены.</li></ul>');

define('WEBMONEY_CONFIG_FORM_ENABLE', 'Вкл.');

define('WEBMONEY_CONFIG_FORM_DISABLE', 'Выкл.');


/***** HELP *****/
define('WEBMONEY_HELP_SHOP_ENABLE', '<p>Подключить магазин к системе можно, зайдя на http://webmoney.ru/.</p>
<p>Перед подключением магазина обязательно прочитайте все условия сервиса. Для работы мода Webmoney, необходим аттестат <b>Продавца</b>, для получения которого система предъявляет определенный набор требований. Если мод не работает, сначала проверьте, правильно ли подключен кошелек в системе Webmoney и обладаете ли вы необходимым аттестатом, и лишь после этого обаращайтесь к разработчикам.</p>
<p><b>Настройки Merchant (пример. Значения нужно заменить на свои)</b></p>
<p>
<b>Кошелек:</b> Z111122223333<br>
<b>Торговое имя:</b> SD-Group USD<br>
<b>Secret Key:</b> orkfkasd23kd34mdsd533j0ds023wqd<br>
<b>Высылать Secret Key на Result URL, если Result URL обеспечивает секретность:</b> Выкл.<br>
<b>Result URL:</b> http://domen.com/index.php?ut=competitor&do=payments&mod=webmoney&result<br>
<b>Передавать параметры в предварительном запросе:</b> Вкл.<br>
<b>Success URL:</b> http://domen.com/index.php?ut=competitor&do=payments&mod=webmoney&success<br>
<b>метод вызова Success URL:</b> POST<br>
<b>Fail URL:</b> http://domen.com/index.php?ut=competitor&do=payments&mod=webmoney&fail<br>
<b>метод вызова Fail URL:</b> POST<br>
<b>Позволять использовать URL, передаваемые в форме:</b> Выкл.<br>
<b>Высылать оповещение об ошибке платежа на кипер:</b> Вкл.<br>
<b>Метод формирования контрольной подписи:</b> MD5<br>
<b>Тестовый/Рабочий режимы:</b> рабочий<br>
<b>Прием чеков Paymer.com (ВМ-карт) или WM-нот:</b> Выкл.<br>
<b>Прием платежей с телефонов Telepat.ru:</b> Выкл.<br>
</p>
');