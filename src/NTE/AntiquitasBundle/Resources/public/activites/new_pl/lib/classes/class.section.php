<?php

class section extends dbobject {
	public $tablename = 'sections';
	public $objectname = 'section';
	
	public $dbvariables=array('act_id','name_fr','name_de');
	public $exercices = array();

	function neworder_where(){
		return "act_id='".$this->act_id."'";
	}

	function ondelete(){
		foreach($this->get_exercices() as $one){
			$one->dbdelete();
		}
		return true;
	}

	public function get_exercices($questions_only=false){
		$this->exercices = array();
		if($this->id){		
			if($questions_only){
				// selects only exercices that have questions
				$query = "SELECT A.* FROM ".DBPREFIX."exercices A, ".DBPREFIX."questions B WHERE A.sec_id='".$this->id."' AND A.id=B.ex_id GROUP BY A.id ORDER BY A.item_order";
			}else{
				$query = "SELECT * FROM ".DBPREFIX."exercices WHERE sec_id='".$this->id."' ORDER BY item_order";
			}
			$result = mysql_query($query);
			while($result && $row = mysql_fetch_assoc($result)){
				$item = new exercice($row, true, true);
				array_push($this->exercices, $item);
			}
		}
		return $this->exercices;
	}
	
	public function editLink(){
		return "edit_activite.php?act_id=".$this->act_id."&sec_id=".$this->id;
	}
	
	public function deletelink(){
		return '<a href="edit_activite.php?act_id='.$this->act_id.'&deletesec='.$this->id.'" onclick="return confirm(\''.lang('supp_section').'\');">'.getImage('delete').'</a>';
	}

}
