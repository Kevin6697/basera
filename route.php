<?php
function __autoload($classname) {
   $filename = $classname .".php";
   include_once($filename);
}



class RouteController{
	protected $_request = null;
	protected $_response = null;
	public function __construct()
	{
		$controllerName = $this->getRequest()->getParam('c'); 
		$methodName = $this->getRequest()->getParam('m');
		$controller = new  $controllerName();
		$this->_response = $controller->$methodName();
		$this->getResponse();
	}
	public function getResponse()
	{
		echo json_encode($this->_response);
	}
	public function getRequest()
	{
		if(is_null($this->_request))
		{
			$this->_request = new Request();
		}
		return $this->_request; 
	}
}

$ob = new RouteController();	