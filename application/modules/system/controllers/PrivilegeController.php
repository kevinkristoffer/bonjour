<?php

class System_PrivilegeController extends Bonjour_Controller_Base{
	
	/**
	 * Constructor
	 *
	 * @see Bonjour_Controller_Base::init()
	 */
	public function init() {
		parent::init();
	}
	
	/**
	 * 版块权限管理
	 */
	public function forumAction(){
		$pattern=$this->_request->getParam('p');
		if($pattern=='f'){
			$this->renderScript('privilege/forum-privilege-forum-pattern.phtml');
		}elseif($pattern == 'm'){
			$this->renderScript('privilege/forum-privilege-master-pattern.phtml');
		}else{
			$this->_redirect ( 'error' );
		}
		
	}
	/**
	 * 更新版块权限
	 * 先删除满足条件的权限，后添加全部的权限
	 */
	public function udpateForumPrivilegeAction(){
		
		if ($this->_request->isPost ()) {
			$this->_helper->viewRenderer->setNoRender ( true );
			header ( 'content-type:text/html;charset=utf-8' );
			try{
				if (! isset ( $_SERVER ['HTTP_X_REQUESTED_WITH'] ) || strtolower ( $_SERVER ['HTTP_X_REQUESTED_WITH'] ) != 'xmlhttprequest') {
					throw new Exception ();
				}
				
				
			}catch(Exception $e){
				echo $e->getMessage();
				echo Bonjour_Core_GlobalConstant::BONJOUR_ERROR;
			}
		}
	}
	/**
	 * 删除某主体下的某个版块权限
	 */
	public function removeForumPrivilegeAction(){
		
		if ($this->_request->isPost ()) {
			$this->_helper->viewRenderer->setNoRender ( true );
			header ( 'content-type:text/html;charset=utf-8' );
			try{
				if (! isset ( $_SERVER ['HTTP_X_REQUESTED_WITH'] ) || strtolower ( $_SERVER ['HTTP_X_REQUESTED_WITH'] ) != 'xmlhttprequest') {
					throw new Exception ();
				}
				
				
			}catch(Exception $e){
				echo $e->getMessage();
				echo Bonjour_Core_GlobalConstant::BONJOUR_ERROR;
			}
		}
	}
}

?>