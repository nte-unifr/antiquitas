<?php
if(!isset($activite))	exit;	// if we are here, it's because we're in an activity

/*
 * PART I : We figure out where we are and what we're doing
 */

// retrieve the current section
$sections = $activite->get_sections();
if(count($sections) == 0)	die('Activite vide');

$current_section_id = (int) (isset($params['sec'])?$params['sec']:0);
$section = false;
$i = 0;
$sec_index = 0;
if($current_section_id){
	// a section was provided through the params, so we iterate through sections until we find it
	foreach($sections as $onesec){
		if($onesec->id == $current_section_id)	$sec_index = $i;
		$i++;
	}
}
$section = $sections[$sec_index];
$current_section_id = $section->id;


// retrieve the current exercice
$exercices = $section->get_exercices();
if(count($exercices) == 0)	die('Section vide');

$current_exercice_id = (int) (isset($params['ex'])?$params['ex']:0);
$exercice = false;
$i = 0;
$index = 0;	
if($current_exercice_id){
	foreach($exercices as $oneex){
		if($oneex->id == $current_exercice_id){
			$index = $i;
		}
		$i++;
	}
}
$exercice = $exercices[$index];
$current_exercice_id = $exercice->id;


// we prepare eventual link to next exercice
if(isset($exercices[$index+1])){
	$nextex = $exercices[$index+1];
	$next = array('act'=>$activite->id, 'sec'=>$current_section_id, 'ex'=>$nextex->id);
}elseif(isset($sections[$sec_index+1])){
	$next = array('act'=>$activite->id, 'sec'=>$sections[$sec_index+1]->id);
}else{
	$next = false;
}

// we save the parameters to the current exercice
$current = array('act'=>$activite->id, 'sec'=>$current_section_id, 'ex'=>$current_exercice_id);





/*
 * PART II : If the form has been submitted, we process the inputs
 */

$tried = false;
$done = (count($exercice->get_questions()) == 0)?true:false;		// if the exercice has no question, we consider it done
if(!isset($_SESSION[ESSAISVAR]))	$_SESSION[ESSAISVAR] = array();	// the nb of attempts is saved here
if(!isset($params['reset']) && isset($params['submission_checker'])){
	// the exercice form is submitted
	// add 1 to the number of attempts
	$_SESSION[ESSAISVAR][$exercice->id] = isset($_SESSION[ESSAISVAR][$exercice->id])?$_SESSION[ESSAISVAR][$exercice->id]+1:1;
	
	$tried = true;
	
	// check whether the whole exercice has been answered
	$completed = $exercice->retrieve_inputs($params);
	
	// check whether all answers were correct
	$passed = $completed?$exercice->validate():false;
	
	if($completed)	$user->save_user_result($activite->id, $exercice->id, $passed);	// save exercice success/failure
	
	// save user answers
	$exercice->save_stats($user?$user->userid:false);
	
	if($passed || $exercice->nbessais <= $_SESSION[ESSAISVAR][$exercice->id])	$done = true;
	
}else{
	$_SESSION[ESSAISVAR][$exercice->id] = 0;	// we either reset or come from somewhere else
	if(!isset($params['reset'])){
		// we retrieve the answers the user had previously given
		$query = "SELECT * FROM ".DBPREFIX."qstats WHERE ex_id=".$exercice->id." AND user_id='".$user->userid."'";
		my_debug("Attempting query: ".$query,__FILE__,__LINE__,"green");
		$dbresult = mysql_query($query);
		$answers = array();
		while($dbresult && $row = mysql_fetch_assoc($dbresult))	$answers['question_'.$row['q_id']] = unserialize($row['answer']);
		$tried = (count($answers)>0);
		$completed = $exercice->retrieve_inputs($answers);
		$done = $exercice->validate();
	}
}



/*
 * PART III : We display the form
 */

// call the activity header
require 'activite_header.php';

echo '<form action="index.php" method="POST">';
echo '<input type="hidden" name="submission_checker" value="1"/>';

$exercice->display_questions($done, $tried);

display_hidden_inputs($current);

if($tried)	echo '<span class="btn" style="float: left;"><input type="submit" class="submitbtn bluebtn" name="reset" value="'.lang('reset').'"/></span>';

if(!$done && count($exercice->questions) > 0){
	if($exercice->nbessais>0)	echo (isset($_SESSION[ESSAISVAR][$exercice->id])?$_SESSION[ESSAISVAR][$exercice->id]:0).'/'.$exercice->nbessais.' &nbsp;';
	echo '<span class="btn"><input type="submit" class="submitbtn bluebtn" name="validate" value="'.lang('Valider').'"/></span> ';
}elseif(!$next && !$done){
	echo '<br/>';
}
echo '</form>';

if($next && $done){
	// display the "Next" link
	echo '<form action="index.php" method="POST">';
	echo '<span class="btn"><input type="submit" class="submitbtn bluebtn" name="next" value="'.lang('Next').'"/></span>';
	display_hidden_inputs($next);
	echo '</form>';
}

echo '
</div></div>';
