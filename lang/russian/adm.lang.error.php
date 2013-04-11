<?php

/**
 * JobExpert v1.0
 * powered by Script Developers Group (SD-Group)
 * email: info@sd-group.org.ua
 * url: http://sd-group.org.ua/
 * Copyright 2010-2015 (c) SD-Group
 * All rights reserved
 * ===================================================
 * Русский язык админки - Ошибки
 * ===================================================
 */
(!defined('SDG')) ? die('Triple protection!') : null;

define('ERROR_404', 'Error 404');

define('ERROR_404_DESCRIPTION', 'Page Not Found');

define('ERROR_404_MESSAGE_REQUIRED_PAGE', 'Запрашиваемая страница');

define('ERROR_404_MESSAGE_NOT_EXIST', 'не существует');

define('ERROR_404_RECOMMENDATIONS', 'Рекомендации');

define('ERROR_404_RECOMMENDATIONS_CHECK_URL', 'Проверьте правильность написания адреса страницы.');

define('ERROR_404_RECOMMENDATIONS_BACK_TO', 'Если проблемы все еще не устранены, вернитесь на');

define('ERROR_404_RECOMMENDATIONS_BACK_TO_MAIN_PAGE_LINK', 'главную страницу');

define('ERROR_404_RECOMMENDATIONS_BACK_TO_MAIN_PAGE', 'и выберите необходимую вам страницу в меню');

define('ERROR_ACCESS_DENIED', 'Доступ запрещен!');

define('ERROR_CONNECT_DB', 'Не удалость подключиться к Базе данных!');

define('ERROR_CAPTCHA', 'Неверно введен код подтверждения!');

define('ERROR_NOT_SAVE_CHANGE', 'Не удалось сохранить изменения! Попробуйте еще раз.');

define('ERROR_FATAL_NOT_SAVE_CHANGE', 'Критическая ошибка: не удалось сохранить изменения!');

define('ERROR_FATAL_UNCORRECT_PARAMS', 'Критическая ошибка: полученные параметры некорректны!');

define('ERROR_MISMATCH_FIELDS', 'Ошибка! Несовпадение полей формы с полями в таблице!');

define('ERROR_REGION_MAJOR', 'Регион-Город: данный тип Региона не может содержать список городов!');

define('ERROR_REGION_SET_MAJOR', 'Не удалось установить статус Регион-Город!');

define('ERROR_REGION_DELETE_CHILD_RECORDS', 'Не удалось очистить список городов!');

define('ERROR_REGION_SET_ADD_CITY_ALLOWED', 'Не удалось выполнить действие!');

define('ERROR_EMPTY_NAME', 'Не заполнено название!');

define('ERROR_EMPTY_SECTION', 'Не выбран раздел!');

define('ERROR_EMPTY_TITLE', 'Не заполнен заголовок!');

define('ERROR_EMPTY_SUBJECT', 'Не заполнена тема!');

define('ERROR_EMPTY_SMALL_TEXT', 'Не заполнен краткий текст!');

define('ERROR_EMPTY_TEXT', 'Не заполнен текст!');

define('ERROR_DATETIME', 'Неверно задана дата или время!');

define('ERROR_DATE_FORMAT', 'Неверный формат даты!');

define('ERROR_EMPTY_FIELD', 'Пустое поле!');

define('ERROR_EMPTY_FORM_FIELDS', 'Все поля формы обязательны для заполнения!');

define('ERROR_GROUP_ALPHA', 'Название группы должно содержать только буквы!');

define('ERROR_GROUP_EXISTS', 'Такая группа уже существует!');

define('ERROR_GROUP_NOT_EXISTS', 'Такой группы не существует!');

define('ERROR_USER_NOT_EXISTS', 'Такого пользователя не существует!');

define('ERROR_GROUP_NOT_SELECTED', 'Не выбрана группа!');

define('ERROR_GROUP_SYSTEM_NOT_DELETE', 'Данная группа является системной. Системную группу нельзя удалить!');

define('ERROR_GROUP_USED_IN_CONFIG', 'Данную группу нельзя удалить, так как она используется в настройках, как группа по умолчанию, при регистрации пользователей! Сначала измение настройки групп, а затем снова попробуйте удалить группу из базы данных!');

