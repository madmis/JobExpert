<?php
/********************************************************
	JobExpert v1.0
	powered by Script Developers Group (SD-Group)
	email: info@sd-group.org.ua
	url: http://sd-group.org.ua/
	Copyright 2010-2015 (c) SD-Group
	All rights reserved
=========================================================
		Eng - Forms
********************************************************/
/**
* @package
* @todo
*/

(!defined('SDG')) ? die ('Triple protection!') : null;

/*** КНОПКИ ***/
define("FORM_BUTTON_SAVE", "Save");

define("FORM_BUTTON_SEND", "Send");

define("FORM_BUTTON_LOGIN", "Login");

define("FORM_BUTTON_EXECUTE", "Run");

define("FORM_BUTTON_CONTINUE", "Continue");

define("FORM_BUTTON_UPLOAD", "Upload");

define("FORM_BUTTON_DELETE", "Delete");

define("FORM_BUTTON_ADD", "Add");

define("FORM_BUTTON_ADD_LANG_CONST_CUSTOM", "To add a custom language constants");

define("FORM_BUTTON_DELETE_LANG_CONST_CUSTOM", "Removing a custom language constants");

define("FORM_BUTTON_ADD_GROUP", "Add group");

define("FORM_BUTTON_DELETE_USER", "Delete user");

define("FORM_BUTTON_EDIT_USER", "Change user data");

define("FORM_CAPTCHA_REFRESH", "Refresh code");

define("FORM_BUTTON_SETUP", "Set");

define("FORM_RESET", "Reset");

define("FORM_BUTTON_NEXT", "Next");

define("FORM_BUTTON_PREV", "Back");

define("FORM_BUTTON_CREATE_BACKUP_SITE", "Make a backup copy of your site");

define("FORM_BUTTON_CREATE_BACKUP_DB", "Make aa backup of of the database");

define("FORM_BUTTON_CONTINUE_THE_UPDATE", "Continue to install updates");

define("FORM_BUTTON_DEFAULT", "Default");

/*** ТИПЫ ПОЛЬЗОВАТЕЛЕЙ ***/
define("FORM_TYPE_AGENT", "Agent");

define("FORM_TYPE_COMPANY", "Company");

define("FORM_TYPE_EMPLOYER", "Employer");

define("FORM_TYPE_COMPETITOR", "Competitor");

define("FORM_TYPE_NOT_DEFINE", "Not defined");

/*** ПОДПИСИ ***/
define("FORM_IMG_HELP", "Help");

define("FORM_FILE_NAME", "File name");

/*** ФОРМА ВХОДА АДМИНИСТРАТОРА ***/
define("FORM_ADMIN_LOGIN_HEAD", "Login to admin panel");

define("FORM_LOGIN", "Login");

define("FORM_PASSWORD", "Password");

/*** ДЕЙСТВИЯ ***/
define("FORM_ACTION_SELECT", "Select action...");

define("FORM_ACTION_ARCHIVE", "Placed in the archive");

define("FORM_ACTION_EXTRACT", "Extract from the archive");

define("FORM_ACTION_SAVE_CHANGE", "Save сhanges");

define("FORM_ACTION_SHOW_SELECTED", "Display selected");

define("FORM_ACTION_HIDE_SELECTED", "Hide selected");

define("FORM_ACTION_SAVE_SORT", "Save Sort");

define("FORM_ACTION_DELETE", "Delete");

define("FORM_ACTION_DELETE_SELECTED", "Delete selected");

define("FORM_ACTION_ACTIVATE", "Activate");

define("FORM_ACTION_PAYMENT", "Send to pay");

define("FORM_ACTION_ACTIVATE_SELECTED", "Activate selected");

define("FORM_ACTION_CORRECTION", "Send to fix");

define("FORM_ACTION_EDIT", "Edit");

define("FORM_ACTION_INSTALL_SELECTED", "Install selected");

define("FORM_ACTION_DISABLE_SELECTED", "Disable selected");

define("FORM_ACTION_ENABLE_SELECTED", "Enable selected");

define("FORM_ACTION_CLEAR_LOGS", "Clear logs");

define("FORM_ACTION_DISPLAY_ON_MAIN", "Display on the main");

define("FORM_ACTION_REMOVE_FROM_MAIN", "Remove from the main");

define("FORM_ACTION_EDIT_VISIBILITY", "Change Type of accommodation");

/*** РАЗНОЕ ***/
define("FORM_IMP", "Not important");

define("FORM_YES", "Yes");

define("FORM_NO", "No");

define("FORM_SOURCE", "Source");

define("FORM_ALL", "All");

define("FORM_IMAGE", "Picture");

define("FORM_TITLE", "Title");

define("FORM_SUBJECT", "Subject");

define("FORM_TEXT", "Text");

define("FORM_SMALL_TEXT", "Summary text");

define("FORM_DATETIME", "Date and Time");

define("FORM_DATE", "Date");

define("FORM_TIME", "Time");

define("FORM_SET_NOW", "Set current");

define("FORM_RECORDS", "Records per page");

define("FORM_AUTHOR", "Author");

define("FORM_IN_ARCHIVE", "In archive");

define("FORM_ACTIVE", "Active");

define("FORM_VALID_UNTIL", "Valid until");

define("FORM_ARCHIVED", "Archived in the");

define("FORM_MOD_ON", "Enabled");

define("FORM_MOD_OFF", "Disabled");

