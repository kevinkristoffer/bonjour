<?php
/**
 * 团队管理
 * @author hujianhong05
 *
 */
class Bonjour_Model_TeamGateway extends Bonjour_Core_Model_GateWay{
	
	/**
	 * 新建团队
	 * @param unknown $team
	 * @return unknown
	 */
	public function addTeam($team){
		$affected_rows=$this->db->insert($this->prefix.'team',$team);
		return $affected_rows;
	}
	/**
	 * 修改团队
	 * @param unknown $set
	 * @param unknown $where
	 * @return unknown
	 */
	public function modifyTeam($set,$where){
		$affected_rows=$this->db->update($this->prefix.'team',$set,$where);
		return $affected_rows;
	}
	/**
	 * 分页查询团队快照
	 * @param unknown $offset
	 * @param unknown $limit
	 */
	public function countTeamSnapList($keyword=null){
		$result=null;
		$query="select count(*) cnt from ".$this->prefix."team where validStatus=1";
		if(isset($keyword) && $keyword!=''){
			$query=$query." and teamName regexp ?";
			$result=$this->db->query($query,$keyword)->fetch();
		}else{
			$result=$this->db->query($query)->fetch();
		}
		return $result->cnt;
	}
	public function queryTeamSnapList($offset,$limit,$keyword=null){
		$results=null;
		$query="select teamID,teamName,nickName,responsibleName from ".$this->prefix."team where validStatus=1";
		if(isset($keyword) && $keyword!=''){
			$query=$query." and teamName regexp ? limit $offset,$limit";
			$results=$this->db->query($query,$keyword)->fetchAll();
		}else{
			$query=$query." limit $offset,$limit";
			$results=$this->db->query($query)->fetchAll();
		}
		return $results;
	}
	/**
	 * 分页查询团队列表
	 * @param unknown $offset
	 * @param unknown $limit
	 */
	public function countTeamList(){
		$query="select count(*) cnt from ".$this->prefix."team";
		$result=$this->db->query($query)->fetch();
		return $result->cnt;
	}
	public function queryTeamList($offset,$limit){
		$query="select teamID,teamName,responsibleName,creatorName,createTime,validStatus from ".$this->prefix."team";
		$results=$this->db->query($query)->fetchAll();
		return $results;
	}
	/**
	 * 添加团队成员
	 * @param unknown $member
	 * @return unknown
	 */
	public function addTeamMember($member){
		$affected_rows=$this->db->insert($this->prefix.'team_member',$member);
		return $affected_rows;
	}
	/**
	 * 查询团队成员
	 * @param unknown $teamID
	 * @return unknown
	 */
	public function queryTeamMember($teamID){
		$query="select userID,userName,roleDesc,createTime from ".$this->prefix."team_member where teamID=?";
		$results=$this->db->query($query)->fetchAll();
		return $results;
	}
	/**
	 * 移除团队成员
	 * @param unknown $teamID
	 * @param unknown $userID
	 * @return unknown
	 */
	public function removeTeamMember($teamID,$userID){
		$where['teamID=?']=$teamID;
		$where['userID=?']=$userID;
		$affected_rows=$this->db->delete($this->prefix.'team_member',$where);
		return $affected_rows;
	}
	
	/**
	 * 分页查询未加入该团队的用户
	 * @param unknown $offset
	 * @param unknown $limit
	 * @param unknown $teamID
	 * @param string $keyword
	 * @return NULL
	 */
	public function countValidUser($teamID,$keyword=null){
		$result=null;
		$query="select count(*) cnt from ".$this->prefix."user where validStatus=1".
				" and userID not in (select userID from ".$this->prefix."team_member where teamID=?)";
		if(isset($keyword) && $keyword!=''){
			$query=$query." and userName regexp ?";
			$result=$this->db->query($query,array($teamID,$keyword))->fetch();
		}else{
			$result=$this->db->query($query,$teamID)->fetch();
		}
		return $result->cnt;
	}
	public function queryValidUser($offset,$limit,$teamID,$keyword=null){
		$results=null;
		$query=" select userID,userName,b.roleName from ".$this->prefix."user a,".$this->prefix."role b".
				" where a.RoleID=b.roleID and a.validStatus=1".
				" and userID not in (select userID from ".$this->prefix."team_member where teamID=?)";
		if(isset($keyword) && $keyword!=''){
			$query=$query." and userName regexp ? limit $offset,$limit";
			$results=$this->db->query($query,array($teamID,$keyword))->fetchAll();
		}else{
			$query=$query." limit $offset,$limit";
			$results=$this->db->query($query,$teamID)->fetchAll();
		}
		return $results;
	}
}

?>