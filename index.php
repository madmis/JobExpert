<?php

/**
 * JobExpert v1.0
 * Powered by Script Developers Group (SD-Group)
 * Email: info@sd-group.org.ua
 * URL: http://sd-group.org.ua/
 * Copyright 2010-2015 (c) SD-Group
 * All rights reserved
 * ==============================================
 * Главный файл
 * ==============================================
 *
 * @package
 *
 * @todo
 *
 */
// устанавливаем куки для работы одной сессии на всех поддоменах
//ini_set('session.cookie_domain', 'sd-group.org.ua');
session_start();
//setcookie(session_name(), session_id());
error_reporting(E_ALL);
//error_reporting(E_ALL ^ E_STRICT);
//error_reporting(E_ALL ^ E_DEPRECATED ^ E_STRICT);

/**
 * Защита от взлома
 */
define('SDG', true);

/**
 * Подключаем ядро
 */
require_once 'core/init.php';

// проверяем настройку техобслуживания сайта, если включена, перенаправляем пользователя на сервисное сообщение
if (CONF_SERVICE_ADMINISTRATION_MAINTENANCE) {
	$smarty->display('maintenance.tpl');
	exit;
}

// проверяем наличие запроса на редирект
if (!empty($_GET['redirect'])) {
	$smarty->assignByRef('redirect', $_GET['redirect']);
	$smarty->display('redirect.tpl');
	exit;
}

/**
 * Рабочая часть
 * Инициализация объектов
 */
$pages = new pages(); // дополнительные страницы
$news = new news(); // новости
$user = new user(); // пользователь
$group = new group(); // группа
$payments = new payments(); // платные услуги
$vacancy = new vacancy(); // вакансии
$resume = new resume(); // резюме

$smarty->assignByRef('currLang', $currLang);

/**
 * инициализация списка разделов
 */
$sections = new sections();
$arrDataSections = $sections->retCategorys();
$smarty->assignByRef('sections', $arrDataSections);

/**
 * инициализация списка профессий
 */
$professions = new professions();
$arrDataProfessions = $professions->retCategorys();
$smarty->assignByRef('professions', $arrDataProfessions);

/**
 * инициализация списка регионов
 */
$regions = new regions();
$arrDataRegions = $regions->retCategorys();
$smarty->assignByRef('regions', $arrDataRegions);

/**
 * инициализация списка городов
 */
$citys = new citys();
$arrDataCitys = $citys->retCategorys();
$smarty->assignByRef('citys', $arrDataCitys);

/**
 * Робот сайта
 * Запуск робота
 */
robot::start($arrRobotConf);

/**
 * Рассылка
 * Запуск рассылки
 * в течение трех часов с установленного времени
 */
if (time() >= CONF_SUBSCRIPTIONS_START_TIME && (time() < CONF_SUBSCRIPTIONS_START_TIME + 10800)) {
	include_once 'core/includes/do.subscription.php';
}

/**
 * Обработка текущей локализации
 */
if (1 < count($existLangs)) {
	foreach ($existLangs as &$lang) {
		$siteLangs[] = array('id' => &$lang, 'description' => @constant('SITE_LANGUAGE_' . strtoupper($lang)));
	}
} else {
	$siteLangs = false;
}
$smarty->assignByRef('siteLangs', $siteLangs);

/**
 * Передаем в Smarty системные словари (для доступа из всех шаблонов)
 */
$smarty->assignByRef('arrSysDict', $arrSysDict);

/**
 * Передаем в Smarty дополнительные словари (для доступа из всех шаблонов)
 */
$smarty->assignByRef('arrAddDict', $arrAddDict);

/**
 * Переменные по умолчанию
 * Здесь указаны переменные, использующиеся в большинстве файлов
 */
$arrErrors = array(); // массив для хранения ошибок
$arrWarnings = array(); // массив для хранения предупреждений
$arrNamePage = array(); // массив для хранения заголовков страницы

/**
 * Переменные Smarty (по умолчанию)
 * Здесь указаны переменные, использующиеся в большинстве шаблонов
 */
