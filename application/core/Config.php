<?php
/**
 * Config
 * @author hujianhong05
 *
 */
class Bonjour_Core_Config {
	/**
	 * Get the Ini Configurations
	 * 
	 * @param string $key        	
	 */
	public static function getConfig($key = null) {
		if ($key == null) {
			$key = 'application';
		}
		
		if (!Zend_Registry::isRegistered ( $key )) {
			$currentConfig = APPLICATION_PATH . DS . 'configs' . DS . $key . '.ini';
			$defaultConfig = APPLICATION_PATH . DS . 'configs' . DS . 'application.ini';
			$file = file_exists ( $currentConfig ) ? $currentConfig : $defaultConfig;
			$config = new Zend_Config_Ini ( $file, APPLICATION_ENV );
			Zend_Registry::set($key, $config);
		}
		return Zend_Registry::get($key);
	}
}

?>