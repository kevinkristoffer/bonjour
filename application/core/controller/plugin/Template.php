<?php

/**
 * Template plugin
 * @author hujianhong05
 *
 */
class Bonjour_Core_Controller_Plugin_Template extends Zend_Controller_Plugin_Abstract {
	/**
	 * (non-PHPdoc)
	 *
	 * @see Zend_Controller_Plugin_Abstract::preDispatch()
	 */
	public function preDispatch(Zend_Controller_Request_Abstract $request) {
		
// 		$module = $request->getModuleName ();
// 		$controller = $request->getControllerName ();
// 		$action = $request->getActionName ();
		
		
// 		// Check if we are in modules or widgets folder
// 		$viewRenderer = Zend_Controller_Action_HelperBroker::getStaticHelper ( 'viewRenderer' );
		
// 		if (null === $viewRenderer->view) {
// 			$viewRenderer->initView ();
// 		}
// 		$view = $viewRenderer->view;
		
// 		$path1 = APPLICATION_PATH . DS . 'modules' . DS . $module . DS . 'views';
// 		$file1 = $path1 . DS . 'scripts' . DS . $controller . DS . $action . '.phtml';
// 		$path2 = APPLICATION_PATH . DS . 'templates' . DS . $module . DS . 'views';
// 		$file2 = $path2 . DS . 'scripts' . DS . $controller . DS . $action . '.phtml';
		
// 		/**
// 		 * TODO: Try to find the script in template first
// 		 */
// 		if (! file_exists ( $file1 ) && file_exists ( $file2 )) {
// 			$view->setScriptPath ( $path2 . DS . 'scripts' . DS ); // 2.0.1
// 			// Add helper path for template
// 			if (file_exists ( $path2 . DS . 'helpers' )) {
// 				$view->addHelperPath ( $path2 . DS . 'helpers', $module . '_View_Helper_' );
// 			}
// 		}
	}
}

?>