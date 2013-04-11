<?php

/**
 * JobExpert v1.0
 * powered by Script Developers Group (SD-Group)
 * email: info@sd-group.org.ua
 * url: http://sd-group.org.ua/
 * Copyright 2010-2015 (c) SD-Group
 * All rights reserved
 * ================================================= *
 * Русский язык админки - Формы
 */
(!defined('SDG')) ? die('Triple protection!') : null;

/**
 * КНОПКИ
 */
define("FORM_BUTTON_SAVE", "Сохранить");

define("FORM_BUTTON_SEND", "Отправить");

define("FORM_BUTTON_LOGIN", "Войти");

define("FORM_BUTTON_EXECUTE", "Выполнить");

define("FORM_BUTTON_CONTINUE", "Продолжить");

define("FORM_BUTTON_UPLOAD", "Загрузить");

define("FORM_BUTTON_DELETE", "Удалить");

define("FORM_BUTTON_ADD", "Добавить");

define("FORM_BUTTON_ADD_GROUP", "Добавить группу");

define("FORM_BUTTON_ADD_LANG_CONST_CUSTOM", "Добавление пользовательской языковой константы");

define("FORM_BUTTON_DELETE_LANG_CONST_CUSTOM", "Удаление пользовательской языковой константы");

define("FORM_BUTTON_DELETE_USER", "Удалить пользователя");

define("FORM_BUTTON_EDIT_USER", "Изменить данные пользователя");

define("FORM_CAPTCHA_REFRESH", "Обновить код");

define("FORM_BUTTON_SETUP", "Установить");

define("FORM_RESET", "Сброс");

define("FORM_BUTTON_NEXT", "Далее");

define("FORM_BUTTON_PREV", "Назад");

define("FORM_BUTTON_CREATE_BACKUP_SITE", "Сделать резервную копию сайта");

define("FORM_BUTTON_CREATE_BACKUP_DB", "Сделать резервную копию базы данных");

define("FORM_BUTTON_CONTINUE_THE_UPDATE", "Продолжить установку обновления");

define("FORM_BUTTON_DEFAULT", "По умолчанию");

/**
 * ТИПЫ ПОЛЬЗОВАТЕЛЕЙ
 */
define("FORM_TYPE_AGENT", "Агент");

define("FORM_TYPE_COMPANY", "Компания");

define("FORM_TYPE_EMPLOYER", "Работодатель");

define("FORM_TYPE_COMPETITOR", "Соискатель");

define("FORM_TYPE_NOT_DEFINE", "Не определен");

/**
 * ПОДПИСИ
 */
define("FORM_IMG_HELP", "Помощь");

define("FORM_FILE_NAME", "Имя файла");

/**
 * ФОРМА ВХОДА АДМИНИСТРАТОРА
 */
define("FORM_ADMIN_LOGIN_HEAD", "Вход в панель администратора");

define("FORM_LOGIN", "Логин");

define("FORM_PASSWORD", "Пароль");

/**
 * ДЕЙСТВИЯ
 */
define("FORM_ACTION_SELECT", "Выберите действие...");

define("FORM_ACTION_ARCHIVE", "Поместить в архив");

define("FORM_ACTION_EXTRACT", "Извлечь из архива");

define("FORM_ACTION_SAVE_CHANGE", "Сохранить изменения");

define("FORM_ACTION_SHOW_SELECTED", "Отобразить выбранные");

define("FORM_ACTION_HIDE_SELECTED", "Скрыть выбранные");

define("FORM_ACTION_SAVE_SORT", "Сохранить сортировку");

define("FORM_ACTION_DELETE", "Удалить");

define("FORM_ACTION_DELETE_SELECTED", "Удалить выбранные");

define("FORM_ACTION_ACTIVATE", "Активировать");

define("FORM_ACTION_PAYMENT", "Отправить на оплату");

define("FORM_ACTION_ACTIVATE_SELECTED", "Активировать выбранные");

define("FORM_ACTION_CORRECTION", "Отправить на исправление");

define("FORM_ACTION_EDIT", "Редактировать");

define("FORM_ACTION_INSTALL_SELECTED", "Установить выбранные");

define("FORM_ACTION_DISABLE_SELECTED", "Отключить выбранные");

define("FORM_ACTION_ENABLE_SELECTED", "Включить выбранные");

define("FORM_ACTION_CLEAR_LOGS", "Очистить логи");

define("FORM_ACTION_DISPLAY_ON_MAIN", "Отображать на главной");

define("FORM_ACTION_REMOVE_FROM_MAIN", "Убрать с главной");

define("FORM_ACTION_EDIT_VISIBILITY", "Изменить Тип размещения");

/**
 * РАЗНОЕ
 */
define("FORM_IMP", "Не важно");

define("FORM_YES", "Да");

define("FORM_NO", "Нет");

define("FORM_SOURCE", "Исходных");

define("FORM_ALL", "Всех");

define("FORM_IMAGE", "Картинка");

define("FORM_TITLE", "Заголовок");

define("FORM_SUBJECT", "Тема");

define("FORM_TEXT", "Текст");

define("FORM_SMALL_TEXT", "Краткий текст");

define("FORM_DATETIME", "Дата и время");

define("FORM_DATE", "Дата");

define("FORM_TIME", "Время");

define("FORM_SET_NOW", "Установить текущие");

define("FORM_RECORDS", "Записей на странице");

define("FORM_AUTHOR", "Автор");

define("FORM_IN_ARCHIVE", "В архиве");

define("FORM_ACTIVE", "Активная");

define("FORM_VALID_UNTIL", "Дествительно до");

define("FORM_ARCHIVED", "Помещено в архив");

define("FORM_MOD_ON", "Включен");

define("FORM_MOD_OFF", "Отключен");

define("FORM_MOD_NOT_INSTALL", "Не установлен");

define('FORM_INPUT_OTHER', "Другой...");

define('FORM_CONF_PERPAGE', "Количество записей, отображаемое на одной странице в пользовательской части");