define("FORM_MOD_NOT_INSTALL", "Not installed");

define('FORM_INPUT_OTHER', "Another...");

define('FORM_CONF_PERPAGE', "The number of entries displayed per page in the user part");

define('FORM_INCLUDE_FILES', "Attach files");

define("FORM_DATABASE", "Database");

define("FORM_DBHOST", "Host Database");

define("FORM_DBNAME", "Database Name");

define("FORM_DBUSER", "User Database");

define("FORM_DBPASSWORD", "User password database");

define("FORM_TABLES", "Tables");

define("FORM_ID", "ID");

define("FORM_ID_USER", "ID user");

define("FORM_PUBLICATION_DATE", "Publication Date");

define("FORM_PUBLICATION_TIME", "Publication Time");

define("FORM_COMMENTS", "Comments");

define("FORM_ADMIN_COMMENTS", "Remarks of the Administrator");

define("FORM_ORDER_ID", "Payment Number");

define('FORM_USER_BIRTHDAY', "Date of Birth");

define('FORM_NO_COMMENTS', 'Deny add comments');

/*** ФОРМА НАСТРОЕК САЙТА ***/
define("FORM_TITLE_SITE", "TITLE site");

define("FORM_META_DATA", "META-data");

define("FORM_DESCRIPTION", "META DESCRIPTION");

define("FORM_KEYWORDS", "META KEYWORDS");

define("FORM_CHARSET", "The encoding used on the site");

define("FORM_LANGUAGE", "Language Default Site");

define("FORM_TEMPLATE", "Current template");

define("FORM_SITE_NAME", "Site name");

define("FORM_SITE_NAME_TO_TITLE", "Add site name in a TITLE page");

define("FORM_TITLE_PAGE_SEPERATOR", "The string delimiter for the TITLE page");

define("FORM_SITE_URL", "Site URL");

define("FORM_SCRIPT_URL", "URL Script");

define("FORM_USE_VISUAL_EDITOR", "Use the visual editor");

define("FORM_ENABLE_CACHING", "Enable caching");

define("FORM_ENABLE_CACHING", "Disable automatically recounters");

define("FORM_ENABLE_CHPU", "Enable Friendly URL");

define("FORM_ENABLE_TRANSLITERATION_CHPU", "Enable transliteration FURL");

define("FORM_TRANSLITERATION_CHPU_ID_PUT_TO_END", "Placing the entry ID in the URL transliteration NC");

define("FORM_TRANSLITERATION_CHPU_MAX_LENGHT", "The maximum string length for transliteration FURL (symbols)");

define("FORM_USE_REDIRECT_EXTERNAL_LINK", "Removing a custom language constants");

define("FORM_CHPU_HTML_DATA_EXT", "FURL - extension for HTML pages with data");

define("FORM_CHPU_XML_DATA_EXT", "FURL - extension for the pages with XML data");

define("FORM_PLACE_AT_FIRST", "At first");

define("FORM_PLACE_AT_CLOSE", "At close");

/*** ФОРМА НАСТРОЕК ДАТЫ И ВРЕМЕНИ ***/
define("FORM_DATE_FORMAT", "Date Format");

define("FORM_TIME_FORMAT", "Time Format");

/*** ФОРМА НАСТРОЕК БЕЗОПАСНОСТИ ***/
define("FORM_CAPTCHA", "Use protection against spam bots (Captcha)");

define("FORM_SQLERR_LOG", "Benefit from logging errors sql-query");

define("FORM_SQLERR_PRINT", "Outputs error sql-query in the browser");

define("FORM_SQLERR_SEND_MESS", "Send email when an error sql-query");

define("FORM_SQLERR_EMAIL", "E-mail, which sent a letter, when an error sql-query");

define("FORM_ADMIN_ACCESS_IP_LIST", "List of IP-addresses to access the admin panel");

define("FORM_ADMIN_ACCESS_IP_LIST_ADD", "Add IP-address to the list");

define("FORM_ADMIN_ACCESS_IP_LIST_DELETE", "Remove IP-address from the list");

/*** ФОРМА НАСТРОЕК ПОЧТЫ ***/
define("FORM_MAIL_METHOD", "A method of sending mail");

define("FORM_MAIL_FORMAT", "Format to send email");

define("FORM_MAIL_ADMIN_EMAIL", "E-Mail address of the administrator");

define("FORM_MAIL_SMTP_HOST", "SMTP host");

define("FORM_MAIL_SMTP_PORT", "SMTP port");

define("FORM_MAIL_SMTP_USER", "SMTP user");

define("FORM_MAIL_SMTP_PASS", "SMTP password");

/*** ФОРМА НАСТРОЕК РЕГИСТРАЦИИ ПОЛЬЗОВАТЕЛЕЙ ***/
define("FORM_COMPETITOR_REGISTER_DEFAULT_GROUP", "Group COMPETITOR default (after registration)");

define("FORM_EMPLOYER_REGISTER_DEFAULT_GROUP", "Group EMPLOYER default (after registration)");

define("FORM_AGENT_REGISTER_DEFAULT_GROUP", "Group AGENT default (after registration)");

define("FORM_COMPANY_REGISTER_DEFAULT_GROUP", "Group COMPANY default (after registration)");

define("FORM_TYPE_GUEST_RIGHTS", "Unregistered users can:");

define("FORM_TYPE_GUEST_RIGHTS_ADD_VACANCY", "add vacancy");

