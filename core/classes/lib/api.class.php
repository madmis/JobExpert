<?php

/**
 * Powered by Script Developers Group (SD-Group)
 * Email: info@sd-group.org.ua
 * URL: http://sd-group.org.ua/
 * Copyright 2010-2015 (c) SD-Group
 * All rights reserved
 * ===================================================
 * Статический класс работы с API скрипта
 * ===================================================

 * @package
 * 
 * @todo
 * 
 */
(!defined('SDG')) ? die('Triple protection!') : null;

/**
 * Класс API
 */
class api {

    static function getXml($arrData = false, $root = 'root') {
        $xml = '<?xml version="1.0" encoding="UTF-8"?><' . $root . '></' . $root . '>';
        if (is_array($arrData) && !empty($arrData)) {
            $objXml = simplexml_load_string($xml);
            self::parseMultiArrayToXml($objXml, $arrData);
            $xml = strings::htmlDecode($objXml->asXML());
        }

        return $xml;
    }

    static function parseMultiArrayToXml(&$objXml, $arrData, $parent = false) {
        $count = count($arrData);
        foreach ($arrData as $name => &$value) {
            --$count;
            if (is_array($value) && !empty($value)) {
                if (!is_numeric($name)) {
                    $parent = array('pName' => $name, 'pObject' => &$objXml);
                    self::parseMultiArrayToXml($objXml->addChild($name), $value, $parent);
                } elseif (empty($parent)) {
                    continue;
                } else {
                    self::parseMultiArrayToXml($objXml, $value, $parent);
                    if (0 < $count) {
                        $objXml = $parent['pObject']->addChild($parent['pName']);
                    }
                }
            } else {
                $objXml->addChild($name, '<![CDATA[' . $value . ']]>');
            }
        }
    }
}
