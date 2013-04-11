<?php
/********************************************************
	JobExpert v1.0
	powered by Script Developers Group (SD-Group)
	email: info@sd-group.org.ua
	url: http://sd-group.org.ua/
	Copyright 2010-2015 (c) SD-Group
	All rights reserved
=========================================================
		Русский язык - Ошибки
********************************************************/
/**
 * @package
 * @todo
 */

(!defined('SDG')) ? die ('Triple protection!') : null;

define('ERROR_404', 'Error 404');

define('ERROR_404_DESCRIPTION', 'Page Not Found');

define('ERROR_404_MESSAGE_REQUIRED_PAGE', 'Запрашиваемая страница');

define('ERROR_404_MESSAGE_NOT_EXIST', 'не существует');

define('ERROR_404_RECOMMENDATIONS', 'Рекомендации');

define('ERROR_404_RECOMMENDATIONS_CHECK_URL', 'Проверьте правильность написания адреса страницы.');

define('ERROR_404_RECOMMENDATIONS_BACK_TO', 'Если проблемы все еще не устранены, вернитесь на');

define('ERROR_404_RECOMMENDATIONS_BACK_TO_MAIN_PAGE_LINK', 'главную страницу');

define('ERROR_404_RECOMMENDATIONS_BACK_TO_MAIN_PAGE', 'и выберите необходимую вам страницу в меню');

define('ERROR_NOT_CHANGE_DATA', 'Не удалось изменить данные! Попробуйте еще раз!');

define('ERROR_EMAIL', 'E-mail введен неверно!');

define('ERROR_CAPTCHA', 'Неверно введен код подтверждения!');

define('ERROR_AGREEMENT', 'Необходимо согласие с условиями пользовательского соглашения!');

define('ERROR_EMPTY_FIELDS', 'Необходимо заполнить все поля!');

define('ERROR_EMPTY_BIND_FIELDS', 'Необходимо заполнить все обязательные поля!');

define('ERROR_BIND_FIELD', 'Обязательно для заполнения!');

define('ERROR_EMAIL_EXISTS', 'Пользователь с таким E-mail уже зарегистрирован!');

define('ERROR_EMAIL_NOT_FOUND', 'Пользователь с таким E-mail не найден!');

define('ERROR_PASSWORD_NOT_CONFIRM_PASSWORD', 'Подтверждение пароля не соответствует паролю!');

define('ERROR_PASSWORD_SHORT', 'Пароль должен содержать не менее ' . CONF_REGISTER_USER_PASSWORD . ' символов!');

define('ERROR_PASSWORD', 'Неверный пароль!');

define('ERROR_PASSWORD_NOT_NEW_PASSWORD', 'Новый пароль должен отличаться от старого!');

define('ERROR_SUBJECT_SHORT', 'Тема должна содержать не менее 5 символов!');

define('ERROR_MESSAGE_SHORT', 'Сообщение должно содержать не менее 10 символов!');

define('ERROR_ACTIVATE_CODE', 'Неверный код активации!');

define('ERROR_ACTIVATE_ACCOUNT', 'Учетной записи не существует. Возможно вы указали неверный ключ или активация просрочена!');

define('ERROR_DATA', 'Неверные данные!');

define('ERROR_AUTHORIZE_ACCOUNT_NOT_ACTIVATE', 'Невозможно выполнить вход! Вероятнее всего, Ваш email-адрес не был активирован. Активируйте свой email-адрес, а затем попробуйте зайти снова.');

define('ERROR_NOT_SELECTED_DATA', 'Ничего не выбрано!');

define('ERROR_NON_DATA', 'Нет данных для отображения!');

define('ERROR_NOT_SELECT_GROUP', 'Не выбран тип учетной записи!');

define('ERROR_SELECTED_GROUP', 'Выбранной группы не существует!');

define('ERROR_DATE_FORMAT', 'Неверный формат даты!');

define('ERROR_SELECTED_NEWS', 'Такой новости не существует!');

define('ERROR_SELECTED_ARTICLE', 'Такой статьи не существует!');

define('ERROR_SELECTED_COMPANY', 'ОШИБКА! Выбранной компании не существует!');

