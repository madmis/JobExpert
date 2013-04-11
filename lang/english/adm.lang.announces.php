<?php
/********************************************************
	powered by Script Developers Group (SD-Group)
	email: info@sd-group.org.ua
	url: http://sd-group.org.ua/
	Copyright 2009 (c) SD-Group
	All rights reserved
=========================================================
	Eng - Announces
********************************************************/

(!defined('SDG')) ? die ('Triple protection!') : null;

define('FORM_DOSSIER_HEAD', 'Profile');

define('FORM_SECTIONS_HEAD', 'Sections');

define('FORM_REGIONS_HEAD', 'Regions');

define('FORM_ANNOUNCES_HEAD', 'Announces');

define('FORM_VACANCYS_HEAD', 'Vacancys');

define('FORM_VACANCY_NAME', 'Vacancy');

define('FORM_RESUMES_HEAD', 'Resume');

define('FORM_ACTIVATE_ANNOUNCE_HEAD', 'Activate announces');

define('FORM_ADD_ANNOUNCE_HEAD', 'Adding announces');

define('FORM_PREVIEW_ANNOUNCE_HEAD', 'Preview');

define('FORM_VIEW_ANNOUNCE_HEAD', 'View announce');

define('FORM_DESCRIPTION_VACANCY_HEAD', 'Describes the features of the script - Add a vacancy');

define('FORM_DESCRIPTION_RESUME_HEAD', 'Describes the features of the script - Add a resume');

define('EDIT_VACANCY_HEAD', 'Edit vacancy');

define('EDIT_RESUME_HEAD', 'Edit resume');

define('VACANCY_TITLE', 'Vacancy title');

define('RESUME_TITLE', 'Resume title');

define('ANNOUNCE_USER_TYPE', 'User type');

define('ANNOUNCE_ACTIVATE_CODE', 'Activation code');

define('ANNOUNCE_ADDED_DATETIME', 'Announce date');

define('ANNOUNCE_ACTIVATE_DATETIME', 'Activation date');

define('ANNOUNCE_DEACTIVATE_DATETIME', 'Deactivation date');

define('ANNOUNCE_COUNT_VIEWS', 'Views');

define('ANNOUNCE_RATE', 'Rating');

define('ANNOUNCE_RATE_DATETIME', 'setup date');

define('ANNOUNCE_ACTION_USER_VIEW', 'View profile');

define('ANNOUNCE_SORT_UP', 'Sort ascending');

define('ANNOUNCE_SORT_DOWN', 'Sort descending');

define('ANNOUNCE_SORT_OFF', 'Do not use sorting');

define('ANNOUNCE_FILTER_ON', 'Apply filter');

define('ANNOUNCE_FILTER_OFF', 'Do not apply filter');

/*** шаблон добавления объявлений (Статусы объявлений) ***/ 
define('ANNOUNCE_CORRECTION', 'Edit announce');

define('ANNOUNCE_SET_STATUS', 'Set status');

define('ANNOUNCE_RESET_STATUS', 'Reset status');

define('ANNOUNCE_SET_STATUS_VIP_VACANCY', 'VIP-Vacancy');

define('ANNOUNCE_SET_STATUS_VIP_RESUME', 'VIP-Resume');

define('ANNOUNCE_SET_STATUS_HOT_VACANCY', 'HOT-Vacancy');

define('ANNOUNCE_SET_STATUS_HOT_RESUME', 'HOT-Resume');

define('ANNOUNCE_SET_STATUS_RATE_RESUME', 'Hold up resume');

define('ANNOUNCE_SET_STATUS_RATE_VACANCY', 'Hold up vacancy');

define('ANNOUNCE_RESET_STATUS_RATE_RESUME', 'Reset rate resume');

define('ANNOUNCE_RESET_STATUS_RATE_VACANCY', 'Reset rate vacancy');

/*** шаблон добавления объявлений (общие тексты) ***/ 
define('ANNOUNCE_TOKEN_ACTIVE', 'Active');

define('ANNOUNCE_TOKEN_TEMPLATE', 'Templates');

define('ANNOUNCE_TOKEN_ARCHIVED', 'Archived');

define('ANNOUNCE_INFO_TAB', 'Info');

define('ANNOUNCE_PARAMS_TAB', 'Options');

define('ANNOUNCE_REQUIREMENTS_TAB', 'Requirements');

define('ANNOUNCE_EDUCATION_TAB', 'Education');

define('ANNOUNCE_EXPIREINFO_TAB', 'Experience');

define('ANNOUNCE_ADDITION_PARAMS_TAB', 'More');

define('ANNOUNCE_CONTACTS_HEAD', 'Contacts');

