<?php
/********************************************************
	JobExpert v1.0
	powered by Script Developers Group (SD-Group)
	email: info@sd-group.org.ua
	url: http://sd-group.org.ua/
	Copyright 2010-2015 (c) SD-Group
	All rights reserved
=========================================================
	Eng - Help
********************************************************/
/**
* @package
* @todo
*/

(!defined('SDG')) ? die ('Triple protection!') : null;

/***** ОБЩИЕ ХЕЛПЫ ДЛЯ РАЗДЕЛОВ *****/
define('HELP_ADMIN_MANAGER_MAIL_TEMPLATES', '<p><b>Templates email-messages sent from the site.</b></p><p style="color: red;"> The delivery must be present all of the templates. If a template does not exist, be sure to contact support, otherwise the script errors will occur.</p><p>Each template can be used by a certain set of variables. All variables are listed in the description of the appropriate template.</p><p><b>Notice!</b>You can use only those variables that are specified in the description. Do not add your variables, they will not be processed.</p><p><b>worth remembering</b>, that if you add in the email templates html-code in the settings of mail must indicate the format of sending mail <b>text/html</b>, otherwise the user will receive the html-code and not the result of its withdrawal.</p><p>If you want to show how a variable as a reference, you must select the editor to add links, and in the open box, insert the appropriate link. If sslykoy is a variable, you must remove the links in the text <b>http://</b> and insert the required variables.</p><p>If you want to paste the email as a link, then open the Add link, remove the text <b>http://</b>, and paste <b>mailto:% VAR% </b></p>');

