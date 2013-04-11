<?php
/********************************************************
	JobExpert v1.0
	powered by Script Developers Group (SD-Group)
	email: info@sd-group.org.ua
	url: http://sd-group.org.ua/
	Copyright 2010-2015 (c) SD-Group
	All rights reserved
=========================================================
 Базовый Класс работы с RSS
********************************************************/
/**
* @package
* @todo
*/

(!defined('SDG')) ? die ('Triple protection!') : null;

/**
* Базовый Класс работы с RSS
*/
class brss
{
	/////////////////////////////////////////////////
	// VARS - свойства класса brss
	/////////////////////////////////////////////////
	/**
	* Лого сайта, отображается в RSS ленте
	* 
	* @var array
	*/
	private $siteLogo;

	private $pubDate;
	private $title;
	private $link;
	private $description;
	
	/////////////////////////////////////////////////
	// CONSTRUCTOR - конструктор класса brss
	/////////////////////////////////////////////////
	/**
	* конструктор
	* 
	* Инициирует свойство $siteLogo
	* 
	*/
	protected function __construct()
	{
    	$this -> siteLogo = CONF_SCRIPT_URL . TEMPLATE_PATH . 'images/rss_logo.png';
    	$this -> pubDate = terms::RFCDate();
	}

	/////////////////////////////////////////////////
	// METHODS - методы класса brss
	/////////////////////////////////////////////////

	/**
	* private функция формирует RSS для новостей
	* 
	* @return string
	*/
	protected function rssNews()
	{
		// получаем объект новостей
		global $news;

		// формируем данные шапки
		$this -> title[] = array('name' => MENU_NEWS);
		$this -> link = chpu::createChpuUrl(CONF_SCRIPT_URL . 'index.php?do=rss&amp;action=news');
		$this -> description = MENU_NEWS;

		/***** Формируем XML-документ *****/
		$data = '<?xml version="1.0" encoding="' . CONF_DEFAULT_CHARSET . '" ?>
					<rss version="2.0" xmlns:atom="http://www.w3.org/2005/Atom">
					<channel>
					<atom:link href="' . $this -> link . '" rel="self" type="application/rss+xml" />
					<title>' . strings::formTitle($this -> title) . '</title>
					<link>' . $this -> link . '</link>
					<description>' . $this -> description . '</description>
					<language>ru</language>
					<pubDate>' . $this -> pubDate . '</pubDate>
					<image>
						<url>' . $this -> siteLogo . '</url>
						<title>' . strings::formTitle($this -> title) . '</title>
						<link>' . $this -> link . '</link>
					</image>';

		// выбираем новости, если новости есть
		if ($arrNews = $news -> getPuplishedNewses(false, array('strLimit' => '0,' . CONF_RSS_NEWS_COUNT, 'calcRows' => false), array('id', 'title', 'small_text', 'datetime')))
		{
			foreach ($arrNews as $value)
			{
				$data .= '<item>
							<title>' . $value['title'] . '</title>
							<link>' . chpu::createChpuUrl(CONF_SCRIPT_URL . 'index.php?do=news&amp;action=view&amp;id=' . $value['tId']) . '</link>
							<pubDate>' . terms::RFCDate($value['datetime']) . '</pubDate>
							<guid>' . chpu::createChpuUrl(CONF_SCRIPT_URL . 'index.php?do=news&amp;action=view&amp;id=' . $value['tId']) . '</guid>
							<description><![CDATA[' . $value['small_text'] . ']]></description>
						</item>';
			}
		}

		$data .= '</channel>
					</rss>';

		return $data;
	}