define('ANNOUNCE_CONTACTS_COMPANY_NAME', 'Company name');

define('ANNOUNCE_CONTACTS_AGENT_NAME', 'Name of employment agency');

define('ANNOUNCE_COMPANY_DISCRIPTION', 'Description of the company');

define('ANNOUNCE_CONTACTS_PERSON', 'Contacts');

define('ANNOUNCE_COMPETITOR_INFO', 'Personal data');

define('ANNOUNCE_CONTACTS_PHOTOCARD', 'Snapshot');

define('ANNOUNCE_CONTACTS_FIO', 'Contact person');

define('ANNOUNCE_CONTACTS_LASTNAME', 'Surname');

define('ANNOUNCE_CONTACTS_FIRSTNAME', 'Name');

define('ANNOUNCE_CONTACTS_MIDDLENAME', 'Patronymic');

define('ANNOUNCE_CONTACTS_EMAIL', 'E-mail');

define('ANNOUNCE_CONTACTS_EMAIL_PUBLIC', 'Show Email-address in the announce');

define('ANNOUNCE_CONTACTS_PHONE', 'Phone number');

define('ANNOUNCE_CONTACTS_ADDITION_PHONES', 'Add. phone numbers');

define('ANNOUNCE_CONTACTS_PHONE_NOTE', 'note');

define('ANNOUNCE_CONTACTS_URL', 'Site address');

define('ANNOUNCE_VACANCY_INFO_HEAD', 'Company Info');

define('ANNOUNCE_RESUME_INFO_HEAD', 'Information on resume');

define('ANNOUNCE_SELECT_SECTION', 'Section');

define('ANNOUNCE_OPTION_SECTION', 'Select section');

define('ANNOUNCE_SELECT_PROFESSION', 'Profession');

define('ANNOUNCE_SELECT_PROFESSION_NOTE', '(Choose from one to three professions)');

define('ANNOUNCE_OPTION_PROFESSION', 'Select profession');

define('ANNOUNCE_SELECT_REGION', 'Region');

define('ANNOUNCE_OPTION_REGION', 'Select region');

define('ANNOUNCE_SELECT_CITY', 'City');

define('ANNOUNCE_OPTION_CITY', 'Select city');

define('ANNOUNCE_INPUT_OTHER_CITY', 'Another city');

define('ANNOUNCE_VACANCY_PARAMS_HEAD', 'Vacancy options');

define('ANNOUNCE_RESUME_PARAMS_HEAD', 'Resume options');

define('ANNOUNCE_VACANCY_REQUIREMENTS_HEAD', 'Applicants requirements');

define('ANNOUNCE_PAY_HEAD', 'Wages');

define('ANNOUNCE_SELECT_CHARTWORK', 'Schedule');

define('ANNOUNCE_OPTION_CHARTWORK', 'Select the schedule');

define('ANNOUNCE_SELECT_EXPIREWORK', 'Experience');

define('ANNOUNCE_OPTION_EXPIREWORK', 'Select your experience');

define('ANNOUNCE_EXPIREINFO_HEAD', 'Schedule');

define('ANNOUNCE_INPUT_EXPIRE_CAREER_LAUNCH', 'Start a career - I have no experience.');

define('ANNOUNCE_EXPIRE_DISCRIPTION', 'Enter a description of previous work, in reverse chronological order.');

define('ANNOUNCE_INPUT_EXPIRE_PERIOD', 'Operating Period');

define('ANNOUNCE_INPUT_EXPIRE_PERIOD_NOW', 'present');

define('ANNOUNCE_INPUT_EXPIRE_APPOINTMENT', 'Position');

define('ANNOUNCE_TEXTAREA_EXPIRE_DUTIES_INFO', 'Duties, functions, achievements');

define('ANNOUNCE_BUTTON_ADD_EXPIRE', 'Add Job');

define('ANNOUNCE_EDUCATION_HEAD', 'Information about education');

define('ANNOUNCE_SELECT_EDUCATION', 'Education');

define('ANNOUNCE_OPTION_EDUCATION', 'Select Education');

define('ANNOUNCE_INPUT_BASIC_EDUCATION', 'Basic education');

define('ANNOUNCE_SELECT_EDUCATION_TYPE', 'Education type');

define('ANNOUNCE_OPTION_EDUCATION_TYPE', 'Select type');

define('ANNOUNCE_INPUT_EDUCATION_INSTITUTION', 'Organization / Department / Major');

define('ANNOUNCE_INPUT_EDUCATION_DEGREE', 'Diploma / Degree / Qualification');

define('ANNOUNCE_INPUT_EDUCATION_FINISH_DATE', 'Expiration date');

