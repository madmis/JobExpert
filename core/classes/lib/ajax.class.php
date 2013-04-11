<?php

/**
 * Powered by Script Developers Group (SD-Group)
 * Email: info@sd-group.org.ua
 * URL: http://sd-group.org.ua/
 * Copyright 2009 (c) SD-Group
 * All rights reserved
 * ===================================================
 * Класс AJAX
 * ===================================================
 */
(!defined('SDG')) ? die('Triple protection!') : null;

/**
 * Класс AJAX
 */
class ajax extends bAjax {

    /////////////////////////////////////////////////
    // METHODS - методы класса ajax
    /////////////////////////////////////////////////
    static function getProfessions($parent_id) {
        $profession = new professions();

        return self::sdgJSONencode($profession->retCategorysByParentIds($parent_id, array('id', 'name')));
    }

    static function getCitys($parent_id) {
        $city = new citys();

        //return self::sdgJSONencode($city->retCategorysByParentIds($parent_id, array('id', 'name')));
        return $city->retCategorysByParentIds($parent_id, array('id', 'name'));
    }

    /////////////////////////////////////////////////
    // END OF CLASS ajax
    /////////////////////////////////////////////////
}
