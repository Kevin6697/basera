<?php
// echo $_GET['houseid'];
	session_start();
	if(empty($_SESSION['adminId']) && $_SESSION['role']!="admin")
  	{
     header("location:index.php");
 	}

  	include('controller.php');

	$obj= new Controller();
	$result=$obj->verifyHouse($_GET['houseid']);
	if ($result==TRUE) 
	{
		header("location:unverifiedHouse.php");
	}
	else
	{
		echo"Try again";
		echo $this->con->error;
	}
?>