	/**
	* private функция формирует RSS для статей
	* 
	* @param (int) $id - id раздела, статьи которого необходимо показать (по умолчанию false)
	* 
	* @return string
	*/
	protected function rssArticles($id = false)
	{
		// создаем объекты
		$articles = new articles();
		$artsections = new artsections();
		
		// получаем список разделов
		$sections = $artsections -> getSections("token IN ('active')");

		// формируем данные шапки
		$this -> title[] = array('name' => MENU_ARTICLES);
		$this -> link = chpu::createChpuUrl(CONF_SCRIPT_URL . 'index.php?do=rss&amp;action=articles');
		$this -> description = MENU_ARTICLES;

		// проверяем просмотр по разделу
		if (!empty($id) && !empty($sections[$id]))
		{
			// выбираем статьи с учетом раздела
			$arrArticles = $articles -> getPuplishedArticles("id_section=" . secure::escQuoteData($id), false, array('strLimit' => '0,' . CONF_RSS_ARTICLES_COUNT, 'calcRows' => false), array('id', 'title', 'small_text', 'datetime', 'id_section'));
			// Дописываем данные по разделу в шапку
			$this -> title[] = array('name' => $sections[$id]['name']);
			$this -> description .= ' - ' . $sections[$id]['name'];
		}
		// если просмотр не по разделу, выбираем статьи без раздела
		else
		{
			$arrArticles = $articles -> getPuplishedArticles(false, false, array('strLimit' => '0,' . CONF_RSS_ARTICLES_COUNT, 'calcRows' => false), array('id', 'title', 'small_text', 'datetime', 'id_section'));
		}

		/***** Формируем XML-документ *****/
		$data = '<?xml version="1.0" encoding="' . CONF_DEFAULT_CHARSET . '" ?>
					<rss version="2.0" xmlns:atom="http://www.w3.org/2005/Atom">
					<channel>
					<atom:link href="' . $this -> link . '" rel="self" type="application/rss+xml" />
					<title>' . strings::formTitle($this -> title) . '</title>
					<link>' . $this -> link . '</link>
					<description>' . $this -> description . '</description>
					<language>ru</language>
					<pubDate>' . $this -> pubDate . '</pubDate>
					<image>
						<url>' . $this -> siteLogo . '</url>
						<title>' . strings::formTitle($this -> title) . '</title>
						<link>' . $this -> link . '</link>
					</image>';

		// если статьи есть
		if (!empty($arrArticles) && is_array($arrArticles))
		{
			foreach ($arrArticles as $value)
			{
				$data .= '<item>
							<title>' . $value['title'] . '</title>
							<link>' . chpu::createChpuUrl(CONF_SCRIPT_URL . 'index.php?do=articles&amp;action=view&amp;id=' . $value['tId']) . '</link>
							<pubDate>' . terms::RFCDate($value['datetime']) . '</pubDate>
							<guid>' . chpu::createChpuUrl(CONF_SCRIPT_URL . 'index.php?do=articles&amp;action=view&amp;id=' . $value['tId']) . '</guid>
							<category domain="' . chpu::createChpuUrl(CONF_SCRIPT_URL . 'index.php?do=articles&amp;action=section&amp;id=' . $sections[$value['id_section']]['tId']) . '">' . $sections[$value['id_section']]['name'] . '</category>
							<description><![CDATA[' . $value['small_text'] . ']]></description>
						</item>';
			}
		}

		$data .= '</channel>
				</rss>';

		return $data;
	}

