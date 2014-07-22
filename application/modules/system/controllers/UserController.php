<?php
class System_UserController extends Bonjour_Controller_Base {
	
	/**
	 * Constructor
	 *
	 * @see Bonjour_Controller_Base::init()
	 */
	public function init() {
		parent::init();
	}
	/**
	 * 用户管理首页
	 */
	public function indexAction() {
		try {
			$factory = Bonjour_Core_Model_Factory::getInstance ();
			$db = Bonjour_Core_Db_Connection::getConnection ( 'slave' );
			if ($db == null) {
				throw new Exception ();
			}
			$factory->setDbAdapter ( $db );
			$factory->registGateway ( 'User' );
			
			$roles = $factory->__gateway ( 'User' )->queryRoleSnapList ();
			$this->view->assign ( 'roles', Zend_Json::encode ( $roles ) );
		} catch ( Exception $e ) {
			echo Bonjour_Core_GlobalConstant::BONJOUR_ERROR;
			exit ();
		}
	}
	/**
	 * 新建用户
	 */
	public function addUserAction() {
		if ($this->_request->isPost ()) {
			$this->_helper->viewRenderer->setNoRender ( true );
			header ( 'content-type:text/html;charset=utf-8' );
			try {
				if (! isset ( $_SERVER ['HTTP_X_REQUESTED_WITH'] ) || strtolower ( $_SERVER ['HTTP_X_REQUESTED_WITH'] ) != 'xmlhttprequest') {
					throw new Exception ();
				}
				/*
				 * 参数对应 f1:accountName f2:userName f3:roleID f4:email f5:mobile f6:phoneNumber
				 */
				$params = $this->_request->getParams ();
				if (! array_key_exists ( 'f1', $params ) || ! array_key_exists ( 'f2', $params ) || 
				! array_key_exists ( 'f3', $params ) || ! array_key_exists ( 'f4', $params ) || 
				! array_key_exists ( 'f5', $params ) || ! array_key_exists ( 'f6', $params ) || 
				$params ['f1'] == '' || $params ['f2'] == '' || ! preg_match ( '/^(\d+)$/', $params ['f3'] ))
					throw new Exception ();
				
				$factory = Bonjour_Core_Model_Factory::getInstance ();
				$db = Bonjour_Core_Db_Connection::getConnection ( 'master' );
				if ($db == null) {
					throw new Exception ();
				}
				$factory->setDbAdapter ( $db );
				$factory->registGateway ( 'User' );
				
				$authNamespace = new Zend_Session_Namespace ( 'Bonjour_Auth' );
				$creatorID = $authNamespace->currentUser->userID;
				$creatorName = $authNamespace->currentUser->userName;
				
				$user=array('accountName'=>$params['f1'],'userName'=>$params['f2'],'userPass'=>md5('123456'),
				'roleID'=>$params['f3'],'email'=>$params['f4'],'mobile'=>$params['f5'],'phoneNumber'=>$params['f6'],
				'createDate'=>date('Ymd'),'creatorID'=>$creatorID,'creatorName'=>$creatorName);
				$affected_rows=$factory->__gateway ( 'User' )->addUser($user);
				if($affected_rows != 1) throw new Exception();
				
				echo Bonjour_Core_GlobalConstant::BONJOUR_SUCCESS;
			} catch ( Exception $e ) {
				echo $e->getMessage ();
				echo Bonjour_Core_GlobalConstant::BONJOUR_ERROR;
			}
		}
	}
	/**
	 * 修改用户信息
	 */
	public function modifyUserAction() {
		if ($this->_request->isPost ()) {
			$this->_helper->viewRenderer->setNoRender ( true );
			header ( 'content-type:text/html;charset=utf-8' );
			try {
				if (! isset ( $_SERVER ['HTTP_X_REQUESTED_WITH'] ) || strtolower ( $_SERVER ['HTTP_X_REQUESTED_WITH'] ) != 'xmlhttprequest') {
					throw new Exception ();
				}
				$userID = $this->_request->getParam ( 'p0' );
				$userName = $this->_request->getParam ( 'p1' );
				$roleID = $this->_request->getParam ( 'p2' );
				$email = $this->_request->getParam ( 'p3' );
				$mobile = $this->_request->getParam ( 'p4' );
				$phoneNumber = $this->_request->getParam ( 'p5' );
				$validStatus = $this->_request->getParam ( 'p6' );
				// 验证参数
				if (! isset ( $userID ) || ! preg_match ( '/^(\d+)$/', $userID ))
					throw new Exception ();
				if (! isset ( $userName ) || $userName == '')
					throw new Exception ();
				if (! isset ( $roleID ) || ! preg_match ( '/^(\d+)$/', $roleID ))
					throw new Exception ();
				if (! isset ( $validStatus ) || ! preg_match ( '/^[0-1]{1}$/', $validStatus ))
					throw new Exception ();
				
				$factory = Bonjour_Core_Model_Factory::getInstance ();
				$db = Bonjour_Core_Db_Connection::getConnection ( 'master' );
				if ($db == null) {
					throw new Exception ();
				}
				$factory->setDbAdapter ( $db );
				$factory->registGateway ( 'User' );
				
				$set = array (
						'userName' => $userName,
						'roleID' => $roleID,
						'email' => $email,
						'mobile' => $mobile,
						'phoneNumber' => $phoneNumber,
						'validStatus' => $validStatus 
				);
				$where ['userID=?'] = $userID;
				$affected_rows = $factory->__gateway ( 'User' )->modifyUser ( $set, $where );
				
				echo Bonjour_Core_GlobalConstant::BONJOUR_SUCCESS;
			} catch ( Exception $e ) {
				// echo $e->getMessage();
				echo Bonjour_Core_GlobalConstant::BONJOUR_ERROR;
			}
		}
	}
	/**
	 * 查询全部用户
	 */
	public function queryUserListAction() {
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
				
				// 搜索条件参数校验
				$condition = '';
				$params = array ();
				$userID = $this->_request->getParam ( 'p1' );
				$userName = $this->_request->getParam ( 'p2' );
				$roleID = $this->_request->getParam ( 'p3' );
				$creatorID = $this->_request->getParam ( 'p4' );
				$startdate = $this->_request->getParam ( 'p5' );
				$enddate = $this->_request->getParam ( 'p6' );
				$validStatus = $this->_request->getParam ( 'p7' );
				if (isset ( $userID ) && $userID != '' && preg_match ( '/^(\d+)$/', $userID )) {
					$condition = $condition . " and userID=?";
					$params = array_merge ( $params, array (
							$userID 
					) );
				}
				if (isset ( $userName ) && $userName != '') {
					$condition = $condition . " and userName regexp ?";
					$params = array_merge ( $params, array (
							$userName 
					) );
				}
				if (isset ( $roleID ) && $roleID != '' && preg_match ( '/^(\d+)$/', $roleID )) {
					$condition = $condition . " and a.roleID=?";
					$params = array_merge ( $params, array (
							$roleID 
					) );
				}
				if (isset ( $creatorID ) && $creatorID != '' && preg_match ( '/^(\d+)$/', $creatorID )) {
					$condition = $condition . " and a.creatorID=?";
					$params = array_merge ( $params, array (
							$creatorID 
					) );
				}
				if (isset ( $startdate ) && isset ( $enddate )) {
					if (($startdate == '' && $enddate != '') || ($startdate != '' && $enddate == ''))
						throw new Exception ();
					if ($startdate != '' && preg_match ( '/^[0-9]{8}$/', $startdate ) && $enddate != '' && preg_match ( '/^[0-9]{8}$/', $enddate )) {
						$condition = $condition . " and a.createDate between ? and ?";
						$params = array_merge ( $params, array (
								$startdate,
								$enddate 
						) );
					}
				}
				if (isset ( $validStatus ) && $validStatus != '' && preg_match ( '/^[0-1]{1}$/', $validStatus )) {
					$condition = $condition . " and a.validStatus=?";
					$params = array_merge ( $params, array (
							$validStatus 
					) );
				}
				
				$factory = Bonjour_Core_Model_Factory::getInstance ();
				$db = Bonjour_Core_Db_Connection::getConnection ( 'slave' );
				if ($db == null) {
					throw new Exception ();
				}
				$factory->setDbAdapter ( $db );
				$factory->registGateway ( 'User' );
				
				$total = $factory->__gateway ( 'User' )->countUserList ( $condition, $params );
				$rows = $factory->__gateway ( 'User' )->queryUserList ( $condition, $params, $pagesize * ($page - 1), $pagesize );
				
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
				$factory->registGateway ( 'User' );
				// 查询
				$total = $factory->__gateway ( 'User' )->countValidUser ( $keyword );
				$rows = $factory->__gateway ( 'User' )->queryValidUser ( $pagesize * ($page - 1), $pagesize, $keyword );
				$callback = array (
						'Rows' => $rows,
						'Total' => $total 
				);
				
				echo Zend_Json::encode ( $callback );
			} catch ( Exception $e ) {
				echo Bonjour_Core_GlobalConstant::BONJOUR_ERROR;
			}
		}
	}
	/**
	 * 查询全部角色
	 */
	public function queryRoleListAction() {
		if ($this->_request->isPost ()) {
			$this->_helper->viewRenderer->setNoRender ( true );
			header ( 'content-type:text/html;charset=utf-8' );
			try{
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
				$factory->registGateway ( 'User' );
				// 查询
				$total = $factory->__gateway ( 'User' )-> countRoleList();
				$rows = $factory->__gateway ( 'User' )->queryRoleList($pagesize * ($page - 1), $pagesize);
				$callback = array (
						'Rows' => $rows,
						'Total' => $total
				);
				
				echo Zend_Json::encode ( $callback );
			}catch ( Exception $e ) {
				echo Bonjour_Core_GlobalConstant::BONJOUR_ERROR;
			}
		}
	}
	/**
	 * 新建/修改角色
	 */
	public function modifyRoleAction() {
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
}

?>