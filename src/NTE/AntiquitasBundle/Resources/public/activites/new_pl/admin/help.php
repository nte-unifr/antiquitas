<?php
$adminsection = 'Help';
require "include.php";

$what = isset($params['what'])?$params['what']:false;

switch($what){
	case "inputs":
		echo '<h2>'.lang('qtypes').'</h2>';
		echo '<table>';
		echo '<tr><td><br/>'.lang('Dropdown').'<br/>'.CreateInputDropdown('test', array(1=>'Option1', 2=>'Option2', 3=>'Option3')).'<br/><br/></td><td><br/>'.lang('help_dropdown').'</td></tr>';
		echo '<tr><td><br/>'.lang('Radio').'<br/>'.CreateInputRadio('test', array(1=>'Option1', 2=>'Option2', 3=>'Option3')).'<br/><br/></td><td><br/>'.lang('help_radio').'</td></tr>';
		echo '<tr><td><br/>'.lang('Checkboxes').'<br/>'.CreateInputCheckboxes('test', array(1=>'Option1', 2=>'Option2', 3=>'Option3')).'<br/><br/></td><td><br/>'.lang('help_checkboxes').'</td></tr>';
		echo '<tr><td><br/>'.lang('Textbox').'<br/>'.CreateInputText('test').'<br/><br/></td><td><br/>'.lang('help_textbox').'</td></tr>';
		echo '<tr><td><br/>'.lang('Textarea').'<br/>'.CreateTextarea('test').'</td><td><br/>'.lang('help_textarea').'</td></tr>';
		echo '</table>';
		break;
	case "structure":
		echo '<h2>'.lang('structure').'</h2><br/>';
		echo lang('help_structure_1');
		echo '<p><img src="../images/help_structure.jpg"/></p>';
		echo lang('help_structure_2');
		break;
	default:
		echo '<h2>'.lang('Help').'</h2>';
		echo '<ul>';
		foreach(array('structure','inputs') as $subject)	echo '<li><a href="help.php?what='.$subject.'">'.lang($subject).'</a></li>';
		echo '</ul>';
}


require "footer.php";
