<?php

/**
 * powered by Script Developers Group (SD-Group)
 * email: info@sd-group.org.ua
 * url: http://sd-group.org.ua/
 * Copyright 2009 (c) SD-Group
 * All rights reserved
 * ===================================================
 * Класс безопастности и обработки данных
 */
(!defined('SDG')) ? die('Triple protection!') : null;

/**
 * Класс обработки данных
 */
class secure {

    /////////////////////////////////////////////////
    // VARS - свойства класса secure
    /////////////////////////////////////////////////

    static $link_id;
    static $arrPatternDef = array(
        "/(<|&lt;|&#060;|%3C)(script|frame|iframe|form)(.*?)(\/script|\/frame|\/iframe|\/form)(>|&gt;|&#062;|%3E)/ims",
        "/(onload|onunload|onblur|onchange|onfocus|onreset|onselect|onsubmit|onabort|onkeydown|onkeypress|onkeyup|onclick|ondblclick|onmousedown|onmousemove|onmouseout|onmouseover|onmouseup)(\s*)=(\s*)/ims",
        "/(javascript|return)/ims"
    );

    /////////////////////////////////////////////////
    // METHODS - методы класса secure
    /////////////////////////////////////////////////

    /**
     * функция экранирует символы в строках параметров передаваемых в запрос
     * закавычивает строки
     *
     * @access static
     * @param array массив данных со строками параметров для запроса
     * @return array
     */
    static function escQuoteData($queryData) {
        if (is_array($queryData)) {
            foreach ($queryData as $key => $value) {
                $queryData[$key] = self::escQuoteData($value);
            }

            return $queryData;
        }

        $queryData = trim($queryData, "'");
        // Перед проверкой ресурса соединения с БД, необходимо инициировать данное соединение, иначе там всегда null
        if (function_exists('mysql_real_escape_string') && db::_init() && is_resource(self::$link_id)) {
            $result = mysql_real_escape_string($queryData, self::$link_id);
        } elseif (function_exists('mysql_escape_string')) {
            $result = mysql_escape_string($queryData);
        } else {
            $result = addslashes($queryData);
        }

        return "'$result'";
    }

    /**
     * Очистка данных получаемых из вне PHP
     * Функция очищает глобалы $_GET, $_POST, $_COOKIE [, $_REQUEST]
     *
     * @param bool $allGlobals - если в параметре передано значение true будет проводится очистка глобалов включая $_REQUEST
     */
    static function clearRequestData($allGlobals = false) {
        // очищаем $_REQUEST - если передан параметр $allGlobals = true
        if (!empty($allGlobals)) {
            self::clearData($_REQUEST);
        }
        // очищаем $_GET
        self::clearData($_GET);
        // очищаем $_POST
        self::clearData($_POST);
        // очищаем $_COOKIE
        self::clearData($_COOKIE);
    }

    /**
     * Очистка URL
     */
    static function cleanURL($url) {
        $result = '';

        if (!empty($url)) {
            $url = str_replace('http://', '', $url);

            if (strtolower(substr($url, 0, 4)) === 'www.') {
                $url = substr($url, 4);
            }

            //$result = reset(explode(':', reset(explode('/', $url))));
            $result = reset(explode('/', $url));
        }

        return $result;
    }

    /**
     * Проверка сервера вызывающего скрипт
     */
    static function checkServerCalls() {
        return (isset($_SERVER['HTTP_REFERER']) && self::cleanURL($_SERVER['HTTP_REFERER']) === self::cleanURL($_SERVER['HTTP_HOST'])) ? true : false;
    }

    /**
     * Кодирование и шифрование строки
     */
    static function strSecureEncode($string) {
        return str_rot13(base64_encode(str_rot13(base64_encode(str_rot13($string)))));
    }

    /**
     * Декодирование и дешифрование строки - обратное secure::strSecureEncode()
     */
    static function strSecureDecode($string) {
        return str_rot13(base64_decode(str_rot13(base64_decode(str_rot13($string)))));
    }

    /**
     * Очистка данных
     */
    static function clearData(&$data, &$pattern = false) {
        (empty($pattern)) ? $pattern = &self::$arrPatternDef : null;

        if (is_array($data)) {
            foreach ($data as $key => &$value) {
                (is_array($value)) ? self::clearData($value, $pattern) : $data[$key] = preg_replace($pattern, '', trim($value));
            }
        } else {
            $data = (!CONF_USE_VISUAL_EDITOR) ? strip_tags(preg_replace($pattern, '', trim($data))) : preg_replace($pattern, '', trim($data));
        }

        $data = str_replace(chr(0), '', $data);
    }

    /////////////////////////////////////////////////
    // END OF CLASS secure
    /////////////////////////////////////////////////
}
