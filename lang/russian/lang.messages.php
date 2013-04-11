<?php

/**
 * JobExpert v1.0
 * powered by Script Developers Group (SD-Group)
 * email: info@sd-group.org.ua
 * url: http://sd-group.org.ua/
 * Copyright 2010-2015 (c) SD-Group
 * All rights reserved
 * ===================================================
 * Русский язык - Сообщения
 * ===================================================
 */
(!defined('SDG')) ? die('Triple protection!') : null;

/**
 * WARNINGS
 */
define('MESSAGE_WARNING_NOT_SELECT_RECORDS', 'Не выбраны записи для изменения!');

define('MESSAGE_DELETE_RECORD', 'Вы уверены, что хотите удалить запись?');

define('MESSAGE_DELETE_RECORDS', 'Вы уверены, что хотите удалить выбранные записи?');

define('MESSAGE_DELETE_FILE', 'Вы уверены, что хотите удалить файл?');

define('MESSAGE_WARNING_UNKNOWN_ACTION', 'Вызвано неизвестное действие!');

define('MESSAGE_WARNING_PAYMENT_NO_MORE_THAN_ONE_RECORD', 'Для оплаты необходимо выбрать не более одной записи!');

/**
 * MESSAGES
 */
define('MESSAGE_NEED_AUTHORIZE', 'Внимание! Необходима авторизация.');

define('MESSAGE_CHANGE_SAVED', 'Изменения сохранены!');

define('MESSAGE_NEWS_ADDED', 'Новость успешно добавлена!');

define('MESSAGE_SUBSCRIPTION_ADDED', 'Подписка успешно добавлена!');

define('MESSAGE_TEST_SUBSCRIPTION_WAS_SEND', 'Тестовая рассылка успешно завершена. Проверьте свой почтовый ящик.');

define('MESSAGE_CHANGE_SAVED_REDIRECT', 'Нажмите здесь, если Ваш обозреватель не поддерживает автоматической переадресации.');

define('MESSAGE_WAS_SEND', 'Ваше сообщение успешно отправлено. Ожидайте ответ.');

define('MESSAGE_USER_REGISTERED', 'Вы уже зарегистрированы!');

define('MESSAGE_ACTIVATE_REG_USER', '<p align="center"><b>Регистрация успешно завершена.</b></p><p>На введенный Вами email-адрес было отправлено сообщение, в котором указана ссылка для активации аккаунта и код активации, который Вы можете ввести в поле ниже.</p><p><b>Обратите ВНИМАНИЕ</b>, Вы не сможете использовать свои регистрационные данные до тех пор, пока не будет завершена процедура активации. По истечение <b>' . CONF_USER_ACTIVATE_DELETE . '</b> часов, если аккаунт не будет активирован, информация о нем будет удалена из системы. Повторная регистрация с тем же Email-адресом так же будет возможна только по истечение <b>' . CONF_USER_ACTIVATE_DELETE . '</b> часов.</p><p>Если у Вас возникли трудности при регистрации, напишите нам через форму обратной связи.</p>');

define('MESSAGE_REGISTER_SUCCESS', 'Поздравляем! Учетная запись успешно зарегистрирована.');

define('MESSAGE_REGISTER_SUCCESS_DO_PAYMENT', 'Регистрация данного типа учетной записи платная!');

define('MESSAGE_REGISTER_SUCCESS_DO_PAYMENT_TEXT', 'Для завершения процесса регистрации необходимо внести плату за использование учетной записи. Сейчас Вы будете перенаправлены на страницу выбора платежной системы. После оплаты указанной суммы, Ваша учетная запись будет активирована.');

define('MESSAGE_REGISTER_SUCCESS_ACTIVATE_USER', 'На указанный при регистрации Вами Email-адрес было отправлено сообщение, в котором указана ссылка для активации аккаунта и код активации.');

define('MESSAGE_REGISTER_SUCCESS_TEXT', 'Теперь Вы можете войти в свой аккаунт используя указанные при регистрации: Логин(Email) и Пароль.');

define('MESSAGE_NEW_PASS_CONFIRM', 'На указанный Вами Email-адрес выслано сообщение для подтверждения смены пароля!');

define('MESSAGE_NEW_PASS_SUCCESS', 'На указанный Вами Email-адрес выслан новый пароль.<br>После входа в кабинет пользователя обязательно измените свой пароль.');

