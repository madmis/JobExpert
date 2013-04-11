<?php
/********************************************************
	JobExpert v1.0
	powered by Script Developers Group (SD-Group)
	email: info@sd-group.org.ua
	url: http://sd-group.org.ua/
	Copyright 2010-2015 (c) SD-Group
	All rights reserved
=========================================================
 	Класс работы с пользователями
********************************************************/
/**
* @package
* @todo
*/

(!defined('SDG')) ? die ('Triple protection!') : null;

class user extends users
{
	/////////////////////////////////////////////////
	// VARS - свойства класса user
	/////////////////////////////////////////////////
	/**
	* Массив для хранения наименований и значений полей для записи в таблицу БД
	* В этом массиве хранятся поля обязательные для заполнения
	* 
	* @var array
	*/
	public $arrBindFields = array(
										'id'			=> '',
										'email'			=> '',
										'password'		=> '',
										'alias'			=> '',
										'first_name'	=> '',
										'last_name'		=> '',
										'middle_name'	=> '',
										'phone'			=> ''
    						   );

	/////////////////////////////////////////////////
	// CONSTRUCTOR - конструктор класса user
	/////////////////////////////////////////////////

	/**
	* конструктор
	* префикс таблицы и постфикс таблицы
	* 
	* @return void
	*/
	public function __construct()
	{
		parent::__construct();

		$this -> checkUserInSession();
	}

	/////////////////////////////////////////////////
	// METHODS - методы класса user
	/////////////////////////////////////////////////

	/**
	* функция смены рабочей таблицы
	* 
	* @param $postfix - название таблицы
	* @param $prefix - префикс таблицы
	* 
	* @return void
	*/
	public function changeTable($postfix, $prefix = false)
	{
		return parent::changeTable($postfix, $prefix);
	}

	/**
	* Функция проверки пользователя в сессии
	* 
	* @return bool
	*/
	public function checkUserInSession()
	{
		return $this -> initAuthorized();
	}

	/********** перегрузка методов родительских классов **********/

	/**
	* функция получения признака авторизации
	* 
	* @return bool
	*/
	public function getAuthorized()
	{
		return parent::getAuthorized();
	}

	/**
	* Функция проверяет наличие пользователя в БД
	* 
	* @param (string) $strWhere - строка, условие для запроса
	* 
	* @return bool
	*/
	public function issetUser($strWhere)
	{
		return parent::issetUser($strWhere);
	}

	/**
	* protected Функция получает данные по коду активации
	* 
	* @param (string) $code - код активации
	* 
	* @return bool
	*/
	public function getUserByCode($code)
	{
		return parent::getUserByCode($code);
	}

	/**
	* Функция авторизации пользователя
	* 
	* @param (string) $email - email для авторизации
	* @param (string) $password - пароль для авторизации
	* @param (bool) $remember - признак записи данных пользователя в куки
	* @param (bool) $cookie - признак авторизации из кукисов
	* 
	* @return bool
	*/
	public function authorizeUser($email, $password, $remember, $cookie = false)
	{
		return parent::authorizeUser($email, $password, $remember, $cookie);
	}

	/**
	* Функция подсчитывает пользователей в БД
	* 
	* @param (string) $strWhere - выражение для оператора WHERE, если false, то подсчет строк берется из SELECT FOUND_ROWS
	* 
	* @return int or false
	*/
	public function cntUsers($strWhere = false)
	{
		return parent::cntUsers($strWhere);
	}

	/**
	* функция получения данных пользователя
	* 
	* @param (string) $strWhere - строка, условие для запроса
	* 
	* @return (array or false)
	*/
	public function getUser($strWhere)
	{
		return parent::getUser($strWhere);
	}

	/**
	* функция получает данные пользователя из двух таблиц (main_users и job_conf_users)
	* 
	* @param (int) $id - ID-пользователя
	* @param (array) $arrFields - массив полей, которые нужно получить. Массив должен быть следующего вида: array(array('алиас_таблицы', 'поле1'), array('алиас_таблицы', 'поле2')). ПРИМЕР: array(array('users', 'id'), array('users', 'email')) or false
	* 
	* @return array or false
	*/
	public function getCombinedUserData($id, $arrFields = false)
	{
		return parent::getCombinedUserData($id, $arrFields);
	}

