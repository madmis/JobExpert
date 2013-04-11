<?php

/* * ******************************************************
  JobExpert v1.0
  powered by Script Developers Group (SD-Group)
  email: info@sd-group.org.ua
  url: http://sd-group.org.ua/
  Copyright 2010-2015 (c) SD-Group
  All rights reserved
  =========================================================
  Инсталлятор - Шаг 2 - Создание таблиц БД
 * ****************************************************** */
/**
 * @package
 * @todo
 */
(!defined('SDG')) ? die('Triple protection!') : null;

if (empty($_SESSION['sdinstall']['step1'])) {
	// пересылаем пользователя на первый шаг
	die('<script type="text/javascript">window.location="install.php?step=1";</script>');
} else {
	if (isset($_POST['step2'])) {
		// записываем в сессию второй шаг
		$_SESSION['sdinstall']['step2'] = true;
		die('<script type="text/javascript">window.location="install.php?step=3";</script>');
	}

	include_once 'core/conf/const.config.db.php';

	if (!$dbId = @mysql_connect(DB_HOST, DB_USER, DB_PASS)) {
		exit(mysql_error());
	} elseif (!@mysql_select_db(DB_NAME, $dbId)) {
		exit(mysql_error());
	} elseif (!@mysql_query("/*!40101 SET NAMES '" . DB_CHARSET . "'*/")) {
		exit(mysql_error());
	}

	//-----------------------------------------------------------------
	//----------------------- CREATE TABLES ---------------------------
	//-----------------------------------------------------------------
	// получаем данные из файла
	$fileContent = @file_get_contents('install/sql/expert.sql');
	// убираем все лишнее
	preg_match_all('/create(.*?);/si', $fileContent, $sqlDump);

	$arrTable = array();
	foreach ($sqlDump[0] as $sqlTable) {
		// массивы для замены
		$patterns = array("/%DB_PREFIX%/", "/%USR_PREFIX%/", "/%DB_CHARSET%/");
		$replacements = array(DB_PREFIX, USR_PREFIX, DB_CHARSET);

		// производим замену
		$res = preg_replace($patterns, $replacements, $sqlTable);
		preg_match("/CREATE TABLE\s(.*?)\s\(/si", $res, $match);

		// удаляем таблицу, если она уже есть
		mysql_query('DROP TABLE IF EXISTS ' . $match[1] . ';');
		$arrTable[] = array(
			'table' => $match[1],
			'error' => ((!mysql_query($res)) ? mysql_error() : false)
		);
	}

	$smarty->assignByRef('arrTable', $arrTable);
	//-----------------------------------------------------------------
	//-----------------------------------------------------------------
	//-------------------- ADDING MANDATORY DATA ----------------------
	//-----------------------------------------------------------------
	// получаем данные из файла
	$fileContent = @file_get_contents('install/sql/expert_data.sql');
	// убираем все лишнее
	preg_match_all('/INSERT INTO(.*?);;;/si', $fileContent, $sqlDump);

	$arrData = array();
	foreach ($sqlDump[0] as $sqlData) {
		// производим замену
		$res = preg_replace('/%DB_PREFIX%/', DB_PREFIX, $sqlData);

		preg_match("/INSERT INTO\s(.*?)\s\(/si", $res, $match);

		$arrData[] = array(
			'table' => $match[1],
			'error' => ((!mysql_query($res)) ? mysql_error() : false)
		);
	}

	$smarty->assignByRef('arrData', $arrData);
	//-----------------------------------------------------------------

	$arrDemo = array();
	$arrTables = array();
	$sqlLocales = array();
	
	// Получаем список файлов с доп. данными
	$objs = @glob('install/sql/demo_data_*.sql');
	if ($objs && is_array($objs)) {
		foreach ($objs as $value) {
			$f = pathinfo($value);
			$r = explode('_', $f['filename']);
			$l = array_pop($r);
			(!empty($l)) ? $sqlLocales[] = $l : null;
		}
	}

	if (!empty($_GET['demo']) && 'add' === $_GET['demo']) {
		//-----------------------------------------------------------------
		//----------------------- ADDING DEMO DATA ------------------------
		//-----------------------------------------------------------------
		$file = !empty($_GET['lc']) ? 'install/sql/demo_data_' . $_GET['lc'] . '.sql' : 'install/sql/demo_data_ukrainian.sql';

		if (file_exists($file)) {
			$trnTables = array(DB_PREFIX . 'profession', DB_PREFIX . 'section', USR_PREFIX . 'city', USR_PREFIX . 'region');

			//Очищаем таблицы
			foreach ($trnTables as $value) {
				if (!$res = mysql_query('SELECT COUNT(*) FROM ' . $value)) {
					exit(mysql_error());
				}
				$row = mysql_fetch_assoc($res);
				if ($row > 0) {
					(!mysql_query('TRUNCATE TABLE ' . $value)) ? $arrTables[] = $value : null;
				}
			}

			if (empty($arrTables)) {
				// получаем данные из файла
				$fileContent = @file_get_contents($file);
				// убираем все лишнее
				preg_match_all('/INSERT(.*?);;;/si', $fileContent, $sqlDump);
				
				foreach ($sqlDump[0] as $sqlDemo) {
					// массивы для замены
					$patterns = array('/%DB_PREFIX%/', '/%USR_PREFIX%/');
					$replacements = array(DB_PREFIX, USR_PREFIX);

					// производим замену
					$res = preg_replace($patterns, $replacements, $sqlDemo);
					preg_match("/INSERT INTO\s(.*?)\s\(/si", $res, $match);
					
					
					$arrDemo[] = array(
						'table' => $match[1],
						'error' => ((!mysql_query($res)) ? mysql_error() : false)
					);
				}
			}
		}
		//-----------------------------------------------------------------
	}
	/* @var $smarty Smarty */
	$smarty->assignByRef('sqlLocales', $sqlLocales);
	$smarty->assignByRef('arrTables', $arrTables);
	$smarty->assignByRef('arrDemo', $arrDemo);
}