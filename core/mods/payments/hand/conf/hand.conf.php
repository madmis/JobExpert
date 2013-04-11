<?php

(!defined('SDG')) ? die ('Triple protection!') : null;

$handPaymentTypes = array(
	'fizbank'	=> 'Банк (Физ. лица)',
	'jurbank'	=> 'Банк (Юр. лица)',
	'cash'	=> 'Наличные',
	'post'	=> 'Почтовый перевод'
);

define("HAND_CONF_CURRENCY", "USD");