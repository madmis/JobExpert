<?php
/********************************************************
	powered by Script Developers Group (SD-Group)
	email: info@sd-group.org.ua
	url: http://sd-group.org.ua/
	Copyright 2009 (c) SD-Group
	All rights reserved
=========================================================
	Функции импорта
********************************************************/

(!defined('SDG')) ? die ('Triple protection!') : null;

class import
{
	/////////////////////////////////////////////////
	// VARS - свойства класса import
	/////////////////////////////////////////////////

	static $arrDataImport;

	/////////////////////////////////////////////////
	// METHODS - методы класса import
	/////////////////////////////////////////////////

	/**
	* Функция инициирует соединение с БД предназначенной для импорта данных
	* 
	* @param (string) $db_host - хост БД
	* @param (string) $db_name - имя БД
	* @param (string) $db_user - имя пользователя БД
	* @param (string) $db_pass - пароль пользователя БД
	* @param (string) $db_charset - кодировка БД
	* 
	* @return bool
	*/	
	static function dbConnect($db_host, $db_name, $db_user, $db_pass, $db_charset = DB_CHARSET)
	{
		return db::_init($db_host, $db_name, $db_user, $db_pass, $db_charset);
	}

	/**
	* Функция формирует данные для импорта
	* 
	* @param (array) $arrTables - массив таблиц для импорта
	* 
	* @return (string) - JSON-строка с описанием данных полученных для импорта
	*/	
	static function mdsImportDB($arrTables)
	{
		if (empty($arrTables) || !is_array($arrTables))
		{
			return false;
		}
		else
		{
			$arrResult = array();
			foreach($arrTables as $key => &$table)
			{
				// определяем вызываемый метод
				$importMethod = 'mdsImport_' . $key;
                // инициируем строку запроса
				$strQuery = 'SELECT * FROM ' . $table;
				// выполняем запрос
				$arrResult[] = self::$importMethod(db::dbMultiQuery($strQuery));
			}

			return (!filesys::putSerializedData('core/data/mdsImport.mda', self::$arrDataImport)) ? false : ajax::sdgJSONencode($arrResult);
		}
	}

