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
			$cachedConfigFile = APPLICATION_PATH . '/configs/'.$key.'.ini.php';
			
			if (! file_exists ( $cachedConfigFile ) || filemtime ( $cachedConfigFile ) < filemtime ( APPLICATION_PATH . '/configs/'.$key.'.ini' )) {
				require_once 'Zend/Config/Ini.php';
				$config = new Zend_Config_Ini ( APPLICATION_PATH . '/configs/'.$key.'.ini', APPLICATION_ENV );
				file_put_contents ( $cachedConfigFile, '<?php ' . PHP_EOL . 'return ' . var_export ( $config->toArray (), true ) . ';' );
			}
			
			$config=require($cachedConfigFile);
			
			Zend_Registry::set($key, $config);
		}
		
		return Zend_Registry::get($key);
	}
}

?>