define('FORM_INCLUDE_FILES', "Вложить файлы");

define("FORM_DATABASE", "База данных");

define("FORM_DBHOST", "Хост базы данных");

define("FORM_DBNAME", "Имя базы данных");

define("FORM_DBUSER", "Пользователь базы данных");

define("FORM_DBPASSWORD", "Пароль пользователя базы данных");

define("FORM_TABLES", "Таблицы");

define("FORM_ID", "ID");

define("FORM_ID_USER", "ID польз.");

define("FORM_PUBLICATION_DATE", "Дата публикации");

define("FORM_PUBLICATION_TIME", "Время публикации");

define("FORM_COMMENTS", "Comments");

define("FORM_ADMIN_COMMENTS", "Замечания администратора");

define("FORM_ORDER_ID", "Номер платежа");

define('FORM_USER_BIRTHDAY', 'Дата рождения');

define('FORM_NO_COMMENTS', 'Запретить добавлять комментарии');

/**
 * ФОРМА НАСТРОЕК САЙТА
 */
define("FORM_TITLE_SITE", "TITLE сайта");

define("FORM_META_DATA", "META-данные");

define("FORM_DESCRIPTION", "META DESCRIPTION");

define("FORM_KEYWORDS", "META KEYWORDS");

define("FORM_CHARSET", "Кодировка, использеумая на сайте");

define("FORM_LANGUAGE", "Язык сайта по умолчанию");

define("FORM_TEMPLATE", "Текущий шаблон");

define("FORM_SITE_NAME", "Имя сайта");

define("FORM_SITE_NAME_TO_TITLE", "Добавлять Имя сайта в TITLE страниц");

define("FORM_TITLE_PAGE_SEPERATOR", "Строка разделитель для TITLE страниц");

define("FORM_SITE_URL", "URL сайта");

define("FORM_SCRIPT_URL", "URL скрипта");

define("FORM_USE_REDIRECT_EXTERNAL_LINK", "Использовать редирект для внешних ссылок");

define("FORM_USE_VISUAL_EDITOR", "Использовать визуальный редактор");

define("FORM_ENABLE_CACHING", "Включить кеширование");

define("FORM_DISABLE_AUTO_COUNTERS", "Отключить автоматический пересчет счетчиков");

define("FORM_ENABLE_CHPU", "Включить ЧПУ");

define("FORM_ENABLE_TRANSLITERATION_CHPU", "Включить транслитерацию ЧПУ");

define("FORM_TRANSLITERATION_CHPU_ID_PUT_TO_END", "Размещение идентификатора записи в URL транслитерации ЧПУ");

define("FORM_TRANSLITERATION_CHPU_MAX_LENGHT", "Максимальная длина строки для транслитерации ЧПУ (символы)");

define("FORM_CHPU_HTML_DATA_EXT", "ЧПУ - раcширение для страниц с HTML данными");

define("FORM_CHPU_XML_DATA_EXT", "ЧПУ - расширение для страниц с XML данными");

define("FORM_PLACE_AT_FIRST", "В начале");

define("FORM_PLACE_AT_CLOSE", "В конце");

/**
 * ФОРМА НАСТРОЕК ДАТЫ И ВРЕМЕНИ
 */
define("FORM_DATE_FORMAT", "Формат даты");

define("FORM_TIME_FORMAT", "Формат времени");

/**
 * ФОРМА НАСТРОЕК БЕЗОПАСНОСТИ
 */
define("FORM_CAPTCHA", "Использовать защиту от спам-ботов (Captcha)");

define("FORM_SQLERR_LOG", "Логировать ошибки sql-запросов");

define("FORM_SQLERR_PRINT", "Выводить ошибки sql-запросов в браузер");

define("FORM_SQLERR_SEND_MESS", "Отправлять письмо при возникновении ошибки sql-запросов");

define("FORM_SQLERR_EMAIL", "E-mail, на который отправлять письмо, при возникновении ошибки sql-запросов");

define("FORM_ADMIN_ACCESS_IP_LIST", "Список IP-адресов для доступа в панель администратора");

define("FORM_ADMIN_ACCESS_IP_LIST_ADD", "Добавить IP-адрес в список");

define("FORM_ADMIN_ACCESS_IP_LIST_DELETE", "Удалить IP-адрес из списка");

/**
 * ФОРМА НАСТРОЕК ПОЧТЫ
 */
define("FORM_MAIL_METHOD", "Метод отправки почты");

define("FORM_MAIL_FORMAT", "Формат отправки почты");

define("FORM_MAIL_ADMIN_EMAIL", "E-Mail адрес администратора");

define("FORM_MAIL_SMTP_HOST", "SMTP хост");

define("FORM_MAIL_SMTP_PORT", "SMTP Порт");

define("FORM_MAIL_SMTP_USER", "SMTP Имя пользователя");

define("FORM_MAIL_SMTP_PASS", "SMTP Пароль");

/**
 * ФОРМА НАСТРОЕК РЕГИСТРАЦИИ ПОЛЬЗОВАТЕЛЕЙ
 */
define("FORM_COMPETITOR_REGISTER_DEFAULT_GROUP", "Группа пользователя <b>СОИСКАТЕЛЬ</b> по умолчанию (после регистрации)");

define("FORM_EMPLOYER_REGISTER_DEFAULT_GROUP", "Группа пользователя <b>РАБОТОДАТЕЛЬ</b> по умолчанию (после регистрации)");

define("FORM_AGENT_REGISTER_DEFAULT_GROUP", "Группа пользователя <b>АГЕНТ</b> по умолчанию (после регистрации)");

define("FORM_COMPANY_REGISTER_DEFAULT_GROUP", "Группа пользователя <b>КОМПАНИЯ</b> по умолчанию (после регистрации)");

define("FORM_TYPE_GUEST_RIGHTS", "Незарегистрированные пользователи могут:");

define("FORM_TYPE_GUEST_RIGHTS_ADD_VACANCY", "добавлять вакансии");

