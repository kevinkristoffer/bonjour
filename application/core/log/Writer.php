<?php
/**
 * 日志类
 * @author hujianhong05
 *
 */
class Bonjour_Core_Log_Writer {
	
	private static $columnMapping = array (
			'priority' => 'priority',
			'priorityName' => 'priorityName',
			'message' => 'message',
			'createTime' => 'timestamp' 
	);
	
	private static $table = 'bonjour_log';
	
	private static $timestampFormat = 'YmdHis';
	
	public static function getLogger($db) {
		$writer = new Zend_Log_Writer_Db ( $db, self::$table, self::$columnMapping );
		$logger = new Zend_Log ( $writer );
		$logger->setTimestampFormat ( self::$timestampFormat );
		return $logger;
	}
	
	
}

?>