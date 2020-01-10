<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	<title>Hotel Finder - Online Booking HTML Website Template</title>
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
		<div class="htlfndr-about-us">	
			<main id="htlfndr-main-content" class=" htlfndr-main-content" role="main">	
			<article>
				<br>
				<br>
				<h1 class="text-center">What We Do Everyday</h1>
				<div class="htlfndr-section-under-title-line"></div>
				<div class="htlfndr-text">
					<p>Neque cursus curae ante scelerisque vehicula porttitor natoque risus vitae lacinia felis elit netus sed iaculis</p>
					<p>	interdum nullam sem habitasse vulputate reetturpis fringilla duis suspendisse arcu</p>
					<p>Ullamcorper scelerisque elit quam dignissim velit lacus urna quam interdum quisque bibendum platea iaculis</p>
					<p> blandit dapibus non natoque purus pellentesque</p>
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas iaculis mauris nec lacus suscipit, et gravida </p>
					<p>magna volutpat. Nullam consequat rhoncus lacinia. Ut rhoncus velit ut sem elementum porttitor. </p>
				</div>
			</article>	
			<article class="htlfndr-creative-team">
				<div class="htlfndr-video-block">
					<img src="http://placehold.it/1024x420" alt="">
					<div class="htlfndr-video-title">
						<a href="https://youtu.be/uhE_CGRdkQE" target="_blank"class="htlfndr-button-play" style="height: 400px;">
							<!-- <iframe width="560" height="500" src="https://www.youtube.com/embed/uhE_CGRdkQE" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe> -->
							
	 					</a>
					
					</div>
				</div>
				<p class="text-center htlfndr-font-24"><i class="fa fa-users"></i></p>	
				<h1 class="text-center">Out Creative Team</h1>
				<hr>
				<p class="small text-center">Neque cursus curae ante scelerisque vehicula porttitor natoque risus vitae lacinia felis elit</p>
				<p class="small text-center">netus sed iaculis interdum nullam sem habitasse vulputate laoreet turpis fringilla duis suspendisse arcu</p>
				<div class="row container">
					<div class="col-md-3 col-sm-6 col-xs-6">
						<div class="htlfndr-user-person-navigation">
								<div class="htlfndr-user-avatar">
									<img alt="user avatar" src="http://placehold.it/125x120">
								</div>
							<h3 class="htlfndr-user-name">john brown</h3>
							<h6 class="htlfndr-user-membership">director</h6>
							<p class="text-center">Neque cursus curae ante scelei que vehicula porttitor natoque risus vitae lacinia felis elit netu</p>
						</div>
					</div>
					<div class="col-md-3 col-sm-6 col-xs-6">
						<div class="htlfndr-user-person-navigation">
								<div class="htlfndr-user-avatar">
									<!-- <img alt="user avatar" src="images/kevin.jpg"> -->
									<img alt="user avatar" src="images/1.jpg">
								</div>
							<h3 class="htlfndr-user-name">kevin shah</h3>
							<h6 class="htlfndr-user-membership">director</h6>
							<p class="text-center">Neque cursus curae ante scelei que vehicula porttitor natoque risus vitae lacinia felis elit netu</p>
						</div>
					</div>
					<div class="col-md-3 col-sm-6 col-xs-6">
						<div class="htlfndr-user-person-navigation">
								<div class="htlfndr-user-avatar">
									<img alt="user avatar" src="http://placehold.it/125x120">
								</div>
							<h3 class="htlfndr-user-name">david jacson</h3>
							<h6 class="htlfndr-user-membership">founder & Director</h6>
							<p class="text-center">Neque cursus curae ante scelei que vehicula porttitor natoque risus vitae lacinia felis elit netu</p>
						</div>
					</div>
					<div class="col-md-3 col-sm-6 col-xs-6">
						<div class="htlfndr-user-person-navigation">
								<div class="htlfndr-user-avatar">
									<img alt="user avatar" src="http://placehold.it/125x120">
								</div>
							<h3 class="htlfndr-user-name">Anna Pedersen</h3>
							<h6 class="htlfndr-user-membership">CHIEF OPERATING OFFICER</h6>
							<p class="text-center">Neque cursus curae ante scelei que vehicula porttitor natoque risus vitae lacinia felis elit netu</p>
						</div>
					</div>
				</div>
			</article>
			<article class="htlfndr-contact container">	
				<h1 class="text-center">Want to become Part of our Team?</h1>
				<p class="text-center htlfndr-slogan">We are looking just for you!</p>
				<p class="text-center htlfndr-font-24">
					<i class="fa fa-paper-plane"></i>
					</p>
				<p class="text-center"><a class="btn-default" href="contact-us.html#htlfndr-contact-us">Contact Us</a></p>
			</article>		

			</main>

		</div><!-- .row .htlfndr-elements-content -->
	<!-- End of main content -->
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
