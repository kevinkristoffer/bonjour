<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
	/**
	 * Retrieve a resource from the container.
	 *
	 * If the requested resource is a callable it will be exectued and the
	 * result from the callable is returned instead of the callable itself.
	 *
	 * @see Zend_Application_Bootstrap_BootstrapAbstract::getResource()
	 */
	public function getResource($name) {
		$resource = parent::getResource($name);
	
		if (is_callable($resource)) {
			return $resource();
		} else if ($resource !== null) {
			return $resource;
		}
	}
	
	/**
	 * Method for creating closures which lazyload the resource.
	 *
	 * Creates an closure which will create the resource when called
	 * and caches this resource so only one instance is created.
	 *
	 * @param callback $callable Callback which is able to create the resource.
	 * @return mixed The instantiated resource, usually an object.
	 */
	private function lazyload($callable) {
		return function () use ($callable) {
			static $object;
			if (is_null($object)) {
				$object = $callable();
			}
	
			return $object;
		};
	}
	/**
	 * Autolaod the class
	 * 
	 * @return Zend_Loader_Autoloader
	 */
	protected function _initAutoload(){
		require_once APPLICATION_PATH.'/core/Autoloader.php';
		$autoloader = Zend_Loader_Autoloader::getInstance();
		$autoloader->unshiftAutoloader(new Bonjour_Core_Autoloader(), 'Bonjour');
		return $autoloader;
	}
	/**
	 * Register controller plugins
	 * 1,Template Plugin
	 */
	protected function _initPlugins(){
		$this->bootstrap('FrontController');
		$front=$this->getResource('FrontController');
		$front->registerPlugin(new Bonjour_Core_Controller_Plugin_Template());
	}
	/**
	 * Setup our session manager
	 * 
	 * delay load
	 *
	 * @return Zend_Session_Namespace Default namespace ‘default’
	 */
	protected function _initSession()
	{
		$sessionConfig=null;//default configure
		return $this->lazyload ( function () use($sessionConfig) {
			$config = new Zend_Config_Ini(APPLICATION_PATH.'/configs/cache.ini',APPLICATION_ENV);
			$servers=$config->memcached->servers->toArray();
			$sessionConfig = array(
					'memcached'=> $servers ,
					'lifetime' => 600
			);
			$sessionSaveHandler = new Zend_Session_SaveHandler_Memcached ( $sessionConfig );
			Zend_Session::setSaveHandler ( $sessionSaveHandler );
			
			Zend_Session::start ();
			
			$sessionDefault = new Zend_Session_Namespace ( 'default' );
			// Zend_Registry::getInstance()->session = $sessionDefault;
			return $sessionDefault;
		} );
	}
}

