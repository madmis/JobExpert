<?php

/**
 * Powered by Script Developers Group (SD-Group)
 * Email: info@sd-group.org.ua
 * URL: http://sd-group.org.ua/
 * Copyright 2009 (c) SD-Group
 * All rights reserved
 * ===================================================
 * Класс работы с Городами
 * ===================================================
 */
(!defined('SDG')) ? die('Triple protection!') : null;

/**
 * Класс работы с Городами
 */
class citys extends categorys {
    /////////////////////////////////////////////////
    // VARS - свойства класса citys
    /////////////////////////////////////////////////

    /**
     * Массив для хранения наименований и значений полей для записи в таблицу БД
     * В этом массиве хранятся поля обязательные для заполнения
     *
     * @var array
     */
    public $arrBindFields = array(
        'parent_id' => '',
        'name' => ''
    );

    /**
     * Массив для хранения наименований и значений полей для записи в таблицу БД
     * В этом массиве хранятся поля не обязательные для заполнения
     *
     * @var array
     */
    public $arrNoBindFields = array(
        'capital' => '',
        'title' => '',
        'meta_keywords' => '',
        'meta_description' => ''
    );

    /////////////////////////////////////////////////
    // CONSTRUCTOR - конструктор класса citys
    /////////////////////////////////////////////////

    /**
     * конструктор
     *
     */
    public function __construct() {
        $this->setTable('city', USR_PREFIX);

        $arrOrderBy = array(
            'parent_id' => 'ASC',
            'capital' => 'ASC',
            'name' => 'ASC',
            'id' => 'ASC'
        );

        parent::__construct($arrOrderBy, 'region');

        $this->getCategorys();
    }

    /////////////////////////////////////////////////
    // METHODS - методы класса citys
    /////////////////////////////////////////////////

    /**
     * public функция возвращает массив полей обязательных для заполнения
     *
     * return array $arrBindFields
     */
    public function getBindFields() {
        return $this->arrBindFields;
    }

    /**
     * public функция возвращает массив полей не обязательных для заполнения
     *
     * return array $arrNoBindFields
     */
    public function getNoBindFields() {
        return $this->arrNoBindFields;
    }

    /**
     * public функция возвращает массив данных
     *
     * return array
     */
    public function retCategorysByIds($arrIds) {
        (!is_array($arrIds)) ? $arrIds = array($arrIds) : null;

        return $this->retCategorys(array('id' => $arrIds));
    }

    /**
     * public функция возвращает массив данных
     *
     * return array
     */
    public function retCategorysByParentIds($arrParentIds, $arrFields = false) {
        (!is_array($arrParentIds)) ? $arrParentIds = array($arrParentIds) : null;

        return $this->retCategorys(array('parent_id' => $arrParentIds), $arrFields);
    }

    /**
     * public функция выполняет действия над группой регионов
     *
     * @param string $action
     * @param array $arrFields
     *
     * @return bool
     */
    public function actionCitys($action, $arrFields, $parent_id, $silentMode = false) {
        $action = (string) $action;
        $arrFields = (array) $arrFields;
        $parent_id = (integer) $parent_id;
        $silentMode = (boolean) $silentMode;

        if ('edit' === $action || 'setcapital' === $action || 'resetcapital' === $action || 'del' === $action) {
            if ('edit' === $action && isset($arrFields['capital_city'])) {
                $this->actionCategorys('resetcapital', array($parent_id));
                $this->actionCategorys('setcapital', array($arrFields['capital_city']));
                unset($arrFields['capital_city']);
            }

            ('setcapital' === $action) ? $this->actionCategorys('resetcapital', array($parent_id)) : null;

            if (!$this->actionCategorys($action, $arrFields)) {
                if ($silentMode) {
                    return false;
                } else {
                    messages::messageChangeSaved(ERROR_NOT_SAVE_CHANGE, false, CONF_ADMIN_FILE . '?m=dictionary&amp;s=regions&amp;action=citys&amp;pid=' . $parent_id);
                }
            } else {
                if ($silentMode) {
                    return true;
                } else {
                    messages::messageChangeSaved(MESSAGE_CHANGE_SAVED, false, CONF_ADMIN_FILE . '?m=dictionary&amp;s=regions&amp;action=citys&amp;pid=' . $parent_id);
                }
            }
        } else if ($silentMode) {
            messages::messageChangeSaved(MESSAGE_WARNING_UNKNOWN_ACTION, false, CONF_ADMIN_FILE . '?m=dictionary&amp;s=regions&amp;action=citys&amp;pid=' . $parent_id);
        } else {
            return false;
        }
    }

    /**
     * Проверка существования города по названию.
     * @param type $name название города
     * @param type $cat_id id-категории, в которой выполнять поиск
     */
    public function issetCityByName($name, $cat_id = 0) {
        $where = "name=" . secure::escQuoteData(strtolower($name));
        if ($cat_id > 0) {
            $where .= " AND parent_id=" . secure::escQuoteData($cat_id);
        }
        $ret = $this->issetRow($where);
        return $ret;
    }

    /**
     * Перегрузка методов родительских классов
     */
    public function getCategorys() {
        return parent::getCategorys();
    }

    public function retCategorys($arrWhereFieldsVals = false, $arrFields = false) {
        return parent::retCategorys($arrWhereFieldsVals, $arrFields);
    }

    public function recCategory($token = 'active') {
        ('on' === $this->arrNoBindFields['capital']) ? $this->actionCategorys('resetcapital', array($this->arrBindFields['parent_id'])) : null;

        return parent::recCategory($this->arrBindFields, $this->arrNoBindFields, $token);
    }

    public function delCategorys($strWhere) {
        return parent::delCategorys($strWhere);
    }

    /////////////////////////////////////////////////
    // END OF CLASS citys
    /////////////////////////////////////////////////
}
