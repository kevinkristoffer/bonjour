<?php

/**
 * 
 * system forums manager
 * @author hujianhong05
 *
 */

class ForumController extends Bonjour_Controller_Base {
	
	public function init(){}
	
	/**
	 * 查询有效的版块
	 */
	public function queryValidAction(){
		
		$this->_helper->viewRenderer->setNoRender ( true );
		header ( 'content-type:text/html;charset=utf-8' );
		
		if ($this->_request->isPost ()) {	
			try {
				if (! isset ( $_SERVER ['HTTP_X_REQUESTED_WITH'] ) || strtolower ( $_SERVER ['HTTP_X_REQUESTED_WITH'] ) != 'xmlhttprequest') {
					throw new Exception ();
				}
				//验证参数
				$menuID=$this->_request->getParam('mid');
				if(! isset($menuID) || ! preg_match('/^(\d+)$/', $menuID)){
					throw new Exception ();
				}
				
				$factory=Bonjour_Core_Model_Factory::getInstance();
				$db=Bonjour_Core_Db_Connection::getConnection('slave');
				if($db == null){
					$this->_redirect('error/db-disconnect');
					return;
				}
				$factory->setDbAdapter($db);
				$factory->registGateway('Forum');
			
				//查询某菜单下的有效板块
				$forums=$factory->__gateway('Forum')->queryValidForumByMenuID($menuID);
				
				echo Zend_Json::encode($forums);
			} catch (Exception $e) {
				$this->_redirect('error');
			}
		}else{
			$this->_redirect('error');
		}
	}
}

?>