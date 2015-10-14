<?php

function getCoinManip($args){
	// this finds out which images are available for the CoinManipulator and returns the appropriate js
	// eventually, another script should create the images (by rotating the original) when they don't exists...
	global $config;
	$tpath = $config['rootpath'].DIRECTORY_SEPARATOR.'files'.DIRECTORY_SEPARATOR.'generated'.DIRECTORY_SEPARATOR;
	
	$args = explode(',',$args);
	$img1 = $args[0];
	$img2 = $args[1];
	$img1_parts = explode('.',trim($args[0],"'"));
	$img2_parts = explode('.',trim($args[1],"'"));
	
	$small = '';
	
	$tmp_parts = $img1_parts;
	$tmp_parts[count($tmp_parts)-2] = $img1_parts[count($img1_parts)-2].'_90';
	if(file_exists($tpath.implode('.',$tmp_parts)))	$img1 .= ",'generated/".implode('.',$tmp_parts)."'";
	
	$tmp_parts[count($tmp_parts)-2] = $img1_parts[count($img1_parts)-2].'_180';
	if(file_exists($tpath.implode('.',$tmp_parts)))	$img1 .= ",'generated/".implode('.',$tmp_parts)."'";
	
	$tmp_parts[count($tmp_parts)-2] = $img1_parts[count($img1_parts)-2].'_270';
	if(file_exists($tpath.implode('.',$tmp_parts)))	$img1 .= ",'generated/".implode('.',$tmp_parts)."'";	
	
	$tmp_parts = explode('/',trim($args[0],"'"));
	$tmp_parts[count($tmp_parts)-1] = 'thumb_'.$tmp_parts[count($tmp_parts)-1];
	if(file_exists($config['rootpath'].DIRECTORY_SEPARATOR.'files'.DIRECTORY_SEPARATOR.implode('/',$tmp_parts)))	$small = "'".implode('/',$tmp_parts)."'";		
	
	$tmp_parts = $img2_parts;
	$tmp_parts[count($tmp_parts)-2] = $img2_parts[count($img2_parts)-2].'_90';
	if(file_exists($tpath.implode('.',$tmp_parts)))	$img2 .= ",'generated/".implode('.',$tmp_parts)."'";
	
	$tmp_parts[count($tmp_parts)-2] = $img2_parts[count($img2_parts)-2].'_180';
	if(file_exists($tpath.implode('.',$tmp_parts)))	$img2 .= ",'generated/".implode('.',$tmp_parts)."'";
	
	$tmp_parts[count($tmp_parts)-2] = $img2_parts[count($img2_parts)-2].'_270';
	if(file_exists($tpath.implode('.',$tmp_parts)))	$img2 .= ",'generated/".implode('.',$tmp_parts)."'";	

	if($small != ''){
		$tmp_parts = explode('/',trim($args[1],"'"));
		$tmp_parts[count($tmp_parts)-1] = 'thumb_'.$tmp_parts[count($tmp_parts)-1];
		if(file_exists($config['rootpath'].DIRECTORY_SEPARATOR.'files'.DIRECTORY_SEPARATOR.implode('/',$tmp_parts)))	$small .= ",'".implode('/',$tmp_parts)."'";			
	}

	return '<div id="coinManip_div"><div id="coinManip_spacer"></div></div>
	<script type="text/javascript">
		var img1 = new Array('.$img1.');
		var img2 = new Array('.$img2.');
		coinManip.init("coinManip_div",img1,img2,'.(isset($args[2])?$args[2]:'0').($small==''?'':','.$small).');
	</script>';
	
}
