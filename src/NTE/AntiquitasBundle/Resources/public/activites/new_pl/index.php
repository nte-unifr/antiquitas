<?php

require 'header.php';

if(isset($params['restoresession']) && user_exists($params['restoresession'])){
	$_SESSION[USERVAR] = $params['restoresession'];
}

if( isset($_SESSION[USERVAR]) || isset($params['newsession']) || isset($params['act']) ){
	// we either restore a session or create a new one
	
	$session_form = (!isset($_SESSION[USERVAR]) && !isset($params['newsession']));
	
	// upon creation, the feuser will restore a session if it's in the session variables or create a new one
	$user = new feuser();

	if(isset($params['act'])){
		// we load the activity and display it - mostly everything will be done in activite.php
		$act_id = (int) $params['act'];
		$activite = new activite();
		$activite->load($act_id);
		if($activite->id)	require 'activite.php';
	}else{
		// we display the activity menu
		if($config['theme_stylesheet'] == 'old.css'){
			echo '<div id="acthead"><div id="acthead_left"></div><div id="acthead_middle" class="rightborder"><h2>'.lang('activites').'</h2></div></div>';
			echo '<div id="actbody"><div class="exercice_outer">';
			echo '<div class="exercice_inner">';	
		}else{
			echo '<h2>Antiquitas<sup>2</sup></h2>';
			echo '<div id="actbody"><div class="exercice_outer">';
			echo '<div class="exercice_inner">';
			echo '<h3>'.lang('activites').':</h3>';
		}
		$user->activities_menu();
		echo '<br/></div><br/></div></div>';
	}

	if($user->userid){
		// we show the user session id and possibility to restore another session
		echo '<div id="below">';
		echo '<p id="useridp">'.lang('yourid').': <span>'.$user->userid.'</span></p>';
		echo '<form action="index.php'.(isset($params['act'])?'?act='.$params['act']:'').'" method="POST">';
		echo '<fieldset id="session_form"'.($session_form?'':' class="hiddenFieldset"').'><legend onclick="if(this.parentNode) this.parentNode.className = (this.parentNode.className==\'hiddenFieldset\'?\'\':\'hiddenFieldset\');">'.getImage('session').' '.lang('restoresession').'</legend>';
		echo '<div><p>'.lang('prompt_session2').'</p>';
		echo '<p><input name="restoresession" type="text" value="student"/></p>';
		echo '<p><input name="submitsession" type="submit" /></p><br/></div>';		
		echo '</fieldset></form></div>';		
	}

}else{

	// we show the New session / Restore session menu

	if($config['theme_stylesheet'] == 'old.css'){
		echo '<div id="acthead"><div id="acthead_left"></div><div id="acthead_middle" class="rightborder"><h2>Antiquitas<sup>2</sup></h2></div></div>';
		echo '<div id="actbody"><div class="exercice_outer">';
		echo '<div class="exercice_inner">';	
	}else{
		echo '<h2>Antiquitas<sup>2</sup></h2>';
		echo '<div id="actbody"><div class="exercice_outer">';
		echo '<div class="exercice_inner">';
	}
	
	echo '<table id="welcometable"><tr><td><p><a href="index.php?newsession=1">'.lang('newsession').'</a></p></td>';
	
	
	echo '<td><a onclick="document.getElementById(\'restoresession_form\').style.display = \'block\';">'.lang('restoresession').'</a>';
	echo '<form id="restoresession_form"'.(isset($params['restoresession'])?'':' style="display: none;"').' action="index.php" method="POST">';
	if(isset($params['restoresession']))	echo '<p>'.lang('unknownsession').'</p>';
	echo '<p>'.lang('prompt_session').'</p>';
	echo '<p><input name="restoresession" type="text" value="student"/></p>';
	echo '<p><input name="submitsession" type="submit" /></p>';
	if(isset($params['act']))	echo '<input type="hidden" name="act" value="'.$params['act'].'"/>';
	echo '</form></td></tr></table>';
	
	echo '<br/></div><br/></div></div>';	
	
}


require "footer.php";
