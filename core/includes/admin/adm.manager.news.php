<?php
/********************************************************
	JobExpert v1.0
	powered by Script Developers Group (SD-Group)
	email: info@sd-group.org.ua
	url: http://sd-group.org.ua/
	Copyright 2010-2015 (c) SD-Group
	All rights reserved
=========================================================
	Менеджер - Новости
********************************************************/
/**
* @package
* @todo
*/

(!defined('SDG')) ? die ('Triple protection!') : null;

// инициируем "Наименование страницы" отображаемое в форме
$arrNamePage = array(
	array('name' => MENU_ADMIN_MAIN, 'link' => CONF_ADMIN_FILE),
	array('name' => MENU_MANAGER, 'link' => false),
	array('name' => MENU_MANAGER_NEWS, 'link' => CONF_ADMIN_FILE . '?m=manager&amp;s=news'),
);

/**
* иницализация массива подключаемых шаблонов: по умолчанию все значения - false
* для подключения шаблона, необходимо установить значение - true
* шаблоны подключаются в порядке установленном в файле головного шаблона
*/
$arrActions = array(
	'config'		=> false,
	'add'			=> false,
	'edit'			=> false,
	'moderate'		=> false,
	'archived'		=> false,
	'correction'	=> false,
	'comments'		=> false,
);

// определяем шаблон для отображения
(isset($_GET['action']) && isset($arrActions[$_GET['action']])) ? $arrActions[$_GET['action']] = true : null;

$news = new news(); // класс Новостей

/**
* массив, который возращается в форму
* содержит значения по умолчанию для формы отбора
*/
$retFields = array(
	'id'			=> false, // id статьи (статей)
	'id_user'		=> false, // id пользователя (пользователей)
	'author'		=> false, // автор статьи (авторы)
	'title'			=> false, // заголовок статьи (маска)
	'sDate'			=> false, // начальная дата по умолчанию
	'eDate'			=> false, // конечная дата по умолчанию
	'records'		=> 30 // количество записей на странице по умолчанию
);

// Строка запроса из адресной строки браузера
$qString = !empty($_SERVER['QUERY_STRING']) ? $_SERVER['QUERY_STRING'] : 'm=manager&s=news';

