<?php
/**
 * 用户控制器
 * @author hujianhong05
 *
 */
class MemberController extends Bonjour_Controller_Base {
	
	/**
	 * 防止session检测
	 * (non-PHPdoc)
	 * @see Bonjour_Controller_Base::init()
	 */
	public function init(){
		
	}
	/**
	 * 用户注册
	 */
	public function registerAction() {
		/**
		 * 注册页面
		 */
		if ($this->_request->isGet ()) {
		/**
		 * 直接跳转到注册页面 *
		 */
		}
		/**
		 * 提交表单
		 */
		if ($this->_request->isPost ()) {
			$this->_helper->viewRenderer->setNoRender ( true );
			header ( 'content-type:text/html;charset=utf-8' );
			
			$message = '系统出错';
			try {
				// check ajax request
				if (! isset ( $_SERVER ['HTTP_X_REQUESTED_WITH'] ) || strtolower ( $_SERVER ['HTTP_X_REQUESTED_WITH'] ) != 'xmlhttprequest') {
					throw new Exception ();
				}
				
				$username = $this->_request->getPost ( 'username' );
				$userpass = $this->_request->getPost ( 'userpass' );
				$userpass = md5 ( $userpass );
				$email = $this->_request->getPost ( 'email' );
				// check parameter ,filter illegal parameter
				$this->initDbFactory ();
				$this->dbFactory->registGateway ( 'User' );
				$userGateway = $this->dbFactory->__gateway ( 'User' );
				
				if ($userGateway->queryExistUsername ( $username )) {
					$message = '用户名已注册';
					throw new Exception ();
				}
				// add user
				$user = array (
						'username' => $username,
						'userpass' => $userpass,
						'email' => $email 
				);
				$lastId = $userGateway->addUser ( $user );
				
				$callback = array (
						'success' => 1,
						'message' => '注册成功，5秒后跳转' 
				);
			} catch ( Exception $ex ) {
				$callback = array (
						'success' => 0,
						'message' => $message 
				);
			}
			echo Zend_Json::encode ( $callback );
		}
	}
	public function loginAction() {
		/**
		 * 登录页面
		 */
		if ($this->_request->isGet ()) {
			
		}
		/**
		 * 提交表单
		 */
		if ($this->_request->isPost ()) {
			$this->_helper->viewRenderer->setNoRender ( true );
			header ( 'content-type:text/html;charset=utf-8' );
			try {
				// check ajax request
				if (! isset ( $_SERVER ['HTTP_X_REQUESTED_WITH'] ) || strtolower ( $_SERVER ['HTTP_X_REQUESTED_WITH'] ) != 'xmlhttprequest') {
					throw new Exception ();
				}
				
				$username = $this->_request->getPost ( 'username' );
				$userpass = $this->_request->getPost ( 'userpass' );
				
				if(!isset($username) || !isset($userpass)) throw new Exception();
				
				$userpass = md5 ( $userpass );
				
				// 连接数据库
				$factory = Bonjour_Core_Model_Factory::getInstance ();
				$db = Bonjour_Core_Db_Connection::getConnection ( 'master' );
				if ($db == null) {
					throw new Exception ();
				}
				$factory->setDbAdapter ( $db );
				$factory->registGateway ( 'User' );
				
				//根据账户和密码查询有效用户
				$user = $factory->__gateway ( 'User' )->validUser($username,$userpass);
				
				if(!isset($user)) throw new Exception();
				
				//更改登录次数和最近登录时间
				$set=array('loginTimes'=>new Zend_Db_Expr('loginTimes+1'),'lastLogin'=>new Zend_Db_Expr('now()'));
				$where['userID=?']=$user->userID;
				$affected_rows=$factory->__gateway ( 'User' )->modifyUser($set,$where);
				
				//设置会话
				$this->initSession ();
				$authNamespace = new Zend_Session_Namespace ( 'Bonjour_Auth' );
				$authNamespace->currentUser = $user;
				
				echo Bonjour_Core_GlobalConstant::BONJOUR_SUCCESS;
			} catch ( Exception $e ) {
				//echo $e->getMessage();
				echo Bonjour_Core_GlobalConstant::BONJOUR_ERROR;
			}
		}
	}
	
	/**
	 * 首页新建页面标签时检查是否登录
	 * @throws Exception
	 */
	public function checkLoginAction(){
		if ($this->_request->isPost ()) {
			$this->_helper->viewRenderer->setNoRender ( true );
			header ( 'content-type:text/html;charset=utf-8' );
			try {
				if (! isset ( $_SERVER ['HTTP_X_REQUESTED_WITH'] ) || strtolower ( $_SERVER ['HTTP_X_REQUESTED_WITH'] ) != 'xmlhttprequest') {
					throw new Exception ();
				}
				$this->initSession ();
				$authNamespace = new Zend_Session_Namespace ( 'Bonjour_Auth' );
				if(!isset($authNamespace->currentUser))
					throw new Exception();
				echo Bonjour_Core_GlobalConstant::BONJOUR_SUCCESS;
			}catch ( Exception $e ) {
				echo Bonjour_Core_GlobalConstant::BONJOUR_ERROR;
			}
			
		}
	}
}

?>