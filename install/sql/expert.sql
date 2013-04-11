--
-- Структура таблицы `%DB_PREFIX%articles`
--

CREATE TABLE `%DB_PREFIX%articles` (
  `id` smallint(5) unsigned NOT NULL auto_increment,
  `title` varchar(255) NOT NULL default '',
  `small_text` text NOT NULL,
  `text` text NOT NULL,
  `meta_keywords` varchar(255) NOT NULL default '',
  `meta_description` text NOT NULL,
  `id_section` tinyint(3) unsigned NOT NULL default '0',
  `id_user` mediumint(9) unsigned NOT NULL default '0',
  `author` varchar(100) NOT NULL default '',
  `comments` text NOT NULL,
  `rating` tinyint(4) unsigned NOT NULL default '0',
  `votes` tinyint(4) unsigned NOT NULL default '0',
  `ip_last` varchar(15) NOT NULL,
  `noComments` tinyint(1) unsigned NOT NULL default '0' COMMENT 'Признак доступности  добавления комментариев пользователями',
  `datetime` datetime NOT NULL default '0000-00-00 00:00:00',
  `token` enum('active','archived','reserved','deleted','moderate','new','correction') NOT NULL default 'new',
  `token_datetime` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=%DB_CHARSET%;

-- --------------------------------------------------------

--
-- Структура таблицы `%DB_PREFIX%articles_comments`
--

CREATE TABLE `%DB_PREFIX%articles_comments` (
  `id` mediumint(8) unsigned NOT NULL auto_increment COMMENT 'ID комментария',
  `id_parent` mediumint(8) unsigned NOT NULL default '0' COMMENT 'ID родительского комментария',
  `id_article` int(5) unsigned NOT NULL COMMENT 'ID статьи',
  `id_user` mediumint(8) unsigned NOT NULL default '0' COMMENT 'ID пользователя',
  `name` varchar(100) NOT NULL COMMENT 'Имя пользователя. Для зарегистрированных подставляется alias',
  `ip` varchar(39) NOT NULL COMMENT 'IP-адрес пользователя',
  `text` text NOT NULL COMMENT 'Текст комментария',
  `datetime` datetime NOT NULL default '0000-00-00 00:00:00' COMMENT 'Дата и время добавления комментария',
  `token` enum('new','active','archived','moderate','reserved','deleted') NOT NULL default 'active' COMMENT 'Токен комментария',
  `token_datetime` datetime NOT NULL default '0000-00-00 00:00:00' COMMENT 'Время действия токена',
  PRIMARY KEY  (`id`),
  KEY `id_parent` (`id_parent`,`id_article`,`id_user`)
) ENGINE=MyISAM  DEFAULT CHARSET=%DB_CHARSET%;

-- --------------------------------------------------------

--
-- Структура таблицы `%DB_PREFIX%articles_sections`
--

CREATE TABLE `%DB_PREFIX%articles_sections` (
  `id` tinyint(3) unsigned NOT NULL auto_increment,
  `name` varchar(255) NOT NULL default '',
  `affiliation` enum('none','employer','competitor') NOT NULL default 'none',
  `sort` tinyint(3) unsigned NOT NULL default '0',
  `token` enum('active','archived','reserved','deleted','moderate','new') NOT NULL default 'new',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=%DB_CHARSET%;

-- --------------------------------------------------------

--
-- Структура таблицы `%DB_PREFIX%conf_users`
--

CREATE TABLE `%DB_PREFIX%conf_users` (
  `id` mediumint(8) unsigned NOT NULL default '0',
  `user_type` varchar(32) NOT NULL default 'user',
  `user_group` varchar(32) NOT NULL default 'user',
  `addition_phone_1` varchar(25) NOT NULL default '',
  `addition_phone_2` varchar(25) NOT NULL default '',
  `mailer_subscribe` tinyint(1) unsigned NOT NULL default '0' COMMENT 'Признак подписки на почтовые сообщения сайта',
  `company_name` varchar(250) NOT NULL,
  `company_city` varchar(250) NOT NULL,
  `company_url` varchar(250) NOT NULL,
  `company_description` text NOT NULL,
  `logo` varchar(150) NOT NULL,
  `main_logo` tinyint(1) unsigned NOT NULL default '0' COMMENT 'Признак вывода логотипа на главной (можно использовать и как сортировку)',
  `sort_logo` tinyint(3) unsigned NOT NULL default '0' COMMENT 'Сортировка логотипов на главной',
  `hide_additional_company_data` tinyint(1) unsigned NOT NULL default '0' COMMENT 'Настройка, позволяющая скрыть фамилию, имя и телефон компании',
  `token` enum('active','archived','reserved','deleted','moderate','payment','new') NOT NULL default 'new',
  PRIMARY KEY  (`id`),
  KEY `mailer_subscribe` (`mailer_subscribe`)
) ENGINE=MyISAM DEFAULT CHARSET=%DB_CHARSET%;

-- --------------------------------------------------------

--
-- Структура таблицы `%DB_PREFIX%groups`
--

CREATE TABLE `%DB_PREFIX%groups` (
  `index` tinyint(4) unsigned NOT NULL auto_increment,
  `id` varchar(32) NOT NULL default '',
  `edit_vacancy` tinyint(3) unsigned NOT NULL default '0',
  `del_vacancy` tinyint(3) unsigned NOT NULL default '0',
  `edit_resume` tinyint(3) unsigned NOT NULL default '0',
  `del_resume` tinyint(3) unsigned NOT NULL default '0',
  `add_articles` tinyint(3) unsigned NOT NULL default '0',
  `edit_articles` tinyint(3) unsigned NOT NULL default '0',
  `arc_articles` tinyint(3) unsigned NOT NULL default '0',
  `del_articles` tinyint(3) unsigned NOT NULL default '0',
  `add_news` tinyint(3) unsigned NOT NULL default '0',
  `edit_news` tinyint(3) unsigned NOT NULL default '0',
  `arc_news` tinyint(3) unsigned NOT NULL default '0',
  `del_news` tinyint(3) unsigned NOT NULL default '0',
  `token` enum('active','archived','reserved','deleted','moderate','new') NOT NULL default 'active',
  PRIMARY KEY  (`index`),
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=%DB_CHARSET%;

-- --------------------------------------------------------

--
-- Структура таблицы `%DB_PREFIX%groups_resp`
--

CREATE TABLE `%DB_PREFIX%groups_resp` (
  `index` tinyint(4) unsigned NOT NULL auto_increment,
  `id` varchar(32) NOT NULL default '',
  `moder_account` tinyint(3) unsigned NOT NULL default '0',
  `act_vacancy` tinyint(3) unsigned NOT NULL default '0',
  `act_resume` tinyint(3) unsigned NOT NULL default '0',
  `moder_vacancy` tinyint(3) unsigned NOT NULL default '0',
  `moder_resume` tinyint(3) unsigned NOT NULL default '0',
  `moder_articles` tinyint(3) unsigned NOT NULL default '0',
  `moder_news` tinyint(3) unsigned NOT NULL default '0',
  `token` enum('active','archived','reserved','deleted','moderate','new') NOT NULL default 'active',
  PRIMARY KEY  (`index`),
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=%DB_CHARSET%;

-- --------------------------------------------------------

--
-- Структура таблицы `%DB_PREFIX%mods`
--

CREATE TABLE `%DB_PREFIX%mods` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Id',
  `name` varchar(50) NOT NULL COMMENT 'Имя мода (соответствует названию каталога мода))',
  `description` text NOT NULL COMMENT 'Описание мода',
  `token` enum('active','disabled','reserved','deleted') NOT NULL DEFAULT 'disabled' COMMENT 'Токен (состояние) записи',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  KEY `token` (`token`)
) ENGINE=MyISAM  DEFAULT CHARSET=%DB_CHARSET% COMMENT='Таблица модов скрипта';

-- --------------------------------------------------------

--
-- Структура таблицы `%DB_PREFIX%news`
--

CREATE TABLE `%DB_PREFIX%news` (
  `id` smallint(5) unsigned NOT NULL auto_increment,
  `title` varchar(255) NOT NULL default '',
  `small_text` text NOT NULL,
  `text` text NOT NULL,
  `meta_keywords` varchar(255) NOT NULL default '',
  `meta_description` text NOT NULL,
  `datetime` datetime NOT NULL default '0000-00-00 00:00:00',
  `token` enum('active','archived','reserved','deleted','moderate','new','correction') NOT NULL default 'new',
  `token_datetime` datetime NOT NULL default '0000-00-00 00:00:00',
  `id_user` mediumint(9) unsigned NOT NULL default '0',
  `author` varchar(100) NOT NULL default '',
  `noComments` tinyint(1) unsigned NOT NULL default '0' COMMENT 'Признак доступности  добавления комментариев пользователями',
  `comments` text NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=%DB_CHARSET%;

-- --------------------------------------------------------

--
-- Структура таблицы `%DB_PREFIX%news_comments`
--

CREATE TABLE `%DB_PREFIX%news_comments` (
  `id` mediumint(8) unsigned NOT NULL auto_increment COMMENT 'ID комментария',
  `id_parent` mediumint(8) unsigned NOT NULL default '0' COMMENT 'ID родительского комментария',
  `id_news` smallint(5) unsigned NOT NULL COMMENT 'ID новости',
  `id_user` mediumint(8) unsigned NOT NULL default '0' COMMENT 'ID пользователя',
  `name` varchar(100) NOT NULL COMMENT 'Имя пользователя. Для зарегистрированных подставляется alias',
  `ip` varchar(39) NOT NULL COMMENT 'IP-адрес пользователя',
  `text` text NOT NULL COMMENT 'Текст комментария',
  `datetime` datetime NOT NULL default '0000-00-00 00:00:00' COMMENT 'Дата и время добавления комментария',
  `token` enum('new','active','archived','moderate','reserved','deleted') NOT NULL default 'active' COMMENT 'Токен комментария',
  `token_datetime` datetime NOT NULL default '0000-00-00 00:00:00' COMMENT 'Время действия токена',
  PRIMARY KEY  (`id`),
  KEY `id_parent` (`id_parent`,`id_news`,`id_user`)
) ENGINE=MyISAM  DEFAULT CHARSET=%DB_CHARSET%;

-- --------------------------------------------------------

--
-- Структура таблицы `%DB_PREFIX%pages`
--

CREATE TABLE `%DB_PREFIX%pages` (
  `id` varchar(30) NOT NULL default '',
  `title` varchar(100) NOT NULL default '',
  `text` text NOT NULL,
  `meta_keywords` varchar(255) NOT NULL default '',
  `meta_description` text NOT NULL,
  `token` enum('active','archived','reserved','deleted','moderate','new') NOT NULL default 'new',
  `sort` tinyint(3) unsigned NOT NULL default '0',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=%DB_CHARSET%;

-- --------------------------------------------------------

--
-- Структура таблицы `%DB_PREFIX%payments_logs`
--

CREATE TABLE `%DB_PREFIX%payments_logs` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `order_id` int(11) unsigned NOT NULL,
  `payment_type` varchar(30) NOT NULL default 'undefined' COMMENT 'Выбранный тип оплаты (тип платежной системы)',
  `status` varchar(20) NOT NULL default 'undefined' COMMENT 'Статус платежа (пока есть: SUCCESS, FAIL. В ликпее есть еще какой-то, типа оплата в обработке, но здесь я его вроде не вставляю)',
  `data` text NOT NULL,
  `date` datetime NOT NULL default '0000-00-00 00:00:00',
  `token` enum('active','reserved','deleted') NOT NULL default 'active',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=%DB_CHARSET%;

-- --------------------------------------------------------

--
-- Структура таблицы `%DB_PREFIX%payments_mods`
--

CREATE TABLE `%DB_PREFIX%payments_mods` (
  `id` varchar(150) NOT NULL default '',
  `title` varchar(200) NOT NULL COMMENT 'Заголовок платежного мода',
  `description` text NOT NULL COMMENT 'Описание платежного мода',
  `token` enum('active','disabled','reserved','deleted') NOT NULL default 'disabled',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=%DB_CHARSET%;

-- --------------------------------------------------------

--
-- Структура таблицы `%DB_PREFIX%payments_mod_hand`
--

CREATE TABLE `%DB_PREFIX%payments_mod_hand` (
  `id` int(10) unsigned NOT NULL auto_increment COMMENT 'ID оплаты',
  `order_id` int(11) unsigned NOT NULL COMMENT 'Номер оплаты в системе',
  `action` varchar(20) NOT NULL COMMENT 'Действие, которое необходимо выполнить',
  `user_id` mediumint(8) unsigned NOT NULL COMMENT 'ID пользователя, совершившего оплату',
  `record_id` mediumint(8) unsigned NOT NULL COMMENT 'ID записи в таблице БД, скотрой нужно выполнить действие',
  `amount` decimal(5,2) unsigned NOT NULL COMMENT 'Сумма оплаты',
  `currency` varchar(3) NOT NULL COMMENT 'Валюта оплаты',
  `payment_type` varchar(30) NOT NULL COMMENT 'Выбранный тип оплаты (определены в файле настроек мода hand )',
  `message` text NOT NULL COMMENT 'Сообщение пользователю',
  `datetime` datetime NOT NULL default '0000-00-00 00:00:00' COMMENT 'Дата добавления записи в таблицу',
  `token` enum('active','processing','reserved','deleted') NOT NULL default 'active' COMMENT 'Токен записи',
  PRIMARY KEY  (`id`),
  KEY `order_id` (`order_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=%DB_CHARSET%;

-- --------------------------------------------------------

--
-- Структура таблицы `%DB_PREFIX%payments_mod_jur`
--

CREATE TABLE `%DB_PREFIX%payments_mod_jur` (
  `id` int(10) unsigned NOT NULL auto_increment COMMENT 'ID записи',
  `order_id` int(11) unsigned NOT NULL COMMENT 'Номер оплаты в системе',
  `user_id` mediumint(8) unsigned NOT NULL COMMENT 'ID пользователя, совершившего оплату',
  `action` varchar(20) NOT NULL COMMENT 'Действие, которое необходимо выполнить',
  `record_id` mediumint(8) unsigned NOT NULL COMMENT 'ID записи в таблице, с которой нужно выполнить действие',
  `amount` decimal(5,2) unsigned NOT NULL COMMENT 'Сумма оплаты',
  `data` text NOT NULL COMMENT 'Дополнительные данные платежа',
  `message` text NOT NULL COMMENT 'Сообщение пользователю',
  `datetime` datetime NOT NULL default '0000-00-00 00:00:00' COMMENT 'Дата добавления записи в таблицу',
  `token` enum('active','processing','reserved','deleted') NOT NULL default 'active' COMMENT 'Токен записи',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `order_id` (`order_id`)
) ENGINE=MyISAM DEFAULT CHARSET=%DB_CHARSET% COMMENT='Таблица платежей при помощи мода JUR';

-- --------------------------------------------------------

--
-- Структура таблицы `%DB_PREFIX%profession`
--

CREATE TABLE `%DB_PREFIX%profession` (
  `id` smallint(5) unsigned NOT NULL auto_increment,
  `parent_id` tinyint(3) unsigned NOT NULL default '0',
  `name` varchar(150) NOT NULL default '',
  `sort` tinyint(3) unsigned NOT NULL default '0',
  `title` varchar(255) NOT NULL default '' COMMENT 'Поле для хранения TITLE-страницы',
  `meta_keywords` varchar(255) NOT NULL default '' COMMENT 'Поле для хранения META-KEYWORDS страницы',
  `meta_description` text NOT NULL COMMENT 'Поле для хранения META-DESCRIPTION страницы',
  `token` enum('active','archived','reserved','deleted','moderate','new') NOT NULL default 'new',
  PRIMARY KEY  (`id`),
  FULLTEXT KEY `name` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=%DB_CHARSET%;

-- --------------------------------------------------------

--
-- Структура таблицы `%DB_PREFIX%resume`
--

CREATE TABLE `%DB_PREFIX%resume` (
  `id` mediumint(8) unsigned NOT NULL auto_increment,
  `title` varchar(255) NOT NULL default '',
  `unikey` varchar(32) NOT NULL default '',
  `id_user` mediumint(8) unsigned NOT NULL default '0',
  `first_name` varchar(50) NOT NULL default '',
  `last_name` varchar(50) NOT NULL default '',
  `middle_name` varchar(50) NOT NULL default '',
  `email` varchar(50) NOT NULL default '',
  `public_email` enum('on','0') NOT NULL default '0',
  `phone` varchar(25) NOT NULL default '',
  `note_phone` varchar(255) NOT NULL default '',
  `addition_phone_1` varchar(25) NOT NULL default '',
  `note_addition_phone_1` varchar(255) NOT NULL default '',
  `addition_phone_2` varchar(25) NOT NULL default '',
  `note_addition_phone_2` varchar(255) NOT NULL default '',
  `id_section` tinyint(3) unsigned NOT NULL default '0',
  `id_profession` smallint(5) unsigned NOT NULL default '0',
  `id_profession_1` smallint(5) unsigned NOT NULL default '0',
  `id_profession_2` smallint(5) unsigned NOT NULL default '0',
  `id_region` tinyint(3) unsigned NOT NULL default '0',
  `id_city` smallint(5) unsigned NOT NULL default '0',
  `pay_from` mediumint(8) unsigned NOT NULL default '0',
  `currency` varchar(3) NOT NULL default '',
  `chart_work` varchar(50) NOT NULL default '',
  `expire_work` varchar(50) NOT NULL default '',
  `education` varchar(50) NOT NULL default '',
  `xml_data` text NOT NULL,
  `about_info` text NOT NULL,
  `gender` enum('none','male','female') NOT NULL default 'none',
  `birthday` date NOT NULL default '0000-00-00',
  `age` tinyint(3) unsigned NOT NULL default '0',
  `act_datetime` datetime NOT NULL default '0000-00-00 00:00:00',
  `act_period` tinyint(3) unsigned NOT NULL default '0',
  `user_type` enum('competitor','agent') NOT NULL default 'competitor',
  `subscription` enum('on','0') NOT NULL default '0',
  `vip` tinyint(1) unsigned NOT NULL default '0',
  `vip_unset_datetime` datetime NOT NULL default '0000-00-00 00:00:00',
  `hot` tinyint(1) unsigned NOT NULL default '0',
  `hot_unset_datetime` datetime NOT NULL default '0000-00-00 00:00:00',
  `rate` datetime NOT NULL default '0000-00-00 00:00:00',
  `image` varchar(255) NOT NULL default '',
  `video` varchar(255) NOT NULL default '',
  `cnt_views_total` smallint(5) unsigned NOT NULL default '0',
  `cnt_views_temp` smallint(5) unsigned NOT NULL default '0',
  `cnt_views_temp_datetime` datetime NOT NULL default '0000-00-00 00:00:00',
  `cnt_views_last_ip` varchar(15) NOT NULL default '',
  `token` enum('active','archived','reserved','deleted','moderate','new','correction','template','payment') NOT NULL default 'new',
  `token_datetime` datetime NOT NULL default '0000-00-00 00:00:00',
  `visibility` enum('visible','visiblehc','members','membershc','hide') NOT NULL default 'hide',
  `comments` text NOT NULL,
  `meta_keywords` varchar(255) NOT NULL default '',
  `meta_description` text NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `unikey` (`unikey`),
  FULLTEXT KEY `title` (`title`,`about_info`,`meta_keywords`,`meta_description`)
) ENGINE=MyISAM  DEFAULT CHARSET=%DB_CHARSET%;

-- --------------------------------------------------------

--
-- Структура таблицы `%DB_PREFIX%section`
--

CREATE TABLE `%DB_PREFIX%section` (
  `id` tinyint(3) unsigned NOT NULL auto_increment,
  `name` varchar(100) NOT NULL default '',
  `sort` tinyint(3) unsigned NOT NULL default '0',
  `title` varchar(255) NOT NULL default '' COMMENT 'Поле для хранения TITLE-страницы',
  `meta_keywords` varchar(255) NOT NULL default '' COMMENT 'Поле для хранения META-KEYWORDS страницы',
  `meta_description` text NOT NULL COMMENT 'Поле для хранения META-DESCRIPTION страницы',
  `token` enum('active','archived','reserved','deleted','moderate','new') NOT NULL default 'new',
  PRIMARY KEY  (`id`),
  FULLTEXT KEY `name` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=%DB_CHARSET%;
-- --------------------------------------------------------

--
-- Структура таблицы `%DB_PREFIX%storing`
--

CREATE TABLE `%DB_PREFIX%storing` (
  `id` mediumint(8) unsigned NOT NULL auto_increment,
  `type` enum('error','resume','vacancy') NOT NULL default 'error' COMMENT 'Тип просмотренного контента',
  `id_content` mediumint(8) unsigned NOT NULL default '0' COMMENT 'ID просмотренной записи',
  `id_user` mediumint(8) unsigned NOT NULL default '0' COMMENT 'ID пользователя',
  `ip` varchar(39) NOT NULL default '' COMMENT 'IP-адрес пользователя',
  `datetime` datetime NOT NULL default '0000-00-00 00:00:00' COMMENT 'Дата и время просмотра',
  `token` enum('active','reserved','deleted') NOT NULL default 'deleted',
  `token_datetime` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`id`),
  KEY `id_user` (`id_user`,`id_content`)
) ENGINE=MyISAM DEFAULT CHARSET=%DB_CHARSET% COMMENT='Таблица просмотров контента пользователями';

-- --------------------------------------------------------

--
-- Структура таблицы `%DB_PREFIX%subscription`
--

CREATE TABLE `%DB_PREFIX%subscription` (
  `id` mediumint(8) unsigned NOT NULL auto_increment,
  `id_announce` mediumint(8) unsigned NOT NULL default '0',
  `id_user` mediumint(8) unsigned NOT NULL default '0',
  `email` varchar(50) NOT NULL default '',
  `type_subscription` enum('vacancy','resume','error') NOT NULL default 'error',
  `id_section` tinyint(3) unsigned NOT NULL default '0',
  `id_profession` smallint(5) unsigned NOT NULL default '0',
  `id_profession_1` smallint(5) unsigned NOT NULL default '0',
  `id_profession_2` smallint(5) unsigned NOT NULL default '0',
  `id_region` smallint(5) unsigned NOT NULL default '0',
  `id_city` mediumint(8) unsigned NOT NULL default '0',
  `period` tinyint(3) unsigned NOT NULL default '1',
  `date_lastsend` date NOT NULL default '0000-00-00',
  `payment` enum('yes','no') NOT NULL default 'no',
  `token` enum('active','archived','reserved','deleted','new','payment') NOT NULL default 'new',
  `token_datetime` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=%DB_CHARSET%;

-- --------------------------------------------------------

--
-- Структура таблицы `%DB_PREFIX%vacancy`
--

CREATE TABLE `%DB_PREFIX%vacancy` (
  `id` mediumint(8) unsigned NOT NULL auto_increment,
  `title` varchar(255) NOT NULL default '',
  `unikey` varchar(32) NOT NULL default '',
  `id_user` mediumint(8) unsigned NOT NULL default '0',
  `contacts_fio` varchar(100) NOT NULL default '',
  `email` varchar(50) NOT NULL default '',
  `public_email` enum('on','0') NOT NULL default '0',
  `phone` varchar(25) NOT NULL default '',
  `note_phone` varchar(255) NOT NULL default '',
  `addition_phone_1` varchar(25) NOT NULL default '',
  `note_addition_phone_1` varchar(255) NOT NULL default '',
  `addition_phone_2` varchar(25) NOT NULL default '',
  `note_addition_phone_2` varchar(255) NOT NULL default '',
  `url` varchar(100) NOT NULL default '',
  `company_name` varchar(255) NOT NULL default '',
  `company_discription` text NOT NULL,
  `id_section` tinyint(3) unsigned NOT NULL default '0',
  `id_profession` smallint(5) unsigned NOT NULL default '0',
  `id_region` tinyint(3) unsigned NOT NULL default '0',
  `id_city` smallint(5) unsigned NOT NULL default '0',
  `pay_from` mediumint(8) unsigned NOT NULL default '0',
  `pay_post` mediumint(8) unsigned NOT NULL default '0',
  `currency` varchar(3) NOT NULL default '',
  `chart_work` varchar(50) NOT NULL default '',
  `expire_work` varchar(50) NOT NULL default '',
  `edu_work` varchar(50) NOT NULL default '',
  `requirements` text NOT NULL,
  `duties_work` text NOT NULL,
  `conditions_work` text NOT NULL,
  `ext_info` text NOT NULL,
  `gender` enum('none','male','female') NOT NULL default 'none',
  `age_from` tinyint(3) unsigned NOT NULL default '0',
  `age_post` tinyint(3) unsigned NOT NULL default '0',
  `act_datetime` datetime NOT NULL default '0000-00-00 00:00:00',
  `user_type` enum('employer','agent','company') NOT NULL default 'employer',
  `agent_name` varchar(255) NOT NULL default '',
  `xml_data` text NOT NULL,
  `act_period` tinyint(3) unsigned NOT NULL default '0',
  `subscription` enum('on','0') NOT NULL default '0',
  `vip` tinyint(1) unsigned NOT NULL default '0',
  `vip_unset_datetime` datetime NOT NULL default '0000-00-00 00:00:00',
  `hot` tinyint(1) unsigned NOT NULL default '0',
  `hot_unset_datetime` datetime NOT NULL default '0000-00-00 00:00:00',
  `rate` datetime NOT NULL default '0000-00-00 00:00:00',
  `image` varchar(255) NOT NULL default '',
  `video` varchar(255) NOT NULL default '',
  `cnt_views_total` smallint(5) unsigned NOT NULL default '0',
  `cnt_views_temp` smallint(5) unsigned NOT NULL default '0',
  `cnt_views_temp_datetime` datetime NOT NULL default '0000-00-00 00:00:00',
  `cnt_views_last_ip` varchar(15) NOT NULL default '',
  `token` enum('active','archived','reserved','deleted','moderate','new','correction','template','payment') NOT NULL default 'new',
  `token_datetime` datetime NOT NULL default '0000-00-00 00:00:00',
  `comments` text NOT NULL,
  `meta_keywords` varchar(255) NOT NULL default '',
  `meta_description` text NOT NULL,
  PRIMARY KEY  (`id`),
  UNIQUE KEY `unikey` (`unikey`),
  FULLTEXT KEY `title` (`title`,`ext_info`,`duties_work`,`meta_keywords`,`meta_description`)
) ENGINE=MyISAM  DEFAULT CHARSET=%DB_CHARSET%;

-- --------------------------------------------------------

--
-- Структура таблицы `%USR_PREFIX%admin`
--

CREATE TABLE `%USR_PREFIX%admin` (
  `id` tinyint(1) unsigned NOT NULL auto_increment,
  `login` varchar(32) NOT NULL default '',
  `password` varchar(32) NOT NULL default '',
  `email` varchar(50) NOT NULL default '',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM  DEFAULT CHARSET=%DB_CHARSET%;

-- --------------------------------------------------------

--
-- Структура таблицы `%USR_PREFIX%city`
--

CREATE TABLE `%USR_PREFIX%city` (
  `id` mediumint(8) unsigned NOT NULL auto_increment,
  `parent_id` smallint(5) unsigned NOT NULL default '0',
  `name` varchar(100) NOT NULL default '',
  `capital` enum('on','0') NOT NULL default '0',
  `title` varchar(255) NOT NULL default '' COMMENT 'Поле для хранения TITLE-страницы',
  `meta_keywords` varchar(255) NOT NULL default '' COMMENT 'Поле для хранения META-KEYWORDS страницы',
  `meta_description` text NOT NULL COMMENT 'Поле для хранения META-DESCRIPTION страницы',
  `token` enum('active','archived','reserved','deleted','moderate','new') NOT NULL default 'new',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=%DB_CHARSET%;

-- --------------------------------------------------------

--
-- Структура таблицы `%USR_PREFIX%region`
--

CREATE TABLE `%USR_PREFIX%region` (
  `id` smallint(5) unsigned NOT NULL auto_increment,
  `name` varchar(100) NOT NULL default '',
  `sort` tinyint(3) unsigned NOT NULL default '0',
  `title` varchar(255) NOT NULL default '' COMMENT 'Поле для хранения TITLE-страницы',
  `meta_keywords` varchar(255) NOT NULL default '' COMMENT 'Поле для хранения META-KEYWORDS страницы',
  `meta_description` text NOT NULL COMMENT 'Поле для хранения META-DESCRIPTION страницы',
  `token` enum('active','archived','reserved','deleted','moderate','new') NOT NULL default 'new',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=%DB_CHARSET%;

-- --------------------------------------------------------

--
-- Структура таблицы `%USR_PREFIX%users`
--

CREATE TABLE `%USR_PREFIX%users` (
  `id` mediumint(8) unsigned NOT NULL auto_increment,
  `email` varchar(50) NOT NULL default '',
  `password` varchar(32) NOT NULL default '',
  `alias` varchar(100) NOT NULL default '',
  `first_name` varchar(50) NOT NULL default '',
  `last_name` varchar(50) NOT NULL default '',
  `middle_name` varchar(50) NOT NULL default '',
  `gender` enum('none','male','female') NOT NULL default 'none',
  `birthday` date NOT NULL default '0000-00-00',
  `phone` varchar(25) NOT NULL default '',
  `reg_datetime` datetime NOT NULL default '0000-00-00 00:00:00',
  `reg_ip` varchar(39) NOT NULL COMMENT 'IP-адрес пользователя при регистрации',
  `pre_ip` varchar(39) NOT NULL COMMENT 'IP-адрес пользователя при прошлом входе',
  `curr_ip` varchar(39) NOT NULL COMMENT 'IP-адрес пользователя при текущем входе',
  `token` enum('active','archived','reserved','deleted','moderate','new') NOT NULL default 'new',
  `token_datetime` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`id`),
  UNIQUE KEY `email` (`email`),
  KEY `reg_ip` (`reg_ip`)
) ENGINE=MyISAM  DEFAULT CHARSET=%DB_CHARSET%;