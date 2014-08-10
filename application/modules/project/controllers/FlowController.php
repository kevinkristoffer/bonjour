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
	
	public function templateAction(){
		
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
				if (! array_key_exists ( 'p1', $params ))
					throw new Exception ();
					// milestone
				if (! array_key_exists ( 'p2', $params ) || ! preg_match ( '/^[0-1]{1}$/', $params ['p2'] ))
					throw new Exception ();
					// currentEntity+currentStatus
				if (! array_key_exists ( 'p3', $params ) || ! preg_match ( '/\|/', $params ['p3'] ))
					throw new Exception ();
					// detailUrlPattern
				if (! array_key_exists ( 'p4', $params ))
					throw new Exception ();
				
				$factory = Bonjour_Core_Model_Factory::getInstance ();
				$db = Bonjour_Core_Db_Connection::getConnection ( 'master' );
				if ($db == null) {
					throw new Exception ();
				}
				$factory->setDbAdapter ( $db );
				$factory->registGateway ( 'Workflow' );
				
				$temp_array = explode ( '|', $params ['p3'] );
				$currentEntity = $temp_array [0];
				$currentStatus = $temp_array [1];
				
				$order_expr = "select case when max(segmentOrder) is null then 1 else max(segmentOrder)+1 end maxOrder from bonjour_workflow_template";
				$data = array (
						'segmentName' => $params ['p1'],
						'segmentOrder' => new Zend_Db_Expr ( $order_expr ),
						'milestone' => $params ['p2'],
						'currentEntity' => $currentEntity,
						'currentStatus' => $currentStatus,
						'detailUrlPattern' => $params ['p4'] 
				);
				$affected_rows = $factory->__gateway ( 'Workflow' )->addTemplate ( $data );
				if ($affected_rows != 1)
					throw new Exception ();
				
				echo Bonjour_Core_GlobalConstant::BONJOUR_SUCCESS;
			} catch ( Exception $e ) {
				echo $e->getMessage ();
				echo Bonjour_Core_GlobalConstant::BONJOUR_ERROR;
			}
		}
	}
	
}

?>