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

		//测试环境下模拟session
// 		$this->initSession ();
// 		$authNamespace = new Zend_Session_Namespace ( 'Bonjour_Auth' );
// 		$user1 = array ('userID' => 1,'userName' => '胡建鸿','roleID'=>1,'roleName'=>'超级管理员');
// 		if(!isset($authNamespace->currentUser)){
// 			$authNamespace->currentUser=$user1;
// 		}
	}
	
	//Database adater session
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
	
}

?>