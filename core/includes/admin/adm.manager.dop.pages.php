<?php
/********************************************************
	powered by Script Developers Group (SD-Group)
	email: info@sd-group.org.ua
	url: http://sd-group.org.ua/
	Copyright 2009 (c) SD-Group
	All rights reserved
=========================================================
	Менеджер - Дополнительные страницы
********************************************************/

(!defined('SDG')) ? die ('Triple protection!') : null;

// инициируем "Наименование страницы" отображаемое в форме
$arrNamePage = array(
						array('name' => MENU_ADMIN_MAIN, 'link' => CONF_ADMIN_FILE),
						array('name' => MENU_MANAGER, 'link' => false)
					);

/**
* иницализация массива подключаемых шаблонов: по умолчанию все значения - false
* для подключения шаблона, необходимо установить значение - true
* шаблоны подключаются в порядке установленном в файле головного шаблона
*/
$arrActions = array(
						'view' 			=> false,
						'add' 			=> false,
						'edit' 			=> false
                    );

// создаем объект
$pages = new pages();

/**
* Добавление, редактирование страницы
*/
if (isset($_GET['action']))
{
	$arrNamePage[] = array('name' => MENU_MANAGER_DOP_PAGES, 'link' => CONF_ADMIN_FILE . '?m=manager&amp;s=dop.pages');
	/**
	* добавление новой страницы
	*/
	if ('add' === $_GET['action'])
	{
		// инициируем "Наименование страницы" отображаемое в форме
		$arrNamePage[] = array('name' => MENU_ACTION_ADD, 'link' => false);

		/**
		* Проверка данных и запись в базу
		*/
		if (isset($_POST['save']))
		{
			// получаем из формы поля обязательные для заполнения
			$arrBindFields = $_POST['arrBindFields'];
			// получаем из формы поля не обязательные для заполнения
			$arrNoBindFields = $_POST['arrNoBindFields'];

			$arrBindFields['id'] = strtolower(trim($arrBindFields['id']));
			$arrNoBindFields['token'] = isset($arrNoBindFields['token']) ? 'active' : 'archived';
			$arrNoBindFields['sort'] = (int) abs($arrNoBindFields['sort']);

			///////////////////////////////////////////////////////////////
			// Проверка данных, полученных из формы 
			///////////////////////////////////////////////////////////////
			// проверка ID
			if (!$arrBindFields['id'])
			{
				$arrErrors[] = ERROR_EMPTY_ID;
			}
			elseif (!preg_match("/^[A-z0-9_]+$/", $arrBindFields['id']))
			{
				$arrErrors[] = ERROR_ID;
			}
			else
			{
				if($pages -> issetPage("id IN (" . secure::escQuoteData($arrBindFields['id']) . ") AND token IN ('active','archived')"))
				{
					$arrErrors[] = ERROR_EXISTS_ID;
				}
			}

			// проверка названия страницы
			if (!$arrBindFields['title'])
			{
				$arrErrors[] = ERROR_EMPTY_NAME;
			}
			///////////////////////////////////////////////////////////////
			///////////////////////////////////////////////////////////////

			if (!$arrErrors)
			{
				// присваеваем полученные данные объекту
				$pages -> arrBindFields = $arrBindFields;
				$pages -> arrNoBindFields = $arrNoBindFields;

				// производим запись в таблицу БД
				(!$pages -> recPage()) ? $arrErrors[] = (db::$message_error ? db::$message_error : ERROR_MISMATCH_FIELDS) : messages::messageChangeSaved(MESSAGE_PAGE_ADDED, false, CONF_ADMIN_FILE . '?m=manager&s=dop.pages');
			}
			else
			{
				$smarty -> assign('return_data', $arrBindFields + $arrNoBindFields);
			}
		}

		$arrActions['add'] = true;
	}
	// END добавление новой страницы

	// редатирование страницы
	elseif ('edit' === $_GET['action'] && !empty($_GET['id'])) {
		// инициируем "Наименование страницы" отображаемое в форме
		$arrNamePage[] = array('name' => MENU_ACTION_EDIT, 'link' => false);

		$_GET['id'] = $_GET['id'] ? (string) strtolower($_GET['id']) : '';

		if($pages -> issetPage("id IN (" . secure::escQuoteData($_GET['id']) . ") AND token IN ('active','archived')")) {
			$arrPage = $pages -> getPage("id IN (" . secure::escQuoteData($_GET['id']) . ")");
			$smarty -> assign('return_data', $arrPage);

			// сохранение отредактированной страницы
			if (isset($_POST['save'])) {
				// получаем из формы поля обязательные для заполнения
				$arrBindFields = $_POST['arrBindFields'];
				// получаем из формы поля не обязательные для заполнения
				$arrNoBindFields = $_POST['arrNoBindFields'];

				$arrBindFields['id'] = strtolower(trim($arrBindFields['id']));
				$arrNoBindFields['token'] = isset($arrNoBindFields['token']) ? 'active' : 'archived';
				$arrNoBindFields['sort'] = (int) abs($arrNoBindFields['sort']);

				///////////////////////////////////////////////////////////////
				// Проверка данных, полученных из формы 
				///////////////////////////////////////////////////////////////
				// проверка ID
				if (!$arrBindFields['id']) {
					$arrErrors[] = ERROR_EMPTY_ID;
				} elseif (!preg_match("/^[A-z0-9_]+$/", $arrBindFields['id'])) {
					$arrErrors[] = ERROR_ID;
				} elseif ($_GET['id'] !== $arrBindFields['id']) {
					if($pages -> issetPage("id IN (" . secure::escQuoteData($arrBindFields['id']) . ") AND token IN ('active','archived')")) {
						$arrErrors[] = ERROR_EXISTS_ID;
					}
				}

				// проверка названия страницы
				if (!$arrBindFields['title']) {
					$arrErrors[] = ERROR_EMPTY_NAME;
				}
				///////////////////////////////////////////////////////////////
				///////////////////////////////////////////////////////////////

				if (!$arrErrors) {
					// присваеваем полученные данные объекту
					$pages -> arrBindFields = $arrBindFields;
					$pages -> arrNoBindFields = $arrNoBindFields;

					// производим запись в таблицу БД
					if (!$pages -> updatePages($arrBindFields + $arrNoBindFields, array($_GET['id']))) {
						$arrErrors[] = (db::$message_error ? db::$message_error : ERROR_MISMATCH_FIELDS);
					} else {
						messages::messageChangeSaved(MESSAGE_CHANGE_SAVED, false, CONF_ADMIN_FILE . '?m=manager&s=dop.pages');
					}
				} else {
					$arrBindFields['id'] = $_GET['id'];
					$smarty -> assign('return_data', $arrBindFields + $arrNoBindFields);
				}
			}

			$arrActions['edit'] = true;
		} else {
			messages::error404();
		}
	}
	// редатирование страницы
}
// END Добавление, редактирование страницы