define("FORM_TYPE_GUEST_RIGHTS_ADD_RESUME", "add resume");

define("FORM_USER_REGISTER", "Use the registration site");

define("FORM_USER_ACTIVATE", "Use the activation e-mail user");

define("FORM_USER_ACTIVATE_DELETE", "Specify the number of hours, after which the user will be deleted if not activated email");

define("FORM_MAIL_ADMIN_USER_REGISTER", "Report the successful registration of new user an administrator");

define("FORM_REGISTER_USER_PASSWORD", "Minimum number of characters in the user's password");

/*** ФОРМА НАСТРОЕК SMARTY ***/
define("FORM_SMARTY_DIR", "Full path to the files Smarty");

define("FORM_TEMPLATE_ROOT_DIR", "Directory of default templates");

define("FORM_TEMPLATE_COMPILE_DIR", "Directory with compiled templates");

define("FORM_TEMPLATE_DEBUGGING", "Show debugger window templates");

define("FORM_TEMPLATE_COMPILE_CHECK", "Recompile a template if it has changed");

define("FORM_TEMPLATE_FORCE_COMPILE", "Forcing recompile templates");

/*** ФОРМА НАСТРОЕК СЕРВЕРА ***/
define("FORM_SERVER_ROOT_DIR", "The path to the directory with the script");

/*** ФОРМА НАСТРОЕК ЗАГРУЗКИ ФАЙЛОВ ***/
define("FORM_FILES_MAX_SIZE", "Maximum file size (in Kb)");

define("FORM_FILES_IMG_CREATE_WATERMARK", "Use watermarks");

define("FORM_FILES_IMG_CREATE_WATERMARK_ON", "Apply a watermark image");

define("FORM_FILES_IMG_WATERMARK_ALIGNMENT", "The location of the watermark");

define("FORM_FILES_IMG_WATERMARK_TYPE", "Type of watermark");

define("FORM_FILES_IMG_WATERMARK", "Watermark");

define("FORM_FILES_IMG_WATERMARK_FONT", "Text Font");

define("FORM_FILES_IMG_WATERMARK_FONT_SIZE", "Font Size");

define("FORM_FILES_IMG_WATERMARK_FONT_COLOR", "Font color");

define("FORM_FILES_IMG_WATERMARK_TRANSPARENT", "Transparency font");

/*** ФОРМА НАСТРОЕК ПЛАТНЫХ УСЛУГ ***/
define("FORM_PAYMENTS_TARIFF_HEAD", "Rate schedule");

define("FORM_PAYMENTS_REGISTER", "Register");

define("FORM_PAYMENTS_REGISTER_AGENT", "Register &quot;Agent&quot;");

define("FORM_PAYMENTS_REGISTER_COMPANY", "Register &quot;Company&quot;");

define("FORM_PAYMENTS_REGISTER_EMPLOYER", "Register &quot;Employer&quot;");

define("FORM_PAYMENTS_REGISTER_COMPETITOR", "Register &quot;Competitor&quot;");

define("FORM_PAYMENTS_ADD_ANNOUNCE", "Placing new ann.");

define("FORM_PAYMENTS_SET_VIP", "VIP-status ann.");

define("FORM_PAYMENTS_SET_HOT", "HOT-status ann.");

define("FORM_PAYMENTS_SET_RATE", "Rating ann.");

define("FORM_PAYMENTS_SUBSCRIPTIONS", "Subscription on new ann.");

define("FORM_PAYMENTS_TRN_ADD", "Adding");

define("FORM_PAYMENTS_TRN_ADD_COMPANY", "training company");

define("FORM_PAYMENTS_TRN_ADD_TRAINER", "trainer");

/*** ФОРМА НАСТРОЕК RSS ***/
define("FORM_RSS_NEWS_COUNT", "Number of news per page RSS");

define("FORM_RSS_ARTICLES_COUNT", "Number of articles per page RSS");

define("FORM_RSS_VACANCY_COUNT", "Number of vacancies per page RSS");

define("FORM_RSS_RESUME_COUNT", "Number of resumes on the page RSS");

/**
 * ФОРМА НАСТРОЕК YVL
 */
define("FORM_YVL_EXPORT_PERIOD", "Number of days for which to display ads");

/*** ФОРМЫ НОВОСТЕЙ ***/
define("FORM_NEWS_PERPAGE", "Specify the number of entries displayed in the browse list of all the news");

define("FORM_NEWSES_LAST_SHOW", "Display a list of the latest news on the home page");

define("FORM_NEWSES_COMMENTS", "Allow to post comments on the news");

define("FORM_NEWSES_COMMENTS_REGISTER", "Comments can be added only for members");

define("FORM_NEWSES_COMMENTS_NAME_UNREGISTER", "The name displayed in the comments when add not members");

define("FORM_NEWSES_LAST_SHOW_PERPAGE", "Specify the number of entries displayed in the list/block the latest news");

define("FORM_CONF_NEWSES_CORRECTION_THERM", "Waiting period for correcting News (hours)");

define("FORM_MODERATE_NEWS_COMMENTS", "In the field, enter comments on the news. <br> - when you send news of correction, comment will be saved. Later the user can edit the article based on the comments. <br> - when deleting news, comments will be sent to the user in the letter.");

define("FORM_NEWSES_TITLE", "Display in the TITLE page only name news");

