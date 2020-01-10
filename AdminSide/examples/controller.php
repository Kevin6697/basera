<?php 
class Controller
{
	private $host="localhost";
	private $username="root";
	private $password="";
	private $db="basera";
	private $con;
	function __construct()
	{
		$this->con = $this->connectDB();
		
	}

	function connectDB()
	{
		$con=mysqli_connect($this->host,$this->username,$this->password,$this->db);
		return $con;
		
	}

	function loginCheck()
	{
		extract($_POST);
			//$txtPassword=$txtPassword;
		echo $query="select * from admin_master where admin_email='$txtEmail' and admin_password ='$txtPassword'";
		if(!$result=mysqli_query($this->con,$query))
		{
			$_SESSION['emailError']=$txtEmail;
			$_SESSION['Invalid']= mysqli_error($this->con);
				// header("Location: index.php");
		}
		else
		{
			if(mysqli_num_rows($result)>0)
			{
				while ($data=mysqli_fetch_assoc($result)) 
				{
					$_SESSION['adminId']=$data['admin_id'];
					$_SESSION['adminEmail']=$data['admin_email'];
					$_SESSION['role']="admin";
					header("Location: dashboard.php");
				}
			}
			else
			{

				$_SESSION['emailError']=$txtEmail;
				$_SESSION['Invalid']="Invalid Login Credentials ";
				header("Location: index.php");
			}
		}
	}

	function allCustomers()
	{
		if ($this->con->connect_error) 
		{
			die("Connection failed: " . $this->con->connect_error);
		} 

		$sql = "SELECT * FROM customer_master";
		$result = $this->con->query($sql);
		return $result;
	}

	function allOwners()
	{
		if ($this->con->connect_error) 
		{
			die("Connection failed: " . $this->con->connect_error);
		} 

		$sql = "SELECT * FROM owner_master";
		$result = $this->con->query($sql);
		return $result;
	}
	function verifiedHouseDetails()
	{
		if ($this->con->connect_error) 
		{
			die("Connection failed: " . $this->con->connect_error);
		} 

		$sql = "SELECT HouseId,HouseName FROM house_master WHERE IsHouseVerified=1";
		$result = $this->con->query($sql);
		return $result;
	}
	
	function unverifiedHouseDetails()
	{
		if ($this->con->connect_error) 
		{
			die("Connection failed: " . $this->con->connect_error);
		} 

		$sql = "SELECT HouseId,HouseName FROM house_master WHERE IsHouseVerified=0";
		$result = $this->con->query($sql);
		return $result;
	}
	
	function allAmenities()
	{
		if ($this->con->connect_error) 
		{
			die("Connection failed: " . $this->con->connect_error);
		} 
		$sql = "SELECT * FROM aminities_master";
		$result = $this->con->query($sql);
		return $result;
	}

	function allDamages()
	{
		if ($this->con->connect_error) 
		{
			die("Connection failed: " . $this->con->connect_error);
		} 
		$sql = "SELECT ItemName, ItemDescription, Image, Price, CheckOutDate ,CustFirstName, CustLastName, HouseName, CityName FROM damage_master, booking_master, customer_master, house_master,area_master,city_master WHERE damage_master.BookingId= booking_master.BookingId AND booking_master.CustId=customer_master.CustId AND booking_master.HouseId=house_master.HouseId AND house_master.AreaId= area_master.AreaId AND area_master.CityId= city_master.Cityid";
		$result = $this->con->query($sql);
		return $result;
	}


	function allAreas()
	{
		if ($this->con->connect_error) 
		{
			die("Connection failed: " . $this->con->connect_error);
		} 

		$sql = "SELECT * FROM area_master,city_master,state_master WHERE area_master.Cityid = city_master.Cityid AND city_master.StateId = state_master.StateId";
		$result = $this->con->query($sql);
		return $result;
	}

	function allCities()
	{
		if ($this->con->connect_error) 
		{
			die("Connection failed: " . $this->con->connect_error);
		} 

		$sql = "SELECT * FROM city_master,state_master WHERE city_master.StateId = state_master.StateId";
		$result = $this->con->query($sql);
		return $result;
	}

