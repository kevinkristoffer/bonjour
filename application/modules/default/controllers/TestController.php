<?php

//测试控制器
class TestController extends Bonjour_Controller_Base{
	
	public function init(){
		
	}
	
	/**
	 * 测试JQuery的jsonParser
	 */
	public function test1Action(){
		
		if ($this->_request->isGet ()) {}
		
		if ($this->_request->isPost ()) {
			
			//sleep(5);		//模拟延迟
			$this->_helper->viewRenderer->setNoRender ( true );
			header ( 'content-type:text/html;charset=utf-8' );
			
			$this->initDbFactory();
			
			$this->dbFactory->registGateway('Policy');
			
			$plist=$this->dbFactory->__gateway('Policy')->queryPolicy(20130101,20130101,'330282');
			
			echo Zend_Json_Encoder::encode($plist);
		}
	}
	
	/**
	 * 测试session
	 */
	public function test2Action(){
		$this->_helper->viewRenderer->setNoRender ( true );
		$this->initSession ();
		$authNamespace = new Zend_Session_Namespace ( 'Bonjour_Auth' );
		$authNamespace->currentUser = 'kevin';
		echo 'session set:' . $authNamespace->currentUser;
	}
	public function test3Action(){
		$this->_helper->viewRenderer->setNoRender ( true );
		$this->initSession();
		$authNamespace=new Zend_Session_Namespace('Bonjour_Auth');
		echo 'session get:'.$authNamespace->currentUser;
	}
	//查询在线人数
	public function test4Action(){
		$this->_helper->viewRenderer->setNoRender ( true );
		$this->initDatabase();
		$query="select count(*) online_cnt from session where unix_timestamp()-modified<lifetime";
		$row=$this->db->query($query)->fetch();
		echo 'online users:'.$row['online_cnt'];
	}
	public function test5Action(){
		$this->_helper->viewRenderer->setNoRender ( true );
		$factory = Bonjour_Core_Model_Factory::getInstance ();
		$db = Bonjour_Core_Db_Connection::getConnection ( 'master' );
		if ($db == null) {
			throw new Exception ();
		}
		$db->beginTransaction();
		try{
			$user1=array('userName'=>'kristoffer');
			$db->insert('bonjour_demo',$user1);
			//throw new Exception();
			$user2=array('userName'=>'sammy');
			$db->insert('bonjour_demo',$user2);
			$db->commit();
			echo 'SUCCESS';
		}catch (Exception $ex){
			$db->rollBack();
			//echo $ex->getMessage();
			echo 'ERROR';
		}
	}
	public function test6Action(){
		$this->_helper->viewRenderer->setNoRender ( true );
		header ( 'content-type:text/html;charset=utf-8' );
		$num=array();
		array_push($num,1);
		array_push($num,2);
		array_push($num,3);
		array_push($num,4);
		array_push($num,5);
		var_dump($num);
	}
	
	/**
	 *
	 * 测试权限管理
	 */
	public function test100Action(){
		
	}
	
}

?>