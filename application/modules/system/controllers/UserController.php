<?php
class System_UserController extends Bonjour_Controller_Base {
	
	/**
	 * Constructor
	 *
	 * @see Bonjour_Controller_Base::init()
	 */
	public function init() {
	}
	/**
	 * 查询全部用户
	 */
	public function queryAllUserAction(){
		
	}
	/**
	 * 分页查询全部有效用户
	 */
	public function queryValidUserAction() {
		if ($this->_request->isPost ()) {
			$this->_helper->viewRenderer->setNoRender ( true );
			header ( 'content-type:text/html;charset=utf-8' );
			try {
				if (! isset ( $_SERVER ['HTTP_X_REQUESTED_WITH'] ) || strtolower ( $_SERVER ['HTTP_X_REQUESTED_WITH'] ) != 'xmlhttprequest') {
					throw new Exception ();
				}
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
				$factory->registGateway ( 'User' );
				// 查询
				$total = $factory->__gateway ( 'User' )->countValidUser ( $keyword );
				$rows = $factory->__gateway ( 'User' )->queryValidUser ( $pagesize * ($page - 1), $pagesize, $keyword );
				$callback = array (
						'Rows' => $rows,
						'Total' => $total 
				);
				
				echo Zend_Json::encode ( $callback );
			} catch ( Exception $e ) {
				echo Bonjour_Core_GlobalConstant::BONJOUR_ERROR;
			}
		} else {
			$this->_redirect ( 'error' );
		}
	}
}

?>