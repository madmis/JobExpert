<?php

/**
 * JobExpert v1.0
 * Powered by Script Developers Group (SD-Group)
 * Email: info@sd-group.org.ua
 * URL: http://sd-group.org.ua/
 * Copyright 2010-2015 (c) SD-Group
 * All rights reserved
 * ===================================================
 * Работа с объявлением - Резюме
 * ===================================================
 *
 * @package
 *
 * @todo
 *
 */
(!defined('SDG')) ? die('Triple protection!') : null;

/**
 * Иницализация массива подключаемых шаблонов: по умолчанию все значения - false
 * Для подключения шаблона, необходимо установить значение - true
 * Шаблоны подключаются в порядке установленном в файле головного шаблона resume.tpl
 */
$arrActPage = array(
	'view' => false,
	'print' => false,
	'add' => false,
	'edit' => false,
	'preview' => false,
	'activate' => false,
	'payment' => false,
	'extend' => false,
	'setVIP' => false,
	'setHOT' => false,
	'setRate' => false,
	'description' => false,
	'sections' => false,
	'professions' => false,
	'regions' => false,
	'citys' => false,
	'vip' => false,
	'hot' => false
);


// определяем шаблон для отображения
if (isset($_GET['action']) && 'offset' != $_GET['action']) {
	if (isset($arrActPage[$_GET['action']])) {
		$arrActPage[$_GET['action']] = true;
	} else {
		messages::error404();
	}
}
/**
 * отображение шаблона по умолчанию
 */
elseif (isset($_GET['do']) && 'resume' == $_GET['do']) {
	// инициируем "Наименование страницы" отображаемое в заголовке формы
	$arrNamePage = array(
		array('name' => FORM_VIEW_ANNOUNCE_HEAD, 'link' => false),
		array('name' => FORM_RESUMES_HEAD, 'link' => false),
		array('name' => FORM_ALL, 'link' => false)
	);

	$offset = isset($_GET['offset']) ? (int) abs($_GET['offset']) : 0; //смещение, всегда 0 (затем берется из $_GET)

	$arrLimit = array('strLimit' => $offset . ', ' . CONF_ANNOUNCE_PERPAGE_SITE, 'calcRows' => true);

	$smarty->assign('return_data', $resume->getActiveAnnounces($arrLimit));

	$allRecords = $resume->cntAnnounces(); // получаем общее количество объявлений
	$path = CONF_SCRIPT_URL . 'index.php?ut=' . $_SESSION['sd_user'][DB_PREFIX . 'conf']['user_type'] . '&amp;do=resume';

	$strPages = strings::generatePage($allRecords, $offset, CONF_ANNOUNCE_PERPAGE_SITE, $path . '&amp;action=offset&amp;'); // формируем страницы

	$smarty->assign('link', $path . '&amp;action=view&amp;id=');
	$smarty->assignByRef('string_page', $strPages); //передаем в шаблон строку сформированных страниц
} else {
	messages::error404();
}
// END отображение шаблона по умолчанию
// определяем шаблон для отображения
(isset($_GET['action']) && isset($arrActPage[$_GET['action']])) ? $arrActPage[$_GET['action']] = true : null;

/**
 * инициализация пути подключаемых языковых файлов
 */
$smarty->assign('path', filesys::setPath(CONF_ROOT_DIR) . 'lang/' . CONF_LANGUAGE . '/texts');

/**
 * инициализация списка "Пол"
 */
//$smarty->assignByRef('gender', $arrSysDict['Gender']['values']);

/**
 * просмотр объявлений - Резюме
 */
if (!empty($arrActPage['view']) || !empty($arrActPage['print'])) {
	// инициируем "Наименование страницы" отображаемое в заголовке формы
	$arrNamePage[] = array('name' => FORM_VIEW_ANNOUNCE_HEAD, 'link' => false);

	// если передан id резюме
	if (isset($_GET['id']) && ($id = validate::checkNaturalNumber($_GET['id']))) {
		// пытаемся получить данные из таблицы БД
		if (!$resume->viewAnnounce($id)) {
			$arrErrors[] = ERROR_ANNOUNCE_NOT_EXISTS; // ошибка: объявление не существует
		} else {
			$return_data = $resume->retAnnSubj();
			$return_data['sendto'] = secure::strSecureEncode($return_data['email']);

			//$smarty->assignByRef('gender', $arrSysDict['Gender']['values']);

			$smarty->assignByRef('return_data', $return_data);

			// формируем титл страницы
			(file_exists('core/data/resume.pagetitle.pda')) ? include_once 'core/data/resume.pagetitle.pda' : null;

			// формируем META-данные страницы
			(!empty($return_data['meta_keywords'])) ? $smarty->assignByRef('meta_keywords', $return_data['meta_keywords']) : null;
			(!empty($return_data['meta_description'])) ? $smarty->assignByRef('meta_description', $return_data['meta_description']) : null;

			// инициируем "Наименование страницы" отображаемое в заголовке формы
			$arrNamePage[] = array('name' => FORM_RESUMES_HEAD, 'link' => chpu::createChpuUrl(CONF_SCRIPT_URL . 'index.php?ut=' . $_SESSION['sd_user'][DB_PREFIX . 'conf']['user_type'] . '&amp;do=resume'));
			$arrNamePage[] = array('name' => $return_data['title'], 'link' => false);

			if ($arrActPage['print']) {
				// передаем TITLE страницы в Smarty
				$smarty->assign('page_title', (!empty($arrTitle)) ? strings::formTitle($arrTitle) : strings::formTitle($arrNamePage));
				$smarty->assign('printTemplate', 'resume.print.tpl');
				$smarty->display('announce.print.tpl');
				exit;
			} elseif (!empty($_SESSION['sd_user']['data']['id']) && $return_data['id_user'] != $_SESSION['sd_user']['data']['id']) {
				$smarty->assign('myAnnounces', $vacancy->getAnnDataByCurrUser());
			}
		}
	}
	// иначе, ошибка: невыбранно объявление для просмотра
	else {
		// инициируем "Наименование страницы" отображаемое в заголовке формы
		$arrNamePage[] = array('name' => FORM_RESUMES_HEAD, 'link' => chpu::createChpuUrl(CONF_SCRIPT_URL . 'index.php?ut=' . $_SESSION['sd_user'][DB_PREFIX . 'conf']['user_type'] . '&amp;do=resume'));

		$arrErrors[] = ERROR_ANNOUNCE_NOT_SELECT;
	}
}
// END просмотр объявления - Резюме

