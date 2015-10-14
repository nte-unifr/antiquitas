<?php

class plFileHandler_file {
	public $url=false;
	public $path=false;
	public $filename = "";
	public $imagesize=false;
	public $folder = false;

	public function __construct($filepath, $fileurl, $info=array()){
		if(!file_exists($filepath))	return false;
		$this->url = $fileurl;
		$this->path = $filepath;
		$this->filename = basename($filepath);
		foreach($info as $key=>$val)	$this->$key = $val;
	}

	public function __toString(){
		if($image = $this->GetImage()){
			return $image;
		}elseif($this->url){
			return '<a href="'.$this->url.'">'.$this->filename.'</a>';
		}else{
			return '';
		}
	}
	
	public function GetImage(){
		if($this->imagesize && $this->url){
			return '<img src="'.$this->url.'" width="'.$this->width.'" height="'.$this->height.'" alt="'.$this->title.'"/>';
		}else{
			return false;
		}
	}
	
	public function GetThumb(){
		$thumbpath = str_replace($this->filename, 'thumb_'.$this->filename, $this->path);
		$thumburl = str_replace($this->filename, 'thumb_'.$this->filename, $this->url);
		if(!file_exists($thumbpath)){
			plResize($this->path, $thumbpath, 96, 96, true, false);
		}
		if($imginf = getimagesize($thumbpath)){
			if(!$imginf || !isset($imginf[1]))	return false;
			list($width, $height) = $imginf;
			return '<img border=0 src="'.$thumburl.'" width="'.$width.'" height="'.$height.'" alt=""/>';		
		}else{
			return '<img border=0 src="'.$thumburl.'" alt=""/>';		
		}
	}
}


function strlimit($string){
	global $filename_limit;
	if (strlen($string) > $filename_limit) {
		return substr($string,0,$filename_limit-1).'...';
	}else{
		return $string;
	}
}

function clean_join_path($string){
	return str_replace('/',DIRECTORY_SEPARATOR,clean_join_url($string));
}
function clean_join_url($string){
	str_replace('\\','/',$string);
	str_replace('//','/',$string);
	str_replace('//','/',$string);
	str_replace(':/','://',$string);
	return $string;
}

function createBrowseLink($newparams){
	global $params;
	foreach(array('allowedext','mode','resize','curdir','startdir','multiple') as $key){
		if(isset($params[$key]) && !isset($newparams[$key]))	$newparams[$key] = $params[$key];
	}
	
	foreach($newparams as $key=>$value){
		$href .= ($href==''?'':'&').$key.'='.urlencode($value);
	}
	return "bg_select.php?".$href;
}

function makeDirObj($filepath, $curdir){
	$filename = basename($filepath);
	$parent = ($filename == '..');
	if($parent && trim(str_replace('\\','/',$curdir), '/') == '')	return false;
	$obj = new StdClass();
	$obj->folder = true;
	$empty = array("ext","size","imagesize","deletelink","modified","owner","permissions");
	foreach($empty as $field)	$obj->$field = '';
	$obj->filename = $filename;
	$obj->pic = '<img src="images/dir.png" alt="dir"/>';
	if($parent){
		$tmp = explode('/',$curdir);
		unset($tmp[count($tmp)-1]);
		$obj->thelink = createBrowseLink( array('curdir' => implode('/',$tmp)) );
	}else{
		$obj->thelink = createBrowseLink( array('curdir' => $curdir.'/'.$filename) );
	}
	$obj->rowlink = '<a href="'.$obj->thelink.'">'.$filename."</a>";
	return $obj;
}

function makeFileObj($filepath, $fileurl){
	$info = plGetFileInfo($filepath);
	$obj = new plFileHandler_file($filepath, $fileurl, $info);
	$extension = $info['ext'];
	$obj->sizecol = '<a style="display:none;">'.$info["size"].'</a>'.$info["size_wformat"];
	$obj->imagesizecol = $info["imagesize"]?'<a style="display:none;">'.$info["width"].'</a>'.$info["imagesize"]:'';
	$obj->deletelink = '<a href="'.createBrowseLink( array('deletefile'=>$obj->filename) ).'">Supp</a>';
	$obj->thelink = createBrowseLink( array('selectfile'=>$obj->filename) );
	$obj->modified = '<a style="display:none;">'.$info["filemtime"].'</a>'.$info["modified"];
	return $obj;
}

function createPopupHeader($title){
	return '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<title>'.$title.'</title>
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<style type="text/css">

#curpath {
	float: right;
	font-size: 12px;
	color: DarkGrey;
}
#imglist a {
	font-size: 12px;
	color: #000;
	display: block;
	float: left;
	width: 150px;
	padding: 3px;
	height: 150px;
	text-decoration: none;
	text-align: center;
}
#imglist a:hover {
	background-color: #AFD3FF;
}
#imglist a img {
	border: 0;
}

#uploadform {
	text-align: center;
	padding-top: 100px;
}
#filelist {
	width: 100%;
	font-size: 12px;
}
#filelist a, #filelist a:visited {
	text-decoration: none;
}
	</style>
</head>
<body>';
}

