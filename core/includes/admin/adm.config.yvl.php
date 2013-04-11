<?php

/**
 * JobExpert v1.0
 * powered by Script Developers Group (SD-Group)
 * email: info@sd-group.org.ua
 * url: http://sd-group.org.ua/
 * Copyright 2010-2015 (c) SD-Group
 * All rights reserved
 * =========================================================
 * Настройки - YVL
 * =========================================================
 */
(!defined('SDG')) ? die('Triple protection!') : null;

// инициируем "Наименование страницы" отображаемое в форме
$arrNamePage = array(
	array('name' => MENU_ADMIN_MAIN, 'link' => CONF_ADMIN_FILE),
	array('name' => MENU_CONFIG, 'link' => false),
	array('name' => MENU_CONFIG_YVL, 'link' => false)
);

// сохраняем данные, переданные из формы
if (isset($_POST['save'])) {
	$data = "<?php\n\n"
			. "(!defined('SDG')) ? die ('Triple protection!') : null;\n\n"
			. 'define("CONF_YVL_EXPORT_PERIOD", "' . (((int) $_POST['period']) ? (int) $_POST['period'] : 10) . '");' . "\n";

	if (!tools::saveConfig('core/conf/const.config.yvl.php', $data, CONF_ADMIN_FILE . '?m=config&s=yvl')) {
		$arrErrors[] = ERROR_FILES_MISSING_FILE;
	}
}

$smarty->assignByRef('errors', $arrErrors);
