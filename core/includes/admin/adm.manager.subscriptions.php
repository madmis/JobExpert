<?php
/********************************************************
	JobExpert v1.0
	powered by Script Developers Group (SD-Group)
	email: info@sd-group.org.ua
	url: http://sd-group.org.ua/
	Copyright 2010-2015 (c) SD-Group
	All rights reserved
=========================================================
	Менеджер - Подписки
********************************************************/
/**
* @package
* @todo
*/

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
						'config'	=> false,
						'announce'	=> false,
						'payment'	=> false
                    );

// определяем шаблон для отображения
(isset($_GET['action']) && isset($arrActions[$_GET['action']])) ? $arrActions[$_GET['action']] = true : null;

// создаем объект
$subscription = new subscription();

/**
* Настройки подписок
*/
if ($arrActions['config'])
{
	// инициируем "Наименование страницы" отображаемое в форме
	$arrNamePage[] = array('name' => MENU_MANAGER_SUBSCRIPTIONS, 'link' => CONF_ADMIN_FILE . '?m=manager&amp;s=subscriptions');
	$arrNamePage[] = array('name' => MENU_CONFIG, 'link' => false);

	if (isset($_POST['save'])) // сохраняем данные, переданные из формы
	{
		$startTime = (isset($_POST['start_time']) && isset($_POST['start_time']['Hour']) && isset($_POST['start_time']['Minute']))? mktime($_POST['start_time']['Hour'], $_POST['start_time']['Minute']) : 0;

		$data = "<?php\n\n"
			  . "(!defined('SDG')) ? die ('Triple protection!') : null;\n\n"
			  . 'define("CONF_SUBSCRIPTIONS_STRINGS_PERPAGE_ADMIN_PANEL", "' . ((int) $_POST['perpage'] ? (int) abs($_POST['perpage']) : 30) . '");' . "\n\n"
			  . 'define("CONF_SUBSCRIPTIONS_FREE_VACANCY", "' . ((int) $_POST['free_vacancy'] ? (int) abs($_POST['free_vacancy']) : 0) . '");' . "\n\n"
			  . 'define("CONF_SUBSCRIPTIONS_FREE_RESUME", "' . ((int) $_POST['free_resume'] ? (int) abs($_POST['free_resume']) : 0) . '");' . "\n\n"
			  . 'define("CONF_SUBSCRIPTIONS_PAYMENT_DELETE", "' . ((int) $_POST['payment'] ? (int) abs($_POST['payment']) : 48) . '");' . "\n\n"
			  . 'define("CONF_SUBSCRIPTIONS_ANNOUNCE_PERIOD", "' . ((int) $_POST['announce_period'] ? (int) abs($_POST['announce_period']) : $arrSysDict['SubscriptionPeriod']['values'][0]) . '");' . "\n\n"
			  . 'define("CONF_SUBSCRIPTIONS_START_TIME", ' . $startTime . ');' . "\n";

		if (!tools::saveConfig('core/conf/const.config.subscriptions.php', $data, CONF_ADMIN_FILE . '?m=manager&s=subscriptions&action=config'))
		{
			$arrErrors[] = ERROR_FILES_MISSING_FILE;
		}
	}
}
/**
* подписки ожидающие оплату
*/
elseif ($arrActions['payment'])
{
	/**
	* Действия
	*/
	if (!empty($_POST['action']))
	{
		// удаление
		if ('del' === $_POST['action'] && !empty($_POST['subscr']))
		{
			$subscription -> delSubscriptionsById(array_keys($_POST['subscr']));

			messages::messageChangeSaved(MESSAGE_CHANGE_SAVED, false, CONF_ADMIN_FILE . '?m=manager&s=subscriptions&action=payment');
		}
		// активация
		elseif ('activate' === $_POST['action'] && !empty($_POST['subscr']))
		{
			$subscription -> updateSubscriptions(array('token' => 'active', 'token_datetime' => ''), array_keys($_POST['subscr']));

			messages::messageChangeSaved(MESSAGE_CHANGE_SAVED, false, CONF_ADMIN_FILE . '?m=manager&s=subscriptions&action=payment');
		}
	}

	// инициируем "Наименование страницы" отображаемое в форме
	$arrNamePage[] = array('name' => MENU_MANAGER_SUBSCRIPTIONS, 'link' =>  CONF_ADMIN_FILE . '?m=manager&amp;s=subscriptions');
	$arrNamePage[] = array('name' => MENU_ACTION_PAYMENT, 'link' => false);

	$offset = isset($_GET['offset']) ? (int) abs($_GET['offset']) : 0; //смещение, всегда 0 (затем берется из $_GET)
	//текущий обработанный URL
	$path = CONF_ADMIN_FILE . '?m=manager&amp;s=subscriptions&amp;action=payment&amp;';

	$arrLimit = array('strLimit' => $offset . ',' . CONF_SUBSCRIPTIONS_STRINGS_PERPAGE_ADMIN_PANEL, 'calcRows' => true);

	$arrSubscr = $subscription -> getSubscriptions("token IN ('payment')", false, $arrLimit, false);
	// формируем страницы
	$allRecords = $subscription -> cntSubscriptions(); // получаем общее количество
	$strPages = strings::generatePage($allRecords, $offset, CONF_SUBSCRIPTIONS_STRINGS_PERPAGE_ADMIN_PANEL, $path, true); // формируем странциы

	$smarty -> assignByRef('arrSubscr', $arrSubscr);
	$smarty->assignByRef('allRecords', $allRecords); //передаем в шаблон общее количество записей
	$smarty->assignByRef('strPages', $strPages); //передаем в шаблон строку сформированных страниц


	/**
	* РАБОТА СО СЛОВАРЯМИ
	*/
	// инициализация списка разделов
	$sections = new sections();
	// инициализация списка регионов
	$regions = new regions();
	// передаем массив селекта "Раздел"
	$smarty -> assign('sections', $sections -> retCategorys());
	// передаем массив селекта "Регион"
	$smarty -> assign('regions', $regions -> retCategorys());
	// если массив подписок не пустой
	// формируем списки для вывода городов и профессий
	if ($arrSubscr)
	{
		$arrProfId = array();
		$arrCitysId = array();

		foreach ($arrSubscr as $value)
		{
			($value['id_profession']) ? $arrProfId[] = $value['id_profession'] : null;
			($value['id_city']) ? $arrCitysId[] = $value['id_city'] : null;
		}

		// формируем и передаем массив необходимых профессий
		$professions = new professions();
		$smarty -> assign('professions', $professions -> retCategorysByIds($arrProfId));
		// формируем и передаем массив необходимых городов
		$citys = new citys();
		$smarty -> assign('citys', $citys -> retCategorysByIds($arrCitysId));
	}
}
/**
* подписки добавленные по объявлениям
*/
elseif ($arrActions['announce'])
{
	/**
	* Действия
	*/
	if (!empty($_POST['action']))
	{
		// удаление
		if ('del' === $_POST['action'] && !empty($_POST['subscr']))
		{
			$subscription -> delSubscriptionsById(array_keys($_POST['subscr']));

			messages::messageChangeSaved(MESSAGE_CHANGE_SAVED, false, CONF_ADMIN_FILE . '?m=manager&s=subscriptions&action=announce');
		}
	}

	/**
	* массив, который возращается в форму
	* содержит значения по умолчанию для формы отбора
	*/
	$return_data = array(
					'id_announce'		=> '',
					'id_user'			=> '',
					'type_subscription'	=> 'all',
					'id_section'		=> '',
					'id_profession'		=> '',
					'id_region'			=> '',
					'id_city'			=> ''
				);

	$strWhere = "id_announce NOT IN ('0') AND token IN ('active')";

	/**
	* отбор записей
	*/
	$arrDif = array_diff_key($return_data, $_GET); // проверяем присутствие всех значений отбора в массиве
	if (!empty($_GET['do']) && 'filter' === $_GET['do'] && empty($arrDif))
	{
		$return_data['id_announce'] = (((int) $_GET['id_announce']) > 0) ? (int) $_GET['id_announce'] : '';
		$return_data['id_user'] = (((int) $_GET['id_user']) > 0) ? (int) $_GET['id_user'] : '';
		$return_data['type_subscription'] = (string) $_GET['type_subscription'];
		$return_data['id_section'] = (((int) $_GET['id_section']) > 0) ? (int) $_GET['id_section'] : '';
		$return_data['id_profession'] = (((int) $_GET['id_profession']) > 0) ? (int) $_GET['id_profession'] : '';
		$return_data['id_region'] = (((int) $_GET['id_region']) > 0) ? (int) $_GET['id_region'] : '';
		$return_data['id_city'] = (((int) $_GET['id_city']) > 0) ? (int) $_GET['id_city'] : '';

		/**
		* Формирование данных запроса
		*/
		if ($return_data['id_announce'])
		{
			$strWhere = "id_announce IN (" . secure::escQuoteData($return_data['id_announce']) . ") AND token IN ('active')";
		}

		if ($return_data['id_user'])
		{
			$strWhere .= " AND id_user IN (" . secure::escQuoteData($return_data['id_user']) . ")";
		}

		if ('vacancy' === $return_data['type_subscription'] || 'resume' === $return_data['type_subscription'])
		{
			$strWhere .= " AND type_subscription IN (" . secure::escQuoteData($return_data['type_subscription']) . ")";
		}

		if ($return_data['id_section'])
		{
			$strWhere .= " AND id_section IN (" . secure::escQuoteData($return_data['id_section']) . ")";
		}

		if ($return_data['id_profession'])
		{
			$strWhere .= " AND id_profession IN (" . secure::escQuoteData($return_data['id_profession']) . ")";
		}

		if ($return_data['id_region'])
		{
			$strWhere .= " AND id_region IN (" . secure::escQuoteData($return_data['id_region']) . ")";
		}

		if ($return_data['id_city'])
		{
			$strWhere .= " AND id_city IN (" . secure::escQuoteData($return_data['id_city']) . ")";
		}
	}

	// инициируем "Наименование страницы" отображаемое в форме
	$arrNamePage[] = array('name' => MENU_MANAGER_SUBSCRIPTIONS, 'link' => false);
	$arrNamePage[] = array('name' => MENU_BY_ANNOUNCES, 'link' => false);

	$offset = isset($_GET['offset']) ? (int) abs($_GET['offset']) : 0; //смещение, всегда 0 (затем берется из $_GET)
	//текущий обработанный URL
	$path = CONF_ADMIN_FILE . '?m=manager&amp;s=subscriptions&amp;action=announce&amp;do=filter&amp;id_announce=' . $return_data['id_announce']
		  . '&amp;id_user=' . $return_data['id_user'] . '&amp;type_subscription=' . $return_data['type_subscription']
		  . '&amp;id_section=' . $return_data['id_section'] . '&amp;id_profession=' . $return_data['id_profession']
		  . '&amp;id_region=' . $return_data['id_region'] . '&amp;id_city=' . $return_data['id_city'] . '&amp;';

	$arrLimit = array('strLimit' => $offset . ',' . CONF_SUBSCRIPTIONS_STRINGS_PERPAGE_ADMIN_PANEL, 'calcRows' => true);

	$arrSubscr = $subscription -> getSubscriptions($strWhere, false, $arrLimit, false);
	// формируем страницы
	$allRecords = $subscription -> cntSubscriptions(); // получаем общее количество
	$strPages = strings::generatePage($allRecords, $offset, CONF_SUBSCRIPTIONS_STRINGS_PERPAGE_ADMIN_PANEL, $path, true); // формируем странциы

	$smarty -> assignByRef('arrSubscr', $arrSubscr);
	$smarty->assignByRef('allRecords', $allRecords); //передаем в шаблон общее количество записей
	$smarty->assignByRef('strPages', $strPages); //передаем в шаблон строку сформированных страниц


	/**
	* РАБОТА СО СЛОВАРЯМИ
	*/
	// инициализация списка разделов
	$sections = new sections();
	// инициализация списка регионов
	$regions = new regions();
	// передаем массив селекта "Раздел"
	$smarty -> assign('sections', $sections -> retCategorys());
	// передаем массив селекта "Регион"
	$smarty -> assign('regions', $regions -> retCategorys());
	// если массив подписок не пустой
	// формируем списки для вывода городов и профессий
	if ($arrSubscr)
	{
		$arrProfId = array();
		$arrCitysId = array();

		foreach ($arrSubscr as $value)
		{
			($value['id_profession']) ? $arrProfId[] = $value['id_profession'] : null;
			($value['id_profession_1']) ? $arrProfId[] = $value['id_profession_1'] : null;
			($value['id_profession_2']) ? $arrProfId[] = $value['id_profession_2'] : null;
			($value['id_city']) ? $arrCitysId[] = $value['id_city'] : null;
		}

		// формируем и передаем массив необходимых профессий
		$professions = new professions();
		$smarty -> assign('professions', $professions -> retCategorysByIds($arrProfId));
		// формируем и передаем массив необходимых городов
		$citys = new citys();
		$smarty -> assign('citys', $citys -> retCategorysByIds($arrCitysId));
	}

	$smarty -> assign('return_data', $return_data); // значения, возвращаемые в форму
}
/**
* подписки добавленные в кабинете польз.
*/
else
{
	/**
	* Действия
	*/
	if (!empty($_POST['action']))
	{
		// удаление
		if ('del' === $_POST['action'] && !empty($_POST['subscr']))
		{
			$subscription -> delSubscriptionsById(array_keys($_POST['subscr']));

			messages::messageChangeSaved(MESSAGE_CHANGE_SAVED, false, CONF_ADMIN_FILE . '?m=manager&s=subscriptions');
		}
	}

	/**
	* массив, который возращается в форму
	* содержит значения по умолчанию для формы отбора
	*/
	$return_data = array(
					'id_user'			=> '',
					'type_subscription'	=> 'all',
					'payment'			=> '',
					'period'			=> '',
					'id_section'		=> '',
					'id_profession'		=> '',
					'id_region'			=> '',
					'id_city'			=> ''
				);

	$strWhere = "id_announce IN ('0') AND token IN ('active')";

	/**
	* отбор записей
	*/
	$arrDif = array_diff_key($return_data, $_GET); // проверяем присутствие всех значений отбора в массиве
	if (!empty($_GET['do']) && 'filter' === $_GET['do'] && empty($arrDif))
	{
		$return_data['id_user'] = (((int) $_GET['id_user']) > 0) ? (int) $_GET['id_user'] : '';
		$return_data['type_subscription'] = (string) $_GET['type_subscription'];
		$return_data['payment'] = (string) $_GET['payment'];
		$return_data['period'] = (((int) $_GET['period']) > 0) ? (int) $_GET['period'] : '';
		$return_data['id_section'] = (((int) $_GET['id_section']) > 0) ? (int) $_GET['id_section'] : '';
		$return_data['id_profession'] = (((int) $_GET['id_profession']) > 0) ? (int) $_GET['id_profession'] : '';
		$return_data['id_region'] = (((int) $_GET['id_region']) > 0) ? (int) $_GET['id_region'] : '';
		$return_data['id_city'] = (((int) $_GET['id_city']) > 0) ? (int) $_GET['id_city'] : '';

		/**
		* Формирование данных запроса
		*/
		if ($return_data['id_user'])
		{
			$strWhere .= " AND id_user IN (" . secure::escQuoteData($return_data['id_user']) . ")";
		}

		if ('vacancy' === $return_data['type_subscription'] || 'resume' === $return_data['type_subscription'])
		{
			$strWhere .= " AND type_subscription IN (" . secure::escQuoteData($return_data['type_subscription']) . ")";
		}

		if ('yes' === $return_data['payment'] || 'no' === $return_data['payment'])
		{
			$strWhere .= " AND payment IN (" . secure::escQuoteData($return_data['payment']) . ")";
		}

		if ($return_data['period'])
		{
			$strWhere .= " AND period IN (" . secure::escQuoteData($return_data['period']) . ")";
		}

		if ($return_data['id_section'])
		{
			$strWhere .= " AND id_section IN (" . secure::escQuoteData($return_data['id_section']) . ")";
		}

		if ($return_data['id_profession'])
		{
			$strWhere .= " AND id_profession IN (" . secure::escQuoteData($return_data['id_profession']) . ")";
		}

		if ($return_data['id_region'])
		{
			$strWhere .= " AND id_region IN (" . secure::escQuoteData($return_data['id_region']) . ")";
		}

		if ($return_data['id_city'])
		{
			$strWhere .= " AND id_city IN (" . secure::escQuoteData($return_data['id_city']) . ")";
		}
	}

	$arrNamePage[] = array('name' => MENU_MANAGER_SUBSCRIPTIONS, 'link' => false);
	$arrNamePage[] = array('name' => MENU_USERS_SUBSCRIPTIONS, 'link' => false);

	$offset = isset($_GET['offset']) ? (int) abs($_GET['offset']) : 0; //смещение, всегда 0 (затем берется из $_GET)
	//текущий обработанный URL
	$path = CONF_ADMIN_FILE . '?m=manager&amp;s=subscriptions&amp;do=filter&amp;id_user=' . $return_data['id_user']
		  . '&amp;period=' . $return_data['period'] . '&amp;type_subscription=' . $return_data['type_subscription']
		  . '&amp;payment=' . $return_data['payment'] . '&amp;id_section=' . $return_data['id_section']
		  . '&amp;id_profession=' . $return_data['id_profession'] . '&amp;id_region=' . $return_data['id_region']
		  . '&amp;id_city=' . $return_data['id_city'] . '&amp;';

	$arrLimit = array('strLimit' => $offset . ',' . CONF_SUBSCRIPTIONS_STRINGS_PERPAGE_ADMIN_PANEL, 'calcRows' => true);

	$arrSubscr = $subscription -> getSubscriptions($strWhere, false, $arrLimit, false);
	// формируем страницы
	$allRecords = $subscription -> cntSubscriptions(); // получаем общее количество
	$strPages = strings::generatePage($allRecords, $offset, CONF_SUBSCRIPTIONS_STRINGS_PERPAGE_ADMIN_PANEL, $path, true); // формируем странциы

	$smarty -> assignByRef('arrSubscr', $arrSubscr);
	$smarty->assignByRef('allRecords', $allRecords); //передаем в шаблон общее количество записей
	$smarty->assignByRef('strPages', $strPages); //передаем в шаблон строку сформированных страниц


	/**
	* РАБОТА СО СЛОВАРЯМИ
	*/
	// инициализация списка разделов
	$sections = new sections();
	// инициализация списка регионов
	$regions = new regions();
	// передаем массив селекта "Раздел"
	$smarty -> assign('sections', $sections -> retCategorys());
	// передаем массив селекта "Регион"
	$smarty -> assign('regions', $regions -> retCategorys());
	// если массив подписок не пустой
	// формируем списки для вывода городов и профессий
	if ($arrSubscr)
	{
		$arrProfId = array();
		$arrCitysId = array();

		foreach ($arrSubscr as $value)
		{
			($value['id_profession']) ? $arrProfId[] = $value['id_profession'] : null;
			($value['id_city']) ? $arrCitysId[] = $value['id_city'] : null;
		}

		// формируем и передаем массив необходимых профессий
		$professions = new professions();
		$smarty -> assign('professions', $professions -> retCategorysByIds($arrProfId));
		// формируем и передаем массив необходимых городов
		$citys = new citys();
		$smarty -> assign('citys', $citys -> retCategorysByIds($arrCitysId));
	}

	$smarty -> assign('return_data', $return_data); // значения, возвращаемые в форму
}

// передаем массив селекта "Периодичность рассылки"
// он нужен нам часто, поэтому передаем его без условий
//$smarty -> assignByRef('arrSubscriptionPeriod', $arrSysDict['SubscriptionPeriod']['values']);


$smarty -> assignByRef('errors', $arrErrors);
$smarty -> assignByRef('action', $arrActions);
