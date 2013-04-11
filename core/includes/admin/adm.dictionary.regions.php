<?php

/**
 * Powered by Script Developers Group (SD-Group)
 * Email: info@sd-group.org.ua
 * URL: http://sd-group.org.ua/
 * Copyright 2009 (c) SD-Group
 * All rights reserved
 * ===================================================
 * Менеджер - Регионы
 * ===================================================
 */
(!defined('SDG')) ? die('Triple protection!') : null;

/**
 * иницализация массива подключаемых шаблонов: по умолчанию все значения - false
 * для подключения шаблона, необходимо установить значение - true
 * шаблоны подключаются в порядке установленном в файле головного шаблона
 */
$arrActRegions = array(
	'regions' => false,
	'citys' => false,
	'edit' => false
);

// инициируем объект - Регионы
$regions = new regions();
// инициируем объект - Города
$citys = new citys();

/**
 * Работа со списком Городов
 */
if (isset($_GET['action'])) {
	if ('citys' === $_GET['action']) {
		if (isset($_GET['pid']) && ($pid = (int) $_GET['pid']) && 0 < $pid && ($region = $regions->retCategorysByIds($pid))) {
			// инициируем "Наименование страницы" отображаемое в форме
			$arrNamePage = array(
				array('name' => MENU_ADMIN_MAIN, 'link' => CONF_ADMIN_FILE),
				array('name' => MENU_DICTIONARY_REGIONS, 'link' => CONF_ADMIN_FILE . '?m=dictionary&amp;s=regions'),
				array('name' => $region[$pid]['name'], 'link' => false)
			);

			$arrActRegions['citys'] = true;

            if ($region[$pid]['major']) {
                $arrErrors[] = ERROR_REGION_MAJOR;
            } else {
                $smarty->assign('arrCitys', $citys->retCategorysByParentIds($region[$pid]['id']));
            }

			$smarty->assignByRef('pid', $pid);

			/**
			 * добавление Города
			 */
			if (isset($_POST['add_city'])) {
				if (isset($_POST['arrBindFields']) || is_array($_POST['arrBindFields']) || !empty($_POST['arrBindFields'])) {
					(!$_POST['arrBindFields']['name']) ? $arrErrors[] = ERROR_EMPTY_NAME : null;
					(!$_POST['arrBindFields']['parent_id']) ? $arrErrors[] = ERROR_EMPTY_ID : null;

					if (empty($arrErrors)) {
						/**
						 * передаем данные для записи в таблицу городов
						 */
						$citys->arrBindFields = $_POST['arrBindFields']; // обязательные поля

                        // необязательные поля
                        if (empty($_POST['arrNoBindFields']['capital'])) {
                            $_POST['arrNoBindFields']['capital'] = 0;
                        }

                        $citys->arrNoBindFields = $_POST['arrNoBindFields'];

						$citys->recCategory(); // производим запись

						messages::messageChangeSaved(MESSAGE_CITY_ADDED, false, CONF_ADMIN_FILE . '?m=dictionary&amp;s=regions&amp;action=citys&amp;pid=' . $pid);
					}
				}
			}
			// END добавление Города

			/**
			 * групповые действия с Городами - Редактирование/Сортировка/Удаление
			 */ elseif (isset($_POST['action'])) {
				if ('edit' === $_POST['action'] && isset($_POST['city']) && is_array($_POST['city']) && !empty($_POST['city'])) {
					$arrActRegions['edit'] = true;

					// инициируем "Наименование страницы" отображаемое в форме
					$arrNamePage = array(
						array('name' => MENU_ADMIN_MAIN, 'link' => CONF_ADMIN_FILE),
						array('name' => MENU_DICTIONARY_REGIONS, 'link' => CONF_ADMIN_FILE . '?m=dictionary&amp;s=regions'),
						array('name' => $region[$pid]['name'], 'link' => CONF_ADMIN_FILE . '?m=dictionary&amp;s=regions&amp;action=citys&amp;pid=' . $pid),
						array('name' => FORM_ACTION_EDIT, 'link' => false)
					);

					$smarty->assign('arrCitys', $citys->retCategorysByIds(array_keys($_POST['city'])));

					if (isset($_POST['save_citys'])) {
						// проверяем на пустоту, поля обязательные для заполнения
						foreach ($_POST['city'] as $value) {
							if (!validate::arrDataNotEmpty($value['arrBindFields'])) {
								$arrErrors[] = ERROR_EMPTY_NAME;
								break;
							}
						}

						isset($_POST['capital_city']) ? $_POST['city']['capital_city'] = $_POST['capital_city'] : null;

						(empty($arrErrors)) ? $citys->actionCitys($_POST['action'], $_POST['city'], $region[$pid]['id']) : null;
					}
				} elseif ('setcapital' === $_POST['action'] && isset($_POST['capital_city']) && !empty($_POST['capital_city'])) {
					$citys->actionCitys($_POST['action'], array($_POST['capital_city']), $region[$pid]['id']);
				} elseif ('resetcapital' === $_POST['action']) {
					$citys->actionCitys($_POST['action'], array($region[$pid]['id']), $region[$pid]['id']);
				} elseif ('del' === $_POST['action'] && isset($_POST['city']) && is_array($_POST['city']) && !empty($_POST['city'])) {
					$citys->actionCitys($_POST['action'], array_keys($_POST['city']), $region[$pid]['id']);
				} else {
					messages::messageChangeSaved(MESSAGE_WARNING_UNKNOWN_ACTION, false, CONF_ADMIN_FILE . '?m=dictionary&amp;s=regions&amp;action=citys&amp;pid=' . $pid);
				}
			}
			// END групповые действия с Городами - Редактирование/Сортировка/Удаление
		} else {
			messages::messageChangeSaved(ERROR_SECTION_NOT_EXISTS, false, CONF_ADMIN_FILE . '?m=dictionary&amp;s=regions');
		}
	} else {
		messages::messageChangeSaved(MESSAGE_WARNING_UNKNOWN_ACTION, false, CONF_ADMIN_FILE . '?m=dictionary&amp;s=regions');
	}
}
// END Добавление, редактирование, настройки

