<?php

/**
 * JobExpert v1.0
 * Powered by Script Developers Group (SD-Group)
 * Email: info@sd-group.org.ua
 * URL: http://sd-group.org.ua/
 * Copyright 2010-2015 (c) SD-Group
 * All rights reserved
 * ===================================================
 * English localization of Admin panel - Errors
 * ===================================================
 */
(!defined('SDG')) ? die('Triple protection!') : null;

define('ERROR_404', 'Error 404');

define('ERROR_404_DESCRIPTION', 'Page Not Found');

define('ERROR_404_MESSAGE_REQUIRED_PAGE', 'Requested page');

define('ERROR_404_MESSAGE_NOT_EXIST', 'not found');

define('ERROR_404_RECOMMENDATIONS', 'Recommendations');

define('ERROR_404_RECOMMENDATIONS_CHECK_URL', 'Check the spelling of the URL for this page.');

define('ERROR_404_RECOMMENDATIONS_BACK_TO', 'If problems still persist, go back to');

define('ERROR_404_RECOMMENDATIONS_BACK_TO_MAIN_PAGE_LINK', 'main page');

define('ERROR_404_RECOMMENDATIONS_BACK_TO_MAIN_PAGE', 'and choose your page in the menu');

define('ERROR_ACCESS_DENIED', 'Access denied!');

define('ERROR_CONNECT_DB', 'Do not remove connect to the database!');

define('ERROR_CAPTCHA', 'Entered an incorrect verification code!');

define('ERROR_NOT_SAVE_CHANGE', 'Unable to save your changes! Try again.');

define('ERROR_FATAL_NOT_SAVE_CHANGE', 'Fatal error: unable to save changes!');

define('ERROR_FATAL_UNCORRECT_PARAMS', 'Fatal error: invalid parameters obtained!');

define('ERROR_MISMATCH_FIELDS', 'Error! The discrepancy between the form fields with fields in the table!');

define('ERROR_REGION_MAJOR', 'Region-City: This type of region can not contain a list of cities!');

define('ERROR_REGION_SET_MAJOR', 'Unable to establish the status of Region-City!');

define('ERROR_REGION_DELETE_CHILD_RECORDS', 'Unable to clear the list of cities!');

define('ERROR_REGION_SET_ADD_CITY_ALLOWED', 'Unable to perform the action!');

define('ERROR_EMPTY_NAME', 'Do not fill in the name!');

define('ERROR_EMPTY_SECTION', 'Not select section!');

define('ERROR_EMPTY_TITLE', 'Not full title!');

define('ERROR_EMPTY_SUBJECT', 'Empty subject!');

define('ERROR_EMPTY_SMALL_TEXT', 'Not filled by a short text!');

define('ERROR_EMPTY_TEXT', 'Not full text!');

define('ERROR_DATETIME', 'Invalid date or time!');

define('ERROR_DATE_FORMAT', 'Invalid date format!');

define('ERROR_EMPTY_FIELD', 'Empty field!');

define('ERROR_EMPTY_FORM_FIELDS', 'All fields are required!');

define('ERROR_GROUP_ALPHA', 'Group name must contain only letters!');

define('ERROR_GROUP_EXISTS', 'This group already exists!');

define('ERROR_GROUP_NOT_EXISTS', 'This group does not exist!');

define('ERROR_USER_NOT_EXISTS', 'This user does not exist!');

define('ERROR_GROUP_NOT_SELECTED', 'Not selected group!');

define('ERROR_GROUP_SYSTEM_NOT_DELETE', 'This group is a system. System group can not be removed!');

define('ERROR_GROUP_USED_IN_CONFIG', 'This group can not be deleted because it is used in settings as the default group, when registering users! Сначала измение настройки групп, а затем снова попробуйте удалить группу из базы данных!');

define('ERROR_GROUP_SET_IN_USER', 'This group can not be removed, as there zaregistriovannye users who are in this group! First, change the group of those users, and then try to delete a group from the database!');

define('ERROR_EMPTY_ID', 'Not specified ID!');

define('ERROR_ID', 'Illegal ID!');

define('ERROR_EXISTS_ID', 'Page with that ID already exists!');

define('ERROR_DB_TYPE_QUERY_SELECT', 'Do not set the type of query (db::$dbTypeSelect = false), necessary to establish the correct value: (db::$dbTypeSelect = multi | single)');

define('ERROR_DB_LIMIT_QUERY_SELECT', 'Invalid parameter LIMIT in the query. Correct values: false or array(key: &quot;strLimit&quot; => val: string of LIMIT for example: &quot;0, 10&quot;, key: &quot;calcRows&quot; => val: true | false)');

define('ERROR_SECTION_NOT_EXISTS', 'This section does not exist!');

define('ERROR_NOT_SELECT_ACTION', 'You must choose the action!');

