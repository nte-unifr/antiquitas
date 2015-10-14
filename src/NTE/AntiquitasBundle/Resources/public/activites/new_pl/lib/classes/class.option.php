<?php

class option extends dbobject {
	public $tablename = 'options';
	public $objectname = 'option';
	
	public $dbvariables=array('q_id','name_fr','name_de');
	
	function neworder_where(){
		return "q_id='".$this->q_id."'";
	}
	
	public function editLink($ex_id=false, $sec_id=false){
		$output = "edit_question.php?q_id=".$this->q_id."&opt_id=".$this->id;
		if($ex_id && $sec_id)	$output .= "&ex_id=".$ex_id."&sec_id=".$sec_id;
		return $output;
	}
	
	public function deletelink($exid){
		return '<a href="edit_question.php?ex_id='.$exid.'&q_id='.$this->q_id.'&deleteopt='.$this->id.'" onclick="return confirm(\''.lang('supp_option').'\');">'.getImage('delete').'</a>';
	}		

}