define('ERROR_GROUP_SET_IN_USER', 'Данную группу нельзя удалить, так как есть зарегистриованные пользователи, которые состоят в этой группе! Сначала смените группу у этих пользователей, а затем снова попробуйте удалить группу из базы данных!');

define('ERROR_EMPTY_ID', 'Не указан ID!');

define('ERROR_ID', 'Недопустимый ID!');

define('ERROR_EXISTS_ID', 'Страница с таким ID уже существует!');

define('ERROR_DB_TYPE_QUERY_SELECT', 'Не установлен требуемый тип запроса (db::$dbTypeSelect = false), необходимо установить корректное значение: (db::$dbTypeSelect = multi | single)');

define('ERROR_DB_LIMIT_QUERY_SELECT', 'Некорректный параметр LIMIT в запросе. Корректные значения: false or array(key: &quot;strLimit&quot; => val: string of LIMIT for example: &quot;0, 10&quot;, key: &quot;calcRows&quot; => val: true | false)');

define('ERROR_SECTION_NOT_EXISTS', 'Такого раздела не существует!');

define('ERROR_NOT_SELECT_ACTION', 'Необходимо выбрать действие!');

define('ERROR_DICT_SELECT_ALIAS_EXISTS', 'Список с таким Алиасом уже существует!');

define('ERROR_DICT_SELECT_ALIAS_NOTEXISTS', 'Списка с таким Алиасом не существует!');

define('ERROR_EMAIL_IS_EMPTY', 'Не указан Email-адрес!');

define('ERROR_PASSWORD_IS_EMPTY', 'Не указан пароль!');

define('ERROR_PASSWORD_IS_SHORT', 'Пароль должен содержать не менее ' . CONF_REGISTER_USER_PASSWORD . ' символов!');

define('ERROR_USER_TYPE_IS_EMPTY', 'Не выбран тип пользователя или тип пользователя неверный!');

define('ERROR_USER_GROUP_IS_EMPTY', 'Не выбрана группа пользователя!');

define('ERROR_FIRST_NAME_IS_EMPTY', 'Не указано имя пользователя!');

define('ERROR_LAST_NAME_IS_EMPTY', 'Не указана фамилия пользователя!');

define('ERROR_PHONE_IS_EMPTY', 'Не указан телефон пользователя!');

define('ERROR_USER_NOT_ADDED', 'Не удалось добавить пользователя! Посмотрите SQL-логи!');

define('ERROR_EMAIL_EXISTS', 'Пользователь с таким email-адресом уже существует!');

define('ERROR_ANNOUNCE_NOT_EXISTS', 'Такого объявления не существует!');

define('ERROR_MODS_PAYMENTS_TARIFFS_NOT_SAVE', 'Не удалось сохранить тарифную сетку! Возможно файл недоступен для записи.');

define('ERROR_MODS_PAYMENTS_CONFIG_NOT_SAVE', 'Не удалось сохранить настройки! Возможно файл недоступен для записи.');

define('ERROR_NOT_SPECIFIED_DATA_FOR_CHANGE', 'Не указаны данные для изменения!');

define('ERROR_IP_EXISTS_IN_ACCESS_LIST', 'Данный IP-адрес уже есть в списке!');

define('ERROR_IP_NOTEXISTS_IN_ACCESS_LIST', 'Данного IP-адреса нет в списке!');

define('ERROR_CLONE_TEMPLATE_EXSISTS', 'Шаблон с таким именем уже существует');

define('ERROR_CLONE_TEMPLATE_IS_EMPTY', 'Клонируемый шаблон не содержит файлов');

define('ERROR_CLONE_TEMPLATE_CREATE_DIR_FAILED', 'Ошибка создания директорий нового шаблона.<br><br>Пожалуйста, проверьте права доступа или обратитесь в службу поддержки.');

define('ERROR_DELETE_TEMPLATE_NAME_DEFAULT', 'Удаление шаблона &quot;default&quot; - запрещено.');

define('ERROR_DELETE_TEMPLATE_CONF_DEFAULT', 'Удаление шаблона, используемого по умолчанию в настройках сайта - запрещено.');

