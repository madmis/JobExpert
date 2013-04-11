<?php
(!defined('SDG')) ? die ('Triple protection!') : null;

// Create Folder
function createfolder($dir,$perm) {
	if(mkdir($dir, $perm, true)) {
		chmod($dir, $perm);
		return true;	
	} else return false;
}

// Validate File Extensions
function validateExtension($extension, $types) { return in_array($extension,$types) ? false : true; }

// Display Alert Notifications
function alert(&$notify) {
	$alert_num = count($notify['type']);
	for($i=0;$i<$alert_num;$i++) echo '<div class="alert'.$notify['type'][$i].'">'.$notify['message'][$i].'</div><br />';
}

// Sort File array by selected Order
function sortfileorder(&$sortbynow,&$sortorder,&$file) {
	switch($sortbynow) {
		case 'name': array_multisort($file['sortname'], $sortorder, $file['name'], $sortorder, $file['type'], $sortorder, $file['modified'], $sortorder, $file['size'], $sortorder, $file['dimensions'], $sortorder, $file['width'], $sortorder, $file['height'], $sortorder); break;
		case 'size': array_multisort($file['size'], $sortorder, $file['sortname'], SORT_ASC, $file['name'], SORT_ASC, $file['type'], $sortorder, $file['modified'], $sortorder, $file['dimensions'], $sortorder, $file['width'], $sortorder, $file['height'], $sortorder); break;
		case 'type': array_multisort($file['type'], $sortorder, $file['sortname'], SORT_ASC, $file['name'], SORT_ASC, $file['size'], $sortorder, $file['modified'], $sortorder, $file['dimensions'], $sortorder, $file['width'], $sortorder, $file['height'], $sortorder); break;
		case 'modified': array_multisort($file['modified'], $sortorder, $file['name'], $sortorder, $file['name'], $sortorder, $file['type'], $sortorder, $file['size'], $sortorder, $file['dimensions'], $sortorder, $file['width'], $sortorder, $file['height'], $sortorder); break;
		case 'dimensions': array_multisort($file['dimensions'], $sortorder, $file['width'], $sortorder, $file['sortname'], SORT_ASC, $file['name'], SORT_ASC, $file['modified'], $sortorder, $file['type'], $sortorder, $file['size'], $sortorder, $file['height'], $sortorder); break;
		default:
	}
}

