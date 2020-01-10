<?php
	// session_start(); 
    class HostController
	{
		private $hostname="localhost";
	 	private $username="root";
	 	private $password="";
	 	private $databasename="basera";
	 	private $con="";
	 	function __construct()
 		{	
 				date_default_timezone_set('Asia/Calcutta');
				$con=$this->connectdb();
 		}
 		
 		//connection function
 		function connectdb()
 		{
	 		$this->con=mysqli_connect($this->hostname,$this->username,$this->password,$this->databasename);
	 		return $this->con;
 		}

 		//login check
 		function loginCheck()
		{
			extract($_POST);
			$txtPassword=sha1($txtPassword);
			$query="select * from owner_master where OwnerEmail='$txtEmail' and OwnerPassword ='$txtPassword'";
			if(!$result=mysqli_query($this->con,$query))
			{
				return mysqli_error($this->con);
			}
			else
			{
				if(mysqli_num_rows($result)>0)
				{
					while ($data=mysqli_fetch_assoc($result)) 
					{
						$_SESSION['hostId']=$data['OwnerId'];
						$_SESSION['ownerName']=$data['OwnerFirstName'];
						$_SESSION['role']="host";
						return "Success";
					}
				}
				else
				{

					return "Invalid Login Credentials ";
				}
			}
		}

		//forgot password function
	 	function forgotPassword()
	 	{
	 		$query1 ="select OwnerEmail,OwnerId from owner_master where OwnerEmail = '".$_POST['txtEmail']."' "; 
	 		$data =mysqli_query($this->con,$query1);
	 		if(mysqli_num_rows($data))
	 		{
	 			$fetch =mysqli_fetch_assoc($data);
	 			require '../PHPMailer-master/PHPMailerAutoload.php';
			   $mail = new PHPMailer();
		  	   //Enable SMTP debugging.
			  $mail->SMTPDebug = 0;
			  //Set PHPMailer to use SMTP.
			  $mail->isSMTP();
			  //Set SMTP host name
			  $mail->Host = "smtp.gmail.com";
			  $mail->SMTPOptions = array(
			                    'ssl' => array(
			                        'verify_peer' => false,
			                        'verify_peer_name' => false,
			                        'allow_self_signed' => true
			                    )
			                );
			  //Set this to true if SMTP host requires authentication to send email
			  $mail->SMTPAuth = TRUE;
			  //Provide username and password
			  $mail->Username = "hackershah391@gmail.com";
			  $mail->Password = "kevinkevinshah";
			  //If SMTP requires TLS encryption then set it
			  $mail->SMTPSecure = "false";
			  $mail->Port = 587;
			  //Set TCP port to connect to
			  
			  $mail->From = "hackershah391@gmail.com";
			  $mail->FromName = "Admin";
			  
			  $mail->addAddress($fetch['OwnerEmail']);
			  
			  $mail->isHTML(true);
			 
			  $mail->Subject = "Change Password";
			  $mail->Body = "This is your Temporary password:<b>'Owner@123'</b> . Please change your password immediately after login for security purposes ";
			  $mail->AltBody = "This is the plain text version of the email content";
			  if(!$mail->send())
			  {
			   return  "Mailer Error: " . $mail->ErrorInfo;
			  }
			  else
			  {
					$txtPassword=sha1('Owner@123');				  	
			  		$q2="update owner_master set OwnerPassword='$txtPassword' where OwnerId='".$fetch['OwnerId']."'";
			  		$query2=mysqli_query($this->con,$q2);
			  		if($query2)
			  		{
			  			return "Your New Password has been send to your email";
			     	}
			  }
	 			
	 		}
	 		else
	 		{
	 			return "No such Email Found ";
			}
	 	}

	 //registration 
	 function registration()
	 {
	 	extract($_POST);
	 	try
	 	{
	 		if($_FILES['fileId']['type']=='image/png' || $_FILES['fileId']['type']=='image/jpg' || $_FILES['fileId']['type']=='image/jpeg')
		 	{
		 		$txtImage=$_FILES['fileId']['name'];
				$txtImage=str_replace(' ', '', $txtImage);
				$temp = explode(".", $txtImage);
				$temp[0]=$temp[0].date('dmYHis').rand(0,300);
				$fileName=$temp[0].".".$temp[1];
				 		
		 	// if(move_uploaded_file($_FILES['fileId']['tmp_name'],'C:/xampp/htdocs/basera/Uploads/'.$_FILES['fileId']['name']))	
			if(move_uploaded_file($_FILES['fileId']['tmp_name'],'../Uploads/OwnerDetails/'.$fileName))
		 			{
		 			 $txtPassword=sha1($txtPassword);
		 			$q="INSERT INTO owner_master(OwnerFirstName,OwnerLastName, OwnerEmail,OwnerPassword,OwnerNumber, OwnerKYC) VALUES('$txtFirstName','$txtLastName','$txtEmail','$txtPassword',$txtNumber,'".$fileName."')";
		 			$result=mysqli_query($this->con,$q);
			  		if($result)
			  		{
			  			return "Success";
				  	}
				  	else
				  	{
						throw new RuntimeException(mysqli_error($this->con));
				  	}
		 					
		 		}
		 			else
		 			{
		 				throw new RuntimeException('Failed to Upload File.');		
		 			}
			}
		 	else
		 		{
		 			throw new RuntimeException('Invalid file format. Only Image file is allowed');
		 		}
		
	 	}
	 	catch(RuntimeException $e)
	 	{
	 		if(substr( $e->getMessage(), 0, 9 ) == "Duplicate")
	 		{
	 			return "Email or Mobile Number already exists<br>".$e->getMessage();		
	 		}
	 		else
	 		{
	 			return $e->getMessage();	
	 		}
		}
	 }

		//area fetch
		function areaFetch()
		{
			$query="select * from area_master";
			if(!$result=mysqli_query($this->con,$query))
			{
				return mysqli_error($this->con);
			}
			else
			{
				return $result;
			}		
		}
		//aminities fetch
		function aminitiesFetch($id)
		{
			if($id==0)
			{
				$query="select * from aminities_master";
			}
			else
			{
				$query="SELECT * FROM houseaminities_tranasction ha, aminities_master am WHERE HouseId=".$id." AND ha.AminitiesId = am.AminitiesId ";	
			}
			if(!$result=mysqli_query($this->con,$query))
			{
				return mysqli_error($this->con);
			}
			else
			{
				return $result;
			}		
		}
		
		function nearbyFetch($id)
		{
			if($id==0)
			{
				$query="select * from near_by_places";	
			}
			else
			{
				$query="select NearPlaceName from near_by_places np,near_by_places_transaction npt where npt.NearPlaceId=np.NearPlaceId AND npt.HouseId=".$id;
			}
			if(!$result=mysqli_query($this->con,$query))
			{
				return mysqli_error($this->con);
			}
			else
			{
				return $result;
			}
		}
		//cityFetch()
		function cityFetch($str)
		{
		// $query="select * from city_master";	
		$query="select * from area_master a, city_master c,state_master s where a.AreaId=$str and c.CityId=a.CityId and s.StateId=c.StateId";
			if(!$result=mysqli_query($this->con,$query))
			{
				return mysqli_error($this->con);
			}
			else
			{
				while($data=mysqli_fetch_assoc($result))
				{
					echo"<input type='hidden' name=txtarea id=areaName class=htlfndr-review-form-input  readonly value=".$data['AreaName'].">";
					echo "
					<label for=contact-name class=htlfndr-top-label>City</label>
					<input type='text' name=txtCity id=cityId class=htlfndr-review-form-input  readonly value=".$data['CityName'].">";
					echo "<label for=contact-name class=htlfndr-top-label>State</label>
					<input type='text' id=stateId name=txtState  class=htlfndr-review-form-input  readonly value=".$data['StateName'].">";
				}
			}	
		}		
		//registrationHome
		function registrationHome()
		{
			session_start();
			$status="";
			$tmpData=array();
			extract($_POST);
			foreach ($nearby as $key) 
			{
				if(!is_numeric($key))
				{
					return "Please select nearby from the given list only ";	
				}
			}
			if(isset($extraAminities))
			{
				$count=count($extraAminities);
				// echo $count;
			}
			if($txtDesc1=="")
			{
				$txtDesc1="NULL";
			}
			if($txtDesc2=="")
			{
				$txtDesc2="NULL";
			}
			if($txtRules1=="")
			{
				$txtRules1="NULL";
			}
			if($txtRules2=="")
			{
				$txtRules2="NULL";
			}
			if($txtAddr2=="")
			{
				$txtAddr2="NULL";
			}
			if($txtAddr3=="")
			{
				$txtAddr3="NULL";
			}
			try
			{
				for ($i=0; $i <count($_FILES['imageUpload']['name']) ; $i++) 
				{ 
							
				 	if($_FILES['imageUpload']['type'][$i]=='image/png' || $_FILES['imageUpload']['type'][$i]=='image/jpg' || $_FILES['imageUpload']['type'][$i]=='image/jpeg')
					{
						$_FILES['imageUpload']['name'][$i]=str_replace(' ', '', $_FILES['imageUpload']['name'][$i]);
						$temp = explode(".",$_FILES['imageUpload']['name'][$i]);
						$temp[0]=$temp[0].date('dmYHis').rand(0,300).$i;
						$_FILES['imageUpload']['name'][$i]=$temp[0].".".$temp[1];
					 	if(move_uploaded_file($_FILES['imageUpload']['tmp_name'][$i],'../Uploads/HouseDetails/'.$_FILES['imageUpload']['name'][$i]))
					 	{
					 		$status="Success";
					 	} 		
					 	else
		 				{
		 					throw new RuntimeException('Failed to Upload File.');	
		 				}
					}
					else
					{
					 	throw new RuntimeException('Invalid file format. Only Image file is allowed');
					}
				}
				if($status=="Success")
				{

	 				$q1="INSERT INTO house_master(HouseName,OwnerId,HouseAddressLine1,HouseAddressLine2,HouseAddressLine3,NoofAllowedGuest,NoofBedrooms,NoofBathrooms,AreaId,HouseDescription1,HouseDescription2,HousePricePerPerson,HouseBasePrice,IsCancellable,CustomRules1, CustomRules2,CheckIn,CheckOut) VALUES ('$txtHouseName',".$_SESSION['hostId'].",'$txtAddr1','$txtAddr2','$txtAddr3',$txtGuest,$txtBedrooms,$txtBathrooms,$areaId,'$txtDesc1','$txtDesc2',$txtPrice,$txtBasicPrice,$radioCancelable,'$txtRules1','$txtRules2','$txtCheckIn','$txtCheckOut')";
	 				// $q1="INSERT INTO house_master(HouseName,OwnerId,HouseAddressLine1,HouseAddressLine2,HouseAddressLine3,NoofAllowedGuest,NoofBedrooms,NoofBathrooms,AreaId,MapLongitude,MapLatitude,HouseDescription,HousePricePerPerson,HouseBasePrice,IsCancellable,CustomRules1, CustomRules2,CheckIn,CheckOut) VALUES ('$txtHouseName',".$_SESSION['hostId'].",'$txtAddr1','$txtAddr2','$txtAddr3',$txtGuest,$txtBedrooms,$txtBathrooms,$areaId,'$txtLongitude','$txtLatitude','$txtDesc',$txtPrice,$txtBasicPrice,$radioCancelable,'$txtRules1','$txtRules2','$txtCheckIn','$txtCheckOut')";
	 				$result1=mysqli_query($this->con,$q1);
			  		if($result1)
			  		{
			  			$q2="SELECT `HouseId` FROM `house_master` ORDER BY `HouseId` DESC LIMIT 1";
			  			$result2=mysqli_query($this->con,$q2);
			  			while($data1=mysqli_fetch_assoc($result2))
			  			{	

			  				if(isset($extraAminities))
			  				{
			  					foreach ($extraAminities as $key) 
			  					{
			  						$qa1="INSERT INTO aminities_master(AminitiesName,ExtraAminities) VALUES ('$key',1)";
			  						$resulta1=mysqli_query($this->con,$qa1);
			  						if(!$resulta1)
			  						{
			  								throw new RuntimeException(mysqli_error($this->con));
			  						}
			  						$qa2="SELECT AminitiesId FROM aminities_master  ORDER BY AminitiesId DESC LIMIT 1";
			  							$resulta2=mysqli_query($this->con,$qa2);
			  							while($dataa1=mysqli_fetch_assoc($resulta2))
			  							{
			  								array_push($tmpData,$dataa1['AminitiesId']);
			  							}
			  					}
			  				}
			  				if(isset($_POST['aminities']))
			  				{
			  					foreach ($_POST['aminities'] as $key ) 
				  				{
									$q3="INSERT INTO houseaminities_tranasction(HouseId,AminitiesId) VALUES (".$data1['HouseId'].",$key)";
					  				$result3=mysqli_query($this->con,$q3);
					  				if(!$result3)
					  				{
					  					throw new RuntimeException(mysqli_error($this->con));
					  				}	
				  				}	
			  				}
			  				
			  				if(count($tmpData)>0)
			  				{
			  						foreach ($tmpData as $key ) 
					  				{
										$qa3="INSERT INTO houseaminities_tranasction(HouseId,AminitiesId) VALUES (".$data1['HouseId'].",$key)";
						  				$resulta3=mysqli_query($this->con,$qa3);
						  				if(!$resulta3)
						  				{
						  					throw new RuntimeException(mysqli_error($this->con));
						  				}	
			  						}
			  				}
			  				foreach($_FILES['imageUpload']['name'] as $key )
							{ 
								$q4="INSERT INTO houseimage_master(HouseId,Image) VALUES (".$data1['HouseId'].",'$key')";
				  				$result4=mysqli_query($this->con,$q4);
				  				if(!$result4)
				  				{
				  					throw new RuntimeException(mysqli_error($this->con));
				  				}
				  				else
				  				{
				  					$status="Success";
				  				}	
			  				}
			  				foreach($nearby as $key)
							{ 
								$q5="INSERT INTO near_by_places_transaction(HouseId,NearPlaceId) VALUES (".$data1['HouseId'].",'$key')";
								$result5=mysqli_query($this->con,$q5);
				  				if(!$result5)
				  				{
				  					throw new RuntimeException(mysqli_error($this->con));
				  				}
				  				else
				  				{
				  					$status="Success";
				  				}	
			  				}
			  			}		
				 	}
				 	else
				 	{
				 		throw new RuntimeException(mysqli_error($this->con));
				 	}
				}
				return "Registered Successfully";	 				
			}
			catch(RuntimeException $e)
	 		{
	 			return $e->getMessage();
	 		}
	 			
		}

		//selecthostforedit
		function selectHostForEdit()
		{
			$q="select * from owner_master where OwnerId =".$_SESSION['hostId'];
			$result=mysqli_query($this->con,$q);
			return $result;
		}

		//edit profile 
		function editProfile()
		{
			extract($_POST);
			try
	 		{
	 			if($_FILES['fileId']['name']!="")
				{
				
	 				if($_FILES['fileId']['type']=='image/png' || $_FILES['fileId']['type']=='image/jpg' || $_FILES['fileId']['type']=='image/jpeg')
		 			{
		 				$_FILES['fileId']['name']=str_replace(' ', '', $_FILES['fileId']['name']);
				 		$temp = explode(".",$_FILES['fileId']['name']);
						$temp[0]=$temp[0].date('dmYHis').rand(0,300);
						$fileName=$temp[0].".".$temp[1];
		 				if(move_uploaded_file($_FILES['fileId']['tmp_name'],'../Uploads/OwnerDetails/'.$fileName))
		 				{
		 					$filestring1= '../Uploads/OwnerDetails/'.$txtImage;
							unlink($filestring1);
							$txtImage=$fileName;
						}
		 				else
		 				{
		 					throw new RuntimeException('Failed to Update KYC.');
						}
		 			}
		 			else
		 			{
		 				throw new RuntimeException('Invalid file format. Only Image file is allowed');	
		 			}
		 		}
		 		$q="UPDATE owner_master SET OwnerFirstName='$txtFirstName',OwnerLastName='$txtLastName',OwnerEmail='$txtEmail',OwnerNumber=$txtNumber,OwnerKYC='$txtImage' WHERE OwnerId=".$_SESSION['hostId'];
				$result=mysqli_query($this->con,$q);
				if($result)
				{
					// unset($_SESSION['ownerName']);
					$_SESSION['ownerName']=$txtFirstName;
					return"Sucucess";
				}
				else
				{
					throw new RuntimeException(mysqli_error($this->con));
					
				}
			}	
	 		catch(RuntimeException $re)
	 		{
	 			return $re->getMessage();
	 		}

		}

		//changePassword
		function changePassword()
		{
			extract($_POST);
			try
			{
				$txtOldPassword=sha1($txtOldPassword);
				$txtNewPassword=sha1($txtNewPassword);
				$q1="select OwnerId from owner_master where OwnerId=".$_SESSION['hostId']." and OwnerPassword='$txtOldPassword'";
				$result1=mysqli_query($this->con,$q1);
				if(mysqli_num_rows($result1)>0)
				{
					$q2="UPDATE owner_master SET OwnerPassword='$txtNewPassword' where OwnerId=".$_SESSION['hostId'];
					$result2=mysqli_query($this->con,$q2);
					if($result2)
					{
						return "Changed";
					}
					else
					{
						throw new RuntimeException(mysqli_error($this->con));
					}
				}	
				else
				{
					throw new RuntimeException("Your Previous Password does not match");
				}
			}
			catch(RuntimeException $re)
			{
				return $re->getMessage();
			}
		}

	    //View Registerted House
	    function viewRegistertedHouses()
	    {
	    	$q="SELECT * FROM house_master WHERE OwnerId=".$_SESSION['hostId'];
	    	$result=mysqli_query($this->con,$q);
	    	return $result;
	    }

	    //function viewParticularHouse
	    function viewParticularHouse($id)
	    {
	    	$q="SELECT * FROM house_master hm,area_master am,city_master cm, state_master sm WHERE HouseId=".$id." AND hm.AreaId = am.AreaId AND cm.CityId = am.cityId AND sm.StateId =cm.StateId ";
			$result=mysqli_query($this->con,$q);
	    	return $result;	
	    }

	    //function AminitiesFetch
	    // function AminitiesFetchForDisplay($id)
	    // {
	    // 	$q="SELECT * FROM houseaminities_tranasction ha, aminities_master am WHERE HouseId=".$id." AND ha.AminitiesId = am.AminitiesId ";
	    // 	$result=mysqli_query($this->con,$q);
	    // 	return $result;
	    // }

	    //Image Fetch
	    function imageFetch($id,$operation)
	    {	
	    	if($operation=="All")
	    	{
	    		$q="SELECT * FROM houseimage_master where HouseId=".$id." LIMIT 1 ";
	    	}
	    	else
	    	{
	    		$q="SELECT * FROM houseimage_master where HouseId=".$id;	
	    	}
	    	$result=mysqli_query($this->con,$q);
	    	return $result;
	    }

	    //update House Details
	    function updateHouseDetails()
	    {
	    	extract($_POST);
	    	if($txtDesc1=="NULL")
	    	{
	    		return "House Description cannot be empty";
	    	}
	    	if($txtDesc2=="-")
	    	{
	    		$txtDesc2=$txtDesc2Detailed;
	    	}
	    	if($txtDesc2=="NULL")
	    	{
	    		$txtDesc2="NULL";
	    	}
	    	if($txtRules1=="-")
	    	{
	    		$txtRules1=$txtRule1Detailed;
	    	}
	    	if($txtRules1=="NULL")
	    	{
	    		$txtRules1="NULL";
	    	}
	    	if($txtRules2=="-")
	    	{
	    		$txtRules2=$txtDesc2Detailed;
	    	}
	    	if($txtRules2=="NULL")
	    	{
	    		$txtRules2="NULL";	    		
	    	}
	   	    if($txtAddr2=="-")
	    	{
	    		$txtAddr2=$txtAddr2Detailed;
	    	}
	    	if($txtAddr2=="NULL")
	    	{
	    		$txtAddr2="NULL";
	    	} 
		    if($txtAddr3=="-")
	    	{
	    		$txtAddr3=$txtAddr2Detailed;
	    	}
	    	if($txtAddr3=="NULL")
	    	{
	    		$txtAddr3="NULL";	
	    	}
	    	// $q="UPDATE house_master SET HouseName='$txtHouseName',HouseAddressLine1='$txtAddr1',HouseAddressLine2='$txtAddr2',HouseAddressLine3='$txtAddr3',NoofAllowedGuest=$txtGuest,NoofBedrooms=$txtBedrooms,NoofBathrooms=$txtBathrooms,AreaId=$areaId,MapLongitude='$txtLongitude',MapLatitude='$txtLatitude',HouseDescription='$txtDesc',HousePricePerPerson=$txtPrice,HouseBasePrice=$txtBasicPrice,IsCancellable=$radioCancelable,CustomRules1='$txtRules1',CustomRules2='$txtRules2',CheckIn='$txtCheckIn',CheckOut='$txtCheckOut' WHERE HouseId=$txtHouseId";
	    	$q="UPDATE house_master SET HouseName='$txtHouseName',HouseAddressLine1='$txtAddr1',HouseAddressLine2='$txtAddr2',HouseAddressLine3='$txtAddr3',NoofAllowedGuest=$txtGuest,NoofBedrooms=$txtBedrooms,NoofBathrooms=$txtBathrooms,AreaId=$areaId,HouseDescription1='$txtDesc1',HouseDescription2='$txtDesc2',HousePricePerPerson=$txtPrice,HouseBasePrice=$txtBasicPrice,IsCancellable=$radioCancelable,CustomRules1='$txtRules1',CustomRules2='$txtRules2',CheckIn='$txtCheckIn',CheckOut='$txtCheckOut' WHERE HouseId=$txtHouseId";
	    	$result=mysqli_query($this->con,$q);
	    	if($result)
	    	{
	    		return"Success";
	    	}   
	    	else
	    	{
	    		return mysqli_error($this->con);
	    	} 		
	    }

	    //Update Aminities for House
	    function updateAminitiesForHouse()
	    {
	    	extract($_POST);
	    	$tmpData=array();
	    	if(isset($_POST['extraAminities']))
	    	{	
	    		foreach ($extraAminities as $key) 
			  	{
			  			$qa1="INSERT INTO aminities_master(AminitiesName,ExtraAminities) VALUES ('$key',1)";
			  			$resulta1=mysqli_query($this->con,$qa1);
			  			if(!$resulta1)
			  			{
			  				return mysqli_error($this->con);
			  			}
			  			$qa2="SELECT AminitiesId FROM aminities_master  ORDER BY AminitiesId DESC LIMIT 1";
			  			$resulta2=mysqli_query($this->con,$qa2);
			  			while($dataa1=mysqli_fetch_assoc($resulta2))
			  			{
			  				array_push($tmpData,$dataa1['AminitiesId']);
			  			}	
			  	}

	    	}
			$qa4="SELECT * FROM houseaminities_tranasction WHERE HouseId=".$txtHouseId;
			$resulta4=mysqli_query($this->con,$qa4);
			while ($aminitiesData=mysqli_fetch_assoc($resulta4))
			 {
			 		if(!in_array($aminitiesData['AminitiesId'],$aminities))
			 		{
			 			$qa5="DELETE FROM houseaminities_tranasction WHERE HouseId=".$txtHouseId." AND AminitiesId=".$aminitiesData['AminitiesId'];
			 			$resulta5=mysqli_query($this->con,$qa5);
			 			if(!$resulta5)
			 			{
			 				return mysqli_error($this->con);
			 			}
			 			
			 		}
			 		else
			 		{
			 			foreach (array_keys($aminities,$aminitiesData['AminitiesId']) as $key )
			 			 {
			 				unset($aminities[$key]);
			 			}
			 		}
			} 	
			foreach ($aminities as $key) 
			{
					$qa6="INSERT INTO houseaminities_tranasction(HouseId, AminitiesId) VALUES ($txtHouseId,$key)";
			 				$resulta6=mysqli_query($this->con,$qa6);
				 			if(!$resulta6)
				 			{
				 				return mysqli_error($this->con);
				 			}
			}
			foreach ($tmpData as $key) 
		  	{
				$qa3="INSERT INTO houseaminities_tranasction(HouseId,AminitiesId) VALUES (".$txtHouseId.",".$key.")";
				$resulta3=mysqli_query($this->con,$qa3);
				if(!$resulta3)
  				{
  					return mysqli_error($this->con);
  				}	
  			}
			return "Success";
	    }
	     function NearByUpdateForHouse()
	    {
	    	extract($_POST);
	    	$tmpData=array();
			foreach ($nearby as $key) 
			{
				if(!is_numeric($key))
				{
					return "Please select nearby from the given list only ";	
				}
			}

	    	$qa4="SELECT * FROM near_by_places_transaction WHERE HouseId=".$txtHouseId;
			$resulta4=mysqli_query($this->con,$qa4);
			while ($nearbyData=mysqli_fetch_assoc($resulta4))
			 {
			 		if(!in_array($nearbyData['NearPlaceId'],$nearby))
			 		{
			 			$qa5="DELETE FROM near_by_places_transaction WHERE HouseId=".$txtHouseId." AND NearPlaceId=".$nearbyData['NearPlaceId'];
			 			$resulta5=mysqli_query($this->con,$qa5);
			 			if(!$resulta5)
			 			{
			 				return mysqli_error($this->con);
			 			}
			 			
			 		}
			 		else
			 		{
			 			foreach (array_keys($nearby,$nearbyData['NearPlaceId']) as $key )
			 			 {
			 				unset($nearby[$key]);
			 			}
			 		}
			} 	
			foreach ($nearby as $key) 
			{
					$qa6="INSERT INTO near_by_places_transaction(HouseId, NearPlaceId) VALUES ($txtHouseId,$key)";
			 				$resulta6=mysqli_query($this->con,$qa6);
				 			if(!$resulta6)
				 			{
				 				return mysqli_error($this->con);
				 			}
			}
			
			return "Success";
	    }	

	    //Update Images for House
	    function imageUpdateForHouse()
	    {
	    	try
			{
				extract($_POST);
				$Sucucess="Success";
					if(isset($_FILES['imageUpload1']))
					{
						for ($i=0; $i <$numRows; $i++) 
						{
							if($_FILES['imageUpload1']['name'][$i]!=null)
							{
								if($_FILES['imageUpload1']['type'][$i]=='image/png' || $_FILES['imageUpload1']['type'][$i]=='image/jpg' || $_FILES['imageUpload1']['type'][$i]=='image/jpeg')
					 			{
					 				$_FILES['imageUpload1']['name'][$i]=str_replace(' ', '', $_FILES['imageUpload1']['name'][$i]);
					 				$temp = explode(".",$_FILES['imageUpload1']['name'][$i]);
									$temp[0]=$temp[0].date('dmYHis').rand(0,300).$i;
									$_FILES['imageUpload1']['name'][$i]=$temp[0].".".$temp[1];
					 				if(move_uploaded_file($_FILES['imageUpload1']['tmp_name'][$i],'../Uploads/HouseDetails/'.$_FILES['imageUpload1']['name'][$i]))
					 				{
						 				$filestring1= '../Uploads/HouseDetails/'.$inc[$i];
										unlink($filestring1);	
										$q1="DELETE FROM `houseimage_master` WHERE HouseId=".$txtHouseId." and Image='".$inc[$i]."'";
										$result1=mysqli_query($this->con,$q1);
										if($result1)
										{
											$q2="insert into houseimage_master(HouseId,Image)values($txtHouseId,'".$_FILES['imageUpload1']['name'][$i]."')";
											$result2=mysqli_query($this->con,$q2);
											if($result2)
											{
												$Sucucess="Success";
											}
											else
											{
												throw new RuntimeException(mysqli_error($this->con));
											}
										}
										else
										{
											throw new RuntimeException(mysqli_error($this->con));
										}
									}
									else
					 				{
					 					throw new RuntimeException('Failed to Update Image.');
									}	
								}
								else
					 			{
					 				throw new RuntimeException('Invalid file format. Only Image file is allowed');	
					 			}	
							}
						}
					}
					if(isset($_FILES['imageUpload']))
					{
						for ($i=0; $i <count($_FILES['imageUpload']['name']) ; $i++) 
						{ 
								
						 	if($_FILES['imageUpload']['type'][$i]=='image/png' || $_FILES['imageUpload']['type'][$i]=='image/jpg' || $_FILES['imageUpload']['type'][$i]=='image/jpeg')
							{
								$_FILES['imageUpload']['name'][$i]=str_replace(' ', '', $_FILES['imageUpload']['name'][$i]);
								$temp = explode(".",$_FILES['imageUpload']['name'][$i]);
								$temp[0]=$temp[0].date('dmYHis').rand(0,300).$i;
								$_FILES['imageUpload']['name'][$i]=$temp[0].".".$temp[1];
							 	if(move_uploaded_file($_FILES['imageUpload']['tmp_name'][$i],'../Uploads/HouseDetails/'.$_FILES['imageUpload']['name'][$i]))
							 	{
							 		$q2="insert into houseimage_master(HouseId,Image)values($txtHouseId,'".$_FILES['imageUpload']['name'][$i]."')";
											$result2=mysqli_query($this->con,$q2);
											if($result2)
											{
												$Sucucess="Success";
											}
											else
											{
												throw new RuntimeException(mysqli_error($this->con));
											}
							 	} 		
							 	else
				 				{
				 					throw new RuntimeException('Failed to Upload File.');	
				 				}
							}
							else
							{
							 	throw new RuntimeException('Invalid file format. Only Image file is allowed');
							}
						}	
					}
					return $Sucucess;
			}
			catch(RuntimeException $re)
			{
				return $re->getMessage();
			}
        }

	    //function Delete House
	    function deleteHouse($id)
	    {	
	    	$q1="SELECT * FROM houseimage_master WHERE HouseId=".$id;
	    	$result1=mysqli_query($this->con,$q1);
	    	while($data=mysqli_fetch_assoc($result1))
	    	{
	    		$filestring1= '../Uploads/HouseDetails/'.$data['Image'];
				unlink($filestring1);
			}
	    	$q2="DELETE FROM house_master WHERE HouseId=".$id;
	    	$result2=mysqli_query($this->con,$q2);
	    	return $result2;
	    }

	    function deleteImage($id)
	    {	
	    	$q1="SELECT * FROM houseimage_master WHERE HIId=".$id;
	    	$result1=mysqli_query($this->con,$q1);
	    	while($data=mysqli_fetch_assoc($result1))
	    	{
	    		$filestring1= '../Uploads/HouseDetails/'.$data['Image'];
				unlink($filestring1);
			}
	    	$q2="DELETE FROM houseimage_master WHERE HIId=".$id;
	    	$result2=mysqli_query($this->con,$q2);
	    	return $result2;
	    }

	    function countBookings()
	    {
	    	$q="SELECT COUNT(*) AS 'Count' FROM booking_master bm,house_master hm,customer_master cm WHERE bm.CustId=cm.CustId AND bm.HouseId=hm.HouseId AND bm.ConfirmationStatus=0 AND hm.OwnerId=".$_SESSION['hostId'];
	    	$result=mysqli_query($this->con,$q);
	    	return $result;
	    }
	    function bookingDetailsForConfirmation($id)
	    {
	    	if($id==0)
	    	{
	    		$q="SELECT * FROM booking_master bm,house_master hm,customer_master cm WHERE bm.CustId=cm.CustId AND bm.HouseId=hm.HouseId AND bm.ConfirmationStatus=0 AND hm.OwnerId=".$_SESSION['hostId'];
	    	}
	    	else
	    	{
	    		$q="SELECT * FROM booking_master bm,house_master hm,customer_master cm WHERE bm.CustId=cm.CustId AND bm.HouseId=hm.HouseId AND bm.ConfirmationStatus=0 AND bm.BookingID=".$id." AND hm.OwnerId=".$_SESSION['hostId'];
	    	}
	    	$result=mysqli_query($this->con,$q);
	    	return $result;	
	    }
	    function ConfirmBooking($id,$operation)
	    {
	    	if($operation=="Confirm")
		    {
		    	$q="UPDATE booking_master SET ConfirmationStatus=1 WHERE BookingId=".$id;
		    	$result=mysqli_query($this->con,$q);
		    	if($result)
		    	{
		    		$query1 ="SELECT cm.CustEmail,om.OwnerFirstName,om.OwnerLastName,om.OwnerEmail,om.OwnerNumber FROM booking_master bm,owner_master om,house_master hm, customer_master cm WHERE hm.HouseId=bm.HouseId AND cm.CustId=bm.CustId AND hm.OwnerId=om.OwnerId AND bm.BookingId=".$id;
		    		$data =mysqli_query($this->con,$query1);
			 		if(mysqli_num_rows($data))
			 		{
			 			$fetch =mysqli_fetch_assoc($data);
			 			require '../PHPMailer-master/PHPMailerAutoload.php';
					   $mail = new PHPMailer();
				  	   //Enable SMTP debugging.
					  $mail->SMTPDebug = 0;
					  //Set PHPMailer to use SMTP.
					  $mail->isSMTP();
					  //Set SMTP host name
					  $mail->Host = "smtp.gmail.com";
					  $mail->SMTPOptions = array(
					                    'ssl' => array(
					                        'verify_peer' => false,
					                        'verify_peer_name' => false,
					                        'allow_self_signed' => true
					                    )
					                );
					  //Set this to true if SMTP host requires authentication to send email
					  $mail->SMTPAuth = TRUE;
					  //Provide username and password
					  $mail->Username = "hackershah391@gmail.com";
					  $mail->Password = "kevinkevinshah";
					  //If SMTP requires TLS encryption then set it
					  $mail->SMTPSecure = "false";
					  $mail->Port = 587;
					  //Set TCP port to connect to
					  
					  $mail->From = "hackershah391@gmail.com";
					  $mail->FromName = "Admin";
					  
					  $mail->addAddress($fetch['CustEmail']);
					  
					  $mail->isHTML(true);
					 
					  $mail->Subject = "Booking Confirmation";
					  $mail->Body = "Your Booking has been Confirmed by the Owner.<br>For more queries you can talk to the owner<br>
					  	Owner Name : ".$fetch['OwnerFirstName']." ".$fetch['OwnerLastName']."<br>"."Owner Email : ".$fetch['OwnerEmail']."<br>Owner Phone Number :<a href=tel:".$fetch['OwnerNumber'].">".$fetch['OwnerNumber']."</a>";
					  $mail->AltBody = "Booking Confirmed";
					  if(!$mail->send())
					  {
					   return  "Mailer Error: " . $mail->ErrorInfo;
					  }
					  else
					  {
					  	return "Success";
					  }
			    	}
			    }		
	    	}
	    	else if($operation=="Cancel")
	    	{
	    		$q="UPDATE booking_master SET ConfirmationStatus=4 WHERE BookingId=".$id;
		    	$result=mysqli_query($this->con,$q);
		    	if($result)
		    	{
		    		$query1 ="SELECT cm.CustEmail FROM booking_master bm,customer_master cm WHERE cm.CustId=bm.CustId AND bm.BookingId=".$id;
		    		$data =mysqli_query($this->con,$query1);
			 		if(mysqli_num_rows($data))
			 		{
			 			$fetch =mysqli_fetch_assoc($data);
			 			require '../PHPMailer-master/PHPMailerAutoload.php';
					   $mail = new PHPMailer();
				  	   //Enable SMTP debugging.
					  $mail->SMTPDebug = 0;
					  //Set PHPMailer to use SMTP.
					  $mail->isSMTP();
					  //Set SMTP host name
					  $mail->Host = "smtp.gmail.com";
					  $mail->SMTPOptions = array(
					                    'ssl' => array(
					                        'verify_peer' => false,
					                        'verify_peer_name' => false,
					                        'allow_self_signed' => true
					                    )
					                );
					  //Set this to true if SMTP host requires authentication to send email
					  $mail->SMTPAuth = TRUE;
					  //Provide username and password
					  $mail->Username = "hackershah391@gmail.com";
					  $mail->Password = "kevinkevinshah";
					  //If SMTP requires TLS encryption then set it
					  $mail->SMTPSecure = "false";
					  $mail->Port = 587;
					  //Set TCP port to connect to
					  
					  $mail->From = "hackershah391@gmail.com";
					  $mail->FromName = "Admin";
					  
					  $mail->addAddress($fetch['CustEmail']);
					  
					  $mail->isHTML(true);
					 
					  $mail->Subject = "Cancel Booking";
					  $mail->Body = "Your Booking has been Cancel  by the Owner.<br>Reason for Cancellation : <br>".$_POST['txtReason'];
					  $mail->AltBody = "Booking Confirmed";
					  if(!$mail->send())
					  {
					   return  "Mailer Error: " . $mail->ErrorInfo;
					  }
					  else
					  {
					  	return "Success";
					  }
			    	}
			    }
	    	}
	    }

	     function displayForCheckIn()
	    {
	    	$date=date('Y-m-d');
	    	$q="SELECT * From booking_master bm,customer_master cm,house_master hm WHERE cm.CustId=bm.CustId AND bm.HouseId=hm.HouseId AND bm.ConfirmationStatus=1 AND bm.CheckInDate ='$date' AND hm.OwnerId=".$_SESSION['hostId'];
	    	$result=mysqli_query($this->con,$q);
	    	return $result;
	    }
	    function addOrder()
	    {
	    	$q1="UPDATE booking_master SET ConfirmationStatus=2 WHERE BookingId=".$_POST['BookingId'];
	    	$result1=mysqli_query($this->con,$q1);
	    	if($result1)
	    	{
	    	$q2="INSERT INTO order_master(BookingId) VALUES(".$_POST['BookingId'].")";
	    		$result2=mysqli_query($this->con,$q2);
	    		if($result2)
	    		{
	    			require '../PHPMailer-master/PHPMailerAutoload.php';
					   $mail = new PHPMailer();
				  	   //Enable SMTP debugging.
					  $mail->SMTPDebug = 0;
					  //Set PHPMailer to use SMTP.
					  $mail->isSMTP();
					  //Set SMTP host name
					  $mail->Host = "smtp.gmail.com";
					  $mail->SMTPOptions = array(
					                    'ssl' => array(
					                        'verify_peer' => false,
					                        'verify_peer_name' => false,
					                        'allow_self_signed' => true
					                    )
					                );
					  //Set this to true if SMTP host requires authentication to send email
					  $mail->SMTPAuth = TRUE;
					  //Provide username and password
					  $mail->Username = "hackershah391@gmail.com";
					  $mail->Password = "kevinkevinshah";
					  //If SMTP requires TLS encryption then set it
					  $mail->SMTPSecure = "false";
					  $mail->Port = 587;
					  //Set TCP port to connect to
					  
					  $mail->From = "hackershah391@gmail.com";
					  $mail->FromName = "Admin";
					  
					  $mail->addAddress($_POST['CustEmail']);
					  
					  $mail->isHTML(true);
					 
					  $mail->Subject = "Checked-In";
					  $mail->Body = "You have Checked-In Sucessfully at  : <b>".date('H:i:s')."</b>";
					  $mail->AltBody = "Checked-In";
					  if(!$mail->send())
					  {
					   return  "Mailer Error: " . $mail->ErrorInfo;
					  }
					  else
					  {
					  	return "Success";
					  }
	    		}
	    		else
	    		{
	    			return mysqli_error($this->con);	
	    		}
	    	}
	    	else
	    	{
	    		return mysqli_error($this->con);
	    	}
	    }

	    function displayForCheckOut()
	    {
	    	$date=date('Y-m-d');
	    	$q="SELECT * From booking_master bm,customer_master cm,house_master hm WHERE cm.CustId=bm.CustId AND bm.HouseId=hm.HouseId AND bm.ConfirmationStatus=2 AND bm.CheckOutDate ='$date' AND hm.OwnerId=".$_SESSION['hostId'];
	    	$result=mysqli_query($this->con,$q);
	    	return $result;
	    }
	    function checkOut($id)
	    {
	    	$date=date('Y-m-d');
		    $q1="SELECT * From booking_master bm WHERE  bm.BookingId =$id AND bm.ConfirmationStatus=2 AND bm.CheckOutDate='$date' " ;
		    $result1=mysqli_query($this->con,$q1);
		    return $result1;
	    }

	    function fetchBookingForCheckOut($id)
	    {
	    	$q1="SELECT * From booking_master WHERE BookingId=".$id ;
		    $result1=mysqli_query($this->con,$q1);
		    return $result1;	
	    }

	    function fetchCustomerForCheckOut($id)
	    {
	    	$q1="SELECT * From customer_master WHERE CustId=".$id ;
		    $result1=mysqli_query($this->con,$q1);
		    return $result1;
	    }
	    function fetchHouseForCheckOut($id)
	    {
	    	$q1="SELECT * From house_master hm, owner_master om WHERE HouseId=".$id." AND hm.OwnerId=om.OwnerId" ;
		    $result1=mysqli_query($this->con,$q1);
		    return $result1;
	    }
	    function fetchOrderForCheckOut($id)
	    {
	    	$q1="SELECT IsDamage From order_master WHERE BookingId=".$id ;
		    $result1=mysqli_query($this->con,$q1);
		    return $result1;
	    }
	    function fetchDamageForCheckOut($id)
	    {
	    	$q1="SELECT * FROM damage_master WHERE BookingId=".$id;
	    	$result1=mysqli_query($this->con,$q1);
		    return $result1;	
	    }
	    function generateBill()
	    {
	    	require_once '../fpdf/fpdf.php';
	    	require_once 'pdfGenerator.php';
	    	$pdf= new PDF();
	    	$pdf->AliasNbPages();
		    $pdf->AddPage();
		    $pdf->SetFont('Times', '', 12);
		   	$path='C:/xampp/htdocs/basera/Uploads/TmpInvoices/';
		    $name="Invoice".date('dmYHis').rand(0,300)."."."pdf";
		    $pdf->Output($path.$name);
		    // $pdf->output();
		    $data=$path.$name;
		    require '../PHPMailer-master/PHPMailerAutoload.php';	
		     $mail = new PHPMailer();
                       //Enable SMTP debugging.
                      $mail->SMTPDebug = 0;
                      //Set PHPMailer to use SMTP.
                      $mail->isSMTP();
                      //Set SMTP host name
                      $mail->Host = "smtp.gmail.com";
                      $mail->SMTPOptions = array(
                                        'ssl' => array(
                                            'verify_peer' => false,
                                            'verify_peer_name' => false,
                                            'allow_self_signed' => true
                                        )
                                    );
                      //Set this to true if SMTP host requires authentication to send email
                      $mail->SMTPAuth = TRUE;
                      //Provide username and password
                      $mail->Username = "hackershah391@gmail.com";
                      $mail->Password = "kevinkevinshah";
                      //If SMTP requires TLS encryption then set it
                      $mail->SMTPSecure = "false";
                      $mail->Port = 587;
                      //Set TCP port to connect to
                      
                      $mail->From = "hackershah391@gmail.com";
                      $mail->FromName = "Admin";
                      
                      $mail->addAddress($_POST['CustEmail']);
                      
                      $mail->isHTML(true);
                     
                      $mail->Subject = "Invoice";
                      $mail->Body ="THANK YOU FOR TRAVELING WITH BASERA! WE LOOK FORWARD TO SERVE YOU AGAIN!";
                      $mail->addAttachment($data, "invoice.pdf");
                      if(!$mail->send())
                      {
                       return "Mailer Error: " . $mail->ErrorInfo;
                      }
                      else
                      {
                        $filestring1=$path.$name;
                        unlink($filestring1);
                        unset($_SESSION['resultset']);
                      	return "Success";
                      } 
	    }

	    function updateBookingAfterCheckOut($id)
	    {
	    	$q1="UPDATE booking_master SET ConfirmationStatus=3 WHERE BookingId=".$id;
	    	$result1=mysqli_query($this->con,$q1);
	    	if($result1)
	    	{
	    		$q2="UPDATE order_master SET IsDamage=0 WHERE BookingId=".$id;
		    	$result2=mysqli_query($this->con,$q2);
		    	return $result2;
	    	}

	    }
		function displayBookingIdForDamage()
	    {
	    	$date=date('Y-m-d');
	    	$q="SELECT bm.BookingId,cm.CustFirstName,hm.HouseName,bm.CheckInDate,bm.CheckOutDate From booking_master bm,customer_master cm,house_master hm WHERE cm.CustId=bm.CustId AND bm.HouseId=hm.HouseId AND bm.ConfirmationStatus=2 AND bm.CheckOutDate ='$date' AND hm.OwnerId=".$_SESSION['hostId'];
	    	$result=mysqli_query($this->con,$q);
	    	return $result;
	    }


	    function addDamage()
		{
		 	extract($_POST);
		 	try
		 	{
		 		if($_FILES['fileId']['type']=='image/png' || $_FILES['fileId']['type']=='image/jpg' || $_FILES['fileId']['type']=='image/jpeg' )
			 	{
			 		$txtImage=$_FILES['fileId']['name'];
					$txtImage=str_replace(' ', '', $txtImage);
					$temp = explode(".", $txtImage);
					$temp[0]=$temp[0].date('dmYHis').rand(0,300);
					$fileName=$temp[0].".".$temp[1];
					 		
				if(move_uploaded_file($_FILES['fileId']['tmp_name'],'../Uploads/DamageDetails/'.$fileName))
			 		{
			 			
			 			$q1="INSERT INTO damage_master(BookingId,ItemName,ItemDescription,Image, Price) VALUES($bookingId,'$txtItemName','$txtItemDesc','".$fileName."',$txtPrice)";
			 			$result1=mysqli_query($this->con,$q1);
				  		if($result1)
				  		{
				  			$q2="UPDATE order_master SET IsDamage=1 WHERE BookingId=".$bookingId;
			 				$result2=mysqli_query($this->con,$q2);
			 				if($result2)
			 				{
			 					return "Success";	
			 				}
			 				else
						  	{
								throw new RuntimeException(mysqli_error($this->con));
						  	}
				  			
					  	}
					  	else
					  	{
							throw new RuntimeException(mysqli_error($this->con));
					  	}
			 					
			 		}
			 			else
			 			{
			 				throw new RuntimeException('Failed to Upload File.');		
			 			}
				}
			 	else
			 		{
			 			throw new RuntimeException('Invalid file format. Only Image file is allowed');
			 		}
			
		 	}
		 	catch(RuntimeException $e)
		 	{
		 			return $e->getMessage();	
		 	}
		}
		function viewDamages($id)
		{
			if($id==0)
			{
				$q="SELECT * FROM damage_master dm,booking_master bm,owner_master om,house_master hm,customer_master cm WHERE dm.BookingId=bm.BookingId AND bm.HouseId=hm.HouseId AND hm.OwnerId=om.OwnerId AND bm.CustId=cm.CustId AND om.OwnerId=".$_SESSION['hostId'];
				
			}
			else
			{
				$q="SELECT * FROM damage_master dm,booking_master bm,owner_master om,house_master hm,customer_master cm WHERE dm.DamageId=$id AND dm.BookingId=bm.BookingId AND bm.HouseId=hm.HouseId AND hm.OwnerId=om.OwnerId AND bm.CustId=cm.CustId AND om.OwnerId=".$_SESSION['hostId'];
					
			}
			$result=mysqli_query($this->con,$q);
	    	return $result;
		}
		function deleteDamage($id)
		{
			$q1="SELECT Image FROM damage_master WHERE DamageId=".$id;
			$result1=mysqli_query($this->con,$q1);
			while ($data=mysqli_fetch_assoc($result1)) 
			{
				$filestring1= '../Uploads/DamageDetails/'.$data['Image'];
				if(unlink($filestring1))
				{
					$q2="DELETE FROM damage_master WHERE DamageId=".$id;
					$result2=mysqli_query($this->con,$q2);
					return $result2;	
				}
			}
			return null;
		}
		function updateDamage()
		{
			try
			{
				extract($_POST);
				if($_FILES['fileId']['name']!=null)
				{
				 		if($_FILES['fileId']['type']=='image/png' || $_FILES['fileId']['type']=='image/jpg' || $_FILES['fileId']['type']=='image/jpeg' )
					 	{
					 		$txtImage=$_FILES['fileId']['name'];
							$txtImage=str_replace(' ', '', $txtImage);
							$temp = explode(".", $txtImage);
							$temp[0]=$temp[0].date('dmYHis').rand(0,300);
							$fileName=$temp[0].".".$temp[1];
							 		
							if(move_uploaded_file($_FILES['fileId']['tmp_name'],'../Uploads/DamageDetails/'.$fileName))
					 		{
					 			$filestring1= '../Uploads/DamageDetails/'.$_POST['hiddenImage'];
								unlink($filestring1);
								$hiddenImage=$fileName;
					 		}
					 		else
					 		{
					 				throw new RuntimeException('Failed to Upload File.');		
					 		}
						}
					 	else
					 	{
				 			throw new RuntimeException('Invalid file format. Only Image file is allowed');
					 	}
				}
				$q="UPDATE damage_master SET ItemName='$txtItemName',ItemDescription='$txtItemDesc',Image='$hiddenImage',Price=$txtPrice WHERE DamageId=$hiddenId";
				$result=mysqli_query($this->con,$q);
				return $result;
				
			}
			catch(RuntimeException $e)
			{
	 			return $e->getMessage();	
			}
		}
		function searchData($key,$condition)
		{
			if($condition=="custName")
			{
				$q="SELECT CustId,CustFirstName,CustLastName FROM customer_master WHERE CustFirstName Like '$key%' OR CustLastName Like'$key%' ";
				$result=mysqli_query($this->con,$q);
				if(mysqli_num_rows($result)>0)
				{
					while ($data=mysqli_fetch_assoc($result))
					 {
						echo "<a href=viewBookings.php?id=".$data['CustId']."&operation=".$condition."&searchData=".$data['CustFirstName']."-".$data['CustLastName'].">".$data['CustFirstName']." ".$data['CustLastName'];
						echo"<br>";
					}
				}
				else
				{
					echo "No Suggestion";
				}
				
			}
			elseif($condition=="houseName")
			{
				$q="SELECT HouseId,HouseName FROM house_master WHERE HouseName Like '$key%' ";
				$result=mysqli_query($this->con,$q);
				if(mysqli_num_rows($result)>0)
				{
					while ($data=mysqli_fetch_assoc($result))
					 {
						echo "<a href=viewBookings.php?id=".$data['HouseId']."&operation=".$condition."&searchData=".$data['HouseName'].">".$data['HouseName'];
						echo"<br>";
					}
				}
				else
				{
					echo "No Suggestion";
				}
				
			}
			elseif($condition=="checkIn")
			{
				$q="SELECT BookingId,CheckInDate FROM booking_master WHERE CheckInDate Like '$key%' ";
				$result=mysqli_query($this->con,$q);
				if(mysqli_num_rows($result)>0)
				{
					while ($data=mysqli_fetch_assoc($result))
					 {
						echo "<a href=viewBookings.php?id=".$data['CheckInDate']."&operation=".$condition."&searchData=".$data['CheckInDate'].">".$data['CheckInDate'];
						echo"<br>";
					}
				}
				else
				{
					echo "No Suggestion";
				}
				
			}
		}
		function fetchBookingData($key,$condition)
		{
			if($condition=="custName")
			{
				$q="SELECT * FROM customer_master cm,booking_master bm,house_master hm WHERE hm.HouseId=bm.HouseId AND cm.CustId=bm.CustId AND bm.CustId=".$key;
				$result=mysqli_query($this->con,$q);
				return $result;
				
			}
			elseif($condition=="houseName")
			{
				$q="SELECT * FROM customer_master cm,booking_master bm,house_master hm WHERE hm.HouseId=bm.HouseId AND cm.CustId=bm.CustId AND bm.HouseId=".$key;
				$result=mysqli_query($this->con,$q);
				return $result;
				
			}	
			elseif($condition=="checkIn")
			{
				$q="SELECT * FROM customer_master cm,booking_master bm,house_master hm WHERE hm.HouseId=bm.HouseId AND cm.CustId=bm.CustId AND bm.CheckInDate='".$key."'";
				$result=mysqli_query($this->con,$q);
				return $result;
				
			}	
		}
	}	
?>