define("FORM_TYPE_GUEST_RIGHTS_ADD_RESUME", "добавлять резюме");

define("FORM_USER_REGISTER", "Использовать регистрацию на сайте");

define("FORM_USER_ACTIVATE", "Использовать активацию e-mail пользователя");

define("FORM_USER_ACTIVATE_DELETE", "Укажите количество часов, по прошествии которых пользователь будет удален, если не активировал email");

define("FORM_MAIL_ADMIN_USER_REGISTER", "Сообщать об успешной регистрации нового пользователя администратору");

define("FORM_REGISTER_USER_PASSWORD", "Минимальное количество символов в пароле пользователя");

/**
 * ФОРМА НАСТРОЕК SMARTY
 */
define("FORM_SMARTY_DIR", "Полный путь к файлам Smarty");

define("FORM_TEMPLATE_ROOT_DIR", "Директория шаблонов по умолчанию");

define("FORM_TEMPLATE_COMPILE_DIR", "Каталог с компилированными шаблонами");

define("FORM_TEMPLATE_DEBUGGING", "Показывать окно отладчика шаблонов");

define("FORM_TEMPLATE_COMPILE_CHECK", "Перекомпиливать шаблон, если он изменился");

define("FORM_TEMPLATE_FORCE_COMPILE", "Принудительное перекомпилирование шаблонов");

/**
 * ФОРМА НАСТРОЕК СЕРВЕРА
 */
define("FORM_SERVER_ROOT_DIR", "Путь к директории со скриптом");

/**
 * ФОРМА НАСТРОЕК ЗАГРУЗКИ ФАЙЛОВ
 */
define("FORM_FILES_MAX_SIZE", "Максимальный размер файла (в Kb)");

define("FORM_FILES_IMG_CREATE_WATERMARK", "Использовать водяные знаки");

define("FORM_FILES_IMG_CREATE_WATERMARK_ON", "Применять водяной знак для изображений");

define("FORM_FILES_IMG_WATERMARK_ALIGNMENT", "Расположение водяного знака");

define("FORM_FILES_IMG_WATERMARK_TYPE", "Тип водяного знака");

define("FORM_FILES_IMG_WATERMARK", "Водяной знак");

define("FORM_FILES_IMG_WATERMARK_FONT", "Шрифт текста");

define("FORM_FILES_IMG_WATERMARK_FONT_SIZE", "Размер шрифта");

define("FORM_FILES_IMG_WATERMARK_FONT_COLOR", "Цвет шрифта");

define("FORM_FILES_IMG_WATERMARK_TRANSPARENT", "Прозрачность шрифта");

/**
 * ФОРМА НАСТРОЕК ПЛАТНЫХ УСЛУГ
 */
define("FORM_PAYMENTS_TARIFF_HEAD", "Тарифная сетка");

define("FORM_PAYMENTS_REGISTER", "Регистрация");

define("FORM_PAYMENTS_REGISTER_AGENT", 'Регистрация "Агента"');

define("FORM_PAYMENTS_REGISTER_COMPANY", 'Регистрация "Компании"');

define("FORM_PAYMENTS_REGISTER_EMPLOYER", 'Регистрация "Работодателя"');

define("FORM_PAYMENTS_REGISTER_COMPETITOR", 'Регистрация "Соискателя"');

define("FORM_PAYMENTS_ADD_ANNOUNCE", "Размещение новых объявлений");

define("FORM_PAYMENTS_SET_VIP", "VIP-статус объявления");

define("FORM_PAYMENTS_SET_HOT", "HOT-статус объявления");

define("FORM_PAYMENTS_SET_RATE", "Рейтинг объявления");

define("FORM_PAYMENTS_SUBSCRIPTIONS", "Подписки на объявления");

define("FORM_PAYMENTS_TRN_ADD", "Добавление");

define("FORM_PAYMENTS_TRN_ADD_COMPANY", "тренинговой компании");

define("FORM_PAYMENTS_TRN_ADD_TRAINER", "тренера");

/**
 * ФОРМА НАСТРОЕК RSS
 */
define("FORM_RSS_NEWS_COUNT", "Количество новостей на странице RSS");

define("FORM_RSS_ARTICLES_COUNT", "Количество статей на странице RSS");

define("FORM_RSS_VACANCY_COUNT", "Количество вакансий на странице RSS");

define("FORM_RSS_RESUME_COUNT", "Количество резюме на странице RSS");

/**
 * ФОРМА НАСТРОЕК YVL
 */
define("FORM_YVL_EXPORT_PERIOD", "Количество дней, за которые выводить объявления");

/**
 * ФОРМЫ НОВОСТЕЙ
 */
define("FORM_NEWS_PERPAGE", "Укажите количество отображаемых записей в списке просмотра всех новостей");

define("FORM_NEWSES_LAST_SHOW", "Отображать список последних новостей на главной странице сайта");

define("FORM_NEWSES_COMMENTS", "Разрешить оставлять комментарии к новостям");

define("FORM_NEWSES_COMMENTS_REGISTER", "Комментарии могут добавлять только зарегистрированные пользователи");

define("FORM_NEWSES_COMMENTS_NAME_UNREGISTER", "Имя, отображаемое в комментариях при добавлении незарегистрированными пользователями");

define("FORM_NEWSES_LAST_SHOW_PERPAGE", "Укажите количество отображаемых записей в списке/блоке последних новостей");

define("FORM_CONF_NEWSES_CORRECTION_THERM", "Срок ожидания исправления новостей (часы)");

define("FORM_MODERATE_NEWS_COMMENTS", "В поле укажите замечания по новости.<br>- при отправке новости на исправление, замечание будет сохранено. В дальнейшем пользователь сможет отредактировать новость с учетом замечаний.<br>- при удалении новости, замечания будут отправлены пользователю в письме.");

define("FORM_NEWSES_TITLE", "Выводить в TITLE страницы только название новости");

/**
 * МОДЕРАЦИЯ
 */