/*** МОДЕРАЦИЯ ***/
define("FORM_MODERATE_NOTIFICATION", "Send notification to the Email-address");

/*** ФОРМЫ ДОПОЛНИТЕЛЬНЫХ СТРАНИЦ ***/
define("FORM_DOP_PAGE_ID", "The ID of the additional pages");

define("FORM_DOP_PAGE_NAME", "Title page");

define("FORM_DOP_PAGE_TEXT", "The text of the page");

define("FORM_DOP_PAGE_SHOW", "Show Page");

/*** ФОРМЫ ГРУПП ***/
define("FORM_GROUP_NAME", "Group Name");

define("FORM_GROUP_RIGHT_EDIT_VACANCY", "Editing vacancy");

define("FORM_GROUP_RIGHT_DEL_VACANCY", "Delete vacancy");

define("FORM_GROUP_RIGHT_EDIT_RESUME", "Edit resume");

define("FORM_GROUP_RIGHT_DEL_RESUME", "Delete resume");

define("FORM_GROUP_RIGHT_ADD_ARTICLES", "Add articles");

define("FORM_GROUP_RIGHT_EDIT_ARTICLES", "Edit articles");

define("FORM_GROUP_RIGHT_ARC_ARTICLES", "Archive articles");

define("FORM_GROUP_RIGHT_DEL_ARTICLES", "Delete articles");

define("FORM_GROUP_RIGHT_ADD_NEWS", "Add news");

define("FORM_GROUP_RIGHT_EDIT_NEWS", "Edit news");

define("FORM_GROUP_RIGHT_ARC_NEWS", "Archive news");

define("FORM_GROUP_RIGHT_DEL_NEWS", "Delete news");

define("FORM_GROUP_RIGHT_ADD_TRN_COMPANY", "Add training company");

define("FORM_GROUP_RIGHT_ADD_TRN_TRAINER", "Add trainer");

define("FORM_GROUP_RIGHT_ADD_TRN_TRAINING", "Add training");

define("FORM_GROUP_RIGHT_EDIT_TRN_TRAINING", "Edit training");

define("FORM_GROUP_RIGHT_ARC_TRN_TRAINING", "Archive training");

define("FORM_GROUP_RIGHT_DEL_TRN_TRAINING", "Delete training");

define("FORM_GROUP_RIGHT_ADD_TRN_ARTICLES", "Add articles training company");

define("FORM_GROUP_RIGHT_EDIT_TRN_ARTICLES", "Edit articles training company");

define("FORM_GROUP_RIGHT_ARC_TRN_ARTICLES", "Archive articles training company");

define("FORM_GROUP_RIGHT_DEL_TRN_ARTICLES", "Delete articles training company");

define("FORM_GROUP_RIGHT_ADD_TRN_NEWS", "Add news training company");

define("FORM_GROUP_RIGHT_EDIT_TRN_NEWS", "Edit news training company");

define("FORM_GROUP_RIGHT_ARC_TRN_NEWS", "Archive news training company");

define("FORM_GROUP_RIGHT_DEL_TRN_NEWS", "Delete news training company");

define("FORM_GROUP_RESP_MODER_ACCOUNT", "Moderation account");

define("FORM_GROUP_RESP_ACT_VACANCY", "Activate vacancy");

define("FORM_GROUP_RESP_ACT_RESUME", "Activate resume");

define("FORM_GROUP_RESP_MODER_VACANCY", "Moderation vacancy");

define("FORM_GROUP_RESP_MODER_RESUME", "Moderation resume");

define("FORM_GROUP_RESP_MODER_ARTICLES", "Moderation articles");

define("FORM_GROUP_RESP_MODER_NEWS", "Moderation news");

define("FORM_GROUP_RESP_MODER_TRN_COMPANY", "Moderation training company");

define("FORM_GROUP_RESP_MODER_TRN_TRAINER", "Moderation trainer");

define("FORM_GROUP_RESP_MODER_TRN_TRAINING", "Moderation trainings");

define("FORM_GROUP_RESP_MODER_TRN_ARTICLES", "Moderation articles training company");

define("FORM_GROUP_RESP_MODER_TRN_NEWS", "Moderation news training company");

/*** ФАЙЛ-МЕНЕДЖЕР ***/
define("FORM_FILEMANAGER_THUMBNAIL_WIDTH", "The maximum width icon");

define("FORM_FILEMANAGER_THUMBNAIL_HEIGHT", "The maximum height icon");

/*** СТАТЬИ ***/
define("FORM_DICTIONARY_ART_SECTIONS_AFFILIATION_ALL", "Visible to all");

define("FORM_ARTICLES_SECTION", "Section");

define("FORM_CONF_ARTICLES_ADD_SUCCESS_ADMIN_INFORM", "Notice on the Email-address of the administrator was added successfully Article");

define("FORM_CONF_ARTICLES_ADD_MODERATION_ADMIN_INFORM", "Notice on the Email-address of the Administrator when you receive articles on moderation");

define("FORM_CONF_ARTICLES_CORRECTION_THERM", "Waiting period for correcting papers (hours)");

define("FORM_MODERATE_ARTICLES_COMMENTS", "In the field, enter comments on the article. <br> - sending articles of correction, comment will be saved. Later the user can edit the article with the comments. <br> - deleting articles, comments will be sent to the user in the letter.");

define("FORM_CONF_ARTICLES_COMMENTS", "Allow to post comments on the articles");

