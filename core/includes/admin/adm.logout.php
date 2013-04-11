<?php
/********************************************************
	powered by Script Developers Group (SD-Group)
	email: info@sd-group.org.ua
	url: http://sd-group.org.ua/
	Copyright 2009 (c) SD-Group
	All rights reserved
=========================================================
	Выход админа
********************************************************/

(!defined('SDG')) ? die ('Triple protection!') : null;

unset ($_SESSION['administrator_login'], $_SESSION['administrator_password']);

die ('<script language="JavaScript" type="text/javascript">window.location="' . CONF_ADMIN_FILE . '";</script>'); 
