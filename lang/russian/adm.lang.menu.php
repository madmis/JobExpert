<?php
/********************************************************
	powered by Script Developers Group (SD-Group)
	email: info@sd-group.org.ua
	url: http://sd-group.org.ua/
	Copyright 2009 (c) SD-Group
	All rights reserved
=========================================================
	Русский язык админки - Меню
********************************************************/

(!defined('SDG')) ? die ('Triple protection!') : null;

/***** ДЕЙСТВИЯ *****/
define('MENU_ACTION_EDIT', 'Редактировать');

define('MENU_ACTION_FILTER', 'Отбор');

define('MENU_ACTION_ADD', 'Добавить');

define('MENU_ACTION_DELETE', 'Удалить');

define('MENU_ACTION_VIEW', 'Просмотр');

define('MENU_ACTION_MODERATE', 'Модерация');

define('MENU_ACTION_NEW', 'Ожидающие активации');

define('MENU_ACTION_CORRECTION', 'На исправлении');

define('MENU_ACTION_TEMPLATE', 'Шаблоны');

define('MENU_ACTION_ARCHIVED', 'Архив');

define('MENU_ACTION_PAYMENT', 'Ожидающие оплату');

define('MENU_ACTION_PAYMENTS', 'Платежи');

define('MENU_ACTION_ARCHIVE', 'Поместить в архив');

define('MENU_ACTION_UNARCHIVE', 'Извлечь из архива');

define('MENU_ACTION_DELETE_SELECTED', 'Удалить выбранные');

define('MENU_ACTION_DOWNLOAD', 'Загрузить');



define('MENU_CONFIG', 'Настройки');

define('MENU_CONFIG_SITE', 'Сайт');

define('MENU_CONFIG_SECURE', 'Безопасность');

define('MENU_CONFIG_DATETIME', 'Дата/Время');

define('MENU_CONFIG_MAIL', 'Почта');

define('MENU_CONFIG_REGISTER', 'Регистрации');

define('MENU_CONFIG_SMARTY', 'Smarty');

define('MENU_CONFIG_SERVER', 'Сервер');

define('MENU_CONFIG_FILES', 'Файлы');

define('MENU_CONFIG_PAYMENTS', 'Платные услуги');

define('MENU_CONFIG_RSS', 'RSS');

define('MENU_CONFIG_YVL', 'Яндекс.Работа');

define('MENU_ADMIN_MAIN', 'Главная');

define('MENU_MAIN_SITE', 'Главная сайта');

define('MENU_MAIN_ADMIN', 'Главная панели Администратора');

define('MENU_LOGOUT_SITE', 'Выход');

define('MENU_ANNOUNCES', 'Объявления');

define('MENU_ANNOUNCES_VACANCYS', 'Вакансии');

define('MENU_ANNOUNCES_RESUMES', 'Резюме');

define('MENU_ANNOUNCES_COMMON', 'Общие');

define('MENU_ANNOUNCES_CONFIG_QUESTIONARY', 'Настройки анкеты');

define('MENU_MANAGER', 'Менеджер');

define('MENU_DICTIONARY', 'Словари');

define('MENU_MODS', 'Моды');

define('MENU_MODS_PAYMENTS', 'Платежные системы');

define('MENU_DICTIONARY_REGIONS', 'Регионы');

define('MENU_DICTIONARY_SECTIONS', 'Разделы');

define('MENU_DICTIONARY_SELECTS', 'Списки');

define('MENU_DICTIONARY_ARTICLES_SECTIONS', 'Разделы статей');

define('MENU_DICTIONARY_ARTICLES_SECTIONS_ADD', 'Добавление раздела');

define('MENU_DICTIONARY_ARTICLES_SECTIONS_EDIT', 'Редактирование раздела');

define('MENU_DICTIONARY_SELECTS_SYSTEM', 'Системные списки');

define('MENU_DICTIONARY_SELECTS_ADDITION', 'Дополнительные списки');

define('MENU_MANAGER_DOP_PAGES', 'Доп. страницы');

