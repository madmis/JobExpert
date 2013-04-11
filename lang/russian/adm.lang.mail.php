<?php
/********************************************************
	powered by Script Developers Group (SD-Group)
	email: info@sd-group.org.ua
	url: http://sd-group.org.ua/
	Copyright 2009 (c) SD-Group
	All rights reserved
=========================================================
					Русский язык - Почта
			(в данном файле хранятся темы сообщений)
			(тексты шаблонов хранятся в папке mail)
********************************************************/

(!defined('SDG')) ? die ('Triple protection!') : null;

/***** СОСТОЯНИЯ НОВОСТЕЙ ПОСЛЕ МОДЕРАЦИИ *****/
define('MAIL_SUBJ_MODERATE_NEWS', 'Модерация новости');

define('MAIL_MODERATE_NEWS_DELETED', 'Новость не прошла модерацию и была удалена');

define('MAIL_MODERATE_NEWS_ACTIVATED', 'Новость успешно прошла модерацию');

define('MAIL_MODERATE_NEWS_CORRECTION', 'Новость отправлена на редактирование');

define('MAIL_MODERATE_NEWS_COMMENTS', 'Без примечания');

define('MAIL_MODERATE_NEWS_DELETE_DATE', 'Если Вы не исправите новость, она будет автоматически удалена: ');

/***** СТАТЬИ *****/
define('MAIL_MODERATE_ARTICLES_DELETED', 'Статья не прошла модерацию и была удалена');

define('MAIL_MODERATE_ARTICLES_CORRECTION', 'Статья возвращена на редактирование');

define('MAIL_MODERATE_ARTICLES_ACTIVE', 'Статья успешно прошла модерацию');

/***** ПОЛЬЗОВАТЕЛИ *****/
define('MAIL_SUBJ_ADM_USER_ACTIVATE', 'Ваша учетная запись активирована администратором!');

define('MAIL_SUBJ_ADM_USER_NO_MODERATE', 'Ваша учетная запись не прошла модерацию и была удалена администратором!');

define('MAIL_SUBJ_ADM_USER_MODERATE', 'Вы успешно прошли модерацию!');

define('MAIL_SUBJ_ADM_USER_ADD', 'Ваша учетная запись добавлена на сайте');

define('MAIL_ANNOUNCE_TYPE_VACANCY', 'Вакансия');

define('MAIL_ANNOUNCE_TYPE_RESUME', 'Резюме');

define('MAIL_SUBJ_NEW_ANNOUNCE', 'Новое объявление: ');

define('MAIL_SUBJ_NEW_ANNOUNCE_PAYMENT', 'Оплата размещения объявления: ');

define('MAIL_SUBJ_NEW_ANNOUNCE_CORRECTION', 'Необходимо внести исправления в объявление: ');

define('MAIL_SUBJ_NEW_ANNOUNCE_DELETED', 'Ваше объявление удалено: ');

define('MAIL_DEFAULT_COMMENTS', 'Объявление не соответствует правилам сайта.');

define('MAIL_COMMENTS_STORAGE_LIFE_OVER', 'Срок размещения объявления истек.');