/**
 * добавление нового объявления, редактирование объявления - Резюме
 */
elseif (!empty($arrActPage['add']) || !empty($arrActPage['edit'])) {
	// определяем текущее действие
	$currAction = (!empty($arrActPage['add'])) ? 'add' : 'edit';

	// инициируем "Наименование страницы" отображаемое в заголовке формы
	$arrNamePage = array(
		array('name' => @constant('FORM_' . strtoupper($currAction) . '_ANNOUNCE_HEAD'), 'link' => false),
		array('name' => FORM_RESUMES_HEAD, 'link' => false)
	);

	// проверяем настройки прав доступа, если есть права открываем форму анкеты
	if ((!empty($arrActPage['add']) && !empty($_SESSION['sd_' . DB_PREFIX . 'codex']['rights']['add_resume'])) || (!empty($arrActPage['edit']) && ((!empty($_GET['unikey']) && ($unikey = (string) $_GET['unikey']) && $resume->getAnnounceByUnikey($unikey, "token IN ('correction')") && $resume->setEditData($_POST)) || (!empty($_POST['unikey']) && ($unikey = (string) $_POST['unikey']) && $resume->issetAnnounce($unikey, "token IN ('correction')")) || (!empty($_SESSION['sd_' . DB_PREFIX . 'codex']['rights']['edit_resume']) && ((!empty($_GET['unikey']) && ($unikey = (string) $_GET['unikey']) && $resume->getAnnounceByUnikey($unikey, "token IN ('active','payment','archived')") && $resume->setEditData($_POST)) || (!empty($_POST['unikey']) && ($unikey = (string) $_POST['unikey']) && $resume->issetAnnounce($unikey, "token IN ('active','payment','archived')"))))))) {
		// передаем текущее действие в шаблон
		$smarty->assignByRef('currAction', $currAction);

		// передаем в шаблон уникальный ключ объявления
		(!empty($arrActPage['edit']) && isset($unikey)) ? $smarty->assignByRef('unikey', $unikey) : null;

		// инициируем массив ошибочных данных в полях формы
		$errFields = $resume->getBindFields() + array('captcha' => '', 'agreement' => '');

		// если форма отправлена, обрабатываем переданные данные
		if (isset($_POST['add']) || isset($_POST['edit']) || isset($_POST['save'])) {
			// вылавливаем поля не переданные из формы - обязательные для заполнения
			$_POST['arrBindFields'] += array_diff_key($resume->getBindFields(), $_POST['arrBindFields']);
			// вылавливаем поля не переданные из формы - не обязательные для заполнения
			$_POST['arrNoBindFields'] += array_diff_key($resume->getNoBindFields(), $_POST['arrNoBindFields']);
			// вылавливаем поля не переданные из формы - поля для хранения данных в XML-формате
			(!isset($_POST['arrFieldsXmlData'])) ? $_POST['arrFieldsXmlData'] = $resume->getFieldsXmlData() : null;

			// парсим добавленные поля - Образования, Опыт работы, Владение языками
			if (isset($_POST['added'])) {
				tools::annDataParser($_POST['added'], $_POST['arrFieldsXmlData'], $resume->getFieldsXmlData());
				unset($_POST['added']);
			}

			// Блок обработки поля "Дата рождения"
			if (!isset($_POST['save'])) {
				// проверка данных переданных из формы
				if (isset($_POST['birthday']['Date_Day']) && ($day = (int) $_POST['birthday']['Date_Day']) && isset($_POST['birthday']['Date_Month']) && ($month = (int) $_POST['birthday']['Date_Month']) && isset($_POST['birthday']['Date_Year']) && ($year = (int) $_POST['birthday']['Date_Year']) && checkdate($month, $day, $year)) {
					$birthday = $year . '-' . $month . '-' . $day;
					$age = (string) ((int) ((time() - mktime(0, 0, 0, $month, $day, $year)) / 31556926));
				} else {
					$birthday = '0000-00-00';
					$age = '';
				}
				// инициализация даты рождения
				if (isset($_POST['arrBindFields']['birthday'])) {
					$_POST['arrBindFields']['birthday'] = $birthday;
				} elseif (isset($_POST['arrNoBindFields']['birthday'])) {
					$_POST['arrNoBindFields']['birthday'] = $birthday;
				}
				// инициализация возраста
				if (isset($_POST['arrBindFields']['age'])) {
					$_POST['arrBindFields']['age'] = $age;
				} elseif (isset($_POST['arrNoBindFields']['age'])) {
					$_POST['arrNoBindFields']['age'] = $age;
				}
			}
			// END Блок обработки поля "Дата рождения"

			// Блок обработки поля "Регион"
			if (!empty($_POST['arrBindFields']['id_region']) && !empty($arrDataRegions[$_POST['arrBindFields']['id_region']])) {
				$currRegion = &$arrDataRegions[$_POST['arrBindFields']['id_region']];
			} else {
				$currRegion = false;
			}
			// Обработка Региона со статусом "Регион-Город"
			if (!empty($currRegion) && 'on' === $currRegion['major']) {
				unset($_POST['arrBindFields']['id_city']);
			}
			// Блок обработки поля "Другой город"
			// если выбран другой город
			else if (
				!empty($currRegion) &&
				'on' === $currRegion['add_city_allowed'] &&
				empty($_POST['arrBindFields']['id_city']) &&
				isset($_POST['other_city']) &&
				!empty($_POST['other_city'])
			) {
				// передаем данные для записи в таблицу городов
				$citys->arrBindFields = array('parent_id' => &$_POST['arrBindFields']['id_region'], 'name' => &$_POST['other_city']);
				// производим запись, получаем id вновь добавленного города
				if (!$citys->issetCityByName($_POST['other_city'], $_POST['arrBindFields']['id_region'])) {
					$_POST['arrBindFields']['id_city'] = $citys->recCategory();
				}
			}
			// END Блок обработки полей "Регион" и "Другой город"

			// заполняем поля профессий выбранных на форме
			if (!isset($_POST['save']) && isset($_POST['professions']) && is_array($_POST['professions'])) {
				// обрабатываем полученный массив
				$hprofessions = '[' . implode(',', $_POST['professions']) . ']';
				for ($i = 0; $i < 3; $i++) {
					if (0 === $i) {
						$_POST['arrBindFields']['id_profession'] = $_POST['professions'][$i];
					} else {
						if (isset($_POST['arrBindFields']['id_profession_' . $i])) {
							$ownIdProffession = 'arrBindFields';
						} else {
							$ownIdProffession = 'arrNoBindFields';
						}
						($_POST[$ownIdProffession]['id_profession_' . $i] = (!isset($_POST['professions'][$i])) ? '' : $_POST['professions'][$i]);
					}
				}
				// передаем значение в шаблон смарти
				$smarty->assignByRef('hprofessions', $hprofessions);
			}

			/**
			 * Блок валидации данных переданных из формы
			 */
			// проверяем на пустоту, поля обязательные для заполнения
			if (!validate::arrDataNotEmpty($_POST['arrBindFields'])) {
				// ошибка выводимая в заголовке формы анкеты
				$arrWarnings[] = ERROR_EMPTY_BIND_FIELDS;

				// ошибки выводимые для каждого незаполненного поля
				foreach ($_POST['arrBindFields'] as $key => &$value) {
					(empty($value)) ? $errFields[$key] = ERROR_BIND_FIELD : null;
				}
			} else {
				// проверка формата телефонного номера
				if (isset($_POST['arrBindFields']['phone'])) {
					$validatePhone = true;
					$phone = & $_POST['arrBindFields']['phone'];
				} elseif (!empty($_POST['arrNoBindFields']['phone'])) {
					$validatePhone = true;
					$phone = & $_POST['arrNoBindFields']['phone'];
				} else {
					$validatePhone = false;
					$_POST['arrNoBindFields']['phone'] = '';
				}
				// валидация телефонного номера
				if (!empty($validatePhone) && !validate::validatePhone($phone)) {
					$arrWarnings[] = $errFields['phone'] = ERROR_PHONE_FORMAT;
				}

				// проверка формата e-mail адреса
				if (!validate::validateEmail($_POST['arrBindFields']['email'])) {
					$arrWarnings[] = $errFields['email'] = ERROR_EMAIL;
				}
			}

			// проверка данных хранимых в XML-формате
			if (is_array($_POST['arrFieldsXmlData'])) {
				foreach ($_POST['arrFieldsXmlData'] as $nameField => &$contentField) { // перебор массива
					if (is_array($contentField)) {
						foreach ($contentField as $index => &$arrContent) { // перебор массива
							// проверка на пустоту, полей обязательных для заполнения хранимых в XML-формате
							if (array_key_exists('arrBindFields', $arrContent) && is_array($arrContent['arrBindFields'])) {
								foreach ($arrContent['arrBindFields'] as $key => &$value) { // перебор массива
									$errFields[$nameField][$index]['arrBindFields'][$key] = '';
								}

								if (!validate::arrDataNotEmpty($arrContent['arrBindFields'])) {
									// ошибка выводимая в заголовке формы анкеты
									(!in_array(ERROR_EMPTY_BIND_FIELDS, $arrWarnings)) ? $arrWarnings[] = ERROR_EMPTY_BIND_FIELDS : null;

									// ошибки выводимые для каждого незаполненного поля
									foreach ($arrContent['arrBindFields'] as $key => &$value) {
										(!$value) ? $errFields[$nameField][$index]['arrBindFields'][$key] = ERROR_BIND_FIELD : null;
									}
								}
							}
						}
					}
				}

				// обработка чеккера "Старт карьеры"
				if (!empty($_POST['career_launch'])) {
					$_POST['arrFieldsXmlData']['expires'] = false;
					$smarty->assignByRef('career_launch', $_POST['career_launch']);
				}

				// обработка чеккера "Не владею иностранными языками"
				(isset($_POST['noforeign_lang'])) ? $noforeign_lang = & $_POST['noforeign_lang'] : $noforeign_lang = '';
				$smarty->assignByRef('noforeign_lang', $noforeign_lang);
			}

			// проверка капчи
			if (!isset($_POST['save']) && SECURE_CAPTCHA) {
				$securimage = new securimage();

				(!$securimage->check($_POST['keystring'])) ? $arrWarnings[] = $errFields['captcha'] = ERROR_CAPTCHA : null;
			}

			// обработка и проверка чеккера пользовательского соглашения
			(!isset($_POST['agreement'])) ? $_POST['agreement'] = false : null;
			$smarty->assignByRef('agreement', $_POST['agreement']);

			if (CONF_ANNOUNCE_USER_AGREEMENT_NOMEMBERS_REQUIRED && empty($_POST['agreement']) && !$user->getAuthorized()) {
				$arrWarnings[] = $errFields['agreement'] = ERROR_AGREEMENT;
			}
			// END Блок валидации данных переданных из формы
			// очищаем предупреждение о платности услуги
			if (isset($arrWarnings['payment'])) {
				unset($arrWarnings['payment']);
			}

			// проверяем есть ли ошибки
			if (!empty($arrWarnings)) {
				// инициируем необходимые данные для отображения формы анкеты (исправление ошибок)
				$smarty->assignByRef('arrBindFields', $_POST['arrBindFields']);
				$smarty->assignByRef('arrNoBindFields', $_POST['arrNoBindFields']);
				$smarty->assignByRef('arrFieldsXmlData', $_POST['arrFieldsXmlData']);
			} else { // иначе, ошибок нет, обрабатываем полученные данные
				// проверяем, существует ли объявление с таким же уникальным ключом (дубль)
				if (!empty($arrActPage['add']) && $resume->issetAnnounce(strings::getUnikey($_POST['arrBindFields']))) {
					// отключаем отображение формы анкеты
					$arrActPage['add'] = false;

					// сообщаем пользователю об ошибке (дублирующее объявление)
					$arrErrors[] = ERROR_ANNOUNCE_ISSET;
				}
				// иначе, если включен предпросмотр
				elseif (CONF_ANNOUNCE_PREVIEW && !isset($_POST['save'])) {
					// отключаем отображение формы анкеты
					$arrActPage[$currAction] = false;

					// инициируем необходимые данные для отображения формы предпросмотра
					$arrActPage['preview'] = true;

					// инициируем "Наименование страницы" отображаемое в заголовке формы
					$arrNamePage[] = array('name' => FORM_PREVIEW_ANNOUNCE_HEAD, 'link' => false);

					$return_data = array('arrBindFields' => &$_POST['arrBindFields'], 'arrNoBindFields' => &$_POST['arrNoBindFields'], 'arrFieldsXmlData' => &$_POST['arrFieldsXmlData']);

					// парсим возвращаемые данные - формирование массива для заполнения скрытых полей формы предпросмотра
					tools::arrayMultyParser($return_data, $hidden_fields);
					// обрабатываем html-код полученный из формы
					strings::htmlEncode($hidden_fields);

					// передаем данные в смарти
					$return_data['hidden_fields'] = & $hidden_fields;
					$smarty->assignByRef('return_data', $return_data);

					$strings = new strings();
					$smarty->assignByRef('strings', $strings);
				}
				// иначе, если пользователь не хочет отредактировать объявление
				else {
					// присваеваем полученные данные объекту
					$resume->arrBindFields = & $_POST['arrBindFields'];
					$resume->arrNoBindFields = & $_POST['arrNoBindFields'];
					$resume->arrFieldsXmlData = & $_POST['arrFieldsXmlData'];

					// производим запись в таблицу БД
					(!empty($arrActPage['add'])) ? ((!$resume->recAnnounce()) ? $arrErrors[] = db::$message_error : null) : ((!$resume->editAnnounce($_POST['unikey'])) ? $arrErrors[] = db::$message_error : null);
				}
			}
		} elseif (isset($_POST['correction']) || !empty($arrActPage['edit'])) {
			if (isset($_POST['correction'])) {
				$_POST['arrBindFields'] += array_diff_key($resume->getBindFields(), $_POST['arrBindFields']);
				$_POST['arrNoBindFields'] += array_diff_key($resume->getNoBindFields(), $_POST['arrNoBindFields']);

				// массив полей формы анкеты - профессии
				$smarty->assignByRef('hprofessions', $_POST['hprofessions']);

				// обработка чеккера "Старт карьеры"
				if (!empty($_POST['career_launch'])) {
					$_POST['arrFieldsXmlData']['expires'] = false;
					$smarty->assignByRef('career_launch', $_POST['career_launch']);
				}

				// обработка чеккера "Не владею иностранными языками"
				(!isset($_POST['noforeign_lang'])) ? $_POST['noforeign_lang'] = '' : null;
				$smarty->assignByRef('noforeign_lang', $_POST['noforeign_lang']);
			} else {
				$hprofessions[] = $_POST['arrBindFields']['id_profession'];
				if (!empty($_POST['arrBindFields']['id_profession_1'])) {
					$hprofessions[] = $_POST['arrBindFields']['id_profession_1'];
				} elseif (!empty($_POST['arrNoBindFields']['id_profession_1'])) {
					$hprofessions[] = $_POST['arrNoBindFields']['id_profession_1'];
				}
				if (!empty($_POST['arrBindFields']['id_profession_2'])) {
					$hprofessions[] = $_POST['arrBindFields']['id_profession_2'];
				} elseif (!empty($_POST['arrNoBindFields']['id_profession_2'])) {
					$hprofessions[] = $_POST['arrNoBindFields']['id_profession_2'];
				}
				$hprofessions = '[' . implode(',', $hprofessions) . ']';
				$smarty->assignByRef('hprofessions', $hprofessions);

				// обработка чеккера "Старт карьеры"
				$smarty->assign('career_launch', (!empty($_POST['arrFieldsXmlData']['expires'])) ? false : true);
				// обработка чеккера "Не владею иностранными языками"
				$smarty->assign('noforeign_lang', (1 < count($_POST['arrFieldsXmlData']['languages'])) ? false : true);
			}

			// массив полей формы анкеты, обязательных для заполнения
			$smarty->assignByRef('arrBindFields', $_POST['arrBindFields']);

			// массив полей формы анкеты, необязательных для заполнения
			$smarty->assignByRef('arrNoBindFields', $_POST['arrNoBindFields']);

			// массив полей формы анкеты, хранимых в XML-формате
			$smarty->assignByRef('arrFieldsXmlData', $_POST['arrFieldsXmlData']);

			// перебор массива полей данные которых храняться в XML-формате
			foreach ($_POST['arrFieldsXmlData'] as $nameField => &$contentField) {
				if (is_array($contentField)) {
					foreach ($contentField as $index => &$arrContent) {
						if (array_key_exists('arrBindFields', $arrContent)) {
							foreach ($arrContent['arrBindFields'] as $key => &$value) {
								$errFields[$nameField][$index]['arrBindFields'][$key] = '';
							}
						}
					}
				}
			}
		} else { // инициируем новую форму
			(isset($_SESSION['sd_user']['data'])) ? $resume->setResumeData($_SESSION['sd_user']) : null;

			// массив полей формы анкеты, обязательных для заполнения
			$smarty->assign('arrBindFields', $resume->getBindFields());
			// массив полей формы анкеты, необязательных для заполнения
			$smarty->assign('arrNoBindFields', $resume->getNoBindFields());

			// массив полей формы анкеты, хранимых в XML-формате
			$_POST['arrFieldsXmlData'] = $resume->getFieldsXmlData();
			// добавляем поля в массив ошибок
			$errFields += $_POST['arrFieldsXmlData'];
			// передаем данные в смарти
			$smarty->assignByRef('arrFieldsXmlData', $_POST['arrFieldsXmlData']);
		}

		// проверяем платность услуги
		(!empty($arrPayments[$currAction . '_resume'])) ? $arrWarnings['payment'] = ANNOUNCE_ADD_PAYMENT_TITLE : null;

		// передаем массив ошибочных данных в полях формы
		$smarty->assignByRef('errFields', $errFields);

		// формируем массив "Годы" для анкеты: текущий год минус 50 лет
		for ($year = date('Y'); $year >= date('Y') - 50; $year--) {
			$arrYears[$year] = (int) $year;
		}

		// передаем массив "Годы"
		$smarty->assignByRef('years', $arrYears);

		// определяем массив селекта "Валюты"
		unset($arrSysDict['Currency']['values'][0]); // вырезаем ненужное значение
		// определяем массив селекта "Образование"
		unset($arrAddDict['Education']['values'][0]); // вырезаем ненужное значение
		// определяем массив селекта "Пол"
		unset($arrSysDict['Gender']['values']['none']); // вырезаем ненужное значение
	} else { // иначе, выводим сообщение: нет прав...
		// отключаем отображение формы анкеты
		$arrActPage[$currAction] = false;

		// ошибка: "Недостаточно прав..."
		$arrWarnings[] = ERROR_NOT_ENOUGH_RIGHTS;

		// подключаем текст описания
		$arrActPage['description'] = true;
	}

	$smarty->assign('menu', $currAction . '_resume');
}
// END добавление нового объявления - Резюме

