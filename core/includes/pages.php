<?php
/********************************************************
	JobExpert v1.0
	powered by Script Developers Group (SD-Group)
	email: info@sd-group.org.ua
	url: http://sd-group.org.ua/
	Copyright 2010-2015 (c) SD-Group
	All rights reserved
=========================================================
	Дополнительные страницы
********************************************************/
/**
* @package
* @todo
*/

(!defined('SDG')) ? die ('Triple protection!') : null;

if (!empty($_GET['action']) && 'view' === $_GET['action'] && !empty($_GET['id']))
{
	$strWhere = "id IN (" . secure::escQuoteData($_GET['id']) . ") AND token IN ('active')";
	$fields = array('title', 'text', 'meta_keywords', 'meta_description');

	if ($arrData = $pages -> getPage($strWhere, $fields))
	{
		$arrNamePage[] = array('name' => $arrData['title'], 'link' => false);

		$smarty -> assignByRef('menu', $_GET['id']); // выбранный пункт меню

		// HEAD страницы
		$smarty -> assignByRef('meta_keywords', $arrData['meta_keywords']);
		$smarty -> assignByRef('meta_description', $arrData['meta_description']);

		$smarty -> assignByRef('arrPage', $arrData); // параметры выбранной страницы
	}
	else
	{
		messages::error404();
	}
}
else
{
	messages::error404();
}