	function allStates()
	{
		if ($this->con->connect_error) 
		{
			die("Connection failed: " . $this->con->connect_error);
		} 

		$sql = "SELECT * FROM state_master ";
		$result = $this->con->query($sql);
		return $result;
	}

	function perticularCustomer($custId)
	{
		if ($this->con->connect_error) 
		{
			die("Connection failed: " . $this->con->connect_error);
		} 
		$sql = "SELECT * FROM customer_master WHERE CustId = $custId";
		$result = $this->con->query($sql);
		return $result;
	}

	function insertCustomer()
	{
	
		extract($_POST);
		$password=sha1($password);
		echo $sql ="INSERT INTO customer_master ( CustFirstName , CustLastName , CustEmail , CustPassword , CustNumber ) VALUES ('$firstName','$lastName','$email', '$password' ,$mobNo)";
		$result = $this->con->query($sql);
		// echo "flag2";
		// $target_dir = "Basera/uploads/";
		// echo "flag3";
		// $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
		// echo "flag4";
		// $uploadOk = 1;
		// echo "flag5";
		// $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
		// echo "flag6";
		// // Check if image file is a actual image or fake image
		
		//     $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
		//     echo "flag7";
		//     if($check !== false) {
		//     	echo "flag8";
		//         //return "File is an image - " . $check["mime"] . ".";
		//         // echo "flag9";
		//         $uploadOk = 1;
		//         // echo "flag10";
		//     } 
		//     else {
		//     	// echo "flag12";
		//         //return "File is not an image.";
		//         // echo "flag13";
		//         $uploadOk = 0;
		//         // echo "flag14";
		//     }
		// echo "flag15";
		// // Check if file already exists
		 
		
		// 	echo "flag27";
		//     if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) 
		//     {
		//     	echo "flag28";
		//     	$custKYC = basename($_FILES["fileToUpload"]["name"]);
		//     	echo "flag29";
		//     	echo $query = "UPDATE customer_master SET CustKYC='$custKYC', KYC_Status=1 WHERE CustEmail = '$email'";
		//     	echo "flag30";
		//     	$result1 = mysqli_query($this->con,$query);
		//     	echo "flag31";
		//         return "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
		//     } else {
		//     	echo "flag32";
		//         return "Sorry, there was an error uploading your file.";
		//     }
		//     echo "flag33";
		

		if($result==TRUE )
		{
			//echo"Updated";
			header("location:customer.php");
		}
		else
		{
			echo"Try again";
			echo $this->con->error;
			//header("location:customer.php");
		}
	}

	function updateCustomer()
	{
		if ($this->con->connect_error) 
		{
    		die("Connection failed: " . $this->con->connect_error);
		} 
		extract($_POST);
		$sql = "UPDATE customer_master SET CustFirstName = '$firstName',CustLastName = '$lastName',CustEmail = '$email', CustNumber = $mobNo WHERE CustId = $custId";
		$result = $this->con->query($sql);
		if($result==TRUE)
		{
			//echo"Updated";
			header("location:customer.php");
		}
		else
		{
			echo"Try again";
			echo $this->con->error;
			//header("location:customer.php");
		}
	}

	function deleteCustomer($cid)
	{
		if ($this->con->connect_error)
		{
			die("Connection failed: " . $this->con->connect_error);
		}
		$sql = "DELETE FROM customer_master WHERE CustId = $cid";
		$result = $this->con->query($sql);
		return $result;
	}

	function perticularHouseOwner($ownerId)
	{
		if ($this->con->connect_error) 
		{
			die("Connection failed: " . $this->con->connect_error);
		} 
		$sql = "SELECT * FROM owner_master WHERE OwnerId = $ownerId";
		$result = $this->con->query($sql);
		return $result;
	}

