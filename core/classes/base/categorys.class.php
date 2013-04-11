<?php

/**
 * Powered by Script Developers Group (SD-Group)
 * Email: info@sd-group.org.ua
 * URL: http://sd-group.org.ua/
 * Copyright 2010-2015 (c) SD-Group
 * All rights reserved
 * ======================================================
 * Базовый класс работы с категориями/разделами
 * ======================================================
 *
 * @package
 *
 * @todo
 *
 */
(!defined('SDG')) ? die('Triple protection!') : null;

/**
 * Базовый класс работы с категориями/разделами
 */
abstract class categorys extends tbentrys {

    /////////////////////////////////////////////////
    // VARS - свойства класса categorys
    /////////////////////////////////////////////////

    /**
     * $relatedTable - свойство для хранения имени связанной таблицы
     * поумолчанию false
     *
     * @var string [default: bool false]
     */
    private $relatedTable;

    /**
     * $arrServiceFields - свойство для хранения массива сервисных полей в таблицах БД
     * Массив иницирован наименованиями служебных полей таблицы
     *
     * @var array
     */
    private $arrServiceFields = array(
        'token' => ''
    );

    /**
     * $arrOrderBy - свойство для хранения массива порядка сортировки результатов запроса к таблицам БД
     *
     * @var array
     */
    private $arrOrderBy;

    /////////////////////////////////////////////////
    // CONSTRUCTOR - конструктор класса sections
    /////////////////////////////////////////////////

    /**
     * конструктор
     *
     * Инициирует свойство $arrOrderBy
     *
     */
    protected function __construct($arrOrderBy, $relatedTable = false) {

        // инициируем масив сортировки данных
        $this->arrOrderBy = $arrOrderBy;

        // инициируем имя родительской таблицы
        $this->relatedTable = $relatedTable;

		$arrCacheFiles = array();
		$currTable = $this->retTableName();

		// массив (список) файлов кешируемых данных
		if (!empty($currTable)) {
			$arrCacheFiles[] = 'caching/' . $currTable . '.cache';
		}

		if (!empty($this->relatedTable)) {
			$arrCacheFiles[] = 'caching/' . $this->relatedTable . '.cache';
		}

		// формируем массив параметров для вызова конструктора родительского класса
        $arrParams = array(
            'arrCacheFiles' => &$arrCacheFiles,
            'tIdForce' => true
        );

        // вызываем конструктор родительского класса
        parent::__construct($arrParams);
    }

    /////////////////////////////////////////////////
    // METHODS - методы класса categorys
    /////////////////////////////////////////////////

    /**
     * protected функция считывает данные из таблицы БД
     *
     * @return bool
     */
    protected function getCategorys() {
        if (CONF_ENABLE_CACHING) {
            if ($this->getCachingEntrys()) {
                return true;
            } elseif ($this->getCategorysData()) {
                return $this->setCachingEntrys();
            } else {
                return false;
            }
        } else {
            return $this->getCategorysData();
        }
    }

    /**
     * protected функция формирует и возвращает данные хранимые в таблице
     *
     * @return array or false
     */
    protected function retCategorys($arrWhereFieldsVals, $arrFields = false) {
        $arrData = $this->retData();
        if (!empty($arrData) && is_array($arrData)) {
            if (is_array($arrWhereFieldsVals)) {
                foreach ($arrData as $key => &$data) {
                    foreach ($arrWhereFieldsVals as $field => $arrVals) {
                        if (!isset($data[$field]) || !in_array($data[$field], $arrVals)) {
                            unset($arrData[$key], $data);
                            break;
                        }
                    }
                }
            }

            if (is_array($arrFields)) {
                $arrFields = array_flip($arrFields);
                foreach ($arrData as $key => &$data) {
                    $arrData[$key] = array_intersect_key($arrData[$key], $arrFields);
                }
            }

            return $arrData;
        } else {
            return false;
        }
    }

    /**
     * protected функция производит запись данных в таблицу БД
     *
     * @param array $arrBindFields - массив обязательных полей
     * @param array $arrNoBindFields - массив не обязательных полей
     * @param string $token - токен для записи
     *
     * @return bool
     */
    protected function recCategory($arrBindFields, $arrNoBindFields, $token) {
        $this->arrServiceFields['token'] = $token;

        return (!$this->setCategorySubj($arrBindFields, $arrNoBindFields) || !$this->addEntry()) ? false : $this->getLine_id();
    }

    /**
     * protected функция производит удаление данных из таблицы БД
     *
     * @param (string) $strWhere - выражение для оператора WHERE (необязательный параметр)
     *
     * @return bool
     */
    protected function delCategorys(&$strWhere = false) {
        return $this->delEntrys($strWhere);
    }

