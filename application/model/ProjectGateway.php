<?php
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
	public function modifyProject($project) {
		$affected_rows = $this->db->update ( $this->prefix . 'project_main', $project, 'ProjectCode=' . $project ['ProjectCode'] );
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
	public function lockProject($projectCode) {
		return 0;
	}
	
	/**
	 * 解锁项目
	 * @param unknown $projectCode        	
	 * @return number
	 */
	public function unlockProject($ProjectCode) {
		return 0;
	}
	
	// /////////////////////////////// 查询操作 /////////////////////////////////
	/**
	 * 计数正常的根项目快照
	 */
	public function countRootProjectSnapshot(){
		$query="select count(*) cnt from bonjour_project_main".
				" where nodeType='R' and substring(flag,1,1)!='3'";
		$result=$this->db->query($query)->fetch();
		return $result->cnt;
	}
	/**
	 * 查询正常的根项目快照
	 * @param unknown $offset
	 * @param unknown $limit
	 * @return array
	 */
	public function queryRootProjectSnapshot($offset,$limit) {
		$query=" select a.projectCode,a.projectName,creatorName,createDate,count(b.projectCode) pCnt from (".
				" select projectCode,projectName,creatorName,createDate from " . $this->prefix . "project_main".
				" where nodeType='R' and substring(flag,1,1)!='3'".
				" ) a left join ( ".
				" select projectCode,parentNode from " . $this->prefix . "project_main".
				" where nodeType='P' and substring(flag,1,1)!='3'".
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
	public function queryRootProject($on = true) {
		$query = "select projectCode,projectName,createDate,createName,lockedStatus".
		" from " . $this->prefix . "project_main where nodeType='R'";
		if ($on) {
			$query = $query . " and substring(flag,1,1)='0' order by createDate desc";
		} else {
			$query = $query . " order by createDate desc";
		}
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
		$query = "select max(substr(projectCode,8,5)) maxCode from " . $this->prefix . "project_main where substr(projectCode,1,7)=?";
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
		$query="select projectCode,projectName,parentNode from " . $this->prefix . "project_main where projectCode=?";
		$result=$this->db->query($query,$projectCode)->fetch();
		return $result;
	}
	/**
	 * 通过根节点查询项目，构建项目树
	 * @param unknown $parentNode
	 * @return unknown
	 */
	public function queryProjectByRootNode($rootNode,$include_root=false){
		$query="select projectCode,projectName,parentNode,rootNode,creatorName,responsibleName,createDate,".
				"case when substring(flag,1,1)='0' then '初始值' when substring(flag,1,1)='1' then '正常开启'".
				" when substring(flag,1,1)='2' then '正常关闭' end currentStatus".
				" from " . $this->prefix . "project_main where substring(flag,1,1)!='3' and rootNode=?";
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
		$query="select b.projectCode,b.projectName from " . $this->prefix . "project_main a,bonjour_project_main b ".
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
	
	public function queryProjectDetail($ProjectCode) {
		$query = "select * from " . $this->prefix . "project_main where ProjectCode=?";
	}
	public function searchProject() {
	}
}

?>