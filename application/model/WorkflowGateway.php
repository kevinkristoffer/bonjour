<?php
/**
 * 工作流
 * @author hujianhong05
 *
 */

class Bonjour_Core_Model_WorkflowGateway extends Bonjour_Core_Model_GateWay{
	
	//////////////////模板管理//////////////////
	/**
	 * 新建模板
	 * @param unknown $template
	 * @return unknown
	 */
	public function addTemplate($template){
		$affected_rows=$this->db->insert($this->prefix.'workflow_template',$template);
		return $affected_rows;
	}
	/**
	 * 修改模板
	 * @param unknown $set
	 * @param unknown $where
	 * @return unknown
	 */
	public function modifyTemplate($set,$where){
		$affected_rows=$this->db->update($this->prefix.'workflow_template',$set,$where);
		return $affected_rows;
	}
	
	public function queryTemplateChain(){
		
	}
	
	public function queryTemplateDetail(){
		
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