<?php

/**
 * JobExpert v1.0
 * Powered by Script Developers Group (SD-Group)
 * Email: info@sd-group.org.ua
 * URL: http://sd-group.org.ua/
 * Copyright 2010-2015 (c) SD-Group
 * All rights reserved
 * ===================================================
 * Класс работы с ЧПУ
 * ===================================================
 *
 * @package
 *
 * @todo
 *
 */
(!defined('SDG')) ? die('Triple protection!') : null;

class chpu {
	/////////////////////////////////////////////////
	// METHODS - методы класса chpu
	/////////////////////////////////////////////////

	/**
	 * функция получения параметров из URL и установка их в $_GET, при включенном ЧПУ
	 *
	 * @return bool
	 */
	static function setUrlToGet($arrGroups) {
		// проверяем, включены ли ЧПУ
		if (CONF_ENABLE_CHPU) {
			// работаем с ЧПУ лишь в том случае, если в REQUEST_URI нет ? (иначе это обычный запрос, а он должен работать всегда)
			if (false === strstr($_SERVER['REQUEST_URI'], '?')) {
				// парсим строку параметров
				$url = explode('/', ltrim(str_replace(array(CONF_CHPU_HTML_DATA_EXT, CONF_CHPU_XML_DATA_EXT), '', $_SERVER['REQUEST_URI']), '/'));

				/**
				 * Проверяем, есть ли данные для формирования
				 * Формируем $_GET
				 * Первые три параметра, это всегда: ut, do и action
				 */
				if (!empty($url[0]) && 'index.php' !== $url[0]) {
					// если $url[0] не соответствует ни одному типу пользователя
					// помещаем первым элементом массива пустую строку
					!in_array($url[0], $arrGroups) ? array_unshift($url, '') : null;
					$_GET['ut'] = $url[0];

					if (!empty($url[1])) {
						$_GET['do'] = &$url[1];

						if (!empty($url[2])) {
							// переход по модам оплат или action
							('payments' === $_GET['do']) ? $_GET['mod'] = &$url[2] : $_GET['action'] = &$url[2];

							if (empty($_GET['mod']) && isset($url[3])) {
								// редактирование данных пользователя user.data.edit.tpl
								if ('user.data' === $_GET['do'] && 'edit' === $_GET['action']) {
									// якорь, указывающий какую вкладку необходимо открыть
									$_GET['anc'] = &$url[3];
								}
								// просмотр объявлений пользователя
								elseif (('user.announces' === $_GET['do']) && ('vacancy' === $_GET['action'] || 'resume' === $_GET['action'])) {
									(!empty($url[3])) ? $_GET['token'] = &$url[3] : null;
									(!empty($url[4])) ? $_GET['offset'] = &$url[4] : $_GET['offset'] = 0;
								}
								// просмотр Ваканий/Резюме по Разделам/Профессиям/Регионам/Городам + страницы
								elseif (('vacancy' === $_GET['do'] || 'resume' === $_GET['do']) && ('sections' === $_GET['action'] || 'professions' === $_GET['action'] || 'regions' === $_GET['action'] || 'citys' === $_GET['action']) && !self::getId_out_tId($url[3])) {
									(!empty($url[4])) ? $_GET['offset'] = &$url[4] : $_GET['offset'] = 0;
								}
								// просмотр Ваканий/Резюме по id Раздела/Профессии/Региона/Города + страницы
								elseif (('vacancy' === $_GET['do'] || 'resume' === $_GET['do']) && ('sections' === $_GET['action'] || 'professions' === $_GET['action'] || 'regions' === $_GET['action'] || 'citys' === $_GET['action']) && self::getId_out_tId($url[3])) {
									$_GET['id'] = self::getId_out_tId($url[3]);
									(!empty($url[5])) ? $_GET['offset'] = &$url[5] : $_GET['offset'] = 0;
								}
								// редактирование Ваканий/Резюме по unikey
								elseif (('vacancy' === $_GET['do'] || 'resume' === $_GET['do']) && 'edit' === $_GET['action'] && (string) $url[3]) {
									$_GET['unikey'] = &$url[3];
								}
								// просмотр VIP/HOT-Ваканий/Резюме + страницы
								elseif (('vacancy' === $_GET['do'] || 'resume' === $_GET['do']) && ('vip' === $_GET['action'] || 'hot' === $_GET['action'])) {
									if (!empty($url[3]) && 'offset' == $url[3] && !empty($url[4])) {
										$_GET['offset'] = &$url[4];
									}
								}
								// просмотр Статей по выбранному Разделу + страницы
								elseif ('articles' === $_GET['do'] && 'section' === $_GET['action']) {
									$_GET['id'] = self::getId_out_tId($url[3]);
									(!empty($url[5])) ? $_GET['offset'] = &$url[5] : $_GET['offset'] = 0;
								}
								// просмотр Архива новостей
								elseif ('news' === $_GET['do'] && 'archive' === $_GET['action']) {
									if ('offset' == $url[3] && isset($url[4]) && ctype_digit($url[4])) {
										$_GET['offset'] = &$url[4];
									} elseif (4 == strlen($url[3]) && ctype_digit($url[3])) {
										$_GET['year'] = self::getId_out_tId($url[3]);

										if (isset($url[4])) {
											if ('offset' == $url[4] && isset($url[5]) && ctype_digit($url[5])) {
												$_GET['offset'] = &$url[5];
											} elseif (2 == strlen($url[4]) && ctype_digit($url[4])) {
												$_GET['month'] = &$url[4];

												if (isset($url[5])) {
													if ('offset' == $url[5] && isset($url[6]) && ctype_digit($url[6])) {
														$_GET['offset'] = &$url[6];
													} else {
														$_GET['error404'] = true;
													}
												}
											} else {
												$_GET['error404'] = true;
											}
										}
									} else {
										$_GET['error404'] = true;
									}
								}
								// переход по ссылкам разбиения на страницы
								elseif ('offset' === $_GET['action']) {
									$_GET['offset'] = &$url[3];
								}
								// RSS
								elseif ('rss' === $_GET['do'] && ('articles' === $_GET['action'] || 'vacancy' === $_GET['action'] || 'resume' === $_GET['action'])) {
									$_GET['subaction'] = &$url[3];
									$_GET['id'] = (!empty($url[4])) ? self::getId_out_tId($url[4]) : 0;
								} elseif ('pages' === $_GET['do']) {
									$_GET['id'] = &$url[3];
								} else {
									$_GET['id'] = self::getId_out_tId($url[3]);
								}
							}
						}
					}
				}

				return true;
			}
		}

		return false;
	}

