<?php

/**
 * Powered by Script Developers Group (SD-Group)
 * Email: info@sd-group.org.ua
 * URL: http://sd-group.org.ua/
 * Copyright 2009 (c) SD-Group
 * All rights reserved
 * ===================================================
 * Функции роботизированного управления
 * ===================================================
 */
(!defined('SDG')) ? die('Triple protection!') : null;

class robot {

    /**
     * Функция запуска робота
     * 
     * @param (array) $arrConf - массив настроек робота
     * 
     * @return bool
     */
    static function start(&$arrConf) {
        $arrRobotData = filesys::getSerializedData('core/data/robot.mda');
        if (!empty($arrRobotData['clear_cache']) && is_array($arrRobotData['clear_cache'])) {
            foreach ($arrRobotData['clear_cache'] as $cacheKey => &$caheData) {
                (!empty($caheData) && $caheData < time()) ? caching::clearCache($cacheKey) : null;
            }
        }

        if (!empty($arrConf['configs']['robot_running']) && !empty($arrConf['configs']['robot_running_firsttime']) && $arrConf['configs']['robot_running_firsttime'] <= time()) {
            if ((!$arrRobotData = filesys::getSerializedData('core/data/robot.mda')) || !isset($arrRobotData['next_running']) || $arrRobotData['next_running'] <= time()) {
                control::actionsControl($arrConf['actions']);
                $arrRobotData['next_running'] = time() + $arrConf['configs']['robot_term'] * $arrConf['configs']['robot_term_coef'];

                return filesys::putSerializedData('core/data/robot.mda', $arrRobotData);
            } else {
                return true;
            }
        } else {
            return true;
        }
    }

    /**
     * Функция настройки робота для удаления файлов кеша
     * 
     * @param (array) $arrData - массив значений, содержащий список файлов кеша для удаления роботом
     * 
     * @return bool
     */
    static function putClearCacheData(&$arrData) {
        $arrRobotData = filesys::getSerializedData('core/data/robot.mda');
        $arrRobotData['clear_cache'] = $arrData;
        return filesys::putSerializedData('core/data/robot.mda', $arrRobotData);
    }

    /////////////////////////////////////////////////
    // END OF CLASS robot
    /////////////////////////////////////////////////
}
