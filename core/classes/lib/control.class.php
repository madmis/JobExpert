<?php

/**
 * Powered by Script Developers Group (SD-Group)
 * Email: info@sd-group.org.ua
 * URL: http://sd-group.org.ua/
 * Copyright 2009 (c) SD-Group
 * All rights reserved
 * ===================================================
 * Класс функций управления данными хранимыми в БД
 * ===================================================
 */
(!defined('SDG')) ? die('Triple protection!') : null;

/**
 * Класс функций управления данными хранимыми в БД
 */
class control {

    /////////////////////////////////////////////////
    // METHODS - методы класса control
    /////////////////////////////////////////////////

    static function actionsControl(&$arrActions) {
        $user = new user();
        $subscription = new subscription();
        $vacancy = new vacancy();
        $resume = new resume();

		foreach ($arrActions as $action => $type) {
            switch ($action) {
                case 'updateCounters':
					$result = caching::dropCache();
                    break;

				case 'delNonverifyUsers':
                    $uData = $user->getCombinedUsersData(array(array('users', 'id')), "users.token IN ('new') AND users.token_datetime < NOW()", false, false);
                    if (!empty($uData) && is_array($uData)) {
	                    foreach ($uData as $data) {
	                        $arrId[] = $data['id'];
	                    }
					}
                   	$result = (!empty($arrId)) ? $user->deleteUsers($arrId, false, false, false, false, false) : true;
                    break;

                case 'delNontypeUsers':
                	$uData = $user->getCombinedUsersData(array(array('users', 'id')), "conf_users.token IN ('new') AND users.token IN ('active') AND users.token_datetime < NOW()", false, false);
                    if (!empty($uData) && is_array($uData)) {
	                    foreach ($uData as $data) {
	                        $arrId[] = $data['id'];
	                    }
					}
                    $result = (!empty($arrId)) ? $user->deleteUsers($arrId, false, false, false, false, false) : true;
                    break;

                case 'delUnpaidUsers':
                    $uData = $user->getCombinedUsersData(array(array('users', 'id')), "conf_users.token IN ('payment') AND users.token_datetime < NOW()", false, false);
                    if (!empty($uData) && is_array($uData)) {
	                    foreach ($uData as $data) {
	                        $arrId[] = $data['id'];
	                    }
					}
                    $result = (!empty($arrId)) ? $user->deleteUsers($arrId, false, false, false, false, false) : true;
                    break;

                case 'delUnpaidSubscr':
                    $result = $subscription->delSubscriptions("token IN ('payment') AND token_datetime < NOW()");
                    break;

                case 'vacDelNonverify':
                    $result = $vacancy->delAnnounces("token IN ('new') AND token_datetime < NOW()");
                    break;

                case 'resDelNonverify':
                    $result = $resume->delAnnounces("token IN ('new') AND token_datetime < NOW()");
                    break;

                case 'vacDelUnpaid':
                    $result = $vacancy->delAnnounces("token IN ('payment') AND token_datetime < NOW()");
                    break;

                case 'resDelUnpaid':
                    $result = $resume->delAnnounces("token IN ('payment') AND token_datetime < NOW()");
                    break;

                case 'vacVipResetSlo':
                    $result = $vacancy->controlAnnounces("vip AND token IN ('active') AND vip_unset_datetime NOT IN ('0000-00-00 00:00:00') AND vip_unset_datetime < NOW()", 'vip');
                    break;

                case 'resVipResetSlo':
                    $result = $resume->controlAnnounces("vip AND token IN ('active') AND vip_unset_datetime NOT IN ('0000-00-00 00:00:00') AND vip_unset_datetime < NOW()", 'vip');
                    break;

                case 'vacHotResetSlo':
                    $result = $vacancy->controlAnnounces("hot AND token IN ('active') AND hot_unset_datetime NOT IN ('0000-00-00 00:00:00') AND hot_unset_datetime < NOW()", 'hot');
                    break;

                case 'resHotResetSlo':
                    $result = $resume->controlAnnounces("hot AND token IN ('active') AND hot_unset_datetime NOT IN ('0000-00-00 00:00:00') AND hot_unset_datetime < NOW()", 'hot');
                    break;

                case 'vacActionSlo':
                    $result = $vacancy->controlAnnounces("token IN ('active') AND token_datetime < NOW()", $type);
                    break;

                case 'resActionSlo':
                    $result = $resume->controlAnnounces("token IN ('active') AND token_datetime < NOW()", $type);
                    break;

                default:
                    $result = true;
                    break;
            }

            if (!$result) {
                return false;
            } else {
                continue;
            }
        }

        return true;
    }

    /////////////////////////////////////////////////
    // END OF CLASS control
    /////////////////////////////////////////////////
}
