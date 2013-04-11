<?php

/**
 * Powered by Script Developers Group (SD-Group)
 * Email: info@sd-group.org.ua
 * URL: http://sd-group.org.ua/
 * Copyright 2009 (c) SD-Group
 * All rights reserved
 * ===================================================
 * Менеджер - Разделы
 * ===================================================
 */
(!defined('SDG')) ? die('Triple protection!') : null;

/**
 * иницализация массива подключаемых шаблонов: по умолчанию все значения - false
 * для подключения шаблона, необходимо установить значение - true
 * шаблоны подключаются в порядке установленном в файле головного шаблона
 */
$arrActSections = array(
	'sections' => false,
	'professions' => false,
	'edit' => false
);

// инициируем объект - Разделы
$sections = new sections();
// инициируем объект - Профессии
$professions = new professions();

/**
 * Работа со списком Профессий
 */
if (isset($_GET['action'])) {
	if ('professions' === $_GET['action']) {
		if (isset($_GET['pid']) && ($pid = (int) $_GET['pid']) && 0 < $pid && ($section = $sections->retCategorysByIds($pid))) {
			// инициируем "Наименование страницы" отображаемое в форме
			$arrNamePage = array(
				array('name' => MENU_ADMIN_MAIN, 'link' => CONF_ADMIN_FILE),
				array('name' => MENU_DICTIONARY_SECTIONS, 'link' => CONF_ADMIN_FILE . '?m=dictionary&amp;s=sections'),
				array('name' => $section[$pid]['name'], 'link' => false)
			);

			$arrActSections['professions'] = true;

			// массив всех Профессий
			$smarty->assign('arrProfessions', $professions->retCategorysByParentIds($section[$pid]['id']));
			$smarty->assignByRef('pid', $pid);

			/**
			 * добавление Профессии
			 */
			if (isset($_POST['add_profession'])) {
				if (isset($_POST['arrBindFields']) || is_array($_POST['arrBindFields']) || !empty($_POST['arrBindFields'])) {
					(!$_POST['arrBindFields']['name']) ? $arrErrors[] = ERROR_EMPTY_NAME : null;
					(!$_POST['arrBindFields']['parent_id']) ? $arrErrors[] = ERROR_EMPTY_ID : null;

					if (empty($arrErrors)) {
						/**
						 * передаем данные для записи в таблицу профессий
						 */
						$professions->arrBindFields = $_POST['arrBindFields']; // обязательные поля
						(isset($_POST['arrNoBindFields'])) ? $professions->arrNoBindFields = $_POST['arrNoBindFields'] : null; // необязательные поля

						$professions->recCategory(); // производим запись

						messages::messageChangeSaved(MESSAGE_PROFESSION_ADDED, false, CONF_ADMIN_FILE . '?m=dictionary&amp;s=sections&amp;action=professions&amp;pid=' . $pid);
					}
				}
			}
			// END добавление Профессии

			/**
			 * групповые действия с Профессиями - Редактирование/Сортировка/Удаление
			 */ elseif (isset($_POST['action'])) {
				if ('edit' === $_POST['action'] && isset($_POST['profession']) && is_array($_POST['profession']) && !empty($_POST['profession'])) {
					$arrActSections['edit'] = true;

					// инициируем "Наименование страницы" отображаемое в форме
					$arrNamePage = array(
						array('name' => MENU_ADMIN_MAIN, 'link' => CONF_ADMIN_FILE),
						array('name' => MENU_DICTIONARY_SECTIONS, 'link' => CONF_ADMIN_FILE . '?m=dictionary&amp;s=sections'),
						array('name' => $section[$pid]['name'], 'link' => CONF_ADMIN_FILE . '?m=dictionary&amp;s=sections&amp;action=professions&amp;pid=' . $pid),
						array('name' => FORM_ACTION_EDIT, 'link' => false)
					);

					$smarty->assign('arrProfessions', $professions->retCategorysByIds(array_keys($_POST['profession'])));

					if (isset($_POST['save_professions'])) {
						// проверяем на пустоту, поля обязательные для заполнения
						foreach ($_POST['profession'] as $value) {
							if (!validate::arrDataNotEmpty($value['arrBindFields'])) {
								$arrErrors[] = ERROR_EMPTY_NAME;
								break;
							}
						}

						(empty($arrErrors)) ? $professions->actionProfessions($_POST['action'], $_POST['profession'], $section[$pid]['id']) : null;
					}
				} elseif ('sort' === $_POST['action'] && isset($_POST['sort_profession']) && is_array($_POST['sort_profession']) && !empty($_POST['sort_profession'])) {
					$professions->actionProfessions($_POST['action'], $_POST['sort_profession'], $section[$pid]['id']);
				} elseif ('del' === $_POST['action'] && isset($_POST['profession']) && is_array($_POST['profession']) && !empty($_POST['profession'])) {
					$professions->actionProfessions($_POST['action'], array_keys($_POST['profession']), $section[$pid]['id']);
				} else {
					messages::messageChangeSaved(MESSAGE_WARNING_UNKNOWN_ACTION, false, CONF_ADMIN_FILE . '?m=dictionary&amp;s=sections&amp;action=professions&amp;pid=' . $pid);
				}
			}
			// END групповые действия с Профессиями - Редактирование/Сортировка/Удаление
		} else {
			messages::messageChangeSaved(ERROR_SECTION_NOT_EXISTS, false, CONF_ADMIN_FILE . '?m=dictionary&amp;s=sections');
		}
	} else {
		messages::messageChangeSaved(MESSAGE_WARNING_UNKNOWN_ACTION, false, CONF_ADMIN_FILE . '?m=dictionary&amp;s=sections');
	}
}
// END Добавление, редактирование, настройки

