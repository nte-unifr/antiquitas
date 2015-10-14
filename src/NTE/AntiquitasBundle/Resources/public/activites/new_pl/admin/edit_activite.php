<?php
$adminsection = 'activites';
require "include.php";

if(isset($params["cancel"]))	header('location: index.php');
if(isset($params["cancelsec"]))	unset($params["sec_id"]);
if(isset($params["canceltool"]))	unset($params["outil_id"]);


$item = new activite();

if(isset($params["deleteex"]) && $params["deleteex"] > 0){
	$ex = new exercice();
	$ex->id = $params["deleteex"];
	if($ex->dbdelete())	echo adminMsg('saved');
}
if(isset($params["deletesec"]) && $params["deletesec"] > 0){
	$sec = new section();
	$sec->id = $params["deletesec"];
	if($sec->dbdelete())	echo adminMsg('saved');
}
if(isset($params["delete_outil"]) && $params["delete_outil"] > 0){
	$outil = new outil();
	$outil->id = $params["delete_outil"];
	if($outil->dbdelete())	echo adminMsg('saved');
}

if(isset($params["submitact"])){	
	$item->buildFromRow($params, true);
	if($item->name_fr == ''){
		echo adminError('missingfield');
	}else{
		if($item->save())	echo adminMsg('saved');
	}
}elseif(isset($params['act_id'])){
	$item->load($params['act_id']);
}elseif(isset($params['sec_id'])){
	$sec= new section();
	$sec->load($params['sec_id']);
	if($sec->id){
		$params['act_id'] = $sec->act_id;
		$item->load($params['act_id']);
	}
}

if(isset($params['submitsec']) || isset($params['submitnewsec'])){
	$sec= new section($params);
	if(isset($params['submitsec']))	$sec->id = $params['sec_id'];
	if($sec->name_fr == ''){
		echo adminError('missingfield');
	}else{
		if($sec->save()){
			echo adminMsg('saved');
			if($sec->id && !isset($params['sec_id']))	$params['sec_id'] = $sec->id;
		}
	}
}elseif(isset($params['submittool']) || isset($params['submitnewtool'])){
	$outil = new outil($params);
	if(isset($params['submittool']))	$outil->id = $params['outil_id'];
	if($outil->name_fr == '' || $outil->url_fr == ''){
		echo adminError('missingfield');
	}else{
		if($outil->save()){
			echo adminMsg('saved');
			if(isset($params['outil_id']))	unset($params['outil_id']);
		}
	}
}
if($item->id)	echo '<h3><a href="edit_activite.php?act_id='.$item->id.'">'.$item->getvar('name').'</a></h3>';

$action = 'edit_activite.php';

echo '<form action="'.$action.'" method="POST">
<fieldset class="limit"><legend>'.lang('Activite').'</legend>
<table>
';
echo inputRow(lang('Nom').' (fr)',CreateInputText('name_fr', $item->name_fr));
echo inputRow(lang('Nom').' (de)',CreateInputText('name_de', $item->name_de));
echo inputRow(lang('Category'),CreateInputDropdown('category', get_categories(), array($item->category)));
echo '
</table>
<p><input type="submit" value="'.lang('save').'" name="submitact"/> <input type="submit" name="cancel" value="'.lang('cancel').'"/></p>
</fieldset>
';

