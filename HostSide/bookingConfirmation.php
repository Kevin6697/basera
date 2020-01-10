<?php
	session_start();
	require_once 'Host.php';
	$host = new HostController();
	if(isset($_POST['readmore']))
	{
		$result2=$host->bookingDetailsForConfirmation($_POST['BookingId']);
	}
	else if(isset($_POST['readless']))
	{
		$result1=$host->bookingDetailsForConfirmation(0);
	}
	else if(isset($_POST['cancelReason']))
	{
		$status=$host->ConfirmBooking($_POST['id'],$_POST['operation']);
	}
	else
	{
		$result1=$host->bookingDetailsForConfirmation(0);
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
	<style type="text/css">
		#more 
		{
			display: none;
		}
	</style>
		<script src="js/jquery-1.11.3.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$('.htlfndr-book-now-button-demo').click(function(){
				var ConfirmId=$(this).attr('id');
				swal({
						title:"Confirm",
						text: "Are you sure  you want to Confirm Booking !",
						type: "info",
						showCancelButton: true,
					    confirmButtonColor: '#DD6B55',
					    confirmButtonText: 'Yes, I am sure!',
					    cancelButtonText: "No, cancel it!",
					    closeOnConfirm: true,
    					closeOnCancel: true
					},
					  function(isConfirm){
					  	if(isConfirm)
					  	{
					  		        var w = 200;
							        var h = 200;
							        var left = Number((screen.width/2)-(w/2));
							        var tops = Number((screen.height/2)-(h/2));
					  				var w = window.open('','','toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width='+w+', height='+h+', top='+tops+', left='+left);
							w.document.write('Wait mail is being sent')
							w.focus()
							setTimeout(function() {w.close();}, 2000)
					  		$('.htlfndr-book-now-button-demo').hide();
					  		$('.htlfndr-book-now-button-cancel').hide();
					  		$.get('ConifrmUnconfirm.php',{operation1:'ConfirmBooking',ConfirmId:ConfirmId},function(data)
							{
								if(data=="Confirm")
								{	
									swal({
											title:"Booked Successfully!",
											type: "success"
										},
									  function(){
									    window.location.href = 'homePage.php';
									});
								}
								else
								{
									swal({
											title:data,
											type: "error"
										},
									  function(){
									    window.location.href = 'bookingConfirmation.php';
									});	
								}
							});		
					  	}
				});
			});
				$('.htlfndr-book-now-button-cancel').click(function(){
				var ConfirmId=$(this).attr('id');
				swal({
						title:"Cancel",
						text: "Are you sure  you want to Cancel the  Booking !",
						type: "warning",
						showCancelButton: true,
					    confirmButtonColor: '#DD6B55',
					    confirmButtonText: 'Yes, I am sure!',
					    cancelButtonText: "No, cancel it!",
					    closeOnConfirm: true,
    					closeOnCancel: true
					},
					  function(isConfirm){
					  	if(isConfirm)
					  	{
					  		$("#ReasonhideDiv").fadeIn(800);		
					  	}
					  	else
					  	{
					  		$("#ReasonhideDiv").fadeOut(800);	
					  	}
				});
			});		
		});
	</script>
</head>
<body class="single">
<!-- Overlay preloader-->
<div class="htlfndr-loader-overlay"></div>