define("FORM_CONF_ARTICLES_COMMENTS_REGISTER", "Comments can be added only for members");

define("FORM_CONF_ARTICLES_COMMENTS_NAME_UNREGISTER", "The name displayed in the comments when add not members");

define("FORM_CONF_ARTICLES_TITLE", "In the TITLE page display");

define("FORM_CONF_ARTICLES_TITLE_SECTION_SITE", "Name section of the site");

define("FORM_CONF_ARTICLES_TITLE_SECTION_ARTICLE", "Name section of the article");

define("FORM_CONF_ARTICLES_TITLE_ARTICLE_NAME", "Name of article");

/*** Словари - Разделы/Регионы ***/
define("FORM_SECTION_INPUT_ADD", "Add Section");

define("FORM_PROFESSION_INPUT_ADD", "Add Professy");

define("FORM_REGION_INPUT_ADD", "Add Region");

define("FORM_CITY_INPUT_ADD", "Add City");

define("FORM_ACTION_SETCAPITAL", "Save the value of capital");

define("FORM_ACTION_RESETCAPITAL", "Reset the value of the capital");

/*** Словари - Списки ***/
define("FORM_SELECT_LANGUAGE", "Localization");

define("FORM_DICT_INPUT_ADD", "Add an additional list");

define("FORM_DICT_INPUT_EDIT", "Edit list");

define("FORM_DICT_VALUE_INPUT_ADD", "Add Value");

define("FORM_DICT_VALUE_INPUT_DELETE", "Delete the value");

/*** ФОРМЫ ПОЛЬЗОВАТЕЛЕЙ ***/
define("FORM_USERS_DATA", "User data");

define("FORM_USERS_COMPANY_DATA", "Company data");

define("FORM_USERS_ACTIONS", "Actions");

define("FORM_USERS_DATA_ID", "ID-User");

define("FORM_USERS_DATA_EMAIL", "E-mail");

define("FORM_USERS_DATA_PASSWORD", "Password");

define("FORM_USERS_DATA_TYPE", "Type");

define("FORM_USERS_DATA_GROUP", "Group");

define("FORM_USERS_DATA_REG_DATETIME", "Register date");

define("FORM_USERS_DATA_ALIAS", "Alias");

define("FORM_USERS_DATA_REG_IP", "IP");

define("FORM_USERS_DATA_FIRST_NAME", "Name");

define("FORM_USERS_DATA_LAST_NAME", "Surname");

define("FORM_USERS_DATA_MIDDLE_NAME", "Patronymic");

define("FORM_USERS_DATA_GENDER", "Gender");

define("FORM_USERS_DATA_BIRTHDAY", "Date of Birth");

define("FORM_USERS_DATA_PHONE", "Phone");

define("FORM_USERS_DATA_ADDITION_PHONE", "Additional phone");

define("FORM_USERS_DATA_TOKEN", "Status");

define("FORM_USERS_DATA_COMPANY_NAME", "Company name");

define("FORM_USERS_DATA_COMPANY_CITY", "Company city (location)");

define("FORM_USERS_DATA_COMPANY_DESCRIPTION", "Company description");

define("FORM_USERS_DATA_COMPANY_LOGO", "Company logo");

define("FORM_USERS_DATA_COMPANY_URL", "Company site");

define("FORM_USERS_DATA_COMPANY_NOLOGO", "Not logo");

define("FORM_USERS_DATA_DELETE_USER_ARTICLES", "Delete user articles");

define("FORM_USERS_DATA_DELETE_USER_NEWS", "Delete user news");

define("FORM_USERS_DATA_SEND_EMAIL_ABOUT_ACTIVATE", "Send users a notice of activation!");

define("FORM_USERS_DATA_SEND_EMAIL_ABOUT_ADD", "Send Notification");

define("FORM_CONF_USERS_STRINGS_PERPAGE_ADMIN_PANEL", "Specify the number of records per page are displayed in the tables in the admin panel");

define("FORM_CONF_USERS_NOT_TYPE_DELETE", "Delete an Account that have not selected the type, hours after");

define("FORM_CONF_USERS_PAYMENT_DELETE", "Remove the unpaid account as a gift through the hours");

define("FORM_CONF_USERS_CHANGE_NAME", "Allow user to change the name and surname");

/*** ФОРМЫ КОМПАНИЙ ***/
define("FORM_CONF_COMPANIES_PERPAGE", "The number of companies displayed on one page");

define("FORM_CONF_COMPANIES_SHOW_ONLY_WITH_LOGO", "Show in list only those companies that have the logo");

define("FORM_CONF_COMPANIES_DELETE_LOGO", "Allow companies to remove their logo");

define("FORM_CONF_COMPANIES_USE_VISUAL_EDITOR", "Allow companies to use html in the description");

define("FORM_CONF_COMPANIES_SHOW_MAIN_LOGO", "Display company logos on the main");

define("FORM_CONF_COMPANIES_SHOW_MAIN_LOGO_QTY", "Specify the number of logos that appear on the primary in a row");

/*** ФОРМЫ ОБЪЯВЛЕНИЙ ***/
define("FORM_CONF_ANNOUNCES_ADD_SUCCESS_ADMIN_INFORM", "Notice on the Email-address of the Administrator of the successful addition of a new ann.");

define("FORM_CONF_ANNOUNCES_ADD_SUCCESS_USER_INFORM", "Notice on the Email-address of the user about the successful addition of a new ann.");

