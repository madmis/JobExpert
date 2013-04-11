<?php
/********************************************************
	JobExpert v1.0
	powered by Script Developers Group (SD-Group)
	email: info@sd-group.org.ua
	url: http://sd-group.org.ua/
	Copyright 2010-2015 (c) SD-Group
	All rights reserved
=========================================================
	Главная страница модуля AdSimple (мод управления рекламой)
********************************************************/
/**
* @package
* @todo
*/

(!defined('SDG')) ? die ('Triple protection!') : null;

/********** Языковые файлы **********/
require_once 'core/mods/adsimple/lang/' . CONF_LANGUAGE . '/lang.adsimple.php';

// инициируем "Наименование страницы" отображаемое в форме
$arrNamePage = array(
	array('name' => MENU_ADMIN_MAIN, 'link' => CONF_ADMIN_FILE),
	array('name' => MENU_MODS, 'link' => CONF_ADMIN_FILE . '?m=mods&s=mods'),
	array('name' => MOD_ADSIMPLE, 'link' => false),
);



adsimple::checkMDAFile();

if (isset($_POST['save'])) {
	
	//var_dump($_POST);
	//exit;
	
 	if (!empty($_POST['advert'])  && !empty($_POST['ad_position'])) {
		$dbData = filesys::getSerializedData(adsimple::$dbFile);
		
		// Если передан индекс, записываем в указаный индекс
		if (!empty($_POST['index'])) {
			$dbData[$_POST['ad_position']][str_replace($_POST['ad_position'], '', $_POST['index'])] = array(
				'code' => $_POST['advert'],
				'htmlcode' => htmlentities($_POST['advert'], ENT_COMPAT, CONF_DEFAULT_CHARSET),
				'token' => (isset($_POST['token'])) ? 'active' : 'disabled'
			);
		} else {
			// Если индекс не передан, ищем индекс с пустой рекламой
			// Иначе записваем в конец массива
			$flag = false;
			foreach ($dbData[$_POST['ad_position']] as $key => $value) {
				if (empty($value['htmlcode'])) {
					$dbData[$_POST['ad_position']][$_POST['index']] = array(
						'code' => $_POST['advert'],
						'htmlcode' => htmlentities($_POST['advert'], ENT_COMPAT, CONF_DEFAULT_CHARSET),
						'token' => (isset($_POST['token'])) ? 'active' : 'disabled'
					);
					break;
					$flaf = true;
				}
			}
			
			if (!$flag) {
				$dbData[$_POST['ad_position']][] = array(
					'code' => $_POST['advert'],
					'htmlcode' => htmlentities($_POST['advert'], ENT_COMPAT, CONF_DEFAULT_CHARSET),
					'token' => (isset($_POST['token'])) ? 'active' : 'disabled'
				);
			}
		}

		if (filesys::putSerializedData(adsimple::$dbFile, $dbData)) {
			messages::messageChangeSaved(MOD_ADSIMPLE_MESSAGE_CHANGE_SAVED, false, CONF_ADMIN_FILE . '?m=mods&s=adsimple');
		} else {
			$arrErrors[] = MOD_ADSIMPLE_ERROR_CHANGE_NOT_SAVED;
		}
	} else {
		$arrErrors[] = MOD_ADSIMPLE_ERROR_EMPTY_FIELDS;
		$smarty -> assign('return_data', array(
			'ad_position' => $_POST['ad_position'],
			'advert' => $_POST['advert'],
			'token' => ((isset($_POST['token'])) ? true : false)
		));
	}
}

if (isset($_POST['delete'])) {
	$dbData = filesys::getSerializedData(adsimple::$dbFile);
	
	foreach ($_POST as $key => $value) {
		if (is_array($value)) {
			$dbData[$key] = array_diff_key($dbData[$key], $value);
		}
	}

	if (filesys::putSerializedData(adsimple::$dbFile, $dbData)) {
		messages::messageChangeSaved(MOD_ADSIMPLE_MESSAGE_CHANGE_SAVED, false, CONF_ADMIN_FILE . '?m=mods&s=adsimple');
	} else {
		$arrErrors[] = MOD_ADSIMPLE_ERROR_CHANGE_NOT_SAVED;
	}
}

$smarty -> assign('advert', filesys::getSerializedData(adsimple::$dbFile));
$smarty -> assign('errors', $arrErrors);

