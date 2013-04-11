<?php

/**
  powered by Script Developers Group (SD-Group)
  email: info@sd-group.org.ua
  url: http://sd-group.org.ua/
  Copyright 2009 (c) SD-Group
  All rights reserved
  =======================================================
  Функции языкового менеджера
 */
(!defined('SDG')) ? die('Triple protection!') : null;

class localiz {
    /////////////////////////////////////////////////
    // VARS - свойства класса localiz
    /////////////////////////////////////////////////
    /////////////////////////////////////////////////
    // METHODS - методы класса localiz
    /////////////////////////////////////////////////

    /**
     * Функция формирует массив языковых файлов с именами констант в виде ключей их значений
     * В качестве эталона для формирования массива используется локализация по умолчанию: 'russian'
     * Возврашает массив языковых файлов и языковых констант в локализации по умолчанию.
     * Значения констант берутся в запрашиваемой локализациии, если они существуют. Иначе вместо значения устанавливается имя константы.
     *
     * @param (string) $localiz - запрашиваемая локализация (по умолчанию 'russian')
     *
     * @return (array) $arrConst - массив языковых файлов с именами констант в виде ключей их значений
     */
    static function getLocalizConst($localiz, $ownAdmin, $langDir = 'lang/') {
        $arrConst = array();
        $langDir = filesys::setPath($langDir);
        foreach (filesys::getFilesInDir($langDir . 'russian/') as $fileLocaliz) {
            if ((empty($ownAdmin) && 0 === strpos($fileLocaliz, 'adm.')) || (!empty($ownAdmin) && 0 !== strpos($fileLocaliz, 'adm.'))) {
                continue;
            }

            if ('russian' !== $localiz && file_exists($langDir . $localiz . '/' . $fileLocaliz)) {
                $currLocalizConst = self::getConstForParsingFile($langDir . $localiz . '/' . $fileLocaliz);
            }

            foreach (file($langDir . 'russian/' . $fileLocaliz) as $string) {
                if (false !== strpos($string, 'define(')) {
                    $arrExplode = explode(',', trim($string));
                    $constName = substr(array_shift($arrExplode), 8, -1);

                    if ('russian' !== $localiz) {
                        $arrConst[$fileLocaliz][$constName] = (isset($currLocalizConst[$constName])) ? $currLocalizConst[$constName] : $constName;
                    } else {
                        $arrConst[$fileLocaliz][$constName] = substr(implode(', ', $arrExplode), 2, -3);
                    }
                }
            }
        }

        return $arrConst;
    }

    /**
     * Функция парсит php-файл построчно на наличие кода определения констант
     * Возврашает массив констант виде ключей их значений
     *
     * @param (string) $fileName - имя файла
     *
     * @return (array) $arrConst - массив с именами констант в виде ключей их значений
     */
    static function getConstForParsingFile($fileName) {
        $arrConst = array();
        if (file_exists($fileName)) {
            foreach (file($fileName) as $string) {
                if (false !== strpos($string, 'define(')) {
                    $arrExplode = explode(',', trim($string));
                    $constName = substr(array_shift($arrExplode), 8, -1);
                    $arrConst[$constName] = substr(implode(', ', $arrExplode), 2, -3);
                }
            }
        }

        return $arrConst;
    }

    /////////////////////////////////////////////////
    // END OF CLASS localiz
    /////////////////////////////////////////////////
}