define("FORM_CONF_ANNOUNCES_ADD_OTHER_CITY", "Allow users to add their city on the survey form adding ads");

define("FORM_CONF_ANNOUNCE_USE_VISUAL_EDITOR", "Authorize the use of HTML-code when filling out adding ann.");

define("FORM_CONF_ANNOUNCES_PREVIEW", "Enable preview form to add new ann.");

define("FORM_CONF_ANNOUNCES_PERPAGE_SITE", "Specify the number of ann. displayed on one page, the user of the");

define("FORM_CONF_ANNOUNCES_PERPAGE_ADMIN_PANEL", "Specify the number of ann. displayed on one page in the admin panel");

define("FORM_CONF_ANNOUNCES_CATEGORY_PERLINE", "Number of columns to display");

define("FORM_CONF_EMAIL_ATTACHMENT_FILES_ALLOW", "Allow to attach files to e-mail messages");

define("FORM_CONF_EMAIL_ATTACHMENT_MAX_FILES", "The maximum number of attachment files");

define("FORM_CONF_EMAIL_ATTACHMENT_FILE_MAX_SIZE", "The maximum size of attached file (KB)");

define("FORM_CONF_ANNOUNCES_VACANCY_ACTIVATE_THERM", "Waiting period for activation Vacancy Email-address (hours)");

define("FORM_CONF_ANNOUNCES_RESUME_ACTIVATE_THERM", "Waiting period for activating Resume Email-address (hours)");

define("FORM_CONF_ANNOUNCES_VACANCY_PAYMENT_THERM", "Waiting period for payment of the newly added Vacancy (hours)");

define("FORM_CONF_ANNOUNCES_RESUME_PAYMENT_THERM", "Waiting period for payment of the newly added Resume (hours)");

define("FORM_CONF_ANNOUNCES_VACANCY_CORRECTION_THERM", "Waiting period for correction Vacancy (hours)");

define("FORM_CONF_ANNOUNCES_RESUME_CORRECTION_THERM", "Waiting period for correcting Resume (hours)");

define("FORM_CONF_ANNOUNCES_VACANCY_VIP_THERM", "Validity of VIP status for the Vacancy (hours)");

define("FORM_CONF_VACANCY_VIP_SHOW", "Display VIP-Vacancy on the home page");

define("FORM_CONF_VACANCY_VIP_SHOW_PERPAGE", "Specify the number of visible VIP-Vacancy");

define("FORM_CONF_ANNOUNCES_VACANCY_HOT_THERM", "Validity status for HOT Vacancy (hours)");

define("FORM_CONF_VACANCY_HOT_SHOW_PERPAGE", "Specify the number of displayed HOT-Vacancy");

define("FORM_CONF_VACANCY_LAST_SHOW", "Display the latest Vacancy on the home page");

define("FORM_CONF_VACANCY_LAST_SHOW_PERPAGE", "Specify the number of shows the last Vacancy");

define("FORM_CONF_ANNOUNCES_RESUME_VIP_THERM", "Validity of VIP status for the Resume (hours)");

define("FORM_CONF_ANNOUNCE_USER_AGREEMENT_NOMEMBERS_REQUIRED", "Show User Agreement for unregistered users");

define("FORM_CONF_RESUME_VIP_SHOW", "Display VIP-Resume on the main page");

define("FORM_CONF_RESUME_VIP_SHOW_PERPAGE", "Specify the number of visible VIP-Resume");

define("FORM_CONF_ANNOUNCES_RESUME_HOT_THERM", "Validity status for HOT Resume (hours)");

define("FORM_CONF_RESUME_HOT_SHOW_PERPAGE", "Specify the number of displayed HOT-Resume");

define("FORM_CONF_RESUME_LAST_SHOW", "Show the most recent Resume on the main page");

define("FORM_CONF_RESUME_LAST_SHOW_PERPAGE", "Indicate the number last displayed Resume");

define("FORM_CONF_RESUME_ADD_PHOTO", "Allow me to upload photographs to Resume");

define("FORM_CONF_RESUME_ADD_PHOTO_RESOLUTION_CONV", "Specify the dimensions for attaching photographs [width] x [height]");

define("FORM_CONF_RESUME_ADD_PHOTO_FILE_MAXSIZE", "Specify the maximum file size for downloadable photographs in kilobytes");

/*** ФОРМЫ ПОДПИСОК ***/
define("FORM_CONF_SUBSCRIPTIONS_FREE", "The number of available (free) subscriptions Users");

define("FORM_CONF_SUBSCRIPTIONS_PAYMENT_DELETE", "Remove unpaid subscriptions through hours");

define("FORM_CONF_SUBSCRIPTIONS_ANNOUNCE_PERIOD", "Frequency of mailing subscription, added to the declaration");

define("FORM_CONF_SUBSCRIPTIONS_START_TIME", "Start time list of ann.");

/*** ФОРМЫ СЕРВИСА ***/
define("FORM_CONF_ADMINISTRATION_MAINTENANCE", "Disable the site for maintenance");

define("FORM_CONF_ADMINISTRATION_MANUAL_CONTROL", "Manual control site database");

define("FORM_CONF_ADMINISTRATION_ROBOT_CONTROL", "Robotic database management site");

define("FORM_CONF_ADMINISTRATION_ROBOT_RUNNING", "Perform robotic control in automatic mode");

