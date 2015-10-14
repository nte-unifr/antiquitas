<?php

class question extends dbobject {
	public $tablename = 'questions';
	public $objectname = 'question';
	public $editlink=false;
	
	public $sec_id;
	public $userval=false;
	public $options = array();
	public $dbvariables=array('ex_id','question_fr','question_de','type','answer','nboptions','feedback_positif_fr','feedback_positif_de','feedback_negatif_fr','feedback_negatif_de',);

	function neworder_where(){
		return "ex_id='".$this->ex_id."'";
	}
	
	function ondelete(){
		// when deleting the question, delete the options
		mysql_query("DELETE FROM ".DBPREFIX."options WHERE q_id='".$this->id."'");
		return true;
	}
	
	function onload(){
		// deserialize answer on load from db
		$this->answer = ($this->answer)==''?false:unserialize($this->answer);
		return true;
	}
		
	function save($noanswer=false){
		// se save function in class.dbobject.php for more info
		if($this->beforesave()){
			$query = ($this->id?"UPDATE ":"INSERT INTO ").$this->tablename." SET ";
			$qvalues = "";
			foreach($this->dbvariables as $key){
				// when the question has options, the answer is provided through a question form, and therefore mustn't be saved with the normal form
				if(!$noanswer || $key != "answer"){
					// answer can hold an array, therefore it is serialized before being saved
					$qvalues .= ($qvalues == ""?"":", ").$key."='".trim(addslashes($key=='answer'?serialize($this->answer):$this->$key))."'";
				}
			}
			$query .= $qvalues;
			if($this->id){
				$query .= " WHERE id=".$this->id;
			}else{
				$query .= ", item_order=".get_neworder($this->tablename, $this->neworder_where());
			}
			my_debug("Attempting query: ".$query,__FILE__,__LINE__,"green");
			if(mysql_query($query)){				
				if(!$this->id && mysql_insert_id())	$this->id = mysql_insert_id();
				$this->onsave();
				return $this->id;
			}else{
				return false;
			}
		}
	}	
	
	public function get_options($return_objects=false){
		// returns an array of options (value=>label) for questions with options
		if(!$return_objects && $this->options)	return $this->options;
		$this->options = array();
		$objects = array();
		if($this->id){		
			$result = mysql_query("SELECT * FROM ".DBPREFIX."options WHERE q_id='".$this->id."' ORDER BY item_order");
			while($result && $row = mysql_fetch_assoc($result)){
				if($return_objects){
					$item = new option($row, true, true);
					array_push($objects, $item);
				}
				$this->options[$row['id']] = stripslashes($row['name_'.CURLANG]);
			}
		}
		return $return_objects?$objects:$this->options;
	}

	public function setUserval($userval){
		$this->userval = $userval;
	}
	
	public function get_input($forcename=false, $prepopulate=false){
		// returns the input to display, without correction (for corrections, see get_correction instead)
		// $prepopulate allows to prepopulate the input with the correct answer
		// for CreateInput functions, see lib/functions.form.php
		if(!$this->type)	return false;
		$name = 'question_'.$this->id;
		if($forcename)	$name = $forcename;
		$userval = $this->userval;
		if($prepopulate)	$userval = $this->get_answer();
		switch($this->type){
			case 'dropdown':
				return CreateInputDropdown($name, $this->get_options(), $userval);
				break;
			case 'select':
				return CreateInputDropdown($name.'[]', $this->get_options(), $userval, 3);
				break;
			case 'radio':
				return CreateInputRadio($name, $this->get_options(), $userval);
				break;
			case 'checkboxes':
				return CreateInputCheckboxes($name.'[]', $this->get_options(), $userval);
				break;
			case 'textbox':
				if($prepopulate){
					$userval = explode('/',$userval);
					$userval = $userval[0];
				}	
				return CreateInputText($name, $userval);
				break;
			case 'textarea':
				return CreateTextarea($name, $userval);
				break;
		}
		return false;
	}

