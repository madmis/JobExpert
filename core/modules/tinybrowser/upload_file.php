<?php
(file_exists('upload_conf_file.php')) ? require_once 'upload_conf_file.php' : die('Require configuration file does not exist!');

// Check hash is correct (workaround for Flash session bug, to stop external form posting)
if($_GET['obfuscate'] != md5($_SERVER['DOCUMENT_ROOT'].$tinybrowser['obfuscate'])) die(TB_DENIED);

// Check  and assign get variables
//if(isset($_GET['type'])) $typenow = $_GET['type']; else die('Error!');
if (!empty($_GET['type']) && array_key_exists($_GET['type'], $tinybrowser['path'])) {
    $typenow = $_GET['type'];
} else {
    die('Error!');
}

if(isset($_GET['folder'])) $dest_folder = urldecode($_GET['folder']); else die('Error!');

// Check file extension isn't prohibited
$ext = end(explode('.',$_FILES['Filedata']['name']));
if(!validateExtension($ext, $tinybrowser['prohibited'])) die('Error!');

// Check file data
if ($_FILES['Filedata']['tmp_name'] && $_FILES['Filedata']['name']) {	
	$source_file = $_FILES['Filedata']['tmp_name'];
	$file_name = stripslashes($_FILES['Filedata']['name']);
	if($tinybrowser['cleanfilename']) $file_name = clean_filename($file_name);
	if(is_dir($tinybrowser['docroot'].$dest_folder)) {
		$success = move_uploaded_file($source_file, $tinybrowser['docroot'].$dest_folder.'/'.$file_name.'_');
	}
	if($success) {
		header('HTTP/1.1 200 OK'); //  if this doesn't work for you, try header('HTTP/1.1 201 Created');
		?><html><head><title>File Upload Success</title></head><body>File Upload Success</body></html><?php
	}
}		
