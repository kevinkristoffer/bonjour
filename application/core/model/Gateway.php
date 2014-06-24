<?php

class Bonjour_Core_Model_GateWay {
	
	protected $db;
	
	protected $prefix;
	
	public function __construct($db){
		$this->prefix=Bonjour_Core_Db_Connection::getDbPrefix();
		if($db != null){
			$this->setDbAdater($db);
		}
	}
	
	/*
	 * 
	 * in consideration of switch database
	 */
	public function setDbAdater($adapter){
		$this->db=$adapter;
	}

}

?>