if($item->id){
	echo '<input type="hidden" name="act_id" value="'.$item->id.'"/>';
	echo '<input type="hidden" name="id" value="'.$item->id.'"/>';
	echo '</form>
	<form action="'.$action.'" method="POST">';
	echo '<input type="hidden" name="act_id" value="'.$item->id.'"/>';
	
	echo '<fieldset id="outilslist" class="limit"><legend>'.lang('Outils').'</legend>
	<ul>
	';
	$editoutil = isset($params['outil_id'])?$params['outil_id']:false;
	$outils = $item->get_outils();
	foreach($outils as $tool){
		if($editoutil == $tool->id){
			echo '<li><fieldset>
			<input type="hidden" name="outil_id" value="'.$tool->id.'"/><table>';
			echo inputRow(lang('Nom').' (fr)',CreateInputText('name_fr', $tool->name_fr));
			echo inputRow(lang('Nom').' (de)',CreateInputText('name_de', $tool->name_de));
			echo inputRow(lang('URL').' (fr)',CreateInputText('url_fr', $tool->url_fr));
			echo inputRow(lang('URL').' (de)',CreateInputText('url_de', $tool->url_de));			
			echo '</table><br/><input type="submit" name="submittool" value="'.lang('save').'"/> <input type="submit" name="canceltool" value="'.lang('cancel').'"/></fieldset></li>';
		}else{
			echo '<li>&gt; <a href="'.$tool->editLink().'">'.$tool->name_fr.($tool->name_de!=''?' / '.$tool->name_de:'').'</a> '.$tool->deletelink().'</li>';
		}
	}
	echo '
	</ul>
	<p><br/><a class="btnlink" href="reorder.php?what=outils&parent='.$item->id.'">'.getImage('reorder').' '.lang('reorder_outils').'</a></p>';
	if(!$editoutil){
		echo '<br/><fieldset class="hidden"><legend onclick="if(this.parentNode) this.parentNode.className = \'\';">'.getImage('add').' '.lang('newoutil').'</legend><div><table>';
		echo inputRow(lang('Nom').' (fr)',CreateInputText('name_fr'));
		echo inputRow(lang('Nom').' (de)',CreateInputText('name_de'));
		echo inputRow(lang('URL').' (fr)',CreateInputText('url_fr'));
		echo inputRow(lang('URL').' (de)',CreateInputText('url_de'));			
		echo '</table><br/><input type="submit" name="submitnewtool" value="'.lang('save').'"/></div></fieldset>';	
	}
	echo '</fieldset>
	</form>
';
echo '	
	<form action="'.$action.'" method="POST">
	<input type="hidden" name="act_id" value="'.$item->id.'"/>
	<fieldset id="sectionlist"><legend>'.lang('Sections').'</legend>
	<ul>
	';
	$editsec = isset($params['sec_id'])?$params['sec_id']:false;
	$sections = $item->get_sections();
	foreach($sections as $sec){
		if($editsec == $sec->id){
			echo '<li><fieldset>';
			$exercices = $sec->get_exercices();
			echo '<div style="float: right;">';
			echo '<p>'.lang('ex_insection').':</p>';
			echo '<ul>';
			foreach($exercices as $ex)	echo '<li><a href="'.$ex->editLink().'">'.$ex->name_fr.($ex->name_de!=''?' / '.$ex->name_de:'').'</a> '.$ex->deletelink($item->id).'</li>';
			echo '</ul>';
			echo '<p><a class="btnlink" href="edit_exercice.php?act_id='.$item->id.'&sec_id='.$sec->id.'">'.getImage('add').' '.lang('newexercice').'</a><br/>';
			echo '<a class="btnlink" href="reorder.php?what=exercices&parent='.$sec->id.'">'.getImage('reorder').' '.lang('reorder_exercices').'</a></p>';
			echo '</div>';
			echo '<input type="hidden" name="sec_id" value="'.$sec->id.'"/><table>';
			echo inputRow(lang('Nom').' (fr)',CreateInputText('name_fr', $sec->name_fr));
			echo inputRow(lang('Nom').' (de)',CreateInputText('name_de', $sec->name_de));
			echo '</table><br/><input type="submit" name="submitsec" value="'.lang('save').'"/> <input type="submit" name="cancelsec" value="'.lang('cancel').'"/></fieldset></li>';
		}else{
			echo '<li>&gt; <a href="'.$sec->editLink().'">'.$sec->name_fr.($sec->name_de!=''?' / '.$sec->name_de:'').'</a> '.$sec->deletelink().'</li>';
		}
	}
	echo '
	</ul>
	<p><br/><a class="btnlink" href="reorder.php?what=sections&parent='.$item->id.'">'.getImage('reorder').' '.lang('reorder_sections').'</a></p>';
	if(!isset($params['sec_id'])){
		echo '<br/><fieldset class="hidden"><legend onclick="if(this.parentNode) this.parentNode.className = \'\';">'.getImage('add').' '.lang('newsection').'</legend><div><table>';
		echo inputRow(lang('Nom').' (fr)',CreateInputText('name_fr'));
		echo inputRow(lang('Nom').' (de)',CreateInputText('name_de'));
		echo '</table><br/><input type="submit" name="submitnewsec" value="'.lang('save').'"/></div></fieldset>';	
	}
echo '</fieldset>
';
	
}

echo '</form>';

require "footer.php";
