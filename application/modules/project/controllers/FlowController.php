<?php

class Project_FlowController extends Bonjour_Controller_Base{
	
	/**
	 * Constructor
	 *
	 * @see Bonjour_Controller_Base::init()
	 */
	public function init() {
		parent::init (); // 初始化session
	}
	/**
	 * 主流程管理
	 */
	public function mainAction(){
		if($this->_request->isGet()){
			try{
				$factory = Bonjour_Core_Model_Factory::getInstance ();
				$db = Bonjour_Core_Db_Connection::getConnection ( 'slave' );
				if ($db == null) {
					throw new Exception ();
				}
				$factory->setDbAdapter ( $db );
				$factory->registGateway ( 'Workflow' );
		
				$entityList=$factory->__gateway('Workflow')->queryEntityList();
				$statusList=$factory->__gateway('Workflow')->queryStatusList();
		
				$this->view->assign('entityList',Zend_Json::encode($entityList));
				$this->view->assign('statusList',Zend_Json::encode($statusList));
			}catch(Exception $e){
				$this->redirect('error');
			}
		}
	}
	/**
	 * 模板管理
	 * @throws Exception
	 */
	public function templateAction(){
		
	}
	/**
	 * 新建主流程
	 */
	public function addFlowAction(){
		if ($this->_request->isPost ()) {
			$this->_helper->viewRenderer->setNoRender ( true );
			header ( 'content-type:text/html;charset=utf-8' );
			try {
				if (! isset ( $_SERVER ['HTTP_X_REQUESTED_WITH'] ) || strtolower ( $_SERVER ['HTTP_X_REQUESTED_WITH'] ) != 'xmlhttprequest') {
					throw new Exception ();
				}
				$params = $this->_request->getParams ();
				// flowName
				if (! array_key_exists ( 'p1', $params ) || $params ['p1'] == '')
					throw new Exception ();
					// entity
				if (! array_key_exists ( 'p2', $params ) || $params ['p2'] == '')
					throw new Exception ();
					// present status
				if (! array_key_exists ( 'p3', $params ) || $params ['p3'] == '')
					throw new Exception ();
					// fail status
				if (! array_key_exists ( 'p4', $params ) || $params ['p4'] == '')
					throw new Exception ();
					// success status
				if (! array_key_exists ( 'p5', $params ) || $params ['p5'] == '')
					throw new Exception ();
				
				$factory = Bonjour_Core_Model_Factory::getInstance ();
				$db = Bonjour_Core_Db_Connection::getConnection ( 'master' );
				if ($db == null) {
					throw new Exception ();
				}
				$factory->setDbAdapter ( $db );
				$factory->registGateway ( 'Workflow' );
				
				$db->beginTransaction ();
				try {
					// generate flow number
					$flowNo = $factory->__gateway ( 'Workflow' )->generateFlowNo ();
					$flow = array (
							'flowNo' => $flowNo,
							'flowName' => $params ['p1'],
							'entity' => $params ['p2'],
							'presentStatus' => $params ['p3'],
							'failStatus' => $params ['p4'],
							'successStatus' => $params ['p5'] 
					);
					$affected_rows = $factory->__gateway ( 'Workflow' )->addFlow ( $flow );
					if ($affected_rows != 1)
						throw new Exception ();
					$db->commit ();
				} catch ( Exception $exp ) {
					$db->rollBack ();
					throw $exp;
				}
				echo Bonjour_Core_GlobalConstant::BONJOUR_SUCCESS;
			} catch ( Exception $e ) {
				$e->getMessage ();
				echo Bonjour_Core_GlobalConstant::BONJOUR_ERROR;
			}
		}
	}
	/**
	 * 修改主流程
	 */
	public function modifyFlowAction(){
		if ($this->_request->isPost ()) {
			$this->_helper->viewRenderer->setNoRender ( true );
			header ( 'content-type:text/html;charset=utf-8' );
			try{
				if (! isset ( $_SERVER ['HTTP_X_REQUESTED_WITH'] ) || strtolower ( $_SERVER ['HTTP_X_REQUESTED_WITH'] ) != 'xmlhttprequest') {
					throw new Exception ();
				}
		
				$params = $this->_request->getParams ();
				// flowNo
				if (! array_key_exists ( 'p0', $params ) || !preg_match('/^BF[0-9]{4}$/', $params['p0']))
					throw new Exception ();
				// flowName
				if (! array_key_exists ( 'p1', $params ) || $params ['p1'] == '')
					throw new Exception ();
					// entity
				if (! array_key_exists ( 'p2', $params ) || $params ['p2'] == '')
					throw new Exception ();
					// present status
				if (! array_key_exists ( 'p3', $params ) || $params ['p3'] == '')
					throw new Exception ();
					// fail status
				if (! array_key_exists ( 'p4', $params ) || $params ['p4'] == '')
					throw new Exception ();
					// success status
				if (! array_key_exists ( 'p5', $params ) || $params ['p5'] == '')
					throw new Exception ();
				
				$factory = Bonjour_Core_Model_Factory::getInstance ();
				$db = Bonjour_Core_Db_Connection::getConnection ( 'master' );
				if ($db == null) {
					throw new Exception ();
				}
				$factory->setDbAdapter ( $db );
				$factory->registGateway ( 'Workflow' );
				
				$set = array (
						'flowName' => $params ['p1'],
						'entity' => $params ['p2'],
						'presentStatus' => $params ['p3'],
						'failStatus' => $params ['p4'],
						'successStatus' => $params ['p5'] 
				);
				$where['flowNo=?']=$params['p0'];
				$factory->__gateway ( 'Workflow' )->modifyFlow ($set,$where);
				
				echo Bonjour_Core_GlobalConstant::BONJOUR_SUCCESS;
			}catch(Exception $e){
				$e->getMessage();
				echo Bonjour_Core_GlobalConstant::BONJOUR_ERROR;
			}
		}
	}
	/**
	 * 查询全部主流程
	 */
	public function queryFlowListAction(){
		if ($this->_request->isPost ()) {
			$this->_helper->viewRenderer->setNoRender ( true );
			header ( 'content-type:text/html;charset=utf-8' );
			try {
				if (! isset ( $_SERVER ['HTTP_X_REQUESTED_WITH'] ) || strtolower ( $_SERVER ['HTTP_X_REQUESTED_WITH'] ) != 'xmlhttprequest') {
					throw new Exception ();
				}
				
				$factory = Bonjour_Core_Model_Factory::getInstance ();
				$db = Bonjour_Core_Db_Connection::getConnection ( 'slave' );
				if ($db == null) {
					throw new Exception ();
				}
				$factory->setDbAdapter ( $db );
				$factory->registGateway ( 'Workflow' );
		
				$rows = $factory->__gateway ( 'Workflow' )->queryFlowList(array('*'));
				$total = count ( $rows );
				$callback = array (
						'Rows' => $rows,
						'Total' => $total
				);
		
				echo Zend_Json::encode ( $callback );
			} catch ( Exception $e ) {
				echo $e->getMessage ();
				echo Bonjour_Core_GlobalConstant::BONJOUR_ERROR;
			}
		}
	}
	/**
	 * 查询主流程快照
	 */
	public function queryFlowListSnapAction(){
		if ($this->_request->isPost ()) {
			$this->_helper->viewRenderer->setNoRender ( true );
			header ( 'content-type:text/html;charset=utf-8' );
			try {
				if (! isset ( $_SERVER ['HTTP_X_REQUESTED_WITH'] ) || strtolower ( $_SERVER ['HTTP_X_REQUESTED_WITH'] ) != 'xmlhttprequest') {
					throw new Exception ();
				}
				
				$factory = Bonjour_Core_Model_Factory::getInstance ();
				$db = Bonjour_Core_Db_Connection::getConnection ( 'slave' );
				if ($db == null) {
					throw new Exception ();
				}
				$factory->setDbAdapter ( $db );
				$factory->registGateway ( 'Workflow' );
		
				$rows = $factory->__gateway ( 'Workflow' )->queryFlowList(array('flowNo','flowName','entity'));
				$total = count ( $rows );
				$callback = array (
						'Rows' => $rows,
						'Total' => $total
				);
		
				echo Zend_Json::encode ( $callback );
			} catch ( Exception $e ) {
				echo $e->getMessage ();
				echo Bonjour_Core_GlobalConstant::BONJOUR_ERROR;
			}
		}
	}
	/**
	 * 新建环节
	 * @throws Exception
	 */
	public function addSegmentAction(){
		if ($this->_request->isPost ()) {
			$this->_helper->viewRenderer->setNoRender ( true );
			header ( 'content-type:text/html;charset=utf-8' );
			try {
				if (! isset ( $_SERVER ['HTTP_X_REQUESTED_WITH'] ) || strtolower ( $_SERVER ['HTTP_X_REQUESTED_WITH'] ) != 'xmlhttprequest') {
					throw new Exception ();
				}
				
				$params = $this->_request->getParams ();
				// segmentName
				if (! array_key_exists ( 'p1', $params ) || $params ['p1'] == '')
					throw new Exception ();
					// milestone
				if (! array_key_exists ( 'p2', $params ) || ! preg_match ( '/^(Y|N)$/', $params ['p2'] ))
					throw new Exception ();
					// currentEntity
				if (! array_key_exists ( 'p3', $params ) || $params ['p3'] == '')
					throw new Exception ();
					// currentStatus
				if (! array_key_exists ( 'p4', $params ) || $params ['p4'] == '')
					throw new Exception ();
					// detailUrlPattern
				if (! array_key_exists ( 'p5', $params ))
					throw new Exception ();
					// validStatus
				if (! array_key_exists ( 'p6', $params ) || ! preg_match ( '/^(Y|N)$/', $params ['p6'] ))
					throw new Exception ();
					// previous segment
				if (! array_key_exists ( 'p7', $params ) || ! preg_match ( '/\|/', $params ['p7'] ))
					throw new Exception ();
					// next segment
				if (! array_key_exists ( 'p8', $params ) || ! preg_match ( '/\|/', $params ['p8'] ))
					throw new Exception ();
					
					// split parameters
				$prevArray = explode ( '|', $params ['p7'] );
				$prevID = $prevArray [0];
				$prevName = $prevArray [1];
				$nextArray = explode ( '|', $params ['p8'] );
				$nextID = $nextArray [0];
				$nextName = $nextArray [1];
				
				$factory = Bonjour_Core_Model_Factory::getInstance ();
				$db = Bonjour_Core_Db_Connection::getConnection ( 'master' );
				if ($db == null) {
					throw new Exception ();
				}
				$factory->setDbAdapter ( $db );
				$factory->registGateway ( 'Workflow' );
				
				// begin transaction
				$db->beginTransaction ();
				try {
					$data = array (
							'segmentName' => $params ['p1'],
							'milestone' => $params ['p2'],
							'currentEntity' => $params ['p3'],
							'currentStatus' => $params ['p4'],
							'detailUrlPattern' => $params ['p5'],
							'validStatus' => $params ['p6'],
							'prevID' => $prevID,
							'prevName' => $prevName,
							'nextID' => $nextID,
							'nextName' => $nextName 
					);
					$currentID = $factory->__gateway ( 'Workflow' )->addSegment ( $data );
					if (intval ( $currentID ) == 0)
						throw new Exception ();
						// sysnchronise both the previous and the next segment information
					if ($prevID != 0) {
						$set = array (
								'nextID' => $currentID,
								'nextName' => $params ['p1'] 
						);
						$where ['segmentID=?'] = $prevID;
						$factory->__gateway ( 'Workflow' )->modifySegment ( $set, $where );
					}
					if ($nextID != 0) {
						$set = array (
								'prevID' => $currentID,
								'prevName' => $params ['p1'] 
						);
						$where ['segmentID=?'] = $nextID;
						$factory->__gateway ( 'Workflow' )->modifySegment ( $set, $where );
					}
					$db->commit ();
				} catch ( Exception $exp ) {
					$db->rollBack ();
					throw $exp;
				}
				echo Bonjour_Core_GlobalConstant::BONJOUR_SUCCESS;
			} catch ( Exception $e ) {
				// echo $e->getMessage ();
				echo Bonjour_Core_GlobalConstant::BONJOUR_ERROR;
			}
		}
	}
	
