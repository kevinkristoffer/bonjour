<?php
class Project_ReqController extends Bonjour_Controller_Base {
	public function init() {
		parent::init (); // 初始化session
	}
	// 需求的创建人是项目负责人，后期权限管理时候注意一下
	/**
	 * 新建需求
	 */
	public function addReqAction() {
		if ($this->_request->isGet ()) {
			try {
				$projectCode = $this->_request->getParam ( 'code' );
				if (! isset ( $projectCode ) || ! preg_match ( '/^[RPS]20[0-9]{2}(0[0-9]|1[0-2])[0-9]{5}$/', $projectCode ))
					throw new Exception ();
				
				$factory = Bonjour_Core_Model_Factory::getInstance ();
				$db = Bonjour_Core_Db_Connection::getConnection ( 'slave' );
				if ($db == null) {
					throw new Exception ();
				}
				$factory->setDbAdapter ( $db );
				$factory->registGateway ( 'Project' );
				
				// 检查项目状态
				$fields = array (
						'projectCode' 
				);
				$where1 = "projectCode=? and lockedStatus=0 and flag1=".Bonjour_Core_GlobalConstant::PROJECT_STARTED;
				$project = $factory->__gateway ( 'Project' )->advancedQueryProjectDetail ( $fields, $where1, $projectCode );
				if ($project == null)
					throw new Exception ();
				
				$this->view->assign ( 'projectCode', $projectCode );
			} catch ( Exception $e ) {
				$this->_redirect ( 'error' );
			}
		}
		if ($this->_request->isPost ()) {
			$this->_helper->viewRenderer->setNoRender ( true );
			header ( 'content-type:text/html;charset=utf-8' );
			try {
				if (! isset ( $_SERVER ['HTTP_X_REQUESTED_WITH'] ) || strtolower ( $_SERVER ['HTTP_X_REQUESTED_WITH'] ) != 'xmlhttprequest') {
					throw new Exception ();
				}
				// 检查参数格式
				$projectCode = $this->_request->getParam ( 'f00' );
				if (! isset ( $projectCode ) || ! preg_match ( '/^[RPS]20[0-9]{2}(0[0-9]|1[0-2])[0-9]{5}$/', $projectCode ))
					throw new Exception ();
				$requirementName = $this->_request->getParam ( 'f01' );
				if (! isset ( $requirementName ) || strlen ( $requirementName ) < 5 || strlen ( $requirementName ) > 150)
					throw new Exception ();
				$description = $this->_request->getParam ( 'f02' );
				$acceptanceCriteria = $this->_request->getParam ( 'f03' );
				$dependenceID = $this->_request->getParam ( 'f04' );
				if (isset ( $dependenceID )) {
					if ($dependenceID == '')
						$dependenceID = null;
					elseif (! preg_match ( '/^(\d+)$/', $dependenceID ))
						throw new Exception ();
				}
				
				$priority = $this->_request->getParam ( 'f05' );
				if (isset ( $priority ) && $priority != '')
					if (! preg_match ( '/^[1-9]{1}$/', $priority ))
						throw new Exception ();
				$distributor = $this->_request->getParam ( 'f06' );
				$distributorID = null;
				$distributorName = null;
				if (isset ( $distributor ) && preg_match ( '/\|/', $distributor )) {
					$distributor_array = explode ( '|', $distributor );
					$distributorID = $distributor_array [0];
					$distributorName = $distributor_array [1];
				}
				$reviewer = $this->_request->getParam ( 'f07' );
				$reviewerID = null;
				$reviewerName = null;
				if (isset ( $reviewer ) && preg_match ( '/\|/', $reviewer )) {
					$reviewer_array = explode ( '|', $reviewer );
					$reviewerID = $reviewer_array [0];
					$reviewerName = $reviewer_array [1];
				}
				
				// 从session中获取当前用户
				$authNamespace = new Zend_Session_Namespace ( 'Bonjour_Auth' );
				if (isset ( $authNamespace->currentUser )) {
					$creatorID = $authNamespace->currentUser ['userID'];
					$creatorName = $authNamespace->currentUser ['userName'];
				}
				// 连接数据库
				$factory = Bonjour_Core_Model_Factory::getInstance ();
				$db = Bonjour_Core_Db_Connection::getConnection ( 'master' );
				if ($db == null) {
					throw new Exception ();
				}
				$factory->setDbAdapter ( $db );
				$factory->registGateway ( 'Project' )->registGateway ( 'Req' );
				// 检查项目状态
				$fields = array (
						'projectCode' 
				);
				$where1 = "projectCode=? and lockedStatus=0 and flag1=".Bonjour_Core_GlobalConstant::PROJECT_STARTED;
				$project = $factory->__gateway ( 'Project' )->advancedQueryProjectDetail ( $fields, $where1, $projectCode );
				if ($project == null)
					throw new Exception ();
					
					// 添加数据
				$req = array (
						'projectCode' => $projectCode,
						'requirementName' => $requirementName,
						'description' => $description,
						'acceptanceCriteria' => $acceptanceCriteria,
						'dependenceID' => $dependenceID,
						'createDate' => intval ( date ( 'Ymd' ) ),
						'creatorID' => $creatorID,
						'creatorName' => $creatorName,
						'distributorID' => $distributorID,
						'distributorName' => $distributorName,
						'reviewerID' => $reviewerID,
						'reviewerName' => $reviewerName,
						'priority' => $priority,
						'lastModifiedTime' => new Zend_Db_Expr ( 'now()' ) 
				);
				$affected_rows = $factory->__gateway ( 'Req' )->addReq ( $req );
				if ($affected_rows != 1)
					throw new Exception ();
				
				echo Bonjour_Core_GlobalConstant::BONJOUR_SUCCESS;
			} catch ( Exception $e ) {
				echo Bonjour_Core_GlobalConstant::BONJOUR_ERROR;
			}
		}
	}
	/**
	 * 修改需求
	 */
	public function modifyReqAction() {
		if ($this->_request->isPost ()) {
			$this->_helper->viewRenderer->setNoRender ( true );
			header ( 'content-type:text/html;charset=utf-8' );
			try {
				if (! isset ( $_SERVER ['HTTP_X_REQUESTED_WITH'] ) || strtolower ( $_SERVER ['HTTP_X_REQUESTED_WITH'] ) != 'xmlhttprequest') {
					throw new Exception ();
				}
				// 检查参数格式
				$requirementID = $this->_request->getParam ( 'f11' );
				if (! isset ( $requirementID ) || ! preg_match ( '/^(\d+)$/', $requirementID ))
					throw new Exception ();
				$requirementName = $this->_request->getParam ( 'f01' );
				if (! isset ( $requirementName ) || strlen ( $requirementName ) < 5 || strlen ( $requirementName ) > 150)
					throw new Exception ();
				$description = $this->_request->getParam ( 'f02' );
				$acceptanceCriteria = $this->_request->getParam ( 'f03' );
				$dependenceID = $this->_request->getParam ( 'f04' );
				if (isset ( $dependenceID )) {
					if ($dependenceID == '')
						$dependenceID = null;
					elseif (! preg_match ( '/^(\d+)$/', $dependenceID ))
						throw new Exception ();
					elseif ($dependenceID == $requirementID)
						throw new Exception ();
				}
				
				$priority = $this->_request->getParam ( 'f05' );
				if (isset ( $priority ) && $priority != '')
					if (! preg_match ( '/^[1-9]{1}$/', $priority ))
						throw new Exception ();
				$distributor = $this->_request->getParam ( 'f06' );
				$distributorID = null;
				$distributorName = null;
				if (isset ( $distributor ) && preg_match ( '/\|/', $distributor )) {
					$distributor_array = explode ( '|', $distributor );
					$distributorID = $distributor_array [0];
					$distributorName = $distributor_array [1];
				}
				$reviewer = $this->_request->getParam ( 'f07' );
				$reviewerID = null;
				$reviewerName = null;
				if (isset ( $reviewer ) && preg_match ( '/\|/', $reviewer )) {
					$reviewer_array = explode ( '|', $reviewer );
					$reviewerID = $reviewer_array [0];
					$reviewerName = $reviewer_array [1];
				}
				
				// 连接数据库
				$factory = Bonjour_Core_Model_Factory::getInstance ();
				$db = Bonjour_Core_Db_Connection::getConnection ( 'master' );
				if ($db == null) {
					throw new Exception ();
				}
				$factory->setDbAdapter ( $db );
				$factory->registGateway ( 'Req' );
				
				// 检查状态
				$fields = array (
						'requirementID' 
				);
				$condition = "requirementID=? and lockedStatus=0 and flag1 in (".Bonjour_Core_GlobalConstant::REQUIREMENT_INITIALIZED.",".Bonjour_Core_GlobalConstant::REQUIREMENT_VERYFY_RETURNED.")";
				$result = $factory->__gateway ( 'Req' )->advancedQueryReqDetail ( $fields, $condition, $requirementID );
				if ($result == null)
					throw new Exception ();
					
					// 更新数据
				$set = array (
						'requirementName' => $requirementName,
						'description' => $description,
						'acceptanceCriteria' => $acceptanceCriteria,
						'dependenceID' => $dependenceID,
						'distributorID' => $distributorID,
						'distributorName' => $distributorName,
						'reviewerID' => $reviewerID,
						'reviewerName' => $reviewerName,
						'priority' => $priority,
						'lastModifiedTime' => new Zend_Db_Expr ( 'now()' ) 
				);
				$where ['requirementID=?'] = $requirementID;
				$affected_rows = $factory->__gateway ( 'Req' )->modifyReq ( $set, $where );
				
				echo Bonjour_Core_GlobalConstant::BONJOUR_SUCCESS;
			} catch ( Exception $e ) {
				echo Bonjour_Core_GlobalConstant::BONJOUR_ERROR;
			}
		}
	}
	/**
	 * 根据项目编码查询全部需求的快照
	 */
	public function queryReqSnapAction() {
		if ($this->_request->isPost ()) {
			$this->_helper->viewRenderer->setNoRender ( true );
			header ( 'content-type:text/html;charset=utf-8' );
			try {
				if (! isset ( $_SERVER ['HTTP_X_REQUESTED_WITH'] ) || strtolower ( $_SERVER ['HTTP_X_REQUESTED_WITH'] ) != 'xmlhttprequest') {
					throw new Exception ();
				}
				$projectCode = $this->_request->getParam ( 'code' );
				if (! isset ( $projectCode ) || ! preg_match ( '/^[RPS]20[0-9]{2}(0[0-9]|1[0-2])[0-9]{5}$/', $projectCode ))
					throw new Exception ();
					
					// 验证参数
				$page = $this->_request->getParam ( 'page' );
				$pagesize = $this->_request->getParam ( 'pagesize' );
				$condition = $this->_request->getParam ( 'condition' ); // 搜索表单参数
				if (! isset ( $page ) || ! isset ( $pagesize ) || ! preg_match ( '/^(\d+)$/', $page ) || ! preg_match ( '/^(\d+)$/', $pagesize )) {
					throw new Exception ();
				}
				// 提取关键字
				$keyword = null;
				if (isset ( $condition )) {
					$jsonObj = Zend_Json::decode ( $condition );
					if ($jsonObj != null)
						$keyword = $jsonObj [0] ['value'];
				}
				
				$factory = Bonjour_Core_Model_Factory::getInstance ();
				$db = Bonjour_Core_Db_Connection::getConnection ( 'slave' );
				if ($db == null) {
					throw new Exception ();
				}
				$factory->setDbAdapter ( $db );
				$factory->registGateway ( 'Req' );
				
				$rows = $factory->__gateway ( 'Req' )->queryReqSnapByProjectCode ( $projectCode, $keyword, $pagesize * ($page - 1), $pagesize );
				$total = count ( $rows );
				$callback = array (
						'Rows' => $rows,
						'Total' => $total 
				);
				
				echo Zend_Json::encode ( $callback );
			} catch ( Exception $e ) {
				echo Bonjour_Core_GlobalConstant::BONJOUR_ERROR;
			}
		}
	}
	/**
	 * 查询全部需求
	 */
	public function queryAllAction() {
		if ($this->_request->isGet ()) {
		}
	}
	/**
	 * 查询项目树
	 */
	public function queryProjectTreeAction() {
		$this->_helper->viewRenderer->setNoRender ( true );
		header ( 'content-type:text/html;charset=utf-8' );
		if ($this->_request->isPost ()) {
			try {
				if (! isset ( $_SERVER ['HTTP_X_REQUESTED_WITH'] ) || strtolower ( $_SERVER ['HTTP_X_REQUESTED_WITH'] ) != 'xmlhttprequest') {
					throw new Exception ();
				}
				$rootNode = $this->_request->getParam ( 'code' );
				if (! isset ( $rootNode ) || ! preg_match ( '/^[R]20[0-9]{2}(0[0-9]|1[0-2])[0-9]{5}$/', $rootNode ))
					throw new Exception ();
				
				$factory = Bonjour_Core_Model_Factory::getInstance ();
				$db = Bonjour_Core_Db_Connection::getConnection ( 'slave' );
				if ($db == null) {
					throw new Exception ();
				}
				$factory->setDbAdapter ( $db );
				$factory->registGateway ( 'Req' );
				
				$rows = $factory->__gateway ( 'Req' )->queryProjectByRootNode ( $rootNode );
				$total = count ( $rows );
				$callback = array (
						'Rows' => $rows,
						'Total' => $total 
				);
				
				echo Zend_Json::encode ( $callback );
			} catch ( Exception $e ) {
				echo Bonjour_Core_GlobalConstant::BONJOUR_ERROR;
			}
		}
	}
	/**
	 * 筛选查询项目需求
	 */
	public function queryReqListAction() {
		$this->_helper->viewRenderer->setNoRender ( true );
		header ( 'content-type:text/html;charset=utf-8' );
		if ($this->_request->isPost ()) {
			try {
				if (! isset ( $_SERVER ['HTTP_X_REQUESTED_WITH'] ) || strtolower ( $_SERVER ['HTTP_X_REQUESTED_WITH'] ) != 'xmlhttprequest') {
					throw new Exception ();
				}
				// 验证普通参数
				$projectCode = $this->_request->getParam ( 'code' );
				if (! isset ( $projectCode ) || ! preg_match ( '/^[RPS]20[0-9]{2}(0[0-9]|1[0-2])[0-9]{5}$/', $projectCode ))
					throw new Exception ();
				$page = $this->_request->getParam ( 'page' );
				$pagesize = $this->_request->getParam ( 'pagesize' );
				if (! isset ( $page ) || ! isset ( $pagesize ) || ! preg_match ( '/^(\d+)$/', $page ) || ! preg_match ( '/^(\d+)$/', $pagesize )) {
					throw new Exception ();
				}
				// 验证高级参数
				$orderby = '';
				$sort = $this->_request->getParam ( 'sort' );
				$desc = $this->_request->getParam ( 'p6' );
				if (isset ( $sort ) && $sort != '') {
					$orderby = str_replace ( ';', ',', $sort );
					$orderby = 'order by ' . $orderby;
					if (isset ( $desc ) && $desc == 'true') {
						$orderby = $orderby . ' desc';
					}
				}
				$condition = '';
				$params = array ();
				$nameKeyword = $this->_request->getParam ( 'p1' );
				if (isset ( $nameKeyword ) && $nameKeyword != '') {
					$condition = $condition . ' and requirementName regexp ?';
					$params = array_merge ( $params, array (
							$nameKeyword 
					) );
				}
				$startdate = $this->_request->getParam ( 'p2' );
				$enddate = $this->_request->getParam ( 'p3' );
				if (isset ( $startdate ) && isset ( $enddate ) && preg_match ( '/^[0-9]{8}$/', $startdate ) && preg_match ( '/^[0-9]{8}$/', $enddate )) {
					$condition = $condition . ' and createDate between ? and ?';
					$params = array_merge ( $params, array (
							$startdate,
							$enddate 
					) );
				}
				$statusValue = $this->_request->getParam ( 'p4' );
				if (isset ( $statusValue ) && preg_match ( '/^[0-8]{1}$/', $statusValue )) {
					$condition = $condition . ' and flag1=?';
					$params = array_merge ( $params, array (
							$statusValue 
					) );
				}
				
				$factory = Bonjour_Core_Model_Factory::getInstance ();
				$db = Bonjour_Core_Db_Connection::getConnection ( 'slave' );
				if ($db == null) {
					throw new Exception ();
				}
				$factory->setDbAdapter ( $db );
				$factory->registGateway ( 'Req' );
				
				$rows = $factory->__gateway ( 'Req' )->queryReqList ( $projectCode, $pagesize * ($page - 1), $pagesize, $condition, $params, $orderby );
				$total = $factory->__gateway ( 'Req' )->countReqList ( $projectCode, $condition, $params, $orderby );
				$callback = array (
						'Rows' => $rows,
						'Total' => $total 
				);
				
				echo Zend_Json::encode ( $callback );
			} catch ( Exception $e ) {
				// echo $e->getMessage();
				echo Bonjour_Core_GlobalConstant::BONJOUR_ERROR;
			}
		}
	}
	/**
	 * 查看需求明细
	 */
	public function queryReqDetailAction() {
		if ($this->_request->isGet ()) {
			try {
				$requirementID = $this->_request->getParam ( 'id' );
				if (! isset ( $requirementID ) || ! preg_match ( '/^(\d+)$/', $requirementID ))
					throw new Exception ();
				
				$factory = Bonjour_Core_Model_Factory::getInstance ();
				$db = Bonjour_Core_Db_Connection::getConnection ( 'slave' );
				if ($db == null) {
					throw new Exception ();
				}
				$factory->setDbAdapter ( $db );
				$factory->registGateway ( 'Req' )->registGateway ( 'Attach' );
				
				$req = $factory->__gateway ( 'Req' )->queryReqDetail ( $requirementID );
				if ($req == null)
					throw new Exception ();
				$reqStr = Zend_Json::encode ( $req );
				
				// 查询文件列表
				$results = $factory->__gateway ( 'Attach' )->queryAttachByID ( $req->moduleName, $requirementID );
				$attachlist = array ();
				for($i = 0; $i < count ( $results ); $i ++) {
					$output = '<b> ' . $results [$i]->fileName . '</b>' . ' [ ' . $results [$i]->fileSize . ' 下载' . $results [$i]->downloadTimes . '次 ' . $results [$i]->createTime . ' ]';
					array_push ( $attachlist, array (
							'id' => $results [$i]->attachmentID,
							'output' => $output 
					) );
				}
				$attachlistStr = Zend_Json::encode ( $attachlist );
				
				$this->view->assign ( 'req', $reqStr );
				$this->view->assign ( 'attachlistStr', $attachlistStr );
			} catch ( Exception $e ) {
				$this->_redirect ( 'error' );
			}
		}
	}
	