	/**
	* Функция выполнения импорта
	* 
	* @return (string) - JSON-строка с описанием текущего состояния процесса импорта
	*/	
	static function mdsDoImportDB()
	{
		if ($arrData = filesys::getSerializedData('core/data/mdsImport.mda'))
		{
			foreach($arrData as $table => &$arrDataTable)
			{
				$arrQueryData = array_shift($arrDataTable);

				$oldId =& $arrQueryData['old_id'];

				unset($arrQueryData['old_id']);

				$newId = db::dbInsertTable($table, secure::escQuoteData($arrQueryData));

				switch ($table)
				{
					case USR_PREFIX . 'city':
					{
						$arrUpdateQuerys[DB_PREFIX . 'subscription'][]= array(
							'arrData' => array('id_city' => $newId, 'token' => 'reserved'),
							'strWhere' => "id_city IN ('$oldId') AND token IN ('active')"
						);
						$arrUpdateQuerys[DB_PREFIX . 'subscription'][]= array(
							'arrData' => array('id_city' => $newId, 'token' => 'deleted'),
							'strWhere' => "id_city IN ('$oldId') AND token IN ('archived')"
						);

						$arrUpdateQuerys[DB_PREFIX . 'vacancy'][]= array(
							'arrData' => array('id_city' => $newId, 'token' => 'reserved'),
							'strWhere' => "id_city IN ('$oldId') AND token IN ('active')"
						);
						$arrUpdateQuerys[DB_PREFIX . 'vacancy'][]= array(
							'arrData' => array('id_city' => $newId, 'token' => 'deleted'),
							'strWhere' => "id_city IN ('$oldId') AND token IN ('archived')"
						);

						$arrUpdateQuerys[DB_PREFIX . 'resume'][]= array(
							'arrData' => array('id_city' => $newId, 'token' => 'reserved'),
							'strWhere' => "id_city IN ('$oldId') AND token IN ('active')"
						);
						$arrUpdateQuerys[DB_PREFIX . 'resume'][]= array(
							'arrData' => array('id_city' => $newId, 'token' => 'deleted'),
							'strWhere' => "id_city IN ('$oldId') AND token IN ('archived')"
						);

						break;
					}

					case USR_PREFIX . 'region':
					{
						$arrUpdateQuerys[USR_PREFIX . 'city'][]= array(
							'arrData' => array('parent_id' => $newId, 'token' => 'reserved'),
							'strWhere' => "parent_id IN ('$oldId') AND token IN ('active')"
						);

						$arrUpdateQuerys[DB_PREFIX . 'subscription'][]= array(
							'arrData' => array('id_region' => $newId, 'token' => 'reserved'),
							'strWhere' => "id_region IN ('$oldId') AND token IN ('active')"
						);
						$arrUpdateQuerys[DB_PREFIX . 'subscription'][]= array(
							'arrData' => array('id_region' => $newId, 'token' => 'deleted'),
							'strWhere' => "id_region IN ('$oldId') AND token IN ('archived')"
						);

						$arrUpdateQuerys[DB_PREFIX . 'vacancy'][]= array(
							'arrData' => array('id_region' => $newId, 'token' => 'reserved'),
							'strWhere' => "id_region IN ('$oldId') AND token IN ('active')"
						);
						$arrUpdateQuerys[DB_PREFIX . 'vacancy'][]= array(
							'arrData' => array('id_region' => $newId, 'token' => 'deleted'),
							'strWhere' => "id_region IN ('$oldId') AND token IN ('archived')"
						);

						$arrUpdateQuerys[DB_PREFIX . 'resume'][]= array(
							'arrData' => array('id_region' => $newId, 'token' => 'reserved'),
							'strWhere' => "id_region IN ('$oldId') AND token IN ('active')"
						);
						$arrUpdateQuerys[DB_PREFIX . 'resume'][]= array(
							'arrData' => array('id_region' => $newId, 'token' => 'deleted'),
							'strWhere' => "id_region IN ('$oldId') AND token IN ('archived')"
						);

						break;
					}

					case DB_PREFIX . 'profession':
					{
						$arrUpdateQuerys[DB_PREFIX . 'subscription'][]= array(
							'arrData' => array('id_profession' => $newId, 'token' => 'reserved'),
							'strWhere' => "id_profession IN ('$oldId') AND token IN ('active')"
						);
						$arrUpdateQuerys[DB_PREFIX . 'subscription'][]= array(
							'arrData' => array('id_profession' => $newId, 'token' => 'deleted'),
							'strWhere' => "id_profession IN ('$oldId') AND token IN ('archived')"
						);

						$arrUpdateQuerys[DB_PREFIX . 'vacancy'][]= array(
							'arrData' => array('id_profession' => $newId, 'token' => 'reserved'),
							'strWhere' => "id_profession IN ('$oldId') AND token IN ('active')"
						);
						$arrUpdateQuerys[DB_PREFIX . 'vacancy'][]= array(
							'arrData' => array('id_profession' => $newId, 'token' => 'deleted'),
							'strWhere' => "id_profession IN ('$oldId') AND token IN ('archived')"
						);

						$arrUpdateQuerys[DB_PREFIX . 'resume'][]= array(
							'arrData' => array('id_profession' => $newId, 'token' => 'reserved'),
							'strWhere' => "id_profession IN ('$oldId') AND token IN ('active')"
						);
						$arrUpdateQuerys[DB_PREFIX . 'resume'][]= array(
							'arrData' => array('id_profession' => $newId, 'token' => 'deleted'),
							'strWhere' => "id_profession IN ('$oldId') AND token IN ('archived')"
						);

						break;
					}

					case DB_PREFIX . 'section':
					{
						$arrUpdateQuerys[DB_PREFIX . 'profession'][]= array(
							'arrData' => array('parent_id' => $newId, 'token' => 'reserved'),
							'strWhere' => "parent_id IN ('$oldId') AND token IN ('active')"
						);

						$arrUpdateQuerys[DB_PREFIX . 'subscription'][]= array(
							'arrData' => array('id_section' => $newId, 'token' => 'reserved'),
							'strWhere' => "id_section IN ('$oldId') AND token IN ('active')"
						);
						$arrUpdateQuerys[DB_PREFIX . 'subscription'][]= array(
							'arrData' => array('id_section' => $newId, 'token' => 'deleted'),
							'strWhere' => "id_section IN ('$oldId') AND token IN ('archived')"
						);

						$arrUpdateQuerys[DB_PREFIX . 'vacancy'][]= array(
							'arrData' => array('id_section' => $newId, 'token' => 'reserved'),
							'strWhere' => "id_section IN ('$oldId') AND token IN ('active')"
						);
						$arrUpdateQuerys[DB_PREFIX . 'vacancy'][]= array(
							'arrData' => array('id_section' => $newId, 'token' => 'deleted'),
							'strWhere' => "id_section IN ('$oldId') AND token IN ('archived')"
						);

						$arrUpdateQuerys[DB_PREFIX . 'resume'][]= array(
							'arrData' => array('id_section' => $newId, 'token' => 'reserved'),
							'strWhere' => "id_section IN ('$oldId') AND token IN ('active')"
						);
						$arrUpdateQuerys[DB_PREFIX . 'resume'][]= array(
							'arrData' => array('id_section' => $newId, 'token' => 'deleted'),
							'strWhere' => "id_section IN ('$oldId') AND token IN ('archived')"
						);

						break;
					}

					case DB_PREFIX . 'vacancy':
					{
						$arrUpdateQuerys[DB_PREFIX . 'subscription'][]= array(
							'arrData' => array('id_announce' => $newId, 'token' => 'reserved'),
							'strWhere' => "id_announce IN ('$oldId') AND token IN ('active')"
						);
						$arrUpdateQuerys[DB_PREFIX . 'subscription'][]= array(
							'arrData' => array('id_announce' => $newId, 'token' => 'deleted'),
							'strWhere' => "id_announce IN ('$oldId') AND token IN ('archived')"
						);
						break;
					}

					case DB_PREFIX . 'resume':
					{
						$arrUpdateQuerys[DB_PREFIX . 'subscription'][]= array(
							'arrData' => array('id_announce' => $newId, 'token' => 'reserved'),
							'strWhere' => "id_announce IN ('$oldId') AND token IN ('active')"
						);
						$arrUpdateQuerys[DB_PREFIX . 'subscription'][]= array(
							'arrData' => array('id_announce' => $newId, 'token' => 'deleted'),
							'strWhere' => "id_announce IN ('$oldId') AND token IN ('archived')"
						);

						break;
					}

					case USR_PREFIX . 'users':
					{
						$arrData[DB_PREFIX . 'conf_users'][$oldId]['id'] = $newId;

						$arrUpdateQuerys[DB_PREFIX . 'subscription'][]= array(
							'arrData' => array('id_user' => $newId, 'token' => 'reserved'),
							'strWhere' => "id_user IN ('$oldId') AND token IN ('active')"
						);
						$arrUpdateQuerys[DB_PREFIX . 'subscription'][]= array(
							'arrData' => array('id_user' => $newId, 'token' => 'deleted'),
							'strWhere' => "id_user IN ('$oldId') AND token IN ('archived')"
						);

						$arrUpdateQuerys[DB_PREFIX . 'vacancy'][]= array(
							'arrData' => array('id_user' => $newId, 'token' => 'reserved'),
							'strWhere' => "id_user IN ('$oldId') AND token IN ('active')"
						);
						$arrUpdateQuerys[DB_PREFIX . 'vacancy'][]= array(
							'arrData' => array('id_user' => $newId, 'token' => 'deleted'),
							'strWhere' => "id_user IN ('$oldId') AND token IN ('archived')"
						);

						$arrUpdateQuerys[DB_PREFIX . 'resume'][]= array(
							'arrData' => array('id_user' => $newId, 'token' => 'reserved'),
							'strWhere' => "id_user IN ('$oldId') AND token IN ('active')"
						);
						$arrUpdateQuerys[DB_PREFIX . 'resume'][]= array(
							'arrData' => array('id_user' => $newId, 'token' => 'deleted'),
							'strWhere' => "id_user IN ('$oldId') AND token IN ('archived')"
						);

						break;
					}

					case DB_PREFIX . 'conf_users':
					{
						('competitor' !== $arrQueryData['user_type']) ? $arrUpdateQuerys[DB_PREFIX . 'vacancy'][]= array(
							'arrData' => array('user_type' => $arrQueryData['user_type']),
							'strWhere' => "id_user IN ('" . $arrQueryData['id'] . "')"
						) : null;

						break;
					}

					default:
						break;
				}

				if (!empty($arrUpdateQuerys))
				{
					foreach ($arrUpdateQuerys as $keyT => &$valueT)
					{
						foreach ($valueT as &$arrUpdData)
						{
							db::dbUpdateTable($keyT, secure::escQuoteData($arrUpdData['arrData']), $arrUpdData['strWhere']);
						}

						db::dbUpdateTable($keyT, secure::escQuoteData(array('token' => 'active')), "token IN ('reserved')");
						db::dbUpdateTable($keyT, secure::escQuoteData(array('token' => 'archived')), "token IN ('deleted')");
					}
				}

				if (empty($arrDataTable))
				{
					unset ($arrData[$table]);
				}

				(DB_PREFIX . 'conf_users' == $table) ? $table = USR_PREFIX . 'users' : null;
				if (!empty($arrData))
				{
					filesys::putSerializedData('core/data/mdsImport.mda', $arrData);

					$result = array(
						'onProgress'	=> true,
						'table'			=> &$table
					);
				}
				else
				{
					@unlink('core/data/mdsImport.mda');
					caching::dropCache();

					$result = array(
						'onProgress'	=> false,
						'table'			=> &$table
					);
				}

				return ajax::sdgJSONencode($result);
			}
		}
		else
		{
			caching::dropCache();
			return ajax::sdgJSONencode(array('onProgress' => false));
		}
	}

