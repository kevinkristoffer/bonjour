<?php


class Bonjour_Core_Controller_Plugin extends Zend_Controller_Plugin_Abstract {
	
	protected $_params = null;
	
	public function __construct()
	{
		// Get the class of plugin
		$class = get_class($this);
	
		// Try to read config file from plugin directory
		$pos = strrpos($class, '_');
		// 8 is length of Bonjour_
		$dir = strtolower(substr($class, 8, $pos - 8));
		$file = APPLICATION_PATH.DS.str_replace('_', DS, $dir).DS.'config.xml';
		if (!file_exists($file)) {
			return;
		}
		$this->_params = simplexml_load_file($file);
	}
	
	/**
	 * Call when user activate the plugin
	 */
	public function activate()
	{}
	
	/**
	 * Call when user deactivate the plugin
	 */
	public function deactivate()
	{}
	
	public function getParam($paramName)
	{
		if (null == $this->_params) {
			return null;
		}
		$xml = $this->_params->xpath("//param[@name='".addslashes($paramName)."']");
		return ($xml == null) ? null : $xml[0]->value;
	}
}

?>