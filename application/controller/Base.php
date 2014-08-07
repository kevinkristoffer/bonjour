<?php

class Bonjour_Controller_Base extends Zend_Controller_Action{
	
	protected $request;
	protected $memcache;
	protected $redis;
	protected $mongo;
	protected $session;
	protected $mail;
	
	public function init(){
		//防止URL对大小写敏感
// 		$this->_request->setModuleName(strtolower($this->_request->getModuleName()));
// 		$this->_request->setControllerName(strtolower($this->_request->getControllerName()));
// 		$this->_request->setActionName(strtolower($this->_request->getActionName()));

		//检查是否登录
		$this->initSession ();
		$authNamespace = new Zend_Session_Namespace ( 'Bonjour_Auth' );
		if(!isset($authNamespace->currentUser)){
			if($this->_request->isGet()){
				$this->redirect('member/login');
			}else{
				echo Bonjour_Core_GlobalConstant::BONJOUR_ERROR;
			}
			exit();
		}
	}
	
	//初始化session
	protected function initSession(){
		//$this->session=Zend_Controller_Front::getInstance()->getParam('bootstrap')->getResource('session');
		$db=Bonjour_Core_Db_Connection::getConnection('master');
		$prefix=Bonjour_Core_Db_Connection::getDbPrefix();
		Zend_Db_Table_Abstract::setDefaultAdapter($db);
		$config = array(
				'name'           => $prefix.'session',
				'primary'        => 'id',
				'modifiedColumn' => 'modified',
				'dataColumn'     => 'data',
				'lifetimeColumn' => 'lifetime'
		);
		Zend_Session::setSaveHandler(new Zend_Session_SaveHandler_DbTable($config));
		Zend_Session::start();
	}
	
	//初始化操作权限
	protected function initOperationPrivilege(){
		//获取session
		//检查对应的用户在SSDB中是否已存在记录
		//如果不存在查询数据库,生成操作权限白名单
		//超级管理员组和用户编号为1（root帐号）能访问全部权限（访问对象-
		//将操作权限白名单集合放入SSDB的hashmap中
	}
	//初始化模块权限
	protected function initForumPrivilege(){
		//同上
	}
	
}

?>