<?php

class Bonjour_Model_UserGateway extends Bonjour_Core_Model_GateWay {
	
	/**
	 * 新建用户
	 * @param unknown $user
	 * @return number
	 */
	public function addUser($user){
		$affected_rows=$this->db->insert($this->prefix.'user',$user);
		return $affected_rows;
	}
	
	/**
	 * 修改用户
	 * @param unknown $set
	 * @param unknown $where
	 * @return number
	 */
	public function modifyUser($set,$where){
		$affected_rows=$this->db->update($this->prefix.'user',$set,$where);
		return $affected_rows;
	}

	/**
	 * 计算搜索到的有效用户数
	 * @param unknown $keyword
	 * @return unknown
	 */
	public function countValidUser($keyword=null){
		$result=null;
		if(isset($keyword) && $keyword!=''){
			$query="select count(*) cnt from ".$this->prefix."user where validStatus=1 and userName regexp ?";
			$result=$this->db->query($query,$keyword)->fetch();
		}else{
			$query="select count(*) cnt from ".$this->prefix."user where validStatus=1";
			$result=$this->db->query($query)->fetch();
		}
		return $result->cnt;
	}
	/**
	 * 分页查询搜索到的有效用户
	 * @param unknown $keyword
	 * @param unknown $offset
	 * @param unknown $limit
	 * @return unknown
	 */
	public function queryValidUser($offset,$limit,$keyword=null){
		$results=null;
		if(isset($keyword) && $keyword!=''){
			$query=" select userID,userName,b.roleName from ".$this->prefix."user a,".$this->prefix."role b".
					" where a.RoleID=b.roleID and a.validStatus=1 and userName regexp ? limit $offset,$limit";
			$results=$this->db->query($query,$keyword)->fetchAll();
		}else{
			$query=" select userID,userName,b.roleName from ".$this->prefix."user a,".$this->prefix."role b".
					" where a.RoleID=b.roleID and a.validStatus=1 limit $offset,$limit";
			$results=$this->db->query($query)->fetchAll();
		}
		return $results;
	}
	
	
	public function countUserList(){
		
	}
	public function queryUserList(){
		
	}
	/**
	 * 登录用户验证
	 * @param unknown $userName
	 * @param unknown $userPass
	 * @return boolean
	 */
	public function validUser($userName,$userPass){
		$query="select count(*) cnt from bonjour_user a,bonjour_role b".
			   " where a.roleID=b.roleID and a.userName=? and a.userPass=? and a.validStatus=1";
		$result=$this->db->query($query,array($userName,$userPass))->fetch();
		return $result->cnt == 1 ? true : false;
	}
	/**
	 * 用户高级查询
	 * @param unknown $fields
	 * @param unknown $condition
	 * @param unknown $params
	 * @return unknown
	 */
	public function advancedQueryUser($fields,$condition,$params){
		$glued_fields=implode(',', $fields);	//字段片段
		$query="select $glued_fields from " . $this->prefix . "user where $condition";
		$result = $this->db->query ( $query, $params )->fetch ();
		return $result;
	}
}

?>