	// ///////////////////需求模块的ftp文件管理/////////////////////
	/**
	 * 上传文件
	 *
	 * @throws Exception
	 */
	public function uploadAttachmentAction() {
		if ($this->_request->isGet ()) {
			try {
				// 检查编码有效性
				$requirementID = $this->_request->getParam ( 'id' );
				if (! isset ( $requirementID ) || ! preg_match ( '/^(\d+)$/', $requirementID ))
					throw new Exception ();
				$factory = Bonjour_Core_Model_Factory::getInstance ();
				$db = Bonjour_Core_Db_Connection::getConnection ( 'slave' );
				if ($db == null) {
					throw new Exception ();
				}
				$factory->setDbAdapter ( $db );
				$factory->registGateway ( 'Req' );
				
				// 检查状态
				$fields = array (
						'requirementID' 
				);
				$condition = "requirementID=? and lockedStatus=0 and flag1 in (".Bonjour_Core_GlobalConstant::REQUIREMENT_INITIALIZED.",".Bonjour_Core_GlobalConstant::REQUIREMENT_VERYFY_RETURNED.")";
				$result = $factory->__gateway ( 'Req' )->advancedQueryReqDetail ( $fields, $condition, $requirementID );
				if ($result == null)
					throw new Exception ();
					
					// 设置令牌，防止表单重复提交
				$timestamp = time ();
				$token = md5 ( 'unique_bj' . $timestamp );
				
				$this->view->assign ( 'id', $requirementID );
				$this->view->assign ( 'timestamp', $timestamp );
				$this->view->assign ( 'token', $token );
			} catch ( Exception $e ) {
				$this->_redirect ( 'error' );
			}
		}
		if ($this->_request->isPost ()) {
			$this->_helper->viewRenderer->setNoRender ( true );
			header ( 'content-type:text/html;charset=utf-8' );
			$fileName = '';
			try {
				// 检查令牌
				$timestamp = $this->_request->getParam ( 'timestamp' );
				$token = $this->_request->getParam ( 'token' );
				if (! isset ( $timestamp ) || ! preg_match ( '/^[0-9]{10}$/', $timestamp ))
					throw new Exception ();
				if (! isset ( $token ) || ! preg_match ( '/^[a-zA-Z0-9]{32}$/', $token ))
					throw new Exception ();
				if ($token !== md5 ( 'unique_bj' . $timestamp ))
					throw new Exception ();
				$requirementID = $this->_request->getParam ( 'id' );
				if (! isset ( $requirementID ) || ! preg_match ( '/^(\d+)$/', $requirementID ))
					throw new Exception ();
				
				$factory = Bonjour_Core_Model_Factory::getInstance ();
				$db = Bonjour_Core_Db_Connection::getConnection ( 'slave' );
				if ($db == null) {
					throw new Exception ();
				}
				$factory->setDbAdapter ( $db );
				$factory->registGateway ( 'Req' )->registGateway ( 'Attach' );
				// 查询需求，获取模块名称
				$fields = array (
						'moduleName' 
				);
				$condition = "requirementID=? and lockedStatus=0 and flag1 in (".Bonjour_Core_GlobalConstant::REQUIREMENT_INITIALIZED.",".Bonjour_Core_GlobalConstant::REQUIREMENT_VERYFY_RETURNED.")";
				$result = $factory->__gateway ( 'Req' )->advancedQueryReqDetail ( $fields, $condition, $requirementID );
				if ($result == null)
					throw new Exception ();
				
				$dir = Bonjour_Core_Utility_File::createDirs ( $result->moduleName . DS . $requirementID );
				$adapter = new Zend_File_Transfer_Adapter_Http ();
				$adapter->setDestination ( $dir );
				$adapter->addValidator ( 'Size', false, 4 * 1024 * 1024 );
				$filedata = $adapter->getFileInfo ()['Filedata'];
				$fileName = $filedata ['name'];
				$ext = substr ( $fileName, strpos ( $fileName, '.' ) );
				$userID = 0;
				$authNamespace = new Zend_Session_Namespace ( 'Bonjour_Auth' );
				if (isset ( $authNamespace->currentUser )) {
					$userID = $authNamespace->currentUser ['userID'];
				}
				$storageName = md5 ( $userID . rand ( 1, 99999 ) . time () ) . $ext; // 防止重名
				                                                                     // 执行重命名
				$adapter->addFilter ( 'Rename', array (
						'target' => $storageName,
						'overwrite' => true 
				) );
				
				if (! $adapter->receive ()) {
					// 返回上传错误信息
					$messages = $adapter->getMessages ();
					echo implode ( "\n", $messages );
					return;
				} else {
					// 更新数据库
					$attachmentID = time () . sprintf ( '%05d', rand ( 0, 99999 ) );
					$fileSize = Bonjour_Core_Utility_File::getFileSize ( $filedata ['size'] );
					$createTime = strval ( date ( 'Y-m-d H:i:s' ) );
					$realPath = $dir . DS . $storageName;
					try {
						$attach = array (
								'attachmentID' => $attachmentID,
								'moduleName' => $result->moduleName,
								'moduleID' => $requirementID,
								'realPath' => $realPath,
								'fileName' => $fileName,
								'fileSize' => $fileSize,
								'createTime' => $createTime 
						);
						$affected_rows = $factory->__gateway ( 'Attach' )->addAttach ( $attach );
						if ($affected_rows != 1)
							throw new Exception ();
						echo $fileName . '上传成功';
					} catch ( Exception $exp ) {
						// 删除上传的文件
						if (file_exists ( $realPath ))
							@unlink ( $realPath );
						throw new Exception ();
					}
				}
			} catch ( Exception $e ) {
				echo $fileName . '文件上传失败';
			}
		}
	}
	
