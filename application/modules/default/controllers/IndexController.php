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
		parent::init();
	}
	/**
	 * Default action
	 */
	public function indexAction() {
		$authNamespace = new Zend_Session_Namespace ( 'Bonjour_Auth' );
		$currentUser=$authNamespace->currentUser;
		$this->view->assign ( 'currentUser', $currentUser );
		
		try {
			$factory=Bonjour_Core_Model_Factory::getInstance();
			$db=Bonjour_Core_Db_Connection::getConnection('slave');
			if($db == null)	throw new Exception();

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