/**
 * активация объявления - Резюме
 */
elseif (!empty($arrActPage['activate'])) {
	if (isset($_GET['code']) && $_GET['code']) {
		print '<html><body><form action="' . CONF_SCRIPT_URL . 'index.php?ut=' . $_SESSION['sd_user'][DB_PREFIX . 'conf']['user_type'] . '&amp;do=resume&action=activate" method="post">'
				. '<input type="hidden" name="code" value="' . $_GET['code'] . '"></form>'
				. '<script type="text/javascript">document.forms[0].submit();</script>'
				. '</body></html>';
	} elseif (isset($_POST['code'])) {
		if (!$unikey = (string) substr(trim($_POST['code']), 0, 32)) {
			$arrWarnings[] = WARNING_NOTHING_ENTERED;
		} elseif ((32 !== strlen($unikey)) || !ctype_alnum($unikey)) {
			$arrWarnings[] = WARNING_INCORRECT_CODE_FORMAT;
		} else {
			$_SESSION['referer'] = CONF_SCRIPT_URL . 'index.php?do=resume&action=activate&code=' . $unikey;

			(!$resume->actAnnounce($unikey)) ? $arrErrors[] = ERROR_ACTIVATE_ANNOUNCE : null;
		}
	}

	// инициируем "Наименование страницы" отображаемое в заголовке формы
	$arrNamePage = array(
		array('name' => FORM_ACTIVATE_ANNOUNCE_HEAD, 'link' => false),
		array('name' => FORM_RESUMES_HEAD, 'link' => false)
	);

	$smarty->assign('typeAnnounce', 'resume');
}
// END активация объявления - Резюме