	private function mdsImport_users($arrData)
	{
		if (!empty($arrData))
		{
			foreach ($arrData as &$value)
			{
				self::$arrDataImport[USR_PREFIX . 'users'][] = array(
					'old_id'		=> &$value['id_user'],
					'email'			=> &$value['email_user'],
					'password'		=> &$value['pass_user'],
					'first_name'	=> &$value['fio_user'],
					'last_name'		=> $value['fio_user'],
					'reg_datetime'	=> $value['regdate_user'] . ' ' . $value['regtime_user'],
					'token'			=> 'active'
				);

				$userType = ($value['employer'] && $value['competitor']) ? 'agent' : (($value['use_firm_in_user_acc']) ? 'company' : (($value['employer']) ? 'employer' : 'competitor'));

				self::$arrDataImport[DB_PREFIX . 'conf_users'][$value['id_user']] = array(
					'old_id'				=> &$value['id_user'],
					'user_type'				=> $userType,
					'user_group'			=> constant('CONF_' . strtoupper($userType) . '_REGISTER_DEFAULT_GROUP'),
					'company_name'			=> str_replace("'", '"', $value['name_firm']),
					'company_city'			=> &$value['city_firm'],
					'company_url'			=> &$value['url_user'],
					'company_description'	=> &$value['description_firm'],
					'logo'					=> &$value['logo_firm'],
					'token'					=> 'active'
				);
			}
		}

		$result = array(
			'table' => USR_PREFIX . 'users',
			'size' => (!empty(self::$arrDataImport[USR_PREFIX . 'users'])) ? count(self::$arrDataImport[USR_PREFIX . 'users']) * 2 : false
		);

		return $result;
	}

