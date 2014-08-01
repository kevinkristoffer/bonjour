<?php
/**
 * 权限控制
 * 
 * @author Administrator
 *
 */
class Bonjour_Model_PrivilegeGateway extends Bonjour_Core_Model_GateWay{
	
	/**
	 * 权限管理设计思路
	 * 板块权限管理
	 * 在权限主表中的accessName='Forum',accessID='ForumID'
	 * 版块权限管理有两种模式（操作权限管理也是类似）
	 * 1、版块模式：点击某个版块能看到这个版块下的全部访问主体[user,role,team]，只能移除权限操作
	 * 2、主体模式：能根据主体标示[userID,roleID,teamID]分类[group]生成主体列表，
	 * 选择某个主体，选择“菜单”下拉框，能级联生成版块树，通过点选重新分配权限
	 */
	
	/**
	 * 新建权限（通用）
	 * @param unknown $data
	 * @return unknown
	 */
	public function addPrivilege($data){
		$affected_rows=$this->db->insert($this->prefix.'privilege_main',$data);
		return $affected_rows;
	}
	/**
	 * 移除权限（通用）
	 * @param unknown $where
	 * @return unknown
	 */
	public function removePrivilege($where){
		$affected_rows=$this->db->delete($this->prefix.'privilege_main',$where);
		return $affected_rows;
	}
	
	////////////////////////////版块权限管理////////////////////////////
	/**
	 * 查询有效版块下的全部可访问的有效主体
	 * @return unknown
	 */
	public function queryForumAccessMaster(){
		$query1="create temporary table if not exists tmp_forum engine=memory".
				" select forumID from ".$this->prefix."forum where validStatus=1 union select 0 forumID";
		$query2="select distinct a.masterType,a.masterKey,a.masterValue,b.userName masterName".
				" from ".$this->prefix."privilege_main a,".$this->prefix."user b,tmp_forum c".
				" where a.masterType='User' and a.masterKey='userID' and a.accessName='Forum'".
				" and a.accessKey='forumID' and a.operation='ACCESS'".
				" and a.masterValue=b.userID and a.accessIDValue=c.forumID and b.validStatus=1".
				" union".
				" select distinct a.masterType,a.masterKey,a.masterValue,b.roleName masterName".
				" from ".$this->prefix."privilege_main a,".$this->prefix."role b,tmp_forum c".
				" where a.masterType='Role' and a.masterKey='roleID' and a.accessName='Forum'".
				" and a.accessKey='forumID' and a.operation='ACCESS' ".
				" and a.masterValue=b.roleID and a.accessIDValue=c.forumID and b.validStatus=1".
				" union".
				" select distinct a.masterType,a.masterKey,a.masterValue,b.teamName masterName".
				" from ".$this->prefix."privilege_main a,".$this->prefix."team b,tmp_forum c".
				" where a.masterType='Role' and a.masterKey='teamID' and a.accessName='Forum'".
				" and a.operation='ACCESS' and a.masterValue=b.teamID ".
				" and a.masterValue=b.roleID and a.accessIDValue=c.forumID and b.validStatus=1";
		$query3="drop temporary table if exists tmp_forum";
		$this->db->query($query1);
		$results=$this->db->query($query2)->fetchAll();
		$this->db->query($query3);
		return $results;
	}
	/**
	 * 查询某个主体下的全部有效版块
	 * @param unknown $masterType
	 * @param unknown $masterKey
	 * @param unknown $masterValue
	 * @param unknown $menuID
	 * @return unknown
	 */
	public function queryForumByMaster($masterType,$masterKey,$masterValue,$menuID){
		$query="select a.forumID,a.parentID,a.forumName,".
				" case when b.forumID is not null then 1 else 0 end ischecked".
				" from ".$this->prefix."forum a".
				" left join".
				" (select accessIDValue forumID from ".$this->prefix."privilege_main".
				" where masterType=? and masterKey=? and masterValue=?".
				" and accessName='Forum' and accessKey='forumID' and operation='ACCESS') b".
				" on (a.forumID=b.forumID)".
				" where a.menuID=?";
		$results=$this->db->query($query,array($masterType,$masterKey,$masterValue,$menuID))->fetchAll();
		return $results;
	}
	/**
	 * 查询某个有效版块下的全部可访问的有效主体
	 * @param unknown $forumID
	 * @return unknown
	 */
	public function queryForumAccessMasterByForumID($forumID){
		$query="select distinct a.masterType,a.masterKey,a.masterValue,b.userName masterName".
				" from ".$this->prefix."privilege_main a,".$this->prefix."user b".
				" where a.masterType='User' and a.masterKey='userID' and a.accessName='Forum'".
				" and a.operation='ACCESS' and a.masterValue=b.userID and forumID=?".
				" and a.validStatus=1 and b.validStatus=1".
				" union".
				" select distinct a.masterType,a.masterKey,a.masterValue,b.roleName masterName".
				" from ".$this->prefix."privilege_main a,".$this->prefix."role b".
				" where a.masterType='Role' and a.masterKey='roleID' and a.accessName='Forum'".
				" and a.operation='ACCESS' and a.masterValue=b.roleID and forumID=?".
				" and a.validStatus=1 and b.validStatus=1".
				" union".
				" select distinct a.masterType,a.masterKey,a.masterValue,b.teamName masterName".
				" from ".$this->prefix."privilege_main a,".$this->prefix."team b".
				" where a.masterType='Role' and a.masterKey='teamID' and a.accessName='Forum'".
				" and a.operation='ACCESS' and a.masterValue=b.teamID and forumID=?".
				" and a.validStatus=1 and b.validStatus=1";
		$results=$this->db->query($query,array($forumID,$forumID,$forumID))->fetchAll();
		return $results;
	}
}

?>