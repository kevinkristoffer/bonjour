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
	public function modifyTeamAction() {
		if ($this->_request->isPost ()) {
			$this->_helper->viewRenderer->setNoRender ( true );
			header ( 'content-type:text/html;charset=utf-8' );
			try {
				if (! isset ( $_SERVER ['HTTP_X_REQUESTED_WITH'] ) || strtolower ( $_SERVER ['HTTP_X_REQUESTED_WITH'] ) != 'xmlhttprequest') {
					throw new Exception ();
				}
				
				/*
				 * p0:teamID,p1:teamName,p2:description,p3:responsible,p4:validStatus
				 */
				
				$params = $this->_request->getParams ();
				if (! array_key_exists ( 'p0', $params ) || ! preg_match ( '/^(\d+)$/', $params ['p0'] ))
					throw new Exception ();
				if (! array_key_exists ( 'p1', $params ) || $params ['p1'] == '')
					throw new Exception ();
				if (! array_key_exists ( 'p2', $params ))
					throw new Exception ();
				if (! array_key_exists ( 'p3', $params ))
					throw new Exception ();
				if (! array_key_exists ( 'p4', $params ) || ! preg_match ( '/^[0-1]{1}$/', $params ['p4'] ))
					throw new Exception ();
				
				$factory = Bonjour_Core_Model_Factory::getInstance ();
				$db = Bonjour_Core_Db_Connection::getConnection ( 'master' );
				if ($db == null) {
					throw new Exception ();
				}
				$factory->setDbAdapter ( $db );
				$factory->registGateway ( 'Team' );
				
				// 负责人字段
				$responsibleID = null;
				$responsibleName = null;
				if (preg_match ( '/\|/', $params ['p3'] )) {
					$responsible_array = explode ( '|', $params ['p3'] );
					$responsibleID = $responsible_array [0];
					$responsibleName = $responsible_array [1];
				}
				// 团队编号为空则新建团队否则修改团队
				if ($params ['p0'] == 0) {
					$authNamespace = new Zend_Session_Namespace ( 'Bonjour_Auth' );
					$creatorID = $authNamespace->currentUser->userID;
					$creatorName = $authNamespace->currentUser->userName;
					$team = array (
							'teamName' => $params ['p1'],
							'description' => $params ['p2'],
							'responsibleID' => $responsibleID,
							'responsibleName' => $responsibleName,
							'creatorID' => $creatorID,
							'creatorName' => $creatorName,
							'createTime' => new Zend_Db_Expr ( 'now()' ),
							'validStatus' => $params ['p4'] 
					);
					$affected_rows = $factory->__gateway ( 'Team' )->addTeam ( $team );
					if ($affected_rows != 1)
						throw new Exception ();
				} else {
					$set = array (
							'teamName' => $params ['p1'],
							'description' => $params ['p2'],
							'responsibleID' => $responsibleID,
							'responsibleName' => $responsibleName,
							'validStatus' => $params ['p4'] 
					);
					$where ['teamID=?'] = $params ['p0'];
					$factory->__gateway ( 'Team' )->modifyTeam ( $set, $where );
				}
				
				echo Bonjour_Core_GlobalConstant::BONJOUR_SUCCESS;
			} catch ( Exception $e ) {
				echo $e->getMessage ();
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
	/**
	 * 添加成员
	 */
	public function addMemberAction() {
		if ($this->_request->isPost ()) {
			$this->_helper->viewRenderer->setNoRender ( true );
			header ( 'content-type:text/html;charset=utf-8' );
			try {
				if (! isset ( $_SERVER ['HTTP_X_REQUESTED_WITH'] ) || strtolower ( $_SERVER ['HTTP_X_REQUESTED_WITH'] ) != 'xmlhttprequest') {
					throw new Exception ();
				}
				
				/*
				 * p1:teamID,p2:userID,p3:userName,p4:roleDesc
				 */
				
				$params = $this->_request->getParams ();
				if (! array_key_exists ( 'p1', $params ) || ! preg_match ( '/^(\d+)$/', $params ['p1'] ))
					throw new Exception ();
				if (! array_key_exists ( 'p2', $params ) || ! preg_match ( '/^(\d+)$/', $params ['p2'] ))
					throw new Exception ();
				if (! array_key_exists ( 'p3', $params ) || $params ['p3'] == '')
					throw new Exception ();
				if (! array_key_exists ( 'p4', $params ))
					throw new Exception ();
				
				$factory = Bonjour_Core_Model_Factory::getInstance ();
				$db = Bonjour_Core_Db_Connection::getConnection ( 'master' );
				if ($db == null) {
					throw new Exception ();
				}
				$factory->setDbAdapter ( $db );
				$factory->registGateway ( 'Team' );
				
				$data = array (
						'teamID' => $params ['p1'],
						'userID' => $params ['p2'],
						'userName' => $params ['p3'],
						'roleDesc' => $params ['p4'],
						'createTime' => new Zend_Db_Expr ( 'now()' ) 
				);
				$affected_rows = $factory->__gateway ( 'Team' )->addTeamMember ( $data );
				if ($affected_rows != 1)
					throw new Exception ();
				
				echo Bonjour_Core_GlobalConstant::BONJOUR_SUCCESS;
			} catch ( Exception $e ) {
				//echo $e->getMessage ();
				echo Bonjour_Core_GlobalConstant::BONJOUR_ERROR;
			}
		}
	}
	/**
	 * 批量移除成员
	 */
	public function removeMemberAction(){
		if ($this->_request->isPost ()) {
			$this->_helper->viewRenderer->setNoRender ( true );
			header ( 'content-type:text/html;charset=utf-8' );
			try {
				if (! isset ( $_SERVER ['HTTP_X_REQUESTED_WITH'] ) || strtolower ( $_SERVER ['HTTP_X_REQUESTED_WITH'] ) != 'xmlhttprequest') {
					throw new Exception ();
				}
				
				$params=$this->_request->getParams();
				if(!array_key_exists('tid', $params) || !preg_match('/^(\d+)$/', $params['tid'])) throw new Exception();
				if(!array_key_exists('uids', $params) || !preg_match('/^(\d+\,){0,}(\d+)$/', $params['uids'])) throw new Exception();
		
				$factory = Bonjour_Core_Model_Factory::getInstance ();
				$db = Bonjour_Core_Db_Connection::getConnection ( 'master' );
				if ($db == null) {
					throw new Exception ();
				}
				$factory->setDbAdapter ( $db );
				$factory->registGateway ( 'Team' );
				
				$uids=explode(',', $params['uids']);
				$affected_rows = $factory->__gateway ( 'Team' )->removeTeamMember ( $params['tid'],$uids);
				if ($affected_rows == 0)
					throw new Exception ();
		
				echo Bonjour_Core_GlobalConstant::BONJOUR_SUCCESS;
			} catch ( Exception $e ) {
				echo $e->getMessage ();
				echo Bonjour_Core_GlobalConstant::BONJOUR_ERROR;
			}
		}
	}
	/**
	 * 查询团队全部成员
	 * @throws Exception
	 */
	public function queryMemberListAction(){
		if ($this->_request->isPost ()) {
			$this->_helper->viewRenderer->setNoRender ( true );
			header ( 'content-type:text/html;charset=utf-8' );
			try {
				if (! isset ( $_SERVER ['HTTP_X_REQUESTED_WITH'] ) || strtolower ( $_SERVER ['HTTP_X_REQUESTED_WITH'] ) != 'xmlhttprequest') {
					throw new Exception ();
				}
				
				$params=$this->_request->getParams();
				
				if(!array_key_exists('tid', $params) || !preg_match('/^(\d+)$/',$params['tid'])) throw new Exception();
				
				$factory = Bonjour_Core_Model_Factory::getInstance ();
				$db = Bonjour_Core_Db_Connection::getConnection ( 'slave' );
				if ($db == null) {
					throw new Exception ();
				}
				$factory->setDbAdapter ( $db );
				$factory->registGateway ( 'Team' );
				
				$rows = $factory->__gateway ( 'Team' )->queryTeamMember ( $params['tid'] );
				$total = count($rows);
				$callback = array (
						'Rows' => $rows,
						'Total' => $total
				);
		
				echo Zend_Json::encode ( $callback );
			} catch ( Exception $e ) {
				//echo $e->getMessage ();
				echo Bonjour_Core_GlobalConstant::BONJOUR_ERROR;
			}
		}
	}
	/**
	 * 分页查询全部有效用户
	 */
	public function queryValidUserAction() {
		if ($this->_request->isPost ()) {
			$this->_helper->viewRenderer->setNoRender ( true );
			header ( 'content-type:text/html;charset=utf-8' );
			try {
				if (! isset ( $_SERVER ['HTTP_X_REQUESTED_WITH'] ) || strtolower ( $_SERVER ['HTTP_X_REQUESTED_WITH'] ) != 'xmlhttprequest') {
					throw new Exception ();
				}
				// 验证参数
				$teamID = $this->_request->getParam ( 'tid' );
				if (! isset ( $teamID ) || ! preg_match ( '/^(\d+)$/', $teamID ))
					throw new Exception ();
				$page = $this->_request->getParam ( 'page' );
				$pagesize = $this->_request->getParam ( 'pagesize' );
				$condition = $this->_request->getParam ( 'condition' ); // 搜索表单参数
				if (! isset ( $page ) || ! isset ( $pagesize ) || ! preg_match ( '/^(\d+)$/', $page ) || ! preg_match ( '/^(\d+)$/', $pagesize )) {
					throw new Exception ();
				}
				// 提取关键字
				$keyword = null;
				if (isset ( $condition )) {
					$jsonObj = Zend_Json::decode ( $condition );
					if ($jsonObj != null)
						$keyword = $jsonObj [0] ['value'];
				}
				$factory = Bonjour_Core_Model_Factory::getInstance ();
				$db = Bonjour_Core_Db_Connection::getConnection ( 'slave' );
				if ($db == null) {
					throw new Exception ();
				}
				$factory->setDbAdapter ( $db );
				$factory->registGateway ( 'Team' );
				// 查询
				$total = $factory->__gateway ( 'Team' )->countValidUser ( $teamID, $keyword );
				$rows = $factory->__gateway ( 'Team' )->queryValidUser ( $pagesize * ($page - 1), $pagesize, $teamID, $keyword );
				$callback = array (
						'Rows' => $rows,
						'Total' => $total 
				);
				
				echo Zend_Json::encode ( $callback );
			} catch ( Exception $e ) {
				echo $e->getMessage();
				echo Bonjour_Core_GlobalConstant::BONJOUR_ERROR;
			}
		}
	}
}

?>