<?php

class outil extends dbobject {
	public $tablename = 'outils';
	public $objectname = 'outil';
	
	public $dbvariables=array('act_id','name_fr','name_de','url_fr','url_de');

	function neworder_where(){
		return "act_id='".$this->act_id."'";
	}
	
	public function editLink(){
		return "edit_activite.php?act_id=".$this->act_id."&outil_id=".$this->id;
	}
	
	public function deletelink(){
		return '<a href="edit_activite.php?act_id='.$this->act_id.'&delete_outil='.$this->id.'" onclick="return confirm(\''.lang('supp_outil').'\');">'.getImage('delete').'</a>';
	}

}
