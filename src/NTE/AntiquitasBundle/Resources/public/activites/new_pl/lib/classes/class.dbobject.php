<?php

// this is the main class serving as a base for all other entity classes


class dbobject {
	public $id=false;
	public $dbvariables=array();	// contains each variable in the db table (except id)
	public $tablename=false;		// db table name, without prefix
	public $objectname=false;

	function __construct($row=array(), $trigger=true, $strip=false){
		// see buildFromRow
		$this->tablename = DBPREFIX.$this->tablename;
		foreach($this->dbvariables as $var)	$this->$var = false;
		if(count($row) > 0) $this->buildFromRow($row, $strip);
		if($trigger)	$this->oncreate();
	}

	function buildFromRow($row=array(), $strip=false){
		// $row is the array of values (key=>value) to be inserted in the object
		// when $strip is set to true, stripslashes will be executed on the values
		foreach($this->dbvariables as $var){
			if(isset($row[$var])){
				$this->$var = $strip?stripslashes($row[$var]):$row[$var];
			}
		}
		if(isset($row['id'])) $this->id = $row['id'];
	}
	
	function getvar($varname){
		// SHOULD BE USED TO RETRIEVE ANY LANGUAGE-SENSITIVE VARIABLE
		// for example, getvar('name') will return 'name_fr' (provided it exists and is non-empty) in a french context
		$locname = $varname.'_'.CURLANG;
		$otherlang = $varname.'_'.(CURLANG=='fr'?'de':'fr');
		if(isset($this->$locname)){
			if($this->$locname == '' && $this->$otherlang != ''){
				// if the current language variable is empty, return the other language's value
				return $this->$otherlang;
			}else{
				return $this->$locname;
			}
		}elseif(isset($this->$varname)){
			return $this->$varname;
		}
		return false;
	}
	
	function onload(){
		// called right after an item is loaded from the database
		return true;
	}
	function onsave(){
		// called right after an item has been saved in the database
		return true;
	}
	function ondelete(){
		// called right after an item is deleted
		return true;
	}
	function oncreate(){
		// called right after an item's creation
		return true;
	}
	function beforesave(){
		// called right before an item is saved.
		// if it returns true, the item will be saved; if it returns false, it won't
		return true;
	}
	
	function neworder_where(){
		// this is used for reordering, when items are reordered by parents, to specify the sql condition ( where parent=? )
		return false;
	}

	function load($id){
		// loads item from the db
		$id = (int) $id;
		if( !($id>0) )	return false;
		$query = "SELECT * FROM ".$this->tablename." WHERE id='".$id."' LIMIT 1";
		$result = mysql_query($query);
		if($row = mysql_fetch_assoc($result)){
			$this->buildFromRow($row,true);
			$this->id = $row['id'];
			$this->onload();
			return true;
		}else{
			return false;
		}
	}

	function save(){
		// saves item to the db
		// returns the item's id if successful
		if($this->beforesave()){
			$query = ($this->id?"UPDATE ":"INSERT INTO ").$this->tablename." SET ";
			$qvalues = "";
			foreach($this->dbvariables as $key){
				$qvalues .= ($qvalues == ""?"":", ").$key."='".trim(addslashes($this->$key))."'";
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

	function dbdelete(){
		// delete an item from the db
		if($this->id){
			$query = "DELETE FROM ".$this->tablename." WHERE id='".$this->id."' LIMIT 1";
			if(mysql_query($query)){
				return $this->ondelete();
			}else{
				return false;
			}
		}else{
			return false;
		}
	}

}
