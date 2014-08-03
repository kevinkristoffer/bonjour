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
		$str='{"rules":[{"field":"CustomerID","op":"notequal","value":"AA","type":"string"},{"field":"CustomerID","op":"equal","value":"BB","type":"string"}],"groups":[{"rules":[{"field":"CustomerID","op":"equal","value":"CC","type":"string"},{"field":"CustomerID","op":"equal","value":"EE","type":"string"}],"groups":[{"rules":[{"field":"CompanyName","op":"greater","value":"54","type":"string"},{"field":"CustomerID","op":"less","value":"12","type":"string"},{"field":"Amount","op":"equal","value":545,"type":"number"}],"op":"and"}],"op":"or"}],"op":"and"}';
		$obj=Zend_Json::decode($str);
		//echo var_dump($obj['groups']);
		//echo count($obj['rules']);
		echo self::translateFilter($obj);
		//echo var_dump($obj['groups']);
	}
	
	static function translateFilter($obj){
		$output='';
		
		if(array_key_exists('rules', $obj) && array_key_exists('op', $obj)){
			$temp_array=array();
			for($i=0;$i<count($obj['rules']);$i++){
				$output=$obj['rules'][$i]['field'].' '.$obj['rules'][$i]['op'].' '.$obj['rules'][$i]['value'];
				array_push($temp_array, $output);
			}
			if(array_key_exists('groups', $obj)){
				for($j=0;$j<count($obj['groups']);$j++){
					$output=' ( '.self::translateFilter($obj['groups'][$j]).' ) ';
					array_push($temp_array, $output);
				}
			}
			$output=implode(' '.$obj['op'].' ', $temp_array);
		}
		
		return $output;
	}
	/**
	 * 测试s3服务
	 */
	public function testS3Action(){
		$this->_helper->viewRenderer->setNoRender ( true );
		header ( 'content-type:text/html;charset=utf-8' );
		
		try{
			$s3=new Zend_Service_Amazon_S3('AKIAJPHC5NJDPEQWDJVQ','ia8zEFQNlZJO7WV6Sb46GiRu8TyF9U/5C3xOZAmD');
			
			//echo file_get_contents('D:/myfiles/Chahua16.jpg');
// 			$s3->putFile('D:/myfiles/Chahua16.jpg', 'bacterium87-bucket/test1.jpg',
// 			array(Zend_Service_Amazon_S3::S3_ACL_HEADER=>Zend_Service_Amazon_S3::S3_ACL_PUBLIC_READ));

			$s3->putObject('bacterium87-bucket/test1.jpg',file_get_contents('D:/myfiles/Chahua16.jpg'),
			array(Zend_Service_Amazon_S3::S3_ACL_HEADER=>Zend_Service_Amazon_S3::S3_ACL_PUBLIC_READ));
			
// 			$objs=$s3->getObjectsByBucket('bacterium87-bucket');
			
// 			var_dump($objs);

		}catch(Exception $e){
			echo $e->getMessage();
		}
	}
	/**
	 * 测试代理服务器
	 */
	public function testProxyClientAction(){
		$this->_helper->viewRenderer->setNoRender ( true );
		header ( 'content-type:text/html;charset=utf-8' );
		try{
			require_once 'Zend/Http/Client/Adapter/Proxy.php';
			$config = array (
					'proxy_host' => '127.0.0.1',
					'proxy_port' => 1081,
					'proxy_user' => '',
					'proxy_pass' => '' 
			);
			$client=new Zend_Http_Client("http://www.youtube.com",$config);
			$response=$client->request(Zend_Http_Client::GET);
			echo $response->getMessage();
		}catch(Exception $e){
			echo $e->getMessage();
		}
	}
	
	/**
	 *
	 * 测试权限管理
	 */
	public function test100Action(){
		
	}
	
}

?>