define('ANNOUNCE_INPUT_EDUCATION_EXTINFO', 'More');

define('ANNOUNCE_BUTTON_ADD_EDUCATION', 'Add education');

define('ANNOUNCE_TEXTAREA_REQUIREMENTS', 'Additional requirements for the applicant');

define('ANNOUNCE_TEXTAREA_DUTESWORK', 'Main duties');

	define('ANNOUNCE_TEXTAREA_CONDITIONS_WORK', 'Conditions of work');

define('ANNOUNCE_LANGUAGES_HEAD', 'Languages');

define('ANNOUNCE_INPUT_NATIVE_LANGUAGE', 'Natural language');

define('ANNOUNCE_INPUT_NOFOREIGN_LANGUAGE', 'No knowledge of foreign languages');

define('ANNOUNCE_INPUT_FOREIGN_LANGUAGE', 'Foreign language');

define('ANNOUNCE_OPTION_LANGUAGE', 'Select language');

define('ANNOUNCE_SELECT_LANGUAGE_DEGREE', 'Language proficiency');

	define('ANNOUNCE_OPTION_LANGUAGE_DEGREE', 'Choose the level of');

define('ANNOUNCE_TEXTAREA_LANGUAGE_NOTE', 'Choose the level ofs');

define('ANNOUNCE_BUTTON_ADD_LANGUAGE', 'Add a language');

define('ANNOUNCE_ADDITION_PARAMS_HEAD', 'More options');

	define('ANNOUNCE_TEXTAREA_EXT_INFO', 'additional data');

define('ANNOUNCE_TEXTAREA_ABOUTINFO', 'Additional information about yourself');

define('ANNOUNCE_SELECT_GENDER', 'Gender');

define('ANNOUNCE_OPTION_GENDER', 'Select gender');

define('ANNOUNCE_AGE', 'Age');

define('ANNOUNCE_SELECT_ACTPERIOD', 'Storage life');

define('ANNOUNCE_OPTION_ACTPERIOD', 'Select a date');

define('ANNOUNCE_VISIBILITY_HEAD', 'Guest accommodation');

define('ANNOUNCE_VISIBILITY_VISIBLE', 'Visible to all');

define('ANNOUNCE_VISIBILITY_VISIBLEHC', 'Visible to all (less contact)');

define('ANNOUNCE_VISIBILITY_MEMBERS', 'Seen to users');

define('ANNOUNCE_VISIBILITY_MEMBERSHC', 'Seen to users (less contact)');

define('ANNOUNCE_VISIBILITY_HIDE', 'Hidden from all');

define('ANNOUNCE_RADIOBOX_USER_TYPE_HEAD', 'Company type');

define('ANNOUNCE_RADIOBOX_USER_TYPE_EMPLOYER', 'Direct employer');

define('ANNOUNCE_RADIOBOX_USER_TYPE_AGENT', 'Staffing Agency');

define('ANNOUNCE_SUBCRIPTION', 'Subscription');

define('ANNOUNCE_CHECKBOX_SUBCRIPTION_ON', 'Subscription');

define('ANNOUNCE_META_KEYWORDS', 'META KEYWORDS');

define('ANNOUNCE_META_DESCRIPTION', 'META DESCRIPTION');

define('ANNOUNCE_STATUS_VIP', 'VIP-status');

define('ANNOUNCE_STATUS_HOT', 'HOT-status');

define('ANNOUNCE_STATUS_RATE', 'Rating');

define('ANNOUNCE_SORT_BY_VIP', 'Sort by VIP-status announce');

define('ANNOUNCE_SORT_BY_HOT', 'Sort by HOT-status announce');

define('ANNOUNCE_SORT_BY_RATE', 'Sort by Rating announce');

define('ANNOUNCE_SORT_BY_ACT_DATETIME', 'Sort by date announce');

define('ANNOUNCE_SORT_BY_CNT_VIEWS_TOTAL', "Sorting through the main meter display ads [total hits]");

define('ANNOUNCE_SORT_BY_CNT_VIEWS_TEMP', 'Sort by time of the counter display ads [views in the period]');

define('ANNOUNCE_PAGE_TITLE_DESCRIPT_TITLE', 'Announce title');

define('ANNOUNCE_PAGE_TITLE_DESCRIPT_COMPANY_NAME', 'Company name');

define('ANNOUNCE_PAGE_TITLE_DESCRIPT_ID_SECTION', 'Section name');

define('ANNOUNCE_PAGE_TITLE_DESCRIPT_ID_PROFESSION', 'Profeccy name');

define('ANNOUNCE_PAGE_TITLE_DESCRIPT_ID_REGION', 'Region');