    /**
     * protected функция выполняет действия над группой строк в таблице БД
     *
     * @param string $action
     * @param array $arrFields
     *
     * @return bool
     */
    protected function actionCategorys($action, $arrFields, $silentMode = false) {
        switch ($action) {
            case 'edit':
                foreach ($arrFields as $key => $value) {
                    $arrData = (isset($value['arrNoBindFields'])) ? $value['arrBindFields'] + $value['arrNoBindFields'] : $value['arrBindFields'];
                    $result = $this->editEntrys(secure::escQuoteData($arrData), "id IN (" . secure::escQuoteData($key) . ")");
                }
                break;

            case 'sort':
                foreach ($arrFields as $key => $value) {
                    $arrSort[$value][] = $key;
                }

                foreach ($arrSort as $key => $value) {
                    $result = $this->editEntrys(array('sort' => "'$key'"), "id IN (" . implode(',', secure::escQuoteData($value)) . ")");
                }

                break;

            case 'del':
                $table = $this->retTableName();

                $strFields = implode(',', secure::escQuoteData($arrFields));

                $vacancy = new vacancy();
                $result = $vacancy->delAnnounces('id_' . $table . ' IN (' . $strFields . ')');

                $resume = new resume();
                $result = $resume->delAnnounces('id_' . $table . ' IN (' . $strFields . ')');

                $subscription = new subscription();
                $strWhere = ('profession' !== $table) ? 'id_' . $table . ' IN (' . $strFields . ')' : 'id_' . $table . ' IN (' . $strFields . ') OR id_' . $table . '_1 IN (' . $strFields . ') OR id_' . $table . '_2 IN (' . $strFields . ')';
                $result = $subscription->delSubscriptions($strWhere);

                $result = $this->delCategorys('id IN (' . $strFields . ')');

                break;

            case 'setcapital':
                $result = $this->editEntrys(array('capital' => "'on'"), "id IN (" . implode(',', secure::escQuoteData($arrFields)) . ") AND capital IN ('0')");
                break;

            case 'resetcapital':
                $result = $this->editEntrys(array('capital' => "'0'"), "parent_id IN (" . implode(',', secure::escQuoteData($arrFields)) . ") AND capital IN ('on')");
                break;

            case 'setRegionMajor':
                $result = $this->editEntrys(array('major' => "'on'"), "id IN (" . implode(',', secure::escQuoteData($arrFields)) . ") AND major IN ('0')");
                break;

            case 'resetRegionMajor':
                $result = $this->editEntrys(array('major' => "'0'"), "id IN (" . implode(',', secure::escQuoteData($arrFields)) . ") AND major IN ('on')");
                break;

            case 'setAddCityAllowed':
                $result = $this->editEntrys(array('add_city_allowed' => "'on'"), "id IN (" . implode(',', secure::escQuoteData($arrFields)) . ") AND add_city_allowed IN ('0')");
                break;

            case 'resetAddCityAllowed':
                $result = $this->editEntrys(array('add_city_allowed' => "'0'"), "id IN (" . implode(',', secure::escQuoteData($arrFields)) . ") AND add_city_allowed IN ('on')");
                break;

            default:
                if ($silentMode) {
                    $result = false;
                } else {
                    messages::messageChangeSaved(MESSAGE_WARNING_UNKNOWN_ACTION, false, CONF_ADMIN_FILE);
                }
        }

        return $result;
    }

    /**
     * private функция передает значения полей полученных из формы в свойсво базового класса, для последующей записи в таблицу БД
     *
     * @return bool
     */
    private function setCategorySubj($arrBindFields, $arrNoBindFields) {
        return $this->fillTableFieldsValue($this->arrServiceFields + $arrBindFields + $arrNoBindFields);
    }

