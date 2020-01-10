<?php

session_start();
require_once('Maincontroller.php');

$homePlace =  $_GET['homePlace'];
$checkIn =  $_GET['checkIn'];
$checkOut =  $_GET['checkOut'];
$guests =  $_GET['guests'];
$controller = new Maincontroller();

if(isset($_POST['find']))
{
	$homePlace =  $_POST['homePlace'];
	$checkIn =  $_POST['checkIn'];
	$checkOut =  $_POST['checkOut'];
	$guests =  $_POST['guests'];
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
		<!-- End of main navigation -->
		<noscript><h2>You have JavaScript disabled!</h2></noscript>
	</header>

	<!-- Start of main content -->
	<div class="container">
			<!-- Progress steps -->
			<div class="htlfndr-steps">
				<ul class="htlfndr-progress">
					<li class="htlfndr-active-step" style="width: 33%;">
						<span class="htlfndr-step-number">1</span> <span class="htlfndr-step-description">results</span>
					</li>
					<li style="width: 33%;">
						<span class="htlfndr-step-number">2</span> <span class="htlfndr-step-description">house</span>
					</li>
					
					<li style="width: 33%;">
						<span class="htlfndr-step-number">3</span> <span class="htlfndr-step-description">payment</span>
					</li>
				</ul>
			</div><!-- .htlfndr-steps -->

			<aside class="htlfndr-sidebar htlfndr-sidebar-in-top htlfndr-full-form" role="search">
				<div class="widget htlfndr-form-light">
					<!-- There is no widget-title in a light form widget -->
					<form name="search-hotel" id="search-hotel" class="htlfndr-search-form">
						<div id="htlfndr-input-1" class="htlfndr-input-wrapper">
							<input type="text" name="homePlace" id="htlfndr-city" class="search-hotel-input" value="<?php echo $homePlace;?>" placeholder="Enter Area, City or State" />
						</div><!-- #htlfndr-input-1 .htlfndr-input-wrapper -->

						<div id="htlfndr-input-date-in" class="htlfndr-input-wrapper">
							<input type="text" name="checkIn" value="<?php echo $checkIn;?>" id="htlfndr-date-in" class="search-hotel-input" />
							<button type="button" class="htlfndr-clear-datepicker"></button>
							<label for="htlfndr-date-in" class="sr-only">Calendar Input</label>
						</div><!-- #htlfndr-input-date-in .htlfndr-input-wrapper -->

						<div id="htlfndr-input-date-out" class="htlfndr-input-wrapper">
							<label for="htlfndr-date-out" class="sr-only">Date out</label>
							<input type="text" name="checkOut" value="<?php echo $checkOut;?>" id="htlfndr-date-out" class="search-hotel-input" />
							<button type="button" class="htlfndr-clear-datepicker"></button>
						</div><!-- #htlfndr-input-date-out .htlfndr-input-wrapper -->

						<div  class="htlfndr-input-wrapper">
									<label for="htlfndr-dropdown" class="sr-only">The number of people in room</label>
								
       <div class="quantity buttons_added">
  <input type="button" value="-" class="minus" style="font-size: 25px;background: #23DEF7;border-color: #23DEF7"><input type="number" step="1" min="1" max="10" name="guests" value="<?echo $guests?>" style="font-size: 400 15px/20px 'Montserrat', sans-serif;background-image: url(../images/icon-date-in.png);border-color:1px solid #36322F " title="Qty" class="input-text qty text" size="4" pattern="" inputmode=""><input type="button" value="+" style="font-size: 25px;background: #23DEF7;border-color: #23DEF7" class="plus">
</div>	
						</div><!-- #htlfndr-input-4 .htlfndr-input-wrapper -->

						<div id="htlfndr-input-5">
							<input type="submit" value="search" name="find" />
						</div><!-- #htlfndr-input-5 .htlfndr-input-wrapper -->
						<div class="clearfix"></div>
					</form>
				</div><!-- .widget -->
			</aside><!-- .htlfndr-sidebar .htlfndr-sidebar-in-top .htlfndr-full-form -->

			<div class="row">
				<aside class="col-sm-4 col-md-3 col-lg-3 htlfndr-sidebar htlfndr-sidebar-in-left" role="complementary">
					<div class="htlfndr-modify-search-aside widget">
								<h3 class="widget-title">modify search</h3>
								<div class="htlfndr-widget-content">

									<form name="search-hotel" id="search-hotel">
										<label for="htlfndr-city" class="htlfndr-input-label">Your destination</label>
										<div id="htlfndr-input-1" class="htlfndr-input-wrapper">
											<input type="text" name="homePlace" value="<?php echo $homePlace;?>" id="htlfndr-city" class="search-hotel-input" placeholder="Enter city, region" />
										</div><!-- #htlfndr-input-1.htlfndr-input-wrapper -->

										<div class="htlfndr-float-input first-float">
											<label for="htlfndr-date-in" class="htlfndr-input-label">Check in</label>
											<div id="htlfndr-input-date-in" class="htlfndr-input-wrapper">
												<input type="text" name="checkIn" value="<?php echo $checkIn;?>" id="htlfndr-date-in" class="search-hotel-input"/>
												<button type="button" class="htlfndr-clear-datepicker"></button>
											</div><!-- #htlfndr-input-date-in.htlfndr-input-wrapper -->
										</div><!-- .htlfndr-float-input -->

										<div class="htlfndr-float-input">
											<label for="htlfndr-date-out" class="htlfndr-input-label">Check out</label>
											<div id="htlfndr-input-date-out" class="htlfndr-input-wrapper">
												<input type="text" name="checkOut" value="<?php echo $checkOut;?>" id="htlfndr-date-out" class="search-hotel-input"/>
												<button type="button" class="htlfndr-clear-datepicker"></button>
											</div><!-- #htlfndr-input-date-out.htlfndr-input-wrapper -->
										</div><!-- .htlfndr-float-input -->

										<!-- Section with selects -->
										<section class="htlfndr-select-block">
											<div class="htlfndr-input-wrapper htlfndr-small-select">
												<label for="htlfndr-room" class="htlfndr-input-label">Room</label>
												<div class="quantity buttons_added">
  <input type="button" value="-" class="minus" style="font-size: 25px;background: #23DEF7;border-color: #23DEF7"><input type="number" step="1" min="1" max="10" name="guests" value="<?echo $guests?>" style="font-size: 400 15px/20px 'Montserrat', sans-serif;background-image: url(../images/icon-date-in.png);border-color:1px solid #36322F " title="Qty" class="input-text qty text" size="4" pattern="" inputmode=""><input type="button" value="+" style="font-size: 25px;background: #23DEF7;border-color: #23DEF7" class="plus">
</div>
											<!-- .htlfndr-input-wrapper .htlfndr-small-select -->
											
											<!-- .htlfndr-input-wrapper .htlfndr-small-select -->

											<!-- .htlfndr-input-wrapper .htlfndr-small-select -->
											<input type="submit" value="search" class="btn-primary"/>
										</section>
										
									</form>
								</div><!-- .htlfndr-widget-content -->
							</div><!-- .htlfndr-search-details -->
				</aside><!-- .htlfndr-sidebar .htlfndr-sidebar-in-left -->
				<?php
					
					$data = $controller->fetchHome($homePlace,$guests);
					// print_r($data);
					$nearBy = $controller->fetchNearBy($homePlace,$guests);	
					if($nearBy == null)
					{
						$data = $controller->fetchHome($homePlace,$guests);
					}
					else
					{
						$data = $nearBy;
					}
					
					$result = mysqli_num_rows($data);
				?>
				<main class="col-sm-8 col-md-9 col-lg-9 htlfndr-search-result htlfndr-grid-view" role="main">
					<h2 class="htlfndr-search-result-title"><span><?php echo $result; ?></span> results found</h2>
					<!-- Sorting navigation section -->
					<section class="htlfndr-search-result-sorting row">
						<div class="col-md-12">

							<!-- Sorting elements -->
							<div class="dropdown htlfndr-sort">
								<a class="dropdown-toggle" id="htlfndr-sort-1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" role="button">
									Sort by
								</a>
								<ul class="dropdown-menu" aria-labelledby="htlfndr-sort-1">
									<li><a href="#" id="htlfndr-sort-by-price">price</a></li>
									<li><a href="#" id="htlfndr-sort-by-rating">rating</a></li>
									<li><a href="#" id="htlfndr-sort-by-popular">popular</a></li>
								</ul>
							</div><!-- .dropdown .htlfndr-sort -->

							<!-- Change number hotels to show -->
							<div class="dropdown htlfndr-show-number-hotels">
								<a class="dropdown-toggle" id="htlfndr-sort-2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" role="button">
									Show <span>9 items</span>
								</a>
								<ul class="dropdown-menu" aria-labelledby="htlfndr-sort-2">
									<li><a href="#" id="htlfndr-show-9" data-number="9">9 items</a></li>
									<li><a href="#" id="htlfndr-show-18" data-number="18">18 items</a></li>
									<li><a href="#" id="htlfndr-show-27" data-number="27">27 items</a></li>
								</ul>
							</div><!-- .dropdown .htlfndr-show-number-hotels -->

							<!-- Change view buttons -->
							<div class="htlfndr-view">
								<button id="htlfndr-grid" type="button" class="htlfndr-active" data-toggle="tooltip" data-placement="top" title="Grid view" role="button">
									<span></span>
									<span></span>
									<span></span>
									<span></span>
								</button>
								<button id="htlfndr-row" type="button" data-toggle="tooltip" data-placement="top" title="Row view" role="button">
									<span></span>
									<span></span>
									<span></span>
								</button>
							</div><!-- .htlfndr-view -->

						</div><!-- .col-md-12 -->
					</section><!-- .htlfndr-search-result-sorting .row -->

					<div class="row">

						<?php
						

						if(mysqli_num_rows($data) == 0)
						{
							echo "<Span><h1>No result found</h1></span>";
						}
						foreach ($data as $key ) 
						{						
							$image = $controller->fetchImage($key['HouseId']);
							while($img = mysqli_fetch_assoc($image)) 
							{

						?>

						<div class="col-md-4 htlfndr-hotel-post-wrapper">
									<div class="htlfndr-hotel-post">
										<a href="hotel_page.php?HomeId=<?php echo $key['HouseId'];?>" class="htlfndr-hotel-thumbnail">
											<img src="<?php echo "Uploads/HouseDetails/".$img['Image'];}?>" alt="pic" />
										</a>
									<img src="">	
										<div class="htlfndr-hotel-description">
											<div class="htlfndr-description-content">
												<h2 class="htlfndr-entry-title"><a href="hotel_page.php?HomeId=<?php echo $key['HouseId'];?>"><?php echo $key['HouseName'];?></a></h2>
												<div class="htlfndr-rating-stars" data-rating="4">
			
													<p class="htlfndr-hotel-reviews">(<span>128</span> reviews)</p>
												</div><!-- .htlfndr-rating-stars -->
												<h5 class="htlfndr-hotel-location"><a href="#"><i class="fa fa-map-marker"></i><?php echo $key['CityName']?></a></h5>
												
											</div><!-- .htlfndr-description-content -->
											<a href="hotel_page.php?HomeId=<?php echo $key['HouseId'];?>" role="button" class="htlfndr-select-hotel-button">select</a>
											<div class="htlfndr-hotel-price">
												<span class="htlfndr-from">from</span> <span class="htlfndr-cost">Rs. <?php echo $key['HouseBasePrice']+($key['HousePricePerPerson']*$guests);?></span> <span class="htlfndr-per-night">per night</span>
												<span class="cost">250</span>
											</div><!-- .htlfndr-hotel-price -->
										</div><!-- .htlfndr-hotel-description -->
									</div><!-- .htlfndr-hotel-post -->
								</div>

								<?php
								}
								?>


						<!-- .col-md-4  .htlfndr-hotel-post-wrapper-->
					</div><!-- .row -->

					<!-- Pagination -->
					<nav class="htlfndr-pagination">
						<ul class="pagination">
							<li class="htlfndr-left">
								<a href="#" aria-label="Previous">
									<span aria-hidden="true" class="fa fa-angle-left"></span>
								</a>
							</li>
							<li class="current"><a href="#">1</a></li>
							<li><a href="#">2</a></li>
							<li><a href="#">3</a></li>
							<li><a href="#">4</a></li>
							<li class="htlfndr-right">
								<a href="#" aria-label="Next">
									<span aria-hidden="true" class="fa fa-angle-right"></span>
								</a>
							</li>
						</ul>
					</nav><!-- .htlfndr-pagination -->
				</main><!-- .htlfndr-search-result -->
			</div><!-- .row -->
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
<!-- Include Query UI Touch Punch is a small hack that enables the use
		 of touch events on sites using the jQuery UI user interface library. -->
<script src="js/jquery.ui.touch-punch.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/bootstrap.min.js"></script>
<!-- Include Starrr Rating script file -->
<script src="js/starrr.min.js"></script>
<!-- Include TinySort script file -->
<script src="js/tinysort.js"></script>
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
    <script type="text/javascript">
			var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
			(function(){
			var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
			s1.async=true;
			s1.src='https://embed.tawk.to/5a2f6e97d0795768aaf8eb83/default';
			s1.charset='UTF-8';
			s1.setAttribute('crossorigin','*');
			s0.parentNode.insertBefore(s1,s0);
			})();
		</script>

<!--<script src="js/less.min.js" ></script> -->
</body>
</html>