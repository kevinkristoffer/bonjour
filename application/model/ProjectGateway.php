<?php
/**
 * 项目
 * @author hujianhong05
 *
 */
class Bonjour_Model_ProjectGateway extends Bonjour_Core_Model_GateWay {
	
	// /////////////////////////////// 变更操作 /////////////////////////////////
	/**
	 * 添加项目
	 * @param unknown $project        	
	 * @return integer
	 */
	public function addProject($project) {
		$affected_rows = $this->db->insert ( $this->prefix . 'project_main', $project );
		return $affected_rows;
	}
	
	/**
	 * 修改项目
	 * @param unknown $project        	
	 * @return number
	 */
	public function modifyProject($set,$where) {
		$affected_rows = $this->db->update ( $this->prefix . 'project_main', $set ,$where );
		return $affected_rows;
	}
	
	/**
	 * 移除项目
	 * 只能删除解锁并取消关闭的项目
	 * @param unknown $projectCode        	
	 * @return number
	 */
	public function removeProject($projectCode) {
		return 0;
	}
	
	/**
	 * 锁定项目
	 * @param unknown $projectCode        	
	 * @return number
	 */
	public function modifyProjectLockedStatus($projectCode) {
		$query="update " . $this->prefix . "project_main set lockedStatus=1-lockedStatus*lockedStatus where projectCode=?";
		$affected_rows=$this->db->query($query,$projectCode)->rowCount();
		return $affected_rows;
	}
	
	// /////////////////////////////// 查询操作 /////////////////////////////////
	/**
	 * 查询正常的根项目快照
	 * @param unknown $offset
	 * @param unknown $limit
	 * @return array
	 */
	public function countRootProjectSnapshot(){
		$query="select count(*) cnt from ".$this->prefix."project_main".
				" where nodeType='R' and flag1!=".Bonjour_Core_GlobalConstant::PROJECT_CANCELED;
		$result=$this->db->query($query)->fetch();
		return $result->cnt;
	}
	public function queryRootProjectSnapshot($offset,$limit) {
		$query=" select a.projectCode,a.projectName,creatorName,createDate,count(b.projectCode) pCnt from (".
				" select projectCode,projectName,creatorName,createDate from ".$this->prefix."project_main".
				" where nodeType='R' and flag1!=".Bonjour_Core_GlobalConstant::PROJECT_CANCELED.
				" ) a left join ( ".
				" select projectCode,parentNode from " . $this->prefix . "project_main".
				" where nodeType='P' and flag1!=".Bonjour_Core_GlobalConstant::PROJECT_CANCELED.
				" ) b on (a.projectCode=b.parentNode)".
				" group by 1,2,3,4 limit $offset,$limit";
		$results=$this->db->query($query)->fetchAll();
		return $results;
	}
	/**
	 * 查询根项目列表
	 * @param string $on        	
	 * @return Array
	 */
	public function countRootProject($condition=''){
		$query =" select count(*) cnt from " . $this->prefix . "project_main where nodeType='R' ".$condition;
		$result = $this->db->query ( $query )->fetch ();
		return $result->cnt;
	}
	public function queryRootProject($offset,$limit,$condition='') {
		$query ="select a.projectCode,a.projectName,a.createDate,a.creatorName,a.responsibleName,a.flag1,b.statusCNName currentStatus".
				" from ".$this->prefix."project_main a,".$this->prefix."status b".
				" where a.flag1=b.statusValue and b.entityName='PROJECT' and a.nodeType='R' ".$condition.
				" order by createDate desc limit $offset,$limit";
		$results = $this->db->query ( $query )->fetchAll ();
		return $results;
	}
	/**
	 * 生成项目主键
	 * @param unknown $nodeType
	 * @return string
	 */
	public function generateProjectCode($nodeType){
		$ym = date ( 'Ym' );
		$maxCode = 1;
		$query = "select max(substr(projectCode,8,5)) maxCode from ".$this->prefix."project_main where substr(projectCode,1,7)=?";
		$result = $this->db->query ( $query, $nodeType . $ym )->fetch ();
		if ($result->maxCode != null) {
			$maxCode = intval ( $result->maxCode ) + 1;
		}
		$maxCode = sprintf ( '%05d', $maxCode ); // 编码补零
		$projectCode=$nodeType . $ym . $maxCode;
		return $projectCode;
	}
	/**
	 * 根据编号查询项目节点信息
	 * @param unknown $projectCode
	 * @return unknown
	 */
	public function queryProjectNode($projectCode){
		$query="select projectCode,projectName,parentNode from ".$this->prefix."project_main where projectCode=?";
		$result=$this->db->query($query,$projectCode)->fetch();
		return $result;
	}
	/**
	 * 通过根节点查询项目，构建项目树
	 * @param unknown $parentNode
	 * @return unknown
	 */
	public function queryProjectByRootNode($rootNode,$include_root=false){
		$query="select projectCode,projectName,parentNode,rootNode,creatorName,responsibleName,createDate,
				lockedStatus,flag1,statusCNName currentStatus from ".$this->prefix."project_main a,".$this->prefix."status b
				where a.flag1=b.statusValue and b.entityName='PROJECT' and b.statusValue!=3 and a.rootNode=?";
		if(!$include_root)
			$query=$query." and nodeType!='R'";
		$results=$this->db->query($query,$rootNode)->fetchAll();
		return $results;
	}
	/**
	 * 查询父节点
	 * @param unknown $projectCode
	 * @return unknown
	 */
	public function queryParentNode($projectCode){
		$query="select b.projectCode,b.projectName from " . $this->prefix . "project_main a," . $this->prefix . "project_main b ".
				"where a.parentNode=b.projectCode and a.projectCode=?";
		$result=$this->db->query($query,$projectCode)->fetch();
		return $result;
	}
	
