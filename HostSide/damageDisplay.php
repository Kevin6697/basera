<?php
	session_start();
	require_once 'Host.php';
	$host = new HostController();
	$result1=$host->viewDamages(0);
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
				$('.htlfndr-book-now-button-cancel').click(function(){
				var DeleteId=$(this).attr('id');
				swal({
						title:"Cancel",
						text: "Are you sure  you want to Delete the  Damage !",
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
					  		$.get('ConifrmUnconfirm.php',{deleteOperation:'deleteOperation',DeleteId:DeleteId},function(data)
							{
								if(data=="Deleted")
								{	
									swal({
											title:"Deleted Successfully!",
											type: "success"
										},
									  function(){
									    window.location.href = 'damageDisplay.php';
									});
								}
								else
								{
									swal({
											title:data,
											type: "error"
										},
									  function(){
									    window.location.href = 'damageDisplay.php';
									});	
								}
							});		
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
							    window.location.href = 'homePage.php';
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
								<th class="htlfndr-scope-row">house name :</th>
								<td><?php echo $data['HouseName'];?></td>
							</tr>
							<tr>
								<th class="htlfndr-scope-row">Damaged Item :</th>
								<td><?php echo $data['ItemName'];?></td>
							</tr>
							<tr>
								<th class="htlfndr-scope-row">Item Description :</th>
								<?php
									if($data['ItemDescription']!=null)
									{

								?>
								<td><?php echo $data['ItemDescription'];?></td>
								<?php 
									}
									else
									{
								?>
										<td>--------</td>
								<?php		
									}
								?>	
							</tr>
							<tr>
								<th class="htlfndr-scope-row">Damaged Price :</th>
								<td><?php echo $data['Price'];?></td>
							</tr>
							<tr>
								<th class="htlfndr-scope-row">Damaged Item Image :</th>
								<td><img src="../Uploads/DamageDetails/<?php echo $data['Image'];?>" height=150 width=150></td>
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
									<a class="htlfndr-book-now-button-demo" href="updateDamage.php?id=<?php echo $data['DamageId'];?>">Update Damage</a>
									<input class="htlfndr-book-now-button-cancel" type="button" value=" Delete Damage " id="<?php echo $data['DamageId'];?>" />
								</td>
								<!-- <td>
									<a href="" class="btn-primary" style="color: white">Confirm Booking</a>
								</td> -->
							</form>
							</tr>								
						</table>
			<?php
					}
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