<?php

/**
 * JobExpert v1.0
 * Powered by Script Developers Group (SD-Group)
 * Email: info@sd-group.org.ua
 * URL: http://sd-group.org.ua/
 * Copyright 2010-2015 (c) SD-Group
 * All rights reserved
 * ===================================================
 * Объявления - Общие действия
 * ===================================================
 *
 * @package
 *
 * @todo
 *
 */
(!defined('SDG')) ? die('Triple protection!') : null;

/**
 * иницализация массива подключаемых шаблонов: по умолчанию все значения - false
 * для подключения шаблона, необходимо установить значение - true
 * шаблоны подключаются в порядке установленном в файле головного шаблона
 */
$arrActions = array(
	'confCommon' => false,
	'confVacancy' => false,
	'confQuestVacancy' => false,
	'confResume' => false,
	'confQuestResume' => false
);

// инициируем "Наименование страницы" отображаемое в форме
$arrNamePage = array(
	array('name' => MENU_ADMIN_MAIN, 'link' => CONF_ADMIN_FILE),
	array('name' => MENU_ANNOUNCES, 'link' => false),
);

/**
 * Настройки объявлений
 */
if (!empty($_GET['action']) && isset($arrActions[$_GET['action']])) {
	// инициируем вызываемый шаблон
	$arrActions[$_GET['action']] = true;

	/**
	 * Настройки объявлений - Общие
	 */
	if ($arrActions['confCommon']) {
		// инициируем "Наименование страницы" отображаемое в форме
		$arrNamePage[] = array('name' => MENU_CONFIG, 'link' => false);
		$arrNamePage[] = array('name' => MENU_ANNOUNCES_COMMON, 'link' => false);

		if (isset($_POST['save'])) { // сохраняем данные, переданные из формы
			$cauanmr = (isset($_POST['cauanmr'])) ? 1 : 0;
			$caasai = (isset($_POST['caasai'])) ? 1 : 0;
			$caasui = (isset($_POST['caasui'])) ? 1 : 0;
			$cauve = (isset($_POST['cauve'])) ? 1 : 0;
			$cap = (isset($_POST['cap'])) ? 1 : 0;
			$caps = (isset($_POST['caps']) && (int) $_POST['caps']) ? (int) abs($_POST['caps']) : 6;
			$capap = (isset($_POST['capap']) && (int) $_POST['capap']) ? (int) abs($_POST['capap']) : 15;
			$ccp = (isset($_POST['ccp']) && (int) $_POST['ccp']) ? (int) abs($_POST['ccp']) : 2;
			$ceafa = (isset($_POST['ceafa'])) ? 1 : 0;
			$ceamf = (isset($_POST['ceamf']) && (int) $_POST['ceamf']) ? (int) abs($_POST['ceamf']) : 1;
			$ceafms = (isset($_POST['ceafms']) && (int) $_POST['ceafms']) ? (int) abs($_POST['ceafms']) : 1024;

			$data = "<?php\n\n"
					. "(!defined('SDG')) ? die ('Triple protection!') : null;\n\n"
					. 'define("CONF_ANNOUNCE_USER_AGREEMENT_NOMEMBERS_REQUIRED", ' . $cauanmr . ');' . "\n\n"
					. 'define("CONF_ANNOUNCE_ADD_SUCCESS_ADMIN_INFORM", ' . $caasai . ');' . "\n\n"
					. 'define("CONF_ANNOUNCE_ADD_SUCCESS_USER_INFORM", ' . $caasui . ');' . "\n\n"
					. 'define("CONF_ANNOUNCE_USE_VISUAL_EDITOR", ' . $cauve . ');' . "\n\n"
					. 'define("CONF_ANNOUNCE_PREVIEW", ' . $cap . ');' . "\n\n"
					. 'define("CONF_ANNOUNCE_PERPAGE_SITE", ' . $caps . ');' . "\n\n"
					. 'define("CONF_ANNOUNCE_PERPAGE_ADMIN_PANEL", ' . $capap . ');' . "\n\n"
					. 'define("CONF_CATEGORY_PERLINE", ' . $ccp . ');' . "\n\n"
					. 'define("CONF_EMAIL_ATTACHMENT_FILES_ALLOW", ' . $ceafa . ');' . "\n\n"
					. 'define("CONF_EMAIL_ATTACHMENT_MAX_FILES", ' . $ceamf . ');' . "\n\n"
					. 'define("CONF_EMAIL_ATTACHMENT_FILE_MAX_SIZE", ' . $ceafms . ');' . "\n\n"
					. 'define("CONF_VACANCY_ACTIVATE_THERM", ' . CONF_VACANCY_ACTIVATE_THERM . ');' . "\n\n"
					. 'define("CONF_VACANCY_CORRECTION_THERM", ' . CONF_VACANCY_CORRECTION_THERM . ');' . "\n\n"
					. 'define("CONF_VACANCY_PAYMENT_THERM", ' . CONF_VACANCY_PAYMENT_THERM . ');' . "\n\n"
					. 'define("CONF_VACANCY_VIP_THERM", ' . CONF_VACANCY_VIP_THERM . ');' . "\n\n"
					. 'define("CONF_VACANCY_VIP_SHOW", ' . CONF_VACANCY_VIP_SHOW . ');' . "\n\n"
					. 'define("CONF_VACANCY_VIP_SHOW_PERPAGE", ' . CONF_VACANCY_VIP_SHOW_PERPAGE . ');' . "\n\n"
					. 'define("CONF_VACANCY_HOT_THERM", ' . CONF_VACANCY_HOT_THERM . ');' . "\n\n"
					. 'define("CONF_VACANCY_HOT_SHOW_PERPAGE", ' . CONF_VACANCY_HOT_SHOW_PERPAGE . ');' . "\n\n"
					. 'define("CONF_VACANCY_LAST_SHOW", ' . CONF_VACANCY_LAST_SHOW . ');' . "\n\n"
					. 'define("CONF_VACANCY_LAST_SHOW_PERPAGE", ' . CONF_VACANCY_LAST_SHOW_PERPAGE . ');' . "\n\n"
					. 'define("CONF_RESUME_ACTIVATE_THERM", ' . CONF_RESUME_ACTIVATE_THERM . ');' . "\n\n"
					. 'define("CONF_RESUME_CORRECTION_THERM", ' . CONF_RESUME_CORRECTION_THERM . ');' . "\n\n"
					. 'define("CONF_RESUME_PAYMENT_THERM", ' . CONF_RESUME_PAYMENT_THERM . ');' . "\n\n"
					. 'define("CONF_RESUME_VIP_THERM", ' . CONF_RESUME_VIP_THERM . ');' . "\n\n"
					. 'define("CONF_RESUME_VIP_SHOW", ' . CONF_RESUME_VIP_SHOW . ');' . "\n\n"
					. 'define("CONF_RESUME_VIP_SHOW_PERPAGE", ' . CONF_RESUME_VIP_SHOW_PERPAGE . ');' . "\n\n"
					. 'define("CONF_RESUME_HOT_THERM", ' . CONF_RESUME_HOT_THERM . ');' . "\n\n"
					. 'define("CONF_RESUME_HOT_SHOW_PERPAGE", ' . CONF_RESUME_HOT_SHOW_PERPAGE . ');' . "\n\n"
					. 'define("CONF_RESUME_LAST_SHOW", ' . CONF_RESUME_LAST_SHOW . ');' . "\n\n"
					. 'define("CONF_RESUME_LAST_SHOW_PERPAGE", ' . CONF_RESUME_LAST_SHOW_PERPAGE . ');' . "\n\n"
					. 'define("CONF_RESUME_ADD_PHOTO", ' . CONF_RESUME_ADD_PHOTO . ');' . "\n\n"
					. 'define("CONF_RESUME_ADD_PHOTO_MAXWIDTH", ' . CONF_RESUME_ADD_PHOTO_MAXWIDTH . ');' . "\n\n"
					. 'define("CONF_RESUME_ADD_PHOTO_MAXHEIGHT", ' . CONF_RESUME_ADD_PHOTO_MAXHEIGHT . ');' . "\n\n"
					. 'define("CONF_RESUME_ADD_PHOTO_FILE_MAXSIZE", ' . CONF_RESUME_ADD_PHOTO_FILE_MAXSIZE . ');' . "\n";

			if (!tools::saveConfig('core/conf/const.config.announces.php', $data, CONF_ADMIN_FILE . '?m=announces&s=common&action=confCommon')) {
				$arrErrors[] = ERROR_FILES_MISSING_FILE;
			}
		}
	}

	/**
	 * Настройки объявлений - Вакансии
	 */
	if ($arrActions['confVacancy']) {
		// инициируем "Наименование страницы" отображаемое в форме
		$arrNamePage[] = array('name' => MENU_ANNOUNCES_VACANCYS, 'link' => false);
		$arrNamePage[] = array('name' => MENU_CONFIG, 'link' => false);

		$vacancy = new vacancy();

		if (isset($_POST['save'])) { // сохраняем данные настроек, переданные из формы
			$cvat = (isset($_POST['cvat']) && (int) $_POST['cvat']) ? (int) abs($_POST['cvat']) : 72;
			$cvpt = (isset($_POST['cvpt']) && (int) $_POST['cvpt']) ? (int) abs($_POST['cvpt']) : 72;
			$cvct = (isset($_POST['cvct']) && (int) $_POST['cvct']) ? (int) abs($_POST['cvct']) : 72;
			$cvvipt = (isset($_POST['cvvipt']) && (int) $_POST['cvvipt']) ? (int) abs($_POST['cvvipt']) : 0;
			$cvvips = (isset($_POST['cvvips'])) ? 1 : 0;
			$cvvipsp = (isset($_POST['cvvipsp']) && (int) $_POST['cvvipsp']) ? (int) abs($_POST['cvvipsp']) : 5;
			$cvhott = (isset($_POST['cvhott']) && (int) $_POST['cvhott']) ? (int) abs($_POST['cvhott']) : 0;
			$cvhotsp = (isset($_POST['cvhotsp']) && (int) $_POST['cvhotsp']) ? (int) abs($_POST['cvhotsp']) : 5;
			$cvls = (isset($_POST['cvls'])) ? 1 : 0;
			$cvlsp = (isset($_POST['cvlsp']) && (int) $_POST['cvlsp']) ? (int) abs($_POST['cvlsp']) : 5;

			$data = "<?php\n\n"
					. "(!defined('SDG')) ? die ('Triple protection!') : null;\n\n"
					. 'define("CONF_ANNOUNCE_USER_AGREEMENT_NOMEMBERS_REQUIRED", ' . CONF_ANNOUNCE_USER_AGREEMENT_NOMEMBERS_REQUIRED . ');' . "\n\n"
					. 'define("CONF_ANNOUNCE_ADD_SUCCESS_ADMIN_INFORM", ' . CONF_ANNOUNCE_ADD_SUCCESS_ADMIN_INFORM . ');' . "\n\n"
					. 'define("CONF_ANNOUNCE_ADD_SUCCESS_USER_INFORM", ' . CONF_ANNOUNCE_ADD_SUCCESS_USER_INFORM . ');' . "\n\n"
					. 'define("CONF_ANNOUNCE_USE_VISUAL_EDITOR", ' . CONF_ANNOUNCE_USE_VISUAL_EDITOR . ');' . "\n\n"
					. 'define("CONF_ANNOUNCE_PREVIEW", ' . CONF_ANNOUNCE_PREVIEW . ');' . "\n\n"
					. 'define("CONF_ANNOUNCE_PERPAGE_SITE", ' . CONF_ANNOUNCE_PERPAGE_SITE . ');' . "\n\n"
					. 'define("CONF_ANNOUNCE_PERPAGE_ADMIN_PANEL", ' . CONF_ANNOUNCE_PERPAGE_ADMIN_PANEL . ');' . "\n\n"
					. 'define("CONF_CATEGORY_PERLINE", ' . CONF_CATEGORY_PERLINE . ');' . "\n\n"
					. 'define("CONF_EMAIL_ATTACHMENT_FILES_ALLOW", ' . CONF_EMAIL_ATTACHMENT_FILES_ALLOW . ');' . "\n\n"
					. 'define("CONF_EMAIL_ATTACHMENT_MAX_FILES", ' . CONF_EMAIL_ATTACHMENT_MAX_FILES . ');' . "\n\n"
					. 'define("CONF_EMAIL_ATTACHMENT_FILE_MAX_SIZE", ' . CONF_EMAIL_ATTACHMENT_FILE_MAX_SIZE . ');' . "\n\n"
					. 'define("CONF_VACANCY_ACTIVATE_THERM", ' . $cvat . ');' . "\n\n"
					. 'define("CONF_VACANCY_CORRECTION_THERM", ' . $cvct . ');' . "\n\n"
					. 'define("CONF_VACANCY_PAYMENT_THERM", ' . $cvpt . ');' . "\n\n"
					. 'define("CONF_VACANCY_VIP_THERM", ' . $cvvipt . ');' . "\n\n"
					. 'define("CONF_VACANCY_VIP_SHOW", ' . $cvvips . ');' . "\n\n"
					. 'define("CONF_VACANCY_VIP_SHOW_PERPAGE", ' . $cvvipsp . ');' . "\n\n"
					. 'define("CONF_VACANCY_HOT_THERM", ' . $cvhott . ');' . "\n\n"
					. 'define("CONF_VACANCY_HOT_SHOW_PERPAGE", ' . $cvhotsp . ');' . "\n\n"
					. 'define("CONF_VACANCY_LAST_SHOW", ' . $cvls . ');' . "\n\n"
					. 'define("CONF_VACANCY_LAST_SHOW_PERPAGE", ' . $cvlsp . ');' . "\n\n"
					. 'define("CONF_RESUME_ACTIVATE_THERM", ' . CONF_RESUME_ACTIVATE_THERM . ');' . "\n\n"
					. 'define("CONF_RESUME_CORRECTION_THERM", ' . CONF_RESUME_CORRECTION_THERM . ');' . "\n\n"
					. 'define("CONF_RESUME_PAYMENT_THERM", ' . CONF_RESUME_PAYMENT_THERM . ');' . "\n\n"
					. 'define("CONF_RESUME_VIP_THERM", ' . CONF_RESUME_VIP_THERM . ');' . "\n\n"
					. 'define("CONF_RESUME_VIP_SHOW", ' . CONF_RESUME_VIP_SHOW . ');' . "\n\n"
					. 'define("CONF_RESUME_VIP_SHOW_PERPAGE", ' . CONF_RESUME_VIP_SHOW_PERPAGE . ');' . "\n\n"
					. 'define("CONF_RESUME_HOT_THERM", ' . CONF_RESUME_HOT_THERM . ');' . "\n\n"
					. 'define("CONF_RESUME_HOT_SHOW_PERPAGE", ' . CONF_RESUME_HOT_SHOW_PERPAGE . ');' . "\n\n"
					. 'define("CONF_RESUME_LAST_SHOW", ' . CONF_RESUME_LAST_SHOW . ');' . "\n\n"
					. 'define("CONF_RESUME_LAST_SHOW_PERPAGE", ' . CONF_RESUME_LAST_SHOW_PERPAGE . ');' . "\n\n"
					. 'define("CONF_RESUME_ADD_PHOTO", ' . CONF_RESUME_ADD_PHOTO . ');' . "\n\n"
					. 'define("CONF_RESUME_ADD_PHOTO_MAXWIDTH", ' . CONF_RESUME_ADD_PHOTO_MAXWIDTH . ');' . "\n\n"
					. 'define("CONF_RESUME_ADD_PHOTO_MAXHEIGHT", ' . CONF_RESUME_ADD_PHOTO_MAXHEIGHT . ');' . "\n\n"
					. 'define("CONF_RESUME_ADD_PHOTO_FILE_MAXSIZE", ' . CONF_RESUME_ADD_PHOTO_FILE_MAXSIZE . ');' . "\n";

			// чистим кеш
			caching::clearCache('vacancy.last');
			// сохраняем изменения
			if (!tools::saveConfig('core/conf/const.config.announces.php', $data, CONF_ADMIN_FILE . '?m=announces&s=common&action=confVacancy')) {
				$arrErrors[] = ERROR_FILES_MISSING_FILE;
			}
		} elseif (isset($_POST['sort']) && isset($_POST['arrSortList'])) { // сохраняем данные сортировки, переданные из формы
			(!$vacancy->putSortFields($_POST['arrSortList'])) ? messages::printDie(ERROR_FILE_NOT_WRITE) : messages::messageChangeSaved(MESSAGE_CHANGE_SAVED, false, CONF_ADMIN_FILE . '?m=announces&s=common&action=confVacancy');
		} elseif (isset($_POST['pTitle']) && !empty($_POST['title']) && is_array($_POST['title'])) { // сохраняем данные, переданные из формы
			$arrTitle = array();
			foreach ($_POST['title'] as &$value) {
				$arrTitle[] = "	array('name' => " . stripcslashes($value) . ')';
			}

			$data = "<?php\n"
					. '$arrTitle = array(' . "\n"
					. implode(",\n", $arrTitle)
					. "\n);\n";

			(!file_put_contents('core/data/vacancy.pagetitle.pda', $data)) ? messages::printDie(ERROR_FILE_NOT_WRITE) : messages::messageChangeSaved(MESSAGE_CHANGE_SAVED, false, CONF_ADMIN_FILE . '?m=announces&s=common&action=confVacancy');
		}

		// данные сортировки Вакансий в списках отображения
		$smarty->assign('sortFields', $vacancy->retSortFields());

		// данные TITLE-страниц просмотра Вакансий
		$arrTitle = array();
		if (file_exists('core/data/vacancy.pagetitle.pda')) {
			foreach (file('core/data/vacancy.pagetitle.pda') as $value) {
				if (false !== strpos($value, "array('name'")) {
					$varName = str_replace(array("\t", "array('name' => ", ")", ",", "\r", "\n"), '', $value);
					$discription = explode("'", $varName);
					$arrTitle[$discription[1]] = array(
						'discription' => constant('ANNOUNCE_PAGE_TITLE_DESCRIPT_' . strtoupper($discription[1])),
						'varValue' => $varName,
						'varChecked' => true
					);
				}
			}
		}

		$arrVacancyTitle = array(
			'title' => array(
				'discription' => ANNOUNCE_PAGE_TITLE_DESCRIPT_TITLE,
				'varValue' => '&$return_data[\'title\']',
				'varChecked' => false
			),
			'company_name' => array(
				'discription' => ANNOUNCE_PAGE_TITLE_DESCRIPT_COMPANY_NAME,
				'varValue' => '&$return_data[\'company_name\']',
				'varChecked' => false
			),
			'id_section' => array(
				'discription' => ANNOUNCE_PAGE_TITLE_DESCRIPT_ID_SECTION,
				'varValue' => '&$arrDataSections[$return_data[\'id_section\']][\'name\']',
				'varChecked' => false
			),
			'id_profession' => array(
				'discription' => ANNOUNCE_PAGE_TITLE_DESCRIPT_ID_PROFESSION,
				'varValue' => '&$arrDataProfession[$return_data[\'id_profession\']][\'name\']',
				'varChecked' => false
			),
			'id_region' => array(
				'discription' => ANNOUNCE_PAGE_TITLE_DESCRIPT_ID_REGION,
				'varValue' => '&$arrDataRegions[$return_data[\'id_region\']][\'name\']',
				'varChecked' => false
			),
			'id_city' => array(
				'discription' => ANNOUNCE_PAGE_TITLE_DESCRIPT_ID_CITY,
				'varValue' => '&$arrDataCity[$return_data[\'id_city\']][\'name\']',
				'varChecked' => false
			),
		);

		$smarty->assign('pTitle', $arrTitle + $arrVacancyTitle);
	}

	/**
	 * Настройки анкеты - Вакансии
	 */
	if ($arrActions['confQuestVacancy']) {
		// инициируем "Наименование страницы" отображаемое в форме
		$arrNamePage[] = array('name' => MENU_ANNOUNCES_VACANCYS, 'link' => false);
		$arrNamePage[] = array('name' => MENU_ANNOUNCES_CONFIG_QUESTIONARY, 'link' => false);

		$arrBindFields = filesys::getSerializedData('core/data/vacancy.bindfields.mda') or $arrBindFields = array();
		$arrNoBindFields = filesys::getSerializedData('core/data/vacancy.nobindfields.mda') or $arrNoBindFields = array();

		$arrBasicFields = array(
			'arrBindFields' => & $arrBindFields,
			'arrNoBindFields' => & $arrNoBindFields
		);

		if (isset($_POST['save'])) { // сохраняем данные, переданные из формы
			/**
			 * Определяем массивы, если пришел пустой результат
			 */
			if (empty($_POST['arrBasicFields']['arrBindFields']) || !is_array($_POST['arrBasicFields']['arrBindFields'])) {
				$_POST['arrBasicFields']['arrBindFields'] = array();
			}

			// вычисляем основные поля анкеты
			// необязательные
			$arrNoBindFields = array_merge(
					array_diff_key($arrBindFields, $_POST['arrBasicFields']['arrBindFields']), array_diff_key($arrNoBindFields, $_POST['arrBasicFields']['arrBindFields'])
			);
			// обязательные
			$arrBindFields = & $_POST['arrBasicFields']['arrBindFields'];

			/**
			 * Сохраняем результаты
			 */
			if (filesys::putSerializedData('core/data/vacancy.bindfields.mda', $arrBindFields) &&
					filesys::putSerializedData('core/data/vacancy.nobindfields.mda', $arrNoBindFields)) {
				$vacancy = new vacancy();
				$arrSearch = $arrRreplace = array();
				/**
				 * массив поиска/замены для основных полей анкеты
				 */
				// обязательные поля
				$arrBindFields = $vacancy->arrBindFields;
				foreach (array_keys($arrBindFields) as $alias) {
					array_push(
							$arrSearch, 'arrNoBindFields[' . $alias . ']', '$arrNoBindFields.' . $alias, '$return_data.arrNoBindFields.' . $alias
					);
					array_push(
							$arrRreplace, 'arrBindFields[' . $alias . ']', '$arrBindFields.' . $alias, '$return_data.arrBindFields.' . $alias
					);
				}
				// необязательные поля
				$arrNoBindFields = $vacancy->arrNoBindFields;
				foreach (array_keys($arrNoBindFields) as $alias) {
					array_push(
							$arrSearch, 'arrBindFields[' . $alias . ']', '$arrBindFields.' . $alias, '$return_data.arrBindFields.' . $alias
					);
					array_push(
							$arrRreplace, 'arrNoBindFields[' . $alias . ']', '$arrNoBindFields.' . $alias, '$return_data.arrNoBindFields.' . $alias
					);
				}

				/**
				 * Производим поиск/замену во всех шаблонах скрипта
				 */
				foreach (filesys::getChildDirs('templates/site/') as $template) {
					$formFileName = 'templates/site/' . $template . '/vacancy.form.tpl';
					if (is_file($formFileName)) {
						file_put_contents(
								$formFileName, str_replace(
										$arrSearch, $arrRreplace, file_get_contents($formFileName)
								)
						);
					}

					$formFileName = 'templates/site/' . $template . '/vacancy.preview.tpl';
					if (is_file($formFileName)) {
						file_put_contents(
								$formFileName, str_replace(
										$arrSearch, $arrRreplace, file_get_contents($formFileName)
								)
						);
					}
				}

				file_put_contents(
						'templates/admin/adm.announces.vacancy.edit.tpl', str_replace(
								$arrSearch, $arrRreplace, file_get_contents('templates/admin/adm.announces.vacancy.edit.tpl')
						)
				);

				messages::messageChangeSaved(MESSAGE_CHANGE_SAVED, false, CONF_ADMIN_FILE . '?m=announces&s=common&action=confQuestVacancy');
			} else {
				messages::printDie(ERROR_FILE_NOT_WRITE);
			}
		}

		$arrDescriptFields = array();
		// Описание основных полей анкеты
		foreach (array_keys(array_merge($arrBindFields, $arrNoBindFields)) as $indexField) {
			$arrDescriptFields['basic'][$indexField] = @constant('ANNOUNCE_BASIC_FIELD_DESCRIPT_' . strtoupper($indexField)) or $arrDescriptFields['basic'][$indexField] = @constant('VACANCY_BASIC_FIELD_DESCRIPT_' . strtoupper($indexField));
		}

		$smarty->assignByRef('arrDescriptFields', $arrDescriptFields);
		$smarty->assignByRef('arrBasicFields', $arrBasicFields);
	}

	/**
	 * Настройки объявлений - Резюме
	 */
	if ($arrActions['confResume']) {
		// инициируем "Наименование страницы" отображаемое в форме
		$arrNamePage[] = array('name' => MENU_ANNOUNCES_RESUMES, 'link' => false);
		$arrNamePage[] = array('name' => MENU_CONFIG, 'link' => false);

		$resume = new resume();

		if (isset($_POST['save'])) { // сохраняем данные, переданные из формы
			$crat = (isset($_POST['crat']) && (int) $_POST['crat']) ? (int) abs($_POST['crat']) : 72;
			$crpt = (isset($_POST['crpt']) && (int) $_POST['crpt']) ? (int) abs($_POST['crpt']) : 72;
			$crct = (isset($_POST['crct']) && (int) $_POST['crct']) ? (int) abs($_POST['crct']) : 72;
			$crvipt = (isset($_POST['crvipt']) && (int) $_POST['crvipt']) ? (int) abs($_POST['crvipt']) : 0;
			$crvips = (isset($_POST['crvips'])) ? 1 : 0;
			$crvipsp = (isset($_POST['crvipsp']) && (int) $_POST['crvipsp']) ? (int) abs($_POST['crvipsp']) : 5;
			$crhott = (isset($_POST['crhott']) && (int) $_POST['crhott']) ? (int) abs($_POST['crhott']) : 0;
			$crhotsp = (isset($_POST['crhotsp']) && (int) $_POST['crhotsp']) ? (int) abs($_POST['crhotsp']) : 5;
			$crls = (isset($_POST['crls'])) ? 1 : 0;
			$crlsp = (isset($_POST['crlsp']) && (int) $_POST['crlsp']) ? (int) abs($_POST['crlsp']) : 5;
			$crap = (isset($_POST['crap'])) ? 1 : 0;
			$crapmw = (isset($_POST['crapmw']) && (int) $_POST['crapmw']) ? (int) abs($_POST['crapmw']) : 150;
			$crapmh = (isset($_POST['crapmh']) && (int) $_POST['crapmh']) ? (int) abs($_POST['crapmh']) : 150;
			$crapfms = (isset($_POST['crapfms']) && (int) $_POST['crapfms']) ? (int) abs($_POST['crapfms']) : 1024;

			$data = "<?php\n\n"
					. "(!defined('SDG')) ? die ('Triple protection!') : null;\n\n"
					. 'define("CONF_ANNOUNCE_USER_AGREEMENT_NOMEMBERS_REQUIRED", ' . CONF_ANNOUNCE_USER_AGREEMENT_NOMEMBERS_REQUIRED . ');' . "\n\n"
					. 'define("CONF_ANNOUNCE_ADD_SUCCESS_ADMIN_INFORM", ' . CONF_ANNOUNCE_ADD_SUCCESS_ADMIN_INFORM . ');' . "\n\n"
					. 'define("CONF_ANNOUNCE_ADD_SUCCESS_USER_INFORM", ' . CONF_ANNOUNCE_ADD_SUCCESS_USER_INFORM . ');' . "\n\n"
					. 'define("CONF_ANNOUNCE_USE_VISUAL_EDITOR", ' . CONF_ANNOUNCE_USE_VISUAL_EDITOR . ');' . "\n\n"
					. 'define("CONF_ANNOUNCE_PREVIEW", ' . CONF_ANNOUNCE_PREVIEW . ');' . "\n\n"
					. 'define("CONF_ANNOUNCE_PERPAGE_SITE", ' . CONF_ANNOUNCE_PERPAGE_SITE . ');' . "\n\n"
					. 'define("CONF_ANNOUNCE_PERPAGE_ADMIN_PANEL", ' . CONF_ANNOUNCE_PERPAGE_ADMIN_PANEL . ');' . "\n\n"
					. 'define("CONF_CATEGORY_PERLINE", ' . CONF_CATEGORY_PERLINE . ');' . "\n\n"
					. 'define("CONF_EMAIL_ATTACHMENT_FILES_ALLOW", ' . CONF_EMAIL_ATTACHMENT_FILES_ALLOW . ');' . "\n\n"
					. 'define("CONF_EMAIL_ATTACHMENT_MAX_FILES", ' . CONF_EMAIL_ATTACHMENT_MAX_FILES . ');' . "\n\n"
					. 'define("CONF_EMAIL_ATTACHMENT_FILE_MAX_SIZE", ' . CONF_EMAIL_ATTACHMENT_FILE_MAX_SIZE . ');' . "\n\n"
					. 'define("CONF_VACANCY_ACTIVATE_THERM", ' . CONF_VACANCY_ACTIVATE_THERM . ');' . "\n\n"
					. 'define("CONF_VACANCY_CORRECTION_THERM", ' . CONF_VACANCY_CORRECTION_THERM . ');' . "\n\n"
					. 'define("CONF_VACANCY_PAYMENT_THERM", ' . CONF_VACANCY_PAYMENT_THERM . ');' . "\n\n"
					. 'define("CONF_VACANCY_VIP_THERM", ' . CONF_VACANCY_VIP_THERM . ');' . "\n\n"
					. 'define("CONF_VACANCY_VIP_SHOW", ' . CONF_VACANCY_VIP_SHOW . ');' . "\n\n"
					. 'define("CONF_VACANCY_VIP_SHOW_PERPAGE", ' . CONF_VACANCY_VIP_SHOW_PERPAGE . ');' . "\n\n"
					. 'define("CONF_VACANCY_HOT_THERM", ' . CONF_VACANCY_HOT_THERM . ');' . "\n\n"
					. 'define("CONF_VACANCY_HOT_SHOW_PERPAGE", ' . CONF_VACANCY_HOT_SHOW_PERPAGE . ');' . "\n\n"
					. 'define("CONF_VACANCY_LAST_SHOW", ' . CONF_VACANCY_LAST_SHOW . ');' . "\n\n"
					. 'define("CONF_VACANCY_LAST_SHOW_PERPAGE", ' . CONF_VACANCY_LAST_SHOW_PERPAGE . ');' . "\n\n"
					. 'define("CONF_RESUME_ACTIVATE_THERM", ' . $crat . ');' . "\n\n"
					. 'define("CONF_RESUME_CORRECTION_THERM", ' . $crct . ');' . "\n\n"
					. 'define("CONF_RESUME_PAYMENT_THERM", ' . $crpt . ');' . "\n\n"
					. 'define("CONF_RESUME_VIP_THERM", ' . $crvipt . ');' . "\n\n"
					. 'define("CONF_RESUME_VIP_SHOW", ' . $crvips . ');' . "\n\n"
					. 'define("CONF_RESUME_VIP_SHOW_PERPAGE", ' . $crvipsp . ');' . "\n\n"
					. 'define("CONF_RESUME_HOT_THERM", ' . $crhott . ');' . "\n\n"
					. 'define("CONF_RESUME_HOT_SHOW_PERPAGE", ' . $crhotsp . ');' . "\n\n"
					. 'define("CONF_RESUME_LAST_SHOW", ' . $crls . ');' . "\n\n"
					. 'define("CONF_RESUME_LAST_SHOW_PERPAGE", ' . $crlsp . ');' . "\n\n"
					. 'define("CONF_RESUME_ADD_PHOTO", ' . $crap . ');' . "\n\n"
					. 'define("CONF_RESUME_ADD_PHOTO_MAXWIDTH", ' . $crapmw . ');' . "\n\n"
					. 'define("CONF_RESUME_ADD_PHOTO_MAXHEIGHT", ' . $crapmh . ');' . "\n\n"
					. 'define("CONF_RESUME_ADD_PHOTO_FILE_MAXSIZE", ' . $crapfms . ');' . "\n";

			// чистим кеш
			caching::clearCache('resume.last');
			// сохраняем изменения
			if (!tools::saveConfig('core/conf/const.config.announces.php', $data, CONF_ADMIN_FILE . '?m=announces&s=common&action=confResume')) {
				$arrErrors[] = ERROR_FILES_MISSING_FILE;
			}
		} elseif (isset($_POST['sort']) && isset($_POST['arrSortList'])) { // сохраняем данные сортировки, переданные из формы
			(!$resume->putSortFields($_POST['arrSortList'])) ? messages::printDie(ERROR_FILE_NOT_WRITE) : messages::messageChangeSaved(MESSAGE_CHANGE_SAVED, false, CONF_ADMIN_FILE . '?m=announces&s=common&action=confResume');
		} elseif (isset($_POST['pTitle']) && !empty($_POST['title']) && is_array($_POST['title'])) { // сохраняем данные, переданные из формы
			$arrTitle = array();
			foreach ($_POST['title'] as &$value) {
				$arrTitle[] = "	array('name' => " . stripcslashes($value) . ')';
			}

			$data = "<?php\n"
					. '$arrTitle = array(' . "\n"
					. implode(",\n", $arrTitle)
					. "\n);\n";

			(!file_put_contents('core/data/resume.pagetitle.pda', $data)) ? messages::printDie(ERROR_FILE_NOT_WRITE) : messages::messageChangeSaved(MESSAGE_CHANGE_SAVED, false, CONF_ADMIN_FILE . '?m=announces&s=common&action=confResume');
		}

		// данные сортировки Резюме в списках отображения
		$smarty->assign('sortFields', $resume->retSortFields());

		// данные TITLE-страниц просмотра Резюме
		$arrTitle = array();
		if (file_exists('core/data/resume.pagetitle.pda')) {
			foreach (file('core/data/resume.pagetitle.pda') as $value) {
				if (false !== strpos($value, "array('name'")) {
					$varName = str_replace(array("\t", "array('name' => ", ")", ",", "\r", "\n"), '', $value);
					$discription = explode("'", $varName);
					$arrTitle[$discription[1]] = array(
						'discription' => constant('ANNOUNCE_PAGE_TITLE_DESCRIPT_' . strtoupper($discription[1])),
						'varValue' => $varName,
						'varChecked' => true
					);
				}
			}
		}

		$arrResumeTitle = array(
			'title' => array(
				'discription' => ANNOUNCE_PAGE_TITLE_DESCRIPT_TITLE,
				'varValue' => '&$return_data[\'title\']',
				'varChecked' => false
			),
			'id_section' => array(
				'discription' => ANNOUNCE_PAGE_TITLE_DESCRIPT_ID_SECTION,
				'varValue' => '&$arrDataSections[$return_data[\'id_section\']][\'name\']',
				'varChecked' => false
			),
			'id_profession' => array(
				'discription' => ANNOUNCE_PAGE_TITLE_DESCRIPT_ID_PROFESSION,
				'varValue' => '&$arrDataProfession[$return_data[\'id_profession\']][\'name\']',
				'varChecked' => false
			),
			'id_region' => array(
				'discription' => ANNOUNCE_PAGE_TITLE_DESCRIPT_ID_REGION,
				'varValue' => '&$arrDataRegions[$return_data[\'id_region\']][\'name\']',
				'varChecked' => false
			),
			'id_city' => array(
				'discription' => ANNOUNCE_PAGE_TITLE_DESCRIPT_ID_CITY,
				'varValue' => '&$arrDataCity[$return_data[\'id_city\']][\'name\']',
				'varChecked' => false
			),
		);

		$smarty->assign('pTitle', $arrTitle + $arrResumeTitle);
	}

	/**
	 * Настройки анкеты - Резюме
	 */
	if ($arrActions['confQuestResume']) {
		// инициируем "Наименование страницы" отображаемое в форме
		$arrNamePage[] = array('name' => MENU_ANNOUNCES_RESUMES, 'link' => false);
		$arrNamePage[] = array('name' => MENU_ANNOUNCES_CONFIG_QUESTIONARY, 'link' => false);

		$arrBindFields = filesys::getSerializedData('core/data/resume.bindfields.mda') or $arrBindFields = array();
		$arrNoBindFields = filesys::getSerializedData('core/data/resume.nobindfields.mda') or $arrNoBindFields = array();
		$arrEducation = filesys::getSerializedData('core/data/resume.education.mda') or $arrEducation = array();
		$arrExpire = filesys::getSerializedData('core/data/resume.expire.mda') or $arrExpire = array();
		$arrLanguage = filesys::getSerializedData('core/data/resume.language.mda') or $arrLanguage = array();

		$arrBasicFields = array(
			'arrBindFields' => & $arrBindFields,
			'arrNoBindFields' => & $arrNoBindFields
		);

		if (isset($_POST['save'])) { // сохраняем данные, переданные из формы
			/**
			 * Определяем массивы, если пришел пустой результат
			 */
			if (empty($_POST['arrBasicFields']['arrBindFields']) || !is_array($_POST['arrBasicFields']['arrBindFields'])) {
				$_POST['arrBasicFields']['arrBindFields'] = array();
			}

			if (empty($_POST['arrEducation']['arrBindFields']) || !is_array($_POST['arrEducation']['arrBindFields'])) {
				$_POST['arrEducation']['arrBindFields'] = array();
			}

			if (empty($_POST['arrExpire']['arrBindFields']) || !is_array($_POST['arrExpire']['arrBindFields'])) {
				$_POST['arrExpire']['arrBindFields'] = array();
			}

			if (empty($_POST['arrLanguage']['arrBindFields']) || !is_array($_POST['arrLanguage']['arrBindFields'])) {
				$_POST['arrLanguage']['arrBindFields'] = array();
			}
			// вычисляем основные поля анкеты
			// необязательные
			$arrNoBindFields = array_merge(
					array_diff_key($arrBindFields, $_POST['arrBasicFields']['arrBindFields']), array_diff_key($arrNoBindFields, $_POST['arrBasicFields']['arrBindFields'])
			);
			// обязательные
			$arrBindFields = & $_POST['arrBasicFields']['arrBindFields'];

			if (isset($arrBindFields['birthday'])) {
				$arrBindFields['birthday'] = '0000-00-00';
			} elseif (isset($arrNoBindFields['birthday'])) {
				$arrNoBindFields['birthday'] = '0000-00-00';
			}

			// вычисляем дополнительные поля анкеты
			// необязательные
			$arrEducation['arrNoBindFields'] = array_merge(
					array_diff_key($arrEducation['arrBindFields'], $_POST['arrEducation']['arrBindFields']), array_diff_key($arrEducation['arrNoBindFields'], $_POST['arrEducation']['arrBindFields'])
			);
			// обязательные
			$arrEducation['arrBindFields'] = & $_POST['arrEducation']['arrBindFields'];

			// вычисляем дополнительные поля анкеты
			// необязательные
			$arrExpire['arrNoBindFields'] = array_merge(
					array_diff_key($arrExpire['arrBindFields'], $_POST['arrExpire']['arrBindFields']), array_diff_key($arrExpire['arrNoBindFields'], $_POST['arrExpire']['arrBindFields'])
			);
			// обязательные
			$arrExpire['arrBindFields'] = & $_POST['arrExpire']['arrBindFields'];

			// вычисляем дополнительные поля анкеты
			// необязательные
			$arrLanguage['arrNoBindFields'] = array_merge(
					array_diff_key($arrLanguage['arrBindFields'], $_POST['arrLanguage']['arrBindFields']), array_diff_key($arrLanguage['arrNoBindFields'], $_POST['arrLanguage']['arrBindFields'])
			);
			// обязательные
			$arrLanguage['arrBindFields'] = & $_POST['arrLanguage']['arrBindFields'];

			/**
			 * Сохраняем результаты
			 */
			if (filesys::putSerializedData('core/data/resume.bindfields.mda', $arrBindFields) &&
					filesys::putSerializedData('core/data/resume.nobindfields.mda', $arrNoBindFields) &&
					filesys::putSerializedData('core/data/resume.education.mda', $arrEducation) &&
					filesys::putSerializedData('core/data/resume.expire.mda', $arrExpire) &&
					filesys::putSerializedData('core/data/resume.language.mda', $arrLanguage)) {
				$resume = new resume();
				$arrSearch = $arrRreplace = array();
				/**
				 * массив поиска/замены для основных полей анкеты
				 */
				// обязательные поля
				$arrBindFields = $resume->arrBindFields;
				foreach (array_keys($arrBindFields) as $alias) {
					array_push(
							$arrSearch, 'arrNoBindFields[' . $alias . ']', '$arrNoBindFields.' . $alias, '$return_data.arrNoBindFields.' . $alias
					);
					array_push(
							$arrRreplace, 'arrBindFields[' . $alias . ']', '$arrBindFields.' . $alias, '$return_data.arrBindFields.' . $alias
					);
				}
				// необязательные поля
				$arrNoBindFields = $resume->arrNoBindFields;
				$resume = new resume();
				$arrSearch = $arrRreplace = array();
				/**
				 * массив поиска/замены для основных полей анкеты
				 */
				// обязательные поля
				$arrBindFields = $resume->arrBindFields;
				foreach (array_keys($arrBindFields) as $alias) {
					array_push(
							$arrSearch, 'arrNoBindFields[' . $alias . ']', '$arrNoBindFields.' . $alias, '$return_data.arrNoBindFields.' . $alias
					);
					array_push(
							$arrRreplace, 'arrBindFields[' . $alias . ']', '$arrBindFields.' . $alias, '$return_data.arrBindFields.' . $alias
					);
				}
				// необязательные поля
				$arrNoBindFields = $resume->arrNoBindFields;
				foreach (array_keys($arrNoBindFields) as $alias) {
					array_push(
							$arrSearch, 'arrBindFields[' . $alias . ']', '$arrBindFields.' . $alias, '$return_data.arrBindFields.' . $alias
					);
					array_push(
							$arrRreplace, 'arrNoBindFields[' . $alias . ']', '$arrNoBindFields.' . $alias, '$return_data.arrNoBindFields.' . $alias
					);
				}

				/**
				 * Массив поиска/замены для дополнительных полей анкеты
				 */
				$resume = new resume();
				$arrSearch = $arrRreplace = array();
				/**
				 * массив поиска/замены для основных полей анкеты
				 */
				// обязательные поля
				$arrBindFields = $resume->arrBindFields;
				foreach (array_keys($arrBindFields) as $alias) {
					array_push(
							$arrSearch, 'arrNoBindFields[' . $alias . ']', '$arrNoBindFields.' . $alias, '$return_data.arrNoBindFields.' . $alias
					);
					array_push(
							$arrRreplace, 'arrBindFields[' . $alias . ']', '$arrBindFields.' . $alias, '$return_data.arrBindFields.' . $alias
					);
				}
				// необязательные поля
				$arrNoBindFields = $resume->arrNoBindFields;
				foreach (array_keys($arrNoBindFields) as $alias) {
					array_push(
							$arrSearch, 'arrBindFields[' . $alias . ']', '$arrBindFields.' . $alias, '$return_data.arrBindFields.' . $alias
					);
					array_push(
							$arrRreplace, 'arrNoBindFields[' . $alias . ']', '$arrNoBindFields.' . $alias, '$return_data.arrNoBindFields.' . $alias
					);
				}

				/**
				 * Массив поиска/замены для дополнительных полей анкеты
				 */
				$resume = new resume();
				$arrSearch = $arrRreplace = array();
				/**
				 * массив поиска/замены для основных полей анкеты
				 */
				// обязательные поля
				$arrBindFields = $resume->arrBindFields;
				foreach (array_keys($arrBindFields) as $alias) {
					array_push(
							$arrSearch, 'arrNoBindFields[' . $alias . ']', '$arrNoBindFields.' . $alias, '$return_data.arrNoBindFields.' . $alias
					);
					array_push(
							$arrRreplace, 'arrBindFields[' . $alias . ']', '$arrBindFields.' . $alias, '$return_data.arrBindFields.' . $alias
					);
				}
				// необязательные поля
				$arrNoBindFields = $resume->arrNoBindFields;
				foreach (array_keys($arrNoBindFields) as $alias) {
					array_push(
							$arrSearch, 'arrBindFields[' . $alias . ']', '$arrBindFields.' . $alias, '$return_data.arrBindFields.' . $alias
					);
					array_push(
							$arrRreplace, 'arrNoBindFields[' . $alias . ']', '$arrNoBindFields.' . $alias, '$return_data.arrNoBindFields.' . $alias
					);
				}

				/**
				 * Массив поиска/замены для дополнительных полей анкеты
				 */
				// Образование - обязательные поля
				$arrEducation['arrBindFields'] = $resume->arrFieldsXmlData['educations'][1]['arrBindFields'];
				foreach (array_keys($arrEducation['arrBindFields']) as $alias) {
					array_push(
							$arrSearch, 'arrFieldsXmlData[educations][{$smarty.foreach.edu_foreach.iteration}][arrNoBindFields][' . $alias . ']', '$education.arrNoBindFields.' . $alias, 'added[educations][][arrNoBindFields][' . $alias . ']'
					);
					array_push(
							$arrRreplace, 'arrFieldsXmlData[educations][{$smarty.foreach.edu_foreach.iteration}][arrBindFields][' . $alias . ']', '$education.arrBindFields.' . $alias, 'added[educations][][arrBindFields][' . $alias . ']'
					);
				}
				// Образование - необязательные поля
				$arrEducation['arrNoBindFields'] = $resume->arrFieldsXmlData['educations'][1]['arrNoBindFields'];
				foreach (array_keys($arrEducation['arrNoBindFields']) as $alias) {
					array_push(
							$arrSearch, 'arrFieldsXmlData[educations][{$smarty.foreach.edu_foreach.iteration}][arrBindFields][' . $alias . ']', '$education.arrBindFields.' . $alias, 'added[educations][][arrBindFields][' . $alias . ']'
					);
					array_push(
							$arrRreplace, 'arrFieldsXmlData[educations][{$smarty.foreach.edu_foreach.iteration}][arrNoBindFields][' . $alias . ']', '$education.arrNoBindFields.' . $alias, 'added[educations][][arrNoBindFields][' . $alias . ']'
					);
				}

				// Опыт работы - обязательные поля
				$arrExpire['arrBindFields'] = $resume->arrFieldsXmlData['expires'][1]['arrBindFields'];
				foreach (array_keys($arrExpire['arrBindFields']) as $alias) {
					array_push(
							$arrSearch, 'arrFieldsXmlData[expires][{$smarty.foreach.exp_foreach.iteration}][arrNoBindFields][' . $alias . ']', '$expire.arrNoBindFields.' . $alias, 'added[expires][][arrNoBindFields][' . $alias . ']'
					);
					array_push(
							$arrRreplace, 'arrFieldsXmlData[expires][{$smarty.foreach.exp_foreach.iteration}][arrBindFields][' . $alias . ']', '$expire.arrBindFields.' . $alias, 'added[expires][][arrBindFields][' . $alias . ']'
					);
				}
				// Опыт работы - необязательные поля
				$arrExpire['arrNoBindFields'] = $resume->arrFieldsXmlData['expires'][1]['arrNoBindFields'];
				foreach (array_keys($arrExpire['arrNoBindFields']) as $alias) {
					array_push(
							$arrSearch, 'arrFieldsXmlData[expires][{$smarty.foreach.exp_foreach.iteration}][arrBindFields][' . $alias . ']', '$expire.arrBindFields.' . $alias, 'added[expires][][arrBindFields][' . $alias . ']'
					);
					array_push(
							$arrRreplace, 'arrFieldsXmlData[expires][{$smarty.foreach.exp_foreach.iteration}][arrNoBindFields][' . $alias . ']', '$expire.arrNoBindFields.' . $alias, 'added[expires][][arrNoBindFields][' . $alias . ']'
					);
				}

				// Владение языками - обязательные поля
				$arrLanguage['arrBindFields'] = $resume->arrFieldsXmlData['languages'][1]['arrBindFields'];
				foreach (array_keys($arrLanguage['arrBindFields']) as $alias) {
					array_push(
							$arrSearch, 'arrFieldsXmlData[languages][{$smarty.foreach.lang_foreach.iteration}][arrNoBindFields][' . $alias . ']', '$language.arrNoBindFields.' . $alias, 'added[languages][][arrNoBindFields][' . $alias . ']'
					);
					array_push(
							$arrRreplace, 'arrFieldsXmlData[languages][{$smarty.foreach.lang_foreach.iteration}][arrBindFields][' . $alias . ']', '$language.arrBindFields.' . $alias, 'added[languages][][arrBindFields][' . $alias . ']'
					);
				}
				// Владение языками - необязательные поля
				$arrLanguage['arrNoBindFields'] = $resume->arrFieldsXmlData['languages'][1]['arrNoBindFields'];
				foreach (array_keys($arrLanguage['arrNoBindFields']) as $alias) {
					array_push(
							$arrSearch, 'arrFieldsXmlData[languages][{$smarty.foreach.lang_foreach.iteration}][arrBindFields][' . $alias . ']', '$language.arrBindFields.' . $alias, 'added[languages][][arrBindFields][' . $alias . ']'
					);
					array_push(
							$arrRreplace, 'arrFieldsXmlData[languages][{$smarty.foreach.lang_foreach.iteration}][arrNoBindFields][' . $alias . ']', '$language.arrNoBindFields.' . $alias, 'added[languages][][arrNoBindFields][' . $alias . ']'
					);
				}
				/**
				 * Производим поиск/замену во всех шаблонах скрипта
				 */
				foreach (filesys::getChildDirs('templates/site/') as $template) {
					$formFileName = 'templates/site/' . $template . '/resume.form.tpl';
					if (is_file($formFileName)) {
						file_put_contents(
								$formFileName, str_replace(
										$arrSearch, $arrRreplace, file_get_contents($formFileName)
								)
						);
					}

					$formFileName = 'templates/site/' . $template . '/resume.preview.tpl';
					if (is_file($formFileName)) {
						file_put_contents(
								$formFileName, str_replace(
										$arrSearch, $arrRreplace, file_get_contents($formFileName)
								)
						);
					}
				}

				file_put_contents(
						'templates/admin/adm.announces.resume.edit.tpl', str_replace(
								$arrSearch, $arrRreplace, file_get_contents('templates/admin/adm.announces.resume.edit.tpl')
						)
				);

				messages::messageChangeSaved(MESSAGE_CHANGE_SAVED, false, CONF_ADMIN_FILE . '?m=announces&s=common&action=confQuestResume');
			} else {
				messages::printDie(ERROR_FILE_NOT_WRITE);
			}
		}

		$arrDescriptFields = array();
		// Описание основных полей анкеты
		foreach (array_keys(array_merge($arrBindFields, $arrNoBindFields)) as $indexField) {
			$arrDescriptFields['basic'][$indexField] = @constant('ANNOUNCE_BASIC_FIELD_DESCRIPT_' . strtoupper($indexField)) or $arrDescriptFields['basic'][$indexField] = @constant('RESUME_BASIC_FIELD_DESCRIPT_' . strtoupper($indexField));
		}
		// Описание дополнительных полей анкеты - Образование
		foreach (array_keys(array_merge($arrEducation['arrBindFields'], $arrEducation['arrNoBindFields'])) as $indexField) {
			$arrDescriptFields['education'][$indexField] = @constant('ANNOUNCE_EXT_EDUCATION_FIELD_DESCRIPT_' . strtoupper($indexField));
		}
		// Описание дополнительных полей анкеты - Опыт работы
		foreach (array_keys(array_merge($arrExpire['arrBindFields'], $arrExpire['arrNoBindFields'])) as $indexField) {
			$arrDescriptFields['expire'][$indexField] = @constant('ANNOUNCE_EXT_EXPIRE_FIELD_DESCRIPT_' . strtoupper($indexField));
		}
		// Описание дополнительных полей анкеты - Владение языками
		foreach (array_keys(array_merge($arrLanguage['arrBindFields'], $arrLanguage['arrNoBindFields'])) as $indexField) {
			$arrDescriptFields['language'][$indexField] = @constant('ANNOUNCE_EXT_LANGUAGE_FIELD_DESCRIPT_' . strtoupper($indexField));
		}

		$smarty->assignByRef('arrDescriptFields', $arrDescriptFields);
		$smarty->assignByRef('arrBasicFields', $arrBasicFields);
		$smarty->assignByRef('arrEducation', $arrEducation);
		$smarty->assignByRef('arrExpire', $arrExpire);
		$smarty->assignByRef('arrLanguage', $arrLanguage);
	}
} else {
	messages::error404();
}

$smarty->assignByRef('errors', $arrErrors);
$smarty->assignByRef('action', $arrActions);
