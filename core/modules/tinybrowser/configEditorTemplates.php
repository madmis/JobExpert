<?php
if (!defined('SDG'))
{
	session_start();
	// delete config file for uploads
	@unlink('upload_conf_file.php');
	(empty($_SESSION['administrator_login']) || empty($_SESSION['administrator_password'])) ? die ('Triple protection!') : null;
	define('SDG', true);
}

error_reporting(E_ALL);

// set script time out higher
set_time_limit(240);

$tinybrowser = array();
// Default is rtrim($_SERVER['DOCUMENT_ROOT'],'/') (suitable when using absolute paths, but can be set to '' if using relative paths)
$tinybrowser['docroot'] = rtrim($_SERVER['DOCUMENT_ROOT'],'/');

if (file_exists($tinybrowser['docroot'] . '/core/classes/lib/secure.class.php')) {
    require_once $tinybrowser['docroot'] . '/core/classes/lib/secure.class.php';
} elseif (file_exists('i:/home/expert.core/classes/lib/secure.class.php')) {
    require_once 'i:/home/expert.core/classes/lib/secure.class.php';
} else {
    die(TB_DENIED);
}

secure::clearRequestData(true);

// Random string used to secure Flash upload if session control not enabled - be sure to change!
$tinybrowser['obfuscate'] = 's0merand0mjunk!!!111';

// Set default language (ISO 639-1 code)
$tinybrowser['language'] = 'en';

// Folder permissions for Unix servers only
$tinybrowser['unixpermissions'] = 0777;

// File upload paths (set to absolute by default)
$tinybrowser['path']['image'] = '/templates/site/'.((!empty($_COOKIE['adm_currTmplManage']) && is_dir($tinybrowser['docroot'].'/templates/site/'.$_COOKIE['adm_currTmplManage'])) ? $_COOKIE['adm_currTmplManage'] : 'default').'/images/'; // Image files location
//$tinybrowser['path']['media'] = '/templates/site/default/images/'; // Media files location
//$tinybrowser['path']['file'] = '/templates/site/default/images/'; // Other files location

// File link paths - these are the paths that get passed back to TinyMCE or your application (set to equal the upload path by default)
$tinybrowser['link']['image'] = $tinybrowser['path']['image']; // Image links
//$tinybrowser['link']['media'] = $tinybrowser['path']['media']; // Media links
//$tinybrowser['link']['file'] = $tinybrowser['path']['file']; // Other file links

// File upload size limit (0 is unlimited)
$tinybrowser['maxsize']['image'] = 0; // Image file maximum size
$tinybrowser['maxsize']['media'] = 0; // Media file maximum size
$tinybrowser['maxsize']['file'] = 0; // Other file maximum size

// Image automatic resize on upload (0 is no resize)
$tinybrowser['imageresize']['width'] = 0;
$tinybrowser['imageresize']['height'] = 0;


// Image size in pixels
$tinybrowser['thumbsize'] = 100;
$tinybrowser['imgdetailsize'] = 300;

// Image quality, higher is better (1 to 99)
$tinybrowser['imagequality'] = 80; // only used when resizing or rotating

// Date format, as per php date function
$tinybrowser['dateformat'] = 'd/m/Y H:i';

// Permitted file extensions
$tinybrowser['filetype']['image'] = '*.jpg, *.jpeg, *.gif, *.png'; // Image file types
$tinybrowser['extFilesGlob']['image'] = '*.{jpg,jpeg,gif,png}';
$tinybrowser['filetype']['media'] = '*.swf, *.dcr, *.mov, *.qt, *.mpg, *.mp3, *.mp4, *.mpeg, *.avi, *.wmv, *.wm, *.asf, *.asx, *.wmx, *.wvx, *.rm, *.ra, *.ram'; // Media file types
$tinybrowser['extFilesGlob']['media'] = '*.{swf,dcr,mov,qt,mpg,mp3,mp4,mpeg,avi,wmv,wm,asf,asx,wmx,wvx,rm,ra,ram}'; // Media file types
$tinybrowser['filetype']['file'] = '*.*'; // Other file types
$tinybrowser['extFilesGlob']['file'] = '*.*'; // Other file types

// Prohibited file extensions
$tinybrowser['prohibited'] = array('php','php3','php5','phtml','asp','aspx','ascx','jsp','cfm','cfc','pl','bat','exe','dll','reg','cgi', 'sh', 'py');

// Default file sort
$tinybrowser['order']['by'] = 'name'; // Possible values: name, size, type, modified
$tinybrowser['order']['type'] = 'asc'; // Possible values: asc, desc

// Default image view method
$tinybrowser['view']['image'] = 'thumb'; // Possible values: thumb, detail

// File Pagination - split results into pages (0 is none)
$tinybrowser['pagination'] = 0;

// TinyBrowser pop-up window size
$tinybrowser['window']['width']  = 770;
$tinybrowser['window']['height'] = 480;

// Assign Permissions for Upload, Edit, Delete & Folders
$tinybrowser['allowbrowse'] = false;
$tinybrowser['allowupload'] = true;
$tinybrowser['allowedit'] = true;
$tinybrowser['allowdelete'] = true;
$tinybrowser['allowfolders'] = true;

// Clean filenames on upload
$tinybrowser['cleanfilename'] = true;

// Set default action for edit page
$tinybrowser['defaultaction'] = 'delete'; // Possible values: delete, rename, move

// Set delay for file process script, only required if server response is slow
$tinybrowser['delayprocess'] = 0; // Value in seconds

// Set language
require_once('langs/ru.php');

require_once('fns_tinybrowser.php');
