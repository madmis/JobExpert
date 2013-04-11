<?php
/********************************************************
	JobExpert v1.0
	powered by Script Developers Group (SD-Group)
	email: info@sd-group.org.ua
	url: http://sd-group.org.ua/
	Copyright 2010-2015 (c) SD-Group
	All rights reserved
=========================================================
	Словари - Разделы статей
********************************************************/
/**
* @package
* @todo
*/

(!defined('SDG')) ? die ('Triple protection!') : null;

/**
* иницализация массива подключаемых шаблонов: по умолчанию все значения - false
* для подключения шаблона, необходимо установить значение - true
* шаблоны подключаются в порядке установленном в файле головного шаблона
*/
$arrAction = array(
					'add'	=> false,
					'edit'	=> false
				);
				
// инициируем "Наименование страницы" отображаемое в форме
$arrNamePage = array(
						array('name' => MENU_ADMIN_MAIN, 'link' => CONF_ADMIN_FILE),
						array('name' => MENU_DICTIONARY, 'link' => false)
					);

// создаем объект
$artsections = new artsections();

                    
/**
* Добавление, редактирование раздела
*/
if (isset($_GET['action']))
{
	// инициируем "Наименование страницы" отображаемое в форме
	$arrNamePage[] = array('name' => MENU_DICTIONARY_ARTICLES_SECTIONS, 'link' => CONF_ADMIN_FILE . '?m=dictionary&amp;s=articles.sections');

	/**
	* добавление раздела
	*/
	if ('add' === $_GET['action'])
	{
		// инициируем "Наименование страницы" отображаемое в форме
		$arrNamePage[] = array('name' => MENU_DICTIONARY_ARTICLES_SECTIONS_ADD, 'link' => false);

		if (isset($_POST['save']) && isset($_POST['arrBindFields']['name']) && $_POST['arrBindFields']['name']) // добавление раздела
		{
			// получаем из формы поля обязательные для заполнения
			$artsections -> arrBindFields = $_POST['arrBindFields'];

			// производим запись в таблицу БД
			(!$artsections -> recSection()) ? $arrErrors[] = (db::$message_error ? db::$message_error : ERROR_MISMATCH_FIELDS) : messages::messageChangeSaved(MESSAGE_SECTION_ADDED, false, CONF_ADMIN_FILE . '?m=dictionary&s=articles.sections&action=add');
		}

		$arrAction['add'] = true;
	}

	/**
	* редактирование раздела
	*/
	elseif ('edit' === $_GET['action'] && isset($_GET['id']))
	{
		// проверяем существование раздела
		if ($arrData = $artsections -> getSectionById($_GET['id']))
		{
			$arrNamePage[] = array('name' => MENU_DICTIONARY_ARTICLES_SECTIONS_EDIT, 'link' => false);

			$smarty -> assignByRef('return_data', $arrData);

			if (isset($_POST['save']) && isset($_POST['arrBindFields']['name']) && $_POST['arrBindFields']['name']) // добавление раздела
			{
				// получаем из формы поля обязательные для заполнения
				$artsections -> arrBindFields = $_POST['arrBindFields'];

				// производим запись в таблицу БД
				(!$artsections -> updateSections($_POST['arrBindFields'], array($_GET['id']))) ? $arrErrors[] = (db::$message_error ? db::$message_error : ERROR_MISMATCH_FIELDS) : messages::messageChangeSaved(MESSAGE_CHANGE_SAVED, false, CONF_ADMIN_FILE . '?m=dictionary&s=articles.sections');
			}

			$arrAction['edit'] = true;		
		}
		else
		{
			$arrErrors[] = ERROR_SECTION_NOT_EXISTS;
		}
	}
}
else
{
	// инициируем "Наименование страницы" отображаемое в форме
	$arrNamePage[] = array('name' => MENU_DICTIONARY_ARTICLES_SECTIONS, 'link' => false);

	/**
	* удаление разделов статей
	*/
	if (isset($_POST['action']))
	{
		if (('del' === $_POST['action']) && isset($_POST['sections']))
		{
			$artsections -> deleteSections(array_keys($_POST['sections']));

			messages::messageChangeSaved(MESSAGE_CHANGE_SAVED, false, CONF_ADMIN_FILE . '?m=dictionary&s=articles.sections');
		}
		else
		{
			messages::messageChangeSaved(MESSAGE_WARNING_NOT_SELECT_RECORDS, false, CONF_ADMIN_FILE . '?m=dictionary&s=articles.sections');
		}
	}
	// END отображение, скрытие, удаление новостей

}

// получаем все разделы
$smarty -> assign('sections', $artsections -> getSections());

$smarty -> assignByRef('errors', $arrErrors);
$smarty -> assignByRef('action', $arrAction);

