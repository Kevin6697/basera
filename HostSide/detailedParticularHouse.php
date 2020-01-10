<?php
	session_start();
	require_once 'Host.php';
	$host = new HostController();
	$result=$host->viewParticularHouse($_GET['id']);
	
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
	<script src="js/jquery-1.11.3.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$('.htlfndr-book-now-button-demo').click(function(){
				var deleteId=$(this).attr('id');
				swal({
						title:"Delete",
						text: "Are you sure  you want to Delete this house !",
						type: "warning",
						showCancelButton: true,
					    confirmButtonColor: '#DD6B55',
					    confirmButtonText: 'Yes, I am sure!',
					    cancelButtonText: "No, cancel it!",
					    closeOnConfirm: false,
    					closeOnCancel: true
					},
					  function(isConfirm){
					  	if(isConfirm)
					  	{
					  		$.get('commons.php',{operation1:'deleteHouse',deleteId:deleteId},function(data)
							{
								if(data=="DeletedImage Deleted")
								{	
									swal({
											title:"Deleted Successfully!",
											type: "success"
										},
									  function(){
									    window.location.href = 'viewRegistertedHouses.php';
									});
								}
								else
								{
									swal({
											title:data,
											type: "error"
										});	
								}
							});		
					  	}
				});
			});		
		});
	</script>
	<!-- 	<script type="text/javascript">
		function confirmation()
		{
			var x=confirm("Are u sure u want to delete ?" );
			if(x)
				return true;
			else
				return false;
		}
	</script> -->
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

	<!-- Start of main content -->
	<div class="container">
			<!-- Progress steps -->
		<?php
 				if(mysqli_num_rows($result))
 				{
 					while($data=mysqli_fetch_assoc($result))
 					{
 						$aminitiesResult=$host->aminitiesFetch($data['HouseId']);
 						$imageResult=$host->imageFetch($data['HouseId'],'Particular');
 						$nearbyResult=$host->nearbyFetch($data['HouseId']);
 		?>				
			<div class="row htlfndr-page-content htlfndr-room-page">
				<main id="htlfndr-main-content" class="col-sm-12 col-md-8 col-lg-9 htlfndr-hotel-single-content" role="main"  style="width: 84%;margin-left: 8%;margin-right: 8%">
					<article class="post htlfndr-room-post">
						<header>
							<h1 class="htlfndr-entry-title"><?php echo $data['HouseName'];?></h1>
						</header>
						<!-- Article slider -->
						<div id="htlfndr-room-slider" class="owl-carousel">
						<?php
							while($imgData=mysqli_fetch_assoc($imageResult))
							{
								echo"<div class=htlfndr-room-slide-wrapper>";
								echo"<img src=../Uploads/HouseDetails/".$imgData['Image']." alt=House />";
								echo"</div>";
							}
						?>	

					
						</div><!-- #htlfndr-room-slider -->
						<div class="widget htlfndr-room-details">
							<div id="htlfndr-accordion-1" class="htlfndr-widget-main-content htlfndr-widget-padding">
						<br>
							<section id="htlfndr-gallery-and-map-tabs">
						<ul>
							<li><a href="#htlfndr-gallery-tab-1">Description</a></li>
							<li><a href="#htlfndr-gallery-tab-2">Basic Details</a></li>
							<li><a href="#htlfndr-gallery-tab-3">Aminities</a></li>
						</ul>
						<!-- Start of hotel slider
						Must be two blocks with same class and same pictures in it -->
						<div id="htlfndr-gallery-tab-1" class="htlfndr-hotel-gallery">
							<table style="margin: 10%; width: 90%" border="0">
										<tr>
											<th scope="row"><p class="htlfndr-details">Description :</th>
											<td><p class="htlfndr-post-excerpt"><?php echo $data['HouseDescription1'];?></p></td>
										</tr>
										<tr>
											<th scope="row"></th>
											<td><p class="htlfndr-post-excerpt"><?php echo $data['HouseDescription1'];?></p></td>
										</tr>
										<tr>
											<th scope="row"><br></th>
											<td><br></td>
										</tr>
										<tr>
											<th scope="row"><br></th>
											<td><br></td>
										</tr>
										<tr>
											<th scope="row" style="width: 20%"><p class="htlfndr-details">Custom Rules : </p></th>
											<td><span>
											<?php
												if($data['CustomRules1']!="NULL" && $data['CustomRules2']=="NULL")
												{
													echo $data['CustomRules1'];
												}	
												if($data['CustomRules1']=="NULL" && $data['CustomRules2']!="NULL")
												{
													echo $data['CustomRules2'];
												}	
												if($data['CustomRules1']=="NULL" && $data['CustomRules2']=="NULL")
												{
													echo "\"No Particular Rules Specified\"";
												}
												if($data['CustomRules1']!="NULL" && $data['CustomRules2']!="NULL")
												{
													echo$data['CustomRules1']." ".$data['CustomRules2'];	
												}
											?>
												
											</span></td>
										</tr>
										<tr>
											<th scope="row"><br></th>
											<td><br></td>
										</tr>
										<tr>
											<th scope="row"><br></th>
											<td><br></td>
										</tr>
										<tr>
											<th scope="row"><p class="htlfndr-details">Address : </p></th>
											<td><span><?php echo $data['HouseAddressLine1'];?>
											<?php
											if($data['HouseAddressLine2']!="NULL" && $data['HouseAddressLine3']=="NULL")
											{
												echo",".$data['HouseAddressLine2'];
											}
											if($data['HouseAddressLine3']!="NULL" && $data['HouseAddressLine2']=="NULL")
											{
												echo",".$data['HouseAddressLine3'];
											}
											if($data['HouseAddressLine2']!="NULL" && $data['HouseAddressLine3']!="NULL" )
											{
												echo",".$data['HouseAddressLine2'].",".$data['HouseAddressLine3'];
											}
											
											
										?>	
											</span></td>
										</tr>		
										<tr>
											<th scope="row"><p class="htlfndr-details">Area : </p></th>
											<td><span><?php echo $data['AreaName'];?></span></td>
										</tr>
										<tr>
											<th scope="row"><p class="htlfndr-details">City : </p></th>
											<td><span><?php echo $data['CityName'];?></span></td>
										</tr>				
											<tr>
											<th scope="row"><p class="htlfndr-details">State : </p></th>
											<td>
												<?php echo $data['StateName'];?>
											</td>
										</tr>
										<tr>
											<th scope="row"><br></th>
											<td><br></td>
										</tr>
										<tr>
											<th scope="row"><br></th>
											<td><br></td>
										</tr>
										<tr>
											<th scope="row">Nearby Places :</th>
											<td>
												<?php
													while ($nearbyData=mysqli_fetch_assoc($nearbyResult)) 
														{
															echo $nearbyData['NearPlaceName']."<br>";
														}
												?>			
											</td>
										</tr>		
						</table>
						
							</div><!-- #htlfndr-gallery-tab-1 .htlfndr-hotel-gallery -->
						<!-- End of hotel slider -->
						<div id="htlfndr-gallery-tab-2">
							<div id="htlfndr-accordion-1">
								<table style="margin: 10%; width: 40%" border="0">
										<tr>
											<th scope="row"><p class="htlfndr-details">Base Price : </p></th>
											<td><span><?php echo $data['HouseBasePrice'];?></span></td>
										</tr>
										<tr>
											<th scope="row"><p class="htlfndr-details">Per Person Price : </p></th>
											<td><span><?php echo $data['HousePricePerPerson'];?></span></td>
										</tr>
										<tr>
											<th scope="row"><p class="htlfndr-details">Bedrooms : </p></th>
											<td><span><?php echo $data['NoofBedrooms'];?></span></td>
										</tr>		
										<tr>
											<th scope="row"><p class="htlfndr-details">Bathrooms : </p></th>
											<td><span><?php echo $data['NoofBathrooms'];?></span></td>
										</tr>
										<tr>
											<th scope="row"><p class="htlfndr-details">Max Guests : </p></th>
											<td><span><?php echo $data['NoofAllowedGuest'];?></span></td>
										</tr>
										<tr>
											<th scope="row"><p class="htlfndr-details">Check-In Time : </p></th>
											<td><span><?php echo $data['CheckIn'];?></span></td>
										</tr>
										<tr>
											<th scope="row"><p class="htlfndr-details">Check-Out Time : </p></th>
											<td><span><?php echo $data['CheckOut'];?></span></td>
										</tr>				
										<tr>
											<th scope="row"><p class="htlfndr-details">Can User Cancel after Booking : </p></th>
											<td>
												<?php
													if($data['IsCancellable']==1)
													{
														echo"<span>Yes</span>";		
													}
													else
													{
														echo"<span>No</span>";	
													}
												?>
											</td>
										</tr>
										<tr>
											<th scope="row"><p class="htlfndr-details">Is House Verified : </p></th>
											<td>
												<?php
													if($data['IsHouseVerified']==1)
													{
														echo"<span>Yes</span>";		
													}
													else
													{
														echo"<span>No</span>";	
													}
												?>
											</td>
										</tr>		
						</table>						
							</div><!-- .htlfndr-iframe-wrapper -->
						</div><!-- #htlfndr-gallery-tab-2 -->
					<div id="htlfndr-gallery-tab-3">
							<div id="htlfndr-accordion-1">
								<br>
								<ul class="htlfndr-list" style="margin:10%">
									<?php
									while ($aminitiesData1=mysqli_fetch_assoc($aminitiesResult)) {
										if($aminitiesData1['ExtraAminities']!=1)
										{
											echo"<li>".$aminitiesData1['AminitiesName']."</li>";
										}
										else
										{
											echo"<li style='color:red'>".$aminitiesData1['AminitiesName']."</li>";	
										}
									}
								?>			
							</div><!-- .htlfndr-iframe-wrapper -->
						</div>	

					</section><!-- #htlfndr-gallery-and-map-tabs -->
		</div><!-- .htlfndr-entry-content -->

							<form method=post>
							<a href="editHosueDetails.php?id=<?php echo $data['HouseId']; ?>" class="htlfndr-book-now-button">update</a>
							<input class="htlfndr-book-now-button-demo" type="button" value=" Delete " id="<?php echo $data['HouseId'];?>" />
<!-- 						<input type='submit'  value=' More Detail ' onclick=' return confirmation()'name='submit'> -->
									</form>
					</article><!-- .post .htlfndr-room-post -->
				</main><!-- .htlfndr-hotel-single-content -->
				
											
				</div><!-- .row .htlfndr-page-content -->
		</div><!-- .container -->
	<?php
 					}
 				}
 				else
 				{
 					header("Location:viewRegistertedHouses.php");
 				}
		?>	
	
	<!-- End of main content -->
	<br>
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