define('MESSAGE_SELECT_TYPE', '<p align="center"><b>Перед тем как Вы начнете пользоваться сервисами сайта, Вам необходимо выбрать тип учетной записи.</b></p><p align="center">От выбранного типа учетной записи будет зависеть набор доступных действий.</p><p align="center" style="color: red;"><b>Обратите внимание!</b> После выбора, тип учетной записи нельзя будет изменить. Изменить тип учетной записи сможет только <b>Администратор</b>.</p>');

define('MESSAGE_NOT_RIGHTS', '<p align="center"><b>У Вас нет прав для выполнения данного действия.</b></p><p align="center">Для получения прав обратитесь к администратору.</p>');

define('MESSAGE_PASSWORD_HAS_BEEEN_CHANGED', 'Пароль успешно изменен!');

define('MESSAGE_ACCOUNT_MODERATE', 'Аккаунт на модерации!');

define('MESSAGE_ACCOUNT_MODERATE_TEXT', 'В данный момент Ваша учетная запись находится на модерации.<br>Как только Ваша учетная запись будет проверена, мы известим Вас об этом на Email, указанный при регистрации.');

define('MESSAGE_NOT_FOUND_RECORDS', 'К сожалению, по Вашему запросу ничего не найдено! Попробуйте изменить параметры поиска.');

define('MESSAGE_PYMENT_WAS_SUCCESS', 'Оплата прошла успешно!');

define('MESSAGE_PYMENT_SUCCESSFULLY_ADDED', 'Платеж успешно добавлен. Ожидайте, с вами свяжется администратор.');

define('MESSAGE_PYMENT_WAS_SUCCESS_REGISTER', 'Ваша учетная запись успешно активирована.');

define('MESSAGE_SUBSCRIPTION_ADD_PAYMENT', 'Добавление данной подписки является платной услугой!');

define('MESSAGE_SUBSCRIPTION_ADD_PAYMENT_TEXT', '<p>Для завершения процесса добавления подписки необходимо внести плату. Сейчас Вы будете перенаправлены на страницу выбора платежной системы. После оплаты указанной суммы подписка будет активирована.</p><p>Если Вы не хотите или не можете оплатить сейчас, попробуйте оплатить позже. Все неоплаченные подписки хранятся в соответствующем разделе личного кабинета.</p>');

define('MESSAGE_SUBSCRIPTION_WAS_SUCCESS_PAYMENT', 'Подписка успешно активирована!');

define('MESSAGE_ALIAS_FREE', 'Псевдоним свободен!');

define('MESSAGE_MODERATE_ARTICLE', 'Новость/Статья отправлена на модерацию!');

define('MESSAGE_MODERATE_ARTICLE_TEXT', 'Новость/Статья отправлена на модерацию!<br>Как только новость/статья будет проверена администратором, мы известим Вас об этом на Email, указанный при регистрации.');

define('MESSAGE_COMMENTS_COMPLAINT', 'Вы уверены, что хотите отправить жалобу на комментарий пользователя');

define('MESSAGE_COMMENTS_DELETE', 'Вы уверены, что хотите удалить комментарий?');

define('MESSAGE_COMMENTS_REGISTER', 'Комментарии могут добавлять только зарегистрированные пользователи');

define('MESSAGE_COMMENTS_COMPLAINT_SEND', 'Жалоба отправлена! В ближайшее время ваша жалоба будет рассмотрена и обработана.');

define('MESSAGE_COMMENTS_COMPLAINT_NOT_SEND', 'Не удалось отправить жалобу!');

define('MESSAGE_COMMENTS_NOT_DELETE', 'Не удалось удалить комментарий!');

define('MESSAGE_CLICK_NOWAIT', 'Нажмите если не хотите ждать');

define('MESSAGE_REDIRECT_URL_LEAVE', 'Вы покидаете сайт по внешней ссылке, предоставленной одним из участников');

define('MESSAGE_REDIRECT_URL_RECOMMENDATIONS', 'Настоятельно рекомендуем Вам не указывать никаких личных данных на сторонних сайтах (E-Mail, пароль и т.п.)');

define('MESSAGE_REDIRECT_URL_NOTRESPONSIBLE', 'Администрация не несет ответственности за содержимое сторонних сайтов');

define('MESSAGE_REDIRECT_URL_AUTOREDIRECT_AFTER', 'Автоматический переход через');
