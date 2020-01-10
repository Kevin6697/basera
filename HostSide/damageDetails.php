<?php
	session_start();
		require_once 'Host.php';
		$host = new HostController();
		$result=$host->displayBookingIdForDamage();
	if(isset($_POST['submit']))
	{
		if($_POST['bookingId']==0)
		{
			$status="Please Select Booking Details";
		}
		else
		{
			$status=$host->addDamage();
		}
		
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
</style>
	<?php
		include 'headerlinks.html';
	?>
	<link rel="stylesheet" type="text/css" href="css/multistep-form.css">
	<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAd51MOn9Ba7Ih7diREEZfadNzheFj6n48&callback=initMap" type="text/javascript"></script>
	<script src="js/jquery-1.11.3.min.js"></script>
	<script src="js/multistep-form.js"></script>
	<script src="js/map.js"></script>
	</head>
	<body>
		<!-- Overlay preloader-->
		<div class="htlfndr-loader-overlay"></div>

		<div class="htlfndr-wrapper">
			<header>
				<?php
					include 'header.php';
				?>
				
				<noscript><h2>You have JavaScript disabled!</h2></noscript>
			</header>
			<main role="main">
				<!-- Section with popular destinations -->
				<section class="container htlfndr-top-destinations">
  	 			<br>
				<br>  
			
				<div class="col-md-8" >
				<div id="wrapper">
				 <form action="<?php echo $_SERVER['PHP_SELF']?>" id="htlfndr-contact-form" method="post" enctype="multipart/form-data">
		
					<div id="account_details">
								<label for="contact-name" class="htlfndr-required htlfndr-top-label">Booking Details</label>
								<br>
								<?php
									if(mysqli_num_rows($result)>0)
									{
										echo"<select name='bookingId' class=htlfndr-review-form-input>";
										echo"<option value=0 checked>-------------------------------CustomerName - HouseName - Check-In Date - Check-Out Date--------------------------------</option>";
										while($data=mysqli_fetch_assoc($result))
										{	
											echo"<option value=".$data['BookingId'].">-------------------------------".$data['CustFirstName']."  "."-"." ".$data['HouseName']." "."-"." ".$data['CheckInDate']." "." "."-"." ".$data['CheckOutDate']." "."-------------------------------------------</option>";
										}
										echo"</select>";
									}
									else
									{
							    ?>
								<script>
										$(document).ready(function() {
												swal({
														title:"info",
														text: "Not Booking Found Currently!",
														type: "info"
													},
													  function(){
													    window.location.href = 'homePage.php';
												});
										});
								</script>
								<?php	
		
									}
								?>
								<br><br>
   								<label for="contact-name" class="htlfndr-required htlfndr-top-label">Item Name</label>
								<input type="text" placeholder="ex:Demo" value="<?php if(isset($_POST['txtItemName'])){ echo $_POST['txtItemName'];}?>" id="fname" class="htlfndr-review-form-input" required name="txtItemName">
								<br><br>
    							<label for="contact-name" class="htlfndr-required htlfndr-top-label">Item Description</label>
    							<br>
    							<textarea placeholder="Enter Item Description" class="htlfndr-review-form-input" name="txtItemDesc" maxlength="255" rows=5><?php if(isset($_POST['txtItemDesc'])){ echo $_POST['txtItemDesc'];}?></textarea>
								<br>
								<br>
	              				<label for="contact-name" class="htlfndr-required htlfndr-top-label">Image</label>
								<input type="file" name="fileId"  id="contact-email" class="htlfndr-review-form-input" required>
								<br><br>
								<label for="contact-name" class="htlfndr-required htlfndr-top-label">Price</label>
								<input type="number" name="txtPrice" min="10" id="number" class="htlfndr-review-form-input" value="<?php if(isset($_POST['txtPrice'])){ echo $_POST['txtPrice'];}?>" required placeholder="ex:100">
								<br><center>
							<input type="submit" id="submit"  name="submit" value=" Insert " class="btn-primary"></center>
							<?php
								 if(isset($status))
								 {
								 	if($status=="Success")
								 	{
								 	?>
								 		    <script>
												$(document).ready(function() {
													swal({
														title:"Success",
														text: "Data Inserted  Successfully!",
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
								 		echo "<span style='color:red;font-size:20px;padding-left:12% '>".$status."</span>";
								 	}
								 }
							?>
													
					  </div>
					  

			   
		</form>
	</div>

				</div>	 
				</section><!-- .container.htlfndr-top-destinations -->
			</main>
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
