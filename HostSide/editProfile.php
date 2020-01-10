<?php
session_start();

	require_once 'Host.php';
	$host = new HostController();
	$result=$host->selectHostForEdit();
	if(isset($_POST['submit']))
	{
		$status=$host->editProfile();
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
			margin-top: -50px;
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
		<header>
				<?php
					include 'header.php';
				?>
				
				<noscript><h2>You have JavaScript disabled!</h2></noscript>
			</header>
	<div class="container">
		<main id="htlfndr-contact-us" class="htlfndr-main-content" role="main">	
			<div class="row htlfndr-contact-page">
					<div class="col-md-8" style="padding-left:20%;">
						<form action="<?php echo $_SERVER['PHP_SELF']?>" enctype="multipart/form-data" id="htlfndr-contact-form" method="post">
						<div class="row">
								<div class="col-md-6">
								<label for="contact-name" class="htlfndr-required htlfndr-top-label">First Name</label>
								
						<?php
						while($data=mysqli_fetch_assoc($result))
						{
						?>

						<input type="text" placeholder="demo" id="fname" class="htlfndr-review-form-input" required name="txtFirstName" value=<?php if(isset($_POST['txtFirstName'])){echo $_POST['txtFirstName']; }else{echo $data['OwnerFirstName'];}?>>
									        <span id="p1" style="display: none; color: red">Invalid First Name </span>
    
								</div>
								<div class="col-md-6">
									<label for="contact-name" class="htlfndr-required htlfndr-top-label">Last Name</label>
											<input type="text" placeholder="demo" id="lname" class="htlfndr-review-form-input"  required name="txtLastName" value=<?php if(isset($_POST['txtLastName'])){echo $_POST['txtLastName']; }else{ echo $data['OwnerLastName'];}?>>
										 	<span id="p2" style="display: none; color: red">Invalid Last Name </span>
               					
								</div>
							</div>
							<div class="col-md-14">
										<label for="contact-name" class="htlfndr-required htlfndr-top-label">Email</label>
										<input type="email" placeholder="demo@test.com" name="txtEmail" id="email" class="htlfndr-review-form-input" required  value=<?php if(isset($_POST['txtEmail'])){echo $_POST['txtEmail']; } else{echo $data['OwnerEmail'];}?>>
										<span id="p4" style="display: none; color: red">Invalid Email </span>	
              				</div>
							<div class="col-md-14">
							<label for="contact-name" class="htlfndr-required htlfndr-top-label">Number</label>
							<input type="text" name="txtNumber" id="number" class="htlfndr-review-form-input" required placeholder="9876543210" value=<?php if(isset($_POST['txtNumber'])){echo $_POST['txtNumber']; } else{echo $data['OwnerNumber'];}?>>
							  <span id="p3" style="display: none; color: red">Invalid Phone Number </span>
							</div> 
							<div class="col-md-14">
							  
              				<label for="contact-name" class="htlfndr-required htlfndr-top-label">ID Proof</label>
							<input type="hidden" name="txtImage" id="number" class="htlfndr-review-form-input" required value='<?php if(isset($_POST['fileId'])){echo $_POST['fileId']; } else{echo $data['OwnerKYC'];}?>'>
							
							<input type="file" name="fileId"  id="contact-email" class="htlfndr-review-form-input">
							<?php
								 if(isset($status))
								 {
								 	if($status=="Sucucess")
								 	{
								 	?>
								 	<script>
											$(document).ready(function() {
												swal({
														title:"Success",
														text: "Your Profile has been updated!",
														type: "success"
													},
													  function(){
													    window.location.href = 'homePage.php';
												});
											});
									</script>
								 	<?php	
								 	}
								 	elseif(substr( $status, 0, 9 ) == "Duplicate")
								 	{
								 		echo "<div style='color:red;font-size:20px;padding-left:25% '> Email or Phone Number Already Exists".$status."</div>";	
								 	}
								 	else
								 	{
								 		echo "<div style='color:red;font-size:20px;padding-left:25% '>".$status."</div>";
								 	}
								}
							?>
						</div>	
							&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
							&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
							&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
							&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
							&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
							<input type="submit" id="submit"  name="submit" value=" Update " class="btn-primary">						
						</form>
					<?php
						}
					?>
					<div class="clearfix">
					</div>			
			</div><!-- .row .htlfndr-contact-page -->
		</main><!-- .htlfndr-hotel-single-content -->
		</div><!-- .container -->
	<!-- End of main content -->
</div>
<footer class="htlfndr-footer">
		<?php
				include 'footer.html';
			?>
		</div><!-- .htlfndr-wrapper -->
		<?php
			include 'footerlinks.html';
		?>
</body>
</html>
