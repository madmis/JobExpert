<?php

/**
 * Powered by Script Developers Group (SD-Group)
 * Email: info@sd-group.org.ua
 * URL: http://sd-group.org.ua/
 * Copyright 2009 (c) SD-Group
 * All rights reserved
 * ===================================================
 * Класс проверки данных - валидация
 * ===================================================
 */
(!defined('SDG')) ? die('Triple protection!') : null;

/**
 * Класс проверки данных - валидация
 *
 */
class validate {

    /**
     * функция проверяет данные в массиве $_POST
     * возвращает false, если в массиве есть пустые значения
     * в противном случае возвращает true
     *
     * @return bool
     */
    static function postDataNotEmpty() {
        foreach ($_POST as &$value) {
            if (empty($value)) {
                return false;
            }
        }

        return true;
    }

    /**
     * функция проверяет данные в переданном массиве
     * возвращает false, если в массиве есть пустые значения
     * в противном случае возвращает true
     *
     * @param (array) $arrData
     *
     * @return bool
     */
    static function arrDataNotEmpty($arrData) {
        foreach ($arrData as $value) {
            if (is_array($value)) {
                self::arrDataNotEmpty($value);
            } else {
                if (empty($value)) {
                    return false;
                }
            }
        }

        return true;
    }

    /**
     * функция проверяет строку на валидность e-mail адресу
     *
     * @param (string) $email
     *
     * @return bool
     *
     * if (preg_match("/[^a-z,A-Z,0-9,а-яёіїєґ,А-ЯЁІЇЄҐ,\-,\_]/", $user_name))
     */
    static function validateEmail($email) {
        $idna = new idna_convert();
        return preg_match('/^(?:[\w\!\#\$\%\&\'\*\+\-\/\=\?\^\`\{\|\}\~]+\.)*[\w\!\#\$\%\&\'\*\+\-\/\=\?\^\`\{\|\}\~]+@(?:(?:(?:[a-zA-Z0-9_](?:[a-zA-Z0-9_\-](?!\.)){0,61}[a-zA-Z0-9_-]?\.)+[a-zA-Z0-9_](?:[a-zA-Z0-9_\-](?!$)){0,61}[a-zA-Z0-9_]?)|(?:\[(?:(?:[01]?\d{1,2}|2[0-4]\d|25[0-5])\.){3}(?:[01]?\d{1,2}|2[0-4]\d|25[0-5])\]))$/', $idna->encode($email));
    }

    /**
     * функция проверяет строку на валидность даты в формате MySql
     *
     * @param (string) $date
     *
     * @return bool
     */
    static function validateMySqlDate($date) {
        return (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $date)) ? false : true;
    }

    /**
     * функция проверяет строку на валидность телефонному номеру
     *
     * @param (string) $phone
     *
     * @return bool
     */
    static function validatePhone($phone) {
        return (!preg_match('/\+?[0-9\s\-\(\)]+\d$/', $phone)) ? false : true;
    }

    /**
     * функция проверяет строку на валидность IP-адресам
     *
     * @param (string) $ip
     *
     * @return bool
     */
    static function validateIp($ip) {
		if (function_exists('filter_var')) {
			return filter_var($ip, FILTER_VALIDATE_IP);
		} else {
			return preg_match('/[1-2]?[0-5]?[0-5]\.[1-2]?[0-5]?[0-5]\.[1-2]?[0-5­]?[0-5]\.[1-2]?[0-5]?[0-5]/', $ip);
		}

    }

    /**
     * функция проверяет строку на валидность типу float
     *
     * @param (float) $amount
     *
     * @return bool
     */
    static function validateAmount($amount) {
        return (!preg_match('/^\d+[\.]?\d+$/', $amount)) ? false : true;
    }

    /**
     * Фукнция проверяет, является ли число целым и больше нуля
     *
     * @param (int) $number
     *
     * @return int or false (переданное число или false)
     */
    static function checkNaturalNumber($number) {
        $number = (int) $number;
        return (!empty($number) && $number > 0) ? $number : false;
    }

    /////////////////////////////////////////////////
    // END OF CLASS validate
    /////////////////////////////////////////////////
}
