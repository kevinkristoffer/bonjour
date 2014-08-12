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
	 * 测试ssdb
	 */
	public function getUserList1Action(){
 		$this->_helper->viewRenderer->setNoRender ( true );
		header ( 'content-type:text/html;charset=utf-8' );
		try{
			
			$ssdb = Bonjour_Core_Cache_SimpleSSDB::getInstance ('master');
			$userlist = null;
			if ($ssdb->exists ( 'userlist' )) {
				$ustr = $ssdb->get ( 'userlist' );
				$userlist = Zend_Json::decode ( $ustr, Zend_Json::TYPE_OBJECT );
			} else {
				$factory = Bonjour_Core_Model_Factory::getInstance ();
				$db = Bonjour_Core_Db_Connection::getConnection ( 'slave' );
				if ($db == null) {
					throw new Exception ();
				}
				$query = "select userID,userName from bonjour_user";
				$userlist = $db->query ( $query )->fetchAll ();
				$ssdb->set ( 'userlist', Zend_Json::encode ( $userlist ) );
			}
			
			var_dump($userlist);
			
		}catch(Exception $e){
			echo $e->getMessage();
			
		}
	}
	
	public function getUserList2Action(){
		$this->_helper->viewRenderer->setNoRender ( true );
		header ( 'content-type:text/html;charset=utf-8' );
		try{

			$ssdb = Bonjour_Core_Cache_SimpleSSDB::getInstance ('slave');
			$userlist = null;
			if ($ssdb->exists ( 'userlist' )) {
				$ustr = $ssdb->get ( 'userlist' );
				$userlist = Zend_Json::decode ( $ustr, Zend_Json::TYPE_OBJECT );
			} 
			
			var_dump($userlist);

		}catch(Exception $e){
 			echo $e->getMessage();
			
		}
	}
	
	public function testSsdb1Action(){
		$this->_helper->viewRenderer->setNoRender ( true );
		header ( 'content-type:text/html;charset=utf-8' );
		try{
			$ssdb=Bonjour_Core_Cache_SimpleSSDB::getInstance();
			$ssdb->set('message', 'Hello World');
			echo 'Set value successfully';
		}catch(Exception $e){
			echo $e->getMessage();
		}
	}
	public function testSsdb2Action(){
		$this->_helper->viewRenderer->setNoRender ( true );
		header ( 'content-type:text/html;charset=utf-8' );
		try{
			$ssdb=Bonjour_Core_Cache_SimpleSSDB::getInstance();
			
			$keylength=0;
			if($ssdb->exists('key_length')){
				$keylength=$ssdb->get('key_length');
			}else{
				$c_keys = $ssdb->keys ( '', '', - 1 );
				$keylength=count($c_keys);
				$ssdb->set('key_length',$keylength);
			}

// 			$c_keys = $ssdb->keys ( 't', 'v', - 1 );
// 			echo count ( $c_keys ), '<br/>';
			
			for($i = 0; $i < rand ( 10000, 350000 ); $i ++) {
				$obj = $this->rand_string ( 5 ).rand(100,1000);
				$visitor = array (
						'name' => 'visitor' . rand ( 1, 99999999999 ),
						'time' => time (),
						'realname' => $this->create_guid () . $this->rand_string ( 9 ) 
				);
				
				$ssdb->batch ()
				->set ( $this->rand_string ( 9 ). $this->create_guid ().time () ,
						$this->create_guid ().time ().$this->rand_string ( 9 ) )
				->incr('key_length',1)
				->qpush_back ( 'q_' . $obj, Zend_Json::encode ( $visitor ) )
				->incr ( 'c_' . $obj, 1 )
				->hset($obj,$this->create_guid (),$this->rand_string ( 9 ))
				->hset(time(),$obj.$this->create_guid (),$this->rand_string ( 9 ))
				->exec ();
			}
			
			echo 'OK';
			
// 			$c_keys = $ssdb->keys ( '', '', - 1 );
// 			sort ( $c_keys );
// 			for($j = 0; $j < count ( $c_keys ); $j ++) {
// 				if (substr ( $c_keys [$j], 0, 2 ) == 'c_') {
// 					$qname = str_replace ( 'c_', 'q_', $c_keys [$j] );
// 					echo $qname . ':' . $ssdb->qsize ( $qname ) . '<br/>';
// 				}
// 			}
			
// 			var_dump($ssdb->scan('','',-1));
// 			echo $ssdb->qsize('q_obj1');
// 			var_dump($ssdb->keys('a','z',1000000));
			
// 			$c_keys=$ssdb->keys('','',-1);
// 			for($j=0; $j<count($c_keys); $j++){
// 				$qname=str_replace('c_', 'q_', $c_keys[$j]);
// 				$ssdb->qclear($qname);
// 			}
// 			$ssdb->multi_del($ssdb->keys('','',-1));
// 			echo 'deleted';
		}catch(Exception $e){
			echo $e->getMessage();
		}
	}
	
	public function testSsdb3Action(){
		$this->_helper->viewRenderer->setNoRender ( true );
		header ( 'content-type:text/html;charset=utf-8' );
		try{
			$ssdb=Bonjour_Core_Cache_SimpleSSDB::getInstance();
			$num=rand(1,1000);
			echo 'random queue size :q_obj'.$num.':'.$ssdb->qsize('q_obj'.$num).'<br/>';
			$obj = $this->rand_string ( 5 ).rand(100,1000);
			echo 'queue q_'.$obj.' size:'.$ssdb->qsize();
		}catch(Exception $e){
			echo $e->getMessage();
		}
	}
	
	public function testSsdb4Action(){
		$this->_helper->viewRenderer->setNoRender ( true );
		header ( 'content-type:text/html;charset=utf-8' );
		try{
			$ssdb=Bonjour_Core_Cache_SimpleSSDB::getInstance();
			
			$keylength=0;
			if($ssdb->exists('key_length')){
				$keylength=$ssdb->get('key_length');
			}else{
				$c_keys = $ssdb->keys ( '', '', - 1 );
				$keylength=count($c_keys);
				$ssdb->set('key_length',$keylength);
			}
			
			echo 'key length:'.$keylength;
		}catch(Exception $e){
			echo $e->getMessage();
		}
	}
	/**
	 * 测试定时任务
	 * 测试ssdb定时同步mysql
	 */
	public function testTask1Action(){
		$this->_helper->viewRenderer->setNoRender ( true );
		header ( 'content-type:text/html;charset=utf-8' );
		
		try {
			ignore_user_abort ();
			// 即使Client断开(如关掉浏览器)，PHP脚本也可以继续执行.
			set_time_limit ( 0 );
			// 执行时间为无限制，php默认的执行时间是30秒，通过set_time_limit(0)可以让程序无限制的执行下去
			$interval = 1;
			//定时间隔
			$timeout = 15;
			//终止时间
			
			$ssdb = Bonjour_Core_Cache_SimpleSSDB::getInstance ();
			do {
				//终止设定，用于测试
				if($timeout<0){
					echo '运行终止';
					exit();
				}
				
				$factory = Bonjour_Core_Model_Factory::getInstance ();
				$db = Bonjour_Core_Db_Connection::getConnection ( 'slave' );
				if ($db == null) {
					throw new Exception ();
				}
				$logger=Bonjour_Core_Log_Writer::getLogger($db);
				
				//遍历全部缓存并插入数据库
				$vedios=array('v1','v2','v3','v4','v5');
				$counter=0;
				foreach ($vedios as $item){
					$keys=$ssdb->hkeys($item,'','',-1);
					foreach ($keys as $key){
						$value=$ssdb->hget($item,$key);
						$data=Zend_Json::decode($value);
						$data=array_merge($data,array('vname'=>$item));
						$rowcount=$db->insert('bonjour_test1', $data);
						if($rowcount>0){
							$counter+=$rowcount;
							//删除缓存记录
							$ssdb->hdel($item,$key);	
						}
					}
				}
				//日志记录
				$logger->info('SSDB数据同步共'.$counter.'条记录');
				
				//睡眠
				sleep($interval);
				$timeout=$timeout-$interval;
			} while ( true );
		} catch ( Exception $e ) {
			echo '运行终止';
			exit ();
		}
	}
	public function testTask2Action(){
		$this->_helper->viewRenderer->setNoRender ( true );
		header ( 'content-type:text/html;charset=utf-8' );
		try{
			$ssdb=Bonjour_Core_Cache_SimpleSSDB::getInstance();
			
			//测试快速请求
			for($i=0; $i<10000; $i++){
				$vedio='v'.rand(1,5);
				$key=$this->create_guid();
				$record=array('uname'=>'u'.rand(1,100),'itime'=>time(),'duration'=>rand(10,600));
					
				if(!$ssdb->exists('vc_'.$vedio)){
					//连接数据库读取
					$factory = Bonjour_Core_Model_Factory::getInstance ();
					$db = Bonjour_Core_Db_Connection::getConnection ( 'slave' );
					if ($db == null) {
						throw new Exception ();
					}
					$query="select count(*) vcount from bonjour_test1 where vname=?";
					$result=$db->query($query,$vedio)->fetch();
					$ssdb->set('vc_'.$vedio,$result->vcount);
				}
					
				$ssdb->batch()->hset($vedio,$key,Zend_Json::encode($record))->incr('vc_'.$vedio,1)->exec();
				
				//延迟测试
				//usleep(rand(100, 1000));
			}
			echo 'OK';
			
			//删除全部记录
// 			$ssdb->multi_del(array('vc_v1','vc_v2','vc_v3','vc_v4','vc_v5'));
// 			$ssdb->hclear('v1');
// 			$ssdb->hclear('v2');
// 			$ssdb->hclear('v3');
// 			$ssdb->hclear('v4');
// 			$ssdb->hclear('v5');
// 			echo 'deleted';
		}catch(Exception $e){
			echo $e->getMessage();
		}
	}
	public function testTask3Action(){
		$this->_helper->viewRenderer->setNoRender ( true );
		header ( 'content-type:text/html;charset=utf-8' );
		try{
			$ssdb=Bonjour_Core_Cache_SimpleSSDB::getInstance();
		
			$vedios=array('v1','v2','v3','v4','v5');
			foreach ($vedios as $item){
				echo $item.':'.$ssdb->get('vc_'.$item).'<br/>';
			}
				
		}catch(Exception $e){
			echo $e->getMessage();
		}
	}
	//测试数据库日志
	public function testLoggerAction(){
		$this->_helper->viewRenderer->setNoRender ( true );
		header ( 'content-type:text/html;charset=utf-8' );
		try {
			$factory = Bonjour_Core_Model_Factory::getInstance ();
			$db = Bonjour_Core_Db_Connection::getConnection ( 'slave' );
			if ($db == null) {
				throw new Exception ();
			}
			$logger=Bonjour_Core_Log_Writer::getLogger($db);
			$logger->info('test message');
			
			echo 'success';
		} catch ( Exception $e ) {
			echo $e->getMessage();
		}
	}
	
	public function phpinfoAction(){
		$this->_helper->viewRenderer->setNoRender ( true );
		header ( 'content-type:text/html;charset=utf-8' );
		phpinfo();
	}
	
	
	/////////////////////////////////////////////////////////////////////////////
	
	function create_guid()
	{
		$microTime = microtime();
		list($a_dec, $a_sec) = explode(" ", $microTime);
		$dec_hex = dechex($a_dec* 1000000);
		$sec_hex = dechex($a_sec);
		$this->ensure_length($dec_hex, 5);
		$this->ensure_length($sec_hex, 6);
		$guid = "";
		$guid .= $dec_hex;
		$guid .= $this->create_guid_section(3);
		$guid .= '-';
		$guid .= $this->create_guid_section(4);
		$guid .= '-';
		$guid .= $this->create_guid_section(4);
		$guid .= '-';
		$guid .= $this->create_guid_section(4);
		$guid .= '-';
		$guid .= $sec_hex;
		$guid .= $this->create_guid_section(6);
		return $guid;
	}
	function create_guid_section($characters)
	{
		$return = "";
		for($i=0; $i<$characters; $i++)
		{
			$return .= dechex(mt_rand(0,15));
		}
		return $return;
	}
	
	function ensure_length(&$string, $length)
	
	{
		$strlen = strlen($string);
		if($strlen < $length)
		{
			$string = str_pad($string,$length,"0");
		}
		else if($strlen > $length)
		{
			$string = substr($string, 0, $length);
		}
	
	}
	/**
	 +----------------------------------------------------------
	 * 产生随机字串， 可用来自动生成密码，验证码，表单令牌等
	 * 默认长度6位 字母和数字混合 支持中文
	 +----------------------------------------------------------
	 * @param string $len 长度
	 * @param string $type 字串类型
	 * 0 字母 1 数字 其它 混合
	 * @param string $addChars 额外字符
	 +----------------------------------------------------------
	 * @return string
	 +----------------------------------------------------------
	 */
	
	function rand_string($len = 6, $type = '', $addChars = '') {
		$str = '';
		switch ($type) {
			case 0 :
				$chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz' . $addChars;
				break;
			case 1 :
				$chars = str_repeat('0123456789', 3);
				break;
			case 2 :
				$chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ' . $addChars;
				break;
			case 3 :
				$chars = 'abcdefghijklmnopqrstuvwxyz' . $addChars;
				break;
			default :
				// 默认去掉了容易混淆的字符oOLl和数字01，要添加请使用addChars参数
				$chars = 'ABCDEFGHIJKMNPQRSTUVWXYZabcdefghijkmnpqrstuvwxyz23456789' . $addChars;
				break;
		}
		if ($len > 10) { //位数过长重复字符串一定次数
			$chars = $type == 1 ? str_repeat($chars, $len) : str_repeat($chars, 5);
		}
		if ($type != 4) {
			$chars = str_shuffle($chars);
			$str = substr($chars, 0, $len);
		} else {
			// 中文随机字
			for ($i = 0; $i < $len; $i++) {
				$str .= msubstr($chars, floor(mt_rand(0, mb_strlen($chars, 'utf-8') - 1)), 1);
			}
		}
		return $str;
	}
	
	/**
	 *
	 * 测试权限管理
	 */
	public function test100Action(){
		
	}
	
}

?>