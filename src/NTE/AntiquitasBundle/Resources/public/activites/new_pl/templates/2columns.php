<?php

if(!isset($questions))	exit;

if($pretext && trim($pretext) != '')	echo '<div class="tpl_2columns_pretext tpl_pretext">'.$pretext.'</div>';

$counter = 0;
echo '<table class="tpl_2columns_table">';

echo '<tr>';

if($this->dobject && trim($this->dobject) != ''){
	echo '<td class="tpl_2columns_objtd tpl_object">';
	echo $this->display_object();
	echo '</td>';
	$counter++;
}

foreach($questions as $q){
	if($counter == 2){
		$counter = 0;
		echo '</tr><tr>';
	}
	$counter++;
	echo '<td class="tpl_question>';
	$question = $q->getvar('question');
	if($question != '')	echo '<p class="oneprompt">'.$question.'</p>';
	echo $q->display($over, $showanswers);
	if(ISADMIN)	echo $q->display_adminbuttons();
	echo '</td>';	
}

if($counter == 1)	echo '<td></td></tr>';
if($counter == 2)	echo '</tr>';
echo '</table>';

