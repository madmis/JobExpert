<?php

/**
 * JobExpert v1.0
 * powered by Script Developers Group (SD-Group)
 * email: info@sd-group.org.ua
 * url: http://sd-group.org.ua/
 * Copyright 2010-2015 (c) SD-Group
 * All rights reserved
 * ===================================================
 * Русский язык админки - Сообщения
 * ===================================================
 */
(!defined('SDG')) ? die('Triple protection!') : null;

/**
 * WARNINGS
 */
define('MESSAGE_WARNING_NOT_SELECT_RECORDS', 'Не выбраны записи для изменения!');

define('MESSAGE_PERFORM_OPERATION', 'Вы уверены, что хотите выполнить данное действие?');

define('MESSAGE_DELETE_BLOCK', 'УДАЛЕНИЕ: Вы уверены, что хотите удалить блок?');

define('MESSAGE_DELETE_RECORD', 'УДАЛЕНИЕ: Вы уверены, что хотите удалить запись?');

define('MESSAGE_DELETE_RECORDS', 'УДАЛЕНИЕ: Вы уверены, что хотите удалить выбранные записи?');

define('MESSAGE_DELETE_IP_FROM_LIST', 'УДАЛЕНИЕ: Вы уверены, что хотите IP-адрес из списка?');

define('MESSAGE_DELETE_RECORDS_NOT_SEND_MAILS', 'УДАЛЕНИЕ: Вы уверены, что хотите удалить выбранные записи? При множественном удалении пользователи не получат уведомления по почте!');

define('MESSAGE_ACTIVE_RECORDS_NOT_SEND_MAILS', 'АКТИВАЦИЯ: Вы уверены, что хотите активировать выбранные записи? При множественной активации пользователи не получат уведомления по почте!');

define('MESSAGE_CORRECTION_RECORDS_NOT_SEND_MAILS', 'ИСПРАВЛЕНИЕ: Вы уверены, что хотите отправить на исправление выбранные записи? При множественной отправке пользователи не получат уведомления по почте!');

define('MESSAGE_CLEAR_LOGS', 'УДАЛЕНИЕ: Вы уверены, что хотите очистить логи?');

define('MESSAGE_DELETE_RECORDS_SECTIONS', 'УДАЛЕНИЕ: При удалении раздела будут удалены все профессии, объявления и подписки, относящиеся к данному разделу! Вы уверены, что хотите удалить выбранные записи?');

define('MESSAGE_DELETE_RECORDS_PROFESSIONS', 'УДАЛЕНИЕ: При удалении профессии будут удалены все объявления и подписки, относящиеся к данной профессии! Вы уверены, что хотите удалить выбранные записи?');

define('MESSAGE_DELETE_RECORDS_REGIONS', 'УДАЛЕНИЕ: При удалении региона будут удалены все города, объявления и подписки, относящиеся к данному региону! Вы уверены, что хотите удалить выбранные записи?');

define('MESSAGE_DELETE_RECORDS_CITYS', 'УДАЛЕНИЕ: При удалении города будут удалены все объявления и подписки, относящиеся к данному городу! Вы уверены, что хотите удалить выбранные записи?');

define('MESSAGE_DELETE_RECORDS_ARTICLES_SECTIONS', 'УДАЛЕНИЕ: При удалении раздела будут удалены все статьи, входящие в данный раздел! Вы уверены, что хотите удалить выбранные записи?');

define('MESSAGE_DELETE_DICT_SELECTS_ALIAS', 'УДАЛЕНИЕ: После удаления списка, его использование в коде скрипта станет невозможным! Вы уверены, что хотите удалить данный список?');

define('MESSAGE_DELETE_DICT_SELECTS_VALUE', 'УДАЛЕНИЕ: Вы уверены, что хотите удалить данное значение?');

define('MESSAGE_DELETE_CONST_LANG_CUSTOM', 'Вы уверены, что хотите удалить данную константу');

define('MESSAGE_WARNING_UNKNOWN_ACTION', 'Вызвано неизвестное действие! Пожалуйста, свяжитесь с разработчиками скрипта.');