	function insertHouseOwner()
	{
		if ($this->con->connect_error) 
		{
    		die("Connection failed: " . $this->con->connect_error);
		} 
		extract($_POST);
		$password=sha1($password);
		$sql = "INSERT INTO owner_master ( OwnerFirstName , OwnerLastName, OwnerEmail, OwnerPassword, OwnerNumber ) VALUES ( '$firstName','$lastName', '$email','$password' , $mobNo )";
		$result = $this->con->query($sql);
		if($result==TRUE)
		{
			//echo"Updated";
			header("location:houseOwner.php");
		}
		else
		{
			echo"Try again";
			echo $this->con->error;
			//header("location:customer.php");
		}
	}

	function updateHouseOwner()
	{
		if ($this->con->connect_error) 
		{
    		die("Connection failed: " . $this->con->connect_error);
		} 
		extract($_POST);
		$sql = "UPDATE owner_master SET OwnerFirstName = '$firstName',OwnerLastName = '$lastName',OwnerEmail = '$email', OwnerNumber = $mobNo WHERE OwnerId = $ownerId";
		$result = $this->con->query($sql);
		if($result==TRUE)
		{
			//echo"Updated";
			header("location:houseOwner.php");
		}
		else
		{
			echo"Try again";
			echo $this->con->error;
			//header("location:customer.php");
		}
	}

	function deleteHouseOwner($oid)
	{
		//echo"dalete".$oid;
		if ($this->con->connect_error) 
		{
			die("Connection failed: " . $this->con->connect_error);
		}
		$sql = "DELETE FROM owner_master WHERE OwnerId = $oid";
		$result = $this->con->query($sql);
		return $result;
	}

	function insertArea()
	{	
		if ($this->con->connect_error) 
		{
			die("Connection failed: " . $this->con->connect_error);
		} 
		extract($_POST);
		$sql="INSERT INTO area_master (AreaName, CityId) VALUES ('$areaName',$cityId)";
		$result = $this->con->query($sql);
		if($result==TRUE)
		{
			//echo"Updated";
			header("location:area.php");
		}
		else
		{
			echo"Try again";
			echo $this->con->error;
			//header("location:customer.php");
		}
	}

	function perticularArea($aId)
	{
		if ($this->con->connect_error) 
		{
			die("Connection failed: " . $this->con->connect_error);
		} 
		$sql = "SELECT * FROM area_master WHERE AreaId = $aId";
		$result = $this->con->query($sql);
		return $result;
	}

	function updateArea()
	{
		if ($this->con->connect_error) 
		{
			die("Connection failed: " . $this->con->connect_error);
		} 
		extract($_POST);
		$sql = "UPDATE area_master SET AreaName = '$areaName',Cityid = '$cityId' WHERE AreaId = $areaId";
		$result = $this->con->query($sql);
		if($result==TRUE)
		{
			//echo"Updated";
			header("location:area.php");
		}
		else
		{
			echo"Try again";
			echo $this->con->error;
		}
	}
	function deleteArea($aid)
	{
		if ($this->con->connect_error) 
		{
			die("Connection failed: " . $this->con->connect_error);
		}
		//echo"dalete".$oid;
		$sql = "DELETE FROM area_master WHERE AreaId = $aid";
		$result = $this->con->query($sql);
		return $result;
	}

	function insertCity()
	{	
		if ($this->con->connect_error) 
		{
			die("Connection failed: " . $this->con->connect_error);
		} 
		extract($_POST);
		$sql="INSERT INTO city_master (CityName, StateId) VALUES ('$cityName',$stateId)";
		$result = $this->con->query($sql);
		if($result==TRUE)
		{
			//echo"Updated";
			header("location:city.php");
		}
		else
		{
			echo"Try again";
			echo $this->con->error;
		}
	}

	function perticularCity($cityId)
	{
		if ($this->con->connect_error) 
		{
			die("Connection failed: " . $this->con->connect_error);
		} 
		$sql = "SELECT * FROM city_master WHERE CityId = $cityId";
		$result = $this->con->query($sql);
		return $result;
	}

