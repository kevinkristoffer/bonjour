<?php

class Project_ReqController extends Bonjour_Controller_Base{
	
	public function init() {
		parent::init();		//初始化session
	}
	//需求的创建人是项目负责人，后期权限管理时候注意一下
	/**
	 * 新建需求
	 */
	public function addReqAction(){
		if($this->_request->isGet()){
			try{
				$projectCode=$this->_request->getParam('code');
				if(!isset($projectCode) || !preg_match('/^[RPS]20[0-9]{2}(0[0-9]|1[0-2])[0-9]{5}$/', $projectCode))
					throw new Exception();
					
				$factory=Bonjour_Core_Model_Factory::getInstance();
				$db=Bonjour_Core_Db_Connection::getConnection('slave');
				if($db == null){
					throw new Exception();
				}
				$factory->setDbAdapter($db);
				$factory->registGateway('Project');
					
				//检查项目状态
				$fields=array('projectCode');
				$where1="projectCode=? and lockedStatus=0 and substring(flag,1,1)='1'";
				$project=$factory->__gateway('Project')->advancedQueryProjectDetail($fields,$where1,$projectCode);
				if($project==null) throw new Exception();
				
				$this->view->assign('projectCode',$projectCode);
			}catch (Exception $e){
				$this->_redirect('error');
			}
		}
		if($this->_request->isPost()){
			$this->_helper->viewRenderer->setNoRender ( true );
			header ( 'content-type:text/html;charset=utf-8' );
			try{
				if (! isset ( $_SERVER ['HTTP_X_REQUESTED_WITH'] ) || strtolower ( $_SERVER ['HTTP_X_REQUESTED_WITH'] ) != 'xmlhttprequest') {
					throw new Exception ();
				}
				//检查参数格式
				$projectCode=$this->_request->getParam('f00');
				if(!isset($projectCode) || !preg_match('/^[RPS]20[0-9]{2}(0[0-9]|1[0-2])[0-9]{5}$/', $projectCode))	throw new Exception();
				$requirementName=$this->_request->getParam('f01');
				if(!isset($requirementName) || strlen($requirementName)<5 || strlen($requirementName)>150) throw new Exception();
				$description=$this->_request->getParam('f02');
				$acceptanceCriteria=$this->_request->getParam('f03');
				$dependenceID=$this->_request->getParam('f04');
				if(isset($dependenceID)){
					if($dependenceID=='') $dependenceID=null;
					elseif(!preg_match('/^(\d+)$/', $dependenceID)) throw new Exception();
				}
					
				$priority=$this->_request->getParam('f05');
				if(isset($priority) && $priority!='')
					if(!preg_match('/^[1-9]{1}$/', $priority)) throw new Exception();
				$distributor=$this->_request->getParam('f06');
				$distributorID=null;
				$distributorName=null;
				if(isset($distributor) && preg_match('/\|/', $distributor)){
					$distributor_array=explode('|', $distributor);
					$distributorID=$distributor_array[0];
					$distributorName=$distributor_array[1];
				}
				$reviewer=$this->_request->getParam('f07');
				$reviewerID=null;
				$reviewerName=null;
				if(isset($reviewer) && preg_match('/\|/', $reviewer)){
					$reviewer_array=explode('|', $reviewer);
					$reviewerID=$reviewer_array[0];
					$reviewerName=$reviewer_array[1];
				}
				
				//从session中获取当前用户
				$authNamespace = new Zend_Session_Namespace ( 'Bonjour_Auth' );
				if(isset($authNamespace->currentUser)){
					$creatorID=$authNamespace->currentUser['userID'];
					$creatorName=$authNamespace->currentUser['userName'];
				}
				//连接数据库
				$factory=Bonjour_Core_Model_Factory::getInstance();
				$db=Bonjour_Core_Db_Connection::getConnection('master');
				if($db == null){
					throw new Exception ();
				}
				$factory->setDbAdapter($db);
				$factory->registGateway('Project')
						->registGateway('Req');
				//检查项目状态
				$fields=array('projectCode');
				$where1="projectCode=? and lockedStatus=0 and substring(flag,1,1)='1'";
				$project=$factory->__gateway('Project')->advancedQueryProjectDetail($fields,$where1,$projectCode);
				if($project==null) throw new Exception();
				
				//添加数据
				$req=array('projectCode'=>$projectCode,'requirementName'=>$requirementName,'description'=>$description,
				'acceptanceCriteria'=>$acceptanceCriteria,'dependenceID'=>$dependenceID,'createDate'=>intval(date('Ymd')),
				'creatorID'=>$creatorID,'creatorName'=>$creatorName,'distributorID'=>$distributorID,'distributorName'=>$distributorName,
				'reviewerID'=>$reviewerID,'reviewerName'=>$reviewerName,'priority'=>$priority,'lastModifiedTime'=>new Zend_Db_Expr('now()'));
				$affected_rows=$factory->__gateway('Req')->addReq($req);
				if($affected_rows!=1) throw new Exception();
				
				echo Bonjour_Core_GlobalConstant::BONJOUR_SUCCESS;
			}catch(Exception $e){
				echo Bonjour_Core_GlobalConstant::BONJOUR_ERROR;
			}
		}
	}
	/**
	 * 修改需求
	 */
	public function modifyReqAction(){
		
	}
	/**
	 * 根据项目编码查询全部需求的快照
	 */
	public function queryReqSnapAction(){
		if($this->_request->isPost()){
			$this->_helper->viewRenderer->setNoRender ( true );
			header ( 'content-type:text/html;charset=utf-8' );
			try{
				if (! isset ( $_SERVER ['HTTP_X_REQUESTED_WITH'] ) || strtolower ( $_SERVER ['HTTP_X_REQUESTED_WITH'] ) != 'xmlhttprequest') {
					throw new Exception ();
				}
				$projectCode=$this->_request->getParam('code');
				if(!isset($projectCode) || !preg_match('/^[RPS]20[0-9]{2}(0[0-9]|1[0-2])[0-9]{5}$/', $projectCode))
					throw new Exception();
				
				//验证参数
				$page=$this->_request->getParam('page');
				$pagesize=$this->_request->getParam('pagesize');
				$condition=$this->_request->getParam('condition'); //搜索表单参数
				if(!isset($page) || !isset($pagesize) || ! preg_match('/^(\d+)$/', $page) || ! preg_match('/^(\d+)$/', $pagesize)){
					throw new Exception ();
				}
				//提取关键字
				$keyword=null;
				if(isset($condition)){
					$jsonObj=Zend_Json::decode($condition);
					if($jsonObj != null)
						$keyword=$jsonObj[0]['value'];
				}
				
				$factory=Bonjour_Core_Model_Factory::getInstance();
				$db=Bonjour_Core_Db_Connection::getConnection('slave');
				if($db == null){
					throw new Exception();
				}
				$factory->setDbAdapter($db);
				$factory->registGateway('Req');
				
				$rows=$factory->__gateway('Req')->queryReqSnapByProjectCode($projectCode,$keyword,$pagesize*($page-1),$pagesize);
				$total=count($rows);
				$callback=array('Rows'=>$rows,'Total'=>$total);
					
				echo Zend_Json::encode($callback);
			}catch(Exception $e){
				echo Bonjour_Core_GlobalConstant::BONJOUR_ERROR;
			}
		}
	}
	/**
	 * 查询全部需求
	 */
	public function queryAllAction(){
		if($this->_request->isGet()){}
	}
	/**
	 * 查询项目树
	 */
	public function queryProjectTreeAction(){
		$this->_helper->viewRenderer->setNoRender ( true );
		header ( 'content-type:text/html;charset=utf-8' );
		if ($this->_request->isPost ()) {
			try{
				if (! isset ( $_SERVER ['HTTP_X_REQUESTED_WITH'] ) || strtolower ( $_SERVER ['HTTP_X_REQUESTED_WITH'] ) != 'xmlhttprequest') {
					throw new Exception ();
				}
				$rootNode=$this->_request->getParam('code');
				if(!isset($rootNode) || !preg_match('/^[R]20[0-9]{2}(0[0-9]|1[0-2])[0-9]{5}$/', $rootNode))
					throw new Exception();
		
				$factory=Bonjour_Core_Model_Factory::getInstance();
				$db=Bonjour_Core_Db_Connection::getConnection('slave');
				if($db == null){
					throw new Exception();
				}
				$factory->setDbAdapter($db);
				$factory->registGateway('Req');
					
				$rows=$factory->__gateway('Req')->queryProjectByRootNode($rootNode);
				$total=count($rows);
				$callback=array('Rows'=>$rows,'Total'=>$total);
					
				echo Zend_Json::encode($callback);
			}catch(Exception $e){
				echo Bonjour_Core_GlobalConstant::BONJOUR_ERROR;
			}
		}
	}
	/**
	 * 筛选查询项目需求
	 */
	public function queryReqListAction(){
		$this->_helper->viewRenderer->setNoRender ( true );
		header ( 'content-type:text/html;charset=utf-8' );
		if ($this->_request->isPost ()) {
			try{
				if (! isset ( $_SERVER ['HTTP_X_REQUESTED_WITH'] ) || strtolower ( $_SERVER ['HTTP_X_REQUESTED_WITH'] ) != 'xmlhttprequest') {
					throw new Exception ();
				}
				//验证普通参数
				$projectCode=$this->_request->getParam('code');
				if(!isset($projectCode) || !preg_match('/^[RPS]20[0-9]{2}(0[0-9]|1[0-2])[0-9]{5}$/', $projectCode))
					throw new Exception();
				$page=$this->_request->getParam('page');
				$pagesize=$this->_request->getParam('pagesize');
				if(!isset($page) || !isset($pagesize) || ! preg_match('/^(\d+)$/', $page) || ! preg_match('/^(\d+)$/', $pagesize)){
					throw new Exception ();
				}
				//验证高级参数
				$orderby='';
				$sort=$this->_request->getParam('sort');
				if(isset($sort) && $sort!=''){
					$orderby=str_replace(';', ',', $sort);
					$orderby='order by '.$orderby;
				}
				$condition='';
				$params=array();
				$nameKeyword=$this->_request->getParam('p1');
				if(isset($nameKeyword) && $nameKeyword!=''){
					$condition=$condition.' and requirementName regexp ?';
					$params=array_merge($params,array($nameKeyword));
				}
				$startdate=$this->_request->getParam('p2');
				$enddate=$this->_request->getParam('p3');
				if(isset($startdate) && isset($enddate) && preg_match('/^[0-9]{8}$/',$startdate) && preg_match('/^[0-9]{8}$/',$enddate)){
					$condition=$condition.' and createDate between ? and ?';
					$params=array_merge($params,array($startdate,$enddate));
				}
				$statusValue=$this->_request->getParam('p4');
				if(isset($statusValue) && preg_match('/^[0-8]{1}$/',$statusValue)){
					$condition=$condition.' and substring(flag,1,1)=?';
					$params=array_merge($params,array($statusValue));
				}
				
// 				echo 'orderby:'.$orderby.'<br/>';
// 				echo 'condition:'.$condition.'<br/>';
// 				var_dump($params);
				$factory=Bonjour_Core_Model_Factory::getInstance();
				$db=Bonjour_Core_Db_Connection::getConnection('slave');
				if($db == null){
					throw new Exception();
				}
				$factory->setDbAdapter($db);
				$factory->registGateway('Req');
					
				$rows=$factory->__gateway('Req')->queryReqList($projectCode,$pagesize*($page-1),$pagesize,$condition,$params,$orderby);
				$total=$factory->__gateway('Req')->countReqList($projectCode,$condition,$params,$orderby);
				$callback=array('Rows'=>$rows,'Total'=>$total);
					
				echo Zend_Json::encode($callback);
			}catch(Exception $e){
// 				echo $e->getMessage();
				echo Bonjour_Core_GlobalConstant::BONJOUR_ERROR;
			}
		}
	}
	/**
	 * 查看需求明细
	 */
	public function queryReqDetailAction(){
		
	}
}

?>