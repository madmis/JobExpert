<?php
require_once('config_tinybrowser.php');
// Set language
require_once (!empty($tinybrowser['language']) && file_exists('langs/'.$tinybrowser['language'].'.php')) ? 'langs/'.$tinybrowser['language'].'.php' : 'langs/en.php'; // Falls back to English
require_once('fns_tinybrowser.php');

// Check session, if it exists
if( (session_id()!='') && (!isset($_SESSION[$tinybrowser['sessioncheck']])) ) die(TB_DENIED);

// Assign file operation variables
//$typenow = isset($_GET['type']) ? $_GET['type'] : 'image';
if (!empty($_GET['type']) && array_key_exists($_GET['type'], $tinybrowser['path'])) {
    $typenow = $_GET['type'];
} else {
    $typenow = 'image';
}
//$standalone = (isset($_GET['feid']) && $_GET['feid']!='') ? true : false;
$standalone = (!empty($_GET['feid'])) ? true : false;
$foldernow = isset($_REQUEST['folder']) ? urldecode($_REQUEST['folder']) : '';

if($standalone) {
	$passfeid = '&feid='.$_GET['feid'];	
	$rowhlightinit =  ' onload="rowHighlight();"';
} else {
	$passfeid = '';
	$rowhlightinit =  '';	
}

// Assign browsing options
$sortbynow = isset($_REQUEST['sortby']) ? $_REQUEST['sortby'] : $tinybrowser['order']['by'];
$sorttypenow = isset($_REQUEST['sorttype']) ? $_REQUEST['sorttype'] : $tinybrowser['order']['type'];
$sorttypeflip = $sorttypenow == 'asc' ? 'desc' : 'asc';
$viewtypenow = isset($_REQUEST['viewtype']) ? $_REQUEST['viewtype'] : $tinybrowser['view']['image'];
$findnow = !empty($_POST['find']) ? $_POST['find'] : false;
$showpagenow = isset($_REQUEST['showpage']) ? $_REQUEST['showpage'] : 0;

// Assign url pass variables
$passfolder = '&folder='.urlencode($foldernow);
$passfeid = isset($_GET['feid']) && $_GET['feid']!='' ? '&feid='.$_GET['feid'] : '';
$passfind = '&action='.$findnow;
$passviewtype = '&viewtype='.$viewtypenow;
$passsortby = '&sortby='.$sortbynow.'&sorttype='.$sorttypenow;

// Assign view, thumbnail and link paths
$browsepath = $tinybrowser['path'][$typenow].$foldernow;
$linkpath = $tinybrowser['link'][$typenow].$foldernow;
$thumbpath = $tinybrowser[$tinybrowser['thumbsrc']][$typenow].$foldernow;

// Assign sort parameters for column header links
$sortbyget = array();
$sortbyget['name'] = '&viewtype='.$viewtypenow.'&sortby=name';
$sortbyget['size'] = '&viewtype='.$viewtypenow.'&sortby=size'; 
$sortbyget['type'] = '&viewtype='.$viewtypenow.'&sortby=type'; 
$sortbyget['modified'] = '&viewtype='.$viewtypenow.'&sortby=modified';
$sortbyget['dimensions'] = '&viewtype='.$viewtypenow.'&sortby=dimensions'; 
$sortbyget[$sortbynow] .= '&sorttype='.$sorttypeflip;

// Assign css style for current sort type column
$thclass = array();
$thclass['name'] = '';
$thclass['size'] = ''; 
$thclass['type'] = ''; 
$thclass['modified'] = '';
$thclass['dimensions'] = ''; 
$thclass[$sortbynow] = ' class="'.$sorttypenow.'"';

// Initalise alert array
$notify = array(
	'type' => array(),
	'message' => array()
);
$newthumbqty = 0;

