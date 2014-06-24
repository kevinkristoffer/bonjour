<?php
class Bonjour_Core_Model_Factory {
	private static $factory;
	private $db;
	private $gatewayContainer;
	private function __construct() {
		$this->gatewayContainer = array ();
	}
	public static function getInstance() {
		if (! self::$factory instanceof self) {
			self::$factory = new self ();
		}
		
		return self::$factory;
	}
	public function setDbAdapter($db) {
		$this->db = $db;
	}
	public function registGateway($alias) {
		if (! isset ( $this->gatewayContainer [$alias] ) || $this->gatewayContainer [$alias] == null) {
			$gatewayName = 'Bonjour_Model_' . $alias . 'Gateway'; // 类名
			
			$ref = new Zend_Reflection_Class ( $gatewayName );
			$instance = $ref->newInstance ( $this->db );
			$this->gatewayContainer [$alias] = $instance;
		}
		
		return self::$factory;
	}
	public function __gateway($alias) {
		if (isset ( $this->gatewayContainer [$alias] )) {
			
			return $this->gatewayContainer [$alias];
		}
		return null;
	}
}

?>