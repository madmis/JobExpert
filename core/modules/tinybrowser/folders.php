<?php
(!empty($_GET['configFile']) && file_exists($_GET['configFile'])) ? require_once($_GET['configFile']) : die('Not received param of name require the configuration file or the file does not exist!');

if(!$tinybrowser['allowfolders']) die(TB_FODENIED);

// Assign request / get / post variables
//$typenow = isset($_GET['type']) ? $_GET['type'] : 'image';
if (!empty($_GET['type']) && array_key_exists($_GET['type'], $tinybrowser['path'])) {
    $typenow = $_GET['type'];
} else {
    $typenow = 'image';
}

$foldernow = (isset($_REQUEST['folder']) ? urldecode($_REQUEST['folder']) : '');
$dirpath = $tinybrowser['path'][$typenow];
$passfolder = '&folder='.urlencode($foldernow);

// Assign browsing options
$actionnow = isset($_POST['editaction']) ? $_POST['editaction'] : 'create';

// Initalise alert array
$notify = array(
	'type' => array(),
	'message' => array()
);
$createqty = 0;
$deleteqty = 0;
$renameqty = 0;
$errorqty = 0;

// Create any child folders with entered name
if(isset($_POST['createfolder'])) {
	foreach($_POST['createfolder'] as $parent => $newfolder) {
		if($newfolder != '') {
			$createthisfolder = $tinybrowser['docroot'].$dirpath.urldecode($_POST['actionfolder'][$parent]).clean_filename($newfolder);
			if (!file_exists($createthisfolder) && createfolder($createthisfolder,$tinybrowser['unixpermissions'])) $createqty++; else $errorqty++;
		}
	}
}

// Delete any checked folders
if(isset($_POST['deletefolder'])) {
	foreach($_POST['deletefolder'] as $delthis => $val) {
		$delthisdir = $tinybrowser['docroot'].$dirpath.urldecode($_POST['actionfolder'][$delthis]);
		if (is_dir($delthisdir) && rmdir($delthisdir)) $deleteqty++; else $errorqty++;
		if($foldernow==urldecode($_POST['actionfolder'][$delthis])) {
			$foldernow = '';
			$passfolder = '';
		}
	}
}
	
// Rename any folders with changed name
if(isset($_POST['renamefolder'])) {
	foreach($_POST['renamefolder'] as $namethis => $newname) {
		$urlparts = explode('/',rtrim(urldecode($_POST['actionfolder'][$namethis]),'/'));
		if(array_pop($urlparts) != $newname) {
			$namethisfolderfrom = $tinybrowser['docroot'].$dirpath.urldecode($_POST['actionfolder'][$namethis]);
			$renameurl = implode('/',$urlparts).'/'.clean_filename($newname).'/';
			$namethisfolderto = $tinybrowser['docroot'].$dirpath.$renameurl;
			if(is_dir($namethisfolderfrom) && rename($namethisfolderfrom,$namethisfolderto)) $renameqty++; else $errorqty++;
			if($foldernow==urldecode($_POST['actionfolder'][$namethis])) {
				$foldernow = ltrim($renameurl,'/');
				$passfolder = '&folder='.urlencode(ltrim($renameurl,'/'));
			}
		}
	}
}

// Assign directory structure to array
$dirs=array();
dirtree($dirs,$tinybrowser['docroot'],$tinybrowser['path'][$typenow],$tinybrowser['extFilesGlob'][$typenow]);

if($createqty>0) { // generate alert if folders deleted
	$notify['type'][]='success';
	$notify['message'][]=sprintf(TB_MSGCREATE, $createqty);
} elseif($deleteqty>0) { // generate alert if folders deleted
	$notify['type'][]='success';
	$notify['message'][]=sprintf(TB_MSGDELETE, $deleteqty);
} elseif($renameqty>0) { // generate alert if folders renamed
	$notify['type'][]='success';
	$notify['message'][]=sprintf(TB_MSGRENAME, $renameqty);
}

// generate alert if file errors encountered
if($errorqty>0) {
	$notify['type'][]='failure';
	$notify['message'][]=sprintf(TB_MSGEDITERR, $errorqty);
}