// read folder contents if folder exists
if(file_exists($tinybrowser['docroot'].$browsepath)) {
	// Read directory contents and populate $file array
	$dh = opendir($tinybrowser['docroot'].$browsepath);
	$file = array();
	while (false!==($filename = readdir($dh))) {
		if($filename != '.' && $filename != '..' && !is_dir($tinybrowser['docroot'].$browsepath.$filename) && !empty($tinybrowser['filetype'][$typenow]) && (false !== strpos($tinybrowser['filetype']['image'], end(explode('.', $filename))) || false !== strpos('*', end(explode('.', $filename))))) {
			//echo 'ok'.preg_quote(clean_filename($findnow)).':';
			// search file name if search term entered
			$exists = $findnow ? preg_match('/'.preg_quote(clean_filename($findnow)).'/i', $filename) : true;

			// assign file details to array, for all files or those that match search
			if( $exists ) {
				$file['name'][] = $filename;
				$file['sortname'][] = strtolower($filename);
				$file['modified'][] = filemtime($tinybrowser['docroot'].$browsepath.$filename);
				$file['size'][] = filesize($tinybrowser['docroot'].$browsepath.$filename);

				// image specific info or general
				if($typenow=='image' && $imginfo = @getimagesize($tinybrowser['docroot'].$browsepath.$filename)) {
					$file['width'][] = $imginfo[0];
					$file['height'][] = $imginfo[1];
					$file['dimensions'][] = $imginfo[0] + $imginfo[1];
					$file['type'][] = $imginfo['mime'];

					// Check a thumbnail exists
					if(!file_exists($tinybrowser['docroot'].$browsepath.$tinybrowser['thumbdir'].'/')) createfolder($tinybrowser['docroot'].$browsepath.$tinybrowser['thumbdir'].'/',$tinybrowser['unixpermissions']);
			  	$thumbimg = $tinybrowser['docroot'].$browsepath.$tinybrowser['thumbdir'].'/' .$tinybrowser['thumbprefix'].$filename;
					if (!file_exists($thumbimg)) {
						$nothumbimg = $tinybrowser['docroot'].$browsepath.$filename;
						$mime = getimagesize($nothumbimg);
						$im = convert_image($nothumbimg,$mime['mime']);
						resizeimage($im,$tinybrowser['thumbsize'],$tinybrowser['thumbsize'],$thumbimg,$tinybrowser['thumbquality'],$mime['mime']);
						imagedestroy($im);
						$newthumbqty++;
					}
				} else {
					$file['width'][] = 'N/A';
					$file['height'][] = 'N/A';
					$file['dimensions'][] = 'N/A';
					$file['type'][] = returnMIMEType($filename);
				}
			}
		}
	}
	closedir($dh);
}/* else { // create file upload folder
	$success = createfolder($tinybrowser['docroot'].$browsepath,$tinybrowser['unixpermissions']);
	if($success) {
		if($typenow=='image') createfolder($tinybrowser['docroot'].$browsepath.$tinybrowser['thumbdir'].'/',$tinybrowser['unixpermissions']);
		$notify['type'][]='success';
		$notify['message'][]=sprintf(TB_MSGMKDIR, $browsepath);
	} else {
		$notify['type'][]='error';
		$notify['message'][]=sprintf(TB_MSGMKDIRFAIL, $browsepath);
	}
}*/

// Assign directory structure to array
$browsedirs=array();
dirtree($browsedirs,$tinybrowser['docroot'],$tinybrowser['path'][$typenow]);

// generate alert if new thumbnails created
if($newthumbqty>0) {
	$notify['type'][]='info';
	$notify['message'][]=sprintf(TB_MSGNEWTHUMBS, $newthumbqty);
}

// determine sort order
$sortorder = ($sorttypenow == 'asc' ? SORT_ASC : SORT_DESC);
$num_of_files = (isset($file['name']) ? count($file['name']) : 0);

if($num_of_files>0) {
	// sort files by selected order
	sortfileorder($sortbynow,$sortorder,$file);
}

