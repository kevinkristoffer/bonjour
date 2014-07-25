<?php

class Project_TeamController extends Bonjour_Controller_Base{
	
	/**
	 * Constructor
	 *
	 * @see Bonjour_Controller_Base::init()
	 */
	public function init() {
		parent::init (); // 初始化session
	}
	/**
	 * 管理首页
	 */
	public function indexAction(){
		
	}
	/**
	 * 新建/修改团队
	 * @throws Exception
	 */
	public function modifyTeamAction(){
	if ($this->_request->isPost ()) {
			$this->_helper->viewRenderer->setNoRender ( true );
			header ( 'content-type:text/html;charset=utf-8' );
			try {
				if (! isset ( $_SERVER ['HTTP_X_REQUESTED_WITH'] ) || strtolower ( $_SERVER ['HTTP_X_REQUESTED_WITH'] ) != 'xmlhttprequest') {
					throw new Exception ();
				}
				/*
				 * p0:roleID p1:roleName p2:validStatus p3:remark
				 */
				
				$params = $this->_request->getParams ();
				if (! array_key_exists ( 'p0', $params ) || !preg_match('/^(\d+)$/',$params['p0']))
					throw new Exception ();
				if (! array_key_exists ( 'p1', $params ) || $params ['p1'] == '')
					throw new Exception ();
				if (! array_key_exists ( 'p2', $params ) || ! preg_match ( '/^(\d+)$/', $params ['p2'] ))
					throw new Exception ();
				if (! array_key_exists ( 'p3', $params ))
					throw new Exception ();
				
				$factory = Bonjour_Core_Model_Factory::getInstance ();
				$db = Bonjour_Core_Db_Connection::getConnection ( 'slave' );
				if ($db == null) {
					throw new Exception ();
				}
				$factory->setDbAdapter ( $db );
				$factory->registGateway ( 'User' );
				
				// 角色编号为空则新建角色否则修改角色
				if ($params ['p0'] == 0) {
					$authNamespace = new Zend_Session_Namespace ( 'Bonjour_Auth' );
					$creatorID = $authNamespace->currentUser->userID;
					$creatorName = $authNamespace->currentUser->userName;
					$role = array (
							'roleName' => $params ['p1'],
							'createDate' => date ( 'Ymd' ),
							'creatorID' => $creatorID,
							'creatorName' => $creatorName,
							'validStatus' => $params ['p2'],
							'remark' => $params ['p3'] 
					);
					$affected_rows = $factory->__gateway ( 'User' )->addRole ( $role );
					if ($affected_rows != 1)
						throw new Exception ();
				} else {
					$set = array (
							'roleName' => $params ['p1'],
							'validStatus' => $params ['p2'],
							'remark' => $params ['p3'] 
					);
					$where ['roleID=?'] = $params ['p0'];
					$factory->__gateway ( 'User' )->modifyRole ( $set, $where );
				}
				
				echo Bonjour_Core_GlobalConstant::BONJOUR_SUCCESS;
			} catch ( Exception $e ) {
				//echo $e->getMessage ();
				echo Bonjour_Core_GlobalConstant::BONJOUR_ERROR;
			}
		}
	}
	/**
	 * 查询团队列表
	 */
	public function queryTeamListAction() {
		if ($this->_request->isPost ()) {
			$this->_helper->viewRenderer->setNoRender ( true );
			header ( 'content-type:text/html;charset=utf-8' );
			try {
				if (! isset ( $_SERVER ['HTTP_X_REQUESTED_WITH'] ) || strtolower ( $_SERVER ['HTTP_X_REQUESTED_WITH'] ) != 'xmlhttprequest') {
					throw new Exception ();
				}
				
				$page = $this->_request->getParam ( 'page' );
				$pagesize = $this->_request->getParam ( 'pagesize' );
				if (! isset ( $page ) || ! isset ( $pagesize ) || ! preg_match ( '/^(\d+)$/', $page ) || ! preg_match ( '/^(\d+)$/', $pagesize )) {
					throw new Exception ();
				}
				$factory = Bonjour_Core_Model_Factory::getInstance ();
				$db = Bonjour_Core_Db_Connection::getConnection ( 'slave' );
				if ($db == null) {
					throw new Exception ();
				}
				$factory->setDbAdapter ( $db );
				$factory->registGateway ( 'Team' );
				
				$total = $factory->__gateway ( 'Team' )->countTeamList ();
				$rows = $factory->__gateway ( 'Team' )->queryTeamList ( $pagesize * ($page - 1), $pagesize );
				$callback = array (
						'Rows' => $rows,
						'Total' => $total 
				);
				
				echo Zend_Json::encode ( $callback );
			} catch ( Exception $e ) {
				echo $e->getMessage ();
				echo Bonjour_Core_GlobalConstant::BONJOUR_ERROR;
			}
		}
	}
	
	public function addMemberAction(){
		
	}
	
	public function removeMemberAction(){
		
	}
}

?>