define("FORM_CONF_ADMINISTRATION_ROBOT_RUNNING_TERM", "Specify the frequency of running robot");

define("FORM_CONF_ADMINISTRATION_ROBOT_RUNNING_FIRSTTIME", "Specify the first run the robot");

define("FORM_CONF_ADMINISTRATION_UPDATE_COUNTERS", "Recount readings for all counters on the site");

define("FORM_CONF_ADMINISTRATION_DELETE_NONVERIFY_USERS", "Removing users have not undergone verification Email-address");

define("FORM_CONF_ADMINISTRATION_DELETE_NONTYPE_USERS", "To remove users who have not completed the registration");

define("FORM_CONF_ADMINISTRATION_DELETE_UNPAID_USERS", "Deleting users do not pay for the registration");

define("FORM_CONF_ADMINISTRATION_DELETE_NONVERIFY_ANNOUNCES", "Removing ads did not pass the verification of Email-addresses");

define("FORM_CONF_ADMINISTRATION_DELETE_UNPAID_ANNOUNCES", "Removing ad expired payment for this");

define("FORM_CONF_ADMINISTRATION_DELETE_UNPAID_SUBSCRIPTIONS", "Delete subscriptions users with an expired payment for this");

define("FORM_CONF_ADMINISTRATION_RESET_TEMP_COUNTERS_LIFE_OVER", "Zeroing temporary counters ann.");

define("FORM_CONF_ADMINISTRATION_DELETE_ANNOUNCES_STORAGE_LIFE_OVER", "Removing ann. expired placement");

define("FORM_CONF_ADMINISTRATION_ARCHIVED_ANNOUNCES_STORAGE_LIFE_OVER", "Archiving ann. expired placement");

define("FORM_CONF_ADMINISTRATION_RESET_VIP_STORAGE_LIFE_OVER", "Zeroing VIP-status ann. expired");

define("FORM_CONF_ADMINISTRATION_RESET_HOT_STORAGE_LIFE_OVER", "Zeroing HOT-status ann. expired");

define("FORM_CONF_SERVICE_DESIGNER_ADVERTISEMENT_TOP", "The top ad unit");

define("FORM_CONF_SERVICE_DESIGNER_HEAD", "Cap site");

define("FORM_CONF_SERVICE_DESIGNER_LEFT_SIDE", "The left panel");

define("FORM_CONF_SERVICE_DESIGNER_CENTER_SIDE", "The central panel");

define("FORM_CONF_SERVICE_DESIGNER_RIGHT_SIDE", "The right panel");

define("FORM_CONF_SERVICE_DESIGNER_FOOT", "Footer");

define("FORM_CONF_SERVICE_DESIGNER_ADVERTISEMENT_BOTTOM", "Bottom ad unit");

define("FORM_CONF_SERVICE_DESIGNER_ADVERTISEMENT", "Ad Unit");

define("FORM_CONF_EDITOR_TEMPLATES_LIST", "Template");

define("FORM_CONF_EDITOR_TEMPLATE_TPL_TAB_NAME", "Template Files");

define("FORM_CONF_EDITOR_TEMPLATE_CSS_TAB_NAME", "Style files");

define("FORM_CONF_EDITOR_TEMPLATE_PICS_TAB_NAME", "Image Files");

define("FORM_CONF_EDITOR_TEMPLATE_TPL_FILES_LIST", "Template file");

define("FORM_CONF_EDITOR_TEMPLATE_CSS_FILES_LIST", "Style file");

define("FORM_EDITOR_TEMPLATE_CLONE_BUTTON_TITLE", "Cloning a Template");

define("FORM_EDITOR_TEMPLATE_CLONE_TITLE", "Cloning a Template");

define("FORM_EDITOR_TEMPLATE_FIELD_NAME", "Template Name");

define("FORM_EDITOR_TEMPLATE_CSS_INCLUDE", "Include the style files");

define("FORM_EDITOR_TEMPLATE_PICS_INCLUDE", "Include image files");

define("FORM_EDITOR_TEMPLATE_FILES_CREATE_EMPTY", "Create a blank template files <em>(*.tpl)</em>");

define("FORM_EDITOR_TEMPLATE_CHECK_LIST_FILES_BUTTON_TITLE", "Get the file list changes from the template default");

define("FORM_EDITOR_TEMPLATE_DELETE_BUTTON_TITLE", "Remove the template");

define("FORM_EDITOR_TEMPLATE_DELETE_TITLE", "Removing a template");

define("FORM_EDITOR_TEMPLATE_CSS_FILES_ADD_BUTTON_TITLE", "Add a new stylesheet to the list");

define("FORM_EDITOR_TEMPLATE_CSS_FILES_ADD_TITLE", "Adding a new CSS file in the list");

define("FORM_EDITOR_TEMPLATE_CSS_FILES_DELETE_BUTTON_TITLE", "Delete current file from the list of styles");

define("FORM_EDITOR_TEMPLATE_CSS_FILES_DELETE_TITLE", "Deleting a file from the list of styles");

define("FORM_CONF_EDITOR_TEMPLATE_CREATE_SUCCESS_TITLE", "Template created successfully");

define("FORM_CONF_EDITOR_TEMPLATE_CREATE_SUCCESS_MESSAGE", "Now, you will automatically be moved to a new template management page");

/*** ФОРМА НАСТРОЕК ЛОГОВ ***/
define("FORM_CONF_LOGS_ADMIN", "Benefit from logging entries in the admin panel");

