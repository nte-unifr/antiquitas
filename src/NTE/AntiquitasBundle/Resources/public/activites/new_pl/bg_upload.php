<?php
require "functions.plFileHandler.php";

$params = array_merge($_GET, $_POST);

$crop = false;
if(isset($params['resize'])){
	$resize = explode('x',$params['resize']);
	if(count($resize)==2 && $resize[0] > 0 && $resize[1] > 0){
		$crop = isset($params['crop'])?$params['crop']:false;
	}else{
		$resize = false;
	}
}


$imgext = array('jpeg','jpg','png','gif');
$allowedext = isset($params['allowedext'])?$params['allowedext']:false;
if($allowedext && $allowedext != ''){
	$allowedext = array();
	foreach(explode(',',$params['allowedext']) as $ext){
		if($resize || $mode == 'image'){
			if(in_array($ext, $imgext))	array_push($allowedext, strtolower(trim($ext)));
		}else{
			array_push($allowedext, strtolower(trim($ext)));
		}
	}
}elseif($resize || $mode == 'image'){
	$allowedext = $imgext;
}else{
	$allowedext = false;
}

$clean_names = true;
$uploads_path = clean_join_path(dirname(__FILE__).'/files');

/* PROCESS FILES */
$errors = '';
$uploaded = array();
if(isset($params['uploadsubmit'])){
	foreach($_FILES as $fieldname=>$file){
		if(isset($file['name']) && $file['name'] != ""){
			$extension = strtolower(substr(strrchr($file['name'], "."),1));
			if( !$allowedext || in_array($extension, $allowedext) ){
				$filename = $file['name'];
				if($clean_names)	$filename = clean_file_name($filename);
				$startdir = (isset($params['startdir'])?rtrim($params['startdir'],'/').'/':'');
				$filepath = clean_join_path($uploads_path.'/'.$startdir.$filename);
				$filepath = iterate_to_unique($filepath);
				if(move_uploaded_file($file["tmp_name"], $filepath)){
					chmod($filepath, 0666);
					if($resize)	plResize($filepath, $filepath, $resize[0], $resize[1], true, $crop);
					array_push($uploaded, clean_join_url($startdir.$filename));
				}else{
					$errors .= "<li>".$file['name'].': Cout not upload file.'."</li>";
				}
			}else{
				$errors = '<li>'.$file['name'].': Wrong file type.</li>';
			}
		}
	}
}

if($errors != ''){
	$message = '<ul>'.$errors.'</ul>';
}elseif(count($uploaded)>0){
	$message = 'Upload completed!';
}

if(count($uploaded) == 0){

	/* DISPLAY FORM */

	echo createPopupHeader('Upload a new file');	
	echo '
<div id="uploadform">
<p>Choisissez le fichier &agrave; uploader:</p>
<form action="bg_upload.php" method="POST" enctype="multipart/form-data">
	<p>'.$message.'</p>
	<p><input type="file" name="uploadfile1"/></p>
	<p><input type="submit" name="uploadsubmit" /></p>
';
	foreach($params as $key=>$value)	echo '<input type="hidden" name="'.$key.'" value="'.$value.'"/>';
	echo'
</form></div>
</body>
</html>';

}elseif($errors == ''){
	// all files were uploaded
	
	echo createPopupHeader('Upload a new file');
	echo '
<p>'.$message.'</p>
<script type="text/javascript">
if(parent && parent.plFileHandler){
	parent.plFileHandler.do_return("'.implode(',',$uploaded).'");
}else{
	if(plFileHandler)	plFileHandler.do_return("'.implode(',',$uploaded).'");
}
</script>
</body>
</html>';
	
}
