<?php
/********************************************************
	JobExpert v1.0
	powered by Script Developers Group (SD-Group)
	email: info@sd-group.org.ua
	url: http://sd-group.org.ua/
	Copyright 2010-2015 (c) SD-Group
	All rights reserved
=========================================================
	Админ-панель: управление объявлениями - Резюме
********************************************************/
/**
* @package
* @todo
*/

(!defined('SDG')) ? die('Triple protection!') : null;

/**
* иницализация массива подключаемых шаблонов: по умолчанию все значения - false
* для подключения шаблона, необходимо установить значение - true
* шаблоны подключаются в порядке установленном в файле головного шаблона
*/
$arrActions = array(
						'moderate'		=> false,
						'payment'		=> false,
						'new'			=> false,
						'correction'	=> false,
						'template'		=> false,
						'archived'		=> false
				   );

// инициируем "Наименование страницы" отображаемое в форме
$arrNamePage = array(
						array('name' => MENU_ADMIN_MAIN, 'link' => CONF_ADMIN_FILE),
						array('name' => MENU_ANNOUNCES, 'link' => false),
					);

/**
* создаем необходимые объекты
*/
$resume = new resume(); // резюме

$sections = new sections(); // разделы
$smarty -> assign('sections', $sections -> retCategorys());

$professions = new professions(); // профессии

$regions = new regions(); // регионы
$smarty -> assign('regions', $regions -> retCategorys());

$citys = new citys(); // города

$selects = new selects(); // словарь - "Списки"

$dictGender = $selects -> retDictByAlias('SysDict', 'Gender'); // список - "Половая принадлежность"
$smarty -> assignByRef('gender', $dictGender['values']);

$dictActPeriod = $selects -> retDictByAlias('SysDict', 'ActPeriod'); // список - "Срок хранения"
$smarty -> assignByRef('act_period', $dictActPeriod['values']);

