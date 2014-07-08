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
	 * 修改需求
	 * @param unknown $set
	 * @param unknown $where
	 * @return unknown
	 */
	public function modifyReq($set,$where){
		$affected_rows = $this->db->update ( $this->prefix . 'requirement_main', $set ,$where );
		return $affected_rows;
	}
	/**
	 * 根据项目编码查询需求快照
	 * @param unknown $projectCode
	 * @return unknown
	 */
	public function countReqSnapByProjectCode($projectCode,$keyword=null){
		$query="select count(*) cnt from ".$this->prefix."requirement_main where projectCode=? ";
		if($keyword == null){
			$result=$this->db->query($query,$projectCode)->fetch();
		}else{
			$query=$query." and requirementName regexp ?";
			$result=$this->db->query($query,array($projectCode,$keyword))->fetch();
		}
		return $result->cnt;
	}
	public function queryReqSnapByProjectCode($projectCode,$keyword=null,$offset,$limit){
		$query="select requirementID,requirementName,createDate from ".$this->prefix."requirement_main where projectCode=? ";
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
		$query="select count(*) cnt from ".$this->prefix."requirement_main".
				" where projectCode=? ".$condition;
		$params=array_merge(array($projectCode),$params);
		$result=$this->db->query($query,$params)->fetch();
		return $result->cnt;
	}
	public function queryReqList($projectCode,$offset,$limit,$condition='',$params=array(),$orderby=''){
		$query="select requirementID,requirementName,creatorName,distributorName,".
				" reviewerName,priority,createDate,substring(flag,1,1) currentStatus from ".$this->prefix."requirement_main".
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
				" (select projectCode,projectName,parentNode,0 reqCount from ".$this->prefix."project_main".
				" where substring(flag,1,1)!='3' and rootNode=?".
				" union".
				" select a.projectCode,a.projectName,parentNode,count(b.requirementID)".
				" from ".$this->prefix."project_main a,".$this->prefix."requirement_main b".
				" where a.projectCode=b.projectCode and substring(a.flag,1,1)!='3' and rootNode=?".
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
		$query="select requirementID,requirementName,projectCode,description,acceptanceCriteria,dependenceID,".
				" createDate,lastModifiedTime,creatorName,distributorID,distributorName,reviewerID,reviewerName,".
				" closedBy,priority,lockedStatus,substring(flag,1,1) statusFlag,substring(flag,2,1) dependenceFlag,moduleName".
				" from ".$this->prefix."requirement_main where requirementID=?";
		$result=$this->db->query($query,$requirementID)->fetch();
		return $result;
	}
	/**
	 * 需求高级查询，可自定义字段和条件，只允许返回一条数据
	 * @param array $fields
	 * @param unknown $where
	 * @param unknown $params
	 * @return unknown
	 */
	public function advancedQueryReqDetail($fields,$condition,$params){
		$glued_fields=implode(',', $fields);	//字段片段
		$query="select $glued_fields from " . $this->prefix . "requirement_main where $condition";
		$result = $this->db->query ( $query, $params )->fetch ();
		return $result;
	}
	
	///////////////////////////////////需求评审管理///////////////////////////////////
	/**
	 * 添加评审
	 * @param unknown $rev
	 * @return unknown
	 */
	public function addReqReview($rev){
		$affected_rows = $this->db->insert ( $this->prefix . 'requirement_review', $rev);
		return $affected_rows;
	}
}

?>