define('ERROR_EMPTY_TITLE', 'Не заполнен заголовок!');

define('ERROR_EMPTY_SMALL_TEXT', 'Не заполнен краткий текст!');

define('ERROR_EMPTY_TEXT', 'Не заполнен текст!');

define('ERROR_SEND_EMAIL', 'Не удалось отправить почтовое сообщение. Обратитесь к администрации!');

define('ERROR_SEND_EMAIL_TRY_AGAIN', 'Не удалось отправить почтовое сообщение! Попробуйте еще раз.');

define('ERROR_ACTIVATE_ANNOUNCE', 'Не удалось активировать объявление. Обратитесь к администрации!');

define('ERROR_NOT_ENOUGH_RIGHTS', 'У Вас недостаточно прав для выполнения данного действия!');

define('ERROR_ANNOUNCE_NOT_SELECT', 'Не выбрано объявление для просмотра!');

define('ERROR_ANNOUNCE_NOT_EXISTS', 'Такого объявления не существует!');

define('ERROR_ANNOUNCE_ISSET', 'Данное объявление уже добавлено в базу данных сайта!');

define('ERROR_PHONE_FORMAT', 'Введен неверный формат телефонного номера!');

define('ERROR_DB_TYPE_QUERY_SELECT', 'Не установлен требуемый тип запроса (db::$dbTypeSelect = false), необходимо установить корректное значение: (db::$dbTypeSelect = multi | single)');

define('ERROR_DB_LIMIT_QUERY_SELECT', 'Некорректный параметр LIMIT в запросе. Корректные значения: false or array(&quot;strLimit&quot; => &quot;0, 10&quot;, &quot;calcRows&quot; => true | false)');

define('ERROR_MISMATCH_FIELDS', 'Ошибка! Несовпадение полей формы с полями в таблице:');

define('ERROR_USER_ALIAS_EMPTY', 'Для добавления новостей необходимо указать <b>ПСЕВДОНИМ</b> пользователя в личных данных!');

define('ERROR_SEARCH_SHORT_QUERY', 'Поисковый запрос должен содержать не менее 4 символов!');

define('ERROR_SEARCH_NONE_REQUIRED_FIELDS', 'Отсутствуют обязательные поля поискового запроса!');

define('ERROR_USER_AGREEMENT', 'Для регистрации следует принять условия соглашения!');

define('ERROR_SECTION_NOT_SELECT', 'Не выбран раздел!');

define('ERROR_REGION_NOT_SELECT', 'Не выбран регион!');

define('ERROR_PERIOD_NOT_SELECT', 'Не выбран период рассылки!');

define('ERROR_TYPE_SUBSCRIPTION_NOT_SELECT', 'Не выбран тип объявления!');

define('ERROR_NOT_SELECT_ACTION', 'Необходимо выбрать действие!');

define('ERROR_ONLY_ONE_VOTING_ARTICLE', 'Можно голосовать только один раз!');

define('ERROR_NOT_PAY_SYSTEM', 'Нет подключенных платежных систем!');

define('ERROR_PAY_SYSTEM_NOT_EXISTS', 'Выбранная платежная система не подключена или не настроена! Обратитесь к администрации.');

define('ERROR_PAY_SYSTEM_NOT_DEFINE_PRICE', 'ОШИБКА! Не выбрана услуга или для выбранной услуги не определена цена! Вернитесь и выберите другую платежную систему, или обратитесь к администрации.');

define('ERROR_HAVE_MAXIMUM_SUBSCRIPTIONS', 'ОШИБКА! Вы уже добавили максимальное количество подписок.');

define('ERROR_EMPTY_NAME_OR_SURNAME', 'ОШИБКА! Не заполнены обязательные поля Имя или Фамилия.');

define('ERROR_USER_NOT_EXISTS', 'ОШИБКА! Такого пользователя не существует!');

define('ERROR_USER_ALIAS_IS_EMPTY', 'ОШИБКА! Необходимо указать псевдоним пользователя!');

define('ERROR_USER_ALIAS_EXISTS', 'ОШИБКА! Такой псевдоним уже занят!');