	/**
	* функция получает данные всех пользователей из двух таблиц (main_users и job_conf_users)
	* 
	* @param (array) $arrFields - массив полей, которые нужно получить. Массив должен быть следующего вида: array(array('алиас_таблицы', 'поле1'), array('алиас_таблицы', 'поле2')). ПРИМЕР: array(array('users', 'id'), array('users', 'email')) or false
	* @param (string) $strWhere - строка, условие для запроса or false. Поля условия должны обязательно содержать алиас таблицы, к которой они относятся (users или conf_users). ПРИМЕР: 'conf_users.token='active'.
	* @param (array) $arrOrderBy - массив параметров сортировки результата выборки (key: name field => val: ASC | DESC) or false
	* @param (string) $strLimit - example: '0, 10' or false
	* 
	* @return array or false
	*/
	public function getCombinedUsersData($arrFields, $strWhere, $arrOrderBy, $strLimit)
	{
		return parent::getCombinedUsersData($arrFields, $strWhere, $arrOrderBy, $strLimit);
	}

	/**
	* функция производит запись данных в таблицу БД
	* Рассылает почтовые сообщения
	* 
	* @return bool
	*/
	public function recUser()
	{
		return parent::recUser($this -> arrBindFields);
	}

	/**
	* функция добавления пользователя администратором
	* 
	* @param array $arrData - массив данных пользователя для записи в основную таблицу пользователей
	* @param array $arrConfData - массив данных пользователя для записи в таблицу настроек пользователей
	* @param bool $mail - признак уведомления пользователя (TRUE | FALSE)
	* 
	* @return bool
	*/
	public function addAdminUser($arrData, $arrConf, $mail)
	{
		return parent::addAdminUser($arrData, $arrConf, $mail);
	}

	/**
	* Функция обновления данных пользователя
	* 
	* @param (array) $arrData - массив данных для обновления (key: name field => val: value field)
	* @param (string) $strWhere - строка, условие для запроса
	* 
	* @return bool
	*/
	public function updateUser($arrData, $strWhere = false)
	{
		return parent::updateUser($arrData, $strWhere);
	}

	/**
	* функция обновления данных пользователя в таблице conf_users
	* 
	* @param (array) $arrData - массив данных для обновления (key: name field => val: value field)
	* @param (array) $strWhere - строка, условие для запроса
	* 
	* @return bool
	*/
	public function updateConfUser($arrData, $strWhere = false)
	{
		return parent::updateConfUser($arrData, $strWhere);
	}

	/**
	* функция обновления данных пользователя
	* функция может использоваться лишь в том случае, если пользователь вошел на сайт (его данные есть в сессии)
	* 
	* @param (array) $arrData - массив данных пользователя для записи в основную таблицу пользователей or false
	* @param (array) $arrConfData - массив данных пользователя для записи в таблицу настроек пользователей or false
	* 
	* @return bool
	*/
	public function updateUserData($arrData, $arrConfData)
	{
		return parent::updateUserData($arrData, $arrConfData);
	}

	/**
	* функция производит активацию аккаунта пользователя
	* Отсылает админу сообщение о регистрации нового пользователя
	* 
	* @return bool
	*/
	public function activateUser()
	{
		return parent::activateUser();
	}
	
	/**
	* функция производит активацию пользователей
	* Если передан соответствующий параметр, отсылает пользователям сообщения об активации
	* 
	* @param array $arrUsers - Массив с данными пользователей, которых необходимо активировать (формат: array(id => email, ....))
	* @param bool $mail - признак уведомления пользователей об активации (TRUE | FALSE)
	* 
	* @return bool
	*/
	public function activateUsersAdmin($arrUsers, $mail)
	{
		return parent::activateUsersAdmin($arrUsers, $mail);
	}

	/**
	* функция производит активацию пользователей
	* 
	* @param array $arrUsers - Массив с данными пользователей, которых необходимо активировать (формат: array(id => email, ....))
	* 
	* @return bool
	*/
	public function activateConfUsersAdmin($arrUsers)
	{
		return parent::activateConfUsersAdmin($arrUsers);
	}

	/**
	* функция производит активацию пользователей, которые состояли на модерации
	* 
	* @param array $arrUsers - Массив с данными пользователей, которых необходимо активировать (формат: array(id => email, ....))
	* 
	* @return bool
	*/
	public function moderateUsersAdmin($arrUsers)
	{
		return parent::moderateUsersAdmin($arrUsers);
	}

	/**
	* функция производит обновление данных пользователя,
	* в соответствии с выбранным типом учетной записи
	* 
	* @param (array) $arrData - массив содержащий данные пользователя для обновления array('first_name', 'last_name', 'phone', 'user_type')
	* @param (array) $arrPayments - массив платных услуг (определенных администратором)
	* 
	* @return string (состояние moderate или active) or false
	*/
	public function selectUserType($arrData, &$arrPayments)
	{
		return parent::selectUserType($arrData, $arrPayments);
	}