	public function get_answer(){
		// Returns the answer to the question.
		// When we change the question type of a question, the old saved answer can be unfit for the new question type
		// this function handles error checking, to make sure that the answer match the question type
		$should_be_array = ($this->type == 'select' || $this->type == 'checkboxes');
		if($this->answer == 'b:0;'){
			return false;
		}elseif($this->answer && $should_be_array && !is_array($this->answer)){
			$try = @unserialize($this->answer);
			if(@is_array($try)){
				return $try;
			}else{
				return false;
			}
		}elseif(!$should_be_array && is_array($this->answer)){
			return false;
		}elseif(!$should_be_array && substr($this->answer,0,2) == 's:'){
			return unserialize($this->answer);
		}else{
			return $this->answer;
		}
	}

	public function validate(){
		// checks whether the user input matches the answer
		$answer = $this->get_answer();
		if($this->type == 'textarea')	return ($this->userval==''?false:true);
		if($this->type == 'select' || $this->type == 'checkboxes'){
			if(!$this->userval)	return false;
			return (count(array_diff($answer,$this->userval))==0 && count($answer)==count($this->userval));
		}elseif($this->type == 'textbox'){
			$userval = trim(str_replace('  ',' ',$this->userval));
			$answer = explode('/',$answer);
			foreach($answer as $one){
				if(strtolower($userval)==trim(strtolower($one)))	return true;
			}
			return false;
		}else{
			$userval = trim(str_replace('  ',' ',$this->userval));
			return (strtolower($userval)==strtolower($answer));
		}
	}

	public function get_correction($disable=false, $showanswer=false){
		// like get_input, but with corrections
		// if $disable is set to true, the inputs will be disabled (users won't be able to change them anymore)
		// if $showanswer is set to true, the right answer will be displayed when the user gave the wrong one. Otherwise, only right/wrong will be displayed
		if(!$this->type)	return false;
		global $config;
		$disable = $disable?'disabled="disabled"':'';
		$name = 'question_'.$this->id;
		$userval = $this->userval;
		$answer = $this->get_answer();
		$is_right = $this->validate();
		switch($this->type){
			case 'dropdown':
				$options = $this->get_options();
				$output = CreateInputDropdown($name, $options, $userval, false, $disable);
				$output .= $is_right?getImage('correct'):getImage('wrong').($showanswer?'<span class="answer"> '.$options[$answer].'</span>':'');
				return $output;
				break;
			case 'select':
				return CreateInputDropdown($name.'[]', $this->get_options(), $userval, 3);
				break;
			case 'radio':
				return CreateInputRadio($name, $this->get_options(), $userval, $answer, $disable, '', '<br/>', $showanswer);
			case 'checkboxes':
				return CreateInputCheckboxes($name.'[]', $this->get_options(), $userval, $answer, $disable, '', '<br/>', $showanswer);
				break;
			case 'textbox':
				$output = CreateInputText($name, $userval, $disable);
				$answer = explode('/',$answer);
				if($is_right){
					$output .= getImage('correct');
				}else{
					$output .= getImage('wrong').($showanswer?'<span class="answer"> '.trim($answer[0]).'</span>':'');
				}
				return $output;
				break;
			case 'textarea':
				$output = '<table border="0"><tr><td>'.CreateTextarea($name, $userval, $disable).'</td>';
				if($showanswer)	$output .= '<td><div class="answer"> '.$answer.'</div></td></tr></table>';
				return $output;
				break;
		}
		return false;
	}
	
