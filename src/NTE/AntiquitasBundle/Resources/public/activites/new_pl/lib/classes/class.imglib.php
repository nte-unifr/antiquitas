<?php

class imglib {
	public $images = array();
	public $imgpath;
	public $imgurl;
	public $admin = false;
	
	function __construct(){
		global $config;
		$this->imgpath = $config['rootpath'].'/images/';
		$this->imgurl = ($this->admin?'../':'').'images/';
	}
	
	function setAdmin($mode=true){
		// set admin on/off. Basically, this just controls the image url
		$this->admin = $mode;
		$this->imgurl = ($this->admin?'../':'').'images/';
	}
	
	function addImage($key,$path,$alt_fr='',$alt_de=''){
		// add an image to the library (so that we can access it later using getImage
		if(file_exists($this->imgpath.$path)){
			$this->images[$key] = array('path'=>$path, 'alt_de'=>$alt_de, 'alt_fr'=>$alt_fr);
		}else{
			my_debug('Attempt to add image to library failed: cannot find file '.$this->imgpath.$path,__FILE__,__LINE__);
		}
	}
	
	function buildTag($imgarray){
		// builds the image tag
		return '<img src="'.$this->imgurl.$imgarray['path'].'" alt="'.$imgarray['alt_'.CURLANG].'"/>';
	}
	
	function getImage($key){
		// retrieve image tag (if image exists)
		if(isset($this->images[$key])){
			return $this->buildTag($this->images[$key]);
		}else{
			return $key.'- No such image...';
		}
	}
	
}