/**
* отображение, скрытие, удаление и сортировка страниц
*/
elseif (isset($_POST['action']))
{
	// отображение
	if ('show' === $_POST['action'] && isset($_POST['pages']))
	{
		if ($pages -> updatePages(array('token' => 'active'), array_keys($_POST['pages'])))
		{
			messages::messageChangeSaved(MESSAGE_CHANGE_SAVED, false, CONF_ADMIN_FILE . '?m=manager&s=dop.pages');
		}
		else
		{
			messages::messageChangeSaved(ERROR_NOT_SAVE_CHANGE, false, CONF_ADMIN_FILE . '?m=manager&s=dop.pages');
		}
	}

	// скрытие
	if ('hide' === $_POST['action'] && isset($_POST['pages']))
	{
		if ($pages -> updatePages(array('token' => 'archived'), array_keys($_POST['pages'])))
		{
			messages::messageChangeSaved(MESSAGE_CHANGE_SAVED, false, CONF_ADMIN_FILE . '?m=manager&s=dop.pages');
		}
		else
		{
			messages::messageChangeSaved(ERROR_NOT_SAVE_CHANGE, false, CONF_ADMIN_FILE . '?m=manager&s=dop.pages');
		}
	}

	// удаление
	if ('del' === $_POST['action'] && isset($_POST['pages']))
	{
		$pages -> deletePages(array_keys($_POST['pages']));

		messages::messageChangeSaved(MESSAGE_CHANGE_SAVED, false, CONF_ADMIN_FILE . '?m=manager&s=dop.pages');
	}

	// сортировка
	if ('sorting' === $_POST['action'] && !empty($_POST['sort']))
	{
		foreach ($_POST['sort'] as $key => $value)
		{
			$pages -> updatePages(array('sort' => $value), array($key));
		}

		messages::messageChangeSaved(MESSAGE_CHANGE_SAVED, false, CONF_ADMIN_FILE . '?m=manager&s=dop.pages');
	}

	messages::messageChangeSaved(MESSAGE_WARNING_NOT_SELECT_RECORDS, false, CONF_ADMIN_FILE . '?m=manager&s=dop.pages');
}
// END отображение, скрытие, удаление и сортировка страниц

/**
* Вывод всех страниц
*/
else
{
	$arrNamePage[] = array('name' => MENU_MANAGER_DOP_PAGES, 'link' => false);
	/**
	* массив всех страниц
	*/
	$smarty -> assign('arrPages', $pages -> getAllPages());
}
// END Вывод всех страниц

$smarty -> assignByRef('errors', $arrErrors);
$smarty -> assignByRef('action', $arrActions);