/**
 * оплата объявления - Резюме
 */
elseif (!empty($arrActPage['payment'])) {
	if (isset($_GET['id']) && ($id = validate::checkNaturalNumber($_GET['id']))) {
		$_SESSION['payment'] = array('service' => 'add_resume', 'id' => $id, 'announce_type' => 'resume');

		die('<script type="text/javascript">window.location = "' . chpu::createChpuUrl(CONF_SCRIPT_URL . 'index.php?ut=' . $_SESSION['sd_user'][DB_PREFIX . 'conf']['user_type'] . '&do=payments') . '"</script>');
	} else {
		messages::error404();
	}
}
// END оплата объявления - Резюме

/**
 * установка статуса VIP объявлению - Резюме
 */
elseif (!empty($arrActPage['setVIP'])) {
	// если передан id резюме
	if (isset($_GET['id']) && ($id = validate::checkNaturalNumber($_GET['id']))) {
		$_SESSION['payment'] = array('service' => 'vip_resume', 'id' => $id);

		die('<script type="text/javascript">window.location = "' . chpu::createChpuUrl(CONF_SCRIPT_URL . 'index.php?ut=' . $_SESSION['sd_user'][DB_PREFIX . 'conf']['user_type'] . '&do=payments') . '"</script>');
	}
}
// END установка статуса VIP объявлению - Резюме

