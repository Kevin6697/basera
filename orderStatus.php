<?php
session_start();
require_once('Maincontroller.php');
$controller = new Maincontroller();
$bookingId = $_GET['book'];
$data = $controller->displayStatus($bookingId);
$ownderdata = $controller->OwnerData($data['OwnerId']);

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	<title>Hotel Finder - User Profile</title>

	<!-- Bootstrap -->
	<link href="css/bootstrap.min.css" rel="stylesheet" />
	<link rel="stylesheet" type="text/css" href="css/progressBar.css" />
	<!-- Main styles -->
	<link href="css/style.css" rel="stylesheet" />
	<!--<link rel="stylesheet/less" href="css/style.less" />-->
	<!-- IE styles -->
	<link href="css/ie.css" rel="stylesheet" />
	<!-- Font Awesome -->
	<link href="css/font-awesome.min.css" rel="stylesheet" />
	<!-- Jquery UI -->
	<link href="css/jquery-ui.css" rel="stylesheet" />
	<!-- OWL Carousel -->
	<link href="css/owl.carousel.css" rel="stylesheet" />
	
	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>
<body>
<!-- Overlay preloader-->
<div class="htlfndr-loader-overlay"></div>

<div class="htlfndr-wrapper htlfndr-user-page">
	<header>
		<?php include('header1.php');?>
		<!-- Start of main navigation -->
		<div class="htlfndr-under-header">
			<nav class="navbar navbar-default">
				<div class="container">
					<div class="navbar-header">
						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#htlfndr-main-nav">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
					</div><!-- .navbar-header -->
					<!-- Collect the nav links, forms, and other content for toggling -->
					<div class="collapse navbar-collapse" id="htlfndr-main-nav">
						<ul class="nav navbar-nav">
							<li>
								<a href="index.php">home</a>
							</li>
							
							
							
							<li>
								<a href="contact-us.php">Contact us</a>
							</li>
						</ul>
					</div><!-- .collapse.navbar-collapse -->
				</div><!-- .container -->
			</nav><!-- .navbar.navbar-default.htlfndr-blue-hover-nav -->
		</div><!-- .htlfndr-under-header -->
		<!-- End of main navigation -->
		<noscript><h2>You have JavaScript disabled!</h2></noscript>
	</header>

	<!-- Start of main content -->
	<div class="container">
		<div class="htlfndr-elements-content" id="htlfndr-headers">
					<center>
					<h1>Booking Details</h1></center>
		</div>
		<br>
		<?php $i=$data['ConfirmationStatus'];?>
		<ol class="progtrckr" data-progtrckr-steps="5">
		    <li class="progtrckr-done">House Select</li><!--
		 --><li class="progtrckr-done">Advance Payment</li><!--
		 --><li <?php if($i>=1){echo "class='progtrckr-done'";}else{echo "class='progtrckr-todo'";}?>>Confirmation</li><!--
		 --><li <?php if($i>=2){echo "class='progtrckr-done'";}else{echo "class='progtrckr-todo'";}?>>Check In</li><!--
		 --><li <?php if($i>=3){echo "class='progtrckr-done'";}else{echo "class='progtrckr-todo'";}?>>Check Out</li>
		</ol>

		<main id="htlfndr-main-content" role="main">
			<div class="row htlfndr-user-tabs htlfndr-credit-card-page">
				<!-- .htlfndr-user-person-navigation-wrapper -->
				<div class="htlfndr-user-panel col-sm-8 col-md-9 htlfndr-info-page">
					<div id="htlfndr-user-tab-1" class="htlfndr-description-table">
						<!-- .row.htlfndr-counters -->
						<table class="htlfndr-personal-info-table">
							<tr>
								<th class="htlfndr-scope-row">House Name:</th>
								<td><?php echo $data['HouseName'];?></td>
							</tr>
							<tr>
								<th class="htlfndr-scope-row">Timing:</th>
								<td><?php echo $data['CheckIn']." - ".$data['CheckOut'];?></td>
							</tr>
							<tr>
								<th class="htlfndr-scope-row">CheckIn Date:</th>
								<td> <?php echo $data['CheckInDate'];?></td>
							</tr>
							<tr>
								<th class="htlfndr-scope-row">CheckOut Date:</th>
								<td> <?php echo $data['CheckOutDate'];?></td>
							</tr>
							<tr>
								<th class="htlfndr-scope-row">Advance Pay:</th>
								<td> Rs. <?php echo $data['AdvancePayment'];?></td>
							</tr>
							<tr>
								<th class="htlfndr-scope-row">Total Amount:</th>
								<td> Rs. <?php echo $data['AdvancePayment']+$data['AdvancePayment'];?></td>
							</tr>
							<tr>
								<th class="htlfndr-scope-row">Address:</th>
								<td> <?php echo $data['HouseAddressLine1']." ".$data['HouseAddressLine2']." ".$data['HouseAddressLine3'];?></td>
							</tr>
							<tr>
								<th class="htlfndr-scope-row">City:</th>
								<td> <?php echo $data['CityName'];?></td>
							</tr>
							<tr>
								<th class="htlfndr-scope-row">Hosted By</th>
								<td> <?php echo $ownderdata['OwnerFirstName']." ".$ownderdata['OwnerLastName'];?></td>
							</tr>
							<tr>
								<th class="htlfndr-scope-row">Contact Number:</th>
								<td> <?php echo $ownderdata['OwnerNumber'];?></td>
							</tr>
						</table>
					</div><!-- #htlfndr-user-tab-1 -->
				</div>
				<!-- .htlfndr-user-tabs-2 -->

				<!-- .row .htlfndr-user-tabs-3 -->
				<!-- .htlfndr-user-tabs-4 --><!-- .htlfndr-user-tabs-5 -->
			</div> <!-- .row -->
		</main><!-- #htlfndr-main-content -->
	</div><!-- .container -->
	<!-- End of main content -->

	<!-- Start of the Footer -->
	<footer class="htlfndr-footer">
		<button class="htlfndr-button-to-top" role="button"><span>Back to top</span></button><!-- Button "To top" -->

		<div class="widget-wrapper">
			<div class="container">
				<div class="row">
					<aside class="col-xs-12 col-sm-6 col-md-3 htlfndr-widget-column">
						<div class="widget">
							<a class="htlfndr-logo navbar-brand" href="#">
								<img src="images/logo.png" height="20" width="30" alt="Logo" />
								<p class="htlfndr-logo-text">hotel <span>finder</span></p>
							</a>
							<hr />
							<p>Suspendisse sed sollicitudin nisl, at dignissim libero. Sed porta tincidunt ipsum, vel volutpat.</p>
							<br />
							<p>Nunc ut fringilla urna. Cras vel adipiscing ipsum. Integer dignissim nisl eu lacus interdum facilisis. Aliquam erat volutpat. Nulla</p>
						</div><!-- .widget -->
					</aside><!-- .col-xs-12.col-sm-6.col-md-3.htlfndr-widget-column -->
					<aside class="col-xs-12 col-sm-6 col-md-3 htlfndr-widget-column">
						<div class="widget">
							<h3 class="widget-title">contact info</h3>
							<h5>address</h5>
							<p>Hotel Finder	<br />120 CA 15th Avenue-Suite 214, USA</p>
							<hr />
							<h5>phone number</h5>
							<p>1-555-5555-5555</p>
							<hr />
							<h5>email address</h5>
							<p>support@bestwebsoft.zendesk.com.com</p>
						</div><!-- .widget -->
					</aside><!-- .col-xs-12.col-sm-6.col-md-3.htlfndr-widget-column -->
					<aside class="col-xs-12 col-sm-6 col-md-3 htlfndr-widget-column">
						<div class="widget">
							<h3 class="widget-title">pages</h3>
							<ul class="menu">
								<li class="menu-item"><a href="index.php">home</a></li>
								<li class="menu-item"><a href="elements.php">elements</a></li>
								<li class="menu-item"><a href="blog-index.php">blog</a></li>
								<li class="menu-item"><a href="about-us.php">about</a></li>
								<li class="menu-item active"><a href="user-page.php">user profile</a></li>
							</ul>
						</div><!-- .widget -->
					</aside><!-- .col-xs-12.col-sm-6.col-md-3.htlfndr-widget-column -->
					<aside class="col-xs-12 col-sm-6 col-md-3 htlfndr-widget-column">
						<div class="widget">
							<h3 class="widget-title">follow us</h3>
							<!-- Start of Follow Us buttons -->
							<div class="htlfndr-follow-plugin">
								<a href="https://www.facebook.com/bestwebsoft/" target="_blank" class="htlfndr-follow-button button-facebook"></a>
								<a href="https://twitter.com/bestwebsoft" target="_blank" class="htlfndr-follow-button button-twitter"></a>
								<a href="https://plus.google.com/+Bestwebsoft" target="_blank" class="htlfndr-follow-button button-google-plus"></a>
								<a href="https://www.linkedin.com/company/bestwebsoft/" target="_blank" class="htlfndr-follow-button button-linkedin"></a>
								<a href="#" class="htlfndr-follow-button button-pinterest"></a>
								<a href="https://www.youtube.com/bestwebsoft" target="_blank" class="htlfndr-follow-button button-youtube"></a>
							</div><!-- .htlfndr-follow-plugin -->
							<!-- End of Follow Us buttons -->
							<hr />
							<h3 class="widget-title">mailing list</h3>
							<p>Sign up for our mailing list to get latest updates and offers</p>
							<form action="/">
								<input type="email" placeholder="Your E-mail" />
								<input type="submit" />
							</form>
						</div><!-- .widget -->
					</aside><!-- .col-xs-12.col-sm-6.col-md-3.htlfndr-widget-column -->
				</div><!-- .row -->
			</div><!-- .container -->
		</div><!-- .widget-wrapper -->

		<div class="htlfndr-copyright">
			<div class="container" role="contentinfo">
				<p>Copyright 2017 | BESTWEBSOFT | All Rights Reserved | Designed by BestWebSoft</p>
			</div><!-- .container -->
		</div><!-- .htlfndr-copyright -->
	</footer>
</div><!-- .htlfndr-wrapper -->

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="js/jquery-1.	11.3.min.js"></script>
<!-- Include Jquery UI script file -->
<script src="js/jquery-ui.min.js"></script>
<!-- Include Query UI Touch Punch is a small hack that enables the use of touch events on sites using the jQuery UI user interface library. -->
<script src="js/jquery.ui.touch-punch.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/bootstrap.min.js"></script>
<!-- Include Touch Menu Hover script file -->
<script src="js/jquery.ui.touch-punch.min.js"></script>
<!-- Include Owl Carousel script file -->
<script src="js/owl.carousel.min.js"></script>
<!-- Include main script file -->
<script src="js/script.js"></script>
<!--<script src="js/less.min.js" ></script> -->
</body>
</html>