/**
 * Работа со списком Разделов
 */ else {
	$arrActSections['sections'] = true;

	/**
	 * добавление Раздела
	 */
	if (isset($_POST['add_section'])) {
		if (!isset($_POST['arrBindFields']) || !is_array($_POST['arrBindFields']) || empty($_POST['arrBindFields']) || !$_POST['arrBindFields']['name']) {
			$arrErrors[] = ERROR_EMPTY_NAME;

			// инициируем "Наименование страницы" отображаемое в форме
			$arrNamePage = array(
				array('name' => MENU_ADMIN_MAIN, 'link' => CONF_ADMIN_FILE),
				array('name' => MENU_DICTIONARY_SECTIONS, 'link' => false)
			);

			// массив всех Разделов
			$smarty->assign('arrSections', $sections->retCategorys());
		} else {
			/**
			 * передаем данные для записи в таблицу разделов
			 */
			$sections->arrBindFields = $_POST['arrBindFields']; // обязательные поля
			(isset($_POST['arrNoBindFields'])) ? $sections->arrNoBindFields = $_POST['arrNoBindFields'] : null; // необязательные поля, если заполнено

			$sections->recCategory(); // производим запись

			messages::messageChangeSaved(MESSAGE_SECTION_ADDED, false, CONF_ADMIN_FILE . '?m=dictionary&amp;s=sections');
		}
	}
	// END добавление Раздела

	/**
	 * групповые действия с Разделами - Редактирование/Сортировка/Удаление
	 */ elseif (isset($_POST['action'])) {
		if ('edit' === $_POST['action'] && isset($_POST['section']) && is_array($_POST['section']) && !empty($_POST['section'])) {
			$arrActSections['edit'] = true;

			// инициируем "Наименование страницы" отображаемое в форме
			$arrNamePage = array(
				array('name' => MENU_ADMIN_MAIN, 'link' => CONF_ADMIN_FILE),
				array('name' => MENU_DICTIONARY_SECTIONS, 'link' => CONF_ADMIN_FILE . '?m=dictionary&amp;s=sections'),
				array('name' => FORM_ACTION_EDIT, 'link' => false)
			);

			$smarty->assign('arrSections', $sections->retCategorysByIds(array_keys($_POST['section'])));

			if (isset($_POST['save_sections'])) {
				// проверяем на пустоту, поля обязательные для заполнения
				foreach ($_POST['section'] as $value) {
					if (!validate::arrDataNotEmpty($value['arrBindFields'])) {
						$arrErrors[] = ERROR_EMPTY_NAME;
						break;
					}
				}

				(empty($arrErrors)) ? $sections->actionSections($_POST['action'], $_POST['section']) : null;
			}
		} elseif ('sort' === $_POST['action'] && isset($_POST['sort_section']) && is_array($_POST['sort_section']) && !empty($_POST['sort_section'])) {
			$sections->actionSections($_POST['action'], $_POST['sort_section']);
		} elseif ('del' === $_POST['action'] && isset($_POST['section']) && is_array($_POST['section']) && !empty($_POST['section'])) {
			$sections->actionSections($_POST['action'], array_keys($_POST['section']));
		} else {
			messages::messageChangeSaved(MESSAGE_WARNING_UNKNOWN_ACTION, false, CONF_ADMIN_FILE . '?m=dictionary&amp;s=sections');
		}
	}
	// END групповые действия с Разделами - Редактирование/Сортировка/Удаление
	else {
		// инициируем "Наименование страницы" отображаемое в форме
		$arrNamePage = array(
			array('name' => MENU_ADMIN_MAIN, 'link' => CONF_ADMIN_FILE),
			array('name' => MENU_DICTIONARY_SECTIONS, 'link' => false)
		);

		// массив всех Разделов
		$smarty->assign('arrSections', $sections->retCategorys());
	}
}

$smarty->assignByRef('errors', $arrErrors);
$smarty->assignByRef('action', $arrActSections);
