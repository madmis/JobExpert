<?php

/* * ******************************************************
  JobExpert v1.0
  powered by Script Developers Group (SD-Group)
  email: info@sd-group.org.ua
  url: http://sd-group.org.ua/
  Copyright 2010-2015 (c) SD-Group
  All rights reserved
  =========================================================
  Модуль оплаты - A1PAY - Админка
 * ****************************************************** */
/**
 * @package
 * @todo
 */
(!defined('SDG')) ? die('Triple protection!') : null;

$pathToMod = 'core/mods/payments/a1pay/';

require_once $pathToMod . 'lang/' . CONF_LANGUAGE . '/adm.a1pay.lang.php';
require_once $pathToMod . 'lang/' . CONF_LANGUAGE . '/a1pay.lang.php';
require_once $pathToMod . 'lang/' . CONF_LANGUAGE . '/lang._custom.php';
require_once $pathToMod . 'conf/a1pay.numbers.php';
require_once $pathToMod . 'classes/a1pay.class.php';

$numbersTtemplate =  SD_ROOT_DIR . 'core/mods/payments/a1pay/templates/a1pay.numbers.tpl';

$modMenu[] = array('id' => 'a1pay', 'action' => 'config', 'icon' => 'config.png', 'text' => MENU_CONFIG);
$modMenu[] = array('id' => 'a1pay', 'action' => 'lt', 'icon' => 'langManager.png', 'text' => MENU_LANGUAGE_MANAGER);

/**
 * Сохраняем номера для мода
 */
if (isset($_POST['numbers']) && !empty($_POST['arrNumbers'])) {
	if (a1pay::saveModNumbers($_POST['arrNumbers'], $arrPayments)) {
		messages::messageChangeSaved(MESSAGE_CHANGE_SAVED, false, CONF_ADMIN_FILE . '?m=mods&s=payments&action=config&id=a1pay');
	} else {
		$arrErrors[] = ERROR_MODS_PAYMENTS_TARIFFS_NOT_SAVE;
	}
}

$smarty->assignByRef('numbersTtemplate', $numbersTtemplate);
$smarty->assignByRef('arrNumbers', $arrNumbers);
$smarty->assignByRef('pathToMod', $pathToMod);