<?php
/********************************************************
	powered by Script Developers Group (SD-Group)
	email: info@sd-group.org.ua
	url: http://sd-group.org.ua/
	Copyright 2009 (c) SD-Group
	All rights reserved
=========================================================
					Eng - Mail
     (in this file contains the message topic)
    (text templates are stored in the mail)
********************************************************/

(!defined('SDG')) ? die ('Triple protection!') : null;

/***** СОСТОЯНИЯ НОВОСТЕЙ ПОСЛЕ МОДЕРАЦИИ *****/
define('MAIL_SUBJ_MODERATE_NEWS', 'Moderation news');

define('MAIL_MODERATE_NEWS_DELETED', 'The news has not passed moderation, and was removed');

define('MAIL_MODERATE_NEWS_ACTIVATED', 'The news has been successfully moderated');

define('MAIL_MODERATE_NEWS_CORRECTION', 'The news sent for editing');

define('MAIL_MODERATE_NEWS_COMMENTS', 'No comments');

define('MAIL_MODERATE_NEWS_DELETE_DATE', 'If you do not correct the news, it will be automatically deleted: ');

/***** СТАТЬИ *****/
define('MAIL_MODERATE_ARTICLES_DELETED', 'The article did not pass moderation, and was removed');

define('MAIL_MODERATE_ARTICLES_CORRECTION', 'The article is returned to the editing');

define('MAIL_MODERATE_ARTICLES_ACTIVE', 'The article has successfully passed the moderation');

/***** ПОЛЬЗОВАТЕЛИ *****/
define('MAIL_SUBJ_ADM_USER_ACTIVATE', 'Your account has been activated by the administrator!');

define('MAIL_SUBJ_ADM_USER_NO_MODERATE', 'Your account has not passed moderation, and was removed by the administrator!');

define('MAIL_SUBJ_ADM_USER_MODERATE', 'You have successfully passed the moderation!');

define('MAIL_SUBJ_ADM_USER_ADD', 'Your account has been added to the site');

define('MAIL_ANNOUNCE_TYPE_VACANCY', 'Vacancy');

define('MAIL_ANNOUNCE_TYPE_RESUME', 'Resume');

define('MAIL_SUBJ_NEW_ANNOUNCE', 'New announce: ');

define('MAIL_SUBJ_NEW_ANNOUNCE_PAYMENT', 'Payment for announce: ');

define('MAIL_SUBJ_NEW_ANNOUNCE_CORRECTION', 'Necessary to amend the announce: ');

define('MAIL_SUBJ_NEW_ANNOUNCE_DELETED', 'Your announce removed: ');

define('MAIL_DEFAULT_COMMENTS', 'Announce does not comply with the site.');

define('MAIL_COMMENTS_STORAGE_LIFE_OVER', 'Term expired announce.');
