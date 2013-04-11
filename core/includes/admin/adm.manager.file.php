<?php
/********************************************************
	JobExpert v1.0
	powered by Script Developers Group (SD-Group)
	email: info@sd-group.org.ua
	url: http://sd-group.org.ua/
	Copyright 2010-2015 (c) SD-Group
	All rights reserved
=========================================================
	Менеджер - Файлы
********************************************************/
/**
* @package
* @todo
*/

(!defined('SDG')) ? die ('Triple protection!') : null;

// инициируем "Наименование страницы" отображаемое в форме
$arrNamePage = array(
						array('name' => MENU_ADMIN_MAIN, 'link' => CONF_ADMIN_FILE),
						array('name' => MENU_MANAGER, 'link' => false),
						array('name' => MENU_MANAGER_FILE, 'link' => false)
					);

/**
* иницализация массива подключаемых шаблонов: по умолчанию все значения - false
* для подключения шаблона, необходимо установить значение - true
* шаблоны подключаются в порядке установленном в файле головного шаблона
*/
$arrActions = array(
						'config'	=> false,
						'images'	=> false,
						'files'		=> false
                    );

$arrFilesData = array();
$arrImagesData = array();

$fm = new fm();

// инициируем "Наименование страницы" отображаемое в форме
$arrNamePage = array(
					array('name' => MENU_ADMIN_MAIN, 'link' => CONF_ADMIN_FILE),
					array('name' => MENU_MANAGER, 'link' => false)
				);

// определяем шаблон для отображения
(isset($_GET['action']) && isset($arrActions[$_GET['action']])) ? $arrActions[$_GET['action']] = true : null;


// настройки
if ($arrActions['config'])
{
	// инициируем "Наименование страницы" отображаемое в форме
	$arrNamePage[] = array('name' => MENU_MANAGER_FILE, 'link' => CONF_ADMIN_FILE . '?m=manager&amp;s=file');
	$arrNamePage[] = array('name' => MENU_CONFIG, 'link' => false);

	if (isset($_POST['save'])) // сохраняем данные, переданные из формы
	{
		$max_width = (int) $_POST['max_width'] ? (int) abs($_POST['max_width']) : 200;
		$max_height = (int) $_POST['max_height'] ? (int) abs($_POST['max_height']) : 200;

		$data = "<?php\n\n"
			  . "(!defined('SDG')) ? die ('Triple protection!') : null;\n\n"
			  . 'define("CONF_FILEMANAGER_PATH_TO_FILES", "uploads/filemanager/files/");' . "\n\n"
			  . 'define("CONF_FILEMANAGER_PATH_TO_IMAGES", "uploads/filemanager/images/");' . "\n\n"
			  . 'define("CONF_FILEMANAGER_THUMBNAIL_PREFIX", "thumb_");' . "\n\n"
			  . 'define("CONF_FILEMANAGER_THUMBNAIL_WIDTH", "' . $max_width . '");' . "\n\n"
			  . 'define("CONF_FILEMANAGER_THUMBNAIL_HEIGHT", "' . $max_height . '");' . "\n";

		if (!tools::saveConfig('core/conf/const.config.file.manager.php', $data, CONF_ADMIN_FILE . '?m=manager&s=file&action=config'))
		{
			$arrErrors[] = ERROR_FILES_MISSING_FILE;
		}
	}
}
elseif ($arrActions['images'])
{
	// инициируем "Наименование страницы" отображаемое в форме
	$arrNamePage[] = array('name' => MENU_MANAGER_FILE, 'link' => CONF_ADMIN_FILE . '?m=manager&amp;s=file');
	$arrNamePage[] = array('name' => MENU_MANAGER_IMAGES, 'link' => false);

	// Удаление изображений
	if (!empty($_POST['images']))
	{
		(!$fm -> deleteFiles(CONF_FILEMANAGER_PATH_TO_IMAGES, $_POST['images'])) ? $arrErrors[] = ERROR_FILES_NOT_DELETE : messages::messageChangeSaved(MESSAGE_FILE_DELETE_SUCCESS, false, CONF_ADMIN_FILE . '?m=manager&s=file&action=images');
	}
	
	$arrImages = $fm -> getFilesProperties(CONF_FILEMANAGER_PATH_TO_IMAGES . 'mda/uploads.mda');
	
	$smarty -> assignByRef('arrImages', $arrImages);
	$smarty -> assign('count', count($arrImages));
}
elseif ($arrActions['files'])
{
	// инициируем "Наименование страницы" отображаемое в форме
	$arrNamePage[] = array('name' => MENU_MANAGER_FILE, 'link' => CONF_ADMIN_FILE . '?m=manager&amp;s=file');
	$arrNamePage[] = array('name' => MENU_MANAGER_FILES, 'link' => false);

	// Удаление файлов
	if (!empty($_POST['files']))
	{
		(!$fm -> deleteFiles(CONF_FILEMANAGER_PATH_TO_FILES, $_POST['files'])) ? $arrErrors[] = ERROR_FILES_NOT_DELETE : messages::messageChangeSaved(MESSAGE_FILE_DELETE_SUCCESS, false, CONF_ADMIN_FILE . '?m=manager&s=file&action=files');
	}

	$arrFiles = $fm -> getFilesProperties(CONF_FILEMANAGER_PATH_TO_FILES . 'mda/uploads.mda');
	
	$smarty -> assignByRef('arrFiles', $arrFiles);
	$smarty -> assign('count', count($arrFiles));
}
else
{
	// инициируем "Наименование страницы" отображаемое в форме
	$arrNamePage[] = array('name' => MENU_MANAGER_FILE, 'link' => false);
}