	// /////////////////////////////////需求评审管理///////////////////////////////////
	/**
	 * 审核需求，同时生成评审记录
	 */
	public function verifyReqAction() {
		$this->_helper->viewRenderer->setNoRender ( true );
		header ( 'content-type:text/html;charset=utf-8' );
		if ($this->_request->isPost ()) {
			try {
				if (! isset ( $_SERVER ['HTTP_X_REQUESTED_WITH'] ) || strtolower ( $_SERVER ['HTTP_X_REQUESTED_WITH'] ) != 'xmlhttprequest') {
					throw new Exception ();
				}
				$requirementID = $this->_request->getParam ( 'id' );
				if (! isset ( $requirementID ) || ! preg_match ( '/^(\d+)$/', $requirementID ))
					throw new Exception ();
				
				$factory = Bonjour_Core_Model_Factory::getInstance ();
				$db = Bonjour_Core_Db_Connection::getConnection ( 'slave' );
				if ($db == null) {
					throw new Exception ();
				}
				$factory->setDbAdapter ( $db );
				$factory->registGateway ( 'Req' );
				
				// 检查状态，同时获取评审人ID
				$fields = array (
						'reviewerID',
						'reviewerName'
				);
				$condition = "requirementID=? and lockedStatus=0 and flag1=".Bonjour_Core_GlobalConstant::REQUIREMENT_INITIALIZED;
				$req = $factory->__gateway ( 'Req' )->advancedQueryReqDetail ( $fields, $condition, $requirementID );
				if ($req == null)
					throw new Exception ();
					
					// 从session中获取当前用户，作为申请人字段
				$authNamespace = new Zend_Session_Namespace ( 'Bonjour_Auth' );
				if (isset ( $authNamespace->currentUser )) {
					$applicantID = $authNamespace->currentUser ['userID'];
					$applicantName = $authNamespace->currentUser ['userName'];
				}
				
				// 开启事务管理
				$db->beginTransaction ();
				try {
					// 添加评审记录
					$rev = array (
							'requirementID' => $requirementID,
							'applicantID' => $applicantID,
							'applicantName' => $applicantName,
							'reviewerID' => $req->reviewerID,
							'reviewerName' => $req->reviewerName,
							'reviewType' => '1',
							'createTime' => new Zend_Db_Expr ( 'now()' ),
							'lastModifiedTime' => new Zend_Db_Expr ( 'now()' ) 
					);
					$affected_rows = $factory->__gateway ( 'Req' )->addReqReview ( $rev );
					if ($affected_rows != 1)
						throw new Exception ();
						// 更新需求状态
					$set = array (
							'flag1' => 1
					);
					$where ['requirementID=?'] = $requirementID;
					$affected_rows = $factory->__gateway ( 'Req' )->modifyReq ( $set, $where );
					if ($affected_rows != 1)
						throw new Exception ();
					
					$db->commit ();
				} catch ( Exception $e ) {
					$db->rollBack ();
					throw new Exception ();
				}
				echo Bonjour_Core_GlobalConstant::BONJOUR_SUCCESS;
			} catch ( Exception $e ) {
				// echo $e->getMessage();
				echo Bonjour_Core_GlobalConstant::BONJOUR_ERROR;
			}
		}
	}
	/**
	 * 验收需求，同时生成评审记录
	 */
	public function checkReqAction() {
	}
	/**
	 * 查询评审明细
	 */
	public function queryReviewDetailAction() {
	}
}

?>