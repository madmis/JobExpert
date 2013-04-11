<?php

/**
 * Powered by Script Developers Group (SD-Group)
 * Email: info@sd-group.org.ua
 * URL: http://sd-group.org.ua/
 * Copyright 2009 (c) SD-Group
 * All rights reserved
 * ===================================================
 * Файл работы с API скрипта запросы - AJAX/XML
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
 * API скрипта
 */
// массив содержащий результат
$arrResult = array();
// ключ для узла <root></root> - в XML
$root = 'root';

// запуск API - проверка параметров
if (!empty($_GET['action'])) {
    // массив с доступными действиями API
    $arrActions = array(
        'getLast' => false
    );
    // активируем доступное действие
    (isset($arrActions[$_GET['action']])) ? $arrActions[$_GET['action']] = true : null;
    /**
     * Обработка доступных действий
     */
    // получение последних записей из БД
    if (!empty($arrActions['getLast']) && !empty($_GET['type'])) {
        // массив доступных объектов для получения последних записей
        $arrTypes = array(
            'resume' => false,
            'vacancy' => false
        );
        // активируем доступный объект
        (isset($arrTypes[$_GET['type']])) ? $arrTypes[$_GET['type']] = true : null;

        /**
         * Обработка доступных объектов
         */
        // Работа с Резюме/Вакансиями
        if (!empty($arrTypes['resume']) || !empty($arrTypes['vacancy'])) {
            // Переопределяем ключ для узла <root></root> - в XML
            $root = $_GET['action'] . ucfirst($_GET['type'] . 's');
            // Определяем параметр LIMIT
            $arrParams['limit'] = (!empty($_GET['limit']) && strings::ifInt($_GET['limit'])) ? $_GET['limit'] : false;
            // Объявляем объект
            $objAnnounce = new $_GET['type']();
            // Выполняем запрос
            $returnData = $objAnnounce->getApiLastAnnounces($arrParams);
            // формируем результат
            $result = (!empty($returnData)) ? 'success' : 'empty';
            $arrResult = array(
                'result' => $result,
                'data' => &$returnData
            );
        } else {
            // ошибка параметров запроса к API
            $arrResult = array(
                'result' => 'error',
                'error' => 'Error params AJAX-Query API'
            );
        }
    } else {
        // ошибка действия запроса к API
        $arrResult = array(
            'result' => 'error',
            'error' => 'Error action AJAX-Query API'
        );
    }
} else {
    // ошибка запроса к API
    $arrResult = array(
        'result' => 'error',
        'error' => 'Error AJAX-Query API'
    );
}

/**
 * Вывод результата в виде XML
 */
header('Content-type: text/xml');
echo api::getXml($arrResult, $root);
