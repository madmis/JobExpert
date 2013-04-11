<?php
/********************************************************
	JobExpert v1.0
	powered by Script Developers Group (SD-Group)
	email: info@sd-group.org.ua
	url: http://sd-group.org.ua/
	Copyright 2010-2015 (c) SD-Group
	All rights reserved
=========================================================
	Менеджер - Статьи
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
						array('name' => MENU_MANAGER_ARTICLES, 'link' => CONF_ADMIN_FILE . '?m=manager&amp;s=articles')
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

$articles = new articles();
$artsections = new artsections();

/**
* массив, который возращается в форму
* содержит значения по умолчанию для формы отбора
*/
$retFields = array(
		'id'			=> false, // id статьи (статей)
		'id_user'		=> false, // id пользователя (пользователей)
		'author'		=> false, // автор статьи (авторы)
		'title'			=> false, // заголовок статьи (маска)
		'id_section'	=> false,  // id раздела по умолчанию
		'sDate'			=> false, // начальная дата по умолчанию
		'eDate'			=> false, // конечная дата по умолчанию
		'records'		=> 30 // количество записей на странице по умолчанию
	);

/** Строка запроса из адресной строки браузера **/
$qString = !empty($_SERVER['QUERY_STRING']) ? $_SERVER['QUERY_STRING'] : 'm=manager&s=articles';

