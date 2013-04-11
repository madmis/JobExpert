<?php
/********************************************************
	powered by Script Developers Group (SD-Group)
	email: info@sd-group.org.ua
	url: http://sd-group.org.ua/
	Copyright 2009 (c) SD-Group
	All rights reserved
=========================================================
 	Базовый класс для отправки писем с сайта
********************************************************/

(!defined('SDG')) ? die ('Triple protection!') : null;

/**
* Базовый класс для отправки писем с сайта
* 
*/
abstract class bmailer extends phpmailer
{
	/////////////////////////////////////////////////
	// VARS - свойства класса bmailer
	/////////////////////////////////////////////////

	/**
	* свойство для хранения массива шаблонов замены
	* 
	* @var array
	*/
	private $arrReplace = array(
									'%SITE_URL%' => CONF_SITE_URL,
									'%SCRIPT_URL%' => CONF_SCRIPT_URL,
									'%ADMIN_EMAIL%' => CONF_MAIL_ADMIN_EMAIL,
									'%SITE_NAME%' => CONF_SITE_NAME
							   );

	/////////////////////////////////////////////////
	// CONSTRUCTOR - конструктор класса bmailer
	/////////////////////////////////////////////////

	/**
	* конструктор
	* 
	* инициирует необходимые параметры в свойствах родительского класса
	* 
	* @return void
	*/
	public function __construct()
	{
		parent::__construct();

		$this -> CharSet = CONF_DEFAULT_CHARSET;
		$this -> Host = CONF_MAIL_SMTP_HOST;
		$this -> Port = CONF_MAIL_SMTP_PORT;
		$this -> Username = CONF_MAIL_SMTP_USER;
		$this -> Password = CONF_MAIL_SMTP_PASS;
		
		$this->SMTPAuth = true;
		
		('smtp' === CONF_MAIL_METHOD) ?	$this -> IsSMTP() : $this -> IsMail();
		(CONF_MAIL_FORMAT_HTML) ? $this -> IsHTML(true) : $this -> IsHTML(false);
	}

	/////////////////////////////////////////////////
	// METHODS - методы класса bmailer
	/////////////////////////////////////////////////

	/**
	* Функция предотправки писем
	* 
	* $from - адрес, с которого отправлено письмо
	* $from_name - имя отправителя
	* $sender - адрес, для ответа на письмо
	* $message - сообщение
	* $to_address - адрес получателя
	* $to_name - имя получателя
	* $file_pattern - имя файла шаблона
	* 
	* @return bool
	*/
	public function sendEmail()
	{
		$arrSendMail = mailer::retSendMail();

		if (!$arrSendMail['From'] || !$arrSendMail['Subject'] || !$arrSendMail['FilePattern'])
		{
			$this -> ErrorInfo = 'Wrong mail parameters. Not FROM or not SUBJECT or not MESSAGE!';
			$this -> mailErrorLog();

			return false;
		}

		!empty($arrSendMail['Text']) ? $this -> Body = $arrSendMail['FilePattern'] : $this -> confMessage($arrSendMail['FilePattern']);

		$idna = new idna_convert();
		
		$this -> From = $idna -> encode($arrSendMail['From']);
		$this -> Subject = $arrSendMail['Subject'];
		$this -> FromName = (!$arrSendMail['FromName']) ? $arrSendMail['From'] : $arrSendMail['FromName'];
		$this -> Sender = (!$arrSendMail['Sender']) ? $this -> From : $idna -> encode($arrSendMail['Sender']);

		(!$arrSendMail['ToName']) ? $this -> AddAddress($idna -> encode($arrSendMail['ToAddress']), $arrSendMail['ToAddress']) : $this -> AddAddress($idna -> encode($arrSendMail['ToAddress']), $arrSendMail['ToName']);

		 // если включен формат HTML, заменяем перенос строки и вставляем дизайн в письмо
		(CONF_MAIL_FORMAT_HTML) ? $this -> MsgHTML($this -> Body) : $this -> MsgTXT($this -> Body);

		if (!$this -> Send())
		{
			$this -> mailErrorLog();

			return false;
		}
		else
		{
			return true;
		}
	}

	/**
	* Функция получения шаблона письма и его конфигурирования в неоходимый формат, для последующей отправки
	* 
	* @param string $file_pattern - имя файла шаблона
	* 
	* @return void
	*/
	private function confMessage($file_pattern)
	{
		// получаем текст шаблона
		$message = @file_get_contents('lang/' . CONF_LANGUAGE . '/mails/' . $file_pattern);

		// получаем текущую даты, в необходимом формате, для вставки в письмо
		$date = date(terms::dateFormatFromSmarty(CONF_DATE_FORMAT, CONF_TIME_FORMAT), strtotime(terms::currentDateTime()));

		$this -> arrReplace += array('%DATE%' => $date);

		(!$arrAddReplace = mailer::retAddReplace()) ? null : $this -> arrReplace += $arrAddReplace;

		// формируем сообщение пользователю
		$message = strtr($message, $this -> arrReplace);

		// если включен формат HTML, заменяем перенос строки и вставляем дизайн в письмо
		if (CONF_MAIL_FORMAT_HTML)
		{
			$html = @file_get_contents('lang/' . CONF_LANGUAGE . '/mails/html.txt');
			$message = str_replace('%BODY%', $message, $html);
		}
 
		$this -> Body = $message;
	}


	/**
	* Функция формирования текстового тела сообщения для отправки
	* 
	* @param string $message
	* 
	* @return void
	*/
	private function MsgTXT($message)
	{
		$this -> Body = str_replace(array('</p>', '<br>', '<br/>', '<br />'), array("</p>\n\n", "<br>\n", "<br>\n", "<br>\n"), $this -> Body);
		$arrStrings = explode("\n", $this -> Body);
		$newArrStrings = array();

		foreach ($arrStrings as $value)
		{
			$newArrStrings[] = strip_tags(preg_replace('/<(head|title|style|script)[^>]*>.*?<\/\\1>/s', '', $value));
		}
		$this -> Body = implode("\n", $newArrStrings);

		//$this -> Body = html_entity_decode(trim(strip_tags(preg_replace('/<(head|title|style|script)[^>]*>.*?<\/\\1>/s', '', $message))));
	}

	/**
	* Функция логирования ошибок отправки почты
	* 
	* @return void
	*/
	private function mailErrorLog()
	{
		$mess = "\n" . '=========================' . date('Y-m-d H:i:s')  . '================================' . "\n"
			  . 'Page: http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'] . "\n"
			  . 'IP user: ' . $_SERVER['REMOTE_ADDR'] . "\n"
			  . 'The Error returned was: ' . $this -> ErrorInfo . "\n"
			  . '============================================================================' . "\n\n";

		@error_log($mess, 3, 'core/data/log/mail_error.log');
	}

	/**
	* @param string $address The email address to check
	* @return boolean
	*/
	public static function ValidateAddress($address)
	{
		return validate::validateEmail($address);
	}
	

	/////////////////////////////////////////////////
	// END OF CLASS bmailer
	/////////////////////////////////////////////////
}

