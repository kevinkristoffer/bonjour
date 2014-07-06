<?php

class Bonjour_Model_ReqGateway extends Bonjour_Core_Model_GateWay{
	
	/**
	 * 新建需求
	 * @param unknown $req
	 * @return unknown
	 */
	public function addReq($req){
		$affected_rows = $this->db->insert ( $this->prefix . 'requirement_main', $req);
		return $affected_rows;
	}
	/**
	 * 根据项目编码查询需求快照
	 * @param unknown $projectCode
	 * @return unknown
	 */
	public function countReqSnapByProjectCode($projectCode,$keyword=null){
		$query="select count(*) cnt from ".$this->prefix."requirement_main where projectCode=?";
		if($keyword == null){
			$result=$this->db->query($query,$projectCode)->fetch();
		}else{
			$query=$query." and requirementName regexp ?";
			$result=$this->db->query($query,array($projectCode,$keyword))->fetch();
		}
		return $result->cnt;
	}
	public function queryReqSnapByProjectCode($projectCode,$keyword=null,$offset,$limit){
		$query="select requirementID,requirementName,createDate from ".$this->prefix."requirement_main where projectCode=?";
		$limit=" limit $offset,$limit";
		if($keyword == null){
			$results=$this->db->query($query.$limit,$projectCode)->fetchAll();
		}else{
			$query=$query." and requirementName regexp ?";
			$results=$this->db->query($query.$limit,array($projectCode,$keyword))->fetchAll();
		}
		return $results;
	}
}

?>