$main_template = 'main.tpl'; // шаблон главной страницы по умолчанию
$smarty->assign('menu', false); // активный пункт меню
$smarty->assign('errors', false); // массив обшибок
$smarty->assign('return_data', false); // значения, возвращаемые в форму

$smarty->assignByRef('arrPayments', $arrPayments); // значения, возвращаемые в форму

/**
 * Поключаем xml-файл с данными шаблона сайта
 */
$xmlTemplate = tools::getXmlTemplate();
$smarty->assignByRef('xmlTemplate', $xmlTemplate);

/**
 * получаем список дополнительных страниц для вывода в меню
 */
$arrPages = $pages->getActivePages(array('id', 'title'));
$smarty->assignByRef('dop_pages', $arrPages);

/**
 * ЧПУ
 */
chpu::setUrlToGet($group->arrTypes);
$chpu = new chpu();
$smarty->assignByRef('chpu', $chpu);

/**
 * МОДЫ
 */
$mods = new mods();
$smarty->assign('mods', $mods->getMods());

/**
 * AdSimple
 */
adsimple::checkMDAFile();
$smarty->assign('advert', new adsimple());
// END AdSimple

/**
 * проверяем, авторизацию пользователя
 */
if ($user->getAuthorized()) {
	if ('new' === $_SESSION['sd_user'][DB_PREFIX . 'conf']['token']) {
		if (!isset($_GET['do']) || 'select.type' !== $_GET['do']) {
			/**
			 * здесь тип пользователя competitor. Т.к. сейчас в сессии тип user
			 * и изменится только после того, как пользователь выберет необходимый тип пользователя
			 * это нормально, т.к. из формы выбора типа он никуда не может переходить
			 */
			die('<script type="text/javascript">window.location="' . chpu::createChpuUrl(CONF_SCRIPT_URL . 'index.php?ut=competitor&do=select.type') . '";</script>');
		}
	} elseif ('moderate' === $_SESSION['sd_user'][DB_PREFIX . 'conf']['token']) {
		$user_type = ('competitor' === $_SESSION['sd_user'][DB_PREFIX . 'conf']['user_type']) ? 'competitor' : 'employer';
		// очищаем куки и сессию пользователя
		$user->clearUserSessionAndCookie();
		messages::messageChangeSaved(MESSAGE_ACCOUNT_MODERATE, MESSAGE_ACCOUNT_MODERATE_TEXT, chpu::createChpuUrl(CONF_SCRIPT_URL . 'index.php?ut=' . $user_type), 10000);
	} elseif ('payment' === $_SESSION['sd_user'][DB_PREFIX . 'conf']['token']) {
		$user_type = ('employer' === $_SESSION['sd_user'][DB_PREFIX . 'conf']['user_type']) ? 'employer' : 'competitor';
		$_SESSION['payment'] = array('service' => 'register_' . strtolower($_SESSION['sd_user'][DB_PREFIX . 'conf']['user_type']), 'id' => $_SESSION['sd_user']['data']['id'], 'user_type' => $_SESSION['sd_user'][DB_PREFIX . 'conf']['user_type']);
		// очищаем куки и сессию пользователя
		$user->clearUserSessionAndCookie();
		messages::messageChangeSaved(MESSAGE_REGISTER_SUCCESS_DO_PAYMENT, MESSAGE_REGISTER_SUCCESS_DO_PAYMENT_TEXT, chpu::createChpuUrl(CONF_SCRIPT_URL . 'index.php?ut=' . $user_type . '&do=payments'), 10000);
	} else {
		$smarty->assignByRef('user_email', $_SESSION['sd_user']['data']['email']);
		$smarty->assign('user_type', $_SESSION['sd_user'][DB_PREFIX . 'conf']['user_type']);

		// передаем в Smarty права пользователя
		$smarty->assign('codex', $_SESSION['sd_' . DB_PREFIX . 'codex']); // значения, возвращаемые в форму
	}
} else {
	// если пользователь не вошел, проверяем его Кукисы и очищаем их, либо делаем автоматический вход
	if (!isset($_SESSION['sd_user']) && isset($_COOKIE['remid']) && $_COOKIE['remid'] && isset($_COOKIE['remh']) && $_COOKIE['remh']) { // проверяем, есть ли в кукисах наши параметры
		$arrData = $user->getUser("id IN (" . secure::escQuoteData((int) $_COOKIE['remid']) . ")");
		// если пользователь с таким id найден, сверяем хеш
		if (!empty($arrData)) {
			// выполняем вход
			if ($_COOKIE['remh'] === $user->cookieUserHash($arrData)) {
				$user->authorizeUser($arrData['email'], $arrData['password'], false, true);

				die('<script type="text/javascript">window.location="' . chpu::createChpuUrl(CONF_SCRIPT_URL . 'index.php?ut=' . $_SESSION['sd_user'][DB_PREFIX . 'conf']['user_type']) . '";</script>');
			}
			// удаляем куки
			else {
				cookies::deleteAccessCookie();
			}
		}
		// удаляем куки
		else {
			cookies::deleteAccessCookie();
		}
	}
	// удаляем куки
	else {
		cookies::deleteAccessCookie();
	}

	if (!isset($_SESSION['sd_' . DB_PREFIX . 'codex'])) {
		// записываем в сессию права пользователя
		$_SESSION['sd_' . DB_PREFIX . 'codex'] = $group->setUserRights('guest', 'guest');
	}

	// определяем тип пользователя, по умолчанию
	$_SESSION['sd_user'][DB_PREFIX . 'conf']['user_type'] = (!isset($_GET['ut'])) ? 'competitor' : (('competitor' !== $_GET['ut'] && 'employer' !== $_GET['ut']) ? 'competitor' : $_GET['ut']);

	$smarty->assign('user_email', false);
	$smarty->assign('user_type', $_SESSION['sd_user'][DB_PREFIX . 'conf']['user_type']);
	$smarty->assign('codex', $_SESSION['sd_' . DB_PREFIX . 'codex']); // значения, возвращаемые в форму
}

