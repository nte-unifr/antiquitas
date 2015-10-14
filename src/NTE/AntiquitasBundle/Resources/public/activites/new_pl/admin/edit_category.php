<?php
$adminsection = 'activites';
require "include.php";

if(isset($params["cancel"]))	header('location: index.php');

$item = new category();

if(isset($params["submitcat"]) || isset($params["save"])){	
	$item->buildFromRow($params, true);
	if(isset($params['cat_id']))	$item->id = $params['cat_id'];
	if($item->name_fr == ''){
		echo adminError('missingfield');
	}else{
		if($item->save()){
			if(isset($params['save']))	header('location: index.php');
			echo adminMsg('saved');
		}
	}
}elseif(isset($params['cat_id'])){
	$item->load($params['cat_id']);
}

echo '<h3>'.($item->id?$item->getvar('name'):lang('newcategory')).'</h3>';

echo '<br/><form action="edit_category.php" method="POST">
<table>
';
echo inputRow(lang('Nom').' (fr)',CreateInputText('name_fr', $item->name_fr));
echo inputRow(lang('Nom').' (de)',CreateInputText('name_de', $item->name_de));
echo '
</table><br/>
<p><input type="submit" value="'.lang('save').'" name="submitcat"/> <input type="submit" name="save" value="'.lang('savereturn').'"/> <input type="submit" name="cancel" value="'.lang('cancel').'"/></p>
';

if($item->id)	echo '<input type="hidden" name="cat_id" value="'.$item->id.'"/>';

echo '</form>';

require "footer.php";