define('MESSAGE_WARNING_CREATE_BACKUP', 'Перед установкой обновления желательно сделать полную резервную копию сайта.<p>Вы можете сделать необходимые резервные копии непосредственно на этой странице, либо же воспользоваться средствами панели вашего хостинга.</p><p>Использование средств панели вашего хостинга является более предпочтительным вариантом.</p>');

define('WARNING_CONF_USER_REGISTER_DISABLED', 'Настройка регистрации пользователей отключена. Пользователи не могут регистрироваться у вас на сайте.');

define('WARNING_CONF_USER_ACTIVATE_DISABLED', 'Настройка активации email-адреса пользователя отключена');

define('WARNING_ACTION_USER_MESSAGE_EMPTY', 'Необходимо заполнить текст уведомления!');

define('WARNING_NOT_FORGET_SITE_ON_MAINTENANCE', 'Перед обновлением не забывайте отключать сайт на техническое обслуживание');

define('WARNING_BACKUP_NOT_CREATE', 'Не удалось создать резервную копию. Перезагрузите страницу и попробуйте еще раз, или воспользуйтесь средствами панели вашего хостинга.');

define('MESSAGE_WARNING_INSTALLING_UPDATE', '<p><b>Ожидайте!</b></p><p>Производится установка обновления. Этот процесс может занять от нескольких секунд, до нескольких минут.</p><p>Во избежание проблем с установкой не обновляйте страницу самостоятельно и не нажимайте никаких клавиш.</p><p>Если процесс обновления слишком затянулся или закончился неудачей, перешлите файл логов разработчикам (с указанием доменного имени вашего сайта) и ожидайте от них ответа. Убедительно просим вас не предпринимать никаких действий, не согласованных с разработчиками.</p>');

define('MESSAGE_WARNING_UPDATE_ERRORS_OCCURRED', '<p>Во время установки обновления произошли ошибки.</p><p>Сохраните файл лога ошибок и перешлите его разработчикам (с указанием доменного имени вашего сайта). После этого обязательно сделайте восстановление сайта из созданной перед обновлением резервной копии.</p>');

define('MESSAGE_WARNING_UPDATE_SETUP_BUT_ERRORS_OCCURRED', 'Обновление было установлено, но в процессе обновления были обнаружены ошибки. Перешлите файл лога ошибок разработчикам (с указанием доменного имени вашего сайта) и ожидайте от них ответа. Убедительно просим вас не предпринимать никаких действий, не согласованных с разработчиками.');

define('MESSAGE_WARNING_TEMPLATE_DELETE', 'Вы уверены, что хотите удалить данный шаблон');

define('MESSAGE_WARNING_TPL_FILE_DELETE', 'Вы уверены, что хотите удалить текущий файл шаблона из списка');

define('MESSAGE_WARNING_CSS_FILE_DELETE', 'Вы уверены, что хотите удалить текущий файл стилей из списка');

define('MESSAGE_WARNING_MAILER_NOT_FOUND_USERS', 'Не удалось найти пользователей, отвечающих условиям запроса!');

/**
 * MESSAGES
 */
define('MESSAGE_WARNING_NOT_DELETE_CACHE_FILES', 'Не удалось удалить файлы кэша!');

define('MESSAGE_PROCESSING_PLEASE_WAIT', 'Пожалуйста, подождите окончания процесса');

define('MESSAGE_CHANGE_SAVED_REDIRECT', 'Нажмите здесь, если Ваш обозреватель не поддерживает автоматической переадресации.');

define('MESSAGE_CHANGE_SAVED', 'Изменения сохранены!');

define('MESSAGE_CHANGE_NOT_SAVED', 'Не удалось сохранить изменения!');

define('MESSAGE_PAGE_ADDED', 'Страница добавлена!');

define('MESSAGE_NEWS_ADDED', 'Новость успешно добавлена!');

define('MESSAGE_ARTICLE_ADDED', 'Статья успешно добавлена!');

define('MESSAGE_SECTION_ADDED', 'Раздел успешно добавлен!');

define('MESSAGE_USER_ADDED', 'Пользователь успешно добавлен!');