// determine pagination
if($tinybrowser['pagination']>0) {
	$showpage_start = ($showpagenow ? ($_REQUEST['showpage']*$tinybrowser['pagination'])-$tinybrowser['pagination'] : 0);
	$showpage_end = $showpage_start+$tinybrowser['pagination'];
	if($showpage_end>$num_of_files) $showpage_end = $num_of_files;
} else {
	$showpage_start = 0;
	$showpage_end = $num_of_files;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<title>TinyBrowser :: <?php echo TB_BROWSE; ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<?php
if(!$standalone && $tinybrowser['integration']=='tinymce') { ?><script language="javascript" type="text/javascript" src="../../tiny_mce_popup.js"></script><?php }
else { ?><link rel="stylesheet" type="text/css" media="all" href="css/stylefull_tinybrowser.css" /><?php }
?>
<link rel="stylesheet" type="text/css" media="all" href="css/style_tinybrowser.css.php" />
<script language="javascript" type="text/javascript" src="js/tinybrowser.js.php?<?php echo substr($passfeid,1); ?>"></script>
</head>
<body<?php echo $rowhlightinit; ?>>

<p>TinyBrowser is distributed under a tri-licence - the <a href="http://www.lunarvis.com/products/tinymcefilebrowserwithupload.php#download" target="_blank"> Single Domain licence</a> is suitable for use on one website, the <a href="http://www.lunarvis.com/products/tinymcefilebrowserwithupload.php#download" target="_blank">Multiple Domain licence</a> is suitable for multiple websites, and the Commercial licence is suitable for developers who wish to distribute TinyBrowser in their commercial products.</p>
<p>If you want to use TinyBrowser, you should <a href="http://www.lunarvis.com/products/tinymcefilebrowserwithupload.php#download" target="_blank">buy it</a>.</p>

<?php
if(count($notify['type'])>0) alert($notify);
form_open('foldertab',false,basename($_SERVER['SCRIPT_NAME']),'?type='.$typenow.$passviewtype.$passsortby.$passfeid);
?>
<div class="tabs">
<ul>
<li id="browse_tab" class="current"><span><a href="tinybrowser.php?type=<?php echo $typenow.$passfolder.$passfeid; ?>"><?php echo TB_BROWSE; ?></a></span></li><?php
if($tinybrowser['allowupload']) { ?><li id="upload_tab"><span><a href="upload.php?type=<?php echo $typenow.$passfolder.$passfeid; ?>"><?php echo TB_UPLOAD; ?></a></span></li><?php	}
if($tinybrowser['allowedit'] || $tinybrowser['allowdelete']) { ?><li id="edit_tab"><span><a href="edit.php?type=<?php echo $typenow.$passfolder.$passfeid; ?>"><?php echo TB_EDIT; ?></a></span></li><?php }
if($tinybrowser['allowfolders']) { ?><li id="folders_tab"><span><a href="folders.php?type=<?php echo $typenow.$passfolder.$passfeid; ?>"><?php echo TB_FOLDERS; ?></a></span></li><?php }
// Display folder select, if multiple exist
if(count($browsedirs)>1) {
	?><li id="folder_tab" class="right"><span><?php
	form_select($browsedirs,'folder',TB_FOLDERCURR,urlencode($foldernow),true);
	?></span></li><?php
} 
?>
</ul>
</div>
</form>
<div class="panel_wrapper">
<div id="general_panel" class="panel currentmod">
<fieldset>
<legend><?php echo TB_BROWSEFILES; ?></legend>
<?php form_open('browse','custom',basename($_SERVER['SCRIPT_NAME']),'?type='.$typenow.$passfolder.$passfeid); ?>
<div class="pushleft">
<?php
// Offer view type if file type is image
if($typenow=='image') {
	$select = array(
		array('thumb',TB_THUMBS),
		array('detail',TB_DETAILS)
	);
	form_select($select,'viewtype',TB_VIEW,$viewtypenow,true);
}

// Show page select if pagination is set
if($tinybrowser['pagination']>0) {
	$pagelimit = ceil($num_of_files/$tinybrowser['pagination'])+1;
	$page = array();
	for($i=1;$i<$pagelimit;$i++) {
		$page[] = array($i,TB_PAGE.' '.$i);
	}
	if($i>2) form_select($page,'showpage',TB_SHOW,$showpagenow,true);
}
?></div><div class="pushright"><?php
form_hidden_input('sortby',$sortbynow);
form_hidden_input('sorttype',$sorttypenow);
form_text_input('find',false,$findnow,25,50);
form_submit_button('search',TB_SEARCH,'');
?></div><?php
// if image show dimensions header
$imagehead = ($typenow=='image') ? '<th><a href="?type='.$typenow.$passfolder.$passfeid.$sortbyget['dimensions'].'"'.$thclass['dimensions'].'>'.TB_DIMENSIONS.'</a></th>' : '';

echo '<div class="tabularwrapper"><table class="browse">'
	.'<tr><th><a href="?type='.$typenow.$passfolder.$passfeid.$sortbyget['name'].'"'.$thclass['name'].'>'.TB_FILENAME.'</a></th>'
	.'<th><a href="?type='.$typenow.$passfolder.$passfeid.$sortbyget['size'].'"'.$thclass['size'].'>'.TB_SIZE.'</a></th>'
	.$imagehead
	.'<th><a href="?type='.$typenow.$passfolder.$passfeid.$sortbyget['type'].'"'.$thclass['type'].'>'.TB_TYPE.'</th>'
	.'<th><a href="?type='.$typenow.$passfolder.$passfeid.$sortbyget['modified'].'"'.$thclass['modified'].'>'.TB_DATE.'</th></tr>';

// show image thumbnails, unless detail view is selected
if($typenow=='image' && $viewtypenow != 'detail') {
	echo '</table></div>';
	for($i=$showpage_start;$i<$showpage_end;$i++) {
		echo '<div class="img-browser"><a href="#" onclick="selectURL(\''.$linkpath.$file['name'][$i].'\');" title="'.TB_FILENAME.': '.$file['name'][$i]
			.'&#13;&#10;'.TB_DIMENSIONS.': '.$file['width'][$i].' x '.$file['height'][$i]
			.'&#13;&#10;'.TB_DATE.': '.date($tinybrowser['dateformat'],$file['modified'][$i])
			.'&#13;&#10;'.TB_TYPE.': '.$file['type'][$i]
			.'&#13;&#10;'.TB_SIZE.': '.bytestostring($file['size'][$i],1)
			.'"><img src="'.$thumbpath.$tinybrowser['thumbdir'].'/' .$tinybrowser['thumbprefix'].$file['name'][$i]
			.'"  /><div class="filename">'.$file['name'][$i].'</div></a></div>';
		}
	} else {
	for($i=$showpage_start;$i<$showpage_end;$i++) {
		$alt = (IsOdd($i) ? 'r1' : 'r0');
		echo '<tr class="'.$alt.'">';
		if($typenow=='image') echo '<td><a class="imghover" href="#" onclick="selectURL(\''.$linkpath.$file['name'][$i].'\');" title="'.$file['name'][$i].'"><img src="'.$thumbpath.$tinybrowser['thumbdir'].'/' .$tinybrowser['thumbprefix'].$file['name'][$i].'" alt="" />'.truncate_text($file['name'][$i],30).'</a></td>';
		else echo '<td><a href="#" onclick="selectURL(\''.$linkpath.$file['name'][$i].'\');" title="'.$file['name'][$i].'">'.truncate_text($file['name'][$i],30).'</a></td>';
		echo '<td>'.bytestostring($file['size'][$i],1).'</td>';
		if($typenow=='image') echo '<td>'.$file['width'][$i].' x '.$file['height'][$i].'</td>';	
		echo '<td>'.$file['type'][$i].'</td>'
			.'<td>'.date($tinybrowser['dateformat'],$file['modified'][$i]).'</td></tr>'."\n";
	}
	echo '</table></div>';
}
?>
</fieldset></div></div>
<form name="passform"><input name = "fileurl" type="hidden" value= "" /></form>
</body>
</html>
