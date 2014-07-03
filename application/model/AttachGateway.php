<?php

class Bonjour_Model_AttachGateway extends Bonjour_Core_Model_GateWay{
	
	// /////////////////////////////// 变更操作 /////////////////////////////////
	/**
	 * 添加附件
	 * @param unknown $attach
	 * @return unknown
	 */
	public function addAttach($attach){
		$affected_rows = $this->db->insert ( $this->prefix . 'attachment', $attach );
		return $affected_rows;
	}
	/**
	 * 根据附件ID批量删除附件
	 * @param unknown $ids
	 * @return unknown
	 */
	public function removeAttach($ids){
		$in=array();
		for($i=0;$i<count($ids);$i++)
			array_push($in, '?');
		$in=implode(',', $in);
		$where['attachmentID in ('.$in.')']=$ids;
		$affected_rows = $this->db->delete($this->prefix . 'attachment',$where);
		return $affected_rows;
	}
	/**
	 * 自增下载次数
	 * @param unknown $attachmentID
	 * @return unknown
	 */
	public function increaseDownloadTimes($attachmentID){
		$query="update bonjour_attachment set downloadTimes=downloadTimes+1 where attachmentID=?";
		$affected_rows=$this->db->query($query,$attachmentID)->rowCount();
		return $affected_rows;
	}
	
	// /////////////////////////////// 查询操作 /////////////////////////////////
	/**
	 * 根据模块编码查询附件列表
	 * @param unknown $moduleName
	 * @param unknown $moduleCode
	 * @return unknown
	 */
	public function queryAttachByCode($moduleName,$moduleCode){
		$query="select attachmentID,fileName,fileSize from " . $this->prefix . "attachment".
				" where moduleName=? and moduleCode=?";
		$results=$this->db->query($query,array($moduleName,$moduleCode))->fetchAll();
		return $results;
	}
	/**
	 * 根据模块编号查询附件列表
	 * @param unknown $moduleName
	 * @param unknown $moduleID
	 * @return unknown
	 */
	public function queryAttachByID($moduleName,$moduleID){
		$query="select attachmentID,fileName,fileSize,downloadTimes,createTime from " . $this->prefix . "attachment".
				" where moduleName=? and moduleID=?";
		$results=$this->db->query($query,array($moduleName,$moduleID))->fetchAll();
		return $results;
	}
	/**
	 * 根据ID查询附件详情，用于下载
	 * @param unknown $attachmentID
	 * @return unknown
	 */
	public function queryAttachDetail($attachmentID){
		$query="select downloadUrl,realPath,fileName,fileSize from bonjour_attachment where attachmentID=?";
		$result=$this->db->query($query,$attachmentID)->fetch();
		return $result;
	}
}

?>