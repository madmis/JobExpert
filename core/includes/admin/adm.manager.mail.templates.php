<?php
/********************************************************
	powered by Script Developers Group (SD-Group)
	email: info@sd-group.org.ua
	url: http://sd-group.org.ua/
	Copyright 2009 (c) SD-Group
	All rights reserved
=========================================================
	Менеджер - Шаблоны сообщений
********************************************************/

(!defined('SDG')) ? die ('Triple protection!') : null;

// инициируем "Наименование страницы" отображаемое в форме
$arrNamePage = array(
						array('name' => MENU_ADMIN_MAIN, 'link' => CONF_ADMIN_FILE),
						array('name' => MENU_MANAGER, 'link' => false)
					);

// массив существующих шаблонов писем ОБЩИЕ
$arrMailsGeneral = array (
						'html'							=> HELP_ADMIN_MAIL_TEMPLATE_HTML,
						'news.comments.complaint'		=> HELP_ADMIN_MAIL_TEMPLATE_NEWS_COMMENTS_COMPLAINT,
						'articles.comments.complaint'	=> HELP_ADMIN_MAIL_TEMPLATE_ARTICLES_COMMENTS_COMPLAINT,
					);

// массив существующих шаблонов писем АДМИНИСТРАТОРА
$arrMailsAdministrator = array (
						'adm.add.announce'			=> HELP_ADMIN_MAIL_TEMPLATE_ADM_ADD_ANNOUNCE,
						'adm.edited.announce'		=> HELP_ADMIN_MAIL_TEMPLATE_ADM_EDITED_ANNOUNCE,
						'adm.moderate.announce'		=> HELP_ADMIN_MAIL_TEMPLATE_ADM_MODERATE_ANNOUNCE,
						'adm.add.article'			=> HELP_ADMIN_MAIL_TEMPLATE_ADM_ADD_ARTICLE,
						'adm.edited.article'		=> HELP_ADMIN_MAIL_TEMPLATE_ADM_EDITED_ARTICLE,
						'adm.moderate.article'		=> HELP_ADMIN_MAIL_TEMPLATE_ADM_MODERATE_ARTICLE,
						'adm.add.news'				=> HELP_ADMIN_MAIL_TEMPLATE_ADM_ADD_NEWS,
						'adm.edited.news'			=> HELP_ADMIN_MAIL_TEMPLATE_ADM_EDITED_NEWS,
						'adm.moderate.news'			=> HELP_ADMIN_MAIL_TEMPLATE_ADM_MODERATE_NEWS,
						'adm.payment'				=> HELP_ADMIN_MAIL_TEMPLATE_ADM_PAYMENT,
						'adm.payment.hand.add'		=> HELP_ADMIN_MAIL_TEMPLATE_ADM_PAYMENT_HAND_ADD,
						'adm.payment.jur.add'		=> HELP_ADMIN_MAIL_TEMPLATE_ADM_PAYMENT_JUR_ADD,
						'adm.reg.user'				=> HELP_ADMIN_MAIL_TEMPLATE_ADM_REG_USER
					);


// массив существующих шаблонов писем ПОЛЬЗОВАТЕЛЕЙ
$arrMailsUsers = array (
						'announce.subscription'		=> HELP_ADMIN_MAIL_TEMPLATE_ANNOUNCE_SUBSCRIPTION,
						'announce.user.activate'	=> HELP_ADMIN_MAIL_TEMPLATE_ANNOUNCE_ACTIVATE,
						'announce.user.added'		=> HELP_ADMIN_MAIL_TEMPLATE_ANNOUNCE_ADDED,
						'announce.user.correction'	=> HELP_ADMIN_MAIL_TEMPLATE_ANNOUNCE_CORRECTION,
						'announce.user.deleted'		=> HELP_ADMIN_MAIL_TEMPLATE_ANNOUNCE_DELETED,
						'announce.user.moderate'	=> HELP_ADMIN_MAIL_TEMPLATE_ANNOUNCE_MODERATE,
						'announce.user.payment'		=> HELP_ADMIN_MAIL_TEMPLATE_ANNOUNCE_PAYMENT,
						'announce.user.vip.reset'	=> HELP_ADMIN_MAIL_TEMPLATE_ANNOUNCE_VIP_RESET,
						'announce.user.hot.reset'	=> HELP_ADMIN_MAIL_TEMPLATE_ANNOUNCE_HOT_RESET,
						'new.pass.confirm'			=> HELP_ADMIN_MAIL_TEMPLATE_NEW_PASS_CONFIRM,
						'new.pass'					=> HELP_ADMIN_MAIL_TEMPLATE_NEW_PASS,
						'moderate.news'				=> HELP_ADMIN_MAIL_TEMPLATE_MODERATE_NEWS,
						'user.add.admin'			=> HELP_ADMIN_MAIL_TEMPLATE_USER_ADD_ADMIN,
						'user.activate'				=> HELP_ADMIN_MAIL_TEMPLATE_USER_ACTIVATE,
						'user.activate.admin'		=> HELP_ADMIN_MAIL_TEMPLATE_USER_ACTIVATE_ADMIN,
						'user.moderate'				=> HELP_ADMIN_MAIL_TEMPLATE_USER_MODERATE,
						'user.not.moderate'			=> HELP_ADMIN_MAIL_TEMPLATE_USER_NOT_MODERATE,
						'user.register'				=> HELP_ADMIN_MAIL_TEMPLATE_USER_REGISTER,
						'payment.hand.message'		=> HELP_ADMIN_MAIL_TEMPLATE_PAYMENT_HAND_MESAGE,
						'payment.jur.message'		=> HELP_ADMIN_MAIL_TEMPLATE_PAYMENT_JUR_MESAGE,
						'user.article.active'		=> HELP_ADMIN_MAIL_TEMPLATE_USER_ARTICLE_ACTIVE,
						'user.article.correction'	=> HELP_ADMIN_MAIL_TEMPLATE_USER_ARTICLE_CORRECTION,
						'user.article.deleted'		=> HELP_ADMIN_MAIL_TEMPLATE_USER_ARTICLE_DELETED,
						'user.news.active'			=> HELP_ADMIN_MAIL_TEMPLATE_USER_NEWS_ACTIVE,
						'user.news.correction'		=> HELP_ADMIN_MAIL_TEMPLATE_USER_NEWS_CORRECTION,
						'user.news.deleted'			=> HELP_ADMIN_MAIL_TEMPLATE_USER_NEWS_DELETED,
					);

