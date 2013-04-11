<?php
(!empty($_GET['configFile']) && file_exists($_GET['configFile'])) ? require_once($_GET['configFile']) : die('Not received param of name require the configuration file or the file does not exist!');

// delay script if set
if($tinybrowser['delayprocess']>0) sleep($tinybrowser['delayprocess']);

// Initialise files array and error vars
$files = array();
$good = 0;
$bad = 0;
$dup = 0;
$total = (isset($_GET['filetotal']) ? $_GET['filetotal'] : 0);

// Assign get variables
$folder = $tinybrowser['docroot'].urldecode($_GET['folder']);
$_GET['folder'] = str_replace($tinybrowser['path'][$_GET['type']], '', $_GET['folder']);

if (is_dir($folder) && $handle = opendir($folder)) {
	while (false !== ($file = readdir($handle))) {
		if ($file != "." && $file != ".." && substr($file,-1)=='_') {
			//-- File Naming
			$tmp_filename = $folder.$file;
			$dest_filename	 = $folder.rtrim($file,'_');

			//-- Duplicate Files
			if(file_exists($dest_filename)) { unlink($tmp_filename); $dup++; continue; }

			//-- Bad extensions
			$ext = end(explode('.',$dest_filename));
			if(!validateExtension($ext, $tinybrowser['prohibited'])) { unlink($tmp_filename); continue; }

			//-- Rename temp file to dest file
			rename($tmp_filename, $dest_filename);
			$good++;
   		}
	}
	closedir($handle);
}
$bad = $total-($good+$dup);
// Check for problem during upload
($total>0 && $bad==$total) ? header('Location: ./upload.php?configFile='.$_GET['configFile'].'&type='.$_GET['type'].'&folder='.$_GET['folder'].'&permerror=1&total='.$total) : header('Location: ./upload.php?configFile='.$_GET['configFile'].'&type='.$_GET['type'].'&folder='.$_GET['folder'].'&badfiles='.$bad.'&goodfiles='.$good.'&dupfiles='.$dup);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>TinyBrowser :: Process Upload</title>
</head>
<body>
<p>You won't see this.</p>
</body>
</html>