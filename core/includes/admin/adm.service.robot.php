<?php

/**
 * JobExpert v1.0
 * Powered by Script Developers Group (SD-Group)
 * Email: info@sd-group.org.ua
 * URL: http://sd-group.org.ua/
 * Copyright 2010-2015 (c) SD-Group
 * All rights reserved
 * ========================================================
 * Обслуживание сайта - Робот [автоматические действия]
 * ========================================================
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
	'config' => false
);

// инициируем "Наименование страницы" отображаемое в форме
$arrNamePage = array(
	array('name' => MENU_ADMIN_MAIN, 'link' => CONF_ADMIN_FILE),
	array('name' => MENU_ROBOT, 'link' => false)
);

$smarty->assignByRef('arrRobotConf', $arrRobotConf);

/**
 * Действия
 */
if (isset($_GET['action']) && !empty($_GET['action']) && isset($arrActions[$_GET['action']])) {
	// инициируем вызываемый шаблон
	$arrActions[$_GET['action']] = true;

	// инициируем "Наименование страницы" отображаемое в форме
	$arrNamePage[] = array('name' => MENU_CONFIG, 'link' => false);

	if ($arrActions['config']) {
		$fileName = 'core/conf/config.robot.control.php';

		if (file_exists($fileName)) { // если файл существует
			if (isset($_POST['conf_save'])) { // сохраняем данные, переданные из формы
				$arrConf = array(
					'robot_running' => (isset($_POST['arrConf']['robot_running'])) ? 'true' : 'false',
					'robot_running_firsttime' => (isset($_POST['arrConf']['robot_running']) && isset($_POST['arrConf']['robot_running_firsttime']['Hour']) && isset($_POST['arrConf']['robot_running_firsttime']['Minute'])) ? mktime($_POST['arrConf']['robot_running_firsttime']['Hour'], $_POST['arrConf']['robot_running_firsttime']['Minute']) : 0,
					'robot_term' => (isset($_POST['arrConf']['robot_running']) && isset($_POST['arrConf']['robot_term']) && $robot_term = (int) $_POST['arrConf']['robot_term']) ? $robot_term : 0,
					'robot_term_coef' => (isset($_POST['arrConf']['robot_running']) && isset($_POST['arrConf']['robot_term_coef']) && $robot_term_coef = (int) $_POST['arrConf']['robot_term_coef']) ? $robot_term_coef : 3600
				);

				// если выбранное время первого запуска меньше текушего, делаем перенос на следующие сутки
				(!empty($arrConf['robot_running_firsttime']) && $arrConf['robot_running_firsttime'] < time()) ? $arrConf['robot_running_firsttime'] += 86400 : null;

				$data = "<?php\n\n"
						. "(!defined('SDG')) ? die ('Triple protection!') : null;\n\n"
						. '$arrRobotConf = array(' . "\n						'configs' => array(\n";

				foreach ($arrConf as $confKey => $confVal) {
					$arrConfData[] = "												'$confKey' => $confVal";
				}

				$data .= implode(",\n", $arrConfData) . "\n										  ),\n						'actions' => array(\n";

				foreach ($arrRobotConf['actions'] as $actionKey => $actionVal) {
					$actionVal = (false === $actionVal) ? 'false' : ((true === $actionVal) ? 'true' : "'$actionVal'");
					$arrActData[] = "												'$actionKey' => $actionVal";
				}

				$data .= implode(",\n", $arrActData) . "\n										  )\n					 );\n";

				if (!tools::saveConfig($fileName, $data, CONF_ADMIN_FILE . '?m=service&s=robot&action=config')) {
					$arrErrors[] = ERROR_FILES_MISSING_FILE;
				}
			} elseif (isset($_POST['ctrl_save'])) {
				$arrCtrl = array(
					'updateCounters' => (isset($_POST['arrCtrl']['updateCounters'])) ? 'true' : 'false',
					'delNonverifyUsers' => (isset($_POST['arrCtrl']['delNonverifyUsers'])) ? 'true' : 'false',
					'delNontypeUsers' => (isset($_POST['arrCtrl']['delNontypeUsers'])) ? 'true' : 'false',
					'delUnpaidUsers' => (isset($_POST['arrCtrl']['delUnpaidUsers'])) ? 'true' : 'false',
					'delUnpaidSubscr' => (isset($_POST['arrCtrl']['delUnpaidSubscr'])) ? 'true' : 'false',
					'vacActionSlo' => (isset($_POST['arrCtrl']['vacActionSlo']) && ('deleted' === $_POST['arrCtrl']['vacActionSlo'] || 'archived' === $_POST['arrCtrl']['vacActionSlo'])) ? secure::escQuoteData($_POST['arrCtrl']['vacActionSlo']) : 'false',
					'resActionSlo' => (isset($_POST['arrCtrl']['resActionSlo']) && ('deleted' === $_POST['arrCtrl']['resActionSlo'] || 'archived' === $_POST['arrCtrl']['resActionSlo'])) ? secure::escQuoteData($_POST['arrCtrl']['resActionSlo']) : 'false',
					'vacDelNonverify' => (isset($_POST['arrCtrl']['vacDelNonverify'])) ? 'true' : 'false',
					'resDelNonverify' => (isset($_POST['arrCtrl']['resDelNonverify'])) ? 'true' : 'false',
					'vacDelUnpaid' => (isset($_POST['arrCtrl']['vacDelUnpaid'])) ? 'true' : 'false',
					'resDelUnpaid' => (isset($_POST['arrCtrl']['resDelUnpaid'])) ? 'true' : 'false',
					'vacVipResetSlo' => (isset($_POST['arrCtrl']['vacVipResetSlo'])) ? 'true' : 'false',
					'resVipResetSlo' => (isset($_POST['arrCtrl']['resVipResetSlo'])) ? 'true' : 'false',
					'vacHotResetSlo' => (isset($_POST['arrCtrl']['vacHotResetSlo'])) ? 'true' : 'false',
					'resHotResetSlo' => (isset($_POST['arrCtrl']['resHotResetSlo'])) ? 'true' : 'false'
				);

				$data = "<?php\n\n"
						. "(!defined('SDG')) ? die ('Triple protection!') : null;\n\n"
						. '$arrRobotConf = array(' . "\n	'configs' => array(\n";

				foreach ($arrRobotConf['configs'] as $configKey => $configVal) {
					$configVal = (false === $configVal) ? 'false' : ((true === $configVal) ? 'true' : $configVal);
					$arrConfData[] = "		'$configKey' => $configVal";
				}

				$data .= implode(",\n", $arrConfData) . "\n	),\n\n	'actions' => array(\n";

				foreach ($arrCtrl as $ctrlKey => $ctrlVal) {
					$arrActData[] = "		'$ctrlKey' => $ctrlVal";
				}

				$data .= implode(",\n", $arrActData) . "\n	)\n);\n";

				if (!tools::saveConfig($fileName, $data, CONF_ADMIN_FILE . '?m=service&s=robot&action=config')) {
					$arrErrors[] = ERROR_FILES_MISSING_FILE;
				}
			}
		} else {
			messages::printDie(ERROR_CRITICAL_FILE_NOT_EXISTS);
		}
	}
} else {
	messages::error404();
}

$smarty->assignByRef('errors', $arrErrors);
$smarty->assignByRef('action', $arrActions);
