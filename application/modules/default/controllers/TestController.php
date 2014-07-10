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
	 * 测试翻译条件过滤JSON
	 */
	public function test7Action(){
		$this->_helper->viewRenderer->setNoRender ( true );
		header ( 'content-type:text/html;charset=utf-8' );
		$str='{"rules":[{"field":"CustomerID","op":"startwith","value":"12","type":"string"},{"field":"CustomerID","op":"equal","value":"23","type":"string"}],"groups":[{"rules":[{"field":"CompanyName","op":"equal","value":"AAA","type":"string"},{"field":"Amount","op":"equal","value":5.36,"type":"number"},{"field":"CustomerID","op":"equal","value":"45","type":"string"}],"op":"or"}],"op":"and"}';
		$obj=Zend_Json::decode($str);
		//echo var_dump($obj['groups']);
		//echo count($obj['rules']);
		echo self::translateFilter('', $obj);
		//echo var_dump($obj['groups']);
	}
	
	static function translateFilter($input,$obj){
		$i=0;
		$j=0;
		if(array_key_exists('rules', $obj) && array_key_exists('op', $obj)){
			
			
			
			if(array_key_exists('groups', $obj)){
				for($j=0;$j<count($obj['groups']);$j++){
					$input=$input.$obj['op'].' ( '.self::translateFilter($input, $obj['groups'][$j]).' ) ';
				}
			}
			
			for($i;$i<count($obj['rules']);$i++){
				
				echo $j;
				if($i!=0){
					$input=$input.' '.$obj['op'].' ';
				}
				$input=$input.' '.$obj['rules'][$i]['field'].
				' '.$obj['rules'][$i]['op'].' '.$obj['rules'][$i]['value'];
			}
		}
		return $input;
	}
	
	/**
	 *
	 * 测试权限管理
	 */
	public function test100Action(){
		
	}
	
}

?>