	/**
	* private функция формирует RSS для вакансий
	* 
	* @param (string) $type - тип, может быть section или region (по умолчанию false)
	* @param (int) $id - id раздела или региона, вакансии которого необходимо показать (по умолчанию false)
	* 
	* @return string
	*/
	protected function rssVacancy($type = false, $id = false)
	{
		// получаем объект вакансий
		global $vacancy;
		// получаем массив селекта "Раздел"
		global $arrDataSections;
		// получаем массив селекта "Регион"
		global $arrDataRegions;
		$strWhere = false;

		// формируем данные шапки
		$this -> title[] = array('name' => MENU_VACANCYS);
		$this -> link = chpu::createChpuUrl(CONF_SCRIPT_URL . 'index.php?do=rss&amp;action=vacancy');
		$this -> description = MENU_VACANCYS;

		if (!empty($type))
		{
			('section' === $type) ? $arrType =& $arrDataSections : $arrType =& $arrDataRegions;

			// проверяем просмотр по разделу
			if (!empty($id) && !empty($arrType[$id]))
			{
				$strWhere = "id_" . $type . " IN (" . secure::escQuoteData($id) . ")";


				$this -> title[] = array('name' => $arrType[$id]['name']);
				$this -> description .= ' - ' . $arrType[$id]['name'];
			}
		}

		/***** Формируем XML-документ *****/
		$data = '<?xml version="1.0" encoding="' . CONF_DEFAULT_CHARSET . '" ?>
					<rss version="2.0" xmlns:atom="http://www.w3.org/2005/Atom">
					<channel>
					<atom:link href="' . $this -> link . '" rel="self" type="application/rss+xml" />
					<title>' . strings::formTitle($this -> title) . '</title>
					<link>' . $this -> link . '</link>
					<description>' . $this -> description . '</description>
					<language>ru</language>
					<pubDate>' . $this -> pubDate . '</pubDate>
					<image>
						<url>' . $this -> siteLogo . '</url>
						<title>' . strings::formTitle($this -> title) . '</title>
						<link>' . $this -> link . '</link>
					</image>';

		$arrLimit = array('strLimit' => '0,' . CONF_RSS_VACANCY_COUNT, 'calcRows' => false);
		// если есть активные объявления
		if ($arrVacancy = $vacancy -> getActiveAnnounces(array('strLimit' => '0,' . CONF_RSS_VACANCY_COUNT, 'calcRows' => false), $strWhere))
		{
			foreach ($arrVacancy as $value)
			{
				$data .= '<item>
							<title>' . $value['title'] . ' - ' . $value['pay_from'] . '-' . $value['pay_post'] . ' ' . $value['currency'] . ' (' . $arrDataRegions[$value['id_region']]['name'] . ')</title>
							<link>' . chpu::createChpuUrl(CONF_SCRIPT_URL . 'index.php?do=vacancy&amp;action=view&amp;id=' . $value['tId']) . '</link>
							<pubDate>' . terms::RFCDate($value['act_datetime']) . '</pubDate>
							<guid>' . chpu::createChpuUrl(CONF_SCRIPT_URL . 'index.php?do=vacancy&amp;action=view&amp;id=' . $value['tId']) . '</guid>
							<category domain="' . chpu::createChpuUrl(CONF_SCRIPT_URL . 'index.php?do=vacancy&amp;action=section&amp;id=' . $arrDataSections[$value['id_section']]['tId']) . '">' . $arrDataSections[$value['id_section']]['name'] . '</category>
							<category domain="' . chpu::createChpuUrl(CONF_SCRIPT_URL . 'index.php?do=vacancy&amp;action=region&amp;id=' . $arrDataRegions[$value['id_region']]['tId']) . '">' . $arrDataRegions[$value['id_region']]['name'] . '</category>
							<description><![CDATA[' . '<b>' . $arrDataSections[$value['id_section']]['name'] . '</b><br><br>' . nl2br($value['requirements']) . ']]></description>
						</item>';
			}
		}

		$data .= '</channel>
				</rss>';

		return $data;
	}

