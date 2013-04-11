<?php

/**
 * powered by Script Developers Group (SD-Group)
 * email: info@sd-group.org.ua
 * url: http://sd-group.org.ua/
 * Copyright 2009 (c) SD-Group
 * All rights reserved
 * ===================================================
 * Файл работы с запросами AJAX для Админки
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
require_once 'core/adm.init.php';

/**
 * Защита от доступа из вне скрипта
 */
(!secure::checkServerCalls()) ? die('Triple protection!') : null;

/**
 * Проверяем сессию администратора
 */
if (!admin::checkAdminSessionLogin()) {
    echo 'Error: Administrator is not logged!';
    exit;
}

/**
 * Передаем в Smarty системные словари (для доступа из всех шаблонов)
 */
$smarty->assignByRef('arrSysDict', $arrSysDict);

/**
 * Передаем в Smarty дополнительные словари (для доступа из всех шаблонов)
 */
$smarty->assignByRef('arrAddDict', $arrAddDict);

// получаем список профессий
if (isset($_GET['id_s']) && (int) $_GET['id_s'] && 0 < $_GET['id_s']) {
    print ajax::getProfessions($_GET['id_s']);
}
// получаем список городов
elseif (isset($_GET['id_r']) && (int) $_GET['id_r'] && 0 < $_GET['id_r']) {
    print ajax::getCitys($_GET['id_r']);
}
// получаем справочную информацию
elseif (!empty($_GET['q'])) {
    $_GET['q'] = strtoupper($_GET['q']);

    echo (defined($_GET['q'])) ? constant($_GET['q']) : $_GET['q'];
}
// получаем текущий IP
elseif (isset($_GET['getIP'])) {
    echo (!empty($_SERVER['REMOTE_ADDR'])) ? $_SERVER['REMOTE_ADDR'] : 0;
}
// Добавление IP-адреса в список разрешенных адресов доступа в Панель Администратора
elseif (!empty($_GET['addAdmAccessIP'])) {
    // получаем в массив список адресов и проверяем новый адрес на дублирование
    if (false === array_search($_GET['addAdmAccessIP'], $arrIpList = explode(';', SECURE_ADMIN_ACCESS_IP_LIST))) {
        $newIpList = array();
        foreach ($arrIpList as &$ipValue) {
            (!empty($ipValue)) ? $newIpList[] = $ipValue : null;
        }

        $newIpList[] = $_GET['addAdmAccessIP'];

        $data = "<?php\n\n"
            . "(!defined('SDG')) ? die ('Triple protection!') : null;\n\n"
            . 'define("SECURE_CAPTCHA", "' . SECURE_CAPTCHA . '");' . "\n\n"
            . 'define("SECURE_SQLERR_LOG", "' . SECURE_SQLERR_LOG . '");' . "\n\n"
            . 'define("SECURE_SQLERR_PRINT", "' . SECURE_SQLERR_PRINT . '");' . "\n\n"
            . 'define("SECURE_SQLERR_SEND_MESS", "' . SECURE_SQLERR_SEND_MESS . '");' . "\n\n"
            . 'define("SECURE_SQLERR_EMAIL", "' . SECURE_SQLERR_EMAIL . '");' . "\n\n"
            . 'define("SECURE_SQLERR_HEADERS", "' . implode('\r\n', explode("\r\n", SECURE_SQLERR_HEADERS)) . '");' . "\n\n"
            . 'define("SECURE_ADMIN_ACCESS_IP_LIST", "' . implode(';', $newIpList) . '");' . "\n";

        echo (!tools::saveConfig('core/conf/const.config.secure.php', $data, false)) ? 'errSaveConfIpList' : 'success';
    } else {
        echo 'errIpExists';
    }
}
// Удаление IP-адреса из списка разрешенных адресов доступа в Панель Администратора
elseif (!empty($_GET['delAdmAccessIP'])) {
    $keyIp = array_search($_GET['delAdmAccessIP'], $arrIpList = explode(';', SECURE_ADMIN_ACCESS_IP_LIST));
    if (false !== $keyIp) {
        unset($arrIpList[$keyIp]);

        $data = "<?php\n\n"
            . "(!defined('SDG')) ? die ('Triple protection!') : null;\n\n"
            . 'define("SECURE_CAPTCHA", "' . SECURE_CAPTCHA . '");' . "\n\n"
            . 'define("SECURE_SQLERR_LOG", "' . SECURE_SQLERR_LOG . '");' . "\n\n"
            . 'define("SECURE_SQLERR_PRINT", "' . SECURE_SQLERR_PRINT . '");' . "\n\n"
            . 'define("SECURE_SQLERR_SEND_MESS", "' . SECURE_SQLERR_SEND_MESS . '");' . "\n\n"
            . 'define("SECURE_SQLERR_EMAIL", "' . SECURE_SQLERR_EMAIL . '");' . "\n\n"
            . 'define("SECURE_SQLERR_HEADERS", "' . implode('\r\n', explode("\r\n", SECURE_SQLERR_HEADERS)) . '");' . "\n\n"
            . 'define("SECURE_ADMIN_ACCESS_IP_LIST", "' . implode(';', $arrIpList) . '");' . "\n";

        echo (!tools::saveConfig('core/conf/const.config.secure.php', $data, false)) ? 'errSaveConfIpList' : 'success';
    } else {
        echo 'errIpNotExists';
    }
}
// Загрузка файлов на сервер
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
// Действия
elseif (!empty($_GET['action'])) {
    // устанавливаем статусы VIP|HOT|Rate
    if (('setVIP' === $_GET['action'] || 'resetVIP' === $_GET['action'] || 'setHOT' === $_GET['action'] || 'resetHOT' === $_GET['action'] || 'setRate' === $_GET['action'] || 'resetRate' === $_GET['action']) && !empty($_POST['annType']) && ('vacancy' === $_POST['annType'] || 'resume' === $_POST['annType']) && (int) $_POST['id'] && 0 < $_POST['id']) {
        $announce = new $_POST['annType']();
        echo (!$announce->$_GET['action']($_POST['id'])) ? 'errSet' : 'success';
    }
    // устанавливаем свойство "Вид размещения"
    elseif ('editVisibility' === $_GET['action'] && !empty($_POST['visibility']) && ('visible' === $_POST['visibility'] || 'visiblehc' === $_POST['visibility'] || 'members' === $_POST['visibility'] || 'membershc' === $_POST['visibility'] || 'hide' === $_POST['visibility']) && (int) $_POST['id'] && 0 < $_POST['id']) {
        $resume = new resume();
        echo (!$resume->setVisibility($_POST['visibility'], $_POST['id'])) ? 'errSet' : 'success';
    } elseif ('getFileContent' === $_GET['action'] && !empty($_GET['fileName'])) {
        echo (!is_file($_GET['fileName'])) ? 'errFileNotExists' : @file_get_contents($_GET['fileName']);
    } elseif ('putFileContent' === $_GET['action'] && !empty($_POST['fileName']) && isset($_POST['fileContents'])) {
        echo (false === @file_put_contents($_POST['fileName'], $_POST['fileContents'])) ? 'errPutFileContents' : 'success';
    } elseif ('delFile' === $_GET['action'] && !empty($_POST['nameFile'])) {
        if (!is_file($_POST['nameFile'])) {
            echo 'errFileNotExists';
        } else {
            echo (false === @unlink($_POST['nameFile'])) ? 'errDelFile' : 'success';
        }
    } elseif ('delDir' === $_GET['action'] && !empty($_POST['nameDir'])) {
        if (!is_dir($_POST['nameDir'])) {
            echo 'errDirNotExists';
        } else {
            echo (!filesys::removeDir($_POST['nameDir'])) ? 'errDelFile' : 'success';
        }
    } elseif ('mdsDoImportDB' === $_GET['action']) {
        echo import::$_GET['action']();
    } elseif ('cloneTemplate' === $_GET['action'] && !empty($_POST['currTemplate']) && is_dir('templates/site/' . $_POST['currTemplate']) && !empty($_POST['nameTemplate'])) {
        if (is_dir('templates/site/' . $_POST['nameTemplate'])) {
            echo 'errTemplateExsists';
        } elseif (!$arrFiles = filesys::getFilesInDir(filesys::setPath('templates/site/' . $_POST['currTemplate']))) {
            echo 'errCloningTemplateIsEmpty';
        } elseif (!@mkdir('templates/site/' . $_POST['nameTemplate'], 0755)) {
            echo 'errCreateDirTemplate';
        } elseif (!@mkdir('templates/site/' . $_POST['nameTemplate'] . '/style', 0755)) {
            echo 'errCreateDirTemplateStyle';
        } elseif (!@mkdir('templates/site/' . $_POST['nameTemplate'] . '/images', 0755)) {
            echo 'errCreateDirTemplateImages';
        } else {
            foreach ($arrFiles as &$file) {
                (!empty($_POST['emptyTemplateFiles'])) ? file_put_contents(filesys::setPath('templates/site/' . $_POST['nameTemplate']) . $file, '') : copy(filesys::setPath('templates/site/' . $_POST['currTemplate']) . $file, filesys::setPath('templates/site/' . $_POST['nameTemplate']) . $file);
            }

            (!empty($_POST['includeCss'])) ? filesys::copyDirContent('templates/site/' . $_POST['currTemplate'] . '/style', 'templates/site/' . $_POST['nameTemplate'] . '/style') : null;

            (!empty($_POST['includePics'])) ? filesys::copyDirContent('templates/site/' . $_POST['currTemplate'] . '/images', 'templates/site/' . $_POST['nameTemplate'] . '/images') : null;

            echo 'success';
        }
    } elseif ('updateTemplate' === $_GET['action'] && !empty($_POST['nameTemplate']) && is_dir('templates/site/' . $_POST['nameTemplate'])) {
        if (!$arrFiles = array_diff(filesys::getFilesInDir('templates/site/default/'), filesys::getFilesInDir(filesys::setPath('templates/site/' . $_POST['nameTemplate'])))) {
            echo ajax::sdgJSONencode(array('result' => 'tplListDiffNotFound'));
        } else {
            $arrList = array();
            foreach ($arrFiles as &$file) {
                copy('templates/site/default/' . $file, filesys::setPath('templates/site/' . $_POST['nameTemplate']) . $file);
                $arrList[] = array('id' => str_replace('.', '_', $file), 'name' => $file);
            }

            echo '{"result":"success", "listFiles":' . ajax::sdgJSONencode(array_reverse($arrList)) . '}';
        }
    } elseif ('deleteTemplate' === $_GET['action'] && !empty($_POST['nameTemplate']) && is_dir('templates/site/' . $_POST['nameTemplate'])) {
        if ('default' == $_POST['nameTemplate']) {
            echo 'errDelDefaultTemplate';
        } elseif (CONF_TEMPLATE == $_POST['nameTemplate']) {
            echo 'errDelConfTemplate';
        } else {
            sleep(1);
            echo (!filesys::removeDir('templates/site/' . $_POST['nameTemplate'])) ? 'errDelTemplate' : 'success';
        }
    } elseif ('addTplFile' === $_GET['action'] && !empty($_POST['nameTplFile']) && is_dir('templates/site/' . $_POST['currTemplate']) && !empty($_POST['discriptionTplFile'])) {
        if (is_file('templates/site/' . $_POST['currTemplate'] . '/' . $_POST['nameTplFile'])) {
            echo 'errTplFileExists';
        } else {
            $arrData = localiz::getConstForParsingFile("lang/russian/adm.lang.templates.php");
            $nameConst = 'HELP_ADMIN_TEMPLATE_DESCRIPTION_' . str_replace('.', '_', strtoupper($_POST['nameTplFile']));
            $arrData[$nameConst] = $_POST['discriptionTplFile'];
            $arrNewData = array();
            foreach ($arrData as $constName => &$constValue) {
                $arrNewData[] = "define('" . strtoupper($constName) . "', '" . ((!empty($constValue)) ? $constValue : strtoupper($constName)) . "');";
            }

            $data = "<?php\n\n"
                . "(!defined('SDG')) ? die ('Triple protection!') : null;\n\n"
                . implode("\n\n", $arrNewData) . "\n";

            file_put_contents("lang/russian/adm.lang.templates.php", $data);
            echo (false === @file_put_contents('templates/site/' . $_POST['currTemplate'] . '/' . $_POST['nameTplFile'], '')) ? 'errAddTplFile' : 'success';
        }
    } elseif ('delTplFile' === $_GET['action'] && !empty($_POST['nameTplFile']) && is_dir('templates/site/' . $_POST['currTemplate'])) {
        if (!is_file('templates/site/' . $_POST['currTemplate'] . '/' . $_POST['nameTplFile'])) {
            echo 'errFileNotExists';
        } else {
            $arrData = localiz::getConstForParsingFile("lang/russian/adm.lang.templates.php");
            $nameConst = 'HELP_ADMIN_TEMPLATE_DESCRIPTION_' . str_replace('.', '_', strtoupper($_POST['nameTplFile']));
            if (isset($arrData[$nameConst])) {
                unset($arrData[$nameConst]);
            }
            $arrNewData = array();
            foreach ($arrData as $constName => &$constValue) {
                $arrNewData[] = "define('" . strtoupper($constName) . "', '" . ((!empty($constValue)) ? $constValue : strtoupper($constName)) . "');";
            }

            $data = "<?php\n\n"
                . "(!defined('SDG')) ? die ('Triple protection!') : null;\n\n"
                . implode("\n\n", $arrNewData) . "\n";

            file_put_contents("lang/russian/adm.lang.templates.php", $data);
            echo (false === @unlink('templates/site/' . $_POST['currTemplate'] . '/' . $_POST['nameTplFile'])) ? 'errDelFile' : 'success';
        }
    } elseif ('addCssFile' === $_GET['action'] && !empty($_POST['nameCssFile']) && is_dir('templates/site/' . $_POST['currTemplate'] . '/style')) {
        if (is_file('templates/site/' . $_POST['currTemplate'] . '/style/' . $_POST['nameCssFile'])) {
            echo 'errCssFileExists';
        } else {
            echo (false === @file_put_contents('templates/site/' . $_POST['currTemplate'] . '/style/' . $_POST['nameCssFile'], '')) ? 'errAddCssFile' : 'success';
        }
    } elseif ('editAnnounce' === $_GET['action'] && !empty($_POST['typeAnnounce']) && ('resume' === $_POST['typeAnnounce'] || 'vacancy' === $_POST['typeAnnounce']) && (int) $_POST['id'] && 0 < $_POST['id']) {
        // создаем объект
        $objAnnounce = new $_POST['typeAnnounce']();
        // получаем данные объявления
        if (!$objAnnounce->getAnnounceById($_POST['id'])) {
            die('errAnnounceNotExists');
        } elseif (isset($_GET['save']) && !empty($_POST['arrBindFields']) && !empty($_POST['arrNoBindFields']) && !empty($_POST['arrServiceFields'])) {
            switch ($_POST['typeAnnounce']) {
                case 'resume': {
                        $arrAnnounceData = $objAnnounce->retAnnSubj();

                        if ($_POST['arrNoBindFields']['image'] !== $arrAnnounceData['image'] && !empty($arrAnnounceData['image'])) {
                            foreach (explode(',', $arrAnnounceData['image']) as $image) {
                                @unlink('uploads/images/photos/' . $image);
                            }
                        }

                        echo (!$objAnnounce->editAnnounceService($_POST['arrBindFields'], $_POST['arrNoBindFields'], $_POST['arrServiceFields'], $_POST['arrFieldsXmlData'])) ? 'errAnnSave' : 'success';

                        break;
                    }

                case 'vacancy': {
                        echo (!$objAnnounce->editAnnounceService($_POST['arrBindFields'], $_POST['arrNoBindFields'], $_POST['arrServiceFields'])) ? 'errAnnSave' : 'success';

                        break;
                    }
            }
        } else {
            $arrAnnData = array();
            $objAnnounce->setEditData($arrAnnData, false);

            switch ($_POST['typeAnnounce']) {
                case 'resume': {
                        $hprofessions[] = $arrAnnData['arrBindFields']['id_profession'];
                        if (!empty($arrAnnData['arrBindFields']['id_profession_1'])) {
                            $hprofessions[] = $arrAnnData['arrBindFields']['id_profession_1'];
                        } elseif (!empty($arrAnnData['arrNoBindFields']['id_profession_1'])) {
                            $hprofessions[] = $arrAnnData['arrNoBindFields']['id_profession_1'];
                        }
                        if (!empty($arrAnnData['arrBindFields']['id_profession_2'])) {
                            $hprofessions[] = $arrAnnData['arrBindFields']['id_profession_2'];
                        } elseif (!empty($arrAnnData['arrNoBindFields']['id_profession_2'])) {
                            $hprofessions[] = $arrAnnData['arrNoBindFields']['id_profession_2'];
                        }
                        $hprofessions = '[' . implode(',', $hprofessions) . ']';
                        $smarty->assignByRef('hprofessions', $hprofessions);

                        // обработка чеккера "Старт карьеры"
                        $smarty->assign('career_launch', (!empty($arrAnnData['arrFieldsXmlData']['expires'])) ? false : true);
                        // обработка чеккера "Не владею иностранными языками"
                        $smarty->assign('noforeign_lang', (1 < count($arrAnnData['arrFieldsXmlData']['languages'])) ? false : true);

                        // формируем массив "Годы" для анкеты: текущий год минус 50 лет
                        for ($year = date('Y'); $year >= date('Y') - 50; $year--) {
                            $arrYears[$year] = (int) $year;
                        }

                        // передаем массив "Годы"
                        $smarty->assignByRef('years', $arrYears);
                        // передаем массив селекта "Образование"
                        unset($arrAddDict['Education']['values'][0]); // вырезаем ненужное значение
                        // передаем массив селекта "Пол"
                        unset($arrSysDict['Gender']['values']['none']); // вырезаем ненужное значение
                        // массив полей формы анкеты, хранимых в XML-формате
                        $smarty->assignByRef('arrFieldsXmlData', $arrAnnData['arrFieldsXmlData']);

                        break;
                    }

                case 'vacancy': {
                        // передаем массив селекта "График работы"
                        unset($arrAddDict['ChartWork']['values'][0]); // вырезаем ненужное значение

                        break;
                    }
            }

            // передаем массив селекта "Валюты"
            unset($arrSysDict['Currency']['values'][0]); // вырезаем ненужное значение
            // массив полей формы анкеты, обязательных для заполнения
            $smarty->assignByRef('arrBindFields', $arrAnnData['arrBindFields']);
            // массив полей формы анкеты, необязательных для заполнения
            $smarty->assignByRef('arrNoBindFields', $arrAnnData['arrNoBindFields']);
            // массив сервисных полей объявления
            $smarty->assignByRef('arrServiceFields', $arrAnnData['arrServiceFields']);

            /**
             * инициализация списка разделов
             */
            $sections = new sections();
            $arrDataSections = $sections->retCategorys();
            $smarty->assignByRef('sections', $arrDataSections);

            /**
             * инициализация списка регионов
             */
            $regions = new regions();
            $arrDataRegions = $regions->retCategorys();
            $smarty->assignByRef('regions', $arrDataRegions);

            echo $smarty->fetch('adm.announces.' . $_POST['typeAnnounce'] . '.edit.tpl');
        }
    } elseif ('addConstLang_custom' === $_GET['action'] && !empty($_POST['nameConst']) && preg_match("/[A-Za-z0-9\-_]/", $_POST['nameConst']) && !empty($_POST['valueConst'])) {
        $arrData = localiz::getConstForParsingFile("lang/" . $_POST['currLocaliz'] . "/lang._custom.php");
        $nameConst = 'LANG_CONST_CUSTOM_' . strtoupper($_POST['nameConst']);
        if (!isset($arrData[$nameConst])) {
            $arrData[$nameConst] = $_POST['valueConst'];
            $arrNewData = array();
            foreach ($arrData as $constName => &$constValue) {
                $arrNewData[] = "define('" . strtoupper($constName) . "', '" . ((!empty($constValue)) ? $constValue : strtoupper($constName)) . "');";
            }

            $data = "<?php\n\n"
                . "(!defined('SDG')) ? die ('Triple protection!') : null;\n\n"
                . implode("\n\n", $arrNewData) . "\n";

            echo (file_put_contents("lang/" . $_POST['currLocaliz'] . "/lang._custom.php", $data)) ? 'success' : 'errConstAdding';
        } else {
            echo 'errConstLangCustomExsists';
        }
    } elseif ('delConstLang_custom' === $_GET['action'] && !empty($_POST['nameConst'])) {
        $arrData = localiz::getConstForParsingFile("lang/" . $_POST['currLocaliz'] . "/lang._custom.php");
        if (isset($arrData[$_POST['nameConst']])) {
            unset($arrData[$_POST['nameConst']]);
            $arrNewData = array();
            foreach ($arrData as $constName => &$constValue) {
                $arrNewData[] = "define('" . strtoupper($constName) . "', '" . ((!empty($constValue)) ? $constValue : strtoupper($constName)) . "');";
            }

            $data = "<?php\n\n"
                . "(!defined('SDG')) ? die ('Triple protection!') : null;\n\n"
                . implode("\n\n", $arrNewData) . "\n";

            echo (file_put_contents("lang/" . $_POST['currLocaliz'] . "/lang._custom.php", $data)) ? 'success' : 'errConstDeleting';
        } else {
            echo 'errConstLangCustomNoExsists';
        }
    } elseif ('googleTranslate' === $_GET['action']) {
        $curlResult = curl_exec($ch);
        if (!empty($curlResult)) {
            $curlInfo = curl_getinfo($ch);
            ($curlInfo['http_code'] == 200) ? $result = & $curlResult : $result = 'err' . $curlInfo['http_code'];
        } else {
            $result = 'errCurlNoExec';
        }

        curl_close($ch);
        echo $result;
    } else {
        echo 'errParams';
    }
}
// создание бекапа сайта
elseif (!empty($_POST['backup'])) {
    if ($_POST['backup'] === 'php') {
        echo (($res = backup::backupSite()) === true) ? MESSAGE_BACKUP_SUCCESSFULLY_CREATED : $res . '<br><span style="color: red;">' . WARNING_BACKUP_NOT_CREATE . '</span>';
    } elseif ($_POST['backup'] === 'sql') {
        echo (backup::backupDB()) ? MESSAGE_BACKUP_SUCCESSFULLY_CREATED : '<span style="color: red;">' . WARNING_BACKUP_NOT_CREATE . '</span>';
    }
}
// установка обновления
elseif (!empty($_POST['setupUpdate']) && !empty($_POST['step'])) {
    $fileSetupUpdate = CONF_UPDATES_PATH_TO_FILES . $_POST['setupUpdate'];
    //$logFile = CONF_UPDATES_PATH_TO_LOG_FILES . terms::currentDate() . '_update.log';
    //$message = addslashes(MESSAGE_WARNING_UPDATE_ERRORS_OCCURRED . SITE_UPDATE_ERROR_LOG_FILE . ' - <b><a href="' . CONF_ADMIN_FILE . '?m=system&s=updates&action=saveLog&file=' . $logFile . '" title="' . FORM_BUTTON_SAVE . '">' . $logFile . '</a></b>');

    if (1 == $_POST['step']) {
        if (!updates::setupUpdate(CONF_UPDATES_PATH_TO_FILES . $_POST['setupUpdate'])) {
            echo ajax::sdgJSONencode(array('error' => updates::$errorMessage));
        } else {
            // Если сообщения не пустые, значит ошибки были
            if (!empty(updates::$errorMessage)) {
                echo ajax::sdgJSONencode(array('success' => MESSAGE_WARNING_UPDATE_SETUP_BUT_ERRORS_OCCURRED));
            } else {
                echo ajax::sdgJSONencode(array('success' => updates::$message));
            }

            //echo (file_exists($logFile)) ? ajax::sdgJSONencode(array('response' => array('error' => $message))) : ajax::sdgJSONencode(array('response' => array('success' => updates::$message)));
        }
    } elseif (2 == $_POST['step']) {
        if (!updates::extractUpdate(CONF_UPDATES_PATH_TO_FILES . $_POST['setupUpdate'])) {
            echo ajax::sdgJSONencode(array('error' => updates::$errorMessage));
        } else {
            // Если сообщения не пустые, значит ошибки были
            if (!empty(updates::$errorMessage)) {
                echo ajax::sdgJSONencode(array('success' => MESSAGE_WARNING_UPDATE_SETUP_BUT_ERRORS_OCCURRED));
            } else {
                echo ajax::sdgJSONencode(array('success' => updates::$message));
            }

            // удаляем файлы кеша
            caching::dropCache();
            // удаляем файл обновлений
            unlink(CONF_UPDATES_PATH_TO_FILES . $_POST['setupUpdate']);
            // Переименовываем файл логов, вкючая в его имя номер сборки
            $logFile = CONF_UPDATES_PATH_TO_LOG_FILES . terms::currentDate() . '_update.log';
            if (file_exists($logFile)) {
                rename($logFile, CONF_UPDATES_PATH_TO_LOG_FILES . terms::currentDate() . '_' . CONF_INFO_PRODUCT_ID . '_' . CONF_INFO_SCRIPT_REVISION . '_update.log');
            }
            // отключаем техобслуживание сайта
            $data = "<?php\n\n"
                . "(!defined('SDG')) ? die ('Triple protection!') : null;\n\n"
                . 'define("CONF_SERVICE_ADMINISTRATION_MAINTENANCE", false);' . "\n";

            tools::saveConfig('core/conf/const.config.service.php', $data, false);
        }
    } else {
        echo ajax::sdgJSONencode(array('error' => ERROR_UPDATES_REQUEST_UNDEFINED_ACTION));
    }
}
// Перевод сайта в режим тех. работ
elseif (!empty($_POST['maintenance'])) {
    $maintenance = ($_POST['maintenance'] == 'on') ? 'true' : 'false';

    $data = "<?php\n\n"
        . "(!defined('SDG')) ? die ('Triple protection!') : null;\n\n"
        . 'define("CONF_SERVICE_ADMINISTRATION_MAINTENANCE", ' . $maintenance . ');' . "\n";

    echo (!tools::saveConfig('core/conf/const.config.service.php', $data, false)) ? 'false' : 'true';
}
// Сохранение шаблона почтового сообщения
elseif (!empty($_POST['mailFile']) && !empty($_POST['mailText']) && !empty($_POST['pathMailTemplates'])) {
    $_POST['mailFile'] = $_POST['pathMailTemplates'] . str_replace('_', '.', $_POST['mailFile']) . '.txt'; // формируем имя файла
    echo tools::saveMailTemplateFile($_POST['mailFile'], $_POST['mailText']);
}
// Изменение данных пользователя
elseif (!empty($_POST['uID']) && !empty($_POST['userType']) && !empty($_POST['userGroup'])) {
    $user = new user();
    $user->changeTable('conf_users');
    $response = (!$user->updateUser(array('user_type' => $_POST['userType'], 'user_group' => $_POST['userGroup']), "id IN (" . secure::escQuoteData($_POST['uID']) . ")")) ? db::$message_error : 'true';
    $user->changeTable('users', USR_PREFIX);
    echo $response;
}
// Получаем детали выбранной статьи
elseif (!empty($_POST['getArticleDetail']) && !empty($_POST['strQuery'])) {
    $articles = new articles();
    $arrArticle = $articles->getArticle("id IN (" . secure::escQuoteData($_POST['getArticleDetail']) . ")");
    $aComments = new articlesComments();
    $arrOrder = array('datetime' => 'DESC');
    $arrComments = $aComments->getRecords("id_article=" . secure::escQuoteData($_POST['getArticleDetail']) . " AND token='active'", $arrOrder, false, false);

    // адресная строка
    $smarty->assignByRef('qString', $_POST['strQuery']);
    $smarty->assignByRef('arrArticle', $arrArticle);
    $smarty->assignByRef('arrComments', $arrComments);
    $smarty->display('adm.manager.articles.detail.tpl');
}
// Получаем детали выбранной новости
elseif (!empty($_POST['getNewsDetail']) && !empty($_POST['strQuery'])) {
    $news = new news();
    $arrNews = $news->getNews("id=" . secure::escQuoteData($_POST['getNewsDetail']));
    $newsComments = new newsComments();
    $arrOrder = array('datetime' => 'DESC');
    $arrComments = $newsComments->getRecords("id_news=" . secure::escQuoteData($_POST['getNewsDetail']) . " AND token='active'", $arrOrder, false, false);

    // адресная строка
    $smarty->assignByRef('qString', $_POST['strQuery']);
    $smarty->assignByRef('arrNews', $arrNews);
    $smarty->assignByRef('arrComments', $arrComments);
    $smarty->display('adm.manager.news.detail.tpl');
}
// Просмотр файла логов оплат
elseif (!empty($_POST['getLogPaymentsFileDetail'])) {
    if (file_exists('core/data/log/' . $_POST['getLogPaymentsFileDetail'])) {
        echo ($fData = file_get_contents('core/data/log/' . $_POST['getLogPaymentsFileDetail'])) ? nl2br($fData) : ERROR_FILE_NOT_OPEN;
    } else {
        echo ERROR_FILE_NOT_FOUND;
    }
}
// Просмотр деталей логов оплат
elseif (!empty($_POST['getLogPaymentsDetail'])) {
    $payments = new payments();

    $arrData = $payments->dbGetLogPayment("id IN (" . secure::escQuoteData($_POST['getLogPaymentsDetail']) . ")");
    if (!empty($arrData) && is_array($arrData)) {
        $arrData = unserialize($arrData['data']);

        // Если мод HAND, раскодируем сообщение
        (!empty($arrData['payment_type']) && strtoupper($arrData['payment_type']) == 'HAND' && !empty($arrData['message'])) ? $arrData['message'] = base64_decode($arrData['message']) : null;

        $resText = '';
        foreach ($arrData as $key => &$value) {
            $resText .= '<strong>' . strtoupper($key) . ':</strong> ' . $value . "<br>";
        }

        echo $resText;
    } else {
        echo ERROR_UNABLE_TO_RETRIEVE_DATA;
    }
}
// Удаление комментария к новости
elseif (isset($_POST['deleteComment'])) {
    if (!empty($_POST['deleteComment'])) {
        $newsComments = new newsComments();

        if ($newsComments->deleteRecords("id=" . secure::escQuoteData($_POST['deleteComment']))) {
            echo ajax::sdgJSONencode(array('success' => true));
        } else {
            echo ajax::sdgJSONencode(array('error' => MESSAGE_COMMENTS_NOT_DELETE));
        }
    } else {
        echo ajax::sdgJSONencode(array('error' => MESSAGE_COMMENTS_NOT_DELETE));
    }
}
// Удаление комментария к статье
elseif (isset($_POST['deleteCommentA'])) {
    if (!empty($_POST['deleteCommentA'])) {
        $aComments = new articlesComments();

        if ($aComments->deleteRecords("id=" . secure::escQuoteData($_POST['deleteCommentA']))) {
            echo ajax::sdgJSONencode(array('success' => true));
        } else {
            echo ajax::sdgJSONencode(array('error' => MESSAGE_COMMENTS_NOT_DELETE));
        }
    } else {
        echo ajax::sdgJSONencode(array('error' => MESSAGE_COMMENTS_NOT_DELETE));
    }
} else if (!empty($_POST['do'])) {
    // переключение Региона в статус "Регион-Город"
    if ('setRegionMajor' == $_POST['do'] && !empty($_POST['rid'])) {
        $force = (isset($_POST['force'])) ? true : false;
        /**
         * инициализация списка регионов
         */
        $regions = new regions();
        $arrDataRegions = $regions->retCategorys();

        if (!empty($arrDataRegions[$_POST['rid']])) {
            $arrFields = array($_POST['rid']);
            $citys = new citys();

            if ($force) {
                $listCitys = $citys->retCategorysByParentIds($_POST['rid']);
                if (is_array($listCitys) && $citys->actionCitys('del', array_keys($listCitys), $_POST['rid'], true)) {
                    if ($regions->actionRegions('setRegionMajor', $arrFields, true)) {
                        echo ajax::sdgJSONencode(array('success' => true));
                    } else {
                        echo ajax::sdgJSONencode(array('error' => 'errRegionSetMajor'));
                    }
                } else {
                    echo ajax::sdgJSONencode(array('error' => 'errRegionDeleteChildRecords'));
                }
            } else if ($citys->retCategorysByParentIds($_POST['rid'])) {
                echo ajax::sdgJSONencode(array('error' => 'errRegionHasChildRecords'));
            } else if ($regions->actionRegions('setRegionMajor', $arrFields, true)) {
                echo ajax::sdgJSONencode(array('success' => true));
            } else {
                echo ajax::sdgJSONencode(array('error' => 'errRegionSetMajor'));
            }
        } else {
            echo ajax::sdgJSONencode(array('error' => ERROR_FATAL_UNCORRECT_PARAMS));
        }
    }
    // Отключение статуса "Регион-Город"
    else if ('resetRegionMajor' == $_POST['do'] && !empty($_POST['rid'])) {
        /**
         * инициализация списка регионов
         */
        $regions = new regions();
        $arrDataRegions = $regions->retCategorys();

        if (!empty($arrDataRegions[$_POST['rid']])) {
            if ($regions->actionRegions('resetRegionMajor', array($_POST['rid']), true)) {
                echo ajax::sdgJSONencode(array('success' => true));
            } else {
                echo ajax::sdgJSONencode(array('error' => 'errResetRegionMajor'));
            }
        } else {
            echo ajax::sdgJSONencode(array('error' => ERROR_FATAL_UNCORRECT_PARAMS));
        }
    }
    // Включение/Отключение разрещения добавления городов пользователями сайта
    else if (('setAddCityAllowed' == $_POST['do'] || 'resetAddCityAllowed' == $_POST['do']) && !empty($_POST['rid'])) {
        /**
         * инициализация списка регионов
         */
        $regions = new regions();
        $arrDataRegions = $regions->retCategorys();

        if (!empty($arrDataRegions[$_POST['rid']])) {
            if ($regions->actionRegions($_POST['do'], array($_POST['rid']), true)) {
                echo ajax::sdgJSONencode(array('success' => true));
            } else {
                echo ajax::sdgJSONencode(array('error' => 'errActionAddCityAllowed'));
            }
        } else {
            echo ajax::sdgJSONencode(array('error' => ERROR_FATAL_UNCORRECT_PARAMS));
        }
    } else {
        echo ajax::sdgJSONencode(array('error' => ERROR_FATAL_UNCORRECT_PARAMS));
    }
}
// Рассылка пользователям
elseif (isset($_POST['doUserSubscription'])) {
    if (!empty($_POST['doUserSubscription'])) {
        if (!empty($_POST['mailerSubject'])) {
            if ((!empty($_POST['uGroups']) && is_array($_POST['uGroups'])) || (!empty($_POST['uTypes']) && is_array($_POST['uTypes']))) {
                $user = new user();
                $arrFields = array(array('users', 'id'), array('users', 'email'));

                // формируем запрос
                if (empty($_POST['uGroups']) && (!empty($_POST['uTypes']))) {
                    $strWhere = "conf_users.user_type IN (" . implode(',', secure::escQuoteData($_POST['uTypes'])) . ") AND conf_users.token IN ('active')";
                } elseif (!empty($_POST['uGroups']) && (empty($_POST['uTypes']))) {
                    $strWhere = "conf_users.user_group IN (" . implode(',', secure::escQuoteData($_POST['uGroups'])) . ") AND conf_users.token IN ('active')";
                } else {
                    $strWhere = "conf_users.user_type IN (" . implode(',', secure::escQuoteData($_POST['uTypes'])) . ") AND conf_users.user_group IN (" . implode(',', secure::escQuoteData($_POST['uGroups'])) . ") AND conf_users.token IN ('active')";
                }

                (empty($_POST['noSubscr'])) ? $strWhere .= " AND conf_users.mailer_subscribe>0" : null;

                $arrUsers = $user->getCombinedUsersData($arrFields, $strWhere, false, false);
                if (!empty($arrUsers) && is_array($arrUsers)) {
                    $count = $user->cntUsers();
                    $mailer = new mailer();
                    foreach ($arrUsers as $value) {
                        // очищаем список адресов
                        $mailer->ClearAddresses();
                        $mailer->sendEmail(CONF_MAIL_ADMIN_EMAIL, false, false, $value['email'], false, $_POST['mailerSubject'], $_POST['doUserSubscription'], true);
                    }

                    echo ajax::sdgJSONencode(array('success' => $count));
                } else {
                    echo ajax::sdgJSONencode(array('error' => MESSAGE_WARNING_MAILER_NOT_FOUND_USERS));
                }
            } else {
                echo ajax::sdgJSONencode(array('error' => ERROR_MAILER_SELECT_GROUP_OR_TYPE));
            }
        } else {
            echo ajax::sdgJSONencode(array('error' => ERROR_EMPTY_SUBJECT));
        }
    } else {
        echo ajax::sdgJSONencode(array('error' => ERROR_EMPTY_TEXT));
    }
}
// Рассылка пользователям
elseif (!empty($_POST['getMailerTemplate'])) {
    $file = 'core/data/templates/mailer/' . $_POST['getMailerTemplate'] . '.txt';
    echo (file_exists($file)) ? file_get_contents($file) : '';
}
// Создание файла шаблона рассылки
elseif (!empty($_POST['createMailerTemplate'])) {
    $_POST['createMailerTemplate'] = trim($_POST['createMailerTemplate']);

    if (!file_exists('core/data/templates/mailer/' . $_POST['createMailerTemplate'] . '.txt')) {
        if (file_put_contents('core/data/templates/mailer/' . $_POST['createMailerTemplate'] . '.txt', '') === false) {
            echo ajax::sdgJSONencode(array('error' => ERROR_MAILER_TEMPLATES_FAILED_CREATE_FILE));
        } else {
            echo ajax::sdgJSONencode(array('success' => true));
        }
    } else {
        echo ajax::sdgJSONencode(array('error' => ERROR_CLONE_TEMPLATE_EXSISTS));
    }
}
// Удаление файла шаблона рассылки
elseif (!empty($_POST['deleteMailerTemplate'])) {
    $_POST['deleteMailerTemplate'] = trim($_POST['deleteMailerTemplate']);

    if (!unlink('core/data/templates/mailer/' . $_POST['deleteMailerTemplate'] . '.txt')) {
        echo ajax::sdgJSONencode(array('error' => ERROR_MAILER_TEMPLATES_FAILED_TO_REMOVE_FILE));
    } else {
        echo ajax::sdgJSONencode(array('success' => true));
    }
}
// Сохранение шаблона рассылки
elseif (!empty($_POST['saveMailerTemplate']) && !empty($_POST['text'])) {
    $_POST['saveMailerTemplate'] = trim($_POST['saveMailerTemplate']);

    echo (!file_put_contents('core/data/templates/mailer/' . $_POST['saveMailerTemplate'] . '.txt', $_POST['text'])) ? MESSAGE_CHANGE_NOT_SAVED : MESSAGE_CHANGE_SAVED;
}
// Получение данных платежного мода
elseif (!empty($_POST['getPamentModData'])) {
    $payments = new payments(); // платные услуги
    $strWhere = "id=" . secure::escQuoteData($_POST['getPamentModData']);
    $arrData = $payments->getRecord($strWhere);
    if ($arrData) {
        $smarty->assignByRef('modData', $arrData);
        $smarty->display('adm.mods.payments.edit.tpl');
    } else {
        echo 'errorModNotExists';
    }
}
// Сохранение данных платежного мода
elseif (!empty($_POST['savePamentModData']) && isset($_POST['modTitle']) && isset($_POST['modDescr'])) {
    $payments = new payments(); // платные услуги

    $arrData = array('title' => trim($_POST['modTitle']), 'description' => trim($_POST['modDescr']));
    $strWhere = "id=" . secure::escQuoteData($_POST['savePamentModData']);

    if ($payments->getRecord($strWhere)) {
        if ($payments->updateRecords($arrData, $strWhere)) {
            echo ajax::sdgJSONencode(array('success' => true));
        } else {
            echo ajax::sdgJSONencode(array('error' => MESSAGE_CHANGE_NOT_SAVED));
        }
    } else {
        echo ajax::sdgJSONencode(array('error' => ERROR_COULD_NOT_FOUND_RECORD_TO_UPDATE));
    }
}
// Логи обновления
elseif (!empty($_POST['getUpdatesLogsDetail'])) {
    if (file_exists(CONF_UPDATES_PATH_TO_LOG_FILES . $_POST['getUpdatesLogsDetail'])) {
        $arrData = filesys::getSerializedData(CONF_UPDATES_PATH_TO_LOG_FILES . $_POST['getUpdatesLogsDetail']);

        if (!empty($arrData) && is_array($arrData)) {
            $smarty->assignByRef('arrData', $arrData);
            $smarty->display('adm.system.updates.logs.detail.tpl');
        } else {
            echo 'errorUncorrectParams';
        }
    } else {
        echo 'errorFileNotExists';
    }
}
// Удаление кеша БД
elseif (!empty($_POST['deleteDBCache'])) {
    if (caching::dropCache()) {
        echo ajax::sdgJSONencode(array('success' => true));
    } else {
        echo ajax::sdgJSONencode(array('error' => true));
    }
}
// Удаление кеша шаблонов
elseif (!empty($_POST['deleteTmplCache'])) {
    if (caching::dropTmplCache()) {
        echo ajax::sdgJSONencode(array('success' => true));
    } else {
        echo ajax::sdgJSONencode(array('error' => true));
    }
// Сохранение .htaccess
} elseif (!empty($_POST['defaultHtaccess'])) {
    $def = '# Copyright © 2010 - 2015 SD-GROUP' . "\n";
    $def .= '# Website: http://sd-group.org.ua/' . "\n\n";
    $def .= '# Defaul Charset' . "\n";
    $def .= 'AddDefaultCharset UTF-8' . "\n\n";
    $def .= '# Set the default handler.' . "\n";
    $def .= 'DirectoryIndex index.php' . "\n\n";
    $def .= '# Security' . "\n";
    $def .= 'php_flag register_globals off' . "\n";
    $def .= '# Disable Magic Quotes' . "\n";
    $def .= 'php_flag magic_quotes_gpc off' . "\n\n";
    $def .= '# Mod_rewrite' . "\n";
    $def .= 'RewriteEngine On' . "\n";
    $def .= 'RewriteBase /' . "\n\n";
    $def .= '# CHPU' . "\n";
    $def .= 'RewriteCond %{REQUEST_FILENAME} !-f' . "\n";
    $def .= 'RewriteCond %{REQUEST_FILENAME} !-d' . "\n";
    $def .= 'RewriteCond %{REQUEST_URI} !^/index.php' . "\n";
    $def .= 'RewriteRule (.*) index.php' . "\n\n";

    echo $def;
}
/**
 * Работа с данными платежных модов
 */ elseif (!empty($_GET['mods']) && 'payments' == $_GET['mods'] && !empty($_GET['modId']) && !empty($_GET['do'])) {
    // Добавление пользовательских языковых констант в платежных модах
    if ('addConstLang_custom' == $_GET['do'] && !empty($_POST['nameConst'])
        && preg_match("/[A-Za-z0-9\-_]/", $_POST['nameConst']) && !empty($_POST['valueConst']) && !empty($_POST['currLocaliz'])) {

        $langFile = 'core/mods/payments/' . $_GET['modId'] . '/lang/' . $_POST['currLocaliz'] . '/lang._custom.php';

        $arrData = localiz::getConstForParsingFile($langFile);
        $nameConst = strtoupper($_GET['modId']) . '_CONST_CUSTOM_' . strtoupper($_POST['nameConst']);

        if (!isset($arrData[$nameConst])) {
            $arrData[$nameConst] = $_POST['valueConst'];
            $arrNewData = array();
            foreach ($arrData as $constName => &$constValue) {
                $arrNewData[] = "define('" . strtoupper($constName) . "', '" . ((!empty($constValue)) ? $constValue : strtoupper($constName)) . "');";
            }

            $data = "<?php\n\n"
                . "(!defined('SDG')) ? die ('Triple protection!') : null;\n\n"
                . implode("\n\n", $arrNewData) . "\n";

            echo (file_put_contents($langFile, $data)) ? 'success' : 'errConstAdding';
        } else {
            echo 'errConstLangCustomExsists';
        }
    }
    // Удаление пользовательских языковых констант в платежных модах
    elseif ('delConstLang_custom' == $_GET['do'] && !empty($_POST['nameConst']) && !empty($_POST['currLocaliz'])) {
        $langFile = 'core/mods/payments/' . $_GET['modId'] . '/lang/' . $_POST['currLocaliz'] . '/lang._custom.php';

        $arrData = localiz::getConstForParsingFile($langFile);

        if (isset($arrData[$_POST['nameConst']])) {
            unset($arrData[$_POST['nameConst']]);
            $arrNewData = array();
            foreach ($arrData as $constName => &$constValue) {
                $arrNewData[] = "define('" . strtoupper($constName) . "', '" . ((!empty($constValue)) ? $constValue : strtoupper($constName)) . "');";
            }

            $data = "<?php\n\n"
                . "(!defined('SDG')) ? die ('Triple protection!') : null;\n\n"
                . implode("\n\n", $arrNewData) . "\n";

            echo (file_put_contents($langFile, $data)) ? 'success' : 'errConstDeleting';
        } else {
            echo 'errConstLangCustomNoExsists';
        }
    } else {
        echo ajax::sdgJSONencode(array('error' => ERROR_FATAL_UNCORRECT_PARAMS));
    }
} else {
    echo 'Error AJAX-Query!';
}