/**
 * установка статуса HOT объявлению - Резюме
 */
elseif (!empty($arrActPage['setHOT'])) {
	// если передан id резюме
	if (isset($_GET['id']) && ($id = validate::checkNaturalNumber($_GET['id']))) {
		$_SESSION['payment'] = array('service' => 'hot_resume', 'id' => $id);

		die('<script type="text/javascript">window.location = "' . chpu::createChpuUrl(CONF_SCRIPT_URL . 'index.php?ut=' . $_SESSION['sd_user'][DB_PREFIX . 'conf']['user_type'] . '&do=payments') . '"</script>');
	}
}
// END установка статуса HOT объявлению - Резюме

/**
 * установка Рейтинга объявлению - Резюме
 */
elseif (!empty($arrActPage['setRate'])) {
	// если передан id резюме
	if (isset($_GET['id']) && ($id = validate::checkNaturalNumber($_GET['id']))) {
		$_SESSION['payment'] = array('service' => 'rate_resume', 'id' => $id);

		die('<script type="text/javascript">window.location = "' . chpu::createChpuUrl(CONF_SCRIPT_URL . 'index.php?ut=' . $_SESSION['sd_user'][DB_PREFIX . 'conf']['user_type'] . '&do=payments') . '"</script>');
	}
}
// END установка Рейтинга объявлению - Резюме