define("FORM_MODERATE_NOTIFICATION", "Отправить пользователю уведомление на Email-адрес");

/**
 * ФОРМЫ ДОПОЛНИТЕЛЬНЫХ СТРАНИЦ
 */
define("FORM_DOP_PAGE_ID", "Идентификатор дополнительной страницы");

define("FORM_DOP_PAGE_NAME", "Название страницы");

define("FORM_DOP_PAGE_TEXT", "Текст страницы");

define("FORM_DOP_PAGE_SHOW", "Показывать страницу");

/**
 * ФОРМЫ ГРУПП
 */
define("FORM_GROUP_NAME", "Название группы");

define("FORM_GROUP_RIGHT_EDIT_VACANCY", "Редактирование вакансий");

define("FORM_GROUP_RIGHT_DEL_VACANCY", "Удаление вакансий");

define("FORM_GROUP_RIGHT_EDIT_RESUME", "Редактирование резюме");

define("FORM_GROUP_RIGHT_DEL_RESUME", "Удаление резюме");

define("FORM_GROUP_RIGHT_ADD_ARTICLES", "Добавление статей");

define("FORM_GROUP_RIGHT_EDIT_ARTICLES", "Редактирование статей");

define("FORM_GROUP_RIGHT_ARC_ARTICLES", "Архивация статей");

define("FORM_GROUP_RIGHT_DEL_ARTICLES", "Удаление статей");

define("FORM_GROUP_RIGHT_ADD_NEWS", "Добавление новостей");

define("FORM_GROUP_RIGHT_EDIT_NEWS", "Редактирование новостей");

define("FORM_GROUP_RIGHT_ARC_NEWS", "Архивация новостей");

define("FORM_GROUP_RIGHT_DEL_NEWS", "Удаление новостей");

define("FORM_GROUP_RIGHT_ADD_TRN_COMPANY", "Добавление тренинговой компании");

define("FORM_GROUP_RIGHT_ADD_TRN_TRAINER", "Добавление тренера");

define("FORM_GROUP_RIGHT_ADD_TRN_TRAINING", "Добавление тренинга");

define("FORM_GROUP_RIGHT_EDIT_TRN_TRAINING", "Редактирование тренинга");

define("FORM_GROUP_RIGHT_ARC_TRN_TRAINING", "Архивация тренинга");

define("FORM_GROUP_RIGHT_DEL_TRN_TRAINING", "Удаление тренинга");

define("FORM_GROUP_RIGHT_ADD_TRN_ARTICLES", "Добавление статей тренинговой компании");

define("FORM_GROUP_RIGHT_EDIT_TRN_ARTICLES", "Редактирование статей тренинговой компании");

define("FORM_GROUP_RIGHT_ARC_TRN_ARTICLES", "Архивация статей тренинговой компании");

define("FORM_GROUP_RIGHT_DEL_TRN_ARTICLES", "Удаление статей тренинговой компании");

define("FORM_GROUP_RIGHT_ADD_TRN_NEWS", "Добавление новостей тренинговой компании");

define("FORM_GROUP_RIGHT_EDIT_TRN_NEWS", "Редактирование новостей тренинговой компании");

define("FORM_GROUP_RIGHT_ARC_TRN_NEWS", "Архивация новостей тренинговой компании");

define("FORM_GROUP_RIGHT_DEL_TRN_NEWS", "Удаление новостей тренинговой компании");

define("FORM_GROUP_RESP_MODER_ACCOUNT", "Модерация учетной записи");

define("FORM_GROUP_RESP_ACT_VACANCY", "Активация вакансий");

define("FORM_GROUP_RESP_ACT_RESUME", "Активация резюме");

define("FORM_GROUP_RESP_MODER_VACANCY", "Модерация вакансий");

define("FORM_GROUP_RESP_MODER_RESUME", "Модерация резюме");

define("FORM_GROUP_RESP_MODER_ARTICLES", "Модерация статей");

define("FORM_GROUP_RESP_MODER_NEWS", "Модерация новостей");

define("FORM_GROUP_RESP_MODER_TRN_COMPANY", "Модерация тренинговой компании");

define("FORM_GROUP_RESP_MODER_TRN_TRAINER", "Модерация тренера");

define("FORM_GROUP_RESP_MODER_TRN_TRAINING", "Модерация тренингов");

define("FORM_GROUP_RESP_MODER_TRN_ARTICLES", "Модерация статей тренинговой компании");

define("FORM_GROUP_RESP_MODER_TRN_NEWS", "Модерация новостей тренинговой компании");

/**
 * ФАЙЛ-МЕНЕДЖЕР ** */
define("FORM_FILEMANAGER_THUMBNAIL_WIDTH", "Максимальная ширина иконки");

define("FORM_FILEMANAGER_THUMBNAIL_HEIGHT", "Максимальная высота иконки");

/**
 * СТАТЬИ
 */
define("FORM_DICTIONARY_ART_SECTIONS_AFFILIATION_ALL", "Видно всем");

define("FORM_ARTICLES_SECTION", "Раздел");

define("FORM_CONF_ARTICLES_ADD_SUCCESS_ADMIN_INFORM", "Уведомление на Email-адрес Администратора при успешном добавлении статьи");

define("FORM_CONF_ARTICLES_ADD_MODERATION_ADMIN_INFORM", "Уведомление на Email-адрес Администратора при поступлении статьи на модерацию");

define("FORM_CONF_ARTICLES_CORRECTION_THERM", "Срок ожидания исправления статей (часы)");

define("FORM_MODERATE_ARTICLES_COMMENTS", "В поле укажите замечания по статье.<br>- при отправке статьи на исправление, замечание будет сохранено. В дальнейшем пользователь сможет отредактировать статью с учетом замечаний.<br>- при удалении статьи, замечания будут отправлены пользователю в письме.");

define("FORM_CONF_ARTICLES_COMMENTS", "Разрешить оставлять комментарии к статьям");

define("FORM_CONF_ARTICLES_COMMENTS_REGISTER", "Комментарии могут добавлять только зарегистрированные пользователи");