define('ANNOUNCE_PAGE_TITLE_DESCRIPT_ID_CITY', 'Name City');

define('ANNOUNCE_ADD_ACTIVATE_TITLE', 'Attention! Confirmation of adding new announce.');

define('ANNOUNCE_ADD_ACTIVATE_MESSAGE', '<span style="font-weight: bold;">Please check your e-mail!</span><br><br>To your specified E-Mail address, send a message with an activation code.<br>You need to activate your announce, use the code, or click on the link in the email.');

define('ANNOUNCE_ADD_MODERATION_TITLE', 'Attention! Your announce is on moderation.');

define('ANNOUNCE_ADD_MODERATION_MESSAGE', '<span style="font-weight: bold;">Pay attention!</span><br><br>At the moment the site is included moderation of new announces.<br>Further work with your announce will be available after the verification and validation moderator.');

define('ANNOUNCE_ADD_SUCCESS_TITLE', 'Congratulations! Your ad has been successfully added to the base site.');

define('ANNOUNCE_ADD_SUCCESS_MESSAGE', '<span style="font-weight: bold;">Your ad is available for viewing in the catalog site.</span>');

define('FORM_ANNOUNCE_COMMENTS_TITLE', 'Remarks for announce');

define('FORM_ANNOUNCE_COMMENTS_MESSAGE', 'In the field, enter comments to the announce');

define('FORM_ANNOUNCE_COMMENTS_CORRECTION', 'When sending announce of correction, the comments will be saved in the future the user can edit the ad with the comments.');

define('FORM_ANNOUNCE_COMMENTS_DELETE', 'When you delete announce, comments will be sent to the user in a letter.');

/* * * шаблон управления анкетами объявлений ** */
define('ANNOUNCE_BASIC_FIELD_DESCRIPT_FIRST_NAME', 'Name');

define('ANNOUNCE_BASIC_FIELD_DESCRIPT_LAST_NAME', 'Surname');

define('ANNOUNCE_BASIC_FIELD_DESCRIPT_PHONE', 'Phone');

define('ANNOUNCE_BASIC_FIELD_DESCRIPT_AGE', 'Age');

define('ANNOUNCE_BASIC_FIELD_DESCRIPT_GENDER', 'Gender');

define('ANNOUNCE_BASIC_FIELD_DESCRIPT_BIRTHDAY', 'Birthday');

define('ANNOUNCE_BASIC_FIELD_DESCRIPT_EXPIRE_WORK', 'Expire work');

define('ANNOUNCE_BASIC_FIELD_DESCRIPT_EDUCATION', 'Education');

define('ANNOUNCE_BASIC_FIELD_DESCRIPT_CURRENCY', 'Currency');

define('ANNOUNCE_BASIC_FIELD_DESCRIPT_VISIBILITY', 'Guest accommodation');

define('ANNOUNCE_BASIC_FIELD_DESCRIPT_PUBLIC_EMAIL', 'Publication E-mail address on the site');

define('ANNOUNCE_BASIC_FIELD_DESCRIPT_MIDDLE_NAME', 'Middle name');

define('ANNOUNCE_BASIC_FIELD_DESCRIPT_NOTE_PHONE', 'Phone (note)');

define('ANNOUNCE_BASIC_FIELD_DESCRIPT_ADDITION_PHONE_1', 'Additional phone [1]');

define('ANNOUNCE_BASIC_FIELD_DESCRIPT_NOTE_ADDITION_PHONE_1', 'Additional phone [1] (note)');

define('ANNOUNCE_BASIC_FIELD_DESCRIPT_ADDITION_PHONE_2', 'Additional phone [2]');

define('ANNOUNCE_BASIC_FIELD_DESCRIPT_NOTE_ADDITION_PHONE_2', 'Additional phone [2] (note)');

define('ANNOUNCE_BASIC_FIELD_DESCRIPT_ID_PROFESSION_1', 'Additional profession [1]');

define('ANNOUNCE_BASIC_FIELD_DESCRIPT_ID_PROFESSION_2', 'Additional profession [2]');

define('ANNOUNCE_BASIC_FIELD_DESCRIPT_CHART_WORK', 'Chart work');

define('ANNOUNCE_BASIC_FIELD_DESCRIPT_ABOUT_INFO', 'Additional information about yourself');

define('ANNOUNCE_BASIC_FIELD_DESCRIPT_COMPANY_NAME', 'Company Name');

define('ANNOUNCE_BASIC_FIELD_DESCRIPT_COMPANY_DISCRIPTION', 'Description of the company');

define('ANNOUNCE_BASIC_FIELD_DESCRIPT_CONTACTS_FIO', 'Contact person (name)');