	/**
	 * 查询项目节点类型
	 * @param unknown $projectCode        	
	 * @return Ambigous <NULL, unknown>
	 */
	public function queryNodeType($projectCode) {
		$query = "select nodeType from " . $this->prefix . "project_main where projectCode=?";
		$result = $this->db->query ( $query, $projectCode )->fetch ();
		return $result == null ? null : $result ['nodeType'];
	}
	
	/**
	 * 检验项目是否存在
	 * @param unknown $projectCode
	 * @return boolean
	 */
	public function checkExistedProject($projectCode){
		$query = "select projectCode from " . $this->prefix . "project_main where projectCode=?";
		$result = $this->db->query ( $query, $projectCode )->fetch ();
		return $result == null ? false : true;
	}
	/**
	 * 查询项目详情
	 * @param unknown $projectCode
	 * @param string $condition	特殊条件
	 * @return unknown
	 */
	public function queryProjectDetail($projectCode,$condition='') {
		$query = "select projectCode,projectName,nodeCodeRoute,nodeNameRoute,createDate,estimateStartDate,".
				"estimateDuration,realStartDate,creatorName,responsibleID,responsibleName,description,lockedStatus,".
				"flag1,moduleName,b.statusCNName currentStatus from ".$this->prefix."project_main a,".$this->prefix."status b".
				" where a.flag1=b.statusValue and b.entityName='PROJECT' and projectCode=? $condition";
		$result = $this->db->query ( $query, $projectCode )->fetch ();
		return $result;
	}
	/**
	 * 项目详情高级查询，可自定义字段和条件，只允许返回一条数据
	 * @param array $fields
	 * @param unknown $where
	 * @param unknown $params
	 * @return unknown
	 */
	public function advancedQueryProjectDetail($fields,$condition,$params){
		$glued_fields=implode(',', $fields);	//字段片段
		$query="select $glued_fields from " . $this->prefix . "project_main where $condition";
		$result = $this->db->query ( $query, $params )->fetch ();
		return $result;
	}
	
	/**
	 * 查询某个状态下的子节点个数，用在关闭、撤销操作前检验
	 * @param unknown $parentNode
	 * @param unknown $statusName
	 * @param unknown $operator
	 * @param string $condition
	 */
	public function countChildNodeByStatus($parentNode,$statusName,$operator,$condition=''){
		$query="select count(*) cnt from ".$this->prefix."project_main where parentNode=? ".
			   " and flag1".$operator."(select statusValue from ".$this->prefix."status where statusENName=?) ".$condition;
		$result=$this->db->query($query,array($parentNode,$statusName))->fetch();
		return $result->cnt;
	}
	/**
	 * 查询父类项目的当前状态
	 * @param unknown $projectCode
	 */
	public function queryParentNodeStatus($projectCode){
		$query="select flag1 currentStatus from ".$this->prefix."project_main a".
				" where a.projectCode=(".
				" select parentNode from ".$this->prefix."project_main b".
				" where b.projectCode=?)";
		$result=$this->db->query($query,$projectCode)->fetch();
		return $result->currentStatus;
	}
}

?>