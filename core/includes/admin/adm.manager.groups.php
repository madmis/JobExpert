<?php
/********************************************************
	JobExpert v1.0
	powered by Script Developers Group (SD-Group)
	email: info@sd-group.org.ua
	url: http://sd-group.org.ua/
	Copyright 2010-2015 (c) SD-Group
	All rights reserved
=========================================================
	Менеджер - Группы
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
						array('name' => MENU_MANAGER_GROUPS, 'link' => false)
					);

$group = new group();

/**
* иницализация массива подключаемых шаблонов: по умолчанию все значения - false
* для подключения шаблона, необходимо установить значение - true
* шаблоны подключаются в порядке установленном в файле головного шаблона adm.manager.groups.tpl
*/
$arrAction = array(
						'config'	=> false,
						'edit'		=> false
                    );

/**
* Добавление группы
*/
if (isset($_POST['arrBindFields']['id']) && $_POST['arrBindFields']['id'])
{
	if (!ctype_alpha($_POST['arrBindFields']['id']))
	{
		$arrErrors[] = ERROR_GROUP_ALPHA;
	}

	if ($group -> issetGroup($_POST['arrBindFields']['id']))
	{
		$arrErrors[] = ERROR_GROUP_EXISTS;
	}

	if (!$arrErrors)
	{
		// присваеваем полученные данные объекту
		$_POST['arrBindFields']['id'] = strtolower($_POST['arrBindFields']['id']);
		$group -> arrBindFields = $_POST['arrBindFields'];

		// производим запись в таблицу БД
		(!$group -> recGroup()) ? $arrErrors[] = (db::$message_error ? db::$message_error : ERROR_MISMATCH_FIELDS) : messages::messageChangeSaved(MESSAGE_GROUP_ADD, false, CONF_ADMIN_FILE . '?m=manager&s=groups');
	}
}

/**
* Редактирование прав группы
*/
if (isset($_GET['action']))
{
	/**
	* настройки групп, типов и прав
	*/
	if ('config' === $_GET['action'])
	{
		// инициируем "Наименование страницы" отображаемое в форме
		$arrNamePage = array(
								array('name' => MENU_ADMIN_MAIN, 'link' => CONF_ADMIN_FILE),
								array('name' => MENU_MANAGER, 'link' => false),
								array('name' => MENU_MANAGER_GROUPS, 'link' => CONF_ADMIN_FILE . '?m=manager&amp;s=groups'),
								array('name' => MENU_CONFIG, 'link' => false)
							);

		if (isset($_POST['save'])) // сохраняем данные, переданные из формы
		{
			$data = "<?php\n\n"
				  . "(!defined('SDG')) ? die ('Triple protection!') : null;\n\n"
				  . 'define("CONF_COMPETITOR_REGISTER_DEFAULT_GROUP", "' . htmlspecialchars($_POST['competitor_group'], ENT_QUOTES, CONF_DEFAULT_CHARSET) . '");' . "\n\n"
				  . 'define("CONF_EMPLOYER_REGISTER_DEFAULT_GROUP", "' . htmlspecialchars($_POST['employer_group'], ENT_QUOTES, CONF_DEFAULT_CHARSET) . '");' . "\n\n"
				  . 'define("CONF_AGENT_REGISTER_DEFAULT_GROUP", "' . htmlspecialchars($_POST['agent_group'], ENT_QUOTES, CONF_DEFAULT_CHARSET) . '");' . "\n\n"
				  . 'define("CONF_COMPANY_REGISTER_DEFAULT_GROUP", "' . htmlspecialchars($_POST['company_group'], ENT_QUOTES, CONF_DEFAULT_CHARSET) . '");' . "\n\n"
				  . 'define("CONF_TYPE_GUEST_RIGHT_ADD_VACANCY", "' . ((!isset($_POST['add_vacancy'])) ? false : true) . '");' . "\n\n"
				  . 'define("CONF_TYPE_GUEST_RIGHT_ADD_RESUME", "' . ((!isset($_POST['add_resume'])) ? false : true) . '");' . "\n";

			if (!tools::saveConfig('core/conf/const.config.groups.php', $data, CONF_ADMIN_FILE . '?m=manager&s=groups&action=config'))
			{
				$arrErrors[] = ERROR_FILES_MISSING_FILE;
			}
		}

		$arrAction['config'] = true;
	}

	/**
	* изменение прав группы
	*/
	elseif ('edit' === $_GET['action'] && isset($_GET['id']) && $_GET['id'] && $group -> issetGroup($_GET['id']))
	{
		// инициируем "Наименование страницы" отображаемое в форме
		$arrNamePage = array(
								array('name' => MENU_ADMIN_MAIN, 'link' => CONF_ADMIN_FILE),
								array('name' => MENU_MANAGER, 'link' => false),
								array('name' => MENU_MANAGER_GROUPS, 'link' => CONF_ADMIN_FILE . '?m=manager&amp;s=groups'),
								array('name' => MENU_ACTION_EDIT, 'link' => false)
							);

		// обновляем права и обязанности группы
		if (isset($_POST['save']))
		{
			$_POST['id'] = strtolower($_POST['id']);

			(!$group -> updateGroup($_POST)) ? $arrErrors[] = (db::$message_error ? db::$message_error : ERROR_MISMATCH_FIELDS) : messages::messageChangeSaved(MESSAGE_CHANGE_SAVED, false, CONF_ADMIN_FILE . '?m=manager&s=groups&action=edit&id=' . $_POST['id']);
		}
		elseif (isset($_POST['delete']))
		{
			$_POST['id'] = strtolower($_POST['id']);
			
			// проверяем, можно ли удалять эту группу
			if ('guest' === $_POST['id'] || 'user' === $_POST['id'])
			{
				$arrErrors[] = ERROR_GROUP_SYSTEM_NOT_DELETE;
			}
			elseif (CONF_COMPETITOR_REGISTER_DEFAULT_GROUP == $_POST['id'] || CONF_EMPLOYER_REGISTER_DEFAULT_GROUP == $_POST['id'] || CONF_AGENT_REGISTER_DEFAULT_GROUP == $_POST['id'] || CONF_COMPANY_REGISTER_DEFAULT_GROUP == $_POST['id'])
			{
				$arrErrors[] = ERROR_GROUP_USED_IN_CONFIG;
			}
			elseif ($group -> issetUserGroup($_POST['id']))
			{
				$arrErrors[] = ERROR_GROUP_SET_IN_USER;
			}
			else
			{
				(!$group -> deleteGroup($_POST['id'])) ? $arrErrors[] = db::$message_error : messages::messageChangeSaved(MESSAGE_GROUP_DELETE, false, CONF_ADMIN_FILE . '?m=manager&s=groups');
			}
		}

		$smarty -> assign('arrGroup', $group -> getGroup($_GET['id']));
		$arrAction['edit'] = true;		
	}
}

//$smarty -> assign('arrGroups', $group -> getAllGroups("token='active'", false));
$smarty -> assign('arrGroups', $group -> getGroupsAndResp());

$smarty -> assignByRef('errors', $arrErrors);
$smarty -> assignByRef('action', $arrAction);