define('MESSAGE_PROFESSION_ADDED', 'Профессия успешно добавлена!');

define('MESSAGE_REGION_ADDED', 'Регион успешно добавлен!');

define('MESSAGE_CITY_ADDED', 'Город успешно добавлен!');

define('MESSAGE_FILE_LOAD_SUCCESS', 'Файл успешно загружен!');

define('MESSAGE_FILE_ADD_SUCCESS_TITLE', 'Файл успешно добавлен');

define('MESSAGE_TPL_FILE_ADD_SUCCESS_MESSAGE', 'Новый файл шаблона доступен для редактирования в списке');

define('MESSAGE_CSS_FILE_ADD_SUCCESS_MESSAGE', 'Новый файл стилей доступен для редактирования в списке');

define('MESSAGE_FILE_DELETE_SUCCESS', 'Файлы удалены!');

define('MESSAGE_FILE_SUCCESSFULLY_DELETED_TITLE', 'Файл успешно удален');

define('MESSAGE_TPL_FILE_SUCCESSFULLY_DELETED_MESSAGE', 'Файл шаблона удален из списка редактирования');

define('MESSAGE_CSS_FILE_SUCCESSFULLY_DELETED_MESSAGE', 'Файл стилей удален из списка редактирования');

define('MESSAGE_TEMPLATE_UPDATE_SUCCESS_TITLE', 'Список файлов шаблона успешно обновлен');

define('MESSAGE_TEMPLATE_UPDATE_SUCCESS_MESSAGE', 'Новые файлы шаблона доступны для редактирования в списке');

define('MESSAGE_TEMPLATE_UPDATE_LIST_DIFF_NOT_FOUND', 'Изменений в списке файлов шаблона &quot;default&quot; не найдено');

define('MESSAGE_TEMPLATE_DELETE_SUCCESS_TITLE', 'Шаблон успешно удален');

define('MESSAGE_TEMPLATE_DELETE_SUCCESS_MESSAGE', 'Сейчас, Вы автоматически будете перемещены на страницу управления шаблоном по умолчанию');

define('MESSAGE_GROUP_ADD', 'Группа успешно добавлена!');

define('MESSAGE_GROUP_DELETE', 'Группа удалена!');

define('MESSAGE_DATA_HAS_BEEN_CHANGED', 'Данные успешно изменены!');

define('MESSAGE_DATA_HAS_BEEN_DELETED', 'Данные успешно удалены!');

define('MESSAGE_DATA_HAS_NOT_BEEN_CHANGED', 'Данные не удалось изменить!');

define('MESSAGE_ACTION_SUCCESS', 'Выполнено успешно');

define('MESSAGE_COMMENTS_DELETE', 'Вы уверены, что хотите удалить комментарий?');

define('MESSAGE_COMMENTS_NOT_DELETE', 'Не удалось удалить комментарий!');

define('MESSAGE_WAIT_RUNNING_MILER', 'Ожидайте, выполняется рассылка');

define('MESSAGE_DO_NOT_RELOAD_PAGE', 'Не перезагружайте страницу');

define('MESSAGE_MAILER_SUCCESSFUL', 'Рассылка выполнена успешно! Отправлено сообщений');

define('MESSAGE_CACHE_CLEAR_SUCCESS', 'Кэш успешно очищен');

/**
 * ОБНОВЛЕНИЯ
 */
define('MESSAGE_UPDATES_UPDATE_DB_NOT_REQUIRED', 'Обновление базы данных и частичное обновление файлов не требуется!');

define('MESSAGE_UPDATES_UPDATE_DB_SUCCESS', 'Обновление базы данных и частичное обновление файлов завершено успешно!');

define('MESSAGE_UPDATE_SUCCESSFULLY_DOWNLOADED', 'Обновление успешно загружено! Ожидайте, сейчас начнется установка обновления.');

define('MESSAGE_BACKUP_SUCCESSFULLY_CREATED', 'Резервная копия успешно создана');

define('MESSAGE_UPDATE_SUCCESSFULLY_SETUP', 'Поздравляем, обновление успешно установлено!');
