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
	/**
	 * 查询项目下的全部需求，可以通过condition扩展搜索
	 * @param unknown $projectCode
	 * @param unknown $offset
	 * @param unknown $limit
	 * @param string $condition
	 * @param unknown $params
	 * @param string $orderby
	 * @return unknown
	 */
	public function countReqList($projectCode,$condition='',$params=array(),$orderby=''){
		$query="select count(*) cnt from bonjour_requirement_main".
				" where projectCode=? ".$condition;
		$params=array_merge(array($projectCode),$params);
		$result=$this->db->query($query,$params)->fetch();
		return $result->cnt;
	}
	public function queryReqList($projectCode,$offset,$limit,$condition='',$params=array(),$orderby=''){
		$query="select requirementID,requirementName,creatorName,distributorName,".
				" reviewerName,priority,createDate,substring(flag,1,1) currentStatus from bonjour_requirement_main".
				" where projectCode=? ".$condition." ".$orderby." limit $offset,$limit";
		$params=array_merge(array($projectCode),$params);
		$results=$this->db->query($query,$params)->fetchAll();
		return $results;
	}
	/**
	 * 查询根节点下的项目树，且统计项目需求数
	 * @param unknown $rootNode
	 * @return unknown
	 */
	public function queryProjectByRootNode($rootNode){
		$query="select projectCode,projectName,parentNode,sum(reqCount) reqCount from".
				" (select projectCode,projectName,parentNode,0 reqCount from bonjour_project_main".
				" where substring(flag,1,1)!='3' and rootNode=? and nodeType!='R'".
				" union".
				" select a.projectCode,a.projectName,parentNode,count(b.requirementID)".
				" from bonjour_project_main a,bonjour_requirement_main b".
				" where a.projectCode=b.projectCode and substring(a.flag,1,1)!='3' and rootNode=? and a.nodeType!='R'".
				" group by 1,2,3) hh".
				" group by 1,2,3";
		$results=$this->db->query($query,array($rootNode,$rootNode))->fetchAll();
		return $results;
	}
	/**
	 * 查询需求明细
	 * @param unknown $requirementID
	 * @return unknown
	 */
	public function queryReqDetail($requirementID){
		return null;
	}
}

?>