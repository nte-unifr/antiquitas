<?php
require "functions.plFileHandler.php";

$params = array();
foreach($_GET as $key=>$val)	$params[$key] = urldecode($val);
$params = array_merge($params, $_POST);


if(isset($params['mode']) && in_array($params['mode'],array('image','file'))){
	$mode = $params['mode'];
}else{
	$mode = 'file';
}


$imgext = array('jpeg','jpg','png','gif');
$allowedext = isset($params['allowedext'])?$params['allowedext']:false;
if($allowedext && $allowedext != ''){
	$allowedext = array();
	foreach(explode(',',$params['allowedext']) as $ext){
		if($mode == 'image'){
			if(in_array($ext, $imgext))	array_push($allowedext, strtolower(trim($ext)));
		}else{
			array_push($allowedext, strtolower(trim($ext)));
		}
	}
}elseif($mode == 'image'){
	$allowedext = $imgext;
}else{
	$allowedext = false;
}


$allowdelete = false;

$filename_limit = 20;

$uploads_path = clean_join_path(dirname(__FILE__).'/files');

$startdir = isset($params['startdir'])?'/'.ltrim($params['startdir'],'/'):'';
$path_base = clean_join_path($uploads_path.$startdir);
$curdir = isset($params['curdir'])?'/'.ltrim($params['curdir'],'/'):'';
$current_path = clean_join_path($path_base.$curdir);
$current_url = clean_join_url('files/'.$startdir.$curdir);


if ($allowdelete && isset($params['deletefile'])){
	$filepath = clean_join_path($current_path.'/'.$params['deletefile']);
	if(file_exists($filepath) && unlink($filepath)){
		$message = "File deleted";
	}
}


echo createPopupHeader('File selection');

/* FORM SUBMISSION */

if(isset($params['selectfile']) && $params['selectfile'] != ''){
	$filename = $params['selectfile'];
	$filepath = clean_join_path($current_path.'/'.$filename);
	if(file_exists($filepath)){
		$returnUrl = clean_join_url($startdir.'/'.$curdir.'/'.$filename);	
		echo '<script type="text/javascript">
	if(parent && parent.plFileHandler){
		parent.plFileHandler.do_return("'.ltrim(clean_join_url($returnUrl),'/').'");
	}else{
		if(plFileHandler)	plFileHandler.do_return("'.ltrim(clean_join_url($returnUrl),'/').'");
	}		
	</script><p>File selected</p>';
	}else{
		echo '<p>Could not find file...</p>';
	}
	echo '</body></html>';
	exit;
}





###################################################
# RETRIEVING FILES & FOLDERS
#

$dh  = opendir($current_path);
$folders = array();
$files = array();
$upfolder = false;
while ($filename = readdir($dh)){
	$filepath = clean_join_path($current_path.'/'.$filename);
	$fileurl = clean_join_url($current_url.'/'.$filename);
	if(is_dir($filepath) && $filename!='.'){
		$obj = makeDirObj($filepath, $curdir);
		if ($filename=='..') {
			if($obj)	$upfolder = $obj;
		}else{
			if($obj)	array_push($folders, $obj);
		}
	}elseif($filename != '.'){
		$extension = strtolower(substr(strrchr($filename, "."), 1));
		if(!$allowedext || in_array($extension, $allowedext) && (substr($filename,0,6) != 'thumb_' && substr($filename,0,8) != 'plthumb_') ){
			$obj = makeFileObj($filepath, $fileurl);
			$obj->onclick = ($resize && $resize_existing)?false:"plFileHandler_return('".ltrim(clean_join_url($startdir.'/'.$curdir.'/'.$obj->filename),'/')."'); return false;";
			array_push($files, $obj);
		}
	}
}
if (isset($dh))	closedir($dh);
sort($folders);
sort($files);


if(isset($message))	echo '<p>'.$message.'</p>';
echo '<span id="curpath">'.$current_path.'</span>';
echo '<p>Choisissez un fichier</p>';

echo '
<script type="text/javascript">
function plFileHandler_return(returnValue){
	if(parent && parent.plFileHandler){
		parent.plFileHandler.do_return(returnValue);
	}else{
		if(plFileHandler)	plFileHandler.do_return(returnValue);
	}
}
</script>
';

if($mode == 'image'){
	echo '<div id="imglist">';
	if($upfolder){
		echo '<a href="'.$upfolder->thelink.'" class="onefile">';
		echo '<br/>'.$upfolder->pic.'<br/>'.$upfolder->filename;
		echo '</a>';		
	}
	foreach($folders as $folder){
		echo '<a href="'.$folder->thelink.'" class="onefile">';
		echo '<br/>'.$folder->pic.'<br/>'.$folder->filename;
		echo '</a>';
	}
	foreach($files as $file){
		echo '<a class="onefile" href="'.$file->thelink.'" onclick="'.$file->onclick.'">';
		echo $file->GetThumb().'<br/>'.strlimit($file->filename).'<br/>'.$file->imagesize.'';
		echo '</a>';
	}
	echo '</div></body></html>';
}else{

	echo '<table id="filelist">
<thead>
	<tr><th>Filename</th><th>Size</th><th>Dimensions</th></tr>
</thead>
<tbody>
';
	foreach($folders as $folder){
		echo '<tr><td>'.$folder->rowlink.'/</td><td></td><td></td></tr>';
	}
	foreach($files as $file){
		echo '<tr>
	<td><a href="'.$file->rowlink.'" onclick="'.$file->onclick.'">'.$file->filename.'</a></td>
	<td>'.$file->size_wformat.'</td><td>'.$file->imagesize.'</td></tr>';
	}
	echo '</tbody></table>';
}
