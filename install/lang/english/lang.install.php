<?php
/********************************************************
	JobExpert v1.0
	powered by Script Developers Group (SD-Group)
	email: info@sd-group.org.ua
	url: http://sd-group.org.ua/
	Copyright 2010-2015 (c) SD-Group
	All rights reserved
=========================================================
	Файл английского языка
********************************************************/
/**
 * @package
 * @todo
 */

(!defined('SDG')) ? die ('Triple protection!') : null;

define("INSTALLATION_TITLE", "JobExpert Installation");

define("JAVASCRIPT_DISABLED", "Your browser does not support JavaScript. Be sure to include support for JavaScript, before you begin work with our site.");

define("COOKIE_DISABLED", "Disabled in your browser Cookies. For the correct operation of the site Cookies must be enabled!");

/***** BUTTONS *****/
define("BUTTON_NEXT", "Next");

define("BUTTON_PREV", "Prev");

define("BUTTON_SAVE", "Save");


define("FORM_PLACE_AT_FIRST", "In the beginning");

define("FORM_PLACE_AT_CLOSE", "At the end");


/***** TABLE *****/
define("TABLE_COLUMN_CUREENT", "Current");

define("TABLE_COLUMN_MUST", "Must");


/***** STEP 1 *****/
define("DB_CONFIG_HEAD", "Configuring the system");

define("DB_CONFIG_MYSQL_HEAD", "Data for access to MySQL server");

define("DB_CONFIG_ADDITIONAL_DATA_HEAD", "Additional data");

define("DB_CONFIG_MYSQL_SERVER", "MySQL Server");

define("DB_CONFIG_MYSQL_NAME", "Database Name");

define("DB_CONFIG_MYSQL_USER", "User name");

define("DB_CONFIG_MYSQL_PASSWORD", "Password");

define("DB_CONFIG_ADDITIONAL_DATA_DB_PREFIX", "Table prefix of the script");

define("DB_CONFIG_ADDITIONAL_DATA_USER_PREFIX", "Prefix shared database tables");

define("DB_CONFIG_ADDITIONAL_DATA_DB_CHARSET", "DB charset");

define("DB_CONFIG_ADDITIONAL_DATA_DEFAULT_CHARSET", "Site charset");

/***** STEP 2 *****/
define("CREATE_TABLES_HEAD", "Creating Tables");

define("CREATE_TABLES_LIST", "Tables");

define("CREATE_TABLES_MANDATORY_DATA", "Mandatory data");

define("CREATE_TABLES_DEMO_DATA", "Additional data");

define("CREATE_TABLES_SUCCESS", "Successfully");

define("CREATE_TABLES_ERROR", "Error");

define("CREATE_TABLES_ATTENTION", "<b>Attention!!!</b> If any of the tables was not created, it is necessary to correct the error (will be displayed next to the name of the table) and try to create the table again.");

define("CREATE_TABLES_ADD_DEMO_DATA", "Add additional data (regions, cities, sections, professions)");

define("CREATE_TABLES_NOT_TRUNCATE_TABLES", "Unable to clear the tables before inserting data. Remove all data from the following table manually, and then try again to start adding more data.");

/***** STEP 3 *****/
define("SERVER_CONF_HEAD", "Server Settings");

define("SERVER_CONF_ROOT_DIR", "The path to the directory with the script");

/***** STEP 4 *****/
define("TMPL_CONF_HEAD", "Settings template Smarty");

define("TMPL_SMARTY_SETUP_SUCCESS", "Smarty installation completed successfully!");

define("TMPL_SMARTY_SETUP_FAIL", "Smarty not installed!");


/***** STEP 5 *****/

/***** STEP 6 *****/

/***** STEP 7 *****/

/***** STEP 8 *****/
define("SITE_CONF_HEAD", "Basic site configuration");

define("SITE_CONF_TITLE", "TITLE site default");

define("SITE_CONF_DESCRIPTION", "DESCRIPTION site default");

define("SITE_CONF_KEYWORDS", "KEYWORDS site default");

define("SITE_CONF_SITE_NAME_TO_TITLE", "Add site name in a TITLE page");

define("SITE_CONF_TITLE_PAGE_SEPERATOR", "The string delimiter for the TITLE page");

define("SITE_CONF_LANGUAGE", "Site language default");

define("SITE_CONF_TEMPLATE", "Site Template Default");

define("SITE_CONF_SITE_NAME", "Site name");

define("SITE_CONF_SITE_URL", "URL of the main site");

define("SITE_CONF_SCRIPT_URL", "URL of the script");

define("SITE_CONF_USE_REDIRECT_EXTERNAL_LINK", "Use redirect for external links");

define("SITE_CONF_USE_VISUAL_EDITOR", "Use the WYSIWYG-editor (tinyMCE)");

define("SITE_CONF_ENABLE_CACHING", "Enable caching");

define("SITE_CONF_DISABLE_AUTO_COUNTERS", "Turn off automatic recalculation counters");

define("SITE_CONF_ENABLE_CHPU", "Enable Friendly URL");

define("SITE_CONF_ENABLE_TRANSLITERATION_CHPU", "Enable a transliteration of Friendly URL");

define("SITE_CONF_TRANSLITERATION_CHPU_ID_PUT_TO_END", "Placing the entry ID in the URL transliteration of Friendly URL");

define("SITE_CONF_TRANSLITERATION_CHPU_MAX_LENGHT", "The maximum string length for transliteration of Friendly URL (symbols)");

define("SITE_CONF_CHPU_HTML_DATA_EXT", "Friendly URL - extension for pages with HTML data");

define("SITE_CONF_CHPU_XML_DATA_EXT", "Friendly URL - extension for pages with XML data");


/***** STEP 9 *****/
define("ADMIN_CONF_HEAD", "Administrator Settings");

define("ADMIN_CONF_ADMINFILE", "Admin-panel file (file extension <b>.php</b>)");

define("ADMIN_CONF_DATA", "Administrator Data");

define("ADMIN_CONF_LOGIN", "Administrator Login");

define("ADMIN_CONF_PASSWORD", "Administrator Password");

define("ADMIN_CONF_EMAIL", "Administrator Email");

/***** STEP 10 *****/
define("END_CONGRATULATIONS", "Congratulations! Setup completed successfully.");

define("END_WARNING", "Be sure to delete the file <b>install.php</b> and directory <b>install</b>. Reinstalling may damage the system.");

define("END_GO_TO_ADMIN_PANEL", "Sign in the admin panel");

define("END_GO_TO_SITE", "Go to site");

define("END_DELTE_INSTALL_FILES", "Delete files installer automatically");

define("END_REDIRECT_TO_ADMIN_PANEL", "redirection in the admin panel");

define("MESSAGE_DELTE_INSTALL_FILES", "Setup file will be deleted! Recover files after the removal would be impossible.");

define("END_CONFIGURE_HTACCESS", "Configure file .htaccess");

define("END_ENABLE_REWRITEBASE", "Enable &quot;RewriteBase /&quot;");

define("END_ENABLE_PHPERRORS_PRINT", "Enable output PHP-errors");

define("END_ENABLE_PHPERRORS_LOG", "Enable logging of PHP-errors");

define("END_FILE_PHPERRORS_LOG", "The path to the log file");

define("END_RESTRICT_FILE_PHPERRORS_LOG", "Restrict access to log file");

define("END_RESTRICT_FILE_HTACCESS", "Restrict access to .htaccess file");

define("END_NOT_CHANGE_CONFIG", "Do not change the settings if you do not know what they mean");

define("END_HTACCESS_SUCCESSFULLY_CREATED", ".htaccess file is successfully created!");