	/**
	 * 修改环节信息
	 */
	public function modifySegmentAction(){
		if ($this->_request->isPost ()) {
			$this->_helper->viewRenderer->setNoRender ( true );
			header ( 'content-type:text/html;charset=utf-8' );
			try {
				if (! isset ( $_SERVER ['HTTP_X_REQUESTED_WITH'] ) || strtolower ( $_SERVER ['HTTP_X_REQUESTED_WITH'] ) != 'xmlhttprequest') {
					throw new Exception ();
				}
				
				$params = $this->_request->getParams ();
				// segmentID
				if (! array_key_exists ( 'p0', $params ) || ! preg_match ( '/^(\d+)$/', $params ['p0'] ))
					throw new Exception ();
					// segmentName
				if (! array_key_exists ( 'p1', $params ))
					throw new Exception ();
					// milestone
				if (! array_key_exists ( 'p2', $params ) || ! preg_match ( '/^(Y|N)$/', $params ['p2'] ))
					throw new Exception ();
					// detailUrlPattern
				if (! array_key_exists ( 'p3', $params ))
					throw new Exception ();
					// validStatus
				if (! array_key_exists ( 'p4', $params ) || ! preg_match ( '/^(Y|N)$/', $params ['p4'] ))
					throw new Exception ();
				
				$factory = Bonjour_Core_Model_Factory::getInstance ();
				$db = Bonjour_Core_Db_Connection::getConnection ( 'master' );
				if ($db == null) {
					throw new Exception ();
				}
				$factory->setDbAdapter ( $db );
				$factory->registGateway ( 'Workflow' );
				
				// modify segment
				$set = array (
						'segmentName' => $params ['p1'],
						'milestone' => $params ['p2'],
						'detailUrlPattern' => $params ['p3'],
						'validStatus' => $params ['p4'] 
				);
				$where ['segmentID=?'] = $params ['p0'];
				$affected_rows = $factory->__gateway ( 'Workflow' )->modifySegment ( $set, $where );
				
				echo Bonjour_Core_GlobalConstant::BONJOUR_SUCCESS;
			} catch ( Exception $e ) {
				echo $e->getMessage ();
				echo Bonjour_Core_GlobalConstant::BONJOUR_ERROR;
			}
		}
	}
	/**
	 * 查询环节链表
	 * 添加是否显示有效的功能
	 */
	public function querySegmentListAction(){
		if ($this->_request->isPost ()) {
			$this->_helper->viewRenderer->setNoRender ( true );
			header ( 'content-type:text/html;charset=utf-8' );
			try {
				if (! isset ( $_SERVER ['HTTP_X_REQUESTED_WITH'] ) || strtolower ( $_SERVER ['HTTP_X_REQUESTED_WITH'] ) != 'xmlhttprequest') {
					throw new Exception ();
				}
				// If query invalid results
				$invalid = $this->_request->getParam ( 'invalid' );
				if (! isset ( $invalid ) || ! preg_match ( '/^[0-1]{1}$/', $invalid ))
					throw new Exception ();
				
				$factory = Bonjour_Core_Model_Factory::getInstance ();
				$db = Bonjour_Core_Db_Connection::getConnection ( 'slave' );
				if ($db == null) {
					throw new Exception ();
				}
				$factory->setDbAdapter ( $db );
				$factory->registGateway ( 'Workflow' );
				
				$rows = $factory->__gateway ( 'Workflow' )->querySegmentList ( $invalid );
				$total = count ( $rows );
				$callback = array (
						'Rows' => $rows,
						'Total' => $total 
				);
				
				echo Zend_Json::encode ( $callback );
			} catch ( Exception $e ) {
				echo $e->getMessage ();
				echo Bonjour_Core_GlobalConstant::BONJOUR_ERROR;
			}
		}
	}
	/**
	 * 查询节点清单快照
	 * @throws Exception
	 */
	public function querySegmentListSnapAction(){
		if ($this->_request->isPost ()) {
			$this->_helper->viewRenderer->setNoRender ( true );
			header ( 'content-type:text/html;charset=utf-8' );
			try {
				if (! isset ( $_SERVER ['HTTP_X_REQUESTED_WITH'] ) || strtolower ( $_SERVER ['HTTP_X_REQUESTED_WITH'] ) != 'xmlhttprequest') {
					throw new Exception ();
				}
		
				$factory = Bonjour_Core_Model_Factory::getInstance ();
				$db = Bonjour_Core_Db_Connection::getConnection ( 'slave' );
				if ($db == null) {
					throw new Exception ();
				}
				$factory->setDbAdapter ( $db );
				$factory->registGateway ( 'Workflow' );
		
				$rows = $factory->__gateway ( 'Workflow' )->querySegmentListSnap ();
				$total = count ( $rows );
				$callback = array (
						'Rows' => $rows,
						'Total' => $total
				);
		
				echo Zend_Json::encode ( $callback );
			} catch ( Exception $e ) {
				echo $e->getMessage ();
				echo Bonjour_Core_GlobalConstant::BONJOUR_ERROR;
			}
		}
	}
}

?>