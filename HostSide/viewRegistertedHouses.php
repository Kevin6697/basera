<?php
session_start();

	require_once 'Host.php';
	$host = new HostController();
	$result=$host->viewRegistertedHouses();
	// if(isset($_POST['submit']))
	// {
	// 	$host->deleteHouse($_POST['houseId']);
	// }

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
<body>
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
			<main role="main">
				<br>
				<!-- Section with popular destinations -->
				<section class="container htlfndr-top-destinations">
					<h2 class="htlfndr-section-title">house list</h2>
					<div class="htlfndr-section-under-title-line"></div>
					<div class="row">
					<?php	
						if(mysqli_num_rows($result))
						{
							while ($data=mysqli_fetch_assoc($result)) 
							{
								$tmp=$host->imageFetch($data['HouseId'],'All');
								while($imgData=mysqli_fetch_assoc($tmp))
								{

						?>		
								<div class="col-sm-6 col-xs-6">
							
						
							<article class="htlfndr-top-destination-block">
								<div class="htlfndr-content-block">
								<?php
									echo"<img src=../Uploads/HouseDetails/".$imgData['Image']." alt=House height=400  />";
								
									}
								?>	
									<div class="htlfndr-post-content">
										<p  style='color:white;'class="htlfndr-the-excerpt">
											<?php echo $data['HouseDescription1'];?>
										<a class="htlfndr-read-more-arrow" href="detailedParticularHouse.php?id=<?php echo $data['HouseId']; ; ?>"><i class="fa fa-angle-right"></i></a>
										</p>
									</div>		
								</div><!-- .htlfndr-content-block -->
								<footer class="entry-footer">
									<div class="htlfndr-left-side-footer">
										<h4 class="entry-title"><?php echo $data['HouseName'];?></h4>
									</div><!-- .htlfndr-left-side-footer -->
									<div class="htlfndr-right-side-footer">
										<span class="htlfndr-cost"><?php echo "Rs.".$data['HouseBasePrice'];?></span>
										<span class="htlfndr-per-night">basic price</span>
										<br>

									</div><!-- .htlfndr-right-side-footer -->
								</footer>
							</article><!-- .htlfndr-top-destination-block -->
						</div><!-- .col-sm-4.col-xs-12 -->
					<?php
					}
						}
						else
						{
						?>
								<script>
										$(document).ready(function() {
												swal({
														title:"info",
														text: "You have not registerted any house till now.Please register first!",
														type: "info"
													},
													  function(){
													    window.location.href = 'housedetails.php';
												});
										});
								</script>	
							
						<?php
						}
		?>				
				</div>				
						</div><!-- .row -->
				</section><!-- .container.htlfndr-top-destinations -->
				
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
