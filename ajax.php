<?php

/**
 * Powered by Script Developers Group (SD-Group)
 * Email: info@sd-group.org.ua
 * URL: http://sd-group.org.ua/
 * Copyright 2009 (c) SD-Group
 * All rights reserved
 * ===================================================
 * Файл работы с запросами AJAX/JSON
 * ===================================================
 */
session_start();

error_reporting(E_ALL);

/**
 * Защита от взлома
 */
define('SDG', true);

/**
 * Подключаем ядро
 */
require_once 'core/init.php';

/**
 * Защита от доступа из вне скрипта
 */
(!secure::checkServerCalls()) ? die('Triple protection!') : null;

/**
 * Передаем в Smarty системные словари (для доступа из всех шаблонов)
 */
$smarty->assignByRef('arrSysDict', $arrSysDict);

/**
 * Передаем в Smarty дополнительные словари (для доступа из всех шаблонов)
 */
$smarty->assignByRef('arrAddDict', $arrAddDict);

if (isset($_GET['id_s']) && validate::checkNaturalNumber($_GET['id_s']) && ($result = ajax::getProfessions($_GET['id_s']))) {
	echo $result;
} elseif (isset($_GET['id_r']) && validate::checkNaturalNumber($_GET['id_r'])) {
	$response = array(
		'success' => false,
		'error' => ERROR_UNABLE_PERFORM_OPERATION
	);

	$regions = new regions();
	$region = $regions->retCategorysByIds($_GET['id_r']);

	if (!empty($region[$_GET['id_r']]) && is_array($region[$_GET['id_r']])) {
		if ('on' !== $region[$_GET['id_r']]['major']) {
			$result = ajax::getCitys($_GET['id_r']);
			if (!empty($result)) {
				if (!empty($region[$_GET['id_r']]['add_city_allowed'])) {
					$result[0] = array(
						'id' => '0',
						'name' => FORM_INPUT_OTHER
					);
				}

				$response = array(
					'success' => true,
					'data' => &$result
				);
			} else {
				$response = array(
					'success' => false,
					'data' => false
				);
			}
		} else {
			$response = array(
				'success' => true,
				'data' => false
			);
		}
	}

	echo ajax::sdgJSONencode($response);
} elseif (!empty($_GET['q']) && defined(strtoupper($_GET['q']))) {
	echo constant($_GET['q']);
}
// Голосования за статьи
elseif (isset($_GET['score']) && is_numeric($_GET['score']) && $_GET['score'] <= 5 && $_GET['score'] >= 1 && isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id']) {
	$articles = new articles();
	$articles->rateArticle($_GET['score'], $_GET['id']);
} elseif (isset($_POST['dl']) && (int) $_POST['dl'] && 0 < $_POST['dl']) {
	$user = new user();
	$result = $user->ajaxDeleteUserLogo($_POST['dl']);

	echo ('ok' === $result) ? $result : (('noisset' === $result) ? ERROR_USER_NOT_EXISTS : ERROR_DELETE_LOGO);
}
//Отправка почтовых сообщений
elseif (isset($_GET['sendto'])) {
	if (!isset($_POST['sendto']) || (!$sendto = secure::strSecureDecode($_POST['sendto'])) || !validate::validateEmail($sendto)) {
		echo 'errSendto';
	} elseif (!isset($_POST['email']) || !validate::validateEmail($_POST['email'])) {
		echo 'errEmail';
	} elseif (!isset($_GET['respAnn']) && SECURE_CAPTCHA && (!isset($_POST['keystring']) || (!$securimage = new securimage()) || !$securimage->check($_POST['keystring']))) {
		echo 'errKeystring';
	} else {
		$mailer = new mailer();

		if (!empty($_POST['message'])) {
			$mailer->setAddReplace(array('%FEEDBACK%' => $_POST['message']));
			$mailTemplate = 'feedback.txt';
			$mailText = false;
		} elseif (!empty($_POST['text'])) {
			$mailTemplate = & $_POST['text'];
			$mailText = true;
		} else {
			echo 'errEmptyMessage';
		}

		if (!empty($_POST['attachment']) && is_array($_POST['attachment'])) {
			foreach ($_POST['attachment'] as &$attachment) {
				$nameAttachment = implode('.', array_slice(explode('.', $attachment), 1));
				$attachment = 'uploads/temporary/' . $attachment;
				$mailer->AddAttachment($attachment, $nameAttachment);
			}
		}

		if (!$mailer->sendEmail($_POST['email'], false, false, $sendto, false, $_POST['subject'], $mailTemplate, $mailText)) {
			echo 'errSend';
		} else {
			(!empty($_POST['attachment'])) ? filesys::removeFiles($_POST['attachment']) : null;
			echo 'success';
		}
	}
}
//Загрузка файлов на сервер
elseif (isset($_GET['uploadFile'])) {
	// обработка запроса о процессе загрузки файла (Если php поддерживает функцию uploadFileProgress)
	if (isset($_GET['action']) && 'uploadFileProgress' === $_GET['action'] && !empty($_POST['file']) && !empty($_POST['key'])) {
		echo (!function_exists('uploadprogress_get_info') || !$result = uploadprogress_get_info($_POST['key'])) ? ajax::sdgJSONencode(array('result' => 0, 'size' => (file_exists($_POST['file'])) ? filesize($_POST['file']) : 0)) : ajax::sdgJSONencode($result + array('result' => 1));
	}
	// удаление загруженного файла
	elseif (isset($_GET['action']) && 'delUploaded' === $_GET['action'] && !empty($_POST['delUploadedFile'])) {
		foreach (array_unique(explode(',', $_POST['delUploadedFile'])) as $file) {
			@unlink('uploads/temporary/' . $file);
		}

		echo 'success';
	}
	// загрузка и сохранение файла
	elseif (isset($_POST['inputName']) && is_string($_POST['inputName']) && ($inputName = & $_POST['inputName']) && !empty($_FILES[$inputName])) {
		// проверяем ошибки
		switch ($_FILES[$inputName]['error']) {
			// системная ошибка: Превышен максимально разрешенный размер файла
			case 1:
			case 2:
				$_FILES[$inputName]['error'] = 'errFileMaxSize';
				break;
			// системная ошибка: Не удалось загрузить файл
			case 3:
			case 4:
				$_FILES[$inputName]['error'] = 'errFileUploading';
				break;
			// пользовательские ошибки
			default:
				// проверяем строку с имя файла
				if (empty($_FILES[$inputName]['name']) || !preg_match("/[a-zA-Z0-9_\.\-]/", $_FILES[$inputName]['name'])) {
					$_FILES[$inputName]['error'] = 'errFileName';
				}
				// проверяем тип загружаемого файла
				elseif (empty($_FILES[$inputName]['type']) || (!empty($_POST['acceptMimeTypes']) && is_array($_POST['acceptMimeTypes']) && !in_array($_FILES[$inputName]['type'], $_POST['acceptMimeTypes']))) {
					$_FILES[$inputName]['error'] = 'errFileType';
				}
		}

		// присваиваем файлу уникальное имя
		$fileName = 'uploads/temporary/' . $_POST['UPLOAD_IDENTIFIER'] . '.' . $_FILES[$inputName]['name'];
		// если: нет ошибок загрузки файла, перемещаем его в директорию назначения
		if (empty($_FILES[$inputName]['error'])) {
			// проверяем существует ли файл с таким именем в папке загрузки
			if (!file_exists($fileName)) {
				// перемещаем загруженный файл из временной папки в папку загрузки
				if (@move_uploaded_file($_FILES[$inputName]['tmp_name'], $fileName)) {
					// уничтожаем лишние данные (мусор)
					unset($_FILES[$inputName]['tmp_name'], $_FILES[$inputName]['type'], $_FILES[$inputName]['error']);
					// обработка загружаемых файлов (опционально по типам)
					if (!empty($_GET['fType']) && 'rPhotocard' === $_GET['fType'] && (!img::setParam($_POST['UPLOAD_IDENTIFIER'] . '.' . $_FILES[$inputName]['name'], 'uploads/temporary/') || !img::resizeImg(CONF_RESUME_ADD_PHOTO_MAXWIDTH, CONF_RESUME_ADD_PHOTO_MAXHEIGHT, $fileName))) {
						$_FILES[$inputName]['error'] = 'errFileType';
						@unlink($fileName);
					}
				} else {
					$_FILES[$inputName]['error'] = 'errFileUploaded';
					// уничтожаем лишние данные (мусор)
					unset($_FILES[$inputName]['tmp_name']);
					// уничтожаем временный файл
					@unlink($_FILES[$inputName]['tmp_name']);
				}
			} else {
				// уничтожаем лишние данные (мусор)
				unset($_FILES[$inputName]['tmp_name'], $_FILES[$inputName]['type'], $_FILES[$inputName]['error']);
			}
		} else { // иначе: есть ошибки
			// уничтожаем лишние данные (мусор)
			unset($_FILES[$inputName]['tmp_name']);
			// уничтожаем временный файл
			@unlink($_FILES[$inputName]['tmp_name']);
		}
		// печатаем данные о загруженном файле в формате JSON
		echo ajax::sdgJSONencode($_FILES[$inputName]);
	} else {
		echo 'ErrInputFile';
	}
}
// устанавливаем свойство "Вид размещения"
elseif (isset($_GET['editVisibility']) && !empty($_POST['visibility']) && ('visible' === $_POST['visibility'] || 'visiblehc' === $_POST['visibility'] || 'members' === $_POST['visibility'] || 'membershc' === $_POST['visibility'] || 'hide' === $_POST['visibility']) && (int) $_POST['id'] && 0 < $_POST['id']) {
	$resume = new resume();
	echo (!$resume->setVisibility($_POST['visibility'], $_POST['id'])) ? 'errSet' : 'success';
}
// проверяем Alias пользователя
elseif (!empty($_POST['checkAlias']) && !empty($_POST['uID'])) {
	$user = new user();
	echo ($user->issetUser("id NOT IN (" . secure::escQuoteData($_POST['uID']) . ") AND alias IN (" . secure::escQuoteData($_POST['checkAlias']) . ") AND token IN ('active','archived','moderate','new')")) ? 'true' : 'false';
}
// Получаем детали выбранной статьи
elseif (!empty($_POST['getArticleDetail'])) {
	$articles = new articles();
	$arrArticle = $articles->getArticle("id IN (" . secure::escQuoteData($_POST['getArticleDetail']) . ")");
	$smarty->assignByRef('arrArticle', $arrArticle);
	$smarty->display('user.articles.detail.tpl');
}
// Получаем детали выбранной новости
elseif (!empty($_POST['getNewsDetail'])) {
	$news = new news();
	$arrNews = $news->getNews("id=" . secure::escQuoteData($_POST['getNewsDetail']));
	$smarty->assignByRef('arrNews', $arrNews);
	$smarty->display('user.news.detail.tpl');
} elseif (!empty($_GET['getAnnounceData']) && ('vacancy' === $_GET['getAnnounceData'] || 'resume' === $_GET['getAnnounceData']) && !empty($_POST['unikey'])) {
	$objAnnounce = new $_GET['getAnnounceData']();
	if (empty($_SESSION['sd_user']['data']['id'])) {
		die('{"result":"error", "error":"' . ERROR_DATA . '"}'); // ошибка: объявление не существует
	}
	// пытаемся получить данные из таблицы БД
	elseif (!$objAnnounce->getAnnounceByUnikey($_POST['unikey'], "id_user IN (" . secure::escQuoteData($_SESSION['sd_user']['data']['id']) . ") AND token IN ('active')")) {
		die('{"result":"error", "error":"' . ERROR_ANNOUNCE_NOT_EXISTS . '"}'); // ошибка: объявление не существует
	} else {
		$chpu = new chpu();
		$smarty->assignByRef('chpu', $chpu);

		$return_data = $objAnnounce->retAnnSubj();

		$sections = new sections();
		$arrDataSections = $sections->retCategorys();
		$smarty->assignByRef('sections', $arrDataSections);

		$professions = new professions();
		$arrDataProfession = $professions->retCategorysByIds($return_data['id_profession']);
		$smarty->assignByRef('professions', $arrDataProfession);

		$regions = new regions();
		$arrDataRegions = $regions->retCategorys();
		$smarty->assignByRef('regions', $arrDataRegions);

		$citys = new citys();
		$arrDataCity = $citys->retCategorysByIds($return_data['id_city']);
		$smarty->assignByRef('citys', $arrDataCity);

		$smarty->assignByRef('return_data', $return_data);

		echo $smarty->fetch($_GET['getAnnounceData'] . '.responce.tpl');
	}
}
// Добавление комментария к новости
elseif (isset($_POST['addComment']) && isset($_POST['newsId'])) {
	if (!empty($_POST['addComment']) && !empty($_POST['newsId'])) {
		$news = new news();
		$newsComments = new newsComments();
		$_POST['addComment'] = strings::htmlEncode($_POST['addComment']);

		// проверяем наличие новости
		if (!$news->issetNews("id=" . secure::escQuoteData($_POST['newsId']))) {
			echo ajax::sdgJSONencode(array('error' => ERROR_COMMENT_NEWS_NOT_FOUND));
		} else {
			$securimage = new securimage();
			// если добавление комментариев доступно только для зарегистрированных пользователей
			// и пользователь не авторизован, выдаем ошибку
			if (CONF_NEWSES_COMMENTS_REGISTER && empty($_SESSION['sd_user']['data']['id'])) {
				echo ajax::sdgJSONencode(array('error' => MESSAGE_COMMENTS_REGISTER));
			} else {
				// проверяем капчу, если она включена
				if (SECURE_CAPTCHA) {
					if (empty($_POST['keystring']) || !$securimage->check($_POST['keystring'])) {
						die(ajax::sdgJSONencode(array('error' => ERROR_CAPTCHA)));
					}
				}

				// массив сервисных полей
				$sFields = array(
					'id_news' => $_POST['newsId'],
					'id_user' => ((!empty($_SESSION['sd_user']['data']['id'])) ? $_SESSION['sd_user']['data']['id'] : 0),
				);

				!empty($_POST['userName']) ? $_POST['userName'] = htmlspecialchars(htmlentities(trim($_POST['userName']), ENT_QUOTES, CONF_DEFAULT_CHARSET), ENT_QUOTES, CONF_DEFAULT_CHARSET) : null;
				$user = new user(); // пользователь
				// если пользователь авторизован и если не заполнен псевдоним польз.,
				// выдаем ошибку
				if (!empty($_SESSION['sd_user']['data']['id']) && empty($_SESSION['sd_user']['data']['alias'])) {
					echo ajax::sdgJSONencode(array('error' => ERROR_USER_ALIAS_IS_EMPTY));
				}
				// если не удалось заполнить сервисные поля, выдаем ошибку
				elseif (!$newsComments->setServiceFields($sFields)) {
					echo ajax::sdgJSONencode(array('error' => ERROR_COMMENT_UNABLE_FILL_SERVICE_FIELDS));
				} elseif (!empty($_POST['userName']) && $user->issetUser("token IN ('active') AND alias=" . strtolower(secure::escQuoteData($_POST['userName'])))) {
					echo ajax::sdgJSONencode(array('error' => ERROR_USER_ALIAS_EXISTS));
				} else {
					$newsComments->arrBindFields['text'] = $_POST['addComment'];
					$newsComments->arrNoBindFields['name'] = (!empty($_SESSION['sd_user']['data']['alias'])) ? $_SESSION['sd_user']['data']['alias'] : (!empty($_POST['userName']) ? secure::escQuoteData($_POST['userName']) : CONF_NEWSES_COMMENTS_NAME_UNREGISTER);
					$newsComments->arrNoBindFields['ip'] = $_SERVER['REMOTE_ADDR'];

					if ($newsComments->recRecord()) {
						echo ajax::sdgJSONencode(array('success' => true));
					} else {
						echo ajax::sdgJSONencode(array('error' => ERROR_COMMENT_UNABLE_ADD_COMMENT));
					}
				}
			}
		}
	} else {
		echo ajax::sdgJSONencode(array('error' => ERROR_COMMENT_TEXT_EMPTY));
	}
}
// получение количества комментариев к новости
elseif (!empty($_POST['getCountComments'])) {
	$news = new news();
	$newsComments = new newsComments();

	// проверяем наличие новости
	if (!$news->issetNews("id=" . secure::escQuoteData($_POST['getCountComments']) . " AND token='active'")) {
		echo 0;
	} else {
		echo $newsComments->cntRecords("id_news=" . secure::escQuoteData($_POST['getCountComments']) . " AND token='active'");
	}
}
// Получение списка комментариев к новости
elseif (!empty($_POST['getComments'])) {
	$news = new news();
	$newsComments = new newsComments();

	// проверяем наличие новости
	if (!$arrNews = $news->getNews("id=" . secure::escQuoteData($_POST['getComments']) . " AND token='active'")) {
		$arrErrors[] = ERROR_COMMENT_NEWS_NOT_FOUND;
	} else {
		// Order
		$order = 'DESC';
		if (!empty($_POST['order']) && ('ordDesc' == $_POST['order'] || 'ordAsc' == $_POST['order'])) {
			$order = ('ordDesc' == $_POST['order']) ? 'DESC' : 'ASC';
		}
		// проверяем, кто смотрит новость (у автора есть право удалять комментарии)
		$newsAuthor = (!empty($_SESSION['sd_user']['data']['id']) && $_SESSION['sd_user']['data']['id'] == $arrNews['id_user']) ? true : false;

		$arrComments = $newsComments->getRecords("id_news=" . secure::escQuoteData($_POST['getComments']) . " AND token='active' ORDER BY datetime " . $order, false, false, false);
		$smarty->assignByRef('newsAuthor', $newsAuthor);
		$smarty->assignByRef('order', $order);
		$smarty->assignByRef('arrComments', $arrComments);
	}

	$smarty->assignByRef('errors', $arrErrors);
	$smarty->display('news.comments.list.tpl');
}
// Жалоба на комментарий к новости
elseif (isset($_POST['complaintComment'])) {
	if (!empty($_POST['complaintComment'])) {
		$news = new news();
		$newsComments = new newsComments();

		if ($arrComment = $newsComments->getRecord("id=" . secure::escQuoteData($_POST['complaintComment'] . " AND token='active'"))) {
			if ($arrNews = $news->getNews("id=" . secure::escQuoteData($arrComment['id_news'] . " AND token='active'"))) {
				if (!empty($arrNews['id_user'])) {
					$user = new user();
					$recipient = ($arrUser = $user->getUser("id=" . secure::escQuoteData($arrNews['id_user']) . " AND token='active'")) ? $arrUser['email'] : CONF_MAIL_ADMIN_EMAIL;
				} else {
					$recipient = CONF_MAIL_ADMIN_EMAIL;
				}

				if ($newsComments->sendComplaintComment($arrComment, $arrNews, $recipient)) {
					echo ajax::sdgJSONencode(array('success' => MESSAGE_COMMENTS_COMPLAINT_SEND));
				} else {
					echo ajax::sdgJSONencode(array('error' => MESSAGE_COMMENTS_COMPLAINT_NOT_SEND));
				}
			} else {
				echo ajax::sdgJSONencode(array('error' => MESSAGE_COMMENTS_COMPLAINT_NOT_SEND));
			}
		} else {
			echo ajax::sdgJSONencode(array('error' => MESSAGE_COMMENTS_COMPLAINT_NOT_SEND));
		}
	} else {
		echo ajax::sdgJSONencode(array('error' => MESSAGE_COMMENTS_COMPLAINT_NOT_SEND));
	}
}
// Удаление комментария к новости
elseif (isset($_POST['deleteComment']) && isset($_POST['newsId'])) {
	if (!empty($_POST['deleteComment']) && !empty($_POST['newsId'])) {
		$news = new news();
		$newsComments = new newsComments();

		if ($arrNews = $news->getNews("id=" . secure::escQuoteData($_POST['newsId'] . " AND token='active'"))) {
			if (!empty($_SESSION['sd_user']['data']['id']) && $_SESSION['sd_user']['data']['id'] == $arrNews['id_user']) {
				if ($newsComments->deleteRecords("id=" . secure::escQuoteData($_POST['deleteComment']))) {
					echo ajax::sdgJSONencode(array('success' => true));
				} else {
					echo ajax::sdgJSONencode(array('error' => MESSAGE_COMMENTS_NOT_DELETE));
				}
			} else {
				echo ajax::sdgJSONencode(array('error' => MESSAGE_COMMENTS_NOT_DELETE));
			}
		} else {
			echo ajax::sdgJSONencode(array('error' => MESSAGE_COMMENTS_NOT_DELETE));
		}
	} else {
		echo ajax::sdgJSONencode(array('error' => MESSAGE_COMMENTS_NOT_DELETE));
	}
}
// Добавление комментария к статье
elseif (isset($_POST['addCommentA']) && !empty($_POST['articleId'])) {

	if (!empty($_POST['addCommentA'])) {
		$articles = new articles();
		$aComments = new articlesComments();
		$_POST['addCommentA'] = strings::htmlEncode($_POST['addCommentA']);

		// проверяем наличие новости
		if (!$articles->getPublishedArticle("id=" . secure::escQuoteData($_POST['articleId']))) {
			echo ajax::sdgJSONencode(array('error' => ERROR_COMMENT_ARTICLE_NOT_FOUND));
		} else {
			$securimage = new securimage();
			// если добавление комментариев доступно только для зарегистрированных пользователей
			// и пользователь не авторизован, выдаем ошибку
			if (CONF_ARTICLES_COMMENTS_REGISTER && empty($_SESSION['sd_user']['data']['id'])) {
				echo ajax::sdgJSONencode(array('error' => MESSAGE_COMMENTS_REGISTER));
			} else {
				// проверяем капчу, если она включена
				if (SECURE_CAPTCHA) {
					if (empty($_POST['keystring']) || !$securimage->check($_POST['keystring'])) {
						die(ajax::sdgJSONencode(array('error' => ERROR_CAPTCHA)));
					}
				}

				// массив сервисных полей
				$sFields = array(
					'id_article' => $_POST['articleId'],
					'id_user' => ((!empty($_SESSION['sd_user']['data']['id'])) ? $_SESSION['sd_user']['data']['id'] : 0),
				);

				!empty($_POST['userName']) ? $_POST['userName'] = htmlspecialchars(htmlentities(trim($_POST['userName']), ENT_QUOTES, CONF_DEFAULT_CHARSET), ENT_QUOTES, CONF_DEFAULT_CHARSET) : null;
				$user = new user(); // пользователь
				// если пользователь авторизован и если не заполнен псевдоним польз.,
				// выдаем ошибку
				if (!empty($_SESSION['sd_user']['data']['id']) && empty($_SESSION['sd_user']['data']['alias'])) {
					echo ajax::sdgJSONencode(array('error' => ERROR_USER_ALIAS_IS_EMPTY));
				}
				// если не удалось заполнить сервисные поля, выдаем ошибку
				elseif (!$aComments->setServiceFields($sFields)) {
					echo ajax::sdgJSONencode(array('error' => ERROR_COMMENT_UNABLE_FILL_SERVICE_FIELDS));
				} elseif (!empty($_POST['userName']) && $user->issetUser("token IN ('active') AND alias=" . strtolower(secure::escQuoteData($_POST['userName'])))) {
					echo ajax::sdgJSONencode(array('error' => ERROR_USER_ALIAS_EXISTS));
				} else {
					$aComments->arrBindFields['text'] = $_POST['addCommentA'];
					$aComments->arrNoBindFields['name'] = (!empty($_SESSION['sd_user']['data']['alias'])) ? $_SESSION['sd_user']['data']['alias'] : (!empty($_POST['userName']) ? secure::escQuoteData($_POST['userName']) : CONF_ARTICLES_COMMENTS_NAME_UNREGISTER);
					$aComments->arrNoBindFields['ip'] = $_SERVER['REMOTE_ADDR'];

					if ($aComments->recRecord()) {
						echo ajax::sdgJSONencode(array('success' => true));
					} else {
						echo ajax::sdgJSONencode(array('error' => ERROR_COMMENT_UNABLE_ADD_COMMENT));
					}
				}
			}
		}
	} else {
		echo ajax::sdgJSONencode(array('error' => ERROR_COMMENT_TEXT_EMPTY));
	}
}
// получение количества комментариев к статье
elseif (!empty($_POST['getCountCommentsA'])) {
	$articles = new articles();
	$aComments = new articlesComments();

	// проверяем наличие статьи
	if (!$articles->getPublishedArticle("id=" . secure::escQuoteData($_POST['getCountCommentsA']))) {
		echo 0;
	} else {
		echo $aComments->cntRecords("id_article=" . secure::escQuoteData($_POST['getCountCommentsA']) . " AND token='active'");
	}
}
// Получение списка комментариев к статье
elseif (!empty($_POST['getCommentsA'])) {
	$articles = new articles();
	$aComments = new articlesComments();

	// проверяем наличие статьи
	if (!$arrData = $articles->getPublishedArticle("id=" . secure::escQuoteData($_POST['getCommentsA']))) {
		$arrErrors[] = ERROR_COMMENT_ARTICLE_NOT_FOUND;
	} else {
		// Order
		$order = 'DESC';
		if (!empty($_POST['order']) && ('ordDesc' == $_POST['order'] || 'ordAsc' == $_POST['order'])) {
			$order = ('ordDesc' == $_POST['order']) ? 'DESC' : 'ASC';
		}
		// проверяем, кто смотрит статью (у автора есть право удалять комментарии)
		$author = (!empty($_SESSION['sd_user']['data']['id']) && $_SESSION['sd_user']['data']['id'] == $arrData['id_user']) ? true : false;

		$arrComments = $aComments->getRecords("id_article=" . secure::escQuoteData($_POST['getCommentsA']) . " AND token='active' ORDER BY datetime " . $order, false, false, false);
		$smarty->assignByRef('author', $author);
		$smarty->assignByRef('order', $order);
		$smarty->assignByRef('arrComments', $arrComments);
	}

	$smarty->assignByRef('errors', $arrErrors);
	$smarty->display('articles.comments.list.tpl');
}
// Жалоба на комментарий к статье
elseif (isset($_POST['complaintCommentA'])) {

	if (!empty($_POST['complaintCommentA'])) {
		$articles = new articles();
		$aComments = new articlesComments();

		if ($arrComment = $aComments->getRecord("id=" . secure::escQuoteData($_POST['complaintCommentA'] . " AND token='active'"))) {
			if ($arrData = $articles->getPublishedArticle("id=" . secure::escQuoteData($arrComment['id_article']))) {
				if (!empty($arrData['id_user'])) {
					$user = new user();
					$recipient = ($arrUser = $user->getUser("id=" . secure::escQuoteData($arrData['id_user']) . " AND token='active'")) ? $arrUser['email'] : CONF_MAIL_ADMIN_EMAIL;
				} else {
					$recipient = CONF_MAIL_ADMIN_EMAIL;
				}

				if ($aComments->sendComplaintComment($arrComment, $arrData, $recipient)) {
					echo ajax::sdgJSONencode(array('success' => MESSAGE_COMMENTS_COMPLAINT_SEND));
				} else {
					echo ajax::sdgJSONencode(array('error' => MESSAGE_COMMENTS_COMPLAINT_NOT_SEND));
				}
			} else {
				echo ajax::sdgJSONencode(array('error' => MESSAGE_COMMENTS_COMPLAINT_NOT_SEND));
			}
		} else {
			echo ajax::sdgJSONencode(array('error' => MESSAGE_COMMENTS_COMPLAINT_NOT_SEND));
		}
	} else {
		echo ajax::sdgJSONencode(array('error' => MESSAGE_COMMENTS_COMPLAINT_NOT_SEND));
	}
}
// Удаление комментария к статье
elseif (isset($_POST['deleteCommentA']) && !empty($_POST['articleId'])) {
	if (!empty($_POST['deleteCommentA'])) {
		$articles = new articles();
		$aComments = new articlesComments();

		if ($arrData = $articles->getPublishedArticle("id=" . secure::escQuoteData($_POST['articleId']))) {
			if (!empty($_SESSION['sd_user']['data']['id']) && $_SESSION['sd_user']['data']['id'] == $arrData['id_user']) {
				if ($aComments->deleteRecords("id=" . secure::escQuoteData($_POST['deleteCommentA']))) {
					echo ajax::sdgJSONencode(array('success' => true));
				} else {
					echo ajax::sdgJSONencode(array('error' => MESSAGE_COMMENTS_NOT_DELETE));
				}
			} else {
				echo ajax::sdgJSONencode(array('error' => MESSAGE_COMMENTS_NOT_DELETE));
			}
		} else {
			echo ajax::sdgJSONencode(array('error' => MESSAGE_COMMENTS_NOT_DELETE));
		}
	} else {
		echo ajax::sdgJSONencode(array('error' => MESSAGE_COMMENTS_NOT_DELETE));
	}
}
// Иначе ошибка AJAX-запроса
else {
	echo 'Error AJAX-Query!';
}
