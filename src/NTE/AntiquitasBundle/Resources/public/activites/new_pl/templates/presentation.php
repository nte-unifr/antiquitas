<?php

if(!isset($questions))	exit;

if($this->dobject && trim($this->dobject) != ''){
	echo '<div class="tpl_presentation_obj tpl_object">';
	echo $this->display_object();
	echo '</div>';
}

if($pretext && trim($pretext) != '')	echo '<div class="tpl_presentation_pretext tpl_pretext" style="height: 1%;">'.$pretext.'</div>';

echo '<div style="clear: both;"></div>';
