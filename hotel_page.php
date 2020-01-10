<?php
session_start();
require_once('Maincontroller.php');
$controller = new Maincontroller();

$homeId = $_GET['HomeId'];
$guests=1;
if(isset($_POST['updateDate']))
{
	$guests = $_POST['guests'];
	$DateIn = date_create($_POST['checkIn']);
	$checkIn = date_format($DateIn,"Y-m-d");
	$DateOut = date_create($_POST['checkOut']);
	$checkOut = date_format($DateOut,"Y-m-d");
	$data = $controller->dateCheck($checkIn,$checkOut,$homeId);
	// print_r($data);
	if(mysqli_num_rows($data) != 0)
	{
		echo "<script>alert('Please select another date..!!')</script>";
	}
	
}

if(isset($_POST['book']))
{
	echo "test";
	$guests = $_POST['guests'];
	$checkIn = $_POST['checkIn'];
	$checkOut = $_POST['checkOut'];
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
	<link href="css/calendar.css" rel="stylesheet" />
	<!-- Jquery UI -->
	<link href="css/jquery-ui.css" rel="stylesheet" />
	<!-- OWL Carousel -->
	<link href="css/owl.carousel.css" rel="stylesheet" />
	  <style type="text/css">
      /* -- quantity box -- */

.quantity {
 display: inline-block; }

.quantity .input-text.qty {
 width: 50px;
 height: 41px;
 padding: 0 5px;
 text-align: center;
 background-image: url(../images/icon-date-in.png);
 border: 1px solid #efefef;
}

.quantity.buttons_added {
 text-align: left;
 position: relative;
 white-space: nowrap;
 vertical-align: top; }

.quantity.buttons_added input {
 display: inline-block;
 margin: 0;
 vertical-align: top;
 box-shadow: none;
}

.quantity.buttons_added .minus,
.quantity.buttons_added .plus {
 padding: 7px 10px 8px;
 height: 41px;
 background-color: #ffffff;
 border: 1px solid #efefef;
 cursor:pointer;}

.quantity.buttons_added .minus {
 border-right: 0; }

.quantity.buttons_added .plus {
 border-left: 0; }

.quantity.buttons_added .minus:hover,
.quantity.buttons_added .plus:hover {
 background: #eeeeee; }

.quantity input::-webkit-outer-spin-button,
.quantity input::-webkit-inner-spin-button {
 -webkit-appearance: none;
 -moz-appearance: none;
 margin: 0; }
 
 .quantity.buttons_added .minus:focus,
.quantity.buttons_added .plus:focus {
 outline: none; }


    </style>
	
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
			<?php include('header1.php');?><!-- Start of main navigation -->
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
								<li style="width: 33%;"><a href="searchresult.php" >
									<span class="htlfndr-step-number" >1</span> <span class="htlfndr-step-description">results</span></a>
								</li>
								<li style="width: 33%;" class="htlfndr-active-step">
									<span class="htlfndr-step-number">2</span> <span class="htlfndr-step-description">house</span>
								</li>
							
								<li style="width: 33%;">
									<span class="htlfndr-step-number">3</span> <span class="htlfndr-step-description">payment</span>
								</li>
							</ul>
						</div><!-- .htlfndr-steps -->


						<?php

						$data = $controller->DisplayHome($homeId);
						$ownerData = $controller->OwnerData($data['OwnerId']);
						?>

						<div class="row htlfndr-page-content">
							<main id="htlfndr-main-content" class="col-sm-12 col-md-8 col-lg-9 post htlfndr-hotel-single-content" role="main">
								<header class="htlfndr-entry-header">
									<h1 class="htlfndr-entry-title"><?php echo $data['HouseName'];?></h1>
									<!-- .htlfndr-rating-stars -->
									<div class="htlfndr-hotel-contacts row">
										<div class="col-sm-6 col-md-6 col-lg-4">
											<p class="htlfndr-location"><a href="#"><?php echo $data['AreaName'];?>,<?php echo $data['CityName'];?></a></p>
										</div>
										<div class="col-sm-6 col-md-6 col-lg-4">
											<p class="htlfndr-mail"><a href="mailto:example@mail.com"><?php echo $ownerData['OwnerEmail'];?></a></p>
										</div>

										<div class="col-sm-6 col-md-6 col-lg-4">
											<p class="htlfndr-phone"><a href="#"><?php echo $ownerData['OwnerNumber'];?></a></p>
										</div>

									</div><!-- .htlfndr-hotel-contacts -->
								</header>
								<div class="clearfix+"></div>
								<section id="htlfndr-gallery-and-map-tabs">
									<ul>
										<li><a href="#htlfndr-gallery-tab-1">photo</a></li>
										<li><a href="#htlfndr-gallery-tab-2">map</a></li>
									</ul>
					<!-- Start of hotel slider
						Must be two blocks with same class and same pictures in it -->
						<div id="htlfndr-gallery-tab-1" class="htlfndr-hotel-gallery">

							<div id="htlfndr-gallery-synced-1" class="htlfndr-gallery-carousel">
								<?php
								$image = $controller->fetchImages($homeId);
								while($img = mysqli_fetch_assoc($image)) 
								{

									?>

									<div class="htlfndr-gallery-item">
										<img src="<?php echo "Uploads/HouseDetails/".$img['Image'];?>" height="500" width="600" alt="hotel img"/>
									</div>
								<?php } ?>
								<!-- .htlfndr-gallery-item -->
								<!-- .htlfndr-gallery-item -->
								<!-- .htlfndr-gallery-item -->
							</div><!-- .htlfndr-gallery-synced-1 .htlfndr-hotel-gallery-->
							<div id="htlfndr-gallery-synced-2" class="htlfndr-gallery-carousel">
								<?php
								$image = $controller->fetchImages($homeId);
								while($img = mysqli_fetch_assoc($image)) 
								{

									?>
									<div class="htlfndr-gallery-item">
										<img src="<?php echo "Uploads/HouseDetails/".$img['Image'];?>" alt="hotel img" height="42px" width="42px"/>
									</div>
									<!-- .htlfndr-gallery-item -->
								<?php } ?><!-- .htlfndr-gallery-item -->
								</div><!-- .htlfndr-gallery-synced-2 .htlfndr-hotel-gallery-->
							</div><!-- #htlfndr-gallery-tab-1 .htlfndr-hotel-gallery -->
							<!-- End of hotel slider -->
							<div id="htlfndr-gallery-tab-2">
								<div class="htlfndr-iframe-wrapper">
									<iframe
									src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4461.6570805764695!2d-122.42764988684334!3d37.74624140010288!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x80859a6d00690021%3A0x4a501367f076adff!2z0KHQsNC9LdCk0YDQsNC90YbQuNGB0LrQviwg0JrQsNC70LjRhNC-0YDQvdC40Y8sINCh0KjQkA!5e0!3m2!1sru!2sua!4v1438339854639"
									allowfullscreen></iframe>
								</div><!-- .htlfndr-iframe-wrapper -->
							</div><!-- #htlfndr-gallery-tab-2 -->
						</section><!-- #htlfndr-gallery-and-map-tabs -->

						<section id="htlfndr-hotel-description-tabs">
							<ul>
								<li class="active" data-number="0"><a href="#htlfndr-hotel-description-tab-1">description</a></li>
								<li data-number="1"><a href="#htlfndr-hotel-description-tab-2">availability</a></li>
								<li data-number="2"><a href="#htlfndr-hotel-description-tab-3">amenities</a></li>
								<li data-number="3"><a href="#htlfndr-hotel-description-tab-4">Rules</a></li>

							</ul>
							<div id="htlfndr-hotel-description-tab-1" class="htlfndr-hotel-description-tab">
								<div class="row">
									<div class="col-md-5 htlfndr-description-table">
										<table>

											<tr>
												<th scope="row">Area:</th>
												<td><?php echo $data['AreaName'];?></td>
											</tr>
											<tr>
												<th scope="row">city:</th>
												<td><?php echo $data['CityName'];?></td>
											</tr>
											<tr>
												<th scope="row">address:</th>
												<td><?php echo $data['HouseAddressLine1']." ".$data['HouseAddressLine2']." ".$data['HouseAddressLine3'];?></td>
											</tr>
											<tr>
												<th scope="row">phone no:</th>
												<td><?php echo $ownerData['OwnerNumber'];?></td>
											</tr>
											<tr>
												<th scope="row">Bedrooms:</th>
												<td><?php echo $data['NoofBedrooms'];?></td>
											</tr>
											<tr>
												<th scope="row">bathrooms:</th>
												<td><?php echo $data['NoofBathrooms'];?></td>
											</tr>
											<tr>
												<th scope="row">check in:</th>
												<td><?php echo $data['CheckIn'];?></td>
											</tr>
											<tr>
												<th scope="row">check out:</th>
												<td><?php echo $data['CheckOut'];?></td>
											</tr>
											
										</table>
									</div><!-- .htlfndr-description-table -->
									<div class="col-md-7 htlfndr-description-right-side">
										<!-- Using Bootstrap media object class-->
										<div class="media">
											<!-- .media-left -->
											<div class="media-body">
												<h5>Hosted By</h5>
												<h4 class="media-heading"><?php echo $ownerData['OwnerFirstName']." ".$ownerData['OwnerLastName'];?></h4>
											</div><!-- .media-body -->
										</div><!-- .media -->
										<blockquote>
											<p><?php echo $data['HouseDescription1'];?></p>
										</blockquote>
									</div><!-- .htlfndr-description-right-side -->
								</div><!-- .row -->
							</div><!-- #htlfndr-hotel-description-tab-1 .htlfndr-hotel-description-tab-->
							<div id="htlfndr-hotel-description-tab-2" class="htlfndr-hotel-description-tab">
								<aside class="htlfndr-sidebar-in-top htlfndr-short-form">
									<form name="search-hotel" id="search-hotel" class="htlfndr-search-form" method="POST" action="hotel_page.php?HomeId=<?php echo $homeId?>">
										<div id="htlfndr-input-date-in" class="htlfndr-input-wrapper">
											<label for="htlfndr-date-in" class="sr-only test">Date in</label>
											<input type="text" name="checkIn" id="htlfndr-date-in" required="true" class="search-hotel-input test" />
											<button type="button" class="htlfndr-clear-datepicker"></button>
										</div><!-- #htlfndr-input-date-in .htlfndr-input-wrapper -->
										<div id="htlfndr-input-date-out" class="htlfndr-input-wrapper">
											<label for="htlfndr-date-out" class="sr-only">Date out</label>
											<input type="text" required="true" name="checkOut" id="htlfndr-date-out"  class="search-hotel-input" />
											<button type="button" class="htlfndr-clear-datepicker"></button>
										</div>
										<!-- #htlfndr-input-date-out .htlfndr-input-wrapper -->
										<div  class="htlfndr-input-wrapper">
									<label for="htlfndr-dropdown" class="sr-only">The number of people in room</label>
								
       <div class="quantity buttons_added">
  <input type="button" value="-" class="minus" style="font-size: 25px;background: #23DEF7;border-color: #23DEF7"><input type="number" step="1" min="1" value="<?php echo $guests;?>" max="10" name="guests" value="1" style="font-size: 400 15px/20px 'Montserrat', sans-serif;background-image: url(../images/icon-date-in.png);border-color:1px solid #36322F " title="Qty" class="input-text qty text" size="4" pattern="" inputmode=""><input type="button" value="+" style="font-size: 25px;background: #23DEF7;border-color: #23DEF7" class="plus">
</div>
										</div><!-- #htlfndr-input-4 .htlfndr-input-wrapper -->
										<div id="htlfndr-input-5" class="htlfndr-input-wrapper">
											<input type="submit" name="updateDate" value="update" class="btn-default"/>
										</div><!-- #htlfndr-input-5 .htlfndr-input-wrapper -->
										<div class="clearfix"></div>
									</form>
									<!-- .widget -->
								</aside><!-- .htlfndr-sidebar .htlfndr-sidebar-in-top -->

								<!-- .htlfndr-available-rooms-section -->
							</div><!-- #htlfndr-hotel-description-tab-2 .htlfndr-hotel-description-tab-->
							<div id="htlfndr-hotel-description-tab-3" class="htlfndr-hotel-description-tab">
								<article class="htlfndr-tab-article htlfndr-third-tab-post">
									<header>
										<h3>amenities</h3>
									</header>

									<footer class="row htlfndr-amenities">
										<?php
										$amenities = $controller->fetchAminities($homeId);
										while($row = mysqli_fetch_assoc($amenities)) 
										{

											?>
											<div>
												<p><?php echo $row['AminitiesName'];}?></p>
											</div>

										</footer>
									</article><!-- .htlfndr-tab-article .htlfndr-third-tab-post -->
								</div><!-- #htlfndr-hotel-description-tab-3 .htlfndr-hotel-description-tab-->
								<div id="htlfndr-hotel-description-tab-4" class="htlfndr-hotel-description-tab">
									<!-- .htlfndr-hotel-marks -->

									<div class="clearfix"></div>

									<div class="htlfndr-visitor-review">
										<article class="htlfndr-visitor-post">
											<!-- .htlfndr-rating-stars -->
											<p><?php echo $data['CustomRules1'];?></p>
											<p><?php echo $data['CustomRules2'];?></p>
										</article>
										<!-- .htlfndr-review-right-side -->
									</div><!-- .htlfndr-visitor-review -->
								</div><!-- #htlfndr-hotel-description-tab-4 .htlfndr-hotel-description-tab-->
								<!-- #htlfndr-hotel-description-tab-5 .htlfndr-hotel-description-tab-->
							</section><!-- #htlfndr-hotel-description-tabs -->
						</main><!-- .post .htlfndr-hotel-single-content -->

						<aside id="htlfndr-right-sidebar" class="col-sm-12 col-md-4 col-lg-3 htlfndr-sidebar htlfndr-sidebar-in-right" role="complementary">
							<p class="htlfndr-add-to-wishlist"></p>
							<br><br>
							<div class="widget htlfndr-hotel-visit-card htlfndr-short-view">
								<div class="htlfndr-widget-main-content htlfndr-widget-padding">
									<form method="POST" action="hotel_page.php?HomeId=<?php echo $homeId?>">
									<!-- .htlfndr-hotel-logo -->
									<div class="htlfndr-hotel-price"><span class="htlfndr-from">from</span> <span class="htlfndr-cost">Rs.<?php echo $data['HouseBasePrice']+($data['HousePricePerPerson']*$guests);?></span> <span class="htlfndr-per-night">/ night</span></div> <!-- .htlfndr-hotel-price -->
								</div><!-- .htlfndr-widget-main-content -->
								<a href="payment.php?checkIn=<?php echo $checkIn;?>&checkOut=<?php echo $checkOut;?>&guests=<?php echo $guests;?>&HomeId=<?php echo $homeId?>" class="htlfndr-book-now-button" role="button">book now</a><!-- 
								<input type="submit" name="book" value="Book now" class="htlfndr-book-now-button"> -->
							</div><!-- .widget .htlfndr-hotel-visit-card -->
						</form>
							<div class="widget htlfndr-near-properties">
								<div class="htlfndr-widget-main-content">
									<h3 class="widget-title">properties	near</h3>
									

									<div class="htlfdr-hotel-post">
										<?php
											// echo $data['AreaName'];
												$nearHomes = $controller->nearHouse($data['AreaName']);
												foreach ($nearHomes as $data ) 
												{						
													$image = $controller->fetchImage($data['HouseId']);
													while($img = mysqli_fetch_assoc($image)) 
													{
											?>
										<div class="htlfndr-post-inner htlfndr-table-view">
											<div class="htlfndr-hotel-thumbnail">
												<a href="hotel_page.php?HomeId=<?php echo $data['HouseId'];?>">
													<img src="<?php echo "Uploads/HouseDetails/".$img['Image'];}?>" alt="hotel pic"/>
												</a>
											</div>
											<div class="htlfndr-hotel-info">
												<a href="hotel_page.php?HomeId=<?php echo $data['HouseId'];?>"><h6><?echo $data['HouseName'];?></h6></a>
												<!-- .htlfndr-rating-stars -->
												<p class="htlfndr-hotel-price"><span>per night</span> <span class="htlfndr-cost-normal">Rs.<?php echo $data['HouseBasePrice'];?></span>

												</p>
											</div>

											</div>

										
									</div>
									<?php
												echo "<br>";
											}
											?>
									<!-- .htlfdr-hotel-post -->
								</div>

								
											
							</div>
						</div>

								<!-- .widget .htlfndr-near-properties -->

							<div class="widget htlfndr-widget-help">
								<div class="htlfndr-widget-main-content htlfndr-widget-padding">
									<h3 class="widget-title">need our help</h3>
									<span>24/7 dedicated customer support</span>
									<p class="htlfndr-phone">+(000) 000-000-000</p>
									<p class="htlfndr-mail">support@bestwebsoft.zendesk.cocomm</p>
								</div><!-- .htlfndr-widget-main-content .htlfndr-widget-padding -->
							</div><!-- .widget .htlfndr-widget-help -->
						</aside><!-- .htlfndr-sidebar-in-right -->
					</div><!-- .row .htlfndr-page-content -->
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
						<input id="htlfndr-sing-up-pass" class="htlfndr-input " type="text" name="htlfndr-sing-up-pass">
						<h4>Confirm Password</h4>
						<input id="htlfndr-sing-up-pass-conf" class="htlfndr-input " type="text" name="htlfndr-sing-up-pass-conf">
						<div class="clearfix">
							<span>Have an Account? 
								<a data-target="#htlfndr-sing-in" data-toggle="modal" href="#">
									<span>Sing in</span>
								</a>
							</span>
							<input type="submit" value="Sing up" class="pull-right">
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
						<input id="htlfndr-sing-in-email" class="htlfndr-input " type="text" name="htlfndr-sing-in-emal">
						<h4>Password</h4>
						<input id="htlfndr-sing-in-pass" class="htlfndr-input " type="text" name="htlfndr-sing-in-pass">
						<div class="clearfix">
							<span>Don't Have an Account? 
								<a data-target="#htlfndr-sing-up" data-toggle="modal" href="#">
									<span>Sing up</span>
								</a>
							</span>
							<input type="submit" value="Sing in" class="pull-right">
						</div>
					</form>
				</div>
			</div>	
			<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
			<script src="js/jquery-1.11.3.min.js"></script>
			<!-- Include Jquery UI script file -->
			<script src="js/jquery-ui.min.js"></script>
			<!-- Include Jquery UI responsive tabs script file -->
			<script src="js/jquery.responsiveTabs.min.js"></script>
			<script src="js/prototype.js"></script>
			<!-- Include Query UI Touch Punch is a small hack that enables the use of touch events on sites using the jQuery UI user interface library. -->
			<script src="js/jquery.ui.touch-punch.min.js"></script>
			<!-- Include all compiled plugins (below), or include individual files as needed -->
			<script src="js/bootstrap.min.js"></script>
			<!-- Include Owl Carousel script file -->
			<script src="js/owl.carousel.min.js"></script>
			<!-- Include main script file -->
			<script src="js/script.js"></script>
			<script>
      // $(document).ready(function(){
      //   alert("d");
      // });
      function wcqib_refresh_quantity_increments() {
    jQuery("div.quantity:not(.buttons_added), td.quantity:not(.buttons_added)").each(function(a, b) {
        var c = jQuery(b);
        c.addClass("buttons_added"), c.children().first().before('<input type="button" value="-" class="minus" />'), c.children().last().after('<input type="button" value="+" class="plus" />')
    })
}
String.prototype.getDecimals || (String.prototype.getDecimals = function() {
    var a = this,
        b = ("" + a).match(/(?:\.(\d+))?(?:[eE]([+-]?\d+))?$/);
    return b ? Math.max(0, (b[1] ? b[1].length : 0) - (b[2] ? +b[2] : 0)) : 0
}), jQuery(document).ready(function() {
    wcqib_refresh_quantity_increments()
}), jQuery(document).on("updated_wc_div", function() {
    wcqib_refresh_quantity_increments()
}), jQuery(document).on("click", ".plus, .minus", function() {
    var a = jQuery(this).closest(".quantity").find(".qty"),
        b = parseFloat(a.val()),
        c = parseFloat(a.attr("max")),
        d = parseFloat(a.attr("min")),
        e = a.attr("step");
    b && "" !== b && "NaN" !== b || (b = 0), "" !== c && "NaN" !== c || (c = ""), "" !== d && "NaN" !== d || (d = 0), "any" !== e && "" !== e && void 0 !== e && "NaN" !== parseFloat(e) || (e = 1), jQuery(this).is(".plus") ? c && b >= c ? a.val(c) : a.val((b + parseFloat(e)).toFixed(e.getDecimals())) : d && b <= d ? a.val(d) : b > 0 && a.val((b - parseFloat(e)).toFixed(e.getDecimals())), a.trigger("change")
});
    </script>		

			<!--<script src="js/less.min.js" ></script> -->
		</body>
		</html>

		<script>

			var ob = new availableRooms();
			var homeId = "<?php echo $homeId; ?>";
			var config = {
				'checkInCalendar' : 'ui-datepicker-calendar',
				'disabledClass' : '.ui-datepicker-unselectable.ui-state-disabled',
				'stateDisabled' : 'state-disabled',
				'unselectable' : 'ui-datepicker-unselectable',
			}	
			ob.setData({'c':'Maincontroller','m':'getData','homeId':homeId});
			ob.setConfig(config);

			jQuery('#htlfndr-input-date-in').click(function(){
				ob.loadData();
			});
			jQuery('#htlfndr-input-date-out').click(function(){
				ob.loadData();
			});

			jQuery(".ui-datepicker-calendar").on('change',function(){
				console.log(131);
			});
	
		</script>