	/**
	* функция возвращает хеш данных пользователя, хранящийся в кукисах
	* 
	* @param (array) $arrData - масив данных пользователя
	* 
	* @return string
	*/
	public function cookieUserHash($arrData)
	{
		return parent::cookieUserHash($arrData);
	}

	/**
	* функция очищает куки и сессию текущего пользователя
	* 
	* @return void
	*/
	public function clearUserSessionAndCookie()
	{
		parent::clearUserSessionAndCookie();
	}

	/**
	* public функция загружает логотип
	* 
	* @param (string) $field_name - им поля из формы загрузки файла
	* @param (string) $upload_dir - дарректория, в которую загружать файл
	* 
	* @return string (имя картинки) or false (если ф-я вернула false, можно получить ошибки методом getError())
	*/
	public function loadLogo($field_name, $upload_dir)
	{
		return parent::loadLogo($field_name, $upload_dir);
	}

	/**
	* Функция установки ошибок
	* 
	* @return array
	*/
	public function getError()
	{
		return parent::getError();
	}

	/**
	* Функция генерации ссылки для подтверждения смены пароля пользователя
	* 
	* $arrData - массив данных пользователя
	* 
	* @return string
	*/
	public function genLinkToChangePassword($arrData)
	{
		return parent::genLinkToChangePassword($arrData);
	}

	/**
	* Функция проверяет правильность ссылки для подтверждения смены пароля пользователя
	* 
	* @return array (массив данных пользователя) or false
	*/
	public function checkLinkToChangePassword()
	{
		return parent::checkLinkToChangePassword();
	}

	/**
	* protected Функция удаления пользователей по выражению WHERE
	* Ф-я удаляет данные пользователей из таблиц: user, conf_users
	* 
	* @param (array) $strWhere - строка для выражения WHERE
	* 
	* @return bool
	*/
	public function delUsers($strWhere)
	{
		return parent::delUsers($strWhere);
	}

	/**
	* Функция удаления пользователей
	* Ф-я удаляет данные пользователей из таблиц: user, conf_users
	* а также удаляет все объявления и подписки пользователей
	* 
	* @param (array) $arrId - массив, содержащий ID пользователей, которых нужно удалить
	* @param (bool) $vacancy, $resume, $subscription, $articles, $news - параметры, определяющие удаление соответствующих данных пользователя (TRUE || FALSE)
	* 
	* @return bool
	*/
	public function deleteUsers($arrId, $vacancy, $resume, $subscription, $articles, $news)
	{
		return parent::deleteUsers($arrId, $vacancy, $resume, $subscription, $articles, $news);
	}

	/**
	* функция рассылки сообщений пользователям, в соответствии с действием
	* 
	* @param array $arrUsers - массив пользователей, которым необходимо отправить сообщения. Формат: array(key => email, ...)
	* @param string $action - действие, в соответствии с которым необходимо произвести рассылку сообщений. На данный момент есть три действия: activate - активация пользователя, состоящего на активации; delete - удаление пользователя, состоящего на модерации; moderate - активация пользователя, состоящего на модерации.
	* 
	* @return void
	*/
	public function actionSendUsersEmails($arrUsers, $action)
	{
		return parent::actionSendUsersEmails($arrUsers, $action);
	}

	/**
	* функция подсчета активных пользователей в таблице conf_users
	* 
	* @return (int)
	*/
	public function cntActiveUsers()
	{
		return parent::cntActiveUsers();
	}

	/**
	* AJAX Функция удаления логотипа пользователей
	* 
	* @param (int) $Id - Id пользователя
	* 
	* @return string
	*/
	public function ajaxDeleteUserLogo($Id)
	{
		return parent::ajaxDeleteUserLogo($Id);
	}

	/**
	* Функция выборки логотипов для вывода на главной
	* 
	* @return mixed (array | false)
	*/
	public function getLogoToMain()
	{
		return parent::getLogoToMain();
	}

	/**
	* Функция выборки логотипов агентств для вывода на главной
	* @return mixed (array | false)
	*/
	public function getAgnLogoToMain() {
		return parent::getAgnLogoToMain();
	}

	/********** END перегрузка методов родительских классов **********/

	/////////////////////////////////////////////////
	// END OF CLASS user
	/////////////////////////////////////////////////
}