<div class="htlfndr-wrapper">
	<header>
				<?php
					include 'header.php';
				?>
		<noscript><h2>You have JavaScript disabled!</h2></noscript>
	</header>
	<div class="container">
	
	<main id="htlfndr-contact-us" class="htlfndr-main-content" role="main">	
		<div class="row htlfndr-contact-page">
			<main role="main">
					<div class="htlfndr-user-panel col-sm-8 col-md-9 htlfndr-info-page">
			<?php
				if(isset($status))
				{
					echo $status;
					if($status=="Success")
					{
			?>
					<script>
						$(document).ready(function() {
							swal({
								title:"Success",
								text: "Cancelled Successfully!",
								type: "success"
							},
							  function(){
							    window.location.href = 'bookingConfirmation.php';
							});
					   });
					</script>
			<?php			
					}
				}
			?>
		<?php
		if(isset($result1))
		{
			if(mysqli_num_rows($result1)==0)
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
			else
			{
			
		?>	
			<?php
					while($data=mysqli_fetch_assoc($result1))
				{
			?>		
			
							<br>
				<br>
				<br>
					<div id="htlfndr-user-tab-1" class="htlfndr-description-table">
					<span id="hide">	
			
						<table class="htlfndr-personal-info-table">
							<tr>
								<th class="htlfndr-scope-row">customer name:</th>
								<td><?php echo $data['CustFirstName']." ".$data['CustLastName'];?></td>
							</tr>
							<tr>
								<th class="htlfndr-scope-row">customer e-mail:</th>
								<td><?php echo $data['CustEmail'];?></td>
							</tr>
							<tr>
								<th class="htlfndr-scope-row">phone number:</th>
								<td><?php echo $data['CustNumber'];?></td>
							</tr>
							<tr>
								<th class="htlfndr-scope-row">total no. of guests:</th>
								<td><?php echo $data['TotalNoOfGuest'];?></td>
							</tr>
							<tr>
								<th class="htlfndr-scope-row">house name :</th>
								<td><?php echo $data['HouseName'];?></td>
							</tr>
						</table>
					</span>	
						<span id="dots">...</span>				
				</div>
					<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
						<input type="hidden" value="<?php echo $data['BookingId'];?>" name='BookingId'>
						<input type="submit" class="btn-primary" name="readmore" value="Read More">
					</form>
			<?php
					}
			}
		  }	
		  else if(isset($result2))
		  {
		  	while($data=mysqli_fetch_assoc($result2))
				{
			?>		
			
					<div id="htlfndr-user-tab-1" class="htlfndr-description-table">
					<span id="hide">	
						<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
						<input type="submit" class="btn-primary" name="readless" value="Read Less">
					</form>
						<table class="htlfndr-personal-info-table">
							<tr>
								<th class="htlfndr-scope-row">customer name:</th>
								<td><?php echo $data['CustFirstName']." ".$data['CustLastName'];?></td>
							</tr>
							<tr>
								<th class="htlfndr-scope-row">customer e-mail:</th>
								<td><?php echo $data['CustEmail'];?></td>
							</tr>
							<tr>
								<th class="htlfndr-scope-row">phone number:</th>
								<td><?php echo $data['CustNumber'];?></td>
							</tr>
							<tr>
								<th class="htlfndr-scope-row">total no. of guests:</th>
								<td><?php echo $data['TotalNoOfGuest'];?></td>
							</tr>
							<tr>
								<th class="htlfndr-scope-row">house name :</th>
								<td><?php echo $data['HouseName'];?></td>
							</tr>
							<tr>
								<th class="htlfndr-scope-row">Check-In Date :</th>
								<td><?php echo $data['CheckInDate'];?></td>
							</tr>
							<tr>
								<th class="htlfndr-scope-row">Check-Out Date :</th>
								<td><?php echo $data['CheckOutDate'];?></td>
							</tr>
							<tr>
								<th class="htlfndr-scope-row">Amount Paid :</th>
								<td><?php echo $data['AdvancePayment'];?></td>
							</tr>
							<tr>
								<th class="htlfndr-scope-row">Remaining Amount :</th> 
								<td><?php echo $data['DuePayment'];?></td>
							</tr>
							<tr>
								<td></td>								
							</tr>
							<tr>
								<td></td>								
							</tr>
							<tr>
								<form method=post>
								<td>
									<input class="htlfndr-book-now-button-demo" type="button" value=" Confirm Booking " id="<?php echo $data['BookingId'];?>" />
									<input class="htlfndr-book-now-button-cancel" type="button" value=" Cancel Booking " id="<?php echo $data['BookingId'];?>" />
								</td>
								<!-- <td>
									<a href="" class="btn-primary" style="color: white">Confirm Booking</a>
								</td> -->
							</form>
							</tr>								
						</table>
						<div id="ReasonhideDiv" style="display: none;">
							<form method="post" action="<?php $_SERVER['PHP_SELF'];?>">
								<input type="hidden" class="htlfndr-review-form-input" name="operation" value="Cancel">
								<input type="hidden" class="htlfndr-review-form-input" name="id" value=<?php echo $data['BookingId'];?>>
								<textarea name="txtReason" required id="number" class="htlfndr-review-form-input" rows=5  placeholder="Enter Reason for Cancellation "><?php if(isset($_POST['txtReason'])){ echo $_POST['txtReason'];}?></textarea>
								<input type="submit" class="btn-primary" name="cancelReason" value="Submit">
							</form>
						</div>
					</span>	
				</div>
					
		<?php
					}
			}
		?>	
		
			</div>
			</main>
		</div>
	</main>		
</div>
		
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