/*** ФОРМЫ ШАБЛОНОВ ПОЧТОВЫХ СООБЩЕНИЙ ***/
define("FORM_MAIL_TEMPLATES_FILE", "Picture message template");

/*** ФОРМА ОБНОВЛЕНИЙ ПРОДУКТА ***/
define("FORM_SYSTEM_UPDATES_LOGIN", "Login (to the forum sd-group)");

define("FORM_SYSTEM_UPDATES_PASSWORD", "Password (from the forum sd-group)");

define("FORM_CONF_UPDATES_PATH_TO_FILES", "The path to the files (archives) update");

define("FORM_SYSTEM_UPDATES_UPDATE_DB", "Partial update databases and files");

define("FORM_SYSTEM_UPDATES_EXTRACT_FILES", "Extract Files");




/*** ФОРМА РЕЗЕРВНЫХ КОПИЙ ***/
define("FORM_CONF_BACKUPS_PATH_TO_FILES", "The path to the files (archives) backups");

/*** ФОРМА ИМПОРТ ***/
define("FORM_SYSTEM_IMPORT_WARNING", "WARNING! During data import, you can not close your browser and reload the page before the end of the process");

define("FORM_SYSTEM_IMPORT_DESCRIPTION", '<p style="font-weight: bold;">Data prepared for the imports.</p><p style="color: #FF0000;">WARNING! The process can take a long time! <br> During data import, you can not close your browser or reload the page before the end of the process.</p><p>Click <b>"Run"</b>to start importing data.</p>');

define("FORM_SYSTEM_IMPORT_CONTINUE_DESCRIPTION", '<p style="font-weight: bold; color: #FF0000;">Previous import operation was interrupted!</p><p style="font-weight: bold;">You can continue to import data from a breakpoint.</p><p>Recommend that you continue to use data import.</p><p style="color: #FF0000;">WARNING! The process can take a long time! <br> During data import, you can not close your browser or reload the page before the end of the process.</p><p>Click <b>"Continue"</b>to start importing data.</p>');

define("FORM_SYSTEM_IMPORT_DB_TITLE", "Database Import");

define("FORM_SYSTEM_IMPORT_DB_TO_COMPLETE_TIME", "estimated time of completion of import by");

define("FORM_SYSTEM_IMPORT_DB_COMPLETED", "process was successfully completed");

define("FORM_SYSTEM_IMPORT_TABLE_USERS", "Table Members");

define("FORM_SYSTEM_IMPORT_NAME_TABLE_USERS", "The name of the user table");

define("FORM_SYSTEM_IMPORT_TABLE_VACANCYS", "Table vacancy");

define("FORM_EDITOR_TEMPLATE_TPL_FILES_ADD_BUTTON_TITLE", "Add a new template file in the list");

define("FORM_EDITOR_TEMPLATE_TPL_FILES_ADD_TITLE", "Adding a new template file in the list");

define("FORM_EDITOR_TEMPLATE_TPL_FILES_DELETE_BUTTON_TITLE", "Delete the current template file from the list");

define("FORM_EDITOR_TEMPLATE_TPL_FILES_DELETE_TITLE", "Removal of the template file from the list");

define("FORM_EDITOR_TEMPLATE_TPL_FILE_FIELD_DESCRIPTION", "Description of the template file");

define("FORM_SYSTEM_IMPORT_NAME_TABLE_VACANCYS", "Name of the table vacancy");

define("FORM_SYSTEM_IMPORT_TABLE_RESUMES", "Table resume");

define("FORM_SYSTEM_IMPORT_NAME_TABLE_RESUMES", "Name of the table resume");

define("FORM_SYSTEM_IMPORT_TABLE_SECTIONS", "Partition Table");

define("FORM_SYSTEM_IMPORT_NAME_TABLE_SECTIONS", "Name the partition table");

define("FORM_SYSTEM_IMPORT_TABLE_PROFESSIONS", "Table Professions");

define("FORM_SYSTEM_IMPORT_NAME_TABLE_PROFESSIONS", "Name of the table jobs");

define("FORM_SYSTEM_IMPORT_TABLE_REGIONS", "Table Regions");

define("FORM_SYSTEM_IMPORT_NAME_TABLE_REGIONS", "Name of the table regions");

define("FORM_SYSTEM_IMPORT_TABLE_CITYS", "Table of Cities");

define("FORM_SYSTEM_IMPORT_NAME_TABLE_CITYS", "Name of the table cities");

define("FORM_SYSTEM_IMPORT_TABLE_SUBSRIPTIONS", "Table Subscriptions");

define("FORM_SYSTEM_IMPORT_NAME_TABLE_SUBSRIPTIONS", "Table Name subscriptions");

define("FORM_SYSTEM_IMPORT_TABLE_NEWS", "Table News");

define("FORM_SYSTEM_IMPORT_NAME_TABLE_NEWS", "Table Name News");


/*** ФОРМЫ РАССЫЛКИ ***/
define("FORM_MAILER_TEMPLATES_NEW", "New Template");

define("FORM_MAILER_SEND_ALL", "Send everyone (including those who have not subscribed to the list)");

define("FORM_MAILER_TEXT", "Text list");

define("FORM_ADD_LANG_CONST_CUSTOM_NAME", "Constant Name");

define("FORM_ADD_LANG_CONST_CUSTOM_VALUE", "Constant value");