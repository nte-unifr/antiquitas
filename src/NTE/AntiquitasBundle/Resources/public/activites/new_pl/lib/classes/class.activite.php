<?php

class activite extends dbobject {
	public $tablename= 'activites';
	public $objectname = 'activite';
	
	public $dbvariables=array('name_fr','name_de','category');
	public $sections = array();
	public $outils = array();

	function ondelete(){
		// when deleting this activity, delete all sections it contains
		foreach($this->get_sections() as $one){
			$one->dbdelete();
		}
		return true;
	}

	public function get_sections(){
		$this->sections = array();
		if($this->id){		
			$result = mysql_query("SELECT * FROM ".DBPREFIX."sections WHERE act_id='".$this->id."' ORDER BY item_order");
			while($result && $row = mysql_fetch_assoc($result)){
				$item = new section($row, true, true);
				array_push($this->sections, $item);
			}
		}
		return $this->sections;
	}
	
	public function get_outils(){
		$this->outils = array();
		if($this->id){		
			$result = mysql_query("SELECT * FROM ".DBPREFIX."outils WHERE act_id='".$this->id."' ORDER BY item_order");
			while($result && $row = mysql_fetch_assoc($result)){
				$item = new outil($row, true, true);
				array_push($this->outils, $item);
			}
		}
		return $this->outils;		
	}

}
