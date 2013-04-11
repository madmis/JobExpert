<?php

(!defined('SDG')) ? die ('Triple protection!') : null;

define('ERROR_404', 'Error 404');

define('ERROR_404_DESCRIPTION', 'Page Not Found');

define('ERROR_404_MESSAGE_REQUIRED_PAGE', 'The requested URL');

define('ERROR_404_MESSAGE_NOT_EXIST', 'not exists');

define('ERROR_404_RECOMMENDATIONS', 'Recommendations');

define('ERROR_404_RECOMMENDATIONS_CHECK_URL', 'Check the spelling of the URL for this page.');

define('ERROR_404_RECOMMENDATIONS_BACK_TO', 'If problems still persist,  go back to');

define('ERROR_404_RECOMMENDATIONS_BACK_TO_MAIN_PAGE_LINK', 'Home page');

define('ERROR_404_RECOMMENDATIONS_BACK_TO_MAIN_PAGE', 'and choose your page in the menu');

define('ERROR_NOT_CHANGE_DATA', 'Unable to change the data! Try again!');

define('ERROR_EMAIL', 'E-mail is incorrect!');

define('ERROR_CAPTCHA', 'Entered an incorrect verification code!');

define('ERROR_AGREEMENT', 'Must agree to the terms of the Agreement!');

define('ERROR_EMPTY_FIELDS', 'All fields are required!');

define('ERROR_EMPTY_BIND_FIELDS', 'You must fill in all required fields!');

define('ERROR_BIND_FIELD', 'Is required!');

define('ERROR_EMAIL_EXISTS', 'A user with this E-mail is already registered!');

define('ERROR_EMAIL_NOT_FOUND', 'A user with this E-mail can not be found!');

define('ERROR_PASSWORD_NOT_CONFIRM_PASSWORD', 'Confirm Password does not match the password!');

define('ERROR_PASSWORD_SHORT', 'The password must contain at least ' . CONF_REGISTER_USER_PASSWORD . ' characters!');

define('ERROR_PASSWORD', 'Wrong password!');

define('ERROR_PASSWORD_NOT_NEW_PASSWORD', 'The new password must differ from the old!');

define('ERROR_SUBJECT_SHORT', 'The theme should be at least 5 characters!');

define('ERROR_MESSAGE_SHORT', 'The message must contain not less than 10 characters!');

define('ERROR_ACTIVATE_CODE', 'Incorrect activation code!');

define('ERROR_ACTIVATE_ACCOUNT', 'Account does not exist. Perhaps you have the wrong key or activation expired!');

define('ERROR_DATA', 'Bad Data!');

define('ERROR_AUTHORIZE_ACCOUNT_NOT_ACTIVATE', 'Unable to sign in! Most likely,  your email-address was not activated. Activate your email-address,  and then try to come again.');

define('ERROR_NOT_SELECTED_DATA', 'Nothing selected!');

define('ERROR_NON_DATA', 'No data to display!');

define('ERROR_NOT_SELECT_GROUP', 'Do not select the type of account!');

define('ERROR_SELECTED_GROUP', 'Selected group does not exist!');

define('ERROR_DATE_FORMAT', 'Wrong date format!');

define('ERROR_SELECTED_NEWS', 'This news does not exist!');

define('ERROR_SELECTED_ARTICLE', 'This article does not exist!');

define('ERROR_SELECTED_COMPANY', 'ERROR! Selected company does not exist!');

define('ERROR_EMPTY_TITLE', 'Do not filled title!');

define('ERROR_EMPTY_SMALL_TEXT', 'Do not fill in the brief text!');

define('ERROR_EMPTY_TEXT', 'Do not filled with text!');

define('ERROR_SEND_EMAIL', 'Unable to send e-mail message. Refer to the administration!');

define('ERROR_SEND_EMAIL_TRY_AGAIN', 'Failed to send mail message! Please try again.');

define('ERROR_ACTIVATE_ANNOUNCE', 'Failed to activate your ad. Refer to the administration!');

define('ERROR_NOT_ENOUGH_RIGHTS', 'You do not have permission to perform this action!');

define('ERROR_ANNOUNCE_NOT_SELECT', 'Not Selected advertisement for viewing!');

define('ERROR_ANNOUNCE_NOT_EXISTS', 'Such ads do not exist!');

define('ERROR_ANNOUNCE_ISSET', 'This announcement has already been added to the database site!');

define('ERROR_PHONE_FORMAT', 'Incorrect format of phone numbers!');

define('ERROR_DB_TYPE_QUERY_SELECT', 'Do not set the type of query (db::$dbTypeSelect = false),  you must install the correct value: (db::$ dbTypeSelect = multi | single)');

define('ERROR_DB_LIMIT_QUERY_SELECT', 'Invalid parameter LIMIT in the query. Valid values: false or array ("strLimit" => "0,  10",  "calcRows" => true | false)');

define('ERROR_MISMATCH_FIELDS', 'Error! The discrepancy between the form fields with fields in the table:');

define('ERROR_USER_ALIAS_EMPTY', 'To add news to specify an <b>ALIAS</b> user personal data!');

define('ERROR_SEARCH_SHORT_QUERY', 'The search query must contain at least 4 characters!');

