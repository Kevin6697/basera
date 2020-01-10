<?php
	session_start();
	if(isset($_GET['area']))
	{
		require_once 'Host.php';
		$host = new HostController();
		$result=$host->cityFetch($_GET['area']);	
	}
	if(isset($_GET['action'])=="logout")
	{
		if(session_destroy())
		{
			echo "LoggedOut";		
		}
		else
		{
			echo "Error";
		}
	}
	if(isset($_GET['operation1'])=='deleteHouse')
	{
		require_once 'Host.php';
		$host = new HostController();
		$result=$host->deleteHouse($_GET['deleteId']);
		if($result)
		{
			echo"Deleted";
		}
		else
		{
			echo "Sorry, Cannot delete right now.Please try later!";
		}	
	}
	if(isset($_GET['operation1'])=='deleteImage')
	{
		require_once 'Host.php';
		$host = new HostController();
		$result=$host->deleteImage($_GET['deleteId']);
		if($result)
		{
			echo"Image Deleted";
		}
		else
		{
			echo "Sorry, Cannot delete right now.Please try later!";
		}	
	}	
	
?>