// count folders
$num_of_folders = (isset($dirs) ? count($dirs) : 0);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<title>TinyBrowser :: <?php echo TB_FOLDERS; ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel="stylesheet" type="text/css" media="all" href="css/stylefull_tinybrowser.css" />
<link rel="stylesheet" type="text/css" media="all" href="css/style_tinybrowser.css.php?configFile=<?php echo $_GET['configFile']; ?>" />
<script language="javascript" type="text/javascript" src="js/tinybrowser.js"></script>
</head>
<body onload="rowHighlight();">
<?php
if(count($notify['type'])>0) alert($notify);
form_open('foldertab',false,basename($_SERVER['SCRIPT_NAME']),'?configFile='.$_GET['configFile'].'&amp;type='.$typenow);
?>
<div class="tabs">
<ul>
<?php if($tinybrowser['allowbrowse']) { ?><li id="browse_tab"><span><a href="tinybrowser.php<?php echo '?configFile='.$_GET['configFile'].'&amp;type='.$typenow.$passfolder; ?>"><?php echo TB_BROWSE; ?></a></span></li><?php }
if($tinybrowser['allowedit']) echo '<li id="edit_tab"><span><a href="control.php?configFile='.$_GET['configFile'].'&amp;type='. $typenow.$passfolder.'">'. TB_CONTROL .'</a></span></li>';
if($tinybrowser['allowupload']) echo '<li id="upload_tab"><span><a href="upload.php?configFile='.$_GET['configFile'].'&amp;type='. $typenow.$passfolder.'">'. TB_UPLOAD .'</a></span></li>';
?><li id="folders_tab" class="current"><span><a href="folders.php<?php echo '?configFile='.$_GET['configFile'].'&amp;type='.$typenow.$passfolder; ?>"><?php echo TB_FOLDERS; ?></a></span></li>
</ul>
</div>
</form>
<div class="panel_wrapper">
<div id="general_panel" class="panel currentmod">
<fieldset>
<legend><?php echo TB_FOLDERS; ?></legend>
<?php form_open('edit','custom',basename($_SERVER['SCRIPT_NAME']),'?configFile='.$_GET['configFile'].'&amp;type='.$typenow.$passfolder); ?>
<div class="pushleft">
<?php
// Assign edit actions based on file type and permissions
$select = array();
if($tinybrowser['allowfolders']) $select[] = array('create',TB_CREATE);
if($tinybrowser['allowdelete']) $select[] = array('delete',TB_DELETE);
if($tinybrowser['allowedit']) $select[] = array('rename',TB_RENAME);
form_select($select,'editaction',TB_ACTION,$actionnow,true);
?>
</form>
</div>
<?php
form_open('actionform','custom',basename($_SERVER['SCRIPT_NAME']),'?configFile='.$_GET['configFile'].'&amp;type='.$typenow.$passfolder);

if($actionnow=='move') { 
	echo '<div class="pushleft">';
	form_select($editdirs,'destination',TB_FOLDERDEST,urlencode($foldernow),false);
	echo '</div>';
}

switch($actionnow) {
	case 'delete': $actionhead = TB_DELETE; break;
	case 'rename': $actionhead = TB_RENAME; break;
	case 'create': $actionhead = TB_CREATE; break;
	default:
}
?>
<div class="tabularwrapper">
<table class="browse">
<tr>
<th class="nohvr"><?php echo TB_FOLDERNAME; ?></th>
<th class="nohvr"><?php echo TB_FILES; ?></th>
<th class="nohvr"><?php echo TB_DATE; ?></th>
<th class="nohvr"><?php echo $actionhead; ?></th>
</tr>
<?php
for($i=0;$i<$num_of_folders;$i++) {
	$disable = ($i == 0 ? true : false);
	$alt = (IsOdd($i) ? 'r1' : 'r0');
	echo '<tr class="'.$alt.'">';
	echo '<td>'.$dirs[$i][2].'</td>';
	echo '<td>'.$dirs[$i][4].'</td>';
	echo '<td>'.date($tinybrowser['dateformat'],$dirs[$i][5]).'</td>';
	echo '<td>';
	form_hidden_input('actionfolder['.$i.']',$dirs[$i][0]);
	switch($actionnow) {
		case 'create':
			echo '&rarr; ';
			form_text_input('createfolder['.$i.']',false,'',30,120);
		break;
		case 'delete':
			$disabledel = ($dirs[$i][4] > 0 ? ' DISABLED' : '');
			if(!$disable) echo '<input class="del" type="checkbox" name="deletefolder['.$i.']" value="1"'.$disabledel.' />';
		break;
		case 'rename': if(!$disable) form_text_input('renamefolder['.$i.']',false,$dirs[$i][3],30,120); break;
		default:
	}
	echo "</td></tr>\n";
}

echo "</table></div>\n".'<div class="pushright">';
if($tinybrowser['allowdelete'] && $tinybrowser['allowedit']) {
	form_hidden_input('editaction',$actionnow);
	form_submit_button('commit',$actionhead.' '.TB_FOLDERS,'edit');
}
?>
</div></fieldset></div></div>
</body>
</html>