/**
 * описание к объявлению - Резюме
 */
elseif (!empty($arrActPage['description'])) {
	// инициируем "Наименование страницы" отображаемое в заголовке формы
	$arrNamePage[] = array('name' => FORM_DESCRIPTION_RESUME_HEAD, 'link' => false);
}
// END описание к объявлению - Резюме

/**
 * отображение шаблона навигатора по разделам
 */
elseif (!empty($arrActPage['sections'])) {
	if (!empty($_GET['id']) && validate::checkNaturalNumber($_GET['id']) && !empty($arrDataSections[$_GET['id']]) && is_array($arrDataSections)) {
		if (!empty($_GET['tId']) && !in_array($_GET['tId'], $arrDataSections[$_GET['id']])) {
			messages::error404();
		} else {
			$id = $_GET['id'];
		}
	} elseif (isset($_GET['id'])) {
		messages::error404();
	} else {
		$id = false;
	}

	$offset = isset($_GET['offset']) ? (int) abs($_GET['offset']) : 0; //смещение, всегда 0 (затем берется из $_GET)

	$strWhere = (!empty($id)) ? "id_section IN ('$id')" : false;
	$arrLimit = array('strLimit' => $offset . ', ' . CONF_ANNOUNCE_PERPAGE_SITE, 'calcRows' => true);

	$smarty->assign('return_data', $resume->getActiveAnnounces($arrLimit, $strWhere));

	$allRecords = $resume->cntAnnounces(); // получаем общее количество объявлений
	$path = CONF_SCRIPT_URL . 'index.php?ut=' . $_SESSION['sd_user'][DB_PREFIX . 'conf']['user_type'] . '&amp;do=resume';
	$strId = (!$id) ? 'page=offset&amp;' : "id=$id&amp;page=offset&amp;";

	$strPages = strings::generatePage($allRecords, $offset, CONF_ANNOUNCE_PERPAGE_SITE, $path . '&amp;action=sections&amp;' . $strId); // формируем страницы

	$smarty->assign('link', $path . '&amp;action=view&amp;id=');
	$smarty->assignByRef('string_page', $strPages); //передаем в шаблон строку сформированных страниц

	if (!$id) {
		$smarty->assign('return_subcategory_data', false);
		// инициируем "Наименование страницы" отображаемое в заголовке формы
		$arrNamePage = array(
			array('name' => MENU_ANNOUNCES_NAVIGATOR, 'link' => false),
			array('name' => FORM_RESUMES_HEAD, 'link' => false),
			array('name' => FORM_ALL, 'link' => false)
		);
	} else {
		$smarty->assign('return_subcategory_data', $professions->retCategorysByParentIds($id));
		// инициируем "Наименование страницы" отображаемое в заголовке формы
		$arrNamePage = array(
			array('name' => MENU_ANNOUNCES_NAVIGATOR, 'link' => false),
			array('name' => FORM_RESUMES_HEAD, 'link' => chpu::createChpuUrl($path . '&amp;action=sections')),
			array('name' => $arrDataSections[$id]['name'], 'link' => false)
		);

		if (!empty($arrDataSections[$id]['title'])) {
			$smarty->assignByRef('page_title', $arrDataSections[$id]['title']);
		}

		if (!empty($arrDataSections[$id]['meta_keywords'])) {
			$smarty->assignByRef('meta_keywords', $arrDataSections[$id]['meta_keywords']);
		}

		if (!empty($arrDataSections[$id]['meta_description'])) {
			$smarty->assignByRef('meta_description', $arrDataSections[$id]['meta_description']);
		}
	}
}
// END отображение шаблона навигатора по разделам

/**
 * отображение шаблона навигатора по профессиям
 */
