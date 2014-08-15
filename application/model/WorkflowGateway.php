<?php
/**
 * 工作流
 * @author hujianhong05
 *
 */

class Bonjour_Model_WorkflowGateway extends Bonjour_Core_Model_GateWay{
	
	//////////////////模板管理//////////////////
	/**
	 * 新建主流程
	 * @param unknown $flow
	 * @return unknown
	 */
	public function addFlow($flow){
		$affected_rows=$this->db->insert($this->prefix."workflow_main",$flow);
		return $affected_rows;
	}
	/**
	 * 生成流程号
	 * @return string
	 */
	public function generateFlowNo(){
		$maxNo=1;
		$query="select max(substring(flowNo,3,4)) maxNo from ".$this->prefix."workflow_main";
		$result=$this->db->query($query)->fetch();
		if($result->maxNo != null){
			$maxNo=intval($result->maxNo)+1;
		}
		$maxNo = sprintf ( '%04d', $maxNo ); // 编码补零
		return 'BF'.$maxNo;
	}
	/**
	 * 修改主流程
	 * @param unknown $set
	 * @param unknown $where
	 * @return unknown
	 */
	public function modify($set,$where){
		$affected_rows=$this->db->update($this->prefix.'workflow_main',$set,$where);
		return $affected_rows;
	}
	/**
	 * 查询全部主流程
	 * @param unknown $fields
	 */
	public function queryFlowList(){
		$query="select a.flowNo,a.flowName,a.entity,b.statusCNName status1,c.statusCNName status2,d.statusCNName status3,".
				"b.statusENName status4,c.statusENName status5,d.statusENName status6".
				" from ".$this->prefix."workflow_main a,".$this->prefix."status b,".$this->prefix."status c,".$this->prefix."status d".
				" where a.presentStatus=b.statusENName and a.failStatus=c.statusENName and a.successStatus=d.statusENName";
		$results=$this->db->query($query)->fetchAll();
		return $results;
	}
	/**
	 * 查询全部主流程快照
	 * @return unknown
	 */
	public function queryFlowListSnap(){
		$query="";
		$results=$this->db->query($query)->fetchAll();
		return $results;
	}
	/**
	 * 查询全部的实体
	 * @return unknown
	 */
	public function queryEntityList(){
		$query="select distinct entityName id,entityName text from ".$this->prefix."status";
		$results=$this->db->query($query)->fetchAll();
		return $results;
	}
	/**
	 * 查询全部状态
	 * @return unknown
	 */
	public function queryStatusList(){
		$query="select entityName entity,statusENName id,statusCNName text from ".$this->prefix."status";
		$results=$this->db->query($query)->fetchAll();
		return $results;
	}
	/**
	 * 新建环节
	 * @param unknown $template
	 * @return unknown
	 */
	public function addSegment($segment){
		$affected_rows=$this->db->insert($this->prefix.'workflow_segment',$segment);
		if($affected_rows>0){
			$result=$this->db->lastInsertId($this->prefix.'workflow_segment');
			return $result;
		}
		return 0;
	}
	
	/**
	 * 修改环节
	 * @param unknown $set
	 * @param unknown $where
	 * @return unknown
	 */
	public function modifySegment($set,$where){
		$affected_rows=$this->db->update($this->prefix.'workflow_segment',$set,$where);
		return $affected_rows;
	}
	/**
	 * 查询（包含无效）环节
	 * @param string $invalid
	 * @return unknown
	 */
	public function querySegmentList($invalid=0){
		$query="select a.segmentID,a.segmentName,a.milestone,a.currentEntity,".
				" b.statusCNName currentStatus,a.detailUrlPattern,a.validStatus,".
				" a.prevID,a.prevName,a.nextID,a.nextName".
				" from ".$this->prefix."workflow_segment a,".$this->prefix."status b".
				" where a.currentEntity=b.entityName and a.currentStatus=b.statusENName";
		if($invalid == 1)
			$query=$query." and a.validStatus!='N'";
		$results=$this->db->query($query)->fetchAll();
		return $results;
	}
	/**
	 * 查询所有环节的快照
	 * @param number $invalid
	 * @return unknown
	 */
	public function querySegmentListSnap(){
		$query="select segmentID,segmentName,currentEntity from ".$this->prefix."workflow_segment where validStatus='Y'";
		$results=$this->db->query($query)->fetchAll();
		return $results;
	}
	/**
	 * 查询前一环节
	 * @param unknown $id
	 * @return unknown
	 */	
	public function queryPrevSegment($id,$fields=array('segmentID')){
		$glued_fields=implode(',', $fields);	//字段片段
		$query="";
		$result=$this->db->query($query,$id)->fetch();
		return $result;
	}
	/**
	 * 查询后一环节
	 * @param unknown $id
	 * @return unknown
	 */
	public function queryNextSegment($id,$fields=array('segmentID')){
		$glued_fields=implode(',', $fields);	//字段片段
		$query="";
		$result=$this->db->query($query,$id)->fetch();
		return $result;
	}
	/**
	 * 高级查询环节
	 * 只返回单条记录
	 * @param unknown $fields
	 * @param unknown $condition
	 * @param unknown $params
	 * @return unknown
	 */
	public function advancedQuerySegmentDetail($fields,$condition,$params){
		$glued_fields=implode(',', $fields);	//字段片段
		$query="select $glued_fields from ".$this->prefix."workflow_segment where $condition";
		$result = $this->db->query ( $query, $params )->fetch ();
		return $result;
	}

	
	
	//////////////////审核人管理//////////////////
	/**
	 * 添加审核人
	 * @param unknown $user
	 * @return unknown
	 */
	public function addReviewer($user){
		$affected_rows=$this->db->insert($this->prefix.'workflow_reviewer',$user);
		return $affected_rows;
	}
	/**
	 * 修改审核人
	 * @param unknown $set
	 * @param unknown $where
	 * @return unknown
	 */
	public function modifyReviewer($set,$where){
		$affected_rows=$this->db->update($this->prefix.'workflow_reviewer',$set,$where);
		return $affected_rows;
	}
	
	//////////////////申请管理//////////////////
	/**
	 * 添加申请
	 * @param unknown $app
	 * @return unknown
	 */
	public function addApplication($app){
		$affected_rows=$this->db->insert($this->prefix.'workflow_application',$app);
		return $affected_rows;
	}
	/**
	 * 修改申请
	 * @param unknown $set
	 * @param unknown $where
	 * @return unknown
	 */
	public function modifyApplication($set,$where){
		$affected_rows=$this->db->update($this->prefix.'workflow_application',$set,$where);
		return $affected_rows;
	}
	
	//////////////////流程管理//////////////////
	public function addApplicationReview($data){
		
	}
}

?>