/**
* Настройки статей
*/
if ($arrActions['config']) {
	// инициируем "Наименование страницы" отображаемое в форме
	$arrNamePage[] = array('name' => MENU_CONFIG, 'link' => false);

	// сохраняем данные, переданные из формы
	if (isset($_POST['save'])) {
		$perpage = (isset($_POST['perpage']) && (int) $_POST['perpage']) ? (int) abs($_POST['perpage']) : 30;
		$addInform = (isset($_POST['addInform'])) ? 1 : 0;
		$moderateInform = (isset($_POST['moderateInform'])) ? 1 : 0;
		$correctionTerm = (isset($_POST['correctionTerm']) && (int) $_POST['correctionTerm']) ? (int) abs($_POST['correctionTerm']) : 72;
		$comments = (!empty($_POST['comments'])) ? 1 : 0;
		$commentsRegister = (!empty($_POST['comments_register'])) ? 1 : 0;
		$commentsNameUnregister = (!empty($_POST['name_unregister'])) ? htmlspecialchars($_POST['name_unregister'], ENT_QUOTES, CONF_DEFAULT_CHARSET) : 'Guest';
		$titleSectionSite = (!empty($_POST['titleSectionSite'])) ? 1 : 0;
		$titleSectionArticle = (!empty($_POST['titleSectionArticle'])) ? 1 : 0;
		$titleArticleName = (!empty($_POST['titleArticleName'])) ? 1 : 0;

		$data = "<?php\n\n"
			  . "(!defined('SDG')) ? die ('Triple protection!') : null;\n\n"
			  . 'define("CONF_ARTICLES_PERPAGE", "' . $perpage . '");' . "\n\n"
			  . 'define("CONF_ARTICLES_ADD_SUCCESS_ADMIN_INFORM", "' . $addInform . '");' . "\n\n"
			  . 'define("CONF_ARTICLES_ADD_MODERATION_ADMIN_INFORM", "' . $moderateInform . '");' . "\n\n"
			  . 'define("CONF_ARTICLES_CORRECTION_THERM", "' . $correctionTerm . '");' . "\n\n"
			  . 'define("CONF_ARTICLES_COMMENTS", ' . $comments . ');' . "\n\n"
			  . 'define("CONF_ARTICLES_COMMENTS_REGISTER", ' . $commentsRegister . ');' . "\n\n"
			  . 'define("CONF_ARTICLES_COMMENTS_NAME_UNREGISTER", "' . $commentsNameUnregister . '");' . "\n\n"
			  . 'define("CONF_ARTICLES_TITLE_SECTION_SITE", ' . $titleSectionSite . ');' . "\n\n"
			  . 'define("CONF_ARTICLES_TITLE_SECTION_ARTICLE", ' . $titleSectionArticle . ');' . "\n\n"
			  . 'define("CONF_ARTICLES_TITLE_ARTICLE_NAME", ' . $titleArticleName . ');' . "\n";

		if (!tools::saveConfig('core/conf/const.config.articles.php', $data, CONF_ADMIN_FILE . '?m=manager&s=articles&action=config')) {
			$arrErrors[] = ERROR_FILES_MISSING_FILE;
		}
	}
}
/**
* добавление статьи
*/
elseif ($arrActions['add']) {
	// инициируем "Наименование страницы" отображаемое в форме
	$arrNamePage[] = array('name' => MENU_MANAGER_ARTICLES_ADD, 'link' => false);

	if (isset($_POST['save'])) // добавление статьи
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
		(!$arrBindFields['id_section']) ? $arrErrors[] = ERROR_EMPTY_SECTION : null;

		(!$arrBindFields['title']) ? $arrErrors[] = ERROR_EMPTY_TITLE : null;

		(!$arrBindFields['small_text']) ? $arrErrors[] = ERROR_EMPTY_SMALL_TEXT : null;

		(!$arrBindFields['text']) ? $arrErrors[] = ERROR_EMPTY_TEXT : null;
		///////////////////////////////////////////////////////////////
		///////////////////////////////////////////////////////////////

		if (!$arrErrors)
		{
			// присваеваем полученные данные объекту
			$articles ->arrBindFields = $arrBindFields;
			$articles -> arrNoBindFields = $arrNoBindFields;

			// производим запись в таблицу БД
			(!$articles -> recArticle()) ? $arrErrors[] = (db::$message_error ? db::$message_error : ERROR_MISMATCH_FIELDS) : messages::messageChangeSaved(MESSAGE_ARTICLE_ADDED, false, CONF_ADMIN_FILE . '?m=manager&s=articles');
		}
		else
		{
			$smarty -> assign('return_data', $arrBindFields + $arrNoBindFields);
		}
	}
}
/**
* редактирование статьи
*/
elseif ($arrActions['edit']) {
	if (!empty($_GET['id']) && $id = validate::checkNaturalNumber($_GET['id']))	{
		// инициируем "Наименование страницы" отображаемое в форме
		$arrNamePage[] = array('name' => MENU_ACTION_EDIT, 'link' => false);

		// проверяем существование новости
		$article = $articles -> getArticle("token IN ('active','archived') AND id=" . secure::escQuoteData($id));
		if (!empty($article) && is_array($article))	{
			$smarty -> assignByRef('return_data', $article); // передаем новость в шаблон

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
				(!$arrBindFields['id_section']) ? $arrErrors[] = ERROR_EMPTY_SECTION : null;

				(!$arrBindFields['title']) ? $arrErrors[] = ERROR_EMPTY_TITLE : null;

				(!$arrBindFields['small_text']) ? $arrErrors[] = ERROR_EMPTY_SMALL_TEXT : null;

				(!$arrBindFields['text']) ? $arrErrors[] = ERROR_EMPTY_TEXT : null;
				///////////////////////////////////////////////////////////////
				///////////////////////////////////////////////////////////////

				if (!$arrErrors) {
					// присваеваем полученные данные объекту
					$articles -> arrBindFields = $arrBindFields;
					$articles -> arrNoBindFields = $arrNoBindFields;

					// производим запись в таблицу БД
					if (!$articles -> updateArticle($arrBindFields + $arrNoBindFields, $article['id'])) {
						$arrErrors[] = (db::$message_error ? db::$message_error : ERROR_MISMATCH_FIELDS);
					} else {
						messages::messageChangeSaved(MESSAGE_ARTICLE_ADDED, false, CONF_ADMIN_FILE . '?m=manager&s=articles');
					}
				} else {
					$smarty -> assign('return_data', $arrBindFields + $arrNoBindFields);
				}
			}
		} else {
			messages::error404();
		}
	} else {
		messages::error404();
	}
}
// END Добавление, редактирование, настройки статей
/**
* Статьи на модерации
*/
elseif ($arrActions['moderate']) {
	// инициируем "Наименование страницы" отображаемое в форме
	$arrNamePage[] = array('name' => MENU_ACTION_MODERATE, 'link' => false);

	/**
	* Массовая активация, отправка на редактирование, удаление статей
	*/
	if (isset($_POST['action']))
	{
		if (('active' === $_POST['action']) && !empty($_POST['articles']))
		{
			(!$articles -> updateArticles(array('token' => 'active'), array_keys($_POST['articles']))) ? $arrErrors[] = db::$message_error : messages::messageChangeSaved(MESSAGE_CHANGE_SAVED, false, CONF_ADMIN_FILE . '?' . $qString);
		}
		elseif (('correction' === $_POST['action']) && !empty($_POST['articles']))
		{
			//date(terms::dateFormatFromSmarty(CONF_DATE_FORMAT, CONF_TIME_FORMAT), strtotime(terms::calcDateTimeOfTerm(CONF_ARTICLES_CORRECTION_THERM))),
			$updData = array(
						'token'				=> 'correction',
						'token_datetime'	=> terms::calcDateTimeOfTerm(CONF_ARTICLES_CORRECTION_THERM),
					);
			(!$articles -> updateArticles($updData, array_keys($_POST['articles']))) ? $arrErrors[] = db::$message_error : messages::messageChangeSaved(MESSAGE_CHANGE_SAVED, false, CONF_ADMIN_FILE . '?' . $qString);
		}
		elseif (('delete' === $_POST['action']) && !empty($_POST['articles']))
		{
			(!$articles -> deleteArticles(array_keys($_POST['articles']))) ? $arrErrors[] = db::$message_error : messages::messageChangeSaved(MESSAGE_CHANGE_SAVED, false, CONF_ADMIN_FILE . '?' . $qString);
		}
	}
	/** Единичная активация, отправка на редактирование, удаление статей **/
	elseif (!empty($_POST['arrData']['action']) && !empty($_POST['arrData']['id']))
	{
		 if ('active' === $_POST['arrData']['action'] && !empty($_POST['arrData']['title']) && !empty($_POST['arrData']['datetime']) && !empty($_POST['arrData']['id_user']))
		 {
		 	if ($articles -> updateArticle(array('token' => 'active', 'token_datetime' => ''), $_POST['arrData']['id']))
		 	{
		 		  $articles -> sendUserActiveArticle($_POST['arrData']);
		 		  messages::messageChangeSaved(MESSAGE_CHANGE_SAVED, false, CONF_ADMIN_FILE . '?' . $qString);
			}
			else
			{
				$arrErrors[] = db::$message_error;
			}
		 }
		 elseif ('correction' === $_POST['arrData']['action'] && !empty($_POST['arrData']['comments']) && !empty($_POST['arrData']['title']) && !empty($_POST['arrData']['datetime']) && !empty($_POST['arrData']['id_user']))
		 {
			 // данные для обновления в таблице
			 $updData = array(
						'comments'			=> $_POST['arrData']['comments'],
						'token'				=> 'correction',
						'token_datetime'	=> terms::calcDateTimeOfTerm(CONF_ARTICLES_CORRECTION_THERM),
					);
		 	if ($articles -> updateArticle($updData, $_POST['arrData']['id']))
		 	{
		 		  $articles -> sendUserCorrectionArticle($_POST['arrData']);
		 		  messages::messageChangeSaved(MESSAGE_CHANGE_SAVED, false, CONF_ADMIN_FILE . '?' . $qString);
			}
			else
			{
				$arrErrors[] = db::$message_error;
			}
		 }
		 elseif ('deleted' === $_POST['arrData']['action'] && !empty($_POST['arrData']['comments']) && !empty($_POST['arrData']['title']) && !empty($_POST['arrData']['id_user']))
		 {
		 	if ($articles -> deleteArticles(array($_POST['arrData']['id'])))
		 	{
		 		  $articles -> sendUserDeletedArticle($_POST['arrData']);
		 		  messages::messageChangeSaved(MESSAGE_CHANGE_SAVED, false, CONF_ADMIN_FILE . '?' . $qString);
			}
			else
			{
				$arrErrors[] = db::$message_error;
			}
		 }
	}

	//смещение, всегда 0 (затем берется из $_GET)
	$offset = (!empty($_GET['offset']) && strings::ifInt($_GET['offset']) && (int) $_GET['offset'] > 0) ? (int) abs($_GET['offset']) : 0;
	$path = CONF_ADMIN_FILE . '?m=manager&amp;s=articles&amp;action=moderate&amp;'; //текущий обработанный URL

	$strWhere = "token IN ('moderate')";
	$strLimit = array('strLimit' => $offset . ',' . $retFields['records'], 'calcRows' => true);
	$arrFields = array('id', 'title', 'id_section', 'id_user', 'author', 'comments', 'datetime');

	// массив всех статей
	$arrArticles = $articles -> getArticles($strWhere, false, $strLimit, $arrFields);

	// формируем страницы
	$allRecords = $articles -> cntArticles(); // получаем общее количество статей
	$strPages = strings::generatePage($allRecords, $offset, $retFields['records'], $path, true); // формируем странциы

	$smarty -> assignByRef('arrArticles', $arrArticles);
	//передаем в шаблон общее количество записей
	$smarty -> assignByRef('allRecords', $allRecords);
	//передаем в шаблон строку сформированных страниц
	$smarty -> assignByRef('strPages', $strPages);
}
/**
* В архиве
*/
elseif ($arrActions['archived']) {
	// инициируем "Наименование страницы" отображаемое в форме
	$arrNamePage[] = array('name' => MENU_ACTION_ARCHIVED, 'link' => false);

	/** извлечение из архива и удаление статей **/
	if (isset($_POST['action']))
	{
		if (('active' === $_POST['action']) && !empty($_POST['articles']))
		{
			(!$articles -> updateArticles(array('token' => 'active'), array_keys($_POST['articles']))) ? $arrErrors[] = db::$message_error : messages::messageChangeSaved(MESSAGE_CHANGE_SAVED, false, CONF_ADMIN_FILE . '?' . $qString);
		}
		elseif (('deleted' === $_POST['action']) && !empty($_POST['articles']))
		{
			(!$articles -> deleteArticles(array_keys($_POST['articles']))) ? $arrErrors[] = db::$message_error : messages::messageChangeSaved(MESSAGE_CHANGE_SAVED, false, CONF_ADMIN_FILE . '?' . $qString);
		}
	}
	/** END извлечение из архива и удаление статей **/

	/** строка запроса по умолчанию **/
	$strWhere = "token IN ('archived')";
	/** текущий обработанный URL **/
	$path = CONF_ADMIN_FILE . '?m=manager&amp;s=articles&amp;action=archived&amp;';

	/** отбор записей **/
	if (!empty($_GET['do']) && 'filter' === $_GET['do'])
	{
		$retFields = array(
				'id'			=> !empty($_GET['id']) ? $_GET['id'] : false,
				'id_user'		=> !empty($_GET['id_user']) ? $_GET['id_user'] : false,
				'author'		=> !empty($_GET['author']) ? $_GET['author'] : false,
				'title'			=> !empty($_GET['title']) ? $_GET['title'] : false,
				'id_section'	=> (!empty($_GET['id_section']) && strings::ifInt($_GET['id_section'])) ? (int) abs($_GET['id_section']) : false,
				'sDate'			=> (!empty($_GET['sDate'])) ? $_GET['sDate'] : false,
				'eDate'			=> (!empty($_GET['eDate'])) ? $_GET['eDate'] : false,
				'records'		=> ((!empty($_GET['records']) && strings::ifInt($_GET['records'])) ? (int) abs($_GET['records']) : 30)
			);

		///////////////////////////////////////////////////////////////
		// Проверка данных, полученных из формы и формирование запроса
		///////////////////////////////////////////////////////////////

		/** ID статей **/
		if (!empty($retFields['id']))
		{
			// проверяем, в каком виде передан массив Id-пользователя
			if (stripos($retFields['id'], ',')) // поиск пользователей по нескольким ID (разделитель - запятая ',')
			{
				// формируем массив, с ID пользователей
				$arrID = array_filter(explode(',', $retFields['id']), 'strings::ifInt');
				$strWhere .= " AND id IN (" . implode(',', secure::escQuoteData($arrID)) . ")";
			}
			// поиск пользователей по диапазону ID (разделитель - тире '-')
			elseif (stripos($retFields['id'], '-'))
			{
				// формируем массив, с диапазоном ID пользователей
				$arrID = array_filter(explode('-', $retFields['id']), 'strings::ifInt');
				(!empty($arrID[0]) && !empty($arrID[1])) ? $strWhere  .= " AND id>=" . $arrID[0] . " AND id<=" . $arrID[1] : null;
			}
			elseif ((int) $retFields['id']) // поиск пользователей по ID
			{
				$strWhere .= " AND id IN (" . secure::escQuoteData((int) abs($retFields['id'])) . ")";
			}
		}

		/** ID пользователей **/
		if (!empty($retFields['id_user']))
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
				(!empty($arrID[0]) && !empty($arrID[1])) ? $strWhere .= " AND id_user>=" . $arrID[0] . " AND id_user<=" . $arrID[1] : null;
			}
			elseif ((int) $retFields['id_user']) // поиск пользователей по ID
			{
				$strWhere .= " AND id_user IN (" . secure::escQuoteData((int) abs($retFields['id_user'])) . ")";
			}
		}
		
		/** Автор **/
		!empty($retFields['author']) ? $strWhere .= " AND author LIKE " . secure::escQuoteData($retFields['author']) : null;
		/** Заголовок **/
		!empty($retFields['title']) ? $strWhere .= " AND title LIKE " . secure::escQuoteData($retFields['title']) : null;
		/** Раздел **/
		!empty($retFields['id_section']) ? $strWhere .= " AND id_section IN (" . secure::escQuoteData($retFields['id_section']) . ")" : null;

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
			  . '&amp;id_section=' . $retFields['id_section']
			  . '&amp;sDate=' . $retFields['sDate'] . '&amp;eDate=' . $retFields['eDate']
			  . '&amp;records=' . $retFields['records'] . '&amp;';
	}

	/** смещение, всегда 0 (затем берется из $_GET) **/
	$offset = (!empty($_GET['offset']) && strings::ifInt($_GET['offset']) && (int) $_GET['offset'] > 0) ? (int) abs($_GET['offset']) : 0;

	$strLimit = array('strLimit' => $offset . ',' . $retFields['records'], 'calcRows' => true);
	$arrFields = array('id', 'title', 'id_section', 'id_user', 'author', 'datetime');

	$smarty -> assign('arrArticles', $articles -> getArticles($strWhere, false, $strLimit, $arrFields)); // массив всех статей

	/** формируем страницы **/
	$allRecords = $articles -> cntArticles(); // получаем общее количество статей
	$strPages = strings::generatePage($allRecords, $offset, $retFields['records'], $path, true); // формируем странциы

	$smarty->assignByRef('allRecords', $allRecords); //передаем в шаблон общее количество записей
	$smarty->assignByRef('strPages', $strPages); //передаем в шаблон строку сформированных страниц
}
/**
* Ожидающие исправления
*/
elseif ($arrActions['correction']) {
	// инициируем "Наименование страницы" отображаемое в форме
	$arrNamePage[] = array('name' => MENU_ACTION_CORRECTION, 'link' => false);

	/** Массовая активация и удаление статей **/
	if (isset($_POST['action']))
	{
		if (('active' === $_POST['action']) && !empty($_POST['articles']))
		{
			$updData = array('comments' => '', 'token' => 'active', 'token_datetime' => '');
			(!$articles -> updateArticles($updData, array_keys($_POST['articles']))) ? $arrErrors[] = db::$message_error : messages::messageChangeSaved(MESSAGE_CHANGE_SAVED, false, CONF_ADMIN_FILE . '?' . $qString);
		}
		elseif (('deleted' === $_POST['action']) && !empty($_POST['articles']))
		{
			(!$articles -> deleteArticles(array_keys($_POST['articles']))) ? $arrErrors[] = db::$message_error : messages::messageChangeSaved(MESSAGE_CHANGE_SAVED, false, CONF_ADMIN_FILE . '?' . $qString);
		}
	}

	//смещение, всегда 0 (затем берется из $_GET)
	$offset = (!empty($_GET['offset']) && strings::ifInt($_GET['offset']) && (int) $_GET['offset'] > 0) ? (int) abs($_GET['offset']) : 0;
	$path = CONF_ADMIN_FILE . '?m=manager&amp;s=articles&amp;action=correction&amp;'; //текущий обработанный URL

	$strWhere = "token IN ('correction')";
	$strLimit = array('strLimit' => $offset . ',' . $retFields['records'], 'calcRows' => true);
	$arrFields = array('id', 'title', 'id_section', 'id_user', 'author', 'comments', 'datetime', 'token_datetime');

	// массив всех статей
	$arrArticles = $articles -> getArticles($strWhere, false, $strLimit, $arrFields);

	// формируем страницы
	$allRecords = $articles -> cntArticles(); // получаем общее количество статей
	$strPages = strings::generatePage($allRecords, $offset, $retFields['records'], $path, true); // формируем странциы

	$smarty -> assignByRef('arrArticles', $arrArticles);
	//передаем в шаблон общее количество записей
	$smarty -> assignByRef('allRecords', $allRecords);
	//передаем в шаблон строку сформированных страниц
	$smarty -> assignByRef('strPages', $strPages);
}
/**
* Комментарии
*/
elseif ($arrActions['comments']) {
	// инициируем "Наименование страницы" отображаемое в форме
	$arrNamePage[] = array('name' => MENU_COMMENTS, 'link' => false);

	$artComments = new articlesComments();

	/** Массовое удаление **/
	if (!empty($_POST['action']) && !empty($_POST['comments'])) {
		if (('deleted' === $_POST['action'])) {
			$strWhere = 'id IN (' . implode(',', secure::escQuoteData(array_keys($_POST['comments']))) . ')';

			if (!$artComments -> deleteRecords($strWhere)) {
				$arrErrors[] = db::$message_error;
			} else {
				messages::messageChangeSaved(MESSAGE_CHANGE_SAVED, false, CONF_ADMIN_FILE . '?' . $qString);
			}
		}
	}

	// Проверяем фильтр
	$arrFilter = array('name','ip','id_article');
	if (isset($_GET['filter']) && in_array($_GET['filter'], $arrFilter) && !empty($_GET['in'])) {
		$strWhere = $_GET['filter'] . " IN (" . secure::escQuoteData($_GET['in']) . ")";
	} else {
		$strWhere = false;
	}

	// Проверяем сортировку
	$arrOrderBy = array();
	if (!empty($_GET['order']) && 'datetime' === $_GET['order'] && !empty($_GET['by']) && ('ASC' === $_GET['by'] || 'DESC' === $_GET['by'])) {
		$arrOrderBy['articles_comments.datetime'] = $_GET['by'];
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

	$path = CONF_ADMIN_FILE . '?m=manager&amp;s=articles&amp;action=comments' . $strFilter . $strSort . $strRecords . '&amp;'; //текущий обработанный URL

	$arrComments = $artComments -> getFullCommentsData(false, $strWhere, $arrOrderBy, $strLimit);
	$allRecords = $artComments -> cntRecords(); // получаем общее количество
	$strPages = strings::generatePage($allRecords, $offset, (!empty($records) ? $records : $allRecords), $path, true); // формируем странциы

	$smarty -> assignByRef('arrComments', $arrComments);
	$smarty -> assignByRef('allRecords', $allRecords);
	$smarty -> assignByRef('strPages', $strPages);
}
/**
* отображаем список статей
*/
else
{
	// инициируем "Наименование страницы" отображаемое в форме
	$arrNamePage[] = array('name' => MENU_MANAGER_ARTICLES, 'link' => false);

	/**
	* отображение, скрытие, удаление статей
	*/
	if (isset($_POST['action']))
	{
		if (('delete' === $_POST['action']) && !empty($_POST['articles']))
		{
			(!$articles -> deleteArticles(array_keys($_POST['articles']))) ? $arrErrors[] = db::$message_error : messages::messageChangeSaved(MESSAGE_CHANGE_SAVED, false, CONF_ADMIN_FILE . '?' . $qString);
		}
		elseif (('archived' === $_POST['action']) && !empty($_POST['articles']))
		{
			(!$articles -> updateArticles(array('token' => 'archived'), array_keys($_POST['articles']))) ? $arrErrors[] = db::$message_error : messages::messageChangeSaved(MESSAGE_CHANGE_SAVED, false, CONF_ADMIN_FILE . '?' . $qString);
		}
	}
	// END отображение, скрытие, удаление новостей

	/** строка запроса по умолчанию **/
	$strWhere = "token IN ('active')";
	/** текущий обработанный URL **/
	$path = CONF_ADMIN_FILE . '?m=manager&amp;s=articles&amp;';

	/**
	* отбор записей
	*/
	if (!empty($_GET['do']) && 'filter' === $_GET['do'])
	{
		$retFields = array(
				'id'			=> !empty($_GET['id']) ? $_GET['id'] : false,
				'id_user'		=> !empty($_GET['id_user']) ? $_GET['id_user'] : false,
				'author'		=> !empty($_GET['author']) ? $_GET['author'] : false,
				'title'			=> !empty($_GET['title']) ? $_GET['title'] : false,
				'id_section'	=> (!empty($_GET['id_section']) && strings::ifInt($_GET['id_section'])) ? (int) abs($_GET['id_section']) : false,
				'sDate'			=> (!empty($_GET['sDate'])) ? $_GET['sDate'] : false,
				'eDate'			=> (!empty($_GET['eDate'])) ? $_GET['eDate'] : false,
				'records'		=> ((!empty($_GET['records']) && strings::ifInt($_GET['records'])) ? (int) abs($_GET['records']) : 30)
			);

		///////////////////////////////////////////////////////////////
		// Проверка данных, полученных из формы и формирование запроса
		///////////////////////////////////////////////////////////////

		/** ID статей **/
		if (!empty($retFields['id']))
		{
			// проверяем, в каком виде передан массив Id-пользователя
			if (stripos($retFields['id'], ',')) // поиск пользователей по нескольким ID (разделитель - запятая ',')
			{
				// формируем массив, с ID пользователей
				$arrID = array_filter(explode(',', $retFields['id']), 'strings::ifInt');
				$strWhere .= " AND id IN (" . implode(',', secure::escQuoteData($arrID)) . ")";
			}
			// поиск пользователей по диапазону ID (разделитель - тире '-')
			elseif (stripos($retFields['id'], '-'))
			{
				// формируем массив, с диапазоном ID пользователей
				$arrID = array_filter(explode('-', $retFields['id']), 'strings::ifInt');
				(!empty($arrID[0]) && !empty($arrID[1])) ? $strWhere  .= " AND id>=" . $arrID[0] . " AND id<=" . $arrID[1] : null;
			}
			elseif ((int) $retFields['id']) // поиск пользователей по ID
			{
				$strWhere .= " AND id IN (" . secure::escQuoteData((int) abs($retFields['id'])) . ")";
			}
		}

		/** ID пользователей **/
		if (!empty($retFields['id_user']))
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
				(!empty($arrID[0]) && !empty($arrID[1])) ? $strWhere .= " AND id_user>=" . $arrID[0] . " AND id_user<=" . $arrID[1] : null;
			}
			elseif ((int) $retFields['id_user']) // поиск пользователей по ID
			{
				$strWhere .= " AND id_user IN (" . secure::escQuoteData((int) abs($retFields['id_user'])) . ")";
			}
		}
		
		/** Автор **/
		!empty($retFields['author']) ? $strWhere .= " AND author LIKE " . secure::escQuoteData($retFields['author']) : null;
		/** Заголовок **/
		!empty($retFields['title']) ? $strWhere .= " AND title LIKE " . secure::escQuoteData($retFields['title']) : null;
		/** Раздел **/
		!empty($retFields['id_section']) ? $strWhere .= " AND id_section IN (" . secure::escQuoteData($retFields['id_section']) . ")" : null;

		// проверяем поле "Дата от" и создаем условие для запроса
		!empty($retFields['sDate']) ? ((!validate::validateMySqlDate($retFields['sDate'])) ? $arrErrors[] = ERROR_DATE_FORMAT : $strWhere .= " AND datetime>=" . secure::escQuoteData($retFields['sDate'])) : null;
		// проверяем поле "Дата до" и создаем условие для запроса
		!empty($retFields['eDate']) ? ((!validate::validateMySqlDate($retFields['eDate'])) ? $arrErrors[] = ERROR_DATE_FORMAT : $strWhere .= " AND datetime<=" . secure::escQuoteData($retFields['eDate'])) : null;

		///////////////////////////////////////////////////////////////
		///////////////////////////////////////////////////////////////

		$smarty -> assignByRef('retFields', $retFields);
    	/** текущий обработанный URL **/
		$path .= 'do=filter&amp;id=' . $retFields['id'] . '&amp;id_user=' . $retFields['id_user']
			  . '&amp;author=' . $retFields['author'] . '&amp;title=' . $retFields['title']
			  . '&amp;id_section=' . $retFields['id_section']
			  . '&amp;sDate=' . $retFields['sDate'] . '&amp;eDate=' . $retFields['eDate']
			  . '&amp;records=' . $retFields['records'] . '&amp;';
	}

	/** смещение, всегда 0 (затем берется из $_GET) **/
	$offset = (!empty($_GET['offset']) && strings::ifInt($_GET['offset']) && (int) $_GET['offset'] > 0) ? (int) abs($_GET['offset']) : 0;

	$strLimit = array('strLimit' => $offset . ',' . $retFields['records'], 'calcRows' => true);
	$arrFields = array('id', 'title', 'id_section', 'id_user', 'author', 'datetime');

	$smarty -> assign('arrArticles', $articles -> getArticles($strWhere, false, $strLimit, $arrFields)); // массив всех статей

	/** формируем страницы **/
	$allRecords = $articles -> cntArticles(); // получаем общее количество статей
	$strPages = strings::generatePage($allRecords, $offset, $retFields['records'], $path, true); // формируем странциы

	$smarty->assignByRef('allRecords', $allRecords); //передаем в шаблон общее количество записей
	$smarty->assignByRef('strPages', $strPages); //передаем в шаблон строку сформированных страниц
}

// создаем объект разделов статей
$sections = (!$sections['full'] = $artsections -> getSections()) ? false : $sections + $artsections -> splitSections($sections['full']);

// передаем в смарти все разделы
$smarty -> assignByRef('sections', $sections);

// адресная строка
$smarty -> assignByRef('qString', $qString);
$smarty -> assignByRef('errors', $arrErrors);
$smarty -> assignByRef('actions', $arrActions);
