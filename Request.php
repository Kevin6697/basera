<?php 
Class Request{
	public function getPost()
	{
		return $_POST;
	}
	public function getGet()
	{
		return $_GET;
	}
	public function getParam($key)
	{
		$response = (isset($_POST[$key])) ? $_POST[$key] : null; 
		return (is_null($response) && isset($_GET[$key]) ) ? $_GET[$key] : $response;
	}	
}