elseif (!empty($arrActPage['professions'])) {
	// если передан id
	if (!empty($_GET['id']) && validate::checkNaturalNumber($_GET['id']) && !empty($arrDataProfessions[$_GET['id']]) && is_array($arrDataProfessions[$_GET['id']])) {
		if (!empty($_GET['tId']) && !in_array($_GET['tId'], $arrDataProfessions[$_GET['id']])) {
			messages::error404();
		} else {
			$id = $_GET['id'];
		}

		$offset = isset($_GET['offset']) ? (int) abs($_GET['offset']) : 0; //смещение, всегда 0 (затем берется из $_GET)

		$strWhere = "(id_profession IN (" . secure::escQuoteData($id) . ") OR id_profession_1 IN (" . secure::escQuoteData($id) . ") OR id_profession_2 IN (" . secure::escQuoteData($id) . "))";
		$arrLimit = array('strLimit' => $offset . ', ' . CONF_ANNOUNCE_PERPAGE_SITE, 'calcRows' => true);

		$smarty->assign('return_data', $resume->getActiveAnnounces($arrLimit, $strWhere));

		$allRecords = $resume->cntAnnounces(); // получаем общее количество объявлений
		$path = CONF_SCRIPT_URL . 'index.php?ut=' . $_SESSION['sd_user'][DB_PREFIX . 'conf']['user_type'] . '&amp;do=resume';
		$strId = (!$id) ? 'page=offset&amp;' : "id=$id&amp;page=offset&amp;";

		$strPages = strings::generatePage($allRecords, $offset, CONF_ANNOUNCE_PERPAGE_SITE, $path . '&amp;action=professions&amp;' . $strId); // формируем страницы

		$smarty->assign('link', $path . '&amp;action=view&amp;id=');
		$smarty->assignByRef('string_page', $strPages); //передаем в шаблон строку сформированных страниц
		// инициируем "Наименование страницы" отображаемое в заголовке формы
		$arrNamePage = array(
			array('name' => MENU_ANNOUNCES_NAVIGATOR, 'link' => false),
			array('name' => FORM_RESUMES_HEAD, 'link' => chpu::createChpuUrl($path . '&amp;action=sections')),
			array('name' => $arrDataSections[$arrDataProfessions[$id]['parent_id']]['name'], 'link' => chpu::createChpuUrl($path . '&amp;action=sections&amp;id=' . $arrDataSections[$arrDataProfessions[$id]['parent_id']]['tId'])),
			array('name' => $arrDataProfessions[$id]['name'], 'link' => false)
		);

		if (!empty($arrDataProfessions[$id]['title'])) {
			$smarty->assignByRef('page_title', $arrDataProfessions[$id]['title']);
		}

		if (!empty($arrDataProfessions[$id]['meta_keywords'])) {
			$smarty->assignByRef('meta_keywords', $arrDataProfessions[$id]['meta_keywords']);
		}

		if (!empty($arrDataProfessions[$id]['meta_description'])) {
			$smarty->assignByRef('meta_description', $arrDataProfessions[$id]['meta_description']);
		}
	} elseif (isset($_GET['id'])) {
		messages::error404();
	} else {
		$smarty->assign('return_data', false);
		// инициируем "Наименование страницы" отображаемое в заголовке формы
		$arrNamePage = array(
			array('name' => MENU_ANNOUNCES_NAVIGATOR, 'link' => false),
			array('name' => FORM_RESUMES_HEAD, 'link' => chpu::createChpuUrl(CONF_SCRIPT_URL . 'index.php?ut=' . $_SESSION['sd_user'][DB_PREFIX . 'conf']['user_type'] . '&amp;do=resume&amp;action=sections'))
		);
	}
}
// END отображение шаблона навигатора по разделам

/**
 * отображение шаблона навигатора по регионам
 */
elseif (!empty($arrActPage['regions'])) {
	if (!empty($_GET['id']) && validate::checkNaturalNumber($_GET['id']) && !empty($arrDataRegions[$_GET['id']]) && is_array($arrDataRegions[$_GET['id']])) {
		if (!empty($_GET['tId']) && !in_array($_GET['tId'], $arrDataRegions[$_GET['id']])) {
			messages::error404();
		} else {
			$id = $_GET['id'];
		}
	} elseif (isset($_GET['id'])) {
		messages::error404();
	} else {
		$id = false;
	}

	$offset = isset($_GET['offset']) ? (int) abs($_GET['offset']) : 0; //смещение, всегда 0 (затем берется из $_GET)

	$strWhere = (!empty($id)) ? "id_region IN ('$id')" : false;
	$arrLimit = array('strLimit' => $offset . ', ' . CONF_ANNOUNCE_PERPAGE_SITE, 'calcRows' => true);

	$smarty->assign('return_data', $resume->getActiveAnnounces($arrLimit, $strWhere));

	$allRecords = $resume->cntAnnounces(); // получаем общее количество объявлений
	$path = CONF_SCRIPT_URL . 'index.php?ut=' . $_SESSION['sd_user'][DB_PREFIX . 'conf']['user_type'] . '&amp;do=resume';
	$strId = (!$id) ? 'page=offset&amp;' : "id=$id&amp;page=offset&amp;";

	$strPages = strings::generatePage($allRecords, $offset, CONF_ANNOUNCE_PERPAGE_SITE, $path . '&amp;action=regions&amp;' . $strId); // формируем страницы

	$smarty->assign('link', $path . '&amp;action=view&amp;id=');
	$smarty->assignByRef('string_page', $strPages); //передаем в шаблон строку сформированных страниц

	if (!$id) {
		$smarty->assign('return_subcategory_data', false);
		// инициируем "Наименование страницы" отображаемое в заголовке формы
		$arrNamePage = array(
			array('name' => MENU_ANNOUNCES_NAVIGATOR, 'link' => false),
			array('name' => FORM_RESUMES_HEAD, 'link' => false),
			array('name' => FORM_ALL, 'link' => false)
		);
	} else {
		$smarty->assign('return_subcategory_data', $citys->retCategorysByParentIds($id));
		// инициируем "Наименование страницы" отображаемое в заголовке формы
		$arrNamePage = array(
			array('name' => MENU_ANNOUNCES_NAVIGATOR, 'link' => false),
			array('name' => FORM_RESUMES_HEAD, 'link' => chpu::createChpuUrl($path . '&amp;action=regions')),
			array('name' => $arrDataRegions[$id]['name'], 'link' => false)
		);

		if (!empty($arrDataRegions[$id]['title'])) {
			$smarty->assignByRef('page_title', $arrDataRegions[$id]['title']);
		}

		if (!empty($arrDataRegions[$id]['meta_keywords'])) {
			$smarty->assignByRef('meta_keywords', $arrDataRegions[$id]['meta_keywords']);
		}

		if (!empty($arrDataRegions[$id]['meta_description'])) {
			$smarty->assignByRef('meta_description', $arrDataRegions[$id]['meta_description']);
		}
	}
}
// END отображение шаблона навигатора по регионам