define("FORM_CONF_ARTICLES_COMMENTS_NAME_UNREGISTER", "Имя, отображаемое в комментариях при добавлении незарегистрированными пользователями");

define("FORM_CONF_ARTICLES_TITLE", "В TITLE страницы выводить");

define("FORM_CONF_ARTICLES_TITLE_SECTION_SITE", "Название раздела сайта");

define("FORM_CONF_ARTICLES_TITLE_SECTION_ARTICLE", "Название раздела статей");

define("FORM_CONF_ARTICLES_TITLE_ARTICLE_NAME", "Название статьи");

/**
 * Словари - Разделы/Регионы
 */
define("FORM_SECTION_INPUT_ADD", "Добавить Раздел");

define("FORM_PROFESSION_INPUT_ADD", "Добавить Профессию");

define("FORM_REGION_INPUT_ADD", "Добавить Регион");

define("FORM_CITY_INPUT_ADD", "Добавить Город");

define("FORM_ACTION_SETCAPITAL", "Сохранить значение столицы");

define("FORM_ACTION_RESETCAPITAL", "Сбросить значение столицы");

/**
 * Словари - Списки
 */
define("FORM_SELECT_LANGUAGE", "Локализация");

define("FORM_DICT_INPUT_ADD", "Добавление дополнительного списка");

define("FORM_DICT_INPUT_EDIT", "Редактирование списка");

define("FORM_DICT_VALUE_INPUT_ADD", "Добавить значение");

define("FORM_DICT_VALUE_INPUT_DELETE", "Удалить значение");

/**
 * ФОРМЫ ПОЛЬЗОВАТЕЛЕЙ
 */
define("FORM_USERS_DATA", "Данные пользователя");

define("FORM_USERS_COMPANY_DATA", "Данные компании");

define("FORM_USERS_ACTIONS", "Действия");

define("FORM_USERS_DATA_ID", "ID-пользователя");

define("FORM_USERS_DATA_EMAIL", "E-mail");

define("FORM_USERS_DATA_PASSWORD", "Пароль");

define("FORM_USERS_DATA_TYPE", "Тип");

define("FORM_USERS_DATA_GROUP", "Группа");

define("FORM_USERS_DATA_REG_DATETIME", "Дата регистрации");

define("FORM_USERS_DATA_ALIAS", "Псевдоним");

define("FORM_USERS_DATA_REG_IP", "IP");

define("FORM_USERS_DATA_FIRST_NAME", "Имя");

define("FORM_USERS_DATA_LAST_NAME", "Фамилия");

define("FORM_USERS_DATA_MIDDLE_NAME", "Отчество");

define("FORM_USERS_DATA_GENDER", "Пол");

define("FORM_USERS_DATA_BIRTHDAY", "Дата рождения");

define("FORM_USERS_DATA_PHONE", "Телефон");

define("FORM_USERS_DATA_ADDITION_PHONE", "Дополнительный телефон");

define("FORM_USERS_DATA_TOKEN", "Статус");

define("FORM_USERS_DATA_COMPANY_NAME", "Название компании");

define("FORM_USERS_DATA_COMPANY_CITY", "Город (местонахождение) компании");

define("FORM_USERS_DATA_COMPANY_DESCRIPTION", "Описание компании");

define("FORM_USERS_DATA_COMPANY_LOGO", "Логотип компании");

define("FORM_USERS_DATA_COMPANY_URL", "Сайт компании");

define("FORM_USERS_DATA_COMPANY_NOLOGO", "Нет логотипа");

define("FORM_USERS_DATA_DELETE_USER_ARTICLES", "Удалить статьи пользователя");

define("FORM_USERS_DATA_DELETE_USER_NEWS", "Удалить новости пользователя");

define("FORM_USERS_DATA_SEND_EMAIL_ABOUT_ACTIVATE", "Отправить пользователям уведомление об активации!");

define("FORM_USERS_DATA_SEND_EMAIL_ABOUT_ADD", "Отправить пользователю уведомление");

define("FORM_CONF_USERS_STRINGS_PERPAGE_ADMIN_PANEL", "Укажите количество записей на одной странице, отображаемых в таблицах, в панели администратора");

define("FORM_CONF_USERS_NOT_TYPE_DELETE", "Удалять акаунты, у которых не выбран тип, через часов");

define("FORM_CONF_USERS_PAYMENT_DELETE", "Удалять неоплаченные акаунты через часов");

define("FORM_CONF_USERS_CHANGE_NAME", "Разрешить пользователю изменять Имя и Фамилию");

/**
 * ФОРМЫ КОМПАНИЙ
 */
define("FORM_CONF_COMPANIES_PERPAGE", "Количество компаний, отображаемой на одной странице");

define("FORM_CONF_COMPANIES_SHOW_ONLY_WITH_LOGO", "Показывать в списке только те компании, у которых есть логотип");

define("FORM_CONF_COMPANIES_DELETE_LOGO", "Разрешить компаниям удалять свой логотип");

define("FORM_CONF_COMPANIES_USE_VISUAL_EDITOR", "Разрешить компаниям использовать html в описании");

define("FORM_CONF_COMPANIES_SHOW_MAIN_LOGO", "Выводить логотипы компаний на главной");

define("FORM_CONF_COMPANIES_SHOW_MAIN_LOGO_QTY", "Укажите количество логотипов, выводимых на главной в одной строке");

/**
 * ФОРМЫ ОБЪЯВЛЕНИЙ
 */
define("FORM_CONF_ANNOUNCE_USER_AGREEMENT_NOMEMBERS_REQUIRED", "Показывать Пользовательское соглашение для незарегистрированных пользователей");

define("FORM_CONF_ANNOUNCES_ADD_SUCCESS_ADMIN_INFORM", "Уведомление на Email-адрес Администратора об успешном добавлении нового объявления");

define("FORM_CONF_ANNOUNCES_ADD_SUCCESS_USER_INFORM", "Уведомление на Email-адрес Пользователя об успешном добавлении нового объявления");

