<?php
$adminsection = 'activites';
require "include.php";

if(!isset($params['ex_id']) && !isset($params['q_id'])){
	header('location: index.php');
}elseif(isset($params["cancel"])){
	header('location: edit_exercice.php?ex_id='.$params['ex_id'].'&sec_id='.$params['sec_id']);
}

$item = new question();

if(isset($params["deleteopt"]) && $params["deleteopt"] > 0){
	$option = new option();
	$option->id = $params["deleteopt"];
	if($option->dbdelete())	echo adminMsg('saved');
}

if(isset($params["submitq"]) || isset($params["save"])){
	$hasanswer = isset($params["type"]) && ($params["type"] == 'textbox' || $params["type"] == 'textarea');
	$_SESSION['admin_lastqtype'] = $params['type'];
	$item->buildFromRow($params, true);
	if(isset($params['q_id'])) $item->id = $params['q_id'];
	if($item->save(!$hasanswer)){
		echo adminMsg('saved');
		if(isset($params["save"]))	header('location: edit_exercice.php?ex_id='.$params['ex_id'].'&sec_id='.$params['sec_id']);
	}
}elseif(isset($params['q_id'])){
	$item->load($params['q_id']);
}elseif(isset($params['opt_id'])){
	$option = new option();
	$option->load($params['opt_id']);
	if($option->id){
		$params['q_id'] = $option->q_id;
		$item->load($params['q_id']);
	}else{
		header('location: index.php');
	}
}elseif(isset($params['ex_id'])){
	$item->ex_id = $params['ex_id'];
}else{
	header('location: index.php');
}

$exercice = new exercice();
$exercice->load($item->ex_id);

echo '<h3><a href="'.$exercice->editLink().'">'.$exercice->getvar('name').'</a></h3>';

if(isset($params['submitanswer']) && isset($params['givenanswer'])){
	$item->answer = $params['givenanswer'];
	if($item->save())	echo adminMsg('saved');
}

if(isset($params['submitopt']) || isset($params['submitnewopt'])){
	$option = new option($params);
	if(isset($params['submitopt'])) $option->id = $params['opt_id'];
	if($option->name_fr == ''){
		echo adminError('missingfield');
	}else{
		if($option->save())	echo adminMsg('saved');
	}	
}

echo '<form id="form_edit_question" action="edit_question.php" method="POST">
<fieldset class="limit"><legend>'.lang('Question').'</legend>
<table>
';
echo inputRow(lang('Question').' (fr)',CreateInputText('question_fr', $item->question_fr));
echo inputRow(lang('Question').' (de)',CreateInputText('question_de', $item->question_de));
$deftype = isset($_SESSION['admin_lastqtype'])?$_SESSION['admin_lastqtype']:'textbox';
echo inputRow(lang('Type'),CreateInputDropdown('type', getTypes(), $item->id?array($item->type):array($deftype), false, '').'<a href="help.php?what=inputs" target="_blank">'.getImage('help').'</a>');
if($item->type == 'textbox' || (!$item->id && $deftype == 'textbox')){
	echo inputRow(lang('Reponse'),CreateInputText('answer', $item->get_answer()));
	echo '<tr><td colspan="2">'.lang('help_multiplevalues').'</td></tr>';
}elseif($item->type == 'textarea' || (!$item->id && $deftype == 'textarea')){
	echo inputRow(lang('Reponse'),CreateTextarea('answer', $item->get_answer()));
}
echo '
</table>';

// feedback
echo '<fieldset class="hidden"><legend onclick="if(this.parentNode) this.parentNode.className = \'\';">'.lang('feedback').'</legend><div><table>';
echo inputRow(lang('positif').' (fr)',CreateInputText('feedback_positif_fr', $item->feedback_positif_fr));
echo inputRow(lang('positif').' (de)',CreateInputText('feedback_positif_de', $item->feedback_positif_de));
echo inputRow(lang('negatif').' (fr)',CreateInputText('feedback_negatif_fr', $item->feedback_negatif_fr));
echo inputRow(lang('negatif').' (de)',CreateInputText('feedback_negatif_de', $item->feedback_negatif_de));			
echo '</table></fieldset><br/>';	

echo '
<p><input type="submit" name="submitq" value="'.lang('save').'"/> <input type="submit" name="save" value="'.lang('savereturn').'"/> <input type="submit" name="cancel" value="'.lang('cancel').'"/></p>
';
if($item->id)	echo '<input type="hidden" name="q_id" value="'.$item->id.'"/>
';
echo '<input type="hidden" name="ex_id" value="'.$item->ex_id.'"/>
<input type="hidden" name="sec_id" value="'.$exercice->sec_id.'"/>
</fieldset>
</form>
';

if(!$item->id || $item->type == 'textbox' || $item->type == 'textarea'){
	require "footer.php";
	exit;
}


// only when there are options
		
echo '
<form action="edit_question.php" method="POST">
<br/><fieldset class="limit"><legend>'.lang('prompt_options').'</legend>
<input type="hidden" name="q_id" value="'.$item->id.'"/>
<input type="hidden" name="ex_id" value="'.$exercice->id.'"/>
<input type="hidden" name="sec_id" value="'.$exercice->sec_id.'"/>
<ul>
';
$options = $item->get_options(true);
$editoption = isset($params['opt_id'])?$params['opt_id']:false;

$answer = $item->get_answer();

if(!is_array($answer))	$answer = array($item->answer);

if($options){
	foreach($options as $opt){
		if($editoption == $opt->id){
			echo '<li><fieldset>
			<input type="hidden" name="opt_id" value="'.$opt->id.'"/><table>';
			echo inputRow(lang('Nom').' (fr)',CreateInputText('name_fr', $opt->name_fr));
			echo inputRow(lang('Nom').' (de)',CreateInputText('name_de', $opt->name_de));
			echo '</table><br/><input type="submit" name="submitopt"/></fieldset></li>';
		}else{
			echo '<li><a href="'.$opt->editLink($exercice->id, $exercice->sec_id).'">'.$opt->name_fr.($opt->name_de!=''?' / '.$opt->name_de:'').'</a> '.(in_array($opt->id, $answer)?'':$opt->deletelink($exercice->id, $exercice->sec_id)).'</li>';
		}
	}
}
echo '
</ul><br/>
';
if(!$editoption){
	echo '<fieldset><legend>'.getImage('add').' '.lang('newoption').'</legend><table>';
	echo inputRow(lang('Nom').' (fr)',CreateInputText('name_fr'));
	echo inputRow(lang('Nom').' (de)',CreateInputText('name_de'));
	echo '</table><br/><input type="submit" name="submitnewopt"/></fieldset>';	
}
echo '<p><a href="reorder.php?what=options&parent='.$item->id.'">'.getImage('reorder').' '.lang('reorder_options').'</a></p>';
echo '</fieldset>
';

if(count($options) > 0){
	echo '<fieldset class="limit"><legend>'.lang('prompt_reponse').'</legend>';
	echo $item->get_input('givenanswer', true);
	echo '<p><input type="submit" name="submitanswer"/></p>';
	echo '</fieldset>';
}
echo '</form>';

require "footer.php";
