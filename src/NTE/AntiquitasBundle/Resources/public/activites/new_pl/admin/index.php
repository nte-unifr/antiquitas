<?php
$adminsection = 'activites';
require "include.php";

if(isset($params['deleteact']) && $params['deleteact'] > 0){
	$act = new activite();
	$act->id = $params['deleteact'];
	if($act->dbdelete())	echo adminMsg('saved');
}

echo '<h2>'.lang('activites').'</h2><br/>';

echo '<p><b><a class="btnlink" href="edit_category.php">'.getImage('add').' '.lang('newcategory').'</a></b></p>';
echo '<p><b>&nbsp;&nbsp; <a class="btnlink" href="edit_activite.php">'.getImage('add').' '.lang('newactivite').'</a></b></p>';

echo '<br/><br/><ul id="actlist">';
$curcat = false;
$result = mysql_query("SELECT acts.category cat_id, cats.id cat_id_check, cats.name_fr cat_name_fr, cats.name_de cat_name_de, acts.id act_id, acts.name_fr, acts.name_de FROM ".DBPREFIX."activites acts LEFT JOIN ".DBPREFIX."categories cats ON acts.category = cats.id ORDER BY cats.item_order, acts.item_order");
while($result && $row = mysql_fetch_assoc($result)){
	if($row['cat_id'] != $row['cat_id_check'])	$row['cat_id'] = '*';
	if(!$curcat || $row['cat_id'] != $curcat){
		if($curcat)	echo '</ul></li>';
		$curcat = $row['cat_id'];
		if($row['cat_id'] != '*'){
			$cat_name = $row['cat_name_'.CURLANG] == ''?$row['cat_name_'.(CURLANG=='fr'?'de':'fr')]:$row['cat_name_'.CURLANG];
			echo '<li class="category"><a href="edit_category.php?cat_id='.$row['cat_id'].'">'.$cat_name.'</a><ul>';
		}else{
			echo '<li class="category">*<ul>';
		}
	}
	$act_name = $row['name_'.CURLANG] == ''?$row['name_'.(CURLANG=='fr'?'de':'fr')]:$row['name_'.CURLANG];
	echo '<li><a href="edit_activite.php?act_id='.$row['act_id'].'">'.$act_name.'</a> <a href="index.php?deleteact='.$row['act_id'].'" onclick="return confirm(\''.lang('supp_activite').'\');">'.getImage('delete').'</a></li>';	
}
echo '</ul></li></ul><br/>';

echo '<p><b><a class="btnlink" href="reorder.php?what=categories">'.getImage('reorder').' '.lang('reorder_categories').'</a></b></p>';
echo '<p><b>&nbsp;&nbsp; <a class="btnlink" href="reorder.php?what=activites">'.getImage('reorder').' '.lang('reorder_activites').'</a></b></p>';

require "footer.php";