define("FORM_CONF_ANNOUNCES_ADD_OTHER_CITY", "Разрешить Пользователям добавлять свои города в формах анкет добавления объявлений");

define("FORM_CONF_ANNOUNCE_USE_VISUAL_EDITOR", "Разрешить использование HTML-кода при заполнении анкеты добавления объявления");

define("FORM_CONF_ANNOUNCES_PREVIEW", "Включить форму предпросмотра нового добавляемого объявления");

define("FORM_CONF_ANNOUNCES_PERPAGE_SITE", "Укажите количество отображаемых объявлений на одной странице, в пользовательской части");

define("FORM_CONF_ANNOUNCES_PERPAGE_ADMIN_PANEL", "Укажите количество отображаемых объявлений на одной странице, в панели администратора");

define("FORM_CONF_ANNOUNCES_CATEGORY_PERLINE", "Количество колонок для отображения");

define("FORM_CONF_EMAIL_ATTACHMENT_FILES_ALLOW", "Разрешить прикреплять файлы к почтовым сообщениям");

define("FORM_CONF_EMAIL_ATTACHMENT_MAX_FILES", "Максимальное количество прикрепляемых файлов");

define("FORM_CONF_EMAIL_ATTACHMENT_FILE_MAX_SIZE", "Максимальный размер прикрепляемого файла (Килобайт)");

define("FORM_CONF_ANNOUNCES_VACANCY_ACTIVATE_THERM", "Срок ожидания активации Вакансий по Email-адресу (часы)");

define("FORM_CONF_ANNOUNCES_RESUME_ACTIVATE_THERM", "Срок ожидания активации Резюме по Email-адресу (часы)");

define("FORM_CONF_ANNOUNCES_VACANCY_PAYMENT_THERM", "Срок ожидания оплаты новых добавленных Вакансий (часы)");

define("FORM_CONF_ANNOUNCES_RESUME_PAYMENT_THERM", "Срок ожидания оплаты новых добавленных Резюме (часы)");

define("FORM_CONF_ANNOUNCES_VACANCY_CORRECTION_THERM", "Срок ожидания исправления Вакансий (часы)");

define("FORM_CONF_ANNOUNCES_RESUME_CORRECTION_THERM", "Срок ожидания исправления Резюме (часы)");

define("FORM_CONF_ANNOUNCES_VACANCY_VIP_THERM", "Срок действия статуса VIP для Вакансий (часы)");

define("FORM_CONF_VACANCY_VIP_SHOW", "Отображать VIP-Вакансии на главной странице сайта");

define("FORM_CONF_VACANCY_VIP_SHOW_PERPAGE", "Укажите количество отображаемых VIP-Вакансий");

define("FORM_CONF_ANNOUNCES_VACANCY_HOT_THERM", "Срок действия статуса HOT для Вакансий (часы)");

define("FORM_CONF_VACANCY_HOT_SHOW_PERPAGE", "Укажите количество отображаемых HOT-Вакансий");

define("FORM_CONF_VACANCY_LAST_SHOW", "Отображать последние Вакансии на главной странице сайта");

define("FORM_CONF_VACANCY_LAST_SHOW_PERPAGE", "Укажите количество отображаемых последних Вакансий");

define("FORM_CONF_ANNOUNCES_RESUME_VIP_THERM", "Срок действия статуса VIP для Резюме (часы)");

define("FORM_CONF_RESUME_VIP_SHOW", "Отображать VIP-Резюме на главной странице сайта");

define("FORM_CONF_RESUME_VIP_SHOW_PERPAGE", "Укажите количество отображаемых VIP-Резюме");

define("FORM_CONF_ANNOUNCES_RESUME_HOT_THERM", "Срок действия статуса HOT для Резюме (часы)");

define("FORM_CONF_RESUME_HOT_SHOW_PERPAGE", "Укажите количество отображаемых HOT-Резюме");

define("FORM_CONF_RESUME_LAST_SHOW", "Отображать последние Резюме на главной странице сайта");

define("FORM_CONF_RESUME_LAST_SHOW_PERPAGE", "Укажите количество отображаемых последних Резюме");

define("FORM_CONF_RESUME_ADD_PHOTO", "Разрешить загрузку фотокарточек для Резюме");

define("FORM_CONF_RESUME_ADD_PHOTO_RESOLUTION_CONV", "Укажите размеры для прикрепляемых фотокарточек [ширина] х [высота]");

define("FORM_CONF_RESUME_ADD_PHOTO_FILE_MAXSIZE", "Укажите максимальный размер файла для загружаемой фотокарточки в килобайтах");

/**
 * ФОРМЫ ПОДПИСОК
 */
define("FORM_CONF_SUBSCRIPTIONS_FREE", "Количество доступных (бесплатных) подписок пользователя");

define("FORM_CONF_SUBSCRIPTIONS_PAYMENT_DELETE", "Удалять неоплаченные подписки через часов");

define("FORM_CONF_SUBSCRIPTIONS_ANNOUNCE_PERIOD", "Периодичность рассылки по подписке, добавленной с объявлением");

define("FORM_CONF_SUBSCRIPTIONS_START_TIME", "Время старта рассылки объявлений");

/**
 * ФОРМЫ СЕРВИСА
 */
define("FORM_CONF_ADMINISTRATION_MAINTENANCE", "Отключить сайт на техническое обслуживание");

define("FORM_CONF_ADMINISTRATION_MANUAL_CONTROL", "Ручное управление базой данных сайта");

define("FORM_CONF_ADMINISTRATION_ROBOT_CONTROL", "Роботизированное управление базой данных сайта");

define("FORM_CONF_ADMINISTRATION_ROBOT_RUNNING", "Выполнять роботизированное управление в автоматическом режиме");

define("FORM_CONF_ADMINISTRATION_ROBOT_RUNNING_TERM", "Укажите периодичность запуска робота");

