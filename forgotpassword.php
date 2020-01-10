<?php
	session_start();
	if(!empty($_SESSION['hostId']))
	{
		header("Location:homePage.php");
	}
	if(isset($_POST['submit']))
	{
		require_once "Host.php";
		$host = new Maincontroller();
		$result=$host->forgotPassword();
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	<title>Forgot Password </title>
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
				<h1 class="text-center">ForgotPassword Page</h1>
				<div class="htlfndr-section-under-title-line"></div>
					<div class="col-md-8" style="padding-left:20%;">
							<span class="htlfndr-required "></span>&nbsp&nbsp&nbsp&nbsp
					 		means required
						<form action="<?php echo $_SERVER['PHP_SELF']?>" id="htlfndr-contact-form" method="post">
							<label for="contact-name" class="htlfndr-required htlfndr-top-label">Email for  New Password 
	      		</label>
							<input id="contact-email" class="htlfndr-review-form-input" type="email" name="txtEmail" required  value=<?php if(isset($_POST['txtEmail'])){echo $_POST['txtEmail'];}?>>

							<?php
								 if(isset($result))
								 {
								 	if($result=="Your New Password has been send to your email")
								 	{
								 	?>
								 		<script>
												$(document).ready(function() {
													swal({
														title:"Success",
														text: "Your New Password has been send to your email!",
														type: "info"
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
							<input type="submit"  name="submit" value=" Send Password " class="btn-primary">						
						</form>
				
					<div class="clearfix">
					<br>	
						<a href="index.php" style="font-size: 20px">Login Page</a>
				</div>			
			</div><!-- .row .htlfndr-contact-page -->
		</main><!-- .htlfndr-hotel-single-content -->
		</div><!-- .container -->
	<!-- End of main content -->

</div>
	<?php
		include 'footerlinks.html';
	?>	
</body>
</html>

