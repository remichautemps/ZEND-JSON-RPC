<?php

/**
 * Wsserver_IndexController
 *  
 * @author remi chautemps
 * @version 1.0
 */

class Wsserver_IndexController extends Zend_Controller_Action 
{
	protected $_url = "http://localhost:8888/ZEND-JSON-RPC/public/wsserver/index/json/";
	public function init()
	{
		$this->_helper->layout()->disableLayout();
		$this->_helper->viewRenderer->setNoRender(true);
	}
	
	/**
	 * JSON SERVER
	 */
	public function jsonAction()
	{
		$server = new Zend_Json_Server();
		$server->setClass('My_Application_Model_Data');
		if ('GET' == $_SERVER['REQUEST_METHOD']) {
			$server->setTarget($this->_url)->setEnvelope(Zend_Json_Server_Smd :: ENV_JSONRPC_2);
			$smd = $server->getServiceMap();
			header('Content-Type: application/json');
			echo $smd;
			return;
		}
		echo $server->handle();
	}
}
