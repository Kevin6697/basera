<?php
	if(!isset($_SESSION))
	{
		session_start();
		require_once 'Host.php';
		$host = new HostController();
		$count=$host->countBookings();
		$data=mysqli_fetch_assoc($count);
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
								<a class="htlfndr-logo navbar-brand" href="homePage.php">
									<img src="images/icon-ups-drinks.png" alt="Logo" style="height: 30px;margin-top: -5px;" />
									<p class="htlfndr-logo-text">Ba<span>sera</span></p>
								</a>
							</div><!-- .navbar-header -->
							<!-- Collect the nav links, forms, and other content for toggling -->
							<div class="collapse navbar-collapse navbar-right" id="		">
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
								<ul class="nav navbar-nav" style="padding-left: 100px;">
									<li style="margin-left: 50px">
										<a href="homePage.php">home page</a>
									</li>
									<li style="margin-left: 50px" class="dropdown">
										<a href="#" onclick="return false;">House</a>
										<ul class="dropdown-menu">
											<li><a href="housedetails.php">Register New House </a></li>
											<li><a href="viewRegistertedHouses.php">View house details</a></li>
										</ul>
									</li>
									<li style="margin-left: 50px" class="dropdown">
										<a href="#" onclick="return false;">Booking</a>
										<ul class="dropdown-menu">
											<li><a href="bookingConfirmation.php">Confirm Booking
											<?php
											if(isset($data['Count']))
											{
												if($data['Count']!=0)
													{
														echo "<sup> <span style=\"display:inline-block;border-radius:100%;padding:8px;background-color:red;color:#CDFFFF;\">".$data['Count']."</span></sup>";
													}	
											} 
											?>
										</a>
									</li>

									<li>
										<a href="checkIn.php">check-in  details</a>
									</li>
									<li>
										<a href="checkOut.php">check-out details</a>
									</li>
									</ul>
									</li>
									<li style="margin-left: 50px" class="dropdown">
										<a href="#" onclick="return false;">Damage</a>
										<ul class="dropdown-menu">
										<li><a href="damageDetails.php">add damage</a>
										</li>
											<li><a href="damageDisplay.php">View damage details</a></li>
										</ul>
									</li>
									<li style="margin-left:50px">
										<a href="bookingHistory.php">View Booking History</a>
									</li>
									<li style="margin-left:50px">
										<a href="about-us.php">about</a>
									</li>
								</ul>
							</div><!-- .collapse.navbar-collapse -->
						</div><!-- .container -->
					</nav><!-- .navbar.navbar-default.htlfndr-blue-hover-nav -->
				</div><!-- .htlfndr-under-header -->
				<!-- End of main navigation -->
			
</body>
</html>