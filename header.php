<?php
	if(!isset($_SESSION))
	{
		session_start();
	}
	if(empty($_SESSION['hostId']) && $_SESSION['role']!="host")
	{
		 header("location:index.php");
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
		<div class="htlfndr-top-header">
					<div class="navbar navbar-default htlfndr-blue-hover-nav">
						<div class="container">
							<!-- Brand and toggle get grouped for better mobile display -->
							<div class="navbar-header">
								<a class="htlfndr-logo navbar-brand" href="index.html">
									<img src="images/logo.png" alt="Logo" />
									<p class="htlfndr-logo-text">hotel <span>finder</span></p>
								</a>
							</div><!-- .navbar-header -->
							<!-- Collect the nav links, forms, and other content for toggling -->
							<div class="collapse navbar-collapse navbar-right" id="htlfndr-first-nav">
								<ul class="nav navbar-nav">
										<li  class="dropdown-submenu"><a href="homePage.php">Welcome <?php echo $_SESSION['ownerName'];?></a>
												<ul class="dropdown-menu">
													<li><a href="editProfile.php">Edit Profile</a></li>
													<li><a href="changePassword.php">Change Password</a></li>
													<li><a href="logout.php">Logout</a></li>
													
								</ul>
								</div><!-- .collapse.navbar-collapse -->
						</div><!-- .container -->
					</div><!-- .navbar.navbar-default.htlfndr-blue-hover-nav-->
				</div><!-- .htlfndr-top-header -->
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
									<li style="margin-left: 70px">
										<a href="index.php">home</a>
									</li>
									<li style="margin-left: 70px"><a href="housedetails.php">house details </a></li>
									<li>
										<a href="viewRegistertedHouses.php" style="margin-left: 70px">Registered Houses</a>
									</li>
									<li style="margin-left:70px">
										<a href="about-us.html">about</a>
									</li>
									<li style="margin-left: 70px" class="dropdown">
										<a href="#" onclick="return false;">Pages</a>
										<ul class="dropdown-menu">
											<li  class="dropdown-submenu"><a href="search-result.html">Search result</a>
												<ul class="dropdown-menu">
													<li><a href="search-result.html">Search result 1</a>
													<li><a href="search-result-v-2.html">Search result 2</a></li>
													<li><a href="search-result-v-3.html">Search result 3</a></li>
												</ul>
											</li>
											<li  class="dropdown-submenu"><a href="hotel-page-v1.html">Hotel page</a>
												<ul class="dropdown-menu">
													<li><a href="hotel-page-v1.html">Hotel page 1</a>
													<li><a href="hotel-page-v2.html">Hotel page 1 Special offer</a></li>
													<li><a href="hotel-page-v3.html">Hotel page 2</a></li>
													<li><a href="hotel-page-v4.html">Hotel page 2 Special offer</a></li>
												</ul>
											</li>	
											<li class="dropdown-submenu"><a href="hotel-room-page.html">Hotel Room Page</a>
												<ul class="dropdown-menu">
													<li><a href="hotel-room-page.html">Hotel Room Page</a>
													<li><a href="hotel-room-page-special-offer.html">Hotel Room Page Special offer</a></li>
												</ul>
											</li>
											<li><a href="payment.html">Payment</a></li>
											<li><a href="search-rooms.html">Search Rooms</a></li>
											<li><a href="contact-us.html">Contact Us</a></li>
											<li><a href="thanks-page.html">Thanks Page</a></li>											
											<li><a href="404-page.html">404 Page</a></li>
										</ul>
									</li>
								</ul>
							</div><!-- .collapse.navbar-collapse -->
						</div><!-- .container -->
					</nav><!-- .navbar.navbar-default.htlfndr-blue-hover-nav -->
				</div><!-- .htlfndr-under-header -->
				<!-- End of main navigation -->
			
</body>
</html>