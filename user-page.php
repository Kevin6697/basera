<?php
session_start();
require_once('Maincontroller.php');
$controller = new Maincontroller();
$data = $controller->DisplayCustomer($_SESSION['CustId']);

if(isset($_POST['btnSave']))
{
	$msg=$controller->KYCUpload($_SESSION['CustId']);	
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
		<div id="htlfndr-edit-card">
			<div class="htlfndr-content-card">
				<div class="htlfndr-card-title clearfix">
					<a class="glyphicon glyphicon-remove pull-right" href="#"  data-dismiss="modal"></a>
					<h2 class="pull-left">Edit Card</h2> <span> (Visa XXXX XXXX XXXX 1234)</span>
				</div>
				<form id="htlfndr-contact-form" method="post">
					<h4>Card  Number</h4>
					<input id="htlfndr-edit-credit-card" class="htlfndr-input " type="text" name="htlfndr-number-card" placeholder="XXXX XXXX XXXX XXXX">
					<div class="htlfndr-info-card row">
						<div class="col-md-9 col-sm-9 htlfndr-card-name">
							<h4>Cardholder Name</h4>
							<input id="htlfndr-name-card" class="htlfndr-input" type="text" name="htlfndr-name-card" placeholder="John Brown">
						</div>
						<div class="col-md-3 col-sm-3 htlfndr-card-valid">
							<h4>Valid Thru</h4>
							<input id="htlfndr-valid-card" class="htlfndr-input" type="text" name="htlfndr-valid-card" placeholder="mm/yy">
						</div>
					</div>
					<input type="submit" value="Save edit">
				</form>
			</div>
		</div>
		<div id="htlfndr-add-card">
			<div class="htlfndr-content-card">
				<div class="htlfndr-card-title clearfix">
					<a class="glyphicon glyphicon-remove pull-right" href="#"  data-dismiss="modal"></a>
					<h2 class="pull-left">Add Card</h2>
				</div>
				<form id="htlfndr-contact-form" method="post">
					<h4>Card  Number</h4>
					<input id="htlfndr-add-credit-card" class="htlfndr-input " type="text" name="htlfndr-number-card" placeholder="XXXX XXXX XXXX XXXX">
					<div class="htlfndr-info-card row">	
						<div class="col-md-9 col-sm-9 htlfndr-card-name">
							<h4>Cardholder Name</h4>
							<input id="htlfndr-new-name-card" class="htlfndr-input" type="text" name="htlfndr-new-name-card" placeholder="John Brown">
						</div>
						<div class="col-md-3 col-sm-3 htlfndr-card-valid">
							<h4>Valid Thru</h4>
							<input id="htlfndr-new-valid-card" class="htlfndr-input" type="text" name="htlfndr-new-valid-card" placeholder="mm/yy">
						</div>
					</div>
					<input type="submit" value="Save edit">
				</form>
			</div>
		</div>
	
		<main id="htlfndr-main-content" role="main">
			<div class="row htlfndr-user-tabs htlfndr-credit-card-page">
				<div class="htlfndr-user-person-navigation-wrapper col-sm-4 col-md-3">
					<div class="htlfndr-user-person-navigation">
						<div class="htlfndr-user-avatar">
							<img src="http://placehold.it/130x130" alt="user avatar"/>
						</div>
						<h3 class="htlfndr-user-name"><?php echo $data['CustFirstName']; 
								echo "&nbsp;";
								echo $data['CustLastName'];?></h3>
						
						<ul role="tablist">
							<li><a href="#htlfndr-user-tab-1"><i class="fa fa-user"></i> personal info</a></li>
							<li><a href="#htlfndr-user-tab-2"><i class="fa fa-clock-o"></i> booking history</a></li>
							
							<li><a href="#htlfndr-user-tab-4"><i class="fa fa-heart-o"></i> wishlist</a></li>
							<li><a href="#htlfndr-user-tab-5"><i class="fa fa-wrench"></i> settings</a></li>
						</ul>
					</div><!-- .htlfndr-user-person-navigation -->
				</div><!-- .htlfndr-user-person-navigation-wrapper -->
				<div class="htlfndr-user-panel col-sm-8 col-md-9 htlfndr-info-page">
					<div id="htlfndr-user-tab-1" class="htlfndr-description-table">
						<div class="row htlfndr-counters">
							<div class="col-md-3 col-sm-6">
								<div class="htlfndr-counter-block">
									<div class="htlfndr-icon-holder"><i class="fa fa-plane"></i></div>
									<dl class="htlfndr-counter-numbers">
										<dt class="htlfndr-count">12467</dt>
										<dd>miles</dd>
									</dl>
								</div><!-- .htlfndr-counter-block -->
							</div>
							<div class="col-md-3 col-sm-6">
								<div class="htlfndr-counter-block">
									<div class="htlfndr-icon-holder"><i class="fa fa-building-o"></i></div>
									<dl class="htlfndr-counter-numbers">
										<dt class="htlfndr-count">12</dt>
										<dd>cities</dd>
									</dl>
								</div><!-- .htlfndr-counter-block -->
							</div>
							<div class="col-md-3 col-sm-6">
								<div class="htlfndr-counter-block">
									<div class="htlfndr-icon-holder"><i class="fa fa-globe"></i></div>
									<dl class="htlfndr-counter-numbers">
										<dt class="htlfndr-count">4%</dt>
										<dd>world</dd>
									</dl>
								</div><!-- .htlfndr-counter-block -->
							</div>
							<div class="col-md-3 col-sm-6">
								<div class="htlfndr-counter-block">
									<div class="htlfndr-icon-holder"><i class="fa fa-map-marker"></i></div>
									<dl class="htlfndr-counter-numbers">
										<dt class="htlfndr-count">7</dt>
										<dd>countries</dd>
									</dl>
								</div><!-- .htlfndr-counter-block -->
							</div>
						</div><!-- .row.htlfndr-counters -->
						<table class="htlfndr-personal-info-table">
							<tr>
								<th class="htlfndr-scope-row">name:</th>
								<td><?php echo $data['CustFirstName']; 
								echo "&nbsp;";
								echo $data['CustLastName'];?></td>
							</tr>
							<tr>
								<th class="htlfndr-scope-row">e-mail:</th>
								<td><?php echo $data['CustEmail'];?></td>
							</tr>
							<tr>
								<th class="htlfndr-scope-row">phone number:</th>
								<td>+91 <?php echo $data['CustNumber'];?></td>
							</tr>
							<tr>
								<th class="htlfndr-scope-row">KYC Details:</th>
								<td> 
									<?php 
									if($data['KYC_Status'] == 0)
									{
										echo "<font color='red'> Un-Verified </font>";
									}
									else
									{
										echo "<font color='green'> Verified </font>";
									}
									?>

								</td>
							</tr>
						</table>
					</div><!-- #htlfndr-user-tab-1 -->
				</div>
				<div class="htlfndr-user-panel col-md-9 col-sm-8 htlfndr-booking-page" id="htlfndr-user-tab-2">
					<table class="table">
						 <thead>
							 <tr>
								 <th>Title</th>
								 <th>Location</th>
								 <th>Order date</th>
								 <th>Date of your stay</th>
								 <th> </th>
							 </tr>
						 </thead>
						 <tbody>
						 	<?php
						 	$book = $controller->displayBooking($_SESSION['CustId']);

						 	foreach($book as $key)
						 	{
						 	?>
							<tr>
								<td class="htlfndr-scope-row"><?php echo $key['HouseName'];?></td>
								<td data-title="Location"><?php echo $key['CityName'];?></td>
								<td data-title="Order date"><?php echo $key['SystemDateTime']?></td>
								<td data-title="Date of your stay"><?php echo $key['CheckInDate']?>  - <?php echo $key['CheckOutDate']?></td>
								<td data-title="Cost"><a href="orderStatus.php?book=<?php echo $key['BookingId'];?>">View</a></td>
							</tr>
							<?php }
							?>
						</tbody>
 					</table>
					<div class="text-right">
						<a href="#"><i class="fa fa-angle-double-left"></i> next</a>
						<a href="#">prev <i class="fa fa-angle-double-right"></i></a>
					</div>
				</div><!-- .htlfndr-user-tabs-2 -->

				<!-- .row .htlfndr-user-tabs-3 -->
				<div class="htlfndr-wishlist-page" id="htlfndr-user-tab-4">
					<div class="htlfndr-user-panel col-md-9 col-sm-8 htlfndr-search-result htlfndr-grid-view">
						<div class="htlfndr-hotel-post-wrapper">
							<div class="htlfndr-hotel-post clearfix">
								<a class="glyphicon glyphicon-remove" href="#" data-toggle="modal" data-target="#remove-page"></a>
								<a href="hotel-page-v1.php" class="htlfndr-hotel-thumbnail pull-left">
									<img src="http://placehold.it/300x175" alt="pic" />
								</a>
									<div class="htlfndr-hotel-description">
										<div class="htlfndr-description-content">
										<div class="htlfndr-rating-stars" data-rating="5">
											<i class="fa fa-star htlfndr-star-color"></i>&nbsp;
											<i class="fa fa-star htlfndr-star-color"></i>&nbsp;
											<i class="fa fa-star htlfndr-star-color"></i>&nbsp;
											<i class="fa fa-star htlfndr-star-color"></i>&nbsp;
											<i class="fa fa-star htlfndr-star-color"></i>&nbsp;
											<p class="htlfndr-hotel-reviews">(<span>188</span> reviews)</p>
										</div><!-- .htlfndr-rating-stars -->
										<h2 class="htlfndr-entry-title"><a href="hotel-page-v1.php">King Size Bedroom</a></h2>
										
										<h5 class="htlfndr-hotel-location"><a href="#"><i class="fa fa-map-marker"></i>san francisco united states</a></h5>
										<p class="htlfndr-last-booking">Lastest booking: <span>14</span> hours ago</p>
									</div><!-- .htlfndr-description-content -->
									
									<span class="htlfndr-from">From</span>
									<div class="htlfndr-hotel-price">
										 <span class="htlfndr-cost">$ 100</span> 
									</div><!-- .htlfndr-hotel-price -->
									<span class="htlfndr-per-night">per night</span>
								</div><!-- .htlfndr-hotel-description -->
								<a href="hotel-page-v1.php" role="button" class="htlfndr-select-hotel-button">select</a>
							</div><!-- .htlfndr-hotel-post -->
							<div class="htlfndr-hotel-post clearfix">
								<a class="glyphicon glyphicon-remove" href="#" data-toggle="modal" data-target="#remove-page"></a>
								<a href="hotel-page-v3.php" class="htlfndr-hotel-thumbnail pull-left">
									<img src="http://placehold.it/300x175" alt="pic" />
								</a>
									<div class="htlfndr-hotel-description">
										<div class="htlfndr-description-content">
										<div class="htlfndr-rating-stars" data-rating="3">
											<i class="fa fa-star htlfndr-star-color"></i>&nbsp;
											<i class="fa fa-star htlfndr-star-color"></i>&nbsp;
											<i class="fa fa-star htlfndr-star-color"></i>&nbsp;
											<i class="fa fa-star "></i>&nbsp;
											<i class="fa fa-star "></i>&nbsp;
											<p class="htlfndr-hotel-reviews">(<span>188</span> reviews)</p>
										</div><!-- .htlfndr-rating-stars -->
										<h2 class="htlfndr-entry-title"><a href="hotel-page-v3.php">Awesome Suit</a></h2>
										
										<h5 class="htlfndr-hotel-location"><a href="#"><i class="fa fa-map-marker"></i>paris france</a></h5>
										<p class="htlfndr-last-booking">Lastest booking: <span>14</span> hours ago</p>
									</div><!-- .htlfndr-description-content -->
									
									<span class="htlfndr-from">From</span>
									<div class="htlfndr-hotel-price">
										 <span class="htlfndr-cost">$ 250</span> 
									</div><!-- .htlfndr-hotel-price -->
									<span class="htlfndr-per-night">per night</span>
								</div><!-- .htlfndr-hotel-description -->
								<a href="hotel-page-v3.php" role="button" class="htlfndr-select-hotel-button">select</a>
							</div><!-- .htlfndr-hotel-post -->
							<div class="htlfndr-hotel-post special-offer clearfix">
								<a class="glyphicon glyphicon-remove" href="#" data-toggle="modal" data-target="#remove-page"></a>
								<a href="hotel-page-v2.php" class="htlfndr-hotel-thumbnail pull-left">
									<img src="http://placehold.it/300x175" alt="pic" />
								</a>
									<div class="htlfndr-hotel-description">
										<div class="htlfndr-description-content">
										<div class="htlfndr-rating-stars" data-rating="4">
											<i class="fa fa-star htlfndr-star-color"></i>&nbsp;
											<i class="fa fa-star htlfndr-star-color"></i>&nbsp;
											<i class="fa fa-star htlfndr-star-color"></i>&nbsp;
											<i class="fa fa-star htlfndr-star-color"></i>&nbsp;
											<i class="fa fa-star"></i>&nbsp;
											<p class="htlfndr-hotel-reviews">(<span>128</span> reviews)</p>
										</div><!-- .htlfndr-rating-stars -->
										<h2 class="htlfndr-entry-title"><a href="hotel-page-v2.php">Ruzzini Palace hotel</a></h2>
										
										<h5 class="htlfndr-hotel-location"><a href="#"><i class="fa fa-map-marker"></i>paris france</a></h5>
										<p class="htlfndr-last-booking">Lastest booking: <span>14</span> hours ago</p>
									</div><!-- .htlfndr-description-content -->
									
									<span class="htlfndr-from">From</span>
									<div class="htlfndr-hotel-price">
										 <span class="htlfndr-cost">$ 150</span> 
									</div><!-- .htlfndr-hotel-price -->
									<span class="htlfndr-per-night">per night</span>
								</div><!-- .htlfndr-hotel-description -->
								<a href="hotel-page-v2.php" role="button" class="htlfndr-select-hotel-button">select</a>
							</div><!-- .htlfndr-hotel-post -->
							<div class="htlfndr-hotel-post clearfix">
								<a class="glyphicon glyphicon-remove" href="#" data-toggle="modal" data-target="#remove-page"></a>
								<a href="hotel-page-v1.php" class="htlfndr-hotel-thumbnail pull-left">
									<img src="http://placehold.it/300x175" alt="pic" />
								</a>
									<div class="htlfndr-hotel-description">
										<div class="htlfndr-description-content">
										<div class="htlfndr-rating-stars" data-rating="5">
											<i class="fa fa-star htlfndr-star-color"></i>&nbsp;
											<i class="fa fa-star htlfndr-star-color"></i>&nbsp;
											<i class="fa fa-star htlfndr-star-color"></i>&nbsp;
											<i class="fa fa-star htlfndr-star-color"></i>&nbsp;
											<i class="fa fa-star htlfndr-star-color"></i>&nbsp;
											<p class="htlfndr-hotel-reviews">(<span>128</span> reviews)</p>
										</div><!-- .htlfndr-rating-stars -->
										<h2 class="htlfndr-entry-title"><a href="hotel-page-v1.php">forcari palace</a></h2>
										
										<h5 class="htlfndr-hotel-location"><a href="#"><i class="fa fa-map-marker"></i>las vegas united states</a></h5>
										<p class="htlfndr-last-booking">Lastest booking: <span>14</span> hours ago</p>
									</div><!-- .htlfndr-description-content -->
									
									<span class="htlfndr-from">From</span>
									<div class="htlfndr-hotel-price">
										 <span class="htlfndr-cost">$ 300</span> 
									</div><!-- .htlfndr-hotel-price -->
									<span class="htlfndr-per-night">per night</span>
								</div><!-- .htlfndr-hotel-description -->
								<a href="hotel-page-v1.php" role="button" class="htlfndr-select-hotel-button">select</a>
							</div><!-- .htlfndr-hotel-post -->
							<div class="htlfndr-hotel-post clearfix">
								<a class="glyphicon glyphicon-remove" href="#" data-toggle="modal" data-target="#remove-page"></a>
								<a href="hotel-page-v3.php" class="htlfndr-hotel-thumbnail pull-left">
									<img src="http://placehold.it/300x175" alt="pic" />
								</a>
									<div class="htlfndr-hotel-description">
										<div class="htlfndr-description-content">
										<div class="htlfndr-rating-stars" data-rating="5">
											<i class="fa fa-star htlfndr-star-color"></i>&nbsp;
											<i class="fa fa-star htlfndr-star-color"></i>&nbsp;
											<i class="fa fa-star htlfndr-star-color"></i>&nbsp;
											<i class="fa fa-star htlfndr-star-color"></i>&nbsp;
											<i class="fa fa-star htlfndr-star-color"></i>&nbsp;
											<p class="htlfndr-hotel-reviews">(<span>128</span> reviews)</p>
										</div><!-- .htlfndr-rating-stars -->
										<h2 class="htlfndr-entry-title"><a href="hotel-page-v3.php">hilton molino stucky</a></h2>
										
										<h5 class="htlfndr-hotel-location"><a href="#"><i class="fa fa-map-marker"></i>las vegas united states</a></h5>
										<p class="htlfndr-last-booking">Lastest booking: <span>14</span> hours ago</p>
									</div><!-- .htlfndr-description-content -->
									
									<span class="htlfndr-from">From</span>
									<div class="htlfndr-hotel-price">
										 <span class="htlfndr-cost">$ 300</span> 
									</div><!-- .htlfndr-hotel-price -->
									<span class="htlfndr-per-night">per night</span>
									
								</div><!-- .htlfndr-hotel-description -->
								<a href="hotel-page-v3.php" role="button" class="htlfndr-select-hotel-button">select</a>
							</div><!-- .htlfndr-hotel-post -->
							
						</div><!--.htlfndr-hotel-post-wrapper -->

					<p class="htlfndr-load_more text-right"><a href="#">Load more +</a></p>
					</div>
				</div><!-- .htlfndr-user-tabs-4 -->

				<div class="htlfndr-user-panel col-md-9 col-sm-8 htlfndr-setting-page" id="htlfndr-user-tab-5">
					<div class="htlfndr-setting">
						<h2>Change <b>Personal Infomation</b></h2>
						<form  class="htlfndr-form-setting" id="htlfndr-settings-form" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data" method="post">
							<div class="row">
								<div class="col-md-5 htlfndr-form-setting-cols">
									<label for="settings-name" class="">First Name</label><br>
									<input id="settings-name" class="htlfndr-input" type="text" name="CustFirstName" value="<?php echo $data['CustFirstName'];?>"><br>
									<label for="settings-phone" class="">Phone number</label><br>
									<input id="settings-phone" class="htlfndr-input" type="text" name="CustNumber" value="<?php echo $data['CustNumber'];?>"><br>
									<label for="settings-adress" class="">KYC Details</label><br>
									<input id="settings-adress" class="htlfndr-file" type="file" name="fileToUpload"><font color="red"> <?php if(isset($msg)){echo $msg;}?></font><br>
									
									
								</div>
								<div class="col-md-5 htlfndr-form-setting-cols">
									<label for="settings-email" class="">Last Name</label><br>
									<input id="settings-email" class="htlfndr-input" type="text" name="CustLastName" value="<?php echo $data['CustLastName'];?>"><br>
									<label for="settings-subject" class="">E-mail</label><br>
									<input id="settings-subject" class="htlfndr-input" type="text" name="CustEmail" value="<?php echo $data['CustEmail'];?>"><br>
									
								</div>
							</div>
							<input type="submit" value="Save changes" class="btn-primary" name="btnSave">						
						</form>
						<h2>Change <b>Password</b></h2>
						<form  class="htlfndr-change-setting" id="htlfndr-settings-pass" method="post">
							<div class="row">
								<div class="col-md-5 htlfndr-form-setting-cols">
									<label for="settings-cur-pass" class="">Current Password</label><br>
									<input id="settings-cur-pass" class="htlfndr-input" type="text" name="settings-cur-pass" ><br>
									<label for="settings-new-pass" class="">New Password</label><br>
									<input id="settings-new-pass" class="htlfndr-input" type="text" name="settings-new-pass" ><br>
									<label for="settings-new-pass-again" class="">New Password Again</label><br>
									<input id="settings-new-pass-again" class="htlfndr-input" type="text" name="settings-new-pass-again" ><br>
									
								</div>
								<div class="col-md-5 htlfndr-form-setting-cols">
								</div>
							</div>
							<input type="submit" value="Save password" class="btn-primary">						
						</form>
					</div><!--.htlfndr-setting -->
				</div><!-- .htlfndr-user-tabs-5 -->
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
<script src="js/jquery-1.11.3.min.js"></script>
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