	function updateCity()
	{
		if ($this->con->connect_error) 
		{
			die("Connection failed: " . $this->con->connect_error);
		} 
		extract($_POST);
		$sql = "UPDATE city_master SET CityName = '$cityName',StateId = '$stateId' WHERE CityId = $cityId";
		$result = $this->con->query($sql);
		if($result==TRUE)
		{
			//echo"Updated";
			header("location:city.php");
		}
		else
		{
			echo"Try again";
			echo $this->con->error;
		}
	}
	function deleteCity($cityid)
	{
		if ($this->con->connect_error) 
		{
			die("Connection failed: " . $this->con->connect_error);
		}
		$sql = "DELETE FROM city_master WHERE CityId = $cityid";
		$result = $this->con->query($sql);
		return $result;
	}

	function insertState()
	{	
		if ($this->con->connect_error) 
		{
			die("Connection failed: " . $this->con->connect_error);
		} 
		extract($_POST);
		$sql="INSERT INTO state_master (StateName ) VALUES ('$stateName')";
		$result = $this->con->query($sql);
		if($result==TRUE)
		{
			//echo"Updated";
			header("location:states.php");
		}
		else
		{
			echo"Try again";
			echo $this->con->error;
		}
	}

	function perticularState($stateId)
	{
		if ($this->con->connect_error) 
		{
			die("Connection failed: " . $this->con->connect_error);
		} 
		$sql = "SELECT * FROM state_master WHERE StateId = $stateId";
		$result = $this->con->query($sql);
		return $result;
	}

	function updateState()
	{
		if ($this->con->connect_error) 
		{
			die("Connection failed: " . $this->con->connect_error);
		} 
		extract($_POST);
		$sql = "UPDATE state_master SET StateName = '$stateName' WHERE StateId = $stateId";
		$result = $this->con->query($sql);
		if($result==TRUE)
		{
			//echo"Updated";
			header("location:states.php");
		}
		else
		{
			echo"Try again";
			echo $this->con->error;
		}
	}
	function deleteState($stateid)
	{
		if ($this->con->connect_error) 
		{
			die("Connection failed: " . $this->con->connect_error);
		}
		$sql = "DELETE FROM state_master WHERE StateId = $stateid";
		$result = $this->con->query($sql);
		return $result;
	}

	function insertAminity()
	{	
		if ($this->con->connect_error) 
		{
			die("Connection failed: " . $this->con->connect_error);
		} 
		extract($_POST);
		$sql="INSERT INTO aminities_master (AminitiesName) VALUES ('$aminitiesName')";
		$result = $this->con->query($sql);
		if($result==TRUE)
		{
			//echo"Updated";
			header("location:amenities.php");
		}
		else
		{
			echo"Try again";
			echo $this->con->error;
		}
	}

	function perticularAminity($aminityId)
	{
		if ($this->con->connect_error) 
		{
			die("Connection failed: " . $this->con->connect_error);
		} 
		$sql = "SELECT * FROM aminities_master WHERE AminitiesId = $aminityId";
		$result = $this->con->query($sql);
		return $result;
	}

	function updateAminities()
	{
		if ($this->con->connect_error) 
		{
			die("Connection failed: " . $this->con->connect_error);
		} 
		extract($_POST);
		$sql = "UPDATE aminities_master SET AminitiesName = '$aminitiesName' WHERE AminitiesId = $aminitiesId";
		$result = $this->con->query($sql);
		if($result==TRUE)
		{
			//echo"Updated";
			header("location:amenities.php");
		}
		else
		{
			echo"Try again";
			echo $this->con->error;
		}
	}
	function deleteAminities($aminityid)
	{
		if ($this->con->connect_error) 
		{
			die("Connection failed: " . $this->con->connect_error);
		}
		$sql = "DELETE FROM aminities_master WHERE AminitiesId = $aminityid";
		$result = $this->con->query($sql);
		return $result;
	}

	function perticularHouse($houseId)
	{
		if ($this->con->connect_error) 
		{
			die("Connection failed: " . $this->con->connect_error);
		} 
		$sql = "SELECT * FROM house_master WHERE HouseId = $houseId";
		$result = $this->con->query($sql);
		return $result;
	}