define('ERROR_DELETE_LOGO', 'ОШИБКА! Не удалось удалить логотип!');

define('ERROR_UNABLE_PERFORM_OPERATION', 'ОШИБКА! Не удалось выполнить операцию. Свяжитесь с администрацией.');

define('ERROR_TO_PERFORM_ACTION_SPECIFY_ALIAS', 'Для выполнения данного действия необходимо заполнить псевдоним в личных данных!');

/***** Обработка файлов *****/
define('ERROR_FILE_NOT_FOUND', 'Не удалось найти файл!');

define('ERROR_FILE_NOT_SAVED', 'Не удалось сохранить файл!');

define('ERROR_FILE_NOT_OPEN', 'Не удалось открыть файл!');

define('ERROR_FILE_NOT_WRITE', 'Не удалось записать файл!');

define('ERROR_FILE_NOT_CLOSE', 'Не удалось закрыть файл!');

define('ERROR_FILE_NOT_CHMOD', 'Не удалось выставить права доступа к файлу. Попробуйте сделать это вручную.');

define('ERROR_CRITICAL_FILE_NOT_EXISTS', 'Критическая ошибка! Файл не обнаружен. Пожалуйста, обновите дистрибутив или обратитесь в службу техподдержки.');

define('ERROR_FILES_NOT_DELETE', 'Не удалось удалить файлы!');

/***** Загрузка файлов *****/
define('ERROR_FILE_NOT_SELECTED', 'Не выбран файл!');

define('ERROR_FILE_NOT_LOAD', 'Не удалось загрузить файл!');

define('ERROR_FILE_FORMAT_ERROR', 'Запрещена загрузка файлов данного формата!');

define('ERROR_FILE_LOAD_ONLY_PARTIAL', 'Загружаемый файл был получен только частично!');

define('ERROR_FILE_UPLOAD_MAX_FILESIZE', 'Размер принятого файла превысил максимально допустимый размер!');

define('ERROR_FILE_UPLOAD_NO_TMP_DIR', 'Отсутствует временная папка хранения файлов!');

define('ERROR_FILE_UPLOAD_CANT_WRITE', 'Не удалось записать файл на диск!');

define('ERROR_FILE_UPLOAD_EXTENSION', 'Не удалось загрузить файл из-за неверного расширения!');

define('ERROR_FILE_UPLOAD_DESTINATION', 'Невозможно скопировать файл в указанное место после его загрузки!');

define('ERROR_FILE_NOT_EXISTS', 'Такого файла не существует!');

define('ERROR_FILE_NAME', 'Недопустимое имя файла!');

define('ERROR_FILE_NOT_IMAGE', 'Указанный файл не является картинкой!');

define('ERROR_FILE_CREATE_THUMBNAIL', 'Ошибка! Не удалось создать иконку для изображения!');

define('ERROR_FILE_CREATE_WATERMARK', 'Ошибка! Не удалось создать водяной знак!');

define('ERROR_FILE_NOT_FOUND_WATERMARK', 'Ошибка! Не удалось найти изображение водяного знака!');

define('ERROR_FILE_NOT_FOUND_FONT', 'Ошибка! Не удалось найти файл шрифта!');

define('ERROR_FILE_EXISTS', 'Ошибка! Файл с таким именем уже существует! Переименуйте файл и попробуйте загрузить его снова.');

define('ERROR_DIR_NAME_UPLOAD', 'Недопустимое имя каталога!');

define('ERROR_DIR_UPLOAD_CANT_CREATE', 'Не удалось создать каталог на диске!');

define('ERROR_UNKNOWN', 'Неизвестная ошибка!');


/***** COMMENTS *****/
define('ERROR_COMMENT_TEXT_EMPTY', 'Введите текст комментария!');

define('ERROR_COMMENT_NEWS_NOT_FOUND', 'Не найдена новость!');

define('ERROR_COMMENT_ARTICLE_NOT_FOUND', 'Не найдена статья!');

define('ERROR_COMMENT_UNABLE_FILL_SERVICE_FIELDS', 'Не удалось заполнить сервисные поля!');

define('ERROR_COMMENT_UNABLE_ADD_COMMENT', 'Не удалось добавить комментарий!');