/**
 * отображение шаблона навигатора по городам
 */
elseif (!empty($arrActPage['citys'])) {
	// если передан id
	if (!empty($_GET['id']) && validate::checkNaturalNumber($_GET['id']) && !empty($arrDataCitys[$_GET['id']]) && is_array($arrDataCitys[$_GET['id']])) {
		if (!empty($_GET['tId']) && !in_array($_GET['tId'], $arrDataCitys[$_GET['id']])) {
			messages::error404();
		} else {
			$id = $_GET['id'];
		}

		$offset = isset($_GET['offset']) ? (int) abs($_GET['offset']) : 0; //смещение, всегда 0 (затем берется из $_GET)

		$strWhere = "id_city IN ('$id')";
		$arrLimit = array('strLimit' => $offset . ', ' . CONF_ANNOUNCE_PERPAGE_SITE, 'calcRows' => true);

		$smarty->assign('return_data', $resume->getActiveAnnounces($arrLimit, $strWhere));

		$allRecords = $resume->cntAnnounces(); // получаем общее количество объявлений
		$path = CONF_SCRIPT_URL . 'index.php?ut=' . $_SESSION['sd_user'][DB_PREFIX . 'conf']['user_type'] . '&amp;do=resume';
		$strId = (!$id) ? 'page=offset&amp;' : "id=$id&amp;page=offset&amp;";

		$strPages = strings::generatePage($allRecords, $offset, CONF_ANNOUNCE_PERPAGE_SITE, $path . '&amp;action=citys&amp;' . $strId); // формируем страницы

		$smarty->assign('link', $path . '&amp;action=view&amp;id=');
		$smarty->assignByRef('string_page', $strPages); //передаем в шаблон строку сформированных страниц
		// инициируем "Наименование страницы" отображаемое в заголовке формы
		$arrNamePage = array(
			array('name' => MENU_ANNOUNCES_NAVIGATOR, 'link' => false),
			array('name' => FORM_RESUMES_HEAD, 'link' => chpu::createChpuUrl($path . '&amp;action=regions')),
			array('name' => $arrDataRegions[$arrDataCitys[$id]['parent_id']]['name'], 'link' => chpu::createChpuUrl($path . '&amp;action=regions&amp;id=' . $arrDataRegions[$arrDataCitys[$id]['parent_id']]['tId'])),
			array('name' => $arrDataCitys[$id]['name'], 'link' => false)
		);

		if (!empty($arrDataCitys[$id]['title'])) {
			$smarty->assignByRef('page_title', $arrDataCitys[$id]['title']);
		}

		if (!empty($arrDataCitys[$id]['meta_keywords'])) {
			$smarty->assignByRef('meta_keywords', $arrDataCitys[$id]['meta_keywords']);
		}

		if (!empty($arrDataCitys[$id]['meta_description'])) {
			$smarty->assignByRef('meta_description', $arrDataCitys[$id]['meta_description']);
		}
	} elseif (isset($_GET['id'])) {
		messages::error404();
	} else {
		$smarty->assign('return_data', false);
		// инициируем "Наименование страницы" отображаемое в заголовке формы
		$arrNamePage = array(
			array('name' => MENU_ANNOUNCES_NAVIGATOR, 'link' => false),
			array('name' => FORM_RESUMES_HEAD, 'link' => chpu::createChpuUrl(CONF_SCRIPT_URL . 'index.php?ut=' . $_SESSION['sd_user'][DB_PREFIX . 'conf']['user_type'] . '&amp;do=resume&amp;action=regions'))
		);
	}
}
// END отображение шаблона навигатора по городам

/**
 * отображение шаблона вип/хот объявлений
 */
elseif (!empty($arrActPage['vip']) || !empty($arrActPage['hot'])) {
	$offset = isset($_GET['offset']) ? (int) abs($_GET['offset']) : 0; //смещение, всегда 0 (затем берется из $_GET)

	$status = (!empty($arrActPage['vip'])) ? 'vip' : 'hot';

	$arrLimit = array('strLimit' => $offset . ', ' . CONF_ANNOUNCE_PERPAGE_SITE, 'calcRows' => true);

	$smarty->assign('return_data', $resume->getActiveAnnounces($arrLimit, $status));

	$allRecords = $resume->cntAnnounces();
	$path = CONF_SCRIPT_URL . 'index.php?ut=' . $_SESSION['sd_user'][DB_PREFIX . 'conf']['user_type'] . '&amp;do=resume';

	$strPages = strings::generatePage($allRecords, $offset, CONF_ANNOUNCE_PERPAGE_SITE, $path . '&amp;action=' . $status . '&amp;page=offset&amp;'); // формируем страницы

	$smarty->assign('link', $path . '&amp;action=view&amp;id=');
	$smarty->assignByRef('string_page', $strPages); //передаем в шаблон строку сформированных страниц
	// инициируем "Наименование страницы" отображаемое в заголовке формы
	$arrNamePage = array(
		array('name' => constant('SITE_' . strtoupper($status) . '_RESUMES'), 'link' => false),
		array('name' => FORM_ALL, 'link' => false)
	);
}
// END отображение шаблона вип/хот объявлений

$smarty->assignByRef('errors', $arrErrors);
$smarty->assignByRef('warnings', $arrWarnings);
$smarty->assignByRef('actPage', $arrActPage);
