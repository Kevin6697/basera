<?php
	session_start();
	if(!empty($_SESSION['hostId']) )
	{
		header("Location:homePage.php");
	}
	
	if(isset($_POST['submit']))
	{
		require_once 'Host.php';
		$host = new HostController();
		$result=$host->registration();
	}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	<title>Basera</title>
	<!-- favicon -->
	<link rel="shortcut icon" href="images/icon-ups-drinks.png">
	<?php
		include 'headerlinks.html';
	?>
	<script src="js/jquery-1.11.3.min.js"></script>
	<script src="js/registrationValidation.js"></script>
	<style type="text/css">
		.field-icon {
			float: right;
			margin-left: -25px;
			margin-top: 14px;
			position: relative;
			z-index: 2;
			}
	</style>	
</head>
<body class="single">
<!-- Overlay preloader-->
<div class="htlfndr-loader-overlay"></div>

<div class="htlfndr-wrapper">
	<!-- Start of main content -->
	<div class="container">
		<main id="htlfndr-contact-us" class="htlfndr-main-content" role="main">	
			<div class="row htlfndr-contact-page">
				<h1 class="text-center">Registration Page</h1>
				<div class="htlfndr-section-under-title-line"></div>
					<div class="col-md-8" style="padding-left:20%;">
							<span class="htlfndr-required "></span>&nbsp&nbsp&nbsp&nbsp
					 		means required
						<form action="<?php echo $_SERVER['PHP_SELF']?>" enctype="multipart/form-data" id="htlfndr-contact-form" method="post">
							
							<div class="row">
								<div class="col-md-6">
											<label for="contact-name" class="htlfndr-required htlfndr-top-label">First Name</label>
											<input type="text" placeholder="ex:Demo" id="fname" class="htlfndr-review-form-input" required name="txtFirstName" value=<?php if(isset($_POST['txtFirstName'])){echo $_POST['txtFirstName'];}?>>
									        <span id="p1" style="display: none; color: red">Invalid First Name </span>
    
								</div>
								<div class="col-md-6">
									<label for="contact-name" class="htlfndr-required htlfndr-top-label">Last Name</label>
											<input type="text" placeholder="ex:Demo" id="lname" class="htlfndr-review-form-input"  required name="txtLastName" value=<?php if(isset($_POST['txtLastName'])){echo $_POST['txtLastName'];}?>>
										 	<span id="p2" style="display: none; color: red">Invalid Last Name </span>
               					
								</div>
							</div>

							<div class="row">
									<div class="col-md-6">
										<label for="contact-name" class="htlfndr-required htlfndr-top-label">Email</label>
										<input type="email" placeholder="ex:test@test.com" name="txtEmail" id="email" class="htlfndr-review-form-input" required  value=<?php if(isset($_POST['txtEmail'])){echo $_POST['txtEmail'];}?>>
										<span id="p4" style="display: none; color: red">Invalid Email </span>	
              					</div>
								<div class="col-md-6">
									 <label for="contact-name" class="htlfndr-required htlfndr-top-label">Password</label>
									<input type="password"  name="txtPassword" id="password-field" placeholder="ex:Demo@123" class="htlfndr-review-form-input" required >
								    <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                	                <span id="passworderror" style="display: none; color: red">Invalid Password Minimum of 8 characters with 1 uppercase 1 special character and 1 number</span>	
								</div>
							</div>
							<label for="contact-name" class="htlfndr-required htlfndr-top-label">Number</label>
							<input type="text" name="txtNumber" id="number" class="htlfndr-review-form-input" required placeholder="ex:0000000000" value=<?php if(isset($_POST['txtNumber'])){echo $_POST['txtNumber'];}?>>
							  <span id="p3" style="display: none; color: red">Invalid Phone Number </span>
              				<label for="contact-name" class="htlfndr-required htlfndr-top-label">ID Proof</label>
							<input type="file" name="fileId"  id="contact-email" class="htlfndr-review-form-input" required>
							<input type="checkbox" name="" id="tc" required> I accept <a href="termsandcondition.html" target="_blank">Terms And Conditions</a>
							<br>
							<span id="termsandcondtionerror" style="display: none; color: red">Please agree those terms and conditions  </span>
							<br>
							<?php
								 if(isset($result))
								 {
								 	if($result=="Success")
								 	{
								 	?>
								 		    <script>
												$(document).ready(function() {
													swal({
														title:"Success",
														text: "Registerted Successfully!",
														type: "success"
													},
													  function(){
													    window.location.href = 'index.php';
													});
											   });
											</script>
								 	<?php
								 	}
								 	else
								 	{
								 		echo "<div style='color:red;font-size:20px;padding-left:25% '>".$result."</div>";
								 	}
								 }
							?>
							&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
							&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
							&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
							&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
							&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
							<input type="submit" id="submit"  name="submit" value=" Register " class="btn-primary">						
						</form>
				
					<div class="clearfix">
					<br>	
					Have an account ?	<a href="index.php" style="font-size: 20px">Login Page</a>
				</div>			
			</div><!-- .row .htlfndr-contact-page -->
		</main><!-- .htlfndr-hotel-single-content -->
		</div><!-- .container -->
	<!-- End of main content -->
</div>
	<?php
		// include'footerlinks.html';
	?>	
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
  	 <script>
  	 		 $(".toggle-password").click(function() {

				  $(this).toggleClass("fa-eye fa-eye-slash");
				  var input = $($(this).attr("toggle"));
				  if (input.attr("type") == "password") {
				    input.attr("type", "text");
				  } else {
				    input.attr("type", "password");
				  }
				});
 </script>
</body>
</html>
