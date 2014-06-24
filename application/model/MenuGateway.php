<?php

/**
 * 系统菜单
 * @author hujianhong05
 *
 */
class Bonjour_Model_MenuGateway extends Bonjour_Core_Model_GateWay{
	
	/**
	 * 查询全部有效菜单
	 * @return unknown
	 */
	public function queryAllValidMenu(){
		
		$query="select menuID,menuName from ".$this->prefix."menu".
				" where validstatus=1".
				" order by menuOrder asc";
		$result=$this->db->fetchAll($query);
		
		return $result;
	}
	
	
}

?>