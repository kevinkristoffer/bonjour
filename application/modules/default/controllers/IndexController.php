<?php
/**
 * Default controller
 * @author hujianhong05
 *
 */
class IndexController extends Bonjour_Controller_Base {
	/**
	 * Constructor
	 * 
	 * @see Bonjour_Controller_Base::init()
	 */
	public function init() {
		
	}
	/**
	 * Default action
	 */
	public function indexAction() {
		/*$this->initSession ();
		$authNamespace = new Zend_Session_Namespace ( 'Bonjour_Auth' );
		$guest = array (
				'useid' => 0,
				'username' => '游客' 
		);
		$currentUser = $authNamespace->currentUser ? $authNamespace->currentUser : '游客';
		$this->view->assign ( 'currentUser', $currentUser );*/
		try {
			$factory=Bonjour_Core_Model_Factory::getInstance();
			$db=Bonjour_Core_Db_Connection::getConnection('slave');
			if($db == null){
				$this->_redirect('error/db-disconnect');
				return;
			}
			$factory->setDbAdapter($db);
			$factory->registGateway('Menu');
			
			//查询全部有效菜单
			$menus=$factory->__gateway('Menu')->queryAllValidMenu();
			
			//设置视图层
			$this->view->assign('menus',$menus);
			
		} catch (Exception $e) {
			$this->_redirect('error');
		}
	}
	
	/**
	 * 欢迎页面
	 */
	public function welcomeAction(){
		
	}
	
}

?>