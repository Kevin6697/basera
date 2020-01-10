<?php

session_start();
require_once('Maincontroller.php');
$controller = new Maincontroller();


	$checkIn =  $_GET['checkIn'];
	$checkOut =  $_GET['checkOut'];
	$totalNights = (strtotime($checkOut) - strtotime($checkIn))/86400;
	$guests =  $_GET['guests'];
	$homeId =  $_GET['HomeId'];
	// echo $_GET;
	// print_r($_GET);
$data = $controller->DisplayHome($homeId);
$amount = $totalNights*($data['HouseBasePrice'] +($data['HousePricePerPerson']*$guests))/2;
$_SESSION['amt'] = $amount;
$hostId = $data['OwnerId'];
if(isset($_POST['btnSignIn']))
{
	$data = $controller->cutomerLogin();
	if($data)
	{
		$_SESSION['CustId'] = $data['CustId'];
		$_SESSION['CustName'] = $data['CustFirstName'];
		$customer = $controller->DisplayCustomer($_SESSION['CustId']);
		$data = $controller->DisplayHome($homeId);
	}
	else
	{
		echo "<script>alert('The email or password is incorrect. ')</script>";
	}

}

if(isset($_SESSION['CustId']))
{
	$custId = $_SESSION['CustId'];
	$customer = $controller->DisplayCustomer($_SESSION['CustId']);
	// echo $custId;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	<title>Basera - Find your home anywhere</title>

	<link rel="shortcut icon" href="images/home.png">
	
	<!-- Bootstrap -->
	<link href="css/bootstrap.min.css" rel="stylesheet" />
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

	<div class="htlfndr-wrapper">
		<header>
			<?php include('header1.php');?><!-- .htlfndr-top-header -->
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
						<!-- Progress steps -->
						<div class="htlfndr-steps">
							<ul class="htlfndr-progress">
								<li style="width: 33%;"><a href="search-result.php">
									<span class="htlfndr-step-number">1</span> <span class="htlfndr-step-description">results</span></a>
								</li>
								<li style="width: 33%;"><a href="hotel-page-v1.php" >
									<span class="htlfndr-step-number">2</span> <span class="htlfndr-step-description">house</span></a>
								</li>
							
								<li class="htlfndr-active-step" style="width: 33%;">
									<span class="htlfndr-step-number">3</span> <span class="htlfndr-step-description">payment</span>
								</li>
							</ul>
						</div><!-- .htlfndr-steps -->

						<div class="row htlfndr-payment-page">
							<main id="htlfndr-main-content" class="col-sm-12 col-md-8 col-lg-8" role="main">
								<form action="thanks-page.php" id="htlfndr-payment-form" method="post">
									
									<section class="htlfndr-form-section">
										<header>
											<h2 class="htlfndr-form-section-title">Your personal <span>information</span></h2>
											<?
											if(!isset($_SESSION['CustId']))
												{ ?>
											<h5 class="htlfndr-form-section-description"><a href="#" data-toggle="modal" data-target="#htlfndr-sing-in"><span class="htlfndr-sing-in-link">Sing in</span></a> for fast booking or enter your personal information</h5>
											<?
										}
										?>
										</header>
										<hr />
										<div class="htlfndr-form-block">
											<div class="htlfndr-form-block-inner">
												<div class="row">
													<div class="col-md-6">
														<label for="htlfndr-personal-name" class="htlfndr-required htlfndr-top-label">First name</label>
														<input type="text" id="htlfndr-personal-name" name="htlfndr-personal-name" value="<?php if(isset($_SESSION['CustId'])){echo $customer['CustFirstName'];}?>"
														class="htlfndr-input"
														placeholder="Enter your first name" disabled="true"/>
													</div>
													<div class="col-md-6">
														<label for="htlfndr-personal-middle-name" class="htlfndr-required htlfndr-top-label">Last name</label>
														<input type="text" id="htlfndr-personal-middle-name" value="<?php if(isset($_SESSION['CustId'])){echo $customer['CustLastName'];}?>" name="htlfndr-personal-middle-name" class="htlfndr-input" disabled="true"
														placeholder="Enter your middle name" />
													</div>
												</div><!-- .row -->
												<div class="row">
													<div class="col-md-6">
														<label for="htlfndr-personal-last-name" class="htlfndr-required htlfndr-top-label">Email ID</label>
														<input type="text" id="htlfndr-personal-last-name" name="htlfndr-personal-last-name" value="<?php if(isset($_SESSION['CustId'])){echo $customer['CustEmail'];}?>" disabled="true" class="htlfndr-input"
														placeholder="Enter your last name" />
													</div>
													<div class="col-md-6">
														<label for="htlfndr-personal-last-name" class="htlfndr-required htlfndr-top-label">Contact</label>
														<input type="text" id="htlfndr-personal-last-name" disabled="true" value="<?php if(isset($_SESSION['CustId'])){echo $customer['CustNumber'];}?>" name="htlfndr-personal-last-name" class="htlfndr-input"
														placeholder="Enter your last name" />
													</div>
												</div><!-- .row -->
											</div><!-- .htlfndr-form-block-inner -->
										</div><!-- .htlfndr-form-block -->
									</section><!-- .htlfndr-form-section -->

									<!-- .htlfndr-form-section -->

									<section class="htlfndr-form-section">
										<header>
											<h2 class="htlfndr-form-section-title">Billing <span>Address</span></h2>
											<h5 class="htlfndr-form-section-description">Please enter the details of your address</h5>
										</header>
										<hr />
										<div class="htlfndr-form-block">
											<div class="htlfndr-form-block-inner">
												<div class="row">
													<div class="col-md-4">
														<label for="htlfndr-city" class="htlfndr-required htlfndr-top-label">City</label>
														<input type="text" id="htlfndr-city" name="htlfndr-city" class="htlfndr-input"
														placeholder="Enter city name" />
													</div>
													<div class="col-md-5">
														<label for="htlfndr-country" class="htlfndr-required htlfndr-top-label">Country</label>
														<input type="text" id="htlfndr-country" name="htlfndr-country" class="htlfndr-input"
														placeholder="Enter country" />
													</div>
													<div class="col-md-3">
														<label for="htlfndr-postal-code" class="htlfndr-required htlfndr-top-label">Postal code</label>
														<input type="text" id="htlfndr-postal-code" name="htlfndr-postal-code" class="htlfndr-input"
														placeholder="xxxxx" maxlength="8" />
													</div>
												</div><!-- .row -->
												<div class="row">
													<div class="col-md-6">
														<label for="htlfndr-bil-address" class="htlfndr-required htlfndr-top-label">Billing Address</label>
														<input type="text" id="htlfndr-bil-address" name="htlfndr-bil-address" class="htlfndr-input"
														placeholder="Enter billing address" />
													</div>
													<div class="col-md-6">
														<label for="htlfndr-bil-address-2" class="htlfndr-top-label">Billing Address</label>
														<input type="text" id="htlfndr-bil-address-2" name="htlfndr-bil-address-2" class="htlfndr-input" />
													</div>
												</div>
											</div><!-- .htlfndr-form-block-inner -->
										</div><!-- .htlfndr-form-block -->
									</section><!-- .htlfndr-form-section -->

									<section class="htlfndr-form-section htlfndr-form-review-section">
										
								</form>		<!-- .htlfndr-warning-message -->
				<?php if(isset($_SESSION['CustId'])){?>		
					<form action="razorpay.php" method="POST">
						<input type="hidden" name="amount" value="<?php echo $amount;?>">
						<input type="hidden" name="custId" value="<?php echo $custId;?>">
						<input type="hidden" name="checkIn" value="<?php echo $checkIn;?>">
						<input type="hidden" name="checkOut"s value="<?php echo $checkOut;?>">
						<input type="hidden" name="houseId" value="<?php echo $homeId;?>">
						<input type="hidden" name="guests" value="<?php echo $guests;?>">
					<script
					    src="https://checkout.razorpay.com/v1/checkout.js"
					    data-key="rzp_test_b0CdQTP0uQAm6C" // Enter the Key ID generated from the Dashboard
					    data-amount="<?php echo ($amount*100);?>" 
					    data-currency="INR"
					    
					    data-name="Basera"
					    data-description="Find Your Home Anywhere"
					    data-image="images/home.png"
					    data-prefill.name="<?php echo $customer['CustFirstName']." ".$customer['CustLastName'];?>"
					    3
					    data-theme.color="#F37254"
					    class="htlfndr-payment-submit"
					></script>
					<!-- <input type="hidden" custom="Hidden Element" class="htlfndr-payment-submit" name="hidden"> -->
					<input type="submit" name="hidden" class="htlfndr-payment-submit" value="complete booking">
					</form>
				<?php }?>

										</section><!-- .htlfndr-form-section -->
									</form>
								</main><!-- #htlfndr-main-content -->

								<aside id="htlfndr-right-sidebar" class="col-sm-12 col-md-4 col-lg-offset-1 col-lg-3 htlfndr-sidebar htlfndr-sidebar-in-right" role="complementary">
									<div class="htlfndr-booking-details">
										<div class="widget">
											<div class="htlfndr-widget-main-content htlfndr-widget-padding">
												<h3 class="widget-title">booking details</h3>
												<div class="htlfndr-widget-block htlfndr-table-view">
													<?php
													$image = $controller->fetchImage($homeId);
													while($img = mysqli_fetch_assoc($image)) 
													{?>
													<div class="htlfndr-hotel-thumbnail">
														<a href="hotel-page-v1.php">
															<img src="Uploads/HouseDetails//<?php echo $img['Image'];} ?>" />
														</a>
													</div><!-- .htlfndr-hotel-logo -->
													<div class="htlfndr-hotel-info">
														<a href="hotel-page-v1.php"><h3><?php echo $data['HouseName'];?></h3></a>
													 <!-- .htlfndr-rating-stars -->
														
													</div>
												</div><!-- .htlfndr-widget-block -->
												<div class="htlfndr-widget-block htlfndr-bigger-font">
													
													<p class="htlfndr-details"><span>check-in:</span> <span><? echo $checkIn;?></span></p>
													<p class="htlfndr-details"><span>check-out:</span> <span><? echo $checkOut;?></span></p>
													<p class="htlfndr-details"><span>persons:</span> <span>2</span></p>
												</div><!-- .htlfndr-widget-block -->
												<div class="htlfndr-widget-block htlfndr-bigger-font">
													<p class="htlfndr-room-cost"><span>1 night price</span> <span>Rs<?php echo $data['HouseBasePrice'] +$data['HousePricePerPerson'];?></span></p>
													
												</div><!-- .htlfndr-widget-block -->
												<p class="htlfndr-total-price">total price:</p>
												<div class="htlfndr-hotel-price">
													<span class="htlfndr-cost">Rs<?php echo $totalNights*($data['HouseBasePrice'] +($data['HousePricePerPerson']*$guests));?></span>
												</div><!-- .htlfndr-hotel-price -->
											</div><!-- .htlfndr-widget-main-content -->
										</div><!-- .widget -->
									</div><!-- .htlfndr-booking-details -->
									<div class="widget htlfndr-widget-help">
										<div class="htlfndr-widget-main-content htlfndr-widget-padding">
											<h3 class="widget-title">need our help</h3>
											<span>24/7 dedicated customer support</span>
											<p class="htlfndr-phone">+(000) 000-000-000</p>
											<p class="htlfndr-mail">support@bestwebsoft.zendesk.com</p>
										</div><!-- .htlfndr-widget-main-content .htlfndr-widget-padding -->
									</div><!-- .widget .htlfndr-widget-help -->
								</aside><!-- .htlfndr-sidebar-in-right -->
							</div><!-- .row .htlfndr-payment-page-->
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
													<li class="menu-item"><a href="user-page.php">user profile</a></li>
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
					<div id="htlfndr-sing-up">
						<div class="htlfndr-content-card">
							<div class="htlfndr-card-title clearfix">
								<h2 class="pull-left">Sing up</h2> 
							</div>
							<form id="htlfndr-sing-up-form" method="post">
								<div class="row">
									<div class="col-md-6">
										<h4>first name</h4>
										<input id="htlfndr-sing-up-name" class="htlfndr-input " type="text" name="htlfndr-sing-up-name">
									</div>
									<div class="col-md-6">
										<h4>last name</h4>
										<input id="htlfndr-sing-up-last-name" class="htlfndr-input " type="text" name="htlfndr-sing-up-last-name">
									</div>
								</div>
								<h4>E-mail adress</h4>
								<input id="htlfndr-sing-up-email" class="htlfndr-input " type="text" name="htlfndr-sing-up-email">
								<h4>Password</h4>
								<input id="htlfndr-sing-up-pass" class="htlfndr-input " type="password" name="htlfndr-sing-up-pass">
								<h4>Confirm Password</h4>
								<input id="htlfndr-sing-up-pass-conf" class="htlfndr-input " type="text" name="htlfndr-sing-up-pass-conf">
								<div class="clearfix">
									<span>Have an Account? 
										<a data-target="#htlfndr-sing-in" data-toggle="modal" href="#">
											<span>Sign in</span>
										</a>
									</span>
									<input type="submit" value="Sing up"  class="pull-right">
								</div>
							</form>
						</div>
					</div>	
					<div id="htlfndr-sing-in">
						<div class="htlfndr-content-card">
							<div class="htlfndr-card-title clearfix">
								<h2 class="pull-left">Sing in</h2> 
							</div>
							<form id="htlfndr-sing-in-form" method="post">
								<h4>E-mail adress</h4>
								<input id="htlfndr-sing-in-email" class="htlfndr-input " type="text" name="txtEmail">
								<h4>Password</h4>
								<input id="htlfndr-sing-in-pass" class="htlfndr-input " type="text" name="txtPassword">
								<div class="clearfix">
									<span>Don't Have an Account? 
										<a data-target="#htlfndr-sing-up" data-toggle="modal" href="#">
											<span>Sing up</span>
										</a>
									</span>
									<input type="submit" name="btnSignIn" value="Sing in" class="pull-right">
								</div>
							</form>
						</div>
					</div>	
					<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
					<script src="js/jquery-1.11.3.min.js"></script>
					<!-- Include Jquery UI script file -->
					<script src="js/jquery-ui.min.js"></script>
<!-- Include Query UI Touch Punch is a small hack that enables the use
	of touch events on sites using the jQuery UI user interface library. -->
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