// Resize Image to given size
function resizeimage($im,$maxwidth,$maxheight,$urlandname,$comp,$imagetype) {
	$width = imagesx($im);
	$height = imagesy($im);
	if(($maxwidth && $width > $maxwidth) || ($maxheight && $height > $maxheight)) {
		if($maxwidth && $width > $maxwidth) {
			$widthratio = $maxwidth/$width;
			$resizewidth = true;
		} else $resizewidth = false;
		if($maxheight && $height > $maxheight) {
			$heightratio = $maxheight/$height;
			$resizeheight = true;
		} else $resizeheight = false;
		if($resizewidth && $resizeheight) {
			if($widthratio < $heightratio) $ratio = $widthratio;
			else $ratio = $heightratio;
		}
		elseif($resizewidth) $ratio = $widthratio;
		elseif($resizeheight) $ratio = $heightratio;
		$newwidth = $width * $ratio;
		$newheight = $height * $ratio;
		if(function_exists('imagecopyresampled') && $imagetype!='image/gif') $newim = imagecreatetruecolor($newwidth, $newheight);
		else $newim = imagecreate($newwidth, $newheight);
		imagecopyresampled($newim, $im, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
		$im = $newim;
	}
	switch ($imagetype) {
		case 'image/pjpeg':
		case 'image/jpeg': imagejpeg($im,$urlandname,$comp); break;
		case 'image/x-png':
		case 'image/png': imagepng($im,$urlandname,substr($comp,0,1)); break;
		case 'image/gif': imagegif($im,$urlandname); break;
	}
	(!empty($newim)) ? imagedestroy($newim) : null;
}

// Check Image Type and convert to temp type
function convert_image($imagetemp,$imagetype) {
	switch ($imagetype) {
		case 'image/pjpeg':
		case 'image/jpeg': $cim = imagecreatefromjpeg($imagetemp); break;
		case 'image/x-png':
		case 'image/png': $cim = imagecreatefrompng($imagetemp); break;
		case 'image/gif': $cim = imagecreatefromgif($imagetemp); break;
	}
	return $cim;
}

// Generate Form Open
function form_open($name,$class,$url,$parameters) { echo '<form name="' . $name . '" class="' . $class .'" method="post" action="' . $url.$parameters  .'">'."\n"; }

// Generate Form Select elements
function form_select($options,$name,$label,$current,$auto){
	if ($label) echo '<label for="' . $name .'">' . $label . '</label>'."\n";
	echo '<select name="' . $name . '"' . ( $auto ? 'onchange="this.form.submit();"' : '' ) . '>';
	$loopnum = count($options); 
	for($i=0;$i<$loopnum;$i++) echo '<option value="'.$options[$i][0].'"'. ($options[$i][0] == $current ? ' selected' : '') . '>' . $options[$i][1] . '</option>';
	echo '</select>'."\n";
}

// Generate Form Hidden element
function form_hidden_input($name,$value) { echo '<input type="hidden" name="' . $name . '" value="' . $value . '" />'."\n"; }

// Generate Form Text element
function form_text_input($name,$label,$value,$size,$maxlength) {
	if ($label) echo '<label for="' . $name . '">' . $label . '</label>'."\n";
	echo '<input type="text" name="' . $name . '" size="' . $size . '" maxlength="' . $maxlength . '" value="' . $value . '" />'."\n";
}

// Generate Form Submit element
function form_submit_button($name,$label,$class) {
	echo '<button' . ( $class ? ' class="' . $class . '"' : '' ) . 'type="submit" name="' . $name . '">' . $label . '</button>'."\n";
	echo '</form>';
}

// Returns True if Number is Odd
function IsOdd($num) { return (1 - ($num & 1)); }

// Truncate Text to Given Length If Required
function truncate_text($textstring,$length) {
	if (strlen($textstring) > $length) {
		$textstring = function_exists('mb_substr') ? mb_substr($textstring,0,$length) : substr($textstring,0,$length);
		$textstring.= '...';
	}
	return $textstring;
}

// Present a size (in bytes) as a human-readable value
function bytestostring($size, $precision=0) {
	$sizes = array('YB', 'ZB', 'EB', 'PB', 'TB', 'GB', 'MB', 'KB', 'B');
	$total = count($sizes);
	while($total-- && $size > 1024) $size /= 1024;
	return round($size, $precision).' '.$sizes[$total];
}

// function to clean a filename string so it is a valid filename
function clean_filename($filename){ return preg_replace("/[^a-zA-Z0-9-.]/", "_", $filename); }

// Return File MIME Type
function returnMIMEType($filename) {
	preg_match("|\.([a-z0-9]{2,4})$|i", $filename, $fileSuffix);
	switch(strtolower($fileSuffix[1])) {
		case 'js': return 'application/x-javascript';
		case 'json': return 'application/json';
		case 'jpg':
		case 'jpeg':
		case 'jpe': return 'image/jpg';
		case 'png':
		case 'gif':
		case 'bmp':
		case 'tiff': return 'image/'.strtolower($fileSuffix[1]);
		case 'css': return 'text/css';
		case 'xml': return 'application/xml';
		case 'doc':
		case 'docx': return 'application/msword';
		case 'xls':
		case 'xlt':
		case 'xlm':
		case 'xld':
		case 'xla':
		case 'xlc':
		case 'xlw':
		case 'xll': return 'application/vnd.ms-excel';
		case 'ppt':
		case 'pps': return 'application/vnd.ms-powerpoint';
		case 'rtf': return 'application/rtf';
		case 'pdf': return 'application/pdf';
		case 'html':
		case 'htm':
		case 'php': return 'text/html';
		case 'txt': return 'text/plain';
		case 'mpeg':
		case 'mpg':
		case 'mpe': return 'video/mpeg';
		case 'mp3': return 'audio/mpeg3';
		case 'wav': return 'audio/wav';
		case 'aiff':
		case 'aif': return 'audio/aiff';
		case 'avi': return 'video/msvideo';
		case 'wmv': return 'video/x-ms-wmv';
		case 'mov': return 'video/quicktime';
		case 'zip': return 'application/zip';
		case 'tar': return 'application/x-tar';
		case 'swf': return 'application/x-shockwave-flash';
		default: return function_exists('mime_content_type') ? @mime_content_type($filename) : 'unknown/' . trim($fileSuffix[1], '.');
	}
}

// Return Array of Directory Structure
function dirtree(&$alldirs,$root='',$tree='',$extPattern='*.*',$branch='',$level=0) {
	if($level==0 && is_dir($root.$tree.$branch)) {
		$filenum = count(glob($root.$tree.$branch.$extPattern,GLOB_BRACE));
		$topname = end(explode('/', rtrim($tree, '/')));
		$alldirs[] = array($branch, rtrim($topname,'/').' ('.$filenum.')', rtrim($topname,'/'), rtrim($topname,'/'), $filenum, filemtime($root.$tree.$branch));
	}
	$level++;
	$dh = @opendir($root.$tree.$branch);
	while (false!==($dirname=@readdir($dh))) {
		if($dirname != '.' && $dirname != '..' && is_dir($root.$tree.$branch.$dirname)) {
			$filenum=count(glob($root.$tree.$branch.$dirname.'/'.$extPattern,GLOB_BRACE));
			$indent = '';
			for($i=0;$i<$level;$i++) $indent.= ' &nbsp; ';
      if(strlen($indent)>0) $indent.= '&rarr; ';
			$alldirs[] = array(urlencode($branch.$dirname.'/'), $indent.$dirname.' ('.$filenum.')', $indent.$dirname, $dirname, $filenum, filemtime($root.$tree.$branch.$dirname));
			dirtree($alldirs,$root,$tree,$extPattern,$branch.$dirname.'/',$level);
		}
	}
	@closedir($dh);
	$level--;
}
