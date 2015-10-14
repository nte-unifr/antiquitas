<?php

if(!isset($questions))	exit;

if($pretext && trim($pretext) != '')	echo '<div class="tpl_default_pretext tpl_pretext">'.$pretext.'</div>';

if($this->dobject && trim($this->dobject) != ''){
	echo '<div class="tpl_object">'.$this->display_object().'</div>';
}

foreach($questions as $q){
	echo '<div class="tpl_default_question tpl_question">';
	$question = $q->getvar('question');
	echo '<p><span class="oneprompt">'.$question.'</span><br/>'.$q->display($over, $showanswers).'</p>';
	if(ISADMIN)	echo $q->display_adminbuttons();
	echo '</div>';	
}

