<?php
$adminsection = 'activites';
$scriptaculous = true;
require "include.php";

function do_redirect($field, $params){
	if(!isset($params["parent"])){
		header('location: index.php');
	}elseif($params["what"] == 'questions'){
		$header = 'location: edit_exercice.php?ex_id='.$params["parent"];
		if(isset($params["sec_id"]))	$header .= '&sec_id='.$params['sec_id'];
		header($header);
	}elseif($params["what"] == 'options'){
		header('location: edit_question.php?q_id='.$params["parent"]);
	}elseif($field){
		header('location: edit_activite.php?'.$field.'='.$params["parent"]);
	}
}

if(!isset($params["what"]) || !in_array($params["what"], array("categories","activites","outils","sections","exercices","questions","options"))){
	header('location: index.php');
}
switch($params["what"]){
	case 'sections': $field='act_id'; break;
	case 'outils': $field='act_id'; break;
	case 'exercices': $field='sec_id'; break;
	case 'questions': $field='ex_id'; break;
	case 'options': $field='q_id'; break;
	default: $field = false; break;
}

if($field && !isset($params["parent"]))	header('location: index.php');

if(isset($params["cancel"]))	do_redirect($field, $params);
if(isset($params["submitreorder"])){
	$neworder = isset($params["neworder"])?explode(',',$params["neworder"]):array();
	if(count($neworder) > 0){
		$counter = 0;
		foreach($neworder as $oneid){
			$oneid = (int) $oneid;
			$counter++;
			$query = "UPDATE ".DBPREFIX.$params["what"]." SET item_order='".$counter."' WHERE id='".$oneid."' LIMIT 1";
			mysql_query($query);
			echo mysql_error();
		}
	}
	do_redirect($field, $params);
}

$query = "SELECT * FROM ".DBPREFIX.$params["what"];
if($field && isset($params["parent"])){
	$val = (int) $params["parent"];
	$query .= " WHERE $field='".$val."'";
}
$query .= " ORDER BY item_order ASC";

$res = mysql_query($query);
if(!$res)	header('location: index.php');

echo '<form action="reorder.php" method="POST"  onsubmit="return submit_reorder();">';
echo '<p>'.lang('help_reorder').'</p>';
echo '<ul id="tosort">';
while($res && $row = mysql_fetch_assoc($res)){
	if(isset($row['name_fr'])){
		$label = $row['name_fr'].($row['name_de']!=''?' / '.$row['name_de']:'');
	}elseif(isset($row['question_fr']) && trim($row['question_fr']) != ''){
		$label = $row['question_fr'];
	}elseif(isset($row['question_de']) && trim($row['question_de']) != ''){
		$label = $row['question_de'];
	}elseif(isset($row['item_order'])){
		$label = 'item '.$row['item_order'];
	}else{
		$label = false;
	}
	if($label)	echo '<li id="item'.$row['id'].'">'.$label.'</li>';
}
echo '</ul>';
echo '<p><input type="submit" name="submitreorder" value="'.lang('save').'"/> <input type="submit" name="cancel" value="'.lang('cancel').'"/></p>
<input type="hidden" name="what" value="'.$params["what"].'"/>
<input type="hidden" id="neworder" name="neworder" value=""/>
';
if(isset($params['sec_id']))	echo '<input type="hidden" name="sec_id" value="'.$params["sec_id"].'"/>';
if($field && isset($params["parent"]))	echo '<input type="hidden" name="parent" value="'.$params["parent"].'"/>';
echo '
</form>';

echo '
<script type="text/javascript">
	Sortable.create("tosort");
</script>
';

require "footer.php";
