<!DOCTYPE html>
<html lang="en">
	<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	<title>Basera</title>
	<!-- favicon -->
	<link rel="shortcut icon" href="images/icon-ups-drinks.png">
	    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
    <style>
      .main-block {
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      min-height: 80vh;
      max-width: 10000px;
      background: #1c87c9;
      }
      form {
      padding: 25px;
      margin: 25px;
      box-shadow: 0 2px 5px #f5f5f5; 
      background: #f5f5f5; 
      }
      .fas {
      margin: 25px 10px 0;
      font-size: 72px;
      color: #fff;
      }
      .fa-home {
      transform: rotate(-20deg);
      }
      .fa-calendar , .fa-building{
      transform: rotate(10deg);
      }
      submit:hover {
      background: #2371a0;
      }    
      @media (min-width: 568px) {
      .main-block {
      flex-direction: row;
      }
      .left-part, form {
      width: 50%;
      }
      .fa-home {
      margin-top: 0;
      margin-left: 20%;
      }
      .fa-calendar {
      margin-top: -10%;
      margin-left: 65%;
      }
      .fa-building {
      margin-top: 2%;
      margin-left: 28%;
      }
      }
    </style>
	<?php
		include 'headerlinks.html';
	?>
	</head>
	<body>
		<!-- Overlay preloader-->
		<div class="htlfndr-loader-overlay"></div>

		<div class="htlfndr-wrapper">
			<header>
				<?php
					include 'header.php';
				?>
				<!-- Start of slider section -->
				<section class="htlfndr-slider-section">
					
				</section><!-- .htlfndr-slider-section -->
				<!-- End of slider section -->
				<noscript><h2>You have JavaScript disabled!</h2></noscript>
			</header>

			<!-- Start of main content -->
			<main role="main">
			<br>
				<br>
				<!-- Section with popular destinations -->
				<section class="container-fluid htlfndr-usp-section">
					<h2 class="htlfndr-section-title htlfndr-lined-title"><span>Home Details</span></h2>
						  <div class="main-block">
						  <div class="left-part">
					        <i class="fas fa-home"></i>
					        <i class="fas fa-calendar"></i>
					        <i class="fas fa-building"></i>
					      </div>
					      <form method="post" action="housedetails.php">
					        <h1>Earn Money as a Host</h1>
					       	<div class="row">
								<div class="col-md-6">
									<label for="contact-name" class="htlfndr-required htlfndr-top-label">House Name</label>
									<input type="text" placeholder="ex:Demo" id="fname" class="htlfndr-review-form-input" required name="txtHouseName">
    
								</div>
								<div class="col-md-6">
									<label for="contact-name" class="htlfndr-required htlfndr-top-label">No. of Guest Allowed</label>
								<input type="number" min=1 max=10 placeholder="ex:1" id="lname" class="htlfndr-review-form-input"  required name="txtGuest" >
								</div>
							</div>
							<div class="col-md">
							<label for="contact-name" class="htlfndr-required htlfndr-top-label">Basic House Price</label>
							<input type="number" name="txtBasicPrice" min=500 id="number" class="htlfndr-review-form-input" required placeholder="ex:1000">
              			
							&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
							&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
							&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
							&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
							&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp		
						<input type="submit" id="submit"  name="submit" value=" Get Started " class="btn-primary">
					      </form>
					    </div>
					 
				</section><!-- .container.htlfndr-top-destinations -->
				
				<!-- Section called USP section -->
				<section class="container-fluid htlfndr-usp-section">
					<h2 class="htlfndr-section-title htlfndr-lined-title"><span>Control how you Host</span></h2><!-- You need <span> and 'htlfndr-lined-title' class for both side line -->
					<div class="container">
						<div class="row">
							<div class="col-sm-4 htlfndr-icon-box">
								<img class="htlfndr-icon icon-drinks" src="images/icon-ups-drinks.png" height="100" width="100" alt="icon" />
									<h5 class="htlfndr-section-subtitle">Host whenever you want </h5>
									<p>There’s no minimum or mandatory time you have to host, so you can block off dates when you’re not available.<p> 
									<p>You can set rules related to booking like:
									<ul>
										<li>Rules are for the rules and rules </li>
									</ul>
									</p>
									
							</div><!-- .col-sm-4.htlfndr-icon-box -->

							<div class="col-sm-4 htlfndr-icon-box">
								<img class="htlfndr-icon icon-drinks" src="images/icon-ups-card.png" height="100" width="100" alt="icon" />
									<h5 class="htlfndr-section-subtitle">Requirements to book</h5>
									<p>You can require that every guest provide identification to Bassera before booking with you.</p>
							</div><!-- .col-sm-4.htlfndr-icon-box -->

							<div class="col-sm-4 htlfndr-icon-box">
								<img class="htlfndr-icon icon-drinks" src="images/icon-ups-check.png" height="100" width="100" alt="icon" />
									<h5 class="htlfndr-section-subtitle">How we will earn ?</h5>
									<p>How much does it cost to list my space?
									<br>
									Signing up for Airbnb and listing your home is completely free. 
									Once you receive a reservation, we charge an Airbnb service fee for hosts, generally 3%, to help cover the cost of running the business.</p>
									
							</div><!-- .col-sm-4.htlfndr-icon-box -->
						</div><!-- .row -->
					</div><!-- .container -->
				</section><!-- .container-fluid .htlfndr-usp-section -->
				<!-- Section called USP section -->
				<section class="container-fluid htlfndr-usp-section">
					<h2 class="htlfndr-section-title htlfndr-lined-title"><span>Hosting is Easy </span></h2><!-- You need <span> and 'htlfndr-lined-title' class for both side line -->
					<div class="container">
						<div class="row">
							<div class="col-sm-4 htlfndr-icon-box">
								<img class="htlfndr-icon icon-drinks" src="images/icon-ups-check.png" height="100" width="100" alt="icon" />
									<h5 class="htlfndr-section-subtitle">List your space for free</h5>
									<p>Share any space without sign-up charges, from a shared living room to a second home and everything in-between.</p>
									
							</div><!-- .col-sm-4.htlfndr-icon-box -->

							<div class="col-sm-4 htlfndr-icon-box">
								<img class="htlfndr-icon icon-drinks" src="images/icon-ups-check.png" height="100" width="100" alt="icon" />
									<h5 class="htlfndr-section-subtitle">Decide how you want to host</h5>
									<p>Choose your own schedule, prices, and requirements for guests. We’re there to help along the way.</p>
							</div><!-- .col-sm-4.htlfndr-icon-box -->

							<div class="col-sm-4 htlfndr-icon-box">
								<img class="htlfndr-icon icon-drinks" src="images/icon-ups-check.png" height="100" width="100" alt="icon" />
									<h5 class="htlfndr-section-subtitle">Welcome your first guest</h5>
									<p>Once your listing is live, qualified guests can reach out. You can message them with any questions before their stay.</p>
							</div><!-- .col-sm-4.htlfndr-icon-box -->
						</div><!-- .row -->
					</div><!-- .container -->
				</section><!-- .container-fluid .htlfndr-usp-section -->
				

				</main>
			
			<!-- End of main content -->
			<?php
				include 'footer.html';
			?>
		</div><!-- .htlfndr-wrapper -->
		<?php
			include 'footerlinks.html';
		?>
	</body>
</html>