	function deleteHouse($houseid)
	{
		//extract($_POST);
		if ($this->con->connect_error) 
		{
			die("Connection failed: " . $this->con->connect_error);
		}
		$sql = "DELETE FROM house_master WHERE HouseId = $houseid";
		$result = $this->con->query($sql);
		return $result;
	}

	function allBookings()
	{
		if ($this->con->connect_error) 
		{
			die("Connection failed: " . $this->con->connect_error);
		} 

		$sql = "SELECT * FROM booking_master,owner_master,customer_master,house_master WHERE house_master.OwnerId=owner_master.OwnerId AND booking_master.CustId=customer_master.CustId AND booking_master.HouseId=house_master.HouseId";
		$result = $this->con->query($sql);
		return $result;
	}
	function allAddInfo($aid)
	{
		if ($this->con->connect_error) 
		{
			die("Connection failed: " . $this->con->connect_error);
		} 

		$sql = "SELECT * FROM area_master,city_master,state_master WHERE area_master.AreaId= $aid AND area_master.Cityid = city_master.Cityid AND city_master.StateId = state_master.StateId";
		$result = $this->con->query($sql);
		return $result;
	}

	function verifyHouse($houseid)
	{
		if ($this->con->connect_error) 
		{
			die("Connection failed: " . $this->con->connect_error);
		}
		$sql="UPDATE house_master SET IsHouseVerified=1 WHERE HouseId= $houseid";
		$result = $this->con->query($sql);
		return $result;
	}
	function houseImages($houseid)
	{
		if ($this->con->connect_error) 
		{
			die("Connection failed: " . $this->con->connect_error);
		}
		$sql="SELECT * FROM houseimage_master WHERE HouseId=$houseid";
		$result = $this->con->query($sql);
		return $result;
	}

	function perticularHouseDetails($houseid)
	{
		if ($this->con->connect_error) 
		{
			die("Connection failed: " . $this->con->connect_error);
		}
		$sql="SELECT HouseId, HouseName, HouseAddressLine1, HouseAddressLine2, HouseAddressLine3, NoofAllowedGuest, NoofBedrooms, NoofBathrooms, AreaId,HouseDescription1,HouseDescription2, HousePricePerPerson, HouseBasePrice, IsCancellable, CustomRules1, CustomRules2, IsHouseVerified,OwnerFirstName,OwnerLastName FROM house_master,owner_master WHERE house_master.OwnerId=owner_master.OwnerId AND HouseId=$houseid";
		$result = $this->con->query($sql);
		return $result;
	}

	function fetchImage($houseid)
	{
		if ($this->con->connect_error) 
		{
			die("Connection failed: " . $this->con->connect_error);
		}
		$sql="SELECT * FROM houseimage_master WHERE HouseId=$houseid LIMIT 1";
		$result = $this->con->query($sql);
		return $result;
	}
	function fetchAllImages($houseid)
	{
		if ($this->con->connect_error) 
		{
			die("Connection failed: " . $this->con->connect_error);
		}
		$sql="SELECT * FROM houseimage_master WHERE HouseId=$houseid";
		$result = $this->con->query($sql);
		return $result;
	}
	function aminitiesOfHouse($houseid)
	{
		if ($this->con->connect_error) 
		{
			die("Connection failed: " . $this->con->connect_error);
		}
		$sql="SELECT * FROM houseaminities_tranasction,aminities_master WHERE houseaminities_tranasction.AminitiesId=aminities_master.AminitiesId AND HouseId=$houseid";
		$result = $this->con->query($sql);
		return $result;
	}
	function deleteBookings($bookingid)
	{
		//extract($_POST);
		if ($this->con->connect_error) 
		{
			die("Connection failed: " . $this->con->connect_error);
		}
		$sql = "DELETE FROM booking_master WHERE BookingId = $bookingid";
		$result = $this->con->query($sql);
		return $result;
	}
	function deleteDamages($damageid)
	{
		//extract($_POST);
		if ($this->con->connect_error) 
		{
			die("Connection failed: " . $this->con->connect_error);
		}
		$sql = "DELETE FROM damage_master WHERE DamageId = $damageid";
		$result = $this->con->query($sql);
		return $result;
	}
	public function houseCount()
	{
		$sql="SELECT COUNT(HouseId) FROM house_master";
		$result = $this->con->query($sql);
		return $result;
	}
	public function custCount()
	{
		$sql="SELECT COUNT(CustId) FROM customer_master";
		$result = $this->con->query($sql);
		return $result;
	}
	public function ownerCount()
	{
		$sql="SELECT COUNT(OwnerId) FROM owner_master";
		$result = $this->con->query($sql);
		return $result;
	}

