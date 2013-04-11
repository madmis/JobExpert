<?php
/********************************************************
	JobExpert v1.0
	powered by Script Developers Group (SD-Group)
	email: info@sd-group.org.ua
	url: http://sd-group.org.ua/
	Copyright 2010-2015 (c) SD-Group
	All rights reserved
=========================================================
	Инсталлятор - Шаг 3 - Настройки шаблонизатора и шаблонов
********************************************************/
/**
* @package
* @todo
*/

(!defined('SDG')) ? die ('Triple protection!') : null;

if (empty($_SESSION['sdinstall']['step1'])) {
	// пересылаем пользователя на первый шаг
	die ('<script type="text/javascript">window.location="install.php?step=1";</script>');
} elseif (empty($_SESSION['sdinstall']['step2'])) {
	// пересылаем пользователя на второй шаг
	die ('<script type="text/javascript">window.location="install.php?step=2";</script>');
} else {
	include_once 'core/conf/const.config.tmpl.php';

	$tmplMess = TMPL_SMARTY_SETUP_FAIL;
	$msEr = true;

	if (isset($_POST['step3'])) {
		// записываем в сессию седьмой шаг
		$_SESSION['sdinstall']['step3'] = true;
		die ('<script type="text/javascript">window.location="install.php?step=4";</script>');
	}

	if (!empty($_GET['step']) && 3 == $_GET['step']) {
		// Копируем Smarty в каталог скрипта
		if (!inst::copyDirContent('install/Smarty', filesys::setPath(CONF_ROOT_DIR) . 'Smarty')) {
			$arrErrors[] = ERROR_UNABLE_TO_SETUP_SMARTY;
		} else {
			$data = "<?php\n\n"
				  . "(!defined('SDG')) ? die ('Triple protection!') : null;\n\n"
				  . 'define("TEMPLATE_SMARTY_DIR", \'' . filesys::setPath(CONF_ROOT_DIR) . 'Smarty/\');' . "\n\n"
				  . 'define("TEMPLATE_ROOT_DIR", "' . TEMPLATE_ROOT_DIR . '");' . "\n\n"
				  . 'define("CONF_TEMPLATE", "' . CONF_TEMPLATE . '");' . "\n\n"
				  . 'define("TEMPLATE_COMPILE_DIR", "' . TEMPLATE_COMPILE_DIR . '");' . "\n\n"
				  . 'define("TEMPLATE_PATH", "' . TEMPLATE_PATH . '");' . "\n\n"
				  . 'define("TEMPLATE_PATH_ADMIN", "' . TEMPLATE_PATH_ADMIN . '");' . "\n\n"
				  . 'define("TEMPLATE_DEBUGGING", "0");' . "\n\n"
				  . 'define("TEMPLATE_COMPILE_CHECK", "1");' . "\n\n"
				  . 'define("TEMPLATE_FORCE_COMPILE", "0");' . "\n";

			if (!file_put_contents('core/conf/const.config.tmpl.php', $data)) {
				$arrErrors[] = ERROR_UNABLE_TO_SAVE_CONFIG;
			} else {
				$tmplMess = TMPL_SMARTY_SETUP_SUCCESS;
				$msEr = false;
			}
		}
	}

	$smarty -> assign('msEr', $msEr);
	$smarty -> assign('tmplMess', $tmplMess);
}
