<?php
	if(isset($_GET['operation1'])=='ConfirmBooking')
	{
		require_once 'Host.php';
		$host = new HostController();
		$result=$host->ConfirmBooking($_GET['ConfirmId'],'Confirm');
		if($result=="Success")
		{
			echo"Confirm";
		}
		else
		{
			echo "Sorry, Cannot book right now.Please try later!";
		}	
	}
	if(isset($_GET['deleteOperation'])=='deleteOperation')
	{
		require_once 'Host.php';
		$host = new HostController();
		$result=$host->deleteDamage($_GET['DeleteId']);
		if($result=="Success")
		{
			echo"Deleted";
		}
		else
		{
			echo "Sorry, Cannot book right now.Please try later!";
		}	
	}

?>