	function allNearByPlaces()
	{
		if ($this->con->connect_error) 
		{
			die("Connection failed: " . $this->con->connect_error);
		} 
		$sql = "SELECT * FROM near_by_places";
		$result = $this->con->query($sql);
		return $result;
	}

	function deleteNearPlace($nearPlaceid)
	{
		if ($this->con->connect_error) 
		{
			die("Connection failed: " . $this->con->connect_error);
		}
		$sql = "DELETE FROM near_by_places WHERE NearPlaceId = $nearPlaceid";
		$result = $this->con->query($sql);
		return $result;
	}

	function perticularNearPlace($nearplaceId)
	{
		if ($this->con->connect_error) 
		{
			die("Connection failed: " . $this->con->connect_error);
		} 
		$sql = "SELECT * FROM near_by_places WHERE NearPlaceId = $nearplaceId";
		$result = $this->con->query($sql);
		return $result;
	}

	function insertNearPlace()
	{	
		if ($this->con->connect_error) 
		{
			die("Connection failed: " . $this->con->connect_error);
		} 
		extract($_POST);
		$sql="INSERT INTO near_by_places ( NearPlaceName ) VALUES ('$nearPlaceName')";
		$result = $this->con->query($sql);
		if($result==TRUE)
		{
			//echo"Updated";
			header("location:nearByPlaces.php");
		}
		else
		{
			echo"Try again";
			echo $this->con->error;
		}
	}

	function updateNearPlace()
	{
		if ($this->con->connect_error) 
		{
			die("Connection failed: " . $this->con->connect_error);
		} 
		extract($_POST);
		$sql = "UPDATE near_by_places SET NearPlaceName = '$nearPlaceName' WHERE NearPlaceId = $NearPlaceId";
		$result = $this->con->query($sql);
		if($result==TRUE)
		{
			//echo"Updated";
			header("location:nearByPlaces.php");
		}
		else
		{
			echo"Try again";
			echo $this->con->error;
		}
	}

	function allOrders()
	{
		if ($this->con->connect_error) 
		{
			die("Connection failed: " . $this->con->connect_error);
		} 

		$sql = "SELECT * FROM order_master,booking_master,owner_master,customer_master,house_master WHERE order_master.BookingId=booking_master.BookingId AND house_master.OwnerId=owner_master.OwnerId AND booking_master.CustId=customer_master.CustId AND booking_master.HouseId=house_master.HouseId";
		$result = $this->con->query($sql);
		return $result;
	}

	function deleteOrders($orderid)
	{
		//extract($_POST);
		if ($this->con->connect_error) 
		{
			die("Connection failed: " . $this->con->connect_error);
		}
		$sql = "DELETE FROM order_master WHERE OrderId = $orderid";
		$result = $this->con->query($sql);
		return $result;
	}
	function allHouseDetails()
	{
		if ($this->con->connect_error) 
		{
			die("Connection failed: " . $this->con->connect_error);
		}
		$sql = "SELECT * FROM house_master,area_master,city_master,state_master WHERE house_master.AreaId= area_master.AreaId AND area_master.Cityid = city_master.Cityid AND city_master.StateId = state_master.StateId";
		$result = $this->con->query($sql);
		return $result;
	}
}

?>
