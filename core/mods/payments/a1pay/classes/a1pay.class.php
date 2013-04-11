<?php

/* * ******************************************************
  JobExpert v1.0
  powered by Script Developers Group (SD-Group)
  email: info@sd-group.org.ua
  url: http://sd-group.org.ua/
  Copyright 2010-2015 (c) SD-Group
  All rights reserved
  =========================================================
  Класс A1PAY
 * ****************************************************** */
/**
 * @package
 * @todo
 */
(!defined('SDG')) ? die('Triple protection!') : null;

class a1pay {

	static $serviceCodes = array(
		'register_agent' => 11,
		'register_company' => 12,
		'register_employer' => 13,
		'register_competitor' => 14,
		'add_vacancy' => 21,
		'add_resume' => 31,
		'vip_vacancy' => 22,
		'hot_vacancy' => 23,
		'rate_vacancy' => 24,
		'subscr_vacancy' => 25,
		'vip_resume' => 32,
		'hot_resume' => 33,
		'rate_resume' => 34,
		'subscr_resume' => 35
	);
	
	/**
	 * Разделитель id-записи и типа устлуги в сообщении
	 * @var type 
	 */
	static $idDelimiter = '#';

	/**
	 * функция сохраняет номер для мода
	 * @param (array) $arrNumbers - массив, содержащий парметры, которые необходимо записать (по идее это весь масив $_POST)
	 * @return bool
	 */
	static function saveModNumbers($arrNumbers, $arrPayments) {
		// если файла не существует
		if (!file_exists('core/mods/payments/a1pay/conf/a1pay.numbers.php')) {
			return false;
		} else {
			// формируем данные для записи
			$data = "<?php\n\n"
					. "(!defined('SDG')) ? die ('Triple protection!') : null;\n\n"
					. '$arrNumbers = array(' . "\n";

			foreach (array_keys($arrPayments) as $payment) {
				$arrData[] = "	'$payment' => " . (isset($arrNumbers[$payment]) && is_numeric($arrNumbers[$payment]) ? $arrNumbers[$payment] : "''");
			}

			$data .= implode(",\n", $arrData) . "\n);\n";

			return file_put_contents('core/mods/payments/a1pay/conf/a1pay.numbers.php', $data);
		}
	}
	
	/**
	 * Собираем параметры A1Pay в массив
	 * @param type $_GET 
	 */
	static function getParams($get) {
		$res = array();
		$res['order_id'] = time();
		$res['date'] = !empty($get['date']) ? $get['date'] : false;
		$res['country_id'] = !empty($get['country_id']) ? $get['country_id'] : false;
		$res['msg'] = !empty($get['msg']) ? $get['msg'] : false;
		$res['msg_trans'] = !empty($get['msg_trans']) ? $get['msg_trans'] : false;
		$res['operator_id'] = !empty($get['operator_id']) ? $get['operator_id'] : false;
		$res['user_id'] = !empty($get['user_id']) ? $get['user_id'] : false;
		$res['smsid'] = !empty($get['smsid']) ? $get['smsid'] : false;
		$res['cost_rur'] = !empty($get['cost_rur']) ? $get['cost_rur'] : false;
		$res['cost'] = !empty($get['cost']) ? $get['cost'] : false;
		$res['test'] = !empty($get['test']) ? $get['test'] : false;
		$res['num'] = !empty($get['num']) ? $get['num'] : false;
		$res['retry'] = !empty($get['retry']) ? $get['retry'] : false;
		$res['try'] = !empty($get['try']) ? $get['try'] : false;
		$res['ran'] = !empty($get['ran']) ? $get['ran'] : false;
		$res['skey'] = !empty($get['skey']) ? $get['skey'] : false;
		$res['sign'] = !empty($get['sign']) ? $get['sign'] : false;

		return $res;
	}

	/**
	 * Проверяем пришедшие параметры
	 * @param type $params 
	 */
	static function checkResultParams($params){
		if (empty($params['skey']) || $params['skey'] != md5(A1PAY_CONF_SECRET_KEY)) {
			return false;
		}
		if (empty($params['msg'])) {
			return false;
		}
		return true;
	}

	static function getOurData($msg) {
		$m = trim(str_replace(A1PAY_CONF_PREFIX, '', $msg));
		$r = explode(self::$idDelimiter, $m);
		$key = array_search($r[1], self::$serviceCodes); 
		$r[1] = $r[0];
		$r[0] = $key;
		return $r;
	}
	/**
	 * функция формирует строку для записи в лог платежей
	 * Строка логов должна обязательно начинаться с наименования платежной системы.
	 * @param (array) $arrData - массив параметров (от сервера a1pay)
	 * @param (string) $status - статус платежа. 
	 * (SUCCESS - успешно, FAIL - ошибка, WRONG PARAMS - оплата прошла, но от сервера получены неверные параметры)
	 * @return string (serialsed array)
	 */
	static function generateLogData(array $arrData, $status) {
		return serialize(array('payment_type' => 'A1PAY') + $arrData + array('status' => $status));
	}

}