define('ERROR_DICT_SELECT_ALIAS_EXISTS', 'A list with this alias already exists!');

define('ERROR_DICT_SELECT_ALIAS_NOTEXISTS', 'List with the alias does not exist!');

define('ERROR_EMAIL_IS_EMPTY', 'Not specified Email-address!');

define('ERROR_PASSWORD_IS_EMPTY', 'No password specified!');

define('ERROR_PASSWORD_IS_SHORT', 'The password must contain at least ' . CONF_REGISTER_USER_PASSWORD . ' character!');

define('ERROR_USER_TYPE_IS_EMPTY', 'Do not select the user type or user type wrong!');

define('ERROR_USER_GROUP_IS_EMPTY', 'Not selected user group!');

define('ERROR_FIRST_NAME_IS_EMPTY', 'Not specified user name!');

define('ERROR_LAST_NAME_IS_EMPTY', 'Not specified user name!');

define('ERROR_PHONE_IS_EMPTY', 'Not specified Phone Users!');

define('ERROR_USER_NOT_ADDED', 'Unable to add user! Have a look at SQL-logs!');

define('ERROR_EMAIL_EXISTS', 'A user with this email-address already exists!');

define('ERROR_ANNOUNCE_NOT_EXISTS', 'Such announce does not exist!');

define('ERROR_MODS_PAYMENTS_TARIFFS_NOT_SAVE', 'Failed to save the tariff net! Maybe the file is not writable.');

define('ERROR_MODS_PAYMENTS_CONFIG_NOT_SAVE', 'Failed to save! Maybe the file is not writable.');

define('ERROR_NOT_SPECIFIED_DATA_FOR_CHANGE', 'Not specified data to change!');

define('ERROR_IP_EXISTS_IN_ACCESS_LIST', 'This IP-address is already in the list!');

define('ERROR_IP_NOTEXISTS_IN_ACCESS_LIST', 'This IP-address is not listed!');

define('ERROR_CLONE_TEMPLATE_EXSISTS', 'A template with that name already exists');

define('ERROR_CLONE_TEMPLATE_IS_EMPTY', 'Cloned template does not contain any files');

define('ERROR_CLONE_TEMPLATE_CREATE_DIR_FAILED', 'Error creating a new template directory.<br><br>Please check the permissions or contact your support.');

define('ERROR_DELETE_TEMPLATE_NAME_DEFAULT', 'Removing a template &quot;default&quot; - prohibited.');

define('ERROR_DELETE_TEMPLATE_CONF_DEFAULT', 'Removing a template used by default in the site settings - is prohibited.');

define('ERROR_DELETE_TEMPLATE_FAILED', 'Failure to remove the template.<br><br>Please check the permissions or contact your support.');

define('ERROR_CONST_LANG_CUSTOM_EXSISTS', 'Constant with that name already exists!');

define('ERROR_CONST_LANG_CUSTOM_NOEXSISTS', 'Constant with that name does not exist!');

define('ERROR_UNABLE_TO_RETRIEVE_DATA', 'ERROR! Unable to retrieve data!');

define('ERROR_COULD_NOT_FOUND_RECORD_TO_UPDATE', 'ERROR! Could not found record to update!');

define('ERROR_UNDEFINED', 'Unknown error!');

define('ERROR_USER_REQUIRED_FIELDS_IS_EMPTY', 'ERROR! Not filled in all required fields profile!');


/***** Обработка файлов *****/
define('ERROR_FILE_NOT_FOUND', 'ERROR! File not found!');

define('ERROR_FILE_NOT_SAVED', 'ERROR! Unable to save file!');

define('ERROR_FILE_NOT_OPEN', 'ERROR! Could not open file!');

define('ERROR_FILE_NOT_WRITE', 'ERROR! Could not write file!');

define('ERROR_FILE_NOT_CLOSE', 'ERROR! Failed to close file!');

define('ERROR_FILE_NOT_DELETE', 'ERROR! Unable to delete a file!');

define('ERROR_FILE_NOT_CHMOD', 'ERROR! Unable to set file permissions. Try to do it manually.');

define('ERROR_CRITICAL_FILE_NOT_EXISTS', 'Fatal error! File not found. Please update your distro, or contact technical support.');

define('ERROR_FILES_NOT_DELETE', 'ERROR! Unable to delete files!');

define('ERROR_FILES_EXISTS_FILE_NAME', 'ERROR! File with that name already exists!');

define('ERROR_FILES_MISSING_FILE', 'ERROR! Could not save file! Maybe the file does not exist or it has no right to write.');


/***** Загрузка файлов *****/
define('ERROR_FILE_NOT_SELECTED', 'ERROR! No file selected!');

define('ERROR_FILE_NOT_LOAD', 'ERROR! Unable to upload file!');

