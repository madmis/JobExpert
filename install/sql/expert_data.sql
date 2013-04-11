--
-- Дамп данных таблицы `%DB_PREFIX%groups`
--

INSERT INTO `%DB_PREFIX%groups` (`index`, `id`, `edit_vacancy`, `del_vacancy`, `edit_resume`, `del_resume`, `add_articles`, `edit_articles`, `arc_articles`, `del_articles`, `add_news`, `edit_news`, `arc_news`, `del_news`, `token`) VALUES
(1, 'guest', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'active'),
(2, 'user', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'active'),
(3, 'moderator', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 'active'),
(4, 'agent', 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 'active'),
(5, 'company', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 'active'),
(6, 'employer', 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'active'),
(7, 'competitor', 0, 0, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 'active');;;

--
-- Дамп данных таблицы `%DB_PREFIX%groups_resp`
--

INSERT INTO `%DB_PREFIX%groups_resp` (`index`, `id`, `moder_account`, `act_vacancy`, `act_resume`, `moder_vacancy`, `moder_resume`, `moder_articles`, `moder_news`, `token`) VALUES
(1, 'guest', 0, 0, 0, 0, 0, 0, 0, 'active'),
(2, 'user', 0, 0, 0, 0, 0, 0, 0, 'active'),
(3, 'moderator', 0, 1, 1, 0, 0, 0, 0, 'active'),
(4, 'agent', 1, 1, 1, 0, 0, 0, 0, 'active'),
(5, 'company', 1, 1, 1, 1, 1, 1, 1, 'active'),
(6, 'employer', 0, 1, 1, 1, 0, 1, 0, 'active'),
(7, 'competitor', 0, 1, 1, 0, 1, 0, 1, 'active');;;


--
-- Дамп данных таблицы `%DB_PREFIX%payments_mods`
--

INSERT INTO `%DB_PREFIX%payments_mods` (`id`, `title`, `description`, `token`) VALUES
('smscoin', 'Sms биллинг SmsCoin (http://smscoin.com)', '<p><strong>SmsCoin - sms биллинг.</strong></p>\n<p>Sms биллинг &mdash; способ оплаты, при котором оплата производится посредством отправки на специальный короткий номер смс-сообщения. Стоимость смс-сообщения и является оплатой за выбранную услугу.</p>', 'active'),
('liqpay', 'Оплата через платежную систему LiqPay (ПриватБанк - Visa, MasterCard)', '<p>Модуль позволяет производить оплату банковскими картами Visa и MasterCard, посредством платежной системы ПриватБанка - LiqPay.</p>', 'active'),
('webmoney', 'Оплата посредством платежной системы Webmoney', '<p>Оплата посредством платежной системы Webmoney</p>', 'active'),
('hand', 'Оплата в ручном режиме (через администратора)', '<p>Оплата в ручном режиме (через администратора)</p>', 'active'),
('jur', 'Оплата для юридических лиц', '<p>Оплата для юридических лиц</p>', 'active'),
('a1pay', 'A1Pay агрегатор', '<p>A1Pay позволит Вам работать с платежами через SMS, мобильными платежами через ведущих операторов России и крупнейшими банковскими продуктами от Master Card, Visa, American Express. Вы сможете использовать более 100 тыс. терминалов Qiwi и Элекснет по России и выгодный процент по обработке платежей WebMoney, Яндекс.Деньги и др.</p>', 'active'),
('intellectmoney', 'Универсальная платежно-дисконтная система IntellectMoney', '<p>IntellectMoney&nbsp;&mdash; быстроразвивающаяся высокотехнологичная компания, организатор универсальной платежно-дисконтной системы IntellectMoney. Мы&nbsp;нацелены на&nbsp;успех на&nbsp;рынке электронной коммерции и&nbsp;стремимся к&nbsp;распространению онлайновых платежных услуг среди максимального числа пользователей Интернета.</p>', 'active');;;