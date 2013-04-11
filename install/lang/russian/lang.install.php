<?php
/********************************************************
	JobExpert v1.0
	powered by Script Developers Group (SD-Group)
	email: info@sd-group.org.ua
	url: http://sd-group.org.ua/
	Copyright 2010-2015 (c) SD-Group
	All rights reserved
=========================================================
	Файл русского языка
********************************************************/
/**
 * @package
 * @todo
 */

(!defined('SDG')) ? die ('Triple protection!') : null;

define("INSTALLATION_TITLE", "JobExpert Installation");

define("JAVASCRIPT_DISABLED", "В Вашем браузере отключена поддержка JavaScript. Обязательно включите поддержку JavaScript, прежде чем начнете работу с нашим сайтом.");

define("COOKIE_DISABLED", "В Вашем браузере отключены Cookies. Для правильной работы сайта Cookies необходимо включить!");

/***** BUTTONS *****/
define("BUTTON_NEXT", "Далее");

define("BUTTON_PREV", "Назад");

define("BUTTON_SAVE", "Сохранить");


define("FORM_PLACE_AT_FIRST", "В начале");

define("FORM_PLACE_AT_CLOSE", "В конце");


/***** TABLE *****/
define("TABLE_COLUMN_CUREENT", "Текущее");

define("TABLE_COLUMN_MUST", "Должно быть");


/***** STEP 1 *****/
define("DB_CONFIG_HEAD", "Настройка конфигурации системы");

define("DB_CONFIG_MYSQL_HEAD", "Данные для доступа к MySQL серверу");

define("DB_CONFIG_ADDITIONAL_DATA_HEAD", "Дополнительные данные");

define("DB_CONFIG_MYSQL_SERVER", "Сервер MySQL");

define("DB_CONFIG_MYSQL_NAME", "Имя базы данных");

define("DB_CONFIG_MYSQL_USER", "Имя пользователя");

define("DB_CONFIG_MYSQL_PASSWORD", "Пароль");

define("DB_CONFIG_ADDITIONAL_DATA_DB_PREFIX", "Префикс таблиц текущего скрипта");

define("DB_CONFIG_ADDITIONAL_DATA_USER_PREFIX", "Префикс общих таблиц БД");

define("DB_CONFIG_ADDITIONAL_DATA_DB_CHARSET", "Кодировка БД");

define("DB_CONFIG_ADDITIONAL_DATA_DEFAULT_CHARSET", "Кодировка сайта");

/***** STEP 2 *****/
define("CREATE_TABLES_HEAD", "Создание таблиц");

define("CREATE_TABLES_LIST", "Таблицы");

define("CREATE_TABLES_MANDATORY_DATA", "Обязательные данные");

define("CREATE_TABLES_DEMO_DATA", "Дополнительные данные");

define("CREATE_TABLES_SUCCESS", "Успешно");

define("CREATE_TABLES_ERROR", "Ошибка");

define("CREATE_TABLES_ATTENTION", "<b>Внимание!!!</b> Если какая-либо из таблиц не была создана, необходимо устранить ошибку (будет выведена рядом с именем таблицы) и попробовать создать таблицы снова.");

define("CREATE_TABLES_ADD_DEMO_DATA", "Добавить дополнительные данные (регионы, города, разделы, профессии)");

define("CREATE_TABLES_NOT_TRUNCATE_TABLES", "Не удалось очистить таблицы перед вставкой данных. Удалите все данные из указанных ниже таблиц вручную, а затем попробуйте снова запустить добавление дополнительных данных.");

/***** STEP 3 *****/
define("SERVER_CONF_HEAD", "Настройки сервера");

define("SERVER_CONF_ROOT_DIR", "Путь к директории со скриптом");

/***** STEP 4 *****/
define("TMPL_CONF_HEAD", "Установка шаблонизатора Smarty");

define("TMPL_SMARTY_SETUP_SUCCESS", "Установка Smarty успешно завершена!");

define("TMPL_SMARTY_SETUP_FAIL", "Smarty не установлен!");



/***** STEP 5 *****/

/***** STEP 6 *****/

/***** STEP 7 *****/

/***** STEP 8 *****/
define("SITE_CONF_HEAD", "Основные настройки сайта");

