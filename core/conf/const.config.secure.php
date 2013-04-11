<?php

(!defined('SDG')) ? die ('Triple protection!') : null;

define("SECURE_CAPTCHA", "1");

define("SECURE_SQLERR_LOG", "1");

define("SECURE_SQLERR_PRINT", "1");

define("SECURE_SQLERR_SEND_MESS", "1");

define("SECURE_SQLERR_EMAIL", "admin@email.com");

define("SECURE_SQLERR_HEADERS", "Content-Type: text/html; charset=utf-8\r\nFrom: admin@email.com\r\n");

define("SECURE_ADMIN_ACCESS_IP_LIST", "");