/**
 * обработка страниц
 */
if (isset($_GET['do'])) {
	// выход из пользовательской части
	if ('logout' === $_GET['do']) {
		// очищаем куки и сессию пользователя
		$user->clearUserSessionAndCookie();
		die('<script type="text/javascript">window.location="' . CONF_SCRIPT_URL . '";</script>');
	}
	// просмотр пользовательского соглашения
	elseif ('agreement' === $_GET['do']) {
		die(@file_get_contents(filesys::setPath(SD_ROOT_DIR) . 'lang/' . CONF_LANGUAGE . '/texts/agreement.html'));
	}
	// обработка модов
	elseif ('mod' === $_GET['do']) {
		if (isset($_GET['name']) && !empty($_GET['name'])) {
			$work_file = 'core/mod/' . $_GET['mod'] . '/mod.' . $_GET['mod'] . '.php';
			$template_file = SD_ROOT_DIR . 'core/mod/' . $_GET['mod'] . '/template/mod.' . $_GET['mod'] . '.tpl';

			// проверяем, существуют ли такие файлы
			if (@file_exists($work_file) && @file_exists($template_file)) {
				include_once $work_file;
				$main_template = $template_file;

				$smarty->assignByRef('menu', $_GET['mod']);
				$arrNamePage[] = array('name' => @constant('MOD_' . strtoupper(str_replace('.', '_', $_GET['mod'])) . '_MENU'), 'link' => false); // заголовок страницы
				// путь к папке шаблонов модуля
				$smarty->assign('template_path', SD_ROOT_DIR . 'core/mod/' . $_GET['mod'] . '/template');
			} else {
				messages::error404();
			}
		} else {
			messages::error404();
		}
	}
	// обработка do
	else {
		$smarty->assignByRef('menu', $_GET['do']);

		($constNamePage = @constant('MENU_' . strtoupper(str_replace('.', '_', $_GET['do'])))) ? $arrNamePage[] = array('name' => $constNamePage, 'link' => false) : null;

		$work_file = 'core/includes/' . $_GET['do'] . '.php';
		$template_file = $_GET['do'] . '.tpl';

		// проверяем, существуют ли такие файлы
		if (@file_exists($work_file) && @file_exists(TEMPLATE_PATH . $template_file)) {
			include_once $work_file;
			$main_template = $template_file;
		} else {
			messages::error404();
		}
	}
} else {
	// инициируем "Наименование страницы" отображаемое в заголовке формы
	//$arrNamePage[] = array('name' => SITE_WELCOME_MESSAGE, 'link' => false);

	$smarty->assign('menu', 'main');

	/**
	 * данные для блока VIP-объявлений
	 */
	// VIP-Вакансии
	if (CONF_VACANCY_VIP_SHOW && ('agent' === $_SESSION['sd_user'][DB_PREFIX . 'conf']['user_type'] || 'competitor' === $_SESSION['sd_user'][DB_PREFIX . 'conf']['user_type'])) {
		$vip['vacancy'] = $vacancy->getVipAnnounces();
		$cntRecords['vip']['vacancy'] = $vacancy->cntAnnounces();
	} else {
		$vip['vacancy'] = false;
	}
	// VIP-Резюме
	if (CONF_RESUME_VIP_SHOW && ('agent' === $_SESSION['sd_user'][DB_PREFIX . 'conf']['user_type'] || 'employer' === $_SESSION['sd_user'][DB_PREFIX . 'conf']['user_type'] || 'company' === $_SESSION['sd_user'][DB_PREFIX . 'conf']['user_type'])) {
		$vip['resume'] = $resume->getVipAnnounces();
		$cntRecords['vip']['resume'] = $resume->cntAnnounces();
	} else {
		$vip['resume'] = false;
	}
	// передаем данные в Smarty
	$smarty->assignByRef('vip', $vip);
	// END данные для блока VIP-объявлений

	/**
	 * данные для блока последних добавленных объявлений
	 */
	// последние Вакансии
	$last['vacancy'] = (CONF_VACANCY_LAST_SHOW && ('agent' === $_SESSION['sd_user'][DB_PREFIX . 'conf']['user_type'] || 'competitor' === $_SESSION['sd_user'][DB_PREFIX . 'conf']['user_type'])) ? $vacancy->getLastAnnounces() : false;
	// последние Резюме
	$last['resume'] = (CONF_RESUME_LAST_SHOW && ('agent' === $_SESSION['sd_user'][DB_PREFIX . 'conf']['user_type'] || 'employer' === $_SESSION['sd_user'][DB_PREFIX . 'conf']['user_type'] || 'company' === $_SESSION['sd_user'][DB_PREFIX . 'conf']['user_type'])) ? $resume->getLastAnnounces() : false;
	// последние Новости (главная страница)
	$last['newses'] = (CONF_NEWSES_LAST_SHOW) ? $news->getLastNewses() : false;
	// формируем данные для блока вывода логотипов на главной
	$mainLogo = (CONF_COMPANIES_SHOW_MAIN_LOGO && CONF_COMPANIES_SHOW_MAIN_LOGO_QTY > 0) ? $user->getLogoToMain() : false;
	$smarty->assignByRef('mainLogo', $mainLogo);
	// формируем данные для блока вывода логотипов на главной
	$mainAgnLogo = (CONF_AGENCIES_SHOW_MAIN_LOGO && CONF_AGENCIES_SHOW_MAIN_LOGO_QTY > 0) ? $user->getAgnLogoToMain() : false;
	$smarty->assignByRef('mainAgnLogo', $mainAgnLogo);
}

