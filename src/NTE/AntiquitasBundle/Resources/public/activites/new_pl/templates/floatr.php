<?php

if(!isset($questions))	exit;

if($pretext && trim($pretext) != '')	echo '<div class="tpl_float_pretext tpl_pretext">'.$pretext.'</div>';

echo '<table class="tpl_float_table">';

echo '<tr>';

if($this->dobject && trim($this->dobject) != ''){
	echo '<td class="tpl_float_objtd tpl_object">';
	echo $this->display_object();
	echo '</td>';
}

echo '<td>';
foreach($questions as $q){
	echo '<div class="tpl_question">';
	$question = $q->getvar('question');
	if($question != '')	echo '<p class="oneprompt">'.$question.'</p>';
	echo $q->display($over, $showanswers);
	if(ISADMIN)	echo $q->display_adminbuttons();
	echo '</div>';	
}
echo '</td></tr>';
echo '</table>';