	public function display_stats($stats=false){
		// this is for the admin
		// displays the stats related to this question
		// when we are displaying stats for a lot of questions, we can save query time by querying them all at once and providing them to this function
		// via the $stats param. Otherwise, they will be queried here.
		if(!$this->type)	return false;
		if($stats === false){
			$stats = array();
			$dbresult = mysql_query("SELECT answer FROM ".DBPREFIX."qstats WHERE q_id='".$this->id."'");
			while($dbresult && $row = mysql_fetch_assoc($dbresult))	array_push($stats, unserialize(stripslashes($row['answer'])));
		}
		$answer = $this->get_answer();
		$question = $this->getvar('question');
		if($question == '')	$question = lang('empty_question');
		echo '<table class="stats_question">
		<tr><td></td><td colspan="2">'.$question.'</td></tr>
		';
		switch($this->type){
			case 'dropdown':
			case 'select':
			case 'radio':
			case 'checkboxes':
				$options = $this->get_options();
				$stats_by_option = array();
				$total = 0;
				foreach($stats as $stat){
					if(!is_array($stat))	$stat = array($stat);
					foreach($stat as $opt){
						if(isset($options[$opt])){
							$stats_by_option[$opt] = isset($stats_by_option[$opt])?$stats_by_option[$opt]+1:1;
						}
					}
					$total++;
				}
				if(!is_array($answer))	$answer = array($answer);
				foreach($options as $optid=>$label){
					$number = isset($stats_by_option[$optid])?$stats_by_option[$optid]:0;
					$percent = $total?round($number*100/$total):0;
					echo '<tr><td>'.(in_array($optid,$answer)?getImage('correct'):getImage('wrong')).'</td><td>'.$label.'</td>';
					echo '<td><span class="statsbar" style="width: '.$percent.'px;"></span> '.$percent.'%'.($number>0?' ('.$number.')':'').'</td></tr>
		';
				}
				break;
				
			case 'textbox':
				$total = 0;
				$correct = 0;
				$answer = explode('/',$answer);
				foreach($stats as $stat){
					$total++;
					$gotit = false;
					foreach($answer as $one){
						if(!$gotit && trim(strtolower($stat))==trim(strtolower($one)))	$gotit = true;
					}
					if($gotit)	$correct++;
				}
				$percent = $total?round($correct*100/$total):0;
				echo '<tr><td>'.getImage('correct').'</td><td></td>';
				echo '<td><span class="statsbar" style="width: '.$percent.'px;"></span> '.$percent.'%'.($correct>0?' ('.$correct.')':'').'</td></tr>
		';
				$number = $total-$correct;
				$percent = $total?round($number*100/$total):0;
				echo '<tr><td>'.getImage('wrong').'</td><td></td>';
				echo '<td><span class="statsbar" style="width: '.$percent.'px;"></span> '.$percent.'%'.($number>0?' ('.$number.')':'').'</td></tr>
		';
				echo '<tr><td colspan="3"><a href="results.php?ex_id='.$this->ex_id.'&q_id='.$this->id.'">'.lang('viewanswers').'</a></td></tr>
		';
				break;
			case 'textarea':
				echo '<tr><td colspan="3"><a href="results.php?ex_id='.$this->ex_id.'&q_id='.$this->id.'">'.lang('viewanswers').'</a></td></tr>
		';
				break;
		}
		echo '</table><br/><br/>
		';
	}	
	
	public function display_adminbuttons($sec_id=false){
		// displays the Modify / Delete buttons in admin
		$sec_id = $sec_id?$sec_id:$this->sec_id;
		return '<div class="adminbuttons">'.$this->editlink($sec_id).' '.$this->deletelink($sec_id).'</div>';
	}
	
	public function display($over=false, $showanswer=false){
		// displays the question
		if($over || ($this->userval && $this->userval != '')){
			// if $over (user attempted the maximum amount of tries) or user supplied an answer, display correction
			$output = $this->get_correction($over, $showanswer);
			$feedback_type = 'feedback_'.($this->validate()?'positif':'negatif');
			$feedback = $this->getvar($feedback_type);
			if(trim($feedback) != ''){
				$output .= '<p class="feedback '.$feedback_type.'">'.$feedback.'</p>';
			}
			return $output;
		}else{
			// otherwise display question
			return $this->get_input(false, ISADMIN);
		}
	}
	
	public function deletelink($secid){
		return '<a href="edit_exercice.php?sec_id='.$secid.'&ex_id='.$this->ex_id.'&deleteq='.$this->id.'" onclick="return confirm(\''.lang('supp_question').'\');">'.getImage('delete').lang('delete').'</a>';
	}
	
	public function editlink($secid){
		return '<a href="edit_question.php?sec_id='.$secid.'&ex_id='.$this->ex_id.'&q_id='.$this->id.'">'.getImage('edit').lang('edit').'</a>';
	}	


}
