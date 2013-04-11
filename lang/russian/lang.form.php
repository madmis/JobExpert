<?php
/********************************************************
	JobExpert v1.0
	powered by Script Developers Group (SD-Group)
	email: info@sd-group.org.ua
	url: http://sd-group.org.ua/
	Copyright 2010-2015 (c) SD-Group
	All rights reserved
=========================================================
		Русский язык - Формы
********************************************************/
/**
 * @package
 * @todo
 */

(!defined('SDG')) ? die ('Triple protection!') : null;

/*** Кнопки ***/
define('FORM_BUTTON_SAVE', 'Сохранить');

define('FORM_BUTTON_SEND', 'Отправить');

define('FORM_BUTTON_EDIT', 'Исправить');

define('FORM_BUTTON_LOGIN', 'Войти');

define('FORM_BUTTON_EXECUTE', 'Выполнить');

define('FORM_BUTTON_ADD', 'Добавить');

define('FORM_BUTTON_ACTIVATE', 'Активировать');

define('FORM_BUTTON_NEXT', 'Далее');

define('FORM_BUTTON_PREV', 'Назад');

define('FORM_BUTTON_SEARCH', 'Поиск');

define('FORM_BUTTON_UPLOAD', 'Загрузить');

/*** ДЕЙСТВИЯ ***/
define('FORM_ACTION_SELECT', 'Выберите действие...');

define('FORM_ACTION_SELECT_LIST', 'Выберите из списка');

define('FORM_ACTION_ARCHIVE', 'Поместить в архив');

define('FORM_ACTION_EXTRACT', 'Извлечь из архива');

define('FORM_ACTION_ADVERTISE', 'Разместить на сайте');

define('FORM_ACTION_SAVE_CHANGE', 'Сохранить изменения');

define('FORM_ACTION_DELETE', 'Удалить');

define('FORM_ACTION_DELETE_SELECTED', 'Удалить выбранные');

define('FORM_ACTION_PAY', 'Оплатить');

define('FORM_ACTION_PAY_SELECTED', 'Оплатить выбранные');

define('FORM_ACTION_EDIT_VISIBILITY', 'Изменить Тип размещения');

define('FORM_ACTION_EDIT', 'Исправить');

/*** ТИПЫ ПОЛЬЗОВАТЕЛЕЙ ***/
define('FORM_TYPE_AGENT', 'Агент');

define('FORM_TYPE_COMPANY', 'Компания');

define('FORM_TYPE_EMPLOYER', 'Работодатель');

define('FORM_TYPE_COMPETITOR', 'Соискатель');

/*** ФОРМЫ ***/
define('FORM_SUBJECT', 'Тема');

define('FORM_EMAIL', 'E-mail');

define('FORM_PASSWORD', 'Пароль');

define('FORM_CONFIRM_PASSWORD', 'Подтверждение пароля');

define('FORM_USER_AGREEMENT', 'Я принимаю условия соглашения');

define('FORM_MESSAGE', 'Сообщение');

define('FORM_ACTIVATE_CODE', 'Код активации');

define('FORM_REMEMBER', 'Запомнить');

define('FORM_SELECT_TYPE', 'Выберите тип учетной записи');

define('FORM_USER_BIRTHDAY', 'Дата рождения');

define('FORM_DATE', 'Дата');

define('FORM_PUBLICATION_DATE', 'Дата публикации');

define('FORM_PUBLICATION_TIME', 'Вермя публикации');

define('FORM_RECORDS', 'Записей на странице');

define('FORM_IN_ARCHIVE', 'В архиве');

define('FORM_ACTIVE', 'Активная');

define('FORM_IN_ARCHIVE_IMP', 'не важно');

define('FORM_IN_ARCHIVE_YES', 'да');

define('FORM_IN_ARCHIVE_NO', 'нет');

define('FORM_TITLE', 'Заголовок');

define('FORM_TEXT', 'Текст');

define('FORM_SMALL_TEXT', 'Краткий текст');

define('FORM_KEYWORDS', 'Ключевые слова');

define('FORM_DESCRIPTION', 'Описание (DESCRIPTION)');

define('FORM_TIME', 'Время');

define('FORM_SET_NOW', 'Установить текущие');

define('FORM_NOW_PASSWORD', 'Текущий пароль');

define('FORM_NEW_PASSWORD', 'Новый пароль');

define('FORM_FIRST_NAME', 'Имя');

define('FORM_LAST_NAME', 'Фамилия');

define('FORM_PHONE', 'Телефон');

define('FORM_INPUT_OTHER', 'Другой...');