	private function mdsImport_region($arrData)
	{
		if (!empty($arrData))
		{
			foreach ($arrData as &$value)
			{
				self::$arrDataImport[USR_PREFIX . 'region'][] = array(
					'old_id'	=> &$value['id_oblast'],
					'name'		=> &$value['name_oblast'],
					'sort'		=> &$value['sort'],
					'token' 	=> 'active'
				);
			}
		}

		$result = array(
			'table' => USR_PREFIX . 'region',
			'size' => (!empty(self::$arrDataImport[USR_PREFIX . 'region'])) ? count(self::$arrDataImport[USR_PREFIX . 'region']) : false
		);

		return $result;
	}

	private function mdsImport_city($arrData)
	{
		if (!empty($arrData))
		{
			foreach ($arrData as &$value)
			{
				self::$arrDataImport[USR_PREFIX . 'city'][] = array(
					'old_id'	=> &$value['id_city'],
					'parent_id'	=> &$value['id_parent'],
					'name'		=> &$value['name_city'],
					'capital'	=> &$value['capital'],
					'token' 	=> 'active'
				);
			}
		}

		$result = array(
			'table' => USR_PREFIX . 'city',
			'size' => (!empty(self::$arrDataImport[USR_PREFIX . 'city'])) ? count(self::$arrDataImport[USR_PREFIX . 'city']) : false
		);

		return $result;
	}

