<?php
$adminsection = 'activites';
require "include.php";

if(!isset($params['sec_id'])){
	header('location: index.php');
}

if(isset($params["deleteq"]) && $params["deleteq"] > 0){
	$q = new question();
	$q->id = $params["deleteq"];
	if($q->dbdelete())	echo adminMsg('saved');
}

$section = new section();
$section->load($params['sec_id']);
if(!$section->id)	header('location: index.php');

if(isset($params['cancel']))	header('location: edit_activite.php?act_id='.$section->act_id.'&sec_id='.$section->id);

$activite = new activite();
$activite->load($section->act_id);

echo '<h3><a href="'.$section->editLink().'">'.$activite->getvar('name').' &nbsp;&gt;&gt;&nbsp; '.$section->getvar('name').'</a></h3>';

$item = new exercice();

if(isset($params["submitex"]) || isset($params["save"])){
	if(isset($params['nbessais'])){
		$params['nbessais'] = (int) $params['nbessais'];
		if($params['nbessais'] < 1)	$params['nbessais'] = 1;
	}
	$item->buildFromRow($params, true);
	if(isset($params['ex_id'])) $item->id = $params['ex_id'];
	if($item->name_fr == ''){
		echo adminError('missingfield');
	}else{
		if($item->save()){
			echo adminMsg('saved');
			if(isset($params["save"]))	header('location: edit_activite.php?act_id='.$section->act_id.'&sec_id='.$section->id);
		}
	}
}elseif(isset($params['ex_id'])){
	$item->load($params['ex_id']);
}

echo '
<script type="text/javascript">
plFileHandler.init(500,400);
</script>
<form action="edit_exercice.php" method="POST">
<fieldset class="limit"><legend>'.lang('info_exercice').'</legend>
<table>
';
echo inputRow(lang('Nom').' (fr)',CreateInputText('name_fr', $item->name_fr));
echo inputRow(lang('Nom').' (de)',CreateInputText('name_de', $item->name_de));
echo inputRow(lang('pretext').' (fr)',CreateTextarea('pretext_fr', $item->pretext_fr));
echo inputRow(lang('pretext').' (de)',CreateTextarea('pretext_de', $item->pretext_de));
echo inputRow(lang('posttext').' (fr)',CreateTextarea('posttext_fr', $item->posttext_fr));
echo inputRow(lang('posttext').' (de)',CreateTextarea('posttext_de', $item->posttext_de));
echo inputRow(lang('nbessais'),CreateInputText('nbessais', $item->nbessais));
echo inputRow(lang('Object'),CreateInputText('dobject', $item->dobject, ' id="ex_dobject_input"').' <a style="cursor: pointer;" onclick="plFileHandler.load(\'../bg_select.php?mode=image\', \'ex_dobject_input\');">'.lang('select').'</a> <a style="cursor: pointer;" onclick="plFileHandler.load(\'../bg_upload.php\', \'ex_dobject_input\');">'.lang('upload').'</a>');
echo inputRow(lang('Template'),CreateInputText('template', $item->template, ' id="ex_template_input"').' <a style="cursor: pointer;" onclick="plFileHandler.load(\'../bg_tplselect.php\', \'ex_template_input\');">'.lang('select').'</a>');
echo '
</table>
';
if($item->id)	echo '<input type="hidden" name="ex_id" value="'.$item->id.'"/>
';
echo '<input type="hidden" name="sec_id" value="'.$section->id.'"/>
<p><input type="submit" value="'.lang('save').'" name="submitex"/> <input type="submit" name="save" value="'.lang('savereturn').'"/> <input type="submit" name="cancel" value="'.lang('cancel').'"/></p>
';
if(!$item->id)	echo '<p><i>('.lang('help_exsave').')</i></p>';
echo '
</fieldset>
</form>
';

if($item->id){

	echo '<br/><fieldset id="preview"><legend>'.lang('Preview').'</legend>
	';
	$item->display_questions();
	echo '<p><br/><a class="btnlink" href="reorder.php?what=questions&parent='.$item->id.'&sec_id='.$item->sec_id.'">'.getImage('reorder').' '.lang('reorder_questions').'</a></p>';	
	echo '</fieldset>
';

	
	echo '<p><a class="btnlink" href="edit_question.php?sec_id='.$section->id.'&ex_id='.$item->id.'">'.getImage('add').' '.lang('newquestion').'</a></p>';

	
}


require "footer.php";
