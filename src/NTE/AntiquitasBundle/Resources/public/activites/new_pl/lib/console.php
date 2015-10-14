<?php

// these functions are for debug purposes

$debug_buffer = array();
function my_debug($string,$scriptname='',$line='',$subclass=false){
	// call this function to write something to the debug console, for example:
	// my_debug("Could not do something...",__FILE__,__LINE__,"red");
	if($scriptname != '')	$scriptname = basename($scriptname);
	global $debug_buffer;
	$debugline = array($string,$scriptname,$line,$subclass);
	$debug_buffer[] = $debugline;
}

function my_displaydebug($print=true,$force=false){
	// displays the debug console
	// should be called at the end of the document
	global $config;
	if($force || $config["debug"]){
		global $debug_buffer;
		$output = '<fieldset id="debuglog"><legend><b>Debug:</b></legend>
';
		foreach($debug_buffer as $oneline){
			if(isset($oneline[3]) && $oneline[3]){
				$output .= '	<a class="debug_'.$oneline[3].'">';
			}else{
				$output .= '	<a>';
			}
			if($oneline[1] != "") $output .= '<span>'.$oneline[1].', line '.$oneline[2].'</span>';
			$output .= $oneline[0].'</a>
';
		}
		
		global $_POST;
		if(count($_POST)>0){
			$output .= '<br/><br/><b>POST:</b><ul>
';
			foreach($_POST as $key=>$value)		$output .= '<li>['.$key.'] => '.$value.'</li>
';
			$output .= '</ul>';
		}
		$output .= '</fieldset>';
		if($print) echo $output;
	}
}