define('MENU_MANAGER_NEWS', 'Новости');

define('MENU_MANAGER_NEWS_ADD', 'Добавление новости');

define('MENU_MANAGER_NEWS_EDIT', 'Редактирование новости');

define('MENU_MANAGER_FILE', 'Файл-менеджер');

define('MENU_MANAGER_FILES', 'Файлы');

define('MENU_MANAGER_IMAGES', 'Картинки');

define('MENU_MANAGER_NEWS_BACK', 'К списку новостей');

define('MENU_MANAGER_MAIL_TEMPLATES', 'Шаблоны собщений');

define('MENU_MANAGER_MAIL_TEMPLATES_GENERAL', 'Общие');

define('MENU_MANAGER_MAIL_TEMPLATES_ADMINISTRATOR', 'Администратора');

define('MENU_MANAGER_MAIL_TEMPLATES_USERS', 'Пользователей');

define('MENU_MANAGER_GROUPS', 'Группы');

define('MENU_MANAGER_USERS', 'Пользователи');

define('MENU_MANAGER_ARTICLES', 'Статьи');

define('MENU_MANAGER_ARTICLES_ADD', 'Добавление статьи');

define('MENU_MANAGER_ARTICLES_EDIT', 'Редактирование статьи');

define('MENU_MANAGER_SUBSCRIPTIONS', 'Подписки');

define('MENU_MANAGER_MAILER', 'Рассылка');

define('MENU_MOD', 'Моды');

define('MENU_SERVICE', 'Обслуживание сайта');

define('MENU_ROBOT', 'Робот сайта');

define('MENU_ADMINISTRATION', 'Администрирование');

define('MENU_MAINTENANCE', 'Технические работы');

define('MENU_DESIGNER', 'Дизайн сайта');

define('MENU_LANGUAGE_MANAGER', 'Языковой менеджер');

define('MENU_LANGUAGE_LOCALIZ_CONST', 'Файлы констант');

define('MENU_LANGUAGE_LOCALIZ_TEXT', 'Файлы текстов');

define('MENU_LANGUAGE_LOCALIZ_AGREEMENT', 'Соглашение');

define('MENU_MANAGER_TEMPLATES', 'Управление шаблонами');

define('MENU_MANAGER_TEMPLATES_SITE', 'Управление шаблонами сайта');

define('MENU_CHANGE_PASSWORD', 'Смена логина и пароля Администратора');

define('MENU_LOGS', 'Логи');

define('MENU_LOGS_ADMIN_ACCESS', 'Администратор');

define('MENU_LOGS_SQL', 'SQL');

define('MENU_LOGS_PAYMENTS', 'Платежи');

define('MENU_LOGS_FILES', 'Файлы логов');

define('MENU_BY_ANNOUNCES', 'По объявлениям');

define('MENU_USERS_SUBSCRIPTIONS', 'Пользовательские');

define('MENU_COMPANIES', 'Компании');

define('MENU_AGENCIES', 'Агентства');

define('MENU_SYSTEM', 'Система');

define('MENU_UPDATES', 'Обновления');

define('MENU_UPDATES_LOGS', 'Логи обновлений');

define('MENU_BACKUPS', 'Резервные копии');

define('MENU_SYSTEM_IMPORT', 'Импорт');

define('MENU_SYSTEM_IMPORT_MDS', 'MDS-Job v2.0');

define('MENU_INFO_PRODUCT', 'Информация о продукте');

define('MENU_SERVICES', 'Обслуживание');

define('MENU_SERVICES_DELETE_DB_CACHE', 'Удаление файлов кэша базы данных');

define('MENU_SERVICES_DELETE_TMPL_CACHE', 'Удаление файлов кэша шаблонов');

define('MENU_SERVICES_HTACCESS', 'Настройка файла .htaccess');

define('MENU_COMMENTS', 'Комментарии');

define('MENU_SEO', 'SEO');

/***** MODS *****/
define('MENU_MODS_ADSIMPLE', 'AdSimple');
