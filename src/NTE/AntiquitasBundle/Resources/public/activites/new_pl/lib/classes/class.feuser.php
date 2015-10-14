<?php

class feuser {
	// frontend user session
	
	public $userid = false;
	public $activites = false;
	
	public function __construct($userid=false){
		// upon construction of the front user, we either restore a session or create a new one.
		// before being supplied here, $userid should be checked with user_exists (in functions.misc.php)
		global $_SESSION;
		if(!$userid){
			if(isset($_SESSION[USERVAR])){
				$userid = $_SESSION[USERVAR];
			}else{
				$userid = uniqid('student');
				$_SESSION[USERVAR] = $userid;
			}
		}
		$this->userid = $userid;
	}
	
	public function load_stats(){
		// loads the activities, their completion status and success for this user
		// 'exdone' is the number of exercice completed in this activity
		// 'exsuccess' is the number of exercice with right answers in this activity
		if(!$this->userid)	return false;
		$this->activites = array();
		$actname = 'activites.name_'.CURLANG;
		$query = "SELECT activites.name_fr name_fr, activites.name_de name_de, activites.category cat_id, activites.id act_id, COUNT(DISTINCT(exercices.id)) totalex FROM ".DBPREFIX."activites activites LEFT JOIN ".DBPREFIX."categories cats ON activites.category=cats.id, ".DBPREFIX."sections sections, ".DBPREFIX."exercices exercices, ".DBPREFIX."questions questions WHERE activites.id = sections.act_id AND sections.id = exercices.sec_id AND exercices.id = questions.ex_id GROUP BY activites.id ORDER BY cats.item_order, activites.item_order ASC";
		my_debug("Attempting query: ".$query,__FILE__,__LINE__,"green");
		$dbresult = mysql_query($query);
		if(!$dbresult){
			my_debug("Query failed: ".mysql_error(),__FILE__,__LINE__,"green");
			return false;
		}
		while($row = mysql_fetch_assoc($dbresult)){
			$this->activites[$row['act_id']] = $row;
			$this->activites[$row['act_id']]['exdone'] = 0;
			$this->activites[$row['act_id']]['exsucces'] = 0;
		}
		$query = "SELECT act_id, COUNT(ex_id) exdone, SUM(wasright) exsuccess FROM ".DBPREFIX."results WHERE user_id='".$this->userid."' GROUP BY act_id";
		my_debug("Attempting query: ".$query,__FILE__,__LINE__,"green");
		$dbresult = mysql_query($query);
		while($dbresult && $row = mysql_fetch_assoc($dbresult)){
			if(isset($this->activites[$row['act_id']])){
				$this->activites[$row['act_id']]['exdone'] = $row['exdone'];
				$this->activites[$row['act_id']]['exsuccess'] = $row['exsuccess'];
			}
		}
	}
	
	public function activities_menu(){
		// displays the user-specific activity menu
		if(!$this->userid)	return false;
		if(!$this->activites) $this->load_stats();
		$categories = get_categories();
		echo '<ul id="actlist">';
		$last_cat = false;
		foreach($this->activites as $oneact){
			$cat_name = isset($categories[$oneact['cat_id']])?$categories[$oneact['cat_id']]:lang('misc');
			if($cat_name != $last_cat){
				if($last_cat)	echo '</ul></li>';
				echo '<li class="category">'.$cat_name.'<ul>';
				$last_cat = $cat_name;
			}
			if($oneact['exdone'] >= $oneact['totalex']){
				// activity completed (exdone = the number of exercices in the activity)
				$class = ' class="actdone"';
				$label = ' &nbsp;('.$oneact['exsuccess'].'/'.$oneact['totalex'].')';
			}elseif($oneact['exdone'] > 0){
				// activity incompleted (but started)
				$class = '';
				$label = ' &nbsp;('.lang('incomplete').')';
			}else{
				// activity never touched
				$class = '';
				$label = '';				
			}
			$act_name = $oneact['name_'.CURLANG] == ''?$oneact['name_'.(CURLANG=='fr'?'de':'fr')]:$oneact['name_'.CURLANG];
			echo '<li><a'.$class.' href="index.php?act='.$oneact['act_id'].'">'.$act_name.'</a>'.$label.'</li>';	
		}
		echo '</ul></li></ul>';
	}

	public function save_user_result($act_id, $ex_id, $success){
		// saves when an exercice has been completed (the specific answers are not saved here, but in save_stats (class.exercice.php)
		// here only the 'completed' status of an exercice is saved
		if(!$this->userid)	return false;
		$act_id = (int) $act_id;
		$ex_id = (int) $ex_id;
		$success = (int) $success;
		mysql_query("DELETE FROM ".DBPREFIX."results WHERE user_id='".$this->userid."' AND ex_id=$ex_id LIMIT 1");
		$query = "INSERT INTO ".DBPREFIX."results SET user_id='".$this->userid."', act_id=$act_id, ex_id=$ex_id, wasright=$success";
		my_debug("Attempting query: ".$query,__FILE__,__LINE__,"green");
		if(mysql_query($query)){
			return true;
		}else{
			my_debug("Query failed: ".mysql_error(),__FILE__,__LINE__,"red");
			return false;
		}
	}
	
}