/**
 * Работа со списком Регионов
 */ else {
	$arrActRegions['regions'] = true;

	/**
	 * добавление Региона
	 */
	if (isset($_POST['add_region'])) {
		if (!isset($_POST['arrBindFields']) || !is_array($_POST['arrBindFields']) || empty($_POST['arrBindFields']) || !$_POST['arrBindFields']['name']) {
			$arrErrors[] = ERROR_EMPTY_NAME;

			// инициируем "Наименование страницы" отображаемое в форме
			$arrNamePage = array(
				array('name' => MENU_ADMIN_MAIN, 'link' => CONF_ADMIN_FILE),
				array('name' => MENU_DICTIONARY_REGIONS, 'link' => false)
			);

			// массив всех Регионов
			$smarty->assign('arrRegions', $regions->retCategorys());
		} else {
			/**
			 * передаем данные для записи в таблицу регионов
			 */
			$regions->arrBindFields = $_POST['arrBindFields']; // обязательные поля

            if (isset($_POST['arrNoBindFields']['major'])) {
                $_POST['arrNoBindFields']['add_city_allowed'] = 0;
            } else if (isset($_POST['arrNoBindFields']['add_city_allowed'])) {
                $_POST['arrNoBindFields']['major'] = 0;
            } else {
                $_POST['arrNoBindFields']['major'] = 0;
                $_POST['arrNoBindFields']['add_city_allowed'] = 0;
            }

            $regions->arrNoBindFields = &$_POST['arrNoBindFields']; // необязательные поля, если заполнено

			$regions->recCategory(); // производим запись

			messages::messageChangeSaved(MESSAGE_REGION_ADDED, false, CONF_ADMIN_FILE . '?m=dictionary&amp;s=regions');
		}
	}
	// END добавление Региона

	/**
	 * групповые действия с Регионами - Редактирование/Сортировка/Удаление
	 */ elseif (isset($_POST['action'])) {
		if ('edit' === $_POST['action'] && isset($_POST['region']) && is_array($_POST['region']) && !empty($_POST['region'])) {
			$arrActRegions['edit'] = true;

			// инициируем "Наименование страницы" отображаемое в форме
			$arrNamePage = array(
				array('name' => MENU_ADMIN_MAIN, 'link' => CONF_ADMIN_FILE),
				array('name' => MENU_DICTIONARY_REGIONS, 'link' => CONF_ADMIN_FILE . '?m=dictionary&amp;s=regions'),
				array('name' => FORM_ACTION_EDIT, 'link' => false)
			);

			$smarty->assign('arrRegions', $regions->retCategorysByIds(array_keys($_POST['region'])));

			if (isset($_POST['save_regions'])) {
				// проверяем на пустоту, поля обязательные для заполнения
				foreach ($_POST['region'] as &$value) {
					if (!validate::arrDataNotEmpty($value['arrBindFields'])) {
						$arrErrors[] = ERROR_EMPTY_NAME;
						break;
					}

                    if (isset($value['arrNoBindFields']['major'])) {
                        $value['arrNoBindFields']['add_city_allowed'] = 0;
                    } else if (isset($value['arrNoBindFields']['add_city_allowed'])) {
                        $value['arrNoBindFields']['major'] = 0;
                    } else {
                        $value['arrNoBindFields']['major'] = 0;
                        $value['arrNoBindFields']['add_city_allowed'] = 0;
                    }
				}

				(empty($arrErrors)) ? $regions->actionRegions($_POST['action'], $_POST['region']) : null;
			}
		} elseif ('sort' === $_POST['action'] && isset($_POST['sort_region']) && is_array($_POST['sort_region']) && !empty($_POST['sort_region'])) {
			$regions->actionRegions($_POST['action'], $_POST['sort_region']);
		} elseif ('del' === $_POST['action'] && isset($_POST['region']) && is_array($_POST['region']) && !empty($_POST['region'])) {
			$regions->actionRegions($_POST['action'], array_keys($_POST['region']));
		} else {
			messages::messageChangeSaved(MESSAGE_WARNING_UNKNOWN_ACTION, false, CONF_ADMIN_FILE . '?m=dictionary&amp;s=regions');
		}
	}
	// END групповые действия с Регионами - Редактирование/Сортировка/Удаление
	else {
		// инициируем "Наименование страницы" отображаемое в форме
		$arrNamePage = array(
			array('name' => MENU_ADMIN_MAIN, 'link' => CONF_ADMIN_FILE),
			array('name' => MENU_DICTIONARY_REGIONS, 'link' => false)
		);

		// массив всех Регионов
		$smarty->assign('arrRegions', $regions->retCategorys());
	}
}

$smarty->assignByRef('errors', $arrErrors);
$smarty->assignByRef('action', $arrActRegions);
