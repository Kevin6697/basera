<?php

session_start();
require_once('Maincontroller.php');


$controller = new Maincontroller();
if(isset($_POST['btnSignUp']))
{
	$data = $controller->cutomerRegistration();	
	if($data)
	{
		$_SESSION['CustId'] = $data['CustId'];
		$_SESSION['CustName'] = $data['CustFirstName'];
		header("Location: index.php");
	}

}

if(isset($_POST['btnSignIn']))
{
	$data = $controller->cutomerLogin();
	if($data)
	{
		$_SESSION['CustId'] = $data['CustId'];
		$_SESSION['CustName'] = $data['CustFirstName'];
		header("Location: index.php");
	}
	else
	{
		echo "<script>alert('The email or password is incorrect. ')</script>";
	}

}


if(isset($_POST['search']))
{
	echo "call";
}
// echo $_SESSION['KYC'];
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
	<!-- OWL Carousel -->
	<link href="css/owl.carousel.css" rel="stylesheet" />
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
	
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-131007511-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-131007511-1');
</script>

<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'../www.googletagmanager.com/gtm5445.html?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-K5RHQ3P');</script>

<link rel="stylesheet" href="css/bootstrap-theme.min.css">
	<script src="https://code.jquery.com/jquery-1.11.2.min.js"></script>

	
	<?php
	$controller = new Maincontroller();
	if(isset($_SESSION['CustId']))
	{
		$check = $controller->CheckKYCStatus($_SESSION['CustId']);
	 	if($check['KYC_Status']==0)
		 { ?>
		 	<script type="text/javascript">
		     $(document).ready(function(){
		         $("#myModal").modal('show');
		     });
		 	</script>
		 	<?php
		 }
	
	}
	
	?> 
	

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
	</head>
	<body>

		<!-- Change the `data-field` of buttons and `name` of input field's for multiple plus minus buttons-->




		<div id="myModal" class="modal fade">
		    <div class="modal-dialog">
		        <div class="modal-content">
		            <div class="modal-header">
		                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		                <h4 class="modal-title">Congratulations! Your Profile Is Created.</h4>
		            </div>
		            <div class="modal-body">
		                <p>To activate your profile,please verify your KYC details.</p>
		                <form action="user-page.php">
		                    <button type="submit" class="btn btn-primary">Complete Profile</button>
		                </form>
		            </div>
		        </div>
		    </div>
		</div>

		<!-- Overlay preloader-->
		<div class="htlfndr-loader-overlay"></div>

		<div class="htlfndr-wrapper">
			<header>
				<!-- .htlfndr-top-header -->
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
									<li class="active">
										<a href="index.php">home</a>
									</li>
									
									
									<li>
								<a href="contact-us.php">Contact us</a>
							</li>
								</ul>
							</div><!-- .collapse.navbar-collapse -->
						</div><!-- .container -->
					</nav><!-- .navbar.navbar-default.htlfndr-blue-hover-nav -->
				</div>
				
				<!-- Start of slider section -->
				<section class="htlfndr-slider-section">
					<div class="owl-carousel">
						<div class="htlfndr-slide-wrapper">
							<img src="uploads/back.jpg" alt="img-1" />
							<div class="htlfndr-slide-data container">		
								<div class="htlfndr-slide-rating-stars">
									<i class="fa fa-star-o"></i>
									<i class="fa fa-star-o"></i>
									<i class="fa fa-star-o"></i>
									<i class="fa fa-star-o"></i>
									<i class="fa fa-star-o"></i>
								</div><!-- .htlfndr-slide-rating-stars -->
								<h1 class="htlfndr-slider-title">find your perfect home</h1>
								<div class="htlfndr-slider-under-title-line"></div>
							</div><!-- .htlfndr-slide-data.container -->
						</div><!-- .htlfndr-slide-wrapper-->
						<div class="htlfndr-slide-wrapper">
							<img src="images/1.jpg" alt="img-2" />
							<div class="htlfndr-slide-data container">		
								<div class="htlfndr-slide-rating-stars">
									<i class="fa fa-star-o htlfndr-star-color"></i>
									<i class="fa fa-star-o htlfndr-star-color"></i>
									<i class="fa fa-star-o htlfndr-star-color"></i>
									<i class="fa fa-star-o htlfndr-star-color"></i>
									<i class="fa fa-star-o"></i>
								</div><!-- .htlfndr-slide-rating-stars -->
								<h1 class="htlfndr-slider-title">find your perfect Home</h1>
								<div class="htlfndr-slider-under-title-line"></div>
							</div><!-- .htlfndr-slide-data.container -->
						</div><!-- .htlfndr-slide-wrapper-->
						<div class="htlfndr-slide-wrapper">
							<img src="images/2.jpg" alt="img-3" />
							<div class="htlfndr-slide-data container">		
								<div class="htlfndr-slide-rating-stars">
									<i class="fa fa-star-o htlfndr-star-color"></i>
									<i class="fa fa-star-o htlfndr-star-color"></i>
									<i class="fa fa-star-o htlfndr-star-color"></i>
									<i class="fa fa-star-o"></i>
									<i class="fa fa-star-o"></i>
								</div><!-- .htlfndr-slide-rating-stars -->
								<h1 class="htlfndr-slider-title">find your perfect home</h1>
								<div class="htlfndr-slider-under-title-line"></div>
							</div><!-- .htlfndr-slide-data.container -->
						</div><!-- .htlfndr-slide-wrapper-->
					</div>

					<!-- Search form aside start -->
					<aside class="htlfndr-form-in-slider htlfndr-search-form-inline">
						<div class="container">
							<h5>Where are you going?</h5>
							<form action="searchresult.php" name="search" id="search-hotel" class="htlfndr-search-form" method>
								<div id="htlfndr-input-1" class="htlfndr-input-wrapper">
									<input type="text" name="homePlace" id="htlfndr-city" class="search-hotel-input" placeholder="Enter city, area or state" required="true" />
									
								</div><!-- #htlfndr-input-1.htlfndr-input-wrapper -->

								<div id="htlfndr-input-date-in" class="htlfndr-input-wrapper">
									<label for="htlfndr-date-in" class="sr-only">Date in</label>
									<input type="text" name="checkIn" id="htlfndr-date-in" class="search-hotel-input" required="true" />
									<button type="button" class="htlfndr-clear-datepicker"></button>
								</div><!-- #htlfndr-input-date-in.htlfndr-input-wrapper -->

								<div id="htlfndr-input-date-out" class="htlfndr-input-wrapper">
									<label for="htlfndr-date-out" class="sr-only">Date out</label>
									<input type="text" name="checkOut" id="htlfndr-date-out" class="search-hotel-input" required="true" />
									<button type="button" class="htlfndr-clear-datepicker"></button>
								</div><!-- #htlfndr-input-date-out.htlfndr-input-wrapper -->
		
					
									<div  class="htlfndr-input-wrapper">
									<label for="htlfndr-dropdown" class="sr-only">The number of people in room</label>
								
       <div class="quantity buttons_added">
  <input type="button" value="-" class="minus" style="font-size: 25px;background: #23DEF7;border-color: #23DEF7"><input type="number" step="1" min="1" max="10" name="guests" value="1" style="font-size: 400 15px/20px 'Montserrat', sans-serif;background-image: url(../images/icon-date-in.png);border-color:1px solid #36322F " title="Qty" class="input-text qty text" size="4" pattern="" inputmode=""><input type="button" value="+" style="font-size: 25px;background: #23DEF7;border-color: #23DEF7" class="plus">
