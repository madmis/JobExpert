<?php
/********************************************************
	JobExpert v1.0
	powered by Script Developers Group (SD-Group)
	email: info@sd-group.org.ua
	url: http://sd-group.org.ua/
	Copyright 2010-2015 (c) SD-Group
	All rights reserved
=========================================================
	Eng - Messages
********************************************************/
/**
* @package
* @todo
*/

(!defined('SDG')) ? die ('Triple protection!') : null;

/*** WARNINGS ***/
define('MESSAGE_WARNING_NOT_SELECT_RECORDS', 'Not selected for recording changes!');

define('MESSAGE_PERFORM_OPERATION', 'Are you sure you want to perform this operation?');

define('MESSAGE_DELETE_BLOCK', 'REMOVAL: You sure you want to delete a block?');

define('MESSAGE_DELETE_RECORD', 'REMOVAL: You sure you want to delete the record?');

define('MESSAGE_DELETE_RECORDS', 'REMOVAL: You sure you want to delete the selected record?');

define('MESSAGE_DELETE_IP_FROM_LIST', 'REMOVAL: You sure you want to IP-address from the list?');

define('MESSAGE_DELETE_RECORDS_NOT_SEND_MAILS', 'REMOVAL: You sure you want to delete the selected record? When multiple remote users will not receive notification by e-mail!');

define('MESSAGE_ACTIVE_RECORDS_NOT_SEND_MAILS', 'ACTIVATION: Are you sure you want to activate the selected records? If multiple users will not receive the activation email notifications!');

define('MESSAGE_CORRECTION_RECORDS_NOT_SEND_MAILS', 'FIX: You sure you want to send to fix the selected records? When sending multiple users will not receive notification by e-mail!');

define('MESSAGE_CLEAR_LOGS', 'REMOVAL: You sure you want to clear the logs?');

define('MESSAGE_DELETE_RECORDS_SECTIONS', 'REMOVAL: When you delete a partition will erase all professions, ads and subscriptions relating to this section! Are you sure you want to delete the selected records?');

define('MESSAGE_DELETE_RECORDS_PROFESSIONS', 'REMOVAL: When removing the profession will remove all advertisements and subscriptions relating to the profession! Are you sure you want to delete the selected records?');

define('MESSAGE_DELETE_RECORDS_REGIONS', 'REMOVAL: When deleting the region will remove all of the city, advertisements and subscriptions relating to the region! Are you sure you want to delete the selected records?');

define('MESSAGE_DELETE_RECORDS_CITYS', 'REMOVAL: When removing the city will remove all the ads and subscriptions related to your city! Are you sure you want to delete the selected records?');

define('MESSAGE_DELETE_RECORDS_ARTICLES_SECTIONS', 'REMOVAL: When you delete a partition will erase all articles included in this section! Are you sure you want to delete the selected records?');

define('MESSAGE_DELETE_DICT_SELECTS_ALIAS', 'REMOVAL: After removal of the list, its use in the script code will be impossible! Are you sure you want to delete the list?');

define('MESSAGE_DELETE_DICT_SELECTS_VALUE', 'REMOVAL: You sure you want to delete this value?');

define('MESSAGE_DELETE_CONST_LANG_CUSTOM', 'Are you sure you want to remove this constant?');

define('MESSAGE_WARNING_UNKNOWN_ACTION', 'Caused by an unknown force! Please contact the developers of the script.');

define('MESSAGE_WARNING_CREATE_BACKUP', 'Before installing the update it is desirable to make a complete backup of the site.<p>You can make the necessary backups directly to this page, or use the same tools your hosting panel.</p><p>Use of the panel of your hosting is preferable.</p>');

define('WARNING_CONF_USER_REGISTER_DISABLED', 'Customizing user registration is disabled. Users can not register on your site.');

define('WARNING_CONF_USER_ACTIVATE_DISABLED', 'Setting activation email-address of the user is disabled');

define('WARNING_ACTION_USER_MESSAGE_EMPTY', 'You must fill text of the notification!');

define('WARNING_NOT_FORGET_SITE_ON_MAINTENANCE', 'Before you upgrade, do not forget to turn off the site for maintenance');

define('WARNING_BACKUP_NOT_CREATE', 'Failed to create a backup. Reload the page and try again, or use the tools panel of your hosting.');

define('MESSAGE_WARNING_INSTALLING_UPDATE', '<p><b>Expect!</b></p><p>Sets the update. This process can take several seconds to several minutes.</p><p>To avoid problems with the installation do not update the page yourself and do not press any keys.</p><p>If the update was too long or ended in failure, look at the log update (core/data/log/CurrentDateTime__update.log) or send log file for developers (with the domain name of your site). And be sure to make the restoration of the site set up before upgrading the backup.</p>');

define('MESSAGE_WARNING_UPDATE_ERRORS_OCCURRED', '<p>During the update installation error occurred.</p><p>Save the file to log errors and send it to the developers (with the domain name of your site). After that, be sure to make the restoration of the site set up before upgrading the backup.</p>');

define('MESSAGE_WARNING_UPDATE_SETUP_BUT_ERRORS_OCCURRED', 'Update has been installed, but the upgrade process errors were found. Forward error log file for developers (with the domain name of your site) and expect them to answer. We kindly ask you not to take any action not consistent with the developers.');

