<?php
/**
* JobExpert v1.0
* powered by Script Developers Group (SD-Group)
* email: info@sd-group.org.ua
* url: http://sd-group.org.ua/
* Copyright 2010-2015 (c) SD-Group
* All rights reserved
* =========================================================
* Обратная связь
* =========================================================
*/
/**
 * @package
 * @todo
 */

(!defined('SDG')) ? die ('Triple protection!') : null;

$return_data = array(
    'subject' => false,
    'email' => false,
    'message' => false,
);

if (isset($_POST['send'])) {
	///////////////////////////////////////////////////////////////
	// Проверка данных, полученных из формы 
	///////////////////////////////////////////////////////////////
	// проверяем, есть ли незаполненные поля
	if (validate::postDataNotEmpty()) {
		$_POST['subject'] = htmlspecialchars($_POST['subject'], ENT_QUOTES, CONF_DEFAULT_CHARSET);
		(!validate::validateEmail($_POST['email'])) ? $arrErrors[] = ERROR_EMAIL : null;
		(strlen($_POST['subject']) < 5) ? $arrErrors[] = ERROR_SUBJECT_SHORT : null;
		(strlen($_POST['message']) < 10) ? $arrErrors[] = ERROR_MESSAGE_SHORT : null;

		if (SECURE_CAPTCHA) {
			$securimage = new securimage();
			(!$securimage -> check($_POST['keystring'])) ? $arrErrors[] = ERROR_CAPTCHA : null;
		}
	} else {
		$arrErrors[] = ERROR_EMPTY_FIELDS;
	}
	///////////////////////////////////////////////////////////////
	///////////////////////////////////////////////////////////////

	if (!$arrErrors) {
		$mailer = new mailer();

		// массив для замены в шаблоне
		(CONF_MAIL_FORMAT_HTML) ? $message = nl2br($_POST['message']) : $message =& $_POST['message'];
		$mailer -> setAddReplace(array('%FEEDBACK%' =>& $message));
		// проверяем, если есть дополнительный словарь тем, то используем его
		$toAddress = (isset($arrAddDict['FeedbackSubject']) && $address = array_search($_POST['subject'], $arrAddDict['FeedbackSubject']['values'])) ? $address : CONF_MAIL_ADMIN_EMAIL;
		// пытамеся отправить сообщение
		if (!$mailer -> sendEmail($_POST['email'], $_POST['email'], $_POST['email'], $toAddress, $toAddress, $_POST['subject'], 'feedback.txt')) {
			$arrErrors[] = ERROR_SEND_EMAIL;
		} else {
			messages::messageChangeSaved(MESSAGE_WAS_SEND, false, chpu::createChpuUrl(CONF_SCRIPT_URL . 'index.php?ut=' . $_SESSION['sd_user'][DB_PREFIX . 'conf']['user_type'] . '&amp;do=feedback'));
		}
	}

    $return_data['subject'] = !empty($_POST['subject']) ? $_POST['subject'] : '';
    $return_data['email'] = !empty($_POST['email']) ? $_POST['email'] : '';
    $return_data['message'] = !empty($_POST['message']) ? $_POST['message'] : '';
}

// проверяем, если есть дополнительный словарь тем, то бере темы из него
$feedBackSubject = (isset($arrAddDict['FeedbackSubject'])) ? $arrAddDict['FeedbackSubject']['values'] : $arrSysDict['FeedbackSubject']['values'];

$smarty -> assign('sid', md5(time()));
$smarty -> assignByRef('return_data', $return_data);
$smarty -> assignByRef('subject', $feedBackSubject);
$smarty -> assignByRef('errors', $arrErrors);
