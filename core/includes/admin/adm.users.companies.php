<?php
/********************************************************
	JobExpert v1.0
	powered by Script Developers Group (SD-Group)
	email: info@sd-group.org.ua
	url: http://sd-group.org.ua/
	Copyright 2010-2015 (c) SD-Group
	All rights reserved
=========================================================
	Менеджер компаний
********************************************************/
/**
* @package
* @todo
*/

(!defined('SDG')) ? die('Triple protection!') : null;

// инициируем "Наименование страницы" отображаемое в форме
$arrNamePage = array(
	array('name' => MENU_ADMIN_MAIN, 'link' => CONF_ADMIN_FILE),
	array('name' => MENU_MANAGER_USERS, 'link' => false),
	array('name' => MENU_COMPANIES, 'link' => false)
);

/**
* иницализация массива подключаемых шаблонов: по умолчанию все значения - false
* для подключения шаблона, необходимо установить значение - true
* шаблоны подключаются в порядке установленном в файле головного шаблона
*/
$arrActions = array(
	'config' => false,
	'seo' => false,
);

// определяем шаблон для отображения
(isset($_GET['action']) && isset($arrActions[$_GET['action']])) ? $arrActions[$_GET['action']] = true : null;

// создаем объект
$user = new user();

/**
* Настройки компаний
*/
if ($arrActions['config']) {
	// инициируем "Наименование страницы" отображаемое в форме
	$arrNamePage[] = array('name' => MENU_CONFIG, 'link' => false);

	// сохраняем данные, переданные из формы
	if (isset($_POST['save'])) {
		$data = "<?php\n\n"
			  . "(!defined('SDG')) ? die ('Triple protection!') : null;\n\n"
			  . 'define("CONF_COMPANIES_STRINGS_PERPAGE_ADMIN_PANEL", "' . ((int) $_POST['admperpage'] ? (int) abs($_POST['admperpage']) : 30) . '");' . "\n\n"
			  . 'define("CONF_COMPANIES_PERPAGE", "' . ((int) $_POST['perpage'] ? (int) abs($_POST['perpage']) : 30) . '");' . "\n\n"
			  . 'define("CONF_COMPANIES_SHOW_ONLY_WITH_LOGO", "' . ((!isset($_POST['with_logo'])) ? false : true) . '");' . "\n\n"
			  . 'define("CONF_COMPANIES_DELETE_LOGO", "' . ((!isset($_POST['delete_logo'])) ? false : true) . '");' . "\n\n"
			  . 'define("CONF_COMPANIES_USE_VISUAL_EDITOR", "' . ((!isset($_POST['html'])) ? false : true) . '");' . "\n\n"
			  . 'define("CONF_COMPANIES_SHOW_MAIN_LOGO", "' . ((!isset($_POST['show_main_logo'])) ? false : true) . '");' . "\n\n"
			  . 'define("CONF_COMPANIES_SHOW_MAIN_LOGO_QTY", "' . ((!empty($_POST['logo_qty']) && (int) $_POST['logo_qty']) ? (int) abs($_POST['logo_qty']) : 5) . '");' . "\n";

		// чистим кеш
		caching::clearCache('company.logo');

		if (!tools::saveConfig('core/conf/const.config.companies.php', $data, CONF_ADMIN_FILE . '?m=users&s=companies&action=config')) {
			$arrErrors[] = ERROR_FILES_MISSING_FILE;
		}
	}
} else if ($arrActions['seo']) {
	// инициируем "Наименование страницы" отображаемое в форме
	$arrNamePage[] = array('name' => MENU_SEO, 'link' => false);

	$selects = (isset($_POST['currLocaliz'])) ? new selects($_POST['currLocaliz']) : new selects();
	$currLang = $selects->retCurrLang();
	$smarty->assignByRef('currLang', $currLang); // текущая локализация
	// получаем список доступных дирректорий языков
	$langs = $selects->retLangs();
	$smarty->assignByRef('langs', $langs); // список доступных локализаций
	// URL где находится форма менеджера SEO
	$seoUrl = '?m=users&s=companies&action=seo';
	$smarty->assignByRef('seoUrl', $seoUrl);


	if (isset($_POST['save'])) {
		unset ($_POST['save']);
		if (!empty($_POST)) {
			foreach ($_POST as $key=>$val) {
				$file = str_replace("_", ".", $key);
				seo::saveSeoFile($file, $val, $currLang);
			}
			messages::messageChangeSaved(MESSAGE_CHANGE_SAVED, false, CONF_ADMIN_FILE . $seoUrl);
		}
	}

	$smarty->assign('seo', seo::getSeoFiles('companies', $currLang));

} else {
	/**
	* Действия
	*/
	if (!empty($_POST['action'])) {
		// отображение на главной
		if ('show' === $_POST['action'] && !empty($_POST['companies'])) {
			$user -> updateConfUser(array('main_logo' => 1), 'id IN (' . implode(',', secure::escQuoteData(array_keys($_POST['companies']))) . ')');
			messages::messageChangeSaved(MESSAGE_CHANGE_SAVED, false, CONF_ADMIN_FILE . '?m=users&s=companies');
		}
		// удаление с главной
		if ('remove' === $_POST['action'] && !empty($_POST['companies'])) {
			$user -> updateConfUser(array('main_logo' => 0), 'id IN (' . implode(',', secure::escQuoteData(array_keys($_POST['companies']))) . ')');
			messages::messageChangeSaved(MESSAGE_CHANGE_SAVED, false, CONF_ADMIN_FILE . '?m=users&s=companies');
		}
		// сортировка
		if ('sorting' === $_POST['action'] && !empty($_POST['sort'])) {
			foreach ($_POST['sort'] as $key => $value) {
				$user -> updateConfUser(array('sort_logo' => $value), 'id IN (' . secure::escQuoteData($key) . ')');
			}
			messages::messageChangeSaved(MESSAGE_CHANGE_SAVED, false, CONF_ADMIN_FILE . '?m=users&s=companies');
		}
	}

	//смещение, всегда 0 (затем берется из $_GET)
	$offset = isset($_GET['offset']) ? (int) abs($_GET['offset']) : 0;
	//получаем массив, содержащий текущий обработанный URL
	$path = CONF_ADMIN_FILE . '?m=users&s=companies&&amp;';

	$strWhere = "conf_users.token IN ('active') AND conf_users.user_type IN ('company')";
	$strLimit = $offset . ',' . CONF_COMPANIES_STRINGS_PERPAGE_ADMIN_PANEL;
	$arrOrderBy = array('conf_users.main_logo' => 'DESC', 'conf_users.sort_logo' => 'ASC', 'conf_users.logo' => 'DESC');
	$arrCompanies = $user -> getCombinedUsersData(false, $strWhere, $arrOrderBy, $strLimit);

	$allRecords = $user -> cntUsers();
	// формируем странциы
	$strPages = strings::generatePage($allRecords, $offset, CONF_COMPANIES_STRINGS_PERPAGE_ADMIN_PANEL, $path, true);
	//передаем в шаблон строку сформированных страниц
	$smarty->assignByRef('strPages', $strPages);

	$smarty -> assignByRef('arrCompanies', $arrCompanies);
	$smarty -> assignByRef('allRecords', $allRecords);
}

$smarty -> assignByRef('errors', $arrErrors);
$smarty -> assignByRef('action', $arrActions);