/**
 * данные для блока Горячих объявлений
 */
if (in_array('block.announces.hot.tpl', $xmlTemplate['left_side']) || in_array('block.announces.hot.tpl', $xmlTemplate['right_side'])) {
	$showVacancyHot = $showResumeHot = true;
} else {
	$showVacancyHot = (in_array('block.vacancy.hot.tpl', $xmlTemplate['left_side']) || in_array('block.vacancy.hot.tpl', $xmlTemplate['right_side'])) ? true : false;
	$showResumeHot = (in_array('block.resume.hot.tpl', $xmlTemplate['left_side']) || in_array('block.resume.hot.tpl', $xmlTemplate['right_side'])) ? true : false;
}
// HOT-Вакансии
if ($showVacancyHot && ('agent' === $_SESSION['sd_user'][DB_PREFIX . 'conf']['user_type']) || 'competitor' === $_SESSION['sd_user'][DB_PREFIX . 'conf']['user_type']) {
	$hot['vacancy'] = ('vacancy' === @$_GET['do']) ? (empty($arrActPage['hot']) ? $vacancy->getHotAnnounces() : false) : $vacancy->getHotAnnounces();
	$cntRecords['hot']['vacancy'] = (!empty($hot['vacancy'])) ? $vacancy->cntAnnounces() : false;
} else {
	$hot['vacancy'] = false;
}
// HOT-Резюме
if ($showResumeHot && ('agent' === $_SESSION['sd_user'][DB_PREFIX . 'conf']['user_type'] || 'employer' === $_SESSION['sd_user'][DB_PREFIX . 'conf']['user_type'] || 'company' === $_SESSION['sd_user'][DB_PREFIX . 'conf']['user_type'])) {
	$hot['resume'] = ('resume' === @$_GET['do']) ? (empty($arrActPage['hot']) ? $resume->getHotAnnounces() : false) : $resume->getHotAnnounces();
	$cntRecords['hot']['resume'] = (!empty($hot['resume'])) ? $resume->cntAnnounces() : false;
} else {
	$hot['resume'] = false;
}
$smarty->assignByRef('hot', $hot);
// END данные для блоков Горячих объявлений

