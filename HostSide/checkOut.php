<?php
	session_start();
		require_once 'Host.php';
		$host = new HostController();
		if(isset($_POST['submit']))
		{
			$error='';
			$resultSet=$host->fetchBookingForCheckOut($_POST['BookingId']);
			if(mysqli_num_rows($resultSet)>0)
			{
				$_SESSION['resultSet']=$resultSet;
				$result=$host->generateBill();
				if($result=="Success")
				{
					$status=$host->updateBookingAfterCheckOut($_POST['BookingId']);
					$error="Success";
				}	
				else
				{
					$error=$result;
				}
			}
		}
		$result=$host->displayForCheckOut();
		
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
				<br>	 
				<div class="col-md-8" >
				<div id="wrapper">
					<div id="htlfndr-user-tab-1" class="htlfndr-description-table">
					
						<table class="htlfndr-personal-info-table">
								<?php
									if(mysqli_num_rows($result)>0)
									{
										while($data=mysqli_fetch_assoc($result))
										{
											echo"<tr>
												<th class=htlfndr-scope-row>customer name : </th>
												<td>".$data['CustFirstName']." ".$data['CustLastName']."</td>
												</tr>";
											echo"<tr>
												<th class=htlfndr-scope-row>House name : </th>
												<td>".$data['HouseName']."</td>
												</tr>";
											echo"<tr>
												<th class=htlfndr-scope-row>Customer E-mail  : </th>
												<td>".$data['CustEmail']."</td>
												</tr>";
											echo"<tr>
												<th class=htlfndr-scope-row>Phone Number  : </th>
												<td>".$data['CustNumber']."</td>
												</tr>";							
											echo"<tr>
												<th class=htlfndr-scope-row> Check-Out Date  : </th>
												<td>".$data['CheckOutDate']."</td>
												</tr>";						
											echo"<tr>
												<th class=htlfndr-scope-row> Paid Amount  : </th>
												<td>".$data['AdvancePayment']."</td>
												</tr>";						
											echo"<tr>
												<th class=htlfndr-scope-row> Due Amount  : </th>
												<td>".$data['DuePayment']."</td>
												</tr>";			
																			
																			
											echo"<tr>
												<td></td>
											</tr>";	
											echo"<tr>
												<td>
												<form method=post action=".$_SERVER['PHP_SELF'].">
												<input type=hidden name=BookingId value=".$data['BookingId'].">
												<input type=hidden name=CustEmail value=".$data['CustEmail']."><input type=submit class=btn-primary name=submit value=Check-Out></td>
												</form>
												</tr>";	
											echo"<tr>
												<td></td>
											</tr>";	
											echo"<tr>
												<td></td>
											</tr>";	
											echo"<tr>
												<td></td>
											</tr>";		
										}
									}
									else
									{
							    ?>
								<script>
										$(document).ready(function() {
												swal({
														title:"info",
														text: "Not Check-Out(s) Found For Today!",
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
						</table>
					</div>
				
							<?php
								 if(isset($error))
								 {
								 	if($error=="Success")
								 	{
								 	?>
								 		    <script>
												$(document).ready(function() {
													swal({
														title:"Success",
														text: "Checked-Out Successfully!",
														type: "success"
													},
													  function(){
													    window.location.href = 'CheckIn.php';
													});
											   });
											</script>
								 	<?php
								 	}
								 	else
								 	{
								 		echo "<span style='color:red;font-size:20px;padding-left:12% '>".$error."</span>";
								 	}
								 }
							?>
													
					  </div>
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