/**
* Настройки новостей
*/
if ($arrActions['config']) {
	// инициируем "Наименование страницы" отображаемое в форме
	$arrNamePage[] = array('name' => MENU_CONFIG, 'link' => false);

	// сохраняем данные, переданные из формы
	if (isset($_POST['save'])) {
		$perpage = (!empty($_POST['news_perpage']) && validate::checkNaturalNumber($_POST['news_perpage'])) ? validate::checkNaturalNumber($_POST['news_perpage']) : 30;
		$newsesLastShow = (!empty($_POST['newses_last_show'])) ? 1 : 0;
		$newsesLastShowPerPage = (!empty($_POST['newses_last_show_perpage']) && validate::checkNaturalNumber($_POST['newses_last_show_perpage'])) ? validate::checkNaturalNumber($_POST['newses_last_show_perpage']) : 5;
		$correctionTerm = (isset($_POST['correctionTerm']) && validate::checkNaturalNumber($_POST['correctionTerm'])) ? validate::checkNaturalNumber($_POST['correctionTerm']) : 72;
		$newsesComments = (!empty($_POST['newses_comments'])) ? 1 : 0;
		$newsesCommentsRegister = (!empty($_POST['newses_comments_register'])) ? 1 : 0;
		$commentsNameUnregister = (!empty($_POST['name_unregister'])) ? htmlspecialchars($_POST['name_unregister'], ENT_QUOTES, CONF_DEFAULT_CHARSET) : 'Guest';
		$titleNewsName = (!empty($_POST['titleNewsName'])) ? 1 : 0;

		$data = "<?php\n\n"
			  . "(!defined('SDG')) ? die ('Triple protection!') : null;\n\n"
			  . 'define("CONF_NEWS_PERPAGE", "' . $perpage . '");' . "\n\n"
		  	  . 'define("CONF_NEWSES_LAST_SHOW", "' . $newsesLastShow . '");' . "\n\n"
		  	  . 'define("CONF_NEWSES_LAST_SHOW_PERPAGE", "' . $newsesLastShowPerPage . '");' . "\n\n"
			  . 'define("CONF_NEWSES_CORRECTION_THERM", "' . $correctionTerm . '");' . "\n\n"
			  . 'define("CONF_NEWSES_COMMENTS", ' . $newsesComments . ');' . "\n\n"
			  . 'define("CONF_NEWSES_COMMENTS_REGISTER", ' . $newsesCommentsRegister . ');' . "\n\n"
			  . 'define("CONF_NEWSES_COMMENTS_NAME_UNREGISTER", "' . $commentsNameUnregister . '");' . "\n\n"
			  . 'define("CONF_NEWSES_DISPLAY_ON_TITLE_ONLY_NEWS_NAME", ' . $titleNewsName . ');' . "\n";

		// чистим кеш
		caching::clearCache('newses.last');
		// сохраняем изменения
		if (!tools::saveConfig('core/conf/const.config.news.php', $data, CONF_ADMIN_FILE . '?' . $qString)) {
			$arrErrors[] = ERROR_FILES_MISSING_FILE;
		}
	}
}
/**
* добавление новости
*/
elseif ($arrActions['add'])
{
	// инициируем "Наименование страницы" отображаемое в форме
	$arrNamePage[] = array('name' => MENU_MANAGER_NEWS_ADD, 'link' => false);

	if (isset($_POST['save'])) // добавление новости
	{
		// получаем из формы поля обязательные для заполнения
		$arrBindFields = $_POST['arrBindFields'];
		$arrBindFields['author'] = 'Administrator';
		// получаем из формы поля не обязательные для заполнения
		$arrNoBindFields = $_POST['arrNoBindFields'];
		$arrNoBindFields['noComments'] = (!empty($_POST['arrNoBindFields']['noComments'])) ? 1 : 0;

		// устанавливаем состояние новости
		$arrBindFields['token'] = isset($arrBindFields['token']) ? 'active' : 'archived';
		// устанавливаем дату новости
		$arrBindFields['datetime'] = (!$_POST['date']) ? terms::currentDateTime() : $_POST['date'] . ' ' . $_POST['time']['Time_Hour'] . ':' . $_POST['time']['Time_Minute'];

		///////////////////////////////////////////////////////////////
		// Проверка данных, полученных из формы 
		///////////////////////////////////////////////////////////////
		(!$arrBindFields['title']) ? $arrErrors[] = ERROR_EMPTY_TITLE : null;

		(!$arrBindFields['small_text']) ? $arrErrors[] = ERROR_EMPTY_SMALL_TEXT : null;

		(!$arrBindFields['text']) ? $arrErrors[] = ERROR_EMPTY_TEXT : null;
		///////////////////////////////////////////////////////////////
		///////////////////////////////////////////////////////////////

		if (!$arrErrors)
		{
			// присваеваем полученные данные объекту
			$news -> arrBindFields = $arrBindFields;
			$news -> arrNoBindFields = $arrNoBindFields;

			// производим запись в таблицу БД
			(!$news -> recNews()) ? $arrErrors[] = (db::$message_error ? db::$message_error : ERROR_MISMATCH_FIELDS) : messages::messageChangeSaved(MESSAGE_NEWS_ADDED, false, CONF_ADMIN_FILE . '?m=manager&s=news');
		}
		else
		{
			$smarty -> assign('retFields', $arrBindFields + $arrNoBindFields);
		}
	}
}
/**
* редактирование новости
*/
elseif ($arrActions['edit'])
{
	if (!empty($_GET['id']) && $id = validate::checkNaturalNumber($_GET['id']))
	{
		// инициируем "Наименование страницы" отображаемое в форме
		$arrNamePage[] = array('name' => MENU_MANAGER_NEWS_EDIT, 'link' => false);

		// проверяем существование новости
		if ($arrNews = $news -> getNews("token IN ('active','archived') AND id IN (" . secure::escQuoteData($id) . ")"))
		{
			$smarty -> assignByRef('retFields', $arrNews); // передаем новость в шаблон
			
			// сохраняем изменения
			if (isset($_POST['save']))
			{
				// получаем из формы поля обязательные для заполнения
				$arrBindFields = $_POST['arrBindFields'];
				// получаем из формы поля не обязательные для заполнения
				$arrNoBindFields = $_POST['arrNoBindFields'];
				$arrNoBindFields['noComments'] = (!empty($_POST['arrNoBindFields']['noComments'])) ? 1 : 0;

				// устанавливаем состояние новости
				$arrBindFields['token'] = isset($arrBindFields['token']) ? 'active' : 'archived';
				// устанавливаем дату новости
				$arrBindFields['datetime'] = (!$_POST['date']) ? terms::currentDateTime() : $_POST['date'] . ' ' . $_POST['time']['Time_Hour'] . ':' . $_POST['time']['Time_Minute'];

				///////////////////////////////////////////////////////////////
				// Проверка данных, полученных из формы 
				///////////////////////////////////////////////////////////////
				(!$arrBindFields['title']) ? $arrErrors[] = ERROR_EMPTY_TITLE : null;

				(!$arrBindFields['small_text']) ? $arrErrors[] = ERROR_EMPTY_SMALL_TEXT : null;

				(!$arrBindFields['text']) ? $arrErrors[] = ERROR_EMPTY_TEXT : null;
				///////////////////////////////////////////////////////////////
				///////////////////////////////////////////////////////////////

				if (!$arrErrors)
				{
					// присваеваем полученные данные объекту
					$news -> arrBindFields = $arrBindFields;
					$news -> arrNoBindFields = $arrNoBindFields;

					$redirect = ('archived' === $arrBindFields['token']) ? '&action=archived' : null;
					// производим запись в таблицу БД
					(!$news -> updateNews($arrBindFields + $arrNoBindFields, array($arrNews['id']))) ? $arrErrors[] = (db::$message_error ? db::$message_error : ERROR_MISMATCH_FIELDS) : messages::messageChangeSaved(MESSAGE_CHANGE_SAVED, false, CONF_ADMIN_FILE . '?m=manager&s=news' . $redirect);
				}
				else
				{
					$smarty -> assign('retFields', $arrBindFields + $arrNoBindFields);
				}
			}
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
}

/**
* новости на модерации
*/
elseif ($arrActions['moderate'])
{
	// инициируем "Наименование страницы" отображаемое в форме
	$arrNamePage[] = array('name' => MENU_ACTION_MODERATE, 'link' => false);

	/**
	* Массовая активация, отправка на редактирование, удаление
	*/
	if (isset($_POST['action']) && !empty($_POST['news']))
	{
		if (('active' === $_POST['action']))
		{
			(!$news -> updateNews(array('token' => 'active'), array_keys($_POST['news']))) ? $arrErrors[] = db::$message_error : messages::messageChangeSaved(MESSAGE_CHANGE_SAVED, false, CONF_ADMIN_FILE . '?' . $qString);
		}
		elseif (('correction' === $_POST['action']))
		{
			$updData = array(
						'token'				=> 'correction',
						'token_datetime'	=> terms::calcDateTimeOfTerm(CONF_NEWSES_CORRECTION_THERM),
					);
			(!$news -> updateNews($updData, array_keys($_POST['news']))) ? $arrErrors[] = db::$message_error : messages::messageChangeSaved(MESSAGE_CHANGE_SAVED, false, CONF_ADMIN_FILE . '?' . $qString);
		}
		elseif (('deleted' === $_POST['action']))
		{
			(!$news -> deleteNews(array_keys($_POST['news']))) ? $arrErrors[] = db::$message_error : messages::messageChangeSaved(MESSAGE_CHANGE_SAVED, false, CONF_ADMIN_FILE . '?' . $qString);
		}
	}
	/** Единичная активация, отправка на редактирование, удаление статей **/
	elseif (!empty($_POST['arrData']['action']) && !empty($_POST['arrData']['id']) && !empty($_POST['arrData']['title']) && !empty($_POST['arrData']['id_user']))
	{
		 if ('active' === $_POST['arrData']['action'] && !empty($_POST['arrData']['datetime']))
		 {
		 	if ($news -> updateNews(array('token' => 'active', 'token_datetime' => ''), array($_POST['arrData']['id'])))
		 	{
		 		  $news -> sendUserActiveNews($_POST['arrData']);
		 		  messages::messageChangeSaved(MESSAGE_CHANGE_SAVED, false, CONF_ADMIN_FILE . '?' . $qString);
			}
			else
			{
				$arrErrors[] = db::$message_error;
			}
		 }
		 elseif ('correction' === $_POST['arrData']['action'] && !empty($_POST['arrData']['comments']) && !empty($_POST['arrData']['datetime']))
		 {
			 // данные для обновления в таблице
			 $updData = array(
						'comments'			=> $_POST['arrData']['comments'],
						'token'				=> 'correction',
						'token_datetime'	=> terms::calcDateTimeOfTerm(CONF_NEWSES_CORRECTION_THERM),
					);
		 	if ($news -> updateNews($updData, array($_POST['arrData']['id'])))
		 	{
		 		  $news -> sendUserCorrectionNews($_POST['arrData']);
		 		  messages::messageChangeSaved(MESSAGE_CHANGE_SAVED, false, CONF_ADMIN_FILE . '?' . $qString);
			}
			else
			{
				$arrErrors[] = db::$message_error;
			}
		 }
		 elseif ('deleted' === $_POST['arrData']['action'] && !empty($_POST['arrData']['comments']))
		 {
		 	if ($news -> deleteNews(array($_POST['arrData']['id'])))
		 	{
		 		  $news -> sendUserDeletedNews($_POST['arrData']);
		 		  messages::messageChangeSaved(MESSAGE_CHANGE_SAVED, false, CONF_ADMIN_FILE . '?' . $qString);
			}
			else
			{
				$arrErrors[] = db::$message_error;
			}
		 }
	}

	//смещение, всегда 0 (затем берется из $_GET)
	$offset = (!empty($_GET['offset']) && validate::checkNaturalNumber($_GET['offset'])) ? validate::checkNaturalNumber($_GET['offset']) : 0;
	$path = CONF_ADMIN_FILE . '?m=manager&amp;s=news&amp;action=moderate&amp;'; //текущий обработанный URL

	$strWhere = "token IN ('moderate')";
	$strLimit = array('strLimit' => $offset . ',' . $retFields['records'], 'calcRows' => true);
	$arrFields = array('id', 'title', 'id_user', 'author', 'comments', 'datetime');

	// массив всех
	$arrNewses = $news -> getNewses($strWhere, false, $strLimit, $arrFields);

	// формируем страницы
	$allRecords = $news -> cntNews(); // получаем общее количество
	$strPages = strings::generatePage($allRecords, $offset, $retFields['records'], $path, true); // формируем странциы

	$smarty -> assignByRef('arrNewses', $arrNewses);
	//передаем в шаблон общее количество записей
	$smarty -> assignByRef('allRecords', $allRecords);
	//передаем в шаблон строку сформированных страниц
	$smarty -> assignByRef('strPages', $strPages);
}
/**
* В архиве
*/
elseif ($arrActions['archived'])
{
	// инициируем "Наименование страницы" отображаемое в форме
	$arrNamePage[] = array('name' => MENU_ACTION_ARCHIVED, 'link' => false);

	/** извлечение из архива и удаление **/
	if (isset($_POST['action']) && !empty($_POST['news']))
	{
		if (('active' === $_POST['action']))
		{
			(!$news -> updateNews(array('token' => 'active'), array_keys($_POST['news']))) ? $arrErrors[] = db::$message_error : messages::messageChangeSaved(MESSAGE_CHANGE_SAVED, false, CONF_ADMIN_FILE . '?' . $qString);
		}
		elseif (('deleted' === $_POST['action']))
		{
			(!$news -> deleteNews(array_keys($_POST['news']))) ? $arrErrors[] = db::$message_error : messages::messageChangeSaved(MESSAGE_CHANGE_SAVED, false, CONF_ADMIN_FILE . '?' . $qString);
		}
	}
	/** END извлечение из архива и удаление **/
	
	/** строка запроса по умолчанию **/
	$strWhere = "token IN ('archived')";
	/** текущий обработанный URL **/
	$path = CONF_ADMIN_FILE . '?m=manager&amp;s=news&amp;action=archived&amp;';

	/** отбор записей **/
	if (!empty($_GET['do']) && 'filter' === $_GET['do'])
	{
		$retFields = array(
				'id'			=> !empty($_GET['id']) ? $_GET['id'] : false,
				'id_user'		=> (isset($_GET['id_user'])) ? $_GET['id_user'] : false,
				'author'		=> !empty($_GET['author']) ? $_GET['author'] : false,
				'title'			=> !empty($_GET['title']) ? $_GET['title'] : false,
				'sDate'			=> (!empty($_GET['sDate'])) ? $_GET['sDate'] : false,
				'eDate'			=> (!empty($_GET['eDate'])) ? $_GET['eDate'] : false,
				'records'		=> ((!empty($_GET['records']) && validate::checkNaturalNumber($_GET['records'])) ? validate::checkNaturalNumber($_GET['records']) : 30),
			);

		///////////////////////////////////////////////////////////////
		// Проверка данных, полученных из формы и формирование запроса
		///////////////////////////////////////////////////////////////
		/** ID новостей **/
		if (!empty($retFields['id']))
		{
			// проверяем, в каком виде передан массив Id
			if (stripos($retFields['id'], ',')) // поиск по нескольким ID (разделитель - запятая ',')
			{
				// формируем массив, с ID
				$arrID = array_filter(explode(',', $retFields['id']), 'strings::ifInt');
				$strWhere .= " AND id IN (" . implode(',', secure::escQuoteData($arrID)) . ")";
			}
			// поиск по диапазону ID (разделитель - тире '-')
			elseif (stripos($retFields['id'], '-'))
			{
				// формируем массив, с диапазоном ID
				$arrID = array_filter(explode('-', $retFields['id']), 'strings::ifInt');
				(!empty($arrID[0]) && !empty($arrID[1])) ? $strWhere  .= " AND id>=" . secure::escQuoteData(validate::checkNaturalNumber($arrID[0])) . " AND id<=" . secure::escQuoteData(validate::checkNaturalNumber($arrID[1])) : null;
			}
			elseif ((int) $retFields['id']) // поиск по ID
			{
				$strWhere .= " AND id IN (" . secure::escQuoteData(validate::checkNaturalNumber($retFields['id'])) . ")";
			}
		}

		/** ID пользователей **/
		if (isset($retFields['id_user']))
		{
			// проверяем, в каком виде передан массив Id-пользователя
			if (stripos($retFields['id_user'], ',')) // поиск пользователей по нескольким ID (разделитель - запятая ',')
			{
				// формируем массив, с ID пользователей
				$arrID = array_filter(explode(',', $retFields['id_user']), 'strings::ifInt');
				$strWhere .= " AND id_user IN (" . implode(',', secure::escQuoteData($arrID)) . ")";
			}
			// поиск пользователей по диапазону ID (разделитель - тире '-')
			elseif (stripos($retFields['id_user'], '-'))
			{
				// формируем массив, с диапазоном ID пользователей
				$arrID = array_filter(explode('-', $retFields['id_user']), 'strings::ifInt');
				(!empty($arrID[0]) && !empty($arrID[1])) ? $strWhere .= " AND id_user>=" . secure::escQuoteData(validate::checkNaturalNumber($arrID[0])) . " AND id_user<=" . secure::escQuoteData(validate::checkNaturalNumber($arrID[1])) : null;
			}
			elseif ((int) $retFields['id_user']) // поиск пользователей по ID
			{
				$strWhere .= " AND id_user IN (" . secure::escQuoteData(validate::checkNaturalNumber($retFields['id_user'])) . ")";
			}
			elseif (0 == $retFields['id_user']) // поиск пользователей по ID - сделано специяльно для отбора по админу.
			{
				$strWhere .= " AND id_user IN (" . secure::escQuoteData($retFields['id_user']) . ")";
			}
		}

		/** Автор **/
		!empty($retFields['author']) ? $strWhere .= " AND author LIKE " . secure::escQuoteData($retFields['author']) : null;
		/** Заголовок **/
		!empty($retFields['title']) ? $strWhere .= " AND title LIKE " . secure::escQuoteData($retFields['title']) : null;
		// проверяем поле "Дата от" и создаем условие для запроса
		!empty($retFields['sDate']) ? ((!validate::validateMySqlDate($retFields['sDate'])) ? $arrErrors[] = ERROR_DATE_FORMAT : $strWhere .= " AND datetime>=" . secure::escQuoteData($retFields['sDate'])) : null;
		// проверяем поле "Дата до" и создаем условие для запроса
		!empty($retFields['eDate']) ? ((!validate::validateMySqlDate($retFields['eDate'])) ? $arrErrors[] = ERROR_DATE_FORMAT : $strWhere .= "AND datetime<=" . secure::escQuoteData($retFields['eDate'])) : null;

		///////////////////////////////////////////////////////////////
		///////////////////////////////////////////////////////////////

		$smarty -> assignByRef('retFields', $retFields);
    	/** текущий обработанный URL **/
		$path .= 'do=filter&amp;id=' . $retFields['id'] . '&amp;id_user=' . $retFields['id_user']
			  . '&amp;author=' . $retFields['author'] . '&amp;title=' . $retFields['title']
			  . '&amp;sDate=' . $retFields['sDate'] . '&amp;eDate=' . $retFields['eDate']
			  . '&amp;records=' . $retFields['records'] . '&amp;';
	}
	
	/** смещение, всегда 0 (затем берется из $_GET) **/
	$offset = (!empty($_GET['offset']) && validate::checkNaturalNumber($_GET['offset'])) ? validate::checkNaturalNumber($_GET['offset']) : 0;

	$strLimit = array('strLimit' => $offset . ',' . $retFields['records'], 'calcRows' => true);
	$arrFields = array('id', 'title', 'id_user', 'author', 'datetime');

	// массив всех записей
	$arrNewses = $news -> getNewses($strWhere, false, $strLimit, $arrFields);
	$smarty -> assign('arrNewses', $arrNewses);

	/** формируем страницы **/
	$allRecords = $news -> cntNews(); // получаем общее количество
	$strPages = strings::generatePage($allRecords, $offset, $retFields['records'], $path, true); // формируем странциы

	$smarty->assignByRef('allRecords', $allRecords); //передаем в шаблон общее количество записей
	$smarty->assignByRef('strPages', $strPages); //передаем в шаблон строку сформированных страниц

}
/**
* Ожидающие исправления
*/
elseif ($arrActions['correction'])
{
	// инициируем "Наименование страницы" отображаемое в форме
	$arrNamePage[] = array('name' => MENU_ACTION_CORRECTION, 'link' => false);

	/** Массовая активация и удаление **/
	if (isset($_POST['action']) && !empty($_POST['news']))
	{
		if (('active' === $_POST['action']))
		{
			$updData = array('comments' => '', 'token' => 'active', 'token_datetime' => '');
			(!$news -> updateNews($updData, array_keys($_POST['news']))) ? $arrErrors[] = db::$message_error : messages::messageChangeSaved(MESSAGE_CHANGE_SAVED, false, CONF_ADMIN_FILE . '?' . $qString);
		}
		elseif (('deleted' === $_POST['action']))
		{
			(!$news -> deleteNews(array_keys($_POST['news']))) ? $arrErrors[] = db::$message_error : messages::messageChangeSaved(MESSAGE_CHANGE_SAVED, false, CONF_ADMIN_FILE . '?' . $qString);
		}
	}

	//смещение, всегда 0 (затем берется из $_GET)
	/** смещение, всегда 0 (затем берется из $_GET) **/
	$offset = (!empty($_GET['offset']) && validate::checkNaturalNumber($_GET['offset'])) ? validate::checkNaturalNumber($_GET['offset']) : 0;
	$path = CONF_ADMIN_FILE . '?m=manager&amp;s=news&amp;action=correction&amp;'; //текущий обработанный URL

	$strWhere = "token IN ('correction')";
	$strLimit = array('strLimit' => $offset . ',' . $retFields['records'], 'calcRows' => true);
	$arrFields = array('id', 'title', 'id_user', 'author', 'comments', 'datetime', 'token_datetime');

	// массив всех
	$arrNewses = $news -> getNewses($strWhere, false, $strLimit, $arrFields);

	// формируем страницы
	$allRecords = $news -> cntNews(); // получаем общее количество
	$strPages = strings::generatePage($allRecords, $offset, $retFields['records'], $path, true); // формируем странциы

	$smarty -> assignByRef('arrNewses', $arrNewses);
	//передаем в шаблон общее количество записей
	$smarty -> assignByRef('allRecords', $allRecords);
	//передаем в шаблон строку сформированных страниц
	$smarty -> assignByRef('strPages', $strPages);
}
/**
* Комментарии к новостям
*/
elseif ($arrActions['comments']) {
	// инициируем "Наименование страницы" отображаемое в форме
	$arrNamePage[] = array('name' => MENU_COMMENTS, 'link' => false);

	$newsComments = new newsComments();

	/** Массовое удаление **/
	if (!empty($_POST['action']) && !empty($_POST['comments'])) {
		if (('deleted' === $_POST['action'])) {
			$strWhere = 'id IN (' . implode(',', secure::escQuoteData(array_keys($_POST['comments']))) . ')';

			if (!$newsComments -> deleteRecords($strWhere)) {
				$arrErrors[] = db::$message_error;
			} else {
				messages::messageChangeSaved(MESSAGE_CHANGE_SAVED, false, CONF_ADMIN_FILE . '?' . $qString);
			}
		}
	}

	// Проверяем фильтр
	$arrFilter = array('name','ip','id_news');
	if (isset($_GET['filter']) && in_array($_GET['filter'], $arrFilter) && !empty($_GET['in'])) {
		$strWhere = $_GET['filter'] . " IN (" . secure::escQuoteData($_GET['in']) . ")";
	} else {
		$strWhere = false;
	}

	// Проверяем сортировку
	$arrOrderBy = array();
	if (!empty($_GET['order']) && 'datetime' === $_GET['order'] && !empty($_GET['by']) && ('ASC' === $_GET['by'] || 'DESC' === $_GET['by'])) {
		$arrOrderBy['news_comments.datetime'] = $_GET['by'];
	} else {
		$arrOrderBy = false;
	}

	// Количество записей
	$arrRecords = array(30, 50, 100, 200, 'all');
	$records = $arrRecords[0];
	$strRecords = '';
	if (!empty($_GET['records']) && in_array($_GET['records'], $arrRecords)) {
		if ('all' == $_GET['records']) {
			$records = false;
			$strRecords = '&amp;records=all';
		} else {
			$records = $_GET['records'];
			$strRecords = '&amp;records=' . $records;
		}
	}

	$smarty -> assignByRef('records', $records);
	$smarty -> assignByRef('arrRecords', $arrRecords);
	$smarty -> assignByRef('strRecords', $strRecords);

	$strFilter = (!empty($strWhere)) ? '&amp;filter=' . $_GET['filter'] . '&amp;in=' . $_GET['in'] : '';
	$smarty -> assignByRef('strFilter', $strFilter);

	$arrFilter = (!empty($strWhere)) ? array('filter' => $_GET['filter'], 'in' => $_GET['in']) : false;
	$smarty -> assignByRef('arrFilter', $arrFilter);

	$strSort = (!empty($arrOrderBy)) ? '&amp;order=' . $_GET['order'] . '&amp;by=' . $_GET['by'] : '';
	$smarty -> assignByRef('strSort', $strSort);

	$arrSort = (!empty($arrOrderBy)) ? array('order' => $_GET['order'], 'by' => $_GET['by']) : false;
	$smarty -> assignByRef('arrSort', $arrSort);

	/** смещение, всегда 0 (затем берется из $_GET) **/
	$offset = (!empty($_GET['offset']) && validate::checkNaturalNumber($_GET['offset'])) ? validate::checkNaturalNumber($_GET['offset']) : 0;

	$strLimit = (!empty($records)) ? $offset . ',' . $records : false;

	$path = CONF_ADMIN_FILE . '?m=manager&amp;s=news&amp;action=comments' . $strFilter . $strSort . $strRecords . '&amp;'; //текущий обработанный URL

	$arrComments = $newsComments -> getFullCommentsData(false, $strWhere, $arrOrderBy, $strLimit);
	$allRecords = $newsComments -> cntRecords(); // получаем общее количество
	$strPages = strings::generatePage($allRecords, $offset, (!empty($records) ? $records : $allRecords), $path, true); // формируем странциы

	$smarty -> assignByRef('arrComments', $arrComments);
	$smarty -> assignByRef('allRecords', $allRecords);
	$smarty -> assignByRef('strPages', $strPages);
}
/**
* отображаем список новостей
*/
else
{
	// инициируем "Наименование страницы" отображаемое в форме
	$arrNamePage[] = array('name' => MENU_MANAGER_NEWS, 'link' => false);

	/**
	* скрытие, удаление новостей
	*/
	if (isset($_POST['action']) && !empty($_POST['news']))
	{
		if (('deleted' === $_POST['action']))
		{
			(!$news -> deleteNews(array_keys($_POST['news']))) ? $arrErrors[] = db::$message_error : messages::messageChangeSaved(MESSAGE_CHANGE_SAVED, false, CONF_ADMIN_FILE . '?' . $qString);
		}
		elseif (('archived' === $_POST['action']))
		{
			(!$news -> updateNews(array('token' => 'archived'), array_keys($_POST['news']))) ? $arrErrors[] = db::$message_error : messages::messageChangeSaved(MESSAGE_CHANGE_SAVED, false, CONF_ADMIN_FILE . '?' . $qString);
		}
	}
	// END скрытие, удаление новостей

	/** строка запроса по умолчанию **/
	$strWhere = "token IN ('active')";
	/** текущий обработанный URL **/
	$path = CONF_ADMIN_FILE . '?m=manager&amp;s=news&amp;';

	/** отбор записей **/
	if (!empty($_GET['do']) && 'filter' === $_GET['do'])
	{
		$retFields = array(
				'id'			=> !empty($_GET['id']) ? $_GET['id'] : false,
				'id_user'		=> (isset($_GET['id_user'])) ? $_GET['id_user'] : false,
				'author'		=> !empty($_GET['author']) ? $_GET['author'] : false,
				'title'			=> !empty($_GET['title']) ? $_GET['title'] : false,
				'sDate'			=> (!empty($_GET['sDate'])) ? $_GET['sDate'] : false,
				'eDate'			=> (!empty($_GET['eDate'])) ? $_GET['eDate'] : false,
				'records'		=> ((!empty($_GET['records']) && validate::checkNaturalNumber($_GET['records'])) ? validate::checkNaturalNumber($_GET['records']) : 30),
			);

		///////////////////////////////////////////////////////////////
		// Проверка данных, полученных из формы и формирование запроса
		///////////////////////////////////////////////////////////////

		/** ID новостей **/
		if (!empty($retFields['id']))
		{
			// проверяем, в каком виде передан массив Id
			if (stripos($retFields['id'], ',')) // поиск по нескольким ID (разделитель - запятая ',')
			{
				// формируем массив, с ID
				$arrID = array_filter(explode(',', $retFields['id']), 'strings::ifInt');
				$strWhere .= " AND id IN (" . implode(',', secure::escQuoteData($arrID)) . ")";
			}
			// поиск по диапазону ID (разделитель - тире '-')
			elseif (stripos($retFields['id'], '-'))
			{
				// формируем массив, с диапазоном ID
				$arrID = array_filter(explode('-', $retFields['id']), 'strings::ifInt');
				(!empty($arrID[0]) && !empty($arrID[1])) ? $strWhere  .= " AND id>=" . secure::escQuoteData(validate::checkNaturalNumber($arrID[0])) . " AND id<=" . secure::escQuoteData(validate::checkNaturalNumber($arrID[1])) : null;
			}
			elseif ((int) $retFields['id']) // поиск по ID
			{
				$strWhere .= " AND id IN (" . secure::escQuoteData(validate::checkNaturalNumber($retFields['id'])) . ")";
			}
		}

		/** ID пользователей **/
		if (isset($retFields['id_user']))
		{
			// проверяем, в каком виде передан массив Id-пользователя
			if (stripos($retFields['id_user'], ',')) // поиск пользователей по нескольким ID (разделитель - запятая ',')
			{
				// формируем массив, с ID пользователей
				$arrID = array_filter(explode(',', $retFields['id_user']), 'strings::ifInt');
				$strWhere .= " AND id_user IN (" . implode(',', secure::escQuoteData($arrID)) . ")";
			}
			// поиск пользователей по диапазону ID (разделитель - тире '-')
			elseif (stripos($retFields['id_user'], '-'))
			{
				// формируем массив, с диапазоном ID пользователей
				$arrID = array_filter(explode('-', $retFields['id_user']), 'strings::ifInt');
				(!empty($arrID[0]) && !empty($arrID[1])) ? $strWhere .= " AND id_user>=" . secure::escQuoteData(validate::checkNaturalNumber($arrID[0])) . " AND id_user<=" . secure::escQuoteData(validate::checkNaturalNumber($arrID[1])) : null;
			}
			elseif ((int) $retFields['id_user']) // поиск пользователей по ID
			{
				$strWhere .= " AND id_user IN (" . secure::escQuoteData(validate::checkNaturalNumber($retFields['id_user'])) . ")";
			}
			elseif (0 == $retFields['id_user']) // поиск пользователей по ID - сделано специяльно для отбора по админу.
			{
				$strWhere .= " AND id_user IN (" . secure::escQuoteData($retFields['id_user']) . ")";
			}
		}

		/** Автор **/
		!empty($retFields['author']) ? $strWhere .= " AND author LIKE " . secure::escQuoteData($retFields['author']) : null;
		/** Заголовок **/
		!empty($retFields['title']) ? $strWhere .= " AND title LIKE " . secure::escQuoteData($retFields['title']) : null;
		// проверяем поле "Дата от" и создаем условие для запроса
		!empty($retFields['sDate']) ? ((!validate::validateMySqlDate($retFields['sDate'])) ? $arrErrors[] = ERROR_DATE_FORMAT : $strWhere .= " AND datetime>=" . secure::escQuoteData($retFields['sDate'])) : null;
		// проверяем поле "Дата до" и создаем условие для запроса
		!empty($retFields['eDate']) ? ((!validate::validateMySqlDate($retFields['eDate'])) ? $arrErrors[] = ERROR_DATE_FORMAT : $strWhere .= "AND datetime<=" . secure::escQuoteData($retFields['eDate'])) : null;

		///////////////////////////////////////////////////////////////
		///////////////////////////////////////////////////////////////

		$smarty -> assignByRef('retFields', $retFields);
    	/** текущий обработанный URL **/
		$path .= 'do=filter&amp;id=' . $retFields['id'] . '&amp;id_user=' . $retFields['id_user']
			  . '&amp;author=' . $retFields['author'] . '&amp;title=' . $retFields['title']
			  . '&amp;sDate=' . $retFields['sDate'] . '&amp;eDate=' . $retFields['eDate']
			  . '&amp;records=' . $retFields['records'] . '&amp;';
	}

	/** смещение, всегда 0 (затем берется из $_GET) **/
	$offset = (!empty($_GET['offset']) && validate::checkNaturalNumber($_GET['offset'])) ? validate::checkNaturalNumber($_GET['offset']) : 0;

	$strLimit = array('strLimit' => $offset . ',' . $retFields['records'], 'calcRows' => true);
	$arrFields = array('id', 'title', 'id_user', 'author', 'datetime');

	$arrNewses = $news -> getNewses($strWhere, false, $strLimit, $arrFields);

	/** формируем страницы **/
	$allRecords = $news -> cntNews(); // получаем общее количество новостей
	$strPages = strings::generatePage($allRecords, $offset, $retFields['records'], $path, true); // формируем странциы

	$smarty -> assignByRef('arrNewses', $arrNewses);
	$smarty -> assignByRef('allRecords', $allRecords); //передаем в шаблон общее количество записей
	$smarty -> assignByRef('strPages', $strPages); //передаем в шаблон строку сформированных страниц
}

// адресная строка
$smarty -> assignByRef('qString', $qString);
$smarty -> assignByRef('errors', $arrErrors);
$smarty -> assignByRef('actions', $arrActions);
