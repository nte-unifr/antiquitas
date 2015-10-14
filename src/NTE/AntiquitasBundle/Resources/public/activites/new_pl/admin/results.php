<?php
$adminsection = 'resultats';
require "include.php";

if(isset($params['q_id']) && $params['q_id'] != ''){
	
	$question = new question();
	$question->load($params['q_id']);
	if(!$question->id)	header('location: results.php');
	echo '<h4>'.$question->getvar('question').'</h4>';
	echo '<p><a href="results.php?ex_id='.$question->ex_id.'">'.lang('back').'</a></p>';
	echo '<div id="q_answerslist">';
	$dbresult = mysql_query("SELECT answer FROM ".DBPREFIX."qstats WHERE q_id='".$params['q_id']."' LIMIT 500");
	while($dbresult && $row = mysql_fetch_assoc($dbresult)){
		echo '<p>'.unserialize(stripslashes($row['answer'])).'</p>';
	}
	echo '</div>
	<p><a href="results.php?ex_id='.$question->ex_id.'">'.lang('back').'</a></p>';
	
}elseif(isset($params['ex_id']) && $params['ex_id'] != ''){
	
	$exercice = new exercice();
	$exercice->load($params['ex_id']);
	if(!$exercice->id)	header('location: results.php');
	$dbresult = mysql_query('SELECT act_id FROM '.DBPREFIX.'sections WHERE id='.$exercice->sec_id.' LIMIT 1');
	$act_id = ($dbresult && $row = mysql_fetch_assoc($dbresult))?$row['act_id']:false;
	echo '<h4>'.$exercice->getvar('name').'</h4>';
	if($act_id)	echo '<p><a href="results.php?act_id='.$act_id.'">'.lang('back').'</a></p>';
	echo '<p>'.lang('successrate').': '.$exercice->get_success_rate().'%</p>';
	$exercice->display_stats();
	
}elseif(isset($params['act_id'])){

	$activite = new activite();
	$activite->load($params['act_id']);
	if(!$activite->id)	header('location: results.php');
	echo '<h4>'.$activite->getvar('name').'</h4>';
	echo '<p><a href="results.php">'.lang('back').'</a></p><br/>
';

	$query = "SELECT ex_id, COUNT(*) exdone, SUM(wasright) exsuccess FROM ".DBPREFIX."results WHERE act_id='".$activite->id."' GROUP BY ex_id";
	my_debug("Attempting query: ".$query,__FILE__,__LINE__,"green");
	$dbresult = mysql_query($query);
	$exstats = array();
	while($dbresult && $row = mysql_fetch_assoc($dbresult)){
		$exstats[$row['ex_id']] = array('done'=>$row['exdone'],'right'=>$row['exsuccess']);
	}
	
	echo '<table id="actstats">
	<thead>
		<tr>
			<th>'.lang('Exercice').'</th><th>'.lang('completed').'</th><th>'.lang('successrate').'</th>
		</tr>
	</thead>
	<tbody>
		';
	$sections = $activite->get_sections();
	foreach($sections as $section){
		$exercices = $section->get_exercices(true);
		if(count($exercices)>0)	echo '<tr><th colspan="3">'.$section->getvar('name').'</th></tr>
		';
		foreach($exercices as $oneex){
			$thestats = isset($exstats[$oneex->id])?$exstats[$oneex->id]:array('done'=>0,'right'=>0);
			$percent = $thestats['done']?round($thestats['right']*100/$thestats['done']).'%':'n/a';
			echo '<tr><td class="exlink"><a'.($thestats['done']?' href="results.php?ex_id='.$oneex->id.'"':' class="nolink"').'>'.$oneex->getvar('name').'</a></td><td>'.$thestats['done'].'</td><td>'.$percent.'</td></tr>
		';
		}
	}
	echo '</tbody></table>';
	
}else{
	
	if(isset($params['deleteall']) && $params['deleteall']){
		mysql_query("TRUNCATE TABLE results");
		mysql_query("TRUNCATE TABLE qstats");
	}
	
	echo '<p><a class="btnlink" href="results.php?deleteall=1" onclick="return confirm(\''.lang('supp_stats').'\');">'.getImage('delete').' '.lang('deletestats').'</a></p><br/>';
	
	$activites = array();
	$query = "SELECT activites.name_".CURLANG." actname, activites.id act_id, COUNT(DISTINCT(exercices.id)) totalex FROM ".DBPREFIX."activites activites, ".DBPREFIX."sections sections, ".DBPREFIX."exercices exercices, ".DBPREFIX."questions questions WHERE activites.id = sections.act_id AND sections.id = exercices.sec_id AND exercices.id = questions.ex_id GROUP BY activites.id ORDER BY activites.item_order ASC";
	my_debug("Attempting query: ".$query,__FILE__,__LINE__,"green");
	$dbresult = mysql_query($query);
	if(!$dbresult)	my_debug("Query failed: ".mysql_error(),__FILE__,__LINE__,"green");
	while($dbresult && $row = mysql_fetch_assoc($dbresult)){
		$activites[$row['act_id']] = $row;
		$activites[$row['act_id']]['exdone'] = 0;
		$activites[$row['act_id']]['exsuccess'] = 0;
		$activites[$row['act_id']]['incomplete'] = 0;
	}

	$query = "SELECT act_id, COUNT(ex_id) exdone, SUM(wasright) exsuccess FROM ".DBPREFIX."results GROUP BY act_id, user_id";
	my_debug("Attempting query: ".$query,__FILE__,__LINE__,"green");
	$dbresult = mysql_query($query);
	while($dbresult && $row = mysql_fetch_assoc($dbresult)){
		if(isset($activites[$row['act_id']])){
			if($row['exdone'] >= $activites[$row['act_id']]['totalex']){
				$activites[$row['act_id']]['exdone']++;
				$activites[$row['act_id']]['exsuccess'] = $activites[$row['act_id']]['exsuccess'] + $row['exsuccess'];
			}else{
				$activites[$row['act_id']]['incomplete']++;
			}
		}
	}

	echo '<table id="statstable" cellpadding="0" cellspacing="0">
	<thead>
		<tr>
			<th>'.lang('Activite').'</th><th>'.lang('completed').'</th><th>'.lang('incomplete').'</th><th>'.lang('successrate').'</th>
		</tr>
	</thead>
	<tbody>
		';
	$odd = false;
	foreach($activites as $act){
		$odd = !$odd;
		if($act['exdone'] > 0){
			$rate = round($act['exsuccess'] * 100 / ($act['exdone'] * $act['totalex'])).'%';
		}else{
			$rate = 'n/a';
		}
		echo '<tr class="row'.($odd?1:2).'">
			<td style="text-align: left;"><a href="results.php?act_id='.$act['act_id'].'">'.$act['actname'].'</a></td>
			<td>'.$act['exdone'].'</td>
			<td>'.$act['incomplete'].'</td>
			<td>'.$rate.'</td>
		</tr>
		';
	}
	echo '
	</tbody>
	</table>';
	
}

require "footer.php";
