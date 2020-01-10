<?php
    //echo "asdf";
include 'controller.php';
session_start();

$admin = new Controller();
if(isset($_GET['action']))
{
	if($_GET['action']=="logout")
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
	
}
if(isset($_GET['operation1']))
{
	if($_GET['operation1']=='deleteCustomer')
	{
		
			//echo $_GET['deleteId'];
		$result=$admin->deleteCustomer($_GET['deleteId']);
		if ($result) 
		{
			echo "Deleted";
		}
		else
		{
			echo "Try Again";
		}
		
	}

	if($_GET['operation1']=='deleteHouseOwner')
	{
		$result=$admin->deleteHouseOwner($_GET['deleteId']);
		if($result)
		{
			echo "Deleted";
			//header("location:verifiedhouse.php");
		}
		else
		{
			echo"Try again";
			//echo $this->con->error;
		}
	}
	// if(isset($_GET['oid']))
	// {
 //  		$admin->deleteHouseOwner($_GET['oid']);
	// }
	if($_GET['operation1']=='deleteArea')
	{
		$result=$admin->deleteArea($_GET['deleteId']);
		if($result)
		{
			echo "Deleted";
			//header("location:verifiedhouse.php");
		}
		else
		{
			echo"Try again";
			//echo $this->con->error;
		}
	}
	if($_GET['operation1']=='deleteCity')
	{
		$result=$admin->deletecity($_GET['deleteId']);
		if($result)
		{
			echo "Deleted";
			//header("location:verifiedhouse.php");
		}
		else
		{
			echo"Try again";
			//echo $this->con->error;
		}
	}
	if($_GET['operation1']=='deleteState')
	{
		$result=$admin->deleteState($_GET['deleteId']);
		if($result)
		{
			echo "Deleted";
			//header("location:verifiedhouse.php");
		}
		else
		{
			echo"Try again";
			//echo $this->con->error;
		}
	}
	if($_GET['operation1']=='deleteAmenities')
	{
		$result=$admin->deleteAminities($_GET['deleteId']);
		if ($result) 
		{
			echo "Deleted";
		}
		else
		{
			echo "Try Again";
		}
	}
	if($_GET['operation1']=='deleteHouse')
	{
		//echo $_GET['deleteId']."haouseId";
		$result=$admin->deleteHouse($_GET['deleteId']);
		if($result)
		{
			echo "Deleted";
			//header("location:verifiedhouse.php");
		}
		else
		{
			echo"Try again";
			//echo $this->con->error;
		}
	}
	if($_GET['operation1']=='deleteBookings')
	{
		
		//echo $_GET['deleteId'];
		$result=$admin->deleteBookings($_GET['deleteId']);
		if ($result) 
		{
			echo "Deleted";
		}
		else
		{
			echo "Try Again";
		}
		
	}
	if($_GET['operation1']=='deleteDamages')
	{
		
		//echo $_GET['deleteId'];
		$result=$admin->deleteDamages($_GET['deleteId']);
		if ($result) 
		{
			echo "Deleted";
		}
		else
		{
			echo "Try Again";
		}
		
	}
	if($_GET['operation1']=='deleteNearPlace')
	{
		$result=$admin->deleteNearPlace($_GET['deleteId']);
		if($result)
		{
			echo "Deleted";
			//header("location:verifiedhouse.php");
		}
		else
		{
			echo"Try again";
			//echo $this->con->error;
		}
	}

	if($_GET['operation1']=='deleteOrders')
	{
		
		//echo $_GET['deleteId'];
		$result=$admin->deleteOrders($_GET['deleteId']);
		if ($result) 
		{
			echo "Deleted";
		}
		else
		{
			echo "Try Again";
		}
		
	}
}	
?>