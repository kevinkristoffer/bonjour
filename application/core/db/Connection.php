<?php
/**
 * 
 * @author Administrator
 *
 */
class Bonjour_Core_Db_Connection {
	const KEY = 'Bonjour_Core_Db_Connection_Key';
	const PREFIX_KEY = 'Bonjour_Core_Db_Connection_TablePrefix';
	const DEFAULT_PREFIX = 't_';
	const DEFAULT_SERVERTYPE = 'master';
	const DEFAULT_SERVERNAME = 'server1'; // if connection die down default will worked
	const CONFIG_KEY = 'database';
	
	public static function getConnection($type = null) {
		$type = null == $type ? self::DEFAULT_SERVERTYPE : $type;
		$conn = self::_getConnection ( $type );
		
		if (! $conn->isConnected ())
			$conn = self::_getConnection ( $type, self::DEFAULT_SERVERNAME );
		
		return $conn->isConnected () ? $conn : null;
	}
	
	/**
	 * get table prefix
	 *
	 * @return mixed
	 */
	public static function getDbPrefix() {
		if (! Zend_Registry::isRegistered ( self::PREFIX_KEY )) {
			$config = Bonjour_Core_Config::getConfig ( self::CONFIG_KEY);
			$prefix = (null == $config['db']['prefix']) ? self::DEFAULT_PREFIX : $config['db']['prefix'];
			Zend_Registry::set ( self::PREFIX_KEY, $prefix );
		}
		
		return Zend_Registry::get ( self::PREFIX_KEY );
	}
	
	/**
	 *
	 * @param unknown $type        	
	 * @return Zend_Db_Adapter_Abstract
	 */
	private static function _getConnection($serverType, $serverName = null) {
		$key = self::KEY . '_' . $serverType;
		if (! Zend_Registry::isRegistered ( $key )) {
			$config = Bonjour_Core_Config::getConfig ( self::CONFIG_KEY);
			$servers = $config['db'][$serverType];
			
			// Connect to random server
			// $servers = $servers->toArray();
			// $randomServer = array_rand($servers);
			
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
			
			// Get database prefix
			$prefix = (null == $config['db']['prefix']) ? self::DEFAULT_PREFIX : $config['db']['prefix'];
			
			$servers [$chosenServer] ['prefix'] = $prefix;
			
			$db = Zend_Db::factory ( $config['db']['adapter'], $servers [$chosenServer] );
			
			$db->setFetchMode ( Zend_Db::FETCH_OBJ );
			$db->query ( "SET CHARACTER SET 'utf8'" );
			
			Zend_Registry::set ( $key, $db );
		}
		return Zend_Registry::get ( $key );
	}
}

?>