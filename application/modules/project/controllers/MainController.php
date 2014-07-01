<?php


class Project_MainController extends Bonjour_Controller_Base{
	
	/**
	 * Constructor
	 *
	 * @see Bonjour_Controller_Base::init()
	 */
	public function init() {
		parent::init();		//初始化session
	}
	/**
	 * Default action
	 * 项目全景图
	 */
	public function indexAction() {
	
	}
	/**
	 * 添加项目
	 */
	public function addProjectAction(){
		if($this->_request->isGet()){
			$nodeType=$this->_request->getParam('nodeType');
			//检验节点类型
			if(!isset($nodeType) || !preg_match('/^[RPS]$/', $nodeType)){
				$this->_redirect('error');
			}
			$parentNode='000000000000';
			$rootNode=null;
			//检验父节点和根节点类型
			if($nodeType=='P' || $nodeType=='S'){
				$parentNode=$this->_request->getParam('parentNode');
				if(!isset($parentNode) || !preg_match('/^[RPS]20[0-9]{2}(0[0-9]|1[0-2])[0-9]{5}$/', $parentNode)){
					$this->_redirect('error');
				}
				$rootNode=$this->_request->getParam('rootNode');
				if(!isset($rootNode) || !preg_match('/^[R]20[0-9]{2}(0[0-9]|1[0-2])[0-9]{5}$/', $rootNode)){
					$this->_redirect('error');
				}
			}
			$params=array('nodeType'=>$nodeType,'parentNode'=>$parentNode,'rootNode'=>$rootNode);
			$this->view->assign('params',$params);
		}
		if($this->_request->isPost()){
			$this->_helper->viewRenderer->setNoRender ( true );
			header ( 'content-type:text/html;charset=utf-8' );
			try{
				if (! isset ( $_SERVER ['HTTP_X_REQUESTED_WITH'] ) || strtolower ( $_SERVER ['HTTP_X_REQUESTED_WITH'] ) != 'xmlhttprequest') {
					throw new Exception ();
				}
				//检验参数1
				$projectName=$this->_request->getParam('f01');
				if(!isset($projectName) || strlen($projectName)<3 || strlen($projectName)>100)	throw new Exception();
				$description=$this->_request->getParam('f02');
				$estimateStartDate=$this->_request->getParam('f03');
				if(!isset($estimateStartDate) || !preg_match('/^20[0-9]{6}$/', $estimateStartDate)){
					$estimateStartDate=null;
				}
				$estimateDuration=$this->_request->getParam('f04');
				if(isset($estimateDuration) && $estimateDuration<=0) throw new Exception();
				$responsible=$this->_request->getParam('f05');
				if(!isset($responsible) || !preg_match('/|/', $responsible)) throw new Exception();
				$responsible2=explode('|', $responsible);
				$responsibleID=$responsible2[0];
				$responsibleName=$responsible2[1];
				
				$nodeType=$this->_request->getParam('f11');
				if(!isset($nodeType) || !preg_match('/^[RPS]$/', $nodeType)) throw new Exception();
				$parentNode=$this->_request->getParam('f12');
				$rootNode=$this->_request->getParam('f13');
				if($nodeType=='P' || $nodeType=='S'){
					if(!isset($parentNode) || !preg_match('/^[RPS]20[0-9]{2}(0[0-9]|1[0-2])[0-9]{5}$/', $parentNode)) throw new Exception();
					if(!isset($rootNode) || !preg_match('/^[R]20[0-9]{2}(0[0-9]|1[0-2])[0-9]{5}$/', $rootNode)) throw new Exception();
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
				$factory->registGateway('Project');
				//新建项目需开启事务
				$db->beginTransaction();
				try{
					$projectCode=$factory->__gateway('Project')->generateProjectCode($nodeType); 	//生成新的项目代码
					//如果是根节点rootNode设置成projectCode
					if($nodeType == 'R')
						$rootNode=$projectCode;
					$nodeCodeRoute=array();
					$nodeNameRoute=array();
					array_push($nodeCodeRoute,$projectCode);
					array_push($nodeNameRoute, $projectName);
					$tempCode=$parentNode;
					while(($node=$factory->__gateway('Project')->queryProjectNode($tempCode))!=null){
						array_push($nodeCodeRoute,$node->projectCode);
						array_push($nodeNameRoute, $node->projectName);
						$tempCode=$node->parentNode;
					}
					$nodeCodeRoute=array_reverse($nodeCodeRoute);
					$nodeNameRoute=array_reverse($nodeNameRoute);
					$nodeCodeRoute=implode('|', $nodeCodeRoute);
					$nodeNameRoute=implode('|', $nodeNameRoute);
					$moduleName='ProjectMain';		//附件关联模块名称
					$project=array('projectCode'=>$projectCode,'nodeType'=>$nodeType,'projectName'=>$projectName,'rootNode'=>$rootNode,
							'parentNode'=>$parentNode,'nodeCodeRoute'=>$nodeCodeRoute,'nodeNameRoute'=>$nodeNameRoute,
							'createDate'=>intval(date('Ymd')),'estimateStartDate'=>$estimateStartDate,'estimateDuration'=>$estimateDuration,
							'creatorID'=>$creatorID,'creatorName'=>$creatorName,'responsibleID'=>$responsibleID,
							'responsibleName'=>$responsibleName,'description'=>$description,'moduleName'=>$moduleName);
					$factory->__gateway('Project')->addProject($project);
					$db->commit();
				}catch (Exception $exp){
					$db->rollBack();
					throw $exp;
				}
				
				echo Bonjour_Core_GlobalConstant::BONJOUR_SUCCESS;
			}catch(Exception $e){
				echo Bonjour_Core_GlobalConstant::BONJOUR_ERROR;
			}
		}
	}
	/**
	 * 修改保存项目
	 */
	public function modifyProjectAction(){
		$this->_helper->viewRenderer->setNoRender ( true );
		header ( 'content-type:text/html;charset=utf-8' );
		if($this->_request->isPost()){
			try{
				if (! isset ( $_SERVER ['HTTP_X_REQUESTED_WITH'] ) || strtolower ( $_SERVER ['HTTP_X_REQUESTED_WITH'] ) != 'xmlhttprequest') {
					throw new Exception ();
				}
				//检验参数有效性
				$projectCode=$this->_request->getParam('f00');
				if(!isset($projectCode) || !preg_match('/^[RPS]20[0-9]{2}(0[0-9]|1[0-2])[0-9]{5}$/', $projectCode)) throw new Exception();
				$projectName=$this->_request->getParam('f01');
				if(!isset($projectName) || strlen($projectName)<3 || strlen($projectName)>100)	throw new Exception();
				$description=$this->_request->getParam('f02');
				$estimateStartDate=$this->_request->getParam('f03');
				if(!isset($estimateStartDate) || !preg_match('/^20[0-9]{6}$/', $estimateStartDate)){
					$estimateStartDate=null;
				}
				$estimateDuration=$this->_request->getParam('f04');
				if(isset($estimateDuration) && $estimateDuration<=0) throw new Exception();
				$responsible=$this->_request->getParam('f05');
				if(!isset($responsible) || !preg_match('/|/', $responsible)) throw new Exception();
				$responsible2=explode('|', $responsible);
				$responsibleID=$responsible2[0];
				$responsibleName=$responsible2[1];
				
				//连接数据库
				$factory=Bonjour_Core_Model_Factory::getInstance();
				$db=Bonjour_Core_Db_Connection::getConnection('master');
				if($db == null){
					throw new Exception ();
				}
				$factory->setDbAdapter($db);
				$factory->registGateway('Project');
				
				//检验项目状态
				$project=$factory->__gateway('Project')->queryProjectDetail($projectCode);
				if(!($project->lockedStatus==0 && intval(substr($project->flag,0,1))<2)) throw new Exception();
				
				//更新
				$set=array('projectName'=>$projectName,
						'estimateStartDate'=>$estimateStartDate,'estimateDuration'=>$estimateDuration,
						'responsibleID'=>$responsibleID,'responsibleName'=>$responsibleName,'description'=>$description);
				$where['projectCode=?']=$projectCode;
				$affected_rows=$factory->__gateway('Project')->modifyProject($set,$where);
				
				echo Bonjour_Core_GlobalConstant::BONJOUR_SUCCESS;
			}catch(Exception $e){
				echo Bonjour_Core_GlobalConstant::BONJOUR_ERROR;
			}
		}
	}
	
	/**
	 * 查询根项目快照
	 */
	public function queryRootProjectSnapshotAction(){
		$this->_helper->viewRenderer->setNoRender ( true );
		header ( 'content-type:text/html;charset=utf-8' );
		if ($this->_request->isPost ()) {
			try{
				if (! isset ( $_SERVER ['HTTP_X_REQUESTED_WITH'] ) || strtolower ( $_SERVER ['HTTP_X_REQUESTED_WITH'] ) != 'xmlhttprequest') {
					throw new Exception ();
				}
				//验证参数
				$page=$this->_request->getParam('page');
				$pagesize=$this->_request->getParam('pagesize');
				if(!isset($page) || !isset($pagesize) || ! preg_match('/^(\d+)$/', $page) || ! preg_match('/^(\d+)$/', $pagesize)){
					throw new Exception ();
				}
					
				$factory=Bonjour_Core_Model_Factory::getInstance();
				$db=Bonjour_Core_Db_Connection::getConnection('slave');
				if($db == null){
					throw new Exception();
				}
				$factory->setDbAdapter($db);
				$factory->registGateway('Project');
					
				//查询根目录快照
				$rows=$factory->__gateway('Project')->queryRootProjectSnapshot(($page-1)*$pagesize,$pagesize);
				$total=$factory->__gateway('Project')->countRootProjectSnapshot();
				$callback=array('Rows'=>$rows,'Total'=>$total);
					
				echo Zend_Json::encode($callback);
			}catch(Exception $e){
				echo Bonjour_Core_GlobalConstant::BONJOUR_ERROR;
			}
		}
	}
	/**
	 * 通过根节点查询项目，构建项目树
	 * @throws Exception
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
				if(!isset($rootNode) || !preg_match('/^[RPS]20[0-9]{2}(0[0-9]|1[0-2])[0-9]{5}$/', $rootNode))
					throw new Exception();
				
				$factory=Bonjour_Core_Model_Factory::getInstance();
				$db=Bonjour_Core_Db_Connection::getConnection('slave');
				if($db == null){
					throw new Exception();
				}
				$factory->setDbAdapter($db);
				$factory->registGateway('Project');
					
				$rows=$factory->__gateway('Project')->queryProjectByRootNode($rootNode);
				$total=count($rows);
				$callback=array('Rows'=>$rows,'Total'=>$total);
			
				echo Zend_Json::encode($callback);
			}catch(Exception $e){
				echo Bonjour_Core_GlobalConstant::BONJOUR_ERROR;
			}
		}
	}
	/**
	 * 项目明细页面
	 */
	public function queryProjectDetailAction(){
		if($this->_request->isGet()){
			try{
				$projectCode=$this->_request->getParam('code');
				//验证项目编号
				if(!isset($projectCode) || !preg_match('/^[RPS]20[0-9]{2}(0[0-9]|1[0-2])[0-9]{5}$/', $projectCode)){
					throw new Exception();
				}
				$factory=Bonjour_Core_Model_Factory::getInstance();
				$db=Bonjour_Core_Db_Connection::getConnection('slave');
				if($db == null){
					throw new Exception();
				}
				$factory->setDbAdapter($db);
				$factory->registGateway('Project');
				
				$result=$factory->__gateway('Project')->queryProjectDetail($projectCode);
				//格式化日期
				$createDate=$result->createDate;
				$result->createDate=substr($createDate,0,4).'-'.substr($createDate,4,2).'-'.substr($createDate,6,2);
				if($result->estimateStartDate!=null){
					$estimateStartDate=$result->estimateStartDate;
					$result->estimateStartDate=substr($estimateStartDate,0,4).'-'.substr($estimateStartDate,4,2).'-'.substr($estimateStartDate,6,2);
				}
				if($result->realStartDate!=null){
					$realStartDate=$result->realStartDate;
					$result->realStartDate=substr($realStartDate,0,4).'-'.substr($realStartDate,4,2).'-'.substr($realStartDate,6,2);
				}
				$projectStr=Zend_Json::encode($result);
				
				$this->view->assign('project',$result);
				$this->view->assign('projectStr',$projectStr);
			}catch(Exception $e){
				$this->_redirect('error');
			}
		}
	}
	/**
	 * 锁定/解锁项目
	 */
	public function lockProjectAction(){
		$this->_helper->viewRenderer->setNoRender ( true );
		header ( 'content-type:text/html;charset=utf-8' );
		
		if ($this->_request->isPost ()) {
			try{
				if (! isset ( $_SERVER ['HTTP_X_REQUESTED_WITH'] ) || strtolower ( $_SERVER ['HTTP_X_REQUESTED_WITH'] ) != 'xmlhttprequest') {
					throw new Exception ();
				}
				$projectCode=$this->_request->getParam('code');
				if(!isset($projectCode) || !preg_match('/^[RPS]20[0-9]{2}(0[0-9]|1[0-2])[0-9]{5}$/', $projectCode))
					throw new Exception();
		
				$factory=Bonjour_Core_Model_Factory::getInstance();
				$db=Bonjour_Core_Db_Connection::getConnection('master');
				if($db == null){
					throw new Exception();
				}
				$factory->setDbAdapter($db);
				$factory->registGateway('Project');
				
				$affected_rows=$factory->__gateway('Project')->modifyProjectLockedStatus($projectCode);
				if($affected_rows != 1) throw new Exception ();
				
				echo Bonjour_Core_GlobalConstant::BONJOUR_SUCCESS;
			}catch(Exception $e){
				echo Bonjour_Core_GlobalConstant::BONJOUR_ERROR;
			}
		}
	}
	/**
	 * 根项目管理
	 */
	public function manageRootProjectAction(){
		
	}
	/**
	 * 查询根项目
	 */
	public function queryRootProjectAction(){
		
	}
	
	/**
	 * 查询项目
	 */
	public function queryProjectAction(){
	
	}
}

?>