	/**
	 * функция генерирует ЧПУ
	 *
	 * @param (string) $url - ссылка для ЧПУ
	 * @param (bool) $noCHPU - параметр, указывающий что не нужно приводить сслыки к ЧПУ (по умолчанию FALSE). Параметр был введен для метода strings::generatePage - т.к. он используется и в админке и в польз. части, а в админке ЧПУ не нужно никогда. Параметр можно использовать и в др. необходимых местах.
	 *
	 * @return string
	 */
	static function createChpuUrl($url, $noCHPU = false) {
		// проверяем, включены ли ЧПУ
		if (CONF_ENABLE_CHPU && !$noCHPU) {
			$purl = parse_url(str_replace('&amp;', '&', $url));

			if (isset($purl['query'])) {
				parse_str($purl['query'], $query_arr);

				if (empty($query_arr['ut'])) {
					unset($query_arr['ut']);
				}

				$url = filesys::setPath(CONF_SCRIPT_URL) . implode('/', $query_arr) . ((!empty($query_arr['do']) && 'rss' == $query_arr['do'] && !empty($query_arr['action'])) ? CONF_CHPU_XML_DATA_EXT : CONF_CHPU_HTML_DATA_EXT) . (isset($purl['fragment']) ? '#' . $purl['fragment'] : null);
			}
		}

		return $url;
	}

	/**
	 * Функция получает ID (уникальный идентификатор записи в таблице БД) из строки ЧПУ с транслитерацией
	 * Сохраняет идентификатор транслитерации ЧПУ в глобал $_GET['tId']
	 *
	 * @param (string) $tId - строка ЧПУ с транслитерацией
	 *
	 * @return (int) id
	 */
	static function getId_out_tId($tId) {
		// проверяем, включены ли ЧПУ с транслитерацией
		if (CONF_ENABLE_CHPU && CONF_ENABLE_TRANSLITERATION_CHPU) {
			// сохраняем значение $tId в глобал $_GET - для проверок корректности URL
			$_GET['tId'] = $tId;
			// получаем ID
			$tId = (CONF_TRANSLITERATION_CHPU_ID_PUT_TO_END) ? array_pop(explode('-', $tId)) : reset(explode('-', $tId));
			$tId = validate::checkNaturalNumber($tId);
		}

		return (int) $tId;
	}

	/**
	 * функция транслитерации ЧПУ - формирует поле tId (идентификатор записи с транслитерацией)
	 *
	 * @param (array) $data - массив данных объявления
	 *
	 * @return void
	 */
	static function chpuTranslit(&$data) {
		if (CONF_ENABLE_CHPU && CONF_ENABLE_TRANSLITERATION_CHPU) {
			if (is_array($data) && !empty($data['id'])) {

				if (!empty($data['title'])) {
					$tId = $data['title'];
				} elseif (!empty($data['name'])) {
					$tId = $data['name'];
				} elseif (!empty($data['company_name'])) {
					$tId = $data['company_name'];
				} else {
					$tId = false;
				}

				if (!empty($tId)) {
					$data['tId'] = (CONF_TRANSLITERATION_CHPU_ID_PUT_TO_END) ? strings::str2url($tId) . '-' . $data['id'] : $data['id'] . '-' . strings::str2url($tId);
				} else {
					$data['tId'] = &$data['id'];
				}
			} elseif (is_object($data) && !empty($data->id)) {

				if (!empty($data->title)) {
					$tId = $data->title;
				} elseif (!empty($data->name)) {
					$tId = $data->name;
				} elseif (!empty($data->company_name)) {
					$tId = $data->company_name;
				} else {
					$tId = false;
				}

				if (!empty($tId)) {
					$data->tId = (CONF_TRANSLITERATION_CHPU_ID_PUT_TO_END) ? strings::str2url($tId) . '-' . $data->id : $data->id . '-' . strings::str2url($tId);
				} else {
					$data->tId = &$data->id;
				}
			}
		}
	}

	/////////////////////////////////////////////////
	// END OF CLASS chpu
	/////////////////////////////////////////////////
}