function plGetFileInfo($filepath){
	if(!file_exists($filepath))	return false;

	$info = array();

	$info["filename"] = basename($filepath);

	$size = filesize($filepath);
	$info["size"] = $size;
	if($size > 1073741824){
		$size = round(($size/1073741824),2).' GB';
	}elseif($size > 1048576){
		$size = round(($size/1048576),2).' MB';
	}elseif($size > 1024){
		$size = round(($size/1024),2).' KB';
	}else{
		$size .= ' bytes';
	}
	$info["size_wformat"] = $size;

	$extension = strtolower(substr(strrchr($filepath, "."), 1));
	$info["ext"] = $extension;
	if(in_array($extension, array('flv','swf','wmv','mov'))){
		$info["fileicon"] = "icons/filetypes/fmedia.gif";
	}elseif(in_array($extension, array('jpeg','jpg','png','gif'))){
		$info["fileicon"] = "icons/filetypes/fpaint.gif";
	}else{
		$info["fileicon"] = "icons/filetypes/fdoc.gif";
	}	
	
	$info["imagesize"] = false;
	$imginf = getimagesize($filepath);
	if(isset($imginf[1])){
		$info["width"] = $imginf[0];
		$info["height"] = $imginf[1];
		$info["imagesize"] = $imginf[0].'x'.$imginf[1];
		$info["mime"] = (isset($imginf["mime"]))?$imginf["mime"]:false;
	}

	$info["owner"] = fileowner($filepath);
	$info["permissions"] = fileperms($filepath);

	$info["filemtime"] = filemtime($filepath);
	$info["modified"] = date("Y-m-d G:i", $info["filemtime"]);	
	
	return $info;
}

function clean_file_name($filename){
	return str_replace(array('-',' '),'_',($filename));
}

function iterate_to_unique($filepath){
	// if a file of that name exists, appends number to the filename
	$extension = strrchr($filepath, ".");
	$cleanfilename = str_replace($extension, "", $filepath);

	$i = 1;
	while(file_exists($filepath)){
		$filepath = $cleanfilename."_".$i.$extension;
		$i++;
	}
	return $filepath;
}

function plResize($fullpath, $newpath, $newwidth, $newheight=false, $transparency=false, $crop=false){
	$name = str_replace('//','/',$fullpath);
	if(!file_exists($name))	return false;
	$image_infos = getimagesize($name);
	
	$doresize = true;
	if( $image_infos[0] <= $newwidth && ($newheight == false || $image_infos[1] <= $newheight) ){
		$return = false;
	}else{
		$newname = ($newpath == ''?$fullpath:$newpath);
		$arr = split("\.",$name);
		$ext = strtolower($arr[count($arr)-1]);

		if($ext=="jpeg" || $ext=="jpg"){
			$img = @imagecreatefromjpeg($name);
		} elseif($ext=="png"){
			$img = @imagecreatefrompng($name);
		} elseif($ext=="gif") {
			$img = @imagecreatefromgif($name);
		}
		if(!$img)   return false;

		$old_x = imageSX($img);
		$old_y = imageSY($img);

		if($newheight && $crop){
			// find the wanted ratio
			$wantedratio = $newwidth/$newheight;
			$currentratio = $old_x/$old_y;
			if($currentratio > $wantedratio){
				// width is too large
				$crop_x = (int) ($old_y * $wantedratio);
				$crop_y = $old_y;
				$int_w = (int) (($old_x - $crop_x) / 2);
				$int_h = 0;
			}elseif($currentratio < $wantedratio){
				// height is too large
				$crop_x = $old_x;
				$crop_y = (int) ($old_x / $wantedratio);
				$int_h = (int) (($old_y - $crop_y) / 2);
				$int_w = 0;
			}
			if($currentratio != $wantedratio){
				// we first crop
				$dimg = ImageCreateTrueColor($crop_x, $crop_y);
				if(imagecopyresampled($dimg,$img,0,0,$int_w,$int_h,$crop_x,$crop_y,$crop_x,$crop_y)){
					imagedestroy($img);
					$img = $dimg;
				}
				$old_x = $crop_x;
				$old_y = $crop_y;				
			}
			$thumb_h = $newheight;
			$thumb_w = $newwidth;
		}else{
			$ratio = $newheight?min($newwidth / $image_infos[0], $newheight / $image_infos[1]):($newwidth / $image_infos[0]);
			$thumb_h = $image_infos[1] * $ratio;
			$thumb_w = $image_infos[0] * $ratio;
		}

		$new_img = ImageCreateTrueColor($thumb_w, $thumb_h);
	   
		if($transparency) {
			if($ext=="png") {
				imagealphablending($new_img, false);
				$colorTransparent = imagecolorallocatealpha($new_img, 0, 0, 0, 127);
				imagefill($new_img, 0, 0, $colorTransparent);
				imagesavealpha($new_img, true);
			} elseif($ext=="gif") {
				$trnprt_indx = imagecolortransparent($img);
				if ($trnprt_indx >= 0) {
					//its transparent
					$trnprt_color = imagecolorsforindex($img, $trnprt_indx);
					$trnprt_indx = imagecolorallocate($new_img, $trnprt_color['red'], $trnprt_color['green'], $trnprt_color['blue']);
					imagefill($new_img, 0, 0, $trnprt_indx);
					imagecolortransparent($new_img, $trnprt_indx);
				}
			}
		} else {
			Imagefill($new_img, 0, 0, imagecolorallocate($new_img, 255, 255, 255));
		}
		imagecopyresampled($new_img, $img, 0,0,0,0, $thumb_w, $thumb_h, $old_x, $old_y);

		if(file_exists($newname))	@unlink($newname);

		if($ext=="jpeg" || $ext=="jpg"){
			imagejpeg($new_img, $newname);
			$return = true;
		} elseif($ext=="png"){
			imagepng($new_img, $newname);
			$return = true;
		} elseif($ext=="gif") {
			imagegif($new_img, $newname);
			$return = true;
		}
		imagedestroy($new_img);
		imagedestroy($img);
		if($return) $return = $newname;
	}
	return $return;
}