/**
 * данные для блока Последних новостей (блок боковой панели сайта)
 */
(empty($last['newses']) && 'news' !== @$_GET['do'] && (in_array('block.newses.last.tpl', $xmlTemplate['left_side']) || in_array('block.newses.last.tpl', $xmlTemplate['right_side']))) ? $last['newses'] = $news->getLastNewses() : null;
// END данные для блока Последних новостей (блок боковой панели сайта)
// передаем данные в Smarty: Последние- Вакансии/Резюме/Новости
$smarty->assignByRef('last', $last);


/**
 * данные для блока Архив новостей (блок боковой панели сайта)
 */
$archive['news'] = false;
if (in_array('block.news.archive.tpl', $xmlTemplate['left_side']) || in_array('block.news.archive.tpl', $xmlTemplate['right_side'])) {
	$archive['news'] = $news->arcGenerateYears();
	$selectedYear = !empty($_GET['year']) ? $_GET['year'] : false;
	$selectedMonth = !empty($_GET['month']) ? $_GET['month'] : false;

	$smarty->assignByRef('selectedYear', $selectedYear);
	$smarty->assignByRef('selectedMonth', $selectedMonth);
	$smarty->assignByRef('archive', $archive);
}




// передаем в Smarty массив счетчиков полученных записей
(!empty($cntRecords)) ? $smarty->assignByRef('cntRecords', $cntRecords) : null;

// инициируем "Наименование страницы" отображаемое в заголовке формы
(!empty($arrNamePage) && is_array($arrNamePage)) ? $smarty->assignByRef('namePage', $arrNamePage) : $smarty->assign('namePage', false);

// передаем TITLE страницы в Smarty
if (!$smarty->getTemplateVars('page_title')) {
	$smarty->assign('page_title', (!empty($arrTitle)) ? strings::formTitle($arrTitle) : strings::formTitle($arrNamePage));
}

// инициируем данные для блока статистики
$statistics = tools::getStatistics($xmlTemplate, $vacancy, $resume, $user);
$smarty->assignByRef('statistics', $statistics);

// инициируем данные для блока кто онлайн
$whoOnline = tools::getWhoOnline($xmlTemplate, $user);
$smarty->assignByRef('whoOnline', $whoOnline);

/**
 * Собираем статистику запросов к БД
 */
$smarty->assign('ScriptWorkReport', array('ID-DataBase' => db::$db_id, 'CountAllQuerysToDB' => db::$cntAllQuerys, 'ListAllQuerysToDB' => db::$arrAllQuerys));

/**
 * Внешний (пользовательский) инклуд
 */
require_once 'core/includes/external.include.php';

/**
 * Передаем в Smarty выводимый шаблон и отображаем его
 */
$smarty->assignByRef('main_template', $main_template);
$smarty->display('index.tpl');
