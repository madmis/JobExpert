<?php

/**
 * JobExpert v1.0
 * powered by Script Developers Group (SD-Group)
 * email: info@sd-group.org.ua
 * url: http://sd-group.org.ua/
 * Copyright 2010-2015 (c) SD-Group
 * All rights reserved
 * =========================================================
 * YVL
 * (Yandex Vacancy Language) - стандарт, разработанный Яндексом
 * для приема и публикации информации о вакансиях в базе данных
 * Яндекс.Работа (http://rabota.yandex.ru/).
 * YVL основан на стандарте XML (Extensible Markup Language).
 * =========================================================
 */
(!defined('SDG')) ? die('Triple protection!') : null;

$yvl = new yvl();
header("Content-type: text/xml");
defined('CONF_YVL_EXPORT_PERIOD') or define('CONF_YVL_EXPORT_PERIOD', 21);
echo $yvl->rssVacancy(CONF_YVL_EXPORT_PERIOD);
exit;