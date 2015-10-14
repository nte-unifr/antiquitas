<?php

class exercice extends dbobject {
	public $tablename = 'exercices';
	public $objectname = 'exercice';
	
	public $dbvariables=array('sec_id','nbessais','template','dobject','name_fr','name_de','pretext_fr','pretext_de','posttext_fr','posttext_de');
	public $questions = array();
	private $questions_loaded = false;

	function ondelete(){
		// when deleting an exercice, delete all its questions
		foreach($this->get_questions() as $one){
			$one->dbdelete();
		}
		return true;
	}

	public function get_questions(){
		// retrieves the questions in the exercice
		if($this->questions_loaded)	return $this->questions;
		$this->questions = array();
		if($this->id){		
			$query = "SELECT * FROM ".DBPREFIX."questions WHERE ex_id='".$this->id."' ORDER BY item_order";
			$result = mysql_query($query);
			while($result && $row = mysql_fetch_assoc($result)){
				$item = new question($row, true, true);
				$item->sec_id = $this->sec_id;
				array_push($this->questions, $item);
			}
			$this->questions_loaded = true;
		}
		return $this->questions;
	}
	
	public function editLink(){
		return 'edit_exercice.php?sec_id='.$this->sec_id.'&ex_id='.$this->id;
	}
	
	function neworder_where(){
		return "sec_id='".$this->sec_id."'";
	}

	public function display_object(){
		// displays the "object", which can be an image or a call to a script
		global $config;
		if(trim($this->dobject) == '')	return false;
		if(strtolower(substr($this->dobject,0,17))=='script:coinmanip('){
			// the coin manipulator requires special processing. Eventually, if many other do too, we should put this in a separate file
			require_once $config['rootpath'].DIRECTORY_SEPARATOR.'lib'.DIRECTORY_SEPARATOR.'coinManip.php';
			return getCoinManip(substr(trim(trim($this->dobject,';'),')'),17));
		}
		if(strtolower(substr($this->dobject,0,7))=='script:'){
			// if it's a script
			return '
			<script type="text/javascript">
				'.substr($this->dobject,7).'
			</script>';
		}
		$ext = strtolower(substr(strrchr($this->dobject, "."), 1));
		if(!$ext || $ext == '')	return false;
		$path = $config['rootpath'].DIRECTORY_SEPARATOR.'files'.DIRECTORY_SEPARATOR.$this->dobject;
		if(!file_exists($path))		return false;
		$url = (ISADMIN?'../':'').'files/'.$this->dobject;
		switch($ext){
			case 'jpg':
			case 'jpeg':
			case 'png':
			case 'gif':
				return '<img id="exobj" src="'.$url.'" alt=""/>';
				break;
		}
		return false;
	}

	public function retrieve_inputs($params){
		// retrieves the user inputs (answers to questions) from the (post) params and assign it to the appropriate question
		// if all questions have been answered, the function returns true (and false otherwise)
		$questions = array();
		$gotall = true;
		foreach($this->get_questions() as $question){
			if(isset($params['question_'.$question->id]) && $params['question_'.$question->id] != ''){
				$question->setUserval($params['question_'.$question->id]);
			}else{
				$gotall = false;
			}
			array_push($questions, $question);
		}
		$this->questions = $questions;
		return $gotall;
	}

	public function validate(){
		// checks whether all questions have been given right answers or not
		// (must be called after retrieve_inputs)
		foreach($this->get_questions() as $question)	if(!$question->validate())	return false;
		return true;
	}
	
	public function save_stats($userid=0){
		// save the user's answers to the database
		// (must be called after retrieve_inputs)
		global $config;
		if($userid){
			if(isset($config['overwrite_qstats']) && $config['overwrite_qstats']){
				mysql_query("DELETE FROM ".DBPREFIX."qstats WHERE ex_id='".$this->id."' AND user_id='".$userid."'");
			}else{
				mysql_query("UPDATE ".DBPREFIX."qstats SET user_id='' WHERE ex_id='".$this->id."' AND user_id='".$userid."'");
			}
		}
		$query = "";
		foreach($this->get_questions() as $q){
			$query .= ($query==""?"":",")."('".$userid."','".$this->id."','".$q->id."','".addslashes(serialize($q->userval))."')";
		}
		if($query != ""){
			$query = "INSERT INTO ".DBPREFIX."qstats (user_id, ex_id, q_id, answer) VALUES ".$query;
			my_debug("Attempting query: ".$query,__FILE__,__LINE__,"green");
			if(!mysql_query($query))	my_debug("Query failed: ".mysql_error(),__FILE__,__LINE__,"green");
		}
	}
	
	public function get_success_rate(){
		// retrieve the exercice's success rate in % (for admin)
		$dbresult = mysql_query("SELECT COUNT(*) exdone, SUM(wasright) exsuccess FROM ".DBPREFIX."results WHERE ex_id='".$this->id."' GROUP BY ex_id");	
		if($dbresult && $row = mysql_fetch_assoc($dbresult)){
			return round($row['exsuccess']*100/$row['exdone']);
		}else{
			return 0;
		}
	}
	
	public function display_stats(){
		// displays each question's statistics in this exercice (for admin)
		$dbresult = mysql_query("SELECT q_id, answer FROM ".DBPREFIX."qstats WHERE ex_id='".$this->id."' ORDER BY q_id");
		$results = array();
		while($dbresult && $row = mysql_fetch_assoc($dbresult)){
			if(!isset($results[$row['q_id']]))	$results[$row['q_id']] = array();
			array_push($results[$row['q_id']], unserialize(stripslashes($row['answer'])));
		}
		foreach($this->get_questions() as $q)	$q->display_stats(isset($results[$q->id])?$results[$q->id]:array());
	}
	
	public function deletelink($actid){
		return '<a href="edit_activite.php?act_id='.$actid.'&sec_id='.$this->sec_id.'&deleteex='.$this->id.'" onclick="return confirm(\''.lang('supp_exercice').'\');">'.getImage('delete').'</a>';
	}	

	public function display_questions($over=false, $tried=false){
		// display this exercice's questions, using this exercice's template
		// (this is called from both admin and frontend)
		// $over tells whether the exercice is over (all allowed attempts have been used, or all questions have been correctly answered)
		// $tried tells whether any question was answered (correctly or not)
		echo '<div class="exercice_inner">';
		global $config;
		
		// we mostly prepare the variables for the template
		
		$questions = $this->get_questions();
		
		$showanswers = $over;

		$pretext = $this->getvar('pretext');
		$posttext = $this->getvar('posttext');

		// we retrieve the templates, and if it doesn't exist, the default template
		$filepath = $config['rootpath'].DIRECTORY_SEPARATOR.'templates'.DIRECTORY_SEPARATOR.$this->template;
		if(trim($this->template) == '' || trim($this->template) == '/' || !file_exists($filepath))	$filepath = $config['rootpath'].DIRECTORY_SEPARATOR.'templates'.DIRECTORY_SEPARATOR.'default.php';
		require $filepath;
		
		if($tried && !$over){
			// reset button
			echo '<div id="ex_result">'.lang('tryagain').'</div>';
		}elseif($over && $posttext){
			// we display the posttext (explanation)
			echo '<div class="posttext">'.$posttext.'</div>';
		}
		
		echo '</div>';
	}

}