define('MESSAGE_WARNING_TEMPLATE_DELETE', 'Are you sure you want to delete this template');

define('MESSAGE_WARNING_TPL_FILE_DELETE', 'Are you sure you want to delete the current template file from the list');

define('MESSAGE_WARNING_CSS_FILE_DELETE', 'Are you sure you want to delete the current file from the list of styles');

define('MESSAGE_WARNING_MAILER_NOT_FOUND_USERS', 'Unable to find users that match the query!');

define('MESSAGE_WARNING_NOT_DELETE_CACHE_FILES', 'Unable to delete cache files!');


/*** MESSAGES ***/
define('MESSAGE_PROCESSING_PLEASE_WAIT', 'Please wait until the process');

define('MESSAGE_CHANGE_SAVED_REDIRECT', 'Click here if your browser does not automatically redirect.');

define('MESSAGE_CHANGE_SAVED', 'Changes saved!');

define('MESSAGE_CHANGE_NOT_SAVED', 'Unable to save changes!');

define('MESSAGE_PAGE_ADDED', 'Page added!');

define('MESSAGE_NEWS_ADDED', 'News successfully added!');

define('MESSAGE_ARTICLE_ADDED', 'Article successfully added!');

define('MESSAGE_SECTION_ADDED', 'Section successfully added!');

define('MESSAGE_USER_ADDED', 'User added successfully!');

define('MESSAGE_PROFESSION_ADDED', 'Profession successfully added!');

define('MESSAGE_REGION_ADDED', 'Region successfully added!');

define('MESSAGE_CITY_ADDED', 'The city successfully added!');

define('MESSAGE_FILE_LOAD_SUCCESS', 'File successfully downloaded!');

define('MESSAGE_FILE_ADD_SUCCESS_TITLE', 'File successfully added');

define('MESSAGE_TPL_FILE_ADD_SUCCESS_MESSAGE', 'The new template file available for editing on the list');

define('MESSAGE_CSS_FILE_ADD_SUCCESS_MESSAGE', 'The new stylesheet is available for editing on the list');

define('MESSAGE_FILE_DELETE_SUCCESS', 'Files deleted!');

define('MESSAGE_FILE_SUCCESSFULLY_DELETED_TITLE', 'File successfully deleted');

define('MESSAGE_TPL_FILE_SUCCESSFULLY_DELETED_MESSAGE', 'The template file is removed from the list of editing');

define('MESSAGE_CSS_FILE_SUCCESSFULLY_DELETED_MESSAGE', 'Style file deleted from the list of editing');

define('MESSAGE_TEMPLATE_UPDATE_SUCCESS_TITLE', 'List template files updated successfully');

define('MESSAGE_TEMPLATE_UPDATE_SUCCESS_MESSAGE', 'New template files can be edited in the list');

define('MESSAGE_TEMPLATE_UPDATE_LIST_DIFF_NOT_FOUND', 'Changes in the list of template files &quot;default&quot; not found');

define('MESSAGE_TEMPLATE_DELETE_SUCCESS_TITLE', 'Template successfully removed');

define('MESSAGE_TEMPLATE_DELETE_SUCCESS_MESSAGE', 'Now, you will automatically be transferred to the management page template default');

define('MESSAGE_GROUP_ADD', 'The Group successfully added!');

define('MESSAGE_GROUP_DELETE', 'Group deleted!');

define('MESSAGE_DATA_HAS_BEEN_CHANGED', 'Details were changed!');

define('MESSAGE_DATA_HAS_BEEN_DELETED', 'These were successfully removed!');

define('MESSAGE_DATA_HAS_NOT_BEEN_CHANGED', 'The data failed to change!');

define('MESSAGE_ACTION_SUCCESS', 'Completed successfully');

define('MESSAGE_COMMENTS_DELETE', 'Are you sure you want to delete this comment?');

define('MESSAGE_COMMENTS_NOT_DELETE', 'Unable to remove a comment!');

define('MESSAGE_WAIT_RUNNING_MILER', 'Expect running mailer');

define('MESSAGE_DO_NOT_RELOAD_PAGE', 'Do not reload the page');

define('MESSAGE_MAILER_SUCCESSFUL', 'Mailer is successful! Sent messages');

define('MESSAGE_CACHE_CLEAR_SUCCESS', 'Cache successfully cleared');

/***** ОБНОВЛЕНИЯ *****/
define('MESSAGE_UPDATES_UPDATE_DB_NOT_REQUIRED', 'Updating the database and the partial update of files is not required!');

define('MESSAGE_UPDATES_UPDATE_DB_SUCCESS', 'Updating the database and the partial update of files completed successfully!');

define('MESSAGE_UPDATE_SUCCESSFULLY_DOWNLOADED', 'Update has been successfully uploaded! Watch out, now will begin to install the update.');

define('MESSAGE_BACKUP_SUCCESSFULLY_CREATED', 'A backup was created successfully');

define('MESSAGE_UPDATE_SUCCESSFULLY_SETUP', 'Congratulations, the update has been successfully installed!');