define('ERROR_DELETE_TEMPLATE_FAILED', 'Ошибка удаления шаблона.<br><br>Пожалуйста, проверьте права доступа или обратитесь в службу поддержки.');

define('ERROR_UNABLE_TO_RETRIEVE_DATA', 'ОШИБКА! Не удалось получить данные!');

define('ERROR_CONST_LANG_CUSTOM_EXSISTS', 'Константа с таким именем уже существует!');

define('ERROR_CONST_LANG_CUSTOM_NOEXSISTS', 'Константа с таким именем не существует!');

define('ERROR_COULD_NOT_FOUND_RECORD_TO_UPDATE', 'ОШИБКА! Не найдена запись для обновления!');

define('ERROR_UNDEFINED', 'Неизвестная ошибка!');

define('ERROR_USER_REQUIRED_FIELDS_IS_EMPTY', 'ОШИБКА! Заполнены не все обязательные поля профиля пользователя!');



/**
 * Обработка файлов
 */
define('ERROR_FILE_NOT_FOUND', 'ОШИБКА! Не удалось найти файл!');

define('ERROR_FILE_NOT_SAVED', 'ОШИБКА! Не удалось сохранить файл!');

define('ERROR_FILE_NOT_OPEN', 'ОШИБКА! Не удалось открыть файл!');

define('ERROR_FILE_NOT_WRITE', 'ОШИБКА! Не удалось записать файл!');

define('ERROR_FILE_NOT_CLOSE', 'ОШИБКА! Не удалось закрыть файл!');

define('ERROR_FILE_NOT_DELETE', 'ОШИБКА! Не удалось удалить файл!');

define('ERROR_FILE_NOT_CHMOD', 'ОШИБКА! Не удалось выставить права доступа к файлу. Попробуйте сделать это вручную.');

define('ERROR_CRITICAL_FILE_NOT_EXISTS', 'Критическая ошибка! Файл не обнаружен. Пожалуйста, обновите дистрибутив или обратитесь в службу техподдержки.');

define('ERROR_FILES_NOT_DELETE', 'ОШИБКА! Не удалось удалить файлы!');

define('ERROR_FILES_EXISTS_FILE_NAME', 'ОШИБКА! Файл с таким именем уже существует!');

define('ERROR_FILES_MISSING_FILE', 'ОШИБКА! Не удалось сохранить файл! Возможно файла не существует или у него отсутствуют права на запись.');

/**
 * Загрузка файлов
 */
define('ERROR_FILE_NOT_SELECTED', 'ОШИБКА! Не выбран файл!');

define('ERROR_FILE_NOT_LOAD', 'ОШИБКА! Не удалось загрузить файл!');

define('ERROR_FILE_FORMAT_ERROR', 'ОШИБКА! Запрещена загрузка файлов данного формата!');

define('ERROR_FILE_LOAD_ONLY_PARTIAL', 'ОШИБКА! Загружаемый файл был получен только частично!');

define('ERROR_FILE_UPLOAD_MAX_FILESIZE', 'ОШИБКА! Размер принятого файла превысил максимально допустимый размер!');

define('ERROR_FILE_UPLOAD_NO_TMP_DIR', 'ОШИБКА! Отсутствует временная папка хранения файлов!');

define('ERROR_FILE_UPLOAD_CANT_WRITE', 'ОШИБКА! Не удалось записать файл на диск!');

define('ERROR_FILE_UPLOAD_EXTENSION', 'ОШИБКА! Не удалось загрузить файл из-за неверного расширения!');

define('ERROR_FILE_UPLOAD_DESTINATION', 'ОШИБКА! Невозможно скопировать файл в указанное место после его загрузки!');

define('ERROR_FILE_NOT_EXISTS', 'ОШИБКА! Такого файла не существует!');

define('ERROR_FILE_NAME', 'ОШИБКА! Недопустимое имя файла!');

define('ERROR_FILE_NAME_EMPTY', 'ОШИБКА! Имя файла обязательно для заполнения');

define('ERROR_FIELD_NAME_EMPTY', 'ОШИБКА! Название обязательно для заполнения!');

define('ERROR_FILE_NOT_IMAGE', 'ОШИБКА! Указанный файл не является картинкой!');