/**
* Объявления ожидающие модерации, ожидающие оплату, ожидающие активации, ожидающие исправления
*/
if (isset($_GET['action']) && !empty($_GET['action']) && isset($arrActions[$_GET['action']]))
{
	// инициируем вызываемый шаблон
	$arrActions[$_GET['action']] = true;

	/**
	* действия с объявлениями
	*/
	(isset($_POST['arrResData']['action'])) ? ((!$resume -> actionAnnounces($_POST['arrResData'])) ? messages::messageChangeSaved(ERROR_NOT_SAVE_CHANGE, false, CONF_ADMIN_FILE . '?m=announces&amp;s=resumes&amp;action=' . $_GET['action']) : messages::messageChangeSaved(MESSAGE_CHANGE_SAVED, false, CONF_ADMIN_FILE . '?m=announces&amp;s=resumes&amp;action=' . $_GET['action'])) : null;

	// инициируем "Наименование страницы" отображаемое в форме
	$arrNamePage[] = array('name' => MENU_ANNOUNCES_RESUMES, 'link' => CONF_ADMIN_FILE . '?m=announces&amp;s=resumes');
	$arrNamePage[] = array('name' => constant('MENU_ACTION_' . strtoupper($_GET['action'])), 'link' => false);

	/**
	* передаем данные в шаблон
	*/
	$smarty -> assign('professions', $professions -> retCategorys());
	$smarty -> assign('citys', $citys -> retCategorys());

	/**
	* Проверяем сортировку
	*/
	$arrOrderBy = array('title' => false, 'token_datetime' => false);
	if (isset($_GET['order']) && isset($_GET['by']) && ('title' === $_GET['order'] || 'token_datetime' === $_GET['order']) && ('ASC' === $_GET['by'] || 'DESC' === $_GET['by']))
	{
		$order = $_GET['order'];
		$by = $_GET['by'];
		$strOrderBy = '&amp;order=' . $order . '&amp;by=' . $by;
	}
	else
	{
		$order = 'token_datetime';
		$by = 'ASC';
		$strOrderBy = '';
	}
	$arrOrderBy[$order] = $by;
	$smarty -> assignByRef('order', $arrOrderBy);

	/**
	* Формируем страницы и передаем полученные данные в шаблон
	*/
	$offset = isset($_GET['offset']) ? (int) abs($_GET['offset']) : 0; //смещение, всегда 0 (затем берется из $_GET)

	$arrLimit = array('strLimit' => $offset . ',' . CONF_ANNOUNCE_PERPAGE_ADMIN_PANEL, 'calcRows' => true);

	$smarty -> assign('return_data', $resume -> getAnnouncesByToken($_GET['action'], false, $arrLimit, array($order => $by)));

	$allRecords = $resume -> cntAnnounces(); // получаем общее количество объявлений
	$smarty -> assignByRef('allRecords', $allRecords);

	$smarty->assign('strPages', strings::generatePage($allRecords, $offset, CONF_ANNOUNCE_PERPAGE_ADMIN_PANEL, CONF_ADMIN_FILE . '?m=announces&amp;s=resumes&amp;action=' . $_GET['action'] . $strOrderBy . '&amp;', true));
}
else
{
	/**
	* действия с объявлениями
	*/
	(isset($_POST['arrResData']['action'])) ? (!$resume -> actionAnnounces($_POST['arrResData'])) ? messages::messageChangeSaved(ERROR_NOT_SAVE_CHANGE, false, CONF_ADMIN_FILE . '?m=announces&amp;s=resumes') : messages::messageChangeSaved(MESSAGE_CHANGE_SAVED, false, CONF_ADMIN_FILE . '?m=announces&amp;s=resumes') : null;

	// инициируем "Наименование страницы" отображаемое в форме
	$arrNamePage[] = array('name' => MENU_ANNOUNCES_RESUMES, 'link' => false);

	/**
	* передаем данные в шаблон
	*/
	$smarty -> assign('professions', $professions -> retCategorys());
	$smarty -> assign('citys', $citys -> retCategorys());

	/**
	* Проверяем фильтр
	*/
	if (isset($_GET['filter']) && ('company_name' === $_GET['filter'] || 'email' === $_GET['filter'] || 'user_type' === $_GET['filter'] || 'id_region' === $_GET['filter'] || 'id_city' === $_GET['filter'] || 'id_section' === $_GET['filter'] || 'id_profession,id_profession_1,id_profession_2' === $_GET['filter']) && isset($_GET['in']) && !empty($_GET['in']))
	{
		$tmpWhere = explode(',', $_GET['filter']);
		foreach($tmpWhere as $field)
		{
			$arrWhere[] = $field . " IN (" . secure::escQuoteData($_GET['in']) . ")";
			$arrFilter[] = $field;
		}

		$strWhere = "(" . implode(' OR ', $arrWhere) . ")";
	}
	else
	{
		$strWhere = false;
	}

	/**
	* Проверяем сортировку
	*/
	$arrOrderBy = array();
	(isset($_GET['order']) && ('act_datetime' === $_GET['order'] || 'token_datetime' === $_GET['order']) && isset($_GET['by']) && ('ASC' === $_GET['by'] || 'DESC' === $_GET['by'])) ? $arrOrderBy[$_GET['order']] = $_GET['by'] : $arrOrderBy = false;

	/**
	* Формируем страницы и передаем полученные данные в шаблон
	*/
	$offset = isset($_GET['offset']) ? (int) abs($_GET['offset']) : 0; //смещение, всегда 0 (затем берется из $_GET)

	$arrLimit = array('strLimit' => $offset . ',' . CONF_ANNOUNCE_PERPAGE_ADMIN_PANEL, 'calcRows' => true);

	$smarty -> assign('return_data', $resume -> getAnnouncesByToken('active', $strWhere, $arrLimit, $arrOrderBy));

	$allRecords = $resume -> cntAnnounces(); // получаем общее количество объявлений
	$smarty -> assignByRef('allRecords', $allRecords);

	$strFilter = (!empty($strWhere)) ? '&amp;filter=' . $_GET['filter'] . '&amp;in=' . $_GET['in'] : '';
	$smarty -> assignByRef('strFilter', $strFilter);

	$arrFilter = (!empty($strWhere)) ? array('filter' => $arrFilter, 'in' => $_GET['in']) : false;
	$smarty -> assignByRef('arrFilter', $arrFilter);

	$strSort = (!empty($arrOrderBy)) ? '&amp;order=' . $_GET['order'] . '&amp;by=' . $_GET['by'] : '';
	$smarty -> assignByRef('strSort', $strSort);

	$arrSort = (!empty($arrOrderBy)) ? array('order' => $_GET['order'], 'by' => $_GET['by']) : false;
	$smarty -> assignByRef('arrSort', $arrSort);

	$smarty->assign('strPages', strings::generatePage($allRecords, $offset, CONF_ANNOUNCE_PERPAGE_ADMIN_PANEL, CONF_ADMIN_FILE . '?m=announces&amp;s=resumes' . $strFilter . $strSort . '&amp;', true));

	/**
	* формируем массив для свойства "Тип размещения"
	*/
	$arrVisibility = array(
		'visible' => ANNOUNCE_VISIBILITY_VISIBLE,
		'visiblehc' => ANNOUNCE_VISIBILITY_VISIBLEHC,
		'members' => ANNOUNCE_VISIBILITY_MEMBERS,
		'membershc' => ANNOUNCE_VISIBILITY_MEMBERSHC,
		'hide' => ANNOUNCE_VISIBILITY_HIDE
	);
	$smarty -> assignByRef('arrVisibility', $arrVisibility);
}

$smarty -> assignByRef('errors', $arrErrors);
$smarty -> assignByRef('action', $arrActions);
$smarty -> assignByRef('payments', $arrPayments);
