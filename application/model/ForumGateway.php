<?php

/**
 * 系统版块
 * @author hujianhong05
 *
 */

class Bonjour_Model_ForumGateway extends Bonjour_Core_Model_GateWay{
	
	/**
	 * 查询某菜单下的所有版块
	 * @param integer $menuID
	 * @return unknown
	 */
	public function queryValidForumByMenuID($menuID){
		
		$query="select forumID,parentID,forumName,url from ".$this->prefix."forum".
				" where menuID=? and validstatus=1".
				" order by forumOrder asc";
		$result=$this->db->query($query,$menuID)->fetchAll();
		
		return $result;
	}
	
}

?>