$list = false; //переменная определяет, с каким списком файлов мы сейчас работаем
$arrFiles = array();

$selects = (isset($_POST['langDict'])) ? new selects($_POST['langDict']) : new selects();
$currLang = $selects -> retCurrLang();
$smarty -> assignByRef('currLang', $currLang); // текущая локализация

// путь к файлам шаблонов писем
$path = filesys::setPath(CONF_ROOT_DIR) . 'lang/' . $currLang . '/mails/';

/**
* проверяем, каие шаблоны выводить
*/
if (isset($_GET['list']) && ('general' === $_GET['list'] || 'administrator' === $_GET['list'] || 'users' === $_GET['list']))
{
	if ('general' === $_GET['list'])
	{
		$arrMails = $arrMailsGeneral;
		$name_page = MENU_MANAGER_MAIL_TEMPLATES_GENERAL;
	}
	elseif ('administrator' === $_GET['list'])
	{
		$arrMails = $arrMailsAdministrator;
		$name_page = MENU_MANAGER_MAIL_TEMPLATES_ADMINISTRATOR;
	}
	elseif ('users' === $_GET['list'])
	{
		$arrMails = $arrMailsUsers;
		$name_page = MENU_MANAGER_MAIL_TEMPLATES_USERS;
	}

	$list = '&amp;list=' . $_GET['list'];

	// инициируем "Наименование страницы" отображаемое в форме
	$arrNamePage[] = array('name' => MENU_MANAGER_MAIL_TEMPLATES, 'link' => CONF_ADMIN_FILE . '?m=manager&s=mail.templates');
	$arrNamePage[] = array('name' => $name_page, 'link' => false);
}
else
{
	// инициируем "Наименование страницы" отображаемое в форме
	$arrNamePage[] = array('name' => MENU_MANAGER_MAIL_TEMPLATES, 'link' => false);
	// массив существующих шаблонов писем
	$arrMails = $arrMailsGeneral + $arrMailsAdministrator + $arrMailsUsers;
}

/* Переделано на Ajax
if (!empty($_POST['file']) && !empty($_POST['fText'])) // проверяем, передан ли массив $_POST
{
	$file = str_replace('_', '.', $_POST['file']); // формируем имя файла

	// если ключ из массива $_POST существует в масиве существующих шаблонов, изменяем такой файл
	if (array_key_exists($file, $arrMails) && @file_exists($path . $file . '.txt'))
	{
		if (!file_put_contents($path . $file . '.txt', str_replace('href="/', 'href="', $_POST['fText'])))// если файл записан
		{
        	messages::printDie(ERROR_FILE_NOT_WRITE);
		}
		else // если не удалось записать в файл
		{
			messages::messageChangeSaved(MESSAGE_CHANGE_SAVED, false, CONF_ADMIN_FILE . '?m=manager&s=mail.templates' . $list);
		}
	}	
	else // если не удалось открыть файл
	{
		messages::printDie(ERROR_CRITICAL_FILE_NOT_EXISTS);
	}
}
*/

/**
* проходим по массиву, и передаем текст из существующих файлов, или ошибку несуществующих
*/
foreach ($arrMails as $key => $value)
{
	$file = $path . strtolower($key) . '.txt';
	$arrFiles[] = array(
				'exists'		=> (@file_exists($file)) ? true : false,
				'name' 			=> $key,
				'id' 			=> str_replace('.', '_', $key), // формируем id для html
				'text'			=> (@file_exists($file)) ? file_get_contents($file) : '',
				'description' 	=> $value
			);						
}

// получаем список доступных дирректорий шаблонов
$langs = $selects -> retLangs();
$smarty -> assignByRef('langs', $langs); // список доступных локализаций

$smarty -> assignByRef('list', $list);
$smarty -> assignByRef('files', $arrFiles);
$smarty -> assignByRef('pathMailTemplates', $path);
