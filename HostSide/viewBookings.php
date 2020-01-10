<?php
	session_start();
	require_once 'Host.php';
	$host = new HostController();
	if(isset($_GET['operation']))
	{
		$result=$host->fetchBookingData($_GET['id'],$_GET['operation']);
	}
	else
	{
		$status="Error";
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
</head>
<body class="single">
<!-- Overlay preloader-->
<div class="htlfndr-loader-overlay"></div>

	<div class="htlfndr-wrapper">
	<!-- Start of main content -->
		<header>
			<?php
				include 'headerlinks.html';
			?>
			<link rel="stylesheet" type="text/css" href="css/multistep-form.css">
			<script src="js/jquery-1.11.3.min.js"></script>
			
			<script src="js/multistep-form.js"></script>
	
				<?php
					include 'header.php';
				?>
				
				<noscript><h2>You have JavaScript disabled!</h2></noscript>
			</header>
			<div class="container">
				<main id="htlfndr-contact-us" class="htlfndr-main-content" role="main">	
					<?php
						if(isset($status))
						{
					?>
						<script>
						$(document).ready(function() {
								swal({
										title:"info",
										text: "Please Select Search Option!",
										type: "info"
									},
									  function(){
									    window.location.href = 'bookingHistory.php';
								});
						});
					</script>
					<?php		
						}
					?>
					<div class="row htlfndr-contact-page">
						<main role="main">
							<section class="container htlfndr-top-destinations">
								<h2 class="htlfndr-section-title">searched <?php echo"\"".$_GET['searchData']."\""?> </h2>
								<div class="htlfndr-section-under-title-line"></div>
							<div class="htlfndr-user-panel col-sm-8 col-md-9 htlfndr-info-page">	
								<div id="htlfndr-user-tab-1" class="htlfndr-description-table">
								<?php
									if(mysqli_num_rows($result)>0)
									{

								?>
								<table class="htlfndr-personal-info-table" style="margin-left: -10%;">
									<?php
										while ($data=mysqli_fetch_assoc($result))
										 {
									?>
											<tr>
												<th style="color:#23def7;" class="htlfndr-scope-row">customer name:</th>
												<td style="color:black;"><?php echo $data['CustFirstName']." ".$data['CustLastName']; ?></td>
											</tr>
											<tr>
												<th style="color:#23def7;" class="htlfndr-scope-row">customer email:</th>
												<td style="color:black;"><?php echo $data['CustEmail']; ?></td>
											</tr>
											<tr>
												<th style="color:#23def7;" class="htlfndr-scope-row">customer Number:</th>
												<td style="color:black;"><?php echo $data['CustNumber']; ?></td>
											</tr>
											<tr>
												<th style="color:#23def7;" class="htlfndr-scope-row">house name:</th>
												<td style="color:black;"><?php echo $data['HouseName']; ?></td>
											</tr>
											<tr>
												<th style="color:#23def7;" class="htlfndr-scope-row">Total Number of Guest:</th>
												<td style="color:black;"><?php echo $data['TotalNoOfGuest']; ?></td>
											</tr>
											<tr>
												<th style="color:#23def7;" class="htlfndr-scope-row">Check-In Date:</th>
												<td style="color:black;"><?php echo $data['CheckInDate']; ?></td>
											</tr>
											<tr>
												<th style="color:#23def7;" class="htlfndr-scope-row">Check-out Date:</th>
												<td style="color:black;"><?php echo $data['CheckOutDate']; ?></td>
											</tr>
											<tr>
												<th style="color:#23def7;" class="htlfndr-scope-row">transaction id:</th>
												<td style="color:black;"><?php echo $data['TranactionId']; ?></td>
											</tr>
											<tr>
												<th style="color:#23def7;" class="htlfndr-scope-row">total amount:</th>
												<td style="color:black;"><?php echo $data['DuePayment']+$data['AdvancePayment']; ?></td>
											</tr>
											<tr>
												<th><br> <br></th>
											</tr>
								<?php
									}
								?>		
										</table>
								<?php
									}
									else
									{
										echo" No Booking Found ";
									}
								?>		
								</div>	
								</div>		
							</div>	
							</section>
						</main>
					</div>
				</main>
			</div>	

</div>

<footer class="htlfndr-footer">
		<?php
				include 'footer.html';
			?>
		</div><!-- .htlfndr-wrapper -->
		<?php
			include 'footerlinks.html';
		?>
</footer>		
</body>
</html>