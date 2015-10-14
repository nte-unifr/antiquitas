<?php

function get_neworder($tablename, $where=false){
	// retrieves a item_order value for a newly created item
	$query = "SELECT MAX(item_order) maxorder FROM ".$tablename;
	if($where)	$query .= " WHERE ".$where;
	$result = mysql_query($query);
	if($result && $row = mysql_fetch_assoc($result))	return $row['maxorder'] + 1;
	return 1;
}

function inputRow($text, $input){
	// just a shortcut
	return '<tr><td>'.lang($text).'</td><td>'.$input.'</td></tr>
	';
}

function adminError($entry, $addtext=''){
	// displays an error in the admin
	return '<div class="adminerror">'.lang('error_'.$entry).$addtext.'</div>';
}
function adminMsg($entry){
	// displays a notification in the admin
	return '<div class="adminmsg">'.lang($entry).'</div>';
}

function user_exists($userid){
	// checks if a session id exists
	$userid = str_replace("'","",$userid);
	$query = "SELECT COUNT(*) thecount FROM ".DBPREFIX."results WHERE user_id='".$userid."'";
	my_debug("Attempting query: ".$query,__FILE__,__LINE__,"green");
	$dbresult = mysql_query($query);
	if($dbresult && $row = mysql_fetch_assoc($dbresult))	return $row['thecount'];
	return false;
}

function get_categories(){
	// get the list of categories of activities
	$dbresult = mysql_query("SELECT * FROM ".DBPREFIX."categories ORDER BY item_order ASC");
	$cats = array();
	while($dbresult && $row = mysql_fetch_assoc($dbresult)){
		$cat_name = $row['name_'.CURLANG] == ''?$row['name_'.(CURLANG=='fr'?'de':'fr')]:$row['name_'.CURLANG];
		$cats[$row['id']] = $cat_name;
	}
	return $cats;
}

function display_hidden_inputs($values){
	// displays hidden inputs of $values = array("name"=>"value")
	foreach($values as $name=>$value)	echo '<input type="hidden" name="'.$name.'" value="'.$value.'"/>';
}
