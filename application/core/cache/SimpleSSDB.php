<?php

/**
 * All methods(except *exists) returns false on error,
 * so one should use Identical(if($ret === false)) to test the return value.
 */
class Bonjour_Core_Cache_SimpleSSDB{
	
	const KEY = 'Bonjour_Core_Cache_SimpleSSDB_Key';
	const CONFIG_KEY = 'cache';
	
	public static function getInstance($serverType, $serverName = null) {
		$key = self::KEY;
		if (! Zend_Registry::isRegistered ( $key )) {
			$config = Bonjour_Core_Config::getConfig ( self::CONFIG_KEY);
			$servers = $config['cache']['ssdb'][$serverType];
			
			$chosenServer = $serverName;
			
			if (null == $serverName) {
				// Load balancing algorithm
				$mtime = explode ( ' ', microtime () );
				$i = $mtime [1] % count ( $servers );
				$j = 0;
				foreach ( $servers as $key => $value ) {
					if ($i == $j ++) {
						$chosenServer = $key;
						break;
					}
				}
			}
			
			if (! array_key_exists ( 'timeout', $servers [$chosenServer] ))
				$servers [$chosenServer] ['timeout'] = 2000;
			
			$ssdb = new Bonjour_Core_Cache_SSDB ( $servers [$chosenServer] ['host'], $servers [$chosenServer] ['port'], $servers [$chosenServer] ['timeout'] );
			$ssdb->easy ();
			
			Zend_Registry::set ( $key, $ssdb );
		}
		
		return Zend_Registry::get ( $key );
	}

}

?>