define('HELP_ADMIN_MANAGER_USERS', '<p><b>Managing users registered on the site.</b></p>

<p><b>users awaiting activation</b></p>
<p>list of users who have not confirmed your email-address (if the option "Use the activation e-mail user").</p>
<p>administrator can activate or delete users in this list. When activated, if you set the switch notifications (appears next to the list of actions), users will be sent notification of activation.</p>

<p><b>users awaiting moderation</b></p>
<p>Will the user after registration sent to the moderation depends on the responsibilities of a group defined for the type of the default user (Groups/Preferences).</p>

<p><b>Members are waiting to pay</b></p>
<p>List, whose registration fee (types of users with paid registration are set in the settings).</p>
<p>administrator can activate or delete users in this list. If the administrator activates the user from this list, the user will not have to pay for registration.</p>
');

define('HELP_ADMIN_USERS_COMPANIES', '<p><b>Management of companies registered on the site.</b></p>');

define('HELP_ADMIN_MANAGER_FILE', '<p><b>File Manager.</b></p><p>available for download files matching the following requirements: <ul><li>Filename must contain only letters of the alphabet;</li><li>The file name can contain numbers;</li><li>file name can contain underscores <b>_</b>;</li><li>In the name of the file does not contain spaces.</li></ul></p>');

define('HELP_ADMIN_MANAGER_GROUPS', '<p><b>Group (the rights and obligations of users).</b></p>');

define('HELP_ADMIN_MANAGER_ARTICLES', '<p><b>Article.</b></p>');

define('HELP_ADMIN_MANAGER_NEWS', '<p><b>News.</b></p>');

define('HELP_ADMIN_MANAGER_DOP_PAGES', '<p><b>Additional Pages.</b></p>');

define('HELP_ADMIN_DICTIONARY_ARTICLES_SECTIONS', '<p><b>Sections Articles.</b></p>');

define('HELP_ADMIN_MANAGER_MAILER', '<p><b>Newsletter.</b></p>
<p>section is intended to send messages to users of the site.</p>
<p><b> Attention!</b> If the distribution is not done via SMTP, we recommend you to do it at night time (the least load on the server). This is due to the fact that a large number of active users mailing creates a significant burden on the server. As a recommendation, can advise you to perform mailing list for selected groups or types of users separately.</p>
<p><b>List template</b></p>
<p>The mailing list you can use templates.</p>
<p>templates are intended not only for the storage of different styles of letters. In the list template can be stored already sent messages (examples of which may be needed in the future).</p>
');

define('HELP_ADMIN_MODS_PAYMENTS', '<p><b>Management modes of payment.</b></p>
<p>to pay for the site will be used only those modes whose status <b>Enabled</b>. If the mod is not installed or is disabled, the user can not choose a mode for payment.</p>
<p> the derivation of mods on the list is checked for the presence of mandatory file fashion. If any of the required files are no fashion, then this mod will not be listed. Checked the following files:<br>
&bull;<b>conf/nazvanie_moda.conf.php</b> - configuration file mode;<br>
&bull;<b>conf/nazvanie_moda.tariffs.php</b> - tariff scale fashion;<br>
&bull;<b>index.php</b> - galvny file mode in the user part;<br>
&bull;<b>templates/images/logo.png</b> - Fashion logo.<br>
</p>
<p>before activating the mod, be sure to izmeniete set it up on his own and specify the price in the tariff schedule.</p>
');

define('HELP_ADMIN_MODS_MODS', '<p><b>The list of available mods script.</b></p>');

define('HELP_ADMIN_CHANGE_PASSWORD', '<p>The fields specify a new username and password. If you want to change only the username or the password, just fill in the appropriate field.</p><p>login and password are stored in the database in encrypted form, so their recovery (in case of loss) is not possible.</p>');

define('HELP_ADMIN_MANAGER_SUBSCRIPTIONS', '<p>Subscription users to announces.</p>');

define('HELP_ADMIN_SYSTEM_UPDATES', '<p>available product updates.</p><p>The page displays a list of dosupnyh updates. Updates are displayed on the page, should be installed in the order, the appropriate assembly, in order of increasing.</p><p><b>For example:</b> your assembly 65. Upgrades available: 68, 73, 85. For correct update, you must install the assembly 68, then 73 and so on If you just install the assembly 85, the script will work npravilno. In the latter case would have to completely reinstall the script.</p>');

define('HELP_ADMIN_SYSTEM_BACKUPS', '<p>Backup copies of the product and the database.</p>');

define('HELP_ADMIN_SERVICE_LANGUAGE_MANAGER_CONST', '<p><b>Manage the content of language constants Site</b></p><p></p>');

define('HELP_ADMIN_SERVICE_LANGUAGE_MANAGER_TEXT', '<p><b>Manage the content of text file of the site</b></p><p></p>');

define('HELP_ADMIN_SERVICE_LANGUAGE_MANAGER_AGREEMENT', '<p><b>Content Management User Agreement Site</b></p><p><b>Customer Treaty</b> - a public contract between visitors and users of the site owner, the contract regulates all bilateral relations . User must agree to the terms listed in the agreement.</p><p>text of the agreement, with the requirement of consent, you are a visitor at the time of registering a new account (registered users) and also when you add any data into the site database unregistered users.</p><p>This agreement represents a single document governing the contractual obligations between the visitors and users of the site owner, using all the services provided by the script, according to the settings defined in the Control Panel Site Administrator.</p><p>This section, you can edit the content of the User Agreement website for all installed locations.</p><p>selection of localization is carried out through the list of "localization", active displays the current available for editing.</p><p>sure to fill in the text of the agreement for each location, supported by your site.</p><p><b>Acceptable formats:</b> HTML, plain text.</p>');

define('HELP_ADMIN_SERVICE_EDITOR_TEMPLATES', '<p><b>Templates management</b></p>');

define('HELP_ADMIN_LOGS_PAYMENTS', '<p><b>Logs payments.</b></p><p>This section is intended to manage the logs of all payments made on the site.</p><p>Any operation of payment are logged into a table and log files. The table is the primary repository of the log files - a subsidiary.</p><p>Each entry in the table svzyana with one of the files (except log fashion HAND). But the removal of any records made, regardless of their ties. Therefore, a better time to time to remove logs and files, and in the table.</p>');

/***** ОБЩЕЕ *****/
define('HELP_ADMIN_CONF_STRINGS_PERPAGE_ADMIN_PANEL', '<p>The number of rows in the tables in the admin panel, by default.</p>');

define('HELP_ADMIN_CONF_STRINGS_PERPAGE_USER', '<p>Specify the number of records displayed in the user part before pagination.</p>');

/***** HELP *****/
define('HELP_ADMIN_PATTERN_FILTER', '<p>When COMPLETED field templates can be used filters.</p><p> When comparing the pattern symbol <b>&quot;?&quot;</b> stands for any single character and <b>&quot;*&quot;</b> - a certain number of characters (including zero characters). Not case-sensitive. <b>Examples:</b></p><p>&bull; Find all numbers starting with <b>&quot;12345&quot;</b>: <b>12345*</b>;</p><p>&bull; Find all numbers ending <b>&quot;587&quot;</b>: <b>*587</b>;</p><p>&bull; Find all of the numbers is not known if the second and third figures: <b>1??5055311</b>.</p>');

define('HELP_ADMIN_PATTERN_FILTER_ID', '<p>When COMPLETED field templates can be used to filter ID.</p><p>in the Type ID of the desired record (or template). ID must be an integer, otherwise the value is not taken into account when searching.</p><p>permissible to 3 types of guidance values in this field:</p><p>&bull;<b>18</b> - searches for records with the specified ID. In this case, with ID = 18;</p><p>&bull; <b>1,2,5,13</b> - searches for records, taking into account all of the ID. In this case, with ID = 1 and ID = 2 and ID = 5 and ID = 13;</p><p>&bull; <b>4-45</b> - searches for records in the range specified ID. In this case, all records will be found, ID which is in the range from 4 to 45.</p><p>field can be left blank. In this case, ID is not taken into account when searching.</p>');

define('HELP_ADMIN_PATTERN_FILTER_STRING', '<p>When COMPLETED field templates can be used filter strings.</p><p>box, enter the desired value (the search).</p><p>Supports standard SQL to compare the pattern. When comparing the pattern symbol <b>&quot;_&quot;</b> matches any single character and <b>&quot;%&quot;</b> - a certain number of characters (including zero characters). Not case-sensitive. <b>Examples:</b></p><p>&bull; Find all lines that begin with <b>&quot;b&quot;</b>: <b>b%</b>;</p><p>&bull; Find all lines ending at <b>&quot;fy&quot;</b>: <b>%fy</b>;</p><p>&bull; Find all lines containing <b>&quot;w&quot;</b>: <b>%w%</b>;</p><p>&bull; Find all lines containing exactly five characters, you can with the help of pattern character <b>&quot;_&quot;</b> (to indicate it 5 times): <b>_____</b>.</p><p>field can be left blank. In this case it is ignored when searching.</p>');



/***** НАСТРОЙКИ SMARTY *****/
define('HELP_ADMIN_SMARTY_DIR', '<p>Constant Smarty<b>SMARTY_DIR</b></p><p>full path to the Smarty.</p><p>slash (/) at the end of the line is required.</p>');

define('HELP_ADMIN_TEMPLATE_ROOT_DIR', '<p>Property Smarty <b>&#036;template_dir</b></p><p>Title directory default templates.</p><p>slash (/) at the end of the line is required.</p>');

define('HELP_ADMIN_TEMPLATE_COMPILE_DIR', '<p>Property Smarty <b>&#036;compile_dir</b></p><p>The name of the directory where compiled templates are stored.</p><p>slash (/) at the end of the line is required.</p>');

define('HELP_ADMIN_TEMPLATE_DEBUGGING', '<p>Property Smarty <b>&#036;debugging</b></p><p>Activates debugging console (debugger) Smarty.</p>');

define('HELP_ADMIN_TEMPLATE_COMPILE_CHECK', '<p>Property Smarty <b>&#036;compile_check</b></p><p>For each invocation of PHP applications Smarty checks, changed or not the current pattern since the last compile.</p><p>If the pattern has changed, it is recompiled.</p><p>If the pattern has not yet been compiled, it is compiled with ignoring this setting.</p><p>At a time when the application starts to work in real conditions (patterns will no longer be subject to change), the validation phase compilation is unnecessary. In this case, disable this setting to achieve maximum performance.</p><p>Please note that if you disable this setting and the template file is changed, you <b>*NOT*</b> to see changes in the output pattern as long as the template will not be recompiled.</p>');

define('HELP_ADMIN_TEMPLATE_FORCE_COMPILE', '<p>Property Smarty <b>&#036;force_compile</b></p><p>Indicates Smarty (re) compile templates on every invocation.</p><p>This option overrides <b>&#036;compile_check</b> (the previous settings).</p><p>action parameter is useful in the development and debugging, but never use it in a real operation.</p>');


/***** НАСТРОЙКИ СЕРВЕРА *****/
define('HELP_ADMIN_SERVER_ROOT_DIR', '<p>Full server path to the directory with a script.</p><p>Slash (/) at the end of the line is required.</p>');


/***** НАСТРОЙКИ САЙТА *****/
define('HELP_ADMIN_SITE_TITLE', '<p>TITLE default site.</p><p>In the script, TITLE generated automatically, based on the title page. If starnitsy no name, it will be replaced by the text of this setting.</p>');

define('HELP_ADMIN_SITE_DESCRIPTION', '<p>DESCRIPTION default site.</p><p>Works exactly the same as the previous setting.</p>');

define('HELP_ADMIN_SITE_KEYWORDS', '<p>KEYWORDS default site.</p><p>Works exactly the same as setting TITLE.</p>');

define('HELP_ADMIN_SITE_LANGUAGE', '<p>Site Language.</p><p>Languages are stored in <b>lang</b>.</p>');

define('HELP_ADMIN_SITE_TEMPLATE', '<p>Template.</p>');

define('HELP_ADMIN_SITE_NAME', '<p>Site name.</p><p>Имяdisplayed on the site and in the outgoing messages.</p>');

define('HELP_ADMIN_SITE_NAME_TO_TITLE', '<p>Enable this setting if you want to display pages added TITLE Site Name.</p>');

define('HELP_ADMIN_TITLE_PAGE_SEPERATOR', '<p>Enter the string of characters that will be used as a separator in the formation TITLE displayed pages.</p><p>By default, if the value of this setting is not specified, separated by a gap.</p>');

define('HELP_ADMIN_SITE_URL', '<p>URL of the main site.</p><p>f the script is on the subdomain, then this field must specify the primary url. <b>For example:</b> http://sd-group.org.ua/</p></p><p>Slash (/) at the end of the line is required.</p>');

define('HELP_ADMIN_SITE_SCRIPT_URL', '<p>URL Script.</p><p>In this field you must specify the url of the script.. <b>For example:</b> http://jobexpert.sd-group.org.ua/</p><p>Slash (/) at the end of the line is required.</p>');

define('HELP_ADMIN_SITE_USE_VISUAL_EDITOR', '<p>This setting allows you to disable the visual editor.</p><p>The visual editor is used when adding additional pages and news.</p>');

define('HELP_ADMIN_SITE_ENABLE_CACHING', '<p>This setting includes caching, which reduces the load on the database.</p>');

define('HELP_ADMIN_SITE_DISABLE_AUTO_COUNTERS', '<p>This setting disable automatically recounters, which reduces the load on the database.</p>');

define('HELP_ADMIN_USE_REDIRECT_EXTERNAL_LINK', '<p>Enable this setting if you want the external links referred to the redirect page for the site.</p>');

define('HELP_ADMIN_SITE_ENABLE_CHPU', '<p>This setting includes FURL (Human-friendly URL).</p>');

define('HELP_ADMIN_SITE_ENABLE_TRANSLITERATION_CHPU', '<p>This setting includes a transliteration of FURL.</p><p>For example, if you have an article with the headline: &quot;The first article&quot;</p><p>URL will look like this: http://site.com/articles/view/1-first-article.html</p><p><strong>Attention!</strong> Transliteration is available only for Russian, Ukrainian and Latin alphabets. If the title uses characters from other alphabets, do not enable this setting!</p>');

define('HELP_ADMIN_SITE_TRANSLITERATION_CHPU_ID_PUT_TO_END', '<p>This setting allows you to specify the location of the unique record identifier of the database tables in the URL transliteration NC.</p><p>For example, if you have an article with the headline: &quot;The first article&quot;:</p><p> - If the value is &quot;<strong>At first</strong>&quot; this setup - URL would look something like this: http://site.com/articles/view/1-pervaya-statya.html</p><p> - If the value of &quot;<strong >At close</strong>&quot; this setup - URL would look something like this: http://site.com/articles/view/pervaya-statya-1.html</p>');

define('HELP_ADMIN_SITE_TRANSLITERATION_CHPU_MAX_LENGHT', '<p>Specify the maximum number of characters used in the formation of the line FURL transliteration.</p><p>Characters beyond the value of this setting will automatically be clipped.</p><p>Set to "0" if you do not want to limit the length of the string transliteration FURL (not recommended).</p><p><strong>Recommendation:</strong> Optimal value is a string of 80 characters.</p>');

define('HELP_ADMIN_SITE_CHPU_HTML_DATA_EXT', '<p>Specify the extension used for pages with HTML-data in the formation of the FURL.</p>');

define('HELP_ADMIN_SITE_CHPU_XML_DATA_EXT', '<p>Specify the extension used for pages with XML-data in the formation of the FURL.</p>');


/***** НАСТРОЙКИ БЕЗОПАСНОСТИ *****/
define('HELP_ADMIN_SECURE_CKAPTCHA', '<p>Enable/Disable protection against spam bots.</p>');

define('HELP_ADMIN_SECURE_SQLERR_LOG', '<p>Enable/Disable logging of error of SQL-queries.</p><p>If this option is enabled, the catalog <b>core/data/log/</b>, when an sql-error file will be created<b>sql_error.log</b>, which will be recorded all errors.</p><p>Recommend that you enable this setting.</p>');

define('HELP_ADMIN_SECURE_SQLERR_PRINT', '<p>Enable/Disable error output of SQL-queries to the screen.</p><p>This setting can be used to configure script.</p><p>When running in the operating mode we recommend you disable this setting.</p>');

define('HELP_ADMIN_SECURE_SQLERR_SEND_MESS', '<p>Enable/Disable send Error SQL-query to the specified address.</p><p>When the configuration you will receive a letter containing the resulting sql-error.</p><p>If you enable this setting, do not forget to specify the address to send the letter.</p>');

define('HELP_ADMIN_SECURE_SQLERR_EMAIL', '<p>E-mail, which sent a letter on error sql-query.</p>');

define('HELP_ADMIN_SECURE_ACCESS_IP_LIST', '<p>In this setting, you can specify a list of IP-addresses that allow access to Control Panel Site Administrator.</p><p><strong>Attention!</strong> Should be cautious in using this setting, its action takes effect in each new logon session to the panel. If the list is not empty, the entrance to the administration panel will be possible only with the IP-address (es) appear (s) listed.</p><p style="font-style: italic;">Note: in the appendix, are automatically substituted into the current IP-address if the list is empty. Begin filling out the list from that address, in order to avoid losing access to panels Aministratora.</p>');


/***** НАСТРОЙКИ ДАТЫ И ВРЕМЕНИ *****/
define('HELP_ADMIN_DATETIME_DATE_FORMAT', '<p>Specify the date format for display on the site.</p>');

define('HELP_ADMIN_DATETIME_TIME_FORMAT', '<p>Specify the time format for display on the site.</p>');


/***** НАСТРОЙКИ ПОЧТЫ *****/
define('HELP_ADMIN_MAIL_METHOD', '<p>A method of sending mail from the site.</p>');

define('HELP_ADMIN_MAIL_FORMAT', '<p>The format of messages.</p>');

define('HELP_ADMIN_MAIL_ADMIN_EMAIL', '<p>Enter E-Mail address is the site administrator.</p>');

define('HELP_ADMIN_MAIL_SMTP_HOST', '<p>SMTP-host.</p>');

define('HELP_ADMIN_MAIL_SMTP_PORT', '<p>SMTP-port.</p>');

define('HELP_ADMIN_MAIL_SMTP_USER', '<p>SMTP user.</p>');

define('HELP_ADMIN_MAIL_SMTP_PASS', '<p>SMTP password.</p>');


/***** НАСТРОЙКИ ФАЙЛОВ *****/
define('HELP_ADMIN_FILES_MAX_SIZE', '<p>Specify the maximum allowable load the file size (in kilobytes).</p>');

define('HELP_ADMIN_FILES_CREATE_WATERMARK', '<p>Enable/Disable the use of watermarks in the pictures.</p><p>If this option is enabled, any uploaded pictures will be dealt a watermark.</p>');

define('HELP_ADMIN_FILES_CREATE_WATERMARK_ON', '<p>Tell us the pictures to put a watermark.</p><p><b>Original</b> - watermark will be applied only to the main (original) image.</p><p><b>All</b> - watermark will be applied to all images, including original and copy (icon images).</p>');

define('HELP_ADMIN_FILES_WATERMARK_ALIGNMENT', '<p>Specify the location of the watermark in the picture.</p><p>Switch array consists of a mock image. By installing one of the switches indicate where the picture will be located watermark.</p>');

define('HELP_ADMIN_FILES_WATERMARK_TYPE', '<p>Specify the type of watermark.</p><p><b>Picture</b> - watermark is a picture <b>watermark.png</b> (stored in the template manager). The picture should be saved in PNG format with transparent background.</p><p><b>Text</b> - watermark is text. Text watermark has many additional options.</p>');

define('HELP_ADMIN_FILES_WATERMARK_IMAGE', '<p>Graphic Watermark.</p><p>In the field the path to the file of the watermark.</p><p>If the path is correct, then over the field will be shown watermark.</p>');

define('HELP_ADMIN_FILES_WATERMARK_TEXT', '<p>Text watermark.</p><p>The text specified in this field will be used as a watermark.</p><p>Specifies the text as short as possible. Too long sentence may not fit in the picture, in this case, the watermark will not be done.</p>');

define('HELP_ADMIN_FILES_WATERMARK_FONT', '<p>Font watermark.</p><p>When using fonts going to supply the text of the watermark can contain Russian letters.</p>');

define('HELP_ADMIN_FILES_WATERMARK_FONT_SIZE', '<p>The font size in pixels of the watermark.</p>');

define('HELP_ADMIN_FILES_WATERMARK_FONT_COLOR', '<p>Font color watermark.</p><p>Color must be specified in the format <b>#FF0000</b>.</p>');

define('HELP_ADMIN_FILES_WATERMARK_TRANSPARENT', '<p>Transparency of the watermark. Can take values from 0 to 100.</p><p><b>0</b> - no transparency.</p><p><b>100</b> - maximum transparency.</p>');


/***** НАСТРОЙКИ РЕГИСТРАЦИИ И ПОЛЬЗОВАТЕЛЕЙ *****/
define('HELP_ADMIN_REGISTER_USER_REGISTER', '<p>Sign of registering on the site.</p><p>If registration is disabled, all users logged on the site are automatically eligible group <b>GUEST</b>. Accordingly, they can perform all available guests.</p>');

define('HELP_ADMIN_REGISTER_USER_ACTIVATE', '<p>Symptom activation email users.</p><p>If the activation is enabled, registered users will not be able to use the services of a site as long as do not activate your account.</p><p>Activation email is sent automatically to the user after registration.</p>');

define('HELP_ADMIN_REGISTER_USER_ACTIVATE_DELETE', '<p>Specify the time (in hours) during which the user can activate your email, using the activation code sent from the site.</p><p>If the user does not activate your email address within the specified time, his account will be automatically removed.</p>');

define('HELP_ADMIN_REGISTER_MAIL_ADMIN_USER_REGISTER', '<p>Set the switch if you want the administrator has received reports of registering new users.</p>');

define('HELP_ADMIN_REGISTER_COMPETITOR_REGISTER_DEFAULT_GROUP', '<p>User selected after registration type <b>COMPETITOR</b>, all rights specified in the current field group.</p>');

define('HELP_ADMIN_REGISTER_EMPLOYER_REGISTER_DEFAULT_GROUP', '<p>User selected after registration type <b>EMPLOYER</b>, all rights specified in the current field group.</p>');

define('HELP_ADMIN_REGISTER_AGENT_REGISTER_DEFAULT_GROUP', '<p>User selected after registration type <b>AGENT</b>, all rights specified in the current field group.</p>');

define('HELP_ADMIN_REGISTER_COMPANY_REGISTER_DEFAULT_GROUP', '<p>User selected after registration type <b>COMPANY</b>, all rights specified in the current field group.</p>');

define('HELP_ADMIN_REGISTER_TYPE_GUEST_RIGHT_ADD_ANNOUNCE', '<p>Specify the rights of unregistered users. Additional rights to unregistered users by rights groups <b>GUEST</b>.</p>');

define('HELP_ADMIN_REGISTER_USER_PASSWORD', '<p>In the field, specify the minimum number of characters in the user password.</p><p>If at registration a user password will contain fewer characters than specified in this setting, the user will be given corresponding error.</p>');


/***** НОВОСТИ *****/
define('HELP_ADMIN_NEWS_PERPAGE', '<p>Number of short news displayed on one page, on the user part.</p><p>Necessarily an integer.</p>');

define('HELP_ADMIN_NEWS_ADD_USER_TOKEN', '<p>State news after adding custom parts.</p>');

define('HELP_ADMIN_NEWS_USER_CORRECTION_TIME', '<p>Specify the time (in hours) during which users can edit their news, which the moderator posted on editing.</p><p>If the user edits the news is not within the specified time, the news will be automatically deleted.</p>');

define('HELP_ADMIN_NEWS_PUBLICATION', '<p>If the publication date of the current date and set the switch <b>Active</b>, then the news will be published in due time.</p><p>If no date is automatically set the current date.</p><p>If not set the switch <b>Active</b>, the news will be posted to the archive.</p>');

define('HELP_ADMIN_NEWS_DELETE_CORRECTION', 'You can delete all the news from the expired date of editing (news only, located on the editing).');

define('HELP_ADMIN_CONF_NEWSES_CORRECTION_THERM', '<p>Enter Term expectations fix of news, sent for repair (hours).</p>');

define('HELP_ADMIN_CONF_NEWSES_TITLE', '<p>If this option is enabled, the TITLE page will only be the name of the news, otherwise, before the name will be displayed the name of the news section of the site (News).</p>');


/***** СТАТЬИ *****/
define('HELP_ADMIN_CONF_ARTICLES_ADD_SUCCESS_ADMIN_INFORM', '<p>Enable this setting if you want to get on the Email Administrator e-mail notifying them successfully added a new article on the site.</p>');

define('HELP_ADMIN_CONF_ARTICLES_ADD_MODERATION_ADMIN_INFORM', '<p>Enable this setting if you want to get on the Email Administrator email notifications when a new article to moderation.</p>');

define('HELP_ADMIN_CONF_ARTICLES_CORRECTION_THERM', '<p>Enter Term expectations fix articles that are sent to fix (in hours).</p>');


/***** НАСТРОЙКИ ФАЙЛ-МЕНЕДЖЕРА *****/
define('HELP_ADMIN_FILEMANAGER_THUMBNAIL_WIDTH', '<p>The maximum width of the image icons.</p><p>The size will be calculated automatically on the longest side of the image, in accordance with the specified settings.</p>');

define('HELP_ADMIN_FILEMANAGER_THUMBNAIL_HEIGHT', '<p>Maximum height of the icon image.</p><p>The size will be calculated automatically on the longest side of the image, in accordance with the specified settings.</p>');


/***** ОПИСАНИЯ ШАБЛОНОВ EMAIL-СООБЩЕНИЙ *****/
define('HELP_ADMIN_MAIL_TEMPLATE_HTML', '<p class="p_2"><b>General letter template.</b></p><p class="p_2">The template contains the basic HTML-code in which to insert the content directly. The template is only used variable <b>%BODY%</b>, which is replaced by the message body. If letters from a site are sent in plain text format, then this template is not used.</p>');

define('HELP_ADMIN_MAIL_TEMPLATE_NEWS_COMMENTS_COMPLAINT', '<p class="p_2"><b>Template complaint to comment on the news.</b></p>');

define('HELP_ADMIN_MAIL_TEMPLATE_ARTICLES_COMMENTS_COMPLAINT', '<p class="p_2"><b>Template complaint to comment on the article.</b></p>');

define('HELP_ADMIN_MAIL_TEMPLATE_ADM_REG_USER', '<p class="p_2"><b>Template notifying you of new user registration.</b></p> <p class="p_2">Used variables:</p> <p class="p_2"><b>%EMAIL%</b> - email logged on user</p> <p class="p_2"><b>%ADMIN_PANEL%</b> - link to the admin panel.</p>');

define('HELP_ADMIN_MAIL_TEMPLATE_ADM_MODERATE_ANNOUNCE', '<p class="p_2"><b>Template notifying you of new ads to moderation.</b></p> <p class="p_2">Used variables:</p> <p class="p_2"><b>%ANNOUNCE_TYPE%</b> - Ad Type</p> <p class="p_2"><b>%ANNOUNCE_TITLE%</b> - headline.</p> <p class="p_2"><b>%ANNOUNCE_LINK%</b> - Link to the ad for the administrator.</p>');

define('HELP_ADMIN_MAIL_TEMPLATE_ADM_PAYMENT', '<p class="p_2"><b>Template notifying you of payment.</b></p> <p class="p_2">Used variables:</p> <p class="p_2"><b>%STATUS%</b> - payment status</p> <p class="p_2"><b>%DATA%</b> - payment details</p> <p class="p_2"><b>%ADMIN_PANEL%</b> - link to the admin panel.</p>');

define('HELP_ADMIN_MAIL_TEMPLATE_ADM_PAYMENT_HAND_ADD', '<p class="p_2"><b>Template notify an administrator to add a payment in a manual mode.</b></p>');

define('HELP_ADMIN_MAIL_TEMPLATE_ADM_PAYMENT_JUR_ADD', '<p><b>Template notify an administrator to add the payment to Jur. persons.</b></p>');

define('HELP_ADMIN_MAIL_TEMPLATE_PAYMENT_HAND_MESAGE', '<p class="p_2"><b>Template notify the user of actions to a payment to pay for the added manually.</b></p>');

define('HELP_ADMIN_MAIL_TEMPLATE_PAYMENT_JUR_MESAGE', '<p class="p_2"><b>Template notify the user of actions to a payment to pay for the added Jur. persons.</b></p>');

define('HELP_ADMIN_MAIL_TEMPLATE_ADM_ADD_ANNOUNCE', '<p class="p_2"><b>Template notifying you of the added ad.</b> <p class="p_2">Used variables:</p> <p class="p_2"><b>%ANNOUNCE_TYPE%</b> - Ad Type</p> <p class="p_2"><b>%ANNOUNCE_TITLE%</b> - headline.</p> <p class="p_2"><b>%ANNOUNCE_LINK%</b> - Link to the ad.</p> <p class="p_2"><b>%ADMIN_PANEL_LINK%</b> - Link to the ad for the administrator.</p></p>');

define('HELP_ADMIN_MAIL_TEMPLATE_ADM_EDITED_ANNOUNCE', '<p class="p_2"><b>Template notify the administrator that the user has edited the ad and it returned to moderation.</b><p class="p_2">Used variables:</p> <p class="p_2"><b>%ANNOUNCE_TYPE%</b> - Ad Type</p> <p class="p_2"><b>%ANNOUNCE_TITLE%</b> - headline.</p> <p class="p_2"><b>%ADMIN_PANEL_LINK%</b> - Link to the ad for the administrator.</p></p>');

define('HELP_ADMIN_MAIL_TEMPLATE_MODERATE_NEWS', '<p class="p_2"><b>Template notify the user of moderation News.</b></p>');

define('HELP_ADMIN_MAIL_TEMPLATE_USER_ADD_ADMIN', '<p class="p_2"><b>Template notifying the user that their account is added to the administrator.</b></p>');

define('HELP_ADMIN_MAIL_TEMPLATE_USER_ACTIVATE', '<p class="p_2"><b>Pattern of activation email-address of the user.</b></p> <p class="p_2">Used variables:</p> <p class="p_2"><b>%DATE%</b> - Registration Date</p> <p class="p_2"><b>%DELDATE%</b> - date of removal of the user, if your account is activated</p> <p class="p_2"><b>%CODE%</b> - activation code</p> <p class="p_2"><b>%ACTIVATE_PAGE%</b> - link to a page where you can enter the activation code</p> <p class="p_2"><b>%ACTIVATE_LINK%</b> - Link for rapid activation</p> <p class="p_2"><b>%SITE_URL%</b> - Link site</p> <p class="p_2"><b>%ADMIN_EMAIL%</b> - email administrator for communications</p>');

define('HELP_ADMIN_MAIL_TEMPLATE_USER_ACTIVATE_ADMIN', '<p class="p_2"><b>Template notifying the user that the administrator has activated their account.</b></p>');

define('HELP_ADMIN_MAIL_TEMPLATE_USER_MODERATE', '<p class="p_2"><b>Template notify the user that his account was moderated.</b></p>');

define('HELP_ADMIN_MAIL_TEMPLATE_USER_NOT_MODERATE', '<p class="p_2"><b>Template notifying the user that his account has not passed moderation, and was removed.</b></p>');

define('HELP_ADMIN_MAIL_TEMPLATE_USER_REGISTER', '<p class="p_2"><b>Template messages to the user for registration, if activation is disabled.</b></p> <p class="p_2">Used variables:</p> <p class="p_2"><b>%DATE%</b> - Registration Date</p> <p class="p_2"><b>%SITE_URL%</b> - link to the site</p> <p class="p_2"><b>%ADMIN_EMAIL%</b> - email administrator for communications</p>');

define('HELP_ADMIN_MAIL_TEMPLATE_NEW_PASS', '<p class="p_2"><b>Template to send a new password.</b></p> <p class="p_2">Used variables:</p> <p class="p_2"><b>%NEW_PASSWORD%</b> - New Password</p> <p class="p_2"><b>%SITE_URL%</b> - link to the site</p> <p class="p_2"><b>%ADMIN_EMAIL%</b> - email administrator for communications</p>');

define('HELP_ADMIN_MAIL_TEMPLATE_NEW_PASS_CONFIRM', '<p class="p_2"><b>Template confirm change password.</b></p> <p class="p_2">Used variables:</p> <p class="p_2"><b>%CONFIRM_LINK%</b> - Link to confirm the password change</p> <p class="p_2"><b>%SITE_URL%</b> - link to the site</p> <p class="p_2"><b>%ADMIN_EMAIL%</b> - email administrator for communications</p>');

define('HELP_ADMIN_MAIL_TEMPLATE_ANNOUNCE_SUBSCRIPTION', '<p class="p_2"><b>Template mailing ads to the user.</b></p>');

define('HELP_ADMIN_MAIL_TEMPLATE_ANNOUNCE_ACTIVATE', '<p class="p_2"><b>Pattern of activation Ads.</b></p> <p class="p_2">Used variables:</p> <p class="p_2"><b>%DATE%</b> - date and time</p> <p class="p_2"><b>%SITE_URL%</b> - link to the site</p><p class="p_2"><b>%ANNOUNCE_TYPE%</b> - Ad Type</p> <p class="p_2"><b>%ANNOUNCE_TITLE%</b> - headline.</p> <p class="p_2"><b>%DELDATE%</b> - Date and time of removal</p> <p class="p_2"><b>%CODE%</b> - activation code</p> <p class="p_2"><b>%ACTIVATE_PAGE%</b> - reference to the activation page</p> <p class="p_2"><b>%ACTIVATE_LINK%</b> - direct activation link ads</p><p class="p_2"><b>%ADMIN_EMAIL%</b> - email administrator for communications</p>');

define('HELP_ADMIN_MAIL_TEMPLATE_ANNOUNCE_ADDED', '<p class="p_2"><b>Template prompting the user to add ad.</b></p>');

define('HELP_ADMIN_MAIL_TEMPLATE_ANNOUNCE_CORRECTION', '<p class="p_2"><b>Template notify the user of the need to fix the announcement.</b></p>');

define('HELP_ADMIN_MAIL_TEMPLATE_ANNOUNCE_DELETED', '<p class="p_2"><b>Template notifying the user that the ad removed.</b></p>');

define('HELP_ADMIN_MAIL_TEMPLATE_ANNOUNCE_MODERATE', '<p class="p_2"><b>Template notifying the user that the ad sent to moderation.</b></p>');

define('HELP_ADMIN_MAIL_TEMPLATE_ANNOUNCE_PAYMENT', '<p class="p_2"><b>Template notifying the user that should pay for the added ad.</b></p>');

define('HELP_ADMIN_MAIL_TEMPLATE_ANNOUNCE_VIP_RESET', '<p class="p_2"><b>Template notifying the user that has expired VIP-status messages.</b></p>');

define('HELP_ADMIN_MAIL_TEMPLATE_ANNOUNCE_HOT_RESET', '<p class="p_2"><b>Template notifying the user that has expired HOT-status messages.</b></p>');

define('HELP_ADMIN_MAIL_TEMPLATE_ADM_MODERATE_TRN_COMPANY', '<p class="p_2"><b>Template notifying you of updates to moderate training company.</b></p>');

/***** ОПИСАНИЯ ТЕКСТОВЫХ ЯЗЫКОВЫХ ФАЙЛОВ *****/
define('HELP_ADMIN_MAIL_RESUME_DESCRIPTION_TXT', '<p class="p_2"><b>Text file describing the script possibilities when working with the ads - Summary</b></p>');

define('HELP_ADMIN_MAIL_VACANCY_DESCRIPTION_TXT', '<p class="p_2"><b>Text file describing the script possibilities when working with the ads - Jobs</b></p>');

define('HELP_ADMIN_MAIL_TEMPLATE_ADM_ADD_ARTICLE', '<p class="p_2"><b>Template notify the administrator of the article added.</b> <p class="p_2">Used variables:</p> <p class="p_2"><b>%ARTICLE_TITLE%</b> - article title.</p> <p class="p_2"><b>%ARTICLE_ID%</b> - ID article.</p> <p class="p_2"><b>%PUBLICATION_DATE%</b> - Article publication date.</p> <p class="p_2"><b>%ARTICLE_LINK%</b> - Link to article.</p> <p class="p_2"><b>%ADMIN_PANEL_LINK%</b> - link to the article to the administrator.</p></p>');

define('HELP_ADMIN_MAIL_TEMPLATE_ADM_EDITED_ARTICLE', '<p class="p_2"><b>Template notify the administrator that the user has edited the article and it returned to moderation.</b><p class="p_2">Used variables:</p> <p class="p_2"><b>%ARTICLE_TITLE%</b> - article title.</p> <p class="p_2"><b>%ARTICLE_ID%</b> - ID article.</p> <p class="p_2"><b>%PUBLICATION_DATE%</b> - Article publication date.</p> <p class="p_2"><b>%ADMIN_PANEL_LINK%</b> - link to the article to the administrator.</p></p>');

define('HELP_ADMIN_MAIL_TEMPLATE_ADM_MODERATE_ARTICLE', '<p class="p_2"><b>Template notifying you of a new article on moderation.</b></p> <p class="p_2">Used variables:</p> <p class="p_2"><b>%ARTICLE_TITLE%</b> - article title.</p> <p class="p_2"><b>%ARTICLE_ID%</b> - ID article.</p> <p class="p_2"><b>%PUBLICATION_DATE%</b> - Article publication date.</p> <p class="p_2"><b>%ADMIN_PANEL_LINK%</b> - link to the article to the administrator.</p>');

define('HELP_ADMIN_MAIL_TEMPLATE_ADM_ADD_NEWS', '<p class="p_2"><b>Template notifying you of the added news.</b> <p class="p_2">Used variables:</p> <p class="p_2"><b>%NEWS_TITLE%</b> - headline news.</p> <p class="p_2"><b>%NEWS_ID%</b> - ID news.</p> <p class="p_2"><b>%PUBLICATION_DATE%</b> - publication date news.</p> <p class="p_2"><b>%NEWS_LINK%</b> - link to news.</p> <p class="p_2"><b>%ADMIN_PANEL_LINK%</b> - Link to the news for the administrator.</p></p>');

define('HELP_ADMIN_MAIL_TEMPLATE_ADM_EDITED_NEWS', '<p class="p_2"><b>Template notify the administrator that the user has edited the news and she returned to moderation.</b><p class="p_2">Used variables:</p> <p class="p_2"><b>%NEWS_TITLE%</b> - headline news.</p> <p class="p_2"><b>%NEWS_ID%</b> - ID news.</p> <p class="p_2"><b>%PUBLICATION_DATE%</b> - publication date news.</p> <p class="p_2"><b>%ADMIN_PANEL_LINK%</b> - Link to the news for the administrator.</p></p>');

define('HELP_ADMIN_MAIL_TEMPLATE_ADM_MODERATE_NEWS', '<p class="p_2"><b>Template notifying you of newnews in moderation.</b></p> <p class="p_2">Used variables:</p> <p class="p_2"><b>%NEWS_TITLE%</b> - headline news.</p> <p class="p_2"><b>%NEWS_ID%</b> - ID news.</p> <p class="p_2"><b>%PUBLICATION_DATE%</b> - publication date news</p> <p class="p_2"><b>%ADMIN_PANEL_LINK%</b> - Link to the news for the administrator.</p>');

define('HELP_ADMIN_MAIL_TEMPLATE_USER_ARTICLE_ACTIVE', '<p class="p_2"><b>Template notifying the user that his paper has been successfully moderated, and activated.</b></p> <p class="p_2">Used variables:</p> <p class="p_2"><b>%ARTICLE_TITLE%</b> - article title.</p> <p class="p_2"><b>%PUBLICATION_DATE%</b> - Article publication date.</p> <p class="p_2"><b>%ARTICLE_LINK%</b> - Link to article.</p> <p class="p_2"><b>%USER_PANEL_LINK%</b> - reference to the section of active items in a private office.</p>');

define('HELP_ADMIN_MAIL_TEMPLATE_USER_ARTICLE_CORRECTION', '<p class="p_2"><b>Template notify the user that his paper is returned to the editing.</b></p> <p class="p_2">Used variables:</p> <p class="p_2"><b>%ARTICLE_TITLE%</b> - article title.</p> <p class="p_2"><b>%PUBLICATION_DATE%</b> - Article publication date.</p> <p class="p_2"><b>%COMMENTS%</b> - Comment moderation.</p> <p class="p_2"><b>%DELDATE%</b> - date of automatic deletion of article.</p> <p class="p_2"><b>%USER_PANEL_LINK%</b> - reference to the articles section, pending corrections, in a private office.</p>');

define('HELP_ADMIN_MAIL_TEMPLATE_USER_ARTICLE_DELETED', '<p class="p_2"><b>Template notify the user that his paper is removed.</b></p> <p class="p_2">Used variables:</p> <p class="p_2"><b>%ARTICLE_TITLE%</b> - article title.</p> <p class="p_2"><b>%COMMENTS%</b> - Comment moderation.</p>');

define('HELP_ADMIN_MAIL_TEMPLATE_USER_NEWS_ACTIVE', '<p class="p_2"><b>Template notifying the user that his news has been successfully moderated, and activated.
</b></p> <p class="p_2">Used variables:</p> <p class="p_2"><b>%NEWS_TITLE%</b> - headline news.</p> <p class="p_2"><b>%PUBLICATION_DATE%</b> - publication date news.</p> <p class="p_2"><b>%NEWS_LINK%</b> - link to news.</p> <p class="p_2"><b>%USER_PANEL_LINK%</b> - a link to the active news in the personal office.</p>');

define('HELP_ADMIN_MAIL_TEMPLATE_USER_NEWS_CORRECTION', '<p class="p_2"><b>Template notifying the user that his news back to the editing.</b></p> <p class="p_2">Used variables:</p> <p class="p_2"><b>%NEWS_TITLE%</b> - headline news.</p> <p class="p_2"><b>%PUBLICATION_DATE%</b> - publication date news.</p> <p class="p_2"><b>%COMMENTS%</b> - Comment moderation.</p> <p class="p_2"><b>%DELDATE%</b> - date of automatic deletion news.</p> <p class="p_2"><b>%USER_PANEL_LINK%</b> - reference to the news section, pending corrections, in a private office.</p>');

define('HELP_ADMIN_MAIL_TEMPLATE_USER_NEWS_DELETED', '<p class="p_2"><b>Template notifying the user that his news removed.</b></p> <p class="p_2">Used variables:</p> <p class="p_2"><b>%NEWS_TITLE%</b> - headline news.</p> <p class="p_2"><b>%COMMENTS%</b> - Comment moderation.</p>');


/***** ГРУППЫ И ОБЯЗАННОСТИ *****/
define('HELP_ADMIN_GROUP_ID', '<p>ID of the selected group. Unavailable for change.</p>');

define('HELP_ADMIN_GROUP_RIGHT_EDIT_VACANCY', '<p>The right to <b>EDIT VACANCY</b>.</p><p>If this right is enabled, users who belong to this group will be able to edit jobs, he added.</p>');

define('HELP_ADMIN_GROUP_RIGHT_DEL_VACANCY', '<p>The right to <b>DELETE VACANCY</b>.</p><p>If this right is enabled, users who belong to this group will be able to delete jobs, he added.</p>');

define('HELP_ADMIN_GROUP_RIGHT_EDIT_RESUME', '<p>The right to <b>EDIT RESUME</b>.</p><p>If this right is enabled, users who belong to this group will be able to edit the resume, he added.</p>');

define('HELP_ADMIN_GROUP_RIGHT_DEL_RESUME', '<p>The right to <b>DELETE RESUME</b>.</p><p>If this right is enabled, users who belong to this group will be able to delete the summary, he added.</p>');

define('HELP_ADMIN_GROUP_RIGHT_ADD_ARTICLES', '<p>The right to <b>ADD ARTICLES</b>.</p><p>If this right is enabled, users who belong to this group will be able to add articles.</p>');

define('HELP_ADMIN_GROUP_RIGHT_EDIT_ARTICLES', '<p>The right to <b>EDIT ARTICLES</b>.</p><p>If this right is enabled, users who belong to this group will be able to edit articles, which, he added.</p>');

define('HELP_ADMIN_GROUP_RIGHT_ARC_ARTICLES', '<p>The right to <b>ARCHIVE ARTICLES</b>.</p><p>If this right is enabled, users who belong to this group will be able to put in the archives of articles, which he added.</p>');

define('HELP_ADMIN_GROUP_RIGHT_DEL_ARTICLES', '<p>The right to <b>DELETE ARTICLES</b>.</p><p>If this right is enabled, users who belong to this group will be able to delete the article, he added.</p>');

define('HELP_ADMIN_GROUP_RIGHT_ADD_NEWS', '<p>The right to <b>ADD NEWS</b>.</p><p>If this right is enabled, users who belong to this group will be able to add news.</p>');

define('HELP_ADMIN_GROUP_RIGHT_EDIT_NEWS', '<p>The right to <b>EDIT NEWS</b>.</p><p>If this right is enabled, users who belong to this group will be able to edit the news he added.</p>');

define('HELP_ADMIN_GROUP_RIGHT_ARC_NEWS', '<p>The right to <b>ARCHIVE NEWS</b>.</p><p>If this right is enabled, users who belong to this group will be able to put in the archives of news, he added.</p>');

define('HELP_ADMIN_GROUP_RIGHT_DEL_NEWS', '<p>The right to <b>DELETE NEWS</b>.</p><p>If this right is enabled, users who belong to this group will be able to delete the news he added.</p>');

define('HELP_ADMIN_GROUP_RIGHT_ADD_TRN_COMPANY', '<p>The right to <b>ADDING A TRAINING COMPANY</b>.</p>');

define('HELP_ADMIN_GROUP_RIGHT_ADD_TRN_TRAINER', '<p>The right to <b>ADDING INFORMATION ABOUT THE TRAINER</b>.</p>');

define('HELP_ADMIN_GROUP_RESP_MODER_ACCOUNT', '<p>Responsibility <b>MODERATION USER</b>.</p><p>If this duty is enabled, the user account that is included in this group, tentatively to be checked and enabled by the administrator.</p>');

define('HELP_ADMIN_GROUP_RESP_ACT_ANNOUNCE', '<p>Responsibility <b>ACTIVATION ANNOUNCES</b>.</p><p>If this duty is enabled, users who belong to this group will be required to activate your ads, after the addition.</p>');

define('HELP_ADMIN_GROUP_RESP_MODER_ANNOUNCE', '<p>Responsibility <b>MODERATION ANNOUNCES</b>.</p><p>If this duty is enabled, the ad user who belongs to this group will be sent to moderation after the addition (and activate if you have enabled acc. obligation).</p>');

define('HELP_ADMIN_GROUP_RESP_MODER_ARTICLES', '<p>Responsibility <b>MODERATION ARTICLES</b>.</p><p>If this duty is included, the articles a user who belongs to this group will be sent to moderation after the addition.</p>');

define('HELP_ADMIN_GROUP_RESP_MODER_NEWS', '<p>Responsibility <b>MODERATION NEWS</b>.</p><p>If this duty is included, the news user who belongs to this group will be sent to moderation after the addition.</p>');

define('HELP_ADMIN_GROUP_RESP_MODER_TRN_COMPANY', '<p>Responsibility <b>MODERATION TRAINING COMPANY</b>.</p><p>If this duty is included, training company, added by the user, will be sent to moderation after the addition.</p>');

define('HELP_ADMIN_GROUP_RESP_MODER_TRN_TRAINER', '<p>Responsibility <b>MODERATION TRAINER</b>.</p><p>If this duty is included, trainer, added by the user, will be sent to moderation after the addition.</p>');



/***** ПЛАТНЫЕ УСЛУГИ *****/
define('HELP_ADMIN_PAYMENTS', '<p>On this page you can define all paid services to your site.</p><p>All settings on this page determine only the presence of a paid service. Setting the price of services is made separately in each payment module for each service that is included on this page.</p>');


/***** РАЗДЕЛ 'ПОЛЬЗОВАТЕЛИ' *****/
define('HELP_ADMIN_USERS_FILTER_ID', '<p>box, specify the ID of the desired user(s). ID must be an integer, otherwise the value is not taken into account when searching.</p> <p>permissible to 3 types of guidance values in this field:</p><p>&bull; <b>18</b> - searches for the specified user ID. In this case, with ID = 18;</p><p>&bull; <b>1,2,5,13</b> - searches for users, taking into account all of the ID. In this case, with ID = 1 and ID = 2 and ID = 5 and ID = 13;</p><p>&bull; <b>4-45</b> - searches for users in the range specified ID. In this case, will be found all users, ID which is in the range from 4 to 45.</p><p>field can be left blank. In this case, ID is not taken into account when searching.</p>');

define('HELP_ADMIN_USERS_FILTER_EMAIL', '<p>box, specify the email-address of the desired user, or a URL pattern.</p><p>Supports standard SQL to compare the pattern. When comparing the pattern symbol <b>&quot;_&quot;</b> matches any single character and <b>&quot;%&quot;</b> - a certain number of characters (including zero characters). Not case-sensitive. <b>Examples:</b></p><p>&bull; Find all the addresses that start with <b>&quot;b&quot;</b>: <b>b%</b>;</p><p>&bull; Find all addresses ending in <b>&quot;fy&quot;</b>: <b>%fy</b>;</p><p>&bull; Find all the addresses contained <b>&quot;w&quot;</b>: <b>%w%</b>;</p><p>&bull; Find all the addresses containing exactly five characters, you can with the help of pattern character <b>&quot;_&quot;</b> (to indicate it 5 times): <b>_____</b>.</p><p> field can be left blank. In this case, the Email is not taken into account when searching.</p>');

define('HELP_ADMIN_USERS_FILTER_ALIAS', '<p>In the field, enter the alias of the desired user or template alias.</p><p>Comparison of patterns in this field is identical written for the field <b>Email</b>, except for one moment. Because nickname can not be filled, we have made to search for such users.</p><p>&bull; Find all users who have not completed an alias: <b>()</b> (empty parenthesis, no spaces);</p>');

define('HELP_ADMIN_USERS_FILTER_REG_IP', '<p>In the field, enter the required IP-address or a wildcard IP-address.</p><p>Comparison of patterns in this field is identical written for the field <b>Email</b></p>');

define('HELP_ADMIN_USERS_NOT_TYPE_DELETE', '<p>Specify the time (in hours), after which the user will be deleted if not chosen account type</p>');

define('HELP_ADMIN_USERS_PAYMENT_DELETE', '<p>Specify the time (in hours), after which the user will be deleted if not paid the registration</p>');

define('HELP_ADMIN_USERS_CHANGE_NAME', '<p>Allow user to change the name and surname</p>');


/***** РАЗДЕЛ 'КОМПАНИИ' *****/
define('HELP_ADMIN_CONF_COMPANIES_PERPAGE', '<p>Specify the number of records displayed in the user part before pagination.</p>');

define('HELP_ADMIN_CONF_COMPANIES_SHOW_ONLY_WITH_LOGO', '<p>If this option is enabled, the list of companies in the user part, it will display only those companies who have uploaded their logo.</p>');

define('HELP_ADMIN_CONF_COMPANIES_DELETE_LOGO', '<p>If this option is enabled, in a private office is accessible delete function Logo.</p>');

define('HELP_ADMIN_CONF_COMPANIES_USE_VISUAL_EDITOR', '<p>Enabling this allows the use of Preset in the description of html. In this case, editing will use the visual system uses by default.</p><p><b>Attention!</b> This setting dosupna only if permitted usage of visual editor (Section <b>&quot;Settings/Site&quot;</b> Admin Panel)</p>');

define('HELP_ADMIN_CONF_COMPANIES_SHOW_MAIN_LOGO', '<p>Enable this option if you want to display on the main page logtipy selected companies.</p>');

define('HELP_ADMIN_CONF_COMPANIES_SHOW_MAIN_LOGO_QTY', '<p>In the field, enter the number of logos that appear on the front page in one line.</p><p><b>Attention!</b> This setting dosupna only if the setting display of the logo on the front page.</p>');


/***** РАЗДЕЛ 'ОБЪЯВЛЕНИЯ' *****/
define('HELP_ADMIN_CONF_ANNOUNCE_ADD_SUCCESS_ADMIN_INFORM', '<p>Enable this setting if you want to get on the Email Administrator, email notification, the successful addition of new ads Jobs/Resume on the site.</p>');

define('HELP_ADMIN_CONF_ANNOUNCE_ADD_SUCCESS_USER_INFORM', '<p>Enable this setting if you want to send to the Email Account, email notification, the successful addition of new ads Jobs/Resume on the site.</p>');

define('HELP_ADMIN_CONF_ANNOUNCE_USE_VISUAL_EDITOR', '<p>This setting allows you to include HTML-code into the text field surveys add ad.</p><p style="font-weight: bold; color: #CC3333;">Attention! Available only if your site includes the use of visual editor</p>');

define('HELP_ADMIN_CONF_ANNOUNCE_PREVIEW', '<p>Enable this setting if you want before adding users to a new ad Jobs/Resume on the website, opens a form to preview ads.</p>');

define('HELP_ADMIN_CONF_ANNOUNCE_PERPAGE_SITE', '<p>Specify the number of ads displayed on one page, in the user part</p>');

define('HELP_ADMIN_CONF_ANNOUNCE_PERPAGE_ADMIN_PANEL', '<p>Specify the number of ads displayed on one page in the admin panel</p>');

define('HELP_ADMIN_CONF_CATEGORY_PERLINE', '<p>Specify the number of columns to display categories and ads (short view). Recommended value <b>2</b></p>');

define('HELP_ADMIN_CONF_EMAIL_ATTACHMENT_FILES_ALLOW', '<p>Enable this setting if you want to allow to attach files to email sent via the website.</p>');

define('HELP_ADMIN_CONF_ANNOUNCE_USER_AGREEMENT_NOMEMBERS_REQUIRED', '<p>Enable this setting if you want to unregistered users, when adding a new board (Job / Resume) is showing a request to accept user agreement site.</p>');

define('HELP_ADMIN_CONF_EMAIL_ATTACHMENT_MAX_FILES', '<p>Specify the maximum permitted number of attachment files in the email sent through the site.</p>');

define('HELP_ADMIN_CONF_EMAIL_ATTACHMENT_FILE_MAX_SIZE', '<p>Specify the maximum allowed size of attached file in the email sent through the site.</p><p style="font-weight: bold; color: #CC3333;">Attention! File size must be specified in kilobytes.');

define('HELP_ADMIN_CONF_VACANCY_ACTIVATE_THERM', '<p>Specify the duration of the vacancy activation by Email-address (in hours)</p>');

define('HELP_ADMIN_CONF_RESUME_ACTIVATE_THERM', '<p>Specify the duration of the activation Summary Email-address (in hours)</p>');

define('HELP_ADMIN_CONF_VACANCY_CORRECTION_THERM', '<p>Enter the Term of ads posted on the fix (in hours)</p>');

define('HELP_ADMIN_CONF_RESUME_CORRECTION_THERM', '<p>Enter the Term of ads posted on the fix (in hours)</p>');

define('HELP_ADMIN_CONF_VACANCY_PAYMENT_THERM', '<p>Enter the Term of ads waiting for payment (in hours)</p>');

define('HELP_ADMIN_CONF_RESUME_PAYMENT_THERM', '<p>Enter the Term of ads waiting for payment (in hours)</p>');

define('HELP_ADMIN_CONF_VIP_STATUS', '<p>Enter the Term of status for the announcement (in hours)<br>Value&quot;0&quot; - status will be valid indefinitely.</p>');

define('HELP_ADMIN_CONF_HOT_STATUS', '<p>Enter the Term of status for the announcement (in hours)<br>Value &quot;0&quot; - status will be valid indefinitely.</p>');

define('HELP_ADMIN_CONF_VACANCY_VIP_SHOW', '<p>Enable this setting if you want on the main page displayed Jobs with VIP status.</p>');

define('HELP_ADMIN_CONF_VACANCY_VIP_SHOW_PERPAGE', '<p>Specify the number of VIP-Job, which will be displayed on the home page.</p><p style="font-weight: bold; color: #CC3333;">Attention! Available only if your site includes a map VIP-Job</p>');

define('HELP_ADMIN_CONF_VACANCY_HOT_SHOW_PERPAGE', '<p>Specify the number of HOT-Job, which will be displayed in a block HOT-Jobs.</p>');

define('HELP_ADMIN_CONF_VACANCY_LAST_SHOW', '<p>Enable this setting if you want on the main page shows the last vacancy.</p>');

define('HELP_ADMIN_CONF_VACANCY_LAST_SHOW_PERPAGE', '<p>Specify the number of recently added vacancies that will be displayed on the home page.</p><p style="font-weight: bold; color: #CC3333;">Attention! Available only if your site includes a map recently added Job</p>');

define('HELP_ADMIN_CONF_RESUME_VIP_SHOW', '<p>Enable this setting if you want on the main page display summary of the status of VIP.</p>');

define('HELP_ADMIN_CONF_RESUME_VIP_SHOW_PERPAGE', '<p>Specify the number of VIP-Summary, which will be displayed on the home page.</p><p style="font-weight: bold; color: #CC3333;">Attention! Available only if your site includes a map VIP-Summary</p>');

define('HELP_ADMIN_CONF_RESUME_HOT_SHOW_PERPAGE', '<p>Specify the number of HOT-Summary, which will be displayed in a block HOT-Summary.</p>');

define('HELP_ADMIN_CONF_RESUME_LAST_SHOW', '<p>Enable this setting if you want on the main page shows the last summary.</p>');

define('HELP_ADMIN_CONF_RESUME_LAST_SHOW_PERPAGE', '<p>Specify the number of recently added executive summary, which will be displayed on the home page.</p><p style="font-weight: bold; color: #CC3333;">Attention! Available only if your site includes a map recently added Summary</p>');

define('HELP_ADMIN_CONF_RESUME_ADD_PHOTO', '<p>Enable this setting if you want to allow users to attach photographs when adding / editing of the Summary.</p>');

define('HELP_ADMIN_CONF_RESUME_ADD_PHOTO_RESOLUTION_CONV', '<p>Specify size photographs attached to the summary.</p><p>Downloadable pictures will be automatically reduced to the specified size, aspect ratio.</p><p style="font-weight: bold; color: #CC3333;">WARNING! Available only if a site supports booting photographs.</p>');

define('HELP_ADMIN_CONF_RESUME_ADD_PHOTO_FILE_MAXSIZE', '<p>Specify the maximum file size allowed for upload.</p><p style="font-weight: bold; color: #CC3333;">WARNING! Available only if a site supports booting photographs.</p>');

/***** РАЗДЕЛ 'ПОДПИСКИ' *****/
define('HELP_ADMIN_CONF_SUBSCRIPTIONS_FREE', '<p>In the field, enter the number of available (free) subscriptions to the user. Quantity must necessarily be an integer.</p><p>If you subscribe to vacancies/resumes <b>free</b>, the user will not be able to add subscriptions to more than indicated in this setting.</p><p>If you subscribe to vacancies/resumes <b>paid</b>, then for an additional subscription to the user will need to pay. If this field is set to 0, the user will need to pay each added a subscription.</p><p>Subscriptions added by creating ads that are not accounted for this setting.</p>');

define('HELP_ADMIN_CONF_SUBSCRIPTIONS_PAYMENT_DELETE', '<p>Specify the time (in hours), after which you want to delete the unpaid subscriptions</p>');

define('HELP_ADMIN_CONF_SUBSCRIPTIONS_ANNOUNCE_PERIOD', '<p>Specify the frequency distribution of subscriptions that are added when you add ads</p>');

define('HELP_ADMIN_CONF_SUBSCRIPTIONS_START_TIME', '<p>Specify the times during the start mailing ads.</p>');

/***** РАЗДЕЛ 'СЕРВИС' *****/
define('HELP_ADMIN_CONF_ADMINISTRATION_MAINTENANCE', '<p>In carrying out engineering works on the site, it is recommended that this setting. In this case, visitors will be redirected to a page with a service message that the site carried out technical work.</p>');

define('HELP_ADMIN_CONF_ADMINISTRATION_ROBOT_RUNNING', '<p>If you enable this setting in the automatic mode will be implemented robotic database management site, according to the settings the robot site.</p>');

define('HELP_ADMIN_CONF_ADMINISTRATION_ROBOT_RUNNING_FIRST_TIME', '<p>This setting allows you to set the first run the robot site.<br>Specify a time earlier than the current one, if you want to run a robotic control site database through the night, or - more.<br><br><em><b>Note</b>: by default if the specified time is less than the current one installed on the server to the time of the first run will be added automatically for 24 hours.</em>');

define('HELP_ADMIN_CONF_ADMINISTRATION_ROBOT_RUNNING_TERM', '<p>This setting allows you to set the frequency of running the robot site (in hours/days).<br>Specify the waiting time for the next launch robotic database management site.<br><br><em><b>Note</b>: value &quot;0&quot; - robot will be run at every boot site (if the setting &quot;Perform robotic control in automatic mode&quot;) - <span style="color: #CC3333;">not recommended</span>.</em>');

define('HELP_ADMIN_UPDATE_COUNTERS', '<p>This action delete the cache readings of all counters site database, then the counters will recount automatically.</p>');

define('HELP_ADMIN_DELETE_NONVERIFY_USERS', '<p>This action removes from the site database all the accounts which, at this time has expired activation code sent to the Email-message to the user.</p>');

define('HELP_ADMIN_DELETE_NONTYPE_USERS', '<p>This action removes from the site database all the accounts which, at the moment, expired registration is completed by choosing the type of user.</p>');

define('HELP_ADMIN_DELETE_UNPAID_USERS', '<p>This action removes from the site database all the accounts which, at the moment, expired on payment of registration on the site.</p>');

define('HELP_ADMIN_DELETE_UNPAID_SUBSCRIPTIONS', '<p>This action removes from the site database all subscriptions for which, at the moment, expired on payment of accommodation.</p>');

define('HELP_ADMIN_DELETE_NONVERIFY_ANNOUNCES', '<p>This action removes from the site database all ads (at the option of the administrator: Jobs/Resumes) who, at the moment, expired activation code sent to the Email-message to the user.</p>');

define('HELP_ADMIN_DELETE_UNPAID_ANNOUNCES', '<p>This action removes from the site database all ads (at the option of the administrator: Jobs/Resumes) who, at the moment, expired on payment of accommodation.</p>');

define('HELP_ADMIN_RESET_VIP_STORAGE_LIFE_OVER', '<p>This action resets the VIP status for all ads (at the option of the administrator: Jobs/Resumes) who, at the moment, expired status.<br><br>The user is sent a notification to the Email-address specified in the declaration.</p>');

define('HELP_ADMIN_RESET_HOT_STORAGE_LIFE_OVER', '<p>This action resets the status of HOT for all ads (at the option of the administrator: Jobs/Resumes) who, at the moment, expired status.<br><br>The user is sent a notification to the Email-address specified in the declaration.</p>');

define('HELP_ADMIN_DELETE_ANNOUNCES_STORAGE_LIFE_OVER', '<p style="font-weight: bold; color: #CC3333;">Attention! This action is irreversible!</p><p>This action removes from the site database all ads (at the option of the administrator: Jobs/Resumes) who, at the moment, expired on placement.<br><br>The user is sent a notification to the Email-address specified in the declaration.</p>');

define('HELP_ADMIN_ARCHIVED_ANNOUNCES_STORAGE_LIFE_OVER', '<p style="font-weight: bold; color: #CC3333;">Attention! Should be careful to use this action, because the user can not add duplicate messages stored in the archive.</p><p>This action puts the archive site database all ads (at the option of the administrator: Jobs/Resumes) who, at the moment, expired on placement.<br><br>The user is sent uvelomlenie that his ad has been removed because expired placement.</p>');


/***** НАСТРОЙКИ RSS *****/
define('HELP_ADMIN_RSS_COUNT', '<p>The number of entries displayed per page RSS.</p>');

/**
 * НАСТРОЙКИ YVL
 */
define('HELP_ADMIN_YVL_EXPORT_PERIOD', '<p>Specify the number of days for which you want to see ads in YVL. If for instance you specify 7 days, will be ads for the week.</p>');

/***** НАСТРОЙКИ ЛОГОВ *****/
define('HELP_ADMIN_CONF_LOGS_ADMIN', '<p>This setting includes the logging of entries in the admin panel</p>');


/***** НАСТРОЙКИ ОБНОВЛЕНИЙ *****/
define('HELP_ADMIN_CONF_UPDATES_PATH_TO_FILES', '<p>Specify the directory to which files should be saved updates</p>');


/***** НАСТРОЙКИ РЕЗЕРВНЫХ КОПИЙ *****/
define('HELP_ADMIN_CONF_BACKUPS_PATH_TO_FILES', '<p>Specify the directory in which to store backup files</p>');

/***** Раздел Импорта *****/
define('HELP_ADMIN_IMPORT_SITE_URL', '<p>Enter the URL-site from which you will import data.</p>');

define('HELP_ADMIN_IMPORT_DBHOST', '<p>Specify the host to connect to the database from which to import.</p>');

define('HELP_ADMIN_IMPORT_DBNAME', '<p>Enter the name of the database from which to import.</p>');

define('HELP_ADMIN_IMPORT_DBUSER', '<p>Specify the database user name from which to import.</p>');

define('HELP_ADMIN_IMPORT_DBPASSWORD', '<p>Enter the password database from which to import.</p>');

define('HELP_ADMIN_IMPORT_NAME_TABLE_USERS', '<p>Enter the name of the user tables in the imported database.</p>');

define('HELP_ADMIN_IMPORT_NAME_TABLE_VACANCYS', '<p>Enter the name of the table positions in the imported database.</p>');

define('HELP_ADMIN_IMPORT_NAME_TABLE_RESUMES', '<p>Enter the name of the table summary in the imported database.</p>');

define('HELP_ADMIN_IMPORT_NAME_TABLE_SECTIONS', '<p>Specify the name of the partition table in the imported database.</p>');

define('HELP_ADMIN_IMPORT_NAME_TABLE_PROFESSIONS', '<p>Enter the name of the table of occupations in the imported database.</p>');

define('HELP_ADMIN_IMPORT_NAME_TABLE_REGIONS', '<p>Enter the name of the table of regions in the imported database.</p>');

define('HELP_ADMIN_IMPORT_NAME_TABLE_CITYS', '<p>Enter the name of the table of cities in the imported database.</p>');

define('HELP_ADMIN_IMPORT_NAME_TABLE_SUBSRIPTIONS', '<p>Enter the name of the subscription tables in the imported database.</p>');

define('HELP_ADMIN_IMPORT_NAME_TABLE_NEWS', '<p>Specify the table name of news in the imported database.</p>');

define('HELP_ADMIN_SEO_FILES', '<p>SEO management data section.</p>');