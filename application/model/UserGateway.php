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
		$query="select count(*) cnt from ".$this->prefix."user where validStatus=1";
		if(isset($keyword) && $keyword!=''){
			$query=$query." and userName regexp ?";
			$result=$this->db->query($query,$keyword)->fetch();
		}else{
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
		$query=" select userID,userName,b.roleName from ".$this->prefix."user a,".$this->prefix."role b".
				" where a.RoleID=b.roleID and a.validStatus=1";
		if(isset($keyword) && $keyword!=''){
			$query=$query." and userName regexp ? limit $offset,$limit";
			$results=$this->db->query($query,$keyword)->fetchAll();
		}else{
			$query=$query." limit $offset,$limit";
			$results=$this->db->query($query)->fetchAll();
		}
		return $results;
	}
	
	
	
	/**
	 * 分页查询用户列表
	 * @param unknown $offset
	 * @param unknown $limit
	 */
	public function countUserList($condition='',$params=array()){
		//添加1=1可以有and前缀
		if($condition!=''){
			$condition='where 1=1 '.$condition;
		}
		$query="select count(*) cnt from ".$this->prefix."user a $condition";
		$result=$this->db->query($query,$params)->fetch();
		return $result->cnt;
	}
	public function queryUserList($condition='',$params=array(),$offset,$limit){
		$query="select a.userID,a.accountName,a.userName,b.roleID,b.roleName,a.email,a.mobile,".
				" a.phoneNumber,a.creatorName,a.createDate,a.loginTimes,a.lastLogin,a.validStatus".
				" from ".$this->prefix."user a,".$this->prefix."role b".
				" where a.roleID=b.roleID $condition order by 1 limit $offset,$limit";
		$results=$this->db->query($query,$params)->fetchAll();
		return $results;
	}
	/**
	 * 登录用户验证
	 * @param unknown $userName
	 * @param unknown $userPass
	 * @return boolean
	 */
	public function validUser($accountName,$userPass){
		$query="select a.userID,a.userName,b.roleID,b.roleName from ".$this->prefix."user a,".$this->prefix."role b".
			   " where a.roleID=b.roleID and a.accountName=? and a.userPass=? and a.validStatus=1";
		$result=$this->db->query($query,array($accountName,$userPass))->fetch();
		return $result;
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
		$query="select $glued_fields from ".$this->prefix."user where $condition";
		$result = $this->db->query ( $query, $params )->fetch ();
		return $result;
	}
	////////////////////////////////////////////////////////////////////////////////
	/**
	 * 新建角色
	 * @param unknown $role
	 * @return unknown
	 */
	public function addRole($role){
		$affected_rows=$this->db->insert($this->prefix.'role',$role);
		return $affected_rows;
	}
	/**
	 * 修改角色
	 * @param unknown $set
	 * @param unknown $where
	 * @return unknown
	 */
	public function modifyRole($set,$where){
		$affected_rows=$this->db->update($this->prefix.'role',$set,$where);
		return $affected_rows;
	}
	/**
	 * 查询角色快照
	 * @return unknown
	 */
	public function queryRoleSnapList(){
		$query="select roleID,roleName from ".$this->prefix."role";
		$results=$this->db->query($query)->fetchAll();
		return $results;
	}
	/**
	 * 分页查询全部角色
	 */
	public function countRoleList(){
		$query="select count(*) cnt from ".$this->prefix."role";
		$result=$this->db->query($query)->fetch();
		return $result->cnt;
	}
	public function queryRoleList($offset,$limit){
		$query="select roleID,roleName,creatorID,creatorName,createDate,validStatus,remark".
				" from ".$this->prefix."role order by 1 limit $offset,$limit";
		$results=$this->db->query($query)->fetchAll();
		return $results;
	}
}

?>