</div>
								</div><!-- #htlfndr-input-4.htlfndr-input-wrapper -->
								
								<div id="htlfndr-input-5">
									<input type="submit" name="search" value="search"/>
								</div><!-- #htlfndr-input-5.htlfndr-input-wrapper -->
							</form>
						</div><!-- .container -->
					</aside><!-- .htlfndr-form-in-slider.container-fluid -->
					<!-- Search form aside stop -->

				</section><!-- .htlfndr-slider-section -->
				<!-- End of slider section -->
				<noscript><h2>You have JavaScript disabled!</h2></noscript>
			</header>

			<!-- Start of main content -->
			<main role="main">
				<!-- Section with popular destinations -->
				<!-- .container.htlfndr-top-destinations -->
				
				<!-- Section called USP section -->
				<section class="container-fluid htlfndr-usp-section">
					<h2 class="htlfndr-section-title htlfndr-lined-title"><span>USP section</span></h2><!-- You need <span> and 'htlfndr-lined-title' class for both side line -->
					<div class="container">
						<div class="row">
							<div class="col-sm-4 htlfndr-icon-box">
								<img class="htlfndr-icon icon-drinks" src="images/icon-ups-drinks.png" height="100" width="100" alt="icon" />
									<h5 class="htlfndr-section-subtitle">beverages included</h5>
									<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse interdum eleifend augue, quis rhoncus purus fermentum.</p>
									<a href="#" class="htlfndr-read-more-button">read more</a>
							</div><!-- .col-sm-4.htlfndr-icon-box -->

							<div class="col-sm-4 htlfndr-icon-box">
								<img class="htlfndr-icon icon-drinks" src="images/icon-ups-card.png" height="100" width="100" alt="icon" />
									<h5 class="htlfndr-section-subtitle">best deals</h5>
									<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse interdum eleifend augue, quis rhoncus purus fermentum.</p>
									<a href="#" class="htlfndr-read-more-button">read more</a>
							</div><!-- .col-sm-4.htlfndr-icon-box -->

							<div class="col-sm-4 htlfndr-icon-box">
								<img class="htlfndr-icon icon-drinks" src="images/icon-ups-check.png" height="100" width="100" alt="icon" />
									<h5 class="htlfndr-section-subtitle">guarantee</h5>
									<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse interdum eleifend augue, quis rhoncus purus fermentum.</p>
									<a href="#" class="htlfndr-read-more-button">read more</a>
							</div><!-- .col-sm-4.htlfndr-icon-box -->
						</div><!-- .row -->
					</div><!-- .container -->
				</section><!-- .container-fluid .htlfndr-usp-section -->
				
				<!-- Section with categories -->
				<section class="container-fluid htlfndr-categories-portfolio">
					<h2 class="htlfndr-section-title bigger-title">discover the world</h2>
					<div class="htlfndr-section-under-title-line"></div>
					<div class="container">
						<div class="row">
							<div class="col-sm-4 col-xs-6">
								<div class="htlfndr-category-box" onclick="void(0)"><!-- The "onclick" is using for Safari (IOS)
								 that recognizes the 'div' element as a clickable element -->
									<img src="images/state/delhi.jpeg" height="311" width="370" alt="category-img" />
									<div class="category-description">
										<!-- .htlfndr-icon-flag-border -->
										<h2 class="subcategory-name">Delhi</h2>
										<a href="#" class="htlfndr-category-permalink"></a><!-- This link will be displayed to "block" and
										 will overlay to whole box by hovering on large desktop and will be a circle link on small devices -->
										
										<p class="category-properties"><span>374</span> properties</p>
									</div><!-- .category-description -->
								</div><!-- .htlfndr-category-box -->
							</div><!-- .col-sm-4.col-xs-6 -->

							<div class="col-sm-4 col-xs-6">
								<div class="htlfndr-category-box" onclick="void(0)">
									<img src="images/state/hydrabad.jpeg" height="311" width="370" alt="category-img" />
									<div class="category-description">
										<!-- .htlfndr-icon-flag-border -->
										<h2 class="subcategory-name">Hyderabad</h2>
										<a href="#" class="htlfndr-category-permalink"></a>
										
										<p class="category-properties"><span>185</span> properties</p>
									</div><!-- .category-description -->
								</div><!-- .htlfndr-category-box -->
							</div><!-- .col-sm-4.col-xs-6 -->

							<div class="col-sm-4 col-xs-6">
								<div class="htlfndr-category-box" onclick="void(0)">
									<img src="images/state/ahmedabad.jpeg" height="311" width="370" alt="category-img" />
									<div class="category-description">
										<!-- .htlfndr-icon-flag-border -->
										<h2 class="subcategory-name">ahmedabad</h2>
										<a href="#" class="htlfndr-category-permalink"></a>
										
										<p class="category-properties"><span>98</span> properties</p>
									</div><!-- .category-description -->
								</div><!-- .htlfndr-category-box -->
							</div><!-- .col-sm-4.col-xs-6 -->

							<div class="col-sm-4 col-xs-6">
								<div class="htlfndr-category-box" onclick="void(0)">
									<img src="images/state/mumbai.jpg" height="311" width="370" alt="category-img" />
									<div class="category-description">
										<!-- .htlfndr-icon-flag-border -->
										<h2 class="subcategory-name">mumbai</h2>
										<a href="#" class="htlfndr-category-permalink"></a>
										
										<p class="category-properties"><span>281</span> properties</p>
									</div><!-- .category-description -->
								</div><!-- .htlfndr-category-box -->
							</div><!-- .col-sm-4.col-xs-6 -->

							<div class="col-sm-4 col-xs-6">
								<div class="htlfndr-category-box" onclick="void(0)">
									<img src="images/state/aagra.jpg" height="311" width="370" alt="category-img" />
									<div class="category-description">
										<!-- .htlfndr-icon-flag-border -->
										<h2 class="subcategory-name">agra</h2>
										<a href="#" class="htlfndr-category-permalink"></a>
										
										<p class="category-properties"><span>38</span> properties</p>
									</div><!-- .category-description -->
								</div><!-- .htlfndr-category-box -->
							</div><!-- .col-sm-4.col-xs-6 -->

							<div class="col-sm-4 col-xs-6">
								<div class="htlfndr-category-box" onclick="void(0)">
									<img src="images/state/gangtok.jpg" height="311" width="370" alt="category-img" />
									<div class="category-description">
										<!-- .htlfndr-icon-flag-border -->
										<h2 class="subcategory-name">gangtok</h2>
										<a href="#" class="htlfndr-category-permalink"></a>
										
										<p class="category-properties"><span>318</span> properties</p>
									</div><!-- .category-description -->
								</div><!-- .htlfndr-category-box -->
							</div><!-- .col-sm-4.col-xs-6 -->
						</div><!-- .row -->
					</div>
				</section><!-- .container-fluid.htlfndr-categories-portfolio -->

				<!-- Section with visitors cards -->
				<!-- .container-fluid.htlfndr-visitors-cards -->
			</main>
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
										<li class="menu-item active"><a href="index.php">home</a></li>
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
									<form>
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
					<h2 class="pull-left">Sign up</h2> 
				</div>
				<form id="htlfndr-sing-up-form" method="post">
					<div class="row">
						<div class="col-md-6">
							<h4>First name</h4>
							<input id="htlfndr-sing-up-name" class="htlfndr-input " type="text" name="txtFirstName">
						</div>
						<div class="col-md-6">
							<h4>Last name</h4>
							<input id="htlfndr-sing-up-last-name" class="htlfndr-input " type="text" name="txtLastName">
						</div>
					</div>
					<h4>E-mail adress</h4>
					<input id="htlfndr-sing-up-email" class="htlfndr-input " type="text" name="txtEmail">
					<h4>Contact</h4>
					<input id="htlfndr-sing-up-email" placeholder="Ex . 9876543210" class="htlfndr-input " type="text" name="txtNumber">
					<h4>Password</h4>
					<input id="htlfndr-sing-up-pass" class="htlfndr-input " type="password" name="txtPassword">
					<h4>Confirm Password</h4>
					<input id="htlfndr-sing-up-pass-conf" class="htlfndr-input " type="password" name="txtConfirmPassword">
					<div class="clearfix">
						<span>Have an Account? 
							<a data-target="#htlfndr-sing-in" data-toggle="modal" href="#">
								<span>Sign in</span>
							</a>
						</span>
						<input type="submit" value="Sing up" class="pull-right" name="btnSignUp">
					</div>
				</form>
			</div>
		</div>
		<div id="htlfndr-sing-in">
			<div class="htlfndr-content-card">
				<div class="htlfndr-card-title clearfix">
					<h2 class="pull-left">Sign in</h2> 
				</div>
				<form id="htlfndr-sing-in-form" method="post">
					<h4>E-mail adress</h4>
					<input id="htlfndr-sing-in-email" class="htlfndr-input " type="text" name="txtEmail">
					<h4>Password</h4>
					<input id="htlfndr-sing-in-pass" class="htlfndr-input " type="Password" name="txtPassword"><br>
					<div class="clearfix">
						<a href="forgotpassword.php">Forgot Password?</a>
					</div>
					<div class="clearfix">
						<span>Don't Have an Account? 
							<a data-target="#htlfndr-sing-up" data-toggle="modal" href="#">
								<span>Sign up</span>
							</a>
						</span>
						<input type="submit" name="btnSignIn" value="Sign in" class="pull-right">
					</div>
				</form>
			</div>
		</div>

		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
		<script src="js/jquery-1.11.3.min.js"></script>
		<!-- Include Jquery UI script file -->
		<script src="js/jquery-ui.min.js"></script>
		<script src="js/prototype.js"></script>
		<!-- Include all compiled plugins (below), or include individual files as needed -->
		<!-- Include Query UI Touch Punch is a small hack that enables the use
		 of touch events on sites using the jQuery UI user interface library. -->
		<script src="js/jquery.ui.touch-punch.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<!-- Include Owl Carousel script file -->
		<script src="js/owl.carousel.min.js"></script>
		<!-- Include main script file -->
		<script src="js/script.js"></script>
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