define('ANNOUNCE_BASIC_FIELD_DESCRIPT_REQUIREMENTS', 'Additional requirements for the applicant');

define('ANNOUNCE_BASIC_FIELD_DESCRIPT_DUTIES_WORK', 'Main duties');

define('ANNOUNCE_BASIC_FIELD_DESCRIPT_AGENT_NAME', 'Name of employment agency');

define('ANNOUNCE_BASIC_FIELD_DESCRIPT_URL', 'Site Address');

define('ANNOUNCE_BASIC_FIELD_DESCRIPT_EDU_WORK', 'Education');

define('ANNOUNCE_BASIC_FIELD_DESCRIPT_CONDITIONS_WORK', 'Conditions of work');

define('ANNOUNCE_BASIC_FIELD_DESCRIPT_EXT_INFO', 'More');

define('ANNOUNCE_BASIC_FIELD_DESCRIPT_AGE_FROM', 'Age (on)');

define('ANNOUNCE_BASIC_FIELD_DESCRIPT_AGE_POST', 'Age (up to)');

define('ANNOUNCE_BASIC_FIELD_DESCRIPT_FILE', 'Attachment Files');

define('ANNOUNCE_BASIC_FIELD_DESCRIPT_ACT_PERIOD', 'Storage life');

define('ANNOUNCE_BASIC_FIELD_DESCRIPT_SUBSCRIPTION', 'Subscription to the ad in response to these questionnaires');

define('ANNOUNCE_EXT_EDUCATION_FIELD_DESCRIPT_TYPE', 'Type of education');

define('ANNOUNCE_EXT_EDUCATION_FIELD_DESCRIPT_INSTITUTION', 'Organization / Department / Major');

define('ANNOUNCE_EXT_EDUCATION_FIELD_DESCRIPT_DEGREE', 'Diploma / Degree / Qualification');

define('ANNOUNCE_EXT_EDUCATION_FIELD_DESCRIPT_FINISH_MONTH', 'End Date (month)');

define('ANNOUNCE_EXT_EDUCATION_FIELD_DESCRIPT_FINISH_YEAR', 'End Date (year)');

define('ANNOUNCE_EXT_EDUCATION_FIELD_DESCRIPT_EXT_INFO', 'More');

define('ANNOUNCE_EXT_EXPIRE_FIELD_DESCRIPT_BEGIN_MONTH', 'Period of work with the (month)');

define('ANNOUNCE_EXT_EXPIRE_FIELD_DESCRIPT_BEGIN_YEAR', 'Period of work with the (year)');

define('ANNOUNCE_EXT_EXPIRE_FIELD_DESCRIPT_COMPANY', 'Company Name');

define('ANNOUNCE_EXT_EXPIRE_FIELD_DESCRIPT_APPOINTMENT', 'Position');

define('ANNOUNCE_EXT_EXPIRE_FIELD_DESCRIPT_DUTIES_INFO', 'Duties, functions, achievements');

define('ANNOUNCE_EXT_EXPIRE_FIELD_DESCRIPT_FINISH_MONTH', 'Period of work (month)');

define('ANNOUNCE_EXT_EXPIRE_FIELD_DESCRIPT_FINISH_YEAR', 'Period of work (year)');

define('ANNOUNCE_EXT_EXPIRE_FIELD_DESCRIPT_COMPANY_DISCRIPTION', 'Description of the company');

define('ANNOUNCE_EXT_LANGUAGE_FIELD_DESCRIPT_TYPE', 'Type of ownership (native / foreign)');

define('ANNOUNCE_EXT_LANGUAGE_FIELD_DESCRIPT_LANG', 'Language');

define('ANNOUNCE_EXT_LANGUAGE_FIELD_DESCRIPT_DEGREE', 'Language proficiency');

define('ANNOUNCE_EXT_LANGUAGE_FIELD_DESCRIPT_NOTE', 'Note');

define('VACANCY_BASIC_FIELD_DESCRIPT_TITLE', 'Job title');

define('VACANCY_BASIC_FIELD_DESCRIPT_IMAGE', 'Image');

define('VACANCY_BASIC_FIELD_DESCRIPT_PAY_FROM', 'Wages (from)');

define('VACANCY_BASIC_FIELD_DESCRIPT_PAY_POST', 'Wages (to)');

define('RESUME_BASIC_FIELD_DESCRIPT_IMAGE', 'Photograph');

define('RESUME_BASIC_FIELD_DESCRIPT_PAY_FROM', 'Wages');

define('RESUME_BASIC_FIELD_DESCRIPT_TITLE', 'Title Resume');
