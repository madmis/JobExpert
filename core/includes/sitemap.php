<?php
/********************************************************
	JobExpert v1.0
	powered by Script Developers Group (SD-Group)
	email: info@sd-group.org.ua
	url: http://sd-group.org.ua/
	Copyright 2010-2015 (c) SD-Group
	All rights reserved
=========================================================
	Карта сайта
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
$arrActions = array(
						'xml'	=> false
                    );


// определяем шаблон для отображения
(isset($_GET['action']) && isset($arrActions[$_GET['action']])) ? $arrActions[$_GET['action']] = true : null;


/**
* XML SiteMap
*/
if ($arrActions['xml'])
{
	header('content-type: text/xml');

	$xml = '<?xml version="1.0" encoding="utf-8"?>' . "\n" . '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";

	// главная страница
	$xml .= '<url><loc>' . chpu::createChpuUrl(CONF_SCRIPT_URL . 'index.php?ut=competitor') . '</loc><priority>1.0</priority><changefreq>weekly</changefreq></url>' . "\n";
	$xml .= '<url><loc>' . chpu::createChpuUrl(CONF_SCRIPT_URL . 'index.php?ut=employer') . '</loc><priority>1.0</priority><changefreq>weekly</changefreq></url>' . "\n";

	// Работаем с доп. страницами
	if ($arrPages)
	{
		foreach ($arrPages as $value)
		{
			$xml .= '<url><loc>' . chpu::createChpuUrl(CONF_SCRIPT_URL . 'index.php?do=pages&amp;action=view&amp;id=' . $value['id']) . '</loc><priority>0.5</priority><changefreq>never</changefreq></url>' . "\n";
		}
	}
	// Работаем с новостями
	if ($arrNewses = $news -> getPuplishedNewses(false, false, array('id', 'title')))
	{
		foreach ($arrNewses as $value)
		{
			$xml .= '<url><loc>' . chpu::createChpuUrl(CONF_SCRIPT_URL . 'index.php?do=news&amp;action=view&amp;id=' . $value['tId']) . '</loc><priority>0.8</priority><changefreq>never</changefreq></url>' . "\n";
		}
	}
	// Работаем с разделами статей (все статьи выводить не будем, много получится)
	$artsections = new artsections();
	if ($arrArtSections = $artsections -> getSections())
	{
		foreach ($arrArtSections as $value)
		{
			if ($value['count'])
			{
				$userType = ($value['affiliation'] !== 'none') ? 'ut=' . $value['affiliation'] . '&nbsp;' : '';
				$xml .= '<url><loc>' . chpu::createChpuUrl(CONF_SCRIPT_URL . 'index.php?' . $userType . 'do=articles&amp;action=section&amp;id=' . $value['tId']) . '</loc><priority>0.8</priority><changefreq>weekly</changefreq></url>' . "\n";
			}
		}
	}
	// Работаем с компаниями
	$strWhere = "conf_users.token IN ('active') AND conf_users.user_type IN ('company')";
	$arrFields = array(array('conf_users', 'id'), array('conf_users', 'company_name'));
	if ($arrCompanies = $user -> getCombinedUsersData($arrFields, $strWhere, false, false))
	{
		foreach ($arrCompanies as $value)
		{
			$xml .= '<url><loc>' . chpu::createChpuUrl(CONF_SCRIPT_URL . 'index.php?do=companies&amp;action=detail&amp;id=' . $value['tId']) . '</loc><priority>0.5</priority><changefreq>daily</changefreq></url>' . "\n";
		}
	}

	// Работаем со списком вакансий
	$xml .= '<url><loc>' . chpu::createChpuUrl(CONF_SCRIPT_URL . 'index.php?ut=competitor&amp;do=vacancy') . '</loc><priority>1.0</priority><changefreq>hourly</changefreq></url>' . "\n";
	// Работаем с вакансиями по городам
	foreach ($arrDataRegions as $value)
	{
		$xml .= '<url><loc>' . chpu::createChpuUrl(CONF_SCRIPT_URL . 'index.php?ut=competitor&amp;do=vacancy&amp;action=regions&amp;id=' . $value['tId']) . '</loc><priority>1.0</priority><changefreq>hourly</changefreq></url>' . "\n";
	}
	// Работаем с вакансиями по разделам
	foreach ($arrDataSections as $value)
	{
		$xml .= '<url><loc>' . chpu::createChpuUrl(CONF_SCRIPT_URL . 'index.php?ut=competitor&amp;do=vacancy&amp;action=sections&amp;id=' . $value['tId']) . '</loc><priority>1.0</priority><changefreq>hourly</changefreq></url>' . "\n";
	}

	// Работаем со списком резюме
	$xml .= '<url><loc>' . chpu::createChpuUrl(CONF_SCRIPT_URL . 'index.php?ut=employer&amp;do=resume') . '</loc><priority>1.0</priority><changefreq>hourly</changefreq></url>' . "\n";
	// Работаем с резюме по городам
	foreach ($arrDataRegions as $value)
	{
		$xml .= '<url><loc>' . chpu::createChpuUrl(CONF_SCRIPT_URL . 'index.php?ut=employer&amp;do=resume&amp;action=regions&amp;id=' . $value['tId']) . '</loc><priority>1.0</priority><changefreq>hourly</changefreq></url>' . "\n";
	}
	// Работаем с резюме по разделам
	foreach ($arrDataSections as $value)
	{
		$xml .= '<url><loc>' . chpu::createChpuUrl(CONF_SCRIPT_URL . 'index.php?ut=employer&amp;do=resume&amp;action=sections&amp;id=' . $value['tId']) . '</loc><priority>1.0</priority><changefreq>hourly</changefreq></url>' . "\n";
	}
	
	$xml .= '</urlset>';

	die($xml);
}
/**
* User SiteMap
*/
else
{

}

$smarty -> assignByRef('errors', $arrErrors);
$smarty -> assignByRef('arrActions', $arrActions);