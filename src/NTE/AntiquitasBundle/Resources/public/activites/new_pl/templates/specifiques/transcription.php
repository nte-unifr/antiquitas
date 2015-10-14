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

if(ISADMIN){
	echo '<td><br/>';
	foreach($questions as $q){
		echo '<div class="tpl_question" style="vertical-align: middle;">';
		echo '<p>'.$q->getvar('question').'<br/>';
		echo $q->display($over, $showanswers).'<br/>';
		echo $q->display_adminbuttons().'</p>';
		echo '</div>';
	}
}else{
	echo '<td style="text-align: center; vertical-align: middle;" class="shortinputs">';
	echo '<p>'.$questions[0]->display($over, $showanswers).'</p>';
	echo '<p>'.$questions[1]->display($over, $showanswers).'</p>';
	echo '<p>'.$questions[2]->display($over, $showanswers).'&nbsp;'.$questions[3]->display($over, $showanswers).'&nbsp;'.$questions[4]->display($over, $showanswers).'</p>';
	echo '<p>'.$questions[5]->display($over, $showanswers).'</p>';
	echo '<p>'.$questions[6]->display($over, $showanswers).'&nbsp;'.$questions[7]->display($over, $showanswers).'</p>';
}
echo '</td></tr>';
echo '</table>';