define('ERROR_FILE_CREATE_THUMBNAIL', 'ОШИБКА! Не удалось создать иконку для изображения!');

define('ERROR_FILE_CREATE_WATERMARK', 'ОШИБКА! Не удалось создать водяной знак!');

define('ERROR_FILE_NOT_FOUND_WATERMARK', 'ОШИБКА! Не удалось найти изображение водяного знака!');

define('ERROR_FILE_NOT_FOUND_FONT', 'ОШИБКА! Не удалось найти файл шрифта!');

define('ERROR_DIR_NAME_UPLOAD', 'Недопустимое имя каталога!');

define('ERROR_DIR_UPLOAD_CANT_CREATE', 'Не удалось создать каталог на диске!');

define('ERROR_FILE_EXISTS', 'Ошибка! Файл с таким именем уже существует! Переименуйте файл и попробуйте загрузить его снова.');

/**
 * Почта
 */
define('ERROR_SEND_EMAIL', 'ОШИБКА! Не удалось отправить письмо. Обратитесь к разработчикам!');

/*
 * ОШИБКИ СТРАНИЦЫ ОБНОВЛЕНИЯ
 */
define('ERROR_UPDATES_USER_NOT_FOUND', 'ОШИБКА! Пользователь не найден!');

define('ERROR_UPDATES_NO_ACCESS_TO_THE_FORUM_GROUP', 'ОШИБКА! Нет допуска в соответствующую группу форума!');

define('ERROR_UPDATES_NOT_FOUND_PRODUCT_IN_SALES_LIST', 'ОШИБКА! В списке продуктов нет позиции соответствующей указанным параметрам!');

define('ERROR_UPDATES_LICENSE_NOT_ACTIVATE', 'ОШИБКА! Не активировано время действия лицензии!');

define('ERROR_UPDATES_LICENSE_EXPIRED', 'ОШИБКА! Истек срок действия лицензии!');

define('ERROR_UPDATES_INTERMEDIATE_REVISION', 'ОШИБКА! Не соблюден порядок установки обновлений или запрашиваемой сборки не существует!');

define('ERROR_UPDATES_REVISION_NOT_FOUND', 'ОШИБКА! Не найдена сборка или отсутсвует файл сборки!');

define('ERROR_UPDATES_UPDATE_FILE_NOT_FOUND', 'ОШИБКА! Не найден пакет обновлений!');

define('ERROR_UPDATES_UNABLE_EXTRACT_FILES', 'ОШИБКА! Не удалось извлечь обновление!');

define('ERROR_UPDATES_REQUEST_UNDEFINED_ACTION', 'ОШИБКА! Запрошено неверное действие!');

/**
 * ОШИБКИ CURL
 */
define('ERROR_PROXY_AUTHENTICATION_REQUIRED', 'ОШИБКА! Необходима авторизация на прокси!');

define('ERROR_CURL_NOEXEC', 'ОШИБКА! Не удалось выполнить CURL-запрос!');

/**
 * ОШИБКИ РАССЫЛКИ
 */
define('ERROR_MAILER_SELECT_GROUP_OR_TYPE', 'ОШИБКА! Необходимо выбрать группы или типы пользователей, которым будет осуществлена рассылка!');

define('ERROR_MAILER_TEXT_IS_SHORT', 'ОШИБКА! Слишком короткий текст рассылки!');

define('ERROR_MAILER_TEMPLATES_NAME', 'ОШИБКА! Неверно задано имя шаблона! Имя может содержать следующие символы: A-z,0-9,_');

define('ERROR_MAILER_TEMPLATES_NOT_SELECTED', 'ОШИБКА! Не выбран шаблон!');

define('ERROR_MAILER_TEMPLATES_NOT_SELECTED_OR_EMPTY', 'ОШИБКА! Не выбран шаблон или не заполнен текст шаблона!');

define('ERROR_MAILER_TEMPLATES_FAILED_CREATE_FILE', 'ОШИБКА! Не удалось создать файл шаблона!');

define('ERROR_MAILER_TEMPLATES_FAILED_TO_REMOVE_FILE', 'ОШИБКА! Не удалось удалить файл шаблона!');
