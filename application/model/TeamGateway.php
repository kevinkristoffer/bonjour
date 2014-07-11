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
	 * 添加团队成员
	 * @param unknown $member
	 * @return unknown
	 */
	public function addTeamMember($member){
		$affected_rows=$this->db->insert($this->prefix.'team',$member);
		return $affected_rows;
	}
	
	public function queryTeamList($offset,$limit){
		
	}
	
	public function queryTeamMember($teamID){
		
	}
}

?>