define('ERROR_FILE_FORMAT_ERROR', 'ERROR! Prohibited downloading of files in this format!');

define('ERROR_FILE_LOAD_ONLY_PARTIAL', 'ERROR! Uploaded file was only partially!');

define('ERROR_FILE_UPLOAD_MAX_FILESIZE', 'ERROR! The uploaded file exceeds the size of!');

define('ERROR_FILE_UPLOAD_NO_TMP_DIR', 'ERROR! Missing a temporary folder storing files!');

define('ERROR_FILE_UPLOAD_CANT_WRITE', 'ERROR! Could not write file to disk!');

define('ERROR_FILE_UPLOAD_EXTENSION', 'ERROR! Unable to download the file due to an incorrect extension!');

define('ERROR_FILE_UPLOAD_DESTINATION', 'ERROR! Unable to copy the file to a specified location after downloading it!');

define('ERROR_FILE_NOT_EXISTS', 'ERROR! The file does not exist!');

define('ERROR_FILE_NAME', 'ERROR! Invalid file name!');

define('ERROR_FILE_NAME_EMPTY', 'ERROR! File name is required');

define('ERROR_FIELD_NAME_EMPTY', 'ERROR! Name required!');

define('ERROR_FILE_NOT_IMAGE', 'ERROR! The specified file is not an image!');

define('ERROR_FILE_CREATE_THUMBNAIL', 'ERROR! Failed to create an icon for the image!');

define('ERROR_FILE_CREATE_WATERMARK', 'ERROR! Unable to create a watermark!');

define('ERROR_FILE_NOT_FOUND_WATERMARK', 'ERROR! Could not find the watermark image!');

define('ERROR_FILE_NOT_FOUND_FONT', 'ERROR! Could not find the font file!');

define('ERROR_DIR_NAME_UPLOAD', 'Invalid directory name!');

define('ERROR_DIR_UPLOAD_CANT_CREATE', 'Failed to create directory on the disc!');

define('ERROR_FILE_EXISTS', 'Error! File with that name already exists! Rename the file and try uploading it again.');


/***** Почта *****/
define('ERROR_SEND_EMAIL', 'ERROR! Unable to send email. Refer to the developers!');


/***** ОШИБКИ СТРАНИЦЫ ОБНОВЛЕНИЯ *****/
define('ERROR_UPDATES_USER_NOT_FOUND', 'ERROR! User not found!');

define('ERROR_UPDATES_NO_ACCESS_TO_THE_FORUM_GROUP', 'ERROR! No admission to the appropriate group forum!');

define('ERROR_UPDATES_NOT_FOUND_PRODUCT_IN_SALES_LIST', 'ERROR! In the list of products not corresponding to the position of the specified parameters!');

define('ERROR_UPDATES_LICENSE_NOT_ACTIVATE', 'ERROR! Not activated during the license!');

define('ERROR_UPDATES_LICENSE_EXPIRED', 'ERROR! Expired license!');

define('ERROR_UPDATES_INTERMEDIATE_REVISION', 'ERROR! Not complied with the order or install updates requested by the assembly does not exist!');

define('ERROR_UPDATES_REVISION_NOT_FOUND', 'ERROR! Assembly was not found or missing Makefile!');

define('ERROR_UPDATES_UPDATE_FILE_NOT_FOUND', 'ERROR! Not found a package of updates!');

define('ERROR_UPDATES_UNABLE_EXTRACT_FILES', 'ERROR! Unable to retrieve update!');

define('ERROR_UPDATES_REQUEST_UNDEFINED_ACTION', 'ERROR! Requested by the improper action!');



/***** ОШИБКИ CURL *****/
define('ERROR_PROXY_AUTHENTICATION_REQUIRED', 'ERROR! Authorization is required on proxy!');

define('ERROR_CURL_NOEXEC', 'ERROR! Failed to CURL-request!');


/***** ОШИБКИ РАССЫЛКИ *****/
define('ERROR_MAILER_SELECT_GROUP_OR_TYPE', 'ERROR! You must select groups or types of users that will be made offers!');

define('ERROR_MAILER_TEXT_IS_SHORT', 'ERROR! Too short text list!');

define('ERROR_MAILER_TEMPLATES_NAME', 'ERROR! Invalid template name! The name can contain the following characters: A-z,0-9,_');

define('ERROR_MAILER_TEMPLATES_NOT_SELECTED', 'ERROR! Not selected a template!');

define('ERROR_MAILER_TEMPLATES_NOT_SELECTED_OR_EMPTY', 'ERROR! Do not select a template or not full text of the template!');

define('ERROR_MAILER_TEMPLATES_FAILED_CREATE_FILE', 'ERROR! Failed to create a template file!');

define('ERROR_MAILER_TEMPLATES_FAILED_TO_REMOVE_FILE', 'ERROR! Unable to delete a template file!');