define('ERROR_SEARCH_NONE_REQUIRED_FIELDS', 'None required field search query!');

define('ERROR_USER_AGREEMENT', 'To register you must accept The Agreement!');

define('ERROR_SECTION_NOT_SELECT', 'Do not select section!');

define('ERROR_REGION_NOT_SELECT', 'Do not select a region!');

define('ERROR_PERIOD_NOT_SELECT', 'Not selected during the mailing!');

define('ERROR_TYPE_SUBSCRIPTION_NOT_SELECT', 'Do not select the type of ad!');

define('ERROR_NOT_SELECT_ACTION', 'You must select the action!');

define('ERROR_ONLY_ONE_VOTING_ARTICLE', 'You can only vote once!');

define('ERROR_NOT_PAY_SYSTEM', 'No connection of payment systems!');

define('ERROR_PAY_SYSTEM_NOT_EXISTS', 'The chosen payment system is not connected or not configured! Refer to the Administration.');

define('ERROR_PAY_SYSTEM_NOT_DEFINE_PRICE', 'ERROR! Not selected service or selected services is not defined price! Go back and select another payment system or contact the administration.');

define('ERROR_HAVE_MAXIMUM_SUBSCRIPTIONS', 'ERROR! You have already added the maximum number of subscriptions.');

define('ERROR_EMPTY_NAME_OR_SURNAME', 'ERROR! Do not fill in the required field name or surname.');

define('ERROR_USER_NOT_EXISTS', 'ERROR! This user does not exist!');

define('ERROR_USER_ALIAS_IS_EMPTY', 'ERROR! You must specify a alias!');

define('ERROR_USER_ALIAS_EXISTS', 'ERROR! This alias is already taken!');

define('ERROR_DELETE_LOGO', 'ERROR! Failed to remove the logo!');

define('ERROR_UNABLE_PERFORM_OPERATION', 'ERROR! Operation failed. Contact with the administration.');

define('ERROR_TO_PERFORM_ACTION_SPECIFY_ALIAS', 'To perform this action is necessary to fill an alias for personal data!');

define('ERROR_FILE_NOT_FOUND', 'File not found!');

define('ERROR_FILE_NOT_SAVED', 'Could not save file!');

define('ERROR_FILE_NOT_OPEN', 'Could not open file!');

define('ERROR_FILE_NOT_WRITE', 'Could not write file!');

define('ERROR_FILE_NOT_CLOSE', 'Could not close file!');

define('ERROR_FILE_NOT_CHMOD', 'Unable to set file permissions. Try to do it manually.');

define('ERROR_CRITICAL_FILE_NOT_EXISTS', 'Fatal error! File not found. Please update your distro,  or contact technical support.');

define('ERROR_FILES_NOT_DELETE', 'Unable to delete files!');

define('ERROR_FILE_NOT_SELECTED', 'No file selected!');

define('ERROR_FILE_NOT_LOAD', 'Could not load file!');

define('ERROR_FILE_FORMAT_ERROR', 'Prohibited downloading of files in this format!');

define('ERROR_FILE_LOAD_ONLY_PARTIAL', 'Uploaded file was only partially!');

define('ERROR_FILE_UPLOAD_MAX_FILESIZE', 'The uploaded file exceeds the size!');

define('ERROR_FILE_UPLOAD_NO_TMP_DIR', 'Missing a temporary folder storing files!');

define('ERROR_FILE_UPLOAD_CANT_WRITE', 'Could not write file to disk!');

define('ERROR_FILE_UPLOAD_EXTENSION', 'Unable to download the file due to an incorrect extension!');

define('ERROR_FILE_UPLOAD_DESTINATION', 'Unable to copy the file to a specified location after downloading it!');

define('ERROR_FILE_NOT_EXISTS', 'The file does not exist!');

define('ERROR_FILE_NAME', 'Invalid file name!');

define('ERROR_FILE_NOT_IMAGE', 'The specified file is not an image!');

define('ERROR_FILE_CREATE_THUMBNAIL', 'Error! Failed to create an icon for the image!');

define('ERROR_FILE_CREATE_WATERMARK', 'Error! Unable to create a watermark!');

define('ERROR_FILE_NOT_FOUND_WATERMARK', 'Error! Could not find the watermark image!');

define('ERROR_FILE_NOT_FOUND_FONT', 'Error! Could not find the font file!');

define('ERROR_FILE_EXISTS', 'Error! File with that name already exists! Rename the file and try uploading it again.');

define('ERROR_DIR_NAME_UPLOAD', 'Invalid directory name!');

define('ERROR_DIR_UPLOAD_CANT_CREATE', 'Failed to create directory on the disc!');

define('ERROR_UNKNOWN', 'Unknown error!');

define('ERROR_COMMENT_TEXT_EMPTY', 'Enter your comment!');

define('ERROR_COMMENT_NEWS_NOT_FOUND', 'Not found news!');

define('ERROR_COMMENT_ARTICLE_NOT_FOUND', 'Not found article!');

define('ERROR_COMMENT_UNABLE_FILL_SERVICE_FIELDS', 'Unable to complete the service field!');

define('ERROR_COMMENT_UNABLE_ADD_COMMENT', 'Unable to add a comment!');