	private function mdsImport_section($arrData)
	{
		if (!empty($arrData))
		{
			foreach ($arrData as &$value)
			{
				self::$arrDataImport[DB_PREFIX . 'section'][] = array(
					'old_id'	=> &$value['id_razdel'],
					'name'		=> &$value['name_razdel'],
					'sort'		=> &$value['sort'],
					'token' 	=> 'active'
				);
			}
		}

		$result = array(
			'table' => DB_PREFIX . 'section',
			'size' => (!empty(self::$arrDataImport[DB_PREFIX . 'section'])) ? count(self::$arrDataImport[DB_PREFIX . 'section']) : false
		);

		return $result;
	}

	private function mdsImport_profession($arrData)
	{
		if (!empty($arrData))
		{
			foreach ($arrData as &$value)
			{
				self::$arrDataImport[DB_PREFIX . 'profession'][] = array(
					'old_id'	=> &$value['id_profecy'],
					'parent_id'	=> &$value['id_parent'],
					'name'		=> &$value['name_profecy'],
					'sort'		=> &$value['sort'],
					'token' 	=> 'active'
				);
			}
		}

		$result = array(
			'table' => DB_PREFIX . 'profession',
			'size' => (!empty(self::$arrDataImport[DB_PREFIX . 'profession'])) ? count(self::$arrDataImport[DB_PREFIX . 'profession']) : false
		);

		return $result;
	}

