<?php
/********************************************************
	JobExpert v1.0
	powered by Script Developers Group (SD-Group)
	email: info@sd-group.org.ua
	url: http://sd-group.org.ua/
	Copyright 2010-2015 (c) SD-Group
	All rights reserved
=========================================================
	Выполнение рассылки объявлений в соответствии с подписками пользователей
********************************************************/
/**
* @package
* @todo
*/

(!defined('SDG')) ? die('Triple protection!') : null;

$subscription = new subscription();

$arrSubscr = $subscription -> getSubscriptions("(TO_DAYS(NOW())-TO_DAYS(date_lastsend))>=period AND token IN ('active')", false, false, false);


if ($arrSubscr)
{
	foreach ($arrSubscr as $value)
	{
		$subscription -> runSubscription($value);
	}
}
