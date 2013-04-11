<?php

/**
 * JobExpert v1.0
 * powered by Script Developers Group (SD-Group)
 * email: info@sd-group.org.ua
 * url: http://sd-group.org.ua/
 * Copyright 2010-2015 (c) SD-Group
 * All rights reserved
 * ===================================================
 * Обслуживание сайта - Администрирование
 * ===================================================
 *
 * @package
 *
 * @todo
 */
(!defined('SDG')) ? die('Triple protection!') : null;

/**
 * иницализация массива подключаемых шаблонов: по умолчанию все значения - false
 * для подключения шаблона, необходимо установить значение - true
 * шаблоны подключаются в порядке установленном в файле головного шаблона
 */
$arrActions = array(
	'maintenance' => false
);

// инициируем "Наименование страницы" отображаемое в форме
$arrNamePage = array(
	array('name' => MENU_ADMIN_MAIN, 'link' => CONF_ADMIN_FILE),
	array('name' => MENU_SERVICE, 'link' => false),
	array('name' => MENU_ADMINISTRATION, 'link' => false)
);

/**
 * Действия
 */
if (isset($_GET['action']) && !empty($_GET['action']) && isset($arrActions[$_GET['action']])) {
	// инициируем вызываемый шаблон
	$arrActions[$_GET['action']] = true;

	// инициируем "Наименование страницы" отображаемое в форме
	$arrNamePage[] = array('name' => MENU_MAINTENANCE, 'link' => false);

	if ($arrActions['maintenance']) {
		if (isset($_POST['save'])) { // сохраняем данные, переданные из формы
			$maintenance = (isset($_POST['maintenance'])) ? 'true' : 'false';

			$data = "<?php\n\n"
					. "(!defined('SDG')) ? die ('Triple protection!') : null;\n\n"
					. 'define("CONF_SERVICE_ADMINISTRATION_MAINTENANCE", ' . $maintenance . ');' . "\n";

			if (!tools::saveConfig('core/conf/const.config.service.php', $data, CONF_ADMIN_FILE . '?m=service&s=administration&action=maintenance')) {
				$arrErrors[] = ERROR_FILES_MISSING_FILE;
			}
		} elseif (isset($_POST['mcontrol'])) {
			(!control::actionsControl($_POST)) ? messages::messageChangeSaved(ERROR_NOT_SAVE_CHANGE, false, CONF_ADMIN_FILE . '?m=service&s=administration&action=maintenance') : messages::messageChangeSaved(MESSAGE_CHANGE_SAVED, false, CONF_ADMIN_FILE . '?m=service&s=administration&action=maintenance');
		}
	}
} else {
	messages::error404();
}

$smarty->assignByRef('errors', $arrErrors);
$smarty->assignByRef('action', $arrActions);