	private function mdsImport_vacancy($arrData)
	{
		if (!empty($arrData))
		{
			foreach ($arrData as &$value)
			{
				self::$arrDataImport[DB_PREFIX . 'vacancy'][] = array(
					'old_id'				=> &$value['id_vacancy'],
					'title'					=> &$value['name_vacancy'],
					'company_name'			=> str_replace("'", '"', $value['name_firm_vacancy']),
					'company_discription'	=> str_replace("'", '"', $value['name_firm_vacancy']),
					'email'					=> &$value['email_vacancy'],
					'phone'					=> &$value['phone_vacancy'],
					'contacts_fio'			=> &$value['fio_vacancy'],
					'id_section'			=> &$value['id_razdel'],
					'id_profession'			=> &$value['id_profecy'],
					'id_region'				=> &$value['id_oblast'],
					'id_city'				=> &$value['id_city'],
					'pay_from'				=> &$value['zp_vacancy_ot'],
					'currency'				=> &$value['currency_vacancy'],
					'requirements'			=> &$value['info_vacancy'],
					'duties_work'			=> &$value['obyaz_vacancy'],
					'user_type'				=> 'employer',
					'agent_name'			=> str_replace("'", '"', $value['name_firm_vacancy']),
					'url'					=> &$value['url_vacancy'],
					'pay_post'				=> &$value['zp_vacancy_do'],
					'chart_work'			=> &$value['grafic_vacancy'],
					'expire_work'			=> &$value['expire_vacancy'],
					'edu_work'				=> &$value['edu_vacancy'],
					'age_from'				=> &$value['agemin_vacancy'],
					'age_post'				=> &$value['agemax_vacancy'],
					'gender'				=> (1 == $value['gender_vacancy']) ? 'female' : ((2 == $value['gender_vacancy']) ? 'male' : 'none'),
					'act_period'			=> &$value['period_vacancy'],
					'unikey'				=> &$value['unikey_vacancy'],
					'id_user'				=> &$value['id_user'],
					'act_datetime'			=> $value['date_vacancy'] . ' ' . $value['time_vacancy'],
					'vip'					=> &$value['vip_vacancy'],
					'hot'					=> &$value['hot_vacancy'],
					'rate'					=> &$value['rating_vacancy'],
					'cnt_views_total' 		=> &$value['view_vacancy'],
					'token'					=> ($value['active_vacancy']) ? 'active' : 'archived',
					'token_datetime'		=> &$value['deldate_vacancy'],
					'meta_keywords'			=> implode(', ', array_merge(explode(' ', $value['name_vacancy']), array($value['zp_vacancy_ot'] . ' ' . $value['currency_vacancy']))),
					'meta_description'		=> implode(', ', array($value['name_vacancy'], $value['zp_vacancy_ot'] . ' ' . $value['currency_vacancy']))
				);
			}
		}

		$result = array(
			'table' => DB_PREFIX . 'vacancy',
			'size' => (!empty(self::$arrDataImport[DB_PREFIX . 'vacancy'])) ? count(self::$arrDataImport[DB_PREFIX . 'vacancy']) : false
		);

		return $result;
	}

	private function mdsImport_resume($arrData)
	{
		if (!empty($arrData))
		{
			foreach ($arrData as &$value)
			{
				self::$arrDataImport[DB_PREFIX . 'resume'][] = array(
					'old_id'			=> &$value['id_resume'],
					'title'				=> &$value['name_resume'],
					'first_name'		=> &$value['fio_resume'],
					'email'				=> &$value['email_resume'],
					'phone'				=> &$value['phone_resume'],
					'age'				=> &$value['age_resume'],
					'gender'			=> (1 == $value['gender_resume']) ? 'female' : 'male',
					'birthday'			=> '0000-00-00',
					'expire_work'		=> &$value['expire_resume'],
					'education'			=> &$value['edu_resume'],
					'id_section'		=> &$value['id_razdel'],
					'id_profession'		=> &$value['id_profecy'],
					'id_region'			=> &$value['id_oblast'],
					'id_city'			=> &$value['id_city'],
					'pay_from'			=> &$value['zp_resume'],
					'currency'			=> &$value['currency_resume'],
					'visibility'		=> 'visible',
					'chart_work'		=> &$value['grafic_resume'],
					'about_info'		=> $value['work_expire_resume'] . '<br><br>' . $value['education_resume'] . '<br><br>' . $value['info_resume'] . '<br><br>' . $value['recommend_resume'],
					'act_period'		=> &$value['period_resume'],
					'unikey'			=> &$value['unikey_resume'],
					'id_user'			=> &$value['id_user'],
					'act_datetime'		=> $value['date_resume'] . ' ' . $value['time_resume'],
					'vip'				=> &$value['vip_resume'],
					'hot'				=> &$value['hot_resume'],
					'rate'				=> &$value['rating_resume'],
					'image'				=> &$value['image_files'],
					'cnt_views_total' 	=> &$value['view_resume'],
					'token'				=> ($value['active_resume']) ? 'active' : 'archived',
					'token_datetime'	=> &$value['deldate_resume'],
					'meta_keywords'		=> implode(', ', array_merge(explode(' ', $value['name_resume']), array($value['zp_resume'] . ' ' . $value['currency_resume']))),
					'meta_description'	=> implode(', ', array($value['name_resume'], $value['zp_resume'] . ' ' . $value['currency_resume']))
				);
			}
		}

		$result = array(
			'table' => DB_PREFIX . 'resume',
			'size' => (!empty(self::$arrDataImport[DB_PREFIX . 'resume'])) ? count(self::$arrDataImport[DB_PREFIX . 'resume']) : false
		);

		return $result;
	}