define('FORM_CAPTCHA_REFRESH', 'Нажмите чтобы обновить...');

define('FORM_LOOK_AT', 'Просмотр');

define('FORM_SEND_EMAIL', 'Отправить сообщение');

define('FORM_ALL', 'Все');

define('FORM_SECTIONS', 'Разделы');

define('FORM_GENERAL', 'Общие');

define('FORM_ADMIN_COMMENTS', 'Комментарии администратора');

define('FORM_AUTHOR', 'Автор');

define('FORM_NO_COMMENTS', 'Запретить добавлять комментарии');

/*** ФОРМЫ НОВОСТЕЙ ***/
define('FORM_NEWS_ADD', 'Добавление новости');

define('FORM_NEWS_EDIT', 'Исправление новости');

define('FORM_NEWS_PUBLICATION_DATE', 'Дата публикации');

define('FORM_NEWS_PUBLICATION_TIME', 'Время публикации');

/*** ФОРМЫ ПОИСКА ***/
define('FORM_SEARCH_IN_VACANCY', 'вакансии');

define('FORM_SEARCH_IN_RESUME', 'резюме');

define('FORM_SEARCH_MORE_OPTIONS', 'Дополнительные параметры');

define('FORM_SEARCH_EXACTMATCH', 'Точное соответствие');

define('FORM_SEARCH_ANY_WORDS', 'С любым из слов');

define('FORM_SEARCH_ANY_SECTION', 'Все разделы');

define('FORM_SEARCH_ANY_PROFESSION', 'Все профессии');

define('FORM_SEARCH_ANY_REGION', 'Все регионы');

define('FORM_SEARCH_ANY_CITY', 'Все города');

define('FORM_SEARCH_SALARY', 'Зарплата');

define('FORM_SEARCH_PERIOD', 'Период');

define('FORM_SEARCH_USER_TYPE', 'Тип пользователя');

define('FORM_SEARCH_ANY', 'Не важно');

/*** СЕЛЕКТ 'Период' ***/
define('FORM_SEARCH_PERIOD_TODAY', 'Сегодня');

define('FORM_SEARCH_PERIOD_YESTERDAY', 'Вчера');

define('FORM_SEARCH_PERIOD_7_DAYS', 'За последние 7 дней');

define('FORM_SEARCH_PERIOD_MONTH', 'За месяц');

define('FORM_SEARCH_PERIOD_ALL', 'За все время');

/*** ДАННЫЕ ПОЛЬЗОВАТЕЛЯ ***/
define('FORM_COMPANY_LOGO', 'Логотип компании');

define('FORM_DATA_COMPANY', 'Данные компании');

define('FORM_DATA_COMPETITOR', 'Данные соискателя');

define('FORM_COMPANY_CITY', 'Город компании');

define('FORM_USER_MAILER_SUBSCRIBE', 'Подписаться на рассылку сайта');

define('FORM_COMPANY_URL', 'Web-сайт компании');

define('FORM_COMPANY_HIDE_ADDITIONAL_DATA', 'Скрыть дополнительные данные компании');

/*** ФОРМА ПОДПИСКИ ПОЛЬЗОВАТЕЛЯ ***/
define('FORM_SUBSCRIPTION_ADD', 'Добавление подписки');

define('FORM_SUBSCRIPTION_SEND_TEST_MAIL', 'Выполнить тестовую рассылку');

define('FORM_SUBSCRIPTION_SIGN_ON', 'Подписаться на');

define('FORM_SUBSCRIPTION_SELECT_PERIOD', 'Выберите период рассылки');

/*** ФОРМЫ СТАТЕЙ ***/
define('FORM_ARTICLES_ADD', 'Добавление статьи');

define('FORM_ARTICLES_EDIT', 'Исправление статьи');

define('FORM_ARTICLES_AUTHOR', 'Автор');

define('FORM_ARTICLES_RATING', 'Рейтинг');

define('FORM_ARTICLES_VOTES', 'голосов');

define('FORM_ARTICLES_VOTING', 'голосовать');

/*** ФОРМЫ КОММЕНТАРИЕВ ***/
define('FORM_COMMENTS_COMPLAINT', 'Пожаловаться на комментарий');

define('FORM_COMMENT', 'Комментарий');

define('FORM_COMMENTS', 'Комментариев');

define('FORM_COMMENTS_HIDE_FORM', 'Скрыть форму');

define('FORM_COMMENTS_SHOW_FORM', 'Показать форму');

define('FORM_COMMENTS_HIDE_COMMENTS', 'Скрыть комментарии');

define('FORM_COMMENTS_SHOW_COMMENTS', 'Показать комментарии');