<?php
	session_start();
	if(!empty($_SESSION['hostId']))
		{
			header("Location:homePage.php");
		}
	if(isset($_POST['submit']))
	{
		require_once 'Host.php';
		$host = new HostController();
		$result=$host->loginCheck();
	}	
?>
<!DOCTYPE html>
<html lang="en">
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
</head>
<body class="single">
<!-- Overlay preloader-->
<div class="htlfndr-loader-overlay"></div>

<div class="htlfndr-wrapper">
	<!-- Start of main content -->
	<div class="container">
		<main id="htlfndr-contact-us" class="htlfndr-main-content" role="main">	
			<div class="row htlfndr-contact-page">
				<h1 class="text-center">Login Page</h1>
				<div class="htlfndr-section-under-title-line"></div>
					<div class="col-md-8" style="padding-left:20%;">
							<span class="htlfndr-required "></span>&nbsp&nbsp&nbsp&nbsp
					 		means required
						<form action="<?php echo $_SERVER['PHP_SELF']?>" id="htlfndr-contact-form" method="post">
							<label for="contact-name" class="htlfndr-required htlfndr-top-label">E-mail</label>
							<input id="contact-email" placeholder="ex:test@test.com" class="htlfndr-review-form-input" type="email" name="txtEmail" required  value=<?php if(isset($_POST['txtEmail'])){ echo $_POST['txtEmail'];}?>>
							<label for="contact-email" class="htlfndr-required htlfndr-top-label">Password</label>
							<input id="contact-name" placeholder="ex:Demo@123" class="htlfndr-review-form-input" type="password" name="txtPassword" required>
							

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
													text: "Login Successfully!",
													type: "success"
												},
												  function(){
												    window.location.href = 'homePage.php';
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
							<input type="submit"  name="submit" value=" Login " class="btn-primary">						
						</form>
				
					<div class="clearfix">
		
						<br>
							<span>Don't Have an Account? 
								<a style="font-size: 20px" href="signin.php">
									<span>Sign up</span>
								</a>
							</span>
						<br>	
						<a style="font-size: 20px" href="forgotpassword.php">Forgot Password?</a>
				</div>			
			</div><!-- .row .htlfndr-contact-page -->
		</main><!-- .htlfndr-hotel-single-content -->
		</div><!-- .container -->
	<!-- End of main content -->
</div>
		<!-- .htlfndr-wrapper -->
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="js/jquery-1.11.3.min.js"></script>
<!-- Include Jquery UI script file -->
<script src="js/jquery-ui.min.js"></script>
<!-- Include Query UI Touch Punch is a small hack that enables the use
		 of touch events on sites using the jQuery UI user interface library. -->
<script src="js/jquery.ui.touch-punch.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/bootstrap.min.js"></script>
<!-- Include Touch Menu Hover script file -->
<script src="js/jquery.ui.touch-punch.min.js"></script>
<!-- Include Owl Carousel script file -->
<script src="js/owl.carousel.min.js"></script>
<!-- Include main script file -->
<script src="js/script.js"></script>
<!--<script src="js/less.min.js" ></script> -->
</body>
</html>