if ($_FILES) // если массив не пустой, значит попытка загрузить файл
{
	// проверяем тип файла
	if (!empty($_POST['type']))
	{
		switch($_POST['type'])
		{
			case 'image':
				$files_dir = filesys::setPath(CONF_FILEMANAGER_PATH_TO_IMAGES);
				break;

			case 'file':
			default:
				$files_dir = filesys::setPath(CONF_FILEMANAGER_PATH_TO_FILES);
				break;
		}
	}
	else
	{
		$files_dir = filesys::setPath(CONF_FILEMANAGER_PATH_TO_FILES);
	}

	// загружаем файл
	if ($fm -> loadFile('load_file', $files_dir, $fm -> arrFileTypes))
	{
		uploads::$fileProperties['path'] = $files_dir;
		uploads::$fileProperties['link'] = $files_dir;

		// если файл - изобажение, обрабатываем его
		if ('image' === $_POST['type'])
		{
			if(img::setParam(uploads::$arrUploadsSubj['file_name'], uploads::$arrUploadsSubj['upload_dir']))
			{
				if (img::createThumbnail(CONF_FILEMANAGER_THUMBNAIL_WIDTH, CONF_FILEMANAGER_THUMBNAIL_HEIGHT))
				{
					$dbData = $fm -> getFilesProperties($files_dir . 'mda/uploads.mda');
					$dbData[uploads::$fileProperties['filename']] = uploads::$fileProperties;
					$fm -> putFilesProperties($files_dir . 'mda/uploads.mda', $dbData);

					messages::messageChangeSaved(MESSAGE_FILE_LOAD_SUCCESS, false, CONF_ADMIN_FILE . '?m=manager&s=file');
				}
				else
				{
					$arrErrors[] = ERROR_FILE_NOT_LOAD;
				}
			}
			else
			{
				$arrErrors = img::$arrErrors;
			}
		}
		else
		{
			$dbData = $fm -> getFilesProperties($files_dir . 'mda/uploads.mda');
			$dbData[uploads::$fileProperties['filename']] = uploads::$fileProperties;
			$fm -> putFilesProperties($files_dir . 'mda/uploads.mda', $dbData);

			messages::messageChangeSaved(MESSAGE_FILE_LOAD_SUCCESS, false, CONF_ADMIN_FILE . '?m=manager&s=file');
		}
	}
	else
	{
		$arrErrors = uploads::$arrErrors;
	}
	
}

$smarty -> assignByRef('errors', $arrErrors);
$smarty -> assignByRef('action', $arrActions);