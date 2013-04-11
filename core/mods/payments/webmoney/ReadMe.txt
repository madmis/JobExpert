
Result URL - http://jobexpert/index.php?ut=competitor&do=payments&mod=webmoney&result

Success URL - http://jobexpert/index.php?ut=competitor&do=payments&mod=webmoney&success

Fail URL - http://jobexpert/index.php?ut=competitor&do=payments&mod=webmoney&fail




В моде Webmoney проверка параметров, возвращаемых сервером WEbmoney производится 2 раза.


Первый раз проверяются параметры предварительного запроса LMI_PREREQUEST. 

Если параметры правильные:
	В лог-файл пишется результат с заголовком LMI_PREREQUEST SUCCESS
	Серверу Webmoney возвращается ответ YES
	Webmoney, в этом случае, выполняют платеж и присылают оповещение о платеже, которое обрабатывается снова.

Если параметры неправильные:
	В лог-файл пишется результат с заголовком LMI_PREREQUEST FAIL
	Серверу Webmoney возвращается ответ NO
	Webmoney, в этом случае, выдают пользователю сообщение об ошибке и пользователь возвращается на страницу с сообщением об ошибке платежа на сайте.


Второй раз проверяются параметры оповещение о платеже. 

Если параметры правильные:
	В лог-файл пишется результат с заголовком SUCCESS
	Администратору отсылается сообщение с параметрами платежа
	В БД пишется результат с заголовком SUCCESS
	Пердоставляется выбранная услуга

Если параметры неправильные:
	В лог-файл пишется результат с заголовком FAIL
	В БД пишется результат с заголовком FAIL
	Администратору отсылается сообщение с параметрами платежа

WRONG PARAMS пишется в лог лишь в том случае, если на Result URL пришел не пустой $_POST, но это был не предварительный запрос или оповещение о платеже содержало неверные данные.



Настройки Merchant

Кошелек: Z365999944915
Торговое имя: SD-Group USD
Secret Key: orkfkasd23kd34mdsd533j0ds023wqd
Высылать Secret Key на Result URL, если Result URL обеспечивает секретность: Выкл.
Result URL: http://test.sd-group.org.ua/index.php?ut=competitor&do=payments&mod=webmoney&result
Передавать параметры в предварительном запросе: Вкл.
Success URL: http://test.sd-group.org.ua/index.php?ut=competitor&do=payments&mod=webmoney&success
метод вызова Success URL: POST
Fail URL: http://test.sd-group.org.ua/index.php?ut=competitor&do=payments&mod=webmoney&fail
метод вызова Fail URL: POST
Позволять использовать URL, передаваемые в форме: Выкл.
Высылать оповещение об ошибке платежа на кипер: Вкл.
Метод формирования контрольной подписи: MD5
Тестовый/Рабочий режимы: тестовый
Прием чеков Paymer.com (ВМ-карт) или WM-нот: Выкл.
Прием платежей с телефонов Telepat.ru: Выкл.