define("SITE_CONF_TITLE", "TITLE сайта по умолчанию");

define("SITE_CONF_DESCRIPTION", "DESCRIPTION сайта по умолчанию");

define("SITE_CONF_KEYWORDS", "KEYWORDS сайта по умолчанию");

define("SITE_CONF_SITE_NAME_TO_TITLE", "Добавлять Имя сайта в TITLE страниц");

define("SITE_CONF_TITLE_PAGE_SEPERATOR", "Строка разделитель для TITLE страниц");

define("SITE_CONF_LANGUAGE", "Язык сайта по умолчанию");

define("SITE_CONF_TEMPLATE", "Шаблон сайта по умолчанию");

define("SITE_CONF_SITE_NAME", "Имя сайта");

define("SITE_CONF_SITE_URL", "URL основного сайта");

define("SITE_CONF_SCRIPT_URL", "URL текущего скрипта");

define("SITE_CONF_USE_REDIRECT_EXTERNAL_LINK", "Использовать редирект для внешних ссылок");

define("SITE_CONF_USE_VISUAL_EDITOR", "Использовать WYSIWYG-редактор (tinyMCE)");

define("SITE_CONF_ENABLE_CACHING", "Включить кеширование");

define("SITE_CONF_DISABLE_AUTO_COUNTERS", "Отключить автоматический пересчет счетчиков");

define("SITE_CONF_ENABLE_CHPU", "Включить ЧПУ");

define("SITE_CONF_ENABLE_TRANSLITERATION_CHPU", "Включить транслитерацию ЧПУ");

define("SITE_CONF_TRANSLITERATION_CHPU_ID_PUT_TO_END", "Размещение идентификатора записи в URL транслитерации ЧПУ");

define("SITE_CONF_TRANSLITERATION_CHPU_MAX_LENGHT", "Максимальная длина строки для транслитерации ЧПУ (символы)");

define("SITE_CONF_CHPU_HTML_DATA_EXT", "ЧПУ - раcширение для страниц с HTML данными");

define("SITE_CONF_CHPU_XML_DATA_EXT", "ЧПУ - расширение для страниц с XML данными");


/***** STEP 9 *****/
define("ADMIN_CONF_HEAD", "Настройки администратора");

define("ADMIN_CONF_ADMINFILE", "Файл входа в админ-панель (обязательно с расширением <b>.php</b>)");

define("ADMIN_CONF_DATA", "Данные администратора");

define("ADMIN_CONF_LOGIN", "Логин администратора");

define("ADMIN_CONF_PASSWORD", "Пароль администратора");

define("ADMIN_CONF_EMAIL", "Email администратора");

/***** STEP 10 *****/
define("END_CONGRATULATIONS", "Поздравляем! Установка успешно завершена.");

define("END_WARNING", "Обязательно удалите файл <b>install.php</b> и каталог <b>install</b>. Повторная установка может повредить систему.");

define("END_GO_TO_ADMIN_PANEL", "Войти в админ-панель");

define("END_GO_TO_SITE", "Перейти на сайт");

define("END_DELTE_INSTALL_FILES", "Удалить файлы инсталлятора автоматически");

define("END_REDIRECT_TO_ADMIN_PANEL", "переадресация в админ-панель");

define("MESSAGE_DELTE_INSTALL_FILES", "Файлы инсталлятора будут удалены! Восстановить файлы после удаления будет невозможно.");

define("END_CONFIGURE_HTACCESS", "Настроить файл .htaccess");

define("END_ENABLE_REWRITEBASE", "Включить &quot;RewriteBase /&quot;");

define("END_ENABLE_PHPERRORS_PRINT", "Включить вывод PHP-ошибок");

define("END_ENABLE_PHPERRORS_LOG", "Включить логирование PHP-ошибок");

define("END_FILE_PHPERRORS_LOG", "Путь к файлу логов");

define("END_RESTRICT_FILE_PHPERRORS_LOG", "Запретить доступ к файлу логов");

define("END_RESTRICT_FILE_HTACCESS", "Запретить доступ к файлу .htaccess");

define("END_NOT_CHANGE_CONFIG", "Не изменяйте настройки, если вы не знаете, что они означают");

define("END_HTACCESS_SUCCESSFULLY_CREATED", "Файл .htaccess успешно создан!");