	private function mdsImport_subscription($arrData)
	{
		if (!empty($arrData))
		{
			foreach ($arrData as &$value)
			{
				if ('all' === $value['types_subscription'])
				{
					self::$arrDataImport[DB_PREFIX . 'subscription'][] = array(
						'old_id'			=> &$value['id'],
						'id_announce'		=> &$value['id_announce'],
						'id_user'			=> &$value['id_user'],
						'email'				=> &$value['email_user'],
						'type_subscription' => 'resume',
						'id_section'		=> &$value['id_razdel'],
						'id_profession'		=> &$value['id_profecy'],
						'id_region'			=> &$value['id_oblast'],
						'id_city'			=> &$value['id_city'],
						'token'				=> ($value['active_subscription']) ? 'active' : 'archived'
					);

					self::$arrDataImport[DB_PREFIX . 'subscription'][] = array(
						'old_id'			=> $value['id'],
						'id_announce'		=> $value['id_announce'],
						'id_user'			=> $value['id_user'],
						'email'				=> $value['email_user'],
						'type_subscription' => 'vacancy',
						'id_section'		=> $value['id_razdel'],
						'id_profession'		=> $value['id_profecy'],
						'id_region'			=> $value['id_oblast'],
						'id_city'			=> $value['id_city'],
						'token'				=> ($value['active_subscription']) ? 'active' : 'archived'
					);
				}
				else
				{
					self::$arrDataImport[DB_PREFIX . 'subscription'][] = array(
						'old_id'			=> &$value['id'],
						'id_announce'		=> &$value['id_announce'],
						'id_user'			=> &$value['id_user'],
						'email'				=> &$value['email_user'],
						'type_subscription' => ('res' === $value['types_subscription']) ? 'vacancy' : 'resume',
						'id_section'		=> &$value['id_razdel'],
						'id_profession'		=> &$value['id_profecy'],
						'id_region'			=> &$value['id_oblast'],
						'id_city'			=> &$value['id_city'],
						'token'				=> ($value['active_subscription']) ? 'active' : 'archived'
					);
				}
			}
		}

		$result = array(
			'table' => DB_PREFIX . 'subscription',
			'size' => (!empty(self::$arrDataImport[DB_PREFIX . 'subscription'])) ? count(self::$arrDataImport[DB_PREFIX . 'subscription']) : false
		);

		return $result;
	}

	private function mdsImport_news($arrData)
	{
		if (!empty($arrData))
		{
			foreach ($arrData as &$value)
			{
				self::$arrDataImport[DB_PREFIX . 'news'][] = array(
					'old_id'		=> &$value['id_news'],
					'title'			=> &$value['zagolovok_news'],
					'small_text'	=> &$value['small_text_news'],
					'text'			=> &$value['text_news'],
					'token'			=> (!$value['arc_news']) ? 'active' : 'archived',
					'datetime'		=> $value['date_news'] . ' ' . $value['time_news'],
					'author'		=> 'Administrator'
				);
			}
		}

		$result = array(
			'table' => DB_PREFIX . 'news',
			'size' => (!empty(self::$arrDataImport[DB_PREFIX . 'news'])) ? count(self::$arrDataImport[DB_PREFIX . 'news']) : false
		);

		return $result;
	}

	/////////////////////////////////////////////////
	// END OF CLASS import
	/////////////////////////////////////////////////
}
