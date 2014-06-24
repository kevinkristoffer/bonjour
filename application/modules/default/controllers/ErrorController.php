<?php
/**
 * 
 * 错误页面
 * @author hujianhong05
 *
 */
class ErrorController extends Bonjour_Controller_Base{
	
	public function init(){
		
	}
	/**
	 * 默认出错页面
	 */
	public function indexAction(){
		$this->_helper->viewRenderer->setNoRender ( true );
		header ( 'content-type:text/html;charset=utf-8' );
		echo '页面出错了！';
	}
	/**
	 * 数据库无法连接
	 */
	public function dbDisconnectAction(){
		$this->_helper->viewRenderer->setNoRender ( true );
		header ( 'content-type:text/html;charset=utf-8' );
		echo '数据库无法连接！';
	}
}

?>