define("FORM_CONF_ADMINISTRATION_ROBOT_RUNNING_FIRSTTIME", "Укажите время первого запуска робота");

define("FORM_CONF_ADMINISTRATION_UPDATE_COUNTERS", "Пересчет показаний всех счетчиков на сайте");

define("FORM_CONF_ADMINISTRATION_DELETE_NONVERIFY_USERS", "Удаление пользователей не прошедших верификацию Email-адреса");

define("FORM_CONF_ADMINISTRATION_DELETE_NONTYPE_USERS", "Удаление пользователей не закончивших регистрацию");

define("FORM_CONF_ADMINISTRATION_DELETE_UNPAID_USERS", "Удаление пользователей не оплативших регистрацию");

define("FORM_CONF_ADMINISTRATION_DELETE_NONVERIFY_ANNOUNCES", "Удаление объявлений не прошедших верификацию Email-адреса");

define("FORM_CONF_ADMINISTRATION_DELETE_UNPAID_ANNOUNCES", "Удаление объявлений с истекшим сроком оплаты размещения");

define("FORM_CONF_ADMINISTRATION_DELETE_UNPAID_SUBSCRIPTIONS", "Удаление подписок пользователей с истекшим сроком оплаты размещения");

define("FORM_CONF_ADMINISTRATION_RESET_TEMP_COUNTERS_LIFE_OVER", "Обнуление временных счетчиков объявлений");

define("FORM_CONF_ADMINISTRATION_DELETE_ANNOUNCES_STORAGE_LIFE_OVER", "Удаление объявлений с истекшим сроком размещения");

define("FORM_CONF_ADMINISTRATION_ARCHIVED_ANNOUNCES_STORAGE_LIFE_OVER", "Архивирование объявлений с истекшим сроком размещения");

define("FORM_CONF_ADMINISTRATION_RESET_VIP_STORAGE_LIFE_OVER", "Обнуление VIP-статусов объявлений с истекшим сроком действия");

define("FORM_CONF_ADMINISTRATION_RESET_HOT_STORAGE_LIFE_OVER", "Обнуление HOT-статусов объявлений с истекшим сроком действия");

define("FORM_CONF_SERVICE_DESIGNER_ADVERTISEMENT_TOP", "Верхний рекламный блок");

define("FORM_CONF_SERVICE_DESIGNER_HEAD", "Шапка сайта");

define("FORM_CONF_SERVICE_DESIGNER_LEFT_SIDE", "Левая панель");

define("FORM_CONF_SERVICE_DESIGNER_CENTER_SIDE", "Центральная панель");

define("FORM_CONF_SERVICE_DESIGNER_RIGHT_SIDE", "Правая панель");

define("FORM_CONF_SERVICE_DESIGNER_FOOT", "Футер сайта");

define("FORM_CONF_SERVICE_DESIGNER_ADVERTISEMENT_BOTTOM", "Нижний рекламный блок");

define("FORM_CONF_SERVICE_DESIGNER_ADVERTISEMENT", "Рекламный блок");

define("FORM_CONF_EDITOR_TEMPLATES_LIST", "Шаблон");

define("FORM_CONF_EDITOR_TEMPLATE_TPL_TAB_NAME", "Файлы шаблона");

define("FORM_CONF_EDITOR_TEMPLATE_CSS_TAB_NAME", "Файлы стилей");

define("FORM_CONF_EDITOR_TEMPLATE_PICS_TAB_NAME", "Файлы изображений");

define("FORM_CONF_EDITOR_TEMPLATE_TPL_FILES_LIST", "Файл шаблона");

define("FORM_CONF_EDITOR_TEMPLATE_CSS_FILES_LIST", "Файл стиля");

define("FORM_EDITOR_TEMPLATE_CLONE_BUTTON_TITLE", "Клонирование шаблона");

define("FORM_EDITOR_TEMPLATE_CLONE_TITLE", "Клонирование шаблона");

define("FORM_EDITOR_TEMPLATE_FIELD_NAME", "Название шаблона");

define("FORM_EDITOR_TEMPLATE_CSS_INCLUDE", "Включать файлы стилей");

define("FORM_EDITOR_TEMPLATE_PICS_INCLUDE", "Включать файлы изображений");

define("FORM_EDITOR_TEMPLATE_FILES_CREATE_EMPTY", "Создать файлы шаблона пустыми <em>(*.tpl)</em>");

define("FORM_EDITOR_TEMPLATE_CHECK_LIST_FILES_BUTTON_TITLE", "Получить изменения списка файлов из шаблона default");

define("FORM_EDITOR_TEMPLATE_DELETE_BUTTON_TITLE", "Удалить шаблон");

define("FORM_EDITOR_TEMPLATE_DELETE_TITLE", "Удаление шаблона");

define("FORM_EDITOR_TEMPLATE_TPL_FILES_ADD_BUTTON_TITLE", "Добавить новый файл шаблона в список");

define("FORM_EDITOR_TEMPLATE_TPL_FILES_ADD_TITLE", "Добавление нового файла шаблона в список");

define("FORM_EDITOR_TEMPLATE_TPL_FILES_DELETE_BUTTON_TITLE", "Удалить текущий файл шаблона из списка");

define("FORM_EDITOR_TEMPLATE_TPL_FILES_DELETE_TITLE", "Удаление файла шаблона из списка");

define("FORM_EDITOR_TEMPLATE_TPL_FILE_FIELD_DESCRIPTION", "Описание файла шаблона");

define("FORM_EDITOR_TEMPLATE_CSS_FILES_ADD_BUTTON_TITLE", "Добавить новый файл стилей в список");

define("FORM_EDITOR_TEMPLATE_CSS_FILES_ADD_TITLE", "Добавление нового файла стилей в список");

define("FORM_EDITOR_TEMPLATE_CSS_FILES_DELETE_BUTTON_TITLE", "Удалить текущий файл стилей из списка");

define("FORM_EDITOR_TEMPLATE_CSS_FILES_DELETE_TITLE", "Удаление файла стилей из списка");