	/**
	* private функция формирует RSS для резюме
	* 
	* @param (string) $type - тип, может быть section или region (по умолчанию false)
	* @param (int) $id - id раздела или региона, резюме которого необходимо показать (по умолчанию false)
	* 
	* @return string
	*/
	protected function rssResume($type = false, $id = false)
	{
		// получаем объект резюме
		global $resume;
		// получаем массив селекта "Раздел"
		global $arrDataSections;
		// получаем массив селекта "Регион"
		global $arrDataRegions;

		// формируем данные шапки
		$this -> title[] = array('name' => MENU_RESUMES);
		$this -> link = chpu::createChpuUrl(CONF_SCRIPT_URL . 'index.php?do=rss&amp;action=resume');
		$this -> description = MENU_RESUMES;

		// проверяем просмотр по разделу
		if ($type && $id)
		{
			$strWhere = "id_" . $type . " IN (" . secure::escQuoteData($id) . ")";
			$arrType = ($type === 'section') ? $arrType =& $arrDataSections : $arrType =& $arrDataRegions;

			// Дописываем данные по разделу в шапку
			$this -> title[] = array('name' => $arrType[$id]['name']);
			$this -> description .= ' - ' . $arrType[$id]['name'];
		}
		else
		{
			$strWhere = false;
		}

		/***** Формируем XML-документ *****/
		$data = '<?xml version="1.0" encoding="' . CONF_DEFAULT_CHARSET . '" ?>
					<rss version="2.0" xmlns:atom="http://www.w3.org/2005/Atom">
					<channel>
					<atom:link href="' . $this -> link . '" rel="self" type="application/rss+xml" />
					<title>' . strings::formTitle($this -> title) . '</title>
					<link>' . $this -> link . '</link>
					<description>' . $this -> description . '</description>
					<language>ru</language>
					<pubDate>' . $this -> pubDate . '</pubDate>
					<image>
						<url>' . $this -> siteLogo . '</url>
						<title>' . strings::formTitle($this -> title) . '</title>
						<link>' . $this -> link . '</link>
					</image>';

		// если есть активные объявления
		if ($arrResume = $resume -> getActiveAnnounces(array('strLimit' => '0,' . CONF_RSS_RESUME_COUNT, 'calcRows' => false), $strWhere))
		{
			foreach ($arrResume as $value)
			{
				$LFName = ($value['visibility'] !== 'membershc' && $value['visibility'] !== 'visiblehc') ? ANNOUNCE_CONTACTS_LASTNAME . ' ' . ANNOUNCE_CONTACTS_FIRSTNAME . ': ' . $value['last_name'] . ' ' . $value['first_name'] . '<br>' : '';
				
				$data .= '<item>
							<title>' . $value['title'] . ' - ' . $value['pay_from'] . ' ' . $value['currency'] . ' (' . $arrDataRegions[$value['id_region']]['name'] . ')</title>
							<link>' . chpu::createChpuUrl(CONF_SCRIPT_URL . 'index.php?do=resume&amp;action=view&amp;id=' . $value['tId']) . '</link>
							<pubDate>' . terms::RFCDate($value['act_datetime']) . '</pubDate>
							<guid>' . chpu::createChpuUrl(CONF_SCRIPT_URL . 'index.php?do=resume&amp;action=view&amp;id=' . $value['tId']) . '</guid>
							<category domain="' . chpu::createChpuUrl(CONF_SCRIPT_URL . 'index.php?do=resume&amp;action=section&amp;id=' . $arrDataSections[$value['id_section']]['tId']) . '">' . $arrDataSections[$value['id_section']]['name'] . '</category>
							<category domain="' . chpu::createChpuUrl(CONF_SCRIPT_URL . 'index.php?do=resume&amp;action=region&amp;id=' . $arrDataRegions[$value['id_region']]['tId']) . '">' . $arrDataRegions[$value['id_region']]['name'] . '</category>
							<description><![CDATA[' . '<b>' . $arrDataSections[$value['id_section']]['name'] . '</b><br><br>'
															. $LFName
															. ANNOUNCE_AGE . ': ' . $value['age'] . '<br>'
															. ANNOUNCE_SELECT_EXPIREWORK . ': ' . $value['expire_work'] . '<br>'
															. ANNOUNCE_SELECT_EDUCATION . ': ' . $value['education'] . ']]></description>
						</item>';
			}
		}

		$data .= '</channel>
				</rss>';

		return $data;
	}

	/////////////////////////////////////////////////
	// END OF CLASS brss
	/////////////////////////////////////////////////
}
