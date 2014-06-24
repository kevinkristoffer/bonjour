<?php
/**
 * 用户控制器
 * @author hujianhong05
 *
 */
class MemberController extends Bonjour_Controller_Base {
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
				
				$this->initDbFactory ();
				$this->dbFactory->registGateway ( 'User' );
				
				$currentUser = $this->dbFactory->__gateway ( 'User' )->queryUser ( $username, $userpass );
				
				if (! $currentUser) {
					$message = '帐号不存在或密码错误';
					throw new Exception ();
				}
				
				$this->initSession ();
				$authNamespace = new Zend_Session_Namespace ( 'Bonjour_Auth' );
				$authNamespace->currentUser = $currentUser;
				
				$callback = array (
						'success' => 1,
						'message' => '登录成功，5秒后跳转' 
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
}

?>