define("FORM_CONF_EDITOR_TEMPLATE_CREATE_SUCCESS_TITLE", "Шаблон успешно создан");

define("FORM_CONF_EDITOR_TEMPLATE_CREATE_SUCCESS_MESSAGE", "Сейчас, Вы автоматически будете перемещены на страницу управления новым шаблоном");

/**
 * ФОРМА НАСТРОЕК ЛОГОВ
 */
define("FORM_CONF_LOGS_ADMIN", "Логировать входы в панель администратора");

/**
 * ФОРМЫ ШАБЛОНОВ ПОЧТОВЫХ СООБЩЕНИЙ
 */
define("FORM_MAIL_TEMPLATES_FILE", "Файл шаблона сообщения");

/**
 * ФОРМА ОБНОВЛЕНИЙ ПРОДУКТА
 */
define("FORM_SYSTEM_UPDATES_LOGIN", "Логин (с форума sd-group.org.ua)");

define("FORM_SYSTEM_UPDATES_PASSWORD", "Пароль (с форума sd-group.org.ua)");

define("FORM_CONF_UPDATES_PATH_TO_FILES", "Путь к файлам (архиву) обновления");

define("FORM_SYSTEM_UPDATES_UPDATE_DB", "Частичное обновление БД и файлов");

define("FORM_SYSTEM_UPDATES_EXTRACT_FILES", "Извлечение файлов");

/**
 * ФОРМА РЕЗЕРВНЫХ КОПИЙ
 */
define("FORM_CONF_BACKUPS_PATH_TO_FILES", "Путь к файлам (архиву) резервных копий");


/**
 * ФОРМА ИМПОРТ
 */
define("FORM_SYSTEM_IMPORT_WARNING", 'ВНИМАНИЕ! Во время импорта данных, нельзя закрывать браузер или перезагружать страницу, до окончания процесса');

define("FORM_SYSTEM_IMPORT_DESCRIPTION", '<p style="font-weight: bold;">Данные для импорта подготовлены.</p><p style="color: #FF0000;">ВНИМАНИЕ! Процесс может занять продолжительное время!<br>Во время импорта данных, нельзя закрывать браузер или перезагружать страницу, до окончания процесса.</p><p>Нажмите кнопку <b>"Выполнить"</b> для запуска импорта данных.</p>');

define("FORM_SYSTEM_IMPORT_CONTINUE_DESCRIPTION", '<p style="font-weight: bold; color: #FF0000;">Предыдущая операция импорта была прервана!</p><p style="font-weight: bold;">Вы можете продолжить импортирование данных с точки останова.</p><p>Рекомендуем Вам воспользоваться продолжения импорта данных.</p><p style="color: #FF0000;">ВНИМАНИЕ! Процесс может занять продолжительное время!<br>Во время импорта данных, нельзя закрывать браузер или перезагружать страницу, до окончания процесса.</p><p>Нажмите кнопку <b>"Продолжить"</b> для импорта данных.</p>');

define("FORM_SYSTEM_IMPORT_DB_TITLE", "Импорт базы данных");

define("FORM_SYSTEM_IMPORT_DB_TO_COMPLETE_TIME", "примерное время завершения импорта через");

define("FORM_SYSTEM_IMPORT_DB_COMPLETED", "процесс успешно завершен");

define("FORM_SYSTEM_IMPORT_TABLE_USERS", "Таблица Пользователей");

define("FORM_SYSTEM_IMPORT_NAME_TABLE_USERS", "Имя таблицы пользователей");

define("FORM_SYSTEM_IMPORT_TABLE_VACANCYS", "Таблица Вакансий");

define("FORM_SYSTEM_IMPORT_NAME_TABLE_VACANCYS", "Имя таблицы вакансий");

define("FORM_SYSTEM_IMPORT_TABLE_RESUMES", "Таблица Резюме");

define("FORM_SYSTEM_IMPORT_NAME_TABLE_RESUMES", "Имя таблицы резюме");

define("FORM_SYSTEM_IMPORT_TABLE_SECTIONS", "Таблица Разделов");

define("FORM_SYSTEM_IMPORT_NAME_TABLE_SECTIONS", "Имя таблицы разделов");

define("FORM_SYSTEM_IMPORT_TABLE_PROFESSIONS", "Таблица Профессий");

define("FORM_SYSTEM_IMPORT_NAME_TABLE_PROFESSIONS", "Имя таблицы профессий");

define("FORM_SYSTEM_IMPORT_TABLE_REGIONS", "Таблица Регионов");

define("FORM_SYSTEM_IMPORT_NAME_TABLE_REGIONS", "Имя таблицы регионов");

define("FORM_SYSTEM_IMPORT_TABLE_CITYS", "Таблица Городов");

define("FORM_SYSTEM_IMPORT_NAME_TABLE_CITYS", "Имя таблицы городов");

define("FORM_SYSTEM_IMPORT_TABLE_SUBSRIPTIONS", "Таблица Подписок");

define("FORM_SYSTEM_IMPORT_NAME_TABLE_SUBSRIPTIONS", "Имя таблицы подписок");

define("FORM_SYSTEM_IMPORT_TABLE_NEWS", "Таблица Новостей");

define("FORM_SYSTEM_IMPORT_NAME_TABLE_NEWS", "Имя таблицы новостей");

/**
 * ФОРМЫ РАССЫЛКИ
 */
define("FORM_MAILER_TEMPLATES_NEW", "Новый шаблон");

define("FORM_MAILER_SEND_ALL", "Отправить всем (включая тех, кто не подписан на рассылку)");

define("FORM_MAILER_TEXT", "Текст рассылки");

/**
 * ФОРМА ДОБАВЛЕНИЯ ПОЛЬЗОВАТЕЛЬСКИХ КОНСТАНТ
 */
define("FORM_ADD_LANG_CONST_CUSTOM_NAME", "Имя константы");

define("FORM_ADD_LANG_CONST_CUSTOM_VALUE", "Значение константы");