    /**
     * private функция считывает данные из таблицы БД
     * добавляет счетчики в данные результата запроса
     *
     * @return bool
     */
    private function getCategorysData() {
        if ($this->getEntrys("token IN ('active')", $this->arrOrderBy, false, false) && $arrData = $this->retData()) {
            $arrOrder = false;
            $currTable = $this->retTableName();

            if (!empty($this->arrOrderBy)) {
                foreach ($this->arrOrderBy as $key => & $val) {
                    $arrOrder[$currTable . '.' . $key] = $val;
                }
            }

            $cnt_vacancy = ($this->getSubSelectEntrys($arrOrder, true, $this->retCntVacancys())) ? $this->retData() : null;

            $cnt_resume_v = $cnt_resume_m = array();
            switch ($currTable) {
                case 'profession':
                    if ($this->getSubSelectEntrys($arrOrder, true, $this->retCntResumesV(1))) {
                        $cnt_resume_v += $this->retData();
                    }

                    if ($this->getSubSelectEntrys($arrOrder, true, $this->retCntResumesV(2))) {
                        $cnt_resume_v += $this->retData();
                    }

                    if ($this->getSubSelectEntrys($arrOrder, true, $this->retCntResumesM(1))) {
                        $cnt_resume_m += $this->retData();
                    }

                    if ($this->getSubSelectEntrys($arrOrder, true, $this->retCntResumesM(2))) {
                        $cnt_resume_m += $this->retData();
                    }
                default:
                    if ($this->getSubSelectEntrys($arrOrder, true, $this->retCntResumesV())) {
                        $cnt_resume_v += $this->retData();
                    }

                    if ($this->getSubSelectEntrys($arrOrder, true, $this->retCntResumesM())) {
                        $cnt_resume_m += $this->retData();
                    }
                    break;
            }

            foreach ($arrData as $id => &$arrValues) {
                (!empty($cnt_vacancy[$id])) ? $arrValues += $cnt_vacancy[$id] : $arrValues['cnt_vacancy'] = 0;
                (!empty($cnt_resume_v[$id])) ? $arrValues += $cnt_resume_v[$id] : $arrValues['cnt_resume_v'] = 0;
                (!empty($cnt_resume_m[$id])) ? $arrValues += $cnt_resume_m[$id] : $arrValues['cnt_resume_m'] = 0;
            }

            $this->setData($arrData);

            return true;
        } else {
            return false;
        }
    }

    /**
     * private функция возвращает массив параметров запроса для формирования данных счетчика Вакансий
     *
     * @return (array) - массив массив параметров запроса
     */
    private function retCntVacancys() {
        $currTable = $this->retTableName();

        $arrConf['tableFields'][] = array($currTable, 'id');

        $arrConf['extTableFields'][] = array('COUNT(*)', 'cnt_vacancy');

        $arrConf['leftJoins'][] = array(
            'table' => array('job_vacancy', 'vacancy'),
            'on' => "vacancy.id_$currTable IN ($currTable.id)"
        );

        $arrConf['strWhere'] = "$currTable.token IN ('active') AND vacancy.token IN('active')";

        return $arrConf;
    }

    /**
     * private функция возвращает массив параметров запроса для формирования данных счетчика Резюме (видимы всем)
     *
     * @return (array) - массив массив параметров запроса
     */
    private function retCntResumesV($mark = '') {
        if (!empty($mark)) {
            $mark = '_' . $mark;
        }

        $currTable = $this->retTableName();

        $arrConf['tableFields'][] = array($currTable, 'id');

        $arrConf['extTableFields'][] = array('COUNT(*)', 'cnt_resume_v');

        switch ($currTable) {
            case 'profession':
                $strOnResume_v = "resume_v.id_profession$mark IN (profession.id)";
                break;
            default:
                $strOnResume_v = "resume_v.id_$currTable IN ($currTable.id)";
                break;
        }

        $arrConf['leftJoins'][] = array(
            'table' => array('job_resume', 'resume_v'),
            'on' => $strOnResume_v
        );

        $arrConf['strWhere'] = "$currTable.token IN ('active') AND resume_v.token IN ('active') AND resume_v.visibility IN ('visible','visiblehc')";

        return $arrConf;
    }

    /**
     * private функция возвращает массив параметров запроса для формирования данных счетчика Резюме (видимы пользователям)
     *
     * @return (array) - массив массив параметров запроса
     */
    private function retCntResumesM($mark = '') {
        if (!empty($mark)) {
            $mark = '_' . $mark;
        }

        $currTable = $this->retTableName();

        $arrConf['tableFields'][] = array($currTable, 'id');

        $arrConf['extTableFields'][] = array('COUNT(*)', 'cnt_resume_m');

        switch ($currTable) {
            case 'profession':
                $strOnResume_m = "resume_m.id_profession$mark IN (profession.id)";
                break;
            default:
                $strOnResume_m = "resume_m.id_$currTable IN ($currTable.id)";
                break;
        }

        $arrConf['leftJoins'][] = array(
            'table' => array('job_resume', 'resume_m'),
            'on' => $strOnResume_m
        );

        $arrConf['strWhere'] = "$currTable.token IN ('active') AND resume_m.token IN ('active') AND resume_m.visibility IN ('visible','visiblehc','members','membershc')";

        return $arrConf;
    }

    /////////////////////////////////////////////////
    // END OF CLASS categorys
    /////////////////////////////////////////////////

}
