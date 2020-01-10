<?php

class Maincontroller
{
	private $hostName = "localhost";
	private $userName = "root";
	private $password = "";
	private $DBname = "basera";
	private $con;

	function __construct()
	{
		$con = $this->Connection();
	}

	public function getData(){
		return ['success'];
	}

	public function Connection()
	{
		$this->con = mysqli_connect($this->hostName,$this->userName,$this->password,$this->DBname);
		return $this->con;
	}

	//Customer Registration

	public function cutomerRegistration()
	{
		$txtFirstName = $_POST['txtFirstName'];
		$txtLastName = $_POST['txtLastName']; 
		$txtEmail = $_POST['txtEmail'];
		$txtConfirmPassword = sha1($_POST['txtConfirmPassword']); 
		$txtNumber = $_POST['txtNumber']; 
		
		$query = "INSERT INTO customer_master(CustFirstName, CustLastName, CustEmail, CustPassword, CustNumber, KYC_Status) VALUES ('$txtFirstName','$txtLastName','$txtEmail','$txtConfirmPassword','$txtNumber',0)";
		
		$sql = mysqli_query($this->con,$query);	
		$select_query = "SELECT * FROM customer_master WHERE CustEmail = '$txtEmail'";
		$sqlselect = mysqli_query($this->con,$select_query);	
		$result = mysqli_num_rows($sqlselect);
		if($result > 0)
		{
			$data = mysqli_fetch_assoc($sqlselect);
			return $data;
		}
		else
		{
			return FALSE;
		}

	}

	//Customer Registration

	public function cutomerLogin()
	{
		$txtEmail = $_POST['txtEmail'];
		$txtPassword = sha1($_POST['txtPassword']);

		$query = "SELECT * FROM customer_master WHERE CustEmail = '$txtEmail' AND CustPassword = '$txtPassword' ";
		$sql = mysqli_query($this->con,$query);	
		$result = mysqli_num_rows($sql);
		if($result > 0)
		{
			$data = mysqli_fetch_assoc($sql);
			return $data;
		}
		else
		{
			return FALSE;
		}

	}

	public function DisplayCustomer($id)
	{
		$query = "SELECT * FROM customer_master WHERE CustId = '$id'";
		$sql = mysqli_query($this->con,$query);
		$result = mysqli_fetch_assoc($sql);
		return $result;
	}

	public function KYCUpload($custId)
	{
		$target_dir = "uploads/";
		$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
		$uploadOk = 1;
		$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
		// Check if image file is a actual image or fake image
		if(isset($_POST["submit"])) {
		    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
		    if($check !== false) {
		        return "File is an image - " . $check["mime"] . ".";
		        $uploadOk = 1;
		    } else {
		        return "File is not an image.";
		        $uploadOk = 0;
		    }
		}
		// Check if file already exists
		if (file_exists($target_file)) {
		    return "Sorry, file already exists.";
		    $uploadOk = 0;
		}
		// Check file size
		if ($_FILES["fileToUpload"]["size"] > 500000) {
		    return "Sorry, your file is too large.";
		    $uploadOk = 0;
		}
		// Allow certain file formats
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
		&& $imageFileType != "gif" ) {
		    return "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
		    $uploadOk = 0;
		}
		// Check if $uploadOk is set to 0 by an error
		if ($uploadOk == 0) {
		    return "Sorry, your file was not uploaded.";
		// if everything is ok, try to upload file
		} 
		else 
		{
		    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) 
		    {
		    	$custKYC = basename($_FILES["fileToUpload"]["name"]);
		    	$query = "UPDATE customer_master SET CustKYC='$custKYC', KYC_Status=1 WHERE CustId = '$custId'";
		    	$result = mysqli_query($this->con,$query);
		        return "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
		    } else {
		        return "Sorry, there was an error uploading your file.";
		    }
		}

	}

	public function CheckKYCStatus($id)
	{
		$query = "SELECT * FROM customer_master WHERE CustId = '$id'";
		$sql = mysqli_query($this->con,$query);
		$result = mysqli_fetch_assoc($sql);
		return $result;
	}

	public function fetchHome($place,$guests)
	{
		$query = "SELECT * FROM house_master JOIN area_master ON area_master.AreaId = house_master.AreaId JOIN city_master ON area_master.CityId = city_master.CityId JOIN state_master ON city_master.StateId = state_master.StateId WHERE area_master.AreaName LIKE '$place%' OR city_master.CityName LIKE '$place%' OR state_master.StateName LIKE '$place%' AND house_master.NoofAllowedGuest = $guests";
		$sql = mysqli_query($this->con,$query);
		return $sql;
	}

	public function fetchImage($id)
	{
		$query = "SELECT * FROM houseimage_master WHERE HouseId = $id LIMIT 1";
		$sql = mysqli_query($this->con,$query);
		return $sql;
	}

	public function DisplayHome($id)
	{
		$query = "SELECT * FROM house_master JOIN area_master ON area_master.AreaId = house_master.AreaId JOIN city_master ON area_master.CityId = city_master.CityId JOIN state_master ON city_master.StateId = state_master.StateId WHERE HouseId = $id";
		$sql = mysqli_query($this->con,$query);
		$result = mysqli_fetch_assoc($sql);
		return $result;
	}
	
	public function OwnerData($id)
	{
		$query = "SELECT * FROM owner_master WHERE OwnerId = $id";
		$sql = mysqli_query($this->con,$query);
		$result = mysqli_fetch_assoc($sql);
		return $result;
	}

	public function fetchImages($id)
	{
		$query = "SELECT * FROM houseimage_master WHERE HouseId = $id";
		$sql = mysqli_query($this->con,$query);
		return $sql;
	}

	public function fetchAminities($id)
	{
		$query = "SELECT * FROM `houseaminities_tranasction` JOIN aminities_master ON houseaminities_tranasction.AminitiesId = aminities_master.AminitiesId WHERE HouseId = $id";
		$sql = mysqli_query($this->con,$query);
		return $sql;
	}

	//forgot password function
	 	function forgotPassword()
	 	{
	 		$query1 ="select CustEmail, CustId from customer_master where CustEmail = '".$_POST['txtEmail']."' "; 
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
					$txtPassword=sha1('User@123');				  	
			  		$q2="update customer_master set CustPassword ='$txtPassword' where  	CustId='".$fetch[' CustId']."'";
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

}

?>